<?php
//
class control_bloq_ac_mob_apl
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
   var $bloq_dsc;
   var $bloq_dsc_1;
   var $id_hotel_atual;
   var $acomodacao_atual;
   var $categoria_atual;
   var $evento_atual;
   var $quartos_atual;
   var $saldo_quartos;
   var $bloq_dsc_subs;
   var $bloq_dsc_subs_1;
   var $id_hotel_subs;
   var $acomodacao_subs;
   var $categoria_subs;
   var $evento_subs;
   var $quartos_subs;
   var $saldo_quartos_subs;
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
            $glo_senha_protect, $bok, $nm_apl_dependente, $nm_form_submit, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup, $nmgp_redir;


      if ($this->NM_ajax_flag)
      {
          if (isset($this->NM_ajax_info['param']['acomodacao_atual']))
          {
              $this->acomodacao_atual = $this->NM_ajax_info['param']['acomodacao_atual'];
          }
          if (isset($this->NM_ajax_info['param']['acomodacao_subs']))
          {
              $this->acomodacao_subs = $this->NM_ajax_info['param']['acomodacao_subs'];
          }
          if (isset($this->NM_ajax_info['param']['bloq_dsc']))
          {
              $this->bloq_dsc = $this->NM_ajax_info['param']['bloq_dsc'];
          }
          if (isset($this->NM_ajax_info['param']['bloq_dsc_subs']))
          {
              $this->bloq_dsc_subs = $this->NM_ajax_info['param']['bloq_dsc_subs'];
          }
          if (isset($this->NM_ajax_info['param']['categoria_atual']))
          {
              $this->categoria_atual = $this->NM_ajax_info['param']['categoria_atual'];
          }
          if (isset($this->NM_ajax_info['param']['categoria_subs']))
          {
              $this->categoria_subs = $this->NM_ajax_info['param']['categoria_subs'];
          }
          if (isset($this->NM_ajax_info['param']['csrf_token']))
          {
              $this->csrf_token = $this->NM_ajax_info['param']['csrf_token'];
          }
          if (isset($this->NM_ajax_info['param']['evento_atual']))
          {
              $this->evento_atual = $this->NM_ajax_info['param']['evento_atual'];
          }
          if (isset($this->NM_ajax_info['param']['evento_subs']))
          {
              $this->evento_subs = $this->NM_ajax_info['param']['evento_subs'];
          }
          if (isset($this->NM_ajax_info['param']['id_hotel_atual']))
          {
              $this->id_hotel_atual = $this->NM_ajax_info['param']['id_hotel_atual'];
          }
          if (isset($this->NM_ajax_info['param']['id_hotel_subs']))
          {
              $this->id_hotel_subs = $this->NM_ajax_info['param']['id_hotel_subs'];
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
          if (isset($this->NM_ajax_info['param']['quartos_atual']))
          {
              $this->quartos_atual = $this->NM_ajax_info['param']['quartos_atual'];
          }
          if (isset($this->NM_ajax_info['param']['quartos_subs']))
          {
              $this->quartos_subs = $this->NM_ajax_info['param']['quartos_subs'];
          }
          if (isset($this->NM_ajax_info['param']['saldo_quartos']))
          {
              $this->saldo_quartos = $this->NM_ajax_info['param']['saldo_quartos'];
          }
          if (isset($this->NM_ajax_info['param']['saldo_quartos_subs']))
          {
              $this->saldo_quartos_subs = $this->NM_ajax_info['param']['saldo_quartos_subs'];
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
      if (isset($this->vg_cod_evento) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['vg_cod_evento'] = $this->vg_cod_evento;
      }
      if (isset($this->vg_cod_hotel) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['vg_cod_hotel'] = $this->vg_cod_hotel;
      }
      if (isset($this->vg_cod_acomo) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['vg_cod_acomo'] = $this->vg_cod_acomo;
      }
      if (isset($this->vg_cod_categ) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['vg_cod_categ'] = $this->vg_cod_categ;
      }
      if (isset($this->vg_qtd_quart) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['vg_qtd_quart'] = $this->vg_qtd_quart;
      }
      if (isset($this->vg_cod_evento_s) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['vg_cod_evento_s'] = $this->vg_cod_evento_s;
      }
      if (isset($this->vg_cod_hotel_s) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['vg_cod_hotel_s'] = $this->vg_cod_hotel_s;
      }
      if (isset($this->vg_cod_acomo_s) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['vg_cod_acomo_s'] = $this->vg_cod_acomo_s;
      }
      if (isset($this->vg_cod_categ_s) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['vg_cod_categ_s'] = $this->vg_cod_categ_s;
      }
      if (isset($this->vg_qtd_quart_s) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['vg_qtd_quart_s'] = $this->vg_qtd_quart_s;
      }
      if (isset($this->rsvp_global) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['rsvp_global'] = $this->rsvp_global;
      }
      if (isset($this->vg_usuario_id) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['vg_usuario_id'] = $this->vg_usuario_id;
      }
      if (isset($_POST["vg_cod_evento"]) && isset($this->vg_cod_evento)) 
      {
          $_SESSION['vg_cod_evento'] = $this->vg_cod_evento;
      }
      if (isset($_POST["vg_cod_hotel"]) && isset($this->vg_cod_hotel)) 
      {
          $_SESSION['vg_cod_hotel'] = $this->vg_cod_hotel;
      }
      if (isset($_POST["vg_cod_acomo"]) && isset($this->vg_cod_acomo)) 
      {
          $_SESSION['vg_cod_acomo'] = $this->vg_cod_acomo;
      }
      if (isset($_POST["vg_cod_categ"]) && isset($this->vg_cod_categ)) 
      {
          $_SESSION['vg_cod_categ'] = $this->vg_cod_categ;
      }
      if (isset($_POST["vg_qtd_quart"]) && isset($this->vg_qtd_quart)) 
      {
          $_SESSION['vg_qtd_quart'] = $this->vg_qtd_quart;
      }
      if (isset($_POST["vg_cod_evento_s"]) && isset($this->vg_cod_evento_s)) 
      {
          $_SESSION['vg_cod_evento_s'] = $this->vg_cod_evento_s;
      }
      if (isset($_POST["vg_cod_hotel_s"]) && isset($this->vg_cod_hotel_s)) 
      {
          $_SESSION['vg_cod_hotel_s'] = $this->vg_cod_hotel_s;
      }
      if (isset($_POST["vg_cod_acomo_s"]) && isset($this->vg_cod_acomo_s)) 
      {
          $_SESSION['vg_cod_acomo_s'] = $this->vg_cod_acomo_s;
      }
      if (isset($_POST["vg_cod_categ_s"]) && isset($this->vg_cod_categ_s)) 
      {
          $_SESSION['vg_cod_categ_s'] = $this->vg_cod_categ_s;
      }
      if (isset($_POST["vg_qtd_quart_s"]) && isset($this->vg_qtd_quart_s)) 
      {
          $_SESSION['vg_qtd_quart_s'] = $this->vg_qtd_quart_s;
      }
      if (isset($_POST["rsvp_global"]) && isset($this->rsvp_global)) 
      {
          $_SESSION['rsvp_global'] = $this->rsvp_global;
      }
      if (isset($_POST["vg_usuario_id"]) && isset($this->vg_usuario_id)) 
      {
          $_SESSION['vg_usuario_id'] = $this->vg_usuario_id;
      }
      if (isset($_GET["vg_cod_evento"]) && isset($this->vg_cod_evento)) 
      {
          $_SESSION['vg_cod_evento'] = $this->vg_cod_evento;
      }
      if (isset($_GET["vg_cod_hotel"]) && isset($this->vg_cod_hotel)) 
      {
          $_SESSION['vg_cod_hotel'] = $this->vg_cod_hotel;
      }
      if (isset($_GET["vg_cod_acomo"]) && isset($this->vg_cod_acomo)) 
      {
          $_SESSION['vg_cod_acomo'] = $this->vg_cod_acomo;
      }
      if (isset($_GET["vg_cod_categ"]) && isset($this->vg_cod_categ)) 
      {
          $_SESSION['vg_cod_categ'] = $this->vg_cod_categ;
      }
      if (isset($_GET["vg_qtd_quart"]) && isset($this->vg_qtd_quart)) 
      {
          $_SESSION['vg_qtd_quart'] = $this->vg_qtd_quart;
      }
      if (isset($_GET["vg_cod_evento_s"]) && isset($this->vg_cod_evento_s)) 
      {
          $_SESSION['vg_cod_evento_s'] = $this->vg_cod_evento_s;
      }
      if (isset($_GET["vg_cod_hotel_s"]) && isset($this->vg_cod_hotel_s)) 
      {
          $_SESSION['vg_cod_hotel_s'] = $this->vg_cod_hotel_s;
      }
      if (isset($_GET["vg_cod_acomo_s"]) && isset($this->vg_cod_acomo_s)) 
      {
          $_SESSION['vg_cod_acomo_s'] = $this->vg_cod_acomo_s;
      }
      if (isset($_GET["vg_cod_categ_s"]) && isset($this->vg_cod_categ_s)) 
      {
          $_SESSION['vg_cod_categ_s'] = $this->vg_cod_categ_s;
      }
      if (isset($_GET["vg_qtd_quart_s"]) && isset($this->vg_qtd_quart_s)) 
      {
          $_SESSION['vg_qtd_quart_s'] = $this->vg_qtd_quart_s;
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
          $_SESSION['sc_session'][$script_case_init]['control_bloq_ac_mob']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['control_bloq_ac_mob']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['control_bloq_ac_mob']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['control_bloq_ac_mob']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['control_bloq_ac_mob']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['control_bloq_ac_mob']['embutida_parms']);
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
                 nm_limpa_str_control_bloq_ac_mob($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
             }
             $ix++;
          }
          if (isset($this->inside_nested_grid) && 'Y' == $this->inside_nested_grid) {
              $_SESSION['sc_session'][$script_case_init]['control_bloq_ac_mob']['inside_nested_iframe'] = true;
          }
          if (isset($this->vg_cod_evento)) 
          {
              $_SESSION['vg_cod_evento'] = $this->vg_cod_evento;
          }
          if (isset($this->vg_cod_hotel)) 
          {
              $_SESSION['vg_cod_hotel'] = $this->vg_cod_hotel;
          }
          if (isset($this->vg_cod_acomo)) 
          {
              $_SESSION['vg_cod_acomo'] = $this->vg_cod_acomo;
          }
          if (isset($this->vg_cod_categ)) 
          {
              $_SESSION['vg_cod_categ'] = $this->vg_cod_categ;
          }
          if (isset($this->vg_qtd_quart)) 
          {
              $_SESSION['vg_qtd_quart'] = $this->vg_qtd_quart;
          }
          if (isset($this->vg_cod_evento_s)) 
          {
              $_SESSION['vg_cod_evento_s'] = $this->vg_cod_evento_s;
          }
          if (isset($this->vg_cod_hotel_s)) 
          {
              $_SESSION['vg_cod_hotel_s'] = $this->vg_cod_hotel_s;
          }
          if (isset($this->vg_cod_acomo_s)) 
          {
              $_SESSION['vg_cod_acomo_s'] = $this->vg_cod_acomo_s;
          }
          if (isset($this->vg_cod_categ_s)) 
          {
              $_SESSION['vg_cod_categ_s'] = $this->vg_cod_categ_s;
          }
          if (isset($this->vg_qtd_quart_s)) 
          {
              $_SESSION['vg_qtd_quart_s'] = $this->vg_qtd_quart_s;
          }
          if (isset($this->rsvp_global)) 
          {
              $_SESSION['rsvp_global'] = $this->rsvp_global;
          }
          if (isset($this->vg_usuario_id)) 
          {
              $_SESSION['vg_usuario_id'] = $this->vg_usuario_id;
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['control_bloq_ac_mob']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['control_bloq_ac_mob']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['control_bloq_ac_mob']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['control_bloq_ac_mob']['sc_redir_insert'] = $this->sc_redir_insert;
              unset($_SESSION['sc_session'][$script_case_init]['control_bloq_ac_mob']['opc_ant']);
          }
          if (isset($this->vg_cod_evento)) 
          {
              $_SESSION['vg_cod_evento'] = $this->vg_cod_evento;
          }
          if (isset($this->vg_cod_hotel)) 
          {
              $_SESSION['vg_cod_hotel'] = $this->vg_cod_hotel;
          }
          if (isset($this->vg_cod_acomo)) 
          {
              $_SESSION['vg_cod_acomo'] = $this->vg_cod_acomo;
          }
          if (isset($this->vg_cod_categ)) 
          {
              $_SESSION['vg_cod_categ'] = $this->vg_cod_categ;
          }
          if (isset($this->vg_qtd_quart)) 
          {
              $_SESSION['vg_qtd_quart'] = $this->vg_qtd_quart;
          }
          if (isset($this->vg_cod_evento_s)) 
          {
              $_SESSION['vg_cod_evento_s'] = $this->vg_cod_evento_s;
          }
          if (isset($this->vg_cod_hotel_s)) 
          {
              $_SESSION['vg_cod_hotel_s'] = $this->vg_cod_hotel_s;
          }
          if (isset($this->vg_cod_acomo_s)) 
          {
              $_SESSION['vg_cod_acomo_s'] = $this->vg_cod_acomo_s;
          }
          if (isset($this->vg_cod_categ_s)) 
          {
              $_SESSION['vg_cod_categ_s'] = $this->vg_cod_categ_s;
          }
          if (isset($this->vg_qtd_quart_s)) 
          {
              $_SESSION['vg_qtd_quart_s'] = $this->vg_qtd_quart_s;
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
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['control_bloq_ac_mob']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['control_bloq_ac_mob']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['control_bloq_ac_mob']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['control_bloq_ac_mob']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['control_bloq_ac_mob']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['control_bloq_ac_mob']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['control_bloq_ac_mob']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['control_bloq_ac_mob']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['control_bloq_ac_mob']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['control_bloq_ac_mob']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new control_bloq_ac_mob_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("pt_br");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['initialize'];
          $this->Db = $this->Ini->Db; 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['initialize']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['initialize'])
          {
              $_SESSION['scriptcase']['control_bloq_ac_mob']['contr_erro'] = 'on';
  $sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'control_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';
$_SESSION['scriptcase']['control_bloq_ac_mob']['contr_erro'] = 'off';
          if (isset($_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac']))
          {
              foreach ($_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac'] as $I_conf => $Conf_opt)
              {
                  $_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob'][$I_conf]  = $Conf_opt;
              }
          }
          }
          $this->Ini->init2();
      } 
      else 
      { 
         $this->nm_data = new nm_data("pt_br");
      } 
      $_SESSION['sc_session'][$script_case_init]['control_bloq_ac_mob']['upload_field_info'] = array();

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['control_bloq_ac_mob']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['control_bloq_ac_mob'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['control_bloq_ac_mob']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['control_bloq_ac_mob']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('control_bloq_ac_mob') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['control_bloq_ac_mob']['label'] = "Substituições de Bloqueios";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "control_bloq_ac_mob")
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



      $_SESSION['scriptcase']['error_icon']['control_bloq_ac_mob']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['control_bloq_ac_mob'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['goto']      = 'on';
          }
      }

      $this->nmgp_botoes['cancel'] = "on";
      $this->nmgp_botoes['exit'] = "on";
      $this->nmgp_botoes['ok'] = "on";
      $this->nmgp_botoes['facebook'] = "off";
      $this->nmgp_botoes['google'] = "off";
      $this->nmgp_botoes['twitter'] = "off";
      $this->nmgp_botoes['paypal'] = "off";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['where_orig'] = "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['where_pesq'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_bloq_ac_mob']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['control_bloq_ac_mob'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['control_bloq_ac_mob'];

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

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['dados_form'];
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("control_bloq_ac_mob", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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

      if (is_file($this->Ini->path_aplicacao . 'control_bloq_ac_mob_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'control_bloq_ac_mob_help.txt');
          if ($arr_link_webhelp)
          {
              foreach ($arr_link_webhelp as $str_link_webhelp)
              {
                  $str_link_webhelp = trim($str_link_webhelp);
                  if ('contr:' == substr($str_link_webhelp, 0, 6))
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
          require_once($this->Ini->path_embutida . 'control_bloq_ac/control_bloq_ac_mob_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "control_bloq_ac_mob_erro.class.php"); 
      }
      $this->Erro      = new control_bloq_ac_mob_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac_mob']['start']);
          unset($_SESSION['scriptcase']['sc_apl_conf']['control_bloq_ac']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['dados_form'];
      }
      if ($this->nmgp_opcao == "edit_novo")  
      {
          $this->nmgp_opcao = "novo";
          $this->nm_flag_saida_novo = "S";
      }
//
      $this->NM_case_insensitive = true;
      $this->sc_evento = $this->nmgp_opcao;
            if ('ajax_check_file' == $this->nmgp_opcao ){
                 ob_start(); 
                 global $bol_api_prod; 
                 $bol_api_prod = true; 
                 if (isset($_SESSION['scriptcase']['control_bloq_ac_mob']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['control_bloq_ac_mob']['glo_nm_conexao'])) 
                 { 
                     $bol_api_prod = false;
                 } 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['control_bloq_ac_mob']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['control_bloq_ac_mob']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
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
      $Campos_Crit       = "";
      $Campos_erro       = "";
      $Campos_Falta      = array();
      $Campos_Erros      = array();
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          =  substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['dados_select'];
     }
   }

   function loadFieldConfig()
   {
      $this->field_config = array();
   }

   function controle()
   {
        global $nm_url_saida, $teste_validade, 
            $glo_senha_protect, $bok, $nm_apl_dependente, $nm_form_submit, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup, $nmgp_redir;


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
          if ('validate_bloq_dsc' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'bloq_dsc');
          }
          if ('validate_id_hotel_atual' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'id_hotel_atual');
          }
          if ('validate_acomodacao_atual' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'acomodacao_atual');
          }
          if ('validate_categoria_atual' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'categoria_atual');
          }
          if ('validate_evento_atual' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'evento_atual');
          }
          if ('validate_quartos_atual' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'quartos_atual');
          }
          if ('validate_saldo_quartos' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'saldo_quartos');
          }
          if ('validate_bloq_dsc_subs' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'bloq_dsc_subs');
          }
          if ('validate_id_hotel_subs' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'id_hotel_subs');
          }
          if ('validate_acomodacao_subs' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'acomodacao_subs');
          }
          if ('validate_categoria_subs' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'categoria_subs');
          }
          if ('validate_evento_subs' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'evento_subs');
          }
          if ('validate_quartos_subs' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'quartos_subs');
          }
          if ('validate_saldo_quartos_subs' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'saldo_quartos_subs');
          }
          control_bloq_ac_mob_pack_ajax_response();
          exit;
      }
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6))
      {
          $this->nm_tira_formatacao();
          if ('event_bloq_dsc_onchange' == $this->NM_ajax_opcao)
          {
              $this->bloq_dsc_onChange();
          }
          if ('event_bloq_dsc_subs_onchange' == $this->NM_ajax_opcao)
          {
              $this->bloq_dsc_subs_onChange();
          }
          control_bloq_ac_mob_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->nm_tira_formatacao();
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              control_bloq_ac_mob_pack_ajax_response();
              exit;
          }
          $this->nmgp_opcao = $nm_sc_sv_opcao; 
          $this->nm_gera_html();
          $this->NM_close_db(); 
          $this->nmgp_opcao = ""; 
          exit; 
      }
      if ($this->nmgp_opcao == "incluir" || $this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "excluir") 
      {
          $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          $_SESSION['scriptcase']['control_bloq_ac_mob']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  control_bloq_ac_mob_pack_ajax_response();
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
          $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          $_SESSION['scriptcase']['control_bloq_ac_mob']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  control_bloq_ac_mob_pack_ajax_response();
                  exit;
              }
              $campos_erro = $this->Formata_Erros($Campos_Crit, $Campos_Falta, $Campos_Erros);
              $this->Campos_Mens_erro = ""; 
              $this->Erro->mensagem(__FILE__, __LINE__, "critica", $campos_erro); 
              $this->nmgp_opc_ant = $this->nmgp_opcao ; 
              if ($this->nmgp_opcao == "incluir") 
              { 
                  $GLOBALS["erro_incl"] = 1; 
              }
              $this->nmgp_opcao = "nada" ; 
          }
      }
//
      if (!isset($nm_form_submit) && $this->nmgp_opcao != "nada")
      {
          $this->bloq_dsc = "" ;  
          $this->id_hotel_atual = "" ;  
          $this->acomodacao_atual = "" ;  
          $this->categoria_atual = "" ;  
          $this->evento_atual = "" ;  
          $this->quartos_atual = "" ;  
          $this->saldo_quartos = "" ;  
          $this->bloq_dsc_subs = "" ;  
          $this->id_hotel_subs = "" ;  
          $this->acomodacao_subs = "" ;  
          $this->categoria_subs = "" ;  
          $this->evento_subs = "" ;  
          $this->quartos_subs = "" ;  
          $this->saldo_quartos_subs = "" ;  
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['dados_form']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['dados_form']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['dados_form'] as $NM_campo => $NM_valor)
              {
                  $$NM_campo = $NM_valor;
              }
          }
      }
      else
      {
           if ($this->nmgp_opcao != "nada")
           {
           }
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['recarga'] = $this->nmgp_opcao;
      }
      if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "" || $campos_erro != "" || !isset($this->bok) || $this->bok != "OK" || $this->nmgp_opcao == "recarga")
      {
          if ($Campos_Crit == "" && empty($Campos_Falta) && $this->Campos_Mens_erro == "" && !isset($this->bok) && $this->nmgp_opcao != "recarga")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos']))
              { 
                  $bloq_dsc = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][0]; 
                  $id_hotel_atual = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][1]; 
                  $acomodacao_atual = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][2]; 
                  $categoria_atual = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][3]; 
                  $evento_atual = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][4]; 
                  $quartos_atual = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][5]; 
                  $saldo_quartos = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][6]; 
                  $bloq_dsc_subs = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][7]; 
                  $id_hotel_subs = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][8]; 
                  $acomodacao_subs = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][9]; 
                  $categoria_subs = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][10]; 
                  $evento_subs = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][11]; 
                  $quartos_subs = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][12]; 
                  $saldo_quartos_subs = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][13]; 
              } 
          }
          $this->nm_gera_html();
          $this->NM_close_db(); 
      }
      elseif (isset($this->bok) && $this->bok == "OK")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'] = array(); 
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][0] = $this->bloq_dsc; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][1] = $this->id_hotel_atual; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][2] = $this->acomodacao_atual; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][3] = $this->categoria_atual; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][4] = $this->evento_atual; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][5] = $this->quartos_atual; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][6] = $this->saldo_quartos; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][7] = $this->bloq_dsc_subs; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][8] = $this->id_hotel_subs; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][9] = $this->acomodacao_subs; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][10] = $this->categoria_subs; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][11] = $this->evento_subs; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][12] = $this->quartos_subs; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['campos'][13] = $this->saldo_quartos_subs; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['redir'] == "redir")
          {
              $this->nmgp_redireciona(); 
          }
          else
          {
              $contr_menu = "";
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['iframe_menu'])
              {
                  $contr_menu = "glo_menu";
              }
              if (isset($_SESSION['scriptcase']['sc_ult_apl_menu']) && in_array("control_bloq_ac_mob", $_SESSION['scriptcase']['sc_ult_apl_menu']))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona_form("control_bloq_ac_mob_fim.php", $this->nm_location, $contr_menu); 
              }
              else
              {
                  $this->nm_gera_html();
                  if (!$_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['embutida_proc'])
                  { 
                      $this->NM_close_db(); 
                  } 
              }
          }
          $this->NM_close_db(); 
          if ($this->NM_ajax_flag)
          {
              control_bloq_ac_mob_pack_ajax_response();
              exit;
          }
      }
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
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "control_bloq_ac_mob.zip";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("Substituições de Bloqueios") ?></TITLE>
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
<form name="Fdown" method="get" action="control_bloq_ac_mob_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="control_bloq_ac_mob"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<form name="F0" method=post action="control_bloq_ac_mob.php" target="_self" style="display: none"> 
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
           case 'bloq_dsc':
               return "Bloqueio Atual:";
               break;
           case 'id_hotel_atual':
               return "Hotel Atual:";
               break;
           case 'acomodacao_atual':
               return "Acomodação Atual:";
               break;
           case 'categoria_atual':
               return "Categoria Atual:";
               break;
           case 'evento_atual':
               return "Evento:";
               break;
           case 'quartos_atual':
               return "Qtd. Quartos:";
               break;
           case 'saldo_quartos':
               return "Disponível:";
               break;
           case 'bloq_dsc_subs':
               return "Substituir pelo Bloqueio:";
               break;
           case 'id_hotel_subs':
               return "Hotel Substituto:";
               break;
           case 'acomodacao_subs':
               return "Acomodação:";
               break;
           case 'categoria_subs':
               return "Categoria:";
               break;
           case 'evento_subs':
               return "Evento:";
               break;
           case 'quartos_subs':
               return "Qtd. Quartos:";
               break;
           case 'saldo_quartos_subs':
               return "Disponível:";
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

     if (!is_array($filtro) && '' == $filtro && isset($this->nm_form_submit) && '1' == $this->nm_form_submit && isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['csrf_token']) && $this->scCsrfGetToken() != $this->csrf_token)
     {
          $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
          $this->Campos_Mens_erro .= "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          if ($this->NM_ajax_flag)
          {
              if (!isset($this->NM_ajax_info['errList']['geral_control_bloq_ac_mob']) || !is_array($this->NM_ajax_info['errList']['geral_control_bloq_ac_mob']))
              {
                  $this->NM_ajax_info['errList']['geral_control_bloq_ac_mob'] = array();
              }
              $this->NM_ajax_info['errList']['geral_control_bloq_ac_mob'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ((!is_array($filtro) && ('' == $filtro || 'bloq_dsc' == $filtro)) || (is_array($filtro) && in_array('bloq_dsc', $filtro)))
        $this->ValidateField_bloq_dsc($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'id_hotel_atual' == $filtro)) || (is_array($filtro) && in_array('id_hotel_atual', $filtro)))
        $this->ValidateField_id_hotel_atual($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'acomodacao_atual' == $filtro)) || (is_array($filtro) && in_array('acomodacao_atual', $filtro)))
        $this->ValidateField_acomodacao_atual($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'categoria_atual' == $filtro)) || (is_array($filtro) && in_array('categoria_atual', $filtro)))
        $this->ValidateField_categoria_atual($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'evento_atual' == $filtro)) || (is_array($filtro) && in_array('evento_atual', $filtro)))
        $this->ValidateField_evento_atual($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'quartos_atual' == $filtro)) || (is_array($filtro) && in_array('quartos_atual', $filtro)))
        $this->ValidateField_quartos_atual($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'saldo_quartos' == $filtro)) || (is_array($filtro) && in_array('saldo_quartos', $filtro)))
        $this->ValidateField_saldo_quartos($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'bloq_dsc_subs' == $filtro)) || (is_array($filtro) && in_array('bloq_dsc_subs', $filtro)))
        $this->ValidateField_bloq_dsc_subs($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'id_hotel_subs' == $filtro)) || (is_array($filtro) && in_array('id_hotel_subs', $filtro)))
        $this->ValidateField_id_hotel_subs($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'acomodacao_subs' == $filtro)) || (is_array($filtro) && in_array('acomodacao_subs', $filtro)))
        $this->ValidateField_acomodacao_subs($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'categoria_subs' == $filtro)) || (is_array($filtro) && in_array('categoria_subs', $filtro)))
        $this->ValidateField_categoria_subs($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'evento_subs' == $filtro)) || (is_array($filtro) && in_array('evento_subs', $filtro)))
        $this->ValidateField_evento_subs($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'quartos_subs' == $filtro)) || (is_array($filtro) && in_array('quartos_subs', $filtro)))
        $this->ValidateField_quartos_subs($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'saldo_quartos_subs' == $filtro)) || (is_array($filtro) && in_array('saldo_quartos_subs', $filtro)))
        $this->ValidateField_saldo_quartos_subs($Campos_Crit, $Campos_Falta, $Campos_Erros);

      if (empty($Campos_Crit) && empty($Campos_Falta))
      {
      if (!isset($this->NM_ajax_flag) || 'validate_' != substr($this->NM_ajax_opcao, 0, 9))
      {
      $_SESSION['scriptcase']['control_bloq_ac_mob']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_bloq_dsc = $this->bloq_dsc;
    $original_bloq_dsc_subs = $this->bloq_dsc_subs;
    $original_id_hotel_atual = $this->id_hotel_atual;
    $original_id_hotel_subs = $this->id_hotel_subs;
    $original_saldo_quartos_subs = $this->saldo_quartos_subs;
}
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
if (!isset($this->sc_temp_rsvp_global)) {$this->sc_temp_rsvp_global = (isset($_SESSION['rsvp_global'])) ? $_SESSION['rsvp_global'] : "";}
if (!isset($this->sc_temp_vg_cod_categ)) {$this->sc_temp_vg_cod_categ = (isset($_SESSION['vg_cod_categ'])) ? $_SESSION['vg_cod_categ'] : "";}
if (!isset($this->sc_temp_vg_cod_acomo)) {$this->sc_temp_vg_cod_acomo = (isset($_SESSION['vg_cod_acomo'])) ? $_SESSION['vg_cod_acomo'] : "";}
if (!isset($this->sc_temp_vg_cod_hotel)) {$this->sc_temp_vg_cod_hotel = (isset($_SESSION['vg_cod_hotel'])) ? $_SESSION['vg_cod_hotel'] : "";}
if (!isset($this->sc_temp_vg_cod_evento_s)) {$this->sc_temp_vg_cod_evento_s = (isset($_SESSION['vg_cod_evento_s'])) ? $_SESSION['vg_cod_evento_s'] : "";}
if (!isset($this->sc_temp_vg_cod_categ_s)) {$this->sc_temp_vg_cod_categ_s = (isset($_SESSION['vg_cod_categ_s'])) ? $_SESSION['vg_cod_categ_s'] : "";}
if (!isset($this->sc_temp_vg_cod_acomo_s)) {$this->sc_temp_vg_cod_acomo_s = (isset($_SESSION['vg_cod_acomo_s'])) ? $_SESSION['vg_cod_acomo_s'] : "";}
if (!isset($this->sc_temp_vg_cod_hotel_s)) {$this->sc_temp_vg_cod_hotel_s = (isset($_SESSION['vg_cod_hotel_s'])) ? $_SESSION['vg_cod_hotel_s'] : "";}
if (!isset($this->sc_temp_vg_cod_evento)) {$this->sc_temp_vg_cod_evento = (isset($_SESSION['vg_cod_evento'])) ? $_SESSION['vg_cod_evento'] : "";}
  date_default_timezone_set('America/Sao_Paulo');

$params = array(
		'title' => 'Atenção!',
		'type' => 'warning',
		'timer' => '6000',
		'showConfirmButton' => 'false',
		'position' => 'center',
		'toast' => 'true'
		);

$params2 = array(
		'title' => 'Sucesso!',
		'type' => 'success',
		'timer' => '9000',
		'showConfirmButton' => 'false',
		'position' => 'center',
		'toast' => 'true'
		);



if ($retornojavascript  = true ) {
	if($this->id_hotel_atual  == 'ERRO' || $this->id_hotel_atual  == '') {                                                                                      
		$executa = false;		
	} else {
		$executa = true;
	}
	
	if($this->id_hotel_subs  == 'ERRO' || $this->id_hotel_subs  == '') {
		$executa = false;			
	} else {
		$executa = true;
	}		
}

if ($executa == true) {
	if($this->sc_temp_vg_cod_evento <> '') {
		
		$w_parte = explode ("-", $this->bloq_dsc );
		$tamatriz = sizeof($w_parte);
		for ($i=0;$i<$tamatriz;++$i) {		
			$w_codbloq = $w_codbloq.$w_parte[$i];		
		}	

		$sqlu = "
			UPDATE
				hospedagem_rsvp
			SET
				hosp_id_hotel = ".$this->Db->qstr($this->sc_temp_vg_cod_hotel_s).",
				hosp_acomodacao = ".$this->Db->qstr($this->sc_temp_vg_cod_acomo_s).",
				hosp_categoria	= ".$this->Db->qstr($this->sc_temp_vg_cod_categ_s).",
				id_bloqueio_hotel = ".$this->Db->qstr($this->bloq_dsc_subs )." 	
			WHERE
				hosp_id_evento = ".$this->Db->qstr($this->sc_temp_vg_cod_evento_s)."
			AND
				id_bloqueio_hotel = ".$this->Db->qstr($w_codbloq)."
			AND	
				hosp_id_hotel = ".$this->Db->qstr($this->sc_temp_vg_cod_hotel)."
			AND	
				hosp_acomodacao = ".$this->Db->qstr($this->sc_temp_vg_cod_acomo)."
			AND	
				hosp_categoria	= ".$this->Db->qstr($this->sc_temp_vg_cod_categ)."			
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
                control_bloq_ac_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
		$this->nm_mens_alert[] = "Bloqueio susbstituido para todos os Participantes!"; $this->nm_params_alert[] = $params2; if ($this->NM_ajax_flag) { $this->sc_ajax_alert("Bloqueio susbstituido para todos os Participantes!", $params2); }if ($this->sc_temp_rsvp_global['log_rsvp'] == true) { 
			$hora_now = date('Y-m-d H:i:s');
			$ip_usuario = $this->PegaIP();
			$id_usuario = $this->sc_temp_vg_usuario_id;
			$global_cpf = $this->sc_temp_rsvp_global['usuario_cpf'];
			$modulo=  $this->Ini->nm_cod_apl;
			$aplicacao = $this->Ini->nm_nome_apl;			
			$acao = "SUBSTITUIÇÃO COMPLETA BLOQUEIOS HOSPEDAGEM";
			$campo_id = '';
			$vl_campo_id = '';
			$campo_cpf = '';
			$vl_campo_cpf = '';
			$campo_evt = '';
			$vl_campo_evt = '';			
			$tabela = 'hospedagem_rsvp';					
			$obs = 'Hotel substituído: '.$this->sc_temp_vg_cod_hotel_s;			
			$obs .= '  Acomodação substituída: '.$this->sc_temp_vg_cod_acomo_s;			
			$obs .= '  Categoria substituida: '.$this->sc_temp_vg_cod_categ_s;
			$obs .= '  Bloqueio substituído: '.$this->bloq_dsc_subs ;
			$obs .= '  Evento: '.$this->sc_temp_vg_cod_evento_s;		
			$obs =  '  Hotel substituto: '.$this->sc_temp_vg_cod_hotel;
			$obs .= '  Acomodação substituta: '.$this->sc_temp_vg_cod_acomo;
			$obs .= '  Categoria substituta: '.$this->sc_temp_vg_cod_categ;
			$obs .= '  Bloqueio substituto: '.$w_codbloq;
			$retLog = $this->GravaLog($hora_now,$ip_usuario,$id_usuario,$global_cpf,$modulo,$aplicacao,$acao,$campo_id,$vl_campo_id,$campo_cpf,$vl_campo_cpf,$campo_evt,$vl_campo_evt,$tabela,$obs,$sqlu);
			if ($retLog == false) {
				
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Erro ao Gravar LOG";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_control_bloq_ac_mob';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_control_bloq_ac_mob';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Erro ao Gravar LOG";
 }
;					
			}	
		}							
	} else {
		if($this->saldo_quartos_subs  > 0) {
			$valor_y = 'Y';
			$valor_sim = 'SIM';				
			$sqlu = "	
				UPDATE
					hospedagem_rsvp
				SET
					hosp_id_hotel = ".$this->Db->qstr($this->sc_temp_vg_cod_hotel_s).",
					hosp_acomodacao = ".$this->Db->qstr($this->sc_temp_vg_cod_acomo_s).",
					hosp_categoria	= ".$this->Db->qstr($this->sc_temp_vg_cod_categ_s).",
					id_bloqueio_hotel = ".$this->Db->qstr($this->bloq_dsc_subs ).",
					hosp_status = ".$this->Db->qstr($valor_y).",
					conta_roomlist = ".$this->Db->qstr($valor_sim)."
				WHERE
					hosp_id_evento = ".$this->Db->qstr($this->sc_temp_vg_cod_evento_s)."	
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
                control_bloq_ac_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
			$this->nm_mens_alert[] = "Bloqueio susbstituido para todos os Participantes!"; $this->nm_params_alert[] = $params2; if ($this->NM_ajax_flag) { $this->sc_ajax_alert("Bloqueio susbstituido para todos os Participantes!", $params2); }if ($this->sc_temp_rsvp_global['log_rsvp'] == true) { 
				$hora_now = date('Y-m-d H:i:s');
				$ip_usuario = $this->PegaIP();
				$id_usuario = $this->sc_temp_vg_usuario_id;
				$global_cpf = $this->sc_temp_rsvp_global['usuario_cpf'];
				$modulo=  $this->Ini->nm_cod_apl;
				$aplicacao = $this->Ini->nm_nome_apl;			
				$acao = "Substituição Completa Bloqueios hospedagem";
				$campo_id = '';
				$vl_campo_id = '';
				$campo_cpf = '';
				$vl_campo_cpf = '';
				$campo_evt = '';
				$vl_campo_evt = '';
				$tabela = 'hospedagem';		
				$obs = 'Hotel substituído: '.$this->sc_temp_vg_cod_hotel_s;
				$obs .= 'Acomodação substituída: '.$this->sc_temp_vg_cod_acomo_s;
				$obs .= 'Categoria substituida: '.$this->sc_temp_vg_cod_categ_s;
				$obs .= 'Bloqueio substituído: '.$this->bloq_dsc_subs ;
				$obs .= 'Evento: '.$this->sc_temp_vg_cod_evento_s;		
				$retLog = $this->GravaLog($hora_now,$ip_usuario,$id_usuario,$global_cpf,$modulo,$aplicacao,$acao,$campo_id,$vl_campo_id,$campo_cpf,$vl_campo_cpf,$campo_evt,$vl_campo_evt,$tabela,$obs,$sqlu);
				if ($retLog == false) {
					
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Erro ao Gravar LOG";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_control_bloq_ac_mob';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_control_bloq_ac_mob';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Erro ao Gravar LOG";
 }
;					
				}										
			}	
		} else {
			$this->nm_mens_alert[] = "Não existe disponiblilidade de hospedagem suficiente!"; $this->nm_params_alert[] = $params; if ($this->NM_ajax_flag) { $this->sc_ajax_alert("Não existe disponiblilidade de hospedagem suficiente!", $params); }}	
	}	
} else {
	$this->nm_mens_alert[] = "Nenhuma Informação foi atualizada!"; $this->nm_params_alert[] = $params; if ($this->NM_ajax_flag) { $this->sc_ajax_alert("Nenhuma Informação foi atualizada!", $params); }}
if (isset($this->sc_temp_vg_cod_evento)) { $_SESSION['vg_cod_evento'] = $this->sc_temp_vg_cod_evento;}
if (isset($this->sc_temp_vg_cod_hotel_s)) { $_SESSION['vg_cod_hotel_s'] = $this->sc_temp_vg_cod_hotel_s;}
if (isset($this->sc_temp_vg_cod_acomo_s)) { $_SESSION['vg_cod_acomo_s'] = $this->sc_temp_vg_cod_acomo_s;}
if (isset($this->sc_temp_vg_cod_categ_s)) { $_SESSION['vg_cod_categ_s'] = $this->sc_temp_vg_cod_categ_s;}
if (isset($this->sc_temp_vg_cod_evento_s)) { $_SESSION['vg_cod_evento_s'] = $this->sc_temp_vg_cod_evento_s;}
if (isset($this->sc_temp_vg_cod_hotel)) { $_SESSION['vg_cod_hotel'] = $this->sc_temp_vg_cod_hotel;}
if (isset($this->sc_temp_vg_cod_acomo)) { $_SESSION['vg_cod_acomo'] = $this->sc_temp_vg_cod_acomo;}
if (isset($this->sc_temp_vg_cod_categ)) { $_SESSION['vg_cod_categ'] = $this->sc_temp_vg_cod_categ;}
if (isset($this->sc_temp_rsvp_global)) { $_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
if (isset($this->sc_temp_vg_usuario_id)) { $_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (isset($Ctrl_Proc_Onload) && $Ctrl_Proc_Onload) {
        $Ctrl_Format = true;
        $this->nm_guardar_campos();
        if ($bFormat) $this->nm_formatar_campos();
    }
    if (($original_bloq_dsc != $this->bloq_dsc || (isset($bFlagRead_bloq_dsc) && $bFlagRead_bloq_dsc)))
    {
        $this->ajax_return_values_bloq_dsc(true);
    }
    if (($original_bloq_dsc_subs != $this->bloq_dsc_subs || (isset($bFlagRead_bloq_dsc_subs) && $bFlagRead_bloq_dsc_subs)))
    {
        $this->ajax_return_values_bloq_dsc_subs(true);
    }
    if (($original_id_hotel_atual != $this->id_hotel_atual || (isset($bFlagRead_id_hotel_atual) && $bFlagRead_id_hotel_atual)))
    {
        $this->ajax_return_values_id_hotel_atual(true);
    }
    if (($original_id_hotel_subs != $this->id_hotel_subs || (isset($bFlagRead_id_hotel_subs) && $bFlagRead_id_hotel_subs)))
    {
        $this->ajax_return_values_id_hotel_subs(true);
    }
    if (($original_saldo_quartos_subs != $this->saldo_quartos_subs || (isset($bFlagRead_saldo_quartos_subs) && $bFlagRead_saldo_quartos_subs)))
    {
        $this->ajax_return_values_saldo_quartos_subs(true);
    }
}
$_SESSION['scriptcase']['control_bloq_ac_mob']['contr_erro'] = 'off'; 
      }
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

    function ValidateField_bloq_dsc(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['bloq_dsc'])) {
       return;
   }
               if (!empty($this->bloq_dsc) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc']) && !in_array($this->bloq_dsc, $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['bloq_dsc']))
                   {
                       $Campos_Erros['bloq_dsc'] = array();
                   }
                   $Campos_Erros['bloq_dsc'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['bloq_dsc']) || !is_array($this->NM_ajax_info['errList']['bloq_dsc']))
                   {
                       $this->NM_ajax_info['errList']['bloq_dsc'] = array();
                   }
                   $this->NM_ajax_info['errList']['bloq_dsc'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'bloq_dsc';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_bloq_dsc

    function ValidateField_id_hotel_atual(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['id_hotel_atual'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->id_hotel_atual) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'id_hotel_atual';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_id_hotel_atual

    function ValidateField_acomodacao_atual(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['acomodacao_atual'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->acomodacao_atual) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'acomodacao_atual';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_acomodacao_atual

    function ValidateField_categoria_atual(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['categoria_atual'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->categoria_atual) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'categoria_atual';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_categoria_atual

    function ValidateField_evento_atual(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['evento_atual'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->evento_atual) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'evento_atual';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_evento_atual

    function ValidateField_quartos_atual(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['quartos_atual'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->quartos_atual) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'quartos_atual';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_quartos_atual

    function ValidateField_saldo_quartos(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['saldo_quartos'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->saldo_quartos) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'saldo_quartos';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_saldo_quartos

    function ValidateField_bloq_dsc_subs(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['bloq_dsc_subs'])) {
       return;
   }
               if (!empty($this->bloq_dsc_subs) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc_subs']) && !in_array($this->bloq_dsc_subs, $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc_subs']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['bloq_dsc_subs']))
                   {
                       $Campos_Erros['bloq_dsc_subs'] = array();
                   }
                   $Campos_Erros['bloq_dsc_subs'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['bloq_dsc_subs']) || !is_array($this->NM_ajax_info['errList']['bloq_dsc_subs']))
                   {
                       $this->NM_ajax_info['errList']['bloq_dsc_subs'] = array();
                   }
                   $this->NM_ajax_info['errList']['bloq_dsc_subs'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'bloq_dsc_subs';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_bloq_dsc_subs

    function ValidateField_id_hotel_subs(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['id_hotel_subs'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->id_hotel_subs) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'id_hotel_subs';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_id_hotel_subs

    function ValidateField_acomodacao_subs(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['acomodacao_subs'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->acomodacao_subs) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'acomodacao_subs';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_acomodacao_subs

    function ValidateField_categoria_subs(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['categoria_subs'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->categoria_subs) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'categoria_subs';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_categoria_subs

    function ValidateField_evento_subs(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['evento_subs'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->evento_subs) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'evento_subs';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_evento_subs

    function ValidateField_quartos_subs(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['quartos_subs'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->quartos_subs) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'quartos_subs';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_quartos_subs

    function ValidateField_saldo_quartos_subs(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['saldo_quartos_subs'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->saldo_quartos_subs) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'saldo_quartos_subs';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_saldo_quartos_subs

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
    $this->nmgp_dados_form['bloq_dsc'] = $this->bloq_dsc;
    $this->nmgp_dados_form['id_hotel_atual'] = $this->id_hotel_atual;
    $this->nmgp_dados_form['acomodacao_atual'] = $this->acomodacao_atual;
    $this->nmgp_dados_form['categoria_atual'] = $this->categoria_atual;
    $this->nmgp_dados_form['evento_atual'] = $this->evento_atual;
    $this->nmgp_dados_form['quartos_atual'] = $this->quartos_atual;
    $this->nmgp_dados_form['saldo_quartos'] = $this->saldo_quartos;
    $this->nmgp_dados_form['bloq_dsc_subs'] = $this->bloq_dsc_subs;
    $this->nmgp_dados_form['id_hotel_subs'] = $this->id_hotel_subs;
    $this->nmgp_dados_form['acomodacao_subs'] = $this->acomodacao_subs;
    $this->nmgp_dados_form['categoria_subs'] = $this->categoria_subs;
    $this->nmgp_dados_form['evento_subs'] = $this->evento_subs;
    $this->nmgp_dados_form['quartos_subs'] = $this->quartos_subs;
    $this->nmgp_dados_form['saldo_quartos_subs'] = $this->saldo_quartos_subs;
    $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['dados_form'] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
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
   }
   function nm_formatar_campos($format_fields = array())
   {
      global $nm_form_submit;
     if (isset($this->formatado) && $this->formatado)
     {
         return;
     }
     $this->formatado = true;
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

   function ajax_return_values()
   {
          $this->ajax_return_values_bloq_dsc();
          $this->ajax_return_values_id_hotel_atual();
          $this->ajax_return_values_acomodacao_atual();
          $this->ajax_return_values_categoria_atual();
          $this->ajax_return_values_evento_atual();
          $this->ajax_return_values_quartos_atual();
          $this->ajax_return_values_saldo_quartos();
          $this->ajax_return_values_bloq_dsc_subs();
          $this->ajax_return_values_id_hotel_subs();
          $this->ajax_return_values_acomodacao_subs();
          $this->ajax_return_values_categoria_subs();
          $this->ajax_return_values_evento_subs();
          $this->ajax_return_values_quartos_subs();
          $this->ajax_return_values_saldo_quartos_subs();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
          }
   } // ajax_return_values

          //----- bloq_dsc
   function ajax_return_values_bloq_dsc($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("bloq_dsc", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->bloq_dsc);
              $aLookup = array();
              $this->_tmp_lookup_bloq_dsc = $this->bloq_dsc;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc'] = array(); 
}
$aLookup[] = array(control_bloq_ac_mob_pack_protect_string('') => str_replace('<', '&lt;',control_bloq_ac_mob_pack_protect_string('.:Selecione:.')));
$_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   $nm_comando = "SELECT id_bh_hotel, bh_dsc_hotel  FROM bloqueio_hoteis_rsvp  ORDER BY bh_dsc_hotel";
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(control_bloq_ac_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', control_bloq_ac_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[0] . " - " . $rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[0] . " - " . $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc'][] = $rs->fields[0];
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
          $sSelComp = "name=\"bloq_dsc\"";
          if (isset($this->NM_ajax_info['select_html']['bloq_dsc']) && !empty($this->NM_ajax_info['select_html']['bloq_dsc']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['bloq_dsc']);
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

                  if ($this->bloq_dsc == $sValue)
                  {
                      $this->_tmp_lookup_bloq_dsc = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['bloq_dsc'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['bloq_dsc']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['bloq_dsc']['valList'][$i] = control_bloq_ac_mob_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['bloq_dsc']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['bloq_dsc']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['bloq_dsc']['labList'] = $aLabel;
          }
   }

          //----- id_hotel_atual
   function ajax_return_values_id_hotel_atual($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("id_hotel_atual", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->id_hotel_atual);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['id_hotel_atual'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- acomodacao_atual
   function ajax_return_values_acomodacao_atual($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("acomodacao_atual", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->acomodacao_atual);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['acomodacao_atual'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- categoria_atual
   function ajax_return_values_categoria_atual($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("categoria_atual", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->categoria_atual);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['categoria_atual'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- evento_atual
   function ajax_return_values_evento_atual($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("evento_atual", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->evento_atual);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['evento_atual'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- quartos_atual
   function ajax_return_values_quartos_atual($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("quartos_atual", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->quartos_atual);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['quartos_atual'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- saldo_quartos
   function ajax_return_values_saldo_quartos($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("saldo_quartos", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->saldo_quartos);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['saldo_quartos'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- bloq_dsc_subs
   function ajax_return_values_bloq_dsc_subs($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("bloq_dsc_subs", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->bloq_dsc_subs);
              $aLookup = array();
              $this->_tmp_lookup_bloq_dsc_subs = $this->bloq_dsc_subs;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc_subs']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc_subs'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc_subs']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc_subs'] = array(); 
}
$aLookup[] = array(control_bloq_ac_mob_pack_protect_string('') => str_replace('<', '&lt;',control_bloq_ac_mob_pack_protect_string('.:Selecione:.')));
$_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc_subs'][] = '';
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   $nm_comando = "SELECT id_bh_hotel, bh_dsc_hotel  FROM bloqueio_hoteis_rsvp  ORDER BY bh_dsc_hotel";
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $aLookup[] = array(control_bloq_ac_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', control_bloq_ac_mob_pack_protect_string(NM_charset_to_utf8($rs->fields[0] . " - " . $rs->fields[1]))));
              $nmgp_def_dados .= $rs->fields[0] . " - " . $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc_subs'][] = $rs->fields[0];
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
          $sSelComp = "name=\"bloq_dsc_subs\"";
          if (isset($this->NM_ajax_info['select_html']['bloq_dsc_subs']) && !empty($this->NM_ajax_info['select_html']['bloq_dsc_subs']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['bloq_dsc_subs']);
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

                  if ($this->bloq_dsc_subs == $sValue)
                  {
                      $this->_tmp_lookup_bloq_dsc_subs = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['bloq_dsc_subs'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['bloq_dsc_subs']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['bloq_dsc_subs']['valList'][$i] = control_bloq_ac_mob_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['bloq_dsc_subs']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['bloq_dsc_subs']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['bloq_dsc_subs']['labList'] = $aLabel;
          }
   }

          //----- id_hotel_subs
   function ajax_return_values_id_hotel_subs($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("id_hotel_subs", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->id_hotel_subs);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['id_hotel_subs'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- acomodacao_subs
   function ajax_return_values_acomodacao_subs($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("acomodacao_subs", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->acomodacao_subs);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['acomodacao_subs'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- categoria_subs
   function ajax_return_values_categoria_subs($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("categoria_subs", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->categoria_subs);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['categoria_subs'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- evento_subs
   function ajax_return_values_evento_subs($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("evento_subs", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->evento_subs);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['evento_subs'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- quartos_subs
   function ajax_return_values_quartos_subs($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("quartos_subs", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->quartos_subs);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['quartos_subs'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- saldo_quartos_subs
   function ajax_return_values_saldo_quartos_subs($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("saldo_quartos_subs", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->saldo_quartos_subs);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['saldo_quartos_subs'] = array(
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['upload_dir'][$fieldName][] = $newName;
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
//

function bloq_dsc_onChange()
{
$_SESSION['scriptcase']['control_bloq_ac_mob']['contr_erro'] = 'on';
if (!isset($this->sc_temp_vg_qtd_quart)) {$this->sc_temp_vg_qtd_quart = (isset($_SESSION['vg_qtd_quart'])) ? $_SESSION['vg_qtd_quart'] : "";}
if (!isset($this->sc_temp_vg_cod_categ)) {$this->sc_temp_vg_cod_categ = (isset($_SESSION['vg_cod_categ'])) ? $_SESSION['vg_cod_categ'] : "";}
if (!isset($this->sc_temp_vg_cod_acomo)) {$this->sc_temp_vg_cod_acomo = (isset($_SESSION['vg_cod_acomo'])) ? $_SESSION['vg_cod_acomo'] : "";}
if (!isset($this->sc_temp_vg_cod_hotel)) {$this->sc_temp_vg_cod_hotel = (isset($_SESSION['vg_cod_hotel'])) ? $_SESSION['vg_cod_hotel'] : "";}
if (!isset($this->sc_temp_vg_cod_evento)) {$this->sc_temp_vg_cod_evento = (isset($_SESSION['vg_cod_evento'])) ? $_SESSION['vg_cod_evento'] : "";}
  
$original_bloq_dsc = $this->bloq_dsc;
$original_saldo_quartos = $this->saldo_quartos;
$original_evento_atual = $this->evento_atual;
$original_id_hotel_atual = $this->id_hotel_atual;
$original_acomodacao_atual = $this->acomodacao_atual;
$original_categoria_atual = $this->categoria_atual;
$original_quartos_atual = $this->quartos_atual;



$sql = "
	SELECT
		bh_id_evento,
		bh_dsc_hotel,
		bh_id_hotel,
		bh_acomodacao,
		bh_categoria,
		bh_qtd_quartos,
		bh_saldo_quartos
	FROM
		bloqueio_hoteis_rsvp
	WHERE
		id_bh_hotel = ".$this->Db->qstr($this->bloq_dsc )."
	ORDER BY
		id_bh_hotel 	
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
	$this->sc_temp_vg_cod_evento = $this->rs[0][0];
	$this->sc_temp_vg_cod_hotel 	= $this->rs[0][2];
	$this->sc_temp_vg_cod_acomo	= $this->rs[0][3];
	$this->sc_temp_vg_cod_categ	= $this->rs[0][4];
	$this->sc_temp_vg_qtd_quart	= $this->rs[0][5];	
	$this->saldo_quartos  = $this->GetSaldoHotel($this->sc_temp_vg_cod_evento,$this->sc_temp_vg_cod_hotel);
} else {
	$this->sc_temp_vg_cod_evento = 'ERRO';
	$this->sc_temp_vg_cod_hotel 	= 'ERRO';
	$this->sc_temp_vg_cod_acomo	= 'ERRO';
	$this->sc_temp_vg_cod_categ	= 'ERRO';
	$this->sc_temp_vg_qtd_quart	= 'ERRO';
}	


$sql2 = "
	SELECT
		evento_nome
	FROM
		eventos_rsvp
	WHERE
		evento_id =  ".$this->Db->qstr($this->sc_temp_vg_cod_evento)."
	ORDER BY
		evento_id
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
	$this->evento_atual  = $this->sc_temp_vg_cod_evento.' - '.$this->rs2[0][0];
} else {
	$this->evento_atual  = 'ERRO';
}


$sql3 = "
	SELECT
		hotel_fantasia
	FROM
		tbl_hoteis
	WHERE
		hotel_id =  ".$this->Db->qstr($this->sc_temp_vg_cod_hotel)."
	ORDER BY
		hotel_id
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
	$this->id_hotel_atual  = $this->sc_temp_vg_cod_hotel.' - '.$this->rs3[0][0];
} else {
	$this->id_hotel_atual  = 'ERRO';
}


$sql4 = "
	SELECT
		acomodacao_desc
	FROM
		tbl_acomodacoes
	WHERE
		acomodacao_id =  ".$this->Db->qstr($this->sc_temp_vg_cod_acomo)."
	ORDER BY
		acomodacao_id
";
 
      $nm_select = $sql4; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs4 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs4[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs4 = false;
          $this->rs4_erro = $this->Db->ErrorMsg();
      } 
	
if (isset($this->rs4[0][0])) {
	$this->acomodacao_atual  = $this->sc_temp_vg_cod_acomo.' - '.$this->rs4[0][0];
} else {
	$this->acomodacao_atual  = 'ERRO';
}


$sql5 = "
	SELECT
		acomod_dsc
	FROM
		tbl_categ_acomod
	WHERE
		acomod_id =  ".$this->Db->qstr($this->sc_temp_vg_cod_categ)."
	ORDER BY
		acomod_id
";
 
      $nm_select = $sql5; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs5 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs5[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs5 = false;
          $this->rs5_erro = $this->Db->ErrorMsg();
      } 
	
if (isset($this->rs5[0][0])) {
	 $this->categoria_atual = $this->sc_temp_vg_cod_categ.' - '.$this->rs5[0][0];
} else {
	 $this->categoria_atual = 'ERRO';
}

$this->quartos_atual  = $this->sc_temp_vg_qtd_quart;




if (isset($this->sc_temp_vg_cod_evento)) { $_SESSION['vg_cod_evento'] = $this->sc_temp_vg_cod_evento;}
if (isset($this->sc_temp_vg_cod_hotel)) { $_SESSION['vg_cod_hotel'] = $this->sc_temp_vg_cod_hotel;}
if (isset($this->sc_temp_vg_cod_acomo)) { $_SESSION['vg_cod_acomo'] = $this->sc_temp_vg_cod_acomo;}
if (isset($this->sc_temp_vg_cod_categ)) { $_SESSION['vg_cod_categ'] = $this->sc_temp_vg_cod_categ;}
if (isset($this->sc_temp_vg_qtd_quart)) { $_SESSION['vg_qtd_quart'] = $this->sc_temp_vg_qtd_quart;}
$_SESSION['scriptcase']['control_bloq_ac_mob']['contr_erro'] = 'off';
$modificado_bloq_dsc = $this->bloq_dsc;
$modificado_saldo_quartos = $this->saldo_quartos;
$modificado_evento_atual = $this->evento_atual;
$modificado_id_hotel_atual = $this->id_hotel_atual;
$modificado_acomodacao_atual = $this->acomodacao_atual;
$modificado_categoria_atual = $this->categoria_atual;
$modificado_quartos_atual = $this->quartos_atual;
$this->nm_formatar_campos('bloq_dsc', 'saldo_quartos', 'evento_atual', 'id_hotel_atual', 'acomodacao_atual', 'categoria_atual', 'quartos_atual');
if ($original_bloq_dsc !== $modificado_bloq_dsc || isset($this->nmgp_cmp_readonly['bloq_dsc']) || (isset($bFlagRead_bloq_dsc) && $bFlagRead_bloq_dsc))
{
    $this->ajax_return_values_bloq_dsc(true);
}
if ($original_saldo_quartos !== $modificado_saldo_quartos || isset($this->nmgp_cmp_readonly['saldo_quartos']) || (isset($bFlagRead_saldo_quartos) && $bFlagRead_saldo_quartos))
{
    $this->ajax_return_values_saldo_quartos(true);
}
if ($original_evento_atual !== $modificado_evento_atual || isset($this->nmgp_cmp_readonly['evento_atual']) || (isset($bFlagRead_evento_atual) && $bFlagRead_evento_atual))
{
    $this->ajax_return_values_evento_atual(true);
}
if ($original_id_hotel_atual !== $modificado_id_hotel_atual || isset($this->nmgp_cmp_readonly['id_hotel_atual']) || (isset($bFlagRead_id_hotel_atual) && $bFlagRead_id_hotel_atual))
{
    $this->ajax_return_values_id_hotel_atual(true);
}
if ($original_acomodacao_atual !== $modificado_acomodacao_atual || isset($this->nmgp_cmp_readonly['acomodacao_atual']) || (isset($bFlagRead_acomodacao_atual) && $bFlagRead_acomodacao_atual))
{
    $this->ajax_return_values_acomodacao_atual(true);
}
if ($original_categoria_atual !== $modificado_categoria_atual || isset($this->nmgp_cmp_readonly['categoria_atual']) || (isset($bFlagRead_categoria_atual) && $bFlagRead_categoria_atual))
{
    $this->ajax_return_values_categoria_atual(true);
}
if ($original_quartos_atual !== $modificado_quartos_atual || isset($this->nmgp_cmp_readonly['quartos_atual']) || (isset($bFlagRead_quartos_atual) && $bFlagRead_quartos_atual))
{
    $this->ajax_return_values_quartos_atual(true);
}
$this->NM_ajax_info['event_field'] = 'bloq';
control_bloq_ac_mob_pack_ajax_response();
exit;
}


function bloq_dsc_subs_onChange()
{
$_SESSION['scriptcase']['control_bloq_ac_mob']['contr_erro'] = 'on';
if (!isset($this->sc_temp_vg_cod_evento)) {$this->sc_temp_vg_cod_evento = (isset($_SESSION['vg_cod_evento'])) ? $_SESSION['vg_cod_evento'] : "";}
if (!isset($this->sc_temp_vg_qtd_quart_s)) {$this->sc_temp_vg_qtd_quart_s = (isset($_SESSION['vg_qtd_quart_s'])) ? $_SESSION['vg_qtd_quart_s'] : "";}
if (!isset($this->sc_temp_vg_cod_categ_s)) {$this->sc_temp_vg_cod_categ_s = (isset($_SESSION['vg_cod_categ_s'])) ? $_SESSION['vg_cod_categ_s'] : "";}
if (!isset($this->sc_temp_vg_cod_acomo_s)) {$this->sc_temp_vg_cod_acomo_s = (isset($_SESSION['vg_cod_acomo_s'])) ? $_SESSION['vg_cod_acomo_s'] : "";}
if (!isset($this->sc_temp_vg_cod_hotel_s)) {$this->sc_temp_vg_cod_hotel_s = (isset($_SESSION['vg_cod_hotel_s'])) ? $_SESSION['vg_cod_hotel_s'] : "";}
if (!isset($this->sc_temp_vg_cod_evento_s)) {$this->sc_temp_vg_cod_evento_s = (isset($_SESSION['vg_cod_evento_s'])) ? $_SESSION['vg_cod_evento_s'] : "";}
  
$original_bloq_dsc_subs = $this->bloq_dsc_subs;
$original_saldo_quartos_subs = $this->saldo_quartos_subs;
$original_bloq_dsc = $this->bloq_dsc;
$original_evento_subs = $this->evento_subs;
$original_id_hotel_subs = $this->id_hotel_subs;
$original_acomodacao_subs = $this->acomodacao_subs;
$original_categoria_subs = $this->categoria_subs;
$original_quartos_subs = $this->quartos_subs;


$sql7 = "
	SELECT
		bh_id_evento,
		bh_dsc_hotel,
		bh_id_hotel,
		bh_acomodacao,
		bh_categoria,
		bh_qtd_quartos,
		bh_saldo_quartos
	FROM
		bloqueio_hoteis_rsvp
	WHERE
		id_bh_hotel = ".$this->Db->qstr($this->bloq_dsc_subs )."
	ORDER BY
		id_bh_hotel 	
";
 
      $nm_select = $sql7; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs7 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs7[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs7 = false;
          $this->rs7_erro = $this->Db->ErrorMsg();
      } 
	
if (isset($this->rs7[0][0])) {
	$this->sc_temp_vg_cod_evento_s	= $this->rs7[0][0];
	$this->sc_temp_vg_cod_hotel_s 	= $this->rs7[0][2];
	$this->sc_temp_vg_cod_acomo_s	= $this->rs7[0][3];
	$this->sc_temp_vg_cod_categ_s	= $this->rs7[0][4];
	$this->sc_temp_vg_qtd_quart_s	= $this->rs7[0][5];	
	$this->saldo_quartos_subs  = $this->GetSaldoHotel($this->sc_temp_vg_cod_evento_s,$this->sc_temp_vg_cod_hotel_s);
} else {
	$this->sc_temp_vg_cod_evento_s	= 'ERRO';
	$this->sc_temp_vg_cod_hotel_s 	= 'ERRO';
	$this->sc_temp_vg_cod_acomo_s	= 'ERRO';
	$this->sc_temp_vg_cod_categ_s	= 'ERRO';
	$this->sc_temp_vg_qtd_quart_s	= 'ERRO';
}	

if($this->bloq_dsc  <> $this->bloq_dsc_subs ) {
	
	
	$sql8 = "
		SELECT
			evento_nome
		FROM
			eventos_rsvp
		WHERE
			evento_id =  ".$this->Db->qstr($this->sc_temp_vg_cod_evento_s)."
		ORDER BY
			evento_id
	";
	 
      $nm_select = $sql8; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs8 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs8[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs8 = false;
          $this->rs8_erro = $this->Db->ErrorMsg();
      } 
	
	if (isset($this->rs8[0][0])) {
		$this->evento_subs  = $this->sc_temp_vg_cod_evento_s.' - '.$this->rs8[0][0];
	} else {
		$this->evento_subs  = 'ERRO';
	}


	$sql9 = "
		SELECT
			hotel_fantasia
		FROM
			tbl_hoteis
		WHERE
			hotel_id =  ".$this->Db->qstr($this->sc_temp_vg_cod_hotel_s)."
		ORDER BY
			hotel_id
	";
	 
      $nm_select = $sql9; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs9 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs9[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs9 = false;
          $this->rs9_erro = $this->Db->ErrorMsg();
      } 
	
	if (isset($this->rs9[0][0])) {
		$this->id_hotel_subs  = $this->sc_temp_vg_cod_hotel_s.' - '.$this->rs9[0][0];
	} else {
		$this->id_hotel_subs  = 'ERRO';
	}


	$sql10 = "
		SELECT
			acomodacao_desc
		FROM
			tbl_acomodacoes
		WHERE
			acomodacao_id =  ".$this->Db->qstr($this->sc_temp_vg_cod_acomo_s)."
		ORDER BY
			acomodacao_id
	";
	 
      $nm_select = $sql10; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs10 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs10[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs10 = false;
          $this->rs10_erro = $this->Db->ErrorMsg();
      } 
	
	if (isset($this->rs10[0][0])) {
		$this->acomodacao_subs  = $this->sc_temp_vg_cod_acomo_s.' - '.$this->rs10[0][0];
	} else {
		$this->acomodacao_subs  = 'ERRO';
	}


	$sql11 = "
		SELECT
			acomod_dsc
		FROM
			tbl_categ_acomod
		WHERE
			acomod_id =  ".$this->Db->qstr($this->sc_temp_vg_cod_categ_s)."
		ORDER BY
			acomod_id
	";
	 
      $nm_select = $sql11; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs11 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs11[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs11 = false;
          $this->rs11_erro = $this->Db->ErrorMsg();
      } 
	
	if (isset($this->rs11[0][0])) {
		 $this->categoria_subs = $this->sc_temp_vg_cod_categ_s.' - '.$this->rs11[0][0];
	} else {
		 $this->categoria_subs = 'ERRO';
	}
	$this->quartos_subs  = $this->sc_temp_vg_qtd_quart_s;
} else {
	$this->evento_subs 		= 'ERRO';
	$this->id_hotel_subs  	= 'ERRO';
	$this->acomodacao_subs 	= 'ERRO';
	$this->categoria_subs 	= 'ERRO';
	$this->quartos_subs  		= 'ERRO';	
	$this->sc_ajax_message ("Escolha Bloqueios Diferentes!","NRSVP" , "timeout=10");
}	

if($this->sc_temp_vg_cod_evento <> $this->sc_temp_vg_cod_evento_s){	
	if($this->sc_temp_vg_cod_evento <> '') {
		$this->evento_subs 		= 'ERRO';
		$this->id_hotel_subs  	= 'ERRO';
		$this->acomodacao_subs 	= 'ERRO';
		$this->categoria_subs 	= 'ERRO';
		$this->quartos_subs  		= 'ERRO';	
		$this->sc_ajax_message ("Escolha Eventos Iguais!","NRSVP" , "timeout=10");	
	} else {
		$this->sc_ajax_message ("Todos registros de hospedagem serão substituidos por este bloqueio!","NRSVP" , "timeout=20");	
	}	
}	



if (isset($this->sc_temp_vg_cod_evento_s)) { $_SESSION['vg_cod_evento_s'] = $this->sc_temp_vg_cod_evento_s;}
if (isset($this->sc_temp_vg_cod_hotel_s)) { $_SESSION['vg_cod_hotel_s'] = $this->sc_temp_vg_cod_hotel_s;}
if (isset($this->sc_temp_vg_cod_acomo_s)) { $_SESSION['vg_cod_acomo_s'] = $this->sc_temp_vg_cod_acomo_s;}
if (isset($this->sc_temp_vg_cod_categ_s)) { $_SESSION['vg_cod_categ_s'] = $this->sc_temp_vg_cod_categ_s;}
if (isset($this->sc_temp_vg_qtd_quart_s)) { $_SESSION['vg_qtd_quart_s'] = $this->sc_temp_vg_qtd_quart_s;}
if (isset($this->sc_temp_vg_cod_evento)) { $_SESSION['vg_cod_evento'] = $this->sc_temp_vg_cod_evento;}
$_SESSION['scriptcase']['control_bloq_ac_mob']['contr_erro'] = 'off';
$modificado_bloq_dsc_subs = $this->bloq_dsc_subs;
$modificado_saldo_quartos_subs = $this->saldo_quartos_subs;
$modificado_bloq_dsc = $this->bloq_dsc;
$modificado_evento_subs = $this->evento_subs;
$modificado_id_hotel_subs = $this->id_hotel_subs;
$modificado_acomodacao_subs = $this->acomodacao_subs;
$modificado_categoria_subs = $this->categoria_subs;
$modificado_quartos_subs = $this->quartos_subs;
$this->nm_formatar_campos('bloq_dsc_subs', 'saldo_quartos_subs', 'bloq_dsc', 'evento_subs', 'id_hotel_subs', 'acomodacao_subs', 'categoria_subs', 'quartos_subs');
if ($original_bloq_dsc_subs !== $modificado_bloq_dsc_subs || isset($this->nmgp_cmp_readonly['bloq_dsc_subs']) || (isset($bFlagRead_bloq_dsc_subs) && $bFlagRead_bloq_dsc_subs))
{
    $this->ajax_return_values_bloq_dsc_subs(true);
}
if ($original_saldo_quartos_subs !== $modificado_saldo_quartos_subs || isset($this->nmgp_cmp_readonly['saldo_quartos_subs']) || (isset($bFlagRead_saldo_quartos_subs) && $bFlagRead_saldo_quartos_subs))
{
    $this->ajax_return_values_saldo_quartos_subs(true);
}
if ($original_bloq_dsc !== $modificado_bloq_dsc || isset($this->nmgp_cmp_readonly['bloq_dsc']) || (isset($bFlagRead_bloq_dsc) && $bFlagRead_bloq_dsc))
{
    $this->ajax_return_values_bloq_dsc(true);
}
if ($original_evento_subs !== $modificado_evento_subs || isset($this->nmgp_cmp_readonly['evento_subs']) || (isset($bFlagRead_evento_subs) && $bFlagRead_evento_subs))
{
    $this->ajax_return_values_evento_subs(true);
}
if ($original_id_hotel_subs !== $modificado_id_hotel_subs || isset($this->nmgp_cmp_readonly['id_hotel_subs']) || (isset($bFlagRead_id_hotel_subs) && $bFlagRead_id_hotel_subs))
{
    $this->ajax_return_values_id_hotel_subs(true);
}
if ($original_acomodacao_subs !== $modificado_acomodacao_subs || isset($this->nmgp_cmp_readonly['acomodacao_subs']) || (isset($bFlagRead_acomodacao_subs) && $bFlagRead_acomodacao_subs))
{
    $this->ajax_return_values_acomodacao_subs(true);
}
if ($original_categoria_subs !== $modificado_categoria_subs || isset($this->nmgp_cmp_readonly['categoria_subs']) || (isset($bFlagRead_categoria_subs) && $bFlagRead_categoria_subs))
{
    $this->ajax_return_values_categoria_subs(true);
}
if ($original_quartos_subs !== $modificado_quartos_subs || isset($this->nmgp_cmp_readonly['quartos_subs']) || (isset($bFlagRead_quartos_subs) && $bFlagRead_quartos_subs))
{
    $this->ajax_return_values_quartos_subs(true);
}
$this->NM_ajax_info['event_field'] = 'bloq';
control_bloq_ac_mob_pack_ajax_response();
exit;
}


function GetSaldoHotel($evento_id,$id_hotel) {
$_SESSION['scriptcase']['control_bloq_ac_mob']['contr_erro'] = 'on';
  	
	date_default_timezone_set('America/Sao_Paulo');
	$valor_y = 'Y';		
	$valor_zero = '0';
	$ret = 0;
	$valor_room = 'SIM';
		
	$sql = "
	SELECT
		bh_id_evento,		
		bh_id_hotel,			
		bh_acomodacao,		
		bh_categoria,		
		bh_qtd_quartos,		
		bh_saldo_quartos,
		id_bh_hotel
	FROM	
		bloqueio_hoteis_rsvp
	WHERE	
		bh_id_evento = ".$this->Db->qstr($evento_id)."	
	AND 
	    bh_id_hotel = ".$this->Db->qstr($id_hotel)."	
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
	             
	$reg_mestre = sizeof($this->rs);
	
	if ($reg_mestre > 0) {			
		for ($i=0;$i<$reg_mestre;++$i) {	
			$evento 	= $this->rs[$i][0];
			$hotel		= $this->rs[$i][1];
			$acomoda	= $this->rs[$i][2];
			$categor	= $this->rs[$i][3];
			$qtdquar	= $this->rs[$i][4];
			$salquar	= $this->rs[$i][5];
			$codbloq    = $this->rs[$i][6];
			
			$sqlbh = "
			SELECT    
				COUNT(hospedagem_id) as qtde,
				conta_roomlist
			FROM
				hospedagem_rsvp		
			WHERE 
				hosp_id_evento = ".$this->Db->qstr($evento)." 
			AND 
				hosp_id_hotel = ".$this->Db->qstr($hotel)."
			AND  
				hosp_acomodacao = ".$this->Db->qstr($acomoda)." 
			AND  
				hosp_categoria = ".$this->Db->qstr($categor)." 
			AND
				hosp_status = ".$this->Db->qstr($valor_y)."		
			AND 	
				conta_roomlist = ".$this->Db->qstr($valor_room)."	
			AND
				id_bloqueio_hotel = ".$this->Db->qstr($codbloq)."	
			";	
			 
      $nm_select = $sqlbh; 
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
				$qtdeachou = $this->rs2[0][0];				
				$saldo = $qtdquar - $qtdeachou;
				$ret = $saldo; 				
			} else {
				$qtdeachou = 0;
				$ret = 0;
			}	
			
			if ($qtdeachou > 0) {						
				$sqlbh2 = "
				UPDATE
					bloqueio_hoteis_rsvp 
				SET
					bh_saldo_quartos = ".$this->Db->qstr($saldo)."				
				WHERE
					bh_id_evento = ".$this->Db->qstr($evento)."		
				AND
					bh_id_hotel = ".$this->Db->qstr($hotel)."
				AND
					bh_acomodacao = ".$this->Db->qstr($acomoda)."
				AND
					bh_categoria = ".$this->Db->qstr($categor)."	
				AND
					id_bh_hotel = ".$this->Db->qstr($codbloq)."	
				";
				
     $nm_select = $sqlbh2; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                control_bloq_ac_mob_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
			}								
		}	
	}	
	return $ret;
$_SESSION['scriptcase']['control_bloq_ac_mob']['contr_erro'] = 'off';
}


function GravaLog($v_hora_now,$v_ip_usuario,$v_id_usuario,$v_global_cpf,$v_modulo,$v_aplicacao,$v_acao,$v_campo_id,$v_vl_campo_id,$v_campo_cpf,$v_vl_campo_cpf,$v_campo_evt,$v_vl_campo_evt,$v_tabela,$v_obs,$v_sql) {
$_SESSION['scriptcase']['control_bloq_ac_mob']['contr_erro'] = 'on';
  		
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
                control_bloq_ac_mob_pack_ajax_response();
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
$_SESSION['scriptcase']['control_bloq_ac_mob']['contr_erro'] = 'off';
}


function PegaIP() {
$_SESSION['scriptcase']['control_bloq_ac_mob']['contr_erro'] = 'on';
  
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
	
$_SESSION['scriptcase']['control_bloq_ac_mob']['contr_erro'] = 'off';
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
     $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              control_bloq_ac_mob_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
      if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1) 
      { 
          $nm_saida_global = $_SESSION['scriptcase']['nm_sc_retorno']; 
      } 
    $this->nm_formatar_campos();
        $this->initFormPages();
    include_once("control_bloq_ac_mob_form0.php");
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
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array(""))) {
            $searchOk = true;
        }
        elseif ($field == $this->nmgp_fast_search && in_array($field, array(""))) {
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['table_refresh'])
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['csrf_token'];
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

   function Form_lookup_bloq_dsc()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc'] = array(); 
    }
   $nm_comando = "SELECT id_bh_hotel, bh_dsc_hotel  FROM bloqueio_hoteis_rsvp  ORDER BY bh_dsc_hotel";
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[0] . " - " . $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc'][] = $rs->fields[0];
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
   function Form_lookup_bloq_dsc_subs()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc_subs']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc_subs'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc_subs']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc_subs'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc_subs']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc_subs'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc_subs']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc_subs'] = array(); 
    }
   $nm_comando = "SELECT id_bh_hotel, bh_dsc_hotel  FROM bloqueio_hoteis_rsvp  ORDER BY bh_dsc_hotel";
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[0] . " - " . $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['Lookup_bloq_dsc_subs'][] = $rs->fields[0];
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
       $nmgp_saida_form = "control_bloq_ac_mob_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['nm_run_menu'] = 2;
       $nmgp_saida_form = "control_bloq_ac_mob_fim.php";
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
       control_bloq_ac_mob_pack_ajax_response();
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['masterValue']);
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
               $tmp_parms .= $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob'][substr($val, 1, -1)];
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
       $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['opcao'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['opc_ant'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['retorno_edit'] = "";
   }
   $nm_target_form = (empty($nm_target)) ? "_self" : $nm_target;
   if (strtolower(substr($nm_apl_dest, -4)) != ".php" && (strtolower(substr($nm_apl_dest, 0, 7)) == "http://" || strtolower(substr($nm_apl_dest, 0, 8)) == "https://" || strtolower(substr($nm_apl_dest, 0, 3)) == "../"))
   {
       if ($this->NM_ajax_flag)
       {
           $this->NM_ajax_info['redir']['metodo'] = 'location';
           $this->NM_ajax_info['redir']['action'] = $nm_apl_dest;
           $this->NM_ajax_info['redir']['target'] = $nm_target_form;
           control_bloq_ac_mob_pack_ajax_response();
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
       control_bloq_ac_mob_pack_ajax_response();
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
            case "ok":
                return array("sub_form_b.sc-unique-btn-1", "sub_form_b.sc-unique-btn-4");
                break;
            case "help":
                return array("sc_b_hlp_b");
                break;
            case "exit":
                return array("Bsair_b.sc-unique-btn-2", "Bsair_b.sc-unique-btn-5", "Bsair_b.sc-unique-btn-3", "Bsair_b.sc-unique-btn-6");
                break;
        }

        return array($buttonName);
    } // getButtonIds

    function displayAppHeader()
    {
        if ($this->Embutida_call) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['link_info']['compact_mode']) {
            return;
        }
?>
    <tr><td class="sc-app-header">
<style>
    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}
</style>
<div class="scFormHeader" style="height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;">
    <div class="scFormHeaderFont" style="float: left; text-transform: uppercase;"><?php if ($this->nmgp_opcao == "novo") { echo "Substituições de Bloqueios"; } else { echo "Substituições de Bloqueios"; } ?></div>
    <div class="scFormHeaderFont" style="float: right;"><?php echo date($this->dateDefaultFormat()); ?></div>
</div>
    </td></tr>
<?php
    }

    function displayAppFooter()
    {
    }

    function displayAppToolbars()
    {
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['control_bloq_ac_mob']['ordem_ord'] == " desc") {
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
            default:
                return false;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
            default:
                return 'asc';
        }
        return 'asc';
    }

}
?>
