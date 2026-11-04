<?php

class grid_geral_rsvp_r_pesq
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['path_libs_php'] = $this->Ini->path_lib_php;
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'] = array(); 
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
                      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'][$field] = $arr_tmp; 
                  }
                  else
                  {
                      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'][$field] = $cada_dado['value']; 
                  }
              }
          }
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'], $_SESSION['scriptcase']['charset'], "UTF-8");
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = "igual";
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
                  $Opt_filter .= "<option value=\"\">" . grid_geral_rsvp_r_pack_protect_string($Nome_filter) . "</option>\r\n";
              }
              $Opt_filter .= "<option value=\"" . grid_geral_rsvp_r_pack_protect_string($Tipo_filter[0]) . "\">.." . htmlspecialchars($Cada_filter).  "</option>\r\n";
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
                  $Opt_filter .= "<option value=\"\">" .  grid_geral_rsvp_r_pack_protect_string($Nome_filter) . "</option>\r\n";
              }
              $Opt_filter .= "<option value=\"" . grid_geral_rsvp_r_pack_protect_string($Tipo_filter[0]) . "\">.." . grid_geral_rsvp_r_pack_protect_string($Cada_filter) .  "</option>\r\n";
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

      if ($this->NM_ajax_opcao == 'autocomp_evento_dsc')
      {
          $evento_dsc = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_evento_dsc($evento_dsc);
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
      if ($this->NM_ajax_opcao == 'autocomp_nome_participante')
      {
          $nome_participante = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_nome_participante($nome_participante);
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
      if ($this->NM_ajax_opcao == 'autocomp_comprado_bvt')
      {
          $comprado_bvt = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_comprado_bvt($comprado_bvt);
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
      if ($this->NM_ajax_opcao == 'autocomp_regional_dsc')
      {
          $regional_dsc = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_regional_dsc($regional_dsc);
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
      if ($this->NM_ajax_opcao == 'autocomp_cidade')
      {
          $cidade = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_cidade($cidade);
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
      if ($this->NM_ajax_opcao == 'autocomp_presenca')
      {
          $presenca = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_presenca($presenca);
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
      if ($this->NM_ajax_opcao == 'autocomp_contato')
      {
          $contato = ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($_GET['q'])) ? sc_convert_encoding($_GET['q'], $_SESSION['scriptcase']['charset'], "UTF-8") : $_GET['q'];
          $nmgp_def_dados = $this->lookup_ajax_contato($contato);
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
   function lookup_ajax_evento_dsc($evento_dsc)
   {
      $evento_dsc = substr($this->Db->qstr($evento_dsc), 1, -1);
            $evento_dsc_look = (is_string($evento_dsc) ? substr($this->Db->qstr($evento_dsc), 1, -1) : $evento_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct evento_dsc from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#evento_dsc#lowerF# like #lowerI#'%" . $evento_dsc . "%'#lowerF# order by evento_dsc"; 
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
      $nm_comando = "select distinct cpf from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#cpf#lowerF# like #lowerI#'%" . $cpf . "%'#lowerF# order by cpf"; 
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
   
   function lookup_ajax_nome_participante($nome_participante)
   {
      $nome_participante = substr($this->Db->qstr($nome_participante), 1, -1);
            $nome_participante_look = (is_string($nome_participante) ? substr($this->Db->qstr($nome_participante), 1, -1) : $nome_participante); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct nome_participante from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#nome_participante#lowerF# like #lowerI#'%" . $nome_participante . "%'#lowerF# order by nome_participante"; 
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
      $nm_comando = "select distinct tipo_pessoa from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#tipo_pessoa#lowerF# like #lowerI#'%" . $tipo_pessoa . "%'#lowerF# order by tipo_pessoa"; 
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
      $nm_comando = "select distinct hotel_dsc from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#hotel_dsc#lowerF# like #lowerI#'%" . $hotel_dsc . "%'#lowerF# order by hotel_dsc"; 
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
   
   function lookup_ajax_comprado_bvt($comprado_bvt)
   {
      $comprado_bvt = substr($this->Db->qstr($comprado_bvt), 1, -1);
            $comprado_bvt_look = (is_string($comprado_bvt) ? substr($this->Db->qstr($comprado_bvt), 1, -1) : $comprado_bvt); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct comprado_bvt from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#comprado_bvt#lowerF# like #lowerI#'%" . $comprado_bvt . "%'#lowerF# order by comprado_bvt"; 
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
      $nm_comando = "select distinct publico_dsc from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#publico_dsc#lowerF# like #lowerI#'%" . $publico_dsc . "%'#lowerF# order by publico_dsc"; 
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
   
   function lookup_ajax_regional_dsc($regional_dsc)
   {
      $regional_dsc = substr($this->Db->qstr($regional_dsc), 1, -1);
            $regional_dsc_look = (is_string($regional_dsc) ? substr($this->Db->qstr($regional_dsc), 1, -1) : $regional_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct regional_dsc from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#regional_dsc#lowerF# like #lowerI#'%" . $regional_dsc . "%'#lowerF# order by regional_dsc"; 
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
   
   function lookup_ajax_cidade($cidade)
   {
      $cidade = substr($this->Db->qstr($cidade), 1, -1);
            $cidade_look = (is_string($cidade) ? substr($this->Db->qstr($cidade), 1, -1) : $cidade); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct cidade from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#cidade#lowerF# like #lowerI#'%" . $cidade . "%'#lowerF# order by cidade"; 
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
   
   function lookup_ajax_presenca($presenca)
   {
      $presenca = substr($this->Db->qstr($presenca), 1, -1);
            $presenca_look = (is_string($presenca) ? substr($this->Db->qstr($presenca), 1, -1) : $presenca); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct presenca from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#presenca#lowerF# like #lowerI#'%" . $presenca . "%'#lowerF# order by presenca"; 
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
   
   function lookup_ajax_contato($contato)
   {
      $contato = substr($this->Db->qstr($contato), 1, -1);
            $contato_look = (is_string($contato) ? substr($this->Db->qstr($contato), 1, -1) : $contato); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct contato from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and  #lowerI#contato#lowerF# like #lowerI#'%" . $contato . "%'#lowerF# order by contato"; 
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
      $Nm_numeric[] = "id_geral";$Nm_numeric[] = "evento_id";$Nm_numeric[] = "hotel";$Nm_numeric[] = "publico";$Nm_numeric[] = "regional";$Nm_numeric[] = "pais";$Nm_numeric[] = "hotel_ida";$Nm_numeric[] = "cia_aerea_ida";$Nm_numeric[] = "origem_ida";$Nm_numeric[] = "destino_ida";$Nm_numeric[] = "hotel_volta";$Nm_numeric[] = "cia_aerea_volta";$Nm_numeric[] = "origem_volta";$Nm_numeric[] = "destino_volta";$Nm_numeric[] = "id_usuario_relato";$Nm_numeric[] = "valor_diaria";$Nm_numeric[] = "valor_taxa";
      $campo_join = strtolower(str_replace(".", "_", $nome));
      if (in_array($campo_join, $Nm_numeric))
      {
          if ($condicao == "EP" || $condicao == "NE")
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$campo_join]);
              return;
          }
         $nm_ini_lower = "";
         $nm_fim_lower = "";
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['decimal_db'] == ".")
         {
            $nm_aspas  = "";
            $nm_aspas1 = "";
         }
         if ($condicao != "IN")
         {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['decimal_db'] == ".")
            {
               $campo  = str_replace(",", ".", $campo);
               $campo2 = str_replace(",", ".", $campo2);
            }
         }
      }
      $Nm_datas[] = 'checkin';$Nm_datas[] = 'checkout';$Nm_datas[] = 'validade_passporte';$Nm_datas[] = 'data_nascimento';$Nm_datas[] = 'data_saida_ida';$Nm_datas[] = 'hora_saida_ida';$Nm_datas[] = 'data_chegada_ida';$Nm_datas[] = 'hora_chegada_ida';$Nm_datas[] = 'data_saida_volta';$Nm_datas[] = 'hora_saida_volta';$Nm_datas[] = 'data_chegada_volta';$Nm_datas[] = 'hora_chegada_volta';$Nm_datas[] = 'data_nota_gate';$Nm_datas[] = 'dt_chegada_proprio';$Nm_datas[] = 'hr_chegada_proprio';$Nm_datas[] = 'dt_confirm_presenca';
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
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_sep_date']))
          {
              $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_sep_date'];
              $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_sep_date1'];
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
         $nome_sum = "geral_rsvp_r.$nome";
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
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_equl'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $this->cmp_formatado[$nome_campo];
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
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['cond_pesq'] .= $nmgp_tab_label[$nome_campo] . " " . $lang_like . " (" . str_replace(" ",$Conect_msg,$this->cmp_formatado[$nome_campo]) . ")##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $lang_like . " (" . str_replace(" ",$Conect_msg,$this->cmp_formatado[$nome_campo]) . ")";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['hint']  = $nmgp_tab_label[$nome_campo] . ": " . $lang_like . " (" . str_replace(" ",$Conect_msg,$this->cmp_formatado[$nome_campo]) . ")";
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
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_strt'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_strt'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_strt'] . " " . $this->cmp_formatado[$nome_campo];
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
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . ":</span> " . str_replace(array("##ini##","##fim##"), array("<span class='scGridFilterDynValue'>","</span>"),$NM_cond) . "##*@@";
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
                       $NM_cond = str_replace(array("##ini##","##fim##"), array("",""),$NM_cond);
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $NM_cond;
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $NM_cond;
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
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $lang_like . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $lang_like . " " . $this->cmp_formatado[$nome_campo];
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $lang_like . " " . $this->cmp_formatado[$nome_campo];
               }
            break;
            case "DF":     // 
               $this->comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $this->comando_sum    .= $nm_ini_lower . $nome_sum . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $this->comando_filtro .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_diff'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_diff'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_diff'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "GT":     // 
               $this->comando        .= " $nome > " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum > " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome > " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_grtr'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "GE":     // 
               $this->comando        .= " $nome >= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum >= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome >= " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "LT":     // 
               $this->comando        .= " $nome < " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum < " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome < " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_less'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "LE":     // 
               $this->comando        .= " $nome <= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum <= " . $nm_aspas . $campo . $nm_aspas1;
               $this->comando_filtro .= " $nome <= " . $nm_aspas . $campo . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_less_equl'] . " <span class='scGridFilterDynValue'>" . nm_encode_input($this->cmp_formatado[$nome_campo]) . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less_equl'] . " " . $this->cmp_formatado[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_less_equl'] . " " . $this->cmp_formatado[$nome_campo];
            break;
            case "BW":     // 
               $this->comando        .= " $nome between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $this->comando_sum    .= " $nome_sum between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $this->comando_filtro .= " $nome between " . $nm_aspas . $campo . $nm_aspas1 . " and " . $nm_aspas . $campo2 . $nm_aspas1;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_betw'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo] . " </span>" . $this->Ini->Nm_lang['lang_srch_and_cond'] . " <span class='scGridFilterDynValue'>" . $this->cmp_formatado[$nome_campo . "_input_2"] . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_betw'] . " " . $this->cmp_formatado[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " " . $this->cmp_formatado[$nome_campo . "_input_2"];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_betw'] . " " . $this->cmp_formatado[$nome_campo] . " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " " . $this->cmp_formatado[$nome_campo . "_input_2"];
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
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_equl'] . " <span class='scGridFilterDynValue'>" . $nm_cond . "</span>##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $cond_descr;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $nm_cond;
            break;
            case "NU":     // 
               $this->comando        .= " $nome IS NULL ";
               $this->comando_sum    .= " $nome_sum IS NULL ";
               $this->comando_filtro .= " $nome IS NULL ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_null'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_null'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_null'];
            break;
            case "NN":     // 
               $this->comando        .= " $nome IS NOT NULL ";
               $this->comando_sum    .= " $nome_sum IS NOT NULL ";
               $this->comando_filtro .= " $nome IS NOT NULL ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_nnul'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nnul'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nnul'];
            break;
            case "EP":     // 
               $this->comando        .= " $nome = '' ";
               $this->comando_sum    .= " $nome_sum = '' ";
               $this->comando_filtro .= " $nome = '' ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_empty'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_empty'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_empty'];
            break;
            case "NE":     // 
               $this->comando        .= " $nome <> '' ";
               $this->comando_sum    .= " $nome_sum <> '' ";
               $this->comando_filtro .= " $nome <> '' ";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['cond_pesq'] .= "<span class='scGridFilterDynField'>" . $nmgp_tab_label[$nome_campo] . "</span> " . $this->Ini->Nm_lang['lang_srch_nempty'] . "##*@@";
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['label'] = $nmgp_tab_label[$nome_campo];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['descr'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nempty'];
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$nome_campo]['hint'] = $nmgp_tab_label[$nome_campo] . ": " . $this->Ini->Nm_lang['lang_srch_nempty'];
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
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_srch_title'] ?> geral_rsvp_r</TITLE>
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
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_srch_title'] ?> geral_rsvp_r</TITLE>
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>grid_geral_rsvp_r/grid_geral_rsvp_r_fil_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />
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
 <script type="text/javascript" src="grid_geral_rsvp_r_ajax_search.js"></script>
 <script type="text/javascript" src="grid_geral_rsvp_r_ajax.js"></script>
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
<script type="text/javascript" src="grid_geral_rsvp_r_message.js"></script>
<link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_filter ?>_sweetalert.css" />
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_prod']; ?>/third/sweetalert/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="<?php echo $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_prod']; ?>/third/sweetalert/polyfill.min.js"></script>
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
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['ajax_nav'])
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
<script type="text/javascript" src="grid_geral_rsvp_r_message.js"></script>
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
  str_out += 'SC_evento_id_cond#NMF#' + search_get_sel_txt('SC_evento_id_cond') + '@NMF@';
  str_out += 'SC_evento_id#NMF#' + search_get_text('SC_evento_id') + '@NMF@';
  str_out += 'SC_evento_dsc_cond#NMF#' + search_get_sel_txt('SC_evento_dsc_cond') + '@NMF@';
  str_out += 'SC_evento_dsc#NMF#' + search_get_text('SC_evento_dsc') + '@NMF@';
  str_out += 'id_ac_evento_dsc#NMF#' + search_get_text('id_ac_evento_dsc') + '@NMF@';
  str_out += 'SC_cpf_cond#NMF#' + search_get_sel_txt('SC_cpf_cond') + '@NMF@';
  str_out += 'SC_cpf#NMF#' + search_get_text('SC_cpf') + '@NMF@';
  str_out += 'id_ac_cpf#NMF#' + search_get_text('id_ac_cpf') + '@NMF@';
  str_out += 'SC_nome_participante_cond#NMF#' + search_get_sel_txt('SC_nome_participante_cond') + '@NMF@';
  str_out += 'SC_nome_participante#NMF#' + search_get_text('SC_nome_participante') + '@NMF@';
  str_out += 'id_ac_nome_participante#NMF#' + search_get_text('id_ac_nome_participante') + '@NMF@';
  str_out += 'SC_tipo_pessoa_cond#NMF#' + search_get_sel_txt('SC_tipo_pessoa_cond') + '@NMF@';
  str_out += 'SC_tipo_pessoa#NMF#' + search_get_text('SC_tipo_pessoa') + '@NMF@';
  str_out += 'id_ac_tipo_pessoa#NMF#' + search_get_text('id_ac_tipo_pessoa') + '@NMF@';
  str_out += 'SC_checkin_cond#NMF#' + search_get_sel_txt('SC_checkin_cond') + '@NMF@';
  str_out += 'SC_checkin_dia#NMF#' + search_get_sel_txt('SC_checkin_dia') + '@NMF@';
  str_out += 'SC_checkin_mes#NMF#' + search_get_sel_txt('SC_checkin_mes') + '@NMF@';
  str_out += 'SC_checkin_ano#NMF#' + search_get_sel_txt('SC_checkin_ano') + '@NMF@';
  str_out += 'SC_checkin_input_2_dia#NMF#' + search_get_sel_txt('SC_checkin_input_2_dia') + '@NMF@';
  str_out += 'SC_checkin_input_2_mes#NMF#' + search_get_sel_txt('SC_checkin_input_2_mes') + '@NMF@';
  str_out += 'SC_checkin_input_2_ano#NMF#' + search_get_sel_txt('SC_checkin_input_2_ano') + '@NMF@';
  str_out += 'SC_checkout_cond#NMF#' + search_get_sel_txt('SC_checkout_cond') + '@NMF@';
  str_out += 'SC_checkout_dia#NMF#' + search_get_sel_txt('SC_checkout_dia') + '@NMF@';
  str_out += 'SC_checkout_mes#NMF#' + search_get_sel_txt('SC_checkout_mes') + '@NMF@';
  str_out += 'SC_checkout_ano#NMF#' + search_get_sel_txt('SC_checkout_ano') + '@NMF@';
  str_out += 'SC_checkout_input_2_dia#NMF#' + search_get_sel_txt('SC_checkout_input_2_dia') + '@NMF@';
  str_out += 'SC_checkout_input_2_mes#NMF#' + search_get_sel_txt('SC_checkout_input_2_mes') + '@NMF@';
  str_out += 'SC_checkout_input_2_ano#NMF#' + search_get_sel_txt('SC_checkout_input_2_ano') + '@NMF@';
  str_out += 'SC_hotel_cond#NMF#' + search_get_sel_txt('SC_hotel_cond') + '@NMF@';
  str_out += 'SC_hotel#NMF#' + search_get_text('SC_hotel') + '@NMF@';
  str_out += 'SC_hotel_dsc_cond#NMF#' + search_get_sel_txt('SC_hotel_dsc_cond') + '@NMF@';
  str_out += 'SC_hotel_dsc#NMF#' + search_get_text('SC_hotel_dsc') + '@NMF@';
  str_out += 'id_ac_hotel_dsc#NMF#' + search_get_text('id_ac_hotel_dsc') + '@NMF@';
  str_out += 'SC_comprado_bvt_cond#NMF#' + search_get_sel_txt('SC_comprado_bvt_cond') + '@NMF@';
  str_out += 'SC_comprado_bvt#NMF#' + search_get_text('SC_comprado_bvt') + '@NMF@';
  str_out += 'id_ac_comprado_bvt#NMF#' + search_get_text('id_ac_comprado_bvt') + '@NMF@';
  str_out += 'SC_publico_cond#NMF#' + search_get_sel_txt('SC_publico_cond') + '@NMF@';
  str_out += 'SC_publico#NMF#' + search_get_text('SC_publico') + '@NMF@';
  str_out += 'SC_publico_dsc_cond#NMF#' + search_get_sel_txt('SC_publico_dsc_cond') + '@NMF@';
  str_out += 'SC_publico_dsc#NMF#' + search_get_text('SC_publico_dsc') + '@NMF@';
  str_out += 'id_ac_publico_dsc#NMF#' + search_get_text('id_ac_publico_dsc') + '@NMF@';
  str_out += 'SC_regional_cond#NMF#' + search_get_sel_txt('SC_regional_cond') + '@NMF@';
  str_out += 'SC_regional#NMF#' + search_get_text('SC_regional') + '@NMF@';
  str_out += 'SC_regional_dsc_cond#NMF#' + search_get_sel_txt('SC_regional_dsc_cond') + '@NMF@';
  str_out += 'SC_regional_dsc#NMF#' + search_get_text('SC_regional_dsc') + '@NMF@';
  str_out += 'id_ac_regional_dsc#NMF#' + search_get_text('id_ac_regional_dsc') + '@NMF@';
  str_out += 'SC_cidade_cond#NMF#' + search_get_sel_txt('SC_cidade_cond') + '@NMF@';
  str_out += 'SC_cidade#NMF#' + search_get_text('SC_cidade') + '@NMF@';
  str_out += 'id_ac_cidade#NMF#' + search_get_text('id_ac_cidade') + '@NMF@';
  str_out += 'SC_presenca_cond#NMF#' + search_get_sel_txt('SC_presenca_cond') + '@NMF@';
  str_out += 'SC_presenca#NMF#' + search_get_text('SC_presenca') + '@NMF@';
  str_out += 'id_ac_presenca#NMF#' + search_get_text('id_ac_presenca') + '@NMF@';
  str_out += 'SC_contato_cond#NMF#' + search_get_sel_txt('SC_contato_cond') + '@NMF@';
  str_out += 'SC_contato#NMF#' + search_get_text('SC_contato') + '@NMF@';
  str_out += 'id_ac_contato#NMF#' + search_get_text('id_ac_contato') + '@NMF@';
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
   scClass = $("#id_ac_evento_dsc").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_evento_dsc").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_evento_dsc",
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
       $("#SC_evento_dsc").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_evento_dsc").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_nome_participante").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_nome_participante").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_nome_participante",
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
       $("#SC_nome_participante").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_nome_participante").val( $(this).val() );
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
   scClass = $("#id_ac_regional_dsc").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_regional_dsc").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_regional_dsc",
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
       $("#SC_regional_dsc").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_regional_dsc").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_cidade").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_cidade").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_cidade",
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
       $("#SC_cidade").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_cidade").val( $(this).val() );
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
   scClass = $("#id_ac_presenca").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_presenca").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_presenca",
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
       $("#SC_presenca").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_presenca").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_comprado_bvt").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_comprado_bvt").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_comprado_bvt",
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
       $("#SC_comprado_bvt").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_comprado_bvt").val( $(this).val() );
       }
     }
   });
   scClass = $("#id_ac_contato").attr('class').split(' ');
   scClass = scClass[ scClass.length-1 ];
   $("#id_ac_contato").autocomplete({
     minLength: 1,
     classes: { ' ui-autocomplete': scClass + 'Ac' },
     source: function (request, response) {
     $.ajax({
       url: "index.php",
       dataType: "json",
       data: {
          q: request.term,
          nmgp_opcao: "ajax_autocomp",
          nmgp_parms: "NM_ajax_opcao?#?autocomp_contato",
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
       $("#SC_contato").val(ui.item.value);
       $(this).val(ui.item.label);
       event.preventDefault();
     },
     focus: function (event, ui) {
         event.preventDefault();
     },
     change: function (event, ui) {
       if (null == ui.item) {
          $("#SC_contato").val( $(this).val() );
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
      if ($this->Ini->Embutida_iframe || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['dashboard_info']['compact_mode'])
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
    <div class="scFilterHeaderFont" style="float: left; text-transform: uppercase;"><?php echo $this->Ini->Nm_lang['lang_othr_srch_title'] ?> geral_rsvp_r</div>
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
             $evento_id_cond, $evento_id,
             $evento_dsc_cond, $evento_dsc, $evento_dsc_autocomp,
             $cpf_cond, $cpf, $cpf_autocomp,
             $nome_participante_cond, $nome_participante, $nome_participante_autocomp,
             $tipo_pessoa_cond, $tipo_pessoa, $tipo_pessoa_autocomp,
             $checkin_cond, $checkin, $checkin_dia, $checkin_mes, $checkin_ano, $checkin_input_2_dia, $checkin_input_2_mes, $checkin_input_2_ano,
             $checkout_cond, $checkout, $checkout_dia, $checkout_mes, $checkout_ano, $checkout_input_2_dia, $checkout_input_2_mes, $checkout_input_2_ano,
             $hotel_cond, $hotel,
             $hotel_dsc_cond, $hotel_dsc, $hotel_dsc_autocomp,
             $comprado_bvt_cond, $comprado_bvt, $comprado_bvt_autocomp,
             $publico_cond, $publico,
             $publico_dsc_cond, $publico_dsc, $publico_dsc_autocomp,
             $regional_cond, $regional,
             $regional_dsc_cond, $regional_dsc, $regional_dsc_autocomp,
             $cidade_cond, $cidade, $cidade_autocomp,
             $presenca_cond, $presenca, $presenca_autocomp,
             $contato_cond, $contato, $contato_autocomp,
             $nm_url_saida, $nm_apl_dependente, $nmgp_parms, $bprocessa, $nmgp_save_name, $NM_operador, $NM_filters, $nmgp_save_option, $NM_filters_del, $Script_BI;
      $Script_BI = "";
      $this->nmgp_botoes['clear'] = "on";
      $this->nmgp_botoes['save'] = "on";
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_geral_rsvp_r']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_geral_rsvp_r']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_geral_rsvp_r']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("grid_geral_rsvp_r", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
      {
          $this->aba_iframe = true;
      }
      $nmgp_tab_label = "";
      $delimitador = "##@@";
      if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']) && $bprocessa != "recarga" && $bprocessa != "save_form" && $bprocessa != "filter_save" && $bprocessa != "filter_delete")
      {
      }
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']) && $bprocessa != "recarga" && $bprocessa != "save_form" && $bprocessa != "filter_save" && $bprocessa != "filter_delete")
      { 
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'], $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $evento_id = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['evento_id']; 
          $evento_id_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['evento_id_cond']; 
          $evento_dsc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['evento_dsc']; 
          $evento_dsc_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['evento_dsc_cond']; 
          $cpf = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['cpf']; 
          $cpf_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['cpf_cond']; 
          $nome_participante = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['nome_participante']; 
          $nome_participante_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['nome_participante_cond']; 
          $tipo_pessoa = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['tipo_pessoa']; 
          $tipo_pessoa_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['tipo_pessoa_cond']; 
          $checkin_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkin_dia']; 
          $checkin_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkin_mes']; 
          $checkin_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkin_ano']; 
          $checkin_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkin_input_2_dia']; 
          $checkin_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkin_input_2_mes']; 
          $checkin_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkin_input_2_ano']; 
          $checkin_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkin_cond']; 
          $checkout_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkout_dia']; 
          $checkout_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkout_mes']; 
          $checkout_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkout_ano']; 
          $checkout_input_2_dia = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkout_input_2_dia']; 
          $checkout_input_2_mes = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkout_input_2_mes']; 
          $checkout_input_2_ano = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkout_input_2_ano']; 
          $checkout_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkout_cond']; 
          $hotel = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['hotel']; 
          $hotel_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['hotel_cond']; 
          $hotel_dsc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['hotel_dsc']; 
          $hotel_dsc_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['hotel_dsc_cond']; 
          $comprado_bvt = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['comprado_bvt']; 
          $comprado_bvt_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['comprado_bvt_cond']; 
          $publico = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['publico']; 
          $publico_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['publico_cond']; 
          $publico_dsc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['publico_dsc']; 
          $publico_dsc_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['publico_dsc_cond']; 
          $regional = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['regional']; 
          $regional_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['regional_cond']; 
          $regional_dsc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['regional_dsc']; 
          $regional_dsc_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['regional_dsc_cond']; 
          $cidade = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['cidade']; 
          $cidade_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['cidade_cond']; 
          $presenca = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['presenca']; 
          $presenca_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['presenca_cond']; 
          $contato = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['contato']; 
          $contato_cond = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['contato_cond']; 
          $this->NM_operador = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['NM_operador']; 
          if (strtoupper($evento_id_cond) != "II" && strtoupper($evento_id_cond) != "QP" && strtoupper($evento_id_cond) != "NP" && strtoupper($evento_id_cond) != "IN") 
          { 
              nmgp_Form_Num_Val($evento_id, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          if (strtoupper($hotel_cond) != "II" && strtoupper($hotel_cond) != "QP" && strtoupper($hotel_cond) != "NP" && strtoupper($hotel_cond) != "IN") 
          { 
              nmgp_Form_Num_Val($hotel, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          if (strtoupper($publico_cond) != "II" && strtoupper($publico_cond) != "QP" && strtoupper($publico_cond) != "NP" && strtoupper($publico_cond) != "IN") 
          { 
              nmgp_Form_Num_Val($publico, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          if (strtoupper($regional_cond) != "II" && strtoupper($regional_cond) != "QP" && strtoupper($regional_cond) != "NP" && strtoupper($regional_cond) != "IN") 
          { 
              nmgp_Form_Num_Val($regional, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
      } 
      if (!isset($evento_id_cond) || empty($evento_id_cond))
      {
         $evento_id_cond = "gt";
      }
      if (!isset($evento_dsc_cond) || empty($evento_dsc_cond))
      {
         $evento_dsc_cond = "qp";
      }
      if (!isset($cpf_cond) || empty($cpf_cond))
      {
         $cpf_cond = "qp";
      }
      if (!isset($nome_participante_cond) || empty($nome_participante_cond))
      {
         $nome_participante_cond = "qp";
      }
      if (!isset($tipo_pessoa_cond) || empty($tipo_pessoa_cond))
      {
         $tipo_pessoa_cond = "qp";
      }
      if (!isset($checkin_cond) || empty($checkin_cond))
      {
         $checkin_cond = "eq";
      }
      if (!isset($checkout_cond) || empty($checkout_cond))
      {
         $checkout_cond = "eq";
      }
      if (!isset($hotel_cond) || empty($hotel_cond))
      {
         $hotel_cond = "gt";
      }
      if (!isset($hotel_dsc_cond) || empty($hotel_dsc_cond))
      {
         $hotel_dsc_cond = "qp";
      }
      if (!isset($comprado_bvt_cond) || empty($comprado_bvt_cond))
      {
         $comprado_bvt_cond = "qp";
      }
      if (!isset($publico_cond) || empty($publico_cond))
      {
         $publico_cond = "gt";
      }
      if (!isset($publico_dsc_cond) || empty($publico_dsc_cond))
      {
         $publico_dsc_cond = "qp";
      }
      if (!isset($regional_cond) || empty($regional_cond))
      {
         $regional_cond = "gt";
      }
      if (!isset($regional_dsc_cond) || empty($regional_dsc_cond))
      {
         $regional_dsc_cond = "qp";
      }
      if (!isset($cidade_cond) || empty($cidade_cond))
      {
         $cidade_cond = "qp";
      }
      if (!isset($presenca_cond) || empty($presenca_cond))
      {
         $presenca_cond = "qp";
      }
      if (!isset($contato_cond) || empty($contato_cond))
      {
         $contato_cond = "qp";
      }
      $display_aberto  = "style=display:";
      $display_fechado = "style=display:none";
      $opc_hide_input = array("nu","nn","ep","ne");
      $str_hide_evento_id = (in_array($evento_id_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_evento_dsc = (in_array($evento_dsc_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_cpf = (in_array($cpf_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_nome_participante = (in_array($nome_participante_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_tipo_pessoa = (in_array($tipo_pessoa_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_checkin = (in_array($checkin_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_checkout = (in_array($checkout_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_hotel = (in_array($hotel_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_hotel_dsc = (in_array($hotel_dsc_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_comprado_bvt = (in_array($comprado_bvt_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_publico = (in_array($publico_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_publico_dsc = (in_array($publico_dsc_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_regional = (in_array($regional_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_regional_dsc = (in_array($regional_dsc_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_cidade = (in_array($cidade_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_presenca = (in_array($presenca_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;
      $str_hide_contato = (in_array($contato_cond, $opc_hide_input)) ? $display_fechado : $display_aberto;

      $str_display_evento_id = ('bw' == $evento_id_cond) ? $display_aberto : $display_fechado;
      $str_display_evento_dsc = ('bw' == $evento_dsc_cond) ? $display_aberto : $display_fechado;
      $str_display_cpf = ('bw' == $cpf_cond) ? $display_aberto : $display_fechado;
      $str_display_nome_participante = ('bw' == $nome_participante_cond) ? $display_aberto : $display_fechado;
      $str_display_tipo_pessoa = ('bw' == $tipo_pessoa_cond) ? $display_aberto : $display_fechado;
      $str_display_checkin = ('bw' == $checkin_cond) ? $display_aberto : $display_fechado;
      $str_display_checkout = ('bw' == $checkout_cond) ? $display_aberto : $display_fechado;
      $str_display_hotel = ('bw' == $hotel_cond) ? $display_aberto : $display_fechado;
      $str_display_hotel_dsc = ('bw' == $hotel_dsc_cond) ? $display_aberto : $display_fechado;
      $str_display_comprado_bvt = ('bw' == $comprado_bvt_cond) ? $display_aberto : $display_fechado;
      $str_display_publico = ('bw' == $publico_cond) ? $display_aberto : $display_fechado;
      $str_display_publico_dsc = ('bw' == $publico_dsc_cond) ? $display_aberto : $display_fechado;
      $str_display_regional = ('bw' == $regional_cond) ? $display_aberto : $display_fechado;
      $str_display_regional_dsc = ('bw' == $regional_dsc_cond) ? $display_aberto : $display_fechado;
      $str_display_cidade = ('bw' == $cidade_cond) ? $display_aberto : $display_fechado;
      $str_display_presenca = ('bw' == $presenca_cond) ? $display_aberto : $display_fechado;
      $str_display_contato = ('bw' == $contato_cond) ? $display_aberto : $display_fechado;

      if (!isset($evento_id) || $evento_id == "")
      {
          $evento_id = "";
      }
      if (isset($evento_id) && !empty($evento_id))
      {
         $tmp_pos = (is_string($evento_id)) ? strpos($evento_id, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $evento_id = substr($evento_id, 0, $tmp_pos);
         }
      }
      if (!isset($evento_dsc) || $evento_dsc == "")
      {
          $evento_dsc = "";
      }
      if (isset($evento_dsc) && !empty($evento_dsc))
      {
         $tmp_pos = (is_string($evento_dsc)) ? strpos($evento_dsc, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $evento_dsc = substr($evento_dsc, 0, $tmp_pos);
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
      if (!isset($nome_participante) || $nome_participante == "")
      {
          $nome_participante = "";
      }
      if (isset($nome_participante) && !empty($nome_participante))
      {
         $tmp_pos = (is_string($nome_participante)) ? strpos($nome_participante, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $nome_participante = substr($nome_participante, 0, $tmp_pos);
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
      if (!isset($checkin) || $checkin == "")
      {
          $checkin = "";
      }
      if (isset($checkin) && !empty($checkin))
      {
         $tmp_pos = (is_string($checkin)) ? strpos($checkin, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $checkin = substr($checkin, 0, $tmp_pos);
         }
      }
      if (!isset($checkout) || $checkout == "")
      {
          $checkout = "";
      }
      if (isset($checkout) && !empty($checkout))
      {
         $tmp_pos = (is_string($checkout)) ? strpos($checkout, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $checkout = substr($checkout, 0, $tmp_pos);
         }
      }
      if (!isset($hotel) || $hotel == "")
      {
          $hotel = "";
      }
      if (isset($hotel) && !empty($hotel))
      {
         $tmp_pos = (is_string($hotel)) ? strpos($hotel, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $hotel = substr($hotel, 0, $tmp_pos);
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
      if (!isset($comprado_bvt) || $comprado_bvt == "")
      {
          $comprado_bvt = "";
      }
      if (isset($comprado_bvt) && !empty($comprado_bvt))
      {
         $tmp_pos = (is_string($comprado_bvt)) ? strpos($comprado_bvt, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $comprado_bvt = substr($comprado_bvt, 0, $tmp_pos);
         }
      }
      if (!isset($publico) || $publico == "")
      {
          $publico = "";
      }
      if (isset($publico) && !empty($publico))
      {
         $tmp_pos = (is_string($publico)) ? strpos($publico, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $publico = substr($publico, 0, $tmp_pos);
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
      if (!isset($regional) || $regional == "")
      {
          $regional = "";
      }
      if (isset($regional) && !empty($regional))
      {
         $tmp_pos = (is_string($regional)) ? strpos($regional, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $regional = substr($regional, 0, $tmp_pos);
         }
      }
      if (!isset($regional_dsc) || $regional_dsc == "")
      {
          $regional_dsc = "";
      }
      if (isset($regional_dsc) && !empty($regional_dsc))
      {
         $tmp_pos = (is_string($regional_dsc)) ? strpos($regional_dsc, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $regional_dsc = substr($regional_dsc, 0, $tmp_pos);
         }
      }
      if (!isset($cidade) || $cidade == "")
      {
          $cidade = "";
      }
      if (isset($cidade) && !empty($cidade))
      {
         $tmp_pos = (is_string($cidade)) ? strpos($cidade, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $cidade = substr($cidade, 0, $tmp_pos);
         }
      }
      if (!isset($presenca) || $presenca == "")
      {
          $presenca = "";
      }
      if (isset($presenca) && !empty($presenca))
      {
         $tmp_pos = (is_string($presenca)) ? strpos($presenca, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $presenca = substr($presenca, 0, $tmp_pos);
         }
      }
      if (!isset($contato) || $contato == "")
      {
          $contato = "";
      }
      if (isset($contato) && !empty($contato))
      {
         $tmp_pos = (is_string($contato)) ? strpos($contato, "##@@") : false;
         if ($tmp_pos === false)
         { }
         else
         {
         $contato = substr($contato, 0, $tmp_pos);
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
   if (is_file("grid_geral_rsvp_r_help.txt"))
   {
      $Arq_WebHelp = file("grid_geral_rsvp_r_help.txt"); 
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
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_geral_rsvp_r']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_geral_rsvp_r']['start'] == 'filter' && $nm_apl_dependente != 1)
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





      <TD id='SC_evento_id_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['evento_id'])) ? $this->New_label['evento_id'] : "Cod. Evento "; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_evento_id_cond" name="evento_id_cond" onChange="nm_campos_between(document.getElementById('id_vis_evento_id'), this, 'evento_id')">
       <OPTION value="gt" <?php if ("gt" == $evento_id_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $evento_id_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $evento_id_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_evento_id" <?php echo $str_hide_evento_id?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['evento_id'])) ? $this->New_label['evento_id'] : "Cod. Evento ";
 $nmgp_tab_label .= "evento_id?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<INPUT  type="text" id="SC_evento_id" name="evento_id" value="<?php echo NM_encode_input($evento_id) ?>" size=11 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" class="sc-js-input scFilterObjectOdd">

        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_evento_dsc_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['evento_dsc'])) ? $this->New_label['evento_dsc'] : "Evento"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_evento_dsc_cond" name="evento_dsc_cond" onChange="nm_campos_between(document.getElementById('id_vis_evento_dsc'), this, 'evento_dsc')">
       <OPTION value="qp" <?php if ("qp" == $evento_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $evento_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $evento_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $evento_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_evento_dsc" <?php echo $str_hide_evento_dsc?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['evento_dsc'])) ? $this->New_label['evento_dsc'] : "Evento";
 $nmgp_tab_label .= "evento_dsc?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($evento_dsc != "")
      {
      $evento_dsc_look = (is_string($evento_dsc) ? substr($this->Db->qstr($evento_dsc), 1, -1) : $evento_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct evento_dsc from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#evento_dsc#lowerF# = #lowerI#'$evento_dsc_look'#lowerF# order by evento_dsc"; 
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
      if (isset($nmgp_def_dados[0][$evento_dsc]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$evento_dsc];
      }
      else
      {
          $sAutocompValue = $evento_dsc;
      }
?>
<INPUT  type="text" id="SC_evento_dsc" name="evento_dsc" value="<?php echo NM_encode_input($evento_dsc) ?>"  size=50 alt="{datatype: 'text', maxLength: 60, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_evento_dsc" name="evento_dsc_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 60, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_cpf_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['cpf'])) ? $this->New_label['cpf'] : "CPF"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_cpf_cond" name="cpf_cond" onChange="nm_campos_between(document.getElementById('id_vis_cpf'), this, 'cpf')">
       <OPTION value="qp" <?php if ("qp" == $cpf_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $cpf_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $cpf_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $cpf_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_cpf" <?php echo $str_hide_cpf?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['cpf'])) ? $this->New_label['cpf'] : "CPF";
 $nmgp_tab_label .= "cpf?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($cpf != "")
      {
      $cpf_look = (is_string($cpf) ? substr($this->Db->qstr($cpf), 1, -1) : $cpf); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct cpf from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#cpf#lowerF# = #lowerI#'$cpf_look'#lowerF# order by cpf"; 
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
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_cpf" name="cpf_autocomp" size="13"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 13, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_nome_participante_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['nome_participante'])) ? $this->New_label['nome_participante'] : " Participante"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_nome_participante_cond" name="nome_participante_cond" onChange="nm_campos_between(document.getElementById('id_vis_nome_participante'), this, 'nome_participante')">
       <OPTION value="qp" <?php if ("qp" == $nome_participante_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $nome_participante_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $nome_participante_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $nome_participante_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_nome_participante" <?php echo $str_hide_nome_participante?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['nome_participante'])) ? $this->New_label['nome_participante'] : " Participante";
 $nmgp_tab_label .= "nome_participante?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($nome_participante != "")
      {
      $nome_participante_look = (is_string($nome_participante) ? substr($this->Db->qstr($nome_participante), 1, -1) : $nome_participante); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct nome_participante from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#nome_participante#lowerF# = #lowerI#'$nome_participante_look'#lowerF# order by nome_participante"; 
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
      if (isset($nmgp_def_dados[0][$nome_participante]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$nome_participante];
      }
      else
      {
          $sAutocompValue = $nome_participante;
      }
?>
<INPUT  type="text" id="SC_nome_participante" name="nome_participante" value="<?php echo NM_encode_input($nome_participante) ?>"  size=50 alt="{datatype: 'text', maxLength: 60, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_nome_participante" name="nome_participante_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 60, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


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
      $nm_comando = "select distinct tipo_pessoa from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#tipo_pessoa#lowerF# = #lowerI#'$tipo_pessoa_look'#lowerF# order by tipo_pessoa"; 
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
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_tipo_pessoa" name="tipo_pessoa_autocomp" size="25"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 25, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_checkin_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['checkin'])) ? $this->New_label['checkin'] : "Checkin"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_checkin_cond" name="checkin_cond" onChange="nm_campos_between(document.getElementById('id_vis_checkin'), this, 'checkin')">
       <OPTION value="eq" <?php if ("eq" == $checkin_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="gt" <?php if ("gt" == $checkin_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $checkin_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $checkin_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_checkin" <?php echo $str_hide_checkin?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['checkin'])) ? $this->New_label['checkin'] : "Checkin";
 $nmgp_tab_label .= "checkin?#?" . $SC_Label . "?@?";
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
<span id='id_date_part_checkin_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_checkin_dia" name="checkin_dia" value="<?php echo NM_encode_input($checkin_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_checkin_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_checkin_mes" name="checkin_mes" value="<?php echo NM_encode_input($checkin_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_checkin_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_checkin_ano" name="checkin_ano" value="<?php echo NM_encode_input($checkin_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
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
        <SPAN id="id_css_checkin"  class="scFilterFieldFontEven">
 <?php echo $date_format_show ?>         </SPAN>
                 </TD>
       </TR>
       <TR valign="top">
        <TD id="id_vis_checkin"  <?php echo $str_display_checkin; ?> class="scFilterFieldFontEven">
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
<span id='id_date_part_checkin_input_2_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_checkin_input_2_dia" name="checkin_input_2_dia" value="<?php echo NM_encode_input($checkin_input_2_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_checkin_input_2_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_checkin_input_2_mes" name="checkin_input_2_mes" value="<?php echo NM_encode_input($checkin_input_2_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_checkin_input_2_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectEven" type="text" id="SC_checkin_input_2_ano" name="checkin_input_2_ano" value="<?php echo NM_encode_input($checkin_input_2_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
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





      <TD id='SC_checkout_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['checkout'])) ? $this->New_label['checkout'] : "Checkout"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_checkout_cond" name="checkout_cond" onChange="nm_campos_between(document.getElementById('id_vis_checkout'), this, 'checkout')">
       <OPTION value="eq" <?php if ("eq" == $checkout_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="gt" <?php if ("gt" == $checkout_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $checkout_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="bw" <?php if ("bw" == $checkout_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_betw'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_checkout" <?php echo $str_hide_checkout?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['checkout'])) ? $this->New_label['checkout'] : "Checkout";
 $nmgp_tab_label .= "checkout?#?" . $SC_Label . "?@?";
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
<span id='id_date_part_checkout_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_checkout_dia" name="checkout_dia" value="<?php echo NM_encode_input($checkout_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_checkout_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_checkout_mes" name="checkout_mes" value="<?php echo NM_encode_input($checkout_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_checkout_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_checkout_ano" name="checkout_ano" value="<?php echo NM_encode_input($checkout_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
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
        <SPAN id="id_css_checkout"  class="scFilterFieldFontOdd">
 <?php echo $date_format_show ?>         </SPAN>
                 </TD>
       </TR>
       <TR valign="top">
        <TD id="id_vis_checkout"  <?php echo $str_display_checkout; ?> class="scFilterFieldFontOdd">
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
<span id='id_date_part_checkout_input_2_DD' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_checkout_input_2_dia" name="checkout_input_2_dia" value="<?php echo NM_encode_input($checkout_input_2_dia); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_checkout_input_2_MM' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_checkout_input_2_mes" name="checkout_input_2_mes" value="<?php echo NM_encode_input($checkout_input_2_mes); ?>" size="2" alt="{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, autoTab: true, enterTab: false}">
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
<span id='id_date_part_checkout_input_2_AAAA' style='display: inline-block'>
<INPUT class="sc-js-input scFilterObjectOdd" type="text" id="SC_checkout_input_2_ano" name="checkout_input_2_ano" value="<?php echo NM_encode_input($checkout_input_2_ano); ?>" size="4" alt="{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, autoTab: true, enterTab: false}">
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





      <TD id='SC_hotel_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['hotel'])) ? $this->New_label['hotel'] : "Hotel"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_hotel_cond" name="hotel_cond" onChange="nm_campos_between(document.getElementById('id_vis_hotel'), this, 'hotel')">
       <OPTION value="gt" <?php if ("gt" == $hotel_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $hotel_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $hotel_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_hotel" <?php echo $str_hide_hotel?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['hotel'])) ? $this->New_label['hotel'] : "Hotel";
 $nmgp_tab_label .= "hotel?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<INPUT  type="text" id="SC_hotel" name="hotel" value="<?php echo NM_encode_input($hotel) ?>" size=11 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" class="sc-js-input scFilterObjectEven">

        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_hotel_dsc_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['hotel_dsc'])) ? $this->New_label['hotel_dsc'] : "Hotel"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_hotel_dsc_cond" name="hotel_dsc_cond" onChange="nm_campos_between(document.getElementById('id_vis_hotel_dsc'), this, 'hotel_dsc')">
       <OPTION value="qp" <?php if ("qp" == $hotel_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $hotel_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $hotel_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $hotel_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_hotel_dsc" <?php echo $str_hide_hotel_dsc?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['hotel_dsc'])) ? $this->New_label['hotel_dsc'] : "Hotel";
 $nmgp_tab_label .= "hotel_dsc?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($hotel_dsc != "")
      {
      $hotel_dsc_look = (is_string($hotel_dsc) ? substr($this->Db->qstr($hotel_dsc), 1, -1) : $hotel_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct hotel_dsc from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#hotel_dsc#lowerF# = #lowerI#'$hotel_dsc_look'#lowerF# order by hotel_dsc"; 
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
<INPUT  type="text" id="SC_hotel_dsc" name="hotel_dsc" value="<?php echo NM_encode_input($hotel_dsc) ?>"  size=50 alt="{datatype: 'text', maxLength: 60, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_hotel_dsc" name="hotel_dsc_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 60, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_comprado_bvt_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['comprado_bvt'])) ? $this->New_label['comprado_bvt'] : "Comprado Bvt"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_comprado_bvt_cond" name="comprado_bvt_cond" onChange="nm_campos_between(document.getElementById('id_vis_comprado_bvt'), this, 'comprado_bvt')">
       <OPTION value="qp" <?php if ("qp" == $comprado_bvt_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $comprado_bvt_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $comprado_bvt_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $comprado_bvt_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_comprado_bvt" <?php echo $str_hide_comprado_bvt?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['comprado_bvt'])) ? $this->New_label['comprado_bvt'] : "Comprado Bvt";
 $nmgp_tab_label .= "comprado_bvt?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($comprado_bvt != "")
      {
      $comprado_bvt_look = (is_string($comprado_bvt) ? substr($this->Db->qstr($comprado_bvt), 1, -1) : $comprado_bvt); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct comprado_bvt from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#comprado_bvt#lowerF# = #lowerI#'$comprado_bvt_look'#lowerF# order by comprado_bvt"; 
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
      if (isset($nmgp_def_dados[0][$comprado_bvt]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$comprado_bvt];
      }
      else
      {
          $sAutocompValue = $comprado_bvt;
      }
?>
<INPUT  type="text" id="SC_comprado_bvt" name="comprado_bvt" value="<?php echo NM_encode_input($comprado_bvt) ?>"  size=3 alt="{datatype: 'text', maxLength: 3, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_comprado_bvt" name="comprado_bvt_autocomp" size="3"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 3, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_publico_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['publico'])) ? $this->New_label['publico'] : "Publico"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_publico_cond" name="publico_cond" onChange="nm_campos_between(document.getElementById('id_vis_publico'), this, 'publico')">
       <OPTION value="gt" <?php if ("gt" == $publico_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $publico_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $publico_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_publico" <?php echo $str_hide_publico?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['publico'])) ? $this->New_label['publico'] : "Publico";
 $nmgp_tab_label .= "publico?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<INPUT  type="text" id="SC_publico" name="publico" value="<?php echo NM_encode_input($publico) ?>" size=11 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" class="sc-js-input scFilterObjectOdd">

        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_publico_dsc_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['publico_dsc'])) ? $this->New_label['publico_dsc'] : "Público"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_publico_dsc_cond" name="publico_dsc_cond" onChange="nm_campos_between(document.getElementById('id_vis_publico_dsc'), this, 'publico_dsc')">
       <OPTION value="qp" <?php if ("qp" == $publico_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $publico_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $publico_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $publico_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_publico_dsc" <?php echo $str_hide_publico_dsc?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['publico_dsc'])) ? $this->New_label['publico_dsc'] : "Público";
 $nmgp_tab_label .= "publico_dsc?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($publico_dsc != "")
      {
      $publico_dsc_look = (is_string($publico_dsc) ? substr($this->Db->qstr($publico_dsc), 1, -1) : $publico_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct publico_dsc from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#publico_dsc#lowerF# = #lowerI#'$publico_dsc_look'#lowerF# order by publico_dsc"; 
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
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_publico_dsc" name="publico_dsc_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 50, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_regional_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['regional'])) ? $this->New_label['regional'] : "Regional"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_regional_cond" name="regional_cond" onChange="nm_campos_between(document.getElementById('id_vis_regional'), this, 'regional')">
       <OPTION value="gt" <?php if ("gt" == $regional_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_grtr'] ?></OPTION>
       <OPTION value="lt" <?php if ("lt" == $regional_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_less'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $regional_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_regional" <?php echo $str_hide_regional?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['regional'])) ? $this->New_label['regional'] : "Regional";
 $nmgp_tab_label .= "regional?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<INPUT  type="text" id="SC_regional" name="regional" value="<?php echo NM_encode_input($regional) ?>" size=11 alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo $_SESSION['scriptcase']['reg_conf']['grup_num'] ?>', allowNegative: false, onlyNegative: false, enterTab: false}" class="sc-js-input scFilterObjectOdd">

        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_regional_dsc_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['regional_dsc'])) ? $this->New_label['regional_dsc'] : "Regional"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_regional_dsc_cond" name="regional_dsc_cond" onChange="nm_campos_between(document.getElementById('id_vis_regional_dsc'), this, 'regional_dsc')">
       <OPTION value="qp" <?php if ("qp" == $regional_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $regional_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $regional_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $regional_dsc_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_regional_dsc" <?php echo $str_hide_regional_dsc?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['regional_dsc'])) ? $this->New_label['regional_dsc'] : "Regional";
 $nmgp_tab_label .= "regional_dsc?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($regional_dsc != "")
      {
      $regional_dsc_look = (is_string($regional_dsc) ? substr($this->Db->qstr($regional_dsc), 1, -1) : $regional_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct regional_dsc from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#regional_dsc#lowerF# = #lowerI#'$regional_dsc_look'#lowerF# order by regional_dsc"; 
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
      if (isset($nmgp_def_dados[0][$regional_dsc]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$regional_dsc];
      }
      else
      {
          $sAutocompValue = $regional_dsc;
      }
?>
<INPUT  type="text" id="SC_regional_dsc" name="regional_dsc" value="<?php echo NM_encode_input($regional_dsc) ?>"  size=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_regional_dsc" name="regional_dsc_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 50, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_cidade_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['cidade'])) ? $this->New_label['cidade'] : "Cidade"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_cidade_cond" name="cidade_cond" onChange="nm_campos_between(document.getElementById('id_vis_cidade'), this, 'cidade')">
       <OPTION value="qp" <?php if ("qp" == $cidade_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $cidade_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $cidade_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $cidade_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_cidade" <?php echo $str_hide_cidade?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['cidade'])) ? $this->New_label['cidade'] : "Cidade";
 $nmgp_tab_label .= "cidade?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($cidade != "")
      {
      $cidade_look = (is_string($cidade) ? substr($this->Db->qstr($cidade), 1, -1) : $cidade); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct cidade from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#cidade#lowerF# = #lowerI#'$cidade_look'#lowerF# order by cidade"; 
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
      if (isset($nmgp_def_dados[0][$cidade]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$cidade];
      }
      else
      {
          $sAutocompValue = $cidade;
      }
?>
<INPUT  type="text" id="SC_cidade" name="cidade" value="<?php echo NM_encode_input($cidade) ?>"  size=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_cidade" name="cidade_autocomp" size="50"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 50, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_presenca_label' class="scFilterLabelEven"><?php echo (isset($this->New_label['presenca'])) ? $this->New_label['presenca'] : "Confirmação da Presença"; ?></TD>
     <TD class="scFilterFieldEven"> 
      <SELECT class="scFilterObjectEven" id="SC_presenca_cond" name="presenca_cond" onChange="nm_campos_between(document.getElementById('id_vis_presenca'), this, 'presenca')">
       <OPTION value="qp" <?php if ("qp" == $presenca_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $presenca_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $presenca_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $presenca_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldEven">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_presenca" <?php echo $str_hide_presenca?> valign="top">
        <TD class="scFilterFieldFontEven">
           <?php
 $SC_Label = (isset($this->New_label['presenca'])) ? $this->New_label['presenca'] : "Confirmação da Presença";
 $nmgp_tab_label .= "presenca?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($presenca != "")
      {
      $presenca_look = (is_string($presenca) ? substr($this->Db->qstr($presenca), 1, -1) : $presenca); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct presenca from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#presenca#lowerF# = #lowerI#'$presenca_look'#lowerF# order by presenca"; 
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
      if (isset($nmgp_def_dados[0][$presenca]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$presenca];
      }
      else
      {
          $sAutocompValue = $presenca;
      }
?>
<INPUT  type="text" id="SC_presenca" name="presenca" value="<?php echo NM_encode_input($presenca) ?>"  size=25 alt="{datatype: 'text', maxLength: 25, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectEven" type="text" id="id_ac_presenca" name="presenca_autocomp" size="25"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 25, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


        </TD>
       </TR>
      </TABLE>
     </TD>

   </tr><tr valign="top">





      <TD id='SC_contato_label' class="scFilterLabelOdd"><?php echo (isset($this->New_label['contato'])) ? $this->New_label['contato'] : "Contato Presença"; ?></TD>
     <TD class="scFilterFieldOdd"> 
      <SELECT class="scFilterObjectOdd" id="SC_contato_cond" name="contato_cond" onChange="nm_campos_between(document.getElementById('id_vis_contato'), this, 'contato')">
       <OPTION value="qp" <?php if ("qp" == $contato_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_like'] ?></OPTION>
       <OPTION value="np" <?php if ("np" == $contato_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_not_like'] ?></OPTION>
       <OPTION value="eq" <?php if ("eq" == $contato_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_exac'] ?></OPTION>
       <OPTION value="ep" <?php if ("ep" == $contato_cond) { echo "selected"; } ?>><?php echo $this->Ini->Nm_lang['lang_srch_empty'] ?></OPTION>
      </SELECT>
       </TD>
     <TD  class="scFilterFieldOdd">
      <TABLE  border="0" cellpadding="0" cellspacing="0">
       <TR id="id_hide_contato" <?php echo $str_hide_contato?> valign="top">
        <TD class="scFilterFieldFontOdd">
           <?php
 $SC_Label = (isset($this->New_label['contato'])) ? $this->New_label['contato'] : "Contato Presença";
 $nmgp_tab_label .= "contato?#?" . $SC_Label . "?@?";
 $date_sep_bw = " " . $this->Ini->Nm_lang['lang_srch_between_values'] . " ";
 if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
 {
     $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
 }
?>
<?php
      if ($contato != "")
      {
      $contato_look = (is_string($contato) ? substr($this->Db->qstr($contato), 1, -1) : $contato); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct contato from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#contato#lowerF# = #lowerI#'$contato_look'#lowerF# order by contato"; 
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
      if (isset($nmgp_def_dados[0][$contato]))
      {
          $sAutocompValue = $nmgp_def_dados[0][$contato];
      }
      else
      {
          $sAutocompValue = $contato;
      }
?>
<INPUT  type="text" id="SC_contato" name="contato" value="<?php echo NM_encode_input($contato) ?>"  size=25 alt="{datatype: 'text', maxLength: 25, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}" style="display: none">
<input class="sc-js-input scFilterObjectOdd" type="text" id="id_ac_contato" name="contato_autocomp" size="25"  value="<?php echo NM_encode_input($sAutocompValue); ?>" alt="{datatype: 'text', maxLength: 25, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}">


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
    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['pesq_tab_label'] = $nmgp_tab_label;
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
   if (is_file("grid_geral_rsvp_r_help.txt"))
   {
      $Arq_WebHelp = file("grid_geral_rsvp_r_help.txt"); 
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
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_geral_rsvp_r']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_geral_rsvp_r']['start'] == 'filter' && $nm_apl_dependente != 1)
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
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_geral_rsvp_r']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_geral_rsvp_r']['start'] == 'filter')
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
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['orig_pesq']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['orig_pesq'] == "grid")
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
   document.F1.evento_id_cond.value = 'gt';
   nm_campos_between(document.getElementById('id_vis_evento_id'), document.F1.evento_id_cond, 'evento_id', opc_clear);
   document.F1.evento_id.value = "";
   document.F1.evento_dsc_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_evento_dsc'), document.F1.evento_dsc_cond, 'evento_dsc', opc_clear);
   document.F1.evento_dsc.value = "";
   document.F1.evento_dsc_autocomp.value = "";
   document.F1.cpf_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_cpf'), document.F1.cpf_cond, 'cpf', opc_clear);
   document.F1.cpf.value = "";
   document.F1.cpf_autocomp.value = "";
   document.F1.nome_participante_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_nome_participante'), document.F1.nome_participante_cond, 'nome_participante', opc_clear);
   document.F1.nome_participante.value = "";
   document.F1.nome_participante_autocomp.value = "";
   document.F1.tipo_pessoa_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_tipo_pessoa'), document.F1.tipo_pessoa_cond, 'tipo_pessoa', opc_clear);
   document.F1.tipo_pessoa.value = "";
   document.F1.tipo_pessoa_autocomp.value = "";
   document.F1.checkin_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_checkin'), document.F1.checkin_cond, 'checkin', opc_clear);
   document.F1.checkin_dia.value = "";
   document.F1.checkin_mes.value = "";
   document.F1.checkin_ano.value = "";
   document.F1.checkin_input_2_dia.value = "";
   document.F1.checkin_input_2_mes.value = "";
   document.F1.checkin_input_2_ano.value = "";
   document.F1.checkout_cond.value = 'eq';
   nm_campos_between(document.getElementById('id_vis_checkout'), document.F1.checkout_cond, 'checkout', opc_clear);
   document.F1.checkout_dia.value = "";
   document.F1.checkout_mes.value = "";
   document.F1.checkout_ano.value = "";
   document.F1.checkout_input_2_dia.value = "";
   document.F1.checkout_input_2_mes.value = "";
   document.F1.checkout_input_2_ano.value = "";
   document.F1.hotel_cond.value = 'gt';
   nm_campos_between(document.getElementById('id_vis_hotel'), document.F1.hotel_cond, 'hotel', opc_clear);
   document.F1.hotel.value = "";
   document.F1.hotel_dsc_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_hotel_dsc'), document.F1.hotel_dsc_cond, 'hotel_dsc', opc_clear);
   document.F1.hotel_dsc.value = "";
   document.F1.hotel_dsc_autocomp.value = "";
   document.F1.comprado_bvt_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_comprado_bvt'), document.F1.comprado_bvt_cond, 'comprado_bvt', opc_clear);
   document.F1.comprado_bvt.value = "";
   document.F1.comprado_bvt_autocomp.value = "";
   document.F1.publico_cond.value = 'gt';
   nm_campos_between(document.getElementById('id_vis_publico'), document.F1.publico_cond, 'publico', opc_clear);
   document.F1.publico.value = "";
   document.F1.publico_dsc_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_publico_dsc'), document.F1.publico_dsc_cond, 'publico_dsc', opc_clear);
   document.F1.publico_dsc.value = "";
   document.F1.publico_dsc_autocomp.value = "";
   document.F1.regional_cond.value = 'gt';
   nm_campos_between(document.getElementById('id_vis_regional'), document.F1.regional_cond, 'regional', opc_clear);
   document.F1.regional.value = "";
   document.F1.regional_dsc_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_regional_dsc'), document.F1.regional_dsc_cond, 'regional_dsc', opc_clear);
   document.F1.regional_dsc.value = "";
   document.F1.regional_dsc_autocomp.value = "";
   document.F1.cidade_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_cidade'), document.F1.cidade_cond, 'cidade', opc_clear);
   document.F1.cidade.value = "";
   document.F1.cidade_autocomp.value = "";
   document.F1.presenca_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_presenca'), document.F1.presenca_cond, 'presenca', opc_clear);
   document.F1.presenca.value = "";
   document.F1.presenca_autocomp.value = "";
   document.F1.contato_cond.value = 'qp';
   nm_campos_between(document.getElementById('id_vis_contato'), document.F1.contato_cond, 'contato', opc_clear);
   document.F1.contato.value = "";
   document.F1.contato_autocomp.value = "";
 }
 function SC_carga_evt_jquery()
 {
    $('#SC_checkin_dia').bind('change', function() {sc_grid_geral_rsvp_r_valida_dia(this)});
    $('#SC_checkin_input_2_dia').bind('change', function() {sc_grid_geral_rsvp_r_valida_dia(this)});
    $('#SC_checkin_input_2_mes').bind('change', function() {sc_grid_geral_rsvp_r_valida_mes(this)});
    $('#SC_checkin_mes').bind('change', function() {sc_grid_geral_rsvp_r_valida_mes(this)});
    $('#SC_checkout_dia').bind('change', function() {sc_grid_geral_rsvp_r_valida_dia(this)});
    $('#SC_checkout_input_2_dia').bind('change', function() {sc_grid_geral_rsvp_r_valida_dia(this)});
    $('#SC_checkout_input_2_mes').bind('change', function() {sc_grid_geral_rsvp_r_valida_mes(this)});
    $('#SC_checkout_mes').bind('change', function() {sc_grid_geral_rsvp_r_valida_mes(this)});
 }
 function sc_grid_geral_rsvp_r_valida_dia(obj)
 {
     if (obj.value != "" && (obj.value < 1 || obj.value > 31))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_iday'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { $(document.activeElement).focus(); obj.focus(); }, 10);
         }
     }
 }
 function sc_grid_geral_rsvp_r_valida_mes(obj)
 {
     if (obj.value != "" && (obj.value < 1 || obj.value > 12))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_mnth'] +  " " + Nm_erro['lang_jscr_wfix']))
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
       $NM_patch   = "NRSVP115_10_AWS_APP/grid_geral_rsvp_r";
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
          $nmgp_tab_label = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['pesq_tab_label'];
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
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_orig']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_orig'] = "";
      }
      $this->init_comando();
      $this->NM_operador     = (isset($NM_operador) && ("and" == strtolower($NM_operador) || "or" == strtolower($NM_operador))) ? $NM_operador : "and";
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'] = array();
   }

   function init_comando()
   {
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['cond_pesq'] = "";
      if ($this->NM_ajax_flag && ($this->NM_ajax_opcao == "ajax_grid_search" || $this->NM_ajax_opcao == "ajax_grid_search_change_fil"))
      {
          $this->comando = "";
      }
      else
      {
          $this->comando = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_orig'];
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
          $NM_patch .= "grid_geral_rsvp_r/";
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
      $tp_fields['SC_evento_id_cond'] = 'cond';
      $tp_fields['SC_evento_id'] = 'text';
      $tp_fields['SC_evento_dsc_cond'] = 'cond';
      $tp_fields['SC_evento_dsc'] = 'text_aut';
      $tp_fields['id_ac_evento_dsc'] = 'text_aut';
      $tp_fields['SC_cpf_cond'] = 'cond';
      $tp_fields['SC_cpf'] = 'text_aut';
      $tp_fields['id_ac_cpf'] = 'text_aut';
      $tp_fields['SC_nome_participante_cond'] = 'cond';
      $tp_fields['SC_nome_participante'] = 'text_aut';
      $tp_fields['id_ac_nome_participante'] = 'text_aut';
      $tp_fields['SC_tipo_pessoa_cond'] = 'cond';
      $tp_fields['SC_tipo_pessoa'] = 'text_aut';
      $tp_fields['id_ac_tipo_pessoa'] = 'text_aut';
      $tp_fields['SC_checkin_cond'] = 'cond';
      $tp_fields['SC_checkin_dia'] = 'text';
      $tp_fields['SC_checkin_mes'] = 'text';
      $tp_fields['SC_checkin_ano'] = 'text';
      $tp_fields['SC_checkin_input_2_dia'] = 'text';
      $tp_fields['SC_checkin_input_2_mes'] = 'text';
      $tp_fields['SC_checkin_input_2_ano'] = 'text';
      $tp_fields['SC_checkout_cond'] = 'cond';
      $tp_fields['SC_checkout_dia'] = 'text';
      $tp_fields['SC_checkout_mes'] = 'text';
      $tp_fields['SC_checkout_ano'] = 'text';
      $tp_fields['SC_checkout_input_2_dia'] = 'text';
      $tp_fields['SC_checkout_input_2_mes'] = 'text';
      $tp_fields['SC_checkout_input_2_ano'] = 'text';
      $tp_fields['SC_hotel_cond'] = 'cond';
      $tp_fields['SC_hotel'] = 'text';
      $tp_fields['SC_hotel_dsc_cond'] = 'cond';
      $tp_fields['SC_hotel_dsc'] = 'text_aut';
      $tp_fields['id_ac_hotel_dsc'] = 'text_aut';
      $tp_fields['SC_comprado_bvt_cond'] = 'cond';
      $tp_fields['SC_comprado_bvt'] = 'text_aut';
      $tp_fields['id_ac_comprado_bvt'] = 'text_aut';
      $tp_fields['SC_publico_cond'] = 'cond';
      $tp_fields['SC_publico'] = 'text';
      $tp_fields['SC_publico_dsc_cond'] = 'cond';
      $tp_fields['SC_publico_dsc'] = 'text_aut';
      $tp_fields['id_ac_publico_dsc'] = 'text_aut';
      $tp_fields['SC_regional_cond'] = 'cond';
      $tp_fields['SC_regional'] = 'text';
      $tp_fields['SC_regional_dsc_cond'] = 'cond';
      $tp_fields['SC_regional_dsc'] = 'text_aut';
      $tp_fields['id_ac_regional_dsc'] = 'text_aut';
      $tp_fields['SC_cidade_cond'] = 'cond';
      $tp_fields['SC_cidade'] = 'text_aut';
      $tp_fields['id_ac_cidade'] = 'text_aut';
      $tp_fields['SC_presenca_cond'] = 'cond';
      $tp_fields['SC_presenca'] = 'text_aut';
      $tp_fields['id_ac_presenca'] = 'text_aut';
      $tp_fields['SC_contato_cond'] = 'cond';
      $tp_fields['SC_contato'] = 'text_aut';
      $tp_fields['id_ac_contato'] = 'text_aut';
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
      global $evento_id_cond, $evento_id,
             $evento_dsc_cond, $evento_dsc, $evento_dsc_autocomp,
             $cpf_cond, $cpf, $cpf_autocomp,
             $nome_participante_cond, $nome_participante, $nome_participante_autocomp,
             $tipo_pessoa_cond, $tipo_pessoa, $tipo_pessoa_autocomp,
             $checkin_cond, $checkin, $checkin_dia, $checkin_mes, $checkin_ano, $checkin_input_2_dia, $checkin_input_2_mes, $checkin_input_2_ano,
             $checkout_cond, $checkout, $checkout_dia, $checkout_mes, $checkout_ano, $checkout_input_2_dia, $checkout_input_2_mes, $checkout_input_2_ano,
             $hotel_cond, $hotel,
             $hotel_dsc_cond, $hotel_dsc, $hotel_dsc_autocomp,
             $comprado_bvt_cond, $comprado_bvt, $comprado_bvt_autocomp,
             $publico_cond, $publico,
             $publico_dsc_cond, $publico_dsc, $publico_dsc_autocomp,
             $regional_cond, $regional,
             $regional_dsc_cond, $regional_dsc, $regional_dsc_autocomp,
             $cidade_cond, $cidade, $cidade_autocomp,
             $presenca_cond, $presenca, $presenca_autocomp,
             $contato_cond, $contato, $contato_autocomp, $nmgp_tab_label;

      $C_formatado = true;
      if ($this->NM_ajax_flag && ($this->NM_ajax_opcao == "ajax_grid_search" || $this->NM_ajax_opcao == "ajax_grid_search_change_fil"))
      {
          if ($this->NM_ajax_opcao == "ajax_grid_search")
          {
              $C_formatado = false;
          }
          $Temp_Busca  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && $this->NM_ajax_opcao != "ajax_grid_search_change_fil")
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'], $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'] as $Cmps => $Vals)
          {
              $$Cmps = $Vals;
          }
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_limpa.php", "F", "nm_limpa_valor") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_conv_dados.php", "F", "nm_conv_limpa_dado") ; 
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_edit.php", "F", "nmgp_Form_Num_Val") ; 
      if (!empty($evento_dsc_autocomp) && empty($evento_dsc))
      {
          $evento_dsc = $evento_dsc_autocomp;
      }
      if (!empty($cpf_autocomp) && empty($cpf))
      {
          $cpf = $cpf_autocomp;
      }
      if (!empty($nome_participante_autocomp) && empty($nome_participante))
      {
          $nome_participante = $nome_participante_autocomp;
      }
      if (!empty($tipo_pessoa_autocomp) && empty($tipo_pessoa))
      {
          $tipo_pessoa = $tipo_pessoa_autocomp;
      }
      if (!empty($hotel_dsc_autocomp) && empty($hotel_dsc))
      {
          $hotel_dsc = $hotel_dsc_autocomp;
      }
      if (!empty($comprado_bvt_autocomp) && empty($comprado_bvt))
      {
          $comprado_bvt = $comprado_bvt_autocomp;
      }
      if (!empty($publico_dsc_autocomp) && empty($publico_dsc))
      {
          $publico_dsc = $publico_dsc_autocomp;
      }
      if (!empty($regional_dsc_autocomp) && empty($regional_dsc))
      {
          $regional_dsc = $regional_dsc_autocomp;
      }
      if (!empty($cidade_autocomp) && empty($cidade))
      {
          $cidade = $cidade_autocomp;
      }
      if (!empty($presenca_autocomp) && empty($presenca))
      {
          $presenca = $presenca_autocomp;
      }
      if (!empty($contato_autocomp) && empty($contato))
      {
          $contato = $contato_autocomp;
      }
      $evento_id_cond_salva = $evento_id_cond; 
      if (!isset($evento_id_input_2) || $evento_id_input_2 == "")
      {
          $evento_id_input_2 = $evento_id;
      }
      $evento_dsc_cond_salva = $evento_dsc_cond; 
      if (!isset($evento_dsc_input_2) || $evento_dsc_input_2 == "")
      {
          $evento_dsc_input_2 = $evento_dsc;
      }
      $cpf_cond_salva = $cpf_cond; 
      if (!isset($cpf_input_2) || $cpf_input_2 == "")
      {
          $cpf_input_2 = $cpf;
      }
      $nome_participante_cond_salva = $nome_participante_cond; 
      if (!isset($nome_participante_input_2) || $nome_participante_input_2 == "")
      {
          $nome_participante_input_2 = $nome_participante;
      }
      $tipo_pessoa_cond_salva = $tipo_pessoa_cond; 
      if (!isset($tipo_pessoa_input_2) || $tipo_pessoa_input_2 == "")
      {
          $tipo_pessoa_input_2 = $tipo_pessoa;
      }
      $checkin_cond_salva = $checkin_cond; 
      if (!isset($checkin_input_2_dia) || $checkin_input_2_dia == "") {
          $checkin_input_2_dia = $checkin_dia;
      }
      if (!isset($checkin_input_2_mes) || $checkin_input_2_mes == "") {
          $checkin_input_2_mes = $checkin_mes;
      }
      if (!isset($checkin_input_2_ano) || $checkin_input_2_ano == "") {
          $checkin_input_2_ano = $checkin_ano;
      }
      $checkout_cond_salva = $checkout_cond; 
      if (!isset($checkout_input_2_dia) || $checkout_input_2_dia == "") {
          $checkout_input_2_dia = $checkout_dia;
      }
      if (!isset($checkout_input_2_mes) || $checkout_input_2_mes == "") {
          $checkout_input_2_mes = $checkout_mes;
      }
      if (!isset($checkout_input_2_ano) || $checkout_input_2_ano == "") {
          $checkout_input_2_ano = $checkout_ano;
      }
      $hotel_cond_salva = $hotel_cond; 
      if (!isset($hotel_input_2) || $hotel_input_2 == "")
      {
          $hotel_input_2 = $hotel;
      }
      $hotel_dsc_cond_salva = $hotel_dsc_cond; 
      if (!isset($hotel_dsc_input_2) || $hotel_dsc_input_2 == "")
      {
          $hotel_dsc_input_2 = $hotel_dsc;
      }
      $comprado_bvt_cond_salva = $comprado_bvt_cond; 
      if (!isset($comprado_bvt_input_2) || $comprado_bvt_input_2 == "")
      {
          $comprado_bvt_input_2 = $comprado_bvt;
      }
      $publico_cond_salva = $publico_cond; 
      if (!isset($publico_input_2) || $publico_input_2 == "")
      {
          $publico_input_2 = $publico;
      }
      $publico_dsc_cond_salva = $publico_dsc_cond; 
      if (!isset($publico_dsc_input_2) || $publico_dsc_input_2 == "")
      {
          $publico_dsc_input_2 = $publico_dsc;
      }
      $regional_cond_salva = $regional_cond; 
      if (!isset($regional_input_2) || $regional_input_2 == "")
      {
          $regional_input_2 = $regional;
      }
      $regional_dsc_cond_salva = $regional_dsc_cond; 
      if (!isset($regional_dsc_input_2) || $regional_dsc_input_2 == "")
      {
          $regional_dsc_input_2 = $regional_dsc;
      }
      $cidade_cond_salva = $cidade_cond; 
      if (!isset($cidade_input_2) || $cidade_input_2 == "")
      {
          $cidade_input_2 = $cidade;
      }
      $presenca_cond_salva = $presenca_cond; 
      if (!isset($presenca_input_2) || $presenca_input_2 == "")
      {
          $presenca_input_2 = $presenca;
      }
      $contato_cond_salva = $contato_cond; 
      if (!isset($contato_input_2) || $contato_input_2 == "")
      {
          $contato_input_2 = $contato;
      }
      if ($evento_id_cond != "in")
      {
          nm_limpa_numero($evento_id, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      if ($hotel_cond != "in")
      {
          nm_limpa_numero($hotel, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      if ($publico_cond != "in")
      {
          nm_limpa_numero($publico, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      if ($regional_cond != "in")
      {
          nm_limpa_numero($regional, $_SESSION['scriptcase']['reg_conf']['grup_num']) ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']  = array(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search']  = array(); 
      $I_Grid = 0;
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['evento_id'] = $evento_id; 
      if (is_array($evento_id) && !empty($evento_id))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $evento_id;
      }
      elseif ($evento_id_cond_salva == "nu" || $evento_id_cond_salva == "nn" || $evento_id_cond_salva == "ep" || $evento_id_cond_salva == "ne" || !empty($evento_id))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $evento_id;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['evento_id_cond'] = $evento_id_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "evento_id"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $evento_id_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq']['evento_id'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['evento_dsc'] = $evento_dsc; 
      if (is_array($evento_dsc) && !empty($evento_dsc))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $evento_dsc;
      }
      elseif ($evento_dsc_cond_salva == "nu" || $evento_dsc_cond_salva == "nn" || $evento_dsc_cond_salva == "ep" || $evento_dsc_cond_salva == "ne" || !empty($evento_dsc))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $evento_dsc;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['evento_dsc_cond'] = $evento_dsc_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "evento_dsc"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $evento_dsc_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq']['evento_dsc'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['cpf'] = $cpf; 
      if (is_array($cpf) && !empty($cpf))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $cpf;
      }
      elseif ($cpf_cond_salva == "nu" || $cpf_cond_salva == "nn" || $cpf_cond_salva == "ep" || $cpf_cond_salva == "ne" || !empty($cpf))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $cpf;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['cpf_cond'] = $cpf_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "cpf"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $cpf_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq']['cpf'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['nome_participante'] = $nome_participante; 
      if (is_array($nome_participante) && !empty($nome_participante))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $nome_participante;
      }
      elseif ($nome_participante_cond_salva == "nu" || $nome_participante_cond_salva == "nn" || $nome_participante_cond_salva == "ep" || $nome_participante_cond_salva == "ne" || !empty($nome_participante))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $nome_participante;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['nome_participante_cond'] = $nome_participante_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "nome_participante"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $nome_participante_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq']['nome_participante'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['tipo_pessoa'] = $tipo_pessoa; 
      if (is_array($tipo_pessoa) && !empty($tipo_pessoa))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $tipo_pessoa;
      }
      elseif ($tipo_pessoa_cond_salva == "nu" || $tipo_pessoa_cond_salva == "nn" || $tipo_pessoa_cond_salva == "ep" || $tipo_pessoa_cond_salva == "ne" || !empty($tipo_pessoa))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $tipo_pessoa;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['tipo_pessoa_cond'] = $tipo_pessoa_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "tipo_pessoa"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $tipo_pessoa_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq']['tipo_pessoa'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkin_dia'] = $checkin_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkin_mes'] = $checkin_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkin_ano'] = $checkin_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkin_input_2_dia'] = $checkin_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkin_input_2_mes'] = $checkin_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkin_input_2_ano'] = $checkin_input_2_ano; 
      if (!empty($checkin_dia) || !empty($checkin_mes) || !empty($checkin_ano) || $checkin_cond_salva == "nu" || $checkin_cond_salva == "nn" || $checkin_cond_salva == "ep" || $checkin_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0][] = "D:" . $checkin_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0][] = "M:" . $checkin_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0][] = "Y:" . $checkin_ano;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][1][] = "D:" . $checkin_input_2_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][1][] = "M:" . $checkin_input_2_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][1][] = "Y:" . $checkin_input_2_ano;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkin_cond'] = $checkin_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "checkin"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $checkin_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq']['checkin'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkout_dia'] = $checkout_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkout_mes'] = $checkout_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkout_ano'] = $checkout_ano; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkout_input_2_dia'] = $checkout_input_2_dia; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkout_input_2_mes'] = $checkout_input_2_mes; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkout_input_2_ano'] = $checkout_input_2_ano; 
      if (!empty($checkout_dia) || !empty($checkout_mes) || !empty($checkout_ano) || $checkout_cond_salva == "nu" || $checkout_cond_salva == "nn" || $checkout_cond_salva == "ep" || $checkout_cond_salva == "ne")
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0][] = "D:" . $checkout_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0][] = "M:" . $checkout_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0][] = "Y:" . $checkout_ano;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][1][] = "D:" . $checkout_input_2_dia;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][1][] = "M:" . $checkout_input_2_mes;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][1][] = "Y:" . $checkout_input_2_ano;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkout_cond'] = $checkout_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "checkout"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $checkout_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq']['checkout'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['hotel'] = $hotel; 
      if (is_array($hotel) && !empty($hotel))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $hotel;
      }
      elseif ($hotel_cond_salva == "nu" || $hotel_cond_salva == "nn" || $hotel_cond_salva == "ep" || $hotel_cond_salva == "ne" || !empty($hotel))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $hotel;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['hotel_cond'] = $hotel_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "hotel"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $hotel_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq']['hotel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['hotel_dsc'] = $hotel_dsc; 
      if (is_array($hotel_dsc) && !empty($hotel_dsc))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $hotel_dsc;
      }
      elseif ($hotel_dsc_cond_salva == "nu" || $hotel_dsc_cond_salva == "nn" || $hotel_dsc_cond_salva == "ep" || $hotel_dsc_cond_salva == "ne" || !empty($hotel_dsc))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $hotel_dsc;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['hotel_dsc_cond'] = $hotel_dsc_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "hotel_dsc"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $hotel_dsc_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq']['hotel_dsc'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['comprado_bvt'] = $comprado_bvt; 
      if (is_array($comprado_bvt) && !empty($comprado_bvt))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $comprado_bvt;
      }
      elseif ($comprado_bvt_cond_salva == "nu" || $comprado_bvt_cond_salva == "nn" || $comprado_bvt_cond_salva == "ep" || $comprado_bvt_cond_salva == "ne" || !empty($comprado_bvt))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $comprado_bvt;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['comprado_bvt_cond'] = $comprado_bvt_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "comprado_bvt"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $comprado_bvt_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq']['comprado_bvt'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['publico'] = $publico; 
      if (is_array($publico) && !empty($publico))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $publico;
      }
      elseif ($publico_cond_salva == "nu" || $publico_cond_salva == "nn" || $publico_cond_salva == "ep" || $publico_cond_salva == "ne" || !empty($publico))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $publico;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['publico_cond'] = $publico_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "publico"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $publico_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq']['publico'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['publico_dsc'] = $publico_dsc; 
      if (is_array($publico_dsc) && !empty($publico_dsc))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $publico_dsc;
      }
      elseif ($publico_dsc_cond_salva == "nu" || $publico_dsc_cond_salva == "nn" || $publico_dsc_cond_salva == "ep" || $publico_dsc_cond_salva == "ne" || !empty($publico_dsc))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $publico_dsc;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['publico_dsc_cond'] = $publico_dsc_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "publico_dsc"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $publico_dsc_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq']['publico_dsc'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['regional'] = $regional; 
      if (is_array($regional) && !empty($regional))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $regional;
      }
      elseif ($regional_cond_salva == "nu" || $regional_cond_salva == "nn" || $regional_cond_salva == "ep" || $regional_cond_salva == "ne" || !empty($regional))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $regional;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['regional_cond'] = $regional_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "regional"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $regional_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq']['regional'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['regional_dsc'] = $regional_dsc; 
      if (is_array($regional_dsc) && !empty($regional_dsc))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $regional_dsc;
      }
      elseif ($regional_dsc_cond_salva == "nu" || $regional_dsc_cond_salva == "nn" || $regional_dsc_cond_salva == "ep" || $regional_dsc_cond_salva == "ne" || !empty($regional_dsc))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $regional_dsc;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['regional_dsc_cond'] = $regional_dsc_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "regional_dsc"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $regional_dsc_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq']['regional_dsc'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['cidade'] = $cidade; 
      if (is_array($cidade) && !empty($cidade))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $cidade;
      }
      elseif ($cidade_cond_salva == "nu" || $cidade_cond_salva == "nn" || $cidade_cond_salva == "ep" || $cidade_cond_salva == "ne" || !empty($cidade))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $cidade;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['cidade_cond'] = $cidade_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "cidade"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $cidade_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq']['cidade'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['presenca'] = $presenca; 
      if (is_array($presenca) && !empty($presenca))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $presenca;
      }
      elseif ($presenca_cond_salva == "nu" || $presenca_cond_salva == "nn" || $presenca_cond_salva == "ep" || $presenca_cond_salva == "ne" || !empty($presenca))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $presenca;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['presenca_cond'] = $presenca_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "presenca"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $presenca_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq']['presenca'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $Dyn_ok = false;
      $Grid_ok = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['contato'] = $contato; 
      if (is_array($contato) && !empty($contato))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0] = $contato;
      }
      elseif ($contato_cond_salva == "nu" || $contato_cond_salva == "nn" || $contato_cond_salva == "ep" || $contato_cond_salva == "ne" || !empty($contato))
      {
          $Grid_ok = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['val'][0][0] = $contato;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['contato_cond'] = $contato_cond_salva; 
      if ($Grid_ok)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['cmp'] = "contato"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid]['opc'] = $contato_cond_salva; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq']['contato'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search'][$I_Grid];
          $I_Grid++;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['NM_operador'] = $this->NM_operador; 
      if ($this->NM_ajax_flag && $this->NM_ajax_opcao == "ajax_grid_search")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'] = $Temp_Busca;
      }
      if (!empty($this->Campos_Mens_erro)) 
      {
          return;
      }
      $Conteudo = $evento_id;
      if (strtoupper($evento_id_cond) != "II" && strtoupper($evento_id_cond) != "QP" && strtoupper($evento_id_cond) != "NP" && strtoupper($evento_id_cond) != "IN") 
      { 
          nmgp_Form_Num_Val($Conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      } 
      $this->cmp_formatado['evento_id'] = $Conteudo;
      $this->cmp_formatado['evento_id'] = "'" . $this->cmp_formatado['evento_id'] . "'";
      if (isset($this->cmp_formatado['evento_id_input_2'])  && !empty($this->cmp_formatado['evento_id_input_2'])) {
          $this->cmp_formatado['evento_id_input_2'] = "'" . $this->cmp_formatado['evento_id_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($evento_dsc != '') {
      $evento_dsc_look = (is_string($evento_dsc) ? substr($this->Db->qstr($evento_dsc), 1, -1) : $evento_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct evento_dsc from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#evento_dsc#lowerF# = #lowerI#'$evento_dsc_look'#lowerF# order by evento_dsc"; 
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
          $this->cmp_formatado['evento_dsc'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['evento_dsc'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['evento_dsc'] = $evento_dsc;
      }
      $this->cmp_formatado['evento_dsc'] = "'" . $this->cmp_formatado['evento_dsc'] . "'";
      if (isset($this->cmp_formatado['evento_dsc_input_2'])  && !empty($this->cmp_formatado['evento_dsc_input_2'])) {
          $this->cmp_formatado['evento_dsc_input_2'] = "'" . $this->cmp_formatado['evento_dsc_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($cpf != '') {
      $cpf_look = (is_string($cpf) ? substr($this->Db->qstr($cpf), 1, -1) : $cpf); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct cpf from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#cpf#lowerF# = #lowerI#'$cpf_look'#lowerF# order by cpf"; 
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
    if ($nome_participante != '') {
      $nome_participante_look = (is_string($nome_participante) ? substr($this->Db->qstr($nome_participante), 1, -1) : $nome_participante); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct nome_participante from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#nome_participante#lowerF# = #lowerI#'$nome_participante_look'#lowerF# order by nome_participante"; 
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
          $this->cmp_formatado['nome_participante'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['nome_participante'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['nome_participante'] = $nome_participante;
      }
      $this->cmp_formatado['nome_participante'] = "'" . $this->cmp_formatado['nome_participante'] . "'";
      if (isset($this->cmp_formatado['nome_participante_input_2'])  && !empty($this->cmp_formatado['nome_participante_input_2'])) {
          $this->cmp_formatado['nome_participante_input_2'] = "'" . $this->cmp_formatado['nome_participante_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($tipo_pessoa != '') {
      $tipo_pessoa_look = (is_string($tipo_pessoa) ? substr($this->Db->qstr($tipo_pessoa), 1, -1) : $tipo_pessoa); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct tipo_pessoa from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#tipo_pessoa#lowerF# = #lowerI#'$tipo_pessoa_look'#lowerF# order by tipo_pessoa"; 
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
      $this->cmp_formatado['checkin'] = "'" . $this->cmp_formatado['checkin'] . "'";
      if (isset($this->cmp_formatado['checkin_input_2'])  && !empty($this->cmp_formatado['checkin_input_2'])) {
          $this->cmp_formatado['checkin_input_2'] = "'" . $this->cmp_formatado['checkin_input_2'] . "'";
      }
      $this->cmp_formatado['checkout'] = "'" . $this->cmp_formatado['checkout'] . "'";
      if (isset($this->cmp_formatado['checkout_input_2'])  && !empty($this->cmp_formatado['checkout_input_2'])) {
          $this->cmp_formatado['checkout_input_2'] = "'" . $this->cmp_formatado['checkout_input_2'] . "'";
      }
      $Conteudo = $hotel;
      if (strtoupper($hotel_cond) != "II" && strtoupper($hotel_cond) != "QP" && strtoupper($hotel_cond) != "NP" && strtoupper($hotel_cond) != "IN") 
      { 
          nmgp_Form_Num_Val($Conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      } 
      $this->cmp_formatado['hotel'] = $Conteudo;
      $this->cmp_formatado['hotel'] = "'" . $this->cmp_formatado['hotel'] . "'";
      if (isset($this->cmp_formatado['hotel_input_2'])  && !empty($this->cmp_formatado['hotel_input_2'])) {
          $this->cmp_formatado['hotel_input_2'] = "'" . $this->cmp_formatado['hotel_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($hotel_dsc != '') {
      $hotel_dsc_look = (is_string($hotel_dsc) ? substr($this->Db->qstr($hotel_dsc), 1, -1) : $hotel_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct hotel_dsc from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#hotel_dsc#lowerF# = #lowerI#'$hotel_dsc_look'#lowerF# order by hotel_dsc"; 
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
      $nmgp_def_dados = array();
    if ($comprado_bvt != '') {
      $comprado_bvt_look = (is_string($comprado_bvt) ? substr($this->Db->qstr($comprado_bvt), 1, -1) : $comprado_bvt); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct comprado_bvt from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#comprado_bvt#lowerF# = #lowerI#'$comprado_bvt_look'#lowerF# order by comprado_bvt"; 
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
          $this->cmp_formatado['comprado_bvt'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['comprado_bvt'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['comprado_bvt'] = $comprado_bvt;
      }
      $this->cmp_formatado['comprado_bvt'] = "'" . $this->cmp_formatado['comprado_bvt'] . "'";
      if (isset($this->cmp_formatado['comprado_bvt_input_2'])  && !empty($this->cmp_formatado['comprado_bvt_input_2'])) {
          $this->cmp_formatado['comprado_bvt_input_2'] = "'" . $this->cmp_formatado['comprado_bvt_input_2'] . "'";
      }
      $Conteudo = $publico;
      if (strtoupper($publico_cond) != "II" && strtoupper($publico_cond) != "QP" && strtoupper($publico_cond) != "NP" && strtoupper($publico_cond) != "IN") 
      { 
          nmgp_Form_Num_Val($Conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      } 
      $this->cmp_formatado['publico'] = $Conteudo;
      $this->cmp_formatado['publico'] = "'" . $this->cmp_formatado['publico'] . "'";
      if (isset($this->cmp_formatado['publico_input_2'])  && !empty($this->cmp_formatado['publico_input_2'])) {
          $this->cmp_formatado['publico_input_2'] = "'" . $this->cmp_formatado['publico_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($publico_dsc != '') {
      $publico_dsc_look = (is_string($publico_dsc) ? substr($this->Db->qstr($publico_dsc), 1, -1) : $publico_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct publico_dsc from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#publico_dsc#lowerF# = #lowerI#'$publico_dsc_look'#lowerF# order by publico_dsc"; 
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
      $Conteudo = $regional;
      if (strtoupper($regional_cond) != "II" && strtoupper($regional_cond) != "QP" && strtoupper($regional_cond) != "NP" && strtoupper($regional_cond) != "IN") 
      { 
          nmgp_Form_Num_Val($Conteudo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "1", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      } 
      $this->cmp_formatado['regional'] = $Conteudo;
      $this->cmp_formatado['regional'] = "'" . $this->cmp_formatado['regional'] . "'";
      if (isset($this->cmp_formatado['regional_input_2'])  && !empty($this->cmp_formatado['regional_input_2'])) {
          $this->cmp_formatado['regional_input_2'] = "'" . $this->cmp_formatado['regional_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($regional_dsc != '') {
      $regional_dsc_look = (is_string($regional_dsc) ? substr($this->Db->qstr($regional_dsc), 1, -1) : $regional_dsc); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct regional_dsc from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#regional_dsc#lowerF# = #lowerI#'$regional_dsc_look'#lowerF# order by regional_dsc"; 
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
          $this->cmp_formatado['regional_dsc'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['regional_dsc'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['regional_dsc'] = $regional_dsc;
      }
      $this->cmp_formatado['regional_dsc'] = "'" . $this->cmp_formatado['regional_dsc'] . "'";
      if (isset($this->cmp_formatado['regional_dsc_input_2'])  && !empty($this->cmp_formatado['regional_dsc_input_2'])) {
          $this->cmp_formatado['regional_dsc_input_2'] = "'" . $this->cmp_formatado['regional_dsc_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($cidade != '') {
      $cidade_look = (is_string($cidade) ? substr($this->Db->qstr($cidade), 1, -1) : $cidade); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct cidade from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#cidade#lowerF# = #lowerI#'$cidade_look'#lowerF# order by cidade"; 
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
          $this->cmp_formatado['cidade'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['cidade'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['cidade'] = $cidade;
      }
      $this->cmp_formatado['cidade'] = "'" . $this->cmp_formatado['cidade'] . "'";
      if (isset($this->cmp_formatado['cidade_input_2'])  && !empty($this->cmp_formatado['cidade_input_2'])) {
          $this->cmp_formatado['cidade_input_2'] = "'" . $this->cmp_formatado['cidade_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($presenca != '') {
      $presenca_look = (is_string($presenca) ? substr($this->Db->qstr($presenca), 1, -1) : $presenca); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct presenca from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#presenca#lowerF# = #lowerI#'$presenca_look'#lowerF# order by presenca"; 
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
          $this->cmp_formatado['presenca'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['presenca'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['presenca'] = $presenca;
      }
      $this->cmp_formatado['presenca'] = "'" . $this->cmp_formatado['presenca'] . "'";
      if (isset($this->cmp_formatado['presenca_input_2'])  && !empty($this->cmp_formatado['presenca_input_2'])) {
          $this->cmp_formatado['presenca_input_2'] = "'" . $this->cmp_formatado['presenca_input_2'] . "'";
      }
      $nmgp_def_dados = array();
    if ($contato != '') {
      $contato_look = (is_string($contato) ? substr($this->Db->qstr($contato), 1, -1) : $contato); 
      $nmgp_def_dados = array(); 
      $nm_comando = "select distinct contato from " . $this->Ini->nm_tabela . " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "') and #lowerI#contato#lowerF# = #lowerI#'$contato_look'#lowerF# order by contato"; 
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
          $this->cmp_formatado['contato'] = $cmp2;
      }
      elseif (!empty($nmgp_def_dados) && isset($cmp1) && !empty($cmp1))
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
             $cmp1 = NM_conv_charset($cmp1, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cmp_formatado['contato'] = $cmp1;
      }
      else
      {
          $this->cmp_formatado['contato'] = $contato;
      }
      $this->cmp_formatado['contato'] = "'" . $this->cmp_formatado['contato'] . "'";
      if (isset($this->cmp_formatado['contato_input_2'])  && !empty($this->cmp_formatado['contato_input_2'])) {
          $this->cmp_formatado['contato_input_2'] = "'" . $this->cmp_formatado['contato_input_2'] . "'";
      }
   }

   function processa_campos($Res_comp='pesq')
   {
      global $evento_id_cond, $evento_id,
             $evento_dsc_cond, $evento_dsc, $evento_dsc_autocomp,
             $cpf_cond, $cpf, $cpf_autocomp,
             $nome_participante_cond, $nome_participante, $nome_participante_autocomp,
             $tipo_pessoa_cond, $tipo_pessoa, $tipo_pessoa_autocomp,
             $checkin_cond, $checkin, $checkin_dia, $checkin_mes, $checkin_ano, $checkin_input_2_dia, $checkin_input_2_mes, $checkin_input_2_ano,
             $checkout_cond, $checkout, $checkout_dia, $checkout_mes, $checkout_ano, $checkout_input_2_dia, $checkout_input_2_mes, $checkout_input_2_ano,
             $hotel_cond, $hotel,
             $hotel_dsc_cond, $hotel_dsc, $hotel_dsc_autocomp,
             $comprado_bvt_cond, $comprado_bvt, $comprado_bvt_autocomp,
             $publico_cond, $publico,
             $publico_dsc_cond, $publico_dsc, $publico_dsc_autocomp,
             $regional_cond, $regional,
             $regional_dsc_cond, $regional_dsc, $regional_dsc_autocomp,
             $cidade_cond, $cidade, $cidade_autocomp,
             $presenca_cond, $presenca, $presenca_autocomp,
             $contato_cond, $contato, $contato_autocomp, $nmgp_tab_label;


      //----- $evento_id
      $this->Date_part = false;
      if (isset($evento_id) || $evento_id_cond == "nu" || $evento_id_cond == "nn" || $evento_id_cond == "ep" || $evento_id_cond == "ne")
      {
         $this->monta_condicao("evento_id", $evento_id_cond, $evento_id, "", "evento_id", "INT", false);
      }

      //----- $evento_dsc
      $this->Date_part = false;
      if (isset($evento_dsc) || $evento_dsc_cond == "nu" || $evento_dsc_cond == "nn" || $evento_dsc_cond == "ep" || $evento_dsc_cond == "ne")
      {
         $this->monta_condicao("evento_dsc", $evento_dsc_cond, $evento_dsc, "", "evento_dsc", "VARCHAR", false);
      }

      //----- $cpf
      $this->Date_part = false;
      if (isset($cpf) || $cpf_cond == "nu" || $cpf_cond == "nn" || $cpf_cond == "ep" || $cpf_cond == "ne")
      {
         $this->monta_condicao("cpf", $cpf_cond, $cpf, "", "cpf", "VARCHAR", false);
      }

      //----- $nome_participante
      $this->Date_part = false;
      if (isset($nome_participante) || $nome_participante_cond == "nu" || $nome_participante_cond == "nn" || $nome_participante_cond == "ep" || $nome_participante_cond == "ne")
      {
         $this->monta_condicao("nome_participante", $nome_participante_cond, $nome_participante, "", "nome_participante", "VARCHAR", false);
      }

      //----- $tipo_pessoa
      $this->Date_part = false;
      if (isset($tipo_pessoa) || $tipo_pessoa_cond == "nu" || $tipo_pessoa_cond == "nn" || $tipo_pessoa_cond == "ep" || $tipo_pessoa_cond == "ne")
      {
         $this->monta_condicao("tipo_pessoa", $tipo_pessoa_cond, $tipo_pessoa, "", "tipo_pessoa", "VARCHAR", false);
      }

      //----- $checkin
      $this->Date_part = false;
      if ($checkin_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $checkin_cond = strtoupper($checkin_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $checkin_ano;
          $Dtxt .= $checkin_mes;
          $Dtxt .= $checkin_dia;
          $val[0]['ano'] = $checkin_ano;
          $val[0]['mes'] = $checkin_mes;
          $val[0]['dia'] = $checkin_dia;
          if ($checkin_cond == "BW")
          {
              $val[1]['ano'] = $checkin_input_2_ano;
              $val[1]['mes'] = $checkin_input_2_mes;
              $val[1]['dia'] = $checkin_input_2_dia;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->nm_prep_date($val, "DT", "DATETIME", $checkin_cond, "", "data");
          }
          else
          {
              $this->nm_prep_date($val, "DT", "DATE", $checkin_cond, "", "data");
          }
          if (!$this->Date_part) {
              $val[0] = $this->Ini->sc_Date_Protect($val[0]);
          }
          $checkin = $val[0];
          $this->cmp_formatado['checkin'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkin'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['checkin'], "YYYY-MM-DD");
          $this->cmp_formatado['checkin'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['checkin'] = "'" . $this->cmp_formatado['checkin'] . "'";
          if ($checkin_cond == "BW")
          {
              if (!$this->Date_part) {
                  $val[1] = $this->Ini->sc_Date_Protect($val[1]);
              }
              $checkin_input_2     = $val[1];
              $this->cmp_formatado['checkin_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkin_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['checkin_input_2'], "YYYY-MM-DD");
              $this->cmp_formatado['checkin_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['checkin_input_2'] = "'" . $this->cmp_formatado['checkin_input_2'] . "'";
          }
          if (!empty($Dtxt) || $checkin_cond == "NU" || $checkin_cond == "NN"|| $checkin_cond == "EP"|| $checkin_cond == "NE")
          {
              $this->monta_condicao("checkin", $checkin_cond, $checkin, $checkin_input_2, 'checkin', 'DATE');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq']['checkin']['label'] = $nmgp_tab_label['checkin'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq']['checkin']['descr'] = $nmgp_tab_label['checkin'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq']['checkin']['hint']  = $nmgp_tab_label['checkin'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $checkout
      $this->Date_part = false;
      if ($checkout_cond != "bi_TP" && $Res_comp != 'calend')
      {
          $checkout_cond = strtoupper($checkout_cond);
          $Dtxt = "";
          $val  = array();
          $Dtxt .= $checkout_ano;
          $Dtxt .= $checkout_mes;
          $Dtxt .= $checkout_dia;
          $val[0]['ano'] = $checkout_ano;
          $val[0]['mes'] = $checkout_mes;
          $val[0]['dia'] = $checkout_dia;
          if ($checkout_cond == "BW")
          {
              $val[1]['ano'] = $checkout_input_2_ano;
              $val[1]['mes'] = $checkout_input_2_mes;
              $val[1]['dia'] = $checkout_input_2_dia;
          }
          $this->Operador_date_part = "";
          $this->Lang_date_part     = "";
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->nm_prep_date($val, "DT", "DATETIME", $checkout_cond, "", "data");
          }
          else
          {
              $this->nm_prep_date($val, "DT", "DATE", $checkout_cond, "", "data");
          }
          if (!$this->Date_part) {
              $val[0] = $this->Ini->sc_Date_Protect($val[0]);
          }
          $checkout = $val[0];
          $this->cmp_formatado['checkout'] = $val[0];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkout'] = $val[0];
          $this->nm_data->SetaData($this->cmp_formatado['checkout'], "YYYY-MM-DD");
          $this->cmp_formatado['checkout'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['checkout'] = "'" . $this->cmp_formatado['checkout'] . "'";
          if ($checkout_cond == "BW")
          {
              if (!$this->Date_part) {
                  $val[1] = $this->Ini->sc_Date_Protect($val[1]);
              }
              $checkout_input_2     = $val[1];
              $this->cmp_formatado['checkout_input_2'] = $val[1];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']['checkout_input_2'] = $val[1];
              $this->nm_data->SetaData($this->cmp_formatado['checkout_input_2'], "YYYY-MM-DD");
              $this->cmp_formatado['checkout_input_2'] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "dmY"));
          $this->cmp_formatado['checkout_input_2'] = "'" . $this->cmp_formatado['checkout_input_2'] . "'";
          }
          if (!empty($Dtxt) || $checkout_cond == "NU" || $checkout_cond == "NN"|| $checkout_cond == "EP"|| $checkout_cond == "NE")
          {
              $this->monta_condicao("checkout", $checkout_cond, $checkout, $checkout_input_2, 'checkout', 'DATE');
          }
      }
      elseif ($Res_comp == 'pesq')
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq']['checkout']['label'] = $nmgp_tab_label['checkout'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq']['checkout']['descr'] = $nmgp_tab_label['checkout'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq']['checkout']['hint']  = $nmgp_tab_label['checkout'] . " " . $this->Ini->Nm_lang['lang_srch_ever'];
      }

      //----- $hotel
      $this->Date_part = false;
      if (isset($hotel) || $hotel_cond == "nu" || $hotel_cond == "nn" || $hotel_cond == "ep" || $hotel_cond == "ne")
      {
         $this->monta_condicao("hotel", $hotel_cond, $hotel, "", "hotel", "INT", false);
      }

      //----- $hotel_dsc
      $this->Date_part = false;
      if (isset($hotel_dsc) || $hotel_dsc_cond == "nu" || $hotel_dsc_cond == "nn" || $hotel_dsc_cond == "ep" || $hotel_dsc_cond == "ne")
      {
         $this->monta_condicao("hotel_dsc", $hotel_dsc_cond, $hotel_dsc, "", "hotel_dsc", "VARCHAR", false);
      }

      //----- $comprado_bvt
      $this->Date_part = false;
      if (isset($comprado_bvt) || $comprado_bvt_cond == "nu" || $comprado_bvt_cond == "nn" || $comprado_bvt_cond == "ep" || $comprado_bvt_cond == "ne")
      {
         $this->monta_condicao("comprado_bvt", $comprado_bvt_cond, $comprado_bvt, "", "comprado_bvt", "VARCHAR", false);
      }

      //----- $publico
      $this->Date_part = false;
      if (isset($publico) || $publico_cond == "nu" || $publico_cond == "nn" || $publico_cond == "ep" || $publico_cond == "ne")
      {
         $this->monta_condicao("publico", $publico_cond, $publico, "", "publico", "INT", false);
      }

      //----- $publico_dsc
      $this->Date_part = false;
      if (isset($publico_dsc) || $publico_dsc_cond == "nu" || $publico_dsc_cond == "nn" || $publico_dsc_cond == "ep" || $publico_dsc_cond == "ne")
      {
         $this->monta_condicao("publico_dsc", $publico_dsc_cond, $publico_dsc, "", "publico_dsc", "VARCHAR", false);
      }

      //----- $regional
      $this->Date_part = false;
      if (isset($regional) || $regional_cond == "nu" || $regional_cond == "nn" || $regional_cond == "ep" || $regional_cond == "ne")
      {
         $this->monta_condicao("regional", $regional_cond, $regional, "", "regional", "INT", false);
      }

      //----- $regional_dsc
      $this->Date_part = false;
      if (isset($regional_dsc) || $regional_dsc_cond == "nu" || $regional_dsc_cond == "nn" || $regional_dsc_cond == "ep" || $regional_dsc_cond == "ne")
      {
         $this->monta_condicao("regional_dsc", $regional_dsc_cond, $regional_dsc, "", "regional_dsc", "VARCHAR", false);
      }

      //----- $cidade
      $this->Date_part = false;
      if (isset($cidade) || $cidade_cond == "nu" || $cidade_cond == "nn" || $cidade_cond == "ep" || $cidade_cond == "ne")
      {
         $this->monta_condicao("cidade", $cidade_cond, $cidade, "", "cidade", "VARCHAR", false);
      }

      //----- $presenca
      $this->Date_part = false;
      if (isset($presenca) || $presenca_cond == "nu" || $presenca_cond == "nn" || $presenca_cond == "ep" || $presenca_cond == "ne")
      {
         $this->monta_condicao("presenca", $presenca_cond, $presenca, "", "presenca", "VARCHAR", false);
      }

      //----- $contato
      $this->Date_part = false;
      if (isset($contato) || $contato_cond == "nu" || $contato_cond == "nn" || $contato_cond == "ep" || $contato_cond == "ne")
      {
         $this->monta_condicao("contato", $contato_cond, $contato, "", "contato", "VARCHAR", false);
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
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_grid'] = $this->comando;
       if (empty($this->comando)) 
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_filtro'] = "";
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_orig'];
       }
       else
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_filtro'] = "( " . $this->comando . " )";
           if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_orig'])) 
           {
               $this->comando = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_orig'] . " and (" . $this->comando . ")"; 
           }
           else
           {
               $this->comando = " where " . $this->comando; 
           }
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq'] = $this->comando;
       }
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_fast'])) 
       {
           if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq'])) 
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq'] .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_fast'] . ")";
           }
           else 
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq'] = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_fast'] . ")";
           }
       }
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_interativ'])) 
       {
           if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq'])) 
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq'] .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_interativ'] . ")";
           }
           else 
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq'] = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_interativ'];
           }
       }
   }
   function finaliza_resultado()
   {
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['dyn_search']      = array();
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['cond_dyn_search'] = "";
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_fast'] = "";
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['fast_search']);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_interativ'] = "";
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['interativ_search'] = array();
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['int_search_dados'] = array();
      if ("" == $this->comando_filtro)
      {
          $this->comando = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_orig'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']) && $_SESSION['scriptcase']['charset'] != "UTF-8")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'], "UTF-8", $_SESSION['scriptcase']['charset']);
      }

      $this->Sel_case_sensitive($this->comando);
      $this->Sel_case_sensitive($this->comando_sum);
      $this->Sel_case_sensitive($this->comando_filtro);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_grid']    = $this->comando_filtro;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_lookup']  = $this->comando_sum . $this->comando_fim;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq']         = $this->comando . $this->comando_fim;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao']              = "pesq";
      if ("" == $this->comando_filtro)
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_filtro'] = "";
      }
      else
      {
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_filtro'] = " (" . trim($this->comando_filtro) . ")";
      }
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['cond_pesq'] .= $this->NM_operador;
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['contr_array_resumo'] = "NAO";
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['contr_total_geral']  = "NAO";
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['tot_geral']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['using_summary_cache']);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq'];

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
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'off';
}


function PrepGeral($vp_evento,$vp_usuario,$vp_tipoPessoa,$vp_nivel) {
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'on';
  	 
		date_default_timezone_set('America/Sao_Paulo');
		$_passa_part = false;                                                                                             
		$ret = 'ADICIONA ERRO';	
		$_trecho_ida = 'IDA';
		$_trecho_volta = 'VOLTA';		                                                                                        
		$w_aerstatus_volta	= '';
		$w_aerstatus_ida = '';
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
					evento_id = ".$this->Db->qstr($vp_evento)."
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
		
		if ($vp_tipoPessoa == 'P') {                                                                                      			
			$sqld="                                                                                                          
			DELETE FROM                                                                                                      
			geral_rsvp_r
			WHERE                                                                                                            
				evento_id = ".$this->Db->qstr($vp_evento)."                                                                                     
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
                                                                                       
			
		}	
		if ($vp_tipoPessoa == 'P') {  
			if($vp_nivel <> 'CONVIDADO') {
				$sqlMestre = "
				SELECT
					participantes_rsvp.part_cpf, 				               	                            	       
					participantes_rsvp.nome_pessoa,                         
					participantes_rsvp.part_id_evento,	                         
					participantes_rsvp.part_nome_cracha,                            
					participantes_rsvp.part_tam_camisa,                  
					participantes_rsvp.part_tam_calcado,                 
					participantes_rsvp.part_cargo,                       
					participantes_rsvp.part_empresa,                     
					participantes_rsvp.part_departamento,                   
					participantes_rsvp.part_grupo,                          
					participantes_rsvp.part_id_evento_publico,              
					participantes_rsvp.part_id_evento_regional,             
					participantes_rsvp.part_dt_cadastro,                    
					participantes_rsvp.part_logradouro,                     
					participantes_rsvp.part_complemento,                    
					participantes_rsvp.part_bairro,                         
					participantes_rsvp.part_cidade,                         
					participantes_rsvp.part_cep,                            
					participantes_rsvp.part_uf,	                              
					participantes_rsvp.part_pais,                           
					participantes_rsvp.part_ddd_01,                         
					participantes_rsvp.part_fone_01,                        
					participantes_rsvp.part_ddd_celular_01,                 
					participantes_rsvp.part_celeular_01,                    
					participantes_rsvp.part_passaporte,                     
					participantes_rsvp.part_validade_pass,                  
					participantes_rsvp.part_rg,                             
					participantes_rsvp.part_filiacao,                       
					participantes_rsvp.part_dt_nasc,                        
					participantes_rsvp.part_fumante,                        
					participantes_rsvp.part_restricao_alimentar,            
					participantes_rsvp.part_email,                          
					participantes_rsvp.part_dt_alt_presenca,                
					participantes_rsvp.part_presenca,                       
					participantes_rsvp.part_contato_rsvp,                   
					participantes_rsvp.part_nome_substituto, 				 				
					hospedagem_rsvp.hosp_cpf_participante,                      
					hospedagem_rsvp.hosp_id_evento,                             
					hospedagem_rsvp.hosp_acompanhante,                          
					hospedagem_rsvp.hosp_part_acomp,                            
					hospedagem_rsvp.hosp_dt_checkin,                            
					hospedagem_rsvp.hosp_dt_checkout,                           
					hospedagem_rsvp.hosp_id_hotel,                              
					hospedagem_rsvp.hosp_reserva_bvt,                           				                          
					transfer_rsvp.tra_id_evento,                                   
					transfer_rsvp.tra_cpf_particip,                                
					transfer_rsvp.tra_dt_saida_ida,                                
					transfer_rsvp.tra_hr_saida_ida,                                
					transfer_rsvp.tra_dt_chegada_ida,                              
					transfer_rsvp.tra_hr_chegada_ida,                              
					transfer_rsvp.tra_cia_ida,                                     
					transfer_rsvp.tra_origem_ida,                                  
					transfer_rsvp.tra_destino_ida,                                 
					transfer_rsvp.tra_numvoo_ida,                                  
					transfer_rsvp.tra_localizador_ida,                             
					transfer_rsvp.tra_eticket_ida,                                 
					transfer_rsvp.tra_hrtransout,                                  
					transfer_rsvp.tra_dt_ida_local,                                
					transfer_rsvp.tra_hr_ida_local,                                
					transfer_rsvp.tra_dt_volta_local,                              
					transfer_rsvp.tra_hr_volta_local,                              
					transfer_rsvp.tra_cia_volta,                                
					transfer_rsvp.tra_origem_volta,                             
					transfer_rsvp.tra_destino_volta,                            
					transfer_rsvp.tra_numvoo_volta,                             
					transfer_rsvp.tra_localizador_volta,                        
					transfer_rsvp.tra_eticket_volta,                            
					transfer_rsvp.tra_observacao,               
					transfer_rsvp.tra_tipo,                            
					hospedagem_rsvp.hosp_early_chkin,  		           
					hospedagem_rsvp.hosp_late_chkout,                    
					transfer_rsvp.tra_status,  					 
					transfer_rsvp.tra_id_hotel_out,				
					transfer_rsvp.tra_dt_saida_volta,			
					transfer_rsvp.tra_hr_saida_volta, 					
					transfer_rsvp.tra_dt_chegada_volta,			
					transfer_rsvp.tra_hr_chegada_volta,
					transfer_rsvp.tra_dt_chegada_proprio,
					transfer_rsvp.tra_hr_chegada_proprio,
					participantes_rsvp.part_cod_substituto,
					hospedagem_rsvp.hosp_diarias,
					hospedagem_rsvp.hosp_taxas,
					anotacoes_rsvp.ant_dsc,
					participantes_rsvp.part_fone_internacional
				FROM                                            		             
					participantes_rsvp                                             
				LEFT JOIN
					hospedagem_rsvp
				ON
					participantes_rsvp.part_cpf = hospedagem_rsvp.hosp_cpf_participante
				AND
					participantes_rsvp.part_id_evento = hospedagem_rsvp.hosp_id_evento		
				LEFT JOIN
					transfer_rsvp
				ON
					participantes_rsvp.part_cpf = transfer_rsvp.tra_cpf_particip		
				AND
					participantes_rsvp.part_id_evento = transfer_rsvp.tra_id_evento					
				LEFT JOIN 
					anotacoes_rsvp 
				ON 
					anotacoes_rsvp.ant_cpf_participante = participantes_rsvp.part_cpf AND anotacoes_rsvp.ant_evento_id = participantes_rsvp.part_id_evento		
				WHERE
					part_id_evento = ".$this->Db->qstr($vp_evento)."                
				AND
					participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)."                   		
				AND 	
					participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)." 	
				GROUP BY
					participantes_rsvp.part_cpf		
				ORDER BY
					participantes_rsvp.nome_pessoa 	
				";	
			} else {
				$sqlMestre = "
				SELECT
					participantes_rsvp.part_cpf, 				               	                            	       
					participantes_rsvp.nome_pessoa,                         
					participantes_rsvp.part_id_evento,	                         
					participantes_rsvp.part_nome_cracha,                            
					participantes_rsvp.part_tam_camisa,                  
					participantes_rsvp.part_tam_calcado,                 
					participantes_rsvp.part_cargo,                       
					participantes_rsvp.part_empresa,                     
					participantes_rsvp.part_departamento,                   
					participantes_rsvp.part_grupo,                          
					participantes_rsvp.part_id_evento_publico,              
					participantes_rsvp.part_id_evento_regional,             
					participantes_rsvp.part_dt_cadastro,                    
					participantes_rsvp.part_logradouro,                     
					participantes_rsvp.part_complemento,                    
					participantes_rsvp.part_bairro,                         
					participantes_rsvp.part_cidade,                         
					participantes_rsvp.part_cep,                            
					participantes_rsvp.part_uf,	                              
					participantes_rsvp.part_pais,                           
					participantes_rsvp.part_ddd_01,                         
					participantes_rsvp.part_fone_01,                        
					participantes_rsvp.part_ddd_celular_01,                 
					participantes_rsvp.part_celeular_01,                    
					participantes_rsvp.part_passaporte,                     
					participantes_rsvp.part_validade_pass,                  
					participantes_rsvp.part_rg,                             
					participantes_rsvp.part_filiacao,                       
					participantes_rsvp.part_dt_nasc,                        
					participantes_rsvp.part_fumante,                        
					participantes_rsvp.part_restricao_alimentar,            
					participantes_rsvp.part_email,                          
					participantes_rsvp.part_dt_alt_presenca,                
					participantes_rsvp.part_presenca,                       
					participantes_rsvp.part_contato_rsvp,                   
					participantes_rsvp.part_nome_substituto, 				 				
					hospedagem_rsvp.hosp_cpf_participante,                      
					hospedagem_rsvp.hosp_id_evento,                             
					hospedagem_rsvp.hosp_acompanhante,                          
					hospedagem_rsvp.hosp_part_acomp,                            
					hospedagem_rsvp.hosp_dt_checkin,                            
					hospedagem_rsvp.hosp_dt_checkout,                           
					hospedagem_rsvp.hosp_id_hotel,                              
					hospedagem_rsvp.hosp_reserva_bvt,                           				                          
					transfer_rsvp.tra_id_evento,                                   
					transfer_rsvp.tra_cpf_particip,                                
					transfer_rsvp.tra_dt_saida_ida,                                
					transfer_rsvp.tra_hr_saida_ida,                                
					transfer_rsvp.tra_dt_chegada_ida,                              
					transfer_rsvp.tra_hr_chegada_ida,                              
					transfer_rsvp.tra_cia_ida,                                     
					transfer_rsvp.tra_origem_ida,                                  
					transfer_rsvp.tra_destino_ida,                                 
					transfer_rsvp.tra_numvoo_ida,                                  
					transfer_rsvp.tra_localizador_ida,                             
					transfer_rsvp.tra_eticket_ida,                                 
					transfer_rsvp.tra_hrtransout,                                  
					transfer_rsvp.tra_dt_ida_local,                                
					transfer_rsvp.tra_hr_ida_local,                                
					transfer_rsvp.tra_dt_volta_local,                              
					transfer_rsvp.tra_hr_volta_local,                              
					transfer_rsvp.tra_cia_volta,                                
					transfer_rsvp.tra_origem_volta,                             
					transfer_rsvp.tra_destino_volta,                            
					transfer_rsvp.tra_numvoo_volta,                             
					transfer_rsvp.tra_localizador_volta,                        
					transfer_rsvp.tra_eticket_volta,                            
					transfer_rsvp.tra_observacao,               
					transfer_rsvp.tra_tipo,                            
					hospedagem_rsvp.hosp_early_chkin,  		           
					hospedagem_rsvp.hosp_late_chkout,                    
					transfer_rsvp.tra_status,  					 
					transfer_rsvp.tra_id_hotel_out,				
					transfer_rsvp.tra_dt_saida_volta,			
					transfer_rsvp.tra_hr_saida_volta, 					
					transfer_rsvp.tra_dt_chegada_volta,			
					transfer_rsvp.tra_hr_chegada_volta,
					transfer_rsvp.tra_dt_chegada_proprio,
					transfer_rsvp.tra_hr_chegada_proprio,
					participantes_rsvp.part_cod_substituto,
					hospedagem_rsvp.hosp_diarias,
					hospedagem_rsvp.hosp_taxas,
					anotacoes_rsvp.ant_dsc,
					participantes_rsvp.part_fone_internacional,
					participantes_rsvp.dsc_empresa_rsvp
				FROM                                            		             
					participantes_rsvp                                             
				LEFT JOIN
					hospedagem_rsvp
				ON
					participantes_rsvp.part_cpf = hospedagem_rsvp.hosp_cpf_participante
				AND
					participantes_rsvp.part_id_evento = hospedagem_rsvp.hosp_id_evento		
				LEFT JOIN
					transfer_rsvp
				ON
					participantes_rsvp.part_cpf = transfer_rsvp.tra_cpf_particip		
				AND
					participantes_rsvp.part_id_evento = transfer_rsvp.tra_id_evento					
				LEFT JOIN 
					anotacoes_rsvp 
				ON 
					anotacoes_rsvp.ant_cpf_participante = participantes_rsvp.part_cpf AND anotacoes_rsvp.ant_evento_id = participantes_rsvp.part_id_evento		
				WHERE
					part_id_evento =  ".$this->Db->qstr($vp_evento)."  
				AND
					participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 	
				AND 	
					participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)." 
				AND
					participantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)." 
				GROUP BY
					participantes_rsvp.part_cpf		
				ORDER BY
					participantes_rsvp.nome_pessoa 	
				";					
			}
			$_passa_part = true;	
			
			
			
		} else {
			if($vp_nivel <> 'CONVIDADO') {
				$sqlMestre = "
				SELECT
					acompanhantes_rsvp.part_cpf, 					
					acompanhantes_rsvp.part_nome, 
					acompanhantes_rsvp.part_id_evento,	
					acompanhantes_rsvp.part_nome_cracha, 	 
					acompanhantes_rsvp.part_tam_camisa, 
					acompanhantes_rsvp.part_tam_calcado,
					acompanhantes_rsvp.part_cargo,
					acompanhantes_rsvp.part_empresa,
					acompanhantes_rsvp.part_departamento,
					acompanhantes_rsvp.part_grupo,
					acompanhantes_rsvp.part_id_evento_publico, 
					acompanhantes_rsvp.part_id_evento_regional, 
					acompanhantes_rsvp.part_dt_cadastro, 
					acompanhantes_rsvp.part_logradouro,
					acompanhantes_rsvp.part_complemento, 
					acompanhantes_rsvp.part_bairro,
					acompanhantes_rsvp.part_cidade,
					acompanhantes_rsvp.part_cep,
					acompanhantes_rsvp.part_uf,	
					acompanhantes_rsvp.part_pais,
					acompanhantes_rsvp.part_ddd_01, 
					acompanhantes_rsvp.part_fone_01, 
					acompanhantes_rsvp.part_ddd_celular_01, 
					acompanhantes_rsvp.part_celeular_01, 
					acompanhantes_rsvp.part_passaporte,
					acompanhantes_rsvp.part_validade_pass,
					acompanhantes_rsvp.part_rg,
					acompanhantes_rsvp.part_filiacao,
					acompanhantes_rsvp.part_dt_nasc, 
					acompanhantes_rsvp.part_fumante,
					acompanhantes_rsvp.part_restricao_alimentar,
					acompanhantes_rsvp.part_email,
					acompanhantes_rsvp.part_dt_alt_presenca,
					acompanhantes_rsvp.part_presenca,
					acompanhantes_rsvp.part_contato_rsvp,
					acompanhantes_rsvp.part_cpf_mestre,				
					hospedagem_rsvp.hosp_cpf_participante,
					hospedagem_rsvp.hosp_id_evento,
					hospedagem_rsvp.hosp_acompanhante,
					hospedagem_rsvp.hosp_part_acomp,
					hospedagem_rsvp.hosp_dt_checkin, 
					hospedagem_rsvp.hosp_dt_checkout,
					hospedagem_rsvp.hosp_id_hotel, 
					hospedagem_rsvp.hosp_reserva_bvt,
					transfer_rsvp.tra_id_evento,
					transfer_rsvp.tra_cpf_particip,
					transfer_rsvp.tra_dt_saida_ida,
					transfer_rsvp.tra_hr_saida_ida,
					transfer_rsvp.tra_dt_chegada_ida,
					transfer_rsvp.tra_hr_chegada_ida,
					transfer_rsvp.tra_cia_ida, 
					transfer_rsvp.tra_origem_ida, 
					transfer_rsvp.tra_destino_ida, 
					transfer_rsvp.tra_numvoo_ida, 
					transfer_rsvp.tra_localizador_ida,
					transfer_rsvp.tra_eticket_ida, 
					transfer_rsvp.tra_hrtransout,
					transfer_rsvp.tra_dt_ida_local,
					transfer_rsvp.tra_hr_ida_local,
					transfer_rsvp.tra_dt_volta_local,
					transfer_rsvp.tra_hr_volta_local,
					transfer_rsvp.tra_cia_volta,
					transfer_rsvp.tra_origem_volta,
					transfer_rsvp.tra_destino_volta,
					transfer_rsvp.tra_numvoo_volta,
					transfer_rsvp.tra_localizador_volta,
					transfer_rsvp.tra_eticket_volta,
					transfer_rsvp.tra_observacao,
					transfer_rsvp.tra_tipo,
					hospedagem_rsvp.hosp_early_chkin,  		
					hospedagem_rsvp.hosp_late_chkout,
					transfer_rsvp.tra_status,
					transfer_rsvp.tra_id_hotel_out,
					transfer_rsvp.tra_dt_saida_volta,	
					transfer_rsvp.tra_hr_saida_volta, 	
					transfer_rsvp.tra_dt_chegada_volta,	
					transfer_rsvp.tra_hr_chegada_volta,
					transfer_rsvp.tra_dt_chegada_proprio,
					transfer_rsvp.tra_hr_chegada_proprio,
					hospedagem_rsvp.hosp_diarias,
					hospedagem_rsvp.hosp_taxas,
					acompanhantes_rsvp.part_fone_internacional					
				FROM 
					acompanhantes_rsvp
				LEFT JOIN
					hospedagem_rsvp
				ON
					acompanhantes_rsvp.part_cpf = hospedagem_rsvp.hosp_cpf_participante
				AND
					acompanhantes_rsvp.part_id_evento = hospedagem_rsvp.hosp_id_evento		
				LEFT JOIN
					transfer_rsvp
				ON
					acompanhantes_rsvp.part_cpf = transfer_rsvp.tra_cpf_particip		
				AND
					acompanhantes_rsvp.part_id_evento = transfer_rsvp.tra_id_evento	
				WHERE
					part_id_evento = ".$this->Db->qstr($vp_evento)." 	
				AND
					acompanhantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)."	
				
				GROUP BY
					acompanhantes_rsvp.part_cpf		
				ORDER BY
					acompanhantes_rsvp.part_nome
				";	
			} else {
				$sqlMestre = "
				SELECT
					acompanhantes_rsvp.part_cpf, 					
					acompanhantes_rsvp.part_nome, 
					acompanhantes_rsvp.part_id_evento,	
					acompanhantes_rsvp.part_nome_cracha, 	 
					acompanhantes_rsvp.part_tam_camisa, 
					acompanhantes_rsvp.part_tam_calcado,
					acompanhantes_rsvp.part_cargo,
					acompanhantes_rsvp.part_empresa,
					acompanhantes_rsvp.part_departamento,
					acompanhantes_rsvp.part_grupo,
					acompanhantes_rsvp.part_id_evento_publico, 
					acompanhantes_rsvp.part_id_evento_regional, 
					acompanhantes_rsvp.part_dt_cadastro, 
					acompanhantes_rsvp.part_logradouro,
					acompanhantes_rsvp.part_complemento, 
					acompanhantes_rsvp.part_bairro,
					acompanhantes_rsvp.part_cidade,
					acompanhantes_rsvp.part_cep,
					acompanhantes_rsvp.part_uf,	
					acompanhantes_rsvp.part_pais,
					acompanhantes_rsvp.part_ddd_01, 
					acompanhantes_rsvp.part_fone_01, 
					acompanhantes_rsvp.part_ddd_celular_01, 
					acompanhantes_rsvp.part_celeular_01, 
					acompanhantes_rsvp.part_passaporte,
					acompanhantes_rsvp.part_validade_pass,
					acompanhantes_rsvp.part_rg,
					acompanhantes_rsvp.part_filiacao,
					acompanhantes_rsvp.part_dt_nasc, 
					acompanhantes_rsvp.part_fumante,
					acompanhantes_rsvp.part_restricao_alimentar,
					acompanhantes_rsvp.part_email,
					acompanhantes_rsvp.part_dt_alt_presenca,
					acompanhantes_rsvp.part_presenca,
					acompanhantes_rsvp.part_contato_rsvp,
					acompanhantes_rsvp.part_cpf_mestre,				
					hospedagem_rsvp.hosp_cpf_participante,
					hospedagem_rsvp.hosp_id_evento,
					hospedagem_rsvp.hosp_acompanhante,
					hospedagem_rsvp.hosp_part_acomp,
					hospedagem_rsvp.hosp_dt_checkin, 
					hospedagem_rsvp.hosp_dt_checkout,
					hospedagem_rsvp.hosp_id_hotel, 
					hospedagem_rsvp.hosp_reserva_bvt,
					transfer_rsvp.tra_id_evento,
					transfer_rsvp.tra_cpf_particip,
					transfer_rsvp.tra_dt_saida_ida,
					transfer_rsvp.tra_hr_saida_ida,
					transfer_rsvp.tra_dt_chegada_ida,
					transfer_rsvp.tra_hr_chegada_ida,
					transfer_rsvp.tra_cia_ida, 
					transfer_rsvp.tra_origem_ida, 
					transfer_rsvp.tra_destino_ida, 
					transfer_rsvp.tra_numvoo_ida, 
					transfer_rsvp.tra_localizador_ida,
					transfer_rsvp.tra_eticket_ida, 
					transfer_rsvp.tra_hrtransout,
					transfer_rsvp.tra_dt_ida_local,
					transfer_rsvp.tra_hr_ida_local,
					transfer_rsvp.tra_dt_volta_local,
					transfer_rsvp.tra_hr_volta_local,
					transfer_rsvp.tra_cia_volta,
					transfer_rsvp.tra_origem_volta,
					transfer_rsvp.tra_destino_volta,
					transfer_rsvp.tra_numvoo_volta,
					transfer_rsvp.tra_localizador_volta,
					transfer_rsvp.tra_eticket_volta,
					transfer_rsvp.tra_observacao,
					transfer_rsvp.tra_tipo,
					hospedagem_rsvp.hosp_early_chkin,  		
					hospedagem_rsvp.hosp_late_chkout,
					transfer_rsvp.tra_status,
					transfer_rsvp.tra_id_hotel_out,
					transfer_rsvp.tra_dt_saida_volta,	
					transfer_rsvp.tra_hr_saida_volta, 	
					transfer_rsvp.tra_dt_chegada_volta,	
					transfer_rsvp.tra_hr_chegada_volta,
					transfer_rsvp.tra_dt_chegada_proprio,
					transfer_rsvp.tra_hr_chegada_proprio,
					hospedagem_rsvp.hosp_diarias,
					hospedagem_rsvp.hosp_taxas,
					acompanhantes_rsvp.part_fone_internacional,
					acompanhantes_rsvp.dsc_empresa_rsvp
				FROM 
					acompanhantes_rsvp
				LEFT JOIN
					hospedagem_rsvp
				ON
					acompanhantes_rsvp.part_cpf = hospedagem_rsvp.hosp_cpf_participante
				AND
					acompanhantes_rsvp.part_id_evento = hospedagem_rsvp.hosp_id_evento		
				LEFT JOIN
					transfer_rsvp
				ON
					acompanhantes_rsvp.part_cpf = transfer_rsvp.tra_cpf_particip		
				AND
					acompanhantes_rsvp.part_id_evento = transfer_rsvp.tra_id_evento	
				WHERE
					part_id_evento = ".$this->Db->qstr($vp_evento)."  	
				AND
					acompanhantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 
				AND
					acompanhantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)."
				GROUP BY
					acompanhantes_rsvp.part_cpf		
				ORDER BY
					acompanhantes_rsvp.part_nome
				";	
			}
			$_passa_part = true;	
		}
		 
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
				if ($vp_tipoPessoa == 'P') {
					$_ap_cpf					= $rsm[$i][0]; 		 
					$_ap_nome               	= $rsm[$i][1];        
					$_ap_id_evento	       		= $rsm[$i][2];        
					$_ap_nome_cracha 	   		= $rsm[$i][3];        
					$_ap_tam_camisa             = $rsm[$i][4];        
					$_ap_tam_calcado            = $rsm[$i][5];        
					$_ap_cargo                  = $rsm[$i][6];        
					$_ap_empresa                = $rsm[$i][7];        
					$_ap_departamento       	= $rsm[$i][8];        
					$_ap_grupo              	= $rsm[$i][9];        
					$_ap_id_evento_publico  	= $rsm[$i][10];       
					$_ap_id_evento_regional 	= $rsm[$i][11];       
					$_ap_dt_cadastro        	= $rsm[$i][12];       
					$_ap_logradouro         	= $rsm[$i][13];       
					$_ap_complemento        	= $rsm[$i][14];       
					$_ap_bairro             	= $rsm[$i][15];       
					$_ap_cidade             	= $rsm[$i][16];       
					$_ap_cep                	= $rsm[$i][17];       
					$_ap_uf	                	= $rsm[$i][18];       
					$_ap_pais               	= $rsm[$i][19];       
					$_ap_ddd_01             	= $rsm[$i][20];       
					$_ap_fone_01            	= $rsm[$i][21];       
					$_ap_ddd_celular_01     	= $rsm[$i][22];       
					$_ap_celeular_01        	= $rsm[$i][23];       
					$_ap_passaporte         	= $rsm[$i][24];       
					$_ap_validade_pass      	= $rsm[$i][25];       
					$_ap_rg                 	= $rsm[$i][26];       
					$_ap_filiacao           	= $rsm[$i][27];       
					$_ap_dt_nasc            	= $rsm[$i][28];       
					$_ap_fumante            	= $rsm[$i][29];       
					$_ap_restricao_alimentar	= $rsm[$i][30];	    
					$_ap_email              	= $rsm[$i][31];       
					$_ap_dt_alt_presenca    	= $rsm[$i][32];       
					$_ap_presenca           	= $rsm[$i][33];       
					$_ap_contato_rsvp       	= $rsm[$i][34];			
					$_ap_nome_substituto 		= $rsm[$i][35];			
					$_ho_cpf_participante   	= $rsm[$i][36];       
					$_ho_id_evento          	= $rsm[$i][37];       
					$_ho_acompanhante       	= $rsm[$i][38];       
					$_ho_part_acomp         	= $rsm[$i][39];       
					$_ho_dt_checkin         	= $rsm[$i][40];       
					$_ho_dt_checkout        	= $rsm[$i][41];       
					$_ho_id_hotel           	= $rsm[$i][42];       
					$_ho_reserva_bvt        	= $rsm[$i][43];       
					$_tr_id_evento          	= $rsm[$i][44];       
					$_tr_cpf_particip       	= $rsm[$i][45];       
					$_tr_dt_saida_ida       	= $rsm[$i][46];       
					$_tr_hr_saida_ida       	= $rsm[$i][47];       
					$_tr_dt_chegada_ida     	= $rsm[$i][48];       
					$_tr_hr_chegada_ida     	= $rsm[$i][49];       
					$_tr_cia_ida            	= $rsm[$i][50];       
					$_tr_origem_ida         	= $rsm[$i][51];       
					$_tr_destino_ida        	= $rsm[$i][52];       
					$_tr_numvoo_ida         	= $rsm[$i][53];       
					$_tr_localizador_ida    	= $rsm[$i][54];       
					$_tr_eticket_ida        	= $rsm[$i][55];       
					$_tr_hrtransout         	= $rsm[$i][56];       
					$_tr_dt_ida_local       	= $rsm[$i][57];       
					$_tr_hr_ida_local       	= $rsm[$i][58];       
					$_tr_dt_volta_local     	= $rsm[$i][59];       
					$_tr_hr_volta_local     	= $rsm[$i][60];       
					$_tr_cia_volta              = $rsm[$i][61];       
					$_tr_origem_volta           = $rsm[$i][62];       
					$_tr_destino_volta          = $rsm[$i][63];       
					$_tr_numvoo_volta           = $rsm[$i][64];       
					$_tr_localizador_volta      = $rsm[$i][65];       
					$_tr_eticket_volta          = $rsm[$i][66];       
					$_tr_observacao	            = $rsm[$i][67];       
					$_tr_tipo_transfer			= $rsm[$i][68];    					   
					$_ho_early_chkin  			= $rsm[$i][69];    					   
					$_ho_late_chkout			= $rsm[$i][70]; 
					$_tr_status       			= $rsm[$i][71];
					$_tr_id_hotel_out			= $rsm[$i][72]; 
					$_tr_dt_saida_volta			= $rsm[$i][73];
					$_tr_hr_saida_volta			= $rsm[$i][74];
					$_tr_dt_chegada_volta		= $rsm[$i][75];
					$_tr_hr_chegada_volta		= $rsm[$i][76];
					$_tr_dt_chegada_prop		= $rsm[$i][77];
					$_tr_hr_chegada_prop		= $rsm[$i][78];	
					$_ap_cod_substituto			= $rsm[$i][79];
					$_ho_hosp_diarias			= $rsm[$i][80]; 
					$_ho_hosp_taxas     		= $rsm[$i][81]; 
					$_an_anota_dsc				= $rsm[$i][82]; 
					$_ap_nome_acompanhado 		= '';		   
					$_ap_cpf_mestre				= '';
					$w_foneinter				= $rsm[$i][83];
				} else {
					$_ap_cpf 					= $rsm[$i][0];       
					$_ap_nome               	= $rsm[$i][1];    
					$_ap_id_evento	        	= $rsm[$i][2];    
					$_ap_nome_cracha 	    	= $rsm[$i][3];    
					$_ap_tam_camisa         	= $rsm[$i][4];    
					$_ap_tam_calcado        	= $rsm[$i][5];    
					$_ap_cargo              	= $rsm[$i][6];    
					$_ap_empresa            	= $rsm[$i][7];    
					$_ap_departamento       	= $rsm[$i][8];    
					$_ap_grupo              	= $rsm[$i][9];    
					$_ap_id_evento_publico  	= $rsm[$i][10];    
					$_ap_id_evento_regional 	= $rsm[$i][11];    
					$_ap_dt_cadastro        	= $rsm[$i][12];    
					$_ap_logradouro         	= $rsm[$i][13];    
					$_ap_complemento        	= $rsm[$i][14];    
					$_ap_bairro             	= $rsm[$i][15];    
					$_ap_cidade             	= $rsm[$i][16];    
					$_ap_cep                	= $rsm[$i][17];    
					$_ap_uf	                	= $rsm[$i][18];    
					$_ap_pais               	= $rsm[$i][19];    
					$_ap_ddd_01             	= $rsm[$i][20];    
					$_ap_fone_01            	= $rsm[$i][21];    
					$_ap_ddd_celular_01     	= $rsm[$i][22];    
					$_ap_celeular_01        	= $rsm[$i][23];    
					$_ap_passaporte         	= $rsm[$i][24];    
					$_ap_validade_pass      	= $rsm[$i][25];    
					$_ap_rg                 	= $rsm[$i][26];    
					$_ap_filiacao           	= $rsm[$i][27];    
					$_ap_dt_nasc            	= $rsm[$i][28];    
					$_ap_fumante            	= $rsm[$i][29];    
					$_ap_restricao_alimentar	= $rsm[$i][30];    
					$_ap_email              	= $rsm[$i][31];    
					$_ap_dt_alt_presenca    	= $rsm[$i][32];    
					$_ap_presenca           	= $rsm[$i][33];    
					$_ap_contato_rsvp       	= $rsm[$i][34];    			
					$_ap_cpf_mestre				= $rsm[$i][35];    
					$_ho_cpf_participante    	= $rsm[$i][36];    
					$_ho_id_evento           	= $rsm[$i][37];    
					$_ho_acompanhante        	= $rsm[$i][38];    
					$_ho_part_acomp          	= $rsm[$i][39];    
					$_ho_dt_checkin          	= $rsm[$i][40];    
					$_ho_dt_checkout         	= $rsm[$i][41];    
					$_ho_id_hotel            	= $rsm[$i][42];    
					$_ho_reserva_bvt         	= $rsm[$i][43];    
					$_tr_id_evento           	= $rsm[$i][44];    
					$_tr_cpf_particip        	= $rsm[$i][45];    
					$_tr_dt_saida_ida        	= $rsm[$i][46];    
					$_tr_hr_saida_ida        	= $rsm[$i][47];    
					$_tr_dt_chegada_ida      	= $rsm[$i][48];    
					$_tr_hr_chegada_ida      	= $rsm[$i][49];    
					$_tr_cia_ida             	= $rsm[$i][50];    
					$_tr_origem_ida          	= $rsm[$i][51];    
					$_tr_destino_ida         	= $rsm[$i][52];    
					$_tr_numvoo_ida          	= $rsm[$i][53];    
					$_tr_localizador_ida     	= $rsm[$i][54];    
					$_tr_eticket_ida         	= $rsm[$i][55];    
					$_tr_hrtransout          	= $rsm[$i][56];    
					$_tr_dt_ida_local        	= $rsm[$i][57];    
					$_tr_hr_ida_local        	= $rsm[$i][58];    
					$_tr_dt_volta_local      	= $rsm[$i][59];    
					$_tr_hr_volta_local      	= $rsm[$i][60];    
					$_tr_cia_volta           	= $rsm[$i][61];    
					$_tr_origem_volta        	= $rsm[$i][62];    
					$_tr_destino_volta       	= $rsm[$i][63];    
					$_tr_numvoo_volta        	= $rsm[$i][64];    
					$_tr_localizador_volta      = $rsm[$i][65];    
					$_tr_eticket_volta          = $rsm[$i][66];    
					$_tr_observacao	       		= $rsm[$i][67];	  
					$_tr_tipo_transfer			= $rsm[$i][68];       
					$_ho_early_chkin  			= $rsm[$i][69];    					   
					$_ho_late_chkout			= $rsm[$i][70];    					   
					$_tr_status       			= $rsm[$i][71];
					$_tr_id_hotel_out			= $rsm[$i][72]; 
					$_tr_dt_saida_volta			= $rsm[$i][73];
					$_tr_hr_saida_volta			= $rsm[$i][74];
					$_tr_dt_chegada_volta		= $rsm[$i][75];
					$_tr_hr_chegada_volta		= $rsm[$i][76];		   
					$_tr_dt_chegada_prop		= $rsm[$i][77];
					$_tr_hr_chegada_prop		= $rsm[$i][78];			
					$_ho_hosp_diarias			= $rsm[$i][79]; 
					$_ho_hosp_taxas     		= $rsm[$i][80]; 
					$_ap_nome_substituto		= '';
					$_ap_nome_acompanhado 		= '';			
					$_ap_cod_substituto			= '';
					$w_foneinter				= $rsm[$i][83];
				}	
				
				$foneok = is_null($w_foneinter);
				if($foneok == true) {
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
				switch($_tr_tipo_transfer) {                                                                                      
					case 'A':                                                                                                      
						$_tr_tipo_transfer = 'AEREO';  		                                                                               
						break;                                                                                                        
					case 'L':                                                                                                      
						$_tr_tipo_transfer	= 'LOCAL';                                                                                   
						break;                                                                                                        
					case 'P':                                                                                                      
						$_tr_tipo_transfer	= 'PROPRIO';                                                                                 
						break;	                                                                                                       
				}     
				switch($_tr_status) {
				case 'A':
					$_tr_status = 'ABERTO';  		 
					break;
				case 'Y':
					$_tr_status = 'SIM'; 
					break;
				case 'N':
					$_tr_status = 'NAO'; 
					break;		
				case 'P':
					$_tr_status = 'PENDENTE'; 
					break;		
				}			    				
				$sqlEve = "								                                                                                             
				SELECT                                                                                                          
					evento_id,                                                                                                     
					evento_nome				                                                                                                
				FROM                                                                                                            
					eventos_rsvp                                                                                                   
				WHERE                                                                                                           
					evento_id = ".$this->Db->qstr($vp_evento)." '                                                                                 
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
				$sqlCia = "								                                                                                             
				SELECT                                                                                                          
					cia_id,
					cia_nome
				FROM                                                                                                            
					tbl_cia_aereas
				WHERE                                                                                                           
					cia_id = ".$this->Db->qstr($_tr_cia_ida)."                                                                                 
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
					cia_id = '".$_tr_cia_volta."'                                                                                 
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
				$sqlPub = "								                                                                                             
				SELECT                                                                                                          
					publico_id,
					publico_nome
				FROM                                                                                                            
					publico_rsvp
				WHERE                                                                                                           
					publico_id = ".$this->Db->qstr($_ap_id_evento_publico)."                                                                                 
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
					hotel_id = ".$this->Db->qstr($_ho_id_hotel)."                                                                                 
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
				if ($_ho_early_chkin  == 'Y') {
					$_ho_early_chkin  = 'SIM';
				} else {
					$_ho_early_chkin  = 'ABERTO';
				}
				if ($_ho_late_chkout == 'Y') {
					$_ho_late_chkout = 'SIM';
				} else {	
					$_ho_late_chkout = 'ABERTO';
				}	
				$sqlHotout = "								                                                                                             
				SELECT                                                                                                          
					hotel_id,
					hotel_fantasia
				FROM                                                                                                            
					tbl_hoteis
				WHERE                                                                                                           
					hotel_id =  ".$this->Db->qstr($_tr_id_hotel_out)."                                                                                     
				ORDER BY                                                                                                        
					hotel_id
				";		                                                                                                            
				 
      $nm_select = $sqlHotout; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rshotout = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rshotout[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rshotout = false;
          $rshotout_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rshotout[0][0])) {									                                                                            
					$w_hotel_dsc_out = $rshotout[0][1];                                                                                  
				} else {                                                                                                        
					$w_hotel_dsc_out = "";				                                                                                         
				}											
				if ($vp_tipoPessoa == 'P') {
					$w_tipopess = 'PARTICIPANTE';
				} else {
					$w_tipopess = 'ACOMPANHANTE';
				}				
				$sqlReg = "								                                                                                             
				SELECT                                                                                                          
					regional_id,
					regional_dsc
				FROM                                                                                                            
					tbl_regionais
				WHERE                                                                                                           
					regional_id = ".$this->Db->qstr($_ap_id_evento_regional)."                                                                                  
				ORDER BY                                                                                                        
					regional_id
				";		                                                                                                            
				 
      $nm_select = $sqlReg; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsreg = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsreg[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsreg = false;
          $rsreg_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rsreg[0][0])) {									                                                                            
					$w_regional = $rsreg[0][1];                                                                                  
				} else {                                                                                                        
					$w_regional = "";				                                                                                         
				}								
				$sqlPais = "								                                                                                             
				SELECT                                                                                                          
					pais_id,
					descricao
				FROM                                                                                                            
					tbl_paises
				WHERE                                                                                                           
					pais_id = ".$this->Db->qstr($_ap_pais)."                                                                                 
				ORDER BY                                                                                                        
					pais_id
				";		                                                                                                            
				 
      $nm_select = $sqlPais; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rspais = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rspais[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rspais = false;
          $rspais_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rspais[0][0])) {									                                                                            
					$w_pais = $rspais[0][1];                                                                                  
				} else {                                                                                                        
					$w_pais = "";				                                                                                         
				}				
				$sqlAerop = "			
				SELECT
					COD_AEROPORTO,
					SIGLA,
					NOM_AEROPORTO,
					NOM_CIDADE,
					COD_PAIS
				FROM
					aeroporto
				WHERE
					COD_AEROPORTO = ".$this->Db->qstr($_tr_origem_ida)." 
				ORDER BY
					COD_AEROPORTO					
				";
				 
      $nm_select = $sqlAerop; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsaerop = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsaerop[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsaerop = false;
          $rsaerop_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($rsaerop[0][0])) {									
					$w_origemIda = $rsaerop[0][3].' - '.$rsaerop[0][1].' - '.$rsaerop[0][2].' - '.$rsaerop[0][4];
				} else {
					$w_origemIda = "";				
				}				
				$sqlAerop = "			
				SELECT
					COD_AEROPORTO,
					SIGLA,
					NOM_AEROPORTO,
					NOM_CIDADE,
					COD_PAIS
				FROM
					aeroporto
				WHERE
					COD_AEROPORTO = ".$this->Db->qstr($_tr_destino_ida)."  
				ORDER BY
					COD_AEROPORTO					
				";
				 
      $nm_select = $sqlAerop; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsaerop = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsaerop[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsaerop = false;
          $rsaerop_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($rsaerop[0][0])) {									
					$w_destinoIda = $rsaerop[0][3].' - '.$rsaerop[0][1].' - '.$rsaerop[0][2].' - '.$rsaerop[0][4];
				} else {
					$w_destinoIda = "";				
				}													
				$sqlAerop = "			
				SELECT
					COD_AEROPORTO,
					SIGLA,
					NOM_AEROPORTO,
					NOM_CIDADE,
					COD_PAIS
				FROM
					aeroporto
				WHERE
					COD_AEROPORTO = ".$this->Db->qstr($_tr_origem_volta)."      
				ORDER BY
					COD_AEROPORTO					
				";
				 
      $nm_select = $sqlAerop; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsaerop = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsaerop[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsaerop = false;
          $rsaerop_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($rsaerop[0][0])) {									
					$w_origemVolta = $rsaerop[0][3].' - '.$rsaerop[0][1].' - '.$rsaerop[0][2].' - '.$rsaerop[0][4];
				} else {
					$w_origemVolta = "";				
				}													
				$sqlAerop = "			
				SELECT
					COD_AEROPORTO,
					SIGLA,
					NOM_AEROPORTO,
					NOM_CIDADE,
					COD_PAIS
				FROM
					aeroporto
				WHERE
					COD_AEROPORTO = ".$this->Db->qstr($_tr_destino_volta)."    
				ORDER BY
					COD_AEROPORTO					
				";
				 
      $nm_select = $sqlAerop; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsaerop = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsaerop[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsaerop = false;
          $rsaerop_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($rsaerop[0][0])) {									
					$w_destinoVolta = $rsaerop[0][3].' - '.$rsaerop[0][1].' - '.$rsaerop[0][2].' - '.$rsaerop[0][4];
				} else {
					$w_destinoVolta = "";				
				}				
				
				if ($_ap_nome_substituto <> '') {
					$_guardaNome = $_ap_nome;
					$_ap_nome = $_ap_nome_substituto;
				} else {
					$_guardaNome = '';
					$_ap_nome_substituto = '';
				}						
				if ($vp_tipoPessoa == 'A') {
					$sqlAmestre = "			
					SELECT
						part_cpf,
						nome_pessoa,
						part_id_evento					
					FROM
						participantes_rsvp	
					WHERE
						part_cpf = ".$this->Db->qstr($_ap_cpf_mestre)."     
					AND
						part_id_evento = ".$this->Db->qstr($vp_evento)."   
					ORDER BY
						part_cpf,part_id_evento					
					";
					 
      $nm_select = $sqlAmestre; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rsamestre = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rsamestre[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rsamestre = false;
          $rsamestre_erro = $this->Db->ErrorMsg();
      } 
				
					if (isset($rsamestre[0][0])) {									
						$_ap_nome_acompanhado = $rsamestre[0][1];
					} else {
						$_ap_nome_acompanhado = '';
					}				
				}	
				$sqlHosp = "								                                                                                             
				SELECT            
					hosp_cpf_participante,                                                                                              
					hosp_id_evento,
					hosp_id_hotel,
					hosp_reserva_bvt
				FROM                                                                                                            
					hospedagem_rsvp
				WHERE
					hosp_cpf_participante = ".$this->Db->qstr($_ap_cpf)."  
				AND
					hosp_id_evento = ".$this->Db->qstr($_ap_id_evento)."    
				AND                                                                                                          
					hosp_id_hotel = ".$this->Db->qstr($_tr_id_hotel_out)."                                                                                   
				ORDER BY                                                                                                        
					hosp_cpf_participante,hosp_id_evento,hosp_id_hotel
				";		                                                                                                            
				 
      $nm_select = $sqlHosp; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rshosp = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rshosp[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rshosp = false;
          $rshosp_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($rshosp[0][0])) {									                                                                            					
					if ($rshosp[0][3] == 'Y') {
						$w_comprada_bvt = 'SIM';
					} else{
						$w_comprada_bvt = 'NÃO';
					}	
				} else {                                                                                                        
					$w_comprada_bvt = "";				                                                                                         
				}											
				if ($vp_tipoPessoa == 'P') {
					$w_tipopess = 'PARTICIPANTE';
				} else {
					$w_tipopess = 'ACOMPANHANTE';
				}				
				if ($_ho_reserva_bvt == 'Y') {
					$_ho_reserva_bvt = 'SIM';	
				} else {
					$_ho_reserva_bvt = 'NÃO';	
				}
				if ($_ap_fumante == 'N') {
					$_ap_fumante = 'NÃO';
				} else {
					$_ap_fumante = 'SIM';
				}
				switch($_ap_presenca) {
				case 'A':
					$_ap_presenca = 'ABERTO';  		 
					break;
				case 'Y':
					$_ap_presenca = 'SIM'; 
					break;
				case 'N':
					$_ap_presenca = 'NAO'; 
					break;		
				case 'P':
					$_ap_presenca = 'PENDENTE'; 
					break;		
				}	
				switch($_ap_contato_rsvp) {
				case 'A':
					$_ap_contato_rsvp = 'ABERTO';  		 
					break;
				case 'Y':
					$_ap_contato_rsvp = 'SIM'; 
					break;
				case 'N':
					$_ap_contato_rsvp = 'NAO'; 
					break;		
				case 'P':
					$_ap_contato_rsvp = 'PENDENTE'; 
					break;		
				}
				if ($w_ciaida == "") {
					$w_aerstatus_ida = '';
					$sqltaer = "								                                                                                             
					SELECT                                                                                                          
						aereo_id_evento,
						aereo_cpf_particip,
						aereo_transfer_tipo,
						aereo_status,						
						aereo_dt_saida,
						aereo_hr_saida,
						aereo_dt_chegada,
						aereo_hr_chegada,
						aereo_cia_aerea,
						aereo_origem,
						aereo_destino,
						aereo_num_voo,
						aereo_localizador,
						aereo_eticket
					FROM                                                                                                            
						aereos_rsvp
					WHERE                                                                                                           
						aereo_id_evento = ".$this->Db->qstr($vp_evento)."    
					AND
						aereo_cpf_particip = ".$this->Db->qstr($_ap_cpf)."
					AND
						aereo_transfer_tipo = 'IN'
					ORDER BY                                                                                                        
						aereo_id_evento, aereo_cpf_particip, aereo_transfer_tipo
					";		                                                                                                            
					 
      $nm_select = $sqltaer; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rstaer = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rstaer[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rstaer = false;
          $rstaer_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rstaer[0][0])) {							
						$_tr_dt_saida_ida       	= $rstaer[0][4];       
						$_tr_hr_saida_ida       	= $rstaer[0][5];       
						$_tr_dt_chegada_ida     	= $rstaer[0][6];       
						$_tr_hr_chegada_ida     	= $rstaer[0][7];       
						$w_ciaida      		       	= $rstaer[0][8];       
						$w_origemIda        	 	= $rstaer[0][9];       
						$w_destinoIda        		= $rstaer[0][10];       
						$_tr_numvoo_ida         	= $rstaer[0][11];       
						$_tr_localizador_ida    	= $rstaer[0][12];       
						$_tr_eticket_ida       		= $rstaer[0][13];   
						$w_aerstatus_ida			= $rstaer[0][3];
					} else {                                                                                                        
						$w_ciaida = "NÃO ENCONTRADA";			                                                                                         
					}
				}
				if ($w_ciavolta == "") {
					$w_aerstatus_volta	= '';
					$sqltaer = "								                                                                                             
					SELECT                                                                                                          
						aereo_id_evento,
						aereo_cpf_particip,
						aereo_transfer_tipo,
						aereo_status,						
						aereo_dt_saida,
						aereo_hr_saida,
						aereo_dt_chegada,
						aereo_hr_chegada,
						aereo_cia_aerea,
						aereo_origem,
						aereo_destino,
						aereo_num_voo,
						aereo_localizador,
						aereo_eticket
					FROM                                                                                                            
						aereos_rsvp
					WHERE                                                                                                           
						aereo_id_evento = ".$this->Db->qstr($vp_evento)."    
					AND
						aereo_cpf_particip = ".$this->Db->qstr($_ap_cpf)."     
					AND
						aereo_transfer_tipo = 'OUT'
					ORDER BY                                                                                                        
						aereo_id_evento, aereo_cpf_particip, aereo_transfer_tipo
					";		                                                                                                            
					 
      $nm_select = $sqltaer; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $rstaer = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $rstaer[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $rstaer = false;
          $rstaer_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($rstaer[0][0])) {							
						$_tr_dt_saida_volta       	= $rstaer[0][4];       
						$_tr_hr_saida_volta       	= $rstaer[0][5];       
						$_tr_dt_chegada_volta     	= $rstaer[0][6];       
						$_tr_hr_chegada_volta     	= $rstaer[0][7];       
						$w_ciavolta    		       	= $rstaer[0][8];       
						$w_origemVolta        	 	= $rstaer[0][9];       
						$w_destinoVolta        		= $rstaer[0][10];       
						$_tr_numvoo_volta         	= $rstaer[0][11];       
						$_tr_localizador_volta    	= $rstaer[0][12];       
						$_tr_eticket_volta     		= $rstaer[0][13];  						
						$w_aerstatus_volta			= $rstaer[0][3];
					} else {                                                                                                        
						$w_ciavolta = "NÃO ENCONTRADA";			                                                                                         
					}
				}
				
				switch($w_aerstatus_ida) {                                                                                      
					case 'A':                                                                                                      
						$w_aerstatus_ida = 'ABERTO';  		                                                                               
						break;                                                                                                        
					case 'P':                                                                                                      
						$w_aerstatus_ida	= 'PENDENTE';                                                                                   
						break;                                                                                                        
					case 'N':                                                                                                      
						$w_aerstatus_ida	= 'NÃO';                                                                                 
						break;	                                                                                                       
					case 'Y':                                                                                                      
						$w_aerstatus_ida	= 'CONFIRMADO';                                                                                 
						break;	        
					case '':
						$w_aerstatus_ida	= 'ABERTO';                                                                                 
						break;	        
				}     				
				switch($w_aerstatus_volta) {                                                                                      
					case 'A':                                                                                                      
						$w_aerstatus_volta = 'ABERTO';  		                                                                               
						break;                                                                                                        
					case 'P':                                                                                                      
						$w_aerstatus_volta	= 'PENDENTE';                                                                                   
						break;                                                                                                        
					case 'N':                                                                                                      
						$w_aerstatus_volta	= 'NÃO';                                                                                 
						break;	                                                                                                       
					case 'Y':                                                                                                      
						$w_aerstatus_volta	= 'CONFIRMADO';                                                                                 
						break;	        
					case '':
						$w_aerstatus_volta	= 'ABERTO';                                                                                 
						break;	        
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
					presencas_rsvp.presenca_cpf_participante = ".$this->Db->qstr($_ap_cpf)."                                                                                 
				AND
					presencas_rsvp.presenca_id_evento = ".$this->Db->qstr($vp_evento)."
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
					contatos_rsvp.contato_cpf_participante = ".$this->Db->qstr($_ap_cpf)."                                                                            
				AND
					contatos_rsvp.contato_id_evento = ".$this->Db->qstr($vp_evento)."   
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
					$_ap_contato_rsvp = $vcontato_data;
				} else {
					$vcontato_status_dsc = 'ABERTO'; 	
				}	
				$sqlins = "
					SELECT 
						COUNT(cpf) as qtde
					FROM 
						geral_rsvp_r
					WHERE 
						cpf = ".$this->Db->qstr($_ap_cpf)."    
					AND 
						evento_id = ".$this->Db->qstr($vp_evento)."    
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
					$sqli = "
						INSERT INTO
							geral_rsvp_r
							(evento_id,               	        
							evento_dsc,                 
							cpf,                                     
							nome_participante,             
							cpf_mestre,                  
							nome_acompanhado,                                       
							tipo_pessoa,                       
							nome_cracha,                       
							convidado_original,           
							nome_substituto,                
							acomp_mesmoquarto,             
							partici_mesmoquarto,         
							checkin,                              
							checkout,                             
							tamanho_camisa,                  
							tamanho_calcado,                
							hotel,                                  
							hotel_dsc,                   	                                
							comprado_bvt,                      
							cargo,                                  
							empresa,                              
							departamento,                      
							grupo,                                  
							publico,                              
							publico_dsc,                                               
							regional,                             
							regional_dsc,                                   
							data_cadastro,                    
							logradouro,                         
							complemento,                       
							bairro,                                
							cidade,                                
							cep,                                     
							uf,                                       
							pais_dsc,                                    
							ddd_tel01,                           
							tel01,                                  
							ddd_celular,                       
							celular,                              
							passaporte,                         
							validade_passporte,           
							rg,                                       
							filiacao,                             
							data_nascimento,                
							fumante,                          
							restricao_alimentar,         
							e_mail,                                
							atualizacao_presenca,        
							presenca,                             
							contato,                              
							trecho,                                            
							hotel_ida,                                           
							hotel_ida_dsc,                                   
							comprada_bvt_ida,                  
							data_saida_ida,        		
							hora_saida_ida,        		
							data_chegada_ida,            
							hora_chegada_ida,            
							cia_aerea_ida,         		
							cia_dsc_ida,           		
							origem_ida,            		
							origem_dsc_ida,        		
							destino_ida,           		
							destino_dsc_ida,       		
							voo_ida,               		
							localizador_ida,				  
							etkt_ida,              		
							hotel_volta,           		
							hotel_volta_dsc,       		
							comprada_bvt_volta,    		
							hr_transfer_volta,     		
							data_saida_volta,      		
							hora_saida_volta,            
							data_chegada_volta,          
							hora_chegada_volta,          
							cia_aerea_volta,       		
							cia_dsc_volta,         		
							origem_volta,				  
							origem_dsc_volta,      		
							destino_volta,         		
							destino_dsc_volta,     		
							voo_volta,             		
							localizador_volta,     		
							etkt_volta,            		
							obs_transfer,          		
							id_usuario_relato,     		
							usuario_relato_dsc,    		
							tipo_transfer,         		
							early_checkin,         		
							late_checkout,         		
							trecho_volta,
							dt_chegada_proprio,
							hr_chegada_proprio,
							status_aereo_ida,
							status_aereo_volta,
							valor_diaria,
							valor_taxa,
							dt_confirm_presenca,
							presenca_motivo,
							presenca_atendente,
							presenca_obs,
							contato_antendente,
							data_contato,
							motivo_contato,
							obs_contato,
							status_contato,
							anotacoes,
							telefone_internacional)		
						VALUES
							('".$_ap_id_evento."',          
							'".$w_eventoDsc."',         
							'".$_ap_cpf."',                
							'".$_ap_nome."',               
							'".$_ap_cpf_mestre."',      
							'".$_ap_nome_acompanhado."', 	
							'".$w_tipopess."',             
							'".$_ap_nome_cracha."',        
							'".$_guardaNome."',            
							'".$_ap_nome_substituto."',    
							'".$_ho_acompanhante."',       
							'".$_ho_part_acomp."',         
							'".$_ho_dt_checkin."',         
							'".$_ho_dt_checkout."',        
							'".$_ap_tam_camisa."',         
							'".$_ap_tam_calcado."',        
							'".$_ho_id_hotel."',           
							'".$w_hotel_dsc."',			
							'".$_ho_reserva_bvt."',        
							'".$_ap_cargo."',              
							'".$_ap_empresa."',            
							'".$_ap_departamento."',       
							'".$_ap_grupo."',              
							'".$_ap_id_evento_publico."',  
							'".$w_publico."',				
							'".$_ap_id_evento_regional."', 
							'".$w_regional."',             
							'".$_ap_dt_cadastro."',        
							'".$_ap_logradouro."',         
							'".$_ap_complemento."',        
							'".$_ap_bairro."',             
							'".$_ap_cidade."',             
							'".$_ap_cep."',                
							'".$_ap_uf."',	                
							'".$w_pais."',               
							'".$_ap_ddd_01."',             
							'".$_ap_fone_01."',            
							'".$_ap_ddd_celular_01."',     
							'".$_ap_celeular_01."',        
							'".$_ap_passaporte."',         
							'".$_ap_validade_pass."',      
							'".$_ap_rg."',                 
							'".$_ap_filiacao."',           
							'".$_ap_dt_nasc."',            
							'".$_ap_fumante."',            
							'".$_ap_restricao_alimentar."',
							'".$_ap_email."',              
							'".$_ap_dt_alt_presenca."',    
							'".$_ap_presenca."',           
							'".$_ap_contato_rsvp."',       
							'".$_trecho_ida."',            
							'".$_ho_id_hotel."',           
							'".$w_hotel_dsc."',            
							'".$_ho_reserva_bvt."',        
							'".$_tr_dt_saida_ida."', 
							'".$_tr_hr_saida_ida."',
							'".$_tr_dt_chegada_ida."',
							'".$_tr_hr_chegada_ida."',
							'".$_tr_cia_ida."', 
							'".$w_ciaida."',
							'".$_tr_origem_ida."',
							'".$w_origemIda."',
							'".$_tr_destino_ida."',
							'".$w_destinoIda."',
							'".$_tr_numvoo_ida."',
							'".$_tr_localizador_ida."',    
							'".$_tr_eticket_ida."',
							'".$_tr_id_hotel_out."',
							'".$w_hotel_dsc_out."',
							'".$w_comprada_bvt."',
							'".$_tr_hrtransout."',
							'".$_tr_dt_saida_volta."',
							'".$_tr_hr_saida_volta."',	 
							'".$_tr_dt_chegada_volta."',
							'".$_tr_hr_chegada_volta."',
							'".$_tr_cia_volta."',
							'".$w_ciavolta."',
							'".$_tr_origem_volta."',       
							'".$w_origemVolta."',
							'".$_tr_destino_volta."',
							'".$w_destinoVolta."',
							'".$_tr_numvoo_volta."',
							'".$_tr_localizador_volta."',
							'".$_tr_eticket_volta."',
							'".$_tr_observacao."',
							'".$vp_usuario."',
							'".$w_usurelDsc."',
							'".$_tr_tipo_transfer."',
							'".$_ho_early_chkin."',
							'".$_ho_late_chkout."',
							'".$_trecho_volta."',					
							'".$_tr_dt_chegada_prop."',		
							'".$_tr_hr_chegada_prop."',
							'".$w_aerstatus_ida."',
							'".$w_aerstatus_volta."',
							'".$_ho_hosp_diarias."',
							'".$_ho_hosp_taxas."',
							'".$vpresenca_data."',
							'".$vpresenca_motivo."',
							'".$vpresenca_usuario_nome."',
							'".$vpresenca_obs."',
							'".$vcontato_usuario_nome."',
							'".$vcontato_data."',
							'".$vcontato_motivo."',
							'".$vcontato_obs."',
							'".$vcontato_status_dsc."',
							'".$_an_anota_dsc."',
							'".$w_foneinter."')	
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
			$ret = 'ADICIONA OK'; 			
		} else {			                                                                                                       
			if ($_passa_part == false) {	                                                                                    
				$ret = 'ADICIONA ERRO';				                                                                                     
			} else {                                                                                                         
				$ret = 'ADICIONA OK';                                                                                           
			}	                                                                                                               
		}			
		return $ret;
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'off';
}


function RetNivelUpd($nivel) {
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'off';
}

}

?>
