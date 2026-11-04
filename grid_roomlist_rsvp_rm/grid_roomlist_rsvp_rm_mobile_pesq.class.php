<?php

class grid_roomlist_rsvp_rm_pesq
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['path_libs_php'] = $this->Ini->path_lib_php;
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca'] = array(); 
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
                      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca'][$field] = $arr_tmp; 
                  }
                  else
                  {
                      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca'][$field] = $cada_dado['value']; 
                  }
              }
          }
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca'], $_SESSION['scriptcase']['charset'], "UTF-8");
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['opcao'] = "igual";
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
                  $Opt_filter .= "<option value=\"\">" . grid_roomlist_rsvp_rm_pack_protect_string($Nome_filter) . "</option>\r\n";
              }
              $Opt_filter .= "<option value=\"" . grid_roomlist_rsvp_rm_pack_protect_string($Tipo_filter[0]) . "\">.." . htmlspecialchars($Cada_filter).  "</option>\r\n";
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
                  $Opt_filter .= "<option value=\"\">" .  grid_roomlist_rsvp_rm_pack_protect_string($Nome_filter) . "</option>\r\n";
              }
              $Opt_filter .= "<option value=\"" . grid_roomlist_rsvp_rm_pack_protect_string($Tipo_filter[0]) . "\">.." . grid_roomlist_rsvp_rm_pack_protect_string($Cada_filter) .  "</option>\r\n";
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

      if ($this->NM_ajax_opcao == 'autocomp_hospede')
      {
          $hospede = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_hospede($hospede);
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
      if ($this->NM_ajax_opcao == 'autocomp_cpf')
      {
          $cpf = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_cpf($cpf);
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
      if ($this->NM_ajax_opcao == 'autocomp_passaporte')
      {
          $passaporte = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_passaporte($passaporte);
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
      if ($this->NM_ajax_opcao == 'autocomp_publico_dsc')
      {
          $publico_dsc = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_publico_dsc($publico_dsc);
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
      if ($this->NM_ajax_opcao == 'autocomp_hotel_dsc')
      {
          $hotel_dsc = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_hotel_dsc($hotel_dsc);
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
      if ($this->NM_ajax_opcao == 'autocomp_acomodacao_dsc')
      {
          $acomodacao_dsc = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_acomodacao_dsc($acomodacao_dsc);
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
      if ($this->NM_ajax_opcao == 'autocomp_categoria_dsc')
      {
          $categoria_dsc = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_categoria_dsc($categoria_dsc);
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
      if ($this->NM_ajax_opcao == 'autocomp_voo_ida')
      {
          $voo_ida = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_voo_ida($voo_ida);
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
      if ($this->NM_ajax_opcao == 'autocomp_voo_volta')
      {
          $voo_volta = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_voo_volta($voo_volta);
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
      if ($this->NM_ajax_opcao == 'autocomp_forma_pgto')
      {
          $forma_pgto = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_forma_pgto($forma_pgto);
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
      if ($this->NM_ajax_opcao == 'autocomp_tipo_transfer')
      {
          $tipo_transfer = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_tipo_transfer($tipo_transfer);
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
   function lookup_ajax_hospede($hospede)
   {
      $hospede = substr($this->Db->qstr($hospede), 1, -1);
            $hospede_look = (is_string($hospede) ? substr($this->Db->qstr($hospede), 1, -1) : $hospede); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct hospede from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#hospede#lowerF# like #lowerI#'%" . $hospede . "%'#lowerF# order by hospede"; 
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
   
   function lookup_ajax_cpf($cpf)
   {
      $cpf = substr($this->Db->qstr($cpf), 1, -1);
            $cpf_look = (is_string($cpf) ? substr($this->Db->qstr($cpf), 1, -1) : $cpf); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct cpf from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#cpf#lowerF# like #lowerI#'%" . $cpf . "%'#lowerF# order by cpf"; 
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
   
   function lookup_ajax_passaporte($passaporte)
   {
      $passaporte = substr($this->Db->qstr($passaporte), 1, -1);
            $passaporte_look = (is_string($passaporte) ? substr($this->Db->qstr($passaporte), 1, -1) : $passaporte); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct passaporte from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#passaporte#lowerF# like #lowerI#'%" . $passaporte . "%'#lowerF# order by passaporte"; 
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
   
   function lookup_ajax_publico_dsc($publico_dsc)
   {
      $publico_dsc = substr($this->Db->qstr($publico_dsc), 1, -1);
            $publico_dsc_look = (is_string($publico_dsc) ? substr($this->Db->qstr($publico_dsc), 1, -1) : $publico_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct publico_dsc from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#publico_dsc#lowerF# like #lowerI#'%" . $publico_dsc . "%'#lowerF# order by publico_dsc"; 
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
   
   function lookup_ajax_hotel_dsc($hotel_dsc)
   {
      $hotel_dsc = substr($this->Db->qstr($hotel_dsc), 1, -1);
            $hotel_dsc_look = (is_string($hotel_dsc) ? substr($this->Db->qstr($hotel_dsc), 1, -1) : $hotel_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct hotel_dsc from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#hotel_dsc#lowerF# like #lowerI#'%" . $hotel_dsc . "%'#lowerF# order by hotel_dsc"; 
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
   
   function lookup_ajax_acomodacao_dsc($acomodacao_dsc)
   {
      $acomodacao_dsc = substr($this->Db->qstr($acomodacao_dsc), 1, -1);
            $acomodacao_dsc_look = (is_string($acomodacao_dsc) ? substr($this->Db->qstr($acomodacao_dsc), 1, -1) : $acomodacao_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct acomodacao_dsc from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#acomodacao_dsc#lowerF# like #lowerI#'%" . $acomodacao_dsc . "%'#lowerF# order by acomodacao_dsc"; 
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
   
   function lookup_ajax_categoria_dsc($categoria_dsc)
   {
      $categoria_dsc = substr($this->Db->qstr($categoria_dsc), 1, -1);
            $categoria_dsc_look = (is_string($categoria_dsc) ? substr($this->Db->qstr($categoria_dsc), 1, -1) : $categoria_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct categoria_dsc from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#categoria_dsc#lowerF# like #lowerI#'%" . $categoria_dsc . "%'#lowerF# order by categoria_dsc"; 
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
   
   function lookup_ajax_voo_ida($voo_ida)
   {
      $voo_ida = substr($this->Db->qstr($voo_ida), 1, -1);
            $voo_ida_look = (is_string($voo_ida) ? substr($this->Db->qstr($voo_ida), 1, -1) : $voo_ida); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct voo_ida from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#voo_ida#lowerF# like #lowerI#'%" . $voo_ida . "%'#lowerF# order by voo_ida"; 
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
   
   function lookup_ajax_voo_volta($voo_volta)
   {
      $voo_volta = substr($this->Db->qstr($voo_volta), 1, -1);
            $voo_volta_look = (is_string($voo_volta) ? substr($this->Db->qstr($voo_volta), 1, -1) : $voo_volta); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct voo_volta from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#voo_volta#lowerF# like #lowerI#'%" . $voo_volta . "%'#lowerF# order by voo_volta"; 
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
   
   function lookup_ajax_forma_pgto($forma_pgto)
   {
      $forma_pgto = substr($this->Db->qstr($forma_pgto), 1, -1);
            $forma_pgto_look = (is_string($forma_pgto) ? substr($this->Db->qstr($forma_pgto), 1, -1) : $forma_pgto); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct forma_pgto from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#forma_pgto#lowerF# like #lowerI#'%" . $forma_pgto . "%'#lowerF# order by forma_pgto"; 
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
      $nm_comando = "select distinct tipo_pessoa from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#tipo_pessoa#lowerF# like #lowerI#'%" . $tipo_pessoa . "%'#lowerF# order by tipo_pessoa"; 
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
   
   function lookup_ajax_tipo_transfer($tipo_transfer)
   {
      $tipo_transfer = substr($this->Db->qstr($tipo_transfer), 1, -1);
            $tipo_transfer_look = (is_string($tipo_transfer) ? substr($this->Db->qstr($tipo_transfer), 1, -1) : $tipo_transfer); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tipo_transfer from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#tipo_transfer#lowerF# like #lowerI#'%" . $tipo_transfer . "%'#lowerF# order by tipo_transfer"; 
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
      $Nm_datas[] = 'data_nasc';$Nm_datas[] = 'dt_checkin';$Nm_datas[] = 'hr_transferin';$Nm_datas[] = 'dt_checkout';$Nm_datas[] = 'hr_transferout';$Nm_datas[] = 'intervalo_trout';$Nm_datas[] = 'amq_dtnasc_01';$Nm_datas[] = 'amq_dtnasc_02';$Nm_datas[] = 'amq_dtnasc_03';$Nm_datas[] = 'amq_dtnasc_04';$Nm_datas[] = 'pmq_dtnasc_01';$Nm_datas[] = 'pmq_dtnasc_02';$Nm_datas[] = 'pmq_dtnasc_03';$Nm_datas[] = 'pmq_dtnasc_04';$Nm_numeric[] = "room_id";$Nm_numeric[] = "aqtd_mesmo_quarto";$Nm_numeric[] = "pqtd_mesmo_quarto";$Nm_numeric[] = "cod_publico";$Nm_numeric[] = "cod_hotel";$Nm_numeric[] = "cod_acomodacao";$Nm_numeric[] = "cod_categoria";$Nm_numeric[] = "cod_cia_ida";$Nm_numeric[] = "cod_cia_volta";$Nm_numeric[] = "cod_forma_pgto";$Nm_numeric[] = "cod_evento";$Nm_numeric[] = "id_usuario_relato";
      $campo_join = strtolower(str_replace(".", "_", $nome));
      if (in_array($campo_join, $Nm_numeric))
      {
          if ($condicao == "EP" || $condicao == "NE")
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$campo_join]);
              return;
          }
         $nm_ini_lower = "";
         $nm_fim_lower = "";
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['decimal_db'] == ".")
         {
            $nm_aspas  = "";
            $nm_aspas1 = "";
         }
         if ($condicao != "IN")
         {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['decimal_db'] == ".")
            {
               $campo  = str_replace(",", ".", $campo);
               $campo2 = str_replace(",", ".", $campo2);
            }
         }
      }
      $Nm_datas[] = 'data_nasc';$Nm_datas[] = 'dt_checkin';$Nm_datas[] = 'hr_transferin';$Nm_datas[] = 'dt_checkout';$Nm_datas[] = 'hr_transferout';$Nm_datas[] = 'intervalo_trout';$Nm_datas[] = 'amq_dtnasc_01';$Nm_datas[] = 'amq_dtnasc_02';$Nm_datas[] = 'amq_dtnasc_03';$Nm_datas[] = 'amq_dtnasc_04';$Nm_datas[] = 'pmq_dtnasc_01';$Nm_datas[] = 'pmq_dtnasc_02';$Nm_datas[] = 'pmq_dtnasc_03';$Nm_datas[] = 'pmq_dtnasc_04';
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
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['SC_sep_date']))
          {
              $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['SC_sep_date'];
              $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['SC_sep_date1'];
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
         $nome_sum = "roomlist_rsvp_r.$nome";
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
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_equl'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $this->cmp_formatado[$nome_campo];
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
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $lang_like . " (" . str_replace(" ",$Conect_msg,$this->cmp_formatado[$nome_campo]) . ")##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $lang_like . " (" . str_replace(" ",$Conect_msg,$this->cmp_formatado[$nome_campo]) . ")";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['hint']  = $nmgp_tab_label[$nome_campo] . ": " . $lang_like . " (" . str_replace(" ",$Conect_msg,$this->cmp_formatado[$nome_campo]) . ")";
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
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_strt'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_strt'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_strt'] . " " . $this->cmp_formatado[$nome_campo];
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
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . ":</span> " . str_replace(array("##ini##","##fim##"), array("<span class='scGridFilterDynValue'>","</span>"),$NM_cond) . "##*@@";
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
                       $NM_cond = str_replace(array("##ini##","##fim##"), array("",""),$NM_cond);
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $NM_cond;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $NM_cond;
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
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $lang_like . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $lang_like . " " . $this->cmp_formatado[$nome_campo];
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $lang_like . " " . $this->cmp_formatado[$nome_campo];
               }
            break;
            case "DF":     // 
               $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_diff'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_diff'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_diff'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "GT":     // 
               $this->comando        .= " $nome > " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum > " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome > " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_grtr'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "GE":     // 
               $this->comando        .= " $nome >= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum >= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome >= " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "LT":     // 
               $this->comando        .= " $nome < " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum < " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome < " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_less'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "LE":     // 
               $this->comando        .= " $nome <= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum <= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome <= " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_less_equl'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less_equl'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less_equl'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "BW":     // 
               $this->comando        .= " $nome between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $this->comando_filtro .= " $nome between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_betw'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo] . " </span>" . $this->Ini->Nm_lang['lang_srch_and_cond'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo . "_input_2"] . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_betw'] . " " . $this->cmp_formatado[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " " . $this->cmp_formatado[$nome_campo . "_input_2"];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_betw'] . " " . $this->cmp_formatado[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " " . $this->cmp_formatado[$nome_campo . "_input_2"];
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
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_equl'] . " <span class='scGridFilterDynValue'>" . $nm_cond . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $cond_descr;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $nm_cond;
            break;
            case "NU":     // 
               $this->comando        .= " $nome IS NULL ";
               $this->comando_sum    .= " $nome_sum IS NULL ";
               $this->comando_filtro .= " $nome IS NULL ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_null'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_null'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_null'];
            break;
            case "NN":     // 
               $this->comando        .= " $nome IS NOT NULL ";
               $this->comando_sum    .= " $nome_sum IS NOT NULL ";
               $this->comando_filtro .= " $nome IS NOT NULL ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_nnul'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nnul'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nnul'];
            break;
            case "EP":     // 
               $this->comando        .= " $nome = '' ";
               $this->comando_sum    .= " $nome_sum = '' ";
               $this->comando_filtro .= " $nome = '' ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_empty'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_empty'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_empty'];
            break;
            case "NE":     // 
               $this->comando        .= " $nome <> '' ";
               $this->comando_sum    .= " $nome_sum <> '' ";
               $this->comando_filtro .= " $nome <> '' ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_nempty'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nempty'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nempty'];
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
 <TITLE> roomlist_rsvp_r</TITLE>
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
       header("Referrer-Policy: origin");
       header("Content-Security-Policy: frame-ancestors 'self' ; form-action 'self' ; connect-src 'self' ; base-uri 'self' ; child-src 'self' ; object-src 'none'");
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE> roomlist_rsvp_r</TITLE>
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>grid_roomlist_rsvp_rm/grid_roomlist_rsvp_rm_fil_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />
<?php
foreach ($this->Ini->tippy_themes as $tippyTheme => $tippyThemeInfo) {
?>
 <link rel="stylesheet" href="<?php echo $tippyThemeInfo['file'] ?>" />
<?php
}
?>
 <script src="<?php echo $this->Ini->path_prod; ?>/third/tippyjs/popper.min.js"></script>
 <script src="<?php echo $this->Ini->path_prod; ?>/third/tippyjs/tippy-bundle.umd.min.js"></script>
 <script>
  $(function() {
  });
 </script>
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
 <script type="text/javascript" src="grid_roomlist_rsvp_rm_ajax_search.js"></script>
 <script type="text/javascript" src="grid_roomlist_rsvp_rm_ajax.js"></script>
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
<script type="text/javascript" src="grid_roomlist_rsvp_rm_message.js"></script>
<link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_sweetalert.css" />
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['glo_nm_path_prod']; ?>/third/sweetalert/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['glo_nm_path_prod']; ?>/third/sweetalert/polyfill.min.js"></script>
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
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['ajax_nav'])
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
<script type="text/javascript" src="grid_roomlist_rsvp_rm_message.js"></script>
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
  str_out += 'SC_hospede_cond#NMF#' + search_get_sel_txt('SC_hospede_cond') + '@NMF@';
  str_out += 'SC_hospede#NMF#' + search_get_text('SC_hospede') + '@NMF@';
  str_out += 'id_ac_hospede#NMF#' + search_get_text('id_ac_hospede') + '@NMF@';
  str_out += 'SC_cpf_cond#NMF#' + search_get_sel_txt('SC_cpf_cond') + '@NMF@';
  str_out += 'SC_cpf#NMF#' + search_get_text('SC_cpf') + '@NMF@';
  str_out += 'id_ac_cpf#NMF#' + search_get_text('id_ac_cpf') + '@NMF@';
  str_out += 'SC_passaporte_cond#NMF#' + search_get_sel_txt('SC_passaporte_cond') + '@NMF@';
  str_out += 'SC_passaporte#NMF#' + search_get_text('SC_passaporte') + '@NMF@';
  str_out += 'id_ac_passaporte#NMF#' + search_get_text('id_ac_passaporte') + '@NMF@';
  str_out += 'SC_cod_publico_cond#NMF#' + search_get_sel_txt('SC_cod_publico_cond') + '@NMF@';
  str_out += 'SC_cod_publico#NMF#' + search_get_text('SC_cod_publico') + '@NMF@';
  str_out += 'SC_publico_dsc_cond#NMF#' + search_get_sel_txt('SC_publico_dsc_cond') + '@NMF@';
  str_out += 'SC_publico_dsc#NMF#' + search_get_text('SC_publico_dsc') + '@NMF@';
  str_out += 'id_ac_publico_dsc#NMF#' + search_get_text('id_ac_publico_dsc') + '@NMF@';
  str_out += 'SC_cod_hotel_cond#NMF#' + search_get_sel_txt('SC_cod_hotel_cond') + '@NMF@';
  str_out += 'SC_cod_hotel#NMF#' + search_get_text('SC_cod_hotel') + '@NMF@';
  str_out += 'SC_hotel_dsc_cond#NMF#' + search_get_sel_txt('SC_hotel_dsc_cond') + '@NMF@';
  str_out += 'SC_hotel_dsc#NMF#' + search_get_text('SC_hotel_dsc') + '@NMF@';
  str_out += 'id_ac_hotel_dsc#NMF#' + search_get_text('id_ac_hotel_dsc') + '@NMF@';
  str_out += 'SC_cod_acomodacao_cond#NMF#' + search_get_sel_txt('SC_cod_acomodacao_cond') + '@NMF@';
  str_out += 'SC_cod_acomodacao#NMF#' + search_get_text('SC_cod_acomodacao') + '@NMF@';
  str_out += 'SC_acomodacao_dsc_cond#NMF#' + search_get_sel_txt('SC_acomodacao_dsc_cond') + '@NMF@';
  str_out += 'SC_acomodacao_dsc#NMF#' + search_get_text('SC_acomodacao_dsc') + '@NMF@';
  str_out += 'id_ac_acomodacao_dsc#NMF#' + search_get_text('id_ac_acomodacao_dsc') + '@NMF@';
  str_out += 'SC_cod_categoria_cond#NMF#' + search_get_sel_txt('SC_cod_categoria_cond') + '@NMF@';
  str_out += 'SC_cod_categoria#NMF#' + search_get_text('SC_cod_categoria') + '@NMF@';
  str_out += 'SC_categoria_dsc_cond#NMF#' + search_get_sel_txt('SC_categoria_dsc_cond') + '@NMF@';
  str_out += 'SC_categoria_dsc#NMF#' + search_get_text('SC_categoria_dsc') + '@NMF@';
  str_out += 'id_ac_categoria_dsc#NMF#' + search_get_text('id_ac_categoria_dsc') + '@NMF@';
  str_out += 'SC_voo_ida_cond#NMF#' + search_get_sel_txt('SC_voo_ida_cond') + '@NMF@';
  str_out += 'SC_voo_ida#NMF#' + search_get_text('SC_voo_ida') + '@NMF@';
  str_out += 'id_ac_voo_ida#NMF#' + search_get_text('id_ac_voo_ida') + '@NMF@';
  str_out += 'SC_cod_cia_ida_cond#NMF#' + search_get_sel_txt('SC_cod_cia_ida_cond') + '@NMF@';
  str_out += 'SC_cod_cia_ida#NMF#' + search_get_text('SC_cod_cia_ida') + '@NMF@';
  str_out += 'SC_dt_checkin_cond#NMF#' + search_get_sel_txt('SC_dt_checkin_cond') + '@NMF@';
  str_out += 'SC_dt_checkin_dia#NMF#' + search_get_sel_txt('SC_dt_checkin_dia') + '@NMF@';
  str_out += 'SC_dt_checkin_mes#NMF#' + search_get_sel_txt('SC_dt_checkin_mes') + '@NMF@';
  str_out += 'SC_dt_checkin_ano#NMF#' + search_get_sel_txt('SC_dt_checkin_ano') + '@NMF@';
  str_out += 'SC_dt_checkin_input_2_dia#NMF#' + search_get_sel_txt('SC_dt_checkin_input_2_dia') + '@NMF@';
  str_out += 'SC_dt_checkin_input_2_mes#NMF#' + search_get_sel_txt('SC_dt_checkin_input_2_mes') + '@NMF@';
  str_out += 'SC_dt_checkin_input_2_ano#NMF#' + search_get_sel_txt('SC_dt_checkin_input_2_ano') + '@NMF@';
  str_out += 'SC_hr_transferin_cond#NMF#' + search_get_sel_txt('SC_hr_transferin_cond') + '@NMF@';
  str_out += 'SC_hr_transferin_hor#NMF#' + search_get_sel_txt('SC_hr_transferin_hor') + '@NMF@';
  str_out += 'SC_hr_transferin_min#NMF#' + search_get_sel_txt('SC_hr_transferin_min') + '@NMF@';
  str_out += 'SC_hr_transferin_seg#NMF#' + search_get_sel_txt('SC_hr_transferin_seg') + '@NMF@';
  str_out += 'SC_hr_transferin_input_2_hor#NMF#' + search_get_sel_txt('SC_hr_transferin_input_2_hor') + '@NMF@';
  str_out += 'SC_hr_transferin_input_2_min#NMF#' + search_get_sel_txt('SC_hr_transferin_input_2_min') + '@NMF@';
  str_out += 'SC_hr_transferin_input_2_seg#NMF#' + search_get_sel_txt('SC_hr_transferin_input_2_seg') + '@NMF@';
  str_out += 'SC_voo_volta_cond#NMF#' + search_get_sel_txt('SC_voo_volta_cond') + '@NMF@';
  str_out += 'SC_voo_volta#NMF#' + search_get_text('SC_voo_volta') + '@NMF@';
  str_out += 'id_ac_voo_volta#NMF#' + search_get_text('id_ac_voo_volta') + '@NMF@';
  str_out += 'SC_cod_cia_volta_cond#NMF#' + search_get_sel_txt('SC_cod_cia_volta_cond') + '@NMF@';
  str_out += 'SC_cod_cia_volta#NMF#' + search_get_text('SC_cod_cia_volta') + '@NMF@';
  str_out += 'SC_forma_pgto_cond#NMF#' + search_get_sel_txt('SC_forma_pgto_cond') + '@NMF@';
  str_out += 'SC_forma_pgto#NMF#' + search_get_text('SC_forma_pgto') + '@NMF@';
  str_out += 'id_ac_forma_pgto#NMF#' + search_get_text('id_ac_forma_pgto') + '@NMF@';
  str_out += 'SC_dt_checkout_cond#NMF#' + search_get_sel_txt('SC_dt_checkout_cond') + '@NMF@';
  str_out += 'SC_dt_checkout_dia#NMF#' + search_get_sel_txt('SC_dt_checkout_dia') + '@NMF@';
  str_out += 'SC_dt_checkout_mes#NMF#' + search_get_sel_txt('SC_dt_checkout_mes') + '@NMF@';
  str_out += 'SC_dt_checkout_ano#NMF#' + search_get_sel_txt('SC_dt_checkout_ano') + '@NMF@';
  str_out += 'SC_dt_checkout_input_2_dia#NMF#' + search_get_sel_txt('SC_dt_checkout_input_2_dia') + '@NMF@';
  str_out += 'SC_dt_checkout_input_2_mes#NMF#' + search_get_sel_txt('SC_dt_checkout_input_2_mes') + '@NMF@';
  str_out += 'SC_dt_checkout_input_2_ano#NMF#' + search_get_sel_txt('SC_dt_checkout_input_2_ano') + '@NMF@';
  str_out += 'SC_intervalo_trout_cond#NMF#' + search_get_sel_txt('SC_intervalo_trout_cond') + '@NMF@';
  str_out += 'SC_intervalo_trout_hor#NMF#' + search_get_sel_txt('SC_intervalo_trout_hor') + '@NMF@';
  str_out += 'SC_intervalo_trout_min#NMF#' + search_get_sel_txt('SC_intervalo_trout_min') + '@NMF@';
  str_out += 'SC_intervalo_trout_seg#NMF#' + search_get_sel_txt('SC_intervalo_trout_seg') + '@NMF@';
  str_out += 'SC_intervalo_trout_input_2_hor#NMF#' + search_get_sel_txt('SC_intervalo_trout_input_2_hor') + '@NMF@';
  str_out += 'SC_intervalo_trout_input_2_min#NMF#' + search_get_sel_txt('SC_intervalo_trout_input_2_min') + '@NMF@';
  str_out += 'SC_intervalo_trout_input_2_seg#NMF#' + search_get_sel_txt('SC_intervalo_trout_input_2_seg') + '@NMF@';
  str_out += 'SC_hr_transferout_cond#NMF#' + search_get_sel_txt('SC_hr_transferout_cond') + '@NMF@';
  str_out += 'SC_hr_transferout_hor#NMF#' + search_get_sel_txt('SC_hr_transferout_hor') + '@NMF@';
  str_out += 'SC_hr_transferout_min#NMF#' + search_get_sel_txt('SC_hr_transferout_min') + '@NMF@';
  str_out += 'SC_hr_transferout_seg#NMF#' + search_get_sel_txt('SC_hr_transferout_seg') + '@NMF@';
  str_out += 'SC_hr_transferout_input_2_hor#NMF#' + search_get_sel_txt('SC_hr_transferout_input_2_hor') + '@NMF@';
  str_out += 'SC_hr_transferout_input_2_min#NMF#' + search_get_sel_txt('SC_hr_transferout_input_2_min') + '@NMF@';
  str_out += 'SC_hr_transferout_input_2_seg#NMF#' + search_get_sel_txt('SC_hr_transferout_input_2_seg') + '@NMF@';
  str_out += 'SC_tipo_pessoa_cond#NMF#' + search_get_sel_txt('SC_tipo_pessoa_cond') + '@NMF@';
  str_out += 'SC_tipo_pessoa#NMF#' + search_get_text('SC_tipo_pessoa') + '@NMF@';
  str_out += 'id_ac_tipo_pessoa#NMF#' + search_get_text('id_ac_tipo_pessoa') + '@NMF@';
  str_out += 'SC_tipo_transfer_cond#NMF#' + search_get_sel_txt('SC_tipo_transfer_cond') + '@NMF@';
  str_out += 'SC_tipo_transfer#NMF#' + search_get_text('SC_tipo_transfer') + '@NMF@';
  str_out += 'id_ac_tipo_transfer#NMF#' + search_get_text('id_ac_tipo_transfer') + '@NMF@';
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
   scClass = $("#id_ac_hospede").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_hospede").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_hospede",
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
       $("#SC_hospede").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_hospede").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_cpf").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_cpf").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_cpf",
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
       $("#SC_cpf").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_cpf").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_passaporte").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_passaporte").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_passaporte",
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
       $("#SC_passaporte").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_passaporte").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_publico_dsc").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_publico_dsc").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_publico_dsc",
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
       $("#SC_publico_dsc").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_publico_dsc").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_hotel_dsc").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_hotel_dsc").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_hotel_dsc",
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
       $("#SC_hotel_dsc").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_hotel_dsc").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_acomodacao_dsc").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_acomodacao_dsc").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_acomodacao_dsc",
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
       $("#SC_acomodacao_dsc").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_acomodacao_dsc").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_categoria_dsc").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_categoria_dsc").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_categoria_dsc",
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
       $("#SC_categoria_dsc").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_categoria_dsc").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_forma_pgto").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_forma_pgto").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_forma_pgto",
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
       $("#SC_forma_pgto").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_forma_pgto").val( $(this).val() );
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
   scClass = $("#id_ac_voo_ida").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_voo_ida").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_voo_ida",
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
       $("#SC_voo_ida").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_voo_ida").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_voo_volta").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_voo_volta").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_voo_volta",
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
       $("#SC_voo_volta").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_voo_volta").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_tipo_transfer").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_tipo_transfer").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_tipo_transfer",
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
       $("#SC_tipo_transfer").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_tipo_transfer").val( $(this).val() );
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
      if ($this->Ini->Embutida_iframe || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['dashboard_info']['compact_mode'])
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
    <div class="scFilterHeaderFont" style="float: left; text-transform: uppercase;"><?php echo $this->Ini->Nm_lang['lang_othr_srch_title'] ?> roomlist_rsvp_r</div>
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
             $hospede_cond, $hospede, $hospede_autocomp,
             $cpf_cond, $cpf, $cpf_autocomp,
             $passaporte_cond, $passaporte, $passaporte_autocomp,
             $cod_publico_cond, $cod_publico,
             $publico_dsc_cond, $publico_dsc, $publico_dsc_autocomp,
             $cod_hotel_cond, $cod_hotel,
             $hotel_dsc_cond, $hotel_dsc, $hotel_dsc_autocomp,
             $cod_acomodacao_cond, $cod_acomodacao,
             $acomodacao_dsc_cond, $acomodacao_dsc, $acomodacao_dsc_autocomp,
             $cod_categoria_cond, $cod_categoria,
             $categoria_dsc_cond, $categoria_dsc, $categoria_dsc_autocomp,
             $voo_ida_cond, $voo_ida, $voo_ida_autocomp,
             $cod_cia_ida_cond, $cod_cia_ida,
             $dt_checkin_cond, $dt_checkin, $dt_checkin_dia, $dt_checkin_mes, $dt_checkin_ano, $dt_checkin_input_2_dia, $dt_checkin_input_2_mes, $dt_checkin_input_2_ano,
             $hr_transferin_cond, $hr_transferin, $hr_transferin_hor, $hr_transferin_min, $hr_transferin_seg,
             $voo_volta_cond, $voo_volta, $voo_volta_autocomp,
             $cod_cia_volta_cond, $cod_cia_volta,
             $forma_pgto_cond, $forma_pgto, $forma_pgto_autocomp,
             $dt_checkout_cond, $dt_checkout, $dt_checkout_dia, $dt_checkout_mes, $dt_checkout_ano, $dt_checkout_input_2_dia, $dt_checkout_input_2_mes, $dt_checkout_input_2_ano,
             $intervalo_trout_cond, $intervalo_trout, $intervalo_trout_hor, $intervalo_trout_min, $intervalo_trout_seg,
             $hr_transferout_cond, $hr_transferout, $hr_transferout_hor, $hr_transferout_min, $hr_transferout_seg,
             $tipo_pessoa_cond, $tipo_pessoa, $tipo_pessoa_autocomp,
             $tipo_transfer_cond, $tipo_transfer, $tipo_transfer_autocomp,
             $nm_url_saida, $nm_apl_dependente, $nmgp_parms, $bprocessa, $nmgp_save_name, $NM_operador, $NM_filters, $nmgp_save_option, $NM_filters_del, $Script_BI;
      $Script_BI = "";
      $this->nmgp_botoes['clear'] = "on";
      $this->nmgp_botoes['save'] = "on";
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_roomlist_rsvp_rm']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_roomlist_rsvp_rm']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_roomlist_rsvp_rm']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("grid_roomlist_rsvp_rm", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
      {
          $this->aba_iframe = true;
      }
      $nmgp_tab_label = "";
      $delimitador = "##@@";
      if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']) && $bprocessa != "recarga" && $bprocessa != "save_form" && $bprocessa != "filter_save" && $bprocessa != "filter_delete")
      {
      }
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']) && $bprocessa != "recarga" && $bprocessa != "save_form" && $bprocessa != "filter_save" && $bprocessa != "filter_delete")
      { 
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca'], $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $hospede = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hospede']; 
          $hospede_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hospede_cond']; 
          $cpf = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cpf']; 
          $cpf_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cpf_cond']; 
          $passaporte = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['passaporte']; 
          $passaporte_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['passaporte_cond']; 
          $cod_publico = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cod_publico']; 
          $cod_publico_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cod_publico_cond']; 
          $publico_dsc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['publico_dsc']; 
          $publico_dsc_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['publico_dsc_cond']; 
          $cod_hotel = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cod_hotel']; 
          $cod_hotel_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cod_hotel_cond']; 
          $hotel_dsc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hotel_dsc']; 
          $hotel_dsc_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hotel_dsc_cond']; 
          $cod_acomodacao = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cod_acomodacao']; 
          $cod_acomodacao_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cod_acomodacao_cond']; 
          $acomodacao_dsc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['acomodacao_dsc']; 
          $acomodacao_dsc_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['acomodacao_dsc_cond']; 
          $cod_categoria = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cod_categoria']; 
          $cod_categoria_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cod_categoria_cond']; 
          $categoria_dsc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['categoria_dsc']; 
          $categoria_dsc_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['categoria_dsc_cond']; 
          $voo_ida = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['voo_ida']; 
          $voo_ida_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['voo_ida_cond']; 
          $cod_cia_ida = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cod_cia_ida']; 
          $cod_cia_ida_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cod_cia_ida_cond']; 
          $dt_checkin_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkin_dia']; 
          $dt_checkin_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkin_mes']; 
          $dt_checkin_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkin_ano']; 
          $dt_checkin_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkin_input_2_dia']; 
          $dt_checkin_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkin_input_2_mes']; 
          $dt_checkin_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkin_input_2_ano']; 
          $dt_checkin_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkin_cond']; 
          $hr_transferin_hor = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hr_transferin_hor']; 
          $hr_transferin_min = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hr_transferin_min']; 
          $hr_transferin_seg = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hr_transferin_seg']; 
          $hr_transferin_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hr_transferin_cond']; 
          $voo_volta = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['voo_volta']; 
          $voo_volta_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['voo_volta_cond']; 
          $cod_cia_volta = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cod_cia_volta']; 
          $cod_cia_volta_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cod_cia_volta_cond']; 
          $forma_pgto = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['forma_pgto']; 
          $forma_pgto_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['forma_pgto_cond']; 
          $dt_checkout_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkout_dia']; 
          $dt_checkout_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkout_mes']; 
          $dt_checkout_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkout_ano']; 
          $dt_checkout_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkout_input_2_dia']; 
          $dt_checkout_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkout_input_2_mes']; 
          $dt_checkout_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkout_input_2_ano']; 
          $dt_checkout_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkout_cond']; 
          $intervalo_trout_hor = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['intervalo_trout_hor']; 
          $intervalo_trout_min = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['intervalo_trout_min']; 
          $intervalo_trout_seg = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['intervalo_trout_seg']; 
          $intervalo_trout_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['intervalo_trout_cond']; 
          $hr_transferout_hor = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hr_transferout_hor']; 
          $hr_transferout_min = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hr_transferout_min']; 
          $hr_transferout_seg = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hr_transferout_seg']; 
          $hr_transferout_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hr_transferout_cond']; 
          $tipo_pessoa = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['tipo_pessoa']; 
          $tipo_pessoa_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['tipo_pessoa_cond']; 
          $tipo_transfer = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['tipo_transfer']; 
          $tipo_transfer_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['tipo_transfer_cond']; 
          $this->NM_operador = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['NM_operador']; 
          if (strtoupper($cod_publico_cond) != "II" && strtoupper($cod_publico_cond) != "QP" && strtoupper($cod_publico_cond) != "NP" && strtoupper($cod_publico_cond) != "IN") 
          { 
              nmgp_Form_Num_Val($cod_publico, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          if (strtoupper($cod_hotel_cond) != "II" && strtoupper($cod_hotel_cond) != "QP" && strtoupper($cod_hotel_cond) != "NP" && strtoupper($cod_hotel_cond) != "IN") 
          { 
              nmgp_Form_Num_Val($cod_hotel, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          if (strtoupper($cod_acomodacao_cond) != "II" && strtoupper($cod_acomodacao_cond) != "QP" && strtoupper($cod_acomodacao_cond) != "NP" && strtoupper($cod_acomodacao_cond) != "IN") 
          { 
              nmgp_Form_Num_Val($cod_acomodacao, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          if (strtoupper($cod_categoria_cond) != "II" && strtoupper($cod_categoria_cond) != "QP" && strtoupper($cod_categoria_cond) != "NP" && strtoupper($cod_categoria_cond) != "IN") 
          { 
              nmgp_Form_Num_Val($cod_categoria, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          if (strtoupper($cod_cia_ida_cond) != "II" && strtoupper($cod_cia_ida_cond) != "QP" && strtoupper($cod_cia_ida_cond) != "NP" && strtoupper($cod_cia_ida_cond) != "IN") 
          { 
              nmgp_Form_Num_Val($cod_cia_ida, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          if (strtoupper($cod_cia_volta_cond) != "II" && strtoupper($cod_cia_volta_cond) != "QP" && strtoupper($cod_cia_volta_cond) != "NP" && strtoupper($cod_cia_volta_cond) != "IN") 
          { 
              nmgp_Form_Num_Val($cod_cia_volta, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
      } 
      if (!isset($hospede_cond) || empty($hospede_cond))
      {
         $hospede_cond = "qp";
      }
      if (!isset($cpf_cond) || empty($cpf_cond))
      {
         $cpf_cond = "qp";
      }
      if (!isset($passaporte_cond) || empty($passaporte_cond))
      {
         $passaporte_cond = "qp";
      }
      if (!isset($cod_publico_cond) || empty($cod_publico_cond))
      {
         $cod_publico_cond = "gt";
      }
      if (!isset($publico_dsc_cond) || empty($publico_dsc_cond))
      {
         $publico_dsc_cond = "qp";
      }
      if (!isset($cod_hotel_cond) || empty($cod_hotel_cond))
      {
         $cod_hotel_cond = "gt";
      }
      if (!isset($hotel_dsc_cond) || empty($hotel_dsc_cond))
      {
         $hotel_dsc_cond = "qp";
      }
      if (!isset($cod_acomodacao_cond) || empty($cod_acomodacao_cond))
      {
         $cod_acomodacao_cond = "gt";
      }
      if (!isset($acomodacao_dsc_cond) || empty($acomodacao_dsc_cond))
      {
         $acomodacao_dsc_cond = "qp";
      }
      if (!isset($cod_categoria_cond) || empty($cod_categoria_cond))
      {
         $cod_categoria_cond = "gt";
      }
      if (!isset($categoria_dsc_cond) || empty($categoria_dsc_cond))
      {
         $categoria_dsc_cond = "qp";
      }
      if (!isset($voo_ida_cond) || empty($voo_ida_cond))
      {
         $voo_ida_cond = "qp";
      }
      if (!isset($cod_cia_ida_cond) || empty($cod_cia_ida_cond))
      {
         $cod_cia_ida_cond = "gt";
      }
      if (!isset($dt_checkin_cond) || empty($dt_checkin_cond))
      {
         $dt_checkin_cond = "eq";
      }
      if (!isset($hr_transferin_cond) || empty($hr_transferin_cond))
      {
         $hr_transferin_cond = "eq";
      }
      if (!isset($voo_volta_cond) || empty($voo_volta_cond))
      {
         $voo_volta_cond = "qp";
      }
      if (!isset($cod_cia_volta_cond) || empty($cod_cia_volta_cond))
      {
         $cod_cia_volta_cond = "gt";
      }
      if (!isset($forma_pgto_cond) || empty($forma_pgto_cond))
      {
         $forma_pgto_cond = "qp";
      }
      if (!isset($dt_checkout_cond) || empty($dt_checkout_cond))
      {
         $dt_checkout_cond = "eq";
      }
      if (!isset($intervalo_trout_cond) || empty($intervalo_trout_cond))
      {
         $intervalo_trout_cond = "eq";
      }
      if (!isset($hr_transferout_cond) || empty($hr_transferout_cond))
      {
         $hr_transferout_cond = "eq";
      }
      if (!isset($tipo_pessoa_cond) || empty($tipo_pessoa_cond))
      {
         $tipo_pessoa_cond = "qp";
      }
      if (!isset($tipo_transfer_cond) || empty($tipo_transfer_cond))
      {
         $tipo_transfer_cond = "qp";
      }
      $display_aberto  = "style=display:";
      $display_fechado = "style=display:none";
      $opc_hide_input = array("nu","nn","ep","ne");
      $str_hide_hospede = (in_array($hospede_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_cpf = (in_array($cpf_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_passaporte = (in_array($passaporte_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_cod_publico = (in_array($cod_publico_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_publico_dsc = (in_array($publico_dsc_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_cod_hotel = (in_array($cod_hotel_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_hotel_dsc = (in_array($hotel_dsc_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_cod_acomodacao = (in_array($cod_acomodacao_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_acomodacao_dsc = (in_array($acomodacao_dsc_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_cod_categoria = (in_array($cod_categoria_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_categoria_dsc = (in_array($categoria_dsc_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_voo_ida = (in_array($voo_ida_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_cod_cia_ida = (in_array($cod_cia_ida_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_dt_checkin = (in_array($dt_checkin_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_hr_transferin = (in_array($hr_transferin_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_voo_volta = (in_array($voo_volta_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_cod_cia_volta = (in_array($cod_cia_volta_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_forma_pgto = (in_array($forma_pgto_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_dt_checkout = (in_array($dt_checkout_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_intervalo_trout = (in_array($intervalo_trout_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_hr_transferout = (in_array($hr_transferout_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tipo_pessoa = (in_array($tipo_pessoa_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tipo_transfer = (in_array($tipo_transfer_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;

      $str_display_hospede = ('bw' == $hospede_cond) ? $display_aberto : $display_fechado;
      $str_display_cpf = ('bw' == $cpf_cond) ? $display_aberto : $display_fechado;
      $str_display_passaporte = ('bw' == $passaporte_cond) ? $display_aberto : $display_fechado;
      $str_display_cod_publico = ('bw' == $cod_publico_cond) ? $display_aberto : $display_fechado;
      $str_display_publico_dsc = ('bw' == $publico_dsc_cond) ? $display_aberto : $display_fechado;
      $str_display_cod_hotel = ('bw' == $cod_hotel_cond) ? $display_aberto : $display_fechado;
      $str_display_hotel_dsc = ('bw' == $hotel_dsc_cond) ? $display_aberto : $display_fechado;
      $str_display_cod_acomodacao = ('bw' == $cod_acomodacao_cond) ? $display_aberto : $display_fechado;
      $str_display_acomodacao_dsc = ('bw' == $acomodacao_dsc_cond) ? $display_aberto : $display_fechado;
      $str_display_cod_categoria = ('bw' == $cod_categoria_cond) ? $display_aberto : $display_fechado;
      $str_display_categoria_dsc = ('bw' == $categoria_dsc_cond) ? $display_aberto : $display_fechado;
      $str_display_voo_ida = ('bw' == $voo_ida_cond) ? $display_aberto : $display_fechado;
      $str_display_cod_cia_ida = ('bw' == $cod_cia_ida_cond) ? $display_aberto : $display_fechado;
      $str_display_dt_checkin = ('bw' == $dt_checkin_cond) ? $display_aberto : $display_fechado;
      $str_display_hr_transferin = ('bw' == $hr_transferin_cond) ? $display_aberto : $display_fechado;
      $str_display_voo_volta = ('bw' == $voo_volta_cond) ? $display_aberto : $display_fechado;
      $str_display_cod_cia_volta = ('bw' == $cod_cia_volta_cond) ? $display_aberto : $display_fechado;
      $str_display_forma_pgto = ('bw' == $forma_pgto_cond) ? $display_aberto : $display_fechado;
      $str_display_dt_checkout = ('bw' == $dt_checkout_cond) ? $display_aberto : $display_fechado;
      $str_display_intervalo_trout = ('bw' == $intervalo_trout_cond) ? $display_aberto : $display_fechado;
      $str_display_hr_transferout = ('bw' == $hr_transferout_cond) ? $display_aberto : $display_fechado;
      $str_display_tipo_pessoa = ('bw' == $tipo_pessoa_cond) ? $display_aberto : $display_fechado;
      $str_display_tipo_transfer = ('bw' == $tipo_transfer_cond) ? $display_aberto : $display_fechado;

      if (!isset($hospede) || $hospede == "")
      {
          $hospede = "";
      }
      if (isset($hospede) && !empty($hospede))
      {
         $tmp_pos = (is_string($hospede)) ? strpos($hospede, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $hospede = substr($hospede, 0, $tmp_pos);
         }
      }
      if (!isset($cpf) || $cpf == "")
      {
          $cpf = "";
      }
      if (isset($cpf) && !empty($cpf))
      {
         $tmp_pos = (is_string($cpf)) ? strpos($cpf, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $cpf = substr($cpf, 0, $tmp_pos);
         }
      }
      if (!isset($passaporte) || $passaporte == "")
      {
          $passaporte = "";
      }
      if (isset($passaporte) && !empty($passaporte))
      {
         $tmp_pos = (is_string($passaporte)) ? strpos($passaporte, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $passaporte = substr($passaporte, 0, $tmp_pos);
         }
      }
      if (!isset($cod_publico) || $cod_publico == "")
      {
          $cod_publico = "";
      }
      if (isset($cod_publico) && !empty($cod_publico))
      {
         $tmp_pos = (is_string($cod_publico)) ? strpos($cod_publico, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $cod_publico = substr($cod_publico, 0, $tmp_pos);
         }
      }
      if (!isset($publico_dsc) || $publico_dsc == "")
      {
          $publico_dsc = "";
      }
      if (isset($publico_dsc) && !empty($publico_dsc))
      {
         $tmp_pos = (is_string($publico_dsc)) ? strpos($publico_dsc, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $publico_dsc = substr($publico_dsc, 0, $tmp_pos);
         }
      }
      if (!isset($cod_hotel) || $cod_hotel == "")
      {
          $cod_hotel = "";
      }
      if (isset($cod_hotel) && !empty($cod_hotel))
      {
         $tmp_pos = (is_string($cod_hotel)) ? strpos($cod_hotel, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $cod_hotel = substr($cod_hotel, 0, $tmp_pos);
         }
      }
      if (!isset($hotel_dsc) || $hotel_dsc == "")
      {
          $hotel_dsc = "";
      }
      if (isset($hotel_dsc) && !empty($hotel_dsc))
      {
         $tmp_pos = (is_string($hotel_dsc)) ? strpos($hotel_dsc, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $hotel_dsc = substr($hotel_dsc, 0, $tmp_pos);
         }
      }
      if (!isset($cod_acomodacao) || $cod_acomodacao == "")
      {
          $cod_acomodacao = "";
      }
      if (isset($cod_acomodacao) && !empty($cod_acomodacao))
      {
         $tmp_pos = (is_string($cod_acomodacao)) ? strpos($cod_acomodacao, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $cod_acomodacao = substr($cod_acomodacao, 0, $tmp_pos);
         }
      }
      if (!isset($acomodacao_dsc) || $acomodacao_dsc == "")
      {
          $acomodacao_dsc = "";
      }
      if (isset($acomodacao_dsc) && !empty($acomodacao_dsc))
      {
         $tmp_pos = (is_string($acomodacao_dsc)) ? strpos($acomodacao_dsc, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $acomodacao_dsc = substr($acomodacao_dsc, 0, $tmp_pos);
         }
      }
      if (!isset($cod_categoria) || $cod_categoria == "")
      {
          $cod_categoria = "";
      }
      if (isset($cod_categoria) && !empty($cod_categoria))
      {
         $tmp_pos = (is_string($cod_categoria)) ? strpos($cod_categoria, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $cod_categoria = substr($cod_categoria, 0, $tmp_pos);
         }
      }
      if (!isset($categoria_dsc) || $categoria_dsc == "")
      {
          $categoria_dsc = "";
      }
      if (isset($categoria_dsc) && !empty($categoria_dsc))
      {
         $tmp_pos = (is_string($categoria_dsc)) ? strpos($categoria_dsc, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $categoria_dsc = substr($categoria_dsc, 0, $tmp_pos);
         }
      }
      if (!isset($voo_ida) || $voo_ida == "")
      {
          $voo_ida = "";
      }
      if (isset($voo_ida) && !empty($voo_ida))
      {
         $tmp_pos = (is_string($voo_ida)) ? strpos($voo_ida, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $voo_ida = substr($voo_ida, 0, $tmp_pos);
         }
      }
      if (!isset($cod_cia_ida) || $cod_cia_ida == "")
      {
          $cod_cia_ida = "";
      }
      if (isset($cod_cia_ida) && !empty($cod_cia_ida))
      {
         $tmp_pos = (is_string($cod_cia_ida)) ? strpos($cod_cia_ida, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $cod_cia_ida = substr($cod_cia_ida, 0, $tmp_pos);
         }
      }
      if (!isset($dt_checkin) || $dt_checkin == "")
      {
          $dt_checkin = "";
      }
      if (isset($dt_checkin) && !empty($dt_checkin))
      {
         $tmp_pos = (is_string($dt_checkin)) ? strpos($dt_checkin, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $dt_checkin = substr($dt_checkin, 0, $tmp_pos);
         }
      }
      if (!isset($hr_transferin) || $hr_transferin == "")
      {
          $hr_transferin = "";
      }
      if (isset($hr_transferin) && !empty($hr_transferin))
      {
         $tmp_pos = (is_string($hr_transferin)) ? strpos($hr_transferin, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $hr_transferin = substr($hr_transferin, 0, $tmp_pos);
         }
      }
      if (!isset($voo_volta) || $voo_volta == "")
      {
          $voo_volta = "";
      }
      if (isset($voo_volta) && !empty($voo_volta))
      {
         $tmp_pos = (is_string($voo_volta)) ? strpos($voo_volta, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $voo_volta = substr($voo_volta, 0, $tmp_pos);
         }
      }
      if (!isset($cod_cia_volta) || $cod_cia_volta == "")
      {
          $cod_cia_volta = "";
      }
      if (isset($cod_cia_volta) && !empty($cod_cia_volta))
      {
         $tmp_pos = (is_string($cod_cia_volta)) ? strpos($cod_cia_volta, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $cod_cia_volta = substr($cod_cia_volta, 0, $tmp_pos);
         }
      }
      if (!isset($forma_pgto) || $forma_pgto == "")
      {
          $forma_pgto = "";
      }
      if (isset($forma_pgto) && !empty($forma_pgto))
      {
         $tmp_pos = (is_string($forma_pgto)) ? strpos($forma_pgto, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $forma_pgto = substr($forma_pgto, 0, $tmp_pos);
         }
      }
      if (!isset($dt_checkout) || $dt_checkout == "")
      {
          $dt_checkout = "";
      }
      if (isset($dt_checkout) && !empty($dt_checkout))
      {
         $tmp_pos = (is_string($dt_checkout)) ? strpos($dt_checkout, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $dt_checkout = substr($dt_checkout, 0, $tmp_pos);
         }
      }
      if (!isset($intervalo_trout) || $intervalo_trout == "")
      {
          $intervalo_trout = "";
      }
      if (isset($intervalo_trout) && !empty($intervalo_trout))
      {
         $tmp_pos = (is_string($intervalo_trout)) ? strpos($intervalo_trout, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $intervalo_trout = substr($intervalo_trout, 0, $tmp_pos);
         }
      }
      if (!isset($hr_transferout) || $hr_transferout == "")
      {
          $hr_transferout = "";
      }
      if (isset($hr_transferout) && !empty($hr_transferout))
      {
         $tmp_pos = (is_string($hr_transferout)) ? strpos($hr_transferout, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $hr_transferout = substr($hr_transferout, 0, $tmp_pos);
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
      if (!isset($tipo_transfer) || $tipo_transfer == "")
      {
          $tipo_transfer = "";
      }
      if (isset($tipo_transfer) && !empty($tipo_transfer))
      {
         $tmp_pos = (is_string($tipo_transfer)) ? strpos($tipo_transfer, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $tipo_transfer = substr($tipo_transfer, 0, $tmp_pos);
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
   if (is_file("grid_roomlist_rsvp_rm_help.txt"))
   {
      $Arq_WebHelp = file("grid_roomlist_rsvp_rm_help.txt"); 
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
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_roomlist_rsvp_rm']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_roomlist_rsvp_rm']['start'] == 'filter' && $nm_apl_dependente != 1)
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
 $SC_Label = (isset($this->New_label['hospede'])) ? $this->New_label['hospede'] : "Hóspede";
 $nmgp_tab_label .= "hospede?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_hospede_cond" name="hospede_cond" onChange="nm_campos_between(document.getElementById('id_vis_hospede'), this, 'hospede')">
       <OPTION value="qp" <?php if ("qp" == $hospede_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $hospede_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $hospede_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $hospede_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_hospede"  <?php echo $str_hide_hospede?>><?php
      if ($hospede != "")
      {
      $hospede_look = (is_string($hospede) ? substr($this->Db->qstr($hospede), 1, -1) : $hospede); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct hospede from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#hospede#lowerF# = #lowerI#'$hospede_look'#lowerF# order by hospede"; 
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
      if (isset($nmgp_def_dados[0][$hospede]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$hospede];
      }
      else
      {
          $sAutocompValue = $hospede;
      }
?>
<INPUT  type="text" id="SC_hospede" name="hospede" value="<?php echo NM_encode_input($hospede) ?>"  size=50 alt="{datatype: 'text', maxLength: 100, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_hospede" name="hospede_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 100, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['cpf'])) ? $this->New_label['cpf'] : "CPF";
 $nmgp_tab_label .= "cpf?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelEven scFilterLabelAboveEven"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectEven" id="SC_cpf_cond" name="cpf_cond" onChange="nm_campos_between(document.getElementById('id_vis_cpf'), this, 'cpf')">
       <OPTION value="qp" <?php if ("qp" == $cpf_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $cpf_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $cpf_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $cpf_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_cpf"  <?php echo $str_hide_cpf?>><?php
      if ($cpf != "")
      {
      $cpf_look = (is_string($cpf) ? substr($this->Db->qstr($cpf), 1, -1) : $cpf); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct cpf from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#cpf#lowerF# = #lowerI#'$cpf_look'#lowerF# order by cpf"; 
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
      if (isset($nmgp_def_dados[0][$cpf]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$cpf];
      }
      else
      {
          $sAutocompValue = $cpf;
      }
?>
<INPUT  type="text" id="SC_cpf" name="cpf" value="<?php echo NM_encode_input($cpf) ?>"  size=13 alt="{datatype: 'text', maxLength: 13, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_cpf" name="cpf_autocomp" size="13"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 13, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['passaporte'])) ? $this->New_label['passaporte'] : "Passaporte";
 $nmgp_tab_label .= "passaporte?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_passaporte_cond" name="passaporte_cond" onChange="nm_campos_between(document.getElementById('id_vis_passaporte'), this, 'passaporte')">
       <OPTION value="qp" <?php if ("qp" == $passaporte_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $passaporte_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $passaporte_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $passaporte_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_passaporte"  <?php echo $str_hide_passaporte?>><?php
      if ($passaporte != "")
      {
      $passaporte_look = (is_string($passaporte) ? substr($this->Db->qstr($passaporte), 1, -1) : $passaporte); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct passaporte from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#passaporte#lowerF# = #lowerI#'$passaporte_look'#lowerF# order by passaporte"; 
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
      if (isset($nmgp_def_dados[0][$passaporte]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$passaporte];
      }
      else
      {
          $sAutocompValue = $passaporte;
      }
?>
<INPUT  type="text" id="SC_passaporte" name="passaporte" value="<?php echo NM_encode_input($passaporte) ?>"  size=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_passaporte" name="passaporte_autocomp" size="20"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['cod_publico'])) ? $this->New_label['cod_publico'] : "Cod. Publico";
 $nmgp_tab_label .= "cod_publico?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelEven scFilterLabelAboveEven"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectEven" id="SC_cod_publico_cond" name="cod_publico_cond" onChange="nm_campos_between(document.getElementById('id_vis_cod_publico'), this, 'cod_publico')">
       <OPTION value="gt" <?php if ("gt" == $cod_publico_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $cod_publico_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $cod_publico_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_cod_publico"  <?php echo $str_hide_cod_publico?>><INPUT  type="text" id="SC_cod_publico" name="cod_publico" value="<?php echo NM_encode_input($cod_publico) ?>" size=11 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" class="sc-js-input scFilterObjectEven">
 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['publico_dsc'])) ? $this->New_label['publico_dsc'] : "Público";
 $nmgp_tab_label .= "publico_dsc?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_publico_dsc_cond" name="publico_dsc_cond" onChange="nm_campos_between(document.getElementById('id_vis_publico_dsc'), this, 'publico_dsc')">
       <OPTION value="qp" <?php if ("qp" == $publico_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $publico_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $publico_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $publico_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_publico_dsc"  <?php echo $str_hide_publico_dsc?>><?php
      if ($publico_dsc != "")
      {
      $publico_dsc_look = (is_string($publico_dsc) ? substr($this->Db->qstr($publico_dsc), 1, -1) : $publico_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct publico_dsc from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#publico_dsc#lowerF# = #lowerI#'$publico_dsc_look'#lowerF# order by publico_dsc"; 
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
      if (isset($nmgp_def_dados[0][$publico_dsc]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$publico_dsc];
      }
      else
      {
          $sAutocompValue = $publico_dsc;
      }
?>
<INPUT  type="text" id="SC_publico_dsc" name="publico_dsc" value="<?php echo NM_encode_input($publico_dsc) ?>"  size=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_publico_dsc" name="publico_dsc_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 50, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['cod_hotel'])) ? $this->New_label['cod_hotel'] : "Cod Hotel";
 $nmgp_tab_label .= "cod_hotel?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelEven scFilterLabelAboveEven"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectEven" id="SC_cod_hotel_cond" name="cod_hotel_cond" onChange="nm_campos_between(document.getElementById('id_vis_cod_hotel'), this, 'cod_hotel')">
       <OPTION value="gt" <?php if ("gt" == $cod_hotel_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $cod_hotel_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $cod_hotel_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_cod_hotel"  <?php echo $str_hide_cod_hotel?>><INPUT  type="text" id="SC_cod_hotel" name="cod_hotel" value="<?php echo NM_encode_input($cod_hotel) ?>" size=11 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" class="sc-js-input scFilterObjectEven">
 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['hotel_dsc'])) ? $this->New_label['hotel_dsc'] : "Hotel";
 $nmgp_tab_label .= "hotel_dsc?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_hotel_dsc_cond" name="hotel_dsc_cond" onChange="nm_campos_between(document.getElementById('id_vis_hotel_dsc'), this, 'hotel_dsc')">
       <OPTION value="qp" <?php if ("qp" == $hotel_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $hotel_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $hotel_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $hotel_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_hotel_dsc"  <?php echo $str_hide_hotel_dsc?>><?php
      if ($hotel_dsc != "")
      {
      $hotel_dsc_look = (is_string($hotel_dsc) ? substr($this->Db->qstr($hotel_dsc), 1, -1) : $hotel_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct hotel_dsc from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#hotel_dsc#lowerF# = #lowerI#'$hotel_dsc_look'#lowerF# order by hotel_dsc"; 
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
      if (isset($nmgp_def_dados[0][$hotel_dsc]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$hotel_dsc];
      }
      else
      {
          $sAutocompValue = $hotel_dsc;
      }
?>
<INPUT  type="text" id="SC_hotel_dsc" name="hotel_dsc" value="<?php echo NM_encode_input($hotel_dsc) ?>"  size=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_hotel_dsc" name="hotel_dsc_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 50, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['cod_acomodacao'])) ? $this->New_label['cod_acomodacao'] : "cod_acomodacao";
 $nmgp_tab_label .= "cod_acomodacao?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelEven scFilterLabelAboveEven"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectEven" id="SC_cod_acomodacao_cond" name="cod_acomodacao_cond" onChange="nm_campos_between(document.getElementById('id_vis_cod_acomodacao'), this, 'cod_acomodacao')">
       <OPTION value="gt" <?php if ("gt" == $cod_acomodacao_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $cod_acomodacao_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $cod_acomodacao_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_cod_acomodacao"  <?php echo $str_hide_cod_acomodacao?>><INPUT  type="text" id="SC_cod_acomodacao" name="cod_acomodacao" value="<?php echo NM_encode_input($cod_acomodacao) ?>" size=11 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" class="sc-js-input scFilterObjectEven">
 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['acomodacao_dsc'])) ? $this->New_label['acomodacao_dsc'] : "Acomodação";
 $nmgp_tab_label .= "acomodacao_dsc?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_acomodacao_dsc_cond" name="acomodacao_dsc_cond" onChange="nm_campos_between(document.getElementById('id_vis_acomodacao_dsc'), this, 'acomodacao_dsc')">
       <OPTION value="qp" <?php if ("qp" == $acomodacao_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $acomodacao_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $acomodacao_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $acomodacao_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_acomodacao_dsc"  <?php echo $str_hide_acomodacao_dsc?>><?php
      if ($acomodacao_dsc != "")
      {
      $acomodacao_dsc_look = (is_string($acomodacao_dsc) ? substr($this->Db->qstr($acomodacao_dsc), 1, -1) : $acomodacao_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct acomodacao_dsc from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#acomodacao_dsc#lowerF# = #lowerI#'$acomodacao_dsc_look'#lowerF# order by acomodacao_dsc"; 
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
      if (isset($nmgp_def_dados[0][$acomodacao_dsc]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$acomodacao_dsc];
      }
      else
      {
          $sAutocompValue = $acomodacao_dsc;
      }
?>
<INPUT  type="text" id="SC_acomodacao_dsc" name="acomodacao_dsc" value="<?php echo NM_encode_input($acomodacao_dsc) ?>"  size=50 alt="{datatype: 'text', maxLength: 60, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_acomodacao_dsc" name="acomodacao_dsc_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 60, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['cod_categoria'])) ? $this->New_label['cod_categoria'] : "Cod Categoria";
 $nmgp_tab_label .= "cod_categoria?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelEven scFilterLabelAboveEven"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectEven" id="SC_cod_categoria_cond" name="cod_categoria_cond" onChange="nm_campos_between(document.getElementById('id_vis_cod_categoria'), this, 'cod_categoria')">
       <OPTION value="gt" <?php if ("gt" == $cod_categoria_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $cod_categoria_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $cod_categoria_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_cod_categoria"  <?php echo $str_hide_cod_categoria?>><INPUT  type="text" id="SC_cod_categoria" name="cod_categoria" value="<?php echo NM_encode_input($cod_categoria) ?>" size=11 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" class="sc-js-input scFilterObjectEven">
 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['categoria_dsc'])) ? $this->New_label['categoria_dsc'] : "Categoria";
 $nmgp_tab_label .= "categoria_dsc?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_categoria_dsc_cond" name="categoria_dsc_cond" onChange="nm_campos_between(document.getElementById('id_vis_categoria_dsc'), this, 'categoria_dsc')">
       <OPTION value="qp" <?php if ("qp" == $categoria_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $categoria_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $categoria_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $categoria_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_categoria_dsc"  <?php echo $str_hide_categoria_dsc?>><?php
      if ($categoria_dsc != "")
      {
      $categoria_dsc_look = (is_string($categoria_dsc) ? substr($this->Db->qstr($categoria_dsc), 1, -1) : $categoria_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct categoria_dsc from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#categoria_dsc#lowerF# = #lowerI#'$categoria_dsc_look'#lowerF# order by categoria_dsc"; 
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
      if (isset($nmgp_def_dados[0][$categoria_dsc]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$categoria_dsc];
      }
      else
      {
          $sAutocompValue = $categoria_dsc;
      }
?>
<INPUT  type="text" id="SC_categoria_dsc" name="categoria_dsc" value="<?php echo NM_encode_input($categoria_dsc) ?>"  size=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_categoria_dsc" name="categoria_dsc_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 50, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['voo_ida'])) ? $this->New_label['voo_ida'] : "Voo Ida";
 $nmgp_tab_label .= "voo_ida?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelEven scFilterLabelAboveEven"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectEven" id="SC_voo_ida_cond" name="voo_ida_cond" onChange="nm_campos_between(document.getElementById('id_vis_voo_ida'), this, 'voo_ida')">
       <OPTION value="qp" <?php if ("qp" == $voo_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $voo_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $voo_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $voo_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_voo_ida"  <?php echo $str_hide_voo_ida?>><?php
      if ($voo_ida != "")
      {
      $voo_ida_look = (is_string($voo_ida) ? substr($this->Db->qstr($voo_ida), 1, -1) : $voo_ida); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct voo_ida from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#voo_ida#lowerF# = #lowerI#'$voo_ida_look'#lowerF# order by voo_ida"; 
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
      if (isset($nmgp_def_dados[0][$voo_ida]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$voo_ida];
      }
      else
      {
          $sAutocompValue = $voo_ida;
      }
?>
<INPUT  type="text" id="SC_voo_ida" name="voo_ida" value="<?php echo NM_encode_input($voo_ida) ?>"  size=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_voo_ida" name="voo_ida_autocomp" size="20"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['cod_cia_ida'])) ? $this->New_label['cod_cia_ida'] : "Cia. Aérea Ida";
 $nmgp_tab_label .= "cod_cia_ida?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_cod_cia_ida_cond" name="cod_cia_ida_cond" onChange="nm_campos_between(document.getElementById('id_vis_cod_cia_ida'), this, 'cod_cia_ida')">
       <OPTION value="gt" <?php if ("gt" == $cod_cia_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $cod_cia_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $cod_cia_ida_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_cod_cia_ida"  <?php echo $str_hide_cod_cia_ida?>><INPUT  type="text" id="SC_cod_cia_ida" name="cod_cia_ida" value="<?php echo NM_encode_input($cod_cia_ida) ?>" size=11 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" class="sc-js-input scFilterObjectOdd">
 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['dt_checkin'])) ? $this->New_label['dt_checkin'] : "CheckIn";
 $nmgp_tab_label .= "dt_checkin?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelEven scFilterLabelAboveEven"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectEven" id="SC_dt_checkin_cond" name="dt_checkin_cond" onChange="nm_campos_between(document.getElementById('id_vis_dt_checkin'), this, 'dt_checkin')">
       <OPTION value="eq" <?php if ("eq" == $dt_checkin_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="gt" <?php if ("gt" == $dt_checkin_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $dt_checkin_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $dt_checkin_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_dt_checkin"  <?php echo $str_hide_dt_checkin?>>
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
<span id='id_date_part_dt_checkin_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_dt_checkin_dia" name="dt_checkin_dia" value="<?php echo NM_encode_input($dt_checkin_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_dt_checkin_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_dt_checkin_mes" name="dt_checkin_mes" value="<?php echo NM_encode_input($dt_checkin_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_dt_checkin_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_dt_checkin_ano" name="dt_checkin_ano" value="<?php echo NM_encode_input($dt_checkin_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
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
        <SPAN id="id_css_dt_checkin"  class="scFilterFieldFontEven">
 <br><?php echo $date_format_show ?>         </SPAN>
                  <br />
        <SPAN id="id_vis_dt_checkin"  <?php echo $str_display_dt_checkin; ?> class="scFilterFieldFontEven">
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
<span id='id_date_part_dt_checkin_input_2_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_dt_checkin_input_2_dia" name="dt_checkin_input_2_dia" value="<?php echo NM_encode_input($dt_checkin_input_2_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_dt_checkin_input_2_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_dt_checkin_input_2_mes" name="dt_checkin_input_2_mes" value="<?php echo NM_encode_input($dt_checkin_input_2_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_dt_checkin_input_2_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_dt_checkin_input_2_ano" name="dt_checkin_input_2_ano" value="<?php echo NM_encode_input($dt_checkin_input_2_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
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
 $SC_Label = (isset($this->New_label['hr_transferin'])) ? $this->New_label['hr_transferin'] : "Transfer In";
 $nmgp_tab_label .= "hr_transferin?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_hr_transferin_cond" name="hr_transferin_cond" onChange="nm_campos_between(document.getElementById('id_vis_hr_transferin'), this, 'hr_transferin')">
       <OPTION value="eq" <?php if ("eq" == $hr_transferin_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ii" <?php if ("ii" == $hr_transferin_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_stts_with'] ?></OPTION>
       <OPTION value="qp" <?php if ("qp" == $hr_transferin_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="df" <?php if ("df" == $hr_transferin_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_dife'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_hr_transferin"  <?php echo $str_hide_hr_transferin?>>
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
<span id='id_date_part_hr_transferin_HH' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_hr_transferin_hor" name="hr_transferin_hor" value="<?php echo NM_encode_input($hr_transferin_hor); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_hr_transferin_II' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_hr_transferin_min" name="hr_transferin_min" value="<?php echo NM_encode_input($hr_transferin_min); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_hr_transferin_SS' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_hr_transferin_seg" name="hr_transferin_seg" value="<?php echo NM_encode_input($hr_transferin_seg); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
        <SPAN id="id_css_hr_transferin"  class="scFilterFieldFontOdd">
 <br><?php echo $date_format_show ?>         </SPAN>
          </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['voo_volta'])) ? $this->New_label['voo_volta'] : "Voo Volta";
 $nmgp_tab_label .= "voo_volta?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelEven scFilterLabelAboveEven"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectEven" id="SC_voo_volta_cond" name="voo_volta_cond" onChange="nm_campos_between(document.getElementById('id_vis_voo_volta'), this, 'voo_volta')">
       <OPTION value="qp" <?php if ("qp" == $voo_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $voo_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $voo_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $voo_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_voo_volta"  <?php echo $str_hide_voo_volta?>><?php
      if ($voo_volta != "")
      {
      $voo_volta_look = (is_string($voo_volta) ? substr($this->Db->qstr($voo_volta), 1, -1) : $voo_volta); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct voo_volta from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#voo_volta#lowerF# = #lowerI#'$voo_volta_look'#lowerF# order by voo_volta"; 
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
      if (isset($nmgp_def_dados[0][$voo_volta]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$voo_volta];
      }
      else
      {
          $sAutocompValue = $voo_volta;
      }
?>
<INPUT  type="text" id="SC_voo_volta" name="voo_volta" value="<?php echo NM_encode_input($voo_volta) ?>"  size=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_voo_volta" name="voo_volta_autocomp" size="20"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['cod_cia_volta'])) ? $this->New_label['cod_cia_volta'] : "Cod Cia Volta";
 $nmgp_tab_label .= "cod_cia_volta?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_cod_cia_volta_cond" name="cod_cia_volta_cond" onChange="nm_campos_between(document.getElementById('id_vis_cod_cia_volta'), this, 'cod_cia_volta')">
       <OPTION value="gt" <?php if ("gt" == $cod_cia_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $cod_cia_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $cod_cia_volta_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_cod_cia_volta"  <?php echo $str_hide_cod_cia_volta?>><INPUT  type="text" id="SC_cod_cia_volta" name="cod_cia_volta" value="<?php echo NM_encode_input($cod_cia_volta) ?>" size=11 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" class="sc-js-input scFilterObjectOdd">
 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['forma_pgto'])) ? $this->New_label['forma_pgto'] : "Forma Pgto";
 $nmgp_tab_label .= "forma_pgto?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelEven scFilterLabelAboveEven"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectEven" id="SC_forma_pgto_cond" name="forma_pgto_cond" onChange="nm_campos_between(document.getElementById('id_vis_forma_pgto'), this, 'forma_pgto')">
       <OPTION value="qp" <?php if ("qp" == $forma_pgto_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $forma_pgto_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $forma_pgto_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $forma_pgto_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_forma_pgto"  <?php echo $str_hide_forma_pgto?>><?php
      if ($forma_pgto != "")
      {
      $forma_pgto_look = (is_string($forma_pgto) ? substr($this->Db->qstr($forma_pgto), 1, -1) : $forma_pgto); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct forma_pgto from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#forma_pgto#lowerF# = #lowerI#'$forma_pgto_look'#lowerF# order by forma_pgto"; 
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
      if (isset($nmgp_def_dados[0][$forma_pgto]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$forma_pgto];
      }
      else
      {
          $sAutocompValue = $forma_pgto;
      }
?>
<INPUT  type="text" id="SC_forma_pgto" name="forma_pgto" value="<?php echo NM_encode_input($forma_pgto) ?>"  size=50 alt="{datatype: 'text', maxLength: 100, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_forma_pgto" name="forma_pgto_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 100, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['dt_checkout'])) ? $this->New_label['dt_checkout'] : "CheckOut";
 $nmgp_tab_label .= "dt_checkout?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_dt_checkout_cond" name="dt_checkout_cond" onChange="nm_campos_between(document.getElementById('id_vis_dt_checkout'), this, 'dt_checkout')">
       <OPTION value="eq" <?php if ("eq" == $dt_checkout_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="gt" <?php if ("gt" == $dt_checkout_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $dt_checkout_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $dt_checkout_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_dt_checkout"  <?php echo $str_hide_dt_checkout?>>
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
<span id='id_date_part_dt_checkout_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_dt_checkout_dia" name="dt_checkout_dia" value="<?php echo NM_encode_input($dt_checkout_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_dt_checkout_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_dt_checkout_mes" name="dt_checkout_mes" value="<?php echo NM_encode_input($dt_checkout_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_dt_checkout_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_dt_checkout_ano" name="dt_checkout_ano" value="<?php echo NM_encode_input($dt_checkout_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
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
        <SPAN id="id_css_dt_checkout"  class="scFilterFieldFontOdd">
 <br><?php echo $date_format_show ?>         </SPAN>
                  <br />
        <SPAN id="id_vis_dt_checkout"  <?php echo $str_display_dt_checkout; ?> class="scFilterFieldFontOdd">
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
<span id='id_date_part_dt_checkout_input_2_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_dt_checkout_input_2_dia" name="dt_checkout_input_2_dia" value="<?php echo NM_encode_input($dt_checkout_input_2_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_dt_checkout_input_2_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_dt_checkout_input_2_mes" name="dt_checkout_input_2_mes" value="<?php echo NM_encode_input($dt_checkout_input_2_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_dt_checkout_input_2_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_dt_checkout_input_2_ano" name="dt_checkout_input_2_ano" value="<?php echo NM_encode_input($dt_checkout_input_2_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
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
 $SC_Label = (isset($this->New_label['intervalo_trout'])) ? $this->New_label['intervalo_trout'] : "Intervalo Transf. Out";
 $nmgp_tab_label .= "intervalo_trout?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelEven scFilterLabelAboveEven"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectEven" id="SC_intervalo_trout_cond" name="intervalo_trout_cond" onChange="nm_campos_between(document.getElementById('id_vis_intervalo_trout'), this, 'intervalo_trout')">
       <OPTION value="eq" <?php if ("eq" == $intervalo_trout_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ii" <?php if ("ii" == $intervalo_trout_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_stts_with'] ?></OPTION>
       <OPTION value="qp" <?php if ("qp" == $intervalo_trout_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="df" <?php if ("df" == $intervalo_trout_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_dife'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_intervalo_trout"  <?php echo $str_hide_intervalo_trout?>>
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
<span id='id_date_part_intervalo_trout_HH' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_intervalo_trout_hor" name="intervalo_trout_hor" value="<?php echo NM_encode_input($intervalo_trout_hor); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_intervalo_trout_II' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_intervalo_trout_min" name="intervalo_trout_min" value="<?php echo NM_encode_input($intervalo_trout_min); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_intervalo_trout_SS' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_intervalo_trout_seg" name="intervalo_trout_seg" value="<?php echo NM_encode_input($intervalo_trout_seg); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
        <SPAN id="id_css_intervalo_trout"  class="scFilterFieldFontEven">
 <br><?php echo $date_format_show ?>         </SPAN>
          </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['hr_transferout'])) ? $this->New_label['hr_transferout'] : "Tranfer Out";
 $nmgp_tab_label .= "hr_transferout?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_hr_transferout_cond" name="hr_transferout_cond" onChange="nm_campos_between(document.getElementById('id_vis_hr_transferout'), this, 'hr_transferout')">
       <OPTION value="eq" <?php if ("eq" == $hr_transferout_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ii" <?php if ("ii" == $hr_transferout_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_stts_with'] ?></OPTION>
       <OPTION value="qp" <?php if ("qp" == $hr_transferout_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="df" <?php if ("df" == $hr_transferout_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_dife'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_hr_transferout"  <?php echo $str_hide_hr_transferout?>>
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
<span id='id_date_part_hr_transferout_HH' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_hr_transferout_hor" name="hr_transferout_hor" value="<?php echo NM_encode_input($hr_transferout_hor); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_hr_transferout_II' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_hr_transferout_min" name="hr_transferout_min" value="<?php echo NM_encode_input($hr_transferout_min); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_hr_transferout_SS' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_hr_transferout_seg" name="hr_transferout_seg" value="<?php echo NM_encode_input($hr_transferout_seg); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
        <SPAN id="id_css_hr_transferout"  class="scFilterFieldFontOdd">
 <br><?php echo $date_format_show ?>         </SPAN>
          </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldEven" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tipo_pessoa'])) ? $this->New_label['tipo_pessoa'] : "Tipo";
 $nmgp_tab_label .= "tipo_pessoa?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelEven scFilterLabelAboveEven"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectEven" id="SC_tipo_pessoa_cond" name="tipo_pessoa_cond" onChange="nm_campos_between(document.getElementById('id_vis_tipo_pessoa'), this, 'tipo_pessoa')">
       <OPTION value="qp" <?php if ("qp" == $tipo_pessoa_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $tipo_pessoa_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $tipo_pessoa_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $tipo_pessoa_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_tipo_pessoa"  <?php echo $str_hide_tipo_pessoa?>><?php
      if ($tipo_pessoa != "")
      {
      $tipo_pessoa_look = (is_string($tipo_pessoa) ? substr($this->Db->qstr($tipo_pessoa), 1, -1) : $tipo_pessoa); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tipo_pessoa from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#tipo_pessoa#lowerF# = #lowerI#'$tipo_pessoa_look'#lowerF# order by tipo_pessoa"; 
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
<INPUT  type="text" id="SC_tipo_pessoa" name="tipo_pessoa" value="<?php echo NM_encode_input($tipo_pessoa) ?>"  size=25 alt="{datatype: 'text', maxLength: 25, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_tipo_pessoa" name="tipo_pessoa_autocomp" size="25"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 25, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

 </TD>
   



   </tr><tr valign="top">



   
    <TD nowrap class="scFilterFieldOdd" style="vertical-align: top" > <?php
 $SC_Label = (isset($this->New_label['tipo_transfer'])) ? $this->New_label['tipo_transfer'] : "Tipo Transfer";
 $nmgp_tab_label .= "tipo_transfer?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<span class="scFilterLabelOdd scFilterLabelAboveOdd"><span class="SC_Field_label_Mob"><?php echo $SC_Label ?></span></span><br>
      <SELECT class="SC_Cond_Selector scFilterObjectOdd" id="SC_tipo_transfer_cond" name="tipo_transfer_cond" onChange="nm_campos_between(document.getElementById('id_vis_tipo_transfer'), this, 'tipo_transfer')">
       <OPTION value="qp" <?php if ("qp" == $tipo_transfer_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $tipo_transfer_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $tipo_transfer_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $tipo_transfer_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
      <br><span id="id_hide_tipo_transfer"  <?php echo $str_hide_tipo_transfer?>><?php
      if ($tipo_transfer != "")
      {
      $tipo_transfer_look = (is_string($tipo_transfer) ? substr($this->Db->qstr($tipo_transfer), 1, -1) : $tipo_transfer); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tipo_transfer from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#tipo_transfer#lowerF# = #lowerI#'$tipo_transfer_look'#lowerF# order by tipo_transfer"; 
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
      if (isset($nmgp_def_dados[0][$tipo_transfer]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$tipo_transfer];
      }
      else
      {
          $sAutocompValue = $tipo_transfer;
      }
?>
<INPUT  type="text" id="SC_tipo_transfer" name="tipo_transfer" value="<?php echo NM_encode_input($tipo_transfer) ?>"  size=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_tipo_transfer" name="tipo_transfer_autocomp" size="20"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">

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
    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['pesq_tab_label'] = $nmgp_tab_label;
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
   if (is_file("grid_roomlist_rsvp_rm_help.txt"))
   {
      $Arq_WebHelp = file("grid_roomlist_rsvp_rm_help.txt"); 
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
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_roomlist_rsvp_rm']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_roomlist_rsvp_rm']['start'] == 'filter' && $nm_apl_dependente != 1)
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
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_roomlist_rsvp_rm']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_roomlist_rsvp_rm']['start'] == 'filter')
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
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['orig_pesq']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['orig_pesq'] == "grid")
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
   document.F1.hospede_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_hospede'), document.F1.hospede_cond, 'hospede', opc_clear);
   document.F1.hospede.value = "";
   document.F1.hospede_autocomp.value = "";
   document.F1.cpf_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_cpf'), document.F1.cpf_cond, 'cpf', opc_clear);
   document.F1.cpf.value = "";
   document.F1.cpf_autocomp.value = "";
   document.F1.passaporte_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_passaporte'), document.F1.passaporte_cond, 'passaporte', opc_clear);
   document.F1.passaporte.value = "";
   document.F1.passaporte_autocomp.value = "";
   document.F1.cod_publico_cond.value = 'gt';
   nm_campos_between(document.getElementById('id_vis_cod_publico'), document.F1.cod_publico_cond, 'cod_publico', opc_clear);
   document.F1.cod_publico.value = "";
   document.F1.publico_dsc_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_publico_dsc'), document.F1.publico_dsc_cond, 'publico_dsc', opc_clear);
   document.F1.publico_dsc.value = "";
   document.F1.publico_dsc_autocomp.value = "";
   document.F1.cod_hotel_cond.value = 'gt';
   nm_campos_between(document.getElementById('id_vis_cod_hotel'), document.F1.cod_hotel_cond, 'cod_hotel', opc_clear);
   document.F1.cod_hotel.value = "";
   document.F1.hotel_dsc_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_hotel_dsc'), document.F1.hotel_dsc_cond, 'hotel_dsc', opc_clear);
   document.F1.hotel_dsc.value = "";
   document.F1.hotel_dsc_autocomp.value = "";
   document.F1.cod_acomodacao_cond.value = 'gt';
   nm_campos_between(document.getElementById('id_vis_cod_acomodacao'), document.F1.cod_acomodacao_cond, 'cod_acomodacao', opc_clear);
   document.F1.cod_acomodacao.value = "";
   document.F1.acomodacao_dsc_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_acomodacao_dsc'), document.F1.acomodacao_dsc_cond, 'acomodacao_dsc', opc_clear);
   document.F1.acomodacao_dsc.value = "";
   document.F1.acomodacao_dsc_autocomp.value = "";
   document.F1.cod_categoria_cond.value = 'gt';
   nm_campos_between(document.getElementById('id_vis_cod_categoria'), document.F1.cod_categoria_cond, 'cod_categoria', opc_clear);
   document.F1.cod_categoria.value = "";
   document.F1.categoria_dsc_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_categoria_dsc'), document.F1.categoria_dsc_cond, 'categoria_dsc', opc_clear);
   document.F1.categoria_dsc.value = "";
   document.F1.categoria_dsc_autocomp.value = "";
   document.F1.voo_ida_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_voo_ida'), document.F1.voo_ida_cond, 'voo_ida', opc_clear);
   document.F1.voo_ida.value = "";
   document.F1.voo_ida_autocomp.value = "";
   document.F1.cod_cia_ida_cond.value = 'gt';
   nm_campos_between(document.getElementById('id_vis_cod_cia_ida'), document.F1.cod_cia_ida_cond, 'cod_cia_ida', opc_clear);
   document.F1.cod_cia_ida.value = "";
   document.F1.dt_checkin_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_dt_checkin'), document.F1.dt_checkin_cond, 'dt_checkin', opc_clear);
   document.F1.dt_checkin_dia.value = "";
   document.F1.dt_checkin_mes.value = "";
   document.F1.dt_checkin_ano.value = "";
   document.F1.dt_checkin_input_2_dia.value = "";
   document.F1.dt_checkin_input_2_mes.value = "";
   document.F1.dt_checkin_input_2_ano.value = "";
   document.F1.hr_transferin_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_hr_transferin'), document.F1.hr_transferin_cond, 'hr_transferin', opc_clear);
   document.F1.hr_transferin_hor.value = "";
   document.F1.hr_transferin_min.value = "";
   document.F1.hr_transferin_seg.value = "";
   document.F1.voo_volta_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_voo_volta'), document.F1.voo_volta_cond, 'voo_volta', opc_clear);
   document.F1.voo_volta.value = "";
   document.F1.voo_volta_autocomp.value = "";
   document.F1.cod_cia_volta_cond.value = 'gt';
   nm_campos_between(document.getElementById('id_vis_cod_cia_volta'), document.F1.cod_cia_volta_cond, 'cod_cia_volta', opc_clear);
   document.F1.cod_cia_volta.value = "";
   document.F1.forma_pgto_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_forma_pgto'), document.F1.forma_pgto_cond, 'forma_pgto', opc_clear);
   document.F1.forma_pgto.value = "";
   document.F1.forma_pgto_autocomp.value = "";
   document.F1.dt_checkout_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_dt_checkout'), document.F1.dt_checkout_cond, 'dt_checkout', opc_clear);
   document.F1.dt_checkout_dia.value = "";
   document.F1.dt_checkout_mes.value = "";
   document.F1.dt_checkout_ano.value = "";
   document.F1.dt_checkout_input_2_dia.value = "";
   document.F1.dt_checkout_input_2_mes.value = "";
   document.F1.dt_checkout_input_2_ano.value = "";
   document.F1.intervalo_trout_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_intervalo_trout'), document.F1.intervalo_trout_cond, 'intervalo_trout', opc_clear);
   document.F1.intervalo_trout_hor.value = "";
   document.F1.intervalo_trout_min.value = "";
   document.F1.intervalo_trout_seg.value = "";
   document.F1.hr_transferout_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_hr_transferout'), document.F1.hr_transferout_cond, 'hr_transferout', opc_clear);
   document.F1.hr_transferout_hor.value = "";
   document.F1.hr_transferout_min.value = "";
   document.F1.hr_transferout_seg.value = "";
   document.F1.tipo_pessoa_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_tipo_pessoa'), document.F1.tipo_pessoa_cond, 'tipo_pessoa', opc_clear);
   document.F1.tipo_pessoa.value = "";
   document.F1.tipo_pessoa_autocomp.value = "";
   document.F1.tipo_transfer_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_tipo_transfer'), document.F1.tipo_transfer_cond, 'tipo_transfer', opc_clear);
   document.F1.tipo_transfer.value = "";
   document.F1.tipo_transfer_autocomp.value = "";
 }
 function SC_carga_evt_jquery()
 {
    $('#SC_dt_checkin_dia').bind('change', function() {sc_grid_roomlist_rsvp_rm_valida_dia(this)});
    $('#SC_dt_checkin_input_2_dia').bind('change', function() {sc_grid_roomlist_rsvp_rm_valida_dia(this)});
    $('#SC_dt_checkin_input_2_mes').bind('change', function() {sc_grid_roomlist_rsvp_rm_valida_mes(this)});
    $('#SC_dt_checkin_mes').bind('change', function() {sc_grid_roomlist_rsvp_rm_valida_mes(this)});
    $('#SC_dt_checkout_dia').bind('change', function() {sc_grid_roomlist_rsvp_rm_valida_dia(this)});
    $('#SC_dt_checkout_input_2_dia').bind('change', function() {sc_grid_roomlist_rsvp_rm_valida_dia(this)});
    $('#SC_dt_checkout_input_2_mes').bind('change', function() {sc_grid_roomlist_rsvp_rm_valida_mes(this)});
    $('#SC_dt_checkout_mes').bind('change', function() {sc_grid_roomlist_rsvp_rm_valida_mes(this)});
    $('#SC_hr_transferin_hor').bind('change', function() {sc_grid_roomlist_rsvp_rm_valida_hora(this)});
    $('#SC_hr_transferin_min').bind('change', function() {sc_grid_roomlist_rsvp_rm_valida_min(this)});
    $('#SC_hr_transferin_seg').bind('change', function() {sc_grid_roomlist_rsvp_rm_valida_seg(this)});
    $('#SC_hr_transferout_hor').bind('change', function() {sc_grid_roomlist_rsvp_rm_valida_hora(this)});
    $('#SC_hr_transferout_min').bind('change', function() {sc_grid_roomlist_rsvp_rm_valida_min(this)});
    $('#SC_hr_transferout_seg').bind('change', function() {sc_grid_roomlist_rsvp_rm_valida_seg(this)});
    $('#SC_intervalo_trout_hor').bind('change', function() {sc_grid_roomlist_rsvp_rm_valida_hora(this)});
    $('#SC_intervalo_trout_min').bind('change', function() {sc_grid_roomlist_rsvp_rm_valida_min(this)});
    $('#SC_intervalo_trout_seg').bind('change', function() {sc_grid_roomlist_rsvp_rm_valida_seg(this)});
 }
 function sc_grid_roomlist_rsvp_rm_valida_dia(obj)
 {
     if (obj.value != "" && (obj.value < 1 || obj.value > 31))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_iday'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { $(document.activeElement).focus(); obj.focus(); }, 10);
         }
     }
 }
 function sc_grid_roomlist_rsvp_rm_valida_mes(obj)
 {
     if (obj.value != "" && (obj.value < 1 || obj.value > 12))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_mnth'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { $(document.activeElement).focus(); obj.focus(); }, 10);
         }
     }
 }
 function sc_grid_roomlist_rsvp_rm_valida_hora(obj)
 {
     if (obj.value != "" && (obj.value < 0 || obj.value > 23))
     {
         if (confirm (Nm_erro['lang_jscr_ivtm'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { $(document.activeElement).focus(); obj.focus(); }, 10);
         }
     }
 }
 function sc_grid_roomlist_rsvp_rm_valida_min(obj)
 {
     if (obj.value != "" && (obj.value < 0 || obj.value > 59))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_mint'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { $(document.activeElement).focus(); obj.focus(); }, 10);
         }
     }
 }
 function sc_grid_roomlist_rsvp_rm_valida_seg(obj)
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
       $NM_patch   = "NRSVP115_10_AWS_APP/grid_roomlist_rsvp_rm";
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
          $nmgp_tab_label = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['pesq_tab_label'];
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
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_orig']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_orig'] = "";
      }
      $this->init_comando();
      $this->NM_operador     = (isset($NM_operador) && ("and" == strtolower($NM_operador) || "or" == strtolower($NM_operador))) ? $NM_operador : "and";
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq'] = array();
   }

   function init_comando()
   {
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['cond_pesq'] = "";
      if ($this->NM_ajax_flag && ($this->NM_ajax_opcao == "ajax_grid_search" || $this->NM_ajax_opcao == "ajax_grid_search_change_fil"))
      {
          $this->comando = "";
      }
      else
      {
          $this->comando = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_orig'];
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
          $NM_patch .= "grid_roomlist_rsvp_rm/";
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
      $tp_fields['SC_hospede_cond'] = 'cond';
      $tp_fields['SC_hospede'] = 'text_aut';
      $tp_fields['id_ac_hospede'] = 'text_aut';
      $tp_fields['SC_cpf_cond'] = 'cond';
      $tp_fields['SC_cpf'] = 'text_aut';
      $tp_fields['id_ac_cpf'] = 'text_aut';
      $tp_fields['SC_passaporte_cond'] = 'cond';
      $tp_fields['SC_passaporte'] = 'text_aut';
      $tp_fields['id_ac_passaporte'] = 'text_aut';
      $tp_fields['SC_cod_publico_cond'] = 'cond';
      $tp_fields['SC_cod_publico'] = 'text';
      $tp_fields['SC_publico_dsc_cond'] = 'cond';
      $tp_fields['SC_publico_dsc'] = 'text_aut';
      $tp_fields['id_ac_publico_dsc'] = 'text_aut';
      $tp_fields['SC_cod_hotel_cond'] = 'cond';
      $tp_fields['SC_cod_hotel'] = 'text';
      $tp_fields['SC_hotel_dsc_cond'] = 'cond';
      $tp_fields['SC_hotel_dsc'] = 'text_aut';
      $tp_fields['id_ac_hotel_dsc'] = 'text_aut';
      $tp_fields['SC_cod_acomodacao_cond'] = 'cond';
      $tp_fields['SC_cod_acomodacao'] = 'text';
      $tp_fields['SC_acomodacao_dsc_cond'] = 'cond';
      $tp_fields['SC_acomodacao_dsc'] = 'text_aut';
      $tp_fields['id_ac_acomodacao_dsc'] = 'text_aut';
      $tp_fields['SC_cod_categoria_cond'] = 'cond';
      $tp_fields['SC_cod_categoria'] = 'text';
      $tp_fields['SC_categoria_dsc_cond'] = 'cond';
      $tp_fields['SC_categoria_dsc'] = 'text_aut';
      $tp_fields['id_ac_categoria_dsc'] = 'text_aut';
      $tp_fields['SC_voo_ida_cond'] = 'cond';
      $tp_fields['SC_voo_ida'] = 'text_aut';
      $tp_fields['id_ac_voo_ida'] = 'text_aut';
      $tp_fields['SC_cod_cia_ida_cond'] = 'cond';
      $tp_fields['SC_cod_cia_ida'] = 'text';
      $tp_fields['SC_dt_checkin_cond'] = 'cond';
      $tp_fields['SC_dt_checkin_dia'] = 'text';
      $tp_fields['SC_dt_checkin_mes'] = 'text';
      $tp_fields['SC_dt_checkin_ano'] = 'text';
      $tp_fields['SC_dt_checkin_input_2_dia'] = 'text';
      $tp_fields['SC_dt_checkin_input_2_mes'] = 'text';
      $tp_fields['SC_dt_checkin_input_2_ano'] = 'text';
      $tp_fields['SC_hr_transferin_cond'] = 'cond';
      $tp_fields['SC_hr_transferin_hor'] = 'text';
      $tp_fields['SC_hr_transferin_min'] = 'text';
      $tp_fields['SC_hr_transferin_seg'] = 'text';
      $tp_fields['SC_hr_transferin_input_2_hor'] = 'text';
      $tp_fields['SC_hr_transferin_input_2_min'] = 'text';
      $tp_fields['SC_hr_transferin_input_2_seg'] = 'text';
      $tp_fields['SC_voo_volta_cond'] = 'cond';
      $tp_fields['SC_voo_volta'] = 'text_aut';
      $tp_fields['id_ac_voo_volta'] = 'text_aut';
      $tp_fields['SC_cod_cia_volta_cond'] = 'cond';
      $tp_fields['SC_cod_cia_volta'] = 'text';
      $tp_fields['SC_forma_pgto_cond'] = 'cond';
      $tp_fields['SC_forma_pgto'] = 'text_aut';
      $tp_fields['id_ac_forma_pgto'] = 'text_aut';
      $tp_fields['SC_dt_checkout_cond'] = 'cond';
      $tp_fields['SC_dt_checkout_dia'] = 'text';
      $tp_fields['SC_dt_checkout_mes'] = 'text';
      $tp_fields['SC_dt_checkout_ano'] = 'text';
      $tp_fields['SC_dt_checkout_input_2_dia'] = 'text';
      $tp_fields['SC_dt_checkout_input_2_mes'] = 'text';
      $tp_fields['SC_dt_checkout_input_2_ano'] = 'text';
      $tp_fields['SC_intervalo_trout_cond'] = 'cond';
      $tp_fields['SC_intervalo_trout_hor'] = 'text';
      $tp_fields['SC_intervalo_trout_min'] = 'text';
      $tp_fields['SC_intervalo_trout_seg'] = 'text';
      $tp_fields['SC_intervalo_trout_input_2_hor'] = 'text';
      $tp_fields['SC_intervalo_trout_input_2_min'] = 'text';
      $tp_fields['SC_intervalo_trout_input_2_seg'] = 'text';
      $tp_fields['SC_hr_transferout_cond'] = 'cond';
      $tp_fields['SC_hr_transferout_hor'] = 'text';
      $tp_fields['SC_hr_transferout_min'] = 'text';
      $tp_fields['SC_hr_transferout_seg'] = 'text';
      $tp_fields['SC_hr_transferout_input_2_hor'] = 'text';
      $tp_fields['SC_hr_transferout_input_2_min'] = 'text';
      $tp_fields['SC_hr_transferout_input_2_seg'] = 'text';
      $tp_fields['SC_tipo_pessoa_cond'] = 'cond';
      $tp_fields['SC_tipo_pessoa'] = 'text_aut';
      $tp_fields['id_ac_tipo_pessoa'] = 'text_aut';
      $tp_fields['SC_tipo_transfer_cond'] = 'cond';
      $tp_fields['SC_tipo_transfer'] = 'text_aut';
      $tp_fields['id_ac_tipo_transfer'] = 'text_aut';
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
      global $hospede_cond, $hospede, $hospede_autocomp,
             $cpf_cond, $cpf, $cpf_autocomp,
             $passaporte_cond, $passaporte, $passaporte_autocomp,
             $cod_publico_cond, $cod_publico,
             $publico_dsc_cond, $publico_dsc, $publico_dsc_autocomp,
             $cod_hotel_cond, $cod_hotel,
             $hotel_dsc_cond, $hotel_dsc, $hotel_dsc_autocomp,
             $cod_acomodacao_cond, $cod_acomodacao,
             $acomodacao_dsc_cond, $acomodacao_dsc, $acomodacao_dsc_autocomp,
             $cod_categoria_cond, $cod_categoria,
             $categoria_dsc_cond, $categoria_dsc, $categoria_dsc_autocomp,
             $voo_ida_cond, $voo_ida, $voo_ida_autocomp,
             $cod_cia_ida_cond, $cod_cia_ida,
             $dt_checkin_cond, $dt_checkin, $dt_checkin_dia, $dt_checkin_mes, $dt_checkin_ano, $dt_checkin_input_2_dia, $dt_checkin_input_2_mes, $dt_checkin_input_2_ano,
             $hr_transferin_cond, $hr_transferin, $hr_transferin_hor, $hr_transferin_min, $hr_transferin_seg,
             $voo_volta_cond, $voo_volta, $voo_volta_autocomp,
             $cod_cia_volta_cond, $cod_cia_volta,
             $forma_pgto_cond, $forma_pgto, $forma_pgto_autocomp,
             $dt_checkout_cond, $dt_checkout, $dt_checkout_dia, $dt_checkout_mes, $dt_checkout_ano, $dt_checkout_input_2_dia, $dt_checkout_input_2_mes, $dt_checkout_input_2_ano,
             $intervalo_trout_cond, $intervalo_trout, $intervalo_trout_hor, $intervalo_trout_min, $intervalo_trout_seg,
             $hr_transferout_cond, $hr_transferout, $hr_transferout_hor, $hr_transferout_min, $hr_transferout_seg,
             $tipo_pessoa_cond, $tipo_pessoa, $tipo_pessoa_autocomp,
             $tipo_transfer_cond, $tipo_transfer, $tipo_transfer_autocomp, $nmgp_tab_label;

      $C_formatado = true;
      if ($this->NM_ajax_flag && ($this->NM_ajax_opcao == "ajax_grid_search" || $this->NM_ajax_opcao == "ajax_grid_search_change_fil"))
      {
          if ($this->NM_ajax_opcao == "ajax_grid_search")
          {
              $C_formatado = false;
          }
          $Temp_Busca  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && $this->NM_ajax_opcao != "ajax_grid_search_change_fil")
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca'], $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca'] as $Cmps => $Vals)
          {
              $$Cmps = $Vals;
          }
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_limpa.php", "F", "nm_limpa_valor") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_conv_dados.php", "F", "nm_conv_limpa_dado") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_edit.php", "F", "nmgp_Form_Num_Val") ; 
      if (!empty($hospede_autocomp) && empty($hospede))
      {
          $hospede = $hospede_autocomp;
      }
      if (!empty($cpf_autocomp) && empty($cpf))
      {
          $cpf = $cpf_autocomp;
      }
      if (!empty($passaporte_autocomp) && empty($passaporte))
      {
          $passaporte = $passaporte_autocomp;
      }
      if (!empty($publico_dsc_autocomp) && empty($publico_dsc))
      {
          $publico_dsc = $publico_dsc_autocomp;
      }
      if (!empty($hotel_dsc_autocomp) && empty($hotel_dsc))
      {
          $hotel_dsc = $hotel_dsc_autocomp;
      }
      if (!empty($acomodacao_dsc_autocomp) && empty($acomodacao_dsc))
      {
          $acomodacao_dsc = $acomodacao_dsc_autocomp;
      }
      if (!empty($categoria_dsc_autocomp) && empty($categoria_dsc))
      {
          $categoria_dsc = $categoria_dsc_autocomp;
      }
      if (!empty($voo_ida_autocomp) && empty($voo_ida))
      {
          $voo_ida = $voo_ida_autocomp;
      }
      if (!empty($voo_volta_autocomp) && empty($voo_volta))
      {
          $voo_volta = $voo_volta_autocomp;
      }
      if (!empty($forma_pgto_autocomp) && empty($forma_pgto))
      {
          $forma_pgto = $forma_pgto_autocomp;
      }
      if (!empty($tipo_pessoa_autocomp) && empty($tipo_pessoa))
      {
          $tipo_pessoa = $tipo_pessoa_autocomp;
      }
      if (!empty($tipo_transfer_autocomp) && empty($tipo_transfer))
      {
          $tipo_transfer = $tipo_transfer_autocomp;
      }
      $hospede_cond_salva = $hospede_cond; 
      if (!isset($hospede_input_2) || $hospede_input_2 == "")
      {
          $hospede_input_2 = $hospede;
      }
      $cpf_cond_salva = $cpf_cond; 
      if (!isset($cpf_input_2) || $cpf_input_2 == "")
      {
          $cpf_input_2 = $cpf;
      }
      $passaporte_cond_salva = $passaporte_cond; 
      if (!isset($passaporte_input_2) || $passaporte_input_2 == "")
      {
          $passaporte_input_2 = $passaporte;
      }
      $cod_publico_cond_salva = $cod_publico_cond; 
      if (!isset($cod_publico_input_2) || $cod_publico_input_2 == "")
      {
          $cod_publico_input_2 = $cod_publico;
      }
      $publico_dsc_cond_salva = $publico_dsc_cond; 
      if (!isset($publico_dsc_input_2) || $publico_dsc_input_2 == "")
      {
          $publico_dsc_input_2 = $publico_dsc;
      }
      $cod_hotel_cond_salva = $cod_hotel_cond; 
      if (!isset($cod_hotel_input_2) || $cod_hotel_input_2 == "")
      {
          $cod_hotel_input_2 = $cod_hotel;
      }
      $hotel_dsc_cond_salva = $hotel_dsc_cond; 
      if (!isset($hotel_dsc_input_2) || $hotel_dsc_input_2 == "")
      {
          $hotel_dsc_input_2 = $hotel_dsc;
      }
      $cod_acomodacao_cond_salva = $cod_acomodacao_cond; 
      if (!isset($cod_acomodacao_input_2) || $cod_acomodacao_input_2 == "")
      {
          $cod_acomodacao_input_2 = $cod_acomodacao;
      }
      $acomodacao_dsc_cond_salva = $acomodacao_dsc_cond; 
      if (!isset($acomodacao_dsc_input_2) || $acomodacao_dsc_input_2 == "")
      {
          $acomodacao_dsc_input_2 = $acomodacao_dsc;
      }
      $cod_categoria_cond_salva = $cod_categoria_cond; 
      if (!isset($cod_categoria_input_2) || $cod_categoria_input_2 == "")
      {
          $cod_categoria_input_2 = $cod_categoria;
      }
      $categoria_dsc_cond_salva = $categoria_dsc_cond; 
      if (!isset($categoria_dsc_input_2) || $categoria_dsc_input_2 == "")
      {
          $categoria_dsc_input_2 = $categoria_dsc;
      }
      $voo_ida_cond_salva = $voo_ida_cond; 
      if (!isset($voo_ida_input_2) || $voo_ida_input_2 == "")
      {
          $voo_ida_input_2 = $voo_ida;
      }
      $cod_cia_ida_cond_salva = $cod_cia_ida_cond; 
      if (!isset($cod_cia_ida_input_2) || $cod_cia_ida_input_2 == "")
      {
          $cod_cia_ida_input_2 = $cod_cia_ida;
      }
      $dt_checkin_cond_salva = $dt_checkin_cond; 
      if (!isset($dt_checkin_input_2_dia) || $dt_checkin_input_2_dia == "") {
          $dt_checkin_input_2_dia = $dt_checkin_dia;
      }
      if (!isset($dt_checkin_input_2_mes) || $dt_checkin_input_2_mes == "") {
          $dt_checkin_input_2_mes = $dt_checkin_mes;
      }
      if (!isset($dt_checkin_input_2_ano) || $dt_checkin_input_2_ano == "") {
          $dt_checkin_input_2_ano = $dt_checkin_ano;
      }
      $hr_transferin_cond_salva = $hr_transferin_cond; 
      $voo_volta_cond_salva = $voo_volta_cond; 
      if (!isset($voo_volta_input_2) || $voo_volta_input_2 == "")
      {
          $voo_volta_input_2 = $voo_volta;
      }
      $cod_cia_volta_cond_salva = $cod_cia_volta_cond; 
      if (!isset($cod_cia_volta_input_2) || $cod_cia_volta_input_2 == "")
      {
          $cod_cia_volta_input_2 = $cod_cia_volta;
      }
      $forma_pgto_cond_salva = $forma_pgto_cond; 
      if (!isset($forma_pgto_input_2) || $forma_pgto_input_2 == "")
      {
          $forma_pgto_input_2 = $forma_pgto;
      }
      $dt_checkout_cond_salva = $dt_checkout_cond; 
      if (!isset($dt_checkout_input_2_dia) || $dt_checkout_input_2_dia == "") {
          $dt_checkout_input_2_dia = $dt_checkout_dia;
      }
      if (!isset($dt_checkout_input_2_mes) || $dt_checkout_input_2_mes == "") {
          $dt_checkout_input_2_mes = $dt_checkout_mes;
      }
      if (!isset($dt_checkout_input_2_ano) || $dt_checkout_input_2_ano == "") {
          $dt_checkout_input_2_ano = $dt_checkout_ano;
      }
      $intervalo_trout_cond_salva = $intervalo_trout_cond; 
      $hr_transferout_cond_salva = $hr_transferout_cond; 
      $tipo_pessoa_cond_salva = $tipo_pessoa_cond; 
      if (!isset($tipo_pessoa_input_2) || $tipo_pessoa_input_2 == "")
      {
          $tipo_pessoa_input_2 = $tipo_pessoa;
      }
      $tipo_transfer_cond_salva = $tipo_transfer_cond; 
      if (!isset($tipo_transfer_input_2) || $tipo_transfer_input_2 == "")
      {
          $tipo_transfer_input_2 = $tipo_transfer;
      }
      if ($cod_publico_cond != "in")
      {
          nm_limpa_numero($cod_publico, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      if ($cod_hotel_cond != "in")
      {
          nm_limpa_numero($cod_hotel, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      if ($cod_acomodacao_cond != "in")
      {
          nm_limpa_numero($cod_acomodacao, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      if ($cod_categoria_cond != "in")
      {
          nm_limpa_numero($cod_categoria, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      if ($cod_cia_ida_cond != "in")
      {
          nm_limpa_numero($cod_cia_ida, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      if ($cod_cia_volta_cond != "in")
      {
          nm_limpa_numero($cod_cia_volta, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']  = array(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search']  = array(); 
      $I_Grid = 0;
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hospede'] = $hospede; 
      if (is_array($hospede) && !empty($hospede))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0] = $hospede;
      }
      elseif ($hospede_cond_salva == "nu" || $hospede_cond_salva == "nn" || $hospede_cond_salva == "ep" || $hospede_cond_salva == "ne" || !empty($hospede))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][0] = $hospede;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hospede_cond'] = $hospede_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['cmp'] = "hospede"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['opc'] = $hospede_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['hospede'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cpf'] = $cpf; 
      if (is_array($cpf) && !empty($cpf))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0] = $cpf;
      }
      elseif ($cpf_cond_salva == "nu" || $cpf_cond_salva == "nn" || $cpf_cond_salva == "ep" || $cpf_cond_salva == "ne" || !empty($cpf))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][0] = $cpf;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cpf_cond'] = $cpf_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['cmp'] = "cpf"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['opc'] = $cpf_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['cpf'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['passaporte'] = $passaporte; 
      if (is_array($passaporte) && !empty($passaporte))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0] = $passaporte;
      }
      elseif ($passaporte_cond_salva == "nu" || $passaporte_cond_salva == "nn" || $passaporte_cond_salva == "ep" || $passaporte_cond_salva == "ne" || !empty($passaporte))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][0] = $passaporte;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['passaporte_cond'] = $passaporte_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['cmp'] = "passaporte"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['opc'] = $passaporte_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['passaporte'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cod_publico'] = $cod_publico; 
      if (is_array($cod_publico) && !empty($cod_publico))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0] = $cod_publico;
      }
      elseif ($cod_publico_cond_salva == "nu" || $cod_publico_cond_salva == "nn" || $cod_publico_cond_salva == "ep" || $cod_publico_cond_salva == "ne" || !empty($cod_publico))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][0] = $cod_publico;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cod_publico_cond'] = $cod_publico_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['cmp'] = "cod_publico"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['opc'] = $cod_publico_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['cod_publico'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['publico_dsc'] = $publico_dsc; 
      if (is_array($publico_dsc) && !empty($publico_dsc))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0] = $publico_dsc;
      }
      elseif ($publico_dsc_cond_salva == "nu" || $publico_dsc_cond_salva == "nn" || $publico_dsc_cond_salva == "ep" || $publico_dsc_cond_salva == "ne" || !empty($publico_dsc))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][0] = $publico_dsc;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['publico_dsc_cond'] = $publico_dsc_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['cmp'] = "publico_dsc"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['opc'] = $publico_dsc_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['publico_dsc'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cod_hotel'] = $cod_hotel; 
      if (is_array($cod_hotel) && !empty($cod_hotel))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0] = $cod_hotel;
      }
      elseif ($cod_hotel_cond_salva == "nu" || $cod_hotel_cond_salva == "nn" || $cod_hotel_cond_salva == "ep" || $cod_hotel_cond_salva == "ne" || !empty($cod_hotel))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][0] = $cod_hotel;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cod_hotel_cond'] = $cod_hotel_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['cmp'] = "cod_hotel"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['opc'] = $cod_hotel_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['cod_hotel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hotel_dsc'] = $hotel_dsc; 
      if (is_array($hotel_dsc) && !empty($hotel_dsc))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0] = $hotel_dsc;
      }
      elseif ($hotel_dsc_cond_salva == "nu" || $hotel_dsc_cond_salva == "nn" || $hotel_dsc_cond_salva == "ep" || $hotel_dsc_cond_salva == "ne" || !empty($hotel_dsc))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][0] = $hotel_dsc;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hotel_dsc_cond'] = $hotel_dsc_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['cmp'] = "hotel_dsc"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['opc'] = $hotel_dsc_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['hotel_dsc'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cod_acomodacao'] = $cod_acomodacao; 
      if (is_array($cod_acomodacao) && !empty($cod_acomodacao))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0] = $cod_acomodacao;
      }
      elseif ($cod_acomodacao_cond_salva == "nu" || $cod_acomodacao_cond_salva == "nn" || $cod_acomodacao_cond_salva == "ep" || $cod_acomodacao_cond_salva == "ne" || !empty($cod_acomodacao))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][0] = $cod_acomodacao;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cod_acomodacao_cond'] = $cod_acomodacao_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['cmp'] = "cod_acomodacao"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['opc'] = $cod_acomodacao_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['cod_acomodacao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['acomodacao_dsc'] = $acomodacao_dsc; 
      if (is_array($acomodacao_dsc) && !empty($acomodacao_dsc))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0] = $acomodacao_dsc;
      }
      elseif ($acomodacao_dsc_cond_salva == "nu" || $acomodacao_dsc_cond_salva == "nn" || $acomodacao_dsc_cond_salva == "ep" || $acomodacao_dsc_cond_salva == "ne" || !empty($acomodacao_dsc))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][0] = $acomodacao_dsc;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['acomodacao_dsc_cond'] = $acomodacao_dsc_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['cmp'] = "acomodacao_dsc"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['opc'] = $acomodacao_dsc_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['acomodacao_dsc'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cod_categoria'] = $cod_categoria; 
      if (is_array($cod_categoria) && !empty($cod_categoria))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0] = $cod_categoria;
      }
      elseif ($cod_categoria_cond_salva == "nu" || $cod_categoria_cond_salva == "nn" || $cod_categoria_cond_salva == "ep" || $cod_categoria_cond_salva == "ne" || !empty($cod_categoria))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][0] = $cod_categoria;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cod_categoria_cond'] = $cod_categoria_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['cmp'] = "cod_categoria"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['opc'] = $cod_categoria_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['cod_categoria'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['categoria_dsc'] = $categoria_dsc; 
      if (is_array($categoria_dsc) && !empty($categoria_dsc))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0] = $categoria_dsc;
      }
      elseif ($categoria_dsc_cond_salva == "nu" || $categoria_dsc_cond_salva == "nn" || $categoria_dsc_cond_salva == "ep" || $categoria_dsc_cond_salva == "ne" || !empty($categoria_dsc))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][0] = $categoria_dsc;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['categoria_dsc_cond'] = $categoria_dsc_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['cmp'] = "categoria_dsc"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['opc'] = $categoria_dsc_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['categoria_dsc'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['voo_ida'] = $voo_ida; 
      if (is_array($voo_ida) && !empty($voo_ida))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0] = $voo_ida;
      }
      elseif ($voo_ida_cond_salva == "nu" || $voo_ida_cond_salva == "nn" || $voo_ida_cond_salva == "ep" || $voo_ida_cond_salva == "ne" || !empty($voo_ida))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][0] = $voo_ida;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['voo_ida_cond'] = $voo_ida_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['cmp'] = "voo_ida"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['opc'] = $voo_ida_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['voo_ida'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cod_cia_ida'] = $cod_cia_ida; 
      if (is_array($cod_cia_ida) && !empty($cod_cia_ida))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0] = $cod_cia_ida;
      }
      elseif ($cod_cia_ida_cond_salva == "nu" || $cod_cia_ida_cond_salva == "nn" || $cod_cia_ida_cond_salva == "ep" || $cod_cia_ida_cond_salva == "ne" || !empty($cod_cia_ida))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][0] = $cod_cia_ida;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cod_cia_ida_cond'] = $cod_cia_ida_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['cmp'] = "cod_cia_ida"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['opc'] = $cod_cia_ida_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['cod_cia_ida'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkin_dia'] = $dt_checkin_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkin_mes'] = $dt_checkin_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkin_ano'] = $dt_checkin_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkin_input_2_dia'] = $dt_checkin_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkin_input_2_mes'] = $dt_checkin_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkin_input_2_ano'] = $dt_checkin_input_2_ano; 
      if (!empty($dt_checkin_dia) || !empty($dt_checkin_mes) || !empty($dt_checkin_ano) || $dt_checkin_cond_salva == "nu" || $dt_checkin_cond_salva == "nn" || $dt_checkin_cond_salva == "ep" || $dt_checkin_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][] = "D:" . $dt_checkin_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][] = "M:" . $dt_checkin_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][] = "Y:" . $dt_checkin_ano;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][1][] = "D:" . $dt_checkin_input_2_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][1][] = "M:" . $dt_checkin_input_2_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][1][] = "Y:" . $dt_checkin_input_2_ano;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkin_cond'] = $dt_checkin_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['cmp'] = "dt_checkin"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['opc'] = $dt_checkin_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['dt_checkin'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hr_transferin_hor'] = $hr_transferin_hor; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hr_transferin_min'] = $hr_transferin_min; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hr_transferin_seg'] = $hr_transferin_seg; 
      if (!empty($hr_transferin_hor) || !empty($hr_transferin_min) || !empty($hr_transferin_seg) || $hr_transferin_cond_salva == "nu" || $hr_transferin_cond_salva == "nn" || $hr_transferin_cond_salva == "ep" || $hr_transferin_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][] = "H:" . $hr_transferin_hor;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][] = "I:" . $hr_transferin_min;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][] = "S:" . $hr_transferin_seg;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hr_transferin_cond'] = $hr_transferin_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['cmp'] = "hr_transferin"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['opc'] = $hr_transferin_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['hr_transferin'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['voo_volta'] = $voo_volta; 
      if (is_array($voo_volta) && !empty($voo_volta))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0] = $voo_volta;
      }
      elseif ($voo_volta_cond_salva == "nu" || $voo_volta_cond_salva == "nn" || $voo_volta_cond_salva == "ep" || $voo_volta_cond_salva == "ne" || !empty($voo_volta))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][0] = $voo_volta;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['voo_volta_cond'] = $voo_volta_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['cmp'] = "voo_volta"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['opc'] = $voo_volta_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['voo_volta'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cod_cia_volta'] = $cod_cia_volta; 
      if (is_array($cod_cia_volta) && !empty($cod_cia_volta))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0] = $cod_cia_volta;
      }
      elseif ($cod_cia_volta_cond_salva == "nu" || $cod_cia_volta_cond_salva == "nn" || $cod_cia_volta_cond_salva == "ep" || $cod_cia_volta_cond_salva == "ne" || !empty($cod_cia_volta))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][0] = $cod_cia_volta;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['cod_cia_volta_cond'] = $cod_cia_volta_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['cmp'] = "cod_cia_volta"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['opc'] = $cod_cia_volta_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['cod_cia_volta'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['forma_pgto'] = $forma_pgto; 
      if (is_array($forma_pgto) && !empty($forma_pgto))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0] = $forma_pgto;
      }
      elseif ($forma_pgto_cond_salva == "nu" || $forma_pgto_cond_salva == "nn" || $forma_pgto_cond_salva == "ep" || $forma_pgto_cond_salva == "ne" || !empty($forma_pgto))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][0] = $forma_pgto;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['forma_pgto_cond'] = $forma_pgto_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['cmp'] = "forma_pgto"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['opc'] = $forma_pgto_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['forma_pgto'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkout_dia'] = $dt_checkout_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkout_mes'] = $dt_checkout_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkout_ano'] = $dt_checkout_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkout_input_2_dia'] = $dt_checkout_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkout_input_2_mes'] = $dt_checkout_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkout_input_2_ano'] = $dt_checkout_input_2_ano; 
      if (!empty($dt_checkout_dia) || !empty($dt_checkout_mes) || !empty($dt_checkout_ano) || $dt_checkout_cond_salva == "nu" || $dt_checkout_cond_salva == "nn" || $dt_checkout_cond_salva == "ep" || $dt_checkout_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][] = "D:" . $dt_checkout_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][] = "M:" . $dt_checkout_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][] = "Y:" . $dt_checkout_ano;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][1][] = "D:" . $dt_checkout_input_2_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][1][] = "M:" . $dt_checkout_input_2_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][1][] = "Y:" . $dt_checkout_input_2_ano;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkout_cond'] = $dt_checkout_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['cmp'] = "dt_checkout"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['opc'] = $dt_checkout_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['dt_checkout'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['intervalo_trout_hor'] = $intervalo_trout_hor; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['intervalo_trout_min'] = $intervalo_trout_min; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['intervalo_trout_seg'] = $intervalo_trout_seg; 
      if (!empty($intervalo_trout_hor) || !empty($intervalo_trout_min) || !empty($intervalo_trout_seg) || $intervalo_trout_cond_salva == "nu" || $intervalo_trout_cond_salva == "nn" || $intervalo_trout_cond_salva == "ep" || $intervalo_trout_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][] = "H:" . $intervalo_trout_hor;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][] = "I:" . $intervalo_trout_min;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][] = "S:" . $intervalo_trout_seg;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['intervalo_trout_cond'] = $intervalo_trout_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['cmp'] = "intervalo_trout"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['opc'] = $intervalo_trout_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['intervalo_trout'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hr_transferout_hor'] = $hr_transferout_hor; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hr_transferout_min'] = $hr_transferout_min; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hr_transferout_seg'] = $hr_transferout_seg; 
      if (!empty($hr_transferout_hor) || !empty($hr_transferout_min) || !empty($hr_transferout_seg) || $hr_transferout_cond_salva == "nu" || $hr_transferout_cond_salva == "nn" || $hr_transferout_cond_salva == "ep" || $hr_transferout_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][] = "H:" . $hr_transferout_hor;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][] = "I:" . $hr_transferout_min;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][] = "S:" . $hr_transferout_seg;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hr_transferout_cond'] = $hr_transferout_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['cmp'] = "hr_transferout"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['opc'] = $hr_transferout_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['hr_transferout'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['tipo_pessoa'] = $tipo_pessoa; 
      if (is_array($tipo_pessoa) && !empty($tipo_pessoa))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0] = $tipo_pessoa;
      }
      elseif ($tipo_pessoa_cond_salva == "nu" || $tipo_pessoa_cond_salva == "nn" || $tipo_pessoa_cond_salva == "ep" || $tipo_pessoa_cond_salva == "ne" || !empty($tipo_pessoa))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][0] = $tipo_pessoa;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['tipo_pessoa_cond'] = $tipo_pessoa_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['cmp'] = "tipo_pessoa"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['opc'] = $tipo_pessoa_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['tipo_pessoa'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['tipo_transfer'] = $tipo_transfer; 
      if (is_array($tipo_transfer) && !empty($tipo_transfer))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0] = $tipo_transfer;
      }
      elseif ($tipo_transfer_cond_salva == "nu" || $tipo_transfer_cond_salva == "nn" || $tipo_transfer_cond_salva == "ep" || $tipo_transfer_cond_salva == "ne" || !empty($tipo_transfer))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['val'][0][0] = $tipo_transfer;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['tipo_transfer_cond'] = $tipo_transfer_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['cmp'] = "tipo_transfer"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid]['opc'] = $tipo_transfer_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['tipo_transfer'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['NM_operador'] = $this->NM_operador; 
      if ($this->NM_ajax_flag && $this->NM_ajax_opcao == "ajax_grid_search")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca'] = $Temp_Busca;
      }
      if (!empty($this->Campos_Mens_erro)) 
      {
          return;
      }
      $nmgp_def_dados = array();
    if ($hospede != '') {
      $hospede_look = (is_string($hospede) ? substr($this->Db->qstr($hospede), 1, -1) : $hospede); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct hospede from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#hospede#lowerF# = #lowerI#'$hospede_look'#lowerF# order by hospede"; 
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
          $this->cmp_formatado['hospede'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['hospede'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['hospede'] = $hospede;
      }
      $this->cmp_formatado['hospede'] = "'" . $this->cmp_formatado['hospede'] . "'";
      if (isset($this->cmp_formatado['hospede_input_2'])  && !empty($this->cmp_formatado['hospede_input_2'])) {
          $this->cmp_formatado['hospede_input_2'] = "'" . $this->cmp_formatado['hospede_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($cpf != '') {
      $cpf_look = (is_string($cpf) ? substr($this->Db->qstr($cpf), 1, -1) : $cpf); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct cpf from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#cpf#lowerF# = #lowerI#'$cpf_look'#lowerF# order by cpf"; 
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
          $this->cmp_formatado['cpf'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['cpf'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['cpf'] = $cpf;
      }
      $this->cmp_formatado['cpf'] = "'" . $this->cmp_formatado['cpf'] . "'";
      if (isset($this->cmp_formatado['cpf_input_2'])  && !empty($this->cmp_formatado['cpf_input_2'])) {
          $this->cmp_formatado['cpf_input_2'] = "'" . $this->cmp_formatado['cpf_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($passaporte != '') {
      $passaporte_look = (is_string($passaporte) ? substr($this->Db->qstr($passaporte), 1, -1) : $passaporte); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct passaporte from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#passaporte#lowerF# = #lowerI#'$passaporte_look'#lowerF# order by passaporte"; 
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
          $this->cmp_formatado['passaporte'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['passaporte'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['passaporte'] = $passaporte;
      }
      $this->cmp_formatado['passaporte'] = "'" . $this->cmp_formatado['passaporte'] . "'";
      if (isset($this->cmp_formatado['passaporte_input_2'])  && !empty($this->cmp_formatado['passaporte_input_2'])) {
          $this->cmp_formatado['passaporte_input_2'] = "'" . $this->cmp_formatado['passaporte_input_2'] . "'";
      }
      $Conteudo = $cod_publico;
      if (strtoupper($cod_publico_cond) != "II" && strtoupper($cod_publico_cond) != "QP" && strtoupper($cod_publico_cond) != "NP" && strtoupper($cod_publico_cond) != "IN") 
      { 
          nmgp_Form_Num_Val($Conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      } 
      $this->cmp_formatado['cod_publico'] = $Conteudo;
      $this->cmp_formatado['cod_publico'] = "'" . $this->cmp_formatado['cod_publico'] . "'";
      if (isset($this->cmp_formatado['cod_publico_input_2'])  && !empty($this->cmp_formatado['cod_publico_input_2'])) {
          $this->cmp_formatado['cod_publico_input_2'] = "'" . $this->cmp_formatado['cod_publico_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($publico_dsc != '') {
      $publico_dsc_look = (is_string($publico_dsc) ? substr($this->Db->qstr($publico_dsc), 1, -1) : $publico_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct publico_dsc from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#publico_dsc#lowerF# = #lowerI#'$publico_dsc_look'#lowerF# order by publico_dsc"; 
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
          $this->cmp_formatado['publico_dsc'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['publico_dsc'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['publico_dsc'] = $publico_dsc;
      }
      $this->cmp_formatado['publico_dsc'] = "'" . $this->cmp_formatado['publico_dsc'] . "'";
      if (isset($this->cmp_formatado['publico_dsc_input_2'])  && !empty($this->cmp_formatado['publico_dsc_input_2'])) {
          $this->cmp_formatado['publico_dsc_input_2'] = "'" . $this->cmp_formatado['publico_dsc_input_2'] . "'";
      }
      $Conteudo = $cod_hotel;
      if (strtoupper($cod_hotel_cond) != "II" && strtoupper($cod_hotel_cond) != "QP" && strtoupper($cod_hotel_cond) != "NP" && strtoupper($cod_hotel_cond) != "IN") 
      { 
          nmgp_Form_Num_Val($Conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      } 
      $this->cmp_formatado['cod_hotel'] = $Conteudo;
      $this->cmp_formatado['cod_hotel'] = "'" . $this->cmp_formatado['cod_hotel'] . "'";
      if (isset($this->cmp_formatado['cod_hotel_input_2'])  && !empty($this->cmp_formatado['cod_hotel_input_2'])) {
          $this->cmp_formatado['cod_hotel_input_2'] = "'" . $this->cmp_formatado['cod_hotel_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($hotel_dsc != '') {
      $hotel_dsc_look = (is_string($hotel_dsc) ? substr($this->Db->qstr($hotel_dsc), 1, -1) : $hotel_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct hotel_dsc from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#hotel_dsc#lowerF# = #lowerI#'$hotel_dsc_look'#lowerF# order by hotel_dsc"; 
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
          $this->cmp_formatado['hotel_dsc'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['hotel_dsc'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['hotel_dsc'] = $hotel_dsc;
      }
      $this->cmp_formatado['hotel_dsc'] = "'" . $this->cmp_formatado['hotel_dsc'] . "'";
      if (isset($this->cmp_formatado['hotel_dsc_input_2'])  && !empty($this->cmp_formatado['hotel_dsc_input_2'])) {
          $this->cmp_formatado['hotel_dsc_input_2'] = "'" . $this->cmp_formatado['hotel_dsc_input_2'] . "'";
      }
      $Conteudo = $cod_acomodacao;
      if (strtoupper($cod_acomodacao_cond) != "II" && strtoupper($cod_acomodacao_cond) != "QP" && strtoupper($cod_acomodacao_cond) != "NP" && strtoupper($cod_acomodacao_cond) != "IN") 
      { 
          nmgp_Form_Num_Val($Conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      } 
      $this->cmp_formatado['cod_acomodacao'] = $Conteudo;
      $this->cmp_formatado['cod_acomodacao'] = "'" . $this->cmp_formatado['cod_acomodacao'] . "'";
      if (isset($this->cmp_formatado['cod_acomodacao_input_2'])  && !empty($this->cmp_formatado['cod_acomodacao_input_2'])) {
          $this->cmp_formatado['cod_acomodacao_input_2'] = "'" . $this->cmp_formatado['cod_acomodacao_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($acomodacao_dsc != '') {
      $acomodacao_dsc_look = (is_string($acomodacao_dsc) ? substr($this->Db->qstr($acomodacao_dsc), 1, -1) : $acomodacao_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct acomodacao_dsc from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#acomodacao_dsc#lowerF# = #lowerI#'$acomodacao_dsc_look'#lowerF# order by acomodacao_dsc"; 
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
          $this->cmp_formatado['acomodacao_dsc'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['acomodacao_dsc'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['acomodacao_dsc'] = $acomodacao_dsc;
      }
      $this->cmp_formatado['acomodacao_dsc'] = "'" . $this->cmp_formatado['acomodacao_dsc'] . "'";
      if (isset($this->cmp_formatado['acomodacao_dsc_input_2'])  && !empty($this->cmp_formatado['acomodacao_dsc_input_2'])) {
          $this->cmp_formatado['acomodacao_dsc_input_2'] = "'" . $this->cmp_formatado['acomodacao_dsc_input_2'] . "'";
      }
      $Conteudo = $cod_categoria;
      if (strtoupper($cod_categoria_cond) != "II" && strtoupper($cod_categoria_cond) != "QP" && strtoupper($cod_categoria_cond) != "NP" && strtoupper($cod_categoria_cond) != "IN") 
      { 
          nmgp_Form_Num_Val($Conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      } 
      $this->cmp_formatado['cod_categoria'] = $Conteudo;
      $this->cmp_formatado['cod_categoria'] = "'" . $this->cmp_formatado['cod_categoria'] . "'";
      if (isset($this->cmp_formatado['cod_categoria_input_2'])  && !empty($this->cmp_formatado['cod_categoria_input_2'])) {
          $this->cmp_formatado['cod_categoria_input_2'] = "'" . $this->cmp_formatado['cod_categoria_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($categoria_dsc != '') {
      $categoria_dsc_look = (is_string($categoria_dsc) ? substr($this->Db->qstr($categoria_dsc), 1, -1) : $categoria_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct categoria_dsc from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#categoria_dsc#lowerF# = #lowerI#'$categoria_dsc_look'#lowerF# order by categoria_dsc"; 
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
          $this->cmp_formatado['categoria_dsc'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['categoria_dsc'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['categoria_dsc'] = $categoria_dsc;
      }
      $this->cmp_formatado['categoria_dsc'] = "'" . $this->cmp_formatado['categoria_dsc'] . "'";
      if (isset($this->cmp_formatado['categoria_dsc_input_2'])  && !empty($this->cmp_formatado['categoria_dsc_input_2'])) {
          $this->cmp_formatado['categoria_dsc_input_2'] = "'" . $this->cmp_formatado['categoria_dsc_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($voo_ida != '') {
      $voo_ida_look = (is_string($voo_ida) ? substr($this->Db->qstr($voo_ida), 1, -1) : $voo_ida); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct voo_ida from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#voo_ida#lowerF# = #lowerI#'$voo_ida_look'#lowerF# order by voo_ida"; 
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
          $this->cmp_formatado['voo_ida'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['voo_ida'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['voo_ida'] = $voo_ida;
      }
      $this->cmp_formatado['voo_ida'] = "'" . $this->cmp_formatado['voo_ida'] . "'";
      if (isset($this->cmp_formatado['voo_ida_input_2'])  && !empty($this->cmp_formatado['voo_ida_input_2'])) {
          $this->cmp_formatado['voo_ida_input_2'] = "'" . $this->cmp_formatado['voo_ida_input_2'] . "'";
      }
      $Conteudo = $cod_cia_ida;
      if (strtoupper($cod_cia_ida_cond) != "II" && strtoupper($cod_cia_ida_cond) != "QP" && strtoupper($cod_cia_ida_cond) != "NP" && strtoupper($cod_cia_ida_cond) != "IN") 
      { 
          nmgp_Form_Num_Val($Conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      } 
      $this->cmp_formatado['cod_cia_ida'] = $Conteudo;
      $this->cmp_formatado['cod_cia_ida'] = "'" . $this->cmp_formatado['cod_cia_ida'] . "'";
      if (isset($this->cmp_formatado['cod_cia_ida_input_2'])  && !empty($this->cmp_formatado['cod_cia_ida_input_2'])) {
          $this->cmp_formatado['cod_cia_ida_input_2'] = "'" . $this->cmp_formatado['cod_cia_ida_input_2'] . "'";
      }
      $this->cmp_formatado['dt_checkin'] = "'" . $this->cmp_formatado['dt_checkin'] . "'";
      if (isset($this->cmp_formatado['dt_checkin_input_2'])  && !empty($this->cmp_formatado['dt_checkin_input_2'])) {
          $this->cmp_formatado['dt_checkin_input_2'] = "'" . $this->cmp_formatado['dt_checkin_input_2'] . "'";
      }
      $this->cmp_formatado['hr_transferin'] = "'" . $this->cmp_formatado['hr_transferin'] . "'";
      if (isset($this->cmp_formatado['hr_transferin_input_2'])  && !empty($this->cmp_formatado['hr_transferin_input_2'])) {
          $this->cmp_formatado['hr_transferin_input_2'] = "'" . $this->cmp_formatado['hr_transferin_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($voo_volta != '') {
      $voo_volta_look = (is_string($voo_volta) ? substr($this->Db->qstr($voo_volta), 1, -1) : $voo_volta); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct voo_volta from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#voo_volta#lowerF# = #lowerI#'$voo_volta_look'#lowerF# order by voo_volta"; 
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
          $this->cmp_formatado['voo_volta'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['voo_volta'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['voo_volta'] = $voo_volta;
      }
      $this->cmp_formatado['voo_volta'] = "'" . $this->cmp_formatado['voo_volta'] . "'";
      if (isset($this->cmp_formatado['voo_volta_input_2'])  && !empty($this->cmp_formatado['voo_volta_input_2'])) {
          $this->cmp_formatado['voo_volta_input_2'] = "'" . $this->cmp_formatado['voo_volta_input_2'] . "'";
      }
      $Conteudo = $cod_cia_volta;
      if (strtoupper($cod_cia_volta_cond) != "II" && strtoupper($cod_cia_volta_cond) != "QP" && strtoupper($cod_cia_volta_cond) != "NP" && strtoupper($cod_cia_volta_cond) != "IN") 
      { 
          nmgp_Form_Num_Val($Conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      } 
      $this->cmp_formatado['cod_cia_volta'] = $Conteudo;
      $this->cmp_formatado['cod_cia_volta'] = "'" . $this->cmp_formatado['cod_cia_volta'] . "'";
      if (isset($this->cmp_formatado['cod_cia_volta_input_2'])  && !empty($this->cmp_formatado['cod_cia_volta_input_2'])) {
          $this->cmp_formatado['cod_cia_volta_input_2'] = "'" . $this->cmp_formatado['cod_cia_volta_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($forma_pgto != '') {
      $forma_pgto_look = (is_string($forma_pgto) ? substr($this->Db->qstr($forma_pgto), 1, -1) : $forma_pgto); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct forma_pgto from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#forma_pgto#lowerF# = #lowerI#'$forma_pgto_look'#lowerF# order by forma_pgto"; 
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
          $this->cmp_formatado['forma_pgto'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['forma_pgto'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['forma_pgto'] = $forma_pgto;
      }
      $this->cmp_formatado['forma_pgto'] = "'" . $this->cmp_formatado['forma_pgto'] . "'";
      if (isset($this->cmp_formatado['forma_pgto_input_2'])  && !empty($this->cmp_formatado['forma_pgto_input_2'])) {
          $this->cmp_formatado['forma_pgto_input_2'] = "'" . $this->cmp_formatado['forma_pgto_input_2'] . "'";
      }
      $this->cmp_formatado['dt_checkout'] = "'" . $this->cmp_formatado['dt_checkout'] . "'";
      if (isset($this->cmp_formatado['dt_checkout_input_2'])  && !empty($this->cmp_formatado['dt_checkout_input_2'])) {
          $this->cmp_formatado['dt_checkout_input_2'] = "'" . $this->cmp_formatado['dt_checkout_input_2'] . "'";
      }
      $this->cmp_formatado['intervalo_trout'] = "'" . $this->cmp_formatado['intervalo_trout'] . "'";
      if (isset($this->cmp_formatado['intervalo_trout_input_2'])  && !empty($this->cmp_formatado['intervalo_trout_input_2'])) {
          $this->cmp_formatado['intervalo_trout_input_2'] = "'" . $this->cmp_formatado['intervalo_trout_input_2'] . "'";
      }
      $this->cmp_formatado['hr_transferout'] = "'" . $this->cmp_formatado['hr_transferout'] . "'";
      if (isset($this->cmp_formatado['hr_transferout_input_2'])  && !empty($this->cmp_formatado['hr_transferout_input_2'])) {
          $this->cmp_formatado['hr_transferout_input_2'] = "'" . $this->cmp_formatado['hr_transferout_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($tipo_pessoa != '') {
      $tipo_pessoa_look = (is_string($tipo_pessoa) ? substr($this->Db->qstr($tipo_pessoa), 1, -1) : $tipo_pessoa); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tipo_pessoa from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#tipo_pessoa#lowerF# = #lowerI#'$tipo_pessoa_look'#lowerF# order by tipo_pessoa"; 
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
      $nmgp_def_dados = array();
    if ($tipo_transfer != '') {
      $tipo_transfer_look = (is_string($tipo_transfer) ? substr($this->Db->qstr($tipo_transfer), 1, -1) : $tipo_transfer); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tipo_transfer from " . $this->Ini->nm_tabela . " where (cod_evento = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#tipo_transfer#lowerF# = #lowerI#'$tipo_transfer_look'#lowerF# order by tipo_transfer"; 
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
          $this->cmp_formatado['tipo_transfer'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['tipo_transfer'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['tipo_transfer'] = $tipo_transfer;
      }
      $this->cmp_formatado['tipo_transfer'] = "'" . $this->cmp_formatado['tipo_transfer'] . "'";
      if (isset($this->cmp_formatado['tipo_transfer_input_2'])  && !empty($this->cmp_formatado['tipo_transfer_input_2'])) {
          $this->cmp_formatado['tipo_transfer_input_2'] = "'" . $this->cmp_formatado['tipo_transfer_input_2'] . "'";
      }
   }

   function processa_campos($Res_comp='pesq')
   {
      global $hospede_cond, $hospede, $hospede_autocomp,
             $cpf_cond, $cpf, $cpf_autocomp,
             $passaporte_cond, $passaporte, $passaporte_autocomp,
             $cod_publico_cond, $cod_publico,
             $publico_dsc_cond, $publico_dsc, $publico_dsc_autocomp,
             $cod_hotel_cond, $cod_hotel,
             $hotel_dsc_cond, $hotel_dsc, $hotel_dsc_autocomp,
             $cod_acomodacao_cond, $cod_acomodacao,
             $acomodacao_dsc_cond, $acomodacao_dsc, $acomodacao_dsc_autocomp,
             $cod_categoria_cond, $cod_categoria,
             $categoria_dsc_cond, $categoria_dsc, $categoria_dsc_autocomp,
             $voo_ida_cond, $voo_ida, $voo_ida_autocomp,
             $cod_cia_ida_cond, $cod_cia_ida,
             $dt_checkin_cond, $dt_checkin, $dt_checkin_dia, $dt_checkin_mes, $dt_checkin_ano, $dt_checkin_input_2_dia, $dt_checkin_input_2_mes, $dt_checkin_input_2_ano,
             $hr_transferin_cond, $hr_transferin, $hr_transferin_hor, $hr_transferin_min, $hr_transferin_seg,
             $voo_volta_cond, $voo_volta, $voo_volta_autocomp,
             $cod_cia_volta_cond, $cod_cia_volta,
             $forma_pgto_cond, $forma_pgto, $forma_pgto_autocomp,
             $dt_checkout_cond, $dt_checkout, $dt_checkout_dia, $dt_checkout_mes, $dt_checkout_ano, $dt_checkout_input_2_dia, $dt_checkout_input_2_mes, $dt_checkout_input_2_ano,
             $intervalo_trout_cond, $intervalo_trout, $intervalo_trout_hor, $intervalo_trout_min, $intervalo_trout_seg,
             $hr_transferout_cond, $hr_transferout, $hr_transferout_hor, $hr_transferout_min, $hr_transferout_seg,
             $tipo_pessoa_cond, $tipo_pessoa, $tipo_pessoa_autocomp,
             $tipo_transfer_cond, $tipo_transfer, $tipo_transfer_autocomp, $nmgp_tab_label;


      //----- $hospede
      $this->Date_part = false;
      if (isset($hospede) || $hospede_cond == "nu" || $hospede_cond == "nn" || $hospede_cond == "ep" || $hospede_cond == "ne")
      {
         $this->monta_condicao("hospede", $hospede_cond, $hospede, "", "hospede", "VARCHAR", false);
      }

      //----- $cpf
      $this->Date_part = false;
      if (isset($cpf) || $cpf_cond == "nu" || $cpf_cond == "nn" || $cpf_cond == "ep" || $cpf_cond == "ne")
      {
         $this->monta_condicao("cpf", $cpf_cond, $cpf, "", "cpf", "VARCHAR", false);
      }

      //----- $passaporte
      $this->Date_part = false;
      if (isset($passaporte) || $passaporte_cond == "nu" || $passaporte_cond == "nn" || $passaporte_cond == "ep" || $passaporte_cond == "ne")
      {
         $this->monta_condicao("passaporte", $passaporte_cond, $passaporte, "", "passaporte", "VARCHAR", false);
      }

      //----- $cod_publico
      $this->Date_part = false;
      if (isset($cod_publico) || $cod_publico_cond == "nu" || $cod_publico_cond == "nn" || $cod_publico_cond == "ep" || $cod_publico_cond == "ne")
      {
         $this->monta_condicao("cod_publico", $cod_publico_cond, $cod_publico, "", "cod_publico", "INT", false);
      }

      //----- $publico_dsc
      $this->Date_part = false;
      if (isset($publico_dsc) || $publico_dsc_cond == "nu" || $publico_dsc_cond == "nn" || $publico_dsc_cond == "ep" || $publico_dsc_cond == "ne")
      {
         $this->monta_condicao("publico_dsc", $publico_dsc_cond, $publico_dsc, "", "publico_dsc", "VARCHAR", false);
      }

      //----- $cod_hotel
      $this->Date_part = false;
      if (isset($cod_hotel) || $cod_hotel_cond == "nu" || $cod_hotel_cond == "nn" || $cod_hotel_cond == "ep" || $cod_hotel_cond == "ne")
      {
         $this->monta_condicao("cod_hotel", $cod_hotel_cond, $cod_hotel, "", "cod_hotel", "INT", false);
      }

      //----- $hotel_dsc
      $this->Date_part = false;
      if (isset($hotel_dsc) || $hotel_dsc_cond == "nu" || $hotel_dsc_cond == "nn" || $hotel_dsc_cond == "ep" || $hotel_dsc_cond == "ne")
      {
         $this->monta_condicao("hotel_dsc", $hotel_dsc_cond, $hotel_dsc, "", "hotel_dsc", "VARCHAR", false);
      }

      //----- $cod_acomodacao
      $this->Date_part = false;
      if (isset($cod_acomodacao) || $cod_acomodacao_cond == "nu" || $cod_acomodacao_cond == "nn" || $cod_acomodacao_cond == "ep" || $cod_acomodacao_cond == "ne")
      {
         $this->monta_condicao("cod_acomodacao", $cod_acomodacao_cond, $cod_acomodacao, "", "cod_acomodacao", "INT", false);
      }

      //----- $acomodacao_dsc
      $this->Date_part = false;
      if (isset($acomodacao_dsc) || $acomodacao_dsc_cond == "nu" || $acomodacao_dsc_cond == "nn" || $acomodacao_dsc_cond == "ep" || $acomodacao_dsc_cond == "ne")
      {
         $this->monta_condicao("acomodacao_dsc", $acomodacao_dsc_cond, $acomodacao_dsc, "", "acomodacao_dsc", "VARCHAR", false);
      }

      //----- $cod_categoria
      $this->Date_part = false;
      if (isset($cod_categoria) || $cod_categoria_cond == "nu" || $cod_categoria_cond == "nn" || $cod_categoria_cond == "ep" || $cod_categoria_cond == "ne")
      {
         $this->monta_condicao("cod_categoria", $cod_categoria_cond, $cod_categoria, "", "cod_categoria", "INT", false);
      }

      //----- $categoria_dsc
      $this->Date_part = false;
      if (isset($categoria_dsc) || $categoria_dsc_cond == "nu" || $categoria_dsc_cond == "nn" || $categoria_dsc_cond == "ep" || $categoria_dsc_cond == "ne")
      {
         $this->monta_condicao("categoria_dsc", $categoria_dsc_cond, $categoria_dsc, "", "categoria_dsc", "VARCHAR", false);
      }

      //----- $voo_ida
      $this->Date_part = false;
      if (isset($voo_ida) || $voo_ida_cond == "nu" || $voo_ida_cond == "nn" || $voo_ida_cond == "ep" || $voo_ida_cond == "ne")
      {
         $this->monta_condicao("voo_ida", $voo_ida_cond, $voo_ida, "", "voo_ida", "VARCHAR", false);
      }

      //----- $cod_cia_ida
      $this->Date_part = false;
      if (isset($cod_cia_ida) || $cod_cia_ida_cond == "nu" || $cod_cia_ida_cond == "nn" || $cod_cia_ida_cond == "ep" || $cod_cia_ida_cond == "ne")
      {
         $this->monta_condicao("cod_cia_ida", $cod_cia_ida_cond, $cod_cia_ida, "", "cod_cia_ida", "INT", false);
      }

      //----- $dt_checkin
      $this->Date_part = false;
      if ($dt_checkin_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $dt_checkin_cond = strtoupper($dt_checkin_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $dt_checkin_ano;
          $Dtxt .= $dt_checkin_mes;
          $Dtxt .= $dt_checkin_dia;
          $val[0]['ano'] = $dt_checkin_ano;
          $val[0]['mes'] = $dt_checkin_mes;
          $val[0]['dia'] = $dt_checkin_dia;
          if ($dt_checkin_cond == "BW")
          {
              $val[1]['ano'] = $dt_checkin_input_2_ano;
              $val[1]['mes'] = $dt_checkin_input_2_mes;
              $val[1]['dia'] = $dt_checkin_input_2_dia;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->nm_prep_date($val, "DT", "DATETIME", $dt_checkin_cond, "", "data");
          }
          else
          {
              $this->nm_prep_date($val, "DT", "DATE", $dt_checkin_cond, "", "data");
          }
          if (!$this->Date_part) {
              $val[0] = $this->Ini->sc_Date_Protect($val[0]);
          }
          $dt_checkin = $val[0];
          $this->cmp_formatado['dt_checkin'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkin'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['dt_checkin'], "YYYY-MM-DD");
          $this->cmp_formatado['dt_checkin'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['dt_checkin'] = "'" . $this->cmp_formatado['dt_checkin'] . "'";
          if ($dt_checkin_cond == "BW")
          {
              if (!$this->Date_part) {
                  $val[1] = $this->Ini->sc_Date_Protect($val[1]);
              }
              $dt_checkin_input_2     = $val[1];
              $this->cmp_formatado['dt_checkin_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkin_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['dt_checkin_input_2'], "YYYY-MM-DD");
              $this->cmp_formatado['dt_checkin_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['dt_checkin_input_2'] = "'" . $this->cmp_formatado['dt_checkin_input_2'] . "'";
          }
          if (!empty($Dtxt) || $dt_checkin_cond == "NU" || $dt_checkin_cond == "NN"|| $dt_checkin_cond == "EP"|| $dt_checkin_cond == "NE")
          {
              $this->monta_condicao("dt_checkin", $dt_checkin_cond, $dt_checkin, $dt_checkin_input_2, 'dt_checkin', 'DATE');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['dt_checkin']['label'] = $nmgp_tab_label['dt_checkin'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['dt_checkin']['descr'] = $nmgp_tab_label['dt_checkin'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['dt_checkin']['hint']  = $nmgp_tab_label['dt_checkin'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $hr_transferin
      $this->Date_part = false;
      if ($hr_transferin_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $hr_transferin_cond = strtoupper($hr_transferin_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $hr_transferin_hor;
          $Dtxt .= $hr_transferin_min;
          $Dtxt .= $hr_transferin_seg;
          $val[0]['hor'] = $hr_transferin_hor;
          $val[0]['min'] = $hr_transferin_min;
          $val[0]['seg'] = $hr_transferin_seg;
          if ($hr_transferin_cond == "BW")
          {
              $val[1]['ano'] = $hr_transferin_input_2_ano;
              $val[1]['mes'] = $hr_transferin_input_2_mes;
              $val[1]['dia'] = $hr_transferin_input_2_dia;
              $val[1]['hor'] = $hr_transferin_input_2_hor;
              $val[1]['min'] = $hr_transferin_input_2_min;
              $val[1]['seg'] = $hr_transferin_input_2_seg;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          $this->nm_prep_date($val, "HH", "TIME", $hr_transferin_cond, "", "hora");
          $hr_transferin = $val[0];
          $this->cmp_formatado['hr_transferin'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hr_transferin'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['hr_transferin'], "HH:II:SS");
          $this->cmp_formatado['hr_transferin'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "his"));
          $this->cmp_formatado['hr_transferin'] = "'" . $this->cmp_formatado['hr_transferin'] . "'";
          if ($hr_transferin_cond == "BW")
          {
              $hr_transferin_input_2     = $val[1];
              $this->cmp_formatado['hr_transferin_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hr_transferin_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['hr_transferin_input_2'], "HH:II:SS");
              $this->cmp_formatado['hr_transferin_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "his"));
          $this->cmp_formatado['hr_transferin_input_2'] = "'" . $this->cmp_formatado['hr_transferin_input_2'] . "'";
          }
          if (!empty($Dtxt) || $hr_transferin_cond == "NU" || $hr_transferin_cond == "NN"|| $hr_transferin_cond == "EP"|| $hr_transferin_cond == "NE")
          {
              $this->monta_condicao("hr_transferin", $hr_transferin_cond, $hr_transferin, $hr_transferin_input_2, 'hr_transferin', 'TIME');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['hr_transferin']['label'] = $nmgp_tab_label['hr_transferin'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['hr_transferin']['descr'] = $nmgp_tab_label['hr_transferin'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['hr_transferin']['hint']  = $nmgp_tab_label['hr_transferin'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $voo_volta
      $this->Date_part = false;
      if (isset($voo_volta) || $voo_volta_cond == "nu" || $voo_volta_cond == "nn" || $voo_volta_cond == "ep" || $voo_volta_cond == "ne")
      {
         $this->monta_condicao("voo_volta", $voo_volta_cond, $voo_volta, "", "voo_volta", "VARCHAR", false);
      }

      //----- $cod_cia_volta
      $this->Date_part = false;
      if (isset($cod_cia_volta) || $cod_cia_volta_cond == "nu" || $cod_cia_volta_cond == "nn" || $cod_cia_volta_cond == "ep" || $cod_cia_volta_cond == "ne")
      {
         $this->monta_condicao("cod_cia_volta", $cod_cia_volta_cond, $cod_cia_volta, "", "cod_cia_volta", "INT", false);
      }

      //----- $forma_pgto
      $this->Date_part = false;
      if (isset($forma_pgto) || $forma_pgto_cond == "nu" || $forma_pgto_cond == "nn" || $forma_pgto_cond == "ep" || $forma_pgto_cond == "ne")
      {
         $this->monta_condicao("forma_pgto", $forma_pgto_cond, $forma_pgto, "", "forma_pgto", "VARCHAR", false);
      }

      //----- $dt_checkout
      $this->Date_part = false;
      if ($dt_checkout_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $dt_checkout_cond = strtoupper($dt_checkout_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $dt_checkout_ano;
          $Dtxt .= $dt_checkout_mes;
          $Dtxt .= $dt_checkout_dia;
          $val[0]['ano'] = $dt_checkout_ano;
          $val[0]['mes'] = $dt_checkout_mes;
          $val[0]['dia'] = $dt_checkout_dia;
          if ($dt_checkout_cond == "BW")
          {
              $val[1]['ano'] = $dt_checkout_input_2_ano;
              $val[1]['mes'] = $dt_checkout_input_2_mes;
              $val[1]['dia'] = $dt_checkout_input_2_dia;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->nm_prep_date($val, "DT", "DATETIME", $dt_checkout_cond, "", "data");
          }
          else
          {
              $this->nm_prep_date($val, "DT", "DATE", $dt_checkout_cond, "", "data");
          }
          if (!$this->Date_part) {
              $val[0] = $this->Ini->sc_Date_Protect($val[0]);
          }
          $dt_checkout = $val[0];
          $this->cmp_formatado['dt_checkout'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkout'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['dt_checkout'], "YYYY-MM-DD");
          $this->cmp_formatado['dt_checkout'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['dt_checkout'] = "'" . $this->cmp_formatado['dt_checkout'] . "'";
          if ($dt_checkout_cond == "BW")
          {
              if (!$this->Date_part) {
                  $val[1] = $this->Ini->sc_Date_Protect($val[1]);
              }
              $dt_checkout_input_2     = $val[1];
              $this->cmp_formatado['dt_checkout_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['dt_checkout_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['dt_checkout_input_2'], "YYYY-MM-DD");
              $this->cmp_formatado['dt_checkout_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['dt_checkout_input_2'] = "'" . $this->cmp_formatado['dt_checkout_input_2'] . "'";
          }
          if (!empty($Dtxt) || $dt_checkout_cond == "NU" || $dt_checkout_cond == "NN"|| $dt_checkout_cond == "EP"|| $dt_checkout_cond == "NE")
          {
              $this->monta_condicao("dt_checkout", $dt_checkout_cond, $dt_checkout, $dt_checkout_input_2, 'dt_checkout', 'DATE');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['dt_checkout']['label'] = $nmgp_tab_label['dt_checkout'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['dt_checkout']['descr'] = $nmgp_tab_label['dt_checkout'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['dt_checkout']['hint']  = $nmgp_tab_label['dt_checkout'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $intervalo_trout
      $this->Date_part = false;
      if ($intervalo_trout_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $intervalo_trout_cond = strtoupper($intervalo_trout_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $intervalo_trout_hor;
          $Dtxt .= $intervalo_trout_min;
          $Dtxt .= $intervalo_trout_seg;
          $val[0]['hor'] = $intervalo_trout_hor;
          $val[0]['min'] = $intervalo_trout_min;
          $val[0]['seg'] = $intervalo_trout_seg;
          if ($intervalo_trout_cond == "BW")
          {
              $val[1]['ano'] = $intervalo_trout_input_2_ano;
              $val[1]['mes'] = $intervalo_trout_input_2_mes;
              $val[1]['dia'] = $intervalo_trout_input_2_dia;
              $val[1]['hor'] = $intervalo_trout_input_2_hor;
              $val[1]['min'] = $intervalo_trout_input_2_min;
              $val[1]['seg'] = $intervalo_trout_input_2_seg;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          $this->nm_prep_date($val, "HH", "TIME", $intervalo_trout_cond, "", "hora");
          $intervalo_trout = $val[0];
          $this->cmp_formatado['intervalo_trout'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['intervalo_trout'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['intervalo_trout'], "HH:II:SS");
          $this->cmp_formatado['intervalo_trout'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "his"));
          $this->cmp_formatado['intervalo_trout'] = "'" . $this->cmp_formatado['intervalo_trout'] . "'";
          if ($intervalo_trout_cond == "BW")
          {
              $intervalo_trout_input_2     = $val[1];
              $this->cmp_formatado['intervalo_trout_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['intervalo_trout_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['intervalo_trout_input_2'], "HH:II:SS");
              $this->cmp_formatado['intervalo_trout_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "his"));
          $this->cmp_formatado['intervalo_trout_input_2'] = "'" . $this->cmp_formatado['intervalo_trout_input_2'] . "'";
          }
          if (!empty($Dtxt) || $intervalo_trout_cond == "NU" || $intervalo_trout_cond == "NN"|| $intervalo_trout_cond == "EP"|| $intervalo_trout_cond == "NE")
          {
              $this->monta_condicao("intervalo_trout", $intervalo_trout_cond, $intervalo_trout, $intervalo_trout_input_2, 'intervalo_trout', 'TIME');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['intervalo_trout']['label'] = $nmgp_tab_label['intervalo_trout'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['intervalo_trout']['descr'] = $nmgp_tab_label['intervalo_trout'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['intervalo_trout']['hint']  = $nmgp_tab_label['intervalo_trout'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $hr_transferout
      $this->Date_part = false;
      if ($hr_transferout_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $hr_transferout_cond = strtoupper($hr_transferout_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $hr_transferout_hor;
          $Dtxt .= $hr_transferout_min;
          $Dtxt .= $hr_transferout_seg;
          $val[0]['hor'] = $hr_transferout_hor;
          $val[0]['min'] = $hr_transferout_min;
          $val[0]['seg'] = $hr_transferout_seg;
          if ($hr_transferout_cond == "BW")
          {
              $val[1]['ano'] = $hr_transferout_input_2_ano;
              $val[1]['mes'] = $hr_transferout_input_2_mes;
              $val[1]['dia'] = $hr_transferout_input_2_dia;
              $val[1]['hor'] = $hr_transferout_input_2_hor;
              $val[1]['min'] = $hr_transferout_input_2_min;
              $val[1]['seg'] = $hr_transferout_input_2_seg;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          $this->nm_prep_date($val, "HH", "TIME", $hr_transferout_cond, "", "hora");
          $hr_transferout = $val[0];
          $this->cmp_formatado['hr_transferout'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hr_transferout'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['hr_transferout'], "HH:II:SS");
          $this->cmp_formatado['hr_transferout'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "his"));
          $this->cmp_formatado['hr_transferout'] = "'" . $this->cmp_formatado['hr_transferout'] . "'";
          if ($hr_transferout_cond == "BW")
          {
              $hr_transferout_input_2     = $val[1];
              $this->cmp_formatado['hr_transferout_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']['hr_transferout_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['hr_transferout_input_2'], "HH:II:SS");
              $this->cmp_formatado['hr_transferout_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "his"));
          $this->cmp_formatado['hr_transferout_input_2'] = "'" . $this->cmp_formatado['hr_transferout_input_2'] . "'";
          }
          if (!empty($Dtxt) || $hr_transferout_cond == "NU" || $hr_transferout_cond == "NN"|| $hr_transferout_cond == "EP"|| $hr_transferout_cond == "NE")
          {
              $this->monta_condicao("hr_transferout", $hr_transferout_cond, $hr_transferout, $hr_transferout_input_2, 'hr_transferout', 'TIME');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['hr_transferout']['label'] = $nmgp_tab_label['hr_transferout'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['hr_transferout']['descr'] = $nmgp_tab_label['hr_transferout'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['grid_pesq']['hr_transferout']['hint']  = $nmgp_tab_label['hr_transferout'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $tipo_pessoa
      $this->Date_part = false;
      if (isset($tipo_pessoa) || $tipo_pessoa_cond == "nu" || $tipo_pessoa_cond == "nn" || $tipo_pessoa_cond == "ep" || $tipo_pessoa_cond == "ne")
      {
         $this->monta_condicao("tipo_pessoa", $tipo_pessoa_cond, $tipo_pessoa, "", "tipo_pessoa", "VARCHAR", false);
      }

      //----- $tipo_transfer
      $this->Date_part = false;
      if (isset($tipo_transfer) || $tipo_transfer_cond == "nu" || $tipo_transfer_cond == "nn" || $tipo_transfer_cond == "ep" || $tipo_transfer_cond == "ne")
      {
         $this->monta_condicao("tipo_transfer", $tipo_transfer_cond, $tipo_transfer, "", "tipo_transfer", "VARCHAR", false);
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
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq_grid'] = $this->comando;
       if (empty($this->comando)) 
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq_filtro'] = "";
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_orig'];
       }
       else
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq_filtro'] = "( " . $this->comando . " )";
           if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_orig'])) 
           {
               $this->comando = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_orig'] . " and (" . $this->comando . ")"; 
           }
           else
           {
               $this->comando = " where " . $this->comando; 
           }
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq'] = $this->comando;
       }
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq_fast'])) 
       {
           if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq'])) 
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq'] .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq_fast'] . ")";
           }
           else 
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq'] = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq_fast'] . ")";
           }
       }
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq_interativ'])) 
       {
           if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq'])) 
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq'] .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq_interativ'] . ")";
           }
           else 
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq'] = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq_interativ'];
           }
       }
   }
   function finaliza_resultado()
   {
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['dyn_search']      = array();
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['cond_dyn_search'] = "";
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq_fast'] = "";
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['fast_search']);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq_interativ'] = "";
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['interativ_search'] = array();
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['int_search_dados'] = array();
      if ("" == $this->comando_filtro)
      {
          $this->comando = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_orig'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']) && $_SESSION['scriptcase']['charset'] != "UTF-8")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca'], "UTF-8", $_SESSION['scriptcase']['charset']);
      }

      $this->Sel_case_sensitive($this->comando);
      $this->Sel_case_sensitive($this->comando_sum);
      $this->Sel_case_sensitive($this->comando_filtro);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq_grid']    = $this->comando_filtro;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq_lookup']  = $this->comando_sum . $this->comando_fim;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq']         = $this->comando . $this->comando_fim;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['opcao']              = "pesq";
      if ("" == $this->comando_filtro)
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq_filtro'] = "";
      }
      else
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq_filtro'] = " (" . trim($this->comando_filtro) . ")";
      }
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['cond_pesq'] .= $this->NM_operador;
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['contr_array_resumo'] = "NAO";
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['contr_total_geral']  = "NAO";
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['tot_geral']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['using_summary_cache']);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq'];

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
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'off';
}


function PrepRoom2($vp_evento,$vp_usuario,$vp_tipoPessoa,$vp_nivel) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'on';
  		
		
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
      $rsm = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsm[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsm = false;
          $rsm_erro = $this->Db->ErrorMsg();
      } 
	                                                                                      
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
                                                                                    
		$reg_mestre = sizeof($rsm );		                                                                                    
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
				
				$w_hosp_cpf_participante	= $rsm[$i][0];		
				$w_hosp_id_evento		    = $rsm[$i][1];     
				$w_hosp_acompanhante	    = $rsm[$i][2];     
				$w_hosp_part_acomp     	    = $rsm[$i][3];     
				$w_hosp_id_hotel		    = $rsm[$i][4];     
				$w_hosp_acomodacao		 	= $rsm[$i][5];     
				$w_hosp_categoria  		    = $rsm[$i][6];     
				$w_hosp_dt_checkin		 	= $rsm[$i][7];     
				$w_hosp_dt_checkout   	 	= $rsm[$i][8];     
				$w_hosp_early_chkin  	    = $rsm[$i][9];     
				$w_hosp_late_chkout 	    = $rsm[$i][10];    
				$w_hosp_pagamentos 		    = $rsm[$i][11];    
				$w_hosp_observacoes		    = $rsm[$i][12];    
				$w_hosp_dsc_pacote          = $rsm[$i][13];    
				$w_tra_numvoo_ida	        = $rsm[$i][14];	
				$w_tra_cia_ida   		    = $rsm[$i][15];	
				$w_tra_hr_saida_ida         = $rsm[$i][16];	
				$w_tra_numvoo_volta         = $rsm[$i][17];	
				$w_tra_cia_volta		    = $rsm[$i][18];	
				$w_tra_hr_saida_volta 	  	= $rsm[$i][19];    
				$w_tra_hrtransout		    = $rsm[$i][20];	
				$w_tra_tipotransfer			= $rsm[$i][21];    
				$f_tra_direcao				= $rsm[$i][22];	
				$f_tra_id_hotel				= $rsm[$i][23];    
				$w_hosp_acmq_01				= $rsm[$i][24];	
				$w_hosp_acmq_02				= $rsm[$i][25];    
				$w_hosp_acmq_03				= $rsm[$i][26];    
				$w_hosp_acmq_04				= $rsm[$i][27];    
				$w_hosp_pamq_01				= $rsm[$i][28];    
				$w_hosp_pamq_02				= $rsm[$i][29];    
				$w_hosp_pamq_03				= $rsm[$i][30];    
				$w_hosp_pamq_04				= $rsm[$i][31];	

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
      $rspart = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspart[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspart = false;
          $rspart_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rspart[0][0])) {											
					$w_nome				   		= $rspart[0][0];			  	             
					$w_part_passaporte     		= $rspart[0][1];    	     
					$w_part_rg             		= $rspart[0][2];    	
					$w_part_dt_nasc        		= $rspart[0][3];  	
					$w_part_ddd_celular_01 		= $rspart[0][4];  	      
					$w_part_celeular_01      	= $rspart[0][5]; 
					$w_part_email            	= $rspart[0][6];    
					$w_part_id_evento_publico	= $rspart[0][7];   
					$w_empresa					= $rspart[0][9];
					$w_grupo					= $rspart[0][10];
					$w_cargo					= $rspart[0][11];
					$w_tipopess 				= 'PARTICIPANTE';
					$w_foneinter				= $rspart[0][12];
					$w_dsc_emp_rsvp				= $rspart[0][13];					
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
      $rspart = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspart[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspart = false;
          $rspart_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rspart[0][0])) {											
						$w_nome				   		= $rspart[0][0];			  	             
						$w_part_passaporte     		= $rspart[0][1];    	     
						$w_part_rg             		= $rspart[0][2];    	
						$w_part_dt_nasc        		= $rspart[0][3];  	
						$w_part_ddd_celular_01 		= $rspart[0][4];  	      
						$w_part_celeular_01      	= $rspart[0][5]; 
						$w_part_email            	= $rspart[0][6];    
						$w_part_id_evento_publico	= $rspart[0][7];  
						$w_empresa					= $rspart[0][9];
						$w_grupo					= $rspart[0][10];
						$w_cargo					= $rspart[0][11];
						$w_tipopess 				= 'ACOMPANHANTE';
						$w_foneinter				= $rspart[0][12];
						$w_dsc_emp_rsvp				= $rspart[0][13];
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
      $rsusu = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsusu[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsusu = false;
          $rsusu_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rsusu[0][0])) {									                                                                            
					$w_usurelDsc = $rsusu[0][1];                                                                                  
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
      $rseve = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rseve[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rseve = false;
          $rseve_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rseve[0][0])) {									                                                                            
					$w_eventoDsc = $rseve[0][1];                                                                                  
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
      $rspgt = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspgt[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspgt = false;
          $rspgt_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rspgt[0][0])) {									                                                                            
					$w_pagtoDsc = $rspgt[0][1];                                                                                  
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
      $rscia = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rscia[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rscia = false;
          $rscia_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rscia[0][0])) {									                                                                            
					$w_ciaida = $rscia[0][1];                                                                                  
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
      $rscia = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rscia[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rscia = false;
          $rscia_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rscia[0][0])) {									                                                                            
					$w_ciavolta = $rscia[0][1];                                                                                  
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
      $rsaco = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsaco[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsaco = false;
          $rsaco_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rsaco[0][0])) {									                                                                            
					$w_acomodacao = $rsaco[0][1];                                                                                  
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
      $rscat = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rscat[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rscat = false;
          $rscat_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rscat[0][0])) {									                                                                            
					$w_categoria = $rscat[0][1];                                                                                  
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
      $rspub = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspub[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspub = false;
          $rspub_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rspub[0][0])) {									                                                                            
					$w_publico = $rspub[0][1];                                                                                  
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
      $rshot = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rshot[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rshot = false;
          $rshot_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rshot[0][0])) {									                                                                            
					$w_hotel_dsc = $rshot[0][1];                                                                                  
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
      $rsanot = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsanot[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsanot = false;
          $rsanot_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rsanot[0][0])) {
					$w_anotacao = $rsanot[0][2];
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
      $rspacm = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspacm[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspacm = false;
          $rspacm_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rspacm[0][0])) {									                                                                            
						$w_cpf_mestre = $rspacm[0][1];                                                                                
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
      $rspcpf = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspcpf[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspcpf = false;
          $rspcpf_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
						if (isset($rspcpf[0][0])) {									                                                                            										
							$w_acompanhado = $rspcpf[0][1]; 					
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
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_acmq_nome_01		= $rsplhac[0][1];	
						$w_acmq_cpf_01		= $w_hosp_acmq_01;
						$w_acmq_dtnasc_01 	= $rsplhac[0][2];
						$w_acmq_rg_01		= $rsplhac[0][3];
						$w_acmq_docest_01	= $rsplhac[0][4];				
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
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_acmq_nome_02		= $rsplhac[0][1];	
						$w_acmq_cpf_02		= $w_hosp_acmq_02;
						$w_acmq_dtnasc_02 	= $rsplhac[0][2];
						$w_acmq_rg_02		= $rsplhac[0][3];
						$w_acmq_docest_02	= $rsplhac[0][4];				
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
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_acmq_nome_03		= $rsplhac[0][1];	
						$w_acmq_cpf_03		= $w_hosp_acmq_03;
						$w_acmq_dtnasc_03 	= $rsplhac[0][2];
						$w_acmq_rg_03		= $rsplhac[0][3];
						$w_acmq_docest_03	= $rsplhac[0][4];				
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
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_acmq_nome_04		= $rsplhac[0][1];	
						$w_acmq_cpf_04		= $w_hosp_acmq_04;
						$w_acmq_dtnasc_04 	= $rsplhac[0][2];
						$w_acmq_rg_04		= $rsplhac[0][3];
						$w_acmq_docest_04	= $rsplhac[0][4];				
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
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_pamq_nome_01		= $rsplhac[0][1];	
						$w_pamq_cpf_01		= $w_hosp_pamq_01;
						$w_pamq_dtnasc_01 	= $rsplhac[0][2];
						$w_pamq_rg_01		= $rsplhac[0][3];
						$w_pamq_docest_01	= $rsplhac[0][4];				
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
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_pamq_nome_02		= $rsplhac[0][1];	
						$w_pamq_cpf_02		= $w_hosp_pamq_02;
						$w_pamq_dtnasc_02 	= $rsplhac[0][2];
						$w_pamq_rg_04		= $rsplhac[0][3];
						$w_pamq_docest_02	= $rsplhac[0][4];				
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
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_pamq_nome_03		= $rsplhac[0][1];	
						$w_pamq_cpf_03		= $w_hosp_pamq_03;
						$w_pamq_dtnasc_03 	= $rsplhac[0][2];
						$w_pamq_rg_03		= $rsplhac[0][3];
						$w_pamq_docest_03	= $rsplhac[0][4];				
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
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_pamq_nome_04		= $rsplhac[0][1];	
						$w_pamq_cpf_04		= $w_hosp_pamq_04;
						$w_pamq_dtnasc_04 	= $rsplhac[0][2];
						$w_pamq_rg_04		= $rsplhac[0][3];
						$w_pamq_docest_04	= $rsplhac[0][4];				
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
      $rsnoinc = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsnoinc[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsnoinc = false;
          $rsnoinc_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rsnoinc[0][0])) {															
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
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'off';
}


function PrepRoom3($vp_evento,$vp_usuario,$vp_tipoPessoa,$vp_nivel) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'on';
  		
		
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
      $rsm = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsm[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsm = false;
          $rsm_erro = $this->Db->ErrorMsg();
      } 
	                                                                                      
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
                                                                                    
		$reg_mestre = sizeof($rsm );		                                                                                    
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
				 				
				$w_hosp_cpf_participante	= $rsm[$i][0];		     					                 
				$w_hosp_id_evento		    = $rsm[$i][1];               
				$w_hosp_acompanhante	    = $rsm[$i][2];            
				$w_hosp_part_acomp     	    = $rsm[$i][3];            
				$w_hosp_id_hotel		    = $rsm[$i][4];                  
				$w_hosp_acomodacao		 	= $rsm[$i][5];              
				$w_hosp_categoria  		    = $rsm[$i][6];              
				$w_hosp_dt_checkin		 	= $rsm[$i][7];            	   		
				$w_hosp_dt_checkout   	 	= $rsm[$i][8];           
				$w_hosp_early_chkin  	    = $rsm[$i][9];           
				$w_hosp_late_chkout 	    = $rsm[$i][10];           
				$w_hosp_pagamentos 		    = $rsm[$i][11];            
				$w_hosp_observacoes		    = $rsm[$i][12];             
				$w_hosp_dsc_pacote          = $rsm[$i][13];               
				$w_hosp_acmq_01				= $rsm[$i][14];	
				$w_hosp_acmq_02				= $rsm[$i][15];    
				$w_hosp_acmq_03				= $rsm[$i][16];    
				$w_hosp_acmq_04				= $rsm[$i][17];    
				$w_hosp_pamq_01				= $rsm[$i][18];    
				$w_hosp_pamq_02				= $rsm[$i][19];    
				$w_hosp_pamq_03				= $rsm[$i][20];    
				$w_hosp_pamq_04				= $rsm[$i][21];	  							
			
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
      $rspart = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspart[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspart = false;
          $rspart_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rspart[0][0])) {											
					$w_nome				   		= $rspart[0][0];			  	             
					$w_part_passaporte     		= $rspart[0][1];    	     
					$w_part_rg             		= $rspart[0][2];    	
					$w_part_dt_nasc        		= $rspart[0][3];  	
					$w_part_ddd_celular_01 		= $rspart[0][4];  	      
					$w_part_celeular_01      	= $rspart[0][5]; 
					$w_part_email            	= $rspart[0][6];    
					$w_part_id_evento_publico	= $rspart[0][7];   	
					$w_empresa					= $rspart[0][9]; 
					$w_grupo					= $rspart[0][10]; 
					$w_cargo					= $rspart[0][11]; 
					$w_tipopess = 'PARTICIPANTE';		
					$w_foneinter				= $rspart[0][12];
					$w_dsc_emp_rsvp				= $rspart[0][13];
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
      $rspart = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspart[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspart = false;
          $rspart_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rspart[0][0])) {											
						$w_nome				   		= $rspart[0][0];			  	             
						$w_part_passaporte     		= $rspart[0][1];    	     
						$w_part_rg             		= $rspart[0][2];    	
						$w_part_dt_nasc        		= $rspart[0][3];  	
						$w_part_ddd_celular_01 		= $rspart[0][4];  	      
						$w_part_celeular_01      	= $rspart[0][5]; 
						$w_part_email            	= $rspart[0][6];    
						$w_part_id_evento_publico	= $rspart[0][7]; 
						$w_empresa					= $rspart[0][9];
						$w_grupo					= $rspart[0][10]; 
						$w_cargo					= $rspart[0][11]; 
						$w_tipopess = 'ACOMPANHANTE';			
						$w_foneinter				= $rspart[0][12];
						$w_dsc_emp_rsvp				= $rspart[0][13];
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
      $rsusu = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsusu[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsusu = false;
          $rsusu_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rsusu[0][0])) {									                                                                            
					$w_usurelDsc = $rsusu[0][1];                                                                                  
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
      $rseve = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rseve[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rseve = false;
          $rseve_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rseve[0][0])) {									                                                                            
					$w_eventoDsc = $rseve[0][1];                                                                                  
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
      $rspgt = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspgt[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspgt = false;
          $rspgt_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rspgt[0][0])) {									                                                                            
					$w_pagtoDsc = $rspgt[0][1];                                                                                  
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
      $rsaco = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsaco[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsaco = false;
          $rsaco_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rsaco[0][0])) {									                                                                            
					$w_acomodacao = $rsaco[0][1];                                                                                  
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
      $rscat = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rscat[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rscat = false;
          $rscat_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rscat[0][0])) {									                                                                            
					$w_categoria = $rscat[0][1];                                                                                  
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
      $rspub = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspub[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspub = false;
          $rspub_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rspub[0][0])) {									                                                                            
					$w_publico = $rspub[0][1];                                                                                  
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
      $rshot = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rshot[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rshot = false;
          $rshot_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rshot[0][0])) {									                                                                            
					$w_hotel_dsc = $rshot[0][1];                                                                                  
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
      $rsanot = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsanot[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsanot = false;
          $rsanot_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rsanot[0][0])) {
					$w_anotacao = $rsanot[0][2];
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
      $rspacm = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspacm[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspacm = false;
          $rspacm_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rspacm[0][0])) {									                                                                            
						$w_cpf_mestre = $rspacm[0][1];                                                                                
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
      $rspcpf = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspcpf[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspcpf = false;
          $rspcpf_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
						if (isset($rspcpf[0][0])) {									                                                                            										
							$w_acompanhado = $rspcpf[0][1]; 					
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
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_acmq_nome_01		= $rsplhac[0][1];	
						$w_acmq_cpf_01		= $w_hosp_acmq_01;
						$w_acmq_dtnasc_01 	= $rsplhac[0][2];
						$w_acmq_rg_01		= $rsplhac[0][3];
						$w_acmq_docest_01	= $rsplhac[0][4];				
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
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_acmq_nome_02		= $rsplhac[0][1];	
						$w_acmq_cpf_02		= $w_hosp_acmq_02;
						$w_acmq_dtnasc_02 	= $rsplhac[0][2];
						$w_acmq_rg_02		= $rsplhac[0][3];
						$w_acmq_docest_02	= $rsplhac[0][4];				
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
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_acmq_nome_03		= $rsplhac[0][1];	
						$w_acmq_cpf_03		= $w_hosp_acmq_03;
						$w_acmq_dtnasc_03 	= $rsplhac[0][2];
						$w_acmq_rg_03		= $rsplhac[0][3];
						$w_acmq_docest_03	= $rsplhac[0][4];				
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
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_acmq_nome_04		= $rsplhac[0][1];	
						$w_acmq_cpf_04		= $w_hosp_acmq_04;
						$w_acmq_dtnasc_04 	= $rsplhac[0][2];
						$w_acmq_rg_04		= $rsplhac[0][3];
						$w_acmq_docest_04	= $rsplhac[0][4];				
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
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_pamq_nome_01		= $rsplhac[0][1];	
						$w_pamq_cpf_01		= $w_hosp_pamq_01;
						$w_pamq_dtnasc_01 	= $rsplhac[0][2];
						$w_pamq_rg_01		= $rsplhac[0][3];
						$w_pamq_docest_01	= $rsplhac[0][4];				
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
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_pamq_nome_02		= $rsplhac[0][1];	
						$w_pamq_cpf_02		= $w_hosp_pamq_02;
						$w_pamq_dtnasc_02 	= $rsplhac[0][2];
						$w_pamq_rg_04		= $rsplhac[0][3];
						$w_pamq_docest_02	= $rsplhac[0][4];				
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
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_pamq_nome_03		= $rsplhac[0][1];	
						$w_pamq_cpf_03		= $w_hosp_pamq_03;
						$w_pamq_dtnasc_03 	= $rsplhac[0][2];
						$w_pamq_rg_03		= $rsplhac[0][3];
						$w_pamq_docest_03	= $rsplhac[0][4];				
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
      $rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsplhac = false;
          $rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rsplhac[0][0])) {											
						$w_pamq_nome_04		= $rsplhac[0][1];	
						$w_pamq_cpf_04		= $w_hosp_pamq_04;
						$w_pamq_dtnasc_04 	= $rsplhac[0][2];
						$w_pamq_rg_04		= $rsplhac[0][3];
						$w_pamq_docest_04	= $rsplhac[0][4];				
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
      $rsnoinc = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsnoinc[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsnoinc = false;
          $rsnoinc_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rsnoinc[0][0])) {															
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
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'off';
}


function RetNivelUpd($nivel) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'off';
}

}

?>
