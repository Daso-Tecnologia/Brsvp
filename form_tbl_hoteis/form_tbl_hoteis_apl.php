<?php
//
class form_tbl_hoteis_apl
{
   var $has_where_params = false;
   var $NM_is_redirected = false;
   var $NM_non_ajax_info = false;
   var $formatado = false;
   var $use_100perc_fields = false;
   var $classes_100perc_fields = array();
   var $close_modal_after_insert = false;
   var $NM_ajax_flag    = false;
   var $NM_ajax_opcao   = '';
   var $NM_ajax_retorno = '';
   var $NM_ajax_info    = array('result'            => '',
                                'param'             => array(),
                                'autoComp'          => '',
                                'rsSize'            => '',
                                'msgDisplay'        => '',
                                'errList'           => array(),
                                'fldList'           => array(),
                                'varList'           => array(),
                                'focus'             => '',
                                'navStatus'         => array(),
                                'navSummary'        => array(),
                                'navPage'           => array(),
                                'redir'             => array(),
                                'blockDisplay'      => array(),
                                'fieldDisplay'      => array(),
                                'fieldLabel'        => array(),
                                'readOnly'          => array(),
                                'btnVars'           => array(),
                                'ajaxAlert'         => array(),
                                'ajaxMessage'       => array(),
                                'ajaxJavascript'    => array(),
                                'buttonDisplay'     => array(),
                                'buttonDisplayVert' => array(),
                                'calendarReload'    => false,
                                'quickSearchRes'    => false,
                                'displayMsg'        => false,
                                'displayMsgTxt'     => '',
                                'dyn_search'        => array(),
                                'empty_filter'      => '',
                                'event_field'       => '',
                                'fieldsWithErrors'  => array(),
                               );
   var $NM_ajax_force_values = false;
   var $captcha_code;
   var $captcha_sent;
   var $Nav_permite_ava     = true;
   var $Nav_permite_ret     = true;
   var $Apl_com_erro        = false;
   var $app_is_initializing = false;
   var $Ini;
   var $Erro;
   var $Db;
   var $hotel_id;
   var $hotel_cnpj;
   var $hotel_fantasia;
   var $hotel_razsoc;
   var $hotel_descricao;
   var $hotel_rede;
   var $hotel_rede_1;
   var $hotel_cep;
   var $hotel_pais;
   var $hotel_pais_1;
   var $hotel_uf;
   var $hotel_municipio;
   var $hotel_bairro;
   var $hotel_logradouro;
   var $hotel_numero;
   var $hotel_complemento;
   var $hotel_email;
   var $hotel_telefone;
   var $hotel_fax;
   var $hotel_celular;
   var $hotel_website;
   var $hotel_status;
   var $hotel_facebook;
   var $hotel_twitter;
   var $hotel_skype;
   var $hotel_ar_condicionado;
   var $hotel_frigobar;
   var $hotel_lavanderia;
   var $hotel_telefone_quarto;
   var $hotel_tv;
   var $hotel_ginastica;
   var $hotel_restaurante;
   var $hotel_bar;
   var $hotel_estacionamento;
   var $hotel_sauna;
   var $hotel_piscina;
   var $hotel_wifi;
   var $hotel_computador;
   var $hotel_convencoes;
   var $hotel_observacoes;
   var $hotel_classificacao;
   var $hotel_classificacao_1;
   var $hotel_categoria;
   var $hotel_categoria_1;
   var $hotel_logo;
   var $hotel_logo_scfile_name;
   var $hotel_logo_ul_name;
   var $hotel_logo_scfile_type;
   var $hotel_logo_ul_type;
   var $hotel_logo_limpa;
   var $hotel_logo_salva;
   var $out_hotel_logo;
   var $hotel_cod_estrangeiro;
   var $localizacao;
   var $rodape;
   var $nm_data;
   var $nmgp_opcao;
   var $nmgp_opc_ant;
   var $sc_evento;
   var $sc_insert_on;
   var $nmgp_clone;
   var $nmgp_return_img = array();
   var $nmgp_dados_form = array();
   var $nmgp_dados_select = array();
   var $nm_location;
   var $nm_flag_iframe;
   var $nm_flag_saida_novo;
   var $nmgp_botoes = array();
   var $nmgp_url_saida;
   var $nmgp_form_show;
   var $nmgp_form_empty;
   var $nmgp_cmp_readonly = array();
   var $nmgp_cmp_hidden   = array();
   var $Field_no_validate  = array();
   var $form_paginacao = 'parcial';
   var $lig_edit_lookup      = false;
   var $lig_edit_lookup_call = false;
   var $lig_edit_lookup_cb   = '';
   var $lig_edit_lookup_row  = '';
   var $is_calendar_app = false;
   var $Embutida_call  = false;
   var $Embutida_ronly = false;
   var $Embutida_proc  = false;
   var $Embutida_form  = false;
   var $Grid_editavel  = false;
   var $url_webhelp = '';
   var $nm_todas_criticas;
   var $Campos_Mens_erro;
   var $nm_new_label = array();
   var $record_insert_ok = false;
   var $record_delete_ok = false;
   var $Upload_refresh_fields = array();
   var $NM_case_insensitive;
//
//----- 
   function ini_controle()
   {
        global $nm_url_saida, $teste_validade, $script_case_init, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;


      if ($this->NM_ajax_flag)
      {
          if (isset($this->NM_ajax_info['param']['csrf_token']))
          {
              $this->csrf_token = $this->NM_ajax_info['param']['csrf_token'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_ar_condicionado']))
          {
              $this->hotel_ar_condicionado = $this->NM_ajax_info['param']['hotel_ar_condicionado'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_bairro']))
          {
              $this->hotel_bairro = $this->NM_ajax_info['param']['hotel_bairro'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_bar']))
          {
              $this->hotel_bar = $this->NM_ajax_info['param']['hotel_bar'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_categoria']))
          {
              $this->hotel_categoria = $this->NM_ajax_info['param']['hotel_categoria'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_celular']))
          {
              $this->hotel_celular = $this->NM_ajax_info['param']['hotel_celular'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_cep']))
          {
              $this->hotel_cep = $this->NM_ajax_info['param']['hotel_cep'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_classificacao']))
          {
              $this->hotel_classificacao = $this->NM_ajax_info['param']['hotel_classificacao'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_cnpj']))
          {
              $this->hotel_cnpj = $this->NM_ajax_info['param']['hotel_cnpj'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_cod_estrangeiro']))
          {
              $this->hotel_cod_estrangeiro = $this->NM_ajax_info['param']['hotel_cod_estrangeiro'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_complemento']))
          {
              $this->hotel_complemento = $this->NM_ajax_info['param']['hotel_complemento'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_computador']))
          {
              $this->hotel_computador = $this->NM_ajax_info['param']['hotel_computador'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_convencoes']))
          {
              $this->hotel_convencoes = $this->NM_ajax_info['param']['hotel_convencoes'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_descricao']))
          {
              $this->hotel_descricao = $this->NM_ajax_info['param']['hotel_descricao'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_email']))
          {
              $this->hotel_email = $this->NM_ajax_info['param']['hotel_email'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_estacionamento']))
          {
              $this->hotel_estacionamento = $this->NM_ajax_info['param']['hotel_estacionamento'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_facebook']))
          {
              $this->hotel_facebook = $this->NM_ajax_info['param']['hotel_facebook'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_fantasia']))
          {
              $this->hotel_fantasia = $this->NM_ajax_info['param']['hotel_fantasia'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_fax']))
          {
              $this->hotel_fax = $this->NM_ajax_info['param']['hotel_fax'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_frigobar']))
          {
              $this->hotel_frigobar = $this->NM_ajax_info['param']['hotel_frigobar'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_ginastica']))
          {
              $this->hotel_ginastica = $this->NM_ajax_info['param']['hotel_ginastica'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_id']))
          {
              $this->hotel_id = $this->NM_ajax_info['param']['hotel_id'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_lavanderia']))
          {
              $this->hotel_lavanderia = $this->NM_ajax_info['param']['hotel_lavanderia'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_logo']))
          {
              $this->hotel_logo = $this->NM_ajax_info['param']['hotel_logo'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_logo_limpa']))
          {
              $this->hotel_logo_limpa = $this->NM_ajax_info['param']['hotel_logo_limpa'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_logo_ul_name']))
          {
              $this->hotel_logo_ul_name = $this->NM_ajax_info['param']['hotel_logo_ul_name'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_logo_ul_type']))
          {
              $this->hotel_logo_ul_type = $this->NM_ajax_info['param']['hotel_logo_ul_type'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_logradouro']))
          {
              $this->hotel_logradouro = $this->NM_ajax_info['param']['hotel_logradouro'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_municipio']))
          {
              $this->hotel_municipio = $this->NM_ajax_info['param']['hotel_municipio'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_numero']))
          {
              $this->hotel_numero = $this->NM_ajax_info['param']['hotel_numero'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_observacoes']))
          {
              $this->hotel_observacoes = $this->NM_ajax_info['param']['hotel_observacoes'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_pais']))
          {
              $this->hotel_pais = $this->NM_ajax_info['param']['hotel_pais'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_piscina']))
          {
              $this->hotel_piscina = $this->NM_ajax_info['param']['hotel_piscina'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_razsoc']))
          {
              $this->hotel_razsoc = $this->NM_ajax_info['param']['hotel_razsoc'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_rede']))
          {
              $this->hotel_rede = $this->NM_ajax_info['param']['hotel_rede'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_restaurante']))
          {
              $this->hotel_restaurante = $this->NM_ajax_info['param']['hotel_restaurante'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_sauna']))
          {
              $this->hotel_sauna = $this->NM_ajax_info['param']['hotel_sauna'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_skype']))
          {
              $this->hotel_skype = $this->NM_ajax_info['param']['hotel_skype'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_status']))
          {
              $this->hotel_status = $this->NM_ajax_info['param']['hotel_status'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_telefone']))
          {
              $this->hotel_telefone = $this->NM_ajax_info['param']['hotel_telefone'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_telefone_quarto']))
          {
              $this->hotel_telefone_quarto = $this->NM_ajax_info['param']['hotel_telefone_quarto'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_tv']))
          {
              $this->hotel_tv = $this->NM_ajax_info['param']['hotel_tv'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_twitter']))
          {
              $this->hotel_twitter = $this->NM_ajax_info['param']['hotel_twitter'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_uf']))
          {
              $this->hotel_uf = $this->NM_ajax_info['param']['hotel_uf'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_website']))
          {
              $this->hotel_website = $this->NM_ajax_info['param']['hotel_website'];
          }
          if (isset($this->NM_ajax_info['param']['hotel_wifi']))
          {
              $this->hotel_wifi = $this->NM_ajax_info['param']['hotel_wifi'];
          }
          if (isset($this->NM_ajax_info['param']['localizacao']))
          {
              $this->localizacao = $this->NM_ajax_info['param']['localizacao'];
          }
          if (isset($this->NM_ajax_info['param']['nm_form_submit']))
          {
              $this->nm_form_submit = $this->NM_ajax_info['param']['nm_form_submit'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_ancora']))
          {
              $this->nmgp_ancora = $this->NM_ajax_info['param']['nmgp_ancora'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_arg_dyn_search']))
          {
              $this->nmgp_arg_dyn_search = $this->NM_ajax_info['param']['nmgp_arg_dyn_search'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_arg_fast_search']))
          {
              $this->nmgp_arg_fast_search = $this->NM_ajax_info['param']['nmgp_arg_fast_search'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_cond_fast_search']))
          {
              $this->nmgp_cond_fast_search = $this->NM_ajax_info['param']['nmgp_cond_fast_search'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_fast_search']))
          {
              $this->nmgp_fast_search = $this->NM_ajax_info['param']['nmgp_fast_search'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_num_form']))
          {
              $this->nmgp_num_form = $this->NM_ajax_info['param']['nmgp_num_form'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_opcao']))
          {
              $this->nmgp_opcao = $this->NM_ajax_info['param']['nmgp_opcao'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_ordem']))
          {
              $this->nmgp_ordem = $this->NM_ajax_info['param']['nmgp_ordem'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_parms']))
          {
              $this->nmgp_parms = $this->NM_ajax_info['param']['nmgp_parms'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_refresh_fields']))
          {
              $this->nmgp_refresh_fields = $this->NM_ajax_info['param']['nmgp_refresh_fields'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_url_saida']))
          {
              $this->nmgp_url_saida = $this->NM_ajax_info['param']['nmgp_url_saida'];
          }
          if (isset($this->NM_ajax_info['param']['script_case_init']))
          {
              $this->script_case_init = $this->NM_ajax_info['param']['script_case_init'];
          }
          if (isset($this->nmgp_refresh_fields))
          {
              $this->nmgp_refresh_fields = explode('_#fld#_', $this->nmgp_refresh_fields);
              $this->nmgp_opcao          = 'recarga';
          }
          if (!isset($this->nmgp_refresh_row))
          {
              $this->nmgp_refresh_row = '';
          }
      }

      $this->scSajaxReservedWords = array('rs', 'rst', 'rsrnd', 'rsargs');
      $this->sc_conv_var = array();
      if (!empty($_FILES))
      {
          foreach ($_FILES as $nmgp_campo => $nmgp_valores)
          {
               if (!in_array(strtolower($nmgp_campo), $this->scSajaxReservedWords)) {
                   if (isset($this->sc_conv_var[$nmgp_campo]))
                   {
                       $nmgp_campo = $this->sc_conv_var[$nmgp_campo];
                   }
                   elseif (isset($this->sc_conv_var[strtolower($nmgp_campo)]))
                   {
                       $nmgp_campo = $this->sc_conv_var[strtolower($nmgp_campo)];
                   }
               }
               $tmp_scfile_name     = $nmgp_campo . "_scfile_name";
               $tmp_scfile_type     = $nmgp_campo . "_scfile_type";
               $this->$nmgp_campo = is_array($nmgp_valores['tmp_name']) ? $nmgp_valores['tmp_name'][0] : $nmgp_valores['tmp_name'];
               $this->$tmp_scfile_type   = is_array($nmgp_valores['type'])     ? $nmgp_valores['type'][0]     : $nmgp_valores['type'];
               $this->$tmp_scfile_name   = is_array($nmgp_valores['name'])     ? $nmgp_valores['name'][0]     : $nmgp_valores['name'];
          }
      }
      $Sc_lig_md5 = false;
      if (!empty($_POST))
      {
          foreach ($_POST as $nmgp_var => $nmgp_val)
          {
               if (substr($nmgp_var, 0, 11) == "SC_glo_par_")
               {
                   $nmgp_var = substr($nmgp_var, 11);
                   $nmgp_val = $_SESSION[$nmgp_val];
               }
              if ($nmgp_var == "nmgp_parms" && substr($nmgp_val, 0, 21) == "NM_subcons_insert_new")
              {
                      $Sc_lig_md5 = true;
              }
              if ($nmgp_var == "nmgp_parms" && substr($nmgp_val, 0, 8) == "@SC_par@")
              {
                  $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
                  if (count($SC_Ind_Val) == 4 && isset($_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]]))
                  {
                      $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
                      $Sc_lig_md5 = true;
                  }
                  else
                  {
                      $_SESSION['sc_session']['SC_parm_violation'] = true;
                  }
              }
               if (!in_array(strtolower($nmgp_var), $this->scSajaxReservedWords)) {
                   if (isset($this->sc_conv_var[$nmgp_var]))
                   {
                       $nmgp_var = $this->sc_conv_var[$nmgp_var];
                   }
                   elseif (isset($this->sc_conv_var[strtolower($nmgp_var)]))
                   {
                       $nmgp_var = $this->sc_conv_var[strtolower($nmgp_var)];
                   }
               }
               $nmgp_val = NM_decode_input($nmgp_val);
               $this->$nmgp_var = $nmgp_val;
          }
      }
      if (!empty($_GET))
      {
          foreach ($_GET as $nmgp_var => $nmgp_val)
          {
               if (substr($nmgp_var, 0, 11) == "SC_glo_par_")
               {
                   $nmgp_var = substr($nmgp_var, 11);
                   $nmgp_val = $_SESSION[$nmgp_val];
               }
              if ($nmgp_var == "nmgp_parms" && substr($nmgp_val, 0, 21) == "NM_subcons_insert_new")
              {
                      $Sc_lig_md5 = true;
              }
              if ($nmgp_var == "nmgp_parms" && substr($nmgp_val, 0, 8) == "@SC_par@")
              {
                  $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
                  if (count($SC_Ind_Val) == 4 && isset($_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]]))
                  {
                      $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['Lig_Md5'][$SC_Ind_Val[3]];
                      $Sc_lig_md5 = true;
                  }
                  else
                  {
                       $_SESSION['sc_session']['SC_parm_violation'] = true;
                  }
              }
               if (!in_array(strtolower($nmgp_var), $this->scSajaxReservedWords)) {
                   if (isset($this->sc_conv_var[$nmgp_var]))
                   {
                       $nmgp_var = $this->sc_conv_var[$nmgp_var];
                   }
                   elseif (isset($this->sc_conv_var[strtolower($nmgp_var)]))
                   {
                       $nmgp_var = $this->sc_conv_var[strtolower($nmgp_var)];
                   }
               }
               $nmgp_val = NM_decode_input($nmgp_val);
               $this->$nmgp_var = $nmgp_val;
          }
      }
      if (isset($SC_lig_apl_orig) && !$Sc_lig_md5 && (!isset($nmgp_parms) || ($nmgp_parms != "SC_null" && substr($nmgp_parms, 0, 8) != "OrScLink")))
      {
          $_SESSION['sc_session']['SC_parm_violation'] = true;
      }
      if (isset($nmgp_parms) && $nmgp_parms == "SC_null")
      {
          $nmgp_parms = "";
      }
      if (isset($this->rsvp_global) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['rsvp_global'] = $this->rsvp_global;
      }
      if (isset($this->vg_usuario_id) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['vg_usuario_id'] = $this->vg_usuario_id;
      }
      if (isset($this->vg_cpfseg) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['vg_cpfseg'] = $this->vg_cpfseg;
      }
      if (isset($this->vg_menu_item) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['vg_menu_item'] = $this->vg_menu_item;
      }
      if (isset($this->parm1) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['parm1'] = $this->parm1;
      }
      if (isset($this->vg_evento_id) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['vg_evento_id'] = $this->vg_evento_id;
      }
      if (isset($_POST["rsvp_global"]) && isset($this->rsvp_global)) 
      {
          $_SESSION['rsvp_global'] = $this->rsvp_global;
      }
      if (isset($_POST["vg_usuario_id"]) && isset($this->vg_usuario_id)) 
      {
          $_SESSION['vg_usuario_id'] = $this->vg_usuario_id;
      }
      if (isset($_POST["vg_cpfseg"]) && isset($this->vg_cpfseg)) 
      {
          $_SESSION['vg_cpfseg'] = $this->vg_cpfseg;
      }
      if (isset($_POST["vg_menu_item"]) && isset($this->vg_menu_item)) 
      {
          $_SESSION['vg_menu_item'] = $this->vg_menu_item;
      }
      if (isset($_POST["parm1"]) && isset($this->parm1)) 
      {
          $_SESSION['parm1'] = $this->parm1;
      }
      if (isset($_POST["vg_evento_id"]) && isset($this->vg_evento_id)) 
      {
          $_SESSION['vg_evento_id'] = $this->vg_evento_id;
      }
      if (isset($_GET["rsvp_global"]) && isset($this->rsvp_global)) 
      {
          $_SESSION['rsvp_global'] = $this->rsvp_global;
      }
      if (isset($_GET["vg_usuario_id"]) && isset($this->vg_usuario_id)) 
      {
          $_SESSION['vg_usuario_id'] = $this->vg_usuario_id;
      }
      if (isset($_GET["vg_cpfseg"]) && isset($this->vg_cpfseg)) 
      {
          $_SESSION['vg_cpfseg'] = $this->vg_cpfseg;
      }
      if (isset($_GET["vg_menu_item"]) && isset($this->vg_menu_item)) 
      {
          $_SESSION['vg_menu_item'] = $this->vg_menu_item;
      }
      if (isset($_GET["parm1"]) && isset($this->parm1)) 
      {
          $_SESSION['parm1'] = $this->parm1;
      }
      if (isset($_GET["vg_evento_id"]) && isset($this->vg_evento_id)) 
      {
          $_SESSION['vg_evento_id'] = $this->vg_evento_id;
      }
      if (isset($this->Refresh_aba_menu)) {
          $_SESSION['sc_session'][$script_case_init]['form_tbl_hoteis']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_tbl_hoteis']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_tbl_hoteis']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_tbl_hoteis']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['form_tbl_hoteis']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['form_tbl_hoteis']['embutida_parms']);
      } 
      if (isset($this->nmgp_parms) && !empty($this->nmgp_parms)) 
      { 
          if (isset($_SESSION['nm_aba_bg_color'])) 
          { 
              unset($_SESSION['nm_aba_bg_color']);
          }   
          $nmgp_parms = str_replace("@aspass@", "'", $this->nmgp_parms);
          $nmgp_parms = str_replace("*scout", "?@?", $nmgp_parms);
          $nmgp_parms = str_replace("*scin", "?#?", $nmgp_parms);
          $todox = str_replace("?#?@?@?", "?#?@ ?@?", $nmgp_parms);
          $todo  = explode("?@?", $todox);
          $ix = 0;
          while (!empty($todo[$ix]))
          {
             $cadapar = explode("?#?", $todo[$ix]);
             if (1 < sizeof($cadapar))
             {
                if (substr($cadapar[0], 0, 11) == "SC_glo_par_")
                {
                    $cadapar[0] = substr($cadapar[0], 11);
                    $cadapar[1] = $_SESSION[$cadapar[1]];
                }
                 if (isset($this->sc_conv_var[$cadapar[0]]))
                 {
                     $cadapar[0] = $this->sc_conv_var[$cadapar[0]];
                 }
                 elseif (isset($this->sc_conv_var[strtolower($cadapar[0])]))
                 {
                     $cadapar[0] = $this->sc_conv_var[strtolower($cadapar[0])];
                 }
                 nm_limpa_str_form_tbl_hoteis($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
             }
             $ix++;
          }
          if (isset($this->inside_nested_grid) && 'Y' == $this->inside_nested_grid) {
              $_SESSION['sc_session'][$script_case_init]['form_tbl_hoteis']['inside_nested_iframe'] = true;
          }
          if (isset($this->rsvp_global)) 
          {
              $_SESSION['rsvp_global'] = $this->rsvp_global;
          }
          if (isset($this->vg_usuario_id)) 
          {
              $_SESSION['vg_usuario_id'] = $this->vg_usuario_id;
          }
          if (isset($this->vg_cpfseg)) 
          {
              $_SESSION['vg_cpfseg'] = $this->vg_cpfseg;
          }
          if (isset($this->vg_menu_item)) 
          {
              $_SESSION['vg_menu_item'] = $this->vg_menu_item;
          }
          if (isset($this->parm1)) 
          {
              $_SESSION['parm1'] = $this->parm1;
          }
          if (isset($this->vg_evento_id)) 
          {
              $_SESSION['vg_evento_id'] = $this->vg_evento_id;
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['form_tbl_hoteis']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['form_tbl_hoteis']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['form_tbl_hoteis']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['form_tbl_hoteis']['sc_redir_insert'] = $this->sc_redir_insert;
              unset($_SESSION['sc_session'][$script_case_init]['form_tbl_hoteis']['opc_ant']);
          }
          if (isset($this->rsvp_global)) 
          {
              $_SESSION['rsvp_global'] = $this->rsvp_global;
          }
          if (isset($this->vg_usuario_id)) 
          {
              $_SESSION['vg_usuario_id'] = $this->vg_usuario_id;
          }
          if (isset($this->vg_cpfseg)) 
          {
              $_SESSION['vg_cpfseg'] = $this->vg_cpfseg;
          }
          if (isset($this->vg_menu_item)) 
          {
              $_SESSION['vg_menu_item'] = $this->vg_menu_item;
          }
          if (isset($this->parm1)) 
          {
              $_SESSION['parm1'] = $this->parm1;
          }
          if (isset($this->vg_evento_id)) 
          {
              $_SESSION['vg_evento_id'] = $this->vg_evento_id;
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['form_tbl_hoteis']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['form_tbl_hoteis']['parms']);
              $todo  = explode("?@?", $todox);
              $ix = 0;
              while (!empty($todo[$ix]))
              {
                 $cadapar = explode("?#?", $todo[$ix]);
                 if (substr($cadapar[0], 0, 11) == "SC_glo_par_")
                 {
                     $cadapar[0] = substr($cadapar[0], 11);
                     $cadapar[1] = $_SESSION[$cadapar[1]];
                 }
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
                 $ix++;
              }
          }
      } 

      if (isset($this->nm_run_menu) && $this->nm_run_menu == 1)
      { 
          $_SESSION['sc_session'][$script_case_init]['form_tbl_hoteis']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['form_tbl_hoteis']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['form_tbl_hoteis']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['form_tbl_hoteis']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_tbl_hoteis']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['form_tbl_hoteis']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['form_tbl_hoteis']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['form_tbl_hoteis']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new form_tbl_hoteis_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("pt_br");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['initialize'];
          $this->Db = $this->Ini->Db; 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['initialize']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['initialize'])
          {
              $_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'on';
if (!isset($this->sc_temp_rsvp_global)) {$this->sc_temp_rsvp_global = (isset($_SESSION['rsvp_global'])) ? $_SESSION['rsvp_global'] : "";}
if (!isset($this->sc_temp_vg_cpfseg)) {$this->sc_temp_vg_cpfseg = (isset($_SESSION['vg_cpfseg'])) ? $_SESSION['vg_cpfseg'] : "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
if (!isset($this->sc_temp_parm1)) {$this->sc_temp_parm1 = (isset($_SESSION['parm1'])) ? $_SESSION['parm1'] : "";}
if (!isset($this->sc_temp_vg_menu_item)) {$this->sc_temp_vg_menu_item = (isset($_SESSION['vg_menu_item'])) ? $_SESSION['vg_menu_item'] : "";}
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
$id = $this->sc_temp_vg_usuario_id;
$this->sc_temp_vg_cpfseg = '';
$sql = "
  	SELECT 
		usuario_id,		
		usuario_cpf
	FROM	
		usuarios_rsvp 
	WHERE
		usuario_id = ".$this->Db->qstr($id)." 
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
	$this->sc_temp_vg_cpfseg = $this->rs[0][1];	
} else {
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
;
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Acesso Negado!";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_form_tbl_hoteis';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_tbl_hoteis';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Acesso Negado!";
 }
;	
	if (isset($this->Campos_Mens_erro) && !empty($this->Campos_Mens_erro))
{
 if (isset($this->sc_temp_vg_usuario_id)) { $_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
 if (isset($this->sc_temp_vg_menu_item)) { $_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
 if (isset($this->sc_temp_parm1)) { $_SESSION['parm1'] = $this->sc_temp_parm1;}
 if (isset($this->sc_temp_vg_evento_id)) { $_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
 if (isset($this->sc_temp_vg_cpfseg)) { $_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
 if (isset($this->sc_temp_rsvp_global)) { $_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
    if ($this->NM_ajax_flag)
    {
        $this->NM_ajax_info['redirExit']['action'] = "form_tbl_hoteis_fim.php?script_case_init=" . $this->form_encode_input($this->Ini->sc_page);
        $this->NM_ajax_info['redirExit']['metodo'] = 'location';
        $this->NM_ajax_info['redirExit']['target'] = "_self";
        $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $this->Ini->path_link . "" . SC_dir_app_name('WWW-Authenticate: <type> realm=<realm>') . "/";
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sc_outra_jan'])
        {
            $_SESSION['scriptcase']['sc_outra_jan'] = "form_tbl_hoteis";
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sc_outra_jan'] = false;
        }
        $_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'off';
        form_tbl_hoteis_pack_ajax_response();
        exit;
    }
?>
<!DOCTYPE html>

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<head>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
<?php
 if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
 {
?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
 }
?>
</head>
<body>
<?php
 $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $this->Ini->path_link . "" . SC_dir_app_name('WWW-Authenticate: <type> realm=<realm>') . "/";
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "form_tbl_hoteis";
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sc_outra_jan'] = false;
 }
?>
<TABLE border="0" cellspacing="1" cellpadding="2" bgcolor="#406080" bordercolor="#406080" align="center">
 <TR bgcolor="#FF0000">
  <TD  align="left"><FONT face="Verdana, Arial, sans-serif" size="2" color="#FFFFFF"><B><?php echo $this->Ini->Nm_lang['lang_errm_errt'] ?></B></FONT></TD>
 </TR>
 <TR bgcolor="#E4E8F0">
   <TD  align="center"><FONT face="Tahoma, Arial, sans-serif" size="2" color="#404040"><?php echo $this->Campos_Mens_erro ?></FONT></TD>
 </TR>
</TABLE>
<table align="center"><tr><td>
  <form name="Fexit" method=post
        action="form_tbl_hoteis_fim.php"
        target="_self">
    <input type=hidden name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page) ?>">
    <input type=submit value="OK">
  </form>
</td></tr></table>
</body>
</html>
<?php
   exit;
}
}	

$sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'form_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';
if (isset($this->sc_temp_vg_usuario_id)) { $_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_vg_menu_item)) { $_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
if (isset($this->sc_temp_parm1)) { $_SESSION['parm1'] = $this->sc_temp_parm1;}
if (isset($this->sc_temp_vg_evento_id)) { $_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_cpfseg)) { $_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
if (isset($this->sc_temp_rsvp_global)) { $_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
$_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'off';
          }
          $this->Ini->init2();
      } 
      else 
      { 
         $this->nm_data = new nm_data("pt_br");
      } 
      $_SESSION['sc_session'][$script_case_init]['form_tbl_hoteis']['upload_field_info'] = array();

      $_SESSION['sc_session'][$script_case_init]['form_tbl_hoteis']['upload_field_info']['hotel_logo'] = array(
          'app_dir'            => $this->Ini->path_aplicacao,
          'app_name'           => 'form_tbl_hoteis',
          'upload_dir'         => $this->Ini->root . $this->Ini->path_imag_temp . '/',
          'upload_url'         => $this->Ini->path_imag_temp . '/',
          'upload_type'        => 'single',
          'upload_allowed_type'  => '/.+$/i',
          'upload_max_size'  => null,
          'upload_ext_size_rules' => [],
          'upload_file_height' => '0',
          'upload_file_width'  => '0',
          'upload_file_aspect' => 'S',
          'upload_file_type'   => 'I',
      );

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_tbl_hoteis']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_tbl_hoteis'];
          }
          elseif (isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']]))
          {
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']] as $init => $resto)
              {
                  if ($this->Ini->sc_page == $init)
                  {
                      $this->sc_init_menu = $init;
                      break;
                  }
              }
          }
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_tbl_hoteis']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_tbl_hoteis']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('form_tbl_hoteis') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_tbl_hoteis']['label'] = "BRSVP - Cadastro de Hotéis Edição";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "form_tbl_hoteis")
                  {
                      $achou = true;
                  }
                  elseif ($achou)
                  {
                      unset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu][$apl]);
                      $this->Change_Menu = true;
                  }
              }
          }
      }
      if (!function_exists("nmButtonOutput"))
      {
          include_once($this->Ini->path_lib_php . "nm_gp_config_btn.php");
      }
      include("../_lib/css/" . $this->Ini->str_schema_all . "_form.php");
      $this->Ini->Str_btn_form    = trim($str_button);
      include($this->Ini->path_btn . $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form . $_SESSION['scriptcase']['reg_conf']['css_dir'] . '.php');
      $_SESSION['scriptcase']['css_form_help'] = '../_lib/css/' . $this->Ini->str_schema_all . "_form.css";
      $_SESSION['scriptcase']['css_form_help_dir'] = '../_lib/css/' . $this->Ini->str_schema_all . "_form" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
      $_SESSION['scriptcase']['css_popup']                 = $this->Ini->str_schema_all . "_grid.css";
      $_SESSION['scriptcase']['css_popup_dir']             = $this->Ini->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
      $_SESSION['scriptcase']['css_popup_tab']             = $this->Ini->str_schema_all . "_tab.css";
      $_SESSION['scriptcase']['css_popup_tab_dir']         = $this->Ini->str_schema_all . "_tab" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
      $_SESSION['scriptcase']['css_popup_div']             = $this->Ini->str_schema_all . "_appdiv.css";
      $_SESSION['scriptcase']['css_popup_div_dir']         = $this->Ini->str_schema_all . "_appdiv" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
      $_SESSION['scriptcase']['css_btn_popup']             = $this->Ini->Str_btn_form . "/" . $this->Ini->Str_btn_form . ".css";
      $_SESSION['sc_session']['path_third']                = $this->Ini->path_prod . "/third";
      $_SESSION['scriptcase']['bg_btn_popup']['bok']       = nmButtonOutput($this->arr_buttons, "bok_appdiv", "processa(); if (self.parent && self.parent.tb_remove) {self.parent.tb_remove();} ", "processa(); if (self.parent && self.parent.tb_remove) {self.parent.tb_remove();} ", "bok", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");
      $_SESSION['scriptcase']['bg_btn_popup']['btbremove'] = nmButtonOutput($this->arr_buttons, "bsair_appdiv", "self.parent.tb_remove()", "self.parent.tb_remove()", "bsair", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");
      $this->Db = $this->Ini->Db; 
      $this->Ini->str_google_fonts = isset($str_google_fonts)?$str_google_fonts:'';
      $this->Ini->Img_sep_form    = "/" . trim($str_toolbar_separator);
      $this->Ini->Color_bg_ajax   = !isset($str_ajax_bg)         || "" == trim($str_ajax_bg)         ? "#000" : $str_ajax_bg;
      $this->Ini->Border_c_ajax   = !isset($str_ajax_border_c)   || "" == trim($str_ajax_border_c)   ? ""     : $str_ajax_border_c;
      $this->Ini->Border_s_ajax   = !isset($str_ajax_border_s)   || "" == trim($str_ajax_border_s)   ? ""     : $str_ajax_border_s;
      $this->Ini->Border_w_ajax   = !isset($str_ajax_border_w)   || "" == trim($str_ajax_border_w)   ? ""     : $str_ajax_border_w;
      $this->Ini->Block_img_exp   = !isset($str_block_exp)       || "" == trim($str_block_exp)       ? ""     : $str_block_exp;
      $this->Ini->Block_img_col   = !isset($str_block_col)       || "" == trim($str_block_col)       ? ""     : $str_block_col;
      $this->Ini->Msg_ico_title   = !isset($str_msg_ico_title)   || "" == trim($str_msg_ico_title)   ? ""     : $str_msg_ico_title;
      $this->Ini->Msg_ico_body    = !isset($str_msg_ico_body)    || "" == trim($str_msg_ico_body)    ? ""     : $str_msg_ico_body;
      $this->Ini->Err_ico_title   = !isset($str_err_ico_title)   || "" == trim($str_err_ico_title)   ? ""     : $str_err_ico_title;
      $this->Ini->Err_ico_body    = !isset($str_err_ico_body)    || "" == trim($str_err_ico_body)    ? ""     : $str_err_ico_body;
      $this->Ini->Cal_ico_back    = !isset($str_cal_ico_back)    || "" == trim($str_cal_ico_back)    ? ""     : $str_cal_ico_back;
      $this->Ini->Cal_ico_for     = !isset($str_cal_ico_for)     || "" == trim($str_cal_ico_for)     ? ""     : $str_cal_ico_for;
      $this->Ini->Cal_ico_close   = !isset($str_cal_ico_close)   || "" == trim($str_cal_ico_close)   ? ""     : $str_cal_ico_close;
      $this->Ini->Tab_space       = !isset($str_tab_space)       || "" == trim($str_tab_space)       ? ""     : $str_tab_space;
      $this->Ini->Bubble_tail     = !isset($str_bubble_tail)     || "" == trim($str_bubble_tail)     ? ""     : $str_bubble_tail;
      $this->Ini->Label_sort_pos  = !isset($str_label_sort_pos)  || "" == trim($str_label_sort_pos)  ? ""     : $str_label_sort_pos;
      $this->Ini->Label_sort      = !isset($str_label_sort)      || "" == trim($str_label_sort)      ? ""     : $str_label_sort;
      $this->Ini->Label_sort_asc  = !isset($str_label_sort_asc)  || "" == trim($str_label_sort_asc)  ? ""     : $str_label_sort_asc;
      $this->Ini->Label_sort_desc = !isset($str_label_sort_desc) || "" == trim($str_label_sort_desc) ? ""     : $str_label_sort_desc;
      $this->Ini->Img_status_ok       = !isset($str_img_status_ok)  || "" == trim($str_img_status_ok)   ? ""     : $str_img_status_ok;
      $this->Ini->Img_status_err      = !isset($str_img_status_err) || "" == trim($str_img_status_err)  ? ""     : $str_img_status_err;
      $this->Ini->Css_status          = "scFormInputError";
      $this->Ini->Css_status_pwd_box  = "scFormInputErrorPwdBox";
      $this->Ini->Css_status_pwd_text = "scFormInputErrorPwdText";
      $this->Ini->Error_icon_span      = !isset($str_error_icon_span)  || "" == trim($str_error_icon_span)  ? false  : "message" == $str_error_icon_span;
      $this->Ini->Img_qs_search        = !isset($img_qs_search)        || "" == trim($img_qs_search)        ? "scriptcase__NM__qs_lupa.png"  : $img_qs_search;
      $this->Ini->Img_qs_clean         = !isset($img_qs_clean)         || "" == trim($img_qs_clean)         ? "scriptcase__NM__qs_close.png" : $img_qs_clean;
      $this->Ini->Str_qs_image_padding = !isset($str_qs_image_padding) || "" == trim($str_qs_image_padding) ? "0"                            : $str_qs_image_padding;
      $this->Ini->App_div_tree_img_col = trim($app_div_str_tree_col);
      $this->Ini->App_div_tree_img_exp = trim($app_div_str_tree_exp);
      $this->Ini->form_table_width     = isset($str_form_table_width) && '' != trim($str_form_table_width) ? $str_form_table_width : '';
      $this->Ini->Bubble_tail          = trim($str_bubble_tail);

        $this->classes_100perc_fields['table'] = '';
        $this->classes_100perc_fields['input'] = '';
        $this->classes_100perc_fields['span_input'] = '';
        $this->classes_100perc_fields['span_select'] = '';
        $this->classes_100perc_fields['style_category'] = '';
        $this->classes_100perc_fields['keep_field_size'] = true;



      $_SESSION['scriptcase']['error_icon']['form_tbl_hoteis']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['form_tbl_hoteis'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      if (isset($this->NM_ajax_info['param']['hotel_logo_ul_name']) && '' != $this->NM_ajax_info['param']['hotel_logo_ul_name'])
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['upload_field_ul_name'][$this->hotel_logo_ul_name]))
          {
              $this->NM_ajax_info['param']['hotel_logo_ul_name'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['upload_field_ul_name'][$this->hotel_logo_ul_name];
          }
          $this->hotel_logo = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->NM_ajax_info['param']['hotel_logo_ul_name'];
          $this->hotel_logo_scfile_name = substr($this->NM_ajax_info['param']['hotel_logo_ul_name'], 12);
          $this->hotel_logo_scfile_type = $this->NM_ajax_info['param']['hotel_logo_ul_type'];
          $this->hotel_logo_ul_name = $this->NM_ajax_info['param']['hotel_logo_ul_name'];
          $this->hotel_logo_ul_type = $this->NM_ajax_info['param']['hotel_logo_ul_type'];
      }
      elseif (isset($this->hotel_logo_ul_name) && '' != $this->hotel_logo_ul_name)
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['upload_field_ul_name'][$this->hotel_logo_ul_name]))
          {
              $this->hotel_logo_ul_name = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['upload_field_ul_name'][$this->hotel_logo_ul_name];
          }
          $this->hotel_logo = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->hotel_logo_ul_name;
          $this->hotel_logo_scfile_name = substr($this->hotel_logo_ul_name, 12);
          $this->hotel_logo_scfile_type = $this->hotel_logo_ul_type;
      }

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['goto']      = 'on';
          }
      }

      $this->nmgp_botoes['cancel'] = "on";
      $this->nmgp_botoes['exit'] = "on";
      $this->nmgp_botoes['qsearch'] = "on";
      $this->nmgp_botoes['new'] = "on";
      $this->nmgp_botoes['insert'] = "on";
      $this->nmgp_botoes['copy'] = "off";
      $this->nmgp_botoes['update'] = "on";
      $this->nmgp_botoes['delete'] = "on";
      $this->nmgp_botoes['first'] = "on";
      $this->nmgp_botoes['back'] = "on";
      $this->nmgp_botoes['forward'] = "on";
      $this->nmgp_botoes['last'] = "on";
      $this->nmgp_botoes['summary'] = "on";
      $this->nmgp_botoes['navpage'] = "on";
      $this->nmgp_botoes['goto'] = "on";
      $this->nmgp_botoes['qtline'] = "off";
      $this->nmgp_botoes['reload'] = "off";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_orig'] = "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_pesq'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_tbl_hoteis']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_tbl_hoteis'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_tbl_hoteis'];

              if (!$tmpDashboardButtons['form_navigate']) { 
                  $this->nmgp_botoes['first']   = 'off';
                  $this->nmgp_botoes['back']    = 'off';
                  $this->nmgp_botoes['last']    = 'off';
                  $this->nmgp_botoes['forward'] = 'off';
              }
              if (!$tmpDashboardButtons['form_update'])    { $this->nmgp_botoes['update']    = 'off';}
              if (!$tmpDashboardButtons['form_insert'])    { $this->nmgp_botoes['new']       = 'off';}
              if (!$tmpDashboardButtons['form_insert'])    { $this->nmgp_botoes['insert']    = 'off';}
              if (!$tmpDashboardButtons['form_delete'])    { $this->nmgp_botoes['delete']    = 'off';}
              if (!$tmpDashboardButtons['form_copy'])      { $this->nmgp_botoes['copy']      = 'off';}
              if (!$tmpDashboardButtons['form_navpage'])   { $this->nmgp_botoes['navpage']   = 'off';}
              if (!$tmpDashboardButtons['form_goto'])      { $this->nmgp_botoes['goto']      = 'off';}
              if (!$tmpDashboardButtons['form_lineqty'])   { $this->nmgp_botoes['qtline']    = 'off';}
              if (!$tmpDashboardButtons['form_summary'])   { $this->nmgp_botoes['summary']   = 'off';}
              if (!$tmpDashboardButtons['form_qsearch'])   { $this->nmgp_botoes['qsearch']   = 'off';}
              if (!$tmpDashboardButtons['form_dynsearch']) { $this->nmgp_botoes['dynsearch'] = 'off';}
              if (!$tmpDashboardButtons['form_reload'])    { $this->nmgp_botoes['reload']    = 'off';}
          }
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dados_form'];
          if (!isset($this->rodape)){$this->rodape = $this->nmgp_dados_form['rodape'];} 
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("form_tbl_hoteis", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
      {
          $this->aba_iframe = true;
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_limpa.php", "F", "nm_limpa_valor") ; 
      $this->Ini->sc_Include($this->Ini->path_libs . "/nm_gc.php", "F", "nm_gc") ; 
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
      nm_gc($this->Ini->path_libs);
      $this->Ini->Gd_missing  = true;
      if(function_exists("getProdVersion"))
      {
         $_SESSION['scriptcase']['sc_prod_Version'] = str_replace(".", "", getProdVersion($this->Ini->path_libs));
         if(function_exists("gd_info"))
         {
            $this->Ini->Gd_missing = false;
         }
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_trata_img.php", "C", "nm_trata_img") ; 

      if (is_file($this->Ini->path_aplicacao . 'form_tbl_hoteis_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'form_tbl_hoteis_help.txt');
          if ($arr_link_webhelp)
          {
              foreach ($arr_link_webhelp as $str_link_webhelp)
              {
                  $str_link_webhelp = trim($str_link_webhelp);
                  if ('form:' == substr($str_link_webhelp, 0, 5))
                  {
                      $arr_link_parts = explode(':', $str_link_webhelp);
                      if ('' != $arr_link_parts[1] && is_file($this->Ini->root . $this->Ini->path_help . $arr_link_parts[1]))
                      {
                          $this->url_webhelp = $this->Ini->path_help . $arr_link_parts[1];
                      }
                  }
              }
          }
      }

      if (is_dir($this->Ini->path_aplicacao . 'img'))
      {
          $Res_dir_img = @opendir($this->Ini->path_aplicacao . 'img');
          if ($Res_dir_img)
          {
              while (FALSE !== ($Str_arquivo = @readdir($Res_dir_img))) 
              {
                 if (@is_file($this->Ini->path_aplicacao . 'img/' . $Str_arquivo) && '.' != $Str_arquivo && '..' != $this->Ini->path_aplicacao . 'img/' . $Str_arquivo)
                 {
                     @unlink($this->Ini->path_aplicacao . 'img/' . $Str_arquivo);
                 }
              }
          }
          @closedir($Res_dir_img);
          rmdir($this->Ini->path_aplicacao . 'img');
      }

      if ($this->Embutida_proc)
      { 
          require_once($this->Ini->path_embutida . 'form_tbl_hoteis/form_tbl_hoteis_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "form_tbl_hoteis_erro.class.php"); 
      }
      $this->Erro      = new form_tbl_hoteis_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if ($this->nmgp_opcao == "fast_search")  
      {
          $this->SC_fast_search($this->nmgp_fast_search, $this->nmgp_cond_fast_search, $this->nmgp_arg_fast_search);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['opcao'] = "inicio";
          $this->nmgp_opcao = "inicio";
          $this->proc_fast_search = true;
      } 
      if ((!isset($nm_opc_lookup) || $nm_opc_lookup != "lookup") && (!isset($nm_opc_php) || $nm_opc_php != "formphp"))
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['opcao']))
         { 
             if ($this->hotel_id != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['form_tbl_hoteis']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dados_form'];
      }
      if ($this->nmgp_opcao == "edit_novo")  
      {
          $this->nmgp_opcao = "novo";
          $this->nm_flag_saida_novo = "S";
      }
//
      $this->NM_case_insensitive = true;
      $this->sc_evento = $this->nmgp_opcao;
      $this->sc_insert_on = false;
      if (!isset($this->NM_ajax_flag) || ('validate_' != substr($this->NM_ajax_opcao, 0, 9) && 'add_new_line' != $this->NM_ajax_opcao && 'autocomp_' != substr($this->NM_ajax_opcao, 0, 9)))
      {
      $_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'on';
if (!isset($this->sc_temp_rsvp_global)) {$this->sc_temp_rsvp_global = (isset($_SESSION['rsvp_global'])) ? $_SESSION['rsvp_global'] : "";}
if (!isset($this->sc_temp_vg_cpfseg)) {$this->sc_temp_vg_cpfseg = (isset($_SESSION['vg_cpfseg'])) ? $_SESSION['vg_cpfseg'] : "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
if (!isset($this->sc_temp_parm1)) {$this->sc_temp_parm1 = (isset($_SESSION['parm1'])) ? $_SESSION['parm1'] : "";}
if (!isset($this->sc_temp_vg_menu_item)) {$this->sc_temp_vg_menu_item = (isset($_SESSION['vg_menu_item'])) ? $_SESSION['vg_menu_item'] : "";}
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
$usunivel = $this->GetUsuarioNivel($this->sc_temp_vg_usuario_id,'nivel');
$this->RetNivel($usunivel);
$cpfseg = $this->GetUsuarioNivel($this->sc_temp_vg_usuario_id,'cpf');
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
;
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Acesso Negado!";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_form_tbl_hoteis';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_tbl_hoteis';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Acesso Negado!";
 }
;	
	if (isset($this->Campos_Mens_erro) && !empty($this->Campos_Mens_erro))
{
 if (isset($this->sc_temp_vg_usuario_id)) { $_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
 if (isset($this->sc_temp_vg_menu_item)) { $_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
 if (isset($this->sc_temp_parm1)) { $_SESSION['parm1'] = $this->sc_temp_parm1;}
 if (isset($this->sc_temp_vg_evento_id)) { $_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
 if (isset($this->sc_temp_vg_cpfseg)) { $_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
 if (isset($this->sc_temp_rsvp_global)) { $_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
    if ($this->NM_ajax_flag)
    {
        $this->NM_ajax_info['redirExit']['action'] = "form_tbl_hoteis_fim.php?script_case_init=" . $this->form_encode_input($this->Ini->sc_page);
        $this->NM_ajax_info['redirExit']['metodo'] = 'location';
        $this->NM_ajax_info['redirExit']['target'] = "_self";
        $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $this->Ini->path_link . "" . SC_dir_app_name('WWW-Authenticate: <type> realm=<realm>') . "/";
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sc_outra_jan'])
        {
            $_SESSION['scriptcase']['sc_outra_jan'] = "form_tbl_hoteis";
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sc_outra_jan'] = false;
        }
        $_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'off';
        form_tbl_hoteis_pack_ajax_response();
        exit;
    }
?>
<!DOCTYPE html>

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<head>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
<?php
 if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
 {
?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
 }
?>
</head>
<body>
<?php
 $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $this->Ini->path_link . "" . SC_dir_app_name('WWW-Authenticate: <type> realm=<realm>') . "/";
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "form_tbl_hoteis";
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sc_outra_jan'] = false;
 }
?>
<TABLE border="0" cellspacing="1" cellpadding="2" bgcolor="#406080" bordercolor="#406080" align="center">
 <TR bgcolor="#FF0000">
  <TD  align="left"><FONT face="Verdana, Arial, sans-serif" size="2" color="#FFFFFF"><B><?php echo $this->Ini->Nm_lang['lang_errm_errt'] ?></B></FONT></TD>
 </TR>
 <TR bgcolor="#E4E8F0">
   <TD  align="center"><FONT face="Tahoma, Arial, sans-serif" size="2" color="#404040"><?php echo $this->Campos_Mens_erro ?></FONT></TD>
 </TR>
</TABLE>
<table align="center"><tr><td>
  <form name="Fexit" method=post
        action="form_tbl_hoteis_fim.php"
        target="_self">
    <input type=hidden name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page) ?>">
    <input type=submit value="OK">
  </form>
</td></tr></table>
</body>
</html>
<?php
   exit;
}
}
if (isset($this->sc_temp_vg_usuario_id)) { $_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_vg_menu_item)) { $_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
if (isset($this->sc_temp_parm1)) { $_SESSION['parm1'] = $this->sc_temp_parm1;}
if (isset($this->sc_temp_vg_evento_id)) { $_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_cpfseg)) { $_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
if (isset($this->sc_temp_rsvp_global)) { $_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
$_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'off'; 
      }
            if ('ajax_check_file' == $this->nmgp_opcao ){
                 ob_start(); 
                 global $bol_api_prod; 
                 $bol_api_prod = true; 
                 if (isset($_SESSION['scriptcase']['form_tbl_hoteis']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['form_tbl_hoteis']['glo_nm_conexao'])) 
                 { 
                     $bol_api_prod = false;
                 } 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['form_tbl_hoteis']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['form_tbl_hoteis']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
            copy($__file_download, $_SERVER['DOCUMENT_ROOT'].$orig_img);
            echo $orig_img . '_@@NM@@_';            copy($__file_download, $_SERVER['DOCUMENT_ROOT'].$out1_img_cache);
            $sc_obj_img = new nm_trata_img($_SERVER['DOCUMENT_ROOT'].$out1_img_cache, true);

            if(!empty($img_width) && !empty($img_height)){
                $sc_obj_img->setWidth($img_width);
                $sc_obj_img->setHeight($img_height);
            }            $sc_obj_img->createImg($_SERVER['DOCUMENT_ROOT'].$out1_img_cache);
            echo $out1_img_cache;
               exit;
            }
      if (isset($this->hotel_id)) { $this->nm_limpa_alfa($this->hotel_id); }
      if (isset($this->hotel_cnpj)) { $this->nm_limpa_alfa($this->hotel_cnpj); }
      if (isset($this->hotel_fantasia)) { $this->nm_limpa_alfa($this->hotel_fantasia); }
      if (isset($this->hotel_razsoc)) { $this->nm_limpa_alfa($this->hotel_razsoc); }
      if (isset($this->hotel_descricao)) { $this->nm_limpa_alfa($this->hotel_descricao); }
      if (isset($this->hotel_rede)) { $this->nm_limpa_alfa($this->hotel_rede); }
      if (isset($this->hotel_cep)) { $this->nm_limpa_alfa($this->hotel_cep); }
      if (isset($this->hotel_pais)) { $this->nm_limpa_alfa($this->hotel_pais); }
      if (isset($this->hotel_uf)) { $this->nm_limpa_alfa($this->hotel_uf); }
      if (isset($this->hotel_municipio)) { $this->nm_limpa_alfa($this->hotel_municipio); }
      if (isset($this->hotel_bairro)) { $this->nm_limpa_alfa($this->hotel_bairro); }
      if (isset($this->hotel_logradouro)) { $this->nm_limpa_alfa($this->hotel_logradouro); }
      if (isset($this->hotel_numero)) { $this->nm_limpa_alfa($this->hotel_numero); }
      if (isset($this->hotel_complemento)) { $this->nm_limpa_alfa($this->hotel_complemento); }
      if (isset($this->hotel_email)) { $this->nm_limpa_alfa($this->hotel_email); }
      if (isset($this->hotel_telefone)) { $this->nm_limpa_alfa($this->hotel_telefone); }
      if (isset($this->hotel_fax)) { $this->nm_limpa_alfa($this->hotel_fax); }
      if (isset($this->hotel_celular)) { $this->nm_limpa_alfa($this->hotel_celular); }
      if (isset($this->hotel_website)) { $this->nm_limpa_alfa($this->hotel_website); }
      if (isset($this->hotel_facebook)) { $this->nm_limpa_alfa($this->hotel_facebook); }
      if (isset($this->hotel_twitter)) { $this->nm_limpa_alfa($this->hotel_twitter); }
      if (isset($this->hotel_skype)) { $this->nm_limpa_alfa($this->hotel_skype); }
      if (isset($this->hotel_classificacao)) { $this->nm_limpa_alfa($this->hotel_classificacao); }
      if (isset($this->hotel_categoria)) { $this->nm_limpa_alfa($this->hotel_categoria); }
      if (isset($this->hotel_cod_estrangeiro)) { $this->nm_limpa_alfa($this->hotel_cod_estrangeiro); }
      $Campos_Crit       = "";
      $Campos_erro       = "";
      $Campos_Falta      = array();
      $Campos_Erros      = array();
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          =  substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
      //-- hotel_id
      $this->field_config['hotel_id']               = array();
      $this->field_config['hotel_id']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['hotel_id']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['hotel_id']['symbol_dec'] = '';
      $this->field_config['hotel_id']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['hotel_id']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
   }

   function controle()
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;


      $this->ini_controle();

      if ('' != $_SESSION['scriptcase']['change_regional_old'])
      {
          $_SESSION['scriptcase']['str_conf_reg'] = $_SESSION['scriptcase']['change_regional_old'];
          $this->Ini->regionalDefault($_SESSION['scriptcase']['str_conf_reg']);
          $this->loadFieldConfig();
          $this->nm_tira_formatacao();

          $_SESSION['scriptcase']['str_conf_reg'] = $_SESSION['scriptcase']['change_regional_new'];
          $this->Ini->regionalDefault($_SESSION['scriptcase']['str_conf_reg']);
          $this->loadFieldConfig();
          $guarda_formatado = $this->formatado;
          $this->nm_formatar_campos();
          $this->formatado = $guarda_formatado;

          $_SESSION['scriptcase']['change_regional_old'] = '';
          $_SESSION['scriptcase']['change_regional_new'] = '';
      }

      if ($nm_form_submit == 1 && ($this->nmgp_opcao == 'inicio' || $this->nmgp_opcao == 'igual'))
      {
          $this->nm_tira_formatacao();
      }
      if (!$this->NM_ajax_flag || 'alterar' != $this->nmgp_opcao || 'submit_form' != $this->NM_ajax_opcao)
      {
      }
//
//-----> 
//
      if ($this->NM_ajax_flag && 'validate_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          if ('validate_hotel_id' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_id');
          }
          if ('validate_hotel_cnpj' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_cnpj');
          }
          if ('validate_hotel_fantasia' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_fantasia');
          }
          if ('validate_hotel_razsoc' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_razsoc');
          }
          if ('validate_hotel_descricao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_descricao');
          }
          if ('validate_hotel_rede' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_rede');
          }
          if ('validate_hotel_classificacao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_classificacao');
          }
          if ('validate_hotel_categoria' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_categoria');
          }
          if ('validate_hotel_logo' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_logo');
          }
          if ('validate_hotel_cep' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_cep');
          }
          if ('validate_hotel_pais' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_pais');
          }
          if ('validate_hotel_uf' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_uf');
          }
          if ('validate_hotel_municipio' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_municipio');
          }
          if ('validate_hotel_bairro' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_bairro');
          }
          if ('validate_hotel_logradouro' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_logradouro');
          }
          if ('validate_hotel_numero' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_numero');
          }
          if ('validate_hotel_complemento' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_complemento');
          }
          if ('validate_localizacao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'localizacao');
          }
          if ('validate_hotel_observacoes' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_observacoes');
          }
          if ('validate_hotel_email' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_email');
          }
          if ('validate_hotel_website' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_website');
          }
          if ('validate_hotel_telefone' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_telefone');
          }
          if ('validate_hotel_fax' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_fax');
          }
          if ('validate_hotel_celular' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_celular');
          }
          if ('validate_hotel_status' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_status');
          }
          if ('validate_hotel_facebook' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_facebook');
          }
          if ('validate_hotel_twitter' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_twitter');
          }
          if ('validate_hotel_skype' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_skype');
          }
          if ('validate_hotel_ar_condicionado' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_ar_condicionado');
          }
          if ('validate_hotel_frigobar' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_frigobar');
          }
          if ('validate_hotel_lavanderia' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_lavanderia');
          }
          if ('validate_hotel_telefone_quarto' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_telefone_quarto');
          }
          if ('validate_hotel_tv' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_tv');
          }
          if ('validate_hotel_ginastica' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_ginastica');
          }
          if ('validate_hotel_restaurante' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_restaurante');
          }
          if ('validate_hotel_bar' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_bar');
          }
          if ('validate_hotel_estacionamento' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_estacionamento');
          }
          if ('validate_hotel_sauna' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_sauna');
          }
          if ('validate_hotel_piscina' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_piscina');
          }
          if ('validate_hotel_wifi' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_wifi');
          }
          if ('validate_hotel_computador' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_computador');
          }
          if ('validate_hotel_convencoes' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_convencoes');
          }
          if ('validate_hotel_cod_estrangeiro' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hotel_cod_estrangeiro');
          }
          form_tbl_hoteis_pack_ajax_response();
          exit;
      }
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6))
      {
          $this->nm_tira_formatacao();
          if ('event_hotel_cnpj_onchange' == $this->NM_ajax_opcao)
          {
              $this->hotel_cnpj_onChange();
          }
          if ('event_hotel_descricao_onfocus' == $this->NM_ajax_opcao)
          {
              $this->hotel_descricao_onFocus();
          }
          if ('event_hotel_numero_onchange' == $this->NM_ajax_opcao)
          {
              $this->hotel_numero_onChange();
          }
          form_tbl_hoteis_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->upload_img_doc($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          $this->nm_tira_formatacao();
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          $this->nm_acessa_banco();
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              form_tbl_hoteis_pack_ajax_response();
              exit;
          }
          $this->nm_formatar_campos();
          $this->nmgp_opcao = $nm_sc_sv_opcao; 
          $this->nm_gera_html();
          $this->NM_close_db(); 
          $this->nmgp_opcao = ""; 
          exit; 
      }
      if ($this->nmgp_opcao == "incluir" || $this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "excluir") 
      {
          $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          $_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  form_tbl_hoteis_pack_ajax_response();
                  exit;
              }
              $campos_erro = $this->Formata_Erros($Campos_Crit, $Campos_Falta, $Campos_Erros, 4);
              $this->Campos_Mens_erro = ""; 
              $this->Erro->mensagem(__FILE__, __LINE__, "critica", $campos_erro, '', true, true); 
              $this->nmgp_opc_ant = $this->nmgp_opcao ; 
              if ($this->nmgp_opcao == "incluir" && $nm_apl_dependente == 1) 
              { 
                  $this->nm_flag_saida_novo = "S";; 
              }
              if ($this->nmgp_opcao == "incluir") 
              { 
                  $GLOBALS["erro_incl"] = 1; 
              }
              $this->nmgp_opcao = "nada" ; 
          }
      }
      elseif (isset($nm_form_submit) && 1 == $nm_form_submit && $this->nmgp_opcao != "menu_link" && $this->nmgp_opcao != "recarga_mobile")
      {
      }
//
      if ($this->nmgp_opcao != "nada")
      {
          $this->nm_acessa_banco();
      }
      else
      {
           if ($this->nmgp_opc_ant == "incluir") 
           { 
               $this->nm_proc_onload(false);
           }
           else
           { 
              $this->nm_guardar_campos();
           }
      }
      if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form" && !$this->Apl_com_erro)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_evento == "insert" || ($this->nmgp_opc_ant == "novo" && $this->nmgp_opcao == "novo" && $this->sc_evento == "novo"))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sc_redir_atualiz'] == "ok")
          {
              if ($this->sc_evento == "update")
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
              if ($this->sc_evento == "delete")
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
      }
      if ($this->NM_ajax_flag && 'navigate_form' == $this->NM_ajax_opcao)
      {
          $_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_hotel_id = $this->hotel_id;
}
  date_default_timezone_set('America/Sao_Paulo');
$sql = "
	SELECT
		hosp_id_hotel
	FROM
		hospedagem_rsvp
	WHERE
		hosp_id_hotel = ".$this->Db->qstr($this->hotel_id )."
	ORDER BY
		hosp_id_hotel
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
	$this->NM_ajax_info['buttonDisplay']['delete'] = $this->nmgp_botoes["delete"] = 'off';;
} else {
	$this->NM_ajax_info['buttonDisplay']['delete'] = $this->nmgp_botoes["delete"] = 'on';;
	if (isset($this->Campos_Mens_erro) && !empty($this->Campos_Mens_erro))
{
    if ($this->NM_ajax_flag)
    {
        $_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'off';
        form_tbl_hoteis_pack_ajax_response();
        exit;
    }
    $Sc_Lixo = ob_get_clean();
    $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro);
    $_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'off';
    $this->Campos_Mens_erro = "";
    if ($this->nmgp_opcao == "incluir") {$this->nmgp_opcao = "novo";};
    $this->nm_proc_onload();
    $this->nm_formatar_campos();
    $this->nm_gera_html();
    $this->NM_close_db();
    exit;
}
}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (isset($Ctrl_Proc_Onload) && $Ctrl_Proc_Onload) {
        $Ctrl_Format = true;
        $this->nm_guardar_campos();
        if ($bFormat) $this->nm_formatar_campos();
    }
    if (($original_hotel_id != $this->hotel_id || (isset($bFlagRead_hotel_id) && $bFlagRead_hotel_id)))
    {
        $this->ajax_return_values_hotel_id(true);
    }
}
$_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'off'; 
          $this->ajax_return_values();
          $this->ajax_add_parameters();
          form_tbl_hoteis_pack_ajax_response();
          exit;
      }
      $this->nm_formatar_campos();
      if ($this->NM_ajax_flag)
      {
          $this->NM_ajax_info['result'] = 'OK';
          if ('alterar' == $this->NM_ajax_info['param']['nmgp_opcao'])
          {
              $this->NM_ajax_info['msgDisplay'] = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_ajax_frmu']);
          }
          form_tbl_hoteis_pack_ajax_response();
          exit;
      }
      $this->nm_gera_html();
      $this->NM_close_db(); 
      $this->nmgp_opcao = ""; 
      if ($this->Change_Menu)
      {
          $apl_menu  = $_SESSION['scriptcase']['menu_atual'];
          $Arr_rastro = array();
          if (isset($_SESSION['scriptcase']['menu_apls'][$apl_menu][$this->sc_init_menu]) && count($_SESSION['scriptcase']['menu_apls'][$apl_menu][$this->sc_init_menu]) > 1)
          {
              foreach ($_SESSION['scriptcase']['menu_apls'][$apl_menu][$this->sc_init_menu] as $menu => $apls)
              {
                 $Arr_rastro[] = "'<a href=\"" . $apls['link'] . "?script_case_init=" . $this->sc_init_menu . "\" target=\"#NMIframe#\">" . $apls['label'] . "</a>'";
              }
              $ult_apl = count($Arr_rastro) - 1;
              unset($Arr_rastro[$ult_apl]);
              $rastro = implode(",", $Arr_rastro);
?>
  <script type="text/javascript">
     link_atual = new Array (<?php echo $rastro ?>);
     if (parent.writeFastMenu)
     {
         parent.writeFastMenu(link_atual);
     }
  </script>
<?php
          }
          else
          {
?>
  <script type="text/javascript">
     if (parent.clearFastMenu)
     {
        parent.clearFastMenu();
     }
  </script>
<?php
          }
      }
   }
  function html_export_print($nm_arquivo_html, $nmgp_password)
  {
      $Html_password = "";
          $Arq_base  = $this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_html;
          $Parm_pass = ($Html_password != "") ? " -p" : "";
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "form_tbl_hoteis.zip";
          $Arq_htm = $this->Ini->path_imag_temp . "/" . $Zip_name;
          $Arq_zip = $this->Ini->root . $Arq_htm;
          $Zip_f     = (FALSE !== strpos($Arq_zip, ' ')) ? " \"" . $Arq_zip . "\"" :  $Arq_zip;
          $Arq_input = (FALSE !== strpos($Arq_base, ' ')) ? " \"" . $Arq_base . "\"" :  $Arq_base;
           if (is_file($Arq_zip)) {
               unlink($Arq_zip);
           }
           $str_zip = "";
           if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
           {
               chdir($this->Ini->path_third . "/zip/windows");
               $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $Html_password . " " . $Zip_f . " " . $Arq_input;
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
               $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $Arq_input;
           }
           elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
           {
               chdir($this->Ini->path_third . "/zip/mac/bin");
               $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $Arq_input;
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
           foreach ($this->Ini->Img_export_zip as $cada_img_zip)
           {
               $str_zip      = "";
              $cada_img_zip = '"' . $cada_img_zip . '"';
               if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
               {
                   $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $Html_password . " " . $Zip_f . " " . $cada_img_zip;
               }
               elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
               {
                   $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $cada_img_zip;
               }
               elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
               {
                   $str_zip = "./7za " . $Parm_pass . $Html_password . " a " . $Zip_f . " " . $cada_img_zip;
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
           }
           if (is_file($Arq_zip)) {
               unlink($Arq_base);
           } 
          $path_doc_md5 = md5($Arq_htm);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("BRSVP - Cadastro de Hotéis Edição") ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
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
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form ?>.css" /> 
  <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_prod; ?>/third/font-awesome/6/css/all.min.css" /> 
  <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
</HEAD>
<BODY class="scExportPage">
<table style="border-collapse: collapse; border-width: 0; height: 100%; width: 100%"><tr><td style="padding: 0; text-align: center; vertical-align: top">
 <table class="scExportTable" align="center">
  <tr>
   <td class="scExportTitle" style="height: 25px">PRINT</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
   <?php echo nmButtonOutput($this->arr_buttons, "bexportview", "document.Fview.submit()", "document.Fview.submit()", "idBtnView", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>

   <?php echo nmButtonOutput($this->arr_buttons, "bdownload", "document.Fdown.submit()", "document.Fdown.submit()", "idBtnDown", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>

   <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "idBtnBack", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>

    </td></tr></table>
   </td>
  </tr>
 </table>
</td></tr></table>
<form name="Fview" method="get" action="<?php echo  $this->form_encode_input($Arq_htm) ?>" target="_self" style="display: none"> 
</form>
<form name="Fdown" method="get" action="form_tbl_hoteis_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="form_tbl_hoteis"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<form name="F0" method=post action="./" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nmgp_opcao" value="<?php echo $this->nmgp_opcao ?>"> 
</form> 
         </BODY>
         </HTML>
<?php
          exit;
  }
//
//--------------------------------------------------------------------------------------
   function NM_has_trans()
   {
       return !in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access);
   }
//
//--------------------------------------------------------------------------------------
   function NM_commit_db()
   {
       if ($this->Ini->sc_tem_trans_banco && !$this->Embutida_proc)
       { 
           $this->Db->CommitTrans(); 
           $this->Ini->sc_tem_trans_banco = false;
       } 
   }
//
//--------------------------------------------------------------------------------------
   function NM_rollback_db()
   {
       if ($this->Ini->sc_tem_trans_banco && !$this->Embutida_proc)
       { 
           $this->Db->RollbackTrans(); 
           $this->Ini->sc_tem_trans_banco = false;
       } 
   }
//
//--------------------------------------------------------------------------------------
   function NM_close_db()
   {
       if ($this->Db && !$this->Embutida_proc)
       { 
           $this->Db->Close(); 
           $this->Db = false; 
           $this->Ini->nm_db_gate->Close(); 
           $this->Ini->nm_db_gate = false;
       } 
   }
//
//--------------------------------------------------------------------------------------
   function Formata_Erros($Campos_Crit, $Campos_Falta, $Campos_Erros, $mode = 3) 
   {
       switch ($mode)
       {
           case 1:
               $campos_erro = array();
               if (!empty($Campos_Crit))
               {
                   $campos_erro[] = $Campos_Crit;
               }
               if (!empty($Campos_Falta))
               {
                   $campos_erro[] = $this->Formata_Campos_Falta($Campos_Falta);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_erro[] = $this->Campos_Mens_erro;
               }
               return implode('<br />', $campos_erro);
               break;

           case 2:
               $campos_erro = array();
               if (!empty($Campos_Crit))
               {
                   $campos_erro[] = $Campos_Crit;
               }
               if (!empty($Campos_Falta))
               {
                   $campos_erro[] = $this->Formata_Campos_Falta($Campos_Falta, true);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_erro[] = $this->Campos_Mens_erro;
               }
               return implode('<br />', $campos_erro);
               break;

           case 3:
               $campos_erro = array();
               if (!empty($Campos_Erros))
               {
                   $campos_erro[] = $this->Formata_Campos_Erros($Campos_Erros);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_mens_erro = str_replace(array('<br />', '<br>', '<BR />'), array('<BR>', '<BR>', '<BR>'), $this->Campos_Mens_erro);
                   $campos_mens_erro = explode('<BR>', $campos_mens_erro);
                   foreach ($campos_mens_erro as $msg_erro)
                   {
                       if ('' != $msg_erro && !in_array($msg_erro, $campos_erro))
                       {
                           $campos_erro[] = $msg_erro;
                       }
                   }
               }
               return implode('<br />', $campos_erro);
               break;

           case 4:
               $campos_erro = array();
               if (!empty($Campos_Erros))
               {
                   $campos_erro[] = $this->Formata_Campos_Erros_SweetAlert($Campos_Erros);
               }
               if (!empty($this->Campos_Mens_erro))
               {
                   $campos_mens_erro = str_replace(array('<br />', '<br>', '<BR />'), array('<BR>', '<BR>', '<BR>'), $this->Campos_Mens_erro);
                   $campos_mens_erro = explode('<BR>', $campos_mens_erro);
                   foreach ($campos_mens_erro as $msg_erro)
                   {
                       if ('' != $msg_erro && !in_array($msg_erro, $campos_erro))
                       {
                           $campos_erro[] = $msg_erro;
                       }
                   }
               }
               return implode('<br />', $campos_erro);
               break;
       }
   }

   function Formata_Campos_Falta($Campos_Falta, $table = false) 
   {
       $Campos_Falta = array_unique($Campos_Falta);

       if (!$table)
       {
           return $this->Ini->Nm_lang['lang_errm_reqd'] . ' ' . implode('; ', $Campos_Falta);
       }

       $aCols  = array();
       $iTotal = sizeof($Campos_Falta);
       $iCols  = 6 > $iTotal ? 1 : (11 > $iTotal ? 2 : (16 > $iTotal ? 3 : 4));
       $iItems = ceil($iTotal / $iCols);
       $iNowC  = 0;
       $iNowI  = 0;

       foreach ($Campos_Falta as $campo)
       {
           $aCols[$iNowC][] = $campo;
           if ($iItems == ++$iNowI)
           {
               $iNowC++;
               $iNowI = 0;
           }
       }

       $sError  = '<table style="border-collapse: collapse; border-width: 0px">';
       $sError .= '<tr>';
       $sError .= '<td class="scFormErrorMessageFont" style="padding: 0; vertical-align: top; white-space: nowrap">' . $this->Ini->Nm_lang['lang_errm_reqd'] . '</td>';
       foreach ($aCols as $aCol)
       {
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0 6px; vertical-align: top; white-space: nowrap">' . implode('<br />', $aCol) . '</td>';
       }
       $sError .= '</tr>';
       $sError .= '</table>';

       return $sError;
   }

   function Formata_Campos_Crit($Campos_Crit, $table = false) 
   {
       $Campos_Crit = array_unique($Campos_Crit);

       if (!$table)
       {
           return $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . implode('; ', $Campos_Crit);
       }

       $aCols  = array();
       $iTotal = sizeof($Campos_Crit);
       $iCols  = 6 > $iTotal ? 1 : (11 > $iTotal ? 2 : (16 > $iTotal ? 3 : 4));
       $iItems = ceil($iTotal / $iCols);
       $iNowC  = 0;
       $iNowI  = 0;

       foreach ($Campos_Crit as $campo)
       {
           $aCols[$iNowC][] = $campo;
           if ($iItems == ++$iNowI)
           {
               $iNowC++;
               $iNowI = 0;
           }
       }

       $sError  = '<table style="border-collapse: collapse; border-width: 0px">';
       $sError .= '<tr>';
       $sError .= '<td class="scFormErrorMessageFont" style="padding: 0; vertical-align: top; white-space: nowrap">' . $this->Ini->Nm_lang['lang_errm_flds'] . '</td>';
       foreach ($aCols as $aCol)
       {
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0 6px; vertical-align: top; white-space: nowrap">' . implode('<br />', $aCol) . '</td>';
       }
       $sError .= '</tr>';
       $sError .= '</table>';

       return $sError;
   }

   function Formata_Campos_Erros($Campos_Erros) 
   {
       $sError  = '<table style="border-collapse: collapse; border-width: 0px">';

       foreach ($Campos_Erros as $campo => $erros)
       {
           $sError .= '<tr>';
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0; vertical-align: top; white-space: nowrap">' . $this->Recupera_Nome_Campo($campo) . ':</td>';
           $sError .= '<td class="scFormErrorMessageFont" style="padding: 0 6px; vertical-align: top; white-space: nowrap">' . implode('<br />', array_unique($erros)) . '</td>';
           $sError .= '</tr>';
       }

       $sError .= '</table>';

       return $sError;
   }

   function Formata_Campos_Erros_SweetAlert($Campos_Erros) 
   {
       $sError  = '';

       foreach ($Campos_Erros as $campo => $erros)
       {
           $sError .= $this->Recupera_Nome_Campo($campo) . ': ' . implode('<br />', array_unique($erros)) . '<br />';
       }

       return $sError;
   }

   function Recupera_Nome_Campo($campo) 
   {
       switch($campo)
       {
           case 'hotel_id':
               return "Hotel Id:";
               break;
           case 'hotel_cnpj':
               return "CNPJ:";
               break;
           case 'hotel_fantasia':
               return "Fantasia";
               break;
           case 'hotel_razsoc':
               return "Razão Social:";
               break;
           case 'hotel_descricao':
               return "Descrição:";
               break;
           case 'hotel_rede':
               return "Rede:";
               break;
           case 'hotel_classificacao':
               return "Classificação (tipo):";
               break;
           case 'hotel_categoria':
               return "Categoria:";
               break;
           case 'hotel_logo':
               return "Logo:";
               break;
           case 'hotel_cep':
               return "CEP:";
               break;
           case 'hotel_pais':
               return "País:";
               break;
           case 'hotel_uf':
               return "UF:";
               break;
           case 'hotel_municipio':
               return "Município:";
               break;
           case 'hotel_bairro':
               return "Bairro:";
               break;
           case 'hotel_logradouro':
               return "Logradouro:";
               break;
           case 'hotel_numero':
               return "Número:";
               break;
           case 'hotel_complemento':
               return "Complemento:";
               break;
           case 'localizacao':
               return "Google Maps:";
               break;
           case 'hotel_observacoes':
               return "Observações:";
               break;
           case 'hotel_email':
               return "Email:";
               break;
           case 'hotel_website':
               return "Website:";
               break;
           case 'hotel_telefone':
               return "Telefone";
               break;
           case 'hotel_fax':
               return "Fax:";
               break;
           case 'hotel_celular':
               return "Celular:";
               break;
           case 'hotel_status':
               return "Status:";
               break;
           case 'hotel_facebook':
               return "Hotel Facebook:";
               break;
           case 'hotel_twitter':
               return "Hotel Twitter:";
               break;
           case 'hotel_skype':
               return "Hotel Skype:";
               break;
           case 'hotel_ar_condicionado':
               return "Ar Condicionado:";
               break;
           case 'hotel_frigobar':
               return "Frigobar:";
               break;
           case 'hotel_lavanderia':
               return "Lavanderia:";
               break;
           case 'hotel_telefone_quarto':
               return "Telefone Quarto:";
               break;
           case 'hotel_tv':
               return "TV:";
               break;
           case 'hotel_ginastica':
               return "Sala Ginática:";
               break;
           case 'hotel_restaurante':
               return "Restaurante:";
               break;
           case 'hotel_bar':
               return "Bar:";
               break;
           case 'hotel_estacionamento':
               return "Estacionamento:";
               break;
           case 'hotel_sauna':
               return "Sauna:";
               break;
           case 'hotel_piscina':
               return "Piscina:";
               break;
           case 'hotel_wifi':
               return "Wifi:";
               break;
           case 'hotel_computador':
               return "Computadores:";
               break;
           case 'hotel_convencoes':
               return "Sala Convenções:";
               break;
           case 'hotel_cod_estrangeiro':
               return "Cód. Estrangeiro:";
               break;
           case 'rodape':
               return "rodape";
               break;
       }

       return $campo;
   }

   function dateDefaultFormat()
   {
       if (isset($this->Ini->Nm_conf_reg[$this->Ini->str_conf_reg]['data_format']))
       {
           $sDate = str_replace('yyyy', 'Y', $this->Ini->Nm_conf_reg[$this->Ini->str_conf_reg]['data_format']);
           $sDate = str_replace('mm',   'm', $sDate);
           $sDate = str_replace('dd',   'd', $sDate);
           return substr(chunk_split($sDate, 1, $this->Ini->Nm_conf_reg[$this->Ini->str_conf_reg]['data_sep']), 0, -1);
       }
       elseif ('en_us' == $this->Ini->str_lang)
       {
           return 'm/d/Y';
       }
       else
       {
           return 'd/m/Y';
       }
   } // dateDefaultFormat

//
//--------------------------------------------------------------------------------------
   function Valida_campos(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros, $filtro = '') 
   {
     global $nm_browser, $teste_validade;
     if (is_array($filtro) && empty($filtro)) {
         $filtro = '';
     }
//---------------------------------------------------------
     $this->sc_force_zero = array();

     if (!is_array($filtro) && '' == $filtro && isset($this->nm_form_submit) && '1' == $this->nm_form_submit && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['csrf_token']) && $this->scCsrfGetToken() != $this->csrf_token)
     {
          $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
          $this->Campos_Mens_erro .= "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          if ($this->NM_ajax_flag)
          {
              if (!isset($this->NM_ajax_info['errList']['geral_form_tbl_hoteis']) || !is_array($this->NM_ajax_info['errList']['geral_form_tbl_hoteis']))
              {
                  $this->NM_ajax_info['errList']['geral_form_tbl_hoteis'] = array();
              }
              $this->NM_ajax_info['errList']['geral_form_tbl_hoteis'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_id' == $filtro)) || (is_array($filtro) && in_array('hotel_id', $filtro)))
        $this->ValidateField_hotel_id($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_cnpj' == $filtro)) || (is_array($filtro) && in_array('hotel_cnpj', $filtro)))
        $this->ValidateField_hotel_cnpj($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_fantasia' == $filtro)) || (is_array($filtro) && in_array('hotel_fantasia', $filtro)))
        $this->ValidateField_hotel_fantasia($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_razsoc' == $filtro)) || (is_array($filtro) && in_array('hotel_razsoc', $filtro)))
        $this->ValidateField_hotel_razsoc($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_descricao' == $filtro)) || (is_array($filtro) && in_array('hotel_descricao', $filtro)))
        $this->ValidateField_hotel_descricao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_rede' == $filtro)) || (is_array($filtro) && in_array('hotel_rede', $filtro)))
        $this->ValidateField_hotel_rede($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_classificacao' == $filtro)) || (is_array($filtro) && in_array('hotel_classificacao', $filtro)))
        $this->ValidateField_hotel_classificacao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_categoria' == $filtro)) || (is_array($filtro) && in_array('hotel_categoria', $filtro)))
        $this->ValidateField_hotel_categoria($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_logo' == $filtro)) || (is_array($filtro) && in_array('hotel_logo', $filtro)))
        $this->ValidateField_hotel_logo($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_cep' == $filtro)) || (is_array($filtro) && in_array('hotel_cep', $filtro)))
        $this->ValidateField_hotel_cep($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_pais' == $filtro)) || (is_array($filtro) && in_array('hotel_pais', $filtro)))
        $this->ValidateField_hotel_pais($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_uf' == $filtro)) || (is_array($filtro) && in_array('hotel_uf', $filtro)))
        $this->ValidateField_hotel_uf($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_municipio' == $filtro)) || (is_array($filtro) && in_array('hotel_municipio', $filtro)))
        $this->ValidateField_hotel_municipio($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_bairro' == $filtro)) || (is_array($filtro) && in_array('hotel_bairro', $filtro)))
        $this->ValidateField_hotel_bairro($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_logradouro' == $filtro)) || (is_array($filtro) && in_array('hotel_logradouro', $filtro)))
        $this->ValidateField_hotel_logradouro($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_numero' == $filtro)) || (is_array($filtro) && in_array('hotel_numero', $filtro)))
        $this->ValidateField_hotel_numero($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_complemento' == $filtro)) || (is_array($filtro) && in_array('hotel_complemento', $filtro)))
        $this->ValidateField_hotel_complemento($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'localizacao' == $filtro)) || (is_array($filtro) && in_array('localizacao', $filtro)))
        $this->ValidateField_localizacao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_observacoes' == $filtro)) || (is_array($filtro) && in_array('hotel_observacoes', $filtro)))
        $this->ValidateField_hotel_observacoes($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_email' == $filtro)) || (is_array($filtro) && in_array('hotel_email', $filtro)))
        $this->ValidateField_hotel_email($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_website' == $filtro)) || (is_array($filtro) && in_array('hotel_website', $filtro)))
        $this->ValidateField_hotel_website($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_telefone' == $filtro)) || (is_array($filtro) && in_array('hotel_telefone', $filtro)))
        $this->ValidateField_hotel_telefone($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_fax' == $filtro)) || (is_array($filtro) && in_array('hotel_fax', $filtro)))
        $this->ValidateField_hotel_fax($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_celular' == $filtro)) || (is_array($filtro) && in_array('hotel_celular', $filtro)))
        $this->ValidateField_hotel_celular($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_status' == $filtro)) || (is_array($filtro) && in_array('hotel_status', $filtro)))
        $this->ValidateField_hotel_status($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_facebook' == $filtro)) || (is_array($filtro) && in_array('hotel_facebook', $filtro)))
        $this->ValidateField_hotel_facebook($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_twitter' == $filtro)) || (is_array($filtro) && in_array('hotel_twitter', $filtro)))
        $this->ValidateField_hotel_twitter($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_skype' == $filtro)) || (is_array($filtro) && in_array('hotel_skype', $filtro)))
        $this->ValidateField_hotel_skype($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_ar_condicionado' == $filtro)) || (is_array($filtro) && in_array('hotel_ar_condicionado', $filtro)))
        $this->ValidateField_hotel_ar_condicionado($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_frigobar' == $filtro)) || (is_array($filtro) && in_array('hotel_frigobar', $filtro)))
        $this->ValidateField_hotel_frigobar($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_lavanderia' == $filtro)) || (is_array($filtro) && in_array('hotel_lavanderia', $filtro)))
        $this->ValidateField_hotel_lavanderia($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_telefone_quarto' == $filtro)) || (is_array($filtro) && in_array('hotel_telefone_quarto', $filtro)))
        $this->ValidateField_hotel_telefone_quarto($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_tv' == $filtro)) || (is_array($filtro) && in_array('hotel_tv', $filtro)))
        $this->ValidateField_hotel_tv($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_ginastica' == $filtro)) || (is_array($filtro) && in_array('hotel_ginastica', $filtro)))
        $this->ValidateField_hotel_ginastica($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_restaurante' == $filtro)) || (is_array($filtro) && in_array('hotel_restaurante', $filtro)))
        $this->ValidateField_hotel_restaurante($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_bar' == $filtro)) || (is_array($filtro) && in_array('hotel_bar', $filtro)))
        $this->ValidateField_hotel_bar($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_estacionamento' == $filtro)) || (is_array($filtro) && in_array('hotel_estacionamento', $filtro)))
        $this->ValidateField_hotel_estacionamento($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_sauna' == $filtro)) || (is_array($filtro) && in_array('hotel_sauna', $filtro)))
        $this->ValidateField_hotel_sauna($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_piscina' == $filtro)) || (is_array($filtro) && in_array('hotel_piscina', $filtro)))
        $this->ValidateField_hotel_piscina($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_wifi' == $filtro)) || (is_array($filtro) && in_array('hotel_wifi', $filtro)))
        $this->ValidateField_hotel_wifi($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_computador' == $filtro)) || (is_array($filtro) && in_array('hotel_computador', $filtro)))
        $this->ValidateField_hotel_computador($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_convencoes' == $filtro)) || (is_array($filtro) && in_array('hotel_convencoes', $filtro)))
        $this->ValidateField_hotel_convencoes($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hotel_cod_estrangeiro' == $filtro)) || (is_array($filtro) && in_array('hotel_cod_estrangeiro', $filtro)))
        $this->ValidateField_hotel_cod_estrangeiro($Campos_Crit, $Campos_Falta, $Campos_Erros);
      $this->upload_img_doc($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if (!empty($Campos_Crit) || !empty($Campos_Falta) || !empty($this->Campos_Mens_erro))
      {
          if (!empty($this->sc_force_zero))
          {
              foreach ($this->sc_force_zero as $i_force_zero => $sc_force_zero_field)
              {
                  eval('$this->' . $sc_force_zero_field . ' = "";');
                  unset($this->sc_force_zero[$i_force_zero]);
              }
          }
      }
   }

    function ValidateField_hotel_id(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hotel_id'])) {
          nm_limpa_numero($this->hotel_id, $this->field_config['hotel_id']['symbol_grp']) ; 
          return;
      }
      if ($this->hotel_id === "" || is_null($this->hotel_id))  
      { 
          $this->hotel_id = 0;
      } 
      nm_limpa_numero($this->hotel_id, $this->field_config['hotel_id']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_hotel_id' == $this->NM_ajax_opcao)
      { 
          if ($this->hotel_id != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->hotel_id) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Hotel Id:: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['hotel_id']))
                  {
                      $Campos_Erros['hotel_id'] = array();
                  }
                  $Campos_Erros['hotel_id'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['hotel_id']) || !is_array($this->NM_ajax_info['errList']['hotel_id']))
                  {
                      $this->NM_ajax_info['errList']['hotel_id'] = array();
                  }
                  $this->NM_ajax_info['errList']['hotel_id'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->hotel_id, 11, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Hotel Id:; " ; 
                  if (!isset($Campos_Erros['hotel_id']))
                  {
                      $Campos_Erros['hotel_id'] = array();
                  }
                  $Campos_Erros['hotel_id'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['hotel_id']) || !is_array($this->NM_ajax_info['errList']['hotel_id']))
                  {
                      $this->NM_ajax_info['errList']['hotel_id'] = array();
                  }
                  $this->NM_ajax_info['errList']['hotel_id'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_id';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_id

    function ValidateField_hotel_cnpj(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hotel_cnpj'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->hotel_cnpj) > 14) 
          { 
              $hasError = true;
              $Campos_Crit .= "CNPJ: " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 14 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['hotel_cnpj']))
              {
                  $Campos_Erros['hotel_cnpj'] = array();
              }
              $Campos_Erros['hotel_cnpj'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 14 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['hotel_cnpj']) || !is_array($this->NM_ajax_info['errList']['hotel_cnpj']))
              {
                  $this->NM_ajax_info['errList']['hotel_cnpj'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_cnpj'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 14 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_cnpj';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_cnpj

    function ValidateField_hotel_fantasia(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hotel_fantasia'])) {
          return;
      }
      $this->hotel_fantasia = sc_strtoupper($this->hotel_fantasia); 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->hotel_fantasia) > 50) 
          { 
              $hasError = true;
              $Campos_Crit .= "Fantasia " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['hotel_fantasia']))
              {
                  $Campos_Erros['hotel_fantasia'] = array();
              }
              $Campos_Erros['hotel_fantasia'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['hotel_fantasia']) || !is_array($this->NM_ajax_info['errList']['hotel_fantasia']))
              {
                  $this->NM_ajax_info['errList']['hotel_fantasia'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_fantasia'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_fantasia';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_fantasia

    function ValidateField_hotel_razsoc(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hotel_razsoc'])) {
          return;
      }
      $this->hotel_razsoc = sc_strtoupper($this->hotel_razsoc); 
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['php_cmp_required']['hotel_razsoc']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['php_cmp_required']['hotel_razsoc'] == "on")) 
      { 
          if ($this->hotel_razsoc == "")  
          { 
              $hasError = true;
              $Campos_Falta[] =  "Razão Social:" ; 
              if (!isset($Campos_Erros['hotel_razsoc']))
              {
                  $Campos_Erros['hotel_razsoc'] = array();
              }
              $Campos_Erros['hotel_razsoc'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['hotel_razsoc']) || !is_array($this->NM_ajax_info['errList']['hotel_razsoc']))
                  {
                      $this->NM_ajax_info['errList']['hotel_razsoc'] = array();
                  }
                  $this->NM_ajax_info['errList']['hotel_razsoc'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->hotel_razsoc) > 50) 
          { 
              $hasError = true;
              $Campos_Crit .= "Razão Social: " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['hotel_razsoc']))
              {
                  $Campos_Erros['hotel_razsoc'] = array();
              }
              $Campos_Erros['hotel_razsoc'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['hotel_razsoc']) || !is_array($this->NM_ajax_info['errList']['hotel_razsoc']))
              {
                  $this->NM_ajax_info['errList']['hotel_razsoc'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_razsoc'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_razsoc';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_razsoc

    function ValidateField_hotel_descricao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hotel_descricao'])) {
          return;
      }
      $this->hotel_descricao = sc_strtoupper($this->hotel_descricao); 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->hotel_descricao) > 100) 
          { 
              $hasError = true;
              $Campos_Crit .= "Descrição: " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['hotel_descricao']))
              {
                  $Campos_Erros['hotel_descricao'] = array();
              }
              $Campos_Erros['hotel_descricao'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['hotel_descricao']) || !is_array($this->NM_ajax_info['errList']['hotel_descricao']))
              {
                  $this->NM_ajax_info['errList']['hotel_descricao'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_descricao'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_descricao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_descricao

    function ValidateField_hotel_rede(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['hotel_rede'])) {
       return;
   }
      if ($this->hotel_rede == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['php_cmp_required']['hotel_rede']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['php_cmp_required']['hotel_rede'] == "on"))
      {
          $hasError = true;
          $Campos_Falta[] = "Rede:" ; 
          if (!isset($Campos_Erros['hotel_rede']))
          {
              $Campos_Erros['hotel_rede'] = array();
          }
          $Campos_Erros['hotel_rede'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['hotel_rede']) || !is_array($this->NM_ajax_info['errList']['hotel_rede']))
          {
              $this->NM_ajax_info['errList']['hotel_rede'] = array();
          }
          $this->NM_ajax_info['errList']['hotel_rede'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->hotel_rede) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede']) && !in_array($this->hotel_rede, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['hotel_rede']))
              {
                  $Campos_Erros['hotel_rede'] = array();
              }
              $Campos_Erros['hotel_rede'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['hotel_rede']) || !is_array($this->NM_ajax_info['errList']['hotel_rede']))
              {
                  $this->NM_ajax_info['errList']['hotel_rede'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_rede'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_rede';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_rede

    function ValidateField_hotel_classificacao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['hotel_classificacao'])) {
       return;
   }
      if ($this->hotel_classificacao == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['php_cmp_required']['hotel_classificacao']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['php_cmp_required']['hotel_classificacao'] == "on"))
      {
          $hasError = true;
          $Campos_Falta[] = "Classificação (tipo):" ; 
          if (!isset($Campos_Erros['hotel_classificacao']))
          {
              $Campos_Erros['hotel_classificacao'] = array();
          }
          $Campos_Erros['hotel_classificacao'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['hotel_classificacao']) || !is_array($this->NM_ajax_info['errList']['hotel_classificacao']))
          {
              $this->NM_ajax_info['errList']['hotel_classificacao'] = array();
          }
          $this->NM_ajax_info['errList']['hotel_classificacao'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->hotel_classificacao) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao']) && !in_array($this->hotel_classificacao, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['hotel_classificacao']))
              {
                  $Campos_Erros['hotel_classificacao'] = array();
              }
              $Campos_Erros['hotel_classificacao'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['hotel_classificacao']) || !is_array($this->NM_ajax_info['errList']['hotel_classificacao']))
              {
                  $this->NM_ajax_info['errList']['hotel_classificacao'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_classificacao'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_classificacao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_classificacao

    function ValidateField_hotel_categoria(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['hotel_categoria'])) {
       return;
   }
               if (!empty($this->hotel_categoria) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria']) && !in_array($this->hotel_categoria, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['hotel_categoria']))
                   {
                       $Campos_Erros['hotel_categoria'] = array();
                   }
                   $Campos_Erros['hotel_categoria'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['hotel_categoria']) || !is_array($this->NM_ajax_info['errList']['hotel_categoria']))
                   {
                       $this->NM_ajax_info['errList']['hotel_categoria'] = array();
                   }
                   $this->NM_ajax_info['errList']['hotel_categoria'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_categoria';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_categoria

    function ValidateField_hotel_logo(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hotel_logo'])) {
          return;
      }
        if ($this->nmgp_opcao != "excluir")
        {
            $sTestFile = $this->hotel_logo;
            if (strpos($this->hotel_logo, "*") != false) {
                $hasError = true;
                $Campos_Crit .= "Logo:: " . $this->Ini->Nm_lang['lang_errm_ivch']; 
                if (!isset($Campos_Erros['hotel_logo']))
                {
                    $Campos_Erros['hotel_logo'] = array();
                }
                $Campos_Erros['hotel_logo'][] = $this->Ini->Nm_lang['lang_errm_ivch'];
                if (!isset($this->NM_ajax_info['errList']['hotel_logo']) || !is_array($this->NM_ajax_info['errList']['hotel_logo']))
                {
                    $this->NM_ajax_info['errList']['hotel_logo'] = array();
                }
                $this->NM_ajax_info['errList']['hotel_logo'][] = $this->Ini->Nm_lang['lang_errm_ivch'];
            }
            if ("" != $this->hotel_logo && "S" != $this->hotel_logo_limpa && !$teste_validade->ArqExtensao($this->hotel_logo, array()))
            {
                $hasError = true;
                $Campos_Crit .= "Logo:: " . $this->Ini->Nm_lang['lang_errm_file_invl']; 
                if (!isset($Campos_Erros['hotel_logo']))
                {
                    $Campos_Erros['hotel_logo'] = array();
                }
                $Campos_Erros['hotel_logo'][] = $this->Ini->Nm_lang['lang_errm_file_invl'];
                if (!isset($this->NM_ajax_info['errList']['hotel_logo']) || !is_array($this->NM_ajax_info['errList']['hotel_logo']))
                {
                    $this->NM_ajax_info['errList']['hotel_logo'] = array();
                }
                $this->NM_ajax_info['errList']['hotel_logo'][] = $this->Ini->Nm_lang['lang_errm_file_invl'];
            }
        }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_logo';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_logo

    function ValidateField_hotel_cep(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_cep($this->hotel_cep) ; 
      if (isset($this->Field_no_validate['hotel_cep'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->hotel_cep) != "")  
          { 
              if (strlen($this->hotel_cep) != 8  || (int)$this->hotel_cep == 0)
              { 
                  $hasError = true;
                  $Campos_Crit .= "CEP:; " ; 
                  if (!isset($Campos_Erros['hotel_cep']))
                  {
                      $Campos_Erros['hotel_cep'] = array();
                  }
                  $Campos_Erros['hotel_cep'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['hotel_cep']) || !is_array($this->NM_ajax_info['errList']['hotel_cep']))
                  {
                      $this->NM_ajax_info['errList']['hotel_cep'] = array();
                  }
                  $this->NM_ajax_info['errList']['hotel_cep'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_cep';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_cep

    function ValidateField_hotel_pais(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['hotel_pais'])) {
       return;
   }
               if (!empty($this->hotel_pais) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais']) && !in_array($this->hotel_pais, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['hotel_pais']))
                   {
                       $Campos_Erros['hotel_pais'] = array();
                   }
                   $Campos_Erros['hotel_pais'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['hotel_pais']) || !is_array($this->NM_ajax_info['errList']['hotel_pais']))
                   {
                       $this->NM_ajax_info['errList']['hotel_pais'] = array();
                   }
                   $this->NM_ajax_info['errList']['hotel_pais'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_pais';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_pais

    function ValidateField_hotel_uf(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hotel_uf'])) {
          return;
      }
      $this->hotel_uf = sc_strtoupper($this->hotel_uf); 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->hotel_uf) > 11) 
          { 
              $hasError = true;
              $Campos_Crit .= "UF: " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 11 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['hotel_uf']))
              {
                  $Campos_Erros['hotel_uf'] = array();
              }
              $Campos_Erros['hotel_uf'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 11 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['hotel_uf']) || !is_array($this->NM_ajax_info['errList']['hotel_uf']))
              {
                  $this->NM_ajax_info['errList']['hotel_uf'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_uf'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 11 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_uf';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_uf

    function ValidateField_hotel_municipio(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hotel_municipio'])) {
          return;
      }
      $this->hotel_municipio = sc_strtoupper($this->hotel_municipio); 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->hotel_municipio) > 50) 
          { 
              $hasError = true;
              $Campos_Crit .= "Município: " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['hotel_municipio']))
              {
                  $Campos_Erros['hotel_municipio'] = array();
              }
              $Campos_Erros['hotel_municipio'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['hotel_municipio']) || !is_array($this->NM_ajax_info['errList']['hotel_municipio']))
              {
                  $this->NM_ajax_info['errList']['hotel_municipio'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_municipio'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_municipio';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_municipio

    function ValidateField_hotel_bairro(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hotel_bairro'])) {
          return;
      }
      $this->hotel_bairro = sc_strtoupper($this->hotel_bairro); 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->hotel_bairro) > 50) 
          { 
              $hasError = true;
              $Campos_Crit .= "Bairro: " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['hotel_bairro']))
              {
                  $Campos_Erros['hotel_bairro'] = array();
              }
              $Campos_Erros['hotel_bairro'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['hotel_bairro']) || !is_array($this->NM_ajax_info['errList']['hotel_bairro']))
              {
                  $this->NM_ajax_info['errList']['hotel_bairro'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_bairro'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_bairro';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_bairro

    function ValidateField_hotel_logradouro(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hotel_logradouro'])) {
          return;
      }
      $this->hotel_logradouro = sc_strtoupper($this->hotel_logradouro); 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->hotel_logradouro) > 60) 
          { 
              $hasError = true;
              $Campos_Crit .= "Logradouro: " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['hotel_logradouro']))
              {
                  $Campos_Erros['hotel_logradouro'] = array();
              }
              $Campos_Erros['hotel_logradouro'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['hotel_logradouro']) || !is_array($this->NM_ajax_info['errList']['hotel_logradouro']))
              {
                  $this->NM_ajax_info['errList']['hotel_logradouro'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_logradouro'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_logradouro';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_logradouro

    function ValidateField_hotel_numero(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hotel_numero'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->hotel_numero) > 10) 
          { 
              $hasError = true;
              $Campos_Crit .= "Número: " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 10 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['hotel_numero']))
              {
                  $Campos_Erros['hotel_numero'] = array();
              }
              $Campos_Erros['hotel_numero'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 10 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['hotel_numero']) || !is_array($this->NM_ajax_info['errList']['hotel_numero']))
              {
                  $this->NM_ajax_info['errList']['hotel_numero'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_numero'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 10 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_numero';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_numero

    function ValidateField_hotel_complemento(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hotel_complemento'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->hotel_complemento) > 20) 
          { 
              $hasError = true;
              $Campos_Crit .= "Complemento: " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['hotel_complemento']))
              {
                  $Campos_Erros['hotel_complemento'] = array();
              }
              $Campos_Erros['hotel_complemento'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['hotel_complemento']) || !is_array($this->NM_ajax_info['errList']['hotel_complemento']))
              {
                  $this->NM_ajax_info['errList']['hotel_complemento'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_complemento'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_complemento';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_complemento

    function ValidateField_localizacao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['localizacao'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->localizacao) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'localizacao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_localizacao

    function ValidateField_hotel_observacoes(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hotel_observacoes'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->hotel_observacoes) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "Observações: " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['hotel_observacoes']))
              {
                  $Campos_Erros['hotel_observacoes'] = array();
              }
              $Campos_Erros['hotel_observacoes'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['hotel_observacoes']) || !is_array($this->NM_ajax_info['errList']['hotel_observacoes']))
              {
                  $this->NM_ajax_info['errList']['hotel_observacoes'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_observacoes'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_observacoes';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_observacoes

    function ValidateField_hotel_email(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hotel_email'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->hotel_email) != "")  
          { 
              if ($teste_validade->Email($this->hotel_email) == false)  
              { 
                  $hasError = true;
                      $Campos_Crit .= "Email:; " ; 
                  if (!isset($Campos_Erros['hotel_email']))
                  {
                      $Campos_Erros['hotel_email'] = array();
                  }
                  $Campos_Erros['hotel_email'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                      if (!isset($this->NM_ajax_info['errList']['hotel_email']) || !is_array($this->NM_ajax_info['errList']['hotel_email']))
                      {
                          $this->NM_ajax_info['errList']['hotel_email'] = array();
                      }
                      $this->NM_ajax_info['errList']['hotel_email'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_email';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_email

    function ValidateField_hotel_website(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hotel_website'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->hotel_website) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_website';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_website

    function ValidateField_hotel_telefone(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hotel_telefone'])) {
          return;
      }
      $this->nm_tira_mask($this->hotel_telefone, "(99) 9999-9999", "(){}[].,;:-+/ "); 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->hotel_telefone) > 25) 
          { 
              $hasError = true;
              $Campos_Crit .= "Telefone " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 25 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['hotel_telefone']))
              {
                  $Campos_Erros['hotel_telefone'] = array();
              }
              $Campos_Erros['hotel_telefone'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 25 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['hotel_telefone']) || !is_array($this->NM_ajax_info['errList']['hotel_telefone']))
              {
                  $this->NM_ajax_info['errList']['hotel_telefone'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_telefone'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 25 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_telefone';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_telefone

    function ValidateField_hotel_fax(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hotel_fax'])) {
          return;
      }
      $this->nm_tira_mask($this->hotel_fax, "(99) 9999-9999", "(){}[].,;:-+/ "); 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->hotel_fax) > 25) 
          { 
              $hasError = true;
              $Campos_Crit .= "Fax: " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 25 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['hotel_fax']))
              {
                  $Campos_Erros['hotel_fax'] = array();
              }
              $Campos_Erros['hotel_fax'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 25 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['hotel_fax']) || !is_array($this->NM_ajax_info['errList']['hotel_fax']))
              {
                  $this->NM_ajax_info['errList']['hotel_fax'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_fax'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 25 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_fax';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_fax

    function ValidateField_hotel_celular(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hotel_celular'])) {
          return;
      }
      $this->nm_tira_mask($this->hotel_celular, "(99) 99999-9999", "(){}[].,;:-+/ "); 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->hotel_celular) > 25) 
          { 
              $hasError = true;
              $Campos_Crit .= "Celular: " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 25 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['hotel_celular']))
              {
                  $Campos_Erros['hotel_celular'] = array();
              }
              $Campos_Erros['hotel_celular'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 25 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['hotel_celular']) || !is_array($this->NM_ajax_info['errList']['hotel_celular']))
              {
                  $this->NM_ajax_info['errList']['hotel_celular'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_celular'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 25 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_celular';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_celular

    function ValidateField_hotel_status(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['hotel_status'])) {
       return;
   }
      if ($this->hotel_status == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->hotel_status != "" && !in_array("hotel_status", $this->sc_force_zero))
      { 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_status']) && !in_array($this->hotel_status, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_status']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['hotel_status']))
              {
                  $Campos_Erros['hotel_status'] = array();
              }
              $Campos_Erros['hotel_status'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['hotel_status']) || !is_array($this->NM_ajax_info['errList']['hotel_status']))
              {
                  $this->NM_ajax_info['errList']['hotel_status'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_status'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_status';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_status

    function ValidateField_hotel_facebook(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hotel_facebook'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->hotel_facebook) > 50) 
          { 
              $hasError = true;
              $Campos_Crit .= "Hotel Facebook: " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['hotel_facebook']))
              {
                  $Campos_Erros['hotel_facebook'] = array();
              }
              $Campos_Erros['hotel_facebook'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['hotel_facebook']) || !is_array($this->NM_ajax_info['errList']['hotel_facebook']))
              {
                  $this->NM_ajax_info['errList']['hotel_facebook'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_facebook'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_facebook';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_facebook

    function ValidateField_hotel_twitter(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hotel_twitter'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->hotel_twitter) > 50) 
          { 
              $hasError = true;
              $Campos_Crit .= "Hotel Twitter: " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['hotel_twitter']))
              {
                  $Campos_Erros['hotel_twitter'] = array();
              }
              $Campos_Erros['hotel_twitter'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['hotel_twitter']) || !is_array($this->NM_ajax_info['errList']['hotel_twitter']))
              {
                  $this->NM_ajax_info['errList']['hotel_twitter'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_twitter'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_twitter';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_twitter

    function ValidateField_hotel_skype(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hotel_skype'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->hotel_skype) > 50) 
          { 
              $hasError = true;
              $Campos_Crit .= "Hotel Skype: " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['hotel_skype']))
              {
                  $Campos_Erros['hotel_skype'] = array();
              }
              $Campos_Erros['hotel_skype'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['hotel_skype']) || !is_array($this->NM_ajax_info['errList']['hotel_skype']))
              {
                  $this->NM_ajax_info['errList']['hotel_skype'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_skype'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 50 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_skype';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_skype

    function ValidateField_hotel_ar_condicionado(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['hotel_ar_condicionado'])) {
       return;
   }
      if ($this->hotel_ar_condicionado == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->hotel_ar_condicionado != "" && !in_array("hotel_ar_condicionado", $this->sc_force_zero))
      { 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_ar_condicionado']) && !in_array($this->hotel_ar_condicionado, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_ar_condicionado']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['hotel_ar_condicionado']))
              {
                  $Campos_Erros['hotel_ar_condicionado'] = array();
              }
              $Campos_Erros['hotel_ar_condicionado'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['hotel_ar_condicionado']) || !is_array($this->NM_ajax_info['errList']['hotel_ar_condicionado']))
              {
                  $this->NM_ajax_info['errList']['hotel_ar_condicionado'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_ar_condicionado'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_ar_condicionado';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_ar_condicionado

    function ValidateField_hotel_frigobar(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['hotel_frigobar'])) {
       return;
   }
      if ($this->hotel_frigobar == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->hotel_frigobar != "" && !in_array("hotel_frigobar", $this->sc_force_zero))
      { 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_frigobar']) && !in_array($this->hotel_frigobar, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_frigobar']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['hotel_frigobar']))
              {
                  $Campos_Erros['hotel_frigobar'] = array();
              }
              $Campos_Erros['hotel_frigobar'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['hotel_frigobar']) || !is_array($this->NM_ajax_info['errList']['hotel_frigobar']))
              {
                  $this->NM_ajax_info['errList']['hotel_frigobar'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_frigobar'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_frigobar';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_frigobar

    function ValidateField_hotel_lavanderia(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['hotel_lavanderia'])) {
       return;
   }
      if ($this->hotel_lavanderia == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->hotel_lavanderia != "" && !in_array("hotel_lavanderia", $this->sc_force_zero))
      { 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_lavanderia']) && !in_array($this->hotel_lavanderia, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_lavanderia']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['hotel_lavanderia']))
              {
                  $Campos_Erros['hotel_lavanderia'] = array();
              }
              $Campos_Erros['hotel_lavanderia'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['hotel_lavanderia']) || !is_array($this->NM_ajax_info['errList']['hotel_lavanderia']))
              {
                  $this->NM_ajax_info['errList']['hotel_lavanderia'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_lavanderia'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_lavanderia';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_lavanderia

    function ValidateField_hotel_telefone_quarto(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['hotel_telefone_quarto'])) {
       return;
   }
      if ($this->hotel_telefone_quarto == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->hotel_telefone_quarto != "" && !in_array("hotel_telefone_quarto", $this->sc_force_zero))
      { 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_telefone_quarto']) && !in_array($this->hotel_telefone_quarto, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_telefone_quarto']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['hotel_telefone_quarto']))
              {
                  $Campos_Erros['hotel_telefone_quarto'] = array();
              }
              $Campos_Erros['hotel_telefone_quarto'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['hotel_telefone_quarto']) || !is_array($this->NM_ajax_info['errList']['hotel_telefone_quarto']))
              {
                  $this->NM_ajax_info['errList']['hotel_telefone_quarto'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_telefone_quarto'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_telefone_quarto';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_telefone_quarto

    function ValidateField_hotel_tv(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['hotel_tv'])) {
       return;
   }
      if ($this->hotel_tv == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->hotel_tv != "" && !in_array("hotel_tv", $this->sc_force_zero))
      { 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_tv']) && !in_array($this->hotel_tv, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_tv']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['hotel_tv']))
              {
                  $Campos_Erros['hotel_tv'] = array();
              }
              $Campos_Erros['hotel_tv'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['hotel_tv']) || !is_array($this->NM_ajax_info['errList']['hotel_tv']))
              {
                  $this->NM_ajax_info['errList']['hotel_tv'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_tv'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_tv';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_tv

    function ValidateField_hotel_ginastica(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['hotel_ginastica'])) {
       return;
   }
      if ($this->hotel_ginastica == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->hotel_ginastica != "" && !in_array("hotel_ginastica", $this->sc_force_zero))
      { 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_ginastica']) && !in_array($this->hotel_ginastica, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_ginastica']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['hotel_ginastica']))
              {
                  $Campos_Erros['hotel_ginastica'] = array();
              }
              $Campos_Erros['hotel_ginastica'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['hotel_ginastica']) || !is_array($this->NM_ajax_info['errList']['hotel_ginastica']))
              {
                  $this->NM_ajax_info['errList']['hotel_ginastica'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_ginastica'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_ginastica';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_ginastica

    function ValidateField_hotel_restaurante(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['hotel_restaurante'])) {
       return;
   }
      if ($this->hotel_restaurante == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->hotel_restaurante != "" && !in_array("hotel_restaurante", $this->sc_force_zero))
      { 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_restaurante']) && !in_array($this->hotel_restaurante, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_restaurante']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['hotel_restaurante']))
              {
                  $Campos_Erros['hotel_restaurante'] = array();
              }
              $Campos_Erros['hotel_restaurante'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['hotel_restaurante']) || !is_array($this->NM_ajax_info['errList']['hotel_restaurante']))
              {
                  $this->NM_ajax_info['errList']['hotel_restaurante'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_restaurante'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_restaurante';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_restaurante

    function ValidateField_hotel_bar(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['hotel_bar'])) {
       return;
   }
      if ($this->hotel_bar == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->hotel_bar != "" && !in_array("hotel_bar", $this->sc_force_zero))
      { 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_bar']) && !in_array($this->hotel_bar, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_bar']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['hotel_bar']))
              {
                  $Campos_Erros['hotel_bar'] = array();
              }
              $Campos_Erros['hotel_bar'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['hotel_bar']) || !is_array($this->NM_ajax_info['errList']['hotel_bar']))
              {
                  $this->NM_ajax_info['errList']['hotel_bar'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_bar'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_bar';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_bar

    function ValidateField_hotel_estacionamento(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['hotel_estacionamento'])) {
       return;
   }
      if ($this->hotel_estacionamento == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->hotel_estacionamento != "" && !in_array("hotel_estacionamento", $this->sc_force_zero))
      { 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_estacionamento']) && !in_array($this->hotel_estacionamento, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_estacionamento']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['hotel_estacionamento']))
              {
                  $Campos_Erros['hotel_estacionamento'] = array();
              }
              $Campos_Erros['hotel_estacionamento'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['hotel_estacionamento']) || !is_array($this->NM_ajax_info['errList']['hotel_estacionamento']))
              {
                  $this->NM_ajax_info['errList']['hotel_estacionamento'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_estacionamento'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_estacionamento';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_estacionamento

    function ValidateField_hotel_sauna(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['hotel_sauna'])) {
       return;
   }
      if ($this->hotel_sauna == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->hotel_sauna != "" && !in_array("hotel_sauna", $this->sc_force_zero))
      { 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_sauna']) && !in_array($this->hotel_sauna, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_sauna']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['hotel_sauna']))
              {
                  $Campos_Erros['hotel_sauna'] = array();
              }
              $Campos_Erros['hotel_sauna'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['hotel_sauna']) || !is_array($this->NM_ajax_info['errList']['hotel_sauna']))
              {
                  $this->NM_ajax_info['errList']['hotel_sauna'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_sauna'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_sauna';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_sauna

    function ValidateField_hotel_piscina(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['hotel_piscina'])) {
       return;
   }
      if ($this->hotel_piscina == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->hotel_piscina != "" && !in_array("hotel_piscina", $this->sc_force_zero))
      { 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_piscina']) && !in_array($this->hotel_piscina, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_piscina']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['hotel_piscina']))
              {
                  $Campos_Erros['hotel_piscina'] = array();
              }
              $Campos_Erros['hotel_piscina'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['hotel_piscina']) || !is_array($this->NM_ajax_info['errList']['hotel_piscina']))
              {
                  $this->NM_ajax_info['errList']['hotel_piscina'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_piscina'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_piscina';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_piscina

    function ValidateField_hotel_wifi(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['hotel_wifi'])) {
       return;
   }
      if ($this->hotel_wifi == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->hotel_wifi != "" && !in_array("hotel_wifi", $this->sc_force_zero))
      { 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_wifi']) && !in_array($this->hotel_wifi, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_wifi']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['hotel_wifi']))
              {
                  $Campos_Erros['hotel_wifi'] = array();
              }
              $Campos_Erros['hotel_wifi'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['hotel_wifi']) || !is_array($this->NM_ajax_info['errList']['hotel_wifi']))
              {
                  $this->NM_ajax_info['errList']['hotel_wifi'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_wifi'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_wifi';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_wifi

    function ValidateField_hotel_computador(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['hotel_computador'])) {
       return;
   }
      if ($this->hotel_computador == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->hotel_computador != "" && !in_array("hotel_computador", $this->sc_force_zero))
      { 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_computador']) && !in_array($this->hotel_computador, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_computador']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['hotel_computador']))
              {
                  $Campos_Erros['hotel_computador'] = array();
              }
              $Campos_Erros['hotel_computador'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['hotel_computador']) || !is_array($this->NM_ajax_info['errList']['hotel_computador']))
              {
                  $this->NM_ajax_info['errList']['hotel_computador'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_computador'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_computador';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_computador

    function ValidateField_hotel_convencoes(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['hotel_convencoes'])) {
       return;
   }
      if ($this->hotel_convencoes == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      if ($this->hotel_convencoes != "" && !in_array("hotel_convencoes", $this->sc_force_zero))
      { 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_convencoes']) && !in_array($this->hotel_convencoes, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_convencoes']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['hotel_convencoes']))
              {
                  $Campos_Erros['hotel_convencoes'] = array();
              }
              $Campos_Erros['hotel_convencoes'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['hotel_convencoes']) || !is_array($this->NM_ajax_info['errList']['hotel_convencoes']))
              {
                  $this->NM_ajax_info['errList']['hotel_convencoes'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_convencoes'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_convencoes';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_convencoes

    function ValidateField_hotel_cod_estrangeiro(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hotel_cod_estrangeiro'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->hotel_cod_estrangeiro) > 30) 
          { 
              $hasError = true;
              $Campos_Crit .= "Cód. Estrangeiro: " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['hotel_cod_estrangeiro']))
              {
                  $Campos_Erros['hotel_cod_estrangeiro'] = array();
              }
              $Campos_Erros['hotel_cod_estrangeiro'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['hotel_cod_estrangeiro']) || !is_array($this->NM_ajax_info['errList']['hotel_cod_estrangeiro']))
              {
                  $this->NM_ajax_info['errList']['hotel_cod_estrangeiro'] = array();
              }
              $this->NM_ajax_info['errList']['hotel_cod_estrangeiro'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hotel_cod_estrangeiro';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hotel_cod_estrangeiro
//
//--------------------------------------------------------------------------------------
   function upload_img_doc(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros, $filtro = '') 
   {
     global $nm_browser;
     if (!empty($Campos_Crit) || !empty($Campos_Falta))
     {
          return;
     }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->hotel_logo == "none") 
          { 
              $this->hotel_logo = ""; 
          } 
          if ($this->hotel_logo != "") 
          { 
              if (!function_exists('sc_upload_unprotect_chars'))
              {
                  include_once 'form_tbl_hoteis_doc_name.php';
              }
              $this->hotel_logo = sc_upload_unprotect_chars($this->hotel_logo, true);
              $this->hotel_logo_scfile_name = sc_upload_unprotect_chars($this->hotel_logo_scfile_name, true);
              if ($nm_browser == "Opera")  
              { 
                  $this->hotel_logo_scfile_type = substr($this->hotel_logo_scfile_type, 0, strpos($this->hotel_logo_scfile_type, ";")) ; 
              } 
              if ($this->hotel_logo_scfile_type == "image/pjpeg" || $this->hotel_logo_scfile_type == "image/jpeg"  || $this->hotel_logo_scfile_type == "image/gif" || 
                  $this->hotel_logo_scfile_type == "image/png"   || $this->hotel_logo_scfile_type == "image/x-png" || $this->hotel_logo_scfile_type == "image/bmp" || 
                  $this->hotel_logo_scfile_type == "image/webp")
              { 
                  if (!is_file($this->hotel_logo) && isset($_SESSION['scriptcase']['charset']) && $_SESSION['scriptcase']['charset'] != 'UTF-8') {
                      $mbConvertFileName = mb_convert_encoding($this->hotel_logo, $_SESSION['scriptcase']['charset'], 'UTF-8');
                      $mbConvertScFileName = mb_convert_encoding($this->hotel_logo_scfile_name, $_SESSION['scriptcase']['charset'], 'UTF-8');
                      if (is_file($mbConvertFileName)) {
                          $this->hotel_logo = $mbConvertFileName;
                          $this->hotel_logo_scfile_name = $mbConvertScFileName;
                      }
                  }
                  if (is_file($this->hotel_logo))  
                  { 
                      $this->NM_size_docs[$this->hotel_logo_scfile_name] = $this->sc_file_size($this->hotel_logo);
                      $reg_hotel_logo = file_get_contents($this->hotel_logo); 
                      $this->hotel_logo = $reg_hotel_logo; 
                  } 
                  else 
                  { 
                      $Campos_Crit .= "Logo: " . $this->Ini->Nm_lang['lang_errm_upld']; 
                      $this->hotel_logo = "";
                      if (!isset($Campos_Erros['hotel_logo']))
                      {
                          $Campos_Erros['hotel_logo'] = array();
                      }
                      $Campos_Erros['hotel_logo'][] = $this->Ini->Nm_lang['lang_errm_upld'];
                      if (!isset($this->NM_ajax_info['errList']['hotel_logo']) || !is_array($this->NM_ajax_info['errList']['hotel_logo']))
                      {
                          $this->NM_ajax_info['errList']['hotel_logo'] = array();
                      }
                      $this->NM_ajax_info['errList']['hotel_logo'][] = $this->Ini->Nm_lang['lang_errm_upld'];
                  } 
              } 
              else 
              { 
                  if ($nm_browser == "Konqueror")  
                  { 
                      $this->hotel_logo = "" ; 
                  } 
                  else 
                  { 
                     $Campos_Crit .= "Logo: " . $this->Ini->Nm_lang['lang_errm_ivtp'];  
                      if (!isset($Campos_Erros['hotel_logo']))
                      {
                          $Campos_Erros['hotel_logo'] = array();
                      }
                      $Campos_Erros['hotel_logo'][] = $this->Ini->Nm_lang['lang_errm_ivtp'];
                      if (!isset($this->NM_ajax_info['errList']['hotel_logo']) || !is_array($this->NM_ajax_info['errList']['hotel_logo']))
                      {
                          $this->NM_ajax_info['errList']['hotel_logo'] = array();
                      }
                      $this->NM_ajax_info['errList']['hotel_logo'][] = $this->Ini->Nm_lang['lang_errm_ivtp'];
                  } 
              } 
          } 
          elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dados_form']['hotel_logo']) && $this->hotel_logo_limpa != "S")
          {
              $this->hotel_logo = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dados_form']['hotel_logo'];
          }
      } 
   }

    function removeDuplicateDttmError($aErrDate, &$aErrTime)
    {
        if (empty($aErrDate) || empty($aErrTime))
        {
            return;
        }

        foreach ($aErrDate as $sErrDate)
        {
            foreach ($aErrTime as $iErrTime => $sErrTime)
            {
                if ($sErrDate == $sErrTime)
                {
                    unset($aErrTime[$iErrTime]);
                }
            }
        }
    } // removeDuplicateDttmError

   function nm_guardar_campos()
   {
    global
           $sc_seq_vert;
    $this->nmgp_dados_form['hotel_id'] = $this->hotel_id;
    $this->nmgp_dados_form['hotel_cnpj'] = $this->hotel_cnpj;
    $this->nmgp_dados_form['hotel_fantasia'] = $this->hotel_fantasia;
    $this->nmgp_dados_form['hotel_razsoc'] = $this->hotel_razsoc;
    $this->nmgp_dados_form['hotel_descricao'] = $this->hotel_descricao;
    $this->nmgp_dados_form['hotel_rede'] = $this->hotel_rede;
    $this->nmgp_dados_form['hotel_classificacao'] = $this->hotel_classificacao;
    $this->nmgp_dados_form['hotel_categoria'] = $this->hotel_categoria;
    if (empty($this->hotel_logo))
    {
        $this->hotel_logo = $this->nmgp_dados_form['hotel_logo'];
    }
    $this->nmgp_dados_form['hotel_logo'] = $this->hotel_logo;
    $this->nmgp_dados_form['hotel_logo_limpa'] = $this->hotel_logo_limpa;
    $this->nmgp_dados_form['hotel_cep'] = $this->hotel_cep;
    $this->nmgp_dados_form['hotel_pais'] = $this->hotel_pais;
    $this->nmgp_dados_form['hotel_uf'] = $this->hotel_uf;
    $this->nmgp_dados_form['hotel_municipio'] = $this->hotel_municipio;
    $this->nmgp_dados_form['hotel_bairro'] = $this->hotel_bairro;
    $this->nmgp_dados_form['hotel_logradouro'] = $this->hotel_logradouro;
    $this->nmgp_dados_form['hotel_numero'] = $this->hotel_numero;
    $this->nmgp_dados_form['hotel_complemento'] = $this->hotel_complemento;
    $this->nmgp_dados_form['localizacao'] = $this->localizacao;
    $this->nmgp_dados_form['hotel_observacoes'] = $this->hotel_observacoes;
    $this->nmgp_dados_form['hotel_email'] = $this->hotel_email;
    $this->nmgp_dados_form['hotel_website'] = $this->hotel_website;
    $this->nmgp_dados_form['hotel_telefone'] = $this->hotel_telefone;
    $this->nmgp_dados_form['hotel_fax'] = $this->hotel_fax;
    $this->nmgp_dados_form['hotel_celular'] = $this->hotel_celular;
    $this->nmgp_dados_form['hotel_status'] = $this->hotel_status;
    $this->nmgp_dados_form['hotel_facebook'] = $this->hotel_facebook;
    $this->nmgp_dados_form['hotel_twitter'] = $this->hotel_twitter;
    $this->nmgp_dados_form['hotel_skype'] = $this->hotel_skype;
    $this->nmgp_dados_form['hotel_ar_condicionado'] = $this->hotel_ar_condicionado;
    $this->nmgp_dados_form['hotel_frigobar'] = $this->hotel_frigobar;
    $this->nmgp_dados_form['hotel_lavanderia'] = $this->hotel_lavanderia;
    $this->nmgp_dados_form['hotel_telefone_quarto'] = $this->hotel_telefone_quarto;
    $this->nmgp_dados_form['hotel_tv'] = $this->hotel_tv;
    $this->nmgp_dados_form['hotel_ginastica'] = $this->hotel_ginastica;
    $this->nmgp_dados_form['hotel_restaurante'] = $this->hotel_restaurante;
    $this->nmgp_dados_form['hotel_bar'] = $this->hotel_bar;
    $this->nmgp_dados_form['hotel_estacionamento'] = $this->hotel_estacionamento;
    $this->nmgp_dados_form['hotel_sauna'] = $this->hotel_sauna;
    $this->nmgp_dados_form['hotel_piscina'] = $this->hotel_piscina;
    $this->nmgp_dados_form['hotel_wifi'] = $this->hotel_wifi;
    $this->nmgp_dados_form['hotel_computador'] = $this->hotel_computador;
    $this->nmgp_dados_form['hotel_convencoes'] = $this->hotel_convencoes;
    $this->nmgp_dados_form['hotel_cod_estrangeiro'] = $this->hotel_cod_estrangeiro;
    $this->nmgp_dados_form['rodape'] = $this->rodape;
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
      $this->Before_unformat['hotel_id'] = $this->hotel_id;
      nm_limpa_numero($this->hotel_id, $this->field_config['hotel_id']['symbol_grp']) ; 
      $this->Before_unformat['hotel_cep'] = $this->hotel_cep;
      nm_limpa_cep($this->hotel_cep) ; 
      $this->Before_unformat['hotel_telefone'] = $this->hotel_telefone;
      $this->nm_tira_mask($this->hotel_telefone, "(99) 9999-9999", "(){}[].,;:-+/ "); 
      $this->Before_unformat['hotel_fax'] = $this->hotel_fax;
      $this->nm_tira_mask($this->hotel_fax, "(99) 9999-9999", "(){}[].,;:-+/ "); 
      $this->Before_unformat['hotel_celular'] = $this->hotel_celular;
      $this->nm_tira_mask($this->hotel_celular, "(99) 99999-9999", "(){}[].,;:-+/ "); 
   }
   function sc_add_currency(&$value, $symbol, $pos)
   {
       if ('' == $value)
       {
           return;
       }
       $value = (1 == $pos || 3 == $pos) ? $symbol . ' ' . $value : $value . ' ' . $symbol;
   }
   function sc_remove_currency(&$value, $symbol_dec, $symbol_tho, $symbol_mon)
   {
       $value = preg_replace('~&#x0*([0-9a-f]+);~i', '', $value);
       $sNew  = str_replace($symbol_mon, '', $value);
       if ($sNew != $value)
       {
           $value = str_replace(' ', '', $sNew);
           return;
       }
       $aTest = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '-', $symbol_dec, $symbol_tho);
       $sNew  = '';
       for ($i = 0; $i < strlen($value); $i++)
       {
           if ($this->sc_test_currency_char($value[$i], $aTest))
           {
               $sNew .= $value[$i];
           }
       }
       $value = $sNew;
   }
   function sc_test_currency_char($char, $test)
   {
       $found = false;
       foreach ($test as $test_char)
       {
           if ($char === $test_char)
           {
               $found = true;
           }
       }
       return $found;
   }
   function nm_clear_val($Nome_Campo)
   {
      if ($Nome_Campo == "hotel_id")
      {
          nm_limpa_numero($this->hotel_id, $this->field_config['hotel_id']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "hotel_cep")
      {
          nm_limpa_cep($this->hotel_cep) ; 
      }
      if ($Nome_Campo == "hotel_telefone")
      {
          $this->nm_tira_mask($this->hotel_telefone, "(99) 9999-9999", "(){}[].,;:-+/ "); 
      }
      if ($Nome_Campo == "hotel_fax")
      {
          $this->nm_tira_mask($this->hotel_fax, "(99) 9999-9999", "(){}[].,;:-+/ "); 
      }
      if ($Nome_Campo == "hotel_celular")
      {
          $this->nm_tira_mask($this->hotel_celular, "(99) 99999-9999", "(){}[].,;:-+/ "); 
      }
   }
   function nm_formatar_campos($format_fields = array())
   {
      global $nm_form_submit;
     if (isset($this->formatado) && $this->formatado)
     {
         return;
     }
     $this->formatado = true;
      if ('' !== $this->hotel_id || (!empty($format_fields) && isset($format_fields['hotel_id'])))
      {
          nmgp_Form_Num_Val($this->hotel_id, $this->field_config['hotel_id']['symbol_grp'], $this->field_config['hotel_id']['symbol_dec'], "0", "S", $this->field_config['hotel_id']['format_neg'], "", "", "-", $this->field_config['hotel_id']['symbol_fmt']) ; 
      }
      if (!empty($this->hotel_cep) || (!empty($format_fields) && isset($format_fields['hotel_cep'])))
      {
          nmgp_Form_Cep($this->hotel_cep) ; 
      }
      if (!empty($this->hotel_telefone) || (!empty($format_fields) && isset($format_fields['hotel_telefone'])))
      {
          $this->nm_gera_mask($this->hotel_telefone, "(99) 9999-9999"); 
      }
      if (!empty($this->hotel_fax) || (!empty($format_fields) && isset($format_fields['hotel_fax'])))
      {
          $this->nm_gera_mask($this->hotel_fax, "(99) 9999-9999"); 
      }
      if (!empty($this->hotel_celular) || (!empty($format_fields) && isset($format_fields['hotel_celular'])))
      {
          $this->nm_gera_mask($this->hotel_celular, "(99) 99999-9999"); 
      }
   }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";

      if (false !== strpos($nm_mask, '9') || false !== strpos($nm_mask, 'a') || false !== strpos($nm_mask, '*'))
      {
          $new_campo = '';
          $a_mask_ord  = array();
          $i_mask_size = -1;

          foreach (explode(';', $nm_mask) as $str_mask)
          {
              $a_mask_ord[ $this->nm_conta_mask_chars($str_mask) ] = $str_mask;
          }
          ksort($a_mask_ord);

          foreach ($a_mask_ord as $i_size => $s_mask)
          {
              if (-1 == $i_mask_size)
              {
                  $i_mask_size = $i_size;
              }
              elseif (strlen($nm_campo) >= $i_size && strlen($nm_campo) > $i_mask_size)
              {
                  $i_mask_size = $i_size;
              }
          }
          $nm_mask = $a_mask_ord[$i_mask_size];

          for ($i = 0; $i < strlen($nm_mask); $i++)
          {
              $test_mask = substr($nm_mask, $i, 1);
              
              if ('9' == $test_mask || 'a' == $test_mask || '*' == $test_mask)
              {
                  $new_campo .= substr($nm_campo, 0, 1);
                  $nm_campo   = substr($nm_campo, 1);
              }
              else
              {
                  $new_campo .= $test_mask;
              }
          }

                  $nm_campo = $new_campo;

          return;
      }

      $mask_num = false;
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
              if ($cont1 < $cont2 && $tam_campo <= $cont2 && $tam_campo > $cont1)
              {
                  $trab_mask = $ver_duas[1];
              }
              elseif ($cont1 > $cont2 && $tam_campo <= $cont2)
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
          $nm_campo = $trab_saida;
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
      $nm_campo = $trab_saida;
   } 
   function nm_conta_mask_chars($sMask)
   {
       $iLength = 0;

       for ($i = 0; $i < strlen($sMask); $i++)
       {
           if (in_array($sMask[$i], array('9', 'a', '*')))
           {
               $iLength++;
           }
       }

       return $iLength;
   }
   function nm_tira_mask(&$nm_campo, $nm_mask, $nm_chars = '')
   { 
      $mask_dados = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $tam_mask   = strlen($nm_mask);
      $trab_saida = "";

      if (false !== strpos($nm_mask, '9') || false !== strpos($nm_mask, 'a') || false !== strpos($nm_mask, '*'))
      {
          $raw_campo = $this->sc_clear_mask($nm_campo, $nm_chars);
          $raw_mask  = $this->sc_clear_mask($nm_mask, $nm_chars);
          $new_campo = '';

          $test_mask = substr($raw_mask, 0, 1);
          $raw_mask  = substr($raw_mask, 1);

          while ('' != $raw_campo)
          {
              $test_val  = substr($raw_campo, 0, 1);
              $raw_campo = substr($raw_campo, 1);
              $ord       = ord($test_val);
              $found     = false;

              switch ($test_mask)
              {
                  case '9':
                      if (48 <= $ord && 57 >= $ord)
                      {
                          $new_campo .= $test_val;
                          $found      = true;
                      }
                      break;

                  case 'a':
                      if ((65 <= $ord && 90 >= $ord) || (97 <= $ord && 122 >= $ord))
                      {
                          $new_campo .= $test_val;
                          $found      = true;
                      }
                      break;

                  case '*':
                      if ((48 <= $ord && 57 >= $ord) || (65 <= $ord && 90 >= $ord) || (97 <= $ord && 122 >= $ord))
                      {
                          $new_campo .= $test_val;
                          $found      = true;
                      }
                      break;
              }

              if ($found)
              {
                  $test_mask = substr($raw_mask, 0, 1);
                  $raw_mask  = substr($raw_mask, 1);
              }
          }

          $nm_campo = $new_campo;

          return;
      }

      $mask_num = false;
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
          for ($x=0; $x < strlen($mask_dados); $x++)
          {
              if (is_numeric(substr($mask_dados, $x, 1)))
              {
                  $trab_saida .= substr($mask_dados, $x, 1);
              }
          }
          $nm_campo = $trab_saida;
          return;
      }
      if ($tam_mask > $tam_campo)
      {
         $mask_desfaz = "";
         for ($mask_ind = 0; $tam_mask > $tam_campo; $mask_ind++)
         {
              $mask_char = substr($trab_mask, $mask_ind, 1);
              if ($mask_char == "z")
              {
                  $tam_mask--;
              }
              else
              {
                  $mask_desfaz .= $mask_char;
              }
              if ($mask_ind == $tam_campo)
              {
                  $tam_mask = $tam_campo;
              }
         }
         $trab_mask = $mask_desfaz . substr($trab_mask, $mask_ind);
      }
      $mask_saida = "";
      for ($mask_ind = strlen($trab_mask); $mask_ind > 0; $mask_ind--)
      {
          $mask_char = substr($trab_mask, $mask_ind - 1, 1);
          if ($mask_char == "x" || $mask_char == "z")
          {
              if ($tam_campo > 0)
              {
                  $mask_saida = substr($mask_dados, $tam_campo - 1, 1) . $mask_saida;
              }
          }
          else
          {
              if ($mask_char != substr($mask_dados, $tam_campo - 1, 1) && $tam_campo > 0)
              {
                  $mask_saida = substr($mask_dados, $tam_campo - 1, 1) . $mask_saida;
                  $mask_ind--;
              }
          }
          $tam_campo--;
      }
      if ($tam_campo > 0)
      {
         $mask_saida = substr($mask_dados, 0, $tam_campo) . $mask_saida;
      }
      $nm_campo = $mask_saida;
   }

   function sc_clear_mask($value, $chars)
   {
       $new = '';

       for ($i = 0; $i < strlen($value); $i++)
       {
           if (false === strpos($chars, $value[$i]))
           {
               $new .= $value[$i];
           }
       }

       return $new;
   }
//
   function nm_limpa_alfa(&$str)
   {
   }
   function nm_conv_data_db($dt_in, $form_in, $form_out, $replaces = array())
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
           nm_conv_form_data($dt_out, $form_in, $form_out, $replaces);
           return $dt_out;
       }
   }

   function returnWhere($aCond, $sOp = 'AND')
   {
       $aWhere = array();
       foreach ($aCond as $sCond)
       {
           $this->handleWhereCond($sCond);
           if ('' != $sCond)
           {
               $aWhere[] = $sCond;
           }
       }
       if (empty($aWhere))
       {
           return '';
       }
       else
       {
           return ' WHERE (' . implode(') ' . $sOp . ' (', $aWhere) . ')';
       }
   } // returnWhere

   function handleWhereCond(&$sCond)
   {
       $sCond = trim($sCond);
       if ('where' == strtolower(substr($sCond, 0, 5)))
       {
           $sCond = trim(substr($sCond, 5));
       }
   } // handleWhereCond

   function ajax_return_values()
   {
          $this->ajax_return_values_hotel_id();
          $this->ajax_return_values_hotel_cnpj();
          $this->ajax_return_values_hotel_fantasia();
          $this->ajax_return_values_hotel_razsoc();
          $this->ajax_return_values_hotel_descricao();
          $this->ajax_return_values_hotel_rede();
          $this->ajax_return_values_hotel_classificacao();
          $this->ajax_return_values_hotel_categoria();
          $this->ajax_return_values_hotel_logo();
          $this->ajax_return_values_hotel_cep();
          $this->ajax_return_values_hotel_pais();
          $this->ajax_return_values_hotel_uf();
          $this->ajax_return_values_hotel_municipio();
          $this->ajax_return_values_hotel_bairro();
          $this->ajax_return_values_hotel_logradouro();
          $this->ajax_return_values_hotel_numero();
          $this->ajax_return_values_hotel_complemento();
          $this->ajax_return_values_localizacao();
          $this->ajax_return_values_hotel_observacoes();
          $this->ajax_return_values_hotel_email();
          $this->ajax_return_values_hotel_website();
          $this->ajax_return_values_hotel_telefone();
          $this->ajax_return_values_hotel_fax();
          $this->ajax_return_values_hotel_celular();
          $this->ajax_return_values_hotel_status();
          $this->ajax_return_values_hotel_facebook();
          $this->ajax_return_values_hotel_twitter();
          $this->ajax_return_values_hotel_skype();
          $this->ajax_return_values_hotel_ar_condicionado();
          $this->ajax_return_values_hotel_frigobar();
          $this->ajax_return_values_hotel_lavanderia();
          $this->ajax_return_values_hotel_telefone_quarto();
          $this->ajax_return_values_hotel_tv();
          $this->ajax_return_values_hotel_ginastica();
          $this->ajax_return_values_hotel_restaurante();
          $this->ajax_return_values_hotel_bar();
          $this->ajax_return_values_hotel_estacionamento();
          $this->ajax_return_values_hotel_sauna();
          $this->ajax_return_values_hotel_piscina();
          $this->ajax_return_values_hotel_wifi();
          $this->ajax_return_values_hotel_computador();
          $this->ajax_return_values_hotel_convencoes();
          $this->ajax_return_values_hotel_cod_estrangeiro();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
              $this->NM_ajax_info['fldList']['hotel_id']['keyVal'] = form_tbl_hoteis_pack_protect_string($this->nmgp_dados_form['hotel_id']);
          }
   } // ajax_return_values

          //----- hotel_id
   function ajax_return_values_hotel_id($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_id", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_id);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['hotel_id'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("hotel_id", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- hotel_cnpj
   function ajax_return_values_hotel_cnpj($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_cnpj", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_cnpj);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['hotel_cnpj'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- hotel_fantasia
   function ajax_return_values_hotel_fantasia($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_fantasia", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_fantasia);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['hotel_fantasia'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- hotel_razsoc
   function ajax_return_values_hotel_razsoc($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_razsoc", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_razsoc);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['hotel_razsoc'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- hotel_descricao
   function ajax_return_values_hotel_descricao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_descricao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_descricao);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['hotel_descricao'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- hotel_rede
   function ajax_return_values_hotel_rede($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_rede", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_rede);
              $aLookup = array();
              $this->_tmp_lookup_hotel_rede = $this->hotel_rede;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede'] = array(); 
}
$aLookup[] = array(form_tbl_hoteis_pack_protect_string('') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string('.:selecione.:.')));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_hotel_id = $this->hotel_id;
   $old_value_hotel_cep = $this->hotel_cep;
   $old_value_hotel_telefone = $this->hotel_telefone;
   $old_value_hotel_fax = $this->hotel_fax;
   $old_value_hotel_celular = $this->hotel_celular;
   $this->nm_tira_formatacao();


   $unformatted_value_hotel_id = $this->hotel_id;
   $unformatted_value_hotel_cep = $this->hotel_cep;
   $unformatted_value_hotel_telefone = $this->hotel_telefone;
   $unformatted_value_hotel_fax = $this->hotel_fax;
   $unformatted_value_hotel_celular = $this->hotel_celular;

   $nm_comando = "SELECT rede_hoteis_descricao  FROM tbl_rede_hoteis  ORDER BY rede_hoteis_descricao";

   $this->hotel_id = $old_value_hotel_id;
   $this->hotel_cep = $old_value_hotel_cep;
   $this->hotel_telefone = $old_value_hotel_telefone;
   $this->hotel_fax = $old_value_hotel_fax;
   $this->hotel_celular = $old_value_hotel_celular;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $aLookup[] = array(form_tbl_hoteis_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', form_tbl_hoteis_pack_protect_string(NM_charset_to_utf8($rs->fields[0]))));
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede'][] = $rs->fields[0];
              $nmgp_def_dados .= $rs->fields[0] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"hotel_rede\"";
          if (isset($this->NM_ajax_info['select_html']['hotel_rede']) && !empty($this->NM_ajax_info['select_html']['hotel_rede']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['hotel_rede']);
          }
          $sLookup = '';
          if (empty($aLookup))
          {
              $aLookup[] = array('' => '');
          }
          foreach ($aLookup as $aOption)
          {
              foreach ($aOption as $sValue => $sLabel)
              {

                  if ($this->hotel_rede == $sValue)
                  {
                      $this->_tmp_lookup_hotel_rede = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['hotel_rede'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['hotel_rede']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['hotel_rede']['valList'][$i] = form_tbl_hoteis_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['hotel_rede']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['hotel_rede']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['hotel_rede']['labList'] = $aLabel;
          }
   }

          //----- hotel_classificacao
   function ajax_return_values_hotel_classificacao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_classificacao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_classificacao);
              $aLookup = array();
              $this->_tmp_lookup_hotel_classificacao = $this->hotel_classificacao;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao'] = array(); 
}
$aLookup[] = array(form_tbl_hoteis_pack_protect_string('') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string('.:selecione.:.')));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_hotel_id = $this->hotel_id;
   $old_value_hotel_cep = $this->hotel_cep;
   $old_value_hotel_telefone = $this->hotel_telefone;
   $old_value_hotel_fax = $this->hotel_fax;
   $old_value_hotel_celular = $this->hotel_celular;
   $this->nm_tira_formatacao();


   $unformatted_value_hotel_id = $this->hotel_id;
   $unformatted_value_hotel_cep = $this->hotel_cep;
   $unformatted_value_hotel_telefone = $this->hotel_telefone;
   $unformatted_value_hotel_fax = $this->hotel_fax;
   $unformatted_value_hotel_celular = $this->hotel_celular;

   $nm_comando = "SELECT hotel_class_id, hotel_tipo  FROM tbl_hoteis_class  ORDER BY hotel_tipo";

   $this->hotel_id = $old_value_hotel_id;
   $this->hotel_cep = $old_value_hotel_cep;
   $this->hotel_telefone = $old_value_hotel_telefone;
   $this->hotel_fax = $old_value_hotel_fax;
   $this->hotel_celular = $old_value_hotel_celular;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(form_tbl_hoteis_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', form_tbl_hoteis_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"hotel_classificacao\"";
          if (isset($this->NM_ajax_info['select_html']['hotel_classificacao']) && !empty($this->NM_ajax_info['select_html']['hotel_classificacao']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['hotel_classificacao']);
          }
          $sLookup = '';
          if (empty($aLookup))
          {
              $aLookup[] = array('' => '');
          }
          foreach ($aLookup as $aOption)
          {
              foreach ($aOption as $sValue => $sLabel)
              {

                  if ($this->hotel_classificacao == $sValue)
                  {
                      $this->_tmp_lookup_hotel_classificacao = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['hotel_classificacao'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['hotel_classificacao']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['hotel_classificacao']['valList'][$i] = form_tbl_hoteis_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['hotel_classificacao']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['hotel_classificacao']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['hotel_classificacao']['labList'] = $aLabel;
          }
   }

          //----- hotel_categoria
   function ajax_return_values_hotel_categoria($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_categoria", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_categoria);
              $aLookup = array();
              $this->_tmp_lookup_hotel_categoria = $this->hotel_categoria;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria'] = array(); 
}
$aLookup[] = array(form_tbl_hoteis_pack_protect_string('') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string('.:selecione.:.')));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_hotel_id = $this->hotel_id;
   $old_value_hotel_cep = $this->hotel_cep;
   $old_value_hotel_telefone = $this->hotel_telefone;
   $old_value_hotel_fax = $this->hotel_fax;
   $old_value_hotel_celular = $this->hotel_celular;
   $this->nm_tira_formatacao();


   $unformatted_value_hotel_id = $this->hotel_id;
   $unformatted_value_hotel_cep = $this->hotel_cep;
   $unformatted_value_hotel_telefone = $this->hotel_telefone;
   $unformatted_value_hotel_fax = $this->hotel_fax;
   $unformatted_value_hotel_celular = $this->hotel_celular;

   $nm_comando = "SELECT categ_hotel_id, classificacao  FROM tbl_categ_hoteis  ORDER BY classificacao";

   $this->hotel_id = $old_value_hotel_id;
   $this->hotel_cep = $old_value_hotel_cep;
   $this->hotel_telefone = $old_value_hotel_telefone;
   $this->hotel_fax = $old_value_hotel_fax;
   $this->hotel_celular = $old_value_hotel_celular;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(form_tbl_hoteis_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', form_tbl_hoteis_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"hotel_categoria\"";
          if (isset($this->NM_ajax_info['select_html']['hotel_categoria']) && !empty($this->NM_ajax_info['select_html']['hotel_categoria']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['hotel_categoria']);
          }
          $sLookup = '';
          if (empty($aLookup))
          {
              $aLookup[] = array('' => '');
          }
          foreach ($aLookup as $aOption)
          {
              foreach ($aOption as $sValue => $sLabel)
              {

                  if ($this->hotel_categoria == $sValue)
                  {
                      $this->_tmp_lookup_hotel_categoria = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['hotel_categoria'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['hotel_categoria']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['hotel_categoria']['valList'][$i] = form_tbl_hoteis_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['hotel_categoria']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['hotel_categoria']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['hotel_categoria']['labList'] = $aLabel;
          }
   }

          //----- hotel_logo
   function ajax_return_values_hotel_logo($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_logo", $this->nmgp_refresh_fields)) || $bForce || in_array("hotel_logo", $this->Upload_refresh_fields))
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_logo);
              $aLookup = array();
   $out_hotel_logo = '';
   $out1_hotel_logo = '';
   if ($this->hotel_logo != "" && $this->hotel_logo != "none")   
   { 
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) 
       { 
           $nm_tmp = nm_conv_img_access(substr($this->hotel_logo, 0, 12));
           if (is_string($this->hotel_logo) && substr($this->hotel_logo, 0, 4) != "*nm*" && is_string($nm_tmp) && substr($nm_tmp, 0, 4) == "*nm*") 
           { 
               $this->hotel_logo = nm_conv_img_access($this->hotel_logo);
           } 
       } 
       if (is_string($this->hotel_logo) && substr($this->hotel_logo, 0, 4) == "*nm*") 
       { 
           $this->hotel_logo = substr($this->hotel_logo, 4) ; 
           $this->hotel_logo = base64_decode($this->hotel_logo) ; 
       } 
       $img_pos_bm = (is_string($this->hotel_logo)) ? strpos($this->hotel_logo, "BM") : false; 
       if (!$img_pos_bm === FALSE && $img_pos_bm == 78) 
       { 
           $this->hotel_logo = substr($this->hotel_logo, $img_pos_bm) ; 
       } 
       $Ext_File = $this->scGetImageExtension($this->hotel_logo);
       $out_hotel_logo = $this->Ini->path_imag_temp . "/sc_hotel_logo_" . $_SESSION['scriptcase']['sc_num_img'] . session_id() . $Ext_File;  
       $out1_hotel_logo = $out_hotel_logo; 
       $arq_hotel_logo = fopen($this->Ini->root . $out_hotel_logo, "w") ;  
       fwrite($arq_hotel_logo, (string)$this->hotel_logo) ;  
       fclose($arq_hotel_logo) ;  
       $sc_obj_img = new nm_trata_img($this->Ini->root . $out_hotel_logo, true);
       $this->nmgp_return_img['hotel_logo'][0] = $sc_obj_img->getHeight();
       $this->nmgp_return_img['hotel_logo'][1] = $sc_obj_img->getWidth();
       $_SESSION['scriptcase']['sc_num_img']++ ; 
   } 
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['hotel_logo'] = array(
                       'row'    => '',
               'type'    => 'imagem',
               'valList' => array($this->Ini->Nm_lang['lang_othr_show_imgg']),
               'imgFile' => $out_hotel_logo,
               'imgOrig' => $out1_hotel_logo,
               'keepImg' => $sKeepImage,
              );
          }
   }

          //----- hotel_cep
   function ajax_return_values_hotel_cep($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_cep", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_cep);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['hotel_cep'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- hotel_pais
   function ajax_return_values_hotel_pais($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_pais", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_pais);
              $aLookup = array();
              $this->_tmp_lookup_hotel_pais = $this->hotel_pais;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais'] = array(); 
}
$aLookup[] = array(form_tbl_hoteis_pack_protect_string('') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string('BRASIL')));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_hotel_id = $this->hotel_id;
   $old_value_hotel_cep = $this->hotel_cep;
   $old_value_hotel_telefone = $this->hotel_telefone;
   $old_value_hotel_fax = $this->hotel_fax;
   $old_value_hotel_celular = $this->hotel_celular;
   $this->nm_tira_formatacao();


   $unformatted_value_hotel_id = $this->hotel_id;
   $unformatted_value_hotel_cep = $this->hotel_cep;
   $unformatted_value_hotel_telefone = $this->hotel_telefone;
   $unformatted_value_hotel_fax = $this->hotel_fax;
   $unformatted_value_hotel_celular = $this->hotel_celular;

   $nm_comando = "SELECT pais_id, descricao  FROM tbl_paises  ORDER BY descricao";

   $this->hotel_id = $old_value_hotel_id;
   $this->hotel_cep = $old_value_hotel_cep;
   $this->hotel_telefone = $old_value_hotel_telefone;
   $this->hotel_fax = $old_value_hotel_fax;
   $this->hotel_celular = $old_value_hotel_celular;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(form_tbl_hoteis_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', form_tbl_hoteis_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"hotel_pais\"";
          if (isset($this->NM_ajax_info['select_html']['hotel_pais']) && !empty($this->NM_ajax_info['select_html']['hotel_pais']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['hotel_pais']);
          }
          $sLookup = '';
          if (empty($aLookup))
          {
              $aLookup[] = array('' => '');
          }
          foreach ($aLookup as $aOption)
          {
              foreach ($aOption as $sValue => $sLabel)
              {

                  if ($this->hotel_pais == $sValue)
                  {
                      $this->_tmp_lookup_hotel_pais = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['hotel_pais'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['hotel_pais']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['hotel_pais']['valList'][$i] = form_tbl_hoteis_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['hotel_pais']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['hotel_pais']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['hotel_pais']['labList'] = $aLabel;
          }
   }

          //----- hotel_uf
   function ajax_return_values_hotel_uf($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_uf", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_uf);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['hotel_uf'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- hotel_municipio
   function ajax_return_values_hotel_municipio($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_municipio", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_municipio);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['hotel_municipio'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- hotel_bairro
   function ajax_return_values_hotel_bairro($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_bairro", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_bairro);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['hotel_bairro'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- hotel_logradouro
   function ajax_return_values_hotel_logradouro($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_logradouro", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_logradouro);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['hotel_logradouro'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- hotel_numero
   function ajax_return_values_hotel_numero($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_numero", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_numero);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['hotel_numero'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- hotel_complemento
   function ajax_return_values_hotel_complemento($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_complemento", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_complemento);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['hotel_complemento'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- localizacao
   function ajax_return_values_localizacao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("localizacao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->localizacao);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['localizacao'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- hotel_observacoes
   function ajax_return_values_hotel_observacoes($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_observacoes", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_observacoes);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['hotel_observacoes'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- hotel_email
   function ajax_return_values_hotel_email($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_email", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_email);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['hotel_email'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- hotel_website
   function ajax_return_values_hotel_website($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_website", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_website);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['hotel_website'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- hotel_telefone
   function ajax_return_values_hotel_telefone($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_telefone", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_telefone);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['hotel_telefone'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- hotel_fax
   function ajax_return_values_hotel_fax($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_fax", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_fax);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['hotel_fax'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- hotel_celular
   function ajax_return_values_hotel_celular($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_celular", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_celular);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['hotel_celular'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- hotel_status
   function ajax_return_values_hotel_status($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_status", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_status);
              $aLookup = array();
              $this->_tmp_lookup_hotel_status = $this->hotel_status;

$aLookup[] = array(form_tbl_hoteis_pack_protect_string('Y') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Ativo")));
$aLookup[] = array(form_tbl_hoteis_pack_protect_string('N') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Inativo")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_status'][] = 'Y';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_status'][] = 'N';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['hotel_status']) && !empty($this->NM_ajax_info['select_html']['hotel_status']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['hotel_status']);
          }
          $this->NM_ajax_info['fldList']['hotel_status'] = array(
                       'row'    => '',
               'type'    => 'radio',
               'switch'  => false,
               'valList' => array($sTmpValue),
               'colNum'  => 2,
               'optComp'  => $sOptComp,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['hotel_status']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['hotel_status']['valList'][$i] = form_tbl_hoteis_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['hotel_status']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['hotel_status']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['hotel_status']['labList'] = $aLabel;
          }
   }

          //----- hotel_facebook
   function ajax_return_values_hotel_facebook($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_facebook", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_facebook);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['hotel_facebook'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- hotel_twitter
   function ajax_return_values_hotel_twitter($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_twitter", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_twitter);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['hotel_twitter'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- hotel_skype
   function ajax_return_values_hotel_skype($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_skype", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_skype);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['hotel_skype'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- hotel_ar_condicionado
   function ajax_return_values_hotel_ar_condicionado($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_ar_condicionado", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_ar_condicionado);
              $aLookup = array();
              $this->_tmp_lookup_hotel_ar_condicionado = $this->hotel_ar_condicionado;

$aLookup[] = array(form_tbl_hoteis_pack_protect_string('Y') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Sim")));
$aLookup[] = array(form_tbl_hoteis_pack_protect_string('N') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Não")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_ar_condicionado'][] = 'Y';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_ar_condicionado'][] = 'N';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['hotel_ar_condicionado']) && !empty($this->NM_ajax_info['select_html']['hotel_ar_condicionado']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['hotel_ar_condicionado']);
          }
          $this->NM_ajax_info['fldList']['hotel_ar_condicionado'] = array(
                       'row'    => '',
               'type'    => 'radio',
               'switch'  => false,
               'valList' => array($sTmpValue),
               'colNum'  => 2,
               'optComp'  => $sOptComp,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['hotel_ar_condicionado']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['hotel_ar_condicionado']['valList'][$i] = form_tbl_hoteis_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['hotel_ar_condicionado']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['hotel_ar_condicionado']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['hotel_ar_condicionado']['labList'] = $aLabel;
          }
   }

          //----- hotel_frigobar
   function ajax_return_values_hotel_frigobar($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_frigobar", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_frigobar);
              $aLookup = array();
              $this->_tmp_lookup_hotel_frigobar = $this->hotel_frigobar;

$aLookup[] = array(form_tbl_hoteis_pack_protect_string('Y') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Sim")));
$aLookup[] = array(form_tbl_hoteis_pack_protect_string('N') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Não")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_frigobar'][] = 'Y';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_frigobar'][] = 'N';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['hotel_frigobar']) && !empty($this->NM_ajax_info['select_html']['hotel_frigobar']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['hotel_frigobar']);
          }
          $this->NM_ajax_info['fldList']['hotel_frigobar'] = array(
                       'row'    => '',
               'type'    => 'radio',
               'switch'  => false,
               'valList' => array($sTmpValue),
               'colNum'  => 2,
               'optComp'  => $sOptComp,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['hotel_frigobar']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['hotel_frigobar']['valList'][$i] = form_tbl_hoteis_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['hotel_frigobar']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['hotel_frigobar']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['hotel_frigobar']['labList'] = $aLabel;
          }
   }

          //----- hotel_lavanderia
   function ajax_return_values_hotel_lavanderia($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_lavanderia", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_lavanderia);
              $aLookup = array();
              $this->_tmp_lookup_hotel_lavanderia = $this->hotel_lavanderia;

$aLookup[] = array(form_tbl_hoteis_pack_protect_string('Y') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Sim")));
$aLookup[] = array(form_tbl_hoteis_pack_protect_string('N') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Não")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_lavanderia'][] = 'Y';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_lavanderia'][] = 'N';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['hotel_lavanderia']) && !empty($this->NM_ajax_info['select_html']['hotel_lavanderia']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['hotel_lavanderia']);
          }
          $this->NM_ajax_info['fldList']['hotel_lavanderia'] = array(
                       'row'    => '',
               'type'    => 'radio',
               'switch'  => false,
               'valList' => array($sTmpValue),
               'colNum'  => 2,
               'optComp'  => $sOptComp,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['hotel_lavanderia']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['hotel_lavanderia']['valList'][$i] = form_tbl_hoteis_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['hotel_lavanderia']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['hotel_lavanderia']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['hotel_lavanderia']['labList'] = $aLabel;
          }
   }

          //----- hotel_telefone_quarto
   function ajax_return_values_hotel_telefone_quarto($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_telefone_quarto", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_telefone_quarto);
              $aLookup = array();
              $this->_tmp_lookup_hotel_telefone_quarto = $this->hotel_telefone_quarto;

$aLookup[] = array(form_tbl_hoteis_pack_protect_string('Y') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Sim")));
$aLookup[] = array(form_tbl_hoteis_pack_protect_string('N') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Não")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_telefone_quarto'][] = 'Y';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_telefone_quarto'][] = 'N';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['hotel_telefone_quarto']) && !empty($this->NM_ajax_info['select_html']['hotel_telefone_quarto']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['hotel_telefone_quarto']);
          }
          $this->NM_ajax_info['fldList']['hotel_telefone_quarto'] = array(
                       'row'    => '',
               'type'    => 'radio',
               'switch'  => false,
               'valList' => array($sTmpValue),
               'colNum'  => 2,
               'optComp'  => $sOptComp,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['hotel_telefone_quarto']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['hotel_telefone_quarto']['valList'][$i] = form_tbl_hoteis_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['hotel_telefone_quarto']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['hotel_telefone_quarto']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['hotel_telefone_quarto']['labList'] = $aLabel;
          }
   }

          //----- hotel_tv
   function ajax_return_values_hotel_tv($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_tv", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_tv);
              $aLookup = array();
              $this->_tmp_lookup_hotel_tv = $this->hotel_tv;

$aLookup[] = array(form_tbl_hoteis_pack_protect_string('Y') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Sim")));
$aLookup[] = array(form_tbl_hoteis_pack_protect_string('N') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Não")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_tv'][] = 'Y';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_tv'][] = 'N';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['hotel_tv']) && !empty($this->NM_ajax_info['select_html']['hotel_tv']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['hotel_tv']);
          }
          $this->NM_ajax_info['fldList']['hotel_tv'] = array(
                       'row'    => '',
               'type'    => 'radio',
               'switch'  => false,
               'valList' => array($sTmpValue),
               'colNum'  => 2,
               'optComp'  => $sOptComp,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['hotel_tv']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['hotel_tv']['valList'][$i] = form_tbl_hoteis_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['hotel_tv']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['hotel_tv']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['hotel_tv']['labList'] = $aLabel;
          }
   }

          //----- hotel_ginastica
   function ajax_return_values_hotel_ginastica($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_ginastica", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_ginastica);
              $aLookup = array();
              $this->_tmp_lookup_hotel_ginastica = $this->hotel_ginastica;

$aLookup[] = array(form_tbl_hoteis_pack_protect_string('Y') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Sim")));
$aLookup[] = array(form_tbl_hoteis_pack_protect_string('N') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Não")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_ginastica'][] = 'Y';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_ginastica'][] = 'N';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['hotel_ginastica']) && !empty($this->NM_ajax_info['select_html']['hotel_ginastica']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['hotel_ginastica']);
          }
          $this->NM_ajax_info['fldList']['hotel_ginastica'] = array(
                       'row'    => '',
               'type'    => 'radio',
               'switch'  => false,
               'valList' => array($sTmpValue),
               'colNum'  => 2,
               'optComp'  => $sOptComp,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['hotel_ginastica']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['hotel_ginastica']['valList'][$i] = form_tbl_hoteis_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['hotel_ginastica']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['hotel_ginastica']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['hotel_ginastica']['labList'] = $aLabel;
          }
   }

          //----- hotel_restaurante
   function ajax_return_values_hotel_restaurante($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_restaurante", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_restaurante);
              $aLookup = array();
              $this->_tmp_lookup_hotel_restaurante = $this->hotel_restaurante;

$aLookup[] = array(form_tbl_hoteis_pack_protect_string('Y') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Sim")));
$aLookup[] = array(form_tbl_hoteis_pack_protect_string('N') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Não")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_restaurante'][] = 'Y';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_restaurante'][] = 'N';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['hotel_restaurante']) && !empty($this->NM_ajax_info['select_html']['hotel_restaurante']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['hotel_restaurante']);
          }
          $this->NM_ajax_info['fldList']['hotel_restaurante'] = array(
                       'row'    => '',
               'type'    => 'radio',
               'switch'  => false,
               'valList' => array($sTmpValue),
               'colNum'  => 2,
               'optComp'  => $sOptComp,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['hotel_restaurante']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['hotel_restaurante']['valList'][$i] = form_tbl_hoteis_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['hotel_restaurante']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['hotel_restaurante']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['hotel_restaurante']['labList'] = $aLabel;
          }
   }

          //----- hotel_bar
   function ajax_return_values_hotel_bar($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_bar", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_bar);
              $aLookup = array();
              $this->_tmp_lookup_hotel_bar = $this->hotel_bar;

$aLookup[] = array(form_tbl_hoteis_pack_protect_string('Y') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Sim")));
$aLookup[] = array(form_tbl_hoteis_pack_protect_string('N') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Não")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_bar'][] = 'Y';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_bar'][] = 'N';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['hotel_bar']) && !empty($this->NM_ajax_info['select_html']['hotel_bar']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['hotel_bar']);
          }
          $this->NM_ajax_info['fldList']['hotel_bar'] = array(
                       'row'    => '',
               'type'    => 'radio',
               'switch'  => false,
               'valList' => array($sTmpValue),
               'colNum'  => 2,
               'optComp'  => $sOptComp,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['hotel_bar']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['hotel_bar']['valList'][$i] = form_tbl_hoteis_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['hotel_bar']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['hotel_bar']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['hotel_bar']['labList'] = $aLabel;
          }
   }

          //----- hotel_estacionamento
   function ajax_return_values_hotel_estacionamento($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_estacionamento", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_estacionamento);
              $aLookup = array();
              $this->_tmp_lookup_hotel_estacionamento = $this->hotel_estacionamento;

$aLookup[] = array(form_tbl_hoteis_pack_protect_string('Y') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Sim")));
$aLookup[] = array(form_tbl_hoteis_pack_protect_string('N') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Não")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_estacionamento'][] = 'Y';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_estacionamento'][] = 'N';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['hotel_estacionamento']) && !empty($this->NM_ajax_info['select_html']['hotel_estacionamento']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['hotel_estacionamento']);
          }
          $this->NM_ajax_info['fldList']['hotel_estacionamento'] = array(
                       'row'    => '',
               'type'    => 'radio',
               'switch'  => false,
               'valList' => array($sTmpValue),
               'colNum'  => 2,
               'optComp'  => $sOptComp,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['hotel_estacionamento']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['hotel_estacionamento']['valList'][$i] = form_tbl_hoteis_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['hotel_estacionamento']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['hotel_estacionamento']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['hotel_estacionamento']['labList'] = $aLabel;
          }
   }

          //----- hotel_sauna
   function ajax_return_values_hotel_sauna($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_sauna", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_sauna);
              $aLookup = array();
              $this->_tmp_lookup_hotel_sauna = $this->hotel_sauna;

$aLookup[] = array(form_tbl_hoteis_pack_protect_string('Y') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Sim")));
$aLookup[] = array(form_tbl_hoteis_pack_protect_string('N') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Não")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_sauna'][] = 'Y';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_sauna'][] = 'N';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['hotel_sauna']) && !empty($this->NM_ajax_info['select_html']['hotel_sauna']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['hotel_sauna']);
          }
          $this->NM_ajax_info['fldList']['hotel_sauna'] = array(
                       'row'    => '',
               'type'    => 'radio',
               'switch'  => false,
               'valList' => array($sTmpValue),
               'colNum'  => 2,
               'optComp'  => $sOptComp,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['hotel_sauna']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['hotel_sauna']['valList'][$i] = form_tbl_hoteis_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['hotel_sauna']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['hotel_sauna']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['hotel_sauna']['labList'] = $aLabel;
          }
   }

          //----- hotel_piscina
   function ajax_return_values_hotel_piscina($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_piscina", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_piscina);
              $aLookup = array();
              $this->_tmp_lookup_hotel_piscina = $this->hotel_piscina;

$aLookup[] = array(form_tbl_hoteis_pack_protect_string('Y') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Sim")));
$aLookup[] = array(form_tbl_hoteis_pack_protect_string('N') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Não")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_piscina'][] = 'Y';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_piscina'][] = 'N';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['hotel_piscina']) && !empty($this->NM_ajax_info['select_html']['hotel_piscina']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['hotel_piscina']);
          }
          $this->NM_ajax_info['fldList']['hotel_piscina'] = array(
                       'row'    => '',
               'type'    => 'radio',
               'switch'  => false,
               'valList' => array($sTmpValue),
               'colNum'  => 2,
               'optComp'  => $sOptComp,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['hotel_piscina']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['hotel_piscina']['valList'][$i] = form_tbl_hoteis_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['hotel_piscina']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['hotel_piscina']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['hotel_piscina']['labList'] = $aLabel;
          }
   }

          //----- hotel_wifi
   function ajax_return_values_hotel_wifi($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_wifi", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_wifi);
              $aLookup = array();
              $this->_tmp_lookup_hotel_wifi = $this->hotel_wifi;

$aLookup[] = array(form_tbl_hoteis_pack_protect_string('Y') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Sim")));
$aLookup[] = array(form_tbl_hoteis_pack_protect_string('N') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Não")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_wifi'][] = 'Y';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_wifi'][] = 'N';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['hotel_wifi']) && !empty($this->NM_ajax_info['select_html']['hotel_wifi']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['hotel_wifi']);
          }
          $this->NM_ajax_info['fldList']['hotel_wifi'] = array(
                       'row'    => '',
               'type'    => 'radio',
               'switch'  => false,
               'valList' => array($sTmpValue),
               'colNum'  => 2,
               'optComp'  => $sOptComp,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['hotel_wifi']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['hotel_wifi']['valList'][$i] = form_tbl_hoteis_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['hotel_wifi']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['hotel_wifi']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['hotel_wifi']['labList'] = $aLabel;
          }
   }

          //----- hotel_computador
   function ajax_return_values_hotel_computador($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_computador", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_computador);
              $aLookup = array();
              $this->_tmp_lookup_hotel_computador = $this->hotel_computador;

$aLookup[] = array(form_tbl_hoteis_pack_protect_string('Y') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Sim")));
$aLookup[] = array(form_tbl_hoteis_pack_protect_string('N') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Não")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_computador'][] = 'Y';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_computador'][] = 'N';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['hotel_computador']) && !empty($this->NM_ajax_info['select_html']['hotel_computador']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['hotel_computador']);
          }
          $this->NM_ajax_info['fldList']['hotel_computador'] = array(
                       'row'    => '',
               'type'    => 'radio',
               'switch'  => false,
               'valList' => array($sTmpValue),
               'colNum'  => 2,
               'optComp'  => $sOptComp,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['hotel_computador']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['hotel_computador']['valList'][$i] = form_tbl_hoteis_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['hotel_computador']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['hotel_computador']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['hotel_computador']['labList'] = $aLabel;
          }
   }

          //----- hotel_convencoes
   function ajax_return_values_hotel_convencoes($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_convencoes", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_convencoes);
              $aLookup = array();
              $this->_tmp_lookup_hotel_convencoes = $this->hotel_convencoes;

$aLookup[] = array(form_tbl_hoteis_pack_protect_string('Y') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Sim")));
$aLookup[] = array(form_tbl_hoteis_pack_protect_string('N') => str_replace('<', '&lt;',form_tbl_hoteis_pack_protect_string("Não")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_convencoes'][] = 'Y';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_convencoes'][] = 'N';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['hotel_convencoes']) && !empty($this->NM_ajax_info['select_html']['hotel_convencoes']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['hotel_convencoes']);
          }
          $this->NM_ajax_info['fldList']['hotel_convencoes'] = array(
                       'row'    => '',
               'type'    => 'radio',
               'switch'  => false,
               'valList' => array($sTmpValue),
               'colNum'  => 2,
               'optComp'  => $sOptComp,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['hotel_convencoes']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['hotel_convencoes']['valList'][$i] = form_tbl_hoteis_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['hotel_convencoes']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['hotel_convencoes']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['hotel_convencoes']['labList'] = $aLabel;
          }
   }

          //----- hotel_cod_estrangeiro
   function ajax_return_values_hotel_cod_estrangeiro($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hotel_cod_estrangeiro", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->hotel_cod_estrangeiro);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['hotel_cod_estrangeiro'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

    function fetchUniqueUploadName($originalName, $uploadDir, $fieldName)
    {
        $originalName = trim($originalName);
        if ('' == $originalName)
        {
            return $originalName;
        }
        if (!@is_dir($uploadDir))
        {
            return $originalName;
        }
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['upload_dir'][$fieldName][] = $newName;
            $this->Upload_refresh_fields[] = $fieldName;
            return $newName;
        }
    } // fetchUniqueUploadName

    function fetchFileNextName($uniqueName, $uniqueList)
    {
        $aPathinfo     = pathinfo($uniqueName);
        $fileExtension = $aPathinfo['extension'];
        $fileName      = $aPathinfo['filename'];
        $foundName     = false;
        $nameIt        = 1;
        if ('' != $fileExtension)
        {
            $fileExtension = '.' . $fileExtension;
        }
        while (!$foundName)
        {
            $testName = $fileName . '(' . $nameIt . ')' . $fileExtension;
            if (in_array($testName, $uniqueList))
            {
                $nameIt++;
            }
            else
            {
                $foundName = true;
                return $testName;
            }
        }
    } // fetchFileNextName

   function ajax_add_parameters()
   {
       $this->NM_ajax_info['summary_line'] = $this->getSummaryLine();
   } // ajax_add_parameters
  function nm_proc_onload($bFormat = true)
  {
      $Ctrl_Proc_Onload = true;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Field_no_validate'] = array();
      if (!$this->NM_ajax_flag || !isset($this->nmgp_refresh_fields)) {
      $_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_hotel_bairro = $this->hotel_bairro;
    $original_hotel_cep = $this->hotel_cep;
    $original_hotel_id = $this->hotel_id;
    $original_hotel_logradouro = $this->hotel_logradouro;
    $original_hotel_municipio = $this->hotel_municipio;
    $original_hotel_numero = $this->hotel_numero;
    $original_localizacao = $this->localizacao;
}
  date_default_timezone_set('America/Sao_Paulo');
$cep = $this->hotel_cep ;
$rua = $this->hotel_logradouro ;
$num = $this->hotel_numero ;
$bairro = $this->hotel_bairro ;
$cid = $this->hotel_municipio ;

$this->localizacao  = 'http://maps.google.com.br/maps?hl=pt-BR&tab=wl&q='.$rua.','.$num.','.$bairro.','.$cid;



$campo_count   = 'o.hotel_id'; 
$tabela_origem = 'tbl_hoteis';
$tabela_join01 = 'transfer_rsvp';
$tabela_join02 = 'hospedagem_rsvp';
$campo_join01  = 'a.tra_id_hotel';
$campo_compara = 'o.hotel_id';
$campo_join03  = 'b.hosp_id_hotel';

$campo_count	= $this->Db->qstr($campo_count);
$tabela_origem	= $this->Db->qstr($tabela_origem);
$tabela_join01	= $this->Db->qstr($tabela_join01);
$campo_join01	= $this->Db->qstr($campo_join01);
$campo_compara	= $this->Db->qstr($campo_compara);
$campo_join03	= $this->Db->qstr($campo_join03);
	
$sql = "
	SELECT 
		COUNT(DISTINCT $campo_count) AS xqtde
	FROM
		$tabela_origem as o
	LEFT JOIN 
		$tabela_join01 a ON $campo_join01 = $campo_compara
	LEFT JOIN 
		$tabela_join02 b ON $campo_join03 = $campo_compara
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
	$xqtde = $this->rs[0][0];
} else {
	$xqtde = 0;
}

$sql = "
	SELECT
		hosp_id_hotel
	FROM
		hospedagem_rsvp
	WHERE
		hosp_id_hotel = ".$this->Db->qstr($this->hotel_id )."
	ORDER BY
		hosp_id_hotel
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
	$this->NM_ajax_info['buttonDisplay']['delete'] = $this->nmgp_botoes["delete"] = 'off';;
} else {
	$this->NM_ajax_info['buttonDisplay']['delete'] = $this->nmgp_botoes["delete"] = 'on';;
}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (isset($Ctrl_Proc_Onload) && $Ctrl_Proc_Onload) {
        $Ctrl_Format = true;
        $this->nm_guardar_campos();
        if ($bFormat) $this->nm_formatar_campos();
    }
    if (($original_hotel_bairro != $this->hotel_bairro || (isset($bFlagRead_hotel_bairro) && $bFlagRead_hotel_bairro)))
    {
        $this->ajax_return_values_hotel_bairro(true);
    }
    if (($original_hotel_cep != $this->hotel_cep || (isset($bFlagRead_hotel_cep) && $bFlagRead_hotel_cep)))
    {
        $this->ajax_return_values_hotel_cep(true);
    }
    if (($original_hotel_id != $this->hotel_id || (isset($bFlagRead_hotel_id) && $bFlagRead_hotel_id)))
    {
        $this->ajax_return_values_hotel_id(true);
    }
    if (($original_hotel_logradouro != $this->hotel_logradouro || (isset($bFlagRead_hotel_logradouro) && $bFlagRead_hotel_logradouro)))
    {
        $this->ajax_return_values_hotel_logradouro(true);
    }
    if (($original_hotel_municipio != $this->hotel_municipio || (isset($bFlagRead_hotel_municipio) && $bFlagRead_hotel_municipio)))
    {
        $this->ajax_return_values_hotel_municipio(true);
    }
    if (($original_hotel_numero != $this->hotel_numero || (isset($bFlagRead_hotel_numero) && $bFlagRead_hotel_numero)))
    {
        $this->ajax_return_values_hotel_numero(true);
    }
    if (($original_localizacao != $this->localizacao || (isset($bFlagRead_localizacao) && $bFlagRead_localizacao)))
    {
        $this->ajax_return_values_localizacao(true);
    }
}
$_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'off'; 
      }
      if (!isset($Ctrl_Format) || !$Ctrl_Format) {
          $this->nm_guardar_campos();
          if ($bFormat) $this->nm_formatar_campos();
      }
  }
//
//----------------------------------------------------
//-----> 
//----------------------------------------------------
//----------- 


   function temRegistros($sWhere)
   {
       if ('' == $sWhere)
       {
           return false;
       }
       $nmgp_sel_count = 'SELECT COUNT(*) AS countTest FROM ' . $this->Ini->nm_tabela . ' WHERE ' . $sWhere;
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count; 
       $rsc = $this->Db->Execute($nmgp_sel_count); 
       if ($rsc === false && !$rsc->EOF)
       {
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg());
           exit; 
       }
       $iTotal = $rsc->fields[0];
       $rsc->Close();
       return 0 < $iTotal;
   } // temRegistros

   function deletaRegistros($sWhere)
   {
       if ('' == $sWhere)
       {
           return false;
       }
       $nmgp_sel_count = 'DELETE FROM ' . $this->Ini->nm_tabela . ' WHERE ' . $sWhere;
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count; 
       $rsc = $this->Db->Execute($nmgp_sel_count); 
       $bResult = $rsc;
       $rsc->Close();
       return $bResult == true;
   } // deletaRegistros
    function handleDbErrorMessage(&$dbErrorMessage, $dbErrorCode)
    {
        if (1267 == $dbErrorCode) {
            $dbErrorMessage = $this->Ini->Nm_lang['lang_errm_db_invalid_collation'];
        }
    }

   function restore_zeros_null()
   {
      if (!empty($this->sc_force_zero))
      {
          foreach ($this->sc_force_zero as $i_force_zero => $sc_force_zero_field)
          {
              eval('if ($this->' . $sc_force_zero_field . ' == 0) {$this->' . $sc_force_zero_field . ' = "";}');
          }
      }
      $this->sc_force_zero = array();
      if (!empty($this->NM_val_null))
      {
          foreach ($this->NM_val_null as $i_val_null => $sc_val_null_field)
          {
              eval('$this->' . $sc_val_null_field . ' = "";');
          }
      }
      $this->NM_val_null = array();
   }

   function nm_acessa_banco() 
   { 
      global  $nm_form_submit, $teste_validade, $sc_where;
 
      $this->NM_val_null = array();
      $NM_val_form = array();
      $this->sc_erro_insert = "";
      $this->sc_erro_update = "";
      $this->sc_erro_delete = "";
      $this->restore_zeros_null();
    if ("incluir" == $this->nmgp_opcao) {
      $this->sc_evento = $this->nmgp_opcao;
      $_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_hotel_cep = $this->hotel_cep;
    $original_hotel_pais = $this->hotel_pais;
}
  date_default_timezone_set('America/Sao_Paulo');
if ($this->hotel_cep  <> '' && $this->hotel_pais  == '') {
	$this->hotel_pais  = 'BRASIL';
}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (isset($Ctrl_Proc_Onload) && $Ctrl_Proc_Onload) {
        $Ctrl_Format = true;
        $this->nm_guardar_campos();
        if ($bFormat) $this->nm_formatar_campos();
    }
    if (($original_hotel_cep != $this->hotel_cep || (isset($bFlagRead_hotel_cep) && $bFlagRead_hotel_cep)))
    {
        $this->ajax_return_values_hotel_cep(true);
    }
    if (($original_hotel_pais != $this->hotel_pais || (isset($bFlagRead_hotel_pais) && $bFlagRead_hotel_pais)))
    {
        $this->ajax_return_values_hotel_pais(true);
    }
}
$_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'off'; 
    }
    if ("alterar" == $this->nmgp_opcao) {
      $this->sc_evento = $this->nmgp_opcao;
      $_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_hotel_cep = $this->hotel_cep;
    $original_hotel_pais = $this->hotel_pais;
}
  date_default_timezone_set('America/Sao_Paulo');
if ($this->hotel_cep  <> '' && $this->hotel_pais  == '') {
	$this->hotel_pais  = 'BRASIL';
}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (isset($Ctrl_Proc_Onload) && $Ctrl_Proc_Onload) {
        $Ctrl_Format = true;
        $this->nm_guardar_campos();
        if ($bFormat) $this->nm_formatar_campos();
    }
    if (($original_hotel_cep != $this->hotel_cep || (isset($bFlagRead_hotel_cep) && $bFlagRead_hotel_cep)))
    {
        $this->ajax_return_values_hotel_cep(true);
    }
    if (($original_hotel_pais != $this->hotel_pais || (isset($bFlagRead_hotel_pais) && $bFlagRead_hotel_pais)))
    {
        $this->ajax_return_values_hotel_pais(true);
    }
}
$_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'off'; 
    }
      if (!empty($this->Campos_Mens_erro)) 
      {
          $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro); 
          $this->Campos_Mens_erro = ""; 
          $this->nmgp_opc_ant = $this->nmgp_opcao ; 
          if ($this->nmgp_opcao == "incluir") 
          { 
              $GLOBALS["erro_incl"] = 1; 
          }
          else
          { 
              $this->sc_evento = ""; 
          }
          if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir" || $this->nmgp_opcao == "excluir") 
          {
              $this->nmgp_opcao = "nada"; 
          } 
          $this->NM_rollback_db(); 
          $this->Campos_Mens_erro = ""; 
      }
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $salva_opcao = $this->nmgp_opcao; 
      if ($this->sc_evento != "novo" && $this->sc_evento != "incluir") 
      { 
          $this->sc_evento = ""; 
      } 
      if ((!isset($this->Ini->nm_bases_access) || !in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) && !$this->Ini->sc_tem_trans_banco && in_array($this->nmgp_opcao, array('excluir', 'incluir', 'alterar')))
      { 
          $this->Ini->sc_tem_trans_banco = $this->Db->BeginTrans(); 
      } 
      $NM_val_form['hotel_id'] = $this->hotel_id;
      $NM_val_form['hotel_cnpj'] = $this->hotel_cnpj;
      $NM_val_form['hotel_fantasia'] = $this->hotel_fantasia;
      $NM_val_form['hotel_razsoc'] = $this->hotel_razsoc;
      $NM_val_form['hotel_descricao'] = $this->hotel_descricao;
      $NM_val_form['hotel_rede'] = $this->hotel_rede;
      $NM_val_form['hotel_classificacao'] = $this->hotel_classificacao;
      $NM_val_form['hotel_categoria'] = $this->hotel_categoria;
      $NM_val_form['hotel_logo'] = $this->hotel_logo;
      $NM_val_form['hotel_cep'] = $this->hotel_cep;
      $NM_val_form['hotel_pais'] = $this->hotel_pais;
      $NM_val_form['hotel_uf'] = $this->hotel_uf;
      $NM_val_form['hotel_municipio'] = $this->hotel_municipio;
      $NM_val_form['hotel_bairro'] = $this->hotel_bairro;
      $NM_val_form['hotel_logradouro'] = $this->hotel_logradouro;
      $NM_val_form['hotel_numero'] = $this->hotel_numero;
      $NM_val_form['hotel_complemento'] = $this->hotel_complemento;
      $NM_val_form['localizacao'] = $this->localizacao;
      $NM_val_form['hotel_observacoes'] = $this->hotel_observacoes;
      $NM_val_form['hotel_email'] = $this->hotel_email;
      $NM_val_form['hotel_website'] = $this->hotel_website;
      $NM_val_form['hotel_telefone'] = $this->hotel_telefone;
      $NM_val_form['hotel_fax'] = $this->hotel_fax;
      $NM_val_form['hotel_celular'] = $this->hotel_celular;
      $NM_val_form['hotel_status'] = $this->hotel_status;
      $NM_val_form['hotel_facebook'] = $this->hotel_facebook;
      $NM_val_form['hotel_twitter'] = $this->hotel_twitter;
      $NM_val_form['hotel_skype'] = $this->hotel_skype;
      $NM_val_form['hotel_ar_condicionado'] = $this->hotel_ar_condicionado;
      $NM_val_form['hotel_frigobar'] = $this->hotel_frigobar;
      $NM_val_form['hotel_lavanderia'] = $this->hotel_lavanderia;
      $NM_val_form['hotel_telefone_quarto'] = $this->hotel_telefone_quarto;
      $NM_val_form['hotel_tv'] = $this->hotel_tv;
      $NM_val_form['hotel_ginastica'] = $this->hotel_ginastica;
      $NM_val_form['hotel_restaurante'] = $this->hotel_restaurante;
      $NM_val_form['hotel_bar'] = $this->hotel_bar;
      $NM_val_form['hotel_estacionamento'] = $this->hotel_estacionamento;
      $NM_val_form['hotel_sauna'] = $this->hotel_sauna;
      $NM_val_form['hotel_piscina'] = $this->hotel_piscina;
      $NM_val_form['hotel_wifi'] = $this->hotel_wifi;
      $NM_val_form['hotel_computador'] = $this->hotel_computador;
      $NM_val_form['hotel_convencoes'] = $this->hotel_convencoes;
      $NM_val_form['hotel_cod_estrangeiro'] = $this->hotel_cod_estrangeiro;
      $NM_val_form['rodape'] = $this->rodape;
      if ($this->hotel_id === "" || is_null($this->hotel_id))  
      { 
          $this->hotel_id = 0;
      } 
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_oracle, $this->Ini->nm_bases_ibase, $this->Ini->nm_bases_informix, $this->Ini->nm_bases_mysql, $this->Ini->nm_bases_access, $this->Ini->nm_bases_sqlite, $this->Ini->nm_bases_db2, array('pdo_sqlsrv'));
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          $this->hotel_cnpj_before_qstr = $this->hotel_cnpj;
          $this->hotel_cnpj = substr($this->Db->qstr($this->hotel_cnpj), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hotel_cnpj = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hotel_cnpj);
          }
          if ($this->hotel_cnpj == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_cnpj = "null"; 
              $this->NM_val_null[] = "hotel_cnpj";
          } 
          $this->hotel_fantasia_before_qstr = $this->hotel_fantasia;
          $this->hotel_fantasia = substr($this->Db->qstr($this->hotel_fantasia), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hotel_fantasia = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hotel_fantasia);
          }
          if ($this->hotel_fantasia == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_fantasia = "null"; 
              $this->NM_val_null[] = "hotel_fantasia";
          } 
          $this->hotel_razsoc_before_qstr = $this->hotel_razsoc;
          $this->hotel_razsoc = substr($this->Db->qstr($this->hotel_razsoc), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hotel_razsoc = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hotel_razsoc);
          }
          if ($this->hotel_razsoc == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_razsoc = "null"; 
              $this->NM_val_null[] = "hotel_razsoc";
          } 
          $this->hotel_descricao_before_qstr = $this->hotel_descricao;
          $this->hotel_descricao = substr($this->Db->qstr($this->hotel_descricao), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hotel_descricao = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hotel_descricao);
          }
          if ($this->hotel_descricao == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_descricao = "null"; 
              $this->NM_val_null[] = "hotel_descricao";
          } 
          $this->hotel_rede_before_qstr = $this->hotel_rede;
          $this->hotel_rede = substr($this->Db->qstr($this->hotel_rede), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hotel_rede = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hotel_rede);
          }
          if ($this->hotel_rede == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_rede = "null"; 
              $this->NM_val_null[] = "hotel_rede";
          } 
          $this->hotel_cep_before_qstr = $this->hotel_cep;
          $this->hotel_cep = substr($this->Db->qstr($this->hotel_cep), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hotel_cep = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hotel_cep);
          }
          if ($this->hotel_cep == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_cep = "null"; 
              $this->NM_val_null[] = "hotel_cep";
          } 
          $this->hotel_pais_before_qstr = $this->hotel_pais;
          $this->hotel_pais = substr($this->Db->qstr($this->hotel_pais), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hotel_pais = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hotel_pais);
          }
          if ($this->hotel_pais == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_pais = "null"; 
              $this->NM_val_null[] = "hotel_pais";
          } 
          $this->hotel_uf_before_qstr = $this->hotel_uf;
          $this->hotel_uf = substr($this->Db->qstr($this->hotel_uf), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hotel_uf = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hotel_uf);
          }
          if ($this->hotel_uf == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_uf = "null"; 
              $this->NM_val_null[] = "hotel_uf";
          } 
          $this->hotel_municipio_before_qstr = $this->hotel_municipio;
          $this->hotel_municipio = substr($this->Db->qstr($this->hotel_municipio), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hotel_municipio = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hotel_municipio);
          }
          if ($this->hotel_municipio == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_municipio = "null"; 
              $this->NM_val_null[] = "hotel_municipio";
          } 
          $this->hotel_bairro_before_qstr = $this->hotel_bairro;
          $this->hotel_bairro = substr($this->Db->qstr($this->hotel_bairro), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hotel_bairro = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hotel_bairro);
          }
          if ($this->hotel_bairro == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_bairro = "null"; 
              $this->NM_val_null[] = "hotel_bairro";
          } 
          $this->hotel_logradouro_before_qstr = $this->hotel_logradouro;
          $this->hotel_logradouro = substr($this->Db->qstr($this->hotel_logradouro), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hotel_logradouro = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hotel_logradouro);
          }
          if ($this->hotel_logradouro == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_logradouro = "null"; 
              $this->NM_val_null[] = "hotel_logradouro";
          } 
          $this->hotel_numero_before_qstr = $this->hotel_numero;
          $this->hotel_numero = substr($this->Db->qstr($this->hotel_numero), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hotel_numero = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hotel_numero);
          }
          if ($this->hotel_numero == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_numero = "null"; 
              $this->NM_val_null[] = "hotel_numero";
          } 
          $this->hotel_complemento_before_qstr = $this->hotel_complemento;
          $this->hotel_complemento = substr($this->Db->qstr($this->hotel_complemento), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hotel_complemento = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hotel_complemento);
          }
          if ($this->hotel_complemento == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_complemento = "null"; 
              $this->NM_val_null[] = "hotel_complemento";
          } 
          $this->hotel_email_before_qstr = $this->hotel_email;
          $this->hotel_email = substr($this->Db->qstr($this->hotel_email), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hotel_email = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hotel_email);
          }
          if ($this->hotel_email == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_email = "null"; 
              $this->NM_val_null[] = "hotel_email";
          } 
          $this->hotel_telefone_before_qstr = $this->hotel_telefone;
          $this->hotel_telefone = substr($this->Db->qstr($this->hotel_telefone), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hotel_telefone = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hotel_telefone);
          }
          if ($this->hotel_telefone == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_telefone = "null"; 
              $this->NM_val_null[] = "hotel_telefone";
          } 
          $this->hotel_fax_before_qstr = $this->hotel_fax;
          $this->hotel_fax = substr($this->Db->qstr($this->hotel_fax), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hotel_fax = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hotel_fax);
          }
          if ($this->hotel_fax == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_fax = "null"; 
              $this->NM_val_null[] = "hotel_fax";
          } 
          $this->hotel_celular_before_qstr = $this->hotel_celular;
          $this->hotel_celular = substr($this->Db->qstr($this->hotel_celular), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hotel_celular = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hotel_celular);
          }
          if ($this->hotel_celular == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_celular = "null"; 
              $this->NM_val_null[] = "hotel_celular";
          } 
          $this->hotel_website_before_qstr = $this->hotel_website;
          $this->hotel_website = substr($this->Db->qstr($this->hotel_website), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hotel_website = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hotel_website);
          }
          if ($this->hotel_website == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_website = "null"; 
              $this->NM_val_null[] = "hotel_website";
          } 
          if ($this->hotel_status == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_status = "null"; 
              $this->NM_val_null[] = "hotel_status";
          } 
          $this->hotel_facebook_before_qstr = $this->hotel_facebook;
          $this->hotel_facebook = substr($this->Db->qstr($this->hotel_facebook), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hotel_facebook = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hotel_facebook);
          }
          if ($this->hotel_facebook == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_facebook = "null"; 
              $this->NM_val_null[] = "hotel_facebook";
          } 
          $this->hotel_twitter_before_qstr = $this->hotel_twitter;
          $this->hotel_twitter = substr($this->Db->qstr($this->hotel_twitter), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hotel_twitter = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hotel_twitter);
          }
          if ($this->hotel_twitter == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_twitter = "null"; 
              $this->NM_val_null[] = "hotel_twitter";
          } 
          $this->hotel_skype_before_qstr = $this->hotel_skype;
          $this->hotel_skype = substr($this->Db->qstr($this->hotel_skype), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hotel_skype = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hotel_skype);
          }
          if ($this->hotel_skype == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_skype = "null"; 
              $this->NM_val_null[] = "hotel_skype";
          } 
          if ($this->hotel_ar_condicionado == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_ar_condicionado = "null"; 
              $this->NM_val_null[] = "hotel_ar_condicionado";
          } 
          if ($this->hotel_frigobar == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_frigobar = "null"; 
              $this->NM_val_null[] = "hotel_frigobar";
          } 
          if ($this->hotel_lavanderia == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_lavanderia = "null"; 
              $this->NM_val_null[] = "hotel_lavanderia";
          } 
          if ($this->hotel_telefone_quarto == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_telefone_quarto = "null"; 
              $this->NM_val_null[] = "hotel_telefone_quarto";
          } 
          if ($this->hotel_tv == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_tv = "null"; 
              $this->NM_val_null[] = "hotel_tv";
          } 
          if ($this->hotel_ginastica == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_ginastica = "null"; 
              $this->NM_val_null[] = "hotel_ginastica";
          } 
          if ($this->hotel_restaurante == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_restaurante = "null"; 
              $this->NM_val_null[] = "hotel_restaurante";
          } 
          if ($this->hotel_bar == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_bar = "null"; 
              $this->NM_val_null[] = "hotel_bar";
          } 
          if ($this->hotel_estacionamento == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_estacionamento = "null"; 
              $this->NM_val_null[] = "hotel_estacionamento";
          } 
          if ($this->hotel_sauna == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_sauna = "null"; 
              $this->NM_val_null[] = "hotel_sauna";
          } 
          if ($this->hotel_piscina == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_piscina = "null"; 
              $this->NM_val_null[] = "hotel_piscina";
          } 
          if ($this->hotel_wifi == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_wifi = "null"; 
              $this->NM_val_null[] = "hotel_wifi";
          } 
          if ($this->hotel_computador == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_computador = "null"; 
              $this->NM_val_null[] = "hotel_computador";
          } 
          if ($this->hotel_convencoes == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_convencoes = "null"; 
              $this->NM_val_null[] = "hotel_convencoes";
          } 
          $this->hotel_observacoes_before_qstr = $this->hotel_observacoes;
          $this->hotel_observacoes = substr($this->Db->qstr($this->hotel_observacoes), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hotel_observacoes = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hotel_observacoes);
          }
          if ($this->hotel_observacoes == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_observacoes = "null"; 
              $this->NM_val_null[] = "hotel_observacoes";
          } 
          $this->hotel_classificacao_before_qstr = $this->hotel_classificacao;
          $this->hotel_classificacao = substr($this->Db->qstr($this->hotel_classificacao), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hotel_classificacao = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hotel_classificacao);
          }
          if ($this->hotel_classificacao == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_classificacao = "null"; 
              $this->NM_val_null[] = "hotel_classificacao";
          } 
          $this->hotel_categoria_before_qstr = $this->hotel_categoria;
          $this->hotel_categoria = substr($this->Db->qstr($this->hotel_categoria), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hotel_categoria = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hotel_categoria);
          }
          if ($this->hotel_categoria == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_categoria = "null"; 
              $this->NM_val_null[] = "hotel_categoria";
          } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          { 
              $nm_tmp = nm_conv_img_access(substr($this->hotel_logo, 0, 12));
              if (is_string($this->hotel_logo) && substr($this->hotel_logo, 0, 4) != "*nm*" && is_string($nm_tmp) && substr($nm_tmp, 0, 4) == "*nm*") 
              { 
                  $this->hotel_logo = nm_conv_img_access($this->hotel_logo);
              } 
              if (!empty($this->hotel_logo) && $this->hotel_logo != 'null' && substr($this->hotel_logo, 0, 4) != "*nm*") 
              { 
                  $this->hotel_logo = "*nm*" . base64_encode($this->hotel_logo) ; 
              } 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              if ($this->Ini->nm_tpbanco != "pdo_sqlsrv" && !empty($this->hotel_logo) && $this->hotel_logo != 'null' && substr($this->hotel_logo, 0, 4) != "*nm*") 
              { 
                  $this->hotel_logo = "*nm*" . base64_encode($this->hotel_logo) ; 
              } 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
          { 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          { }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          { }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          { }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          { }
          else
          { 
              $this->hotel_logo =  substr($this->Db->qstr($this->hotel_logo), 1, -1);
          } 
          if ($this->hotel_logo == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_logo = "null"; 
              $this->NM_val_null[] = "hotel_logo";
          } 
          $this->hotel_cod_estrangeiro_before_qstr = $this->hotel_cod_estrangeiro;
          $this->hotel_cod_estrangeiro = substr($this->Db->qstr($this->hotel_cod_estrangeiro), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hotel_cod_estrangeiro = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hotel_cod_estrangeiro);
          }
          if ($this->hotel_cod_estrangeiro == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hotel_cod_estrangeiro = "null"; 
              $this->NM_val_null[] = "hotel_cod_estrangeiro";
          } 
      }
      if ($this->nmgp_opcao == "alterar") 
      {
          $SC_fields_update = array(); 
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 form_tbl_hoteis_pack_ajax_response();
              }
              exit; 
          }  
          $bUpdateOk = true;
          $tmp_result = (int) $rs1->fields[0]; 
          if ($tmp_result != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_nfnd']); 
              $this->nmgp_opcao = "nada"; 
              $bUpdateOk = false;
              $this->sc_evento = 'update';
          } 
          $aUpdateOk = array();
          $bUpdateOk = $bUpdateOk && empty($aUpdateOk);
          if ($bUpdateOk)
          { 
              $rs1->Close(); 
              $aDoNotUpdate = array();
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "hotel_cnpj = '$this->hotel_cnpj', hotel_fantasia = '$this->hotel_fantasia', hotel_razsoc = '$this->hotel_razsoc', hotel_descricao = '$this->hotel_descricao', hotel_rede = '$this->hotel_rede', hotel_cep = '$this->hotel_cep', hotel_pais = '$this->hotel_pais', hotel_uf = '$this->hotel_uf', hotel_municipio = '$this->hotel_municipio', hotel_bairro = '$this->hotel_bairro', hotel_logradouro = '$this->hotel_logradouro', hotel_numero = '$this->hotel_numero', hotel_complemento = '$this->hotel_complemento', hotel_email = '$this->hotel_email', hotel_telefone = '$this->hotel_telefone', hotel_fax = '$this->hotel_fax', hotel_celular = '$this->hotel_celular', hotel_website = '$this->hotel_website', hotel_status = '$this->hotel_status', hotel_facebook = '$this->hotel_facebook', hotel_twitter = '$this->hotel_twitter', hotel_skype = '$this->hotel_skype', hotel_ar_condicionado = '$this->hotel_ar_condicionado', hotel_frigobar = '$this->hotel_frigobar', hotel_lavanderia = '$this->hotel_lavanderia', hotel_telefone_quarto = '$this->hotel_telefone_quarto', hotel_tv = '$this->hotel_tv', hotel_ginastica = '$this->hotel_ginastica', hotel_restaurante = '$this->hotel_restaurante', hotel_bar = '$this->hotel_bar', hotel_estacionamento = '$this->hotel_estacionamento', hotel_sauna = '$this->hotel_sauna', hotel_piscina = '$this->hotel_piscina', hotel_wifi = '$this->hotel_wifi', hotel_computador = '$this->hotel_computador', hotel_convencoes = '$this->hotel_convencoes', hotel_observacoes = '$this->hotel_observacoes', hotel_classificacao = '$this->hotel_classificacao', hotel_categoria = '$this->hotel_categoria', hotel_cod_estrangeiro = '$this->hotel_cod_estrangeiro'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "hotel_cnpj = '$this->hotel_cnpj', hotel_fantasia = '$this->hotel_fantasia', hotel_razsoc = '$this->hotel_razsoc', hotel_descricao = '$this->hotel_descricao', hotel_rede = '$this->hotel_rede', hotel_cep = '$this->hotel_cep', hotel_pais = '$this->hotel_pais', hotel_uf = '$this->hotel_uf', hotel_municipio = '$this->hotel_municipio', hotel_bairro = '$this->hotel_bairro', hotel_logradouro = '$this->hotel_logradouro', hotel_numero = '$this->hotel_numero', hotel_complemento = '$this->hotel_complemento', hotel_email = '$this->hotel_email', hotel_telefone = '$this->hotel_telefone', hotel_fax = '$this->hotel_fax', hotel_celular = '$this->hotel_celular', hotel_website = '$this->hotel_website', hotel_status = '$this->hotel_status', hotel_facebook = '$this->hotel_facebook', hotel_twitter = '$this->hotel_twitter', hotel_skype = '$this->hotel_skype', hotel_ar_condicionado = '$this->hotel_ar_condicionado', hotel_frigobar = '$this->hotel_frigobar', hotel_lavanderia = '$this->hotel_lavanderia', hotel_telefone_quarto = '$this->hotel_telefone_quarto', hotel_tv = '$this->hotel_tv', hotel_ginastica = '$this->hotel_ginastica', hotel_restaurante = '$this->hotel_restaurante', hotel_bar = '$this->hotel_bar', hotel_estacionamento = '$this->hotel_estacionamento', hotel_sauna = '$this->hotel_sauna', hotel_piscina = '$this->hotel_piscina', hotel_wifi = '$this->hotel_wifi', hotel_computador = '$this->hotel_computador', hotel_convencoes = '$this->hotel_convencoes', hotel_observacoes = '$this->hotel_observacoes', hotel_classificacao = '$this->hotel_classificacao', hotel_categoria = '$this->hotel_categoria', hotel_cod_estrangeiro = '$this->hotel_cod_estrangeiro'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "hotel_cnpj = '$this->hotel_cnpj', hotel_fantasia = '$this->hotel_fantasia', hotel_razsoc = '$this->hotel_razsoc', hotel_descricao = '$this->hotel_descricao', hotel_rede = '$this->hotel_rede', hotel_cep = '$this->hotel_cep', hotel_pais = '$this->hotel_pais', hotel_uf = '$this->hotel_uf', hotel_municipio = '$this->hotel_municipio', hotel_bairro = '$this->hotel_bairro', hotel_logradouro = '$this->hotel_logradouro', hotel_numero = '$this->hotel_numero', hotel_complemento = '$this->hotel_complemento', hotel_email = '$this->hotel_email', hotel_telefone = '$this->hotel_telefone', hotel_fax = '$this->hotel_fax', hotel_celular = '$this->hotel_celular', hotel_website = '$this->hotel_website', hotel_status = '$this->hotel_status', hotel_facebook = '$this->hotel_facebook', hotel_twitter = '$this->hotel_twitter', hotel_skype = '$this->hotel_skype', hotel_ar_condicionado = '$this->hotel_ar_condicionado', hotel_frigobar = '$this->hotel_frigobar', hotel_lavanderia = '$this->hotel_lavanderia', hotel_telefone_quarto = '$this->hotel_telefone_quarto', hotel_tv = '$this->hotel_tv', hotel_ginastica = '$this->hotel_ginastica', hotel_restaurante = '$this->hotel_restaurante', hotel_bar = '$this->hotel_bar', hotel_estacionamento = '$this->hotel_estacionamento', hotel_sauna = '$this->hotel_sauna', hotel_piscina = '$this->hotel_piscina', hotel_wifi = '$this->hotel_wifi', hotel_computador = '$this->hotel_computador', hotel_convencoes = '$this->hotel_convencoes', hotel_observacoes = '$this->hotel_observacoes', hotel_classificacao = '$this->hotel_classificacao', hotel_categoria = '$this->hotel_categoria', hotel_cod_estrangeiro = '$this->hotel_cod_estrangeiro'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "hotel_cnpj = '$this->hotel_cnpj', hotel_fantasia = '$this->hotel_fantasia', hotel_razsoc = '$this->hotel_razsoc', hotel_descricao = '$this->hotel_descricao', hotel_rede = '$this->hotel_rede', hotel_cep = '$this->hotel_cep', hotel_pais = '$this->hotel_pais', hotel_uf = '$this->hotel_uf', hotel_municipio = '$this->hotel_municipio', hotel_bairro = '$this->hotel_bairro', hotel_logradouro = '$this->hotel_logradouro', hotel_numero = '$this->hotel_numero', hotel_complemento = '$this->hotel_complemento', hotel_email = '$this->hotel_email', hotel_telefone = '$this->hotel_telefone', hotel_fax = '$this->hotel_fax', hotel_celular = '$this->hotel_celular', hotel_website = '$this->hotel_website', hotel_status = '$this->hotel_status', hotel_facebook = '$this->hotel_facebook', hotel_twitter = '$this->hotel_twitter', hotel_skype = '$this->hotel_skype', hotel_ar_condicionado = '$this->hotel_ar_condicionado', hotel_frigobar = '$this->hotel_frigobar', hotel_lavanderia = '$this->hotel_lavanderia', hotel_telefone_quarto = '$this->hotel_telefone_quarto', hotel_tv = '$this->hotel_tv', hotel_ginastica = '$this->hotel_ginastica', hotel_restaurante = '$this->hotel_restaurante', hotel_bar = '$this->hotel_bar', hotel_estacionamento = '$this->hotel_estacionamento', hotel_sauna = '$this->hotel_sauna', hotel_piscina = '$this->hotel_piscina', hotel_wifi = '$this->hotel_wifi', hotel_computador = '$this->hotel_computador', hotel_convencoes = '$this->hotel_convencoes', hotel_observacoes = '$this->hotel_observacoes', hotel_classificacao = '$this->hotel_classificacao', hotel_categoria = '$this->hotel_categoria', hotel_cod_estrangeiro = '$this->hotel_cod_estrangeiro'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "hotel_cnpj = '$this->hotel_cnpj', hotel_fantasia = '$this->hotel_fantasia', hotel_razsoc = '$this->hotel_razsoc', hotel_descricao = '$this->hotel_descricao', hotel_rede = '$this->hotel_rede', hotel_cep = '$this->hotel_cep', hotel_pais = '$this->hotel_pais', hotel_uf = '$this->hotel_uf', hotel_municipio = '$this->hotel_municipio', hotel_bairro = '$this->hotel_bairro', hotel_logradouro = '$this->hotel_logradouro', hotel_numero = '$this->hotel_numero', hotel_complemento = '$this->hotel_complemento', hotel_email = '$this->hotel_email', hotel_telefone = '$this->hotel_telefone', hotel_fax = '$this->hotel_fax', hotel_celular = '$this->hotel_celular', hotel_website = '$this->hotel_website', hotel_status = '$this->hotel_status', hotel_facebook = '$this->hotel_facebook', hotel_twitter = '$this->hotel_twitter', hotel_skype = '$this->hotel_skype', hotel_ar_condicionado = '$this->hotel_ar_condicionado', hotel_frigobar = '$this->hotel_frigobar', hotel_lavanderia = '$this->hotel_lavanderia', hotel_telefone_quarto = '$this->hotel_telefone_quarto', hotel_tv = '$this->hotel_tv', hotel_ginastica = '$this->hotel_ginastica', hotel_restaurante = '$this->hotel_restaurante', hotel_bar = '$this->hotel_bar', hotel_estacionamento = '$this->hotel_estacionamento', hotel_sauna = '$this->hotel_sauna', hotel_piscina = '$this->hotel_piscina', hotel_wifi = '$this->hotel_wifi', hotel_computador = '$this->hotel_computador', hotel_convencoes = '$this->hotel_convencoes', hotel_observacoes = '$this->hotel_observacoes', hotel_classificacao = '$this->hotel_classificacao', hotel_categoria = '$this->hotel_categoria', hotel_cod_estrangeiro = '$this->hotel_cod_estrangeiro'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "hotel_cnpj = '$this->hotel_cnpj', hotel_fantasia = '$this->hotel_fantasia', hotel_razsoc = '$this->hotel_razsoc', hotel_descricao = '$this->hotel_descricao', hotel_rede = '$this->hotel_rede', hotel_cep = '$this->hotel_cep', hotel_pais = '$this->hotel_pais', hotel_uf = '$this->hotel_uf', hotel_municipio = '$this->hotel_municipio', hotel_bairro = '$this->hotel_bairro', hotel_logradouro = '$this->hotel_logradouro', hotel_numero = '$this->hotel_numero', hotel_complemento = '$this->hotel_complemento', hotel_email = '$this->hotel_email', hotel_telefone = '$this->hotel_telefone', hotel_fax = '$this->hotel_fax', hotel_celular = '$this->hotel_celular', hotel_website = '$this->hotel_website', hotel_status = '$this->hotel_status', hotel_facebook = '$this->hotel_facebook', hotel_twitter = '$this->hotel_twitter', hotel_skype = '$this->hotel_skype', hotel_ar_condicionado = '$this->hotel_ar_condicionado', hotel_frigobar = '$this->hotel_frigobar', hotel_lavanderia = '$this->hotel_lavanderia', hotel_telefone_quarto = '$this->hotel_telefone_quarto', hotel_tv = '$this->hotel_tv', hotel_ginastica = '$this->hotel_ginastica', hotel_restaurante = '$this->hotel_restaurante', hotel_bar = '$this->hotel_bar', hotel_estacionamento = '$this->hotel_estacionamento', hotel_sauna = '$this->hotel_sauna', hotel_piscina = '$this->hotel_piscina', hotel_wifi = '$this->hotel_wifi', hotel_computador = '$this->hotel_computador', hotel_convencoes = '$this->hotel_convencoes', hotel_observacoes = '$this->hotel_observacoes', hotel_classificacao = '$this->hotel_classificacao', hotel_categoria = '$this->hotel_categoria', hotel_cod_estrangeiro = '$this->hotel_cod_estrangeiro'"; 
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "hotel_cnpj = '$this->hotel_cnpj', hotel_fantasia = '$this->hotel_fantasia', hotel_razsoc = '$this->hotel_razsoc', hotel_descricao = '$this->hotel_descricao', hotel_rede = '$this->hotel_rede', hotel_cep = '$this->hotel_cep', hotel_pais = '$this->hotel_pais', hotel_uf = '$this->hotel_uf', hotel_municipio = '$this->hotel_municipio', hotel_bairro = '$this->hotel_bairro', hotel_logradouro = '$this->hotel_logradouro', hotel_numero = '$this->hotel_numero', hotel_complemento = '$this->hotel_complemento', hotel_email = '$this->hotel_email', hotel_telefone = '$this->hotel_telefone', hotel_fax = '$this->hotel_fax', hotel_celular = '$this->hotel_celular', hotel_website = '$this->hotel_website', hotel_status = '$this->hotel_status', hotel_facebook = '$this->hotel_facebook', hotel_twitter = '$this->hotel_twitter', hotel_skype = '$this->hotel_skype', hotel_ar_condicionado = '$this->hotel_ar_condicionado', hotel_frigobar = '$this->hotel_frigobar', hotel_lavanderia = '$this->hotel_lavanderia', hotel_telefone_quarto = '$this->hotel_telefone_quarto', hotel_tv = '$this->hotel_tv', hotel_ginastica = '$this->hotel_ginastica', hotel_restaurante = '$this->hotel_restaurante', hotel_bar = '$this->hotel_bar', hotel_estacionamento = '$this->hotel_estacionamento', hotel_sauna = '$this->hotel_sauna', hotel_piscina = '$this->hotel_piscina', hotel_wifi = '$this->hotel_wifi', hotel_computador = '$this->hotel_computador', hotel_convencoes = '$this->hotel_convencoes', hotel_observacoes = '$this->hotel_observacoes', hotel_classificacao = '$this->hotel_classificacao', hotel_categoria = '$this->hotel_categoria', hotel_cod_estrangeiro = '$this->hotel_cod_estrangeiro'"; 
              } 
              $temp_cmd_sql = "";
              if ($this->hotel_logo_limpa == "S")
              {
                  if ($this->hotel_logo != "null")
                  {
                      $this->hotel_logo = '';
                  }
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
                  {
                  }
                  else
                  {
                      $temp_cmd_sql = "hotel_logo = '" . $this->hotel_logo . "'";
                  }
                  $this->hotel_logo = "";
              }
              else
              {
                  if ($this->hotel_logo != "none" && $this->hotel_logo != "" && $this->hotel_logo != "*nm*")
                  {
                      $NM_conteudo =  $this->hotel_logo;
                      if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
                      {
                      }
                      else
                      {
                          $temp_cmd_sql .= " hotel_logo = '$NM_conteudo'";
                      }
                  }
                  else
                  {
                      $aDoNotUpdate[] = "hotel_logo";
                  }
              }
              if (!empty($temp_cmd_sql))
              {
                  $SC_fields_update[] = $temp_cmd_sql;
              }
              if ($this->hotel_logo_limpa == "S" || ($this->hotel_logo != "none" && $this->hotel_logo != "" && in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase)) 
                  { 
                      $SC_fields_update[] = "hotel_logo = ''"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql)) 
                  { 
                      $SC_fields_update[] = "hotel_logo = ''"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) 
                  { 
                      $SC_fields_update[] = "hotel_logo = ''"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix)) 
                  { 
                      $SC_fields_update[] = "hotel_logo = null"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite)) 
                  { 
                      $SC_fields_update[] = "hotel_logo = ''"; 
                  } 
                  else 
                  { 
                      $SC_fields_update[] = "hotel_logo = empty_blob()"; 
                  } 
              } 
              $comando .= implode(",", $SC_fields_update);  
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $comando .= " WHERE hotel_id = $this->hotel_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $comando .= " WHERE hotel_id = $this->hotel_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando .= " WHERE hotel_id = $this->hotel_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando .= " WHERE hotel_id = $this->hotel_id ";  
              }  
              else  
              {
                  $comando .= " WHERE hotel_id = $this->hotel_id ";  
              }  
              $comando = str_replace("N'null'", "null", $comando) ; 
              $comando = str_replace("'null'", "null", $comando) ; 
              $comando = str_replace("#null#", "null", $comando) ; 
              $comando = str_replace($this->Ini->date_delim . "null" . $this->Ini->date_delim1, "null", $comando) ; 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                $comando = str_replace("EXTEND('', YEAR TO FRACTION)", "null", $comando) ; 
                $comando = str_replace("EXTEND(null, YEAR TO FRACTION)", "null", $comando) ; 
                $comando = str_replace("EXTEND('', YEAR TO DAY)", "null", $comando) ; 
                $comando = str_replace("EXTEND(null, YEAR TO DAY)", "null", $comando) ; 
              }  
              $useUpdateProcedure = false;
              if (!empty($SC_fields_update) || $useUpdateProcedure)
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando; 
                  $rs = $this->Db->Execute($comando);  
                  if ($rs === false) 
                  { 
                      if (FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "MAIL SENT") && FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "WARNING"))
                      {
                          $dbErrorMessage = $this->Db->ErrorMsg();
                          $dbErrorCode = $this->Db->ErrorNo();
                          $this->handleDbErrorMessage($dbErrorMessage, $dbErrorCode);
                          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_updt'], $dbErrorMessage, true);
                          if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler']) 
                          { 
                              $this->sc_erro_update = $dbErrorMessage;
                              $this->NM_rollback_db(); 
                              if ($this->NM_ajax_flag)
                              {
                                  form_tbl_hoteis_pack_ajax_response();
                              }
                              exit;  
                          }   
                      }   
                  }   
              }   
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql)) 
              { 
              }   
              $this->hotel_cnpj = $this->hotel_cnpj_before_qstr;
              $this->hotel_fantasia = $this->hotel_fantasia_before_qstr;
              $this->hotel_razsoc = $this->hotel_razsoc_before_qstr;
              $this->hotel_descricao = $this->hotel_descricao_before_qstr;
              $this->hotel_rede = $this->hotel_rede_before_qstr;
              $this->hotel_cep = $this->hotel_cep_before_qstr;
              $this->hotel_pais = $this->hotel_pais_before_qstr;
              $this->hotel_uf = $this->hotel_uf_before_qstr;
              $this->hotel_municipio = $this->hotel_municipio_before_qstr;
              $this->hotel_bairro = $this->hotel_bairro_before_qstr;
              $this->hotel_logradouro = $this->hotel_logradouro_before_qstr;
              $this->hotel_numero = $this->hotel_numero_before_qstr;
              $this->hotel_complemento = $this->hotel_complemento_before_qstr;
              $this->hotel_email = $this->hotel_email_before_qstr;
              $this->hotel_telefone = $this->hotel_telefone_before_qstr;
              $this->hotel_fax = $this->hotel_fax_before_qstr;
              $this->hotel_celular = $this->hotel_celular_before_qstr;
              $this->hotel_website = $this->hotel_website_before_qstr;
              $this->hotel_facebook = $this->hotel_facebook_before_qstr;
              $this->hotel_twitter = $this->hotel_twitter_before_qstr;
              $this->hotel_skype = $this->hotel_skype_before_qstr;
              $this->hotel_observacoes = $this->hotel_observacoes_before_qstr;
              $this->hotel_classificacao = $this->hotel_classificacao_before_qstr;
              $this->hotel_categoria = $this->hotel_categoria_before_qstr;
              $this->hotel_cod_estrangeiro = $this->hotel_cod_estrangeiro_before_qstr;
              if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
              { 
                  if ($this->hotel_logo_limpa == "S" && (!isset($this->Ini->nm_bases_oracle) || !in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle)) && (!isset($this->Ini->nm_bases_informix) || !in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))) 
                  { 
                      $_SESSION['scriptcase']['sc_sql_ult_comando'] = "UpdateBlob(" . $this->Ini->nm_tabela . ", \"hotel_logo\", \"\",  \"hotel_id = $this->hotel_id\")"; 
                      $rs = $this->Db->UpdateBlob($this->Ini->nm_tabela, "hotel_logo", "",  "hotel_id = $this->hotel_id"); 
                  } 
                  else 
                  { 
                      if ($this->hotel_logo != "none" && $this->hotel_logo != "") 
                      { 
                          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "UpdateBlob(" . $this->Ini->nm_tabela . ", \"hotel_logo\", $this->hotel_logo,  \"hotel_id = $this->hotel_id\")"; 
                          $rs = $this->Db->UpdateBlob($this->Ini->nm_tabela, "hotel_logo", $this->hotel_logo,  "hotel_id = $this->hotel_id"); 
                      } 
                  } 
                  if ($rs === false) 
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_updt'], $this->Db->ErrorMsg()); 
                      $this->NM_rollback_db(); 
                      if ($this->NM_ajax_flag)
                      {
                          form_tbl_hoteis_pack_ajax_response();
                      }
                      exit;  
                  }   
              }   
              if ($this->hotel_logo_limpa == "S")
              {
                  $this->NM_ajax_info['fldList']['hotel_logo_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
              }
              $this->sc_evento = "update"; 
              $this->nmgp_opcao = "igual"; 
              $this->nm_flag_iframe = true;
              if ($this->lig_edit_lookup)
              {
                  $this->lig_edit_lookup_call = true;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['db_changed'] = true;
              if ($this->NM_ajax_flag) {
                  $this->NM_ajax_info['clearUpload'] = 'S';
                  $this->NM_ajax_info['fldList']['hotel_logo_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
              }


              if     (isset($NM_val_form) && isset($NM_val_form['hotel_id'])) { $this->hotel_id = $NM_val_form['hotel_id']; }
              elseif (isset($this->hotel_id)) { $this->nm_limpa_alfa($this->hotel_id); }
              if     (isset($NM_val_form) && isset($NM_val_form['hotel_cnpj'])) { $this->hotel_cnpj = $NM_val_form['hotel_cnpj']; }
              elseif (isset($this->hotel_cnpj)) { $this->nm_limpa_alfa($this->hotel_cnpj); }
              if     (isset($NM_val_form) && isset($NM_val_form['hotel_fantasia'])) { $this->hotel_fantasia = $NM_val_form['hotel_fantasia']; }
              elseif (isset($this->hotel_fantasia)) { $this->nm_limpa_alfa($this->hotel_fantasia); }
              if     (isset($NM_val_form) && isset($NM_val_form['hotel_razsoc'])) { $this->hotel_razsoc = $NM_val_form['hotel_razsoc']; }
              elseif (isset($this->hotel_razsoc)) { $this->nm_limpa_alfa($this->hotel_razsoc); }
              if     (isset($NM_val_form) && isset($NM_val_form['hotel_descricao'])) { $this->hotel_descricao = $NM_val_form['hotel_descricao']; }
              elseif (isset($this->hotel_descricao)) { $this->nm_limpa_alfa($this->hotel_descricao); }
              if     (isset($NM_val_form) && isset($NM_val_form['hotel_rede'])) { $this->hotel_rede = $NM_val_form['hotel_rede']; }
              elseif (isset($this->hotel_rede)) { $this->nm_limpa_alfa($this->hotel_rede); }
              if     (isset($NM_val_form) && isset($NM_val_form['hotel_cep'])) { $this->hotel_cep = $NM_val_form['hotel_cep']; }
              elseif (isset($this->hotel_cep)) { $this->nm_limpa_alfa($this->hotel_cep); }
              if     (isset($NM_val_form) && isset($NM_val_form['hotel_pais'])) { $this->hotel_pais = $NM_val_form['hotel_pais']; }
              elseif (isset($this->hotel_pais)) { $this->nm_limpa_alfa($this->hotel_pais); }
              if     (isset($NM_val_form) && isset($NM_val_form['hotel_uf'])) { $this->hotel_uf = $NM_val_form['hotel_uf']; }
              elseif (isset($this->hotel_uf)) { $this->nm_limpa_alfa($this->hotel_uf); }
              if     (isset($NM_val_form) && isset($NM_val_form['hotel_municipio'])) { $this->hotel_municipio = $NM_val_form['hotel_municipio']; }
              elseif (isset($this->hotel_municipio)) { $this->nm_limpa_alfa($this->hotel_municipio); }
              if     (isset($NM_val_form) && isset($NM_val_form['hotel_bairro'])) { $this->hotel_bairro = $NM_val_form['hotel_bairro']; }
              elseif (isset($this->hotel_bairro)) { $this->nm_limpa_alfa($this->hotel_bairro); }
              if     (isset($NM_val_form) && isset($NM_val_form['hotel_logradouro'])) { $this->hotel_logradouro = $NM_val_form['hotel_logradouro']; }
              elseif (isset($this->hotel_logradouro)) { $this->nm_limpa_alfa($this->hotel_logradouro); }
              if     (isset($NM_val_form) && isset($NM_val_form['hotel_numero'])) { $this->hotel_numero = $NM_val_form['hotel_numero']; }
              elseif (isset($this->hotel_numero)) { $this->nm_limpa_alfa($this->hotel_numero); }
              if     (isset($NM_val_form) && isset($NM_val_form['hotel_complemento'])) { $this->hotel_complemento = $NM_val_form['hotel_complemento']; }
              elseif (isset($this->hotel_complemento)) { $this->nm_limpa_alfa($this->hotel_complemento); }
              if     (isset($NM_val_form) && isset($NM_val_form['hotel_email'])) { $this->hotel_email = $NM_val_form['hotel_email']; }
              elseif (isset($this->hotel_email)) { $this->nm_limpa_alfa($this->hotel_email); }
              if     (isset($NM_val_form) && isset($NM_val_form['hotel_telefone'])) { $this->hotel_telefone = $NM_val_form['hotel_telefone']; }
              elseif (isset($this->hotel_telefone)) { $this->nm_limpa_alfa($this->hotel_telefone); }
              if     (isset($NM_val_form) && isset($NM_val_form['hotel_fax'])) { $this->hotel_fax = $NM_val_form['hotel_fax']; }
              elseif (isset($this->hotel_fax)) { $this->nm_limpa_alfa($this->hotel_fax); }
              if     (isset($NM_val_form) && isset($NM_val_form['hotel_celular'])) { $this->hotel_celular = $NM_val_form['hotel_celular']; }
              elseif (isset($this->hotel_celular)) { $this->nm_limpa_alfa($this->hotel_celular); }
              if     (isset($NM_val_form) && isset($NM_val_form['hotel_website'])) { $this->hotel_website = $NM_val_form['hotel_website']; }
              elseif (isset($this->hotel_website)) { $this->nm_limpa_alfa($this->hotel_website); }
              if     (isset($NM_val_form) && isset($NM_val_form['hotel_facebook'])) { $this->hotel_facebook = $NM_val_form['hotel_facebook']; }
              elseif (isset($this->hotel_facebook)) { $this->nm_limpa_alfa($this->hotel_facebook); }
              if     (isset($NM_val_form) && isset($NM_val_form['hotel_twitter'])) { $this->hotel_twitter = $NM_val_form['hotel_twitter']; }
              elseif (isset($this->hotel_twitter)) { $this->nm_limpa_alfa($this->hotel_twitter); }
              if     (isset($NM_val_form) && isset($NM_val_form['hotel_skype'])) { $this->hotel_skype = $NM_val_form['hotel_skype']; }
              elseif (isset($this->hotel_skype)) { $this->nm_limpa_alfa($this->hotel_skype); }
              if     (isset($NM_val_form) && isset($NM_val_form['hotel_classificacao'])) { $this->hotel_classificacao = $NM_val_form['hotel_classificacao']; }
              elseif (isset($this->hotel_classificacao)) { $this->nm_limpa_alfa($this->hotel_classificacao); }
              if     (isset($NM_val_form) && isset($NM_val_form['hotel_categoria'])) { $this->hotel_categoria = $NM_val_form['hotel_categoria']; }
              elseif (isset($this->hotel_categoria)) { $this->nm_limpa_alfa($this->hotel_categoria); }
              if     (isset($NM_val_form) && isset($NM_val_form['hotel_cod_estrangeiro'])) { $this->hotel_cod_estrangeiro = $NM_val_form['hotel_cod_estrangeiro']; }
              elseif (isset($this->hotel_cod_estrangeiro)) { $this->nm_limpa_alfa($this->hotel_cod_estrangeiro); }

              $this->nm_formatar_campos();
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
              }

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('hotel_id', 'hotel_cnpj', 'hotel_fantasia', 'hotel_razsoc', 'hotel_descricao', 'hotel_rede', 'hotel_classificacao', 'hotel_categoria', 'hotel_cep', 'hotel_pais', 'hotel_uf', 'hotel_municipio', 'hotel_bairro', 'hotel_logradouro', 'hotel_numero', 'hotel_complemento', 'localizacao', 'hotel_observacoes', 'hotel_email', 'hotel_website', 'hotel_telefone', 'hotel_fax', 'hotel_celular', 'hotel_status', 'hotel_facebook', 'hotel_twitter', 'hotel_skype', 'hotel_ar_condicionado', 'hotel_frigobar', 'hotel_lavanderia', 'hotel_telefone_quarto', 'hotel_tv', 'hotel_ginastica', 'hotel_restaurante', 'hotel_bar', 'hotel_estacionamento', 'hotel_sauna', 'hotel_piscina', 'hotel_wifi', 'hotel_computador', 'hotel_convencoes', 'hotel_cod_estrangeiro'), $aDoNotUpdate);
              $this->ajax_return_values();
              $this->nmgp_refresh_fields = $aOldRefresh;

              $this->nm_tira_formatacao();
          }  
      }  
      if ($this->nmgp_opcao == "incluir") 
      { 
          $NM_cmp_auto = "";
          $NM_seq_auto = "";
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          { 
              $NM_seq_auto = "NULL, ";
              $NM_cmp_auto = "hotel_id, ";
          } 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(hotel_id) from " . $this->Ini->nm_tabela; 
          $comando = "select max(hotel_id) from " . $this->Ini->nm_tabela; 
          $rs = $this->Db->Execute($comando); 
          if ($rs === false && !$rs->EOF)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
              $this->NM_rollback_db(); 
              if ($this->NM_ajax_flag)
              {
                  form_tbl_hoteis_pack_ajax_response();
              }
              exit; 
          }  
          $this->hotel_id_before_qstr = $this->hotel_id = $rs->fields[0] + 1;
          $rs->Close(); 
          $bInsertOk = true;
          $aInsertOk = array(); 
          $bInsertOk = $bInsertOk && empty($aInsertOk);
          if (!isset($_POST['nmgp_ins_valid']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['insert_validation'] != $_POST['nmgp_ins_valid'])
          {
              $bInsertOk = false;
              $this->Erro->mensagem(__FILE__, __LINE__, 'security', $this->Ini->Nm_lang['lang_errm_inst_vald']);
              if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
              {
                  $this->nmgp_opcao = 'refresh_insert';
                  if ($this->NM_ajax_flag)
                  {
                      form_tbl_hoteis_pack_ajax_response();
                      exit;
                  }
              }
          }
          if ($bInsertOk)
          { 
              $_test_file = $this->fetchUniqueUploadName($this->hotel_logo_scfile_name, $dir_file, "hotel_logo");
              if (trim($this->hotel_logo_scfile_name) != $_test_file)
              {
                  $this->hotel_logo_scfile_name = $_test_file;
                  $this->hotel_logo = $_test_file;
                 $this->rodape_before_qstr = $this->rodape;
                 $this->rodape = substr($this->Db->qstr($this->rodape), 1, -1); 
              }
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (hotel_cnpj, hotel_fantasia, hotel_razsoc, hotel_descricao, hotel_rede, hotel_cep, hotel_pais, hotel_uf, hotel_municipio, hotel_bairro, hotel_logradouro, hotel_numero, hotel_complemento, hotel_email, hotel_telefone, hotel_fax, hotel_celular, hotel_website, hotel_status, hotel_facebook, hotel_twitter, hotel_skype, hotel_ar_condicionado, hotel_frigobar, hotel_lavanderia, hotel_telefone_quarto, hotel_tv, hotel_ginastica, hotel_restaurante, hotel_bar, hotel_estacionamento, hotel_sauna, hotel_piscina, hotel_wifi, hotel_computador, hotel_convencoes, hotel_observacoes, hotel_classificacao, hotel_categoria, hotel_logo, hotel_cod_estrangeiro) VALUES ('$this->hotel_cnpj', '$this->hotel_fantasia', '$this->hotel_razsoc', '$this->hotel_descricao', '$this->hotel_rede', '$this->hotel_cep', '$this->hotel_pais', '$this->hotel_uf', '$this->hotel_municipio', '$this->hotel_bairro', '$this->hotel_logradouro', '$this->hotel_numero', '$this->hotel_complemento', '$this->hotel_email', '$this->hotel_telefone', '$this->hotel_fax', '$this->hotel_celular', '$this->hotel_website', '$this->hotel_status', '$this->hotel_facebook', '$this->hotel_twitter', '$this->hotel_skype', '$this->hotel_ar_condicionado', '$this->hotel_frigobar', '$this->hotel_lavanderia', '$this->hotel_telefone_quarto', '$this->hotel_tv', '$this->hotel_ginastica', '$this->hotel_restaurante', '$this->hotel_bar', '$this->hotel_estacionamento', '$this->hotel_sauna', '$this->hotel_piscina', '$this->hotel_wifi', '$this->hotel_computador', '$this->hotel_convencoes', '$this->hotel_observacoes', '$this->hotel_classificacao', '$this->hotel_categoria', '$this->hotel_logo', '$this->hotel_cod_estrangeiro')"; 
              }
              elseif ($this->Ini->nm_tpbanco == "pdo_sqlsrv")
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (hotel_cnpj, hotel_fantasia, hotel_razsoc, hotel_descricao, hotel_rede, hotel_cep, hotel_pais, hotel_uf, hotel_municipio, hotel_bairro, hotel_logradouro, hotel_numero, hotel_complemento, hotel_email, hotel_telefone, hotel_fax, hotel_celular, hotel_website, hotel_status, hotel_facebook, hotel_twitter, hotel_skype, hotel_ar_condicionado, hotel_frigobar, hotel_lavanderia, hotel_telefone_quarto, hotel_tv, hotel_ginastica, hotel_restaurante, hotel_bar, hotel_estacionamento, hotel_sauna, hotel_piscina, hotel_wifi, hotel_computador, hotel_convencoes, hotel_observacoes, hotel_classificacao, hotel_categoria, hotel_logo, hotel_cod_estrangeiro) VALUES ('$this->hotel_cnpj', '$this->hotel_fantasia', '$this->hotel_razsoc', '$this->hotel_descricao', '$this->hotel_rede', '$this->hotel_cep', '$this->hotel_pais', '$this->hotel_uf', '$this->hotel_municipio', '$this->hotel_bairro', '$this->hotel_logradouro', '$this->hotel_numero', '$this->hotel_complemento', '$this->hotel_email', '$this->hotel_telefone', '$this->hotel_fax', '$this->hotel_celular', '$this->hotel_website', '$this->hotel_status', '$this->hotel_facebook', '$this->hotel_twitter', '$this->hotel_skype', '$this->hotel_ar_condicionado', '$this->hotel_frigobar', '$this->hotel_lavanderia', '$this->hotel_telefone_quarto', '$this->hotel_tv', '$this->hotel_ginastica', '$this->hotel_restaurante', '$this->hotel_bar', '$this->hotel_estacionamento', '$this->hotel_sauna', '$this->hotel_piscina', '$this->hotel_wifi', '$this->hotel_computador', '$this->hotel_convencoes', '$this->hotel_observacoes', '$this->hotel_classificacao', '$this->hotel_categoria', '', '$this->hotel_cod_estrangeiro')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (hotel_cnpj, hotel_fantasia, hotel_razsoc, hotel_descricao, hotel_rede, hotel_cep, hotel_pais, hotel_uf, hotel_municipio, hotel_bairro, hotel_logradouro, hotel_numero, hotel_complemento, hotel_email, hotel_telefone, hotel_fax, hotel_celular, hotel_website, hotel_status, hotel_facebook, hotel_twitter, hotel_skype, hotel_ar_condicionado, hotel_frigobar, hotel_lavanderia, hotel_telefone_quarto, hotel_tv, hotel_ginastica, hotel_restaurante, hotel_bar, hotel_estacionamento, hotel_sauna, hotel_piscina, hotel_wifi, hotel_computador, hotel_convencoes, hotel_observacoes, hotel_classificacao, hotel_categoria, hotel_logo, hotel_cod_estrangeiro) VALUES ('$this->hotel_cnpj', '$this->hotel_fantasia', '$this->hotel_razsoc', '$this->hotel_descricao', '$this->hotel_rede', '$this->hotel_cep', '$this->hotel_pais', '$this->hotel_uf', '$this->hotel_municipio', '$this->hotel_bairro', '$this->hotel_logradouro', '$this->hotel_numero', '$this->hotel_complemento', '$this->hotel_email', '$this->hotel_telefone', '$this->hotel_fax', '$this->hotel_celular', '$this->hotel_website', '$this->hotel_status', '$this->hotel_facebook', '$this->hotel_twitter', '$this->hotel_skype', '$this->hotel_ar_condicionado', '$this->hotel_frigobar', '$this->hotel_lavanderia', '$this->hotel_telefone_quarto', '$this->hotel_tv', '$this->hotel_ginastica', '$this->hotel_restaurante', '$this->hotel_bar', '$this->hotel_estacionamento', '$this->hotel_sauna', '$this->hotel_piscina', '$this->hotel_wifi', '$this->hotel_computador', '$this->hotel_convencoes', '$this->hotel_observacoes', '$this->hotel_classificacao', '$this->hotel_categoria', '$this->hotel_logo', '$this->hotel_cod_estrangeiro')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (hotel_cnpj, hotel_fantasia, hotel_razsoc, hotel_descricao, hotel_rede, hotel_cep, hotel_pais, hotel_uf, hotel_municipio, hotel_bairro, hotel_logradouro, hotel_numero, hotel_complemento, hotel_email, hotel_telefone, hotel_fax, hotel_celular, hotel_website, hotel_status, hotel_facebook, hotel_twitter, hotel_skype, hotel_ar_condicionado, hotel_frigobar, hotel_lavanderia, hotel_telefone_quarto, hotel_tv, hotel_ginastica, hotel_restaurante, hotel_bar, hotel_estacionamento, hotel_sauna, hotel_piscina, hotel_wifi, hotel_computador, hotel_convencoes, hotel_observacoes, hotel_classificacao, hotel_categoria, hotel_logo, hotel_cod_estrangeiro) VALUES ('$this->hotel_cnpj', '$this->hotel_fantasia', '$this->hotel_razsoc', '$this->hotel_descricao', '$this->hotel_rede', '$this->hotel_cep', '$this->hotel_pais', '$this->hotel_uf', '$this->hotel_municipio', '$this->hotel_bairro', '$this->hotel_logradouro', '$this->hotel_numero', '$this->hotel_complemento', '$this->hotel_email', '$this->hotel_telefone', '$this->hotel_fax', '$this->hotel_celular', '$this->hotel_website', '$this->hotel_status', '$this->hotel_facebook', '$this->hotel_twitter', '$this->hotel_skype', '$this->hotel_ar_condicionado', '$this->hotel_frigobar', '$this->hotel_lavanderia', '$this->hotel_telefone_quarto', '$this->hotel_tv', '$this->hotel_ginastica', '$this->hotel_restaurante', '$this->hotel_bar', '$this->hotel_estacionamento', '$this->hotel_sauna', '$this->hotel_piscina', '$this->hotel_wifi', '$this->hotel_computador', '$this->hotel_convencoes', '$this->hotel_observacoes', '$this->hotel_classificacao', '$this->hotel_categoria', '$this->hotel_logo', '$this->hotel_cod_estrangeiro')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "hotel_cnpj, hotel_fantasia, hotel_razsoc, hotel_descricao, hotel_rede, hotel_cep, hotel_pais, hotel_uf, hotel_municipio, hotel_bairro, hotel_logradouro, hotel_numero, hotel_complemento, hotel_email, hotel_telefone, hotel_fax, hotel_celular, hotel_website, hotel_status, hotel_facebook, hotel_twitter, hotel_skype, hotel_ar_condicionado, hotel_frigobar, hotel_lavanderia, hotel_telefone_quarto, hotel_tv, hotel_ginastica, hotel_restaurante, hotel_bar, hotel_estacionamento, hotel_sauna, hotel_piscina, hotel_wifi, hotel_computador, hotel_convencoes, hotel_observacoes, hotel_classificacao, hotel_categoria, hotel_logo, hotel_cod_estrangeiro) VALUES (" . $NM_seq_auto . "'$this->hotel_cnpj', '$this->hotel_fantasia', '$this->hotel_razsoc', '$this->hotel_descricao', '$this->hotel_rede', '$this->hotel_cep', '$this->hotel_pais', '$this->hotel_uf', '$this->hotel_municipio', '$this->hotel_bairro', '$this->hotel_logradouro', '$this->hotel_numero', '$this->hotel_complemento', '$this->hotel_email', '$this->hotel_telefone', '$this->hotel_fax', '$this->hotel_celular', '$this->hotel_website', '$this->hotel_status', '$this->hotel_facebook', '$this->hotel_twitter', '$this->hotel_skype', '$this->hotel_ar_condicionado', '$this->hotel_frigobar', '$this->hotel_lavanderia', '$this->hotel_telefone_quarto', '$this->hotel_tv', '$this->hotel_ginastica', '$this->hotel_restaurante', '$this->hotel_bar', '$this->hotel_estacionamento', '$this->hotel_sauna', '$this->hotel_piscina', '$this->hotel_wifi', '$this->hotel_computador', '$this->hotel_convencoes', '$this->hotel_observacoes', '$this->hotel_classificacao', '$this->hotel_categoria', EMPTY_BLOB(), '$this->hotel_cod_estrangeiro')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "hotel_cnpj, hotel_fantasia, hotel_razsoc, hotel_descricao, hotel_rede, hotel_cep, hotel_pais, hotel_uf, hotel_municipio, hotel_bairro, hotel_logradouro, hotel_numero, hotel_complemento, hotel_email, hotel_telefone, hotel_fax, hotel_celular, hotel_website, hotel_status, hotel_facebook, hotel_twitter, hotel_skype, hotel_ar_condicionado, hotel_frigobar, hotel_lavanderia, hotel_telefone_quarto, hotel_tv, hotel_ginastica, hotel_restaurante, hotel_bar, hotel_estacionamento, hotel_sauna, hotel_piscina, hotel_wifi, hotel_computador, hotel_convencoes, hotel_observacoes, hotel_classificacao, hotel_categoria, hotel_logo, hotel_cod_estrangeiro) VALUES (" . $NM_seq_auto . "'$this->hotel_cnpj', '$this->hotel_fantasia', '$this->hotel_razsoc', '$this->hotel_descricao', '$this->hotel_rede', '$this->hotel_cep', '$this->hotel_pais', '$this->hotel_uf', '$this->hotel_municipio', '$this->hotel_bairro', '$this->hotel_logradouro', '$this->hotel_numero', '$this->hotel_complemento', '$this->hotel_email', '$this->hotel_telefone', '$this->hotel_fax', '$this->hotel_celular', '$this->hotel_website', '$this->hotel_status', '$this->hotel_facebook', '$this->hotel_twitter', '$this->hotel_skype', '$this->hotel_ar_condicionado', '$this->hotel_frigobar', '$this->hotel_lavanderia', '$this->hotel_telefone_quarto', '$this->hotel_tv', '$this->hotel_ginastica', '$this->hotel_restaurante', '$this->hotel_bar', '$this->hotel_estacionamento', '$this->hotel_sauna', '$this->hotel_piscina', '$this->hotel_wifi', '$this->hotel_computador', '$this->hotel_convencoes', '$this->hotel_observacoes', '$this->hotel_classificacao', '$this->hotel_categoria', EMPTY_BLOB(), '$this->hotel_cod_estrangeiro')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "hotel_cnpj, hotel_fantasia, hotel_razsoc, hotel_descricao, hotel_rede, hotel_cep, hotel_pais, hotel_uf, hotel_municipio, hotel_bairro, hotel_logradouro, hotel_numero, hotel_complemento, hotel_email, hotel_telefone, hotel_fax, hotel_celular, hotel_website, hotel_status, hotel_facebook, hotel_twitter, hotel_skype, hotel_ar_condicionado, hotel_frigobar, hotel_lavanderia, hotel_telefone_quarto, hotel_tv, hotel_ginastica, hotel_restaurante, hotel_bar, hotel_estacionamento, hotel_sauna, hotel_piscina, hotel_wifi, hotel_computador, hotel_convencoes, hotel_observacoes, hotel_classificacao, hotel_categoria, hotel_logo, hotel_cod_estrangeiro) VALUES (" . $NM_seq_auto . "'$this->hotel_cnpj', '$this->hotel_fantasia', '$this->hotel_razsoc', '$this->hotel_descricao', '$this->hotel_rede', '$this->hotel_cep', '$this->hotel_pais', '$this->hotel_uf', '$this->hotel_municipio', '$this->hotel_bairro', '$this->hotel_logradouro', '$this->hotel_numero', '$this->hotel_complemento', '$this->hotel_email', '$this->hotel_telefone', '$this->hotel_fax', '$this->hotel_celular', '$this->hotel_website', '$this->hotel_status', '$this->hotel_facebook', '$this->hotel_twitter', '$this->hotel_skype', '$this->hotel_ar_condicionado', '$this->hotel_frigobar', '$this->hotel_lavanderia', '$this->hotel_telefone_quarto', '$this->hotel_tv', '$this->hotel_ginastica', '$this->hotel_restaurante', '$this->hotel_bar', '$this->hotel_estacionamento', '$this->hotel_sauna', '$this->hotel_piscina', '$this->hotel_wifi', '$this->hotel_computador', '$this->hotel_convencoes', '$this->hotel_observacoes', '$this->hotel_classificacao', '$this->hotel_categoria', null, '$this->hotel_cod_estrangeiro')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "hotel_cnpj, hotel_fantasia, hotel_razsoc, hotel_descricao, hotel_rede, hotel_cep, hotel_pais, hotel_uf, hotel_municipio, hotel_bairro, hotel_logradouro, hotel_numero, hotel_complemento, hotel_email, hotel_telefone, hotel_fax, hotel_celular, hotel_website, hotel_status, hotel_facebook, hotel_twitter, hotel_skype, hotel_ar_condicionado, hotel_frigobar, hotel_lavanderia, hotel_telefone_quarto, hotel_tv, hotel_ginastica, hotel_restaurante, hotel_bar, hotel_estacionamento, hotel_sauna, hotel_piscina, hotel_wifi, hotel_computador, hotel_convencoes, hotel_observacoes, hotel_classificacao, hotel_categoria, hotel_logo, hotel_cod_estrangeiro) VALUES (" . $NM_seq_auto . "'$this->hotel_cnpj', '$this->hotel_fantasia', '$this->hotel_razsoc', '$this->hotel_descricao', '$this->hotel_rede', '$this->hotel_cep', '$this->hotel_pais', '$this->hotel_uf', '$this->hotel_municipio', '$this->hotel_bairro', '$this->hotel_logradouro', '$this->hotel_numero', '$this->hotel_complemento', '$this->hotel_email', '$this->hotel_telefone', '$this->hotel_fax', '$this->hotel_celular', '$this->hotel_website', '$this->hotel_status', '$this->hotel_facebook', '$this->hotel_twitter', '$this->hotel_skype', '$this->hotel_ar_condicionado', '$this->hotel_frigobar', '$this->hotel_lavanderia', '$this->hotel_telefone_quarto', '$this->hotel_tv', '$this->hotel_ginastica', '$this->hotel_restaurante', '$this->hotel_bar', '$this->hotel_estacionamento', '$this->hotel_sauna', '$this->hotel_piscina', '$this->hotel_wifi', '$this->hotel_computador', '$this->hotel_convencoes', '$this->hotel_observacoes', '$this->hotel_classificacao', '$this->hotel_categoria', '', '$this->hotel_cod_estrangeiro')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "hotel_cnpj, hotel_fantasia, hotel_razsoc, hotel_descricao, hotel_rede, hotel_cep, hotel_pais, hotel_uf, hotel_municipio, hotel_bairro, hotel_logradouro, hotel_numero, hotel_complemento, hotel_email, hotel_telefone, hotel_fax, hotel_celular, hotel_website, hotel_status, hotel_facebook, hotel_twitter, hotel_skype, hotel_ar_condicionado, hotel_frigobar, hotel_lavanderia, hotel_telefone_quarto, hotel_tv, hotel_ginastica, hotel_restaurante, hotel_bar, hotel_estacionamento, hotel_sauna, hotel_piscina, hotel_wifi, hotel_computador, hotel_convencoes, hotel_observacoes, hotel_classificacao, hotel_categoria, hotel_logo, hotel_cod_estrangeiro) VALUES (" . $NM_seq_auto . "'$this->hotel_cnpj', '$this->hotel_fantasia', '$this->hotel_razsoc', '$this->hotel_descricao', '$this->hotel_rede', '$this->hotel_cep', '$this->hotel_pais', '$this->hotel_uf', '$this->hotel_municipio', '$this->hotel_bairro', '$this->hotel_logradouro', '$this->hotel_numero', '$this->hotel_complemento', '$this->hotel_email', '$this->hotel_telefone', '$this->hotel_fax', '$this->hotel_celular', '$this->hotel_website', '$this->hotel_status', '$this->hotel_facebook', '$this->hotel_twitter', '$this->hotel_skype', '$this->hotel_ar_condicionado', '$this->hotel_frigobar', '$this->hotel_lavanderia', '$this->hotel_telefone_quarto', '$this->hotel_tv', '$this->hotel_ginastica', '$this->hotel_restaurante', '$this->hotel_bar', '$this->hotel_estacionamento', '$this->hotel_sauna', '$this->hotel_piscina', '$this->hotel_wifi', '$this->hotel_computador', '$this->hotel_convencoes', '$this->hotel_observacoes', '$this->hotel_classificacao', '$this->hotel_categoria', '', '$this->hotel_cod_estrangeiro')"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "hotel_cnpj, hotel_fantasia, hotel_razsoc, hotel_descricao, hotel_rede, hotel_cep, hotel_pais, hotel_uf, hotel_municipio, hotel_bairro, hotel_logradouro, hotel_numero, hotel_complemento, hotel_email, hotel_telefone, hotel_fax, hotel_celular, hotel_website, hotel_status, hotel_facebook, hotel_twitter, hotel_skype, hotel_ar_condicionado, hotel_frigobar, hotel_lavanderia, hotel_telefone_quarto, hotel_tv, hotel_ginastica, hotel_restaurante, hotel_bar, hotel_estacionamento, hotel_sauna, hotel_piscina, hotel_wifi, hotel_computador, hotel_convencoes, hotel_observacoes, hotel_classificacao, hotel_categoria, hotel_logo, hotel_cod_estrangeiro) VALUES (" . $NM_seq_auto . "'$this->hotel_cnpj', '$this->hotel_fantasia', '$this->hotel_razsoc', '$this->hotel_descricao', '$this->hotel_rede', '$this->hotel_cep', '$this->hotel_pais', '$this->hotel_uf', '$this->hotel_municipio', '$this->hotel_bairro', '$this->hotel_logradouro', '$this->hotel_numero', '$this->hotel_complemento', '$this->hotel_email', '$this->hotel_telefone', '$this->hotel_fax', '$this->hotel_celular', '$this->hotel_website', '$this->hotel_status', '$this->hotel_facebook', '$this->hotel_twitter', '$this->hotel_skype', '$this->hotel_ar_condicionado', '$this->hotel_frigobar', '$this->hotel_lavanderia', '$this->hotel_telefone_quarto', '$this->hotel_tv', '$this->hotel_ginastica', '$this->hotel_restaurante', '$this->hotel_bar', '$this->hotel_estacionamento', '$this->hotel_sauna', '$this->hotel_piscina', '$this->hotel_wifi', '$this->hotel_computador', '$this->hotel_convencoes', '$this->hotel_observacoes', '$this->hotel_classificacao', '$this->hotel_categoria', '', '$this->hotel_cod_estrangeiro')"; 
              }
              else
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "hotel_cnpj, hotel_fantasia, hotel_razsoc, hotel_descricao, hotel_rede, hotel_cep, hotel_pais, hotel_uf, hotel_municipio, hotel_bairro, hotel_logradouro, hotel_numero, hotel_complemento, hotel_email, hotel_telefone, hotel_fax, hotel_celular, hotel_website, hotel_status, hotel_facebook, hotel_twitter, hotel_skype, hotel_ar_condicionado, hotel_frigobar, hotel_lavanderia, hotel_telefone_quarto, hotel_tv, hotel_ginastica, hotel_restaurante, hotel_bar, hotel_estacionamento, hotel_sauna, hotel_piscina, hotel_wifi, hotel_computador, hotel_convencoes, hotel_observacoes, hotel_classificacao, hotel_categoria, hotel_logo, hotel_cod_estrangeiro) VALUES (" . $NM_seq_auto . "'$this->hotel_cnpj', '$this->hotel_fantasia', '$this->hotel_razsoc', '$this->hotel_descricao', '$this->hotel_rede', '$this->hotel_cep', '$this->hotel_pais', '$this->hotel_uf', '$this->hotel_municipio', '$this->hotel_bairro', '$this->hotel_logradouro', '$this->hotel_numero', '$this->hotel_complemento', '$this->hotel_email', '$this->hotel_telefone', '$this->hotel_fax', '$this->hotel_celular', '$this->hotel_website', '$this->hotel_status', '$this->hotel_facebook', '$this->hotel_twitter', '$this->hotel_skype', '$this->hotel_ar_condicionado', '$this->hotel_frigobar', '$this->hotel_lavanderia', '$this->hotel_telefone_quarto', '$this->hotel_tv', '$this->hotel_ginastica', '$this->hotel_restaurante', '$this->hotel_bar', '$this->hotel_estacionamento', '$this->hotel_sauna', '$this->hotel_piscina', '$this->hotel_wifi', '$this->hotel_computador', '$this->hotel_convencoes', '$this->hotel_observacoes', '$this->hotel_classificacao', '$this->hotel_categoria', '$this->hotel_logo', '$this->hotel_cod_estrangeiro')"; 
              }
              $comando = str_replace("N'null'", "null", $comando) ; 
              $comando = str_replace("'null'", "null", $comando) ; 
              $comando = str_replace("#null#", "null", $comando) ; 
              $comando = str_replace($this->Ini->date_delim . "null" . $this->Ini->date_delim1, "null", $comando) ; 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                $comando = str_replace("EXTEND('', YEAR TO FRACTION)", "null", $comando) ; 
                $comando = str_replace("EXTEND(null, YEAR TO FRACTION)", "null", $comando) ; 
                $comando = str_replace("EXTEND('', YEAR TO DAY)", "null", $comando) ; 
                $comando = str_replace("EXTEND(null, YEAR TO DAY)", "null", $comando) ; 
              }  
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $comando; 
              $rs = $this->Db->Execute($comando); 
              if ($rs === false)  
              { 
                  if (FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "MAIL SENT") && FALSE === strpos(strtoupper($this->Db->ErrorMsg()), "WARNING"))
                  {
                      $dbErrorMessage = $this->Db->ErrorMsg();
                      $dbErrorCode = $this->Db->ErrorNo();
                      $this->handleDbErrorMessage($dbErrorMessage, $dbErrorCode);
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $dbErrorMessage, true);
                      if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
                      { 
                          $this->sc_erro_insert = $dbErrorMessage;
                          $this->nmgp_opcao     = 'refresh_insert';
                          $this->NM_rollback_db(); 
                          if ($this->NM_ajax_flag)
                          {
                              form_tbl_hoteis_pack_ajax_response();
                              exit; 
                          }
                      }  
                  }  
              }  
              if ('refresh_insert' != $this->nmgp_opcao)
              {
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase)) 
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select @@identity"; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      $this->NM_rollback_db(); 
                      if ($this->NM_ajax_flag)
                      {
                          form_tbl_hoteis_pack_ajax_response();
                      }
                      exit; 
                  } 
                  $this->hotel_id =  $rsy->fields[0];
                 $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  {
                      $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select last_insert_id()"; 
                  }
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->hotel_id = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SELECT dbinfo('sqlca.sqlerrd1') FROM " . $this->Ini->nm_tabela; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->hotel_id = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select .currval from dual"; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->hotel_id = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
              { 
                  $str_tabela = "SYSIBM.SYSDUMMY1"; 
                  if($this->Ini->nm_con_use_schema == "N") 
                  { 
                          $str_tabela = "SYSDUMMY1"; 
                  } 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SELECT IDENTITY_VAL_LOCAL() FROM " . $str_tabela; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->hotel_id = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select CURRVAL('')"; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->hotel_id = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select last_insert_rowid()"; 
                  $rsy = $this->Db->Execute($_SESSION['scriptcase']['sc_sql_ult_comando']); 
                  if ($rsy === false && !$rsy->EOF)  
                  { 
                      $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                      exit; 
                  } 
                  $this->hotel_id = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              $this->hotel_cnpj = $this->hotel_cnpj_before_qstr;
              $this->hotel_fantasia = $this->hotel_fantasia_before_qstr;
              $this->hotel_razsoc = $this->hotel_razsoc_before_qstr;
              $this->hotel_descricao = $this->hotel_descricao_before_qstr;
              $this->hotel_rede = $this->hotel_rede_before_qstr;
              $this->hotel_cep = $this->hotel_cep_before_qstr;
              $this->hotel_pais = $this->hotel_pais_before_qstr;
              $this->hotel_uf = $this->hotel_uf_before_qstr;
              $this->hotel_municipio = $this->hotel_municipio_before_qstr;
              $this->hotel_bairro = $this->hotel_bairro_before_qstr;
              $this->hotel_logradouro = $this->hotel_logradouro_before_qstr;
              $this->hotel_numero = $this->hotel_numero_before_qstr;
              $this->hotel_complemento = $this->hotel_complemento_before_qstr;
              $this->hotel_email = $this->hotel_email_before_qstr;
              $this->hotel_telefone = $this->hotel_telefone_before_qstr;
              $this->hotel_fax = $this->hotel_fax_before_qstr;
              $this->hotel_celular = $this->hotel_celular_before_qstr;
              $this->hotel_website = $this->hotel_website_before_qstr;
              $this->hotel_facebook = $this->hotel_facebook_before_qstr;
              $this->hotel_twitter = $this->hotel_twitter_before_qstr;
              $this->hotel_skype = $this->hotel_skype_before_qstr;
              $this->hotel_observacoes = $this->hotel_observacoes_before_qstr;
              $this->hotel_classificacao = $this->hotel_classificacao_before_qstr;
              $this->hotel_categoria = $this->hotel_categoria_before_qstr;
              $this->hotel_cod_estrangeiro = $this->hotel_cod_estrangeiro_before_qstr;
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql)) 
              { 
              }   
              if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
              { 
                  if (trim($this->hotel_logo ) != "") 
                  { 
                      $_SESSION['scriptcase']['sc_sql_ult_comando'] = "UpdateBlob(" . $this->Ini->nm_tabela . ",  hotel_logo , $this->hotel_logo,  \"hotel_id = $this->hotel_id\")"; 
                      $rs = $this->Db->UpdateBlob($this->Ini->nm_tabela, "hotel_logo", $this->hotel_logo,  "hotel_id = $this->hotel_id"); 
                      if ($rs === false)  
                      { 
                          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
                          $this->NM_rollback_db(); 
                          if ($this->NM_ajax_flag)
                          {
                              form_tbl_hoteis_pack_ajax_response();
                          }
                          exit; 
                      }  
                  }  
              }  
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['total']);
              }

              $this->sc_evento = "insert"; 
              $this->hotel_cnpj = $this->hotel_cnpj_before_qstr;
              $this->hotel_fantasia = $this->hotel_fantasia_before_qstr;
              $this->hotel_razsoc = $this->hotel_razsoc_before_qstr;
              $this->hotel_descricao = $this->hotel_descricao_before_qstr;
              $this->hotel_rede = $this->hotel_rede_before_qstr;
              $this->hotel_cep = $this->hotel_cep_before_qstr;
              $this->hotel_pais = $this->hotel_pais_before_qstr;
              $this->hotel_uf = $this->hotel_uf_before_qstr;
              $this->hotel_municipio = $this->hotel_municipio_before_qstr;
              $this->hotel_bairro = $this->hotel_bairro_before_qstr;
              $this->hotel_logradouro = $this->hotel_logradouro_before_qstr;
              $this->hotel_numero = $this->hotel_numero_before_qstr;
              $this->hotel_complemento = $this->hotel_complemento_before_qstr;
              $this->hotel_email = $this->hotel_email_before_qstr;
              $this->hotel_telefone = $this->hotel_telefone_before_qstr;
              $this->hotel_fax = $this->hotel_fax_before_qstr;
              $this->hotel_celular = $this->hotel_celular_before_qstr;
              $this->hotel_website = $this->hotel_website_before_qstr;
              $this->hotel_facebook = $this->hotel_facebook_before_qstr;
              $this->hotel_twitter = $this->hotel_twitter_before_qstr;
              $this->hotel_skype = $this->hotel_skype_before_qstr;
              $this->hotel_observacoes = $this->hotel_observacoes_before_qstr;
              $this->hotel_classificacao = $this->hotel_classificacao_before_qstr;
              $this->hotel_categoria = $this->hotel_categoria_before_qstr;
              $this->hotel_cod_estrangeiro = $this->hotel_cod_estrangeiro_before_qstr;
              $this->sc_insert_on = true; 
              if (empty($this->sc_erro_insert)) {
                  $this->record_insert_ok = true;
              } 
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao = "novo"; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] == "R")
              { 
                   $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['return_edit'] = "new";
              } 
              }
              $this->nm_flag_iframe = true;
          } 
          if ($this->lig_edit_lookup)
          {
              $this->lig_edit_lookup_call = true;
          }
      } 
      if ($this->nmgp_opcao == "excluir") 
      { 
          $this->hotel_id = substr($this->Db->qstr($this->hotel_id), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';

          if ($bDelecaoOk)
          {

          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              exit; 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              exit; 
          }  
          $tmp_result = (int) $rs1->fields[0]; 
          if ($tmp_result != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_dele_nfnd']); 
              $this->nmgp_opcao = "nada"; 
              $this->sc_evento = 'delete';
          } 
          else 
          { 
              $rs1->Close(); 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id "); 
              }  
              else  
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where hotel_id = $this->hotel_id "); 
              }  
              if ($rs === false) 
              { 
                  $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dele'], $this->Db->ErrorMsg(), true); 
                  if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler']) 
                  { 
                      $this->sc_erro_delete = $this->Db->ErrorMsg();  
                      $this->NM_rollback_db(); 
                      if ($this->NM_ajax_flag)
                      {
                          form_tbl_hoteis_pack_ajax_response();
                          exit; 
                      }
                  } 
              } 
              $this->sc_evento = "delete"; 
              if (empty($this->sc_erro_delete)) {
                  $this->record_delete_ok = true;
              }
              $this->nmgp_opcao = "avanca"; 
              $this->nm_flag_iframe = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start']--; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start'] = 0; 
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['total']);
              }

              if ($this->lig_edit_lookup)
              {
                  $this->lig_edit_lookup_call = true;
              }
          }

          }
          else
          {
              $this->sc_evento = "delete"; 
              $this->nmgp_opcao = "igual"; 
              $this->Erro->mensagem(__FILE__, __LINE__, "critica", $sMsgErro); 
          }

      }  
      $this->restore_zeros_null();
      if ($salva_opcao == "incluir" && $GLOBALS["erro_incl"] != 1) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['parms'] = "hotel_id?#?$this->hotel_id?@?"; 
      }
      $this->nmgp_dados_form['hotel_logo'] = ""; 
      $this->hotel_logo_limpa = ""; 
      $this->hotel_logo_salva = ""; 
      $this->NM_commit_db(); 
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->hotel_id = null === $this->hotel_id ? null : substr($this->Db->qstr($this->hotel_id), 1, -1); 
      } 
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_filter'] && $sc_where_filter != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_filter'] . ")";
          }
      }
//------------ 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] == "R")
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['iframe_evento']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['iframe_evento'] == "insert") 
          { 
               $this->nmgp_opcao = "novo"; 
               $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['select'] = "";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['iframe_evento'] = $this->sc_evento; 
      } 
      if (!isset($this->nmgp_opcao) || empty($this->nmgp_opcao)) 
      { 
          if (empty($this->hotel_id)) 
          { 
              $this->nmgp_opcao = "inicio"; 
          } 
          else 
          { 
              $this->nmgp_opcao = "igual"; 
          } 
      } 
      if (isset($_POST['master_nav']) && 'on' == $_POST['master_nav']) 
      { 
          $this->nmgp_opcao = "inicio";
      } 
      if ($this->nmgp_opcao != "nada" && (trim($this->hotel_id) == "")) 
      { 
          if ($this->nmgp_opcao == "avanca")  
          { 
              $this->nmgp_opcao = "final"; 
          } 
          elseif ($this->nmgp_opcao != "novo")
          { 
              $this->nmgp_opcao = "inicio"; 
          } 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
      { 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] == "F" && $this->sc_evento == "insert")
      {
          $this->nmgp_opcao = "final";
      }
      $sc_where = trim("");
      if (substr(strtolower($sc_where), 0, 5) == "where")
      {
          $sc_where  = substr($sc_where , 5);
      }
      if (!empty($sc_where))
      {
          $sc_where = " where " . $sc_where . " ";
      }
      if ('' != $sc_where_filter)
      {
          $sc_where = ('' != $sc_where) ? $sc_where . ' and (' . $sc_where_filter . ')' : ' where ' . $sc_where_filter;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['total']))
      { 
          $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where; 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
          $rt = $this->Db->Execute($nmgp_select) ; 
          if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          $qt_geral_reg_form_tbl_hoteis = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['total'] = $qt_geral_reg_form_tbl_hoteis;
          $rt->Close(); 
          if ($this->nmgp_opcao == "igual" && isset($this->NM_btn_navega) && 'S' == $this->NM_btn_navega && !empty($this->hotel_id))
          {
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $Key_Where = "hotel_id < $this->hotel_id "; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $Key_Where = "hotel_id < $this->hotel_id "; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $Key_Where = "hotel_id < $this->hotel_id "; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $Key_Where = "hotel_id < $this->hotel_id "; 
              }
              else  
              {
                  $Key_Where = "hotel_id < $this->hotel_id "; 
              }
              $Where_Start = (empty($sc_where)) ? " where " . $Key_Where :  $sc_where . " and (" . $Key_Where . ")";
              $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $Where_Start; 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rt = $this->Db->Execute($nmgp_select) ; 
              if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
              { 
                  $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
                  exit ; 
              }  
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start'] = $rt->fields[0];
              $this->sc_max_reg = 1;
              $rt->Close(); 
          }
      } 
      else 
      { 
          $qt_geral_reg_form_tbl_hoteis = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['total'];
      } 
      if ($this->nmgp_opcao == "inicio") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start'] = 0; 
      } 
      if ($this->nmgp_opcao == "avanca")  
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start']++; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start'] > $qt_geral_reg_form_tbl_hoteis)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start'] = $qt_geral_reg_form_tbl_hoteis; 
          }
      } 
      if ($this->nmgp_opcao == "retorna") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start']--; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start'] < 0)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start'] = 0; 
          }
      } 
      if ($this->nmgp_opcao == "final") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start'] = $qt_geral_reg_form_tbl_hoteis; 
      } 
      if ($this->nmgp_opcao == "navpage" && ($this->nmgp_ordem - 1) <= $qt_geral_reg_form_tbl_hoteis) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start'] = $this->nmgp_ordem - 1; 
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start'] = 0;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start'] + 1;
      $this->NM_ajax_info['navSummary']['reg_ini'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start'] + 1; 
      $this->NM_ajax_info['navSummary']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_qtd']; 
      $this->NM_ajax_info['navSummary']['reg_tot'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['total'] + 1; 
      $this->NM_gera_nav_page(); 
      $this->NM_ajax_info['navPage'] = $this->SC_nav_page; 
      $GLOBALS["NM_ERRO_IBASE"] = 0;  
//---------- 
      if ($this->nmgp_opcao != "novo" && $this->nmgp_opcao != "nada" && $this->nmgp_opcao != "refresh_insert") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['parms'] = ""; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 1;  
          } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
          { 
              $nmgp_select = "SELECT hotel_id, hotel_cnpj, hotel_fantasia, hotel_razsoc, hotel_descricao, hotel_rede, hotel_cep, hotel_pais, hotel_uf, hotel_municipio, hotel_bairro, hotel_logradouro, hotel_numero, hotel_complemento, hotel_email, hotel_telefone, hotel_fax, hotel_celular, hotel_website, hotel_status, hotel_facebook, hotel_twitter, hotel_skype, hotel_ar_condicionado, hotel_frigobar, hotel_lavanderia, hotel_telefone_quarto, hotel_tv, hotel_ginastica, hotel_restaurante, hotel_bar, hotel_estacionamento, hotel_sauna, hotel_piscina, hotel_wifi, hotel_computador, hotel_convencoes, hotel_observacoes, hotel_classificacao, hotel_categoria, hotel_logo, hotel_cod_estrangeiro from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $nmgp_select = "SELECT hotel_id, hotel_cnpj, hotel_fantasia, hotel_razsoc, hotel_descricao, hotel_rede, hotel_cep, hotel_pais, hotel_uf, hotel_municipio, hotel_bairro, hotel_logradouro, hotel_numero, hotel_complemento, hotel_email, hotel_telefone, hotel_fax, hotel_celular, hotel_website, hotel_status, hotel_facebook, hotel_twitter, hotel_skype, hotel_ar_condicionado, hotel_frigobar, hotel_lavanderia, hotel_telefone_quarto, hotel_tv, hotel_ginastica, hotel_restaurante, hotel_bar, hotel_estacionamento, hotel_sauna, hotel_piscina, hotel_wifi, hotel_computador, hotel_convencoes, hotel_observacoes, hotel_classificacao, hotel_categoria, hotel_logo, hotel_cod_estrangeiro from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          { 
              $nmgp_select = "SELECT hotel_id, hotel_cnpj, hotel_fantasia, hotel_razsoc, hotel_descricao, hotel_rede, hotel_cep, hotel_pais, hotel_uf, hotel_municipio, hotel_bairro, hotel_logradouro, hotel_numero, hotel_complemento, hotel_email, hotel_telefone, hotel_fax, hotel_celular, hotel_website, hotel_status, hotel_facebook, hotel_twitter, hotel_skype, hotel_ar_condicionado, hotel_frigobar, hotel_lavanderia, hotel_telefone_quarto, hotel_tv, hotel_ginastica, hotel_restaurante, hotel_bar, hotel_estacionamento, hotel_sauna, hotel_piscina, hotel_wifi, hotel_computador, hotel_convencoes, hotel_observacoes, hotel_classificacao, hotel_categoria, hotel_logo, hotel_cod_estrangeiro from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $nmgp_select = "SELECT hotel_id, hotel_cnpj, hotel_fantasia, hotel_razsoc, hotel_descricao, hotel_rede, hotel_cep, hotel_pais, hotel_uf, hotel_municipio, hotel_bairro, hotel_logradouro, hotel_numero, hotel_complemento, hotel_email, hotel_telefone, hotel_fax, hotel_celular, hotel_website, hotel_status, hotel_facebook, hotel_twitter, hotel_skype, hotel_ar_condicionado, hotel_frigobar, hotel_lavanderia, hotel_telefone_quarto, hotel_tv, hotel_ginastica, hotel_restaurante, hotel_bar, hotel_estacionamento, hotel_sauna, hotel_piscina, hotel_wifi, hotel_computador, hotel_convencoes, hotel_observacoes, hotel_classificacao, hotel_categoria, LOTOFILE(hotel_logo, '" . $this->Ini->root . $this->Ini->path_imag_temp . "/sc_blob_hotel_logo', 'client'), hotel_cod_estrangeiro from " . $this->Ini->nm_tabela ; 
          } 
          else 
          { 
              $nmgp_select = "SELECT hotel_id, hotel_cnpj, hotel_fantasia, hotel_razsoc, hotel_descricao, hotel_rede, hotel_cep, hotel_pais, hotel_uf, hotel_municipio, hotel_bairro, hotel_logradouro, hotel_numero, hotel_complemento, hotel_email, hotel_telefone, hotel_fax, hotel_celular, hotel_website, hotel_status, hotel_facebook, hotel_twitter, hotel_skype, hotel_ar_condicionado, hotel_frigobar, hotel_lavanderia, hotel_telefone_quarto, hotel_tv, hotel_ginastica, hotel_restaurante, hotel_bar, hotel_estacionamento, hotel_sauna, hotel_piscina, hotel_wifi, hotel_computador, hotel_convencoes, hotel_observacoes, hotel_classificacao, hotel_categoria, hotel_logo, hotel_cod_estrangeiro from " . $this->Ini->nm_tabela ; 
          } 
          $aWhere = array();
          $aWhere[] = $sc_where_filter;
          if ($this->nmgp_opcao == "igual" || (($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] == "R") && ($this->sc_evento == "insert" || $this->sc_evento == "update")) )
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $aWhere[] = "hotel_id = $this->hotel_id"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $aWhere[] = "hotel_id = $this->hotel_id"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $aWhere[] = "hotel_id = $this->hotel_id"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $aWhere[] = "hotel_id = $this->hotel_id"; 
              }  
              else  
              {
                  $aWhere[] = "hotel_id = $this->hotel_id"; 
              }  
              if (!empty($sc_where_filter))  
              {
                  $teste_select = $nmgp_select . $this->returnWhere($aWhere);
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = $teste_select; 
                  $rs = $this->Db->Execute($teste_select); 
                  if ($rs->EOF)
                  {
                     $aWhere = array($sc_where_filter);
                  }  
                  $rs->Close(); 
              }  
          } 
          $nmgp_select .= $this->returnWhere($aWhere) . ' ';
          $sc_order_by = "";
          $sc_order_by = "hotel_id";
          $sc_order_by = str_replace("order by ", "", $sc_order_by);
          $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
          if (!empty($sc_order_by))
          {
              $nmgp_select .= " order by $sc_order_by "; 
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] == "R")
          {
              if ($this->sc_evento == "update")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['select'] = $nmgp_select;
                  $this->nm_gera_html();
              } 
              elseif (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['select']))
              { 
                  $nmgp_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['select'];
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['select'] = ""; 
              } 
          } 
          if ($this->nmgp_opcao == "igual") 
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start']) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start']) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start']) ; 
          } 
          else  
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
              if (!$rs === false && !$rs->EOF) 
              { 
                  $rs->Move($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start']) ;  
              } 
          } 
          if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          if ($rs === false && $GLOBALS["NM_ERRO_IBASE"] == 1) 
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_nfnd_extr'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          if ($rs->EOF) 
          { 
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_filter']))
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['update']  = $this->nmgp_botoes['update']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['delete']  = $this->nmgp_botoes['delete']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['insert']  = "off";
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['empty_filter'] = true;
                  return; 
              }
              if ($this->nmgp_botoes['insert'] != "on")
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
              }
              $this->nmgp_opcao = "novo"; 
              $this->nm_flag_saida_novo = "S"; 
              $rs->Close(); 
              if ($this->aba_iframe)
              {
                  $this->NM_ajax_info['buttonDisplay']['exit'] = $this->nmgp_botoes['exit'] = 'off';
              }
          } 
          if ($rs === false && $GLOBALS["NM_ERRO_IBASE"] == 1) 
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->Erro->mensagem (__FILE__, __LINE__, "critica", $this->Ini->Nm_lang['lang_errm_nfnd_extr']); 
              $this->nmgp_opcao = "novo"; 
          }  
          if ($this->nmgp_opcao != "novo") 
          { 
              $this->hotel_id = $rs->fields[0] ; 
              $this->nmgp_dados_select['hotel_id'] = $this->hotel_id;
              $this->hotel_cnpj = $rs->fields[1] ; 
              $this->nmgp_dados_select['hotel_cnpj'] = $this->hotel_cnpj;
              $this->hotel_fantasia = $rs->fields[2] ; 
              $this->nmgp_dados_select['hotel_fantasia'] = $this->hotel_fantasia;
              $this->hotel_razsoc = $rs->fields[3] ; 
              $this->nmgp_dados_select['hotel_razsoc'] = $this->hotel_razsoc;
              $this->hotel_descricao = $rs->fields[4] ; 
              $this->nmgp_dados_select['hotel_descricao'] = $this->hotel_descricao;
              $this->hotel_rede = $rs->fields[5] ; 
              $this->nmgp_dados_select['hotel_rede'] = $this->hotel_rede;
              $this->hotel_cep = $rs->fields[6] ; 
              $this->nmgp_dados_select['hotel_cep'] = $this->hotel_cep;
              $this->hotel_pais = $rs->fields[7] ; 
              $this->nmgp_dados_select['hotel_pais'] = $this->hotel_pais;
              $this->hotel_uf = $rs->fields[8] ; 
              $this->nmgp_dados_select['hotel_uf'] = $this->hotel_uf;
              $this->hotel_municipio = $rs->fields[9] ; 
              $this->nmgp_dados_select['hotel_municipio'] = $this->hotel_municipio;
              $this->hotel_bairro = $rs->fields[10] ; 
              $this->nmgp_dados_select['hotel_bairro'] = $this->hotel_bairro;
              $this->hotel_logradouro = $rs->fields[11] ; 
              $this->nmgp_dados_select['hotel_logradouro'] = $this->hotel_logradouro;
              $this->hotel_numero = $rs->fields[12] ; 
              $this->nmgp_dados_select['hotel_numero'] = $this->hotel_numero;
              $this->hotel_complemento = $rs->fields[13] ; 
              $this->nmgp_dados_select['hotel_complemento'] = $this->hotel_complemento;
              $this->hotel_email = $rs->fields[14] ; 
              $this->nmgp_dados_select['hotel_email'] = $this->hotel_email;
              $this->hotel_telefone = $rs->fields[15] ; 
              $this->nmgp_dados_select['hotel_telefone'] = $this->hotel_telefone;
              $this->hotel_fax = $rs->fields[16] ; 
              $this->nmgp_dados_select['hotel_fax'] = $this->hotel_fax;
              $this->hotel_celular = $rs->fields[17] ; 
              $this->nmgp_dados_select['hotel_celular'] = $this->hotel_celular;
              $this->hotel_website = $rs->fields[18] ; 
              $this->nmgp_dados_select['hotel_website'] = $this->hotel_website;
              $this->hotel_status = $rs->fields[19] ; 
              $this->nmgp_dados_select['hotel_status'] = $this->hotel_status;
              $this->hotel_facebook = $rs->fields[20] ; 
              $this->nmgp_dados_select['hotel_facebook'] = $this->hotel_facebook;
              $this->hotel_twitter = $rs->fields[21] ; 
              $this->nmgp_dados_select['hotel_twitter'] = $this->hotel_twitter;
              $this->hotel_skype = $rs->fields[22] ; 
              $this->nmgp_dados_select['hotel_skype'] = $this->hotel_skype;
              $this->hotel_ar_condicionado = $rs->fields[23] ; 
              $this->nmgp_dados_select['hotel_ar_condicionado'] = $this->hotel_ar_condicionado;
              $this->hotel_frigobar = $rs->fields[24] ; 
              $this->nmgp_dados_select['hotel_frigobar'] = $this->hotel_frigobar;
              $this->hotel_lavanderia = $rs->fields[25] ; 
              $this->nmgp_dados_select['hotel_lavanderia'] = $this->hotel_lavanderia;
              $this->hotel_telefone_quarto = $rs->fields[26] ; 
              $this->nmgp_dados_select['hotel_telefone_quarto'] = $this->hotel_telefone_quarto;
              $this->hotel_tv = $rs->fields[27] ; 
              $this->nmgp_dados_select['hotel_tv'] = $this->hotel_tv;
              $this->hotel_ginastica = $rs->fields[28] ; 
              $this->nmgp_dados_select['hotel_ginastica'] = $this->hotel_ginastica;
              $this->hotel_restaurante = $rs->fields[29] ; 
              $this->nmgp_dados_select['hotel_restaurante'] = $this->hotel_restaurante;
              $this->hotel_bar = $rs->fields[30] ; 
              $this->nmgp_dados_select['hotel_bar'] = $this->hotel_bar;
              $this->hotel_estacionamento = $rs->fields[31] ; 
              $this->nmgp_dados_select['hotel_estacionamento'] = $this->hotel_estacionamento;
              $this->hotel_sauna = $rs->fields[32] ; 
              $this->nmgp_dados_select['hotel_sauna'] = $this->hotel_sauna;
              $this->hotel_piscina = $rs->fields[33] ; 
              $this->nmgp_dados_select['hotel_piscina'] = $this->hotel_piscina;
              $this->hotel_wifi = $rs->fields[34] ; 
              $this->nmgp_dados_select['hotel_wifi'] = $this->hotel_wifi;
              $this->hotel_computador = $rs->fields[35] ; 
              $this->nmgp_dados_select['hotel_computador'] = $this->hotel_computador;
              $this->hotel_convencoes = $rs->fields[36] ; 
              $this->nmgp_dados_select['hotel_convencoes'] = $this->hotel_convencoes;
              $this->hotel_observacoes = $rs->fields[37] ; 
              $this->nmgp_dados_select['hotel_observacoes'] = $this->hotel_observacoes;
              $this->hotel_classificacao = $rs->fields[38] ; 
              $this->nmgp_dados_select['hotel_classificacao'] = $this->hotel_classificacao;
              $this->hotel_categoria = $rs->fields[39] ; 
              $this->nmgp_dados_select['hotel_categoria'] = $this->hotel_categoria;
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $this->hotel_logo = $this->Db->BlobDecode($rs->fields[40]) ; 
              } 
              elseif ($this->Ini->nm_tpbanco == 'pdo_oracle')
              { 
                  $this->hotel_logo = $this->Db->BlobDecode($rs->fields[40]) ; 
              } 
              elseif ($this->Ini->nm_tpbanco == 'pdo_ibm')
              { 
                  $this->hotel_logo = $this->Db->BlobDecode($rs->fields[40]) ; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  if(isset($rs->fields[40]) && !empty($rs->fields[40]) && is_file($rs->fields[40])) 
                  { 
                     $this->hotel_logo = file_get_contents($rs->fields[40]);
                  }else 
                  { 
                     $this->hotel_logo = ''; 
                  } 
              } 
              else
              { 
                  $this->hotel_logo = $rs->fields[40] ; 
              } 
              $this->nmgp_dados_select['hotel_logo'] = $this->hotel_logo;
              $this->hotel_cod_estrangeiro = $rs->fields[41] ; 
              $this->nmgp_dados_select['hotel_cod_estrangeiro'] = $this->hotel_cod_estrangeiro;
          $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->hotel_id = (string)$this->hotel_id; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['parms'] = "hotel_id?#?$this->hotel_id?@?";
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sub_dir'][0]  = "";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dados_select'] = $this->nmgp_dados_select;
          if (!$this->NM_ajax_flag || 'backup_line' != $this->NM_ajax_opcao)
          {
              $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start'];
              $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start'] < $qt_geral_reg_form_tbl_hoteis;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['opcao']   = '';
          }
      } 
      if ($this->nmgp_opcao == "novo" || $this->nmgp_opcao == "refresh_insert") 
      { 
          $this->sc_evento_old = $this->sc_evento;
          $this->sc_evento = "novo";
          if ('refresh_insert' == $this->nmgp_opcao)
          {
              $this->nmgp_opcao = 'novo';
          }
          else
          {
              $this->nm_formatar_campos();
              $this->hotel_id = "";  
              $this->nmgp_dados_form["hotel_id"] = $this->hotel_id;
              $this->hotel_cnpj = "";  
              $this->nmgp_dados_form["hotel_cnpj"] = $this->hotel_cnpj;
              $this->hotel_fantasia = "";  
              $this->nmgp_dados_form["hotel_fantasia"] = $this->hotel_fantasia;
              $this->hotel_razsoc = "";  
              $this->nmgp_dados_form["hotel_razsoc"] = $this->hotel_razsoc;
              $this->hotel_descricao = "";  
              $this->nmgp_dados_form["hotel_descricao"] = $this->hotel_descricao;
              $this->hotel_rede = "";  
              $this->nmgp_dados_form["hotel_rede"] = $this->hotel_rede;
              $this->hotel_cep = "";  
              $this->nmgp_dados_form["hotel_cep"] = $this->hotel_cep;
              $this->hotel_pais = "BRASIL";  
              $this->nmgp_dados_form["hotel_pais"] = $this->hotel_pais;
              $this->hotel_uf = "";  
              $this->nmgp_dados_form["hotel_uf"] = $this->hotel_uf;
              $this->hotel_municipio = "";  
              $this->nmgp_dados_form["hotel_municipio"] = $this->hotel_municipio;
              $this->hotel_bairro = "";  
              $this->nmgp_dados_form["hotel_bairro"] = $this->hotel_bairro;
              $this->hotel_logradouro = "";  
              $this->nmgp_dados_form["hotel_logradouro"] = $this->hotel_logradouro;
              $this->hotel_numero = "";  
              $this->nmgp_dados_form["hotel_numero"] = $this->hotel_numero;
              $this->hotel_complemento = "";  
              $this->nmgp_dados_form["hotel_complemento"] = $this->hotel_complemento;
              $this->hotel_email = "";  
              $this->nmgp_dados_form["hotel_email"] = $this->hotel_email;
              $this->hotel_telefone = "";  
              $this->nmgp_dados_form["hotel_telefone"] = $this->hotel_telefone;
              $this->hotel_fax = "";  
              $this->nmgp_dados_form["hotel_fax"] = $this->hotel_fax;
              $this->hotel_celular = "";  
              $this->nmgp_dados_form["hotel_celular"] = $this->hotel_celular;
              $this->hotel_website = "";  
              $this->nmgp_dados_form["hotel_website"] = $this->hotel_website;
              $this->hotel_status = "";  
              $this->nmgp_dados_form["hotel_status"] = $this->hotel_status;
              $this->hotel_facebook = "";  
              $this->nmgp_dados_form["hotel_facebook"] = $this->hotel_facebook;
              $this->hotel_twitter = "";  
              $this->nmgp_dados_form["hotel_twitter"] = $this->hotel_twitter;
              $this->hotel_skype = "";  
              $this->nmgp_dados_form["hotel_skype"] = $this->hotel_skype;
              $this->hotel_ar_condicionado = "";  
              $this->nmgp_dados_form["hotel_ar_condicionado"] = $this->hotel_ar_condicionado;
              $this->hotel_frigobar = "";  
              $this->nmgp_dados_form["hotel_frigobar"] = $this->hotel_frigobar;
              $this->hotel_lavanderia = "";  
              $this->nmgp_dados_form["hotel_lavanderia"] = $this->hotel_lavanderia;
              $this->hotel_telefone_quarto = "";  
              $this->nmgp_dados_form["hotel_telefone_quarto"] = $this->hotel_telefone_quarto;
              $this->hotel_tv = "";  
              $this->nmgp_dados_form["hotel_tv"] = $this->hotel_tv;
              $this->hotel_ginastica = "";  
              $this->nmgp_dados_form["hotel_ginastica"] = $this->hotel_ginastica;
              $this->hotel_restaurante = "";  
              $this->nmgp_dados_form["hotel_restaurante"] = $this->hotel_restaurante;
              $this->hotel_bar = "";  
              $this->nmgp_dados_form["hotel_bar"] = $this->hotel_bar;
              $this->hotel_estacionamento = "";  
              $this->nmgp_dados_form["hotel_estacionamento"] = $this->hotel_estacionamento;
              $this->hotel_sauna = "";  
              $this->nmgp_dados_form["hotel_sauna"] = $this->hotel_sauna;
              $this->hotel_piscina = "";  
              $this->nmgp_dados_form["hotel_piscina"] = $this->hotel_piscina;
              $this->hotel_wifi = "";  
              $this->nmgp_dados_form["hotel_wifi"] = $this->hotel_wifi;
              $this->hotel_computador = "";  
              $this->nmgp_dados_form["hotel_computador"] = $this->hotel_computador;
              $this->hotel_convencoes = "";  
              $this->nmgp_dados_form["hotel_convencoes"] = $this->hotel_convencoes;
              $this->hotel_observacoes = "";  
              $this->nmgp_dados_form["hotel_observacoes"] = $this->hotel_observacoes;
              $this->hotel_classificacao = "";  
              $this->nmgp_dados_form["hotel_classificacao"] = $this->hotel_classificacao;
              $this->hotel_categoria = "";  
              $this->nmgp_dados_form["hotel_categoria"] = $this->hotel_categoria;
              $this->hotel_logo = "";  
              $this->hotel_logo_ul_name = "" ;  
              $this->hotel_logo_ul_type = "" ;  
              $this->nmgp_dados_form["hotel_logo"] = $this->hotel_logo;
              $this->hotel_cod_estrangeiro = "";  
              $this->nmgp_dados_form["hotel_cod_estrangeiro"] = $this->hotel_cod_estrangeiro;
              $this->localizacao = "";  
              $this->nmgp_dados_form["localizacao"] = $this->localizacao;
              $this->rodape = "";  
              $this->nmgp_dados_form["rodape"] = $this->rodape;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dados_form'] = $this->nmgp_dados_form;
              $this->formatado = false;
          }
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
      }  
//
//
//-- 
      if ($this->nmgp_opcao != "novo") 
      {
      }
      if (!isset($this->nmgp_refresh_fields)) 
      { 
          $this->nm_proc_onload();
      }
  }
// 
//-- 
   function nm_db_retorna($str_where_param = '') 
   {  
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $str_where_filter = ('' != $str_where_param) ? ' and ' . $str_where_param : '';
     if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(hotel_id) from " . $this->Ini->nm_tabela . " where hotel_id < $this->hotel_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(hotel_id) from " . $this->Ini->nm_tabela . " where hotel_id < $this->hotel_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(hotel_id) from " . $this->Ini->nm_tabela . " where hotel_id < $this->hotel_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(hotel_id) from " . $this->Ini->nm_tabela . " where hotel_id < $this->hotel_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(hotel_id) from " . $this->Ini->nm_tabela . " where hotel_id < $this->hotel_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(hotel_id) from " . $this->Ini->nm_tabela . " where hotel_id < $this->hotel_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(hotel_id) from " . $this->Ini->nm_tabela . " where hotel_id < $this->hotel_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(hotel_id) from " . $this->Ini->nm_tabela . " where hotel_id < $this->hotel_id" . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(hotel_id) from " . $this->Ini->nm_tabela . " where hotel_id < $this->hotel_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(hotel_id) from " . $this->Ini->nm_tabela . " where hotel_id < $this->hotel_id" . $str_where_filter); 
     }  
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (isset($rs->fields[0]) && $rs->fields[0] != "") 
     { 
         $this->hotel_id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
         $rs->Close();  
         $this->nmgp_opcao = "igual";  
         return ;  
     } 
     else 
     { 
        $this->nmgp_opcao = "inicio";  
        $rs->Close();  
        return ; 
     } 
   } 
// 
//-- 
   function nm_db_avanca($str_where_param = '') 
   {  
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $str_where_filter = ('' != $str_where_param) ? ' and ' . $str_where_param : '';
     if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(hotel_id) from " . $this->Ini->nm_tabela . " where hotel_id > $this->hotel_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(hotel_id) from " . $this->Ini->nm_tabela . " where hotel_id > $this->hotel_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(hotel_id) from " . $this->Ini->nm_tabela . " where hotel_id > $this->hotel_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(hotel_id) from " . $this->Ini->nm_tabela . " where hotel_id > $this->hotel_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(hotel_id) from " . $this->Ini->nm_tabela . " where hotel_id > $this->hotel_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(hotel_id) from " . $this->Ini->nm_tabela . " where hotel_id > $this->hotel_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(hotel_id) from " . $this->Ini->nm_tabela . " where hotel_id > $this->hotel_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(hotel_id) from " . $this->Ini->nm_tabela . " where hotel_id > $this->hotel_id" . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(hotel_id) from " . $this->Ini->nm_tabela . " where hotel_id > $this->hotel_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(hotel_id) from " . $this->Ini->nm_tabela . " where hotel_id > $this->hotel_id" . $str_where_filter); 
     }  
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (isset($rs->fields[0]) && $rs->fields[0] != "") 
     { 
         $this->hotel_id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
         $rs->Close();  
         $this->nmgp_opcao = "igual";  
         return ;  
     } 
     else 
     { 
        $this->nmgp_opcao = "final";  
        $rs->Close();  
        return ; 
     } 
   } 
// 
//-- 
   function nm_db_inicio($str_where_param = '') 
   {   
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela; 
     $rs = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela);
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if ($rs->fields[0] == 0) 
     { 
         $this->nmgp_opcao = "novo"; 
         $this->nm_flag_saida_novo = "S"; 
         $rs->Close(); 
         if ($this->aba_iframe)
         {
             $this->nmgp_botoes['exit'] = 'off';
         }
         return;
     }
     $str_where_filter = ('' != $str_where_param) ? ' where ' . $str_where_param : '';
     if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(hotel_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(hotel_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(hotel_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(hotel_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(hotel_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(hotel_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(hotel_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(hotel_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(hotel_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(hotel_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (!isset($rs->fields[0]) || $rs->EOF) 
     { 
         if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_filter']))
         { 
             $rs->Close();  
             return ; 
         } 
         $this->nm_flag_saida_novo = "S"; 
         $this->nmgp_opcao = "novo";  
         $rs->Close();  
         if ($this->aba_iframe)
         {
             $this->nmgp_botoes['exit'] = 'off';
         }
         return ; 
     } 
     $this->hotel_id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
     $rs->Close();  
     $this->nmgp_opcao = "igual";  
     return ;  
   } 
// 
//-- 
   function nm_db_final($str_where_param = '') 
   { 
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $str_where_filter = ('' != $str_where_param) ? ' where ' . $str_where_param : '';
     if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(hotel_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(hotel_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(hotel_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(hotel_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(hotel_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(hotel_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(hotel_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(hotel_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(hotel_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(hotel_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (!isset($rs->fields[0]) || $rs->EOF) 
     { 
         $this->nm_flag_saida_novo = "S"; 
         $this->nmgp_opcao = "novo";  
         $rs->Close();  
         if ($this->aba_iframe)
         {
             $this->nmgp_botoes['exit'] = 'off';
         }
         return ; 
     } 
     $this->hotel_id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
     $rs->Close();  
     $this->nmgp_opcao = "igual";  
     return ;  
   } 
   function NM_gera_nav_page() 
   {
       $this->SC_nav_page = "";
       $Arr_result        = array();
       $Ind_result        = 0;
       $Reg_Page   = 1;
       $Max_link   = 5;
       $Mid_link   = ceil($Max_link / 2);
       $Corr_link  = (($Max_link % 2) == 0) ? 0 : 1;
       $rec_tot    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['total'] + 1;
       $rec_fim    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start'] + 1;
       $rec_fim    = ($rec_fim > $rec_tot) ? $rec_tot : $rec_fim;
       if ($rec_tot == 0)
       {
           return;
       }
       $Qtd_Pages  = ceil($rec_tot / $Reg_Page);
       $Page_Atu   = ceil($rec_fim / $Reg_Page);
       $Link_ini   = 1;
       if ($Page_Atu > $Max_link)
       {
           $Link_ini = $Page_Atu - $Mid_link + $Corr_link;
       }
       elseif ($Page_Atu > $Mid_link)
       {
           $Link_ini = $Page_Atu - $Mid_link + $Corr_link;
       }
       if (($Qtd_Pages - $Link_ini) < $Max_link)
       {
           $Link_ini = ($Qtd_Pages - $Max_link) + 1;
       }
       if ($Link_ini < 1)
       {
           $Link_ini = 1;
       }
       for ($x = 0; $x < $Max_link && $Link_ini <= $Qtd_Pages; $x++)
       {
           $rec = (($Link_ini - 1) * $Reg_Page) + 1;
           if ($Link_ini == $Page_Atu)
           {
               $Arr_result[$Ind_result] = '<span class="scFormToolbarNavOpen" style="vertical-align: middle;">' . $Link_ini . '</span>';
           }
           else
           {
               $Arr_result[$Ind_result] = '<a class="scFormToolbarNav" style="vertical-align: middle;" href="javascript: nm_navpage(' . $rec . ')">' . $Link_ini . '</a>';
           }
           $Link_ini++;
           $Ind_result++;
           if (!isset($this->Ini->Str_toolbarnav_separator))
           {
               $this->Ini->Str_toolbarnav_separator = "";
           }
           if (($x + 1) < $Max_link && $Link_ini <= $Qtd_Pages && '' != $this->Ini->Str_toolbarnav_separator && @is_file($this->Ini->root . $this->Ini->path_img_global . $this->Ini->Str_toolbarnav_separator))
           {
               $Arr_result[$Ind_result] = '<img src="' . $this->Ini->path_img_global . $this->Ini->Str_toolbarnav_separator . '" align="absmiddle" style="vertical-align: middle;">';
               $Ind_result++;
           }
       }
       if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
       {
           krsort($Arr_result);
       }
       foreach ($Arr_result as $Ind_result => $Lin_result)
       {
           $this->SC_nav_page .= $Lin_result;
       }
   }
        function initializeRecordState() {
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['record_state'][$sc_seq_vert]['buttons']['update'];
                }
        }

//

function hotel_cnpj_onChange()
{
$_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'on';
  
$original_hotel_cnpj = $this->hotel_cnpj;
$original_hotel_rede = $this->hotel_rede;
$original_hotel_razsoc = $this->hotel_razsoc;
$original_hotel_fantasia = $this->hotel_fantasia;
$original_hotel_cod_estrangeiro = $this->hotel_cod_estrangeiro;
$original_hotel_cep = $this->hotel_cep;
$original_hotel_pais = $this->hotel_pais;
$original_hotel_email = $this->hotel_email;
$original_hotel_website = $this->hotel_website;

$cnpj = $this->hotel_cnpj ;
if ($this->hotel_rede  <> 'HOTEL INTERNACIONAL') {
	$webservice = "https://www.receitaws.com.br/v1/cnpj/".$cnpj;
	$consulta = file_get_contents($webservice);
	$retorno = json_decode($consulta,true);
	if($retorno["status"] == "OK") {
		if($retorno["situacao"] ==  "ATIVA") {
			$this->hotel_razsoc  = $retorno["nome"];
			$pcnpj = substr($cnpj,0,2).'.'.substr($cnpj,2,3).'.'.substr($cnpj,5,3).'/'.substr($cnpj,8,4).'-'.substr($cnpj,12,2);		
			$sql="
			SELECT 
				cod_for, fan_for, cnpj_for, cep_for, pais_for, num_for, email_for, hpage_for
			FROM 
				wgfor
			WHERE 
				cnpj_for = ".$this->Db->qstr($pcnpj)."
			ORDER BY 
				cnpj_for
			"
			;	
			 
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Ini->nm_db_gate->Execute($nm_select)) 
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
          $this->rs_erro = $this->Ini->nm_db_gate->ErrorMsg();
      } 
	
			if (isset($this->rs[0][0])) {
				$this->hotel_cod_estrangeiro  = $this->rs[0][0];
				$this->hotel_fantasia  		= $this->rs[0][1];
				$this->hotel_pais 			= $this->rs[0][4];	
				$this->hotel_email 			= strtolower($this->rs[0][6]);
				$this->hotel_website 			= strtolower($this->rs[0][7]);
			} else {
				$this->sc_ajax_message ("Fornecedor não Encontrado no ERP!", "RSVP", "timeout=5");
			}	
		} else {	
			$this->sc_ajax_message ("Empresa Inativa!", "RSVP", "timeout=5");
		}
	} else {	
		$this->sc_ajax_message ("Empresa não Existe!", "RSVP", "timeout=5");		
	}
}



$modificado_hotel_cnpj = $this->hotel_cnpj;
$modificado_hotel_rede = $this->hotel_rede;
$modificado_hotel_razsoc = $this->hotel_razsoc;
$modificado_hotel_fantasia = $this->hotel_fantasia;
$modificado_hotel_cod_estrangeiro = $this->hotel_cod_estrangeiro;
$modificado_hotel_cep = $this->hotel_cep;
$modificado_hotel_pais = $this->hotel_pais;
$modificado_hotel_email = $this->hotel_email;
$modificado_hotel_website = $this->hotel_website;
$this->nm_formatar_campos('hotel_cnpj', 'hotel_rede', 'hotel_razsoc', 'hotel_fantasia', 'hotel_cod_estrangeiro', 'hotel_cep', 'hotel_pais', 'hotel_email', 'hotel_website');
if ($original_hotel_cnpj !== $modificado_hotel_cnpj || isset($this->nmgp_cmp_readonly['hotel_cnpj']) || (isset($bFlagRead_hotel_cnpj) && $bFlagRead_hotel_cnpj))
{
    $this->ajax_return_values_hotel_cnpj(true);
}
if ($original_hotel_rede !== $modificado_hotel_rede || isset($this->nmgp_cmp_readonly['hotel_rede']) || (isset($bFlagRead_hotel_rede) && $bFlagRead_hotel_rede))
{
    $this->ajax_return_values_hotel_rede(true);
}
if ($original_hotel_razsoc !== $modificado_hotel_razsoc || isset($this->nmgp_cmp_readonly['hotel_razsoc']) || (isset($bFlagRead_hotel_razsoc) && $bFlagRead_hotel_razsoc))
{
    $this->ajax_return_values_hotel_razsoc(true);
}
if ($original_hotel_fantasia !== $modificado_hotel_fantasia || isset($this->nmgp_cmp_readonly['hotel_fantasia']) || (isset($bFlagRead_hotel_fantasia) && $bFlagRead_hotel_fantasia))
{
    $this->ajax_return_values_hotel_fantasia(true);
}
if ($original_hotel_cod_estrangeiro !== $modificado_hotel_cod_estrangeiro || isset($this->nmgp_cmp_readonly['hotel_cod_estrangeiro']) || (isset($bFlagRead_hotel_cod_estrangeiro) && $bFlagRead_hotel_cod_estrangeiro))
{
    $this->ajax_return_values_hotel_cod_estrangeiro(true);
}
if ($original_hotel_cep !== $modificado_hotel_cep || isset($this->nmgp_cmp_readonly['hotel_cep']) || (isset($bFlagRead_hotel_cep) && $bFlagRead_hotel_cep))
{
    $this->ajax_return_values_hotel_cep(true);
}
if ($original_hotel_pais !== $modificado_hotel_pais || isset($this->nmgp_cmp_readonly['hotel_pais']) || (isset($bFlagRead_hotel_pais) && $bFlagRead_hotel_pais))
{
    $this->ajax_return_values_hotel_pais(true);
}
if ($original_hotel_email !== $modificado_hotel_email || isset($this->nmgp_cmp_readonly['hotel_email']) || (isset($bFlagRead_hotel_email) && $bFlagRead_hotel_email))
{
    $this->ajax_return_values_hotel_email(true);
}
if ($original_hotel_website !== $modificado_hotel_website || isset($this->nmgp_cmp_readonly['hotel_website']) || (isset($bFlagRead_hotel_website) && $bFlagRead_hotel_website))
{
    $this->ajax_return_values_hotel_website(true);
}
$this->NM_ajax_info['event_field'] = 'hotel';
form_tbl_hoteis_pack_ajax_response();
exit;
$_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'off';
}


function hotel_descricao_onFocus()
{
$_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'on';
  
$original_hotel_descricao = $this->hotel_descricao;
$original_hotel_fantasia = $this->hotel_fantasia;

$this->hotel_descricao  = $this->hotel_fantasia ;

$modificado_hotel_descricao = $this->hotel_descricao;
$modificado_hotel_fantasia = $this->hotel_fantasia;
$this->nm_formatar_campos('hotel_descricao', 'hotel_fantasia');
if ($original_hotel_descricao !== $modificado_hotel_descricao || isset($this->nmgp_cmp_readonly['hotel_descricao']) || (isset($bFlagRead_hotel_descricao) && $bFlagRead_hotel_descricao))
{
    $this->ajax_return_values_hotel_descricao(true);
}
if ($original_hotel_fantasia !== $modificado_hotel_fantasia || isset($this->nmgp_cmp_readonly['hotel_fantasia']) || (isset($bFlagRead_hotel_fantasia) && $bFlagRead_hotel_fantasia))
{
    $this->ajax_return_values_hotel_fantasia(true);
}
$this->NM_ajax_info['event_field'] = 'hotel';
form_tbl_hoteis_pack_ajax_response();
exit;


$_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'off';
}


function hotel_numero_onChange()
{
$_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'on';
  
$original_localizacao = $this->localizacao;
$original_hotel_logradouro = $this->hotel_logradouro;
$original_hotel_numero = $this->hotel_numero;
$original_hotel_bairro = $this->hotel_bairro;
$original_hotel_municipio = $this->hotel_municipio;

$this->localizacao  = "http://maps.google.com.br/maps?hl=pt-BR&tab=wl&q="."$this->hotel_logradouro ,"."$this->hotel_numero "."$this->hotel_bairro "."$this->hotel_municipio ";


$modificado_localizacao = $this->localizacao;
$modificado_hotel_logradouro = $this->hotel_logradouro;
$modificado_hotel_numero = $this->hotel_numero;
$modificado_hotel_bairro = $this->hotel_bairro;
$modificado_hotel_municipio = $this->hotel_municipio;
$this->nm_formatar_campos('localizacao', 'hotel_logradouro', 'hotel_numero', 'hotel_bairro', 'hotel_municipio');
if ($original_localizacao !== $modificado_localizacao || isset($this->nmgp_cmp_readonly['localizacao']) || (isset($bFlagRead_localizacao) && $bFlagRead_localizacao))
{
    $this->ajax_return_values_localizacao(true);
}
if ($original_hotel_logradouro !== $modificado_hotel_logradouro || isset($this->nmgp_cmp_readonly['hotel_logradouro']) || (isset($bFlagRead_hotel_logradouro) && $bFlagRead_hotel_logradouro))
{
    $this->ajax_return_values_hotel_logradouro(true);
}
if ($original_hotel_numero !== $modificado_hotel_numero || isset($this->nmgp_cmp_readonly['hotel_numero']) || (isset($bFlagRead_hotel_numero) && $bFlagRead_hotel_numero))
{
    $this->ajax_return_values_hotel_numero(true);
}
if ($original_hotel_bairro !== $modificado_hotel_bairro || isset($this->nmgp_cmp_readonly['hotel_bairro']) || (isset($bFlagRead_hotel_bairro) && $bFlagRead_hotel_bairro))
{
    $this->ajax_return_values_hotel_bairro(true);
}
if ($original_hotel_municipio !== $modificado_hotel_municipio || isset($this->nmgp_cmp_readonly['hotel_municipio']) || (isset($bFlagRead_hotel_municipio) && $bFlagRead_hotel_municipio))
{
    $this->ajax_return_values_hotel_municipio(true);
}
$this->NM_ajax_info['event_field'] = 'hotel';
form_tbl_hoteis_pack_ajax_response();
exit;


$_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'off';
}


function GetUsuarioNivel($idu,$tipo) {
$_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'on';
  
		date_default_timezone_set('America/Sao_Paulo');
		switch($nivel) {
		case 'ADMINISTRADOR':
			break;
		case 'CONVIDADO':
			$this->NM_ajax_info['buttonDisplay']['delete'] = $this->nmgp_botoes["delete"] = 'off';;	
			break;		
		case 'EXECUTIVO':
			$this->NM_ajax_info['buttonDisplay']['delete'] = $this->nmgp_botoes["delete"] = 'off';;	
			break;				
		case 'OPERACIONAL':
			$this->NM_ajax_info['buttonDisplay']['delete'] = $this->nmgp_botoes["delete"] = 'off';;	
			break;				
		case 'SUPERVISOR':
			$this->NM_ajax_info['buttonDisplay']['delete'] = $this->nmgp_botoes["delete"] = 'on';;	
			break;						
	}
$_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['form_tbl_hoteis']['contr_erro'] = 'off';
}

//
 function nm_gera_html()
 {
    global
           $nm_url_saida, $nmgp_url_saida, $nm_saida_global, $nm_apl_dependente, $glo_subst, $sc_check_excl, $sc_check_incl, $nmgp_num_form, $NM_run_iframe;
     if ($this->Embutida_proc)
     {
         return;
     }
     if ($this->nmgp_form_show == 'off')
     {
         exit;
     }
      if (isset($NM_run_iframe) && $NM_run_iframe == 1)
      {
          $this->nmgp_botoes['exit'] = "off";
      }
     $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
     $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['opc_ant'] = $this->nmgp_opcao;
     }
     else
     {
         $this->nmgp_opcao = $this->nmgp_opc_ant;
     }
     if (!empty($this->Campos_Mens_erro)) 
     {
         $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro); 
         $this->Campos_Mens_erro = "";
     }
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              form_tbl_hoteis_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
//-- 
   if ($this->nmgp_opcao == "novo")
   { 
       $out_hotel_logo = "";  
   } 
   else 
   { 
       $out_hotel_logo = $this->hotel_logo;  
   } 
   if ($this->hotel_logo != "" && $this->hotel_logo != "none")   
   { 
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access)) 
       { 
           $nm_tmp = nm_conv_img_access(substr($this->hotel_logo, 0, 12));
           if (is_string($this->hotel_logo) && substr($this->hotel_logo, 0, 4) != "*nm*" && is_string($nm_tmp) && substr($nm_tmp, 0, 4) == "*nm*") 
           { 
               $this->hotel_logo = nm_conv_img_access($this->hotel_logo);
           } 
       } 
       if (is_string($this->hotel_logo) && substr($this->hotel_logo, 0, 4) == "*nm*") 
       { 
           $this->hotel_logo = substr($this->hotel_logo, 4) ; 
           $this->hotel_logo = base64_decode($this->hotel_logo) ; 
       } 
       $img_pos_bm = (is_string($this->hotel_logo)) ? strpos($this->hotel_logo, "BM") : false; 
       if (!$img_pos_bm === FALSE && $img_pos_bm == 78) 
       { 
           $this->hotel_logo = substr($this->hotel_logo, $img_pos_bm) ; 
       } 
       $Ext_File = $this->scGetImageExtension($this->hotel_logo);
       $out_hotel_logo = $this->Ini->path_imag_temp . "/sc_hotel_logo_" . $_SESSION['scriptcase']['sc_num_img'] . session_id() . $Ext_File;  
       $arq_hotel_logo = fopen($this->Ini->root . $out_hotel_logo, "w") ;  
       fwrite($arq_hotel_logo, (string)$this->hotel_logo) ;  
       fclose($arq_hotel_logo) ;  
       $sc_obj_img = new nm_trata_img($this->Ini->root . $out_hotel_logo, true);
       $this->nmgp_return_img['hotel_logo'][0] = $sc_obj_img->getHeight();
       $this->nmgp_return_img['hotel_logo'][1] = $sc_obj_img->getWidth();
       if ($this->Ini->Export_img_zip) {
           $this->Ini->Img_export_zip[] = $this->Ini->root . $out_hotel_logo;
           $out_hotel_logo = str_replace($this->Ini->path_imag_temp . "/", "", $out_hotel_logo);
       } 
       $_SESSION['scriptcase']['sc_num_img']++ ; 
   } 
   if (isset($_POST['nmgp_opcao']) && 'excluir' == $_POST['nmgp_opcao'] && $this->sc_evento != "delete" && (!isset($this->sc_evento_old) || 'delete' != $this->sc_evento_old))
   {
       global $temp_out_hotel_logo;
       if (isset($temp_out_hotel_logo))
       {
           $out_hotel_logo = $temp_out_hotel_logo;
       }
   }
        $this->initFormPages();
    include_once("form_tbl_hoteis_form0.php");
        $this->hideFormPages();
 }

        function initFormPages() {
        } // initFormPages

        function hideFormPages() {
        } // hideFormPages

    function form_format_readonly($field, $value)
    {
        $result = $value;

        $this->form_highlight_search($result, $field, $value);

        return $result;
    }

    function form_highlight_search(&$result, $field, $value)
    {
        if ($this->proc_fast_search) {
            $this->form_highlight_search_quicksearch($result, $field, $value);
        }
    }

    function form_highlight_search_quicksearch(&$result, $field, $value)
    {
        $searchOk = false;
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array("hotel_id", "hotel_cnpj", "hotel_fantasia", "hotel_razsoc", "hotel_descricao", "hotel_rede", "hotel_classificacao", "hotel_categoria", "hotel_logo", "hotel_cep", "hotel_pais", "hotel_uf", "hotel_municipio", "hotel_bairro", "hotel_logradouro", "hotel_numero", "hotel_complemento", "hotel_observacoes", "hotel_email", "hotel_website", "hotel_telefone", "hotel_fax", "hotel_celular", "hotel_status", "hotel_facebook", "hotel_twitter", "hotel_skype", "hotel_ar_condicionado", "hotel_frigobar", "hotel_lavanderia", "hotel_telefone_quarto", "hotel_tv", "hotel_ginastica", "hotel_restaurante", "hotel_bar", "hotel_estacionamento", "hotel_sauna", "hotel_piscina", "hotel_wifi", "hotel_computador", "hotel_convencoes", "hotel_cod_estrangeiro"))) {
            $searchOk = true;
        }
        elseif ($field == $this->nmgp_fast_search && in_array($field, array("hotel_id", "hotel_cnpj", "hotel_fantasia", "hotel_razsoc", "hotel_descricao", "hotel_rede", "hotel_classificacao", "hotel_categoria", "hotel_logo", "hotel_cep", "hotel_pais", "hotel_uf", "hotel_municipio", "hotel_bairro", "hotel_logradouro", "hotel_numero", "hotel_complemento", "hotel_observacoes", "hotel_email", "hotel_website", "hotel_telefone", "hotel_fax", "hotel_celular", "hotel_status", "hotel_facebook", "hotel_twitter", "hotel_skype", "hotel_ar_condicionado", "hotel_frigobar", "hotel_lavanderia", "hotel_telefone_quarto", "hotel_tv", "hotel_ginastica", "hotel_restaurante", "hotel_bar", "hotel_estacionamento", "hotel_sauna", "hotel_piscina", "hotel_wifi", "hotel_computador", "hotel_convencoes", "hotel_cod_estrangeiro"))) {
            $searchOk = true;
        }

        if (!$searchOk || '' == $this->nmgp_arg_fast_search) {
            return;
        }

        $htmlIni = '<div class="highlight" style="background-color: #fafaca; display: inline-block">';
        $htmlFim = '</div>';

        if ('qp' == $this->nmgp_cond_fast_search) {
            $keywords = preg_quote($this->nmgp_arg_fast_search, '/');
            $result = preg_replace('/'. $keywords .'/i', $htmlIni . '$0' . $htmlFim, $result);
        } elseif ('eq' == $this->nmgp_cond_fast_search) {
            if (strcasecmp($this->nmgp_arg_fast_search, $value) == 0) {
                $result = $htmlIni. $result .$htmlFim;
            }
        }
    }


    function form_encode_input($string)
    {
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['table_refresh'])
        {
            return NM_encode_input(NM_encode_input($string));
        }
        else
        {
            return NM_encode_input($string);
        }
    } // form_encode_input


    function scCsrfGetToken()
    {
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['csrf_token'];
    }

    function scCsrfGenerateToken()
    {
        $aSources = array(
            'abcdefghijklmnopqrstuvwxyz',
            'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
            '1234567890',
            '!@$*()-_[]{},.;:'
        );

        $sRandom = '';

        $aSourcesSizes = array();
        $iSourceSize   = sizeof($aSources) - 1;
        for ($i = 0; $i <= $iSourceSize; $i++)
        {
            $aSourcesSizes[$i] = strlen($aSources[$i]) - 1;
        }

        for ($i = 0; $i < 64; $i++)
        {
            $iSource = $this->scCsrfRandom(0, $iSourceSize);
            $sRandom .= substr($aSources[$iSource], $this->scCsrfRandom(0, $aSourcesSizes[$iSource]), 1);
        }

        return $sRandom;
    }

    function scCsrfRandom($iMin, $iMax)
    {
        return mt_rand($iMin, $iMax);
    }

        function addUrlParam($url, $param, $value) {
                $urlParts  = explode('?', $url);
                $urlParams = isset($urlParts[1]) ? explode('&', $urlParts[1]) : array();
                $objParams = array();
                foreach ($urlParams as $paramInfo) {
                        $paramParts = explode('=', $paramInfo);
                        $objParams[ $paramParts[0] ] = isset($paramParts[1]) ? $paramParts[1] : '';
                }
                $objParams[$param] = $value;
                $urlParams = array();
                foreach ($objParams as $paramName => $paramValue) {
                        $urlParams[] = $paramName . '=' . $paramValue;
                }
                return $urlParts[0] . '?' . implode('&', $urlParams);
        }
 function allowedCharsCharset($charlist)
 {
     if ($_SESSION['scriptcase']['charset'] != 'UTF-8')
     {
         $charlist = NM_conv_charset($charlist, $_SESSION['scriptcase']['charset'], 'UTF-8');
     }
     return str_replace("'", "\'", $charlist);
 }

function sc_file_size($file, $format = false)
{
    if ('' == $file) {
        return '';
    }
    if (!@is_file($file)) {
        return '';
    }
    $fileSize = @filesize($file);
    if ($format) {
        $suffix = '';
        if (1024 >= $fileSize) {
            $fileSize /= 1024;
            $suffix    = ' KB';
        }
        if (1024 >= $fileSize) {
            $fileSize /= 1024;
            $suffix    = ' MB';
        }
        if (1024 >= $fileSize) {
            $fileSize /= 1024;
            $suffix    = ' GB';
        }
        $fileSize = $fileSize . $suffix;
    }
    return $fileSize;
}


 function new_date_format($type, $field)
 {
     $new_date_format_out = '';

     if ('DT' == $type)
     {
         $date_format  = $this->field_config[$field]['date_format'];
         $date_sep     = $this->field_config[$field]['date_sep'];
         $date_display = $this->field_config[$field]['date_display'];
         $time_format  = '';
         $time_sep     = '';
         $time_display = '';
     }
     elseif ('DH' == $type)
     {
         $date_format  = false !== strpos($this->field_config[$field]['date_format'] , ';') ? substr($this->field_config[$field]['date_format'] , 0, strpos($this->field_config[$field]['date_format'] , ';')) : $this->field_config[$field]['date_format'];
         $date_sep     = $this->field_config[$field]['date_sep'];
         $date_display = false !== strpos($this->field_config[$field]['date_display'], ';') ? substr($this->field_config[$field]['date_display'], 0, strpos($this->field_config[$field]['date_display'], ';')) : $this->field_config[$field]['date_display'];
         $time_format  = false !== strpos($this->field_config[$field]['date_format'] , ';') ? substr($this->field_config[$field]['date_format'] , strpos($this->field_config[$field]['date_format'] , ';') + 1) : '';
         $time_sep     = $this->field_config[$field]['time_sep'];
         $time_display = false !== strpos($this->field_config[$field]['date_display'], ';') ? substr($this->field_config[$field]['date_display'], strpos($this->field_config[$field]['date_display'], ';') + 1) : '';
     }
     elseif ('HH' == $type)
     {
         $date_format  = '';
         $date_sep     = '';
         $date_display = '';
         $time_format  = $this->field_config[$field]['date_format'];
         $time_sep     = $this->field_config[$field]['time_sep'];
         $time_display = $this->field_config[$field]['date_display'];
     }

     if ('DT' == $type || 'DH' == $type)
     {
         $date_array = array();
         $date_index = 0;
         $date_ult   = '';
         for ($i = 0; $i < strlen($date_format); $i++)
         {
             $char = strtolower(substr($date_format, $i, 1));
             if (in_array($char, array('d', 'm', 'y', 'a')))
             {
                 if ('a' == $char)
                 {
                     $char = 'y';
                 }
                 if ($char == $date_ult)
                 {
                     $date_array[$date_index] .= $char;
                 }
                 else
                 {
                     if ('' != $date_ult)
                     {
                         $date_index++;
                     }
                     $date_array[$date_index] = $char;
                 }
             }
             $date_ult = $char;
         }

         $disp_array = array();
         $date_index = 0;
         $date_ult   = '';
         for ($i = 0; $i < strlen($date_display); $i++)
         {
             $char = strtolower(substr($date_display, $i, 1));
             if (in_array($char, array('d', 'm', 'y', 'a')))
             {
                 if ('a' == $char)
                 {
                     $char = 'y';
                 }
                 if ($char == $date_ult)
                 {
                     $disp_array[$date_index] .= $char;
                 }
                 else
                 {
                     if ('' != $date_ult)
                     {
                         $date_index++;
                     }
                     $disp_array[$date_index] = $char;
                 }
             }
             $date_ult = $char;
         }

         $date_final = array();
         foreach ($date_array as $date_part)
         {
             if (in_array($date_part, $disp_array))
             {
                 $date_final[] = $date_part;
             }
         }

         $date_format = implode($date_sep, $date_final);
     }
     if ('HH' == $type || 'DH' == $type)
     {
         $time_array = array();
         $time_index = 0;
         $time_ult   = '';
         for ($i = 0; $i < strlen($time_format); $i++)
         {
             $char = strtolower(substr($time_format, $i, 1));
             if (in_array($char, array('h', 'i', 's')))
             {
                 if ($char == $time_ult)
                 {
                     $time_array[$time_index] .= $char;
                 }
                 else
                 {
                     if ('' != $time_ult)
                     {
                         $time_index++;
                     }
                     $time_array[$time_index] = $char;
                 }
             }
             $time_ult = $char;
         }

         $disp_array = array();
         $time_index = 0;
         $time_ult   = '';
         for ($i = 0; $i < strlen($time_display); $i++)
         {
             $char = strtolower(substr($time_display, $i, 1));
             if (in_array($char, array('h', 'i', 's')))
             {
                 if ($char == $time_ult)
                 {
                     $disp_array[$time_index] .= $char;
                 }
                 else
                 {
                     if ('' != $time_ult)
                     {
                         $time_index++;
                     }
                     $disp_array[$time_index] = $char;
                 }
             }
             $time_ult = $char;
         }

         $time_final = array();
         foreach ($time_array as $time_part)
         {
             if (in_array($time_part, $disp_array))
             {
                 $time_final[] = $time_part;
             }
         }

         $time_format = implode($time_sep, $time_final);
     }

     if ('DT' == $type)
     {
         $old_date_format = $date_format;
     }
     elseif ('DH' == $type)
     {
         $old_date_format = $date_format . ';' . $time_format;
     }
     elseif ('HH' == $type)
     {
         $old_date_format = $time_format;
     }

     for ($i = 0; $i < strlen($old_date_format); $i++)
     {
         $char = substr($old_date_format, $i, 1);
         if ('/' == $char)
         {
             $new_date_format_out .= $date_sep;
         }
         elseif (':' == $char)
         {
             $new_date_format_out .= $time_sep;
         }
         else
         {
             $new_date_format_out .= $char;
         }
     }

     $this->field_config[$field]['date_format'] = $new_date_format_out;
     if ('DH' == $type)
     {
         $new_date_format_out                                  = explode(';', $new_date_format_out);
         $this->field_config[$field]['date_format_js']        = $new_date_format_out[0];
         $this->field_config[$field . '_hora']['date_format'] = $new_date_format_out[1];
         $this->field_config[$field . '_hora']['time_sep']    = $this->field_config[$field]['time_sep'];
     }
 } // new_date_format

   function Form_lookup_hotel_rede()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede'] = array(); 
    }

   $old_value_hotel_id = $this->hotel_id;
   $old_value_hotel_cep = $this->hotel_cep;
   $old_value_hotel_telefone = $this->hotel_telefone;
   $old_value_hotel_fax = $this->hotel_fax;
   $old_value_hotel_celular = $this->hotel_celular;
   $this->nm_tira_formatacao();


   $unformatted_value_hotel_id = $this->hotel_id;
   $unformatted_value_hotel_cep = $this->hotel_cep;
   $unformatted_value_hotel_telefone = $this->hotel_telefone;
   $unformatted_value_hotel_fax = $this->hotel_fax;
   $unformatted_value_hotel_celular = $this->hotel_celular;

   $nm_comando = "SELECT rede_hoteis_descricao  FROM tbl_rede_hoteis  ORDER BY rede_hoteis_descricao";

   $this->hotel_id = $old_value_hotel_id;
   $this->hotel_cep = $old_value_hotel_cep;
   $this->hotel_telefone = $old_value_hotel_telefone;
   $this->hotel_fax = $old_value_hotel_fax;
   $this->hotel_celular = $old_value_hotel_celular;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede'][] = $rs->fields[0];
              $nmgp_def_dados .= $rs->fields[0] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   return $todo;

   }
   function Form_lookup_hotel_classificacao()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao'] = array(); 
    }

   $old_value_hotel_id = $this->hotel_id;
   $old_value_hotel_cep = $this->hotel_cep;
   $old_value_hotel_telefone = $this->hotel_telefone;
   $old_value_hotel_fax = $this->hotel_fax;
   $old_value_hotel_celular = $this->hotel_celular;
   $this->nm_tira_formatacao();


   $unformatted_value_hotel_id = $this->hotel_id;
   $unformatted_value_hotel_cep = $this->hotel_cep;
   $unformatted_value_hotel_telefone = $this->hotel_telefone;
   $unformatted_value_hotel_fax = $this->hotel_fax;
   $unformatted_value_hotel_celular = $this->hotel_celular;

   $nm_comando = "SELECT hotel_class_id, hotel_tipo  FROM tbl_hoteis_class  ORDER BY hotel_tipo";

   $this->hotel_id = $old_value_hotel_id;
   $this->hotel_cep = $old_value_hotel_cep;
   $this->hotel_telefone = $old_value_hotel_telefone;
   $this->hotel_fax = $old_value_hotel_fax;
   $this->hotel_celular = $old_value_hotel_celular;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   return $todo;

   }
   function Form_lookup_hotel_categoria()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria'] = array(); 
    }

   $old_value_hotel_id = $this->hotel_id;
   $old_value_hotel_cep = $this->hotel_cep;
   $old_value_hotel_telefone = $this->hotel_telefone;
   $old_value_hotel_fax = $this->hotel_fax;
   $old_value_hotel_celular = $this->hotel_celular;
   $this->nm_tira_formatacao();


   $unformatted_value_hotel_id = $this->hotel_id;
   $unformatted_value_hotel_cep = $this->hotel_cep;
   $unformatted_value_hotel_telefone = $this->hotel_telefone;
   $unformatted_value_hotel_fax = $this->hotel_fax;
   $unformatted_value_hotel_celular = $this->hotel_celular;

   $nm_comando = "SELECT categ_hotel_id, classificacao  FROM tbl_categ_hoteis  ORDER BY classificacao";

   $this->hotel_id = $old_value_hotel_id;
   $this->hotel_cep = $old_value_hotel_cep;
   $this->hotel_telefone = $old_value_hotel_telefone;
   $this->hotel_fax = $old_value_hotel_fax;
   $this->hotel_celular = $old_value_hotel_celular;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   return $todo;

   }
   function Form_lookup_hotel_pais()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais'] = array(); 
    }

   $old_value_hotel_id = $this->hotel_id;
   $old_value_hotel_cep = $this->hotel_cep;
   $old_value_hotel_telefone = $this->hotel_telefone;
   $old_value_hotel_fax = $this->hotel_fax;
   $old_value_hotel_celular = $this->hotel_celular;
   $this->nm_tira_formatacao();


   $unformatted_value_hotel_id = $this->hotel_id;
   $unformatted_value_hotel_cep = $this->hotel_cep;
   $unformatted_value_hotel_telefone = $this->hotel_telefone;
   $unformatted_value_hotel_fax = $this->hotel_fax;
   $unformatted_value_hotel_celular = $this->hotel_celular;

   $nm_comando = "SELECT pais_id, descricao  FROM tbl_paises  ORDER BY descricao";

   $this->hotel_id = $old_value_hotel_id;
   $this->hotel_cep = $old_value_hotel_cep;
   $this->hotel_telefone = $old_value_hotel_telefone;
   $this->hotel_fax = $old_value_hotel_fax;
   $this->hotel_celular = $old_value_hotel_celular;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   return $todo;

   }
   function Form_lookup_hotel_status()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Ativo?#?Y?#?S?@?";
       $nmgp_def_dados .= "Inativo?#?N?#?N?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_hotel_ar_condicionado()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Sim?#?Y?#?N?@?";
       $nmgp_def_dados .= "Não?#?N?#?S?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_hotel_frigobar()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Sim?#?Y?#?N?@?";
       $nmgp_def_dados .= "Não?#?N?#?S?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_hotel_lavanderia()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Sim?#?Y?#?N?@?";
       $nmgp_def_dados .= "Não?#?N?#?S?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_hotel_telefone_quarto()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Sim?#?Y?#?N?@?";
       $nmgp_def_dados .= "Não?#?N?#?S?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_hotel_tv()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Sim?#?Y?#?N?@?";
       $nmgp_def_dados .= "Não?#?N?#?S?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_hotel_ginastica()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Sim?#?Y?#?N?@?";
       $nmgp_def_dados .= "Não?#?N?#?S?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_hotel_restaurante()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Sim?#?Y?#?N?@?";
       $nmgp_def_dados .= "Não?#?N?#?S?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_hotel_bar()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Sim?#?Y?#?N?@?";
       $nmgp_def_dados .= "Não?#?N?#?S?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_hotel_estacionamento()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Sim?#?Y?#?N?@?";
       $nmgp_def_dados .= "Não?#?N?#?S?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_hotel_sauna()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Sim?#?Y?#?N?@?";
       $nmgp_def_dados .= "Não?#?N?#?S?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_hotel_piscina()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Sim?#?Y?#?N?@?";
       $nmgp_def_dados .= "Não?#?N?#?S?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_hotel_wifi()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Sim?#?Y?#?N?@?";
       $nmgp_def_dados .= "Não?#?N?#?S?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_hotel_computador()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Sim?#?Y?#?N?@?";
       $nmgp_def_dados .= "Não?#?N?#?S?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_hotel_convencoes()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Sim?#?Y?#?N?@?";
       $nmgp_def_dados .= "Não?#?N?#?S?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function SC_fast_search($in_fields, $arg_search, $data_search)
   {
      $fields = (strpos($in_fields, "SC_all_Cmp") !== false) ? array("SC_all_Cmp") : explode(";", $in_fields);
      $this->NM_case_insensitive = true;
      if (empty($data_search)) 
      {
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dyn_search_and_or']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dyn_search_cache']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              form_tbl_hoteis_pack_ajax_response();
              exit;
          }
          return;
      }
      $comando = "";
      if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($data_search))
      {
          $data_search = NM_conv_charset($data_search, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
      $sv_data = $data_search;
      foreach ($fields as $field) {
          if ($field == "SC_all_Cmp" || $field == "hotel_id") 
          {
              $this->SC_monta_condicao($comando, "hotel_id", $arg_search, str_replace(",", ".", $data_search), "INT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_cnpj") 
          {
              $this->SC_monta_condicao($comando, "hotel_cnpj", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_fantasia") 
          {
              $this->SC_monta_condicao($comando, "hotel_fantasia", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_razsoc") 
          {
              $this->SC_monta_condicao($comando, "hotel_razsoc", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_descricao") 
          {
              $this->SC_monta_condicao($comando, "hotel_descricao", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_rede") 
          {
              $data_lookup = $this->SC_lookup_hotel_rede($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "hotel_rede", $arg_search, $data_lookup, "VARCHAR", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_classificacao") 
          {
              $data_lookup = $this->SC_lookup_hotel_classificacao($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "hotel_classificacao", $arg_search, $data_lookup, "VARCHAR", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_categoria") 
          {
              $data_lookup = $this->SC_lookup_hotel_categoria($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "hotel_categoria", $arg_search, $data_lookup, "VARCHAR", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_logo") 
          {
              $this->SC_monta_condicao($comando, "hotel_logo", $arg_search, $data_search, "BLOB", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_cep") 
          {
              $this->SC_monta_condicao($comando, "hotel_cep", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_pais") 
          {
              $data_lookup = $this->SC_lookup_hotel_pais($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "hotel_pais", $arg_search, $data_lookup, "VARCHAR", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_uf") 
          {
              $this->SC_monta_condicao($comando, "hotel_uf", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_municipio") 
          {
              $this->SC_monta_condicao($comando, "hotel_municipio", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_bairro") 
          {
              $this->SC_monta_condicao($comando, "hotel_bairro", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_logradouro") 
          {
              $this->SC_monta_condicao($comando, "hotel_logradouro", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_numero") 
          {
              $this->SC_monta_condicao($comando, "hotel_numero", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_complemento") 
          {
              $this->SC_monta_condicao($comando, "hotel_complemento", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_observacoes") 
          {
              $this->SC_monta_condicao($comando, "hotel_observacoes", $arg_search, $data_search, "TINYTEXT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_email") 
          {
              $this->SC_monta_condicao($comando, "hotel_email", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_website") 
          {
              $this->SC_monta_condicao($comando, "hotel_website", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_telefone") 
          {
              $this->SC_monta_condicao($comando, "hotel_telefone", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_fax") 
          {
              $this->SC_monta_condicao($comando, "hotel_fax", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_celular") 
          {
              $this->SC_monta_condicao($comando, "hotel_celular", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_status") 
          {
              $data_lookup = $this->SC_lookup_hotel_status($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "hotel_status", $arg_search, $data_lookup, "ENUM", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_facebook") 
          {
              $this->SC_monta_condicao($comando, "hotel_facebook", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_twitter") 
          {
              $this->SC_monta_condicao($comando, "hotel_twitter", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_skype") 
          {
              $this->SC_monta_condicao($comando, "hotel_skype", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_ar_condicionado") 
          {
              $data_lookup = $this->SC_lookup_hotel_ar_condicionado($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "hotel_ar_condicionado", $arg_search, $data_lookup, "ENUM", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_frigobar") 
          {
              $data_lookup = $this->SC_lookup_hotel_frigobar($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "hotel_frigobar", $arg_search, $data_lookup, "ENUM", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_lavanderia") 
          {
              $data_lookup = $this->SC_lookup_hotel_lavanderia($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "hotel_lavanderia", $arg_search, $data_lookup, "ENUM", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_telefone_quarto") 
          {
              $data_lookup = $this->SC_lookup_hotel_telefone_quarto($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "hotel_telefone_quarto", $arg_search, $data_lookup, "ENUM", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_tv") 
          {
              $data_lookup = $this->SC_lookup_hotel_tv($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "hotel_tv", $arg_search, $data_lookup, "ENUM", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_ginastica") 
          {
              $data_lookup = $this->SC_lookup_hotel_ginastica($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "hotel_ginastica", $arg_search, $data_lookup, "ENUM", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_restaurante") 
          {
              $data_lookup = $this->SC_lookup_hotel_restaurante($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "hotel_restaurante", $arg_search, $data_lookup, "ENUM", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_bar") 
          {
              $data_lookup = $this->SC_lookup_hotel_bar($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "hotel_bar", $arg_search, $data_lookup, "ENUM", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_estacionamento") 
          {
              $data_lookup = $this->SC_lookup_hotel_estacionamento($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "hotel_estacionamento", $arg_search, $data_lookup, "ENUM", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_sauna") 
          {
              $data_lookup = $this->SC_lookup_hotel_sauna($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "hotel_sauna", $arg_search, $data_lookup, "ENUM", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_piscina") 
          {
              $data_lookup = $this->SC_lookup_hotel_piscina($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "hotel_piscina", $arg_search, $data_lookup, "ENUM", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_wifi") 
          {
              $data_lookup = $this->SC_lookup_hotel_wifi($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "hotel_wifi", $arg_search, $data_lookup, "ENUM", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_computador") 
          {
              $data_lookup = $this->SC_lookup_hotel_computador($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "hotel_computador", $arg_search, $data_lookup, "ENUM", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_convencoes") 
          {
              $data_lookup = $this->SC_lookup_hotel_convencoes($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "hotel_convencoes", $arg_search, $data_lookup, "ENUM", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_cod_estrangeiro") 
          {
              $this->SC_monta_condicao($comando, "hotel_cod_estrangeiro", $arg_search, $data_search, "VARCHAR", false);
          }
      }
      if ($this->NM_case_insensitive)
      {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $comando = str_replace("#lowerI#", "UCase(", $comando);
          }
          else
          {
              $comando = str_replace("#lowerI#", "Upper(", $comando);
           }
          $comando = str_replace("#lowerF#", ")", $comando);
      }
      else
      {
          $comando = str_replace("#lowerI#", "", $comando);
          $comando = str_replace("#lowerF#", "", $comando);
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_filter_form'] . " and (" . $comando . ")";
      }
      else
      {
         $sc_where = " where " . $comando;
      }
      $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
      $rt = $this->Db->Execute($nmgp_select) ; 
      if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
      { 
          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit ; 
      }  
      $qt_geral_reg_form_tbl_hoteis = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['total'] = $qt_geral_reg_form_tbl_hoteis;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_tbl_hoteis_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_tbl_hoteis_pack_ajax_response();
          exit;
      }
   }
   function SC_monta_condicao(&$comando, $nome, $condicao, $campo, $tp_campo="", $tp_unaccent=false)
   {
      $nm_aspas   = "'";
      $nm_aspas1  = "'";
      $nm_numeric = array();
      $Nm_datas   = array();
      $nm_esp_postgres = array();
      $campo_join = strtolower(str_replace(".", "_", $nome));
      $nm_ini_lower = " #lowerI#";
      $nm_fim_lower = "#lowerF#";
      $Nm_accent = $this->Ini->Nm_accent_no;
      if ($tp_unaccent) {
          $Nm_accent = $this->Ini->Nm_accent_yes;
      }
      $nm_numeric[] = "hotel_id";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['decimal_db'] == ".")
         {
             $nm_aspas  = "";
             $nm_aspas1 = "";
         }
         if (is_array($campo))
         {
             foreach ($campo as $Ind => $Cmp)
             {
                if (!is_numeric($Cmp))
                {
                    return;
                }
                if ($Cmp == "")
                {
                    $campo[$Ind] = 0;
                }
             }
         }
         else
         {
             if (!is_numeric($campo))
             {
                 return;
             }
             if ($campo == "")
             {
                $campo = 0;
             }
         }
         $nm_ini_lower = "";
         $nm_fim_lower = "";
      }
      if (is_array($campo)) {
          foreach ($campo as $Ind => $Cmp) {
             if ($Cmp != null) {
                 $campo[$Ind] = substr($this->Ini->Db->qstr($Cmp), 1, -1);
             }
          }
      }
      else {
          $campo = substr($this->Ini->Db->qstr($campo), 1, -1);
      }
         if (in_array($campo_join, $nm_numeric) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && (strtoupper($condicao) == "II" || strtoupper($condicao) == "QP" || strtoupper($condicao) == "NP"))
         {
             $nome      = "CAST ($nome AS TEXT)";
             $nm_aspas  = "'";
             $nm_aspas1 = "'";
         }
         if (in_array($campo_join, $nm_esp_postgres) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
         {
             $nome      = "CAST ($nome AS TEXT)";
             $nm_aspas  = "'";
             $nm_aspas1 = "'";
         }
         if (in_array($campo_join, $nm_numeric) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase) && (strtoupper($condicao) == "II" || strtoupper($condicao) == "QP" || strtoupper($condicao) == "NP"))
         {
             $nome      = "CAST ($nome AS VARCHAR)";
             $nm_aspas  = "'";
             $nm_aspas1 = "'";
         }
         if (in_array($campo_join, $nm_numeric) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress) && (strtoupper($condicao) == "II" || strtoupper($condicao) == "QP" || strtoupper($condicao) == "NP"))
         {
             $nome      = "CAST ($nome AS VARCHAR(255))";
             $nm_aspas  = "'";
             $nm_aspas1 = "'";
         }
         $comando .= (!empty($comando) ? " or " : "");
         if (is_array($campo))
         {
             $prep = "";
             foreach ($campo as $Ind => $Cmp)
             {
                 $prep .= (!empty($prep)) ? "," : "";
                 $Cmp   = substr($this->Db->qstr($Cmp), 1, -1);
                 $prep .= $nm_ini_lower . $nm_aspas . $Cmp . $nm_aspas1 . $nm_fim_lower;
             }
             $prep .= (empty($prep)) ? $nm_aspas . $nm_aspas1 : "";
             $comando .= $nm_ini_lower . $nome . $nm_fim_lower . " in (" . $prep . ")";
             return;
         }
         $campo  = substr($this->Db->qstr($campo), 1, -1);
         $cond_tst = strtoupper($condicao);
         if ($cond_tst == "II" || $cond_tst == "QP" || $cond_tst == "NP")
         {
             if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && $this->NM_case_insensitive)
             {
                 $op_like      = " ilike ";
                 $nm_ini_lower = "";
                 $nm_fim_lower = "";
             }
             else
             {
                 $op_like = " like ";
             }
         }
         switch ($cond_tst)
         {
            case "EQ":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " = " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "II":     // 
               $comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_like . $nm_ini_lower . "'" . $Nm_accent['arg_i'] . sc_sql_escape($this->Ini->nm_tpbanco, $campo) . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'] . $_SESSION['sc_session']['sc_sql_escape'];
            break;
            case "QP":     // 
               $comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_like . $nm_ini_lower . "'%" . $Nm_accent['arg_i'] . sc_sql_escape($this->Ini->nm_tpbanco, $campo) . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'] . $_SESSION['sc_session']['sc_sql_escape'];
            break;
            case "NP":     // 
               $comando        .= $nm_ini_lower . $Nm_accent['cmp_i'] . $nome . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . " not" . $op_like . $nm_ini_lower . "'%" . $Nm_accent['arg_i'] . sc_sql_escape($this->Ini->nm_tpbanco, $campo) . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'] . $_SESSION['sc_session']['sc_sql_escape'];
            break;
            case "DF":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "GT":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " > " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "GE":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " >= " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "LT":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " < " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
            case "LE":     // 
               $comando        .= $nm_ini_lower . $nome . $nm_fim_lower . " <= " . $nm_ini_lower . $nm_aspas . $campo . $nm_aspas1 . $nm_fim_lower;
            break;
         }
   }
   function SC_lookup_hotel_rede($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $nm_comando = "SELECT rede_hoteis_descricao FROM tbl_rede_hoteis WHERE (#lowerI##cmp_irede_hoteis_descricao#cmp_f)#cmp_apos LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')#arg_apos)" ; 
       if ($condicao == "ii")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "LIKE #lowerI#'#arg_i" . $campo . "#arg_f%')", $nm_comando);
       }
       if ($condicao == "np")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "NOT LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", $nm_comando);
       }
       if ($condicao == "df")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "<> #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if ($condicao == "gt")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "> #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if ($condicao == "ge")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", ">= #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if ($condicao == "lt")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "< #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if ($condicao == "le")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "<= #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
       {
           $nm_comando = str_replace("#lowerI#", "UCase(", $nm_comando);
       }
       else
       {
           $nm_comando = str_replace("#lowerI#", "Upper(", $nm_comando);
       }
       $nm_comando = str_replace(array('#cmp_i','#cmp_f','#cmp_apos','#arg_i','#arg_f','#arg_apos'), array('','','','','',''), $nm_comando); 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
       $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
       if ($rx = $this->Db->Execute($nm_comando)) 
       { 
           $campo = $campo_orig;
           if ($this->NM_case_insensitive)
           {
               $campo  = sc_strtoupper($campo);
           }
           while (!$rx->EOF) 
           { 
               $chave = $rx->fields[1];
               $label = $rx->fields[0];
               if ($this->NM_case_insensitive)
               {
                   $label  = sc_strtoupper($label);
               }
               if ($condicao == "eq" && $campo == $label)
               {
                   $result[] = $chave;
               }
               if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
               {
                   $result[] = $chave;
               }
               if ($condicao == "qp" && strstr($label, $campo))
               {
                   $result[] = $chave;
               }
               if ($condicao == "np" && !strstr($label, $campo))
               {
                   $result[] = $chave;
               }
               if ($condicao == "df" && $campo != $label)
               {
                   $result[] = $chave;
               }
               if ($condicao == "gt" && $label > $campo )
               {
                   $result[] = $chave;
               }
               if ($condicao == "ge" && $label >= $campo)
               {
                   $result[] = $chave;
               }
               if ($condicao == "lt" && $label < $campo)
               {
                   $result[] = $chave;
               }
               if ($condicao == "le" && $label <= $campo)
               {
                   $result[] = $chave;
               }
               $rx->MoveNext() ;
           }  
           return $result;
       }  
       elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
       { 
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
           exit; 
       } 
   }
   function SC_lookup_hotel_classificacao($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $nm_comando = "SELECT hotel_tipo, hotel_class_id FROM tbl_hoteis_class WHERE (#lowerI##cmp_ihotel_tipo#cmp_f)#cmp_apos LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')#arg_apos)" ; 
       if ($condicao == "ii")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "LIKE #lowerI#'#arg_i" . $campo . "#arg_f%')", $nm_comando);
       }
       if ($condicao == "np")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "NOT LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", $nm_comando);
       }
       if ($condicao == "df")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "<> #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if ($condicao == "gt")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "> #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if ($condicao == "ge")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", ">= #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if ($condicao == "lt")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "< #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if ($condicao == "le")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "<= #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
       {
           $nm_comando = str_replace("#lowerI#", "UCase(", $nm_comando);
       }
       else
       {
           $nm_comando = str_replace("#lowerI#", "Upper(", $nm_comando);
       }
       $nm_comando = str_replace(array('#cmp_i','#cmp_f','#cmp_apos','#arg_i','#arg_f','#arg_apos'), array('','','','','',''), $nm_comando); 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
       $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
       if ($rx = $this->Db->Execute($nm_comando)) 
       { 
           $campo = $campo_orig;
           if ($this->NM_case_insensitive)
           {
               $campo  = sc_strtoupper($campo);
           }
           while (!$rx->EOF) 
           { 
               $chave = $rx->fields[1];
               $label = $rx->fields[0];
               if ($this->NM_case_insensitive)
               {
                   $label  = sc_strtoupper($label);
               }
               if ($condicao == "eq" && $campo == $label)
               {
                   $result[] = $chave;
               }
               if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
               {
                   $result[] = $chave;
               }
               if ($condicao == "qp" && strstr($label, $campo))
               {
                   $result[] = $chave;
               }
               if ($condicao == "np" && !strstr($label, $campo))
               {
                   $result[] = $chave;
               }
               if ($condicao == "df" && $campo != $label)
               {
                   $result[] = $chave;
               }
               if ($condicao == "gt" && $label > $campo )
               {
                   $result[] = $chave;
               }
               if ($condicao == "ge" && $label >= $campo)
               {
                   $result[] = $chave;
               }
               if ($condicao == "lt" && $label < $campo)
               {
                   $result[] = $chave;
               }
               if ($condicao == "le" && $label <= $campo)
               {
                   $result[] = $chave;
               }
               $rx->MoveNext() ;
           }  
           return $result;
       }  
       elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
       { 
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
           exit; 
       } 
   }
   function SC_lookup_hotel_categoria($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $nm_comando = "SELECT classificacao, categ_hotel_id FROM tbl_categ_hoteis WHERE (#lowerI##cmp_iclassificacao#cmp_f)#cmp_apos LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')#arg_apos)" ; 
       if ($condicao == "ii")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "LIKE #lowerI#'#arg_i" . $campo . "#arg_f%')", $nm_comando);
       }
       if ($condicao == "np")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "NOT LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", $nm_comando);
       }
       if ($condicao == "df")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "<> #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if ($condicao == "gt")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "> #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if ($condicao == "ge")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", ">= #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if ($condicao == "lt")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "< #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if ($condicao == "le")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "<= #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
       {
           $nm_comando = str_replace("#lowerI#", "UCase(", $nm_comando);
       }
       else
       {
           $nm_comando = str_replace("#lowerI#", "Upper(", $nm_comando);
       }
       $nm_comando = str_replace(array('#cmp_i','#cmp_f','#cmp_apos','#arg_i','#arg_f','#arg_apos'), array('','','','','',''), $nm_comando); 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
       $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
       if ($rx = $this->Db->Execute($nm_comando)) 
       { 
           $campo = $campo_orig;
           if ($this->NM_case_insensitive)
           {
               $campo  = sc_strtoupper($campo);
           }
           while (!$rx->EOF) 
           { 
               $chave = $rx->fields[1];
               $label = $rx->fields[0];
               if ($this->NM_case_insensitive)
               {
                   $label  = sc_strtoupper($label);
               }
               if ($condicao == "eq" && $campo == $label)
               {
                   $result[] = $chave;
               }
               if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
               {
                   $result[] = $chave;
               }
               if ($condicao == "qp" && strstr($label, $campo))
               {
                   $result[] = $chave;
               }
               if ($condicao == "np" && !strstr($label, $campo))
               {
                   $result[] = $chave;
               }
               if ($condicao == "df" && $campo != $label)
               {
                   $result[] = $chave;
               }
               if ($condicao == "gt" && $label > $campo )
               {
                   $result[] = $chave;
               }
               if ($condicao == "ge" && $label >= $campo)
               {
                   $result[] = $chave;
               }
               if ($condicao == "lt" && $label < $campo)
               {
                   $result[] = $chave;
               }
               if ($condicao == "le" && $label <= $campo)
               {
                   $result[] = $chave;
               }
               $rx->MoveNext() ;
           }  
           return $result;
       }  
       elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
       { 
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
           exit; 
       } 
   }
   function SC_lookup_hotel_pais($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $nm_comando = "SELECT descricao, pais_id FROM tbl_paises WHERE (#lowerI##cmp_idescricao#cmp_f)#cmp_apos LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')#arg_apos)" ; 
       if ($condicao == "ii")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "LIKE #lowerI#'#arg_i" . $campo . "#arg_f%')", $nm_comando);
       }
       if ($condicao == "np")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "NOT LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", $nm_comando);
       }
       if ($condicao == "df")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "<> #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if ($condicao == "gt")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "> #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if ($condicao == "ge")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", ">= #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if ($condicao == "lt")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "< #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if ($condicao == "le")
       {
           $nm_comando = str_replace("LIKE #lowerI#'%#arg_i" . $campo . "#arg_f%')", "<= #lowerI#'#arg_i" . $campo . "#arg_f')", $nm_comando);
       }
       if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
       {
           $nm_comando = str_replace("#lowerI#", "UCase(", $nm_comando);
       }
       else
       {
           $nm_comando = str_replace("#lowerI#", "Upper(", $nm_comando);
       }
       $nm_comando = str_replace(array('#cmp_i','#cmp_f','#cmp_apos','#arg_i','#arg_f','#arg_apos'), array('','','','','',''), $nm_comando); 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
       $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
       if ($rx = $this->Db->Execute($nm_comando)) 
       { 
           $campo = $campo_orig;
           if ($this->NM_case_insensitive)
           {
               $campo  = sc_strtoupper($campo);
           }
           while (!$rx->EOF) 
           { 
               $chave = $rx->fields[1];
               $label = $rx->fields[0];
               if ($this->NM_case_insensitive)
               {
                   $label  = sc_strtoupper($label);
               }
               if ($condicao == "eq" && $campo == $label)
               {
                   $result[] = $chave;
               }
               if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
               {
                   $result[] = $chave;
               }
               if ($condicao == "qp" && strstr($label, $campo))
               {
                   $result[] = $chave;
               }
               if ($condicao == "np" && !strstr($label, $campo))
               {
                   $result[] = $chave;
               }
               if ($condicao == "df" && $campo != $label)
               {
                   $result[] = $chave;
               }
               if ($condicao == "gt" && $label > $campo )
               {
                   $result[] = $chave;
               }
               if ($condicao == "ge" && $label >= $campo)
               {
                   $result[] = $chave;
               }
               if ($condicao == "lt" && $label < $campo)
               {
                   $result[] = $chave;
               }
               if ($condicao == "le" && $label <= $campo)
               {
                   $result[] = $chave;
               }
               $rx->MoveNext() ;
           }  
           return $result;
       }  
       elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
       { 
           $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
           exit; 
       } 
   }
   function SC_lookup_hotel_status($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['Y'] = "Ativo";
       $data_look['N'] = "Inativo";
       $result = array();
       if ($this->NM_case_insensitive)
       {
           $campo  = sc_strtoupper($campo);
       }
       foreach ($data_look as $chave => $label) 
       {
           if ($this->NM_case_insensitive)
           {
               $label  = sc_strtoupper($label);
           }
           if ($condicao == "eq" && $campo == $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
           {
               $result[] = $chave;
           }
           if ($condicao == "qp" && strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "np" && !strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "df" && $campo != $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "gt" && $label > $campo )
           {
               $result[] = $chave;
           }
           if ($condicao == "ge" && $label >= $campo)
            {
               $result[] = $chave;
           }
           if ($condicao == "lt" && $label < $campo)
           {
               $result[] = $chave;
           }
           if ($condicao == "le" && $label <= $campo)
           {
               $result[] = $chave;
           }
          
       }
       return $result;
   }
   function SC_lookup_hotel_ar_condicionado($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['Y'] = "Sim";
       $data_look['N'] = "Não";
       $result = array();
       if ($this->NM_case_insensitive)
       {
           $campo  = sc_strtoupper($campo);
       }
       foreach ($data_look as $chave => $label) 
       {
           if ($this->NM_case_insensitive)
           {
               $label  = sc_strtoupper($label);
           }
           if ($condicao == "eq" && $campo == $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
           {
               $result[] = $chave;
           }
           if ($condicao == "qp" && strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "np" && !strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "df" && $campo != $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "gt" && $label > $campo )
           {
               $result[] = $chave;
           }
           if ($condicao == "ge" && $label >= $campo)
            {
               $result[] = $chave;
           }
           if ($condicao == "lt" && $label < $campo)
           {
               $result[] = $chave;
           }
           if ($condicao == "le" && $label <= $campo)
           {
               $result[] = $chave;
           }
          
       }
       return $result;
   }
   function SC_lookup_hotel_frigobar($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['Y'] = "Sim";
       $data_look['N'] = "Não";
       $result = array();
       if ($this->NM_case_insensitive)
       {
           $campo  = sc_strtoupper($campo);
       }
       foreach ($data_look as $chave => $label) 
       {
           if ($this->NM_case_insensitive)
           {
               $label  = sc_strtoupper($label);
           }
           if ($condicao == "eq" && $campo == $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
           {
               $result[] = $chave;
           }
           if ($condicao == "qp" && strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "np" && !strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "df" && $campo != $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "gt" && $label > $campo )
           {
               $result[] = $chave;
           }
           if ($condicao == "ge" && $label >= $campo)
            {
               $result[] = $chave;
           }
           if ($condicao == "lt" && $label < $campo)
           {
               $result[] = $chave;
           }
           if ($condicao == "le" && $label <= $campo)
           {
               $result[] = $chave;
           }
          
       }
       return $result;
   }
   function SC_lookup_hotel_lavanderia($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['Y'] = "Sim";
       $data_look['N'] = "Não";
       $result = array();
       if ($this->NM_case_insensitive)
       {
           $campo  = sc_strtoupper($campo);
       }
       foreach ($data_look as $chave => $label) 
       {
           if ($this->NM_case_insensitive)
           {
               $label  = sc_strtoupper($label);
           }
           if ($condicao == "eq" && $campo == $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
           {
               $result[] = $chave;
           }
           if ($condicao == "qp" && strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "np" && !strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "df" && $campo != $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "gt" && $label > $campo )
           {
               $result[] = $chave;
           }
           if ($condicao == "ge" && $label >= $campo)
            {
               $result[] = $chave;
           }
           if ($condicao == "lt" && $label < $campo)
           {
               $result[] = $chave;
           }
           if ($condicao == "le" && $label <= $campo)
           {
               $result[] = $chave;
           }
          
       }
       return $result;
   }
   function SC_lookup_hotel_telefone_quarto($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['Y'] = "Sim";
       $data_look['N'] = "Não";
       $result = array();
       if ($this->NM_case_insensitive)
       {
           $campo  = sc_strtoupper($campo);
       }
       foreach ($data_look as $chave => $label) 
       {
           if ($this->NM_case_insensitive)
           {
               $label  = sc_strtoupper($label);
           }
           if ($condicao == "eq" && $campo == $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
           {
               $result[] = $chave;
           }
           if ($condicao == "qp" && strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "np" && !strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "df" && $campo != $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "gt" && $label > $campo )
           {
               $result[] = $chave;
           }
           if ($condicao == "ge" && $label >= $campo)
            {
               $result[] = $chave;
           }
           if ($condicao == "lt" && $label < $campo)
           {
               $result[] = $chave;
           }
           if ($condicao == "le" && $label <= $campo)
           {
               $result[] = $chave;
           }
          
       }
       return $result;
   }
   function SC_lookup_hotel_tv($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['Y'] = "Sim";
       $data_look['N'] = "Não";
       $result = array();
       if ($this->NM_case_insensitive)
       {
           $campo  = sc_strtoupper($campo);
       }
       foreach ($data_look as $chave => $label) 
       {
           if ($this->NM_case_insensitive)
           {
               $label  = sc_strtoupper($label);
           }
           if ($condicao == "eq" && $campo == $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
           {
               $result[] = $chave;
           }
           if ($condicao == "qp" && strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "np" && !strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "df" && $campo != $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "gt" && $label > $campo )
           {
               $result[] = $chave;
           }
           if ($condicao == "ge" && $label >= $campo)
            {
               $result[] = $chave;
           }
           if ($condicao == "lt" && $label < $campo)
           {
               $result[] = $chave;
           }
           if ($condicao == "le" && $label <= $campo)
           {
               $result[] = $chave;
           }
          
       }
       return $result;
   }
   function SC_lookup_hotel_ginastica($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['Y'] = "Sim";
       $data_look['N'] = "Não";
       $result = array();
       if ($this->NM_case_insensitive)
       {
           $campo  = sc_strtoupper($campo);
       }
       foreach ($data_look as $chave => $label) 
       {
           if ($this->NM_case_insensitive)
           {
               $label  = sc_strtoupper($label);
           }
           if ($condicao == "eq" && $campo == $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
           {
               $result[] = $chave;
           }
           if ($condicao == "qp" && strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "np" && !strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "df" && $campo != $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "gt" && $label > $campo )
           {
               $result[] = $chave;
           }
           if ($condicao == "ge" && $label >= $campo)
            {
               $result[] = $chave;
           }
           if ($condicao == "lt" && $label < $campo)
           {
               $result[] = $chave;
           }
           if ($condicao == "le" && $label <= $campo)
           {
               $result[] = $chave;
           }
          
       }
       return $result;
   }
   function SC_lookup_hotel_restaurante($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['Y'] = "Sim";
       $data_look['N'] = "Não";
       $result = array();
       if ($this->NM_case_insensitive)
       {
           $campo  = sc_strtoupper($campo);
       }
       foreach ($data_look as $chave => $label) 
       {
           if ($this->NM_case_insensitive)
           {
               $label  = sc_strtoupper($label);
           }
           if ($condicao == "eq" && $campo == $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
           {
               $result[] = $chave;
           }
           if ($condicao == "qp" && strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "np" && !strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "df" && $campo != $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "gt" && $label > $campo )
           {
               $result[] = $chave;
           }
           if ($condicao == "ge" && $label >= $campo)
            {
               $result[] = $chave;
           }
           if ($condicao == "lt" && $label < $campo)
           {
               $result[] = $chave;
           }
           if ($condicao == "le" && $label <= $campo)
           {
               $result[] = $chave;
           }
          
       }
       return $result;
   }
   function SC_lookup_hotel_bar($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['Y'] = "Sim";
       $data_look['N'] = "Não";
       $result = array();
       if ($this->NM_case_insensitive)
       {
           $campo  = sc_strtoupper($campo);
       }
       foreach ($data_look as $chave => $label) 
       {
           if ($this->NM_case_insensitive)
           {
               $label  = sc_strtoupper($label);
           }
           if ($condicao == "eq" && $campo == $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
           {
               $result[] = $chave;
           }
           if ($condicao == "qp" && strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "np" && !strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "df" && $campo != $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "gt" && $label > $campo )
           {
               $result[] = $chave;
           }
           if ($condicao == "ge" && $label >= $campo)
            {
               $result[] = $chave;
           }
           if ($condicao == "lt" && $label < $campo)
           {
               $result[] = $chave;
           }
           if ($condicao == "le" && $label <= $campo)
           {
               $result[] = $chave;
           }
          
       }
       return $result;
   }
   function SC_lookup_hotel_estacionamento($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['Y'] = "Sim";
       $data_look['N'] = "Não";
       $result = array();
       if ($this->NM_case_insensitive)
       {
           $campo  = sc_strtoupper($campo);
       }
       foreach ($data_look as $chave => $label) 
       {
           if ($this->NM_case_insensitive)
           {
               $label  = sc_strtoupper($label);
           }
           if ($condicao == "eq" && $campo == $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
           {
               $result[] = $chave;
           }
           if ($condicao == "qp" && strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "np" && !strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "df" && $campo != $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "gt" && $label > $campo )
           {
               $result[] = $chave;
           }
           if ($condicao == "ge" && $label >= $campo)
            {
               $result[] = $chave;
           }
           if ($condicao == "lt" && $label < $campo)
           {
               $result[] = $chave;
           }
           if ($condicao == "le" && $label <= $campo)
           {
               $result[] = $chave;
           }
          
       }
       return $result;
   }
   function SC_lookup_hotel_sauna($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['Y'] = "Sim";
       $data_look['N'] = "Não";
       $result = array();
       if ($this->NM_case_insensitive)
       {
           $campo  = sc_strtoupper($campo);
       }
       foreach ($data_look as $chave => $label) 
       {
           if ($this->NM_case_insensitive)
           {
               $label  = sc_strtoupper($label);
           }
           if ($condicao == "eq" && $campo == $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
           {
               $result[] = $chave;
           }
           if ($condicao == "qp" && strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "np" && !strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "df" && $campo != $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "gt" && $label > $campo )
           {
               $result[] = $chave;
           }
           if ($condicao == "ge" && $label >= $campo)
            {
               $result[] = $chave;
           }
           if ($condicao == "lt" && $label < $campo)
           {
               $result[] = $chave;
           }
           if ($condicao == "le" && $label <= $campo)
           {
               $result[] = $chave;
           }
          
       }
       return $result;
   }
   function SC_lookup_hotel_piscina($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['Y'] = "Sim";
       $data_look['N'] = "Não";
       $result = array();
       if ($this->NM_case_insensitive)
       {
           $campo  = sc_strtoupper($campo);
       }
       foreach ($data_look as $chave => $label) 
       {
           if ($this->NM_case_insensitive)
           {
               $label  = sc_strtoupper($label);
           }
           if ($condicao == "eq" && $campo == $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
           {
               $result[] = $chave;
           }
           if ($condicao == "qp" && strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "np" && !strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "df" && $campo != $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "gt" && $label > $campo )
           {
               $result[] = $chave;
           }
           if ($condicao == "ge" && $label >= $campo)
            {
               $result[] = $chave;
           }
           if ($condicao == "lt" && $label < $campo)
           {
               $result[] = $chave;
           }
           if ($condicao == "le" && $label <= $campo)
           {
               $result[] = $chave;
           }
          
       }
       return $result;
   }
   function SC_lookup_hotel_wifi($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['Y'] = "Sim";
       $data_look['N'] = "Não";
       $result = array();
       if ($this->NM_case_insensitive)
       {
           $campo  = sc_strtoupper($campo);
       }
       foreach ($data_look as $chave => $label) 
       {
           if ($this->NM_case_insensitive)
           {
               $label  = sc_strtoupper($label);
           }
           if ($condicao == "eq" && $campo == $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
           {
               $result[] = $chave;
           }
           if ($condicao == "qp" && strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "np" && !strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "df" && $campo != $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "gt" && $label > $campo )
           {
               $result[] = $chave;
           }
           if ($condicao == "ge" && $label >= $campo)
            {
               $result[] = $chave;
           }
           if ($condicao == "lt" && $label < $campo)
           {
               $result[] = $chave;
           }
           if ($condicao == "le" && $label <= $campo)
           {
               $result[] = $chave;
           }
          
       }
       return $result;
   }
   function SC_lookup_hotel_computador($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['Y'] = "Sim";
       $data_look['N'] = "Não";
       $result = array();
       if ($this->NM_case_insensitive)
       {
           $campo  = sc_strtoupper($campo);
       }
       foreach ($data_look as $chave => $label) 
       {
           if ($this->NM_case_insensitive)
           {
               $label  = sc_strtoupper($label);
           }
           if ($condicao == "eq" && $campo == $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
           {
               $result[] = $chave;
           }
           if ($condicao == "qp" && strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "np" && !strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "df" && $campo != $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "gt" && $label > $campo )
           {
               $result[] = $chave;
           }
           if ($condicao == "ge" && $label >= $campo)
            {
               $result[] = $chave;
           }
           if ($condicao == "lt" && $label < $campo)
           {
               $result[] = $chave;
           }
           if ($condicao == "le" && $label <= $campo)
           {
               $result[] = $chave;
           }
          
       }
       return $result;
   }
   function SC_lookup_hotel_convencoes($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['Y'] = "Sim";
       $data_look['N'] = "Não";
       $result = array();
       if ($this->NM_case_insensitive)
       {
           $campo  = sc_strtoupper($campo);
       }
       foreach ($data_look as $chave => $label) 
       {
           if ($this->NM_case_insensitive)
           {
               $label  = sc_strtoupper($label);
           }
           if ($condicao == "eq" && $campo == $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "ii" && $campo == substr($label, 0, strlen($campo)))
           {
               $result[] = $chave;
           }
           if ($condicao == "qp" && strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "np" && !strstr($label, $campo))
           {
               $result[] = $chave;
           }
           if ($condicao == "df" && $campo != $label)
           {
               $result[] = $chave;
           }
           if ($condicao == "gt" && $label > $campo )
           {
               $result[] = $chave;
           }
           if ($condicao == "ge" && $label >= $campo)
            {
               $result[] = $chave;
           }
           if ($condicao == "lt" && $label < $campo)
           {
               $result[] = $chave;
           }
           if ($condicao == "le" && $label <= $campo)
           {
               $result[] = $chave;
           }
          
       }
       return $result;
   }
function nmgp_redireciona($tipo=0)
{
   global $nm_apl_dependente;
   if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $_SESSION['scriptcase']['sc_tp_saida'] != "D" && $nm_apl_dependente != 1) 
   {
       $nmgp_saida_form = $_SESSION['scriptcase']['nm_sc_retorno'];
   }
   else
   {
       $nmgp_saida_form = $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page];
   }
   if ($tipo == 2)
   {
       $nmgp_saida_form = "form_tbl_hoteis_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['nm_run_menu'] = 2;
       $nmgp_saida_form = "form_tbl_hoteis_fim.php";
   }
   $diretorio = explode("/", $nmgp_saida_form);
   $cont = count($diretorio);
   $apl = $diretorio[$cont - 1];
   $apl = str_replace(".php", "", $apl);
   $pos = strpos($apl, "?");
   if ($pos !== false)
   {
       $apl = substr($apl, 0, $pos);
   }
   if ($tipo != 1 && $tipo != 2)
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page][$apl]['where_orig']);
   }
   if ($this->NM_ajax_flag)
   {
       $sTarget = '_self';
       $this->NM_ajax_info['redir']['metodo']              = 'post';
       $this->NM_ajax_info['redir']['action']              = $nmgp_saida_form;
       $this->NM_ajax_info['redir']['target']              = $sTarget;
       $this->NM_ajax_info['redir']['script_case_init']    = $this->Ini->sc_page;
       if (0 == $tipo)
       {
           $this->NM_ajax_info['redir']['nmgp_url_saida'] = $this->nm_location;
       }
       form_tbl_hoteis_pack_ajax_response();
       exit;
   }
?>
<!DOCTYPE html>

   <HTML>
   <HEAD>
    <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

   if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
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
   <BODY>
   <FORM name="form_ok" method="POST" action="<?php echo $this->form_encode_input($nmgp_saida_form); ?>" target="_self">
<?php
   if ($tipo == 0)
   {
?>
     <INPUT type="hidden" name="nmgp_url_saida" value="<?php echo $this->form_encode_input($this->nm_location); ?>"> 
<?php
   }
?>
     <INPUT type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
   </FORM>
   <SCRIPT type="text/javascript">
      bLigEditLookupCall = <?php if ($this->lig_edit_lookup_call) { ?>true<?php } else { ?>false<?php } ?>;
      function scLigEditLookupCall()
      {
<?php
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sc_modal'])
   {
?>
        parent.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
   }
   elseif ($this->lig_edit_lookup)
   {
?>
        opener.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
   }
?>
      }
      if (bLigEditLookupCall)
      {
        scLigEditLookupCall();
      }
<?php
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['masterValue']);
?>
}
<?php
    }
}
?>
      document.form_ok.submit();
   </SCRIPT>
   </BODY>
   </HTML>
<?php
  exit;
}
    function sc_ajax_message($sMessage, $sTitle = '', $sParam = '', $sRedirPar = '')
    {
        if ($this->NM_ajax_flag)
        {
            $this->NM_ajax_info['ajaxMessage'] = array();
            if ('' != $sParam)
            {
                $aParamList = explode('&', $sParam);
                foreach ($aParamList as $sParamItem)
                {
                    $aParamData = explode('=', $sParamItem);
                    if (2 == sizeof($aParamData) &&
                        in_array($aParamData[0], array('modal', 'timeout', 'button', 'button_label', 'top', 'left', 'width', 'height', 'redir', 'redir_target', 'show_close', 'body_icon', 'toast', 'toast_pos', 'type')))
                    {
                        $this->NM_ajax_info['ajaxMessage'][$aParamData[0]] = NM_charset_to_utf8($aParamData[1]);
                    }
                }
            }
            if (isset($this->NM_ajax_info['ajaxMessage']['redir']) && '' != $this->NM_ajax_info['ajaxMessage']['redir'] && '.php' == substr($this->NM_ajax_info['ajaxMessage']['redir'], -4) && 'http' != substr($this->NM_ajax_info['ajaxMessage']['redir'], 0, 4))
            {
                $this->NM_ajax_info['ajaxMessage']['redir'] = $this->Ini->path_link . SC_dir_app_name(substr($this->NM_ajax_info['ajaxMessage']['redir'], 0, -4)) . '/' . $this->NM_ajax_info['ajaxMessage']['redir'];
            }
            if ('' != $sRedirPar)
            {
                $this->NM_ajax_info['ajaxMessage']['redir_par'] = str_replace('=', '?#?', str_replace(';', '?@?', $sRedirPar));
            }
            else
            {
                $this->NM_ajax_info['ajaxMessage']['redir_par'] = '';
            }
            $this->NM_ajax_info['ajaxMessage']['message'] = NM_charset_to_utf8($sMessage);
            $this->NM_ajax_info['ajaxMessage']['title']   = NM_charset_to_utf8($sTitle);
            if (!isset($this->NM_ajax_info['ajaxMessage']['button']))
            {
                $this->NM_ajax_info['ajaxMessage']['button'] = 'Y';
            }
        }
    } // sc_ajax_message
    function getButtonIds($buttonName) {
        switch ($buttonName) {
            case "new":
                return array("sc_b_new_t.sc-unique-btn-1");
                break;
            case "insert":
                return array("sc_b_ins_t.sc-unique-btn-2");
                break;
            case "bcancelar":
                return array("sc_b_sai_t.sc-unique-btn-3");
                break;
            case "update":
                return array("sc_b_upd_t.sc-unique-btn-4");
                break;
            case "delete":
                return array("sc_b_del_t.sc-unique-btn-5");
                break;
            case "help":
                return array("sc_b_hlp_t");
                break;
            case "exit":
                return array("sc_b_sai_t.sc-unique-btn-6", "sc_b_sai_t.sc-unique-btn-7", "sc_b_sai_t.sc-unique-btn-9", "sc_b_sai_t.sc-unique-btn-8", "sc_b_sai_t.sc-unique-btn-10");
                break;
            case "birpara":
                return array("brec_b");
                break;
            case "first":
                return array("sc_b_ini_b.sc-unique-btn-11");
                break;
            case "back":
                return array("sc_b_ret_b.sc-unique-btn-12");
                break;
            case "forward":
                return array("sc_b_avc_b.sc-unique-btn-13");
                break;
            case "last":
                return array("sc_b_fim_b.sc-unique-btn-14");
                break;
        }

        return array($buttonName);
    } // getButtonIds

    function displayAppHeader()
    {
        if ($this->Embutida_call) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['link_info']['compact_mode']) {
            return;
        }
?>
    <tr id="sc_form_head"><td class="sc-app-header">
<?php if (!empty($_SESSION['scriptcase']['proc_mobile'])) { ?>
<style>
    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}
</style>
<div class="scFormHeader" style="height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;">
    <div class="scFormHeaderFont" style="float: left; text-transform: uppercase;"><?php if ($this->nmgp_opcao == "novo") { echo "BRSVP - Cadastro de Hotéis Inclusão"; } else { echo "BRSVP - Cadastro de Hotéis Edição"; } ?></div>
    <div class="scFormHeaderFont" style="float: right;"><?php echo date($this->dateDefaultFormat()); ?></div>
</div>
<?php } else { ?>
<style>
    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}
</style>
<div class="scFormHeader" style="height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;">
    <div class="scFormHeaderFont" style="float: left; text-transform: uppercase;"><?php if ($this->nmgp_opcao == "novo") { echo "BRSVP - Cadastro de Hotéis Inclusão"; } else { echo "BRSVP - Cadastro de Hotéis Edição"; } ?></div>
    <div class="scFormHeaderFont" style="float: right;"><?php echo date($this->dateDefaultFormat()); ?></div>
</div>
<?php } ?>

    </td></tr>
<?php
    }

    function displayAppFooter()
    {
        if ($this->Embutida_call) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['link_info']['compact_mode']) {
            return;
        }
?>
    <tr><td class="sc-app-footer">
<style>
#rod_col1 { margin:0px; padding: 3px 0 0 5px; float:left; overflow:hidden;}
#rod_col2 { margin:0px; padding: 3px 5px 0 0; float:right; overflow:hidden; text-align:right;}

</style>

<table style="width: 100%; height:20px;" cellpadding="0px" cellspacing="0px" class="scFormFooter">
    <tr>
        <td>
            <span class="scFormFooterFont" id="rod_col1"><span id="head_mark_rodape_0"><?php echo $this->rodape ?></span></span>
        </td>
        <td>
            <span class="scFormFooterFont" id="rod_col2"></span>
        </td>
    </tr>
</table>
    </td></tr>
<?php
    }

    function displayAppToolbars()
    {
        if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "R") {
        } else {
            return false;
        }
        return true;
    } // displayAppToolbars

    function displayTopToolbar()
    {
        if (!$this->displayAppToolbars()) {
            return;
        }
    } // displayTopToolbar

    function displayBottomToolbar()
    {
        if (!$this->displayAppToolbars()) {
            return;
        }
    } // displayBottomToolbar

    function getSummaryLine()
    {
        $summaryLine = "[" . $this->Ini->Nm_lang['lang_othr_smry_info_simp'] . "]";
        $summaryLine = str_replace(
            [
                '?final?',
                '?total?',
            ],
            [
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['ordem_ord'] == " desc") {
                $orderColOrient = $nome_img = $this->Ini->Label_sort_desc;
                $orderColRule = $sortRule = 'desc';
            } else {
                $orderColOrient = $nome_img = $this->Ini->Label_sort_asc;
                $orderColRule = $sortRule = 'asc';
            }
        }
        return $sortRule;
    }

    function scGetColumnOrderIcon($fieldName, $sortRule)
    {        if ('desc' == $sortRule) {
            return "<img src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Label_sort_desc . "\" class=\"sc-ui-img-order-column\" id=\"sc-id-img-order-" . $fieldName . "\" />";
        } elseif ('asc' == $sortRule) {
            return "<img src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Label_sort_asc . "\" class=\"sc-ui-img-order-column\" id=\"sc-id-img-order-" . $fieldName . "\" />";
        } elseif ('' != $this->Ini->Label_sort) {
            return "<img src=\"" . $this->Ini->path_img_global . "/" . $this->Ini->Label_sort . "\" class=\"sc-ui-img-order-column\" id=\"sc-id-img-order-" . $fieldName . "\" />";
        } else {
            return '';
        }
    }

    function scIsFieldNumeric($fieldName)
    {
        switch ($fieldName) {
            case "hotel_id":
                return true;
            default:
                return false;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
            case "hotel_id":
                return 'desc';
            case "hotel_pais":
                return 'desc';
            case "hotel_uf":
                return 'desc';
            case "hotel_municipio":
                return 'desc';
            default:
                return 'asc';
        }
        return 'asc';
    }

    function scGetImageExtension(string $binary) {
        if (function_exists('finfo_buffer')) {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->buffer($binary);
            $map = [
               'image/jpeg' => '.jpg',
               'image/png'  => '.png',
               'image/gif'  => '.gif',
               'image/webp' => '.webp',
               'image/bmp'  => '.bmp',
               'image/svg+xml' => '.svg',
               'image/x-icon' => '.ico',
            ];
            if (isset($map[$mime])) {
                return $map[$mime];
            }
        }
        $header = bin2hex(substr($binary, 0, 12));
        if (strpos($header, 'ffd8ff') === 0) return '.jpg';
        if (strpos($header, '89504e47') === 0) return '.png';
        if (strpos($header, '47494638') === 0) return '.gif';
        if (substr($binary, 0, 4) === "RIFF" && substr($binary, 8, 4) === "WEBP") return '.webp';
        if (strpos($header, '424d') === 0) return '.bmp';
        if (strpos($header, '00000100') === 0) return '.ico';
        return '.gif';
    }
}
?>
