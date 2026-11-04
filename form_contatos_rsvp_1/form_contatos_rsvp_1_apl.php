<?php
//
class form_contatos_rsvp_1_apl
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
   var $id_contato_;
   var $contato_id_evento_;
   var $contato_usuario_id_;
   var $contato_cpf_atendente_usuario_;
   var $contato_cpf_participante_;
   var $contato_status_;
   var $contato_status__1;
   var $contato_motivo_frase_;
   var $contato_motivo_frase__1;
   var $contato_data_hora_;
   var $contato_data_hora__hora;
   var $contato_data_;
   var $contato_hora_;
   var $contato_obs_;
   var $contato_tipo_part_;
   var $contato_ativo_;
   var $contato_ativo__1;
   var $cabecalho_;
   var $rodape_;
   var $status_icon_;
   var $usuario_atual_;
   var $usuario_id_;
   var $usuario_nivel_;
   var $ativo_;
   var $cpf_del_;
   var $sql_log_;
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
   var $form_vert_form_contatos_rsvp_1 = array();
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
   var $Grid_editavel  = true;
   var $url_webhelp = '';
   var $nm_todas_criticas;
   var $Campos_Mens_erro;
   var $nm_new_label = array();
   var $record_insert_ok = false;
   var $record_delete_ok = false;
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
          if (isset($this->NM_ajax_info['param']['ativo_']))
          {
              $this->ativo_ = $this->NM_ajax_info['param']['ativo_'];
          }
          if (isset($this->NM_ajax_info['param']['contato_ativo_']))
          {
              $this->contato_ativo_ = $this->NM_ajax_info['param']['contato_ativo_'];
          }
          if (isset($this->NM_ajax_info['param']['contato_data_']))
          {
              $this->contato_data_ = $this->NM_ajax_info['param']['contato_data_'];
          }
          if (isset($this->NM_ajax_info['param']['contato_hora_']))
          {
              $this->contato_hora_ = $this->NM_ajax_info['param']['contato_hora_'];
          }
          if (isset($this->NM_ajax_info['param']['contato_motivo_frase_']))
          {
              $this->contato_motivo_frase_ = $this->NM_ajax_info['param']['contato_motivo_frase_'];
          }
          if (isset($this->NM_ajax_info['param']['contato_obs_']))
          {
              $this->contato_obs_ = $this->NM_ajax_info['param']['contato_obs_'];
          }
          if (isset($this->NM_ajax_info['param']['contato_status_']))
          {
              $this->contato_status_ = $this->NM_ajax_info['param']['contato_status_'];
          }
          if (isset($this->NM_ajax_info['param']['csrf_token']))
          {
              $this->csrf_token = $this->NM_ajax_info['param']['csrf_token'];
          }
          if (isset($this->NM_ajax_info['param']['id_contato_']))
          {
              $this->id_contato_ = $this->NM_ajax_info['param']['id_contato_'];
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
          if (isset($this->NM_ajax_info['param']['status_icon_']))
          {
              $this->status_icon_ = $this->NM_ajax_info['param']['status_icon_'];
          }
          if (isset($this->NM_ajax_info['param']['usuario_id_']))
          {
              $this->usuario_id_ = $this->NM_ajax_info['param']['usuario_id_'];
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
      $this->sc_conv_var['id_contato'] = "id_contato_";
      $this->sc_conv_var['contato_id_evento'] = "contato_id_evento_";
      $this->sc_conv_var['contato_usuario_id'] = "contato_usuario_id_";
      $this->sc_conv_var['contato_cpf_atendente_usuario'] = "contato_cpf_atendente_usuario_";
      $this->sc_conv_var['contato_cpf_participante'] = "contato_cpf_participante_";
      $this->sc_conv_var['contato_status'] = "contato_status_";
      $this->sc_conv_var['contato_motivo_frase'] = "contato_motivo_frase_";
      $this->sc_conv_var['contato_data_hora'] = "contato_data_hora_";
      $this->sc_conv_var['contato_data'] = "contato_data_";
      $this->sc_conv_var['contato_hora'] = "contato_hora_";
      $this->sc_conv_var['contato_obs'] = "contato_obs_";
      $this->sc_conv_var['contato_tipo_part'] = "contato_tipo_part_";
      $this->sc_conv_var['contato_ativo'] = "contato_ativo_";
      $this->sc_conv_var['cabecalho'] = "cabecalho_";
      $this->sc_conv_var['rodape'] = "rodape_";
      $this->sc_conv_var['status_icon'] = "status_icon_";
      $this->sc_conv_var['usuario_atual'] = "usuario_atual_";
      $this->sc_conv_var['usuario_id'] = "usuario_id_";
      $this->sc_conv_var['usuario_nivel'] = "usuario_nivel_";
      $this->sc_conv_var['ativo'] = "ativo_";
      $this->sc_conv_var['cpf_del'] = "cpf_del_";
      $this->sc_conv_var['sql_log'] = "sql_log_";
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
      if (isset($this->vg_cpf) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['vg_cpf'] = $this->vg_cpf;
      }
      if (isset($this->vg_evento_id) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['vg_evento_id'] = $this->vg_evento_id;
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
      if (isset($_POST["vg_cpf"]) && isset($this->vg_cpf)) 
      {
          $_SESSION['vg_cpf'] = $this->vg_cpf;
      }
      if (isset($_POST["vg_evento_id"]) && isset($this->vg_evento_id)) 
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
      if (isset($_GET["vg_cpf"]) && isset($this->vg_cpf)) 
      {
          $_SESSION['vg_cpf'] = $this->vg_cpf;
      }
      if (isset($_GET["vg_evento_id"]) && isset($this->vg_evento_id)) 
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
      if (isset($this->Refresh_aba_menu)) {
          $_SESSION['sc_session'][$script_case_init]['form_contatos_rsvp_1']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_contatos_rsvp_1']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_contatos_rsvp_1']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_contatos_rsvp_1']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['form_contatos_rsvp_1']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['form_contatos_rsvp_1']['embutida_parms']);
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
                 nm_limpa_str_form_contatos_rsvp_1($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
                 if ($cadapar[0] == "id_contato_")
                 {
                     $this->NM_where_filter .= (empty($this->NM_where_filter)) ? "(" : " and ";
                     $this->NM_where_filter .= "id_contato = " . $this->id_contato_;
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
              $_SESSION['sc_session'][$script_case_init]['form_contatos_rsvp_1']['inside_nested_iframe'] = true;
          }
          if (isset($this->vg_cpf)) 
          {
              $_SESSION['vg_cpf'] = $this->vg_cpf;
          }
          if (isset($this->vg_evento_id)) 
          {
              $_SESSION['vg_evento_id'] = $this->vg_evento_id;
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
              $_SESSION['sc_session'][$script_case_init]['form_contatos_rsvp_1']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['form_contatos_rsvp_1']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['form_contatos_rsvp_1']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['form_contatos_rsvp_1']['sc_redir_insert'] = $this->sc_redir_insert;
              unset($_SESSION['sc_session'][$script_case_init]['form_contatos_rsvp_1']['opc_ant']);
          }
          if (isset($this->vg_cpf)) 
          {
              $_SESSION['vg_cpf'] = $this->vg_cpf;
          }
          if (isset($this->vg_evento_id)) 
          {
              $_SESSION['vg_evento_id'] = $this->vg_evento_id;
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
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['form_contatos_rsvp_1']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['form_contatos_rsvp_1']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['form_contatos_rsvp_1']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['form_contatos_rsvp_1']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['form_contatos_rsvp_1']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['form_contatos_rsvp_1']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_contatos_rsvp_1']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['form_contatos_rsvp_1']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['form_contatos_rsvp_1']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['form_contatos_rsvp_1']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new form_contatos_rsvp_1_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("pt_br");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['initialize'];
          $this->Db = $this->Ini->Db; 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['initialize']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['initialize'])
          {
              $_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'on';
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
   $sErrorIndex = 'geral_form_contatos_rsvp_1';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_contatos_rsvp_1';
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
        $this->NM_ajax_info['redirExit']['action'] = "form_contatos_rsvp_1_fim.php?script_case_init=" . $this->form_encode_input($this->Ini->sc_page);
        $this->NM_ajax_info['redirExit']['metodo'] = 'location';
        $this->NM_ajax_info['redirExit']['target'] = "_self";
        $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $this->Ini->path_link . "" . SC_dir_app_name('WWW-Authenticate: <type> realm=<realm>') . "/";
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_outra_jan'])
        {
            $_SESSION['scriptcase']['sc_outra_jan'] = "form_contatos_rsvp_1";
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_outra_jan'] = false;
        }
        $_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'off';
        form_contatos_rsvp_1_pack_ajax_response();
        exit;
    }
?>
<!DOCTYPE html>

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<head>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
</head>
<body>
<?php
 $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $this->Ini->path_link . "" . SC_dir_app_name('WWW-Authenticate: <type> realm=<realm>') . "/";
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "form_contatos_rsvp_1";
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_outra_jan'] = false;
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
        action="form_contatos_rsvp_1_fim.php"
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


echo '<h3>&emsp;BRSVP - Contatos ao Participante</h3>';	

$sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'form_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';
if (isset($this->sc_temp_vg_usuario_id)) { $_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_vg_menu_item)) { $_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
if (isset($this->sc_temp_parm1)) { $_SESSION['parm1'] = $this->sc_temp_parm1;}
if (isset($this->sc_temp_vg_evento_id)) { $_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_cpfseg)) { $_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
if (isset($this->sc_temp_rsvp_global)) { $_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
$_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'off';
          }
          $this->Ini->init2();
      } 
      else 
      { 
         $this->nm_data = new nm_data("pt_br");
      } 
      $_SESSION['sc_session'][$script_case_init]['form_contatos_rsvp_1']['upload_field_info'] = array();

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_contatos_rsvp_1']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_contatos_rsvp_1'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_contatos_rsvp_1']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_contatos_rsvp_1']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('form_contatos_rsvp_1') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_contatos_rsvp_1']['label'] = "" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " contatos_rsvp";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "form_contatos_rsvp_1")
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


      $this->arr_buttons['log']['hint']             = "Acesso ao LOG RSVP";
      $this->arr_buttons['log']['type']             = "button";
      $this->arr_buttons['log']['value']            = "LOG";
      $this->arr_buttons['log']['display']          = "text_fontawesomeicon";
      $this->arr_buttons['log']['display_position'] = "text_right";
      $this->arr_buttons['log']['style']            = "default";
      $this->arr_buttons['log']['image']            = "";
      $this->arr_buttons['log']['has_fa']            = "true";
      $this->arr_buttons['log']['fontawesomeicon']            = "";


      $_SESSION['scriptcase']['error_icon']['form_contatos_rsvp_1']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['form_contatos_rsvp_1'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['goto']      = 'on';
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
      $this->nmgp_botoes['LOG'] = "on";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_orig'] = " where (contato_cpf_participante = '" . $_SESSION['vg_cpf'] . "' and contato_id_evento = '" . $_SESSION['vg_evento_id'] . "')";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_pesq'] = " where (contato_cpf_participante = '" . $_SESSION['vg_cpf'] . "' and contato_id_evento = '" . $_SESSION['vg_evento_id'] . "')";
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_contatos_rsvp_1']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field . "_"] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field . "_"] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field . "_"] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field . "_"] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_contatos_rsvp_1'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_contatos_rsvp_1'];

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
              if (in_array("form_contatos_rsvp_1", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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

      if (is_file($this->Ini->path_aplicacao . 'form_contatos_rsvp_1_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'form_contatos_rsvp_1_help.txt');
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
          require_once($this->Ini->path_embutida . 'form_contatos_rsvp_1/form_contatos_rsvp_1_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "form_contatos_rsvp_1_erro.class.php"); 
      }
      $this->Erro      = new form_contatos_rsvp_1_erro();
      $this->Erro->Ini = $this->Ini;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_max_reg']) && strtolower($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_max_reg']) == "all")
      {
          $this->form_paginacao = "total";
      }
      $this->proc_fast_search = false;
      if ($this->nmgp_opcao == "fast_search")  
      {
          $this->SC_fast_search($this->nmgp_fast_search, $this->nmgp_cond_fast_search, $this->nmgp_arg_fast_search);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['opcao'] = "inicio";
          $this->nmgp_opcao = "inicio";
          $this->proc_fast_search = true;
      } 
      if ((!isset($nm_opc_lookup) || $nm_opc_lookup != "lookup") && (!isset($nm_opc_php) || $nm_opc_php != "formphp"))
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['opcao']))
         { 
             if ($this->id_contato_ != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "novo")  
      {
          $this->nmgp_botoes['LOG'] = "off";
      }
      elseif ($this->nmgp_opcao == "incluir")  
      {
          $this->nmgp_botoes['LOG'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['botoes']['LOG'];
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['final'];
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
      $_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'on';
if (!isset($this->sc_temp_vg_cpf)) {$this->sc_temp_vg_cpf = (isset($_SESSION['vg_cpf'])) ? $_SESSION['vg_cpf'] : "";}
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
   $sErrorIndex = 'geral_form_contatos_rsvp_1';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_contatos_rsvp_1';
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
 if (isset($this->sc_temp_vg_cpf)) { $_SESSION['vg_cpf'] = $this->sc_temp_vg_cpf;}
    if ($this->NM_ajax_flag)
    {
        $this->NM_ajax_info['redirExit']['action'] = "form_contatos_rsvp_1_fim.php?script_case_init=" . $this->form_encode_input($this->Ini->sc_page);
        $this->NM_ajax_info['redirExit']['metodo'] = 'location';
        $this->NM_ajax_info['redirExit']['target'] = "_self";
        $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $this->Ini->path_link . "" . SC_dir_app_name('WWW-Authenticate: <type> realm=<realm>') . "/";
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_outra_jan'])
        {
            $_SESSION['scriptcase']['sc_outra_jan'] = "form_contatos_rsvp_1";
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_outra_jan'] = false;
        }
        $_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'off';
        form_contatos_rsvp_1_pack_ajax_response();
        exit;
    }
?>
<!DOCTYPE html>

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<head>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
</head>
<body>
<?php
 $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $this->Ini->path_link . "" . SC_dir_app_name('WWW-Authenticate: <type> realm=<realm>') . "/";
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "form_contatos_rsvp_1";
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_outra_jan'] = false;
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
        action="form_contatos_rsvp_1_fim.php"
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

$sql="
SELECT 
	pessoa_cpf,pessoa_nome 
FROM 
	pessoas_rsvp 
WHERE 
	pessoa_cpf =  ".$this->Db->qstr($this->sc_temp_vg_cpf)."
ORDER BY 
	pessoa_cpf"
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
	$this->cabecalho_  = 'CONTATOS DO PARTICIPANTE: '.$this->rs[0][0].' - '.$this->rs[0][1].'  -  Evento: '.$this->sc_temp_vg_evento_id;
} else {
	$this->cabecalho_  = '';	
}
$this->contato_tipo_part_  = 'P';
if (isset($this->sc_temp_vg_usuario_id)) { $_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_vg_menu_item)) { $_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
if (isset($this->sc_temp_parm1)) { $_SESSION['parm1'] = $this->sc_temp_parm1;}
if (isset($this->sc_temp_vg_evento_id)) { $_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_cpfseg)) { $_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
if (isset($this->sc_temp_rsvp_global)) { $_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
if (isset($this->sc_temp_vg_cpf)) { $_SESSION['vg_cpf'] = $this->sc_temp_vg_cpf;}
$_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'off'; 
      }
            if ('ajax_check_file' == $this->nmgp_opcao ){
                 ob_start(); 
                 global $bol_api_prod; 
                 $bol_api_prod = true; 
                 if (isset($_SESSION['scriptcase']['form_contatos_rsvp_1']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['form_contatos_rsvp_1']['glo_nm_conexao'])) 
                 { 
                     $bol_api_prod = false;
                 } 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['form_contatos_rsvp_1']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['form_contatos_rsvp_1']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
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
      if (isset($nm_opc_lookup) && $nm_opc_lookup == "lookup")
      { 
          if ($GLOBALS['F'] == "usuario_id_")
          { 
              $nm_parms   = substr($GLOBALS['P0'], 1, strlen($GLOBALS['P0']) - 2);
              $array_vars = explode(",", $nm_parms);
              $this->contato_usuario_id_ = $array_vars[0];
              $contato_usuario_id_       = $this->contato_usuario_id_;
              nm_limpa_numero($contato_usuario_id_, $this->field_config['contato_usuario_id_']['symbol_grp']); 
              $this->contato_usuario_id_       = $contato_usuario_id_;
              $this->lookup_usuario_id_($conteudo);
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
      //-- contato_data_
      $this->field_config['contato_data_']                 = array();
      $this->field_config['contato_data_']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['contato_data_']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['contato_data_']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'contato_data_');
      //-- contato_hora_
      $this->field_config['contato_hora_']                 = array();
      $this->field_config['contato_hora_']['date_format']  = $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['contato_hora_']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['contato_hora_']['date_display'] = "hhii";
      $this->new_date_format('HH', 'contato_hora_');
      //-- id_contato_
      $this->field_config['id_contato_']               = array();
      $this->field_config['id_contato_']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['id_contato_']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['id_contato_']['symbol_dec'] = '';
      $this->field_config['id_contato_']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['id_contato_']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- contato_id_evento_
      $this->field_config['contato_id_evento_']               = array();
      $this->field_config['contato_id_evento_']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['contato_id_evento_']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['contato_id_evento_']['symbol_dec'] = '';
      $this->field_config['contato_id_evento_']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['contato_id_evento_']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- contato_usuario_id_
      $this->field_config['contato_usuario_id_']               = array();
      $this->field_config['contato_usuario_id_']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['contato_usuario_id_']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['contato_usuario_id_']['symbol_dec'] = '';
      $this->field_config['contato_usuario_id_']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['contato_usuario_id_']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- contato_data_hora_
      $this->field_config['contato_data_hora_']                 = array();
      $this->field_config['contato_data_hora_']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['contato_data_hora_']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['contato_data_hora_']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['contato_data_hora_']['date_display'] = "ddmmaaaa;hhiiss";
      $this->new_date_format('DH', 'contato_data_hora_');
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_max_reg'] = $this->nmgp_max_line;
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
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['opc_edit'] = true;  
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
         form_contatos_rsvp_1_pack_ajax_response();
         exit;
      }
      if ($this->NM_ajax_flag && 'backup_line' == $this->NM_ajax_opcao)
      {
         $this->nmgp_opcao = "igual";
         $this->nm_tira_formatacao();
         $this->nm_converte_datas();
         $this->nm_select_banco();
         $this->ajax_return_values();
         $this->NM_close_db();
         form_contatos_rsvp_1_pack_ajax_response();
         exit;
      }
      if ($this->NM_ajax_flag && 'submit_form' == $this->NM_ajax_opcao)
      {
         if (isset($this->id_contato_)) { $this->nm_limpa_alfa($this->id_contato_); }
         if (isset($this->contato_motivo_frase_)) { $this->nm_limpa_alfa($this->contato_motivo_frase_); }
         if (isset($this->Sc_num_lin_alt) && $this->Sc_num_lin_alt > 0) 
         {
             $sc_seq_vert = $this->Sc_num_lin_alt;
         }
         if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_form'][$sc_seq_vert]))
         {
             $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_form'][$sc_seq_vert];
             $this->contato_id_evento_ = $this->nmgp_dados_form['contato_id_evento_']; 
             $this->contato_usuario_id_ = $this->nmgp_dados_form['contato_usuario_id_']; 
             $this->contato_cpf_atendente_usuario_ = $this->nmgp_dados_form['contato_cpf_atendente_usuario_']; 
             $this->contato_cpf_participante_ = $this->nmgp_dados_form['contato_cpf_participante_']; 
             $this->contato_data_hora_ = $this->nmgp_dados_form['contato_data_hora_']; 
             $this->contato_tipo_part_ = $this->nmgp_dados_form['contato_tipo_part_']; 
             $this->cabecalho_ = $this->nmgp_dados_form['cabecalho_']; 
             $this->rodape_ = $this->nmgp_dados_form['rodape_']; 
             $this->usuario_atual_ = $this->nmgp_dados_form['usuario_atual_']; 
             $this->usuario_nivel_ = $this->nmgp_dados_form['usuario_nivel_']; 
             $this->cpf_del_ = $this->nmgp_dados_form['cpf_del_']; 
             $this->sql_log_ = $this->nmgp_dados_form['sql_log_']; 
         }
         $this->controle_form_vert();
         if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
         {
             $this->NM_rollback_db();
              if ($this->NM_ajax_flag)
              {
                  if (!isset($this->NM_ajax_info['errList']['geral_form_contatos_rsvp_1']) || !is_array($this->NM_ajax_info['errList']['geral_form_contatos_rsvp_1']))
                  {
                      $this->NM_ajax_info['errList']['geral_form_contatos_rsvp_1'] = array();
                  }
                  if ($Campos_Crit != "")
                  {
                      $this->NM_ajax_info['errList']['geral_form_contatos_rsvp_1'][] = $Campos_Crit;
                  }
                  if (!empty($Campos_Falta))
                  {
                      $this->NM_ajax_info['errList']['geral_form_contatos_rsvp_1'][] = $this->Formata_Campos_Falta($Campos_Falta);
                  }
                  if ($this->Campos_Mens_erro != "")
                  {
                      $this->NM_ajax_info['errList']['geral_form_contatos_rsvp_1'][] = $this->Campos_Mens_erro;
                  }
                  $this->NM_gera_nav_page(); 
                  $this->NM_ajax_info['navPage'] = $this->SC_nav_page; 
              }
         }
         else
         {
             $this->NM_commit_db();
         }
         if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form" && !$this->Apl_com_erro)
         {
             $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_teve_incl && empty($sc_todas_Crit))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_redir_atualiz'] == "ok")
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
                }         form_contatos_rsvp_1_pack_ajax_response();
         exit;
      }
      if ($this->NM_ajax_flag && 'validate_' == substr($this->NM_ajax_opcao, 0, 9))
      {
         $Campos_Crit  = "";
         $Campos_Falta = array();
         $Campos_Erros = array();
          if ('validate_contato_status_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'contato_status_');
          }
          if ('validate_contato_motivo_frase_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'contato_motivo_frase_');
          }
          if ('validate_contato_data_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'contato_data_');
          }
          if ('validate_contato_hora_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'contato_hora_');
          }
          if ('validate_contato_obs_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'contato_obs_');
          }
          if ('validate_usuario_id_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'usuario_id_');
          }
          if ('validate_contato_ativo_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'contato_ativo_');
          }
          if ('validate_id_contato_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'id_contato_');
          }
          form_contatos_rsvp_1_pack_ajax_response();
          exit;
      }
      while ($sc_contr_vert > $sc_seq_vert) 
      { 
         $Campos_Crit  = "";
         $Campos_Falta = array();
         $Campos_Erros = array();
         if ($this->nmgp_opcao == "recarga" && !isset($GLOBALS["contato_ativo_" . $sc_seq_vert]))
         { 
             $GLOBALS["contato_ativo_" . $sc_seq_vert] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_select'][$sc_seq_vert]['contato_ativo_'];
         } 
         $this->status_icon_ = $GLOBALS["status_icon_" . $sc_seq_vert]; 
         $this->contato_status_ = $GLOBALS["contato_status_" . $sc_seq_vert]; 
         $this->contato_motivo_frase_ = $GLOBALS["contato_motivo_frase_" . $sc_seq_vert]; 
         $this->contato_data_ = $GLOBALS["contato_data_" . $sc_seq_vert]; 
         $this->contato_hora_ = $GLOBALS["contato_hora_" . $sc_seq_vert]; 
         $this->contato_obs_ = $GLOBALS["contato_obs_" . $sc_seq_vert]; 
         $this->usuario_id_ = $GLOBALS["usuario_id_" . $sc_seq_vert]; 
         $this->contato_ativo_ = $GLOBALS["contato_ativo_" . $sc_seq_vert]; 
         $this->ativo_ = $GLOBALS["ativo_" . $sc_seq_vert]; 
         $this->id_contato_ = $GLOBALS["id_contato_" . $sc_seq_vert]; 
         if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_form'][$sc_seq_vert]))
         {
             $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_form'][$sc_seq_vert];
             $this->contato_id_evento_ = $this->nmgp_dados_form['contato_id_evento_']; 
             $this->contato_usuario_id_ = $this->nmgp_dados_form['contato_usuario_id_']; 
             $this->contato_cpf_atendente_usuario_ = $this->nmgp_dados_form['contato_cpf_atendente_usuario_']; 
             $this->contato_cpf_participante_ = $this->nmgp_dados_form['contato_cpf_participante_']; 
             $this->contato_data_hora_ = $this->nmgp_dados_form['contato_data_hora_']; 
             $this->contato_tipo_part_ = $this->nmgp_dados_form['contato_tipo_part_']; 
             $this->cabecalho_ = $this->nmgp_dados_form['cabecalho_']; 
             $this->rodape_ = $this->nmgp_dados_form['rodape_']; 
             $this->usuario_atual_ = $this->nmgp_dados_form['usuario_atual_']; 
             $this->usuario_nivel_ = $this->nmgp_dados_form['usuario_nivel_']; 
             $this->cpf_del_ = $this->nmgp_dados_form['cpf_del_']; 
             $this->sql_log_ = $this->nmgp_dados_form['sql_log_']; 
         }
         if (isset($this->id_contato_)) { $this->nm_limpa_alfa($this->id_contato_); }
         if (isset($this->contato_motivo_frase_)) { $this->nm_limpa_alfa($this->contato_motivo_frase_); }
         if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_form'])) 
         {
            $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_form'][$sc_seq_vert];
         }
         if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_select'])) 
         {
            $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_select'][$sc_seq_vert];
         }
         if ($this->nmgp_opcao != "recarga" && in_array($sc_seq_vert, $sc_check_excl))
         {
             $this->nmgp_opcao = "excluir";
         }
         if ($this->nmgp_opcao == "incluir" && !in_array($sc_seq_vert, $sc_check_incl))
         { }
         else
         {
             if ($this->nmgp_opcao != "incluir" && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_select'][$sc_seq_vert]['contato_ativo_']) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_disabled'][$sc_seq_vert]['contato_ativo_']))
             { 
                 $this->contato_ativo_ = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_select'][$sc_seq_vert]['contato_ativo_'];
             } 
             $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_disabled'] = array();
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
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['status_icon_'] =  $this->status_icon_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_status_'] =  $this->contato_status_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_motivo_frase_'] =  $this->contato_motivo_frase_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_data_'] =  $this->contato_data_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_hora_'] =  $this->contato_hora_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_obs_'] =  $this->contato_obs_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['usuario_id_'] =  $this->usuario_id_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_ativo_'] =  $this->contato_ativo_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['ativo_'] =  $this->ativo_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['id_contato_'] =  $this->id_contato_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_id_evento_'] =  $this->contato_id_evento_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_usuario_id_'] =  $this->contato_usuario_id_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_cpf_atendente_usuario_'] =  $this->contato_cpf_atendente_usuario_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_cpf_participante_'] =  $this->contato_cpf_participante_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_data_hora_'] =  $this->contato_data_hora_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_data_hora__hora'] =  $this->contato_data_hora__hora; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_tipo_part_'] =  $this->contato_tipo_part_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['cabecalho_'] =  $this->cabecalho_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['rodape_'] =  $this->rodape_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['usuario_atual_'] =  $this->usuario_atual_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['usuario_nivel_'] =  $this->usuario_nivel_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['cpf_del_'] =  $this->cpf_del_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['sql_log_'] =  $this->sql_log_; 
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
          $this->nmgp_opcao = "novo"; 
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
          form_contatos_rsvp_1_pack_ajax_response();
          exit;
      }
      if ($this->NM_ajax_flag && 'table_refresh' == $this->NM_ajax_opcao)
      {
          $this->nm_gera_html();
          $this->NM_ajax_info['tableRefresh'] = NM_charset_to_utf8($this->Table_refresh . $this->New_Line) . '</table>';
          $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
          $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
          $this->NM_ajax_info['rsSize'] = sizeof($this->form_vert_form_contatos_rsvp_1);
          $this->NM_ajax_info['fldList']['id_contato_']['keyVal'] = sc_htmlentities($this->nmgp_dados_form['id_contato_']);
          $this->NM_close_db();
          form_contatos_rsvp_1_pack_ajax_response();
          exit;
      }
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6))
      {
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          if ('event_contato_ativo__onchange' == $this->NM_ajax_opcao)
          {
              $this->contato_ativo__onChange();
          }
          $this->NM_close_db();
          form_contatos_rsvp_1_pack_ajax_response();
          exit;
      }
      if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form" && !$this->Apl_com_erro)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_teve_incl && empty($sc_todas_Crit))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_redir_atualiz'] == "ok")
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          if (isset($this->contato_ativo_))
          { 
              $SV_contato_ativo_ = $this->contato_ativo_;
          } 
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          if (isset($SV_contato_ativo_) && $this->nmgp_opcao != "recarga")
          { 
              $this->contato_ativo_ = $SV_contato_ativo_;
          } 
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          $this->nm_acessa_banco();
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              form_contatos_rsvp_1_pack_ajax_response();
              exit;
          }
          $this->nm_formatar_campos();
          $this->nmgp_opcao = $nm_sc_sv_opcao; 
          return; 
      }
      if ($this->nmgp_opcao == "incluir" || $this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "excluir") 
      {
          $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          $_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'off';
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
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "form_contatos_rsvp_1.zip";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " contatos_rsvp") ?></TITLE>
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
<form name="Fdown" method="get" action="form_contatos_rsvp_1_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="form_contatos_rsvp_1"> 
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
   function lookup_usuario_id_(&$conteudo)
   {
      global  $contato_usuario_id_;
      $guarda_formatado = $this->formatado;
      $this->nm_tira_formatacao();
      $Salva_opc = $this->nmgp_opcao;
      $this->nmgp_opcao = "lookup_rpc";
      $this->nm_converte_datas();
      $this->nmgp_opcao = $Salva_opc;
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
      { 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      $nm_comando = "SELECT usuario_nome 
FROM usuarios_rsvp 
WHERE usuario_id = '$this->contato_usuario_id_'
ORDER BY usuario_nome"; 
      if ($this->contato_usuario_id_ == "")
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
           case 'status_icon_':
               return "SC";
               break;
           case 'contato_status_':
               return "Status";
               break;
           case 'contato_motivo_frase_':
               return "Motivo Frase";
               break;
           case 'contato_data_':
               return "Data";
               break;
           case 'contato_hora_':
               return "Hora";
               break;
           case 'contato_obs_':
               return "Observação";
               break;
           case 'usuario_id_':
               return "Atendente";
               break;
           case 'contato_ativo_':
               return " Ativo";
               break;
           case 'ativo_':
               return "";
               break;
           case 'id_contato_':
               return "Id Contato";
               break;
           case 'contato_id_evento_':
               return "Contato Id Evento";
               break;
           case 'contato_usuario_id_':
               return "Contato Usuario Id";
               break;
           case 'contato_cpf_atendente_usuario_':
               return "Contato Cpf Atendente Usuario";
               break;
           case 'contato_cpf_participante_':
               return "Contato Cpf Participante";
               break;
           case 'contato_data_hora_':
               return "Contato Data Hora";
               break;
           case 'contato_tipo_part_':
               return "Contato Tipo Part";
               break;
           case 'cabecalho_':
               return "cabecalho";
               break;
           case 'rodape_':
               return "rodape";
               break;
           case 'usuario_atual_':
               return "Atendente OnLine";
               break;
           case 'usuario_nivel_':
               return "Usuário Nível:";
               break;
           case 'cpf_del_':
               return "cpf_del";
               break;
           case 'sql_log_':
               return "sql_log";
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

     if (!is_array($filtro) && '' == $filtro && isset($this->nm_form_submit) && '1' == $this->nm_form_submit && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['csrf_token']) && $this->scCsrfGetToken() != $this->csrf_token)
     {
          $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
          $this->Campos_Mens_erro .= "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          if ($this->NM_ajax_flag)
          {
              if (!isset($this->NM_ajax_info['errList']['geral_form_contatos_rsvp_1']) || !is_array($this->NM_ajax_info['errList']['geral_form_contatos_rsvp_1']))
              {
                  $this->NM_ajax_info['errList']['geral_form_contatos_rsvp_1'] = array();
              }
              $this->NM_ajax_info['errList']['geral_form_contatos_rsvp_1'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ((!is_array($filtro) && ('' == $filtro || 'contato_status_' == $filtro)) || (is_array($filtro) && in_array('contato_status_', $filtro)))
        $this->ValidateField_contato_status_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'contato_motivo_frase_' == $filtro)) || (is_array($filtro) && in_array('contato_motivo_frase_', $filtro)))
        $this->ValidateField_contato_motivo_frase_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'contato_data_' == $filtro)) || (is_array($filtro) && in_array('contato_data_', $filtro)))
        $this->ValidateField_contato_data_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'contato_hora_' == $filtro)) || (is_array($filtro) && in_array('contato_hora_', $filtro)))
        $this->ValidateField_contato_hora_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'contato_obs_' == $filtro)) || (is_array($filtro) && in_array('contato_obs_', $filtro)))
        $this->ValidateField_contato_obs_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'usuario_id_' == $filtro)) || (is_array($filtro) && in_array('usuario_id_', $filtro)))
        $this->ValidateField_usuario_id_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'contato_ativo_' == $filtro)) || (is_array($filtro) && in_array('contato_ativo_', $filtro)))
        $this->ValidateField_contato_ativo_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'id_contato_' == $filtro)) || (is_array($filtro) && in_array('id_contato_', $filtro)))
        $this->ValidateField_id_contato_($Campos_Crit, $Campos_Falta, $Campos_Erros);
//-- converter datas   
          $this->nm_converte_datas();
//---

      if (!isset($this->NM_ajax_flag) || 'validate_' != substr($this->NM_ajax_opcao, 0, 9))
      {
      $_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'on';
  date_default_timezone_set('America/Sao_Paulo');
$this->cpf_del_  = $this->contato_cpf_participante_ ;
$_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'off'; 
      }
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

    function ValidateField_contato_status_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['contato_status_'])) {
       return;
   }
      if ($this->contato_status_ == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'contato_status_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_contato_status_

    function ValidateField_contato_motivo_frase_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['contato_motivo_frase_'])) {
       return;
   }
      if ($this->contato_motivo_frase_ == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'contato_motivo_frase_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_contato_motivo_frase_

    function ValidateField_contato_data_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->contato_data_, $this->field_config['contato_data_']['date_sep']) ; 
      if (isset($this->Field_no_validate['contato_data_'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['contato_data_']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['contato_data_']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['contato_data_']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['contato_data_']['date_sep']) ; 
          if (trim($this->contato_data_) != "")  
          { 
              $validateTest = $teste_validade->Data($this->contato_data_, $Format_Data, $trab_dt_min, $trab_dt_max);
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Data; " ; 
                  if (!isset($Campos_Erros['contato_data_']))
                  {
                      $Campos_Erros['contato_data_'] = array();
                  }
                  $Campos_Erros['contato_data_'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['contato_data_']) || !is_array($this->NM_ajax_info['errList']['contato_data_']))
                  {
                      $this->NM_ajax_info['errList']['contato_data_'] = array();
                  }
                  $this->NM_ajax_info['errList']['contato_data_'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['contato_data_']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'contato_data_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_contato_data_

    function ValidateField_contato_hora_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_hora($this->contato_hora_, $this->field_config['contato_hora_']['time_sep']) ; 
      if (isset($this->Field_no_validate['contato_hora_'])) {
          return;
      }
      $trab_hr_min = "";
      $trab_hr_max = "";
      if ($this->nmgp_opcao != "excluir") 
      {
          $Format_Hora = $this->field_config['contato_hora_']['date_format']; 
          nm_limpa_hora($Format_Hora, $this->field_config['contato_hora_']['time_sep']) ; 
          if (trim($this->contato_hora_) != "")  
          { 
              if ($teste_validade->Hora($this->contato_hora_, $Format_Hora, $trab_hr_min, $trab_hr_max) == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Hora; " ; 
                  if (!isset($Campos_Erros['contato_hora_']))
                  {
                      $Campos_Erros['contato_hora_'] = array();
                  }
                  $Campos_Erros['contato_hora_'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['contato_hora_']) || !is_array($this->NM_ajax_info['errList']['contato_hora_']))
                  {
                      $this->NM_ajax_info['errList']['contato_hora_'] = array();
                  }
                  $this->NM_ajax_info['errList']['contato_hora_'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'contato_hora_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_contato_hora_

    function ValidateField_contato_obs_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['contato_obs_'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->contato_obs_) > 255) 
          { 
              $hasError = true;
              $Campos_Crit .= "Observação " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['contato_obs_']))
              {
                  $Campos_Erros['contato_obs_'] = array();
              }
              $Campos_Erros['contato_obs_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['contato_obs_']) || !is_array($this->NM_ajax_info['errList']['contato_obs_']))
              {
                  $this->NM_ajax_info['errList']['contato_obs_'] = array();
              }
              $this->NM_ajax_info['errList']['contato_obs_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 255 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'contato_obs_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_contato_obs_

    function ValidateField_usuario_id_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['usuario_id_'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->usuario_id_) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'usuario_id_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_usuario_id_

    function ValidateField_contato_ativo_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['contato_ativo_'])) {
       return;
   }
      if ($this->contato_ativo_ == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'contato_ativo_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_contato_ativo_

    function ValidateField_id_contato_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['id_contato_'])) {
          nm_limpa_numero($this->id_contato_, $this->field_config['id_contato_']['symbol_grp']) ; 
          return;
      }
      if ($this->id_contato_ === "" || is_null($this->id_contato_))  
      { 
          $this->id_contato_ = 0;
      } 
      nm_limpa_numero($this->id_contato_, $this->field_config['id_contato_']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_id_contato_' == $this->NM_ajax_opcao)
      { 
          if ($this->id_contato_ != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->id_contato_) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Id Contato: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['id_contato_']))
                  {
                      $Campos_Erros['id_contato_'] = array();
                  }
                  $Campos_Erros['id_contato_'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['id_contato_']) || !is_array($this->NM_ajax_info['errList']['id_contato_']))
                  {
                      $this->NM_ajax_info['errList']['id_contato_'] = array();
                  }
                  $this->NM_ajax_info['errList']['id_contato_'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->id_contato_, 11, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Id Contato; " ; 
                  if (!isset($Campos_Erros['id_contato_']))
                  {
                      $Campos_Erros['id_contato_'] = array();
                  }
                  $Campos_Erros['id_contato_'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['id_contato_']) || !is_array($this->NM_ajax_info['errList']['id_contato_']))
                  {
                      $this->NM_ajax_info['errList']['id_contato_'] = array();
                  }
                  $this->NM_ajax_info['errList']['id_contato_'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'id_contato_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_id_contato_

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
    $this->nmgp_dados_form['status_icon_'] = $this->status_icon_;
    $this->nmgp_dados_form['contato_status_'] = $this->contato_status_;
    $this->nmgp_dados_form['contato_motivo_frase_'] = $this->contato_motivo_frase_;
    $this->nmgp_dados_form['contato_data_'] = (strlen(trim($this->contato_data_)) > 19) ? str_replace(".", ":", $this->contato_data_) : trim($this->contato_data_);
    $this->nmgp_dados_form['contato_hora_'] = (strlen(trim($this->contato_hora_)) > 19) ? str_replace(".", ":", $this->contato_hora_) : trim($this->contato_hora_);
    $this->nmgp_dados_form['contato_obs_'] = $this->contato_obs_;
    $this->nmgp_dados_form['usuario_id_'] = $this->usuario_id_;
    $this->nmgp_dados_form['contato_ativo_'] = $this->contato_ativo_;
    $this->nmgp_dados_form['ativo_'] = $this->ativo_;
    $this->nmgp_dados_form['id_contato_'] = $this->id_contato_;
    $this->nmgp_dados_form['contato_id_evento_'] = $this->contato_id_evento_;
    $this->nmgp_dados_form['contato_usuario_id_'] = $this->contato_usuario_id_;
    $this->nmgp_dados_form['contato_cpf_atendente_usuario_'] = $this->contato_cpf_atendente_usuario_;
    $this->nmgp_dados_form['contato_cpf_participante_'] = $this->contato_cpf_participante_;
    $this->nmgp_dados_form['contato_data_hora_'] = $this->contato_data_hora_;
    $this->nmgp_dados_form['contato_tipo_part_'] = $this->contato_tipo_part_;
    $this->nmgp_dados_form['cabecalho_'] = $this->cabecalho_;
    $this->nmgp_dados_form['rodape_'] = $this->rodape_;
    $this->nmgp_dados_form['usuario_atual_'] = $this->usuario_atual_;
    $this->nmgp_dados_form['usuario_nivel_'] = $this->usuario_nivel_;
    $this->nmgp_dados_form['cpf_del_'] = $this->cpf_del_;
    $this->nmgp_dados_form['sql_log_'] = $this->sql_log_;
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_form'][$sc_seq_vert] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
      $this->Before_unformat['contato_data_'] = $this->contato_data_;
      nm_limpa_data($this->contato_data_, $this->field_config['contato_data_']['date_sep']) ; 
      $this->Before_unformat['contato_hora_'] = $this->contato_hora_;
      nm_limpa_hora($this->contato_hora_, $this->field_config['contato_hora_']['time_sep']) ; 
      $this->Before_unformat['id_contato_'] = $this->id_contato_;
      nm_limpa_numero($this->id_contato_, $this->field_config['id_contato_']['symbol_grp']) ; 
      $this->Before_unformat['contato_id_evento_'] = $this->contato_id_evento_;
      nm_limpa_numero($this->contato_id_evento_, $this->field_config['contato_id_evento_']['symbol_grp']) ; 
      $this->Before_unformat['contato_usuario_id_'] = $this->contato_usuario_id_;
      nm_limpa_numero($this->contato_usuario_id_, $this->field_config['contato_usuario_id_']['symbol_grp']) ; 
      $this->Before_unformat['contato_data_hora_'] = $this->contato_data_hora_;
      $this->Before_unformat['contato_data_hora__hora'] = $this->contato_data_hora__hora;
      nm_limpa_data($this->contato_data_hora_, $this->field_config['contato_data_hora_']['date_sep']) ; 
      nm_limpa_hora($this->contato_data_hora__hora, $this->field_config['contato_data_hora_']['time_sep']) ; 
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
      if ($Nome_Campo == "id_contato_")
      {
          nm_limpa_numero($this->id_contato_, $this->field_config['id_contato_']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "contato_id_evento_")
      {
          nm_limpa_numero($this->contato_id_evento_, $this->field_config['contato_id_evento_']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "contato_usuario_id_")
      {
          nm_limpa_numero($this->contato_usuario_id_, $this->field_config['contato_usuario_id_']['symbol_grp']) ; 
      }
   }
   function nm_formatar_campos($format_fields = array())
   {
      global $nm_form_submit;
      if ((!empty($this->contato_data_) && 'null' != $this->contato_data_) || (!empty($format_fields) && isset($format_fields['contato_data_'])))
      {
          nm_volta_data($this->contato_data_, $this->field_config['contato_data_']['date_format']) ; 
          nmgp_Form_Datas($this->contato_data_, $this->field_config['contato_data_']['date_format'], $this->field_config['contato_data_']['date_sep']) ;  
      }
      elseif ('null' == $this->contato_data_ || '' == $this->contato_data_)
      {
          $this->contato_data_ = '';
      }
      if ((!empty($this->contato_hora_) && 'null' != $this->contato_hora_) || (!empty($format_fields) && isset($format_fields['contato_hora_'])))
      {
          nm_volta_hora($this->contato_hora_, $this->field_config['contato_hora_']['date_format']) ; 
          nmgp_Form_Hora($this->contato_hora_, $this->field_config['contato_hora_']['date_format'], $this->field_config['contato_hora_']['time_sep']) ;  
      }
      elseif ('null' == $this->contato_hora_ || '' == $this->contato_hora_)
      {
          $this->contato_hora_ = '';
      }
      if ('' !== $this->id_contato_ || (!empty($format_fields) && isset($format_fields['id_contato_'])))
      {
          nmgp_Form_Num_Val($this->id_contato_, $this->field_config['id_contato_']['symbol_grp'], $this->field_config['id_contato_']['symbol_dec'], "0", "S", $this->field_config['id_contato_']['format_neg'], "", "", "-", $this->field_config['id_contato_']['symbol_fmt']) ; 
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
//
//-- 
   function nm_converte_datas($use_null = true, $bForce = false)
   {
      $guarda_format_hora = $this->field_config['contato_data_']['date_format'];
      if ($this->contato_data_ != "")  
      { 
          nm_conv_data($this->contato_data_, $this->field_config['contato_data_']['date_format']) ; 
          $this->contato_data__hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->contato_data__hora = substr($this->contato_data__hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->contato_data__hora = substr($this->contato_data__hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->contato_data__hora = substr($this->contato_data__hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->contato_data__hora = substr($this->contato_data__hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->contato_data__hora = substr($this->contato_data__hora, 0, -4);
          }
      } 
      if ($this->contato_data_ == "" && $use_null)  
      { 
          $this->contato_data_ = "null" ; 
      } 
      $this->field_config['contato_data_']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['contato_hora_']['date_format'];
      if ($this->contato_hora_ != "")  
      { 
          $this->contato_hora__hora = $this->contato_hora_;
          $this->contato_hora_ = "1900-01-01";
          nm_conv_hora($this->contato_hora__hora, $this->field_config['contato_hora_']['date_format']) ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->contato_hora__hora = substr($this->contato_hora__hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->contato_hora__hora = substr($this->contato_hora__hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->contato_hora__hora = substr($this->contato_hora__hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->contato_hora__hora = substr($this->contato_hora__hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->contato_hora__hora = substr($this->contato_hora__hora, 0, -4);
          }
          $this->contato_hora_ = $this->contato_hora__hora;
      } 
      if ($this->contato_hora_ == "" && $use_null)  
      { 
          $this->contato_hora_ = "null" ; 
      } 
      $this->field_config['contato_hora_']['date_format'] = $guarda_format_hora;
   }
//
   function nm_prep_date_change($cmp_date, $format_dt)
   {
       $vl_return  = "";
       if ($cmp_date != 'null') {
           $vl_return .= (strpos($format_dt, "yy") !== false) ? substr($cmp_date,  0, 4) : "";
           $vl_return .= (strpos($format_dt, "mm") !== false) ? substr($cmp_date,  5, 2) : "";
           $vl_return .= (strpos($format_dt, "dd") !== false) ? substr($cmp_date,  8, 2) : "";
           $vl_return .= (strpos($format_dt, "hh") !== false) ? substr($cmp_date, 11, 2) : "";
           $vl_return .= (strpos($format_dt, "ii") !== false) ? substr($cmp_date, 14, 2) : "";
           $vl_return .= (strpos($format_dt, "ss") !== false) ? substr($cmp_date, 17, 2) : "";
       }
       return $vl_return;
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
              $this->NM_ajax_info['fldList']['id_contato_']['keyVal'] = form_contatos_rsvp_1_pack_protect_string($this->nmgp_dados_form['id_contato_']);
          }
   } // ajax_return_values
   function ajax_return_values_all_vert()
   {
          if (isset($this->nmgp_refresh_fields) && isset($this->nmgp_refresh_row) && '' != $this->nmgp_refresh_row)
          {
              $this->form_vert_form_contatos_rsvp_1[$this->nmgp_refresh_row] = $this->NM_ajax_info['param'];
              if ((isset($this->Embutida_ronly) && $this->Embutida_ronly) || $this->NM_ajax_force_values)
              {
                  if (isset($this->NM_ajax_changed['status_icon_']) && $this->NM_ajax_changed['status_icon_'])
                  {
                      $this->form_vert_form_contatos_rsvp_1[$this->nmgp_refresh_row]['status_icon_'] = $this->status_icon_;
                  }
                  if (isset($this->NM_ajax_changed['contato_status_']) && $this->NM_ajax_changed['contato_status_'])
                  {
                      $this->form_vert_form_contatos_rsvp_1[$this->nmgp_refresh_row]['contato_status_'] = $this->contato_status_;
                  }
                  if (isset($this->NM_ajax_changed['contato_motivo_frase_']) && $this->NM_ajax_changed['contato_motivo_frase_'])
                  {
                      $this->form_vert_form_contatos_rsvp_1[$this->nmgp_refresh_row]['contato_motivo_frase_'] = $this->contato_motivo_frase_;
                  }
                  if (isset($this->NM_ajax_changed['contato_data_']) && $this->NM_ajax_changed['contato_data_'])
                  {
                      $this->form_vert_form_contatos_rsvp_1[$this->nmgp_refresh_row]['contato_data_'] = $this->contato_data_;
                  }
                  if (isset($this->NM_ajax_changed['contato_hora_']) && $this->NM_ajax_changed['contato_hora_'])
                  {
                      $this->form_vert_form_contatos_rsvp_1[$this->nmgp_refresh_row]['contato_hora_'] = $this->contato_hora_;
                  }
                  if (isset($this->NM_ajax_changed['contato_obs_']) && $this->NM_ajax_changed['contato_obs_'])
                  {
                      $this->form_vert_form_contatos_rsvp_1[$this->nmgp_refresh_row]['contato_obs_'] = $this->contato_obs_;
                  }
                  if (isset($this->NM_ajax_changed['usuario_id_']) && $this->NM_ajax_changed['usuario_id_'])
                  {
                      $this->form_vert_form_contatos_rsvp_1[$this->nmgp_refresh_row]['usuario_id_'] = $this->usuario_id_;
                  }
                  if (isset($this->NM_ajax_changed['contato_ativo_']) && $this->NM_ajax_changed['contato_ativo_'])
                  {
                      $this->form_vert_form_contatos_rsvp_1[$this->nmgp_refresh_row]['contato_ativo_'] = $this->contato_ativo_;
                  }
                  if (isset($this->NM_ajax_changed['ativo_']) && $this->NM_ajax_changed['ativo_'])
                  {
                      $this->form_vert_form_contatos_rsvp_1[$this->nmgp_refresh_row]['ativo_'] = $this->ativo_;
                  }
                  if (isset($this->NM_ajax_changed['id_contato_']) && $this->NM_ajax_changed['id_contato_'])
                  {
                      $this->form_vert_form_contatos_rsvp_1[$this->nmgp_refresh_row]['id_contato_'] = $this->id_contato_;
                  }
              }
          }
          if (isset($this->nmgp_refresh_row) && '' != $this->nmgp_refresh_row)
          {
              $this->form_vert_form_contatos_rsvp_1[$this->nmgp_refresh_row]['status_icon_'] = $this->status_icon_;
              $this->form_vert_form_contatos_rsvp_1[$this->nmgp_refresh_row]['contato_motivo_frase_'] = $this->contato_motivo_frase_;
              $this->form_vert_form_contatos_rsvp_1[$this->nmgp_refresh_row]['usuario_id_'] = $this->usuario_id_;
              $this->form_vert_form_contatos_rsvp_1[$this->nmgp_refresh_row]['ativo_'] = $this->ativo_;
          }
          $this->NM_ajax_info['rsSize']            = sizeof($this->form_vert_form_contatos_rsvp_1);
          $this->NM_ajax_info['buttonDisplayVert'] = array();
          foreach($this->form_vert_form_contatos_rsvp_1 as $sc_seq_vert => $aRecData)
          {
              $this->loadRecordState($sc_seq_vert);
              if ('navigate_form' == $this->NM_ajax_opcao) {
                  $this->NM_ajax_info['buttonDisplayVert'][] = array(
                      'seq'      => $sc_seq_vert,
                      'gridView' => true,
                      'delete'   => $this->nmgp_botoes['delete'],
                      'update'   => $this->nmgp_botoes['update'],
                  );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("status_icon_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['status_icon_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  if (empty($aRecData['status_icon_']))
                  {
                      $aRecData['status_icon_'] = "";
                  }
                  $this->NM_ajax_info['fldList']['status_icon_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'label',
                       'valList' => array($sTmpValue),
                       );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("contato_status_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['contato_status_']);
                  $aLookup = array();
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('A') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("Aberto")));
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('Y') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("Sim")));
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('N') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("Não")));
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('P') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("Pendente")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_status_'][] = 'A';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_status_'][] = 'Y';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_status_'][] = 'N';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_status_'][] = 'P';
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"contato_status_\"";
          if (isset($this->NM_ajax_info['select_html']['contato_status_']) && !empty($this->NM_ajax_info['select_html']['contato_status_']))
          {
              eval("\$sSelComp = \"" . str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['contato_status_']) . "\";");
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
                  $this->NM_ajax_info['fldList']['contato_status_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'select',
                       'valList' => array($sTmpValue),
                       );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['contato_status_' . $sc_seq_vert]['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['contato_status_' . $sc_seq_vert]['valList'][$i] = form_contatos_rsvp_1_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['contato_status_' . $sc_seq_vert]['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['contato_status_' . $sc_seq_vert]['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['contato_status_' . $sc_seq_vert]['labList'] = $aLabel;
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("contato_motivo_frase_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['contato_motivo_frase_']);
                  $aLookup = array();
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('ATIVO REALIZADO') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("ATIVO REALIZADO")));
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('TELEFONE NÃO ATENDE') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("TELEFONE NÃO ATENDE")));
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('TELEFONE ERRADO') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("TELEFONE ERRADO")));
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('CONVIDADO ENTROU EM CONTATO') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("CONVIDADO ENTROU EM CONTATO")));
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('SECRETÁRIA ENTROU EM CONTATO') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("SECRETÁRIA ENTROU EM CONTATO")));
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('TELEFONE DESLIGADO') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("TELEFONE DESLIGADO")));
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('INSCRIÇÃO VIA LINK') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("INSCRIÇÃO VIA LINK")));
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('ENVIADO VIA API') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("ENVIADO VIA API")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_motivo_frase_'][] = 'ATIVO REALIZADO';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_motivo_frase_'][] = 'TELEFONE NÃO ATENDE';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_motivo_frase_'][] = 'TELEFONE ERRADO';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_motivo_frase_'][] = 'CONVIDADO ENTROU EM CONTATO';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_motivo_frase_'][] = 'SECRETÁRIA ENTROU EM CONTATO';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_motivo_frase_'][] = 'TELEFONE DESLIGADO';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_motivo_frase_'][] = 'INSCRIÇÃO VIA LINK';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_motivo_frase_'][] = 'ENVIADO VIA API';
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"contato_motivo_frase_\"";
          if (isset($this->NM_ajax_info['select_html']['contato_motivo_frase_']) && !empty($this->NM_ajax_info['select_html']['contato_motivo_frase_']))
          {
              eval("\$sSelComp = \"" . str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['contato_motivo_frase_']) . "\";");
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
                  $this->NM_ajax_info['fldList']['contato_motivo_frase_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'select',
                       'valList' => array($sTmpValue),
                       );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['contato_motivo_frase_' . $sc_seq_vert]['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['contato_motivo_frase_' . $sc_seq_vert]['valList'][$i] = form_contatos_rsvp_1_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['contato_motivo_frase_' . $sc_seq_vert]['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['contato_motivo_frase_' . $sc_seq_vert]['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['contato_motivo_frase_' . $sc_seq_vert]['labList'] = $aLabel;
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("contato_data_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['contato_data_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['contato_data_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'label',
                       'valList' => array($sTmpValue),
                       );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("contato_hora_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['contato_hora_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['contato_hora_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'label',
                       'valList' => array($sTmpValue),
                       );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("contato_obs_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['contato_obs_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['contato_obs_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'text',
                       'valList' => array($sTmpValue),
                       );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("usuario_id_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['usuario_id_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['usuario_id_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'label',
                       'valList' => array($sTmpValue),
                       );
              $this->contato_usuario_id_ = $aRecData['contato_usuario_id_'];
              $orig_contato_usuario_id_ = $this->contato_usuario_id_;
              $contato_usuario_id_      = $this->contato_usuario_id_;
              nm_limpa_numero($contato_usuario_id_, $this->field_config['contato_usuario_id_']['symbol_grp']); 
              $this->contato_usuario_id_ = $contato_usuario_id_;
              $this->lookup_usuario_id_($conteudo);
              $this->contato_usuario_id_ = $orig_contato_usuario_id_;
              $this->NM_ajax_info['fldList']['usuario_id_' . $sc_seq_vert]['lookupCons'] = form_contatos_rsvp_1_pack_protect_string($conteudo);
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("contato_ativo_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['contato_ativo_']);
                  $aLookup = array();
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('Y') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("Ativo")));
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('N') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("Inativo")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_ativo_'][] = 'Y';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_ativo_'][] = 'N';
          $aLookupOrig = $aLookup;
          $sSelComp = "name=\"contato_ativo_\"";
          if (isset($this->NM_ajax_info['select_html']['contato_ativo_']) && !empty($this->NM_ajax_info['select_html']['contato_ativo_']))
          {
              eval("\$sSelComp = \"" . str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['contato_ativo_']) . "\";");
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
                  $this->NM_ajax_info['fldList']['contato_ativo_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'select',
                       'valList' => array($sTmpValue),
                       );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['contato_ativo_' . $sc_seq_vert]['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['contato_ativo_' . $sc_seq_vert]['valList'][$i] = form_contatos_rsvp_1_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['contato_ativo_' . $sc_seq_vert]['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['contato_ativo_' . $sc_seq_vert]['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['contato_ativo_' . $sc_seq_vert]['labList'] = $aLabel;
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("ativo_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['ativo_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  if (empty($aRecData['ativo_']))
                  {
                      $aRecData['ativo_'] = "";
                  }
                  $this->NM_ajax_info['fldList']['ativo_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'label',
                       'valList' => array($sTmpValue),
                       );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("id_contato_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['id_contato_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['id_contato_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'label',
                       'valList' => array($sTmpValue),
                       );
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['upload_dir'][$fieldName][] = $newName;
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
          $_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_ativo_ = $this->ativo_;
    $original_contato_ativo_ = $this->contato_ativo_;
    $original_contato_motivo_frase_ = $this->contato_motivo_frase_;
    $original_contato_obs_ = $this->contato_obs_;
    $original_contato_status_ = $this->contato_status_;
    $original_id_contato_ = $this->id_contato_;
    $original_status_icon_ = $this->status_icon_;
}
if (!isset($this->sc_temp_vg_cpf)) {$this->sc_temp_vg_cpf = (isset($_SESSION['vg_cpf'])) ? $_SESSION['vg_cpf'] : "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
if (!isset($this->sc_temp_rsvp_global)) {$this->sc_temp_rsvp_global = (isset($_SESSION['rsvp_global'])) ? $_SESSION['rsvp_global'] : "";}
  date_default_timezone_set('America/Sao_Paulo');
if ($this->sc_evento == "alterar" || $this->sc_evento == "update") {	
	$this->sql_log_  = $_SESSION['scriptcase']['sc_sql_ult_comando'];
} elseif ($this->sc_evento == "incluir" || $this->sc_evento == "insert") {	
	$this->sql_log_  = $_SESSION['scriptcase']['sc_sql_ult_comando'];
	$sql_log = 'SELECT LAST_INSERT_ID()';
	 
      $nm_select = $sql_log; 
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
		
	$id_Log = $this->rs[0][0];	
	$this->sql_log_  = $this->sql_log_ .' ID: '.$id_Log;	
} elseif ($this->sc_evento == "excluir" || $this->sc_evento == "delete") {		
	$this->sql_log_  = $_SESSION['scriptcase']['sc_sql_ult_comando'];
} else {
	$this->sql_log_   = $_SESSION['scriptcase']['sc_sql_ult_comando'];
}

$global_cpf = $this->sc_temp_rsvp_global['usuario_cpf'];
$modulo=  $this->Ini->nm_cod_apl;
$aplicacao = $this->Ini->nm_nome_apl;
$hora_now = date('Y-m-d H:i:s');
$ip_usuario = $this->PegaIP();
$id_usuario = $this->sc_temp_vg_usuario_id;

if ($this->sc_evento == "alterar" || $this->sc_evento == "update") {
	$acao = "ATUALIZAR";
} elseif ($this->sc_evento == "incluir" || $this->sc_evento == "insert") {
	$acao = "INSERIR";
} elseif ($this->sc_evento == "excluir" || $this->sc_evento == "delete") {	
	$acao = "EXCLUIR";	
} else {
	$acao = "ACESSO";
	$retLog = TRUE;
}

$campo_cpf = $sc_tmp_field_name = 'contato_cpf_participante';
if (isset($this->sc_conv_var['contato_cpf_participante']) && '' != $this->sc_conv_var['contato_cpf_participante'])
{
    $sc_tmp_field_name = $this->sc_conv_var['contato_cpf_participante'];
}
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] ;
$campo_evt = $sc_tmp_field_name = 'contato_id_evento';
if (isset($this->sc_conv_var['contato_id_evento']) && '' != $this->sc_conv_var['contato_id_evento'])
{
    $sc_tmp_field_name = $this->sc_conv_var['contato_id_evento'];
}
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] ;
$campo_id = $sc_tmp_field_name = 'id_contato';
if (isset($this->sc_conv_var['id_contato']) && '' != $this->sc_conv_var['id_contato'])
{
    $sc_tmp_field_name = $this->sc_conv_var['id_contato'];
}
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] ;

$vl_campo_id = $this->id_contato_ ;
$vl_campo_cpf = $this->cpf_del_ ;
$vl_campo_evt = $this->contato_id_evento_ ;
$tabela = 'contatos_rsvp';
$obs = 'Status: '.$this->contato_status_ .' - '.$this->contato_motivo_frase_ .' - '.$this->contato_obs_ ;

if ($this->sc_temp_rsvp_global['log_rsvp'] == true) { 
	if ($acao <> 'ACESSO') {
		$retLog = $this->GravaLog($hora_now,$ip_usuario,$id_usuario,$global_cpf,$modulo,$aplicacao,$acao,$campo_id,$vl_campo_id,$campo_cpf,$vl_campo_cpf,$campo_evt,$vl_campo_evt,$tabela,$obs,$this->sql_log_ );
	}	
	if ($retLog == false) {
		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Erro ao Gravar LOG";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_form_contatos_rsvp_1';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_contatos_rsvp_1';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Erro ao Gravar LOG";
 }
;		
	}	
}

$this->usuario_nivel_  = $this->GetUsuarioNivel($this->sc_temp_vg_usuario_id,'nivel');
$this->rodape_  = 'Logado: '.$this->sc_temp_vg_usuario_id.' - '.$this->usuario_nivel_ ;
$this->usuario_atual_  = $this->sc_temp_vg_usuario_id;
$this->contato_tipo_part_  = 'P';
$this->contato_id_evento_  = $this->sc_temp_vg_evento_id;
$this->contato_cpf_participante_  = $this->sc_temp_vg_cpf;

$sql="
SELECT 
	pessoa_cpf,pessoa_nome 
FROM 
	pessoas_rsvp 
WHERE 
	pessoa_cpf = ".$this->Db->qstr($this->sc_temp_vg_cpf)."
ORDER BY 
	pessoa_cpf"
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
	$this->cabecalho_  = 'CONTATOS DO PARTICIPANTE: '.$this->rs[0][0].' - '.$this->rs[0][1].'  -  Evento: '.$this->sc_temp_vg_evento_id;
} else {
	$this->cabecalho_  = '';	
}

$pathimg = '../_lib/img/';

switch($this->contato_status_ ) {
	case 'A':
		$img = 'grp__NM__img__NM__telefone_gray.png';
		$exibe = $pathimg.$img;
		$this->status_icon_  = "<img src= $exibe height='20' width='20'/>"; 	
		break;
	case 'P':
		$img = 'grp__NM__img__NM__telefone_amarelo.png';
		$exibe = $pathimg.$img;
		$this->status_icon_  = "<img src= $exibe height='20' width='20'/>"; 	
		break;		
	case 'Y':
		$img = 'grp__NM__img__NM__telefone_gre.png';
		$exibe = $pathimg.$img;
		$this->status_icon_  = "<img src= $exibe height='20' width='20'/>"; 	
		break;				
	case 'N':
		$img = 'grp__NM__img__NM__telefone_red.png';
		$exibe = $pathimg.$img;
		$this->status_icon_  = "<img src= $exibe height='20' width='20'/>"; 	
		break;				
}

$campo_1 = 'part_cpf';
$campo_2 = 'part_id_evento';
$campo_3 = 'part_ativo';
$tabela = 'participantes_rsvp';
$cpf = $this->sc_temp_vg_cpf;
$evt = $this->sc_temp_vg_evento_id;
$order = 'part_cpf, part_id_evento';
$lret  = $this->GetPresAtiva($campo_1,$campo_2,$campo_3,$tabela,$cpf,$evt,$order);
if ($lret == 'N') {
	$this->contato_ativo_   = $lret;
	if ($this->NM_ajax_flag && isset($this->nmgp_refresh_row) && !empty($this->nmgp_refresh_row)) {
    $this->sc_ajax_javascript('nm_field_disabled', array("contato_ativo_=disabled", "", $this->nmgp_refresh_row));
}
else {
    $this->sc_ajax_javascript('nm_field_disabled', array("contato_ativo_=disabled", ""));
}
;
	$this->contato_status_  = 'A';
	$img = 'grp__NM__img__NM__telefone_gray.png';
	$exibe = $pathimg.$img;
	$this->status_icon_  = "<img src= $exibe height='20' width='20'/>"; 	
}
if ($this->contato_ativo_  == 'Y') {
	$img = 'grp__NM__img__NM__on.png';
} else {
	$img = 'grp__NM__img__NM__off.png';	
}
$exibe = $pathimg.$img;
$this->ativo_  = "<img src= $exibe height='20' width='20'/>";
if (isset($this->sc_temp_rsvp_global)) { $_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
if (isset($this->sc_temp_vg_usuario_id)) { $_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_vg_evento_id)) { $_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_cpf)) { $_SESSION['vg_cpf'] = $this->sc_temp_vg_cpf;}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (($original_ativo_ != $this->ativo_ || (isset($bFlagRead_ativo_) && $bFlagRead_ativo_))&& isset($this->nmgp_refresh_row))
    {
        $this->NM_ajax_info['fldList']['ativo_' . $this->nmgp_refresh_row]['type']    = 'label';
        $this->NM_ajax_info['fldList']['ativo_' . $this->nmgp_refresh_row]['valList'] = array($this->ativo_);
        $this->NM_ajax_changed['ativo_'] = true;
    }
    if (($original_contato_ativo_ != $this->contato_ativo_ || (isset($bFlagRead_contato_ativo_) && $bFlagRead_contato_ativo_))&& isset($this->nmgp_refresh_row))
    {
        $this->NM_ajax_info['fldList']['contato_ativo_' . $this->nmgp_refresh_row]['type']    = 'select';
        $this->NM_ajax_info['fldList']['contato_ativo_' . $this->nmgp_refresh_row]['valList'] = array($this->contato_ativo_);
        $this->NM_ajax_changed['contato_ativo_'] = true;
    }
    if (($original_contato_motivo_frase_ != $this->contato_motivo_frase_ || (isset($bFlagRead_contato_motivo_frase_) && $bFlagRead_contato_motivo_frase_))&& isset($this->nmgp_refresh_row))
    {
        $this->NM_ajax_info['fldList']['contato_motivo_frase_' . $this->nmgp_refresh_row]['type']    = 'select';
        $this->NM_ajax_info['fldList']['contato_motivo_frase_' . $this->nmgp_refresh_row]['valList'] = array($this->contato_motivo_frase_);
        $this->NM_ajax_changed['contato_motivo_frase_'] = true;
    }
    if (($original_contato_obs_ != $this->contato_obs_ || (isset($bFlagRead_contato_obs_) && $bFlagRead_contato_obs_))&& isset($this->nmgp_refresh_row))
    {
        $this->NM_ajax_info['fldList']['contato_obs_' . $this->nmgp_refresh_row]['type']    = 'text';
        $this->NM_ajax_info['fldList']['contato_obs_' . $this->nmgp_refresh_row]['valList'] = array($this->contato_obs_);
        $this->NM_ajax_changed['contato_obs_'] = true;
    }
    if (($original_contato_status_ != $this->contato_status_ || (isset($bFlagRead_contato_status_) && $bFlagRead_contato_status_))&& isset($this->nmgp_refresh_row))
    {
        $this->NM_ajax_info['fldList']['contato_status_' . $this->nmgp_refresh_row]['type']    = 'select';
        $this->NM_ajax_info['fldList']['contato_status_' . $this->nmgp_refresh_row]['valList'] = array($this->contato_status_);
        $this->NM_ajax_changed['contato_status_'] = true;
    }
    if (($original_id_contato_ != $this->id_contato_ || (isset($bFlagRead_id_contato_) && $bFlagRead_id_contato_))&& isset($this->nmgp_refresh_row))
    {
        $this->NM_ajax_info['fldList']['id_contato_' . $this->nmgp_refresh_row]['type']    = 'label';
        $this->NM_ajax_info['fldList']['id_contato_' . $this->nmgp_refresh_row]['valList'] = array($this->id_contato_);
        $this->NM_ajax_changed['id_contato_'] = true;
    }
    if (($original_status_icon_ != $this->status_icon_ || (isset($bFlagRead_status_icon_) && $bFlagRead_status_icon_))&& isset($this->nmgp_refresh_row))
    {
        $this->NM_ajax_info['fldList']['status_icon_' . $this->nmgp_refresh_row]['type']    = 'label';
        $this->NM_ajax_info['fldList']['status_icon_' . $this->nmgp_refresh_row]['valList'] = array($this->status_icon_);
        $this->NM_ajax_changed['status_icon_'] = true;
    }
}
$_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'off'; 
          }
  }
  function nm_proc_onload($bFormat = true)
  {
      $Ctrl_Proc_Onload = true;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Field_no_validate'] = array();
      if (!$this->NM_ajax_flag || !isset($this->nmgp_refresh_fields)) {
      $_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_ativo_ = $this->ativo_;
    $original_contato_ativo_ = $this->contato_ativo_;
    $original_contato_status_ = $this->contato_status_;
    $original_status_icon_ = $this->status_icon_;
}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
if (!isset($this->sc_temp_vg_cpf)) {$this->sc_temp_vg_cpf = (isset($_SESSION['vg_cpf'])) ? $_SESSION['vg_cpf'] : "";}
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
  date_default_timezone_set('America/Sao_Paulo');
$this->usuario_nivel_  = $this->GetUsuarioNivel($this->sc_temp_vg_usuario_id,'nivel');
$this->RetNivel($this->usuario_nivel_ );
$this->rodape_  = 'Logado: '.$this->sc_temp_vg_usuario_id.' - '.$this->usuario_nivel_ ;

$pathimg = '../_lib/img/';

switch($this->contato_status_ ) {
	case 'A':
		$img = 'grp__NM__img__NM__telefone_gray.png';
		$exibe = $pathimg.$img;
		$this->status_icon_  = "<img src= $exibe height='20' width='20'/>"; 	
		break;
	case 'P':
		$img = 'grp__NM__img__NM__telefone_amarelo.png';
		$exibe = $pathimg.$img;
		$this->status_icon_  = "<img src= $exibe height='20' width='20'/>"; 	
		break;		
	case 'Y':
		$img = 'grp__NM__img__NM__telefone_gre.png';
		$exibe = $pathimg.$img;
		$this->status_icon_  = "<img src= $exibe height='20' width='20'/>"; 	
		break;				
	case 'N':
		$img = 'grp__NM__img__NM__telefone_red.png';
		$exibe = $pathimg.$img;
		$this->status_icon_  = "<img src= $exibe height='20' width='20'/>"; 	
		break;				
}

$campo_1 = 'part_cpf';
$campo_2 = 'part_id_evento';
$campo_3 = 'part_ativo';
$tabela = 'participantes_rsvp';
$cpf = $this->sc_temp_vg_cpf;
$evt = $this->sc_temp_vg_evento_id;
$order = 'part_cpf, part_id_evento';
$lret  = $this->GetPresAtiva($campo_1,$campo_2,$campo_3,$tabela,$cpf,$evt,$order);
if ($lret == 'N') {
	$this->contato_ativo_   = $lret;
	if ($this->NM_ajax_flag && isset($this->nmgp_refresh_row) && !empty($this->nmgp_refresh_row)) {
    $this->sc_ajax_javascript('nm_field_disabled', array("contato_ativo_=disabled", "", $this->nmgp_refresh_row));
}
else {
    $this->sc_ajax_javascript('nm_field_disabled', array("contato_ativo_=disabled", ""));
}
;
	$this->contato_status_  = 'A';
	$img = 'grp__NM__img__NM__telefone_gray.png';
	$exibe = $pathimg.$img;
	$this->status_icon_  = "<img src= $exibe height='20' width='20'/>"; 	
}
if ($this->contato_ativo_  == 'Y') {
	$img = 'grp__NM__img__NM__on.png';
} else {
	$img = 'grp__NM__img__NM__off.png';	
}
$exibe = $pathimg.$img;
$this->ativo_  = "<img src= $exibe height='20' width='20'/>";
$this->cpf_del_  = $this->contato_cpf_participante_ ;

$this->MakeColor($this->sc_temp_vg_evento_id,$this->sc_temp_vg_cpf,'I');
if (isset($this->sc_temp_vg_usuario_id)) { $_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_vg_cpf)) { $_SESSION['vg_cpf'] = $this->sc_temp_vg_cpf;}
if (isset($this->sc_temp_vg_evento_id)) { $_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (($original_ativo_ != $this->ativo_ || (isset($bFlagRead_ativo_) && $bFlagRead_ativo_))&& isset($this->nmgp_refresh_row))
    {
        $this->NM_ajax_info['fldList']['ativo_' . $this->nmgp_refresh_row]['type']    = 'label';
        $this->NM_ajax_info['fldList']['ativo_' . $this->nmgp_refresh_row]['valList'] = array($this->ativo_);
        $this->NM_ajax_changed['ativo_'] = true;
    }
    if (($original_contato_ativo_ != $this->contato_ativo_ || (isset($bFlagRead_contato_ativo_) && $bFlagRead_contato_ativo_))&& isset($this->nmgp_refresh_row))
    {
        $this->NM_ajax_info['fldList']['contato_ativo_' . $this->nmgp_refresh_row]['type']    = 'select';
        $this->NM_ajax_info['fldList']['contato_ativo_' . $this->nmgp_refresh_row]['valList'] = array($this->contato_ativo_);
        $this->NM_ajax_changed['contato_ativo_'] = true;
    }
    if (($original_contato_status_ != $this->contato_status_ || (isset($bFlagRead_contato_status_) && $bFlagRead_contato_status_))&& isset($this->nmgp_refresh_row))
    {
        $this->NM_ajax_info['fldList']['contato_status_' . $this->nmgp_refresh_row]['type']    = 'select';
        $this->NM_ajax_info['fldList']['contato_status_' . $this->nmgp_refresh_row]['valList'] = array($this->contato_status_);
        $this->NM_ajax_changed['contato_status_'] = true;
    }
    if (($original_status_icon_ != $this->status_icon_ || (isset($bFlagRead_status_icon_) && $bFlagRead_status_icon_))&& isset($this->nmgp_refresh_row))
    {
        $this->NM_ajax_info['fldList']['status_icon_' . $this->nmgp_refresh_row]['type']    = 'label';
        $this->NM_ajax_info['fldList']['status_icon_' . $this->nmgp_refresh_row]['valList'] = array($this->status_icon_);
        $this->NM_ajax_changed['status_icon_'] = true;
    }
}
$_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'off'; 
      }
      if (empty($this->contato_data_hora_))
      {
          $this->contato_data_hora__hora = $this->contato_data_hora_;
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
      global $sc_seq_vert,  $nm_form_submit, $teste_validade, $sc_where;
 
      $this->NM_val_null = array();
      $NM_val_form = array();
      $this->sc_erro_insert = "";
      $this->sc_erro_update = "";
      $this->sc_erro_delete = "";
      $this->restore_zeros_null();
    if ("incluir" == $this->nmgp_opcao) {
      $this->sc_evento = $this->nmgp_opcao;
      $_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'on';
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
  date_default_timezone_set('America/Sao_Paulo');
$this->contato_usuario_id_  = $this->sc_temp_vg_usuario_id;
if (isset($this->sc_temp_vg_usuario_id)) { $_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
$_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'off'; 
    }
      if (!empty($this->Campos_Mens_erro)) 
      {
          return;
      }
      if ($this->nmgp_opcao == "alterar")
      {
          $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_select'][$sc_seq_vert];
          if ($this->nmgp_dados_select['contato_status_'] == $this->contato_status_ &&
              $this->nmgp_dados_select['contato_motivo_frase_'] == $this->contato_motivo_frase_ &&
              $this->nmgp_dados_select['contato_data_'] == $this->contato_data_ &&
              $this->nmgp_dados_select['contato_hora_'] == $this->contato_hora_ &&
              $this->nmgp_dados_select['contato_obs_'] == $this->contato_obs_ &&
              $this->nmgp_dados_select['contato_ativo_'] == $this->contato_ativo_ &&
              $this->nmgp_dados_select['id_contato_'] == $this->id_contato_)
          { }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_select'][$sc_seq_vert]['contato_status_'] = $this->contato_status_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_select'][$sc_seq_vert]['contato_motivo_frase_'] = $this->contato_motivo_frase_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_select'][$sc_seq_vert]['contato_data_'] = $this->contato_data_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_select'][$sc_seq_vert]['contato_hora_'] = $this->contato_hora_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_select'][$sc_seq_vert]['contato_obs_'] = $this->contato_obs_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_select'][$sc_seq_vert]['contato_ativo_'] = $this->contato_ativo_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_select'][$sc_seq_vert]['id_contato_'] = $this->id_contato_;
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
      $NM_val_form['status_icon_'] = $this->status_icon_;
      $NM_val_form['contato_status_'] = $this->contato_status_;
      $NM_val_form['contato_motivo_frase_'] = $this->contato_motivo_frase_;
      $NM_val_form['contato_data_'] = $this->contato_data_;
      $NM_val_form['contato_hora_'] = $this->contato_hora_;
      $NM_val_form['contato_obs_'] = $this->contato_obs_;
      $NM_val_form['usuario_id_'] = $this->usuario_id_;
      $NM_val_form['contato_ativo_'] = $this->contato_ativo_;
      $NM_val_form['ativo_'] = $this->ativo_;
      $NM_val_form['id_contato_'] = $this->id_contato_;
      $NM_val_form['contato_id_evento_'] = $this->contato_id_evento_;
      $NM_val_form['contato_usuario_id_'] = $this->contato_usuario_id_;
      $NM_val_form['contato_cpf_atendente_usuario_'] = $this->contato_cpf_atendente_usuario_;
      $NM_val_form['contato_cpf_participante_'] = $this->contato_cpf_participante_;
      $NM_val_form['contato_data_hora_'] = $this->contato_data_hora_;
      $NM_val_form['contato_tipo_part_'] = $this->contato_tipo_part_;
      $NM_val_form['cabecalho_'] = $this->cabecalho_;
      $NM_val_form['rodape_'] = $this->rodape_;
      $NM_val_form['usuario_atual_'] = $this->usuario_atual_;
      $NM_val_form['usuario_nivel_'] = $this->usuario_nivel_;
      $NM_val_form['cpf_del_'] = $this->cpf_del_;
      $NM_val_form['sql_log_'] = $this->sql_log_;
      if ($this->id_contato_ === "" || is_null($this->id_contato_))  
      { 
          $this->id_contato_ = 0;
      } 
      if ($this->contato_id_evento_ === "" || is_null($this->contato_id_evento_))  
      { 
          $this->contato_id_evento_ = 0;
          $this->sc_force_zero[] = 'contato_id_evento_';
      } 
      if ($this->contato_usuario_id_ === "" || is_null($this->contato_usuario_id_))  
      { 
          $this->contato_usuario_id_ = 0;
          $this->sc_force_zero[] = 'contato_usuario_id_';
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      }
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_oracle, $this->Ini->nm_bases_ibase, $this->Ini->nm_bases_informix, $this->Ini->nm_bases_mysql, $this->Ini->nm_bases_access, $this->Ini->nm_bases_sqlite, $this->Ini->nm_bases_db2, array('pdo_sqlsrv'));
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          $this->contato_cpf_atendente_usuario__before_qstr = $this->contato_cpf_atendente_usuario_;
          $this->contato_cpf_atendente_usuario_ = substr($this->Db->qstr($this->contato_cpf_atendente_usuario_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->contato_cpf_atendente_usuario_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->contato_cpf_atendente_usuario_);
          }
          if ($this->contato_cpf_atendente_usuario_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->contato_cpf_atendente_usuario_ = "null"; 
              $this->NM_val_null[] = "contato_cpf_atendente_usuario_";
          } 
          $this->contato_cpf_participante__before_qstr = $this->contato_cpf_participante_;
          $this->contato_cpf_participante_ = substr($this->Db->qstr($this->contato_cpf_participante_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->contato_cpf_participante_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->contato_cpf_participante_);
          }
          if ($this->contato_cpf_participante_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->contato_cpf_participante_ = "null"; 
              $this->NM_val_null[] = "contato_cpf_participante_";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->contato_status_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->contato_status_ = "null"; 
                  $this->NM_val_null[] = "contato_status_";
              } 
          }
          $this->contato_motivo_frase__before_qstr = $this->contato_motivo_frase_;
          $this->contato_motivo_frase_ = substr($this->Db->qstr($this->contato_motivo_frase_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->contato_motivo_frase_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->contato_motivo_frase_);
          }
          if ($this->contato_motivo_frase_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->contato_motivo_frase_ = "null"; 
              $this->NM_val_null[] = "contato_motivo_frase_";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->contato_data_hora_ == "")  
              { 
                  $this->contato_data_hora_ = "null"; 
                  $this->NM_val_null[] = "contato_data_hora_";
              } 
              if ($this->contato_data_hora_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->contato_data_hora_ = "null"; 
                  $this->NM_val_null[] = "contato_data_hora_";
              } 
          }
          if ($this->contato_data_ == "")  
          { 
              $this->contato_data_ = "null"; 
              $this->NM_val_null[] = "contato_data_";
          } 
          if ($this->contato_hora_ == "")  
          { 
              $this->contato_hora_ = "null"; 
              $this->NM_val_null[] = "contato_hora_";
          } 
          $this->contato_obs__before_qstr = $this->contato_obs_;
          $this->contato_obs_ = substr($this->Db->qstr($this->contato_obs_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->contato_obs_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->contato_obs_);
          }
          if ($this->contato_obs_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->contato_obs_ = "null"; 
              $this->NM_val_null[] = "contato_obs_";
          } 
          $this->contato_tipo_part__before_qstr = $this->contato_tipo_part_;
          $this->contato_tipo_part_ = substr($this->Db->qstr($this->contato_tipo_part_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->contato_tipo_part_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->contato_tipo_part_);
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->contato_tipo_part_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->contato_tipo_part_ = "null"; 
                  $this->NM_val_null[] = "contato_tipo_part_";
              } 
          }
          if ($this->contato_ativo_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->contato_ativo_ = "null"; 
              $this->NM_val_null[] = "contato_ativo_";
          } 
      }
      if ($this->nmgp_opcao == "alterar") 
      {
          $SC_fields_update = array(); 
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['foreign_key'] as $sFKName => $sFKValue)
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
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_ ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_ "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_ ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_ "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_ ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_ "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_ ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_ "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_ ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_ "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 form_contatos_rsvp_1_pack_ajax_response();
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
                  $SC_fields_update[] = "contato_motivo_frase = '$this->contato_motivo_frase_', contato_data = #$this->contato_data_#, contato_hora = #$this->contato_hora_#, contato_obs = '$this->contato_obs_', contato_ativo = '$this->contato_ativo_'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "contato_motivo_frase = '$this->contato_motivo_frase_', contato_data = " . $this->Ini->date_delim . $this->contato_data_ . $this->Ini->date_delim1 . ", contato_hora = " . $this->Ini->date_delim . $this->contato_hora_ . $this->Ini->date_delim1 . ", contato_obs = '$this->contato_obs_', contato_ativo = '$this->contato_ativo_'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "contato_motivo_frase = '$this->contato_motivo_frase_', contato_data = " . $this->Ini->date_delim . $this->contato_data_ . $this->Ini->date_delim1 . ", contato_hora = " . $this->Ini->date_delim . $this->contato_hora_ . $this->Ini->date_delim1 . ", contato_obs = '$this->contato_obs_', contato_ativo = '$this->contato_ativo_'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "contato_motivo_frase = '$this->contato_motivo_frase_', contato_data = EXTEND('$this->contato_data_', YEAR TO DAY), contato_hora = " . $this->Ini->date_delim . $this->contato_hora_ . $this->Ini->date_delim1 . ", contato_obs = '$this->contato_obs_', contato_ativo = '$this->contato_ativo_'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "contato_motivo_frase = '$this->contato_motivo_frase_', contato_data = " . $this->Ini->date_delim . $this->contato_data_ . $this->Ini->date_delim1 . ", contato_hora = " . $this->Ini->date_delim . $this->contato_hora_ . $this->Ini->date_delim1 . ", contato_obs = '$this->contato_obs_', contato_ativo = '$this->contato_ativo_'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "contato_motivo_frase = '$this->contato_motivo_frase_', contato_data = " . $this->Ini->date_delim . $this->contato_data_ . $this->Ini->date_delim1 . ", contato_hora = " . $this->Ini->date_delim . $this->contato_hora_ . $this->Ini->date_delim1 . ", contato_obs = '$this->contato_obs_', contato_ativo = '$this->contato_ativo_'"; 
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "contato_motivo_frase = '$this->contato_motivo_frase_', contato_data = " . $this->Ini->date_delim . $this->contato_data_ . $this->Ini->date_delim1 . ", contato_hora = " . $this->Ini->date_delim . $this->contato_hora_ . $this->Ini->date_delim1 . ", contato_obs = '$this->contato_obs_', contato_ativo = '$this->contato_ativo_'"; 
              } 
              if (isset($this->contato_status_) && $this->contato_status_ != "") 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "contato_status = '$this->contato_status_'"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
                  { 
                      $SC_fields_update[] = "contato_status = '$this->contato_status_'"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                  { 
                      $SC_fields_update[] = "contato_status = '$this->contato_status_'"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
                  { 
                      $SC_fields_update[] = "contato_status = '$this->contato_status_'"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  { 
                      $SC_fields_update[] = "contato_status = '$this->contato_status_'"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
                  { 
                      $SC_fields_update[] = "contato_status = '$this->contato_status_'"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "contato_status = '$this->contato_status_'"; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['contato_id_evento_']) && $NM_val_form['contato_id_evento_'] == "null"  && $this->nmgp_dados_select['contato_id_evento_'] == "") ? "null" : $this->nmgp_dados_select['contato_id_evento_'];
              if (isset($NM_val_form['contato_id_evento_']) && $NM_val_form['contato_id_evento_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "contato_id_evento = $this->contato_id_evento_"; 
              } 
              $Prep_Tst = (isset($NM_val_form['contato_usuario_id_']) && $NM_val_form['contato_usuario_id_'] == "null"  && $this->nmgp_dados_select['contato_usuario_id_'] == "") ? "null" : $this->nmgp_dados_select['contato_usuario_id_'];
              if (isset($NM_val_form['contato_usuario_id_']) && $NM_val_form['contato_usuario_id_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "contato_usuario_id = $this->contato_usuario_id_"; 
              } 
              $Prep_Tst = (isset($NM_val_form['contato_cpf_atendente_usuario_']) && $NM_val_form['contato_cpf_atendente_usuario_'] == "null"  && $this->nmgp_dados_select['contato_cpf_atendente_usuario_'] == "") ? "null" : $this->nmgp_dados_select['contato_cpf_atendente_usuario_'];
              if (isset($NM_val_form['contato_cpf_atendente_usuario_']) && $NM_val_form['contato_cpf_atendente_usuario_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "contato_cpf_atendente_usuario = '$this->contato_cpf_atendente_usuario_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['contato_cpf_participante_']) && $NM_val_form['contato_cpf_participante_'] == "null"  && $this->nmgp_dados_select['contato_cpf_participante_'] == "") ? "null" : $this->nmgp_dados_select['contato_cpf_participante_'];
              if (isset($NM_val_form['contato_cpf_participante_']) && $NM_val_form['contato_cpf_participante_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "contato_cpf_participante = '$this->contato_cpf_participante_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['contato_data_hora_']) && $NM_val_form['contato_data_hora_'] == "null"  && $this->nmgp_dados_select['contato_data_hora_'] == "") ? "null" : $this->nmgp_dados_select['contato_data_hora_'];
              if (isset($NM_val_form['contato_data_hora_']) && $NM_val_form['contato_data_hora_'] != $Prep_Tst) 
              { 
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                  { 
                      $SC_fields_update[] = "contato_data_hora = TO_DATE('$this->contato_data_hora_', 'yyyy-mm-dd hh24:mi:ss')"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "contato_data_hora = '$this->contato_data_hora_'"; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['contato_tipo_part_']) && $NM_val_form['contato_tipo_part_'] == "null"  && $this->nmgp_dados_select['contato_tipo_part_'] == "") ? "null" : $this->nmgp_dados_select['contato_tipo_part_'];
              if (isset($NM_val_form['contato_tipo_part_']) && $NM_val_form['contato_tipo_part_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "contato_tipo_part = '$this->contato_tipo_part_'"; 
              } 
              $comando .= implode(",", $SC_fields_update);  
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $comando .= " WHERE id_contato = $this->id_contato_ ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $comando .= " WHERE id_contato = $this->id_contato_ ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando .= " WHERE id_contato = $this->id_contato_ ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando .= " WHERE id_contato = $this->id_contato_ ";  
              }  
              else  
              {
                  $comando .= " WHERE id_contato = $this->id_contato_ ";  
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
                                  form_contatos_rsvp_1_pack_ajax_response();
                              }
                              exit;  
                          }   
                      }   
                  }   
              }   
              $this->contato_cpf_atendente_usuario_ = $this->contato_cpf_atendente_usuario__before_qstr;
              $this->contato_cpf_participante_ = $this->contato_cpf_participante__before_qstr;
              $this->contato_motivo_frase_ = $this->contato_motivo_frase__before_qstr;
              $this->contato_obs_ = $this->contato_obs__before_qstr;
              $this->contato_tipo_part_ = $this->contato_tipo_part__before_qstr;
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
              $this->NM_gera_nav_page(); 
              $this->NM_ajax_info['navPage'] = $this->SC_nav_page; 

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['db_changed'] = true;
              if ($this->NM_ajax_flag) {
                  $this->NM_ajax_info['clearUpload'] = 'S';
              }

              $this->sc_teve_alt = true; 
              if     (isset($NM_val_form) && isset($NM_val_form['id_contato_'])) { $this->id_contato_ = $NM_val_form['id_contato_']; }
              elseif (isset($this->id_contato_)) { $this->nm_limpa_alfa($this->id_contato_); }
              if     (isset($NM_val_form) && isset($NM_val_form['contato_motivo_frase_'])) { $this->contato_motivo_frase_ = $NM_val_form['contato_motivo_frase_']; }
              elseif (isset($this->contato_motivo_frase_)) { $this->nm_limpa_alfa($this->contato_motivo_frase_); }
              $this->nm_proc_onload_record($this->nmgp_refresh_row);

              $this->nm_formatar_campos();
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
              }

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('status_icon_', 'contato_status_', 'contato_motivo_frase_', 'contato_data_', 'contato_hora_', 'contato_obs_', 'usuario_id_', 'contato_ativo_', 'ativo_', 'id_contato_'), $aDoNotUpdate);
              $this->ajax_return_values();
              $this->nmgp_refresh_fields = $aOldRefresh;

              if (isset($this->Embutida_ronly) && $this->Embutida_ronly)
              {

                  $this->NM_ajax_info['readOnly']['status_icon_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['contato_status_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['contato_motivo_frase_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['contato_data_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['contato_hora_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['contato_obs_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['usuario_id_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['contato_ativo_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['ativo_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['id_contato_' . $this->nmgp_refresh_row] = 'on';


                  $this->NM_ajax_info['closeLine'] = $this->nmgp_refresh_row;
              }

              $this->nm_tira_formatacao();
              $this->nm_converte_datas();
          }  
      }  
      if ($this->nmgp_opcao == "incluir") 
      { 
          $NM_cmp_auto = "";
          $NM_seq_auto = "";
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['foreign_key'] as $sFKName => $sFKValue)
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
              $NM_cmp_auto = "id_contato, ";
          } 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(id_contato) from " . $this->Ini->nm_tabela; 
          $comando = "select max(id_contato) from " . $this->Ini->nm_tabela; 
          $rs = $this->Db->Execute($comando); 
          if ($rs === false && !$rs->EOF)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
              $this->NM_rollback_db(); 
              if ($this->NM_ajax_flag)
              {
                  form_contatos_rsvp_1_pack_ajax_response();
              }
              exit; 
          }  
          $this->id_contato__before_qstr = $this->id_contato_ = $rs->fields[0] + 1;
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
                  if ($this->contato_status_ != "")
                  { 
                       $compl_insert     .= ", contato_status";
                       $compl_insert_val .= ", '$this->contato_status_'";
                  } 
                  if ($this->contato_data_hora_ != "")
                  { 
                       $compl_insert     .= ", contato_data_hora";
                       $compl_insert_val .= ", '$this->contato_data_hora_'";
                  } 
                  if ($this->contato_tipo_part_ != "")
                  { 
                       $compl_insert     .= ", contato_tipo_part";
                       $compl_insert_val .= ", '$this->contato_tipo_part_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (contato_id_evento, contato_usuario_id, contato_cpf_atendente_usuario, contato_cpf_participante, contato_motivo_frase, contato_data, contato_hora, contato_obs, contato_ativo $compl_insert) VALUES ($this->contato_id_evento_, $this->contato_usuario_id_, '$this->contato_cpf_atendente_usuario_', '$this->contato_cpf_participante_', '$this->contato_motivo_frase_', #$this->contato_data_#, #$this->contato_hora_#, '$this->contato_obs_', '$this->contato_ativo_' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->contato_status_ != "")
                  { 
                       $compl_insert     .= ", contato_status";
                       $compl_insert_val .= ", '$this->contato_status_'";
                  } 
                  if ($this->contato_data_hora_ != "")
                  { 
                       $compl_insert     .= ", contato_data_hora";
                       $compl_insert_val .= ", '$this->contato_data_hora_'";
                  } 
                  if ($this->contato_tipo_part_ != "")
                  { 
                       $compl_insert     .= ", contato_tipo_part";
                       $compl_insert_val .= ", '$this->contato_tipo_part_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "contato_id_evento, contato_usuario_id, contato_cpf_atendente_usuario, contato_cpf_participante, contato_motivo_frase, contato_data, contato_hora, contato_obs, contato_ativo $compl_insert) VALUES (" . $NM_seq_auto . "$this->contato_id_evento_, $this->contato_usuario_id_, '$this->contato_cpf_atendente_usuario_', '$this->contato_cpf_participante_', '$this->contato_motivo_frase_', " . $this->Ini->date_delim . $this->contato_data_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->contato_hora_ . $this->Ini->date_delim1 . ", '$this->contato_obs_', '$this->contato_ativo_' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
              { 
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->contato_status_ != "")
                  { 
                       $compl_insert     .= ", contato_status";
                       $compl_insert_val .= ", '$this->contato_status_'";
                  } 
                  if ($this->contato_data_hora_ != "")
                  { 
                       $compl_insert     .= ", contato_data_hora";
                       $compl_insert_val .= ", '$this->contato_data_hora_'";
                  } 
                  if ($this->contato_tipo_part_ != "")
                  { 
                       $compl_insert     .= ", contato_tipo_part";
                       $compl_insert_val .= ", '$this->contato_tipo_part_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "contato_id_evento, contato_usuario_id, contato_cpf_atendente_usuario, contato_cpf_participante, contato_motivo_frase, contato_data, contato_hora, contato_obs, contato_ativo $compl_insert) VALUES (" . $NM_seq_auto . "$this->contato_id_evento_, $this->contato_usuario_id_, '$this->contato_cpf_atendente_usuario_', '$this->contato_cpf_participante_', '$this->contato_motivo_frase_', " . $this->Ini->date_delim . $this->contato_data_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->contato_hora_ . $this->Ini->date_delim1 . ", '$this->contato_obs_', '$this->contato_ativo_' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->contato_status_ != "")
                  { 
                       $compl_insert     .= ", contato_status";
                       $compl_insert_val .= ", '$this->contato_status_'";
                  } 
                  if ($this->contato_data_hora_ != "")
                  { 
                       $compl_insert     .= ", contato_data_hora";
                       $compl_insert_val .= ", TO_DATE('$this->contato_data_hora_', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->contato_tipo_part_ != "")
                  { 
                       $compl_insert     .= ", contato_tipo_part";
                       $compl_insert_val .= ", '$this->contato_tipo_part_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "contato_id_evento, contato_usuario_id, contato_cpf_atendente_usuario, contato_cpf_participante, contato_motivo_frase, contato_data, contato_hora, contato_obs, contato_ativo $compl_insert) VALUES (" . $NM_seq_auto . "$this->contato_id_evento_, $this->contato_usuario_id_, '$this->contato_cpf_atendente_usuario_', '$this->contato_cpf_participante_', '$this->contato_motivo_frase_', " . $this->Ini->date_delim . $this->contato_data_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->contato_hora_ . $this->Ini->date_delim1 . ", '$this->contato_obs_', '$this->contato_ativo_' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->contato_status_ != "")
                  { 
                       $compl_insert     .= ", contato_status";
                       $compl_insert_val .= ", '$this->contato_status_'";
                  } 
                  if ($this->contato_data_hora_ != "")
                  { 
                       $compl_insert     .= ", contato_data_hora";
                       $compl_insert_val .= ", '$this->contato_data_hora_'";
                  } 
                  if ($this->contato_tipo_part_ != "")
                  { 
                       $compl_insert     .= ", contato_tipo_part";
                       $compl_insert_val .= ", '$this->contato_tipo_part_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "contato_id_evento, contato_usuario_id, contato_cpf_atendente_usuario, contato_cpf_participante, contato_motivo_frase, contato_data, contato_hora, contato_obs, contato_ativo $compl_insert) VALUES (" . $NM_seq_auto . "$this->contato_id_evento_, $this->contato_usuario_id_, '$this->contato_cpf_atendente_usuario_', '$this->contato_cpf_participante_', '$this->contato_motivo_frase_', EXTEND('$this->contato_data_', YEAR TO DAY), " . $this->Ini->date_delim . $this->contato_hora_ . $this->Ini->date_delim1 . ", '$this->contato_obs_', '$this->contato_ativo_' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->contato_status_ != "")
                  { 
                       $compl_insert     .= ", contato_status";
                       $compl_insert_val .= ", '$this->contato_status_'";
                  } 
                  if ($this->contato_data_hora_ != "")
                  { 
                       $compl_insert     .= ", contato_data_hora";
                       $compl_insert_val .= ", '$this->contato_data_hora_'";
                  } 
                  if ($this->contato_tipo_part_ != "")
                  { 
                       $compl_insert     .= ", contato_tipo_part";
                       $compl_insert_val .= ", '$this->contato_tipo_part_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "contato_id_evento, contato_usuario_id, contato_cpf_atendente_usuario, contato_cpf_participante, contato_motivo_frase, contato_data, contato_hora, contato_obs, contato_ativo $compl_insert) VALUES (" . $NM_seq_auto . "$this->contato_id_evento_, $this->contato_usuario_id_, '$this->contato_cpf_atendente_usuario_', '$this->contato_cpf_participante_', '$this->contato_motivo_frase_', " . $this->Ini->date_delim . $this->contato_data_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->contato_hora_ . $this->Ini->date_delim1 . ", '$this->contato_obs_', '$this->contato_ativo_' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->contato_status_ != "")
                  { 
                       $compl_insert     .= ", contato_status";
                       $compl_insert_val .= ", '$this->contato_status_'";
                  } 
                  if ($this->contato_data_hora_ != "")
                  { 
                       $compl_insert     .= ", contato_data_hora";
                       $compl_insert_val .= ", '$this->contato_data_hora_'";
                  } 
                  if ($this->contato_tipo_part_ != "")
                  { 
                       $compl_insert     .= ", contato_tipo_part";
                       $compl_insert_val .= ", '$this->contato_tipo_part_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "contato_id_evento, contato_usuario_id, contato_cpf_atendente_usuario, contato_cpf_participante, contato_motivo_frase, contato_data, contato_hora, contato_obs, contato_ativo $compl_insert) VALUES (" . $NM_seq_auto . "$this->contato_id_evento_, $this->contato_usuario_id_, '$this->contato_cpf_atendente_usuario_', '$this->contato_cpf_participante_', '$this->contato_motivo_frase_', " . $this->Ini->date_delim . $this->contato_data_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->contato_hora_ . $this->Ini->date_delim1 . ", '$this->contato_obs_', '$this->contato_ativo_' $compl_insert_val)"; 
              }
              elseif ($this->Ini->nm_tpbanco == 'pdo_ibm')
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->contato_status_ != "")
                  { 
                       $compl_insert     .= ", contato_status";
                       $compl_insert_val .= ", '$this->contato_status_'";
                  } 
                  if ($this->contato_data_hora_ != "")
                  { 
                       $compl_insert     .= ", contato_data_hora";
                       $compl_insert_val .= ", TO_DATE('$this->contato_data_hora_', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->contato_tipo_part_ != "")
                  { 
                       $compl_insert     .= ", contato_tipo_part";
                       $compl_insert_val .= ", '$this->contato_tipo_part_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "contato_id_evento, contato_usuario_id, contato_cpf_atendente_usuario, contato_cpf_participante, contato_motivo_frase, contato_data, contato_hora, contato_obs, contato_ativo $compl_insert) VALUES (" . $NM_seq_auto . "$this->contato_id_evento_, $this->contato_usuario_id_, '$this->contato_cpf_atendente_usuario_', '$this->contato_cpf_participante_', '$this->contato_motivo_frase_', " . $this->Ini->date_delim . $this->contato_data_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->contato_hora_ . $this->Ini->date_delim1 . ", '$this->contato_obs_', '$this->contato_ativo_' $compl_insert_val)"; 
              }
              else
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->contato_status_ != "")
                  { 
                       $compl_insert     .= ", contato_status";
                       $compl_insert_val .= ", '$this->contato_status_'";
                  } 
                  if ($this->contato_data_hora_ != "")
                  { 
                       $compl_insert     .= ", contato_data_hora";
                       $compl_insert_val .= ", '$this->contato_data_hora_'";
                  } 
                  if ($this->contato_tipo_part_ != "")
                  { 
                       $compl_insert     .= ", contato_tipo_part";
                       $compl_insert_val .= ", '$this->contato_tipo_part_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "contato_id_evento, contato_usuario_id, contato_cpf_atendente_usuario, contato_cpf_participante, contato_motivo_frase, contato_data, contato_hora, contato_obs, contato_ativo $compl_insert) VALUES (" . $NM_seq_auto . "$this->contato_id_evento_, $this->contato_usuario_id_, '$this->contato_cpf_atendente_usuario_', '$this->contato_cpf_participante_', '$this->contato_motivo_frase_', " . $this->Ini->date_delim . $this->contato_data_ . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->contato_hora_ . $this->Ini->date_delim1 . ", '$this->contato_obs_', '$this->contato_ativo_' $compl_insert_val)"; 
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
                              form_contatos_rsvp_1_pack_ajax_response();
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
                          form_contatos_rsvp_1_pack_ajax_response();
                      }
                      exit; 
                  } 
                  $this->id_contato_ =  $rsy->fields[0];
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
                  $this->id_contato_ = $rsy->fields[0];
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
                  $this->id_contato_ = $rsy->fields[0];
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
                  $this->id_contato_ = $rsy->fields[0];
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
                  $this->id_contato_ = $rsy->fields[0];
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
                  $this->id_contato_ = $rsy->fields[0];
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
                  $this->id_contato_ = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              $this->contato_cpf_atendente_usuario_ = $this->contato_cpf_atendente_usuario__before_qstr;
              $this->contato_cpf_participante_ = $this->contato_cpf_participante__before_qstr;
              $this->contato_motivo_frase_ = $this->contato_motivo_frase__before_qstr;
              $this->contato_obs_ = $this->contato_obs__before_qstr;
              $this->contato_tipo_part_ = $this->contato_tipo_part__before_qstr;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['db_changed'] = true;

              $this->sc_evento = "insert"; 
              $this->contato_cpf_atendente_usuario_ = $this->contato_cpf_atendente_usuario__before_qstr;
              $this->contato_cpf_participante_ = $this->contato_cpf_participante__before_qstr;
              $this->contato_motivo_frase_ = $this->contato_motivo_frase__before_qstr;
              $this->contato_obs_ = $this->contato_obs__before_qstr;
              $this->contato_tipo_part_ = $this->contato_tipo_part__before_qstr;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['total']++; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_qtd']++; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_I_E']++; 
              $this->NM_ajax_info['navSummary']['reg_ini'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] + 1; 
              $this->NM_ajax_info['navSummary']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_qtd']; 
              $this->NM_ajax_info['navSummary']['reg_tot'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['total'] + 1; 
              $this->NM_gera_nav_page(); 
              $this->NM_ajax_info['navPage'] = $this->SC_nav_page; 
              $this->sc_teve_incl = true; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_select'][$sc_seq_vert]['contato_status_'] = $this->contato_status_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_select'][$sc_seq_vert]['contato_motivo_frase_'] = $this->contato_motivo_frase_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_select'][$sc_seq_vert]['contato_data_'] = $this->contato_data_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_select'][$sc_seq_vert]['contato_hora_'] = $this->contato_hora_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_select'][$sc_seq_vert]['contato_obs_'] = $this->contato_obs_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_select'][$sc_seq_vert]['contato_ativo_'] = $this->contato_ativo_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_select'][$sc_seq_vert]['id_contato_'] = $this->id_contato_;
              $this->restore_zeros_null();
              if (isset($this->id_contato_)) { $this->nm_limpa_alfa($this->id_contato_); }
              if (isset($this->contato_motivo_frase_)) { $this->nm_limpa_alfa($this->contato_motivo_frase_); }
              if (isset($this->Embutida_form) && $this->Embutida_form)
              {
                  $this->nm_guardar_campos();
                  $this->nm_proc_onload_record($this->nmgp_refresh_row);
                  $this->nm_formatar_campos();

                  $tmpLabel_status_icon_ = $this->status_icon_;
                  $this->NM_ajax_info['fldList']['status_icon_' . $this->nmgp_refresh_row]['type']    = 'label';
                  $this->NM_ajax_info['fldList']['status_icon_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->status_icon_)));
                  $this->NM_ajax_info['fldList']['status_icon_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_status_icon_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['status_icon_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['status_icon_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['status_icon_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['status_icon_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $aLookup = array();
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('A') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("Aberto")));
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('Y') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("Sim")));
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('N') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("Não")));
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('P') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("Pendente")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_status_'][] = 'A';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_status_'][] = 'Y';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_status_'][] = 'N';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_status_'][] = 'P';
          $sLabelTemp = '';
          foreach ($aLookup as $aValData)
          {
              if (key($aValData) == form_contatos_rsvp_1_pack_protect_string(NM_charset_to_utf8($this->contato_status_)))
              {
                  $sLabelTemp = current($aValData);
              }
          }
          $tmpLabel_contato_status_ = $sLabelTemp;
                  $this->NM_ajax_info['fldList']['contato_status_' . $this->nmgp_refresh_row]['type']    = 'select';
                  $this->NM_ajax_info['fldList']['contato_status_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->contato_status_)));
                  $this->NM_ajax_info['fldList']['contato_status_' . $this->nmgp_refresh_row]['labList'] = array($tmpLabel_contato_status_);

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['contato_status_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['contato_status_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['contato_status_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['contato_status_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $aLookup = array();
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('ATIVO REALIZADO') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("ATIVO REALIZADO")));
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('TELEFONE NÃO ATENDE') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("TELEFONE NÃO ATENDE")));
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('TELEFONE ERRADO') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("TELEFONE ERRADO")));
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('CONVIDADO ENTROU EM CONTATO') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("CONVIDADO ENTROU EM CONTATO")));
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('SECRETÁRIA ENTROU EM CONTATO') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("SECRETÁRIA ENTROU EM CONTATO")));
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('TELEFONE DESLIGADO') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("TELEFONE DESLIGADO")));
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('INSCRIÇÃO VIA LINK') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("INSCRIÇÃO VIA LINK")));
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('ENVIADO VIA API') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("ENVIADO VIA API")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_motivo_frase_'][] = 'ATIVO REALIZADO';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_motivo_frase_'][] = 'TELEFONE NÃO ATENDE';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_motivo_frase_'][] = 'TELEFONE ERRADO';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_motivo_frase_'][] = 'CONVIDADO ENTROU EM CONTATO';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_motivo_frase_'][] = 'SECRETÁRIA ENTROU EM CONTATO';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_motivo_frase_'][] = 'TELEFONE DESLIGADO';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_motivo_frase_'][] = 'INSCRIÇÃO VIA LINK';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_motivo_frase_'][] = 'ENVIADO VIA API';
          $sLabelTemp = '';
          foreach ($aLookup as $aValData)
          {
              if (key($aValData) == form_contatos_rsvp_1_pack_protect_string(NM_charset_to_utf8($this->contato_motivo_frase_)))
              {
                  $sLabelTemp = current($aValData);
              }
          }
          $tmpLabel_contato_motivo_frase_ = $sLabelTemp;
                  $this->NM_ajax_info['fldList']['contato_motivo_frase_' . $this->nmgp_refresh_row]['type']    = 'select';
                  $this->NM_ajax_info['fldList']['contato_motivo_frase_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->contato_motivo_frase_)));
                  $this->NM_ajax_info['fldList']['contato_motivo_frase_' . $this->nmgp_refresh_row]['labList'] = array($tmpLabel_contato_motivo_frase_);

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['contato_motivo_frase_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['contato_motivo_frase_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['contato_motivo_frase_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['contato_motivo_frase_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $tmpLabel_contato_data_ = $this->contato_data_;
                  $this->NM_ajax_info['fldList']['contato_data_' . $this->nmgp_refresh_row]['type']    = 'label';
                  $this->NM_ajax_info['fldList']['contato_data_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->contato_data_)));
                  $this->NM_ajax_info['fldList']['contato_data_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_contato_data_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['contato_data_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['contato_data_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['contato_data_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['contato_data_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $tmpLabel_contato_hora_ = $this->contato_hora_;
                  $this->NM_ajax_info['fldList']['contato_hora_' . $this->nmgp_refresh_row]['type']    = 'label';
                  $this->NM_ajax_info['fldList']['contato_hora_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->contato_hora_)));
                  $this->NM_ajax_info['fldList']['contato_hora_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_contato_hora_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['contato_hora_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['contato_hora_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['contato_hora_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['contato_hora_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $this->contato_obs_    = str_replace(array('\r\n', '\n\r', '\n', '\r'), array("\r\n", "\n\r", "\n", "\r"), $this->contato_obs_);
                  $tmpLabel_contato_obs_ = nl2br($this->contato_obs_);
                  $this->NM_ajax_info['fldList']['contato_obs_' . $this->nmgp_refresh_row]['type']    = 'text';
                  $this->NM_ajax_info['fldList']['contato_obs_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->contato_obs_)));
                  $this->NM_ajax_info['fldList']['contato_obs_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_contato_obs_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['contato_obs_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['contato_obs_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['contato_obs_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['contato_obs_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $orig_contato_usuario_id_ = $this->contato_usuario_id_;
                  $contato_usuario_id_      = $this->contato_usuario_id_;
              nm_limpa_numero($contato_usuario_id_, $this->field_config['contato_usuario_id_']['symbol_grp']); 
                  $this->contato_usuario_id_ = $contato_usuario_id_;
                  $this->lookup_usuario_id_($conteudo);
                  $this->contato_usuario_id_ = $orig_contato_usuario_id_;
                  $this->NM_ajax_info['fldList']['usuario_id_' . $this->nmgp_refresh_row]['lookupCons'] = form_contatos_rsvp_1_pack_protect_string($conteudo);
                  $tmpLabel_usuario_id_ = $this->usuario_id_;
                  $this->NM_ajax_info['fldList']['usuario_id_' . $this->nmgp_refresh_row]['type']    = 'label';
                  $this->NM_ajax_info['fldList']['usuario_id_' . $this->nmgp_refresh_row]['valList'] = array($this->usuario_id_);
                  $this->NM_ajax_info['fldList']['usuario_id_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_usuario_id_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['usuario_id_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['usuario_id_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['usuario_id_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['usuario_id_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $aLookup = array();
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('Y') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("Ativo")));
$aLookup[] = array(form_contatos_rsvp_1_pack_protect_string('N') => str_replace('<', '&lt;',form_contatos_rsvp_1_pack_protect_string("Inativo")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_ativo_'][] = 'Y';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['Lookup_contato_ativo_'][] = 'N';
          $sLabelTemp = '';
          foreach ($aLookup as $aValData)
          {
              if (key($aValData) == form_contatos_rsvp_1_pack_protect_string(NM_charset_to_utf8($this->contato_ativo_)))
              {
                  $sLabelTemp = current($aValData);
              }
          }
          $tmpLabel_contato_ativo_ = $sLabelTemp;
                  $this->NM_ajax_info['fldList']['contato_ativo_' . $this->nmgp_refresh_row]['type']    = 'select';
                  $this->NM_ajax_info['fldList']['contato_ativo_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->contato_ativo_)));
                  $this->NM_ajax_info['fldList']['contato_ativo_' . $this->nmgp_refresh_row]['labList'] = array($tmpLabel_contato_ativo_);

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['contato_ativo_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['contato_ativo_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['contato_ativo_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['contato_ativo_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $tmpLabel_ativo_ = $this->ativo_;
                  $this->NM_ajax_info['fldList']['ativo_' . $this->nmgp_refresh_row]['type']    = 'label';
                  $this->NM_ajax_info['fldList']['ativo_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->ativo_)));
                  $this->NM_ajax_info['fldList']['ativo_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_ativo_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['ativo_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['ativo_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['ativo_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['ativo_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $tmpLabel_id_contato_ = $this->id_contato_;
                  $this->NM_ajax_info['fldList']['id_contato_' . $this->nmgp_refresh_row]['type']    = 'label';
                  $this->NM_ajax_info['fldList']['id_contato_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->id_contato_)));
                  $this->NM_ajax_info['fldList']['id_contato_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_id_contato_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['id_contato_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['id_contato_' . $this->nmgp_refresh_row] = "on";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['id_contato_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['id_contato_' . $this->nmgp_refresh_row] = "on";
                      }
                  }


                  $this->nm_tira_formatacao();
                  $this->nm_converte_datas();

                  $this->NM_ajax_info['closeLine'] = $this->nmgp_refresh_row;
              }
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao = "novo"; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['run_iframe'] == "R")
              { 
                   $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['return_edit'] = "new";
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
          $this->id_contato_ = substr($this->Db->qstr($this->id_contato_), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';

          if ($bDelecaoOk)
          {

          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_ "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_ "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_ "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_ "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_ "); 
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
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_ "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_ "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_ "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_ "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_ "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_ "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_ "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_ "); 
              }  
              else  
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_ "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where id_contato = $this->id_contato_ "); 
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
                          form_contatos_rsvp_1_pack_ajax_response();
                          exit; 
                      }
                  } 
              } 
              $this->sc_evento = "delete"; 
              $this->nm_proc_onload_record($sc_seq_vert);
              $this->nmgp_opcao = "avanca"; 
              $this->nm_flag_iframe = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start']--; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] = 0; 
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['db_changed'] = true;

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_qtd']--; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['total']--; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_I_E']--; 
              $this->NM_ajax_info['navSummary']['reg_ini'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] + 1; 
              $this->NM_ajax_info['navSummary']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_qtd']; 
              $this->NM_ajax_info['navSummary']['reg_tot'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['total'] + 1; 
              $this->NM_gera_nav_page(); 
              $this->NM_ajax_info['navPage'] = $this->SC_nav_page; 
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
    if ("delete" == $this->sc_evento && $this->nmgp_opcao != "nada") {
      $_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'on';
  date_default_timezone_set('America/Sao_Paulo');
$status = 'A';
$cpf = $this->contato_cpf_participante_ ;
$evento = $this->contato_id_evento_ ;



$sql2="
	SELECT    
	COUNT(id_contato) as qtde
	FROM
		contatos_rsvp	
	WHERE 
		contato_id_evento = ".$this->Db->qstr($this->contato_id_evento_ )." AND  contato_cpf_participante = ".$this->Db->qstr($this->contato_cpf_participante_ )." 					
		
";	
 
      $nm_select = $sql2; 
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
	$qtde = $this->rs[0][0];
} else {
	$qtde = 0;
}
if ($qtde == 0) {
	$sql3="	
	UPDATE 
		participantes_rsvp
	SET 
		part_contato_rsvp = ".$this->Db->qstr($status)."
	WHERE 
		part_cpf = ".$this->Db->qstr($cpf)." AND part_id_evento = ".$this->Db->qstr($evento)."
	";
} else {
	$sql3="
	UPDATE 
		participantes_rsvp
	SET 
		part_contato_rsvp = ".$this->Db->qstr($status)."
	wHERE 
		part_cpf = ".$this->Db->qstr($cpf)." AND part_id_evento = ".$this->Db->qstr($evento)."
";
}	

     $nm_select = $sql3; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_contatos_rsvp_1_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
$_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'off'; 
    }
      if (!empty($this->Campos_Mens_erro)) 
      {
          return;
      }
      if ($salva_opcao == "incluir" && $GLOBALS["erro_incl"] != 1) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['parms'] = "id_contato_?#?$this->id_contato_?@?"; 
      }
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->id_contato_ = null === $this->id_contato_ ? null : substr($this->Db->qstr($this->id_contato_), 1, -1); 
      } 
   }
//---------- 
   function nm_select_banco() 
   { 
      global $nm_form_submit, $sc_seq_vert, $sc_check_incl, $teste_validade, $sc_where;
 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['rows']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['rows']))
      {
          $this->sc_max_reg = $_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['rows'];
      } 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['rows_ins']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['rows_ins']))
      {
          $this->sc_max_reg_incl = $_SESSION['scriptcase']['sc_apl_conf']['form_contatos_rsvp_1']['rows_ins'];
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_qtd_reg']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_qtd_reg'])
      {
          $this->sc_max_reg = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_qtd_reg'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_max_reg']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_max_reg'] > 0 || strtolower($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_max_reg']) == "all"))
      {
          $this->sc_max_reg = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_max_reg'];
      } 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $GLOBALS["NM_ERRO_IBASE"] = 0;  
      $this->form_vert_form_contatos_rsvp_1 = array();
      if ($this->nmgp_opcao != "novo") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['parms'] = ""; 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
      { 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if ($this->sc_teve_excl)
      {
          $this->nmgp_opcao = "avanca";
          if ($this->sc_max_reg != 'all') {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] -= $this->sc_max_reg;
          } 
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] = 0;
      }
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_filter'] && $sc_where_filter != $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_filter'] . ")";
          }
      }
      $sc_where = trim("(contato_cpf_participante = '" . $_SESSION['vg_cpf'] . "' and contato_id_evento = '" . $_SESSION['vg_evento_id'] . "')");
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
          if (null != $this->id_contato_)
          {
              $aNewWhereCond[] = "id_contato = " . $this->id_contato_;
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
          if ($this->app_is_initializing || $this->sc_teve_excl || $this->sc_teve_incl || (isset($_POST['master_nav']) && 'on' == $_POST['master_nav']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['total']))
          {
              $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where;
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
              $rt = $this->Db->Execute($nmgp_select);
              if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
              {
                  $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
                  exit;
              }
              $qt_geral_reg_form_contatos_rsvp_1 = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['total'] = $qt_geral_reg_form_contatos_rsvp_1;
              $rt->Close();
          }
      if ((isset($_POST['master_nav']) && 'on' == $_POST['master_nav']) || $this->nmgp_opcao == "igual" || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['total']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_I_E'] = 0; 
          if (!$this->sc_teve_excl && !$this->sc_teve_incl) 
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] = 0; 
          } 
          if ($this->nmgp_opcao == "igual" && isset($this->NM_btn_navega) && 'S' == $this->NM_btn_navega && !empty($this->id_contato_))
          {
              $Reg_OK      = false;
              $Count_start = -1;
              $sc_order_by = "";
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $Sel_Chave = "id_contato"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $Sel_Chave = "id_contato"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $Sel_Chave = "id_contato"; 
              }
              else  
              {
                  $Sel_Chave = "id_contato"; 
              }
              $nmgp_select = "SELECT " . $Sel_Chave . " from " . $this->Ini->nm_tabela . $sc_where; 
              $sc_order_by = "contato_data_hora DESC";
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
                  if ($rt->fields[0] == $this->id_contato_)
                  { 
                      $Reg_OK = true;
                  }  
                  $Count_start++;
                  $rt->MoveNext();
              }  
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] = $Count_start;
              $rt->Close(); 
          }
      } 
      else 
      { 
          $qt_geral_reg_form_contatos_rsvp_1 = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['total'];
      } 
      if ($this->nmgp_opcao == "inicio" || $this->nmgp_opcao == "ordem") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] = 0; 
      } 
      if ($this->nmgp_opcao == "navpage" && ($this->nmgp_ordem - 1) <= $qt_geral_reg_form_contatos_rsvp_1) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] = $this->nmgp_ordem - 1; 
      } 
      if ($this->nmgp_opcao == "avanca")  
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] += ($this->sc_max_reg + $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_I_E']); 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] > $qt_geral_reg_form_contatos_rsvp_1)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] = $qt_geral_reg_form_contatos_rsvp_1 - $this->sc_max_reg; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] = 0; 
              }
          }
      } 
      if ($this->nmgp_opcao == "retorna") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] -= $this->sc_max_reg; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] < 0)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] = 0; 
          }
      } 
      if ($this->nmgp_opcao == "final") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] = ($qt_geral_reg_form_contatos_rsvp_1 + 1) - $this->sc_max_reg; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] < 0)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] = 0; 
          }
      } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_I_E'] = 0; 
      }
      $Cmps_ord_def = array();
      $Cmps_ord_def[] = "contato_status";
      $Cmps_ord_def[] = "contato_motivo_frase";
      $Cmps_ord_def[] = "contato_data";
      $Cmps_ord_def[] = "contato_hora";
      $Cmps_ord_def[] = "contato_obs";
      $Cmps_ord_def[] = "contato_ativo";
      $Cmps_ord_def[] = "id_contato";
      $sc_order_by  = "";
      $sc_order_by = "contato_data_hora DESC";
      $sc_order_by = str_replace("order by ", "", $sc_order_by);
      $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
      if (!empty($sc_order_by))
      {
          $sc_order_by = " order by $sc_order_by "; 
      }
      if ($this->nmgp_opcao == "ordem" && in_array($this->nmgp_ordem, $Cmps_ord_def)) 
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['ordem_cmp'] != $this->nmgp_ordem)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['ordem_cmp'] = $this->nmgp_ordem; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['ordem_ord'] = ' asc'; 
              switch ($this->nmgp_ordem) {
                  case "contato_data":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['ordem_ord'] = ' desc';
                      break;
                  case "contato_hora":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['ordem_ord'] = ' desc';
                      break;
                  case "id_contato":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['ordem_ord'] = ' desc';
                      break;
                  case "contato_id_evento":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['ordem_ord'] = ' desc';
                      break;
                  case "contato_usuario_id":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['ordem_ord'] = ' desc';
                      break;
                  case "contato_data_hora":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['ordem_ord'] = ' desc';
                      break;
                  default:
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['ordem_ord'] = ' asc';
                      break;
              }
          }
          elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['ordem_ord'] == ' asc')
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['ordem_ord'] = ' desc'; 
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['ordem_ord'] = ' asc'; 
          }
      } 
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['ordem_cmp'])) 
      { 
          $sc_order_by = " order by " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['ordem_cmp'] . $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['ordem_ord']; 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT id_contato, contato_id_evento, contato_usuario_id, contato_cpf_atendente_usuario, contato_cpf_participante, contato_status, contato_motivo_frase, contato_data_hora, str_replace (convert(char(10),contato_data,102), '.', '-') + ' ' + convert(char(8),contato_data,20), str_replace (convert(char(10),contato_hora,102), '.', '-') + ' ' + convert(char(8),contato_hora,20), contato_obs, contato_tipo_part, contato_ativo from " . $this->Ini->nm_tabela . $sc_where . $sc_order_by; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nmgp_select = "SELECT id_contato, contato_id_evento, contato_usuario_id, contato_cpf_atendente_usuario, contato_cpf_participante, contato_status, contato_motivo_frase, contato_data_hora, convert(char(23),contato_data,121), convert(char(23),contato_hora,121), contato_obs, contato_tipo_part, contato_ativo from " . $this->Ini->nm_tabela . $sc_where . $sc_order_by; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT id_contato, contato_id_evento, contato_usuario_id, contato_cpf_atendente_usuario, contato_cpf_participante, contato_status, contato_motivo_frase, TO_DATE(TO_CHAR(contato_data_hora, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), contato_data, contato_hora, contato_obs, contato_tipo_part, contato_ativo from " . $this->Ini->nm_tabela . $sc_where . $sc_order_by; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT id_contato, contato_id_evento, contato_usuario_id, contato_cpf_atendente_usuario, contato_cpf_participante, contato_status, contato_motivo_frase, contato_data_hora, EXTEND(contato_data, YEAR TO DAY), contato_hora, contato_obs, contato_tipo_part, contato_ativo from " . $this->Ini->nm_tabela . $sc_where . $sc_order_by; 
      } 
      else 
      { 
          $nmgp_select = "SELECT id_contato, contato_id_evento, contato_usuario_id, contato_cpf_atendente_usuario, contato_cpf_participante, contato_status, contato_motivo_frase, contato_data_hora, contato_data, contato_hora, contato_obs, contato_tipo_part, contato_ativo from " . $this->Ini->nm_tabela . $sc_where . $sc_order_by; 
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['run_iframe'] == "R")
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
          } 
          else 
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, $this->sc_max_reg, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] . ")" ; 
                  $rs = $this->Db->SelectLimit($nmgp_select, $this->sc_max_reg, $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start']) ; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, $this->sc_max_reg, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] . ")" ; 
                  $rs = $this->Db->SelectLimit($nmgp_select, $this->sc_max_reg, $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start']) ; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, $this->sc_max_reg, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] . ")" ; 
                  $rs = $this->Db->SelectLimit($nmgp_select, $this->sc_max_reg, $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start']) ; 
              } 
              else  
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
                  $rs = $this->Db->Execute($nmgp_select) ; 
                  if (!$rs === false && !$rs->EOF) 
                  { 
                      $rs->Move($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start']) ;  
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
          if ($rs->EOF && !$this->proc_fast_search && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['empty_filter']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['empty_filter'])) 
          { 
              $this->nm_flag_saida_novo = "S"; 
              $this->nmgp_opcao = "novo"; 
              $this->sc_evento  = "novo"; 
              $this->nmgp_botoes['LOG'] = "off";
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
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_filter']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['empty_filter'] = true;
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
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['run_iframe'] == "R")
              { 
                  $this->sc_max_reg++;
              } 
              }
              $this->id_contato_ = $rs->fields[0] ; 
              $this->nmgp_dados_select['id_contato_'] = $this->id_contato_;
              $this->contato_id_evento_ = $rs->fields[1] ; 
              $this->nmgp_dados_select['contato_id_evento_'] = $this->contato_id_evento_;
              $this->contato_usuario_id_ = $rs->fields[2] ; 
              $this->nmgp_dados_select['contato_usuario_id_'] = $this->contato_usuario_id_;
              $this->contato_cpf_atendente_usuario_ = $rs->fields[3] ; 
              $this->nmgp_dados_select['contato_cpf_atendente_usuario_'] = $this->contato_cpf_atendente_usuario_;
              $this->contato_cpf_participante_ = $rs->fields[4] ; 
              $this->nmgp_dados_select['contato_cpf_participante_'] = $this->contato_cpf_participante_;
              $this->contato_status_ = $rs->fields[5] ; 
              $this->nmgp_dados_select['contato_status_'] = $this->contato_status_;
              $this->contato_motivo_frase_ = $rs->fields[6] ; 
              $this->nmgp_dados_select['contato_motivo_frase_'] = $this->contato_motivo_frase_;
              $this->contato_data_hora_ = $rs->fields[7] ; 
              if (substr($this->contato_data_hora_, 10, 1) == "-") 
              { 
                 $this->contato_data_hora_ = substr($this->contato_data_hora_, 0, 10) . " " . substr($this->contato_data_hora_, 11);
              } 
              if (substr($this->contato_data_hora_, 13, 1) == ".") 
              { 
                 $this->contato_data_hora_ = substr($this->contato_data_hora_, 0, 13) . ":" . substr($this->contato_data_hora_, 14, 2) . ":" . substr($this->contato_data_hora_, 17);
              } 
              $this->nmgp_dados_select['contato_data_hora_'] = $this->contato_data_hora_;
              $this->contato_data_ = $rs->fields[8] ; 
              $this->nmgp_dados_select['contato_data_'] = $this->contato_data_;
              $this->contato_hora_ = $rs->fields[9] ; 
              $this->nmgp_dados_select['contato_hora_'] = $this->contato_hora_;
              $this->contato_obs_ = $rs->fields[10] ; 
              $this->nmgp_dados_select['contato_obs_'] = $this->contato_obs_;
              $this->contato_tipo_part_ = $rs->fields[11] ; 
              $this->nmgp_dados_select['contato_tipo_part_'] = $this->contato_tipo_part_;
              $this->contato_ativo_ = $rs->fields[12] ; 
              $this->nmgp_dados_select['contato_ativo_'] = $this->contato_ativo_;
              $this->cabecalho_ = isset($GLOBALS['cabecalho_' . $sc_seq_vert]) ? $GLOBALS['cabecalho_' . $sc_seq_vert] : '';
              $this->rodape_ = isset($GLOBALS['rodape_' . $sc_seq_vert]) ? $GLOBALS['rodape_' . $sc_seq_vert] : '';
              $this->status_icon_ = isset($GLOBALS['status_icon_' . $sc_seq_vert]) ? $GLOBALS['status_icon_' . $sc_seq_vert] : '';
              $this->usuario_atual_ = isset($GLOBALS['usuario_atual_' . $sc_seq_vert]) ? $GLOBALS['usuario_atual_' . $sc_seq_vert] : '';
              $this->usuario_id_ = isset($GLOBALS['usuario_id_' . $sc_seq_vert]) ? $GLOBALS['usuario_id_' . $sc_seq_vert] : '';
              $this->usuario_nivel_ = isset($GLOBALS['usuario_nivel_' . $sc_seq_vert]) ? $GLOBALS['usuario_nivel_' . $sc_seq_vert] : '';
              $this->ativo_ = isset($GLOBALS['ativo_' . $sc_seq_vert]) ? $GLOBALS['ativo_' . $sc_seq_vert] : '';
              $this->cpf_del_ = isset($GLOBALS['cpf_del_' . $sc_seq_vert]) ? $GLOBALS['cpf_del_' . $sc_seq_vert] : '';
              $this->sql_log_ = isset($GLOBALS['sql_log_' . $sc_seq_vert]) ? $GLOBALS['sql_log_' . $sc_seq_vert] : '';
              $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->id_contato_ = (string)$this->id_contato_; 
              $this->contato_id_evento_ = (string)$this->contato_id_evento_; 
              $this->contato_usuario_id_ = (string)$this->contato_usuario_id_; 
              if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['parms'])) 
              { 
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['parms'] = "id_contato_?#?$this->id_contato_?@?";
              } 
              $this->nm_proc_onload_record($sc_seq_vert);
              $this->storeRecordState($sc_seq_vert);
//
//-- 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dados_select'][$sc_seq_vert] = $this->nmgp_dados_select;
              $this->nm_guardar_campos();
              $this->nm_formatar_campos();
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['status_icon_'] =  $this->status_icon_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_status_'] =  $this->contato_status_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_motivo_frase_'] =  $this->contato_motivo_frase_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_data_'] =  $this->contato_data_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_hora_'] =  $this->contato_hora_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_obs_'] =  $this->contato_obs_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['usuario_id_'] =  $this->usuario_id_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_ativo_'] =  $this->contato_ativo_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['ativo_'] =  $this->ativo_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['id_contato_'] =  $this->id_contato_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_id_evento_'] =  $this->contato_id_evento_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_usuario_id_'] =  $this->contato_usuario_id_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_cpf_atendente_usuario_'] =  $this->contato_cpf_atendente_usuario_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_cpf_participante_'] =  $this->contato_cpf_participante_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_data_hora_'] =  $this->contato_data_hora_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_data_hora__hora'] =  $this->contato_data_hora__hora; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_tipo_part_'] =  $this->contato_tipo_part_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['cabecalho_'] =  $this->cabecalho_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['rodape_'] =  $this->rodape_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['usuario_atual_'] =  $this->usuario_atual_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['usuario_nivel_'] =  $this->usuario_nivel_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['cpf_del_'] =  $this->cpf_del_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['sql_log_'] =  $this->sql_log_; 
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
          ksort ($this->form_vert_form_contatos_rsvp_1); 
          $rs->Close(); 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_qtd'] = $sc_seq_vert + $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] - 1;
          if ('total' == $this->form_paginacao)
          {
              $this->NM_ajax_info['navSummary']['reg_ini'] = 1; 
              $this->NM_ajax_info['navSummary']['reg_qtd'] = $this->sc_max_reg; 
              $this->NM_ajax_info['navSummary']['reg_tot'] = $this->sc_max_reg; 
          }
          else
          {
              $this->NM_ajax_info['navSummary']['reg_ini'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] + 1; 
              $this->NM_ajax_info['navSummary']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_qtd']; 
              $this->NM_ajax_info['navSummary']['reg_tot'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['total'] + 1; 
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
              $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'];
              $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] < (($qt_geral_reg_form_contatos_rsvp_1 + 1) - $this->sc_max_reg);
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['opcao'] = '';
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
          elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_multi']) 
          { 
          } 
          else 
          { 
              $this->sc_max_reg_incl = 0; 
          } 
          while ($sc_seq_vert <= $this->sc_max_reg_incl) 
          { 
              $this->id_contato_ = "";  
              $this->contato_status_ = "";  
              $this->contato_motivo_frase_ = "";  
              $this->contato_data_ =  date('Y') . "-" . date('m')  . "-" . date('d');
              $this->contato_hora_ =  date('H') . ":" . date('i')  . ":" . date('s');
              $this->contato_obs_ = "";  
              $this->contato_ativo_ = htmlentities("Y");  
              $this->status_icon_ = "";  
              $this->usuario_id_ = "";  
              $this->ativo_ = "";  
              $this->nm_proc_onload_record($sc_seq_vert);
              if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['foreign_key']))
              {
                  foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['foreign_key'] as $sFKName => $sFKValue)
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
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['status_icon_'] =  $this->status_icon_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_status_'] =  $this->contato_status_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_motivo_frase_'] =  $this->contato_motivo_frase_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_data_'] =  $this->contato_data_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_hora_'] =  $this->contato_hora_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_obs_'] =  $this->contato_obs_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['usuario_id_'] =  $this->usuario_id_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_ativo_'] =  $this->contato_ativo_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['ativo_'] =  $this->ativo_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['id_contato_'] =  $this->id_contato_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_id_evento_'] =  $this->contato_id_evento_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_usuario_id_'] =  $this->contato_usuario_id_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_cpf_atendente_usuario_'] =  $this->contato_cpf_atendente_usuario_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_cpf_participante_'] =  $this->contato_cpf_participante_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_data_hora_'] =  $this->contato_data_hora_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_data_hora__hora'] =  $this->contato_data_hora__hora; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['contato_tipo_part_'] =  $this->contato_tipo_part_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['cabecalho_'] =  $this->cabecalho_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['rodape_'] =  $this->rodape_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['usuario_atual_'] =  $this->usuario_atual_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['usuario_nivel_'] =  $this->usuario_nivel_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['cpf_del_'] =  $this->cpf_del_; 
             $this->form_vert_form_contatos_rsvp_1[$sc_seq_vert]['sql_log_'] =  $this->sql_log_; 
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
       $rec_tot    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['total'] + 1;
       $rec_fim    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] + $this->sc_max_reg;
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['record_state'][$sc_seq_vert]['buttons']['update'];
                }
        }

//

function contato_ativo__onChange()
{
$_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'on';
  
$original_contato_ativo_ = $this->contato_ativo_;
$original_contato_status_ = $this->contato_status_;
$original_status_icon_ = $this->status_icon_;

if($this->contato_ativo_  == 'N') {
	$pathimg = '../_lib/img/';
	$this->contato_status_  = 'A';
	$img = 'grp__NM__img__NM__telefone_gray.png';
	$exibe = $pathimg.$img;
	$this->status_icon_  = "<img src= $exibe height='20' width='20'/>"; 	
}

$modificado_contato_ativo_ = $this->contato_ativo_;
$modificado_contato_status_ = $this->contato_status_;
$modificado_status_icon_ = $this->status_icon_;
$this->nm_formatar_campos('contato_ativo_', 'contato_status_', 'status_icon_');
$this->nmgp_refresh_fields = array();
if ($original_contato_ativo_ !== $modificado_contato_ativo_ || isset($this->nmgp_cmp_readonly['contato_ativo_']) || (isset($bFlagRead_contato_ativo_) && $bFlagRead_contato_ativo_))
{
    $this->nmgp_refresh_fields[] = 'contato_ativo_';
    $this->NM_ajax_changed['contato_ativo_'] = true;
    $this->NM_ajax_force_values = true;
}
if ($original_contato_status_ !== $modificado_contato_status_ || isset($this->nmgp_cmp_readonly['contato_status_']) || (isset($bFlagRead_contato_status_) && $bFlagRead_contato_status_))
{
    $this->nmgp_refresh_fields[] = 'contato_status_';
    $this->NM_ajax_changed['contato_status_'] = true;
    $this->NM_ajax_force_values = true;
}
if ($original_status_icon_ !== $modificado_status_icon_ || isset($this->nmgp_cmp_readonly['status_icon_']) || (isset($bFlagRead_status_icon_) && $bFlagRead_status_icon_))
{
    $this->nmgp_refresh_fields[] = 'status_icon_';
    $this->NM_ajax_changed['status_icon_'] = true;
    $this->NM_ajax_force_values = true;
}
if ($this->NM_ajax_force_values)
{
    $this->ajax_return_values();
}
$this->NM_ajax_info['event_field'] = 'contato';
form_contatos_rsvp_1_pack_ajax_response();
exit;


$_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'off';
}


function GetPresAtiva($pcampo_1,$pcampo_2,$pcampo_3,$ptabela,$pcpf,$pevt,$porder) {
$_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'on';
  
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
			$ret = $this->rs[0][2];
		}
		return $ret;
$_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'off';
}


function GetUsuarioNivel($idu,$tipo) {
$_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'off';
}


function GravaLog($v_hora_now,$v_ip_usuario,$v_id_usuario,$v_global_cpf,$v_modulo,$v_aplicacao,$v_acao,$v_campo_id,$v_vl_campo_id,$v_campo_cpf,$v_vl_campo_cpf,$v_campo_evt,$v_vl_campo_evt,$v_tabela,$v_obs,$v_sql) {
$_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'on';
  		
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
                form_contatos_rsvp_1_pack_ajax_response();
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
$_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'off';
}


function MakeColor($vp_evento,$vp_cpf,$tipo) {
$_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'on';
  
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
	
		$reg_inc = sizeof($this->rs);
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_contatos_rsvp_1_pack_ajax_response();
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_contatos_rsvp_1_pack_ajax_response();
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_contatos_rsvp_1_pack_ajax_response();
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_contatos_rsvp_1_pack_ajax_response();
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_contatos_rsvp_1_pack_ajax_response();
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_contatos_rsvp_1_pack_ajax_response();
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_contatos_rsvp_1_pack_ajax_response();
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_contatos_rsvp_1_pack_ajax_response();
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_contatos_rsvp_1_pack_ajax_response();
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_contatos_rsvp_1_pack_ajax_response();
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_contatos_rsvp_1_pack_ajax_response();
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_contatos_rsvp_1_pack_ajax_response();
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_contatos_rsvp_1_pack_ajax_response();
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_contatos_rsvp_1_pack_ajax_response();
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_contatos_rsvp_1_pack_ajax_response();
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_contatos_rsvp_1_pack_ajax_response();
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_contatos_rsvp_1_pack_ajax_response();
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
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_contatos_rsvp_1_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
				}
			}	
		}
$_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'off';
}


function PegaIP() {
$_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'on';
  
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
	
$_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['form_contatos_rsvp_1']['contr_erro'] = 'off';
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
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              form_contatos_rsvp_1_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['retorno_edit'] . "';";
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
        $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['table_refresh'] = true;
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
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array("contato_status_", "contato_motivo_frase_", "contato_data_", "contato_hora_", "contato_obs_", "contato_ativo_", "id_contato_"))) {
            $searchOk = true;
        }
        elseif ($field == $this->nmgp_fast_search && in_array($field, array("contato_status_", "contato_motivo_frase_", "contato_data_", "contato_hora_", "contato_obs_", "contato_ativo_", "id_contato_"))) {
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['table_refresh'])
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['csrf_token'];
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

   function Form_lookup_contato_status_()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Aberto?#?A?#?S?@?";
       $nmgp_def_dados .= "Sim?#?Y?#?N?@?";
       $nmgp_def_dados .= "Não?#?N?#?N?@?";
       $nmgp_def_dados .= "Pendente?#?P?#?N?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_contato_motivo_frase_()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "ATIVO REALIZADO?#?ATIVO REALIZADO?#?S?@?";
       $nmgp_def_dados .= "TELEFONE NÃO ATENDE?#?TELEFONE NÃO ATENDE?#?N?@?";
       $nmgp_def_dados .= "TELEFONE ERRADO?#?TELEFONE ERRADO?#?N?@?";
       $nmgp_def_dados .= "CONVIDADO ENTROU EM CONTATO?#?CONVIDADO ENTROU EM CONTATO?#?N?@?";
       $nmgp_def_dados .= "SECRETÁRIA ENTROU EM CONTATO?#?SECRETÁRIA ENTROU EM CONTATO?#?N?@?";
       $nmgp_def_dados .= "TELEFONE DESLIGADO?#?TELEFONE DESLIGADO?#?N?@?";
       $nmgp_def_dados .= "INSCRIÇÃO VIA LINK?#?INSCRIÇÃO VIA LINK?#?N?@?";
       $nmgp_def_dados .= "ENVIADO VIA API?#?ENVIADO VIA API?#?N?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_contato_ativo_()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Ativo?#?Y?#?S?@?";
       $nmgp_def_dados .= "Inativo?#?N?#?N?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function SC_fast_search($in_fields, $arg_search, $data_search)
   {
      $fields = (strpos($in_fields, "SC_all_Cmp") !== false) ? array("SC_all_Cmp") : explode(";", $in_fields);
      $this->NM_case_insensitive = true;
      if (empty($data_search)) 
      {
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dyn_search_and_or']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dyn_search_cache']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              form_contatos_rsvp_1_pack_ajax_response();
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
          if ($field == "SC_all_Cmp" || $field == "contato_status_") 
          {
              $data_lookup = $this->SC_lookup_contato_status_($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "contato_status", $arg_search, $data_lookup, "ENUM", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "contato_motivo_frase_") 
          {
              $data_lookup = $this->SC_lookup_contato_motivo_frase_($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "contato_motivo_frase", $arg_search, $data_lookup, "VARCHAR", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "contato_data_") 
          {
              $this->SC_monta_condicao($comando, "contato_data", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "contato_hora_") 
          {
              $this->SC_monta_condicao($comando, "contato_hora", $arg_search, $data_search, "TIME", false);
          }
          if ($field == "SC_all_Cmp" || $field == "contato_obs_") 
          {
              $this->SC_monta_condicao($comando, "contato_obs", $arg_search, $data_search, "TINYTEXT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "contato_ativo_") 
          {
              $data_lookup = $this->SC_lookup_contato_ativo_($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "contato_ativo", $arg_search, $data_lookup, "ENUM", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "id_contato_") 
          {
              $this->SC_monta_condicao($comando, "id_contato", $arg_search, str_replace(",", ".", $data_search), "INT", false);
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_filter_form'] . " and ((contato_cpf_participante = '" . $_SESSION['vg_cpf'] . "' and contato_id_evento = '" . $_SESSION['vg_evento_id'] . "')) and (" . $comando . ")";
      }
      else
      {
          $sc_where = " where (contato_cpf_participante = '" . $_SESSION['vg_cpf'] . "' and contato_id_evento = '" . $_SESSION['vg_evento_id'] . "') and (" . $comando . ")";
      }
      $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
      $rt = $this->Db->Execute($nmgp_select) ; 
      if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
      { 
          $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
          exit ; 
      }  
      $qt_geral_reg_form_contatos_rsvp_1 = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['total'] = $qt_geral_reg_form_contatos_rsvp_1;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_contatos_rsvp_1_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_contatos_rsvp_1_pack_ajax_response();
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
      $nm_numeric[] = "id_contato";$nm_numeric[] = "contato_id_evento";$nm_numeric[] = "contato_usuario_id";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['decimal_db'] == ".")
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
      $Nm_datas["contato_data_hora"] = "timestamp";$Nm_datas["contato_data"] = "date";$Nm_datas["contato_hora"] = "time";
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
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['SC_sep_date']))
              {
                  $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['SC_sep_date'];
                  $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['SC_sep_date1'];
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
   function SC_lookup_contato_status_($condicao, $campo)
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
   function SC_lookup_contato_motivo_frase_($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['ATIVO REALIZADO'] = "ATIVO REALIZADO";
       $data_look['TELEFONE NÃO ATENDE'] = "TELEFONE NÃO ATENDE";
       $data_look['TELEFONE ERRADO'] = "TELEFONE ERRADO";
       $data_look['CONVIDADO ENTROU EM CONTATO'] = "CONVIDADO ENTROU EM CONTATO";
       $data_look['SECRETÁRIA ENTROU EM CONTATO'] = "SECRETÁRIA ENTROU EM CONTATO";
       $data_look['TELEFONE DESLIGADO'] = "TELEFONE DESLIGADO";
       $data_look['INSCRIÇÃO VIA LINK'] = "INSCRIÇÃO VIA LINK";
       $data_look['ENVIADO VIA API'] = "ENVIADO VIA API";
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
   function SC_lookup_contato_ativo_($condicao, $campo)
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
       $nmgp_saida_form = "form_contatos_rsvp_1_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['nm_run_menu'] = 2;
       $nmgp_saida_form = "form_contatos_rsvp_1_fim.php";
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
       form_contatos_rsvp_1_pack_ajax_response();
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['masterValue']);
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
    function sc_ajax_javascript($sJsFunc, $aParam = array())
    {
        if ($this->NM_ajax_flag)
        {
            foreach ($aParam as $i => $v)
            {
                $aParam[$i] = NM_charset_to_utf8($v);
            }
            $this->NM_ajax_info['ajaxJavascript'][] = array(NM_charset_to_utf8($sJsFunc), $aParam);
        }
        else
        {
            foreach ($aParam as $i => $v)
            {
                $aParam[$i] = '"' . str_replace('"', '\"', $v) . '"';
            }
            $this->NM_non_ajax_info['ajaxJavascript'][] = array($sJsFunc, $aParam);
        }
    } // sc_ajax_javascript
    function getButtonIds($buttonName) {
        switch ($buttonName) {
            case "new":
                return array("sc_b_new_t.sc-unique-btn-1", "sc_b_new_t.sc-unique-btn-2");
                break;
            case "insert":
                return array("sc_b_ins_t.sc-unique-btn-3");
                break;
            case "bcancelar":
                return array("sc_b_sai_t.sc-unique-btn-4");
                break;
            case "update":
                return array("sc_b_upd_t.sc-unique-btn-5");
                break;
            case "log":
                return array("sc_LOG_top", "sc_LOG_top");
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['link_info']['compact_mode']) {
            return;
        }
?>
    <tr id="sc_form_head"><td class="sc-app-header">
<?php if (!empty($_SESSION['scriptcase']['proc_mobile'])) { ?>
<style>
    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}
</style>
<div class="scFormHeader" style="height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;">
    <div class="scFormHeaderFont" style="float: left; text-transform: uppercase;"><?php if ($this->nmgp_opcao == "novo") { echo "" . $this->Ini->Nm_lang['lang_othr_frmi_title'] . " contatos_rsvp"; } else { echo "" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " contatos_rsvp"; } ?></div>
    <div class="scFormHeaderFont" style="float: right;"><?php echo date($this->dateDefaultFormat()); ?></div>
</div>
<?php } else { ?>
<style>
    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}
</style>
<div class="scFormHeader" style="height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;">
    <div class="scFormHeaderFont" style="float: left; text-transform: uppercase;"><span id="head_mark_cabecalho__0"><?php echo $this->cabecalho_ ?></span></div>
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['link_info']['compact_mode']) {
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
            <span class="scFormFooterFont" id="rod_col1"><span id="head_mark_rodape__0"><?php echo $this->rodape_ ?></span></span>
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
        if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['run_iframe'] != "R") {
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
                'total' == $this->form_paginacao ? 1 : $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['reg_start'] + $this->summary_record_count,
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_contatos_rsvp_1']['ordem_ord'] == " desc") {
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
            case "id_contato":
                return true;
            case "contato_id_evento":
                return true;
            case "contato_usuario_id":
                return true;
            default:
                return false;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
            case "contato_data":
                return 'desc';
            case "contato_hora":
                return 'desc';
            case "id_contato":
                return 'desc';
            case "contato_id_evento":
                return 'desc';
            case "contato_usuario_id":
                return 'desc';
            case "contato_data_hora":
                return 'desc';
            default:
                return 'asc';
        }
        return 'asc';
    }

}
?>
