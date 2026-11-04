<?php
//
class form_aereos_rsvp_ctrecho_mob_apl
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
   var $id_aereo;
   var $aereo_id_evento;
   var $aereo_id_usuario;
   var $aereo_cpf_particip;
   var $aereo_tipo_pessoa;
   var $aereo_status;
   var $aereo_direcao;
   var $aereo_cia_aerea;
   var $aereo_num_voo;
   var $aereo_origem;
   var $aereo_destino;
   var $aereo_dt_saida;
   var $aereo_hr_saida;
   var $aereo_dthr_saida;
   var $aereo_dthr_saida_hora;
   var $aereo_dt_chegada;
   var $aereo_hr_chegada;
   var $aereo_dthr_chegada;
   var $aereo_dthr_chegada_hora;
   var $aereo_localizador;
   var $aereo_eticket;
   var $aereo_emitida_bvt;
   var $aereo_valor;
   var $aereo_bloqueio_id;
   var $aereo_modificado_em;
   var $aereo_modificado_em_hora;
   var $aereo_flag_subtraido;
   var $aereo_trecho;
   var $aereo_ativo;
   var $id_origem_gate;
   var $nome_pax_gate;
   var $nota_gate;
   var $data_nota_gate;
   var $fil_agt_gate;
   var $aereo_cia_aerea_gate;
   var $aereo_transfer_tipo;
   var $part_copy;
   var $part_copy_1;
   var $acomp_copy;
   var $acomp_copy_1;
   var $cpf_del;
   var $sql_log;
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
   var $NM_case_insensitive;
//
//----- 
   function ini_controle()
   {
        global $nm_url_saida, $teste_validade, $script_case_init, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;


      if ($this->NM_ajax_flag)
      {
          if (isset($this->NM_ajax_info['param']['acomp_copy']))
          {
              $this->acomp_copy = $this->NM_ajax_info['param']['acomp_copy'];
          }
          if (isset($this->NM_ajax_info['param']['aereo_id_evento']))
          {
              $this->aereo_id_evento = $this->NM_ajax_info['param']['aereo_id_evento'];
          }
          if (isset($this->NM_ajax_info['param']['cpf_del']))
          {
              $this->cpf_del = $this->NM_ajax_info['param']['cpf_del'];
          }
          if (isset($this->NM_ajax_info['param']['csrf_token']))
          {
              $this->csrf_token = $this->NM_ajax_info['param']['csrf_token'];
          }
          if (isset($this->NM_ajax_info['param']['id_aereo']))
          {
              $this->id_aereo = $this->NM_ajax_info['param']['id_aereo'];
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
          if (isset($this->NM_ajax_info['param']['nmgp_url_saida']))
          {
              $this->nmgp_url_saida = $this->NM_ajax_info['param']['nmgp_url_saida'];
          }
          if (isset($this->NM_ajax_info['param']['part_copy']))
          {
              $this->part_copy = $this->NM_ajax_info['param']['part_copy'];
          }
          if (isset($this->NM_ajax_info['param']['script_case_init']))
          {
              $this->script_case_init = $this->NM_ajax_info['param']['script_case_init'];
          }
          if (isset($this->NM_ajax_info['param']['sql_log']))
          {
              $this->sql_log = $this->NM_ajax_info['param']['sql_log'];
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
      if (isset($this->vg_evento_id) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['vg_evento_id'] = $this->vg_evento_id;
      }
      if (isset($this->vg_cpf) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['vg_cpf'] = $this->vg_cpf;
      }
      if (isset($this->vg_matriz_trunico) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['vg_matriz_trunico'] = $this->vg_matriz_trunico;
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
      if (isset($_POST["vg_evento_id"]) && isset($this->vg_evento_id)) 
      {
          $_SESSION['vg_evento_id'] = $this->vg_evento_id;
      }
      if (isset($_POST["vg_cpf"]) && isset($this->vg_cpf)) 
      {
          $_SESSION['vg_cpf'] = $this->vg_cpf;
      }
      if (isset($_POST["vg_matriz_trunico"]) && isset($this->vg_matriz_trunico)) 
      {
          $_SESSION['vg_matriz_trunico'] = $this->vg_matriz_trunico;
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
      if (isset($_GET["vg_evento_id"]) && isset($this->vg_evento_id)) 
      {
          $_SESSION['vg_evento_id'] = $this->vg_evento_id;
      }
      if (isset($_GET["vg_cpf"]) && isset($this->vg_cpf)) 
      {
          $_SESSION['vg_cpf'] = $this->vg_cpf;
      }
      if (isset($_GET["vg_matriz_trunico"]) && isset($this->vg_matriz_trunico)) 
      {
          $_SESSION['vg_matriz_trunico'] = $this->vg_matriz_trunico;
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
          $_SESSION['sc_session'][$script_case_init]['form_aereos_rsvp_ctrecho_mob']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_aereos_rsvp_ctrecho_mob']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_aereos_rsvp_ctrecho_mob']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_aereos_rsvp_ctrecho_mob']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['form_aereos_rsvp_ctrecho_mob']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['form_aereos_rsvp_ctrecho_mob']['embutida_parms']);
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
                 nm_limpa_str_form_aereos_rsvp_ctrecho_mob($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
             }
             $ix++;
          }
          if (isset($this->inside_nested_grid) && 'Y' == $this->inside_nested_grid) {
              $_SESSION['sc_session'][$script_case_init]['form_aereos_rsvp_ctrecho_mob']['inside_nested_iframe'] = true;
          }
          if (isset($this->vg_evento_id)) 
          {
              $_SESSION['vg_evento_id'] = $this->vg_evento_id;
          }
          if (isset($this->vg_cpf)) 
          {
              $_SESSION['vg_cpf'] = $this->vg_cpf;
          }
          if (isset($this->vg_matriz_trunico)) 
          {
              $_SESSION['vg_matriz_trunico'] = $this->vg_matriz_trunico;
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
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['form_aereos_rsvp_ctrecho_mob']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['form_aereos_rsvp_ctrecho_mob']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['form_aereos_rsvp_ctrecho_mob']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['form_aereos_rsvp_ctrecho_mob']['sc_redir_insert'] = $this->sc_redir_insert;
              unset($_SESSION['sc_session'][$script_case_init]['form_aereos_rsvp_ctrecho_mob']['opc_ant']);
          }
          if (isset($this->vg_evento_id)) 
          {
              $_SESSION['vg_evento_id'] = $this->vg_evento_id;
          }
          if (isset($this->vg_cpf)) 
          {
              $_SESSION['vg_cpf'] = $this->vg_cpf;
          }
          if (isset($this->vg_matriz_trunico)) 
          {
              $_SESSION['vg_matriz_trunico'] = $this->vg_matriz_trunico;
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
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['form_aereos_rsvp_ctrecho_mob']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['form_aereos_rsvp_ctrecho_mob']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['form_aereos_rsvp_ctrecho_mob']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['form_aereos_rsvp_ctrecho_mob']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['form_aereos_rsvp_ctrecho_mob']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['form_aereos_rsvp_ctrecho_mob']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_aereos_rsvp_ctrecho_mob']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['form_aereos_rsvp_ctrecho_mob']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['form_aereos_rsvp_ctrecho_mob']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['form_aereos_rsvp_ctrecho_mob']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new form_aereos_rsvp_ctrecho_mob_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("pt_br");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['initialize'];
          $this->Db = $this->Ini->Db; 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['initialize']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['initialize'])
          {
              $_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'on';
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
   $sErrorIndex = 'geral_form_aereos_rsvp_ctrecho_mob';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_aereos_rsvp_ctrecho_mob';
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
        $this->NM_ajax_info['redirExit']['action'] = "form_aereos_rsvp_ctrecho_mob_fim.php?script_case_init=" . $this->form_encode_input($this->Ini->sc_page);
        $this->NM_ajax_info['redirExit']['metodo'] = 'location';
        $this->NM_ajax_info['redirExit']['target'] = "_self";
        $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $this->Ini->path_link . "" . SC_dir_app_name('WWW-Authenticate: <type> realm=<realm>') . "/";
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['sc_outra_jan'])
        {
            $_SESSION['scriptcase']['sc_outra_jan'] = "form_aereos_rsvp_ctrecho_mob";
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['sc_outra_jan'] = false;
        }
        $_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'off';
        form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "form_aereos_rsvp_ctrecho_mob";
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['sc_outra_jan'] = false;
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
        action="form_aereos_rsvp_ctrecho_mob_fim.php"
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
$_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'off';
          if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho']))
          {
              foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho'] as $I_conf => $Conf_opt)
              {
                  $_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob'][$I_conf]  = $Conf_opt;
              }
          }
          }
          $this->Ini->init2();
      } 
      else 
      { 
         $this->nm_data = new nm_data("pt_br");
      } 
      $_SESSION['sc_session'][$script_case_init]['form_aereos_rsvp_ctrecho_mob']['upload_field_info'] = array();

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_aereos_rsvp_ctrecho_mob']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_aereos_rsvp_ctrecho_mob'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_aereos_rsvp_ctrecho_mob']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_aereos_rsvp_ctrecho_mob']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('form_aereos_rsvp_ctrecho_mob') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_aereos_rsvp_ctrecho_mob']['label'] = "Copiar Trechos Aéreos";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "form_aereos_rsvp_ctrecho_mob")
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
      $this->nm_new_label['aereo_cpf_particip'] = 'Aereo Cpf Particip';
      $this->nm_new_label['aereo_id_evento'] = 'Aereo Id Evento';
      $this->nm_new_label['id_aereo'] = 'Id Aereo';

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


      $this->arr_buttons['confirmar']['hint']             = "Grava os TRechos Aéreos";
      $this->arr_buttons['confirmar']['type']             = "button";
      $this->arr_buttons['confirmar']['value']            = "Confirmar";
      $this->arr_buttons['confirmar']['display']          = "text_fontawesomeicon";
      $this->arr_buttons['confirmar']['display_position'] = "text_right";
      $this->arr_buttons['confirmar']['style']            = "default";
      $this->arr_buttons['confirmar']['image']            = "";
      $this->arr_buttons['confirmar']['has_fa']            = "true";
      $this->arr_buttons['confirmar']['fontawesomeicon']            = "";

      $this->arr_buttons['voltar']['hint']             = "";
      $this->arr_buttons['voltar']['type']             = "button";
      $this->arr_buttons['voltar']['value']            = "Voltar";
      $this->arr_buttons['voltar']['display']          = "text_fontawesomeicon";
      $this->arr_buttons['voltar']['display_position'] = "text_right";
      $this->arr_buttons['voltar']['style']            = "default";
      $this->arr_buttons['voltar']['image']            = "";
      $this->arr_buttons['voltar']['has_fa']            = "true";
      $this->arr_buttons['voltar']['fontawesomeicon']            = "";


      $_SESSION['scriptcase']['error_icon']['form_aereos_rsvp_ctrecho_mob']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['form_aereos_rsvp_ctrecho_mob'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['goto']      = 'on';
          }
      }

      $this->nmgp_botoes['cancel'] = "on";
      $this->nmgp_botoes['exit'] = "off";
      $this->nmgp_botoes['new']  = "off";
      $this->nmgp_botoes['copy'] = "off";
      $this->nmgp_botoes['insert'] = "off";
      $this->nmgp_botoes['update'] = "off";
      $this->nmgp_botoes['delete'] = "off";
      $this->nmgp_botoes['first'] = "off";
      $this->nmgp_botoes['back'] = "off";
      $this->nmgp_botoes['forward'] = "off";
      $this->nmgp_botoes['last'] = "off";
      $this->nmgp_botoes['summary'] = "off";
      $this->nmgp_botoes['navpage'] = "off";
      $this->nmgp_botoes['goto'] = "off";
      $this->nmgp_botoes['qtline'] = "off";
      $this->nmgp_botoes['reload'] = "off";
      $this->nmgp_botoes['Confirmar'] = "on";
      $this->nmgp_botoes['Voltar'] = "on";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_orig'] = "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_pesq'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_aereos_rsvp_ctrecho_mob']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_aereos_rsvp_ctrecho_mob'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_aereos_rsvp_ctrecho_mob'];

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

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dados_form'];
          if (!isset($this->aereo_id_usuario)){$this->aereo_id_usuario = $this->nmgp_dados_form['aereo_id_usuario'];} 
          if (!isset($this->aereo_cpf_particip)){$this->aereo_cpf_particip = $this->nmgp_dados_form['aereo_cpf_particip'];} 
          if (!isset($this->aereo_tipo_pessoa)){$this->aereo_tipo_pessoa = $this->nmgp_dados_form['aereo_tipo_pessoa'];} 
          if (!isset($this->aereo_status)){$this->aereo_status = $this->nmgp_dados_form['aereo_status'];} 
          if (!isset($this->aereo_direcao)){$this->aereo_direcao = $this->nmgp_dados_form['aereo_direcao'];} 
          if (!isset($this->aereo_cia_aerea)){$this->aereo_cia_aerea = $this->nmgp_dados_form['aereo_cia_aerea'];} 
          if (!isset($this->aereo_num_voo)){$this->aereo_num_voo = $this->nmgp_dados_form['aereo_num_voo'];} 
          if (!isset($this->aereo_origem)){$this->aereo_origem = $this->nmgp_dados_form['aereo_origem'];} 
          if (!isset($this->aereo_destino)){$this->aereo_destino = $this->nmgp_dados_form['aereo_destino'];} 
          if (!isset($this->aereo_dt_saida)){$this->aereo_dt_saida = $this->nmgp_dados_form['aereo_dt_saida'];} 
          if (!isset($this->aereo_hr_saida)){$this->aereo_hr_saida = $this->nmgp_dados_form['aereo_hr_saida'];} 
          if (!isset($this->aereo_dthr_saida)){$this->aereo_dthr_saida = $this->nmgp_dados_form['aereo_dthr_saida'];} 
          if (!isset($this->aereo_dt_chegada)){$this->aereo_dt_chegada = $this->nmgp_dados_form['aereo_dt_chegada'];} 
          if (!isset($this->aereo_hr_chegada)){$this->aereo_hr_chegada = $this->nmgp_dados_form['aereo_hr_chegada'];} 
          if (!isset($this->aereo_dthr_chegada)){$this->aereo_dthr_chegada = $this->nmgp_dados_form['aereo_dthr_chegada'];} 
          if (!isset($this->aereo_localizador)){$this->aereo_localizador = $this->nmgp_dados_form['aereo_localizador'];} 
          if (!isset($this->aereo_eticket)){$this->aereo_eticket = $this->nmgp_dados_form['aereo_eticket'];} 
          if (!isset($this->aereo_emitida_bvt)){$this->aereo_emitida_bvt = $this->nmgp_dados_form['aereo_emitida_bvt'];} 
          if (!isset($this->aereo_valor)){$this->aereo_valor = $this->nmgp_dados_form['aereo_valor'];} 
          if (!isset($this->aereo_bloqueio_id)){$this->aereo_bloqueio_id = $this->nmgp_dados_form['aereo_bloqueio_id'];} 
          if (!isset($this->aereo_modificado_em)){$this->aereo_modificado_em = $this->nmgp_dados_form['aereo_modificado_em'];} 
          if (!isset($this->aereo_flag_subtraido)){$this->aereo_flag_subtraido = $this->nmgp_dados_form['aereo_flag_subtraido'];} 
          if (!isset($this->aereo_trecho)){$this->aereo_trecho = $this->nmgp_dados_form['aereo_trecho'];} 
          if (!isset($this->aereo_ativo)){$this->aereo_ativo = $this->nmgp_dados_form['aereo_ativo'];} 
          if (!isset($this->id_origem_gate)){$this->id_origem_gate = $this->nmgp_dados_form['id_origem_gate'];} 
          if (!isset($this->nome_pax_gate)){$this->nome_pax_gate = $this->nmgp_dados_form['nome_pax_gate'];} 
          if (!isset($this->nota_gate)){$this->nota_gate = $this->nmgp_dados_form['nota_gate'];} 
          if (!isset($this->data_nota_gate)){$this->data_nota_gate = $this->nmgp_dados_form['data_nota_gate'];} 
          if (!isset($this->fil_agt_gate)){$this->fil_agt_gate = $this->nmgp_dados_form['fil_agt_gate'];} 
          if (!isset($this->aereo_cia_aerea_gate)){$this->aereo_cia_aerea_gate = $this->nmgp_dados_form['aereo_cia_aerea_gate'];} 
          if (!isset($this->aereo_transfer_tipo)){$this->aereo_transfer_tipo = $this->nmgp_dados_form['aereo_transfer_tipo'];} 
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("form_aereos_rsvp_ctrecho_mob", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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

      if (is_file($this->Ini->path_aplicacao . 'form_aereos_rsvp_ctrecho_mob_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'form_aereos_rsvp_ctrecho_mob_help.txt');
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
          require_once($this->Ini->path_embutida . 'form_aereos_rsvp_ctrecho/form_aereos_rsvp_ctrecho_mob_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "form_aereos_rsvp_ctrecho_mob_erro.class.php"); 
      }
      $this->Erro      = new form_aereos_rsvp_ctrecho_mob_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if ((!isset($nm_opc_lookup) || $nm_opc_lookup != "lookup") && (!isset($nm_opc_php) || $nm_opc_php != "formphp"))
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['opcao']))
         { 
             if ($this->id_aereo != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho_mob']['start']);
          unset($_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "novo")  
      {
          $this->nmgp_botoes['Confirmar'] = "off";
          $this->nmgp_botoes['Voltar'] = "off";
      }
      elseif ($this->nmgp_opcao == "incluir")  
      {
          $this->nmgp_botoes['Confirmar'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['botoes']['Confirmar'];
          $this->nmgp_botoes['Voltar'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['botoes']['Voltar'];
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dados_form'];
      }
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
      $_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'on';
if (!isset($this->sc_temp_vg_cpf)) {$this->sc_temp_vg_cpf = (isset($_SESSION['vg_cpf'])) ? $_SESSION['vg_cpf'] : "";}
if (!isset($this->sc_temp_vg_matriz_trunico)) {$this->sc_temp_vg_matriz_trunico = (isset($_SESSION['vg_matriz_trunico'])) ? $_SESSION['vg_matriz_trunico'] : "";}
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
   $sErrorIndex = 'geral_form_aereos_rsvp_ctrecho_mob';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_aereos_rsvp_ctrecho_mob';
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
 if (isset($this->sc_temp_vg_matriz_trunico)) { $_SESSION['vg_matriz_trunico'] = $this->sc_temp_vg_matriz_trunico;}
 if (isset($this->sc_temp_vg_cpf)) { $_SESSION['vg_cpf'] = $this->sc_temp_vg_cpf;}
    if ($this->NM_ajax_flag)
    {
        $this->NM_ajax_info['redirExit']['action'] = "form_aereos_rsvp_ctrecho_mob_fim.php?script_case_init=" . $this->form_encode_input($this->Ini->sc_page);
        $this->NM_ajax_info['redirExit']['metodo'] = 'location';
        $this->NM_ajax_info['redirExit']['target'] = "_self";
        $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $this->Ini->path_link . "" . SC_dir_app_name('WWW-Authenticate: <type> realm=<realm>') . "/";
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['sc_outra_jan'])
        {
            $_SESSION['scriptcase']['sc_outra_jan'] = "form_aereos_rsvp_ctrecho_mob";
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['sc_outra_jan'] = false;
        }
        $_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'off';
        form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "form_aereos_rsvp_ctrecho_mob";
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['sc_outra_jan'] = false;
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
        action="form_aereos_rsvp_ctrecho_mob_fim.php"
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

$m_trechos = $this->sc_temp_vg_matriz_trunico;
$evento = $this->sc_temp_vg_evento_id;
$cpf = $this->sc_temp_vg_cpf;
$usuario = $this->sc_temp_vg_usuario_id;
if (isset($this->sc_temp_vg_usuario_id)) { $_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_vg_menu_item)) { $_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
if (isset($this->sc_temp_parm1)) { $_SESSION['parm1'] = $this->sc_temp_parm1;}
if (isset($this->sc_temp_vg_evento_id)) { $_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_cpfseg)) { $_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
if (isset($this->sc_temp_rsvp_global)) { $_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
if (isset($this->sc_temp_vg_matriz_trunico)) { $_SESSION['vg_matriz_trunico'] = $this->sc_temp_vg_matriz_trunico;}
if (isset($this->sc_temp_vg_cpf)) { $_SESSION['vg_cpf'] = $this->sc_temp_vg_cpf;}
$_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'off'; 
      }
            if ('ajax_check_file' == $this->nmgp_opcao ){
                 ob_start(); 
                 global $bol_api_prod; 
                 $bol_api_prod = true; 
                 if (isset($_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['glo_nm_conexao'])) 
                 { 
                     $bol_api_prod = false;
                 } 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
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
      if (isset($this->id_aereo)) { $this->nm_limpa_alfa($this->id_aereo); }
      if (isset($this->aereo_id_evento)) { $this->nm_limpa_alfa($this->aereo_id_evento); }
      if ($nm_opc_form_php == "formphp")
      { 
          if ($nm_call_php == "Confirmar")
          { 
              $this->sc_btn_Confirmar();
          } 
          if ($nm_call_php == "Voltar")
          { 
              $this->sc_btn_Voltar();
          } 
          $this->NM_close_db(); 
          exit;
      } 
      $Campos_Crit       = "";
      $Campos_erro       = "";
      $Campos_Falta      = array();
      $Campos_Erros      = array();
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          =  substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
      //-- id_aereo
      $this->field_config['id_aereo']               = array();
      $this->field_config['id_aereo']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['id_aereo']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['id_aereo']['symbol_dec'] = '';
      $this->field_config['id_aereo']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['id_aereo']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- aereo_id_evento
      $this->field_config['aereo_id_evento']               = array();
      $this->field_config['aereo_id_evento']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['aereo_id_evento']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['aereo_id_evento']['symbol_dec'] = '';
      $this->field_config['aereo_id_evento']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['aereo_id_evento']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- aereo_id_usuario
      $this->field_config['aereo_id_usuario']               = array();
      $this->field_config['aereo_id_usuario']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['aereo_id_usuario']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['aereo_id_usuario']['symbol_dec'] = '';
      $this->field_config['aereo_id_usuario']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['aereo_id_usuario']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- aereo_cia_aerea
      $this->field_config['aereo_cia_aerea']               = array();
      $this->field_config['aereo_cia_aerea']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['aereo_cia_aerea']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['aereo_cia_aerea']['symbol_dec'] = '';
      $this->field_config['aereo_cia_aerea']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['aereo_cia_aerea']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- aereo_dt_saida
      $this->field_config['aereo_dt_saida']                 = array();
      $this->field_config['aereo_dt_saida']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['aereo_dt_saida']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['aereo_dt_saida']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'aereo_dt_saida');
      //-- aereo_hr_saida
      $this->field_config['aereo_hr_saida']                 = array();
      $this->field_config['aereo_hr_saida']['date_format']  = $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['aereo_hr_saida']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['aereo_hr_saida']['date_display'] = "hhiiss";
      $this->new_date_format('HH', 'aereo_hr_saida');
      //-- aereo_dthr_saida
      $this->field_config['aereo_dthr_saida']                 = array();
      $this->field_config['aereo_dthr_saida']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['aereo_dthr_saida']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['aereo_dthr_saida']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['aereo_dthr_saida']['date_display'] = "ddmmaaaa;hhiiss";
      $this->new_date_format('DH', 'aereo_dthr_saida');
      //-- aereo_dt_chegada
      $this->field_config['aereo_dt_chegada']                 = array();
      $this->field_config['aereo_dt_chegada']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['aereo_dt_chegada']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['aereo_dt_chegada']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'aereo_dt_chegada');
      //-- aereo_hr_chegada
      $this->field_config['aereo_hr_chegada']                 = array();
      $this->field_config['aereo_hr_chegada']['date_format']  = $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['aereo_hr_chegada']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['aereo_hr_chegada']['date_display'] = "hhiiss";
      $this->new_date_format('HH', 'aereo_hr_chegada');
      //-- aereo_dthr_chegada
      $this->field_config['aereo_dthr_chegada']                 = array();
      $this->field_config['aereo_dthr_chegada']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['aereo_dthr_chegada']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['aereo_dthr_chegada']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['aereo_dthr_chegada']['date_display'] = "ddmmaaaa;hhiiss";
      $this->new_date_format('DH', 'aereo_dthr_chegada');
      //-- aereo_valor
      $this->field_config['aereo_valor']               = array();
      $this->field_config['aereo_valor']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_val'];
      $this->field_config['aereo_valor']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'];
      $this->field_config['aereo_valor']['symbol_dec'] = $_SESSION['scriptcase']['reg_conf']['dec_val'];
      $this->field_config['aereo_valor']['symbol_mon'] = '';
      $this->field_config['aereo_valor']['format_pos'] = $_SESSION['scriptcase']['reg_conf']['monet_f_pos'];
      $this->field_config['aereo_valor']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['monet_f_neg'];
      //-- aereo_bloqueio_id
      $this->field_config['aereo_bloqueio_id']               = array();
      $this->field_config['aereo_bloqueio_id']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['aereo_bloqueio_id']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['aereo_bloqueio_id']['symbol_dec'] = '';
      $this->field_config['aereo_bloqueio_id']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['aereo_bloqueio_id']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- aereo_modificado_em
      $this->field_config['aereo_modificado_em']                 = array();
      $this->field_config['aereo_modificado_em']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['aereo_modificado_em']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['aereo_modificado_em']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['aereo_modificado_em']['date_display'] = "ddmmaaaa;hhiiss";
      $this->new_date_format('DH', 'aereo_modificado_em');
      //-- aereo_flag_subtraido
      $this->field_config['aereo_flag_subtraido']               = array();
      $this->field_config['aereo_flag_subtraido']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['aereo_flag_subtraido']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['aereo_flag_subtraido']['symbol_dec'] = '';
      $this->field_config['aereo_flag_subtraido']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['aereo_flag_subtraido']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- aereo_trecho
      $this->field_config['aereo_trecho']               = array();
      $this->field_config['aereo_trecho']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['aereo_trecho']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['aereo_trecho']['symbol_dec'] = '';
      $this->field_config['aereo_trecho']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['aereo_trecho']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- id_origem_gate
      $this->field_config['id_origem_gate']               = array();
      $this->field_config['id_origem_gate']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['id_origem_gate']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['id_origem_gate']['symbol_dec'] = '';
      $this->field_config['id_origem_gate']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['id_origem_gate']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- data_nota_gate
      $this->field_config['data_nota_gate']                 = array();
      $this->field_config['data_nota_gate']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['data_nota_gate']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['data_nota_gate']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'data_nota_gate');
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
          if ('validate_id_aereo' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'id_aereo');
          }
          if ('validate_aereo_id_evento' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'aereo_id_evento');
          }
          if ('validate_part_copy' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'part_copy');
          }
          if ('validate_acomp_copy' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'acomp_copy');
          }
          if ('validate_cpf_del' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'cpf_del');
          }
          if ('validate_sql_log' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'sql_log');
          }
          form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
          exit;
      }
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6))
      {
          $this->nm_tira_formatacao();
          if ('event_part_copy_onchange' == $this->NM_ajax_opcao)
          {
              $this->Part_copy_onChange();
          }
          if ('event_acomp_copy_onchange' == $this->NM_ajax_opcao)
          {
              $this->acomp_copy_onChange();
          }
          form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          if (!empty($this->part_copy))
          {
              $this->part_copy = explode("@?@", $this->part_copy);
          }
          if (is_array($this->part_copy))
          {
              $x = 0; 
              $this->part_copy_1 = $this->part_copy;
              $this->part_copy = ""; 
              if ($this->part_copy_1 != "") 
              { 
                  foreach ($this->part_copy_1 as $dados_part_copy_1 ) 
                  { 
                      if ($x != 0)
                      { 
                          $this->part_copy .= ";";
                      } 
                      $this->part_copy .= $dados_part_copy_1;
                      $x++ ; 
                  } 
              } 
          } 
          if (!empty($this->acomp_copy))
          {
              $this->acomp_copy = explode("@?@", $this->acomp_copy);
          }
          if (is_array($this->acomp_copy))
          {
              $x = 0; 
              $this->acomp_copy_1 = $this->acomp_copy;
              $this->acomp_copy = ""; 
              if ($this->acomp_copy_1 != "") 
              { 
                  foreach ($this->acomp_copy_1 as $dados_acomp_copy_1 ) 
                  { 
                      if ($x != 0)
                      { 
                          $this->acomp_copy .= ";";
                      } 
                      $this->acomp_copy .= $dados_acomp_copy_1;
                      $x++ ; 
                  } 
              } 
          } 
          $this->nm_tira_formatacao();
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          $this->nm_acessa_banco();
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
          $_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_evento == "insert" || ($this->nmgp_opc_ant == "novo" && $this->nmgp_opcao == "novo" && $this->sc_evento == "novo"))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['sc_redir_atualiz'] == "ok")
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
          $this->ajax_return_values();
          $this->ajax_add_parameters();
          form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
          form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "form_aereos_rsvp_ctrecho_mob.zip";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("Copiar Trechos Aéreos") ?></TITLE>
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
<form name="Fdown" method="get" action="form_aereos_rsvp_ctrecho_mob_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="form_aereos_rsvp_ctrecho_mob"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<form name="F0" method=post action="form_aereos_rsvp_ctrecho_mob.php" target="_self" style="display: none"> 
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
   function sc_btn_Confirmar() 
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;
 
     ob_start();
?>
<!DOCTYPE html>

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
 <head>
    <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

      if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
      {
?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
      }

?>
        <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
    <SCRIPT type="text/javascript">
      var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
      var sc_tbLangClose = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_close"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
      var sc_tbLangEsc = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_esc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
      var sc_userSweetAlertDisplayed = false;
    </SCRIPT>
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_third; ?>jquery/js/jquery.js"></SCRIPT>
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></SCRIPT>
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></SCRIPT>
<?php
include_once("form_aereos_rsvp_ctrecho_mob_sajax_js.php");
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_sweetalert.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/sweetalert2.all.min.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/polyfill.min.js"></SCRIPT>
 <script type="text/javascript" src="../_lib/lib/js/frameControl.js"></script>
    <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_form.css" />
    <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
  <?php 
  if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
  { 
  ?> 
  <link href="<?php echo $this->Ini->str_google_fonts ?>" rel="stylesheet" /> 
  <?php 
  } 
  ?> 
 </head>
  <body class="scFormPage">
      <table class="scFormTabela" align="center"><tr><td>
<?php
      $varloc_btn_php = array();
      $nmgp_opcao_saida_php = "igual";
      $nmgp_opc_ant_saida_php = "";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['opc_ant'] == "novo" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['opc_ant'] == "incluir")
      {
          $nmgp_opc_ant_saida_php = "novo";
          $nmgp_opcao_saida_php   = "recarga";
      }
      else
      {
          if (!isset($this->part_copy) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dados_form']['part_copy']))
          {
              $varloc_btn_php['part_copy'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dados_form']['part_copy'];
          }
          if (!isset($this->acomp_copy) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dados_form']['acomp_copy']))
          {
              $varloc_btn_php['acomp_copy'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dados_form']['acomp_copy'];
          }
          if (!isset($this->part_copy) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dados_form']['part_copy']))
          {
              $varloc_btn_php['part_copy'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dados_form']['part_copy'];
          }
          if (!isset($this->part_copy) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dados_form']['part_copy']))
          {
              $varloc_btn_php['part_copy'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dados_form']['part_copy'];
          }
          if (!isset($this->acomp_copy) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dados_form']['acomp_copy']))
          {
              $varloc_btn_php['acomp_copy'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dados_form']['acomp_copy'];
          }
          if (!isset($this->acomp_copy) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dados_form']['acomp_copy']))
          {
              $varloc_btn_php['acomp_copy'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dados_form']['acomp_copy'];
          }
          if (!isset($this->part_copy) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dados_form']['part_copy']))
          {
              $varloc_btn_php['part_copy'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dados_form']['part_copy'];
          }
      }
      $nm_f_saida = "form_aereos_rsvp_ctrecho_mob.php";
      nm_limpa_numero($this->id_aereo, $this->field_config['id_aereo']['symbol_grp']) ; 
      nm_limpa_numero($this->aereo_id_evento, $this->field_config['aereo_id_evento']['symbol_grp']) ; 
      $this->part_copy = str_replace("@?@", ";", $this->part_copy);
      $this->acomp_copy = str_replace("@?@", ";", $this->acomp_copy);
      foreach ($varloc_btn_php as $cmp => $val_cmp)
      {
          $this->$cmp = $val_cmp;
      }
      $_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'on';
if (!isset($this->sc_temp_rsvp_global)) {$this->sc_temp_rsvp_global = (isset($_SESSION['rsvp_global'])) ? $_SESSION['rsvp_global'] : "";}
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
if (!isset($this->sc_temp_vg_cpf)) {$this->sc_temp_vg_cpf = (isset($_SESSION['vg_cpf'])) ? $_SESSION['vg_cpf'] : "";}
if (!isset($this->sc_temp_vg_matriz_trunico)) {$this->sc_temp_vg_matriz_trunico = (isset($_SESSION['vg_matriz_trunico'])) ? $_SESSION['vg_matriz_trunico'] : "";}
  $valor_n = 'N';
$valor_y = 'Y';
$valor_r = 'R';

$v_id_trecho = $this->sc_temp_vg_matriz_trunico;


if ($this->part_copy  == '' &&  $this->acomp_copy  == '') {
	$achou_ok = false;
	$ja_existe = true;
	?>
	<!DOCTYPE html>
	<html>
	<body>
	<br><br><br><br><br><br><br><br><br><br><br><br>
		<h1>
			<font color="red"> 
				<center > 
				. Atenção! .  
				</center>
			</font>
		</h1>
		<font size="3"> 
			<center>				
			Nenhum Participante ou Acompanhante foi escolhido!
			</center>
		</font>					 
		<p1>
			<font size="3"> 
				<center>				
				Nenhum trecho foi duplicado, Verifique.
				</center>
			</font>					 
		</p1>
		<br><br><br>
	</body>
	</html>
	<?php
} else {
	$sqlexiste="
	SELECT    
		COUNT(id_aereo) as qtde
	FROM
		aereos_rsvp
	WHERE	
		aereo_cpf_particip = ".$this->Db->qstr($this->sc_temp_vg_cpf)." 	
	AND
		aereo_ativo = ".$this->Db->qstr($valor_y)."
	AND 
		aereo_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."	
	";	
	 
      $nm_select = $sqlexiste; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsexiste = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rsexiste[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsexiste = false;
          $this->rsexiste_erro = $this->Db->ErrorMsg();
      } 
	
	if (isset($this->rsexiste[0][0])) {		
		$existe = $this->rsexiste[0][0];							
	} else {
		$existe = 0;
	}	
	
	if ($existe <> 0) {
		if ($this->part_copy  <> '') {
			$_qcpf = '';
			$w_ultnome = explode (";", $this->part_copy );
			$tamatriz = sizeof($w_ultnome);
			for ($i=0;$i<$tamatriz;++$i) {
				$contador = 0;
				$_poscpf = strpos( $w_ultnome[$i],"CPF:");
				$_qcpf = substr( $w_ultnome[$i],($_poscpf+5),13);	
				$_qcpf = str_replace(' ', '', $_qcpf);
				if ($_qcpf <> '') {	
					$contador = $contador + 1;
					$sql01 = "				
						SELECT
							aereo_status,
							aereo_direcao,
							aereo_cia_aerea,
							aereo_num_voo,
							aereo_origem,
							aereo_destino,
							aereo_dt_saida,
							aereo_hr_saida,
							aereo_dt_chegada,
							aereo_hr_chegada,
							aereo_localizador,
							aereo_eticket,
							aereo_emitida_bvt,
							aereo_valor,
							aereo_bloqueio_id,
							aereo_flag_subtraido,
							aereo_trecho,
							aereo_ativo,
							id_origem_gate,
							nome_pax_gate,
							nota_gate,
							data_nota_gate,
							fil_agt_gate,
							aereo_cia_aerea_gate,
							aereo_transfer_tipo,
							aereo_id_evento,							
							titulo_api,
							descricao_api,
							cod_rota_api,
							tipo_api,
							valido_de_api,
							valido_ate_api,
							duracao_voo_api,
							aeronave_api,
							terminal_api,
							gate_api,
							refeicao_api,
							milhagem_api,
							web_ckeckin_api,
							duracao_escala,
							aeroporto_escala,
							numero_voo_escala,
							hora_saida_escala,
							hora_chegada_escala,
							enviar_app,
							classe_api,
							passageiro_api,
							bagagem_api	
						FROM					
							aereos_rsvp
						WHERE
							id_aereo = ".$this->Db->qstr($v_id_trecho)."							
					";						
					 
      $nm_select = $sql01; 
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
						$data_hora = date('Y-m-d H:i:s');
						$v_aereo_status				= $this->rs[0][0];
						$v_aereo_direcao			= $this->rs[0][1];
						$v_aereo_cia_aerea			= $this->rs[0][2];
						$v_aereo_num_voo			= $this->rs[0][3];
						$v_aereo_origem				= $this->rs[0][4];
						$v_aereo_destino			= $this->rs[0][5];
						$v_aereo_dt_saida			= $this->rs[0][6];
						$v_aereo_hr_saida			= $this->rs[0][7];
						$v_aereo_dt_chegada			= $this->rs[0][8];
						$v_aereo_hr_chegada			= $this->rs[0][9];
						$v_aereo_localizador		= $this->rs[0][10];
						$v_aereo_eticket			= $this->rs[0][11];
						$v_aereo_emitida_bvt		= $this->rs[0][12];	
						$v_aereo_valor				= $this->rs[0][13];
						$v_aereo_bloqueio_id		= $this->rs[0][14];	
						$v_aereo_flag_subtraido		= $this->rs[0][15];
						$v_aereo_trecho				= $this->rs[0][16];
						$v_aereo_ativo				= $this->rs[0][17];
						$v_id_origem_gate			= $this->rs[0][18];
						$v_nome_pax_gate			= $this->rs[0][19];
						$v_nota_gate				= $this->rs[0][20];
						$v_data_nota_gate			= $this->rs[0][21];
						$v_fil_agt_gate				= $this->rs[0][22];
						$v_aereo_cia_aerea_gate		= $this->rs[0][23];
						$v_aereo_transfer_tipo		= $this->rs[0][24];
						$v_aereo_id_evento			= $this->rs[0][25];						
						$v_aereo_modificado_em		= $data_hora; 		
						$v_aereo_dthr_saida			= $v_aereo_dt_saida.' '.$v_aereo_hr_saida;
						$v_aereo_dthr_chegada		= $v_aereo_dt_chegada.' '.$v_aereo_hr_chegada;												
						$v_aereo_id_usuario			= $this->sc_temp_vg_usuario_id;
						
						$v_titulo_api				= $this->rs[0][26];
						$v_descricao_api			= $this->rs[0][27];
						$v_cod_rota_api				= $this->rs[0][28];
						$v_tipo_api					= $this->rs[0][29];
						$v_valido_de_api			= $this->rs[0][30];
						$v_valido_ate_api			= $this->rs[0][31];
						$v_duracao_voo_api			= $this->rs[0][32];
						$v_aeronave_api				= $this->rs[0][33];
						$v_terminal_api				= $this->rs[0][34];
						$v_gate_api					= $this->rs[0][35];
						$v_refeicao_api				= $this->rs[0][36];
						$v_milhagem_api				= $this->rs[0][37];
						$v_web_ckeckin_api			= $this->rs[0][38];
						$v_duracao_escala			= $this->rs[0][39];
						$v_aeroporto_escala			= $this->rs[0][40];
						$v_numero_voo_escala		= $this->rs[0][41];
						$v_hora_saida_escala		= $this->rs[0][42];
						$v_hora_chegada_escala		= $this->rs[0][43];
						$v_enviar_app				= $this->rs[0][44];
						$v_classe_api				= $this->rs[0][45];
						$v_passageiro_api			= $this->rs[0][46];
						$v_bagagem_api				= $this->rs[0][47];
						
						$achou_ok = true;
					} else {
						$achou_ok = false;
					}	
					if ($achou_ok == true) {
						$sql02="
							SELECT    
								COUNT(id_aereo) as qtde
							FROM
								aereos_rsvp
							WHERE 
								aereo_direcao = ".$this->Db->qstr($v_aereo_direcao)." 
							AND  
								aereo_cia_aerea = ".$this->Db->qstr($v_aereo_cia_aerea)." 
							AND
								aereo_num_voo = ".$this->Db->qstr($v_aereo_num_voo)." 
							AND
								aereo_origem = ".$this->Db->qstr($v_aereo_origem)." 
							AND
								aereo_destino = ".$this->Db->qstr($v_aereo_destino)." 
							AND
								aereo_dt_saida = ".$this->Db->qstr($v_aereo_dt_saida)." 
							AND
								aereo_hr_saida = ".$this->Db->qstr($v_aereo_hr_saida)." 	
							AND 
								aereo_dt_chegada = ".$this->Db->qstr($v_aereo_dt_chegada)." 	
							AND
								aereo_hr_chegada = ".$this->Db->qstr($v_aereo_hr_chegada)." 
							AND 	
								aereo_localizador = ".$this->Db->qstr($v_aereo_localizador)." 
							AND
								aereo_eticket = ".$this->Db->qstr($v_aereo_eticket)." 	
							AND
								aereo_cpf_particip = ".$this->Db->qstr($_qcpf)." 	
							AND
								aereo_ativo = ".$this->Db->qstr($valor_y)."
							AND 
								aereo_id_evento = ".$this->Db->qstr($v_aereo_id_evento)."	
						";	
						 
      $nm_select = $sql02; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs02 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs02[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs02 = false;
          $this->rs02_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs02[0][0])) {		
							$qtd_aereo_acomp = $this->rs02[0][0];							
						} else {
							$qtd_aereo_acomp = 0;
						}	
						if ($qtd_aereo_acomp == 0) {
							$sqli="					
								INSERT INTO 
									aereos_rsvp
									(aereo_status,
									aereo_direcao,
									aereo_cia_aerea,
									aereo_num_voo,
									aereo_origem,
									aereo_destino,
									aereo_dt_saida,
									aereo_hr_saida,									
									aereo_dt_chegada,
									aereo_hr_chegada,									
									aereo_localizador,
									aereo_eticket,
									aereo_emitida_bvt,
									aereo_valor,
									aereo_bloqueio_id,									
									aereo_flag_subtraido,
									aereo_trecho,
									aereo_ativo,
									id_origem_gate,
									nome_pax_gate,
									nota_gate,
									data_nota_gate,
									fil_agt_gate,
									aereo_cia_aerea_gate,
									aereo_transfer_tipo,
									aereo_dthr_saida,
									aereo_dthr_chegada,
									aereo_modificado_em,									
									aereo_cpf_particip,
									aereo_id_evento,
									aereo_id_usuario,									
									titulo_api,
									descricao_api,
									cod_rota_api,
									tipo_api,
									valido_de_api,
									valido_ate_api,
									duracao_voo_api,
									aeronave_api,
									terminal_api,
									gate_api,
									refeicao_api,
									milhagem_api,
									web_ckeckin_api,
									duracao_escala,
									aeroporto_escala,
									numero_voo_escala,
									hora_saida_escala,
									hora_chegada_escala,
									enviar_app,
									classe_api,
									passageiro_api,
									bagagem_api)	
								VALUES	
									(".$this->Db->qstr($v_aereo_status).",				
									".$this->Db->qstr($v_aereo_direcao).",			
									".$this->Db->qstr($v_aereo_cia_aerea).",			
									".$this->Db->qstr($v_aereo_num_voo).",			
									".$this->Db->qstr($v_aereo_origem).",				
									".$this->Db->qstr($v_aereo_destino).",			
									".$this->Db->qstr($v_aereo_dt_saida).",			
									".$this->Db->qstr($v_aereo_hr_saida).",											
									".$this->Db->qstr($v_aereo_dt_chegada).",			
									".$this->Db->qstr($v_aereo_hr_chegada).",											
									".$this->Db->qstr($v_aereo_localizador).",		
									".$this->Db->qstr($v_aereo_eticket).",			
									".$this->Db->qstr($v_aereo_emitida_bvt).",		
									".$this->Db->qstr($v_aereo_valor).",				
									".$this->Db->qstr($v_aereo_bloqueio_id).",													
									".$this->Db->qstr($v_aereo_flag_subtraido).",		
									".$this->Db->qstr($v_aereo_trecho).",				
									".$this->Db->qstr($v_aereo_ativo).",				
									".$this->Db->qstr($v_id_origem_gate).",			
									".$this->Db->qstr($v_nome_pax_gate).",			
									".$this->Db->qstr($v_nota_gate).",				
									".$this->Db->qstr($v_data_nota_gate).",			
									".$this->Db->qstr($v_fil_agt_gate).",				
									".$this->Db->qstr($v_aereo_cia_aerea_gate).",		
									".$this->Db->qstr($v_aereo_transfer_tipo).",
									".$this->Db->qstr($v_aereo_dthr_saida).",			
									".$this->Db->qstr($v_aereo_dthr_chegada).",
									".$this->Db->qstr($v_aereo_modificado_em).",										
									".$this->Db->qstr($_qcpf).",
									".$this->Db->qstr($v_aereo_id_evento).",
									".$this->Db->qstr($v_aereo_id_usuario).",									
									".$this->Db->qstr($v_titulo_api).",				
									".$this->Db->qstr($v_descricao_api).",		
									".$this->Db->qstr($v_cod_rota_api).",				
									".$this->Db->qstr($v_tipo_api).",					
									".$this->Db->qstr($v_valido_de_api).",		
									".$this->Db->qstr($v_valido_ate_api).",			
									".$this->Db->qstr($v_duracao_voo_api).",			
									".$this->Db->qstr($v_aeronave_api).",			
									".$this->Db->qstr($v_terminal_api).",				
									".$this->Db->qstr($v_gate_api).",					
									".$this->Db->qstr($v_refeicao_api).",				
									".$this->Db->qstr($v_milhagem_api).",				
									".$this->Db->qstr($v_web_ckeckin_api).",			
									".$this->Db->qstr($v_duracao_escala).",			
									".$this->Db->qstr($v_aeroporto_escala).",			
									".$this->Db->qstr($v_numero_voo_escala).",		
									".$this->Db->qstr($v_hora_saida_escala).",	
									".$this->Db->qstr($v_hora_chegada_escala).",		
									".$this->Db->qstr($v_enviar_app).",				
									".$this->Db->qstr($v_classe_api).",				
									".$this->Db->qstr($v_passageiro_api).",
									".$this->Db->qstr($v_bagagem_api).")
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
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
							if ($contador == 1) {
								$sql3u="
								UPDATE 
									acompanhantes_rsvp
								SET 
									part_aereo_ok = ".$this->Db->qstr($valor_r)."
								WHERE 
									part_cpf = ".$this->Db->qstr($_qcpf)." 
								AND 
									part_id_evento = ".$this->Db->qstr($v_aereo_id_evento)."								
								";
								
     $nm_select = $sql3u; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
							}						
							if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
							
							$this->MakeColor($v_aereo_id_evento,$_qcpf,'I');							
						} else {							
							$sqlu="
								UPDATE 
									aereos_rsvp
								SET 
									aereo_status 			= ".$this->Db->qstr($v_aereo_status).",
									aereo_direcao 			= ".$this->Db->qstr($v_aereo_direcao).",      		
									aereo_cia_aerea     	= ".$this->Db->qstr($v_aereo_cia_aerea).",	
									aereo_num_voo       	= ".$this->Db->qstr($v_aereo_num_voo).",	
									aereo_origem        	= ".$this->Db->qstr($v_aereo_origem).",	
									aereo_destino       	= ".$this->Db->qstr($v_aereo_destino).",	
									aereo_dt_saida      	= ".$this->Db->qstr($v_aereo_dt_saida).",	
									aereo_hr_saida      	= ".$this->Db->qstr($v_aereo_hr_saida).",	
									aereo_dthr_saida    	= ".$this->Db->qstr($v_aereo_dthr_saida).",	
									aereo_dt_chegada    	= ".$this->Db->qstr($v_aereo_dt_chegada).",	
									aereo_hr_chegada    	= ".$this->Db->qstr($v_aereo_hr_chegada).",	
									aereo_dthr_chegada  	= ".$this->Db->qstr($v_aereo_dthr_chegada).",	
									aereo_localizador   	= ".$this->Db->qstr($v_aereo_localizador).",	
									aereo_eticket       	= ".$this->Db->qstr($v_aereo_eticket).",	
									aereo_emitida_bvt   	= ".$this->Db->qstr($v_aereo_emitida_bvt).",	
									aereo_valor         	= ".$this->Db->qstr($v_aereo_valor).",	
									aereo_bloqueio_id   	= ".$this->Db->qstr($v_aereo_bloqueio_id).",	
									aereo_modificado_em 	= ".$this->Db->qstr($v_aereo_modificado_em).",	
									aereo_flag_subtraido	= ".$this->Db->qstr($v_aereo_flag_subtraido).",	
									aereo_trecho        	= ".$this->Db->qstr($v_aereo_trecho).",	
									aereo_ativo         	= ".$this->Db->qstr($v_aereo_ativo).",	
									id_origem_gate      	= ".$this->Db->qstr($v_id_origem_gate).",	
									nome_pax_gate       	= ".$this->Db->qstr($v_nome_pax_gate).",	
									nota_gate           	= ".$this->Db->qstr($v_nota_gate).",	
									data_nota_gate      	= ".$this->Db->qstr($v_data_nota_gate).",	
									fil_agt_gate        	= ".$this->Db->qstr($v_fil_agt_gate).",	
									aereo_cia_aerea_gate	= ".$this->Db->qstr($v_aereo_cia_aerea_gate).",	
									aereo_transfer_tipo		= ".$this->Db->qstr($v_aereo_transfer_tipo).",
									aereo_id_usuario		= ".$this->Db->qstr($v_aereo_id_usuario).",									
									titulo_api				= ".$this->Db->qstr($v_titulo_api).",
									descricao_api			= ".$this->Db->qstr($v_descricao_api).",
									cod_rota_api			= ".$this->Db->qstr($v_cod_rota_api).",
									tipo_api				= ".$this->Db->qstr($v_tipo_api).",
									valido_de_api			= ".$this->Db->qstr($v_valido_de_api).",
									valido_ate_api			= ".$this->Db->qstr($v_valido_ate_api).",	
									duracao_voo_api			= ".$this->Db->qstr($v_duracao_voo_api).",
									aeronave_api			= ".$this->Db->qstr($v_aeronave_api).",
									terminal_api			= ".$this->Db->qstr($v_terminal_api).",
									gate_api				= ".$this->Db->qstr($v_gate_api).",
									refeicao_api			= ".$this->Db->qstr($v_refeicao_api).",
									milhagem_api			= ".$this->Db->qstr($v_milhagem_api).",
									web_ckeckin_api			= ".$this->Db->qstr($v_web_ckeckin_api).",
									duracao_escala			= ".$this->Db->qstr($v_duracao_escala).",
									aeroporto_escala		= ".$this->Db->qstr($v_aeroporto_escala).",
									numero_voo_escala		= ".$this->Db->qstr($v_numero_voo_escala).",
									hora_saida_escala		= ".$this->Db->qstr($v_hora_saida_escala).",
									hora_chegada_escala		= ".$this->Db->qstr($v_hora_chegada_escala).",
									enviar_app				= ".$this->Db->qstr($v_enviar_app).",
									classe_api				= ".$this->Db->qstr($v_classe_api).",
									passageiro_api			= ".$this->Db->qstr($v_passageiro_api).",										
									aereo_id_usuario		= ".$this->Db->qstr($v_bagagem_api)."										
								WHERE 		 
									aereo_direcao = ".$this->Db->qstr($v_aereo_direcao)." 
								AND  
									aereo_cia_aerea = ".$this->Db->qstr($v_aereo_cia_aerea)." 
								AND
									aereo_num_voo = ".$this->Db->qstr($v_aereo_num_voo)." 
								AND
									aereo_origem = ".$this->Db->qstr($v_aereo_origem)." 
								AND
									aereo_destino = ".$this->Db->qstr($v_aereo_destino)." 
								AND
									aereo_dt_saida = ".$this->Db->qstr($v_aereo_dt_saida)." 
								AND
									aereo_hr_saida = ".$this->Db->qstr($v_aereo_hr_saida)." 	
								AND 
									aereo_dt_chegada = ".$this->Db->qstr($v_aereo_dt_chegada)." 	
								AND
									aereo_hr_chegada = ".$this->Db->qstr($v_aereo_hr_chegada)." 
								AND 	
									aereo_localizador = ".$this->Db->qstr($v_aereo_localizador)." 
								AND
									aereo_eticket = ".$this->Db->qstr($v_aereo_eticket)." 	
								AND
									aereo_cpf_particip = ".$this->Db->qstr($_qcpf)." 	
								AND
									aereo_ativo = 'Y'
								AND 
									aereo_id_evento = ".$this->Db->qstr($v_aereo_id_evento)."		
							";							
							
     $nm_select = $sqlu; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
							
							$this->MakeColor($v_aereo_id_evento,$_qcpf,'I');
								
							if ($contador == 1) {
								$sql3u="
								UPDATE 
									acompanhantes_rsvp
								SET 
									part_aereo_ok = ".$this->Db->qstr($valor_r)."
								WHERE 
									part_cpf = ".$this->Db->qstr($_qcpf)." 
								AND 
									part_id_evento = ".$this->Db->qstr($v_aereo_id_evento)."								
								";
								
     $nm_select = $sql3u; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
							}								
							if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
	
							$this->MakeColora($v_aereo_id_evento,$_qcpf,'I');
						}						
					}	
				}
			}
		}		


		if ($this->acomp_copy  <> '') {
			$_qcpf = '';
			$w_ultnome = explode (";", $this->acomp_copy );
			$tamatriz = sizeof($w_ultnome);
			for ($i=0;$i<$tamatriz;++$i) {
				$contador = 0;
				$_poscpf = strpos( $w_ultnome[$i],"CPF:");
				$_qcpf = substr( $w_ultnome[$i],($_poscpf+5),13);	
				$_qcpf = str_replace(' ', '', $_qcpf);
				if ($_qcpf <> '') {						
					$contador = $contador + 1;
					$sql01 = "				
						SELECT
							aereo_status,
							aereo_direcao,
							aereo_cia_aerea,
							aereo_num_voo,
							aereo_origem,
							aereo_destino,
							aereo_dt_saida,
							aereo_hr_saida,
							aereo_dt_chegada,
							aereo_hr_chegada,
							aereo_localizador,
							aereo_eticket,
							aereo_emitida_bvt,
							aereo_valor,
							aereo_bloqueio_id,
							aereo_flag_subtraido,
							aereo_trecho,
							aereo_ativo,
							id_origem_gate,
							nome_pax_gate,
							nota_gate,
							data_nota_gate,
							fil_agt_gate,
							aereo_cia_aerea_gate,
							aereo_transfer_tipo,
							aereo_id_evento,
							
							titulo_api,
							descricao_api,
							cod_rota_api,
							tipo_api,
							valido_de_api,
							valido_ate_api,
							duracao_voo_api,
							aeronave_api,
							terminal_api,
							gate_api,
							refeicao_api,
							milhagem_api,
							web_ckeckin_api,
							duracao_escala,
							aeroporto_escala,
							numero_voo_escala,
							hora_saida_escala,
							hora_chegada_escala,
							enviar_app,
							classe_api,
							passageiro_api,
							bagagem_api
						FROM					
							aereos_rsvp
						WHERE
							id_aereo = ".$this->Db->qstr($v_id_trecho)."							
					";	
					 
      $nm_select = $sql01; 
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
						$data_hora = date('Y-m-d H:i:s');
						$v_aereo_status				= $this->rs[0][0];
						$v_aereo_direcao			= $this->rs[0][1];
						$v_aereo_cia_aerea			= $this->rs[0][2];
						$v_aereo_num_voo			= $this->rs[0][3];
						$v_aereo_origem				= $this->rs[0][4];
						$v_aereo_destino			= $this->rs[0][5];
						$v_aereo_dt_saida			= $this->rs[0][6];
						$v_aereo_hr_saida			= $this->rs[0][7];
						$v_aereo_dt_chegada			= $this->rs[0][8];
						$v_aereo_hr_chegada			= $this->rs[0][9];
						$v_aereo_localizador		= $this->rs[0][10];
						$v_aereo_eticket			= $this->rs[0][11];
						$v_aereo_emitida_bvt		= $this->rs[0][12];	
						$v_aereo_valor				= $this->rs[0][13];
						$v_aereo_bloqueio_id		= $this->rs[0][14];	
						$v_aereo_flag_subtraido		= $this->rs[0][15];
						$v_aereo_trecho				= $this->rs[0][16];
						$v_aereo_ativo				= $this->rs[0][17];
						$v_id_origem_gate			= $this->rs[0][18];
						$v_nome_pax_gate			= $this->rs[0][19];
						$v_nota_gate				= $this->rs[0][20];
						$v_data_nota_gate			= $this->rs[0][21];
						$v_fil_agt_gate				= $this->rs[0][22];
						$v_aereo_cia_aerea_gate		= $this->rs[0][23];
						$v_aereo_transfer_tipo		= $this->rs[0][24];
						$v_aereo_id_evento			= $this->rs[0][25];						
						$v_aereo_modificado_em		= $data_hora; 		
						$v_aereo_dthr_saida			= $v_aereo_dt_saida.' '.$v_aereo_hr_saida;
						$v_aereo_dthr_chegada		= $v_aereo_dt_chegada.' '.$v_aereo_hr_chegada;												
						$v_aereo_id_usuario			= $this->sc_temp_vg_usuario_id;	
						
						$v_titulo_api				= $this->rs[0][26];
						$v_descricao_api			= $this->rs[0][27];
						$v_cod_rota_api				= $this->rs[0][28];
						$v_tipo_api					= $this->rs[0][29];
						$v_valido_de_api			= $this->rs[0][30];
						$v_valido_ate_api			= $this->rs[0][31];
						$v_duracao_voo_api			= $this->rs[0][32];
						$v_aeronave_api				= $this->rs[0][33];
						$v_terminal_api				= $this->rs[0][34];
						$v_gate_api					= $this->rs[0][35];
						$v_refeicao_api				= $this->rs[0][36];
						$v_milhagem_api				= $this->rs[0][37];
						$v_web_ckeckin_api			= $this->rs[0][38];
						$v_duracao_escala			= $this->rs[0][39];
						$v_aeroporto_escala			= $this->rs[0][40];
						$v_numero_voo_escala		= $this->rs[0][41];
						$v_hora_saida_escala		= $this->rs[0][42];
						$v_hora_chegada_escala		= $this->rs[0][43];
						$v_enviar_app				= $this->rs[0][44];
						$v_classe_api				= $this->rs[0][45];
						$v_passageiro_api			= $this->rs[0][46];
						$v_bagagem_api				= $this->rs[0][47];			
						
						$achou_ok = true;
					} else {
						$achou_ok = false;
					}	
					if ($achou_ok == true) {
						$sql02="
							SELECT    
								COUNT(id_aereo) as qtde
							FROM
								aereos_rsvp
							WHERE 
								aereo_direcao = ".$this->Db->qstr($v_aereo_direcao)." 
							AND  
								aereo_cia_aerea = ".$this->Db->qstr($v_aereo_cia_aerea)." 
							AND
								aereo_num_voo = ".$this->Db->qstr($v_aereo_num_voo)." 
							AND
								aereo_origem = ".$this->Db->qstr($v_aereo_origem)." 
							AND
								aereo_destino = ".$this->Db->qstr($v_aereo_destino)." 
							AND
								aereo_dt_saida = ".$this->Db->qstr($v_aereo_dt_saida)." 
							AND
								aereo_hr_saida = ".$this->Db->qstr($v_aereo_hr_saida)." 	
							AND 
								aereo_dt_chegada = ".$this->Db->qstr($v_aereo_dt_chegada)." 	
							AND
								aereo_hr_chegada = ".$this->Db->qstr($v_aereo_hr_chegada)." 
							AND 	
								aereo_localizador = ".$this->Db->qstr($v_aereo_localizador)." 
							AND
								aereo_eticket = ".$this->Db->qstr($v_aereo_eticket)." 	
							AND
								aereo_cpf_particip = ".$this->Db->qstr($_qcpf)." 	
							AND
								aereo_ativo = ".$this->Db->qstr($valor_y)."
							AND 
								aereo_id_evento = ".$this->Db->qstr($v_aereo_id_evento)."	
						";
							
						 
      $nm_select = $sql02; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs02 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs02[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs02 = false;
          $this->rs02_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs02[0][0])) {		
							$qtd_aereo_acomp = $this->rs02[0][0];							
						} else {
							$qtd_aereo_acomp = 0;
						}	
						if ($qtd_aereo_acomp == 0) {
							$sqli="					
								INSERT INTO 
									aereos_rsvp
									(aereo_status,
									aereo_direcao,
									aereo_cia_aerea,
									aereo_num_voo,
									aereo_origem,
									aereo_destino,
									aereo_dt_saida,
									aereo_hr_saida,									
									aereo_dt_chegada,
									aereo_hr_chegada,									
									aereo_localizador,
									aereo_eticket,
									aereo_emitida_bvt,
									aereo_valor,
									aereo_bloqueio_id,									
									aereo_flag_subtraido,
									aereo_trecho,
									aereo_ativo,
									id_origem_gate,
									nome_pax_gate,
									nota_gate,
									data_nota_gate,
									fil_agt_gate,
									aereo_cia_aerea_gate,
									aereo_transfer_tipo,
									aereo_dthr_saida,
									aereo_dthr_chegada,
									aereo_modificado_em,									
									aereo_cpf_particip,
									aereo_id_evento,
									aereo_id_usuario,
									
																			
									titulo_api,
									descricao_api,
									cod_rota_api,
									tipo_api,
									valido_de_api,
									valido_ate_api,
									duracao_voo_api,
									aeronave_api,
									terminal_api,
									gate_api,
									refeicao_api,
									milhagem_api,
									web_ckeckin_api,
									duracao_escala,
									aeroporto_escala,
									numero_voo_escala,
									hora_saida_escala,
									hora_chegada_escala,
									enviar_app,
									classe_api,
									passageiro_api,
									bagagem_api)
								VALUES	
									(".$this->Db->qstr($v_aereo_status).",				
									".$this->Db->qstr($v_aereo_direcao).",			
									".$this->Db->qstr($v_aereo_cia_aerea).",			
									".$this->Db->qstr($v_aereo_num_voo).",			
									".$this->Db->qstr($v_aereo_origem).",				
									".$this->Db->qstr($v_aereo_destino).",			
									".$this->Db->qstr($v_aereo_dt_saida).",			
									".$this->Db->qstr($v_aereo_hr_saida).",											
									".$this->Db->qstr($v_aereo_dt_chegada).",			
									".$this->Db->qstr($v_aereo_hr_chegada).",											
									".$this->Db->qstr($v_aereo_localizador).",		
									".$this->Db->qstr($v_aereo_eticket).",			
									".$this->Db->qstr($v_aereo_emitida_bvt).",		
									".$this->Db->qstr($v_aereo_valor).",				
									".$this->Db->qstr($v_aereo_bloqueio_id).",													
									".$this->Db->qstr($v_aereo_flag_subtraido).",		
									".$this->Db->qstr($v_aereo_trecho).",				
									".$this->Db->qstr($v_aereo_ativo).",				
									".$this->Db->qstr($v_id_origem_gate).",			
									".$this->Db->qstr($v_nome_pax_gate).",			
									".$this->Db->qstr($v_nota_gate).",				
									".$this->Db->qstr($v_data_nota_gate).",			
									".$this->Db->qstr($v_fil_agt_gate).",				
									".$this->Db->qstr($v_aereo_cia_aerea_gate).",		
									".$this->Db->qstr($v_aereo_transfer_tipo).",
									".$this->Db->qstr($v_aereo_dthr_saida).",			
									".$this->Db->qstr($v_aereo_dthr_chegada).",
									".$this->Db->qstr($v_aereo_modificado_em).",										
									".$this->Db->qstr($_qcpf).",
									".$this->Db->qstr($v_aereo_id_evento).",
									".$this->Db->qstr($v_aereo_id_usuario)."),
									
									".$this->Db->qstr($v_titulo_api).",				
									".$this->Db->qstr($v_descricao_api).",		
									".$this->Db->qstr($v_cod_rota_api).",				
									".$this->Db->qstr($v_tipo_api).",					
									".$this->Db->qstr($v_valido_de_api).",		
									".$this->Db->qstr($v_valido_ate_api).",			
									".$this->Db->qstr($v_duracao_voo_api).",			
									".$this->Db->qstr($v_aeronave_api).",			
									".$this->Db->qstr($v_terminal_api).",				
									".$this->Db->qstr($v_gate_api).",					
									".$this->Db->qstr($v_refeicao_api).",				
									".$this->Db->qstr($v_milhagem_api).",				
									".$this->Db->qstr($v_web_ckeckin_api).",			
									".$this->Db->qstr($v_duracao_escala).",			
									".$this->Db->qstr($v_aeroporto_escala).",			
									".$this->Db->qstr($v_numero_voo_escala).",		
									".$this->Db->qstr($v_hora_saida_escala).",	
									".$this->Db->qstr($v_hora_chegada_escala).",		
									".$this->Db->qstr($v_enviar_app).",				
									".$this->Db->qstr($v_classe_api).",				
									".$this->Db->qstr($v_passageiro_api).",	
									".$this->Db->qstr($v_bagagem_api).")	
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
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
							$this->MakeColora($v_aereo_id_evento,$_qcpf,'I');
							if ($contador == 1) {
								$sql3u="
								UPDATE 
									acompanhantes_rsvp
								SET 
									part_aereo_ok = ".$this->Db->qstr($valor_r)."
								WHERE 
									part_cpf = ".$this->Db->qstr($_qcpf)." 
								AND 
									part_id_evento = ".$this->Db->qstr($v_aereo_id_evento)."								
								";
								
     $nm_select = $sql3u; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
							}						
							if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
		
							$this->MakeColora($v_aereo_id_evento,$_qcpf,'I');
						} else {							
							$sqlu="
								UPDATE 
									aereos_rsvp
								SET 
									aereo_status 			= ".$this->Db->qstr($v_aereo_status).",
									aereo_direcao 			= ".$this->Db->qstr($v_aereo_direcao).",      		
									aereo_cia_aerea     	= ".$this->Db->qstr($v_aereo_cia_aerea).",	
									aereo_num_voo       	= ".$this->Db->qstr($v_aereo_num_voo).",	
									aereo_origem        	= ".$this->Db->qstr($v_aereo_origem).",	
									aereo_destino       	= ".$this->Db->qstr($v_aereo_destino).",	
									aereo_dt_saida      	= ".$this->Db->qstr($v_aereo_dt_saida).",	
									aereo_hr_saida      	= ".$this->Db->qstr($v_aereo_hr_saida).",	
									aereo_dthr_saida    	= ".$this->Db->qstr($v_aereo_dthr_saida).",	
									aereo_dt_chegada    	= ".$this->Db->qstr($v_aereo_dt_chegada).",	
									aereo_hr_chegada    	= ".$this->Db->qstr($v_aereo_hr_chegada).",	
									aereo_dthr_chegada  	= ".$this->Db->qstr($v_aereo_dthr_chegada).",	
									aereo_localizador   	= ".$this->Db->qstr($v_aereo_localizador).",	
									aereo_eticket       	= ".$this->Db->qstr($v_aereo_eticket).",	
									aereo_emitida_bvt   	= ".$this->Db->qstr($v_aereo_emitida_bvt).",	
									aereo_valor         	= ".$this->Db->qstr($v_aereo_valor).",	
									aereo_bloqueio_id   	= ".$this->Db->qstr($v_aereo_bloqueio_id).",	
									aereo_modificado_em 	= ".$this->Db->qstr($v_aereo_modificado_em).",	
									aereo_flag_subtraido	= ".$this->Db->qstr($v_aereo_flag_subtraido).",	
									aereo_trecho        	= ".$this->Db->qstr($v_aereo_trecho).",	
									aereo_ativo         	= ".$this->Db->qstr($v_aereo_ativo).",	
									id_origem_gate      	= ".$this->Db->qstr($v_id_origem_gate).",	
									nome_pax_gate       	= ".$this->Db->qstr($v_nome_pax_gate).",	
									nota_gate           	= ".$this->Db->qstr($v_nota_gate).",	
									data_nota_gate      	= ".$this->Db->qstr($v_data_nota_gate).",	
									fil_agt_gate        	= ".$this->Db->qstr($v_fil_agt_gate).",	
									aereo_cia_aerea_gate	= ".$this->Db->qstr($v_aereo_cia_aerea_gate).",	
									aereo_transfer_tipo		= ".$this->Db->qstr($v_aereo_transfer_tipo).",
									aereo_id_usuario		= ".$this->Db->qstr($v_aereo_id_usuario).",
									
									titulo_api				= ".$this->Db->qstr($v_titulo_api).",
									descricao_api			= ".$this->Db->qstr($v_descricao_api).",
									cod_rota_api			= ".$this->Db->qstr($v_cod_rota_api).",
									tipo_api				= ".$this->Db->qstr($v_tipo_api).",
									valido_de_api			= ".$this->Db->qstr($v_valido_de_api).",
									valido_ate_api			= ".$this->Db->qstr($v_valido_ate_api).",	
									duracao_voo_api			= ".$this->Db->qstr($v_duracao_voo_api).",
									aeronave_api			= ".$this->Db->qstr($v_aeronave_api).",
									terminal_api			= ".$this->Db->qstr($v_terminal_api).",
									gate_api				= ".$this->Db->qstr($v_gate_api).",
									refeicao_api			= ".$this->Db->qstr($v_refeicao_api).",
									milhagem_api			= ".$this->Db->qstr($v_milhagem_api).",
									web_ckeckin_api			= ".$this->Db->qstr($v_web_ckeckin_api).",
									duracao_escala			= ".$this->Db->qstr($v_duracao_escala).",
									aeroporto_escala		= ".$this->Db->qstr($v_aeroporto_escala).",
									numero_voo_escala		= ".$this->Db->qstr($v_numero_voo_escala).",
									hora_saida_escala		= ".$this->Db->qstr($v_hora_saida_escala).",
									hora_chegada_escala		= ".$this->Db->qstr($v_hora_chegada_escala).",
									enviar_app				= ".$this->Db->qstr($v_enviar_app).",
									classe_api				= ".$this->Db->qstr($v_classe_api).",
									passageiro_api			= ".$this->Db->qstr($v_passageiro_api).",										
									aereo_id_usuario		= ".$this->Db->qstr($v_bagagem_api)."
								WHERE 		 
									aereo_direcao = ".$this->Db->qstr($v_aereo_direcao)." 
								AND  
									aereo_cia_aerea = ".$this->Db->qstr($v_aereo_cia_aerea)." 
								AND
									aereo_num_voo = ".$this->Db->qstr($v_aereo_num_voo)." 
								AND
									aereo_origem = ".$this->Db->qstr($v_aereo_origem)." 
								AND
									aereo_destino = ".$this->Db->qstr($v_aereo_destino)." 
								AND
									aereo_dt_saida = ".$this->Db->qstr($v_aereo_dt_saida)." 
								AND
									aereo_hr_saida = ".$this->Db->qstr($v_aereo_hr_saida)." 	
								AND 
									aereo_dt_chegada = ".$this->Db->qstr($v_aereo_dt_chegada)." 	
								AND
									aereo_hr_chegada = ".$this->Db->qstr($v_aereo_hr_chegada)." 
								AND 	
									aereo_localizador = ".$this->Db->qstr($v_aereo_localizador)." 
								AND
									aereo_eticket = ".$this->Db->qstr($v_aereo_eticket)." 	
								AND
									aereo_cpf_particip = ".$this->Db->qstr($_qcpf)." 	
								AND
									aereo_ativo = 'Y'
								AND 
									aereo_id_evento = ".$this->Db->qstr($v_aereo_id_evento)."		
							";							
							
     $nm_select = $sqlu; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
							$this->MakeColora($v_aereo_id_evento,$_qcpf,'I');
							if ($contador == 1) {
								$sql3u="
								UPDATE 
									acompanhantes_rsvp
								SET 
									part_aereo_ok = ".$this->Db->qstr($valor_r)." 
								WHERE 
									part_cpf = ".$this->Db->qstr($_qcpf)." 
								AND 
									part_id_evento = ".$this->Db->qstr($v_aereo_id_evento)."								
								";
								
     $nm_select = $sql3u; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
							}								
							if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
						
							$this->MakeColora($v_aereo_id_evento,$_qcpf,'I');								
						}
					}	
				}				
			}
		}		
		$this->sql_log = $_SESSION['scriptcase']['sc_sql_ult_comando'];
		$global_cpf = $this->sc_temp_rsvp_global['usuario_cpf'];
		$modulo=  $this->Ini->nm_cod_apl;
		$aplicacao = $this->Ini->nm_nome_apl;
		$hora_now = date('Y-m-d H:i:s');
		$ip_usuario = $this->PegaIP();
		$id_usuario = $this->sc_temp_vg_usuario_id;
		$acao = "COPIAR";
		$campo_cpf = $sc_tmp_field_name = 'aereo_cpf_particip';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] ;
		$campo_evt = $sc_tmp_field_name = 'aereo_id_evento';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] ;
		$campo_id = $sc_tmp_field_name = 'id_aereo';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] ;
		$vl_campo_id =  $v_id_trecho;
		$vl_campo_cpf = $this->sc_temp_vg_cpf;
		$vl_campo_evt = $v_aereo_id_evento;
		$tabela = 'aereos_rsvp';
		$obs = 'Status: '.$v_aereo_status.' Copiado p/Participante: '.$this->part_copy ;
		if ($this->sc_temp_rsvp_global['log_rsvp'] == true) { 
			$retLog = $this->GravaLog($hora_now,$ip_usuario,$id_usuario,$global_cpf,$modulo,$aplicacao,$acao,$campo_id,$vl_campo_id,$campo_cpf,$vl_campo_cpf,$campo_evt,$vl_campo_evt,$tabela,$obs,$this->sql_log);
		}	
		if ($retLog == false) {
			
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Erro ao Gravar LOG";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_form_aereos_rsvp_ctrecho_mob';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_aereos_rsvp_ctrecho_mob';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Erro ao Gravar LOG";
 }
;		
		}		
		 if (isset($this->sc_temp_vg_matriz_trunico)) { $_SESSION['vg_matriz_trunico'] = $this->sc_temp_vg_matriz_trunico;}
 if (isset($this->sc_temp_vg_cpf)) { $_SESSION['vg_cpf'] = $this->sc_temp_vg_cpf;}
 if (isset($this->sc_temp_vg_evento_id)) { $_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
 if (isset($this->sc_temp_vg_usuario_id)) { $_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
 if (isset($this->sc_temp_rsvp_global)) { $_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('grid_aereos_rsvp_1') . "/", $this->nm_location, "","_self", '', 440, 630);
 };					
	} else {
		?>
		<!DOCTYPE html>
		<html>
		<body>
		<br><br><br><br><br><br><br><br><br><br><br><br>
			<h1>
				<font color="red"> 
					<center > 
					. Atenção! .  
					</center>
				</font>
			</h1>
			<font size="3"> 
				<center>				
				O Participante não possui trecho(s) para copiar!
				</center>
			</font>					 
			<p1>
				<font size="3"> 
					<center>				
					Nenhum trecho foi duplicado, Verifique.
					</center>
				</font>					 
			</p1>
			<br><br><br>
		</body>
		</html>
		<?php
	}	
}
if (isset($this->sc_temp_vg_matriz_trunico)) { $_SESSION['vg_matriz_trunico'] = $this->sc_temp_vg_matriz_trunico;}
if (isset($this->sc_temp_vg_cpf)) { $_SESSION['vg_cpf'] = $this->sc_temp_vg_cpf;}
if (isset($this->sc_temp_vg_evento_id)) { $_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_usuario_id)) { $_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_rsvp_global)) { $_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
$_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'off'; 
    echo ob_get_clean();
?>
      </td></tr><tr><td align="center">
      <form name="FPHP" method="post" 
                        action="<?php echo $nm_f_saida ?>" 
                        target="_self">
      <input type=hidden name="nmgp_opcao" value=""/>
      <input type=hidden name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>"/>
      <input type=hidden name="id_aereo" value="<?php echo $this->form_encode_input($this->id_aereo) ?>"/>
      <input type=hidden name="nmgp_opcao" value="<?php echo $this->form_encode_input($nmgp_opcao_saida_php); ?>"/>
      <input type=hidden name="nmgp_opc_ant" value="<?php echo $this->form_encode_input($nmgp_opc_ant_saida_php); ?>"/>
      <input type=submit name="nmgp_bok" value="<?php echo $this->Ini->Nm_lang['lang_btns_cfrm'] ?>"/>
      </form>
      </td></tr></table>
      </body>
      </html>
<?php
       if (isset($this->redir_modal) && !empty($this->redir_modal))
       {
           echo "<script type=\"text/javascript\">" . $this->redir_modal . "</script>";
           $this->redir_modal = "";
       }
   }
   function sc_btn_Voltar() 
   {
        global $nm_url_saida, $teste_validade, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;
 
     ob_start();
?>
<!DOCTYPE html>

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
 <head>
    <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php

      if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
      {
?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
      }

?>
        <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
    <SCRIPT type="text/javascript">
      var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
      var sc_tbLangClose = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_close"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
      var sc_tbLangEsc = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_esc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
      var sc_userSweetAlertDisplayed = false;
    </SCRIPT>
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_third; ?>jquery/js/jquery.js"></SCRIPT>
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></SCRIPT>
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></SCRIPT>
<?php
include_once("form_aereos_rsvp_ctrecho_mob_sajax_js.php");
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_sweetalert.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/sweetalert2.all.min.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/polyfill.min.js"></SCRIPT>
 <script type="text/javascript" src="../_lib/lib/js/frameControl.js"></script>
    <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_form.css" />
    <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
  <?php 
  if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
  { 
  ?> 
  <link href="<?php echo $this->Ini->str_google_fonts ?>" rel="stylesheet" /> 
  <?php 
  } 
  ?> 
 </head>
  <body class="scFormPage">
      <table class="scFormTabela" align="center"><tr><td>
<?php
      $nmgp_opcao_saida_php = "igual";
      $nmgp_opc_ant_saida_php = "";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['opc_ant'] == "novo" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['opc_ant'] == "incluir")
      {
          $nmgp_opc_ant_saida_php = "novo";
          $nmgp_opcao_saida_php   = "recarga";
      }
      $nm_f_saida = "form_aereos_rsvp_ctrecho_mob.php";
      nm_limpa_numero($this->id_aereo, $this->field_config['id_aereo']['symbol_grp']) ; 
      nm_limpa_numero($this->aereo_id_evento, $this->field_config['aereo_id_evento']['symbol_grp']) ; 
      $this->part_copy = str_replace("@?@", ";", $this->part_copy);
      $this->acomp_copy = str_replace("@?@", ";", $this->acomp_copy);
      $_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'on';
   if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('grid_participantes_rsvp_1') . "/", $this->nm_location, "","_self", '', 440, 630);
 };
$_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'off'; 
    echo ob_get_clean();
?>
      </td></tr><tr><td align="center">
      <form name="FPHP" method="post" 
                        action="<?php echo $nm_f_saida ?>" 
                        target="_self">
      <input type=hidden name="nmgp_opcao" value=""/>
      <input type=hidden name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>"/>
      <input type=hidden name="id_aereo" value="<?php echo $this->form_encode_input($this->id_aereo) ?>"/>
      <input type=hidden name="nmgp_opcao" value="<?php echo $this->form_encode_input($nmgp_opcao_saida_php); ?>"/>
      <input type=hidden name="nmgp_opc_ant" value="<?php echo $this->form_encode_input($nmgp_opc_ant_saida_php); ?>"/>
      <input type=submit name="nmgp_bok" value="<?php echo $this->Ini->Nm_lang['lang_btns_cfrm'] ?>"/>
      </form>
      </td></tr></table>
      </body>
      </html>
<?php
       if (isset($this->redir_modal) && !empty($this->redir_modal))
       {
           echo "<script type=\"text/javascript\">" . $this->redir_modal . "</script>";
           $this->redir_modal = "";
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
           case 'id_aereo':
               return "Id Aereo";
               break;
           case 'aereo_id_evento':
               return "Aereo Id Evento";
               break;
           case 'part_copy':
               return "Selecione os Participantes";
               break;
           case 'acomp_copy':
               return "Selecione os Acompanhantes";
               break;
           case 'cpf_del':
               return "cpf_del";
               break;
           case 'sql_log':
               return "sql_log";
               break;
           case 'aereo_id_usuario':
               return "Aereo Id Usuario";
               break;
           case 'aereo_cpf_particip':
               return "Aereo Cpf Particip";
               break;
           case 'aereo_tipo_pessoa':
               return "Aereo Tipo Pessoa";
               break;
           case 'aereo_status':
               return "Aereo Status";
               break;
           case 'aereo_direcao':
               return "Aereo Direcao";
               break;
           case 'aereo_cia_aerea':
               return "Aereo Cia Aerea";
               break;
           case 'aereo_num_voo':
               return "Aereo Num Voo";
               break;
           case 'aereo_origem':
               return "Aereo Origem";
               break;
           case 'aereo_destino':
               return "Aereo Destino";
               break;
           case 'aereo_dt_saida':
               return "Aereo Dt Saida";
               break;
           case 'aereo_hr_saida':
               return "Aereo Hr Saida";
               break;
           case 'aereo_dthr_saida':
               return "Aereo Dthr Saida";
               break;
           case 'aereo_dt_chegada':
               return "Aereo Dt Chegada";
               break;
           case 'aereo_hr_chegada':
               return "Aereo Hr Chegada";
               break;
           case 'aereo_dthr_chegada':
               return "Aereo Dthr Chegada";
               break;
           case 'aereo_localizador':
               return "Aereo Localizador";
               break;
           case 'aereo_eticket':
               return "Aereo Eticket";
               break;
           case 'aereo_emitida_bvt':
               return "Aereo Emitida Bvt";
               break;
           case 'aereo_valor':
               return "Aereo Valor";
               break;
           case 'aereo_bloqueio_id':
               return "Aereo Bloqueio Id";
               break;
           case 'aereo_modificado_em':
               return "Aereo Modificado Em";
               break;
           case 'aereo_flag_subtraido':
               return "Aereo Flag Subtraido";
               break;
           case 'aereo_trecho':
               return "Aereo Trecho";
               break;
           case 'aereo_ativo':
               return "Aereo Ativo";
               break;
           case 'id_origem_gate':
               return "Id Origem Gate";
               break;
           case 'nome_pax_gate':
               return "Nome Pax Gate";
               break;
           case 'nota_gate':
               return "Nota Gate";
               break;
           case 'data_nota_gate':
               return "Data Nota Gate";
               break;
           case 'fil_agt_gate':
               return "Fil Agt Gate";
               break;
           case 'aereo_cia_aerea_gate':
               return "Aereo Cia Aerea Gate";
               break;
           case 'aereo_transfer_tipo':
               return "Aereo Transfer Tipo";
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

     if (!is_array($filtro) && '' == $filtro && isset($this->nm_form_submit) && '1' == $this->nm_form_submit && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['csrf_token']) && $this->scCsrfGetToken() != $this->csrf_token)
     {
          $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
          $this->Campos_Mens_erro .= "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          if ($this->NM_ajax_flag)
          {
              if (!isset($this->NM_ajax_info['errList']['geral_form_aereos_rsvp_ctrecho_mob']) || !is_array($this->NM_ajax_info['errList']['geral_form_aereos_rsvp_ctrecho_mob']))
              {
                  $this->NM_ajax_info['errList']['geral_form_aereos_rsvp_ctrecho_mob'] = array();
              }
              $this->NM_ajax_info['errList']['geral_form_aereos_rsvp_ctrecho_mob'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ((!is_array($filtro) && ('' == $filtro || 'id_aereo' == $filtro)) || (is_array($filtro) && in_array('id_aereo', $filtro)))
        $this->ValidateField_id_aereo($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'aereo_id_evento' == $filtro)) || (is_array($filtro) && in_array('aereo_id_evento', $filtro)))
        $this->ValidateField_aereo_id_evento($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'part_copy' == $filtro)) || (is_array($filtro) && in_array('part_copy', $filtro)))
        $this->ValidateField_part_copy($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'acomp_copy' == $filtro)) || (is_array($filtro) && in_array('acomp_copy', $filtro)))
        $this->ValidateField_acomp_copy($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'cpf_del' == $filtro)) || (is_array($filtro) && in_array('cpf_del', $filtro)))
        $this->ValidateField_cpf_del($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'sql_log' == $filtro)) || (is_array($filtro) && in_array('sql_log', $filtro)))
        $this->ValidateField_sql_log($Campos_Crit, $Campos_Falta, $Campos_Erros);
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

    function ValidateField_id_aereo(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['id_aereo'])) {
          nm_limpa_numero($this->id_aereo, $this->field_config['id_aereo']['symbol_grp']) ; 
          return;
      }
      if ($this->id_aereo === "" || is_null($this->id_aereo))  
      { 
          $this->id_aereo = 0;
      } 
      nm_limpa_numero($this->id_aereo, $this->field_config['id_aereo']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_id_aereo' == $this->NM_ajax_opcao)
      { 
          if ($this->id_aereo != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->id_aereo) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Id Aereo: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['id_aereo']))
                  {
                      $Campos_Erros['id_aereo'] = array();
                  }
                  $Campos_Erros['id_aereo'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['id_aereo']) || !is_array($this->NM_ajax_info['errList']['id_aereo']))
                  {
                      $this->NM_ajax_info['errList']['id_aereo'] = array();
                  }
                  $this->NM_ajax_info['errList']['id_aereo'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->id_aereo, 11, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Id Aereo; " ; 
                  if (!isset($Campos_Erros['id_aereo']))
                  {
                      $Campos_Erros['id_aereo'] = array();
                  }
                  $Campos_Erros['id_aereo'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['id_aereo']) || !is_array($this->NM_ajax_info['errList']['id_aereo']))
                  {
                      $this->NM_ajax_info['errList']['id_aereo'] = array();
                  }
                  $this->NM_ajax_info['errList']['id_aereo'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'id_aereo';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_id_aereo

    function ValidateField_aereo_id_evento(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['aereo_id_evento'])) {
          nm_limpa_numero($this->aereo_id_evento, $this->field_config['aereo_id_evento']['symbol_grp']) ; 
          return;
      }
      if ($this->aereo_id_evento === "" || is_null($this->aereo_id_evento))  
      { 
          $this->aereo_id_evento = 0;
          $this->sc_force_zero[] = 'aereo_id_evento';
      } 
      nm_limpa_numero($this->aereo_id_evento, $this->field_config['aereo_id_evento']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->aereo_id_evento != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->aereo_id_evento) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Aereo Id Evento: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['aereo_id_evento']))
                  {
                      $Campos_Erros['aereo_id_evento'] = array();
                  }
                  $Campos_Erros['aereo_id_evento'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['aereo_id_evento']) || !is_array($this->NM_ajax_info['errList']['aereo_id_evento']))
                  {
                      $this->NM_ajax_info['errList']['aereo_id_evento'] = array();
                  }
                  $this->NM_ajax_info['errList']['aereo_id_evento'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->aereo_id_evento, 11, 0, -0, 99999999999, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Aereo Id Evento; " ; 
                  if (!isset($Campos_Erros['aereo_id_evento']))
                  {
                      $Campos_Erros['aereo_id_evento'] = array();
                  }
                  $Campos_Erros['aereo_id_evento'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['aereo_id_evento']) || !is_array($this->NM_ajax_info['errList']['aereo_id_evento']))
                  {
                      $this->NM_ajax_info['errList']['aereo_id_evento'] = array();
                  }
                  $this->NM_ajax_info['errList']['aereo_id_evento'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'aereo_id_evento';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_aereo_id_evento

    function ValidateField_part_copy(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['part_copy'])) {
          return;
      }
      if (!empty($this->part_copy))
      {
          $this->part_copy = str_replace('@?@', ';', $this->part_copy);
          $part_copy_SC    = explode(';', $this->part_copy);
          foreach ($part_copy_SC as $cada_cmp_SC)
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_part_copy']) && !in_array($cada_cmp_SC, $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_part_copy']))
              {
                  $hasError = true;
                  $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                  if (!isset($Campos_Erros['part_copy']))
                  {
                      $Campos_Erros['part_copy'] = array();
                  }
                  $Campos_Erros['part_copy'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                  if (!isset($this->NM_ajax_info['errList']['part_copy']) || !is_array($this->NM_ajax_info['errList']['part_copy']))
                  {
                      $this->NM_ajax_info['errList']['part_copy'] = array();
                  }
                  $this->NM_ajax_info['errList']['part_copy'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                  break;
              }
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'part_copy';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_part_copy

    function ValidateField_acomp_copy(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['acomp_copy'])) {
          return;
      }
      if (!empty($this->acomp_copy))
      {
          $this->acomp_copy = str_replace('@?@', ';', $this->acomp_copy);
          $acomp_copy_SC    = explode(';', $this->acomp_copy);
          foreach ($acomp_copy_SC as $cada_cmp_SC)
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_acomp_copy']) && !in_array($cada_cmp_SC, $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_acomp_copy']))
              {
                  $hasError = true;
                  $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                  if (!isset($Campos_Erros['acomp_copy']))
                  {
                      $Campos_Erros['acomp_copy'] = array();
                  }
                  $Campos_Erros['acomp_copy'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                  if (!isset($this->NM_ajax_info['errList']['acomp_copy']) || !is_array($this->NM_ajax_info['errList']['acomp_copy']))
                  {
                      $this->NM_ajax_info['errList']['acomp_copy'] = array();
                  }
                  $this->NM_ajax_info['errList']['acomp_copy'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                  break;
              }
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'acomp_copy';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_acomp_copy

    function ValidateField_cpf_del(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['cpf_del'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->cpf_del) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'cpf_del';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_cpf_del

    function ValidateField_sql_log(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['sql_log'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->sql_log) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'sql_log';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_sql_log

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
    $this->nmgp_dados_form['id_aereo'] = $this->id_aereo;
    $this->nmgp_dados_form['aereo_id_evento'] = $this->aereo_id_evento;
    $this->nmgp_dados_form['part_copy'] = $this->part_copy;
    $this->nmgp_dados_form['acomp_copy'] = $this->acomp_copy;
    $this->nmgp_dados_form['cpf_del'] = $this->cpf_del;
    $this->nmgp_dados_form['sql_log'] = $this->sql_log;
    $this->nmgp_dados_form['aereo_id_usuario'] = $this->aereo_id_usuario;
    $this->nmgp_dados_form['aereo_cpf_particip'] = $this->aereo_cpf_particip;
    $this->nmgp_dados_form['aereo_tipo_pessoa'] = $this->aereo_tipo_pessoa;
    $this->nmgp_dados_form['aereo_status'] = $this->aereo_status;
    $this->nmgp_dados_form['aereo_direcao'] = $this->aereo_direcao;
    $this->nmgp_dados_form['aereo_cia_aerea'] = $this->aereo_cia_aerea;
    $this->nmgp_dados_form['aereo_num_voo'] = $this->aereo_num_voo;
    $this->nmgp_dados_form['aereo_origem'] = $this->aereo_origem;
    $this->nmgp_dados_form['aereo_destino'] = $this->aereo_destino;
    $this->nmgp_dados_form['aereo_dt_saida'] = $this->aereo_dt_saida;
    $this->nmgp_dados_form['aereo_hr_saida'] = $this->aereo_hr_saida;
    $this->nmgp_dados_form['aereo_dthr_saida'] = $this->aereo_dthr_saida;
    $this->nmgp_dados_form['aereo_dt_chegada'] = $this->aereo_dt_chegada;
    $this->nmgp_dados_form['aereo_hr_chegada'] = $this->aereo_hr_chegada;
    $this->nmgp_dados_form['aereo_dthr_chegada'] = $this->aereo_dthr_chegada;
    $this->nmgp_dados_form['aereo_localizador'] = $this->aereo_localizador;
    $this->nmgp_dados_form['aereo_eticket'] = $this->aereo_eticket;
    $this->nmgp_dados_form['aereo_emitida_bvt'] = $this->aereo_emitida_bvt;
    $this->nmgp_dados_form['aereo_valor'] = $this->aereo_valor;
    $this->nmgp_dados_form['aereo_bloqueio_id'] = $this->aereo_bloqueio_id;
    $this->nmgp_dados_form['aereo_modificado_em'] = $this->aereo_modificado_em;
    $this->nmgp_dados_form['aereo_flag_subtraido'] = $this->aereo_flag_subtraido;
    $this->nmgp_dados_form['aereo_trecho'] = $this->aereo_trecho;
    $this->nmgp_dados_form['aereo_ativo'] = $this->aereo_ativo;
    $this->nmgp_dados_form['id_origem_gate'] = $this->id_origem_gate;
    $this->nmgp_dados_form['nome_pax_gate'] = $this->nome_pax_gate;
    $this->nmgp_dados_form['nota_gate'] = $this->nota_gate;
    $this->nmgp_dados_form['data_nota_gate'] = $this->data_nota_gate;
    $this->nmgp_dados_form['fil_agt_gate'] = $this->fil_agt_gate;
    $this->nmgp_dados_form['aereo_cia_aerea_gate'] = $this->aereo_cia_aerea_gate;
    $this->nmgp_dados_form['aereo_transfer_tipo'] = $this->aereo_transfer_tipo;
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
      $this->Before_unformat['id_aereo'] = $this->id_aereo;
      nm_limpa_numero($this->id_aereo, $this->field_config['id_aereo']['symbol_grp']) ; 
      $this->Before_unformat['aereo_id_evento'] = $this->aereo_id_evento;
      nm_limpa_numero($this->aereo_id_evento, $this->field_config['aereo_id_evento']['symbol_grp']) ; 
      $this->Before_unformat['aereo_id_usuario'] = $this->aereo_id_usuario;
      nm_limpa_numero($this->aereo_id_usuario, $this->field_config['aereo_id_usuario']['symbol_grp']) ; 
      $this->Before_unformat['aereo_cia_aerea'] = $this->aereo_cia_aerea;
      nm_limpa_numero($this->aereo_cia_aerea, $this->field_config['aereo_cia_aerea']['symbol_grp']) ; 
      $this->Before_unformat['aereo_dt_saida'] = $this->aereo_dt_saida;
      nm_limpa_data($this->aereo_dt_saida, $this->field_config['aereo_dt_saida']['date_sep']) ; 
      $this->Before_unformat['aereo_hr_saida'] = $this->aereo_hr_saida;
      nm_limpa_hora($this->aereo_hr_saida, $this->field_config['aereo_hr_saida']['time_sep']) ; 
      $this->Before_unformat['aereo_dthr_saida'] = $this->aereo_dthr_saida;
      $this->Before_unformat['aereo_dthr_saida_hora'] = $this->aereo_dthr_saida_hora;
      nm_limpa_data($this->aereo_dthr_saida, $this->field_config['aereo_dthr_saida']['date_sep']) ; 
      nm_limpa_hora($this->aereo_dthr_saida_hora, $this->field_config['aereo_dthr_saida']['time_sep']) ; 
      $this->Before_unformat['aereo_dt_chegada'] = $this->aereo_dt_chegada;
      nm_limpa_data($this->aereo_dt_chegada, $this->field_config['aereo_dt_chegada']['date_sep']) ; 
      $this->Before_unformat['aereo_hr_chegada'] = $this->aereo_hr_chegada;
      nm_limpa_hora($this->aereo_hr_chegada, $this->field_config['aereo_hr_chegada']['time_sep']) ; 
      $this->Before_unformat['aereo_dthr_chegada'] = $this->aereo_dthr_chegada;
      $this->Before_unformat['aereo_dthr_chegada_hora'] = $this->aereo_dthr_chegada_hora;
      nm_limpa_data($this->aereo_dthr_chegada, $this->field_config['aereo_dthr_chegada']['date_sep']) ; 
      nm_limpa_hora($this->aereo_dthr_chegada_hora, $this->field_config['aereo_dthr_chegada']['time_sep']) ; 
      $this->Before_unformat['aereo_valor'] = $this->aereo_valor;
      if (!empty($this->field_config['aereo_valor']['symbol_dec']))
      {
         $this->sc_remove_currency($this->aereo_valor, $this->field_config['aereo_valor']['symbol_dec'], $this->field_config['aereo_valor']['symbol_grp'], $this->field_config['aereo_valor']['symbol_mon']);
         nm_limpa_valor($this->aereo_valor, $this->field_config['aereo_valor']['symbol_dec'], $this->field_config['aereo_valor']['symbol_grp']);
      }
      $this->Before_unformat['aereo_bloqueio_id'] = $this->aereo_bloqueio_id;
      nm_limpa_numero($this->aereo_bloqueio_id, $this->field_config['aereo_bloqueio_id']['symbol_grp']) ; 
      $this->Before_unformat['aereo_modificado_em'] = $this->aereo_modificado_em;
      $this->Before_unformat['aereo_modificado_em_hora'] = $this->aereo_modificado_em_hora;
      nm_limpa_data($this->aereo_modificado_em, $this->field_config['aereo_modificado_em']['date_sep']) ; 
      nm_limpa_hora($this->aereo_modificado_em_hora, $this->field_config['aereo_modificado_em']['time_sep']) ; 
      $this->Before_unformat['aereo_flag_subtraido'] = $this->aereo_flag_subtraido;
      nm_limpa_numero($this->aereo_flag_subtraido, $this->field_config['aereo_flag_subtraido']['symbol_grp']) ; 
      $this->Before_unformat['aereo_trecho'] = $this->aereo_trecho;
      nm_limpa_numero($this->aereo_trecho, $this->field_config['aereo_trecho']['symbol_grp']) ; 
      $this->Before_unformat['id_origem_gate'] = $this->id_origem_gate;
      nm_limpa_numero($this->id_origem_gate, $this->field_config['id_origem_gate']['symbol_grp']) ; 
      $this->Before_unformat['data_nota_gate'] = $this->data_nota_gate;
      nm_limpa_data($this->data_nota_gate, $this->field_config['data_nota_gate']['date_sep']) ; 
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
      if ($Nome_Campo == "id_aereo")
      {
          nm_limpa_numero($this->id_aereo, $this->field_config['id_aereo']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "aereo_id_evento")
      {
          nm_limpa_numero($this->aereo_id_evento, $this->field_config['aereo_id_evento']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "aereo_id_usuario")
      {
          nm_limpa_numero($this->aereo_id_usuario, $this->field_config['aereo_id_usuario']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "aereo_cia_aerea")
      {
          nm_limpa_numero($this->aereo_cia_aerea, $this->field_config['aereo_cia_aerea']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "aereo_valor")
      {
          if (!empty($this->field_config['aereo_valor']['symbol_dec']))
          {
             $this->sc_remove_currency($this->aereo_valor, $this->field_config['aereo_valor']['symbol_dec'], $this->field_config['aereo_valor']['symbol_grp'], $this->field_config['aereo_valor']['symbol_mon']);
             nm_limpa_valor($this->aereo_valor, $this->field_config['aereo_valor']['symbol_dec'], $this->field_config['aereo_valor']['symbol_grp']);
          }
      }
      if ($Nome_Campo == "aereo_bloqueio_id")
      {
          nm_limpa_numero($this->aereo_bloqueio_id, $this->field_config['aereo_bloqueio_id']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "aereo_flag_subtraido")
      {
          nm_limpa_numero($this->aereo_flag_subtraido, $this->field_config['aereo_flag_subtraido']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "aereo_trecho")
      {
          nm_limpa_numero($this->aereo_trecho, $this->field_config['aereo_trecho']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "id_origem_gate")
      {
          nm_limpa_numero($this->id_origem_gate, $this->field_config['id_origem_gate']['symbol_grp']) ; 
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
      if ('' !== $this->id_aereo || (!empty($format_fields) && isset($format_fields['id_aereo'])))
      {
          nmgp_Form_Num_Val($this->id_aereo, $this->field_config['id_aereo']['symbol_grp'], $this->field_config['id_aereo']['symbol_dec'], "0", "S", $this->field_config['id_aereo']['format_neg'], "", "", "-", $this->field_config['id_aereo']['symbol_fmt']) ; 
      }
      if ('' !== $this->aereo_id_evento || (!empty($format_fields) && isset($format_fields['aereo_id_evento'])))
      {
          nmgp_Form_Num_Val($this->aereo_id_evento, $this->field_config['aereo_id_evento']['symbol_grp'], $this->field_config['aereo_id_evento']['symbol_dec'], "0", "S", $this->field_config['aereo_id_evento']['format_neg'], "", "", "-", $this->field_config['aereo_id_evento']['symbol_fmt']) ; 
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
          $this->ajax_return_values_id_aereo();
          $this->ajax_return_values_aereo_id_evento();
          $this->ajax_return_values_part_copy();
          $this->ajax_return_values_acomp_copy();
          $this->ajax_return_values_cpf_del();
          $this->ajax_return_values_sql_log();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
              $this->NM_ajax_info['fldList']['id_aereo']['keyVal'] = form_aereos_rsvp_ctrecho_mob_pack_protect_string($this->nmgp_dados_form['id_aereo']);
          }
   } // ajax_return_values

          //----- id_aereo
   function ajax_return_values_id_aereo($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("id_aereo", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->id_aereo);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['id_aereo'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("id_aereo", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- aereo_id_evento
   function ajax_return_values_aereo_id_evento($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("aereo_id_evento", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->aereo_id_evento);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['aereo_id_evento'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- part_copy
   function ajax_return_values_part_copy($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("part_copy", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->part_copy);
              $aLookup = array();
              $this->_tmp_lookup_part_copy = $this->part_copy;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_part_copy']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_part_copy'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_part_copy']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_part_copy'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_id_aereo = $this->id_aereo;
   $old_value_aereo_id_evento = $this->aereo_id_evento;
   $this->nm_tira_formatacao();


   $unformatted_value_id_aereo = $this->id_aereo;
   $unformatted_value_aereo_id_evento = $this->aereo_id_evento;

   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   {
       $nm_comando = "SELECT nome_pessoa + '  CPF:  ' + part_cpf, nome_pessoa FROM participantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf <> '" . $_SESSION['vg_cpf'] . "' ORDER BY nome_pessoa";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   {
       $nm_comando = "SELECT concat(nome_pessoa,'  CPF:  ',part_cpf), nome_pessoa FROM participantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf <> '" . $_SESSION['vg_cpf'] . "' ORDER BY nome_pessoa";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
   {
       $nm_comando = "SELECT nome_pessoa&'  CPF:  '&part_cpf, nome_pessoa FROM participantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf <> '" . $_SESSION['vg_cpf'] . "' ORDER BY nome_pessoa";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
   {
       $nm_comando = "SELECT nome_pessoa||'  CPF:  '||part_cpf, nome_pessoa FROM participantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf <> '" . $_SESSION['vg_cpf'] . "' ORDER BY nome_pessoa";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   {
       $nm_comando = "SELECT nome_pessoa + '  CPF:  ' + part_cpf, nome_pessoa FROM participantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf <> '" . $_SESSION['vg_cpf'] . "' ORDER BY nome_pessoa";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
   {
       $nm_comando = "SELECT nome_pessoa||'  CPF:  '||part_cpf, nome_pessoa FROM participantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf <> '" . $_SESSION['vg_cpf'] . "' ORDER BY nome_pessoa";
   }
   else
   {
       $nm_comando = "SELECT nome_pessoa||'  CPF:  '||part_cpf, nome_pessoa FROM participantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf <> '" . $_SESSION['vg_cpf'] . "' ORDER BY nome_pessoa";
   }

   $this->id_aereo = $old_value_id_aereo;
   $this->aereo_id_evento = $old_value_aereo_id_evento;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $aLookup[] = array(form_aereos_rsvp_ctrecho_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', form_aereos_rsvp_ctrecho_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_part_copy'][] = $rs->fields[0];
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
          $this->NM_ajax_info['fldList']['part_copy'] = array(
                       'row'    => '',
               'type'    => 'duplosel',
               'valList' => explode(';', $sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['part_copy']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['part_copy']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['part_copy']['labList'] = $aLabel;
          }
   }

          //----- acomp_copy
   function ajax_return_values_acomp_copy($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("acomp_copy", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->acomp_copy);
              $aLookup = array();
              $this->_tmp_lookup_acomp_copy = $this->acomp_copy;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_acomp_copy']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_acomp_copy'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_acomp_copy']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_acomp_copy'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_id_aereo = $this->id_aereo;
   $old_value_aereo_id_evento = $this->aereo_id_evento;
   $this->nm_tira_formatacao();


   $unformatted_value_id_aereo = $this->id_aereo;
   $unformatted_value_aereo_id_evento = $this->aereo_id_evento;

   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   {
       $nm_comando = "SELECT part_nome + '  CPF:  ' + part_cpf, part_nome FROM acompanhantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf_mestre = '" . $_SESSION['vg_cpf'] . "' ORDER BY part_nome";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   {
       $nm_comando = "SELECT concat(part_nome,'  CPF:  ',part_cpf), part_nome FROM acompanhantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf_mestre = '" . $_SESSION['vg_cpf'] . "' ORDER BY part_nome";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
   {
       $nm_comando = "SELECT part_nome&'  CPF:  '&part_cpf, part_nome FROM acompanhantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf_mestre = '" . $_SESSION['vg_cpf'] . "' ORDER BY part_nome";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
   {
       $nm_comando = "SELECT part_nome||'  CPF:  '||part_cpf, part_nome FROM acompanhantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf_mestre = '" . $_SESSION['vg_cpf'] . "' ORDER BY part_nome";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   {
       $nm_comando = "SELECT part_nome + '  CPF:  ' + part_cpf, part_nome FROM acompanhantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf_mestre = '" . $_SESSION['vg_cpf'] . "' ORDER BY part_nome";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
   {
       $nm_comando = "SELECT part_nome||'  CPF:  '||part_cpf, part_nome FROM acompanhantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf_mestre = '" . $_SESSION['vg_cpf'] . "' ORDER BY part_nome";
   }
   else
   {
       $nm_comando = "SELECT part_nome||'  CPF:  '||part_cpf, part_nome FROM acompanhantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf_mestre = '" . $_SESSION['vg_cpf'] . "' ORDER BY part_nome";
   }

   $this->id_aereo = $old_value_id_aereo;
   $this->aereo_id_evento = $old_value_aereo_id_evento;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $aLookup[] = array(form_aereos_rsvp_ctrecho_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', form_aereos_rsvp_ctrecho_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_acomp_copy'][] = $rs->fields[0];
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
          $this->NM_ajax_info['fldList']['acomp_copy'] = array(
                       'row'    => '',
               'type'    => 'duplosel',
               'valList' => explode(';', $sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['acomp_copy']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['acomp_copy']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['acomp_copy']['labList'] = $aLabel;
          }
   }

          //----- cpf_del
   function ajax_return_values_cpf_del($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("cpf_del", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->cpf_del);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['cpf_del'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- sql_log
   function ajax_return_values_sql_log($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("sql_log", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->sql_log);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['sql_log'] = array(
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['upload_dir'][$fieldName][] = $newName;
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Field_no_validate'] = array();
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
      $this->aereo_valor = str_replace($sc_parm1, $sc_parm2, $this->aereo_valor); 
   } 
   function nm_poe_aspas_decimal() 
   { 
      $this->aereo_valor = "'" . $this->aereo_valor . "'";
   } 
   function nm_tira_aspas_decimal() 
   { 
      $this->aereo_valor = str_replace("'", "", $this->aereo_valor); 
   } 
//----------- 

   function controle_navegacao()
   {
      global $sc_where;

          if (false && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['total']))
          {
               $sc_where_pos = " WHERE ((id_aereo < $this->id_aereo))";
               if ('' != $sc_where)
               {
                   if ('where ' == strtolower(substr(trim($sc_where), 0, 6)))
                   {
                       $sc_where = substr(trim($sc_where), 6);
                   }
                   if ('and ' == strtolower(substr(trim($sc_where), 0, 4)))
                   {
                       $sc_where = substr(trim($sc_where), 4);
                   }
                   $sc_where_pos .= ' AND (' . $sc_where . ')';
                   $sc_where = ' WHERE ' . $sc_where;
               }
               $nmgp_sel_count = 'SELECT COUNT(*) AS countTest FROM ' . $this->Ini->nm_tabela . $sc_where;
               $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count; 
               $rsc = $this->Db->Execute($nmgp_sel_count); 
               if ($rsc === false && !$rsc->EOF)  
               { 
                   $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                   exit; 
               }  
               $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['total'] = $rsc->fields[0];
               $rsc->Close(); 
               if ('' != $this->id_aereo)
               {
               $nmgp_sel_count = 'SELECT COUNT(*) AS countTest FROM ' . $this->Ini->nm_tabela . $sc_where_pos;
               $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_sel_count; 
               $rsc = $this->Db->Execute($nmgp_sel_count); 
               if ($rsc === false && !$rsc->EOF)  
               { 
                   $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
                   exit; 
               }  
               $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['inicio'] = $rsc->fields[0];
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['inicio'] < 0)
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['inicio'] = 0;
               }
               $rsc->Close(); 
               }
               else
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['inicio'] = 0;
               }
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['qt_reg_grid'] = 1;
          if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['inicio']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['inicio'] = 0;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['final']  = 0;
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['opcao'] = $this->NM_ajax_info['param']['nmgp_opcao'];
          if (in_array($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['opcao'], array('incluir', 'alterar', 'excluir')))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['opcao'] = '';
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['opcao'] == 'inicio')
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['inicio'] = 0;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['opcao'] == 'retorna')
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['qt_reg_grid'];
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['inicio'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['inicio'] = 0 ;
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['opcao'] == 'avanca' && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['total']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['total'] > $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['final']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['final'];
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['opcao'] == 'final')
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['total'] - $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['qt_reg_grid'];
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['inicio'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['inicio'] = 0;
              }
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['final'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['inicio'] + $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['qt_reg_grid'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['final'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['opcao'] = '';

   }

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
      $NM_val_form['id_aereo'] = $this->id_aereo;
      $NM_val_form['aereo_id_evento'] = $this->aereo_id_evento;
      $NM_val_form['part_copy'] = $this->part_copy;
      $NM_val_form['acomp_copy'] = $this->acomp_copy;
      $NM_val_form['cpf_del'] = $this->cpf_del;
      $NM_val_form['sql_log'] = $this->sql_log;
      $NM_val_form['aereo_id_usuario'] = $this->aereo_id_usuario;
      $NM_val_form['aereo_cpf_particip'] = $this->aereo_cpf_particip;
      $NM_val_form['aereo_tipo_pessoa'] = $this->aereo_tipo_pessoa;
      $NM_val_form['aereo_status'] = $this->aereo_status;
      $NM_val_form['aereo_direcao'] = $this->aereo_direcao;
      $NM_val_form['aereo_cia_aerea'] = $this->aereo_cia_aerea;
      $NM_val_form['aereo_num_voo'] = $this->aereo_num_voo;
      $NM_val_form['aereo_origem'] = $this->aereo_origem;
      $NM_val_form['aereo_destino'] = $this->aereo_destino;
      $NM_val_form['aereo_dt_saida'] = $this->aereo_dt_saida;
      $NM_val_form['aereo_hr_saida'] = $this->aereo_hr_saida;
      $NM_val_form['aereo_dthr_saida'] = $this->aereo_dthr_saida;
      $NM_val_form['aereo_dt_chegada'] = $this->aereo_dt_chegada;
      $NM_val_form['aereo_hr_chegada'] = $this->aereo_hr_chegada;
      $NM_val_form['aereo_dthr_chegada'] = $this->aereo_dthr_chegada;
      $NM_val_form['aereo_localizador'] = $this->aereo_localizador;
      $NM_val_form['aereo_eticket'] = $this->aereo_eticket;
      $NM_val_form['aereo_emitida_bvt'] = $this->aereo_emitida_bvt;
      $NM_val_form['aereo_valor'] = $this->aereo_valor;
      $NM_val_form['aereo_bloqueio_id'] = $this->aereo_bloqueio_id;
      $NM_val_form['aereo_modificado_em'] = $this->aereo_modificado_em;
      $NM_val_form['aereo_flag_subtraido'] = $this->aereo_flag_subtraido;
      $NM_val_form['aereo_trecho'] = $this->aereo_trecho;
      $NM_val_form['aereo_ativo'] = $this->aereo_ativo;
      $NM_val_form['id_origem_gate'] = $this->id_origem_gate;
      $NM_val_form['nome_pax_gate'] = $this->nome_pax_gate;
      $NM_val_form['nota_gate'] = $this->nota_gate;
      $NM_val_form['data_nota_gate'] = $this->data_nota_gate;
      $NM_val_form['fil_agt_gate'] = $this->fil_agt_gate;
      $NM_val_form['aereo_cia_aerea_gate'] = $this->aereo_cia_aerea_gate;
      $NM_val_form['aereo_transfer_tipo'] = $this->aereo_transfer_tipo;
      if ($this->id_aereo === "" || is_null($this->id_aereo))  
      { 
          $this->id_aereo = 0;
      } 
      if ($this->aereo_id_evento === "" || is_null($this->aereo_id_evento))  
      { 
          $this->aereo_id_evento = 0;
          $this->sc_force_zero[] = 'aereo_id_evento';
      } 
      if ($this->aereo_id_usuario === "" || is_null($this->aereo_id_usuario))  
      { 
          $this->aereo_id_usuario = 0;
          $this->sc_force_zero[] = 'aereo_id_usuario';
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
      if ($this->aereo_cia_aerea === "" || is_null($this->aereo_cia_aerea))  
      { 
          $this->aereo_cia_aerea = 0;
          $this->sc_force_zero[] = 'aereo_cia_aerea';
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
      if ($this->aereo_valor === "" || is_null($this->aereo_valor))  
      { 
          $this->aereo_valor = 0;
          $this->sc_force_zero[] = 'aereo_valor';
      } 
      }
      if ($this->aereo_bloqueio_id === "" || is_null($this->aereo_bloqueio_id))  
      { 
          $this->aereo_bloqueio_id = 0;
          $this->sc_force_zero[] = 'aereo_bloqueio_id';
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->aereo_flag_subtraido === "" || is_null($this->aereo_flag_subtraido))  
      { 
          $this->aereo_flag_subtraido = 0;
          $this->sc_force_zero[] = 'aereo_flag_subtraido';
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      if ($this->aereo_trecho === "" || is_null($this->aereo_trecho))  
      { 
          $this->aereo_trecho = 0;
          $this->sc_force_zero[] = 'aereo_trecho';
      } 
      }
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->id_origem_gate === "" || is_null($this->id_origem_gate))  
      { 
          $this->id_origem_gate = 0;
          $this->sc_force_zero[] = 'id_origem_gate';
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      }
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_oracle, $this->Ini->nm_bases_ibase, $this->Ini->nm_bases_informix, $this->Ini->nm_bases_mysql, $this->Ini->nm_bases_access, $this->Ini->nm_bases_sqlite, $this->Ini->nm_bases_db2, array('pdo_sqlsrv'));
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['decimal_db'] == ",") 
      {
          $this->nm_troca_decimal(".", ",");
      }
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          $this->aereo_cpf_particip_before_qstr = $this->aereo_cpf_particip;
          $this->aereo_cpf_particip = substr($this->Db->qstr($this->aereo_cpf_particip), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->aereo_cpf_particip = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->aereo_cpf_particip);
          }
          if ($this->aereo_cpf_particip == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->aereo_cpf_particip = "null"; 
              $this->NM_val_null[] = "aereo_cpf_particip";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->aereo_tipo_pessoa == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->aereo_tipo_pessoa = "null"; 
                  $this->NM_val_null[] = "aereo_tipo_pessoa";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->aereo_status == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->aereo_status = "null"; 
                  $this->NM_val_null[] = "aereo_status";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->aereo_direcao == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->aereo_direcao = "null"; 
                  $this->NM_val_null[] = "aereo_direcao";
              } 
          }
          $this->aereo_num_voo_before_qstr = $this->aereo_num_voo;
          $this->aereo_num_voo = substr($this->Db->qstr($this->aereo_num_voo), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->aereo_num_voo = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->aereo_num_voo);
          }
          if ($this->aereo_num_voo == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->aereo_num_voo = "null"; 
              $this->NM_val_null[] = "aereo_num_voo";
          } 
          $this->aereo_origem_before_qstr = $this->aereo_origem;
          $this->aereo_origem = substr($this->Db->qstr($this->aereo_origem), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->aereo_origem = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->aereo_origem);
          }
          if ($this->aereo_origem == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->aereo_origem = "null"; 
              $this->NM_val_null[] = "aereo_origem";
          } 
          $this->aereo_destino_before_qstr = $this->aereo_destino;
          $this->aereo_destino = substr($this->Db->qstr($this->aereo_destino), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->aereo_destino = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->aereo_destino);
          }
          if ($this->aereo_destino == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->aereo_destino = "null"; 
              $this->NM_val_null[] = "aereo_destino";
          } 
          if ($this->aereo_dt_saida == "")  
          { 
              $this->aereo_dt_saida = "null"; 
              $this->NM_val_null[] = "aereo_dt_saida";
          } 
          if ($this->aereo_hr_saida == "")  
          { 
              $this->aereo_hr_saida = "null"; 
              $this->NM_val_null[] = "aereo_hr_saida";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->aereo_dthr_saida == "")  
              { 
                  $this->aereo_dthr_saida = "null"; 
                  $this->NM_val_null[] = "aereo_dthr_saida";
              } 
              if ($this->aereo_dthr_saida == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->aereo_dthr_saida = "null"; 
                  $this->NM_val_null[] = "aereo_dthr_saida";
              } 
          }
          if ($this->aereo_dt_chegada == "")  
          { 
              $this->aereo_dt_chegada = "null"; 
              $this->NM_val_null[] = "aereo_dt_chegada";
          } 
          if ($this->aereo_hr_chegada == "")  
          { 
              $this->aereo_hr_chegada = "null"; 
              $this->NM_val_null[] = "aereo_hr_chegada";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->aereo_dthr_chegada == "")  
              { 
                  $this->aereo_dthr_chegada = "null"; 
                  $this->NM_val_null[] = "aereo_dthr_chegada";
              } 
              if ($this->aereo_dthr_chegada == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->aereo_dthr_chegada = "null"; 
                  $this->NM_val_null[] = "aereo_dthr_chegada";
              } 
          }
          $this->aereo_localizador_before_qstr = $this->aereo_localizador;
          $this->aereo_localizador = substr($this->Db->qstr($this->aereo_localizador), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->aereo_localizador = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->aereo_localizador);
          }
          if ($this->aereo_localizador == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->aereo_localizador = "null"; 
              $this->NM_val_null[] = "aereo_localizador";
          } 
          $this->aereo_eticket_before_qstr = $this->aereo_eticket;
          $this->aereo_eticket = substr($this->Db->qstr($this->aereo_eticket), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->aereo_eticket = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->aereo_eticket);
          }
          if ($this->aereo_eticket == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->aereo_eticket = "null"; 
              $this->NM_val_null[] = "aereo_eticket";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->aereo_emitida_bvt == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->aereo_emitida_bvt = "null"; 
                  $this->NM_val_null[] = "aereo_emitida_bvt";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->aereo_modificado_em == "")  
              { 
                  $this->aereo_modificado_em = "null"; 
                  $this->NM_val_null[] = "aereo_modificado_em";
              } 
              if ($this->aereo_modificado_em == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->aereo_modificado_em = "null"; 
                  $this->NM_val_null[] = "aereo_modificado_em";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->aereo_ativo == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->aereo_ativo = "null"; 
                  $this->NM_val_null[] = "aereo_ativo";
              } 
          }
          $this->nome_pax_gate_before_qstr = $this->nome_pax_gate;
          $this->nome_pax_gate = substr($this->Db->qstr($this->nome_pax_gate), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->nome_pax_gate = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->nome_pax_gate);
          }
          if ($this->nome_pax_gate == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->nome_pax_gate = "null"; 
              $this->NM_val_null[] = "nome_pax_gate";
          } 
          $this->nota_gate_before_qstr = $this->nota_gate;
          $this->nota_gate = substr($this->Db->qstr($this->nota_gate), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->nota_gate = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->nota_gate);
          }
          if ($this->nota_gate == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->nota_gate = "null"; 
              $this->NM_val_null[] = "nota_gate";
          } 
          if ($this->data_nota_gate == "")  
          { 
              $this->data_nota_gate = "null"; 
              $this->NM_val_null[] = "data_nota_gate";
          } 
          $this->fil_agt_gate_before_qstr = $this->fil_agt_gate;
          $this->fil_agt_gate = substr($this->Db->qstr($this->fil_agt_gate), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->fil_agt_gate = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->fil_agt_gate);
          }
          if ($this->fil_agt_gate == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->fil_agt_gate = "null"; 
              $this->NM_val_null[] = "fil_agt_gate";
          } 
          $this->aereo_cia_aerea_gate_before_qstr = $this->aereo_cia_aerea_gate;
          $this->aereo_cia_aerea_gate = substr($this->Db->qstr($this->aereo_cia_aerea_gate), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->aereo_cia_aerea_gate = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->aereo_cia_aerea_gate);
          }
          if ($this->aereo_cia_aerea_gate == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->aereo_cia_aerea_gate = "null"; 
              $this->NM_val_null[] = "aereo_cia_aerea_gate";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->aereo_transfer_tipo == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->aereo_transfer_tipo = "null"; 
                  $this->NM_val_null[] = "aereo_transfer_tipo";
              } 
          }
      }
      if ($this->nmgp_opcao == "alterar") 
      {
          $SC_fields_update = array(); 
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
                  $SC_fields_update[] = "aereo_id_evento = $this->aereo_id_evento"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "aereo_id_evento = $this->aereo_id_evento"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "aereo_id_evento = $this->aereo_id_evento"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "aereo_id_evento = $this->aereo_id_evento"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "aereo_id_evento = $this->aereo_id_evento"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "aereo_id_evento = $this->aereo_id_evento"; 
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "aereo_id_evento = $this->aereo_id_evento"; 
              } 
              $Prep_Tst = (isset($NM_val_form['aereo_id_usuario']) && $NM_val_form['aereo_id_usuario'] == "null"  && $this->nmgp_dados_select['aereo_id_usuario'] == "") ? "null" : $this->nmgp_dados_select['aereo_id_usuario'];
              if (isset($NM_val_form['aereo_id_usuario']) && $NM_val_form['aereo_id_usuario'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "aereo_id_usuario = $this->aereo_id_usuario"; 
              } 
              $Prep_Tst = (isset($NM_val_form['aereo_cpf_particip']) && $NM_val_form['aereo_cpf_particip'] == "null"  && $this->nmgp_dados_select['aereo_cpf_particip'] == "") ? "null" : $this->nmgp_dados_select['aereo_cpf_particip'];
              if (isset($NM_val_form['aereo_cpf_particip']) && $NM_val_form['aereo_cpf_particip'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "aereo_cpf_particip = '$this->aereo_cpf_particip'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['aereo_tipo_pessoa']) && $NM_val_form['aereo_tipo_pessoa'] == "null"  && $this->nmgp_dados_select['aereo_tipo_pessoa'] == "") ? "null" : $this->nmgp_dados_select['aereo_tipo_pessoa'];
              if (isset($NM_val_form['aereo_tipo_pessoa']) && $NM_val_form['aereo_tipo_pessoa'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "aereo_tipo_pessoa = '$this->aereo_tipo_pessoa'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['aereo_status']) && $NM_val_form['aereo_status'] == "null"  && $this->nmgp_dados_select['aereo_status'] == "") ? "null" : $this->nmgp_dados_select['aereo_status'];
              if (isset($NM_val_form['aereo_status']) && $NM_val_form['aereo_status'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "aereo_status = '$this->aereo_status'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['aereo_direcao']) && $NM_val_form['aereo_direcao'] == "null"  && $this->nmgp_dados_select['aereo_direcao'] == "") ? "null" : $this->nmgp_dados_select['aereo_direcao'];
              if (isset($NM_val_form['aereo_direcao']) && $NM_val_form['aereo_direcao'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "aereo_direcao = '$this->aereo_direcao'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['aereo_cia_aerea']) && $NM_val_form['aereo_cia_aerea'] == "null"  && $this->nmgp_dados_select['aereo_cia_aerea'] == "") ? "null" : $this->nmgp_dados_select['aereo_cia_aerea'];
              if (isset($NM_val_form['aereo_cia_aerea']) && $NM_val_form['aereo_cia_aerea'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "aereo_cia_aerea = $this->aereo_cia_aerea"; 
              } 
              $Prep_Tst = (isset($NM_val_form['aereo_num_voo']) && $NM_val_form['aereo_num_voo'] == "null"  && $this->nmgp_dados_select['aereo_num_voo'] == "") ? "null" : $this->nmgp_dados_select['aereo_num_voo'];
              if (isset($NM_val_form['aereo_num_voo']) && $NM_val_form['aereo_num_voo'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "aereo_num_voo = '$this->aereo_num_voo'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['aereo_origem']) && $NM_val_form['aereo_origem'] == "null"  && $this->nmgp_dados_select['aereo_origem'] == "") ? "null" : $this->nmgp_dados_select['aereo_origem'];
              if (isset($NM_val_form['aereo_origem']) && $NM_val_form['aereo_origem'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "aereo_origem = '$this->aereo_origem'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['aereo_destino']) && $NM_val_form['aereo_destino'] == "null"  && $this->nmgp_dados_select['aereo_destino'] == "") ? "null" : $this->nmgp_dados_select['aereo_destino'];
              if (isset($NM_val_form['aereo_destino']) && $NM_val_form['aereo_destino'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "aereo_destino = '$this->aereo_destino'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['aereo_dt_saida']) && $NM_val_form['aereo_dt_saida'] == "null"  && $this->nmgp_dados_select['aereo_dt_saida'] == "") ? "null" : $this->nmgp_dados_select['aereo_dt_saida'];
              if (isset($NM_val_form['aereo_dt_saida']) && $NM_val_form['aereo_dt_saida'] != $Prep_Tst) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "aereo_dt_saida = #$this->aereo_dt_saida#"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  { 
                      $SC_fields_update[] = "aereo_dt_saida = EXTEND('" . $this->aereo_dt_saida . "', YEAR TO DAY)"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "aereo_dt_saida = " . $this->Ini->date_delim . $this->aereo_dt_saida . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['aereo_hr_saida']) && $NM_val_form['aereo_hr_saida'] == "null"  && $this->nmgp_dados_select['aereo_hr_saida'] == "") ? "null" : $this->nmgp_dados_select['aereo_hr_saida'];
              if (isset($NM_val_form['aereo_hr_saida']) && $NM_val_form['aereo_hr_saida'] != $Prep_Tst) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "aereo_hr_saida = #$this->aereo_hr_saida#"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "aereo_hr_saida = " . $this->Ini->date_delim . $this->aereo_hr_saida . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['aereo_dthr_saida']) && $NM_val_form['aereo_dthr_saida'] == "null"  && $this->nmgp_dados_select['aereo_dthr_saida'] == "") ? "null" : $this->nmgp_dados_select['aereo_dthr_saida'];
              if (isset($NM_val_form['aereo_dthr_saida']) && $NM_val_form['aereo_dthr_saida'] != $Prep_Tst) 
              { 
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                  { 
                      $SC_fields_update[] = "aereo_dthr_saida = TO_DATE('$this->aereo_dthr_saida', 'yyyy-mm-dd hh24:mi:ss')"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "aereo_dthr_saida = '$this->aereo_dthr_saida'"; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['aereo_dt_chegada']) && $NM_val_form['aereo_dt_chegada'] == "null"  && $this->nmgp_dados_select['aereo_dt_chegada'] == "") ? "null" : $this->nmgp_dados_select['aereo_dt_chegada'];
              if (isset($NM_val_form['aereo_dt_chegada']) && $NM_val_form['aereo_dt_chegada'] != $Prep_Tst) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "aereo_dt_chegada = #$this->aereo_dt_chegada#"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  { 
                      $SC_fields_update[] = "aereo_dt_chegada = EXTEND('" . $this->aereo_dt_chegada . "', YEAR TO DAY)"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "aereo_dt_chegada = " . $this->Ini->date_delim . $this->aereo_dt_chegada . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['aereo_hr_chegada']) && $NM_val_form['aereo_hr_chegada'] == "null"  && $this->nmgp_dados_select['aereo_hr_chegada'] == "") ? "null" : $this->nmgp_dados_select['aereo_hr_chegada'];
              if (isset($NM_val_form['aereo_hr_chegada']) && $NM_val_form['aereo_hr_chegada'] != $Prep_Tst) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "aereo_hr_chegada = #$this->aereo_hr_chegada#"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "aereo_hr_chegada = " . $this->Ini->date_delim . $this->aereo_hr_chegada . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['aereo_dthr_chegada']) && $NM_val_form['aereo_dthr_chegada'] == "null"  && $this->nmgp_dados_select['aereo_dthr_chegada'] == "") ? "null" : $this->nmgp_dados_select['aereo_dthr_chegada'];
              if (isset($NM_val_form['aereo_dthr_chegada']) && $NM_val_form['aereo_dthr_chegada'] != $Prep_Tst) 
              { 
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                  { 
                      $SC_fields_update[] = "aereo_dthr_chegada = TO_DATE('$this->aereo_dthr_chegada', 'yyyy-mm-dd hh24:mi:ss')"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "aereo_dthr_chegada = '$this->aereo_dthr_chegada'"; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['aereo_localizador']) && $NM_val_form['aereo_localizador'] == "null"  && $this->nmgp_dados_select['aereo_localizador'] == "") ? "null" : $this->nmgp_dados_select['aereo_localizador'];
              if (isset($NM_val_form['aereo_localizador']) && $NM_val_form['aereo_localizador'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "aereo_localizador = '$this->aereo_localizador'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['aereo_eticket']) && $NM_val_form['aereo_eticket'] == "null"  && $this->nmgp_dados_select['aereo_eticket'] == "") ? "null" : $this->nmgp_dados_select['aereo_eticket'];
              if (isset($NM_val_form['aereo_eticket']) && $NM_val_form['aereo_eticket'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "aereo_eticket = '$this->aereo_eticket'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['aereo_emitida_bvt']) && $NM_val_form['aereo_emitida_bvt'] == "null"  && $this->nmgp_dados_select['aereo_emitida_bvt'] == "") ? "null" : $this->nmgp_dados_select['aereo_emitida_bvt'];
              if (isset($NM_val_form['aereo_emitida_bvt']) && $NM_val_form['aereo_emitida_bvt'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "aereo_emitida_bvt = '$this->aereo_emitida_bvt'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['aereo_valor']) && $NM_val_form['aereo_valor'] == "null"  && $this->nmgp_dados_select['aereo_valor'] == "") ? "null" : $this->nmgp_dados_select['aereo_valor'];
              if (isset($NM_val_form['aereo_valor']) && $NM_val_form['aereo_valor'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "aereo_valor = $this->aereo_valor"; 
              } 
              $Prep_Tst = (isset($NM_val_form['aereo_bloqueio_id']) && $NM_val_form['aereo_bloqueio_id'] == "null"  && $this->nmgp_dados_select['aereo_bloqueio_id'] == "") ? "null" : $this->nmgp_dados_select['aereo_bloqueio_id'];
              if (isset($NM_val_form['aereo_bloqueio_id']) && $NM_val_form['aereo_bloqueio_id'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "aereo_bloqueio_id = $this->aereo_bloqueio_id"; 
              } 
              $Prep_Tst = (isset($NM_val_form['aereo_modificado_em']) && $NM_val_form['aereo_modificado_em'] == "null"  && $this->nmgp_dados_select['aereo_modificado_em'] == "") ? "null" : $this->nmgp_dados_select['aereo_modificado_em'];
              if (isset($NM_val_form['aereo_modificado_em']) && $NM_val_form['aereo_modificado_em'] != $Prep_Tst) 
              { 
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                  { 
                      $SC_fields_update[] = "aereo_modificado_em = TO_DATE('$this->aereo_modificado_em', 'yyyy-mm-dd hh24:mi:ss')"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "aereo_modificado_em = '$this->aereo_modificado_em'"; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['aereo_flag_subtraido']) && $NM_val_form['aereo_flag_subtraido'] == "null"  && $this->nmgp_dados_select['aereo_flag_subtraido'] == "") ? "null" : $this->nmgp_dados_select['aereo_flag_subtraido'];
              if (isset($NM_val_form['aereo_flag_subtraido']) && $NM_val_form['aereo_flag_subtraido'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "aereo_flag_subtraido = $this->aereo_flag_subtraido"; 
              } 
              $Prep_Tst = (isset($NM_val_form['aereo_trecho']) && $NM_val_form['aereo_trecho'] == "null"  && $this->nmgp_dados_select['aereo_trecho'] == "") ? "null" : $this->nmgp_dados_select['aereo_trecho'];
              if (isset($NM_val_form['aereo_trecho']) && $NM_val_form['aereo_trecho'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "aereo_trecho = $this->aereo_trecho"; 
              } 
              $Prep_Tst = (isset($NM_val_form['aereo_ativo']) && $NM_val_form['aereo_ativo'] == "null"  && $this->nmgp_dados_select['aereo_ativo'] == "") ? "null" : $this->nmgp_dados_select['aereo_ativo'];
              if (isset($NM_val_form['aereo_ativo']) && $NM_val_form['aereo_ativo'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "aereo_ativo = '$this->aereo_ativo'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['id_origem_gate']) && $NM_val_form['id_origem_gate'] == "null"  && $this->nmgp_dados_select['id_origem_gate'] == "") ? "null" : $this->nmgp_dados_select['id_origem_gate'];
              if (isset($NM_val_form['id_origem_gate']) && $NM_val_form['id_origem_gate'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "id_origem_gate = $this->id_origem_gate"; 
              } 
              $Prep_Tst = (isset($NM_val_form['nome_pax_gate']) && $NM_val_form['nome_pax_gate'] == "null"  && $this->nmgp_dados_select['nome_pax_gate'] == "") ? "null" : $this->nmgp_dados_select['nome_pax_gate'];
              if (isset($NM_val_form['nome_pax_gate']) && $NM_val_form['nome_pax_gate'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "nome_pax_gate = '$this->nome_pax_gate'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['nota_gate']) && $NM_val_form['nota_gate'] == "null"  && $this->nmgp_dados_select['nota_gate'] == "") ? "null" : $this->nmgp_dados_select['nota_gate'];
              if (isset($NM_val_form['nota_gate']) && $NM_val_form['nota_gate'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "nota_gate = '$this->nota_gate'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['data_nota_gate']) && $NM_val_form['data_nota_gate'] == "null"  && $this->nmgp_dados_select['data_nota_gate'] == "") ? "null" : $this->nmgp_dados_select['data_nota_gate'];
              if (isset($NM_val_form['data_nota_gate']) && $NM_val_form['data_nota_gate'] != $Prep_Tst) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "data_nota_gate = #$this->data_nota_gate#"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  { 
                      $SC_fields_update[] = "data_nota_gate = EXTEND('" . $this->data_nota_gate . "', YEAR TO DAY)"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "data_nota_gate = " . $this->Ini->date_delim . $this->data_nota_gate . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['fil_agt_gate']) && $NM_val_form['fil_agt_gate'] == "null"  && $this->nmgp_dados_select['fil_agt_gate'] == "") ? "null" : $this->nmgp_dados_select['fil_agt_gate'];
              if (isset($NM_val_form['fil_agt_gate']) && $NM_val_form['fil_agt_gate'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "fil_agt_gate = '$this->fil_agt_gate'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['aereo_cia_aerea_gate']) && $NM_val_form['aereo_cia_aerea_gate'] == "null"  && $this->nmgp_dados_select['aereo_cia_aerea_gate'] == "") ? "null" : $this->nmgp_dados_select['aereo_cia_aerea_gate'];
              if (isset($NM_val_form['aereo_cia_aerea_gate']) && $NM_val_form['aereo_cia_aerea_gate'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "aereo_cia_aerea_gate = '$this->aereo_cia_aerea_gate'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['aereo_transfer_tipo']) && $NM_val_form['aereo_transfer_tipo'] == "null"  && $this->nmgp_dados_select['aereo_transfer_tipo'] == "") ? "null" : $this->nmgp_dados_select['aereo_transfer_tipo'];
              if (isset($NM_val_form['aereo_transfer_tipo']) && $NM_val_form['aereo_transfer_tipo'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "aereo_transfer_tipo = '$this->aereo_transfer_tipo'"; 
              } 
              $comando .= implode(",", $SC_fields_update);  
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $comando .= " WHERE id_aereo = $this->id_aereo ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $comando .= " WHERE id_aereo = $this->id_aereo ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando .= " WHERE id_aereo = $this->id_aereo ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando .= " WHERE id_aereo = $this->id_aereo ";  
              }  
              else  
              {
                  $comando .= " WHERE id_aereo = $this->id_aereo ";  
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
                                  form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
                              }
                              exit;  
                          }   
                      }   
                  }   
              }   
              $this->aereo_cpf_particip = $this->aereo_cpf_particip_before_qstr;
              $this->aereo_num_voo = $this->aereo_num_voo_before_qstr;
              $this->aereo_origem = $this->aereo_origem_before_qstr;
              $this->aereo_destino = $this->aereo_destino_before_qstr;
              $this->aereo_localizador = $this->aereo_localizador_before_qstr;
              $this->aereo_eticket = $this->aereo_eticket_before_qstr;
              $this->nome_pax_gate = $this->nome_pax_gate_before_qstr;
              $this->nota_gate = $this->nota_gate_before_qstr;
              $this->fil_agt_gate = $this->fil_agt_gate_before_qstr;
              $this->aereo_cia_aerea_gate = $this->aereo_cia_aerea_gate_before_qstr;
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

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['db_changed'] = true;
              if ($this->NM_ajax_flag) {
                  $this->NM_ajax_info['clearUpload'] = 'S';
              }


              if     (isset($NM_val_form) && isset($NM_val_form['id_aereo'])) { $this->id_aereo = $NM_val_form['id_aereo']; }
              elseif (isset($this->id_aereo)) { $this->nm_limpa_alfa($this->id_aereo); }
              if     (isset($NM_val_form) && isset($NM_val_form['aereo_id_evento'])) { $this->aereo_id_evento = $NM_val_form['aereo_id_evento']; }
              elseif (isset($this->aereo_id_evento)) { $this->nm_limpa_alfa($this->aereo_id_evento); }

              $this->nm_formatar_campos();
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
              }

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('id_aereo', 'aereo_id_evento', 'part_copy', 'acomp_copy', 'cpf_del', 'sql_log'), $aDoNotUpdate);
              $this->ajax_return_values();
              $this->nmgp_refresh_fields = $aOldRefresh;

              $this->nm_tira_formatacao();
          }  
      }  
      if ($this->nmgp_opcao == "incluir") 
      { 
          $NM_cmp_auto = "";
          $NM_seq_auto = "";
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['foreign_key'] as $sFKName => $sFKValue)
              {
                   if (isset($this->sc_conv_var[$sFKName]))
                   {
                       $sFKName = $this->sc_conv_var[$sFKName];
                   }
                  eval("\$this->" . $sFKName . " = \"" . $sFKValue . "\";");
              }
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['decimal_db'] == ",") 
          {
              $this->nm_poe_aspas_decimal();
          }
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
          { 
              $NM_seq_auto = "NULL, ";
              $NM_cmp_auto = "id_aereo, ";
          } 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(id_aereo) from " . $this->Ini->nm_tabela; 
          $comando = "select max(id_aereo) from " . $this->Ini->nm_tabela; 
          $rs = $this->Db->Execute($comando); 
          if ($rs === false && !$rs->EOF)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
              $this->NM_rollback_db(); 
              if ($this->NM_ajax_flag)
              {
                  form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
              }
              exit; 
          }  
          $this->id_aereo_before_qstr = $this->id_aereo = $rs->fields[0] + 1;
          $rs->Close(); 
          $bInsertOk = true;
          $aInsertOk = array(); 
          $bInsertOk = $bInsertOk && empty($aInsertOk);
          if (!isset($_POST['nmgp_ins_valid']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['insert_validation'] != $_POST['nmgp_ins_valid'])
          {
              $bInsertOk = false;
              $this->Erro->mensagem(__FILE__, __LINE__, 'security', $this->Ini->Nm_lang['lang_errm_inst_vald']);
              if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
              {
                  $this->nmgp_opcao = 'refresh_insert';
                  if ($this->NM_ajax_flag)
                  {
                      form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
                      exit;
                  }
              }
          }
          if ($bInsertOk)
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->aereo_tipo_pessoa != "")
                  { 
                       $compl_insert     .= ", aereo_tipo_pessoa";
                       $compl_insert_val .= ", '$this->aereo_tipo_pessoa'";
                  } 
                  if ($this->aereo_status != "")
                  { 
                       $compl_insert     .= ", aereo_status";
                       $compl_insert_val .= ", '$this->aereo_status'";
                  } 
                  if ($this->aereo_direcao != "")
                  { 
                       $compl_insert     .= ", aereo_direcao";
                       $compl_insert_val .= ", '$this->aereo_direcao'";
                  } 
                  if ($this->aereo_dthr_saida != "")
                  { 
                       $compl_insert     .= ", aereo_dthr_saida";
                       $compl_insert_val .= ", '$this->aereo_dthr_saida'";
                  } 
                  if ($this->aereo_dthr_chegada != "")
                  { 
                       $compl_insert     .= ", aereo_dthr_chegada";
                       $compl_insert_val .= ", '$this->aereo_dthr_chegada'";
                  } 
                  if ($this->aereo_emitida_bvt != "")
                  { 
                       $compl_insert     .= ", aereo_emitida_bvt";
                       $compl_insert_val .= ", '$this->aereo_emitida_bvt'";
                  } 
                  if ($this->aereo_valor != "")
                  { 
                       $compl_insert     .= ", aereo_valor";
                       $compl_insert_val .= ", $this->aereo_valor";
                  } 
                  if ($this->aereo_modificado_em != "")
                  { 
                       $compl_insert     .= ", aereo_modificado_em";
                       $compl_insert_val .= ", '$this->aereo_modificado_em'";
                  } 
                  if ($this->aereo_trecho != "")
                  { 
                       $compl_insert     .= ", aereo_trecho";
                       $compl_insert_val .= ", $this->aereo_trecho";
                  } 
                  if ($this->aereo_ativo != "")
                  { 
                       $compl_insert     .= ", aereo_ativo";
                       $compl_insert_val .= ", '$this->aereo_ativo'";
                  } 
                  if ($this->aereo_transfer_tipo != "")
                  { 
                       $compl_insert     .= ", aereo_transfer_tipo";
                       $compl_insert_val .= ", '$this->aereo_transfer_tipo'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (aereo_id_evento, aereo_id_usuario, aereo_cpf_particip, aereo_cia_aerea, aereo_num_voo, aereo_origem, aereo_destino, aereo_dt_saida, aereo_hr_saida, aereo_dt_chegada, aereo_hr_chegada, aereo_localizador, aereo_eticket, aereo_bloqueio_id, aereo_flag_subtraido, id_origem_gate, nome_pax_gate, nota_gate, data_nota_gate, fil_agt_gate, aereo_cia_aerea_gate $compl_insert) VALUES ($this->aereo_id_evento, $this->aereo_id_usuario, '$this->aereo_cpf_particip', $this->aereo_cia_aerea, '$this->aereo_num_voo', '$this->aereo_origem', '$this->aereo_destino', #$this->aereo_dt_saida#, #$this->aereo_hr_saida#, #$this->aereo_dt_chegada#, #$this->aereo_hr_chegada#, '$this->aereo_localizador', '$this->aereo_eticket', $this->aereo_bloqueio_id, $this->aereo_flag_subtraido, $this->id_origem_gate, '$this->nome_pax_gate', '$this->nota_gate', #$this->data_nota_gate#, '$this->fil_agt_gate', '$this->aereo_cia_aerea_gate' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->aereo_tipo_pessoa != "")
                  { 
                       $compl_insert     .= ", aereo_tipo_pessoa";
                       $compl_insert_val .= ", '$this->aereo_tipo_pessoa'";
                  } 
                  if ($this->aereo_status != "")
                  { 
                       $compl_insert     .= ", aereo_status";
                       $compl_insert_val .= ", '$this->aereo_status'";
                  } 
                  if ($this->aereo_direcao != "")
                  { 
                       $compl_insert     .= ", aereo_direcao";
                       $compl_insert_val .= ", '$this->aereo_direcao'";
                  } 
                  if ($this->aereo_dthr_saida != "")
                  { 
                       $compl_insert     .= ", aereo_dthr_saida";
                       $compl_insert_val .= ", '$this->aereo_dthr_saida'";
                  } 
                  if ($this->aereo_dthr_chegada != "")
                  { 
                       $compl_insert     .= ", aereo_dthr_chegada";
                       $compl_insert_val .= ", '$this->aereo_dthr_chegada'";
                  } 
                  if ($this->aereo_emitida_bvt != "")
                  { 
                       $compl_insert     .= ", aereo_emitida_bvt";
                       $compl_insert_val .= ", '$this->aereo_emitida_bvt'";
                  } 
                  if ($this->aereo_valor != "")
                  { 
                       $compl_insert     .= ", aereo_valor";
                       $compl_insert_val .= ", $this->aereo_valor";
                  } 
                  if ($this->aereo_modificado_em != "")
                  { 
                       $compl_insert     .= ", aereo_modificado_em";
                       $compl_insert_val .= ", '$this->aereo_modificado_em'";
                  } 
                  if ($this->aereo_trecho != "")
                  { 
                       $compl_insert     .= ", aereo_trecho";
                       $compl_insert_val .= ", $this->aereo_trecho";
                  } 
                  if ($this->aereo_ativo != "")
                  { 
                       $compl_insert     .= ", aereo_ativo";
                       $compl_insert_val .= ", '$this->aereo_ativo'";
                  } 
                  if ($this->aereo_transfer_tipo != "")
                  { 
                       $compl_insert     .= ", aereo_transfer_tipo";
                       $compl_insert_val .= ", '$this->aereo_transfer_tipo'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "aereo_id_evento, aereo_id_usuario, aereo_cpf_particip, aereo_cia_aerea, aereo_num_voo, aereo_origem, aereo_destino, aereo_dt_saida, aereo_hr_saida, aereo_dt_chegada, aereo_hr_chegada, aereo_localizador, aereo_eticket, aereo_bloqueio_id, aereo_flag_subtraido, id_origem_gate, nome_pax_gate, nota_gate, data_nota_gate, fil_agt_gate, aereo_cia_aerea_gate $compl_insert) VALUES (" . $NM_seq_auto . "$this->aereo_id_evento, $this->aereo_id_usuario, '$this->aereo_cpf_particip', $this->aereo_cia_aerea, '$this->aereo_num_voo', '$this->aereo_origem', '$this->aereo_destino', " . $this->Ini->date_delim . $this->aereo_dt_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->aereo_hr_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->aereo_dt_chegada . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->aereo_hr_chegada . $this->Ini->date_delim1 . ", '$this->aereo_localizador', '$this->aereo_eticket', $this->aereo_bloqueio_id, $this->aereo_flag_subtraido, $this->id_origem_gate, '$this->nome_pax_gate', '$this->nota_gate', " . $this->Ini->date_delim . $this->data_nota_gate . $this->Ini->date_delim1 . ", '$this->fil_agt_gate', '$this->aereo_cia_aerea_gate' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
              { 
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->aereo_tipo_pessoa != "")
                  { 
                       $compl_insert     .= ", aereo_tipo_pessoa";
                       $compl_insert_val .= ", '$this->aereo_tipo_pessoa'";
                  } 
                  if ($this->aereo_status != "")
                  { 
                       $compl_insert     .= ", aereo_status";
                       $compl_insert_val .= ", '$this->aereo_status'";
                  } 
                  if ($this->aereo_direcao != "")
                  { 
                       $compl_insert     .= ", aereo_direcao";
                       $compl_insert_val .= ", '$this->aereo_direcao'";
                  } 
                  if ($this->aereo_dthr_saida != "")
                  { 
                       $compl_insert     .= ", aereo_dthr_saida";
                       $compl_insert_val .= ", '$this->aereo_dthr_saida'";
                  } 
                  if ($this->aereo_dthr_chegada != "")
                  { 
                       $compl_insert     .= ", aereo_dthr_chegada";
                       $compl_insert_val .= ", '$this->aereo_dthr_chegada'";
                  } 
                  if ($this->aereo_emitida_bvt != "")
                  { 
                       $compl_insert     .= ", aereo_emitida_bvt";
                       $compl_insert_val .= ", '$this->aereo_emitida_bvt'";
                  } 
                  if ($this->aereo_valor != "")
                  { 
                       $compl_insert     .= ", aereo_valor";
                       $compl_insert_val .= ", $this->aereo_valor";
                  } 
                  if ($this->aereo_modificado_em != "")
                  { 
                       $compl_insert     .= ", aereo_modificado_em";
                       $compl_insert_val .= ", '$this->aereo_modificado_em'";
                  } 
                  if ($this->aereo_trecho != "")
                  { 
                       $compl_insert     .= ", aereo_trecho";
                       $compl_insert_val .= ", $this->aereo_trecho";
                  } 
                  if ($this->aereo_ativo != "")
                  { 
                       $compl_insert     .= ", aereo_ativo";
                       $compl_insert_val .= ", '$this->aereo_ativo'";
                  } 
                  if ($this->aereo_transfer_tipo != "")
                  { 
                       $compl_insert     .= ", aereo_transfer_tipo";
                       $compl_insert_val .= ", '$this->aereo_transfer_tipo'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "aereo_id_evento, aereo_id_usuario, aereo_cpf_particip, aereo_cia_aerea, aereo_num_voo, aereo_origem, aereo_destino, aereo_dt_saida, aereo_hr_saida, aereo_dt_chegada, aereo_hr_chegada, aereo_localizador, aereo_eticket, aereo_bloqueio_id, aereo_flag_subtraido, id_origem_gate, nome_pax_gate, nota_gate, data_nota_gate, fil_agt_gate, aereo_cia_aerea_gate $compl_insert) VALUES (" . $NM_seq_auto . "$this->aereo_id_evento, $this->aereo_id_usuario, '$this->aereo_cpf_particip', $this->aereo_cia_aerea, '$this->aereo_num_voo', '$this->aereo_origem', '$this->aereo_destino', " . $this->Ini->date_delim . $this->aereo_dt_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->aereo_hr_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->aereo_dt_chegada . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->aereo_hr_chegada . $this->Ini->date_delim1 . ", '$this->aereo_localizador', '$this->aereo_eticket', $this->aereo_bloqueio_id, $this->aereo_flag_subtraido, $this->id_origem_gate, '$this->nome_pax_gate', '$this->nota_gate', " . $this->Ini->date_delim . $this->data_nota_gate . $this->Ini->date_delim1 . ", '$this->fil_agt_gate', '$this->aereo_cia_aerea_gate' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->aereo_tipo_pessoa != "")
                  { 
                       $compl_insert     .= ", aereo_tipo_pessoa";
                       $compl_insert_val .= ", '$this->aereo_tipo_pessoa'";
                  } 
                  if ($this->aereo_status != "")
                  { 
                       $compl_insert     .= ", aereo_status";
                       $compl_insert_val .= ", '$this->aereo_status'";
                  } 
                  if ($this->aereo_direcao != "")
                  { 
                       $compl_insert     .= ", aereo_direcao";
                       $compl_insert_val .= ", '$this->aereo_direcao'";
                  } 
                  if ($this->aereo_dthr_saida != "")
                  { 
                       $compl_insert     .= ", aereo_dthr_saida";
                       $compl_insert_val .= ", TO_DATE('$this->aereo_dthr_saida', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->aereo_dthr_chegada != "")
                  { 
                       $compl_insert     .= ", aereo_dthr_chegada";
                       $compl_insert_val .= ", TO_DATE('$this->aereo_dthr_chegada', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->aereo_emitida_bvt != "")
                  { 
                       $compl_insert     .= ", aereo_emitida_bvt";
                       $compl_insert_val .= ", '$this->aereo_emitida_bvt'";
                  } 
                  if ($this->aereo_valor != "")
                  { 
                       $compl_insert     .= ", aereo_valor";
                       $compl_insert_val .= ", $this->aereo_valor";
                  } 
                  if ($this->aereo_modificado_em != "")
                  { 
                       $compl_insert     .= ", aereo_modificado_em";
                       $compl_insert_val .= ", TO_DATE('$this->aereo_modificado_em', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->aereo_trecho != "")
                  { 
                       $compl_insert     .= ", aereo_trecho";
                       $compl_insert_val .= ", $this->aereo_trecho";
                  } 
                  if ($this->aereo_ativo != "")
                  { 
                       $compl_insert     .= ", aereo_ativo";
                       $compl_insert_val .= ", '$this->aereo_ativo'";
                  } 
                  if ($this->aereo_transfer_tipo != "")
                  { 
                       $compl_insert     .= ", aereo_transfer_tipo";
                       $compl_insert_val .= ", '$this->aereo_transfer_tipo'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "aereo_id_evento, aereo_id_usuario, aereo_cpf_particip, aereo_cia_aerea, aereo_num_voo, aereo_origem, aereo_destino, aereo_dt_saida, aereo_hr_saida, aereo_dt_chegada, aereo_hr_chegada, aereo_localizador, aereo_eticket, aereo_bloqueio_id, aereo_flag_subtraido, id_origem_gate, nome_pax_gate, nota_gate, data_nota_gate, fil_agt_gate, aereo_cia_aerea_gate $compl_insert) VALUES (" . $NM_seq_auto . "$this->aereo_id_evento, $this->aereo_id_usuario, '$this->aereo_cpf_particip', $this->aereo_cia_aerea, '$this->aereo_num_voo', '$this->aereo_origem', '$this->aereo_destino', " . $this->Ini->date_delim . $this->aereo_dt_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->aereo_hr_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->aereo_dt_chegada . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->aereo_hr_chegada . $this->Ini->date_delim1 . ", '$this->aereo_localizador', '$this->aereo_eticket', $this->aereo_bloqueio_id, $this->aereo_flag_subtraido, $this->id_origem_gate, '$this->nome_pax_gate', '$this->nota_gate', " . $this->Ini->date_delim . $this->data_nota_gate . $this->Ini->date_delim1 . ", '$this->fil_agt_gate', '$this->aereo_cia_aerea_gate' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->aereo_tipo_pessoa != "")
                  { 
                       $compl_insert     .= ", aereo_tipo_pessoa";
                       $compl_insert_val .= ", '$this->aereo_tipo_pessoa'";
                  } 
                  if ($this->aereo_status != "")
                  { 
                       $compl_insert     .= ", aereo_status";
                       $compl_insert_val .= ", '$this->aereo_status'";
                  } 
                  if ($this->aereo_direcao != "")
                  { 
                       $compl_insert     .= ", aereo_direcao";
                       $compl_insert_val .= ", '$this->aereo_direcao'";
                  } 
                  if ($this->aereo_dthr_saida != "")
                  { 
                       $compl_insert     .= ", aereo_dthr_saida";
                       $compl_insert_val .= ", '$this->aereo_dthr_saida'";
                  } 
                  if ($this->aereo_dthr_chegada != "")
                  { 
                       $compl_insert     .= ", aereo_dthr_chegada";
                       $compl_insert_val .= ", '$this->aereo_dthr_chegada'";
                  } 
                  if ($this->aereo_emitida_bvt != "")
                  { 
                       $compl_insert     .= ", aereo_emitida_bvt";
                       $compl_insert_val .= ", '$this->aereo_emitida_bvt'";
                  } 
                  if ($this->aereo_valor != "")
                  { 
                       $compl_insert     .= ", aereo_valor";
                       $compl_insert_val .= ", $this->aereo_valor";
                  } 
                  if ($this->aereo_modificado_em != "")
                  { 
                       $compl_insert     .= ", aereo_modificado_em";
                       $compl_insert_val .= ", '$this->aereo_modificado_em'";
                  } 
                  if ($this->aereo_trecho != "")
                  { 
                       $compl_insert     .= ", aereo_trecho";
                       $compl_insert_val .= ", $this->aereo_trecho";
                  } 
                  if ($this->aereo_ativo != "")
                  { 
                       $compl_insert     .= ", aereo_ativo";
                       $compl_insert_val .= ", '$this->aereo_ativo'";
                  } 
                  if ($this->aereo_transfer_tipo != "")
                  { 
                       $compl_insert     .= ", aereo_transfer_tipo";
                       $compl_insert_val .= ", '$this->aereo_transfer_tipo'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "aereo_id_evento, aereo_id_usuario, aereo_cpf_particip, aereo_cia_aerea, aereo_num_voo, aereo_origem, aereo_destino, aereo_dt_saida, aereo_hr_saida, aereo_dt_chegada, aereo_hr_chegada, aereo_localizador, aereo_eticket, aereo_bloqueio_id, aereo_flag_subtraido, id_origem_gate, nome_pax_gate, nota_gate, data_nota_gate, fil_agt_gate, aereo_cia_aerea_gate $compl_insert) VALUES (" . $NM_seq_auto . "$this->aereo_id_evento, $this->aereo_id_usuario, '$this->aereo_cpf_particip', $this->aereo_cia_aerea, '$this->aereo_num_voo', '$this->aereo_origem', '$this->aereo_destino', EXTEND('$this->aereo_dt_saida', YEAR TO DAY), " . $this->Ini->date_delim . $this->aereo_hr_saida . $this->Ini->date_delim1 . ", EXTEND('$this->aereo_dt_chegada', YEAR TO DAY), " . $this->Ini->date_delim . $this->aereo_hr_chegada . $this->Ini->date_delim1 . ", '$this->aereo_localizador', '$this->aereo_eticket', $this->aereo_bloqueio_id, $this->aereo_flag_subtraido, $this->id_origem_gate, '$this->nome_pax_gate', '$this->nota_gate', EXTEND('$this->data_nota_gate', YEAR TO DAY), '$this->fil_agt_gate', '$this->aereo_cia_aerea_gate' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->aereo_tipo_pessoa != "")
                  { 
                       $compl_insert     .= ", aereo_tipo_pessoa";
                       $compl_insert_val .= ", '$this->aereo_tipo_pessoa'";
                  } 
                  if ($this->aereo_status != "")
                  { 
                       $compl_insert     .= ", aereo_status";
                       $compl_insert_val .= ", '$this->aereo_status'";
                  } 
                  if ($this->aereo_direcao != "")
                  { 
                       $compl_insert     .= ", aereo_direcao";
                       $compl_insert_val .= ", '$this->aereo_direcao'";
                  } 
                  if ($this->aereo_dthr_saida != "")
                  { 
                       $compl_insert     .= ", aereo_dthr_saida";
                       $compl_insert_val .= ", '$this->aereo_dthr_saida'";
                  } 
                  if ($this->aereo_dthr_chegada != "")
                  { 
                       $compl_insert     .= ", aereo_dthr_chegada";
                       $compl_insert_val .= ", '$this->aereo_dthr_chegada'";
                  } 
                  if ($this->aereo_emitida_bvt != "")
                  { 
                       $compl_insert     .= ", aereo_emitida_bvt";
                       $compl_insert_val .= ", '$this->aereo_emitida_bvt'";
                  } 
                  if ($this->aereo_valor != "")
                  { 
                       $compl_insert     .= ", aereo_valor";
                       $compl_insert_val .= ", $this->aereo_valor";
                  } 
                  if ($this->aereo_modificado_em != "")
                  { 
                       $compl_insert     .= ", aereo_modificado_em";
                       $compl_insert_val .= ", '$this->aereo_modificado_em'";
                  } 
                  if ($this->aereo_trecho != "")
                  { 
                       $compl_insert     .= ", aereo_trecho";
                       $compl_insert_val .= ", $this->aereo_trecho";
                  } 
                  if ($this->aereo_ativo != "")
                  { 
                       $compl_insert     .= ", aereo_ativo";
                       $compl_insert_val .= ", '$this->aereo_ativo'";
                  } 
                  if ($this->aereo_transfer_tipo != "")
                  { 
                       $compl_insert     .= ", aereo_transfer_tipo";
                       $compl_insert_val .= ", '$this->aereo_transfer_tipo'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "aereo_id_evento, aereo_id_usuario, aereo_cpf_particip, aereo_cia_aerea, aereo_num_voo, aereo_origem, aereo_destino, aereo_dt_saida, aereo_hr_saida, aereo_dt_chegada, aereo_hr_chegada, aereo_localizador, aereo_eticket, aereo_bloqueio_id, aereo_flag_subtraido, id_origem_gate, nome_pax_gate, nota_gate, data_nota_gate, fil_agt_gate, aereo_cia_aerea_gate $compl_insert) VALUES (" . $NM_seq_auto . "$this->aereo_id_evento, $this->aereo_id_usuario, '$this->aereo_cpf_particip', $this->aereo_cia_aerea, '$this->aereo_num_voo', '$this->aereo_origem', '$this->aereo_destino', " . $this->Ini->date_delim . $this->aereo_dt_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->aereo_hr_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->aereo_dt_chegada . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->aereo_hr_chegada . $this->Ini->date_delim1 . ", '$this->aereo_localizador', '$this->aereo_eticket', $this->aereo_bloqueio_id, $this->aereo_flag_subtraido, $this->id_origem_gate, '$this->nome_pax_gate', '$this->nota_gate', " . $this->Ini->date_delim . $this->data_nota_gate . $this->Ini->date_delim1 . ", '$this->fil_agt_gate', '$this->aereo_cia_aerea_gate' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->aereo_tipo_pessoa != "")
                  { 
                       $compl_insert     .= ", aereo_tipo_pessoa";
                       $compl_insert_val .= ", '$this->aereo_tipo_pessoa'";
                  } 
                  if ($this->aereo_status != "")
                  { 
                       $compl_insert     .= ", aereo_status";
                       $compl_insert_val .= ", '$this->aereo_status'";
                  } 
                  if ($this->aereo_direcao != "")
                  { 
                       $compl_insert     .= ", aereo_direcao";
                       $compl_insert_val .= ", '$this->aereo_direcao'";
                  } 
                  if ($this->aereo_dthr_saida != "")
                  { 
                       $compl_insert     .= ", aereo_dthr_saida";
                       $compl_insert_val .= ", '$this->aereo_dthr_saida'";
                  } 
                  if ($this->aereo_dthr_chegada != "")
                  { 
                       $compl_insert     .= ", aereo_dthr_chegada";
                       $compl_insert_val .= ", '$this->aereo_dthr_chegada'";
                  } 
                  if ($this->aereo_emitida_bvt != "")
                  { 
                       $compl_insert     .= ", aereo_emitida_bvt";
                       $compl_insert_val .= ", '$this->aereo_emitida_bvt'";
                  } 
                  if ($this->aereo_valor != "")
                  { 
                       $compl_insert     .= ", aereo_valor";
                       $compl_insert_val .= ", $this->aereo_valor";
                  } 
                  if ($this->aereo_modificado_em != "")
                  { 
                       $compl_insert     .= ", aereo_modificado_em";
                       $compl_insert_val .= ", '$this->aereo_modificado_em'";
                  } 
                  if ($this->aereo_trecho != "")
                  { 
                       $compl_insert     .= ", aereo_trecho";
                       $compl_insert_val .= ", $this->aereo_trecho";
                  } 
                  if ($this->aereo_ativo != "")
                  { 
                       $compl_insert     .= ", aereo_ativo";
                       $compl_insert_val .= ", '$this->aereo_ativo'";
                  } 
                  if ($this->aereo_transfer_tipo != "")
                  { 
                       $compl_insert     .= ", aereo_transfer_tipo";
                       $compl_insert_val .= ", '$this->aereo_transfer_tipo'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "aereo_id_evento, aereo_id_usuario, aereo_cpf_particip, aereo_cia_aerea, aereo_num_voo, aereo_origem, aereo_destino, aereo_dt_saida, aereo_hr_saida, aereo_dt_chegada, aereo_hr_chegada, aereo_localizador, aereo_eticket, aereo_bloqueio_id, aereo_flag_subtraido, id_origem_gate, nome_pax_gate, nota_gate, data_nota_gate, fil_agt_gate, aereo_cia_aerea_gate $compl_insert) VALUES (" . $NM_seq_auto . "$this->aereo_id_evento, $this->aereo_id_usuario, '$this->aereo_cpf_particip', $this->aereo_cia_aerea, '$this->aereo_num_voo', '$this->aereo_origem', '$this->aereo_destino', " . $this->Ini->date_delim . $this->aereo_dt_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->aereo_hr_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->aereo_dt_chegada . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->aereo_hr_chegada . $this->Ini->date_delim1 . ", '$this->aereo_localizador', '$this->aereo_eticket', $this->aereo_bloqueio_id, $this->aereo_flag_subtraido, $this->id_origem_gate, '$this->nome_pax_gate', '$this->nota_gate', " . $this->Ini->date_delim . $this->data_nota_gate . $this->Ini->date_delim1 . ", '$this->fil_agt_gate', '$this->aereo_cia_aerea_gate' $compl_insert_val)"; 
              }
              elseif ($this->Ini->nm_tpbanco == 'pdo_ibm')
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->aereo_tipo_pessoa != "")
                  { 
                       $compl_insert     .= ", aereo_tipo_pessoa";
                       $compl_insert_val .= ", '$this->aereo_tipo_pessoa'";
                  } 
                  if ($this->aereo_status != "")
                  { 
                       $compl_insert     .= ", aereo_status";
                       $compl_insert_val .= ", '$this->aereo_status'";
                  } 
                  if ($this->aereo_direcao != "")
                  { 
                       $compl_insert     .= ", aereo_direcao";
                       $compl_insert_val .= ", '$this->aereo_direcao'";
                  } 
                  if ($this->aereo_dthr_saida != "")
                  { 
                       $compl_insert     .= ", aereo_dthr_saida";
                       $compl_insert_val .= ", TO_DATE('$this->aereo_dthr_saida', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->aereo_dthr_chegada != "")
                  { 
                       $compl_insert     .= ", aereo_dthr_chegada";
                       $compl_insert_val .= ", TO_DATE('$this->aereo_dthr_chegada', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->aereo_emitida_bvt != "")
                  { 
                       $compl_insert     .= ", aereo_emitida_bvt";
                       $compl_insert_val .= ", '$this->aereo_emitida_bvt'";
                  } 
                  if ($this->aereo_valor != "")
                  { 
                       $compl_insert     .= ", aereo_valor";
                       $compl_insert_val .= ", $this->aereo_valor";
                  } 
                  if ($this->aereo_modificado_em != "")
                  { 
                       $compl_insert     .= ", aereo_modificado_em";
                       $compl_insert_val .= ", TO_DATE('$this->aereo_modificado_em', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->aereo_trecho != "")
                  { 
                       $compl_insert     .= ", aereo_trecho";
                       $compl_insert_val .= ", $this->aereo_trecho";
                  } 
                  if ($this->aereo_ativo != "")
                  { 
                       $compl_insert     .= ", aereo_ativo";
                       $compl_insert_val .= ", '$this->aereo_ativo'";
                  } 
                  if ($this->aereo_transfer_tipo != "")
                  { 
                       $compl_insert     .= ", aereo_transfer_tipo";
                       $compl_insert_val .= ", '$this->aereo_transfer_tipo'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "aereo_id_evento, aereo_id_usuario, aereo_cpf_particip, aereo_cia_aerea, aereo_num_voo, aereo_origem, aereo_destino, aereo_dt_saida, aereo_hr_saida, aereo_dt_chegada, aereo_hr_chegada, aereo_localizador, aereo_eticket, aereo_bloqueio_id, aereo_flag_subtraido, id_origem_gate, nome_pax_gate, nota_gate, data_nota_gate, fil_agt_gate, aereo_cia_aerea_gate $compl_insert) VALUES (" . $NM_seq_auto . "$this->aereo_id_evento, $this->aereo_id_usuario, '$this->aereo_cpf_particip', $this->aereo_cia_aerea, '$this->aereo_num_voo', '$this->aereo_origem', '$this->aereo_destino', " . $this->Ini->date_delim . $this->aereo_dt_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->aereo_hr_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->aereo_dt_chegada . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->aereo_hr_chegada . $this->Ini->date_delim1 . ", '$this->aereo_localizador', '$this->aereo_eticket', $this->aereo_bloqueio_id, $this->aereo_flag_subtraido, $this->id_origem_gate, '$this->nome_pax_gate', '$this->nota_gate', " . $this->Ini->date_delim . $this->data_nota_gate . $this->Ini->date_delim1 . ", '$this->fil_agt_gate', '$this->aereo_cia_aerea_gate' $compl_insert_val)"; 
              }
              else
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->aereo_tipo_pessoa != "")
                  { 
                       $compl_insert     .= ", aereo_tipo_pessoa";
                       $compl_insert_val .= ", '$this->aereo_tipo_pessoa'";
                  } 
                  if ($this->aereo_status != "")
                  { 
                       $compl_insert     .= ", aereo_status";
                       $compl_insert_val .= ", '$this->aereo_status'";
                  } 
                  if ($this->aereo_direcao != "")
                  { 
                       $compl_insert     .= ", aereo_direcao";
                       $compl_insert_val .= ", '$this->aereo_direcao'";
                  } 
                  if ($this->aereo_dthr_saida != "")
                  { 
                       $compl_insert     .= ", aereo_dthr_saida";
                       $compl_insert_val .= ", '$this->aereo_dthr_saida'";
                  } 
                  if ($this->aereo_dthr_chegada != "")
                  { 
                       $compl_insert     .= ", aereo_dthr_chegada";
                       $compl_insert_val .= ", '$this->aereo_dthr_chegada'";
                  } 
                  if ($this->aereo_emitida_bvt != "")
                  { 
                       $compl_insert     .= ", aereo_emitida_bvt";
                       $compl_insert_val .= ", '$this->aereo_emitida_bvt'";
                  } 
                  if ($this->aereo_valor != "")
                  { 
                       $compl_insert     .= ", aereo_valor";
                       $compl_insert_val .= ", $this->aereo_valor";
                  } 
                  if ($this->aereo_modificado_em != "")
                  { 
                       $compl_insert     .= ", aereo_modificado_em";
                       $compl_insert_val .= ", '$this->aereo_modificado_em'";
                  } 
                  if ($this->aereo_trecho != "")
                  { 
                       $compl_insert     .= ", aereo_trecho";
                       $compl_insert_val .= ", $this->aereo_trecho";
                  } 
                  if ($this->aereo_ativo != "")
                  { 
                       $compl_insert     .= ", aereo_ativo";
                       $compl_insert_val .= ", '$this->aereo_ativo'";
                  } 
                  if ($this->aereo_transfer_tipo != "")
                  { 
                       $compl_insert     .= ", aereo_transfer_tipo";
                       $compl_insert_val .= ", '$this->aereo_transfer_tipo'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "aereo_id_evento, aereo_id_usuario, aereo_cpf_particip, aereo_cia_aerea, aereo_num_voo, aereo_origem, aereo_destino, aereo_dt_saida, aereo_hr_saida, aereo_dt_chegada, aereo_hr_chegada, aereo_localizador, aereo_eticket, aereo_bloqueio_id, aereo_flag_subtraido, id_origem_gate, nome_pax_gate, nota_gate, data_nota_gate, fil_agt_gate, aereo_cia_aerea_gate $compl_insert) VALUES (" . $NM_seq_auto . "$this->aereo_id_evento, $this->aereo_id_usuario, '$this->aereo_cpf_particip', $this->aereo_cia_aerea, '$this->aereo_num_voo', '$this->aereo_origem', '$this->aereo_destino', " . $this->Ini->date_delim . $this->aereo_dt_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->aereo_hr_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->aereo_dt_chegada . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->aereo_hr_chegada . $this->Ini->date_delim1 . ", '$this->aereo_localizador', '$this->aereo_eticket', $this->aereo_bloqueio_id, $this->aereo_flag_subtraido, $this->id_origem_gate, '$this->nome_pax_gate', '$this->nota_gate', " . $this->Ini->date_delim . $this->data_nota_gate . $this->Ini->date_delim1 . ", '$this->fil_agt_gate', '$this->aereo_cia_aerea_gate' $compl_insert_val)"; 
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
                              form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
                          form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
                      }
                      exit; 
                  } 
                  $this->id_aereo =  $rsy->fields[0];
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
                  $this->id_aereo = $rsy->fields[0];
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
                  $this->id_aereo = $rsy->fields[0];
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
                  $this->id_aereo = $rsy->fields[0];
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
                  $this->id_aereo = $rsy->fields[0];
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
                  $this->id_aereo = $rsy->fields[0];
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
                  $this->id_aereo = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              $this->aereo_cpf_particip = $this->aereo_cpf_particip_before_qstr;
              $this->aereo_num_voo = $this->aereo_num_voo_before_qstr;
              $this->aereo_origem = $this->aereo_origem_before_qstr;
              $this->aereo_destino = $this->aereo_destino_before_qstr;
              $this->aereo_localizador = $this->aereo_localizador_before_qstr;
              $this->aereo_eticket = $this->aereo_eticket_before_qstr;
              $this->nome_pax_gate = $this->nome_pax_gate_before_qstr;
              $this->nota_gate = $this->nota_gate_before_qstr;
              $this->fil_agt_gate = $this->fil_agt_gate_before_qstr;
              $this->aereo_cia_aerea_gate = $this->aereo_cia_aerea_gate_before_qstr;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['total']);
              }

              $this->sc_evento = "insert"; 
              $this->aereo_cpf_particip = $this->aereo_cpf_particip_before_qstr;
              $this->aereo_num_voo = $this->aereo_num_voo_before_qstr;
              $this->aereo_origem = $this->aereo_origem_before_qstr;
              $this->aereo_destino = $this->aereo_destino_before_qstr;
              $this->aereo_localizador = $this->aereo_localizador_before_qstr;
              $this->aereo_eticket = $this->aereo_eticket_before_qstr;
              $this->nome_pax_gate = $this->nome_pax_gate_before_qstr;
              $this->nota_gate = $this->nota_gate_before_qstr;
              $this->fil_agt_gate = $this->fil_agt_gate_before_qstr;
              $this->aereo_cia_aerea_gate = $this->aereo_cia_aerea_gate_before_qstr;
              if (empty($this->sc_erro_insert)) {
                  $this->record_insert_ok = true;
              } 
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao = "novo"; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['run_iframe'] == "R")
              { 
                   $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['return_edit'] = "new";
              } 
              }
              $this->nm_flag_iframe = true;
          } 
          if ($this->lig_edit_lookup)
          {
              $this->lig_edit_lookup_call = true;
          }
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['decimal_db'] == ",") 
      {
          $this->nm_tira_aspas_decimal();
      }
      if ($this->nmgp_opcao == "excluir") 
      { 
          $this->id_aereo = substr($this->Db->qstr($this->id_aereo), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';

          if ($bDelecaoOk)
          {

          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo "); 
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
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo "); 
              }  
              else  
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where id_aereo = $this->id_aereo "); 
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
                          form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['total']);
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['parms'] = "id_aereo?#?$this->id_aereo?@?"; 
      }
      $this->NM_commit_db(); 
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->id_aereo = null === $this->id_aereo ? null : substr($this->Db->qstr($this->id_aereo), 1, -1); 
      } 
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_filter'] && $sc_where_filter != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_filter'] . ")";
          }
      }
      if ($this->nmgp_opcao != "novo" && $this->nmgp_opcao != "nada" && $this->nmgp_opcao != "inicio")
      { 
          $this->nmgp_opcao = "igual"; 
      } 
      $GLOBALS["NM_ERRO_IBASE"] = 0;  
//---------- 
      if ($this->nmgp_opcao != "novo" && $this->nmgp_opcao != "nada" && $this->nmgp_opcao != "refresh_insert") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['parms'] = ""; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 1;  
          } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
          { 
              $nmgp_select = "SELECT id_aereo, aereo_id_evento, aereo_id_usuario, aereo_cpf_particip, aereo_tipo_pessoa, aereo_status, aereo_direcao, aereo_cia_aerea, aereo_num_voo, aereo_origem, aereo_destino, str_replace (convert(char(10),aereo_dt_saida,102), '.', '-') + ' ' + convert(char(8),aereo_dt_saida,20), str_replace (convert(char(10),aereo_hr_saida,102), '.', '-') + ' ' + convert(char(8),aereo_hr_saida,20), aereo_dthr_saida, str_replace (convert(char(10),aereo_dt_chegada,102), '.', '-') + ' ' + convert(char(8),aereo_dt_chegada,20), str_replace (convert(char(10),aereo_hr_chegada,102), '.', '-') + ' ' + convert(char(8),aereo_hr_chegada,20), aereo_dthr_chegada, aereo_localizador, aereo_eticket, aereo_emitida_bvt, aereo_valor, aereo_bloqueio_id, aereo_modificado_em, aereo_flag_subtraido, aereo_trecho, aereo_ativo, id_origem_gate, nome_pax_gate, nota_gate, str_replace (convert(char(10),data_nota_gate,102), '.', '-') + ' ' + convert(char(8),data_nota_gate,20), fil_agt_gate, aereo_cia_aerea_gate, aereo_transfer_tipo from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $nmgp_select = "SELECT id_aereo, aereo_id_evento, aereo_id_usuario, aereo_cpf_particip, aereo_tipo_pessoa, aereo_status, aereo_direcao, aereo_cia_aerea, aereo_num_voo, aereo_origem, aereo_destino, convert(char(23),aereo_dt_saida,121), convert(char(23),aereo_hr_saida,121), aereo_dthr_saida, convert(char(23),aereo_dt_chegada,121), convert(char(23),aereo_hr_chegada,121), aereo_dthr_chegada, aereo_localizador, aereo_eticket, aereo_emitida_bvt, aereo_valor, aereo_bloqueio_id, aereo_modificado_em, aereo_flag_subtraido, aereo_trecho, aereo_ativo, id_origem_gate, nome_pax_gate, nota_gate, convert(char(23),data_nota_gate,121), fil_agt_gate, aereo_cia_aerea_gate, aereo_transfer_tipo from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          { 
              $nmgp_select = "SELECT id_aereo, aereo_id_evento, aereo_id_usuario, aereo_cpf_particip, aereo_tipo_pessoa, aereo_status, aereo_direcao, aereo_cia_aerea, aereo_num_voo, aereo_origem, aereo_destino, aereo_dt_saida, aereo_hr_saida, TO_DATE(TO_CHAR(aereo_dthr_saida, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), aereo_dt_chegada, aereo_hr_chegada, TO_DATE(TO_CHAR(aereo_dthr_chegada, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), aereo_localizador, aereo_eticket, aereo_emitida_bvt, aereo_valor, aereo_bloqueio_id, TO_DATE(TO_CHAR(aereo_modificado_em, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), aereo_flag_subtraido, aereo_trecho, aereo_ativo, id_origem_gate, nome_pax_gate, nota_gate, data_nota_gate, fil_agt_gate, aereo_cia_aerea_gate, aereo_transfer_tipo from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $nmgp_select = "SELECT id_aereo, aereo_id_evento, aereo_id_usuario, aereo_cpf_particip, aereo_tipo_pessoa, aereo_status, aereo_direcao, aereo_cia_aerea, aereo_num_voo, aereo_origem, aereo_destino, EXTEND(aereo_dt_saida, YEAR TO DAY), aereo_hr_saida, aereo_dthr_saida, EXTEND(aereo_dt_chegada, YEAR TO DAY), aereo_hr_chegada, aereo_dthr_chegada, aereo_localizador, aereo_eticket, aereo_emitida_bvt, aereo_valor, aereo_bloqueio_id, aereo_modificado_em, aereo_flag_subtraido, aereo_trecho, aereo_ativo, id_origem_gate, nome_pax_gate, nota_gate, EXTEND(data_nota_gate, YEAR TO DAY), fil_agt_gate, aereo_cia_aerea_gate, aereo_transfer_tipo from " . $this->Ini->nm_tabela ; 
          } 
          else 
          { 
              $nmgp_select = "SELECT id_aereo, aereo_id_evento, aereo_id_usuario, aereo_cpf_particip, aereo_tipo_pessoa, aereo_status, aereo_direcao, aereo_cia_aerea, aereo_num_voo, aereo_origem, aereo_destino, aereo_dt_saida, aereo_hr_saida, aereo_dthr_saida, aereo_dt_chegada, aereo_hr_chegada, aereo_dthr_chegada, aereo_localizador, aereo_eticket, aereo_emitida_bvt, aereo_valor, aereo_bloqueio_id, aereo_modificado_em, aereo_flag_subtraido, aereo_trecho, aereo_ativo, id_origem_gate, nome_pax_gate, nota_gate, data_nota_gate, fil_agt_gate, aereo_cia_aerea_gate, aereo_transfer_tipo from " . $this->Ini->nm_tabela ; 
          } 
          $aWhere = array();
          $aWhere[] = $sc_where_filter;
          if ($this->nmgp_opcao == "igual" || (($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['run_iframe'] == "R") && ($this->sc_evento == "insert" || $this->sc_evento == "update")) )
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $aWhere[] = "id_aereo = $this->id_aereo"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $aWhere[] = "id_aereo = $this->id_aereo"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $aWhere[] = "id_aereo = $this->id_aereo"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $aWhere[] = "id_aereo = $this->id_aereo"; 
              }  
              else  
              {
                  $aWhere[] = "id_aereo = $this->id_aereo"; 
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
          $sc_order_by = "id_aereo";
          $sc_order_by = str_replace("order by ", "", $sc_order_by);
          $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
          if (!empty($sc_order_by))
          {
              $nmgp_select .= " order by $sc_order_by "; 
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['run_iframe'] == "R")
          {
              if ($this->sc_evento == "update")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['select'] = $nmgp_select;
                  $this->nm_gera_html();
              } 
              elseif (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['select']))
              { 
                  $nmgp_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['select'];
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['select'] = ""; 
              } 
          } 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
          $rs = $this->Db->Execute($nmgp_select) ; 
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
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_filter']))
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['update']  = $this->nmgp_botoes['update']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['delete']  = $this->nmgp_botoes['delete']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['insert']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['Confirmar'] = $this->nmgp_botoes['Confirmar'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['Voltar'] = $this->nmgp_botoes['Voltar'] = "off";
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['empty_filter'] = true;
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
              $this->NM_ajax_info['buttonDisplay']['update'] = $this->nmgp_botoes['update'] = "off";
              $this->NM_ajax_info['buttonDisplay']['delete'] = $this->nmgp_botoes['delete'] = "off";
              return; 
          } 
          if ($rs === false && $GLOBALS["NM_ERRO_IBASE"] == 1) 
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_nfnd_extr'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          if ($this->nmgp_opcao != "novo") 
          { 
              $this->id_aereo = $rs->fields[0] ; 
              $this->nmgp_dados_select['id_aereo'] = $this->id_aereo;
              $this->aereo_id_evento = $rs->fields[1] ; 
              $this->nmgp_dados_select['aereo_id_evento'] = $this->aereo_id_evento;
              $this->aereo_id_usuario = $rs->fields[2] ; 
              $this->nmgp_dados_select['aereo_id_usuario'] = $this->aereo_id_usuario;
              $this->aereo_cpf_particip = $rs->fields[3] ; 
              $this->nmgp_dados_select['aereo_cpf_particip'] = $this->aereo_cpf_particip;
              $this->aereo_tipo_pessoa = $rs->fields[4] ; 
              $this->nmgp_dados_select['aereo_tipo_pessoa'] = $this->aereo_tipo_pessoa;
              $this->aereo_status = $rs->fields[5] ; 
              $this->nmgp_dados_select['aereo_status'] = $this->aereo_status;
              $this->aereo_direcao = $rs->fields[6] ; 
              $this->nmgp_dados_select['aereo_direcao'] = $this->aereo_direcao;
              $this->aereo_cia_aerea = $rs->fields[7] ; 
              $this->nmgp_dados_select['aereo_cia_aerea'] = $this->aereo_cia_aerea;
              $this->aereo_num_voo = $rs->fields[8] ; 
              $this->nmgp_dados_select['aereo_num_voo'] = $this->aereo_num_voo;
              $this->aereo_origem = $rs->fields[9] ; 
              $this->nmgp_dados_select['aereo_origem'] = $this->aereo_origem;
              $this->aereo_destino = $rs->fields[10] ; 
              $this->nmgp_dados_select['aereo_destino'] = $this->aereo_destino;
              $this->aereo_dt_saida = $rs->fields[11] ; 
              $this->nmgp_dados_select['aereo_dt_saida'] = $this->aereo_dt_saida;
              $this->aereo_hr_saida = $rs->fields[12] ; 
              $this->nmgp_dados_select['aereo_hr_saida'] = $this->aereo_hr_saida;
              $this->aereo_dthr_saida = $rs->fields[13] ; 
              if (substr($this->aereo_dthr_saida, 10, 1) == "-") 
              { 
                 $this->aereo_dthr_saida = substr($this->aereo_dthr_saida, 0, 10) . " " . substr($this->aereo_dthr_saida, 11);
              } 
              if (substr($this->aereo_dthr_saida, 13, 1) == ".") 
              { 
                 $this->aereo_dthr_saida = substr($this->aereo_dthr_saida, 0, 13) . ":" . substr($this->aereo_dthr_saida, 14, 2) . ":" . substr($this->aereo_dthr_saida, 17);
              } 
              $this->nmgp_dados_select['aereo_dthr_saida'] = $this->aereo_dthr_saida;
              $this->aereo_dt_chegada = $rs->fields[14] ; 
              $this->nmgp_dados_select['aereo_dt_chegada'] = $this->aereo_dt_chegada;
              $this->aereo_hr_chegada = $rs->fields[15] ; 
              $this->nmgp_dados_select['aereo_hr_chegada'] = $this->aereo_hr_chegada;
              $this->aereo_dthr_chegada = $rs->fields[16] ; 
              if (substr($this->aereo_dthr_chegada, 10, 1) == "-") 
              { 
                 $this->aereo_dthr_chegada = substr($this->aereo_dthr_chegada, 0, 10) . " " . substr($this->aereo_dthr_chegada, 11);
              } 
              if (substr($this->aereo_dthr_chegada, 13, 1) == ".") 
              { 
                 $this->aereo_dthr_chegada = substr($this->aereo_dthr_chegada, 0, 13) . ":" . substr($this->aereo_dthr_chegada, 14, 2) . ":" . substr($this->aereo_dthr_chegada, 17);
              } 
              $this->nmgp_dados_select['aereo_dthr_chegada'] = $this->aereo_dthr_chegada;
              $this->aereo_localizador = $rs->fields[17] ; 
              $this->nmgp_dados_select['aereo_localizador'] = $this->aereo_localizador;
              $this->aereo_eticket = $rs->fields[18] ; 
              $this->nmgp_dados_select['aereo_eticket'] = $this->aereo_eticket;
              $this->aereo_emitida_bvt = $rs->fields[19] ; 
              $this->nmgp_dados_select['aereo_emitida_bvt'] = $this->aereo_emitida_bvt;
              $this->aereo_valor = $rs->fields[20] ; 
              $this->nmgp_dados_select['aereo_valor'] = $this->aereo_valor;
              $this->aereo_bloqueio_id = $rs->fields[21] ; 
              $this->nmgp_dados_select['aereo_bloqueio_id'] = $this->aereo_bloqueio_id;
              $this->aereo_modificado_em = $rs->fields[22] ; 
              if (substr($this->aereo_modificado_em, 10, 1) == "-") 
              { 
                 $this->aereo_modificado_em = substr($this->aereo_modificado_em, 0, 10) . " " . substr($this->aereo_modificado_em, 11);
              } 
              if (substr($this->aereo_modificado_em, 13, 1) == ".") 
              { 
                 $this->aereo_modificado_em = substr($this->aereo_modificado_em, 0, 13) . ":" . substr($this->aereo_modificado_em, 14, 2) . ":" . substr($this->aereo_modificado_em, 17);
              } 
              $this->nmgp_dados_select['aereo_modificado_em'] = $this->aereo_modificado_em;
              $this->aereo_flag_subtraido = $rs->fields[23] ; 
              $this->nmgp_dados_select['aereo_flag_subtraido'] = $this->aereo_flag_subtraido;
              $this->aereo_trecho = $rs->fields[24] ; 
              $this->nmgp_dados_select['aereo_trecho'] = $this->aereo_trecho;
              $this->aereo_ativo = $rs->fields[25] ; 
              $this->nmgp_dados_select['aereo_ativo'] = $this->aereo_ativo;
              $this->id_origem_gate = $rs->fields[26] ; 
              $this->nmgp_dados_select['id_origem_gate'] = $this->id_origem_gate;
              $this->nome_pax_gate = $rs->fields[27] ; 
              $this->nmgp_dados_select['nome_pax_gate'] = $this->nome_pax_gate;
              $this->nota_gate = $rs->fields[28] ; 
              $this->nmgp_dados_select['nota_gate'] = $this->nota_gate;
              $this->data_nota_gate = $rs->fields[29] ; 
              $this->nmgp_dados_select['data_nota_gate'] = $this->data_nota_gate;
              $this->fil_agt_gate = $rs->fields[30] ; 
              $this->nmgp_dados_select['fil_agt_gate'] = $this->fil_agt_gate;
              $this->aereo_cia_aerea_gate = $rs->fields[31] ; 
              $this->nmgp_dados_select['aereo_cia_aerea_gate'] = $this->aereo_cia_aerea_gate;
              $this->aereo_transfer_tipo = $rs->fields[32] ; 
              $this->nmgp_dados_select['aereo_transfer_tipo'] = $this->aereo_transfer_tipo;
          $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->nm_troca_decimal(",", ".");
              $this->id_aereo = (string)$this->id_aereo; 
              $this->aereo_id_evento = (string)$this->aereo_id_evento; 
              $this->aereo_id_usuario = (string)$this->aereo_id_usuario; 
              $this->aereo_cia_aerea = (string)$this->aereo_cia_aerea; 
              $this->aereo_valor = (string)$this->aereo_valor; 
              $this->aereo_bloqueio_id = (string)$this->aereo_bloqueio_id; 
              $this->aereo_flag_subtraido = (string)$this->aereo_flag_subtraido; 
              $this->aereo_trecho = (string)$this->aereo_trecho; 
              $this->id_origem_gate = (string)$this->id_origem_gate; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['parms'] = "id_aereo?#?$this->id_aereo?@?";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dados_select'] = $this->nmgp_dados_select;
          if (!$this->NM_ajax_flag || 'backup_line' != $this->NM_ajax_opcao)
          {
              $this->controle_navegacao();
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
              $this->id_aereo = "";  
              $this->nmgp_dados_form["id_aereo"] = $this->id_aereo;
              $this->aereo_id_evento = "";  
              $this->nmgp_dados_form["aereo_id_evento"] = $this->aereo_id_evento;
              $this->aereo_id_usuario = "";  
              $this->nmgp_dados_form["aereo_id_usuario"] = $this->aereo_id_usuario;
              $this->aereo_cpf_particip = "";  
              $this->nmgp_dados_form["aereo_cpf_particip"] = $this->aereo_cpf_particip;
              $this->aereo_tipo_pessoa = "";  
              $this->nmgp_dados_form["aereo_tipo_pessoa"] = $this->aereo_tipo_pessoa;
              $this->aereo_status = "";  
              $this->nmgp_dados_form["aereo_status"] = $this->aereo_status;
              $this->aereo_direcao = "";  
              $this->nmgp_dados_form["aereo_direcao"] = $this->aereo_direcao;
              $this->aereo_cia_aerea = "";  
              $this->nmgp_dados_form["aereo_cia_aerea"] = $this->aereo_cia_aerea;
              $this->aereo_num_voo = "";  
              $this->nmgp_dados_form["aereo_num_voo"] = $this->aereo_num_voo;
              $this->aereo_origem = "";  
              $this->nmgp_dados_form["aereo_origem"] = $this->aereo_origem;
              $this->aereo_destino = "";  
              $this->nmgp_dados_form["aereo_destino"] = $this->aereo_destino;
              $this->aereo_dt_saida = "";  
              $this->aereo_dt_saida_hora = "" ;  
              $this->nmgp_dados_form["aereo_dt_saida"] = $this->aereo_dt_saida;
              $this->aereo_hr_saida = "";  
              $this->aereo_hr_saida_hora = "" ;  
              $this->nmgp_dados_form["aereo_hr_saida"] = $this->aereo_hr_saida;
              $this->aereo_dthr_saida = "";  
              $this->aereo_dthr_saida_hora = "" ;  
              $this->nmgp_dados_form["aereo_dthr_saida"] = $this->aereo_dthr_saida;
              $this->aereo_dt_chegada = "";  
              $this->aereo_dt_chegada_hora = "" ;  
              $this->nmgp_dados_form["aereo_dt_chegada"] = $this->aereo_dt_chegada;
              $this->aereo_hr_chegada = "";  
              $this->aereo_hr_chegada_hora = "" ;  
              $this->nmgp_dados_form["aereo_hr_chegada"] = $this->aereo_hr_chegada;
              $this->aereo_dthr_chegada = "";  
              $this->aereo_dthr_chegada_hora = "" ;  
              $this->nmgp_dados_form["aereo_dthr_chegada"] = $this->aereo_dthr_chegada;
              $this->aereo_localizador = "";  
              $this->nmgp_dados_form["aereo_localizador"] = $this->aereo_localizador;
              $this->aereo_eticket = "";  
              $this->nmgp_dados_form["aereo_eticket"] = $this->aereo_eticket;
              $this->aereo_emitida_bvt = "";  
              $this->nmgp_dados_form["aereo_emitida_bvt"] = $this->aereo_emitida_bvt;
              $this->aereo_valor = "";  
              $this->nmgp_dados_form["aereo_valor"] = $this->aereo_valor;
              $this->aereo_bloqueio_id = "";  
              $this->nmgp_dados_form["aereo_bloqueio_id"] = $this->aereo_bloqueio_id;
              $this->aereo_modificado_em = "";  
              $this->aereo_modificado_em_hora = "" ;  
              $this->nmgp_dados_form["aereo_modificado_em"] = $this->aereo_modificado_em;
              $this->aereo_flag_subtraido = "";  
              $this->nmgp_dados_form["aereo_flag_subtraido"] = $this->aereo_flag_subtraido;
              $this->aereo_trecho = "";  
              $this->nmgp_dados_form["aereo_trecho"] = $this->aereo_trecho;
              $this->aereo_ativo = "";  
              $this->nmgp_dados_form["aereo_ativo"] = $this->aereo_ativo;
              $this->id_origem_gate = "";  
              $this->nmgp_dados_form["id_origem_gate"] = $this->id_origem_gate;
              $this->nome_pax_gate = "";  
              $this->nmgp_dados_form["nome_pax_gate"] = $this->nome_pax_gate;
              $this->nota_gate = "";  
              $this->nmgp_dados_form["nota_gate"] = $this->nota_gate;
              $this->data_nota_gate = "";  
              $this->data_nota_gate_hora = "" ;  
              $this->nmgp_dados_form["data_nota_gate"] = $this->data_nota_gate;
              $this->fil_agt_gate = "";  
              $this->nmgp_dados_form["fil_agt_gate"] = $this->fil_agt_gate;
              $this->aereo_cia_aerea_gate = "";  
              $this->nmgp_dados_form["aereo_cia_aerea_gate"] = $this->aereo_cia_aerea_gate;
              $this->aereo_transfer_tipo = "";  
              $this->nmgp_dados_form["aereo_transfer_tipo"] = $this->aereo_transfer_tipo;
              $this->part_copy = "";  
              $this->nmgp_dados_form["part_copy"] = $this->part_copy;
              $this->acomp_copy = "";  
              $this->nmgp_dados_form["acomp_copy"] = $this->acomp_copy;
              $this->cpf_del = "";  
              $this->nmgp_dados_form["cpf_del"] = $this->cpf_del;
              $this->sql_log = "";  
              $this->nmgp_dados_form["sql_log"] = $this->sql_log;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dados_form'] = $this->nmgp_dados_form;
              $this->formatado = false;
          }
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['foreign_key'] as $sFKName => $sFKValue)
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
        function initializeRecordState() {
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho']['record_state'][$sc_seq_vert]['buttons']['update'];
                }
        }

//

function Part_copy_onChange()
{
$_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'on';
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
if (!isset($this->sc_temp_vg_matriz_trunico)) {$this->sc_temp_vg_matriz_trunico = (isset($_SESSION['vg_matriz_trunico'])) ? $_SESSION['vg_matriz_trunico'] : "";}
  
$original_part_copy = $this->part_copy;
$this->part_copy = str_replace("@?@", ";", $this->part_copy);


date_default_timezone_set('America/Sao_Paulo');
$qtde = 0;
$_qcpf = '';
$w_ultnome = explode (";", $this->part_copy );
$tamatriz = sizeof($w_ultnome);
for ($i=0;$i<$tamatriz;++$i) {
	$_poscpf = strpos( $w_ultnome[$i],"CPF:");
	$_qcpf = substr( $w_ultnome[$i],($_poscpf+5),13);	
	$_qcpf = str_replace(' ', '', $_qcpf);
	if ($_qcpf <> '') {	
		foreach ($this->sc_temp_vg_matriz_trunico as $value) {
			$sql01 = "				
			SELECT    
				COUNT(id_aereo) as qtde
			FROM
				aereos_rsvp
			WHERE
				aereo_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."							
			AND
				aereo_cpf_particip = ".$this->Db->qstr($_qcpf)."
			";
			 
      $nm_select = $sql01; 
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
			if ($qtde <> 0) {
				$this->sc_ajax_message ("O(s) Participante(s) escolhido(s) já possui(em) trecho(s) lançado(s)", "NRSVP", "timeout=10");		
				break;
			}	
		}
	}
}	


if (isset($this->sc_temp_vg_matriz_trunico)) { $_SESSION['vg_matriz_trunico'] = $this->sc_temp_vg_matriz_trunico;}
if (isset($this->sc_temp_vg_evento_id)) { $_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
$_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'off';
$modificado_part_copy = $this->part_copy;
$this->nm_formatar_campos('part_copy');
if ($original_part_copy !== $modificado_part_copy || isset($this->nmgp_cmp_readonly['part_copy']) || (isset($bFlagRead_part_copy) && $bFlagRead_part_copy))
{
    $this->ajax_return_values_part_copy(true);
}
$this->NM_ajax_info['event_field'] = 'Part';
form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
exit;
}


function acomp_copy_onChange()
{
$_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'on';
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
if (!isset($this->sc_temp_vg_matriz_trunico)) {$this->sc_temp_vg_matriz_trunico = (isset($_SESSION['vg_matriz_trunico'])) ? $_SESSION['vg_matriz_trunico'] : "";}
  
$original_acomp_copy = $this->acomp_copy;
$this->acomp_copy = str_replace("@?@", ";", $this->acomp_copy);

date_default_timezone_set('America/Sao_Paulo');
$qtde = 0;
$_qcpf = '';
$w_ultnome = explode (";", $this->acomp_copy );
$tamatriz = sizeof($w_ultnome);
for ($i=0;$i<$tamatriz;++$i) {
	$_poscpf = strpos( $w_ultnome[$i],"CPF:");
	$_qcpf = substr( $w_ultnome[$i],($_poscpf+5),13);	
	$_qcpf = str_replace(' ', '', $_qcpf);
	if ($_qcpf <> '') {	
		foreach ($this->sc_temp_vg_matriz_trunico as $value) {
			$sql01 = "				
			SELECT    
				COUNT(id_aereo) as qtde
			FROM
				aereos_rsvp
			WHERE
				aereo_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."							
			AND
				aereo_cpf_particip = ".$this->Db->qstr($_qcpf)."
			";			
			 
      $nm_select = $sql01; 
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
			if ($qtde <> 0) {
				$this->sc_ajax_message ("O(s) Acompamhante(s) escolhido(s) já possui(em) trecho(s) lançado(s)", "NRSVP", "timeout=10");
				break;
			}	
		}
	}
}	


if (isset($this->sc_temp_vg_matriz_trunico)) { $_SESSION['vg_matriz_trunico'] = $this->sc_temp_vg_matriz_trunico;}
if (isset($this->sc_temp_vg_evento_id)) { $_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
$_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'off';
$modificado_acomp_copy = $this->acomp_copy;
$this->nm_formatar_campos('acomp_copy');
if ($original_acomp_copy !== $modificado_acomp_copy || isset($this->nmgp_cmp_readonly['acomp_copy']) || (isset($bFlagRead_acomp_copy) && $bFlagRead_acomp_copy))
{
    $this->ajax_return_values_acomp_copy(true);
}
$this->NM_ajax_info['event_field'] = 'acomp';
form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
exit;
}


function GetUsuarioNivel($idu,$tipo) {
$_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'off';
}


function GravaLog($v_hora_now,$v_ip_usuario,$v_id_usuario,$v_global_cpf,$v_modulo,$v_aplicacao,$v_acao,$v_campo_id,$v_vl_campo_id,$v_campo_cpf,$v_vl_campo_cpf,$v_campo_evt,$v_vl_campo_evt,$v_tabela,$v_obs,$v_sql) {
$_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'on';
  		
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
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
$_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'off';
}


function MakeColor($vp_evento,$vp_cpf,$tipo) {
$_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'on';
  
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
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
                form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
				}
			}	
		}
$_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'off';
}


function MakeColora($vp_evento,$vp_cpf,$tipo) {
$_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'on';
  
		date_default_timezone_set('America/Sao_Paulo');
		
	
$_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'off';
}


function PegaIP() {
$_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'on';
  
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
	
$_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['form_aereos_rsvp_ctrecho_mob']['contr_erro'] = 'off';
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
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
        $this->initFormPages();
    include_once("form_aereos_rsvp_ctrecho_mob_form0.php");
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
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array("id_aereo", "aereo_id_evento"))) {
            $searchOk = true;
        }
        elseif ($field == $this->nmgp_fast_search && in_array($field, array("id_aereo", "aereo_id_evento"))) {
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['table_refresh'])
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['csrf_token'];
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

   function Form_lookup_part_copy()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_part_copy']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_part_copy'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_part_copy']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_part_copy'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_part_copy']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_part_copy'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_part_copy']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_part_copy'] = array(); 
    }

   $old_value_id_aereo = $this->id_aereo;
   $old_value_aereo_id_evento = $this->aereo_id_evento;
   $this->nm_tira_formatacao();


   $unformatted_value_id_aereo = $this->id_aereo;
   $unformatted_value_aereo_id_evento = $this->aereo_id_evento;

   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   {
       $nm_comando = "SELECT nome_pessoa + '  CPF:  ' + part_cpf, nome_pessoa FROM participantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf <> '" . $_SESSION['vg_cpf'] . "' ORDER BY nome_pessoa";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   {
       $nm_comando = "SELECT concat(nome_pessoa,'  CPF:  ',part_cpf), nome_pessoa FROM participantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf <> '" . $_SESSION['vg_cpf'] . "' ORDER BY nome_pessoa";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
   {
       $nm_comando = "SELECT nome_pessoa&'  CPF:  '&part_cpf, nome_pessoa FROM participantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf <> '" . $_SESSION['vg_cpf'] . "' ORDER BY nome_pessoa";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
   {
       $nm_comando = "SELECT nome_pessoa||'  CPF:  '||part_cpf, nome_pessoa FROM participantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf <> '" . $_SESSION['vg_cpf'] . "' ORDER BY nome_pessoa";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   {
       $nm_comando = "SELECT nome_pessoa + '  CPF:  ' + part_cpf, nome_pessoa FROM participantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf <> '" . $_SESSION['vg_cpf'] . "' ORDER BY nome_pessoa";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
   {
       $nm_comando = "SELECT nome_pessoa||'  CPF:  '||part_cpf, nome_pessoa FROM participantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf <> '" . $_SESSION['vg_cpf'] . "' ORDER BY nome_pessoa";
   }
   else
   {
       $nm_comando = "SELECT nome_pessoa||'  CPF:  '||part_cpf, nome_pessoa FROM participantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf <> '" . $_SESSION['vg_cpf'] . "' ORDER BY nome_pessoa";
   }

   $this->id_aereo = $old_value_id_aereo;
   $this->aereo_id_evento = $old_value_aereo_id_evento;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_part_copy'][] = $rs->fields[0];
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
   function Form_lookup_acomp_copy()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_acomp_copy']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_acomp_copy'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_acomp_copy']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_acomp_copy'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_acomp_copy']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_acomp_copy'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_acomp_copy']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_acomp_copy'] = array(); 
    }

   $old_value_id_aereo = $this->id_aereo;
   $old_value_aereo_id_evento = $this->aereo_id_evento;
   $this->nm_tira_formatacao();


   $unformatted_value_id_aereo = $this->id_aereo;
   $unformatted_value_aereo_id_evento = $this->aereo_id_evento;

   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   {
       $nm_comando = "SELECT part_nome + '  CPF:  ' + part_cpf, part_nome FROM acompanhantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf_mestre = '" . $_SESSION['vg_cpf'] . "' ORDER BY part_nome";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   {
       $nm_comando = "SELECT concat(part_nome,'  CPF:  ',part_cpf), part_nome FROM acompanhantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf_mestre = '" . $_SESSION['vg_cpf'] . "' ORDER BY part_nome";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
   {
       $nm_comando = "SELECT part_nome&'  CPF:  '&part_cpf, part_nome FROM acompanhantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf_mestre = '" . $_SESSION['vg_cpf'] . "' ORDER BY part_nome";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
   {
       $nm_comando = "SELECT part_nome||'  CPF:  '||part_cpf, part_nome FROM acompanhantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf_mestre = '" . $_SESSION['vg_cpf'] . "' ORDER BY part_nome";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   {
       $nm_comando = "SELECT part_nome + '  CPF:  ' + part_cpf, part_nome FROM acompanhantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf_mestre = '" . $_SESSION['vg_cpf'] . "' ORDER BY part_nome";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
   {
       $nm_comando = "SELECT part_nome||'  CPF:  '||part_cpf, part_nome FROM acompanhantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf_mestre = '" . $_SESSION['vg_cpf'] . "' ORDER BY part_nome";
   }
   else
   {
       $nm_comando = "SELECT part_nome||'  CPF:  '||part_cpf, part_nome FROM acompanhantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf_mestre = '" . $_SESSION['vg_cpf'] . "' ORDER BY part_nome";
   }

   $this->id_aereo = $old_value_id_aereo;
   $this->aereo_id_evento = $old_value_aereo_id_evento;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['Lookup_acomp_copy'][] = $rs->fields[0];
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
   function SC_fast_search($in_fields, $arg_search, $data_search)
   {
      $fields = (strpos($in_fields, "SC_all_Cmp") !== false) ? array("SC_all_Cmp") : explode(";", $in_fields);
      $this->NM_case_insensitive = true;
      if (empty($data_search)) 
      {
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dyn_search_and_or']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dyn_search_cache']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
          if ($field == "SC_all_Cmp" || $field == "id_aereo") 
          {
              $this->SC_monta_condicao($comando, "id_aereo", $arg_search, str_replace(",", ".", $data_search), "INT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "aereo_id_evento") 
          {
              $this->SC_monta_condicao($comando, "aereo_id_evento", $arg_search, str_replace(",", ".", $data_search), "INT", false);
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_filter_form'] . " and (" . $comando . ")";
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
      $qt_geral_reg_form_aereos_rsvp_ctrecho_mob = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['total'] = $qt_geral_reg_form_aereos_rsvp_ctrecho_mob;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
      $nm_numeric[] = "id_aereo";$nm_numeric[] = "aereo_id_evento";$nm_numeric[] = "aereo_id_usuario";$nm_numeric[] = "aereo_cia_aerea";$nm_numeric[] = "aereo_valor";$nm_numeric[] = "aereo_bloqueio_id";$nm_numeric[] = "aereo_flag_subtraido";$nm_numeric[] = "aereo_trecho";$nm_numeric[] = "id_origem_gate";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['decimal_db'] == ".")
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
      $Nm_datas["aereo_dt_saida"] = "date";$Nm_datas["aereo_hr_saida"] = "time";$Nm_datas["aereo_dthr_saida"] = "timestamp";$Nm_datas["aereo_dt_chegada"] = "date";$Nm_datas["aereo_hr_chegada"] = "time";$Nm_datas["aereo_dthr_chegada"] = "timestamp";$Nm_datas["aereo_modificado_em"] = "timestamp";$Nm_datas["data_nota_gate"] = "date";
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
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['SC_sep_date']))
              {
                  $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['SC_sep_date'];
                  $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['SC_sep_date1'];
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
       $nmgp_saida_form = "form_aereos_rsvp_ctrecho_mob_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['nm_run_menu'] = 2;
       $nmgp_saida_form = "form_aereos_rsvp_ctrecho_mob_fim.php";
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
       form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['masterValue']);
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
function nmgp_redireciona_form($nm_apl_dest, $nm_apl_retorno, $nm_apl_parms, $nm_target="", $opc="", $alt_modal=430, $larg_modal=630)
{
   if (isset($this->NM_is_redirected) && $this->NM_is_redirected)
   {
       return;
   }
   if (is_array($nm_apl_parms))
   {
       $tmp_parms = "";
       foreach ($nm_apl_parms as $par => $val)
       {
           $par = trim($par);
           $val = trim($val);
           $tmp_parms .= str_replace(".", "_", $par) . "?#?";
           if (substr($val, 0, 1) == "$")
           {
               $tmp_parms .= $$val;
           }
           elseif (substr($val, 0, 1) == "{")
           {
               $val        = substr($val, 1, -1);
               $tmp_parms .= $this->$val;
           }
           elseif (substr($val, 0, 1) == "[")
           {
               $tmp_parms .= $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob'][substr($val, 1, -1)];
           }
           else
           {
               $tmp_parms .= $val;
           }
           $tmp_parms .= "?@?";
       }
       $nm_apl_parms = $tmp_parms;
   }
   if (empty($opc))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['opcao'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['opc_ant'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['retorno_edit'] = "";
   }
   $nm_target_form = (empty($nm_target)) ? "_self" : $nm_target;
   if (strtolower(substr($nm_apl_dest, -4)) != ".php" && (strtolower(substr($nm_apl_dest, 0, 7)) == "http://" || strtolower(substr($nm_apl_dest, 0, 8)) == "https://" || strtolower(substr($nm_apl_dest, 0, 3)) == "../"))
   {
       if ($this->NM_ajax_flag)
       {
           $this->NM_ajax_info['redir']['metodo'] = 'location';
           $this->NM_ajax_info['redir']['action'] = $nm_apl_dest;
           $this->NM_ajax_info['redir']['target'] = $nm_target_form;
           form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
           exit;
       }
       echo "<SCRIPT language=\"javascript\">";
       if (strtolower($nm_target) == "_blank")
       {
           echo "window.open ('" . $nm_apl_dest . "');";
           echo "</SCRIPT>";
           return;
       }
       else
       {
           echo "window.location='" . $nm_apl_dest . "';";
           echo "</SCRIPT>";
           $this->NM_close_db();
           exit;
       }
   }
   $dir = explode("/", $nm_apl_dest);
   if (count($dir) == 1)
   {
       $nm_apl_dest = str_replace(".php", "", $nm_apl_dest);
       $nm_apl_dest = $this->Ini->path_link . SC_dir_app_name($nm_apl_dest) . "/" . $nm_apl_dest . ".php";
   }
   if ($this->NM_ajax_flag)
   {
       $nm_apl_parms = str_replace("?#?", "*scin", NM_charset_to_utf8($nm_apl_parms));
       $nm_apl_parms = str_replace("?@?", "*scout", $nm_apl_parms);
       $this->NM_ajax_info['redir']['metodo']     = 'post';
       $this->NM_ajax_info['redir']['action']     = $nm_apl_dest;
       $this->NM_ajax_info['redir']['nmgp_parms'] = $nm_apl_parms;
       $this->NM_ajax_info['redir']['target']     = $nm_target_form;
       $this->NM_ajax_info['redir']['h_modal']    = $alt_modal;
       $this->NM_ajax_info['redir']['w_modal']    = $larg_modal;
       if ($nm_target_form == "_blank")
       {
           $this->NM_ajax_info['redir']['nmgp_outra_jan'] = 'true';
       }
       else
       {
           $this->NM_ajax_info['redir']['nmgp_url_saida']      = $nm_apl_retorno;
           $this->NM_ajax_info['redir']['script_case_init']    = $this->Ini->sc_page;
       }
       form_aereos_rsvp_ctrecho_mob_pack_ajax_response();
       exit;
   }
   if ($nm_target == "modal")
   {
       if (!empty($nm_apl_parms))
       {
           $nm_apl_parms = str_replace("?#?", "*scin", $nm_apl_parms);
           $nm_apl_parms = str_replace("?@?", "*scout", $nm_apl_parms);
           $nm_apl_parms = "nmgp_parms=" . $nm_apl_parms . "&";
       }
       $par_modal = "?script_case_init=" . $this->Ini->sc_page . "&nmgp_outra_jan=true&nmgp_url_saida=modal&NMSC_modal=ok&";
       $this->redir_modal = "$(function() { tb_show('', '" . $nm_apl_dest . $par_modal . $nm_apl_parms . "TB_iframe=true&modal=true&height=" . $alt_modal . "&width=" . $larg_modal . "', '') })";
       $this->NM_is_redirected = true;
       return;
   }
   if ($nm_target == "_blank")
   {
?>
<form name="Fredir" method="post" target="_blank" action="<?php echo $nm_apl_dest; ?>">
  <input type="hidden" name="nmgp_parms" value="<?php echo $this->form_encode_input($nm_apl_parms); ?>"/>
</form>
<script type="text/javascript">
setTimeout(function() { document.Fredir.submit(); }, 250);
</script>
<?php
    return;
   }
?>
<?php
   if ($nm_target_form != "_blank" && $nm_target_form != "modal")
   {
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
    <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_third; ?>jquery/js/jquery.js"></SCRIPT>
   </HEAD>
   <BODY>
<?php
   }
?>
<form name="Fredir" method="post" 
                  target="_self"> 
  <input type="hidden" name="nmgp_parms" value="<?php echo $this->form_encode_input($nm_apl_parms); ?>"/>
<?php
   if ($nm_target_form == "_blank")
   {
?>
  <input type="hidden" name="nmgp_outra_jan" value="true"/> 
<?php
   }
   else
   {
?>
  <input type="hidden" name="nmgp_url_saida" value="<?php echo $this->form_encode_input($nm_apl_retorno) ?>">
  <input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"/> 
<?php
   }
?>
</form> 
   <SCRIPT type="text/javascript">
<?php
   if ($nm_target_form == "modal")
   {
?>
       $(document).ready(function(){
           tb_show('', '<?php echo $nm_apl_dest ?>?script_case_init=<?php echo $this->Ini->sc_page; ?>&nmgp_url_saida=modal&nmgp_parms=<?php echo $this->form_encode_input($nm_apl_parms); ?>&nmgp_outra_jan=true&TB_iframe=true&height=<?php echo $alt_modal; ?>&width=<?php echo $larg_modal; ?>&modal=true', '');
       });
<?php
   }
   else
   {
?>
    $(function() {
       document.Fredir.target = "<?php echo $nm_target_form ?>"; 
       document.Fredir.action = "<?php echo $nm_apl_dest ?>";
       document.Fredir.submit();
    });
<?php
   }
?>
   </SCRIPT>
<?php
   if ($nm_target_form != "_blank" && $nm_target_form != "modal")
   {
?>
   </BODY>
   </HTML>
<?php
   }
?>
<?php
   if ($nm_target_form != "_blank" && $nm_target_form != "modal")
   {
       $this->NM_close_db();
       exit;
   }
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
            case "confirmar":
                return array("sc_Confirmar_top", "sc_Confirmar_top");
                break;
            case "voltar":
                return array("sc_Voltar_top", "sc_Voltar_top");
                break;
            case "0":
                return array("sys_separator.sc-unique-btn-1", "sys_separator.sc-unique-btn-3");
                break;
            case "exit":
                return array("sc_b_sai_b.sc-unique-btn-2", "sc_b_sai_b.sc-unique-btn-4");
                break;
        }

        return array($buttonName);
    } // getButtonIds

    function displayAppHeader()
    {
        if ($this->Embutida_call) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['link_info']['compact_mode']) {
            return;
        }
?>
    <tr id="sc_form_head"><td class="sc-app-header">
<?php if (!empty($_SESSION['scriptcase']['proc_mobile'])) { ?>
<style>
    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}
</style>
<div class="scFormHeader" style="height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;">
    <div class="scFormHeaderFont" style="float: left; text-transform: uppercase;"><?php if ($this->nmgp_opcao == "novo") { echo "Copiar Trechos Aéreos"; } else { echo "Copiar Trechos Aéreos"; } ?></div>
    <div class="scFormHeaderFont" style="float: right;"><?php echo date($this->dateDefaultFormat()); ?></div>
</div>
<?php } else { ?>
<style>
    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}
</style>
<div class="scFormHeader" style="height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;">
    <div class="scFormHeaderFont" style="float: left; text-transform: uppercase;"><?php if ($this->nmgp_opcao == "novo") { echo "Copiar Trechos Aéreos"; } else { echo "Copiar Trechos Aéreos"; } ?></div>
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
        if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['run_iframe'] != "R") {
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_ctrecho_mob']['ordem_ord'] == " desc") {
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
            case "id_aereo":
                return true;
            case "aereo_id_evento":
                return true;
            case "aereo_id_usuario":
                return true;
            case "aereo_cia_aerea":
                return true;
            case "aereo_valor":
                return true;
            case "aereo_bloqueio_id":
                return true;
            case "aereo_flag_subtraido":
                return true;
            case "aereo_trecho":
                return true;
            case "id_origem_gate":
                return true;
            default:
                return false;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
            case "id_aereo":
                return 'desc';
            case "aereo_id_evento":
                return 'desc';
            case "aereo_id_usuario":
                return 'desc';
            case "aereo_cia_aerea":
                return 'desc';
            case "aereo_dt_saida":
                return 'desc';
            case "aereo_hr_saida":
                return 'desc';
            case "aereo_dthr_saida":
                return 'desc';
            case "aereo_dt_chegada":
                return 'desc';
            case "aereo_hr_chegada":
                return 'desc';
            case "aereo_dthr_chegada":
                return 'desc';
            case "aereo_valor":
                return 'desc';
            case "aereo_bloqueio_id":
                return 'desc';
            case "aereo_modificado_em":
                return 'desc';
            case "aereo_flag_subtraido":
                return 'desc';
            case "aereo_trecho":
                return 'desc';
            case "id_origem_gate":
                return 'desc';
            case "data_nota_gate":
                return 'desc';
            default:
                return 'asc';
        }
        return 'asc';
    }

}
?>
