<?php
//
class form_hospedagem_rsvp_ar1_apl
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
   var $hospedagem_id_;
   var $hosp_id_evento_;
   var $hosp_id_participante_;
   var $hosp_id_usuario_;
   var $hosp_cpf_participante_;
   var $hosp_id_hotel_;
   var $hosp_acomodacao_;
   var $hosp_categoria_;
   var $hosp_pagamentos_;
   var $hosp_status_;
   var $hosp_status__1;
   var $hosp_tipo_pessoa_;
   var $hosp_acompanhante_;
   var $hosp_qtd_acompanhante_;
   var $hosp_dt_checkin_;
   var $hosp_dt_checkout_;
   var $hosp_hr_checkin_;
   var $hosp_hr_checkout_;
   var $hosp_early_chkin_;
   var $hosp_late_chkout_;
   var $hosp_diarias_;
   var $hosp_taxas_;
   var $hosp_total_;
   var $hosp_observacoes_;
   var $hosp_dsc_pacote_;
   var $hosp_alteracao_;
   var $hosp_alteracao__hora;
   var $hosp_ativo_;
   var $hosp_part_acomp_;
   var $hosp_reserva_bvt_;
   var $conta_roomlist_;
   var $conta_roomlist__1;
   var $acmq_01_;
   var $acmq_02_;
   var $acmq_03_;
   var $acmq_04_;
   var $pamq_01_;
   var $pamq_02_;
   var $pamq_03_;
   var $pamq_04_;
   var $id_bloqueio_hotel_;
   var $nome_evento_;
   var $nome_participante_;
   var $nome_hotel_;
   var $nome_acomodacao_;
   var $nome_categoria_;
   var $nm_data;
   var $nmgp_opcao;
   var $nmgp_opc_ant;
   var $sc_evento;
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
   var $sc_teve_incl = false;
   var $sc_teve_excl = false;
   var $sc_teve_alt  = false;
   var $sc_after_all_insert = false;
   var $sc_after_all_update = false;
   var $sc_after_all_delete = false;
   var $sc_max_reg = 10; 
   var $sc_max_reg_incl = 10; 
   var $form_vert_form_hospedagem_rsvp_ar1 = array();
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
   var $Mens_return_ok = "";
   var $NM_case_insensitive;
//
//----- 
   function ini_controle()
   {
        global $nm_url_saida, $teste_validade, $script_case_init, 
               $GLOBALS, $Campos_Crit, $Campos_Falta, $Campos_Erros, $sc_seq_vert, $sc_check_incl, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;


      if ($this->NM_ajax_flag)
      {
          if (isset($this->NM_ajax_info['param']['conta_roomlist_']))
          {
              $this->conta_roomlist_ = $this->NM_ajax_info['param']['conta_roomlist_'];
          }
          if (isset($this->NM_ajax_info['param']['csrf_token']))
          {
              $this->csrf_token = $this->NM_ajax_info['param']['csrf_token'];
          }
          if (isset($this->NM_ajax_info['param']['hosp_acomodacao_']))
          {
              $this->hosp_acomodacao_ = $this->NM_ajax_info['param']['hosp_acomodacao_'];
          }
          if (isset($this->NM_ajax_info['param']['hosp_categoria_']))
          {
              $this->hosp_categoria_ = $this->NM_ajax_info['param']['hosp_categoria_'];
          }
          if (isset($this->NM_ajax_info['param']['hosp_cpf_participante_']))
          {
              $this->hosp_cpf_participante_ = $this->NM_ajax_info['param']['hosp_cpf_participante_'];
          }
          if (isset($this->NM_ajax_info['param']['hosp_id_evento_']))
          {
              $this->hosp_id_evento_ = $this->NM_ajax_info['param']['hosp_id_evento_'];
          }
          if (isset($this->NM_ajax_info['param']['hosp_id_hotel_']))
          {
              $this->hosp_id_hotel_ = $this->NM_ajax_info['param']['hosp_id_hotel_'];
          }
          if (isset($this->NM_ajax_info['param']['hosp_status_']))
          {
              $this->hosp_status_ = $this->NM_ajax_info['param']['hosp_status_'];
          }
          if (isset($this->NM_ajax_info['param']['hospedagem_id_']))
          {
              $this->hospedagem_id_ = $this->NM_ajax_info['param']['hospedagem_id_'];
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
          if (isset($this->NM_ajax_info['param']['nmgp_refresh_row']))
          {
              $this->nmgp_refresh_row = $this->NM_ajax_info['param']['nmgp_refresh_row'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_url_saida']))
          {
              $this->nmgp_url_saida = $this->NM_ajax_info['param']['nmgp_url_saida'];
          }
          if (isset($this->NM_ajax_info['param']['nome_acomodacao_']))
          {
              $this->nome_acomodacao_ = $this->NM_ajax_info['param']['nome_acomodacao_'];
          }
          if (isset($this->NM_ajax_info['param']['nome_categoria_']))
          {
              $this->nome_categoria_ = $this->NM_ajax_info['param']['nome_categoria_'];
          }
          if (isset($this->NM_ajax_info['param']['nome_evento_']))
          {
              $this->nome_evento_ = $this->NM_ajax_info['param']['nome_evento_'];
          }
          if (isset($this->NM_ajax_info['param']['nome_hotel_']))
          {
              $this->nome_hotel_ = $this->NM_ajax_info['param']['nome_hotel_'];
          }
          if (isset($this->NM_ajax_info['param']['nome_participante_']))
          {
              $this->nome_participante_ = $this->NM_ajax_info['param']['nome_participante_'];
          }
          if (isset($this->NM_ajax_info['param']['sc_clone']))
          {
              $this->sc_clone = $this->NM_ajax_info['param']['sc_clone'];
          }
          if (isset($this->NM_ajax_info['param']['sc_seq_clone']))
          {
              $this->sc_seq_clone = $this->NM_ajax_info['param']['sc_seq_clone'];
          }
          if (isset($this->NM_ajax_info['param']['sc_seq_vert']))
          {
              $this->sc_seq_vert = $this->NM_ajax_info['param']['sc_seq_vert'];
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
      $this->sc_conv_var['hospedagem_id'] = "hospedagem_id_";
      $this->sc_conv_var['hosp_id_evento'] = "hosp_id_evento_";
      $this->sc_conv_var['hosp_id_participante'] = "hosp_id_participante_";
      $this->sc_conv_var['hosp_id_usuario'] = "hosp_id_usuario_";
      $this->sc_conv_var['hosp_cpf_participante'] = "hosp_cpf_participante_";
      $this->sc_conv_var['hosp_id_hotel'] = "hosp_id_hotel_";
      $this->sc_conv_var['hosp_acomodacao'] = "hosp_acomodacao_";
      $this->sc_conv_var['hosp_categoria'] = "hosp_categoria_";
      $this->sc_conv_var['hosp_pagamentos'] = "hosp_pagamentos_";
      $this->sc_conv_var['hosp_status'] = "hosp_status_";
      $this->sc_conv_var['hosp_tipo_pessoa'] = "hosp_tipo_pessoa_";
      $this->sc_conv_var['hosp_acompanhante'] = "hosp_acompanhante_";
      $this->sc_conv_var['hosp_qtd_acompanhante'] = "hosp_qtd_acompanhante_";
      $this->sc_conv_var['hosp_dt_checkin'] = "hosp_dt_checkin_";
      $this->sc_conv_var['hosp_dt_checkout'] = "hosp_dt_checkout_";
      $this->sc_conv_var['hosp_hr_checkin'] = "hosp_hr_checkin_";
      $this->sc_conv_var['hosp_hr_checkout'] = "hosp_hr_checkout_";
      $this->sc_conv_var['hosp_early_chkin'] = "hosp_early_chkin_";
      $this->sc_conv_var['hosp_late_chkout'] = "hosp_late_chkout_";
      $this->sc_conv_var['hosp_diarias'] = "hosp_diarias_";
      $this->sc_conv_var['hosp_taxas'] = "hosp_taxas_";
      $this->sc_conv_var['hosp_total'] = "hosp_total_";
      $this->sc_conv_var['hosp_observacoes'] = "hosp_observacoes_";
      $this->sc_conv_var['hosp_dsc_pacote'] = "hosp_dsc_pacote_";
      $this->sc_conv_var['hosp_alteracao'] = "hosp_alteracao_";
      $this->sc_conv_var['hosp_ativo'] = "hosp_ativo_";
      $this->sc_conv_var['hosp_part_acomp'] = "hosp_part_acomp_";
      $this->sc_conv_var['hosp_reserva_bvt'] = "hosp_reserva_bvt_";
      $this->sc_conv_var['conta_roomlist'] = "conta_roomlist_";
      $this->sc_conv_var['acmq_01'] = "acmq_01_";
      $this->sc_conv_var['acmq_02'] = "acmq_02_";
      $this->sc_conv_var['acmq_03'] = "acmq_03_";
      $this->sc_conv_var['acmq_04'] = "acmq_04_";
      $this->sc_conv_var['pamq_01'] = "pamq_01_";
      $this->sc_conv_var['pamq_02'] = "pamq_02_";
      $this->sc_conv_var['pamq_03'] = "pamq_03_";
      $this->sc_conv_var['pamq_04'] = "pamq_04_";
      $this->sc_conv_var['id_bloqueio_hotel'] = "id_bloqueio_hotel_";
      $this->sc_conv_var['nome_evento'] = "nome_evento_";
      $this->sc_conv_var['nome_participante'] = "nome_participante_";
      $this->sc_conv_var['nome_hotel'] = "nome_hotel_";
      $this->sc_conv_var['nome_acomodacao'] = "nome_acomodacao_";
      $this->sc_conv_var['nome_categoria'] = "nome_categoria_";
      if (isset($_POST['nmgp_opcao']) && ($_POST['nmgp_opcao'] == "ajax_add_dyn_search" || $_POST['nmgp_opcao'] == "ajax_ch_bi_dyn_search"))
      {
          ob_start();
      }
      if (isset($_GET['nmgp_opcao']) && $_GET['nmgp_opcao'] == "ajax_aut_comp_dyn_search")
      {
          ob_start();
      }
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
      if (isset($_POST["rsvp_global"]) && isset($this->rsvp_global)) 
      {
          $_SESSION['rsvp_global'] = $this->rsvp_global;
      }
      if (isset($_POST["vg_usuario_id"]) && isset($this->vg_usuario_id)) 
      {
          $_SESSION['vg_usuario_id'] = $this->vg_usuario_id;
      }
      if (isset($_GET["rsvp_global"]) && isset($this->rsvp_global)) 
      {
          $_SESSION['rsvp_global'] = $this->rsvp_global;
      }
      if (isset($_GET["vg_usuario_id"]) && isset($this->vg_usuario_id)) 
      {
          $_SESSION['vg_usuario_id'] = $this->vg_usuario_id;
      }
      if (isset($this->Refresh_aba_menu)) {
          $_SESSION['sc_session'][$script_case_init]['form_hospedagem_rsvp_ar1']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_hospedagem_rsvp_ar1']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_hospedagem_rsvp_ar1']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_hospedagem_rsvp_ar1']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['form_hospedagem_rsvp_ar1']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['form_hospedagem_rsvp_ar1']['embutida_parms']);
      } 
      if (isset($this->nmgp_parms) && !empty($this->nmgp_parms)) 
      { 
          if (isset($_SESSION['nm_aba_bg_color'])) 
          { 
              unset($_SESSION['nm_aba_bg_color']);
          }   
          $this->NM_where_filter = "";
          $tem_where_parms       = false;
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
                 nm_limpa_str_form_hospedagem_rsvp_ar1($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
                 if ($cadapar[0] == "hospedagem_id_")
                 {
                     $this->NM_where_filter .= (empty($this->NM_where_filter)) ? "(" : " and ";
                     $this->NM_where_filter .= "hospedagem_id = " . $this->hospedagem_id_;
                     $this->has_where_params = true;
                     $tem_where_parms        = true;
                 }
                 elseif ($cadapar[0] == "NM_where_filter")
                 {
                     $this->has_where_params = false;
                     $tem_where_parms        = false;
                 }
             }
             $ix++;
          }
          if (isset($this->inside_nested_grid) && 'Y' == $this->inside_nested_grid) {
              $_SESSION['sc_session'][$script_case_init]['form_hospedagem_rsvp_ar1']['inside_nested_iframe'] = true;
          }
          if (isset($this->rsvp_global)) 
          {
              $_SESSION['rsvp_global'] = $this->rsvp_global;
          }
          if (isset($this->vg_usuario_id)) 
          {
              $_SESSION['vg_usuario_id'] = $this->vg_usuario_id;
          }
          if ($tem_where_parms)
          {
              $this->NM_where_filter .= ")";
          }
          elseif (empty($this->NM_where_filter))
          {
              unset($this->NM_where_filter);
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['form_hospedagem_rsvp_ar1']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['form_hospedagem_rsvp_ar1']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['form_hospedagem_rsvp_ar1']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['form_hospedagem_rsvp_ar1']['sc_redir_insert'] = $this->sc_redir_insert;
              unset($_SESSION['sc_session'][$script_case_init]['form_hospedagem_rsvp_ar1']['opc_ant']);
          }
          if (isset($this->rsvp_global)) 
          {
              $_SESSION['rsvp_global'] = $this->rsvp_global;
          }
          if (isset($this->vg_usuario_id)) 
          {
              $_SESSION['vg_usuario_id'] = $this->vg_usuario_id;
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['form_hospedagem_rsvp_ar1']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['form_hospedagem_rsvp_ar1']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['form_hospedagem_rsvp_ar1']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['form_hospedagem_rsvp_ar1']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['form_hospedagem_rsvp_ar1']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['form_hospedagem_rsvp_ar1']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_hospedagem_rsvp_ar1']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['form_hospedagem_rsvp_ar1']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['form_hospedagem_rsvp_ar1']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['form_hospedagem_rsvp_ar1']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new form_hospedagem_rsvp_ar1_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("pt_br");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['initialize'];
          $this->Db = $this->Ini->Db; 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['initialize']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['initialize'])
          {
              $_SESSION['scriptcase']['form_hospedagem_rsvp_ar1']['contr_erro'] = 'on';
  date_default_timezone_set('America/Sao_Paulo');
echo '<h2>&nbsp;&nbsp;BRSVP Hospedagens</h2>';

$params = array(
		'title' => 'Atenção!',
		'type' => 'warning',
		'timer' => '30000',
		'showConfirmButton' => 'false',
		'position' => 'center',
		'toast' => 'true'
		);
$this->nm_mens_alert[] = "Antes de realizar quaisquer modificações escolha o CÓDIGO DO EVENTO em: * Filtro Dinâmico! *"; $this->nm_params_alert[] = $params; if ($this->NM_ajax_flag) { $this->sc_ajax_alert("Antes de realizar quaisquer modificações escolha o CÓDIGO DO EVENTO em: * Filtro Dinâmico! *", $params); }$sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'form_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';
$_SESSION['scriptcase']['form_hospedagem_rsvp_ar1']['contr_erro'] = 'off';
          }
          $this->Ini->init2();
      } 
      else 
      { 
         $this->nm_data = new nm_data("pt_br");
      } 
      $_SESSION['sc_session'][$script_case_init]['form_hospedagem_rsvp_ar1']['upload_field_info'] = array();

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_hospedagem_rsvp_ar1']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_hospedagem_rsvp_ar1'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_hospedagem_rsvp_ar1']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_hospedagem_rsvp_ar1']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('form_hospedagem_rsvp_ar1') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_hospedagem_rsvp_ar1']['label'] = "Atualização de Hospedagem";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "form_hospedagem_rsvp_ar1")
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
      $this->Ini->Img_status_ok       = !isset($str_img_status_ok_mult)  || "" == trim($str_img_status_ok_mult)   ? ""     : $str_img_status_ok_mult;
      $this->Ini->Img_status_err      = !isset($str_img_status_err_mult) || "" == trim($str_img_status_err_mult)  ? ""     : $str_img_status_err_mult;
      $this->Ini->Css_status          = "scFormInputErrorMult";
      $this->Ini->Css_status_pwd_box  = "scFormInputErrorMultPwdBox";
      $this->Ini->Css_status_pwd_text = "scFormInputErrorMultPwdText";
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

      if (isset($_POST['nmgp_opcao']) && $_POST['nmgp_opcao'] == "ajax_add_dyn_search")
      {
          $Temp = ob_get_clean();
          ob_start();
          $NM_func_dyn_add = "dynamic_search_" . $_POST['parm'];
          $Lin_dyn_add = $this->$NM_func_dyn_add($_POST['seq'], 'S');
          $this->Arr_result = array();
          $Temp = ob_get_clean();
          if ($Temp !== false && trim($Temp) != "")
          {
              $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
          }
          $this->Arr_result['dyn_add'][] = NM_charset_to_utf8($Lin_dyn_add);
          $oJson = new Services_JSON();
          echo $oJson->encode($this->Arr_result);
          exit;
      }


      $_SESSION['scriptcase']['error_icon']['form_hospedagem_rsvp_ar1']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['form_hospedagem_rsvp_ar1'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['goto']      = 'on';
          }
      }

      $this->nmgp_botoes['cancel'] = "on";
      $this->nmgp_botoes['exit'] = "on";
      $this->nmgp_botoes['qsearch'] = "on";
      $this->nmgp_botoes['dynsearch'] = "on";
      $this->nmgp_botoes['new'] = "on";
      $this->nmgp_botoes['insert'] = "on";
      $this->nmgp_botoes['copy'] = "off";
      $this->nmgp_botoes['update'] = "on";
      $this->nmgp_botoes['delete'] = "off";
      if ('total' == $this->form_paginacao)
      {
          $this->nmgp_botoes['first']   = "off";
          $this->nmgp_botoes['back']    = "off";
          $this->nmgp_botoes['forward'] = "off";
          $this->nmgp_botoes['last']    = "off";
          $this->nmgp_botoes['navpage'] = "off";
          $this->nmgp_botoes['goto']    = "off";
          $this->nmgp_botoes['qtline']  = "off";
          $this->nmgp_botoes['summary'] = "on";
      }
      else
      {
      $this->nmgp_botoes['first'] = "on";
      $this->nmgp_botoes['back'] = "on";
      $this->nmgp_botoes['forward'] = "on";
      $this->nmgp_botoes['last'] = "on";
      $this->nmgp_botoes['summary'] = "on";
      $this->nmgp_botoes['navpage'] = "on";
      $this->nmgp_botoes['goto'] = "on";
      $this->nmgp_botoes['qtline'] = "on";
      $this->nmgp_botoes['reload'] = "off";
      }
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_orig'] = " where (hosp_id_evento <> '0' AND hosp_tipo_pessoa = 'P'
AND id_bloqueio_hotel = '0')";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_pesq'] = " where (hosp_id_evento <> '0' AND hosp_tipo_pessoa = 'P'
AND id_bloqueio_hotel = '0')";
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_hospedagem_rsvp_ar1']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field . "_"] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field . "_"] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field . "_"] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field . "_"] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_hospedagem_rsvp_ar1'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_hospedagem_rsvp_ar1'];

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

      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("form_hospedagem_rsvp_ar1", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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

      if (is_file($this->Ini->path_aplicacao . 'form_hospedagem_rsvp_ar1_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'form_hospedagem_rsvp_ar1_help.txt');
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
          require_once($this->Ini->path_embutida . 'form_hospedagem_rsvp_ar1/form_hospedagem_rsvp_ar1_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "form_hospedagem_rsvp_ar1_erro.class.php"); 
      }
      $this->Erro      = new form_hospedagem_rsvp_ar1_erro();
      $this->Erro->Ini = $this->Ini;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['sc_max_reg']) && strtolower($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['sc_max_reg']) == "all")
      {
          $this->form_paginacao = "total";
      }
      $this->proc_fast_search = false;
      if ($this->nmgp_opcao == "fast_search")  
      {
          $this->SC_fast_search($this->nmgp_fast_search, $this->nmgp_cond_fast_search, $this->nmgp_arg_fast_search);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['opcao'] = "inicio";
          $this->nmgp_opcao = "inicio";
          $this->proc_fast_search = true;
      } 
      if ($this->nmgp_opcao == "dyn_search" || $this->nmgp_opcao == "dyn_search_clear")  
      {
          $this->proc_fast_search = true;
          if ($this->nmgp_opcao == "dyn_search_clear")  
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_and_or']);
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_cache']);
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_filter']);
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['total']);
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['cond_pesq']);
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search']);
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['cond_dyn_search']);
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_detal'])) 
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_detal'];
              }
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['empty_filter'])
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['empty_filter']);
                  $this->NM_ajax_info['empty_filter'] = 'ok';
                  form_hospedagem_rsvp_ar1_pack_ajax_response();
                  exit;
              }
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_clear'] = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_refresh'] = array();
              $this->html_dynamic_search();
          } 
          else
          {
              $this->SC_proc_dyn_search($this->nmgp_arg_dyn_search);
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['opcao'] = "inicio";
          $this->nmgp_opcao = "inicio";
      } 
      if ((!isset($nm_opc_lookup) || $nm_opc_lookup != "lookup") && (!isset($nm_opc_php) || $nm_opc_php != "formphp"))
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['opcao']))
         { 
             if ($this->hospedagem_id_ != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if ($this->nmgp_opcao == "edit_novo")  
      {
          $this->nmgp_opcao = "novo";
          $this->nm_flag_saida_novo = "S";
      }
//
      $this->NM_case_insensitive = true;
      $this->sc_evento = $this->nmgp_opcao;
      if (!isset($this->NM_ajax_flag) || ('validate_' != substr($this->NM_ajax_opcao, 0, 9) && 'add_new_line' != $this->NM_ajax_opcao && 'autocomp_' != substr($this->NM_ajax_opcao, 0, 9)))
      {
      $_SESSION['scriptcase']['form_hospedagem_rsvp_ar1']['contr_erro'] = 'on';
  date_default_timezone_set('America/Sao_Paulo');
$this->NM_ajax_info['buttonDisplay']['new'] = $this->nmgp_botoes["new"] = 'off';;
$_SESSION['scriptcase']['form_hospedagem_rsvp_ar1']['contr_erro'] = 'off'; 
      }
            if ('ajax_check_file' == $this->nmgp_opcao ){
                 ob_start(); 
                 global $bol_api_prod; 
                 $bol_api_prod = true; 
                 if (isset($_SESSION['scriptcase']['form_hospedagem_rsvp_ar1']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['form_hospedagem_rsvp_ar1']['glo_nm_conexao'])) 
                 { 
                     $bol_api_prod = false;
                 } 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['form_hospedagem_rsvp_ar1']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['form_hospedagem_rsvp_ar1']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
            copy($__file_download, $_SERVER['DOCUMENT_ROOT'].$orig_img);
            echo $orig_img . '_@@NM@@_';            copy($__file_download, $_SERVER['DOCUMENT_ROOT'].$out1_img_cache);
            $sc_obj_img = new nm_trata_img($_SERVER['DOCUMENT_ROOT'].$out1_img_cache, true);

            if(!empty($img_width) && !empty($img_height)){
                $sc_obj_img->setWidth($img_width);
                $sc_obj_img->setHeight($img_height);
            }
                $sc_obj_img->setManterAspecto(true);
            $sc_obj_img->createImg($_SERVER['DOCUMENT_ROOT'].$out1_img_cache);
            echo $out1_img_cache;
               exit;
            }
      if (isset($nm_opc_lookup) && $nm_opc_lookup == "lookup")
      { 
          if ($GLOBALS['F'] == "nome_evento_")
          { 
              $nm_parms   = substr($GLOBALS['P0'], 1, strlen($GLOBALS['P0']) - 2);
              $array_vars = explode(",", $nm_parms);
              $this->hosp_id_evento_ = $array_vars[0];
              $hosp_id_evento_       = $this->hosp_id_evento_;
              nm_limpa_numero($hosp_id_evento_, $this->field_config['hosp_id_evento_']['symbol_grp']); 
              $this->hosp_id_evento_       = $hosp_id_evento_;
              $this->lookup_nome_evento_($conteudo);
              $conteudo = str_replace("&", "&amp;", $conteudo); 
              $conteudo = str_replace("\/" , "\/", $conteudo); 
              echo "<!DOCTYPE html><html><head></head>";
              echo " <body onload=\"p=document.layers?parentLayer:window.parent;p.jsrsLoaded('" . $GLOBALS['C'] . "');\">";
              echo "  jsrsPayload:";
              echo "  <br>";
              echo "  <form name=\"jsrs_Form\"><textarea name=\"jsrs_Payload\">";
              echo "$conteudo";
              echo " </textarea></form></body></html>";
          } 
          if ($GLOBALS['F'] == "nome_participante_")
          { 
              $nm_parms   = substr($GLOBALS['P0'], 1, strlen($GLOBALS['P0']) - 2);
              $array_vars = explode(",", $nm_parms);
              $this->hosp_cpf_participante_ = $array_vars[0];
              $hosp_cpf_participante_       = $this->hosp_cpf_participante_;
              $this->hosp_cpf_participante_       = $hosp_cpf_participante_;
              $this->lookup_nome_participante_($conteudo);
              $conteudo = str_replace("&", "&amp;", $conteudo); 
              $conteudo = str_replace("\/" , "\/", $conteudo); 
              echo "<!DOCTYPE html><html><head></head>";
              echo " <body onload=\"p=document.layers?parentLayer:window.parent;p.jsrsLoaded('" . $GLOBALS['C'] . "');\">";
              echo "  jsrsPayload:";
              echo "  <br>";
              echo "  <form name=\"jsrs_Form\"><textarea name=\"jsrs_Payload\">";
              echo "$conteudo";
              echo " </textarea></form></body></html>";
          } 
          $this->NM_close_db(); 
          exit;
      } 
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
      //-- hosp_id_evento_
      $this->field_config['hosp_id_evento_']               = array();
      $this->field_config['hosp_id_evento_']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['hosp_id_evento_']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['hosp_id_evento_']['symbol_dec'] = '';
      $this->field_config['hosp_id_evento_']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['hosp_id_evento_']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- hosp_id_hotel_
      $this->field_config['hosp_id_hotel_']               = array();
      $this->field_config['hosp_id_hotel_']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['hosp_id_hotel_']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['hosp_id_hotel_']['symbol_dec'] = '';
      $this->field_config['hosp_id_hotel_']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['hosp_id_hotel_']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- hosp_acomodacao_
      $this->field_config['hosp_acomodacao_']               = array();
      $this->field_config['hosp_acomodacao_']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['hosp_acomodacao_']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['hosp_acomodacao_']['symbol_dec'] = '';
      $this->field_config['hosp_acomodacao_']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['hosp_acomodacao_']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- hosp_categoria_
      $this->field_config['hosp_categoria_']               = array();
      $this->field_config['hosp_categoria_']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['hosp_categoria_']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['hosp_categoria_']['symbol_dec'] = '';
      $this->field_config['hosp_categoria_']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['hosp_categoria_']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- hospedagem_id_
      $this->field_config['hospedagem_id_']               = array();
      $this->field_config['hospedagem_id_']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['hospedagem_id_']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['hospedagem_id_']['symbol_dec'] = '';
      $this->field_config['hospedagem_id_']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['hospedagem_id_']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- hosp_id_participante_
      $this->field_config['hosp_id_participante_']               = array();
      $this->field_config['hosp_id_participante_']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['hosp_id_participante_']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['hosp_id_participante_']['symbol_dec'] = '';
      $this->field_config['hosp_id_participante_']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['hosp_id_participante_']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- hosp_id_usuario_
      $this->field_config['hosp_id_usuario_']               = array();
      $this->field_config['hosp_id_usuario_']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['hosp_id_usuario_']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['hosp_id_usuario_']['symbol_dec'] = '';
      $this->field_config['hosp_id_usuario_']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['hosp_id_usuario_']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- hosp_pagamentos_
      $this->field_config['hosp_pagamentos_']               = array();
      $this->field_config['hosp_pagamentos_']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['hosp_pagamentos_']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['hosp_pagamentos_']['symbol_dec'] = '';
      $this->field_config['hosp_pagamentos_']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['hosp_pagamentos_']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- hosp_dt_checkin_
      $this->field_config['hosp_dt_checkin_']                 = array();
      $this->field_config['hosp_dt_checkin_']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['hosp_dt_checkin_']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['hosp_dt_checkin_']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'hosp_dt_checkin_');
      //-- hosp_dt_checkout_
      $this->field_config['hosp_dt_checkout_']                 = array();
      $this->field_config['hosp_dt_checkout_']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['hosp_dt_checkout_']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['hosp_dt_checkout_']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'hosp_dt_checkout_');
      //-- hosp_hr_checkin_
      $this->field_config['hosp_hr_checkin_']                 = array();
      $this->field_config['hosp_hr_checkin_']['date_format']  = $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['hosp_hr_checkin_']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['hosp_hr_checkin_']['date_display'] = "hhiiss";
      $this->new_date_format('HH', 'hosp_hr_checkin_');
      //-- hosp_hr_checkout_
      $this->field_config['hosp_hr_checkout_']                 = array();
      $this->field_config['hosp_hr_checkout_']['date_format']  = $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['hosp_hr_checkout_']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['hosp_hr_checkout_']['date_display'] = "hhiiss";
      $this->new_date_format('HH', 'hosp_hr_checkout_');
      //-- hosp_diarias_
      $this->field_config['hosp_diarias_']               = array();
      $this->field_config['hosp_diarias_']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['hosp_diarias_']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['hosp_diarias_']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['hosp_diarias_']['symbol_mon'] = '';
      $this->field_config['hosp_diarias_']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['hosp_diarias_']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- hosp_taxas_
      $this->field_config['hosp_taxas_']               = array();
      $this->field_config['hosp_taxas_']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['hosp_taxas_']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['hosp_taxas_']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['hosp_taxas_']['symbol_mon'] = '';
      $this->field_config['hosp_taxas_']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['hosp_taxas_']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- hosp_total_
      $this->field_config['hosp_total_']               = array();
      $this->field_config['hosp_total_']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['hosp_total_']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['hosp_total_']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['hosp_total_']['symbol_mon'] = '';
      $this->field_config['hosp_total_']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['hosp_total_']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- hosp_alteracao_
      $this->field_config['hosp_alteracao_']                 = array();
      $this->field_config['hosp_alteracao_']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['hosp_alteracao_']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['hosp_alteracao_']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['hosp_alteracao_']['date_display'] = "ddmmaaaa;hhiiss";
      $this->new_date_format('DH', 'hosp_alteracao_');
      //-- id_bloqueio_hotel_
      $this->field_config['id_bloqueio_hotel_']               = array();
      $this->field_config['id_bloqueio_hotel_']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['id_bloqueio_hotel_']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['id_bloqueio_hotel_']['symbol_dec'] = '';
      $this->field_config['id_bloqueio_hotel_']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['id_bloqueio_hotel_']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
   }

   function controle()
   {
        global $nm_url_saida, $teste_validade, 
               $GLOBALS, $Campos_Crit, $Campos_Falta, $Campos_Erros, $sc_seq_vert, $sc_check_incl, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;


      $this->ini_controle();
      if ($this->nmgp_opcao == "change_qtd_line")
      {
          $this->NM_btn_navega = "N";
          if (strtolower($this->nmgp_max_line) == "all")
          {
              $this->nmgp_opcao = "inicio";
              $this->form_paginacao = "total";
          }
          else
          {
              $this->nmgp_opcao = "igual";
              $this->form_paginacao = "parcial";
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['sc_max_reg'] = $this->nmgp_max_line;
      }
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

      $Campos_Crit       = "";
      $Campos_erro       = "";
      $Campos_Falta      = array();
      $Campos_Erros      = array();
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          =  substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['opc_edit'] = true;  
      $sc_contr_vert = (isset($GLOBALS["sc_contr_vert"])) ? $GLOBALS["sc_contr_vert"] : "";
      $sc_seq_vert   = 1; 
      $sc_opc_salva  = $this->nmgp_opcao; 
      $sc_todas_Crit = "";
      $sc_check_excl = array(); 
      $sc_check_incl = array(); 
      if (isset($GLOBALS["sc_check_vert"]) && is_array($GLOBALS["sc_check_vert"])) 
      { 
          if ($this->nmgp_opcao == "incluir" || ($this->nmgp_opcao == "recarga" && $this->nmgp_opc_ant == "novo"))
          {
              $sc_check_incl = $GLOBALS["sc_check_vert"]; 
          }
          elseif ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "excluir" || $this->nmgp_opcao == "recarga")
          {
              $sc_check_excl = $GLOBALS["sc_check_vert"]; 
          }
      } 
      elseif ($this->nmgp_opcao == 'incluir' && isset($_POST['upload_file_row']) && '' != $_POST['upload_file_row'])
      {
          $sc_check_incl = array($_POST['upload_file_row']);
      }
      if (empty($this->nmgp_opcao)) 
      { 
          $this->nmgp_opcao = "inicio";
      } 
      if ($this->NM_ajax_flag && 'add_new_line' == $this->NM_ajax_opcao)
      {
         $this->nmgp_opcao = "novo";
         $this->nm_select_banco();
         $this->nm_gera_html();
         $this->NM_ajax_info['newline'] = NM_utf8_urldecode($this->New_Line);
         $this->NM_close_db();
         form_hospedagem_rsvp_ar1_pack_ajax_response();
         exit;
      }
      if ($this->NM_ajax_flag && 'backup_line' == $this->NM_ajax_opcao)
      {
         $this->nmgp_opcao = "igual";
         $this->nm_tira_formatacao();
         $this->nm_select_banco();
         $this->ajax_return_values();
         $this->NM_close_db();
         form_hospedagem_rsvp_ar1_pack_ajax_response();
         exit;
      }
      if ($this->NM_ajax_flag && 'submit_form' == $this->NM_ajax_opcao)
      {
         if (isset($this->hosp_id_evento_)) { $this->nm_limpa_alfa($this->hosp_id_evento_); }
         if (isset($this->hosp_cpf_participante_)) { $this->nm_limpa_alfa($this->hosp_cpf_participante_); }
         if (isset($this->hosp_id_hotel_)) { $this->nm_limpa_alfa($this->hosp_id_hotel_); }
         if (isset($this->hosp_acomodacao_)) { $this->nm_limpa_alfa($this->hosp_acomodacao_); }
         if (isset($this->hosp_categoria_)) { $this->nm_limpa_alfa($this->hosp_categoria_); }
         if (isset($this->conta_roomlist_)) { $this->nm_limpa_alfa($this->conta_roomlist_); }
         if (isset($this->Sc_num_lin_alt) && $this->Sc_num_lin_alt > 0) 
         {
             $sc_seq_vert = $this->Sc_num_lin_alt;
         }
         if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dados_form'][$sc_seq_vert]))
         {
             $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dados_form'][$sc_seq_vert];
             $this->hospedagem_id_ = $this->nmgp_dados_form['hospedagem_id_']; 
             $this->hosp_id_participante_ = $this->nmgp_dados_form['hosp_id_participante_']; 
             $this->hosp_id_usuario_ = $this->nmgp_dados_form['hosp_id_usuario_']; 
             $this->hosp_pagamentos_ = $this->nmgp_dados_form['hosp_pagamentos_']; 
             $this->hosp_tipo_pessoa_ = $this->nmgp_dados_form['hosp_tipo_pessoa_']; 
             $this->hosp_acompanhante_ = $this->nmgp_dados_form['hosp_acompanhante_']; 
             $this->hosp_qtd_acompanhante_ = $this->nmgp_dados_form['hosp_qtd_acompanhante_']; 
             $this->hosp_dt_checkin_ = $this->nmgp_dados_form['hosp_dt_checkin_']; 
             $this->hosp_dt_checkout_ = $this->nmgp_dados_form['hosp_dt_checkout_']; 
             $this->hosp_hr_checkin_ = $this->nmgp_dados_form['hosp_hr_checkin_']; 
             $this->hosp_hr_checkout_ = $this->nmgp_dados_form['hosp_hr_checkout_']; 
             $this->hosp_early_chkin_ = $this->nmgp_dados_form['hosp_early_chkin_']; 
             $this->hosp_late_chkout_ = $this->nmgp_dados_form['hosp_late_chkout_']; 
             $this->hosp_diarias_ = $this->nmgp_dados_form['hosp_diarias_']; 
             $this->hosp_taxas_ = $this->nmgp_dados_form['hosp_taxas_']; 
             $this->hosp_total_ = $this->nmgp_dados_form['hosp_total_']; 
             $this->hosp_observacoes_ = $this->nmgp_dados_form['hosp_observacoes_']; 
             $this->hosp_dsc_pacote_ = $this->nmgp_dados_form['hosp_dsc_pacote_']; 
             $this->hosp_alteracao_ = $this->nmgp_dados_form['hosp_alteracao_']; 
             $this->hosp_ativo_ = $this->nmgp_dados_form['hosp_ativo_']; 
             $this->hosp_part_acomp_ = $this->nmgp_dados_form['hosp_part_acomp_']; 
             $this->hosp_reserva_bvt_ = $this->nmgp_dados_form['hosp_reserva_bvt_']; 
             $this->acmq_01_ = $this->nmgp_dados_form['acmq_01_']; 
             $this->acmq_02_ = $this->nmgp_dados_form['acmq_02_']; 
             $this->acmq_03_ = $this->nmgp_dados_form['acmq_03_']; 
             $this->acmq_04_ = $this->nmgp_dados_form['acmq_04_']; 
             $this->pamq_01_ = $this->nmgp_dados_form['pamq_01_']; 
             $this->pamq_02_ = $this->nmgp_dados_form['pamq_02_']; 
             $this->pamq_03_ = $this->nmgp_dados_form['pamq_03_']; 
             $this->pamq_04_ = $this->nmgp_dados_form['pamq_04_']; 
             $this->id_bloqueio_hotel_ = $this->nmgp_dados_form['id_bloqueio_hotel_']; 
         }
         $this->controle_form_vert();
         if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
         {
             $this->NM_rollback_db();
              if ($this->NM_ajax_flag)
              {
                  if (!isset($this->NM_ajax_info['errList']['geral_form_hospedagem_rsvp_ar1']) || !is_array($this->NM_ajax_info['errList']['geral_form_hospedagem_rsvp_ar1']))
                  {
                      $this->NM_ajax_info['errList']['geral_form_hospedagem_rsvp_ar1'] = array();
                  }
                  if ($Campos_Crit != "")
                  {
                      $this->NM_ajax_info['errList']['geral_form_hospedagem_rsvp_ar1'][] = $Campos_Crit;
                  }
                  if (!empty($Campos_Falta))
                  {
                      $this->NM_ajax_info['errList']['geral_form_hospedagem_rsvp_ar1'][] = $this->Formata_Campos_Falta($Campos_Falta);
                  }
                  if ($this->Campos_Mens_erro != "")
                  {
                      $this->NM_ajax_info['errList']['geral_form_hospedagem_rsvp_ar1'][] = $this->Campos_Mens_erro;
                  }
              }
         }
         else
         {
             $this->NM_commit_db();
         }
         if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form" && !$this->Apl_com_erro)
         {
             $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_teve_incl && empty($sc_todas_Crit))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['sc_redir_atualiz'] == "ok")
          {
              if ($this->sc_teve_alt && empty($sc_todas_Crit))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
              if ($this->sc_teve_excl && empty($sc_todas_Crit))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
         }
         $this->NM_close_db();
                if ('alterar' == $this->NM_ajax_info['param']['nmgp_opcao'] && 'ERROR' != $this->NM_ajax_info['result']) {
                        $this->NM_ajax_info['msgDisplay'] = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_ajax_frmu']);
                }
                if ('incluir' == $this->NM_ajax_info['param']['nmgp_opcao'] && 'ERROR' != $this->NM_ajax_info['result']) {
                        $this->NM_ajax_info['msgDisplay'] = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_ajax_frmi']);
                }
                if ('excluir' == $this->NM_ajax_info['param']['nmgp_opcao'] && 'ERROR' != $this->NM_ajax_info['result']) {
                        $this->NM_ajax_info['msgDisplay'] = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_ajax_frmd']);
                }
         if (!isset($GLOBALS["sc_check_vert"]) || empty($GLOBALS["sc_check_vert"])) {
             $this->NM_ajax_info['msgDisplay'] = $this->Ini->Nm_lang['lang_othr_ajax_selreg'];
         }
         form_hospedagem_rsvp_ar1_pack_ajax_response();
         exit;
      }
      if ($this->NM_ajax_flag && 'validate_' == substr($this->NM_ajax_opcao, 0, 9))
      {
         $Campos_Crit  = "";
         $Campos_Falta = array();
         $Campos_Erros = array();
          if ('validate_hosp_id_evento_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hosp_id_evento_');
          }
          if ('validate_nome_evento_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'nome_evento_');
          }
          if ('validate_hosp_cpf_participante_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hosp_cpf_participante_');
          }
          if ('validate_nome_participante_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'nome_participante_');
          }
          if ('validate_hosp_id_hotel_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hosp_id_hotel_');
          }
          if ('validate_nome_hotel_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'nome_hotel_');
          }
          if ('validate_hosp_acomodacao_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hosp_acomodacao_');
          }
          if ('validate_nome_acomodacao_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'nome_acomodacao_');
          }
          if ('validate_hosp_categoria_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hosp_categoria_');
          }
          if ('validate_nome_categoria_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'nome_categoria_');
          }
          if ('validate_hosp_status_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'hosp_status_');
          }
          if ('validate_conta_roomlist_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'conta_roomlist_');
          }
          form_hospedagem_rsvp_ar1_pack_ajax_response();
          exit;
      }
      while ($sc_contr_vert > $sc_seq_vert) 
      { 
         $Campos_Crit  = "";
         $Campos_Falta = array();
         $Campos_Erros = array();
         $this->hosp_id_evento_ = $GLOBALS["hosp_id_evento_" . $sc_seq_vert]; 
         $this->nome_evento_ = $GLOBALS["nome_evento_" . $sc_seq_vert]; 
         $this->hosp_cpf_participante_ = $GLOBALS["hosp_cpf_participante_" . $sc_seq_vert]; 
         $this->nome_participante_ = $GLOBALS["nome_participante_" . $sc_seq_vert]; 
         $this->hosp_id_hotel_ = $GLOBALS["hosp_id_hotel_" . $sc_seq_vert]; 
         $this->nome_hotel_ = $GLOBALS["nome_hotel_" . $sc_seq_vert]; 
         $this->hosp_acomodacao_ = $GLOBALS["hosp_acomodacao_" . $sc_seq_vert]; 
         $this->nome_acomodacao_ = $GLOBALS["nome_acomodacao_" . $sc_seq_vert]; 
         $this->hosp_categoria_ = $GLOBALS["hosp_categoria_" . $sc_seq_vert]; 
         $this->nome_categoria_ = $GLOBALS["nome_categoria_" . $sc_seq_vert]; 
         $this->hosp_status_ = $GLOBALS["hosp_status_" . $sc_seq_vert]; 
         $this->conta_roomlist_ = $GLOBALS["conta_roomlist_" . $sc_seq_vert]; 
         if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dados_form'][$sc_seq_vert]))
         {
             $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dados_form'][$sc_seq_vert];
             $this->hospedagem_id_ = $this->nmgp_dados_form['hospedagem_id_']; 
             $this->hosp_id_participante_ = $this->nmgp_dados_form['hosp_id_participante_']; 
             $this->hosp_id_usuario_ = $this->nmgp_dados_form['hosp_id_usuario_']; 
             $this->hosp_pagamentos_ = $this->nmgp_dados_form['hosp_pagamentos_']; 
             $this->hosp_tipo_pessoa_ = $this->nmgp_dados_form['hosp_tipo_pessoa_']; 
             $this->hosp_acompanhante_ = $this->nmgp_dados_form['hosp_acompanhante_']; 
             $this->hosp_qtd_acompanhante_ = $this->nmgp_dados_form['hosp_qtd_acompanhante_']; 
             $this->hosp_dt_checkin_ = $this->nmgp_dados_form['hosp_dt_checkin_']; 
             $this->hosp_dt_checkout_ = $this->nmgp_dados_form['hosp_dt_checkout_']; 
             $this->hosp_hr_checkin_ = $this->nmgp_dados_form['hosp_hr_checkin_']; 
             $this->hosp_hr_checkout_ = $this->nmgp_dados_form['hosp_hr_checkout_']; 
             $this->hosp_early_chkin_ = $this->nmgp_dados_form['hosp_early_chkin_']; 
             $this->hosp_late_chkout_ = $this->nmgp_dados_form['hosp_late_chkout_']; 
             $this->hosp_diarias_ = $this->nmgp_dados_form['hosp_diarias_']; 
             $this->hosp_taxas_ = $this->nmgp_dados_form['hosp_taxas_']; 
             $this->hosp_total_ = $this->nmgp_dados_form['hosp_total_']; 
             $this->hosp_observacoes_ = $this->nmgp_dados_form['hosp_observacoes_']; 
             $this->hosp_dsc_pacote_ = $this->nmgp_dados_form['hosp_dsc_pacote_']; 
             $this->hosp_alteracao_ = $this->nmgp_dados_form['hosp_alteracao_']; 
             $this->hosp_ativo_ = $this->nmgp_dados_form['hosp_ativo_']; 
             $this->hosp_part_acomp_ = $this->nmgp_dados_form['hosp_part_acomp_']; 
             $this->hosp_reserva_bvt_ = $this->nmgp_dados_form['hosp_reserva_bvt_']; 
             $this->acmq_01_ = $this->nmgp_dados_form['acmq_01_']; 
             $this->acmq_02_ = $this->nmgp_dados_form['acmq_02_']; 
             $this->acmq_03_ = $this->nmgp_dados_form['acmq_03_']; 
             $this->acmq_04_ = $this->nmgp_dados_form['acmq_04_']; 
             $this->pamq_01_ = $this->nmgp_dados_form['pamq_01_']; 
             $this->pamq_02_ = $this->nmgp_dados_form['pamq_02_']; 
             $this->pamq_03_ = $this->nmgp_dados_form['pamq_03_']; 
             $this->pamq_04_ = $this->nmgp_dados_form['pamq_04_']; 
             $this->id_bloqueio_hotel_ = $this->nmgp_dados_form['id_bloqueio_hotel_']; 
         }
         if (isset($this->hosp_id_evento_)) { $this->nm_limpa_alfa($this->hosp_id_evento_); }
         if (isset($this->hosp_cpf_participante_)) { $this->nm_limpa_alfa($this->hosp_cpf_participante_); }
         if (isset($this->hosp_id_hotel_)) { $this->nm_limpa_alfa($this->hosp_id_hotel_); }
         if (isset($this->hosp_acomodacao_)) { $this->nm_limpa_alfa($this->hosp_acomodacao_); }
         if (isset($this->hosp_categoria_)) { $this->nm_limpa_alfa($this->hosp_categoria_); }
         if (isset($this->conta_roomlist_)) { $this->nm_limpa_alfa($this->conta_roomlist_); }
         if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dados_form'])) 
         {
            $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dados_form'][$sc_seq_vert];
         }
         if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dados_select'])) 
         {
            $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dados_select'][$sc_seq_vert];
         }
         if ($this->nmgp_opcao != "recarga" && (!in_array($sc_seq_vert, $sc_check_excl) && !in_array($sc_seq_vert, $sc_check_incl) ))
         { }
         else
         {
             $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['sc_disabled'] = array();
             $this->controle_form_vert(); 
             $this->nmgp_opcao = $sc_opc_salva; 
             if ($this->nmgp_opcao != "recarga"  && $this->nmgp_opcao != "muda_form" && ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != ""))
             {
                 $sc_todas_Crit .= (!empty($sc_todas_Crit)) ? "<br>" : ""; 
                 $sc_todas_Crit .= "<B>" . $this->Ini->Nm_lang['lang_errm_line'] . $sc_seq_vert . "</B>: "; 
                 $sc_todas_Crit .= $this->Formata_Erros($Campos_Crit, $Campos_Falta, $Campos_Erros);
                 $this->Campos_Mens_erro = ""; 
             }
             if ($this->nmgp_opcao != "recarga") 
             {
                $this->nm_guardar_campos();
                $this->nm_formatar_campos();
             }
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_id_evento_'] =  $this->hosp_id_evento_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['nome_evento_'] =  $this->nome_evento_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_cpf_participante_'] =  $this->hosp_cpf_participante_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['nome_participante_'] =  $this->nome_participante_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_id_hotel_'] =  $this->hosp_id_hotel_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['nome_hotel_'] =  $this->nome_hotel_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_acomodacao_'] =  $this->hosp_acomodacao_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['nome_acomodacao_'] =  $this->nome_acomodacao_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_categoria_'] =  $this->hosp_categoria_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['nome_categoria_'] =  $this->nome_categoria_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_status_'] =  $this->hosp_status_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['conta_roomlist_'] =  $this->conta_roomlist_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hospedagem_id_'] =  $this->hospedagem_id_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_id_participante_'] =  $this->hosp_id_participante_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_id_usuario_'] =  $this->hosp_id_usuario_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_pagamentos_'] =  $this->hosp_pagamentos_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_tipo_pessoa_'] =  $this->hosp_tipo_pessoa_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_acompanhante_'] =  $this->hosp_acompanhante_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_qtd_acompanhante_'] =  $this->hosp_qtd_acompanhante_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_dt_checkin_'] =  $this->hosp_dt_checkin_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_dt_checkout_'] =  $this->hosp_dt_checkout_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_hr_checkin_'] =  $this->hosp_hr_checkin_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_hr_checkout_'] =  $this->hosp_hr_checkout_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_early_chkin_'] =  $this->hosp_early_chkin_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_late_chkout_'] =  $this->hosp_late_chkout_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_diarias_'] =  $this->hosp_diarias_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_taxas_'] =  $this->hosp_taxas_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_total_'] =  $this->hosp_total_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_observacoes_'] =  $this->hosp_observacoes_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_dsc_pacote_'] =  $this->hosp_dsc_pacote_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_alteracao_'] =  $this->hosp_alteracao_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_alteracao__hora'] =  $this->hosp_alteracao__hora; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_ativo_'] =  $this->hosp_ativo_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_part_acomp_'] =  $this->hosp_part_acomp_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_reserva_bvt_'] =  $this->hosp_reserva_bvt_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['acmq_01_'] =  $this->acmq_01_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['acmq_02_'] =  $this->acmq_02_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['acmq_03_'] =  $this->acmq_03_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['acmq_04_'] =  $this->acmq_04_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['pamq_01_'] =  $this->pamq_01_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['pamq_02_'] =  $this->pamq_02_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['pamq_03_'] =  $this->pamq_03_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['pamq_04_'] =  $this->pamq_04_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['id_bloqueio_hotel_'] =  $this->id_bloqueio_hotel_; 
         }
         $sc_seq_vert++; 
      } 
      $Save_option = $this->nmgp_opcao; 
      if (!empty($sc_todas_Crit)) 
      { 
          $this->Erro->mensagem(__FILE__, __LINE__, "critica", $sc_todas_Crit); 
          if ($this->nmgp_opcao == "incluir")
          { 
              $this->nmgp_opcao = "novo"; 
          }
      } 
      elseif ($this->nmgp_opcao == "incluir")
      { 
          $this->Mens_return_ok = $this->Ini->Nm_lang['lang_othr_ajax_frmi'];
          $this->nmgp_opcao = "novo"; 
      }
      if (empty($sc_todas_Crit) && $this->nmgp_opcao == "alterar") {
         $this->Mens_return_ok = $this->Ini->Nm_lang['lang_othr_ajax_frmu'];
      }
      if (empty($sc_todas_Crit) && $this->nmgp_opcao == "excluir") {
         $this->Mens_return_ok = $this->Ini->Nm_lang['lang_othr_ajax_frmd'];
      }
      if (($Save_option == "incluir" || $Save_option == "alterar" || $Save_option == "excluir") && (!isset($GLOBALS["sc_check_vert"]) || empty($GLOBALS["sc_check_vert"]))) {
         $this->Mens_return_ok = $this->Ini->Nm_lang['lang_othr_ajax_selreg'];
      }
      if ($this->nmgp_opcao == 'incluir' && isset($_POST['upload_file_row']) && '' != $_POST['upload_file_row'])
      {
          $this->nmgp_opcao = 'igual';
      }
      if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form" && (!$this->NM_ajax_flag || 'event_' != substr($this->NM_ajax_opcao, 0, 6))) 
      { 
          if ($this->sc_teve_incl) 
          { 
              $this->sc_after_all_insert = true;
          }
          if ($this->sc_teve_alt) 
          { 
              $this->sc_after_all_update = true;
          }
          if ($this->sc_teve_excl) 
          { 
              $this->sc_after_all_delete = true;
          }

          if ($this->sc_after_all_update) {
          $_SESSION['scriptcase']['form_hospedagem_rsvp_ar1']['contr_erro'] = 'on';
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
if (!isset($this->sc_temp_rsvp_global)) {$this->sc_temp_rsvp_global = (isset($_SESSION['rsvp_global'])) ? $_SESSION['rsvp_global'] : "";}
  date_default_timezone_set('America/Sao_Paulo');

if ($this->sc_temp_rsvp_global['log_rsvp'] == true) { 
	$sql_log = $_SESSION['scriptcase']['sc_sql_ult_comando'];
	$hora_now = date('Y-m-d H:i:s');
	$ip_usuario = $this->PegaIP();
	$id_usuario = $this->sc_temp_vg_usuario_id;
	$global_cpf = $this->sc_temp_rsvp_global['usuario_cpf'];
	$modulo=  $this->Ini->nm_cod_apl;
	$aplicacao = $this->Ini->nm_nome_apl;			
	$acao = "SUBSTITUIÇÃO PARCIAIS DE HOSPEDAGEM";
	$campo_id = '';
	$vl_campo_id = '';
	$campo_cpf = '';
	$vl_campo_cpf = '';
	$campo_evt = '';
	$vl_campo_evt = '';			
	$tabela = 'hospedagem_rsvp';
	$obs = '';
	
	$retLog = $this->GravaLog($hora_now,$ip_usuario,$id_usuario,$global_cpf,$modulo,$aplicacao,$acao,$campo_id,$vl_campo_id,$campo_cpf,$vl_campo_cpf,$campo_evt,$vl_campo_evt,$tabela,$obs,$sql_log);
	if ($retLog == false) {
		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Erro ao Gravar LOG";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_form_hospedagem_rsvp_ar1';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_hospedagem_rsvp_ar1';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Erro ao Gravar LOG";
 }
;					
	}	
}
if (isset($this->sc_temp_rsvp_global)) { $_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
if (isset($this->sc_temp_vg_usuario_id)) { $_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
$_SESSION['scriptcase']['form_hospedagem_rsvp_ar1']['contr_erro'] = 'off'; 
          }
          if (empty($sc_todas_Crit)) 
          { 
              $this->NM_commit_db(); 
              $this->nm_select_banco();
              $sc_check_excl = array(); 
          } 
          else
          { 
              $this->NM_rollback_db(); 
          } 
      } 
      if ($this->nmgp_opcao == "recarga") 
      { 
          $this->NM_gera_nav_page(); 
      } 
      if ($this->NM_ajax_flag && ('navigate_form' == $this->NM_ajax_opcao || !empty($this->nmgp_refresh_fields)))
      {
          $this->ajax_return_values();
          $this->ajax_add_parameters();
          $this->NM_close_db();
          form_hospedagem_rsvp_ar1_pack_ajax_response();
          exit;
      }
      if ($this->NM_ajax_flag && 'table_refresh' == $this->NM_ajax_opcao)
      {
          $this->nm_gera_html();
          $this->NM_ajax_info['tableRefresh'] = NM_charset_to_utf8($this->Table_refresh . $this->New_Line) . '</table>';
          $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
          $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
          $this->NM_ajax_info['rsSize'] = sizeof($this->form_vert_form_hospedagem_rsvp_ar1);
          $this->NM_ajax_info['fldList']['hospedagem_id_']['keyVal'] = sc_htmlentities($this->nmgp_dados_form['hospedagem_id_']);
          $this->NM_close_db();
          form_hospedagem_rsvp_ar1_pack_ajax_response();
          exit;
      }
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6))
      {
          $this->nm_tira_formatacao();
          if ('event_hosp_acomodacao__onchange' == $this->NM_ajax_opcao)
          {
              $this->hosp_acomodacao__onChange();
          }
          if ('event_hosp_categoria__onchange' == $this->NM_ajax_opcao)
          {
              $this->hosp_categoria__onChange();
          }
          if ('event_hosp_id_hotel__onchange' == $this->NM_ajax_opcao)
          {
              $this->hosp_id_hotel__onChange();
          }
          $this->NM_close_db();
          form_hospedagem_rsvp_ar1_pack_ajax_response();
          exit;
      }
      if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form" && !$this->Apl_com_erro)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_teve_incl && empty($sc_todas_Crit))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['sc_redir_atualiz'] == "ok")
          {
              if ($this->sc_teve_alt && empty($sc_todas_Crit))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
              if ($this->sc_teve_excl && empty($sc_todas_Crit))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
      }
      $this->nm_todas_criticas = $sc_todas_Crit;
      $this->nm_gera_html();
      $this->NM_close_db(); 
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
   function controle_form_vert()
   {
     global $nm_opc_lookup,$Campos_Crit, $Campos_Falta, $Campos_Erros, 
            $glo_senha_protect, $nm_apl_dependente, $nm_form_submit;

//
//-----> 
//
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->nm_tira_formatacao();
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          $this->nm_acessa_banco();
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              form_hospedagem_rsvp_ar1_pack_ajax_response();
              exit;
          }
          $this->nm_formatar_campos();
          $this->nmgp_opcao = $nm_sc_sv_opcao; 
          return; 
      }
      if ($this->nmgp_opcao == "incluir" || $this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "excluir") 
      {
          $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          $_SESSION['scriptcase']['form_hospedagem_rsvp_ar1']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
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
   }
  function html_export_print($nm_arquivo_html, $nmgp_password)
  {
      $Html_password = "";
          $Arq_base  = $this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_html;
          $Parm_pass = ($Html_password != "") ? " -p" : "";
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "form_hospedagem_rsvp_ar1.zip";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("Atualização de Hospedagem") ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
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
<form name="Fdown" method="get" action="form_hospedagem_rsvp_ar1_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="form_hospedagem_rsvp_ar1"> 
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
       } 
   }
//
//--------------------------------------------------------------------------------------
   function lookup_nome_evento_(&$conteudo)
   {
      global  $hosp_id_evento_;
      $guarda_formatado = $this->formatado;
      $this->nm_tira_formatacao();
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
      { 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      $nm_comando = "SELECT evento_nome 
FROM eventos_rsvp 
WHERE evento_id = '$this->hosp_id_evento_' 
ORDER BY evento_nome"; 
      if ($this->hosp_id_evento_ == "")
      { 
          $conteudo = ""; 
          $this->nm_formatar_campos();
          return; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      {
          $conteudo = (isset($rs->fields[0])) ? $rs->fields[0] : ""; 
          $rs->Close() ; 
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      {  
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit; 
      } 
      $GLOBALS["NM_ERRO_IBASE"] = 0; 
      foreach ($this->Before_unformat as $Cmp => $Val)
      {
          $this->$Cmp = $Val;
          $this->formatado = $guarda_formatado;
      }
   }
//
//--------------------------------------------------------------------------------------
   function lookup_nome_participante_(&$conteudo)
   {
      global  $hosp_cpf_participante_;
      $guarda_formatado = $this->formatado;
      $this->nm_tira_formatacao();
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
      { 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      $nm_comando = "SELECT pessoa_nome 
FROM pessoas_rsvp 
WHERE pessoa_cpf = '$this->hosp_cpf_participante_'
ORDER BY pessoa_nome"; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($rs = $this->Db->Execute($nm_comando)) 
      {
          $conteudo = (isset($rs->fields[0])) ? $rs->fields[0] : ""; 
          $rs->Close() ; 
      } 
      elseif ($GLOBALS["NM_ERRO_IBASE"] != 1)  
      {  
          $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit; 
      } 
      $GLOBALS["NM_ERRO_IBASE"] = 0; 
      foreach ($this->Before_unformat as $Cmp => $Val)
      {
          $this->$Cmp = $Val;
          $this->formatado = $guarda_formatado;
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
           case 'hosp_id_evento_':
               return "Cód. Evento";
               break;
           case 'nome_evento_':
               return "Evento";
               break;
           case 'hosp_cpf_participante_':
               return "Cód. Participante";
               break;
           case 'nome_participante_':
               return "Participante";
               break;
           case 'hosp_id_hotel_':
               return "Cód. Hotel";
               break;
           case 'nome_hotel_':
               return "Hotel";
               break;
           case 'hosp_acomodacao_':
               return "Cód.  Acomodação";
               break;
           case 'nome_acomodacao_':
               return "Acomodação";
               break;
           case 'hosp_categoria_':
               return "Cód. Categoria";
               break;
           case 'nome_categoria_':
               return "Categoria";
               break;
           case 'hosp_status_':
               return "Status";
               break;
           case 'conta_roomlist_':
               return "Conta Roomlist";
               break;
           case 'hospedagem_id_':
               return "Hospedagem Id";
               break;
           case 'hosp_id_participante_':
               return "Hosp Id Participante";
               break;
           case 'hosp_id_usuario_':
               return "Hosp Id Usuario";
               break;
           case 'hosp_pagamentos_':
               return "Hosp Pagamentos";
               break;
           case 'hosp_tipo_pessoa_':
               return "Hosp Tipo Pessoa";
               break;
           case 'hosp_acompanhante_':
               return "Hosp Acompanhante";
               break;
           case 'hosp_qtd_acompanhante_':
               return "Hosp Qtd Acompanhante";
               break;
           case 'hosp_dt_checkin_':
               return "Hosp Dt Checkin";
               break;
           case 'hosp_dt_checkout_':
               return "Hosp Dt Checkout";
               break;
           case 'hosp_hr_checkin_':
               return "Hosp Hr Checkin";
               break;
           case 'hosp_hr_checkout_':
               return "Hosp Hr Checkout";
               break;
           case 'hosp_early_chkin_':
               return "Hosp Early Chkin";
               break;
           case 'hosp_late_chkout_':
               return "Hosp Late Chkout";
               break;
           case 'hosp_diarias_':
               return "Hosp Diarias";
               break;
           case 'hosp_taxas_':
               return "Hosp Taxas";
               break;
           case 'hosp_total_':
               return "Hosp Total";
               break;
           case 'hosp_observacoes_':
               return "Hosp Observacoes";
               break;
           case 'hosp_dsc_pacote_':
               return "Hosp Dsc Pacote";
               break;
           case 'hosp_alteracao_':
               return "Hosp Alteracao";
               break;
           case 'hosp_ativo_':
               return "Hosp Ativo";
               break;
           case 'hosp_part_acomp_':
               return "Hosp Part Acomp";
               break;
           case 'hosp_reserva_bvt_':
               return "Hosp Reserva Bvt";
               break;
           case 'acmq_01_':
               return "Acmq 01";
               break;
           case 'acmq_02_':
               return "Acmq 02";
               break;
           case 'acmq_03_':
               return "Acmq 03";
               break;
           case 'acmq_04_':
               return "Acmq 04";
               break;
           case 'pamq_01_':
               return "Pamq 01";
               break;
           case 'pamq_02_':
               return "Pamq 02";
               break;
           case 'pamq_03_':
               return "Pamq 03";
               break;
           case 'pamq_04_':
               return "Pamq 04";
               break;
           case 'id_bloqueio_hotel_':
               return "Id Bloqueio Hotel";
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
     global $nm_browser, $teste_validade, $sc_seq_vert;
     if (is_array($filtro) && empty($filtro)) {
         $filtro = '';
     }
//---------------------------------------------------------
     $this->sc_force_zero = array();

     if (!is_array($filtro) && '' == $filtro && isset($this->nm_form_submit) && '1' == $this->nm_form_submit && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['csrf_token']) && $this->scCsrfGetToken() != $this->csrf_token)
     {
          $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
          $this->Campos_Mens_erro .= "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          if ($this->NM_ajax_flag)
          {
              if (!isset($this->NM_ajax_info['errList']['geral_form_hospedagem_rsvp_ar1']) || !is_array($this->NM_ajax_info['errList']['geral_form_hospedagem_rsvp_ar1']))
              {
                  $this->NM_ajax_info['errList']['geral_form_hospedagem_rsvp_ar1'] = array();
              }
              $this->NM_ajax_info['errList']['geral_form_hospedagem_rsvp_ar1'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ((!is_array($filtro) && ('' == $filtro || 'hosp_id_evento_' == $filtro)) || (is_array($filtro) && in_array('hosp_id_evento_', $filtro)))
        $this->ValidateField_hosp_id_evento_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'nome_evento_' == $filtro)) || (is_array($filtro) && in_array('nome_evento_', $filtro)))
        $this->ValidateField_nome_evento_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hosp_cpf_participante_' == $filtro)) || (is_array($filtro) && in_array('hosp_cpf_participante_', $filtro)))
        $this->ValidateField_hosp_cpf_participante_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'nome_participante_' == $filtro)) || (is_array($filtro) && in_array('nome_participante_', $filtro)))
        $this->ValidateField_nome_participante_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hosp_id_hotel_' == $filtro)) || (is_array($filtro) && in_array('hosp_id_hotel_', $filtro)))
        $this->ValidateField_hosp_id_hotel_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'nome_hotel_' == $filtro)) || (is_array($filtro) && in_array('nome_hotel_', $filtro)))
        $this->ValidateField_nome_hotel_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hosp_acomodacao_' == $filtro)) || (is_array($filtro) && in_array('hosp_acomodacao_', $filtro)))
        $this->ValidateField_hosp_acomodacao_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'nome_acomodacao_' == $filtro)) || (is_array($filtro) && in_array('nome_acomodacao_', $filtro)))
        $this->ValidateField_nome_acomodacao_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hosp_categoria_' == $filtro)) || (is_array($filtro) && in_array('hosp_categoria_', $filtro)))
        $this->ValidateField_hosp_categoria_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'nome_categoria_' == $filtro)) || (is_array($filtro) && in_array('nome_categoria_', $filtro)))
        $this->ValidateField_nome_categoria_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'hosp_status_' == $filtro)) || (is_array($filtro) && in_array('hosp_status_', $filtro)))
        $this->ValidateField_hosp_status_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'conta_roomlist_' == $filtro)) || (is_array($filtro) && in_array('conta_roomlist_', $filtro)))
        $this->ValidateField_conta_roomlist_($Campos_Crit, $Campos_Falta, $Campos_Erros);
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

    function ValidateField_hosp_id_evento_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hosp_id_evento_'])) {
          nm_limpa_numero($this->hosp_id_evento_, $this->field_config['hosp_id_evento_']['symbol_grp']) ; 
          return;
      }
      if ($this->hosp_id_evento_ === "" || is_null($this->hosp_id_evento_))  
      { 
          $this->hosp_id_evento_ = 0;
          $this->sc_force_zero[] = 'hosp_id_evento_';
      } 
      nm_limpa_numero($this->hosp_id_evento_, $this->field_config['hosp_id_evento_']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->hosp_id_evento_ != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->hosp_id_evento_) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Cód. Evento: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['hosp_id_evento_']))
                  {
                      $Campos_Erros['hosp_id_evento_'] = array();
                  }
                  $Campos_Erros['hosp_id_evento_'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['hosp_id_evento_']) || !is_array($this->NM_ajax_info['errList']['hosp_id_evento_']))
                  {
                      $this->NM_ajax_info['errList']['hosp_id_evento_'] = array();
                  }
                  $this->NM_ajax_info['errList']['hosp_id_evento_'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->hosp_id_evento_, 11, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Cód. Evento; " ; 
                  if (!isset($Campos_Erros['hosp_id_evento_']))
                  {
                      $Campos_Erros['hosp_id_evento_'] = array();
                  }
                  $Campos_Erros['hosp_id_evento_'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['hosp_id_evento_']) || !is_array($this->NM_ajax_info['errList']['hosp_id_evento_']))
                  {
                      $this->NM_ajax_info['errList']['hosp_id_evento_'] = array();
                  }
                  $this->NM_ajax_info['errList']['hosp_id_evento_'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hosp_id_evento_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hosp_id_evento_

    function ValidateField_nome_evento_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['nome_evento_'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->nome_evento_) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'nome_evento_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_nome_evento_

    function ValidateField_hosp_cpf_participante_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hosp_cpf_participante_'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->hosp_cpf_participante_) > 13) 
          { 
              $hasError = true;
              $Campos_Crit .= "Cód. Participante " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 13 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['hosp_cpf_participante_']))
              {
                  $Campos_Erros['hosp_cpf_participante_'] = array();
              }
              $Campos_Erros['hosp_cpf_participante_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 13 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['hosp_cpf_participante_']) || !is_array($this->NM_ajax_info['errList']['hosp_cpf_participante_']))
              {
                  $this->NM_ajax_info['errList']['hosp_cpf_participante_'] = array();
              }
              $this->NM_ajax_info['errList']['hosp_cpf_participante_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 13 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hosp_cpf_participante_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hosp_cpf_participante_

    function ValidateField_nome_participante_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['nome_participante_'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->nome_participante_) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'nome_participante_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_nome_participante_

    function ValidateField_hosp_id_hotel_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hosp_id_hotel_'])) {
          nm_limpa_numero($this->hosp_id_hotel_, $this->field_config['hosp_id_hotel_']['symbol_grp']) ; 
          return;
      }
      if ($this->hosp_id_hotel_ === "" || is_null($this->hosp_id_hotel_))  
      { 
          $this->hosp_id_hotel_ = 0;
          $this->sc_force_zero[] = 'hosp_id_hotel_';
      } 
      nm_limpa_numero($this->hosp_id_hotel_, $this->field_config['hosp_id_hotel_']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->hosp_id_hotel_ != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->hosp_id_hotel_) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Cód. Hotel: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['hosp_id_hotel_']))
                  {
                      $Campos_Erros['hosp_id_hotel_'] = array();
                  }
                  $Campos_Erros['hosp_id_hotel_'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['hosp_id_hotel_']) || !is_array($this->NM_ajax_info['errList']['hosp_id_hotel_']))
                  {
                      $this->NM_ajax_info['errList']['hosp_id_hotel_'] = array();
                  }
                  $this->NM_ajax_info['errList']['hosp_id_hotel_'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->hosp_id_hotel_, 11, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Cód. Hotel; " ; 
                  if (!isset($Campos_Erros['hosp_id_hotel_']))
                  {
                      $Campos_Erros['hosp_id_hotel_'] = array();
                  }
                  $Campos_Erros['hosp_id_hotel_'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['hosp_id_hotel_']) || !is_array($this->NM_ajax_info['errList']['hosp_id_hotel_']))
                  {
                      $this->NM_ajax_info['errList']['hosp_id_hotel_'] = array();
                  }
                  $this->NM_ajax_info['errList']['hosp_id_hotel_'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hosp_id_hotel_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hosp_id_hotel_

    function ValidateField_nome_hotel_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['nome_hotel_'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->nome_hotel_) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'nome_hotel_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_nome_hotel_

    function ValidateField_hosp_acomodacao_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hosp_acomodacao_'])) {
          nm_limpa_numero($this->hosp_acomodacao_, $this->field_config['hosp_acomodacao_']['symbol_grp']) ; 
          return;
      }
      if ($this->hosp_acomodacao_ === "" || is_null($this->hosp_acomodacao_))  
      { 
          $this->hosp_acomodacao_ = 0;
          $this->sc_force_zero[] = 'hosp_acomodacao_';
      } 
      nm_limpa_numero($this->hosp_acomodacao_, $this->field_config['hosp_acomodacao_']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->hosp_acomodacao_ != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->hosp_acomodacao_) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Cód.  Acomodação: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['hosp_acomodacao_']))
                  {
                      $Campos_Erros['hosp_acomodacao_'] = array();
                  }
                  $Campos_Erros['hosp_acomodacao_'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['hosp_acomodacao_']) || !is_array($this->NM_ajax_info['errList']['hosp_acomodacao_']))
                  {
                      $this->NM_ajax_info['errList']['hosp_acomodacao_'] = array();
                  }
                  $this->NM_ajax_info['errList']['hosp_acomodacao_'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->hosp_acomodacao_, 11, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Cód.  Acomodação; " ; 
                  if (!isset($Campos_Erros['hosp_acomodacao_']))
                  {
                      $Campos_Erros['hosp_acomodacao_'] = array();
                  }
                  $Campos_Erros['hosp_acomodacao_'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['hosp_acomodacao_']) || !is_array($this->NM_ajax_info['errList']['hosp_acomodacao_']))
                  {
                      $this->NM_ajax_info['errList']['hosp_acomodacao_'] = array();
                  }
                  $this->NM_ajax_info['errList']['hosp_acomodacao_'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hosp_acomodacao_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hosp_acomodacao_

    function ValidateField_nome_acomodacao_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['nome_acomodacao_'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->nome_acomodacao_) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'nome_acomodacao_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_nome_acomodacao_

    function ValidateField_hosp_categoria_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['hosp_categoria_'])) {
          nm_limpa_numero($this->hosp_categoria_, $this->field_config['hosp_categoria_']['symbol_grp']) ; 
          return;
      }
      if ($this->hosp_categoria_ === "" || is_null($this->hosp_categoria_))  
      { 
          $this->hosp_categoria_ = 0;
          $this->sc_force_zero[] = 'hosp_categoria_';
      } 
      nm_limpa_numero($this->hosp_categoria_, $this->field_config['hosp_categoria_']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->hosp_categoria_ != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->hosp_categoria_) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Cód. Categoria: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['hosp_categoria_']))
                  {
                      $Campos_Erros['hosp_categoria_'] = array();
                  }
                  $Campos_Erros['hosp_categoria_'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['hosp_categoria_']) || !is_array($this->NM_ajax_info['errList']['hosp_categoria_']))
                  {
                      $this->NM_ajax_info['errList']['hosp_categoria_'] = array();
                  }
                  $this->NM_ajax_info['errList']['hosp_categoria_'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->hosp_categoria_, 11, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Cód. Categoria; " ; 
                  if (!isset($Campos_Erros['hosp_categoria_']))
                  {
                      $Campos_Erros['hosp_categoria_'] = array();
                  }
                  $Campos_Erros['hosp_categoria_'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['hosp_categoria_']) || !is_array($this->NM_ajax_info['errList']['hosp_categoria_']))
                  {
                      $this->NM_ajax_info['errList']['hosp_categoria_'] = array();
                  }
                  $this->NM_ajax_info['errList']['hosp_categoria_'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hosp_categoria_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hosp_categoria_

    function ValidateField_nome_categoria_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['nome_categoria_'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->nome_categoria_) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'nome_categoria_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_nome_categoria_

    function ValidateField_hosp_status_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['hosp_status_'])) {
       return;
   }
      if ($this->hosp_status_ == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'hosp_status_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_hosp_status_

    function ValidateField_conta_roomlist_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['conta_roomlist_'])) {
       return;
   }
      if ($this->conta_roomlist_ == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'conta_roomlist_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_conta_roomlist_

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
    $this->nmgp_dados_form['hosp_id_evento_'] = $this->hosp_id_evento_;
    $this->nmgp_dados_form['nome_evento_'] = $this->nome_evento_;
    $this->nmgp_dados_form['hosp_cpf_participante_'] = $this->hosp_cpf_participante_;
    $this->nmgp_dados_form['nome_participante_'] = $this->nome_participante_;
    $this->nmgp_dados_form['hosp_id_hotel_'] = $this->hosp_id_hotel_;
    $this->nmgp_dados_form['nome_hotel_'] = $this->nome_hotel_;
    $this->nmgp_dados_form['hosp_acomodacao_'] = $this->hosp_acomodacao_;
    $this->nmgp_dados_form['nome_acomodacao_'] = $this->nome_acomodacao_;
    $this->nmgp_dados_form['hosp_categoria_'] = $this->hosp_categoria_;
    $this->nmgp_dados_form['nome_categoria_'] = $this->nome_categoria_;
    $this->nmgp_dados_form['hosp_status_'] = $this->hosp_status_;
    $this->nmgp_dados_form['conta_roomlist_'] = $this->conta_roomlist_;
    $this->nmgp_dados_form['hospedagem_id_'] = $this->hospedagem_id_;
    $this->nmgp_dados_form['hosp_id_participante_'] = $this->hosp_id_participante_;
    $this->nmgp_dados_form['hosp_id_usuario_'] = $this->hosp_id_usuario_;
    $this->nmgp_dados_form['hosp_pagamentos_'] = $this->hosp_pagamentos_;
    $this->nmgp_dados_form['hosp_tipo_pessoa_'] = $this->hosp_tipo_pessoa_;
    $this->nmgp_dados_form['hosp_acompanhante_'] = $this->hosp_acompanhante_;
    $this->nmgp_dados_form['hosp_qtd_acompanhante_'] = $this->hosp_qtd_acompanhante_;
    $this->nmgp_dados_form['hosp_dt_checkin_'] = $this->hosp_dt_checkin_;
    $this->nmgp_dados_form['hosp_dt_checkout_'] = $this->hosp_dt_checkout_;
    $this->nmgp_dados_form['hosp_hr_checkin_'] = $this->hosp_hr_checkin_;
    $this->nmgp_dados_form['hosp_hr_checkout_'] = $this->hosp_hr_checkout_;
    $this->nmgp_dados_form['hosp_early_chkin_'] = $this->hosp_early_chkin_;
    $this->nmgp_dados_form['hosp_late_chkout_'] = $this->hosp_late_chkout_;
    $this->nmgp_dados_form['hosp_diarias_'] = $this->hosp_diarias_;
    $this->nmgp_dados_form['hosp_taxas_'] = $this->hosp_taxas_;
    $this->nmgp_dados_form['hosp_total_'] = $this->hosp_total_;
    $this->nmgp_dados_form['hosp_observacoes_'] = $this->hosp_observacoes_;
    $this->nmgp_dados_form['hosp_dsc_pacote_'] = $this->hosp_dsc_pacote_;
    $this->nmgp_dados_form['hosp_alteracao_'] = $this->hosp_alteracao_;
    $this->nmgp_dados_form['hosp_ativo_'] = $this->hosp_ativo_;
    $this->nmgp_dados_form['hosp_part_acomp_'] = $this->hosp_part_acomp_;
    $this->nmgp_dados_form['hosp_reserva_bvt_'] = $this->hosp_reserva_bvt_;
    $this->nmgp_dados_form['acmq_01_'] = $this->acmq_01_;
    $this->nmgp_dados_form['acmq_02_'] = $this->acmq_02_;
    $this->nmgp_dados_form['acmq_03_'] = $this->acmq_03_;
    $this->nmgp_dados_form['acmq_04_'] = $this->acmq_04_;
    $this->nmgp_dados_form['pamq_01_'] = $this->pamq_01_;
    $this->nmgp_dados_form['pamq_02_'] = $this->pamq_02_;
    $this->nmgp_dados_form['pamq_03_'] = $this->pamq_03_;
    $this->nmgp_dados_form['pamq_04_'] = $this->pamq_04_;
    $this->nmgp_dados_form['id_bloqueio_hotel_'] = $this->id_bloqueio_hotel_;
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dados_form'][$sc_seq_vert] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
      $this->Before_unformat['hosp_id_evento_'] = $this->hosp_id_evento_;
      nm_limpa_numero($this->hosp_id_evento_, $this->field_config['hosp_id_evento_']['symbol_grp']) ; 
      $this->Before_unformat['hosp_id_hotel_'] = $this->hosp_id_hotel_;
      nm_limpa_numero($this->hosp_id_hotel_, $this->field_config['hosp_id_hotel_']['symbol_grp']) ; 
      $this->Before_unformat['hosp_acomodacao_'] = $this->hosp_acomodacao_;
      nm_limpa_numero($this->hosp_acomodacao_, $this->field_config['hosp_acomodacao_']['symbol_grp']) ; 
      $this->Before_unformat['hosp_categoria_'] = $this->hosp_categoria_;
      nm_limpa_numero($this->hosp_categoria_, $this->field_config['hosp_categoria_']['symbol_grp']) ; 
      $this->Before_unformat['hospedagem_id_'] = $this->hospedagem_id_;
      nm_limpa_numero($this->hospedagem_id_, $this->field_config['hospedagem_id_']['symbol_grp']) ; 
      $this->Before_unformat['hosp_id_participante_'] = $this->hosp_id_participante_;
      nm_limpa_numero($this->hosp_id_participante_, $this->field_config['hosp_id_participante_']['symbol_grp']) ; 
      $this->Before_unformat['hosp_id_usuario_'] = $this->hosp_id_usuario_;
      nm_limpa_numero($this->hosp_id_usuario_, $this->field_config['hosp_id_usuario_']['symbol_grp']) ; 
      $this->Before_unformat['hosp_pagamentos_'] = $this->hosp_pagamentos_;
      nm_limpa_numero($this->hosp_pagamentos_, $this->field_config['hosp_pagamentos_']['symbol_grp']) ; 
      $this->Before_unformat['hosp_dt_checkin_'] = $this->hosp_dt_checkin_;
      nm_limpa_data($this->hosp_dt_checkin_, $this->field_config['hosp_dt_checkin_']['date_sep']) ; 
      $this->Before_unformat['hosp_dt_checkout_'] = $this->hosp_dt_checkout_;
      nm_limpa_data($this->hosp_dt_checkout_, $this->field_config['hosp_dt_checkout_']['date_sep']) ; 
      $this->Before_unformat['hosp_hr_checkin_'] = $this->hosp_hr_checkin_;
      nm_limpa_hora($this->hosp_hr_checkin_, $this->field_config['hosp_hr_checkin_']['time_sep']) ; 
      $this->Before_unformat['hosp_hr_checkout_'] = $this->hosp_hr_checkout_;
      nm_limpa_hora($this->hosp_hr_checkout_, $this->field_config['hosp_hr_checkout_']['time_sep']) ; 
      $this->Before_unformat['hosp_diarias_'] = $this->hosp_diarias_;
      if (!empty($this->field_config['hosp_diarias_']['symbol_dec']))
      {
         $this->sc_remove_currency($this->hosp_diarias_, $this->field_config['hosp_diarias_']['symbol_dec'], $this->field_config['hosp_diarias_']['symbol_grp'], $this->field_config['hosp_diarias_']['symbol_mon']);
         nm_limpa_valor($this->hosp_diarias_, $this->field_config['hosp_diarias_']['symbol_dec'], $this->field_config['hosp_diarias_']['symbol_grp']);
      }
      $this->Before_unformat['hosp_taxas_'] = $this->hosp_taxas_;
      if (!empty($this->field_config['hosp_taxas_']['symbol_dec']))
      {
         $this->sc_remove_currency($this->hosp_taxas_, $this->field_config['hosp_taxas_']['symbol_dec'], $this->field_config['hosp_taxas_']['symbol_grp'], $this->field_config['hosp_taxas_']['symbol_mon']);
         nm_limpa_valor($this->hosp_taxas_, $this->field_config['hosp_taxas_']['symbol_dec'], $this->field_config['hosp_taxas_']['symbol_grp']);
      }
      $this->Before_unformat['hosp_total_'] = $this->hosp_total_;
      if (!empty($this->field_config['hosp_total_']['symbol_dec']))
      {
         $this->sc_remove_currency($this->hosp_total_, $this->field_config['hosp_total_']['symbol_dec'], $this->field_config['hosp_total_']['symbol_grp'], $this->field_config['hosp_total_']['symbol_mon']);
         nm_limpa_valor($this->hosp_total_, $this->field_config['hosp_total_']['symbol_dec'], $this->field_config['hosp_total_']['symbol_grp']);
      }
      $this->Before_unformat['hosp_alteracao_'] = $this->hosp_alteracao_;
      $this->Before_unformat['hosp_alteracao__hora'] = $this->hosp_alteracao__hora;
      nm_limpa_data($this->hosp_alteracao_, $this->field_config['hosp_alteracao_']['date_sep']) ; 
      nm_limpa_hora($this->hosp_alteracao__hora, $this->field_config['hosp_alteracao_']['time_sep']) ; 
      $this->Before_unformat['id_bloqueio_hotel_'] = $this->id_bloqueio_hotel_;
      nm_limpa_numero($this->id_bloqueio_hotel_, $this->field_config['id_bloqueio_hotel_']['symbol_grp']) ; 
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
      if ($Nome_Campo == "hosp_id_evento_")
      {
          nm_limpa_numero($this->hosp_id_evento_, $this->field_config['hosp_id_evento_']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "hosp_id_hotel_")
      {
          nm_limpa_numero($this->hosp_id_hotel_, $this->field_config['hosp_id_hotel_']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "hosp_acomodacao_")
      {
          nm_limpa_numero($this->hosp_acomodacao_, $this->field_config['hosp_acomodacao_']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "hosp_categoria_")
      {
          nm_limpa_numero($this->hosp_categoria_, $this->field_config['hosp_categoria_']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "hospedagem_id_")
      {
          nm_limpa_numero($this->hospedagem_id_, $this->field_config['hospedagem_id_']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "hosp_id_participante_")
      {
          nm_limpa_numero($this->hosp_id_participante_, $this->field_config['hosp_id_participante_']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "hosp_id_usuario_")
      {
          nm_limpa_numero($this->hosp_id_usuario_, $this->field_config['hosp_id_usuario_']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "hosp_pagamentos_")
      {
          nm_limpa_numero($this->hosp_pagamentos_, $this->field_config['hosp_pagamentos_']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "hosp_diarias_")
      {
          if (!empty($this->field_config['hosp_diarias_']['symbol_dec']))
          {
             $this->sc_remove_currency($this->hosp_diarias_, $this->field_config['hosp_diarias_']['symbol_dec'], $this->field_config['hosp_diarias_']['symbol_grp'], $this->field_config['hosp_diarias_']['symbol_mon']);
             nm_limpa_valor($this->hosp_diarias_, $this->field_config['hosp_diarias_']['symbol_dec'], $this->field_config['hosp_diarias_']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "hosp_taxas_")
      {
          if (!empty($this->field_config['hosp_taxas_']['symbol_dec']))
          {
             $this->sc_remove_currency($this->hosp_taxas_, $this->field_config['hosp_taxas_']['symbol_dec'], $this->field_config['hosp_taxas_']['symbol_grp'], $this->field_config['hosp_taxas_']['symbol_mon']);
             nm_limpa_valor($this->hosp_taxas_, $this->field_config['hosp_taxas_']['symbol_dec'], $this->field_config['hosp_taxas_']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "hosp_total_")
      {
          if (!empty($this->field_config['hosp_total_']['symbol_dec']))
          {
             $this->sc_remove_currency($this->hosp_total_, $this->field_config['hosp_total_']['symbol_dec'], $this->field_config['hosp_total_']['symbol_grp'], $this->field_config['hosp_total_']['symbol_mon']);
             nm_limpa_valor($this->hosp_total_, $this->field_config['hosp_total_']['symbol_dec'], $this->field_config['hosp_total_']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "id_bloqueio_hotel_")
      {
          nm_limpa_numero($this->id_bloqueio_hotel_, $this->field_config['id_bloqueio_hotel_']['symbol_grp']) ; 
      }
   }
   function nm_formatar_campos($format_fields = array())
   {
      global $nm_form_submit;
      if ('' !== $this->hosp_id_evento_ || (!empty($format_fields) && isset($format_fields['hosp_id_evento_'])))
      {
          nmgp_Form_Num_Val($this->hosp_id_evento_, $this->field_config['hosp_id_evento_']['symbol_grp'], $this->field_config['hosp_id_evento_']['symbol_dec'], "0", "S", $this->field_config['hosp_id_evento_']['format_neg'], "", "", "-", $this->field_config['hosp_id_evento_']['symbol_fmt']) ; 
      }
      if ('' !== $this->hosp_id_hotel_ || (!empty($format_fields) && isset($format_fields['hosp_id_hotel_'])))
      {
          nmgp_Form_Num_Val($this->hosp_id_hotel_, $this->field_config['hosp_id_hotel_']['symbol_grp'], $this->field_config['hosp_id_hotel_']['symbol_dec'], "0", "S", $this->field_config['hosp_id_hotel_']['format_neg'], "", "", "-", $this->field_config['hosp_id_hotel_']['symbol_fmt']) ; 
      }
      if ('' !== $this->hosp_acomodacao_ || (!empty($format_fields) && isset($format_fields['hosp_acomodacao_'])))
      {
          nmgp_Form_Num_Val($this->hosp_acomodacao_, $this->field_config['hosp_acomodacao_']['symbol_grp'], $this->field_config['hosp_acomodacao_']['symbol_dec'], "0", "S", $this->field_config['hosp_acomodacao_']['format_neg'], "", "", "-", $this->field_config['hosp_acomodacao_']['symbol_fmt']) ; 
      }
      if ('' !== $this->hosp_categoria_ || (!empty($format_fields) && isset($format_fields['hosp_categoria_'])))
      {
          nmgp_Form_Num_Val($this->hosp_categoria_, $this->field_config['hosp_categoria_']['symbol_grp'], $this->field_config['hosp_categoria_']['symbol_dec'], "0", "S", $this->field_config['hosp_categoria_']['format_neg'], "", "", "-", $this->field_config['hosp_categoria_']['symbol_fmt']) ; 
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
          $this->ajax_return_values_all_vert();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
              $this->NM_ajax_info['fldList']['hospedagem_id_']['keyVal'] = form_hospedagem_rsvp_ar1_pack_protect_string($this->nmgp_dados_form['hospedagem_id_']);
          }
   } // ajax_return_values
   function ajax_return_values_all_vert()
   {
          if (isset($this->nmgp_refresh_fields) && isset($this->nmgp_refresh_row) && '' != $this->nmgp_refresh_row)
          {
              $this->form_vert_form_hospedagem_rsvp_ar1[$this->nmgp_refresh_row] = $this->NM_ajax_info['param'];
              if ((isset($this->Embutida_ronly) && $this->Embutida_ronly) || $this->NM_ajax_force_values)
              {
                  if (isset($this->NM_ajax_changed['hosp_id_evento_']) && $this->NM_ajax_changed['hosp_id_evento_'])
                  {
                      $this->form_vert_form_hospedagem_rsvp_ar1[$this->nmgp_refresh_row]['hosp_id_evento_'] = $this->hosp_id_evento_;
                  }
                  if (isset($this->NM_ajax_changed['nome_evento_']) && $this->NM_ajax_changed['nome_evento_'])
                  {
                      $this->form_vert_form_hospedagem_rsvp_ar1[$this->nmgp_refresh_row]['nome_evento_'] = $this->nome_evento_;
                  }
                  if (isset($this->NM_ajax_changed['hosp_cpf_participante_']) && $this->NM_ajax_changed['hosp_cpf_participante_'])
                  {
                      $this->form_vert_form_hospedagem_rsvp_ar1[$this->nmgp_refresh_row]['hosp_cpf_participante_'] = $this->hosp_cpf_participante_;
                  }
                  if (isset($this->NM_ajax_changed['nome_participante_']) && $this->NM_ajax_changed['nome_participante_'])
                  {
                      $this->form_vert_form_hospedagem_rsvp_ar1[$this->nmgp_refresh_row]['nome_participante_'] = $this->nome_participante_;
                  }
                  if (isset($this->NM_ajax_changed['hosp_id_hotel_']) && $this->NM_ajax_changed['hosp_id_hotel_'])
                  {
                      $this->form_vert_form_hospedagem_rsvp_ar1[$this->nmgp_refresh_row]['hosp_id_hotel_'] = $this->hosp_id_hotel_;
                  }
                  if (isset($this->NM_ajax_changed['nome_hotel_']) && $this->NM_ajax_changed['nome_hotel_'])
                  {
                      $this->form_vert_form_hospedagem_rsvp_ar1[$this->nmgp_refresh_row]['nome_hotel_'] = $this->nome_hotel_;
                  }
                  if (isset($this->NM_ajax_changed['hosp_acomodacao_']) && $this->NM_ajax_changed['hosp_acomodacao_'])
                  {
                      $this->form_vert_form_hospedagem_rsvp_ar1[$this->nmgp_refresh_row]['hosp_acomodacao_'] = $this->hosp_acomodacao_;
                  }
                  if (isset($this->NM_ajax_changed['nome_acomodacao_']) && $this->NM_ajax_changed['nome_acomodacao_'])
                  {
                      $this->form_vert_form_hospedagem_rsvp_ar1[$this->nmgp_refresh_row]['nome_acomodacao_'] = $this->nome_acomodacao_;
                  }
                  if (isset($this->NM_ajax_changed['hosp_categoria_']) && $this->NM_ajax_changed['hosp_categoria_'])
                  {
                      $this->form_vert_form_hospedagem_rsvp_ar1[$this->nmgp_refresh_row]['hosp_categoria_'] = $this->hosp_categoria_;
                  }
                  if (isset($this->NM_ajax_changed['nome_categoria_']) && $this->NM_ajax_changed['nome_categoria_'])
                  {
                      $this->form_vert_form_hospedagem_rsvp_ar1[$this->nmgp_refresh_row]['nome_categoria_'] = $this->nome_categoria_;
                  }
                  if (isset($this->NM_ajax_changed['hosp_status_']) && $this->NM_ajax_changed['hosp_status_'])
                  {
                      $this->form_vert_form_hospedagem_rsvp_ar1[$this->nmgp_refresh_row]['hosp_status_'] = $this->hosp_status_;
                  }
                  if (isset($this->NM_ajax_changed['conta_roomlist_']) && $this->NM_ajax_changed['conta_roomlist_'])
                  {
                      $this->form_vert_form_hospedagem_rsvp_ar1[$this->nmgp_refresh_row]['conta_roomlist_'] = $this->conta_roomlist_;
                  }
              }
          }
          if (isset($this->nmgp_refresh_row) && '' != $this->nmgp_refresh_row)
          {
              $this->form_vert_form_hospedagem_rsvp_ar1[$this->nmgp_refresh_row]['nome_evento_'] = $this->nome_evento_;
              $this->form_vert_form_hospedagem_rsvp_ar1[$this->nmgp_refresh_row]['hosp_cpf_participante_'] = $this->hosp_cpf_participante_;
              $this->form_vert_form_hospedagem_rsvp_ar1[$this->nmgp_refresh_row]['nome_participante_'] = $this->nome_participante_;
              $this->form_vert_form_hospedagem_rsvp_ar1[$this->nmgp_refresh_row]['nome_hotel_'] = $this->nome_hotel_;
              $this->form_vert_form_hospedagem_rsvp_ar1[$this->nmgp_refresh_row]['nome_acomodacao_'] = $this->nome_acomodacao_;
              $this->form_vert_form_hospedagem_rsvp_ar1[$this->nmgp_refresh_row]['nome_categoria_'] = $this->nome_categoria_;
              $this->form_vert_form_hospedagem_rsvp_ar1[$this->nmgp_refresh_row]['conta_roomlist_'] = $this->conta_roomlist_;
          }
          $this->NM_ajax_info['rsSize']            = sizeof($this->form_vert_form_hospedagem_rsvp_ar1);
          $this->NM_ajax_info['buttonDisplayVert'] = array();
          foreach($this->form_vert_form_hospedagem_rsvp_ar1 as $sc_seq_vert => $aRecData)
          {
              $this->loadRecordState($sc_seq_vert);
              if ('navigate_form' == $this->NM_ajax_opcao) {
                  $this->NM_ajax_info['buttonDisplayVert'][] = array(
                      'seq'      => $sc_seq_vert,
                      'gridView' => false,
                      'delete'   => $this->nmgp_botoes['delete'],
                      'update'   => $this->nmgp_botoes['update'],
                  );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hosp_id_evento_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['hosp_id_evento_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['hosp_id_evento_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'label',
                       'valList' => array($sTmpValue),
                       );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("nome_evento_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['nome_evento_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['nome_evento_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'label',
                       'valList' => array($sTmpValue),
                       );
              $this->hosp_id_evento_ = $aRecData['hosp_id_evento_'];
              $orig_hosp_id_evento_ = $this->hosp_id_evento_;
              $hosp_id_evento_      = $this->hosp_id_evento_;
              nm_limpa_numero($hosp_id_evento_, $this->field_config['hosp_id_evento_']['symbol_grp']); 
              $this->hosp_id_evento_ = $hosp_id_evento_;
              $this->lookup_nome_evento_($conteudo);
              $this->hosp_id_evento_ = $orig_hosp_id_evento_;
              $this->NM_ajax_info['fldList']['nome_evento_' . $sc_seq_vert]['lookupCons'] = form_hospedagem_rsvp_ar1_pack_protect_string($conteudo);
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hosp_cpf_participante_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['hosp_cpf_participante_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['hosp_cpf_participante_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'label',
                       'valList' => array($sTmpValue),
                       );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("nome_participante_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['nome_participante_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['nome_participante_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'label',
                       'valList' => array($sTmpValue),
                       );
              $this->hosp_cpf_participante_ = $aRecData['hosp_cpf_participante_'];
              $orig_hosp_cpf_participante_ = $this->hosp_cpf_participante_;
              $hosp_cpf_participante_      = $this->hosp_cpf_participante_;
              $this->hosp_cpf_participante_ = $hosp_cpf_participante_;
              $this->lookup_nome_participante_($conteudo);
              $this->hosp_cpf_participante_ = $orig_hosp_cpf_participante_;
              $this->NM_ajax_info['fldList']['nome_participante_' . $sc_seq_vert]['lookupCons'] = form_hospedagem_rsvp_ar1_pack_protect_string($conteudo);
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hosp_id_hotel_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['hosp_id_hotel_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['hosp_id_hotel_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'text',
                       'valList' => array($sTmpValue),
                       );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("nome_hotel_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['nome_hotel_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['nome_hotel_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'label',
                       'valList' => array($sTmpValue),
                       );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hosp_acomodacao_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['hosp_acomodacao_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['hosp_acomodacao_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'text',
                       'valList' => array($sTmpValue),
                       );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("nome_acomodacao_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['nome_acomodacao_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['nome_acomodacao_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'label',
                       'valList' => array($sTmpValue),
                       );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hosp_categoria_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['hosp_categoria_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['hosp_categoria_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'text',
                       'valList' => array($sTmpValue),
                       );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("nome_categoria_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['nome_categoria_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['nome_categoria_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'label',
                       'valList' => array($sTmpValue),
                       );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("hosp_status_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['hosp_status_']);
                  $aLookup = array();
$aLookup[] = array(form_hospedagem_rsvp_ar1_pack_protect_string('A') => str_replace('<', '&lt;',form_hospedagem_rsvp_ar1_pack_protect_string("Aberto")));
$aLookup[] = array(form_hospedagem_rsvp_ar1_pack_protect_string('Y') => str_replace('<', '&lt;',form_hospedagem_rsvp_ar1_pack_protect_string("Sim")));
$aLookup[] = array(form_hospedagem_rsvp_ar1_pack_protect_string('N') => str_replace('<', '&lt;',form_hospedagem_rsvp_ar1_pack_protect_string("Não")));
$aLookup[] = array(form_hospedagem_rsvp_ar1_pack_protect_string('P') => str_replace('<', '&lt;',form_hospedagem_rsvp_ar1_pack_protect_string("Pendente")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['Lookup_hosp_status_'][] = 'A';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['Lookup_hosp_status_'][] = 'Y';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['Lookup_hosp_status_'][] = 'N';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['Lookup_hosp_status_'][] = 'P';
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"hosp_status_\"";
          if (isset($this->NM_ajax_info['select_html']['hosp_status_']) && !empty($this->NM_ajax_info['select_html']['hosp_status_']))
          {
              eval("\$sSelComp = \"" . str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['hosp_status_']) . "\";");
          }
          $sLookup = '';
          foreach ($aLookup as $aOption)
          {
              foreach ($aOption as $sValue => $sLabel)
              {
                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
                  $this->NM_ajax_info['fldList']['hosp_status_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'select',
                       'valList' => array($sTmpValue),
                       );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['hosp_status_' . $sc_seq_vert]['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['hosp_status_' . $sc_seq_vert]['valList'][$i] = form_hospedagem_rsvp_ar1_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['hosp_status_' . $sc_seq_vert]['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['hosp_status_' . $sc_seq_vert]['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['hosp_status_' . $sc_seq_vert]['labList'] = $aLabel;
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("conta_roomlist_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['conta_roomlist_']);
                  $aLookup = array();
$aLookup[] = array(form_hospedagem_rsvp_ar1_pack_protect_string('NAO') => str_replace('<', '&lt;',form_hospedagem_rsvp_ar1_pack_protect_string("Não")));
$aLookup[] = array(form_hospedagem_rsvp_ar1_pack_protect_string('SIM') => str_replace('<', '&lt;',form_hospedagem_rsvp_ar1_pack_protect_string("Sim")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['Lookup_conta_roomlist_'][] = 'NAO';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['Lookup_conta_roomlist_'][] = 'SIM';
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"conta_roomlist_\"";
          if (isset($this->NM_ajax_info['select_html']['conta_roomlist_']) && !empty($this->NM_ajax_info['select_html']['conta_roomlist_']))
          {
              eval("\$sSelComp = \"" . str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['conta_roomlist_']) . "\";");
          }
          $sLookup = '';
          foreach ($aLookup as $aOption)
          {
              foreach ($aOption as $sValue => $sLabel)
              {
                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
                  $this->NM_ajax_info['fldList']['conta_roomlist_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'select',
                       'valList' => array($sTmpValue),
                       );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['conta_roomlist_' . $sc_seq_vert]['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['conta_roomlist_' . $sc_seq_vert]['valList'][$i] = form_hospedagem_rsvp_ar1_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['conta_roomlist_' . $sc_seq_vert]['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['conta_roomlist_' . $sc_seq_vert]['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['conta_roomlist_' . $sc_seq_vert]['labList'] = $aLabel;
              }
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['upload_dir'][$fieldName][] = $newName;
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
  function nm_proc_onload_record($sc_seq_vert=0)
  {
          if (!$this->NM_ajax_flag || !isset($this->nmgp_refresh_fields)) {
          $_SESSION['scriptcase']['form_hospedagem_rsvp_ar1']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_hosp_acomodacao_ = $this->hosp_acomodacao_;
    $original_hosp_categoria_ = $this->hosp_categoria_;
    $original_hosp_id_hotel_ = $this->hosp_id_hotel_;
    $original_nome_acomodacao_ = $this->nome_acomodacao_;
    $original_nome_categoria_ = $this->nome_categoria_;
    $original_nome_hotel_ = $this->nome_hotel_;
}
  date_default_timezone_set('America/Sao_Paulo');
$sql = "
	SELECT
		hotel_id,
		hotel_fantasia
	FROM
		tbl_hoteis
	WHERE
		hotel_id = ".$this->Db->qstr($this->hosp_id_hotel_ )."
	ORDER BY
		hotel_id
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
	$this->nome_hotel_  = $this->rs[0][1];	
} else {
	$this->nome_hotel_  = '';
	$this->hosp_id_hotel_  = '0';
}	

$sql2 = "
	SELECT 
		acomodacao_desc 
	FROM 
		tbl_acomodacoes 
	WHERE 
		acomodacao_id = ".$this->Db->qstr($this->hosp_acomodacao_ )."  
	ORDER BY 
		acomodacao_desc
";		
 
      $nm_select = $sql2; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs2 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs2[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs2 = false;
          $this->rs2_erro = $this->Db->ErrorMsg();
      } 
	
if (isset($this->rs2[0][0])) {		
	$this->nome_acomodacao_  = $this->rs2[0][0];	
} else {
	$this->nome_acomodacao_  = '';
	$this->hosp_acomodacao_ = '0';
}	

$sql3 = "
	SELECT 
		acomod_dsc 
	FROM 
		tbl_categ_acomod 
	WHERE
		acomod_id = ".$this->Db->qstr($this->hosp_categoria_ )."   
	ORDER BY 
		acomod_dsc
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
	
if (isset($this->rs3[0][0])) {		
	$this->nome_categoria_  = $this->rs3[0][0];	
} else {
	$this->nome_categoria_  = '';
	$this->hosp_categoria_  = '0';
}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (($original_hosp_acomodacao_ != $this->hosp_acomodacao_ || (isset($bFlagRead_hosp_acomodacao_) && $bFlagRead_hosp_acomodacao_))&& isset($this->nmgp_refresh_row))
    {
        $this->NM_ajax_info['fldList']['hosp_acomodacao_' . $this->nmgp_refresh_row]['type']    = 'text';
        $this->NM_ajax_info['fldList']['hosp_acomodacao_' . $this->nmgp_refresh_row]['valList'] = array($this->hosp_acomodacao_);
        $this->NM_ajax_changed['hosp_acomodacao_'] = true;
    }
    if (($original_hosp_categoria_ != $this->hosp_categoria_ || (isset($bFlagRead_hosp_categoria_) && $bFlagRead_hosp_categoria_))&& isset($this->nmgp_refresh_row))
    {
        $this->NM_ajax_info['fldList']['hosp_categoria_' . $this->nmgp_refresh_row]['type']    = 'text';
        $this->NM_ajax_info['fldList']['hosp_categoria_' . $this->nmgp_refresh_row]['valList'] = array($this->hosp_categoria_);
        $this->NM_ajax_changed['hosp_categoria_'] = true;
    }
    if (($original_hosp_id_hotel_ != $this->hosp_id_hotel_ || (isset($bFlagRead_hosp_id_hotel_) && $bFlagRead_hosp_id_hotel_))&& isset($this->nmgp_refresh_row))
    {
        $this->NM_ajax_info['fldList']['hosp_id_hotel_' . $this->nmgp_refresh_row]['type']    = 'text';
        $this->NM_ajax_info['fldList']['hosp_id_hotel_' . $this->nmgp_refresh_row]['valList'] = array($this->hosp_id_hotel_);
        $this->NM_ajax_changed['hosp_id_hotel_'] = true;
    }
    if (($original_nome_acomodacao_ != $this->nome_acomodacao_ || (isset($bFlagRead_nome_acomodacao_) && $bFlagRead_nome_acomodacao_))&& isset($this->nmgp_refresh_row))
    {
        $this->NM_ajax_info['fldList']['nome_acomodacao_' . $this->nmgp_refresh_row]['type']    = 'label';
        $this->NM_ajax_info['fldList']['nome_acomodacao_' . $this->nmgp_refresh_row]['valList'] = array($this->nome_acomodacao_);
        $this->NM_ajax_changed['nome_acomodacao_'] = true;
    }
    if (($original_nome_categoria_ != $this->nome_categoria_ || (isset($bFlagRead_nome_categoria_) && $bFlagRead_nome_categoria_))&& isset($this->nmgp_refresh_row))
    {
        $this->NM_ajax_info['fldList']['nome_categoria_' . $this->nmgp_refresh_row]['type']    = 'label';
        $this->NM_ajax_info['fldList']['nome_categoria_' . $this->nmgp_refresh_row]['valList'] = array($this->nome_categoria_);
        $this->NM_ajax_changed['nome_categoria_'] = true;
    }
    if (($original_nome_hotel_ != $this->nome_hotel_ || (isset($bFlagRead_nome_hotel_) && $bFlagRead_nome_hotel_))&& isset($this->nmgp_refresh_row))
    {
        $this->NM_ajax_info['fldList']['nome_hotel_' . $this->nmgp_refresh_row]['type']    = 'label';
        $this->NM_ajax_info['fldList']['nome_hotel_' . $this->nmgp_refresh_row]['valList'] = array($this->nome_hotel_);
        $this->NM_ajax_changed['nome_hotel_'] = true;
    }
}
$_SESSION['scriptcase']['form_hospedagem_rsvp_ar1']['contr_erro'] = 'off'; 
          }
  }
  function nm_proc_onload($bFormat = true)
  {
      $Ctrl_Proc_Onload = true;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['Field_no_validate'] = array();
      if (!$this->NM_ajax_flag || !isset($this->nmgp_refresh_fields)) {
      $_SESSION['scriptcase']['form_hospedagem_rsvp_ar1']['contr_erro'] = 'on';
  date_default_timezone_set('America/Sao_Paulo');
$this->NM_ajax_info['buttonDisplay']['new'] = $this->nmgp_botoes["new"] = 'off';;
$_SESSION['scriptcase']['form_hospedagem_rsvp_ar1']['contr_erro'] = 'off'; 
      }
      if (empty($this->hosp_alteracao_))
      {
          $this->hosp_alteracao__hora = $this->hosp_alteracao_;
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
//
   function nm_troca_decimal($sc_parm1, $sc_parm2) 
   { 
      $this->hosp_diarias_ = str_replace($sc_parm1, $sc_parm2, $this->hosp_diarias_); 
      $this->hosp_taxas_ = str_replace($sc_parm1, $sc_parm2, $this->hosp_taxas_); 
      $this->hosp_total_ = str_replace($sc_parm1, $sc_parm2, $this->hosp_total_); 
   } 
   function nm_poe_aspas_decimal() 
   { 
      $this->hosp_diarias_ = "'" . $this->hosp_diarias_ . "'";
      $this->hosp_taxas_ = "'" . $this->hosp_taxas_ . "'";
      $this->hosp_total_ = "'" . $this->hosp_total_ . "'";
   } 
   function nm_tira_aspas_decimal() 
   { 
      $this->hosp_diarias_ = str_replace("'", "", $this->hosp_diarias_); 
      $this->hosp_taxas_ = str_replace("'", "", $this->hosp_taxas_); 
      $this->hosp_total_ = str_replace("'", "", $this->hosp_total_); 
   } 
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
      global $sc_seq_vert,  $nm_form_submit, $teste_validade, $sc_where;
 
      $this->NM_val_null = array();
      $NM_val_form = array();
      $this->sc_erro_insert = "";
      $this->sc_erro_update = "";
      $this->sc_erro_delete = "";
      $this->restore_zeros_null();
      if ($this->nmgp_opcao == "alterar")
      {
          $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dados_select'][$sc_seq_vert];
          if ($this->nmgp_dados_select['hosp_id_evento_'] == $this->hosp_id_evento_ &&
              $this->nmgp_dados_select['hosp_cpf_participante_'] == $this->hosp_cpf_participante_ &&
              $this->nmgp_dados_select['hosp_id_hotel_'] == $this->hosp_id_hotel_ &&
              $this->nmgp_dados_select['hosp_acomodacao_'] == $this->hosp_acomodacao_ &&
              $this->nmgp_dados_select['hosp_categoria_'] == $this->hosp_categoria_ &&
              $this->nmgp_dados_select['hosp_status_'] == $this->hosp_status_ &&
              $this->nmgp_dados_select['conta_roomlist_'] == $this->conta_roomlist_)
          { }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dados_select'][$sc_seq_vert]['hosp_id_evento_'] = $this->hosp_id_evento_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dados_select'][$sc_seq_vert]['hosp_cpf_participante_'] = $this->hosp_cpf_participante_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dados_select'][$sc_seq_vert]['hosp_id_hotel_'] = $this->hosp_id_hotel_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dados_select'][$sc_seq_vert]['hosp_acomodacao_'] = $this->hosp_acomodacao_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dados_select'][$sc_seq_vert]['hosp_categoria_'] = $this->hosp_categoria_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dados_select'][$sc_seq_vert]['hosp_status_'] = $this->hosp_status_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dados_select'][$sc_seq_vert]['conta_roomlist_'] = $this->conta_roomlist_;
          }
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
      $NM_val_form['hosp_id_evento_'] = $this->hosp_id_evento_;
      $NM_val_form['nome_evento_'] = $this->nome_evento_;
      $NM_val_form['hosp_cpf_participante_'] = $this->hosp_cpf_participante_;
      $NM_val_form['nome_participante_'] = $this->nome_participante_;
      $NM_val_form['hosp_id_hotel_'] = $this->hosp_id_hotel_;
      $NM_val_form['nome_hotel_'] = $this->nome_hotel_;
      $NM_val_form['hosp_acomodacao_'] = $this->hosp_acomodacao_;
      $NM_val_form['nome_acomodacao_'] = $this->nome_acomodacao_;
      $NM_val_form['hosp_categoria_'] = $this->hosp_categoria_;
      $NM_val_form['nome_categoria_'] = $this->nome_categoria_;
      $NM_val_form['hosp_status_'] = $this->hosp_status_;
      $NM_val_form['conta_roomlist_'] = $this->conta_roomlist_;
      $NM_val_form['hospedagem_id_'] = $this->hospedagem_id_;
      $NM_val_form['hosp_id_participante_'] = $this->hosp_id_participante_;
      $NM_val_form['hosp_id_usuario_'] = $this->hosp_id_usuario_;
      $NM_val_form['hosp_pagamentos_'] = $this->hosp_pagamentos_;
      $NM_val_form['hosp_tipo_pessoa_'] = $this->hosp_tipo_pessoa_;
      $NM_val_form['hosp_acompanhante_'] = $this->hosp_acompanhante_;
      $NM_val_form['hosp_qtd_acompanhante_'] = $this->hosp_qtd_acompanhante_;
      $NM_val_form['hosp_dt_checkin_'] = $this->hosp_dt_checkin_;
      $NM_val_form['hosp_dt_checkout_'] = $this->hosp_dt_checkout_;
      $NM_val_form['hosp_hr_checkin_'] = $this->hosp_hr_checkin_;
      $NM_val_form['hosp_hr_checkout_'] = $this->hosp_hr_checkout_;
      $NM_val_form['hosp_early_chkin_'] = $this->hosp_early_chkin_;
      $NM_val_form['hosp_late_chkout_'] = $this->hosp_late_chkout_;
      $NM_val_form['hosp_diarias_'] = $this->hosp_diarias_;
      $NM_val_form['hosp_taxas_'] = $this->hosp_taxas_;
      $NM_val_form['hosp_total_'] = $this->hosp_total_;
      $NM_val_form['hosp_observacoes_'] = $this->hosp_observacoes_;
      $NM_val_form['hosp_dsc_pacote_'] = $this->hosp_dsc_pacote_;
      $NM_val_form['hosp_alteracao_'] = $this->hosp_alteracao_;
      $NM_val_form['hosp_ativo_'] = $this->hosp_ativo_;
      $NM_val_form['hosp_part_acomp_'] = $this->hosp_part_acomp_;
      $NM_val_form['hosp_reserva_bvt_'] = $this->hosp_reserva_bvt_;
      $NM_val_form['acmq_01_'] = $this->acmq_01_;
      $NM_val_form['acmq_02_'] = $this->acmq_02_;
      $NM_val_form['acmq_03_'] = $this->acmq_03_;
      $NM_val_form['acmq_04_'] = $this->acmq_04_;
      $NM_val_form['pamq_01_'] = $this->pamq_01_;
      $NM_val_form['pamq_02_'] = $this->pamq_02_;
      $NM_val_form['pamq_03_'] = $this->pamq_03_;
      $NM_val_form['pamq_04_'] = $this->pamq_04_;
      $NM_val_form['id_bloqueio_hotel_'] = $this->id_bloqueio_hotel_;
      if ($this->hospedagem_id_ === "" || is_null($this->hospedagem_id_))  
      { 
          $this->hospedagem_id_ = 0;
      } 
      if ($this->hosp_id_evento_ === "" || is_null($this->hosp_id_evento_))  
      { 
          $this->hosp_id_evento_ = 0;
          $this->sc_force_zero[] = 'hosp_id_evento_';
      } 
      if ($this->hosp_id_participante_ === "" || is_null($this->hosp_id_participante_))  
      { 
          $this->hosp_id_participante_ = 0;
          $this->sc_force_zero[] = 'hosp_id_participante_';
      } 
      if ($this->hosp_id_usuario_ === "" || is_null($this->hosp_id_usuario_))  
      { 
          $this->hosp_id_usuario_ = 0;
          $this->sc_force_zero[] = 'hosp_id_usuario_';
      } 
      if ($this->hosp_id_hotel_ === "" || is_null($this->hosp_id_hotel_))  
      { 
          $this->hosp_id_hotel_ = 0;
          $this->sc_force_zero[] = 'hosp_id_hotel_';
      } 
      if ($this->hosp_acomodacao_ === "" || is_null($this->hosp_acomodacao_))  
      { 
          $this->hosp_acomodacao_ = 0;
          $this->sc_force_zero[] = 'hosp_acomodacao_';
      } 
      if ($this->hosp_categoria_ === "" || is_null($this->hosp_categoria_))  
      { 
          $this->hosp_categoria_ = 0;
          $this->sc_force_zero[] = 'hosp_categoria_';
      } 
      if ($this->hosp_pagamentos_ === "" || is_null($this->hosp_pagamentos_))  
      { 
          $this->hosp_pagamentos_ = 0;
          $this->sc_force_zero[] = 'hosp_pagamentos_';
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->hosp_diarias_ === "" || is_null($this->hosp_diarias_))  
      { 
          $this->hosp_diarias_ = 0;
          $this->sc_force_zero[] = 'hosp_diarias_';
      } 
      if ($this->hosp_taxas_ === "" || is_null($this->hosp_taxas_))  
      { 
          $this->hosp_taxas_ = 0;
          $this->sc_force_zero[] = 'hosp_taxas_';
      } 
      if ($this->hosp_total_ === "" || is_null($this->hosp_total_))  
      { 
          $this->hosp_total_ = 0;
          $this->sc_force_zero[] = 'hosp_total_';
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->id_bloqueio_hotel_ === "" || is_null($this->id_bloqueio_hotel_))  
      { 
          $this->id_bloqueio_hotel_ = 0;
          $this->sc_force_zero[] = 'id_bloqueio_hotel_';
      } 
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_oracle, $this->Ini->nm_bases_ibase, $this->Ini->nm_bases_informix, $this->Ini->nm_bases_mysql, $this->Ini->nm_bases_access, $this->Ini->nm_bases_sqlite, $this->Ini->nm_bases_db2, array('pdo_sqlsrv'));
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['decimal_db'] == ",") 
      {
          $this->nm_troca_decimal(".", ",");
      }
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          $this->hosp_cpf_participante__before_qstr = $this->hosp_cpf_participante_;
          $this->hosp_cpf_participante_ = substr($this->Db->qstr($this->hosp_cpf_participante_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hosp_cpf_participante_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hosp_cpf_participante_);
          }
          if ($this->hosp_cpf_participante_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hosp_cpf_participante_ = "null"; 
              $this->NM_val_null[] = "hosp_cpf_participante_";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->hosp_status_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->hosp_status_ = "null"; 
                  $this->NM_val_null[] = "hosp_status_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->hosp_tipo_pessoa_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->hosp_tipo_pessoa_ = "null"; 
                  $this->NM_val_null[] = "hosp_tipo_pessoa_";
              } 
          }
          $this->hosp_acompanhante__before_qstr = $this->hosp_acompanhante_;
          $this->hosp_acompanhante_ = substr($this->Db->qstr($this->hosp_acompanhante_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hosp_acompanhante_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hosp_acompanhante_);
          }
          if ($this->hosp_acompanhante_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hosp_acompanhante_ = "null"; 
              $this->NM_val_null[] = "hosp_acompanhante_";
          } 
          $this->hosp_qtd_acompanhante__before_qstr = $this->hosp_qtd_acompanhante_;
          $this->hosp_qtd_acompanhante_ = substr($this->Db->qstr($this->hosp_qtd_acompanhante_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hosp_qtd_acompanhante_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hosp_qtd_acompanhante_);
          }
          if ($this->hosp_qtd_acompanhante_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hosp_qtd_acompanhante_ = "null"; 
              $this->NM_val_null[] = "hosp_qtd_acompanhante_";
          } 
          if ($this->hosp_dt_checkin_ == "")  
          { 
              $this->hosp_dt_checkin_ = "null"; 
              $this->NM_val_null[] = "hosp_dt_checkin_";
          } 
          if ($this->hosp_dt_checkout_ == "")  
          { 
              $this->hosp_dt_checkout_ = "null"; 
              $this->NM_val_null[] = "hosp_dt_checkout_";
          } 
          if ($this->hosp_hr_checkin_ == "")  
          { 
              $this->hosp_hr_checkin_ = "null"; 
              $this->NM_val_null[] = "hosp_hr_checkin_";
          } 
          if ($this->hosp_hr_checkout_ == "")  
          { 
              $this->hosp_hr_checkout_ = "null"; 
              $this->NM_val_null[] = "hosp_hr_checkout_";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->hosp_early_chkin_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->hosp_early_chkin_ = "null"; 
                  $this->NM_val_null[] = "hosp_early_chkin_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->hosp_late_chkout_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->hosp_late_chkout_ = "null"; 
                  $this->NM_val_null[] = "hosp_late_chkout_";
              } 
          }
          $this->hosp_observacoes__before_qstr = $this->hosp_observacoes_;
          $this->hosp_observacoes_ = substr($this->Db->qstr($this->hosp_observacoes_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hosp_observacoes_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hosp_observacoes_);
          }
          if ($this->hosp_observacoes_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hosp_observacoes_ = "null"; 
              $this->NM_val_null[] = "hosp_observacoes_";
          } 
          $this->hosp_dsc_pacote__before_qstr = $this->hosp_dsc_pacote_;
          $this->hosp_dsc_pacote_ = substr($this->Db->qstr($this->hosp_dsc_pacote_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hosp_dsc_pacote_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hosp_dsc_pacote_);
          }
          if ($this->hosp_dsc_pacote_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hosp_dsc_pacote_ = "null"; 
              $this->NM_val_null[] = "hosp_dsc_pacote_";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->hosp_alteracao_ == "")  
              { 
                  $this->hosp_alteracao_ = "null"; 
                  $this->NM_val_null[] = "hosp_alteracao_";
              } 
              if ($this->hosp_alteracao_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->hosp_alteracao_ = "null"; 
                  $this->NM_val_null[] = "hosp_alteracao_";
              } 
          }
          if ($this->hosp_ativo_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hosp_ativo_ = "null"; 
              $this->NM_val_null[] = "hosp_ativo_";
          } 
          $this->hosp_part_acomp__before_qstr = $this->hosp_part_acomp_;
          $this->hosp_part_acomp_ = substr($this->Db->qstr($this->hosp_part_acomp_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->hosp_part_acomp_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->hosp_part_acomp_);
          }
          if ($this->hosp_part_acomp_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->hosp_part_acomp_ = "null"; 
              $this->NM_val_null[] = "hosp_part_acomp_";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->hosp_reserva_bvt_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->hosp_reserva_bvt_ = "null"; 
                  $this->NM_val_null[] = "hosp_reserva_bvt_";
              } 
          }
          $this->conta_roomlist__before_qstr = $this->conta_roomlist_;
          $this->conta_roomlist_ = substr($this->Db->qstr($this->conta_roomlist_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->conta_roomlist_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->conta_roomlist_);
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->conta_roomlist_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->conta_roomlist_ = "null"; 
                  $this->NM_val_null[] = "conta_roomlist_";
              } 
          }
          $this->acmq_01__before_qstr = $this->acmq_01_;
          $this->acmq_01_ = substr($this->Db->qstr($this->acmq_01_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->acmq_01_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->acmq_01_);
          }
          if ($this->acmq_01_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->acmq_01_ = "null"; 
              $this->NM_val_null[] = "acmq_01_";
          } 
          $this->acmq_02__before_qstr = $this->acmq_02_;
          $this->acmq_02_ = substr($this->Db->qstr($this->acmq_02_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->acmq_02_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->acmq_02_);
          }
          if ($this->acmq_02_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->acmq_02_ = "null"; 
              $this->NM_val_null[] = "acmq_02_";
          } 
          $this->acmq_03__before_qstr = $this->acmq_03_;
          $this->acmq_03_ = substr($this->Db->qstr($this->acmq_03_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->acmq_03_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->acmq_03_);
          }
          if ($this->acmq_03_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->acmq_03_ = "null"; 
              $this->NM_val_null[] = "acmq_03_";
          } 
          $this->acmq_04__before_qstr = $this->acmq_04_;
          $this->acmq_04_ = substr($this->Db->qstr($this->acmq_04_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->acmq_04_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->acmq_04_);
          }
          if ($this->acmq_04_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->acmq_04_ = "null"; 
              $this->NM_val_null[] = "acmq_04_";
          } 
          $this->pamq_01__before_qstr = $this->pamq_01_;
          $this->pamq_01_ = substr($this->Db->qstr($this->pamq_01_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->pamq_01_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->pamq_01_);
          }
          if ($this->pamq_01_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->pamq_01_ = "null"; 
              $this->NM_val_null[] = "pamq_01_";
          } 
          $this->pamq_02__before_qstr = $this->pamq_02_;
          $this->pamq_02_ = substr($this->Db->qstr($this->pamq_02_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->pamq_02_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->pamq_02_);
          }
          if ($this->pamq_02_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->pamq_02_ = "null"; 
              $this->NM_val_null[] = "pamq_02_";
          } 
          $this->pamq_03__before_qstr = $this->pamq_03_;
          $this->pamq_03_ = substr($this->Db->qstr($this->pamq_03_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->pamq_03_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->pamq_03_);
          }
          if ($this->pamq_03_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->pamq_03_ = "null"; 
              $this->NM_val_null[] = "pamq_03_";
          } 
          $this->pamq_04__before_qstr = $this->pamq_04_;
          $this->pamq_04_ = substr($this->Db->qstr($this->pamq_04_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->pamq_04_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->pamq_04_);
          }
          if ($this->pamq_04_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->pamq_04_ = "null"; 
              $this->NM_val_null[] = "pamq_04_";
          } 
      }
      if ($this->nmgp_opcao == "alterar") 
      {
          $SC_fields_update = array(); 
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_ ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_ "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_ ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_ "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_ ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_ "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_ ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_ "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_ ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_ "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 form_hospedagem_rsvp_ar1_pack_ajax_response();
              }
              exit; 
          }  
          $bUpdateOk = true;
          $tmp_result = (int) $rs1->fields[0]; 
          if ($tmp_result != 1) 
          { 
              $this->Campos_Mens_erro = $this->Ini->Nm_lang['lang_errm_nfnd']; 
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
                  $SC_fields_update[] = "hosp_id_evento = $this->hosp_id_evento_, hosp_cpf_participante = '$this->hosp_cpf_participante_', hosp_id_hotel = $this->hosp_id_hotel_, hosp_acomodacao = $this->hosp_acomodacao_, hosp_categoria = $this->hosp_categoria_, hosp_status = '$this->hosp_status_', conta_roomlist = '$this->conta_roomlist_'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "hosp_id_evento = $this->hosp_id_evento_, hosp_cpf_participante = '$this->hosp_cpf_participante_', hosp_id_hotel = $this->hosp_id_hotel_, hosp_acomodacao = $this->hosp_acomodacao_, hosp_categoria = $this->hosp_categoria_, hosp_status = '$this->hosp_status_', conta_roomlist = '$this->conta_roomlist_'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "hosp_id_evento = $this->hosp_id_evento_, hosp_cpf_participante = '$this->hosp_cpf_participante_', hosp_id_hotel = $this->hosp_id_hotel_, hosp_acomodacao = $this->hosp_acomodacao_, hosp_categoria = $this->hosp_categoria_, hosp_status = '$this->hosp_status_', conta_roomlist = '$this->conta_roomlist_'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "hosp_id_evento = $this->hosp_id_evento_, hosp_cpf_participante = '$this->hosp_cpf_participante_', hosp_id_hotel = $this->hosp_id_hotel_, hosp_acomodacao = $this->hosp_acomodacao_, hosp_categoria = $this->hosp_categoria_, hosp_status = '$this->hosp_status_', conta_roomlist = '$this->conta_roomlist_'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "hosp_id_evento = $this->hosp_id_evento_, hosp_cpf_participante = '$this->hosp_cpf_participante_', hosp_id_hotel = $this->hosp_id_hotel_, hosp_acomodacao = $this->hosp_acomodacao_, hosp_categoria = $this->hosp_categoria_, hosp_status = '$this->hosp_status_', conta_roomlist = '$this->conta_roomlist_'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "hosp_id_evento = $this->hosp_id_evento_, hosp_cpf_participante = '$this->hosp_cpf_participante_', hosp_id_hotel = $this->hosp_id_hotel_, hosp_acomodacao = $this->hosp_acomodacao_, hosp_categoria = $this->hosp_categoria_, hosp_status = '$this->hosp_status_', conta_roomlist = '$this->conta_roomlist_'"; 
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "hosp_id_evento = $this->hosp_id_evento_, hosp_cpf_participante = '$this->hosp_cpf_participante_', hosp_id_hotel = $this->hosp_id_hotel_, hosp_acomodacao = $this->hosp_acomodacao_, hosp_categoria = $this->hosp_categoria_, hosp_status = '$this->hosp_status_', conta_roomlist = '$this->conta_roomlist_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['hosp_id_participante_']) && $NM_val_form['hosp_id_participante_'] == "null"  && $this->nmgp_dados_select['hosp_id_participante_'] == "") ? "null" : $this->nmgp_dados_select['hosp_id_participante_'];
              if (isset($NM_val_form['hosp_id_participante_']) && $NM_val_form['hosp_id_participante_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "hosp_id_participante = $this->hosp_id_participante_"; 
              } 
              $Prep_Tst = (isset($NM_val_form['hosp_id_usuario_']) && $NM_val_form['hosp_id_usuario_'] == "null"  && $this->nmgp_dados_select['hosp_id_usuario_'] == "") ? "null" : $this->nmgp_dados_select['hosp_id_usuario_'];
              if (isset($NM_val_form['hosp_id_usuario_']) && $NM_val_form['hosp_id_usuario_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "hosp_id_usuario = $this->hosp_id_usuario_"; 
              } 
              $Prep_Tst = (isset($NM_val_form['hosp_pagamentos_']) && $NM_val_form['hosp_pagamentos_'] == "null"  && $this->nmgp_dados_select['hosp_pagamentos_'] == "") ? "null" : $this->nmgp_dados_select['hosp_pagamentos_'];
              if (isset($NM_val_form['hosp_pagamentos_']) && $NM_val_form['hosp_pagamentos_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "hosp_pagamentos = $this->hosp_pagamentos_"; 
              } 
              $Prep_Tst = (isset($NM_val_form['hosp_tipo_pessoa_']) && $NM_val_form['hosp_tipo_pessoa_'] == "null"  && $this->nmgp_dados_select['hosp_tipo_pessoa_'] == "") ? "null" : $this->nmgp_dados_select['hosp_tipo_pessoa_'];
              if (isset($NM_val_form['hosp_tipo_pessoa_']) && $NM_val_form['hosp_tipo_pessoa_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "hosp_tipo_pessoa = '$this->hosp_tipo_pessoa_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['hosp_acompanhante_']) && $NM_val_form['hosp_acompanhante_'] == "null"  && $this->nmgp_dados_select['hosp_acompanhante_'] == "") ? "null" : $this->nmgp_dados_select['hosp_acompanhante_'];
              if (isset($NM_val_form['hosp_acompanhante_']) && $NM_val_form['hosp_acompanhante_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "hosp_acompanhante = '$this->hosp_acompanhante_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['hosp_qtd_acompanhante_']) && $NM_val_form['hosp_qtd_acompanhante_'] == "null"  && $this->nmgp_dados_select['hosp_qtd_acompanhante_'] == "") ? "null" : $this->nmgp_dados_select['hosp_qtd_acompanhante_'];
              if (isset($NM_val_form['hosp_qtd_acompanhante_']) && $NM_val_form['hosp_qtd_acompanhante_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "hosp_qtd_acompanhante = '$this->hosp_qtd_acompanhante_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['hosp_dt_checkin_']) && $NM_val_form['hosp_dt_checkin_'] == "null"  && $this->nmgp_dados_select['hosp_dt_checkin_'] == "") ? "null" : $this->nmgp_dados_select['hosp_dt_checkin_'];
              if (isset($NM_val_form['hosp_dt_checkin_']) && $NM_val_form['hosp_dt_checkin_'] != $Prep_Tst) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "hosp_dt_checkin = #$this->hosp_dt_checkin_#"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  { 
                      $SC_fields_update[] = "hosp_dt_checkin = EXTEND('" . $this->hosp_dt_checkin_ . "', YEAR TO DAY)"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "hosp_dt_checkin = " . $this->Ini->date_delim . $this->hosp_dt_checkin_ . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['hosp_dt_checkout_']) && $NM_val_form['hosp_dt_checkout_'] == "null"  && $this->nmgp_dados_select['hosp_dt_checkout_'] == "") ? "null" : $this->nmgp_dados_select['hosp_dt_checkout_'];
              if (isset($NM_val_form['hosp_dt_checkout_']) && $NM_val_form['hosp_dt_checkout_'] != $Prep_Tst) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "hosp_dt_checkout = #$this->hosp_dt_checkout_#"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  { 
                      $SC_fields_update[] = "hosp_dt_checkout = EXTEND('" . $this->hosp_dt_checkout_ . "', YEAR TO DAY)"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "hosp_dt_checkout = " . $this->Ini->date_delim . $this->hosp_dt_checkout_ . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['hosp_hr_checkin_']) && $NM_val_form['hosp_hr_checkin_'] == "null"  && $this->nmgp_dados_select['hosp_hr_checkin_'] == "") ? "null" : $this->nmgp_dados_select['hosp_hr_checkin_'];
              if (isset($NM_val_form['hosp_hr_checkin_']) && $NM_val_form['hosp_hr_checkin_'] != $Prep_Tst) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "hosp_hr_checkin = #$this->hosp_hr_checkin_#"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "hosp_hr_checkin = " . $this->Ini->date_delim . $this->hosp_hr_checkin_ . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['hosp_hr_checkout_']) && $NM_val_form['hosp_hr_checkout_'] == "null"  && $this->nmgp_dados_select['hosp_hr_checkout_'] == "") ? "null" : $this->nmgp_dados_select['hosp_hr_checkout_'];
              if (isset($NM_val_form['hosp_hr_checkout_']) && $NM_val_form['hosp_hr_checkout_'] != $Prep_Tst) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "hosp_hr_checkout = #$this->hosp_hr_checkout_#"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "hosp_hr_checkout = " . $this->Ini->date_delim . $this->hosp_hr_checkout_ . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['hosp_early_chkin_']) && $NM_val_form['hosp_early_chkin_'] == "null"  && $this->nmgp_dados_select['hosp_early_chkin_'] == "") ? "null" : $this->nmgp_dados_select['hosp_early_chkin_'];
              if (isset($NM_val_form['hosp_early_chkin_']) && $NM_val_form['hosp_early_chkin_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "hosp_early_chkin = '$this->hosp_early_chkin_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['hosp_late_chkout_']) && $NM_val_form['hosp_late_chkout_'] == "null"  && $this->nmgp_dados_select['hosp_late_chkout_'] == "") ? "null" : $this->nmgp_dados_select['hosp_late_chkout_'];
              if (isset($NM_val_form['hosp_late_chkout_']) && $NM_val_form['hosp_late_chkout_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "hosp_late_chkout = '$this->hosp_late_chkout_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['hosp_diarias_']) && $NM_val_form['hosp_diarias_'] == "null"  && $this->nmgp_dados_select['hosp_diarias_'] == "") ? "null" : $this->nmgp_dados_select['hosp_diarias_'];
              if (isset($NM_val_form['hosp_diarias_']) && $NM_val_form['hosp_diarias_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "hosp_diarias = $this->hosp_diarias_"; 
              } 
              $Prep_Tst = (isset($NM_val_form['hosp_taxas_']) && $NM_val_form['hosp_taxas_'] == "null"  && $this->nmgp_dados_select['hosp_taxas_'] == "") ? "null" : $this->nmgp_dados_select['hosp_taxas_'];
              if (isset($NM_val_form['hosp_taxas_']) && $NM_val_form['hosp_taxas_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "hosp_taxas = $this->hosp_taxas_"; 
              } 
              $Prep_Tst = (isset($NM_val_form['hosp_total_']) && $NM_val_form['hosp_total_'] == "null"  && $this->nmgp_dados_select['hosp_total_'] == "") ? "null" : $this->nmgp_dados_select['hosp_total_'];
              if (isset($NM_val_form['hosp_total_']) && $NM_val_form['hosp_total_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "hosp_total = $this->hosp_total_"; 
              } 
              $Prep_Tst = (isset($NM_val_form['hosp_observacoes_']) && $NM_val_form['hosp_observacoes_'] == "null"  && $this->nmgp_dados_select['hosp_observacoes_'] == "") ? "null" : $this->nmgp_dados_select['hosp_observacoes_'];
              if (isset($NM_val_form['hosp_observacoes_']) && $NM_val_form['hosp_observacoes_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "hosp_observacoes = '$this->hosp_observacoes_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['hosp_dsc_pacote_']) && $NM_val_form['hosp_dsc_pacote_'] == "null"  && $this->nmgp_dados_select['hosp_dsc_pacote_'] == "") ? "null" : $this->nmgp_dados_select['hosp_dsc_pacote_'];
              if (isset($NM_val_form['hosp_dsc_pacote_']) && $NM_val_form['hosp_dsc_pacote_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "hosp_dsc_pacote = '$this->hosp_dsc_pacote_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['hosp_alteracao_']) && $NM_val_form['hosp_alteracao_'] == "null"  && $this->nmgp_dados_select['hosp_alteracao_'] == "") ? "null" : $this->nmgp_dados_select['hosp_alteracao_'];
              if (isset($NM_val_form['hosp_alteracao_']) && $NM_val_form['hosp_alteracao_'] != $Prep_Tst) 
              { 
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                  { 
                      $SC_fields_update[] = "hosp_alteracao = TO_DATE('$this->hosp_alteracao_', 'yyyy-mm-dd hh24:mi:ss')"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "hosp_alteracao = '$this->hosp_alteracao_'"; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['hosp_ativo_']) && $NM_val_form['hosp_ativo_'] == "null"  && $this->nmgp_dados_select['hosp_ativo_'] == "") ? "null" : $this->nmgp_dados_select['hosp_ativo_'];
              if (isset($NM_val_form['hosp_ativo_']) && $NM_val_form['hosp_ativo_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "hosp_ativo = '$this->hosp_ativo_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['hosp_part_acomp_']) && $NM_val_form['hosp_part_acomp_'] == "null"  && $this->nmgp_dados_select['hosp_part_acomp_'] == "") ? "null" : $this->nmgp_dados_select['hosp_part_acomp_'];
              if (isset($NM_val_form['hosp_part_acomp_']) && $NM_val_form['hosp_part_acomp_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "hosp_part_acomp = '$this->hosp_part_acomp_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['hosp_reserva_bvt_']) && $NM_val_form['hosp_reserva_bvt_'] == "null"  && $this->nmgp_dados_select['hosp_reserva_bvt_'] == "") ? "null" : $this->nmgp_dados_select['hosp_reserva_bvt_'];
              if (isset($NM_val_form['hosp_reserva_bvt_']) && $NM_val_form['hosp_reserva_bvt_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "hosp_reserva_bvt = '$this->hosp_reserva_bvt_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['acmq_01_']) && $NM_val_form['acmq_01_'] == "null"  && $this->nmgp_dados_select['acmq_01_'] == "") ? "null" : $this->nmgp_dados_select['acmq_01_'];
              if (isset($NM_val_form['acmq_01_']) && $NM_val_form['acmq_01_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "acmq_01 = '$this->acmq_01_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['acmq_02_']) && $NM_val_form['acmq_02_'] == "null"  && $this->nmgp_dados_select['acmq_02_'] == "") ? "null" : $this->nmgp_dados_select['acmq_02_'];
              if (isset($NM_val_form['acmq_02_']) && $NM_val_form['acmq_02_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "acmq_02 = '$this->acmq_02_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['acmq_03_']) && $NM_val_form['acmq_03_'] == "null"  && $this->nmgp_dados_select['acmq_03_'] == "") ? "null" : $this->nmgp_dados_select['acmq_03_'];
              if (isset($NM_val_form['acmq_03_']) && $NM_val_form['acmq_03_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "acmq_03 = '$this->acmq_03_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['acmq_04_']) && $NM_val_form['acmq_04_'] == "null"  && $this->nmgp_dados_select['acmq_04_'] == "") ? "null" : $this->nmgp_dados_select['acmq_04_'];
              if (isset($NM_val_form['acmq_04_']) && $NM_val_form['acmq_04_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "acmq_04 = '$this->acmq_04_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['pamq_01_']) && $NM_val_form['pamq_01_'] == "null"  && $this->nmgp_dados_select['pamq_01_'] == "") ? "null" : $this->nmgp_dados_select['pamq_01_'];
              if (isset($NM_val_form['pamq_01_']) && $NM_val_form['pamq_01_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "pamq_01 = '$this->pamq_01_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['pamq_02_']) && $NM_val_form['pamq_02_'] == "null"  && $this->nmgp_dados_select['pamq_02_'] == "") ? "null" : $this->nmgp_dados_select['pamq_02_'];
              if (isset($NM_val_form['pamq_02_']) && $NM_val_form['pamq_02_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "pamq_02 = '$this->pamq_02_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['pamq_03_']) && $NM_val_form['pamq_03_'] == "null"  && $this->nmgp_dados_select['pamq_03_'] == "") ? "null" : $this->nmgp_dados_select['pamq_03_'];
              if (isset($NM_val_form['pamq_03_']) && $NM_val_form['pamq_03_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "pamq_03 = '$this->pamq_03_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['pamq_04_']) && $NM_val_form['pamq_04_'] == "null"  && $this->nmgp_dados_select['pamq_04_'] == "") ? "null" : $this->nmgp_dados_select['pamq_04_'];
              if (isset($NM_val_form['pamq_04_']) && $NM_val_form['pamq_04_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "pamq_04 = '$this->pamq_04_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['id_bloqueio_hotel_']) && $NM_val_form['id_bloqueio_hotel_'] == "null"  && $this->nmgp_dados_select['id_bloqueio_hotel_'] == "") ? "null" : $this->nmgp_dados_select['id_bloqueio_hotel_'];
              if (isset($NM_val_form['id_bloqueio_hotel_']) && $NM_val_form['id_bloqueio_hotel_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "id_bloqueio_hotel = $this->id_bloqueio_hotel_"; 
              } 
              $comando .= implode(",", $SC_fields_update);  
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $comando .= " WHERE hospedagem_id = $this->hospedagem_id_ ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $comando .= " WHERE hospedagem_id = $this->hospedagem_id_ ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando .= " WHERE hospedagem_id = $this->hospedagem_id_ ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando .= " WHERE hospedagem_id = $this->hospedagem_id_ ";  
              }  
              else  
              {
                  $comando .= " WHERE hospedagem_id = $this->hospedagem_id_ ";  
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
                                  form_hospedagem_rsvp_ar1_pack_ajax_response();
                              }
                              exit;  
                          }   
                      }   
                  }   
              }   
              $this->hosp_cpf_participante_ = $this->hosp_cpf_participante__before_qstr;
              $this->hosp_acompanhante_ = $this->hosp_acompanhante__before_qstr;
              $this->hosp_qtd_acompanhante_ = $this->hosp_qtd_acompanhante__before_qstr;
              $this->hosp_observacoes_ = $this->hosp_observacoes__before_qstr;
              $this->hosp_dsc_pacote_ = $this->hosp_dsc_pacote__before_qstr;
              $this->hosp_part_acomp_ = $this->hosp_part_acomp__before_qstr;
              $this->conta_roomlist_ = $this->conta_roomlist__before_qstr;
              $this->acmq_01_ = $this->acmq_01__before_qstr;
              $this->acmq_02_ = $this->acmq_02__before_qstr;
              $this->acmq_03_ = $this->acmq_03__before_qstr;
              $this->acmq_04_ = $this->acmq_04__before_qstr;
              $this->pamq_01_ = $this->pamq_01__before_qstr;
              $this->pamq_02_ = $this->pamq_02__before_qstr;
              $this->pamq_03_ = $this->pamq_03__before_qstr;
              $this->pamq_04_ = $this->pamq_04__before_qstr;
              if (in_array(strtolower($this->Ini->nm_tpbanco), $nm_bases_lob_geral))
              { 
              }   
              $this->sc_evento = "update"; 
              $this->nmgp_opcao = "igual"; 
              $this->nm_flag_iframe = true;
              if ($this->lig_edit_lookup)
              {
                  $this->lig_edit_lookup_call = true;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['db_changed'] = true;
              if ($this->NM_ajax_flag) {
                  $this->NM_ajax_info['clearUpload'] = 'S';
              }

              $this->sc_teve_alt = true; 
              if     (isset($NM_val_form) && isset($NM_val_form['hosp_id_evento_'])) { $this->hosp_id_evento_ = $NM_val_form['hosp_id_evento_']; }
              elseif (isset($this->hosp_id_evento_)) { $this->nm_limpa_alfa($this->hosp_id_evento_); }
              if     (isset($NM_val_form) && isset($NM_val_form['hosp_cpf_participante_'])) { $this->hosp_cpf_participante_ = $NM_val_form['hosp_cpf_participante_']; }
              elseif (isset($this->hosp_cpf_participante_)) { $this->nm_limpa_alfa($this->hosp_cpf_participante_); }
              if     (isset($NM_val_form) && isset($NM_val_form['hosp_id_hotel_'])) { $this->hosp_id_hotel_ = $NM_val_form['hosp_id_hotel_']; }
              elseif (isset($this->hosp_id_hotel_)) { $this->nm_limpa_alfa($this->hosp_id_hotel_); }
              if     (isset($NM_val_form) && isset($NM_val_form['hosp_acomodacao_'])) { $this->hosp_acomodacao_ = $NM_val_form['hosp_acomodacao_']; }
              elseif (isset($this->hosp_acomodacao_)) { $this->nm_limpa_alfa($this->hosp_acomodacao_); }
              if     (isset($NM_val_form) && isset($NM_val_form['hosp_categoria_'])) { $this->hosp_categoria_ = $NM_val_form['hosp_categoria_']; }
              elseif (isset($this->hosp_categoria_)) { $this->nm_limpa_alfa($this->hosp_categoria_); }
              if     (isset($NM_val_form) && isset($NM_val_form['conta_roomlist_'])) { $this->conta_roomlist_ = $NM_val_form['conta_roomlist_']; }
              elseif (isset($this->conta_roomlist_)) { $this->nm_limpa_alfa($this->conta_roomlist_); }

              $this->nm_formatar_campos();
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
              }

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('hosp_id_evento_', 'nome_evento_', 'hosp_cpf_participante_', 'nome_participante_', 'hosp_id_hotel_', 'nome_hotel_', 'hosp_acomodacao_', 'nome_acomodacao_', 'hosp_categoria_', 'nome_categoria_', 'hosp_status_', 'conta_roomlist_'), $aDoNotUpdate);
              $this->nmgp_refresh_fields = $aOldRefresh;

              if (isset($this->Embutida_ronly) && $this->Embutida_ronly)
              {

                  $this->NM_ajax_info['readOnly']['hosp_id_evento_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['nome_evento_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['hosp_cpf_participante_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['nome_participante_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['hosp_id_hotel_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['nome_hotel_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['hosp_acomodacao_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['nome_acomodacao_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['hosp_categoria_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['nome_categoria_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['hosp_status_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['conta_roomlist_' . $this->nmgp_refresh_row] = 'on';


                  $this->NM_ajax_info['closeLine'] = $this->nmgp_refresh_row;
              }

              $this->nm_tira_formatacao();
          }  
      }  
      if ($this->nmgp_opcao == "incluir") 
      { 
          $NM_cmp_auto = "";
          $NM_seq_auto = "";
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          { 
              $NM_seq_auto = "NULL, ";
              $NM_cmp_auto = "hospedagem_id, ";
          } 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(hospedagem_id) from " . $this->Ini->nm_tabela; 
          $comando = "select max(hospedagem_id) from " . $this->Ini->nm_tabela; 
          $rs = $this->Db->Execute($comando); 
          if ($rs === false && !$rs->EOF)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
              $this->NM_rollback_db(); 
              if ($this->NM_ajax_flag)
              {
                  form_hospedagem_rsvp_ar1_pack_ajax_response();
              }
              exit; 
          }  
          $this->hospedagem_id__before_qstr = $this->hospedagem_id_ = $rs->fields[0] + 1;
          $rs->Close(); 
          $bInsertOk = true;
          $aInsertOk = array(); 
          $bInsertOk = $bInsertOk && empty($aInsertOk);
          if ($bInsertOk)
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->hosp_status_ != "")
                  { 
                       $compl_insert     .= ", hosp_status";
                       $compl_insert_val .= ", '$this->hosp_status_'";
                  } 
                  if ($this->hosp_tipo_pessoa_ != "")
                  { 
                       $compl_insert     .= ", hosp_tipo_pessoa";
                       $compl_insert_val .= ", '$this->hosp_tipo_pessoa_'";
                  } 
                  if ($this->hosp_early_chkin_ != "")
                  { 
                       $compl_insert     .= ", hosp_early_chkin";
                       $compl_insert_val .= ", '$this->hosp_early_chkin_'";
                  } 
                  if ($this->hosp_late_chkout_ != "")
                  { 
                       $compl_insert     .= ", hosp_late_chkout";
                       $compl_insert_val .= ", '$this->hosp_late_chkout_'";
                  } 
                  if ($this->hosp_alteracao_ != "")
                  { 
                       $compl_insert     .= ", hosp_alteracao";
                       $compl_insert_val .= ", '$this->hosp_alteracao_'";
                  } 
                  if ($this->hosp_reserva_bvt_ != "")
                  { 
                       $compl_insert     .= ", hosp_reserva_bvt";
                       $compl_insert_val .= ", '$this->hosp_reserva_bvt_'";
                  } 
                  if ($this->conta_roomlist_ != "")
                  { 
                       $compl_insert     .= ", conta_roomlist";
                       $compl_insert_val .= ", '$this->conta_roomlist_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (hosp_id_evento, hosp_id_participante, hosp_id_usuario, hosp_cpf_participante, hosp_id_hotel, hosp_acomodacao, hosp_categoria, hosp_pagamentos, hosp_acompanhante, hosp_qtd_acompanhante, hosp_dt_checkin, hosp_dt_checkout, hosp_hr_checkin, hosp_hr_checkout, hosp_diarias, hosp_taxas, hosp_total, hosp_observacoes, hosp_dsc_pacote, hosp_ativo, hosp_part_acomp, acmq_01, acmq_02, acmq_03, acmq_04, pamq_01, pamq_02, pamq_03, pamq_04, id_bloqueio_hotel $compl_insert) VALUES ($this->hosp_id_evento_, $this->hosp_id_participante_, $this->hosp_id_usuario_, '$this->hosp_cpf_participante_', $this->hosp_id_hotel_, $this->hosp_acomodacao_, $this->hosp_categoria_, $this->hosp_pagamentos_, '$this->hosp_acompanhante_', '$this->hosp_qtd_acompanhante_', #$this->hosp_dt_checkin_#, #$this->hosp_dt_checkout_#, #$this->hosp_hr_checkin_#, #$this->hosp_hr_checkout_#, $this->hosp_diarias_, $this->hosp_taxas_, $this->hosp_total_, '$this->hosp_observacoes_', '$this->hosp_dsc_pacote_', '$this->hosp_ativo_', '$this->hosp_part_acomp_', '$this->acmq_01_', '$this->acmq_02_', '$this->acmq_03_', '$this->acmq_04_', '$this->pamq_01_', '$this->pamq_02_', '$this->pamq_03_', '$this->pamq_04_', $this->id_bloqueio_hotel_ $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->hosp_status_ != "")
                  { 
                       $compl_insert     .= ", hosp_status";
                       $compl_insert_val .= ", '$this->hosp_status_'";
                  } 
                  if ($this->hosp_tipo_pessoa_ != "")
                  { 
                       $compl_insert     .= ", hosp_tipo_pessoa";
                       $compl_insert_val .= ", '$this->hosp_tipo_pessoa_'";
                  } 
                  if ($this->hosp_early_chkin_ != "")
                  { 
                       $compl_insert     .= ", hosp_early_chkin";
                       $compl_insert_val .= ", '$this->hosp_early_chkin_'";
                  } 
                  if ($this->hosp_late_chkout_ != "")
                  { 
                       $compl_insert     .= ", hosp_late_chkout";
                       $compl_insert_val .= ", '$this->hosp_late_chkout_'";
                  } 
                  if ($this->hosp_alteracao_ != "")
                  { 
                       $compl_insert     .= ", hosp_alteracao";
                       $compl_insert_val .= ", '$this->hosp_alteracao_'";
                  } 
                  if ($this->hosp_reserva_bvt_ != "")
                  { 
                       $compl_insert     .= ", hosp_reserva_bvt";
                       $compl_insert_val .= ", '$this->hosp_reserva_bvt_'";
                  } 
                  if ($this->conta_roomlist_ != "")
                  { 
                       $compl_insert     .= ", conta_roomlist";
                       $compl_insert_val .= ", '$this->conta_roomlist_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "hosp_id_evento, hosp_id_participante, hosp_id_usuario, hosp_cpf_participante, hosp_id_hotel, hosp_acomodacao, hosp_categoria, hosp_pagamentos, hosp_acompanhante, hosp_qtd_acompanhante, hosp_dt_checkin, hosp_dt_checkout, hosp_hr_checkin, hosp_hr_checkout, hosp_diarias, hosp_taxas, hosp_total, hosp_observacoes, hosp_dsc_pacote, hosp_ativo, hosp_part_acomp, acmq_01, acmq_02, acmq_03, acmq_04, pamq_01, pamq_02, pamq_03, pamq_04, id_bloqueio_hotel $compl_insert) VALUES (" . $NM_seq_auto . "$this->hosp_id_evento_, $this->hosp_id_participante_, $this->hosp_id_usuario_, '$this->hosp_cpf_participante_', $this->hosp_id_hotel_, $this->hosp_acomodacao_, $this->hosp_categoria_, $this->hosp_pagamentos_, '$this->hosp_acompanhante_', '$this->hosp_qtd_acompanhante_', " . $this->Ini->date_delim . $this->hosp_dt_checkin_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->hosp_dt_checkout_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->hosp_hr_checkin_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->hosp_hr_checkout_ . $this->Ini->date_delim1 . ", $this->hosp_diarias_, $this->hosp_taxas_, $this->hosp_total_, '$this->hosp_observacoes_', '$this->hosp_dsc_pacote_', '$this->hosp_ativo_', '$this->hosp_part_acomp_', '$this->acmq_01_', '$this->acmq_02_', '$this->acmq_03_', '$this->acmq_04_', '$this->pamq_01_', '$this->pamq_02_', '$this->pamq_03_', '$this->pamq_04_', $this->id_bloqueio_hotel_ $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
              { 
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->hosp_status_ != "")
                  { 
                       $compl_insert     .= ", hosp_status";
                       $compl_insert_val .= ", '$this->hosp_status_'";
                  } 
                  if ($this->hosp_tipo_pessoa_ != "")
                  { 
                       $compl_insert     .= ", hosp_tipo_pessoa";
                       $compl_insert_val .= ", '$this->hosp_tipo_pessoa_'";
                  } 
                  if ($this->hosp_early_chkin_ != "")
                  { 
                       $compl_insert     .= ", hosp_early_chkin";
                       $compl_insert_val .= ", '$this->hosp_early_chkin_'";
                  } 
                  if ($this->hosp_late_chkout_ != "")
                  { 
                       $compl_insert     .= ", hosp_late_chkout";
                       $compl_insert_val .= ", '$this->hosp_late_chkout_'";
                  } 
                  if ($this->hosp_alteracao_ != "")
                  { 
                       $compl_insert     .= ", hosp_alteracao";
                       $compl_insert_val .= ", '$this->hosp_alteracao_'";
                  } 
                  if ($this->hosp_reserva_bvt_ != "")
                  { 
                       $compl_insert     .= ", hosp_reserva_bvt";
                       $compl_insert_val .= ", '$this->hosp_reserva_bvt_'";
                  } 
                  if ($this->conta_roomlist_ != "")
                  { 
                       $compl_insert     .= ", conta_roomlist";
                       $compl_insert_val .= ", '$this->conta_roomlist_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "hosp_id_evento, hosp_id_participante, hosp_id_usuario, hosp_cpf_participante, hosp_id_hotel, hosp_acomodacao, hosp_categoria, hosp_pagamentos, hosp_acompanhante, hosp_qtd_acompanhante, hosp_dt_checkin, hosp_dt_checkout, hosp_hr_checkin, hosp_hr_checkout, hosp_diarias, hosp_taxas, hosp_total, hosp_observacoes, hosp_dsc_pacote, hosp_ativo, hosp_part_acomp, acmq_01, acmq_02, acmq_03, acmq_04, pamq_01, pamq_02, pamq_03, pamq_04, id_bloqueio_hotel $compl_insert) VALUES (" . $NM_seq_auto . "$this->hosp_id_evento_, $this->hosp_id_participante_, $this->hosp_id_usuario_, '$this->hosp_cpf_participante_', $this->hosp_id_hotel_, $this->hosp_acomodacao_, $this->hosp_categoria_, $this->hosp_pagamentos_, '$this->hosp_acompanhante_', '$this->hosp_qtd_acompanhante_', " . $this->Ini->date_delim . $this->hosp_dt_checkin_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->hosp_dt_checkout_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->hosp_hr_checkin_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->hosp_hr_checkout_ . $this->Ini->date_delim1 . ", $this->hosp_diarias_, $this->hosp_taxas_, $this->hosp_total_, '$this->hosp_observacoes_', '$this->hosp_dsc_pacote_', '$this->hosp_ativo_', '$this->hosp_part_acomp_', '$this->acmq_01_', '$this->acmq_02_', '$this->acmq_03_', '$this->acmq_04_', '$this->pamq_01_', '$this->pamq_02_', '$this->pamq_03_', '$this->pamq_04_', $this->id_bloqueio_hotel_ $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->hosp_status_ != "")
                  { 
                       $compl_insert     .= ", hosp_status";
                       $compl_insert_val .= ", '$this->hosp_status_'";
                  } 
                  if ($this->hosp_tipo_pessoa_ != "")
                  { 
                       $compl_insert     .= ", hosp_tipo_pessoa";
                       $compl_insert_val .= ", '$this->hosp_tipo_pessoa_'";
                  } 
                  if ($this->hosp_early_chkin_ != "")
                  { 
                       $compl_insert     .= ", hosp_early_chkin";
                       $compl_insert_val .= ", '$this->hosp_early_chkin_'";
                  } 
                  if ($this->hosp_late_chkout_ != "")
                  { 
                       $compl_insert     .= ", hosp_late_chkout";
                       $compl_insert_val .= ", '$this->hosp_late_chkout_'";
                  } 
                  if ($this->hosp_alteracao_ != "")
                  { 
                       $compl_insert     .= ", hosp_alteracao";
                       $compl_insert_val .= ", TO_DATE('$this->hosp_alteracao_', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->hosp_reserva_bvt_ != "")
                  { 
                       $compl_insert     .= ", hosp_reserva_bvt";
                       $compl_insert_val .= ", '$this->hosp_reserva_bvt_'";
                  } 
                  if ($this->conta_roomlist_ != "")
                  { 
                       $compl_insert     .= ", conta_roomlist";
                       $compl_insert_val .= ", '$this->conta_roomlist_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "hosp_id_evento, hosp_id_participante, hosp_id_usuario, hosp_cpf_participante, hosp_id_hotel, hosp_acomodacao, hosp_categoria, hosp_pagamentos, hosp_acompanhante, hosp_qtd_acompanhante, hosp_dt_checkin, hosp_dt_checkout, hosp_hr_checkin, hosp_hr_checkout, hosp_diarias, hosp_taxas, hosp_total, hosp_observacoes, hosp_dsc_pacote, hosp_ativo, hosp_part_acomp, acmq_01, acmq_02, acmq_03, acmq_04, pamq_01, pamq_02, pamq_03, pamq_04, id_bloqueio_hotel $compl_insert) VALUES (" . $NM_seq_auto . "$this->hosp_id_evento_, $this->hosp_id_participante_, $this->hosp_id_usuario_, '$this->hosp_cpf_participante_', $this->hosp_id_hotel_, $this->hosp_acomodacao_, $this->hosp_categoria_, $this->hosp_pagamentos_, '$this->hosp_acompanhante_', '$this->hosp_qtd_acompanhante_', " . $this->Ini->date_delim . $this->hosp_dt_checkin_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->hosp_dt_checkout_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->hosp_hr_checkin_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->hosp_hr_checkout_ . $this->Ini->date_delim1 . ", $this->hosp_diarias_, $this->hosp_taxas_, $this->hosp_total_, '$this->hosp_observacoes_', '$this->hosp_dsc_pacote_', '$this->hosp_ativo_', '$this->hosp_part_acomp_', '$this->acmq_01_', '$this->acmq_02_', '$this->acmq_03_', '$this->acmq_04_', '$this->pamq_01_', '$this->pamq_02_', '$this->pamq_03_', '$this->pamq_04_', $this->id_bloqueio_hotel_ $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->hosp_status_ != "")
                  { 
                       $compl_insert     .= ", hosp_status";
                       $compl_insert_val .= ", '$this->hosp_status_'";
                  } 
                  if ($this->hosp_tipo_pessoa_ != "")
                  { 
                       $compl_insert     .= ", hosp_tipo_pessoa";
                       $compl_insert_val .= ", '$this->hosp_tipo_pessoa_'";
                  } 
                  if ($this->hosp_early_chkin_ != "")
                  { 
                       $compl_insert     .= ", hosp_early_chkin";
                       $compl_insert_val .= ", '$this->hosp_early_chkin_'";
                  } 
                  if ($this->hosp_late_chkout_ != "")
                  { 
                       $compl_insert     .= ", hosp_late_chkout";
                       $compl_insert_val .= ", '$this->hosp_late_chkout_'";
                  } 
                  if ($this->hosp_alteracao_ != "")
                  { 
                       $compl_insert     .= ", hosp_alteracao";
                       $compl_insert_val .= ", '$this->hosp_alteracao_'";
                  } 
                  if ($this->hosp_reserva_bvt_ != "")
                  { 
                       $compl_insert     .= ", hosp_reserva_bvt";
                       $compl_insert_val .= ", '$this->hosp_reserva_bvt_'";
                  } 
                  if ($this->conta_roomlist_ != "")
                  { 
                       $compl_insert     .= ", conta_roomlist";
                       $compl_insert_val .= ", '$this->conta_roomlist_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "hosp_id_evento, hosp_id_participante, hosp_id_usuario, hosp_cpf_participante, hosp_id_hotel, hosp_acomodacao, hosp_categoria, hosp_pagamentos, hosp_acompanhante, hosp_qtd_acompanhante, hosp_dt_checkin, hosp_dt_checkout, hosp_hr_checkin, hosp_hr_checkout, hosp_diarias, hosp_taxas, hosp_total, hosp_observacoes, hosp_dsc_pacote, hosp_ativo, hosp_part_acomp, acmq_01, acmq_02, acmq_03, acmq_04, pamq_01, pamq_02, pamq_03, pamq_04, id_bloqueio_hotel $compl_insert) VALUES (" . $NM_seq_auto . "$this->hosp_id_evento_, $this->hosp_id_participante_, $this->hosp_id_usuario_, '$this->hosp_cpf_participante_', $this->hosp_id_hotel_, $this->hosp_acomodacao_, $this->hosp_categoria_, $this->hosp_pagamentos_, '$this->hosp_acompanhante_', '$this->hosp_qtd_acompanhante_', EXTEND('$this->hosp_dt_checkin_', YEAR TO DAY), EXTEND('$this->hosp_dt_checkout_', YEAR TO DAY), " . $this->Ini->date_delim . $this->hosp_hr_checkin_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->hosp_hr_checkout_ . $this->Ini->date_delim1 . ", $this->hosp_diarias_, $this->hosp_taxas_, $this->hosp_total_, '$this->hosp_observacoes_', '$this->hosp_dsc_pacote_', '$this->hosp_ativo_', '$this->hosp_part_acomp_', '$this->acmq_01_', '$this->acmq_02_', '$this->acmq_03_', '$this->acmq_04_', '$this->pamq_01_', '$this->pamq_02_', '$this->pamq_03_', '$this->pamq_04_', $this->id_bloqueio_hotel_ $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->hosp_status_ != "")
                  { 
                       $compl_insert     .= ", hosp_status";
                       $compl_insert_val .= ", '$this->hosp_status_'";
                  } 
                  if ($this->hosp_tipo_pessoa_ != "")
                  { 
                       $compl_insert     .= ", hosp_tipo_pessoa";
                       $compl_insert_val .= ", '$this->hosp_tipo_pessoa_'";
                  } 
                  if ($this->hosp_early_chkin_ != "")
                  { 
                       $compl_insert     .= ", hosp_early_chkin";
                       $compl_insert_val .= ", '$this->hosp_early_chkin_'";
                  } 
                  if ($this->hosp_late_chkout_ != "")
                  { 
                       $compl_insert     .= ", hosp_late_chkout";
                       $compl_insert_val .= ", '$this->hosp_late_chkout_'";
                  } 
                  if ($this->hosp_alteracao_ != "")
                  { 
                       $compl_insert     .= ", hosp_alteracao";
                       $compl_insert_val .= ", '$this->hosp_alteracao_'";
                  } 
                  if ($this->hosp_reserva_bvt_ != "")
                  { 
                       $compl_insert     .= ", hosp_reserva_bvt";
                       $compl_insert_val .= ", '$this->hosp_reserva_bvt_'";
                  } 
                  if ($this->conta_roomlist_ != "")
                  { 
                       $compl_insert     .= ", conta_roomlist";
                       $compl_insert_val .= ", '$this->conta_roomlist_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "hosp_id_evento, hosp_id_participante, hosp_id_usuario, hosp_cpf_participante, hosp_id_hotel, hosp_acomodacao, hosp_categoria, hosp_pagamentos, hosp_acompanhante, hosp_qtd_acompanhante, hosp_dt_checkin, hosp_dt_checkout, hosp_hr_checkin, hosp_hr_checkout, hosp_diarias, hosp_taxas, hosp_total, hosp_observacoes, hosp_dsc_pacote, hosp_ativo, hosp_part_acomp, acmq_01, acmq_02, acmq_03, acmq_04, pamq_01, pamq_02, pamq_03, pamq_04, id_bloqueio_hotel $compl_insert) VALUES (" . $NM_seq_auto . "$this->hosp_id_evento_, $this->hosp_id_participante_, $this->hosp_id_usuario_, '$this->hosp_cpf_participante_', $this->hosp_id_hotel_, $this->hosp_acomodacao_, $this->hosp_categoria_, $this->hosp_pagamentos_, '$this->hosp_acompanhante_', '$this->hosp_qtd_acompanhante_', " . $this->Ini->date_delim . $this->hosp_dt_checkin_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->hosp_dt_checkout_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->hosp_hr_checkin_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->hosp_hr_checkout_ . $this->Ini->date_delim1 . ", $this->hosp_diarias_, $this->hosp_taxas_, $this->hosp_total_, '$this->hosp_observacoes_', '$this->hosp_dsc_pacote_', '$this->hosp_ativo_', '$this->hosp_part_acomp_', '$this->acmq_01_', '$this->acmq_02_', '$this->acmq_03_', '$this->acmq_04_', '$this->pamq_01_', '$this->pamq_02_', '$this->pamq_03_', '$this->pamq_04_', $this->id_bloqueio_hotel_ $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->hosp_status_ != "")
                  { 
                       $compl_insert     .= ", hosp_status";
                       $compl_insert_val .= ", '$this->hosp_status_'";
                  } 
                  if ($this->hosp_tipo_pessoa_ != "")
                  { 
                       $compl_insert     .= ", hosp_tipo_pessoa";
                       $compl_insert_val .= ", '$this->hosp_tipo_pessoa_'";
                  } 
                  if ($this->hosp_early_chkin_ != "")
                  { 
                       $compl_insert     .= ", hosp_early_chkin";
                       $compl_insert_val .= ", '$this->hosp_early_chkin_'";
                  } 
                  if ($this->hosp_late_chkout_ != "")
                  { 
                       $compl_insert     .= ", hosp_late_chkout";
                       $compl_insert_val .= ", '$this->hosp_late_chkout_'";
                  } 
                  if ($this->hosp_alteracao_ != "")
                  { 
                       $compl_insert     .= ", hosp_alteracao";
                       $compl_insert_val .= ", '$this->hosp_alteracao_'";
                  } 
                  if ($this->hosp_reserva_bvt_ != "")
                  { 
                       $compl_insert     .= ", hosp_reserva_bvt";
                       $compl_insert_val .= ", '$this->hosp_reserva_bvt_'";
                  } 
                  if ($this->conta_roomlist_ != "")
                  { 
                       $compl_insert     .= ", conta_roomlist";
                       $compl_insert_val .= ", '$this->conta_roomlist_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "hosp_id_evento, hosp_id_participante, hosp_id_usuario, hosp_cpf_participante, hosp_id_hotel, hosp_acomodacao, hosp_categoria, hosp_pagamentos, hosp_acompanhante, hosp_qtd_acompanhante, hosp_dt_checkin, hosp_dt_checkout, hosp_hr_checkin, hosp_hr_checkout, hosp_diarias, hosp_taxas, hosp_total, hosp_observacoes, hosp_dsc_pacote, hosp_ativo, hosp_part_acomp, acmq_01, acmq_02, acmq_03, acmq_04, pamq_01, pamq_02, pamq_03, pamq_04, id_bloqueio_hotel $compl_insert) VALUES (" . $NM_seq_auto . "$this->hosp_id_evento_, $this->hosp_id_participante_, $this->hosp_id_usuario_, '$this->hosp_cpf_participante_', $this->hosp_id_hotel_, $this->hosp_acomodacao_, $this->hosp_categoria_, $this->hosp_pagamentos_, '$this->hosp_acompanhante_', '$this->hosp_qtd_acompanhante_', " . $this->Ini->date_delim . $this->hosp_dt_checkin_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->hosp_dt_checkout_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->hosp_hr_checkin_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->hosp_hr_checkout_ . $this->Ini->date_delim1 . ", $this->hosp_diarias_, $this->hosp_taxas_, $this->hosp_total_, '$this->hosp_observacoes_', '$this->hosp_dsc_pacote_', '$this->hosp_ativo_', '$this->hosp_part_acomp_', '$this->acmq_01_', '$this->acmq_02_', '$this->acmq_03_', '$this->acmq_04_', '$this->pamq_01_', '$this->pamq_02_', '$this->pamq_03_', '$this->pamq_04_', $this->id_bloqueio_hotel_ $compl_insert_val)"; 
              }
              elseif ($this->Ini->nm_tpbanco == 'pdo_ibm')
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->hosp_status_ != "")
                  { 
                       $compl_insert     .= ", hosp_status";
                       $compl_insert_val .= ", '$this->hosp_status_'";
                  } 
                  if ($this->hosp_tipo_pessoa_ != "")
                  { 
                       $compl_insert     .= ", hosp_tipo_pessoa";
                       $compl_insert_val .= ", '$this->hosp_tipo_pessoa_'";
                  } 
                  if ($this->hosp_early_chkin_ != "")
                  { 
                       $compl_insert     .= ", hosp_early_chkin";
                       $compl_insert_val .= ", '$this->hosp_early_chkin_'";
                  } 
                  if ($this->hosp_late_chkout_ != "")
                  { 
                       $compl_insert     .= ", hosp_late_chkout";
                       $compl_insert_val .= ", '$this->hosp_late_chkout_'";
                  } 
                  if ($this->hosp_alteracao_ != "")
                  { 
                       $compl_insert     .= ", hosp_alteracao";
                       $compl_insert_val .= ", TO_DATE('$this->hosp_alteracao_', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->hosp_reserva_bvt_ != "")
                  { 
                       $compl_insert     .= ", hosp_reserva_bvt";
                       $compl_insert_val .= ", '$this->hosp_reserva_bvt_'";
                  } 
                  if ($this->conta_roomlist_ != "")
                  { 
                       $compl_insert     .= ", conta_roomlist";
                       $compl_insert_val .= ", '$this->conta_roomlist_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "hosp_id_evento, hosp_id_participante, hosp_id_usuario, hosp_cpf_participante, hosp_id_hotel, hosp_acomodacao, hosp_categoria, hosp_pagamentos, hosp_acompanhante, hosp_qtd_acompanhante, hosp_dt_checkin, hosp_dt_checkout, hosp_hr_checkin, hosp_hr_checkout, hosp_diarias, hosp_taxas, hosp_total, hosp_observacoes, hosp_dsc_pacote, hosp_ativo, hosp_part_acomp, acmq_01, acmq_02, acmq_03, acmq_04, pamq_01, pamq_02, pamq_03, pamq_04, id_bloqueio_hotel $compl_insert) VALUES (" . $NM_seq_auto . "$this->hosp_id_evento_, $this->hosp_id_participante_, $this->hosp_id_usuario_, '$this->hosp_cpf_participante_', $this->hosp_id_hotel_, $this->hosp_acomodacao_, $this->hosp_categoria_, $this->hosp_pagamentos_, '$this->hosp_acompanhante_', '$this->hosp_qtd_acompanhante_', " . $this->Ini->date_delim . $this->hosp_dt_checkin_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->hosp_dt_checkout_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->hosp_hr_checkin_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->hosp_hr_checkout_ . $this->Ini->date_delim1 . ", $this->hosp_diarias_, $this->hosp_taxas_, $this->hosp_total_, '$this->hosp_observacoes_', '$this->hosp_dsc_pacote_', '$this->hosp_ativo_', '$this->hosp_part_acomp_', '$this->acmq_01_', '$this->acmq_02_', '$this->acmq_03_', '$this->acmq_04_', '$this->pamq_01_', '$this->pamq_02_', '$this->pamq_03_', '$this->pamq_04_', $this->id_bloqueio_hotel_ $compl_insert_val)"; 
              }
              else
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->hosp_status_ != "")
                  { 
                       $compl_insert     .= ", hosp_status";
                       $compl_insert_val .= ", '$this->hosp_status_'";
                  } 
                  if ($this->hosp_tipo_pessoa_ != "")
                  { 
                       $compl_insert     .= ", hosp_tipo_pessoa";
                       $compl_insert_val .= ", '$this->hosp_tipo_pessoa_'";
                  } 
                  if ($this->hosp_early_chkin_ != "")
                  { 
                       $compl_insert     .= ", hosp_early_chkin";
                       $compl_insert_val .= ", '$this->hosp_early_chkin_'";
                  } 
                  if ($this->hosp_late_chkout_ != "")
                  { 
                       $compl_insert     .= ", hosp_late_chkout";
                       $compl_insert_val .= ", '$this->hosp_late_chkout_'";
                  } 
                  if ($this->hosp_alteracao_ != "")
                  { 
                       $compl_insert     .= ", hosp_alteracao";
                       $compl_insert_val .= ", '$this->hosp_alteracao_'";
                  } 
                  if ($this->hosp_reserva_bvt_ != "")
                  { 
                       $compl_insert     .= ", hosp_reserva_bvt";
                       $compl_insert_val .= ", '$this->hosp_reserva_bvt_'";
                  } 
                  if ($this->conta_roomlist_ != "")
                  { 
                       $compl_insert     .= ", conta_roomlist";
                       $compl_insert_val .= ", '$this->conta_roomlist_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "hosp_id_evento, hosp_id_participante, hosp_id_usuario, hosp_cpf_participante, hosp_id_hotel, hosp_acomodacao, hosp_categoria, hosp_pagamentos, hosp_acompanhante, hosp_qtd_acompanhante, hosp_dt_checkin, hosp_dt_checkout, hosp_hr_checkin, hosp_hr_checkout, hosp_diarias, hosp_taxas, hosp_total, hosp_observacoes, hosp_dsc_pacote, hosp_ativo, hosp_part_acomp, acmq_01, acmq_02, acmq_03, acmq_04, pamq_01, pamq_02, pamq_03, pamq_04, id_bloqueio_hotel $compl_insert) VALUES (" . $NM_seq_auto . "$this->hosp_id_evento_, $this->hosp_id_participante_, $this->hosp_id_usuario_, '$this->hosp_cpf_participante_', $this->hosp_id_hotel_, $this->hosp_acomodacao_, $this->hosp_categoria_, $this->hosp_pagamentos_, '$this->hosp_acompanhante_', '$this->hosp_qtd_acompanhante_', " . $this->Ini->date_delim . $this->hosp_dt_checkin_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->hosp_dt_checkout_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->hosp_hr_checkin_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->hosp_hr_checkout_ . $this->Ini->date_delim1 . ", $this->hosp_diarias_, $this->hosp_taxas_, $this->hosp_total_, '$this->hosp_observacoes_', '$this->hosp_dsc_pacote_', '$this->hosp_ativo_', '$this->hosp_part_acomp_', '$this->acmq_01_', '$this->acmq_02_', '$this->acmq_03_', '$this->acmq_04_', '$this->pamq_01_', '$this->pamq_02_', '$this->pamq_03_', '$this->pamq_04_', $this->id_bloqueio_hotel_ $compl_insert_val)"; 
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
                              form_hospedagem_rsvp_ar1_pack_ajax_response();
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
                          form_hospedagem_rsvp_ar1_pack_ajax_response();
                      }
                      exit; 
                  } 
                  $this->hospedagem_id_ =  $rsy->fields[0];
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
                  $this->hospedagem_id_ = $rsy->fields[0];
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
                  $this->hospedagem_id_ = $rsy->fields[0];
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
                  $this->hospedagem_id_ = $rsy->fields[0];
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
                  $this->hospedagem_id_ = $rsy->fields[0];
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
                  $this->hospedagem_id_ = $rsy->fields[0];
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
                  $this->hospedagem_id_ = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              $this->hosp_cpf_participante_ = $this->hosp_cpf_participante__before_qstr;
              $this->hosp_acompanhante_ = $this->hosp_acompanhante__before_qstr;
              $this->hosp_qtd_acompanhante_ = $this->hosp_qtd_acompanhante__before_qstr;
              $this->hosp_observacoes_ = $this->hosp_observacoes__before_qstr;
              $this->hosp_dsc_pacote_ = $this->hosp_dsc_pacote__before_qstr;
              $this->hosp_part_acomp_ = $this->hosp_part_acomp__before_qstr;
              $this->conta_roomlist_ = $this->conta_roomlist__before_qstr;
              $this->acmq_01_ = $this->acmq_01__before_qstr;
              $this->acmq_02_ = $this->acmq_02__before_qstr;
              $this->acmq_03_ = $this->acmq_03__before_qstr;
              $this->acmq_04_ = $this->acmq_04__before_qstr;
              $this->pamq_01_ = $this->pamq_01__before_qstr;
              $this->pamq_02_ = $this->pamq_02__before_qstr;
              $this->pamq_03_ = $this->pamq_03__before_qstr;
              $this->pamq_04_ = $this->pamq_04__before_qstr;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['db_changed'] = true;

              $this->sc_evento = "insert"; 
              $this->hosp_cpf_participante_ = $this->hosp_cpf_participante__before_qstr;
              $this->hosp_acompanhante_ = $this->hosp_acompanhante__before_qstr;
              $this->hosp_qtd_acompanhante_ = $this->hosp_qtd_acompanhante__before_qstr;
              $this->hosp_observacoes_ = $this->hosp_observacoes__before_qstr;
              $this->hosp_dsc_pacote_ = $this->hosp_dsc_pacote__before_qstr;
              $this->hosp_part_acomp_ = $this->hosp_part_acomp__before_qstr;
              $this->conta_roomlist_ = $this->conta_roomlist__before_qstr;
              $this->acmq_01_ = $this->acmq_01__before_qstr;
              $this->acmq_02_ = $this->acmq_02__before_qstr;
              $this->acmq_03_ = $this->acmq_03__before_qstr;
              $this->acmq_04_ = $this->acmq_04__before_qstr;
              $this->pamq_01_ = $this->pamq_01__before_qstr;
              $this->pamq_02_ = $this->pamq_02__before_qstr;
              $this->pamq_03_ = $this->pamq_03__before_qstr;
              $this->pamq_04_ = $this->pamq_04__before_qstr;
              $this->sc_teve_incl = true; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dados_select'][$sc_seq_vert]['hosp_id_evento_'] = $this->hosp_id_evento_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dados_select'][$sc_seq_vert]['hosp_cpf_participante_'] = $this->hosp_cpf_participante_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dados_select'][$sc_seq_vert]['hosp_id_hotel_'] = $this->hosp_id_hotel_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dados_select'][$sc_seq_vert]['hosp_acomodacao_'] = $this->hosp_acomodacao_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dados_select'][$sc_seq_vert]['hosp_categoria_'] = $this->hosp_categoria_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dados_select'][$sc_seq_vert]['hosp_status_'] = $this->hosp_status_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dados_select'][$sc_seq_vert]['conta_roomlist_'] = $this->conta_roomlist_;
              $this->restore_zeros_null();
              if (isset($this->hosp_id_evento_)) { $this->nm_limpa_alfa($this->hosp_id_evento_); }
              if (isset($this->hosp_cpf_participante_)) { $this->nm_limpa_alfa($this->hosp_cpf_participante_); }
              if (isset($this->hosp_id_hotel_)) { $this->nm_limpa_alfa($this->hosp_id_hotel_); }
              if (isset($this->hosp_acomodacao_)) { $this->nm_limpa_alfa($this->hosp_acomodacao_); }
              if (isset($this->hosp_categoria_)) { $this->nm_limpa_alfa($this->hosp_categoria_); }
              if (isset($this->conta_roomlist_)) { $this->nm_limpa_alfa($this->conta_roomlist_); }
              if (isset($this->Embutida_form) && $this->Embutida_form)
              {
                  $this->nm_guardar_campos();
                  $this->nm_formatar_campos();

                  $tmpLabel_hosp_id_evento_ = $this->hosp_id_evento_;
                  $this->NM_ajax_info['fldList']['hosp_id_evento_' . $this->nmgp_refresh_row]['type']    = 'label';
                  $this->NM_ajax_info['fldList']['hosp_id_evento_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->hosp_id_evento_)));
                  $this->NM_ajax_info['fldList']['hosp_id_evento_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_hosp_id_evento_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['hosp_id_evento_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['hosp_id_evento_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['hosp_id_evento_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['hosp_id_evento_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $orig_hosp_id_evento_ = $this->hosp_id_evento_;
                  $hosp_id_evento_      = $this->hosp_id_evento_;
              nm_limpa_numero($hosp_id_evento_, $this->field_config['hosp_id_evento_']['symbol_grp']); 
                  $this->hosp_id_evento_ = $hosp_id_evento_;
                  $this->lookup_nome_evento_($conteudo);
                  $this->hosp_id_evento_ = $orig_hosp_id_evento_;
                  $this->NM_ajax_info['fldList']['nome_evento_' . $this->nmgp_refresh_row]['lookupCons'] = form_hospedagem_rsvp_ar1_pack_protect_string($conteudo);
                  $tmpLabel_nome_evento_ = $this->nome_evento_;
                  $this->NM_ajax_info['fldList']['nome_evento_' . $this->nmgp_refresh_row]['type']    = 'label';
                  $this->NM_ajax_info['fldList']['nome_evento_' . $this->nmgp_refresh_row]['valList'] = array($this->nome_evento_);
                  $this->NM_ajax_info['fldList']['nome_evento_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_nome_evento_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['nome_evento_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['nome_evento_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['nome_evento_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['nome_evento_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $tmpLabel_hosp_cpf_participante_ = $this->hosp_cpf_participante_;
                  $this->NM_ajax_info['fldList']['hosp_cpf_participante_' . $this->nmgp_refresh_row]['type']    = 'label';
                  $this->NM_ajax_info['fldList']['hosp_cpf_participante_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->hosp_cpf_participante_)));
                  $this->NM_ajax_info['fldList']['hosp_cpf_participante_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_hosp_cpf_participante_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['hosp_cpf_participante_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['hosp_cpf_participante_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['hosp_cpf_participante_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['hosp_cpf_participante_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $orig_hosp_cpf_participante_ = $this->hosp_cpf_participante_;
                  $hosp_cpf_participante_      = $this->hosp_cpf_participante_;
                  $this->hosp_cpf_participante_ = $hosp_cpf_participante_;
                  $this->lookup_nome_participante_($conteudo);
                  $this->hosp_cpf_participante_ = $orig_hosp_cpf_participante_;
                  $this->NM_ajax_info['fldList']['nome_participante_' . $this->nmgp_refresh_row]['lookupCons'] = form_hospedagem_rsvp_ar1_pack_protect_string($conteudo);
                  $tmpLabel_nome_participante_ = $this->nome_participante_;
                  $this->NM_ajax_info['fldList']['nome_participante_' . $this->nmgp_refresh_row]['type']    = 'label';
                  $this->NM_ajax_info['fldList']['nome_participante_' . $this->nmgp_refresh_row]['valList'] = array($this->nome_participante_);
                  $this->NM_ajax_info['fldList']['nome_participante_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_nome_participante_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['nome_participante_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['nome_participante_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['nome_participante_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['nome_participante_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $this->NM_ajax_info['fldList']['hosp_id_hotel_' . $this->nmgp_refresh_row]['type']    = 'text';
                  $this->NM_ajax_info['fldList']['hosp_id_hotel_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->hosp_id_hotel_)));
                  $this->NM_ajax_info['fldList']['hosp_id_hotel_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_hosp_id_hotel_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['hosp_id_hotel_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['hosp_id_hotel_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['hosp_id_hotel_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['hosp_id_hotel_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $tmpLabel_nome_hotel_ = $this->nome_hotel_;
                  $this->NM_ajax_info['fldList']['nome_hotel_' . $this->nmgp_refresh_row]['type']    = 'label';
                  $this->NM_ajax_info['fldList']['nome_hotel_' . $this->nmgp_refresh_row]['valList'] = array($this->nome_hotel_);
                  $this->NM_ajax_info['fldList']['nome_hotel_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_nome_hotel_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['nome_hotel_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['nome_hotel_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['nome_hotel_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['nome_hotel_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $this->NM_ajax_info['fldList']['hosp_acomodacao_' . $this->nmgp_refresh_row]['type']    = 'text';
                  $this->NM_ajax_info['fldList']['hosp_acomodacao_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->hosp_acomodacao_)));
                  $this->NM_ajax_info['fldList']['hosp_acomodacao_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_hosp_acomodacao_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['hosp_acomodacao_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['hosp_acomodacao_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['hosp_acomodacao_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['hosp_acomodacao_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $tmpLabel_nome_acomodacao_ = $this->nome_acomodacao_;
                  $this->NM_ajax_info['fldList']['nome_acomodacao_' . $this->nmgp_refresh_row]['type']    = 'label';
                  $this->NM_ajax_info['fldList']['nome_acomodacao_' . $this->nmgp_refresh_row]['valList'] = array($this->nome_acomodacao_);
                  $this->NM_ajax_info['fldList']['nome_acomodacao_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_nome_acomodacao_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['nome_acomodacao_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['nome_acomodacao_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['nome_acomodacao_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['nome_acomodacao_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $this->NM_ajax_info['fldList']['hosp_categoria_' . $this->nmgp_refresh_row]['type']    = 'text';
                  $this->NM_ajax_info['fldList']['hosp_categoria_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->hosp_categoria_)));
                  $this->NM_ajax_info['fldList']['hosp_categoria_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_hosp_categoria_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['hosp_categoria_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['hosp_categoria_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['hosp_categoria_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['hosp_categoria_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $tmpLabel_nome_categoria_ = $this->nome_categoria_;
                  $this->NM_ajax_info['fldList']['nome_categoria_' . $this->nmgp_refresh_row]['type']    = 'label';
                  $this->NM_ajax_info['fldList']['nome_categoria_' . $this->nmgp_refresh_row]['valList'] = array($this->nome_categoria_);
                  $this->NM_ajax_info['fldList']['nome_categoria_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_nome_categoria_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['nome_categoria_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['nome_categoria_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['nome_categoria_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['nome_categoria_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $aLookup = array();
$aLookup[] = array(form_hospedagem_rsvp_ar1_pack_protect_string('A') => str_replace('<', '&lt;',form_hospedagem_rsvp_ar1_pack_protect_string("Aberto")));
$aLookup[] = array(form_hospedagem_rsvp_ar1_pack_protect_string('Y') => str_replace('<', '&lt;',form_hospedagem_rsvp_ar1_pack_protect_string("Sim")));
$aLookup[] = array(form_hospedagem_rsvp_ar1_pack_protect_string('N') => str_replace('<', '&lt;',form_hospedagem_rsvp_ar1_pack_protect_string("Não")));
$aLookup[] = array(form_hospedagem_rsvp_ar1_pack_protect_string('P') => str_replace('<', '&lt;',form_hospedagem_rsvp_ar1_pack_protect_string("Pendente")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['Lookup_hosp_status_'][] = 'A';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['Lookup_hosp_status_'][] = 'Y';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['Lookup_hosp_status_'][] = 'N';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['Lookup_hosp_status_'][] = 'P';
          $sLabelTemp = '';
          foreach ($aLookup as $aValData)
          {
              if (key($aValData) == form_hospedagem_rsvp_ar1_pack_protect_string(NM_charset_to_utf8($this->hosp_status_)))
              {
                  $sLabelTemp = current($aValData);
              }
          }
          $tmpLabel_hosp_status_ = $sLabelTemp;
                  $this->NM_ajax_info['fldList']['hosp_status_' . $this->nmgp_refresh_row]['type']    = 'select';
                  $this->NM_ajax_info['fldList']['hosp_status_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->hosp_status_)));
                  $this->NM_ajax_info['fldList']['hosp_status_' . $this->nmgp_refresh_row]['labList'] = array($tmpLabel_hosp_status_);

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['hosp_status_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['hosp_status_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['hosp_status_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['hosp_status_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $aLookup = array();
$aLookup[] = array(form_hospedagem_rsvp_ar1_pack_protect_string('NAO') => str_replace('<', '&lt;',form_hospedagem_rsvp_ar1_pack_protect_string("Não")));
$aLookup[] = array(form_hospedagem_rsvp_ar1_pack_protect_string('SIM') => str_replace('<', '&lt;',form_hospedagem_rsvp_ar1_pack_protect_string("Sim")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['Lookup_conta_roomlist_'][] = 'NAO';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['Lookup_conta_roomlist_'][] = 'SIM';
          $sLabelTemp = '';
          foreach ($aLookup as $aValData)
          {
              if (key($aValData) == form_hospedagem_rsvp_ar1_pack_protect_string(NM_charset_to_utf8($this->conta_roomlist_)))
              {
                  $sLabelTemp = current($aValData);
              }
          }
          $tmpLabel_conta_roomlist_ = $sLabelTemp;
                  $this->NM_ajax_info['fldList']['conta_roomlist_' . $this->nmgp_refresh_row]['type']    = 'select';
                  $this->NM_ajax_info['fldList']['conta_roomlist_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->conta_roomlist_)));
                  $this->NM_ajax_info['fldList']['conta_roomlist_' . $this->nmgp_refresh_row]['labList'] = array($tmpLabel_conta_roomlist_);

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['conta_roomlist_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['conta_roomlist_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['conta_roomlist_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['conta_roomlist_' . $this->nmgp_refresh_row] = "on";
                      }
                  }


                  $this->nm_tira_formatacao();

                  $this->NM_ajax_info['closeLine'] = $this->nmgp_refresh_row;
              }
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao = "novo"; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['run_iframe'] == "R")
              { 
                   $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['return_edit'] = "new";
              } 
              }
              $this->nm_flag_iframe = true;
          } 
          if ($this->lig_edit_lookup)
          {
              $this->lig_edit_lookup_call = true;
          }
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['decimal_db'] == ",") 
      {
          $this->nm_tira_aspas_decimal();
      }
      if ($this->nmgp_opcao == "excluir") 
      { 
          $this->hospedagem_id_ = substr($this->Db->qstr($this->hospedagem_id_), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';

          if ($bDelecaoOk)
          {

          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_ "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_ "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_ "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_ "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_ "); 
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
              $this->Campos_Mens_erro = $this->Ini->Nm_lang['lang_errm_dele_nfnd']; 
              $this->nmgp_opcao = "nada"; 
              $this->sc_evento = 'delete';
          } 
          else 
          { 
              $rs1->Close(); 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_ "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_ "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_ "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_ "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_ "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_ "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_ "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_ "); 
              }  
              else  
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_ "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where hospedagem_id = $this->hospedagem_id_ "); 
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
                          form_hospedagem_rsvp_ar1_pack_ajax_response();
                          exit; 
                      }
                  } 
              } 
              $this->sc_evento = "delete"; 
              $this->nmgp_opcao = "avanca"; 
              $this->nm_flag_iframe = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start']--; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] = 0; 
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['db_changed'] = true;

              $this->sc_teve_excl = true; 
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['parms'] = "hospedagem_id_?#?$this->hospedagem_id_?@?"; 
      }
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->hospedagem_id_ = null === $this->hospedagem_id_ ? null : substr($this->Db->qstr($this->hospedagem_id_), 1, -1); 
      } 
   }
//---------- 
   function nm_select_banco() 
   { 
      global $nm_form_submit, $sc_seq_vert, $sc_check_incl, $teste_validade, $sc_where;
 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['rows']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['rows']))
      {
          $this->sc_max_reg = $_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['rows'];
      } 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['rows_ins']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['rows_ins']))
      {
          $this->sc_max_reg_incl = $_SESSION['scriptcase']['sc_apl_conf']['form_hospedagem_rsvp_ar1']['rows_ins'];
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_qtd_reg']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_qtd_reg'])
      {
          $this->sc_max_reg = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_qtd_reg'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['sc_max_reg']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['sc_max_reg'] > 0 || strtolower($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['sc_max_reg']) == "all"))
      {
          $this->sc_max_reg = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['sc_max_reg'];
      } 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $GLOBALS["NM_ERRO_IBASE"] = 0;  
      $this->form_vert_form_hospedagem_rsvp_ar1 = array();
      if ($this->nmgp_opcao != "novo") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['parms'] = ""; 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
      { 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if ($this->sc_teve_excl)
      {
          $this->nmgp_opcao = "avanca";
          if ($this->sc_max_reg != 'all') {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] -= $this->sc_max_reg;
          } 
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] = 0;
      }
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_filter'] && $sc_where_filter != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_filter'] . ")";
          }
      }
      $sc_where = trim("(hosp_id_evento <> '0' AND hosp_tipo_pessoa = 'P'
AND id_bloqueio_hotel = '0')");
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
          $sc_where = (isset($sc_where) && '' != $sc_where) ? $sc_where . ' and (' . $sc_where_filter . ')' : ' where ' . $sc_where_filter;
      }
      if (((isset($this->NM_ajax_opcao) && 'backup_line' == $this->NM_ajax_opcao) || (isset($this->NM_btn_navega) && 'N' == $this->NM_btn_navega)) && !$this->has_where_params && 'novo' != $this->nmgp_opcao)
      {
          $aNewWhereCond = array();
          if (null != $this->hospedagem_id_)
          {
              $aNewWhereCond[] = "hospedagem_id = " . $this->hospedagem_id_;
          }
          if (!$this->NM_ajax_flag)
          {
              $this->NM_btn_navega = "S";
          }
          elseif (!empty($aNewWhereCond))
          {
              if ('' == $sc_where)
              {
                  $sc_where = " where (";
              }
              else
              {
                  $sc_where .= " and (";
              }
              $sc_where .= implode(" and ", $aNewWhereCond) . ")";
          }
      }
      if ('total' != $this->form_paginacao)
      {
          if ($this->app_is_initializing || $this->sc_teve_excl || $this->sc_teve_incl || (isset($_POST['master_nav']) && 'on' == $_POST['master_nav']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['total']))
          {
              $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where;
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
              $rt = $this->Db->Execute($nmgp_select);
              if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
              {
                  $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
                  exit;
              }
              $qt_geral_reg_form_hospedagem_rsvp_ar1 = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['total'] = $qt_geral_reg_form_hospedagem_rsvp_ar1;
              $rt->Close();
          }
      if ((isset($_POST['master_nav']) && 'on' == $_POST['master_nav']) || $this->nmgp_opcao == "igual" || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['total']) || $this->sc_teve_excl || $this->sc_teve_incl)
      { 
          if (!$this->sc_teve_excl && !$this->sc_teve_incl) 
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] = 0; 
          } 
          if ($this->nmgp_opcao == "igual" && isset($this->NM_btn_navega) && 'S' == $this->NM_btn_navega && !empty($this->hospedagem_id_))
          {
              $Reg_OK      = false;
              $Count_start = -1;
              $sc_order_by = "";
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $Sel_Chave = "hospedagem_id"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $Sel_Chave = "hospedagem_id"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $Sel_Chave = "hospedagem_id"; 
              }
              else  
              {
                  $Sel_Chave = "hospedagem_id"; 
              }
              $nmgp_select = "SELECT " . $Sel_Chave . " from " . $this->Ini->nm_tabela . $sc_where; 
              $sc_order_by = "hosp_id_evento";
              $sc_order_by = str_replace("order by ", "", $sc_order_by);
              $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
              if (!empty($sc_order_by))
              {
                  $nmgp_select .= " order by $sc_order_by "; 
              }
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rt = $this->Db->Execute($nmgp_select) ; 
              if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
              { 
                  $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
                  exit ; 
              }  
              while (!$rt->EOF && !$Reg_OK)
              { 
                  if ($rt->fields[0] == $this->hospedagem_id_)
                  { 
                      $Reg_OK = true;
                  }  
                  $Count_start++;
                  $rt->MoveNext();
              }  
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] = $Count_start;
              $rt->Close(); 
          }
      } 
      else 
      { 
          $qt_geral_reg_form_hospedagem_rsvp_ar1 = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['total'];
      } 
      if ($this->nmgp_opcao == "inicio" || $this->nmgp_opcao == "ordem") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] = 0; 
      } 
      if ($this->nmgp_opcao == "navpage" && ($this->nmgp_ordem - 1) <= $qt_geral_reg_form_hospedagem_rsvp_ar1) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] = $this->nmgp_ordem - 1; 
      } 
      if ($this->nmgp_opcao == "avanca")  
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] += $this->sc_max_reg; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] > $qt_geral_reg_form_hospedagem_rsvp_ar1)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] = $qt_geral_reg_form_hospedagem_rsvp_ar1 - $this->sc_max_reg; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] = 0; 
              }
          }
      } 
      if ($this->nmgp_opcao == "retorna") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] -= $this->sc_max_reg; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] < 0)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] = 0; 
          }
      } 
      if ($this->nmgp_opcao == "final") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] = ($qt_geral_reg_form_hospedagem_rsvp_ar1 + 1) - $this->sc_max_reg; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] < 0)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] = 0; 
          }
      } 
      }
      $Cmps_ord_def = array();
      $Cmps_ord_def[] = "hosp_id_evento";
      $Cmps_ord_def[] = "hosp_cpf_participante";
      $Cmps_ord_def[] = "hosp_id_hotel";
      $Cmps_ord_def[] = "hosp_acomodacao";
      $Cmps_ord_def[] = "hosp_categoria";
      $Cmps_ord_def[] = "hosp_status";
      $Cmps_ord_def[] = "conta_roomlist";
      $sc_order_by  = "";
      $sc_order_by = "hosp_id_evento";
      $sc_order_by = str_replace("order by ", "", $sc_order_by);
      $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
      if (!empty($sc_order_by))
      {
          $sc_order_by = " order by $sc_order_by "; 
      }
      if ($this->nmgp_opcao == "ordem" && in_array($this->nmgp_ordem, $Cmps_ord_def)) 
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_cmp'] != $this->nmgp_ordem)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_cmp'] = $this->nmgp_ordem; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_ord'] = ' asc'; 
              switch ($this->nmgp_ordem) {
                  case "hosp_id_evento":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_ord'] = ' desc';
                      break;
                  case "hosp_id_hotel":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_ord'] = ' desc';
                      break;
                  case "hosp_acomodacao":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_ord'] = ' desc';
                      break;
                  case "hosp_categoria":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_ord'] = ' desc';
                      break;
                  case "hospedagem_id":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_ord'] = ' desc';
                      break;
                  case "hosp_id_participante":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_ord'] = ' desc';
                      break;
                  case "hosp_id_usuario":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_ord'] = ' desc';
                      break;
                  case "hosp_pagamentos":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_ord'] = ' desc';
                      break;
                  case "hosp_dt_checkin":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_ord'] = ' desc';
                      break;
                  case "hosp_dt_checkout":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_ord'] = ' desc';
                      break;
                  case "hosp_hr_checkin":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_ord'] = ' desc';
                      break;
                  case "hosp_hr_checkout":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_ord'] = ' desc';
                      break;
                  case "hosp_diarias":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_ord'] = ' desc';
                      break;
                  case "hosp_taxas":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_ord'] = ' desc';
                      break;
                  case "hosp_total":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_ord'] = ' desc';
                      break;
                  case "hosp_alteracao":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_ord'] = ' desc';
                      break;
                  case "id_bloqueio_hotel":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_ord'] = ' desc';
                      break;
                  default:
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_ord'] = ' asc';
                      break;
              }
          }
          elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_ord'] == ' asc')
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_ord'] = ' desc'; 
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_ord'] = ' asc'; 
          }
      } 
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_cmp'])) 
      { 
          $sc_order_by = " order by " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_cmp'] . $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_ord']; 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT hospedagem_id, hosp_id_evento, hosp_id_participante, hosp_id_usuario, hosp_cpf_participante, hosp_id_hotel, hosp_acomodacao, hosp_categoria, hosp_pagamentos, hosp_status, hosp_tipo_pessoa, hosp_acompanhante, hosp_qtd_acompanhante, str_replace (convert(char(10),hosp_dt_checkin,102), '.', '-') + ' ' + convert(char(8),hosp_dt_checkin,20), str_replace (convert(char(10),hosp_dt_checkout,102), '.', '-') + ' ' + convert(char(8),hosp_dt_checkout,20), str_replace (convert(char(10),hosp_hr_checkin,102), '.', '-') + ' ' + convert(char(8),hosp_hr_checkin,20), str_replace (convert(char(10),hosp_hr_checkout,102), '.', '-') + ' ' + convert(char(8),hosp_hr_checkout,20), hosp_early_chkin, hosp_late_chkout, hosp_diarias, hosp_taxas, hosp_total, hosp_observacoes, hosp_dsc_pacote, hosp_alteracao, hosp_ativo, hosp_part_acomp, hosp_reserva_bvt, conta_roomlist, acmq_01, acmq_02, acmq_03, acmq_04, pamq_01, pamq_02, pamq_03, pamq_04, id_bloqueio_hotel from " . $this->Ini->nm_tabela . $sc_where . $sc_order_by; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nmgp_select = "SELECT hospedagem_id, hosp_id_evento, hosp_id_participante, hosp_id_usuario, hosp_cpf_participante, hosp_id_hotel, hosp_acomodacao, hosp_categoria, hosp_pagamentos, hosp_status, hosp_tipo_pessoa, hosp_acompanhante, hosp_qtd_acompanhante, convert(char(23),hosp_dt_checkin,121), convert(char(23),hosp_dt_checkout,121), convert(char(23),hosp_hr_checkin,121), convert(char(23),hosp_hr_checkout,121), hosp_early_chkin, hosp_late_chkout, hosp_diarias, hosp_taxas, hosp_total, hosp_observacoes, hosp_dsc_pacote, hosp_alteracao, hosp_ativo, hosp_part_acomp, hosp_reserva_bvt, conta_roomlist, acmq_01, acmq_02, acmq_03, acmq_04, pamq_01, pamq_02, pamq_03, pamq_04, id_bloqueio_hotel from " . $this->Ini->nm_tabela . $sc_where . $sc_order_by; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT hospedagem_id, hosp_id_evento, hosp_id_participante, hosp_id_usuario, hosp_cpf_participante, hosp_id_hotel, hosp_acomodacao, hosp_categoria, hosp_pagamentos, hosp_status, hosp_tipo_pessoa, hosp_acompanhante, hosp_qtd_acompanhante, hosp_dt_checkin, hosp_dt_checkout, hosp_hr_checkin, hosp_hr_checkout, hosp_early_chkin, hosp_late_chkout, hosp_diarias, hosp_taxas, hosp_total, hosp_observacoes, hosp_dsc_pacote, TO_DATE(TO_CHAR(hosp_alteracao, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), hosp_ativo, hosp_part_acomp, hosp_reserva_bvt, conta_roomlist, acmq_01, acmq_02, acmq_03, acmq_04, pamq_01, pamq_02, pamq_03, pamq_04, id_bloqueio_hotel from " . $this->Ini->nm_tabela . $sc_where . $sc_order_by; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT hospedagem_id, hosp_id_evento, hosp_id_participante, hosp_id_usuario, hosp_cpf_participante, hosp_id_hotel, hosp_acomodacao, hosp_categoria, hosp_pagamentos, hosp_status, hosp_tipo_pessoa, hosp_acompanhante, hosp_qtd_acompanhante, EXTEND(hosp_dt_checkin, YEAR TO DAY), EXTEND(hosp_dt_checkout, YEAR TO DAY), hosp_hr_checkin, hosp_hr_checkout, hosp_early_chkin, hosp_late_chkout, hosp_diarias, hosp_taxas, hosp_total, hosp_observacoes, hosp_dsc_pacote, hosp_alteracao, hosp_ativo, hosp_part_acomp, hosp_reserva_bvt, conta_roomlist, acmq_01, acmq_02, acmq_03, acmq_04, pamq_01, pamq_02, pamq_03, pamq_04, id_bloqueio_hotel from " . $this->Ini->nm_tabela . $sc_where . $sc_order_by; 
      } 
      else 
      { 
          $nmgp_select = "SELECT hospedagem_id, hosp_id_evento, hosp_id_participante, hosp_id_usuario, hosp_cpf_participante, hosp_id_hotel, hosp_acomodacao, hosp_categoria, hosp_pagamentos, hosp_status, hosp_tipo_pessoa, hosp_acompanhante, hosp_qtd_acompanhante, hosp_dt_checkin, hosp_dt_checkout, hosp_hr_checkin, hosp_hr_checkout, hosp_early_chkin, hosp_late_chkout, hosp_diarias, hosp_taxas, hosp_total, hosp_observacoes, hosp_dsc_pacote, hosp_alteracao, hosp_ativo, hosp_part_acomp, hosp_reserva_bvt, conta_roomlist, acmq_01, acmq_02, acmq_03, acmq_04, pamq_01, pamq_02, pamq_03, pamq_04, id_bloqueio_hotel from " . $this->Ini->nm_tabela . $sc_where . $sc_order_by; 
      } 
      if ($this->nmgp_opcao != "novo") 
      { 
      if (isset($this->NM_ajax_opcao) && 'backup_line' == $this->NM_ajax_opcao)
      {
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
          $rs = $this->Db->Execute($nmgp_select) ;
      }
      elseif ('total' == $this->form_paginacao)
      {
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
          $rs = $this->Db->Execute($nmgp_select) ; 
      }
      else
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['run_iframe'] == "R")
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
          } 
          else 
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, $this->sc_max_reg, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] . ")" ; 
                  $rs = $this->Db->SelectLimit($nmgp_select, $this->sc_max_reg, $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start']) ; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, $this->sc_max_reg, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] . ")" ; 
                  $rs = $this->Db->SelectLimit($nmgp_select, $this->sc_max_reg, $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start']) ; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, $this->sc_max_reg, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] . ")" ; 
                  $rs = $this->Db->SelectLimit($nmgp_select, $this->sc_max_reg, $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start']) ; 
              } 
              else  
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
                  $rs = $this->Db->Execute($nmgp_select) ; 
                  if (!$rs === false && !$rs->EOF) 
                  { 
                      $rs->Move($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start']) ;  
                  } 
              } 
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
          if ($rs->EOF && !$this->proc_fast_search && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['empty_filter']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['empty_filter'])) 
          { 
              $this->nm_flag_saida_novo = "S"; 
              $this->nmgp_opcao = "novo"; 
              $this->sc_evento  = "novo"; 
              if ($this->aba_iframe)
              {
                  $this->nmgp_botoes['exit'] = 'off';
              }
          } 
          if ($rs->EOF && $this->nmgp_botoes['new'] != "on" && !$this->proc_fast_search)
          {
              $this->nmgp_form_empty = true;
          }
          if ($rs->EOF)
          {
              $sc_seq_vert = 0; 
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_filter']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['empty_filter'] = true;
              }
          }
          else
          {
              $sc_seq_vert = 1; 
          }
          if ('total' == $this->form_paginacao)
          {
              $bPagTest = true;
              $this->sc_max_reg = 0;
          }
          else
          {
              $bPagTest = $sc_seq_vert <= $this->sc_max_reg;
          }
          if (!$rs->EOF && (!$this->NM_ajax_flag || !isset($this->nmgp_refresh_fields))) {
              $this->nm_proc_onload(false);
          }
          $this->summary_record_count = 0;
          while (!$rs->EOF && $bPagTest)
          { 
              $this->summary_record_count++;
              if ('total' == $this->form_paginacao)
              {
                  $this->sc_max_reg++;
              }
              if (isset($this->NM_ajax_opcao) && 'backup_line' == $this->NM_ajax_opcao)
              {
                  $guard_seq_vert = $sc_seq_vert;
                  $sc_seq_vert    = $this->nmgp_refresh_row;
              }
              if ('total' != $this->form_paginacao)
              {
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['run_iframe'] == "R")
              { 
                  $this->sc_max_reg++;
              } 
              }
              $this->hospedagem_id_ = $rs->fields[0] ; 
              $this->nmgp_dados_select['hospedagem_id_'] = $this->hospedagem_id_;
              $this->hosp_id_evento_ = $rs->fields[1] ; 
              $this->nmgp_dados_select['hosp_id_evento_'] = $this->hosp_id_evento_;
              $this->hosp_id_participante_ = $rs->fields[2] ; 
              $this->nmgp_dados_select['hosp_id_participante_'] = $this->hosp_id_participante_;
              $this->hosp_id_usuario_ = $rs->fields[3] ; 
              $this->nmgp_dados_select['hosp_id_usuario_'] = $this->hosp_id_usuario_;
              $this->hosp_cpf_participante_ = $rs->fields[4] ; 
              $this->nmgp_dados_select['hosp_cpf_participante_'] = $this->hosp_cpf_participante_;
              $this->hosp_id_hotel_ = $rs->fields[5] ; 
              $this->nmgp_dados_select['hosp_id_hotel_'] = $this->hosp_id_hotel_;
              $this->hosp_acomodacao_ = $rs->fields[6] ; 
              $this->nmgp_dados_select['hosp_acomodacao_'] = $this->hosp_acomodacao_;
              $this->hosp_categoria_ = $rs->fields[7] ; 
              $this->nmgp_dados_select['hosp_categoria_'] = $this->hosp_categoria_;
              $this->hosp_pagamentos_ = $rs->fields[8] ; 
              $this->nmgp_dados_select['hosp_pagamentos_'] = $this->hosp_pagamentos_;
              $this->hosp_status_ = $rs->fields[9] ; 
              $this->nmgp_dados_select['hosp_status_'] = $this->hosp_status_;
              $this->hosp_tipo_pessoa_ = $rs->fields[10] ; 
              $this->nmgp_dados_select['hosp_tipo_pessoa_'] = $this->hosp_tipo_pessoa_;
              $this->hosp_acompanhante_ = $rs->fields[11] ; 
              $this->nmgp_dados_select['hosp_acompanhante_'] = $this->hosp_acompanhante_;
              $this->hosp_qtd_acompanhante_ = $rs->fields[12] ; 
              $this->nmgp_dados_select['hosp_qtd_acompanhante_'] = $this->hosp_qtd_acompanhante_;
              $this->hosp_dt_checkin_ = $rs->fields[13] ; 
              $this->nmgp_dados_select['hosp_dt_checkin_'] = $this->hosp_dt_checkin_;
              $this->hosp_dt_checkout_ = $rs->fields[14] ; 
              $this->nmgp_dados_select['hosp_dt_checkout_'] = $this->hosp_dt_checkout_;
              $this->hosp_hr_checkin_ = $rs->fields[15] ; 
              $this->nmgp_dados_select['hosp_hr_checkin_'] = $this->hosp_hr_checkin_;
              $this->hosp_hr_checkout_ = $rs->fields[16] ; 
              $this->nmgp_dados_select['hosp_hr_checkout_'] = $this->hosp_hr_checkout_;
              $this->hosp_early_chkin_ = $rs->fields[17] ; 
              $this->nmgp_dados_select['hosp_early_chkin_'] = $this->hosp_early_chkin_;
              $this->hosp_late_chkout_ = $rs->fields[18] ; 
              $this->nmgp_dados_select['hosp_late_chkout_'] = $this->hosp_late_chkout_;
              $this->hosp_diarias_ = $rs->fields[19] ; 
              $this->nmgp_dados_select['hosp_diarias_'] = $this->hosp_diarias_;
              $this->hosp_taxas_ = $rs->fields[20] ; 
              $this->nmgp_dados_select['hosp_taxas_'] = $this->hosp_taxas_;
              $this->hosp_total_ = $rs->fields[21] ; 
              $this->nmgp_dados_select['hosp_total_'] = $this->hosp_total_;
              $this->hosp_observacoes_ = $rs->fields[22] ; 
              $this->nmgp_dados_select['hosp_observacoes_'] = $this->hosp_observacoes_;
              $this->hosp_dsc_pacote_ = $rs->fields[23] ; 
              $this->nmgp_dados_select['hosp_dsc_pacote_'] = $this->hosp_dsc_pacote_;
              $this->hosp_alteracao_ = $rs->fields[24] ; 
              if (substr($this->hosp_alteracao_, 10, 1) == "-") 
              { 
                 $this->hosp_alteracao_ = substr($this->hosp_alteracao_, 0, 10) . " " . substr($this->hosp_alteracao_, 11);
              } 
              if (substr($this->hosp_alteracao_, 13, 1) == ".") 
              { 
                 $this->hosp_alteracao_ = substr($this->hosp_alteracao_, 0, 13) . ":" . substr($this->hosp_alteracao_, 14, 2) . ":" . substr($this->hosp_alteracao_, 17);
              } 
              $this->nmgp_dados_select['hosp_alteracao_'] = $this->hosp_alteracao_;
              $this->hosp_ativo_ = $rs->fields[25] ; 
              $this->nmgp_dados_select['hosp_ativo_'] = $this->hosp_ativo_;
              $this->hosp_part_acomp_ = $rs->fields[26] ; 
              $this->nmgp_dados_select['hosp_part_acomp_'] = $this->hosp_part_acomp_;
              $this->hosp_reserva_bvt_ = $rs->fields[27] ; 
              $this->nmgp_dados_select['hosp_reserva_bvt_'] = $this->hosp_reserva_bvt_;
              $this->conta_roomlist_ = $rs->fields[28] ; 
              $this->nmgp_dados_select['conta_roomlist_'] = $this->conta_roomlist_;
              $this->acmq_01_ = $rs->fields[29] ; 
              $this->nmgp_dados_select['acmq_01_'] = $this->acmq_01_;
              $this->acmq_02_ = $rs->fields[30] ; 
              $this->nmgp_dados_select['acmq_02_'] = $this->acmq_02_;
              $this->acmq_03_ = $rs->fields[31] ; 
              $this->nmgp_dados_select['acmq_03_'] = $this->acmq_03_;
              $this->acmq_04_ = $rs->fields[32] ; 
              $this->nmgp_dados_select['acmq_04_'] = $this->acmq_04_;
              $this->pamq_01_ = $rs->fields[33] ; 
              $this->nmgp_dados_select['pamq_01_'] = $this->pamq_01_;
              $this->pamq_02_ = $rs->fields[34] ; 
              $this->nmgp_dados_select['pamq_02_'] = $this->pamq_02_;
              $this->pamq_03_ = $rs->fields[35] ; 
              $this->nmgp_dados_select['pamq_03_'] = $this->pamq_03_;
              $this->pamq_04_ = $rs->fields[36] ; 
              $this->nmgp_dados_select['pamq_04_'] = $this->pamq_04_;
              $this->id_bloqueio_hotel_ = $rs->fields[37] ; 
              $this->nmgp_dados_select['id_bloqueio_hotel_'] = $this->id_bloqueio_hotel_;
              $this->nome_evento_ = isset($GLOBALS['nome_evento_' . $sc_seq_vert]) ? $GLOBALS['nome_evento_' . $sc_seq_vert] : '';
              $this->nome_participante_ = isset($GLOBALS['nome_participante_' . $sc_seq_vert]) ? $GLOBALS['nome_participante_' . $sc_seq_vert] : '';
              $this->nome_hotel_ = isset($GLOBALS['nome_hotel_' . $sc_seq_vert]) ? $GLOBALS['nome_hotel_' . $sc_seq_vert] : '';
              $this->nome_acomodacao_ = isset($GLOBALS['nome_acomodacao_' . $sc_seq_vert]) ? $GLOBALS['nome_acomodacao_' . $sc_seq_vert] : '';
              $this->nome_categoria_ = isset($GLOBALS['nome_categoria_' . $sc_seq_vert]) ? $GLOBALS['nome_categoria_' . $sc_seq_vert] : '';
              $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->nm_troca_decimal(",", ".");
              $this->hospedagem_id_ = (string)$this->hospedagem_id_; 
              $this->hosp_id_evento_ = (string)$this->hosp_id_evento_; 
              $this->hosp_id_participante_ = (string)$this->hosp_id_participante_; 
              $this->hosp_id_usuario_ = (string)$this->hosp_id_usuario_; 
              $this->hosp_id_hotel_ = (string)$this->hosp_id_hotel_; 
              $this->hosp_acomodacao_ = (string)$this->hosp_acomodacao_; 
              $this->hosp_categoria_ = (string)$this->hosp_categoria_; 
              $this->hosp_pagamentos_ = (string)$this->hosp_pagamentos_; 
              $this->hosp_diarias_ = (string)$this->hosp_diarias_; 
              $this->hosp_taxas_ = (string)$this->hosp_taxas_; 
              $this->hosp_total_ = (string)$this->hosp_total_; 
              $this->id_bloqueio_hotel_ = (string)$this->id_bloqueio_hotel_; 
              if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['parms'])) 
              { 
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['parms'] = "hospedagem_id_?#?$this->hospedagem_id_?@?";
              } 
              $this->nm_proc_onload_record($sc_seq_vert);
              $this->storeRecordState($sc_seq_vert);
//
//-- 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dados_select'][$sc_seq_vert] = $this->nmgp_dados_select;
              $this->nm_guardar_campos();
              $this->nm_formatar_campos();
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_id_evento_'] =  $this->hosp_id_evento_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['nome_evento_'] =  $this->nome_evento_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_cpf_participante_'] =  $this->hosp_cpf_participante_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['nome_participante_'] =  $this->nome_participante_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_id_hotel_'] =  $this->hosp_id_hotel_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['nome_hotel_'] =  $this->nome_hotel_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_acomodacao_'] =  $this->hosp_acomodacao_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['nome_acomodacao_'] =  $this->nome_acomodacao_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_categoria_'] =  $this->hosp_categoria_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['nome_categoria_'] =  $this->nome_categoria_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_status_'] =  $this->hosp_status_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['conta_roomlist_'] =  $this->conta_roomlist_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hospedagem_id_'] =  $this->hospedagem_id_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_id_participante_'] =  $this->hosp_id_participante_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_id_usuario_'] =  $this->hosp_id_usuario_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_pagamentos_'] =  $this->hosp_pagamentos_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_tipo_pessoa_'] =  $this->hosp_tipo_pessoa_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_acompanhante_'] =  $this->hosp_acompanhante_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_qtd_acompanhante_'] =  $this->hosp_qtd_acompanhante_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_dt_checkin_'] =  $this->hosp_dt_checkin_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_dt_checkout_'] =  $this->hosp_dt_checkout_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_hr_checkin_'] =  $this->hosp_hr_checkin_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_hr_checkout_'] =  $this->hosp_hr_checkout_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_early_chkin_'] =  $this->hosp_early_chkin_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_late_chkout_'] =  $this->hosp_late_chkout_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_diarias_'] =  $this->hosp_diarias_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_taxas_'] =  $this->hosp_taxas_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_total_'] =  $this->hosp_total_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_observacoes_'] =  $this->hosp_observacoes_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_dsc_pacote_'] =  $this->hosp_dsc_pacote_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_alteracao_'] =  $this->hosp_alteracao_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_alteracao__hora'] =  $this->hosp_alteracao__hora; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_ativo_'] =  $this->hosp_ativo_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_part_acomp_'] =  $this->hosp_part_acomp_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_reserva_bvt_'] =  $this->hosp_reserva_bvt_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['acmq_01_'] =  $this->acmq_01_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['acmq_02_'] =  $this->acmq_02_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['acmq_03_'] =  $this->acmq_03_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['acmq_04_'] =  $this->acmq_04_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['pamq_01_'] =  $this->pamq_01_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['pamq_02_'] =  $this->pamq_02_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['pamq_03_'] =  $this->pamq_03_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['pamq_04_'] =  $this->pamq_04_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['id_bloqueio_hotel_'] =  $this->id_bloqueio_hotel_; 
              $sc_seq_vert++; 
              $rs->MoveNext() ; 
              if (isset($this->NM_ajax_opcao) && 'backup_line' == $this->NM_ajax_opcao)
              {
                  $sc_seq_vert = $guard_seq_vert;
              }
              if ('total' != $this->form_paginacao)
              {
                  $bPagTest = $sc_seq_vert <= $this->sc_max_reg;
              }
          } 
          ksort ($this->form_vert_form_hospedagem_rsvp_ar1); 
          $rs->Close(); 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_qtd'] = $sc_seq_vert + $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] - 1;
          if ('total' == $this->form_paginacao)
          {
              $this->NM_ajax_info['navSummary']['reg_ini'] = 1; 
              $this->NM_ajax_info['navSummary']['reg_qtd'] = $this->sc_max_reg; 
              $this->NM_ajax_info['navSummary']['reg_tot'] = $this->sc_max_reg; 
          }
          else
          {
              $this->NM_ajax_info['navSummary']['reg_ini'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] + 1; 
              $this->NM_ajax_info['navSummary']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_qtd']; 
              $this->NM_ajax_info['navSummary']['reg_tot'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['total'] + 1; 
          }
          if ($this->form_paginacao == "total")
          {
              $this->SC_nav_page = "";
          }
          else
          {
              $this->NM_gera_nav_page(); 
          }
          $this->NM_ajax_info['navPage'] = $this->SC_nav_page; 
          if (!$this->NM_ajax_flag || 'backup_line' != $this->NM_ajax_opcao)
          {
              $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'];
              $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] < (($qt_geral_reg_form_hospedagem_rsvp_ar1 + 1) - $this->sc_max_reg);
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['opcao'] = '';
          }
      } 
      if ($this->nmgp_opcao == "novo") 
      { 
          $sc_seq_vert = 1; 
          $sc_check_incl = array(); 
          if ($this->NM_ajax_flag && 'add_new_line' == $this->NM_ajax_opcao) 
          { 
              $sc_seq_vert = $this->sc_seq_vert; 
              $this->sc_evento = "novo"; 
              $this->sc_max_reg_incl = $this->sc_seq_vert; 
          } 
          elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_multi']) 
          { 
          } 
          elseif ($this->Embutida_form) 
          { 
              $this->sc_max_reg_incl = 0; 
          } 
          while ($sc_seq_vert <= $this->sc_max_reg_incl) 
          { 
              $this->hosp_id_evento_ = "";  
              $this->hosp_cpf_participante_ = "";  
              $this->hosp_id_hotel_ = "";  
              $this->hosp_acomodacao_ = "";  
              $this->hosp_categoria_ = "";  
              $this->hosp_status_ = "";  
              $this->conta_roomlist_ = "";  
              $this->nome_evento_ = "";  
              $this->nome_participante_ = "";  
              $this->nome_hotel_ = "";  
              $this->nome_acomodacao_ = "";  
              $this->nome_categoria_ = "";  
              $this->nm_proc_onload_record($sc_seq_vert);
              if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['foreign_key']))
              {
                  foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['foreign_key'] as $sFKName => $sFKValue)
                  {
                      if (isset($this->sc_conv_var[$sFKName]))
                      {
                          $sFKName = $this->sc_conv_var[$sFKName];
                      }
                      eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
                  }
              }
              $this->nm_guardar_campos();
              $this->nm_formatar_campos();
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_id_evento_'] =  $this->hosp_id_evento_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['nome_evento_'] =  $this->nome_evento_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_cpf_participante_'] =  $this->hosp_cpf_participante_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['nome_participante_'] =  $this->nome_participante_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_id_hotel_'] =  $this->hosp_id_hotel_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['nome_hotel_'] =  $this->nome_hotel_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_acomodacao_'] =  $this->hosp_acomodacao_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['nome_acomodacao_'] =  $this->nome_acomodacao_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_categoria_'] =  $this->hosp_categoria_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['nome_categoria_'] =  $this->nome_categoria_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_status_'] =  $this->hosp_status_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['conta_roomlist_'] =  $this->conta_roomlist_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hospedagem_id_'] =  $this->hospedagem_id_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_id_participante_'] =  $this->hosp_id_participante_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_id_usuario_'] =  $this->hosp_id_usuario_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_pagamentos_'] =  $this->hosp_pagamentos_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_tipo_pessoa_'] =  $this->hosp_tipo_pessoa_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_acompanhante_'] =  $this->hosp_acompanhante_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_qtd_acompanhante_'] =  $this->hosp_qtd_acompanhante_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_dt_checkin_'] =  $this->hosp_dt_checkin_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_dt_checkout_'] =  $this->hosp_dt_checkout_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_hr_checkin_'] =  $this->hosp_hr_checkin_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_hr_checkout_'] =  $this->hosp_hr_checkout_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_early_chkin_'] =  $this->hosp_early_chkin_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_late_chkout_'] =  $this->hosp_late_chkout_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_diarias_'] =  $this->hosp_diarias_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_taxas_'] =  $this->hosp_taxas_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_total_'] =  $this->hosp_total_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_observacoes_'] =  $this->hosp_observacoes_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_dsc_pacote_'] =  $this->hosp_dsc_pacote_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_alteracao_'] =  $this->hosp_alteracao_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_alteracao__hora'] =  $this->hosp_alteracao__hora; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_ativo_'] =  $this->hosp_ativo_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_part_acomp_'] =  $this->hosp_part_acomp_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['hosp_reserva_bvt_'] =  $this->hosp_reserva_bvt_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['acmq_01_'] =  $this->acmq_01_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['acmq_02_'] =  $this->acmq_02_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['acmq_03_'] =  $this->acmq_03_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['acmq_04_'] =  $this->acmq_04_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['pamq_01_'] =  $this->pamq_01_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['pamq_02_'] =  $this->pamq_02_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['pamq_03_'] =  $this->pamq_03_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['pamq_04_'] =  $this->pamq_04_; 
             $this->form_vert_form_hospedagem_rsvp_ar1[$sc_seq_vert]['id_bloqueio_hotel_'] =  $this->id_bloqueio_hotel_; 
              $sc_seq_vert++; 
          } 
          if (!$this->NM_ajax_flag || !isset($this->nmgp_refresh_fields)) {
              $this->nm_proc_onload(false);
          }
      }  
  }
   function NM_gera_nav_page() 
   {
       $this->SC_nav_page = "";
       $Arr_result        = array();
       $Ind_result        = 0;
       $Reg_Page   = $this->sc_max_reg;
       $Max_link   = 5;
       $Mid_link   = ceil($Max_link / 2);
       $Corr_link  = (($Max_link % 2) == 0) ? 0 : 1;
       $rec_tot    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['total'] + 1;
       $rec_fim    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] + $this->sc_max_reg;
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['record_state'][$sc_seq_vert]['buttons']['update'];
                }
        }

//

function hosp_acomodacao__onChange()
{
$_SESSION['scriptcase']['form_hospedagem_rsvp_ar1']['contr_erro'] = 'on';
  
$original_hosp_acomodacao_ = $this->hosp_acomodacao_;
$original_nome_acomodacao_ = $this->nome_acomodacao_;



$sql = "
	SELECT 
		acomodacao_desc 
	FROM 
		tbl_acomodacoes 
	WHERE 
		acomodacao_id = ".$this->Db->qstr($this->hosp_acomodacao_ )."  
	ORDER BY 
		acomodacao_desc
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
	$this->nome_acomodacao_  = $this->rs[0][0];	
} else {
	$this->nome_acomodacao_  = 'ERRO';
	$this->hosp_acomodacao_ = '0';
	$this->sc_ajax_message ("Acomodação não Encontrada!","NRSVP" , "timeout=10");
}	

$modificado_hosp_acomodacao_ = $this->hosp_acomodacao_;
$modificado_nome_acomodacao_ = $this->nome_acomodacao_;
$this->nm_formatar_campos('hosp_acomodacao_', 'nome_acomodacao_');
$this->nmgp_refresh_fields = array();
if ($original_hosp_acomodacao_ !== $modificado_hosp_acomodacao_ || isset($this->nmgp_cmp_readonly['hosp_acomodacao_']) || (isset($bFlagRead_hosp_acomodacao_) && $bFlagRead_hosp_acomodacao_))
{
    $this->nmgp_refresh_fields[] = 'hosp_acomodacao_';
    $this->NM_ajax_changed['hosp_acomodacao_'] = true;
    $this->NM_ajax_force_values = true;
}
if ($original_nome_acomodacao_ !== $modificado_nome_acomodacao_ || isset($this->nmgp_cmp_readonly['nome_acomodacao_']) || (isset($bFlagRead_nome_acomodacao_) && $bFlagRead_nome_acomodacao_))
{
    $this->nmgp_refresh_fields[] = 'nome_acomodacao_';
    $this->NM_ajax_changed['nome_acomodacao_'] = true;
    $this->NM_ajax_force_values = true;
}
if ($this->NM_ajax_force_values)
{
    $this->ajax_return_values();
}
$this->NM_ajax_info['event_field'] = 'hosp';
form_hospedagem_rsvp_ar1_pack_ajax_response();
exit;
$_SESSION['scriptcase']['form_hospedagem_rsvp_ar1']['contr_erro'] = 'off';
}


function hosp_categoria__onChange()
{
$_SESSION['scriptcase']['form_hospedagem_rsvp_ar1']['contr_erro'] = 'on';
  
$original_hosp_categoria_ = $this->hosp_categoria_;
$original_nome_categoria_ = $this->nome_categoria_;



$sql = "
	SELECT 
		acomod_dsc 
	FROM 
		tbl_categ_acomod 
	WHERE
		acomod_id = ".$this->Db->qstr($this->hosp_categoria_ )."   
	ORDER BY 
		acomod_dsc
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
	$this->nome_categoria_  = $this->rs[0][0];	
} else {
	$this->nome_categoria_  = 'ERRO';
	$this->hosp_categoria_  = '0';
	$this->sc_ajax_message ("Categoria não Encontrada!","NRSVP" , "timeout=10");
}	

$modificado_hosp_categoria_ = $this->hosp_categoria_;
$modificado_nome_categoria_ = $this->nome_categoria_;
$this->nm_formatar_campos('hosp_categoria_', 'nome_categoria_');
$this->nmgp_refresh_fields = array();
if ($original_hosp_categoria_ !== $modificado_hosp_categoria_ || isset($this->nmgp_cmp_readonly['hosp_categoria_']) || (isset($bFlagRead_hosp_categoria_) && $bFlagRead_hosp_categoria_))
{
    $this->nmgp_refresh_fields[] = 'hosp_categoria_';
    $this->NM_ajax_changed['hosp_categoria_'] = true;
    $this->NM_ajax_force_values = true;
}
if ($original_nome_categoria_ !== $modificado_nome_categoria_ || isset($this->nmgp_cmp_readonly['nome_categoria_']) || (isset($bFlagRead_nome_categoria_) && $bFlagRead_nome_categoria_))
{
    $this->nmgp_refresh_fields[] = 'nome_categoria_';
    $this->NM_ajax_changed['nome_categoria_'] = true;
    $this->NM_ajax_force_values = true;
}
if ($this->NM_ajax_force_values)
{
    $this->ajax_return_values();
}
$this->NM_ajax_info['event_field'] = 'hosp';
form_hospedagem_rsvp_ar1_pack_ajax_response();
exit;
$_SESSION['scriptcase']['form_hospedagem_rsvp_ar1']['contr_erro'] = 'off';
}


function hosp_id_hotel__onChange()
{
$_SESSION['scriptcase']['form_hospedagem_rsvp_ar1']['contr_erro'] = 'on';
  
$original_hosp_id_evento_ = $this->hosp_id_evento_;
$original_hosp_id_hotel_ = $this->hosp_id_hotel_;
$original_nome_hotel_ = $this->nome_hotel_;



$sql = "
	SELECT
		evento_id,
		hotel_id
	FROM
		eventos_hoteis_rsvp
	WHERE
		evento_id = ".$this->Db->qstr($this->hosp_id_evento_ )."
	AND
		hotel_id = ".$this->Db->qstr($this->hosp_id_hotel_ )."
	ORDER BY
		evento_id,hotel_id	
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
	$sql2 = "
		SELECT
			hotel_id,
			hotel_fantasia
		FROM
			tbl_hoteis
		WHERE
			hotel_id = ".$this->Db->qstr($this->hosp_id_hotel_ )."
		ORDER BY
			hotel_id
	";
	 
      $nm_select = $sql2; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs2 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs2[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs2 = false;
          $this->rs2_erro = $this->Db->ErrorMsg();
      } 
	
	if (isset($this->rs2[0][0])) {		
		$this->nome_hotel_  = $this->rs2[0][1];	
	} else {
		$this->nome_hotel_  = 'ERRO';
		$this->hosp_id_hotel_  = '0';
		$this->sc_ajax_message ("Hotel NÃO encontrado!","NRSVP" , "timeout=10");		
	}	
} else {
	$this->nome_hotel_  = 'ERRO';
	$this->hosp_id_hotel_  = '0';
	$this->sc_ajax_message ("Hotel NÃO cadastrado para o evento!","NRSVP" , "timeout=10");
}	




$modificado_hosp_id_evento_ = $this->hosp_id_evento_;
$modificado_hosp_id_hotel_ = $this->hosp_id_hotel_;
$modificado_nome_hotel_ = $this->nome_hotel_;
$this->nm_formatar_campos('hosp_id_evento_', 'hosp_id_hotel_', 'nome_hotel_');
$this->nmgp_refresh_fields = array();
if ($original_hosp_id_evento_ !== $modificado_hosp_id_evento_ || isset($this->nmgp_cmp_readonly['hosp_id_evento_']) || (isset($bFlagRead_hosp_id_evento_) && $bFlagRead_hosp_id_evento_))
{
    $this->nmgp_refresh_fields[] = 'hosp_id_evento_';
    $this->NM_ajax_changed['hosp_id_evento_'] = true;
    $this->NM_ajax_force_values = true;
}
if ($original_hosp_id_hotel_ !== $modificado_hosp_id_hotel_ || isset($this->nmgp_cmp_readonly['hosp_id_hotel_']) || (isset($bFlagRead_hosp_id_hotel_) && $bFlagRead_hosp_id_hotel_))
{
    $this->nmgp_refresh_fields[] = 'hosp_id_hotel_';
    $this->NM_ajax_changed['hosp_id_hotel_'] = true;
    $this->NM_ajax_force_values = true;
}
if ($original_nome_hotel_ !== $modificado_nome_hotel_ || isset($this->nmgp_cmp_readonly['nome_hotel_']) || (isset($bFlagRead_nome_hotel_) && $bFlagRead_nome_hotel_))
{
    $this->nmgp_refresh_fields[] = 'nome_hotel_';
    $this->NM_ajax_changed['nome_hotel_'] = true;
    $this->NM_ajax_force_values = true;
}
if ($this->NM_ajax_force_values)
{
    $this->ajax_return_values();
}
$this->NM_ajax_info['event_field'] = 'hosp';
form_hospedagem_rsvp_ar1_pack_ajax_response();
exit;
$_SESSION['scriptcase']['form_hospedagem_rsvp_ar1']['contr_erro'] = 'off';
}


function GravaLog($v_hora_now,$v_ip_usuario,$v_id_usuario,$v_global_cpf,$v_modulo,$v_aplicacao,$v_acao,$v_campo_id,$v_vl_campo_id,$v_campo_cpf,$v_vl_campo_cpf,$v_campo_evt,$v_vl_campo_evt,$v_tabela,$v_obs,$v_sql) {
$_SESSION['scriptcase']['form_hospedagem_rsvp_ar1']['contr_erro'] = 'on';
  		
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_hospedagem_rsvp_ar1_pack_ajax_response();
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
$_SESSION['scriptcase']['form_hospedagem_rsvp_ar1']['contr_erro'] = 'off';
}


function PegaIP() {
$_SESSION['scriptcase']['form_hospedagem_rsvp_ar1']['contr_erro'] = 'on';
  
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
	
$_SESSION['scriptcase']['form_hospedagem_rsvp_ar1']['contr_erro'] = 'off';
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
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              form_hospedagem_rsvp_ar1_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
        $this->initFormPages();
   if ($this->NM_ajax_flag && 'add_new_line' == $this->NM_ajax_opcao)
   {
        $this->Form_Corpo(true);
   }
   elseif ($this->NM_ajax_flag && 'table_refresh' == $this->NM_ajax_opcao)
   {
        $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['table_refresh'] = true;
        $this->Form_Table(true);
        $this->Form_Corpo(false, true);
   }
   else
   {
        $this->Form_Init();
        $this->Form_Table();
        $this->Form_Corpo();
        $this->Form_Fim();
   }
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
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array("hosp_id_evento_", "hosp_cpf_participante_", "hosp_id_hotel_", "hosp_acomodacao_", "hosp_categoria_", "hosp_status_", "conta_roomlist_"))) {
            $searchOk = true;
        }
        elseif ($field == $this->nmgp_fast_search && in_array($field, array("hosp_id_evento_", "hosp_cpf_participante_", "hosp_id_hotel_", "hosp_acomodacao_", "hosp_categoria_", "hosp_status_", "conta_roomlist_"))) {
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['table_refresh'])
        {
            return NM_encode_input(NM_encode_input($string));
        }
        else
        {
            return NM_encode_input($string);
        }
    } // form_encode_input

   function jqueryCalendarDtFormat($sFormat, $sSep)
   {
       $sFormat = chunk_split(str_replace('yyyy', 'yy', $sFormat), 2, $sSep);

       if ($sSep == substr($sFormat, -1))
       {
           $sFormat = substr($sFormat, 0, -1);
       }

       return $sFormat;
   } // jqueryCalendarDtFormat

   function jqueryCalendarTimeStart($sFormat, $value)
   {
       $aDateParts = explode(';', $sFormat);

       if (2 == sizeof($aDateParts))
       {
           $sTime = $aDateParts[1];
       }
       else
       {
           $sTime = 'hh:mm:ss';
       }

       if ('now' == $value) {
           return str_replace(array('hh', 'mm', 'ii', 'ss'), array(date('H'), date('i'), date('i'), date('s')), $sTime);
       } elseif ('end' == $value) {
           return str_replace(array('hh', 'mm', 'ii', 'ss'), array('23', '59', '59', '59'), $sTime);
       } else {
           return str_replace(array('h', 'm', 'i', 's'), array('0', '0', '0', '0'), $sTime);
       }
   } // jqueryCalendarTimeStart

   function jqueryCalendarWeekInit($sDay)
   {
       switch ($sDay) {
           case 'MO': return 1; break;
           case 'TU': return 2; break;
           case 'WE': return 3; break;
           case 'TH': return 4; break;
           case 'FR': return 5; break;
           case 'SA': return 6; break;
           default  : return 7; break;
       }
   } // jqueryCalendarWeekInit

   function jqueryIconFile($sModule)
   {
       $sImage = '';
       if ('calendar' == $sModule)
       {
           if (isset($this->arr_buttons['bcalendario']) && isset($this->arr_buttons['bcalendario']['type']) && 'image' == $this->arr_buttons['bcalendario']['type'] && 'only_fontawesomeicon' != $this->arr_buttons['bcalendario']['display'])
           {
               $sImage = $this->arr_buttons['bcalendario']['image'];
           }
       }
       elseif ('calculator' == $sModule)
       {
           if (isset($this->arr_buttons['bcalculadora']) && isset($this->arr_buttons['bcalculadora']['type']) && 'image' == $this->arr_buttons['bcalculadora']['type'] && 'only_fontawesomeicon' != $this->arr_buttons['bcalculadora']['display'])
           {
               $sImage = $this->arr_buttons['bcalculadora']['image'];
           }
       }

       return '' == $sImage ? '' : $this->Ini->path_icones . '/' . $sImage;
   } // jqueryIconFile

   function jqueryFAFile($sModule)
   {
       $sFA = '';
       if ('calendar' == $sModule)
       {
           if (isset($this->arr_buttons['bcalendario']) && isset($this->arr_buttons['bcalendario']['type']) && ('image' == $this->arr_buttons['bcalendario']['type'] || 'button' == $this->arr_buttons['bcalendario']['type']) && 'only_fontawesomeicon' == $this->arr_buttons['bcalendario']['display'])
           {
               $sFA = $this->arr_buttons['bcalendario']['fontawesomeicon'];
           }
       }
       elseif ('calculator' == $sModule)
       {
           if (isset($this->arr_buttons['bcalculadora']) && isset($this->arr_buttons['bcalculadora']['type']) && ('image' == $this->arr_buttons['bcalculadora']['type'] || 'button' == $this->arr_buttons['bcalculadora']['type']) && 'only_fontawesomeicon' == $this->arr_buttons['bcalculadora']['display'])
           {
               $sFA = $this->arr_buttons['bcalculadora']['fontawesomeicon'];
           }
       }

       return '' == $sFA ? '' : "<span class='scButton_fontawesome " . $sFA . "'></span>";
   } // jqueryFAFile

   function jqueryButtonText($sModule)
   {
       $sClass = '';
       $sText  = '';
       if ('calendar' == $sModule)
       {
           if (isset($this->arr_buttons['bcalendario']) && isset($this->arr_buttons['bcalendario']['type']) && ('image' == $this->arr_buttons['bcalendario']['type'] || 'button' == $this->arr_buttons['bcalendario']['type']))
           {
               if ('only_text' == $this->arr_buttons['bcalendario']['display'])
               {
                   $sClass = 'scButton_' . $this->arr_buttons['bcalendario']['style'];
                   $sText  = $this->arr_buttons['bcalendario']['value'];
               }
               elseif ('text_fontawesomeicon' == $this->arr_buttons['bcalendario']['display'])
               {
                   $sClass = 'scButton_' . $this->arr_buttons['bcalendario']['style'];
                   if ('text_right' == $this->arr_buttons['bcalendario']['display_position'])
                   {
                       $sText = "<i class='icon_fa " . $this->arr_buttons['bcalendario']['fontawesomeicon'] . "'></i> " . $this->arr_buttons['bcalendario']['value'];
                   }
                   else
                   {
                       $sText = $this->arr_buttons['bcalendario']['value'] . " <i class='icon_fa " . $this->arr_buttons['bcalendario']['fontawesomeicon'] . "'></i>";
                   }
               }
           }
       }
       elseif ('calculator' == $sModule)
       {
           if (isset($this->arr_buttons['bcalculadora']) && isset($this->arr_buttons['bcalculadora']['type']) && ('image' == $this->arr_buttons['bcalculadora']['type'] || 'button' == $this->arr_buttons['bcalculadora']['type']))
           {
               if ('only_text' == $this->arr_buttons['bcalculadora']['display'])
               {
                   $sClass = 'scButton_' . $this->arr_buttons['bcalendario']['style'];
                   $sText  = $this->arr_buttons['bcalculadora']['value'];
               }
               elseif ('text_fontawesomeicon' == $this->arr_buttons['bcalculadora']['display'])
               {
                   $sClass = 'scButton_' . $this->arr_buttons['bcalendario']['style'];
                   if ('text_right' == $this->arr_buttons['bcalendario']['display_position'])
                   {
                       $sText = "<i class='icon_fa " . $this->arr_buttons['bcalculadora']['fontawesomeicon'] . "'></i> " . $this->arr_buttons['bcalculadora']['value'];
                   }
                   else
                   {
                       $sText = $this->arr_buttons['bcalculadora']['value'] . " <i class='icon_fa " . $this->arr_buttons['bcalculadora']['fontawesomeicon'] . "'></i> ";
                   }
               }
           }
       }

       return '' == $sText ? array('', '') : array($sText, $sClass);
   } // jqueryButtonText


    function scCsrfGetToken()
    {
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['csrf_token'];
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

   function Form_lookup_hosp_status_()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Aberto?#?A?#?N?@?";
       $nmgp_def_dados .= "Sim?#?Y?#?S?@?";
       $nmgp_def_dados .= "Não?#?N?#?N?@?";
       $nmgp_def_dados .= "Pendente?#?P?#?N?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_conta_roomlist_()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Não?#?NAO?#?N?@?";
       $nmgp_def_dados .= "Sim?#?SIM?#?S?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function SC_fast_search($in_fields, $arg_search, $data_search)
   {
      $fields = (strpos($in_fields, "SC_all_Cmp") !== false) ? array("SC_all_Cmp") : explode(";", $in_fields);
      $this->NM_case_insensitive = true;
      if (empty($data_search)) 
      {
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_and_or']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_cache']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              form_hospedagem_rsvp_ar1_pack_ajax_response();
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
          if ($field == "SC_all_Cmp" || $field == "hosp_id_evento_") 
          {
              $this->SC_monta_condicao($comando, "hosp_id_evento", $arg_search, str_replace(",", ".", $data_search), "INT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hosp_cpf_participante_") 
          {
              $this->SC_monta_condicao($comando, "hosp_cpf_participante", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hosp_id_hotel_") 
          {
              $this->SC_monta_condicao($comando, "hosp_id_hotel", $arg_search, str_replace(",", ".", $data_search), "INT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hosp_acomodacao_") 
          {
              $this->SC_monta_condicao($comando, "hosp_acomodacao", $arg_search, str_replace(",", ".", $data_search), "INT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hosp_categoria_") 
          {
              $this->SC_monta_condicao($comando, "hosp_categoria", $arg_search, str_replace(",", ".", $data_search), "INT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hosp_status_") 
          {
              $data_lookup = $this->SC_lookup_hosp_status_($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "hosp_status", $arg_search, $data_lookup, "ENUM", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "conta_roomlist_") 
          {
              $data_lookup = $this->SC_lookup_conta_roomlist_($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "conta_roomlist", $arg_search, $data_lookup, "VARCHAR", false);
              }
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_filter_form'] . " and ((hosp_id_evento <> '0' AND hosp_tipo_pessoa = 'P'
AND id_bloqueio_hotel = '0')) and (" . $comando . ")";
      }
      else
      {
          $sc_where = " where (hosp_id_evento <> '0' AND hosp_tipo_pessoa = 'P'
AND id_bloqueio_hotel = '0') and (" . $comando . ")";
      }
      $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
      $rt = $this->Db->Execute($nmgp_select) ; 
      if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
      { 
          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit ; 
      }  
      $qt_geral_reg_form_hospedagem_rsvp_ar1 = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['total'] = $qt_geral_reg_form_hospedagem_rsvp_ar1;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_hospedagem_rsvp_ar1_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_hospedagem_rsvp_ar1_pack_ajax_response();
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
      $nm_numeric[] = "hospedagem_id";$nm_numeric[] = "hosp_id_evento";$nm_numeric[] = "hosp_id_participante";$nm_numeric[] = "hosp_id_usuario";$nm_numeric[] = "hosp_id_hotel";$nm_numeric[] = "hosp_acomodacao";$nm_numeric[] = "hosp_categoria";$nm_numeric[] = "hosp_pagamentos";$nm_numeric[] = "hosp_diarias";$nm_numeric[] = "hosp_taxas";$nm_numeric[] = "hosp_total";$nm_numeric[] = "id_bloqueio_hotel";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['decimal_db'] == ".")
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
      $Nm_datas["hosp_dt_checkin"] = "date";$Nm_datas["hosp_dt_checkout"] = "date";$Nm_datas["hosp_hr_checkin"] = "time";$Nm_datas["hosp_hr_checkout"] = "time";$Nm_datas["hosp_alteracao"] = "timestamp";
         if (isset($Nm_datas[$campo_join]))
         {
             for ($x = 0; $x < strlen($campo); $x++)
             {
                 $tst = substr($campo, $x, 1);
                 if (!is_numeric($tst) && ($tst != "-" && $tst != ":" && $tst != " "))
                 {
                     return;
                 }
             }
         }
         if (isset($Nm_datas[$campo_join]))
          {
            $nm_ini_lower = "";
             $nm_fim_lower = "";
          }
          if (isset($Nm_datas[$campo_join]))
          {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
             $nm_aspas  = "#";
             $nm_aspas1 = "#";
          }
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['SC_sep_date']))
              {
                  $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['SC_sep_date'];
                  $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['SC_sep_date1'];
              }
          }
      if (isset($Nm_datas[$campo_join]) && (strtoupper($condicao) == "II" || strtoupper($condicao) == "QP" || strtoupper($condicao) == "NP" || strtoupper($condicao) == "DF"))
      {
          if (strtoupper($condicao) == "DF")
          {
              $condicao = "NP";
          }
          if (($Nm_datas[$campo_join] == "datetime" || $Nm_datas[$campo_join] == "timestamp") && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $nome = "to_char (" . $nome . ", 'YYYY-MM-DD hh24:mi:ss')";
          }
          elseif ($Nm_datas[$campo_join] == "date" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $nome = "to_char (" . $nome . ", 'YYYY-MM-DD')";
          }
          elseif ($Nm_datas[$campo_join] == "time" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $nome = "to_char (" . $nome . ", 'hh24:mi:ss')";
          }
          elseif ($Nm_datas[$campo_join] == "date" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $nome = "convert(char(10)," . $nome . ",121)";
          }
          elseif (($Nm_datas[$campo_join] == "datetime" || $Nm_datas[$campo_join] == "timestamp") && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $nome = "convert(char(19)," . $nome . ",121)";
          }
          elseif (($Nm_datas[$campo_join] == "times" || $Nm_datas[$campo_join] == "datetime" || $Nm_datas[$campo_join] == "timestamp") && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $nome  = "TO_DATE(TO_CHAR(" . $nome . ", 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss')";
          }
          elseif ($Nm_datas[$campo_join] == "datetime" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $nome = "EXTEND(" . $nome . ", YEAR TO FRACTION)";
          }
          elseif ($Nm_datas[$campo_join] == "date" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $nome = "EXTEND(" . $nome . ", YEAR TO DAY)";
          }
          elseif ($Nm_datas[$campo_join] == "datetime" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
          {
              $nome = "to_char (" . $nome . ", 'YYYY-MM-DD hh24:mi:ss')";
          }
          elseif ($Nm_datas[$campo_join] == "date" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
          {
              $nome = "to_char (" . $nome . ", 'YYYY-MM-DD')";
          }
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
   function SC_lookup_hosp_status_($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['A'] = "Aberto";
       $data_look['Y'] = "Sim";
       $data_look['N'] = "Não";
       $data_look['P'] = "Pendente";
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
   function SC_lookup_conta_roomlist_($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['NAO'] = "Não";
       $data_look['SIM'] = "Sim";
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
   function html_dynamic_search()
   {
       $this->Dyn_search_seq = 0;
       $this->Dyn_search_str = "";
       $this->Dyn_search_dat = array();
       $this->NM_case_insensitive = true;
      $this->Dyn_search_str = "";
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['cond_pesq']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['cond_pesq']))
       {
           $tmp = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['cond_pesq'];
           $pos = strrpos($tmp, "##*@@");
           if ($pos !== false)
           {
               $and_or = (substr($tmp, ($pos + 5)) == "and") ? $this->Ini->Nm_lang['lang_srch_and_cond'] : $this->Ini->Nm_lang['lang_srch_orr_cond'];
               $tmp    = substr($tmp, 0, $pos);
               $this->Dyn_search_str = str_replace("##*@@", " " . $and_or . " ", $tmp);
           }
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_label'] = array();
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_label']['hosp_id_evento_'] = (isset($this->New_label['hosp_id_evento_'])) ? $this->New_label['hosp_id_evento_'] : "Cód. Evento";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_label']['hosp_id_hotel_'] = (isset($this->New_label['hosp_id_hotel_'])) ? $this->New_label['hosp_id_hotel_'] : "Cód. Hotel";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_label']['hosp_acomodacao_'] = (isset($this->New_label['hosp_acomodacao_'])) ? $this->New_label['hosp_acomodacao_'] : "Cód.  Acomodação";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_label']['hosp_categoria_'] = (isset($this->New_label['hosp_categoria_'])) ? $this->New_label['hosp_categoria_'] : "Cód. Categoria";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_label']['hosp_cpf_participante_'] = (isset($this->New_label['hosp_cpf_participante_'])) ? $this->New_label['hosp_cpf_participante_'] : "Cód. Participante";
       if ($this->NM_ajax_flag)
       { 
          ob_start();
       } 
       else 
       { 
?>
   <script type="text/javascript">
     var mens_select2_notfound  = '<?php echo $this->Ini->Nm_lang['lang_autocomp_notfound'] ?>';
     var mens_select2_searching = '<?php echo $this->Ini->Nm_lang['lang_autocomp_searching'] ?>';
   </script>
   <tr id="NM_Dynamic_Search">
<?php
       } 
?>
   <td  valign="top"> 
<?php
   $_display = (empty($this->Dyn_search_str)?'none':'');
?>
   <span id='id_dyn_search_cmd_string' style="display:<?php echo $_display ?>; "> 
   <div class="scAppDivMoldura " style="display:flex; justify-content:space-between;"> 
    <div style='display:flex; gap:5px; align-items:center;'> 
     <span class="scAppDivHeaderText" style='display:flex; align-items:center;'>
<?php
             if (is_file($this->Ini->root . $this->Ini->path_img_global . '/' . $this->Ini->App_div_tree_img_exp))
             {
?>
                             <a id='a_id_dyn_search_cmd_string' href="#" onclick="$('#id_dyn_search_cmd_string').hide();$('#div_dyn_search').show();SC_carga_evt_jquery('all');SC_select2_dyn();" style="text-decoration:none; vertical-align: baseline;">
                                     <img id='id_app_div_tree_img_exp' src="<?php echo $this->Ini->path_img_global ?>/<?php echo $this->Ini->App_div_tree_img_exp ?>" border=0 align='absmiddle' style='vertical-align: middle; margin-right:4px;'>
                             </a>
                             <i class='fa-solid fa-filter' style='margin-right: 5px;'></i>
<?php
             }
             echo $this->Ini->Nm_lang['lang_othr_dynamicsearch_title_outside'];
?>
     </span>
     <span id='id_dyn_search_cmd_str' class="scAppDivContentText scGridFilterDynResult" style='white-space: pre-wrap;vertical-align: baseline;'><?php echo trim($this->Dyn_search_str) ?></span>
    </div> 
   </div> 
    </span> 
   <div id="div_dyn_search" style="display: none" class="scAppDivMoldura"> 
     <input type="hidden" name="parm_dyn_search" value=""/> 
    <table style="padding: 0px; border-spacing: 0px; border-width: 0px; vertical-align: top; width: 100%;" valign="top" cellspacing=0 cellpadding=0>
      <tr>
        <td class="scAppDivHeader scAppDivHeaderText">
<?php
             if (is_file($this->Ini->root . $this->Ini->path_img_global . '/' . $this->Ini->App_div_tree_img_col))
             {
?>
                             <a id="nm_close_dyn" href="#" onclick="$('#div_dyn_search').hide(); if($('#id_dyn_search_cmd_str').html() != ''){ $('#id_dyn_search_cmd_string').show(); }" style="text-decoration:none">
                                     <img id='id_app_div_tree_img_col' src="<?php echo $this->Ini->path_img_global ?>/<?php echo $this->Ini->App_div_tree_img_col ?>" border=0 align='absmiddle' style='vertical-align: middle; margin-right:4px;'>
                             </a>
<?php
             }
?>
            <?php echo $this->Ini->Nm_lang['lang_othr_dynamicsearch_title'] ?>
        </td>
      </tr>
      <tr>
        <td class="scAppDivContent scAppDivContentText">
            <div id="table_dyn_search">
<?php
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search']))
       {
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search'] as $IX => $def)
           {
               $cmp = $def['cmp'];
               if ($cmp == "hosp_id_evento_")
               {
                   $this->Dyn_search_seq++;;
                   $this->Dyn_search_dat[$this->Dyn_search_seq] = "hosp_id_evento_";
                   $lin_obj = $this->dynamic_search_hosp_id_evento_($this->Dyn_search_seq, 'N', $def['opc'], $def['val']);
                   echo $lin_obj;
               }
               if ($cmp == "hosp_id_hotel_")
               {
                   $this->Dyn_search_seq++;;
                   $this->Dyn_search_dat[$this->Dyn_search_seq] = "hosp_id_hotel_";
                   $lin_obj = $this->dynamic_search_hosp_id_hotel_($this->Dyn_search_seq, 'N', $def['opc'], $def['val']);
                   echo $lin_obj;
               }
               if ($cmp == "hosp_acomodacao_")
               {
                   $this->Dyn_search_seq++;;
                   $this->Dyn_search_dat[$this->Dyn_search_seq] = "hosp_acomodacao_";
                   $lin_obj = $this->dynamic_search_hosp_acomodacao_($this->Dyn_search_seq, 'N', $def['opc'], $def['val']);
                   echo $lin_obj;
               }
               if ($cmp == "hosp_categoria_")
               {
                   $this->Dyn_search_seq++;;
                   $this->Dyn_search_dat[$this->Dyn_search_seq] = "hosp_categoria_";
                   $lin_obj = $this->dynamic_search_hosp_categoria_($this->Dyn_search_seq, 'N', $def['opc'], $def['val']);
                   echo $lin_obj;
               }
               if ($cmp == "hosp_cpf_participante_")
               {
                   $this->Dyn_search_seq++;;
                   $this->Dyn_search_dat[$this->Dyn_search_seq] = "hosp_cpf_participante_";
                   $lin_obj = $this->dynamic_search_hosp_cpf_participante_($this->Dyn_search_seq, 'N', $def['opc'], $def['val']);
                   echo $lin_obj;
               }
           }
       }
?>
                </div>
<?php
?>
            </td>
        </tr>
        <tr>
            <td nowrap  class="scAppDivToolbar">
       <?php echo nmButtonOutput($this->arr_buttons, "bapply_appdiv", "nm_show_dynamicsearch_fields(); return false;", "nm_show_dynamicsearch_fields(); return false;", "id_dyn_search_fields", "", "" . $this->Ini->Nm_lang['lang_othr_dynamicsearch_fields'] . "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
      &nbsp;&nbsp;&nbsp;
      <table id='id_dynamic_search_fields' class='SC_SubMenuApp' style='display:none; position: absolute; border-collapse: collapse; z-index: 1000;'> 
        <tr>
            <td class='scBtnGrpBackground'>
                <div class='scBtnGrpText' style='cursor: pointer;' onclick="ajax_add_dyn_search('hosp_id_evento_', 'form')"><?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_label']['hosp_id_evento_'] ?>
                </div>
            </td>
        </tr>
        <tr>
            <td class='scBtnGrpBackground'>
                <div class='scBtnGrpText' style='cursor: pointer;' onclick="ajax_add_dyn_search('hosp_id_hotel_', 'form')"><?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_label']['hosp_id_hotel_'] ?>
                </div>
            </td>
        </tr>
        <tr>
            <td class='scBtnGrpBackground'>
                <div class='scBtnGrpText' style='cursor: pointer;' onclick="ajax_add_dyn_search('hosp_acomodacao_', 'form')"><?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_label']['hosp_acomodacao_'] ?>
                </div>
            </td>
        </tr>
        <tr>
            <td class='scBtnGrpBackground'>
                <div class='scBtnGrpText' style='cursor: pointer;' onclick="ajax_add_dyn_search('hosp_categoria_', 'form')"><?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_label']['hosp_categoria_'] ?>
                </div>
            </td>
        </tr>
        <tr>
            <td class='scBtnGrpBackground'>
                <div class='scBtnGrpText' style='cursor: pointer;' onclick="ajax_add_dyn_search('hosp_cpf_participante_', 'form')"><?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_label']['hosp_cpf_participante_'] ?>
                </div>
            </td>
        </tr>
      </table> 
       <?php echo nmButtonOutput($this->arr_buttons, "bapply_appdiv", "setTimeout(function() {proc_btn_dyn('dyn_search', 'nm_proc_dyn_search(\\'id_Fdyn_search\\', \\'dyn_search\\')');}, 300);", "setTimeout(function() {proc_btn_dyn('dyn_search', 'nm_proc_dyn_search(\\'id_Fdyn_search\\', \\'dyn_search\\')');}, 300);", "dyn_search", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
       &nbsp;&nbsp;&nbsp;
       <?php echo nmButtonOutput($this->arr_buttons, "bdyn_clear", "proc_btn_dyn('dyn_search_clear', 'nm_clear_dyn_search()')", "proc_btn_dyn('dyn_search_clear', 'nm_clear_dyn_search()')", "dyn_search_clear", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
      &nbsp;&nbsp;&nbsp;
       <?php echo nmButtonOutput($this->arr_buttons, "bcancelar_appdiv", "nm_cancel_dyn_search();", "nm_cancel_dyn_search();", "dyn_cancel", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
       <?php echo nmButtonOutput($this->arr_buttons, "bdyn_remove", "if(!$('#dyn_search_clear').hasClass('disabled')){ $('#dyn_search_clear').click(); } if(!$('#dyn_search').hasClass('disabled')){ $('#dyn_search').click(); }else{ $('#dyn_cancel').click(); }", "if(!$('#dyn_search_clear').hasClass('disabled')){ $('#dyn_search_clear').click(); } if(!$('#dyn_search').hasClass('disabled')){ $('#dyn_search').click(); }else{ $('#dyn_cancel').click(); }", "bdyn_remove", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
        </td>
    </tr>
    </table>
   </div>
   </td>
<?php
       if ($this->NM_ajax_flag)
       { 
           $Temp = ob_get_clean();
           $this->NM_ajax_info['dyn_search']['NM_Dynamic_Search'] = NM_charset_to_utf8(trim($Temp));
           $this->NM_ajax_info['dyn_search']['id_dyn_search_cmd_str'] = NM_charset_to_utf8(trim($this->Dyn_search_str));
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_clear']))
           { 
               unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_clear']);
           } 
           $this->NM_ajax_info['varList'][] = array('Tot_obj_dyn_search'=>$this->Dyn_search_seq);
           $this->NM_ajax_info['varList'][] = array('Tab_obj_dyn_search'=>'new Array()');
           $this->NM_ajax_info['varList'][] = array('Cmp_select2_ok'=>false);
           $this->NM_ajax_info['ajaxJavascript'][] = array('SC_carga_evt_jquery', 'all');
           $this->NM_ajax_info['ajaxJavascript'][] = array('SC_select2_dyn', '');
           return;
       } 
?>
   </tr>
<?php
       $this->JS_dynamic_search();
   }
   function dynamic_search_hosp_id_evento_($ind, $ajax, $opc="", $val=array(), $enabled = 'S')
   {
       $lin_obj  = "";
       $_classAlign = '';
       if (empty($opc))
       {
           $opc = "gt";
       }
       if ($opc=='bw')
       {
           $_classAlign = 'alignTop';
       }
       $lin_obj .= "     <div id='dyn_search_hosp_id_evento__" . $ind . "' class='align " . $_classAlign . " " . ($enabled=='S'?'':'disabled') . "'>";
       $lin_obj .= "      <i class='fa-solid fa-grip-lines-vertical drag_handle'></i>";
       $lin_obj .= "      <div class='fixed_width_select'>";
       $lin_obj .= "         <div class='width-constrain' style='display: '>";
       $lin_obj .= "         " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_label']['hosp_id_evento_'] . "";
       $lin_obj .= "         </div>";
       $lin_obj .= "        </div>";
       $lin_obj .= "      <div class='fixed_width_conditions'>";
       $lin_obj .= "       <select id='dyn_search_hosp_id_evento__cond_" . $ind . "' name='cond_dyn_search_hosp_id_evento__" . $ind . "' class='scAppDivToolbarInput' style='vertical-align: middle;' onChange='buttonEnable_dyn(\"dyn_search\");dyn_search_hide_input(\"hosp_id_evento_\", $ind)'>";
       $selected = ($opc == "gt") ? " selected" : "";
       $lin_obj .= "        <option value='gt'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_grtr'] . "</option>";
       $selected = ($opc == "lt") ? " selected" : "";
       $lin_obj .= "        <option value='lt'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_less'] . "</option>";
       $selected = ($opc == "eq") ? " selected" : "";
       $lin_obj .= "        <option value='eq'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_exac'] . "</option>";
       $lin_obj .= "       </select>";
       $lin_obj .= "      </div>";
       $display_in_1 = "''";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne")
       {
           $display_in_1 = "none";
       }
       $lin_obj .= "      <div class='fixed_width_input fixed_width_input100 '>";
       $lin_obj .= "        <span class='fixed_width_input_content' style='display:" . $display_in_1 . "'>";
       $val_cmp = (isset($val[0][0])) ? $val[0][0] : "";
       $lin_obj .= "     <input  type=\"text\" class='sc-js-input-dyn scFormObjectOdd scAppDivToolbarInput' id='dyn_search_hosp_id_evento__val_" . $ind . "' name='val_dyn_search_hosp_id_evento__" . $ind . "' onChange=\"buttonEnable_dyn('dyn_search');\" value=\"" . $this->form_encode_input($val_cmp) . "\" size=11 alt=\"{datatype: 'decimal', maxLength: 11, precision: 0, decimalSep: '" . $_SESSION['scriptcase']['reg_conf']['dec_num'] . "', thousandsSep: '" . $_SESSION['scriptcase']['reg_conf']['grup_num'] . "', allowNegative: false, onlyNegative: false, enterTab: false}\" >";
       $lin_obj .= "        </span>";
       $lin_obj .= "      </div>";
       $lin_obj .= "       <div class='fixed_width_toolbar'>";
       $lin_obj .= "       <img class='dyn_search_field_close' id='dyn_search_hosp_id_evento__close_" . $ind . "' src='" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "' onclick=\"del_dyn_search('dyn_search_hosp_id_evento__" . $ind . "', " . $ind . ", 'only');buttonEnable_dyn('dyn_search');\">";
       $enabled = 'S';
       $lin_obj .= "         <input type='hidden' class='dyn_search_enabled' name='dyn_search_enabled_hosp_id_evento__" . $ind . "'  id='dyn_search_enabled_hosp_id_evento__" . $ind . "' value='" . $enabled . "' />";
       $lin_obj .= "       </div>";
       $lin_obj .= "     </div>";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne") {
           $lin_obj .= "     <script>";
           $lin_obj .= "        $( document ).ready(function() {buttonEnable_dyn('dyn_search');});";
           $lin_obj .= "     </script>";
       }
       return $lin_obj;
   }
   function dynamic_search_hosp_id_hotel_($ind, $ajax, $opc="", $val=array(), $enabled = 'S')
   {
       $lin_obj  = "";
       $_classAlign = '';
       if (empty($opc))
       {
           $opc = "gt";
       }
       if ($opc=='bw')
       {
           $_classAlign = 'alignTop';
       }
       $lin_obj .= "     <div id='dyn_search_hosp_id_hotel__" . $ind . "' class='align " . $_classAlign . " " . ($enabled=='S'?'':'disabled') . "'>";
       $lin_obj .= "      <i class='fa-solid fa-grip-lines-vertical drag_handle'></i>";
       $lin_obj .= "      <div class='fixed_width_select'>";
       $lin_obj .= "         <div class='width-constrain' style='display: '>";
       $lin_obj .= "         " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_label']['hosp_id_hotel_'] . "";
       $lin_obj .= "         </div>";
       $lin_obj .= "        </div>";
       $lin_obj .= "      <div class='fixed_width_conditions'>";
       $lin_obj .= "       <select id='dyn_search_hosp_id_hotel__cond_" . $ind . "' name='cond_dyn_search_hosp_id_hotel__" . $ind . "' class='scAppDivToolbarInput' style='vertical-align: middle;' onChange='buttonEnable_dyn(\"dyn_search\");dyn_search_hide_input(\"hosp_id_hotel_\", $ind)'>";
       $selected = ($opc == "gt") ? " selected" : "";
       $lin_obj .= "        <option value='gt'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_grtr'] . "</option>";
       $selected = ($opc == "lt") ? " selected" : "";
       $lin_obj .= "        <option value='lt'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_less'] . "</option>";
       $selected = ($opc == "eq") ? " selected" : "";
       $lin_obj .= "        <option value='eq'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_exac'] . "</option>";
       $lin_obj .= "       </select>";
       $lin_obj .= "      </div>";
       $display_in_1 = "''";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne")
       {
           $display_in_1 = "none";
       }
       $lin_obj .= "      <div class='fixed_width_input fixed_width_input100 '>";
       $lin_obj .= "        <span class='fixed_width_input_content' style='display:" . $display_in_1 . "'>";
       $val_cmp = (isset($val[0][0])) ? $val[0][0] : "";
       $lin_obj .= "     <input  type=\"text\" class='sc-js-input-dyn scFormObjectOdd scAppDivToolbarInput' id='dyn_search_hosp_id_hotel__val_" . $ind . "' name='val_dyn_search_hosp_id_hotel__" . $ind . "' onChange=\"buttonEnable_dyn('dyn_search');\" value=\"" . $this->form_encode_input($val_cmp) . "\" size=11 alt=\"{datatype: 'decimal', maxLength: 11, precision: 0, decimalSep: '" . $_SESSION['scriptcase']['reg_conf']['dec_num'] . "', thousandsSep: '" . $_SESSION['scriptcase']['reg_conf']['grup_num'] . "', allowNegative: false, onlyNegative: false, enterTab: false}\" >";
       $lin_obj .= "        </span>";
       $lin_obj .= "      </div>";
       $lin_obj .= "       <div class='fixed_width_toolbar'>";
       $lin_obj .= "       <img class='dyn_search_field_close' id='dyn_search_hosp_id_hotel__close_" . $ind . "' src='" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "' onclick=\"del_dyn_search('dyn_search_hosp_id_hotel__" . $ind . "', " . $ind . ", 'only');buttonEnable_dyn('dyn_search');\">";
       $enabled = 'S';
       $lin_obj .= "         <input type='hidden' class='dyn_search_enabled' name='dyn_search_enabled_hosp_id_hotel__" . $ind . "'  id='dyn_search_enabled_hosp_id_hotel__" . $ind . "' value='" . $enabled . "' />";
       $lin_obj .= "       </div>";
       $lin_obj .= "     </div>";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne") {
           $lin_obj .= "     <script>";
           $lin_obj .= "        $( document ).ready(function() {buttonEnable_dyn('dyn_search');});";
           $lin_obj .= "     </script>";
       }
       return $lin_obj;
   }
   function dynamic_search_hosp_acomodacao_($ind, $ajax, $opc="", $val=array(), $enabled = 'S')
   {
       $lin_obj  = "";
       $_classAlign = '';
       if (empty($opc))
       {
           $opc = "gt";
       }
       if ($opc=='bw')
       {
           $_classAlign = 'alignTop';
       }
       $lin_obj .= "     <div id='dyn_search_hosp_acomodacao__" . $ind . "' class='align " . $_classAlign . " " . ($enabled=='S'?'':'disabled') . "'>";
       $lin_obj .= "      <i class='fa-solid fa-grip-lines-vertical drag_handle'></i>";
       $lin_obj .= "      <div class='fixed_width_select'>";
       $lin_obj .= "         <div class='width-constrain' style='display: '>";
       $lin_obj .= "         " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_label']['hosp_acomodacao_'] . "";
       $lin_obj .= "         </div>";
       $lin_obj .= "        </div>";
       $lin_obj .= "      <div class='fixed_width_conditions'>";
       $lin_obj .= "       <select id='dyn_search_hosp_acomodacao__cond_" . $ind . "' name='cond_dyn_search_hosp_acomodacao__" . $ind . "' class='scAppDivToolbarInput' style='vertical-align: middle;' onChange='buttonEnable_dyn(\"dyn_search\");dyn_search_hide_input(\"hosp_acomodacao_\", $ind)'>";
       $selected = ($opc == "gt") ? " selected" : "";
       $lin_obj .= "        <option value='gt'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_grtr'] . "</option>";
       $selected = ($opc == "lt") ? " selected" : "";
       $lin_obj .= "        <option value='lt'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_less'] . "</option>";
       $selected = ($opc == "eq") ? " selected" : "";
       $lin_obj .= "        <option value='eq'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_exac'] . "</option>";
       $lin_obj .= "       </select>";
       $lin_obj .= "      </div>";
       $display_in_1 = "''";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne")
       {
           $display_in_1 = "none";
       }
       $lin_obj .= "      <div class='fixed_width_input fixed_width_input100 '>";
       $lin_obj .= "        <span class='fixed_width_input_content' style='display:" . $display_in_1 . "'>";
       $val_cmp = (isset($val[0][0])) ? $val[0][0] : "";
       $lin_obj .= "     <input  type=\"text\" class='sc-js-input-dyn scFormObjectOdd scAppDivToolbarInput' id='dyn_search_hosp_acomodacao__val_" . $ind . "' name='val_dyn_search_hosp_acomodacao__" . $ind . "' onChange=\"buttonEnable_dyn('dyn_search');\" value=\"" . $this->form_encode_input($val_cmp) . "\" size=11 alt=\"{datatype: 'decimal', maxLength: 11, precision: 0, decimalSep: '" . $_SESSION['scriptcase']['reg_conf']['dec_num'] . "', thousandsSep: '" . $_SESSION['scriptcase']['reg_conf']['grup_num'] . "', allowNegative: false, onlyNegative: false, enterTab: false}\" >";
       $lin_obj .= "        </span>";
       $lin_obj .= "      </div>";
       $lin_obj .= "       <div class='fixed_width_toolbar'>";
       $lin_obj .= "       <img class='dyn_search_field_close' id='dyn_search_hosp_acomodacao__close_" . $ind . "' src='" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "' onclick=\"del_dyn_search('dyn_search_hosp_acomodacao__" . $ind . "', " . $ind . ", 'only');buttonEnable_dyn('dyn_search');\">";
       $enabled = 'S';
       $lin_obj .= "         <input type='hidden' class='dyn_search_enabled' name='dyn_search_enabled_hosp_acomodacao__" . $ind . "'  id='dyn_search_enabled_hosp_acomodacao__" . $ind . "' value='" . $enabled . "' />";
       $lin_obj .= "       </div>";
       $lin_obj .= "     </div>";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne") {
           $lin_obj .= "     <script>";
           $lin_obj .= "        $( document ).ready(function() {buttonEnable_dyn('dyn_search');});";
           $lin_obj .= "     </script>";
       }
       return $lin_obj;
   }
   function dynamic_search_hosp_categoria_($ind, $ajax, $opc="", $val=array(), $enabled = 'S')
   {
       $lin_obj  = "";
       $_classAlign = '';
       if (empty($opc))
       {
           $opc = "gt";
       }
       if ($opc=='bw')
       {
           $_classAlign = 'alignTop';
       }
       $lin_obj .= "     <div id='dyn_search_hosp_categoria__" . $ind . "' class='align " . $_classAlign . " " . ($enabled=='S'?'':'disabled') . "'>";
       $lin_obj .= "      <i class='fa-solid fa-grip-lines-vertical drag_handle'></i>";
       $lin_obj .= "      <div class='fixed_width_select'>";
       $lin_obj .= "         <div class='width-constrain' style='display: '>";
       $lin_obj .= "         " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_label']['hosp_categoria_'] . "";
       $lin_obj .= "         </div>";
       $lin_obj .= "        </div>";
       $lin_obj .= "      <div class='fixed_width_conditions'>";
       $lin_obj .= "       <select id='dyn_search_hosp_categoria__cond_" . $ind . "' name='cond_dyn_search_hosp_categoria__" . $ind . "' class='scAppDivToolbarInput' style='vertical-align: middle;' onChange='buttonEnable_dyn(\"dyn_search\");dyn_search_hide_input(\"hosp_categoria_\", $ind)'>";
       $selected = ($opc == "gt") ? " selected" : "";
       $lin_obj .= "        <option value='gt'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_grtr'] . "</option>";
       $selected = ($opc == "lt") ? " selected" : "";
       $lin_obj .= "        <option value='lt'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_less'] . "</option>";
       $selected = ($opc == "eq") ? " selected" : "";
       $lin_obj .= "        <option value='eq'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_exac'] . "</option>";
       $lin_obj .= "       </select>";
       $lin_obj .= "      </div>";
       $display_in_1 = "''";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne")
       {
           $display_in_1 = "none";
       }
       $lin_obj .= "      <div class='fixed_width_input fixed_width_input100 '>";
       $lin_obj .= "        <span class='fixed_width_input_content' style='display:" . $display_in_1 . "'>";
       $val_cmp = (isset($val[0][0])) ? $val[0][0] : "";
       $lin_obj .= "     <input  type=\"text\" class='sc-js-input-dyn scFormObjectOdd scAppDivToolbarInput' id='dyn_search_hosp_categoria__val_" . $ind . "' name='val_dyn_search_hosp_categoria__" . $ind . "' onChange=\"buttonEnable_dyn('dyn_search');\" value=\"" . $this->form_encode_input($val_cmp) . "\" size=11 alt=\"{datatype: 'decimal', maxLength: 11, precision: 0, decimalSep: '" . $_SESSION['scriptcase']['reg_conf']['dec_num'] . "', thousandsSep: '" . $_SESSION['scriptcase']['reg_conf']['grup_num'] . "', allowNegative: false, onlyNegative: false, enterTab: false}\" >";
       $lin_obj .= "        </span>";
       $lin_obj .= "      </div>";
       $lin_obj .= "       <div class='fixed_width_toolbar'>";
       $lin_obj .= "       <img class='dyn_search_field_close' id='dyn_search_hosp_categoria__close_" . $ind . "' src='" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "' onclick=\"del_dyn_search('dyn_search_hosp_categoria__" . $ind . "', " . $ind . ", 'only');buttonEnable_dyn('dyn_search');\">";
       $enabled = 'S';
       $lin_obj .= "         <input type='hidden' class='dyn_search_enabled' name='dyn_search_enabled_hosp_categoria__" . $ind . "'  id='dyn_search_enabled_hosp_categoria__" . $ind . "' value='" . $enabled . "' />";
       $lin_obj .= "       </div>";
       $lin_obj .= "     </div>";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne") {
           $lin_obj .= "     <script>";
           $lin_obj .= "        $( document ).ready(function() {buttonEnable_dyn('dyn_search');});";
           $lin_obj .= "     </script>";
       }
       return $lin_obj;
   }
   function dynamic_search_hosp_cpf_participante_($ind, $ajax, $opc="", $val=array(), $enabled = 'S')
   {
       $lin_obj  = "";
       $_classAlign = '';
       if (empty($opc))
       {
           $opc = "qp";
       }
       if ($opc=='bw')
       {
           $_classAlign = 'alignTop';
       }
       $lin_obj .= "     <div id='dyn_search_hosp_cpf_participante__" . $ind . "' class='align " . $_classAlign . " " . ($enabled=='S'?'':'disabled') . "'>";
       $lin_obj .= "      <i class='fa-solid fa-grip-lines-vertical drag_handle'></i>";
       $lin_obj .= "      <div class='fixed_width_select'>";
       $lin_obj .= "         <div class='width-constrain' style='display: '>";
       $lin_obj .= "         " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_label']['hosp_cpf_participante_'] . "";
       $lin_obj .= "         </div>";
       $lin_obj .= "        </div>";
       $lin_obj .= "      <div class='fixed_width_conditions'>";
       $lin_obj .= "       <select id='dyn_search_hosp_cpf_participante__cond_" . $ind . "' name='cond_dyn_search_hosp_cpf_participante__" . $ind . "' class='scAppDivToolbarInput' style='vertical-align: middle;' onChange='buttonEnable_dyn(\"dyn_search\");dyn_search_hide_input(\"hosp_cpf_participante_\", $ind)'>";
       $selected = ($opc == "qp") ? " selected" : "";
       $lin_obj .= "        <option value='qp'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_like'] . "</option>";
       $selected = ($opc == "np") ? " selected" : "";
       $lin_obj .= "        <option value='np'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_not_like'] . "</option>";
       $selected = ($opc == "eq") ? " selected" : "";
       $lin_obj .= "        <option value='eq'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_exac'] . "</option>";
       $selected = ($opc == "ep") ? " selected" : "";
       $lin_obj .= "        <option value='ep'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_empty'] . "</option>";
       $lin_obj .= "       </select>";
       $lin_obj .= "      </div>";
       $display_in_1 = "''";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne")
       {
           $display_in_1 = "none";
       }
       $lin_obj .= "      <div class='fixed_width_input fixed_width_input100 '>";
       $lin_obj .= "        <span class='fixed_width_input_content' style='display:" . $display_in_1 . "'>";
       $val_cmp = (isset($val[0][0])) ? $val[0][0] : "";
       $lin_obj .= "     <input  type=\"text\" class='sc-js-input-dyn scFormObjectOdd scAppDivToolbarInput' id='dyn_search_hosp_cpf_participante__val_" . $ind . "' name='val_dyn_search_hosp_cpf_participante__" . $ind . "' onChange=\"buttonEnable_dyn('dyn_search');\" value=\"" . $this->form_encode_input($val_cmp) . "\" size=13 alt=\"{datatype: 'text', maxLength: 13, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}\" >";
       $lin_obj .= "        </span>";
       $lin_obj .= "      </div>";
       $lin_obj .= "       <div class='fixed_width_toolbar'>";
       $lin_obj .= "       <img class='dyn_search_field_close' id='dyn_search_hosp_cpf_participante__close_" . $ind . "' src='" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "' onclick=\"del_dyn_search('dyn_search_hosp_cpf_participante__" . $ind . "', " . $ind . ", 'only');buttonEnable_dyn('dyn_search');\">";
       $enabled = 'S';
       $lin_obj .= "         <input type='hidden' class='dyn_search_enabled' name='dyn_search_enabled_hosp_cpf_participante__" . $ind . "'  id='dyn_search_enabled_hosp_cpf_participante__" . $ind . "' value='" . $enabled . "' />";
       $lin_obj .= "       </div>";
       $lin_obj .= "     </div>";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne") {
           $lin_obj .= "     <script>";
           $lin_obj .= "        $( document ).ready(function() {buttonEnable_dyn('dyn_search');});";
           $lin_obj .= "     </script>";
       }
       return $lin_obj;
   }
   function dynamicSearchStartHtmlRec($arr_arvore, $str_id)
   {
       global $nm_saida, $contUl, $contFields;
       $str_filhos = '';
       if(isset($arr_arvore['fields']) && !empty($arr_arvore['fields']))
       {
           foreach($arr_arvore['fields'] as $chield)
           {
               $str_filhos .= "<li class='df-item' role='treeitem'>";
               if($chield['type'] == 'ul')
               {
                   $contUl++;
                   $str_filhos .= $this->dynamicSearchStartHtmlRec($chield, $str_id . $contUl);
               }
               else
               {
                   $bol_found = false;
                   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_and_or']['old'] as $_tmp)
                   {
                       if($chield['field'] == 'dyn_search_'. $_tmp['cmp'] .'_' . $_tmp['seq'])
                       {
                           $def = $_tmp;
                           $bol_found = true;
                           break;
                       }
                   }
                   if(!$bol_found)
                   {
                       $def['opc'] = $chield['opc'];
                       $def['val'] = array(array());
                       $def['Res_chk'] = '';
                   }
                   if ($def['cmp'] == "hosp_id_evento_")
                   {
                       $this->Dyn_search_seq++;;
                       $this->Dyn_search_dat[$this->Dyn_search_seq] = "hosp_id_evento_";
                       $str_filhos .= $this->dynamic_search_hosp_id_evento_($this->Dyn_search_seq, 'N', $def['opc'], $def['val'], $chield['enabled']);
                   }
                   if ($def['cmp'] == "hosp_id_hotel_")
                   {
                       $this->Dyn_search_seq++;;
                       $this->Dyn_search_dat[$this->Dyn_search_seq] = "hosp_id_hotel_";
                       $str_filhos .= $this->dynamic_search_hosp_id_hotel_($this->Dyn_search_seq, 'N', $def['opc'], $def['val'], $chield['enabled']);
                   }
                   if ($def['cmp'] == "hosp_acomodacao_")
                   {
                       $this->Dyn_search_seq++;;
                       $this->Dyn_search_dat[$this->Dyn_search_seq] = "hosp_acomodacao_";
                       $str_filhos .= $this->dynamic_search_hosp_acomodacao_($this->Dyn_search_seq, 'N', $def['opc'], $def['val'], $chield['enabled']);
                   }
                   if ($def['cmp'] == "hosp_categoria_")
                   {
                       $this->Dyn_search_seq++;;
                       $this->Dyn_search_dat[$this->Dyn_search_seq] = "hosp_categoria_";
                       $str_filhos .= $this->dynamic_search_hosp_categoria_($this->Dyn_search_seq, 'N', $def['opc'], $def['val'], $chield['enabled']);
                   }
                   if ($def['cmp'] == "hosp_cpf_participante_")
                   {
                       $this->Dyn_search_seq++;;
                       $this->Dyn_search_dat[$this->Dyn_search_seq] = "hosp_cpf_participante_";
                       $str_filhos .= $this->dynamic_search_hosp_cpf_participante_($this->Dyn_search_seq, 'N', $def['opc'], $def['val'], $chield['enabled']);
                   }
               }
               $str_filhos .= '</li>';
           }
       }
       $conditionAnd = (!isset($arr_arvore['condition']) || $arr_arvore['condition'] != 'OR')?'true':'false';
       $conditionOr = (isset($arr_arvore['condition']) && $arr_arvore['condition'] == 'OR')?'true':'false';
       $Cod_Btn_grp_ini = nmButtonGroupOutput($this->arr_buttons,'bdyn_and', 'ini');
       $Cod_Btn_grp_end = nmButtonGroupOutput($this->arr_buttons,'bdyn_and', 'fim');
           $enabled = 'S';
           $Cod_Btn_enable = '';
           $Cod_Btn_disable = '';
           $_str_js = '';
      ob_start();
      ?>
      <div class="group">        <div class="df-toolbar" role="toolbar" id="<?php echo $str_id; ?>">          <i class="fa-solid fa-grip-lines-vertical drag_handle"></i>          <input type="hidden" class="dyn_nested_enabled" value="<?php echo $enabled; ?>" />          <span class="df-button-group" style="position:relative;" role="group" title="<?php echo $this->Ini->Nm_lang['lang_othr_dynamicsearch_condition']; ?> ">              <?php              echo $Cod_Btn_grp_ini;                      $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['btn_disabled']['bdyn_and']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['btn_disabled']['bdyn_and']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['btn_label']['bdyn_and']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['btn_label']['bdyn_and']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['btn_label']['bdyn_and'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bdyn_and", "", "", "bdyn_and", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "data-role=togglebutton aria-value='AND' aria-pressed=" . $conditionAnd . "");?>
 
<?php
                      $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['btn_disabled']['bdyn_or']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['btn_disabled']['bdyn_or']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['btn_label']['bdyn_or']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['btn_label']['bdyn_or']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['btn_label']['bdyn_or'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bdyn_or", "", "", "bdyn_or", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "data-role=togglebutton aria-value='OR' aria-pressed=" . $conditionOr . "");?>
 
<?php
              echo $Cod_Btn_grp_end;              ?>          </span>              <?php                  $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['btn_disabled']['bdyn_addfields_nested']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['btn_disabled']['bdyn_addfields_nested']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['btn_label']['bdyn_addfields_nested']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['btn_label']['bdyn_addfields_nested']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['btn_label']['bdyn_addfields_nested'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bdyn_addfields_nested", "nm_show_dynamicsearch_fields_2(this); return false;", "nm_show_dynamicsearch_fields_2(this); return false;", "bdyn_addfields_nested", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
                  $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['btn_disabled']['bdyn_nested_add']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['btn_disabled']['bdyn_nested_add']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['btn_label']['bdyn_nested_add']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['btn_label']['bdyn_nested_add']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['btn_label']['bdyn_nested_add'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bdyn_nested_add", "addGroup(this);", "addGroup(this);", "bdyn_nested_add", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
                  $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['btn_disabled']['bdyn_nested_remove']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['btn_disabled']['bdyn_nested_remove']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['btn_label']['bdyn_nested_remove']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['btn_label']['bdyn_nested_remove']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['btn_label']['bdyn_nested_remove'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bdyn_nested_remove", "clearDynamicFilter(this);", "clearDynamicFilter(this);", "bdyn_nested_remove", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
              ?>        </div>      <script>$( document ).ready(function() { $("#<?php echo $str_id; ?> [aria-pressed=true]").addClass("selected"); <?php echo $_str_js; ?> });</script>      <ul class="df-lines" data-role="maincontent" role="group" id="ul_<?php echo $str_id; ?>"><?php echo $str_filhos; ?></ul>      </div>      <?php
      return ob_get_clean();
   }
   function dynamicSearchStartHtml()
   {
       global $nm_saida, $contUl, $contFields;
       ?>
      <script>
    //==============================================
// Funções
//==============================================
function dynamicFilterToggleButton() {
    const dynamicFilterToggleButtons = document.querySelectorAll('[data-role=togglebutton]');

    dynamicFilterToggleButtons.forEach(button => {
        button.addEventListener('click', () => {
            const nextSibling = button.nextElementSibling;
            const previousSibling = button.previousElementSibling;

            if (nextSibling) {
                button.setAttribute('aria-pressed', 'true');
                button.classList.add('selected');
                nextSibling.setAttribute('aria-pressed', 'false');
                nextSibling.classList.remove('selected');
            } else {
                button.setAttribute('aria-pressed', 'true');
                button.classList.add('selected');
                previousSibling.setAttribute('aria-pressed', 'false');
                previousSibling.classList.remove('selected');
            }

            if (typeof buttonEnable_dyn !== 'undefined' && typeof buttonEnable_dyn === 'function')
            {
                buttonEnable_dyn('dyn_search');
            }

            if ($('#id_dyn_descr_fly').length > 0 && typeof nm_proc_dyn_search !== 'undefined' && typeof nm_proc_dyn_search === 'function')
            {
                nm_proc_dyn_search('id_Fdyn_search', 'dyn_search_descr');
            }

            event.preventDefault();
        });
    });
}

function changeFilterConditions() {
    const filtersConditions = document.querySelectorAll('[data-role="filter-conditions"]');

    filtersConditions.forEach(filter => {
        filter.addEventListener('change', () => {

            const filterValue = filter.value;

            switch (filterValue) {
                case 'is equal to':
                case 'is not equal to':
                case 'is greater than or equal to':
                case 'is greater than':
                case 'is less than or equal to':
                case 'is less than':
                case 'starts with':
                case 'contains':
                case 'does not contain':
                case 'ends with':
                    filter.nextElementSibling.style.display = 'block';
                    break;
                default:
                    filter.nextElementSibling.style.display = 'none';
                    break;
            }
        });
    });


}

function clearDynamicFilter(objFilter) {
    nm_dynamicsearch_backup();
    $('#ul_' + $(objFilter).parent().prop('id')).find('.dyn_search_field_close').each(function( index ) {
        $( this ).click();
    });
    $('#ul_' + $(objFilter).parent().prop('id')).find('.dyn_search_close').each(function( index ) {
        $( this ).click();
    });
    $(objFilter).parent().parent().parent().hide();
    event.preventDefault();
}

var dynamicFilterCount =0;
function addGroup(objFilter) {

    if($(objFilter).parent().find('.dyn_nested_enabled').length >0 && $(objFilter).parent().find('.dyn_nested_enabled').val() == 'N') return;

    nm_dynamicsearch_backup();

    dynamicFilterCount++;

    strId = $(objFilter).parent().prop('id');

    cloneLine = $('#' + strId).clone( true ).prop('id', strId + dynamicFilterCount );
    cloneUl = $('#ul_' + strId).clone( true ).prop('id', 'ul_' + strId + dynamicFilterCount );

    cloneUl.empty();
    sub_li = $('<div class="group" />').append(cloneLine).append(cloneUl);
    sub_li = $('<li class=df-item role=treeitem />').append(sub_li);
    $('#ul_' + strId).append(sub_li);

    dynamicFilterToggleButton();

    if (typeof ajusta_window_dynamic_search !== 'undefined' && typeof ajusta_window_dynamic_search === 'function')
    {
        ajusta_window_dynamic_search();
    }

    event.preventDefault();
}

function addExpression(templateId, Expression) {
    $('#ul_' + templateId).append("<li class='df-item' role='treeitem'>" + Expression + "</li>");
}

function addSubgroup(template_id) {
    const template = document.getElementById(template_id);
    const clone = template.content.cloneNode(true);
    const li = document.createElement('li');

    li.classList.add('df-item');
    li.setAttribute('role', 'treeitem');
    li.appendChild(clone);

    const ul = document.createElement('ul');

    ul.classList.add('df-lines');
    ul.setAttribute('data-role', 'subcontent');
    ul.setAttribute('role', 'group');
    ul.appendChild(li);

    event.target.offsetParent.parentElement.appendChild(ul);

    dynamicFilterToggleButton();
}

function addSubexpression(template_id) {
    const template = document.getElementById(template_id);
    const clone = template.content.cloneNode(true);
    const li = document.createElement('li');

    li.classList.add('df-item');
    li.setAttribute('role', 'treeitem');
    li.appendChild(clone);

    const createList = () => {
        const ul = document.createElement('ul');

        ul.classList.add('df-lines');
        ul.setAttribute('data-role', 'subcontent');
        ul.setAttribute('role', 'group');
        ul.appendChild(li);

        event.target.offsetParent.parentElement.appendChild(ul);
    };

    if (
        event.target.offsetParent.parentElement.parentElement.getAttribute('data-role') === 'maincontent' && event.target.offsetParent.nextElementSibling === null ||
        event.target.offsetParent.parentElement.parentElement.getAttribute('data-role') === 'subcontent' && event.target.offsetParent.nextElementSibling === null
    ) {
        createList();
    } else {
        event.target.offsetParent.nextElementSibling.appendChild(li);
    }

    //changeFilterConditions();
}

function init() {
    const mainContent = document.querySelector('.df-lines[data-role="maincontent"]');
}

function get_json_dyn_search_and_or(Tab_obj_dyn_search)
{
    json_dyn_search = {};
    if($('#dynamicSearchStart').length > 0)
    {
        json_dyn_search = get_json_dyn_search_and_or_rec(Tab_obj_dyn_search, { condition: '', type: 'ul',  enabled: 'S', fields: [] }, 'dynamicSearchStart');
    }
    else
    {
        json_dyn_search = get_json_dyn_search_and_or_old();
    }

    return JSON.stringify(json_dyn_search);
}

function get_json_dyn_search_and_or_horizontal(Tab_obj_dyn_search)
{
    json_dyn_search_horizontal = [];
    get_json_dyn_search_and_or_rec(Tab_obj_dyn_search, { condition: '', type: 'ul',  enabled: 'S', fields: [] }, 'dynamicSearchStart');
    return json_dyn_search_horizontal;
}

var json_dyn_search_horizontal = [];
function get_json_dyn_search_and_or_rec(Tab_obj_dyn_search, json_dyn_search_and_or, str_id)
{
    if($( "#ul_"+ str_id).parent().css('display')!='none')
    {
        json_dyn_search_and_or.condition = $('#' + str_id + ' [aria-pressed=true]').attr('aria-value');

        json_dyn_search_and_or.enabled = 'S';
        if($('#' + str_id + ' .dyn_nested_enabled').length>0)
        {
            json_dyn_search_and_or.enabled = $('#' + str_id + ' .dyn_nested_enabled').val();
        }

        $("#ul_" + str_id + " > li > div").each(function (index, element) {

            if ($(this).parent().css('display') != 'none') {
                if ($(this).hasClass('group')) {
                    jsonNode = get_json_dyn_search_and_or_rec(Tab_obj_dyn_search,  {
                        condition: '',
                        type: 'ul',
                        enabled: 'S',
                        fields: []
                    }, $(this).find('.df-toolbar').prop('id'));
                    if (jsonNode.fields.length > 0) {
                        json_dyn_search_and_or.fields.push(jsonNode);
                    }
                } else {
                    str_enabled = 'S';
                    if($(this).find('.dyn_search_enabled').val() == 'N')
                    {
                        str_enabled = 'N';
                    }
                    json_dyn_search_horizontal.push($(this).find('.fixed_width_select select').attr('seq'));
                    json_dyn_search_and_or.fields.push({type: 'field', field: $(this).prop('id'), name: $(this).find('.fixed_width_select select').val(), opc: $(this).find('.fixed_width_conditions select').val(), enabled: str_enabled});
                }
            }
        });
    }

    return json_dyn_search_and_or;
}

function get_json_dyn_search_and_or_old()
{
    json_dyn_search_and_or = { condition: 'and', type: 'ul', fields: [] };

    $( "#table_dyn_search > div" ).each(function( index, element ) {
        if($(this).css('display') != 'none')
        {
            json_dyn_search_and_or.fields.push( { type: 'field', field: $(this).prop('id') } );
        }
    });

    return json_dyn_search_and_or;
}

function disableNested(obj)
{
    if($(obj).parent().prop('id') == 'dynamicSearchStart')
    {
        $('#bdyn_sc_enabled').hide();
        $('#bdyn_sc_disabled').show();
		
		$('#id_dyn_search_cmd_str').html(mens_select2_disabled);
    }
    $('#ul_' + $(obj).parent().prop('id') + ' > li > div').each(function( index ) {
        if($(this).hasClass('group'))
		{
			$(this).find('.df-toolbar a').addClass('disabled');
			$(this).find('.df-toolbar a').attr('disabled', 'disabled');
			$(this).find('.df-toolbar a').prop('disabled', true);
			
			if($(this).find('.df-toolbar .dyn_nested_enabled').val()=='S')
			{
				disableNested($(this).find('.df-toolbar .bdyn_nested_enabled'));
			}
		}
		else
		{
			$(this).find('.fixed_width_toolbar a').addClass('disabled');
			$(this).find('.fixed_width_toolbar a').attr('disabled', 'disabled');
			$(this).find('.fixed_width_toolbar a').prop('disabled', true);
			
			if($(this).find('.fixed_width_toolbar .dyn_search_enabled').val()=='S')
			{
				disableFieldLine($(this).find('.fixed_width_toolbar .bdyn_field_enabled'));
			}
		}
    });
}

function enableNested(obj)
{
    if($(obj).parent().prop('id') == 'dynamicSearchStart')
    {
        $('#bdyn_sc_enabled').show();
        $('#bdyn_sc_disabled').hide();
    }

    $('#ul_' + $(obj).parent().prop('id') + ' > li > div').each(function( index ) {
        if($(this).hasClass('group'))
		{
			$(this).find('.df-toolbar a').removeClass('disabled');
			$(this).find('.df-toolbar a').prop('disabled', false);
			$(this).find('.df-toolbar a').removeAttr('disabled');
			
			if($(this).find('.df-toolbar .dyn_nested_enabled').val()=='S')
			{
				enableNested($(this).find('.df-toolbar .bdyn_nested_enabled'));
			}
		}
		else
		{
			$(this).find('.fixed_width_toolbar a').removeClass('disabled');
			$(this).find('.fixed_width_toolbar a').prop('disabled', false);
			$(this).find('.fixed_width_toolbar a').removeAttr('disabled');
			
			if($(this).find('.fixed_width_toolbar .dyn_search_enabled').val()=='S')
			{
				enableFieldLine($(this).find('.fixed_width_toolbar .bdyn_field_enabled'));
			}
		}
    });
}

function disableFieldLine(obj)
{
	{
		$(obj).parent().parent().addClass('disabled');

		$(obj).parent().parent().find('.fixed_width_select, .fixed_width_conditions, .fixed_width_input').find('.df-toolbar, select, input, img, div, span').each(function( index ) {
			if($( this ).attr("sc-disabled") != 'true')
			{
				$( this ).attr('sc-disabled', 'true');
				$( this ).attr('disabled', 'disabled');
				$( this ).prop('disabled', true);
				$( this ).addClass('disabled');
			}
		});

		$(obj).parent().parent().find('.ui-slider').each(function( index ) {

			$('#' + $(obj).parent().parent().prop('id').replace('dyn_search_', 'id_dyn_slider_')).slider({ disabled: true });
		});
		$(obj).parent().parent().find('.hasDatepicker').each(function( index ) {
			$(this).datepicker( "option", "disabled", true );
		});
	}
}
function enableFieldLine(obj)
{
	{
		$(obj).parent().parent().removeClass('disabled');

		$(obj).parent().parent().find('.fixed_width_select, .fixed_width_conditions, .fixed_width_input').find('select, input, img, div, span').each(function( index ) {
			if($( this ).attr("sc-disabled") == 'true')
			{
				$( this ).attr('sc-disabled', '');
				$( this ).attr('disabled', '');
				$( this ).prop('disabled', false);
				$( this ).removeClass('disabled');
			}
		});
		$(obj).parent().parent().find('.ui-slider').each(function( index ) {

			$('#' + $(obj).parent().parent().prop('id').replace('dyn_search_', 'id_dyn_slider_')).slider({ disabled: false });
		});
		$(obj).parent().parent().find('.hasDatepicker').each(function( index ) {
			$(this).datepicker( "option", "disabled", false );
		});
	}
}

//Destrói os sortables existentes
function destroyAllSortables() {
    $('*').each(function () {
        if ($(this).sortable("instance")) {
            $(this).sortable("destroy");
        }
    });
}

// Função para iniciar o drag and drop em elementos .df-item
function dfSortable() {
    $(".df-lines").sortable({
        handle: ".drag_handle", // Usa o drag_handle como ponto de arrasto
        connectWith: ".df-lines", // Conecta todas as listas df-lines
        placeholder: "ui-state-highlight",
        items: ".df-item", // Define quais elementos serão arrastados
        tolerance: "intersect", // O item precisa sobrepor metade do item alvo para que o placeholder seja reposicionado
        axis: "y", // Restringe o movimento ao eixo vertical
        distance: 10, // Distância mínima em pixels para iniciar o arraste
        start: function (event, ui) {
            ui.placeholder.height(ui.helper.outerHeight()); // Ajusta o tamanho do placeholder
        },
        stop: function (event, ui) {
            if ($('#id_dyn_descr_fly').length > 0 && typeof nm_proc_dyn_search !== 'undefined' && typeof nm_proc_dyn_search === 'function')
            {
				buttonEnable_dyn('dyn_search');
                nm_proc_dyn_search('id_Fdyn_search', 'dyn_search_descr');
            }
        }
    }).disableSelection();
}

function handleNewElement(mutationsList) {
    for (const mutation of mutationsList) {
        if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
            mutation.addedNodes.forEach(node => {
                if (node.nodeType === Node.ELEMENT_NODE) {
                    if (node.classList.contains('df-toolbar') || node.classList.contains('df-item')) {
                        reStartDragNDrop();
                    }
                }
            });
        }
    }
}

function reStartDragNDrop()
{
    destroyAllSortables();
    dfSortable();
}

function startDragNDrop()
{
    // Configura o observer para monitorar mudanças no DOM
    const observer = new MutationObserver(handleNewElement);

    // Define a área de observação (body neste caso) e o tipo de mudanças que o observer deve observar
    observer.observe(document.body, {
        childList: true, // Observa adição e remoção de elementos filhos
        subtree: true // Observa também as mudanças nos elementos filhos do body
    });

    dfSortable();
}

//==============================================
// Init
//==============================================
window.addEventListener('DOMContentLoaded', () => {
    init();
    dynamicFilterToggleButton();
    startDragNDrop();
});

    $( document ).ready(function() {
        dynamicFilterToggleButton();
    });
</script>
<style>
    .df-container ul {
    margin: 0;
    padding: 0;
    list-style: none;
}

.df-toolbar {
    position: relative;
    width: fit-content;
    padding: 8px;
    flex-flow: row nowrap;
    justify-content: start;
    align-items: center;
    column-gap: .5rem;
    display: flex;
	z-index: 100;
}

.df-lines
{
    list-style-type: none;
}

/*==========================
 Workaround linhas guias
==========================*/
ul > li.df-item {
    position: relative;
}

ul > li.df-item::before,
ul > li.df-item::after {
    content: '';
    position: absolute;
}

ul > li.df-item::before {
    top: 30px;
    width: 8px;
    height: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.08);
}

.df-item > div
{
    margin: 8px;
}

ul > li.df-item:last-child::after {
    height: 40px;
}
ul > li.df-item::after {
    top: -23px;
    width: 0px;
    height: 100%;
    border-left: 1px solid rgba(0, 0, 0, 0.08);
    z-index: 2;
}
ul > li.df-item::before, ul > li.df-item::after {
    content: '';
    position: absolute;
}
ul.df-lines {
    padding-left: 15px;
}

.df-ghost-button {
    border: 1px solid transparent;
}

.df-button-rounded {
    border-radius: 4px;
}

.df-button-group {
    flex-flow: row nowrap;
    justify-content: center;
    align-items: center;
    column-gap: 0;
    display: flex;
}

.df-button-group > .df-button:first-child {
    border-radius: 4px 0 0 4px;
}

.df-button-group > .df-button:last-child {
    border-left: none;
    border-radius: 0 4px 4px 0;
}

#dynamicSearchStart > #bdyn_nested_remove{
    display: none !important;
}

#dynamicSearchStart > .drag_handle{
    display: none !important;
}

.df-button:not(.df-ghost-button) {
    border: 1px solid rgba(0, 0, 0, 0.08);
}

#ul_dynamicSearchStart .width-constrain {
    width: 100px;
    max-width: 100px;
    overflow: hidden;
    overflow-wrap: break-word;
    white-space: normal;
}

#ul_dynamicSearchStart .fixed_width_select {
    width: 15rem;
}

#ul_dynamicSearchStart .fixed_width_conditions {
    width: 10rem;
}

#ul_dynamicSearchStart .fixed_width_input {
    width: 20rem;
}
#ul_dynamicSearchStart .fixed_width_conditions_dt_comp {
    display: none;
}
#ul_dynamicSearchStart .fixed_width_input100 > input, #ul_dynamicSearchStart .fixed_width_input100 > select, #ul_dynamicSearchStart .fixed_width_input100 > span  > span > input, #ul_dynamicSearchStart .fixed_width_input100 > span > input, #ul_dynamicSearchStart .fixed_width_input100 .ui-autocomplete-input{
    width: 100% !important;
}
#ul_dynamicSearchStart div:not(.alignTop) .fixed_input_slide, #ul_dynamicSearchStart div:not(.alignTop) .fixed_input_slide > span > span {
    display: flex;
    column-gap: 0.5rem;
    align-items: center;
}
#ul_dynamicSearchStart div:not(.alignTop) .fixed_input_slide > span {
    display: flex;
    column-gap: 0.5rem;
    align-items: center;
}
#ul_dynamicSearchStart div:not(.alignTop) .fixed_input_slide > span > input
{
    width: auto !important;
}
#ul_dynamicSearchStart select, #dynamicSearchStart select, #table_dyn_search select
{
    width: 100%;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

#ul_dynamicSearchStart .fixed_width_select_date {
    width: 6.35rem !important;
    margin-right: 0.4rem;
}


#ul_dynamicSearchStart .fixed_width_date {
    width: 3.03rem;
}

#ul_dynamicSearchStart .fixed_width_year {
    width: 4rem;
}

#ul_dynamicSearchStart .fixed_width_date_calendar {
    width: 2.8rem;
}
#ul_dynamicSearchStart .dyn_search_field_close {
    margin-top: 9px;
}

.drag_handle {
    font-size: 1rem;
    color: gray;
    cursor: move;
}

#ul_dynamicSearchStart a[disabled] {
    pointer-events: none;
}

.modal__container
{
    padding: 0.5rem;
}
.modal #id_dynamic_search_content
{
    max-height: 78vh;
    overflow-y: auto;
    display: block;
}
.modal__content
{
    margin:0px
}

.bdyn_shortcut
{
    margin-left:auto;
    display:flex;
    align-items:center;
}

div:not(.alignTop) div.fixed_input_slide > span {
    width: 20rem;
}

div:not(.alignTop) div.fixed_input_slide > span > span, div:not(.alignTop) div.fixed_input_slide > span > span > span {
    margin: 0 !important;
}

#ul_dynamicSearchStart div:not(.alignTop) .fixed_input_slide > span > input.css_toolbar_obj, #ul_dynamicSearchStart div:not(.alignTop) .fixed_input_slide > span > span > input.css_toolbar_obj {
    width: 100px !important;
    box-sizing: border-box;
}

.fixed_width_toolbar {
    width: 7.5rem;
    display: flex;
    gap: .4rem;
    align-items: center;
}
</style>

       <?php
       if(!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_and_or']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_and_or']['new'] = array('condition' => 'and', 'type'=>'ul', 'fields'=>'array()');
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_and_or']['old'] = array();
       }
       $contUl = 0;
       $contFields = 0;
       echo $this->dynamicSearchStartHtmlRec($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_and_or']['new'], 'dynamicSearchStart');
       ?>
       <script type="text/javascript">
           dynamicFilterCount = <?php echo $contUl; ?>;
       </script>
       <?php
   }
   function JS_dynamic_search()
   {
       global $nm_saida;
?>
   <script type="text/javascript">
     var Tot_obj_dyn_search = <?php echo $this->Dyn_search_seq ?>;
     Tab_obj_dyn_search = new Array();
     Tab_evt_dyn_search = new Array();
     Dyn_desc_orig = '';
       $(function() {
       });
<?php
       foreach ($this->Dyn_search_dat as $seq => $cmp)
       {
?>
     Tab_obj_dyn_search[<?php echo $seq ?>] = '<?php echo $cmp ?>';
<?php
       }
?>
<?php
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ajax_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ajax_nav'])
   { 
       $this->Ini->Arr_result['setArr'][] = array('var' => 'Tab_obj_dyn_search', 'value' => '');
       $this->Ini->Arr_result['setArr'][] = array('var' => 'Tab_evt_dyn_search', 'value' => '');
       $this->Ini->Arr_result['setVar'][] = array('var' => 'Tot_obj_dyn_search', 'value' => $this->Dyn_search_seq);
       foreach ($this->Dyn_search_dat as $seq => $cmp)
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'Tab_obj_dyn_search[' . $seq . ']', 'value' => $cmp);
       }
   } 
?>
     var Cmp_select2_ok = false;
     function SC_select2_dyn()
     {
         if (Cmp_select2_ok) {
             return;
         }
         Cmp_select2_ok = true;
<?php
       foreach ($this->Cmps_select2 as $Cmp => $Seqs)
       {
       }
       ?>
         for(i=1; i<=Tot_obj_dyn_search; i++)
         {
             if(Tab_obj_dyn_search[i] == 'hosp_id_evento_')
             {
                 $("#dyn_search_hosp_id_evento__" + i + " .fixed_width_select select").select2(
                {
                  width: '100%',
                  language: {
                    noResults: function() {
                      return "<?php echo $this->Ini->Nm_lang['lang_autocomp_notfound'] ?>";
                    },
                    searching: function() {
                      return "<?php echo $this->Ini->Nm_lang['lang_autocomp_searching'] ?>";
                    }
                  }
                }
              );
                 $("#dyn_search_hosp_id_evento__" + i + " .fixed_width_conditions select").select2(
                {
                  width: '100%',
                minimumResultsForSearch: Infinity,
                  language: {
                    noResults: function() {
                      return "<?php echo $this->Ini->Nm_lang['lang_autocomp_notfound'] ?>";
                    },
                    searching: function() {
                      return "<?php echo $this->Ini->Nm_lang['lang_autocomp_searching'] ?>";
                    }
                  }
                }
              );
          }
      }
         for(i=1; i<=Tot_obj_dyn_search; i++)
         {
             if(Tab_obj_dyn_search[i] == 'hosp_id_hotel_')
             {
                 $("#dyn_search_hosp_id_hotel__" + i + " .fixed_width_select select").select2(
                {
                  width: '100%',
                  language: {
                    noResults: function() {
                      return "<?php echo $this->Ini->Nm_lang['lang_autocomp_notfound'] ?>";
                    },
                    searching: function() {
                      return "<?php echo $this->Ini->Nm_lang['lang_autocomp_searching'] ?>";
                    }
                  }
                }
              );
                 $("#dyn_search_hosp_id_hotel__" + i + " .fixed_width_conditions select").select2(
                {
                  width: '100%',
                minimumResultsForSearch: Infinity,
                  language: {
                    noResults: function() {
                      return "<?php echo $this->Ini->Nm_lang['lang_autocomp_notfound'] ?>";
                    },
                    searching: function() {
                      return "<?php echo $this->Ini->Nm_lang['lang_autocomp_searching'] ?>";
                    }
                  }
                }
              );
          }
      }
         for(i=1; i<=Tot_obj_dyn_search; i++)
         {
             if(Tab_obj_dyn_search[i] == 'hosp_acomodacao_')
             {
                 $("#dyn_search_hosp_acomodacao__" + i + " .fixed_width_select select").select2(
                {
                  width: '100%',
                  language: {
                    noResults: function() {
                      return "<?php echo $this->Ini->Nm_lang['lang_autocomp_notfound'] ?>";
                    },
                    searching: function() {
                      return "<?php echo $this->Ini->Nm_lang['lang_autocomp_searching'] ?>";
                    }
                  }
                }
              );
                 $("#dyn_search_hosp_acomodacao__" + i + " .fixed_width_conditions select").select2(
                {
                  width: '100%',
                minimumResultsForSearch: Infinity,
                  language: {
                    noResults: function() {
                      return "<?php echo $this->Ini->Nm_lang['lang_autocomp_notfound'] ?>";
                    },
                    searching: function() {
                      return "<?php echo $this->Ini->Nm_lang['lang_autocomp_searching'] ?>";
                    }
                  }
                }
              );
          }
      }
         for(i=1; i<=Tot_obj_dyn_search; i++)
         {
             if(Tab_obj_dyn_search[i] == 'hosp_categoria_')
             {
                 $("#dyn_search_hosp_categoria__" + i + " .fixed_width_select select").select2(
                {
                  width: '100%',
                  language: {
                    noResults: function() {
                      return "<?php echo $this->Ini->Nm_lang['lang_autocomp_notfound'] ?>";
                    },
                    searching: function() {
                      return "<?php echo $this->Ini->Nm_lang['lang_autocomp_searching'] ?>";
                    }
                  }
                }
              );
                 $("#dyn_search_hosp_categoria__" + i + " .fixed_width_conditions select").select2(
                {
                  width: '100%',
                minimumResultsForSearch: Infinity,
                  language: {
                    noResults: function() {
                      return "<?php echo $this->Ini->Nm_lang['lang_autocomp_notfound'] ?>";
                    },
                    searching: function() {
                      return "<?php echo $this->Ini->Nm_lang['lang_autocomp_searching'] ?>";
                    }
                  }
                }
              );
          }
      }
         for(i=1; i<=Tot_obj_dyn_search; i++)
         {
             if(Tab_obj_dyn_search[i] == 'hosp_cpf_participante_')
             {
                 $("#dyn_search_hosp_cpf_participante__" + i + " .fixed_width_select select").select2(
                {
                  width: '100%',
                  language: {
                    noResults: function() {
                      return "<?php echo $this->Ini->Nm_lang['lang_autocomp_notfound'] ?>";
                    },
                    searching: function() {
                      return "<?php echo $this->Ini->Nm_lang['lang_autocomp_searching'] ?>";
                    }
                  }
                }
              );
                 $("#dyn_search_hosp_cpf_participante__" + i + " .fixed_width_conditions select").select2(
                {
                  width: '100%',
                minimumResultsForSearch: Infinity,
                  language: {
                    noResults: function() {
                      return "<?php echo $this->Ini->Nm_lang['lang_autocomp_notfound'] ?>";
                    },
                    searching: function() {
                      return "<?php echo $this->Ini->Nm_lang['lang_autocomp_searching'] ?>";
                    }
                  }
                }
              );
          }
      }
     }
     function SC_carga_evt_jquery(tp_carga)
     {
         for (i = 1; i <= Tot_obj_dyn_search; i++)
         {
             if (Tab_obj_dyn_search[i] != 'NMSC_Dyn_Null' && (tp_carga == 'all' || tp_carga == i))
             {
                 x   = 0;
                 tmp = Tab_obj_dyn_search[i];
                 cps = new Array();
                 cps[x] = tmp;
                 for (x = 0; x < cps.length ; x++)
                 {
                     cmp = cps[x];
                     if (Tab_evt_dyn_search[cmp])
                     {
                         eval ("$('#dyn_search_" + cmp + "_val_" + i + "').bind('change', function() {" + Tab_evt_dyn_search[cmp] + "})");
                     }
                 }
             }
         }
     }
     var del_all = false;
     function del_dyn_search(field, ind, tp_del)
     {
         nm_dynamicsearch_backup();
         qtd_atv = 0;
         Tab_obj_dyn_search[ind] = 'NMSC_Dyn_Null';
         $('#' + field).hide();
         for (idel = 1; idel <= Tot_obj_dyn_search; idel++) {
             if (Tab_obj_dyn_search[idel] != 'NMSC_Dyn_Null') {
                 qtd_atv++;
                  break;
             }
         }
         if (qtd_atv == 0) {
             buttonDisable_dyn("dyn_search_clear");
         }
         else { if (!del_all && tp_del != "all") {
                    nm_proc_dyn_search('id_Fdyn_search', 'dyn_search_descr');
                }
         }
     }
     function dyn_search_hide_input(field, ind)
     {
        var index = document.getElementById('dyn_search_' + field + '_cond_' + ind).selectedIndex;
        var parm  = document.getElementById('dyn_search_' + field + '_cond_' + ind).options[index].value;
        if (parm == "nu" || parm == "nn" || parm == "ep" || parm == "ne")
        {
            $('#dyn_' + field + '_' + ind).css('display','none');
        }
        else
        {
            $('#dyn_' + field + '_' + ind).css('display','');
        }
     }
     function dyn_search_hide_input(field, ind)
     {
        var index = document.getElementById('dyn_search_' + field + '_cond_' + ind).selectedIndex;
        var parm  = document.getElementById('dyn_search_' + field + '_cond_' + ind).options[index].value;
        if (parm == "nu" || parm == "nn" || parm == "ep" || parm == "ne")
        {
            $('#dyn_' + field + '_' + ind).css('display','none');
        }
        else
        {
            $('#dyn_' + field + '_' + ind).css('display','');
        }
     }
     var bol_backup  = false;
     var backup_tot  = 0;
     var backup_tab  = new Array();
     var backup_html = '';
     var backup_desc = '';
     function nm_dynamicsearch_backup()
     {
         if(!nm_dynamicsearch_getChange())
         {
             backup_tot = Tot_obj_dyn_search;
             backup_tab = Tab_obj_dyn_search;
             $('[type=text], textarea').each(function(){ this.defaultValue = this.value; });
             $('[type=checkbox], [type=radio]').each(function(){ this.defaultChecked = this.checked; });
             $('select option').each(function(){ this.defaultSelected = this.selected; });
             if($('#ul_dynamicSearchStart').length)
             {
                 backup_html = $('#ul_dynamicSearchStart').html();
             }
             else
             {
                 backup_html = $('#table_dyn_search').html();
             }
             backup_desc = $('#id_dyn_descr_fly').html();
             nm_dynamicsearch_setbackup()
         }
     }
     function nm_dynamicsearch_restore()
     {
         if(nm_dynamicsearch_getChange())
         {
             nm_dynamicsearch_setbackup()
             Tot_obj_dyn_search = backup_tot;
             Tab_obj_dyn_search = backup_tab;
             if($('#ul_dynamicSearchStart').length)
             {
                 $('#ul_dynamicSearchStart').html(backup_html);
             }
             else
             {
                 $('#table_dyn_search').html(backup_html);
             }
             $('#id_dyn_descr_fly').html(backup_desc);
             nm_dynamicsearch_reset();
         }
     }
     function nm_dynamicsearch_reset()
     {
         bol_backup = false;
     }
     function nm_dynamicsearch_setbackup()
     {
         bol_backup = true;
     }
     function nm_dynamicsearch_getChange()
     {
         return bol_backup;
     }
     function nm_show_dynamicsearch_fields_2(objFilter)
     {
        if(objFilter)
        {
            var_str_id_tb = $(objFilter).parent().prop('id');
        }
        ajax_add_dyn_search_js('hosp_id_evento_')
     }
     var dynamicsearch_status = 'out';
     var var_str_id_tb = '';
     function nm_show_dynamicsearch_fields(objFilter)
     {
       if(objFilter)
       {
           var_str_id_tb = $(objFilter).parent().prop('id');
       }
       if (typeof(nm_show_dynamicsearch_fields_mobile) === typeof(function(){})) { return nm_show_dynamicsearch_fields_mobile(); };
       var btn_id = 'id_dyn_search_fields';
       var obj_id = 'id_dynamic_search_fields';
       dynamicsearch_status = 'open';
       $('#' + btn_id).mouseout(function() {
         setTimeout(function() {
           nm_hide_dynamicsearch_fields(obj_id, false);
         }, 1000);
       });
       $('#' + obj_id + ' li').click(function() {
         dynamicsearch_status = 'out';
         nm_hide_dynamicsearch_fields(obj_id, false);
       });
       $('#' + obj_id).css({
           'left': $('#' + btn_id).left,
       })
       .mouseover(function() {
         dynamicsearch_status = 'over';
       })
       .mouseleave(function() {
         dynamicsearch_status = 'out';
         setTimeout(function() {
           nm_hide_dynamicsearch_fields(obj_id, false);
         }, 1000);
       })
       .show('fast');
     }
   function nm_hide_dynamicsearch_fields(obj_id, bol_force) {
     if (bol_force || 'over' != dynamicsearch_status) {
       $('#' + obj_id).hide('fast');
     }
   }
   function proc_btn_dyn(btn, proc) {
       if ($("#" + btn).prop("disabled") == true) {
           return;
       }
       eval (proc);
   }
   function buttonDisable_dyn(buttonId) {
      $("#" + buttonId).prop("disabled", true).addClass("disabled");
   }
   function buttonEnable_dyn(buttonId) {
      $("#" + buttonId).prop("disabled", false).removeClass("disabled");
   }
   $(document).ready(function() {
      Tot_obj_dyn_search_or = Tot_obj_dyn_search;
      Tab_obj_dyn_search_or = new Array();
      for (i = 1; i <= Tot_obj_dyn_search; i++) {
          Tab_obj_dyn_search_or[i] = Tab_obj_dyn_search[i];
      }
      if (Tot_obj_dyn_search < 1) {
          buttonDisable_dyn("dyn_search_clear");
      }
      buttonDisable_dyn("dyn_search");
   });
     Dyn_Have_Clear = false;
     function nm_clear_dyn_search()
     {
         nm_dynamicsearch_backup();
         del_all = true;
         $('#ul_dynamicSearchStart .dyn_search_close, #table_dyn_search .dyn_search_field_close').each(function( index ) {
             $( this ).click();
         });
         del_all = false;
         Dyn_Have_Clear = true;
         buttonDisable_dyn("dyn_search_clear");
         buttonEnable_dyn('dyn_search');
     }
     function buttonSelectedDS() {
        $("#dynamic_search_t").addClass("selected");
        $("#dynamic_search_b").addClass("selected");
     }
     function buttonunselectedDS() {
        $("#dynamic_search_t").removeClass("selected");
        $("#dynamic_search_b").removeClass("selected");
     }
     function nm_cancel_dyn_search(msg="N", event = null)
     {
         if(nm_dynamicsearch_getChange() && msg == "N")
         {
             scJs_confirm('<?php echo $this->Ini->Nm_lang['lang_reload_confirm'] ?>', function() { nm_cancel_dyn_search('S'); }, function() { if (event !== null) { nm_avoid_modal_close(event); } });
             return false;
         }
         nm_dynamicsearch_restore();
         if (Tot_obj_dyn_search > 0) {
             buttonEnable_dyn("dyn_search_clear");
         }
         $('#nm_close_dyn').click();
         buttonunselectedDS();
     }
     function get_json_dyn_search_and_or_horizontal(formId, Tp_Proc)
     {
         json_dyn_search_horizontal = [];
         Tab_obj_dyn_search.forEach(function(nome, i) {
             json_dyn_search_horizontal.push(i);
         });
         return json_dyn_search_horizontal;
     }
     function nm_test_dyn_desc(force)
     {
          $('#id_dyn_search_cmd_string').hide();
          if($('#id_dyn_search_cmd_str').html() != ''){ 
              $('#id_dyn_search_cmd_string').show();
          }
          if(force == 'S')
          {
              $('#div_dyn_search').hide();
          }
     }
     function nm_proc_dyn_search(formId, Tp_Proc)
     {
         if($('#dyn_search').hasClass('disabled')) return false;
         var out_dyn      = "";
         var empty_dyn    = true;
         var tem_dyn_null = false;
         var arr_exclude = new Array();
         Tab_obj_dyn_search_rec = get_json_dyn_search_and_or_horizontal(Tab_obj_dyn_search);
         if(Tab_obj_dyn_search_rec.length) Dyn_Have_Clear = true;
         for (ii = 0; ii < Tab_obj_dyn_search_rec.length; ii++)
         {
             i = Tab_obj_dyn_search_rec[ii];
             if (Tab_obj_dyn_search[i] == 'NMSC_Dyn_Null' || $('#dyn_search_enabled_'+ Tab_obj_dyn_search[i] +'_' + i).val()=='N')
             {
                 tem_dyn_null = true;
             }
             if (Tab_obj_dyn_search[i] != 'NMSC_Dyn_Null')
             {
                 obj_dyn  = 'dyn_search_' + Tab_obj_dyn_search[i] + '_cond_' + i;
                 out_cond = dyn_search_get_sel_cond(obj_dyn);
                 obj_dyn  = 'dyn_search_' + Tab_obj_dyn_search[i] + '_val_';

                 if (Tab_obj_dyn_search[i] == 'hosp_id_evento_')
                 {
                     result  = dyn_search_get_text(obj_dyn + i, '');
                 }
                 if (Tab_obj_dyn_search[i] == 'hosp_id_hotel_')
                 {
                     result  = dyn_search_get_text(obj_dyn + i, '');
                 }
                 if (Tab_obj_dyn_search[i] == 'hosp_acomodacao_')
                 {
                     result  = dyn_search_get_text(obj_dyn + i, '');
                 }
                 if (Tab_obj_dyn_search[i] == 'hosp_categoria_')
                 {
                     result  = dyn_search_get_text(obj_dyn + i, '');
                 }
                 if (Tab_obj_dyn_search[i] == 'hosp_cpf_participante_')
                 {
                     result  = dyn_search_get_text(obj_dyn + i, '');
                 }
                 if (result == '' && out_cond != 'ep' && out_cond != 'ne' && out_cond != 'nu' && out_cond != 'nn' && out_cond.substring(0, 3) != 'bi_')
                 {
                     arr_exclude.push(i);
                     continue;
                 }
                 out_dyn += (out_dyn != "") ? "_FDYN_" : "";
                 out_dyn += Tab_obj_dyn_search[i];
                 out_dyn += "_DYN_" + out_cond;
                 out_dyn  += "_DYN_" + result;
                 out_dyn += "_DYN_" + i;
                 if (result != '' || out_cond == 'ep' || out_cond == 'ne' || out_cond == 'nu' || out_cond == 'nn' || out_cond.substring(0, 3) == 'bi_')
                 {
                     empty_dyn = false;
                 }
             }
         }
         if (empty_dyn && (Dyn_Have_Clear || tem_dyn_null) && Tp_Proc != "dyn_search_descr")
         {
             Tp_Proc = "dyn_search_clear";
             Dyn_Have_Clear = false;
             buttonDisable_dyn("dyn_search_clear");
             Tot_obj_dyn_search = 0;
             Tab_obj_dyn_searchr = new Array();
         }
         if (empty_dyn && Tp_Proc != "dyn_search_clear")
         {
             alert("<?php echo $this->Ini->Nm_lang['lang_srch_req_field'] ?>");
             return false;
         }
        out_dyn = out_dyn.replace(/[+]/g, "__NM_PLUS__");
        while (out_dyn.lastIndexOf("&amp;") != -1)
        {
           out_dyn = out_dyn.replace("&amp;" , "__NM_AMP__");
        }
        out_dyn = out_dyn.replace(/[&]/g, "__NM_AMP__");
        out_dyn = out_dyn.replace(/[%]/g, "__NM_PRC__");
        if (Tp_Proc != "dyn_search_descr")
        {
            Tot_obj_dyn_search_or = Tot_obj_dyn_search;
            Tab_obj_dyn_search_or = new Array();
            for (i = 1; i <= Tot_obj_dyn_search; i++) {
                Tab_obj_dyn_search_or[i] = Tab_obj_dyn_search[i];
            }
            buttonDisable_dyn('dyn_search');
        }
        if(Tp_Proc == 'dyn_search' || Tp_Proc == 'dyn_search_clear')
        {
            nm_dynamicsearch_reset();
        }
         nm_move(Tp_Proc, out_dyn);
     }
     function dyn_search_get_sel_cond(obj_id)
     {
        var index = document.getElementById(obj_id).selectedIndex;
        return document.getElementById(obj_id).options[index].value;
     }
     function dyn_search_get_select(obj_id, str_type)
     {
        if(str_type == '')
        {
            var obj = document.getElementById(obj_id);
        }
        else
        {
            var obj = $('#' + obj_id).multipleSelect('getSelects');
        }
        var val = "";
        for (iSelect = 0; iSelect < obj.length; iSelect++)
        {
            if ((str_type == '' && obj[iSelect].selected) || (str_type=='RADIO' || str_type=='CHECKBOX'))
            {
                if(str_type == '' && obj[iSelect].selected)
                {
                    new_val = obj[iSelect].value;
                }
                else
                {
                    new_val = obj[iSelect];
                }
                val += (val != "") ? "_VLS_" : "";
                val += new_val;
            }
        }
        return val;
     }
     function dyn_search_get_Dselelect(obj_id)
     {
        var obj = document.getElementById(obj_id);
        var val = "";
        for (iSelect = 0; iSelect < obj.length; iSelect++)
        {
            val += (val != "") ? "_VLS_" : "";
            val += obj[iSelect].value;
        }
        return val;
     }
     function dyn_search_get_radio(obj_id)
     {
        var val  = "";
        if($('#' + obj_id).length>0)
        {
            var Nobj = document.getElementById(obj_id).name;
            var obj  = document.getElementsByName(Nobj);
            for (iRadio = 0; iRadio < obj.length; iRadio++)
            {
                if (obj[iRadio].checked)
                {
                    val += (val != "") ? "_VLS_" : "";
                    val += obj[iRadio].value;
                }
            }
         }
        return val;
     }
     function dyn_search_get_checkbox(obj_id)
     {
        var Nobj = document.getElementById(obj_id).name;
        var obj  = document.getElementsByName(Nobj);
        var val  = "";
        if (!obj.length)
        {
            if (obj.checked)
            {
                val = obj.value;
            }
            return val;
        }
        else
        {
            for (iCheck = 0; iCheck < obj.length; iCheck++)
            {
                if (obj[iCheck].checked)
                {
                    val += (val != "") ? "_VLS_" : "";
                    val += obj[iCheck].value;
                }
            }
        }
        return val;
     }
     function dyn_search_get_text(obj_id, obj_ac)
     {
        var obj = document.getElementById(obj_id);
        var val = "";
        if (obj)
        {
            val = obj.value;
        }
        if (obj_ac != '' && val == '')
        {
            obj = document.getElementById(obj_ac);
            if (obj)
            {
                val = obj.value;
            }
        }
        return val;
     }
     function dyn_search_get_dt_h(obj_id, ind, TP)
     {
        var val = new Array();
        var val_empty = true;
        if (TP == 'DT' || TP == 'DH')
        {
            obj_part  = document.getElementById(obj_id + '_ano_val_' + ind);
            val      += "Y:";
            if (obj_part && obj_part.type.substr(0, 6) == 'select')
            {
                Tval = dyn_search_get_sel_cond(obj_id + '_ano_val_' + ind);
                val += (Tval != -1) ? Tval : '';
                if(Tval != -1)
                {
                    val_empty = false;
                }
            }
            else
            {
                val += (obj_part) ? obj_part.value : '';
                if(obj_part && obj_part.value != '')
                {
                    val_empty = false;
                }
            }
            obj_part  = document.getElementById(obj_id + '_mes_val_' + ind);
            val      += "_VLS_M:";
            if (obj_part && obj_part.type.substr(0, 6) == 'select')
            {
                Tval = dyn_search_get_sel_cond(obj_id + '_mes_val_' + ind);
                val += (Tval != -1) ? Tval : '';
                if(Tval != -1)
                {
                    val_empty = false;
                }
            }
            else
            {
                val += (obj_part) ? obj_part.value : '';
                if(obj_part && obj_part.value != '')
                {
                    val_empty = false;
                }
            }
            obj_part  = document.getElementById(obj_id + '_dia_val_' + ind);
            val      += "_VLS_D:";
            if (obj_part && obj_part.type.substr(0, 6) == 'select')
            {
                Tval = dyn_search_get_sel_cond(obj_id + '_dia_val_' + ind);
                val += (Tval != -1) ? Tval : '';
                if(Tval != -1)
                {
                    val_empty = false;
                }
            }
            else
            {
                val += (obj_part) ? obj_part.value : '';
                if(obj_part && obj_part.value != '')
                {
                    val_empty = false;
                }
            }
        }
        if (TP == 'HH' || TP == 'DH')
        {
            val            += (val != "") ? "_VLS_" : "";
            if(val != "") val_empty = false;
            obj_part        = document.getElementById(obj_id + '_hor_val_' + ind);
            val            += "H:";
            val            += (obj_part) ? obj_part.value : '';
            if(obj_part && obj_part.value!= '') val_empty = false;
            obj_part        = document.getElementById(obj_id + '_min_val_' + ind);
            val            += "_VLS_I:";
            val            += (obj_part) ? obj_part.value : '';
            if(obj_part && obj_part.value!= '') val_empty = false;
            obj_part        = document.getElementById(obj_id + '_seg_val_' + ind);
            val            += "_VLS_S:";
            val            += (obj_part) ? obj_part.value : '';
            if(obj_part && obj_part.value!= '') val_empty = false;
        }
        if(val_empty) val='';
        return val;
     }
function ajax_replace_dyn_search_js(obj, seq)
{
         nm_dynamicsearch_backup();
         Tab_obj_dyn_search[seq] = obj.value;
         htmlNew = $('#id_dyn_search_template_' + obj.value).html();
         htmlNew = htmlNew.replace(/\__NMSEQ__/g, seq);
         $( htmlNew ).insertBefore( '#' + $(obj).parent().parent().prop('id') );
         $('#' + $(obj).parent().parent().prop('id')).remove();
         SC_carga_evt_jquery(seq);
         scLoadScInput('input:text.sc-js-input-dyn');
         Cmp_select2_ok = false;
         SC_select2_dyn();
}
function ajax_add_dyn_search_js(campo)
{
         nm_dynamicsearch_backup();
         Tot_obj_dyn_search++;
         Tab_obj_dyn_search[Tot_obj_dyn_search] = campo;
         htmlNew = $('#id_dyn_search_template_' + campo).html();
         htmlNew = htmlNew.replace(/\__NMSEQ__/g, Tot_obj_dyn_search);
         $('#table_dyn_search').append(htmlNew);
         Cmp_select2_ok = false;
         SC_select2_dyn();
         nm_hide_dynamicsearch_fields('id_dynamic_search_fields', true);
         SC_carga_evt_jquery(Tot_obj_dyn_search);
         scLoadScInput('input:text.sc-js-input-dyn');
         Dyn_Have_Clear = false;
         buttonEnable_dyn('dyn_search_clear');
}
function ajax_add_dyn_search(str_field, str_origem)
{
    nm_hide_dynamicsearch_fields('id_dynamic_search_fields', true);
    nm_dynamicsearch_backup();
    var parm = str_field;
    if (parm == "")
    {
        return;
    }
    $('#table_dyn_search_criteria').show();
    scAjaxProcOn();
    Tot_obj_dyn_search++;
    Tab_obj_dyn_search[Tot_obj_dyn_search] = parm;
    $.ajax({
      type: "POST",
      url: "form_hospedagem_rsvp_ar1.php",
      data: "nmgp_opcao=ajax_add_dyn_search&script_case_init=<?php echo $this->Ini->sc_page; ?>&parm=" + parm + "&seq=" + Tot_obj_dyn_search + "&origem=" + str_origem,
      success: function(jsonDyn_add) {
        var i, oResp;
        Tst_integrid = jsonDyn_add.trim();
        if ("{" != Tst_integrid.substr(0, 1)) {
            scAjaxProcOff();
            alert (jsonDyn_add);
            return;
        }
        eval("oResp = " + jsonDyn_add);
        if (oResp["ss_time_out"]) {
            scAjaxProcOff();
            nm_move('novo');
        }
        if (oResp["dyn_add"]) {
          for (i = 0; i < oResp["dyn_add"].length; i++) {
              $('#table_dyn_search').append(oResp["dyn_add"][i]);
          }
        }
        if (oResp["setVar"]) {
            for (i = 0; i < oResp["setVar"].length; i++) {
                 eval (oResp["setVar"][i]["var"] + ' = \"' + oResp["setVar"][i]["value"] + '\"');
            }
        }
        if (oResp["htmOutput"]) {
           scAjaxShowDebug(oResp);
        }
        SC_carga_evt_jquery(Tot_obj_dyn_search);
        scLoadScInput('#dyn_search_' + parm + '_' + Tot_obj_dyn_search + ' input:text.sc-js-input-dyn');
         Dyn_Have_Clear = false;
         buttonEnable_dyn('dyn_search');
         buttonEnable_dyn('dyn_search_clear');
        scAjaxProcOff();
      }
    });
}
   </script>
<?php
   }
   function SC_proc_dyn_search($Parms)
   {
       $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_limpa.php", "F", "nm_limpa_valor") ; 
       $ix     = 0;
       $ix2    = 0;
       $fields = array();
       $Parms = str_replace(array("__NM_PLUS__","__NM_AMP__","__NM_PRC__"), array("+","&","%"), $Parms);
       if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($Parms))
       {
           $Parms = NM_conv_charset($Parms, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
       $tmp    = explode("_FDYN_", $Parms);
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search'] = array();
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_refresh'] = array();
      $_arr_temp_search_seq = array();
      $_arr_temp_search_seq_disabled = array();
      $_arr_campos_disabled = array();
       foreach ($tmp as $cada_f)
       {
           $dats = explode("_DYN_", $cada_f);
           if(isset($_arr_campos_disabled['dyn_search_'. $dats[0] .'_'. $dats[3]])) $_arr_temp_search_seq_disabled[$ix] = $ix2;
           $_arr_temp_search_seq[$dats[0] . '_' . $dats[3]] = $dats[0];
           $fields[$ix]['field']  = $dats[0];
           $fields[$ix]['cond']   = $dats[1];
           $sep_in                 = explode("_VLS3_", $dats[2]);
           if (isset($sep_in[1]))
           {
               $fields[$ix]['vls'][2][0] = $sep_in[1];
               $dats[2] = $sep_in[0];
           }
           $sep_bw                 = explode("_VLS2_", $dats[2]);
           $fields[$ix]['vls'][0] = explode("_VLS_",  $sep_bw[0]);
           $fields[$ix]['vls'][1] = isset($sep_bw[1]) ? explode("_VLS_",  $sep_bw[1]) : "";
           $val_sv = array();
           $val_formated = '';
           foreach ($fields[$ix]['vls'] as $i => $dados)
           {
               if (is_array($dados))
               {
                   foreach ($dados as $ind => $str)
                   {
                       $str = NM_charset_decode($str);
                       $tmp_pos = (is_string($str)) ? strpos($str, "##@@") : false;
                       if ($tmp_pos === false)
                       {
                          $val_sv[$i][] = $str;
                       }
                       else
                       {
                         $val_sv[$i][] = substr($str, 0, $tmp_pos);
                       }
                   }
               }
               else
               {
                   $dados = NM_charset_decode($dados);
                   $tmp_pos = (is_string($dados)) ? strpos($dados, "##@@") : false;
                   if ($tmp_pos === false)
                   {
                      $val_sv[$i] = $dados;
                   }
                   else
                   {
                      $val_sv[$i] = substr($dados, 0, $tmp_pos);
                   }
               }
           }
           if(isset($fields[$ix]['vls'][0]) && is_array($fields[$ix]['vls'][0]) && count($fields[$ix]['vls'][0])==1)
           {
               $val_formated = $fields[$ix]['vls'][0][0];
           }
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search'][] = array('cmp' => $dats[0], 'opc' => $dats[1], 'val_formated' => $val_formated, 'val' => $val_sv, 'seq' => $dats[3]);
           $ix++;
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_and_or']['old'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search'];
       $this->NM_case_insensitive = true;
       $this->Dyn_Serarch_and_or = "and";
       $this->Cmd_Dyn_Search     = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['cond_dyn_search'] = "";
       foreach ($fields as $ind => $dados)
       {
           $this->Date_part          = false;
           $this->Operador_date_part = "";
           $this->Lang_date_part     = "";
           $dados['cond'] = strtoupper($dados['cond']);
           if (empty($dados['vls']) && ($dados['cond'] == "NU" || $dados['cond'] == "NN" || $dados['cond'] == "EP" || $dados['cond'] == "NE"))
           {
               $dados['vls'][0][0] = "";
           }
           if ($dados['field'] == "hosp_id_evento_" && !empty($dados['vls']))
           {
               $Label_cmp     = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_label']['hosp_id_evento_'];
               $dados['vls'][0] = $dados['vls'][0][0];
               if ($dados['cond'] == "BW")
               {
                   $dados['vls'][1] = $dados['vls'][1][0];
                   if (empty($dados['vls'][1]))
                   {
                       $dados['vls'][1] = $dados['vls'][0];
                   }
               }
               if ($dados['cond'] != "IN")
               {
                   $dados['vls'][0] = str_replace($_SESSION['scriptcase']['reg_conf']['grup_num'], "", $dados['vls'][0]);
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['decimal_db'] == ".")
                   {
                       $dados['vls'][0] = str_replace(",", ".", $dados['vls'][0]);
                   }
                   if ($dados['cond'] == "BW")
                   {
                       $dados['vls'][1] = str_replace($_SESSION['scriptcase']['reg_conf']['grup_num'], "", $dados['vls'][1]);
                       if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['decimal_db'] == ".")
                       {
                           $dados['vls'][1] = str_replace(",", ".", $dados['vls'][1]);
                       }
                   }
               }
               if ($dados['vls'][0] == "" || (!is_numeric($dados['vls'][0]) && $dados['cond'] != "IN"))
               {
                   $dados['vls'] = array();
               }
               if ($dados['cond'] == "BW" && ($dados['vls'][1] == "" || (!is_numeric($dados['vls'][1]) && $dados['cond'] != "IN")))
               {
                   $dados['vls'] = array();
               }
               $this->Val_format_1 = $dados['vls'][0];
               if ($dados['cond'] == "BW")
               {
                   $this->Val_format_2 = $dados['vls'][1];
                   $this->Val_BW_2     = $dados['vls'][1];
               }
               $this->SC_proc_dyn_search_all($dados['cond'], $dados['vls'], "hosp_id_evento", 'N', 'INT', $Label_cmp, false);
           }
           if ($dados['field'] == "hosp_id_hotel_" && !empty($dados['vls']))
           {
               $Label_cmp     = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_label']['hosp_id_hotel_'];
               $dados['vls'][0] = $dados['vls'][0][0];
               if ($dados['cond'] == "BW")
               {
                   $dados['vls'][1] = $dados['vls'][1][0];
                   if (empty($dados['vls'][1]))
                   {
                       $dados['vls'][1] = $dados['vls'][0];
                   }
               }
               if ($dados['cond'] != "IN")
               {
                   $dados['vls'][0] = str_replace($_SESSION['scriptcase']['reg_conf']['grup_num'], "", $dados['vls'][0]);
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['decimal_db'] == ".")
                   {
                       $dados['vls'][0] = str_replace(",", ".", $dados['vls'][0]);
                   }
                   if ($dados['cond'] == "BW")
                   {
                       $dados['vls'][1] = str_replace($_SESSION['scriptcase']['reg_conf']['grup_num'], "", $dados['vls'][1]);
                       if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['decimal_db'] == ".")
                       {
                           $dados['vls'][1] = str_replace(",", ".", $dados['vls'][1]);
                       }
                   }
               }
               if ($dados['vls'][0] == "" || (!is_numeric($dados['vls'][0]) && $dados['cond'] != "IN"))
               {
                   $dados['vls'] = array();
               }
               if ($dados['cond'] == "BW" && ($dados['vls'][1] == "" || (!is_numeric($dados['vls'][1]) && $dados['cond'] != "IN")))
               {
                   $dados['vls'] = array();
               }
               $this->Val_format_1 = $dados['vls'][0];
               if ($dados['cond'] == "BW")
               {
                   $this->Val_format_2 = $dados['vls'][1];
                   $this->Val_BW_2     = $dados['vls'][1];
               }
               $this->SC_proc_dyn_search_all($dados['cond'], $dados['vls'], "hosp_id_hotel", 'N', 'INT', $Label_cmp, false);
           }
           if ($dados['field'] == "hosp_acomodacao_" && !empty($dados['vls']))
           {
               $Label_cmp     = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_label']['hosp_acomodacao_'];
               $dados['vls'][0] = $dados['vls'][0][0];
               if ($dados['cond'] == "BW")
               {
                   $dados['vls'][1] = $dados['vls'][1][0];
                   if (empty($dados['vls'][1]))
                   {
                       $dados['vls'][1] = $dados['vls'][0];
                   }
               }
               if ($dados['cond'] != "IN")
               {
                   $dados['vls'][0] = str_replace($_SESSION['scriptcase']['reg_conf']['grup_num'], "", $dados['vls'][0]);
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['decimal_db'] == ".")
                   {
                       $dados['vls'][0] = str_replace(",", ".", $dados['vls'][0]);
                   }
                   if ($dados['cond'] == "BW")
                   {
                       $dados['vls'][1] = str_replace($_SESSION['scriptcase']['reg_conf']['grup_num'], "", $dados['vls'][1]);
                       if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['decimal_db'] == ".")
                       {
                           $dados['vls'][1] = str_replace(",", ".", $dados['vls'][1]);
                       }
                   }
               }
               if ($dados['vls'][0] == "" || (!is_numeric($dados['vls'][0]) && $dados['cond'] != "IN"))
               {
                   $dados['vls'] = array();
               }
               if ($dados['cond'] == "BW" && ($dados['vls'][1] == "" || (!is_numeric($dados['vls'][1]) && $dados['cond'] != "IN")))
               {
                   $dados['vls'] = array();
               }
               $this->Val_format_1 = $dados['vls'][0];
               if ($dados['cond'] == "BW")
               {
                   $this->Val_format_2 = $dados['vls'][1];
                   $this->Val_BW_2     = $dados['vls'][1];
               }
               $this->SC_proc_dyn_search_all($dados['cond'], $dados['vls'], "hosp_acomodacao", 'N', 'INT', $Label_cmp, false);
           }
           if ($dados['field'] == "hosp_categoria_" && !empty($dados['vls']))
           {
               $Label_cmp     = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_label']['hosp_categoria_'];
               $dados['vls'][0] = $dados['vls'][0][0];
               if ($dados['cond'] == "BW")
               {
                   $dados['vls'][1] = $dados['vls'][1][0];
                   if (empty($dados['vls'][1]))
                   {
                       $dados['vls'][1] = $dados['vls'][0];
                   }
               }
               if ($dados['cond'] != "IN")
               {
                   $dados['vls'][0] = str_replace($_SESSION['scriptcase']['reg_conf']['grup_num'], "", $dados['vls'][0]);
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['decimal_db'] == ".")
                   {
                       $dados['vls'][0] = str_replace(",", ".", $dados['vls'][0]);
                   }
                   if ($dados['cond'] == "BW")
                   {
                       $dados['vls'][1] = str_replace($_SESSION['scriptcase']['reg_conf']['grup_num'], "", $dados['vls'][1]);
                       if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['decimal_db'] == ".")
                       {
                           $dados['vls'][1] = str_replace(",", ".", $dados['vls'][1]);
                       }
                   }
               }
               if ($dados['vls'][0] == "" || (!is_numeric($dados['vls'][0]) && $dados['cond'] != "IN"))
               {
                   $dados['vls'] = array();
               }
               if ($dados['cond'] == "BW" && ($dados['vls'][1] == "" || (!is_numeric($dados['vls'][1]) && $dados['cond'] != "IN")))
               {
                   $dados['vls'] = array();
               }
               $this->Val_format_1 = $dados['vls'][0];
               if ($dados['cond'] == "BW")
               {
                   $this->Val_format_2 = $dados['vls'][1];
                   $this->Val_BW_2     = $dados['vls'][1];
               }
               $this->SC_proc_dyn_search_all($dados['cond'], $dados['vls'], "hosp_categoria", 'N', 'INT', $Label_cmp, false);
           }
           if ($dados['field'] == "hosp_cpf_participante_" && !empty($dados['vls']))
           {
               $Label_cmp     = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dyn_search_label']['hosp_cpf_participante_'];
               $dados['vls'][0] = $dados['vls'][0][0];
               if ($dados['cond'] == "BW")
               {
                   $dados['vls'][1] = $dados['vls'][1][0];
                   if (empty($dados['vls'][1]))
                   {
                       $dados['vls'][1] = $dados['vls'][0];
                   }
               }
               $this->Val_format_1 = $dados['vls'][0];
               if ($dados['cond'] == "BW")
               {
                   $this->Val_format_2 = $dados['vls'][1];
                   $this->Val_BW_2     = $dados['vls'][1];
               }
               $this->SC_proc_dyn_search_all($dados['cond'], $dados['vls'], "hosp_cpf_participante", 'A', 'VARCHAR', $Label_cmp, false);
           }
       }
       if ($this->NM_case_insensitive)
       {
           $this->Cmd_Dyn_Search = str_replace("#lowerI#", "Upper(", $this->Cmd_Dyn_Search);
           $this->Cmd_Dyn_Search = str_replace("#lowerF#", ")", $this->Cmd_Dyn_Search);
       }
       else
       {
           $this->Cmd_Dyn_Search = str_replace("#lowerI#", "", $this->Cmd_Dyn_Search);
           $this->Cmd_Dyn_Search = str_replace("#lowerF#", "", $this->Cmd_Dyn_Search);
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_pesq_filtro'] = "( " . $this->Cmd_Dyn_Search . " )";
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_detal']) && !empty($this->Cmd_Dyn_Search)) 
       {
           $this->Cmd_Dyn_Search = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_detal'] . " and (" .  $this->Cmd_Dyn_Search . ")";
       }
       $sc_where = "";
       if (empty($this->Cmd_Dyn_Search)) 
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_pesq_filtro'] = "";
           $sc_where = " where (hosp_id_evento <> '0' AND hosp_tipo_pessoa = 'P'
AND id_bloqueio_hotel = '0')";
       }
       else
       {
           $sc_where = " where (hosp_id_evento <> '0' AND hosp_tipo_pessoa = 'P'
AND id_bloqueio_hotel = '0') and (" . $this->Cmd_Dyn_Search . ")";
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_pesq'] = $sc_where;
       $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where; 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
       $rt = $this->Db->Execute($nmgp_select) ; 
       if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
       { 
           $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
           exit ; 
       }  
       $qt_geral_reg_form_hospedagem_rsvp_ar1 = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['total'] = $qt_geral_reg_form_hospedagem_rsvp_ar1;
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['where_filter'] = $this->Cmd_Dyn_Search;
       $rt->Close(); 
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['cond_pesq'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['cond_dyn_search'] . $this->Dyn_Serarch_and_or;
       if (NM_is_utf8($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['cond_pesq']) && $_SESSION['scriptcase']['charset'] != "UTF-8")
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['cond_pesq'] = sc_convert_encoding($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['cond_pesq'], $_SESSION['scriptcase']['charset'], "UTF-8");
       }
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_hospedagem_rsvp_ar1_pack_ajax_response();
          exit;
      }
       $tmp = '';
       if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['cond_pesq']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['cond_pesq']))
       {
           $tmp = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['cond_pesq'];
           $pos = strrpos($tmp, "##*@@");
           if ($pos !== false)
           {
               $and_or = (substr($tmp, ($pos + 5)) == "and") ? $this->Ini->Nm_lang['lang_srch_and_cond'] : $this->Ini->Nm_lang['lang_srch_orr_cond'];
               $tmp    = substr($tmp, 0, $pos);
               $this->Dyn_search_str = str_replace("##*@@", " " . $and_or . " ", $tmp);
           }
       }
       $this->NM_ajax_info['dyn_search']['id_dyn_search_cmd_str'] = NM_charset_to_utf8(trim($this->Dyn_search_str));
       $this->NM_ajax_info['ajaxJavascript'][] = array('nm_test_dyn_desc', 'S');
   }
   function SC_proc_dyn_search_lookup($cond, $vls, $sql, $tp, $tsql, $lab)
   {
       $nm_aspas = ($tp == 'A') ? "'" : "";
       $nm_cond = "";
       $nm_cmd  = "";
       $lab = "<span class='scGridFilterDynField'>" . $lab . "</span>";
       $Lang_concat = ($cond == "DF" || $cond == "NP") ? $this->Ini->Nm_lang['lang_srch_and_cond'] : $this->Ini->Nm_lang['lang_srch_orr_cond'];
       foreach ($vls as $i => $dados)
       {
           $dados = NM_charset_decode($dados);
           if (!empty($nm_cond))
           {
               $nm_cmd .= ",";
               $nm_cond .= " " . $Lang_concat . " ";
           }
           else
           {
               $nm_cond .= "'<span class='scGridFilterDynValue'>";
           }
           $tmp_pos = (is_string($dados)) ? strpos($dados, "##@@") : false;
           if ($tmp_pos === false)
           {
              $res_lookup = $dados;
           }
           else
           {
               $res_lookup = substr($dados, $tmp_pos + 4);
               $dados = substr($dados, 0, $tmp_pos);
           }
           $ini_lower = "";
           $end_lower = "";
           if ($tp == 'A')
           {
               $ini_lower = "#lowerI#";
               $end_lower = "#lowerF#";
           }
           if (trim($dados) != "")
           {
               $dados    = substr($this->Db->qstr($dados), 1, -1);
               $nm_cmd  .= $ini_lower . $nm_aspas . $dados . $nm_aspas . $end_lower;
               $nm_cond .= $res_lookup;
           }
       }
       $nm_cond .= "</span>'";
       if (!empty($nm_cmd))
       {
           if (!empty($this->Cmd_Dyn_Search))
           {
               $this->Cmd_Dyn_Search .= " " . $this->Dyn_Serarch_and_or . " ";
           }
           $Lang_descr = array();
           $Lang_descr['EQ'] = $this->Ini->Nm_lang['lang_srch_equl'];
           $Lang_descr['DF'] = $this->Ini->Nm_lang['lang_srch_diff'];
           $Lang_descr['NP'] = $this->Ini->Nm_lang['lang_srch_not_like'];
           $Lang_descr_final = isset($Lang_descr[$cond]) ? $Lang_descr[$cond] : $this->Ini->Nm_lang['lang_srch_like'];
           if ($cond == "DF" || $cond == "NP")
           {
               $this->Cmd_Dyn_Search .= "(" . $ini_lower . $sql . $end_lower . " not in (" . $nm_cmd . "))";
               $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['cond_dyn_search'] .= $lab . " " . $Lang_descr_final . " " . $nm_cond . "##*@@";
           }
           else
           {
               $this->Cmd_Dyn_Search .= "(" . $ini_lower . $sql . $end_lower . " in (" . $nm_cmd . "))";
               $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['cond_dyn_search'] .= $lab . " " . $Lang_descr_final . " " . $nm_cond . "##*@@";
           }
       }
   }
   function SC_proc_dyn_search_all($cond, $vls, $sql, $tp, $tsql, $lab, $tp_unaccent=false)
   {
       $nm_aspas  = "'";
       $nm_aspas1 = "'";
       if ($tp == "N" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['decimal_db'] == ".")
       {
           $nm_aspas  = "";
           $nm_aspas1 = "";
       }
       $lab = "<span class='scGridFilterDynField'>" . $lab . "</span>";
       $this->Val_format_1 = "'<span class='scGridFilterDynValue'>" . $this->Val_format_1 . "</span>'";
       if ($cond == "BW") {
           $this->Val_format_2 = "'<span class='scGridFilterDynValue'>" . $this->Val_format_2 . "</span>'";
       }
       if ($tp == "DT" || $tp == "DH" || $tp == "HH")
       {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
             $nm_aspas  = "#";
             $nm_aspas1 = "#";
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['SC_sep_date']))
          {
              $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['SC_sep_date'];
              $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['SC_sep_date1'];
          }
       }
       $nm_ini_lower = "";
       $nm_fim_lower = "";
       if ($tp == 'A' && $tsql != "BOOL")
       {
           $nm_ini_lower = "#lowerI#";
           $nm_fim_lower = "#lowerF#";
       }
       $Nm_accent = $this->Ini->Nm_accent_no;
       if ($tp_unaccent) {
           $Nm_accent = $this->Ini->Nm_accent_yes;
       }
       if ($tsql == "BOOL")
       {
          $cond = str_replace(array("QP","NP"), array("EQ","DF"), $cond);
       }
       $nm_cond = "";
       $nm_cmd  = "";
       $dados   = $vls[0];
           if ($dados == "" && $cond != "NU" && $cond != "NN" && $cond != "EP" && $cond != "NE")
           {
               return;
           }
           if ($tp == 'N' && ($cond == "EP" || $cond == "NE"))
           {
               return;
           }
           $dados  = substr($this->Db->qstr($dados), 1, -1);
           if (($tsql == 'CIDR' || $tsql == 'INET' || $tsql == 'MACADDR') && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
           {
              $sql = "CAST (" . $sql . " AS TEXT)";
           }
           if ($cond != "NU" && $cond != "NN")
           {
               if ($tsql == "TIMESTAMP")
               {
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                   {
                       $tsql = "DATETIME_oracle";
                   }
                   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                   {
                       $tsql = "DATETIME";
                   }
                   else
                   {
                       $tsql = "DATETIME";
                   }
               }
               if ($tp == 'N' && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && ($cond == "II" || $cond == "QP" || $cond == "NP"))
               {
                  $sql = "CAST (" . $sql . " AS TEXT)";
               }
               if (substr($tsql, 0, 8) == "DATETIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && !$this->Date_part)
               {
                   $sql = "to_char (" . $sql . ", 'YYYY-MM-DD hh24:mi:ss')";
               }
               elseif (substr($tsql, 0, 4) == "DATE" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && !$this->Date_part)
               {
                   $sql = "to_char (" . $sql . ", 'YYYY-MM-DD')";
               }
               elseif (substr($tsql, 0, 4) == "TIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) && !$this->Date_part)
               {
                   $sql = "to_char (" . $sql . ", 'hh24:mi:ss')";
               }
               if ($tsql == "DATE" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql) && !$this->Date_part)
               {
                   $sql = "convert(char(10)," . $sql . ",121)";
               }
               if ($tsql == "DATETIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql) && !$this->Date_part)
               {
                   $sql = "convert(char(19)," . $sql . ",121)";
               }
               if ((substr($tsql, 0, 5) == "TIMES" || $tsql == "DATETIME_oracle") && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle) && !$this->Date_part)
               {
                   $sql  = "TO_DATE(TO_CHAR(" . $sql . ", 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss')";
                   $tsql = "DATETIME";
               }
               if (substr($tsql, 0, 8) == "DATETIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix) && !$this->Date_part)
               {
                   $sql = "EXTEND(" . $sql . ", YEAR TO FRACTION)";
               }
               elseif (substr($tsql, 0, 4) == "DATE" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix) && !$this->Date_part)
               {
                   $sql = "EXTEND(" . $sql . ", YEAR TO DAY)";
               }
               if ($tp == 'N' && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress) && ($cond == "II" || $cond == "QP" || $cond == "NP"))
               {
                  $sql = "CAST (" . $sql . " AS VARCHAR(255))";
               }
               if (substr($tsql, 0, 8) == "DATETIME" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress) && !$this->Date_part)
               {
                   $sql = "to_char (" . $sql . ", 'YYYY-MM-DD hh24:mi:ss')";
               }
               elseif (substr($tsql, 0, 4) == "DATE" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress) && !$this->Date_part)
               {
                   $sql = "to_char (" . $sql . ", 'YYYY-MM-DD')";
               }
           }
           switch ($cond)
           {
              case "EQ":
                 $nm_cmd  = $nm_ini_lower . $sql . $nm_fim_lower . " = " . $nm_ini_lower . $nm_aspas . $dados . $nm_aspas1 . $nm_fim_lower;
                 $nm_cond = $lab . " " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $this->Val_format_1 . "##*@@";
              break;
              case "II":
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
                 $nm_cmd  = $nm_ini_lower . $Nm_accent['cmp_i'] . $sql . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_all . $nm_ini_lower . "'" . $Nm_accent['arg_i'] . sc_sql_escape($this->Ini->nm_tpbanco, $dados) . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'] . $_SESSION['sc_session']['sc_sql_escape'];
                 $nm_cond = $lab . " " . $this->Ini->Nm_lang['lang_srch_strt'] . " " . $this->Val_format_1 . "##*@@";
              break;
              case "QP";
              case "NP";
                 $concat = " " . $this->Dyn_Serarch_and_or . " ";
                 if ($cond == "QP")
                 {
                     $op_all    = " #sc_like_# ";
                     $lang_like = $this->Ini->Nm_lang['lang_srch_like'];
                 }
                 else
                 {
                     $op_all    = " not #sc_like_# ";
                     $lang_like = $this->Ini->Nm_lang['lang_srch_not_like'];
                 }
                 $tmp_cond = "";
                 if (substr($tsql, 0, 4) == "DATE" && $this->Date_part)
                 {
                     if ($this->NM_data_qp['ano'] != "____")
                     {
                         $tmp_cond .= (empty($tmp_cond)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                         $tmp_cond .= $this->Ini->Nm_lang['lang_srch_year'] . " " . $this->Lang_date_part . " '<span class='scGridFilterDynValue'>" . $this->NM_data_qp['ano'] . "</span>'";
                         $nm_cmd   .= (empty($nm_cmd)) ? "" : $concat;
                         if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                         {
                             $nm_cmd .= "strftime('%Y', " . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                         {
                             $nm_cmd .= "extract(year from " . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                         {
                             if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                             {
                                 $nm_cmd .= "to_char (" . $sql . ", 'YYYY') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                             }
                             else
                             {
                                 $nm_cmd .= $this->Ini_date_char . "extract('year' from " . $sql . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                             }
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                         {
                             $nm_cmd .= "extract(year from " . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                         {
                             $nm_cmd .= "TO_CHAR(" . $sql . ", 'YYYY')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                         {
                             $nm_cmd .= "DATEPART(year, " . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
                         {
                             if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                             {
                                 $nm_cmd .= "to_char (" . $sql . ", 'YYYY') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                             }
                             else
                             {
                                 $nm_cmd .= "year(" . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                             }
                         }
                         else
                         {
                             $nm_cmd .= "year(" . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                         }
                     }
                     if ($this->NM_data_qp['mes'] != "__")
                     {
                         $tmp_cond .= (empty($tmp_cond)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                         $tmp_cond .= $this->Ini->Nm_lang['lang_srch_mnth'] . " " . $this->Lang_date_part . " '<span class='scGridFilterDynValue'>" . $this->NM_data_qp['mes'] . "</span>'";
                         $nm_cmd   .= (empty($nm_cmd)) ? "" : $concat;
                         $this->NM_data_qp['mes'] = (substr($this->NM_data_qp['mes'], 0, 1) == '0') ? substr($this->NM_data_qp['mes'], 1) : $this->NM_data_qp['mes'];
                         if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                         {
                             $nm_cmd .= "strftime('%m', " . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                         {
                             $nm_cmd .= "extract(month from " . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                         {
                             if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                             {
                                 $nm_cmd .= "to_char (" . $sql . ", 'MM') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                             }
                             else
                             {
                                 $nm_cmd .= $this->Ini_date_char . "extract('month' from " . $sql . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                             }
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                         {
                             $nm_cmd .= "extract(month from " . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                         {
                             $nm_cmd .= "TO_CHAR(" . $sql . ", 'MM')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                         {
                             $nm_cmd .= "DATEPART(month, " . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
                         {
                             if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                             {
                                 $nm_cmd .= "to_char (" . $sql . ", 'MM') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                             }
                             else
                             {
                                 $nm_cmd .= "month(" . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                             }
                         }
                         else
                         {
                             $nm_cmd .= "month(" . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['mes'] . $this->End_date_part;
                         }
                     }
                     if ($this->NM_data_qp['dia'] != "__")
                     {
                         $tmp_cond .= (empty($nm_cmd)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                         $tmp_cond .= $this->Ini->Nm_lang['lang_srch_days'] . " " . $this->Lang_date_part . " '<span class='scGridFilterDynValue'>" . $this->NM_data_qp['dia'] . "</span>'";
                         $nm_cmd  .= (empty($nm_cmd)) ? "" : $concat;
                         $this->NM_data_qp['dia'] = (substr($this->NM_data_qp['dia'], 0, 1) == '0') ? substr($this->NM_data_qp['dia'], 1) : $this->NM_data_qp['dia'];
                         if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                         {
                             $nm_cmd .= "strftime('%d', " . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                         {
                             $nm_cmd .= "extract(day from " . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                         {
                             if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                             {
                                 $nm_cmd .= "to_char (" . $sql . ", 'DD') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                             }
                             else
                             {
                                 $nm_cmd .= $this->Ini_date_char . "extract('day' from " . $sql . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                             }
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                         {
                             $nm_cmd .= "extract(day from " . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                         {
                             $nm_cmd .= "TO_CHAR(" . $sql . ", 'DD')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                         {
                             $nm_cmd .= "DATEPART(day, " . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
                         {
                             if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                             {
                                 $nm_cmd .= "to_char (" . $sql . ", 'DD') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                             }
                             else
                             {
                                 $nm_cmd .= "DAYOFMONTH(" . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                             }
                         }
                         else
                         {
                             $nm_cmd .= "day(" . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['dia'] . $this->End_date_part;
                         }
                     }
                 }
                 if (strpos($tsql, "TIME") !== false && $this->Date_part)
                 {
                     if ($this->NM_data_qp['hor'] != "__")
                     {
                         $tmp_cond .= (empty($tmp_cond)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                         $tmp_cond .= $this->Ini->Nm_lang['lang_srch_time'] . " " . $this->Lang_date_part . " '<span class='scGridFilterDynValue'>" . $this->NM_data_qp['hor'] . "</span>'";
                         $nm_cmd   .= (empty($nm_cmd)) ? "" : $concat;
                         $this->NM_data_qp['hor'] = (substr($this->NM_data_qp['hor'], 0, 1) == '0') ? substr($this->NM_data_qp['hor'], 1) : $this->NM_data_qp['hor'];
                         if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                         {
                             $nm_cmd .= "strftime('%H', " . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                         {
                             $nm_cmd .= "extract(hour from " . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                         {
                             if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                             {
                                 $nm_cmd .= "to_char (" . $sql . ", 'hh24') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                             }
                             else
                             {
                                 $nm_cmd .= $this->Ini_date_char . "extract('hour' from " . $sql . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                             }
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                         {
                             $nm_cmd .= "extract(hour from " . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                         {
                             $nm_cmd .= "TO_CHAR(" . $sql . ", 'HH24')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                         {
                             $nm_cmd .= "DATEPART(hour, " . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
                         {
                             if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                             {
                                 $nm_cmd .= "to_char (" . $sql . ", 'hh24') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                             }
                             else
                             {
                                 $nm_cmd .= "hour(" . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                             }
                         }
                         else
                         {
                             $nm_cmd .= "hour(" . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['hor'] . $this->End_date_part;
                         }
                     }
                     if ($this->NM_data_qp['min'] != "__")
                     {
                         $tmp_cond .= (empty($tmp_cond)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                         $tmp_cond .= $this->Ini->Nm_lang['lang_srch_mint'] . " " . $this->Lang_date_part . " '<span class='scGridFilterDynValue'>" . $this->NM_data_qp['min'] . "</span>'";
                         $nm_cmd   .= (empty($nm_cmd)) ? "" : $concat;
                         $this->NM_data_qp['min'] = (substr($this->NM_data_qp['min'], 0, 1) == '0') ? substr($this->NM_data_qp['min'], 1) : $this->NM_data_qp['min'];
                         if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                         {
                             $nm_cmd .= "strftime('%M', " . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                         {
                             $nm_cmd .= "extract(minute from " . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                         {
                             if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                             {
                                 $nm_cmd .= "to_char (" . $sql . ", 'mi') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                             }
                             else
                             {
                                 $nm_cmd .= $this->Ini_date_char . "extract('minute' from " . $sql . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                             }
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                         {
                             $nm_cmd .= "extract(minute from " . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                         {
                             $nm_cmd .= "TO_CHAR(" . $sql . ", 'MI')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                         {
                             $nm_cmd .= "DATEPART(minute, " . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
                         {
                             if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                             {
                                 $nm_cmd .= "to_char (" . $sql . ", 'mi') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                             }
                             else
                             {
                                 $nm_cmd .= "minute(" . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                             }
                         }
                         else
                         {
                             $nm_cmd .= "minute(" . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['min'] . $this->End_date_part;
                         }
                     }
                     if ($this->NM_data_qp['seg'] != "__")
                     {
                         $tmp_cond .= (empty($tmp_cond)) ? "" : " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " ";
                         $tmp_cond .= $this->Ini->Nm_lang['lang_srch_scnd'] . " " . $this->Lang_date_part . " '<span class='scGridFilterDynValue'>" . $this->NM_data_qp['seg'] . "</span>'";
                         $nm_cmd   .= (empty($nm_cmd)) ? "" : $concat;
                         $this->NM_data_qp['seg'] = (substr($this->NM_data_qp['seg'], 0, 1) == '0') ? substr($this->NM_data_qp['seg'], 1) : $this->NM_data_qp['seg'];
                         if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
                         {
                             $nm_cmd .= "strftime('%S', " . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                         {
                             $nm_cmd .= "extract(second from " . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
                         {
                             if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                             {
                                 $nm_cmd .= "to_char (" . $sql . ", 'ss') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['ano'] . $this->End_date_part;
                             }
                             else
                             {
                                 $nm_cmd .= $this->Ini_date_char . "extract('second' from " . $sql . ")" . $this->End_date_char . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                             }
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                         {
                             $nm_cmd .= "extract(second from " . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                         {
                             $nm_cmd .= "TO_CHAR(" . $sql . ", 'SS')" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                         {
                             $nm_cmd .= "DATEPART(second, " . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                         }
                         elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
                         {
                             if (trim($this->Operador_date_part) == "like" || trim($this->Operador_date_part) == "not like")
                             {
                                 $nm_cmd .= "to_char (" . $sql . ", 'ss') " . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                             }
                             else
                             {
                                 $nm_cmd .= "second(" . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                             }
                         }
                         else
                         {
                             $nm_cmd .= "second(" . $sql . ")" . $this->Operador_date_part . $this->Ini_date_part . $this->NM_data_qp['seg'] . $this->End_date_part;
                         }
                     }
                 }
                 if (!$this->Date_part)
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
                     $nm_cmd  .= $nm_ini_lower . $Nm_accent['cmp_i'] . $sql . $Nm_accent['cmp_f'] . $nm_fim_lower . $Nm_accent['cmp_apos'] . $op_all . $nm_ini_lower . "'%" . $Nm_accent['arg_i'] . sc_sql_escape($this->Ini->nm_tpbanco, $dados) . $Nm_accent['arg_f'] . "%'" . $nm_fim_lower . $Nm_accent['arg_apos'] . $_SESSION['sc_session']['sc_sql_escape'];
                     $nm_cond  = $lab . " " . $lang_like . " " . $this->Val_format_1 . "##*@@";
                 }
                 else
                 {
                     if (!empty($tmp_cond))
                     {
                         $nm_cond = $lab . ": " . $tmp_cond . "##*@@";
                     }
                 }
              break;
              case "DF":
                 $nm_cmd  = $nm_ini_lower . $sql . $nm_fim_lower . " <> " . $nm_ini_lower . $nm_aspas . $dados . $nm_aspas1 . $nm_fim_lower;
                 $nm_cond = $lab . " " . $this->Ini->Nm_lang['lang_srch_diff'] . " " . $this->Val_format_1 . "##*@@";
              break;
              case "GT":
                 $nm_cmd  = $nm_ini_lower . $sql . $nm_fim_lower . " > " . $nm_ini_lower . $nm_aspas . $dados . $nm_aspas1 . $nm_fim_lower;
                 $nm_cond = $lab . " " . $this->Ini->Nm_lang['lang_srch_grtr'] . " " . $this->Val_format_1 . "##*@@";
              break;
              case "GE":
                 $nm_cmd  = $nm_ini_lower . $sql . $nm_fim_lower . " >= " . $nm_ini_lower . $nm_aspas . $dados . $nm_aspas1 . $nm_fim_lower;
                 $nm_cond = $lab . " " . $this->Ini->Nm_lang['lang_srch_grtr_equl'] . " " . $this->Val_format_1 . "##*@@";
              break;
              case "LT":
                 $nm_cmd  = $nm_ini_lower . $sql . $nm_fim_lower . " < " . $nm_ini_lower . $nm_aspas . $dados . $nm_aspas1 . $nm_fim_lower;
                 $nm_cond = $lab . " " . $this->Ini->Nm_lang['lang_srch_less'] . " " . $this->Val_format_1 . "##*@@";
              break;
              case "LE":
                 $nm_cmd  = $nm_ini_lower . $sql . $nm_fim_lower . " <= " . $nm_ini_lower . $nm_aspas . $dados . $nm_aspas1 . $nm_fim_lower;
                 $nm_cond = $lab . " " . $this->Ini->Nm_lang['lang_srch_less_equl'] . " " . $this->Val_format_1 . "##*@@";
              break;
              case "BW":
                 $this->Val_BW_2  = substr($this->Db->qstr($this->Val_BW_2), 1, -1);
                 $nm_cmd = $nm_ini_lower . $sql . $nm_fim_lower . " between " . $nm_ini_lower . $nm_aspas . $dados . $nm_aspas1 . $nm_fim_lower . " and " . $nm_ini_lower . $nm_aspas . $this->Val_BW_2 . $nm_aspas1 . $nm_fim_lower;
                 $nm_cond = $lab . " " . $this->Ini->Nm_lang['lang_srch_betw'] . " " . $this->Val_format_1 . " " . $this->Ini->Nm_lang['lang_srch_and_cond'] . " " . $this->Val_format_2 . "##*@@";
              break;
              case "IN":
                 $nm_sc_valores = explode(",", $dados);
                 $cond_str = "";
                 $nm_condX  = "";
                 $ini_mult  = "";
                 $end_mult  = "";
                 if (!empty($nm_sc_valores))
                 {
                     foreach ($nm_sc_valores as $nm_sc_valor)
                     {
                        if ($tp == "N" && substr_count($nm_sc_valor, ".") > 1)
                        {
                           $nm_sc_valor = str_replace(".", "", $nm_sc_valor);
                        }
                        if ("" != $cond_str)
                        {
                           $ini_mult  = "(";
                           $end_mult  = ")";
                           $cond_str .= ",";
                           $nm_condX  .= " " . $this->Ini->Nm_lang['lang_srch_orr_cond'] . " ";
                        }
                        $cond_str .= $nm_ini_lower . $nm_aspas . $nm_sc_valor . $nm_aspas1 . $nm_fim_lower;
                        $nm_condX .= $nm_aspas . $nm_sc_valor . $nm_aspas1;
                     }
                     $nm_cmd  = $nm_ini_lower . $sql . $nm_fim_lower . " IN (" . $cond_str . ")";
                     $nm_cond = $lab . " " . $this->Ini->Nm_lang['lang_srch_equl'] . " " . $ini_mult . $nm_condX . $end_mult . "##*@@";
                 }
            break;
              case "NU":
                 $nm_cmd  = $sql . " IS NULL ";
                 $nm_cond = $lab . " " . $this->Ini->Nm_lang['lang_srch_null'] ."##*@@";
              break;
              case "NN":
                 $nm_cmd = $sql . " IS NOT NULL ";
                 $nm_cond = $lab . " " . $this->Ini->Nm_lang['lang_srch_nnul'] . "##*@@";
              break;
              case "EP":
                 $nm_cmd  = $sql . " = '' ";
                 $nm_cond = $lab . " " . $this->Ini->Nm_lang['lang_srch_empty'] ."##*@@";
              break;
              case "NE":
                 $nm_cmd = $sql . " <> '' ";
                 $nm_cond = $lab . " " . $this->Ini->Nm_lang['lang_srch_nempty'] . "##*@@";
              break;
           }
           if (!empty($nm_cmd))
           {
               if (!empty($this->Cmd_Dyn_Search))
               {
                   $this->Cmd_Dyn_Search .= " " . $this->Dyn_Serarch_and_or . " ";
               }
               $this->Cmd_Dyn_Search .= "(" . $nm_cmd . ")";
               $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['cond_dyn_search'] .= $nm_cond;
           }
   }

   function nm_prep_date(&$val, $tp, $tsql, &$cond, $format_nd)
   {
       if ($tsql == "TIMESTAMP")
       {
           $tsql = "DATETIME";
       }
       $cond = strtoupper($cond);
       if ($cond == "NU" || $cond == "NN" || $cond == "EP" || $cond == "NE")
       {
           $val    = array();
           $val[0] = "";
           return;
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
       $this->NM_data_qp['ano'] = (isset($val[0]['ano']) && !empty($val[0]['ano'])) ? $val[0]['ano'] : "____";
       $this->NM_data_qp['mes'] = (isset($val[0]['mes']) && !empty($val[0]['mes'])) ? $val[0]['mes'] : "__";
       $this->NM_data_qp['dia'] = (isset($val[0]['dia']) && !empty($val[0]['dia'])) ? $val[0]['dia'] : "__";
       $this->NM_data_qp['hor'] = (isset($val[0]['hor']) && !empty($val[0]['hor'])) ? $val[0]['hor'] : "__";
       $this->NM_data_qp['min'] = (isset($val[0]['min']) && !empty($val[0]['min'])) ? $val[0]['min'] : "__";
       $this->NM_data_qp['seg'] = (isset($val[0]['seg']) && !empty($val[0]['seg'])) ? $val[0]['seg'] : "__";
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
           if (strpos($tsql, "TIME") !== false && ($tp == "DH" || ($tp == "DT" && $cond != "LE" && $cond != "LT" && $cond != "GE" && $cond != "GT")))
           {
               if (strpos($tsql, "TIME") !== false)
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
   function dyn_convert_date($val)
   {
       $val_ok = array();
       foreach ($val as $Part_date)
       {
           if (substr($Part_date, 0, 1) == "Y")
           {
               $val_ok['ano'] = substr($Part_date, 2);
           }
           if (substr($Part_date, 0, 1) == "M")
           {
               $val_ok['mes'] = substr($Part_date, 2);
           }
           if (substr($Part_date, 0, 1) == "D")
           {
               $val_ok['dia'] = substr($Part_date, 2);
           }
           if (substr($Part_date, 0, 1) == "H")
           {
               $val_ok['hor'] = substr($Part_date, 2);
           }
           if (substr($Part_date, 0, 1) == "I")
           {
               $val_ok['min'] = substr($Part_date, 2);
           }
           if (substr($Part_date, 0, 1) == "S")
           {
               $val_ok['seg'] = substr($Part_date, 2);
           }
       }
       return $val_ok;
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
       $nmgp_saida_form = "form_hospedagem_rsvp_ar1_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['nm_run_menu'] = 2;
       $nmgp_saida_form = "form_hospedagem_rsvp_ar1_fim.php";
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
       form_hospedagem_rsvp_ar1_pack_ajax_response();
       exit;
   }
?>
<!DOCTYPE html>

   <HTML>
   <HEAD>
    <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['masterValue']);
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
    function sc_ajax_alert($sMessage, $params = array())
    {
        if ($this->NM_ajax_flag)
        {
            $this->NM_ajax_info['ajaxAlert']['message'] = NM_charset_to_utf8($sMessage);
            $this->NM_ajax_info['ajaxAlert']['params']  = $this->sc_ajax_alert_params($params);
        }
    } // sc_ajax_alert

    function sc_ajax_alert_params($params)
    {
        $paramList = array();
        foreach ($params as $paramName => $paramValue)
        {
            if (in_array($paramName, array('title', 'timer', 'confirmButtonText', 'confirmButtonFA', 'confirmButtonFAPos', 'cancelButtonText', 'cancelButtonFA', 'cancelButtonFAPos', 'footer', 'width', 'padding', 'position')))
            {
                $paramList[$paramName] = NM_charset_to_utf8($paramValue);
            }
            elseif (in_array($paramName, array('showConfirmButton', 'showCancelButton', 'toast')) && in_array($paramValue, array(true, false)))
            {
                $paramList[$paramName] = NM_charset_to_utf8($paramValue);
            }
            elseif ('position' == $paramName && in_array($paramValue, array('top', 'top-start', 'top-end', 'center', 'center-start', 'center-end', 'bottom', 'bottom-start', 'bottom-end')))
            {
                $paramList[$paramName] = NM_charset_to_utf8($paramValue);
            }
            elseif ('type' == $paramName && in_array($paramValue, array('warning', 'error', 'success', 'info', 'question')))
            {
                $paramList[$paramName] = NM_charset_to_utf8($paramValue);
            }
            elseif ('background' == $paramName)
            {
                $paramList[$paramName] = $this->sc_ajax_alert_image(NM_charset_to_utf8($paramValue));
            }
        }
        return $paramList;
    } // sc_ajax_alert_params

    function sc_ajax_alert_image($background)
    {
        $image_param = $background;
        preg_match_all('/url\(([\s])?(["|\'])?(.*?)(["|\'])?([\s])?\)/i', $background, $matches, PREG_PATTERN_ORDER);
        if (isset($matches[3])) {
            foreach ($matches[3] as $match) {
                if ('http:' != substr($match, 0, 5) && 'https:' != substr($match, 0, 6) && '/' != substr($match, 0, 1)) {
                    $image_param = str_replace($match, "{$this->Ini->path_img_global}/{$match}", $image_param);
                }
            }
        }
        return $image_param;
    } // sc_ajax_alert_image
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
            case "dynsearch":
                return array("dynamic_search_t.sc-unique-btn-1");
                break;
            case "new":
                return array("sc_b_new_t.sc-unique-btn-2", "sc_b_new_t.sc-unique-btn-3");
                break;
            case "insert":
                return array("sc_b_ins_t.sc-unique-btn-4");
                break;
            case "bcancelar":
                return array("sc_b_sai_t.sc-unique-btn-5");
                break;
            case "balterarsel":
                return array("sc_b_upd_t.sc-unique-btn-6");
                break;
            case "help":
                return array("sc_b_hlp_t");
                break;
            case "exit":
                return array("sc_b_sai_t.sc-unique-btn-7", "sc_b_sai_t.sc-unique-btn-8", "sc_b_sai_t.sc-unique-btn-10", "sc_b_sai_t.sc-unique-btn-9", "sc_b_sai_t.sc-unique-btn-11");
                break;
            case "birpara":
                return array("brec_b");
                break;
            case "first":
                return array("sc_b_ini_b.sc-unique-btn-12");
                break;
            case "back":
                return array("sc_b_ret_b.sc-unique-btn-13");
                break;
            case "forward":
                return array("sc_b_avc_b.sc-unique-btn-14");
                break;
            case "last":
                return array("sc_b_fim_b.sc-unique-btn-15");
                break;
        }

        return array($buttonName);
    } // getButtonIds

    function displayAppHeader()
    {
        if ($this->Embutida_call) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['link_info']['compact_mode']) {
            return;
        }
?>
    <tr id="sc_form_head"><td class="sc-app-header">
<?php if (!empty($_SESSION['scriptcase']['proc_mobile'])) { ?>
<style>
    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}
</style>
<div class="scFormHeader" style="height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;">
    <div class="scFormHeaderFont" style="float: left; text-transform: uppercase;"><?php if ($this->nmgp_opcao == "novo") { echo "Atualização de Hospedagem"; } else { echo "Atualização de Hospedagem"; } ?></div>
    <div class="scFormHeaderFont" style="float: right;"><?php echo date($this->dateDefaultFormat()); ?></div>
</div>
<?php } else { ?>
<style>
    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}
</style>
<div class="scFormHeader" style="height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;">
    <div class="scFormHeaderFont" style="float: left; text-transform: uppercase;"><?php if ($this->nmgp_opcao == "novo") { echo "Atualização de Hospedagem"; } else { echo "Atualização de Hospedagem"; } ?></div>
    <div class="scFormHeaderFont" style="float: right;"><?php echo date($this->dateDefaultFormat()); ?></div>
</div>
<?php } ?>

    </td></tr>
<?php
    }

    function displayAppFooter()
    {
    }

    function displayAppToolbars()
    {
        if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['run_iframe'] != "R") {
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
        $summaryLine = "[" . $this->Ini->Nm_lang['lang_othr_smry_info'] . "]";
        $summaryLine = str_replace(
            [
                '?start?',
                '?final?',
                '?total?',
            ],
            [
                'total' == $this->form_paginacao ? 1 : $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['reg_start'] + $this->summary_record_count,
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp_ar1']['ordem_ord'] == " desc") {
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
    {        if ($this->scIsFieldNumeric($fieldName)) {
            $defaultOffIcon = 'asc' == $this->scGetDefaultFieldOrder($fieldName) ? "fas fa-sort-numeric-down" : "fas fa-sort-numeric-down-alt";
            if ('desc' == $sortRule) {
                return "<span class=\"fas fa-sort-numeric-down-alt sc-form-order-icon\"></span>";
            } elseif ('asc' == $sortRule) {
                return "<span class=\"fas fa-sort-numeric-down sc-form-order-icon\"></span>";
            } else {
                return "<span class=\"" . $defaultOffIcon . " sc-form-order-icon sc-form-order-icon-unused\"></span>";
            }
        } else {
            $defaultOffIcon = 'asc' == $this->scGetDefaultFieldOrder($fieldName) ? "fas fa-sort-alpha-down" : "fas fa-sort-alpha-down-alt";
            if ('desc' == $sortRule) {
                return "<span class=\"fas fa-sort-alpha-down-alt sc-form-order-icon\"></span>";
            } elseif ('asc' == $sortRule) {
                return "<span class=\"fas fa-sort-alpha-down sc-form-order-icon\"></span>";
            } else {
                return "<span class=\"" . $defaultOffIcon . " sc-form-order-icon sc-form-order-icon-unused\"></span>";
            }
        }
    }

    function scIsFieldNumeric($fieldName)
    {
        switch ($fieldName) {
            case "hosp_id_evento":
                return true;
            case "hosp_id_hotel":
                return true;
            case "hosp_acomodacao":
                return true;
            case "hosp_categoria":
                return true;
            case "hospedagem_id":
                return true;
            case "hosp_id_participante":
                return true;
            case "hosp_id_usuario":
                return true;
            case "hosp_pagamentos":
                return true;
            case "hosp_diarias":
                return true;
            case "hosp_taxas":
                return true;
            case "hosp_total":
                return true;
            case "id_bloqueio_hotel":
                return true;
            default:
                return false;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
            case "hosp_id_evento":
                return 'desc';
            case "hosp_id_hotel":
                return 'desc';
            case "hosp_acomodacao":
                return 'desc';
            case "hosp_categoria":
                return 'desc';
            case "hospedagem_id":
                return 'desc';
            case "hosp_id_participante":
                return 'desc';
            case "hosp_id_usuario":
                return 'desc';
            case "hosp_pagamentos":
                return 'desc';
            case "hosp_dt_checkin":
                return 'desc';
            case "hosp_dt_checkout":
                return 'desc';
            case "hosp_hr_checkin":
                return 'desc';
            case "hosp_hr_checkout":
                return 'desc';
            case "hosp_diarias":
                return 'desc';
            case "hosp_taxas":
                return 'desc';
            case "hosp_total":
                return 'desc';
            case "hosp_alteracao":
                return 'desc';
            case "id_bloqueio_hotel":
                return 'desc';
            default:
                return 'asc';
        }
        return 'asc';
    }

}
?>
