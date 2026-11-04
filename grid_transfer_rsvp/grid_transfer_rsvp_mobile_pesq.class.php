<?php

class grid_transfer_rsvp_pesq
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['path_libs_php'] = $this->Ini->path_lib_php;
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca'] = array(); 
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
                      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca'][$field] = $arr_tmp; 
                  }
                  else
                  {
                      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca'][$field] = $cada_dado['value']; 
                  }
              }
          }
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca'], $_SESSION['scriptcase']['charset'], "UTF-8");
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['opcao'] = "igual";
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
                  $Opt_filter .= "<option value=\"\">" . grid_transfer_rsvp_pack_protect_string($Nome_filter) . "</option>\r\n";
              }
              $Opt_filter .= "<option value=\"" . grid_transfer_rsvp_pack_protect_string($Tipo_filter[0]) . "\">.." . htmlspecialchars($Cada_filter).  "</option>\r\n";
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
                  $Opt_filter .= "<option value=\"\">" .  grid_transfer_rsvp_pack_protect_string($Nome_filter) . "</option>\r\n";
              }
              $Opt_filter .= "<option value=\"" . grid_transfer_rsvp_pack_protect_string($Tipo_filter[0]) . "\">.." . grid_transfer_rsvp_pack_protect_string($Cada_filter) .  "</option>\r\n";
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

      if ($this->NM_ajax_opcao == 'autocomp_tra_cpf_particip')
      {
          $tra_cpf_particip = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_tra_cpf_particip($tra_cpf_particip);
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
      if ($this->NM_ajax_opcao == 'autocomp_tra_tipo_pessoa')
      {
          $tra_tipo_pessoa = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_tra_tipo_pessoa($tra_tipo_pessoa);
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
      if ($this->NM_ajax_opcao == 'autocomp_tra_tipo')
      {
          $tra_tipo = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_tra_tipo($tra_tipo);
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
      if ($this->NM_ajax_opcao == 'autocomp_tra_status')
      {
          $tra_status = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_tra_status($tra_status);
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
      if ($this->NM_ajax_opcao == 'autocomp_tra_direcao')
      {
          $tra_direcao = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_tra_direcao($tra_direcao);
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
      if ($this->NM_ajax_opcao == 'autocomp_tra_numvoo_ida')
      {
          $tra_numvoo_ida = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_tra_numvoo_ida($tra_numvoo_ida);
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
      if ($this->NM_ajax_opcao == 'autocomp_tra_localizador_ida')
      {
          $tra_localizador_ida = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_tra_localizador_ida($tra_localizador_ida);
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
      if ($this->NM_ajax_opcao == 'autocomp_tra_eticket_ida')
      {
          $tra_eticket_ida = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_tra_eticket_ida($tra_eticket_ida);
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
      if ($this->NM_ajax_opcao == 'autocomp_tra_numvoo_volta')
      {
          $tra_numvoo_volta = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_tra_numvoo_volta($tra_numvoo_volta);
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
      if ($this->NM_ajax_opcao == 'autocomp_tra_localizador_volta')
      {
          $tra_localizador_volta = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_tra_localizador_volta($tra_localizador_volta);
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
      if ($this->NM_ajax_opcao == 'autocomp_tra_eticket_volta')
      {
          $tra_eticket_volta = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_tra_eticket_volta($tra_eticket_volta);
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
   function lookup_ajax_tra_cpf_particip($tra_cpf_particip)
   {
      $tra_cpf_particip = substr($this->Db->qstr($tra_cpf_particip), 1, -1);
            $tra_cpf_particip_look = (is_string($tra_cpf_particip) ? substr($this->Db->qstr($tra_cpf_particip), 1, -1) : $tra_cpf_particip); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_cpf_particip from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and  #lowerI#tra_cpf_particip#lowerF# like #lowerI#'%" . $tra_cpf_particip . "%'#lowerF# order by tra_cpf_particip"; 
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
   
   function lookup_ajax_tra_tipo_pessoa($tra_tipo_pessoa)
   {
      $tra_tipo_pessoa = substr($this->Db->qstr($tra_tipo_pessoa), 1, -1);
            $tra_tipo_pessoa_look = (is_string($tra_tipo_pessoa) ? substr($this->Db->qstr($tra_tipo_pessoa), 1, -1) : $tra_tipo_pessoa); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_tipo_pessoa from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and  #lowerI#tra_tipo_pessoa#lowerF# like #lowerI#'%" . $tra_tipo_pessoa . "%'#lowerF# order by tra_tipo_pessoa"; 
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
   
   function lookup_ajax_tra_tipo($tra_tipo)
   {
      $tra_tipo = substr($this->Db->qstr($tra_tipo), 1, -1);
            $tra_tipo_look = (is_string($tra_tipo) ? substr($this->Db->qstr($tra_tipo), 1, -1) : $tra_tipo); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_tipo from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and  #lowerI#tra_tipo#lowerF# like #lowerI#'%" . $tra_tipo . "%'#lowerF# order by tra_tipo"; 
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
   
   function lookup_ajax_tra_status($tra_status)
   {
      $tra_status = substr($this->Db->qstr($tra_status), 1, -1);
            $tra_status_look = (is_string($tra_status) ? substr($this->Db->qstr($tra_status), 1, -1) : $tra_status); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_status from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and  #lowerI#tra_status#lowerF# like #lowerI#'%" . $tra_status . "%'#lowerF# order by tra_status"; 
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
   
   function lookup_ajax_tra_direcao($tra_direcao)
   {
      $tra_direcao = substr($this->Db->qstr($tra_direcao), 1, -1);
            $tra_direcao_look = (is_string($tra_direcao) ? substr($this->Db->qstr($tra_direcao), 1, -1) : $tra_direcao); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_direcao from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and  #lowerI#tra_direcao#lowerF# like #lowerI#'%" . $tra_direcao . "%'#lowerF# order by tra_direcao"; 
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
   
   function lookup_ajax_tra_numvoo_ida($tra_numvoo_ida)
   {
      $tra_numvoo_ida = substr($this->Db->qstr($tra_numvoo_ida), 1, -1);
            $tra_numvoo_ida_look = (is_string($tra_numvoo_ida) ? substr($this->Db->qstr($tra_numvoo_ida), 1, -1) : $tra_numvoo_ida); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_numvoo_ida from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and  #lowerI#tra_numvoo_ida#lowerF# like #lowerI#'%" . $tra_numvoo_ida . "%'#lowerF# order by tra_numvoo_ida"; 
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
   
   function lookup_ajax_tra_localizador_ida($tra_localizador_ida)
   {
      $tra_localizador_ida = substr($this->Db->qstr($tra_localizador_ida), 1, -1);
            $tra_localizador_ida_look = (is_string($tra_localizador_ida) ? substr($this->Db->qstr($tra_localizador_ida), 1, -1) : $tra_localizador_ida); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_localizador_ida from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and  #lowerI#tra_localizador_ida#lowerF# like #lowerI#'%" . $tra_localizador_ida . "%'#lowerF# order by tra_localizador_ida"; 
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
   
   function lookup_ajax_tra_eticket_ida($tra_eticket_ida)
   {
      $tra_eticket_ida = substr($this->Db->qstr($tra_eticket_ida), 1, -1);
            $tra_eticket_ida_look = (is_string($tra_eticket_ida) ? substr($this->Db->qstr($tra_eticket_ida), 1, -1) : $tra_eticket_ida); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_eticket_ida from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and  #lowerI#tra_eticket_ida#lowerF# like #lowerI#'%" . $tra_eticket_ida . "%'#lowerF# order by tra_eticket_ida"; 
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
   
   function lookup_ajax_tra_numvoo_volta($tra_numvoo_volta)
   {
      $tra_numvoo_volta = substr($this->Db->qstr($tra_numvoo_volta), 1, -1);
            $tra_numvoo_volta_look = (is_string($tra_numvoo_volta) ? substr($this->Db->qstr($tra_numvoo_volta), 1, -1) : $tra_numvoo_volta); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_numvoo_volta from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and  #lowerI#tra_numvoo_volta#lowerF# like #lowerI#'%" . $tra_numvoo_volta . "%'#lowerF# order by tra_numvoo_volta"; 
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
   
   function lookup_ajax_tra_localizador_volta($tra_localizador_volta)
   {
      $tra_localizador_volta = substr($this->Db->qstr($tra_localizador_volta), 1, -1);
            $tra_localizador_volta_look = (is_string($tra_localizador_volta) ? substr($this->Db->qstr($tra_localizador_volta), 1, -1) : $tra_localizador_volta); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_localizador_volta from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and  #lowerI#tra_localizador_volta#lowerF# like #lowerI#'%" . $tra_localizador_volta . "%'#lowerF# order by tra_localizador_volta"; 
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
   
   function lookup_ajax_tra_eticket_volta($tra_eticket_volta)
   {
      $tra_eticket_volta = substr($this->Db->qstr($tra_eticket_volta), 1, -1);
            $tra_eticket_volta_look = (is_string($tra_eticket_volta) ? substr($this->Db->qstr($tra_eticket_volta), 1, -1) : $tra_eticket_volta); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_eticket_volta from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and  #lowerI#tra_eticket_volta#lowerF# like #lowerI#'%" . $tra_eticket_volta . "%'#lowerF# order by tra_eticket_volta"; 
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
      $Nm_datas[] = 'tra_dt_saida_ida';$Nm_datas[] = 'tra_hr_saida_ida';$Nm_datas[] = 'tra_dt_chegada_ida';$Nm_datas[] = 'tra_hr_chegada_ida';$Nm_datas[] = 'tra_dt_saida_volta';$Nm_datas[] = 'tra_hr_saida_volta';$Nm_datas[] = 'tra_dt_chegada_volta';$Nm_datas[] = 'tra_hr_chegada_volta';$Nm_datas[] = 'tra_dt_chegada_proprio';$Nm_datas[] = 'tra_hr_chegada_proprio';$Nm_datas[] = 'tra_dt_ida_local';$Nm_datas[] = 'tra_hr_ida_local';$Nm_datas[] = 'tra_dt_volta_local';$Nm_datas[] = 'tra_hr_volta_local';$Nm_datas[] = 'tra_hrtransout';$Nm_numeric[] = "id_transfer";$Nm_numeric[] = "tra_id_evento";$Nm_numeric[] = "tra_id_aereo";$Nm_numeric[] = "tra_id_bloqueio";$Nm_numeric[] = "tra_id_usuario";$Nm_numeric[] = "tra_id_hotel";$Nm_numeric[] = "tra_cia_ida";$Nm_numeric[] = "tra_bloqueio_ida";$Nm_numeric[] = "tra_bloqueio_volta";$Nm_numeric[] = "tra_ult_trecho_volta";$Nm_numeric[] = "tra_id_aereo_volta";$Nm_numeric[] = "tra_transfer_trecho";$Nm_numeric[] = "tra_id_hotel_out";
      $campo_join = strtolower(str_replace(".", "_", $nome));
      if (in_array($campo_join, $Nm_numeric))
      {
          if ($condicao == "EP" || $condicao == "NE")
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$campo_join]);
              return;
          }
         $nm_ini_lower = "";
         $nm_fim_lower = "";
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['decimal_db'] == ".")
         {
            $nm_aspas  = "";
            $nm_aspas1 = "";
         }
         if ($condicao != "IN")
         {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['decimal_db'] == ".")
            {
               $campo  = str_replace(",", ".", $campo);
               $campo2 = str_replace(",", ".", $campo2);
            }
         }
      }
      $Nm_datas[] = 'tra_dt_saida_ida';$Nm_datas[] = 'tra_hr_saida_ida';$Nm_datas[] = 'tra_dt_chegada_ida';$Nm_datas[] = 'tra_hr_chegada_ida';$Nm_datas[] = 'tra_dt_saida_volta';$Nm_datas[] = 'tra_hr_saida_volta';$Nm_datas[] = 'tra_dt_chegada_volta';$Nm_datas[] = 'tra_hr_chegada_volta';$Nm_datas[] = 'tra_dt_chegada_proprio';$Nm_datas[] = 'tra_hr_chegada_proprio';$Nm_datas[] = 'tra_dt_ida_local';$Nm_datas[] = 'tra_hr_ida_local';$Nm_datas[] = 'tra_dt_volta_local';$Nm_datas[] = 'tra_hr_volta_local';$Nm_datas[] = 'tra_hrtransout';
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
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['SC_sep_date']))
          {
              $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['SC_sep_date'];
              $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['SC_sep_date1'];
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
         $nome_sum = "transfer_rsvp.$nome";
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
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_equl'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $this->cmp_formatado[$nome_campo];
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
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $lang_like . " (" . str_replace(" ",$Conect_msg,$this->cmp_formatado[$nome_campo]) . ")##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $lang_like . " (" . str_replace(" ",$Conect_msg,$this->cmp_formatado[$nome_campo]) . ")";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['hint']  = $nmgp_tab_label[$nome_campo] . ": " . $lang_like . " (" . str_replace(" ",$Conect_msg,$this->cmp_formatado[$nome_campo]) . ")";
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
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_strt'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_strt'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_strt'] . " " . $this->cmp_formatado[$nome_campo];
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
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . ":</span> " . str_replace(array("##ini##","##fim##"), array("<span class='scGridFilterDynValue'>","</span>"),$NM_cond) . "##*@@";
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
                       $NM_cond = str_replace(array("##ini##","##fim##"), array("",""),$NM_cond);
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $NM_cond;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $NM_cond;
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
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $lang_like . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $lang_like . " " . $this->cmp_formatado[$nome_campo];
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $lang_like . " " . $this->cmp_formatado[$nome_campo];
               }
            break;
            case "DF":     // 
               $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_diff'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_diff'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_diff'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "GT":     // 
               $this->comando        .= " $nome > " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum > " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome > " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_grtr'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "GE":     // 
               $this->comando        .= " $nome >= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum >= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome >= " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "LT":     // 
               $this->comando        .= " $nome < " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum < " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome < " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_less'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "LE":     // 
               $this->comando        .= " $nome <= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum <= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome <= " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_less_equl'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less_equl'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less_equl'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "BW":     // 
               $this->comando        .= " $nome between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $this->comando_filtro .= " $nome between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_betw'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo] . " </span>" . $this->Ini->Nm_lang['lang_srch_and_cond'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo . "_input_2"] . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_betw'] . " " . $this->cmp_formatado[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " " . $this->cmp_formatado[$nome_campo . "_input_2"];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_betw'] . " " . $this->cmp_formatado[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " " . $this->cmp_formatado[$nome_campo . "_input_2"];
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
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_equl'] . " <span class='scGridFilterDynValue'>" . $nm_cond . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $cond_descr;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $nm_cond;
            break;
            case "NU":     // 
               $this->comando        .= " $nome IS NULL ";
               $this->comando_sum    .= " $nome_sum IS NULL ";
               $this->comando_filtro .= " $nome IS NULL ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_null'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_null'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_null'];
            break;
            case "NN":     // 
               $this->comando        .= " $nome IS NOT NULL ";
               $this->comando_sum    .= " $nome_sum IS NOT NULL ";
               $this->comando_filtro .= " $nome IS NOT NULL ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_nnul'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nnul'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nnul'];
            break;
            case "EP":     // 
               $this->comando        .= " $nome = '' ";
               $this->comando_sum    .= " $nome_sum = '' ";
               $this->comando_filtro .= " $nome = '' ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_empty'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_empty'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_empty'];
            break;
            case "NE":     // 
               $this->comando        .= " $nome <> '' ";
               $this->comando_sum    .= " $nome_sum <> '' ";
               $this->comando_filtro .= " $nome <> '' ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_nempty'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nempty'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nempty'];
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
 <TITLE>BRSVP - Transfer</TITLE>
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
 <TITLE>BRSVP - Transfer</TITLE>
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
          <?php 
           if ($_SESSION['scriptcase']['proc_mobile']) {  
               $forced_mobile = (isset($_SESSION['scriptcase']['force_mobile']) && $_SESSION['scriptcase']['force_mobile']) ? 'true' : 'false';
               $sc_app_data = json_encode([ 
                   'forceMobile' => $forced_mobile, 
                   'appType' => 'search', 
                   'improvements' => true, 
                   'displayOptionsButton' => false, 
                   'displayScrollUp' => true, 
                   'bottomToolbarFixed' => true, 
                   'mobileSimpleToolbar' => false, 
                   'scrollUpPosition' => 'A', 
                   'toolbarOrientation' => 'H', 
                   'mobilePanes' => 'true', 
                   'navigationBarButtons' => unserialize('a:0:{}'), 
                   'langs' => [ 
                       'lang_refined_search' => html_entity_decode($this->Ini->Nm_lang['lang_refined_search'], ENT_COMPAT, $_SESSION['scriptcase']['charset']), 
                       'lang_summary_search_button' => html_entity_decode($this->Ini->Nm_lang['lang_summary_search_button'], ENT_COMPAT, $_SESSION['scriptcase']['charset']), 
                       'lang_details_button' => html_entity_decode($this->Ini->Nm_lang['lang_details_button'], ENT_COMPAT, $_SESSION['scriptcase']['charset']), 
                   ], 
               ]); ?> 
        <input type="hidden" id="sc-mobile-app-data" value='<?php echo $sc_app_data; ?>' />
        <script type="text/javascript" src="../_lib/lib/js/nm_modal_panes.jquery.js"></script>
        <script type="text/javascript" src="../_lib/lib/js/nm_mobile.js"></script>
        <link rel='stylesheet' href='../_lib/lib/css/nm_mobile.css' type='text/css'/>
    <script>
        $(document).ready(function(){
            bootstrapMobile();
        });
    </script>          <?php } ?>
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>grid_transfer_rsvp/grid_transfer_rsvp_fil_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />
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
 <script type="text/javascript" src="grid_transfer_rsvp_ajax_search.js"></script>
 <script type="text/javascript" src="grid_transfer_rsvp_ajax.js"></script>
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
<script type="text/javascript" src="grid_transfer_rsvp_message.js"></script>
<link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_sweetalert.css" />
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['grid_transfer_rsvp']['glo_nm_path_prod']; ?>/third/sweetalert/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['grid_transfer_rsvp']['glo_nm_path_prod']; ?>/third/sweetalert/polyfill.min.js"></script>
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
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['ajax_nav'])
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
<script type="text/javascript" src="grid_transfer_rsvp_message.js"></script>
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
  str_out += 'SC_tra_cpf_particip_cond#NMF#' + search_get_sel_txt('SC_tra_cpf_particip_cond') + '@NMF@';
  str_out += 'SC_tra_cpf_particip#NMF#' + search_get_text('SC_tra_cpf_particip') + '@NMF@';
  str_out += 'id_ac_tra_cpf_particip#NMF#' + search_get_text('id_ac_tra_cpf_particip') + '@NMF@';
  str_out += 'SC_tra_tipo_pessoa_cond#NMF#' + search_get_sel_txt('SC_tra_tipo_pessoa_cond') + '@NMF@';
  str_out += 'SC_tra_tipo_pessoa#NMF#' + search_get_text('SC_tra_tipo_pessoa') + '@NMF@';
  str_out += 'id_ac_tra_tipo_pessoa#NMF#' + search_get_text('id_ac_tra_tipo_pessoa') + '@NMF@';
  str_out += 'SC_tra_tipo_cond#NMF#' + search_get_sel_txt('SC_tra_tipo_cond') + '@NMF@';
  str_out += 'SC_tra_tipo#NMF#' + search_get_text('SC_tra_tipo') + '@NMF@';
  str_out += 'id_ac_tra_tipo#NMF#' + search_get_text('id_ac_tra_tipo') + '@NMF@';
  str_out += 'SC_tra_status_cond#NMF#' + search_get_sel_txt('SC_tra_status_cond') + '@NMF@';
  str_out += 'SC_tra_status#NMF#' + search_get_text('SC_tra_status') + '@NMF@';
  str_out += 'id_ac_tra_status#NMF#' + search_get_text('id_ac_tra_status') + '@NMF@';
  str_out += 'SC_tra_direcao_cond#NMF#' + search_get_sel_txt('SC_tra_direcao_cond') + '@NMF@';
  str_out += 'SC_tra_direcao#NMF#' + search_get_text('SC_tra_direcao') + '@NMF@';
  str_out += 'id_ac_tra_direcao#NMF#' + search_get_text('id_ac_tra_direcao') + '@NMF@';
  str_out += 'SC_tra_numvoo_ida_cond#NMF#' + search_get_sel_txt('SC_tra_numvoo_ida_cond') + '@NMF@';
  str_out += 'SC_tra_numvoo_ida#NMF#' + search_get_text('SC_tra_numvoo_ida') + '@NMF@';
  str_out += 'id_ac_tra_numvoo_ida#NMF#' + search_get_text('id_ac_tra_numvoo_ida') + '@NMF@';
  str_out += 'SC_tra_dt_saida_ida_cond#NMF#' + search_get_sel_txt('SC_tra_dt_saida_ida_cond') + '@NMF@';
  str_out += 'SC_tra_dt_saida_ida_dia#NMF#' + search_get_sel_txt('SC_tra_dt_saida_ida_dia') + '@NMF@';
  str_out += 'SC_tra_dt_saida_ida_mes#NMF#' + search_get_sel_txt('SC_tra_dt_saida_ida_mes') + '@NMF@';
  str_out += 'SC_tra_dt_saida_ida_ano#NMF#' + search_get_sel_txt('SC_tra_dt_saida_ida_ano') + '@NMF@';
  str_out += 'SC_tra_dt_saida_ida_input_2_dia#NMF#' + search_get_sel_txt('SC_tra_dt_saida_ida_input_2_dia') + '@NMF@';
  str_out += 'SC_tra_dt_saida_ida_input_2_mes#NMF#' + search_get_sel_txt('SC_tra_dt_saida_ida_input_2_mes') + '@NMF@';
  str_out += 'SC_tra_dt_saida_ida_input_2_ano#NMF#' + search_get_sel_txt('SC_tra_dt_saida_ida_input_2_ano') + '@NMF@';
  str_out += 'SC_tra_dt_chegada_ida_cond#NMF#' + search_get_sel_txt('SC_tra_dt_chegada_ida_cond') + '@NMF@';
  str_out += 'SC_tra_dt_chegada_ida_dia#NMF#' + search_get_sel_txt('SC_tra_dt_chegada_ida_dia') + '@NMF@';
  str_out += 'SC_tra_dt_chegada_ida_mes#NMF#' + search_get_sel_txt('SC_tra_dt_chegada_ida_mes') + '@NMF@';
  str_out += 'SC_tra_dt_chegada_ida_ano#NMF#' + search_get_sel_txt('SC_tra_dt_chegada_ida_ano') + '@NMF@';
  str_out += 'SC_tra_dt_chegada_ida_input_2_dia#NMF#' + search_get_sel_txt('SC_tra_dt_chegada_ida_input_2_dia') + '@NMF@';
  str_out += 'SC_tra_dt_chegada_ida_input_2_mes#NMF#' + search_get_sel_txt('SC_tra_dt_chegada_ida_input_2_mes') + '@NMF@';
  str_out += 'SC_tra_dt_chegada_ida_input_2_ano#NMF#' + search_get_sel_txt('SC_tra_dt_chegada_ida_input_2_ano') + '@NMF@';
  str_out += 'SC_tra_localizador_ida_cond#NMF#' + search_get_sel_txt('SC_tra_localizador_ida_cond') + '@NMF@';
  str_out += 'SC_tra_localizador_ida#NMF#' + search_get_text('SC_tra_localizador_ida') + '@NMF@';
  str_out += 'id_ac_tra_localizador_ida#NMF#' + search_get_text('id_ac_tra_localizador_ida') + '@NMF@';
  str_out += 'SC_tra_eticket_ida_cond#NMF#' + search_get_sel_txt('SC_tra_eticket_ida_cond') + '@NMF@';
  str_out += 'SC_tra_eticket_ida#NMF#' + search_get_text('SC_tra_eticket_ida') + '@NMF@';
  str_out += 'id_ac_tra_eticket_ida#NMF#' + search_get_text('id_ac_tra_eticket_ida') + '@NMF@';
  str_out += 'SC_tra_numvoo_volta_cond#NMF#' + search_get_sel_txt('SC_tra_numvoo_volta_cond') + '@NMF@';
  str_out += 'SC_tra_numvoo_volta#NMF#' + search_get_text('SC_tra_numvoo_volta') + '@NMF@';
  str_out += 'id_ac_tra_numvoo_volta#NMF#' + search_get_text('id_ac_tra_numvoo_volta') + '@NMF@';
  str_out += 'SC_tra_dt_saida_volta_cond#NMF#' + search_get_sel_txt('SC_tra_dt_saida_volta_cond') + '@NMF@';
  str_out += 'SC_tra_dt_saida_volta_dia#NMF#' + search_get_sel_txt('SC_tra_dt_saida_volta_dia') + '@NMF@';
  str_out += 'SC_tra_dt_saida_volta_mes#NMF#' + search_get_sel_txt('SC_tra_dt_saida_volta_mes') + '@NMF@';
  str_out += 'SC_tra_dt_saida_volta_ano#NMF#' + search_get_sel_txt('SC_tra_dt_saida_volta_ano') + '@NMF@';
  str_out += 'SC_tra_dt_saida_volta_input_2_dia#NMF#' + search_get_sel_txt('SC_tra_dt_saida_volta_input_2_dia') + '@NMF@';
  str_out += 'SC_tra_dt_saida_volta_input_2_mes#NMF#' + search_get_sel_txt('SC_tra_dt_saida_volta_input_2_mes') + '@NMF@';
  str_out += 'SC_tra_dt_saida_volta_input_2_ano#NMF#' + search_get_sel_txt('SC_tra_dt_saida_volta_input_2_ano') + '@NMF@';
  str_out += 'SC_tra_dt_chegada_volta_cond#NMF#' + search_get_sel_txt('SC_tra_dt_chegada_volta_cond') + '@NMF@';
  str_out += 'SC_tra_dt_chegada_volta_dia#NMF#' + search_get_sel_txt('SC_tra_dt_chegada_volta_dia') + '@NMF@';
  str_out += 'SC_tra_dt_chegada_volta_mes#NMF#' + search_get_sel_txt('SC_tra_dt_chegada_volta_mes') + '@NMF@';
  str_out += 'SC_tra_dt_chegada_volta_ano#NMF#' + search_get_sel_txt('SC_tra_dt_chegada_volta_ano') + '@NMF@';
  str_out += 'SC_tra_dt_chegada_volta_input_2_dia#NMF#' + search_get_sel_txt('SC_tra_dt_chegada_volta_input_2_dia') + '@NMF@';
  str_out += 'SC_tra_dt_chegada_volta_input_2_mes#NMF#' + search_get_sel_txt('SC_tra_dt_chegada_volta_input_2_mes') + '@NMF@';
  str_out += 'SC_tra_dt_chegada_volta_input_2_ano#NMF#' + search_get_sel_txt('SC_tra_dt_chegada_volta_input_2_ano') + '@NMF@';
  str_out += 'SC_tra_localizador_volta_cond#NMF#' + search_get_sel_txt('SC_tra_localizador_volta_cond') + '@NMF@';
  str_out += 'SC_tra_localizador_volta#NMF#' + search_get_text('SC_tra_localizador_volta') + '@NMF@';
  str_out += 'id_ac_tra_localizador_volta#NMF#' + search_get_text('id_ac_tra_localizador_volta') + '@NMF@';
  str_out += 'SC_tra_eticket_volta_cond#NMF#' + search_get_sel_txt('SC_tra_eticket_volta_cond') + '@NMF@';
  str_out += 'SC_tra_eticket_volta#NMF#' + search_get_text('SC_tra_eticket_volta') + '@NMF@';
  str_out += 'id_ac_tra_eticket_volta#NMF#' + search_get_text('id_ac_tra_eticket_volta') + '@NMF@';
  str_out += 'SC_tra_dt_chegada_proprio_cond#NMF#' + search_get_sel_txt('SC_tra_dt_chegada_proprio_cond') + '@NMF@';
  str_out += 'SC_tra_dt_chegada_proprio_dia#NMF#' + search_get_sel_txt('SC_tra_dt_chegada_proprio_dia') + '@NMF@';
  str_out += 'SC_tra_dt_chegada_proprio_mes#NMF#' + search_get_sel_txt('SC_tra_dt_chegada_proprio_mes') + '@NMF@';
  str_out += 'SC_tra_dt_chegada_proprio_ano#NMF#' + search_get_sel_txt('SC_tra_dt_chegada_proprio_ano') + '@NMF@';
  str_out += 'SC_tra_dt_chegada_proprio_input_2_dia#NMF#' + search_get_sel_txt('SC_tra_dt_chegada_proprio_input_2_dia') + '@NMF@';
  str_out += 'SC_tra_dt_chegada_proprio_input_2_mes#NMF#' + search_get_sel_txt('SC_tra_dt_chegada_proprio_input_2_mes') + '@NMF@';
  str_out += 'SC_tra_dt_chegada_proprio_input_2_ano#NMF#' + search_get_sel_txt('SC_tra_dt_chegada_proprio_input_2_ano') + '@NMF@';
  str_out += 'SC_tra_hr_chegada_proprio_cond#NMF#' + search_get_sel_txt('SC_tra_hr_chegada_proprio_cond') + '@NMF@';
  str_out += 'SC_tra_hr_chegada_proprio_hor#NMF#' + search_get_sel_txt('SC_tra_hr_chegada_proprio_hor') + '@NMF@';
  str_out += 'SC_tra_hr_chegada_proprio_min#NMF#' + search_get_sel_txt('SC_tra_hr_chegada_proprio_min') + '@NMF@';
  str_out += 'SC_tra_hr_chegada_proprio_seg#NMF#' + search_get_sel_txt('SC_tra_hr_chegada_proprio_seg') + '@NMF@';
  str_out += 'SC_tra_hr_chegada_proprio_input_2_hor#NMF#' + search_get_sel_txt('SC_tra_hr_chegada_proprio_input_2_hor') + '@NMF@';
  str_out += 'SC_tra_hr_chegada_proprio_input_2_min#NMF#' + search_get_sel_txt('SC_tra_hr_chegada_proprio_input_2_min') + '@NMF@';
  str_out += 'SC_tra_hr_chegada_proprio_input_2_seg#NMF#' + search_get_sel_txt('SC_tra_hr_chegada_proprio_input_2_seg') + '@NMF@';
  str_out += 'SC_tra_hr_volta_local_cond#NMF#' + search_get_sel_txt('SC_tra_hr_volta_local_cond') + '@NMF@';
  str_out += 'SC_tra_hr_volta_local_hor#NMF#' + search_get_sel_txt('SC_tra_hr_volta_local_hor') + '@NMF@';
  str_out += 'SC_tra_hr_volta_local_min#NMF#' + search_get_sel_txt('SC_tra_hr_volta_local_min') + '@NMF@';
  str_out += 'SC_tra_hr_volta_local_seg#NMF#' + search_get_sel_txt('SC_tra_hr_volta_local_seg') + '@NMF@';
  str_out += 'SC_tra_hr_volta_local_input_2_hor#NMF#' + search_get_sel_txt('SC_tra_hr_volta_local_input_2_hor') + '@NMF@';
  str_out += 'SC_tra_hr_volta_local_input_2_min#NMF#' + search_get_sel_txt('SC_tra_hr_volta_local_input_2_min') + '@NMF@';
  str_out += 'SC_tra_hr_volta_local_input_2_seg#NMF#' + search_get_sel_txt('SC_tra_hr_volta_local_input_2_seg') + '@NMF@';
  str_out += 'SC_tra_dt_volta_local_cond#NMF#' + search_get_sel_txt('SC_tra_dt_volta_local_cond') + '@NMF@';
  str_out += 'SC_tra_dt_volta_local_dia#NMF#' + search_get_sel_txt('SC_tra_dt_volta_local_dia') + '@NMF@';
  str_out += 'SC_tra_dt_volta_local_mes#NMF#' + search_get_sel_txt('SC_tra_dt_volta_local_mes') + '@NMF@';
  str_out += 'SC_tra_dt_volta_local_ano#NMF#' + search_get_sel_txt('SC_tra_dt_volta_local_ano') + '@NMF@';
  str_out += 'SC_tra_dt_volta_local_input_2_dia#NMF#' + search_get_sel_txt('SC_tra_dt_volta_local_input_2_dia') + '@NMF@';
  str_out += 'SC_tra_dt_volta_local_input_2_mes#NMF#' + search_get_sel_txt('SC_tra_dt_volta_local_input_2_mes') + '@NMF@';
  str_out += 'SC_tra_dt_volta_local_input_2_ano#NMF#' + search_get_sel_txt('SC_tra_dt_volta_local_input_2_ano') + '@NMF@';
  str_out += 'SC_tra_hr_ida_local_cond#NMF#' + search_get_sel_txt('SC_tra_hr_ida_local_cond') + '@NMF@';
  str_out += 'SC_tra_hr_ida_local_hor#NMF#' + search_get_sel_txt('SC_tra_hr_ida_local_hor') + '@NMF@';
  str_out += 'SC_tra_hr_ida_local_min#NMF#' + search_get_sel_txt('SC_tra_hr_ida_local_min') + '@NMF@';
  str_out += 'SC_tra_hr_ida_local_seg#NMF#' + search_get_sel_txt('SC_tra_hr_ida_local_seg') + '@NMF@';
  str_out += 'SC_tra_hr_ida_local_input_2_hor#NMF#' + search_get_sel_txt('SC_tra_hr_ida_local_input_2_hor') + '@NMF@';
  str_out += 'SC_tra_hr_ida_local_input_2_min#NMF#' + search_get_sel_txt('SC_tra_hr_ida_local_input_2_min') + '@NMF@';
  str_out += 'SC_tra_hr_ida_local_input_2_seg#NMF#' + search_get_sel_txt('SC_tra_hr_ida_local_input_2_seg') + '@NMF@';
  str_out += 'SC_tra_dt_ida_local_cond#NMF#' + search_get_sel_txt('SC_tra_dt_ida_local_cond') + '@NMF@';
  str_out += 'SC_tra_dt_ida_local_dia#NMF#' + search_get_sel_txt('SC_tra_dt_ida_local_dia') + '@NMF@';
  str_out += 'SC_tra_dt_ida_local_mes#NMF#' + search_get_sel_txt('SC_tra_dt_ida_local_mes') + '@NMF@';
  str_out += 'SC_tra_dt_ida_local_ano#NMF#' + search_get_sel_txt('SC_tra_dt_ida_local_ano') + '@NMF@';
  str_out += 'SC_tra_dt_ida_local_input_2_dia#NMF#' + search_get_sel_txt('SC_tra_dt_ida_local_input_2_dia') + '@NMF@';
  str_out += 'SC_tra_dt_ida_local_input_2_mes#NMF#' + search_get_sel_txt('SC_tra_dt_ida_local_input_2_mes') + '@NMF@';
  str_out += 'SC_tra_dt_ida_local_input_2_ano#NMF#' + search_get_sel_txt('SC_tra_dt_ida_local_input_2_ano') + '@NMF@';
  str_out += 'SC_id_transfer_cond#NMF#' + search_get_sel_txt('SC_id_transfer_cond') + '@NMF@';
  str_out += 'SC_id_transfer#NMF#' + search_get_text('SC_id_transfer') + '@NMF@';
  str_out += 'SC_tra_id_bloqueio_cond#NMF#' + search_get_sel_txt('SC_tra_id_bloqueio_cond') + '@NMF@';
  str_out += 'SC_tra_id_bloqueio#NMF#' + search_get_text('SC_tra_id_bloqueio') + '@NMF@';
  str_out += 'SC_tra_id_evento_cond#NMF#' + search_get_sel_txt('SC_tra_id_evento_cond') + '@NMF@';
  str_out += 'SC_tra_id_evento#NMF#' + search_get_text('SC_tra_id_evento') + '@NMF@';
  str_out += 'SC_tra_id_aereo_cond#NMF#' + search_get_sel_txt('SC_tra_id_aereo_cond') + '@NMF@';
  str_out += 'SC_tra_id_aereo#NMF#' + search_get_text('SC_tra_id_aereo') + '@NMF@';
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
   scClass = $("#id_ac_tra_cpf_particip").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_tra_cpf_particip").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_tra_cpf_particip",
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
       $("#SC_tra_cpf_particip").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_tra_cpf_particip").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_tra_tipo_pessoa").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_tra_tipo_pessoa").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_tra_tipo_pessoa",
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
       $("#SC_tra_tipo_pessoa").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_tra_tipo_pessoa").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_tra_tipo").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_tra_tipo").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_tra_tipo",
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
       $("#SC_tra_tipo").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_tra_tipo").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_tra_status").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_tra_status").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_tra_status",
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
       $("#SC_tra_status").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_tra_status").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_tra_direcao").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_tra_direcao").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_tra_direcao",
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
       $("#SC_tra_direcao").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_tra_direcao").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_tra_numvoo_ida").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_tra_numvoo_ida").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_tra_numvoo_ida",
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
       $("#SC_tra_numvoo_ida").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_tra_numvoo_ida").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_tra_localizador_ida").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_tra_localizador_ida").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_tra_localizador_ida",
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
       $("#SC_tra_localizador_ida").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_tra_localizador_ida").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_tra_eticket_ida").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_tra_eticket_ida").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_tra_eticket_ida",
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
       $("#SC_tra_eticket_ida").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_tra_eticket_ida").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_tra_numvoo_volta").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_tra_numvoo_volta").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_tra_numvoo_volta",
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
       $("#SC_tra_numvoo_volta").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_tra_numvoo_volta").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_tra_localizador_volta").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_tra_localizador_volta").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_tra_localizador_volta",
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
       $("#SC_tra_localizador_volta").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_tra_localizador_volta").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_tra_eticket_volta").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_tra_eticket_volta").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_tra_eticket_volta",
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
       $("#SC_tra_eticket_volta").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_tra_eticket_volta").val( $(this).val() );
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
      if ($this->Ini->Embutida_iframe || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['dashboard_info']['compact_mode'])
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
    <div class="scFilterHeaderFont" style="float: left; text-transform: uppercase;">BRSVP - Transfer</div>
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
             $tra_cpf_particip_cond, $tra_cpf_particip, $tra_cpf_particip_autocomp,
             $tra_tipo_pessoa_cond, $tra_tipo_pessoa, $tra_tipo_pessoa_autocomp,
             $tra_tipo_cond, $tra_tipo, $tra_tipo_autocomp,
             $tra_status_cond, $tra_status, $tra_status_autocomp,
             $tra_direcao_cond, $tra_direcao, $tra_direcao_autocomp,
             $tra_numvoo_ida_cond, $tra_numvoo_ida, $tra_numvoo_ida_autocomp,
             $tra_dt_saida_ida_cond, $tra_dt_saida_ida, $tra_dt_saida_ida_dia, $tra_dt_saida_ida_mes, $tra_dt_saida_ida_ano, $tra_dt_saida_ida_input_2_dia, $tra_dt_saida_ida_input_2_mes, $tra_dt_saida_ida_input_2_ano,
             $tra_dt_chegada_ida_cond, $tra_dt_chegada_ida, $tra_dt_chegada_ida_dia, $tra_dt_chegada_ida_mes, $tra_dt_chegada_ida_ano, $tra_dt_chegada_ida_input_2_dia, $tra_dt_chegada_ida_input_2_mes, $tra_dt_chegada_ida_input_2_ano,
             $tra_localizador_ida_cond, $tra_localizador_ida, $tra_localizador_ida_autocomp,
             $tra_eticket_ida_cond, $tra_eticket_ida, $tra_eticket_ida_autocomp,
             $tra_numvoo_volta_cond, $tra_numvoo_volta, $tra_numvoo_volta_autocomp,
             $tra_dt_saida_volta_cond, $tra_dt_saida_volta, $tra_dt_saida_volta_dia, $tra_dt_saida_volta_mes, $tra_dt_saida_volta_ano, $tra_dt_saida_volta_input_2_dia, $tra_dt_saida_volta_input_2_mes, $tra_dt_saida_volta_input_2_ano,
             $tra_dt_chegada_volta_cond, $tra_dt_chegada_volta, $tra_dt_chegada_volta_dia, $tra_dt_chegada_volta_mes, $tra_dt_chegada_volta_ano, $tra_dt_chegada_volta_input_2_dia, $tra_dt_chegada_volta_input_2_mes, $tra_dt_chegada_volta_input_2_ano,
             $tra_localizador_volta_cond, $tra_localizador_volta, $tra_localizador_volta_autocomp,
             $tra_eticket_volta_cond, $tra_eticket_volta, $tra_eticket_volta_autocomp,
             $tra_dt_chegada_proprio_cond, $tra_dt_chegada_proprio, $tra_dt_chegada_proprio_dia, $tra_dt_chegada_proprio_mes, $tra_dt_chegada_proprio_ano, $tra_dt_chegada_proprio_input_2_dia, $tra_dt_chegada_proprio_input_2_mes, $tra_dt_chegada_proprio_input_2_ano,
             $tra_hr_chegada_proprio_cond, $tra_hr_chegada_proprio, $tra_hr_chegada_proprio_hor, $tra_hr_chegada_proprio_min, $tra_hr_chegada_proprio_seg,
             $tra_hr_volta_local_cond, $tra_hr_volta_local, $tra_hr_volta_local_hor, $tra_hr_volta_local_min, $tra_hr_volta_local_seg,
             $tra_dt_volta_local_cond, $tra_dt_volta_local, $tra_dt_volta_local_dia, $tra_dt_volta_local_mes, $tra_dt_volta_local_ano, $tra_dt_volta_local_input_2_dia, $tra_dt_volta_local_input_2_mes, $tra_dt_volta_local_input_2_ano,
             $tra_hr_ida_local_cond, $tra_hr_ida_local, $tra_hr_ida_local_hor, $tra_hr_ida_local_min, $tra_hr_ida_local_seg,
             $tra_dt_ida_local_cond, $tra_dt_ida_local, $tra_dt_ida_local_dia, $tra_dt_ida_local_mes, $tra_dt_ida_local_ano, $tra_dt_ida_local_input_2_dia, $tra_dt_ida_local_input_2_mes, $tra_dt_ida_local_input_2_ano,
             $id_transfer_cond, $id_transfer,
             $tra_id_bloqueio_cond, $tra_id_bloqueio,
             $tra_id_evento_cond, $tra_id_evento,
             $tra_id_aereo_cond, $tra_id_aereo,
             $nm_url_saida, $nm_apl_dependente, $nmgp_parms, $bprocessa, $nmgp_save_name, $NM_operador, $NM_filters, $nmgp_save_option, $NM_filters_del, $Script_BI;
      $Script_BI = "";
      $this->nmgp_botoes['clear'] = "on";
      $this->nmgp_botoes['save'] = "on";
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_transfer_rsvp']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_transfer_rsvp']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_transfer_rsvp']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("grid_transfer_rsvp", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
      {
          $this->aba_iframe = true;
      }
      $nmgp_tab_label = "";
      $delimitador = "##@@";
      if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']) && $bprocessa != "recarga" && $bprocessa != "save_form" && $bprocessa != "filter_save" && $bprocessa != "filter_delete")
      {
      }
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']) && $bprocessa != "recarga" && $bprocessa != "save_form" && $bprocessa != "filter_save" && $bprocessa != "filter_delete")
      { 
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca'], $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $tra_cpf_particip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_cpf_particip']; 
          $tra_cpf_particip_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_cpf_particip_cond']; 
          $tra_tipo_pessoa = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_tipo_pessoa']; 
          $tra_tipo_pessoa_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_tipo_pessoa_cond']; 
          $tra_tipo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_tipo']; 
          $tra_tipo_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_tipo_cond']; 
          $tra_status = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_status']; 
          $tra_status_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_status_cond']; 
          $tra_direcao = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_direcao']; 
          $tra_direcao_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_direcao_cond']; 
          $tra_numvoo_ida = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_numvoo_ida']; 
          $tra_numvoo_ida_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_numvoo_ida_cond']; 
          $tra_dt_saida_ida_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_ida_dia']; 
          $tra_dt_saida_ida_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_ida_mes']; 
          $tra_dt_saida_ida_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_ida_ano']; 
          $tra_dt_saida_ida_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_ida_input_2_dia']; 
          $tra_dt_saida_ida_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_ida_input_2_mes']; 
          $tra_dt_saida_ida_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_ida_input_2_ano']; 
          $tra_dt_saida_ida_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_ida_cond']; 
          $tra_dt_chegada_ida_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_ida_dia']; 
          $tra_dt_chegada_ida_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_ida_mes']; 
          $tra_dt_chegada_ida_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_ida_ano']; 
          $tra_dt_chegada_ida_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_ida_input_2_dia']; 
          $tra_dt_chegada_ida_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_ida_input_2_mes']; 
          $tra_dt_chegada_ida_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_ida_input_2_ano']; 
          $tra_dt_chegada_ida_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_ida_cond']; 
          $tra_localizador_ida = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_localizador_ida']; 
          $tra_localizador_ida_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_localizador_ida_cond']; 
          $tra_eticket_ida = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_eticket_ida']; 
          $tra_eticket_ida_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_eticket_ida_cond']; 
          $tra_numvoo_volta = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_numvoo_volta']; 
          $tra_numvoo_volta_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_numvoo_volta_cond']; 
          $tra_dt_saida_volta_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_volta_dia']; 
          $tra_dt_saida_volta_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_volta_mes']; 
          $tra_dt_saida_volta_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_volta_ano']; 
          $tra_dt_saida_volta_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_volta_input_2_dia']; 
          $tra_dt_saida_volta_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_volta_input_2_mes']; 
          $tra_dt_saida_volta_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_volta_input_2_ano']; 
          $tra_dt_saida_volta_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_volta_cond']; 
          $tra_dt_chegada_volta_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_volta_dia']; 
          $tra_dt_chegada_volta_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_volta_mes']; 
          $tra_dt_chegada_volta_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_volta_ano']; 
          $tra_dt_chegada_volta_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_volta_input_2_dia']; 
          $tra_dt_chegada_volta_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_volta_input_2_mes']; 
          $tra_dt_chegada_volta_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_volta_input_2_ano']; 
          $tra_dt_chegada_volta_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_volta_cond']; 
          $tra_localizador_volta = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_localizador_volta']; 
          $tra_localizador_volta_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_localizador_volta_cond']; 
          $tra_eticket_volta = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_eticket_volta']; 
          $tra_eticket_volta_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_eticket_volta_cond']; 
          $tra_dt_chegada_proprio_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_proprio_dia']; 
          $tra_dt_chegada_proprio_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_proprio_mes']; 
          $tra_dt_chegada_proprio_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_proprio_ano']; 
          $tra_dt_chegada_proprio_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_proprio_input_2_dia']; 
          $tra_dt_chegada_proprio_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_proprio_input_2_mes']; 
          $tra_dt_chegada_proprio_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_proprio_input_2_ano']; 
          $tra_dt_chegada_proprio_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_proprio_cond']; 
          $tra_hr_chegada_proprio_hor = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_chegada_proprio_hor']; 
          $tra_hr_chegada_proprio_min = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_chegada_proprio_min']; 
          $tra_hr_chegada_proprio_seg = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_chegada_proprio_seg']; 
          $tra_hr_chegada_proprio_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_chegada_proprio_cond']; 
          $tra_hr_volta_local_hor = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_volta_local_hor']; 
          $tra_hr_volta_local_min = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_volta_local_min']; 
          $tra_hr_volta_local_seg = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_volta_local_seg']; 
          $tra_hr_volta_local_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_volta_local_cond']; 
          $tra_dt_volta_local_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_volta_local_dia']; 
          $tra_dt_volta_local_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_volta_local_mes']; 
          $tra_dt_volta_local_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_volta_local_ano']; 
          $tra_dt_volta_local_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_volta_local_input_2_dia']; 
          $tra_dt_volta_local_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_volta_local_input_2_mes']; 
          $tra_dt_volta_local_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_volta_local_input_2_ano']; 
          $tra_dt_volta_local_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_volta_local_cond']; 
          $tra_hr_ida_local_hor = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_ida_local_hor']; 
          $tra_hr_ida_local_min = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_ida_local_min']; 
          $tra_hr_ida_local_seg = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_ida_local_seg']; 
          $tra_hr_ida_local_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_ida_local_cond']; 
          $tra_dt_ida_local_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_ida_local_dia']; 
          $tra_dt_ida_local_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_ida_local_mes']; 
          $tra_dt_ida_local_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_ida_local_ano']; 
          $tra_dt_ida_local_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_ida_local_input_2_dia']; 
          $tra_dt_ida_local_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_ida_local_input_2_mes']; 
          $tra_dt_ida_local_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_ida_local_input_2_ano']; 
          $tra_dt_ida_local_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_ida_local_cond']; 
          $id_transfer = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['id_transfer']; 
          $id_transfer_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['id_transfer_cond']; 
          $tra_id_bloqueio = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_id_bloqueio']; 
          $tra_id_bloqueio_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_id_bloqueio_cond']; 
          $tra_id_evento = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_id_evento']; 
          $tra_id_evento_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_id_evento_cond']; 
          $tra_id_aereo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_id_aereo']; 
          $tra_id_aereo_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_id_aereo_cond']; 
          $this->NM_operador = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['NM_operador']; 
          if (strtoupper($id_transfer_cond) != "II" && strtoupper($id_transfer_cond) != "QP" && strtoupper($id_transfer_cond) != "NP" && strtoupper($id_transfer_cond) != "IN") 
          { 
              nmgp_Form_Num_Val($id_transfer, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          if (strtoupper($tra_id_bloqueio_cond) != "II" && strtoupper($tra_id_bloqueio_cond) != "QP" && strtoupper($tra_id_bloqueio_cond) != "NP" && strtoupper($tra_id_bloqueio_cond) != "IN") 
          { 
              nmgp_Form_Num_Val($tra_id_bloqueio, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          if (strtoupper($tra_id_evento_cond) != "II" && strtoupper($tra_id_evento_cond) != "QP" && strtoupper($tra_id_evento_cond) != "NP" && strtoupper($tra_id_evento_cond) != "IN") 
          { 
              nmgp_Form_Num_Val($tra_id_evento, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          if (strtoupper($tra_id_aereo_cond) != "II" && strtoupper($tra_id_aereo_cond) != "QP" && strtoupper($tra_id_aereo_cond) != "NP" && strtoupper($tra_id_aereo_cond) != "IN") 
          { 
              nmgp_Form_Num_Val($tra_id_aereo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
      } 
      if (!isset($tra_cpf_particip_cond) || empty($tra_cpf_particip_cond))
      {
         $tra_cpf_particip_cond = "qp";
      }
      if (!isset($tra_tipo_pessoa_cond) || empty($tra_tipo_pessoa_cond))
      {
         $tra_tipo_pessoa_cond = "qp";
      }
      if (!isset($tra_tipo_cond) || empty($tra_tipo_cond))
      {
         $tra_tipo_cond = "qp";
      }
      if (!isset($tra_status_cond) || empty($tra_status_cond))
      {
         $tra_status_cond = "qp";
      }
      if (!isset($tra_direcao_cond) || empty($tra_direcao_cond))
      {
         $tra_direcao_cond = "qp";
      }
      if (!isset($tra_numvoo_ida_cond) || empty($tra_numvoo_ida_cond))
      {
         $tra_numvoo_ida_cond = "qp";
      }
      if (!isset($tra_dt_saida_ida_cond) || empty($tra_dt_saida_ida_cond))
      {
         $tra_dt_saida_ida_cond = "eq";
      }
      if (!isset($tra_dt_chegada_ida_cond) || empty($tra_dt_chegada_ida_cond))
      {
         $tra_dt_chegada_ida_cond = "eq";
      }
      if (!isset($tra_localizador_ida_cond) || empty($tra_localizador_ida_cond))
      {
         $tra_localizador_ida_cond = "qp";
      }
      if (!isset($tra_eticket_ida_cond) || empty($tra_eticket_ida_cond))
      {
         $tra_eticket_ida_cond = "qp";
      }
      if (!isset($tra_numvoo_volta_cond) || empty($tra_numvoo_volta_cond))
      {
         $tra_numvoo_volta_cond = "qp";
      }
      if (!isset($tra_dt_saida_volta_cond) || empty($tra_dt_saida_volta_cond))
      {
         $tra_dt_saida_volta_cond = "eq";
      }
      if (!isset($tra_dt_chegada_volta_cond) || empty($tra_dt_chegada_volta_cond))
      {
         $tra_dt_chegada_volta_cond = "eq";
      }
      if (!isset($tra_localizador_volta_cond) || empty($tra_localizador_volta_cond))
      {
         $tra_localizador_volta_cond = "qp";
      }
      if (!isset($tra_eticket_volta_cond) || empty($tra_eticket_volta_cond))
      {
         $tra_eticket_volta_cond = "qp";
      }
      if (!isset($tra_dt_chegada_proprio_cond) || empty($tra_dt_chegada_proprio_cond))
      {
         $tra_dt_chegada_proprio_cond = "eq";
      }
      if (!isset($tra_hr_chegada_proprio_cond) || empty($tra_hr_chegada_proprio_cond))
      {
         $tra_hr_chegada_proprio_cond = "eq";
      }
      if (!isset($tra_hr_volta_local_cond) || empty($tra_hr_volta_local_cond))
      {
         $tra_hr_volta_local_cond = "eq";
      }
      if (!isset($tra_dt_volta_local_cond) || empty($tra_dt_volta_local_cond))
      {
         $tra_dt_volta_local_cond = "eq";
      }
      if (!isset($tra_hr_ida_local_cond) || empty($tra_hr_ida_local_cond))
      {
         $tra_hr_ida_local_cond = "eq";
      }
      if (!isset($tra_dt_ida_local_cond) || empty($tra_dt_ida_local_cond))
      {
         $tra_dt_ida_local_cond = "eq";
      }
      if (!isset($id_transfer_cond) || empty($id_transfer_cond))
      {
         $id_transfer_cond = "gt";
      }
      if (!isset($tra_id_bloqueio_cond) || empty($tra_id_bloqueio_cond))
      {
         $tra_id_bloqueio_cond = "gt";
      }
      if (!isset($tra_id_evento_cond) || empty($tra_id_evento_cond))
      {
         $tra_id_evento_cond = "gt";
      }
      if (!isset($tra_id_aereo_cond) || empty($tra_id_aereo_cond))
      {
         $tra_id_aereo_cond = "gt";
      }
      $display_aberto  = "style=display:";
      $display_fechado = "style=display:none";
      $opc_hide_input = array("nu","nn","ep","ne");
      $str_hide_tra_cpf_particip = (in_array($tra_cpf_particip_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tra_tipo_pessoa = (in_array($tra_tipo_pessoa_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tra_tipo = (in_array($tra_tipo_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tra_status = (in_array($tra_status_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tra_direcao = (in_array($tra_direcao_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tra_numvoo_ida = (in_array($tra_numvoo_ida_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tra_dt_saida_ida = (in_array($tra_dt_saida_ida_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tra_dt_chegada_ida = (in_array($tra_dt_chegada_ida_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tra_localizador_ida = (in_array($tra_localizador_ida_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tra_eticket_ida = (in_array($tra_eticket_ida_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tra_numvoo_volta = (in_array($tra_numvoo_volta_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tra_dt_saida_volta = (in_array($tra_dt_saida_volta_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tra_dt_chegada_volta = (in_array($tra_dt_chegada_volta_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tra_localizador_volta = (in_array($tra_localizador_volta_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tra_eticket_volta = (in_array($tra_eticket_volta_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tra_dt_chegada_proprio = (in_array($tra_dt_chegada_proprio_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tra_hr_chegada_proprio = (in_array($tra_hr_chegada_proprio_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tra_hr_volta_local = (in_array($tra_hr_volta_local_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tra_dt_volta_local = (in_array($tra_dt_volta_local_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tra_hr_ida_local = (in_array($tra_hr_ida_local_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tra_dt_ida_local = (in_array($tra_dt_ida_local_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_id_transfer = (in_array($id_transfer_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tra_id_bloqueio = (in_array($tra_id_bloqueio_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tra_id_evento = (in_array($tra_id_evento_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tra_id_aereo = (in_array($tra_id_aereo_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;

      $str_display_tra_cpf_particip = ('bw' == $tra_cpf_particip_cond) ? $display_aberto : $display_fechado;
      $str_display_tra_tipo_pessoa = ('bw' == $tra_tipo_pessoa_cond) ? $display_aberto : $display_fechado;
      $str_display_tra_tipo = ('bw' == $tra_tipo_cond) ? $display_aberto : $display_fechado;
      $str_display_tra_status = ('bw' == $tra_status_cond) ? $display_aberto : $display_fechado;
      $str_display_tra_direcao = ('bw' == $tra_direcao_cond) ? $display_aberto : $display_fechado;
      $str_display_tra_numvoo_ida = ('bw' == $tra_numvoo_ida_cond) ? $display_aberto : $display_fechado;
      $str_display_tra_dt_saida_ida = ('bw' == $tra_dt_saida_ida_cond) ? $display_aberto : $display_fechado;
      $str_display_tra_dt_chegada_ida = ('bw' == $tra_dt_chegada_ida_cond) ? $display_aberto : $display_fechado;
      $str_display_tra_localizador_ida = ('bw' == $tra_localizador_ida_cond) ? $display_aberto : $display_fechado;
      $str_display_tra_eticket_ida = ('bw' == $tra_eticket_ida_cond) ? $display_aberto : $display_fechado;
      $str_display_tra_numvoo_volta = ('bw' == $tra_numvoo_volta_cond) ? $display_aberto : $display_fechado;
      $str_display_tra_dt_saida_volta = ('bw' == $tra_dt_saida_volta_cond) ? $display_aberto : $display_fechado;
      $str_display_tra_dt_chegada_volta = ('bw' == $tra_dt_chegada_volta_cond) ? $display_aberto : $display_fechado;
      $str_display_tra_localizador_volta = ('bw' == $tra_localizador_volta_cond) ? $display_aberto : $display_fechado;
      $str_display_tra_eticket_volta = ('bw' == $tra_eticket_volta_cond) ? $display_aberto : $display_fechado;
      $str_display_tra_dt_chegada_proprio = ('bw' == $tra_dt_chegada_proprio_cond) ? $display_aberto : $display_fechado;
      $str_display_tra_hr_chegada_proprio = ('bw' == $tra_hr_chegada_proprio_cond) ? $display_aberto : $display_fechado;
      $str_display_tra_hr_volta_local = ('bw' == $tra_hr_volta_local_cond) ? $display_aberto : $display_fechado;
      $str_display_tra_dt_volta_local = ('bw' == $tra_dt_volta_local_cond) ? $display_aberto : $display_fechado;
      $str_display_tra_hr_ida_local = ('bw' == $tra_hr_ida_local_cond) ? $display_aberto : $display_fechado;
      $str_display_tra_dt_ida_local = ('bw' == $tra_dt_ida_local_cond) ? $display_aberto : $display_fechado;
      $str_display_id_transfer = ('bw' == $id_transfer_cond) ? $display_aberto : $display_fechado;
      $str_display_tra_id_bloqueio = ('bw' == $tra_id_bloqueio_cond) ? $display_aberto : $display_fechado;
      $str_display_tra_id_evento = ('bw' == $tra_id_evento_cond) ? $display_aberto : $display_fechado;
      $str_display_tra_id_aereo = ('bw' == $tra_id_aereo_cond) ? $display_aberto : $display_fechado;

      if (!isset($tra_cpf_particip) || $tra_cpf_particip == "")
      {
          $tra_cpf_particip = "";
      }
      if (isset($tra_cpf_particip) && !empty($tra_cpf_particip))
      {
         $tmp_pos = (is_string($tra_cpf_particip)) ? strpos($tra_cpf_particip, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $tra_cpf_particip = substr($tra_cpf_particip, 0, $tmp_pos);
         }
      }
      if (!isset($tra_tipo_pessoa) || $tra_tipo_pessoa == "")
      {
          $tra_tipo_pessoa = "";
      }
      if (isset($tra_tipo_pessoa) && !empty($tra_tipo_pessoa))
      {
         $tmp_pos = (is_string($tra_tipo_pessoa)) ? strpos($tra_tipo_pessoa, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $tra_tipo_pessoa = substr($tra_tipo_pessoa, 0, $tmp_pos);
         }
      }
      if (!isset($tra_tipo) || $tra_tipo == "")
      {
          $tra_tipo = "";
      }
      if (isset($tra_tipo) && !empty($tra_tipo))
      {
         $tmp_pos = (is_string($tra_tipo)) ? strpos($tra_tipo, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $tra_tipo = substr($tra_tipo, 0, $tmp_pos);
         }
      }
      if (!isset($tra_status) || $tra_status == "")
      {
          $tra_status = "";
      }
      if (isset($tra_status) && !empty($tra_status))
      {
         $tmp_pos = (is_string($tra_status)) ? strpos($tra_status, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $tra_status = substr($tra_status, 0, $tmp_pos);
         }
      }
      if (!isset($tra_direcao) || $tra_direcao == "")
      {
          $tra_direcao = "";
      }
      if (isset($tra_direcao) && !empty($tra_direcao))
      {
         $tmp_pos = (is_string($tra_direcao)) ? strpos($tra_direcao, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $tra_direcao = substr($tra_direcao, 0, $tmp_pos);
         }
      }
      if (!isset($tra_numvoo_ida) || $tra_numvoo_ida == "")
      {
          $tra_numvoo_ida = "";
      }
      if (isset($tra_numvoo_ida) && !empty($tra_numvoo_ida))
      {
         $tmp_pos = (is_string($tra_numvoo_ida)) ? strpos($tra_numvoo_ida, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $tra_numvoo_ida = substr($tra_numvoo_ida, 0, $tmp_pos);
         }
      }
      if (!isset($tra_dt_saida_ida) || $tra_dt_saida_ida == "")
      {
          $tra_dt_saida_ida = "";
      }
      if (isset($tra_dt_saida_ida) && !empty($tra_dt_saida_ida))
      {
         $tmp_pos = (is_string($tra_dt_saida_ida)) ? strpos($tra_dt_saida_ida, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $tra_dt_saida_ida = substr($tra_dt_saida_ida, 0, $tmp_pos);
         }
      }
      if (!isset($tra_dt_chegada_ida) || $tra_dt_chegada_ida == "")
      {
          $tra_dt_chegada_ida = "";
      }
      if (isset($tra_dt_chegada_ida) && !empty($tra_dt_chegada_ida))
      {
         $tmp_pos = (is_string($tra_dt_chegada_ida)) ? strpos($tra_dt_chegada_ida, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $tra_dt_chegada_ida = substr($tra_dt_chegada_ida, 0, $tmp_pos);
         }
      }
      if (!isset($tra_localizador_ida) || $tra_localizador_ida == "")
      {
          $tra_localizador_ida = "";
      }
      if (isset($tra_localizador_ida) && !empty($tra_localizador_ida))
      {
         $tmp_pos = (is_string($tra_localizador_ida)) ? strpos($tra_localizador_ida, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $tra_localizador_ida = substr($tra_localizador_ida, 0, $tmp_pos);
         }
      }
      if (!isset($tra_eticket_ida) || $tra_eticket_ida == "")
      {
          $tra_eticket_ida = "";
      }
      if (isset($tra_eticket_ida) && !empty($tra_eticket_ida))
      {
         $tmp_pos = (is_string($tra_eticket_ida)) ? strpos($tra_eticket_ida, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $tra_eticket_ida = substr($tra_eticket_ida, 0, $tmp_pos);
         }
      }
      if (!isset($tra_numvoo_volta) || $tra_numvoo_volta == "")
      {
          $tra_numvoo_volta = "";
      }
      if (isset($tra_numvoo_volta) && !empty($tra_numvoo_volta))
      {
         $tmp_pos = (is_string($tra_numvoo_volta)) ? strpos($tra_numvoo_volta, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $tra_numvoo_volta = substr($tra_numvoo_volta, 0, $tmp_pos);
         }
      }
      if (!isset($tra_dt_saida_volta) || $tra_dt_saida_volta == "")
      {
          $tra_dt_saida_volta = "";
      }
      if (isset($tra_dt_saida_volta) && !empty($tra_dt_saida_volta))
      {
         $tmp_pos = (is_string($tra_dt_saida_volta)) ? strpos($tra_dt_saida_volta, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $tra_dt_saida_volta = substr($tra_dt_saida_volta, 0, $tmp_pos);
         }
      }
      if (!isset($tra_dt_chegada_volta) || $tra_dt_chegada_volta == "")
      {
          $tra_dt_chegada_volta = "";
      }
      if (isset($tra_dt_chegada_volta) && !empty($tra_dt_chegada_volta))
      {
         $tmp_pos = (is_string($tra_dt_chegada_volta)) ? strpos($tra_dt_chegada_volta, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $tra_dt_chegada_volta = substr($tra_dt_chegada_volta, 0, $tmp_pos);
         }
      }
      if (!isset($tra_localizador_volta) || $tra_localizador_volta == "")
      {
          $tra_localizador_volta = "";
      }
      if (isset($tra_localizador_volta) && !empty($tra_localizador_volta))
      {
         $tmp_pos = (is_string($tra_localizador_volta)) ? strpos($tra_localizador_volta, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $tra_localizador_volta = substr($tra_localizador_volta, 0, $tmp_pos);
         }
      }
      if (!isset($tra_eticket_volta) || $tra_eticket_volta == "")
      {
          $tra_eticket_volta = "";
      }
      if (isset($tra_eticket_volta) && !empty($tra_eticket_volta))
      {
         $tmp_pos = (is_string($tra_eticket_volta)) ? strpos($tra_eticket_volta, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $tra_eticket_volta = substr($tra_eticket_volta, 0, $tmp_pos);
         }
      }
      if (!isset($tra_dt_chegada_proprio) || $tra_dt_chegada_proprio == "")
      {
          $tra_dt_chegada_proprio = "";
      }
      if (isset($tra_dt_chegada_proprio) && !empty($tra_dt_chegada_proprio))
      {
         $tmp_pos = (is_string($tra_dt_chegada_proprio)) ? strpos($tra_dt_chegada_proprio, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $tra_dt_chegada_proprio = substr($tra_dt_chegada_proprio, 0, $tmp_pos);
         }
      }
      if (!isset($tra_hr_chegada_proprio) || $tra_hr_chegada_proprio == "")
      {
          $tra_hr_chegada_proprio = "";
      }
      if (isset($tra_hr_chegada_proprio) && !empty($tra_hr_chegada_proprio))
      {
         $tmp_pos = (is_string($tra_hr_chegada_proprio)) ? strpos($tra_hr_chegada_proprio, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $tra_hr_chegada_proprio = substr($tra_hr_chegada_proprio, 0, $tmp_pos);
         }
      }
      if (!isset($tra_hr_volta_local) || $tra_hr_volta_local == "")
      {
          $tra_hr_volta_local = "";
      }
      if (isset($tra_hr_volta_local) && !empty($tra_hr_volta_local))
      {
         $tmp_pos = (is_string($tra_hr_volta_local)) ? strpos($tra_hr_volta_local, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $tra_hr_volta_local = substr($tra_hr_volta_local, 0, $tmp_pos);
         }
      }
      if (!isset($tra_dt_volta_local) || $tra_dt_volta_local == "")
      {
          $tra_dt_volta_local = "";
      }
      if (isset($tra_dt_volta_local) && !empty($tra_dt_volta_local))
      {
         $tmp_pos = (is_string($tra_dt_volta_local)) ? strpos($tra_dt_volta_local, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $tra_dt_volta_local = substr($tra_dt_volta_local, 0, $tmp_pos);
         }
      }
      if (!isset($tra_hr_ida_local) || $tra_hr_ida_local == "")
      {
          $tra_hr_ida_local = "";
      }
      if (isset($tra_hr_ida_local) && !empty($tra_hr_ida_local))
      {
         $tmp_pos = (is_string($tra_hr_ida_local)) ? strpos($tra_hr_ida_local, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $tra_hr_ida_local = substr($tra_hr_ida_local, 0, $tmp_pos);
         }
      }
      if (!isset($tra_dt_ida_local) || $tra_dt_ida_local == "")
      {
          $tra_dt_ida_local = "";
      }
      if (isset($tra_dt_ida_local) && !empty($tra_dt_ida_local))
      {
         $tmp_pos = (is_string($tra_dt_ida_local)) ? strpos($tra_dt_ida_local, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $tra_dt_ida_local = substr($tra_dt_ida_local, 0, $tmp_pos);
         }
      }
      if (!isset($id_transfer) || $id_transfer == "")
      {
          $id_transfer = "";
      }
      if (isset($id_transfer) && !empty($id_transfer))
      {
         $tmp_pos = (is_string($id_transfer)) ? strpos($id_transfer, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $id_transfer = substr($id_transfer, 0, $tmp_pos);
         }
      }
      if (!isset($tra_id_bloqueio) || $tra_id_bloqueio == "")
      {
          $tra_id_bloqueio = "";
      }
      if (isset($tra_id_bloqueio) && !empty($tra_id_bloqueio))
      {
         $tmp_pos = (is_string($tra_id_bloqueio)) ? strpos($tra_id_bloqueio, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $tra_id_bloqueio = substr($tra_id_bloqueio, 0, $tmp_pos);
         }
      }
      if (!isset($tra_id_evento) || $tra_id_evento == "")
      {
          $tra_id_evento = "";
      }
      if (isset($tra_id_evento) && !empty($tra_id_evento))
      {
         $tmp_pos = (is_string($tra_id_evento)) ? strpos($tra_id_evento, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $tra_id_evento = substr($tra_id_evento, 0, $tmp_pos);
         }
      }
      if (!isset($tra_id_aereo) || $tra_id_aereo == "")
      {
          $tra_id_aereo = "";
      }
      if (isset($tra_id_aereo) && !empty($tra_id_aereo))
      {
         $tmp_pos = (is_string($tra_id_aereo)) ? strpos($tra_id_aereo, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $tra_id_aereo = substr($tra_id_aereo, 0, $tmp_pos);
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
   if (is_file("grid_transfer_rsvp_help.txt"))
   {
      $Arq_WebHelp = file("grid_transfer_rsvp_help.txt"); 
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
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_transfer_rsvp']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_transfer_rsvp']['start'] == 'filter' && $nm_apl_dependente != 1)
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



   
    <TD nowrap class="scFilterFieldOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tra_cpf_particip'])) ? $this->New_label['tra_cpf_particip'] : "Tra Cpf Particip";
 $nmgp_tab_label .= "tra_cpf_particip?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_tra_cpf_particip_cond" name="tra_cpf_particip_cond" onChange="nm_campos_between(document.getElementById('id_vis_tra_cpf_particip'), this, 'tra_cpf_particip')">
       <OPTION value="qp" <?php if ("qp" == $tra_cpf_particip_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $tra_cpf_particip_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $tra_cpf_particip_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $tra_cpf_particip_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_tra_cpf_particip"  <?php echo $str_hide_tra_cpf_particip?>><?php
      if ($tra_cpf_particip != "")
      {
      $tra_cpf_particip_look = (is_string($tra_cpf_particip) ? substr($this->Db->qstr($tra_cpf_particip), 1, -1) : $tra_cpf_particip); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_cpf_particip from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and #lowerI#tra_cpf_particip#lowerF# = #lowerI#'$tra_cpf_particip_look'#lowerF# order by tra_cpf_particip"; 
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
      if (isset($nmgp_def_dados[0][$tra_cpf_particip]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$tra_cpf_particip];
      }
      else
      {
          $sAutocompValue = $tra_cpf_particip;
      }
?>
<INPUT  type="text" id="SC_tra_cpf_particip" name="tra_cpf_particip" value="<?php echo NM_encode_input($tra_cpf_particip) ?>"  size=13 alt="{datatype: 'text', maxLength: 13, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_tra_cpf_particip" name="tra_cpf_particip_autocomp" size="13"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 13, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tra_tipo_pessoa'])) ? $this->New_label['tra_tipo_pessoa'] : "Tra Tipo Pessoa";
 $nmgp_tab_label .= "tra_tipo_pessoa?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelEven scFilterLabelAboveEven"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectEven" id="SC_tra_tipo_pessoa_cond" name="tra_tipo_pessoa_cond" onChange="nm_campos_between(document.getElementById('id_vis_tra_tipo_pessoa'), this, 'tra_tipo_pessoa')">
       <OPTION value="qp" <?php if ("qp" == $tra_tipo_pessoa_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $tra_tipo_pessoa_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $tra_tipo_pessoa_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $tra_tipo_pessoa_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_tra_tipo_pessoa"  <?php echo $str_hide_tra_tipo_pessoa?>><?php
      if ($tra_tipo_pessoa != "")
      {
      $tra_tipo_pessoa_look = (is_string($tra_tipo_pessoa) ? substr($this->Db->qstr($tra_tipo_pessoa), 1, -1) : $tra_tipo_pessoa); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_tipo_pessoa from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and #lowerI#tra_tipo_pessoa#lowerF# = #lowerI#'$tra_tipo_pessoa_look'#lowerF# order by tra_tipo_pessoa"; 
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
      if (isset($nmgp_def_dados[0][$tra_tipo_pessoa]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$tra_tipo_pessoa];
      }
      else
      {
          $sAutocompValue = $tra_tipo_pessoa;
      }
?>
<INPUT  type="text" id="SC_tra_tipo_pessoa" name="tra_tipo_pessoa" value="<?php echo NM_encode_input($tra_tipo_pessoa) ?>"  size=10 alt="{datatype: 'text', maxLength: 10, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_tra_tipo_pessoa" name="tra_tipo_pessoa_autocomp" size="10"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 10, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tra_tipo'])) ? $this->New_label['tra_tipo'] : "Tra Tipo";
 $nmgp_tab_label .= "tra_tipo?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_tra_tipo_cond" name="tra_tipo_cond" onChange="nm_campos_between(document.getElementById('id_vis_tra_tipo'), this, 'tra_tipo')">
       <OPTION value="qp" <?php if ("qp" == $tra_tipo_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $tra_tipo_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $tra_tipo_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $tra_tipo_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_tra_tipo"  <?php echo $str_hide_tra_tipo?>><?php
      if ($tra_tipo != "")
      {
      $tra_tipo_look = (is_string($tra_tipo) ? substr($this->Db->qstr($tra_tipo), 1, -1) : $tra_tipo); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_tipo from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and #lowerI#tra_tipo#lowerF# = #lowerI#'$tra_tipo_look'#lowerF# order by tra_tipo"; 
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
      if (isset($nmgp_def_dados[0][$tra_tipo]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$tra_tipo];
      }
      else
      {
          $sAutocompValue = $tra_tipo;
      }
?>
<INPUT  type="text" id="SC_tra_tipo" name="tra_tipo" value="<?php echo NM_encode_input($tra_tipo) ?>"  size=10 alt="{datatype: 'text', maxLength: 10, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_tra_tipo" name="tra_tipo_autocomp" size="10"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 10, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tra_status'])) ? $this->New_label['tra_status'] : "Tra Status";
 $nmgp_tab_label .= "tra_status?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelEven scFilterLabelAboveEven"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectEven" id="SC_tra_status_cond" name="tra_status_cond" onChange="nm_campos_between(document.getElementById('id_vis_tra_status'), this, 'tra_status')">
       <OPTION value="qp" <?php if ("qp" == $tra_status_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $tra_status_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $tra_status_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $tra_status_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_tra_status"  <?php echo $str_hide_tra_status?>><?php
      if ($tra_status != "")
      {
      $tra_status_look = (is_string($tra_status) ? substr($this->Db->qstr($tra_status), 1, -1) : $tra_status); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_status from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and #lowerI#tra_status#lowerF# = #lowerI#'$tra_status_look'#lowerF# order by tra_status"; 
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
      if (isset($nmgp_def_dados[0][$tra_status]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$tra_status];
      }
      else
      {
          $sAutocompValue = $tra_status;
      }
?>
<INPUT  type="text" id="SC_tra_status" name="tra_status" value="<?php echo NM_encode_input($tra_status) ?>"  size=10 alt="{datatype: 'text', maxLength: 10, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_tra_status" name="tra_status_autocomp" size="10"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 10, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tra_direcao'])) ? $this->New_label['tra_direcao'] : "Tra Direcao";
 $nmgp_tab_label .= "tra_direcao?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_tra_direcao_cond" name="tra_direcao_cond" onChange="nm_campos_between(document.getElementById('id_vis_tra_direcao'), this, 'tra_direcao')">
       <OPTION value="qp" <?php if ("qp" == $tra_direcao_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $tra_direcao_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $tra_direcao_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $tra_direcao_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_tra_direcao"  <?php echo $str_hide_tra_direcao?>><?php
      if ($tra_direcao != "")
      {
      $tra_direcao_look = (is_string($tra_direcao) ? substr($this->Db->qstr($tra_direcao), 1, -1) : $tra_direcao); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_direcao from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and #lowerI#tra_direcao#lowerF# = #lowerI#'$tra_direcao_look'#lowerF# order by tra_direcao"; 
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
      if (isset($nmgp_def_dados[0][$tra_direcao]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$tra_direcao];
      }
      else
      {
          $sAutocompValue = $tra_direcao;
      }
?>
<INPUT  type="text" id="SC_tra_direcao" name="tra_direcao" value="<?php echo NM_encode_input($tra_direcao) ?>"  size=10 alt="{datatype: 'text', maxLength: 10, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_tra_direcao" name="tra_direcao_autocomp" size="10"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 10, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tra_numvoo_ida'])) ? $this->New_label['tra_numvoo_ida'] : "Tra Numvoo Ida";
 $nmgp_tab_label .= "tra_numvoo_ida?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelEven scFilterLabelAboveEven"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectEven" id="SC_tra_numvoo_ida_cond" name="tra_numvoo_ida_cond" onChange="nm_campos_between(document.getElementById('id_vis_tra_numvoo_ida'), this, 'tra_numvoo_ida')">
       <OPTION value="qp" <?php if ("qp" == $tra_numvoo_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $tra_numvoo_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $tra_numvoo_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $tra_numvoo_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_tra_numvoo_ida"  <?php echo $str_hide_tra_numvoo_ida?>><?php
      if ($tra_numvoo_ida != "")
      {
      $tra_numvoo_ida_look = (is_string($tra_numvoo_ida) ? substr($this->Db->qstr($tra_numvoo_ida), 1, -1) : $tra_numvoo_ida); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_numvoo_ida from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and #lowerI#tra_numvoo_ida#lowerF# = #lowerI#'$tra_numvoo_ida_look'#lowerF# order by tra_numvoo_ida"; 
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
      if (isset($nmgp_def_dados[0][$tra_numvoo_ida]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$tra_numvoo_ida];
      }
      else
      {
          $sAutocompValue = $tra_numvoo_ida;
      }
?>
<INPUT  type="text" id="SC_tra_numvoo_ida" name="tra_numvoo_ida" value="<?php echo NM_encode_input($tra_numvoo_ida) ?>"  size=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_tra_numvoo_ida" name="tra_numvoo_ida_autocomp" size="20"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tra_dt_saida_ida'])) ? $this->New_label['tra_dt_saida_ida'] : "Tra Dt Saida Ida";
 $nmgp_tab_label .= "tra_dt_saida_ida?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_tra_dt_saida_ida_cond" name="tra_dt_saida_ida_cond" onChange="nm_campos_between(document.getElementById('id_vis_tra_dt_saida_ida'), this, 'tra_dt_saida_ida')">
       <OPTION value="eq" <?php if ("eq" == $tra_dt_saida_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="gt" <?php if ("gt" == $tra_dt_saida_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $tra_dt_saida_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $tra_dt_saida_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_tra_dt_saida_ida"  <?php echo $str_hide_tra_dt_saida_ida?>>
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
<span id='id_date_part_tra_dt_saida_ida_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_dt_saida_ida_dia" name="tra_dt_saida_ida_dia" value="<?php echo NM_encode_input($tra_dt_saida_ida_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_saida_ida_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_dt_saida_ida_mes" name="tra_dt_saida_ida_mes" value="<?php echo NM_encode_input($tra_dt_saida_ida_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_saida_ida_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_dt_saida_ida_ano" name="tra_dt_saida_ida_ano" value="<?php echo NM_encode_input($tra_dt_saida_ida_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
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
        <SPAN id="id_css_tra_dt_saida_ida"  class="scFilterFieldFontOdd">
 <br><?php echo $date_format_show ?>         </SPAN>
                  <br />
        <SPAN id="id_vis_tra_dt_saida_ida"  <?php echo $str_display_tra_dt_saida_ida; ?> class="scFilterFieldFontOdd">
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
<span id='id_date_part_tra_dt_saida_ida_input_2_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_dt_saida_ida_input_2_dia" name="tra_dt_saida_ida_input_2_dia" value="<?php echo NM_encode_input($tra_dt_saida_ida_input_2_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_saida_ida_input_2_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_dt_saida_ida_input_2_mes" name="tra_dt_saida_ida_input_2_mes" value="<?php echo NM_encode_input($tra_dt_saida_ida_input_2_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_saida_ida_input_2_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_dt_saida_ida_input_2_ano" name="tra_dt_saida_ida_input_2_ano" value="<?php echo NM_encode_input($tra_dt_saida_ida_input_2_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
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
         </SPAN>
          </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tra_dt_chegada_ida'])) ? $this->New_label['tra_dt_chegada_ida'] : "Tra Dt Chegada Ida";
 $nmgp_tab_label .= "tra_dt_chegada_ida?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelEven scFilterLabelAboveEven"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectEven" id="SC_tra_dt_chegada_ida_cond" name="tra_dt_chegada_ida_cond" onChange="nm_campos_between(document.getElementById('id_vis_tra_dt_chegada_ida'), this, 'tra_dt_chegada_ida')">
       <OPTION value="eq" <?php if ("eq" == $tra_dt_chegada_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="gt" <?php if ("gt" == $tra_dt_chegada_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $tra_dt_chegada_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $tra_dt_chegada_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_tra_dt_chegada_ida"  <?php echo $str_hide_tra_dt_chegada_ida?>>
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
<span id='id_date_part_tra_dt_chegada_ida_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tra_dt_chegada_ida_dia" name="tra_dt_chegada_ida_dia" value="<?php echo NM_encode_input($tra_dt_chegada_ida_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_chegada_ida_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tra_dt_chegada_ida_mes" name="tra_dt_chegada_ida_mes" value="<?php echo NM_encode_input($tra_dt_chegada_ida_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_chegada_ida_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tra_dt_chegada_ida_ano" name="tra_dt_chegada_ida_ano" value="<?php echo NM_encode_input($tra_dt_chegada_ida_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
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
        <SPAN id="id_css_tra_dt_chegada_ida"  class="scFilterFieldFontEven">
 <br><?php echo $date_format_show ?>         </SPAN>
                  <br />
        <SPAN id="id_vis_tra_dt_chegada_ida"  <?php echo $str_display_tra_dt_chegada_ida; ?> class="scFilterFieldFontEven">
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
<span id='id_date_part_tra_dt_chegada_ida_input_2_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tra_dt_chegada_ida_input_2_dia" name="tra_dt_chegada_ida_input_2_dia" value="<?php echo NM_encode_input($tra_dt_chegada_ida_input_2_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_chegada_ida_input_2_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tra_dt_chegada_ida_input_2_mes" name="tra_dt_chegada_ida_input_2_mes" value="<?php echo NM_encode_input($tra_dt_chegada_ida_input_2_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_chegada_ida_input_2_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tra_dt_chegada_ida_input_2_ano" name="tra_dt_chegada_ida_input_2_ano" value="<?php echo NM_encode_input($tra_dt_chegada_ida_input_2_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
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
         </SPAN>
          </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tra_localizador_ida'])) ? $this->New_label['tra_localizador_ida'] : "Tra Localizador Ida";
 $nmgp_tab_label .= "tra_localizador_ida?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_tra_localizador_ida_cond" name="tra_localizador_ida_cond" onChange="nm_campos_between(document.getElementById('id_vis_tra_localizador_ida'), this, 'tra_localizador_ida')">
       <OPTION value="qp" <?php if ("qp" == $tra_localizador_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $tra_localizador_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $tra_localizador_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $tra_localizador_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_tra_localizador_ida"  <?php echo $str_hide_tra_localizador_ida?>><?php
      if ($tra_localizador_ida != "")
      {
      $tra_localizador_ida_look = (is_string($tra_localizador_ida) ? substr($this->Db->qstr($tra_localizador_ida), 1, -1) : $tra_localizador_ida); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_localizador_ida from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and #lowerI#tra_localizador_ida#lowerF# = #lowerI#'$tra_localizador_ida_look'#lowerF# order by tra_localizador_ida"; 
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
      if (isset($nmgp_def_dados[0][$tra_localizador_ida]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$tra_localizador_ida];
      }
      else
      {
          $sAutocompValue = $tra_localizador_ida;
      }
?>
<INPUT  type="text" id="SC_tra_localizador_ida" name="tra_localizador_ida" value="<?php echo NM_encode_input($tra_localizador_ida) ?>"  size=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_tra_localizador_ida" name="tra_localizador_ida_autocomp" size="20"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tra_eticket_ida'])) ? $this->New_label['tra_eticket_ida'] : "Tra Eticket Ida";
 $nmgp_tab_label .= "tra_eticket_ida?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelEven scFilterLabelAboveEven"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectEven" id="SC_tra_eticket_ida_cond" name="tra_eticket_ida_cond" onChange="nm_campos_between(document.getElementById('id_vis_tra_eticket_ida'), this, 'tra_eticket_ida')">
       <OPTION value="qp" <?php if ("qp" == $tra_eticket_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $tra_eticket_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $tra_eticket_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $tra_eticket_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_tra_eticket_ida"  <?php echo $str_hide_tra_eticket_ida?>><?php
      if ($tra_eticket_ida != "")
      {
      $tra_eticket_ida_look = (is_string($tra_eticket_ida) ? substr($this->Db->qstr($tra_eticket_ida), 1, -1) : $tra_eticket_ida); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_eticket_ida from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and #lowerI#tra_eticket_ida#lowerF# = #lowerI#'$tra_eticket_ida_look'#lowerF# order by tra_eticket_ida"; 
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
      if (isset($nmgp_def_dados[0][$tra_eticket_ida]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$tra_eticket_ida];
      }
      else
      {
          $sAutocompValue = $tra_eticket_ida;
      }
?>
<INPUT  type="text" id="SC_tra_eticket_ida" name="tra_eticket_ida" value="<?php echo NM_encode_input($tra_eticket_ida) ?>"  size=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_tra_eticket_ida" name="tra_eticket_ida_autocomp" size="20"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tra_numvoo_volta'])) ? $this->New_label['tra_numvoo_volta'] : "Tra Numvoo Volta";
 $nmgp_tab_label .= "tra_numvoo_volta?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_tra_numvoo_volta_cond" name="tra_numvoo_volta_cond" onChange="nm_campos_between(document.getElementById('id_vis_tra_numvoo_volta'), this, 'tra_numvoo_volta')">
       <OPTION value="qp" <?php if ("qp" == $tra_numvoo_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $tra_numvoo_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $tra_numvoo_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $tra_numvoo_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_tra_numvoo_volta"  <?php echo $str_hide_tra_numvoo_volta?>><?php
      if ($tra_numvoo_volta != "")
      {
      $tra_numvoo_volta_look = (is_string($tra_numvoo_volta) ? substr($this->Db->qstr($tra_numvoo_volta), 1, -1) : $tra_numvoo_volta); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_numvoo_volta from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and #lowerI#tra_numvoo_volta#lowerF# = #lowerI#'$tra_numvoo_volta_look'#lowerF# order by tra_numvoo_volta"; 
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
      if (isset($nmgp_def_dados[0][$tra_numvoo_volta]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$tra_numvoo_volta];
      }
      else
      {
          $sAutocompValue = $tra_numvoo_volta;
      }
?>
<INPUT  type="text" id="SC_tra_numvoo_volta" name="tra_numvoo_volta" value="<?php echo NM_encode_input($tra_numvoo_volta) ?>"  size=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_tra_numvoo_volta" name="tra_numvoo_volta_autocomp" size="20"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tra_dt_saida_volta'])) ? $this->New_label['tra_dt_saida_volta'] : "Tra Dt Saida Volta";
 $nmgp_tab_label .= "tra_dt_saida_volta?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelEven scFilterLabelAboveEven"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectEven" id="SC_tra_dt_saida_volta_cond" name="tra_dt_saida_volta_cond" onChange="nm_campos_between(document.getElementById('id_vis_tra_dt_saida_volta'), this, 'tra_dt_saida_volta')">
       <OPTION value="eq" <?php if ("eq" == $tra_dt_saida_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="gt" <?php if ("gt" == $tra_dt_saida_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $tra_dt_saida_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $tra_dt_saida_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_tra_dt_saida_volta"  <?php echo $str_hide_tra_dt_saida_volta?>>
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
<span id='id_date_part_tra_dt_saida_volta_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tra_dt_saida_volta_dia" name="tra_dt_saida_volta_dia" value="<?php echo NM_encode_input($tra_dt_saida_volta_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_saida_volta_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tra_dt_saida_volta_mes" name="tra_dt_saida_volta_mes" value="<?php echo NM_encode_input($tra_dt_saida_volta_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_saida_volta_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tra_dt_saida_volta_ano" name="tra_dt_saida_volta_ano" value="<?php echo NM_encode_input($tra_dt_saida_volta_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
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
        <SPAN id="id_css_tra_dt_saida_volta"  class="scFilterFieldFontEven">
 <br><?php echo $date_format_show ?>         </SPAN>
                  <br />
        <SPAN id="id_vis_tra_dt_saida_volta"  <?php echo $str_display_tra_dt_saida_volta; ?> class="scFilterFieldFontEven">
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
<span id='id_date_part_tra_dt_saida_volta_input_2_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tra_dt_saida_volta_input_2_dia" name="tra_dt_saida_volta_input_2_dia" value="<?php echo NM_encode_input($tra_dt_saida_volta_input_2_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_saida_volta_input_2_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tra_dt_saida_volta_input_2_mes" name="tra_dt_saida_volta_input_2_mes" value="<?php echo NM_encode_input($tra_dt_saida_volta_input_2_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_saida_volta_input_2_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tra_dt_saida_volta_input_2_ano" name="tra_dt_saida_volta_input_2_ano" value="<?php echo NM_encode_input($tra_dt_saida_volta_input_2_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
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
         </SPAN>
          </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tra_dt_chegada_volta'])) ? $this->New_label['tra_dt_chegada_volta'] : "Tra Dt Chegada Volta";
 $nmgp_tab_label .= "tra_dt_chegada_volta?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_tra_dt_chegada_volta_cond" name="tra_dt_chegada_volta_cond" onChange="nm_campos_between(document.getElementById('id_vis_tra_dt_chegada_volta'), this, 'tra_dt_chegada_volta')">
       <OPTION value="eq" <?php if ("eq" == $tra_dt_chegada_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="gt" <?php if ("gt" == $tra_dt_chegada_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $tra_dt_chegada_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $tra_dt_chegada_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_tra_dt_chegada_volta"  <?php echo $str_hide_tra_dt_chegada_volta?>>
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
<span id='id_date_part_tra_dt_chegada_volta_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_dt_chegada_volta_dia" name="tra_dt_chegada_volta_dia" value="<?php echo NM_encode_input($tra_dt_chegada_volta_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_chegada_volta_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_dt_chegada_volta_mes" name="tra_dt_chegada_volta_mes" value="<?php echo NM_encode_input($tra_dt_chegada_volta_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_chegada_volta_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_dt_chegada_volta_ano" name="tra_dt_chegada_volta_ano" value="<?php echo NM_encode_input($tra_dt_chegada_volta_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
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
        <SPAN id="id_css_tra_dt_chegada_volta"  class="scFilterFieldFontOdd">
 <br><?php echo $date_format_show ?>         </SPAN>
                  <br />
        <SPAN id="id_vis_tra_dt_chegada_volta"  <?php echo $str_display_tra_dt_chegada_volta; ?> class="scFilterFieldFontOdd">
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
<span id='id_date_part_tra_dt_chegada_volta_input_2_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_dt_chegada_volta_input_2_dia" name="tra_dt_chegada_volta_input_2_dia" value="<?php echo NM_encode_input($tra_dt_chegada_volta_input_2_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_chegada_volta_input_2_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_dt_chegada_volta_input_2_mes" name="tra_dt_chegada_volta_input_2_mes" value="<?php echo NM_encode_input($tra_dt_chegada_volta_input_2_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_chegada_volta_input_2_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_dt_chegada_volta_input_2_ano" name="tra_dt_chegada_volta_input_2_ano" value="<?php echo NM_encode_input($tra_dt_chegada_volta_input_2_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
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
         </SPAN>
          </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tra_localizador_volta'])) ? $this->New_label['tra_localizador_volta'] : "Tra Localizador Volta";
 $nmgp_tab_label .= "tra_localizador_volta?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelEven scFilterLabelAboveEven"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectEven" id="SC_tra_localizador_volta_cond" name="tra_localizador_volta_cond" onChange="nm_campos_between(document.getElementById('id_vis_tra_localizador_volta'), this, 'tra_localizador_volta')">
       <OPTION value="qp" <?php if ("qp" == $tra_localizador_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $tra_localizador_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $tra_localizador_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $tra_localizador_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_tra_localizador_volta"  <?php echo $str_hide_tra_localizador_volta?>><?php
      if ($tra_localizador_volta != "")
      {
      $tra_localizador_volta_look = (is_string($tra_localizador_volta) ? substr($this->Db->qstr($tra_localizador_volta), 1, -1) : $tra_localizador_volta); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_localizador_volta from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and #lowerI#tra_localizador_volta#lowerF# = #lowerI#'$tra_localizador_volta_look'#lowerF# order by tra_localizador_volta"; 
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
      if (isset($nmgp_def_dados[0][$tra_localizador_volta]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$tra_localizador_volta];
      }
      else
      {
          $sAutocompValue = $tra_localizador_volta;
      }
?>
<INPUT  type="text" id="SC_tra_localizador_volta" name="tra_localizador_volta" value="<?php echo NM_encode_input($tra_localizador_volta) ?>"  size=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_tra_localizador_volta" name="tra_localizador_volta_autocomp" size="20"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tra_eticket_volta'])) ? $this->New_label['tra_eticket_volta'] : "Tra Eticket Volta";
 $nmgp_tab_label .= "tra_eticket_volta?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_tra_eticket_volta_cond" name="tra_eticket_volta_cond" onChange="nm_campos_between(document.getElementById('id_vis_tra_eticket_volta'), this, 'tra_eticket_volta')">
       <OPTION value="qp" <?php if ("qp" == $tra_eticket_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $tra_eticket_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $tra_eticket_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $tra_eticket_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_tra_eticket_volta"  <?php echo $str_hide_tra_eticket_volta?>><?php
      if ($tra_eticket_volta != "")
      {
      $tra_eticket_volta_look = (is_string($tra_eticket_volta) ? substr($this->Db->qstr($tra_eticket_volta), 1, -1) : $tra_eticket_volta); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_eticket_volta from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and #lowerI#tra_eticket_volta#lowerF# = #lowerI#'$tra_eticket_volta_look'#lowerF# order by tra_eticket_volta"; 
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
      if (isset($nmgp_def_dados[0][$tra_eticket_volta]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$tra_eticket_volta];
      }
      else
      {
          $sAutocompValue = $tra_eticket_volta;
      }
?>
<INPUT  type="text" id="SC_tra_eticket_volta" name="tra_eticket_volta" value="<?php echo NM_encode_input($tra_eticket_volta) ?>"  size=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_tra_eticket_volta" name="tra_eticket_volta_autocomp" size="20"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tra_dt_chegada_proprio'])) ? $this->New_label['tra_dt_chegada_proprio'] : "Tra Dt Chegada Proprio";
 $nmgp_tab_label .= "tra_dt_chegada_proprio?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelEven scFilterLabelAboveEven"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectEven" id="SC_tra_dt_chegada_proprio_cond" name="tra_dt_chegada_proprio_cond" onChange="nm_campos_between(document.getElementById('id_vis_tra_dt_chegada_proprio'), this, 'tra_dt_chegada_proprio')">
       <OPTION value="eq" <?php if ("eq" == $tra_dt_chegada_proprio_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="gt" <?php if ("gt" == $tra_dt_chegada_proprio_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $tra_dt_chegada_proprio_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $tra_dt_chegada_proprio_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_tra_dt_chegada_proprio"  <?php echo $str_hide_tra_dt_chegada_proprio?>>
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
<span id='id_date_part_tra_dt_chegada_proprio_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tra_dt_chegada_proprio_dia" name="tra_dt_chegada_proprio_dia" value="<?php echo NM_encode_input($tra_dt_chegada_proprio_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_chegada_proprio_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tra_dt_chegada_proprio_mes" name="tra_dt_chegada_proprio_mes" value="<?php echo NM_encode_input($tra_dt_chegada_proprio_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_chegada_proprio_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tra_dt_chegada_proprio_ano" name="tra_dt_chegada_proprio_ano" value="<?php echo NM_encode_input($tra_dt_chegada_proprio_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
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
        <SPAN id="id_css_tra_dt_chegada_proprio"  class="scFilterFieldFontEven">
 <br><?php echo $date_format_show ?>         </SPAN>
                  <br />
        <SPAN id="id_vis_tra_dt_chegada_proprio"  <?php echo $str_display_tra_dt_chegada_proprio; ?> class="scFilterFieldFontEven">
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
<span id='id_date_part_tra_dt_chegada_proprio_input_2_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tra_dt_chegada_proprio_input_2_dia" name="tra_dt_chegada_proprio_input_2_dia" value="<?php echo NM_encode_input($tra_dt_chegada_proprio_input_2_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_chegada_proprio_input_2_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tra_dt_chegada_proprio_input_2_mes" name="tra_dt_chegada_proprio_input_2_mes" value="<?php echo NM_encode_input($tra_dt_chegada_proprio_input_2_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_chegada_proprio_input_2_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tra_dt_chegada_proprio_input_2_ano" name="tra_dt_chegada_proprio_input_2_ano" value="<?php echo NM_encode_input($tra_dt_chegada_proprio_input_2_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
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
         </SPAN>
          </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tra_hr_chegada_proprio'])) ? $this->New_label['tra_hr_chegada_proprio'] : "Tra Hr Chegada Proprio";
 $nmgp_tab_label .= "tra_hr_chegada_proprio?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_tra_hr_chegada_proprio_cond" name="tra_hr_chegada_proprio_cond" onChange="nm_campos_between(document.getElementById('id_vis_tra_hr_chegada_proprio'), this, 'tra_hr_chegada_proprio')">
       <OPTION value="eq" <?php if ("eq" == $tra_hr_chegada_proprio_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ii" <?php if ("ii" == $tra_hr_chegada_proprio_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_stts_with'] ?></OPTION>
       <OPTION value="qp" <?php if ("qp" == $tra_hr_chegada_proprio_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="df" <?php if ("df" == $tra_hr_chegada_proprio_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_dife'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_tra_hr_chegada_proprio"  <?php echo $str_hide_tra_hr_chegada_proprio?>>
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
<span id='id_date_part_tra_hr_chegada_proprio_HH' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_hr_chegada_proprio_hor" name="tra_hr_chegada_proprio_hor" value="<?php echo NM_encode_input($tra_hr_chegada_proprio_hor); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_hr_chegada_proprio_II' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_hr_chegada_proprio_min" name="tra_hr_chegada_proprio_min" value="<?php echo NM_encode_input($tra_hr_chegada_proprio_min); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_hr_chegada_proprio_SS' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_hr_chegada_proprio_seg" name="tra_hr_chegada_proprio_seg" value="<?php echo NM_encode_input($tra_hr_chegada_proprio_seg); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
        <SPAN id="id_css_tra_hr_chegada_proprio"  class="scFilterFieldFontOdd">
 <br><?php echo $date_format_show ?>         </SPAN>
          </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tra_hr_volta_local'])) ? $this->New_label['tra_hr_volta_local'] : "Tra Hr Volta Local";
 $nmgp_tab_label .= "tra_hr_volta_local?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelEven scFilterLabelAboveEven"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectEven" id="SC_tra_hr_volta_local_cond" name="tra_hr_volta_local_cond" onChange="nm_campos_between(document.getElementById('id_vis_tra_hr_volta_local'), this, 'tra_hr_volta_local')">
       <OPTION value="eq" <?php if ("eq" == $tra_hr_volta_local_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ii" <?php if ("ii" == $tra_hr_volta_local_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_stts_with'] ?></OPTION>
       <OPTION value="qp" <?php if ("qp" == $tra_hr_volta_local_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="df" <?php if ("df" == $tra_hr_volta_local_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_dife'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_tra_hr_volta_local"  <?php echo $str_hide_tra_hr_volta_local?>>
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
<span id='id_date_part_tra_hr_volta_local_HH' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tra_hr_volta_local_hor" name="tra_hr_volta_local_hor" value="<?php echo NM_encode_input($tra_hr_volta_local_hor); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_hr_volta_local_II' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tra_hr_volta_local_min" name="tra_hr_volta_local_min" value="<?php echo NM_encode_input($tra_hr_volta_local_min); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_hr_volta_local_SS' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tra_hr_volta_local_seg" name="tra_hr_volta_local_seg" value="<?php echo NM_encode_input($tra_hr_volta_local_seg); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
        <SPAN id="id_css_tra_hr_volta_local"  class="scFilterFieldFontEven">
 <br><?php echo $date_format_show ?>         </SPAN>
          </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tra_dt_volta_local'])) ? $this->New_label['tra_dt_volta_local'] : "Tra Dt Volta Local";
 $nmgp_tab_label .= "tra_dt_volta_local?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_tra_dt_volta_local_cond" name="tra_dt_volta_local_cond" onChange="nm_campos_between(document.getElementById('id_vis_tra_dt_volta_local'), this, 'tra_dt_volta_local')">
       <OPTION value="eq" <?php if ("eq" == $tra_dt_volta_local_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="gt" <?php if ("gt" == $tra_dt_volta_local_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $tra_dt_volta_local_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $tra_dt_volta_local_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_tra_dt_volta_local"  <?php echo $str_hide_tra_dt_volta_local?>>
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
<span id='id_date_part_tra_dt_volta_local_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_dt_volta_local_dia" name="tra_dt_volta_local_dia" value="<?php echo NM_encode_input($tra_dt_volta_local_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_volta_local_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_dt_volta_local_mes" name="tra_dt_volta_local_mes" value="<?php echo NM_encode_input($tra_dt_volta_local_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_volta_local_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_dt_volta_local_ano" name="tra_dt_volta_local_ano" value="<?php echo NM_encode_input($tra_dt_volta_local_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
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
        <SPAN id="id_css_tra_dt_volta_local"  class="scFilterFieldFontOdd">
 <br><?php echo $date_format_show ?>         </SPAN>
                  <br />
        <SPAN id="id_vis_tra_dt_volta_local"  <?php echo $str_display_tra_dt_volta_local; ?> class="scFilterFieldFontOdd">
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
<span id='id_date_part_tra_dt_volta_local_input_2_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_dt_volta_local_input_2_dia" name="tra_dt_volta_local_input_2_dia" value="<?php echo NM_encode_input($tra_dt_volta_local_input_2_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_volta_local_input_2_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_dt_volta_local_input_2_mes" name="tra_dt_volta_local_input_2_mes" value="<?php echo NM_encode_input($tra_dt_volta_local_input_2_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_volta_local_input_2_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_dt_volta_local_input_2_ano" name="tra_dt_volta_local_input_2_ano" value="<?php echo NM_encode_input($tra_dt_volta_local_input_2_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
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
         </SPAN>
          </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tra_hr_ida_local'])) ? $this->New_label['tra_hr_ida_local'] : "Tra Hr Ida Local";
 $nmgp_tab_label .= "tra_hr_ida_local?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelEven scFilterLabelAboveEven"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectEven" id="SC_tra_hr_ida_local_cond" name="tra_hr_ida_local_cond" onChange="nm_campos_between(document.getElementById('id_vis_tra_hr_ida_local'), this, 'tra_hr_ida_local')">
       <OPTION value="eq" <?php if ("eq" == $tra_hr_ida_local_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ii" <?php if ("ii" == $tra_hr_ida_local_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_stts_with'] ?></OPTION>
       <OPTION value="qp" <?php if ("qp" == $tra_hr_ida_local_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="df" <?php if ("df" == $tra_hr_ida_local_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_dife'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_tra_hr_ida_local"  <?php echo $str_hide_tra_hr_ida_local?>>
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
<span id='id_date_part_tra_hr_ida_local_HH' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tra_hr_ida_local_hor" name="tra_hr_ida_local_hor" value="<?php echo NM_encode_input($tra_hr_ida_local_hor); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_hr_ida_local_II' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tra_hr_ida_local_min" name="tra_hr_ida_local_min" value="<?php echo NM_encode_input($tra_hr_ida_local_min); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_hr_ida_local_SS' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_tra_hr_ida_local_seg" name="tra_hr_ida_local_seg" value="<?php echo NM_encode_input($tra_hr_ida_local_seg); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
        <SPAN id="id_css_tra_hr_ida_local"  class="scFilterFieldFontEven">
 <br><?php echo $date_format_show ?>         </SPAN>
          </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tra_dt_ida_local'])) ? $this->New_label['tra_dt_ida_local'] : "Tra Dt Ida Local";
 $nmgp_tab_label .= "tra_dt_ida_local?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_tra_dt_ida_local_cond" name="tra_dt_ida_local_cond" onChange="nm_campos_between(document.getElementById('id_vis_tra_dt_ida_local'), this, 'tra_dt_ida_local')">
       <OPTION value="eq" <?php if ("eq" == $tra_dt_ida_local_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="gt" <?php if ("gt" == $tra_dt_ida_local_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $tra_dt_ida_local_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $tra_dt_ida_local_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_tra_dt_ida_local"  <?php echo $str_hide_tra_dt_ida_local?>>
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
<span id='id_date_part_tra_dt_ida_local_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_dt_ida_local_dia" name="tra_dt_ida_local_dia" value="<?php echo NM_encode_input($tra_dt_ida_local_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_ida_local_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_dt_ida_local_mes" name="tra_dt_ida_local_mes" value="<?php echo NM_encode_input($tra_dt_ida_local_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_ida_local_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_dt_ida_local_ano" name="tra_dt_ida_local_ano" value="<?php echo NM_encode_input($tra_dt_ida_local_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
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
        <SPAN id="id_css_tra_dt_ida_local"  class="scFilterFieldFontOdd">
 <br><?php echo $date_format_show ?>         </SPAN>
                  <br />
        <SPAN id="id_vis_tra_dt_ida_local"  <?php echo $str_display_tra_dt_ida_local; ?> class="scFilterFieldFontOdd">
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
<span id='id_date_part_tra_dt_ida_local_input_2_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_dt_ida_local_input_2_dia" name="tra_dt_ida_local_input_2_dia" value="<?php echo NM_encode_input($tra_dt_ida_local_input_2_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_ida_local_input_2_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_dt_ida_local_input_2_mes" name="tra_dt_ida_local_input_2_mes" value="<?php echo NM_encode_input($tra_dt_ida_local_input_2_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_tra_dt_ida_local_input_2_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_tra_dt_ida_local_input_2_ano" name="tra_dt_ida_local_input_2_ano" value="<?php echo NM_encode_input($tra_dt_ida_local_input_2_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
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
         </SPAN>
          </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['id_transfer'])) ? $this->New_label['id_transfer'] : "Cód. Transfer";
 $nmgp_tab_label .= "id_transfer?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelEven scFilterLabelAboveEven"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectEven" id="SC_id_transfer_cond" name="id_transfer_cond" onChange="nm_campos_between(document.getElementById('id_vis_id_transfer'), this, 'id_transfer')">
       <OPTION value="gt" <?php if ("gt" == $id_transfer_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $id_transfer_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $id_transfer_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_id_transfer"  <?php echo $str_hide_id_transfer?>><INPUT  type="text" id="SC_id_transfer" name="id_transfer" value="<?php echo NM_encode_input($id_transfer) ?>" size=11 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" class="sc-js-input scFilterObjectEven">
 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tra_id_bloqueio'])) ? $this->New_label['tra_id_bloqueio'] : "Bloqueio Aéreo";
 $nmgp_tab_label .= "tra_id_bloqueio?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_tra_id_bloqueio_cond" name="tra_id_bloqueio_cond" onChange="nm_campos_between(document.getElementById('id_vis_tra_id_bloqueio'), this, 'tra_id_bloqueio')">
       <OPTION value="gt" <?php if ("gt" == $tra_id_bloqueio_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $tra_id_bloqueio_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $tra_id_bloqueio_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_tra_id_bloqueio"  <?php echo $str_hide_tra_id_bloqueio?>><INPUT  type="text" id="SC_tra_id_bloqueio" name="tra_id_bloqueio" value="<?php echo NM_encode_input($tra_id_bloqueio) ?>" size=11 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" class="sc-js-input scFilterObjectOdd">
 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tra_id_evento'])) ? $this->New_label['tra_id_evento'] : "Evento";
 $nmgp_tab_label .= "tra_id_evento?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelEven scFilterLabelAboveEven"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectEven" id="SC_tra_id_evento_cond" name="tra_id_evento_cond" onChange="nm_campos_between(document.getElementById('id_vis_tra_id_evento'), this, 'tra_id_evento')">
       <OPTION value="gt" <?php if ("gt" == $tra_id_evento_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $tra_id_evento_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $tra_id_evento_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_tra_id_evento"  <?php echo $str_hide_tra_id_evento?>><INPUT  type="text" id="SC_tra_id_evento" name="tra_id_evento" value="<?php echo NM_encode_input($tra_id_evento) ?>" size=11 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" class="sc-js-input scFilterObjectEven">
 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tra_id_aereo'])) ? $this->New_label['tra_id_aereo'] : "Aéreo Ida";
 $nmgp_tab_label .= "tra_id_aereo?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_tra_id_aereo_cond" name="tra_id_aereo_cond" onChange="nm_campos_between(document.getElementById('id_vis_tra_id_aereo'), this, 'tra_id_aereo')">
       <OPTION value="gt" <?php if ("gt" == $tra_id_aereo_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $tra_id_aereo_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $tra_id_aereo_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_tra_id_aereo"  <?php echo $str_hide_tra_id_aereo?>><INPUT  type="text" id="SC_tra_id_aereo" name="tra_id_aereo" value="<?php echo NM_encode_input($tra_id_aereo) ?>" size=11 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" class="sc-js-input scFilterObjectOdd">
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
    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['pesq_tab_label'] = $nmgp_tab_label;
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
   if (is_file("grid_transfer_rsvp_help.txt"))
   {
      $Arq_WebHelp = file("grid_transfer_rsvp_help.txt"); 
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
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_transfer_rsvp']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_transfer_rsvp']['start'] == 'filter' && $nm_apl_dependente != 1)
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
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_transfer_rsvp']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_transfer_rsvp']['start'] == 'filter')
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
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['orig_pesq']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['orig_pesq'] == "grid")
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
   document.F1.tra_cpf_particip_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_tra_cpf_particip'), document.F1.tra_cpf_particip_cond, 'tra_cpf_particip', opc_clear);
   document.F1.tra_cpf_particip.value = "";
   document.F1.tra_cpf_particip_autocomp.value = "";
   document.F1.tra_tipo_pessoa_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_tra_tipo_pessoa'), document.F1.tra_tipo_pessoa_cond, 'tra_tipo_pessoa', opc_clear);
   document.F1.tra_tipo_pessoa.value = "";
   document.F1.tra_tipo_pessoa_autocomp.value = "";
   document.F1.tra_tipo_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_tra_tipo'), document.F1.tra_tipo_cond, 'tra_tipo', opc_clear);
   document.F1.tra_tipo.value = "";
   document.F1.tra_tipo_autocomp.value = "";
   document.F1.tra_status_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_tra_status'), document.F1.tra_status_cond, 'tra_status', opc_clear);
   document.F1.tra_status.value = "";
   document.F1.tra_status_autocomp.value = "";
   document.F1.tra_direcao_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_tra_direcao'), document.F1.tra_direcao_cond, 'tra_direcao', opc_clear);
   document.F1.tra_direcao.value = "";
   document.F1.tra_direcao_autocomp.value = "";
   document.F1.tra_numvoo_ida_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_tra_numvoo_ida'), document.F1.tra_numvoo_ida_cond, 'tra_numvoo_ida', opc_clear);
   document.F1.tra_numvoo_ida.value = "";
   document.F1.tra_numvoo_ida_autocomp.value = "";
   document.F1.tra_dt_saida_ida_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_tra_dt_saida_ida'), document.F1.tra_dt_saida_ida_cond, 'tra_dt_saida_ida', opc_clear);
   document.F1.tra_dt_saida_ida_dia.value = "";
   document.F1.tra_dt_saida_ida_mes.value = "";
   document.F1.tra_dt_saida_ida_ano.value = "";
   document.F1.tra_dt_saida_ida_input_2_dia.value = "";
   document.F1.tra_dt_saida_ida_input_2_mes.value = "";
   document.F1.tra_dt_saida_ida_input_2_ano.value = "";
   document.F1.tra_dt_chegada_ida_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_tra_dt_chegada_ida'), document.F1.tra_dt_chegada_ida_cond, 'tra_dt_chegada_ida', opc_clear);
   document.F1.tra_dt_chegada_ida_dia.value = "";
   document.F1.tra_dt_chegada_ida_mes.value = "";
   document.F1.tra_dt_chegada_ida_ano.value = "";
   document.F1.tra_dt_chegada_ida_input_2_dia.value = "";
   document.F1.tra_dt_chegada_ida_input_2_mes.value = "";
   document.F1.tra_dt_chegada_ida_input_2_ano.value = "";
   document.F1.tra_localizador_ida_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_tra_localizador_ida'), document.F1.tra_localizador_ida_cond, 'tra_localizador_ida', opc_clear);
   document.F1.tra_localizador_ida.value = "";
   document.F1.tra_localizador_ida_autocomp.value = "";
   document.F1.tra_eticket_ida_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_tra_eticket_ida'), document.F1.tra_eticket_ida_cond, 'tra_eticket_ida', opc_clear);
   document.F1.tra_eticket_ida.value = "";
   document.F1.tra_eticket_ida_autocomp.value = "";
   document.F1.tra_numvoo_volta_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_tra_numvoo_volta'), document.F1.tra_numvoo_volta_cond, 'tra_numvoo_volta', opc_clear);
   document.F1.tra_numvoo_volta.value = "";
   document.F1.tra_numvoo_volta_autocomp.value = "";
   document.F1.tra_dt_saida_volta_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_tra_dt_saida_volta'), document.F1.tra_dt_saida_volta_cond, 'tra_dt_saida_volta', opc_clear);
   document.F1.tra_dt_saida_volta_dia.value = "";
   document.F1.tra_dt_saida_volta_mes.value = "";
   document.F1.tra_dt_saida_volta_ano.value = "";
   document.F1.tra_dt_saida_volta_input_2_dia.value = "";
   document.F1.tra_dt_saida_volta_input_2_mes.value = "";
   document.F1.tra_dt_saida_volta_input_2_ano.value = "";
   document.F1.tra_dt_chegada_volta_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_tra_dt_chegada_volta'), document.F1.tra_dt_chegada_volta_cond, 'tra_dt_chegada_volta', opc_clear);
   document.F1.tra_dt_chegada_volta_dia.value = "";
   document.F1.tra_dt_chegada_volta_mes.value = "";
   document.F1.tra_dt_chegada_volta_ano.value = "";
   document.F1.tra_dt_chegada_volta_input_2_dia.value = "";
   document.F1.tra_dt_chegada_volta_input_2_mes.value = "";
   document.F1.tra_dt_chegada_volta_input_2_ano.value = "";
   document.F1.tra_localizador_volta_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_tra_localizador_volta'), document.F1.tra_localizador_volta_cond, 'tra_localizador_volta', opc_clear);
   document.F1.tra_localizador_volta.value = "";
   document.F1.tra_localizador_volta_autocomp.value = "";
   document.F1.tra_eticket_volta_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_tra_eticket_volta'), document.F1.tra_eticket_volta_cond, 'tra_eticket_volta', opc_clear);
   document.F1.tra_eticket_volta.value = "";
   document.F1.tra_eticket_volta_autocomp.value = "";
   document.F1.tra_dt_chegada_proprio_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_tra_dt_chegada_proprio'), document.F1.tra_dt_chegada_proprio_cond, 'tra_dt_chegada_proprio', opc_clear);
   document.F1.tra_dt_chegada_proprio_dia.value = "";
   document.F1.tra_dt_chegada_proprio_mes.value = "";
   document.F1.tra_dt_chegada_proprio_ano.value = "";
   document.F1.tra_dt_chegada_proprio_input_2_dia.value = "";
   document.F1.tra_dt_chegada_proprio_input_2_mes.value = "";
   document.F1.tra_dt_chegada_proprio_input_2_ano.value = "";
   document.F1.tra_hr_chegada_proprio_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_tra_hr_chegada_proprio'), document.F1.tra_hr_chegada_proprio_cond, 'tra_hr_chegada_proprio', opc_clear);
   document.F1.tra_hr_chegada_proprio_hor.value = "";
   document.F1.tra_hr_chegada_proprio_min.value = "";
   document.F1.tra_hr_chegada_proprio_seg.value = "";
   document.F1.tra_hr_volta_local_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_tra_hr_volta_local'), document.F1.tra_hr_volta_local_cond, 'tra_hr_volta_local', opc_clear);
   document.F1.tra_hr_volta_local_hor.value = "";
   document.F1.tra_hr_volta_local_min.value = "";
   document.F1.tra_hr_volta_local_seg.value = "";
   document.F1.tra_dt_volta_local_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_tra_dt_volta_local'), document.F1.tra_dt_volta_local_cond, 'tra_dt_volta_local', opc_clear);
   document.F1.tra_dt_volta_local_dia.value = "";
   document.F1.tra_dt_volta_local_mes.value = "";
   document.F1.tra_dt_volta_local_ano.value = "";
   document.F1.tra_dt_volta_local_input_2_dia.value = "";
   document.F1.tra_dt_volta_local_input_2_mes.value = "";
   document.F1.tra_dt_volta_local_input_2_ano.value = "";
   document.F1.tra_hr_ida_local_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_tra_hr_ida_local'), document.F1.tra_hr_ida_local_cond, 'tra_hr_ida_local', opc_clear);
   document.F1.tra_hr_ida_local_hor.value = "";
   document.F1.tra_hr_ida_local_min.value = "";
   document.F1.tra_hr_ida_local_seg.value = "";
   document.F1.tra_dt_ida_local_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_tra_dt_ida_local'), document.F1.tra_dt_ida_local_cond, 'tra_dt_ida_local', opc_clear);
   document.F1.tra_dt_ida_local_dia.value = "";
   document.F1.tra_dt_ida_local_mes.value = "";
   document.F1.tra_dt_ida_local_ano.value = "";
   document.F1.tra_dt_ida_local_input_2_dia.value = "";
   document.F1.tra_dt_ida_local_input_2_mes.value = "";
   document.F1.tra_dt_ida_local_input_2_ano.value = "";
   document.F1.id_transfer_cond.value = 'gt';
   nm_campos_between(document.getElementById('id_vis_id_transfer'), document.F1.id_transfer_cond, 'id_transfer', opc_clear);
   document.F1.id_transfer.value = "";
   document.F1.tra_id_bloqueio_cond.value = 'gt';
   nm_campos_between(document.getElementById('id_vis_tra_id_bloqueio'), document.F1.tra_id_bloqueio_cond, 'tra_id_bloqueio', opc_clear);
   document.F1.tra_id_bloqueio.value = "";
   document.F1.tra_id_evento_cond.value = 'gt';
   nm_campos_between(document.getElementById('id_vis_tra_id_evento'), document.F1.tra_id_evento_cond, 'tra_id_evento', opc_clear);
   document.F1.tra_id_evento.value = "";
   document.F1.tra_id_aereo_cond.value = 'gt';
   nm_campos_between(document.getElementById('id_vis_tra_id_aereo'), document.F1.tra_id_aereo_cond, 'tra_id_aereo', opc_clear);
   document.F1.tra_id_aereo.value = "";
 }
 function SC_carga_evt_jquery()
 {
    $('#SC_tra_dt_chegada_ida_dia').bind('change', function() {sc_grid_transfer_rsvp_valida_dia(this)});
    $('#SC_tra_dt_chegada_ida_input_2_dia').bind('change', function() {sc_grid_transfer_rsvp_valida_dia(this)});
    $('#SC_tra_dt_chegada_ida_input_2_mes').bind('change', function() {sc_grid_transfer_rsvp_valida_mes(this)});
    $('#SC_tra_dt_chegada_ida_mes').bind('change', function() {sc_grid_transfer_rsvp_valida_mes(this)});
    $('#SC_tra_dt_chegada_proprio_dia').bind('change', function() {sc_grid_transfer_rsvp_valida_dia(this)});
    $('#SC_tra_dt_chegada_proprio_input_2_dia').bind('change', function() {sc_grid_transfer_rsvp_valida_dia(this)});
    $('#SC_tra_dt_chegada_proprio_input_2_mes').bind('change', function() {sc_grid_transfer_rsvp_valida_mes(this)});
    $('#SC_tra_dt_chegada_proprio_mes').bind('change', function() {sc_grid_transfer_rsvp_valida_mes(this)});
    $('#SC_tra_dt_chegada_volta_dia').bind('change', function() {sc_grid_transfer_rsvp_valida_dia(this)});
    $('#SC_tra_dt_chegada_volta_input_2_dia').bind('change', function() {sc_grid_transfer_rsvp_valida_dia(this)});
    $('#SC_tra_dt_chegada_volta_input_2_mes').bind('change', function() {sc_grid_transfer_rsvp_valida_mes(this)});
    $('#SC_tra_dt_chegada_volta_mes').bind('change', function() {sc_grid_transfer_rsvp_valida_mes(this)});
    $('#SC_tra_dt_ida_local_dia').bind('change', function() {sc_grid_transfer_rsvp_valida_dia(this)});
    $('#SC_tra_dt_ida_local_input_2_dia').bind('change', function() {sc_grid_transfer_rsvp_valida_dia(this)});
    $('#SC_tra_dt_ida_local_input_2_mes').bind('change', function() {sc_grid_transfer_rsvp_valida_mes(this)});
    $('#SC_tra_dt_ida_local_mes').bind('change', function() {sc_grid_transfer_rsvp_valida_mes(this)});
    $('#SC_tra_dt_saida_ida_dia').bind('change', function() {sc_grid_transfer_rsvp_valida_dia(this)});
    $('#SC_tra_dt_saida_ida_input_2_dia').bind('change', function() {sc_grid_transfer_rsvp_valida_dia(this)});
    $('#SC_tra_dt_saida_ida_input_2_mes').bind('change', function() {sc_grid_transfer_rsvp_valida_mes(this)});
    $('#SC_tra_dt_saida_ida_mes').bind('change', function() {sc_grid_transfer_rsvp_valida_mes(this)});
    $('#SC_tra_dt_saida_volta_dia').bind('change', function() {sc_grid_transfer_rsvp_valida_dia(this)});
    $('#SC_tra_dt_saida_volta_input_2_dia').bind('change', function() {sc_grid_transfer_rsvp_valida_dia(this)});
    $('#SC_tra_dt_saida_volta_input_2_mes').bind('change', function() {sc_grid_transfer_rsvp_valida_mes(this)});
    $('#SC_tra_dt_saida_volta_mes').bind('change', function() {sc_grid_transfer_rsvp_valida_mes(this)});
    $('#SC_tra_dt_volta_local_dia').bind('change', function() {sc_grid_transfer_rsvp_valida_dia(this)});
    $('#SC_tra_dt_volta_local_input_2_dia').bind('change', function() {sc_grid_transfer_rsvp_valida_dia(this)});
    $('#SC_tra_dt_volta_local_input_2_mes').bind('change', function() {sc_grid_transfer_rsvp_valida_mes(this)});
    $('#SC_tra_dt_volta_local_mes').bind('change', function() {sc_grid_transfer_rsvp_valida_mes(this)});
    $('#SC_tra_hr_chegada_proprio_hor').bind('change', function() {sc_grid_transfer_rsvp_valida_hora(this)});
    $('#SC_tra_hr_chegada_proprio_min').bind('change', function() {sc_grid_transfer_rsvp_valida_min(this)});
    $('#SC_tra_hr_chegada_proprio_seg').bind('change', function() {sc_grid_transfer_rsvp_valida_seg(this)});
    $('#SC_tra_hr_ida_local_hor').bind('change', function() {sc_grid_transfer_rsvp_valida_hora(this)});
    $('#SC_tra_hr_ida_local_min').bind('change', function() {sc_grid_transfer_rsvp_valida_min(this)});
    $('#SC_tra_hr_ida_local_seg').bind('change', function() {sc_grid_transfer_rsvp_valida_seg(this)});
    $('#SC_tra_hr_volta_local_hor').bind('change', function() {sc_grid_transfer_rsvp_valida_hora(this)});
    $('#SC_tra_hr_volta_local_min').bind('change', function() {sc_grid_transfer_rsvp_valida_min(this)});
    $('#SC_tra_hr_volta_local_seg').bind('change', function() {sc_grid_transfer_rsvp_valida_seg(this)});
 }
 function sc_grid_transfer_rsvp_valida_dia(obj)
 {
     if (obj.value != "" && (obj.value < 1 || obj.value > 31))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_iday'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { $(document.activeElement).focus(); obj.focus(); }, 10);
         }
     }
 }
 function sc_grid_transfer_rsvp_valida_mes(obj)
 {
     if (obj.value != "" && (obj.value < 1 || obj.value > 12))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_mnth'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { $(document.activeElement).focus(); obj.focus(); }, 10);
         }
     }
 }
 function sc_grid_transfer_rsvp_valida_hora(obj)
 {
     if (obj.value != "" && (obj.value < 0 || obj.value > 23))
     {
         if (confirm (Nm_erro['lang_jscr_ivtm'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { $(document.activeElement).focus(); obj.focus(); }, 10);
         }
     }
 }
 function sc_grid_transfer_rsvp_valida_min(obj)
 {
     if (obj.value != "" && (obj.value < 0 || obj.value > 59))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_mint'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { $(document.activeElement).focus(); obj.focus(); }, 10);
         }
     }
 }
 function sc_grid_transfer_rsvp_valida_seg(obj)
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
       $NM_patch   = "NRSVP115_10_AWS_APP/grid_transfer_rsvp";
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
          $nmgp_tab_label = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['pesq_tab_label'];
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
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_orig']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_orig'] = "";
      }
      $this->init_comando();
      $this->NM_operador     = (isset($NM_operador) && ("and" == strtolower($NM_operador) || "or" == strtolower($NM_operador))) ? $NM_operador : "and";
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq'] = array();
   }

   function init_comando()
   {
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['cond_pesq'] = "";
      if ($this->NM_ajax_flag && ($this->NM_ajax_opcao == "ajax_grid_search" || $this->NM_ajax_opcao == "ajax_grid_search_change_fil"))
      {
          $this->comando = "";
      }
      else
      {
          $this->comando = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_orig'];
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
          $NM_patch .= "grid_transfer_rsvp/";
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
      $tp_fields['SC_tra_cpf_particip_cond'] = 'cond';
      $tp_fields['SC_tra_cpf_particip'] = 'text_aut';
      $tp_fields['id_ac_tra_cpf_particip'] = 'text_aut';
      $tp_fields['SC_tra_tipo_pessoa_cond'] = 'cond';
      $tp_fields['SC_tra_tipo_pessoa'] = 'text_aut';
      $tp_fields['id_ac_tra_tipo_pessoa'] = 'text_aut';
      $tp_fields['SC_tra_tipo_cond'] = 'cond';
      $tp_fields['SC_tra_tipo'] = 'text_aut';
      $tp_fields['id_ac_tra_tipo'] = 'text_aut';
      $tp_fields['SC_tra_status_cond'] = 'cond';
      $tp_fields['SC_tra_status'] = 'text_aut';
      $tp_fields['id_ac_tra_status'] = 'text_aut';
      $tp_fields['SC_tra_direcao_cond'] = 'cond';
      $tp_fields['SC_tra_direcao'] = 'text_aut';
      $tp_fields['id_ac_tra_direcao'] = 'text_aut';
      $tp_fields['SC_tra_numvoo_ida_cond'] = 'cond';
      $tp_fields['SC_tra_numvoo_ida'] = 'text_aut';
      $tp_fields['id_ac_tra_numvoo_ida'] = 'text_aut';
      $tp_fields['SC_tra_dt_saida_ida_cond'] = 'cond';
      $tp_fields['SC_tra_dt_saida_ida_dia'] = 'text';
      $tp_fields['SC_tra_dt_saida_ida_mes'] = 'text';
      $tp_fields['SC_tra_dt_saida_ida_ano'] = 'text';
      $tp_fields['SC_tra_dt_saida_ida_input_2_dia'] = 'text';
      $tp_fields['SC_tra_dt_saida_ida_input_2_mes'] = 'text';
      $tp_fields['SC_tra_dt_saida_ida_input_2_ano'] = 'text';
      $tp_fields['SC_tra_dt_chegada_ida_cond'] = 'cond';
      $tp_fields['SC_tra_dt_chegada_ida_dia'] = 'text';
      $tp_fields['SC_tra_dt_chegada_ida_mes'] = 'text';
      $tp_fields['SC_tra_dt_chegada_ida_ano'] = 'text';
      $tp_fields['SC_tra_dt_chegada_ida_input_2_dia'] = 'text';
      $tp_fields['SC_tra_dt_chegada_ida_input_2_mes'] = 'text';
      $tp_fields['SC_tra_dt_chegada_ida_input_2_ano'] = 'text';
      $tp_fields['SC_tra_localizador_ida_cond'] = 'cond';
      $tp_fields['SC_tra_localizador_ida'] = 'text_aut';
      $tp_fields['id_ac_tra_localizador_ida'] = 'text_aut';
      $tp_fields['SC_tra_eticket_ida_cond'] = 'cond';
      $tp_fields['SC_tra_eticket_ida'] = 'text_aut';
      $tp_fields['id_ac_tra_eticket_ida'] = 'text_aut';
      $tp_fields['SC_tra_numvoo_volta_cond'] = 'cond';
      $tp_fields['SC_tra_numvoo_volta'] = 'text_aut';
      $tp_fields['id_ac_tra_numvoo_volta'] = 'text_aut';
      $tp_fields['SC_tra_dt_saida_volta_cond'] = 'cond';
      $tp_fields['SC_tra_dt_saida_volta_dia'] = 'text';
      $tp_fields['SC_tra_dt_saida_volta_mes'] = 'text';
      $tp_fields['SC_tra_dt_saida_volta_ano'] = 'text';
      $tp_fields['SC_tra_dt_saida_volta_input_2_dia'] = 'text';
      $tp_fields['SC_tra_dt_saida_volta_input_2_mes'] = 'text';
      $tp_fields['SC_tra_dt_saida_volta_input_2_ano'] = 'text';
      $tp_fields['SC_tra_dt_chegada_volta_cond'] = 'cond';
      $tp_fields['SC_tra_dt_chegada_volta_dia'] = 'text';
      $tp_fields['SC_tra_dt_chegada_volta_mes'] = 'text';
      $tp_fields['SC_tra_dt_chegada_volta_ano'] = 'text';
      $tp_fields['SC_tra_dt_chegada_volta_input_2_dia'] = 'text';
      $tp_fields['SC_tra_dt_chegada_volta_input_2_mes'] = 'text';
      $tp_fields['SC_tra_dt_chegada_volta_input_2_ano'] = 'text';
      $tp_fields['SC_tra_localizador_volta_cond'] = 'cond';
      $tp_fields['SC_tra_localizador_volta'] = 'text_aut';
      $tp_fields['id_ac_tra_localizador_volta'] = 'text_aut';
      $tp_fields['SC_tra_eticket_volta_cond'] = 'cond';
      $tp_fields['SC_tra_eticket_volta'] = 'text_aut';
      $tp_fields['id_ac_tra_eticket_volta'] = 'text_aut';
      $tp_fields['SC_tra_dt_chegada_proprio_cond'] = 'cond';
      $tp_fields['SC_tra_dt_chegada_proprio_dia'] = 'text';
      $tp_fields['SC_tra_dt_chegada_proprio_mes'] = 'text';
      $tp_fields['SC_tra_dt_chegada_proprio_ano'] = 'text';
      $tp_fields['SC_tra_dt_chegada_proprio_input_2_dia'] = 'text';
      $tp_fields['SC_tra_dt_chegada_proprio_input_2_mes'] = 'text';
      $tp_fields['SC_tra_dt_chegada_proprio_input_2_ano'] = 'text';
      $tp_fields['SC_tra_hr_chegada_proprio_cond'] = 'cond';
      $tp_fields['SC_tra_hr_chegada_proprio_hor'] = 'text';
      $tp_fields['SC_tra_hr_chegada_proprio_min'] = 'text';
      $tp_fields['SC_tra_hr_chegada_proprio_seg'] = 'text';
      $tp_fields['SC_tra_hr_chegada_proprio_input_2_hor'] = 'text';
      $tp_fields['SC_tra_hr_chegada_proprio_input_2_min'] = 'text';
      $tp_fields['SC_tra_hr_chegada_proprio_input_2_seg'] = 'text';
      $tp_fields['SC_tra_hr_volta_local_cond'] = 'cond';
      $tp_fields['SC_tra_hr_volta_local_hor'] = 'text';
      $tp_fields['SC_tra_hr_volta_local_min'] = 'text';
      $tp_fields['SC_tra_hr_volta_local_seg'] = 'text';
      $tp_fields['SC_tra_hr_volta_local_input_2_hor'] = 'text';
      $tp_fields['SC_tra_hr_volta_local_input_2_min'] = 'text';
      $tp_fields['SC_tra_hr_volta_local_input_2_seg'] = 'text';
      $tp_fields['SC_tra_dt_volta_local_cond'] = 'cond';
      $tp_fields['SC_tra_dt_volta_local_dia'] = 'text';
      $tp_fields['SC_tra_dt_volta_local_mes'] = 'text';
      $tp_fields['SC_tra_dt_volta_local_ano'] = 'text';
      $tp_fields['SC_tra_dt_volta_local_input_2_dia'] = 'text';
      $tp_fields['SC_tra_dt_volta_local_input_2_mes'] = 'text';
      $tp_fields['SC_tra_dt_volta_local_input_2_ano'] = 'text';
      $tp_fields['SC_tra_hr_ida_local_cond'] = 'cond';
      $tp_fields['SC_tra_hr_ida_local_hor'] = 'text';
      $tp_fields['SC_tra_hr_ida_local_min'] = 'text';
      $tp_fields['SC_tra_hr_ida_local_seg'] = 'text';
      $tp_fields['SC_tra_hr_ida_local_input_2_hor'] = 'text';
      $tp_fields['SC_tra_hr_ida_local_input_2_min'] = 'text';
      $tp_fields['SC_tra_hr_ida_local_input_2_seg'] = 'text';
      $tp_fields['SC_tra_dt_ida_local_cond'] = 'cond';
      $tp_fields['SC_tra_dt_ida_local_dia'] = 'text';
      $tp_fields['SC_tra_dt_ida_local_mes'] = 'text';
      $tp_fields['SC_tra_dt_ida_local_ano'] = 'text';
      $tp_fields['SC_tra_dt_ida_local_input_2_dia'] = 'text';
      $tp_fields['SC_tra_dt_ida_local_input_2_mes'] = 'text';
      $tp_fields['SC_tra_dt_ida_local_input_2_ano'] = 'text';
      $tp_fields['SC_id_transfer_cond'] = 'cond';
      $tp_fields['SC_id_transfer'] = 'text';
      $tp_fields['SC_tra_id_bloqueio_cond'] = 'cond';
      $tp_fields['SC_tra_id_bloqueio'] = 'text';
      $tp_fields['SC_tra_id_evento_cond'] = 'cond';
      $tp_fields['SC_tra_id_evento'] = 'text';
      $tp_fields['SC_tra_id_aereo_cond'] = 'cond';
      $tp_fields['SC_tra_id_aereo'] = 'text';
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
      global $tra_cpf_particip_cond, $tra_cpf_particip, $tra_cpf_particip_autocomp,
             $tra_tipo_pessoa_cond, $tra_tipo_pessoa, $tra_tipo_pessoa_autocomp,
             $tra_tipo_cond, $tra_tipo, $tra_tipo_autocomp,
             $tra_status_cond, $tra_status, $tra_status_autocomp,
             $tra_direcao_cond, $tra_direcao, $tra_direcao_autocomp,
             $tra_numvoo_ida_cond, $tra_numvoo_ida, $tra_numvoo_ida_autocomp,
             $tra_dt_saida_ida_cond, $tra_dt_saida_ida, $tra_dt_saida_ida_dia, $tra_dt_saida_ida_mes, $tra_dt_saida_ida_ano, $tra_dt_saida_ida_input_2_dia, $tra_dt_saida_ida_input_2_mes, $tra_dt_saida_ida_input_2_ano,
             $tra_dt_chegada_ida_cond, $tra_dt_chegada_ida, $tra_dt_chegada_ida_dia, $tra_dt_chegada_ida_mes, $tra_dt_chegada_ida_ano, $tra_dt_chegada_ida_input_2_dia, $tra_dt_chegada_ida_input_2_mes, $tra_dt_chegada_ida_input_2_ano,
             $tra_localizador_ida_cond, $tra_localizador_ida, $tra_localizador_ida_autocomp,
             $tra_eticket_ida_cond, $tra_eticket_ida, $tra_eticket_ida_autocomp,
             $tra_numvoo_volta_cond, $tra_numvoo_volta, $tra_numvoo_volta_autocomp,
             $tra_dt_saida_volta_cond, $tra_dt_saida_volta, $tra_dt_saida_volta_dia, $tra_dt_saida_volta_mes, $tra_dt_saida_volta_ano, $tra_dt_saida_volta_input_2_dia, $tra_dt_saida_volta_input_2_mes, $tra_dt_saida_volta_input_2_ano,
             $tra_dt_chegada_volta_cond, $tra_dt_chegada_volta, $tra_dt_chegada_volta_dia, $tra_dt_chegada_volta_mes, $tra_dt_chegada_volta_ano, $tra_dt_chegada_volta_input_2_dia, $tra_dt_chegada_volta_input_2_mes, $tra_dt_chegada_volta_input_2_ano,
             $tra_localizador_volta_cond, $tra_localizador_volta, $tra_localizador_volta_autocomp,
             $tra_eticket_volta_cond, $tra_eticket_volta, $tra_eticket_volta_autocomp,
             $tra_dt_chegada_proprio_cond, $tra_dt_chegada_proprio, $tra_dt_chegada_proprio_dia, $tra_dt_chegada_proprio_mes, $tra_dt_chegada_proprio_ano, $tra_dt_chegada_proprio_input_2_dia, $tra_dt_chegada_proprio_input_2_mes, $tra_dt_chegada_proprio_input_2_ano,
             $tra_hr_chegada_proprio_cond, $tra_hr_chegada_proprio, $tra_hr_chegada_proprio_hor, $tra_hr_chegada_proprio_min, $tra_hr_chegada_proprio_seg,
             $tra_hr_volta_local_cond, $tra_hr_volta_local, $tra_hr_volta_local_hor, $tra_hr_volta_local_min, $tra_hr_volta_local_seg,
             $tra_dt_volta_local_cond, $tra_dt_volta_local, $tra_dt_volta_local_dia, $tra_dt_volta_local_mes, $tra_dt_volta_local_ano, $tra_dt_volta_local_input_2_dia, $tra_dt_volta_local_input_2_mes, $tra_dt_volta_local_input_2_ano,
             $tra_hr_ida_local_cond, $tra_hr_ida_local, $tra_hr_ida_local_hor, $tra_hr_ida_local_min, $tra_hr_ida_local_seg,
             $tra_dt_ida_local_cond, $tra_dt_ida_local, $tra_dt_ida_local_dia, $tra_dt_ida_local_mes, $tra_dt_ida_local_ano, $tra_dt_ida_local_input_2_dia, $tra_dt_ida_local_input_2_mes, $tra_dt_ida_local_input_2_ano,
             $id_transfer_cond, $id_transfer,
             $tra_id_bloqueio_cond, $tra_id_bloqueio,
             $tra_id_evento_cond, $tra_id_evento,
             $tra_id_aereo_cond, $tra_id_aereo, $nmgp_tab_label;

      $C_formatado = true;
      if ($this->NM_ajax_flag && ($this->NM_ajax_opcao == "ajax_grid_search" || $this->NM_ajax_opcao == "ajax_grid_search_change_fil"))
      {
          if ($this->NM_ajax_opcao == "ajax_grid_search")
          {
              $C_formatado = false;
          }
          $Temp_Busca  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && $this->NM_ajax_opcao != "ajax_grid_search_change_fil")
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca'], $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca'] as $Cmps => $Vals)
          {
              $$Cmps = $Vals;
          }
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_limpa.php", "F", "nm_limpa_valor") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_conv_dados.php", "F", "nm_conv_limpa_dado") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_edit.php", "F", "nmgp_Form_Num_Val") ; 
      if (!empty($tra_cpf_particip_autocomp) && empty($tra_cpf_particip))
      {
          $tra_cpf_particip = $tra_cpf_particip_autocomp;
      }
      if (!empty($tra_tipo_pessoa_autocomp) && empty($tra_tipo_pessoa))
      {
          $tra_tipo_pessoa = $tra_tipo_pessoa_autocomp;
      }
      if (!empty($tra_tipo_autocomp) && empty($tra_tipo))
      {
          $tra_tipo = $tra_tipo_autocomp;
      }
      if (!empty($tra_status_autocomp) && empty($tra_status))
      {
          $tra_status = $tra_status_autocomp;
      }
      if (!empty($tra_direcao_autocomp) && empty($tra_direcao))
      {
          $tra_direcao = $tra_direcao_autocomp;
      }
      if (!empty($tra_numvoo_ida_autocomp) && empty($tra_numvoo_ida))
      {
          $tra_numvoo_ida = $tra_numvoo_ida_autocomp;
      }
      if (!empty($tra_localizador_ida_autocomp) && empty($tra_localizador_ida))
      {
          $tra_localizador_ida = $tra_localizador_ida_autocomp;
      }
      if (!empty($tra_eticket_ida_autocomp) && empty($tra_eticket_ida))
      {
          $tra_eticket_ida = $tra_eticket_ida_autocomp;
      }
      if (!empty($tra_numvoo_volta_autocomp) && empty($tra_numvoo_volta))
      {
          $tra_numvoo_volta = $tra_numvoo_volta_autocomp;
      }
      if (!empty($tra_localizador_volta_autocomp) && empty($tra_localizador_volta))
      {
          $tra_localizador_volta = $tra_localizador_volta_autocomp;
      }
      if (!empty($tra_eticket_volta_autocomp) && empty($tra_eticket_volta))
      {
          $tra_eticket_volta = $tra_eticket_volta_autocomp;
      }
      $tra_cpf_particip_cond_salva = $tra_cpf_particip_cond; 
      if (!isset($tra_cpf_particip_input_2) || $tra_cpf_particip_input_2 == "")
      {
          $tra_cpf_particip_input_2 = $tra_cpf_particip;
      }
      $tra_tipo_pessoa_cond_salva = $tra_tipo_pessoa_cond; 
      if (!isset($tra_tipo_pessoa_input_2) || $tra_tipo_pessoa_input_2 == "")
      {
          $tra_tipo_pessoa_input_2 = $tra_tipo_pessoa;
      }
      $tra_tipo_cond_salva = $tra_tipo_cond; 
      if (!isset($tra_tipo_input_2) || $tra_tipo_input_2 == "")
      {
          $tra_tipo_input_2 = $tra_tipo;
      }
      $tra_status_cond_salva = $tra_status_cond; 
      if (!isset($tra_status_input_2) || $tra_status_input_2 == "")
      {
          $tra_status_input_2 = $tra_status;
      }
      $tra_direcao_cond_salva = $tra_direcao_cond; 
      if (!isset($tra_direcao_input_2) || $tra_direcao_input_2 == "")
      {
          $tra_direcao_input_2 = $tra_direcao;
      }
      $tra_numvoo_ida_cond_salva = $tra_numvoo_ida_cond; 
      if (!isset($tra_numvoo_ida_input_2) || $tra_numvoo_ida_input_2 == "")
      {
          $tra_numvoo_ida_input_2 = $tra_numvoo_ida;
      }
      $tra_dt_saida_ida_cond_salva = $tra_dt_saida_ida_cond; 
      if (!isset($tra_dt_saida_ida_input_2_dia) || $tra_dt_saida_ida_input_2_dia == "") {
          $tra_dt_saida_ida_input_2_dia = $tra_dt_saida_ida_dia;
      }
      if (!isset($tra_dt_saida_ida_input_2_mes) || $tra_dt_saida_ida_input_2_mes == "") {
          $tra_dt_saida_ida_input_2_mes = $tra_dt_saida_ida_mes;
      }
      if (!isset($tra_dt_saida_ida_input_2_ano) || $tra_dt_saida_ida_input_2_ano == "") {
          $tra_dt_saida_ida_input_2_ano = $tra_dt_saida_ida_ano;
      }
      $tra_dt_chegada_ida_cond_salva = $tra_dt_chegada_ida_cond; 
      if (!isset($tra_dt_chegada_ida_input_2_dia) || $tra_dt_chegada_ida_input_2_dia == "") {
          $tra_dt_chegada_ida_input_2_dia = $tra_dt_chegada_ida_dia;
      }
      if (!isset($tra_dt_chegada_ida_input_2_mes) || $tra_dt_chegada_ida_input_2_mes == "") {
          $tra_dt_chegada_ida_input_2_mes = $tra_dt_chegada_ida_mes;
      }
      if (!isset($tra_dt_chegada_ida_input_2_ano) || $tra_dt_chegada_ida_input_2_ano == "") {
          $tra_dt_chegada_ida_input_2_ano = $tra_dt_chegada_ida_ano;
      }
      $tra_localizador_ida_cond_salva = $tra_localizador_ida_cond; 
      if (!isset($tra_localizador_ida_input_2) || $tra_localizador_ida_input_2 == "")
      {
          $tra_localizador_ida_input_2 = $tra_localizador_ida;
      }
      $tra_eticket_ida_cond_salva = $tra_eticket_ida_cond; 
      if (!isset($tra_eticket_ida_input_2) || $tra_eticket_ida_input_2 == "")
      {
          $tra_eticket_ida_input_2 = $tra_eticket_ida;
      }
      $tra_numvoo_volta_cond_salva = $tra_numvoo_volta_cond; 
      if (!isset($tra_numvoo_volta_input_2) || $tra_numvoo_volta_input_2 == "")
      {
          $tra_numvoo_volta_input_2 = $tra_numvoo_volta;
      }
      $tra_dt_saida_volta_cond_salva = $tra_dt_saida_volta_cond; 
      if (!isset($tra_dt_saida_volta_input_2_dia) || $tra_dt_saida_volta_input_2_dia == "") {
          $tra_dt_saida_volta_input_2_dia = $tra_dt_saida_volta_dia;
      }
      if (!isset($tra_dt_saida_volta_input_2_mes) || $tra_dt_saida_volta_input_2_mes == "") {
          $tra_dt_saida_volta_input_2_mes = $tra_dt_saida_volta_mes;
      }
      if (!isset($tra_dt_saida_volta_input_2_ano) || $tra_dt_saida_volta_input_2_ano == "") {
          $tra_dt_saida_volta_input_2_ano = $tra_dt_saida_volta_ano;
      }
      $tra_dt_chegada_volta_cond_salva = $tra_dt_chegada_volta_cond; 
      if (!isset($tra_dt_chegada_volta_input_2_dia) || $tra_dt_chegada_volta_input_2_dia == "") {
          $tra_dt_chegada_volta_input_2_dia = $tra_dt_chegada_volta_dia;
      }
      if (!isset($tra_dt_chegada_volta_input_2_mes) || $tra_dt_chegada_volta_input_2_mes == "") {
          $tra_dt_chegada_volta_input_2_mes = $tra_dt_chegada_volta_mes;
      }
      if (!isset($tra_dt_chegada_volta_input_2_ano) || $tra_dt_chegada_volta_input_2_ano == "") {
          $tra_dt_chegada_volta_input_2_ano = $tra_dt_chegada_volta_ano;
      }
      $tra_localizador_volta_cond_salva = $tra_localizador_volta_cond; 
      if (!isset($tra_localizador_volta_input_2) || $tra_localizador_volta_input_2 == "")
      {
          $tra_localizador_volta_input_2 = $tra_localizador_volta;
      }
      $tra_eticket_volta_cond_salva = $tra_eticket_volta_cond; 
      if (!isset($tra_eticket_volta_input_2) || $tra_eticket_volta_input_2 == "")
      {
          $tra_eticket_volta_input_2 = $tra_eticket_volta;
      }
      $tra_dt_chegada_proprio_cond_salva = $tra_dt_chegada_proprio_cond; 
      if (!isset($tra_dt_chegada_proprio_input_2_dia) || $tra_dt_chegada_proprio_input_2_dia == "") {
          $tra_dt_chegada_proprio_input_2_dia = $tra_dt_chegada_proprio_dia;
      }
      if (!isset($tra_dt_chegada_proprio_input_2_mes) || $tra_dt_chegada_proprio_input_2_mes == "") {
          $tra_dt_chegada_proprio_input_2_mes = $tra_dt_chegada_proprio_mes;
      }
      if (!isset($tra_dt_chegada_proprio_input_2_ano) || $tra_dt_chegada_proprio_input_2_ano == "") {
          $tra_dt_chegada_proprio_input_2_ano = $tra_dt_chegada_proprio_ano;
      }
      $tra_hr_chegada_proprio_cond_salva = $tra_hr_chegada_proprio_cond; 
      $tra_hr_volta_local_cond_salva = $tra_hr_volta_local_cond; 
      $tra_dt_volta_local_cond_salva = $tra_dt_volta_local_cond; 
      if (!isset($tra_dt_volta_local_input_2_dia) || $tra_dt_volta_local_input_2_dia == "") {
          $tra_dt_volta_local_input_2_dia = $tra_dt_volta_local_dia;
      }
      if (!isset($tra_dt_volta_local_input_2_mes) || $tra_dt_volta_local_input_2_mes == "") {
          $tra_dt_volta_local_input_2_mes = $tra_dt_volta_local_mes;
      }
      if (!isset($tra_dt_volta_local_input_2_ano) || $tra_dt_volta_local_input_2_ano == "") {
          $tra_dt_volta_local_input_2_ano = $tra_dt_volta_local_ano;
      }
      $tra_hr_ida_local_cond_salva = $tra_hr_ida_local_cond; 
      $tra_dt_ida_local_cond_salva = $tra_dt_ida_local_cond; 
      if (!isset($tra_dt_ida_local_input_2_dia) || $tra_dt_ida_local_input_2_dia == "") {
          $tra_dt_ida_local_input_2_dia = $tra_dt_ida_local_dia;
      }
      if (!isset($tra_dt_ida_local_input_2_mes) || $tra_dt_ida_local_input_2_mes == "") {
          $tra_dt_ida_local_input_2_mes = $tra_dt_ida_local_mes;
      }
      if (!isset($tra_dt_ida_local_input_2_ano) || $tra_dt_ida_local_input_2_ano == "") {
          $tra_dt_ida_local_input_2_ano = $tra_dt_ida_local_ano;
      }
      $id_transfer_cond_salva = $id_transfer_cond; 
      if (!isset($id_transfer_input_2) || $id_transfer_input_2 == "")
      {
          $id_transfer_input_2 = $id_transfer;
      }
      $tra_id_bloqueio_cond_salva = $tra_id_bloqueio_cond; 
      if (!isset($tra_id_bloqueio_input_2) || $tra_id_bloqueio_input_2 == "")
      {
          $tra_id_bloqueio_input_2 = $tra_id_bloqueio;
      }
      $tra_id_evento_cond_salva = $tra_id_evento_cond; 
      if (!isset($tra_id_evento_input_2) || $tra_id_evento_input_2 == "")
      {
          $tra_id_evento_input_2 = $tra_id_evento;
      }
      $tra_id_aereo_cond_salva = $tra_id_aereo_cond; 
      if (!isset($tra_id_aereo_input_2) || $tra_id_aereo_input_2 == "")
      {
          $tra_id_aereo_input_2 = $tra_id_aereo;
      }
      if ($id_transfer_cond != "in")
      {
          nm_limpa_numero($id_transfer, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      if ($tra_id_bloqueio_cond != "in")
      {
          nm_limpa_numero($tra_id_bloqueio, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      if ($tra_id_evento_cond != "in")
      {
          nm_limpa_numero($tra_id_evento, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      if ($tra_id_aereo_cond != "in")
      {
          nm_limpa_numero($tra_id_aereo, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']  = array(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search']  = array(); 
      $I_Grid = 0;
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_cpf_particip'] = $tra_cpf_particip; 
      if (is_array($tra_cpf_particip) && !empty($tra_cpf_particip))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0] = $tra_cpf_particip;
      }
      elseif ($tra_cpf_particip_cond_salva == "nu" || $tra_cpf_particip_cond_salva == "nn" || $tra_cpf_particip_cond_salva == "ep" || $tra_cpf_particip_cond_salva == "ne" || !empty($tra_cpf_particip))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][0] = $tra_cpf_particip;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_cpf_particip_cond'] = $tra_cpf_particip_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['cmp'] = "tra_cpf_particip"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['opc'] = $tra_cpf_particip_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_cpf_particip'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_tipo_pessoa'] = $tra_tipo_pessoa; 
      if (is_array($tra_tipo_pessoa) && !empty($tra_tipo_pessoa))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0] = $tra_tipo_pessoa;
      }
      elseif ($tra_tipo_pessoa_cond_salva == "nu" || $tra_tipo_pessoa_cond_salva == "nn" || $tra_tipo_pessoa_cond_salva == "ep" || $tra_tipo_pessoa_cond_salva == "ne" || !empty($tra_tipo_pessoa))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][0] = $tra_tipo_pessoa;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_tipo_pessoa_cond'] = $tra_tipo_pessoa_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['cmp'] = "tra_tipo_pessoa"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['opc'] = $tra_tipo_pessoa_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_tipo_pessoa'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_tipo'] = $tra_tipo; 
      if (is_array($tra_tipo) && !empty($tra_tipo))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0] = $tra_tipo;
      }
      elseif ($tra_tipo_cond_salva == "nu" || $tra_tipo_cond_salva == "nn" || $tra_tipo_cond_salva == "ep" || $tra_tipo_cond_salva == "ne" || !empty($tra_tipo))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][0] = $tra_tipo;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_tipo_cond'] = $tra_tipo_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['cmp'] = "tra_tipo"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['opc'] = $tra_tipo_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_tipo'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_status'] = $tra_status; 
      if (is_array($tra_status) && !empty($tra_status))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0] = $tra_status;
      }
      elseif ($tra_status_cond_salva == "nu" || $tra_status_cond_salva == "nn" || $tra_status_cond_salva == "ep" || $tra_status_cond_salva == "ne" || !empty($tra_status))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][0] = $tra_status;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_status_cond'] = $tra_status_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['cmp'] = "tra_status"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['opc'] = $tra_status_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_status'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_direcao'] = $tra_direcao; 
      if (is_array($tra_direcao) && !empty($tra_direcao))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0] = $tra_direcao;
      }
      elseif ($tra_direcao_cond_salva == "nu" || $tra_direcao_cond_salva == "nn" || $tra_direcao_cond_salva == "ep" || $tra_direcao_cond_salva == "ne" || !empty($tra_direcao))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][0] = $tra_direcao;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_direcao_cond'] = $tra_direcao_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['cmp'] = "tra_direcao"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['opc'] = $tra_direcao_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_direcao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_numvoo_ida'] = $tra_numvoo_ida; 
      if (is_array($tra_numvoo_ida) && !empty($tra_numvoo_ida))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0] = $tra_numvoo_ida;
      }
      elseif ($tra_numvoo_ida_cond_salva == "nu" || $tra_numvoo_ida_cond_salva == "nn" || $tra_numvoo_ida_cond_salva == "ep" || $tra_numvoo_ida_cond_salva == "ne" || !empty($tra_numvoo_ida))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][0] = $tra_numvoo_ida;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_numvoo_ida_cond'] = $tra_numvoo_ida_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['cmp'] = "tra_numvoo_ida"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['opc'] = $tra_numvoo_ida_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_numvoo_ida'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_ida_dia'] = $tra_dt_saida_ida_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_ida_mes'] = $tra_dt_saida_ida_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_ida_ano'] = $tra_dt_saida_ida_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_ida_input_2_dia'] = $tra_dt_saida_ida_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_ida_input_2_mes'] = $tra_dt_saida_ida_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_ida_input_2_ano'] = $tra_dt_saida_ida_input_2_ano; 
      if (!empty($tra_dt_saida_ida_dia) || !empty($tra_dt_saida_ida_mes) || !empty($tra_dt_saida_ida_ano) || $tra_dt_saida_ida_cond_salva == "nu" || $tra_dt_saida_ida_cond_salva == "nn" || $tra_dt_saida_ida_cond_salva == "ep" || $tra_dt_saida_ida_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "D:" . $tra_dt_saida_ida_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "M:" . $tra_dt_saida_ida_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "Y:" . $tra_dt_saida_ida_ano;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][1][] = "D:" . $tra_dt_saida_ida_input_2_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][1][] = "M:" . $tra_dt_saida_ida_input_2_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][1][] = "Y:" . $tra_dt_saida_ida_input_2_ano;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_ida_cond'] = $tra_dt_saida_ida_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['cmp'] = "tra_dt_saida_ida"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['opc'] = $tra_dt_saida_ida_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_saida_ida'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_ida_dia'] = $tra_dt_chegada_ida_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_ida_mes'] = $tra_dt_chegada_ida_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_ida_ano'] = $tra_dt_chegada_ida_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_ida_input_2_dia'] = $tra_dt_chegada_ida_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_ida_input_2_mes'] = $tra_dt_chegada_ida_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_ida_input_2_ano'] = $tra_dt_chegada_ida_input_2_ano; 
      if (!empty($tra_dt_chegada_ida_dia) || !empty($tra_dt_chegada_ida_mes) || !empty($tra_dt_chegada_ida_ano) || $tra_dt_chegada_ida_cond_salva == "nu" || $tra_dt_chegada_ida_cond_salva == "nn" || $tra_dt_chegada_ida_cond_salva == "ep" || $tra_dt_chegada_ida_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "D:" . $tra_dt_chegada_ida_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "M:" . $tra_dt_chegada_ida_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "Y:" . $tra_dt_chegada_ida_ano;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][1][] = "D:" . $tra_dt_chegada_ida_input_2_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][1][] = "M:" . $tra_dt_chegada_ida_input_2_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][1][] = "Y:" . $tra_dt_chegada_ida_input_2_ano;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_ida_cond'] = $tra_dt_chegada_ida_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['cmp'] = "tra_dt_chegada_ida"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['opc'] = $tra_dt_chegada_ida_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_chegada_ida'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_localizador_ida'] = $tra_localizador_ida; 
      if (is_array($tra_localizador_ida) && !empty($tra_localizador_ida))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0] = $tra_localizador_ida;
      }
      elseif ($tra_localizador_ida_cond_salva == "nu" || $tra_localizador_ida_cond_salva == "nn" || $tra_localizador_ida_cond_salva == "ep" || $tra_localizador_ida_cond_salva == "ne" || !empty($tra_localizador_ida))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][0] = $tra_localizador_ida;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_localizador_ida_cond'] = $tra_localizador_ida_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['cmp'] = "tra_localizador_ida"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['opc'] = $tra_localizador_ida_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_localizador_ida'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_eticket_ida'] = $tra_eticket_ida; 
      if (is_array($tra_eticket_ida) && !empty($tra_eticket_ida))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0] = $tra_eticket_ida;
      }
      elseif ($tra_eticket_ida_cond_salva == "nu" || $tra_eticket_ida_cond_salva == "nn" || $tra_eticket_ida_cond_salva == "ep" || $tra_eticket_ida_cond_salva == "ne" || !empty($tra_eticket_ida))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][0] = $tra_eticket_ida;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_eticket_ida_cond'] = $tra_eticket_ida_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['cmp'] = "tra_eticket_ida"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['opc'] = $tra_eticket_ida_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_eticket_ida'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_numvoo_volta'] = $tra_numvoo_volta; 
      if (is_array($tra_numvoo_volta) && !empty($tra_numvoo_volta))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0] = $tra_numvoo_volta;
      }
      elseif ($tra_numvoo_volta_cond_salva == "nu" || $tra_numvoo_volta_cond_salva == "nn" || $tra_numvoo_volta_cond_salva == "ep" || $tra_numvoo_volta_cond_salva == "ne" || !empty($tra_numvoo_volta))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][0] = $tra_numvoo_volta;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_numvoo_volta_cond'] = $tra_numvoo_volta_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['cmp'] = "tra_numvoo_volta"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['opc'] = $tra_numvoo_volta_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_numvoo_volta'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_volta_dia'] = $tra_dt_saida_volta_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_volta_mes'] = $tra_dt_saida_volta_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_volta_ano'] = $tra_dt_saida_volta_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_volta_input_2_dia'] = $tra_dt_saida_volta_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_volta_input_2_mes'] = $tra_dt_saida_volta_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_volta_input_2_ano'] = $tra_dt_saida_volta_input_2_ano; 
      if (!empty($tra_dt_saida_volta_dia) || !empty($tra_dt_saida_volta_mes) || !empty($tra_dt_saida_volta_ano) || $tra_dt_saida_volta_cond_salva == "nu" || $tra_dt_saida_volta_cond_salva == "nn" || $tra_dt_saida_volta_cond_salva == "ep" || $tra_dt_saida_volta_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "D:" . $tra_dt_saida_volta_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "M:" . $tra_dt_saida_volta_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "Y:" . $tra_dt_saida_volta_ano;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][1][] = "D:" . $tra_dt_saida_volta_input_2_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][1][] = "M:" . $tra_dt_saida_volta_input_2_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][1][] = "Y:" . $tra_dt_saida_volta_input_2_ano;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_volta_cond'] = $tra_dt_saida_volta_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['cmp'] = "tra_dt_saida_volta"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['opc'] = $tra_dt_saida_volta_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_saida_volta'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_volta_dia'] = $tra_dt_chegada_volta_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_volta_mes'] = $tra_dt_chegada_volta_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_volta_ano'] = $tra_dt_chegada_volta_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_volta_input_2_dia'] = $tra_dt_chegada_volta_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_volta_input_2_mes'] = $tra_dt_chegada_volta_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_volta_input_2_ano'] = $tra_dt_chegada_volta_input_2_ano; 
      if (!empty($tra_dt_chegada_volta_dia) || !empty($tra_dt_chegada_volta_mes) || !empty($tra_dt_chegada_volta_ano) || $tra_dt_chegada_volta_cond_salva == "nu" || $tra_dt_chegada_volta_cond_salva == "nn" || $tra_dt_chegada_volta_cond_salva == "ep" || $tra_dt_chegada_volta_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "D:" . $tra_dt_chegada_volta_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "M:" . $tra_dt_chegada_volta_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "Y:" . $tra_dt_chegada_volta_ano;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][1][] = "D:" . $tra_dt_chegada_volta_input_2_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][1][] = "M:" . $tra_dt_chegada_volta_input_2_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][1][] = "Y:" . $tra_dt_chegada_volta_input_2_ano;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_volta_cond'] = $tra_dt_chegada_volta_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['cmp'] = "tra_dt_chegada_volta"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['opc'] = $tra_dt_chegada_volta_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_chegada_volta'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_localizador_volta'] = $tra_localizador_volta; 
      if (is_array($tra_localizador_volta) && !empty($tra_localizador_volta))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0] = $tra_localizador_volta;
      }
      elseif ($tra_localizador_volta_cond_salva == "nu" || $tra_localizador_volta_cond_salva == "nn" || $tra_localizador_volta_cond_salva == "ep" || $tra_localizador_volta_cond_salva == "ne" || !empty($tra_localizador_volta))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][0] = $tra_localizador_volta;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_localizador_volta_cond'] = $tra_localizador_volta_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['cmp'] = "tra_localizador_volta"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['opc'] = $tra_localizador_volta_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_localizador_volta'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_eticket_volta'] = $tra_eticket_volta; 
      if (is_array($tra_eticket_volta) && !empty($tra_eticket_volta))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0] = $tra_eticket_volta;
      }
      elseif ($tra_eticket_volta_cond_salva == "nu" || $tra_eticket_volta_cond_salva == "nn" || $tra_eticket_volta_cond_salva == "ep" || $tra_eticket_volta_cond_salva == "ne" || !empty($tra_eticket_volta))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][0] = $tra_eticket_volta;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_eticket_volta_cond'] = $tra_eticket_volta_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['cmp'] = "tra_eticket_volta"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['opc'] = $tra_eticket_volta_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_eticket_volta'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_proprio_dia'] = $tra_dt_chegada_proprio_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_proprio_mes'] = $tra_dt_chegada_proprio_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_proprio_ano'] = $tra_dt_chegada_proprio_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_proprio_input_2_dia'] = $tra_dt_chegada_proprio_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_proprio_input_2_mes'] = $tra_dt_chegada_proprio_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_proprio_input_2_ano'] = $tra_dt_chegada_proprio_input_2_ano; 
      if (!empty($tra_dt_chegada_proprio_dia) || !empty($tra_dt_chegada_proprio_mes) || !empty($tra_dt_chegada_proprio_ano) || $tra_dt_chegada_proprio_cond_salva == "nu" || $tra_dt_chegada_proprio_cond_salva == "nn" || $tra_dt_chegada_proprio_cond_salva == "ep" || $tra_dt_chegada_proprio_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "D:" . $tra_dt_chegada_proprio_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "M:" . $tra_dt_chegada_proprio_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "Y:" . $tra_dt_chegada_proprio_ano;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][1][] = "D:" . $tra_dt_chegada_proprio_input_2_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][1][] = "M:" . $tra_dt_chegada_proprio_input_2_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][1][] = "Y:" . $tra_dt_chegada_proprio_input_2_ano;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_proprio_cond'] = $tra_dt_chegada_proprio_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['cmp'] = "tra_dt_chegada_proprio"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['opc'] = $tra_dt_chegada_proprio_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_chegada_proprio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_chegada_proprio_hor'] = $tra_hr_chegada_proprio_hor; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_chegada_proprio_min'] = $tra_hr_chegada_proprio_min; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_chegada_proprio_seg'] = $tra_hr_chegada_proprio_seg; 
      if (!empty($tra_hr_chegada_proprio_hor) || !empty($tra_hr_chegada_proprio_min) || !empty($tra_hr_chegada_proprio_seg) || $tra_hr_chegada_proprio_cond_salva == "nu" || $tra_hr_chegada_proprio_cond_salva == "nn" || $tra_hr_chegada_proprio_cond_salva == "ep" || $tra_hr_chegada_proprio_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "H:" . $tra_hr_chegada_proprio_hor;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "I:" . $tra_hr_chegada_proprio_min;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "S:" . $tra_hr_chegada_proprio_seg;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_chegada_proprio_cond'] = $tra_hr_chegada_proprio_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['cmp'] = "tra_hr_chegada_proprio"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['opc'] = $tra_hr_chegada_proprio_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_hr_chegada_proprio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_volta_local_hor'] = $tra_hr_volta_local_hor; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_volta_local_min'] = $tra_hr_volta_local_min; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_volta_local_seg'] = $tra_hr_volta_local_seg; 
      if (!empty($tra_hr_volta_local_hor) || !empty($tra_hr_volta_local_min) || !empty($tra_hr_volta_local_seg) || $tra_hr_volta_local_cond_salva == "nu" || $tra_hr_volta_local_cond_salva == "nn" || $tra_hr_volta_local_cond_salva == "ep" || $tra_hr_volta_local_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "H:" . $tra_hr_volta_local_hor;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "I:" . $tra_hr_volta_local_min;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "S:" . $tra_hr_volta_local_seg;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_volta_local_cond'] = $tra_hr_volta_local_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['cmp'] = "tra_hr_volta_local"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['opc'] = $tra_hr_volta_local_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_hr_volta_local'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_volta_local_dia'] = $tra_dt_volta_local_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_volta_local_mes'] = $tra_dt_volta_local_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_volta_local_ano'] = $tra_dt_volta_local_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_volta_local_input_2_dia'] = $tra_dt_volta_local_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_volta_local_input_2_mes'] = $tra_dt_volta_local_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_volta_local_input_2_ano'] = $tra_dt_volta_local_input_2_ano; 
      if (!empty($tra_dt_volta_local_dia) || !empty($tra_dt_volta_local_mes) || !empty($tra_dt_volta_local_ano) || $tra_dt_volta_local_cond_salva == "nu" || $tra_dt_volta_local_cond_salva == "nn" || $tra_dt_volta_local_cond_salva == "ep" || $tra_dt_volta_local_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "D:" . $tra_dt_volta_local_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "M:" . $tra_dt_volta_local_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "Y:" . $tra_dt_volta_local_ano;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][1][] = "D:" . $tra_dt_volta_local_input_2_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][1][] = "M:" . $tra_dt_volta_local_input_2_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][1][] = "Y:" . $tra_dt_volta_local_input_2_ano;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_volta_local_cond'] = $tra_dt_volta_local_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['cmp'] = "tra_dt_volta_local"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['opc'] = $tra_dt_volta_local_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_volta_local'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_ida_local_hor'] = $tra_hr_ida_local_hor; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_ida_local_min'] = $tra_hr_ida_local_min; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_ida_local_seg'] = $tra_hr_ida_local_seg; 
      if (!empty($tra_hr_ida_local_hor) || !empty($tra_hr_ida_local_min) || !empty($tra_hr_ida_local_seg) || $tra_hr_ida_local_cond_salva == "nu" || $tra_hr_ida_local_cond_salva == "nn" || $tra_hr_ida_local_cond_salva == "ep" || $tra_hr_ida_local_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "H:" . $tra_hr_ida_local_hor;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "I:" . $tra_hr_ida_local_min;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "S:" . $tra_hr_ida_local_seg;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_ida_local_cond'] = $tra_hr_ida_local_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['cmp'] = "tra_hr_ida_local"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['opc'] = $tra_hr_ida_local_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_hr_ida_local'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_ida_local_dia'] = $tra_dt_ida_local_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_ida_local_mes'] = $tra_dt_ida_local_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_ida_local_ano'] = $tra_dt_ida_local_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_ida_local_input_2_dia'] = $tra_dt_ida_local_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_ida_local_input_2_mes'] = $tra_dt_ida_local_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_ida_local_input_2_ano'] = $tra_dt_ida_local_input_2_ano; 
      if (!empty($tra_dt_ida_local_dia) || !empty($tra_dt_ida_local_mes) || !empty($tra_dt_ida_local_ano) || $tra_dt_ida_local_cond_salva == "nu" || $tra_dt_ida_local_cond_salva == "nn" || $tra_dt_ida_local_cond_salva == "ep" || $tra_dt_ida_local_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "D:" . $tra_dt_ida_local_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "M:" . $tra_dt_ida_local_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][] = "Y:" . $tra_dt_ida_local_ano;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][1][] = "D:" . $tra_dt_ida_local_input_2_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][1][] = "M:" . $tra_dt_ida_local_input_2_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][1][] = "Y:" . $tra_dt_ida_local_input_2_ano;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_ida_local_cond'] = $tra_dt_ida_local_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['cmp'] = "tra_dt_ida_local"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['opc'] = $tra_dt_ida_local_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_ida_local'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['id_transfer'] = $id_transfer; 
      if (is_array($id_transfer) && !empty($id_transfer))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0] = $id_transfer;
      }
      elseif ($id_transfer_cond_salva == "nu" || $id_transfer_cond_salva == "nn" || $id_transfer_cond_salva == "ep" || $id_transfer_cond_salva == "ne" || !empty($id_transfer))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][0] = $id_transfer;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['id_transfer_cond'] = $id_transfer_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['cmp'] = "id_transfer"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['opc'] = $id_transfer_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['id_transfer'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_id_bloqueio'] = $tra_id_bloqueio; 
      if (is_array($tra_id_bloqueio) && !empty($tra_id_bloqueio))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0] = $tra_id_bloqueio;
      }
      elseif ($tra_id_bloqueio_cond_salva == "nu" || $tra_id_bloqueio_cond_salva == "nn" || $tra_id_bloqueio_cond_salva == "ep" || $tra_id_bloqueio_cond_salva == "ne" || !empty($tra_id_bloqueio))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][0] = $tra_id_bloqueio;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_id_bloqueio_cond'] = $tra_id_bloqueio_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['cmp'] = "tra_id_bloqueio"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['opc'] = $tra_id_bloqueio_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_id_bloqueio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_id_evento'] = $tra_id_evento; 
      if (is_array($tra_id_evento) && !empty($tra_id_evento))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0] = $tra_id_evento;
      }
      elseif ($tra_id_evento_cond_salva == "nu" || $tra_id_evento_cond_salva == "nn" || $tra_id_evento_cond_salva == "ep" || $tra_id_evento_cond_salva == "ne" || !empty($tra_id_evento))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][0] = $tra_id_evento;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_id_evento_cond'] = $tra_id_evento_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['cmp'] = "tra_id_evento"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['opc'] = $tra_id_evento_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_id_evento'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_id_aereo'] = $tra_id_aereo; 
      if (is_array($tra_id_aereo) && !empty($tra_id_aereo))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0] = $tra_id_aereo;
      }
      elseif ($tra_id_aereo_cond_salva == "nu" || $tra_id_aereo_cond_salva == "nn" || $tra_id_aereo_cond_salva == "ep" || $tra_id_aereo_cond_salva == "ne" || !empty($tra_id_aereo))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['val'][0][0] = $tra_id_aereo;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_id_aereo_cond'] = $tra_id_aereo_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['cmp'] = "tra_id_aereo"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid]['opc'] = $tra_id_aereo_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_id_aereo'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['NM_operador'] = $this->NM_operador; 
      if ($this->NM_ajax_flag && $this->NM_ajax_opcao == "ajax_grid_search")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca'] = $Temp_Busca;
      }
      if (!empty($this->Campos_Mens_erro)) 
      {
          return;
      }
      $nmgp_def_dados = array();
    if ($tra_cpf_particip != '') {
      $tra_cpf_particip_look = (is_string($tra_cpf_particip) ? substr($this->Db->qstr($tra_cpf_particip), 1, -1) : $tra_cpf_particip); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_cpf_particip from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and #lowerI#tra_cpf_particip#lowerF# = #lowerI#'$tra_cpf_particip_look'#lowerF# order by tra_cpf_particip"; 
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
          $this->cmp_formatado['tra_cpf_particip'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tra_cpf_particip'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['tra_cpf_particip'] = $tra_cpf_particip;
      }
      $this->cmp_formatado['tra_cpf_particip'] = "'" . $this->cmp_formatado['tra_cpf_particip'] . "'";
      if (isset($this->cmp_formatado['tra_cpf_particip_input_2'])  && !empty($this->cmp_formatado['tra_cpf_particip_input_2'])) {
          $this->cmp_formatado['tra_cpf_particip_input_2'] = "'" . $this->cmp_formatado['tra_cpf_particip_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($tra_tipo_pessoa != '') {
      $tra_tipo_pessoa_look = (is_string($tra_tipo_pessoa) ? substr($this->Db->qstr($tra_tipo_pessoa), 1, -1) : $tra_tipo_pessoa); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_tipo_pessoa from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and #lowerI#tra_tipo_pessoa#lowerF# = #lowerI#'$tra_tipo_pessoa_look'#lowerF# order by tra_tipo_pessoa"; 
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
          $this->cmp_formatado['tra_tipo_pessoa'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tra_tipo_pessoa'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['tra_tipo_pessoa'] = $tra_tipo_pessoa;
      }
      $this->cmp_formatado['tra_tipo_pessoa'] = "'" . $this->cmp_formatado['tra_tipo_pessoa'] . "'";
      if (isset($this->cmp_formatado['tra_tipo_pessoa_input_2'])  && !empty($this->cmp_formatado['tra_tipo_pessoa_input_2'])) {
          $this->cmp_formatado['tra_tipo_pessoa_input_2'] = "'" . $this->cmp_formatado['tra_tipo_pessoa_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($tra_tipo != '') {
      $tra_tipo_look = (is_string($tra_tipo) ? substr($this->Db->qstr($tra_tipo), 1, -1) : $tra_tipo); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_tipo from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and #lowerI#tra_tipo#lowerF# = #lowerI#'$tra_tipo_look'#lowerF# order by tra_tipo"; 
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
          $this->cmp_formatado['tra_tipo'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tra_tipo'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['tra_tipo'] = $tra_tipo;
      }
      $this->cmp_formatado['tra_tipo'] = "'" . $this->cmp_formatado['tra_tipo'] . "'";
      if (isset($this->cmp_formatado['tra_tipo_input_2'])  && !empty($this->cmp_formatado['tra_tipo_input_2'])) {
          $this->cmp_formatado['tra_tipo_input_2'] = "'" . $this->cmp_formatado['tra_tipo_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($tra_status != '') {
      $tra_status_look = (is_string($tra_status) ? substr($this->Db->qstr($tra_status), 1, -1) : $tra_status); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_status from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and #lowerI#tra_status#lowerF# = #lowerI#'$tra_status_look'#lowerF# order by tra_status"; 
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
          $this->cmp_formatado['tra_status'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tra_status'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['tra_status'] = $tra_status;
      }
      $this->cmp_formatado['tra_status'] = "'" . $this->cmp_formatado['tra_status'] . "'";
      if (isset($this->cmp_formatado['tra_status_input_2'])  && !empty($this->cmp_formatado['tra_status_input_2'])) {
          $this->cmp_formatado['tra_status_input_2'] = "'" . $this->cmp_formatado['tra_status_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($tra_direcao != '') {
      $tra_direcao_look = (is_string($tra_direcao) ? substr($this->Db->qstr($tra_direcao), 1, -1) : $tra_direcao); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_direcao from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and #lowerI#tra_direcao#lowerF# = #lowerI#'$tra_direcao_look'#lowerF# order by tra_direcao"; 
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
          $this->cmp_formatado['tra_direcao'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tra_direcao'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['tra_direcao'] = $tra_direcao;
      }
      $this->cmp_formatado['tra_direcao'] = "'" . $this->cmp_formatado['tra_direcao'] . "'";
      if (isset($this->cmp_formatado['tra_direcao_input_2'])  && !empty($this->cmp_formatado['tra_direcao_input_2'])) {
          $this->cmp_formatado['tra_direcao_input_2'] = "'" . $this->cmp_formatado['tra_direcao_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($tra_numvoo_ida != '') {
      $tra_numvoo_ida_look = (is_string($tra_numvoo_ida) ? substr($this->Db->qstr($tra_numvoo_ida), 1, -1) : $tra_numvoo_ida); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_numvoo_ida from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and #lowerI#tra_numvoo_ida#lowerF# = #lowerI#'$tra_numvoo_ida_look'#lowerF# order by tra_numvoo_ida"; 
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
          $this->cmp_formatado['tra_numvoo_ida'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tra_numvoo_ida'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['tra_numvoo_ida'] = $tra_numvoo_ida;
      }
      $this->cmp_formatado['tra_numvoo_ida'] = "'" . $this->cmp_formatado['tra_numvoo_ida'] . "'";
      if (isset($this->cmp_formatado['tra_numvoo_ida_input_2'])  && !empty($this->cmp_formatado['tra_numvoo_ida_input_2'])) {
          $this->cmp_formatado['tra_numvoo_ida_input_2'] = "'" . $this->cmp_formatado['tra_numvoo_ida_input_2'] . "'";
      }
      $this->cmp_formatado['tra_dt_saida_ida'] = "'" . $this->cmp_formatado['tra_dt_saida_ida'] . "'";
      if (isset($this->cmp_formatado['tra_dt_saida_ida_input_2'])  && !empty($this->cmp_formatado['tra_dt_saida_ida_input_2'])) {
          $this->cmp_formatado['tra_dt_saida_ida_input_2'] = "'" . $this->cmp_formatado['tra_dt_saida_ida_input_2'] . "'";
      }
      $this->cmp_formatado['tra_dt_chegada_ida'] = "'" . $this->cmp_formatado['tra_dt_chegada_ida'] . "'";
      if (isset($this->cmp_formatado['tra_dt_chegada_ida_input_2'])  && !empty($this->cmp_formatado['tra_dt_chegada_ida_input_2'])) {
          $this->cmp_formatado['tra_dt_chegada_ida_input_2'] = "'" . $this->cmp_formatado['tra_dt_chegada_ida_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($tra_localizador_ida != '') {
      $tra_localizador_ida_look = (is_string($tra_localizador_ida) ? substr($this->Db->qstr($tra_localizador_ida), 1, -1) : $tra_localizador_ida); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_localizador_ida from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and #lowerI#tra_localizador_ida#lowerF# = #lowerI#'$tra_localizador_ida_look'#lowerF# order by tra_localizador_ida"; 
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
          $this->cmp_formatado['tra_localizador_ida'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tra_localizador_ida'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['tra_localizador_ida'] = $tra_localizador_ida;
      }
      $this->cmp_formatado['tra_localizador_ida'] = "'" . $this->cmp_formatado['tra_localizador_ida'] . "'";
      if (isset($this->cmp_formatado['tra_localizador_ida_input_2'])  && !empty($this->cmp_formatado['tra_localizador_ida_input_2'])) {
          $this->cmp_formatado['tra_localizador_ida_input_2'] = "'" . $this->cmp_formatado['tra_localizador_ida_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($tra_eticket_ida != '') {
      $tra_eticket_ida_look = (is_string($tra_eticket_ida) ? substr($this->Db->qstr($tra_eticket_ida), 1, -1) : $tra_eticket_ida); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_eticket_ida from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and #lowerI#tra_eticket_ida#lowerF# = #lowerI#'$tra_eticket_ida_look'#lowerF# order by tra_eticket_ida"; 
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
          $this->cmp_formatado['tra_eticket_ida'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tra_eticket_ida'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['tra_eticket_ida'] = $tra_eticket_ida;
      }
      $this->cmp_formatado['tra_eticket_ida'] = "'" . $this->cmp_formatado['tra_eticket_ida'] . "'";
      if (isset($this->cmp_formatado['tra_eticket_ida_input_2'])  && !empty($this->cmp_formatado['tra_eticket_ida_input_2'])) {
          $this->cmp_formatado['tra_eticket_ida_input_2'] = "'" . $this->cmp_formatado['tra_eticket_ida_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($tra_numvoo_volta != '') {
      $tra_numvoo_volta_look = (is_string($tra_numvoo_volta) ? substr($this->Db->qstr($tra_numvoo_volta), 1, -1) : $tra_numvoo_volta); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_numvoo_volta from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and #lowerI#tra_numvoo_volta#lowerF# = #lowerI#'$tra_numvoo_volta_look'#lowerF# order by tra_numvoo_volta"; 
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
          $this->cmp_formatado['tra_numvoo_volta'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tra_numvoo_volta'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['tra_numvoo_volta'] = $tra_numvoo_volta;
      }
      $this->cmp_formatado['tra_numvoo_volta'] = "'" . $this->cmp_formatado['tra_numvoo_volta'] . "'";
      if (isset($this->cmp_formatado['tra_numvoo_volta_input_2'])  && !empty($this->cmp_formatado['tra_numvoo_volta_input_2'])) {
          $this->cmp_formatado['tra_numvoo_volta_input_2'] = "'" . $this->cmp_formatado['tra_numvoo_volta_input_2'] . "'";
      }
      $this->cmp_formatado['tra_dt_saida_volta'] = "'" . $this->cmp_formatado['tra_dt_saida_volta'] . "'";
      if (isset($this->cmp_formatado['tra_dt_saida_volta_input_2'])  && !empty($this->cmp_formatado['tra_dt_saida_volta_input_2'])) {
          $this->cmp_formatado['tra_dt_saida_volta_input_2'] = "'" . $this->cmp_formatado['tra_dt_saida_volta_input_2'] . "'";
      }
      $this->cmp_formatado['tra_dt_chegada_volta'] = "'" . $this->cmp_formatado['tra_dt_chegada_volta'] . "'";
      if (isset($this->cmp_formatado['tra_dt_chegada_volta_input_2'])  && !empty($this->cmp_formatado['tra_dt_chegada_volta_input_2'])) {
          $this->cmp_formatado['tra_dt_chegada_volta_input_2'] = "'" . $this->cmp_formatado['tra_dt_chegada_volta_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($tra_localizador_volta != '') {
      $tra_localizador_volta_look = (is_string($tra_localizador_volta) ? substr($this->Db->qstr($tra_localizador_volta), 1, -1) : $tra_localizador_volta); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_localizador_volta from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and #lowerI#tra_localizador_volta#lowerF# = #lowerI#'$tra_localizador_volta_look'#lowerF# order by tra_localizador_volta"; 
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
          $this->cmp_formatado['tra_localizador_volta'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tra_localizador_volta'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['tra_localizador_volta'] = $tra_localizador_volta;
      }
      $this->cmp_formatado['tra_localizador_volta'] = "'" . $this->cmp_formatado['tra_localizador_volta'] . "'";
      if (isset($this->cmp_formatado['tra_localizador_volta_input_2'])  && !empty($this->cmp_formatado['tra_localizador_volta_input_2'])) {
          $this->cmp_formatado['tra_localizador_volta_input_2'] = "'" . $this->cmp_formatado['tra_localizador_volta_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($tra_eticket_volta != '') {
      $tra_eticket_volta_look = (is_string($tra_eticket_volta) ? substr($this->Db->qstr($tra_eticket_volta), 1, -1) : $tra_eticket_volta); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tra_eticket_volta from " . $this->Ini->nm_tabela . " where (tra_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND tra_cpf_particip = '" . $_SESSION['vg_cpf'] . "') and #lowerI#tra_eticket_volta#lowerF# = #lowerI#'$tra_eticket_volta_look'#lowerF# order by tra_eticket_volta"; 
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
          $this->cmp_formatado['tra_eticket_volta'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tra_eticket_volta'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['tra_eticket_volta'] = $tra_eticket_volta;
      }
      $this->cmp_formatado['tra_eticket_volta'] = "'" . $this->cmp_formatado['tra_eticket_volta'] . "'";
      if (isset($this->cmp_formatado['tra_eticket_volta_input_2'])  && !empty($this->cmp_formatado['tra_eticket_volta_input_2'])) {
          $this->cmp_formatado['tra_eticket_volta_input_2'] = "'" . $this->cmp_formatado['tra_eticket_volta_input_2'] . "'";
      }
      $this->cmp_formatado['tra_dt_chegada_proprio'] = "'" . $this->cmp_formatado['tra_dt_chegada_proprio'] . "'";
      if (isset($this->cmp_formatado['tra_dt_chegada_proprio_input_2'])  && !empty($this->cmp_formatado['tra_dt_chegada_proprio_input_2'])) {
          $this->cmp_formatado['tra_dt_chegada_proprio_input_2'] = "'" . $this->cmp_formatado['tra_dt_chegada_proprio_input_2'] . "'";
      }
      $this->cmp_formatado['tra_hr_chegada_proprio'] = "'" . $this->cmp_formatado['tra_hr_chegada_proprio'] . "'";
      if (isset($this->cmp_formatado['tra_hr_chegada_proprio_input_2'])  && !empty($this->cmp_formatado['tra_hr_chegada_proprio_input_2'])) {
          $this->cmp_formatado['tra_hr_chegada_proprio_input_2'] = "'" . $this->cmp_formatado['tra_hr_chegada_proprio_input_2'] . "'";
      }
      $this->cmp_formatado['tra_hr_volta_local'] = "'" . $this->cmp_formatado['tra_hr_volta_local'] . "'";
      if (isset($this->cmp_formatado['tra_hr_volta_local_input_2'])  && !empty($this->cmp_formatado['tra_hr_volta_local_input_2'])) {
          $this->cmp_formatado['tra_hr_volta_local_input_2'] = "'" . $this->cmp_formatado['tra_hr_volta_local_input_2'] . "'";
      }
      $this->cmp_formatado['tra_dt_volta_local'] = "'" . $this->cmp_formatado['tra_dt_volta_local'] . "'";
      if (isset($this->cmp_formatado['tra_dt_volta_local_input_2'])  && !empty($this->cmp_formatado['tra_dt_volta_local_input_2'])) {
          $this->cmp_formatado['tra_dt_volta_local_input_2'] = "'" . $this->cmp_formatado['tra_dt_volta_local_input_2'] . "'";
      }
      $this->cmp_formatado['tra_hr_ida_local'] = "'" . $this->cmp_formatado['tra_hr_ida_local'] . "'";
      if (isset($this->cmp_formatado['tra_hr_ida_local_input_2'])  && !empty($this->cmp_formatado['tra_hr_ida_local_input_2'])) {
          $this->cmp_formatado['tra_hr_ida_local_input_2'] = "'" . $this->cmp_formatado['tra_hr_ida_local_input_2'] . "'";
      }
      $this->cmp_formatado['tra_dt_ida_local'] = "'" . $this->cmp_formatado['tra_dt_ida_local'] . "'";
      if (isset($this->cmp_formatado['tra_dt_ida_local_input_2'])  && !empty($this->cmp_formatado['tra_dt_ida_local_input_2'])) {
          $this->cmp_formatado['tra_dt_ida_local_input_2'] = "'" . $this->cmp_formatado['tra_dt_ida_local_input_2'] . "'";
      }
      $Conteudo = $id_transfer;
      if (strtoupper($id_transfer_cond) != "II" && strtoupper($id_transfer_cond) != "QP" && strtoupper($id_transfer_cond) != "NP" && strtoupper($id_transfer_cond) != "IN") 
      { 
          nmgp_Form_Num_Val($Conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      } 
      $this->cmp_formatado['id_transfer'] = $Conteudo;
      $this->cmp_formatado['id_transfer'] = "'" . $this->cmp_formatado['id_transfer'] . "'";
      if (isset($this->cmp_formatado['id_transfer_input_2'])  && !empty($this->cmp_formatado['id_transfer_input_2'])) {
          $this->cmp_formatado['id_transfer_input_2'] = "'" . $this->cmp_formatado['id_transfer_input_2'] . "'";
      }
      $Conteudo = $tra_id_bloqueio;
      if (strtoupper($tra_id_bloqueio_cond) != "II" && strtoupper($tra_id_bloqueio_cond) != "QP" && strtoupper($tra_id_bloqueio_cond) != "NP" && strtoupper($tra_id_bloqueio_cond) != "IN") 
      { 
          nmgp_Form_Num_Val($Conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      } 
      $this->cmp_formatado['tra_id_bloqueio'] = $Conteudo;
      $this->cmp_formatado['tra_id_bloqueio'] = "'" . $this->cmp_formatado['tra_id_bloqueio'] . "'";
      if (isset($this->cmp_formatado['tra_id_bloqueio_input_2'])  && !empty($this->cmp_formatado['tra_id_bloqueio_input_2'])) {
          $this->cmp_formatado['tra_id_bloqueio_input_2'] = "'" . $this->cmp_formatado['tra_id_bloqueio_input_2'] . "'";
      }
      $Conteudo = $tra_id_evento;
      if (strtoupper($tra_id_evento_cond) != "II" && strtoupper($tra_id_evento_cond) != "QP" && strtoupper($tra_id_evento_cond) != "NP" && strtoupper($tra_id_evento_cond) != "IN") 
      { 
          nmgp_Form_Num_Val($Conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      } 
      $this->cmp_formatado['tra_id_evento'] = $Conteudo;
      $this->cmp_formatado['tra_id_evento'] = "'" . $this->cmp_formatado['tra_id_evento'] . "'";
      if (isset($this->cmp_formatado['tra_id_evento_input_2'])  && !empty($this->cmp_formatado['tra_id_evento_input_2'])) {
          $this->cmp_formatado['tra_id_evento_input_2'] = "'" . $this->cmp_formatado['tra_id_evento_input_2'] . "'";
      }
      $Conteudo = $tra_id_aereo;
      if (strtoupper($tra_id_aereo_cond) != "II" && strtoupper($tra_id_aereo_cond) != "QP" && strtoupper($tra_id_aereo_cond) != "NP" && strtoupper($tra_id_aereo_cond) != "IN") 
      { 
          nmgp_Form_Num_Val($Conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      } 
      $this->cmp_formatado['tra_id_aereo'] = $Conteudo;
      $this->cmp_formatado['tra_id_aereo'] = "'" . $this->cmp_formatado['tra_id_aereo'] . "'";
      if (isset($this->cmp_formatado['tra_id_aereo_input_2'])  && !empty($this->cmp_formatado['tra_id_aereo_input_2'])) {
          $this->cmp_formatado['tra_id_aereo_input_2'] = "'" . $this->cmp_formatado['tra_id_aereo_input_2'] . "'";
      }
   }

   function processa_campos($Res_comp='pesq')
   {
      global $tra_cpf_particip_cond, $tra_cpf_particip, $tra_cpf_particip_autocomp,
             $tra_tipo_pessoa_cond, $tra_tipo_pessoa, $tra_tipo_pessoa_autocomp,
             $tra_tipo_cond, $tra_tipo, $tra_tipo_autocomp,
             $tra_status_cond, $tra_status, $tra_status_autocomp,
             $tra_direcao_cond, $tra_direcao, $tra_direcao_autocomp,
             $tra_numvoo_ida_cond, $tra_numvoo_ida, $tra_numvoo_ida_autocomp,
             $tra_dt_saida_ida_cond, $tra_dt_saida_ida, $tra_dt_saida_ida_dia, $tra_dt_saida_ida_mes, $tra_dt_saida_ida_ano, $tra_dt_saida_ida_input_2_dia, $tra_dt_saida_ida_input_2_mes, $tra_dt_saida_ida_input_2_ano,
             $tra_dt_chegada_ida_cond, $tra_dt_chegada_ida, $tra_dt_chegada_ida_dia, $tra_dt_chegada_ida_mes, $tra_dt_chegada_ida_ano, $tra_dt_chegada_ida_input_2_dia, $tra_dt_chegada_ida_input_2_mes, $tra_dt_chegada_ida_input_2_ano,
             $tra_localizador_ida_cond, $tra_localizador_ida, $tra_localizador_ida_autocomp,
             $tra_eticket_ida_cond, $tra_eticket_ida, $tra_eticket_ida_autocomp,
             $tra_numvoo_volta_cond, $tra_numvoo_volta, $tra_numvoo_volta_autocomp,
             $tra_dt_saida_volta_cond, $tra_dt_saida_volta, $tra_dt_saida_volta_dia, $tra_dt_saida_volta_mes, $tra_dt_saida_volta_ano, $tra_dt_saida_volta_input_2_dia, $tra_dt_saida_volta_input_2_mes, $tra_dt_saida_volta_input_2_ano,
             $tra_dt_chegada_volta_cond, $tra_dt_chegada_volta, $tra_dt_chegada_volta_dia, $tra_dt_chegada_volta_mes, $tra_dt_chegada_volta_ano, $tra_dt_chegada_volta_input_2_dia, $tra_dt_chegada_volta_input_2_mes, $tra_dt_chegada_volta_input_2_ano,
             $tra_localizador_volta_cond, $tra_localizador_volta, $tra_localizador_volta_autocomp,
             $tra_eticket_volta_cond, $tra_eticket_volta, $tra_eticket_volta_autocomp,
             $tra_dt_chegada_proprio_cond, $tra_dt_chegada_proprio, $tra_dt_chegada_proprio_dia, $tra_dt_chegada_proprio_mes, $tra_dt_chegada_proprio_ano, $tra_dt_chegada_proprio_input_2_dia, $tra_dt_chegada_proprio_input_2_mes, $tra_dt_chegada_proprio_input_2_ano,
             $tra_hr_chegada_proprio_cond, $tra_hr_chegada_proprio, $tra_hr_chegada_proprio_hor, $tra_hr_chegada_proprio_min, $tra_hr_chegada_proprio_seg,
             $tra_hr_volta_local_cond, $tra_hr_volta_local, $tra_hr_volta_local_hor, $tra_hr_volta_local_min, $tra_hr_volta_local_seg,
             $tra_dt_volta_local_cond, $tra_dt_volta_local, $tra_dt_volta_local_dia, $tra_dt_volta_local_mes, $tra_dt_volta_local_ano, $tra_dt_volta_local_input_2_dia, $tra_dt_volta_local_input_2_mes, $tra_dt_volta_local_input_2_ano,
             $tra_hr_ida_local_cond, $tra_hr_ida_local, $tra_hr_ida_local_hor, $tra_hr_ida_local_min, $tra_hr_ida_local_seg,
             $tra_dt_ida_local_cond, $tra_dt_ida_local, $tra_dt_ida_local_dia, $tra_dt_ida_local_mes, $tra_dt_ida_local_ano, $tra_dt_ida_local_input_2_dia, $tra_dt_ida_local_input_2_mes, $tra_dt_ida_local_input_2_ano,
             $id_transfer_cond, $id_transfer,
             $tra_id_bloqueio_cond, $tra_id_bloqueio,
             $tra_id_evento_cond, $tra_id_evento,
             $tra_id_aereo_cond, $tra_id_aereo, $nmgp_tab_label;


      //----- $tra_cpf_particip
      $this->Date_part = false;
      if (isset($tra_cpf_particip) || $tra_cpf_particip_cond == "nu" || $tra_cpf_particip_cond == "nn" || $tra_cpf_particip_cond == "ep" || $tra_cpf_particip_cond == "ne")
      {
         $this->monta_condicao("tra_cpf_particip", $tra_cpf_particip_cond, $tra_cpf_particip, "", "tra_cpf_particip", "VARCHAR", false);
      }

      //----- $tra_tipo_pessoa
      $this->Date_part = false;
      if (isset($tra_tipo_pessoa) || $tra_tipo_pessoa_cond == "nu" || $tra_tipo_pessoa_cond == "nn" || $tra_tipo_pessoa_cond == "ep" || $tra_tipo_pessoa_cond == "ne")
      {
         $this->monta_condicao("tra_tipo_pessoa", $tra_tipo_pessoa_cond, $tra_tipo_pessoa, "", "tra_tipo_pessoa", "VARCHAR", false);
      }

      //----- $tra_tipo
      $this->Date_part = false;
      if (isset($tra_tipo) || $tra_tipo_cond == "nu" || $tra_tipo_cond == "nn" || $tra_tipo_cond == "ep" || $tra_tipo_cond == "ne")
      {
         $this->monta_condicao("tra_tipo", $tra_tipo_cond, $tra_tipo, "", "tra_tipo", "ENUM", false);
      }

      //----- $tra_status
      $this->Date_part = false;
      if (isset($tra_status) || $tra_status_cond == "nu" || $tra_status_cond == "nn" || $tra_status_cond == "ep" || $tra_status_cond == "ne")
      {
         $this->monta_condicao("tra_status", $tra_status_cond, $tra_status, "", "tra_status", "ENUM", false);
      }

      //----- $tra_direcao
      $this->Date_part = false;
      if (isset($tra_direcao) || $tra_direcao_cond == "nu" || $tra_direcao_cond == "nn" || $tra_direcao_cond == "ep" || $tra_direcao_cond == "ne")
      {
         $this->monta_condicao("tra_direcao", $tra_direcao_cond, $tra_direcao, "", "tra_direcao", "ENUM", false);
      }

      //----- $tra_numvoo_ida
      $this->Date_part = false;
      if (isset($tra_numvoo_ida) || $tra_numvoo_ida_cond == "nu" || $tra_numvoo_ida_cond == "nn" || $tra_numvoo_ida_cond == "ep" || $tra_numvoo_ida_cond == "ne")
      {
         $this->monta_condicao("tra_numvoo_ida", $tra_numvoo_ida_cond, $tra_numvoo_ida, "", "tra_numvoo_ida", "VARCHAR", false);
      }

      //----- $tra_dt_saida_ida
      $this->Date_part = false;
      if ($tra_dt_saida_ida_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $tra_dt_saida_ida_cond = strtoupper($tra_dt_saida_ida_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $tra_dt_saida_ida_ano;
          $Dtxt .= $tra_dt_saida_ida_mes;
          $Dtxt .= $tra_dt_saida_ida_dia;
          $val[0]['ano'] = $tra_dt_saida_ida_ano;
          $val[0]['mes'] = $tra_dt_saida_ida_mes;
          $val[0]['dia'] = $tra_dt_saida_ida_dia;
          if ($tra_dt_saida_ida_cond == "BW")
          {
              $val[1]['ano'] = $tra_dt_saida_ida_input_2_ano;
              $val[1]['mes'] = $tra_dt_saida_ida_input_2_mes;
              $val[1]['dia'] = $tra_dt_saida_ida_input_2_dia;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->nm_prep_date($val, "DT", "DATETIME", $tra_dt_saida_ida_cond, "", "data");
          }
          else
          {
              $this->nm_prep_date($val, "DT", "DATE", $tra_dt_saida_ida_cond, "", "data");
          }
          if (!$this->Date_part) {
              $val[0] = $this->Ini->sc_Date_Protect($val[0]);
          }
          $tra_dt_saida_ida = $val[0];
          $this->cmp_formatado['tra_dt_saida_ida'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_ida'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['tra_dt_saida_ida'], "YYYY-MM-DD");
          $this->cmp_formatado['tra_dt_saida_ida'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['tra_dt_saida_ida'] = "'" . $this->cmp_formatado['tra_dt_saida_ida'] . "'";
          if ($tra_dt_saida_ida_cond == "BW")
          {
              if (!$this->Date_part) {
                  $val[1] = $this->Ini->sc_Date_Protect($val[1]);
              }
              $tra_dt_saida_ida_input_2     = $val[1];
              $this->cmp_formatado['tra_dt_saida_ida_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_ida_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['tra_dt_saida_ida_input_2'], "YYYY-MM-DD");
              $this->cmp_formatado['tra_dt_saida_ida_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['tra_dt_saida_ida_input_2'] = "'" . $this->cmp_formatado['tra_dt_saida_ida_input_2'] . "'";
          }
          if (!empty($Dtxt) || $tra_dt_saida_ida_cond == "NU" || $tra_dt_saida_ida_cond == "NN"|| $tra_dt_saida_ida_cond == "EP"|| $tra_dt_saida_ida_cond == "NE")
          {
              $this->monta_condicao("tra_dt_saida_ida", $tra_dt_saida_ida_cond, $tra_dt_saida_ida, $tra_dt_saida_ida_input_2, 'tra_dt_saida_ida', 'DATE');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_saida_ida']['label'] = $nmgp_tab_label['tra_dt_saida_ida'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_saida_ida']['descr'] = $nmgp_tab_label['tra_dt_saida_ida'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_saida_ida']['hint']  = $nmgp_tab_label['tra_dt_saida_ida'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $tra_dt_chegada_ida
      $this->Date_part = false;
      if ($tra_dt_chegada_ida_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $tra_dt_chegada_ida_cond = strtoupper($tra_dt_chegada_ida_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $tra_dt_chegada_ida_ano;
          $Dtxt .= $tra_dt_chegada_ida_mes;
          $Dtxt .= $tra_dt_chegada_ida_dia;
          $val[0]['ano'] = $tra_dt_chegada_ida_ano;
          $val[0]['mes'] = $tra_dt_chegada_ida_mes;
          $val[0]['dia'] = $tra_dt_chegada_ida_dia;
          if ($tra_dt_chegada_ida_cond == "BW")
          {
              $val[1]['ano'] = $tra_dt_chegada_ida_input_2_ano;
              $val[1]['mes'] = $tra_dt_chegada_ida_input_2_mes;
              $val[1]['dia'] = $tra_dt_chegada_ida_input_2_dia;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->nm_prep_date($val, "DT", "DATETIME", $tra_dt_chegada_ida_cond, "", "data");
          }
          else
          {
              $this->nm_prep_date($val, "DT", "DATE", $tra_dt_chegada_ida_cond, "", "data");
          }
          if (!$this->Date_part) {
              $val[0] = $this->Ini->sc_Date_Protect($val[0]);
          }
          $tra_dt_chegada_ida = $val[0];
          $this->cmp_formatado['tra_dt_chegada_ida'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_ida'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['tra_dt_chegada_ida'], "YYYY-MM-DD");
          $this->cmp_formatado['tra_dt_chegada_ida'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['tra_dt_chegada_ida'] = "'" . $this->cmp_formatado['tra_dt_chegada_ida'] . "'";
          if ($tra_dt_chegada_ida_cond == "BW")
          {
              if (!$this->Date_part) {
                  $val[1] = $this->Ini->sc_Date_Protect($val[1]);
              }
              $tra_dt_chegada_ida_input_2     = $val[1];
              $this->cmp_formatado['tra_dt_chegada_ida_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_ida_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['tra_dt_chegada_ida_input_2'], "YYYY-MM-DD");
              $this->cmp_formatado['tra_dt_chegada_ida_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['tra_dt_chegada_ida_input_2'] = "'" . $this->cmp_formatado['tra_dt_chegada_ida_input_2'] . "'";
          }
          if (!empty($Dtxt) || $tra_dt_chegada_ida_cond == "NU" || $tra_dt_chegada_ida_cond == "NN"|| $tra_dt_chegada_ida_cond == "EP"|| $tra_dt_chegada_ida_cond == "NE")
          {
              $this->monta_condicao("tra_dt_chegada_ida", $tra_dt_chegada_ida_cond, $tra_dt_chegada_ida, $tra_dt_chegada_ida_input_2, 'tra_dt_chegada_ida', 'DATE');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_chegada_ida']['label'] = $nmgp_tab_label['tra_dt_chegada_ida'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_chegada_ida']['descr'] = $nmgp_tab_label['tra_dt_chegada_ida'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_chegada_ida']['hint']  = $nmgp_tab_label['tra_dt_chegada_ida'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $tra_localizador_ida
      $this->Date_part = false;
      if (isset($tra_localizador_ida) || $tra_localizador_ida_cond == "nu" || $tra_localizador_ida_cond == "nn" || $tra_localizador_ida_cond == "ep" || $tra_localizador_ida_cond == "ne")
      {
         $this->monta_condicao("tra_localizador_ida", $tra_localizador_ida_cond, $tra_localizador_ida, "", "tra_localizador_ida", "VARCHAR", false);
      }

      //----- $tra_eticket_ida
      $this->Date_part = false;
      if (isset($tra_eticket_ida) || $tra_eticket_ida_cond == "nu" || $tra_eticket_ida_cond == "nn" || $tra_eticket_ida_cond == "ep" || $tra_eticket_ida_cond == "ne")
      {
         $this->monta_condicao("tra_eticket_ida", $tra_eticket_ida_cond, $tra_eticket_ida, "", "tra_eticket_ida", "VARCHAR", false);
      }

      //----- $tra_numvoo_volta
      $this->Date_part = false;
      if (isset($tra_numvoo_volta) || $tra_numvoo_volta_cond == "nu" || $tra_numvoo_volta_cond == "nn" || $tra_numvoo_volta_cond == "ep" || $tra_numvoo_volta_cond == "ne")
      {
         $this->monta_condicao("tra_numvoo_volta", $tra_numvoo_volta_cond, $tra_numvoo_volta, "", "tra_numvoo_volta", "VARCHAR", false);
      }

      //----- $tra_dt_saida_volta
      $this->Date_part = false;
      if ($tra_dt_saida_volta_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $tra_dt_saida_volta_cond = strtoupper($tra_dt_saida_volta_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $tra_dt_saida_volta_ano;
          $Dtxt .= $tra_dt_saida_volta_mes;
          $Dtxt .= $tra_dt_saida_volta_dia;
          $val[0]['ano'] = $tra_dt_saida_volta_ano;
          $val[0]['mes'] = $tra_dt_saida_volta_mes;
          $val[0]['dia'] = $tra_dt_saida_volta_dia;
          if ($tra_dt_saida_volta_cond == "BW")
          {
              $val[1]['ano'] = $tra_dt_saida_volta_input_2_ano;
              $val[1]['mes'] = $tra_dt_saida_volta_input_2_mes;
              $val[1]['dia'] = $tra_dt_saida_volta_input_2_dia;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->nm_prep_date($val, "DT", "DATETIME", $tra_dt_saida_volta_cond, "", "data");
          }
          else
          {
              $this->nm_prep_date($val, "DT", "DATE", $tra_dt_saida_volta_cond, "", "data");
          }
          if (!$this->Date_part) {
              $val[0] = $this->Ini->sc_Date_Protect($val[0]);
          }
          $tra_dt_saida_volta = $val[0];
          $this->cmp_formatado['tra_dt_saida_volta'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_volta'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['tra_dt_saida_volta'], "YYYY-MM-DD");
          $this->cmp_formatado['tra_dt_saida_volta'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['tra_dt_saida_volta'] = "'" . $this->cmp_formatado['tra_dt_saida_volta'] . "'";
          if ($tra_dt_saida_volta_cond == "BW")
          {
              if (!$this->Date_part) {
                  $val[1] = $this->Ini->sc_Date_Protect($val[1]);
              }
              $tra_dt_saida_volta_input_2     = $val[1];
              $this->cmp_formatado['tra_dt_saida_volta_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_saida_volta_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['tra_dt_saida_volta_input_2'], "YYYY-MM-DD");
              $this->cmp_formatado['tra_dt_saida_volta_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['tra_dt_saida_volta_input_2'] = "'" . $this->cmp_formatado['tra_dt_saida_volta_input_2'] . "'";
          }
          if (!empty($Dtxt) || $tra_dt_saida_volta_cond == "NU" || $tra_dt_saida_volta_cond == "NN"|| $tra_dt_saida_volta_cond == "EP"|| $tra_dt_saida_volta_cond == "NE")
          {
              $this->monta_condicao("tra_dt_saida_volta", $tra_dt_saida_volta_cond, $tra_dt_saida_volta, $tra_dt_saida_volta_input_2, 'tra_dt_saida_volta', 'DATE');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_saida_volta']['label'] = $nmgp_tab_label['tra_dt_saida_volta'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_saida_volta']['descr'] = $nmgp_tab_label['tra_dt_saida_volta'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_saida_volta']['hint']  = $nmgp_tab_label['tra_dt_saida_volta'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $tra_dt_chegada_volta
      $this->Date_part = false;
      if ($tra_dt_chegada_volta_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $tra_dt_chegada_volta_cond = strtoupper($tra_dt_chegada_volta_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $tra_dt_chegada_volta_ano;
          $Dtxt .= $tra_dt_chegada_volta_mes;
          $Dtxt .= $tra_dt_chegada_volta_dia;
          $val[0]['ano'] = $tra_dt_chegada_volta_ano;
          $val[0]['mes'] = $tra_dt_chegada_volta_mes;
          $val[0]['dia'] = $tra_dt_chegada_volta_dia;
          if ($tra_dt_chegada_volta_cond == "BW")
          {
              $val[1]['ano'] = $tra_dt_chegada_volta_input_2_ano;
              $val[1]['mes'] = $tra_dt_chegada_volta_input_2_mes;
              $val[1]['dia'] = $tra_dt_chegada_volta_input_2_dia;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->nm_prep_date($val, "DT", "DATETIME", $tra_dt_chegada_volta_cond, "", "data");
          }
          else
          {
              $this->nm_prep_date($val, "DT", "DATE", $tra_dt_chegada_volta_cond, "", "data");
          }
          if (!$this->Date_part) {
              $val[0] = $this->Ini->sc_Date_Protect($val[0]);
          }
          $tra_dt_chegada_volta = $val[0];
          $this->cmp_formatado['tra_dt_chegada_volta'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_volta'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['tra_dt_chegada_volta'], "YYYY-MM-DD");
          $this->cmp_formatado['tra_dt_chegada_volta'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['tra_dt_chegada_volta'] = "'" . $this->cmp_formatado['tra_dt_chegada_volta'] . "'";
          if ($tra_dt_chegada_volta_cond == "BW")
          {
              if (!$this->Date_part) {
                  $val[1] = $this->Ini->sc_Date_Protect($val[1]);
              }
              $tra_dt_chegada_volta_input_2     = $val[1];
              $this->cmp_formatado['tra_dt_chegada_volta_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_volta_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['tra_dt_chegada_volta_input_2'], "YYYY-MM-DD");
              $this->cmp_formatado['tra_dt_chegada_volta_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['tra_dt_chegada_volta_input_2'] = "'" . $this->cmp_formatado['tra_dt_chegada_volta_input_2'] . "'";
          }
          if (!empty($Dtxt) || $tra_dt_chegada_volta_cond == "NU" || $tra_dt_chegada_volta_cond == "NN"|| $tra_dt_chegada_volta_cond == "EP"|| $tra_dt_chegada_volta_cond == "NE")
          {
              $this->monta_condicao("tra_dt_chegada_volta", $tra_dt_chegada_volta_cond, $tra_dt_chegada_volta, $tra_dt_chegada_volta_input_2, 'tra_dt_chegada_volta', 'DATE');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_chegada_volta']['label'] = $nmgp_tab_label['tra_dt_chegada_volta'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_chegada_volta']['descr'] = $nmgp_tab_label['tra_dt_chegada_volta'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_chegada_volta']['hint']  = $nmgp_tab_label['tra_dt_chegada_volta'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $tra_localizador_volta
      $this->Date_part = false;
      if (isset($tra_localizador_volta) || $tra_localizador_volta_cond == "nu" || $tra_localizador_volta_cond == "nn" || $tra_localizador_volta_cond == "ep" || $tra_localizador_volta_cond == "ne")
      {
         $this->monta_condicao("tra_localizador_volta", $tra_localizador_volta_cond, $tra_localizador_volta, "", "tra_localizador_volta", "VARCHAR", false);
      }

      //----- $tra_eticket_volta
      $this->Date_part = false;
      if (isset($tra_eticket_volta) || $tra_eticket_volta_cond == "nu" || $tra_eticket_volta_cond == "nn" || $tra_eticket_volta_cond == "ep" || $tra_eticket_volta_cond == "ne")
      {
         $this->monta_condicao("tra_eticket_volta", $tra_eticket_volta_cond, $tra_eticket_volta, "", "tra_eticket_volta", "VARCHAR", false);
      }

      //----- $tra_dt_chegada_proprio
      $this->Date_part = false;
      if ($tra_dt_chegada_proprio_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $tra_dt_chegada_proprio_cond = strtoupper($tra_dt_chegada_proprio_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $tra_dt_chegada_proprio_ano;
          $Dtxt .= $tra_dt_chegada_proprio_mes;
          $Dtxt .= $tra_dt_chegada_proprio_dia;
          $val[0]['ano'] = $tra_dt_chegada_proprio_ano;
          $val[0]['mes'] = $tra_dt_chegada_proprio_mes;
          $val[0]['dia'] = $tra_dt_chegada_proprio_dia;
          if ($tra_dt_chegada_proprio_cond == "BW")
          {
              $val[1]['ano'] = $tra_dt_chegada_proprio_input_2_ano;
              $val[1]['mes'] = $tra_dt_chegada_proprio_input_2_mes;
              $val[1]['dia'] = $tra_dt_chegada_proprio_input_2_dia;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->nm_prep_date($val, "DT", "DATETIME", $tra_dt_chegada_proprio_cond, "", "data");
          }
          else
          {
              $this->nm_prep_date($val, "DT", "DATE", $tra_dt_chegada_proprio_cond, "", "data");
          }
          if (!$this->Date_part) {
              $val[0] = $this->Ini->sc_Date_Protect($val[0]);
          }
          $tra_dt_chegada_proprio = $val[0];
          $this->cmp_formatado['tra_dt_chegada_proprio'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_proprio'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['tra_dt_chegada_proprio'], "YYYY-MM-DD");
          $this->cmp_formatado['tra_dt_chegada_proprio'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['tra_dt_chegada_proprio'] = "'" . $this->cmp_formatado['tra_dt_chegada_proprio'] . "'";
          if ($tra_dt_chegada_proprio_cond == "BW")
          {
              if (!$this->Date_part) {
                  $val[1] = $this->Ini->sc_Date_Protect($val[1]);
              }
              $tra_dt_chegada_proprio_input_2     = $val[1];
              $this->cmp_formatado['tra_dt_chegada_proprio_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_chegada_proprio_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['tra_dt_chegada_proprio_input_2'], "YYYY-MM-DD");
              $this->cmp_formatado['tra_dt_chegada_proprio_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['tra_dt_chegada_proprio_input_2'] = "'" . $this->cmp_formatado['tra_dt_chegada_proprio_input_2'] . "'";
          }
          if (!empty($Dtxt) || $tra_dt_chegada_proprio_cond == "NU" || $tra_dt_chegada_proprio_cond == "NN"|| $tra_dt_chegada_proprio_cond == "EP"|| $tra_dt_chegada_proprio_cond == "NE")
          {
              $this->monta_condicao("tra_dt_chegada_proprio", $tra_dt_chegada_proprio_cond, $tra_dt_chegada_proprio, $tra_dt_chegada_proprio_input_2, 'tra_dt_chegada_proprio', 'DATE');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_chegada_proprio']['label'] = $nmgp_tab_label['tra_dt_chegada_proprio'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_chegada_proprio']['descr'] = $nmgp_tab_label['tra_dt_chegada_proprio'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_chegada_proprio']['hint']  = $nmgp_tab_label['tra_dt_chegada_proprio'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $tra_hr_chegada_proprio
      $this->Date_part = false;
      if ($tra_hr_chegada_proprio_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $tra_hr_chegada_proprio_cond = strtoupper($tra_hr_chegada_proprio_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $tra_hr_chegada_proprio_hor;
          $Dtxt .= $tra_hr_chegada_proprio_min;
          $Dtxt .= $tra_hr_chegada_proprio_seg;
          $val[0]['hor'] = $tra_hr_chegada_proprio_hor;
          $val[0]['min'] = $tra_hr_chegada_proprio_min;
          $val[0]['seg'] = $tra_hr_chegada_proprio_seg;
          if ($tra_hr_chegada_proprio_cond == "BW")
          {
              $val[1]['ano'] = $tra_hr_chegada_proprio_input_2_ano;
              $val[1]['mes'] = $tra_hr_chegada_proprio_input_2_mes;
              $val[1]['dia'] = $tra_hr_chegada_proprio_input_2_dia;
              $val[1]['hor'] = $tra_hr_chegada_proprio_input_2_hor;
              $val[1]['min'] = $tra_hr_chegada_proprio_input_2_min;
              $val[1]['seg'] = $tra_hr_chegada_proprio_input_2_seg;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          $this->nm_prep_date($val, "HH", "TIME", $tra_hr_chegada_proprio_cond, "", "hora");
          $tra_hr_chegada_proprio = $val[0];
          $this->cmp_formatado['tra_hr_chegada_proprio'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_chegada_proprio'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['tra_hr_chegada_proprio'], "HH:II:SS");
          $this->cmp_formatado['tra_hr_chegada_proprio'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "his"));
          $this->cmp_formatado['tra_hr_chegada_proprio'] = "'" . $this->cmp_formatado['tra_hr_chegada_proprio'] . "'";
          if ($tra_hr_chegada_proprio_cond == "BW")
          {
              $tra_hr_chegada_proprio_input_2     = $val[1];
              $this->cmp_formatado['tra_hr_chegada_proprio_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_chegada_proprio_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['tra_hr_chegada_proprio_input_2'], "HH:II:SS");
              $this->cmp_formatado['tra_hr_chegada_proprio_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "his"));
          $this->cmp_formatado['tra_hr_chegada_proprio_input_2'] = "'" . $this->cmp_formatado['tra_hr_chegada_proprio_input_2'] . "'";
          }
          if (!empty($Dtxt) || $tra_hr_chegada_proprio_cond == "NU" || $tra_hr_chegada_proprio_cond == "NN"|| $tra_hr_chegada_proprio_cond == "EP"|| $tra_hr_chegada_proprio_cond == "NE")
          {
              $this->monta_condicao("tra_hr_chegada_proprio", $tra_hr_chegada_proprio_cond, $tra_hr_chegada_proprio, $tra_hr_chegada_proprio_input_2, 'tra_hr_chegada_proprio', 'TIME');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_hr_chegada_proprio']['label'] = $nmgp_tab_label['tra_hr_chegada_proprio'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_hr_chegada_proprio']['descr'] = $nmgp_tab_label['tra_hr_chegada_proprio'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_hr_chegada_proprio']['hint']  = $nmgp_tab_label['tra_hr_chegada_proprio'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $tra_hr_volta_local
      $this->Date_part = false;
      if ($tra_hr_volta_local_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $tra_hr_volta_local_cond = strtoupper($tra_hr_volta_local_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $tra_hr_volta_local_hor;
          $Dtxt .= $tra_hr_volta_local_min;
          $Dtxt .= $tra_hr_volta_local_seg;
          $val[0]['hor'] = $tra_hr_volta_local_hor;
          $val[0]['min'] = $tra_hr_volta_local_min;
          $val[0]['seg'] = $tra_hr_volta_local_seg;
          if ($tra_hr_volta_local_cond == "BW")
          {
              $val[1]['ano'] = $tra_hr_volta_local_input_2_ano;
              $val[1]['mes'] = $tra_hr_volta_local_input_2_mes;
              $val[1]['dia'] = $tra_hr_volta_local_input_2_dia;
              $val[1]['hor'] = $tra_hr_volta_local_input_2_hor;
              $val[1]['min'] = $tra_hr_volta_local_input_2_min;
              $val[1]['seg'] = $tra_hr_volta_local_input_2_seg;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          $this->nm_prep_date($val, "HH", "TIME", $tra_hr_volta_local_cond, "", "hora");
          $tra_hr_volta_local = $val[0];
          $this->cmp_formatado['tra_hr_volta_local'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_volta_local'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['tra_hr_volta_local'], "HH:II:SS");
          $this->cmp_formatado['tra_hr_volta_local'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "his"));
          $this->cmp_formatado['tra_hr_volta_local'] = "'" . $this->cmp_formatado['tra_hr_volta_local'] . "'";
          if ($tra_hr_volta_local_cond == "BW")
          {
              $tra_hr_volta_local_input_2     = $val[1];
              $this->cmp_formatado['tra_hr_volta_local_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_volta_local_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['tra_hr_volta_local_input_2'], "HH:II:SS");
              $this->cmp_formatado['tra_hr_volta_local_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "his"));
          $this->cmp_formatado['tra_hr_volta_local_input_2'] = "'" . $this->cmp_formatado['tra_hr_volta_local_input_2'] . "'";
          }
          if (!empty($Dtxt) || $tra_hr_volta_local_cond == "NU" || $tra_hr_volta_local_cond == "NN"|| $tra_hr_volta_local_cond == "EP"|| $tra_hr_volta_local_cond == "NE")
          {
              $this->monta_condicao("tra_hr_volta_local", $tra_hr_volta_local_cond, $tra_hr_volta_local, $tra_hr_volta_local_input_2, 'tra_hr_volta_local', 'TIME');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_hr_volta_local']['label'] = $nmgp_tab_label['tra_hr_volta_local'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_hr_volta_local']['descr'] = $nmgp_tab_label['tra_hr_volta_local'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_hr_volta_local']['hint']  = $nmgp_tab_label['tra_hr_volta_local'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $tra_dt_volta_local
      $this->Date_part = false;
      if ($tra_dt_volta_local_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $tra_dt_volta_local_cond = strtoupper($tra_dt_volta_local_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $tra_dt_volta_local_ano;
          $Dtxt .= $tra_dt_volta_local_mes;
          $Dtxt .= $tra_dt_volta_local_dia;
          $val[0]['ano'] = $tra_dt_volta_local_ano;
          $val[0]['mes'] = $tra_dt_volta_local_mes;
          $val[0]['dia'] = $tra_dt_volta_local_dia;
          if ($tra_dt_volta_local_cond == "BW")
          {
              $val[1]['ano'] = $tra_dt_volta_local_input_2_ano;
              $val[1]['mes'] = $tra_dt_volta_local_input_2_mes;
              $val[1]['dia'] = $tra_dt_volta_local_input_2_dia;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->nm_prep_date($val, "DT", "DATETIME", $tra_dt_volta_local_cond, "", "data");
          }
          else
          {
              $this->nm_prep_date($val, "DT", "DATE", $tra_dt_volta_local_cond, "", "data");
          }
          if (!$this->Date_part) {
              $val[0] = $this->Ini->sc_Date_Protect($val[0]);
          }
          $tra_dt_volta_local = $val[0];
          $this->cmp_formatado['tra_dt_volta_local'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_volta_local'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['tra_dt_volta_local'], "YYYY-MM-DD");
          $this->cmp_formatado['tra_dt_volta_local'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['tra_dt_volta_local'] = "'" . $this->cmp_formatado['tra_dt_volta_local'] . "'";
          if ($tra_dt_volta_local_cond == "BW")
          {
              if (!$this->Date_part) {
                  $val[1] = $this->Ini->sc_Date_Protect($val[1]);
              }
              $tra_dt_volta_local_input_2     = $val[1];
              $this->cmp_formatado['tra_dt_volta_local_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_volta_local_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['tra_dt_volta_local_input_2'], "YYYY-MM-DD");
              $this->cmp_formatado['tra_dt_volta_local_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['tra_dt_volta_local_input_2'] = "'" . $this->cmp_formatado['tra_dt_volta_local_input_2'] . "'";
          }
          if (!empty($Dtxt) || $tra_dt_volta_local_cond == "NU" || $tra_dt_volta_local_cond == "NN"|| $tra_dt_volta_local_cond == "EP"|| $tra_dt_volta_local_cond == "NE")
          {
              $this->monta_condicao("tra_dt_volta_local", $tra_dt_volta_local_cond, $tra_dt_volta_local, $tra_dt_volta_local_input_2, 'tra_dt_volta_local', 'DATE');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_volta_local']['label'] = $nmgp_tab_label['tra_dt_volta_local'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_volta_local']['descr'] = $nmgp_tab_label['tra_dt_volta_local'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_volta_local']['hint']  = $nmgp_tab_label['tra_dt_volta_local'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $tra_hr_ida_local
      $this->Date_part = false;
      if ($tra_hr_ida_local_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $tra_hr_ida_local_cond = strtoupper($tra_hr_ida_local_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $tra_hr_ida_local_hor;
          $Dtxt .= $tra_hr_ida_local_min;
          $Dtxt .= $tra_hr_ida_local_seg;
          $val[0]['hor'] = $tra_hr_ida_local_hor;
          $val[0]['min'] = $tra_hr_ida_local_min;
          $val[0]['seg'] = $tra_hr_ida_local_seg;
          if ($tra_hr_ida_local_cond == "BW")
          {
              $val[1]['ano'] = $tra_hr_ida_local_input_2_ano;
              $val[1]['mes'] = $tra_hr_ida_local_input_2_mes;
              $val[1]['dia'] = $tra_hr_ida_local_input_2_dia;
              $val[1]['hor'] = $tra_hr_ida_local_input_2_hor;
              $val[1]['min'] = $tra_hr_ida_local_input_2_min;
              $val[1]['seg'] = $tra_hr_ida_local_input_2_seg;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          $this->nm_prep_date($val, "HH", "TIME", $tra_hr_ida_local_cond, "", "hora");
          $tra_hr_ida_local = $val[0];
          $this->cmp_formatado['tra_hr_ida_local'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_ida_local'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['tra_hr_ida_local'], "HH:II:SS");
          $this->cmp_formatado['tra_hr_ida_local'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "his"));
          $this->cmp_formatado['tra_hr_ida_local'] = "'" . $this->cmp_formatado['tra_hr_ida_local'] . "'";
          if ($tra_hr_ida_local_cond == "BW")
          {
              $tra_hr_ida_local_input_2     = $val[1];
              $this->cmp_formatado['tra_hr_ida_local_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_hr_ida_local_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['tra_hr_ida_local_input_2'], "HH:II:SS");
              $this->cmp_formatado['tra_hr_ida_local_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "his"));
          $this->cmp_formatado['tra_hr_ida_local_input_2'] = "'" . $this->cmp_formatado['tra_hr_ida_local_input_2'] . "'";
          }
          if (!empty($Dtxt) || $tra_hr_ida_local_cond == "NU" || $tra_hr_ida_local_cond == "NN"|| $tra_hr_ida_local_cond == "EP"|| $tra_hr_ida_local_cond == "NE")
          {
              $this->monta_condicao("tra_hr_ida_local", $tra_hr_ida_local_cond, $tra_hr_ida_local, $tra_hr_ida_local_input_2, 'tra_hr_ida_local', 'TIME');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_hr_ida_local']['label'] = $nmgp_tab_label['tra_hr_ida_local'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_hr_ida_local']['descr'] = $nmgp_tab_label['tra_hr_ida_local'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_hr_ida_local']['hint']  = $nmgp_tab_label['tra_hr_ida_local'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $tra_dt_ida_local
      $this->Date_part = false;
      if ($tra_dt_ida_local_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $tra_dt_ida_local_cond = strtoupper($tra_dt_ida_local_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $tra_dt_ida_local_ano;
          $Dtxt .= $tra_dt_ida_local_mes;
          $Dtxt .= $tra_dt_ida_local_dia;
          $val[0]['ano'] = $tra_dt_ida_local_ano;
          $val[0]['mes'] = $tra_dt_ida_local_mes;
          $val[0]['dia'] = $tra_dt_ida_local_dia;
          if ($tra_dt_ida_local_cond == "BW")
          {
              $val[1]['ano'] = $tra_dt_ida_local_input_2_ano;
              $val[1]['mes'] = $tra_dt_ida_local_input_2_mes;
              $val[1]['dia'] = $tra_dt_ida_local_input_2_dia;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->nm_prep_date($val, "DT", "DATETIME", $tra_dt_ida_local_cond, "", "data");
          }
          else
          {
              $this->nm_prep_date($val, "DT", "DATE", $tra_dt_ida_local_cond, "", "data");
          }
          if (!$this->Date_part) {
              $val[0] = $this->Ini->sc_Date_Protect($val[0]);
          }
          $tra_dt_ida_local = $val[0];
          $this->cmp_formatado['tra_dt_ida_local'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_ida_local'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['tra_dt_ida_local'], "YYYY-MM-DD");
          $this->cmp_formatado['tra_dt_ida_local'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['tra_dt_ida_local'] = "'" . $this->cmp_formatado['tra_dt_ida_local'] . "'";
          if ($tra_dt_ida_local_cond == "BW")
          {
              if (!$this->Date_part) {
                  $val[1] = $this->Ini->sc_Date_Protect($val[1]);
              }
              $tra_dt_ida_local_input_2     = $val[1];
              $this->cmp_formatado['tra_dt_ida_local_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']['tra_dt_ida_local_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['tra_dt_ida_local_input_2'], "YYYY-MM-DD");
              $this->cmp_formatado['tra_dt_ida_local_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['tra_dt_ida_local_input_2'] = "'" . $this->cmp_formatado['tra_dt_ida_local_input_2'] . "'";
          }
          if (!empty($Dtxt) || $tra_dt_ida_local_cond == "NU" || $tra_dt_ida_local_cond == "NN"|| $tra_dt_ida_local_cond == "EP"|| $tra_dt_ida_local_cond == "NE")
          {
              $this->monta_condicao("tra_dt_ida_local", $tra_dt_ida_local_cond, $tra_dt_ida_local, $tra_dt_ida_local_input_2, 'tra_dt_ida_local', 'DATE');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_ida_local']['label'] = $nmgp_tab_label['tra_dt_ida_local'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_ida_local']['descr'] = $nmgp_tab_label['tra_dt_ida_local'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['grid_pesq']['tra_dt_ida_local']['hint']  = $nmgp_tab_label['tra_dt_ida_local'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $id_transfer
      $this->Date_part = false;
      if (isset($id_transfer) || $id_transfer_cond == "nu" || $id_transfer_cond == "nn" || $id_transfer_cond == "ep" || $id_transfer_cond == "ne")
      {
         $this->monta_condicao("id_transfer", $id_transfer_cond, $id_transfer, "", "id_transfer", "INT", false);
      }

      //----- $tra_id_bloqueio
      $this->Date_part = false;
      if (isset($tra_id_bloqueio) || $tra_id_bloqueio_cond == "nu" || $tra_id_bloqueio_cond == "nn" || $tra_id_bloqueio_cond == "ep" || $tra_id_bloqueio_cond == "ne")
      {
         $this->monta_condicao("tra_id_bloqueio", $tra_id_bloqueio_cond, $tra_id_bloqueio, "", "tra_id_bloqueio", "INT", false);
      }

      //----- $tra_id_evento
      $this->Date_part = false;
      if (isset($tra_id_evento) || $tra_id_evento_cond == "nu" || $tra_id_evento_cond == "nn" || $tra_id_evento_cond == "ep" || $tra_id_evento_cond == "ne")
      {
         $this->monta_condicao("tra_id_evento", $tra_id_evento_cond, $tra_id_evento, "", "tra_id_evento", "INT", false);
      }

      //----- $tra_id_aereo
      $this->Date_part = false;
      if (isset($tra_id_aereo) || $tra_id_aereo_cond == "nu" || $tra_id_aereo_cond == "nn" || $tra_id_aereo_cond == "ep" || $tra_id_aereo_cond == "ne")
      {
         $this->monta_condicao("tra_id_aereo", $tra_id_aereo_cond, $tra_id_aereo, "", "tra_id_aereo", "INT", false);
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
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq_grid'] = $this->comando;
       if (empty($this->comando)) 
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq_filtro'] = "";
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_orig'];
       }
       else
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq_filtro'] = "( " . $this->comando . " )";
           if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_orig'])) 
           {
               $this->comando = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_orig'] . " and (" . $this->comando . ")"; 
           }
           else
           {
               $this->comando = " where " . $this->comando; 
           }
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq'] = $this->comando;
       }
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq_fast'])) 
       {
           if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq'])) 
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq'] .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq_fast'] . ")";
           }
           else 
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq'] = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq_fast'] . ")";
           }
       }
   }
   function finaliza_resultado()
   {
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['dyn_search']      = array();
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['cond_dyn_search'] = "";
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq_fast'] = "";
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['fast_search']);
      if ("" == $this->comando_filtro)
      {
          $this->comando = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_orig'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']) && $_SESSION['scriptcase']['charset'] != "UTF-8")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca'], "UTF-8", $_SESSION['scriptcase']['charset']);
      }

      $this->Sel_case_sensitive($this->comando);
      $this->Sel_case_sensitive($this->comando_sum);
      $this->Sel_case_sensitive($this->comando_filtro);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq_grid']    = $this->comando_filtro;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq_lookup']  = $this->comando_sum . $this->comando_fim;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq']         = $this->comando . $this->comando_fim;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['opcao']              = "pesq";
      if ("" == $this->comando_filtro)
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq_filtro'] = "";
      }
      else
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq_filtro'] = " (" . trim($this->comando_filtro) . ")";
      }
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['cond_pesq'] .= $this->NM_operador;
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['contr_array_resumo'] = "NAO";
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['contr_total_geral']  = "NAO";
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['tot_geral']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['using_summary_cache']);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq'];

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
			$ret = $rs[0][2];
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
$_SESSION['scriptcase']['grid_transfer_rsvp']['contr_erro'] = 'off';
}

}

?>
