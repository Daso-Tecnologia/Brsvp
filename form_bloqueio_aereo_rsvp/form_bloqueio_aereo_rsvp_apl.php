<?php
//
class form_bloqueio_aereo_rsvp_apl
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
   var $bloqueio_id;
   var $bloq_evento_id;
   var $bloq_evento_id_1;
   var $bloq_descricao;
   var $bloq_cia_aerea;
   var $bloq_cia_aerea_1;
   var $bloq_direcao;
   var $bloq_origem;
   var $bloq_origem_1;
   var $bloq_destino;
   var $bloq_destino_1;
   var $bloq_dt_saida;
   var $bloq_dt_chegada;
   var $bloq_hr_saida;
   var $bloq_hr_chegada;
   var $bloq_num_voo;
   var $bloq_num_pass_etkt;
   var $bloq_localizador;
   var $bloq_qtd_lugares;
   var $bloq_saldo_lugares;
   var $bloq_nota_gate;
   var $bloq_dt_nota_gate;
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
   var $NM_case_insensitive;
//
//----- 
   function ini_controle()
   {
        global $nm_url_saida, $teste_validade, $script_case_init, 
               $glo_senha_protect, $nm_apl_dependente, $nm_form_submit, $sc_check_excl, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup;


      if ($this->NM_ajax_flag)
      {
          if (isset($this->NM_ajax_info['param']['bloq_cia_aerea']))
          {
              $this->bloq_cia_aerea = $this->NM_ajax_info['param']['bloq_cia_aerea'];
          }
          if (isset($this->NM_ajax_info['param']['bloq_descricao']))
          {
              $this->bloq_descricao = $this->NM_ajax_info['param']['bloq_descricao'];
          }
          if (isset($this->NM_ajax_info['param']['bloq_destino']))
          {
              $this->bloq_destino = $this->NM_ajax_info['param']['bloq_destino'];
          }
          if (isset($this->NM_ajax_info['param']['bloq_direcao']))
          {
              $this->bloq_direcao = $this->NM_ajax_info['param']['bloq_direcao'];
          }
          if (isset($this->NM_ajax_info['param']['bloq_dt_chegada']))
          {
              $this->bloq_dt_chegada = $this->NM_ajax_info['param']['bloq_dt_chegada'];
          }
          if (isset($this->NM_ajax_info['param']['bloq_dt_nota_gate']))
          {
              $this->bloq_dt_nota_gate = $this->NM_ajax_info['param']['bloq_dt_nota_gate'];
          }
          if (isset($this->NM_ajax_info['param']['bloq_dt_saida']))
          {
              $this->bloq_dt_saida = $this->NM_ajax_info['param']['bloq_dt_saida'];
          }
          if (isset($this->NM_ajax_info['param']['bloq_evento_id']))
          {
              $this->bloq_evento_id = $this->NM_ajax_info['param']['bloq_evento_id'];
          }
          if (isset($this->NM_ajax_info['param']['bloq_hr_chegada']))
          {
              $this->bloq_hr_chegada = $this->NM_ajax_info['param']['bloq_hr_chegada'];
          }
          if (isset($this->NM_ajax_info['param']['bloq_hr_saida']))
          {
              $this->bloq_hr_saida = $this->NM_ajax_info['param']['bloq_hr_saida'];
          }
          if (isset($this->NM_ajax_info['param']['bloq_localizador']))
          {
              $this->bloq_localizador = $this->NM_ajax_info['param']['bloq_localizador'];
          }
          if (isset($this->NM_ajax_info['param']['bloq_nota_gate']))
          {
              $this->bloq_nota_gate = $this->NM_ajax_info['param']['bloq_nota_gate'];
          }
          if (isset($this->NM_ajax_info['param']['bloq_num_pass_etkt']))
          {
              $this->bloq_num_pass_etkt = $this->NM_ajax_info['param']['bloq_num_pass_etkt'];
          }
          if (isset($this->NM_ajax_info['param']['bloq_num_voo']))
          {
              $this->bloq_num_voo = $this->NM_ajax_info['param']['bloq_num_voo'];
          }
          if (isset($this->NM_ajax_info['param']['bloq_origem']))
          {
              $this->bloq_origem = $this->NM_ajax_info['param']['bloq_origem'];
          }
          if (isset($this->NM_ajax_info['param']['bloq_qtd_lugares']))
          {
              $this->bloq_qtd_lugares = $this->NM_ajax_info['param']['bloq_qtd_lugares'];
          }
          if (isset($this->NM_ajax_info['param']['bloq_saldo_lugares']))
          {
              $this->bloq_saldo_lugares = $this->NM_ajax_info['param']['bloq_saldo_lugares'];
          }
          if (isset($this->NM_ajax_info['param']['bloqueio_id']))
          {
              $this->bloqueio_id = $this->NM_ajax_info['param']['bloqueio_id'];
          }
          if (isset($this->NM_ajax_info['param']['csrf_token']))
          {
              $this->csrf_token = $this->NM_ajax_info['param']['csrf_token'];
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
      if (isset($this->vg_evento_id) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['vg_evento_id'] = $this->vg_evento_id;
      }
      if (isset($this->vg_guarda_valor) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['vg_guarda_valor'] = $this->vg_guarda_valor;
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
      if (isset($_POST["vg_guarda_valor"]) && isset($this->vg_guarda_valor)) 
      {
          $_SESSION['vg_guarda_valor'] = $this->vg_guarda_valor;
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
      if (isset($_GET["vg_guarda_valor"]) && isset($this->vg_guarda_valor)) 
      {
          $_SESSION['vg_guarda_valor'] = $this->vg_guarda_valor;
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
          $_SESSION['sc_session'][$script_case_init]['form_bloqueio_aereo_rsvp']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_bloqueio_aereo_rsvp']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_bloqueio_aereo_rsvp']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_bloqueio_aereo_rsvp']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['form_bloqueio_aereo_rsvp']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['form_bloqueio_aereo_rsvp']['embutida_parms']);
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
                 nm_limpa_str_form_bloqueio_aereo_rsvp($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
             }
             $ix++;
          }
          if (isset($this->inside_nested_grid) && 'Y' == $this->inside_nested_grid) {
              $_SESSION['sc_session'][$script_case_init]['form_bloqueio_aereo_rsvp']['inside_nested_iframe'] = true;
          }
          if (isset($this->vg_evento_id)) 
          {
              $_SESSION['vg_evento_id'] = $this->vg_evento_id;
          }
          if (isset($this->vg_guarda_valor)) 
          {
              $_SESSION['vg_guarda_valor'] = $this->vg_guarda_valor;
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
              $_SESSION['sc_session'][$script_case_init]['form_bloqueio_aereo_rsvp']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['form_bloqueio_aereo_rsvp']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['form_bloqueio_aereo_rsvp']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['form_bloqueio_aereo_rsvp']['sc_redir_insert'] = $this->sc_redir_insert;
              unset($_SESSION['sc_session'][$script_case_init]['form_bloqueio_aereo_rsvp']['opc_ant']);
          }
          if (isset($this->vg_evento_id)) 
          {
              $_SESSION['vg_evento_id'] = $this->vg_evento_id;
          }
          if (isset($this->vg_guarda_valor)) 
          {
              $_SESSION['vg_guarda_valor'] = $this->vg_guarda_valor;
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
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['form_bloqueio_aereo_rsvp']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['form_bloqueio_aereo_rsvp']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['form_bloqueio_aereo_rsvp']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['form_bloqueio_aereo_rsvp']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['form_bloqueio_aereo_rsvp']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['form_bloqueio_aereo_rsvp']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_bloqueio_aereo_rsvp']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['form_bloqueio_aereo_rsvp']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['form_bloqueio_aereo_rsvp']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['form_bloqueio_aereo_rsvp']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new form_bloqueio_aereo_rsvp_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("pt_br");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['initialize'];
          $this->Db = $this->Ini->Db; 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['initialize']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['initialize'])
          {
              $_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'on';
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
   $sErrorIndex = 'geral_form_bloqueio_aereo_rsvp';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_bloqueio_aereo_rsvp';
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
        $this->NM_ajax_info['redirExit']['action'] = "form_bloqueio_aereo_rsvp_fim.php?script_case_init=" . $this->form_encode_input($this->Ini->sc_page);
        $this->NM_ajax_info['redirExit']['metodo'] = 'location';
        $this->NM_ajax_info['redirExit']['target'] = "_self";
        $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $this->Ini->path_link . "" . SC_dir_app_name('WWW-Authenticate: <type> realm=<realm>') . "/";
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['sc_outra_jan'])
        {
            $_SESSION['scriptcase']['sc_outra_jan'] = "form_bloqueio_aereo_rsvp";
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['sc_outra_jan'] = false;
        }
        $_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'off';
        form_bloqueio_aereo_rsvp_pack_ajax_response();
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
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "form_bloqueio_aereo_rsvp";
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['sc_outra_jan'] = false;
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
        action="form_bloqueio_aereo_rsvp_fim.php"
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

$this->nm_mens_alert[] = "Não se esqueça de informar a quantidade de lugares disponíveis neste bloqueio!"; $this->nm_params_alert[] = array(); if ($this->NM_ajax_flag) { $this->sc_ajax_alert("Não se esqueça de informar a quantidade de lugares disponíveis neste bloqueio!"); }$sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'form_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';
if (isset($this->sc_temp_vg_usuario_id)) { $_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_vg_menu_item)) { $_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
if (isset($this->sc_temp_parm1)) { $_SESSION['parm1'] = $this->sc_temp_parm1;}
if (isset($this->sc_temp_vg_evento_id)) { $_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_cpfseg)) { $_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
if (isset($this->sc_temp_rsvp_global)) { $_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
$_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'off';
          }
          $this->Ini->init2();
      } 
      else 
      { 
         $this->nm_data = new nm_data("pt_br");
      } 
      $_SESSION['sc_session'][$script_case_init]['form_bloqueio_aereo_rsvp']['upload_field_info'] = array();

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_bloqueio_aereo_rsvp']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_bloqueio_aereo_rsvp'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_bloqueio_aereo_rsvp']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_bloqueio_aereo_rsvp']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('form_bloqueio_aereo_rsvp') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_bloqueio_aereo_rsvp']['label'] = "BRSVP - Cadastro de Bloqueio Aéreo - Alteração";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "form_bloqueio_aereo_rsvp")
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
      $this->nm_new_label['bloq_evento_id'] = 'Evento:';
      $this->nm_new_label['bloqueio_id'] = 'Cód. Bloqueio:';

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


      $this->arr_buttons['log']['hint']             = "Acesso ao LOG RSVP";
      $this->arr_buttons['log']['type']             = "button";
      $this->arr_buttons['log']['value']            = "LOG";
      $this->arr_buttons['log']['display']          = "text_fontawesomeicon";
      $this->arr_buttons['log']['display_position'] = "text_right";
      $this->arr_buttons['log']['style']            = "default";
      $this->arr_buttons['log']['image']            = "";
      $this->arr_buttons['log']['has_fa']            = "true";
      $this->arr_buttons['log']['fontawesomeicon']            = "";


      $_SESSION['scriptcase']['error_icon']['form_bloqueio_aereo_rsvp']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['form_bloqueio_aereo_rsvp'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['goto']      = 'on';
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
      $this->nmgp_botoes['LOG'] = "on";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_orig'] = "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_pesq'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_bloqueio_aereo_rsvp']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_bloqueio_aereo_rsvp'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_bloqueio_aereo_rsvp'];

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

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dados_form'];
          if (!isset($this->rodape)){$this->rodape = $this->nmgp_dados_form['rodape'];} 
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("form_bloqueio_aereo_rsvp", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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
      if (isset($_GET['nm_cal_display']))
      {
          if ($this->Embutida_proc)
          { 
              include_once($this->Ini->path_embutida . 'form_bloqueio_aereo_rsvp/form_bloqueio_aereo_rsvp_calendar.php');
          }
          else
          { 
              include_once($this->Ini->path_aplicacao . 'form_bloqueio_aereo_rsvp_calendar.php');
          }
          exit;
      }

      if (is_file($this->Ini->path_aplicacao . 'form_bloqueio_aereo_rsvp_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'form_bloqueio_aereo_rsvp_help.txt');
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
          require_once($this->Ini->path_embutida . 'form_bloqueio_aereo_rsvp/form_bloqueio_aereo_rsvp_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "form_bloqueio_aereo_rsvp_erro.class.php"); 
      }
      $this->Erro      = new form_bloqueio_aereo_rsvp_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if ($this->nmgp_opcao == "fast_search")  
      {
          $this->SC_fast_search($this->nmgp_fast_search, $this->nmgp_cond_fast_search, $this->nmgp_arg_fast_search);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['opcao'] = "inicio";
          $this->nmgp_opcao = "inicio";
          $this->proc_fast_search = true;
      } 
      if ((!isset($nm_opc_lookup) || $nm_opc_lookup != "lookup") && (!isset($nm_opc_php) || $nm_opc_php != "formphp"))
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['opcao']))
         { 
             if ($this->bloqueio_id != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['form_bloqueio_aereo_rsvp']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "novo")  
      {
          $this->nmgp_botoes['LOG'] = "off";
      }
      elseif ($this->nmgp_opcao == "incluir")  
      {
          $this->nmgp_botoes['LOG'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['botoes']['LOG'];
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dados_form'];
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
      $_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_bloq_saldo_lugares = $this->bloq_saldo_lugares;
}
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
;
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Acesso Negado!";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_form_bloqueio_aereo_rsvp';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_bloqueio_aereo_rsvp';
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
        $this->NM_ajax_info['redirExit']['action'] = "form_bloqueio_aereo_rsvp_fim.php?script_case_init=" . $this->form_encode_input($this->Ini->sc_page);
        $this->NM_ajax_info['redirExit']['metodo'] = 'location';
        $this->NM_ajax_info['redirExit']['target'] = "_self";
        $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $this->Ini->path_link . "" . SC_dir_app_name('WWW-Authenticate: <type> realm=<realm>') . "/";
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['sc_outra_jan'])
        {
            $_SESSION['scriptcase']['sc_outra_jan'] = "form_bloqueio_aereo_rsvp";
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['sc_outra_jan'] = false;
        }
        $_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'off';
        form_bloqueio_aereo_rsvp_pack_ajax_response();
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
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "form_bloqueio_aereo_rsvp";
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['sc_outra_jan'] = false;
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
        action="form_bloqueio_aereo_rsvp_fim.php"
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



$nivel_usu = 'TESTE';
$sql="
	SELECT    
		usuario_id,usuario_nivel
	FROM
		usuarios_rsvp
	WHERE 
		usuario_id = ".$this->Db->qstr($this->sc_temp_vg_usuario_id)." 
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
	$nivel_usu = $this->rs[0][1];	
}				
if ( $nivel_usu == 'ADMINISTRADOR') {
	$this->sc_field_readonly("bloq_saldo_lugares", 'on');
$_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Field_disabled_macro']['bloq_saldo_lugares'] = array('I'=>array(),'U'=>array());
;
}
if (isset($this->sc_temp_vg_usuario_id)) { $_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_vg_menu_item)) { $_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
if (isset($this->sc_temp_parm1)) { $_SESSION['parm1'] = $this->sc_temp_parm1;}
if (isset($this->sc_temp_vg_evento_id)) { $_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_cpfseg)) { $_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
if (isset($this->sc_temp_rsvp_global)) { $_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (isset($Ctrl_Proc_Onload) && $Ctrl_Proc_Onload) {
        $Ctrl_Format = true;
        $this->nm_guardar_campos();
        if ($bFormat) $this->nm_formatar_campos();
    }
    if (($original_bloq_saldo_lugares != $this->bloq_saldo_lugares || (isset($bFlagRead_bloq_saldo_lugares) && $bFlagRead_bloq_saldo_lugares)))
    {
        $this->ajax_return_values_bloq_saldo_lugares(true);
    }
}
$_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'off'; 
      }
            if ('ajax_check_file' == $this->nmgp_opcao ){
                 ob_start(); 
                 global $bol_api_prod; 
                 $bol_api_prod = true; 
                 if (isset($_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['glo_nm_conexao'])) 
                 { 
                     $bol_api_prod = false;
                 } 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
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
      if (isset($this->bloqueio_id)) { $this->nm_limpa_alfa($this->bloqueio_id); }
      if (isset($this->bloq_evento_id)) { $this->nm_limpa_alfa($this->bloq_evento_id); }
      if (isset($this->bloq_descricao)) { $this->nm_limpa_alfa($this->bloq_descricao); }
      if (isset($this->bloq_cia_aerea)) { $this->nm_limpa_alfa($this->bloq_cia_aerea); }
      if (isset($this->bloq_direcao)) { $this->nm_limpa_alfa($this->bloq_direcao); }
      if (isset($this->bloq_origem)) { $this->nm_limpa_alfa($this->bloq_origem); }
      if (isset($this->bloq_destino)) { $this->nm_limpa_alfa($this->bloq_destino); }
      if (isset($this->bloq_num_voo)) { $this->nm_limpa_alfa($this->bloq_num_voo); }
      if (isset($this->bloq_num_pass_etkt)) { $this->nm_limpa_alfa($this->bloq_num_pass_etkt); }
      if (isset($this->bloq_localizador)) { $this->nm_limpa_alfa($this->bloq_localizador); }
      if (isset($this->bloq_qtd_lugares)) { $this->nm_limpa_alfa($this->bloq_qtd_lugares); }
      if (isset($this->bloq_saldo_lugares)) { $this->nm_limpa_alfa($this->bloq_saldo_lugares); }
      if (isset($this->bloq_nota_gate)) { $this->nm_limpa_alfa($this->bloq_nota_gate); }
      $Campos_Crit       = "";
      $Campos_erro       = "";
      $Campos_Falta      = array();
      $Campos_Erros      = array();
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          =  substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
      //-- bloqueio_id
      $this->field_config['bloqueio_id']               = array();
      $this->field_config['bloqueio_id']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['bloqueio_id']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['bloqueio_id']['symbol_dec'] = '';
      $this->field_config['bloqueio_id']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['bloqueio_id']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- bloq_dt_saida
      $this->field_config['bloq_dt_saida']                 = array();
      $this->field_config['bloq_dt_saida']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['bloq_dt_saida']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['bloq_dt_saida']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'bloq_dt_saida');
      //-- bloq_hr_saida
      $this->field_config['bloq_hr_saida']                 = array();
      $this->field_config['bloq_hr_saida']['date_format']  = $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['bloq_hr_saida']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['bloq_hr_saida']['date_display'] = "hhii";
      $this->new_date_format('HH', 'bloq_hr_saida');
      //-- bloq_dt_chegada
      $this->field_config['bloq_dt_chegada']                 = array();
      $this->field_config['bloq_dt_chegada']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['bloq_dt_chegada']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['bloq_dt_chegada']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'bloq_dt_chegada');
      //-- bloq_hr_chegada
      $this->field_config['bloq_hr_chegada']                 = array();
      $this->field_config['bloq_hr_chegada']['date_format']  = $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['bloq_hr_chegada']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['bloq_hr_chegada']['date_display'] = "hhii";
      $this->new_date_format('HH', 'bloq_hr_chegada');
      //-- bloq_qtd_lugares
      $this->field_config['bloq_qtd_lugares']               = array();
      $this->field_config['bloq_qtd_lugares']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['bloq_qtd_lugares']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['bloq_qtd_lugares']['symbol_dec'] = '';
      $this->field_config['bloq_qtd_lugares']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['bloq_qtd_lugares']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- bloq_saldo_lugares
      $this->field_config['bloq_saldo_lugares']               = array();
      $this->field_config['bloq_saldo_lugares']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['bloq_saldo_lugares']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['bloq_saldo_lugares']['symbol_dec'] = '';
      $this->field_config['bloq_saldo_lugares']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['bloq_saldo_lugares']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- bloq_dt_nota_gate
      $this->field_config['bloq_dt_nota_gate']                 = array();
      $this->field_config['bloq_dt_nota_gate']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['bloq_dt_nota_gate']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['bloq_dt_nota_gate']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'bloq_dt_nota_gate');
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
          if ('validate_bloqueio_id' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'bloqueio_id');
          }
          if ('validate_bloq_evento_id' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'bloq_evento_id');
          }
          if ('validate_bloq_descricao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'bloq_descricao');
          }
          if ('validate_bloq_direcao' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'bloq_direcao');
          }
          if ('validate_bloq_cia_aerea' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'bloq_cia_aerea');
          }
          if ('validate_bloq_origem' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'bloq_origem');
          }
          if ('validate_bloq_destino' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'bloq_destino');
          }
          if ('validate_bloq_dt_saida' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'bloq_dt_saida');
          }
          if ('validate_bloq_hr_saida' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'bloq_hr_saida');
          }
          if ('validate_bloq_dt_chegada' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'bloq_dt_chegada');
          }
          if ('validate_bloq_hr_chegada' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'bloq_hr_chegada');
          }
          if ('validate_bloq_num_voo' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'bloq_num_voo');
          }
          if ('validate_bloq_num_pass_etkt' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'bloq_num_pass_etkt');
          }
          if ('validate_bloq_localizador' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'bloq_localizador');
          }
          if ('validate_bloq_qtd_lugares' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'bloq_qtd_lugares');
          }
          if ('validate_bloq_saldo_lugares' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'bloq_saldo_lugares');
          }
          if ('validate_bloq_nota_gate' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'bloq_nota_gate');
          }
          if ('validate_bloq_dt_nota_gate' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'bloq_dt_nota_gate');
          }
          form_bloqueio_aereo_rsvp_pack_ajax_response();
          exit;
      }
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6))
      {
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          if ('event_bloq_cia_aerea_onchange' == $this->NM_ajax_opcao)
          {
              $this->bloq_cia_aerea_onChange();
          }
          if ('event_bloq_qtd_lugares_onchange' == $this->NM_ajax_opcao)
          {
              $this->bloq_qtd_lugares_onChange();
          }
          form_bloqueio_aereo_rsvp_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          $this->nm_acessa_banco();
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              form_bloqueio_aereo_rsvp_pack_ajax_response();
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
          $_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  form_bloqueio_aereo_rsvp_pack_ajax_response();
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_evento == "insert" || ($this->nmgp_opc_ant == "novo" && $this->nmgp_opcao == "novo" && $this->sc_evento == "novo"))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['sc_redir_atualiz'] == "ok")
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
          form_bloqueio_aereo_rsvp_pack_ajax_response();
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
          form_bloqueio_aereo_rsvp_pack_ajax_response();
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
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "form_bloqueio_aereo_rsvp.zip";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("BRSVP - Cadastro de Bloqueio Aéreo - Alteração") ?></TITLE>
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
<form name="Fdown" method="get" action="form_bloqueio_aereo_rsvp_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="form_bloqueio_aereo_rsvp"> 
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
           case 'bloqueio_id':
               return "Cód. Bloqueio:";
               break;
           case 'bloq_evento_id':
               return "Evento:";
               break;
           case 'bloq_descricao':
               return "Descrição:";
               break;
           case 'bloq_direcao':
               return "Direção:";
               break;
           case 'bloq_cia_aerea':
               return "Cia. Aérea:";
               break;
           case 'bloq_origem':
               return "Origem:";
               break;
           case 'bloq_destino':
               return "Destino:";
               break;
           case 'bloq_dt_saida':
               return "Data Sáida:";
               break;
           case 'bloq_hr_saida':
               return "Hora Saída:";
               break;
           case 'bloq_dt_chegada':
               return "Data Chegada:";
               break;
           case 'bloq_hr_chegada':
               return "Hora Chegada:";
               break;
           case 'bloq_num_voo':
               return "Número Voo:";
               break;
           case 'bloq_num_pass_etkt':
               return "Num. Passagem (ETKT):";
               break;
           case 'bloq_localizador':
               return " Localizador:";
               break;
           case 'bloq_qtd_lugares':
               return "Qtd. Lugares";
               break;
           case 'bloq_saldo_lugares':
               return "Lugares Restantes:";
               break;
           case 'bloq_nota_gate':
               return "Núm. Nota Gate:";
               break;
           case 'bloq_dt_nota_gate':
               return "Data Nota Gate:";
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

     if (!is_array($filtro) && '' == $filtro && isset($this->nm_form_submit) && '1' == $this->nm_form_submit && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['csrf_token']) && $this->scCsrfGetToken() != $this->csrf_token)
     {
          $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
          $this->Campos_Mens_erro .= "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          if ($this->NM_ajax_flag)
          {
              if (!isset($this->NM_ajax_info['errList']['geral_form_bloqueio_aereo_rsvp']) || !is_array($this->NM_ajax_info['errList']['geral_form_bloqueio_aereo_rsvp']))
              {
                  $this->NM_ajax_info['errList']['geral_form_bloqueio_aereo_rsvp'] = array();
              }
              $this->NM_ajax_info['errList']['geral_form_bloqueio_aereo_rsvp'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ((!is_array($filtro) && ('' == $filtro || 'bloqueio_id' == $filtro)) || (is_array($filtro) && in_array('bloqueio_id', $filtro)))
        $this->ValidateField_bloqueio_id($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'bloq_evento_id' == $filtro)) || (is_array($filtro) && in_array('bloq_evento_id', $filtro)))
        $this->ValidateField_bloq_evento_id($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'bloq_descricao' == $filtro)) || (is_array($filtro) && in_array('bloq_descricao', $filtro)))
        $this->ValidateField_bloq_descricao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'bloq_direcao' == $filtro)) || (is_array($filtro) && in_array('bloq_direcao', $filtro)))
        $this->ValidateField_bloq_direcao($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'bloq_cia_aerea' == $filtro)) || (is_array($filtro) && in_array('bloq_cia_aerea', $filtro)))
        $this->ValidateField_bloq_cia_aerea($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'bloq_origem' == $filtro)) || (is_array($filtro) && in_array('bloq_origem', $filtro)))
        $this->ValidateField_bloq_origem($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'bloq_destino' == $filtro)) || (is_array($filtro) && in_array('bloq_destino', $filtro)))
        $this->ValidateField_bloq_destino($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'bloq_dt_saida' == $filtro)) || (is_array($filtro) && in_array('bloq_dt_saida', $filtro)))
        $this->ValidateField_bloq_dt_saida($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'bloq_hr_saida' == $filtro)) || (is_array($filtro) && in_array('bloq_hr_saida', $filtro)))
        $this->ValidateField_bloq_hr_saida($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'bloq_dt_chegada' == $filtro)) || (is_array($filtro) && in_array('bloq_dt_chegada', $filtro)))
        $this->ValidateField_bloq_dt_chegada($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'bloq_hr_chegada' == $filtro)) || (is_array($filtro) && in_array('bloq_hr_chegada', $filtro)))
        $this->ValidateField_bloq_hr_chegada($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'bloq_num_voo' == $filtro)) || (is_array($filtro) && in_array('bloq_num_voo', $filtro)))
        $this->ValidateField_bloq_num_voo($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'bloq_num_pass_etkt' == $filtro)) || (is_array($filtro) && in_array('bloq_num_pass_etkt', $filtro)))
        $this->ValidateField_bloq_num_pass_etkt($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'bloq_localizador' == $filtro)) || (is_array($filtro) && in_array('bloq_localizador', $filtro)))
        $this->ValidateField_bloq_localizador($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'bloq_qtd_lugares' == $filtro)) || (is_array($filtro) && in_array('bloq_qtd_lugares', $filtro)))
        $this->ValidateField_bloq_qtd_lugares($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'bloq_saldo_lugares' == $filtro)) || (is_array($filtro) && in_array('bloq_saldo_lugares', $filtro)))
        $this->ValidateField_bloq_saldo_lugares($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'bloq_nota_gate' == $filtro)) || (is_array($filtro) && in_array('bloq_nota_gate', $filtro)))
        $this->ValidateField_bloq_nota_gate($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'bloq_dt_nota_gate' == $filtro)) || (is_array($filtro) && in_array('bloq_dt_nota_gate', $filtro)))
        $this->ValidateField_bloq_dt_nota_gate($Campos_Crit, $Campos_Falta, $Campos_Erros);
//-- converter datas   
          $this->nm_converte_datas();
//---
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

    function ValidateField_bloqueio_id(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['bloqueio_id'])) {
          nm_limpa_numero($this->bloqueio_id, $this->field_config['bloqueio_id']['symbol_grp']) ; 
          return;
      }
      if ($this->bloqueio_id === "" || is_null($this->bloqueio_id))  
      { 
          $this->bloqueio_id = 0;
      } 
      nm_limpa_numero($this->bloqueio_id, $this->field_config['bloqueio_id']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_bloqueio_id' == $this->NM_ajax_opcao)
      { 
          if ($this->bloqueio_id != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->bloqueio_id) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Cód. Bloqueio:: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['bloqueio_id']))
                  {
                      $Campos_Erros['bloqueio_id'] = array();
                  }
                  $Campos_Erros['bloqueio_id'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['bloqueio_id']) || !is_array($this->NM_ajax_info['errList']['bloqueio_id']))
                  {
                      $this->NM_ajax_info['errList']['bloqueio_id'] = array();
                  }
                  $this->NM_ajax_info['errList']['bloqueio_id'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->bloqueio_id, 11, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Cód. Bloqueio:; " ; 
                  if (!isset($Campos_Erros['bloqueio_id']))
                  {
                      $Campos_Erros['bloqueio_id'] = array();
                  }
                  $Campos_Erros['bloqueio_id'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['bloqueio_id']) || !is_array($this->NM_ajax_info['errList']['bloqueio_id']))
                  {
                      $this->NM_ajax_info['errList']['bloqueio_id'] = array();
                  }
                  $this->NM_ajax_info['errList']['bloqueio_id'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'bloqueio_id';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_bloqueio_id

    function ValidateField_bloq_evento_id(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['bloq_evento_id'])) {
       return;
   }
      if ($this->bloq_evento_id == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_evento_id']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_evento_id'] == "on"))
      {
          $hasError = true;
          $Campos_Falta[] = "Evento:" ; 
          if (!isset($Campos_Erros['bloq_evento_id']))
          {
              $Campos_Erros['bloq_evento_id'] = array();
          }
          $Campos_Erros['bloq_evento_id'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['bloq_evento_id']) || !is_array($this->NM_ajax_info['errList']['bloq_evento_id']))
          {
              $this->NM_ajax_info['errList']['bloq_evento_id'] = array();
          }
          $this->NM_ajax_info['errList']['bloq_evento_id'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->bloq_evento_id) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_evento_id']) && !in_array($this->bloq_evento_id, $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_evento_id']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['bloq_evento_id']))
              {
                  $Campos_Erros['bloq_evento_id'] = array();
              }
              $Campos_Erros['bloq_evento_id'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['bloq_evento_id']) || !is_array($this->NM_ajax_info['errList']['bloq_evento_id']))
              {
                  $this->NM_ajax_info['errList']['bloq_evento_id'] = array();
              }
              $this->NM_ajax_info['errList']['bloq_evento_id'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'bloq_evento_id';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_bloq_evento_id

    function ValidateField_bloq_descricao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['bloq_descricao'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_descricao']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_descricao'] == "on")) 
      { 
          if ($this->bloq_descricao == "")  
          { 
              $hasError = true;
              $Campos_Falta[] =  "Descrição:" ; 
              if (!isset($Campos_Erros['bloq_descricao']))
              {
                  $Campos_Erros['bloq_descricao'] = array();
              }
              $Campos_Erros['bloq_descricao'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['bloq_descricao']) || !is_array($this->NM_ajax_info['errList']['bloq_descricao']))
                  {
                      $this->NM_ajax_info['errList']['bloq_descricao'] = array();
                  }
                  $this->NM_ajax_info['errList']['bloq_descricao'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->bloq_descricao) > 80) 
          { 
              $hasError = true;
              $Campos_Crit .= "Descrição: " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 80 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['bloq_descricao']))
              {
                  $Campos_Erros['bloq_descricao'] = array();
              }
              $Campos_Erros['bloq_descricao'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 80 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['bloq_descricao']) || !is_array($this->NM_ajax_info['errList']['bloq_descricao']))
              {
                  $this->NM_ajax_info['errList']['bloq_descricao'] = array();
              }
              $this->NM_ajax_info['errList']['bloq_descricao'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 80 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'bloq_descricao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_bloq_descricao

    function ValidateField_bloq_direcao(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['bloq_direcao'])) {
       return;
   }
      if ($this->bloq_direcao == "" && $this->nmgp_opcao != "excluir")
      { 
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_direcao']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_direcao'] == "on")
        { 
          $hasError = true;
          $Campos_Falta[] = "Direção:" ; 
          if (!isset($Campos_Erros['bloq_direcao']))
          {
              $Campos_Erros['bloq_direcao'] = array();
          }
          $Campos_Erros['bloq_direcao'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['bloq_direcao']) || !is_array($this->NM_ajax_info['errList']['bloq_direcao']))
                  {
                      $this->NM_ajax_info['errList']['bloq_direcao'] = array();
                  }
                  $this->NM_ajax_info['errList']['bloq_direcao'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
        } 
      } 
      if ($this->bloq_direcao != "" && !in_array("bloq_direcao", $this->sc_force_zero))
      { 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_direcao']) && !in_array($this->bloq_direcao, $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_direcao']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['bloq_direcao']))
              {
                  $Campos_Erros['bloq_direcao'] = array();
              }
              $Campos_Erros['bloq_direcao'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['bloq_direcao']) || !is_array($this->NM_ajax_info['errList']['bloq_direcao']))
              {
                  $this->NM_ajax_info['errList']['bloq_direcao'] = array();
              }
              $this->NM_ajax_info['errList']['bloq_direcao'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
      }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'bloq_direcao';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_bloq_direcao

    function ValidateField_bloq_cia_aerea(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['bloq_cia_aerea'])) {
       return;
   }
      if ($this->bloq_cia_aerea == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_cia_aerea']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_cia_aerea'] == "on"))
      {
          $hasError = true;
          $Campos_Falta[] = "Cia. Aérea:" ; 
          if (!isset($Campos_Erros['bloq_cia_aerea']))
          {
              $Campos_Erros['bloq_cia_aerea'] = array();
          }
          $Campos_Erros['bloq_cia_aerea'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['bloq_cia_aerea']) || !is_array($this->NM_ajax_info['errList']['bloq_cia_aerea']))
          {
              $this->NM_ajax_info['errList']['bloq_cia_aerea'] = array();
          }
          $this->NM_ajax_info['errList']['bloq_cia_aerea'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->bloq_cia_aerea) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea']) && !in_array($this->bloq_cia_aerea, $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['bloq_cia_aerea']))
              {
                  $Campos_Erros['bloq_cia_aerea'] = array();
              }
              $Campos_Erros['bloq_cia_aerea'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['bloq_cia_aerea']) || !is_array($this->NM_ajax_info['errList']['bloq_cia_aerea']))
              {
                  $this->NM_ajax_info['errList']['bloq_cia_aerea'] = array();
              }
              $this->NM_ajax_info['errList']['bloq_cia_aerea'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'bloq_cia_aerea';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_bloq_cia_aerea

    function ValidateField_bloq_origem(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['bloq_origem'])) {
       return;
   }
      if ($this->bloq_origem == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_origem']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_origem'] == "on"))
      {
          $hasError = true;
          $Campos_Falta[] = "Origem:" ; 
          if (!isset($Campos_Erros['bloq_origem']))
          {
              $Campos_Erros['bloq_origem'] = array();
          }
          $Campos_Erros['bloq_origem'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['bloq_origem']) || !is_array($this->NM_ajax_info['errList']['bloq_origem']))
          {
              $this->NM_ajax_info['errList']['bloq_origem'] = array();
          }
          $this->NM_ajax_info['errList']['bloq_origem'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->bloq_origem) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem']) && !in_array($this->bloq_origem, $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['bloq_origem']))
              {
                  $Campos_Erros['bloq_origem'] = array();
              }
              $Campos_Erros['bloq_origem'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['bloq_origem']) || !is_array($this->NM_ajax_info['errList']['bloq_origem']))
              {
                  $this->NM_ajax_info['errList']['bloq_origem'] = array();
              }
              $this->NM_ajax_info['errList']['bloq_origem'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'bloq_origem';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_bloq_origem

    function ValidateField_bloq_destino(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['bloq_destino'])) {
       return;
   }
      if ($this->bloq_destino == "" && $this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_destino']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_destino'] == "on"))
      {
          $hasError = true;
          $Campos_Falta[] = "Destino:" ; 
          if (!isset($Campos_Erros['bloq_destino']))
          {
              $Campos_Erros['bloq_destino'] = array();
          }
          $Campos_Erros['bloq_destino'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          if (!isset($this->NM_ajax_info['errList']['bloq_destino']) || !is_array($this->NM_ajax_info['errList']['bloq_destino']))
          {
              $this->NM_ajax_info['errList']['bloq_destino'] = array();
          }
          $this->NM_ajax_info['errList']['bloq_destino'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
      }
          if (!empty($this->bloq_destino) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino']) && !in_array($this->bloq_destino, $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino']))
          {
              $hasError = true;
              $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($Campos_Erros['bloq_destino']))
              {
                  $Campos_Erros['bloq_destino'] = array();
              }
              $Campos_Erros['bloq_destino'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
              if (!isset($this->NM_ajax_info['errList']['bloq_destino']) || !is_array($this->NM_ajax_info['errList']['bloq_destino']))
              {
                  $this->NM_ajax_info['errList']['bloq_destino'] = array();
              }
              $this->NM_ajax_info['errList']['bloq_destino'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
          }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'bloq_destino';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_bloq_destino

    function ValidateField_bloq_dt_saida(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->bloq_dt_saida, $this->field_config['bloq_dt_saida']['date_sep']) ; 
      if (isset($this->Field_no_validate['bloq_dt_saida'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['bloq_dt_saida']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['bloq_dt_saida']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['bloq_dt_saida']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['bloq_dt_saida']['date_sep']) ; 
          if (trim($this->bloq_dt_saida) != "")  
          { 
              $validateTest = $teste_validade->Data($this->bloq_dt_saida, $Format_Data, $trab_dt_min, $trab_dt_max);
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Data Sáida:; " ; 
                  if (!isset($Campos_Erros['bloq_dt_saida']))
                  {
                      $Campos_Erros['bloq_dt_saida'] = array();
                  }
                  $Campos_Erros['bloq_dt_saida'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['bloq_dt_saida']) || !is_array($this->NM_ajax_info['errList']['bloq_dt_saida']))
                  {
                      $this->NM_ajax_info['errList']['bloq_dt_saida'] = array();
                  }
                  $this->NM_ajax_info['errList']['bloq_dt_saida'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_dt_saida']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_dt_saida'] == "on") 
           { 
              $hasError = true;
              $Campos_Falta[] = "Data Sáida:" ; 
              if (!isset($Campos_Erros['bloq_dt_saida']))
              {
                  $Campos_Erros['bloq_dt_saida'] = array();
              }
              $Campos_Erros['bloq_dt_saida'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['bloq_dt_saida']) || !is_array($this->NM_ajax_info['errList']['bloq_dt_saida']))
                  {
                      $this->NM_ajax_info['errList']['bloq_dt_saida'] = array();
                  }
                  $this->NM_ajax_info['errList']['bloq_dt_saida'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
           } 
          $this->field_config['bloq_dt_saida']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'bloq_dt_saida';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_bloq_dt_saida

    function ValidateField_bloq_hr_saida(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_hora($this->bloq_hr_saida, $this->field_config['bloq_hr_saida']['time_sep']) ; 
      if (isset($this->Field_no_validate['bloq_hr_saida'])) {
          return;
      }
      $trab_hr_min = "";
      $trab_hr_max = "";
      if ($this->nmgp_opcao != "excluir") 
      {
          $Format_Hora = $this->field_config['bloq_hr_saida']['date_format']; 
          nm_limpa_hora($Format_Hora, $this->field_config['bloq_hr_saida']['time_sep']) ; 
          if (trim($this->bloq_hr_saida) != "")  
          { 
              if ($teste_validade->Hora($this->bloq_hr_saida, $Format_Hora, $trab_hr_min, $trab_hr_max) == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Hora Saída:; " ; 
                  if (!isset($Campos_Erros['bloq_hr_saida']))
                  {
                      $Campos_Erros['bloq_hr_saida'] = array();
                  }
                  $Campos_Erros['bloq_hr_saida'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['bloq_hr_saida']) || !is_array($this->NM_ajax_info['errList']['bloq_hr_saida']))
                  {
                      $this->NM_ajax_info['errList']['bloq_hr_saida'] = array();
                  }
                  $this->NM_ajax_info['errList']['bloq_hr_saida'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_hr_saida']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_hr_saida'] == "on") 
           { 
              $hasError = true;
              $Campos_Falta[] = "Hora Saída:" ; 
              if (!isset($Campos_Erros['bloq_hr_saida']))
              {
                  $Campos_Erros['bloq_hr_saida'] = array();
              }
              $Campos_Erros['bloq_hr_saida'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['bloq_hr_saida']) || !is_array($this->NM_ajax_info['errList']['bloq_hr_saida']))
                  {
                      $this->NM_ajax_info['errList']['bloq_hr_saida'] = array();
                  }
                  $this->NM_ajax_info['errList']['bloq_hr_saida'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
           } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'bloq_hr_saida';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_bloq_hr_saida

    function ValidateField_bloq_dt_chegada(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->bloq_dt_chegada, $this->field_config['bloq_dt_chegada']['date_sep']) ; 
      if (isset($this->Field_no_validate['bloq_dt_chegada'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['bloq_dt_chegada']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['bloq_dt_chegada']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['bloq_dt_chegada']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['bloq_dt_chegada']['date_sep']) ; 
          if (trim($this->bloq_dt_chegada) != "")  
          { 
              $validateTest = $teste_validade->Data($this->bloq_dt_chegada, $Format_Data, $trab_dt_min, $trab_dt_max);
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Data Chegada:; " ; 
                  if (!isset($Campos_Erros['bloq_dt_chegada']))
                  {
                      $Campos_Erros['bloq_dt_chegada'] = array();
                  }
                  $Campos_Erros['bloq_dt_chegada'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['bloq_dt_chegada']) || !is_array($this->NM_ajax_info['errList']['bloq_dt_chegada']))
                  {
                      $this->NM_ajax_info['errList']['bloq_dt_chegada'] = array();
                  }
                  $this->NM_ajax_info['errList']['bloq_dt_chegada'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_dt_chegada']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_dt_chegada'] == "on") 
           { 
              $hasError = true;
              $Campos_Falta[] = "Data Chegada:" ; 
              if (!isset($Campos_Erros['bloq_dt_chegada']))
              {
                  $Campos_Erros['bloq_dt_chegada'] = array();
              }
              $Campos_Erros['bloq_dt_chegada'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['bloq_dt_chegada']) || !is_array($this->NM_ajax_info['errList']['bloq_dt_chegada']))
                  {
                      $this->NM_ajax_info['errList']['bloq_dt_chegada'] = array();
                  }
                  $this->NM_ajax_info['errList']['bloq_dt_chegada'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
           } 
          $this->field_config['bloq_dt_chegada']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'bloq_dt_chegada';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_bloq_dt_chegada

    function ValidateField_bloq_hr_chegada(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_hora($this->bloq_hr_chegada, $this->field_config['bloq_hr_chegada']['time_sep']) ; 
      if (isset($this->Field_no_validate['bloq_hr_chegada'])) {
          return;
      }
      $trab_hr_min = "";
      $trab_hr_max = "";
      if ($this->nmgp_opcao != "excluir") 
      {
          $Format_Hora = $this->field_config['bloq_hr_chegada']['date_format']; 
          nm_limpa_hora($Format_Hora, $this->field_config['bloq_hr_chegada']['time_sep']) ; 
          if (trim($this->bloq_hr_chegada) != "")  
          { 
              if ($teste_validade->Hora($this->bloq_hr_chegada, $Format_Hora, $trab_hr_min, $trab_hr_max) == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Hora Chegada:; " ; 
                  if (!isset($Campos_Erros['bloq_hr_chegada']))
                  {
                      $Campos_Erros['bloq_hr_chegada'] = array();
                  }
                  $Campos_Erros['bloq_hr_chegada'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['bloq_hr_chegada']) || !is_array($this->NM_ajax_info['errList']['bloq_hr_chegada']))
                  {
                      $this->NM_ajax_info['errList']['bloq_hr_chegada'] = array();
                  }
                  $this->NM_ajax_info['errList']['bloq_hr_chegada'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
           elseif (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_hr_chegada']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_hr_chegada'] == "on") 
           { 
              $hasError = true;
              $Campos_Falta[] = "Hora Chegada:" ; 
              if (!isset($Campos_Erros['bloq_hr_chegada']))
              {
                  $Campos_Erros['bloq_hr_chegada'] = array();
              }
              $Campos_Erros['bloq_hr_chegada'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['bloq_hr_chegada']) || !is_array($this->NM_ajax_info['errList']['bloq_hr_chegada']))
                  {
                      $this->NM_ajax_info['errList']['bloq_hr_chegada'] = array();
                  }
                  $this->NM_ajax_info['errList']['bloq_hr_chegada'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
           } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'bloq_hr_chegada';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_bloq_hr_chegada

    function ValidateField_bloq_num_voo(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['bloq_num_voo'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_num_voo']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_num_voo'] == "on")) 
      { 
          if ($this->bloq_num_voo == "")  
          { 
              $hasError = true;
              $Campos_Falta[] =  "Número Voo:" ; 
              if (!isset($Campos_Erros['bloq_num_voo']))
              {
                  $Campos_Erros['bloq_num_voo'] = array();
              }
              $Campos_Erros['bloq_num_voo'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['bloq_num_voo']) || !is_array($this->NM_ajax_info['errList']['bloq_num_voo']))
                  {
                      $this->NM_ajax_info['errList']['bloq_num_voo'] = array();
                  }
                  $this->NM_ajax_info['errList']['bloq_num_voo'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->bloq_num_voo) > 10) 
          { 
              $hasError = true;
              $Campos_Crit .= "Número Voo: " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 10 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['bloq_num_voo']))
              {
                  $Campos_Erros['bloq_num_voo'] = array();
              }
              $Campos_Erros['bloq_num_voo'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 10 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['bloq_num_voo']) || !is_array($this->NM_ajax_info['errList']['bloq_num_voo']))
              {
                  $this->NM_ajax_info['errList']['bloq_num_voo'] = array();
              }
              $this->NM_ajax_info['errList']['bloq_num_voo'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 10 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'bloq_num_voo';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_bloq_num_voo

    function ValidateField_bloq_num_pass_etkt(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['bloq_num_pass_etkt'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_num_pass_etkt']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_num_pass_etkt'] == "on")) 
      { 
          if ($this->bloq_num_pass_etkt == "")  
          { 
              $hasError = true;
              $Campos_Falta[] =  "Num. Passagem (ETKT):" ; 
              if (!isset($Campos_Erros['bloq_num_pass_etkt']))
              {
                  $Campos_Erros['bloq_num_pass_etkt'] = array();
              }
              $Campos_Erros['bloq_num_pass_etkt'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
                  if (!isset($this->NM_ajax_info['errList']['bloq_num_pass_etkt']) || !is_array($this->NM_ajax_info['errList']['bloq_num_pass_etkt']))
                  {
                      $this->NM_ajax_info['errList']['bloq_num_pass_etkt'] = array();
                  }
                  $this->NM_ajax_info['errList']['bloq_num_pass_etkt'][] = $this->Ini->Nm_lang['lang_errm_ajax_rqrd'];
          } 
      } 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->bloq_num_pass_etkt) > 10) 
          { 
              $hasError = true;
              $Campos_Crit .= "Num. Passagem (ETKT): " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 10 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['bloq_num_pass_etkt']))
              {
                  $Campos_Erros['bloq_num_pass_etkt'] = array();
              }
              $Campos_Erros['bloq_num_pass_etkt'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 10 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['bloq_num_pass_etkt']) || !is_array($this->NM_ajax_info['errList']['bloq_num_pass_etkt']))
              {
                  $this->NM_ajax_info['errList']['bloq_num_pass_etkt'] = array();
              }
              $this->NM_ajax_info['errList']['bloq_num_pass_etkt'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 10 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'bloq_num_pass_etkt';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_bloq_num_pass_etkt

    function ValidateField_bloq_localizador(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['bloq_localizador'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->bloq_localizador) > 20) 
          { 
              $hasError = true;
              $Campos_Crit .= " Localizador: " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['bloq_localizador']))
              {
                  $Campos_Erros['bloq_localizador'] = array();
              }
              $Campos_Erros['bloq_localizador'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['bloq_localizador']) || !is_array($this->NM_ajax_info['errList']['bloq_localizador']))
              {
                  $this->NM_ajax_info['errList']['bloq_localizador'] = array();
              }
              $this->NM_ajax_info['errList']['bloq_localizador'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'bloq_localizador';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_bloq_localizador

    function ValidateField_bloq_qtd_lugares(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['bloq_qtd_lugares'])) {
          nm_limpa_numero($this->bloq_qtd_lugares, $this->field_config['bloq_qtd_lugares']['symbol_grp']) ; 
          return;
      }
      if ($this->bloq_qtd_lugares === "" || is_null($this->bloq_qtd_lugares))  
      { 
          $this->bloq_qtd_lugares = 0;
          $this->sc_force_zero[] = 'bloq_qtd_lugares';
      } 
      nm_limpa_numero($this->bloq_qtd_lugares, $this->field_config['bloq_qtd_lugares']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->bloq_qtd_lugares != '')  
          { 
              $iTestSize = 4;
              if (strlen($this->bloq_qtd_lugares) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Qtd. Lugares: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['bloq_qtd_lugares']))
                  {
                      $Campos_Erros['bloq_qtd_lugares'] = array();
                  }
                  $Campos_Erros['bloq_qtd_lugares'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['bloq_qtd_lugares']) || !is_array($this->NM_ajax_info['errList']['bloq_qtd_lugares']))
                  {
                      $this->NM_ajax_info['errList']['bloq_qtd_lugares'] = array();
                  }
                  $this->NM_ajax_info['errList']['bloq_qtd_lugares'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->bloq_qtd_lugares, 4, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Qtd. Lugares; " ; 
                  if (!isset($Campos_Erros['bloq_qtd_lugares']))
                  {
                      $Campos_Erros['bloq_qtd_lugares'] = array();
                  }
                  $Campos_Erros['bloq_qtd_lugares'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['bloq_qtd_lugares']) || !is_array($this->NM_ajax_info['errList']['bloq_qtd_lugares']))
                  {
                      $this->NM_ajax_info['errList']['bloq_qtd_lugares'] = array();
                  }
                  $this->NM_ajax_info['errList']['bloq_qtd_lugares'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'bloq_qtd_lugares';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_bloq_qtd_lugares

    function ValidateField_bloq_saldo_lugares(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['bloq_saldo_lugares'])) {
          nm_limpa_numero($this->bloq_saldo_lugares, $this->field_config['bloq_saldo_lugares']['symbol_grp']) ; 
          return;
      }
      if ($this->bloq_saldo_lugares === "" || is_null($this->bloq_saldo_lugares))  
      { 
          $this->bloq_saldo_lugares = 0;
          $this->sc_force_zero[] = 'bloq_saldo_lugares';
      } 
      nm_limpa_numero($this->bloq_saldo_lugares, $this->field_config['bloq_saldo_lugares']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->bloq_saldo_lugares != '')  
          { 
              $iTestSize = 4;
              if (strlen($this->bloq_saldo_lugares) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Lugares Restantes:: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['bloq_saldo_lugares']))
                  {
                      $Campos_Erros['bloq_saldo_lugares'] = array();
                  }
                  $Campos_Erros['bloq_saldo_lugares'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['bloq_saldo_lugares']) || !is_array($this->NM_ajax_info['errList']['bloq_saldo_lugares']))
                  {
                      $this->NM_ajax_info['errList']['bloq_saldo_lugares'] = array();
                  }
                  $this->NM_ajax_info['errList']['bloq_saldo_lugares'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->bloq_saldo_lugares, 4, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Lugares Restantes:; " ; 
                  if (!isset($Campos_Erros['bloq_saldo_lugares']))
                  {
                      $Campos_Erros['bloq_saldo_lugares'] = array();
                  }
                  $Campos_Erros['bloq_saldo_lugares'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['bloq_saldo_lugares']) || !is_array($this->NM_ajax_info['errList']['bloq_saldo_lugares']))
                  {
                      $this->NM_ajax_info['errList']['bloq_saldo_lugares'] = array();
                  }
                  $this->NM_ajax_info['errList']['bloq_saldo_lugares'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'bloq_saldo_lugares';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_bloq_saldo_lugares

    function ValidateField_bloq_nota_gate(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['bloq_nota_gate'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->bloq_nota_gate) > 10) 
          { 
              $hasError = true;
              $Campos_Crit .= "Núm. Nota Gate: " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 10 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['bloq_nota_gate']))
              {
                  $Campos_Erros['bloq_nota_gate'] = array();
              }
              $Campos_Erros['bloq_nota_gate'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 10 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['bloq_nota_gate']) || !is_array($this->NM_ajax_info['errList']['bloq_nota_gate']))
              {
                  $this->NM_ajax_info['errList']['bloq_nota_gate'] = array();
              }
              $this->NM_ajax_info['errList']['bloq_nota_gate'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 10 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'bloq_nota_gate';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_bloq_nota_gate

    function ValidateField_bloq_dt_nota_gate(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->bloq_dt_nota_gate, $this->field_config['bloq_dt_nota_gate']['date_sep']) ; 
      if (isset($this->Field_no_validate['bloq_dt_nota_gate'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['bloq_dt_nota_gate']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['bloq_dt_nota_gate']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['bloq_dt_nota_gate']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['bloq_dt_nota_gate']['date_sep']) ; 
          if (trim($this->bloq_dt_nota_gate) != "")  
          { 
              $validateTest = $teste_validade->Data($this->bloq_dt_nota_gate, $Format_Data, $trab_dt_min, $trab_dt_max);
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Data Nota Gate:; " ; 
                  if (!isset($Campos_Erros['bloq_dt_nota_gate']))
                  {
                      $Campos_Erros['bloq_dt_nota_gate'] = array();
                  }
                  $Campos_Erros['bloq_dt_nota_gate'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['bloq_dt_nota_gate']) || !is_array($this->NM_ajax_info['errList']['bloq_dt_nota_gate']))
                  {
                      $this->NM_ajax_info['errList']['bloq_dt_nota_gate'] = array();
                  }
                  $this->NM_ajax_info['errList']['bloq_dt_nota_gate'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['bloq_dt_nota_gate']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'bloq_dt_nota_gate';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_bloq_dt_nota_gate

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
    $this->nmgp_dados_form['bloqueio_id'] = $this->bloqueio_id;
    $this->nmgp_dados_form['bloq_evento_id'] = $this->bloq_evento_id;
    $this->nmgp_dados_form['bloq_descricao'] = $this->bloq_descricao;
    $this->nmgp_dados_form['bloq_direcao'] = $this->bloq_direcao;
    $this->nmgp_dados_form['bloq_cia_aerea'] = $this->bloq_cia_aerea;
    $this->nmgp_dados_form['bloq_origem'] = $this->bloq_origem;
    $this->nmgp_dados_form['bloq_destino'] = $this->bloq_destino;
    $this->nmgp_dados_form['bloq_dt_saida'] = (strlen(trim($this->bloq_dt_saida)) > 19) ? str_replace(".", ":", $this->bloq_dt_saida) : trim($this->bloq_dt_saida);
    $this->nmgp_dados_form['bloq_hr_saida'] = (strlen(trim($this->bloq_hr_saida)) > 19) ? str_replace(".", ":", $this->bloq_hr_saida) : trim($this->bloq_hr_saida);
    $this->nmgp_dados_form['bloq_dt_chegada'] = (strlen(trim($this->bloq_dt_chegada)) > 19) ? str_replace(".", ":", $this->bloq_dt_chegada) : trim($this->bloq_dt_chegada);
    $this->nmgp_dados_form['bloq_hr_chegada'] = (strlen(trim($this->bloq_hr_chegada)) > 19) ? str_replace(".", ":", $this->bloq_hr_chegada) : trim($this->bloq_hr_chegada);
    $this->nmgp_dados_form['bloq_num_voo'] = $this->bloq_num_voo;
    $this->nmgp_dados_form['bloq_num_pass_etkt'] = $this->bloq_num_pass_etkt;
    $this->nmgp_dados_form['bloq_localizador'] = $this->bloq_localizador;
    $this->nmgp_dados_form['bloq_qtd_lugares'] = $this->bloq_qtd_lugares;
    $this->nmgp_dados_form['bloq_saldo_lugares'] = $this->bloq_saldo_lugares;
    $this->nmgp_dados_form['bloq_nota_gate'] = $this->bloq_nota_gate;
    $this->nmgp_dados_form['bloq_dt_nota_gate'] = (strlen(trim($this->bloq_dt_nota_gate)) > 19) ? str_replace(".", ":", $this->bloq_dt_nota_gate) : trim($this->bloq_dt_nota_gate);
    $this->nmgp_dados_form['rodape'] = $this->rodape;
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
      $this->Before_unformat['bloqueio_id'] = $this->bloqueio_id;
      nm_limpa_numero($this->bloqueio_id, $this->field_config['bloqueio_id']['symbol_grp']) ; 
      $this->Before_unformat['bloq_dt_saida'] = $this->bloq_dt_saida;
      nm_limpa_data($this->bloq_dt_saida, $this->field_config['bloq_dt_saida']['date_sep']) ; 
      $this->Before_unformat['bloq_hr_saida'] = $this->bloq_hr_saida;
      nm_limpa_hora($this->bloq_hr_saida, $this->field_config['bloq_hr_saida']['time_sep']) ; 
      $this->Before_unformat['bloq_dt_chegada'] = $this->bloq_dt_chegada;
      nm_limpa_data($this->bloq_dt_chegada, $this->field_config['bloq_dt_chegada']['date_sep']) ; 
      $this->Before_unformat['bloq_hr_chegada'] = $this->bloq_hr_chegada;
      nm_limpa_hora($this->bloq_hr_chegada, $this->field_config['bloq_hr_chegada']['time_sep']) ; 
      $this->Before_unformat['bloq_qtd_lugares'] = $this->bloq_qtd_lugares;
      nm_limpa_numero($this->bloq_qtd_lugares, $this->field_config['bloq_qtd_lugares']['symbol_grp']) ; 
      $this->Before_unformat['bloq_saldo_lugares'] = $this->bloq_saldo_lugares;
      nm_limpa_numero($this->bloq_saldo_lugares, $this->field_config['bloq_saldo_lugares']['symbol_grp']) ; 
      $this->Before_unformat['bloq_dt_nota_gate'] = $this->bloq_dt_nota_gate;
      nm_limpa_data($this->bloq_dt_nota_gate, $this->field_config['bloq_dt_nota_gate']['date_sep']) ; 
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
      if ($Nome_Campo == "bloqueio_id")
      {
          nm_limpa_numero($this->bloqueio_id, $this->field_config['bloqueio_id']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "bloq_qtd_lugares")
      {
          nm_limpa_numero($this->bloq_qtd_lugares, $this->field_config['bloq_qtd_lugares']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "bloq_saldo_lugares")
      {
          nm_limpa_numero($this->bloq_saldo_lugares, $this->field_config['bloq_saldo_lugares']['symbol_grp']) ; 
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
      if ('' !== $this->bloqueio_id || (!empty($format_fields) && isset($format_fields['bloqueio_id'])))
      {
          nmgp_Form_Num_Val($this->bloqueio_id, $this->field_config['bloqueio_id']['symbol_grp'], $this->field_config['bloqueio_id']['symbol_dec'], "0", "S", $this->field_config['bloqueio_id']['format_neg'], "", "", "-", $this->field_config['bloqueio_id']['symbol_fmt']) ; 
      }
      if ((!empty($this->bloq_dt_saida) && 'null' != $this->bloq_dt_saida) || (!empty($format_fields) && isset($format_fields['bloq_dt_saida'])))
      {
          nm_volta_data($this->bloq_dt_saida, $this->field_config['bloq_dt_saida']['date_format']) ; 
          nmgp_Form_Datas($this->bloq_dt_saida, $this->field_config['bloq_dt_saida']['date_format'], $this->field_config['bloq_dt_saida']['date_sep']) ;  
      }
      elseif ('null' == $this->bloq_dt_saida || '' == $this->bloq_dt_saida)
      {
          $this->bloq_dt_saida = '';
      }
      if ((!empty($this->bloq_hr_saida) && 'null' != $this->bloq_hr_saida) || (!empty($format_fields) && isset($format_fields['bloq_hr_saida'])))
      {
          nm_volta_hora($this->bloq_hr_saida, $this->field_config['bloq_hr_saida']['date_format']) ; 
          nmgp_Form_Hora($this->bloq_hr_saida, $this->field_config['bloq_hr_saida']['date_format'], $this->field_config['bloq_hr_saida']['time_sep']) ;  
      }
      elseif ('null' == $this->bloq_hr_saida || '' == $this->bloq_hr_saida)
      {
          $this->bloq_hr_saida = '';
      }
      if ((!empty($this->bloq_dt_chegada) && 'null' != $this->bloq_dt_chegada) || (!empty($format_fields) && isset($format_fields['bloq_dt_chegada'])))
      {
          nm_volta_data($this->bloq_dt_chegada, $this->field_config['bloq_dt_chegada']['date_format']) ; 
          nmgp_Form_Datas($this->bloq_dt_chegada, $this->field_config['bloq_dt_chegada']['date_format'], $this->field_config['bloq_dt_chegada']['date_sep']) ;  
      }
      elseif ('null' == $this->bloq_dt_chegada || '' == $this->bloq_dt_chegada)
      {
          $this->bloq_dt_chegada = '';
      }
      if ((!empty($this->bloq_hr_chegada) && 'null' != $this->bloq_hr_chegada) || (!empty($format_fields) && isset($format_fields['bloq_hr_chegada'])))
      {
          nm_volta_hora($this->bloq_hr_chegada, $this->field_config['bloq_hr_chegada']['date_format']) ; 
          nmgp_Form_Hora($this->bloq_hr_chegada, $this->field_config['bloq_hr_chegada']['date_format'], $this->field_config['bloq_hr_chegada']['time_sep']) ;  
      }
      elseif ('null' == $this->bloq_hr_chegada || '' == $this->bloq_hr_chegada)
      {
          $this->bloq_hr_chegada = '';
      }
      if ('' !== $this->bloq_qtd_lugares || (!empty($format_fields) && isset($format_fields['bloq_qtd_lugares'])))
      {
          nmgp_Form_Num_Val($this->bloq_qtd_lugares, $this->field_config['bloq_qtd_lugares']['symbol_grp'], $this->field_config['bloq_qtd_lugares']['symbol_dec'], "0", "S", $this->field_config['bloq_qtd_lugares']['format_neg'], "", "", "-", $this->field_config['bloq_qtd_lugares']['symbol_fmt']) ; 
      }
      if ('' !== $this->bloq_saldo_lugares || (!empty($format_fields) && isset($format_fields['bloq_saldo_lugares'])))
      {
          nmgp_Form_Num_Val($this->bloq_saldo_lugares, $this->field_config['bloq_saldo_lugares']['symbol_grp'], $this->field_config['bloq_saldo_lugares']['symbol_dec'], "0", "S", $this->field_config['bloq_saldo_lugares']['format_neg'], "", "", "-", $this->field_config['bloq_saldo_lugares']['symbol_fmt']) ; 
      }
      if ((!empty($this->bloq_dt_nota_gate) && 'null' != $this->bloq_dt_nota_gate) || (!empty($format_fields) && isset($format_fields['bloq_dt_nota_gate'])))
      {
          nm_volta_data($this->bloq_dt_nota_gate, $this->field_config['bloq_dt_nota_gate']['date_format']) ; 
          nmgp_Form_Datas($this->bloq_dt_nota_gate, $this->field_config['bloq_dt_nota_gate']['date_format'], $this->field_config['bloq_dt_nota_gate']['date_sep']) ;  
      }
      elseif ('null' == $this->bloq_dt_nota_gate || '' == $this->bloq_dt_nota_gate)
      {
          $this->bloq_dt_nota_gate = '';
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
      $guarda_format_hora = $this->field_config['bloq_dt_saida']['date_format'];
      if ($this->bloq_dt_saida != "")  
      { 
          nm_conv_data($this->bloq_dt_saida, $this->field_config['bloq_dt_saida']['date_format']) ; 
          $this->bloq_dt_saida_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->bloq_dt_saida_hora = substr($this->bloq_dt_saida_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->bloq_dt_saida_hora = substr($this->bloq_dt_saida_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->bloq_dt_saida_hora = substr($this->bloq_dt_saida_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->bloq_dt_saida_hora = substr($this->bloq_dt_saida_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->bloq_dt_saida_hora = substr($this->bloq_dt_saida_hora, 0, -4);
          }
      } 
      if ($this->bloq_dt_saida == "" && $use_null)  
      { 
          $this->bloq_dt_saida = "null" ; 
      } 
      $this->field_config['bloq_dt_saida']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['bloq_hr_saida']['date_format'];
      if ($this->bloq_hr_saida != "")  
      { 
          $this->bloq_hr_saida_hora = $this->bloq_hr_saida;
          $this->bloq_hr_saida = "1900-01-01";
          nm_conv_hora($this->bloq_hr_saida_hora, $this->field_config['bloq_hr_saida']['date_format']) ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->bloq_hr_saida_hora = substr($this->bloq_hr_saida_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->bloq_hr_saida_hora = substr($this->bloq_hr_saida_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->bloq_hr_saida_hora = substr($this->bloq_hr_saida_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->bloq_hr_saida_hora = substr($this->bloq_hr_saida_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->bloq_hr_saida_hora = substr($this->bloq_hr_saida_hora, 0, -4);
          }
          $this->bloq_hr_saida = $this->bloq_hr_saida_hora;
      } 
      if ($this->bloq_hr_saida == "" && $use_null)  
      { 
          $this->bloq_hr_saida = "null" ; 
      } 
      $this->field_config['bloq_hr_saida']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['bloq_dt_chegada']['date_format'];
      if ($this->bloq_dt_chegada != "")  
      { 
          nm_conv_data($this->bloq_dt_chegada, $this->field_config['bloq_dt_chegada']['date_format']) ; 
          $this->bloq_dt_chegada_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->bloq_dt_chegada_hora = substr($this->bloq_dt_chegada_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->bloq_dt_chegada_hora = substr($this->bloq_dt_chegada_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->bloq_dt_chegada_hora = substr($this->bloq_dt_chegada_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->bloq_dt_chegada_hora = substr($this->bloq_dt_chegada_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->bloq_dt_chegada_hora = substr($this->bloq_dt_chegada_hora, 0, -4);
          }
      } 
      if ($this->bloq_dt_chegada == "" && $use_null)  
      { 
          $this->bloq_dt_chegada = "null" ; 
      } 
      $this->field_config['bloq_dt_chegada']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['bloq_hr_chegada']['date_format'];
      if ($this->bloq_hr_chegada != "")  
      { 
          $this->bloq_hr_chegada_hora = $this->bloq_hr_chegada;
          $this->bloq_hr_chegada = "1900-01-01";
          nm_conv_hora($this->bloq_hr_chegada_hora, $this->field_config['bloq_hr_chegada']['date_format']) ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->bloq_hr_chegada_hora = substr($this->bloq_hr_chegada_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->bloq_hr_chegada_hora = substr($this->bloq_hr_chegada_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->bloq_hr_chegada_hora = substr($this->bloq_hr_chegada_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->bloq_hr_chegada_hora = substr($this->bloq_hr_chegada_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->bloq_hr_chegada_hora = substr($this->bloq_hr_chegada_hora, 0, -4);
          }
          $this->bloq_hr_chegada = $this->bloq_hr_chegada_hora;
      } 
      if ($this->bloq_hr_chegada == "" && $use_null)  
      { 
          $this->bloq_hr_chegada = "null" ; 
      } 
      $this->field_config['bloq_hr_chegada']['date_format'] = $guarda_format_hora;
      $guarda_format_hora = $this->field_config['bloq_dt_nota_gate']['date_format'];
      if ($this->bloq_dt_nota_gate != "")  
      { 
          nm_conv_data($this->bloq_dt_nota_gate, $this->field_config['bloq_dt_nota_gate']['date_format']) ; 
          $this->bloq_dt_nota_gate_hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->bloq_dt_nota_gate_hora = substr($this->bloq_dt_nota_gate_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->bloq_dt_nota_gate_hora = substr($this->bloq_dt_nota_gate_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->bloq_dt_nota_gate_hora = substr($this->bloq_dt_nota_gate_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->bloq_dt_nota_gate_hora = substr($this->bloq_dt_nota_gate_hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->bloq_dt_nota_gate_hora = substr($this->bloq_dt_nota_gate_hora, 0, -4);
          }
      } 
      if ($this->bloq_dt_nota_gate == "" && $use_null)  
      { 
          $this->bloq_dt_nota_gate = "null" ; 
      } 
      $this->field_config['bloq_dt_nota_gate']['date_format'] = $guarda_format_hora;
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
          $this->ajax_return_values_bloqueio_id();
          $this->ajax_return_values_bloq_evento_id();
          $this->ajax_return_values_bloq_descricao();
          $this->ajax_return_values_bloq_direcao();
          $this->ajax_return_values_bloq_cia_aerea();
          $this->ajax_return_values_bloq_origem();
          $this->ajax_return_values_bloq_destino();
          $this->ajax_return_values_bloq_dt_saida();
          $this->ajax_return_values_bloq_hr_saida();
          $this->ajax_return_values_bloq_dt_chegada();
          $this->ajax_return_values_bloq_hr_chegada();
          $this->ajax_return_values_bloq_num_voo();
          $this->ajax_return_values_bloq_num_pass_etkt();
          $this->ajax_return_values_bloq_localizador();
          $this->ajax_return_values_bloq_qtd_lugares();
          $this->ajax_return_values_bloq_saldo_lugares();
          $this->ajax_return_values_bloq_nota_gate();
          $this->ajax_return_values_bloq_dt_nota_gate();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
              $this->NM_ajax_info['fldList']['bloqueio_id']['keyVal'] = form_bloqueio_aereo_rsvp_pack_protect_string($this->nmgp_dados_form['bloqueio_id']);
          }
   } // ajax_return_values

          //----- bloqueio_id
   function ajax_return_values_bloqueio_id($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("bloqueio_id", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->bloqueio_id);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['bloqueio_id'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
               'labList' => array($this->form_format_readonly("bloqueio_id", $this->form_encode_input($sTmpValue))),
              );
          }
   }

          //----- bloq_evento_id
   function ajax_return_values_bloq_evento_id($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("bloq_evento_id", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->bloq_evento_id);
              $aLookup = array();
              $this->_tmp_lookup_bloq_evento_id = $this->bloq_evento_id;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_evento_id']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_evento_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_evento_id']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_evento_id'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_bloqueio_id = $this->bloqueio_id;
   $old_value_bloq_dt_saida = $this->bloq_dt_saida;
   $old_value_bloq_hr_saida = $this->bloq_hr_saida;
   $old_value_bloq_dt_chegada = $this->bloq_dt_chegada;
   $old_value_bloq_hr_chegada = $this->bloq_hr_chegada;
   $old_value_bloq_qtd_lugares = $this->bloq_qtd_lugares;
   $old_value_bloq_saldo_lugares = $this->bloq_saldo_lugares;
   $old_value_bloq_dt_nota_gate = $this->bloq_dt_nota_gate;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_bloqueio_id = $this->bloqueio_id;
   $unformatted_value_bloq_dt_saida = $this->bloq_dt_saida;
   $unformatted_value_bloq_hr_saida = $this->bloq_hr_saida;
   $unformatted_value_bloq_dt_chegada = $this->bloq_dt_chegada;
   $unformatted_value_bloq_hr_chegada = $this->bloq_hr_chegada;
   $unformatted_value_bloq_qtd_lugares = $this->bloq_qtd_lugares;
   $unformatted_value_bloq_saldo_lugares = $this->bloq_saldo_lugares;
   $unformatted_value_bloq_dt_nota_gate = $this->bloq_dt_nota_gate;

   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   {
       $nm_comando = "SELECT evento_id, evento_nome + ' - Cod.: ' + evento_id  FROM eventos_rsvp WHERE evento_id = " . $_SESSION['vg_evento_id'] . " ORDER BY evento_nome, evento_id";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   {
       $nm_comando = "SELECT evento_id, concat(evento_nome,' - Cod.: ',evento_id)  FROM eventos_rsvp WHERE evento_id = " . $_SESSION['vg_evento_id'] . " ORDER BY evento_nome, evento_id";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
   {
       $nm_comando = "SELECT evento_id, evento_nome&' - Cod.: '&evento_id  FROM eventos_rsvp WHERE evento_id = " . $_SESSION['vg_evento_id'] . " ORDER BY evento_nome, evento_id";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
   {
       $nm_comando = "SELECT evento_id, evento_nome||' - Cod.: '||evento_id  FROM eventos_rsvp WHERE evento_id = " . $_SESSION['vg_evento_id'] . " ORDER BY evento_nome, evento_id";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   {
       $nm_comando = "SELECT evento_id, evento_nome + ' - Cod.: ' + convert(char,evento_id)  FROM eventos_rsvp WHERE evento_id = " . $_SESSION['vg_evento_id'] . " ORDER BY evento_nome, evento_id";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
   {
       $nm_comando = "SELECT evento_id, evento_nome||' - Cod.: '||char(evento_id)  FROM eventos_rsvp WHERE evento_id = " . $_SESSION['vg_evento_id'] . " ORDER BY evento_nome, evento_id";
   }
   else
   {
       $nm_comando = "SELECT evento_id, evento_nome||' - Cod.: '||evento_id  FROM eventos_rsvp WHERE evento_id = " . $_SESSION['vg_evento_id'] . " ORDER BY evento_nome, evento_id";
   }

   $this->bloqueio_id = $old_value_bloqueio_id;
   $this->bloq_dt_saida = $old_value_bloq_dt_saida;
   $this->bloq_hr_saida = $old_value_bloq_hr_saida;
   $this->bloq_dt_chegada = $old_value_bloq_dt_chegada;
   $this->bloq_hr_chegada = $old_value_bloq_hr_chegada;
   $this->bloq_qtd_lugares = $old_value_bloq_qtd_lugares;
   $this->bloq_saldo_lugares = $old_value_bloq_saldo_lugares;
   $this->bloq_dt_nota_gate = $old_value_bloq_dt_nota_gate;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(form_bloqueio_aereo_rsvp_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', form_bloqueio_aereo_rsvp_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_evento_id'][] = $rs->fields[0];
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
          $sSelComp = "name=\"bloq_evento_id\"";
          if (isset($this->NM_ajax_info['select_html']['bloq_evento_id']) && !empty($this->NM_ajax_info['select_html']['bloq_evento_id']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['bloq_evento_id']);
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

                  if ($this->bloq_evento_id == $sValue)
                  {
                      $this->_tmp_lookup_bloq_evento_id = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['bloq_evento_id'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['bloq_evento_id']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['bloq_evento_id']['valList'][$i] = form_bloqueio_aereo_rsvp_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['bloq_evento_id']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['bloq_evento_id']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['bloq_evento_id']['labList'] = $aLabel;
          }
   }

          //----- bloq_descricao
   function ajax_return_values_bloq_descricao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("bloq_descricao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->bloq_descricao);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['bloq_descricao'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- bloq_direcao
   function ajax_return_values_bloq_direcao($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("bloq_direcao", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->bloq_direcao);
              $aLookup = array();
              $this->_tmp_lookup_bloq_direcao = $this->bloq_direcao;

$aLookup[] = array(form_bloqueio_aereo_rsvp_pack_protect_string('IDA') => str_replace('<', '&lt;',form_bloqueio_aereo_rsvp_pack_protect_string("Ida")));
$aLookup[] = array(form_bloqueio_aereo_rsvp_pack_protect_string('VOLTA') => str_replace('<', '&lt;',form_bloqueio_aereo_rsvp_pack_protect_string("Volta")));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_direcao'][] = 'IDA';
$_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_direcao'][] = 'VOLTA';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['bloq_direcao']) && !empty($this->NM_ajax_info['select_html']['bloq_direcao']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['bloq_direcao']);
          }
          $this->NM_ajax_info['fldList']['bloq_direcao'] = array(
                       'row'    => '',
               'type'    => 'radio',
               'switch'  => false,
               'valList' => array($sTmpValue),
               'colNum'  => 1,
               'optComp'  => $sOptComp,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['bloq_direcao']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['bloq_direcao']['valList'][$i] = form_bloqueio_aereo_rsvp_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['bloq_direcao']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['bloq_direcao']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['bloq_direcao']['labList'] = $aLabel;
          }
   }

          //----- bloq_cia_aerea
   function ajax_return_values_bloq_cia_aerea($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("bloq_cia_aerea", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->bloq_cia_aerea);
              $aLookup = array();
              $this->_tmp_lookup_bloq_cia_aerea = $this->bloq_cia_aerea;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea'] = array(); 
}
$aLookup[] = array(form_bloqueio_aereo_rsvp_pack_protect_string('') => str_replace('<', '&lt;',form_bloqueio_aereo_rsvp_pack_protect_string('.:selecione.:.')));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_bloqueio_id = $this->bloqueio_id;
   $old_value_bloq_dt_saida = $this->bloq_dt_saida;
   $old_value_bloq_hr_saida = $this->bloq_hr_saida;
   $old_value_bloq_dt_chegada = $this->bloq_dt_chegada;
   $old_value_bloq_hr_chegada = $this->bloq_hr_chegada;
   $old_value_bloq_qtd_lugares = $this->bloq_qtd_lugares;
   $old_value_bloq_saldo_lugares = $this->bloq_saldo_lugares;
   $old_value_bloq_dt_nota_gate = $this->bloq_dt_nota_gate;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_bloqueio_id = $this->bloqueio_id;
   $unformatted_value_bloq_dt_saida = $this->bloq_dt_saida;
   $unformatted_value_bloq_hr_saida = $this->bloq_hr_saida;
   $unformatted_value_bloq_dt_chegada = $this->bloq_dt_chegada;
   $unformatted_value_bloq_hr_chegada = $this->bloq_hr_chegada;
   $unformatted_value_bloq_qtd_lugares = $this->bloq_qtd_lugares;
   $unformatted_value_bloq_saldo_lugares = $this->bloq_saldo_lugares;
   $unformatted_value_bloq_dt_nota_gate = $this->bloq_dt_nota_gate;

   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   {
       $nm_comando = "SELECT cia_id, cia_nome + ' - ' + cia_sigla  FROM tbl_cia_aereas  WHERE cia_ativo = 'Y' ORDER BY cia_nome, cia_sigla";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   {
       $nm_comando = "SELECT cia_id, concat(cia_nome,' - ', cia_sigla)  FROM tbl_cia_aereas  WHERE cia_ativo = 'Y' ORDER BY cia_nome, cia_sigla";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
   {
       $nm_comando = "SELECT cia_id, cia_nome&' - '&cia_sigla  FROM tbl_cia_aereas  WHERE cia_ativo = 'Y' ORDER BY cia_nome, cia_sigla";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
   {
       $nm_comando = "SELECT cia_id, cia_nome||' - '||cia_sigla  FROM tbl_cia_aereas  WHERE cia_ativo = 'Y' ORDER BY cia_nome, cia_sigla";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   {
       $nm_comando = "SELECT cia_id, cia_nome + ' - ' + cia_sigla  FROM tbl_cia_aereas  WHERE cia_ativo = 'Y' ORDER BY cia_nome, cia_sigla";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
   {
       $nm_comando = "SELECT cia_id, cia_nome||' - '||cia_sigla  FROM tbl_cia_aereas  WHERE cia_ativo = 'Y' ORDER BY cia_nome, cia_sigla";
   }
   else
   {
       $nm_comando = "SELECT cia_id, cia_nome||' - '||cia_sigla  FROM tbl_cia_aereas  WHERE cia_ativo = 'Y' ORDER BY cia_nome, cia_sigla";
   }

   $this->bloqueio_id = $old_value_bloqueio_id;
   $this->bloq_dt_saida = $old_value_bloq_dt_saida;
   $this->bloq_hr_saida = $old_value_bloq_hr_saida;
   $this->bloq_dt_chegada = $old_value_bloq_dt_chegada;
   $this->bloq_hr_chegada = $old_value_bloq_hr_chegada;
   $this->bloq_qtd_lugares = $old_value_bloq_qtd_lugares;
   $this->bloq_saldo_lugares = $old_value_bloq_saldo_lugares;
   $this->bloq_dt_nota_gate = $old_value_bloq_dt_nota_gate;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(form_bloqueio_aereo_rsvp_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', form_bloqueio_aereo_rsvp_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea'][] = $rs->fields[0];
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
          $sSelComp = "name=\"bloq_cia_aerea\"";
          if (isset($this->NM_ajax_info['select_html']['bloq_cia_aerea']) && !empty($this->NM_ajax_info['select_html']['bloq_cia_aerea']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['bloq_cia_aerea']);
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

                  if ($this->bloq_cia_aerea == $sValue)
                  {
                      $this->_tmp_lookup_bloq_cia_aerea = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['bloq_cia_aerea'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['bloq_cia_aerea']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['bloq_cia_aerea']['valList'][$i] = form_bloqueio_aereo_rsvp_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['bloq_cia_aerea']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['bloq_cia_aerea']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['bloq_cia_aerea']['labList'] = $aLabel;
          }
   }

          //----- bloq_origem
   function ajax_return_values_bloq_origem($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("bloq_origem", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->bloq_origem);
              $aLookup = array();
              $this->_tmp_lookup_bloq_origem = $this->bloq_origem;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem'] = array(); 
}
$aLookup[] = array(form_bloqueio_aereo_rsvp_pack_protect_string('') => str_replace('<', '&lt;',form_bloqueio_aereo_rsvp_pack_protect_string('.:selecione.:.')));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_bloqueio_id = $this->bloqueio_id;
   $old_value_bloq_dt_saida = $this->bloq_dt_saida;
   $old_value_bloq_hr_saida = $this->bloq_hr_saida;
   $old_value_bloq_dt_chegada = $this->bloq_dt_chegada;
   $old_value_bloq_hr_chegada = $this->bloq_hr_chegada;
   $old_value_bloq_qtd_lugares = $this->bloq_qtd_lugares;
   $old_value_bloq_saldo_lugares = $this->bloq_saldo_lugares;
   $old_value_bloq_dt_nota_gate = $this->bloq_dt_nota_gate;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_bloqueio_id = $this->bloqueio_id;
   $unformatted_value_bloq_dt_saida = $this->bloq_dt_saida;
   $unformatted_value_bloq_hr_saida = $this->bloq_hr_saida;
   $unformatted_value_bloq_dt_chegada = $this->bloq_dt_chegada;
   $unformatted_value_bloq_hr_chegada = $this->bloq_hr_chegada;
   $unformatted_value_bloq_qtd_lugares = $this->bloq_qtd_lugares;
   $unformatted_value_bloq_saldo_lugares = $this->bloq_saldo_lugares;
   $unformatted_value_bloq_dt_nota_gate = $this->bloq_dt_nota_gate;

   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO + ' - ' + SIGLA + ' - ' + NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   {
       $nm_comando = "SELECT COD_AEROPORTO, concat(NOM_AEROPORTO,' - ', SIGLA,' - ', NOM_CIDADE)  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO&' - '&SIGLA&' - '&NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO + ' - ' + SIGLA + ' - ' + NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   else
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }

   $this->bloqueio_id = $old_value_bloqueio_id;
   $this->bloq_dt_saida = $old_value_bloq_dt_saida;
   $this->bloq_hr_saida = $old_value_bloq_hr_saida;
   $this->bloq_dt_chegada = $old_value_bloq_dt_chegada;
   $this->bloq_hr_chegada = $old_value_bloq_hr_chegada;
   $this->bloq_qtd_lugares = $old_value_bloq_qtd_lugares;
   $this->bloq_saldo_lugares = $old_value_bloq_saldo_lugares;
   $this->bloq_dt_nota_gate = $old_value_bloq_dt_nota_gate;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(form_bloqueio_aereo_rsvp_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', form_bloqueio_aereo_rsvp_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem'][] = $rs->fields[0];
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
          $sSelComp = "name=\"bloq_origem\"";
          if (isset($this->NM_ajax_info['select_html']['bloq_origem']) && !empty($this->NM_ajax_info['select_html']['bloq_origem']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['bloq_origem']);
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

                  if ($this->bloq_origem == $sValue)
                  {
                      $this->_tmp_lookup_bloq_origem = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['bloq_origem'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['bloq_origem']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['bloq_origem']['valList'][$i] = form_bloqueio_aereo_rsvp_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['bloq_origem']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['bloq_origem']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['bloq_origem']['labList'] = $aLabel;
          }
   }

          //----- bloq_destino
   function ajax_return_values_bloq_destino($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("bloq_destino", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->bloq_destino);
              $aLookup = array();
              $this->_tmp_lookup_bloq_destino = $this->bloq_destino;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino'] = array(); 
}
$aLookup[] = array(form_bloqueio_aereo_rsvp_pack_protect_string('') => str_replace('<', '&lt;',form_bloqueio_aereo_rsvp_pack_protect_string('.:selecione.:.')));
$_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 

   $old_value_bloqueio_id = $this->bloqueio_id;
   $old_value_bloq_dt_saida = $this->bloq_dt_saida;
   $old_value_bloq_hr_saida = $this->bloq_hr_saida;
   $old_value_bloq_dt_chegada = $this->bloq_dt_chegada;
   $old_value_bloq_hr_chegada = $this->bloq_hr_chegada;
   $old_value_bloq_qtd_lugares = $this->bloq_qtd_lugares;
   $old_value_bloq_saldo_lugares = $this->bloq_saldo_lugares;
   $old_value_bloq_dt_nota_gate = $this->bloq_dt_nota_gate;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_bloqueio_id = $this->bloqueio_id;
   $unformatted_value_bloq_dt_saida = $this->bloq_dt_saida;
   $unformatted_value_bloq_hr_saida = $this->bloq_hr_saida;
   $unformatted_value_bloq_dt_chegada = $this->bloq_dt_chegada;
   $unformatted_value_bloq_hr_chegada = $this->bloq_hr_chegada;
   $unformatted_value_bloq_qtd_lugares = $this->bloq_qtd_lugares;
   $unformatted_value_bloq_saldo_lugares = $this->bloq_saldo_lugares;
   $unformatted_value_bloq_dt_nota_gate = $this->bloq_dt_nota_gate;

   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO + ' - ' + SIGLA + ' - ' + NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   {
       $nm_comando = "SELECT COD_AEROPORTO, concat(NOM_AEROPORTO,' - ', SIGLA,' - ', NOM_CIDADE)  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO&' - '&SIGLA&' - '&NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO + ' - ' + SIGLA + ' - ' + NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   else
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }

   $this->bloqueio_id = $old_value_bloqueio_id;
   $this->bloq_dt_saida = $old_value_bloq_dt_saida;
   $this->bloq_hr_saida = $old_value_bloq_hr_saida;
   $this->bloq_dt_chegada = $old_value_bloq_dt_chegada;
   $this->bloq_hr_chegada = $old_value_bloq_hr_chegada;
   $this->bloq_qtd_lugares = $old_value_bloq_qtd_lugares;
   $this->bloq_saldo_lugares = $old_value_bloq_saldo_lugares;
   $this->bloq_dt_nota_gate = $old_value_bloq_dt_nota_gate;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(form_bloqueio_aereo_rsvp_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', form_bloqueio_aereo_rsvp_pack_protect_string(NM_charset_to_utf8($rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino'][] = $rs->fields[0];
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
          $sSelComp = "name=\"bloq_destino\"";
          if (isset($this->NM_ajax_info['select_html']['bloq_destino']) && !empty($this->NM_ajax_info['select_html']['bloq_destino']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['bloq_destino']);
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

                  if ($this->bloq_destino == $sValue)
                  {
                      $this->_tmp_lookup_bloq_destino = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['bloq_destino'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['bloq_destino']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['bloq_destino']['valList'][$i] = form_bloqueio_aereo_rsvp_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['bloq_destino']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['bloq_destino']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['bloq_destino']['labList'] = $aLabel;
          }
   }

          //----- bloq_dt_saida
   function ajax_return_values_bloq_dt_saida($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("bloq_dt_saida", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->bloq_dt_saida);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['bloq_dt_saida'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- bloq_hr_saida
   function ajax_return_values_bloq_hr_saida($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("bloq_hr_saida", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->bloq_hr_saida);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['bloq_hr_saida'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- bloq_dt_chegada
   function ajax_return_values_bloq_dt_chegada($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("bloq_dt_chegada", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->bloq_dt_chegada);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['bloq_dt_chegada'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- bloq_hr_chegada
   function ajax_return_values_bloq_hr_chegada($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("bloq_hr_chegada", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->bloq_hr_chegada);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['bloq_hr_chegada'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- bloq_num_voo
   function ajax_return_values_bloq_num_voo($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("bloq_num_voo", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->bloq_num_voo);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['bloq_num_voo'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- bloq_num_pass_etkt
   function ajax_return_values_bloq_num_pass_etkt($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("bloq_num_pass_etkt", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->bloq_num_pass_etkt);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['bloq_num_pass_etkt'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- bloq_localizador
   function ajax_return_values_bloq_localizador($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("bloq_localizador", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->bloq_localizador);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['bloq_localizador'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- bloq_qtd_lugares
   function ajax_return_values_bloq_qtd_lugares($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("bloq_qtd_lugares", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->bloq_qtd_lugares);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['bloq_qtd_lugares'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- bloq_saldo_lugares
   function ajax_return_values_bloq_saldo_lugares($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("bloq_saldo_lugares", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->bloq_saldo_lugares);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['bloq_saldo_lugares'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- bloq_nota_gate
   function ajax_return_values_bloq_nota_gate($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("bloq_nota_gate", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->bloq_nota_gate);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['bloq_nota_gate'] = array(
                       'row'    => '',
               'type'    => 'text',
               'valList' => array($this->form_encode_input($sTmpValue)),
              );
          }
   }

          //----- bloq_dt_nota_gate
   function ajax_return_values_bloq_dt_nota_gate($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("bloq_dt_nota_gate", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->bloq_dt_nota_gate);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['bloq_dt_nota_gate'] = array(
                       'row'    => '',
               'type'    => 'text',
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['upload_dir'][$fieldName][] = $newName;
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
       $this->NM_ajax_info['btnVars']['var_btn_LOG_vg_campo_id'] = $this->form_encode_input($this->nmgp_dados_form['bloqueio_id']);
       $this->NM_ajax_info['summary_line'] = $this->getSummaryLine();
   } // ajax_add_parameters
  function nm_proc_onload($bFormat = true)
  {
      $Ctrl_Proc_Onload = true;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Field_no_validate'] = array();
      if (!$this->NM_ajax_flag || !isset($this->nmgp_refresh_fields)) {
      $_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_bloq_cia_aerea = $this->bloq_cia_aerea;
    $original_bloq_descricao = $this->bloq_descricao;
    $original_bloq_destino = $this->bloq_destino;
    $original_bloq_direcao = $this->bloq_direcao;
    $original_bloq_evento_id = $this->bloq_evento_id;
    $original_bloq_origem = $this->bloq_origem;
    $original_bloq_qtd_lugares = $this->bloq_qtd_lugares;
    $original_bloqueio_id = $this->bloqueio_id;
}
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
if (!isset($this->sc_temp_rsvp_global)) {$this->sc_temp_rsvp_global = (isset($_SESSION['rsvp_global'])) ? $_SESSION['rsvp_global'] : "";}
if (!isset($this->sc_temp_vg_guarda_valor)) {$this->sc_temp_vg_guarda_valor = (isset($_SESSION['vg_guarda_valor'])) ? $_SESSION['vg_guarda_valor'] : "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
  date_default_timezone_set('America/Sao_Paulo');
$evento = $this->sc_temp_vg_evento_id;
$this->sc_temp_vg_guarda_valor = $this->bloq_qtd_lugares ;
$sqlm="
	SELECT 
		COUNT(aereo_id_evento) AS qtdm
	FROM
		aereos_rsvp
	WHERE
		aereo_bloqueio_id = ".$this->Db->qstr($this->bloqueio_id )." 
	AND
		aereo_id_evento = ".$this->Db->qstr($evento)." 
	ORDER BY
		aereo_id_evento,id_aereo			
";
 
      $nm_select = $sqlm; 
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
	$_qtmd = $this->rs[0][0];
	if ($_qtmd > 0) {
		$this->NM_ajax_info['buttonDisplay']['delete'] = $this->nmgp_botoes["delete"] = 'off';;
	}	
}

if ($this->sc_evento == "alterar" || $this->sc_evento == "update") {	
	$sql_log  = $_SESSION['scriptcase']['sc_sql_ult_comando'];	
} elseif ($this->sc_evento == "incluir" || $this->sc_evento == "insert") {	
	$sql_log  = $_SESSION['scriptcase']['sc_sql_ult_comando'];
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
	$sql_log  = $sql_log .' ID: '.$id_Log;	
} elseif ($this->sc_evento == "excluir" || $this->sc_evento == "delete") {		
	$sql_log  = $_SESSION['scriptcase']['sc_sql_ult_comando'];
} else {
	$sql_log  = $_SESSION['scriptcase']['sc_sql_ult_comando'];	
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
	$retLog = true;	
} elseif ($this->sc_evento == "excluir" || $this->sc_evento == "delete") {	
	$acao = "EXCLUIR";	
	$retLog = true;	
} else {
	$acao = "ACESSO";
	$retLog = true;
}

$campo_cpf = $sc_tmp_field_name = '';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] ;
$campo_evt = $sc_tmp_field_name = 'bloq_evento_id';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] ;
$campo_id = $sc_tmp_field_name = 'bloqueio_id';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] ;

$vl_campo_id = $this->bloqueio_id ;
$vl_campo_cpf = ''; 
$vl_campo_evt = $this->bloq_evento_id ;
$tabela = 'bloqueio_aereo__rsvp';
$obs = 'Bloqueio: '.$this->bloq_descricao .' - Evento: '.$this->bloq_evento_id .' Origem: '.$this->bloq_origem .' Destino: '.$this->bloq_destino .' Direção: '.$this->bloq_direcao .'  Cia. Aérea'.$this->bloq_cia_aerea ;

if ($this->sc_temp_rsvp_global['log_rsvp'] == true) { 
	if ($acao == 'ATUALIZAR') {
		$retLog = $this->GravaLog($hora_now,$ip_usuario,$id_usuario,$global_cpf,$modulo,$aplicacao,$acao,$campo_id,$vl_campo_id,$campo_cpf,$vl_campo_cpf,$campo_evt,$vl_campo_evt,$tabela,$obs,$sql_log );				
	}
	if ($retLog == false) {
		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Erro ao Gravar LOG";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_form_bloqueio_aereo_rsvp';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_bloqueio_aereo_rsvp';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Erro ao Gravar LOG";
 }
;		
	}	
}
if (isset($this->sc_temp_vg_evento_id)) { $_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_guarda_valor)) { $_SESSION['vg_guarda_valor'] = $this->sc_temp_vg_guarda_valor;}
if (isset($this->sc_temp_rsvp_global)) { $_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
if (isset($this->sc_temp_vg_usuario_id)) { $_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (isset($Ctrl_Proc_Onload) && $Ctrl_Proc_Onload) {
        $Ctrl_Format = true;
        $this->nm_guardar_campos();
        if ($bFormat) $this->nm_formatar_campos();
    }
    if (($original_bloq_cia_aerea != $this->bloq_cia_aerea || (isset($bFlagRead_bloq_cia_aerea) && $bFlagRead_bloq_cia_aerea)))
    {
        $this->ajax_return_values_bloq_cia_aerea(true);
    }
    if (($original_bloq_descricao != $this->bloq_descricao || (isset($bFlagRead_bloq_descricao) && $bFlagRead_bloq_descricao)))
    {
        $this->ajax_return_values_bloq_descricao(true);
    }
    if (($original_bloq_destino != $this->bloq_destino || (isset($bFlagRead_bloq_destino) && $bFlagRead_bloq_destino)))
    {
        $this->ajax_return_values_bloq_destino(true);
    }
    if (($original_bloq_direcao != $this->bloq_direcao || (isset($bFlagRead_bloq_direcao) && $bFlagRead_bloq_direcao)))
    {
        $this->ajax_return_values_bloq_direcao(true);
    }
    if (($original_bloq_evento_id != $this->bloq_evento_id || (isset($bFlagRead_bloq_evento_id) && $bFlagRead_bloq_evento_id)))
    {
        $this->ajax_return_values_bloq_evento_id(true);
    }
    if (($original_bloq_origem != $this->bloq_origem || (isset($bFlagRead_bloq_origem) && $bFlagRead_bloq_origem)))
    {
        $this->ajax_return_values_bloq_origem(true);
    }
    if (($original_bloq_qtd_lugares != $this->bloq_qtd_lugares || (isset($bFlagRead_bloq_qtd_lugares) && $bFlagRead_bloq_qtd_lugares)))
    {
        $this->ajax_return_values_bloq_qtd_lugares(true);
    }
    if (($original_bloqueio_id != $this->bloqueio_id || (isset($bFlagRead_bloqueio_id) && $bFlagRead_bloqueio_id)))
    {
        $this->ajax_return_values_bloqueio_id(true);
    }
}
$_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'off'; 
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
    if ("excluir" == $this->nmgp_opcao) {
      $this->sc_evento = $this->nmgp_opcao;
      $_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_bloq_cia_aerea = $this->bloq_cia_aerea;
    $original_bloq_descricao = $this->bloq_descricao;
    $original_bloq_destino = $this->bloq_destino;
    $original_bloq_direcao = $this->bloq_direcao;
    $original_bloq_evento_id = $this->bloq_evento_id;
    $original_bloq_origem = $this->bloq_origem;
    $original_bloqueio_id = $this->bloqueio_id;
}
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
if (!isset($this->sc_temp_rsvp_global)) {$this->sc_temp_rsvp_global = (isset($_SESSION['rsvp_global'])) ? $_SESSION['rsvp_global'] : "";}
  date_default_timezone_set('America/Sao_Paulo');
$sql_log  = 'DELETE -> '.trim($sql_log );
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
}

$campo_cpf = $sc_tmp_field_name = '';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] ;
$campo_evt = $sc_tmp_field_name = 'bloq_evento_id';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] ;
$campo_id = $sc_tmp_field_name = 'bloqueio_id';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] ;

$vl_campo_id = $this->bloqueio_id ;
$vl_campo_cpf = ''; 
$vl_campo_evt = $this->bloq_evento_id ;
$tabela = 'bloqueio_aereo__rsvp';
$obs = 'Bloqueio: '.$this->bloq_descricao .' - Evento: '.$this->bloq_evento_id .' Origem: '.$this->bloq_origem .' Destino: '.$this->bloq_destino .' Direção: '.$this->bloq_direcao .'  Cia. Aérea'.$this->bloq_cia_aerea ;

if ($this->sc_temp_rsvp_global['log_rsvp'] == true) { 	
	$retLog = $this->GravaLog($hora_now,$ip_usuario,$id_usuario,$global_cpf,$modulo,$aplicacao,$acao,$campo_id,$vl_campo_id,$campo_cpf,$vl_campo_cpf,$campo_evt,$vl_campo_evt,$tabela,$obs,$sql_log );
	if ($retLog == false) {
		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Erro ao Gravar LOG";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_form_bloqueio_aereo_rsvp';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_bloqueio_aereo_rsvp';
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
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (isset($Ctrl_Proc_Onload) && $Ctrl_Proc_Onload) {
        $Ctrl_Format = true;
        $this->nm_guardar_campos();
        if ($bFormat) $this->nm_formatar_campos();
    }
    if (($original_bloq_cia_aerea != $this->bloq_cia_aerea || (isset($bFlagRead_bloq_cia_aerea) && $bFlagRead_bloq_cia_aerea)))
    {
        $this->ajax_return_values_bloq_cia_aerea(true);
    }
    if (($original_bloq_descricao != $this->bloq_descricao || (isset($bFlagRead_bloq_descricao) && $bFlagRead_bloq_descricao)))
    {
        $this->ajax_return_values_bloq_descricao(true);
    }
    if (($original_bloq_destino != $this->bloq_destino || (isset($bFlagRead_bloq_destino) && $bFlagRead_bloq_destino)))
    {
        $this->ajax_return_values_bloq_destino(true);
    }
    if (($original_bloq_direcao != $this->bloq_direcao || (isset($bFlagRead_bloq_direcao) && $bFlagRead_bloq_direcao)))
    {
        $this->ajax_return_values_bloq_direcao(true);
    }
    if (($original_bloq_evento_id != $this->bloq_evento_id || (isset($bFlagRead_bloq_evento_id) && $bFlagRead_bloq_evento_id)))
    {
        $this->ajax_return_values_bloq_evento_id(true);
    }
    if (($original_bloq_origem != $this->bloq_origem || (isset($bFlagRead_bloq_origem) && $bFlagRead_bloq_origem)))
    {
        $this->ajax_return_values_bloq_origem(true);
    }
    if (($original_bloqueio_id != $this->bloqueio_id || (isset($bFlagRead_bloqueio_id) && $bFlagRead_bloqueio_id)))
    {
        $this->ajax_return_values_bloqueio_id(true);
    }
}
$_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'off'; 
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
      $NM_val_form['bloqueio_id'] = $this->bloqueio_id;
      $NM_val_form['bloq_evento_id'] = $this->bloq_evento_id;
      $NM_val_form['bloq_descricao'] = $this->bloq_descricao;
      $NM_val_form['bloq_direcao'] = $this->bloq_direcao;
      $NM_val_form['bloq_cia_aerea'] = $this->bloq_cia_aerea;
      $NM_val_form['bloq_origem'] = $this->bloq_origem;
      $NM_val_form['bloq_destino'] = $this->bloq_destino;
      $NM_val_form['bloq_dt_saida'] = $this->bloq_dt_saida;
      $NM_val_form['bloq_hr_saida'] = $this->bloq_hr_saida;
      $NM_val_form['bloq_dt_chegada'] = $this->bloq_dt_chegada;
      $NM_val_form['bloq_hr_chegada'] = $this->bloq_hr_chegada;
      $NM_val_form['bloq_num_voo'] = $this->bloq_num_voo;
      $NM_val_form['bloq_num_pass_etkt'] = $this->bloq_num_pass_etkt;
      $NM_val_form['bloq_localizador'] = $this->bloq_localizador;
      $NM_val_form['bloq_qtd_lugares'] = $this->bloq_qtd_lugares;
      $NM_val_form['bloq_saldo_lugares'] = $this->bloq_saldo_lugares;
      $NM_val_form['bloq_nota_gate'] = $this->bloq_nota_gate;
      $NM_val_form['bloq_dt_nota_gate'] = $this->bloq_dt_nota_gate;
      $NM_val_form['rodape'] = $this->rodape;
      if ($this->bloqueio_id === "" || is_null($this->bloqueio_id))  
      { 
          $this->bloqueio_id = 0;
      } 
      if ($this->bloq_evento_id === "" || is_null($this->bloq_evento_id))  
      { 
          $this->bloq_evento_id = 0;
          $this->sc_force_zero[] = 'bloq_evento_id';
      } 
      if ($this->bloq_cia_aerea === "" || is_null($this->bloq_cia_aerea))  
      { 
          $this->bloq_cia_aerea = 0;
          $this->sc_force_zero[] = 'bloq_cia_aerea';
      } 
      if ($this->bloq_origem === "" || is_null($this->bloq_origem))  
      { 
          $this->bloq_origem = 0;
          $this->sc_force_zero[] = 'bloq_origem';
      } 
      if ($this->bloq_destino === "" || is_null($this->bloq_destino))  
      { 
          $this->bloq_destino = 0;
          $this->sc_force_zero[] = 'bloq_destino';
      } 
      if ($this->bloq_qtd_lugares === "" || is_null($this->bloq_qtd_lugares))  
      { 
          $this->bloq_qtd_lugares = 0;
          $this->sc_force_zero[] = 'bloq_qtd_lugares';
      } 
      if ($this->bloq_saldo_lugares === "" || is_null($this->bloq_saldo_lugares))  
      { 
          $this->bloq_saldo_lugares = 0;
          $this->sc_force_zero[] = 'bloq_saldo_lugares';
      } 
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_oracle, $this->Ini->nm_bases_ibase, $this->Ini->nm_bases_informix, $this->Ini->nm_bases_mysql, $this->Ini->nm_bases_access, $this->Ini->nm_bases_sqlite, $this->Ini->nm_bases_db2, array('pdo_sqlsrv'));
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          $this->bloq_descricao_before_qstr = $this->bloq_descricao;
          $this->bloq_descricao = substr($this->Db->qstr($this->bloq_descricao), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->bloq_descricao = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->bloq_descricao);
          }
          if ($this->bloq_descricao == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->bloq_descricao = "null"; 
              $this->NM_val_null[] = "bloq_descricao";
          } 
          $this->bloq_direcao_before_qstr = $this->bloq_direcao;
          $this->bloq_direcao = substr($this->Db->qstr($this->bloq_direcao), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->bloq_direcao = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->bloq_direcao);
          }
          if ($this->bloq_direcao == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->bloq_direcao = "null"; 
              $this->NM_val_null[] = "bloq_direcao";
          } 
          if ($this->bloq_dt_saida == "")  
          { 
              $this->bloq_dt_saida = "null"; 
              $this->NM_val_null[] = "bloq_dt_saida";
          } 
          if ($this->bloq_dt_chegada == "")  
          { 
              $this->bloq_dt_chegada = "null"; 
              $this->NM_val_null[] = "bloq_dt_chegada";
          } 
          if ($this->bloq_hr_saida == "")  
          { 
              $this->bloq_hr_saida = "null"; 
              $this->NM_val_null[] = "bloq_hr_saida";
          } 
          if ($this->bloq_hr_chegada == "")  
          { 
              $this->bloq_hr_chegada = "null"; 
              $this->NM_val_null[] = "bloq_hr_chegada";
          } 
          $this->bloq_num_voo_before_qstr = $this->bloq_num_voo;
          $this->bloq_num_voo = substr($this->Db->qstr($this->bloq_num_voo), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->bloq_num_voo = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->bloq_num_voo);
          }
          if ($this->bloq_num_voo == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->bloq_num_voo = "null"; 
              $this->NM_val_null[] = "bloq_num_voo";
          } 
          $this->bloq_num_pass_etkt_before_qstr = $this->bloq_num_pass_etkt;
          $this->bloq_num_pass_etkt = substr($this->Db->qstr($this->bloq_num_pass_etkt), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->bloq_num_pass_etkt = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->bloq_num_pass_etkt);
          }
          if ($this->bloq_num_pass_etkt == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->bloq_num_pass_etkt = "null"; 
              $this->NM_val_null[] = "bloq_num_pass_etkt";
          } 
          $this->bloq_localizador_before_qstr = $this->bloq_localizador;
          $this->bloq_localizador = substr($this->Db->qstr($this->bloq_localizador), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->bloq_localizador = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->bloq_localizador);
          }
          if ($this->bloq_localizador == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->bloq_localizador = "null"; 
              $this->NM_val_null[] = "bloq_localizador";
          } 
          $this->bloq_nota_gate_before_qstr = $this->bloq_nota_gate;
          $this->bloq_nota_gate = substr($this->Db->qstr($this->bloq_nota_gate), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->bloq_nota_gate = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->bloq_nota_gate);
          }
          if ($this->bloq_nota_gate == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->bloq_nota_gate = "null"; 
              $this->NM_val_null[] = "bloq_nota_gate";
          } 
          if ($this->bloq_dt_nota_gate == "")  
          { 
              $this->bloq_dt_nota_gate = "null"; 
              $this->NM_val_null[] = "bloq_dt_nota_gate";
          } 
      }
      if ($this->nmgp_opcao == "alterar") 
      {
          $SC_fields_update = array(); 
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['foreign_key'] as $sFKName => $sFKValue)
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
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 form_bloqueio_aereo_rsvp_pack_ajax_response();
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
                  $SC_fields_update[] = "bloq_evento_id = $this->bloq_evento_id, bloq_descricao = '$this->bloq_descricao', bloq_cia_aerea = $this->bloq_cia_aerea, bloq_direcao = '$this->bloq_direcao', bloq_origem = $this->bloq_origem, bloq_destino = $this->bloq_destino, bloq_dt_saida = #$this->bloq_dt_saida#, bloq_dt_chegada = #$this->bloq_dt_chegada#, bloq_hr_saida = #$this->bloq_hr_saida#, bloq_hr_chegada = #$this->bloq_hr_chegada#, bloq_num_voo = '$this->bloq_num_voo', bloq_num_pass_etkt = '$this->bloq_num_pass_etkt', bloq_localizador = '$this->bloq_localizador', bloq_qtd_lugares = $this->bloq_qtd_lugares, bloq_saldo_lugares = $this->bloq_saldo_lugares, bloq_nota_gate = '$this->bloq_nota_gate', bloq_dt_nota_gate = #$this->bloq_dt_nota_gate#"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "bloq_evento_id = $this->bloq_evento_id, bloq_descricao = '$this->bloq_descricao', bloq_cia_aerea = $this->bloq_cia_aerea, bloq_direcao = '$this->bloq_direcao', bloq_origem = $this->bloq_origem, bloq_destino = $this->bloq_destino, bloq_dt_saida = " . $this->Ini->date_delim . $this->bloq_dt_saida . $this->Ini->date_delim1 . ", bloq_dt_chegada = " . $this->Ini->date_delim . $this->bloq_dt_chegada . $this->Ini->date_delim1 . ", bloq_hr_saida = " . $this->Ini->date_delim . $this->bloq_hr_saida . $this->Ini->date_delim1 . ", bloq_hr_chegada = " . $this->Ini->date_delim . $this->bloq_hr_chegada . $this->Ini->date_delim1 . ", bloq_num_voo = '$this->bloq_num_voo', bloq_num_pass_etkt = '$this->bloq_num_pass_etkt', bloq_localizador = '$this->bloq_localizador', bloq_qtd_lugares = $this->bloq_qtd_lugares, bloq_saldo_lugares = $this->bloq_saldo_lugares, bloq_nota_gate = '$this->bloq_nota_gate', bloq_dt_nota_gate = " . $this->Ini->date_delim . $this->bloq_dt_nota_gate . $this->Ini->date_delim1 . ""; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "bloq_evento_id = $this->bloq_evento_id, bloq_descricao = '$this->bloq_descricao', bloq_cia_aerea = $this->bloq_cia_aerea, bloq_direcao = '$this->bloq_direcao', bloq_origem = $this->bloq_origem, bloq_destino = $this->bloq_destino, bloq_dt_saida = " . $this->Ini->date_delim . $this->bloq_dt_saida . $this->Ini->date_delim1 . ", bloq_dt_chegada = " . $this->Ini->date_delim . $this->bloq_dt_chegada . $this->Ini->date_delim1 . ", bloq_hr_saida = " . $this->Ini->date_delim . $this->bloq_hr_saida . $this->Ini->date_delim1 . ", bloq_hr_chegada = " . $this->Ini->date_delim . $this->bloq_hr_chegada . $this->Ini->date_delim1 . ", bloq_num_voo = '$this->bloq_num_voo', bloq_num_pass_etkt = '$this->bloq_num_pass_etkt', bloq_localizador = '$this->bloq_localizador', bloq_qtd_lugares = $this->bloq_qtd_lugares, bloq_saldo_lugares = $this->bloq_saldo_lugares, bloq_nota_gate = '$this->bloq_nota_gate', bloq_dt_nota_gate = " . $this->Ini->date_delim . $this->bloq_dt_nota_gate . $this->Ini->date_delim1 . ""; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "bloq_evento_id = $this->bloq_evento_id, bloq_descricao = '$this->bloq_descricao', bloq_cia_aerea = $this->bloq_cia_aerea, bloq_direcao = '$this->bloq_direcao', bloq_origem = $this->bloq_origem, bloq_destino = $this->bloq_destino, bloq_dt_saida = EXTEND('$this->bloq_dt_saida', YEAR TO DAY), bloq_dt_chegada = EXTEND('$this->bloq_dt_chegada', YEAR TO DAY), bloq_hr_saida = " . $this->Ini->date_delim . $this->bloq_hr_saida . $this->Ini->date_delim1 . ", bloq_hr_chegada = " . $this->Ini->date_delim . $this->bloq_hr_chegada . $this->Ini->date_delim1 . ", bloq_num_voo = '$this->bloq_num_voo', bloq_num_pass_etkt = '$this->bloq_num_pass_etkt', bloq_localizador = '$this->bloq_localizador', bloq_qtd_lugares = $this->bloq_qtd_lugares, bloq_saldo_lugares = $this->bloq_saldo_lugares, bloq_nota_gate = '$this->bloq_nota_gate', bloq_dt_nota_gate = EXTEND('$this->bloq_dt_nota_gate', YEAR TO DAY)"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "bloq_evento_id = $this->bloq_evento_id, bloq_descricao = '$this->bloq_descricao', bloq_cia_aerea = $this->bloq_cia_aerea, bloq_direcao = '$this->bloq_direcao', bloq_origem = $this->bloq_origem, bloq_destino = $this->bloq_destino, bloq_dt_saida = " . $this->Ini->date_delim . $this->bloq_dt_saida . $this->Ini->date_delim1 . ", bloq_dt_chegada = " . $this->Ini->date_delim . $this->bloq_dt_chegada . $this->Ini->date_delim1 . ", bloq_hr_saida = " . $this->Ini->date_delim . $this->bloq_hr_saida . $this->Ini->date_delim1 . ", bloq_hr_chegada = " . $this->Ini->date_delim . $this->bloq_hr_chegada . $this->Ini->date_delim1 . ", bloq_num_voo = '$this->bloq_num_voo', bloq_num_pass_etkt = '$this->bloq_num_pass_etkt', bloq_localizador = '$this->bloq_localizador', bloq_qtd_lugares = $this->bloq_qtd_lugares, bloq_saldo_lugares = $this->bloq_saldo_lugares, bloq_nota_gate = '$this->bloq_nota_gate', bloq_dt_nota_gate = " . $this->Ini->date_delim . $this->bloq_dt_nota_gate . $this->Ini->date_delim1 . ""; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "bloq_evento_id = $this->bloq_evento_id, bloq_descricao = '$this->bloq_descricao', bloq_cia_aerea = $this->bloq_cia_aerea, bloq_direcao = '$this->bloq_direcao', bloq_origem = $this->bloq_origem, bloq_destino = $this->bloq_destino, bloq_dt_saida = " . $this->Ini->date_delim . $this->bloq_dt_saida . $this->Ini->date_delim1 . ", bloq_dt_chegada = " . $this->Ini->date_delim . $this->bloq_dt_chegada . $this->Ini->date_delim1 . ", bloq_hr_saida = " . $this->Ini->date_delim . $this->bloq_hr_saida . $this->Ini->date_delim1 . ", bloq_hr_chegada = " . $this->Ini->date_delim . $this->bloq_hr_chegada . $this->Ini->date_delim1 . ", bloq_num_voo = '$this->bloq_num_voo', bloq_num_pass_etkt = '$this->bloq_num_pass_etkt', bloq_localizador = '$this->bloq_localizador', bloq_qtd_lugares = $this->bloq_qtd_lugares, bloq_saldo_lugares = $this->bloq_saldo_lugares, bloq_nota_gate = '$this->bloq_nota_gate', bloq_dt_nota_gate = " . $this->Ini->date_delim . $this->bloq_dt_nota_gate . $this->Ini->date_delim1 . ""; 
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "bloq_evento_id = $this->bloq_evento_id, bloq_descricao = '$this->bloq_descricao', bloq_cia_aerea = $this->bloq_cia_aerea, bloq_direcao = '$this->bloq_direcao', bloq_origem = $this->bloq_origem, bloq_destino = $this->bloq_destino, bloq_dt_saida = " . $this->Ini->date_delim . $this->bloq_dt_saida . $this->Ini->date_delim1 . ", bloq_dt_chegada = " . $this->Ini->date_delim . $this->bloq_dt_chegada . $this->Ini->date_delim1 . ", bloq_hr_saida = " . $this->Ini->date_delim . $this->bloq_hr_saida . $this->Ini->date_delim1 . ", bloq_hr_chegada = " . $this->Ini->date_delim . $this->bloq_hr_chegada . $this->Ini->date_delim1 . ", bloq_num_voo = '$this->bloq_num_voo', bloq_num_pass_etkt = '$this->bloq_num_pass_etkt', bloq_localizador = '$this->bloq_localizador', bloq_qtd_lugares = $this->bloq_qtd_lugares, bloq_saldo_lugares = $this->bloq_saldo_lugares, bloq_nota_gate = '$this->bloq_nota_gate', bloq_dt_nota_gate = " . $this->Ini->date_delim . $this->bloq_dt_nota_gate . $this->Ini->date_delim1 . ""; 
              } 
              $comando .= implode(",", $SC_fields_update);  
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $comando .= " WHERE bloqueio_id = $this->bloqueio_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $comando .= " WHERE bloqueio_id = $this->bloqueio_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando .= " WHERE bloqueio_id = $this->bloqueio_id ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando .= " WHERE bloqueio_id = $this->bloqueio_id ";  
              }  
              else  
              {
                  $comando .= " WHERE bloqueio_id = $this->bloqueio_id ";  
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
                                  form_bloqueio_aereo_rsvp_pack_ajax_response();
                              }
                              exit;  
                          }   
                      }   
                  }   
              }   
              $this->bloq_descricao = $this->bloq_descricao_before_qstr;
              $this->bloq_direcao = $this->bloq_direcao_before_qstr;
              $this->bloq_num_voo = $this->bloq_num_voo_before_qstr;
              $this->bloq_num_pass_etkt = $this->bloq_num_pass_etkt_before_qstr;
              $this->bloq_localizador = $this->bloq_localizador_before_qstr;
              $this->bloq_nota_gate = $this->bloq_nota_gate_before_qstr;
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

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['db_changed'] = true;
              if ($this->NM_ajax_flag) {
                  $this->NM_ajax_info['clearUpload'] = 'S';
              }


              if     (isset($NM_val_form) && isset($NM_val_form['bloqueio_id'])) { $this->bloqueio_id = $NM_val_form['bloqueio_id']; }
              elseif (isset($this->bloqueio_id)) { $this->nm_limpa_alfa($this->bloqueio_id); }
              if     (isset($NM_val_form) && isset($NM_val_form['bloq_evento_id'])) { $this->bloq_evento_id = $NM_val_form['bloq_evento_id']; }
              elseif (isset($this->bloq_evento_id)) { $this->nm_limpa_alfa($this->bloq_evento_id); }
              if     (isset($NM_val_form) && isset($NM_val_form['bloq_descricao'])) { $this->bloq_descricao = $NM_val_form['bloq_descricao']; }
              elseif (isset($this->bloq_descricao)) { $this->nm_limpa_alfa($this->bloq_descricao); }
              if     (isset($NM_val_form) && isset($NM_val_form['bloq_cia_aerea'])) { $this->bloq_cia_aerea = $NM_val_form['bloq_cia_aerea']; }
              elseif (isset($this->bloq_cia_aerea)) { $this->nm_limpa_alfa($this->bloq_cia_aerea); }
              if     (isset($NM_val_form) && isset($NM_val_form['bloq_direcao'])) { $this->bloq_direcao = $NM_val_form['bloq_direcao']; }
              elseif (isset($this->bloq_direcao)) { $this->nm_limpa_alfa($this->bloq_direcao); }
              if     (isset($NM_val_form) && isset($NM_val_form['bloq_origem'])) { $this->bloq_origem = $NM_val_form['bloq_origem']; }
              elseif (isset($this->bloq_origem)) { $this->nm_limpa_alfa($this->bloq_origem); }
              if     (isset($NM_val_form) && isset($NM_val_form['bloq_destino'])) { $this->bloq_destino = $NM_val_form['bloq_destino']; }
              elseif (isset($this->bloq_destino)) { $this->nm_limpa_alfa($this->bloq_destino); }
              if     (isset($NM_val_form) && isset($NM_val_form['bloq_num_voo'])) { $this->bloq_num_voo = $NM_val_form['bloq_num_voo']; }
              elseif (isset($this->bloq_num_voo)) { $this->nm_limpa_alfa($this->bloq_num_voo); }
              if     (isset($NM_val_form) && isset($NM_val_form['bloq_num_pass_etkt'])) { $this->bloq_num_pass_etkt = $NM_val_form['bloq_num_pass_etkt']; }
              elseif (isset($this->bloq_num_pass_etkt)) { $this->nm_limpa_alfa($this->bloq_num_pass_etkt); }
              if     (isset($NM_val_form) && isset($NM_val_form['bloq_localizador'])) { $this->bloq_localizador = $NM_val_form['bloq_localizador']; }
              elseif (isset($this->bloq_localizador)) { $this->nm_limpa_alfa($this->bloq_localizador); }
              if     (isset($NM_val_form) && isset($NM_val_form['bloq_qtd_lugares'])) { $this->bloq_qtd_lugares = $NM_val_form['bloq_qtd_lugares']; }
              elseif (isset($this->bloq_qtd_lugares)) { $this->nm_limpa_alfa($this->bloq_qtd_lugares); }
              if     (isset($NM_val_form) && isset($NM_val_form['bloq_saldo_lugares'])) { $this->bloq_saldo_lugares = $NM_val_form['bloq_saldo_lugares']; }
              elseif (isset($this->bloq_saldo_lugares)) { $this->nm_limpa_alfa($this->bloq_saldo_lugares); }
              if     (isset($NM_val_form) && isset($NM_val_form['bloq_nota_gate'])) { $this->bloq_nota_gate = $NM_val_form['bloq_nota_gate']; }
              elseif (isset($this->bloq_nota_gate)) { $this->nm_limpa_alfa($this->bloq_nota_gate); }

              $this->nm_formatar_campos();
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
              }

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('bloqueio_id', 'bloq_evento_id', 'bloq_descricao', 'bloq_direcao', 'bloq_cia_aerea', 'bloq_origem', 'bloq_destino', 'bloq_dt_saida', 'bloq_hr_saida', 'bloq_dt_chegada', 'bloq_hr_chegada', 'bloq_num_voo', 'bloq_num_pass_etkt', 'bloq_localizador', 'bloq_qtd_lugares', 'bloq_saldo_lugares', 'bloq_nota_gate', 'bloq_dt_nota_gate'), $aDoNotUpdate);
              $this->ajax_return_values();
              $this->nmgp_refresh_fields = $aOldRefresh;

              $this->nm_tira_formatacao();
              $this->nm_converte_datas();
          }  
      }  
      if ($this->nmgp_opcao == "incluir") 
      { 
          $NM_cmp_auto = "";
          $NM_seq_auto = "";
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['foreign_key'] as $sFKName => $sFKValue)
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
              $NM_cmp_auto = "bloqueio_id, ";
          } 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(bloqueio_id) from " . $this->Ini->nm_tabela; 
          $comando = "select max(bloqueio_id) from " . $this->Ini->nm_tabela; 
          $rs = $this->Db->Execute($comando); 
          if ($rs === false && !$rs->EOF)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
              $this->NM_rollback_db(); 
              if ($this->NM_ajax_flag)
              {
                  form_bloqueio_aereo_rsvp_pack_ajax_response();
              }
              exit; 
          }  
          $this->bloqueio_id_before_qstr = $this->bloqueio_id = $rs->fields[0] + 1;
          $rs->Close(); 
          $bInsertOk = true;
          $aInsertOk = array(); 
          $bInsertOk = $bInsertOk && empty($aInsertOk);
          if (!isset($_POST['nmgp_ins_valid']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['insert_validation'] != $_POST['nmgp_ins_valid'])
          {
              $bInsertOk = false;
              $this->Erro->mensagem(__FILE__, __LINE__, 'security', $this->Ini->Nm_lang['lang_errm_inst_vald']);
              if (isset($_SESSION['scriptcase']['erro_handler']) && $_SESSION['scriptcase']['erro_handler'])
              {
                  $this->nmgp_opcao = 'refresh_insert';
                  if ($this->NM_ajax_flag)
                  {
                      form_bloqueio_aereo_rsvp_pack_ajax_response();
                      exit;
                  }
              }
          }
          if ($bInsertOk)
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (bloq_evento_id, bloq_descricao, bloq_cia_aerea, bloq_direcao, bloq_origem, bloq_destino, bloq_dt_saida, bloq_dt_chegada, bloq_hr_saida, bloq_hr_chegada, bloq_num_voo, bloq_num_pass_etkt, bloq_localizador, bloq_qtd_lugares, bloq_saldo_lugares, bloq_nota_gate, bloq_dt_nota_gate) VALUES ($this->bloq_evento_id, '$this->bloq_descricao', $this->bloq_cia_aerea, '$this->bloq_direcao', $this->bloq_origem, $this->bloq_destino, #$this->bloq_dt_saida#, #$this->bloq_dt_chegada#, #$this->bloq_hr_saida#, #$this->bloq_hr_chegada#, '$this->bloq_num_voo', '$this->bloq_num_pass_etkt', '$this->bloq_localizador', $this->bloq_qtd_lugares, $this->bloq_saldo_lugares, '$this->bloq_nota_gate', #$this->bloq_dt_nota_gate#)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "bloq_evento_id, bloq_descricao, bloq_cia_aerea, bloq_direcao, bloq_origem, bloq_destino, bloq_dt_saida, bloq_dt_chegada, bloq_hr_saida, bloq_hr_chegada, bloq_num_voo, bloq_num_pass_etkt, bloq_localizador, bloq_qtd_lugares, bloq_saldo_lugares, bloq_nota_gate, bloq_dt_nota_gate) VALUES (" . $NM_seq_auto . "$this->bloq_evento_id, '$this->bloq_descricao', $this->bloq_cia_aerea, '$this->bloq_direcao', $this->bloq_origem, $this->bloq_destino, " . $this->Ini->date_delim . $this->bloq_dt_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->bloq_dt_chegada . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->bloq_hr_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->bloq_hr_chegada . $this->Ini->date_delim1 . ", '$this->bloq_num_voo', '$this->bloq_num_pass_etkt', '$this->bloq_localizador', $this->bloq_qtd_lugares, $this->bloq_saldo_lugares, '$this->bloq_nota_gate', " . $this->Ini->date_delim . $this->bloq_dt_nota_gate . $this->Ini->date_delim1 . ")"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
              { 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "bloq_evento_id, bloq_descricao, bloq_cia_aerea, bloq_direcao, bloq_origem, bloq_destino, bloq_dt_saida, bloq_dt_chegada, bloq_hr_saida, bloq_hr_chegada, bloq_num_voo, bloq_num_pass_etkt, bloq_localizador, bloq_qtd_lugares, bloq_saldo_lugares, bloq_nota_gate, bloq_dt_nota_gate) VALUES (" . $NM_seq_auto . "$this->bloq_evento_id, '$this->bloq_descricao', $this->bloq_cia_aerea, '$this->bloq_direcao', $this->bloq_origem, $this->bloq_destino, " . $this->Ini->date_delim . $this->bloq_dt_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->bloq_dt_chegada . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->bloq_hr_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->bloq_hr_chegada . $this->Ini->date_delim1 . ", '$this->bloq_num_voo', '$this->bloq_num_pass_etkt', '$this->bloq_localizador', $this->bloq_qtd_lugares, $this->bloq_saldo_lugares, '$this->bloq_nota_gate', " . $this->Ini->date_delim . $this->bloq_dt_nota_gate . $this->Ini->date_delim1 . ")"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "bloq_evento_id, bloq_descricao, bloq_cia_aerea, bloq_direcao, bloq_origem, bloq_destino, bloq_dt_saida, bloq_dt_chegada, bloq_hr_saida, bloq_hr_chegada, bloq_num_voo, bloq_num_pass_etkt, bloq_localizador, bloq_qtd_lugares, bloq_saldo_lugares, bloq_nota_gate, bloq_dt_nota_gate) VALUES (" . $NM_seq_auto . "$this->bloq_evento_id, '$this->bloq_descricao', $this->bloq_cia_aerea, '$this->bloq_direcao', $this->bloq_origem, $this->bloq_destino, " . $this->Ini->date_delim . $this->bloq_dt_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->bloq_dt_chegada . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->bloq_hr_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->bloq_hr_chegada . $this->Ini->date_delim1 . ", '$this->bloq_num_voo', '$this->bloq_num_pass_etkt', '$this->bloq_localizador', $this->bloq_qtd_lugares, $this->bloq_saldo_lugares, '$this->bloq_nota_gate', " . $this->Ini->date_delim . $this->bloq_dt_nota_gate . $this->Ini->date_delim1 . ")"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "bloq_evento_id, bloq_descricao, bloq_cia_aerea, bloq_direcao, bloq_origem, bloq_destino, bloq_dt_saida, bloq_dt_chegada, bloq_hr_saida, bloq_hr_chegada, bloq_num_voo, bloq_num_pass_etkt, bloq_localizador, bloq_qtd_lugares, bloq_saldo_lugares, bloq_nota_gate, bloq_dt_nota_gate) VALUES (" . $NM_seq_auto . "$this->bloq_evento_id, '$this->bloq_descricao', $this->bloq_cia_aerea, '$this->bloq_direcao', $this->bloq_origem, $this->bloq_destino, EXTEND('$this->bloq_dt_saida', YEAR TO DAY), EXTEND('$this->bloq_dt_chegada', YEAR TO DAY), " . $this->Ini->date_delim . $this->bloq_hr_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->bloq_hr_chegada . $this->Ini->date_delim1 . ", '$this->bloq_num_voo', '$this->bloq_num_pass_etkt', '$this->bloq_localizador', $this->bloq_qtd_lugares, $this->bloq_saldo_lugares, '$this->bloq_nota_gate', EXTEND('$this->bloq_dt_nota_gate', YEAR TO DAY))"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "bloq_evento_id, bloq_descricao, bloq_cia_aerea, bloq_direcao, bloq_origem, bloq_destino, bloq_dt_saida, bloq_dt_chegada, bloq_hr_saida, bloq_hr_chegada, bloq_num_voo, bloq_num_pass_etkt, bloq_localizador, bloq_qtd_lugares, bloq_saldo_lugares, bloq_nota_gate, bloq_dt_nota_gate) VALUES (" . $NM_seq_auto . "$this->bloq_evento_id, '$this->bloq_descricao', $this->bloq_cia_aerea, '$this->bloq_direcao', $this->bloq_origem, $this->bloq_destino, " . $this->Ini->date_delim . $this->bloq_dt_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->bloq_dt_chegada . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->bloq_hr_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->bloq_hr_chegada . $this->Ini->date_delim1 . ", '$this->bloq_num_voo', '$this->bloq_num_pass_etkt', '$this->bloq_localizador', $this->bloq_qtd_lugares, $this->bloq_saldo_lugares, '$this->bloq_nota_gate', " . $this->Ini->date_delim . $this->bloq_dt_nota_gate . $this->Ini->date_delim1 . ")"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "bloq_evento_id, bloq_descricao, bloq_cia_aerea, bloq_direcao, bloq_origem, bloq_destino, bloq_dt_saida, bloq_dt_chegada, bloq_hr_saida, bloq_hr_chegada, bloq_num_voo, bloq_num_pass_etkt, bloq_localizador, bloq_qtd_lugares, bloq_saldo_lugares, bloq_nota_gate, bloq_dt_nota_gate) VALUES (" . $NM_seq_auto . "$this->bloq_evento_id, '$this->bloq_descricao', $this->bloq_cia_aerea, '$this->bloq_direcao', $this->bloq_origem, $this->bloq_destino, " . $this->Ini->date_delim . $this->bloq_dt_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->bloq_dt_chegada . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->bloq_hr_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->bloq_hr_chegada . $this->Ini->date_delim1 . ", '$this->bloq_num_voo', '$this->bloq_num_pass_etkt', '$this->bloq_localizador', $this->bloq_qtd_lugares, $this->bloq_saldo_lugares, '$this->bloq_nota_gate', " . $this->Ini->date_delim . $this->bloq_dt_nota_gate . $this->Ini->date_delim1 . ")"; 
              }
              elseif ($this->Ini->nm_tpbanco == 'pdo_ibm')
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "bloq_evento_id, bloq_descricao, bloq_cia_aerea, bloq_direcao, bloq_origem, bloq_destino, bloq_dt_saida, bloq_dt_chegada, bloq_hr_saida, bloq_hr_chegada, bloq_num_voo, bloq_num_pass_etkt, bloq_localizador, bloq_qtd_lugares, bloq_saldo_lugares, bloq_nota_gate, bloq_dt_nota_gate) VALUES (" . $NM_seq_auto . "$this->bloq_evento_id, '$this->bloq_descricao', $this->bloq_cia_aerea, '$this->bloq_direcao', $this->bloq_origem, $this->bloq_destino, " . $this->Ini->date_delim . $this->bloq_dt_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->bloq_dt_chegada . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->bloq_hr_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->bloq_hr_chegada . $this->Ini->date_delim1 . ", '$this->bloq_num_voo', '$this->bloq_num_pass_etkt', '$this->bloq_localizador', $this->bloq_qtd_lugares, $this->bloq_saldo_lugares, '$this->bloq_nota_gate', " . $this->Ini->date_delim . $this->bloq_dt_nota_gate . $this->Ini->date_delim1 . ")"; 
              }
              else
              {
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "bloq_evento_id, bloq_descricao, bloq_cia_aerea, bloq_direcao, bloq_origem, bloq_destino, bloq_dt_saida, bloq_dt_chegada, bloq_hr_saida, bloq_hr_chegada, bloq_num_voo, bloq_num_pass_etkt, bloq_localizador, bloq_qtd_lugares, bloq_saldo_lugares, bloq_nota_gate, bloq_dt_nota_gate) VALUES (" . $NM_seq_auto . "$this->bloq_evento_id, '$this->bloq_descricao', $this->bloq_cia_aerea, '$this->bloq_direcao', $this->bloq_origem, $this->bloq_destino, " . $this->Ini->date_delim . $this->bloq_dt_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->bloq_dt_chegada . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->bloq_hr_saida . $this->Ini->date_delim1 . ", " . $this->Ini->date_delim . $this->bloq_hr_chegada . $this->Ini->date_delim1 . ", '$this->bloq_num_voo', '$this->bloq_num_pass_etkt', '$this->bloq_localizador', $this->bloq_qtd_lugares, $this->bloq_saldo_lugares, '$this->bloq_nota_gate', " . $this->Ini->date_delim . $this->bloq_dt_nota_gate . $this->Ini->date_delim1 . ")"; 
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
                              form_bloqueio_aereo_rsvp_pack_ajax_response();
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
                          form_bloqueio_aereo_rsvp_pack_ajax_response();
                      }
                      exit; 
                  } 
                  $this->bloqueio_id =  $rsy->fields[0];
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
                  $this->bloqueio_id = $rsy->fields[0];
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
                  $this->bloqueio_id = $rsy->fields[0];
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
                  $this->bloqueio_id = $rsy->fields[0];
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
                  $this->bloqueio_id = $rsy->fields[0];
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
                  $this->bloqueio_id = $rsy->fields[0];
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
                  $this->bloqueio_id = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              $this->bloq_descricao = $this->bloq_descricao_before_qstr;
              $this->bloq_direcao = $this->bloq_direcao_before_qstr;
              $this->bloq_num_voo = $this->bloq_num_voo_before_qstr;
              $this->bloq_num_pass_etkt = $this->bloq_num_pass_etkt_before_qstr;
              $this->bloq_localizador = $this->bloq_localizador_before_qstr;
              $this->bloq_nota_gate = $this->bloq_nota_gate_before_qstr;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['total']);
              }

              $this->sc_evento = "insert"; 
              $this->bloq_descricao = $this->bloq_descricao_before_qstr;
              $this->bloq_direcao = $this->bloq_direcao_before_qstr;
              $this->bloq_num_voo = $this->bloq_num_voo_before_qstr;
              $this->bloq_num_pass_etkt = $this->bloq_num_pass_etkt_before_qstr;
              $this->bloq_localizador = $this->bloq_localizador_before_qstr;
              $this->bloq_nota_gate = $this->bloq_nota_gate_before_qstr;
              $this->sc_insert_on = true; 
              if (empty($this->sc_erro_insert)) {
                  $this->record_insert_ok = true;
              } 
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao = "novo"; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] == "R")
              { 
                   $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['return_edit'] = "new";
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
          $this->bloqueio_id = substr($this->Db->qstr($this->bloqueio_id), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';

          if ($bDelecaoOk)
          {

          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id "); 
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
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id "); 
              }  
              else  
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where bloqueio_id = $this->bloqueio_id "); 
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
                          form_bloqueio_aereo_rsvp_pack_ajax_response();
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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start']--; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start'] = 0; 
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['db_changed'] = true;

              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['total']))
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['total']);
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
    if ("insert" == $this->sc_evento && $this->nmgp_opcao != "nada") {
        $_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_bloq_cia_aerea = $this->bloq_cia_aerea;
    $original_bloq_descricao = $this->bloq_descricao;
    $original_bloq_destino = $this->bloq_destino;
    $original_bloq_direcao = $this->bloq_direcao;
    $original_bloq_evento_id = $this->bloq_evento_id;
    $original_bloq_origem = $this->bloq_origem;
    $original_bloqueio_id = $this->bloqueio_id;
}
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
if (!isset($this->sc_temp_rsvp_global)) {$this->sc_temp_rsvp_global = (isset($_SESSION['rsvp_global'])) ? $_SESSION['rsvp_global'] : "";}
  date_default_timezone_set('America/Sao_Paulo');
$evento = $this->bloq_evento_id ;
$sql="
	UPDATE 
		eventos_rsvp
	SET 
		ciaerea_ok = ".$this->Db->qstr($evento).",
		bloq_saldo_lugares = bloq_qtd_lugares
	WHERE 
		evento_id = ".$this->Db->qstr($evento)."
";

     $nm_select = $sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_bloqueio_aereo_rsvp_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      

if ($this->sc_evento == "alterar" || $this->sc_evento == "update") {	
	$sql_log  = $_SESSION['scriptcase']['sc_sql_ult_comando'];	
} elseif ($this->sc_evento == "incluir" || $this->sc_evento == "insert") {	
	$sql_log  = $_SESSION['scriptcase']['sc_sql_ult_comando'];
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
	$sql_log  = $sql_log .' ID: '.$id_Log;	
} elseif ($this->sc_evento == "excluir" || $this->sc_evento == "delete") {		
	$sql_log  = $_SESSION['scriptcase']['sc_sql_ult_comando'];
} else {
	$sql_log  = $_SESSION['scriptcase']['sc_sql_ult_comando'];	
}

$global_cpf = $this->sc_temp_rsvp_global['usuario_cpf'];
$modulo=  $this->Ini->nm_cod_apl;
$aplicacao = $this->Ini->nm_nome_apl;
$hora_now = date('Y-m-d H:i:s');
$ip_usuario = $this->PegaIP();
$id_usuario = $this->sc_temp_vg_usuario_id;

if ($this->sc_evento == "alterar" || $this->sc_evento == "update") {
	$acao = "ATUALIZAR";
	$retLog = true;
} elseif ($this->sc_evento == "incluir" || $this->sc_evento == "insert") {
	$acao = "INSERIR";	
} elseif ($this->sc_evento == "excluir" || $this->sc_evento == "delete") {	
	$acao = "EXCLUIR";
	$retLog = true;
} else {
	$acao = "ACESSO";
	$retLog = true;	
}

$campo_cpf = $sc_tmp_field_name = '';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] ;
$campo_evt = $sc_tmp_field_name = 'bloq_evento_id';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] ;
$campo_id = $sc_tmp_field_name = 'bloqueio_id';
$this->NM_ajax_info['fieldLabel'][$sc_tmp_field_name] = $this->nm_new_label[$sc_tmp_field_name] ;

$vl_campo_id = $this->bloqueio_id ;
$vl_campo_cpf = ''; 
$vl_campo_evt = $this->bloq_evento_id ;
$tabela = 'bloqueio_aereo__rsvp';
$obs = 'Bloqueio: '.$this->bloq_descricao .' - Evento: '.$this->bloq_evento_id .' Origem: '.$this->bloq_origem .' Destino: '.$this->bloq_destino .' Direção: '.$this->bloq_direcao .'  Cia. Aérea'.$this->bloq_cia_aerea ;

if ($this->sc_temp_rsvp_global['log_rsvp'] == true) { 	
	if($acao == 'INSERIR'){
		$retLog = $this->GravaLog($hora_now,$ip_usuario,$id_usuario,$global_cpf,$modulo,$aplicacao,$acao,$campo_id,$vl_campo_id,$campo_cpf,$vl_campo_cpf,$campo_evt,$vl_campo_evt,$tabela,$obs,$sql_log );
	}	
	if ($retLog == false) {
		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Erro ao Gravar LOG";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_form_bloqueio_aereo_rsvp';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_bloqueio_aereo_rsvp';
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
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (isset($Ctrl_Proc_Onload) && $Ctrl_Proc_Onload) {
        $Ctrl_Format = true;
        $this->nm_guardar_campos();
        if ($bFormat) $this->nm_formatar_campos();
    }
    if (($original_bloq_cia_aerea != $this->bloq_cia_aerea || (isset($bFlagRead_bloq_cia_aerea) && $bFlagRead_bloq_cia_aerea)))
    {
        $this->ajax_return_values_bloq_cia_aerea(true);
    }
    if (($original_bloq_descricao != $this->bloq_descricao || (isset($bFlagRead_bloq_descricao) && $bFlagRead_bloq_descricao)))
    {
        $this->ajax_return_values_bloq_descricao(true);
    }
    if (($original_bloq_destino != $this->bloq_destino || (isset($bFlagRead_bloq_destino) && $bFlagRead_bloq_destino)))
    {
        $this->ajax_return_values_bloq_destino(true);
    }
    if (($original_bloq_direcao != $this->bloq_direcao || (isset($bFlagRead_bloq_direcao) && $bFlagRead_bloq_direcao)))
    {
        $this->ajax_return_values_bloq_direcao(true);
    }
    if (($original_bloq_evento_id != $this->bloq_evento_id || (isset($bFlagRead_bloq_evento_id) && $bFlagRead_bloq_evento_id)))
    {
        $this->ajax_return_values_bloq_evento_id(true);
    }
    if (($original_bloq_origem != $this->bloq_origem || (isset($bFlagRead_bloq_origem) && $bFlagRead_bloq_origem)))
    {
        $this->ajax_return_values_bloq_origem(true);
    }
    if (($original_bloqueio_id != $this->bloqueio_id || (isset($bFlagRead_bloqueio_id) && $bFlagRead_bloqueio_id)))
    {
        $this->ajax_return_values_bloqueio_id(true);
    }
}
$_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'off'; 
    }
    if ("update" == $this->sc_evento && $this->nmgp_opcao != "nada") {
        $_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_bloq_direcao = $this->bloq_direcao;
    $original_bloq_evento_id = $this->bloq_evento_id;
    $original_bloq_qtd_lugares = $this->bloq_qtd_lugares;
    $original_bloqueio_id = $this->bloqueio_id;
}
  date_default_timezone_set('America/Sao_Paulo');
$evento = $this->bloq_evento_id ;
$sql="
UPDATE eventos_rsvp
SET 
	ciaerea_ok = ".$this->Db->qstr($evento)."
WHERE 
	evento_id = ".$this->Db->qstr($evento)."
";

     $nm_select = $sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_bloqueio_aereo_rsvp_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      

$v_qtdlugares = $this->bloq_qtd_lugares ;
$v_saldo = 0;

$sqlm="
SELECT 
	COUNT(aereo_id_evento) AS qtdm
FROM
	aereos_rsvp
WHERE
	aereo_bloqueio_id = ".$this->Db->qstr($this->bloqueio_id )." 
AND
	aereo_id_evento = ".$this->Db->qstr($this->bloq_evento_id )." 
AND 
	aereo_direcao = ".$this->Db->qstr($this->bloq_direcao )."
ORDER BY
	aereo_id_evento,id_aereo			
";		

 
      $nm_select = $sqlm; 
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
	$_qtmd = $this->rs[0][0];
	if ($_qtmd > 0) {		
		if ($v_qtdlugares >= $_qtmd) { 
			$v_saldo = $v_qtdlugares - $_qtmd; 
		} else {	
			$this->nm_mens_alert[] = "A quantidade bloqueada não pode ser maior que a quantidade de lugares reservados!"; $this->nm_params_alert[] = array(); if ($this->NM_ajax_flag) { $this->sc_ajax_alert("A quantidade bloqueada não pode ser maior que a quantidade de lugares reservados!"); }$v_saldo = $_qtmd - $v_qtdlugares;			
		}
		$sql3="		
			UPDATE
				bloqueio_aereo_rsvp	
			SET
				bloq_saldo_lugares = ".$this->Db->qstr($v_saldo)."
			WHERE
				bloqueio_id =  ".$this->Db->qstr($this->bloqueio_id )." 
			AND
				bloq_evento_id = ".$this->Db->qstr($this->bloq_evento_id )." 
			AND
				bloq_direcao = ".$this->Db->qstr($this->bloq_direcao )."
		";
		
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
                form_bloqueio_aereo_rsvp_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
	} else {
		$sql3="		
			UPDATE
				bloqueio_aereo_rsvp	
			SET
				bloq_saldo_lugares = ".$this->Db->qstr($this->bloq_qtd_lugares )."
			WHERE
				bloqueio_id =  ".$this->Db->qstr($this->bloqueio_id )." 
			AND
				bloq_evento_id = ".$this->Db->qstr($this->bloq_evento_id )." 
			AND
				bloq_direcao = ".$this->Db->qstr($this->bloq_direcao )."
		";
		
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
                form_bloqueio_aereo_rsvp_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
	}	
}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (isset($Ctrl_Proc_Onload) && $Ctrl_Proc_Onload) {
        $Ctrl_Format = true;
        $this->nm_guardar_campos();
        if ($bFormat) $this->nm_formatar_campos();
    }
    if (($original_bloq_direcao != $this->bloq_direcao || (isset($bFlagRead_bloq_direcao) && $bFlagRead_bloq_direcao)))
    {
        $this->ajax_return_values_bloq_direcao(true);
    }
    if (($original_bloq_evento_id != $this->bloq_evento_id || (isset($bFlagRead_bloq_evento_id) && $bFlagRead_bloq_evento_id)))
    {
        $this->ajax_return_values_bloq_evento_id(true);
    }
    if (($original_bloq_qtd_lugares != $this->bloq_qtd_lugares || (isset($bFlagRead_bloq_qtd_lugares) && $bFlagRead_bloq_qtd_lugares)))
    {
        $this->ajax_return_values_bloq_qtd_lugares(true);
    }
    if (($original_bloqueio_id != $this->bloqueio_id || (isset($bFlagRead_bloqueio_id) && $bFlagRead_bloqueio_id)))
    {
        $this->ajax_return_values_bloqueio_id(true);
    }
}
$_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'off'; 
    }
    if ("delete" == $this->sc_evento && $this->nmgp_opcao != "nada") {
      $_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_bloq_direcao = $this->bloq_direcao;
    $original_bloq_evento_id = $this->bloq_evento_id;
    $original_bloq_qtd_lugares = $this->bloq_qtd_lugares;
    $original_bloqueio_id = $this->bloqueio_id;
}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
  date_default_timezone_set('America/Sao_Paulo');
$evento = $this->sc_temp_vg_evento_id;
$vazio = '';

$sql="
SELECT 
	COUNT(evento_id) AS qtd_usr 
	FROM bloqueio_aereo_rsvp
	WHERE bloq_evento_id = ".$this->Db->qstr($evento)."
"	
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

$qtd_usr = $this->retorno[0][0];	
if($qtd_usr == 0) {
	$sql2="
	UPDATE 
		eventos_rsvp
	SET 
		ciaerea_ok = ".$this->Db->qstr($vazio)."
	WHERE 
		evento_id = ".$this->Db->qstr($evento)."
	"
	;
	
     $nm_select = $sql2; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_bloqueio_aereo_rsvp_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
}

$v_qtdlugares = $this->bloq_qtd_lugares ;
$v_saldo = 0;

$sqlm="
SELECT 
	COUNT(aereo_id_evento) AS qtdm
FROM
	aereos_rsvp
WHERE
	aereo_bloqueio_id = ".$this->Db->qstr($this->bloqueio_id )." 
AND
	aereo_id_evento = ".$this->Db->qstr($this->bloq_evento_id )." 
AND 
	aereo_direcao = ".$this->Db->qstr($this->bloq_direcao )."
ORDER BY
	aereo_id_evento,id_aereo			
";		

 
      $nm_select = $sqlm; 
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
	$_qtmd = $this->rs[0][0];
	if ($_qtmd > 0) {		
		if ($v_qtdlugares >= $_qtmd) { 
			$v_saldo = $v_qtdlugares - $_qtmd; 
		} else {	
			$this->nm_mens_alert[] = "A quantidade bloqueada não pode ser maior que a quantidade de lugares reservados!"; $this->nm_params_alert[] = array(); if ($this->NM_ajax_flag) { $this->sc_ajax_alert("A quantidade bloqueada não pode ser maior que a quantidade de lugares reservados!"); }$v_saldo = $_qtmd - $v_qtdlugares;			
		}
		$sql3="		
			UPDATE
				bloqueio_aereo_rsvp	
			SET
				bloq_saldo_lugares = ".$this->Db->qstr($v_saldo)."
			WHERE
				bloqueio_id =  ".$this->Db->qstr($this->bloqueio_id )." 
			AND
				bloq_evento_id = ".$this->Db->qstr($this->bloq_evento_id )." 
			AND
				bloq_direcao = ".$this->Db->qstr($this->bloq_direcao )."
		";
		
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
                form_bloqueio_aereo_rsvp_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
	} else {
		$sql3="		
			UPDATE
				bloqueio_aereo_rsvp	
			SET
				bloq_saldo_lugares = ".$this->Db->qstr($this->bloq_qtd_lugares )."
			WHERE
				bloqueio_id =  ".$this->Db->qstr($this->bloqueio_id )." 
			AND
				bloq_evento_id = ".$this->Db->qstr($this->bloq_evento_id )." 
			AND
				bloq_direcao = ".$this->Db->qstr($this->bloq_direcao )."
		";		
		
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
                form_bloqueio_aereo_rsvp_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
	}	
}
if (isset($this->sc_temp_vg_evento_id)) { $_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (isset($Ctrl_Proc_Onload) && $Ctrl_Proc_Onload) {
        $Ctrl_Format = true;
        $this->nm_guardar_campos();
        if ($bFormat) $this->nm_formatar_campos();
    }
    if (($original_bloq_direcao != $this->bloq_direcao || (isset($bFlagRead_bloq_direcao) && $bFlagRead_bloq_direcao)))
    {
        $this->ajax_return_values_bloq_direcao(true);
    }
    if (($original_bloq_evento_id != $this->bloq_evento_id || (isset($bFlagRead_bloq_evento_id) && $bFlagRead_bloq_evento_id)))
    {
        $this->ajax_return_values_bloq_evento_id(true);
    }
    if (($original_bloq_qtd_lugares != $this->bloq_qtd_lugares || (isset($bFlagRead_bloq_qtd_lugares) && $bFlagRead_bloq_qtd_lugares)))
    {
        $this->ajax_return_values_bloq_qtd_lugares(true);
    }
    if (($original_bloqueio_id != $this->bloqueio_id || (isset($bFlagRead_bloqueio_id) && $bFlagRead_bloqueio_id)))
    {
        $this->ajax_return_values_bloqueio_id(true);
    }
}
$_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'off'; 
    }
      if (!empty($this->Campos_Mens_erro)) 
      {
          $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro); 
          $this->Campos_Mens_erro = ""; 
          $this->nmgp_opc_ant = $salva_opcao ; 
          if ($salva_opcao == "incluir") 
          { 
              $GLOBALS["erro_incl"] = 1; 
          }
          if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir" || $this->nmgp_opcao == "excluir") 
          {
              $this->nmgp_opcao = "nada"; 
          } 
          $this->sc_evento = ""; 
          $this->NM_rollback_db(); 
          return; 
      }
      if ($salva_opcao == "incluir" && $GLOBALS["erro_incl"] != 1) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['parms'] = "bloqueio_id?#?$this->bloqueio_id?@?"; 
      }
      $this->NM_commit_db(); 
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->bloqueio_id = null === $this->bloqueio_id ? null : substr($this->Db->qstr($this->bloqueio_id), 1, -1); 
      } 
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_filter'] && $sc_where_filter != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_filter'] . ")";
          }
      }
//------------ 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] == "R")
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['iframe_evento']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['iframe_evento'] == "insert") 
          { 
               $this->nmgp_opcao = "novo"; 
               $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['select'] = "";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['iframe_evento'] = $this->sc_evento; 
      } 
      if (!isset($this->nmgp_opcao) || empty($this->nmgp_opcao)) 
      { 
          if (empty($this->bloqueio_id)) 
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
      if ($this->nmgp_opcao != "nada" && (trim($this->bloqueio_id) == "")) 
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] == "F" && $this->sc_evento == "insert")
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
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['total']))
      { 
          $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where; 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
          $rt = $this->Db->Execute($nmgp_select) ; 
          if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
              exit ; 
          }  
          $qt_geral_reg_form_bloqueio_aereo_rsvp = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['total'] = $qt_geral_reg_form_bloqueio_aereo_rsvp;
          $rt->Close(); 
          if ($this->nmgp_opcao == "igual" && isset($this->NM_btn_navega) && 'S' == $this->NM_btn_navega && !empty($this->bloqueio_id))
          {
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $Key_Where = "bloqueio_id < $this->bloqueio_id "; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $Key_Where = "bloqueio_id < $this->bloqueio_id "; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $Key_Where = "bloqueio_id < $this->bloqueio_id "; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $Key_Where = "bloqueio_id < $this->bloqueio_id "; 
              }
              else  
              {
                  $Key_Where = "bloqueio_id < $this->bloqueio_id "; 
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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start'] = $rt->fields[0];
              $this->sc_max_reg = 1;
              $rt->Close(); 
          }
      } 
      else 
      { 
          $qt_geral_reg_form_bloqueio_aereo_rsvp = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['total'];
      } 
      if ($this->nmgp_opcao == "inicio") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start'] = 0; 
      } 
      if ($this->nmgp_opcao == "avanca")  
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start']++; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start'] > $qt_geral_reg_form_bloqueio_aereo_rsvp)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start'] = $qt_geral_reg_form_bloqueio_aereo_rsvp; 
          }
      } 
      if ($this->nmgp_opcao == "retorna") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start']--; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start'] < 0)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start'] = 0; 
          }
      } 
      if ($this->nmgp_opcao == "final") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start'] = $qt_geral_reg_form_bloqueio_aereo_rsvp; 
      } 
      if ($this->nmgp_opcao == "navpage" && ($this->nmgp_ordem - 1) <= $qt_geral_reg_form_bloqueio_aereo_rsvp) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start'] = $this->nmgp_ordem - 1; 
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start'] = 0;
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start'] + 1;
      $this->NM_ajax_info['navSummary']['reg_ini'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start'] + 1; 
      $this->NM_ajax_info['navSummary']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_qtd']; 
      $this->NM_ajax_info['navSummary']['reg_tot'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['total'] + 1; 
      $this->NM_gera_nav_page(); 
      $this->NM_ajax_info['navPage'] = $this->SC_nav_page; 
      $GLOBALS["NM_ERRO_IBASE"] = 0;  
//---------- 
      if ($this->nmgp_opcao != "novo" && $this->nmgp_opcao != "nada" && $this->nmgp_opcao != "refresh_insert") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['parms'] = ""; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          { 
              $GLOBALS["NM_ERRO_IBASE"] = 1;  
          } 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
          { 
              $nmgp_select = "SELECT bloqueio_id, bloq_evento_id, bloq_descricao, bloq_cia_aerea, bloq_direcao, bloq_origem, bloq_destino, str_replace (convert(char(10),bloq_dt_saida,102), '.', '-') + ' ' + convert(char(8),bloq_dt_saida,20), str_replace (convert(char(10),bloq_dt_chegada,102), '.', '-') + ' ' + convert(char(8),bloq_dt_chegada,20), str_replace (convert(char(10),bloq_hr_saida,102), '.', '-') + ' ' + convert(char(8),bloq_hr_saida,20), str_replace (convert(char(10),bloq_hr_chegada,102), '.', '-') + ' ' + convert(char(8),bloq_hr_chegada,20), bloq_num_voo, bloq_num_pass_etkt, bloq_localizador, bloq_qtd_lugares, bloq_saldo_lugares, bloq_nota_gate, str_replace (convert(char(10),bloq_dt_nota_gate,102), '.', '-') + ' ' + convert(char(8),bloq_dt_nota_gate,20) from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $nmgp_select = "SELECT bloqueio_id, bloq_evento_id, bloq_descricao, bloq_cia_aerea, bloq_direcao, bloq_origem, bloq_destino, convert(char(23),bloq_dt_saida,121), convert(char(23),bloq_dt_chegada,121), convert(char(23),bloq_hr_saida,121), convert(char(23),bloq_hr_chegada,121), bloq_num_voo, bloq_num_pass_etkt, bloq_localizador, bloq_qtd_lugares, bloq_saldo_lugares, bloq_nota_gate, convert(char(23),bloq_dt_nota_gate,121) from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          { 
              $nmgp_select = "SELECT bloqueio_id, bloq_evento_id, bloq_descricao, bloq_cia_aerea, bloq_direcao, bloq_origem, bloq_destino, bloq_dt_saida, bloq_dt_chegada, bloq_hr_saida, bloq_hr_chegada, bloq_num_voo, bloq_num_pass_etkt, bloq_localizador, bloq_qtd_lugares, bloq_saldo_lugares, bloq_nota_gate, bloq_dt_nota_gate from " . $this->Ini->nm_tabela ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $nmgp_select = "SELECT bloqueio_id, bloq_evento_id, bloq_descricao, bloq_cia_aerea, bloq_direcao, bloq_origem, bloq_destino, EXTEND(bloq_dt_saida, YEAR TO DAY), EXTEND(bloq_dt_chegada, YEAR TO DAY), bloq_hr_saida, bloq_hr_chegada, bloq_num_voo, bloq_num_pass_etkt, bloq_localizador, bloq_qtd_lugares, bloq_saldo_lugares, bloq_nota_gate, EXTEND(bloq_dt_nota_gate, YEAR TO DAY) from " . $this->Ini->nm_tabela ; 
          } 
          else 
          { 
              $nmgp_select = "SELECT bloqueio_id, bloq_evento_id, bloq_descricao, bloq_cia_aerea, bloq_direcao, bloq_origem, bloq_destino, bloq_dt_saida, bloq_dt_chegada, bloq_hr_saida, bloq_hr_chegada, bloq_num_voo, bloq_num_pass_etkt, bloq_localizador, bloq_qtd_lugares, bloq_saldo_lugares, bloq_nota_gate, bloq_dt_nota_gate from " . $this->Ini->nm_tabela ; 
          } 
          $aWhere = array();
          $aWhere[] = $sc_where_filter;
          if ($this->nmgp_opcao == "igual" || (($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] == "R") && ($this->sc_evento == "insert" || $this->sc_evento == "update")) )
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $aWhere[] = "bloqueio_id = $this->bloqueio_id"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $aWhere[] = "bloqueio_id = $this->bloqueio_id"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $aWhere[] = "bloqueio_id = $this->bloqueio_id"; 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $aWhere[] = "bloqueio_id = $this->bloqueio_id"; 
              }  
              else  
              {
                  $aWhere[] = "bloqueio_id = $this->bloqueio_id"; 
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
          $sc_order_by = "bloqueio_id";
          $sc_order_by = str_replace("order by ", "", $sc_order_by);
          $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
          if (!empty($sc_order_by))
          {
              $nmgp_select .= " order by $sc_order_by "; 
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] == "R")
          {
              if ($this->sc_evento == "update")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['select'] = $nmgp_select;
                  $this->nm_gera_html();
              } 
              elseif (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['select']))
              { 
                  $nmgp_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['select'];
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['select'] = ""; 
              } 
          } 
          if ($this->nmgp_opcao == "igual") 
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start']) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start']) ; 
          } 
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, 1, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start'] . ")" ; 
              $rs = $this->Db->SelectLimit($nmgp_select, 1, $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start']) ; 
          } 
          else  
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
              if (!$rs === false && !$rs->EOF) 
              { 
                  $rs->Move($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start']) ;  
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
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_filter']))
              {
                  $this->nmgp_form_empty        = true;
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['first']   = "off";
                  $this->NM_ajax_info['buttonDisplay']['back']    = $this->nmgp_botoes['back']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['forward'] = $this->nmgp_botoes['forward'] = "off";
                  $this->NM_ajax_info['buttonDisplay']['last']    = $this->nmgp_botoes['last']    = "off";
                  $this->NM_ajax_info['buttonDisplay']['update']  = $this->nmgp_botoes['update']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['delete']  = $this->nmgp_botoes['delete']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['first']   = $this->nmgp_botoes['insert']  = "off";
                  $this->NM_ajax_info['buttonDisplay']['LOG'] = $this->nmgp_botoes['LOG'] = "off";
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['empty_filter'] = true;
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
              $this->NM_ajax_info['buttonDisplay']['LOG'] = $this->nmgp_botoes['LOG'] = "off";
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
              $this->bloqueio_id = $rs->fields[0] ; 
              $this->nmgp_dados_select['bloqueio_id'] = $this->bloqueio_id;
              $this->bloq_evento_id = $rs->fields[1] ; 
              $this->nmgp_dados_select['bloq_evento_id'] = $this->bloq_evento_id;
              $this->bloq_descricao = $rs->fields[2] ; 
              $this->nmgp_dados_select['bloq_descricao'] = $this->bloq_descricao;
              $this->bloq_cia_aerea = $rs->fields[3] ; 
              $this->nmgp_dados_select['bloq_cia_aerea'] = $this->bloq_cia_aerea;
              $this->bloq_direcao = $rs->fields[4] ; 
              $this->nmgp_dados_select['bloq_direcao'] = $this->bloq_direcao;
              $this->bloq_origem = $rs->fields[5] ; 
              $this->nmgp_dados_select['bloq_origem'] = $this->bloq_origem;
              $this->bloq_destino = $rs->fields[6] ; 
              $this->nmgp_dados_select['bloq_destino'] = $this->bloq_destino;
              $this->bloq_dt_saida = $rs->fields[7] ; 
              $this->nmgp_dados_select['bloq_dt_saida'] = $this->bloq_dt_saida;
              $this->bloq_dt_chegada = $rs->fields[8] ; 
              $this->nmgp_dados_select['bloq_dt_chegada'] = $this->bloq_dt_chegada;
              $this->bloq_hr_saida = $rs->fields[9] ; 
              $this->nmgp_dados_select['bloq_hr_saida'] = $this->bloq_hr_saida;
              $this->bloq_hr_chegada = $rs->fields[10] ; 
              $this->nmgp_dados_select['bloq_hr_chegada'] = $this->bloq_hr_chegada;
              $this->bloq_num_voo = $rs->fields[11] ; 
              $this->nmgp_dados_select['bloq_num_voo'] = $this->bloq_num_voo;
              $this->bloq_num_pass_etkt = $rs->fields[12] ; 
              $this->nmgp_dados_select['bloq_num_pass_etkt'] = $this->bloq_num_pass_etkt;
              $this->bloq_localizador = $rs->fields[13] ; 
              $this->nmgp_dados_select['bloq_localizador'] = $this->bloq_localizador;
              $this->bloq_qtd_lugares = $rs->fields[14] ; 
              $this->nmgp_dados_select['bloq_qtd_lugares'] = $this->bloq_qtd_lugares;
              $this->bloq_saldo_lugares = $rs->fields[15] ; 
              $this->nmgp_dados_select['bloq_saldo_lugares'] = $this->bloq_saldo_lugares;
              $this->bloq_nota_gate = $rs->fields[16] ; 
              $this->nmgp_dados_select['bloq_nota_gate'] = $this->bloq_nota_gate;
              $this->bloq_dt_nota_gate = $rs->fields[17] ; 
              $this->nmgp_dados_select['bloq_dt_nota_gate'] = $this->bloq_dt_nota_gate;
          $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->bloqueio_id = (string)$this->bloqueio_id; 
              $this->bloq_evento_id = (string)$this->bloq_evento_id; 
              $this->bloq_cia_aerea = (string)$this->bloq_cia_aerea; 
              $this->bloq_origem = (string)$this->bloq_origem; 
              $this->bloq_destino = (string)$this->bloq_destino; 
              $this->bloq_qtd_lugares = (string)$this->bloq_qtd_lugares; 
              $this->bloq_saldo_lugares = (string)$this->bloq_saldo_lugares; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['parms'] = "bloqueio_id?#?$this->bloqueio_id?@?";
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dados_select'] = $this->nmgp_dados_select;
          if (!$this->NM_ajax_flag || 'backup_line' != $this->NM_ajax_opcao)
          {
              $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start'];
              $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start'] < $qt_geral_reg_form_bloqueio_aereo_rsvp;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['opcao']   = '';
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
              $this->bloqueio_id = "";  
              $this->nmgp_dados_form["bloqueio_id"] = $this->bloqueio_id;
              $this->bloq_evento_id = "";  
              $this->nmgp_dados_form["bloq_evento_id"] = $this->bloq_evento_id;
              $this->bloq_descricao = "";  
              $this->nmgp_dados_form["bloq_descricao"] = $this->bloq_descricao;
              $this->bloq_cia_aerea = "";  
              $this->nmgp_dados_form["bloq_cia_aerea"] = $this->bloq_cia_aerea;
              $this->bloq_direcao = "";  
              $this->nmgp_dados_form["bloq_direcao"] = $this->bloq_direcao;
              $this->bloq_origem = "";  
              $this->nmgp_dados_form["bloq_origem"] = $this->bloq_origem;
              $this->bloq_destino = "";  
              $this->nmgp_dados_form["bloq_destino"] = $this->bloq_destino;
              $this->bloq_dt_saida = "";  
              $this->bloq_dt_saida_hora = "" ;  
              $this->nmgp_dados_form["bloq_dt_saida"] = $this->bloq_dt_saida;
              $this->bloq_dt_chegada = "";  
              $this->bloq_dt_chegada_hora = "" ;  
              $this->nmgp_dados_form["bloq_dt_chegada"] = $this->bloq_dt_chegada;
              $this->bloq_hr_saida = "";  
              $this->bloq_hr_saida_hora = "" ;  
              $this->nmgp_dados_form["bloq_hr_saida"] = $this->bloq_hr_saida;
              $this->bloq_hr_chegada = "";  
              $this->bloq_hr_chegada_hora = "" ;  
              $this->nmgp_dados_form["bloq_hr_chegada"] = $this->bloq_hr_chegada;
              $this->bloq_num_voo = "";  
              $this->nmgp_dados_form["bloq_num_voo"] = $this->bloq_num_voo;
              $this->bloq_num_pass_etkt = "";  
              $this->nmgp_dados_form["bloq_num_pass_etkt"] = $this->bloq_num_pass_etkt;
              $this->bloq_localizador = "";  
              $this->nmgp_dados_form["bloq_localizador"] = $this->bloq_localizador;
              $this->bloq_qtd_lugares = "";  
              $this->nmgp_dados_form["bloq_qtd_lugares"] = $this->bloq_qtd_lugares;
              $this->bloq_saldo_lugares = "";  
              $this->nmgp_dados_form["bloq_saldo_lugares"] = $this->bloq_saldo_lugares;
              $this->bloq_nota_gate = "";  
              $this->nmgp_dados_form["bloq_nota_gate"] = $this->bloq_nota_gate;
              $this->bloq_dt_nota_gate = "";  
              $this->bloq_dt_nota_gate_hora = "" ;  
              $this->nmgp_dados_form["bloq_dt_nota_gate"] = $this->bloq_dt_nota_gate;
              $this->rodape = "";  
              $this->nmgp_dados_form["rodape"] = $this->rodape;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dados_form'] = $this->nmgp_dados_form;
              $this->formatado = false;
          }
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['foreign_key'] as $sFKName => $sFKValue)
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
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(bloqueio_id) from " . $this->Ini->nm_tabela . " where bloqueio_id < $this->bloqueio_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(bloqueio_id) from " . $this->Ini->nm_tabela . " where bloqueio_id < $this->bloqueio_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(bloqueio_id) from " . $this->Ini->nm_tabela . " where bloqueio_id < $this->bloqueio_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(bloqueio_id) from " . $this->Ini->nm_tabela . " where bloqueio_id < $this->bloqueio_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(bloqueio_id) from " . $this->Ini->nm_tabela . " where bloqueio_id < $this->bloqueio_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(bloqueio_id) from " . $this->Ini->nm_tabela . " where bloqueio_id < $this->bloqueio_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(bloqueio_id) from " . $this->Ini->nm_tabela . " where bloqueio_id < $this->bloqueio_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(bloqueio_id) from " . $this->Ini->nm_tabela . " where bloqueio_id < $this->bloqueio_id" . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(bloqueio_id) from " . $this->Ini->nm_tabela . " where bloqueio_id < $this->bloqueio_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select max(bloqueio_id) from " . $this->Ini->nm_tabela . " where bloqueio_id < $this->bloqueio_id" . $str_where_filter); 
     }  
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (isset($rs->fields[0]) && $rs->fields[0] != "") 
     { 
         $this->bloqueio_id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
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
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(bloqueio_id) from " . $this->Ini->nm_tabela . " where bloqueio_id > $this->bloqueio_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(bloqueio_id) from " . $this->Ini->nm_tabela . " where bloqueio_id > $this->bloqueio_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(bloqueio_id) from " . $this->Ini->nm_tabela . " where bloqueio_id > $this->bloqueio_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(bloqueio_id) from " . $this->Ini->nm_tabela . " where bloqueio_id > $this->bloqueio_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(bloqueio_id) from " . $this->Ini->nm_tabela . " where bloqueio_id > $this->bloqueio_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(bloqueio_id) from " . $this->Ini->nm_tabela . " where bloqueio_id > $this->bloqueio_id" . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(bloqueio_id) from " . $this->Ini->nm_tabela . " where bloqueio_id > $this->bloqueio_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(bloqueio_id) from " . $this->Ini->nm_tabela . " where bloqueio_id > $this->bloqueio_id" . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(bloqueio_id) from " . $this->Ini->nm_tabela . " where bloqueio_id > $this->bloqueio_id" . $str_where_filter; 
         $rs = $this->Db->Execute("select min(bloqueio_id) from " . $this->Ini->nm_tabela . " where bloqueio_id > $this->bloqueio_id" . $str_where_filter); 
     }  
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (isset($rs->fields[0]) && $rs->fields[0] != "") 
     { 
         $this->bloqueio_id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
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
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(bloqueio_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(bloqueio_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(bloqueio_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(bloqueio_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(bloqueio_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(bloqueio_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(bloqueio_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(bloqueio_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select min(bloqueio_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select min(bloqueio_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
     { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
     }  
     if (!isset($rs->fields[0]) || $rs->EOF) 
     { 
         if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_filter']))
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
     $this->bloqueio_id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
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
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(bloqueio_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(bloqueio_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(bloqueio_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(bloqueio_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(bloqueio_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(bloqueio_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(bloqueio_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(bloqueio_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
     }  
     else  
     {
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(bloqueio_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter; 
         $rs = $this->Db->Execute("select max(bloqueio_id) from " . $this->Ini->nm_tabela . " " . $str_where_filter); 
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
     $this->bloqueio_id = substr($this->Db->qstr($rs->fields[0]), 1, -1); 
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
       $rec_tot    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['total'] + 1;
       $rec_fim    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start'] + 1;
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['record_state'][$sc_seq_vert]['buttons']['update'];
                }
        }

//

function bloq_cia_aerea_onChange()
{
$_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'on';
  
$original_bloq_evento_id = $this->bloq_evento_id;
$original_bloq_cia_aerea = $this->bloq_cia_aerea;


date_default_timezone_set('America/Sao_Paulo');
$sql="
	SELECT    
		evento_id, cia_id
	FROM
		eventos_ciasaer_rsvp
	WHERE 
		evento_id = ".$this->Db->qstr($this->bloq_evento_id )." 
	AND 
		cia_id = ".$this->Db->qstr($this->bloq_cia_aerea )." 
	ORDER BY 		
		cia_id"
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
	
if (!isset($this->rs[0][0])) {			
	$this->nm_mens_alert[] = "Cia Aérea não cadastrada para o Evento!"; $this->nm_params_alert[] = array(); if ($this->NM_ajax_flag) { $this->sc_ajax_alert("Cia Aérea não cadastrada para o Evento!"); }}			

$modificado_bloq_evento_id = $this->bloq_evento_id;
$modificado_bloq_cia_aerea = $this->bloq_cia_aerea;
$this->nm_formatar_campos('bloq_evento_id', 'bloq_cia_aerea');
if ($original_bloq_evento_id !== $modificado_bloq_evento_id || isset($this->nmgp_cmp_readonly['bloq_evento_id']) || (isset($bFlagRead_bloq_evento_id) && $bFlagRead_bloq_evento_id))
{
    $this->ajax_return_values_bloq_evento_id(true);
}
if ($original_bloq_cia_aerea !== $modificado_bloq_cia_aerea || isset($this->nmgp_cmp_readonly['bloq_cia_aerea']) || (isset($bFlagRead_bloq_cia_aerea) && $bFlagRead_bloq_cia_aerea))
{
    $this->ajax_return_values_bloq_cia_aerea(true);
}
$this->NM_ajax_info['event_field'] = 'bloq';
form_bloqueio_aereo_rsvp_pack_ajax_response();
exit;
$_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'off';
}


function bloq_qtd_lugares_onChange()
{
$_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'on';
if (!isset($this->sc_temp_vg_guarda_valor)) {$this->sc_temp_vg_guarda_valor = (isset($_SESSION['vg_guarda_valor'])) ? $_SESSION['vg_guarda_valor'] : "";}
  
$original_bloq_qtd_lugares = $this->bloq_qtd_lugares;
$original_bloq_evento_id = $this->bloq_evento_id;
$original_bloqueio_id = $this->bloqueio_id;
$original_bloq_direcao = $this->bloq_direcao;
$original_bloq_saldo_lugares = $this->bloq_saldo_lugares;


date_default_timezone_set('America/Sao_Paulo');
$valor_n = 'N';
if ($this->bloq_qtd_lugares  > '0') {
	$sql="
	SELECT COUNT(aereo_bloqueio_id) AS qtd_aereo,aereo_id_evento
	FROM
		aereos_rsvp
	WHERE 
		aereo_id_evento = ".$this->Db->qstr($this->bloq_evento_id )." 
	AND 
		aereo_bloqueio_id =  ".$this->Db->qstr($this->bloqueio_id )." 
	AND 
		aereo_status <> ".$this->Db->qstr($valor_n)." 
	AND 
		aereo_direcao = ".$this->Db->qstr($this->bloq_direcao )."  
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
		if ($this->bloq_qtd_lugares  >= $this->bloq_saldo_lugares ) {		
		$_nova_qtd = $this->rs[0][0];
		$_novo_saldo = $this->bloq_qtd_lugares  - $_nova_qtd;
		if ($_novo_saldo > '0') {
			$this->bloq_saldo_lugares  = $_novo_saldo;
			$this->nm_mens_alert[] = "O novo saldo agora é de: ".$_novo_saldo." lugar(es)."; $this->nm_params_alert[] = array(); if ($this->NM_ajax_flag) { $this->sc_ajax_alert("O novo saldo agora é de: ".$_novo_saldo." lugar(es)."); }} else {
			if ($_novo_saldo < '0') {
				$this->nm_mens_alert[] = "O novo saldo não pode ser negativo: ".$_novo_saldo; $this->nm_params_alert[] = array(); if ($this->NM_ajax_flag) { $this->sc_ajax_alert("O novo saldo não pode ser negativo: ".$_novo_saldo); }$this->bloq_qtd_lugares  = $this->sc_temp_vg_guarda_valor;
			} else {
				$this->nm_mens_alert[] = "O novo saldo agora é de: ".$_novo_saldo." lugare(s)."; $this->nm_params_alert[] = array(); if ($this->NM_ajax_flag) { $this->sc_ajax_alert("O novo saldo agora é de: ".$_novo_saldo." lugare(s)."); }$this->bloq_saldo_lugares  = '0';
			}	
		}
		} else {
			$this->nm_mens_alert[] = "A quantidade informada não pode ser menor do que a qtd. de lugares já ocupados."; $this->nm_params_alert[] = array(); if ($this->NM_ajax_flag) { $this->sc_ajax_alert("A quantidade informada não pode ser menor do que a qtd. de lugares já ocupados."); }}	
	}
} else {
	$this->bloq_qtd_lugares  = $this->sc_temp_vg_guarda_valor;
	$this->nm_mens_alert[] = "Informe um valor positivo!"; $this->nm_params_alert[] = array(); if ($this->NM_ajax_flag) { $this->sc_ajax_alert("Informe um valor positivo!"); }}



if (isset($this->sc_temp_vg_guarda_valor)) { $_SESSION['vg_guarda_valor'] = $this->sc_temp_vg_guarda_valor;}
$_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'off';
$modificado_bloq_qtd_lugares = $this->bloq_qtd_lugares;
$modificado_bloq_evento_id = $this->bloq_evento_id;
$modificado_bloqueio_id = $this->bloqueio_id;
$modificado_bloq_direcao = $this->bloq_direcao;
$modificado_bloq_saldo_lugares = $this->bloq_saldo_lugares;
$this->nm_formatar_campos('bloq_qtd_lugares', 'bloq_evento_id', 'bloqueio_id', 'bloq_direcao', 'bloq_saldo_lugares');
if ($original_bloq_qtd_lugares !== $modificado_bloq_qtd_lugares || isset($this->nmgp_cmp_readonly['bloq_qtd_lugares']) || (isset($bFlagRead_bloq_qtd_lugares) && $bFlagRead_bloq_qtd_lugares))
{
    $this->ajax_return_values_bloq_qtd_lugares(true);
}
if ($original_bloq_evento_id !== $modificado_bloq_evento_id || isset($this->nmgp_cmp_readonly['bloq_evento_id']) || (isset($bFlagRead_bloq_evento_id) && $bFlagRead_bloq_evento_id))
{
    $this->ajax_return_values_bloq_evento_id(true);
}
if ($original_bloqueio_id !== $modificado_bloqueio_id || isset($this->nmgp_cmp_readonly['bloqueio_id']) || (isset($bFlagRead_bloqueio_id) && $bFlagRead_bloqueio_id))
{
    $this->ajax_return_values_bloqueio_id(true);
}
if ($original_bloq_direcao !== $modificado_bloq_direcao || isset($this->nmgp_cmp_readonly['bloq_direcao']) || (isset($bFlagRead_bloq_direcao) && $bFlagRead_bloq_direcao))
{
    $this->ajax_return_values_bloq_direcao(true);
}
if ($original_bloq_saldo_lugares !== $modificado_bloq_saldo_lugares || isset($this->nmgp_cmp_readonly['bloq_saldo_lugares']) || (isset($bFlagRead_bloq_saldo_lugares) && $bFlagRead_bloq_saldo_lugares))
{
    $this->ajax_return_values_bloq_saldo_lugares(true);
}
$this->NM_ajax_info['event_field'] = 'bloq';
form_bloqueio_aereo_rsvp_pack_ajax_response();
exit;
}


function GetSaldoBloq($evento_id, $direcao) {
$_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'on';
  	
		date_default_timezone_set('America/Sao_Paulo');
		$ret = TRUE;
		$valor_y = 'Y';
		$valor_n = 'N';
		$valor_0 = '0';
	
		$sqlx="
		SELECT 
			aereo_id_evento,aereo_bloqueio_id 
		FROM 
			aereos_rsvp
		WHERE 
			aereo_id_evento = ".$this->Db->qstr($evento_id)."	
		AND 
			aereo_bloqueio_id <> ".$this->Db->qstr($valor_0)."
		AND 
			aereo_status <>  ".$this->Db->qstr($valor_n)."
		AND 
			aereo_direcao =  ".$this->Db->qstr($direcao)."
		AND
			aereo_ativo  = ".$this->Db->qstr($valor_y)."		
		ORDER BY 
			aereo_cpf_particip, aereo_id_evento"
		;	
		 
      $nm_select = $sqlx; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsl = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rsl[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsl = false;
          $this->rsl_erro = $this->Db->ErrorMsg();
      } 
	
		if (isset($this->rsl[0][0])) {	
				$bloqueio = $this->rsl[0][1];
				$sqljoin="
				SELECT 
					aereos_rsvp.aereo_bloqueio_id,aereos_rsvp.aereo_id_evento,bloqueio_aereo_rsvp.bloq_qtd_lugares,COUNT(aereos_rsvp.aereo_bloqueio_id) AS qtd_aereo, 
					aereos_rsvp.aereo_direcao,aereos_rsvp.aereo_status
				FROM
					aereos_rsvp
				INNER JOIN 
					bloqueio_aereo_rsvp
				ON 
					aereos_rsvp.aereo_bloqueio_id = bloqueio_aereo_rsvp.bloqueio_id
				WHERE
					aereos_rsvp.aereo_bloqueio_id =  ".$this->Db->qstr($bloqueio)."
				AND 
					aereos_rsvp.aereo_status <> ".$this->Db->qstr($valor_n)." AND aereos_rsvp.aereo_direcao = ".$this->Db->qstr($direcao)."
				GROUP BY 
					aereos_rsvp.aereo_bloqueio_id"
				;	
				 
      $nm_select = $sqljoin; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsjoin = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rsjoin[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsjoin = false;
          $this->rsjoin_erro = $this->Db->ErrorMsg();
      } 
		
				if (isset($this->rsjoin[0][0])) {
					$bloqueio_id	= $this->rsjoin[0][0];
					$qtd_lugares	= $this->rsjoin[0][2];
					$qtd_bloqueio	= $this->rsjoin[0][3];
					$saldo			= $qtd_lugares - $qtd_bloqueio;
					$sqlupd="	
					UPDATE 
						bloqueio_aereo_rsvp
					SET 
						bloq_saldo_lugares = ".$this->Db->qstr($saldo)."
					WHERE 
						bloqueio_id = ".$this->Db->qstr($this->bloqueio_id)." 
					";
					 
      $nm_select = $sqlupd; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsupd = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rsupd[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsupd = false;
          $this->rsupd_erro = $this->Db->ErrorMsg();
      } 
	
					$ret = $saldo;
				} else {
					$ret = FALSE;	
				}	
		} else {
			$sqls="
			SELECT 
				bloqueio_id,bloq_evento_id,bloq_direcao,bloq_qtd_lugares,bloq_saldo_lugares
			FROM
				bloqueio_aereo_rsvp
			WHERE
				bloq_evento_id = ".$this->Db->qstr($evento_id)."	
			AND
				bloq_direcao = ".$this->Db->qstr($direcao)."
			ORDER BY
				bloq_evento_id,bloq_direcao
			";
			 
      $nm_select = $sqls; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rss = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rss[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rss = false;
          $this->rss_erro = $this->Db->ErrorMsg();
      } 
	
			if (isset($this->rss[0][0])) {	
				$bloq_id = $this->rss[0][0];	
				$qtd_lugares = $this->rss[0][3];			
				$sqlupd="	
				UPDATE 
					bloqueio_aereo_rsvp
				SET 
					bloq_saldo_lugares = ".$this->Db->qstr($qtd_lugares)." 
				WHERE 
					bloqueio_id =  ".$this->Db->qstr($bloq_id)."  		
				";
				
     $nm_select = $sqlupd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                form_bloqueio_aereo_rsvp_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
			}	
		}	
		return $ret;
$_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'off';
}


function GetUsuarioNivel($idu,$tipo) {
$_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'off';
}


function GravaLog($v_hora_now,$v_ip_usuario,$v_id_usuario,$v_global_cpf,$v_modulo,$v_aplicacao,$v_acao,$v_campo_id,$v_vl_campo_id,$v_campo_cpf,$v_vl_campo_cpf,$v_campo_evt,$v_vl_campo_evt,$v_tabela,$v_obs,$v_sql) {
$_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'on';
  		
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
                form_bloqueio_aereo_rsvp_pack_ajax_response();
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
$_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'off';
}


function PegaIP() {
$_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'on';
  
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
	
$_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['form_bloqueio_aereo_rsvp']['contr_erro'] = 'off';
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
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              form_bloqueio_aereo_rsvp_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
        $this->initFormPages();
    include_once("form_bloqueio_aereo_rsvp_form0.php");
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
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array("bloqueio_id", "bloq_evento_id", "bloq_descricao", "bloq_direcao", "bloq_cia_aerea", "bloq_origem", "bloq_destino", "bloq_dt_saida", "bloq_hr_saida", "bloq_dt_chegada", "bloq_hr_chegada", "bloq_num_voo", "bloq_num_pass_etkt", "bloq_localizador", "bloq_qtd_lugares", "bloq_saldo_lugares", "bloq_nota_gate", "bloq_dt_nota_gate"))) {
            $searchOk = true;
        }
        elseif ($field == $this->nmgp_fast_search && in_array($field, array("bloqueio_id", "bloq_evento_id", "bloq_descricao", "bloq_direcao", "bloq_cia_aerea", "bloq_origem", "bloq_destino", "bloq_dt_saida", "bloq_hr_saida", "bloq_dt_chegada", "bloq_hr_chegada", "bloq_num_voo", "bloq_num_pass_etkt", "bloq_localizador", "bloq_qtd_lugares", "bloq_saldo_lugares", "bloq_nota_gate", "bloq_dt_nota_gate"))) {
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['table_refresh'])
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['csrf_token'];
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

   function Form_lookup_bloq_evento_id()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_evento_id']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_evento_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_evento_id']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_evento_id'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_evento_id']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_evento_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_evento_id']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_evento_id'] = array(); 
    }

   $old_value_bloqueio_id = $this->bloqueio_id;
   $old_value_bloq_dt_saida = $this->bloq_dt_saida;
   $old_value_bloq_hr_saida = $this->bloq_hr_saida;
   $old_value_bloq_dt_chegada = $this->bloq_dt_chegada;
   $old_value_bloq_hr_chegada = $this->bloq_hr_chegada;
   $old_value_bloq_qtd_lugares = $this->bloq_qtd_lugares;
   $old_value_bloq_saldo_lugares = $this->bloq_saldo_lugares;
   $old_value_bloq_dt_nota_gate = $this->bloq_dt_nota_gate;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_bloqueio_id = $this->bloqueio_id;
   $unformatted_value_bloq_dt_saida = $this->bloq_dt_saida;
   $unformatted_value_bloq_hr_saida = $this->bloq_hr_saida;
   $unformatted_value_bloq_dt_chegada = $this->bloq_dt_chegada;
   $unformatted_value_bloq_hr_chegada = $this->bloq_hr_chegada;
   $unformatted_value_bloq_qtd_lugares = $this->bloq_qtd_lugares;
   $unformatted_value_bloq_saldo_lugares = $this->bloq_saldo_lugares;
   $unformatted_value_bloq_dt_nota_gate = $this->bloq_dt_nota_gate;

   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   {
       $nm_comando = "SELECT evento_id, evento_nome + ' - Cod.: ' + evento_id  FROM eventos_rsvp WHERE evento_id = " . $_SESSION['vg_evento_id'] . " ORDER BY evento_nome, evento_id";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   {
       $nm_comando = "SELECT evento_id, concat(evento_nome,' - Cod.: ',evento_id)  FROM eventos_rsvp WHERE evento_id = " . $_SESSION['vg_evento_id'] . " ORDER BY evento_nome, evento_id";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
   {
       $nm_comando = "SELECT evento_id, evento_nome&' - Cod.: '&evento_id  FROM eventos_rsvp WHERE evento_id = " . $_SESSION['vg_evento_id'] . " ORDER BY evento_nome, evento_id";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
   {
       $nm_comando = "SELECT evento_id, evento_nome||' - Cod.: '||evento_id  FROM eventos_rsvp WHERE evento_id = " . $_SESSION['vg_evento_id'] . " ORDER BY evento_nome, evento_id";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   {
       $nm_comando = "SELECT evento_id, evento_nome + ' - Cod.: ' + convert(char,evento_id)  FROM eventos_rsvp WHERE evento_id = " . $_SESSION['vg_evento_id'] . " ORDER BY evento_nome, evento_id";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
   {
       $nm_comando = "SELECT evento_id, evento_nome||' - Cod.: '||char(evento_id)  FROM eventos_rsvp WHERE evento_id = " . $_SESSION['vg_evento_id'] . " ORDER BY evento_nome, evento_id";
   }
   else
   {
       $nm_comando = "SELECT evento_id, evento_nome||' - Cod.: '||evento_id  FROM eventos_rsvp WHERE evento_id = " . $_SESSION['vg_evento_id'] . " ORDER BY evento_nome, evento_id";
   }

   $this->bloqueio_id = $old_value_bloqueio_id;
   $this->bloq_dt_saida = $old_value_bloq_dt_saida;
   $this->bloq_hr_saida = $old_value_bloq_hr_saida;
   $this->bloq_dt_chegada = $old_value_bloq_dt_chegada;
   $this->bloq_hr_chegada = $old_value_bloq_hr_chegada;
   $this->bloq_qtd_lugares = $old_value_bloq_qtd_lugares;
   $this->bloq_saldo_lugares = $old_value_bloq_saldo_lugares;
   $this->bloq_dt_nota_gate = $old_value_bloq_dt_nota_gate;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_evento_id'][] = $rs->fields[0];
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
   function Form_lookup_bloq_direcao()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Ida?#?IDA?#?S?@?";
       $nmgp_def_dados .= "Volta?#?VOLTA?#?N?@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_bloq_cia_aerea()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea'] = array(); 
    }

   $old_value_bloqueio_id = $this->bloqueio_id;
   $old_value_bloq_dt_saida = $this->bloq_dt_saida;
   $old_value_bloq_hr_saida = $this->bloq_hr_saida;
   $old_value_bloq_dt_chegada = $this->bloq_dt_chegada;
   $old_value_bloq_hr_chegada = $this->bloq_hr_chegada;
   $old_value_bloq_qtd_lugares = $this->bloq_qtd_lugares;
   $old_value_bloq_saldo_lugares = $this->bloq_saldo_lugares;
   $old_value_bloq_dt_nota_gate = $this->bloq_dt_nota_gate;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_bloqueio_id = $this->bloqueio_id;
   $unformatted_value_bloq_dt_saida = $this->bloq_dt_saida;
   $unformatted_value_bloq_hr_saida = $this->bloq_hr_saida;
   $unformatted_value_bloq_dt_chegada = $this->bloq_dt_chegada;
   $unformatted_value_bloq_hr_chegada = $this->bloq_hr_chegada;
   $unformatted_value_bloq_qtd_lugares = $this->bloq_qtd_lugares;
   $unformatted_value_bloq_saldo_lugares = $this->bloq_saldo_lugares;
   $unformatted_value_bloq_dt_nota_gate = $this->bloq_dt_nota_gate;

   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   {
       $nm_comando = "SELECT cia_id, cia_nome + ' - ' + cia_sigla  FROM tbl_cia_aereas  WHERE cia_ativo = 'Y' ORDER BY cia_nome, cia_sigla";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   {
       $nm_comando = "SELECT cia_id, concat(cia_nome,' - ', cia_sigla)  FROM tbl_cia_aereas  WHERE cia_ativo = 'Y' ORDER BY cia_nome, cia_sigla";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
   {
       $nm_comando = "SELECT cia_id, cia_nome&' - '&cia_sigla  FROM tbl_cia_aereas  WHERE cia_ativo = 'Y' ORDER BY cia_nome, cia_sigla";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
   {
       $nm_comando = "SELECT cia_id, cia_nome||' - '||cia_sigla  FROM tbl_cia_aereas  WHERE cia_ativo = 'Y' ORDER BY cia_nome, cia_sigla";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   {
       $nm_comando = "SELECT cia_id, cia_nome + ' - ' + cia_sigla  FROM tbl_cia_aereas  WHERE cia_ativo = 'Y' ORDER BY cia_nome, cia_sigla";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
   {
       $nm_comando = "SELECT cia_id, cia_nome||' - '||cia_sigla  FROM tbl_cia_aereas  WHERE cia_ativo = 'Y' ORDER BY cia_nome, cia_sigla";
   }
   else
   {
       $nm_comando = "SELECT cia_id, cia_nome||' - '||cia_sigla  FROM tbl_cia_aereas  WHERE cia_ativo = 'Y' ORDER BY cia_nome, cia_sigla";
   }

   $this->bloqueio_id = $old_value_bloqueio_id;
   $this->bloq_dt_saida = $old_value_bloq_dt_saida;
   $this->bloq_hr_saida = $old_value_bloq_hr_saida;
   $this->bloq_dt_chegada = $old_value_bloq_dt_chegada;
   $this->bloq_hr_chegada = $old_value_bloq_hr_chegada;
   $this->bloq_qtd_lugares = $old_value_bloq_qtd_lugares;
   $this->bloq_saldo_lugares = $old_value_bloq_saldo_lugares;
   $this->bloq_dt_nota_gate = $old_value_bloq_dt_nota_gate;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea'][] = $rs->fields[0];
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
   function Form_lookup_bloq_origem()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem'] = array(); 
    }

   $old_value_bloqueio_id = $this->bloqueio_id;
   $old_value_bloq_dt_saida = $this->bloq_dt_saida;
   $old_value_bloq_hr_saida = $this->bloq_hr_saida;
   $old_value_bloq_dt_chegada = $this->bloq_dt_chegada;
   $old_value_bloq_hr_chegada = $this->bloq_hr_chegada;
   $old_value_bloq_qtd_lugares = $this->bloq_qtd_lugares;
   $old_value_bloq_saldo_lugares = $this->bloq_saldo_lugares;
   $old_value_bloq_dt_nota_gate = $this->bloq_dt_nota_gate;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_bloqueio_id = $this->bloqueio_id;
   $unformatted_value_bloq_dt_saida = $this->bloq_dt_saida;
   $unformatted_value_bloq_hr_saida = $this->bloq_hr_saida;
   $unformatted_value_bloq_dt_chegada = $this->bloq_dt_chegada;
   $unformatted_value_bloq_hr_chegada = $this->bloq_hr_chegada;
   $unformatted_value_bloq_qtd_lugares = $this->bloq_qtd_lugares;
   $unformatted_value_bloq_saldo_lugares = $this->bloq_saldo_lugares;
   $unformatted_value_bloq_dt_nota_gate = $this->bloq_dt_nota_gate;

   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO + ' - ' + SIGLA + ' - ' + NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   {
       $nm_comando = "SELECT COD_AEROPORTO, concat(NOM_AEROPORTO,' - ', SIGLA,' - ', NOM_CIDADE)  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO&' - '&SIGLA&' - '&NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO + ' - ' + SIGLA + ' - ' + NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   else
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }

   $this->bloqueio_id = $old_value_bloqueio_id;
   $this->bloq_dt_saida = $old_value_bloq_dt_saida;
   $this->bloq_hr_saida = $old_value_bloq_hr_saida;
   $this->bloq_dt_chegada = $old_value_bloq_dt_chegada;
   $this->bloq_hr_chegada = $old_value_bloq_hr_chegada;
   $this->bloq_qtd_lugares = $old_value_bloq_qtd_lugares;
   $this->bloq_saldo_lugares = $old_value_bloq_saldo_lugares;
   $this->bloq_dt_nota_gate = $old_value_bloq_dt_nota_gate;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem'][] = $rs->fields[0];
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
   function Form_lookup_bloq_destino()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino'] = array(); 
    }

   $old_value_bloqueio_id = $this->bloqueio_id;
   $old_value_bloq_dt_saida = $this->bloq_dt_saida;
   $old_value_bloq_hr_saida = $this->bloq_hr_saida;
   $old_value_bloq_dt_chegada = $this->bloq_dt_chegada;
   $old_value_bloq_hr_chegada = $this->bloq_hr_chegada;
   $old_value_bloq_qtd_lugares = $this->bloq_qtd_lugares;
   $old_value_bloq_saldo_lugares = $this->bloq_saldo_lugares;
   $old_value_bloq_dt_nota_gate = $this->bloq_dt_nota_gate;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_bloqueio_id = $this->bloqueio_id;
   $unformatted_value_bloq_dt_saida = $this->bloq_dt_saida;
   $unformatted_value_bloq_hr_saida = $this->bloq_hr_saida;
   $unformatted_value_bloq_dt_chegada = $this->bloq_dt_chegada;
   $unformatted_value_bloq_hr_chegada = $this->bloq_hr_chegada;
   $unformatted_value_bloq_qtd_lugares = $this->bloq_qtd_lugares;
   $unformatted_value_bloq_saldo_lugares = $this->bloq_saldo_lugares;
   $unformatted_value_bloq_dt_nota_gate = $this->bloq_dt_nota_gate;

   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO + ' - ' + SIGLA + ' - ' + NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   {
       $nm_comando = "SELECT COD_AEROPORTO, concat(NOM_AEROPORTO,' - ', SIGLA,' - ', NOM_CIDADE)  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO&' - '&SIGLA&' - '&NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO + ' - ' + SIGLA + ' - ' + NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   else
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }

   $this->bloqueio_id = $old_value_bloqueio_id;
   $this->bloq_dt_saida = $old_value_bloq_dt_saida;
   $this->bloq_hr_saida = $old_value_bloq_hr_saida;
   $this->bloq_dt_chegada = $old_value_bloq_dt_chegada;
   $this->bloq_hr_chegada = $old_value_bloq_hr_chegada;
   $this->bloq_qtd_lugares = $old_value_bloq_qtd_lugares;
   $this->bloq_saldo_lugares = $old_value_bloq_saldo_lugares;
   $this->bloq_dt_nota_gate = $old_value_bloq_dt_nota_gate;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino'][] = $rs->fields[0];
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
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dyn_search_and_or']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dyn_search_cache']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              form_bloqueio_aereo_rsvp_pack_ajax_response();
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
          if ($field == "SC_all_Cmp" || $field == "bloqueio_id") 
          {
              $this->SC_monta_condicao($comando, "bloqueio_id", $arg_search, str_replace(",", ".", $data_search), "INT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "bloq_evento_id") 
          {
              $data_lookup = $this->SC_lookup_bloq_evento_id($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "bloq_evento_id", $arg_search, $data_lookup, "INT", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "bloq_descricao") 
          {
              $this->SC_monta_condicao($comando, "bloq_descricao", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "bloq_direcao") 
          {
              $data_lookup = $this->SC_lookup_bloq_direcao($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "bloq_direcao", $arg_search, $data_lookup, "VARCHAR", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "bloq_cia_aerea") 
          {
              $data_lookup = $this->SC_lookup_bloq_cia_aerea($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "bloq_cia_aerea", $arg_search, $data_lookup, "INT", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "bloq_origem") 
          {
              $data_lookup = $this->SC_lookup_bloq_origem($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "bloq_origem", $arg_search, $data_lookup, "INT", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "bloq_destino") 
          {
              $data_lookup = $this->SC_lookup_bloq_destino($arg_search, $data_search);
              if (is_array($data_lookup) && !empty($data_lookup)) 
              {
                  $this->SC_monta_condicao($comando, "bloq_destino", $arg_search, $data_lookup, "INT", false);
              }
          }
          if ($field == "SC_all_Cmp" || $field == "bloq_dt_saida") 
          {
              $this->SC_monta_condicao($comando, "bloq_dt_saida", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "bloq_hr_saida") 
          {
              $this->SC_monta_condicao($comando, "bloq_hr_saida", $arg_search, $data_search, "TIME", false);
          }
          if ($field == "SC_all_Cmp" || $field == "bloq_dt_chegada") 
          {
              $this->SC_monta_condicao($comando, "bloq_dt_chegada", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "bloq_hr_chegada") 
          {
              $this->SC_monta_condicao($comando, "bloq_hr_chegada", $arg_search, $data_search, "TIME", false);
          }
          if ($field == "SC_all_Cmp" || $field == "bloq_num_voo") 
          {
              $this->SC_monta_condicao($comando, "bloq_num_voo", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "bloq_num_pass_etkt") 
          {
              $this->SC_monta_condicao($comando, "bloq_num_pass_etkt", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "bloq_localizador") 
          {
              $this->SC_monta_condicao($comando, "bloq_localizador", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "bloq_qtd_lugares") 
          {
              $this->SC_monta_condicao($comando, "bloq_qtd_lugares", $arg_search, str_replace(",", ".", $data_search), "SMALLINT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "bloq_saldo_lugares") 
          {
              $this->SC_monta_condicao($comando, "bloq_saldo_lugares", $arg_search, str_replace(",", ".", $data_search), "SMALLINT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "bloq_nota_gate") 
          {
              $this->SC_monta_condicao($comando, "bloq_nota_gate", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "bloq_dt_nota_gate") 
          {
              $this->SC_monta_condicao($comando, "bloq_dt_nota_gate", $arg_search, $data_search, "DATE", false);
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_filter_form'] . " and (" . $comando . ")";
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
      $qt_geral_reg_form_bloqueio_aereo_rsvp = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['total'] = $qt_geral_reg_form_bloqueio_aereo_rsvp;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_bloqueio_aereo_rsvp_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_bloqueio_aereo_rsvp_pack_ajax_response();
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
      $nm_numeric[] = "bloqueio_id";$nm_numeric[] = "bloq_evento_id";$nm_numeric[] = "bloq_cia_aerea";$nm_numeric[] = "bloq_origem";$nm_numeric[] = "bloq_destino";$nm_numeric[] = "bloq_qtd_lugares";$nm_numeric[] = "bloq_saldo_lugares";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['decimal_db'] == ".")
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
      $Nm_datas["bloq_dt_saida"] = "date";$Nm_datas["bloq_dt_chegada"] = "date";$Nm_datas["bloq_hr_saida"] = "time";$Nm_datas["bloq_hr_chegada"] = "time";$Nm_datas["bloq_dt_nota_gate"] = "date";
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
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['SC_sep_date']))
              {
                  $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['SC_sep_date'];
                  $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['SC_sep_date1'];
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
   function SC_lookup_bloq_evento_id($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT evento_nome + ' - Cod.: ' + evento_id, evento_id FROM eventos_rsvp WHERE (#cmp_ievento_nome + ' - Cod.: ' + evento_id#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (evento_id = " . $_SESSION['vg_evento_id'] . ")" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(evento_nome,' - Cod.: ',evento_id), evento_id FROM eventos_rsvp WHERE (#cmp_iconcat(evento_nome,' - Cod.: ',evento_id)#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (evento_id = " . $_SESSION['vg_evento_id'] . ")" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT evento_nome&' - Cod.: '&evento_id, evento_id FROM eventos_rsvp WHERE (#cmp_ievento_nome&' - Cod.: '&evento_id#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (evento_id = " . $_SESSION['vg_evento_id'] . ")" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT evento_nome||' - Cod.: '||evento_id, evento_id FROM eventos_rsvp WHERE (#cmp_ievento_nome||' - Cod.: '||evento_id#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (evento_id = " . $_SESSION['vg_evento_id'] . ")" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT evento_nome + ' - Cod.: ' + convert(char,evento_id), evento_id FROM eventos_rsvp WHERE (#cmp_ievento_nome + ' - Cod.: ' + convert(char,evento_id)#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (evento_id = " . $_SESSION['vg_evento_id'] . ")" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT evento_nome||' - Cod.: '||char(evento_id), evento_id FROM eventos_rsvp WHERE (#cmp_ievento_nome||' - Cod.: '||char(evento_id)#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (evento_id = " . $_SESSION['vg_evento_id'] . ")" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT evento_nome||' - Cod.: '||evento_id, evento_id FROM eventos_rsvp WHERE (#cmp_ievento_nome||' - Cod.: '||evento_id#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (evento_id = " . $_SESSION['vg_evento_id'] . ")" ; 
      } 
       if ($condicao == "ii")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "LIKE '#arg_i" . $campo . "#arg_f%'", $nm_comando);
       }
       if ($condicao == "np")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "NOT LIKE '%#arg_i" . $campo . "#arg_f%'", $nm_comando);
       }
       if ($condicao == "df")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "<> '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "gt")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "> '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "ge")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", ">= '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "lt")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "< '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "le")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "<= '#arg_i" . $campo . "#arg_f'", $nm_comando);
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
   function SC_lookup_bloq_direcao($condicao, $campo)
   {
       $data_look = array();
       $campo  = substr($this->Db->qstr($campo), 1, -1);
       $data_look['IDA'] = "Ida";
       $data_look['VOLTA'] = "Volta";
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
   function SC_lookup_bloq_cia_aerea($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT cia_nome + ' - ' + cia_sigla, cia_id FROM tbl_cia_aereas WHERE (#cmp_icia_nome + ' - ' + cia_sigla#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (cia_ativo = 'Y')" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(cia_nome,' - ',cia_sigla), cia_id FROM tbl_cia_aereas WHERE (#cmp_iconcat(cia_nome,' - ',cia_sigla)#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (cia_ativo = 'Y')" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT cia_nome&' - '&cia_sigla, cia_id FROM tbl_cia_aereas WHERE (#cmp_icia_nome&' - '&cia_sigla#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (cia_ativo = 'Y')" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT cia_nome||' - '||cia_sigla, cia_id FROM tbl_cia_aereas WHERE (#cmp_icia_nome||' - '||cia_sigla#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (cia_ativo = 'Y')" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT cia_nome + ' - ' + cia_sigla, cia_id FROM tbl_cia_aereas WHERE (#cmp_icia_nome + ' - ' + cia_sigla#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (cia_ativo = 'Y')" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT cia_nome||' - '||cia_sigla, cia_id FROM tbl_cia_aereas WHERE (#cmp_icia_nome||' - '||cia_sigla#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (cia_ativo = 'Y')" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT cia_nome||' - '||cia_sigla, cia_id FROM tbl_cia_aereas WHERE (#cmp_icia_nome||' - '||cia_sigla#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos) AND (cia_ativo = 'Y')" ; 
      } 
       if ($condicao == "ii")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "LIKE '#arg_i" . $campo . "#arg_f%'", $nm_comando);
       }
       if ($condicao == "np")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "NOT LIKE '%#arg_i" . $campo . "#arg_f%'", $nm_comando);
       }
       if ($condicao == "df")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "<> '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "gt")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "> '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "ge")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", ">= '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "lt")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "< '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "le")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "<= '#arg_i" . $campo . "#arg_f'", $nm_comando);
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
   function SC_lookup_bloq_origem($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT NOM_AEROPORTO + ' - ' + SIGLA + ' - ' + NOM_CIDADE, COD_AEROPORTO FROM aeroporto WHERE (#cmp_iNOM_AEROPORTO + ' - ' + SIGLA + ' - ' + NOM_CIDADE#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(NOM_AEROPORTO,' - ',SIGLA,' - ',NOM_CIDADE), COD_AEROPORTO FROM aeroporto WHERE (#cmp_iconcat(NOM_AEROPORTO,' - ',SIGLA,' - ',NOM_CIDADE)#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT NOM_AEROPORTO&' - '&SIGLA&' - '&NOM_CIDADE, COD_AEROPORTO FROM aeroporto WHERE (#cmp_iNOM_AEROPORTO&' - '&SIGLA&' - '&NOM_CIDADE#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT NOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE, COD_AEROPORTO FROM aeroporto WHERE (#cmp_iNOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT NOM_AEROPORTO + ' - ' + SIGLA + ' - ' + NOM_CIDADE, COD_AEROPORTO FROM aeroporto WHERE (#cmp_iNOM_AEROPORTO + ' - ' + SIGLA + ' - ' + NOM_CIDADE#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT NOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE, COD_AEROPORTO FROM aeroporto WHERE (#cmp_iNOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT NOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE, COD_AEROPORTO FROM aeroporto WHERE (#cmp_iNOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
      } 
       if ($condicao == "ii")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "LIKE '#arg_i" . $campo . "#arg_f%'", $nm_comando);
       }
       if ($condicao == "np")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "NOT LIKE '%#arg_i" . $campo . "#arg_f%'", $nm_comando);
       }
       if ($condicao == "df")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "<> '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "gt")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "> '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "ge")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", ">= '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "lt")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "< '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "le")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "<= '#arg_i" . $campo . "#arg_f'", $nm_comando);
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
   function SC_lookup_bloq_destino($condicao, $campo)
   {
       $result = array();
       $campo_orig = $campo;
       $campo  = substr($this->Db->qstr($campo), 1, -1);
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nm_comando = "SELECT NOM_AEROPORTO + ' - ' + SIGLA + ' - ' + NOM_CIDADE, COD_AEROPORTO FROM aeroporto WHERE (#cmp_iNOM_AEROPORTO + ' - ' + SIGLA + ' - ' + NOM_CIDADE#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nm_comando = "SELECT concat(NOM_AEROPORTO,' - ',SIGLA,' - ',NOM_CIDADE), COD_AEROPORTO FROM aeroporto WHERE (#cmp_iconcat(NOM_AEROPORTO,' - ',SIGLA,' - ',NOM_CIDADE)#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "SELECT NOM_AEROPORTO&' - '&SIGLA&' - '&NOM_CIDADE, COD_AEROPORTO FROM aeroporto WHERE (#cmp_iNOM_AEROPORTO&' - '&SIGLA&' - '&NOM_CIDADE#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
      { 
          $nm_comando = "SELECT NOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE, COD_AEROPORTO FROM aeroporto WHERE (#cmp_iNOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "SELECT NOM_AEROPORTO + ' - ' + SIGLA + ' - ' + NOM_CIDADE, COD_AEROPORTO FROM aeroporto WHERE (#cmp_iNOM_AEROPORTO + ' - ' + SIGLA + ' - ' + NOM_CIDADE#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
      { 
          $nm_comando = "SELECT NOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE, COD_AEROPORTO FROM aeroporto WHERE (#cmp_iNOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
      } 
      else 
      { 
          $nm_comando = "SELECT NOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE, COD_AEROPORTO FROM aeroporto WHERE (#cmp_iNOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE#cmp_f#cmp_apos LIKE '%#arg_i" . $campo . "#arg_f%'#arg_apos)" ; 
      } 
       if ($condicao == "ii")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "LIKE '#arg_i" . $campo . "#arg_f%'", $nm_comando);
       }
       if ($condicao == "np")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "NOT LIKE '%#arg_i" . $campo . "#arg_f%'", $nm_comando);
       }
       if ($condicao == "df")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "<> '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "gt")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "> '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "ge")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", ">= '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "lt")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "< '#arg_i" . $campo . "#arg_f'", $nm_comando);
       }
       if ($condicao == "le")
       {
           $nm_comando = str_replace("LIKE '%#arg_i" . $campo . "#arg_f%'", "<= '#arg_i" . $campo . "#arg_f'", $nm_comando);
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
       $nmgp_saida_form = "form_bloqueio_aereo_rsvp_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['nm_run_menu'] = 2;
       $nmgp_saida_form = "form_bloqueio_aereo_rsvp_fim.php";
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
       form_bloqueio_aereo_rsvp_pack_ajax_response();
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['masterValue']);
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
    function sc_field_readonly($sField, $sStatus, $iSeq = '')
    {
        if ('on' != $sStatus && 'off' != $sStatus)
        {
            return;
        }

        $sFieldDateTime = '';

        $sFlagVar        = 'bFlagRead_' . $sField;
        $this->$sFlagVar = 'on' == $sStatus;

        $this->nmgp_cmp_readonly[$sField]                = $sStatus;
        $this->NM_ajax_info['readOnly'][$sField . $iSeq] = $sStatus;
        if ('' != $sFieldDateTime)
        {
            $this->NM_ajax_info['readOnly'][$sFieldDateTime . $iSeq] = $sStatus;
        }
    } // sc_field_readonly
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['link_info']['compact_mode']) {
            return;
        }
?>
    <tr id="sc_form_head"><td class="sc-app-header">
<?php if (!empty($_SESSION['scriptcase']['proc_mobile'])) { ?>
<style>
    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}
</style>
<div class="scFormHeader" style="height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;">
    <div class="scFormHeaderFont" style="float: left; text-transform: uppercase;"><?php if ($this->nmgp_opcao == "novo") { echo "BRSVP - Cadastro de Bloqueio Aéreo - Inclusão"; } else { echo "BRSVP - Cadastro de Bloqueio Aéreo - Alteração"; } ?></div>
    <div class="scFormHeaderFont" style="float: right;"><?php echo date($this->dateDefaultFormat()); ?></div>
</div>
<?php } else { ?>
<style>
    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}
</style>
<div class="scFormHeader" style="height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;">
    <div class="scFormHeaderFont" style="float: left; text-transform: uppercase;"><?php if ($this->nmgp_opcao == "novo") { echo "BRSVP - Cadastro de Bloqueio Aéreo - Inclusão"; } else { echo "BRSVP - Cadastro de Bloqueio Aéreo - Alteração"; } ?></div>
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['link_info']['compact_mode']) {
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
        if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "R") {
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['ordem_ord'] == " desc") {
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
            case "bloqueio_id":
                return true;
            case "bloq_qtd_lugares":
                return true;
            case "bloq_saldo_lugares":
                return true;
            default:
                return false;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
            case "bloqueio_id":
                return 'desc';
            case "bloq_evento_id":
                return 'desc';
            case "bloq_cia_aerea":
                return 'desc';
            case "bloq_origem":
                return 'desc';
            case "bloq_destino":
                return 'desc';
            case "bloq_dt_saida":
                return 'desc';
            case "bloq_hr_saida":
                return 'desc';
            case "bloq_dt_chegada":
                return 'desc';
            case "bloq_hr_chegada":
                return 'desc';
            case "bloq_qtd_lugares":
                return 'desc';
            case "bloq_saldo_lugares":
                return 'desc';
            case "bloq_dt_nota_gate":
                return 'desc';
            default:
                return 'asc';
        }
        return 'asc';
    }

}
?>
