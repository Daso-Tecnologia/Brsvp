<?php

class grid_rsvp_part_r_pesq
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['path_libs_php'] = $this->Ini->path_lib_php;
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca'] = array(); 
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
                      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca'][$field] = $arr_tmp; 
                  }
                  else
                  {
                      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca'][$field] = $cada_dado['value']; 
                  }
              }
          }
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca'], $_SESSION['scriptcase']['charset'], "UTF-8");
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['opcao'] = "igual";
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
                  $Opt_filter .= "<option value=\"\">" . grid_rsvp_part_r_pack_protect_string($Nome_filter) . "</option>\r\n";
              }
              $Opt_filter .= "<option value=\"" . grid_rsvp_part_r_pack_protect_string($Tipo_filter[0]) . "\">.." . htmlspecialchars($Cada_filter).  "</option>\r\n";
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
                  $Opt_filter .= "<option value=\"\">" .  grid_rsvp_part_r_pack_protect_string($Nome_filter) . "</option>\r\n";
              }
              $Opt_filter .= "<option value=\"" . grid_rsvp_part_r_pack_protect_string($Tipo_filter[0]) . "\">.." . grid_rsvp_part_r_pack_protect_string($Cada_filter) .  "</option>\r\n";
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

      if ($this->NM_ajax_opcao == 'autocomp_p_tam_camisa')
      {
          $p_tam_camisa = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_p_tam_camisa($p_tam_camisa);
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
      if ($this->NM_ajax_opcao == 'autocomp_publico_nome')
      {
          $publico_nome = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_publico_nome($publico_nome);
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
      if ($this->NM_ajax_opcao == 'autocomp_regional_nome')
      {
          $regional_nome = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_regional_nome($regional_nome);
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
      if ($this->NM_ajax_opcao == 'autocomp_p_nome')
      {
          $p_nome = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_p_nome($p_nome);
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
      if ($this->NM_ajax_opcao == 'autocomp_contato_status_dsc')
      {
          $contato_status_dsc = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_contato_status_dsc($contato_status_dsc);
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
      if ($this->NM_ajax_opcao == 'autocomp_presenca_status_dsc')
      {
          $presenca_status_dsc = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_presenca_status_dsc($presenca_status_dsc);
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
      if ($this->NM_ajax_opcao == 'autocomp_hotel_fantasia')
      {
          $hotel_fantasia = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_hotel_fantasia($hotel_fantasia);
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
      if ($this->NM_ajax_opcao == 'autocomp_contato_usuario_nome')
      {
          $contato_usuario_nome = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_contato_usuario_nome($contato_usuario_nome);
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
      if ($this->NM_ajax_opcao == 'autocomp_presenca_usuario_dsc')
      {
          $presenca_usuario_dsc = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_presenca_usuario_dsc($presenca_usuario_dsc);
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
      if ($this->NM_ajax_opcao == 'autocomp_hospedagem_tipo_pessoa')
      {
          $hospedagem_tipo_pessoa = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_hospedagem_tipo_pessoa($hospedagem_tipo_pessoa);
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
      if ($this->NM_ajax_opcao == 'autocomp_presenca_status')
      {
          $presenca_status = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_presenca_status($presenca_status);
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
   function lookup_ajax_p_tam_camisa($p_tam_camisa)
   {
      $p_tam_camisa = substr($this->Db->qstr($p_tam_camisa), 1, -1);
            $p_tam_camisa_look = (is_string($p_tam_camisa) ? substr($this->Db->qstr($p_tam_camisa), 1, -1) : $p_tam_camisa); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct p_tam_camisa from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#p_tam_camisa#lowerF# like #lowerI#'%" . $p_tam_camisa . "%'#lowerF# order by p_tam_camisa"; 
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
   
   function lookup_ajax_publico_nome($publico_nome)
   {
      $publico_nome = substr($this->Db->qstr($publico_nome), 1, -1);
            $publico_nome_look = (is_string($publico_nome) ? substr($this->Db->qstr($publico_nome), 1, -1) : $publico_nome); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct publico_nome from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#publico_nome#lowerF# like #lowerI#'%" . $publico_nome . "%'#lowerF# order by publico_nome"; 
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
   
   function lookup_ajax_regional_nome($regional_nome)
   {
      $regional_nome = substr($this->Db->qstr($regional_nome), 1, -1);
            $regional_nome_look = (is_string($regional_nome) ? substr($this->Db->qstr($regional_nome), 1, -1) : $regional_nome); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct regional_nome from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#regional_nome#lowerF# like #lowerI#'%" . $regional_nome . "%'#lowerF# order by regional_nome"; 
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
   
   function lookup_ajax_p_nome($p_nome)
   {
      $p_nome = substr($this->Db->qstr($p_nome), 1, -1);
            $p_nome_look = (is_string($p_nome) ? substr($this->Db->qstr($p_nome), 1, -1) : $p_nome); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct p_nome from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#p_nome#lowerF# like #lowerI#'%" . $p_nome . "%'#lowerF# order by p_nome"; 
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
   
   function lookup_ajax_contato_status_dsc($contato_status_dsc)
   {
      $contato_status_dsc = substr($this->Db->qstr($contato_status_dsc), 1, -1);
            $contato_status_dsc_look = (is_string($contato_status_dsc) ? substr($this->Db->qstr($contato_status_dsc), 1, -1) : $contato_status_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct contato_status_dsc from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#contato_status_dsc#lowerF# like #lowerI#'%" . $contato_status_dsc . "%'#lowerF# order by contato_status_dsc"; 
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
   
   function lookup_ajax_presenca_status_dsc($presenca_status_dsc)
   {
      $presenca_status_dsc = substr($this->Db->qstr($presenca_status_dsc), 1, -1);
            $presenca_status_dsc_look = (is_string($presenca_status_dsc) ? substr($this->Db->qstr($presenca_status_dsc), 1, -1) : $presenca_status_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct presenca_status_dsc from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#presenca_status_dsc#lowerF# like #lowerI#'%" . $presenca_status_dsc . "%'#lowerF# order by presenca_status_dsc"; 
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
   
   function lookup_ajax_hotel_fantasia($hotel_fantasia)
   {
      $hotel_fantasia = substr($this->Db->qstr($hotel_fantasia), 1, -1);
            $hotel_fantasia_look = (is_string($hotel_fantasia) ? substr($this->Db->qstr($hotel_fantasia), 1, -1) : $hotel_fantasia); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct hotel_fantasia from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#hotel_fantasia#lowerF# like #lowerI#'%" . $hotel_fantasia . "%'#lowerF# order by hotel_fantasia"; 
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
   
   function lookup_ajax_contato_usuario_nome($contato_usuario_nome)
   {
      $contato_usuario_nome = substr($this->Db->qstr($contato_usuario_nome), 1, -1);
            $contato_usuario_nome_look = (is_string($contato_usuario_nome) ? substr($this->Db->qstr($contato_usuario_nome), 1, -1) : $contato_usuario_nome); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct contato_usuario_nome from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#contato_usuario_nome#lowerF# like #lowerI#'%" . $contato_usuario_nome . "%'#lowerF# order by contato_usuario_nome"; 
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
   
   function lookup_ajax_presenca_usuario_dsc($presenca_usuario_dsc)
   {
      $presenca_usuario_dsc = substr($this->Db->qstr($presenca_usuario_dsc), 1, -1);
            $presenca_usuario_dsc_look = (is_string($presenca_usuario_dsc) ? substr($this->Db->qstr($presenca_usuario_dsc), 1, -1) : $presenca_usuario_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct presenca_usuario_dsc from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#presenca_usuario_dsc#lowerF# like #lowerI#'%" . $presenca_usuario_dsc . "%'#lowerF# order by presenca_usuario_dsc"; 
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
   
   function lookup_ajax_hospedagem_tipo_pessoa($hospedagem_tipo_pessoa)
   {
      $hospedagem_tipo_pessoa = substr($this->Db->qstr($hospedagem_tipo_pessoa), 1, -1);
            $hospedagem_tipo_pessoa_look = (is_string($hospedagem_tipo_pessoa) ? substr($this->Db->qstr($hospedagem_tipo_pessoa), 1, -1) : $hospedagem_tipo_pessoa); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct hospedagem_tipo_pessoa from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#hospedagem_tipo_pessoa#lowerF# like #lowerI#'%" . $hospedagem_tipo_pessoa . "%'#lowerF# order by hospedagem_tipo_pessoa"; 
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
   
   function lookup_ajax_presenca_status($presenca_status)
   {
      $presenca_status = substr($this->Db->qstr($presenca_status), 1, -1);
            $presenca_status_look = (is_string($presenca_status) ? substr($this->Db->qstr($presenca_status), 1, -1) : $presenca_status); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct presenca_status from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#presenca_status#lowerF# like #lowerI#'%" . $presenca_status . "%'#lowerF# order by presenca_status"; 
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
      $Nm_numeric[] = "id_rsvp_r";$Nm_numeric[] = "p_regional";$Nm_numeric[] = "p_publico";$Nm_numeric[] = "p_evento";$Nm_numeric[] = "contato_usuario_id";$Nm_numeric[] = "presenca_usuario_id";$Nm_numeric[] = "hospedagem_evento";$Nm_numeric[] = "hospedagem_id_hotel";$Nm_numeric[] = "id_usuario_relato";
      $campo_join = strtolower(str_replace(".", "_", $nome));
      if (in_array($campo_join, $Nm_numeric))
      {
          if ($condicao == "EP" || $condicao == "NE")
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$campo_join]);
              return;
          }
         $nm_ini_lower = "";
         $nm_fim_lower = "";
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['decimal_db'] == ".")
         {
            $nm_aspas  = "";
            $nm_aspas1 = "";
         }
         if ($condicao != "IN")
         {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['decimal_db'] == ".")
            {
               $campo  = str_replace(",", ".", $campo);
               $campo2 = str_replace(",", ".", $campo2);
            }
         }
      }
      $Nm_datas[] = 'hospedagem_dtchkin';$Nm_datas[] = 'hospedagem_hrchkin';$Nm_datas[] = 'hospedagem_dtchkout';$Nm_datas[] = 'hospedagem_hrchkout';$Nm_datas[] = 'data_nascimento';
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
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['SC_sep_date']))
          {
              $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['SC_sep_date'];
              $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['SC_sep_date1'];
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
         $nome_sum = "rsvp_part_r.$nome";
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
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_equl'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $this->cmp_formatado[$nome_campo];
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
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $lang_like . " (" . str_replace(" ",$Conect_msg,$this->cmp_formatado[$nome_campo]) . ")##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $lang_like . " (" . str_replace(" ",$Conect_msg,$this->cmp_formatado[$nome_campo]) . ")";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['hint']  = $nmgp_tab_label[$nome_campo] . ": " . $lang_like . " (" . str_replace(" ",$Conect_msg,$this->cmp_formatado[$nome_campo]) . ")";
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
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_strt'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_strt'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_strt'] . " " . $this->cmp_formatado[$nome_campo];
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
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . ":</span> " . str_replace(array("##ini##","##fim##"), array("<span class='scGridFilterDynValue'>","</span>"),$NM_cond) . "##*@@";
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
                       $NM_cond = str_replace(array("##ini##","##fim##"), array("",""),$NM_cond);
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $NM_cond;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $NM_cond;
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
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $lang_like . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $lang_like . " " . $this->cmp_formatado[$nome_campo];
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $lang_like . " " . $this->cmp_formatado[$nome_campo];
               }
            break;
            case "DF":     // 
               $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_diff'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_diff'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_diff'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "GT":     // 
               $this->comando        .= " $nome > " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum > " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome > " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_grtr'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "GE":     // 
               $this->comando        .= " $nome >= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum >= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome >= " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "LT":     // 
               $this->comando        .= " $nome < " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum < " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome < " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_less'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "LE":     // 
               $this->comando        .= " $nome <= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum <= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome <= " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_less_equl'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less_equl'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less_equl'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "BW":     // 
               $this->comando        .= " $nome between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $this->comando_filtro .= " $nome between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_betw'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo] . " </span>" . $this->Ini->Nm_lang['lang_srch_and_cond'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo . "_input_2"] . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_betw'] . " " . $this->cmp_formatado[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " " . $this->cmp_formatado[$nome_campo . "_input_2"];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_betw'] . " " . $this->cmp_formatado[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " " . $this->cmp_formatado[$nome_campo . "_input_2"];
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
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_equl'] . " <span class='scGridFilterDynValue'>" . $nm_cond . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $cond_descr;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $nm_cond;
            break;
            case "NU":     // 
               $this->comando        .= " $nome IS NULL ";
               $this->comando_sum    .= " $nome_sum IS NULL ";
               $this->comando_filtro .= " $nome IS NULL ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_null'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_null'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_null'];
            break;
            case "NN":     // 
               $this->comando        .= " $nome IS NOT NULL ";
               $this->comando_sum    .= " $nome_sum IS NOT NULL ";
               $this->comando_filtro .= " $nome IS NOT NULL ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_nnul'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nnul'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nnul'];
            break;
            case "EP":     // 
               $this->comando        .= " $nome = '' ";
               $this->comando_sum    .= " $nome_sum = '' ";
               $this->comando_filtro .= " $nome = '' ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_empty'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_empty'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_empty'];
            break;
            case "NE":     // 
               $this->comando        .= " $nome <> '' ";
               $this->comando_sum    .= " $nome_sum <> '' ";
               $this->comando_filtro .= " $nome <> '' ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_nempty'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nempty'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nempty'];
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
 <TITLE>Relatório RSVP</TITLE>
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
 <TITLE>Relatório RSVP</TITLE>
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>grid_rsvp_part_r/grid_rsvp_part_r_fil_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />
</HEAD>
<?php
$vertical_center = '';
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
 <script type="text/javascript" src="grid_rsvp_part_r_ajax_search.js"></script>
 <script type="text/javascript" src="grid_rsvp_part_r_ajax.js"></script>
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
<script type="text/javascript" src="grid_rsvp_part_r_message.js"></script>
<link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_sweetalert.css" />
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['grid_rsvp_part_r']['glo_nm_path_prod']; ?>/third/sweetalert/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['grid_rsvp_part_r']['glo_nm_path_prod']; ?>/third/sweetalert/polyfill.min.js"></script>
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
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['ajax_nav'])
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
<script type="text/javascript" src="grid_rsvp_part_r_message.js"></script>
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
  str_out += 'SC_p_tam_camisa_cond#NMF#' + search_get_sel_txt('SC_p_tam_camisa_cond') + '@NMF@';
  str_out += 'SC_p_tam_camisa#NMF#' + search_get_text('SC_p_tam_camisa') + '@NMF@';
  str_out += 'id_ac_p_tam_camisa#NMF#' + search_get_text('id_ac_p_tam_camisa') + '@NMF@';
  str_out += 'SC_publico_nome_cond#NMF#' + search_get_sel_txt('SC_publico_nome_cond') + '@NMF@';
  str_out += 'SC_publico_nome#NMF#' + search_get_text('SC_publico_nome') + '@NMF@';
  str_out += 'id_ac_publico_nome#NMF#' + search_get_text('id_ac_publico_nome') + '@NMF@';
  str_out += 'SC_regional_nome_cond#NMF#' + search_get_sel_txt('SC_regional_nome_cond') + '@NMF@';
  str_out += 'SC_regional_nome#NMF#' + search_get_text('SC_regional_nome') + '@NMF@';
  str_out += 'id_ac_regional_nome#NMF#' + search_get_text('id_ac_regional_nome') + '@NMF@';
  str_out += 'SC_p_nome_cond#NMF#' + search_get_sel_txt('SC_p_nome_cond') + '@NMF@';
  str_out += 'SC_p_nome#NMF#' + search_get_text('SC_p_nome') + '@NMF@';
  str_out += 'id_ac_p_nome#NMF#' + search_get_text('id_ac_p_nome') + '@NMF@';
  str_out += 'SC_contato_status_dsc_cond#NMF#' + search_get_sel_txt('SC_contato_status_dsc_cond') + '@NMF@';
  str_out += 'SC_contato_status_dsc#NMF#' + search_get_text('SC_contato_status_dsc') + '@NMF@';
  str_out += 'id_ac_contato_status_dsc#NMF#' + search_get_text('id_ac_contato_status_dsc') + '@NMF@';
  str_out += 'SC_presenca_status_dsc_cond#NMF#' + search_get_sel_txt('SC_presenca_status_dsc_cond') + '@NMF@';
  str_out += 'SC_presenca_status_dsc#NMF#' + search_get_text('SC_presenca_status_dsc') + '@NMF@';
  str_out += 'id_ac_presenca_status_dsc#NMF#' + search_get_text('id_ac_presenca_status_dsc') + '@NMF@';
  str_out += 'SC_hotel_fantasia_cond#NMF#' + search_get_sel_txt('SC_hotel_fantasia_cond') + '@NMF@';
  str_out += 'SC_hotel_fantasia#NMF#' + search_get_text('SC_hotel_fantasia') + '@NMF@';
  str_out += 'id_ac_hotel_fantasia#NMF#' + search_get_text('id_ac_hotel_fantasia') + '@NMF@';
  str_out += 'SC_contato_usuario_nome_cond#NMF#' + search_get_sel_txt('SC_contato_usuario_nome_cond') + '@NMF@';
  str_out += 'SC_contato_usuario_nome#NMF#' + search_get_text('SC_contato_usuario_nome') + '@NMF@';
  str_out += 'id_ac_contato_usuario_nome#NMF#' + search_get_text('id_ac_contato_usuario_nome') + '@NMF@';
  str_out += 'SC_presenca_usuario_dsc_cond#NMF#' + search_get_sel_txt('SC_presenca_usuario_dsc_cond') + '@NMF@';
  str_out += 'SC_presenca_usuario_dsc#NMF#' + search_get_text('SC_presenca_usuario_dsc') + '@NMF@';
  str_out += 'id_ac_presenca_usuario_dsc#NMF#' + search_get_text('id_ac_presenca_usuario_dsc') + '@NMF@';
  str_out += 'SC_hospedagem_tipo_pessoa_cond#NMF#' + search_get_sel_txt('SC_hospedagem_tipo_pessoa_cond') + '@NMF@';
  str_out += 'SC_hospedagem_tipo_pessoa#NMF#' + search_get_text('SC_hospedagem_tipo_pessoa') + '@NMF@';
  str_out += 'id_ac_hospedagem_tipo_pessoa#NMF#' + search_get_text('id_ac_hospedagem_tipo_pessoa') + '@NMF@';
  str_out += 'SC_hospedagem_dtchkin_cond#NMF#' + search_get_sel_txt('SC_hospedagem_dtchkin_cond') + '@NMF@';
  str_out += 'SC_hospedagem_dtchkin_dia#NMF#' + search_get_sel_txt('SC_hospedagem_dtchkin_dia') + '@NMF@';
  str_out += 'SC_hospedagem_dtchkin_mes#NMF#' + search_get_sel_txt('SC_hospedagem_dtchkin_mes') + '@NMF@';
  str_out += 'SC_hospedagem_dtchkin_ano#NMF#' + search_get_sel_txt('SC_hospedagem_dtchkin_ano') + '@NMF@';
  str_out += 'SC_hospedagem_dtchkin_input_2_dia#NMF#' + search_get_sel_txt('SC_hospedagem_dtchkin_input_2_dia') + '@NMF@';
  str_out += 'SC_hospedagem_dtchkin_input_2_mes#NMF#' + search_get_sel_txt('SC_hospedagem_dtchkin_input_2_mes') + '@NMF@';
  str_out += 'SC_hospedagem_dtchkin_input_2_ano#NMF#' + search_get_sel_txt('SC_hospedagem_dtchkin_input_2_ano') + '@NMF@';
  str_out += 'SC_hospedagem_hrchkin_cond#NMF#' + search_get_sel_txt('SC_hospedagem_hrchkin_cond') + '@NMF@';
  str_out += 'SC_hospedagem_hrchkin_hor#NMF#' + search_get_sel_txt('SC_hospedagem_hrchkin_hor') + '@NMF@';
  str_out += 'SC_hospedagem_hrchkin_min#NMF#' + search_get_sel_txt('SC_hospedagem_hrchkin_min') + '@NMF@';
  str_out += 'SC_hospedagem_hrchkin_seg#NMF#' + search_get_sel_txt('SC_hospedagem_hrchkin_seg') + '@NMF@';
  str_out += 'SC_hospedagem_hrchkin_input_2_hor#NMF#' + search_get_sel_txt('SC_hospedagem_hrchkin_input_2_hor') + '@NMF@';
  str_out += 'SC_hospedagem_hrchkin_input_2_min#NMF#' + search_get_sel_txt('SC_hospedagem_hrchkin_input_2_min') + '@NMF@';
  str_out += 'SC_hospedagem_hrchkin_input_2_seg#NMF#' + search_get_sel_txt('SC_hospedagem_hrchkin_input_2_seg') + '@NMF@';
  str_out += 'SC_hospedagem_dtchkout_cond#NMF#' + search_get_sel_txt('SC_hospedagem_dtchkout_cond') + '@NMF@';
  str_out += 'SC_hospedagem_dtchkout_dia#NMF#' + search_get_sel_txt('SC_hospedagem_dtchkout_dia') + '@NMF@';
  str_out += 'SC_hospedagem_dtchkout_mes#NMF#' + search_get_sel_txt('SC_hospedagem_dtchkout_mes') + '@NMF@';
  str_out += 'SC_hospedagem_dtchkout_ano#NMF#' + search_get_sel_txt('SC_hospedagem_dtchkout_ano') + '@NMF@';
  str_out += 'SC_hospedagem_dtchkout_input_2_dia#NMF#' + search_get_sel_txt('SC_hospedagem_dtchkout_input_2_dia') + '@NMF@';
  str_out += 'SC_hospedagem_dtchkout_input_2_mes#NMF#' + search_get_sel_txt('SC_hospedagem_dtchkout_input_2_mes') + '@NMF@';
  str_out += 'SC_hospedagem_dtchkout_input_2_ano#NMF#' + search_get_sel_txt('SC_hospedagem_dtchkout_input_2_ano') + '@NMF@';
  str_out += 'SC_hospedagem_hrchkout_cond#NMF#' + search_get_sel_txt('SC_hospedagem_hrchkout_cond') + '@NMF@';
  str_out += 'SC_hospedagem_hrchkout_hor#NMF#' + search_get_sel_txt('SC_hospedagem_hrchkout_hor') + '@NMF@';
  str_out += 'SC_hospedagem_hrchkout_min#NMF#' + search_get_sel_txt('SC_hospedagem_hrchkout_min') + '@NMF@';
  str_out += 'SC_hospedagem_hrchkout_seg#NMF#' + search_get_sel_txt('SC_hospedagem_hrchkout_seg') + '@NMF@';
  str_out += 'SC_hospedagem_hrchkout_input_2_hor#NMF#' + search_get_sel_txt('SC_hospedagem_hrchkout_input_2_hor') + '@NMF@';
  str_out += 'SC_hospedagem_hrchkout_input_2_min#NMF#' + search_get_sel_txt('SC_hospedagem_hrchkout_input_2_min') + '@NMF@';
  str_out += 'SC_hospedagem_hrchkout_input_2_seg#NMF#' + search_get_sel_txt('SC_hospedagem_hrchkout_input_2_seg') + '@NMF@';
  str_out += 'SC_presenca_status_cond#NMF#' + search_get_sel_txt('SC_presenca_status_cond') + '@NMF@';
  str_out += 'SC_presenca_status#NMF#' + search_get_text('SC_presenca_status') + '@NMF@';
  str_out += 'id_ac_presenca_status#NMF#' + search_get_text('id_ac_presenca_status') + '@NMF@';
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
   scClass = $("#id_ac_p_nome").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_p_nome").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_p_nome",
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
       $("#SC_p_nome").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_p_nome").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_publico_nome").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_publico_nome").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_publico_nome",
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
       $("#SC_publico_nome").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_publico_nome").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_regional_nome").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_regional_nome").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_regional_nome",
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
       $("#SC_regional_nome").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_regional_nome").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_p_tam_camisa").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_p_tam_camisa").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_p_tam_camisa",
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
       $("#SC_p_tam_camisa").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_p_tam_camisa").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_contato_usuario_nome").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_contato_usuario_nome").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_contato_usuario_nome",
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
       $("#SC_contato_usuario_nome").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_contato_usuario_nome").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_contato_status_dsc").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_contato_status_dsc").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_contato_status_dsc",
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
       $("#SC_contato_status_dsc").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_contato_status_dsc").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_presenca_status_dsc").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_presenca_status_dsc").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_presenca_status_dsc",
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
       $("#SC_presenca_status_dsc").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_presenca_status_dsc").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_presenca_usuario_dsc").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_presenca_usuario_dsc").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_presenca_usuario_dsc",
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
       $("#SC_presenca_usuario_dsc").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_presenca_usuario_dsc").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_presenca_status").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_presenca_status").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_presenca_status",
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
       $("#SC_presenca_status").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_presenca_status").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_hospedagem_tipo_pessoa").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_hospedagem_tipo_pessoa").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_hospedagem_tipo_pessoa",
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
       $("#SC_hospedagem_tipo_pessoa").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_hospedagem_tipo_pessoa").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_hotel_fantasia").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_hotel_fantasia").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_hotel_fantasia",
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
       $("#SC_hotel_fantasia").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_hotel_fantasia").val( $(this).val() );
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
      if ($this->Ini->Embutida_iframe || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['dashboard_info']['compact_mode'])
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
    <div class="scFilterHeaderFont" style="float: left; text-transform: uppercase;">Relatório RSVP</div>
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
             $p_tam_camisa_cond, $p_tam_camisa, $p_tam_camisa_autocomp,
             $publico_nome_cond, $publico_nome, $publico_nome_autocomp,
             $regional_nome_cond, $regional_nome, $regional_nome_autocomp,
             $p_nome_cond, $p_nome, $p_nome_autocomp,
             $contato_status_dsc_cond, $contato_status_dsc, $contato_status_dsc_autocomp,
             $presenca_status_dsc_cond, $presenca_status_dsc, $presenca_status_dsc_autocomp,
             $hotel_fantasia_cond, $hotel_fantasia, $hotel_fantasia_autocomp,
             $contato_usuario_nome_cond, $contato_usuario_nome, $contato_usuario_nome_autocomp,
             $presenca_usuario_dsc_cond, $presenca_usuario_dsc, $presenca_usuario_dsc_autocomp,
             $hospedagem_tipo_pessoa_cond, $hospedagem_tipo_pessoa, $hospedagem_tipo_pessoa_autocomp,
             $hospedagem_dtchkin_cond, $hospedagem_dtchkin, $hospedagem_dtchkin_dia, $hospedagem_dtchkin_mes, $hospedagem_dtchkin_ano, $hospedagem_dtchkin_input_2_dia, $hospedagem_dtchkin_input_2_mes, $hospedagem_dtchkin_input_2_ano,
             $hospedagem_hrchkin_cond, $hospedagem_hrchkin, $hospedagem_hrchkin_hor, $hospedagem_hrchkin_min, $hospedagem_hrchkin_seg,
             $hospedagem_dtchkout_cond, $hospedagem_dtchkout, $hospedagem_dtchkout_dia, $hospedagem_dtchkout_mes, $hospedagem_dtchkout_ano, $hospedagem_dtchkout_input_2_dia, $hospedagem_dtchkout_input_2_mes, $hospedagem_dtchkout_input_2_ano,
             $hospedagem_hrchkout_cond, $hospedagem_hrchkout, $hospedagem_hrchkout_hor, $hospedagem_hrchkout_min, $hospedagem_hrchkout_seg,
             $presenca_status_cond, $presenca_status, $presenca_status_autocomp,
             $nm_url_saida, $nm_apl_dependente, $nmgp_parms, $bprocessa, $nmgp_save_name, $NM_operador, $NM_filters, $nmgp_save_option, $NM_filters_del, $Script_BI;
      $Script_BI = "";
      $this->nmgp_botoes['clear'] = "on";
      $this->nmgp_botoes['save'] = "on";
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_rsvp_part_r']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_rsvp_part_r']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_rsvp_part_r']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("grid_rsvp_part_r", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
      {
          $this->aba_iframe = true;
      }
      $nmgp_tab_label = "";
      $delimitador = "##@@";
      if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']) && $bprocessa != "recarga" && $bprocessa != "save_form" && $bprocessa != "filter_save" && $bprocessa != "filter_delete")
      {
      }
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']) && $bprocessa != "recarga" && $bprocessa != "save_form" && $bprocessa != "filter_save" && $bprocessa != "filter_delete")
      { 
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca'], $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $p_tam_camisa = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['p_tam_camisa']; 
          $p_tam_camisa_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['p_tam_camisa_cond']; 
          $publico_nome = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['publico_nome']; 
          $publico_nome_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['publico_nome_cond']; 
          $regional_nome = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['regional_nome']; 
          $regional_nome_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['regional_nome_cond']; 
          $p_nome = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['p_nome']; 
          $p_nome_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['p_nome_cond']; 
          $contato_status_dsc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['contato_status_dsc']; 
          $contato_status_dsc_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['contato_status_dsc_cond']; 
          $presenca_status_dsc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['presenca_status_dsc']; 
          $presenca_status_dsc_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['presenca_status_dsc_cond']; 
          $hotel_fantasia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hotel_fantasia']; 
          $hotel_fantasia_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hotel_fantasia_cond']; 
          $contato_usuario_nome = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['contato_usuario_nome']; 
          $contato_usuario_nome_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['contato_usuario_nome_cond']; 
          $presenca_usuario_dsc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['presenca_usuario_dsc']; 
          $presenca_usuario_dsc_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['presenca_usuario_dsc_cond']; 
          $hospedagem_tipo_pessoa = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_tipo_pessoa']; 
          $hospedagem_tipo_pessoa_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_tipo_pessoa_cond']; 
          $hospedagem_dtchkin_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkin_dia']; 
          $hospedagem_dtchkin_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkin_mes']; 
          $hospedagem_dtchkin_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkin_ano']; 
          $hospedagem_dtchkin_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkin_input_2_dia']; 
          $hospedagem_dtchkin_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkin_input_2_mes']; 
          $hospedagem_dtchkin_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkin_input_2_ano']; 
          $hospedagem_dtchkin_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkin_cond']; 
          $hospedagem_hrchkin_hor = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_hrchkin_hor']; 
          $hospedagem_hrchkin_min = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_hrchkin_min']; 
          $hospedagem_hrchkin_seg = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_hrchkin_seg']; 
          $hospedagem_hrchkin_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_hrchkin_cond']; 
          $hospedagem_dtchkout_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkout_dia']; 
          $hospedagem_dtchkout_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkout_mes']; 
          $hospedagem_dtchkout_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkout_ano']; 
          $hospedagem_dtchkout_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkout_input_2_dia']; 
          $hospedagem_dtchkout_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkout_input_2_mes']; 
          $hospedagem_dtchkout_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkout_input_2_ano']; 
          $hospedagem_dtchkout_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkout_cond']; 
          $hospedagem_hrchkout_hor = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_hrchkout_hor']; 
          $hospedagem_hrchkout_min = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_hrchkout_min']; 
          $hospedagem_hrchkout_seg = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_hrchkout_seg']; 
          $hospedagem_hrchkout_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_hrchkout_cond']; 
          $presenca_status = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['presenca_status']; 
          $presenca_status_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['presenca_status_cond']; 
          $this->NM_operador = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['NM_operador']; 
      } 
      if (!isset($p_tam_camisa_cond) || empty($p_tam_camisa_cond))
      {
         $p_tam_camisa_cond = "qp";
      }
      if (!isset($publico_nome_cond) || empty($publico_nome_cond))
      {
         $publico_nome_cond = "qp";
      }
      if (!isset($regional_nome_cond) || empty($regional_nome_cond))
      {
         $regional_nome_cond = "qp";
      }
      if (!isset($p_nome_cond) || empty($p_nome_cond))
      {
         $p_nome_cond = "qp";
      }
      if (!isset($contato_status_dsc_cond) || empty($contato_status_dsc_cond))
      {
         $contato_status_dsc_cond = "qp";
      }
      if (!isset($presenca_status_dsc_cond) || empty($presenca_status_dsc_cond))
      {
         $presenca_status_dsc_cond = "qp";
      }
      if (!isset($hotel_fantasia_cond) || empty($hotel_fantasia_cond))
      {
         $hotel_fantasia_cond = "qp";
      }
      if (!isset($contato_usuario_nome_cond) || empty($contato_usuario_nome_cond))
      {
         $contato_usuario_nome_cond = "qp";
      }
      if (!isset($presenca_usuario_dsc_cond) || empty($presenca_usuario_dsc_cond))
      {
         $presenca_usuario_dsc_cond = "qp";
      }
      if (!isset($hospedagem_tipo_pessoa_cond) || empty($hospedagem_tipo_pessoa_cond))
      {
         $hospedagem_tipo_pessoa_cond = "qp";
      }
      if (!isset($hospedagem_dtchkin_cond) || empty($hospedagem_dtchkin_cond))
      {
         $hospedagem_dtchkin_cond = "eq";
      }
      if (!isset($hospedagem_hrchkin_cond) || empty($hospedagem_hrchkin_cond))
      {
         $hospedagem_hrchkin_cond = "eq";
      }
      if (!isset($hospedagem_dtchkout_cond) || empty($hospedagem_dtchkout_cond))
      {
         $hospedagem_dtchkout_cond = "eq";
      }
      if (!isset($hospedagem_hrchkout_cond) || empty($hospedagem_hrchkout_cond))
      {
         $hospedagem_hrchkout_cond = "eq";
      }
      if (!isset($presenca_status_cond) || empty($presenca_status_cond))
      {
         $presenca_status_cond = "qp";
      }
      $display_aberto  = "style=display:";
      $display_fechado = "style=display:none";
      $opc_hide_input = array("nu","nn","ep","ne");
      $str_hide_p_tam_camisa = (in_array($p_tam_camisa_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_publico_nome = (in_array($publico_nome_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_regional_nome = (in_array($regional_nome_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_p_nome = (in_array($p_nome_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_contato_status_dsc = (in_array($contato_status_dsc_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_presenca_status_dsc = (in_array($presenca_status_dsc_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_hotel_fantasia = (in_array($hotel_fantasia_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_contato_usuario_nome = (in_array($contato_usuario_nome_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_presenca_usuario_dsc = (in_array($presenca_usuario_dsc_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_hospedagem_tipo_pessoa = (in_array($hospedagem_tipo_pessoa_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_hospedagem_dtchkin = (in_array($hospedagem_dtchkin_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_hospedagem_hrchkin = (in_array($hospedagem_hrchkin_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_hospedagem_dtchkout = (in_array($hospedagem_dtchkout_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_hospedagem_hrchkout = (in_array($hospedagem_hrchkout_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_presenca_status = (in_array($presenca_status_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;

      $str_display_p_tam_camisa = ('bw' == $p_tam_camisa_cond) ? $display_aberto : $display_fechado;
      $str_display_publico_nome = ('bw' == $publico_nome_cond) ? $display_aberto : $display_fechado;
      $str_display_regional_nome = ('bw' == $regional_nome_cond) ? $display_aberto : $display_fechado;
      $str_display_p_nome = ('bw' == $p_nome_cond) ? $display_aberto : $display_fechado;
      $str_display_contato_status_dsc = ('bw' == $contato_status_dsc_cond) ? $display_aberto : $display_fechado;
      $str_display_presenca_status_dsc = ('bw' == $presenca_status_dsc_cond) ? $display_aberto : $display_fechado;
      $str_display_hotel_fantasia = ('bw' == $hotel_fantasia_cond) ? $display_aberto : $display_fechado;
      $str_display_contato_usuario_nome = ('bw' == $contato_usuario_nome_cond) ? $display_aberto : $display_fechado;
      $str_display_presenca_usuario_dsc = ('bw' == $presenca_usuario_dsc_cond) ? $display_aberto : $display_fechado;
      $str_display_hospedagem_tipo_pessoa = ('bw' == $hospedagem_tipo_pessoa_cond) ? $display_aberto : $display_fechado;
      $str_display_hospedagem_dtchkin = ('bw' == $hospedagem_dtchkin_cond) ? $display_aberto : $display_fechado;
      $str_display_hospedagem_hrchkin = ('bw' == $hospedagem_hrchkin_cond) ? $display_aberto : $display_fechado;
      $str_display_hospedagem_dtchkout = ('bw' == $hospedagem_dtchkout_cond) ? $display_aberto : $display_fechado;
      $str_display_hospedagem_hrchkout = ('bw' == $hospedagem_hrchkout_cond) ? $display_aberto : $display_fechado;
      $str_display_presenca_status = ('bw' == $presenca_status_cond) ? $display_aberto : $display_fechado;

      if (!isset($p_tam_camisa) || $p_tam_camisa == "")
      {
          $p_tam_camisa = "";
      }
      if (isset($p_tam_camisa) && !empty($p_tam_camisa))
      {
         $tmp_pos = (is_string($p_tam_camisa)) ? strpos($p_tam_camisa, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $p_tam_camisa = substr($p_tam_camisa, 0, $tmp_pos);
         }
      }
      if (!isset($publico_nome) || $publico_nome == "")
      {
          $publico_nome = "";
      }
      if (isset($publico_nome) && !empty($publico_nome))
      {
         $tmp_pos = (is_string($publico_nome)) ? strpos($publico_nome, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $publico_nome = substr($publico_nome, 0, $tmp_pos);
         }
      }
      if (!isset($regional_nome) || $regional_nome == "")
      {
          $regional_nome = "";
      }
      if (isset($regional_nome) && !empty($regional_nome))
      {
         $tmp_pos = (is_string($regional_nome)) ? strpos($regional_nome, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $regional_nome = substr($regional_nome, 0, $tmp_pos);
         }
      }
      if (!isset($p_nome) || $p_nome == "")
      {
          $p_nome = "";
      }
      if (isset($p_nome) && !empty($p_nome))
      {
         $tmp_pos = (is_string($p_nome)) ? strpos($p_nome, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $p_nome = substr($p_nome, 0, $tmp_pos);
         }
      }
      if (!isset($contato_status_dsc) || $contato_status_dsc == "")
      {
          $contato_status_dsc = "";
      }
      if (isset($contato_status_dsc) && !empty($contato_status_dsc))
      {
         $tmp_pos = (is_string($contato_status_dsc)) ? strpos($contato_status_dsc, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $contato_status_dsc = substr($contato_status_dsc, 0, $tmp_pos);
         }
      }
      if (!isset($presenca_status_dsc) || $presenca_status_dsc == "")
      {
          $presenca_status_dsc = "";
      }
      if (isset($presenca_status_dsc) && !empty($presenca_status_dsc))
      {
         $tmp_pos = (is_string($presenca_status_dsc)) ? strpos($presenca_status_dsc, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $presenca_status_dsc = substr($presenca_status_dsc, 0, $tmp_pos);
         }
      }
      if (!isset($hotel_fantasia) || $hotel_fantasia == "")
      {
          $hotel_fantasia = "";
      }
      if (isset($hotel_fantasia) && !empty($hotel_fantasia))
      {
         $tmp_pos = (is_string($hotel_fantasia)) ? strpos($hotel_fantasia, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $hotel_fantasia = substr($hotel_fantasia, 0, $tmp_pos);
         }
      }
      if (!isset($contato_usuario_nome) || $contato_usuario_nome == "")
      {
          $contato_usuario_nome = "";
      }
      if (isset($contato_usuario_nome) && !empty($contato_usuario_nome))
      {
         $tmp_pos = (is_string($contato_usuario_nome)) ? strpos($contato_usuario_nome, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $contato_usuario_nome = substr($contato_usuario_nome, 0, $tmp_pos);
         }
      }
      if (!isset($presenca_usuario_dsc) || $presenca_usuario_dsc == "")
      {
          $presenca_usuario_dsc = "";
      }
      if (isset($presenca_usuario_dsc) && !empty($presenca_usuario_dsc))
      {
         $tmp_pos = (is_string($presenca_usuario_dsc)) ? strpos($presenca_usuario_dsc, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $presenca_usuario_dsc = substr($presenca_usuario_dsc, 0, $tmp_pos);
         }
      }
      if (!isset($hospedagem_tipo_pessoa) || $hospedagem_tipo_pessoa == "")
      {
          $hospedagem_tipo_pessoa = "";
      }
      if (isset($hospedagem_tipo_pessoa) && !empty($hospedagem_tipo_pessoa))
      {
         $tmp_pos = (is_string($hospedagem_tipo_pessoa)) ? strpos($hospedagem_tipo_pessoa, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $hospedagem_tipo_pessoa = substr($hospedagem_tipo_pessoa, 0, $tmp_pos);
         }
      }
      if (!isset($hospedagem_dtchkin) || $hospedagem_dtchkin == "")
      {
          $hospedagem_dtchkin = "";
      }
      if (isset($hospedagem_dtchkin) && !empty($hospedagem_dtchkin))
      {
         $tmp_pos = (is_string($hospedagem_dtchkin)) ? strpos($hospedagem_dtchkin, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $hospedagem_dtchkin = substr($hospedagem_dtchkin, 0, $tmp_pos);
         }
      }
      if (!isset($hospedagem_hrchkin) || $hospedagem_hrchkin == "")
      {
          $hospedagem_hrchkin = "";
      }
      if (isset($hospedagem_hrchkin) && !empty($hospedagem_hrchkin))
      {
         $tmp_pos = (is_string($hospedagem_hrchkin)) ? strpos($hospedagem_hrchkin, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $hospedagem_hrchkin = substr($hospedagem_hrchkin, 0, $tmp_pos);
         }
      }
      if (!isset($hospedagem_dtchkout) || $hospedagem_dtchkout == "")
      {
          $hospedagem_dtchkout = "";
      }
      if (isset($hospedagem_dtchkout) && !empty($hospedagem_dtchkout))
      {
         $tmp_pos = (is_string($hospedagem_dtchkout)) ? strpos($hospedagem_dtchkout, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $hospedagem_dtchkout = substr($hospedagem_dtchkout, 0, $tmp_pos);
         }
      }
      if (!isset($hospedagem_hrchkout) || $hospedagem_hrchkout == "")
      {
          $hospedagem_hrchkout = "";
      }
      if (isset($hospedagem_hrchkout) && !empty($hospedagem_hrchkout))
      {
         $tmp_pos = (is_string($hospedagem_hrchkout)) ? strpos($hospedagem_hrchkout, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $hospedagem_hrchkout = substr($hospedagem_hrchkout, 0, $tmp_pos);
         }
      }
      if (!isset($presenca_status) || $presenca_status == "")
      {
          $presenca_status = "";
      }
      if (isset($presenca_status) && !empty($presenca_status))
      {
         $tmp_pos = (is_string($presenca_status)) ? strpos($presenca_status, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $presenca_status = substr($presenca_status, 0, $tmp_pos);
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
   if (is_file("grid_rsvp_part_r_help.txt"))
   {
      $Arq_WebHelp = file("grid_rsvp_part_r_help.txt"); 
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
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_rsvp_part_r']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_rsvp_part_r']['start'] == 'filter' && $nm_apl_dependente != 1)
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





      <TD id='SC_p_tam_camisa_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['p_tam_camisa'])) ? $this->New_label['p_tam_camisa'] : "Camisa"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_p_tam_camisa_cond" name="p_tam_camisa_cond" onChange="nm_campos_between(document.getElementById('id_vis_p_tam_camisa'), this, 'p_tam_camisa')">
       <OPTION value="qp" <?php if ("qp" == $p_tam_camisa_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $p_tam_camisa_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $p_tam_camisa_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $p_tam_camisa_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_p_tam_camisa" <?php echo $str_hide_p_tam_camisa?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['p_tam_camisa'])) ? $this->New_label['p_tam_camisa'] : "Camisa";
 $nmgp_tab_label .= "p_tam_camisa?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($p_tam_camisa != "")
      {
      $p_tam_camisa_look = (is_string($p_tam_camisa) ? substr($this->Db->qstr($p_tam_camisa), 1, -1) : $p_tam_camisa); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct p_tam_camisa from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#p_tam_camisa#lowerF# = #lowerI#'$p_tam_camisa_look'#lowerF# order by p_tam_camisa"; 
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
      if (isset($nmgp_def_dados[0][$p_tam_camisa]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$p_tam_camisa];
      }
      else
      {
          $sAutocompValue = $p_tam_camisa;
      }
?>
<INPUT  type="text" id="SC_p_tam_camisa" name="p_tam_camisa" value="<?php echo NM_encode_input($p_tam_camisa) ?>"  size=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_p_tam_camisa" name="p_tam_camisa_autocomp" size="30"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 30, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_publico_nome_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['publico_nome'])) ? $this->New_label['publico_nome'] : "Público"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_publico_nome_cond" name="publico_nome_cond" onChange="nm_campos_between(document.getElementById('id_vis_publico_nome'), this, 'publico_nome')">
       <OPTION value="qp" <?php if ("qp" == $publico_nome_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $publico_nome_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $publico_nome_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $publico_nome_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_publico_nome" <?php echo $str_hide_publico_nome?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['publico_nome'])) ? $this->New_label['publico_nome'] : "Público";
 $nmgp_tab_label .= "publico_nome?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($publico_nome != "")
      {
      $publico_nome_look = (is_string($publico_nome) ? substr($this->Db->qstr($publico_nome), 1, -1) : $publico_nome); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct publico_nome from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#publico_nome#lowerF# = #lowerI#'$publico_nome_look'#lowerF# order by publico_nome"; 
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
      if (isset($nmgp_def_dados[0][$publico_nome]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$publico_nome];
      }
      else
      {
          $sAutocompValue = $publico_nome;
      }
?>
<INPUT  type="text" id="SC_publico_nome" name="publico_nome" value="<?php echo NM_encode_input($publico_nome) ?>"  size=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_publico_nome" name="publico_nome_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 50, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_regional_nome_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['regional_nome'])) ? $this->New_label['regional_nome'] : "Regional"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_regional_nome_cond" name="regional_nome_cond" onChange="nm_campos_between(document.getElementById('id_vis_regional_nome'), this, 'regional_nome')">
       <OPTION value="qp" <?php if ("qp" == $regional_nome_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $regional_nome_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $regional_nome_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $regional_nome_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_regional_nome" <?php echo $str_hide_regional_nome?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['regional_nome'])) ? $this->New_label['regional_nome'] : "Regional";
 $nmgp_tab_label .= "regional_nome?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($regional_nome != "")
      {
      $regional_nome_look = (is_string($regional_nome) ? substr($this->Db->qstr($regional_nome), 1, -1) : $regional_nome); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct regional_nome from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#regional_nome#lowerF# = #lowerI#'$regional_nome_look'#lowerF# order by regional_nome"; 
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
      if (isset($nmgp_def_dados[0][$regional_nome]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$regional_nome];
      }
      else
      {
          $sAutocompValue = $regional_nome;
      }
?>
<INPUT  type="text" id="SC_regional_nome" name="regional_nome" value="<?php echo NM_encode_input($regional_nome) ?>"  size=50 alt="{datatype: 'text', maxLength: 60, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_regional_nome" name="regional_nome_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 60, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_p_nome_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['p_nome'])) ? $this->New_label['p_nome'] : "Participante"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_p_nome_cond" name="p_nome_cond" onChange="nm_campos_between(document.getElementById('id_vis_p_nome'), this, 'p_nome')">
       <OPTION value="qp" <?php if ("qp" == $p_nome_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $p_nome_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $p_nome_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $p_nome_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_p_nome" <?php echo $str_hide_p_nome?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['p_nome'])) ? $this->New_label['p_nome'] : "Participante";
 $nmgp_tab_label .= "p_nome?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($p_nome != "")
      {
      $p_nome_look = (is_string($p_nome) ? substr($this->Db->qstr($p_nome), 1, -1) : $p_nome); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct p_nome from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#p_nome#lowerF# = #lowerI#'$p_nome_look'#lowerF# order by p_nome"; 
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
      if (isset($nmgp_def_dados[0][$p_nome]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$p_nome];
      }
      else
      {
          $sAutocompValue = $p_nome;
      }
?>
<INPUT  type="text" id="SC_p_nome" name="p_nome" value="<?php echo NM_encode_input($p_nome) ?>"  size=50 alt="{datatype: 'text', maxLength: 60, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_p_nome" name="p_nome_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 60, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_contato_status_dsc_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['contato_status_dsc'])) ? $this->New_label['contato_status_dsc'] : "Contato Status"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_contato_status_dsc_cond" name="contato_status_dsc_cond" onChange="nm_campos_between(document.getElementById('id_vis_contato_status_dsc'), this, 'contato_status_dsc')">
       <OPTION value="qp" <?php if ("qp" == $contato_status_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $contato_status_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $contato_status_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $contato_status_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_contato_status_dsc" <?php echo $str_hide_contato_status_dsc?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['contato_status_dsc'])) ? $this->New_label['contato_status_dsc'] : "Contato Status";
 $nmgp_tab_label .= "contato_status_dsc?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($contato_status_dsc != "")
      {
      $contato_status_dsc_look = (is_string($contato_status_dsc) ? substr($this->Db->qstr($contato_status_dsc), 1, -1) : $contato_status_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct contato_status_dsc from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#contato_status_dsc#lowerF# = #lowerI#'$contato_status_dsc_look'#lowerF# order by contato_status_dsc"; 
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
      if (isset($nmgp_def_dados[0][$contato_status_dsc]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$contato_status_dsc];
      }
      else
      {
          $sAutocompValue = $contato_status_dsc;
      }
?>
<INPUT  type="text" id="SC_contato_status_dsc" name="contato_status_dsc" value="<?php echo NM_encode_input($contato_status_dsc) ?>"  size=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_contato_status_dsc" name="contato_status_dsc_autocomp" size="20"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_presenca_status_dsc_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['presenca_status_dsc'])) ? $this->New_label['presenca_status_dsc'] : "Presença Status "; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_presenca_status_dsc_cond" name="presenca_status_dsc_cond" onChange="nm_campos_between(document.getElementById('id_vis_presenca_status_dsc'), this, 'presenca_status_dsc')">
       <OPTION value="qp" <?php if ("qp" == $presenca_status_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $presenca_status_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $presenca_status_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $presenca_status_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_presenca_status_dsc" <?php echo $str_hide_presenca_status_dsc?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['presenca_status_dsc'])) ? $this->New_label['presenca_status_dsc'] : "Presença Status ";
 $nmgp_tab_label .= "presenca_status_dsc?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($presenca_status_dsc != "")
      {
      $presenca_status_dsc_look = (is_string($presenca_status_dsc) ? substr($this->Db->qstr($presenca_status_dsc), 1, -1) : $presenca_status_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct presenca_status_dsc from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#presenca_status_dsc#lowerF# = #lowerI#'$presenca_status_dsc_look'#lowerF# order by presenca_status_dsc"; 
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
      if (isset($nmgp_def_dados[0][$presenca_status_dsc]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$presenca_status_dsc];
      }
      else
      {
          $sAutocompValue = $presenca_status_dsc;
      }
?>
<INPUT  type="text" id="SC_presenca_status_dsc" name="presenca_status_dsc" value="<?php echo NM_encode_input($presenca_status_dsc) ?>"  size=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_presenca_status_dsc" name="presenca_status_dsc_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 50, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_hotel_fantasia_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['hotel_fantasia'])) ? $this->New_label['hotel_fantasia'] : "Hotel "; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_hotel_fantasia_cond" name="hotel_fantasia_cond" onChange="nm_campos_between(document.getElementById('id_vis_hotel_fantasia'), this, 'hotel_fantasia')">
       <OPTION value="qp" <?php if ("qp" == $hotel_fantasia_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $hotel_fantasia_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $hotel_fantasia_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $hotel_fantasia_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_hotel_fantasia" <?php echo $str_hide_hotel_fantasia?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['hotel_fantasia'])) ? $this->New_label['hotel_fantasia'] : "Hotel ";
 $nmgp_tab_label .= "hotel_fantasia?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($hotel_fantasia != "")
      {
      $hotel_fantasia_look = (is_string($hotel_fantasia) ? substr($this->Db->qstr($hotel_fantasia), 1, -1) : $hotel_fantasia); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct hotel_fantasia from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#hotel_fantasia#lowerF# = #lowerI#'$hotel_fantasia_look'#lowerF# order by hotel_fantasia"; 
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
      if (isset($nmgp_def_dados[0][$hotel_fantasia]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$hotel_fantasia];
      }
      else
      {
          $sAutocompValue = $hotel_fantasia;
      }
?>
<INPUT  type="text" id="SC_hotel_fantasia" name="hotel_fantasia" value="<?php echo NM_encode_input($hotel_fantasia) ?>"  size=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_hotel_fantasia" name="hotel_fantasia_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 50, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_contato_usuario_nome_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['contato_usuario_nome'])) ? $this->New_label['contato_usuario_nome'] : "Contato Atendente"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_contato_usuario_nome_cond" name="contato_usuario_nome_cond" onChange="nm_campos_between(document.getElementById('id_vis_contato_usuario_nome'), this, 'contato_usuario_nome')">
       <OPTION value="qp" <?php if ("qp" == $contato_usuario_nome_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $contato_usuario_nome_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $contato_usuario_nome_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $contato_usuario_nome_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_contato_usuario_nome" <?php echo $str_hide_contato_usuario_nome?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['contato_usuario_nome'])) ? $this->New_label['contato_usuario_nome'] : "Contato Atendente";
 $nmgp_tab_label .= "contato_usuario_nome?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($contato_usuario_nome != "")
      {
      $contato_usuario_nome_look = (is_string($contato_usuario_nome) ? substr($this->Db->qstr($contato_usuario_nome), 1, -1) : $contato_usuario_nome); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct contato_usuario_nome from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#contato_usuario_nome#lowerF# = #lowerI#'$contato_usuario_nome_look'#lowerF# order by contato_usuario_nome"; 
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
      if (isset($nmgp_def_dados[0][$contato_usuario_nome]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$contato_usuario_nome];
      }
      else
      {
          $sAutocompValue = $contato_usuario_nome;
      }
?>
<INPUT  type="text" id="SC_contato_usuario_nome" name="contato_usuario_nome" value="<?php echo NM_encode_input($contato_usuario_nome) ?>"  size=50 alt="{datatype: 'text', maxLength: 60, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_contato_usuario_nome" name="contato_usuario_nome_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 60, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_presenca_usuario_dsc_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['presenca_usuario_dsc'])) ? $this->New_label['presenca_usuario_dsc'] : "Presenca Atendente"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_presenca_usuario_dsc_cond" name="presenca_usuario_dsc_cond" onChange="nm_campos_between(document.getElementById('id_vis_presenca_usuario_dsc'), this, 'presenca_usuario_dsc')">
       <OPTION value="qp" <?php if ("qp" == $presenca_usuario_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $presenca_usuario_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $presenca_usuario_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $presenca_usuario_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_presenca_usuario_dsc" <?php echo $str_hide_presenca_usuario_dsc?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['presenca_usuario_dsc'])) ? $this->New_label['presenca_usuario_dsc'] : "Presenca Atendente";
 $nmgp_tab_label .= "presenca_usuario_dsc?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($presenca_usuario_dsc != "")
      {
      $presenca_usuario_dsc_look = (is_string($presenca_usuario_dsc) ? substr($this->Db->qstr($presenca_usuario_dsc), 1, -1) : $presenca_usuario_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct presenca_usuario_dsc from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#presenca_usuario_dsc#lowerF# = #lowerI#'$presenca_usuario_dsc_look'#lowerF# order by presenca_usuario_dsc"; 
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
      if (isset($nmgp_def_dados[0][$presenca_usuario_dsc]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$presenca_usuario_dsc];
      }
      else
      {
          $sAutocompValue = $presenca_usuario_dsc;
      }
?>
<INPUT  type="text" id="SC_presenca_usuario_dsc" name="presenca_usuario_dsc" value="<?php echo NM_encode_input($presenca_usuario_dsc) ?>"  size=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_presenca_usuario_dsc" name="presenca_usuario_dsc_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 50, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_hospedagem_tipo_pessoa_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['hospedagem_tipo_pessoa'])) ? $this->New_label['hospedagem_tipo_pessoa'] : "Hospedagem Tipo Pessoa"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_hospedagem_tipo_pessoa_cond" name="hospedagem_tipo_pessoa_cond" onChange="nm_campos_between(document.getElementById('id_vis_hospedagem_tipo_pessoa'), this, 'hospedagem_tipo_pessoa')">
       <OPTION value="qp" <?php if ("qp" == $hospedagem_tipo_pessoa_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $hospedagem_tipo_pessoa_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $hospedagem_tipo_pessoa_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $hospedagem_tipo_pessoa_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_hospedagem_tipo_pessoa" <?php echo $str_hide_hospedagem_tipo_pessoa?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['hospedagem_tipo_pessoa'])) ? $this->New_label['hospedagem_tipo_pessoa'] : "Hospedagem Tipo Pessoa";
 $nmgp_tab_label .= "hospedagem_tipo_pessoa?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($hospedagem_tipo_pessoa != "")
      {
      $hospedagem_tipo_pessoa_look = (is_string($hospedagem_tipo_pessoa) ? substr($this->Db->qstr($hospedagem_tipo_pessoa), 1, -1) : $hospedagem_tipo_pessoa); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct hospedagem_tipo_pessoa from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#hospedagem_tipo_pessoa#lowerF# = #lowerI#'$hospedagem_tipo_pessoa_look'#lowerF# order by hospedagem_tipo_pessoa"; 
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
      if (isset($nmgp_def_dados[0][$hospedagem_tipo_pessoa]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$hospedagem_tipo_pessoa];
      }
      else
      {
          $sAutocompValue = $hospedagem_tipo_pessoa;
      }
?>
<INPUT  type="text" id="SC_hospedagem_tipo_pessoa" name="hospedagem_tipo_pessoa" value="<?php echo NM_encode_input($hospedagem_tipo_pessoa) ?>"  size=1 alt="{datatype: 'text', maxLength: 1, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_hospedagem_tipo_pessoa" name="hospedagem_tipo_pessoa_autocomp" size="1"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 1, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_hospedagem_dtchkin_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['hospedagem_dtchkin'])) ? $this->New_label['hospedagem_dtchkin'] : "Data CheckI In"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_hospedagem_dtchkin_cond" name="hospedagem_dtchkin_cond" onChange="nm_campos_between(document.getElementById('id_vis_hospedagem_dtchkin'), this, 'hospedagem_dtchkin')">
       <OPTION value="eq" <?php if ("eq" == $hospedagem_dtchkin_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="gt" <?php if ("gt" == $hospedagem_dtchkin_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $hospedagem_dtchkin_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $hospedagem_dtchkin_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_hospedagem_dtchkin" <?php echo $str_hide_hospedagem_dtchkin?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['hospedagem_dtchkin'])) ? $this->New_label['hospedagem_dtchkin'] : "Data CheckI In";
 $nmgp_tab_label .= "hospedagem_dtchkin?#?" . $SC_Label . "?@?";
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
<span id='id_date_part_hospedagem_dtchkin_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_hospedagem_dtchkin_dia" name="hospedagem_dtchkin_dia" value="<?php echo NM_encode_input($hospedagem_dtchkin_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_hospedagem_dtchkin_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_hospedagem_dtchkin_mes" name="hospedagem_dtchkin_mes" value="<?php echo NM_encode_input($hospedagem_dtchkin_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_hospedagem_dtchkin_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_hospedagem_dtchkin_ano" name="hospedagem_dtchkin_ano" value="<?php echo NM_encode_input($hospedagem_dtchkin_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
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
        <SPAN id="id_css_hospedagem_dtchkin"  class="scFilterFieldFontOdd">
 <?php echo $date_format_show ?>         </SPAN>
                 </TD>
       </TR>
       <TR valign="top">
        <TD id="id_vis_hospedagem_dtchkin"  <?php echo $str_display_hospedagem_dtchkin; ?> class="scFilterFieldFontOdd">
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
<span id='id_date_part_hospedagem_dtchkin_input_2_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_hospedagem_dtchkin_input_2_dia" name="hospedagem_dtchkin_input_2_dia" value="<?php echo NM_encode_input($hospedagem_dtchkin_input_2_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_hospedagem_dtchkin_input_2_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_hospedagem_dtchkin_input_2_mes" name="hospedagem_dtchkin_input_2_mes" value="<?php echo NM_encode_input($hospedagem_dtchkin_input_2_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_hospedagem_dtchkin_input_2_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_hospedagem_dtchkin_input_2_ano" name="hospedagem_dtchkin_input_2_ano" value="<?php echo NM_encode_input($hospedagem_dtchkin_input_2_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
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





      <TD id='SC_hospedagem_hrchkin_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['hospedagem_hrchkin'])) ? $this->New_label['hospedagem_hrchkin'] : "Hora Check In"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_hospedagem_hrchkin_cond" name="hospedagem_hrchkin_cond" onChange="nm_campos_between(document.getElementById('id_vis_hospedagem_hrchkin'), this, 'hospedagem_hrchkin')">
       <OPTION value="eq" <?php if ("eq" == $hospedagem_hrchkin_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ii" <?php if ("ii" == $hospedagem_hrchkin_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_stts_with'] ?></OPTION>
       <OPTION value="qp" <?php if ("qp" == $hospedagem_hrchkin_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="df" <?php if ("df" == $hospedagem_hrchkin_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_dife'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_hospedagem_hrchkin" <?php echo $str_hide_hospedagem_hrchkin?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['hospedagem_hrchkin'])) ? $this->New_label['hospedagem_hrchkin'] : "Hora Check In";
 $nmgp_tab_label .= "hospedagem_hrchkin?#?" . $SC_Label . "?@?";
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
<span id='id_date_part_hospedagem_hrchkin_HH' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_hospedagem_hrchkin_hor" name="hospedagem_hrchkin_hor" value="<?php echo NM_encode_input($hospedagem_hrchkin_hor); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_hospedagem_hrchkin_II' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_hospedagem_hrchkin_min" name="hospedagem_hrchkin_min" value="<?php echo NM_encode_input($hospedagem_hrchkin_min); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_hospedagem_hrchkin_SS' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_hospedagem_hrchkin_seg" name="hospedagem_hrchkin_seg" value="<?php echo NM_encode_input($hospedagem_hrchkin_seg); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
        <SPAN id="id_css_hospedagem_hrchkin"  class="scFilterFieldFontEven">
 <?php echo $date_format_show ?>         </SPAN>
         
        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_hospedagem_dtchkout_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['hospedagem_dtchkout'])) ? $this->New_label['hospedagem_dtchkout'] : "Data Check Out"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_hospedagem_dtchkout_cond" name="hospedagem_dtchkout_cond" onChange="nm_campos_between(document.getElementById('id_vis_hospedagem_dtchkout'), this, 'hospedagem_dtchkout')">
       <OPTION value="eq" <?php if ("eq" == $hospedagem_dtchkout_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="gt" <?php if ("gt" == $hospedagem_dtchkout_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $hospedagem_dtchkout_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $hospedagem_dtchkout_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_hospedagem_dtchkout" <?php echo $str_hide_hospedagem_dtchkout?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['hospedagem_dtchkout'])) ? $this->New_label['hospedagem_dtchkout'] : "Data Check Out";
 $nmgp_tab_label .= "hospedagem_dtchkout?#?" . $SC_Label . "?@?";
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
<span id='id_date_part_hospedagem_dtchkout_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_hospedagem_dtchkout_dia" name="hospedagem_dtchkout_dia" value="<?php echo NM_encode_input($hospedagem_dtchkout_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_hospedagem_dtchkout_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_hospedagem_dtchkout_mes" name="hospedagem_dtchkout_mes" value="<?php echo NM_encode_input($hospedagem_dtchkout_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_hospedagem_dtchkout_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_hospedagem_dtchkout_ano" name="hospedagem_dtchkout_ano" value="<?php echo NM_encode_input($hospedagem_dtchkout_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
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
        <SPAN id="id_css_hospedagem_dtchkout"  class="scFilterFieldFontOdd">
 <?php echo $date_format_show ?>         </SPAN>
                 </TD>
       </TR>
       <TR valign="top">
        <TD id="id_vis_hospedagem_dtchkout"  <?php echo $str_display_hospedagem_dtchkout; ?> class="scFilterFieldFontOdd">
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
<span id='id_date_part_hospedagem_dtchkout_input_2_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_hospedagem_dtchkout_input_2_dia" name="hospedagem_dtchkout_input_2_dia" value="<?php echo NM_encode_input($hospedagem_dtchkout_input_2_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_hospedagem_dtchkout_input_2_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_hospedagem_dtchkout_input_2_mes" name="hospedagem_dtchkout_input_2_mes" value="<?php echo NM_encode_input($hospedagem_dtchkout_input_2_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_hospedagem_dtchkout_input_2_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_hospedagem_dtchkout_input_2_ano" name="hospedagem_dtchkout_input_2_ano" value="<?php echo NM_encode_input($hospedagem_dtchkout_input_2_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
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





      <TD id='SC_hospedagem_hrchkout_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['hospedagem_hrchkout'])) ? $this->New_label['hospedagem_hrchkout'] : "Hora Check Out"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_hospedagem_hrchkout_cond" name="hospedagem_hrchkout_cond" onChange="nm_campos_between(document.getElementById('id_vis_hospedagem_hrchkout'), this, 'hospedagem_hrchkout')">
       <OPTION value="eq" <?php if ("eq" == $hospedagem_hrchkout_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ii" <?php if ("ii" == $hospedagem_hrchkout_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_stts_with'] ?></OPTION>
       <OPTION value="qp" <?php if ("qp" == $hospedagem_hrchkout_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="df" <?php if ("df" == $hospedagem_hrchkout_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_dife'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_hospedagem_hrchkout" <?php echo $str_hide_hospedagem_hrchkout?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['hospedagem_hrchkout'])) ? $this->New_label['hospedagem_hrchkout'] : "Hora Check Out";
 $nmgp_tab_label .= "hospedagem_hrchkout?#?" . $SC_Label . "?@?";
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
<span id='id_date_part_hospedagem_hrchkout_HH' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_hospedagem_hrchkout_hor" name="hospedagem_hrchkout_hor" value="<?php echo NM_encode_input($hospedagem_hrchkout_hor); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_hospedagem_hrchkout_II' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_hospedagem_hrchkout_min" name="hospedagem_hrchkout_min" value="<?php echo NM_encode_input($hospedagem_hrchkout_min); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_hospedagem_hrchkout_SS' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_hospedagem_hrchkout_seg" name="hospedagem_hrchkout_seg" value="<?php echo NM_encode_input($hospedagem_hrchkout_seg); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
        <SPAN id="id_css_hospedagem_hrchkout"  class="scFilterFieldFontEven">
 <?php echo $date_format_show ?>         </SPAN>
         
        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_presenca_status_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['presenca_status'])) ? $this->New_label['presenca_status'] : "Presenca Status"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_presenca_status_cond" name="presenca_status_cond" onChange="nm_campos_between(document.getElementById('id_vis_presenca_status'), this, 'presenca_status')">
       <OPTION value="qp" <?php if ("qp" == $presenca_status_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $presenca_status_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $presenca_status_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $presenca_status_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_presenca_status" <?php echo $str_hide_presenca_status?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['presenca_status'])) ? $this->New_label['presenca_status'] : "Presenca Status";
 $nmgp_tab_label .= "presenca_status?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($presenca_status != "")
      {
      $presenca_status_look = (is_string($presenca_status) ? substr($this->Db->qstr($presenca_status), 1, -1) : $presenca_status); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct presenca_status from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#presenca_status#lowerF# = #lowerI#'$presenca_status_look'#lowerF# order by presenca_status"; 
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
      if (isset($nmgp_def_dados[0][$presenca_status]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$presenca_status];
      }
      else
      {
          $sAutocompValue = $presenca_status;
      }
?>
<INPUT  type="text" id="SC_presenca_status" name="presenca_status" value="<?php echo NM_encode_input($presenca_status) ?>"  size=10 alt="{datatype: 'text', maxLength: 10, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_presenca_status" name="presenca_status_autocomp" size="10"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 10, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


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
    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['pesq_tab_label'] = $nmgp_tab_label;
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
   if (is_file("grid_rsvp_part_r_help.txt"))
   {
      $Arq_WebHelp = file("grid_rsvp_part_r_help.txt"); 
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
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_rsvp_part_r']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_rsvp_part_r']['start'] == 'filter' && $nm_apl_dependente != 1)
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
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_rsvp_part_r']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_rsvp_part_r']['start'] == 'filter')
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
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['orig_pesq']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['orig_pesq'] == "grid")
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
   document.F1.p_tam_camisa_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_p_tam_camisa'), document.F1.p_tam_camisa_cond, 'p_tam_camisa', opc_clear);
   document.F1.p_tam_camisa.value = "";
   document.F1.p_tam_camisa_autocomp.value = "";
   document.F1.publico_nome_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_publico_nome'), document.F1.publico_nome_cond, 'publico_nome', opc_clear);
   document.F1.publico_nome.value = "";
   document.F1.publico_nome_autocomp.value = "";
   document.F1.regional_nome_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_regional_nome'), document.F1.regional_nome_cond, 'regional_nome', opc_clear);
   document.F1.regional_nome.value = "";
   document.F1.regional_nome_autocomp.value = "";
   document.F1.p_nome_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_p_nome'), document.F1.p_nome_cond, 'p_nome', opc_clear);
   document.F1.p_nome.value = "";
   document.F1.p_nome_autocomp.value = "";
   document.F1.contato_status_dsc_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_contato_status_dsc'), document.F1.contato_status_dsc_cond, 'contato_status_dsc', opc_clear);
   document.F1.contato_status_dsc.value = "";
   document.F1.contato_status_dsc_autocomp.value = "";
   document.F1.presenca_status_dsc_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_presenca_status_dsc'), document.F1.presenca_status_dsc_cond, 'presenca_status_dsc', opc_clear);
   document.F1.presenca_status_dsc.value = "";
   document.F1.presenca_status_dsc_autocomp.value = "";
   document.F1.hotel_fantasia_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_hotel_fantasia'), document.F1.hotel_fantasia_cond, 'hotel_fantasia', opc_clear);
   document.F1.hotel_fantasia.value = "";
   document.F1.hotel_fantasia_autocomp.value = "";
   document.F1.contato_usuario_nome_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_contato_usuario_nome'), document.F1.contato_usuario_nome_cond, 'contato_usuario_nome', opc_clear);
   document.F1.contato_usuario_nome.value = "";
   document.F1.contato_usuario_nome_autocomp.value = "";
   document.F1.presenca_usuario_dsc_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_presenca_usuario_dsc'), document.F1.presenca_usuario_dsc_cond, 'presenca_usuario_dsc', opc_clear);
   document.F1.presenca_usuario_dsc.value = "";
   document.F1.presenca_usuario_dsc_autocomp.value = "";
   document.F1.hospedagem_tipo_pessoa_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_hospedagem_tipo_pessoa'), document.F1.hospedagem_tipo_pessoa_cond, 'hospedagem_tipo_pessoa', opc_clear);
   document.F1.hospedagem_tipo_pessoa.value = "";
   document.F1.hospedagem_tipo_pessoa_autocomp.value = "";
   document.F1.hospedagem_dtchkin_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_hospedagem_dtchkin'), document.F1.hospedagem_dtchkin_cond, 'hospedagem_dtchkin', opc_clear);
   document.F1.hospedagem_dtchkin_dia.value = "";
   document.F1.hospedagem_dtchkin_mes.value = "";
   document.F1.hospedagem_dtchkin_ano.value = "";
   document.F1.hospedagem_dtchkin_input_2_dia.value = "";
   document.F1.hospedagem_dtchkin_input_2_mes.value = "";
   document.F1.hospedagem_dtchkin_input_2_ano.value = "";
   document.F1.hospedagem_hrchkin_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_hospedagem_hrchkin'), document.F1.hospedagem_hrchkin_cond, 'hospedagem_hrchkin', opc_clear);
   document.F1.hospedagem_hrchkin_hor.value = "";
   document.F1.hospedagem_hrchkin_min.value = "";
   document.F1.hospedagem_hrchkin_seg.value = "";
   document.F1.hospedagem_dtchkout_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_hospedagem_dtchkout'), document.F1.hospedagem_dtchkout_cond, 'hospedagem_dtchkout', opc_clear);
   document.F1.hospedagem_dtchkout_dia.value = "";
   document.F1.hospedagem_dtchkout_mes.value = "";
   document.F1.hospedagem_dtchkout_ano.value = "";
   document.F1.hospedagem_dtchkout_input_2_dia.value = "";
   document.F1.hospedagem_dtchkout_input_2_mes.value = "";
   document.F1.hospedagem_dtchkout_input_2_ano.value = "";
   document.F1.hospedagem_hrchkout_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_hospedagem_hrchkout'), document.F1.hospedagem_hrchkout_cond, 'hospedagem_hrchkout', opc_clear);
   document.F1.hospedagem_hrchkout_hor.value = "";
   document.F1.hospedagem_hrchkout_min.value = "";
   document.F1.hospedagem_hrchkout_seg.value = "";
   document.F1.presenca_status_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_presenca_status'), document.F1.presenca_status_cond, 'presenca_status', opc_clear);
   document.F1.presenca_status.value = "";
   document.F1.presenca_status_autocomp.value = "";
 }
 function SC_carga_evt_jquery()
 {
    $('#SC_hospedagem_dtchkin_dia').bind('change', function() {sc_grid_rsvp_part_r_valida_dia(this)});
    $('#SC_hospedagem_dtchkin_input_2_dia').bind('change', function() {sc_grid_rsvp_part_r_valida_dia(this)});
    $('#SC_hospedagem_dtchkin_input_2_mes').bind('change', function() {sc_grid_rsvp_part_r_valida_mes(this)});
    $('#SC_hospedagem_dtchkin_mes').bind('change', function() {sc_grid_rsvp_part_r_valida_mes(this)});
    $('#SC_hospedagem_dtchkout_dia').bind('change', function() {sc_grid_rsvp_part_r_valida_dia(this)});
    $('#SC_hospedagem_dtchkout_input_2_dia').bind('change', function() {sc_grid_rsvp_part_r_valida_dia(this)});
    $('#SC_hospedagem_dtchkout_input_2_mes').bind('change', function() {sc_grid_rsvp_part_r_valida_mes(this)});
    $('#SC_hospedagem_dtchkout_mes').bind('change', function() {sc_grid_rsvp_part_r_valida_mes(this)});
    $('#SC_hospedagem_hrchkin_hor').bind('change', function() {sc_grid_rsvp_part_r_valida_hora(this)});
    $('#SC_hospedagem_hrchkin_min').bind('change', function() {sc_grid_rsvp_part_r_valida_min(this)});
    $('#SC_hospedagem_hrchkin_seg').bind('change', function() {sc_grid_rsvp_part_r_valida_seg(this)});
    $('#SC_hospedagem_hrchkout_hor').bind('change', function() {sc_grid_rsvp_part_r_valida_hora(this)});
    $('#SC_hospedagem_hrchkout_min').bind('change', function() {sc_grid_rsvp_part_r_valida_min(this)});
    $('#SC_hospedagem_hrchkout_seg').bind('change', function() {sc_grid_rsvp_part_r_valida_seg(this)});
 }
 function sc_grid_rsvp_part_r_valida_dia(obj)
 {
     if (obj.value != "" && (obj.value < 1 || obj.value > 31))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_iday'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { $(document.activeElement).focus(); obj.focus(); }, 10);
         }
     }
 }
 function sc_grid_rsvp_part_r_valida_mes(obj)
 {
     if (obj.value != "" && (obj.value < 1 || obj.value > 12))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_mnth'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { $(document.activeElement).focus(); obj.focus(); }, 10);
         }
     }
 }
 function sc_grid_rsvp_part_r_valida_hora(obj)
 {
     if (obj.value != "" && (obj.value < 0 || obj.value > 23))
     {
         if (confirm (Nm_erro['lang_jscr_ivtm'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { $(document.activeElement).focus(); obj.focus(); }, 10);
         }
     }
 }
 function sc_grid_rsvp_part_r_valida_min(obj)
 {
     if (obj.value != "" && (obj.value < 0 || obj.value > 59))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_mint'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { $(document.activeElement).focus(); obj.focus(); }, 10);
         }
     }
 }
 function sc_grid_rsvp_part_r_valida_seg(obj)
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
       $NM_patch   = "NRSVP115_10_AWS_APP/grid_rsvp_part_r";
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
          $nmgp_tab_label = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['pesq_tab_label'];
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
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_orig']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_orig'] = "";
      }
      $this->init_comando();
      $this->NM_operador     = (isset($NM_operador) && ("and" == strtolower($NM_operador) || "or" == strtolower($NM_operador))) ? $NM_operador : "and";
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq'] = array();
   }

   function init_comando()
   {
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['cond_pesq'] = "";
      if ($this->NM_ajax_flag && ($this->NM_ajax_opcao == "ajax_grid_search" || $this->NM_ajax_opcao == "ajax_grid_search_change_fil"))
      {
          $this->comando = "";
      }
      else
      {
          $this->comando = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_orig'];
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
          $NM_patch .= "grid_rsvp_part_r/";
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
      $tp_fields['SC_p_tam_camisa_cond'] = 'cond';
      $tp_fields['SC_p_tam_camisa'] = 'text_aut';
      $tp_fields['id_ac_p_tam_camisa'] = 'text_aut';
      $tp_fields['SC_publico_nome_cond'] = 'cond';
      $tp_fields['SC_publico_nome'] = 'text_aut';
      $tp_fields['id_ac_publico_nome'] = 'text_aut';
      $tp_fields['SC_regional_nome_cond'] = 'cond';
      $tp_fields['SC_regional_nome'] = 'text_aut';
      $tp_fields['id_ac_regional_nome'] = 'text_aut';
      $tp_fields['SC_p_nome_cond'] = 'cond';
      $tp_fields['SC_p_nome'] = 'text_aut';
      $tp_fields['id_ac_p_nome'] = 'text_aut';
      $tp_fields['SC_contato_status_dsc_cond'] = 'cond';
      $tp_fields['SC_contato_status_dsc'] = 'text_aut';
      $tp_fields['id_ac_contato_status_dsc'] = 'text_aut';
      $tp_fields['SC_presenca_status_dsc_cond'] = 'cond';
      $tp_fields['SC_presenca_status_dsc'] = 'text_aut';
      $tp_fields['id_ac_presenca_status_dsc'] = 'text_aut';
      $tp_fields['SC_hotel_fantasia_cond'] = 'cond';
      $tp_fields['SC_hotel_fantasia'] = 'text_aut';
      $tp_fields['id_ac_hotel_fantasia'] = 'text_aut';
      $tp_fields['SC_contato_usuario_nome_cond'] = 'cond';
      $tp_fields['SC_contato_usuario_nome'] = 'text_aut';
      $tp_fields['id_ac_contato_usuario_nome'] = 'text_aut';
      $tp_fields['SC_presenca_usuario_dsc_cond'] = 'cond';
      $tp_fields['SC_presenca_usuario_dsc'] = 'text_aut';
      $tp_fields['id_ac_presenca_usuario_dsc'] = 'text_aut';
      $tp_fields['SC_hospedagem_tipo_pessoa_cond'] = 'cond';
      $tp_fields['SC_hospedagem_tipo_pessoa'] = 'text_aut';
      $tp_fields['id_ac_hospedagem_tipo_pessoa'] = 'text_aut';
      $tp_fields['SC_hospedagem_dtchkin_cond'] = 'cond';
      $tp_fields['SC_hospedagem_dtchkin_dia'] = 'text';
      $tp_fields['SC_hospedagem_dtchkin_mes'] = 'text';
      $tp_fields['SC_hospedagem_dtchkin_ano'] = 'text';
      $tp_fields['SC_hospedagem_dtchkin_input_2_dia'] = 'text';
      $tp_fields['SC_hospedagem_dtchkin_input_2_mes'] = 'text';
      $tp_fields['SC_hospedagem_dtchkin_input_2_ano'] = 'text';
      $tp_fields['SC_hospedagem_hrchkin_cond'] = 'cond';
      $tp_fields['SC_hospedagem_hrchkin_hor'] = 'text';
      $tp_fields['SC_hospedagem_hrchkin_min'] = 'text';
      $tp_fields['SC_hospedagem_hrchkin_seg'] = 'text';
      $tp_fields['SC_hospedagem_hrchkin_input_2_hor'] = 'text';
      $tp_fields['SC_hospedagem_hrchkin_input_2_min'] = 'text';
      $tp_fields['SC_hospedagem_hrchkin_input_2_seg'] = 'text';
      $tp_fields['SC_hospedagem_dtchkout_cond'] = 'cond';
      $tp_fields['SC_hospedagem_dtchkout_dia'] = 'text';
      $tp_fields['SC_hospedagem_dtchkout_mes'] = 'text';
      $tp_fields['SC_hospedagem_dtchkout_ano'] = 'text';
      $tp_fields['SC_hospedagem_dtchkout_input_2_dia'] = 'text';
      $tp_fields['SC_hospedagem_dtchkout_input_2_mes'] = 'text';
      $tp_fields['SC_hospedagem_dtchkout_input_2_ano'] = 'text';
      $tp_fields['SC_hospedagem_hrchkout_cond'] = 'cond';
      $tp_fields['SC_hospedagem_hrchkout_hor'] = 'text';
      $tp_fields['SC_hospedagem_hrchkout_min'] = 'text';
      $tp_fields['SC_hospedagem_hrchkout_seg'] = 'text';
      $tp_fields['SC_hospedagem_hrchkout_input_2_hor'] = 'text';
      $tp_fields['SC_hospedagem_hrchkout_input_2_min'] = 'text';
      $tp_fields['SC_hospedagem_hrchkout_input_2_seg'] = 'text';
      $tp_fields['SC_presenca_status_cond'] = 'cond';
      $tp_fields['SC_presenca_status'] = 'text_aut';
      $tp_fields['id_ac_presenca_status'] = 'text_aut';
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
      global $p_tam_camisa_cond, $p_tam_camisa, $p_tam_camisa_autocomp,
             $publico_nome_cond, $publico_nome, $publico_nome_autocomp,
             $regional_nome_cond, $regional_nome, $regional_nome_autocomp,
             $p_nome_cond, $p_nome, $p_nome_autocomp,
             $contato_status_dsc_cond, $contato_status_dsc, $contato_status_dsc_autocomp,
             $presenca_status_dsc_cond, $presenca_status_dsc, $presenca_status_dsc_autocomp,
             $hotel_fantasia_cond, $hotel_fantasia, $hotel_fantasia_autocomp,
             $contato_usuario_nome_cond, $contato_usuario_nome, $contato_usuario_nome_autocomp,
             $presenca_usuario_dsc_cond, $presenca_usuario_dsc, $presenca_usuario_dsc_autocomp,
             $hospedagem_tipo_pessoa_cond, $hospedagem_tipo_pessoa, $hospedagem_tipo_pessoa_autocomp,
             $hospedagem_dtchkin_cond, $hospedagem_dtchkin, $hospedagem_dtchkin_dia, $hospedagem_dtchkin_mes, $hospedagem_dtchkin_ano, $hospedagem_dtchkin_input_2_dia, $hospedagem_dtchkin_input_2_mes, $hospedagem_dtchkin_input_2_ano,
             $hospedagem_hrchkin_cond, $hospedagem_hrchkin, $hospedagem_hrchkin_hor, $hospedagem_hrchkin_min, $hospedagem_hrchkin_seg,
             $hospedagem_dtchkout_cond, $hospedagem_dtchkout, $hospedagem_dtchkout_dia, $hospedagem_dtchkout_mes, $hospedagem_dtchkout_ano, $hospedagem_dtchkout_input_2_dia, $hospedagem_dtchkout_input_2_mes, $hospedagem_dtchkout_input_2_ano,
             $hospedagem_hrchkout_cond, $hospedagem_hrchkout, $hospedagem_hrchkout_hor, $hospedagem_hrchkout_min, $hospedagem_hrchkout_seg,
             $presenca_status_cond, $presenca_status, $presenca_status_autocomp, $nmgp_tab_label;

      $C_formatado = true;
      if ($this->NM_ajax_flag && ($this->NM_ajax_opcao == "ajax_grid_search" || $this->NM_ajax_opcao == "ajax_grid_search_change_fil"))
      {
          if ($this->NM_ajax_opcao == "ajax_grid_search")
          {
              $C_formatado = false;
          }
          $Temp_Busca  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && $this->NM_ajax_opcao != "ajax_grid_search_change_fil")
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca'], $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca'] as $Cmps => $Vals)
          {
              $$Cmps = $Vals;
          }
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_limpa.php", "F", "nm_limpa_valor") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_conv_dados.php", "F", "nm_conv_limpa_dado") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_edit.php", "F", "nmgp_Form_Num_Val") ; 
      if (!empty($p_tam_camisa_autocomp) && empty($p_tam_camisa))
      {
          $p_tam_camisa = $p_tam_camisa_autocomp;
      }
      if (!empty($publico_nome_autocomp) && empty($publico_nome))
      {
          $publico_nome = $publico_nome_autocomp;
      }
      if (!empty($regional_nome_autocomp) && empty($regional_nome))
      {
          $regional_nome = $regional_nome_autocomp;
      }
      if (!empty($p_nome_autocomp) && empty($p_nome))
      {
          $p_nome = $p_nome_autocomp;
      }
      if (!empty($contato_status_dsc_autocomp) && empty($contato_status_dsc))
      {
          $contato_status_dsc = $contato_status_dsc_autocomp;
      }
      if (!empty($presenca_status_dsc_autocomp) && empty($presenca_status_dsc))
      {
          $presenca_status_dsc = $presenca_status_dsc_autocomp;
      }
      if (!empty($hotel_fantasia_autocomp) && empty($hotel_fantasia))
      {
          $hotel_fantasia = $hotel_fantasia_autocomp;
      }
      if (!empty($contato_usuario_nome_autocomp) && empty($contato_usuario_nome))
      {
          $contato_usuario_nome = $contato_usuario_nome_autocomp;
      }
      if (!empty($presenca_usuario_dsc_autocomp) && empty($presenca_usuario_dsc))
      {
          $presenca_usuario_dsc = $presenca_usuario_dsc_autocomp;
      }
      if (!empty($hospedagem_tipo_pessoa_autocomp) && empty($hospedagem_tipo_pessoa))
      {
          $hospedagem_tipo_pessoa = $hospedagem_tipo_pessoa_autocomp;
      }
      if (!empty($presenca_status_autocomp) && empty($presenca_status))
      {
          $presenca_status = $presenca_status_autocomp;
      }
      $p_tam_camisa_cond_salva = $p_tam_camisa_cond; 
      if (!isset($p_tam_camisa_input_2) || $p_tam_camisa_input_2 == "")
      {
          $p_tam_camisa_input_2 = $p_tam_camisa;
      }
      $publico_nome_cond_salva = $publico_nome_cond; 
      if (!isset($publico_nome_input_2) || $publico_nome_input_2 == "")
      {
          $publico_nome_input_2 = $publico_nome;
      }
      $regional_nome_cond_salva = $regional_nome_cond; 
      if (!isset($regional_nome_input_2) || $regional_nome_input_2 == "")
      {
          $regional_nome_input_2 = $regional_nome;
      }
      $p_nome_cond_salva = $p_nome_cond; 
      if (!isset($p_nome_input_2) || $p_nome_input_2 == "")
      {
          $p_nome_input_2 = $p_nome;
      }
      $contato_status_dsc_cond_salva = $contato_status_dsc_cond; 
      if (!isset($contato_status_dsc_input_2) || $contato_status_dsc_input_2 == "")
      {
          $contato_status_dsc_input_2 = $contato_status_dsc;
      }
      $presenca_status_dsc_cond_salva = $presenca_status_dsc_cond; 
      if (!isset($presenca_status_dsc_input_2) || $presenca_status_dsc_input_2 == "")
      {
          $presenca_status_dsc_input_2 = $presenca_status_dsc;
      }
      $hotel_fantasia_cond_salva = $hotel_fantasia_cond; 
      if (!isset($hotel_fantasia_input_2) || $hotel_fantasia_input_2 == "")
      {
          $hotel_fantasia_input_2 = $hotel_fantasia;
      }
      $contato_usuario_nome_cond_salva = $contato_usuario_nome_cond; 
      if (!isset($contato_usuario_nome_input_2) || $contato_usuario_nome_input_2 == "")
      {
          $contato_usuario_nome_input_2 = $contato_usuario_nome;
      }
      $presenca_usuario_dsc_cond_salva = $presenca_usuario_dsc_cond; 
      if (!isset($presenca_usuario_dsc_input_2) || $presenca_usuario_dsc_input_2 == "")
      {
          $presenca_usuario_dsc_input_2 = $presenca_usuario_dsc;
      }
      $hospedagem_tipo_pessoa_cond_salva = $hospedagem_tipo_pessoa_cond; 
      if (!isset($hospedagem_tipo_pessoa_input_2) || $hospedagem_tipo_pessoa_input_2 == "")
      {
          $hospedagem_tipo_pessoa_input_2 = $hospedagem_tipo_pessoa;
      }
      $hospedagem_dtchkin_cond_salva = $hospedagem_dtchkin_cond; 
      if (!isset($hospedagem_dtchkin_input_2_dia) || $hospedagem_dtchkin_input_2_dia == "") {
          $hospedagem_dtchkin_input_2_dia = $hospedagem_dtchkin_dia;
      }
      if (!isset($hospedagem_dtchkin_input_2_mes) || $hospedagem_dtchkin_input_2_mes == "") {
          $hospedagem_dtchkin_input_2_mes = $hospedagem_dtchkin_mes;
      }
      if (!isset($hospedagem_dtchkin_input_2_ano) || $hospedagem_dtchkin_input_2_ano == "") {
          $hospedagem_dtchkin_input_2_ano = $hospedagem_dtchkin_ano;
      }
      $hospedagem_hrchkin_cond_salva = $hospedagem_hrchkin_cond; 
      $hospedagem_dtchkout_cond_salva = $hospedagem_dtchkout_cond; 
      if (!isset($hospedagem_dtchkout_input_2_dia) || $hospedagem_dtchkout_input_2_dia == "") {
          $hospedagem_dtchkout_input_2_dia = $hospedagem_dtchkout_dia;
      }
      if (!isset($hospedagem_dtchkout_input_2_mes) || $hospedagem_dtchkout_input_2_mes == "") {
          $hospedagem_dtchkout_input_2_mes = $hospedagem_dtchkout_mes;
      }
      if (!isset($hospedagem_dtchkout_input_2_ano) || $hospedagem_dtchkout_input_2_ano == "") {
          $hospedagem_dtchkout_input_2_ano = $hospedagem_dtchkout_ano;
      }
      $hospedagem_hrchkout_cond_salva = $hospedagem_hrchkout_cond; 
      $presenca_status_cond_salva = $presenca_status_cond; 
      if (!isset($presenca_status_input_2) || $presenca_status_input_2 == "")
      {
          $presenca_status_input_2 = $presenca_status;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']  = array(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search']  = array(); 
      $I_Grid = 0;
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['p_tam_camisa'] = $p_tam_camisa; 
      if (is_array($p_tam_camisa) && !empty($p_tam_camisa))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0] = $p_tam_camisa;
      }
      elseif ($p_tam_camisa_cond_salva == "nu" || $p_tam_camisa_cond_salva == "nn" || $p_tam_camisa_cond_salva == "ep" || $p_tam_camisa_cond_salva == "ne" || !empty($p_tam_camisa))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0][0] = $p_tam_camisa;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['p_tam_camisa_cond'] = $p_tam_camisa_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['cmp'] = "p_tam_camisa"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['opc'] = $p_tam_camisa_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['p_tam_camisa'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['publico_nome'] = $publico_nome; 
      if (is_array($publico_nome) && !empty($publico_nome))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0] = $publico_nome;
      }
      elseif ($publico_nome_cond_salva == "nu" || $publico_nome_cond_salva == "nn" || $publico_nome_cond_salva == "ep" || $publico_nome_cond_salva == "ne" || !empty($publico_nome))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0][0] = $publico_nome;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['publico_nome_cond'] = $publico_nome_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['cmp'] = "publico_nome"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['opc'] = $publico_nome_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['publico_nome'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['regional_nome'] = $regional_nome; 
      if (is_array($regional_nome) && !empty($regional_nome))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0] = $regional_nome;
      }
      elseif ($regional_nome_cond_salva == "nu" || $regional_nome_cond_salva == "nn" || $regional_nome_cond_salva == "ep" || $regional_nome_cond_salva == "ne" || !empty($regional_nome))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0][0] = $regional_nome;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['regional_nome_cond'] = $regional_nome_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['cmp'] = "regional_nome"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['opc'] = $regional_nome_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['regional_nome'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['p_nome'] = $p_nome; 
      if (is_array($p_nome) && !empty($p_nome))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0] = $p_nome;
      }
      elseif ($p_nome_cond_salva == "nu" || $p_nome_cond_salva == "nn" || $p_nome_cond_salva == "ep" || $p_nome_cond_salva == "ne" || !empty($p_nome))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0][0] = $p_nome;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['p_nome_cond'] = $p_nome_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['cmp'] = "p_nome"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['opc'] = $p_nome_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['p_nome'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['contato_status_dsc'] = $contato_status_dsc; 
      if (is_array($contato_status_dsc) && !empty($contato_status_dsc))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0] = $contato_status_dsc;
      }
      elseif ($contato_status_dsc_cond_salva == "nu" || $contato_status_dsc_cond_salva == "nn" || $contato_status_dsc_cond_salva == "ep" || $contato_status_dsc_cond_salva == "ne" || !empty($contato_status_dsc))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0][0] = $contato_status_dsc;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['contato_status_dsc_cond'] = $contato_status_dsc_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['cmp'] = "contato_status_dsc"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['opc'] = $contato_status_dsc_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['contato_status_dsc'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['presenca_status_dsc'] = $presenca_status_dsc; 
      if (is_array($presenca_status_dsc) && !empty($presenca_status_dsc))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0] = $presenca_status_dsc;
      }
      elseif ($presenca_status_dsc_cond_salva == "nu" || $presenca_status_dsc_cond_salva == "nn" || $presenca_status_dsc_cond_salva == "ep" || $presenca_status_dsc_cond_salva == "ne" || !empty($presenca_status_dsc))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0][0] = $presenca_status_dsc;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['presenca_status_dsc_cond'] = $presenca_status_dsc_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['cmp'] = "presenca_status_dsc"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['opc'] = $presenca_status_dsc_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['presenca_status_dsc'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hotel_fantasia'] = $hotel_fantasia; 
      if (is_array($hotel_fantasia) && !empty($hotel_fantasia))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0] = $hotel_fantasia;
      }
      elseif ($hotel_fantasia_cond_salva == "nu" || $hotel_fantasia_cond_salva == "nn" || $hotel_fantasia_cond_salva == "ep" || $hotel_fantasia_cond_salva == "ne" || !empty($hotel_fantasia))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0][0] = $hotel_fantasia;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hotel_fantasia_cond'] = $hotel_fantasia_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['cmp'] = "hotel_fantasia"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['opc'] = $hotel_fantasia_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['hotel_fantasia'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['contato_usuario_nome'] = $contato_usuario_nome; 
      if (is_array($contato_usuario_nome) && !empty($contato_usuario_nome))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0] = $contato_usuario_nome;
      }
      elseif ($contato_usuario_nome_cond_salva == "nu" || $contato_usuario_nome_cond_salva == "nn" || $contato_usuario_nome_cond_salva == "ep" || $contato_usuario_nome_cond_salva == "ne" || !empty($contato_usuario_nome))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0][0] = $contato_usuario_nome;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['contato_usuario_nome_cond'] = $contato_usuario_nome_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['cmp'] = "contato_usuario_nome"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['opc'] = $contato_usuario_nome_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['contato_usuario_nome'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['presenca_usuario_dsc'] = $presenca_usuario_dsc; 
      if (is_array($presenca_usuario_dsc) && !empty($presenca_usuario_dsc))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0] = $presenca_usuario_dsc;
      }
      elseif ($presenca_usuario_dsc_cond_salva == "nu" || $presenca_usuario_dsc_cond_salva == "nn" || $presenca_usuario_dsc_cond_salva == "ep" || $presenca_usuario_dsc_cond_salva == "ne" || !empty($presenca_usuario_dsc))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0][0] = $presenca_usuario_dsc;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['presenca_usuario_dsc_cond'] = $presenca_usuario_dsc_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['cmp'] = "presenca_usuario_dsc"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['opc'] = $presenca_usuario_dsc_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['presenca_usuario_dsc'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_tipo_pessoa'] = $hospedagem_tipo_pessoa; 
      if (is_array($hospedagem_tipo_pessoa) && !empty($hospedagem_tipo_pessoa))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0] = $hospedagem_tipo_pessoa;
      }
      elseif ($hospedagem_tipo_pessoa_cond_salva == "nu" || $hospedagem_tipo_pessoa_cond_salva == "nn" || $hospedagem_tipo_pessoa_cond_salva == "ep" || $hospedagem_tipo_pessoa_cond_salva == "ne" || !empty($hospedagem_tipo_pessoa))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0][0] = $hospedagem_tipo_pessoa;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_tipo_pessoa_cond'] = $hospedagem_tipo_pessoa_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['cmp'] = "hospedagem_tipo_pessoa"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['opc'] = $hospedagem_tipo_pessoa_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['hospedagem_tipo_pessoa'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkin_dia'] = $hospedagem_dtchkin_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkin_mes'] = $hospedagem_dtchkin_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkin_ano'] = $hospedagem_dtchkin_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkin_input_2_dia'] = $hospedagem_dtchkin_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkin_input_2_mes'] = $hospedagem_dtchkin_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkin_input_2_ano'] = $hospedagem_dtchkin_input_2_ano; 
      if (!empty($hospedagem_dtchkin_dia) || !empty($hospedagem_dtchkin_mes) || !empty($hospedagem_dtchkin_ano) || $hospedagem_dtchkin_cond_salva == "nu" || $hospedagem_dtchkin_cond_salva == "nn" || $hospedagem_dtchkin_cond_salva == "ep" || $hospedagem_dtchkin_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0][] = "D:" . $hospedagem_dtchkin_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0][] = "M:" . $hospedagem_dtchkin_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0][] = "Y:" . $hospedagem_dtchkin_ano;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][1][] = "D:" . $hospedagem_dtchkin_input_2_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][1][] = "M:" . $hospedagem_dtchkin_input_2_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][1][] = "Y:" . $hospedagem_dtchkin_input_2_ano;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkin_cond'] = $hospedagem_dtchkin_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['cmp'] = "hospedagem_dtchkin"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['opc'] = $hospedagem_dtchkin_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['hospedagem_dtchkin'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_hrchkin_hor'] = $hospedagem_hrchkin_hor; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_hrchkin_min'] = $hospedagem_hrchkin_min; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_hrchkin_seg'] = $hospedagem_hrchkin_seg; 
      if (!empty($hospedagem_hrchkin_hor) || !empty($hospedagem_hrchkin_min) || !empty($hospedagem_hrchkin_seg) || $hospedagem_hrchkin_cond_salva == "nu" || $hospedagem_hrchkin_cond_salva == "nn" || $hospedagem_hrchkin_cond_salva == "ep" || $hospedagem_hrchkin_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0][] = "H:" . $hospedagem_hrchkin_hor;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0][] = "I:" . $hospedagem_hrchkin_min;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0][] = "S:" . $hospedagem_hrchkin_seg;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_hrchkin_cond'] = $hospedagem_hrchkin_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['cmp'] = "hospedagem_hrchkin"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['opc'] = $hospedagem_hrchkin_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['hospedagem_hrchkin'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkout_dia'] = $hospedagem_dtchkout_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkout_mes'] = $hospedagem_dtchkout_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkout_ano'] = $hospedagem_dtchkout_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkout_input_2_dia'] = $hospedagem_dtchkout_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkout_input_2_mes'] = $hospedagem_dtchkout_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkout_input_2_ano'] = $hospedagem_dtchkout_input_2_ano; 
      if (!empty($hospedagem_dtchkout_dia) || !empty($hospedagem_dtchkout_mes) || !empty($hospedagem_dtchkout_ano) || $hospedagem_dtchkout_cond_salva == "nu" || $hospedagem_dtchkout_cond_salva == "nn" || $hospedagem_dtchkout_cond_salva == "ep" || $hospedagem_dtchkout_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0][] = "D:" . $hospedagem_dtchkout_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0][] = "M:" . $hospedagem_dtchkout_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0][] = "Y:" . $hospedagem_dtchkout_ano;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][1][] = "D:" . $hospedagem_dtchkout_input_2_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][1][] = "M:" . $hospedagem_dtchkout_input_2_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][1][] = "Y:" . $hospedagem_dtchkout_input_2_ano;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkout_cond'] = $hospedagem_dtchkout_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['cmp'] = "hospedagem_dtchkout"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['opc'] = $hospedagem_dtchkout_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['hospedagem_dtchkout'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_hrchkout_hor'] = $hospedagem_hrchkout_hor; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_hrchkout_min'] = $hospedagem_hrchkout_min; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_hrchkout_seg'] = $hospedagem_hrchkout_seg; 
      if (!empty($hospedagem_hrchkout_hor) || !empty($hospedagem_hrchkout_min) || !empty($hospedagem_hrchkout_seg) || $hospedagem_hrchkout_cond_salva == "nu" || $hospedagem_hrchkout_cond_salva == "nn" || $hospedagem_hrchkout_cond_salva == "ep" || $hospedagem_hrchkout_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0][] = "H:" . $hospedagem_hrchkout_hor;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0][] = "I:" . $hospedagem_hrchkout_min;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0][] = "S:" . $hospedagem_hrchkout_seg;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_hrchkout_cond'] = $hospedagem_hrchkout_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['cmp'] = "hospedagem_hrchkout"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['opc'] = $hospedagem_hrchkout_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['hospedagem_hrchkout'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['presenca_status'] = $presenca_status; 
      if (is_array($presenca_status) && !empty($presenca_status))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0] = $presenca_status;
      }
      elseif ($presenca_status_cond_salva == "nu" || $presenca_status_cond_salva == "nn" || $presenca_status_cond_salva == "ep" || $presenca_status_cond_salva == "ne" || !empty($presenca_status))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['val'][0][0] = $presenca_status;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['presenca_status_cond'] = $presenca_status_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['cmp'] = "presenca_status"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid]['opc'] = $presenca_status_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['presenca_status'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['NM_operador'] = $this->NM_operador; 
      if ($this->NM_ajax_flag && $this->NM_ajax_opcao == "ajax_grid_search")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca'] = $Temp_Busca;
      }
      if (!empty($this->Campos_Mens_erro)) 
      {
          return;
      }
      $nmgp_def_dados = array();
    if ($p_tam_camisa != '') {
      $p_tam_camisa_look = (is_string($p_tam_camisa) ? substr($this->Db->qstr($p_tam_camisa), 1, -1) : $p_tam_camisa); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct p_tam_camisa from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#p_tam_camisa#lowerF# = #lowerI#'$p_tam_camisa_look'#lowerF# order by p_tam_camisa"; 
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
          $this->cmp_formatado['p_tam_camisa'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['p_tam_camisa'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['p_tam_camisa'] = $p_tam_camisa;
      }
      $this->cmp_formatado['p_tam_camisa'] = "'" . $this->cmp_formatado['p_tam_camisa'] . "'";
      if (isset($this->cmp_formatado['p_tam_camisa_input_2'])  && !empty($this->cmp_formatado['p_tam_camisa_input_2'])) {
          $this->cmp_formatado['p_tam_camisa_input_2'] = "'" . $this->cmp_formatado['p_tam_camisa_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($publico_nome != '') {
      $publico_nome_look = (is_string($publico_nome) ? substr($this->Db->qstr($publico_nome), 1, -1) : $publico_nome); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct publico_nome from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#publico_nome#lowerF# = #lowerI#'$publico_nome_look'#lowerF# order by publico_nome"; 
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
          $this->cmp_formatado['publico_nome'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['publico_nome'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['publico_nome'] = $publico_nome;
      }
      $this->cmp_formatado['publico_nome'] = "'" . $this->cmp_formatado['publico_nome'] . "'";
      if (isset($this->cmp_formatado['publico_nome_input_2'])  && !empty($this->cmp_formatado['publico_nome_input_2'])) {
          $this->cmp_formatado['publico_nome_input_2'] = "'" . $this->cmp_formatado['publico_nome_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($regional_nome != '') {
      $regional_nome_look = (is_string($regional_nome) ? substr($this->Db->qstr($regional_nome), 1, -1) : $regional_nome); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct regional_nome from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#regional_nome#lowerF# = #lowerI#'$regional_nome_look'#lowerF# order by regional_nome"; 
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
          $this->cmp_formatado['regional_nome'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['regional_nome'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['regional_nome'] = $regional_nome;
      }
      $this->cmp_formatado['regional_nome'] = "'" . $this->cmp_formatado['regional_nome'] . "'";
      if (isset($this->cmp_formatado['regional_nome_input_2'])  && !empty($this->cmp_formatado['regional_nome_input_2'])) {
          $this->cmp_formatado['regional_nome_input_2'] = "'" . $this->cmp_formatado['regional_nome_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($p_nome != '') {
      $p_nome_look = (is_string($p_nome) ? substr($this->Db->qstr($p_nome), 1, -1) : $p_nome); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct p_nome from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#p_nome#lowerF# = #lowerI#'$p_nome_look'#lowerF# order by p_nome"; 
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
          $this->cmp_formatado['p_nome'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['p_nome'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['p_nome'] = $p_nome;
      }
      $this->cmp_formatado['p_nome'] = "'" . $this->cmp_formatado['p_nome'] . "'";
      if (isset($this->cmp_formatado['p_nome_input_2'])  && !empty($this->cmp_formatado['p_nome_input_2'])) {
          $this->cmp_formatado['p_nome_input_2'] = "'" . $this->cmp_formatado['p_nome_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($contato_status_dsc != '') {
      $contato_status_dsc_look = (is_string($contato_status_dsc) ? substr($this->Db->qstr($contato_status_dsc), 1, -1) : $contato_status_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct contato_status_dsc from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#contato_status_dsc#lowerF# = #lowerI#'$contato_status_dsc_look'#lowerF# order by contato_status_dsc"; 
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
          $this->cmp_formatado['contato_status_dsc'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['contato_status_dsc'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['contato_status_dsc'] = $contato_status_dsc;
      }
      $this->cmp_formatado['contato_status_dsc'] = "'" . $this->cmp_formatado['contato_status_dsc'] . "'";
      if (isset($this->cmp_formatado['contato_status_dsc_input_2'])  && !empty($this->cmp_formatado['contato_status_dsc_input_2'])) {
          $this->cmp_formatado['contato_status_dsc_input_2'] = "'" . $this->cmp_formatado['contato_status_dsc_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($presenca_status_dsc != '') {
      $presenca_status_dsc_look = (is_string($presenca_status_dsc) ? substr($this->Db->qstr($presenca_status_dsc), 1, -1) : $presenca_status_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct presenca_status_dsc from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#presenca_status_dsc#lowerF# = #lowerI#'$presenca_status_dsc_look'#lowerF# order by presenca_status_dsc"; 
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
          $this->cmp_formatado['presenca_status_dsc'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['presenca_status_dsc'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['presenca_status_dsc'] = $presenca_status_dsc;
      }
      $this->cmp_formatado['presenca_status_dsc'] = "'" . $this->cmp_formatado['presenca_status_dsc'] . "'";
      if (isset($this->cmp_formatado['presenca_status_dsc_input_2'])  && !empty($this->cmp_formatado['presenca_status_dsc_input_2'])) {
          $this->cmp_formatado['presenca_status_dsc_input_2'] = "'" . $this->cmp_formatado['presenca_status_dsc_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($hotel_fantasia != '') {
      $hotel_fantasia_look = (is_string($hotel_fantasia) ? substr($this->Db->qstr($hotel_fantasia), 1, -1) : $hotel_fantasia); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct hotel_fantasia from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#hotel_fantasia#lowerF# = #lowerI#'$hotel_fantasia_look'#lowerF# order by hotel_fantasia"; 
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
          $this->cmp_formatado['hotel_fantasia'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['hotel_fantasia'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['hotel_fantasia'] = $hotel_fantasia;
      }
      $this->cmp_formatado['hotel_fantasia'] = "'" . $this->cmp_formatado['hotel_fantasia'] . "'";
      if (isset($this->cmp_formatado['hotel_fantasia_input_2'])  && !empty($this->cmp_formatado['hotel_fantasia_input_2'])) {
          $this->cmp_formatado['hotel_fantasia_input_2'] = "'" . $this->cmp_formatado['hotel_fantasia_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($contato_usuario_nome != '') {
      $contato_usuario_nome_look = (is_string($contato_usuario_nome) ? substr($this->Db->qstr($contato_usuario_nome), 1, -1) : $contato_usuario_nome); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct contato_usuario_nome from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#contato_usuario_nome#lowerF# = #lowerI#'$contato_usuario_nome_look'#lowerF# order by contato_usuario_nome"; 
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
          $this->cmp_formatado['contato_usuario_nome'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['contato_usuario_nome'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['contato_usuario_nome'] = $contato_usuario_nome;
      }
      $this->cmp_formatado['contato_usuario_nome'] = "'" . $this->cmp_formatado['contato_usuario_nome'] . "'";
      if (isset($this->cmp_formatado['contato_usuario_nome_input_2'])  && !empty($this->cmp_formatado['contato_usuario_nome_input_2'])) {
          $this->cmp_formatado['contato_usuario_nome_input_2'] = "'" . $this->cmp_formatado['contato_usuario_nome_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($presenca_usuario_dsc != '') {
      $presenca_usuario_dsc_look = (is_string($presenca_usuario_dsc) ? substr($this->Db->qstr($presenca_usuario_dsc), 1, -1) : $presenca_usuario_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct presenca_usuario_dsc from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#presenca_usuario_dsc#lowerF# = #lowerI#'$presenca_usuario_dsc_look'#lowerF# order by presenca_usuario_dsc"; 
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
          $this->cmp_formatado['presenca_usuario_dsc'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['presenca_usuario_dsc'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['presenca_usuario_dsc'] = $presenca_usuario_dsc;
      }
      $this->cmp_formatado['presenca_usuario_dsc'] = "'" . $this->cmp_formatado['presenca_usuario_dsc'] . "'";
      if (isset($this->cmp_formatado['presenca_usuario_dsc_input_2'])  && !empty($this->cmp_formatado['presenca_usuario_dsc_input_2'])) {
          $this->cmp_formatado['presenca_usuario_dsc_input_2'] = "'" . $this->cmp_formatado['presenca_usuario_dsc_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($hospedagem_tipo_pessoa != '') {
      $hospedagem_tipo_pessoa_look = (is_string($hospedagem_tipo_pessoa) ? substr($this->Db->qstr($hospedagem_tipo_pessoa), 1, -1) : $hospedagem_tipo_pessoa); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct hospedagem_tipo_pessoa from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#hospedagem_tipo_pessoa#lowerF# = #lowerI#'$hospedagem_tipo_pessoa_look'#lowerF# order by hospedagem_tipo_pessoa"; 
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
          $this->cmp_formatado['hospedagem_tipo_pessoa'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['hospedagem_tipo_pessoa'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['hospedagem_tipo_pessoa'] = $hospedagem_tipo_pessoa;
      }
      $this->cmp_formatado['hospedagem_tipo_pessoa'] = "'" . $this->cmp_formatado['hospedagem_tipo_pessoa'] . "'";
      if (isset($this->cmp_formatado['hospedagem_tipo_pessoa_input_2'])  && !empty($this->cmp_formatado['hospedagem_tipo_pessoa_input_2'])) {
          $this->cmp_formatado['hospedagem_tipo_pessoa_input_2'] = "'" . $this->cmp_formatado['hospedagem_tipo_pessoa_input_2'] . "'";
      }
      $this->cmp_formatado['hospedagem_dtchkin'] = "'" . $this->cmp_formatado['hospedagem_dtchkin'] . "'";
      if (isset($this->cmp_formatado['hospedagem_dtchkin_input_2'])  && !empty($this->cmp_formatado['hospedagem_dtchkin_input_2'])) {
          $this->cmp_formatado['hospedagem_dtchkin_input_2'] = "'" . $this->cmp_formatado['hospedagem_dtchkin_input_2'] . "'";
      }
      $this->cmp_formatado['hospedagem_hrchkin'] = "'" . $this->cmp_formatado['hospedagem_hrchkin'] . "'";
      if (isset($this->cmp_formatado['hospedagem_hrchkin_input_2'])  && !empty($this->cmp_formatado['hospedagem_hrchkin_input_2'])) {
          $this->cmp_formatado['hospedagem_hrchkin_input_2'] = "'" . $this->cmp_formatado['hospedagem_hrchkin_input_2'] . "'";
      }
      $this->cmp_formatado['hospedagem_dtchkout'] = "'" . $this->cmp_formatado['hospedagem_dtchkout'] . "'";
      if (isset($this->cmp_formatado['hospedagem_dtchkout_input_2'])  && !empty($this->cmp_formatado['hospedagem_dtchkout_input_2'])) {
          $this->cmp_formatado['hospedagem_dtchkout_input_2'] = "'" . $this->cmp_formatado['hospedagem_dtchkout_input_2'] . "'";
      }
      $this->cmp_formatado['hospedagem_hrchkout'] = "'" . $this->cmp_formatado['hospedagem_hrchkout'] . "'";
      if (isset($this->cmp_formatado['hospedagem_hrchkout_input_2'])  && !empty($this->cmp_formatado['hospedagem_hrchkout_input_2'])) {
          $this->cmp_formatado['hospedagem_hrchkout_input_2'] = "'" . $this->cmp_formatado['hospedagem_hrchkout_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($presenca_status != '') {
      $presenca_status_look = (is_string($presenca_status) ? substr($this->Db->qstr($presenca_status), 1, -1) : $presenca_status); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct presenca_status from " . $this->Ini->nm_tabela . " where (p_evento = '" . $_SESSION['parm1'] . "' AND     id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#presenca_status#lowerF# = #lowerI#'$presenca_status_look'#lowerF# order by presenca_status"; 
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
          $this->cmp_formatado['presenca_status'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['presenca_status'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['presenca_status'] = $presenca_status;
      }
      $this->cmp_formatado['presenca_status'] = "'" . $this->cmp_formatado['presenca_status'] . "'";
      if (isset($this->cmp_formatado['presenca_status_input_2'])  && !empty($this->cmp_formatado['presenca_status_input_2'])) {
          $this->cmp_formatado['presenca_status_input_2'] = "'" . $this->cmp_formatado['presenca_status_input_2'] . "'";
      }
   }

   function processa_campos($Res_comp='pesq')
   {
      global $p_tam_camisa_cond, $p_tam_camisa, $p_tam_camisa_autocomp,
             $publico_nome_cond, $publico_nome, $publico_nome_autocomp,
             $regional_nome_cond, $regional_nome, $regional_nome_autocomp,
             $p_nome_cond, $p_nome, $p_nome_autocomp,
             $contato_status_dsc_cond, $contato_status_dsc, $contato_status_dsc_autocomp,
             $presenca_status_dsc_cond, $presenca_status_dsc, $presenca_status_dsc_autocomp,
             $hotel_fantasia_cond, $hotel_fantasia, $hotel_fantasia_autocomp,
             $contato_usuario_nome_cond, $contato_usuario_nome, $contato_usuario_nome_autocomp,
             $presenca_usuario_dsc_cond, $presenca_usuario_dsc, $presenca_usuario_dsc_autocomp,
             $hospedagem_tipo_pessoa_cond, $hospedagem_tipo_pessoa, $hospedagem_tipo_pessoa_autocomp,
             $hospedagem_dtchkin_cond, $hospedagem_dtchkin, $hospedagem_dtchkin_dia, $hospedagem_dtchkin_mes, $hospedagem_dtchkin_ano, $hospedagem_dtchkin_input_2_dia, $hospedagem_dtchkin_input_2_mes, $hospedagem_dtchkin_input_2_ano,
             $hospedagem_hrchkin_cond, $hospedagem_hrchkin, $hospedagem_hrchkin_hor, $hospedagem_hrchkin_min, $hospedagem_hrchkin_seg,
             $hospedagem_dtchkout_cond, $hospedagem_dtchkout, $hospedagem_dtchkout_dia, $hospedagem_dtchkout_mes, $hospedagem_dtchkout_ano, $hospedagem_dtchkout_input_2_dia, $hospedagem_dtchkout_input_2_mes, $hospedagem_dtchkout_input_2_ano,
             $hospedagem_hrchkout_cond, $hospedagem_hrchkout, $hospedagem_hrchkout_hor, $hospedagem_hrchkout_min, $hospedagem_hrchkout_seg,
             $presenca_status_cond, $presenca_status, $presenca_status_autocomp, $nmgp_tab_label;


      //----- $p_tam_camisa
      $this->Date_part = false;
      if (isset($p_tam_camisa) || $p_tam_camisa_cond == "nu" || $p_tam_camisa_cond == "nn" || $p_tam_camisa_cond == "ep" || $p_tam_camisa_cond == "ne")
      {
         $this->monta_condicao("p_tam_camisa", $p_tam_camisa_cond, $p_tam_camisa, "", "p_tam_camisa", "VARCHAR", false);
      }

      //----- $publico_nome
      $this->Date_part = false;
      if (isset($publico_nome) || $publico_nome_cond == "nu" || $publico_nome_cond == "nn" || $publico_nome_cond == "ep" || $publico_nome_cond == "ne")
      {
         $this->monta_condicao("publico_nome", $publico_nome_cond, $publico_nome, "", "publico_nome", "VARCHAR", false);
      }

      //----- $regional_nome
      $this->Date_part = false;
      if (isset($regional_nome) || $regional_nome_cond == "nu" || $regional_nome_cond == "nn" || $regional_nome_cond == "ep" || $regional_nome_cond == "ne")
      {
         $this->monta_condicao("regional_nome", $regional_nome_cond, $regional_nome, "", "regional_nome", "VARCHAR", false);
      }

      //----- $p_nome
      $this->Date_part = false;
      if (isset($p_nome) || $p_nome_cond == "nu" || $p_nome_cond == "nn" || $p_nome_cond == "ep" || $p_nome_cond == "ne")
      {
         $this->monta_condicao("p_nome", $p_nome_cond, $p_nome, "", "p_nome", "VARCHAR", false);
      }

      //----- $contato_status_dsc
      $this->Date_part = false;
      if (isset($contato_status_dsc) || $contato_status_dsc_cond == "nu" || $contato_status_dsc_cond == "nn" || $contato_status_dsc_cond == "ep" || $contato_status_dsc_cond == "ne")
      {
         $this->monta_condicao("contato_status_dsc", $contato_status_dsc_cond, $contato_status_dsc, "", "contato_status_dsc", "VARCHAR", false);
      }

      //----- $presenca_status_dsc
      $this->Date_part = false;
      if (isset($presenca_status_dsc) || $presenca_status_dsc_cond == "nu" || $presenca_status_dsc_cond == "nn" || $presenca_status_dsc_cond == "ep" || $presenca_status_dsc_cond == "ne")
      {
         $this->monta_condicao("presenca_status_dsc", $presenca_status_dsc_cond, $presenca_status_dsc, "", "presenca_status_dsc", "VARCHAR", false);
      }

      //----- $hotel_fantasia
      $this->Date_part = false;
      if (isset($hotel_fantasia) || $hotel_fantasia_cond == "nu" || $hotel_fantasia_cond == "nn" || $hotel_fantasia_cond == "ep" || $hotel_fantasia_cond == "ne")
      {
         $this->monta_condicao("hotel_fantasia", $hotel_fantasia_cond, $hotel_fantasia, "", "hotel_fantasia", "VARCHAR", false);
      }

      //----- $contato_usuario_nome
      $this->Date_part = false;
      if (isset($contato_usuario_nome) || $contato_usuario_nome_cond == "nu" || $contato_usuario_nome_cond == "nn" || $contato_usuario_nome_cond == "ep" || $contato_usuario_nome_cond == "ne")
      {
         $this->monta_condicao("contato_usuario_nome", $contato_usuario_nome_cond, $contato_usuario_nome, "", "contato_usuario_nome", "VARCHAR", false);
      }

      //----- $presenca_usuario_dsc
      $this->Date_part = false;
      if (isset($presenca_usuario_dsc) || $presenca_usuario_dsc_cond == "nu" || $presenca_usuario_dsc_cond == "nn" || $presenca_usuario_dsc_cond == "ep" || $presenca_usuario_dsc_cond == "ne")
      {
         $this->monta_condicao("presenca_usuario_dsc", $presenca_usuario_dsc_cond, $presenca_usuario_dsc, "", "presenca_usuario_dsc", "VARCHAR", false);
      }

      //----- $hospedagem_tipo_pessoa
      $this->Date_part = false;
      if (isset($hospedagem_tipo_pessoa) || $hospedagem_tipo_pessoa_cond == "nu" || $hospedagem_tipo_pessoa_cond == "nn" || $hospedagem_tipo_pessoa_cond == "ep" || $hospedagem_tipo_pessoa_cond == "ne")
      {
         $this->monta_condicao("hospedagem_tipo_pessoa", $hospedagem_tipo_pessoa_cond, $hospedagem_tipo_pessoa, "", "hospedagem_tipo_pessoa", "VARCHAR", false);
      }

      //----- $hospedagem_dtchkin
      $this->Date_part = false;
      if ($hospedagem_dtchkin_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $hospedagem_dtchkin_cond = strtoupper($hospedagem_dtchkin_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $hospedagem_dtchkin_ano;
          $Dtxt .= $hospedagem_dtchkin_mes;
          $Dtxt .= $hospedagem_dtchkin_dia;
          $val[0]['ano'] = $hospedagem_dtchkin_ano;
          $val[0]['mes'] = $hospedagem_dtchkin_mes;
          $val[0]['dia'] = $hospedagem_dtchkin_dia;
          if ($hospedagem_dtchkin_cond == "BW")
          {
              $val[1]['ano'] = $hospedagem_dtchkin_input_2_ano;
              $val[1]['mes'] = $hospedagem_dtchkin_input_2_mes;
              $val[1]['dia'] = $hospedagem_dtchkin_input_2_dia;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->nm_prep_date($val, "DT", "DATETIME", $hospedagem_dtchkin_cond, "", "data");
          }
          else
          {
              $this->nm_prep_date($val, "DT", "DATE", $hospedagem_dtchkin_cond, "", "data");
          }
          if (!$this->Date_part) {
              $val[0] = $this->Ini->sc_Date_Protect($val[0]);
          }
          $hospedagem_dtchkin = $val[0];
          $this->cmp_formatado['hospedagem_dtchkin'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkin'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['hospedagem_dtchkin'], "YYYY-MM-DD");
          $this->cmp_formatado['hospedagem_dtchkin'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['hospedagem_dtchkin'] = "'" . $this->cmp_formatado['hospedagem_dtchkin'] . "'";
          if ($hospedagem_dtchkin_cond == "BW")
          {
              if (!$this->Date_part) {
                  $val[1] = $this->Ini->sc_Date_Protect($val[1]);
              }
              $hospedagem_dtchkin_input_2     = $val[1];
              $this->cmp_formatado['hospedagem_dtchkin_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkin_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['hospedagem_dtchkin_input_2'], "YYYY-MM-DD");
              $this->cmp_formatado['hospedagem_dtchkin_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['hospedagem_dtchkin_input_2'] = "'" . $this->cmp_formatado['hospedagem_dtchkin_input_2'] . "'";
          }
          if (!empty($Dtxt) || $hospedagem_dtchkin_cond == "NU" || $hospedagem_dtchkin_cond == "NN"|| $hospedagem_dtchkin_cond == "EP"|| $hospedagem_dtchkin_cond == "NE")
          {
              $this->monta_condicao("hospedagem_dtchkin", $hospedagem_dtchkin_cond, $hospedagem_dtchkin, $hospedagem_dtchkin_input_2, 'hospedagem_dtchkin', 'DATE');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['hospedagem_dtchkin']['label'] = $nmgp_tab_label['hospedagem_dtchkin'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['hospedagem_dtchkin']['descr'] = $nmgp_tab_label['hospedagem_dtchkin'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['hospedagem_dtchkin']['hint']  = $nmgp_tab_label['hospedagem_dtchkin'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $hospedagem_hrchkin
      $this->Date_part = false;
      if ($hospedagem_hrchkin_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $hospedagem_hrchkin_cond = strtoupper($hospedagem_hrchkin_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $hospedagem_hrchkin_hor;
          $Dtxt .= $hospedagem_hrchkin_min;
          $Dtxt .= $hospedagem_hrchkin_seg;
          $val[0]['hor'] = $hospedagem_hrchkin_hor;
          $val[0]['min'] = $hospedagem_hrchkin_min;
          $val[0]['seg'] = $hospedagem_hrchkin_seg;
          if ($hospedagem_hrchkin_cond == "BW")
          {
              $val[1]['ano'] = $hospedagem_hrchkin_input_2_ano;
              $val[1]['mes'] = $hospedagem_hrchkin_input_2_mes;
              $val[1]['dia'] = $hospedagem_hrchkin_input_2_dia;
              $val[1]['hor'] = $hospedagem_hrchkin_input_2_hor;
              $val[1]['min'] = $hospedagem_hrchkin_input_2_min;
              $val[1]['seg'] = $hospedagem_hrchkin_input_2_seg;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          $this->nm_prep_date($val, "HH", "TIME", $hospedagem_hrchkin_cond, "", "hora");
          $hospedagem_hrchkin = $val[0];
          $this->cmp_formatado['hospedagem_hrchkin'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_hrchkin'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['hospedagem_hrchkin'], "HH:II:SS");
          $this->cmp_formatado['hospedagem_hrchkin'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "his"));
          $this->cmp_formatado['hospedagem_hrchkin'] = "'" . $this->cmp_formatado['hospedagem_hrchkin'] . "'";
          if ($hospedagem_hrchkin_cond == "BW")
          {
              $hospedagem_hrchkin_input_2     = $val[1];
              $this->cmp_formatado['hospedagem_hrchkin_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_hrchkin_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['hospedagem_hrchkin_input_2'], "HH:II:SS");
              $this->cmp_formatado['hospedagem_hrchkin_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "his"));
          $this->cmp_formatado['hospedagem_hrchkin_input_2'] = "'" . $this->cmp_formatado['hospedagem_hrchkin_input_2'] . "'";
          }
          if (!empty($Dtxt) || $hospedagem_hrchkin_cond == "NU" || $hospedagem_hrchkin_cond == "NN"|| $hospedagem_hrchkin_cond == "EP"|| $hospedagem_hrchkin_cond == "NE")
          {
              $this->monta_condicao("hospedagem_hrchkin", $hospedagem_hrchkin_cond, $hospedagem_hrchkin, $hospedagem_hrchkin_input_2, 'hospedagem_hrchkin', 'TIME');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['hospedagem_hrchkin']['label'] = $nmgp_tab_label['hospedagem_hrchkin'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['hospedagem_hrchkin']['descr'] = $nmgp_tab_label['hospedagem_hrchkin'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['hospedagem_hrchkin']['hint']  = $nmgp_tab_label['hospedagem_hrchkin'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $hospedagem_dtchkout
      $this->Date_part = false;
      if ($hospedagem_dtchkout_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $hospedagem_dtchkout_cond = strtoupper($hospedagem_dtchkout_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $hospedagem_dtchkout_ano;
          $Dtxt .= $hospedagem_dtchkout_mes;
          $Dtxt .= $hospedagem_dtchkout_dia;
          $val[0]['ano'] = $hospedagem_dtchkout_ano;
          $val[0]['mes'] = $hospedagem_dtchkout_mes;
          $val[0]['dia'] = $hospedagem_dtchkout_dia;
          if ($hospedagem_dtchkout_cond == "BW")
          {
              $val[1]['ano'] = $hospedagem_dtchkout_input_2_ano;
              $val[1]['mes'] = $hospedagem_dtchkout_input_2_mes;
              $val[1]['dia'] = $hospedagem_dtchkout_input_2_dia;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->nm_prep_date($val, "DT", "DATETIME", $hospedagem_dtchkout_cond, "", "data");
          }
          else
          {
              $this->nm_prep_date($val, "DT", "DATE", $hospedagem_dtchkout_cond, "", "data");
          }
          if (!$this->Date_part) {
              $val[0] = $this->Ini->sc_Date_Protect($val[0]);
          }
          $hospedagem_dtchkout = $val[0];
          $this->cmp_formatado['hospedagem_dtchkout'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkout'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['hospedagem_dtchkout'], "YYYY-MM-DD");
          $this->cmp_formatado['hospedagem_dtchkout'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['hospedagem_dtchkout'] = "'" . $this->cmp_formatado['hospedagem_dtchkout'] . "'";
          if ($hospedagem_dtchkout_cond == "BW")
          {
              if (!$this->Date_part) {
                  $val[1] = $this->Ini->sc_Date_Protect($val[1]);
              }
              $hospedagem_dtchkout_input_2     = $val[1];
              $this->cmp_formatado['hospedagem_dtchkout_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_dtchkout_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['hospedagem_dtchkout_input_2'], "YYYY-MM-DD");
              $this->cmp_formatado['hospedagem_dtchkout_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['hospedagem_dtchkout_input_2'] = "'" . $this->cmp_formatado['hospedagem_dtchkout_input_2'] . "'";
          }
          if (!empty($Dtxt) || $hospedagem_dtchkout_cond == "NU" || $hospedagem_dtchkout_cond == "NN"|| $hospedagem_dtchkout_cond == "EP"|| $hospedagem_dtchkout_cond == "NE")
          {
              $this->monta_condicao("hospedagem_dtchkout", $hospedagem_dtchkout_cond, $hospedagem_dtchkout, $hospedagem_dtchkout_input_2, 'hospedagem_dtchkout', 'DATE');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['hospedagem_dtchkout']['label'] = $nmgp_tab_label['hospedagem_dtchkout'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['hospedagem_dtchkout']['descr'] = $nmgp_tab_label['hospedagem_dtchkout'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['hospedagem_dtchkout']['hint']  = $nmgp_tab_label['hospedagem_dtchkout'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $hospedagem_hrchkout
      $this->Date_part = false;
      if ($hospedagem_hrchkout_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $hospedagem_hrchkout_cond = strtoupper($hospedagem_hrchkout_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $hospedagem_hrchkout_hor;
          $Dtxt .= $hospedagem_hrchkout_min;
          $Dtxt .= $hospedagem_hrchkout_seg;
          $val[0]['hor'] = $hospedagem_hrchkout_hor;
          $val[0]['min'] = $hospedagem_hrchkout_min;
          $val[0]['seg'] = $hospedagem_hrchkout_seg;
          if ($hospedagem_hrchkout_cond == "BW")
          {
              $val[1]['ano'] = $hospedagem_hrchkout_input_2_ano;
              $val[1]['mes'] = $hospedagem_hrchkout_input_2_mes;
              $val[1]['dia'] = $hospedagem_hrchkout_input_2_dia;
              $val[1]['hor'] = $hospedagem_hrchkout_input_2_hor;
              $val[1]['min'] = $hospedagem_hrchkout_input_2_min;
              $val[1]['seg'] = $hospedagem_hrchkout_input_2_seg;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          $this->nm_prep_date($val, "HH", "TIME", $hospedagem_hrchkout_cond, "", "hora");
          $hospedagem_hrchkout = $val[0];
          $this->cmp_formatado['hospedagem_hrchkout'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_hrchkout'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['hospedagem_hrchkout'], "HH:II:SS");
          $this->cmp_formatado['hospedagem_hrchkout'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "his"));
          $this->cmp_formatado['hospedagem_hrchkout'] = "'" . $this->cmp_formatado['hospedagem_hrchkout'] . "'";
          if ($hospedagem_hrchkout_cond == "BW")
          {
              $hospedagem_hrchkout_input_2     = $val[1];
              $this->cmp_formatado['hospedagem_hrchkout_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']['hospedagem_hrchkout_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['hospedagem_hrchkout_input_2'], "HH:II:SS");
              $this->cmp_formatado['hospedagem_hrchkout_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "his"));
          $this->cmp_formatado['hospedagem_hrchkout_input_2'] = "'" . $this->cmp_formatado['hospedagem_hrchkout_input_2'] . "'";
          }
          if (!empty($Dtxt) || $hospedagem_hrchkout_cond == "NU" || $hospedagem_hrchkout_cond == "NN"|| $hospedagem_hrchkout_cond == "EP"|| $hospedagem_hrchkout_cond == "NE")
          {
              $this->monta_condicao("hospedagem_hrchkout", $hospedagem_hrchkout_cond, $hospedagem_hrchkout, $hospedagem_hrchkout_input_2, 'hospedagem_hrchkout', 'TIME');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['hospedagem_hrchkout']['label'] = $nmgp_tab_label['hospedagem_hrchkout'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['hospedagem_hrchkout']['descr'] = $nmgp_tab_label['hospedagem_hrchkout'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['grid_pesq']['hospedagem_hrchkout']['hint']  = $nmgp_tab_label['hospedagem_hrchkout'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $presenca_status
      $this->Date_part = false;
      if (isset($presenca_status) || $presenca_status_cond == "nu" || $presenca_status_cond == "nn" || $presenca_status_cond == "ep" || $presenca_status_cond == "ne")
      {
         $this->monta_condicao("presenca_status", $presenca_status_cond, $presenca_status, "", "presenca_status", "VARCHAR", false);
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
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq_grid'] = $this->comando;
       if (empty($this->comando)) 
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq_filtro'] = "";
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_orig'];
       }
       else
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq_filtro'] = "( " . $this->comando . " )";
           if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_orig'])) 
           {
               $this->comando = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_orig'] . " and (" . $this->comando . ")"; 
           }
           else
           {
               $this->comando = " where " . $this->comando; 
           }
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq'] = $this->comando;
       }
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq_fast'])) 
       {
           if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq'])) 
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq'] .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq_fast'] . ")";
           }
           else 
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq'] = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq_fast'] . ")";
           }
       }
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq_interativ'])) 
       {
           if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq'])) 
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq'] .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq_interativ'] . ")";
           }
           else 
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq'] = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq_interativ'];
           }
       }
   }
   function finaliza_resultado()
   {
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['dyn_search']      = array();
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['cond_dyn_search'] = "";
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq_fast'] = "";
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['fast_search']);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq_interativ'] = "";
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['interativ_search'] = array();
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['int_search_dados'] = array();
      if ("" == $this->comando_filtro)
      {
          $this->comando = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_orig'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']) && $_SESSION['scriptcase']['charset'] != "UTF-8")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca'], "UTF-8", $_SESSION['scriptcase']['charset']);
      }

      $this->Sel_case_sensitive($this->comando);
      $this->Sel_case_sensitive($this->comando_sum);
      $this->Sel_case_sensitive($this->comando_filtro);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq_grid']    = $this->comando_filtro;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq_lookup']  = $this->comando_sum . $this->comando_fim;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq']         = $this->comando . $this->comando_fim;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['opcao']              = "pesq";
      if ("" == $this->comando_filtro)
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq_filtro'] = "";
      }
      else
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq_filtro'] = " (" . trim($this->comando_filtro) . ")";
      }
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['cond_pesq'] .= $this->NM_operador;
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['contr_array_resumo'] = "NAO";
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['contr_total_geral']  = "NAO";
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['tot_geral']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['using_summary_cache']);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq'];

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

function BuscaAcomp($evento,$usuario,$ptipo) {
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'on';
  	
		date_default_timezone_set('America/Sao_Paulo');
		
		$valor_y = 'Y';
		$sqlj="
			SELECT
				participantes_rsvp.part_cpf AS p_cpf,
				participantes_rsvp.part_id_evento AS p_evento,
				acompanhantes_rsvp.part_id_evento AS ac_evento,
				acompanhantes_rsvp.part_cpf_mestre AS ac_cpf_mestre ,
				acompanhantes_rsvp.part_cpf AS ac_cpf,
				pessoas_rsvp.pessoa_cpf AS pe_cpf,
				pessoas_rsvp.pessoa_nome AS pe_nome
			FROM
				participantes_rsvp
			LEFT JOIN 
				acompanhantes_rsvp
			ON 
				acompanhantes_rsvp.part_cpf_mestre = participantes_rsvp.part_cpf  
			LEFT JOIN 
				pessoas_rsvp
			ON 
				pessoas_rsvp.pessoa_cpf = acompanhantes_rsvp.part_cpf		
			WHERE
				participantes_rsvp.part_ativo	= ".$this->Db->qstr($valor_y)."
			AND	
				participantes_rsvp.part_id_evento = ".$this->Db->qstr($evento)."
			AND 
				acompanhantes_rsvp.part_id_evento = ".$this->Db->qstr($evento)."			
			AND 
				acompanhantes_rsvp.part_cpf_mestre IS NOT NULL	
			ORDER BY
				participantes_rsvp.part_cpf			
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
		$v_nome_acompanhante = '';
		$_contador = 1;
		$_atucpf = '';
		if ($reg_part > 0) {
			for ($i=0;$i<$reg_part;++$i) {
				$_antcpf = $rsj[$i][0];
				if($_antcpf <> $_atucpf) {
					$v_nome_acompanhante = '';	
					$_contador = 1;
				}	
				$v_cpf_participante = $rsj[$i][0];
				
				if ($_contador == 1) {
					$v_nome_acompanhante = $rsj[$i][6];
					switch($ptipo) {
						case 'RSVP':		
							$sqlu="
							UPDATE
								rsvp_part_r
							SET	
								acompanhantes_nomes = ".$this->Db->qstr($v_nome_acompanhante)."
							WHERE	
							rsvp_part_r.p_cpf = ".$this->Db->qstr($v_cpf_participante)."
							";
							break;	
						case 'INAER':
							break;
					}	
				} else {
					$v_nome_acompanhante = $v_nome_acompanhante.';'.$rsj[$i][6];
					switch($ptipo) {
						case 'RSVP':		
							$sqlu="
							UPDATE
								rsvp_part_r
							SET	
								acompanhantes_nomes = ".$this->Db->qstr($v_nome_acompanhante)."
							WHERE	
								rsvp_part_r.p_cpf = ".$this->Db->qstr($v_cpf_participante)."
							";
							break;	
						case 'INAER':
							break;		
					}
				}
				
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
      
				if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

				$_atucpf = $rsj[$i][0];
				$_contador = $_contador + 1;
			}			
		}
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
}


function GetUsuarioNivel($idu,$tipo) {
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
}


function PrepRelRsvp($evento,$usuario,$nivel) {
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'on';
if (!isset($_SESSION['vg_usuario_id'])) {$_SESSION['vg_usuario_id'] = "";}
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
if (!isset($_SESSION['vg_evento_id'])) {$_SESSION['vg_evento_id'] = "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
  		
		date_default_timezone_set('America/Sao_Paulo');
		$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
		$ret = 'ADICIONA ERRO2';
		$valor_y = 'Y';
		$nome_empresa = '';
	
		if($nivel == 'CONVIDADO') {
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
					usuario_id = ".$this->Db->qstr($usuario)."	
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
			if($nome_empresa == '') {
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
					publico_rsvp.publico_nome,
					tbl_regionais.regional_dsc,
					participantes_rsvp.part_dt_nasc,
					participantes_rsvp.part_rg,
					participantes_rsvp.part_cpf_informado,
					anotacoes_rsvp.ant_dsc,
					participantes_rsvp.part_fone_internacional					
				FROM
					participantes_rsvp
				LEFT JOIN
					publico_rsvp
				ON 
					publico_rsvp.publico_id = participantes_rsvp.part_id_evento_publico	
				LEFT JOIN
					tbl_regionais
				ON
					tbl_regionais.regional_id = participantes_rsvp.part_id_evento_regional			 
				LEFT JOIN 
					anotacoes_rsvp 
				ON 
					anotacoes_rsvp.ant_cpf_participante = participantes_rsvp.part_cpf AND anotacoes_rsvp.ant_evento_id = participantes_rsvp.part_id_evento	
				WHERE
					participantes_rsvp.part_ativo	= ".$this->Db->qstr($valor_y)."
				AND	
					participantes_rsvp.part_id_evento = '".$this->sc_temp_vg_evento_id."'
				AND
					participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)."
				GROUP by
					participantes_rsvp.part_cpf		
				ORDER BY				 
					participantes_rsvp.nome_pessoa
				";
							
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
					publico_rsvp.publico_nome,
					tbl_regionais.regional_dsc,
					participantes_rsvp.part_dt_nasc,
					participantes_rsvp.part_rg,
					participantes_rsvp.part_cpf_informado,
					anotacoes_rsvp.ant_dsc,
					participantes_rsvp.part_fone_internacional,
					participantes_rsvp.dsc_empresa_rsvp
				FROM
					participantes_rsvp
				LEFT JOIN
					publico_rsvp
				ON 
					publico_rsvp.publico_id = participantes_rsvp.part_id_evento_publico	
				LEFT JOIN
					tbl_regionais
				ON
					tbl_regionais.regional_id = participantes_rsvp.part_id_evento_regional			 
				LEFT JOIN 
					anotacoes_rsvp 
				ON 
					anotacoes_rsvp.ant_cpf_participante = participantes_rsvp.part_cpf AND anotacoes_rsvp.ant_evento_id = participantes_rsvp.part_id_evento	
				WHERE
					participantes_rsvp.part_ativo	= ".$this->Db->qstr($valor_y)."
				AND	
					participantes_rsvp.part_id_evento = '".$this->sc_temp_vg_evento_id."'
				AND
					participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)."	
				AND
					participantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)."
				GROUP by
					participantes_rsvp.part_cpf		
				ORDER BY				 
					participantes_rsvp.nome_pessoa
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
					$vpublico_nome				= $rsj[$i][19];
					$vregional_nome				= $rsj[$i][20];  
					
					$vdtnasc					= $rsj[$i][21];  
					$vrg						= $rsj[$i][22]; 
					$vpartcpf					= $rsj[$i][23]; 
					$vanotacoes					= $rsj[$i][24]; 
					$vfoneinter					= $rsj[$i][25]; 	
										
					$vcontato_cpf            	= '';  
					$vcontato_status         	= '';  
					$vcontato_data           	= ''; 
					$vcontato_motivo         	= '';
					$vcontato_obs            	= '';
					$vcontato_usuario_id        = '';
					$vcontato_status_dsc        = ''; 

					$vpresenca_tipo_part        = '';
					$vpresenca_status        	= '';
					$vpresenca_obs           	= '';
					$vpresenca_motivo        	= '';  
					$vpresenca_data				= '';  
					$vpresenca_usuario_id       = '';  
					$vcontato_usuario_nome		= '';  
					$vpresenca_usuario_nome		= '';  			
					$vpresenca_cpf				= '';
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
					
					if($vpartcpf == '') {
						$vpartcpf = $vpcpf;
					}	
					
															
					$sqlcont = "								                                                                                             
					SELECT                                                                                                          
						contatos_rsvp.contato_cpf_participante,
						contatos_rsvp.contato_id_evento,
						contatos_rsvp.contato_status,
						contatos_rsvp.contato_data_hora,
						contatos_rsvp.contato_motivo_frase,
						contatos_rsvp.contato_obs,
						contatos_rsvp.contato_usuario_id,
						usuarios_rsvp.usuario_nome
					FROM                                                                                                            
						contatos_rsvp
					RIGHT JOIN 
						usuarios_rsvp
					ON 
						usuarios_rsvp.usuario_id = contatos_rsvp.contato_usuario_id 							
					WHERE                                                                                                           
						contatos_rsvp.contato_cpf_participante = '".$vpcpf."'                                                                                 
					AND
						contatos_rsvp.contato_id_evento = '".$vpevento."'
					ORDER BY                                                                                                        
						contatos_rsvp.contato_data_hora DESC,
						contato_id_evento,
						contato_cpf_participante
					LIMIT 1						
					";
					 
      $nm_select = $sqlcont; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rscont = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rscont[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rscont = false;
          $rscont_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rscont[0][0])) {					
						$vcontato_cpf 			= $rscont[0][0];			
						$vcontato_status        = $rscont[0][2];   
						$vcontato_data          = $rscont[0][3];  
						$vcontato_motivo        = $rscont[0][4]; 
						$vcontato_obs           = $rscont[0][5]; 
						$vcontato_usuario_id    = $rscont[0][6];   
						$vcontato_usuario_nome	= $rscont[0][7];						
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
					} else {
						$vcontato_status_dsc = 'ABERTO'; 	
					}	
					
							
					$sqlpres = "
					SELECT                                                                                                          
						presencas_rsvp.presenca_cpf_participante,
						presencas_rsvp.presenca_id_evento,
						presencas_rsvp.presenca_status,
						presencas_rsvp.presenca_data_hora,
						presencas_rsvp.presenca__frase_resposta,
						presencas_rsvp.presenca_obs,
						presencas_rsvp.presenca_usuario_id,
						presencas_rsvp.presenca_tipo_part, 
						usuarios_rsvp.usuario_nome
					FROM                                                                                                            
						presencas_rsvp
					RIGHT JOIN 
						usuarios_rsvp
					ON 
						usuarios_rsvp.usuario_id = presencas_rsvp.presenca_usuario_id
					WHERE                                                                                                           
						presencas_rsvp.presenca_cpf_participante = ".$this->Db->qstr($vpcpf)."                                                                                 
					AND
						presencas_rsvp.presenca_id_evento = ".$this->Db->qstr($vpevento)."
					ORDER BY                                                                                                        
						presencas_rsvp.presenca_data_hora DESC,
						presencas_rsvp.presenca_id_evento,
						presencas_rsvp.presenca_cpf_participante
					LIMIT 1											
					";
					 
      $nm_select = $sqlpres; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rspres = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspres[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspres = false;
          $rspres_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rspres[0][0])) {											
						$vpresenca_status       = $rspres[0][2];
						$vpresenca_data			= $rspres[0][3];  
						$vpresenca_motivo       = $rspres[0][4];  
						$vpresenca_obs          = $rspres[0][5];
						$vpresenca_usuario_id   = $rspres[0][6];  
						$vpresenca_tipo_part    = $rspres[0][7];
						$vpresenca_usuario_nome	= $rspres[0][8];								
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
					} else {
						$vpresenca_status_dsc = 'ABERTO'; 
					}			
					$sqlins = "
						SELECT 
							COUNT(p_cpf) as qtde
						FROM 
							rsvp_part_r
						WHERE 
							p_cpf = ".$this->Db->qstr($vpcpf)." 
						AND 
							p_evento = ".$this->Db->qstr($vpevento)."		
						AND 
    						id_usuario_relato = ".$this->Db->qstr($usuario)."	
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
							presenca_usuario_dsc,
							data_nascimento,
							rg,
							cpf_informado,
							anotacoes,
							telefone_internacional)	             
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
							".$this->Db->qstr($vpresenca_usuario_nome).",
							".$this->Db->qstr($vdtnasc).",
							".$this->Db->qstr($vrg).",
							".$this->Db->qstr($vpartcpf).",							
							".$this->Db->qstr($vanotacoes).",
							".$this->Db->qstr($vfoneinter).")
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
				$ret = 'ADICIONA OK2';		
			} else {
				$ret = 'ADICIONA ERRO2';
			}			
		}
		return $ret;
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
}


function PrepRelRsvp2($evento,$usuario) {
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'on';
if (!isset($_SESSION['vg_usuario_id'])) {$_SESSION['vg_usuario_id'] = "";}
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
if (!isset($_SESSION['vg_evento_id'])) {$_SESSION['vg_evento_id'] = "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
  
		date_default_timezone_set('America/Sao_Paulo');
		$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
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
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
}

}

?>
