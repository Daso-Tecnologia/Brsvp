<?php

class grid_aereopar_rsvp_r_pesq
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $cmp_formatado;
   var $nm_data;
   var $Campos_Mens_erro;

   var $comando;
   var $comando_sum;
   var $comando_filtro;
   var $comando_ini;
   var $comando_fim;
   var $NM_operador;
   var $NM_data_qp;
   var $NM_path_filter;
   var $NM_curr_fil;
   var $nm_location;
   var $NM_ajax_opcao;
   var $NM_case_insensitive;
   var $nmgp_botoes = array();
   var $NM_fil_ant = array();

   /**
    * @access  public
    */
   function __construct()
   {
   }

   /**
    * @access  public
    * @global  string  $bprocessa  
    */
    function scGetTippyCssTheme(&$themeList, $themeName)
    {
        if (isset($themeList[$themeName])) {
            return;
        }

        $themeNameParts = explode('__NM__', $themeName);

        $themeList[$themeName] = [
            'tippy' => $themeNameParts[1],
            'file' => '../_lib/freecss/' . $themeName . '.css'
        ];
    }

   function monta_busca()
   {
      global $bprocessa;
      include("../_lib/css/" . $this->Ini->str_schema_filter . "_filter.php");
      $this->Ini->Str_btn_filter = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
      $this->Str_btn_filter_css  = trim($str_button) . "/" . trim($str_button) . ".css";
      $this->Ini->str_google_fonts = (isset($str_google_fonts) && !empty($str_google_fonts))?$str_google_fonts:'';
      include($this->Ini->path_btn . $this->Ini->Str_btn_filter);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['path_libs_php'] = $this->Ini->path_lib_php;
      $this->Img_sep_filter = "/" . trim($str_toolbar_separator);
      $this->Block_img_col  = trim($str_block_col);
      $this->Block_img_exp  = trim($str_block_exp);
      $this->Bubble_tail    = trim($str_bubble_tail);
      $this->css_help_tooltip_faicon = isset($css_help_tooltip_faicon) && '' != trim($css_help_tooltip_faicon) ? trim($css_help_tooltip_faicon) : "fa fa-question-circle";
      $this->css_schema_info_tooltiptheme = isset($css_schema_info_tooltiptheme) && '' != trim($css_schema_info_tooltiptheme)  ? trim($css_schema_info_tooltiptheme) : "";
      $this->Ini->tippy_themes = [];
      $this->Ini->tippy_theme_default = '';
      if ('' != $this->css_schema_info_tooltiptheme) {
          $this->scGetTippyCssTheme($this->Ini->tippy_themes, $this->css_schema_info_tooltiptheme);
          $this->Ini->tippy_theme_default = $this->css_schema_info_tooltiptheme;
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_config_btn.php", "F", "nmButtonOutput"); 
      $this->NM_case_insensitive = true;
      $this->init();
      if ($this->NM_ajax_flag && $this->NM_ajax_opcao == "ajax_grid_search_change_fil")
      {
          $arr_new_fil = $this->recupera_filtro($this->NM_ajax_grid_fil, "grid");
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca'] = array(); 
          foreach ($arr_new_fil as $tp)
          {
              foreach ($tp as $ind => $cada_dado)
              {
                  $field = $cada_dado['field'];
                  if (substr($cada_dado['field'], 0, 3) == "SC_")
                  {
                      $field = substr($cada_dado['field'], 3);
                  }
                  if (substr($cada_dado['field'], 0, 6) == "id_ac_")
                  {
                      $field = substr($cada_dado['field'], 6);
                  }
                  if (is_array($cada_dado['value']))
                  {
                      $arr_tmp = array();
                      foreach($cada_dado['value'] as $ix => $dados)
                      {
                          if (isset($dados['opt']))
                          {
                              $arr_tmp[] = $dados['opt'];
                          }
                          else
                          {
                              $arr_tmp[] = $dados;
                          }
                      }
                      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca'][$field] = $arr_tmp; 
                  }
                  else
                  {
                      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca'][$field] = $cada_dado['value']; 
                  }
              }
          }
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca'], $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->processa_busca();
          if (!empty($this->Campos_Mens_erro)) 
          {
              scriptcase_error_display($this->Campos_Mens_erro, ""); 
              return false;
          }
          return true;
      }
      if ($this->NM_ajax_flag && $this->NM_ajax_opcao == "ajax_grid_search")
      {
         $this->processa_busca();
         return;
      }
      if ($this->NM_ajax_flag)
      {
          ob_start();
          $this->Arr_result = array();
          $this->processa_ajax();
          $Temp = ob_get_clean();
          if ($Temp !== false && trim($Temp) != "")
          {
              $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($this->Arr_result);
          if ($this->Db)
          {
              $this->Db->Close(); 
          }
          exit;
      }
      if (isset($bprocessa) && "pesq" == $bprocessa)
      {
         $this->processa_busca();
      }
      else
      {
         $this->monta_formulario();
      }
   }

   /**
    * @access  public
    */
   function monta_formulario()
   {
      $this->monta_html_ini();
      $this->monta_cabecalho();
      $this->monta_form();
      $this->monta_html_fim();
   }

   /**
    * @access  public
    */
   function init()
   {
      global $bprocessa;
      $_SESSION['scriptcase']['sc_tab_meses']['int'] = array(
                                  $this->Ini->Nm_lang['lang_mnth_janu'],
                                  $this->Ini->Nm_lang['lang_mnth_febr'],
                                  $this->Ini->Nm_lang['lang_mnth_marc'],
                                  $this->Ini->Nm_lang['lang_mnth_apri'],
                                  $this->Ini->Nm_lang['lang_mnth_mayy'],
                                  $this->Ini->Nm_lang['lang_mnth_june'],
                                  $this->Ini->Nm_lang['lang_mnth_july'],
                                  $this->Ini->Nm_lang['lang_mnth_augu'],
                                  $this->Ini->Nm_lang['lang_mnth_sept'],
                                  $this->Ini->Nm_lang['lang_mnth_octo'],
                                  $this->Ini->Nm_lang['lang_mnth_nove'],
                                  $this->Ini->Nm_lang['lang_mnth_dece']);
      $_SESSION['scriptcase']['sc_tab_meses']['abr'] = array(
                                  $this->Ini->Nm_lang['lang_shrt_mnth_janu'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_febr'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_marc'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_apri'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_mayy'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_june'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_july'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_augu'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_sept'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_octo'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_nove'],
                                  $this->Ini->Nm_lang['lang_shrt_mnth_dece']);
      $_SESSION['scriptcase']['sc_tab_dias']['int'] = array(
                                  $this->Ini->Nm_lang['lang_days_sund'],
                                  $this->Ini->Nm_lang['lang_days_mond'],
                                  $this->Ini->Nm_lang['lang_days_tued'],
                                  $this->Ini->Nm_lang['lang_days_wend'],
                                  $this->Ini->Nm_lang['lang_days_thud'],
                                  $this->Ini->Nm_lang['lang_days_frid'],
                                  $this->Ini->Nm_lang['lang_days_satd']);
      $_SESSION['scriptcase']['sc_tab_dias']['abr'] = array(
                                  $this->Ini->Nm_lang['lang_shrt_days_sund'],
                                  $this->Ini->Nm_lang['lang_shrt_days_mond'],
                                  $this->Ini->Nm_lang['lang_shrt_days_tued'],
                                  $this->Ini->Nm_lang['lang_shrt_days_wend'],
                                  $this->Ini->Nm_lang['lang_shrt_days_thud'],
                                  $this->Ini->Nm_lang['lang_shrt_days_frid'],
                                  $this->Ini->Nm_lang['lang_shrt_days_satd']);
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_functions.php", "", "") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_api.php", "", "") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_data.class.php", "C", "nm_data") ; 
      $this->nm_data = new nm_data("pt_br");
      $pos_path = strrpos($this->Ini->path_prod, "/");
      $this->NM_path_filter = $this->Ini->root . substr($this->Ini->path_prod, 0, $pos_path) . "/conf/filters/";
      $this->NM_path_filter_dyn = $this->Ini->root . substr($this->Ini->path_prod, 0, $pos_path) . "/conf/filters_dyn/";
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['opcao'] = "igual";
   }

   function processa_ajax()
   {
      global $NM_filters, $NM_filters_del, $nmgp_save_name, $nmgp_save_option, $NM_fields_refresh, $NM_parms_refresh, $Campo_bi, $Opc_bi, $NM_operador, $nmgp_save_origem;
//-- ajax metodos ---
      if ($this->NM_ajax_opcao == "ajax_filter_save")
      {
          ob_end_clean();
          ob_end_clean();
          $this->salva_filtro($nmgp_save_origem);
          $this->NM_fil_ant = $this->gera_array_filtros();
          $Nome_filter = "";
          $Opt_filter  = "<option value=\"\"></option>\r\n";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              $Cada_filter = $Tipo_filter[2];
              if ($_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter,   "UTF-8", $_SESSION['scriptcase']['charset']);
                  $Tipo_filter[1] = sc_convert_encoding($Tipo_filter[1], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter = $Tipo_filter[1];
                  $Opt_filter .= "<option value=\"\">" . grid_aereopar_rsvp_r_pack_protect_string($Nome_filter) . "</option>\r\n";
              }
              $Opt_filter .= "<option value=\"" . grid_aereopar_rsvp_r_pack_protect_string($Tipo_filter[0]) . "\">.." . htmlspecialchars($Cada_filter).  "</option>\r\n";
          }
          if (isset($nmgp_save_origem) && $nmgp_save_origem == "grid")
          {
              $Ajax_select  = "<SELECT id=\"id_sel_recup_filters\" class=\"scFilterToolbar_obj\" name=\"sel_recup_filters\" onChange=\"nm_change_grid_search(this)\" size=\"1\">\r\n";
              $Ajax_select .= $Opt_filter;
              $Ajax_select .= "</SELECT>\r\n";
              $this->Arr_result['setValue'][] = array('field' => "id_NM_filters_save", 'value' => $Ajax_select);
              $Ajax_select = "<SELECT id=\"sel_filters_del\" class=\"scFilterToolbar_obj\" name=\"NM_filters_del\" size=\"1\">\r\n";
              $Ajax_select .= $Opt_filter;
              $Ajax_select .= "</SELECT>\r\n";
              $this->Arr_result['setValue'][] = array('field' => "id_sel_filters_del", 'value' => $Ajax_select);
              return;
          }
          $Ajax_select  = "<SELECT id=\"sel_recup_filters_bot\" name=\"NM_filters_bot\" onChange=\"nm_submit_filter(this, 'bot');\" size=\"1\">\r\n";
          $Ajax_select .= $Opt_filter;
          $Ajax_select .= "</SELECT>\r\n";
          $this->Arr_result['setValue'][] = array('field' => "idAjaxSelect_NM_filters_bot", 'value' => $Ajax_select);
          $Ajax_select = "<SELECT id=\"sel_filters_del_bot\" class=\"scFilterToolbar_obj\" name=\"NM_filters_del_bot\" size=\"1\">\r\n";
          $Ajax_select .= $Opt_filter;
          $Ajax_select .= "</SELECT>\r\n";
          $this->Arr_result['setValue'][] = array('field' => "idAjaxSelect_NM_filters_del_bot", 'value' => $Ajax_select);
      }

      if ($this->NM_ajax_opcao == "ajax_filter_delete")
      {
          ob_end_clean();
          ob_end_clean();
          $this->apaga_filtro();
          $this->NM_fil_ant = $this->gera_array_filtros();
          $Nome_filter = "";
          $Opt_filter  = "<option value=\"\"></option>\r\n";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              $Cada_filter = $Tipo_filter[2];
              if ($_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter,    "UTF-8", $_SESSION['scriptcase']['charset']);
                  $Tipo_filter[1] = sc_convert_encoding($Tipo_filter[1], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter  = $Tipo_filter[1];
                  $Opt_filter .= "<option value=\"\">" .  grid_aereopar_rsvp_r_pack_protect_string($Nome_filter) . "</option>\r\n";
              }
              $Opt_filter .= "<option value=\"" . grid_aereopar_rsvp_r_pack_protect_string($Tipo_filter[0]) . "\">.." . grid_aereopar_rsvp_r_pack_protect_string($Cada_filter) .  "</option>\r\n";
          }
          if (isset($nmgp_save_origem) && $nmgp_save_origem == "grid")
          {
              $Ajax_select  = "<SELECT id=\"id_sel_recup_filters\" class=\"scFilterToolbar_obj\" name=\"sel_recup_filters\" onChange=\"nm_change_grid_search(this)\" size=\"1\">\r\n";
              $Ajax_select .= $Opt_filter;
              $Ajax_select .= "</SELECT>\r\n";
              $this->Arr_result['setValue'][] = array('field' => "id_NM_filters_save", 'value' => $Ajax_select);
              $Ajax_select = "<SELECT id=\"sel_filters_del\" class=\"scFilterToolbar_obj\" name=\"NM_filters_del\" size=\"1\">\r\n";
              $Ajax_select .= $Opt_filter;
              $Ajax_select .= "</SELECT>\r\n";
              $this->Arr_result['setValue'][] = array('field' => "id_sel_filters_del", 'value' => $Ajax_select);
              return;
          }
          $Ajax_select  = "<SELECT id=\"sel_recup_filters_bot\" class=\"scFilterToolbar_obj\" style=\"display:". (count($this->NM_fil_ant)>0?'':'none') .";\" name=\"NM_filters_bot\" onChange=\"nm_submit_filter(this, 'bot');\" size=\"1\">\r\n";
          $Ajax_select .= $Opt_filter;
          $Ajax_select .= "</SELECT>\r\n";
          $this->Arr_result['setValue'][] = array('field' => "idAjaxSelect_NM_filters_bot", 'value' => $Ajax_select);
          $Ajax_select = "<SELECT id=\"sel_filters_del_bot\" class=\"scFilterToolbar_obj\" name=\"NM_filters_del_bot\" size=\"1\">\r\n";
          $Ajax_select .= $Opt_filter;
          $Ajax_select .= "</SELECT>\r\n";
          $this->Arr_result['setValue'][] = array('field' => "idAjaxSelect_NM_filters_del_bot", 'value' => $Ajax_select);
      }
      if ($this->NM_ajax_opcao == "ajax_filter_select")
      {
          ob_end_clean();
          ob_end_clean();
          $this->Arr_result = $this->recupera_filtro($NM_filters, "pesq");
      }

      if ($this->NM_ajax_opcao == 'autocomp_participante_cpf')
      {
          $participante_cpf = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_participante_cpf($participante_cpf);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
      if ($this->NM_ajax_opcao == 'autocomp_participante_nome')
      {
          $participante_nome = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_participante_nome($participante_nome);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
      if ($this->NM_ajax_opcao == 'autocomp_tipo_pessoa')
      {
          $tipo_pessoa = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_tipo_pessoa($tipo_pessoa);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
      if ($this->NM_ajax_opcao == 'autocomp_cia_aerea')
      {
          $cia_aerea = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_cia_aerea($cia_aerea);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
      if ($this->NM_ajax_opcao == 'autocomp_voo')
      {
          $voo = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_voo($voo);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
      if ($this->NM_ajax_opcao == 'autocomp_direcao')
      {
          $direcao = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_direcao($direcao);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
      if ($this->NM_ajax_opcao == 'autocomp_origem')
      {
          $origem = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_origem($origem);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
      if ($this->NM_ajax_opcao == 'autocomp_destino')
      {
          $destino = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_destino($destino);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
      if ($this->NM_ajax_opcao == 'autocomp_localizador')
      {
          $localizador = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_localizador($localizador);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
      if ($this->NM_ajax_opcao == 'autocomp_etkt')
      {
          $etkt = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_etkt($etkt);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
      if ($this->NM_ajax_opcao == 'autocomp_emitida_bvt')
      {
          $emitida_bvt = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_emitida_bvt($emitida_bvt);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
      if ($this->NM_ajax_opcao == 'autocomp_bloqueio_dsc')
      {
          $bloqueio_dsc = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_bloqueio_dsc($bloqueio_dsc);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
      if ($this->NM_ajax_opcao == 'autocomp_nota_gate')
      {
          $nota_gate = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_nota_gate($nota_gate);
          ob_end_clean();
          ob_end_clean();
          $count_aut_comp = 0;
          $resp_aut_comp  = array();
          foreach ($nmgp_def_dados as $Ind => $Lista)
          {
             if (is_array($Lista))
             {
                 foreach ($Lista as $Cod => $Valor)
                 {
                     if ($_GET['cod_desc'] == "S")
                     {
                         $Valor = $Cod . " - " . $Valor;
                     }
                     $resp_aut_comp[] = array('label' => $Valor , 'value' => $Cod);
                     $count_aut_comp++;
                 }
             }
             if ($count_aut_comp == $_GET['max_itens'])
             {
                 break;
             }
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($resp_aut_comp);
          $this->Db->Close(); 
          exit;
      }
   }
   function lookup_ajax_participante_cpf($participante_cpf)
   {
      $participante_cpf = substr($this->Db->qstr($participante_cpf), 1, -1);
            $participante_cpf_look = (is_string($participante_cpf) ? substr($this->Db->qstr($participante_cpf), 1, -1) : $participante_cpf); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct participante_cpf from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#participante_cpf#lowerF# like #lowerI#'%" . $participante_cpf . "%'#lowerF# order by participante_cpf"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   
   function lookup_ajax_participante_nome($participante_nome)
   {
      $participante_nome = substr($this->Db->qstr($participante_nome), 1, -1);
            $participante_nome_look = (is_string($participante_nome) ? substr($this->Db->qstr($participante_nome), 1, -1) : $participante_nome); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct participante_nome from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#participante_nome#lowerF# like #lowerI#'%" . $participante_nome . "%'#lowerF# order by participante_nome"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   
   function lookup_ajax_tipo_pessoa($tipo_pessoa)
   {
      $tipo_pessoa = substr($this->Db->qstr($tipo_pessoa), 1, -1);
            $tipo_pessoa_look = (is_string($tipo_pessoa) ? substr($this->Db->qstr($tipo_pessoa), 1, -1) : $tipo_pessoa); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tipo_pessoa from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#tipo_pessoa#lowerF# like #lowerI#'%" . $tipo_pessoa . "%'#lowerF# order by tipo_pessoa"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   
   function lookup_ajax_cia_aerea($cia_aerea)
   {
      $cia_aerea = substr($this->Db->qstr($cia_aerea), 1, -1);
            $cia_aerea_look = (is_string($cia_aerea) ? substr($this->Db->qstr($cia_aerea), 1, -1) : $cia_aerea); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct cia_aerea from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#cia_aerea#lowerF# like #lowerI#'%" . $cia_aerea . "%'#lowerF# order by cia_aerea"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   
   function lookup_ajax_voo($voo)
   {
      $voo = substr($this->Db->qstr($voo), 1, -1);
            $voo_look = (is_string($voo) ? substr($this->Db->qstr($voo), 1, -1) : $voo); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct voo from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#voo#lowerF# like #lowerI#'%" . $voo . "%'#lowerF# order by voo"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   
   function lookup_ajax_direcao($direcao)
   {
      $direcao = substr($this->Db->qstr($direcao), 1, -1);
            $direcao_look = (is_string($direcao) ? substr($this->Db->qstr($direcao), 1, -1) : $direcao); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct direcao from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#direcao#lowerF# like #lowerI#'%" . $direcao . "%'#lowerF# order by direcao"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   
   function lookup_ajax_origem($origem)
   {
      $origem = substr($this->Db->qstr($origem), 1, -1);
            $origem_look = (is_string($origem) ? substr($this->Db->qstr($origem), 1, -1) : $origem); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct origem from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#origem#lowerF# like #lowerI#'%" . $origem . "%'#lowerF# order by origem"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   
   function lookup_ajax_destino($destino)
   {
      $destino = substr($this->Db->qstr($destino), 1, -1);
            $destino_look = (is_string($destino) ? substr($this->Db->qstr($destino), 1, -1) : $destino); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct destino from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#destino#lowerF# like #lowerI#'%" . $destino . "%'#lowerF# order by destino"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   
   function lookup_ajax_localizador($localizador)
   {
      $localizador = substr($this->Db->qstr($localizador), 1, -1);
            $localizador_look = (is_string($localizador) ? substr($this->Db->qstr($localizador), 1, -1) : $localizador); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct localizador from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#localizador#lowerF# like #lowerI#'%" . $localizador . "%'#lowerF# order by localizador"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   
   function lookup_ajax_etkt($etkt)
   {
      $etkt = substr($this->Db->qstr($etkt), 1, -1);
            $etkt_look = (is_string($etkt) ? substr($this->Db->qstr($etkt), 1, -1) : $etkt); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct etkt from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#etkt#lowerF# like #lowerI#'%" . $etkt . "%'#lowerF# order by etkt"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   
   function lookup_ajax_emitida_bvt($emitida_bvt)
   {
      $emitida_bvt = substr($this->Db->qstr($emitida_bvt), 1, -1);
            $emitida_bvt_look = (is_string($emitida_bvt) ? substr($this->Db->qstr($emitida_bvt), 1, -1) : $emitida_bvt); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct emitida_bvt from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#emitida_bvt#lowerF# like #lowerI#'%" . $emitida_bvt . "%'#lowerF# order by emitida_bvt"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   
   function lookup_ajax_bloqueio_dsc($bloqueio_dsc)
   {
      $bloqueio_dsc = substr($this->Db->qstr($bloqueio_dsc), 1, -1);
            $bloqueio_dsc_look = (is_string($bloqueio_dsc) ? substr($this->Db->qstr($bloqueio_dsc), 1, -1) : $bloqueio_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct bloqueio_dsc from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#bloqueio_dsc#lowerF# like #lowerI#'%" . $bloqueio_dsc . "%'#lowerF# order by bloqueio_dsc"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   
   function lookup_ajax_nota_gate($nota_gate)
   {
      $nota_gate = substr($this->Db->qstr($nota_gate), 1, -1);
            $nota_gate_look = (is_string($nota_gate) ? substr($this->Db->qstr($nota_gate), 1, -1) : $nota_gate); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct nota_gate from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#nota_gate#lowerF# like #lowerI#'%" . $nota_gate . "%'#lowerF# order by nota_gate"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

      return $nmgp_def_dados;
   }
   

   /**
    * @access  public
    */
   function processa_busca()
   {
      $this->inicializa_vars();
      $this->trata_campos();
      $this->processa_campos();
      if ($this->NM_ajax_flag && ($this->NM_ajax_opcao == "ajax_grid_search" || $this->NM_ajax_opcao == "ajax_grid_search_change_fil"))
      {
          $this->finaliza_resultado_ajax();
          return;
      }
      if (!empty($this->Campos_Mens_erro)) 
      {
          $this->monta_formulario();
      }
      else
      {
          $this->finaliza_resultado();
      }
   }

   /**
    * @access  public
    */
   function and_or()
   {
      $posWhere = strpos(strtolower($this->comando), "where");
      if (FALSE === $posWhere)
      {
         $this->comando     .= " where (";
         $this->comando_sum .= " and (";
         $this->comando_fim  = " ) ";
      }
      if ($this->comando_ini == "ini")
      {
          if (FALSE !== $posWhere)
          {
              $this->comando     .= " and ( ";
              $this->comando_sum .= " and ( ";
              $this->comando_fim  = " ) ";
          }
         $this->comando_ini  = "";
      }
      elseif ("or" == $this->NM_operador)
      {
         $this->comando        .= " or ";
         $this->comando_sum    .= " or ";
         $this->comando_filtro .= " or ";
      }
      else
      {
         $this->comando        .= " and ";
         $this->comando_sum    .= " and ";
         $this->comando_filtro .= " and ";
      }
   }

   /**
    * @access  public
    * @param  string  $nome  
    * @param  string  $condicao  
    * @param  mixed  $campo  
    * @param  mixed  $campo2  
    * @param  string  $nome_campo  
    * @param  string  $tp_campo  
    * @global  array  $nmgp_tab_label  
    */
   function monta_condicao($nome, $condicao, $campo, $campo2 = "", $nome_campo="", $tp_campo="", $tp_unaccent=false)
   {
      global $nmgp_tab_label;
      $condicao   = strtoupper($condicao);
      $nm_aspas   = "'";
      $nm_aspas1  = "'";
      $Nm_numeric = array();
      $nm_esp_postgres = array();
      $nm_ini_lower = " #lowerI#";
      $nm_fim_lower = "#lowerF#";
      $Nm_accent = $this->Ini->Nm_accent_no;
      if ($tp_unaccent) {
          $Nm_accent = $this->Ini->Nm_accent_yes;
      }
      $Nm_numeric[] = "id_aereopar";$Nm_numeric[] = "id_evento";$Nm_numeric[] = "cod_cia_aerea";$Nm_numeric[] = "bloqueio";$Nm_numeric[] = "id_usuario_relato";$Nm_numeric[] = "usado_bloqueio";$Nm_numeric[] = "total_bloqueio";
      $campo_join = strtolower(str_replace(".", "_", $nome));
      if (in_array($campo_join, $Nm_numeric))
      {
          if ($condicao == "EP" || $condicao == "NE")
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$campo_join]);
              return;
          }
         $nm_ini_lower = "";
         $nm_fim_lower = "";
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['decimal_db'] == ".")
         {
            $nm_aspas  = "";
            $nm_aspas1 = "";
         }
         if ($condicao != "IN")
         {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['decimal_db'] == ".")
            {
               $campo  = str_replace(",", ".", $campo);
               $campo2 = str_replace(",", ".", $campo2);
            }
         }
      }
      $Nm_datas[] = 'data_saida';$Nm_datas[] = 'data_chegada';$Nm_datas[] = 'hora_saida';$Nm_datas[] = 'hora_chegada';$Nm_datas[] = 'data_nota_gate';
      if (in_array($nome, $Nm_datas))
      {
         $nm_ini_lower = "";
         $nm_fim_lower = "";
      }
      if (in_array($campo_join, $Nm_datas))
      {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
             $nm_aspas  = "#";
             $nm_aspas1 = "#";
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['SC_sep_date']))
          {
              $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['SC_sep_date'];
              $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['SC_sep_date1'];
          }
      }
      if ($campo == "" && $condicao != "NU" && $condicao != "NN" && $condicao != "EP" && $condicao != "NE")
      {
         return;
      }
      else
      {
         $tmp_pos = (is_string($campo)) ? strpos($campo, "##@@") : false;
         if ($tmp_pos === false)
         {
             $res_lookup = $campo;
         }
         else
         {
             $res_lookup = substr($campo, $tmp_pos + 4);
             $campo = substr($campo, 0, $tmp_pos);
             if ($campo == "" && $condicao != "NU" && $condicao != "NN" && $condicao != "EP" && $condicao != "NE")
             {
                 return;
             }
         }
         $tmp_pos = (is_string($this->cmp_formatado[$nome_campo])) ? strpos($this->cmp_formatado[$nome_campo], "##@@") : false;
         if ($tmp_pos !== false)
         {
             $this->cmp_formatado[$nome_campo] = substr($this->cmp_formatado[$nome_campo], $tmp_pos + 4);
         }
         $this->and_or();
         $campo  = substr($this->Db->qstr($campo), 1, -1);
         $campo2 = substr($this->Db->qstr($campo2), 1, -1);
         $nome_sum = "aereopar_rsvp_r.$nome";
         if ($tp_campo == "TIMESTAMP")
         {
             $tp_campo = "DATETIME";
         }
         if (in_array($campo_join, $Nm_numeric) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && ($condicao == "II" || $condicao == "QP" || $condicao == "NP"))
         {
             $nome     = "CAST ($nome AS TEXT)";
             $nome_sum = "CAST ($nome_sum AS TEXT)";
         }
         if (in_array($campo_join, $nm_esp_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
         {
             $nome     = "CAST ($nome AS TEXT)";
             $nome_sum = "CAST ($nome_sum AS TEXT)";
         }
         if (substr($tp_campo, 0, 8) == "DATETIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && !$this->Date_part)
         {
             if (in_array($condicao, array('II','QP','NP','IN','EP','NE'))) {
                 $nome     = "to_char ($nome, 'YYYY-MM-DD hh24:mi:ss')";
                 $nome_sum = "to_char ($nome_sum, 'YYYY-MM-DD hh24:mi:ss')";
             }
         }
         elseif (substr($tp_campo, 0, 4) == "DATE" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && !$this->Date_part)
         {
             if (in_array($condicao, array('II','QP','NP','IN','EP','NE'))) {
                 $nome     = "to_char ($nome, 'YYYY-MM-DD')";
                 $nome_sum = "to_char ($nome_sum, 'YYYY-MM-DD')";
             }
         }
         elseif (substr($tp_campo, 0, 4) == "TIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && !$this->Date_part)
         {
             if (in_array($condicao, array('II','QP','NP','IN','EP','NE'))) {
                 $nome     = "to_char ($nome, 'hh24:mi:ss')";
                 $nome_sum = "to_char ($nome_sum, 'hh24:mi:ss')";
             }
         }
         if (in_array($campo_join, $Nm_numeric) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase) && ($condicao == "II" || $condicao == "QP" || $condicao == "NP"))
         {
             $nome     = "CAST ($nome AS VARCHAR)";
             $nome_sum = "CAST ($nome_sum AS VARCHAR)";
         }
         if ($tp_campo == "DATE" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql) && !$this->Date_part)
         {
             if (in_array($condicao, array('II','QP','NP','IN','EP','NE'))) {
                 $nome     = "convert(char(10),$nome,121)";
                 $nome_sum = "convert(char(10),$nome_sum,121)";
             }
         }
         if ($tp_campo == "DATETIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql) && !$this->Date_part)
         {
             if (in_array($condicao, array('II','QP','NP','IN','EP','NE'))) {
                 $nome     = "convert(char(19),$nome,121)";
                 $nome_sum = "convert(char(19),$nome_sum,121)";
             }
         }
         if (substr($tp_campo, 0, 8) == "DATETIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle) && !$this->Date_part)
         {
             $nome     = "TO_DATE(TO_CHAR($nome, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss')";
             $nome_sum = "TO_DATE(TO_CHAR($nome_sum, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss')";
             $tp_campo = "DATETIME";
         }
         if (substr($tp_campo, 0, 8) == "DATETIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix) && !$this->Date_part)
         {
             $nome     = "EXTEND($nome, YEAR TO FRACTION)";
             $nome_sum = "EXTEND($nome_sum, YEAR TO FRACTION)";
         }
         elseif (substr($tp_campo, 0, 4) == "DATE" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix) && !$this->Date_part)
         {
             $nome     = "EXTEND($nome, YEAR TO DAY)";
             $nome_sum = "EXTEND($nome_sum, YEAR TO DAY)";
         }
         if (in_array($campo_join, $Nm_numeric) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress) && ($condicao == "II" || $condicao == "QP" || $condicao == "NP"))
         {
             $nome     = "CAST ($nome AS VARCHAR(255))";
             $nome_sum = "CAST ($nome_sum AS VARCHAR(255))";
         }
         if (substr($tp_campo, 0, 8) == "DATETIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress) && !$this->Date_part)
         {
             if (in_array($condicao, array('II','QP','NP','IN','EP','NE'))) {
                 $nome     = "to_char ($nome, 'YYYY-MM-DD hh24:mi:ss')";
                 $nome_sum = "to_char ($nome_sum, 'YYYY-MM-DD hh24:mi:ss')";
             }
         }
         if (substr($tp_campo, 0, 4) == "DATE" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress) && !$this->Date_part)
         {
             if (in_array($condicao, array('II','QP','NP','IN','EP','NE'))) {
                 $nome     = "to_char ($nome, 'YYYY-MM-DD')";
                 $nome_sum = "to_char ($nome_sum, 'YYYY-MM-DD')";
             }
         }
         switch ($condicao)
         {
            case "EQ":     // 
               $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " = " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . " = " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower. " = " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_equl'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "AW";     // Any of the words (arguments) 
            case "NW";     // None of the Words (arguments) 
               if ($condicao == "AW") {
                   $lang_like = $this->Ini->Nm_lang['lang_srch_like'];
               }
               else {
                   $lang_like = $this->Ini->Nm_lang['lang_srch_not_like'];
               }
               $prim  = true;
               $args  = explode(" ", $campo);
               $campo = "";
               foreach ($args as $cada_args) {
                   if (empty($cada_args)) {
                       continue;
                   }
                   $campo .= ($prim) ? "" : " ";
                   $campo .= $cada_args;
                   $prim = false;
               }
               if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql)) {
                   $op_all = ($condicao == "AW") ? " REGEXP " : " NOT REGEXP ";
                   $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . $op_all . $nm_ini_lower . "'" . str_replace(" ","|",$campo) . "'" . $nm_fim_lower;
                   $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . $op_all . $nm_ini_lower . "'" . str_replace(" ","|",$campo) . "'" . $nm_fim_lower;
                   $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower . $op_all . $nm_ini_lower . "'" . str_replace(" ","|",$campo) . "'" . $nm_fim_lower;
               }
               elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres)) {
                   $op_all = ($condicao == "AW") ? " ~ " : " !~ ";
                   $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . $op_all . $nm_ini_lower . "'" . str_replace(" ","|",$campo) . "'" . $nm_fim_lower;
                   $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . $op_all . $nm_ini_lower . "'" . str_replace(" ","|",$campo) . "'" . $nm_fim_lower;
                   $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower . $op_all . $nm_ini_lower . "'" . str_replace(" ","|",$campo) . "'" . $nm_fim_lower;
               }
               elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2)) {
                   $op_all = ($condicao == "AW") ? " REGEXP_LIKE " : " NOT REGEXP_LIKE ";
                   $this->comando        .= $op_all . "(" . $nm_ini_lower . $nome . $nm_fim_lower . ", " . $nm_ini_lower . "'" . str_replace(" ","|",$campo) . "'" . $nm_fim_lower . ")";
                   $this->comando_sum    .= $op_all . "(" . $nm_ini_lower . $nome_sum . $nm_fim_lower . ", " . $nm_ini_lower . "'" . str_replace(" ","|",$campo) . "'" . $nm_fim_lower . ")";
                   $this->comando_filtro .= $op_all . "(" . $nm_ini_lower . $nome . $nm_fim_lower . ", " . $nm_ini_lower . "'" . str_replace(" ","|",$campo) . "'" . $nm_fim_lower . ")";
               }
               elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress)) {
                   $op_all = ($condicao == "AW") ? " MATCHES " : " NOT MATCHES ";
                   $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . $op_all . $nm_ini_lower . "'" . str_replace(" ","|",$campo) . "'" . $nm_fim_lower;
                   $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . $op_all . $nm_ini_lower . "'" . str_replace(" ","|",$campo) . "'" . $nm_fim_lower;
                   $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower . $op_all . $nm_ini_lower . "'" . str_replace(" ","|",$campo) . "'" . $nm_fim_lower;
               }
               elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase)) {
                   $op_all = ($condicao == "AW") ? " SIMILAR TO " : " NOT SIMILAR TO ";
                   $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . $op_all . $nm_ini_lower . "'%(" . str_replace(" ","|",$campo) . ")%'" . $nm_fim_lower;
                   $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . $op_all . $nm_ini_lower . "'%(" . str_replace(" ","|",$campo) . ")%'" . $nm_fim_lower;
                   $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower . $op_all . $nm_ini_lower . "'%(" . str_replace(" ","|",$campo) . ")%'" . $nm_fim_lower;
               }
               elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_vfp)) {
                   $op_all = ($condicao == "AW") ? " $ " : " !$ ";
                   $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . $op_all . $nm_ini_lower . "'" . str_replace(" ","|",$campo) . "'" . $nm_fim_lower;
                   $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . $op_all . $nm_ini_lower . "'" . str_replace(" ","|",$campo) . "'" . $nm_fim_lower;
                   $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower . $op_all . $nm_ini_lower . "'" . str_replace(" ","|",$campo) . "'" . $nm_fim_lower;
               }
               else {
                   $op_all = ($condicao == "AW") ? " LIKE " : " NOT LIKE ";
                   $liga   = ($condicao == "AW") ? " OR " : " AND ";
                   $perc   = "%";
                   $prim   = true;
                   $args   = explode(" ", $campo);
                   foreach ($args as $cada_args) {
                       if (!$prim) {
                           $this->comando        .= $liga;
                           $this->comando_sum    .= $liga;
                           $this->comando_filtro .= $liga;
                       }
                       $prim = false;
                       $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . $op_all . $nm_ini_lower . "'" . $perc . $cada_args . $perc . "'" . $nm_fim_lower;
                       $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . $op_all . $nm_ini_lower . "'" . $perc . $cada_args . $perc . "'" . $nm_fim_lower;
                       $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower . $op_all . $nm_ini_lower . "'" . $perc . $cada_args . $perc . "'" . $nm_fim_lower;
                   }
               }
               if ($condicao == "AW") {
                   $Conect_msg = " " . strtolower($this->Ini->Nm_lang['lang_srch_orr_cond']) . " ";
               }
               elseif ($condicao == "NW") {
                   $Conect_msg = " " . strtolower($this->Ini->Nm_lang['lang_srch_and_cond']) . " ";
               }
               else {
                   $Conect_msg = ", ";
               }
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $lang_like . " (" . str_replace(" ",$Conect_msg,$this->cmp_formatado[$nome_campo]) . ")##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $lang_like . " (" . str_replace(" ",$Conect_msg,$this->cmp_formatado[$nome_campo]) . ")";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['hint']  = $nmgp_tab_label[$nome_campo] . ": " . $lang_like . " (" . str_replace(" ",$Conect_msg,$this->cmp_formatado[$nome_campo]) . ")";
            break;
            case "II":     // 
               if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && $this->NM_case_insensitive)
               {
                   $op_all       = " ilike ";
                   $nm_ini_lower = "";
                   $nm_fim_lower = "";
               }
               else
               {
                   $op_all = " like ";
               }
               $this->comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_all . $nm_ini_lower . "'" . $Nm_accent['arg_i'] . sc_sql_escape($this->Ini->nm_tpbanco, $campo) . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'] . $_SESSION['sc_session']['sc_sql_escape'];
               $this->comando_sum    .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome_sum . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_all . $nm_ini_lower . "'" . $Nm_accent['arg_i'] . sc_sql_escape($this->Ini->nm_tpbanco, $campo) . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'] . $_SESSION['sc_session']['sc_sql_escape'];
               $this->comando_filtro .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_all . $nm_ini_lower . "'" . $Nm_accent['arg_i'] . sc_sql_escape($this->Ini->nm_tpbanco, $campo) . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'] . $_SESSION['sc_session']['sc_sql_escape'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_strt'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_strt'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_strt'] . " " . $this->cmp_formatado[$nome_campo];
            break;
             case "QP";     // 
             case "NP";     // 
                $concat = " " . $this->NM_operador . " ";
                if ($condicao == "QP")
                {
                    $op_all    = " #sc_like_# ";
                    $lang_like = $this->Ini->Nm_lang['lang_srch_like'];
                }
                else
                {
                    $op_all    = " not #sc_like_# ";
                    $lang_like = $this->Ini->Nm_lang['lang_srch_not_like'];
                }
               $NM_cond    = "";
               $NM_cmd     = "";
               $NM_cmd_sum = "";
               if (substr($tp_campo, 0, 4) == "DATE" && $this->Date_part)
               {
                   if ($this->NM_data_qp['ano'] != "____")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_year'] . " " . $this->Lang_date_part . " '##ini##" . $this->NM_data_qp['ano'] . "##fim##'";
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%Y', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%Y', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(year from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(year from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'YYYY') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'YYYY') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= $this->Ini_date_char . "extract('year' from " . $nome . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                               $NM_cmd_sum .= $this->Ini_date_char . "extract('year' from " . $nome_sum . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           }
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                       {
                           $NM_cmd     .= "extract(year from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(year from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                       {
                           $NM_cmd     .= "TO_CHAR(" . $nome . ", 'YYYY')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "TO_CHAR(" . $nome_sum . ", 'YYYY')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                       {
                           $NM_cmd     .= "DATEPART(year, " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "DATEPART(year, " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'YYYY') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'YYYY') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= "year (" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                               $NM_cmd_sum .= "year (" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           }
                       }
                       else
                       {
                           $NM_cmd     .= "year(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                           $NM_cmd_sum .= "year(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                       }
                   }
                   if ($this->NM_data_qp['mes'] != "__")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_mnth'] . " " . $this->Lang_date_part . " '##ini##" . $this->NM_data_qp['mes'] . "##fim##'";
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%m', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%m', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(month from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(month from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'MM') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'MM') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= $this->Ini_date_char . "extract('month' from " . $nome . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                               $NM_cmd_sum .= $this->Ini_date_char . "extract('month' from " . $nome_sum . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           }
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                       {
                           $NM_cmd     .= "extract(month from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(month from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                       {
                           $NM_cmd     .= "TO_CHAR(" . $nome . ", 'MM')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "TO_CHAR(" . $nome_sum . ", 'MM')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                       {
                           $NM_cmd     .= "DATEPART(month, " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "DATEPART(month, " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'MM') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'MM') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= "month (" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                               $NM_cmd_sum .= "month (" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           }
                       }
                       else
                       {
                           $NM_cmd     .= "month(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                           $NM_cmd_sum .= "month(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                       }
                   }
                   if ($this->NM_data_qp['dia'] != "__")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_days'] . " " . $this->Lang_date_part . " '##ini##" . $this->NM_data_qp['dia'] . "##fim##'";
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%d', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%d', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(day from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(day from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'DD') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'DD') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= $this->Ini_date_char . "extract('day' from " . $nome . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                               $NM_cmd_sum .= $this->Ini_date_char . "extract('day' from " . $nome_sum . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           }
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                       {
                           $NM_cmd     .= "extract(day from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(day from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                       {
                           $NM_cmd     .= "TO_CHAR(" . $nome . ", 'DD')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "TO_CHAR(" . $nome_sum . ", 'DD')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                       {
                           $NM_cmd     .= "DATEPART(day, " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "DATEPART(day, " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'DD') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'DD') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= "DAYOFMONTH(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                               $NM_cmd_sum .= "DAYOFMONTH(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           }
                       }
                       else
                       {
                           $NM_cmd     .= "day(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                           $NM_cmd_sum .= "day(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                       }
                   }
               }
               if (strpos($tp_campo, "TIME") !== false && $this->Date_part)
               {
                   if ($this->NM_data_qp['hor'] != "__")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_time'] . " " . $this->Lang_date_part . " '##ini##" . $this->NM_data_qp['hor'] . "##fim##'";
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%H', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%H', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(hour from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(hour from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'hh24') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'hh24') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= $this->Ini_date_char . "extract('hour' from " . $nome . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                               $NM_cmd_sum .= $this->Ini_date_char . "extract('hour' from " . $nome_sum . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           }
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                       {
                           $NM_cmd     .= "extract(hour from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(hour from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                       {
                           $NM_cmd     .= "TO_CHAR(" . $nome . ", 'HH24')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "TO_CHAR(" . $nome_sum . ", 'HH24')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                       {
                           $NM_cmd     .= "DATEPART(hour, " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "DATEPART(hour, " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'hh24') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'hh24') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= "hour(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                               $NM_cmd_sum .= "hour(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           }
                       }
                       else
                       {
                           $NM_cmd     .= "hour(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                           $NM_cmd_sum .= "hour(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                       }
                   }
                   if ($this->NM_data_qp['min'] != "__")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_mint'] . " " . $this->Lang_date_part . " '##ini##" . $this->NM_data_qp['min'] . "##fim##'";
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%M', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%M', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(minute from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(minute from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'mi') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'mi') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= $this->Ini_date_char . "extract('minute' from " . $nome . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                               $NM_cmd_sum .= $this->Ini_date_char . "extract('minute' from " . $nome_sum . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           }
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                       {
                           $NM_cmd     .= "extract(minute from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(minute from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                       {
                           $NM_cmd     .= "TO_CHAR(" . $nome . ", 'MI')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "TO_CHAR(" . $nome_sum . ", 'MI')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                       {
                           $NM_cmd     .= "DATEPART(minute, " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "DATEPART(minute, " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'mi') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'mi') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= "minute(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                               $NM_cmd_sum .= "minute(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           }
                       }
                       else
                       {
                           $NM_cmd     .= "minute(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                           $NM_cmd_sum .= "minute(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                       }
                   }
                   if ($this->NM_data_qp['seg'] != "__")
                   {
                       $NM_cond    .= (empty($NM_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                       $NM_cond    .= $this->Ini->Nm_lang['lang_srch_scnd'] . " " . $this->Lang_date_part . " '##ini##" . $this->NM_data_qp['seg'] . "##fim##'";
                       $NM_cmd     .= (empty($NM_cmd)) ? "" : $concat;
                       $NM_cmd_sum .= (empty($NM_cmd_sum)) ? "" : $concat;
                       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                       {
                           $NM_cmd     .= "strftime('%S', " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "strftime('%S', " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                       {
                           $NM_cmd     .= "extract(second from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(second from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'ss') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'ss') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= $this->Ini_date_char . "extract('second' from " . $nome . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                               $NM_cmd_sum .= $this->Ini_date_char . "extract('second' from " . $nome_sum . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           }
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                       {
                           $NM_cmd     .= "extract(second from " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "extract(second from " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                       {
                           $NM_cmd     .= "TO_CHAR(" . $nome . ", 'SS')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "TO_CHAR(" . $nome_sum . ", 'SS')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                       {
                           $NM_cmd     .= "DATEPART(second, " . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "DATEPART(second, " . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                       elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
                       {
                           if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                           {
                               $NM_cmd     .= "to_char (" . $nome . ", 'ss') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                               $NM_cmd_sum .= "to_char (" . $nome_sum . ", 'ss') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           }
                           else
                           {
                               $NM_cmd     .= "second(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                               $NM_cmd_sum .= "second(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           }
                       }
                       else
                       {
                           $NM_cmd     .= "second(" . $nome . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                           $NM_cmd_sum .= "second(" . $nome_sum . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                       }
                   }
               }
               if ($this->Date_part)
               {
                   if (!empty($NM_cmd))
                   {
                       $NM_cmd     = " (" . $NM_cmd . ")";
                       $NM_cmd_sum = " (" . $NM_cmd_sum . ")";
                       $this->comando        .= $NM_cmd;
                       $this->comando_sum    .= $NM_cmd_sum;
                       $this->comando_filtro .= $NM_cmd;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . ":</span> " . str_replace(array("##ini##","##fim##"), array("<span class='scGridFilterDynValue'>","</span>"),$NM_cond) . "##*@@";
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
                       $NM_cond = str_replace(array("##ini##","##fim##"), array("",""),$NM_cond);
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $NM_cond;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $NM_cond;
                   }
               }
               else
               {
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && $this->NM_case_insensitive)
                   {
                       $op_all       = str_replace("#sc_like_#", "ilike", $op_all);
                       $nm_ini_lower = "";
                       $nm_fim_lower = "";
                   }
                   else
                   {
                       $op_all = str_replace("#sc_like_#", "like", $op_all);
                   }
                   $this->comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_all . $nm_ini_lower . "'%" . $Nm_accent['arg_i'] . sc_sql_escape($this->Ini->nm_tpbanco, $campo) . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'] . $_SESSION['sc_session']['sc_sql_escape'];
                   $this->comando_sum    .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome_sum . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_all . $nm_ini_lower . "'%" . $Nm_accent['arg_i'] . sc_sql_escape($this->Ini->nm_tpbanco, $campo) . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'] . $_SESSION['sc_session']['sc_sql_escape'];
                   $this->comando_filtro .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_all . $nm_ini_lower . "'%" . $Nm_accent['arg_i'] . sc_sql_escape($this->Ini->nm_tpbanco, $campo) . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'] . $_SESSION['sc_session']['sc_sql_escape'];
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $lang_like . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $lang_like . " " . $this->cmp_formatado[$nome_campo];
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $lang_like . " " . $this->cmp_formatado[$nome_campo];
               }
            break;
            case "DF":     // 
               $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_diff'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_diff'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_diff'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "GT":     // 
               $this->comando        .= " $nome > " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum > " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome > " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_grtr'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "GE":     // 
               $this->comando        .= " $nome >= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum >= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome >= " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "LT":     // 
               $this->comando        .= " $nome < " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum < " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome < " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_less'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "LE":     // 
               $this->comando        .= " $nome <= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum <= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome <= " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_less_equl'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less_equl'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less_equl'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "BW":     // 
               $this->comando        .= " $nome between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $this->comando_filtro .= " $nome between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_betw'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo] . " </span>" . $this->Ini->Nm_lang['lang_srch_and_cond'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo . "_input_2"] . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_betw'] . " " . $this->cmp_formatado[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " " . $this->cmp_formatado[$nome_campo . "_input_2"];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_betw'] . " " . $this->cmp_formatado[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " " . $this->cmp_formatado[$nome_campo . "_input_2"];
            break;
            case "IN":     // 
               $nm_sc_valores = explode(",", $campo);
               $cond_str  = "";
               $nm_cond   = "";
               $cond_descr  = "";
               $count_descr = 0;
               $end_descr   = false;
               $lim_descr   = 15;
               $lang_descr  = strlen($this->Ini->Nm_lang['lang_srch_orr_cond']);
               if (!empty($nm_sc_valores))
               {
                   foreach ($nm_sc_valores as $nm_sc_valor)
                   {
                      if (in_array($campo_join, $Nm_numeric) && substr_count($nm_sc_valor, ".") > 1)
                      {
                         $nm_sc_valor = str_replace(".", "", $nm_sc_valor);
                      }
                      if ("" != $cond_str)
                      {
                         $cond_str .= ",";
                         $nm_cond  .= " " . $this->Ini->Nm_lang['lang_srch_orr_cond'] . " ";
                      }
                      $cond_str .= $nm_ini_lower . $nm_aspas . $nm_sc_valor . $nm_aspas1 . $nm_fim_lower;
                      $nm_cond  .= $nm_aspas . $nm_sc_valor . $nm_aspas1;
                      if (((strlen($cond_descr) + strlen($nm_sc_valor) + $lang_descr) < $lim_descr) || empty($cond_descr))
                      {
                          $cond_descr .= (empty($cond_descr)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_orr_cond'] . " ";
                          $cond_descr .= $nm_aspas . $nm_sc_valor . $nm_aspas1;
                          $count_descr++;
                      }
                      elseif (!$end_descr)
                      {
                          $cond_descr .= " +" . (count($nm_sc_valores) - $count_descr);
                          $end_descr = true;
                      };
                   }
               }
               $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " in (" . $cond_str . ")";
               $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . " in (" . $cond_str . ")";
               $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower . " in (" . $cond_str . ")";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_equl'] . " <span class='scGridFilterDynValue'>" . $nm_cond . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $cond_descr;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $nm_cond;
            break;
            case "NU":     // 
               $this->comando        .= " $nome IS NULL ";
               $this->comando_sum    .= " $nome_sum IS NULL ";
               $this->comando_filtro .= " $nome IS NULL ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_null'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_null'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_null'];
            break;
            case "NN":     // 
               $this->comando        .= " $nome IS NOT NULL ";
               $this->comando_sum    .= " $nome_sum IS NOT NULL ";
               $this->comando_filtro .= " $nome IS NOT NULL ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_nnul'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nnul'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nnul'];
            break;
            case "EP":     // 
               $this->comando        .= " $nome = '' ";
               $this->comando_sum    .= " $nome_sum = '' ";
               $this->comando_filtro .= " $nome = '' ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_empty'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_empty'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_empty'];
            break;
            case "NE":     // 
               $this->comando        .= " $nome <> '' ";
               $this->comando_sum    .= " $nome_sum <> '' ";
               $this->comando_filtro .= " $nome <> '' ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_nempty'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nempty'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nempty'];
            break;
         }
      }
   }

   function nm_prep_date(&$val, $tp, $tsql, &$cond, $format_nd, $tp_nd)
   {
       $fill_dt = false;
       if ($tsql == "TIMESTAMP")
       {
           $tsql = "DATETIME";
       }
       $cond = strtoupper($cond);
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access) && $tp != "ND")
       {
           if ($cond == "EP")
           {
               $cond = "NU";
           }
           if ($cond == "NE")
           {
               $cond = "NN";
           }
       }
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql) && $tp != "ND")
       {
           if ($cond == "EP")
           {
               $cond = "NU";
           }
           if ($cond == "NE")
           {
               $cond = "NN";
           }
       }
       if ($cond == "NU" || $cond == "NN" || $cond == "EP" || $cond == "NE")
       {
           $val    = array();
           $val[0] = "";
           return;
       }
       if ($cond != "II" && $cond != "QP" && $cond != "NP")
       {
           $fill_dt = true;
       }
       if ($fill_dt)
       {
           $val[0]['dia'] = (!empty($val[0]['dia']) && strlen($val[0]['dia']) == 1) ? "0" . $val[0]['dia'] : $val[0]['dia'];
           $val[0]['mes'] = (!empty($val[0]['mes']) && strlen($val[0]['mes']) == 1) ? "0" . $val[0]['mes'] : $val[0]['mes'];
           if ($tp == "DH")
           {
               $val[0]['hor'] = (!empty($val[0]['hor']) && strlen($val[0]['hor']) == 1) ? "0" . $val[0]['hor'] : $val[0]['hor'];
               $val[0]['min'] = (!empty($val[0]['min']) && strlen($val[0]['min']) == 1) ? "0" . $val[0]['min'] : $val[0]['min'];
               $val[0]['seg'] = (!empty($val[0]['seg']) && strlen($val[0]['seg']) == 1) ? "0" . $val[0]['seg'] : $val[0]['seg'];
           }
           if ($cond == "BW")
           {
               $val[1]['dia'] = (!empty($val[1]['dia']) && strlen($val[1]['dia']) == 1) ? "0" . $val[1]['dia'] : $val[1]['dia'];
               $val[1]['mes'] = (!empty($val[1]['mes']) && strlen($val[1]['mes']) == 1) ? "0" . $val[1]['mes'] : $val[1]['mes'];
               if ($tp == "DH")
               {
                   $val[1]['hor'] = (!empty($val[1]['hor']) && strlen($val[1]['hor']) == 1) ? "0" . $val[1]['hor'] : $val[1]['hor'];
                   $val[1]['min'] = (!empty($val[1]['min']) && strlen($val[1]['min']) == 1) ? "0" . $val[1]['min'] : $val[1]['min'];
                   $val[1]['seg'] = (!empty($val[1]['seg']) && strlen($val[1]['seg']) == 1) ? "0" . $val[1]['seg'] : $val[1]['seg'];
               }
           }
       }
       if ($cond == "BW")
       {
           $this->NM_data_1 = array();
           $this->NM_data_1['ano'] = (isset($val[0]['ano']) && !empty($val[0]['ano'])) ? $val[0]['ano'] : "____";
           $this->NM_data_1['mes'] = (isset($val[0]['mes']) && !empty($val[0]['mes'])) ? $val[0]['mes'] : "__";
           $this->NM_data_1['dia'] = (isset($val[0]['dia']) && !empty($val[0]['dia'])) ? $val[0]['dia'] : "__";
           $this->NM_data_1['hor'] = (isset($val[0]['hor']) && !empty($val[0]['hor'])) ? $val[0]['hor'] : "__";
           $this->NM_data_1['min'] = (isset($val[0]['min']) && !empty($val[0]['min'])) ? $val[0]['min'] : "__";
           $this->NM_data_1['seg'] = (isset($val[0]['seg']) && !empty($val[0]['seg'])) ? $val[0]['seg'] : "__";
           $this->data_menor($this->NM_data_1);
           $this->NM_data_2 = array();
           $this->NM_data_2['ano'] = (isset($val[1]['ano']) && !empty($val[1]['ano'])) ? $val[1]['ano'] : "____";
           $this->NM_data_2['mes'] = (isset($val[1]['mes']) && !empty($val[1]['mes'])) ? $val[1]['mes'] : "__";
           $this->NM_data_2['dia'] = (isset($val[1]['dia']) && !empty($val[1]['dia'])) ? $val[1]['dia'] : "__";
           $this->NM_data_2['hor'] = (isset($val[1]['hor']) && !empty($val[1]['hor'])) ? $val[1]['hor'] : "__";
           $this->NM_data_2['min'] = (isset($val[1]['min']) && !empty($val[1]['min'])) ? $val[1]['min'] : "__";
           $this->NM_data_2['seg'] = (isset($val[1]['seg']) && !empty($val[1]['seg'])) ? $val[1]['seg'] : "__";
           $this->data_maior($this->NM_data_2);
           $val = array();
           if ($tp == "ND")
           {
               $out_dt1 = $format_nd;
               $out_dt1 = str_replace("yyyy", $this->NM_data_1['ano'], $out_dt1);
               $out_dt1 = str_replace("mm",   $this->NM_data_1['mes'], $out_dt1);
               $out_dt1 = str_replace("dd",   $this->NM_data_1['dia'], $out_dt1);
               $out_dt1 = str_replace("hh",   "", $out_dt1);
               $out_dt1 = str_replace("ii",   "", $out_dt1);
               $out_dt1 = str_replace("ss",   "", $out_dt1);
               $out_dt2 = $format_nd;
               $out_dt2 = str_replace("yyyy", $this->NM_data_2['ano'], $out_dt2);
               $out_dt2 = str_replace("mm",   $this->NM_data_2['mes'], $out_dt2);
               $out_dt2 = str_replace("dd",   $this->NM_data_2['dia'], $out_dt2);
               $out_dt2 = str_replace("hh",   "", $out_dt2);
               $out_dt2 = str_replace("ii",   "", $out_dt2);
               $out_dt2 = str_replace("ss",   "", $out_dt2);
               $val[0] = $out_dt1;
               $val[1] = $out_dt2;
               return;
           }
           if ($tsql == "TIME")
           {
               $val[0] = $this->NM_data_1['hor'] . ":" . $this->NM_data_1['min'] . ":" . $this->NM_data_1['seg'];
               $val[1] = $this->NM_data_2['hor'] . ":" . $this->NM_data_2['min'] . ":" . $this->NM_data_2['seg'];
           }
           elseif (substr($tsql, 0, 4) == "DATE")
           {
               $val[0] = $this->NM_data_1['ano'] . "-" . $this->NM_data_1['mes'] . "-" . $this->NM_data_1['dia'];
               $val[1] = $this->NM_data_2['ano'] . "-" . $this->NM_data_2['mes'] . "-" . $this->NM_data_2['dia'];
               if (strpos($tsql, "TIME") !== false)
               {
                   $val[0] .= " " . $this->NM_data_1['hor'] . ":" . $this->NM_data_1['min'] . ":" . $this->NM_data_1['seg'];
                   $val[1] .= " " . $this->NM_data_2['hor'] . ":" . $this->NM_data_2['min'] . ":" . $this->NM_data_2['seg'];
               }
           }
           return;
       }
       $this->NM_data_qp = array();
       $this->NM_data_qp['ano'] = (isset($val[0]['ano']) && $val[0]['ano'] != "") ? $val[0]['ano'] : "____";
       $this->NM_data_qp['mes'] = (isset($val[0]['mes']) && $val[0]['mes'] != "") ? $val[0]['mes'] : "__";
       $this->NM_data_qp['dia'] = (isset($val[0]['dia']) && $val[0]['dia'] != "") ? $val[0]['dia'] : "__";
       $this->NM_data_qp['hor'] = (isset($val[0]['hor']) && $val[0]['hor'] != "") ? $val[0]['hor'] : "__";
       $this->NM_data_qp['min'] = (isset($val[0]['min']) && $val[0]['min'] != "") ? $val[0]['min'] : "__";
       $this->NM_data_qp['seg'] = (isset($val[0]['seg']) && $val[0]['seg'] != "") ? $val[0]['seg'] : "__";
       if ($tp != "ND" && ($cond == "LE" || $cond == "LT" || $cond == "GE" || $cond == "GT"))
       {
           $count_fill = 0;
           foreach ($this->NM_data_qp as $x => $tx)
           {
               if (substr($tx, 0, 2) != "__")
               {
                   $count_fill++;
               }
           }
           if ($count_fill > 1)
           {
               if ($cond == "LE" || $cond == "GT")
               {
                   $this->data_maior($this->NM_data_qp);
               }
               else
               {
                   $this->data_menor($this->NM_data_qp);
               }
               if ($tsql == "TIME")
               {
                   $val[0] = $this->NM_data_qp['hor'] . ":" . $this->NM_data_qp['min'] . ":" . $this->NM_data_qp['seg'];
               }
               elseif (substr($tsql, 0, 4) == "DATE")
               {
                   $val[0] = $this->NM_data_qp['ano'] . "-" . $this->NM_data_qp['mes'] . "-" . $this->NM_data_qp['dia'];
                   if (strpos($tsql, "TIME") !== false)
                   {
                       $val[0] .= " " . $this->NM_data_qp['hor'] . ":" . $this->NM_data_qp['min'] . ":" . $this->NM_data_qp['seg'];
                   }
               }
               return;
           }
       }
       foreach ($this->NM_data_qp as $x => $tx)
       {
           if (substr($tx, 0, 2) == "__" && ($x == "dia" || $x == "mes" || $x == "ano"))
           {
               if (substr($tsql, 0, 4) == "DATE")
               {
                   $this->Date_part = true;
                   break;
               }
           }
           if (substr($tx, 0, 2) == "__" && ($x == "hor" || $x == "min" || $x == "seg"))
           {
               if (strpos($tsql, "TIME") !== false && ($tp == "DH" || ($tp == "DT" && $cond != "LE" && $cond != "LT" && $cond != "GE" && $cond != "GT")))
               {
                   $this->Date_part = true;
                   break;
               }
           }
       }
       if ($this->Date_part)
       {
           $this->Ini_date_part = "";
           $this->End_date_part = "";
           $this->Ini_date_char = "";
           $this->End_date_char = "";
           if (isset($this->Ini->nm_bases_sqlite) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
           {
               $this->Ini_date_part = "'";
               $this->End_date_part = "'";
           }
           if ($tp != "ND")
           {
               if ($cond == "EQ")
               {
                   $this->Operador_date_part = " = ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_equl'];
               }
               elseif ($cond == "II")
               {
                   $this->Operador_date_part = " like ";
                   $this->Ini_date_part = "'";
                   $this->End_date_part = "%'";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_strt'];
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                   {
                       $this->Ini_date_char = "CAST (";
                       $this->End_date_char = " AS TEXT)";
                   }
               }
               elseif ($cond == "DF")
               {
                   $this->Operador_date_part = " <> ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_diff'];
               }
               elseif ($cond == "GT")
               {
                   $this->Operador_date_part = " > ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_grtr'];
               }
               elseif ($cond == "GE")
               {
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_grtr_equl'];
                   $this->Operador_date_part = " >= ";
               }
               elseif ($cond == "LT")
               {
                   $this->Operador_date_part = " < ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_less'];
               }
               elseif ($cond == "LE")
               {
                   $this->Operador_date_part = " <= ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_less_equl'];
               }
               elseif ($cond == "NP")
               {
                   $this->Operador_date_part = " not like ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_diff'];
                   $this->Ini_date_part = "'%";
                   $this->End_date_part = "%'";
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                   {
                       $this->Ini_date_char = "CAST (";
                       $this->End_date_char = " AS TEXT)";
                   }
               }
               else
               {
                   $this->Operador_date_part = " like ";
                   $this->Lang_date_part = $this->Ini->Nm_lang['lang_srch_equl'];
                   $this->Ini_date_part = "'%";
                   $this->End_date_part = "%'";
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                   {
                       $this->Ini_date_char = "CAST (";
                       $this->End_date_char = " AS TEXT)";
                   }
               }
           }
           if ($cond == "DF")
           {
               $cond = "NP";
           }
           if ($cond != "NP")
           {
               $cond = "QP";
           }
       }
       $val = array();
       if ($tp != "ND" && ($cond == "QP" || $cond == "NP"))
       {
           $val[0] = "";
           if (substr($tsql, 0, 4) == "DATE")
           {
               $val[0] .= $this->NM_data_qp['ano'] . "-" . $this->NM_data_qp['mes'] . "-" . $this->NM_data_qp['dia'];
               if (strpos($tsql, "TIME") !== false)
               {
                   $val[0] .= " ";
               }
           }
           if (strpos($tsql, "TIME") !== false)
           {
               $val[0] .= $this->NM_data_qp['hor'] . ":" . $this->NM_data_qp['min'] . ":" . $this->NM_data_qp['seg'];
           }
           return;
       }
       if ($cond == "II" || $cond == "DF" || $cond == "EQ" || $cond == "LT" || $cond == "GE")
       {
           $this->data_menor($this->NM_data_qp);
       }
       else
       {
           $this->data_maior($this->NM_data_qp);
       }
       if ($tsql == "TIME")
       {
           $val[0] = $this->NM_data_qp['hor'] . ":" . $this->NM_data_qp['min'] . ":" . $this->NM_data_qp['seg'];
           return;
       }
       $format_sql = "";
       if (substr($tsql, 0, 4) == "DATE")
       {
           $format_sql .= $this->NM_data_qp['ano'] . "-" . $this->NM_data_qp['mes'] . "-" . $this->NM_data_qp['dia'];
           if (strpos($tsql, "TIME") !== false)
           {
               $format_sql .= " ";
           }
       }
       if (strpos($tsql, "TIME") !== false)
       {
           $format_sql .=  $this->NM_data_qp['hor'] . ":" . $this->NM_data_qp['min'] . ":" . $this->NM_data_qp['seg'];
       }
       if ($tp != "ND")
       {
           $val[0] = $format_sql;
           return;
       }
       if ($tp == "ND")
       {
           $format_nd = str_replace("yyyy", $this->NM_data_qp['ano'], $format_nd);
           $format_nd = str_replace("mm",   $this->NM_data_qp['mes'], $format_nd);
           $format_nd = str_replace("dd",   $this->NM_data_qp['dia'], $format_nd);
           $format_nd = str_replace("hh",   $this->NM_data_qp['hor'], $format_nd);
           $format_nd = str_replace("ii",   $this->NM_data_qp['min'], $format_nd);
           $format_nd = str_replace("ss",   $this->NM_data_qp['seg'], $format_nd);
           $val[0] = $format_nd;
           return;
       }
   }
   function data_menor(&$data_arr)
   {
       $data_arr["ano"] = ("____" == $data_arr["ano"]) ? "0001" : $data_arr["ano"];
       $data_arr["mes"] = ("__" == $data_arr["mes"])   ? "01" : $data_arr["mes"];
       $data_arr["dia"] = ("__" == $data_arr["dia"])   ? "01" : $data_arr["dia"];
       $data_arr["hor"] = ("__" == $data_arr["hor"])   ? "00" : $data_arr["hor"];
       $data_arr["min"] = ("__" == $data_arr["min"])   ? "00" : $data_arr["min"];
       $data_arr["seg"] = ("__" == $data_arr["seg"])   ? "00" : $data_arr["seg"];
   }

   function data_maior(&$data_arr)
   {
       $data_arr["ano"] = ("____" == $data_arr["ano"]) ? "9999" : $data_arr["ano"];
       $data_arr["mes"] = ("__" == $data_arr["mes"])   ? "12" : $data_arr["mes"];
       $data_arr["hor"] = ("__" == $data_arr["hor"])   ? "23" : $data_arr["hor"];
       $data_arr["min"] = ("__" == $data_arr["min"])   ? "59" : $data_arr["min"];
       $data_arr["seg"] = ("__" == $data_arr["seg"])   ? "59" : $data_arr["seg"];
       if ("__" == $data_arr["dia"])
       {
           $data_arr["dia"] = "31";
           if ($data_arr["mes"] == "04" || $data_arr["mes"] == "06" || $data_arr["mes"] == "09" || $data_arr["mes"] == "11")
           {
               $data_arr["dia"] = 30;
           }
           elseif ($data_arr["mes"] == "02")
           { 
                if  ($data_arr["ano"] % 4 == 0)
                {
                     $data_arr["dia"] = 29;
                }
                else 
                {
                     $data_arr["dia"] = 28;
                }
           }
       }
   }

   /**
    * @access  public
    * @param  string  $nm_data_hora  
    */
   function limpa_dt_hor_pesq(&$nm_data_hora)
   {
      $nm_data_hora = str_replace("Y", "", $nm_data_hora); 
      $nm_data_hora = str_replace("M", "", $nm_data_hora); 
      $nm_data_hora = str_replace("D", "", $nm_data_hora); 
      $nm_data_hora = str_replace("H", "", $nm_data_hora); 
      $nm_data_hora = str_replace("I", "", $nm_data_hora); 
      $nm_data_hora = str_replace("S", "", $nm_data_hora); 
      $tmp_pos = strpos($nm_data_hora, "--");
      if ($tmp_pos !== FALSE)
      {
          $nm_data_hora = str_replace("--", "-", $nm_data_hora); 
      }
      $tmp_pos = strpos($nm_data_hora, "::");
      if ($tmp_pos !== FALSE)
      {
          $nm_data_hora = str_replace("::", ":", $nm_data_hora); 
      }
   }

   /**
    * @access  public
    */
   function retorna_pesq()
   {
      global $nm_apl_dependente;
   $NM_retorno = "./";
?>
<!DOCTYPE html>
<HTML>
<HEAD>
 <TITLE>BRSVP - Aéreo Participantes</TITLE>
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
</HEAD>
<BODY id="grid_search" class="scGridPage">
<FORM style="display:none;" name="form_ok" method="POST" action="<?php echo $NM_retorno; ?>" target="_self">
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="pesq"> 
</FORM>
<SCRIPT type="text/javascript">
 document.form_ok.submit();
</SCRIPT>
</BODY>
</HTML>
<?php
}

   /**
    * @access  public
    */
   function monta_html_ini()
   {
       header("X-XSS-Protection: 1; mode=block");
       header("Strict-Transport-Security: max-age=31536000; includeSubDomains");
       header("X-Frame-Options: SAMEORIGIN");
       header("X-Content-Type-Options: nosniff");
       header("Referrer-Policy: origin-when-cross-origin");
       header("Content-Security-Policy: frame-ancestors 'self' ; form-action 'self' ; connect-src 'self' ; base-uri 'self' ; child-src 'self' ; object-src 'none'");
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>BRSVP - Aéreo Participantes</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}
?>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
 <META http-equiv="Last-Modified" content="<?php echo gmdate('D, d M Y H:i:s') ?> GMT" />
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
 <META http-equiv="Pragma" content="no-cache" />
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
 <script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery/js/jquery.js"></script>
 <script type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery-ui.js"></script>
 <script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></script>
 <script type="text/javascript" src="../_lib/lib/js/scInput.js"></script>
 <script type="text/javascript" src="../_lib/lib/js/jquery.scInput.js"></script>
 <script type="text/javascript" src="../_lib/lib/js/jquery.scInput2.js"></script>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_error.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_error<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Str_btn_filter_css ?>" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_form.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery/css/smoothness/jquery-ui.css" type="text/css" media="screen" />
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/font-awesome/6/css/all.min.css" type="text/css" media="screen" />
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_filter.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_filter<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
  <?php 
  if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
  { 
  ?> 
  <link href="<?php echo $this->Ini->str_google_fonts ?>" rel="stylesheet" /> 
  <?php 
  } 
  ?> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>grid_aereopar_rsvp_r/grid_aereopar_rsvp_r_fil_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />
</HEAD>
<?php
$vertical_center = 'display: flex; flex-direction: column; justify-content: center; margin: 0px; min-height: 100vh;';
?>
<BODY id="grid_search" class="scFilterPage" style="<?php echo $vertical_center ?>">
<?php echo $this->Ini->Ajax_result_set ?>
   <script type="text/javascript">
     var applicationKeys = '';
     applicationKeys += 'ctrl+k';
     applicationKeys += ',';
     applicationKeys += 'ctrl+enter';
     applicationKeys += ',';
     applicationKeys += 'ctrl+e';
     applicationKeys += ',';
     applicationKeys += 'f1';
     applicationKeys += ',';
     applicationKeys += 'alt+q';
     var hotkeyList = '';
     function execHotKey(e, h) {
         var hotkey_fired = false
         switch (true) {
             case (['ctrl+k'].indexOf(h.key) > -1):
                 hotkey_fired = process_hotkeys('sys_format_lim');
                 break;
             case (['ctrl+enter'].indexOf(h.key) > -1):
                 hotkey_fired = process_hotkeys('sys_format_fi2');
                 break;
             case (['ctrl+e'].indexOf(h.key) > -1):
                 hotkey_fired = process_hotkeys('sys_format_edi');
                 break;
             case (['f1'].indexOf(h.key) > -1):
                 hotkey_fired = process_hotkeys('sys_format_webh');
                 break;
             case (['alt+q'].indexOf(h.key) > -1):
                 hotkey_fired = process_hotkeys('sys_format_sai');
                 break;
         }
         if (hotkey_fired) {
             e.preventDefault();
             return false;
         } else {
             return true;
         }
     }
   </script>
   <script type="text/javascript" src="../_lib/lib/js/hotkeys.inc.js"></script>
   <script type="text/javascript" src="../_lib/lib/js/hotkeys_setup.js"></script>
        <script type="text/javascript">
          var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
          var sc_tbLangClose = "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_tb_close'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) ?>";
          var sc_tbLangEsc = "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_tb_esc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) ?>";
        </script>
 <script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></script>
 <script type="text/javascript" src="grid_aereopar_rsvp_r_ajax_search.js"></script>
 <script type="text/javascript" src="grid_aereopar_rsvp_r_ajax.js"></script>
 <script type="text/javascript">
   function sc_session_redir(url_redir)
   {
       if (window.parent && window.parent.document != window.document && typeof window.parent.sc_session_redir === 'function')
       {
           window.parent.sc_session_redir(url_redir);
       }
       else
       {
           if (window.opener && typeof window.opener.sc_session_redir === 'function')
           {
               window.close();
               window.opener.sc_session_redir(url_redir);
           }
           else
           {
               window.location = url_redir;
           }
       }
   }
   var sc_ajaxBg = '<?php echo $this->Ini->Color_bg_ajax ?>';
   var sc_ajaxBordC = '<?php echo $this->Ini->Border_c_ajax ?>';
   var sc_ajaxBordS = '<?php echo $this->Ini->Border_s_ajax ?>';
   var sc_ajaxBordW = '<?php echo $this->Ini->Border_w_ajax ?>';
 </script>
<?php
$Cod_Btn = nmButtonOutput($this->arr_buttons, "berrm_clse", "nmAjaxHideDebug()", "nmAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<div id="id_debug_window" style="display: none;" class='scDebugWindow'><table class="scFormMessageTable">
<tr><td class="scFormMessageTitle"><?php echo $Cod_Btn ?>&nbsp;&nbsp;Output</td></tr>
<tr><td class="scFormMessageMessage" style="padding: 0px; vertical-align: top"><div style="padding: 2px; height: 200px; width: 350px; overflow: auto" id="id_debug_text"></div></td></tr>
</table></div>
<script type="text/javascript" src="grid_aereopar_rsvp_r_message.js"></script>
<link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_sweetalert.css" />
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['grid_aereopar_rsvp_r']['glo_nm_path_prod']; ?>/third/sweetalert/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['grid_aereopar_rsvp_r']['glo_nm_path_prod']; ?>/third/sweetalert/polyfill.min.js"></script>
<script type="text/javascript" src="../_lib/lib/js/frameControl.js"></script>
<?php
$confirmButtonClass = '';
$cancelButtonClass  = '';
$confirmButtonText  = $this->Ini->Nm_lang['lang_btns_cfrm'];
$cancelButtonText   = $this->Ini->Nm_lang['lang_btns_cncl'];
$confirmButtonFA    = '';
$cancelButtonFA     = '';
$confirmButtonFAPos = '';
$cancelButtonFAPos  = '';
if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['style']) && '' != $this->arr_buttons['bsweetalert_ok']['style']) {
    $confirmButtonClass = 'scButton_' . $this->arr_buttons['bsweetalert_ok']['style'];
}
if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['style']) && '' != $this->arr_buttons['bsweetalert_cancel']['style']) {
    $cancelButtonClass = 'scButton_' . $this->arr_buttons['bsweetalert_cancel']['style'];
}
if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['value']) && '' != $this->arr_buttons['bsweetalert_ok']['value']) {
    $confirmButtonText = $this->arr_buttons['bsweetalert_ok']['value'];
}
if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['value']) && '' != $this->arr_buttons['bsweetalert_cancel']['value']) {
    $cancelButtonText = $this->arr_buttons['bsweetalert_cancel']['value'];
}
if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['fontawesomeicon']) && '' != $this->arr_buttons['bsweetalert_ok']['fontawesomeicon']) {
    $confirmButtonFA = $this->arr_buttons['bsweetalert_ok']['fontawesomeicon'];
}
if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['fontawesomeicon']) && '' != $this->arr_buttons['bsweetalert_cancel']['fontawesomeicon']) {
    $cancelButtonFA = $this->arr_buttons['bsweetalert_cancel']['fontawesomeicon'];
}
if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['display_position']) && 'img_right' != $this->arr_buttons['bsweetalert_ok']['display_position']) {
    $confirmButtonFAPos = 'text_right';
}
if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['display_position']) && 'img_right' != $this->arr_buttons['bsweetalert_cancel']['display_position']) {
    $cancelButtonFAPos = 'text_right';
}
?>
<script type="text/javascript">
  var scSweetAlertConfirmButton = "<?php echo $confirmButtonClass ?>";
  var scSweetAlertCancelButton = "<?php echo $cancelButtonClass ?>";
  var scSweetAlertConfirmButtonText = "<?php echo $confirmButtonText ?>";
  var scSweetAlertCancelButtonText = "<?php echo $cancelButtonText ?>";
  var scSweetAlertConfirmButtonFA = "<?php echo $confirmButtonFA ?>";
  var scSweetAlertCancelButtonFA = "<?php echo $cancelButtonFA ?>";
  var scSweetAlertConfirmButtonFAPos = "<?php echo $confirmButtonFAPos ?>";
  var scSweetAlertCancelButtonFAPos = "<?php echo $cancelButtonFAPos ?>";
</script>
<script type="text/javascript">
$(function() {
<?php
if ((isset($this->nm_mens_alert) && count($this->nm_mens_alert)) || (isset($this->Ini->nm_mens_alert) && count($this->Ini->nm_mens_alert))) {
   if (isset($this->Ini->nm_mens_alert) && !empty($this->Ini->nm_mens_alert))
   {
       if (isset($this->nm_mens_alert) && !empty($this->nm_mens_alert))
       {
           $this->nm_mens_alert   = array_merge($this->Ini->nm_mens_alert, $this->nm_mens_alert);
           $this->nm_params_alert = array_merge($this->Ini->nm_params_alert, $this->nm_params_alert);
       }
       else
       {
           $this->nm_mens_alert   = $this->Ini->nm_mens_alert;
           $this->nm_params_alert = $this->Ini->nm_params_alert;
       }
   }
   if (isset($this->nm_mens_alert) && !empty($this->nm_mens_alert))
   {
       foreach ($this->nm_mens_alert as $i_alert => $mensagem)
       {
           $alertParams = array();
           if (isset($this->nm_params_alert[$i_alert]))
           {
               foreach ($this->nm_params_alert[$i_alert] as $paramName => $paramValue)
               {
                   if (in_array($paramName, array('title', 'timer', 'confirmButtonText', 'confirmButtonFA', 'confirmButtonFAPos', 'cancelButtonText', 'cancelButtonFA', 'cancelButtonFAPos', 'footer', 'width', 'padding')))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif (in_array($paramName, array('showConfirmButton', 'showCancelButton', 'toast')) && in_array($paramValue, array(true, false)))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif ('position' == $paramName && in_array($paramValue, array('top', 'top-start', 'top-end', 'center', 'center-start', 'center-end', 'bottom', 'bottom-start', 'bottom-end')))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif ('type' == $paramName && in_array($paramValue, array('warning', 'error', 'success', 'info', 'question')))
                   {
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
                   elseif ('background' == $paramName)
                   {
                       $image_param = $paramValue;
                       preg_match_all('/url\(([\s])?(["|\'])?(.*?)(["|\'])?([\s])?\)/i', $paramValue, $matches, PREG_PATTERN_ORDER);
                       if (isset($matches[3])) {
                           foreach ($matches[3] as $match) {
                               if ('http:' != substr($match, 0, 5) && 'https:' != substr($match, 0, 6) && '/' != substr($match, 0, 1)) {
                                   $image_param = str_replace($match, "{$this->Ini->path_img_global}/{$match}", $image_param);
                               }
                           }
                       }
                       $paramValue = $image_param;
                       $alertParams[$paramName] = NM_charset_to_utf8($paramValue);
                   }
               }
           }
           $jsonParams = json_encode($alertParams);
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['ajax_nav'])
           { 
               $this->Ini->Arr_result['AlertJS'][] = NM_charset_to_utf8($mensagem);
               $this->Ini->Arr_result['AlertJSParam'][] = $alertParams;
           } 
           else 
           { 
?>
       scJs_alert('<?php echo $mensagem ?>', <?php echo $jsonParams ?>);
<?php
           } 
       }
   }
}
?>
});
</script>
<?php
if ('' != $this->Campos_Mens_erro) {
?>
<script type="text/javascript">
$(function() {
        _nmAjaxShowMessage({title: "<?php echo $this->Ini->Nm_lang['lang_errm_errt']; ?>", message: "<?php echo $this->Campos_Mens_erro ?>", isModal: false, timeout: "", showButton: true, buttonLabel: "", topPos: "", leftPos: "", width: "", height: "", redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: false, isToast: false, toastPos: "", type: "error"});
});
</script>
<?php
}
?>
<script type="text/javascript" src="grid_aereopar_rsvp_r_message.js"></script>
 <SCRIPT type="text/javascript">

<?php
if (is_file($this->Ini->root . $this->Ini->path_link . "_lib/js/tab_erro_" . $this->Ini->str_lang . ".js"))
{
    $Tb_err_js = file($this->Ini->root . $this->Ini->path_link . "_lib/js/tab_erro_" . $this->Ini->str_lang . ".js");
    foreach ($Tb_err_js as $Lines)
    {
        if (NM_is_utf8($Lines) && $_SESSION['scriptcase']['charset'] != "UTF-8")
        {
            $Lines = sc_convert_encoding($Lines, $_SESSION['scriptcase']['charset'], "UTF-8");
        }
        echo $Lines;
    }
}
 $Msg_Inval = "Inv�lido";
 if (NM_is_utf8($Lines) && $_SESSION['scriptcase']['charset'] != "UTF-8")
 {
    $Msg_Inval = sc_convert_encoding($Msg_Inval, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
var SC_crit_inv = "<?php echo $Msg_Inval ?>";
var nmdg_Form = "F1";

 $(function() {

   SC_carga_evt_jquery();
   scLoadScInput('input:text.sc-js-input');
 });
 function nm_campos_between(nm_campo, nm_cond, nm_nome_obj, opc_clear)
 {
  if (nm_cond.value == "bw") {
      nm_campo.style.display = "";
  }
  else {
      if (nm_campo) {
          nm_campo.style.display = "none";
      }
  }
  if (document.getElementById('id_hide_' + nm_nome_obj)) {
      if (nm_cond.value == "nu" || nm_cond.value == "nn" || nm_cond.value == "ep" || nm_cond.value == "ne") {
          document.getElementById('id_hide_' + nm_nome_obj).style.display = 'none';
      }
      else {
          document.getElementById('id_hide_' + nm_nome_obj).style.display = '';
      }
  }
 }
 function nm_save_form(pos)
 {
  if (pos == 'top' && document.F1.nmgp_save_name_top.value == '')
  {
      return;
  }
  if (pos == 'bot' && document.F1.nmgp_save_name_bot.value == '')
  {
      return;
  }
  if (pos == 'fields' && document.F1.nmgp_save_name_fields.value == '')
  {
      return;
  }
  var str_out = "";
  str_out += 'SC_participante_cpf_cond#NMF#' + search_get_sel_txt('SC_participante_cpf_cond') + '@NMF@';
  str_out += 'SC_participante_cpf#NMF#' + search_get_text('SC_participante_cpf') + '@NMF@';
  str_out += 'id_ac_participante_cpf#NMF#' + search_get_text('id_ac_participante_cpf') + '@NMF@';
  str_out += 'SC_participante_nome_cond#NMF#' + search_get_sel_txt('SC_participante_nome_cond') + '@NMF@';
  str_out += 'SC_participante_nome#NMF#' + search_get_text('SC_participante_nome') + '@NMF@';
  str_out += 'id_ac_participante_nome#NMF#' + search_get_text('id_ac_participante_nome') + '@NMF@';
  str_out += 'SC_tipo_pessoa_cond#NMF#' + search_get_sel_txt('SC_tipo_pessoa_cond') + '@NMF@';
  str_out += 'SC_tipo_pessoa#NMF#' + search_get_text('SC_tipo_pessoa') + '@NMF@';
  str_out += 'id_ac_tipo_pessoa#NMF#' + search_get_text('id_ac_tipo_pessoa') + '@NMF@';
  str_out += 'SC_cod_cia_aerea_cond#NMF#' + search_get_sel_txt('SC_cod_cia_aerea_cond') + '@NMF@';
  str_out += 'SC_cod_cia_aerea#NMF#' + search_get_text('SC_cod_cia_aerea') + '@NMF@';
  str_out += 'SC_cia_aerea_cond#NMF#' + search_get_sel_txt('SC_cia_aerea_cond') + '@NMF@';
  str_out += 'SC_cia_aerea#NMF#' + search_get_text('SC_cia_aerea') + '@NMF@';
  str_out += 'id_ac_cia_aerea#NMF#' + search_get_text('id_ac_cia_aerea') + '@NMF@';
  str_out += 'SC_voo_cond#NMF#' + search_get_sel_txt('SC_voo_cond') + '@NMF@';
  str_out += 'SC_voo#NMF#' + search_get_text('SC_voo') + '@NMF@';
  str_out += 'id_ac_voo#NMF#' + search_get_text('id_ac_voo') + '@NMF@';
  str_out += 'SC_direcao_cond#NMF#' + search_get_sel_txt('SC_direcao_cond') + '@NMF@';
  str_out += 'SC_direcao#NMF#' + search_get_text('SC_direcao') + '@NMF@';
  str_out += 'id_ac_direcao#NMF#' + search_get_text('id_ac_direcao') + '@NMF@';
  str_out += 'SC_origem_cond#NMF#' + search_get_sel_txt('SC_origem_cond') + '@NMF@';
  str_out += 'SC_origem#NMF#' + search_get_text('SC_origem') + '@NMF@';
  str_out += 'id_ac_origem#NMF#' + search_get_text('id_ac_origem') + '@NMF@';
  str_out += 'SC_destino_cond#NMF#' + search_get_sel_txt('SC_destino_cond') + '@NMF@';
  str_out += 'SC_destino#NMF#' + search_get_text('SC_destino') + '@NMF@';
  str_out += 'id_ac_destino#NMF#' + search_get_text('id_ac_destino') + '@NMF@';
  str_out += 'SC_localizador_cond#NMF#' + search_get_sel_txt('SC_localizador_cond') + '@NMF@';
  str_out += 'SC_localizador#NMF#' + search_get_text('SC_localizador') + '@NMF@';
  str_out += 'id_ac_localizador#NMF#' + search_get_text('id_ac_localizador') + '@NMF@';
  str_out += 'SC_etkt_cond#NMF#' + search_get_sel_txt('SC_etkt_cond') + '@NMF@';
  str_out += 'SC_etkt#NMF#' + search_get_text('SC_etkt') + '@NMF@';
  str_out += 'id_ac_etkt#NMF#' + search_get_text('id_ac_etkt') + '@NMF@';
  str_out += 'SC_emitida_bvt_cond#NMF#' + search_get_sel_txt('SC_emitida_bvt_cond') + '@NMF@';
  str_out += 'SC_emitida_bvt#NMF#' + search_get_text('SC_emitida_bvt') + '@NMF@';
  str_out += 'id_ac_emitida_bvt#NMF#' + search_get_text('id_ac_emitida_bvt') + '@NMF@';
  str_out += 'SC_bloqueio_dsc_cond#NMF#' + search_get_sel_txt('SC_bloqueio_dsc_cond') + '@NMF@';
  str_out += 'SC_bloqueio_dsc#NMF#' + search_get_text('SC_bloqueio_dsc') + '@NMF@';
  str_out += 'id_ac_bloqueio_dsc#NMF#' + search_get_text('id_ac_bloqueio_dsc') + '@NMF@';
  str_out += 'SC_data_saida_cond#NMF#' + search_get_sel_txt('SC_data_saida_cond') + '@NMF@';
  str_out += 'SC_data_saida_dia#NMF#' + search_get_sel_txt('SC_data_saida_dia') + '@NMF@';
  str_out += 'SC_data_saida_mes#NMF#' + search_get_sel_txt('SC_data_saida_mes') + '@NMF@';
  str_out += 'SC_data_saida_ano#NMF#' + search_get_sel_txt('SC_data_saida_ano') + '@NMF@';
  str_out += 'SC_data_saida_input_2_dia#NMF#' + search_get_sel_txt('SC_data_saida_input_2_dia') + '@NMF@';
  str_out += 'SC_data_saida_input_2_mes#NMF#' + search_get_sel_txt('SC_data_saida_input_2_mes') + '@NMF@';
  str_out += 'SC_data_saida_input_2_ano#NMF#' + search_get_sel_txt('SC_data_saida_input_2_ano') + '@NMF@';
  str_out += 'SC_hora_saida_cond#NMF#' + search_get_sel_txt('SC_hora_saida_cond') + '@NMF@';
  str_out += 'SC_hora_saida_hor#NMF#' + search_get_sel_txt('SC_hora_saida_hor') + '@NMF@';
  str_out += 'SC_hora_saida_min#NMF#' + search_get_sel_txt('SC_hora_saida_min') + '@NMF@';
  str_out += 'SC_hora_saida_seg#NMF#' + search_get_sel_txt('SC_hora_saida_seg') + '@NMF@';
  str_out += 'SC_hora_saida_input_2_hor#NMF#' + search_get_sel_txt('SC_hora_saida_input_2_hor') + '@NMF@';
  str_out += 'SC_hora_saida_input_2_min#NMF#' + search_get_sel_txt('SC_hora_saida_input_2_min') + '@NMF@';
  str_out += 'SC_hora_saida_input_2_seg#NMF#' + search_get_sel_txt('SC_hora_saida_input_2_seg') + '@NMF@';
  str_out += 'SC_data_chegada_cond#NMF#' + search_get_sel_txt('SC_data_chegada_cond') + '@NMF@';
  str_out += 'SC_data_chegada_dia#NMF#' + search_get_sel_txt('SC_data_chegada_dia') + '@NMF@';
  str_out += 'SC_data_chegada_mes#NMF#' + search_get_sel_txt('SC_data_chegada_mes') + '@NMF@';
  str_out += 'SC_data_chegada_ano#NMF#' + search_get_sel_txt('SC_data_chegada_ano') + '@NMF@';
  str_out += 'SC_data_chegada_input_2_dia#NMF#' + search_get_sel_txt('SC_data_chegada_input_2_dia') + '@NMF@';
  str_out += 'SC_data_chegada_input_2_mes#NMF#' + search_get_sel_txt('SC_data_chegada_input_2_mes') + '@NMF@';
  str_out += 'SC_data_chegada_input_2_ano#NMF#' + search_get_sel_txt('SC_data_chegada_input_2_ano') + '@NMF@';
  str_out += 'SC_hora_chegada_cond#NMF#' + search_get_sel_txt('SC_hora_chegada_cond') + '@NMF@';
  str_out += 'SC_hora_chegada_hor#NMF#' + search_get_sel_txt('SC_hora_chegada_hor') + '@NMF@';
  str_out += 'SC_hora_chegada_min#NMF#' + search_get_sel_txt('SC_hora_chegada_min') + '@NMF@';
  str_out += 'SC_hora_chegada_seg#NMF#' + search_get_sel_txt('SC_hora_chegada_seg') + '@NMF@';
  str_out += 'SC_hora_chegada_input_2_hor#NMF#' + search_get_sel_txt('SC_hora_chegada_input_2_hor') + '@NMF@';
  str_out += 'SC_hora_chegada_input_2_min#NMF#' + search_get_sel_txt('SC_hora_chegada_input_2_min') + '@NMF@';
  str_out += 'SC_hora_chegada_input_2_seg#NMF#' + search_get_sel_txt('SC_hora_chegada_input_2_seg') + '@NMF@';
  str_out += 'SC_data_nota_gate_cond#NMF#' + search_get_sel_txt('SC_data_nota_gate_cond') + '@NMF@';
  str_out += 'SC_data_nota_gate_dia#NMF#' + search_get_sel_txt('SC_data_nota_gate_dia') + '@NMF@';
  str_out += 'SC_data_nota_gate_mes#NMF#' + search_get_sel_txt('SC_data_nota_gate_mes') + '@NMF@';
  str_out += 'SC_data_nota_gate_ano#NMF#' + search_get_sel_txt('SC_data_nota_gate_ano') + '@NMF@';
  str_out += 'SC_data_nota_gate_input_2_dia#NMF#' + search_get_sel_txt('SC_data_nota_gate_input_2_dia') + '@NMF@';
  str_out += 'SC_data_nota_gate_input_2_mes#NMF#' + search_get_sel_txt('SC_data_nota_gate_input_2_mes') + '@NMF@';
  str_out += 'SC_data_nota_gate_input_2_ano#NMF#' + search_get_sel_txt('SC_data_nota_gate_input_2_ano') + '@NMF@';
  str_out += 'SC_nota_gate_cond#NMF#' + search_get_sel_txt('SC_nota_gate_cond') + '@NMF@';
  str_out += 'SC_nota_gate#NMF#' + search_get_text('SC_nota_gate') + '@NMF@';
  str_out += 'id_ac_nota_gate#NMF#' + search_get_text('id_ac_nota_gate') + '@NMF@';
  str_out += 'SC_NM_operador#NMF#' + search_get_text('SC_NM_operador');
  str_out  = str_out.replace(/[+]/g, "__NM_PLUS__");
  str_out  = str_out.replace(/[&]/g, "__NM_AMP__");
  str_out  = str_out.replace(/[%]/g, "__NM_PRC__");
  var save_name = search_get_text('SC_nmgp_save_name_' + pos);
  var save_opt  = search_get_sel_txt('SC_nmgp_save_option_' + pos);
  ajax_save_filter(save_name, save_opt, str_out, pos);
 }
 function nm_submit_filter(obj_sel, pos)
 {
  index = obj_sel.selectedIndex;
  if (index == -1 || obj_sel.options[index].value == "") 
  {
      return false;
  }
  limpa_form('ch_fil');
  ajax_select_filter(obj_sel.options[index].value);
 }
 function nm_submit_filter_del(pos)
 {
  obj_sel = document.F1.elements['NM_filters_del_' + pos];
  index   = obj_sel.selectedIndex;
  if (index == -1 || obj_sel.options[index].value == "") 
  {
      return false;
  }
  parm = obj_sel.options[index].value;
  ajax_delete_filter(parm, pos);
 }
 function search_get_select(obj_id)
 {
    var index = document.getElementById(obj_id).selectedIndex;
    if (index != -1) {
        return document.getElementById(obj_id).options[index].value;
    }
    else {
        return '';
    }
 }
 function search_get_selmult(obj_id)
 {
    var obj = document.getElementById(obj_id);
    var val = "_NM_array_";
    for (iSelect = 0; iSelect < obj.length; iSelect++)
    {
        if (obj[iSelect].selected)
        {
            val += "#NMARR#" + obj[iSelect].value;
        }
    }
    return val;
 }
 function search_get_Dselelect(obj_id)
 {
    var obj = document.getElementById(obj_id);
    var val = "_NM_array_";
    for (iSelect = 0; iSelect < obj.length; iSelect++)
    {
         val += "#NMARR#" + obj[iSelect].value;
    }
    return val;
 }
 function search_get_radio(obj_id)
 {
    var val  = "";
    if (document.getElementById(obj_id)) {
       var Nobj = document.getElementById(obj_id).name;
       var obj  = document.getElementsByName(Nobj);
       for (iRadio = 0; iRadio < obj.length; iRadio++) {
           if (obj[iRadio].checked) {
               val = obj[iRadio].value;
           }
       }
    }
    return val;
 }
 function search_get_checkbox(obj_id)
 {
    var val  = "_NM_array_";
    if (document.getElementById(obj_id)) {
       var Nobj = document.getElementById(obj_id).name;
       var obj  = document.getElementsByName(Nobj);
       if (!obj.length) {
           if (obj.checked) {
               val += "#NMARR#" + obj.value;
           }
       }
       else {
           for (iCheck = 0; iCheck < obj.length; iCheck++) {
               if (obj[iCheck].checked) {
                   val += "#NMARR#" + obj[iCheck].value;
               }
           }
       }
    }
    return val;
 }
 function search_get_text(obj_id)
 {
    var obj = document.getElementById(obj_id);
    return (obj) ? obj.value : '';
 }
 function search_get_title(obj_id)
 {
    var obj = document.getElementById(obj_id);
    return (obj) ? obj.title : '';
 }
 function search_get_sel_txt(obj_id)
 {
    var val = "";
    obj_part  = document.getElementById(obj_id);
    if (obj_part && obj_part.type.substr(0, 6) == 'select')
    {
        val = search_get_select(obj_id);
    }
    else
    {
        val = (obj_part) ? obj_part.value : '';
    }
    return val;
 }
 function search_get_html(obj_id)
 {
    var obj = document.getElementById(obj_id);
    return obj.innerHTML;
 }
function nm_open_popup(parms)
{
    NovaJanela = window.open (parms, '', 'resizable, scrollbars');
}
 </SCRIPT>
<script type="text/javascript">
 $(function() {
   scClass = $("#id_ac_participante_cpf").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_participante_cpf").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_participante_cpf",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         if (data == "ss_time_out") {
             nm_move();
         }
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_participante_cpf").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_participante_cpf").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_participante_nome").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_participante_nome").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_participante_nome",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         if (data == "ss_time_out") {
             nm_move();
         }
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_participante_nome").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_participante_nome").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_tipo_pessoa").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_tipo_pessoa").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_tipo_pessoa",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         if (data == "ss_time_out") {
             nm_move();
         }
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_tipo_pessoa").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_tipo_pessoa").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_direcao").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_direcao").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_direcao",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         if (data == "ss_time_out") {
             nm_move();
         }
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_direcao").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_direcao").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_cia_aerea").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_cia_aerea").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_cia_aerea",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         if (data == "ss_time_out") {
             nm_move();
         }
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_cia_aerea").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_cia_aerea").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_voo").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_voo").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_voo",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         if (data == "ss_time_out") {
             nm_move();
         }
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_voo").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_voo").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_origem").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_origem").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_origem",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         if (data == "ss_time_out") {
             nm_move();
         }
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_origem").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_origem").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_destino").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_destino").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_destino",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         if (data == "ss_time_out") {
             nm_move();
         }
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_destino").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_destino").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_localizador").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_localizador").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_localizador",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         if (data == "ss_time_out") {
             nm_move();
         }
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_localizador").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_localizador").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_etkt").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_etkt").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_etkt",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         if (data == "ss_time_out") {
             nm_move();
         }
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_etkt").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_etkt").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_emitida_bvt").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_emitida_bvt").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_emitida_bvt",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         if (data == "ss_time_out") {
             nm_move();
         }
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_emitida_bvt").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_emitida_bvt").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_bloqueio_dsc").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_bloqueio_dsc").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_bloqueio_dsc",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         if (data == "ss_time_out") {
             nm_move();
         }
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_bloqueio_dsc").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_bloqueio_dsc").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_nota_gate").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_nota_gate").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_nota_gate",
          max_itens: "10",
          cod_desc: "N",
          script_case_init: <?php echo $this->Ini->sc_page ?>
        },
       success: function (data) {
         if (data == "ss_time_out") {
             nm_move();
         }
         response(data);
       }
      });
    },
     select: function (event, ui) {
       $("#SC_nota_gate").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_nota_gate").val( $(this).val() );
       }
     }
   });
 });
</script>
 <FORM name="F1" action="./" method="post" target="_self"> 
 <INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
 <INPUT type="hidden" name="nmgp_opcao" value="busca"> 
 <div id="idJSSpecChar" style="display:none;"></div>
 <div id="id_div_process" style="display: none; position: absolute"><table class="scFilterTable"><tr><td class="scFilterLabelOdd"><?php echo $this->Ini->Nm_lang['lang_othr_prcs']; ?>...</td></tr></table></div>
 <div id="id_fatal_error" class="scFilterFieldOdd" style="display:none; position: absolute"></div>
<TABLE id="main_table" align="center" valign="top" >
<tr>
<td>
<div class="scFilterBorder">
  <div id="id_div_process_block" style="display: none; margin: 10px; whitespace: nowrap"><span class="scFormProcess"><img border="0" src="<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif" align="absmiddle" />&nbsp;<?php echo $this->Ini->Nm_lang['lang_othr_prcs'] ?>...</span></div>
<table cellspacing=0 cellpadding=0 width='100%'>
<?php
   }

   /**
    * @access  public
    * @global  string  $bprocessa  
    */
   /**
    * @access  public
    */
   function monta_cabecalho()
   {
      if ($this->Ini->Embutida_iframe || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['dashboard_info']['compact_mode'])
      {
          return;
      }
      $Str_date = strtolower($_SESSION['scriptcase']['reg_conf']['date_format']);
      $Lim   = strlen($Str_date);
      $Ult   = "";
      $Arr_D = array();
      for ($I = 0; $I < $Lim; $I++)
      {
          $Char = substr($Str_date, $I, 1);
          if ($Char != $Ult)
          {
              $Arr_D[] = $Char;
          }
          $Ult = $Char;
      }
      $Prim = true;
      $Str  = "";
      foreach ($Arr_D as $Cada_d)
      {
          $Str .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
          $Str .= $Cada_d;
          $Prim = false;
      }
      $Str = str_replace("a", "Y", $Str);
      $Str = str_replace("y", "Y", $Str);
      $nm_data_fixa = date($Str); 
?>
 <TR align="center">
  <TD class="scFilterTableTd scGridPage">
<style>
    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}
</style>
<div class="scFilterHeader" style="height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;">
    <div class="scFilterHeaderFont" style="float: left; text-transform: uppercase;">BRSVP - Aéreo Participantes</div>
    <div class="scFilterHeaderFont" style="float: right;"><?php echo $nm_data_fixa; ?></div>
</div>  </TD>
 </TR>
<?php
   }

   /**
    * @access  public
    * @global  string  $nm_url_saida  $this->Ini->Nm_lang['pesq_global_nm_url_saida']
    * @global  integer  $nm_apl_dependente  $this->Ini->Nm_lang['pesq_global_nm_apl_dependente']
    * @global  string  $nmgp_parms  
    * @global  string  $bprocessa  $this->Ini->Nm_lang['pesq_global_bprocessa']
    */
   function monta_form()
   {
      global 
             $participante_cpf_cond, $participante_cpf, $participante_cpf_autocomp,
             $participante_nome_cond, $participante_nome, $participante_nome_autocomp,
             $tipo_pessoa_cond, $tipo_pessoa, $tipo_pessoa_autocomp,
             $cod_cia_aerea_cond, $cod_cia_aerea,
             $cia_aerea_cond, $cia_aerea, $cia_aerea_autocomp,
             $voo_cond, $voo, $voo_autocomp,
             $direcao_cond, $direcao, $direcao_autocomp,
             $origem_cond, $origem, $origem_autocomp,
             $destino_cond, $destino, $destino_autocomp,
             $localizador_cond, $localizador, $localizador_autocomp,
             $etkt_cond, $etkt, $etkt_autocomp,
             $emitida_bvt_cond, $emitida_bvt, $emitida_bvt_autocomp,
             $bloqueio_dsc_cond, $bloqueio_dsc, $bloqueio_dsc_autocomp,
             $data_saida_cond, $data_saida, $data_saida_dia, $data_saida_mes, $data_saida_ano, $data_saida_input_2_dia, $data_saida_input_2_mes, $data_saida_input_2_ano,
             $hora_saida_cond, $hora_saida, $hora_saida_hor, $hora_saida_min, $hora_saida_seg,
             $data_chegada_cond, $data_chegada, $data_chegada_dia, $data_chegada_mes, $data_chegada_ano, $data_chegada_input_2_dia, $data_chegada_input_2_mes, $data_chegada_input_2_ano,
             $hora_chegada_cond, $hora_chegada, $hora_chegada_hor, $hora_chegada_min, $hora_chegada_seg,
             $data_nota_gate_cond, $data_nota_gate, $data_nota_gate_dia, $data_nota_gate_mes, $data_nota_gate_ano, $data_nota_gate_input_2_dia, $data_nota_gate_input_2_mes, $data_nota_gate_input_2_ano,
             $nota_gate_cond, $nota_gate, $nota_gate_autocomp,
             $nm_url_saida, $nm_apl_dependente, $nmgp_parms, $bprocessa, $nmgp_save_name, $NM_operador, $NM_filters, $nmgp_save_option, $NM_filters_del, $Script_BI;
      $Script_BI = "";
      $this->nmgp_botoes['clear'] = "on";
      $this->nmgp_botoes['save'] = "on";
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_aereopar_rsvp_r']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_aereopar_rsvp_r']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_aereopar_rsvp_r']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("grid_aereopar_rsvp_r", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
      {
          $this->aba_iframe = true;
      }
      $nmgp_tab_label = "";
      $delimitador = "##@@";
      if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']) && $bprocessa != "recarga" && $bprocessa != "save_form" && $bprocessa != "filter_save" && $bprocessa != "filter_delete")
      {
      }
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']) && $bprocessa != "recarga" && $bprocessa != "save_form" && $bprocessa != "filter_save" && $bprocessa != "filter_delete")
      { 
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca'], $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $participante_cpf = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['participante_cpf']; 
          $participante_cpf_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['participante_cpf_cond']; 
          $participante_nome = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['participante_nome']; 
          $participante_nome_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['participante_nome_cond']; 
          $tipo_pessoa = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['tipo_pessoa']; 
          $tipo_pessoa_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['tipo_pessoa_cond']; 
          $cod_cia_aerea = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['cod_cia_aerea']; 
          $cod_cia_aerea_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['cod_cia_aerea_cond']; 
          $cia_aerea = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['cia_aerea']; 
          $cia_aerea_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['cia_aerea_cond']; 
          $voo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['voo']; 
          $voo_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['voo_cond']; 
          $direcao = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['direcao']; 
          $direcao_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['direcao_cond']; 
          $origem = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['origem']; 
          $origem_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['origem_cond']; 
          $destino = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['destino']; 
          $destino_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['destino_cond']; 
          $localizador = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['localizador']; 
          $localizador_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['localizador_cond']; 
          $etkt = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['etkt']; 
          $etkt_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['etkt_cond']; 
          $emitida_bvt = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['emitida_bvt']; 
          $emitida_bvt_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['emitida_bvt_cond']; 
          $bloqueio_dsc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['bloqueio_dsc']; 
          $bloqueio_dsc_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['bloqueio_dsc_cond']; 
          $data_saida_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_saida_dia']; 
          $data_saida_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_saida_mes']; 
          $data_saida_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_saida_ano']; 
          $data_saida_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_saida_input_2_dia']; 
          $data_saida_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_saida_input_2_mes']; 
          $data_saida_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_saida_input_2_ano']; 
          $data_saida_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_saida_cond']; 
          $hora_saida_hor = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['hora_saida_hor']; 
          $hora_saida_min = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['hora_saida_min']; 
          $hora_saida_seg = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['hora_saida_seg']; 
          $hora_saida_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['hora_saida_cond']; 
          $data_chegada_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_chegada_dia']; 
          $data_chegada_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_chegada_mes']; 
          $data_chegada_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_chegada_ano']; 
          $data_chegada_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_chegada_input_2_dia']; 
          $data_chegada_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_chegada_input_2_mes']; 
          $data_chegada_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_chegada_input_2_ano']; 
          $data_chegada_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_chegada_cond']; 
          $hora_chegada_hor = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['hora_chegada_hor']; 
          $hora_chegada_min = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['hora_chegada_min']; 
          $hora_chegada_seg = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['hora_chegada_seg']; 
          $hora_chegada_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['hora_chegada_cond']; 
          $data_nota_gate_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_nota_gate_dia']; 
          $data_nota_gate_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_nota_gate_mes']; 
          $data_nota_gate_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_nota_gate_ano']; 
          $data_nota_gate_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_nota_gate_input_2_dia']; 
          $data_nota_gate_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_nota_gate_input_2_mes']; 
          $data_nota_gate_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_nota_gate_input_2_ano']; 
          $data_nota_gate_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_nota_gate_cond']; 
          $nota_gate = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['nota_gate']; 
          $nota_gate_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['nota_gate_cond']; 
          $this->NM_operador = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['NM_operador']; 
          if (strtoupper($cod_cia_aerea_cond) != "II" && strtoupper($cod_cia_aerea_cond) != "QP" && strtoupper($cod_cia_aerea_cond) != "NP" && strtoupper($cod_cia_aerea_cond) != "IN") 
          { 
              nmgp_Form_Num_Val($cod_cia_aerea, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
      } 
      if (!isset($participante_cpf_cond) || empty($participante_cpf_cond))
      {
         $participante_cpf_cond = "qp";
      }
      if (!isset($participante_nome_cond) || empty($participante_nome_cond))
      {
         $participante_nome_cond = "qp";
      }
      if (!isset($tipo_pessoa_cond) || empty($tipo_pessoa_cond))
      {
         $tipo_pessoa_cond = "qp";
      }
      if (!isset($cod_cia_aerea_cond) || empty($cod_cia_aerea_cond))
      {
         $cod_cia_aerea_cond = "gt";
      }
      if (!isset($cia_aerea_cond) || empty($cia_aerea_cond))
      {
         $cia_aerea_cond = "qp";
      }
      if (!isset($voo_cond) || empty($voo_cond))
      {
         $voo_cond = "qp";
      }
      if (!isset($direcao_cond) || empty($direcao_cond))
      {
         $direcao_cond = "qp";
      }
      if (!isset($origem_cond) || empty($origem_cond))
      {
         $origem_cond = "qp";
      }
      if (!isset($destino_cond) || empty($destino_cond))
      {
         $destino_cond = "qp";
      }
      if (!isset($localizador_cond) || empty($localizador_cond))
      {
         $localizador_cond = "qp";
      }
      if (!isset($etkt_cond) || empty($etkt_cond))
      {
         $etkt_cond = "qp";
      }
      if (!isset($emitida_bvt_cond) || empty($emitida_bvt_cond))
      {
         $emitida_bvt_cond = "qp";
      }
      if (!isset($bloqueio_dsc_cond) || empty($bloqueio_dsc_cond))
      {
         $bloqueio_dsc_cond = "qp";
      }
      if (!isset($data_saida_cond) || empty($data_saida_cond))
      {
         $data_saida_cond = "eq";
      }
      if (!isset($hora_saida_cond) || empty($hora_saida_cond))
      {
         $hora_saida_cond = "eq";
      }
      if (!isset($data_chegada_cond) || empty($data_chegada_cond))
      {
         $data_chegada_cond = "eq";
      }
      if (!isset($hora_chegada_cond) || empty($hora_chegada_cond))
      {
         $hora_chegada_cond = "eq";
      }
      if (!isset($data_nota_gate_cond) || empty($data_nota_gate_cond))
      {
         $data_nota_gate_cond = "eq";
      }
      if (!isset($nota_gate_cond) || empty($nota_gate_cond))
      {
         $nota_gate_cond = "qp";
      }
      $display_aberto  = "style=display:";
      $display_fechado = "style=display:none";
      $opc_hide_input = array("nu","nn","ep","ne");
      $str_hide_participante_cpf = (in_array($participante_cpf_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_participante_nome = (in_array($participante_nome_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tipo_pessoa = (in_array($tipo_pessoa_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_cod_cia_aerea = (in_array($cod_cia_aerea_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_cia_aerea = (in_array($cia_aerea_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_voo = (in_array($voo_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_direcao = (in_array($direcao_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_origem = (in_array($origem_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_destino = (in_array($destino_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_localizador = (in_array($localizador_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_etkt = (in_array($etkt_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_emitida_bvt = (in_array($emitida_bvt_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_bloqueio_dsc = (in_array($bloqueio_dsc_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_data_saida = (in_array($data_saida_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_hora_saida = (in_array($hora_saida_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_data_chegada = (in_array($data_chegada_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_hora_chegada = (in_array($hora_chegada_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_data_nota_gate = (in_array($data_nota_gate_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_nota_gate = (in_array($nota_gate_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;

      $str_display_participante_cpf = ('bw' == $participante_cpf_cond) ? $display_aberto : $display_fechado;
      $str_display_participante_nome = ('bw' == $participante_nome_cond) ? $display_aberto : $display_fechado;
      $str_display_tipo_pessoa = ('bw' == $tipo_pessoa_cond) ? $display_aberto : $display_fechado;
      $str_display_cod_cia_aerea = ('bw' == $cod_cia_aerea_cond) ? $display_aberto : $display_fechado;
      $str_display_cia_aerea = ('bw' == $cia_aerea_cond) ? $display_aberto : $display_fechado;
      $str_display_voo = ('bw' == $voo_cond) ? $display_aberto : $display_fechado;
      $str_display_direcao = ('bw' == $direcao_cond) ? $display_aberto : $display_fechado;
      $str_display_origem = ('bw' == $origem_cond) ? $display_aberto : $display_fechado;
      $str_display_destino = ('bw' == $destino_cond) ? $display_aberto : $display_fechado;
      $str_display_localizador = ('bw' == $localizador_cond) ? $display_aberto : $display_fechado;
      $str_display_etkt = ('bw' == $etkt_cond) ? $display_aberto : $display_fechado;
      $str_display_emitida_bvt = ('bw' == $emitida_bvt_cond) ? $display_aberto : $display_fechado;
      $str_display_bloqueio_dsc = ('bw' == $bloqueio_dsc_cond) ? $display_aberto : $display_fechado;
      $str_display_data_saida = ('bw' == $data_saida_cond) ? $display_aberto : $display_fechado;
      $str_display_hora_saida = ('bw' == $hora_saida_cond) ? $display_aberto : $display_fechado;
      $str_display_data_chegada = ('bw' == $data_chegada_cond) ? $display_aberto : $display_fechado;
      $str_display_hora_chegada = ('bw' == $hora_chegada_cond) ? $display_aberto : $display_fechado;
      $str_display_data_nota_gate = ('bw' == $data_nota_gate_cond) ? $display_aberto : $display_fechado;
      $str_display_nota_gate = ('bw' == $nota_gate_cond) ? $display_aberto : $display_fechado;

      if (!isset($participante_cpf) || $participante_cpf == "")
      {
          $participante_cpf = "";
      }
      if (isset($participante_cpf) && !empty($participante_cpf))
      {
         $tmp_pos = (is_string($participante_cpf)) ? strpos($participante_cpf, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $participante_cpf = substr($participante_cpf, 0, $tmp_pos);
         }
      }
      if (!isset($participante_nome) || $participante_nome == "")
      {
          $participante_nome = "";
      }
      if (isset($participante_nome) && !empty($participante_nome))
      {
         $tmp_pos = (is_string($participante_nome)) ? strpos($participante_nome, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $participante_nome = substr($participante_nome, 0, $tmp_pos);
         }
      }
      if (!isset($tipo_pessoa) || $tipo_pessoa == "")
      {
          $tipo_pessoa = "";
      }
      if (isset($tipo_pessoa) && !empty($tipo_pessoa))
      {
         $tmp_pos = (is_string($tipo_pessoa)) ? strpos($tipo_pessoa, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $tipo_pessoa = substr($tipo_pessoa, 0, $tmp_pos);
         }
      }
      if (!isset($cod_cia_aerea) || $cod_cia_aerea == "")
      {
          $cod_cia_aerea = "";
      }
      if (isset($cod_cia_aerea) && !empty($cod_cia_aerea))
      {
         $tmp_pos = (is_string($cod_cia_aerea)) ? strpos($cod_cia_aerea, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $cod_cia_aerea = substr($cod_cia_aerea, 0, $tmp_pos);
         }
      }
      if (!isset($cia_aerea) || $cia_aerea == "")
      {
          $cia_aerea = "";
      }
      if (isset($cia_aerea) && !empty($cia_aerea))
      {
         $tmp_pos = (is_string($cia_aerea)) ? strpos($cia_aerea, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $cia_aerea = substr($cia_aerea, 0, $tmp_pos);
         }
      }
      if (!isset($voo) || $voo == "")
      {
          $voo = "";
      }
      if (isset($voo) && !empty($voo))
      {
         $tmp_pos = (is_string($voo)) ? strpos($voo, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $voo = substr($voo, 0, $tmp_pos);
         }
      }
      if (!isset($direcao) || $direcao == "")
      {
          $direcao = "";
      }
      if (isset($direcao) && !empty($direcao))
      {
         $tmp_pos = (is_string($direcao)) ? strpos($direcao, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $direcao = substr($direcao, 0, $tmp_pos);
         }
      }
      if (!isset($origem) || $origem == "")
      {
          $origem = "";
      }
      if (isset($origem) && !empty($origem))
      {
         $tmp_pos = (is_string($origem)) ? strpos($origem, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $origem = substr($origem, 0, $tmp_pos);
         }
      }
      if (!isset($destino) || $destino == "")
      {
          $destino = "";
      }
      if (isset($destino) && !empty($destino))
      {
         $tmp_pos = (is_string($destino)) ? strpos($destino, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $destino = substr($destino, 0, $tmp_pos);
         }
      }
      if (!isset($localizador) || $localizador == "")
      {
          $localizador = "";
      }
      if (isset($localizador) && !empty($localizador))
      {
         $tmp_pos = (is_string($localizador)) ? strpos($localizador, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $localizador = substr($localizador, 0, $tmp_pos);
         }
      }
      if (!isset($etkt) || $etkt == "")
      {
          $etkt = "";
      }
      if (isset($etkt) && !empty($etkt))
      {
         $tmp_pos = (is_string($etkt)) ? strpos($etkt, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $etkt = substr($etkt, 0, $tmp_pos);
         }
      }
      if (!isset($emitida_bvt) || $emitida_bvt == "")
      {
          $emitida_bvt = "";
      }
      if (isset($emitida_bvt) && !empty($emitida_bvt))
      {
         $tmp_pos = (is_string($emitida_bvt)) ? strpos($emitida_bvt, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $emitida_bvt = substr($emitida_bvt, 0, $tmp_pos);
         }
      }
      if (!isset($bloqueio_dsc) || $bloqueio_dsc == "")
      {
          $bloqueio_dsc = "";
      }
      if (isset($bloqueio_dsc) && !empty($bloqueio_dsc))
      {
         $tmp_pos = (is_string($bloqueio_dsc)) ? strpos($bloqueio_dsc, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $bloqueio_dsc = substr($bloqueio_dsc, 0, $tmp_pos);
         }
      }
      if (!isset($data_saida) || $data_saida == "")
      {
          $data_saida = "";
      }
      if (isset($data_saida) && !empty($data_saida))
      {
         $tmp_pos = (is_string($data_saida)) ? strpos($data_saida, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $data_saida = substr($data_saida, 0, $tmp_pos);
         }
      }
      if (!isset($hora_saida) || $hora_saida == "")
      {
          $hora_saida = "";
      }
      if (isset($hora_saida) && !empty($hora_saida))
      {
         $tmp_pos = (is_string($hora_saida)) ? strpos($hora_saida, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $hora_saida = substr($hora_saida, 0, $tmp_pos);
         }
      }
      if (!isset($data_chegada) || $data_chegada == "")
      {
          $data_chegada = "";
      }
      if (isset($data_chegada) && !empty($data_chegada))
      {
         $tmp_pos = (is_string($data_chegada)) ? strpos($data_chegada, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $data_chegada = substr($data_chegada, 0, $tmp_pos);
         }
      }
      if (!isset($hora_chegada) || $hora_chegada == "")
      {
          $hora_chegada = "";
      }
      if (isset($hora_chegada) && !empty($hora_chegada))
      {
         $tmp_pos = (is_string($hora_chegada)) ? strpos($hora_chegada, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $hora_chegada = substr($hora_chegada, 0, $tmp_pos);
         }
      }
      if (!isset($data_nota_gate) || $data_nota_gate == "")
      {
          $data_nota_gate = "";
      }
      if (isset($data_nota_gate) && !empty($data_nota_gate))
      {
         $tmp_pos = (is_string($data_nota_gate)) ? strpos($data_nota_gate, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $data_nota_gate = substr($data_nota_gate, 0, $tmp_pos);
         }
      }
      if (!isset($nota_gate) || $nota_gate == "")
      {
          $nota_gate = "";
      }
      if (isset($nota_gate) && !empty($nota_gate))
      {
         $tmp_pos = (is_string($nota_gate)) ? strpos($nota_gate, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $nota_gate = substr($nota_gate, 0, $tmp_pos);
         }
      }
?>
 <?php
     if ($_SESSION['scriptcase']['proc_mobile'])
     {
     ?>
 <TR align="center">
  <TD class="scFilterTableTd" id='sc_filter_toolbar_top'>
   <table width="100%" class="scFilterToolbar"><tr>
    <td class="scFilterToolbarPadding" align="left" width="33%" nowrap>
   <?php echo nmButtonOutput($this->arr_buttons, "bpesquisa", "document.F1.bprocessa.value='pesq'; setTimeout(function() {nm_submit_form()}, 200);", "document.F1.bprocessa.value='pesq'; setTimeout(function() {nm_submit_form()}, 200);", "sc_b_pesq_top", "", "" . $this->Ini->Nm_lang['lang_btns_srch_lone'] . "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_srch_lone_hint'] . "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   if ($this->nmgp_botoes['clear'] == "on")
   {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "blimpar", "limpa_form();", "limpa_form();", "limpa_frm_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
<?php
   if (!isset($this->nmgp_botoes['save']) || $this->nmgp_botoes['save'] == "on")
   {
       $this->NM_fil_ant = $this->gera_array_filtros();
?>
     <span id="idAjaxSelect_NM_filters_top">
       <SELECT class="scFilterToolbar_obj" id="sel_recup_filters_top" name="NM_filters_top" onChange="nm_submit_filter(this, 'top');" size="1">
           <option value=""></option>
<?php
          $Nome_filter = "";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              $Select      = "";
              $Cada_filter = $Tipo_filter[2];
              if ($Cada_filter == $this->NM_curr_fil)
              {
                  $Select = "selected";
              }
              if (NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, $_SESSION['scriptcase']['charset'], "UTF-8");
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], $_SESSION['scriptcase']['charset'], "UTF-8");
              }
              elseif (!NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] == "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, "UTF-8", $_SESSION['scriptcase']['charset']);
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter = $Tipo_filter[1];
                  echo "           <option value=\"\">" . NM_encode_input($Nome_filter) . "</option>\r\n";
              }
?>
           <option value="<?php echo NM_encode_input($Tipo_filter[0]) . "\" " . $Select . ">.." . htmlspecialchars($Cada_filter) ?></option>
<?php
          }
?>
       </SELECT>
     </span>
<?php
   }
?>
<?php
   if ($this->nmgp_botoes['save'] == "on")
   {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "bedit_filter", "document.getElementById('Salvar_filters_top').style.display = ''; document.F1.nmgp_save_name_top.focus();", "document.getElementById('Salvar_filters_top').style.display = ''; document.F1.nmgp_save_name_top.focus();", "Ativa_save_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
<?php
   if (is_file("grid_aereopar_rsvp_r_help.txt"))
   {
      $Arq_WebHelp = file("grid_aereopar_rsvp_r_help.txt"); 
      if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
      {
          $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
          $Tmp = explode(";", $Arq_WebHelp[0]); 
          foreach ($Tmp as $Cada_help)
          {
              $Tmp1 = explode(":", $Cada_help); 
              if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "fil" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
              {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "sc_b_help_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
              }
          }
      }
   }
?>
<?php
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_aereopar_rsvp_r']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_aereopar_rsvp_r']['start'] == 'filter' && $nm_apl_dependente != 1)
   {
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.form_cancel.submit();", "document.form_cancel.submit();", "sc_b_cancel_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
   else
   {
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.form_cancel.submit();", "document.form_cancel.submit();", "sc_b_cancel_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
    </td>
   </tr></table>
<?php
   if ($this->nmgp_botoes['save'] == "on")
   {
?>
    </TD></TR><TR><TD>
    <DIV id="Salvar_filters_top" style="display:none;z-index:9999;">
     <TABLE align="center" class="scFilterTable">
      <TR>
       <TD class="scFilterBlock">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top" class="scFilterBlockFont"><?php echo $this->Ini->Nm_lang['lang_othr_srch_head'] ?></td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bcancelar_appdiv", "document.getElementById('Salvar_filters_top').style.display = 'none';", "document.getElementById('Salvar_filters_top').style.display = 'none';", "Cancel_frm_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </TD>
      </TR>
      <TR>
       <TD class="scFilterFieldOdd">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top">
           <input class="scFilterObjectOdd" type="text" id="SC_nmgp_save_name_top" name="nmgp_save_name_top" value="">
          </td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bsalvar_appdiv", "nm_save_form('top');", "nm_save_form('top');", "Save_frm_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </TD>
      </TR>
      <TR>
       <TD class="scFilterFieldEven">
       <DIV id="Apaga_filters_top" style="display:''">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top">
          <div id="idAjaxSelect_NM_filters_del_top">
           <SELECT class="scFilterObjectOdd" id="sel_filters_del_top" name="NM_filters_del_top" size="1">
            <option value=""></option>
<?php
          $Nome_filter = "";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              $Select = "";
              $Cada_filter = $Tipo_filter[2];
              if ($Cada_filter == $this->NM_curr_fil)
              {
                  $Select = "selected";
              }
              if (NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, $_SESSION['scriptcase']['charset'], "UTF-8");
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], $_SESSION['scriptcase']['charset'], "UTF-8");
              }
              elseif (!NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] == "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, "UTF-8", $_SESSION['scriptcase']['charset']);
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter = $Tipo_filter[1];
                  echo "            <option value=\"\">" . NM_encode_input($Nome_filter) . "</option>\r\n";
              }
?>
            <option value="<?php echo NM_encode_input($Tipo_filter[0]) . "\" " . $Select . ">.." . htmlspecialchars($Cada_filter) ?></option>
<?php
          }
?>
           </SELECT>
          </div>
          </td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bexcluir_appdiv", "nm_submit_filter_del('top');", "nm_submit_filter_del('top');", "Exc_filtro_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </DIV>
       </TD>
      </TR>
     </TABLE>
    </DIV> 
<?php
   }
?>
  </TD>
 </TR>
     <?php
     }
 ?>
 <TR align="center">
  <TD class="scFilterTableTd">
   <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
   <TR valign="top" >
  <TD width="100%" height="">
   <DIV class="scBlockFrame">
   <TABLE class="scFilterTable" id="hidden_bloco_0" valign="top" width="100%" style="height: 100%;">
   <tr valign="top">





      <TD id='SC_participante_cpf_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['participante_cpf'])) ? $this->New_label['participante_cpf'] : "Participante Cód."; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_participante_cpf_cond" name="participante_cpf_cond" onChange="nm_campos_between(document.getElementById('id_vis_participante_cpf'), this, 'participante_cpf')">
       <OPTION value="qp" <?php if ("qp" == $participante_cpf_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $participante_cpf_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $participante_cpf_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $participante_cpf_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_participante_cpf" <?php echo $str_hide_participante_cpf?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['participante_cpf'])) ? $this->New_label['participante_cpf'] : "Participante Cód.";
 $nmgp_tab_label .= "participante_cpf?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($participante_cpf != "")
      {
      $participante_cpf_look = (is_string($participante_cpf) ? substr($this->Db->qstr($participante_cpf), 1, -1) : $participante_cpf); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct participante_cpf from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#participante_cpf#lowerF# = #lowerI#'$participante_cpf_look'#lowerF# order by participante_cpf"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
      }
      if (isset($nmgp_def_dados[0][$participante_cpf]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$participante_cpf];
      }
      else
      {
          $sAutocompValue = $participante_cpf;
      }
?>
<INPUT  type="text" id="SC_participante_cpf" name="participante_cpf" value="<?php echo NM_encode_input($participante_cpf) ?>"  size=13 alt="{datatype: 'text', maxLength: 13, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_participante_cpf" name="participante_cpf_autocomp" size="13"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 13, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_participante_nome_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['participante_nome'])) ? $this->New_label['participante_nome'] : "Nome"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_participante_nome_cond" name="participante_nome_cond" onChange="nm_campos_between(document.getElementById('id_vis_participante_nome'), this, 'participante_nome')">
       <OPTION value="qp" <?php if ("qp" == $participante_nome_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $participante_nome_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $participante_nome_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $participante_nome_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_participante_nome" <?php echo $str_hide_participante_nome?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['participante_nome'])) ? $this->New_label['participante_nome'] : "Nome";
 $nmgp_tab_label .= "participante_nome?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($participante_nome != "")
      {
      $participante_nome_look = (is_string($participante_nome) ? substr($this->Db->qstr($participante_nome), 1, -1) : $participante_nome); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct participante_nome from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#participante_nome#lowerF# = #lowerI#'$participante_nome_look'#lowerF# order by participante_nome"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
      }
      if (isset($nmgp_def_dados[0][$participante_nome]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$participante_nome];
      }
      else
      {
          $sAutocompValue = $participante_nome;
      }
?>
<INPUT  type="text" id="SC_participante_nome" name="participante_nome" value="<?php echo NM_encode_input($participante_nome) ?>"  size=50 alt="{datatype: 'text', maxLength: 60, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_participante_nome" name="participante_nome_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 60, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_tipo_pessoa_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['tipo_pessoa'])) ? $this->New_label['tipo_pessoa'] : "Tipo"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_tipo_pessoa_cond" name="tipo_pessoa_cond" onChange="nm_campos_between(document.getElementById('id_vis_tipo_pessoa'), this, 'tipo_pessoa')">
       <OPTION value="qp" <?php if ("qp" == $tipo_pessoa_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $tipo_pessoa_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $tipo_pessoa_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $tipo_pessoa_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_tipo_pessoa" <?php echo $str_hide_tipo_pessoa?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['tipo_pessoa'])) ? $this->New_label['tipo_pessoa'] : "Tipo";
 $nmgp_tab_label .= "tipo_pessoa?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($tipo_pessoa != "")
      {
      $tipo_pessoa_look = (is_string($tipo_pessoa) ? substr($this->Db->qstr($tipo_pessoa), 1, -1) : $tipo_pessoa); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tipo_pessoa from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#tipo_pessoa#lowerF# = #lowerI#'$tipo_pessoa_look'#lowerF# order by tipo_pessoa"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
      }
      if (isset($nmgp_def_dados[0][$tipo_pessoa]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$tipo_pessoa];
      }
      else
      {
          $sAutocompValue = $tipo_pessoa;
      }
?>
<INPUT  type="text" id="SC_tipo_pessoa" name="tipo_pessoa" value="<?php echo NM_encode_input($tipo_pessoa) ?>"  size=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_tipo_pessoa" name="tipo_pessoa_autocomp" size="20"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_cod_cia_aerea_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['cod_cia_aerea'])) ? $this->New_label['cod_cia_aerea'] : "Cod Cia Aerea"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_cod_cia_aerea_cond" name="cod_cia_aerea_cond" onChange="nm_campos_between(document.getElementById('id_vis_cod_cia_aerea'), this, 'cod_cia_aerea')">
       <OPTION value="gt" <?php if ("gt" == $cod_cia_aerea_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $cod_cia_aerea_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $cod_cia_aerea_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_cod_cia_aerea" <?php echo $str_hide_cod_cia_aerea?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['cod_cia_aerea'])) ? $this->New_label['cod_cia_aerea'] : "Cod Cia Aerea";
 $nmgp_tab_label .= "cod_cia_aerea?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<INPUT  type="text" id="SC_cod_cia_aerea" name="cod_cia_aerea" value="<?php echo NM_encode_input($cod_cia_aerea) ?>" size=11 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" class="sc-js-input scFilterObjectEven">

        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_cia_aerea_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['cia_aerea'])) ? $this->New_label['cia_aerea'] : "Cia Aérea"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_cia_aerea_cond" name="cia_aerea_cond" onChange="nm_campos_between(document.getElementById('id_vis_cia_aerea'), this, 'cia_aerea')">
       <OPTION value="qp" <?php if ("qp" == $cia_aerea_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $cia_aerea_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $cia_aerea_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $cia_aerea_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_cia_aerea" <?php echo $str_hide_cia_aerea?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['cia_aerea'])) ? $this->New_label['cia_aerea'] : "Cia Aérea";
 $nmgp_tab_label .= "cia_aerea?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($cia_aerea != "")
      {
      $cia_aerea_look = (is_string($cia_aerea) ? substr($this->Db->qstr($cia_aerea), 1, -1) : $cia_aerea); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct cia_aerea from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#cia_aerea#lowerF# = #lowerI#'$cia_aerea_look'#lowerF# order by cia_aerea"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
      }
      if (isset($nmgp_def_dados[0][$cia_aerea]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$cia_aerea];
      }
      else
      {
          $sAutocompValue = $cia_aerea;
      }
?>
<INPUT  type="text" id="SC_cia_aerea" name="cia_aerea" value="<?php echo NM_encode_input($cia_aerea) ?>"  size=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_cia_aerea" name="cia_aerea_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 50, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_voo_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['voo'])) ? $this->New_label['voo'] : "Voo"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_voo_cond" name="voo_cond" onChange="nm_campos_between(document.getElementById('id_vis_voo'), this, 'voo')">
       <OPTION value="qp" <?php if ("qp" == $voo_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $voo_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $voo_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $voo_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_voo" <?php echo $str_hide_voo?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['voo'])) ? $this->New_label['voo'] : "Voo";
 $nmgp_tab_label .= "voo?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($voo != "")
      {
      $voo_look = (is_string($voo) ? substr($this->Db->qstr($voo), 1, -1) : $voo); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct voo from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#voo#lowerF# = #lowerI#'$voo_look'#lowerF# order by voo"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
      }
      if (isset($nmgp_def_dados[0][$voo]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$voo];
      }
      else
      {
          $sAutocompValue = $voo;
      }
?>
<INPUT  type="text" id="SC_voo" name="voo" value="<?php echo NM_encode_input($voo) ?>"  size=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_voo" name="voo_autocomp" size="20"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_direcao_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['direcao'])) ? $this->New_label['direcao'] : "Direção"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_direcao_cond" name="direcao_cond" onChange="nm_campos_between(document.getElementById('id_vis_direcao'), this, 'direcao')">
       <OPTION value="qp" <?php if ("qp" == $direcao_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $direcao_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $direcao_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $direcao_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_direcao" <?php echo $str_hide_direcao?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['direcao'])) ? $this->New_label['direcao'] : "Direção";
 $nmgp_tab_label .= "direcao?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($direcao != "")
      {
      $direcao_look = (is_string($direcao) ? substr($this->Db->qstr($direcao), 1, -1) : $direcao); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct direcao from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#direcao#lowerF# = #lowerI#'$direcao_look'#lowerF# order by direcao"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
      }
      if (isset($nmgp_def_dados[0][$direcao]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$direcao];
      }
      else
      {
          $sAutocompValue = $direcao;
      }
?>
<INPUT  type="text" id="SC_direcao" name="direcao" value="<?php echo NM_encode_input($direcao) ?>"  size=10 alt="{datatype: 'text', maxLength: 10, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_direcao" name="direcao_autocomp" size="10"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 10, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_origem_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['origem'])) ? $this->New_label['origem'] : "Origem"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_origem_cond" name="origem_cond" onChange="nm_campos_between(document.getElementById('id_vis_origem'), this, 'origem')">
       <OPTION value="qp" <?php if ("qp" == $origem_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $origem_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $origem_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $origem_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_origem" <?php echo $str_hide_origem?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['origem'])) ? $this->New_label['origem'] : "Origem";
 $nmgp_tab_label .= "origem?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($origem != "")
      {
      $origem_look = (is_string($origem) ? substr($this->Db->qstr($origem), 1, -1) : $origem); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct origem from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#origem#lowerF# = #lowerI#'$origem_look'#lowerF# order by origem"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
      }
      if (isset($nmgp_def_dados[0][$origem]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$origem];
      }
      else
      {
          $sAutocompValue = $origem;
      }
?>
<INPUT  type="text" id="SC_origem" name="origem" value="<?php echo NM_encode_input($origem) ?>"  size=50 alt="{datatype: 'text', maxLength: 150, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_origem" name="origem_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 150, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_destino_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['destino'])) ? $this->New_label['destino'] : "Destino"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_destino_cond" name="destino_cond" onChange="nm_campos_between(document.getElementById('id_vis_destino'), this, 'destino')">
       <OPTION value="qp" <?php if ("qp" == $destino_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $destino_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $destino_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $destino_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_destino" <?php echo $str_hide_destino?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['destino'])) ? $this->New_label['destino'] : "Destino";
 $nmgp_tab_label .= "destino?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($destino != "")
      {
      $destino_look = (is_string($destino) ? substr($this->Db->qstr($destino), 1, -1) : $destino); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct destino from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#destino#lowerF# = #lowerI#'$destino_look'#lowerF# order by destino"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
      }
      if (isset($nmgp_def_dados[0][$destino]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$destino];
      }
      else
      {
          $sAutocompValue = $destino;
      }
?>
<INPUT  type="text" id="SC_destino" name="destino" value="<?php echo NM_encode_input($destino) ?>"  size=50 alt="{datatype: 'text', maxLength: 150, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_destino" name="destino_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 150, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_localizador_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['localizador'])) ? $this->New_label['localizador'] : "Localizador"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_localizador_cond" name="localizador_cond" onChange="nm_campos_between(document.getElementById('id_vis_localizador'), this, 'localizador')">
       <OPTION value="qp" <?php if ("qp" == $localizador_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $localizador_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $localizador_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $localizador_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_localizador" <?php echo $str_hide_localizador?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['localizador'])) ? $this->New_label['localizador'] : "Localizador";
 $nmgp_tab_label .= "localizador?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($localizador != "")
      {
      $localizador_look = (is_string($localizador) ? substr($this->Db->qstr($localizador), 1, -1) : $localizador); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct localizador from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#localizador#lowerF# = #lowerI#'$localizador_look'#lowerF# order by localizador"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
      }
      if (isset($nmgp_def_dados[0][$localizador]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$localizador];
      }
      else
      {
          $sAutocompValue = $localizador;
      }
?>
<INPUT  type="text" id="SC_localizador" name="localizador" value="<?php echo NM_encode_input($localizador) ?>"  size=15 alt="{datatype: 'text', maxLength: 15, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_localizador" name="localizador_autocomp" size="15"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 15, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_etkt_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['etkt'])) ? $this->New_label['etkt'] : "Etkt"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_etkt_cond" name="etkt_cond" onChange="nm_campos_between(document.getElementById('id_vis_etkt'), this, 'etkt')">
       <OPTION value="qp" <?php if ("qp" == $etkt_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $etkt_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $etkt_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $etkt_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_etkt" <?php echo $str_hide_etkt?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['etkt'])) ? $this->New_label['etkt'] : "Etkt";
 $nmgp_tab_label .= "etkt?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($etkt != "")
      {
      $etkt_look = (is_string($etkt) ? substr($this->Db->qstr($etkt), 1, -1) : $etkt); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct etkt from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#etkt#lowerF# = #lowerI#'$etkt_look'#lowerF# order by etkt"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
      }
      if (isset($nmgp_def_dados[0][$etkt]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$etkt];
      }
      else
      {
          $sAutocompValue = $etkt;
      }
?>
<INPUT  type="text" id="SC_etkt" name="etkt" value="<?php echo NM_encode_input($etkt) ?>"  size=15 alt="{datatype: 'text', maxLength: 15, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_etkt" name="etkt_autocomp" size="15"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 15, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_emitida_bvt_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['emitida_bvt'])) ? $this->New_label['emitida_bvt'] : "Emitida Bvt"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_emitida_bvt_cond" name="emitida_bvt_cond" onChange="nm_campos_between(document.getElementById('id_vis_emitida_bvt'), this, 'emitida_bvt')">
       <OPTION value="qp" <?php if ("qp" == $emitida_bvt_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $emitida_bvt_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $emitida_bvt_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $emitida_bvt_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_emitida_bvt" <?php echo $str_hide_emitida_bvt?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['emitida_bvt'])) ? $this->New_label['emitida_bvt'] : "Emitida Bvt";
 $nmgp_tab_label .= "emitida_bvt?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($emitida_bvt != "")
      {
      $emitida_bvt_look = (is_string($emitida_bvt) ? substr($this->Db->qstr($emitida_bvt), 1, -1) : $emitida_bvt); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct emitida_bvt from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#emitida_bvt#lowerF# = #lowerI#'$emitida_bvt_look'#lowerF# order by emitida_bvt"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
      }
      if (isset($nmgp_def_dados[0][$emitida_bvt]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$emitida_bvt];
      }
      else
      {
          $sAutocompValue = $emitida_bvt;
      }
?>
<INPUT  type="text" id="SC_emitida_bvt" name="emitida_bvt" value="<?php echo NM_encode_input($emitida_bvt) ?>"  size=3 alt="{datatype: 'text', maxLength: 3, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_emitida_bvt" name="emitida_bvt_autocomp" size="3"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 3, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_bloqueio_dsc_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['bloqueio_dsc'])) ? $this->New_label['bloqueio_dsc'] : "Bloqueio"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_bloqueio_dsc_cond" name="bloqueio_dsc_cond" onChange="nm_campos_between(document.getElementById('id_vis_bloqueio_dsc'), this, 'bloqueio_dsc')">
       <OPTION value="qp" <?php if ("qp" == $bloqueio_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $bloqueio_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $bloqueio_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $bloqueio_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_bloqueio_dsc" <?php echo $str_hide_bloqueio_dsc?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['bloqueio_dsc'])) ? $this->New_label['bloqueio_dsc'] : "Bloqueio";
 $nmgp_tab_label .= "bloqueio_dsc?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($bloqueio_dsc != "")
      {
      $bloqueio_dsc_look = (is_string($bloqueio_dsc) ? substr($this->Db->qstr($bloqueio_dsc), 1, -1) : $bloqueio_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct bloqueio_dsc from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#bloqueio_dsc#lowerF# = #lowerI#'$bloqueio_dsc_look'#lowerF# order by bloqueio_dsc"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
      }
      if (isset($nmgp_def_dados[0][$bloqueio_dsc]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$bloqueio_dsc];
      }
      else
      {
          $sAutocompValue = $bloqueio_dsc;
      }
?>
<INPUT  type="text" id="SC_bloqueio_dsc" name="bloqueio_dsc" value="<?php echo NM_encode_input($bloqueio_dsc) ?>"  size=50 alt="{datatype: 'text', maxLength: 150, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_bloqueio_dsc" name="bloqueio_dsc_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 150, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_data_saida_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['data_saida'])) ? $this->New_label['data_saida'] : "Data Saída"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_data_saida_cond" name="data_saida_cond" onChange="nm_campos_between(document.getElementById('id_vis_data_saida'), this, 'data_saida')">
       <OPTION value="eq" <?php if ("eq" == $data_saida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="gt" <?php if ("gt" == $data_saida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $data_saida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $data_saida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_data_saida" <?php echo $str_hide_data_saida?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['data_saida'])) ? $this->New_label['data_saida'] : "Data Saída";
 $nmgp_tab_label .= "data_saida?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>

<?php
  $Form_base = "ddmmyyyy";
  $date_format_show = "";
  $Str_date = str_replace("a", "y", strtolower($_SESSION['scriptcase']['reg_conf']['date_format']));
  $Lim   = strlen($Str_date);
  $Str   = "";
  $Ult   = "";
  $Arr_D = array();
  for ($I = 0; $I < $Lim; $I++)
  {
      $Char = substr($Str_date, $I, 1);
      if ($Char != $Ult && "" != $Str)
      {
          $Arr_D[] = $Str;
          $Str     = $Char;
      }
      else
      {
          $Str    .= $Char;
      }
      $Ult = $Char;
  }
  $Arr_D[] = $Str;
  $Prim = true;
  foreach ($Arr_D as $Cada_d)
  {
      if (strpos($Form_base, $Cada_d) !== false)
      {
          $date_format_show .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
          $date_format_show .= $Cada_d;
          $Prim = false;
      }
  }
  $Arr_format = $Arr_D;
  $date_format_show = str_replace("dd",   $this->Ini->Nm_lang['lang_othr_date_days'], $date_format_show);
  $date_format_show = str_replace("mm",   $this->Ini->Nm_lang['lang_othr_date_mnth'], $date_format_show);
  $date_format_show = str_replace("yyyy", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
  $date_format_show = str_replace("aaaa", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
  $date_format_show = str_replace("hh",   $this->Ini->Nm_lang['lang_othr_date_hour'], $date_format_show);
  $date_format_show = str_replace("ii",   $this->Ini->Nm_lang['lang_othr_date_mint'], $date_format_show);
  $date_format_show = str_replace("ss",   $this->Ini->Nm_lang['lang_othr_date_scnd'], $date_format_show);
  $date_format_show = "" . $date_format_show .  "";

?>

         <?php

$bol_generate_calendar = true;
$bol_last = false;
foreach ($Arr_format as $_key => $Part_date)
{
if(!isset($Arr_format[ $_key + 1 ]))
{
  $bol_last = true;
}
?>
<?php
  if (substr($Part_date, 0,1) == "d")
  {
?>
<span id='id_date_part_data_saida_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_data_saida_dia" name="data_saida_dia" value="<?php echo NM_encode_input($data_saida_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
<?php
}
?>
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "m")
  {
?>
<span id='id_date_part_data_saida_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_data_saida_mes" name="data_saida_mes" value="<?php echo NM_encode_input($data_saida_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
<?php
}
?>
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "y")
  {
?>
<span id='id_date_part_data_saida_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_data_saida_ano" name="data_saida_ano" value="<?php echo NM_encode_input($data_saida_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
 <?php
if($bol_generate_calendar && $bol_last)
{
?>
<?php
}
?>
</span>

<?php
  }
?>

<?php

}

?>
        <SPAN id="id_css_data_saida"  class="scFilterFieldFontEven">
 <?php echo $date_format_show ?>         </SPAN>
                 </TD>
       </TR>
       <TR valign="top">
        <TD id="id_vis_data_saida"  <?php echo $str_display_data_saida; ?> class="scFilterFieldFontEven">
         <?php echo $date_sep_bw ?>
         <BR>
         
         <?php

$bol_generate_calendar = true;
$bol_last = false;
foreach ($Arr_format as $_key => $Part_date)
{
if(!isset($Arr_format[ $_key + 1 ]))
{
  $bol_last = true;
}
?>
<?php
  if (substr($Part_date, 0,1) == "d")
  {
?>
<span id='id_date_part_data_saida_input_2_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_data_saida_input_2_dia" name="data_saida_input_2_dia" value="<?php echo NM_encode_input($data_saida_input_2_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
<?php
}
?>
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "m")
  {
?>
<span id='id_date_part_data_saida_input_2_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_data_saida_input_2_mes" name="data_saida_input_2_mes" value="<?php echo NM_encode_input($data_saida_input_2_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
<?php
}
?>
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "y")
  {
?>
<span id='id_date_part_data_saida_input_2_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_data_saida_input_2_ano" name="data_saida_input_2_ano" value="<?php echo NM_encode_input($data_saida_input_2_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
 <?php
if($bol_generate_calendar && $bol_last)
{
?>
<?php
}
?>
</span>

<?php
  }
?>

<?php

}

?>

        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_hora_saida_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['hora_saida'])) ? $this->New_label['hora_saida'] : "Hora Saída"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_hora_saida_cond" name="hora_saida_cond" onChange="nm_campos_between(document.getElementById('id_vis_hora_saida'), this, 'hora_saida')">
       <OPTION value="eq" <?php if ("eq" == $hora_saida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ii" <?php if ("ii" == $hora_saida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_stts_with'] ?></OPTION>
       <OPTION value="qp" <?php if ("qp" == $hora_saida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="df" <?php if ("df" == $hora_saida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_dife'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_hora_saida" <?php echo $str_hide_hora_saida?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['hora_saida'])) ? $this->New_label['hora_saida'] : "Hora Saída";
 $nmgp_tab_label .= "hora_saida?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>

<?php
  $Form_base = "hhiiss";
  $date_format_show = "";
  $Str_time = strtolower($_SESSION['scriptcase']['reg_conf']['time_format']);
  $Lim   = strlen($Str_time);
  $Str   = "";
  $Ult   = "";
  $Arr_T = array();
  for ($I = 0; $I < $Lim; $I++)
  {
      $Char = substr($Str_time, $I, 1);
      if ($Char != $Ult && "" != $Str)
      {
          $Arr_T[] = $Str;
          $Str     = $Char;
      }
      else
      {
          $Str    .= $Char;
      }
      $Ult = $Char;
  }
  $Arr_T[] = $Str;
  $Prim = true;
  foreach ($Arr_T as $Cada_t)
  {
      if (strpos($Form_base, $Cada_t) !== false)
      {
          $date_format_show .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['time_sep'] : "";
          $date_format_show .= $Cada_t;
          $Prim = false;
      }
  }
  $Arr_format = $Arr_T;
  $date_format_show = str_replace("dd",   $this->Ini->Nm_lang['lang_othr_date_days'], $date_format_show);
  $date_format_show = str_replace("mm",   $this->Ini->Nm_lang['lang_othr_date_mnth'], $date_format_show);
  $date_format_show = str_replace("yyyy", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
  $date_format_show = str_replace("aaaa", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
  $date_format_show = str_replace("hh",   $this->Ini->Nm_lang['lang_othr_date_hour'], $date_format_show);
  $date_format_show = str_replace("ii",   $this->Ini->Nm_lang['lang_othr_date_mint'], $date_format_show);
  $date_format_show = str_replace("ss",   $this->Ini->Nm_lang['lang_othr_date_scnd'], $date_format_show);
  $date_format_show = "" . $date_format_show .  "";

?>

         <?php

$bol_generate_calendar = true;
$bol_last = false;
foreach ($Arr_format as $_key => $Part_date)
{
if(!isset($Arr_format[ $_key + 1 ]))
{
  $bol_last = true;
}
?>
<?php
  if (substr($Part_date, 0,1) == "h")
  {
?>
<span id='id_date_part_hora_saida_HH' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_hora_saida_hor" name="hora_saida_hor" value="<?php echo NM_encode_input($hora_saida_hor); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
<?php
}
?>
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "i")
  {
?>
<span id='id_date_part_hora_saida_II' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_hora_saida_min" name="hora_saida_min" value="<?php echo NM_encode_input($hora_saida_min); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
<?php
}
?>
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "s")
  {
?>
<span id='id_date_part_hora_saida_SS' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_hora_saida_seg" name="hora_saida_seg" value="<?php echo NM_encode_input($hora_saida_seg); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
<?php
}
?>
</span>

<?php
  }
?>

<?php

}

?>
        <SPAN id="id_css_hora_saida"  class="scFilterFieldFontOdd">
 <?php echo $date_format_show ?>         </SPAN>
         
        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_data_chegada_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['data_chegada'])) ? $this->New_label['data_chegada'] : "Data Chegada"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_data_chegada_cond" name="data_chegada_cond" onChange="nm_campos_between(document.getElementById('id_vis_data_chegada'), this, 'data_chegada')">
       <OPTION value="eq" <?php if ("eq" == $data_chegada_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="gt" <?php if ("gt" == $data_chegada_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $data_chegada_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $data_chegada_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_data_chegada" <?php echo $str_hide_data_chegada?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['data_chegada'])) ? $this->New_label['data_chegada'] : "Data Chegada";
 $nmgp_tab_label .= "data_chegada?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>

<?php
  $Form_base = "ddmmyyyy";
  $date_format_show = "";
  $Str_date = str_replace("a", "y", strtolower($_SESSION['scriptcase']['reg_conf']['date_format']));
  $Lim   = strlen($Str_date);
  $Str   = "";
  $Ult   = "";
  $Arr_D = array();
  for ($I = 0; $I < $Lim; $I++)
  {
      $Char = substr($Str_date, $I, 1);
      if ($Char != $Ult && "" != $Str)
      {
          $Arr_D[] = $Str;
          $Str     = $Char;
      }
      else
      {
          $Str    .= $Char;
      }
      $Ult = $Char;
  }
  $Arr_D[] = $Str;
  $Prim = true;
  foreach ($Arr_D as $Cada_d)
  {
      if (strpos($Form_base, $Cada_d) !== false)
      {
          $date_format_show .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
          $date_format_show .= $Cada_d;
          $Prim = false;
      }
  }
  $Arr_format = $Arr_D;
  $date_format_show = str_replace("dd",   $this->Ini->Nm_lang['lang_othr_date_days'], $date_format_show);
  $date_format_show = str_replace("mm",   $this->Ini->Nm_lang['lang_othr_date_mnth'], $date_format_show);
  $date_format_show = str_replace("yyyy", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
  $date_format_show = str_replace("aaaa", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
  $date_format_show = str_replace("hh",   $this->Ini->Nm_lang['lang_othr_date_hour'], $date_format_show);
  $date_format_show = str_replace("ii",   $this->Ini->Nm_lang['lang_othr_date_mint'], $date_format_show);
  $date_format_show = str_replace("ss",   $this->Ini->Nm_lang['lang_othr_date_scnd'], $date_format_show);
  $date_format_show = "" . $date_format_show .  "";

?>

         <?php

$bol_generate_calendar = true;
$bol_last = false;
foreach ($Arr_format as $_key => $Part_date)
{
if(!isset($Arr_format[ $_key + 1 ]))
{
  $bol_last = true;
}
?>
<?php
  if (substr($Part_date, 0,1) == "d")
  {
?>
<span id='id_date_part_data_chegada_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_data_chegada_dia" name="data_chegada_dia" value="<?php echo NM_encode_input($data_chegada_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
<?php
}
?>
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "m")
  {
?>
<span id='id_date_part_data_chegada_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_data_chegada_mes" name="data_chegada_mes" value="<?php echo NM_encode_input($data_chegada_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
<?php
}
?>
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "y")
  {
?>
<span id='id_date_part_data_chegada_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_data_chegada_ano" name="data_chegada_ano" value="<?php echo NM_encode_input($data_chegada_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
 <?php
if($bol_generate_calendar && $bol_last)
{
?>
<?php
}
?>
</span>

<?php
  }
?>

<?php

}

?>
        <SPAN id="id_css_data_chegada"  class="scFilterFieldFontEven">
 <?php echo $date_format_show ?>         </SPAN>
                 </TD>
       </TR>
       <TR valign="top">
        <TD id="id_vis_data_chegada"  <?php echo $str_display_data_chegada; ?> class="scFilterFieldFontEven">
         <?php echo $date_sep_bw ?>
         <BR>
         
         <?php

$bol_generate_calendar = true;
$bol_last = false;
foreach ($Arr_format as $_key => $Part_date)
{
if(!isset($Arr_format[ $_key + 1 ]))
{
  $bol_last = true;
}
?>
<?php
  if (substr($Part_date, 0,1) == "d")
  {
?>
<span id='id_date_part_data_chegada_input_2_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_data_chegada_input_2_dia" name="data_chegada_input_2_dia" value="<?php echo NM_encode_input($data_chegada_input_2_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
<?php
}
?>
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "m")
  {
?>
<span id='id_date_part_data_chegada_input_2_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_data_chegada_input_2_mes" name="data_chegada_input_2_mes" value="<?php echo NM_encode_input($data_chegada_input_2_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
<?php
}
?>
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "y")
  {
?>
<span id='id_date_part_data_chegada_input_2_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_data_chegada_input_2_ano" name="data_chegada_input_2_ano" value="<?php echo NM_encode_input($data_chegada_input_2_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
 <?php
if($bol_generate_calendar && $bol_last)
{
?>
<?php
}
?>
</span>

<?php
  }
?>

<?php

}

?>

        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_hora_chegada_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['hora_chegada'])) ? $this->New_label['hora_chegada'] : "Hora Chegada"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_hora_chegada_cond" name="hora_chegada_cond" onChange="nm_campos_between(document.getElementById('id_vis_hora_chegada'), this, 'hora_chegada')">
       <OPTION value="eq" <?php if ("eq" == $hora_chegada_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ii" <?php if ("ii" == $hora_chegada_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_stts_with'] ?></OPTION>
       <OPTION value="qp" <?php if ("qp" == $hora_chegada_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="df" <?php if ("df" == $hora_chegada_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_dife'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_hora_chegada" <?php echo $str_hide_hora_chegada?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['hora_chegada'])) ? $this->New_label['hora_chegada'] : "Hora Chegada";
 $nmgp_tab_label .= "hora_chegada?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>

<?php
  $Form_base = "hhiiss";
  $date_format_show = "";
  $Str_time = strtolower($_SESSION['scriptcase']['reg_conf']['time_format']);
  $Lim   = strlen($Str_time);
  $Str   = "";
  $Ult   = "";
  $Arr_T = array();
  for ($I = 0; $I < $Lim; $I++)
  {
      $Char = substr($Str_time, $I, 1);
      if ($Char != $Ult && "" != $Str)
      {
          $Arr_T[] = $Str;
          $Str     = $Char;
      }
      else
      {
          $Str    .= $Char;
      }
      $Ult = $Char;
  }
  $Arr_T[] = $Str;
  $Prim = true;
  foreach ($Arr_T as $Cada_t)
  {
      if (strpos($Form_base, $Cada_t) !== false)
      {
          $date_format_show .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['time_sep'] : "";
          $date_format_show .= $Cada_t;
          $Prim = false;
      }
  }
  $Arr_format = $Arr_T;
  $date_format_show = str_replace("dd",   $this->Ini->Nm_lang['lang_othr_date_days'], $date_format_show);
  $date_format_show = str_replace("mm",   $this->Ini->Nm_lang['lang_othr_date_mnth'], $date_format_show);
  $date_format_show = str_replace("yyyy", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
  $date_format_show = str_replace("aaaa", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
  $date_format_show = str_replace("hh",   $this->Ini->Nm_lang['lang_othr_date_hour'], $date_format_show);
  $date_format_show = str_replace("ii",   $this->Ini->Nm_lang['lang_othr_date_mint'], $date_format_show);
  $date_format_show = str_replace("ss",   $this->Ini->Nm_lang['lang_othr_date_scnd'], $date_format_show);
  $date_format_show = "" . $date_format_show .  "";

?>

         <?php

$bol_generate_calendar = true;
$bol_last = false;
foreach ($Arr_format as $_key => $Part_date)
{
if(!isset($Arr_format[ $_key + 1 ]))
{
  $bol_last = true;
}
?>
<?php
  if (substr($Part_date, 0,1) == "h")
  {
?>
<span id='id_date_part_hora_chegada_HH' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_hora_chegada_hor" name="hora_chegada_hor" value="<?php echo NM_encode_input($hora_chegada_hor); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
<?php
}
?>
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "i")
  {
?>
<span id='id_date_part_hora_chegada_II' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_hora_chegada_min" name="hora_chegada_min" value="<?php echo NM_encode_input($hora_chegada_min); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
<?php
}
?>
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "s")
  {
?>
<span id='id_date_part_hora_chegada_SS' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_hora_chegada_seg" name="hora_chegada_seg" value="<?php echo NM_encode_input($hora_chegada_seg); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
<?php
}
?>
</span>

<?php
  }
?>

<?php

}

?>
        <SPAN id="id_css_hora_chegada"  class="scFilterFieldFontOdd">
 <?php echo $date_format_show ?>         </SPAN>
         
        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_data_nota_gate_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['data_nota_gate'])) ? $this->New_label['data_nota_gate'] : "Data Nota Gate"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_data_nota_gate_cond" name="data_nota_gate_cond" onChange="nm_campos_between(document.getElementById('id_vis_data_nota_gate'), this, 'data_nota_gate')">
       <OPTION value="eq" <?php if ("eq" == $data_nota_gate_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="gt" <?php if ("gt" == $data_nota_gate_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $data_nota_gate_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $data_nota_gate_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_data_nota_gate" <?php echo $str_hide_data_nota_gate?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['data_nota_gate'])) ? $this->New_label['data_nota_gate'] : "Data Nota Gate";
 $nmgp_tab_label .= "data_nota_gate?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>

<?php
  $Form_base = "ddmmyyyy";
  $date_format_show = "";
  $Str_date = str_replace("a", "y", strtolower($_SESSION['scriptcase']['reg_conf']['date_format']));
  $Lim   = strlen($Str_date);
  $Str   = "";
  $Ult   = "";
  $Arr_D = array();
  for ($I = 0; $I < $Lim; $I++)
  {
      $Char = substr($Str_date, $I, 1);
      if ($Char != $Ult && "" != $Str)
      {
          $Arr_D[] = $Str;
          $Str     = $Char;
      }
      else
      {
          $Str    .= $Char;
      }
      $Ult = $Char;
  }
  $Arr_D[] = $Str;
  $Prim = true;
  foreach ($Arr_D as $Cada_d)
  {
      if (strpos($Form_base, $Cada_d) !== false)
      {
          $date_format_show .= (!$Prim) ? $_SESSION['scriptcase']['reg_conf']['date_sep'] : "";
          $date_format_show .= $Cada_d;
          $Prim = false;
      }
  }
  $Arr_format = $Arr_D;
  $date_format_show = str_replace("dd",   $this->Ini->Nm_lang['lang_othr_date_days'], $date_format_show);
  $date_format_show = str_replace("mm",   $this->Ini->Nm_lang['lang_othr_date_mnth'], $date_format_show);
  $date_format_show = str_replace("yyyy", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
  $date_format_show = str_replace("aaaa", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
  $date_format_show = str_replace("hh",   $this->Ini->Nm_lang['lang_othr_date_hour'], $date_format_show);
  $date_format_show = str_replace("ii",   $this->Ini->Nm_lang['lang_othr_date_mint'], $date_format_show);
  $date_format_show = str_replace("ss",   $this->Ini->Nm_lang['lang_othr_date_scnd'], $date_format_show);
  $date_format_show = "" . $date_format_show .  "";

?>

         <?php

$bol_generate_calendar = true;
$bol_last = false;
foreach ($Arr_format as $_key => $Part_date)
{
if(!isset($Arr_format[ $_key + 1 ]))
{
  $bol_last = true;
}
?>
<?php
  if (substr($Part_date, 0,1) == "d")
  {
?>
<span id='id_date_part_data_nota_gate_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_data_nota_gate_dia" name="data_nota_gate_dia" value="<?php echo NM_encode_input($data_nota_gate_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
<?php
}
?>
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "m")
  {
?>
<span id='id_date_part_data_nota_gate_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_data_nota_gate_mes" name="data_nota_gate_mes" value="<?php echo NM_encode_input($data_nota_gate_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
<?php
}
?>
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "y")
  {
?>
<span id='id_date_part_data_nota_gate_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_data_nota_gate_ano" name="data_nota_gate_ano" value="<?php echo NM_encode_input($data_nota_gate_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
 <?php
if($bol_generate_calendar && $bol_last)
{
?>
<?php
}
?>
</span>

<?php
  }
?>

<?php

}

?>
        <SPAN id="id_css_data_nota_gate"  class="scFilterFieldFontEven">
 <?php echo $date_format_show ?>         </SPAN>
                 </TD>
       </TR>
       <TR valign="top">
        <TD id="id_vis_data_nota_gate"  <?php echo $str_display_data_nota_gate; ?> class="scFilterFieldFontEven">
         <?php echo $date_sep_bw ?>
         <BR>
         
         <?php

$bol_generate_calendar = true;
$bol_last = false;
foreach ($Arr_format as $_key => $Part_date)
{
if(!isset($Arr_format[ $_key + 1 ]))
{
  $bol_last = true;
}
?>
<?php
  if (substr($Part_date, 0,1) == "d")
  {
?>
<span id='id_date_part_data_nota_gate_input_2_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_data_nota_gate_input_2_dia" name="data_nota_gate_input_2_dia" value="<?php echo NM_encode_input($data_nota_gate_input_2_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
<?php
}
?>
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "m")
  {
?>
<span id='id_date_part_data_nota_gate_input_2_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_data_nota_gate_input_2_mes" name="data_nota_gate_input_2_mes" value="<?php echo NM_encode_input($data_nota_gate_input_2_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
<?php
if($bol_generate_calendar && $bol_last)
{
?>
<?php
}
?>
</span>

<?php
  }
?>
<?php
  if (substr($Part_date, 0,1) == "y")
  {
?>
<span id='id_date_part_data_nota_gate_input_2_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_data_nota_gate_input_2_ano" name="data_nota_gate_input_2_ano" value="<?php echo NM_encode_input($data_nota_gate_input_2_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
 <?php
if($bol_generate_calendar && $bol_last)
{
?>
<?php
}
?>
</span>

<?php
  }
?>

<?php

}

?>

        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_nota_gate_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['nota_gate'])) ? $this->New_label['nota_gate'] : "Nota Gate"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_nota_gate_cond" name="nota_gate_cond" onChange="nm_campos_between(document.getElementById('id_vis_nota_gate'), this, 'nota_gate')">
       <OPTION value="qp" <?php if ("qp" == $nota_gate_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $nota_gate_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $nota_gate_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $nota_gate_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_nota_gate" <?php echo $str_hide_nota_gate?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['nota_gate'])) ? $this->New_label['nota_gate'] : "Nota Gate";
 $nmgp_tab_label .= "nota_gate?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($nota_gate != "")
      {
      $nota_gate_look = (is_string($nota_gate) ? substr($this->Db->qstr($nota_gate), 1, -1) : $nota_gate); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct nota_gate from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#nota_gate#lowerF# = #lowerI#'$nota_gate_look'#lowerF# order by nota_gate"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = trim($rs->fields[0]);
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 
      }
      if (isset($nmgp_def_dados[0][$nota_gate]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$nota_gate];
      }
      else
      {
          $sAutocompValue = $nota_gate;
      }
?>
<INPUT  type="text" id="SC_nota_gate" name="nota_gate" value="<?php echo NM_encode_input($nota_gate) ?>"  size=15 alt="{datatype: 'text', maxLength: 15, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_nota_gate" name="nota_gate_autocomp" size="15"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 15, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr>
   </TABLE>
   </DIV>
  </TD>
 </TR>
 </TABLE>
 </TD>
 </TR>
 <TR>
  <TD class="scFilterTableTd" align="center">
<INPUT type="hidden" id="SC_NM_operador" name="NM_operador" value="and">  </TD>
 </TR>
   <INPUT type="hidden" name="nmgp_tab_label" value="<?php echo NM_encode_input($nmgp_tab_label); ?>"> 
   <INPUT type="hidden" name="bprocessa" value="pesq"> 
<?php
    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['pesq_tab_label'] = $nmgp_tab_label;
?>
 <?php
     if (!$_SESSION['scriptcase']['proc_mobile'])
     {
     ?>
 <TR align="center">
  <TD class="scFilterTableTd" id='sc_filter_toolbar_bot'>
   <table width="100%" class="scFilterToolbar"><tr>
    <td class="scFilterToolbarPadding" align="left" width="33%" nowrap>
    </td>
    <td class="scFilterToolbarPadding" align="center" width="33%" nowrap>
   <?php echo nmButtonOutput($this->arr_buttons, "bpesquisa", "document.F1.bprocessa.value='pesq'; setTimeout(function() {nm_submit_form()}, 200);", "document.F1.bprocessa.value='pesq'; setTimeout(function() {nm_submit_form()}, 200);", "sc_b_pesq_bot", "", "" . $this->Ini->Nm_lang['lang_btns_srch_lone'] . "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_srch_lone_hint'] . "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   if ($this->nmgp_botoes['clear'] == "on")
   {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "blimpar", "limpa_form();", "limpa_form();", "limpa_frm_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
<?php
   if (!isset($this->nmgp_botoes['save']) || $this->nmgp_botoes['save'] == "on")
   {
       $this->NM_fil_ant = $this->gera_array_filtros();
?>
     <span id="idAjaxSelect_NM_filters_bot">
       <SELECT class="scFilterToolbar_obj" id="sel_recup_filters_bot" name="NM_filters_bot" onChange="nm_submit_filter(this, 'bot');" size="1">
           <option value=""></option>
<?php
          $Nome_filter = "";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              $Select      = "";
              $Cada_filter = $Tipo_filter[2];
              if ($Cada_filter == $this->NM_curr_fil)
              {
                  $Select = "selected";
              }
              if (NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, $_SESSION['scriptcase']['charset'], "UTF-8");
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], $_SESSION['scriptcase']['charset'], "UTF-8");
              }
              elseif (!NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] == "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, "UTF-8", $_SESSION['scriptcase']['charset']);
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter = $Tipo_filter[1];
                  echo "           <option value=\"\">" . NM_encode_input($Nome_filter) . "</option>\r\n";
              }
?>
           <option value="<?php echo NM_encode_input($Tipo_filter[0]) . "\" " . $Select . ">.." . htmlspecialchars($Cada_filter) ?></option>
<?php
          }
?>
       </SELECT>
     </span>
<?php
   }
?>
<?php
   if ($this->nmgp_botoes['save'] == "on")
   {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "bedit_filter", "document.getElementById('Salvar_filters_bot').style.display = ''; document.F1.nmgp_save_name_bot.focus();", "document.getElementById('Salvar_filters_bot').style.display = ''; document.F1.nmgp_save_name_bot.focus();", "Ativa_save_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
<?php
   if (is_file("grid_aereopar_rsvp_r_help.txt"))
   {
      $Arq_WebHelp = file("grid_aereopar_rsvp_r_help.txt"); 
      if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
      {
          $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
          $Tmp = explode(";", $Arq_WebHelp[0]); 
          foreach ($Tmp as $Cada_help)
          {
              $Tmp1 = explode(":", $Cada_help); 
              if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "fil" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
              {
?>
          <?php echo nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "sc_b_help_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
              }
          }
      }
   }
?>
<?php
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_aereopar_rsvp_r']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_aereopar_rsvp_r']['start'] == 'filter' && $nm_apl_dependente != 1)
   {
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bsair", "document.form_cancel.submit();", "document.form_cancel.submit();", "sc_b_cancel_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
   else
   {
?>
       <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.form_cancel.submit();", "document.form_cancel.submit();", "sc_b_cancel_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<?php
   }
?>
    </td>
    <td class="scFilterToolbarPadding" align="right" width="33%" nowrap>
    </td>
   </tr></table>
<?php
   if ($this->nmgp_botoes['save'] == "on")
   {
?>
    </TD></TR><TR><TD>
    <DIV id="Salvar_filters_bot" style="display:none;z-index:9999;">
     <TABLE align="center" class="scFilterTable">
      <TR>
       <TD class="scFilterBlock">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top" class="scFilterBlockFont"><?php echo $this->Ini->Nm_lang['lang_othr_srch_head'] ?></td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bcancelar_appdiv", "document.getElementById('Salvar_filters_bot').style.display = 'none';", "document.getElementById('Salvar_filters_bot').style.display = 'none';", "Cancel_frm_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </TD>
      </TR>
      <TR>
       <TD class="scFilterFieldOdd">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top">
           <input class="scFilterObjectOdd" type="text" id="SC_nmgp_save_name_bot" name="nmgp_save_name_bot" value="">
          </td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bsalvar_appdiv", "nm_save_form('bot');", "nm_save_form('bot');", "Save_frm_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </TD>
      </TR>
      <TR>
       <TD class="scFilterFieldEven">
       <DIV id="Apaga_filters_bot" style="display:''">
        <table style="border-width: 0px; border-collapse: collapse" width="100%">
         <tr>
          <td style="padding: 0px" valign="top">
          <div id="idAjaxSelect_NM_filters_del_bot">
           <SELECT class="scFilterObjectOdd" id="sel_filters_del_bot" name="NM_filters_del_bot" size="1">
            <option value=""></option>
<?php
          $Nome_filter = "";
          foreach ($this->NM_fil_ant as $Cada_filter => $Tipo_filter)
          {
              $Select = "";
              $Cada_filter = $Tipo_filter[2];
              if ($Cada_filter == $this->NM_curr_fil)
              {
                  $Select = "selected";
              }
              if (NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] != "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, $_SESSION['scriptcase']['charset'], "UTF-8");
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], $_SESSION['scriptcase']['charset'], "UTF-8");
              }
              elseif (!NM_is_utf8($Cada_filter) && $_SESSION['scriptcase']['charset'] == "UTF-8")
              {
                  $Cada_filter    = sc_convert_encoding($Cada_filter, "UTF-8", $_SESSION['scriptcase']['charset']);
                  $Tipo_filter[0] = sc_convert_encoding($Tipo_filter[0], "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              if ($Tipo_filter[1] != $Nome_filter)
              {
                  $Nome_filter = $Tipo_filter[1];
                  echo "            <option value=\"\">" . NM_encode_input($Nome_filter) . "</option>\r\n";
              }
?>
            <option value="<?php echo NM_encode_input($Tipo_filter[0]) . "\" " . $Select . ">.." . htmlspecialchars($Cada_filter) ?></option>
<?php
          }
?>
           </SELECT>
          </div>
          </td>
          <td style="padding: 0px" align="right" valign="top">
           <?php echo nmButtonOutput($this->arr_buttons, "bexcluir_appdiv", "nm_submit_filter_del('bot');", "nm_submit_filter_del('bot');", "Exc_filtro_bot", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
          </td>
         </tr>
        </table>
       </DIV>
       </TD>
      </TR>
     </TABLE>
    </DIV> 
<?php
   }
?>
  </TD>
 </TR>
     <?php
     }
 ?>
<?php
   }

   function monta_html_fim()
   {
       global $bprocessa, $nm_url_saida, $Script_BI;
?>

</TABLE>
   <INPUT type="hidden" name="form_condicao" value="3">
</FORM> 
<?php
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_aereopar_rsvp_r']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_aereopar_rsvp_r']['start'] == 'filter')
   {
?>
   <FORM style="display:none;" name="form_cancel"  method="POST" action="<?php echo $nm_url_saida; ?>" target="_self"> 
<?php
   }
   else
   {
?>
   <FORM style="display:none;" name="form_cancel"  method="POST" action="./" target="_self"> 
<?php
   }
?>
   <INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<?php
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['orig_pesq']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['orig_pesq'] == "grid")
   {
       $Ret_cancel_pesq = "volta_grid";
   }
   else
   {
       $Ret_cancel_pesq = "resumo";
   }
?>
   <INPUT type="hidden" name="nmgp_opcao" value="<?php echo $Ret_cancel_pesq; ?>"> 
   </FORM> 
<SCRIPT type="text/javascript">
<?php
   if (empty($this->NM_fil_ant))
   {
       if ($_SESSION['scriptcase']['proc_mobile'])
       {
?>
      document.getElementById('Apaga_filters_top').style.display = 'none';
      document.getElementById('sel_recup_filters_top').style.display = 'none';
<?php
       }
       else
       {
?>
      document.getElementById('Apaga_filters_bot').style.display = 'none';
      document.getElementById('sel_recup_filters_bot').style.display = 'none';
<?php
       }
   }
?>
 function nm_move()
 {
     document.form_cancel.target = "_self"; 
     document.form_cancel.action = "./"; 
     document.form_cancel.submit(); 
 }
 function nm_submit_form()
 {
    document.F1.submit();
 }
 function limpa_form(opc_clear)
 {
   document.F1.reset();
   if (document.F1.NM_filters)
   {
       document.F1.NM_filters.selectedIndex = -1;
   }
   document.getElementById('Salvar_filters_bot').style.display = 'none';
   document.F1.participante_cpf_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_participante_cpf'), document.F1.participante_cpf_cond, 'participante_cpf', opc_clear);
   document.F1.participante_cpf.value = "";
   document.F1.participante_cpf_autocomp.value = "";
   document.F1.participante_nome_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_participante_nome'), document.F1.participante_nome_cond, 'participante_nome', opc_clear);
   document.F1.participante_nome.value = "";
   document.F1.participante_nome_autocomp.value = "";
   document.F1.tipo_pessoa_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_tipo_pessoa'), document.F1.tipo_pessoa_cond, 'tipo_pessoa', opc_clear);
   document.F1.tipo_pessoa.value = "";
   document.F1.tipo_pessoa_autocomp.value = "";
   document.F1.cod_cia_aerea_cond.value = 'gt';
   nm_campos_between(document.getElementById('id_vis_cod_cia_aerea'), document.F1.cod_cia_aerea_cond, 'cod_cia_aerea', opc_clear);
   document.F1.cod_cia_aerea.value = "";
   document.F1.cia_aerea_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_cia_aerea'), document.F1.cia_aerea_cond, 'cia_aerea', opc_clear);
   document.F1.cia_aerea.value = "";
   document.F1.cia_aerea_autocomp.value = "";
   document.F1.voo_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_voo'), document.F1.voo_cond, 'voo', opc_clear);
   document.F1.voo.value = "";
   document.F1.voo_autocomp.value = "";
   document.F1.direcao_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_direcao'), document.F1.direcao_cond, 'direcao', opc_clear);
   document.F1.direcao.value = "";
   document.F1.direcao_autocomp.value = "";
   document.F1.origem_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_origem'), document.F1.origem_cond, 'origem', opc_clear);
   document.F1.origem.value = "";
   document.F1.origem_autocomp.value = "";
   document.F1.destino_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_destino'), document.F1.destino_cond, 'destino', opc_clear);
   document.F1.destino.value = "";
   document.F1.destino_autocomp.value = "";
   document.F1.localizador_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_localizador'), document.F1.localizador_cond, 'localizador', opc_clear);
   document.F1.localizador.value = "";
   document.F1.localizador_autocomp.value = "";
   document.F1.etkt_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_etkt'), document.F1.etkt_cond, 'etkt', opc_clear);
   document.F1.etkt.value = "";
   document.F1.etkt_autocomp.value = "";
   document.F1.emitida_bvt_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_emitida_bvt'), document.F1.emitida_bvt_cond, 'emitida_bvt', opc_clear);
   document.F1.emitida_bvt.value = "";
   document.F1.emitida_bvt_autocomp.value = "";
   document.F1.bloqueio_dsc_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_bloqueio_dsc'), document.F1.bloqueio_dsc_cond, 'bloqueio_dsc', opc_clear);
   document.F1.bloqueio_dsc.value = "";
   document.F1.bloqueio_dsc_autocomp.value = "";
   document.F1.data_saida_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_data_saida'), document.F1.data_saida_cond, 'data_saida', opc_clear);
   document.F1.data_saida_dia.value = "";
   document.F1.data_saida_mes.value = "";
   document.F1.data_saida_ano.value = "";
   document.F1.data_saida_input_2_dia.value = "";
   document.F1.data_saida_input_2_mes.value = "";
   document.F1.data_saida_input_2_ano.value = "";
   document.F1.hora_saida_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_hora_saida'), document.F1.hora_saida_cond, 'hora_saida', opc_clear);
   document.F1.hora_saida_hor.value = "";
   document.F1.hora_saida_min.value = "";
   document.F1.hora_saida_seg.value = "";
   document.F1.data_chegada_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_data_chegada'), document.F1.data_chegada_cond, 'data_chegada', opc_clear);
   document.F1.data_chegada_dia.value = "";
   document.F1.data_chegada_mes.value = "";
   document.F1.data_chegada_ano.value = "";
   document.F1.data_chegada_input_2_dia.value = "";
   document.F1.data_chegada_input_2_mes.value = "";
   document.F1.data_chegada_input_2_ano.value = "";
   document.F1.hora_chegada_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_hora_chegada'), document.F1.hora_chegada_cond, 'hora_chegada', opc_clear);
   document.F1.hora_chegada_hor.value = "";
   document.F1.hora_chegada_min.value = "";
   document.F1.hora_chegada_seg.value = "";
   document.F1.data_nota_gate_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_data_nota_gate'), document.F1.data_nota_gate_cond, 'data_nota_gate', opc_clear);
   document.F1.data_nota_gate_dia.value = "";
   document.F1.data_nota_gate_mes.value = "";
   document.F1.data_nota_gate_ano.value = "";
   document.F1.data_nota_gate_input_2_dia.value = "";
   document.F1.data_nota_gate_input_2_mes.value = "";
   document.F1.data_nota_gate_input_2_ano.value = "";
   document.F1.nota_gate_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_nota_gate'), document.F1.nota_gate_cond, 'nota_gate', opc_clear);
   document.F1.nota_gate.value = "";
   document.F1.nota_gate_autocomp.value = "";
 }
 function SC_carga_evt_jquery()
 {
    $('#SC_data_chegada_dia').bind('change', function() {sc_grid_aereopar_rsvp_r_valida_dia(this)});
    $('#SC_data_chegada_input_2_dia').bind('change', function() {sc_grid_aereopar_rsvp_r_valida_dia(this)});
    $('#SC_data_chegada_input_2_mes').bind('change', function() {sc_grid_aereopar_rsvp_r_valida_mes(this)});
    $('#SC_data_chegada_mes').bind('change', function() {sc_grid_aereopar_rsvp_r_valida_mes(this)});
    $('#SC_data_nota_gate_dia').bind('change', function() {sc_grid_aereopar_rsvp_r_valida_dia(this)});
    $('#SC_data_nota_gate_input_2_dia').bind('change', function() {sc_grid_aereopar_rsvp_r_valida_dia(this)});
    $('#SC_data_nota_gate_input_2_mes').bind('change', function() {sc_grid_aereopar_rsvp_r_valida_mes(this)});
    $('#SC_data_nota_gate_mes').bind('change', function() {sc_grid_aereopar_rsvp_r_valida_mes(this)});
    $('#SC_data_saida_dia').bind('change', function() {sc_grid_aereopar_rsvp_r_valida_dia(this)});
    $('#SC_data_saida_input_2_dia').bind('change', function() {sc_grid_aereopar_rsvp_r_valida_dia(this)});
    $('#SC_data_saida_input_2_mes').bind('change', function() {sc_grid_aereopar_rsvp_r_valida_mes(this)});
    $('#SC_data_saida_mes').bind('change', function() {sc_grid_aereopar_rsvp_r_valida_mes(this)});
    $('#SC_hora_chegada_hor').bind('change', function() {sc_grid_aereopar_rsvp_r_valida_hora(this)});
    $('#SC_hora_chegada_min').bind('change', function() {sc_grid_aereopar_rsvp_r_valida_min(this)});
    $('#SC_hora_chegada_seg').bind('change', function() {sc_grid_aereopar_rsvp_r_valida_seg(this)});
    $('#SC_hora_saida_hor').bind('change', function() {sc_grid_aereopar_rsvp_r_valida_hora(this)});
    $('#SC_hora_saida_min').bind('change', function() {sc_grid_aereopar_rsvp_r_valida_min(this)});
    $('#SC_hora_saida_seg').bind('change', function() {sc_grid_aereopar_rsvp_r_valida_seg(this)});
 }
 function sc_grid_aereopar_rsvp_r_valida_dia(obj)
 {
     if (obj.value != "" && (obj.value < 1 || obj.value > 31))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_iday'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { $(document.activeElement).focus(); obj.focus(); }, 10);
         }
     }
 }
 function sc_grid_aereopar_rsvp_r_valida_mes(obj)
 {
     if (obj.value != "" && (obj.value < 1 || obj.value > 12))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_mnth'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { $(document.activeElement).focus(); obj.focus(); }, 10);
         }
     }
 }
 function sc_grid_aereopar_rsvp_r_valida_hora(obj)
 {
     if (obj.value != "" && (obj.value < 0 || obj.value > 23))
     {
         if (confirm (Nm_erro['lang_jscr_ivtm'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { $(document.activeElement).focus(); obj.focus(); }, 10);
         }
     }
 }
 function sc_grid_aereopar_rsvp_r_valida_min(obj)
 {
     if (obj.value != "" && (obj.value < 0 || obj.value > 59))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_mint'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { $(document.activeElement).focus(); obj.focus(); }, 10);
         }
     }
 }
 function sc_grid_aereopar_rsvp_r_valida_seg(obj)
 {
     if (obj.value != "" && (obj.value < 0 || obj.value > 59))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_secd'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { $(document.activeElement).focus(); obj.focus(); }, 10);
         }
     }
 }
   function process_hotkeys(hotkey)
   {
      if (hotkey == 'sys_format_fi2') { 
         var output =  $('#sc_b_pesq_bot').click();
         return (0 < output.length);
      }
      if (hotkey == 'sys_format_lim') { 
         var output =  $('#limpa_frm_bot').click();
         return (0 < output.length);
      }
      if (hotkey == 'sys_format_edi') { 
         var output =  $('#Ativa_save_bot').click();
         return (0 < output.length);
      }
      if (hotkey == 'sys_format_webh') { 
         var output =  $('#sc_b_help_bot').click();
         return (0 < output.length);
      }
      if (hotkey == 'sys_format_sai') { 
         var output =  $('#sc_b_cancel_bot').click();
         return (0 < output.length);
      }
   return false;
   }
</SCRIPT>
</BODY>
</HTML>
<?php
   }

   function gera_array_filtros()
   {
       $this->NM_fil_ant = array();
       $NM_patch   = "NRSVP115_10_AWS_APP/grid_aereopar_rsvp_r";
       if (is_dir($this->NM_path_filter . $NM_patch))
       {
           $NM_dir = @opendir($this->NM_path_filter . $NM_patch);
           while (FALSE !== ($NM_arq = @readdir($NM_dir)))
           {
             if (@is_file($this->NM_path_filter . $NM_patch . "/" . $NM_arq))
             {
                 $Sc_v6 = false;
                 $NMcmp_filter = file($this->NM_path_filter . $NM_patch . "/" . $NM_arq);
                 $NMcmp_filter = explode("@NMF@", $NMcmp_filter[0]);
                 if (substr($NMcmp_filter[0], 0, 6) == "SC_V6_" || substr($NMcmp_filter[0], 0, 6) == "SC_V8_")
                 {
                     $Name_filter = substr($NMcmp_filter[0], 6);
                     if (!empty($Name_filter))
                     {
                         $this->NM_fil_ant[$NM_arq][0] = $NM_patch . "/" . $NM_arq;
                         $this->NM_fil_ant[$NM_arq][1] = "" . $this->Ini->Nm_lang['lang_srch_public'] . "";
                         $Sc_v6 = true;
                     }
                 }
                 if (!$Sc_v6)
                 {
                     $this->NM_fil_ant[$NM_arq][0] = $NM_arq;
                     $this->NM_fil_ant[$NM_arq][1] = "" . $this->Ini->Nm_lang['lang_srch_public'] . "";
                 }
                 $this->NM_fil_ant[$NM_arq][2] = $Name_filter;
             }
           }
       }
       return $this->NM_fil_ant;
   }
   /**
    * @access  public
    * @param  string  $NM_operador  $this->Ini->Nm_lang['pesq_global_NM_operador']
    * @param  array  $nmgp_tab_label  
    */
   function inicializa_vars()
   {
      global $NM_operador, $nmgp_tab_label;

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/");  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1);  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz;
      $this->Campos_Mens_erro = ""; 
      $this->nm_data = new nm_data("pt_br");
      if ($this->NM_ajax_flag && ($this->NM_ajax_opcao == "ajax_grid_search" || $this->NM_ajax_opcao == "ajax_grid_search_change_fil"))
      {
          $nmgp_tab_label = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['pesq_tab_label'];
      }
      if (!empty($nmgp_tab_label))
      {
         $nm_tab_campos = explode("?@?", $nmgp_tab_label);
         $nmgp_tab_label = array();
         foreach ($nm_tab_campos as $cada_campo)
         {
             $parte_campo = explode("?#?", $cada_campo);
             $nmgp_tab_label[$parte_campo[0]] = $parte_campo[1];
         }
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_orig']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_orig'] = "";
      }
      $this->init_comando();
      $this->NM_operador     = (isset($NM_operador) && ("and" == strtolower($NM_operador) || "or" == strtolower($NM_operador))) ? $NM_operador : "and";
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq'] = array();
   }

   function init_comando()
   {
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['cond_pesq'] = "";
      if ($this->NM_ajax_flag && ($this->NM_ajax_opcao == "ajax_grid_search" || $this->NM_ajax_opcao == "ajax_grid_search_change_fil"))
      {
          $this->comando = "";
      }
      else
      {
          $this->comando = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_orig'];
      }
      $this->comando_sum     = "";
      $this->comando_filtro  = "";
      $this->comando_ini     = "ini";
      $this->comando_fim     = "";
   }
   function salva_filtro($nmgp_save_origem)
   {
      global $NM_filters_save, $nmgp_save_name, $nmgp_save_option, $script_case_init;
          $NM_filters_save = str_replace("__NM_PLUS__", "+", $NM_filters_save);
          $nmgp_save_name = trim($nmgp_save_name);
          $NM_str_filter  = "SC_V8_" . $nmgp_save_name . "@NMF@";
          if (!NM_is_utf8($nmgp_save_name))
          {
              $nmgp_save_name = sc_convert_encoding($nmgp_save_name, "UTF-8", $_SESSION['scriptcase']['charset']);
          }
          $NM_str_filter  .= $NM_filters_save;
          $NM_patch = $this->NM_path_filter;
          if (!is_dir($NM_patch))
          {
              $NMdir = mkdir($NM_patch, 0755);
          }
          $NM_patch .= "NRSVP115_10_AWS_APP/";
          if (!is_dir($NM_patch))
          {
              $NMdir = mkdir($NM_patch, 0755);
          }
          $NM_patch .= "grid_aereopar_rsvp_r/";
          if (!is_dir($NM_patch))
          {
              $NMdir = mkdir($NM_patch, 0755);
          }
          $Parms_usr  = "";
          $NM_filter = fopen ($NM_patch . md5($nmgp_save_name), 'w');
          if (!NM_is_utf8($NM_str_filter))
          {
              $NM_str_filter = sc_convert_encoding($NM_str_filter, "UTF-8", $_SESSION['scriptcase']['charset']);
          }
          fwrite($NM_filter, $NM_str_filter);
          fclose($NM_filter);
   }
   function recupera_filtro($NM_filters, $Orig_Fil)
   {
      global $NM_operador, $script_case_init;
      $NM_patch = $this->NM_path_filter . "/" . $NM_filters;
      if (!is_file($NM_patch))
      {
          $NM_filters = sc_convert_encoding($NM_filters, "UTF-8", $_SESSION['scriptcase']['charset']);
          $NM_patch = $this->NM_path_filter . "/" . $NM_filters;
      }
      $return_fields = array();
      $tp_fields     = array();
      $tb_fields_esp = array();
      $old_bi_opcs   = array("TP","HJ","OT","U7","SP","US","MM","UM","AM","PS","SS","P3","PM","P7","CY","LY","YY","M6","M3","M18","M24");
      $tp_fields['SC_participante_cpf_cond'] = 'cond';
      $tp_fields['SC_participante_cpf'] = 'text_aut';
      $tp_fields['id_ac_participante_cpf'] = 'text_aut';
      $tp_fields['SC_participante_nome_cond'] = 'cond';
      $tp_fields['SC_participante_nome'] = 'text_aut';
      $tp_fields['id_ac_participante_nome'] = 'text_aut';
      $tp_fields['SC_tipo_pessoa_cond'] = 'cond';
      $tp_fields['SC_tipo_pessoa'] = 'text_aut';
      $tp_fields['id_ac_tipo_pessoa'] = 'text_aut';
      $tp_fields['SC_cod_cia_aerea_cond'] = 'cond';
      $tp_fields['SC_cod_cia_aerea'] = 'text';
      $tp_fields['SC_cia_aerea_cond'] = 'cond';
      $tp_fields['SC_cia_aerea'] = 'text_aut';
      $tp_fields['id_ac_cia_aerea'] = 'text_aut';
      $tp_fields['SC_voo_cond'] = 'cond';
      $tp_fields['SC_voo'] = 'text_aut';
      $tp_fields['id_ac_voo'] = 'text_aut';
      $tp_fields['SC_direcao_cond'] = 'cond';
      $tp_fields['SC_direcao'] = 'text_aut';
      $tp_fields['id_ac_direcao'] = 'text_aut';
      $tp_fields['SC_origem_cond'] = 'cond';
      $tp_fields['SC_origem'] = 'text_aut';
      $tp_fields['id_ac_origem'] = 'text_aut';
      $tp_fields['SC_destino_cond'] = 'cond';
      $tp_fields['SC_destino'] = 'text_aut';
      $tp_fields['id_ac_destino'] = 'text_aut';
      $tp_fields['SC_localizador_cond'] = 'cond';
      $tp_fields['SC_localizador'] = 'text_aut';
      $tp_fields['id_ac_localizador'] = 'text_aut';
      $tp_fields['SC_etkt_cond'] = 'cond';
      $tp_fields['SC_etkt'] = 'text_aut';
      $tp_fields['id_ac_etkt'] = 'text_aut';
      $tp_fields['SC_emitida_bvt_cond'] = 'cond';
      $tp_fields['SC_emitida_bvt'] = 'text_aut';
      $tp_fields['id_ac_emitida_bvt'] = 'text_aut';
      $tp_fields['SC_bloqueio_dsc_cond'] = 'cond';
      $tp_fields['SC_bloqueio_dsc'] = 'text_aut';
      $tp_fields['id_ac_bloqueio_dsc'] = 'text_aut';
      $tp_fields['SC_data_saida_cond'] = 'cond';
      $tp_fields['SC_data_saida_dia'] = 'text';
      $tp_fields['SC_data_saida_mes'] = 'text';
      $tp_fields['SC_data_saida_ano'] = 'text';
      $tp_fields['SC_data_saida_input_2_dia'] = 'text';
      $tp_fields['SC_data_saida_input_2_mes'] = 'text';
      $tp_fields['SC_data_saida_input_2_ano'] = 'text';
      $tp_fields['SC_hora_saida_cond'] = 'cond';
      $tp_fields['SC_hora_saida_hor'] = 'text';
      $tp_fields['SC_hora_saida_min'] = 'text';
      $tp_fields['SC_hora_saida_seg'] = 'text';
      $tp_fields['SC_hora_saida_input_2_hor'] = 'text';
      $tp_fields['SC_hora_saida_input_2_min'] = 'text';
      $tp_fields['SC_hora_saida_input_2_seg'] = 'text';
      $tp_fields['SC_data_chegada_cond'] = 'cond';
      $tp_fields['SC_data_chegada_dia'] = 'text';
      $tp_fields['SC_data_chegada_mes'] = 'text';
      $tp_fields['SC_data_chegada_ano'] = 'text';
      $tp_fields['SC_data_chegada_input_2_dia'] = 'text';
      $tp_fields['SC_data_chegada_input_2_mes'] = 'text';
      $tp_fields['SC_data_chegada_input_2_ano'] = 'text';
      $tp_fields['SC_hora_chegada_cond'] = 'cond';
      $tp_fields['SC_hora_chegada_hor'] = 'text';
      $tp_fields['SC_hora_chegada_min'] = 'text';
      $tp_fields['SC_hora_chegada_seg'] = 'text';
      $tp_fields['SC_hora_chegada_input_2_hor'] = 'text';
      $tp_fields['SC_hora_chegada_input_2_min'] = 'text';
      $tp_fields['SC_hora_chegada_input_2_seg'] = 'text';
      $tp_fields['SC_data_nota_gate_cond'] = 'cond';
      $tp_fields['SC_data_nota_gate_dia'] = 'text';
      $tp_fields['SC_data_nota_gate_mes'] = 'text';
      $tp_fields['SC_data_nota_gate_ano'] = 'text';
      $tp_fields['SC_data_nota_gate_input_2_dia'] = 'text';
      $tp_fields['SC_data_nota_gate_input_2_mes'] = 'text';
      $tp_fields['SC_data_nota_gate_input_2_ano'] = 'text';
      $tp_fields['SC_nota_gate_cond'] = 'cond';
      $tp_fields['SC_nota_gate'] = 'text_aut';
      $tp_fields['id_ac_nota_gate'] = 'text_aut';
      $tp_fields['SC_NM_operador'] = 'text';
      if (is_file($NM_patch))
      {
          $SC_V8    = false;
          $NMfilter = file($NM_patch);
          $NMcmp_filter = explode("@NMF@", $NMfilter[0]);
          if (substr($NMcmp_filter[0], 0, 5) == "SC_V8")
          {
              $SC_V8 = true;
          }
          if (substr($NMcmp_filter[0], 0, 5) == "SC_V6" || substr($NMcmp_filter[0], 0, 5) == "SC_V8")
          {
              unset($NMcmp_filter[0]);
          }
          foreach ($NMcmp_filter as $Cada_cmp)
          {
              $Cada_cmp = explode("#NMF#", $Cada_cmp);
              if (isset($tb_fields_esp[$Cada_cmp[0]]))
              {
                  $Cada_cmp[0] = $tb_fields_esp[$Cada_cmp[0]];
              }
              if (!$SC_V8 && substr($Cada_cmp[0], 0, 11) != "div_ac_lab_" && substr($Cada_cmp[0], 0, 6) != "id_ac_")
              {
                  $Cada_cmp[0] = "SC_" . $Cada_cmp[0];
              }
              if (!isset($tp_fields[$Cada_cmp[0]]))
              {
                  continue;
              }
              $list   = array();
              $list_a = array();
              if (substr($Cada_cmp[1], 0, 10) == "_NM_array_")
              {
                  if (substr($Cada_cmp[1], 0, 17) == "_NM_array_#NMARR#")
                  {
                      $Sc_temp = explode("#NMARR#", substr($Cada_cmp[1], 17));
                      foreach ($Sc_temp as $Cada_val)
                      {
                          $list[]   = $Cada_val;
                          $tmp_pos  = (is_string($Cada_val)) ? strpos($Cada_val, "##@@") : false;
                          $val_a    = ($tmp_pos !== false) ?  substr($Cada_val, $tmp_pos + 4) : $Cada_val;
                          $list_a[] = array('opt' => $Cada_val, 'value' => $val_a);
                      }
                  }
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'dselect')
              {
                  $list[]   = $Cada_cmp[1];
                  $tmp_pos  = (is_string($Cada_cmp[1])) ? strpos($Cada_cmp[1], "##@@") : false;
                  $val_a    = ($tmp_pos !== false) ?  substr($Cada_cmp[1], $tmp_pos + 4) : $Cada_cmp[1];
                  $list_a[] = array('opt' => $Cada_cmp[1], 'value' => $val_a);
              }
              else
              {
                  $list[0] = $Cada_cmp[1];
              }
              if ($tp_fields[$Cada_cmp[0]] == 'select2_aut')
              {
                  if (!isset($list[0]))
                  {
                      $list[0] = "";
                  }
                  $return_fields['set_select2_aut'][] = array('field' => $Cada_cmp[0], 'value' => $list[0]);
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'dselect')
              {
                  $return_fields['set_dselect'][] = array('field' => $Cada_cmp[0], 'value' => $list_a);
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'fil_order')
              {
                  $return_fields['set_fil_order'][] = array('field' => $Cada_cmp[0], 'value' => $list);
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'selmult')
              {
                  if (count($list) == 1 && $list[0] == "")
                  {
                      continue;
                  }
                  $return_fields['set_selmult'][] = array('field' => $Cada_cmp[0], 'value' => $list);
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'ddcheckbox')
              {
                  $return_fields['set_ddcheckbox'][] = array('field' => $Cada_cmp[0], 'value' => $list);
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'checkbox_single')
              {
                  $return_fields['set_checkbox_single'][] = array('field' => $Cada_cmp[0], 'value' => $list);
              }
              elseif ($tp_fields[$Cada_cmp[0]] == 'checkbox')
              {
                  $return_fields['set_checkbox'][] = array('field' => $Cada_cmp[0], 'value' => $list);
              }
              else
              {
                  if (!isset($list[0]))
                  {
                      $list[0] = "";
                  }
                  if ($tp_fields[$Cada_cmp[0]] == 'html')
                  {
                      $return_fields['set_html'][] = array('field' => $Cada_cmp[0], 'value' => $list[0]);
                  }
                  elseif ($tp_fields[$Cada_cmp[0]] == 'radio')
                  {
                      $return_fields['set_radio'][] = array('field' => $Cada_cmp[0], 'value' => $list[0]);
                  }
                  elseif ($tp_fields[$Cada_cmp[0]] == 'cond' && in_array($list[0], $old_bi_opcs))
                  {
                      $Cada_cmp[1] = "bi_" . $list[0];
                      $return_fields['set_val'][] = array('field' => $Cada_cmp[0], 'value' => $Cada_cmp[1]);
                  }
                  else
                  {
                      $return_fields['set_val'][] = array('field' => $Cada_cmp[0], 'value' => $list[0]);
                  }
              }
          }
          $this->NM_curr_fil = $NM_filters;
      }
      return $return_fields;
   }
   function apaga_filtro()
   {
      global $NM_filters_del;
      if (isset($NM_filters_del) && !empty($NM_filters_del))
      { 
          $NM_patch = $this->NM_path_filter . "/" . $NM_filters_del;
          if (!is_file($NM_patch))
          {
              $NM_filters_del = sc_convert_encoding($NM_filters_del, "UTF-8", $_SESSION['scriptcase']['charset']);
              $NM_patch = $this->NM_path_filter . "/" . $NM_filters_del;
          }
          if (is_file($NM_patch))
          {
              @unlink($NM_patch);
          }
          if ($NM_filters_del == $this->NM_curr_fil)
          {
              $this->NM_curr_fil = "";
          }
      }
   }
   /**
    * @access  public
    */
   function trata_campos()
   {
      global $participante_cpf_cond, $participante_cpf, $participante_cpf_autocomp,
             $participante_nome_cond, $participante_nome, $participante_nome_autocomp,
             $tipo_pessoa_cond, $tipo_pessoa, $tipo_pessoa_autocomp,
             $cod_cia_aerea_cond, $cod_cia_aerea,
             $cia_aerea_cond, $cia_aerea, $cia_aerea_autocomp,
             $voo_cond, $voo, $voo_autocomp,
             $direcao_cond, $direcao, $direcao_autocomp,
             $origem_cond, $origem, $origem_autocomp,
             $destino_cond, $destino, $destino_autocomp,
             $localizador_cond, $localizador, $localizador_autocomp,
             $etkt_cond, $etkt, $etkt_autocomp,
             $emitida_bvt_cond, $emitida_bvt, $emitida_bvt_autocomp,
             $bloqueio_dsc_cond, $bloqueio_dsc, $bloqueio_dsc_autocomp,
             $data_saida_cond, $data_saida, $data_saida_dia, $data_saida_mes, $data_saida_ano, $data_saida_input_2_dia, $data_saida_input_2_mes, $data_saida_input_2_ano,
             $hora_saida_cond, $hora_saida, $hora_saida_hor, $hora_saida_min, $hora_saida_seg,
             $data_chegada_cond, $data_chegada, $data_chegada_dia, $data_chegada_mes, $data_chegada_ano, $data_chegada_input_2_dia, $data_chegada_input_2_mes, $data_chegada_input_2_ano,
             $hora_chegada_cond, $hora_chegada, $hora_chegada_hor, $hora_chegada_min, $hora_chegada_seg,
             $data_nota_gate_cond, $data_nota_gate, $data_nota_gate_dia, $data_nota_gate_mes, $data_nota_gate_ano, $data_nota_gate_input_2_dia, $data_nota_gate_input_2_mes, $data_nota_gate_input_2_ano,
             $nota_gate_cond, $nota_gate, $nota_gate_autocomp, $nmgp_tab_label;

      $C_formatado = true;
      if ($this->NM_ajax_flag && ($this->NM_ajax_opcao == "ajax_grid_search" || $this->NM_ajax_opcao == "ajax_grid_search_change_fil"))
      {
          if ($this->NM_ajax_opcao == "ajax_grid_search")
          {
              $C_formatado = false;
          }
          $Temp_Busca  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && $this->NM_ajax_opcao != "ajax_grid_search_change_fil")
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca'], $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca'] as $Cmps => $Vals)
          {
              $$Cmps = $Vals;
          }
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_limpa.php", "F", "nm_limpa_valor") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_conv_dados.php", "F", "nm_conv_limpa_dado") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_edit.php", "F", "nmgp_Form_Num_Val") ; 
      if (!empty($participante_cpf_autocomp) && empty($participante_cpf))
      {
          $participante_cpf = $participante_cpf_autocomp;
      }
      if (!empty($participante_nome_autocomp) && empty($participante_nome))
      {
          $participante_nome = $participante_nome_autocomp;
      }
      if (!empty($tipo_pessoa_autocomp) && empty($tipo_pessoa))
      {
          $tipo_pessoa = $tipo_pessoa_autocomp;
      }
      if (!empty($cia_aerea_autocomp) && empty($cia_aerea))
      {
          $cia_aerea = $cia_aerea_autocomp;
      }
      if (!empty($voo_autocomp) && empty($voo))
      {
          $voo = $voo_autocomp;
      }
      if (!empty($direcao_autocomp) && empty($direcao))
      {
          $direcao = $direcao_autocomp;
      }
      if (!empty($origem_autocomp) && empty($origem))
      {
          $origem = $origem_autocomp;
      }
      if (!empty($destino_autocomp) && empty($destino))
      {
          $destino = $destino_autocomp;
      }
      if (!empty($localizador_autocomp) && empty($localizador))
      {
          $localizador = $localizador_autocomp;
      }
      if (!empty($etkt_autocomp) && empty($etkt))
      {
          $etkt = $etkt_autocomp;
      }
      if (!empty($emitida_bvt_autocomp) && empty($emitida_bvt))
      {
          $emitida_bvt = $emitida_bvt_autocomp;
      }
      if (!empty($bloqueio_dsc_autocomp) && empty($bloqueio_dsc))
      {
          $bloqueio_dsc = $bloqueio_dsc_autocomp;
      }
      if (!empty($nota_gate_autocomp) && empty($nota_gate))
      {
          $nota_gate = $nota_gate_autocomp;
      }
      $participante_cpf_cond_salva = $participante_cpf_cond; 
      if (!isset($participante_cpf_input_2) || $participante_cpf_input_2 == "")
      {
          $participante_cpf_input_2 = $participante_cpf;
      }
      $participante_nome_cond_salva = $participante_nome_cond; 
      if (!isset($participante_nome_input_2) || $participante_nome_input_2 == "")
      {
          $participante_nome_input_2 = $participante_nome;
      }
      $tipo_pessoa_cond_salva = $tipo_pessoa_cond; 
      if (!isset($tipo_pessoa_input_2) || $tipo_pessoa_input_2 == "")
      {
          $tipo_pessoa_input_2 = $tipo_pessoa;
      }
      $cod_cia_aerea_cond_salva = $cod_cia_aerea_cond; 
      if (!isset($cod_cia_aerea_input_2) || $cod_cia_aerea_input_2 == "")
      {
          $cod_cia_aerea_input_2 = $cod_cia_aerea;
      }
      $cia_aerea_cond_salva = $cia_aerea_cond; 
      if (!isset($cia_aerea_input_2) || $cia_aerea_input_2 == "")
      {
          $cia_aerea_input_2 = $cia_aerea;
      }
      $voo_cond_salva = $voo_cond; 
      if (!isset($voo_input_2) || $voo_input_2 == "")
      {
          $voo_input_2 = $voo;
      }
      $direcao_cond_salva = $direcao_cond; 
      if (!isset($direcao_input_2) || $direcao_input_2 == "")
      {
          $direcao_input_2 = $direcao;
      }
      $origem_cond_salva = $origem_cond; 
      if (!isset($origem_input_2) || $origem_input_2 == "")
      {
          $origem_input_2 = $origem;
      }
      $destino_cond_salva = $destino_cond; 
      if (!isset($destino_input_2) || $destino_input_2 == "")
      {
          $destino_input_2 = $destino;
      }
      $localizador_cond_salva = $localizador_cond; 
      if (!isset($localizador_input_2) || $localizador_input_2 == "")
      {
          $localizador_input_2 = $localizador;
      }
      $etkt_cond_salva = $etkt_cond; 
      if (!isset($etkt_input_2) || $etkt_input_2 == "")
      {
          $etkt_input_2 = $etkt;
      }
      $emitida_bvt_cond_salva = $emitida_bvt_cond; 
      if (!isset($emitida_bvt_input_2) || $emitida_bvt_input_2 == "")
      {
          $emitida_bvt_input_2 = $emitida_bvt;
      }
      $bloqueio_dsc_cond_salva = $bloqueio_dsc_cond; 
      if (!isset($bloqueio_dsc_input_2) || $bloqueio_dsc_input_2 == "")
      {
          $bloqueio_dsc_input_2 = $bloqueio_dsc;
      }
      $data_saida_cond_salva = $data_saida_cond; 
      if (!isset($data_saida_input_2_dia) || $data_saida_input_2_dia == "") {
          $data_saida_input_2_dia = $data_saida_dia;
      }
      if (!isset($data_saida_input_2_mes) || $data_saida_input_2_mes == "") {
          $data_saida_input_2_mes = $data_saida_mes;
      }
      if (!isset($data_saida_input_2_ano) || $data_saida_input_2_ano == "") {
          $data_saida_input_2_ano = $data_saida_ano;
      }
      $hora_saida_cond_salva = $hora_saida_cond; 
      $data_chegada_cond_salva = $data_chegada_cond; 
      if (!isset($data_chegada_input_2_dia) || $data_chegada_input_2_dia == "") {
          $data_chegada_input_2_dia = $data_chegada_dia;
      }
      if (!isset($data_chegada_input_2_mes) || $data_chegada_input_2_mes == "") {
          $data_chegada_input_2_mes = $data_chegada_mes;
      }
      if (!isset($data_chegada_input_2_ano) || $data_chegada_input_2_ano == "") {
          $data_chegada_input_2_ano = $data_chegada_ano;
      }
      $hora_chegada_cond_salva = $hora_chegada_cond; 
      $data_nota_gate_cond_salva = $data_nota_gate_cond; 
      if (!isset($data_nota_gate_input_2_dia) || $data_nota_gate_input_2_dia == "") {
          $data_nota_gate_input_2_dia = $data_nota_gate_dia;
      }
      if (!isset($data_nota_gate_input_2_mes) || $data_nota_gate_input_2_mes == "") {
          $data_nota_gate_input_2_mes = $data_nota_gate_mes;
      }
      if (!isset($data_nota_gate_input_2_ano) || $data_nota_gate_input_2_ano == "") {
          $data_nota_gate_input_2_ano = $data_nota_gate_ano;
      }
      $nota_gate_cond_salva = $nota_gate_cond; 
      if (!isset($nota_gate_input_2) || $nota_gate_input_2 == "")
      {
          $nota_gate_input_2 = $nota_gate;
      }
      if ($cod_cia_aerea_cond != "in")
      {
          nm_limpa_numero($cod_cia_aerea, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']  = array(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search']  = array(); 
      $I_Grid = 0;
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['participante_cpf'] = $participante_cpf; 
      if (is_array($participante_cpf) && !empty($participante_cpf))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $participante_cpf;
      }
      elseif ($participante_cpf_cond_salva == "nu" || $participante_cpf_cond_salva == "nn" || $participante_cpf_cond_salva == "ep" || $participante_cpf_cond_salva == "ne" || !empty($participante_cpf))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $participante_cpf;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['participante_cpf_cond'] = $participante_cpf_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "participante_cpf"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $participante_cpf_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['participante_cpf'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['participante_nome'] = $participante_nome; 
      if (is_array($participante_nome) && !empty($participante_nome))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $participante_nome;
      }
      elseif ($participante_nome_cond_salva == "nu" || $participante_nome_cond_salva == "nn" || $participante_nome_cond_salva == "ep" || $participante_nome_cond_salva == "ne" || !empty($participante_nome))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $participante_nome;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['participante_nome_cond'] = $participante_nome_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "participante_nome"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $participante_nome_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['participante_nome'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['tipo_pessoa'] = $tipo_pessoa; 
      if (is_array($tipo_pessoa) && !empty($tipo_pessoa))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $tipo_pessoa;
      }
      elseif ($tipo_pessoa_cond_salva == "nu" || $tipo_pessoa_cond_salva == "nn" || $tipo_pessoa_cond_salva == "ep" || $tipo_pessoa_cond_salva == "ne" || !empty($tipo_pessoa))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $tipo_pessoa;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['tipo_pessoa_cond'] = $tipo_pessoa_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "tipo_pessoa"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $tipo_pessoa_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['tipo_pessoa'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['cod_cia_aerea'] = $cod_cia_aerea; 
      if (is_array($cod_cia_aerea) && !empty($cod_cia_aerea))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $cod_cia_aerea;
      }
      elseif ($cod_cia_aerea_cond_salva == "nu" || $cod_cia_aerea_cond_salva == "nn" || $cod_cia_aerea_cond_salva == "ep" || $cod_cia_aerea_cond_salva == "ne" || !empty($cod_cia_aerea))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $cod_cia_aerea;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['cod_cia_aerea_cond'] = $cod_cia_aerea_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "cod_cia_aerea"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $cod_cia_aerea_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['cod_cia_aerea'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['cia_aerea'] = $cia_aerea; 
      if (is_array($cia_aerea) && !empty($cia_aerea))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $cia_aerea;
      }
      elseif ($cia_aerea_cond_salva == "nu" || $cia_aerea_cond_salva == "nn" || $cia_aerea_cond_salva == "ep" || $cia_aerea_cond_salva == "ne" || !empty($cia_aerea))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $cia_aerea;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['cia_aerea_cond'] = $cia_aerea_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "cia_aerea"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $cia_aerea_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['cia_aerea'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['voo'] = $voo; 
      if (is_array($voo) && !empty($voo))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $voo;
      }
      elseif ($voo_cond_salva == "nu" || $voo_cond_salva == "nn" || $voo_cond_salva == "ep" || $voo_cond_salva == "ne" || !empty($voo))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $voo;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['voo_cond'] = $voo_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "voo"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $voo_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['voo'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['direcao'] = $direcao; 
      if (is_array($direcao) && !empty($direcao))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $direcao;
      }
      elseif ($direcao_cond_salva == "nu" || $direcao_cond_salva == "nn" || $direcao_cond_salva == "ep" || $direcao_cond_salva == "ne" || !empty($direcao))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $direcao;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['direcao_cond'] = $direcao_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "direcao"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $direcao_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['direcao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['origem'] = $origem; 
      if (is_array($origem) && !empty($origem))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $origem;
      }
      elseif ($origem_cond_salva == "nu" || $origem_cond_salva == "nn" || $origem_cond_salva == "ep" || $origem_cond_salva == "ne" || !empty($origem))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $origem;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['origem_cond'] = $origem_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "origem"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $origem_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['origem'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['destino'] = $destino; 
      if (is_array($destino) && !empty($destino))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $destino;
      }
      elseif ($destino_cond_salva == "nu" || $destino_cond_salva == "nn" || $destino_cond_salva == "ep" || $destino_cond_salva == "ne" || !empty($destino))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $destino;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['destino_cond'] = $destino_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "destino"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $destino_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['destino'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['localizador'] = $localizador; 
      if (is_array($localizador) && !empty($localizador))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $localizador;
      }
      elseif ($localizador_cond_salva == "nu" || $localizador_cond_salva == "nn" || $localizador_cond_salva == "ep" || $localizador_cond_salva == "ne" || !empty($localizador))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $localizador;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['localizador_cond'] = $localizador_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "localizador"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $localizador_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['localizador'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['etkt'] = $etkt; 
      if (is_array($etkt) && !empty($etkt))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $etkt;
      }
      elseif ($etkt_cond_salva == "nu" || $etkt_cond_salva == "nn" || $etkt_cond_salva == "ep" || $etkt_cond_salva == "ne" || !empty($etkt))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $etkt;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['etkt_cond'] = $etkt_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "etkt"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $etkt_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['etkt'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['emitida_bvt'] = $emitida_bvt; 
      if (is_array($emitida_bvt) && !empty($emitida_bvt))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $emitida_bvt;
      }
      elseif ($emitida_bvt_cond_salva == "nu" || $emitida_bvt_cond_salva == "nn" || $emitida_bvt_cond_salva == "ep" || $emitida_bvt_cond_salva == "ne" || !empty($emitida_bvt))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $emitida_bvt;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['emitida_bvt_cond'] = $emitida_bvt_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "emitida_bvt"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $emitida_bvt_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['emitida_bvt'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['bloqueio_dsc'] = $bloqueio_dsc; 
      if (is_array($bloqueio_dsc) && !empty($bloqueio_dsc))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $bloqueio_dsc;
      }
      elseif ($bloqueio_dsc_cond_salva == "nu" || $bloqueio_dsc_cond_salva == "nn" || $bloqueio_dsc_cond_salva == "ep" || $bloqueio_dsc_cond_salva == "ne" || !empty($bloqueio_dsc))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $bloqueio_dsc;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['bloqueio_dsc_cond'] = $bloqueio_dsc_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "bloqueio_dsc"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $bloqueio_dsc_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['bloqueio_dsc'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_saida_dia'] = $data_saida_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_saida_mes'] = $data_saida_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_saida_ano'] = $data_saida_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_saida_input_2_dia'] = $data_saida_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_saida_input_2_mes'] = $data_saida_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_saida_input_2_ano'] = $data_saida_input_2_ano; 
      if (!empty($data_saida_dia) || !empty($data_saida_mes) || !empty($data_saida_ano) || $data_saida_cond_salva == "nu" || $data_saida_cond_salva == "nn" || $data_saida_cond_salva == "ep" || $data_saida_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][] = "D:" . $data_saida_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][] = "M:" . $data_saida_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][] = "Y:" . $data_saida_ano;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][1][] = "D:" . $data_saida_input_2_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][1][] = "M:" . $data_saida_input_2_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][1][] = "Y:" . $data_saida_input_2_ano;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_saida_cond'] = $data_saida_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "data_saida"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $data_saida_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['data_saida'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['hora_saida_hor'] = $hora_saida_hor; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['hora_saida_min'] = $hora_saida_min; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['hora_saida_seg'] = $hora_saida_seg; 
      if (!empty($hora_saida_hor) || !empty($hora_saida_min) || !empty($hora_saida_seg) || $hora_saida_cond_salva == "nu" || $hora_saida_cond_salva == "nn" || $hora_saida_cond_salva == "ep" || $hora_saida_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][] = "H:" . $hora_saida_hor;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][] = "I:" . $hora_saida_min;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][] = "S:" . $hora_saida_seg;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['hora_saida_cond'] = $hora_saida_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "hora_saida"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $hora_saida_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['hora_saida'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_chegada_dia'] = $data_chegada_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_chegada_mes'] = $data_chegada_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_chegada_ano'] = $data_chegada_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_chegada_input_2_dia'] = $data_chegada_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_chegada_input_2_mes'] = $data_chegada_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_chegada_input_2_ano'] = $data_chegada_input_2_ano; 
      if (!empty($data_chegada_dia) || !empty($data_chegada_mes) || !empty($data_chegada_ano) || $data_chegada_cond_salva == "nu" || $data_chegada_cond_salva == "nn" || $data_chegada_cond_salva == "ep" || $data_chegada_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][] = "D:" . $data_chegada_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][] = "M:" . $data_chegada_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][] = "Y:" . $data_chegada_ano;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][1][] = "D:" . $data_chegada_input_2_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][1][] = "M:" . $data_chegada_input_2_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][1][] = "Y:" . $data_chegada_input_2_ano;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_chegada_cond'] = $data_chegada_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "data_chegada"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $data_chegada_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['data_chegada'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['hora_chegada_hor'] = $hora_chegada_hor; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['hora_chegada_min'] = $hora_chegada_min; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['hora_chegada_seg'] = $hora_chegada_seg; 
      if (!empty($hora_chegada_hor) || !empty($hora_chegada_min) || !empty($hora_chegada_seg) || $hora_chegada_cond_salva == "nu" || $hora_chegada_cond_salva == "nn" || $hora_chegada_cond_salva == "ep" || $hora_chegada_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][] = "H:" . $hora_chegada_hor;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][] = "I:" . $hora_chegada_min;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][] = "S:" . $hora_chegada_seg;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['hora_chegada_cond'] = $hora_chegada_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "hora_chegada"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $hora_chegada_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['hora_chegada'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_nota_gate_dia'] = $data_nota_gate_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_nota_gate_mes'] = $data_nota_gate_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_nota_gate_ano'] = $data_nota_gate_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_nota_gate_input_2_dia'] = $data_nota_gate_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_nota_gate_input_2_mes'] = $data_nota_gate_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_nota_gate_input_2_ano'] = $data_nota_gate_input_2_ano; 
      if (!empty($data_nota_gate_dia) || !empty($data_nota_gate_mes) || !empty($data_nota_gate_ano) || $data_nota_gate_cond_salva == "nu" || $data_nota_gate_cond_salva == "nn" || $data_nota_gate_cond_salva == "ep" || $data_nota_gate_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][] = "D:" . $data_nota_gate_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][] = "M:" . $data_nota_gate_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][] = "Y:" . $data_nota_gate_ano;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][1][] = "D:" . $data_nota_gate_input_2_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][1][] = "M:" . $data_nota_gate_input_2_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][1][] = "Y:" . $data_nota_gate_input_2_ano;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_nota_gate_cond'] = $data_nota_gate_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "data_nota_gate"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $data_nota_gate_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['data_nota_gate'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['nota_gate'] = $nota_gate; 
      if (is_array($nota_gate) && !empty($nota_gate))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $nota_gate;
      }
      elseif ($nota_gate_cond_salva == "nu" || $nota_gate_cond_salva == "nn" || $nota_gate_cond_salva == "ep" || $nota_gate_cond_salva == "ne" || !empty($nota_gate))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $nota_gate;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['nota_gate_cond'] = $nota_gate_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "nota_gate"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $nota_gate_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['nota_gate'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['NM_operador'] = $this->NM_operador; 
      if ($this->NM_ajax_flag && $this->NM_ajax_opcao == "ajax_grid_search")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca'] = $Temp_Busca;
      }
      if (!empty($this->Campos_Mens_erro)) 
      {
          return;
      }
      $nmgp_def_dados = array();
    if ($participante_cpf != '') {
      $participante_cpf_look = (is_string($participante_cpf) ? substr($this->Db->qstr($participante_cpf), 1, -1) : $participante_cpf); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct participante_cpf from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#participante_cpf#lowerF# = #lowerI#'$participante_cpf_look'#lowerF# order by participante_cpf"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

    }
      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['participante_cpf'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['participante_cpf'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['participante_cpf'] = $participante_cpf;
      }
      $this->cmp_formatado['participante_cpf'] = "'" . $this->cmp_formatado['participante_cpf'] . "'";
      if (isset($this->cmp_formatado['participante_cpf_input_2'])  && !empty($this->cmp_formatado['participante_cpf_input_2'])) {
          $this->cmp_formatado['participante_cpf_input_2'] = "'" . $this->cmp_formatado['participante_cpf_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($participante_nome != '') {
      $participante_nome_look = (is_string($participante_nome) ? substr($this->Db->qstr($participante_nome), 1, -1) : $participante_nome); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct participante_nome from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#participante_nome#lowerF# = #lowerI#'$participante_nome_look'#lowerF# order by participante_nome"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

    }
      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['participante_nome'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['participante_nome'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['participante_nome'] = $participante_nome;
      }
      $this->cmp_formatado['participante_nome'] = "'" . $this->cmp_formatado['participante_nome'] . "'";
      if (isset($this->cmp_formatado['participante_nome_input_2'])  && !empty($this->cmp_formatado['participante_nome_input_2'])) {
          $this->cmp_formatado['participante_nome_input_2'] = "'" . $this->cmp_formatado['participante_nome_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($tipo_pessoa != '') {
      $tipo_pessoa_look = (is_string($tipo_pessoa) ? substr($this->Db->qstr($tipo_pessoa), 1, -1) : $tipo_pessoa); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tipo_pessoa from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#tipo_pessoa#lowerF# = #lowerI#'$tipo_pessoa_look'#lowerF# order by tipo_pessoa"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

    }
      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tipo_pessoa'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tipo_pessoa'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['tipo_pessoa'] = $tipo_pessoa;
      }
      $this->cmp_formatado['tipo_pessoa'] = "'" . $this->cmp_formatado['tipo_pessoa'] . "'";
      if (isset($this->cmp_formatado['tipo_pessoa_input_2'])  && !empty($this->cmp_formatado['tipo_pessoa_input_2'])) {
          $this->cmp_formatado['tipo_pessoa_input_2'] = "'" . $this->cmp_formatado['tipo_pessoa_input_2'] . "'";
      }
      $Conteudo = $cod_cia_aerea;
      if (strtoupper($cod_cia_aerea_cond) != "II" && strtoupper($cod_cia_aerea_cond) != "QP" && strtoupper($cod_cia_aerea_cond) != "NP" && strtoupper($cod_cia_aerea_cond) != "IN") 
      { 
          nmgp_Form_Num_Val($Conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      } 
      $this->cmp_formatado['cod_cia_aerea'] = $Conteudo;
      $this->cmp_formatado['cod_cia_aerea'] = "'" . $this->cmp_formatado['cod_cia_aerea'] . "'";
      if (isset($this->cmp_formatado['cod_cia_aerea_input_2'])  && !empty($this->cmp_formatado['cod_cia_aerea_input_2'])) {
          $this->cmp_formatado['cod_cia_aerea_input_2'] = "'" . $this->cmp_formatado['cod_cia_aerea_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($cia_aerea != '') {
      $cia_aerea_look = (is_string($cia_aerea) ? substr($this->Db->qstr($cia_aerea), 1, -1) : $cia_aerea); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct cia_aerea from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#cia_aerea#lowerF# = #lowerI#'$cia_aerea_look'#lowerF# order by cia_aerea"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

    }
      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['cia_aerea'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['cia_aerea'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['cia_aerea'] = $cia_aerea;
      }
      $this->cmp_formatado['cia_aerea'] = "'" . $this->cmp_formatado['cia_aerea'] . "'";
      if (isset($this->cmp_formatado['cia_aerea_input_2'])  && !empty($this->cmp_formatado['cia_aerea_input_2'])) {
          $this->cmp_formatado['cia_aerea_input_2'] = "'" . $this->cmp_formatado['cia_aerea_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($voo != '') {
      $voo_look = (is_string($voo) ? substr($this->Db->qstr($voo), 1, -1) : $voo); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct voo from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#voo#lowerF# = #lowerI#'$voo_look'#lowerF# order by voo"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

    }
      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['voo'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['voo'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['voo'] = $voo;
      }
      $this->cmp_formatado['voo'] = "'" . $this->cmp_formatado['voo'] . "'";
      if (isset($this->cmp_formatado['voo_input_2'])  && !empty($this->cmp_formatado['voo_input_2'])) {
          $this->cmp_formatado['voo_input_2'] = "'" . $this->cmp_formatado['voo_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($direcao != '') {
      $direcao_look = (is_string($direcao) ? substr($this->Db->qstr($direcao), 1, -1) : $direcao); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct direcao from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#direcao#lowerF# = #lowerI#'$direcao_look'#lowerF# order by direcao"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

    }
      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['direcao'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['direcao'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['direcao'] = $direcao;
      }
      $this->cmp_formatado['direcao'] = "'" . $this->cmp_formatado['direcao'] . "'";
      if (isset($this->cmp_formatado['direcao_input_2'])  && !empty($this->cmp_formatado['direcao_input_2'])) {
          $this->cmp_formatado['direcao_input_2'] = "'" . $this->cmp_formatado['direcao_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($origem != '') {
      $origem_look = (is_string($origem) ? substr($this->Db->qstr($origem), 1, -1) : $origem); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct origem from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#origem#lowerF# = #lowerI#'$origem_look'#lowerF# order by origem"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

    }
      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['origem'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['origem'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['origem'] = $origem;
      }
      $this->cmp_formatado['origem'] = "'" . $this->cmp_formatado['origem'] . "'";
      if (isset($this->cmp_formatado['origem_input_2'])  && !empty($this->cmp_formatado['origem_input_2'])) {
          $this->cmp_formatado['origem_input_2'] = "'" . $this->cmp_formatado['origem_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($destino != '') {
      $destino_look = (is_string($destino) ? substr($this->Db->qstr($destino), 1, -1) : $destino); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct destino from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#destino#lowerF# = #lowerI#'$destino_look'#lowerF# order by destino"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

    }
      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['destino'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['destino'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['destino'] = $destino;
      }
      $this->cmp_formatado['destino'] = "'" . $this->cmp_formatado['destino'] . "'";
      if (isset($this->cmp_formatado['destino_input_2'])  && !empty($this->cmp_formatado['destino_input_2'])) {
          $this->cmp_formatado['destino_input_2'] = "'" . $this->cmp_formatado['destino_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($localizador != '') {
      $localizador_look = (is_string($localizador) ? substr($this->Db->qstr($localizador), 1, -1) : $localizador); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct localizador from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#localizador#lowerF# = #lowerI#'$localizador_look'#lowerF# order by localizador"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

    }
      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['localizador'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['localizador'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['localizador'] = $localizador;
      }
      $this->cmp_formatado['localizador'] = "'" . $this->cmp_formatado['localizador'] . "'";
      if (isset($this->cmp_formatado['localizador_input_2'])  && !empty($this->cmp_formatado['localizador_input_2'])) {
          $this->cmp_formatado['localizador_input_2'] = "'" . $this->cmp_formatado['localizador_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($etkt != '') {
      $etkt_look = (is_string($etkt) ? substr($this->Db->qstr($etkt), 1, -1) : $etkt); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct etkt from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#etkt#lowerF# = #lowerI#'$etkt_look'#lowerF# order by etkt"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

    }
      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['etkt'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['etkt'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['etkt'] = $etkt;
      }
      $this->cmp_formatado['etkt'] = "'" . $this->cmp_formatado['etkt'] . "'";
      if (isset($this->cmp_formatado['etkt_input_2'])  && !empty($this->cmp_formatado['etkt_input_2'])) {
          $this->cmp_formatado['etkt_input_2'] = "'" . $this->cmp_formatado['etkt_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($emitida_bvt != '') {
      $emitida_bvt_look = (is_string($emitida_bvt) ? substr($this->Db->qstr($emitida_bvt), 1, -1) : $emitida_bvt); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct emitida_bvt from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#emitida_bvt#lowerF# = #lowerI#'$emitida_bvt_look'#lowerF# order by emitida_bvt"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

    }
      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['emitida_bvt'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['emitida_bvt'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['emitida_bvt'] = $emitida_bvt;
      }
      $this->cmp_formatado['emitida_bvt'] = "'" . $this->cmp_formatado['emitida_bvt'] . "'";
      if (isset($this->cmp_formatado['emitida_bvt_input_2'])  && !empty($this->cmp_formatado['emitida_bvt_input_2'])) {
          $this->cmp_formatado['emitida_bvt_input_2'] = "'" . $this->cmp_formatado['emitida_bvt_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($bloqueio_dsc != '') {
      $bloqueio_dsc_look = (is_string($bloqueio_dsc) ? substr($this->Db->qstr($bloqueio_dsc), 1, -1) : $bloqueio_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct bloqueio_dsc from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#bloqueio_dsc#lowerF# = #lowerI#'$bloqueio_dsc_look'#lowerF# order by bloqueio_dsc"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

    }
      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['bloqueio_dsc'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['bloqueio_dsc'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['bloqueio_dsc'] = $bloqueio_dsc;
      }
      $this->cmp_formatado['bloqueio_dsc'] = "'" . $this->cmp_formatado['bloqueio_dsc'] . "'";
      if (isset($this->cmp_formatado['bloqueio_dsc_input_2'])  && !empty($this->cmp_formatado['bloqueio_dsc_input_2'])) {
          $this->cmp_formatado['bloqueio_dsc_input_2'] = "'" . $this->cmp_formatado['bloqueio_dsc_input_2'] . "'";
      }
      $this->cmp_formatado['data_saida'] = "'" . $this->cmp_formatado['data_saida'] . "'";
      if (isset($this->cmp_formatado['data_saida_input_2'])  && !empty($this->cmp_formatado['data_saida_input_2'])) {
          $this->cmp_formatado['data_saida_input_2'] = "'" . $this->cmp_formatado['data_saida_input_2'] . "'";
      }
      $this->cmp_formatado['hora_saida'] = "'" . $this->cmp_formatado['hora_saida'] . "'";
      if (isset($this->cmp_formatado['hora_saida_input_2'])  && !empty($this->cmp_formatado['hora_saida_input_2'])) {
          $this->cmp_formatado['hora_saida_input_2'] = "'" . $this->cmp_formatado['hora_saida_input_2'] . "'";
      }
      $this->cmp_formatado['data_chegada'] = "'" . $this->cmp_formatado['data_chegada'] . "'";
      if (isset($this->cmp_formatado['data_chegada_input_2'])  && !empty($this->cmp_formatado['data_chegada_input_2'])) {
          $this->cmp_formatado['data_chegada_input_2'] = "'" . $this->cmp_formatado['data_chegada_input_2'] . "'";
      }
      $this->cmp_formatado['hora_chegada'] = "'" . $this->cmp_formatado['hora_chegada'] . "'";
      if (isset($this->cmp_formatado['hora_chegada_input_2'])  && !empty($this->cmp_formatado['hora_chegada_input_2'])) {
          $this->cmp_formatado['hora_chegada_input_2'] = "'" . $this->cmp_formatado['hora_chegada_input_2'] . "'";
      }
      $this->cmp_formatado['data_nota_gate'] = "'" . $this->cmp_formatado['data_nota_gate'] . "'";
      if (isset($this->cmp_formatado['data_nota_gate_input_2'])  && !empty($this->cmp_formatado['data_nota_gate_input_2'])) {
          $this->cmp_formatado['data_nota_gate_input_2'] = "'" . $this->cmp_formatado['data_nota_gate_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($nota_gate != '') {
      $nota_gate_look = (is_string($nota_gate) ? substr($this->Db->qstr($nota_gate), 1, -1) : $nota_gate); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct nota_gate from " . $this->Ini->nm_tabela . " where (id_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#nota_gate#lowerF# = #lowerI#'$nota_gate_look'#lowerF# order by nota_gate"; 
      $this->Sel_case_sensitive($nm_comando);
      unset($cmp1,$cmp2);
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->SelectLimit($nm_comando, 10, 0)) 
      { 
         while (!$rs->EOF) 
         { 
            $cmp1 = NM_charset_to_utf8(trim($rs->fields[0]));
            $nmgp_def_dados[] = array($cmp1 => $cmp1); 
            $rs->MoveNext() ; 
         } 
         $rs->Close() ; 
      } 
      else  
      {  
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit; 
      } 

    }
      if (!empty($nmgp_def_dados) && isset($cmp2) && !empty($cmp2))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp2 = NM_conv_charset($cmp2, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['nota_gate'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['nota_gate'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['nota_gate'] = $nota_gate;
      }
      $this->cmp_formatado['nota_gate'] = "'" . $this->cmp_formatado['nota_gate'] . "'";
      if (isset($this->cmp_formatado['nota_gate_input_2'])  && !empty($this->cmp_formatado['nota_gate_input_2'])) {
          $this->cmp_formatado['nota_gate_input_2'] = "'" . $this->cmp_formatado['nota_gate_input_2'] . "'";
      }
   }

   function processa_campos($Res_comp='pesq')
   {
      global $participante_cpf_cond, $participante_cpf, $participante_cpf_autocomp,
             $participante_nome_cond, $participante_nome, $participante_nome_autocomp,
             $tipo_pessoa_cond, $tipo_pessoa, $tipo_pessoa_autocomp,
             $cod_cia_aerea_cond, $cod_cia_aerea,
             $cia_aerea_cond, $cia_aerea, $cia_aerea_autocomp,
             $voo_cond, $voo, $voo_autocomp,
             $direcao_cond, $direcao, $direcao_autocomp,
             $origem_cond, $origem, $origem_autocomp,
             $destino_cond, $destino, $destino_autocomp,
             $localizador_cond, $localizador, $localizador_autocomp,
             $etkt_cond, $etkt, $etkt_autocomp,
             $emitida_bvt_cond, $emitida_bvt, $emitida_bvt_autocomp,
             $bloqueio_dsc_cond, $bloqueio_dsc, $bloqueio_dsc_autocomp,
             $data_saida_cond, $data_saida, $data_saida_dia, $data_saida_mes, $data_saida_ano, $data_saida_input_2_dia, $data_saida_input_2_mes, $data_saida_input_2_ano,
             $hora_saida_cond, $hora_saida, $hora_saida_hor, $hora_saida_min, $hora_saida_seg,
             $data_chegada_cond, $data_chegada, $data_chegada_dia, $data_chegada_mes, $data_chegada_ano, $data_chegada_input_2_dia, $data_chegada_input_2_mes, $data_chegada_input_2_ano,
             $hora_chegada_cond, $hora_chegada, $hora_chegada_hor, $hora_chegada_min, $hora_chegada_seg,
             $data_nota_gate_cond, $data_nota_gate, $data_nota_gate_dia, $data_nota_gate_mes, $data_nota_gate_ano, $data_nota_gate_input_2_dia, $data_nota_gate_input_2_mes, $data_nota_gate_input_2_ano,
             $nota_gate_cond, $nota_gate, $nota_gate_autocomp, $nmgp_tab_label;


      //----- $participante_cpf
      $this->Date_part = false;
      if (isset($participante_cpf) || $participante_cpf_cond == "nu" || $participante_cpf_cond == "nn" || $participante_cpf_cond == "ep" || $participante_cpf_cond == "ne")
      {
         $this->monta_condicao("participante_cpf", $participante_cpf_cond, $participante_cpf, "", "participante_cpf", "VARCHAR", false);
      }

      //----- $participante_nome
      $this->Date_part = false;
      if (isset($participante_nome) || $participante_nome_cond == "nu" || $participante_nome_cond == "nn" || $participante_nome_cond == "ep" || $participante_nome_cond == "ne")
      {
         $this->monta_condicao("participante_nome", $participante_nome_cond, $participante_nome, "", "participante_nome", "VARCHAR", false);
      }

      //----- $tipo_pessoa
      $this->Date_part = false;
      if (isset($tipo_pessoa) || $tipo_pessoa_cond == "nu" || $tipo_pessoa_cond == "nn" || $tipo_pessoa_cond == "ep" || $tipo_pessoa_cond == "ne")
      {
         $this->monta_condicao("tipo_pessoa", $tipo_pessoa_cond, $tipo_pessoa, "", "tipo_pessoa", "VARCHAR", false);
      }

      //----- $cod_cia_aerea
      $this->Date_part = false;
      if (isset($cod_cia_aerea) || $cod_cia_aerea_cond == "nu" || $cod_cia_aerea_cond == "nn" || $cod_cia_aerea_cond == "ep" || $cod_cia_aerea_cond == "ne")
      {
         $this->monta_condicao("cod_cia_aerea", $cod_cia_aerea_cond, $cod_cia_aerea, "", "cod_cia_aerea", "INT", false);
      }

      //----- $cia_aerea
      $this->Date_part = false;
      if (isset($cia_aerea) || $cia_aerea_cond == "nu" || $cia_aerea_cond == "nn" || $cia_aerea_cond == "ep" || $cia_aerea_cond == "ne")
      {
         $this->monta_condicao("cia_aerea", $cia_aerea_cond, $cia_aerea, "", "cia_aerea", "VARCHAR", false);
      }

      //----- $voo
      $this->Date_part = false;
      if (isset($voo) || $voo_cond == "nu" || $voo_cond == "nn" || $voo_cond == "ep" || $voo_cond == "ne")
      {
         $this->monta_condicao("voo", $voo_cond, $voo, "", "voo", "VARCHAR", false);
      }

      //----- $direcao
      $this->Date_part = false;
      if (isset($direcao) || $direcao_cond == "nu" || $direcao_cond == "nn" || $direcao_cond == "ep" || $direcao_cond == "ne")
      {
         $this->monta_condicao("direcao", $direcao_cond, $direcao, "", "direcao", "VARCHAR", false);
      }

      //----- $origem
      $this->Date_part = false;
      if (isset($origem) || $origem_cond == "nu" || $origem_cond == "nn" || $origem_cond == "ep" || $origem_cond == "ne")
      {
         $this->monta_condicao("origem", $origem_cond, $origem, "", "origem", "VARCHAR", false);
      }

      //----- $destino
      $this->Date_part = false;
      if (isset($destino) || $destino_cond == "nu" || $destino_cond == "nn" || $destino_cond == "ep" || $destino_cond == "ne")
      {
         $this->monta_condicao("destino", $destino_cond, $destino, "", "destino", "VARCHAR", false);
      }

      //----- $localizador
      $this->Date_part = false;
      if (isset($localizador) || $localizador_cond == "nu" || $localizador_cond == "nn" || $localizador_cond == "ep" || $localizador_cond == "ne")
      {
         $this->monta_condicao("localizador", $localizador_cond, $localizador, "", "localizador", "VARCHAR", false);
      }

      //----- $etkt
      $this->Date_part = false;
      if (isset($etkt) || $etkt_cond == "nu" || $etkt_cond == "nn" || $etkt_cond == "ep" || $etkt_cond == "ne")
      {
         $this->monta_condicao("etkt", $etkt_cond, $etkt, "", "etkt", "VARCHAR", false);
      }

      //----- $emitida_bvt
      $this->Date_part = false;
      if (isset($emitida_bvt) || $emitida_bvt_cond == "nu" || $emitida_bvt_cond == "nn" || $emitida_bvt_cond == "ep" || $emitida_bvt_cond == "ne")
      {
         $this->monta_condicao("emitida_bvt", $emitida_bvt_cond, $emitida_bvt, "", "emitida_bvt", "VARCHAR", false);
      }

      //----- $bloqueio_dsc
      $this->Date_part = false;
      if (isset($bloqueio_dsc) || $bloqueio_dsc_cond == "nu" || $bloqueio_dsc_cond == "nn" || $bloqueio_dsc_cond == "ep" || $bloqueio_dsc_cond == "ne")
      {
         $this->monta_condicao("bloqueio_dsc", $bloqueio_dsc_cond, $bloqueio_dsc, "", "bloqueio_dsc", "VARCHAR", false);
      }

      //----- $data_saida
      $this->Date_part = false;
      if ($data_saida_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $data_saida_cond = strtoupper($data_saida_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $data_saida_ano;
          $Dtxt .= $data_saida_mes;
          $Dtxt .= $data_saida_dia;
          $val[0]['ano'] = $data_saida_ano;
          $val[0]['mes'] = $data_saida_mes;
          $val[0]['dia'] = $data_saida_dia;
          if ($data_saida_cond == "BW")
          {
              $val[1]['ano'] = $data_saida_input_2_ano;
              $val[1]['mes'] = $data_saida_input_2_mes;
              $val[1]['dia'] = $data_saida_input_2_dia;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->nm_prep_date($val, "DT", "DATETIME", $data_saida_cond, "", "data");
          }
          else
          {
              $this->nm_prep_date($val, "DT", "DATE", $data_saida_cond, "", "data");
          }
          if (!$this->Date_part) {
              $val[0] = $this->Ini->sc_Date_Protect($val[0]);
          }
          $data_saida = $val[0];
          $this->cmp_formatado['data_saida'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_saida'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['data_saida'], "YYYY-MM-DD");
          $this->cmp_formatado['data_saida'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['data_saida'] = "'" . $this->cmp_formatado['data_saida'] . "'";
          if ($data_saida_cond == "BW")
          {
              if (!$this->Date_part) {
                  $val[1] = $this->Ini->sc_Date_Protect($val[1]);
              }
              $data_saida_input_2     = $val[1];
              $this->cmp_formatado['data_saida_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_saida_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['data_saida_input_2'], "YYYY-MM-DD");
              $this->cmp_formatado['data_saida_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['data_saida_input_2'] = "'" . $this->cmp_formatado['data_saida_input_2'] . "'";
          }
          if (!empty($Dtxt) || $data_saida_cond == "NU" || $data_saida_cond == "NN"|| $data_saida_cond == "EP"|| $data_saida_cond == "NE")
          {
              $this->monta_condicao("data_saida", $data_saida_cond, $data_saida, $data_saida_input_2, 'data_saida', 'DATE');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['data_saida']['label'] = $nmgp_tab_label['data_saida'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['data_saida']['descr'] = $nmgp_tab_label['data_saida'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['data_saida']['hint']  = $nmgp_tab_label['data_saida'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $hora_saida
      $this->Date_part = false;
      if ($hora_saida_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $hora_saida_cond = strtoupper($hora_saida_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $hora_saida_hor;
          $Dtxt .= $hora_saida_min;
          $Dtxt .= $hora_saida_seg;
          $val[0]['hor'] = $hora_saida_hor;
          $val[0]['min'] = $hora_saida_min;
          $val[0]['seg'] = $hora_saida_seg;
          if ($hora_saida_cond == "BW")
          {
              $val[1]['ano'] = $hora_saida_input_2_ano;
              $val[1]['mes'] = $hora_saida_input_2_mes;
              $val[1]['dia'] = $hora_saida_input_2_dia;
              $val[1]['hor'] = $hora_saida_input_2_hor;
              $val[1]['min'] = $hora_saida_input_2_min;
              $val[1]['seg'] = $hora_saida_input_2_seg;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          $this->nm_prep_date($val, "HH", "TIME", $hora_saida_cond, "", "hora");
          $hora_saida = $val[0];
          $this->cmp_formatado['hora_saida'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['hora_saida'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['hora_saida'], "HH:II:SS");
          $this->cmp_formatado['hora_saida'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "his"));
          $this->cmp_formatado['hora_saida'] = "'" . $this->cmp_formatado['hora_saida'] . "'";
          if ($hora_saida_cond == "BW")
          {
              $hora_saida_input_2     = $val[1];
              $this->cmp_formatado['hora_saida_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['hora_saida_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['hora_saida_input_2'], "HH:II:SS");
              $this->cmp_formatado['hora_saida_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "his"));
          $this->cmp_formatado['hora_saida_input_2'] = "'" . $this->cmp_formatado['hora_saida_input_2'] . "'";
          }
          if (!empty($Dtxt) || $hora_saida_cond == "NU" || $hora_saida_cond == "NN"|| $hora_saida_cond == "EP"|| $hora_saida_cond == "NE")
          {
              $this->monta_condicao("hora_saida", $hora_saida_cond, $hora_saida, $hora_saida_input_2, 'hora_saida', 'TIME');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['hora_saida']['label'] = $nmgp_tab_label['hora_saida'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['hora_saida']['descr'] = $nmgp_tab_label['hora_saida'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['hora_saida']['hint']  = $nmgp_tab_label['hora_saida'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $data_chegada
      $this->Date_part = false;
      if ($data_chegada_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $data_chegada_cond = strtoupper($data_chegada_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $data_chegada_ano;
          $Dtxt .= $data_chegada_mes;
          $Dtxt .= $data_chegada_dia;
          $val[0]['ano'] = $data_chegada_ano;
          $val[0]['mes'] = $data_chegada_mes;
          $val[0]['dia'] = $data_chegada_dia;
          if ($data_chegada_cond == "BW")
          {
              $val[1]['ano'] = $data_chegada_input_2_ano;
              $val[1]['mes'] = $data_chegada_input_2_mes;
              $val[1]['dia'] = $data_chegada_input_2_dia;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->nm_prep_date($val, "DT", "DATETIME", $data_chegada_cond, "", "data");
          }
          else
          {
              $this->nm_prep_date($val, "DT", "DATE", $data_chegada_cond, "", "data");
          }
          if (!$this->Date_part) {
              $val[0] = $this->Ini->sc_Date_Protect($val[0]);
          }
          $data_chegada = $val[0];
          $this->cmp_formatado['data_chegada'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_chegada'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['data_chegada'], "YYYY-MM-DD");
          $this->cmp_formatado['data_chegada'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['data_chegada'] = "'" . $this->cmp_formatado['data_chegada'] . "'";
          if ($data_chegada_cond == "BW")
          {
              if (!$this->Date_part) {
                  $val[1] = $this->Ini->sc_Date_Protect($val[1]);
              }
              $data_chegada_input_2     = $val[1];
              $this->cmp_formatado['data_chegada_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_chegada_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['data_chegada_input_2'], "YYYY-MM-DD");
              $this->cmp_formatado['data_chegada_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['data_chegada_input_2'] = "'" . $this->cmp_formatado['data_chegada_input_2'] . "'";
          }
          if (!empty($Dtxt) || $data_chegada_cond == "NU" || $data_chegada_cond == "NN"|| $data_chegada_cond == "EP"|| $data_chegada_cond == "NE")
          {
              $this->monta_condicao("data_chegada", $data_chegada_cond, $data_chegada, $data_chegada_input_2, 'data_chegada', 'DATE');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['data_chegada']['label'] = $nmgp_tab_label['data_chegada'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['data_chegada']['descr'] = $nmgp_tab_label['data_chegada'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['data_chegada']['hint']  = $nmgp_tab_label['data_chegada'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $hora_chegada
      $this->Date_part = false;
      if ($hora_chegada_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $hora_chegada_cond = strtoupper($hora_chegada_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $hora_chegada_hor;
          $Dtxt .= $hora_chegada_min;
          $Dtxt .= $hora_chegada_seg;
          $val[0]['hor'] = $hora_chegada_hor;
          $val[0]['min'] = $hora_chegada_min;
          $val[0]['seg'] = $hora_chegada_seg;
          if ($hora_chegada_cond == "BW")
          {
              $val[1]['ano'] = $hora_chegada_input_2_ano;
              $val[1]['mes'] = $hora_chegada_input_2_mes;
              $val[1]['dia'] = $hora_chegada_input_2_dia;
              $val[1]['hor'] = $hora_chegada_input_2_hor;
              $val[1]['min'] = $hora_chegada_input_2_min;
              $val[1]['seg'] = $hora_chegada_input_2_seg;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          $this->nm_prep_date($val, "HH", "TIME", $hora_chegada_cond, "", "hora");
          $hora_chegada = $val[0];
          $this->cmp_formatado['hora_chegada'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['hora_chegada'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['hora_chegada'], "HH:II:SS");
          $this->cmp_formatado['hora_chegada'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "his"));
          $this->cmp_formatado['hora_chegada'] = "'" . $this->cmp_formatado['hora_chegada'] . "'";
          if ($hora_chegada_cond == "BW")
          {
              $hora_chegada_input_2     = $val[1];
              $this->cmp_formatado['hora_chegada_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['hora_chegada_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['hora_chegada_input_2'], "HH:II:SS");
              $this->cmp_formatado['hora_chegada_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "his"));
          $this->cmp_formatado['hora_chegada_input_2'] = "'" . $this->cmp_formatado['hora_chegada_input_2'] . "'";
          }
          if (!empty($Dtxt) || $hora_chegada_cond == "NU" || $hora_chegada_cond == "NN"|| $hora_chegada_cond == "EP"|| $hora_chegada_cond == "NE")
          {
              $this->monta_condicao("hora_chegada", $hora_chegada_cond, $hora_chegada, $hora_chegada_input_2, 'hora_chegada', 'TIME');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['hora_chegada']['label'] = $nmgp_tab_label['hora_chegada'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['hora_chegada']['descr'] = $nmgp_tab_label['hora_chegada'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['hora_chegada']['hint']  = $nmgp_tab_label['hora_chegada'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $data_nota_gate
      $this->Date_part = false;
      if ($data_nota_gate_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $data_nota_gate_cond = strtoupper($data_nota_gate_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $data_nota_gate_ano;
          $Dtxt .= $data_nota_gate_mes;
          $Dtxt .= $data_nota_gate_dia;
          $val[0]['ano'] = $data_nota_gate_ano;
          $val[0]['mes'] = $data_nota_gate_mes;
          $val[0]['dia'] = $data_nota_gate_dia;
          if ($data_nota_gate_cond == "BW")
          {
              $val[1]['ano'] = $data_nota_gate_input_2_ano;
              $val[1]['mes'] = $data_nota_gate_input_2_mes;
              $val[1]['dia'] = $data_nota_gate_input_2_dia;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->nm_prep_date($val, "DT", "DATETIME", $data_nota_gate_cond, "", "data");
          }
          else
          {
              $this->nm_prep_date($val, "DT", "DATE", $data_nota_gate_cond, "", "data");
          }
          if (!$this->Date_part) {
              $val[0] = $this->Ini->sc_Date_Protect($val[0]);
          }
          $data_nota_gate = $val[0];
          $this->cmp_formatado['data_nota_gate'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_nota_gate'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['data_nota_gate'], "YYYY-MM-DD");
          $this->cmp_formatado['data_nota_gate'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['data_nota_gate'] = "'" . $this->cmp_formatado['data_nota_gate'] . "'";
          if ($data_nota_gate_cond == "BW")
          {
              if (!$this->Date_part) {
                  $val[1] = $this->Ini->sc_Date_Protect($val[1]);
              }
              $data_nota_gate_input_2     = $val[1];
              $this->cmp_formatado['data_nota_gate_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']['data_nota_gate_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['data_nota_gate_input_2'], "YYYY-MM-DD");
              $this->cmp_formatado['data_nota_gate_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['data_nota_gate_input_2'] = "'" . $this->cmp_formatado['data_nota_gate_input_2'] . "'";
          }
          if (!empty($Dtxt) || $data_nota_gate_cond == "NU" || $data_nota_gate_cond == "NN"|| $data_nota_gate_cond == "EP"|| $data_nota_gate_cond == "NE")
          {
              $this->monta_condicao("data_nota_gate", $data_nota_gate_cond, $data_nota_gate, $data_nota_gate_input_2, 'data_nota_gate', 'DATE');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['data_nota_gate']['label'] = $nmgp_tab_label['data_nota_gate'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['data_nota_gate']['descr'] = $nmgp_tab_label['data_nota_gate'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['grid_pesq']['data_nota_gate']['hint']  = $nmgp_tab_label['data_nota_gate'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $nota_gate
      $this->Date_part = false;
      if (isset($nota_gate) || $nota_gate_cond == "nu" || $nota_gate_cond == "nn" || $nota_gate_cond == "ep" || $nota_gate_cond == "ne")
      {
         $this->monta_condicao("nota_gate", $nota_gate_cond, $nota_gate, "", "nota_gate", "VARCHAR", false);
      }
   }

   /**
    * @access  public
    */
   function Sel_case_sensitive(&$comando_sel)
   {
      if ($this->NM_case_insensitive)
      {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $comando_sel = str_replace("#lowerI#", "UCase(", $comando_sel);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              if (strpos($comando_sel, " like ") !== false)
              {
                  $comando_sel = str_replace("#lowerI#", "", $comando_sel);
                  $comando_sel = str_replace("#lowerF#", "", $comando_sel);
                  $comando_sel = str_replace(" like ", " ilike ", $comando_sel);
              }
              else
              {
                  $comando_sel = str_replace("#lowerI#", "Upper(", $comando_sel);
              }
          }
          else
          {
              $comando_sel = str_replace("#lowerI#", "Upper(", $comando_sel);
          }
          $comando_sel = str_replace("#lowerF#", ")", $comando_sel);
      }
      else
      {
          $comando_sel = str_replace("#lowerI#", "", $comando_sel);
          $comando_sel = str_replace("#lowerF#", "", $comando_sel);
      }
   }
   function finaliza_resultado_ajax()
   {
    $this->Sel_case_sensitive($this->comando);
       $this->comando = substr($this->comando, 8);
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq_grid'] = $this->comando;
       if (empty($this->comando)) 
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq_filtro'] = "";
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_orig'];
       }
       else
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq_filtro'] = "( " . $this->comando . " )";
           if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_orig'])) 
           {
               $this->comando = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_orig'] . " and (" . $this->comando . ")"; 
           }
           else
           {
               $this->comando = " where " . $this->comando; 
           }
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq'] = $this->comando;
       }
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq_fast'])) 
       {
           if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq'])) 
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq'] .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq_fast'] . ")";
           }
           else 
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq'] = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq_fast'] . ")";
           }
       }
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq_interativ'])) 
       {
           if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq'])) 
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq'] .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq_interativ'] . ")";
           }
           else 
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq'] = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq_interativ'];
           }
       }
   }
   function finaliza_resultado()
   {
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['dyn_search']      = array();
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['cond_dyn_search'] = "";
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq_fast'] = "";
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['fast_search']);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq_interativ'] = "";
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['interativ_search'] = array();
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['int_search_dados'] = array();
      if ("" == $this->comando_filtro)
      {
          $this->comando = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_orig'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']) && $_SESSION['scriptcase']['charset'] != "UTF-8")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca'], "UTF-8", $_SESSION['scriptcase']['charset']);
      }

      $this->Sel_case_sensitive($this->comando);
      $this->Sel_case_sensitive($this->comando_sum);
      $this->Sel_case_sensitive($this->comando_filtro);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq_grid']    = $this->comando_filtro;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq_lookup']  = $this->comando_sum . $this->comando_fim;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq']         = $this->comando . $this->comando_fim;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['opcao']              = "pesq";
      if ("" == $this->comando_filtro)
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq_filtro'] = "";
      }
      else
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq_filtro'] = " (" . trim($this->comando_filtro) . ")";
      }
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['cond_pesq'] .= $this->NM_operador;
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['contr_array_resumo'] = "NAO";
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['contr_total_geral']  = "NAO";
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['tot_geral']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['using_summary_cache']);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq'];

      if ($this->NM_ajax_flag && ($this->NM_ajax_opcao == "ajax_grid_search" || $this->NM_ajax_opcao == "ajax_grid_search_change_fil"))
      {
         return;
      }
      $this->retorna_pesq();
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
      $rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rs = false;
          $rs_erro = $this->Db->ErrorMsg();
      } 
	
	if (isset($rs[0][0])) {			
		switch($tipo) {
			case 'nivel':
				$ret = $rs[0][1];
				break;
			case 'nome':
				$ret = $rs[0][3];
				break;
			case 'cpf':
				$ret = $rs[0][4];
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
      $rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rs = false;
          $rs_erro = $this->Db->ErrorMsg();
      } 
	
			if (isset($rs[0][0])) {
				$nome_empresa = $rs[0][2];
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
      $rsj = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsj[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsj = false;
          $rsj_erro = $this->Db->ErrorMsg();
      } 
	
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

		$reg_part = sizeof($rsj );			
		if ($reg_part > 0) {				
			for ($i=0;$i<$reg_part;++$i) {												
				$v_evento				= $rsj[$i][0]; 	
				$v_usuario				= $rsj[$i][1];		
				$v_usuario_nome			= $rsj[$i][2]; 	
				$v_cpf					= $rsj[$i][3]; 	
				$v_status				= $rsj[$i][4]; 	
				$v_direcao				= $rsj[$i][5]; 	
				$v_cod_cia_aerea		= $rsj[$i][6]; 	
				$v_cia_aerea			= $rsj[$i][7]; 	
				$v_voo					= $rsj[$i][8];		
				$v_origem				= $rsj[$i][9]; 	
				$v_destino				= $rsj[$i][10];	
				$v_dt_saida				= $rsj[$i][11];	
				$v_hr_saida				= $rsj[$i][12];	
				$v_dt_chegada			= $rsj[$i][13];	
				$v_hr_chegada			= $rsj[$i][14];	
				$v_localizador			= $rsj[$i][15];	
				$v_etkt					= $rsj[$i][16];	
				$v_emitida_bvt			= $rsj[$i][17];	
				$v_bloqueio				= $rsj[$i][18];	
				$v_dbloqueio			= $rsj[$i][19];	
				$v_modificado_em		= $rsj[$i][20];	
				$v_ativo				= $rsj[$i][21];	
				$v_pax_gate				= $rsj[$i][22];	
				$v_nota_gate			= $rsj[$i][23];	
				$v_dt_nota_gate			= $rsj[$i][24];	
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
      $rspes = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspes[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspes = false;
          $rspes_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($rspes[0][0])) {									
					$v_participante_nome = $rspes[0][1];
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
      $rsc = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsc[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsc = false;
          $rsc_erro = $this->Db->ErrorMsg();
      } 
	
				if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

				$reg_count = sizeof($rsc );	
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
      $rsbs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsbs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsbs = false;
          $rsbs_erro = $this->Db->ErrorMsg();
      } 
	
						if (isset($rsbs[0][0])) {	
							$_sentido 	= $rsbs[0][2];									
							$_total_bloq = $rsbs[0][3];									
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
      $rslins = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rslins[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rslins = false;
          $rslins_erro = $this->Db->ErrorMsg();
      } 

					if (isset($rslins[0][0])) {
						$qtde = $rslins[0][0];
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
      $rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rs = false;
          $rs_erro = $this->Db->ErrorMsg();
      } 
	
			if (isset($rs[0][0])) {
				$nome_empresa = $rs[0][2];
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
      $rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rs = false;
          $rs_erro = $this->Db->ErrorMsg();
      } 
	
		$reg_subs = sizeof($rs );
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
      $rsj = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsj[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsj = false;
          $rsj_erro = $this->Db->ErrorMsg();
      } 
	
			if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

			$reg_part = sizeof($rsj );			
			if ($reg_part > 0) {				
				for ($i=0;$i<$reg_part;++$i) {						
					$v_evento				= $rsj[$i][0]; 	
					$v_usuario				= $rsj[$i][1];		
					$v_usuario_nome			= $rsj[$i][2]; 	
					$v_cpf					= $rsj[$i][3]; 	
					$v_participante_nome	= $rsj[$i][4]; 	
					$v_status				= $rsj[$i][5]; 	
					$v_direcao				= $rsj[$i][6]; 	
					$v_cod_cia_aerea		= $rsj[$i][7]; 	
					$v_cia_aerea			= $rsj[$i][8]; 	
					$v_voo					= $rsj[$i][9];		
					$v_origem				= $rsj[$i][10]; 	
					$v_destino				= $rsj[$i][11];	
					$v_dt_saida				= $rsj[$i][12];	
					$v_hr_saida				= $rsj[$i][13];	
					$v_dt_chegada			= $rsj[$i][14];	
					$v_hr_chegada			= $rsj[$i][15];	
					$v_localizador			= $rsj[$i][16];	
					$v_etkt					= $rsj[$i][17];	
					$v_emitida_bvt			= $rsj[$i][18];	
					$v_bloqueio				= $rsj[$i][19];	
					$v_dbloqueio			= $rsj[$i][20];	
					$v_modificado_em		= $rsj[$i][21];	
					$v_ativo				= $rsj[$i][22];	
					$v_pax_gate				= $rsj[$i][23];	
					$v_nota_gate			= $rsj[$i][24];	
					$v_dt_nota_gate			= $rsj[$i][25];	
					
					$v_publico_id			= $rsj[$i][26];							
					
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
      $rsc = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsc[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsc = false;
          $rsc_erro = $this->Db->ErrorMsg();
      } 
	
					if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

					$reg_count = sizeof($rsc );							
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
      $rsbs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsbs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsbs = false;
          $rsbs_erro = $this->Db->ErrorMsg();
      } 
	
							if (isset($rsbs[0][0])) {	
								$_sentido 	= $rsbs[0][2];									
								$_total_bloq = $rsbs[0][3];									
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
      $rspa = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspa[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspa = false;
          $rspa_erro = $this->Db->ErrorMsg();
      } 
	
						if (isset($rspa[0][0])) {	
							$v_publico_id = $rspa[0][1];
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
      $rspb = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspb[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspb = false;
          $rspb_erro = $this->Db->ErrorMsg();
      } 
	
						if (isset($rspb[0][0])) {	
							$v_publico_dsc = $rspb[0][1];									
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
      $rslins = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rslins[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rslins = false;
          $rslins_erro = $this->Db->ErrorMsg();
      } 

						if (isset($rslins[0][0])) {
							$qtde = $rslins[0][0];
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
      $rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rs = false;
          $rs_erro = $this->Db->ErrorMsg();
      } 
	
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

		$reg_subs = sizeof($rs );
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
      $rsj = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsj[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsj = false;
          $rsj_erro = $this->Db->ErrorMsg();
      } 
	
			if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

			$reg_part = sizeof($rsj );
			if ($reg_part > 0) {				
				for ($i=0;$i<$reg_part;++$i) {	
					$vppublico 					= $rsj[$i][0];   
					$vpregional					= $rsj[$i][1];   
					$vpgrupo 					= $rsj[$i][2];	  
					$vpdepartamento 			= $rsj[$i][3];	  
					$vpcargo 					= $rsj[$i][4];   
					$vptam_camisa           	= $rsj[$i][5];   
					$vpidioma               	= $rsj[$i][6];   
					$vpempresa              	= $rsj[$i][7];   
					$vpuf                   	= $rsj[$i][8];   
					$vppais                 	= $rsj[$i][9];   
					$vpemail                	= $rsj[$i][10];  
					$vpemail_secretaria     	= $rsj[$i][11];  
					$vpddd_celular_01       	= $rsj[$i][12];  
					$vpcelular_01           	= $rsj[$i][13];  
					$vpddd_01               	= $rsj[$i][14];  
					$vpfone_01              	= $rsj[$i][15];  
					$vpnome                 	= $rsj[$i][16];  
					$vpcpf                  	= $rsj[$i][17];  
					$vpevento               	= $rsj[$i][18];  
					$vcontato_cpf            	= $rsj[$i][19];  
					$vcontato_status         	= $rsj[$i][20];  
					$vcontato_data           	= $rsj[$i][21]; 
					$vcontato_motivo         	= $rsj[$i][22];
					$vcontato_obs            	= $rsj[$i][23];
					$vcontato_usuario_id        = $rsj[$i][24];
					$vpresenca_tipo_part        = $rsj[$i][25];
					$vpresenca_status        	= $rsj[$i][26];
					$vpresenca_obs           	= $rsj[$i][27];
					$vpresenca_motivo        	= $rsj[$i][28];  
					$vpresenca_data				= $rsj[$i][29];  
					$vpresenca_usuario_id       = $rsj[$i][30];  
					$vcontato_usuario_nome		= $rsj[$i][31];  
					$vpresenca_usuario_nome		= $rsj[$i][32];  
					$vpublico_nome				= $rsj[$i][33];  
					$vregional_nome				= $rsj[$i][34];  

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
      $rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rs = false;
          $rs_erro = $this->Db->ErrorMsg();
      } 
	
	if (isset($rs[0][0]))
		$ret = $rs[0][0];
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'off';
}

}

?>
