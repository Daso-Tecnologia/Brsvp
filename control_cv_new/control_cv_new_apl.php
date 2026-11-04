<?php
//
class control_cv_new_apl
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
   var $email_part;
   var $e_mail_cc;
   var $e_mail_cc_1;
   var $envia_email;
   var $envia_email_1;
   var $logo_bvt;
   var $ligai;
   var $voo_origem_ida_01c;
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
          if (isset($this->NM_ajax_info['param']['csrf_token']))
          {
              $this->csrf_token = $this->NM_ajax_info['param']['csrf_token'];
          }
          if (isset($this->NM_ajax_info['param']['e_mail_cc']))
          {
              $this->e_mail_cc = $this->NM_ajax_info['param']['e_mail_cc'];
          }
          if (isset($this->NM_ajax_info['param']['email_part']))
          {
              $this->email_part = $this->NM_ajax_info['param']['email_part'];
          }
          if (isset($this->NM_ajax_info['param']['envia_email']))
          {
              $this->envia_email = $this->NM_ajax_info['param']['envia_email'];
          }
          if (isset($this->NM_ajax_info['param']['ligai']))
          {
              $this->ligai = $this->NM_ajax_info['param']['ligai'];
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
      if (isset($this->vg_tipo_pessoa) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['vg_tipo_pessoa'] = $this->vg_tipo_pessoa;
      }
      if (isset($this->vg_cpf) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['vg_cpf'] = $this->vg_cpf;
      }
      if (isset($this->vg_confirm_viagem) && isset($this->NM_contr_var_session) && $this->NM_contr_var_session == "Yes") 
      {
          $_SESSION['vg_confirm_viagem'] = $this->vg_confirm_viagem;
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
      if (isset($_POST["vg_tipo_pessoa"]) && isset($this->vg_tipo_pessoa)) 
      {
          $_SESSION['vg_tipo_pessoa'] = $this->vg_tipo_pessoa;
      }
      if (isset($_POST["vg_cpf"]) && isset($this->vg_cpf)) 
      {
          $_SESSION['vg_cpf'] = $this->vg_cpf;
      }
      if (isset($_POST["vg_confirm_viagem"]) && isset($this->vg_confirm_viagem)) 
      {
          $_SESSION['vg_confirm_viagem'] = $this->vg_confirm_viagem;
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
      if (isset($_GET["vg_tipo_pessoa"]) && isset($this->vg_tipo_pessoa)) 
      {
          $_SESSION['vg_tipo_pessoa'] = $this->vg_tipo_pessoa;
      }
      if (isset($_GET["vg_cpf"]) && isset($this->vg_cpf)) 
      {
          $_SESSION['vg_cpf'] = $this->vg_cpf;
      }
      if (isset($_GET["vg_confirm_viagem"]) && isset($this->vg_confirm_viagem)) 
      {
          $_SESSION['vg_confirm_viagem'] = $this->vg_confirm_viagem;
      }
      if (isset($this->Refresh_aba_menu)) {
          $_SESSION['sc_session'][$script_case_init]['control_cv_new']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['control_cv_new']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['control_cv_new']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['control_cv_new']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['control_cv_new']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['control_cv_new']['embutida_parms']);
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
                 nm_limpa_str_control_cv_new($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
             }
             $ix++;
          }
          if (isset($this->inside_nested_grid) && 'Y' == $this->inside_nested_grid) {
              $_SESSION['sc_session'][$script_case_init]['control_cv_new']['inside_nested_iframe'] = true;
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
          if (isset($this->vg_tipo_pessoa)) 
          {
              $_SESSION['vg_tipo_pessoa'] = $this->vg_tipo_pessoa;
          }
          if (isset($this->vg_cpf)) 
          {
              $_SESSION['vg_cpf'] = $this->vg_cpf;
          }
          if (isset($this->vg_confirm_viagem)) 
          {
              $_SESSION['vg_confirm_viagem'] = $this->vg_confirm_viagem;
          }
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['control_cv_new']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['control_cv_new']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['control_cv_new']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['control_cv_new']['sc_redir_insert'] = $this->sc_redir_insert;
              unset($_SESSION['sc_session'][$script_case_init]['control_cv_new']['opc_ant']);
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
          if (isset($this->vg_tipo_pessoa)) 
          {
              $_SESSION['vg_tipo_pessoa'] = $this->vg_tipo_pessoa;
          }
          if (isset($this->vg_cpf)) 
          {
              $_SESSION['vg_cpf'] = $this->vg_cpf;
          }
          if (isset($this->vg_confirm_viagem)) 
          {
              $_SESSION['vg_confirm_viagem'] = $this->vg_confirm_viagem;
          }
      } 
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['control_cv_new']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['control_cv_new']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['control_cv_new']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['control_cv_new']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['control_cv_new']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['control_cv_new']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['control_cv_new']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['control_cv_new']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['control_cv_new']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['control_cv_new']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new control_cv_new_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("pt_br");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['initialize'];
          $this->Db = $this->Ini->Db; 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['initialize']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['initialize'])
          {
              $_SESSION['scriptcase']['control_cv_new']['contr_erro'] = 'on';
if (!isset($this->sc_temp_vg_cpfseg)) {$this->sc_temp_vg_cpfseg = (isset($_SESSION['vg_cpfseg'])) ? $_SESSION['vg_cpfseg'] : "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
if (!isset($this->sc_temp_parm1)) {$this->sc_temp_parm1 = (isset($_SESSION['parm1'])) ? $_SESSION['parm1'] : "";}
if (!isset($this->sc_temp_vg_menu_item)) {$this->sc_temp_vg_menu_item = (isset($_SESSION['vg_menu_item'])) ? $_SESSION['vg_menu_item'] : "";}
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
  date_default_timezone_set('America/Sao_Paulo');
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
   $sErrorIndex = 'geral_control_cv_new';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_control_cv_new';
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
    if ($this->NM_ajax_flag)
    {
        $this->NM_ajax_info['redirExit']['action'] = "control_cv_new_fim.php?script_case_init=" . $this->form_encode_input($this->Ini->sc_page);
        $this->NM_ajax_info['redirExit']['metodo'] = 'location';
        $this->NM_ajax_info['redirExit']['target'] = "_self";
        $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $this->Ini->path_link . "" . SC_dir_app_name('WWW-Authenticate: <type> realm=<realm>') . "/";
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['sc_outra_jan'])
        {
            $_SESSION['scriptcase']['sc_outra_jan'] = "control_cv_new";
            $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['sc_outra_jan'] = false;
        }
        $_SESSION['scriptcase']['control_cv_new']['contr_erro'] = 'off';
        control_cv_new_pack_ajax_response();
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
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "control_cv_new";
     $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['sc_outra_jan'] = false;
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
        action="control_cv_new_fim.php"
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

$sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'control_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';
if (isset($this->sc_temp_vg_usuario_id)) { $_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_vg_menu_item)) { $_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
if (isset($this->sc_temp_parm1)) { $_SESSION['parm1'] = $this->sc_temp_parm1;}
if (isset($this->sc_temp_vg_evento_id)) { $_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_cpfseg)) { $_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
$_SESSION['scriptcase']['control_cv_new']['contr_erro'] = 'off';
          }
          $this->Ini->init2();
      } 
      else 
      { 
         $this->nm_data = new nm_data("pt_br");
      } 
      $_SESSION['sc_session'][$script_case_init]['control_cv_new']['upload_field_info'] = array();

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['control_cv_new']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['control_cv_new'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['control_cv_new']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['control_cv_new']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('control_cv_new') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['control_cv_new']['label'] = "BRSVP - Confirmação de Viagem";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "control_cv_new")
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


      $this->arr_buttons['cfview']['hint']             = "Acesso a Confirmação de Viagem";
      $this->arr_buttons['cfview']['type']             = "button";
      $this->arr_buttons['cfview']['value']            = "Visualizar";
      $this->arr_buttons['cfview']['display']          = "text_fontawesomeicon";
      $this->arr_buttons['cfview']['display_position'] = "text_right";
      $this->arr_buttons['cfview']['style']            = "default";
      $this->arr_buttons['cfview']['image']            = "";
      $this->arr_buttons['cfview']['has_fa']            = "true";
      $this->arr_buttons['cfview']['fontawesomeicon']            = "";


      $_SESSION['scriptcase']['error_icon']['control_cv_new']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['control_cv_new'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['goto']      = 'on';
          }
      }

      $this->nmgp_botoes['cancel'] = "on";
      $this->nmgp_botoes['exit'] = "on";
      $this->nmgp_botoes['ok'] = "off";
      $this->nmgp_botoes['facebook'] = "off";
      $this->nmgp_botoes['google'] = "off";
      $this->nmgp_botoes['twitter'] = "off";
      $this->nmgp_botoes['paypal'] = "off";
      $this->nmgp_botoes['cfview'] = "on";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['where_orig'] = "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['where_pesq'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_cv_new']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['control_cv_new'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['control_cv_new'];

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

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['dados_form'];
          if (!isset($this->logo_bvt)){$this->logo_bvt = $this->nmgp_dados_form['logo_bvt'];} 
          if (!isset($this->voo_origem_ida_01c)){$this->voo_origem_ida_01c = $this->nmgp_dados_form['voo_origem_ida_01c'];} 
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("control_cv_new", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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

      if (is_file($this->Ini->path_aplicacao . 'control_cv_new_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'control_cv_new_help.txt');
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
          require_once($this->Ini->path_embutida . 'control_cv_new/control_cv_new_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "control_cv_new_erro.class.php"); 
      }
      $this->Erro      = new control_cv_new_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['control_cv_new']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "novo")  
      {
          $this->nmgp_botoes['cfview'] = "off";
      }
      elseif ($this->nmgp_opcao == "incluir")  
      {
          $this->nmgp_botoes['cfview'] = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['botoes']['cfview'];
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['dados_form'];
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
      $_SESSION['scriptcase']['control_cv_new']['contr_erro'] = 'on';
if (!isset($this->sc_temp_vg_cpfseg)) {$this->sc_temp_vg_cpfseg = (isset($_SESSION['vg_cpfseg'])) ? $_SESSION['vg_cpfseg'] : "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
if (!isset($this->sc_temp_parm1)) {$this->sc_temp_parm1 = (isset($_SESSION['parm1'])) ? $_SESSION['parm1'] : "";}
if (!isset($this->sc_temp_vg_menu_item)) {$this->sc_temp_vg_menu_item = (isset($_SESSION['vg_menu_item'])) ? $_SESSION['vg_menu_item'] : "";}
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
  date_default_timezone_set('America/Sao_Paulo');
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
   $sErrorIndex = 'geral_control_cv_new';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_control_cv_new';
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
    if ($this->NM_ajax_flag)
    {
        $this->NM_ajax_info['redirExit']['action'] = "control_cv_new_fim.php?script_case_init=" . $this->form_encode_input($this->Ini->sc_page);
        $this->NM_ajax_info['redirExit']['metodo'] = 'location';
        $this->NM_ajax_info['redirExit']['target'] = "_self";
        $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $this->Ini->path_link . "" . SC_dir_app_name('WWW-Authenticate: <type> realm=<realm>') . "/";
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['sc_outra_jan'])
        {
            $_SESSION['scriptcase']['sc_outra_jan'] = "control_cv_new";
            $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['sc_outra_jan'] = false;
        }
        $_SESSION['scriptcase']['control_cv_new']['contr_erro'] = 'off';
        control_cv_new_pack_ajax_response();
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
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "control_cv_new";
     $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['sc_outra_jan'] = false;
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
        action="control_cv_new_fim.php"
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
$_SESSION['scriptcase']['control_cv_new']['contr_erro'] = 'off'; 
      }
            if ('ajax_check_file' == $this->nmgp_opcao ){
                 ob_start(); 
                 global $bol_api_prod; 
                 $bol_api_prod = true; 
                 if (isset($_SESSION['scriptcase']['control_cv_new']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['control_cv_new']['glo_nm_conexao'])) 
                 { 
                     $bol_api_prod = false;
                 } 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['control_cv_new']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['control_cv_new']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
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
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['dados_select'];
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
         $this->logo_bvt = "";
      }
//
//-----> 
//
      if ($this->NM_ajax_flag && 'validate_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          if ('validate_ligai' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'ligai');
          }
          if ('validate_envia_email' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'envia_email');
          }
          if ('validate_email_part' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'email_part');
          }
          if ('validate_e_mail_cc' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'e_mail_cc');
          }
          control_cv_new_pack_ajax_response();
          exit;
      }
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6))
      {
          $this->nm_tira_formatacao();
          if ('event_e_mail_cc_onchange' == $this->NM_ajax_opcao)
          {
              $this->e_mail_cc_onChange();
          }
          control_cv_new_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          if (is_array($this->envia_email))
          {
              $x = 0; 
              $this->envia_email_1 = $this->envia_email;
              $this->envia_email = ""; 
              if ($this->envia_email_1 != "") 
              { 
                  foreach ($this->envia_email_1 as $dados_envia_email_1 ) 
                  { 
                      if ($x != 0)
                      { 
                          $this->envia_email .= ";";
                      } 
                      $this->envia_email .= $dados_envia_email_1;
                      $x++ ; 
                  } 
              } 
          } 
          $this->nm_tira_formatacao();
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              control_cv_new_pack_ajax_response();
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
          $_SESSION['scriptcase']['control_cv_new']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  control_cv_new_pack_ajax_response();
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
          $_SESSION['scriptcase']['control_cv_new']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  control_cv_new_pack_ajax_response();
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
          $this->email_part = "" ;  
          $this->e_mail_cc = "" ;  
          $this->envia_email = "N" ;  
          $this->logo_bvt = "" ;  
          $this->ligai = "" ;  
          $this->voo_origem_ida_01c = "" ;  
          $this->logo_bvt = "";
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['dados_form']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['dados_form']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['dados_form'] as $NM_campo => $NM_valor)
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['recarga'] = $this->nmgp_opcao;
      }
      if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "" || $campos_erro != "" || !isset($this->bok) || $this->bok != "OK" || $this->nmgp_opcao == "recarga")
      {
          if ($Campos_Crit == "" && empty($Campos_Falta) && $this->Campos_Mens_erro == "" && !isset($this->bok) && $this->nmgp_opcao != "recarga")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['campos']))
              { 
                  $ligai = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['campos'][0]; 
                  $envia_email = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['campos'][1]; 
                  $email_part = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['campos'][2]; 
                  $e_mail_cc = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['campos'][3]; 
              } 
          }
          $this->nm_gera_html();
          $this->NM_close_db(); 
      }
      elseif (isset($this->bok) && $this->bok == "OK")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['campos'] = array(); 
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['campos'][0] = $this->ligai; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['campos'][1] = $this->envia_email; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['campos'][2] = $this->email_part; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['campos'][3] = $this->e_mail_cc; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['redir'] == "redir")
          {
              $this->nmgp_redireciona(); 
          }
          else
          {
              $contr_menu = "";
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['iframe_menu'])
              {
                  $contr_menu = "glo_menu";
              }
              if (isset($_SESSION['scriptcase']['sc_ult_apl_menu']) && in_array("control_cv_new", $_SESSION['scriptcase']['sc_ult_apl_menu']))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona_form("control_cv_new_fim.php", $this->nm_location, $contr_menu); 
              }
              else
              {
                  $this->nm_gera_html();
                  if (!$_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['embutida_proc'])
                  { 
                      $this->NM_close_db(); 
                  } 
              }
          }
          $this->NM_close_db(); 
          if ($this->NM_ajax_flag)
          {
              control_cv_new_pack_ajax_response();
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
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "control_cv_new.zip";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("BRSVP - Confirmação de Viagem") ?></TITLE>
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
<form name="Fdown" method="get" action="control_cv_new_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="control_cv_new"> 
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
           case 'ligai':
               return "Confirmação de Viagem";
               break;
           case 'envia_email':
               return "Enviar Confirmação";
               break;
           case 'email_part':
               return "E-Mail Participante:";
               break;
           case 'e_mail_cc':
               return "Com cópia:";
               break;
           case 'logo_bvt':
               return "logo_bvt";
               break;
           case 'voo_origem_ida_01c':
               return "voo_origem_ida_01c";
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

     if (!is_array($filtro) && '' == $filtro && isset($this->nm_form_submit) && '1' == $this->nm_form_submit && isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['csrf_token']) && $this->scCsrfGetToken() != $this->csrf_token)
     {
          $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
          $this->Campos_Mens_erro .= "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          if ($this->NM_ajax_flag)
          {
              if (!isset($this->NM_ajax_info['errList']['geral_control_cv_new']) || !is_array($this->NM_ajax_info['errList']['geral_control_cv_new']))
              {
                  $this->NM_ajax_info['errList']['geral_control_cv_new'] = array();
              }
              $this->NM_ajax_info['errList']['geral_control_cv_new'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ((!is_array($filtro) && ('' == $filtro || 'ligai' == $filtro)) || (is_array($filtro) && in_array('ligai', $filtro)))
        $this->ValidateField_ligai($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'envia_email' == $filtro)) || (is_array($filtro) && in_array('envia_email', $filtro)))
        $this->ValidateField_envia_email($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'email_part' == $filtro)) || (is_array($filtro) && in_array('email_part', $filtro)))
        $this->ValidateField_email_part($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'e_mail_cc' == $filtro)) || (is_array($filtro) && in_array('e_mail_cc', $filtro)))
        $this->ValidateField_e_mail_cc($Campos_Crit, $Campos_Falta, $Campos_Erros);
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

    function ValidateField_ligai(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['ligai'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->ligai) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'ligai';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_ligai

    function ValidateField_envia_email(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['envia_email'])) {
       return;
   }
      if ($this->envia_email == "" && $this->nmgp_opcao != "excluir")
      { 
      } 
      else 
      { 
          if (is_array($this->envia_email))
          {
              $x = 0; 
              $this->envia_email_1 = array(); 
              foreach ($this->envia_email as $ind => $dados_envia_email_1 ) 
              {
                  if ($dados_envia_email_1 != "") 
                  {
                      $this->envia_email_1[] = $dados_envia_email_1;
                  } 
              } 
              $this->envia_email = ""; 
              foreach ($this->envia_email_1 as $dados_envia_email_1 ) 
              { 
                   if ($x != 0)
                   { 
                       $this->envia_email .= ";";
                   } 
                   $this->envia_email .= $dados_envia_email_1;
                   $x++ ; 
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'envia_email';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_envia_email

    function ValidateField_email_part(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['email_part'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->email_part) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'email_part';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_email_part

    function ValidateField_e_mail_cc(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
   if (isset($this->Field_no_validate['e_mail_cc'])) {
       return;
   }
               if (!empty($this->e_mail_cc) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['Lookup_e_mail_cc']) && !in_array($this->e_mail_cc, $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['Lookup_e_mail_cc']))
               {
                   $hasError = true;
                   $Campos_Crit .= $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($Campos_Erros['e_mail_cc']))
                   {
                       $Campos_Erros['e_mail_cc'] = array();
                   }
                   $Campos_Erros['e_mail_cc'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
                   if (!isset($this->NM_ajax_info['errList']['e_mail_cc']) || !is_array($this->NM_ajax_info['errList']['e_mail_cc']))
                   {
                       $this->NM_ajax_info['errList']['e_mail_cc'] = array();
                   }
                   $this->NM_ajax_info['errList']['e_mail_cc'][] = $this->Ini->Nm_lang['lang_errm_ajax_data'];
               }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'e_mail_cc';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_e_mail_cc

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
    $this->nmgp_dados_form['ligai'] = $this->ligai;
    $this->nmgp_dados_form['envia_email'] = $this->envia_email;
    $this->nmgp_dados_form['email_part'] = $this->email_part;
    $this->nmgp_dados_form['e_mail_cc'] = $this->e_mail_cc;
    $this->nmgp_dados_form['logo_bvt'] = $this->logo_bvt;
    $this->nmgp_dados_form['voo_origem_ida_01c'] = $this->voo_origem_ida_01c;
    $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['dados_form'] = $this->nmgp_dados_form;
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
          $this->ajax_return_values_ligai();
          $this->ajax_return_values_envia_email();
          $this->ajax_return_values_email_part();
          $this->ajax_return_values_e_mail_cc();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
          }
   } // ajax_return_values

          //----- ligai
   function ajax_return_values_ligai($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("ligai", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->ligai);
              $aLookup = array();
          if (!is_file($this->Ini->root  . $this->Ini->path_imag_cab . "/grp__NM__img__NM__vouchers.png"))
          { 
              $ligai = "&nbsp;" ;  
          } 
          elseif ($this->Ini->Gd_missing) 
          { 
              $ligai = "<span class=\"scFormErrorMessage\">" . $this->Ini->Nm_lang['lang_errm_gd'] . "</span>"; 
          } 
          else 
          { 
              $in_ligai = $this->Ini->root  . $this->Ini->path_imag_cab . "/grp__NM__img__NM__vouchers.png"; 
              $img_time = filemtime($this->Ini->root . $this->Ini->path_imag_cab . "/grp__NM__img__NM__vouchers.png"); 
              $out_ligai = str_replace("/", "_", $this->Ini->path_imag_cab); 
              $out_ligai = $this->Ini->path_imag_temp . "/sc_" . $out_ligai . "_ligai_4646_" . $img_time . "_grp__NM__img__NM__vouchers.png";
              if (!is_file($this->Ini->root . $out_ligai)) 
              {  
                  $sc_obj_img = new nm_trata_img($in_ligai, true);
                  $sc_obj_img->setWidth(46);
                  $sc_obj_img->setHeight(46);
                  $sc_obj_img->setManterAspecto(true);
                  $sc_obj_img->createImg($this->Ini->root . $out_ligai);
              } 
              $ligai = "<img border=\"0\" src=\"" . $out_ligai . "\"/>" ; 
          } 
    $sTmpImgHtml = "" . $ligai . "";
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['ligai'] = array(
                       'row'    => '',
               'type'    => 'imagehtml',
               'valList' => array($sTmpValue),
               'imgHtml' => $sTmpImgHtml,
              );
          }
   }

          //----- envia_email
   function ajax_return_values_envia_email($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("envia_email", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->envia_email);
              $aLookup = array();
              $this->_tmp_lookup_envia_email = $this->envia_email;

$aLookup[] = array(control_cv_new_pack_protect_string('Y') => str_replace('<', '&lt;',control_cv_new_pack_protect_string("Enviar")));
$_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['Lookup_envia_email'][] = 'Y';
          $aLookupOrig = $aLookup;
          $sOptComp = "";
          if (isset($this->NM_ajax_info['select_html']['envia_email']) && !empty($this->NM_ajax_info['select_html']['envia_email']))
          {
              $sOptComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['envia_email']);
          }
          $this->NM_ajax_info['fldList']['envia_email'] = array(
                       'row'    => '',
               'type'    => 'checkbox',
               'switch'  => false,
               'valList' => explode(';', $sTmpValue),
               'colNum'  => 1,
               'optComp'  => $sOptComp,
               'optClass' => 'sc-ui-checkbox-envia_email',
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['envia_email']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['envia_email']['valList'][$i] = control_cv_new_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['envia_email']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['envia_email']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['envia_email']['labList'] = $aLabel;
          }
   }

          //----- email_part
   function ajax_return_values_email_part($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("email_part", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->email_part);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['email_part'] = array(
                       'row'    => '',
               'type'    => 'label',
               'valList' => array($sTmpValue),
              );
          }
   }

          //----- e_mail_cc
   function ajax_return_values_e_mail_cc($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("e_mail_cc", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->e_mail_cc);
              $aLookup = array();
              $this->_tmp_lookup_e_mail_cc = $this->e_mail_cc;

 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['Lookup_e_mail_cc']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['Lookup_e_mail_cc'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['Lookup_e_mail_cc']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['Lookup_e_mail_cc'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   $envia_email_val_str = "''";
   if (!empty($this->envia_email))
   {
       if (is_array($this->envia_email))
       {
           $Tmp_array = $this->envia_email;
       }
       else
       {
           $Tmp_array = explode(";", $this->envia_email);
       }
       $envia_email_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $envia_email_val_str)
          {
             $envia_email_val_str .= ", ";
          }
          $envia_email_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $nm_comando = "SELECT usuario_email  FROM usuarios_rsvp  ORDER BY usuario_email";
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $aLookup[] = array(control_cv_new_pack_protect_string(NM_charset_to_utf8($rs->fields[0])) => str_replace('<', '&lt;', control_cv_new_pack_protect_string(NM_charset_to_utf8($rs->fields[0]))));
              $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['Lookup_e_mail_cc'][] = $rs->fields[0];
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
          $sSelComp = "name=\"e_mail_cc\"";
          if (isset($this->NM_ajax_info['select_html']['e_mail_cc']) && !empty($this->NM_ajax_info['select_html']['e_mail_cc']))
          {
              $sSelComp = str_replace('{SC_100PERC_CLASS_INPUT}', $this->classes_100perc_fields['input'], $this->NM_ajax_info['select_html']['e_mail_cc']);
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

                  if ($this->e_mail_cc == $sValue)
                  {
                      $this->_tmp_lookup_e_mail_cc = $sLabel;
                  }

                  $sOpt     = ($sValue !== $sLabel) ? $sValue : $sLabel;
                  $sLookup .= "<option value=\"" . $sOpt . "\">" . $sLabel . "</option>";
              }
          }
          $aLookup  = $sLookup;
          $this->NM_ajax_info['fldList']['e_mail_cc'] = array(
                       'row'    => '',
               'type'    => 'select',
               'valList' => array($sTmpValue),
               'optList' => $aLookup,
              );
          $aLabel     = array();
          $aLabelTemp = array();
          foreach ($this->NM_ajax_info['fldList']['e_mail_cc']['valList'] as $i => $v)
          {
              $this->NM_ajax_info['fldList']['e_mail_cc']['valList'][$i] = control_cv_new_pack_protect_string($v);
          }
          foreach ($aLookupOrig as $aValData)
          {
              if (in_array(key($aValData), $this->NM_ajax_info['fldList']['e_mail_cc']['valList']))
              {
                  $aLabelTemp[key($aValData)] = current($aValData);
              }
          }
          foreach ($this->NM_ajax_info['fldList']['e_mail_cc']['valList'] as $iIndex => $sValue)
          {
              $aLabel[$iIndex] = (isset($aLabelTemp[$sValue])) ? $aLabelTemp[$sValue] : $sValue;
          }
          $this->NM_ajax_info['fldList']['e_mail_cc']['labList'] = $aLabel;
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['upload_dir'][$fieldName][] = $newName;
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

function e_mail_cc_onChange()
{
$_SESSION['scriptcase']['control_cv_new']['contr_erro'] = 'on';
  
$original_email_part = $this->email_part;
$original_e_mail_cc = $this->e_mail_cc;
$original_e_mail_cc = $this->e_mail_cc;

	
if ($this->email_part  == $this->e_mail_cc ) {
	$this->e_mail_cc  = '';
	$this->sc_ajax_message ("O endereço de e-mail do Participante não pode ser igual ao endereço de cópia!", "NRSVP" , "timeout=30");
}

	

$modificado_email_part = $this->email_part;
$modificado_e_mail_cc = $this->e_mail_cc;
$modificado_e_mail_cc = $this->e_mail_cc;
$this->nm_formatar_campos('email_part', 'e_mail_cc');
if ($original_email_part !== $modificado_email_part || isset($this->nmgp_cmp_readonly['email_part']) || (isset($bFlagRead_email_part) && $bFlagRead_email_part))
{
    $this->ajax_return_values_email_part(true);
}
if ($original_e_mail_cc !== $modificado_e_mail_cc || isset($this->nmgp_cmp_readonly['e_mail_cc']) || (isset($bFlagRead_e_mail_cc) && $bFlagRead_e_mail_cc))
{
    $this->ajax_return_values_e_mail_cc(true);
}
if ($original_e_mail_cc !== $modificado_e_mail_cc || isset($this->nmgp_cmp_readonly['e_mail_cc']) || (isset($bFlagRead_e_mail_cc) && $bFlagRead_e_mail_cc))
{
    $this->ajax_return_values_e_mail_cc(true);
}
$this->NM_ajax_info['event_field'] = 'e';
control_cv_new_pack_ajax_response();
exit;


$_SESSION['scriptcase']['control_cv_new']['contr_erro'] = 'off';
}


function GetUsuarioNivel($idu,$tipo) {
$_SESSION['scriptcase']['control_cv_new']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['control_cv_new']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['control_cv_new']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['control_cv_new']['contr_erro'] = 'off';
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
     $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              control_cv_new_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['retorno_edit'] . "';";
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
    if (!$this->NM_ajax_flag || !isset($this->nmgp_refresh_fields)) {
    $_SESSION['scriptcase']['control_cv_new']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_e_mail_cc = $this->e_mail_cc;
    $original_email_part = $this->email_part;
    $original_envia_email = $this->envia_email;
}
if (!isset($this->sc_temp_vg_confirm_viagem)) {$this->sc_temp_vg_confirm_viagem = (isset($_SESSION['vg_confirm_viagem'])) ? $_SESSION['vg_confirm_viagem'] : "";}
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
if (!isset($this->sc_temp_vg_cpf)) {$this->sc_temp_vg_cpf = (isset($_SESSION['vg_cpf'])) ? $_SESSION['vg_cpf'] : "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
if (!isset($this->sc_temp_vg_tipo_pessoa)) {$this->sc_temp_vg_tipo_pessoa = (isset($_SESSION['vg_tipo_pessoa'])) ? $_SESSION['vg_tipo_pessoa'] : "";}
  $_SESSION['scriptcase']['control_cv_new']['contr_erro'] = 'off';
date_default_timezone_set('America/Sao_Paulo');
$valor_y = 'Y';
$valor_ida = 'IDA';
$valor_volta = 'VOLTA';
$valor_sim = 'SIM';
$w_logo_hospup = '';


if ($this->sc_temp_vg_tipo_pessoa <> "P") {
}
$params = array(
		'title' => 'Atenção!',
		'type' => 'warning',
		'timer' => '6000',
		'showConfirmButton' => 'false',
		'position' => 'center',
		'toast' => 'true'
		);
$params2 = array(
		'title' => 'Atenção!',
		'type' => 'warning',
		'timer' => '5000',
		'showConfirmButton' => 'false',
		'position' => 'center',
		'toast' => 'true'
		);
$evento = $this->sc_temp_vg_evento_id;
$cpf = $this->sc_temp_vg_cpf;
$usuario = $this->sc_temp_vg_usuario_id;
$jaenviou = $this->sc_temp_vg_confirm_viagem;
$tipo_pessoa = $this->sc_temp_vg_tipo_pessoa;
$this->email_part  = '';

$this->nmgp_cmp_hidden["envia_email"] = 'off'; $this->NM_ajax_info['fieldDisplay']['envia_email'] = 'off';
if ($jaenviou == 'Y') {
	$this->nm_mens_alert[] = "A Confirmação de Viagem já foi Enviada!"; $this->nm_params_alert[] = $params2; if ($this->NM_ajax_flag) { $this->sc_ajax_alert("A Confirmação de Viagem já foi Enviada!", $params2); }}

$w_nome_evento 		= '';
$w_logo_bvt 		= '';
$w_logo_aereo_ida 	= '';
$w_logo_aereo_volta = '';
$w_logo_hospedagem 	= '';
$w_logo_transfer 	= '';
$w_logo_aereo 		= '';
$w_logo_aereoup	    = '';

$w_voo_titulo_logo_ida_01 = '';
$w_voo_titulo_logo_ida_02 = '';
$w_voo_titulo_logo_ida_03 = '';
$w_voo_titulo_logo_ida_04 = '';

$w_voo_titulo_logo_volta_01 = '';
$w_voo_titulo_logo_volta_02 = '';
$w_voo_titulo_logo_volta_03 = '';
$w_voo_titulo_logo_volta_04 = '';


if ($tipo_pessoa == 'P') {
	$sql2="
	SELECT
		part_id_evento,
		part_cpf,
		part_email,
		nome_pessoa,
		part_cv_obs
	FROM
		participantes_rsvp
	WHERE
		part_id_evento = ".$this->Db->qstr($evento)."
	AND
		 part_cpf = ".$this->Db->qstr($cpf)."
	ORDER BY 
		part_id_evento,part_cpf
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
		$this->email_part  = $this->rs2[0][2];	
		$w_nome_participante = $this->rs2[0][3];
		$w_participante_obs = $this->rs2[0][4];
		$w_tipo_pessoa_dsc = 'PARTICIPANTE';
	} else {
		$w_nome_participante = '';
		$w_tipo_pessoa_dsc = '';
	}	
} else {
	$sql2="
	SELECT
		part_id_evento,
		part_cpf,
		part_email,
		part_nome,
		part_cv_obs
	FROM
		acompanhantes_rsvp
	WHERE
		part_id_evento = ".$this->Db->qstr($evento)."
	AND
		 part_cpf = ".$this->Db->qstr($cpf)."
	ORDER BY 
		part_id_evento,part_cpf
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
		$this->email_part  = $this->rs2[0][2];	
		$w_nome_participante = $this->rs2[0][3];
		$w_participante_obs = $this->rs2[0][4];
		$w_tipo_pessoa_dsc = 'ACOMPANHANTE';
	} else {
		$w_nome_participante = '';
		$w_tipo_pessoa_dsc = '';
	}	
}
if ($this->email_part  == '') {		
	$this->nm_mens_alert[] = "O e-mail do Participante/ Acompanhante não foi informado!"; $this->nm_params_alert[] = $params; if ($this->NM_ajax_flag) { $this->sc_ajax_alert("O e-mail do Participante/ Acompanhante não foi informado!", $params); }}

$sql1="
SELECT
    usuario_id,
	usuario_email,
	usuario_nome
FROM
    usuarios_rsvp
WHERE
	usuario_id = ".$this->Db->qstr($usuario)."
ORDER BY 
	usuario_id
";	
 
      $nm_select = $sql1; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs1 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs1[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs1 = false;
          $this->rs1_erro = $this->Db->ErrorMsg();
      } 
	
if (isset($this->rs1[0][0])) {
	$this->e_mail_cc  = $this->rs1[0][1];	
	$w_nome_usuario = $this->rs1[0][2];
} else {
	$w_nome_usuario = '';
}


$sql3="
SELECT
	evento_id,
	evento_nome,
	evento_logo
FROM
	eventos_rsvp
WHERE
	evento_id = ".$this->Db->qstr($evento)."
ORDER BY 
	evento_id
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
	$w_nome_evento = $this->rs3[0][1];
	$w_logo_cliente = $this->rs3[0][2];		
	if($w_logo_cliente <> '') {
		ob_clean();
		$dir_sc = $this->Ini->path_doc;		
		$_img = $this->sc_temp_vg_evento_id."-".$this->sc_temp_vg_cpf."cli".".jpg";		
		$_arquivo = $dir_sc."/".$_img;		
		$fp = fopen($_arquivo, 'wb'); 
		fwrite($fp,$w_logo_cliente);
		fclose($fp);
		$mysqlImg = ''; 				
		$fp2 = fopen($_arquivo, "rb");	
		$tamanhoImg = filesize($_arquivo);
		$w_conteudo = fread($fp2, $tamanhoImg);
		$w_logo_clienteup = addslashes($w_conteudo);
		fclose($fp2);	
		if(file_exists($_arquivo)) {
			unlink($_arquivo);
		}		
	} 		
} else {
	$w_nome_evento = '';	
	$w_logo_clienteup = '';
}

$w_criado_em = date('Y-m-d H:i:s');
$w_cod_evento = $evento;
$w_cod_usuario = $usuario;
$w_cod_participante = $cpf;
$w_nome_participante = mb_strtolower($w_nome_participante,"utf-8"); 
$w_nome_participante = ucwords($w_nome_participante);

$w_email_remetente = "contato@exemplo.com.br";
$w_email_smtp = "mail.seudominio.exemplo.com.br";
$w_email_usuario = "contato@exemplo.com.br";
$w_email_senha = "SENHA_REMOVIDA";  

$w_email_destinatario = mb_strtolower($this->email_part ,"utf-8");

$texto  = '<br>Prezado(a) Sr.(a), <b>'.$w_nome_participante.','.'</b> agradecemos a sua participação no evento <b>'.$w_nome_evento.'.'.'</b><br><br>';
$texto .= 'Por favor, confira os dados na confirmação em anexo e tenha uma excelente viagem.<br><br><br>';
$texto .= '<img alt="" src="https://www.cloudreport.com.br/eventos/asseventos.gif" style="width: 700px; height: 150px;" /></div>';


$texto_s  = '<br>Prezado(a) Sr.(a), <b>'.$w_nome_participante.','.'</b> agradecemos a sua participação no evento <b>'.$w_nome_evento.'.'.'</b><br><br>';
$texto_s .= 'Por favor, confira os dados da confirmação e tenha uma excelente viagem.<br><br>';

$w_simples_mensagem = $texto_s;
$w_email_mensagem = $texto;
$w_email_assunto = "Belvitur Eventos - Confirmação de Viagem (".$w_nome_participante.") Evento: ".$w_nome_evento;
$w_email_comcopia = mb_strtolower($this->e_mail_cc ,"utf-8");

$w_voo_titulo = '';
$w_voo_origem_ida_01      	= '';
$w_voo_saida_origem_ida_01	= '';
$w_voo_destino_ida_01    	= '';
$w_voo_chega_destino_ida_01	= '';
$w_voo_cia_ida_01         	= '';
$w_voo_numvoo_ida_01      	= '';
$w_voo_localizador_ida_01 	= '';
$w_voo_etkt_ida_01        	= '';
$w_voo_comprado_bvt_ida_01	= '';
$w_voo_assento_ida_01				= '';
$w_voo_conexao_ida_01				= '';
$w_voo_logo_aereo_ida_01			= '';
$w_voo_origem_titulo_ida_01			= '';
$w_voo_saida_titulo_ida_01			= '';
$w_voo_destino_tiulo_ida_01			= '';	
$w_voo_chegada_titulo_ida_01		= '';
$w_voo_cia_titulo_ida_01			= '';
$w_voo_titulo_ida_01				= '';
$w_voo_localizador_titulo_ida_01	= '';
$w_voo_etkt_titulo_ida_01			= '';
$w_voo_com_bvt_titulo_ida_01		= '';	

$w_voo_origem_ida_02      	= '';
$w_voo_saida_origem_ida_02	= '';
$w_voo_destino_ida_02    	= '';
$w_voo_chega_destino_ida_02 = '';
$w_voo_cia_ida_02         	= '';
$w_voo_numvoo_ida_02      	= '';
$w_voo_localizador_ida_02 	= '';
$w_voo_etkt_ida_02        	= '';
$w_voo_comprado_bvt_ida_02	= '';                          
$w_voo_assento_ida_02				= '';
$w_voo_conexao_ida_02				= '';
$w_voo_logo_aereo_ida_02			= '';
$w_voo_origem_titulo_ida_02			= '';
$w_voo_saida_titulo_ida_02			= '';
$w_voo_destino_tiulo_ida_02			= '';
$w_voo_chegada_titulo_ida_02		= '';	
$w_voo_cia_titulo_ida_02			= '';
$w_voo_titulo_ida_02				= '';
$w_voo_localizador_titulo_ida_02	= '';
$w_voo_etkt_titulo_ida_02			= '';
$w_voo_com_bvt_titulo_ida_02		= '';

$w_voo_origem_ida_03      	= '';
$w_voo_saida_origem_ida_03	= '';
$w_voo_destino_ida_03    	= '';
$w_voo_cia_ida_03         	= '';
$w_voo_chega_destino_ida_03 = '';
$w_voo_numvoo_ida_03      	= '';
$w_voo_localizador_ida_03 	= '';
$w_voo_etkt_ida_03        	= '';
$w_voo_comprado_bvt_ida_03	= '';
$w_voo_assento_ida_03				= '';
$w_voo_conexao_ida_03				= '';
$w_voo_logo_aereo_ida_03			= '';
$w_voo_origem_titulo_ida_03			= '';
$w_voo_saida_titulo_ida_03			= '';
$w_voo_destino_tiulo_ida_03			= '';
$w_voo_chegada_titulo_ida_03		= '';	
$w_voo_cia_titulo_ida_03			= '';
$w_voo_titulo_ida_03				= '';
$w_voo_localizador_titulo_ida_03	= '';
$w_voo_etkt_titulo_ida_03			= '';
$w_voo_com_bvt_titulo_ida_03		= '';

$w_voo_origem_ida_04      	= '';
$w_voo_saida_origem_ida_04	= '';
$w_voo_destino_ida_04    	= '';
$w_voo_cia_ida_04         	= '';
$w_voo_chega_destino_ida_04 = '';
$w_voo_numvoo_ida_04      	= '';
$w_voo_localizador_ida_04 	= '';
$w_voo_etkt_ida_04        	= '';
$w_voo_comprado_bvt_ida_04	= '';
$w_voo_assento_ida_04				= '';
$w_voo_conexao_ida_04				= '';
$w_voo_logo_aereo_ida_04			= '';
$w_voo_origem_titulo_ida_04			= '';
$w_voo_saida_titulo_ida_04			= '';
$w_voo_destino_tiulo_ida_04			= '';
$w_voo_chegada_titulo_ida_04		= '';	
$w_voo_cia_titulo_ida_04			= '';
$w_voo_titulo_ida_04				= '';
$w_voo_localizador_titulo_ida_04	= '';
$w_voo_etkt_titulo_ida_04			= '';
$w_voo_com_bvt_titulo_ida_04		= '';

$w_voo_origem_ida_05      	= '';
$w_voo_saida_origem_ida_05	= '';
$w_voo_destino_ida_05    	= '';
$w_voo_cia_ida_05         	= '';
$w_voo_chega_destino_ida_05 = '';
$w_voo_numvoo_ida_05      	= '';
$w_voo_localizador_ida_05 	= '';
$w_voo_etkt_ida_05        	= '';
$w_voo_comprado_bvt_ida_05	= '';
$w_voo_assento_ida_05				= '';
$w_voo_conexao_ida_05				= '';
$w_voo_logo_aereo_ida_05			= '';
$w_voo_origem_titulo_ida_05			= '';
$w_voo_saida_titulo_ida_05			= '';
$w_voo_destino_tiulo_ida_05			= '';
$w_voo_chegada_titulo_ida_05		= '';	
$w_voo_cia_titulo_ida_05			= '';
$w_voo_titulo_ida_05				= '';
$w_voo_localizador_titulo_ida_05	= '';
$w_voo_etkt_titulo_ida_05			= '';
$w_voo_com_bvt_titulo_ida_05		= '';

$w_voo_origem_ida_06      	= '';
$w_voo_saida_origem_ida_06	= '';
$w_voo_destino_ida_06    	= '';
$w_voo_cia_ida_06         	= '';
$w_voo_chega_destino_ida_06 = '';
$w_voo_numvoo_ida_06      	= '';
$w_voo_localizador_ida_06 	= '';
$w_voo_etkt_ida_06        	= '';
$w_voo_comprado_bvt_ida_06	= '';
$w_voo_assento_ida_06				= '';
$w_voo_conexao_ida_06				= '';
$w_voo_logo_aereo_ida_06			= '';
$w_voo_origem_titulo_ida_06			= '';
$w_voo_saida_titulo_ida_06			= '';
$w_voo_destino_tiulo_ida_06			= '';
$w_voo_chegada_titulo_ida_06		= '';	
$w_voo_cia_titulo_ida_06			= '';
$w_voo_titulo_ida_06				= '';
$w_voo_localizador_titulo_ida_06	= '';
$w_voo_etkt_titulo_ida_06			= '';
$w_voo_com_bvt_titulo_ida_06		= '';

$w_voo_origem_ida_07      	= '';      
$w_voo_saida_origem_ida_07	= '';      
$w_voo_destino_ida_07    	= '';  
$w_voo_chega_destino_ida_07 = '';     
$w_voo_cia_ida_07         	= ''; 
$w_voo_numvoo_ida_07      	= '';      
$w_voo_localizador_ida_07 	= '';      
$w_voo_etkt_ida_07        	= '';      
$w_voo_comprado_bvt_ida_07	= '';      
$w_voo_assento_ida_07				= '';    
$w_voo_conexao_ida_07				= '';    
$w_voo_logo_aereo_ida_07			= '';    
$w_voo_origem_titulo_ida_07			= '';   
$w_voo_saida_titulo_ida_07			= '';    
$w_voo_destino_tiulo_ida_07			= '';   
$w_voo_chegada_titulo_ida_07		= '';	 
$w_voo_cia_titulo_ida_07			= '';    
$w_voo_titulo_ida_07				= '';    
$w_voo_localizador_titulo_ida_07	= '';
$w_voo_etkt_titulo_ida_07			= '';    
$w_voo_com_bvt_titulo_ida_07		= '';   

$w_voo_origem_ida_08      	= '';      
$w_voo_saida_origem_ida_08	= '';      
$w_voo_destino_ida_08    	= '';  
$w_voo_chega_destino_ida_08 = '';  
$w_voo_cia_ida_08         	= '';   
$w_voo_numvoo_ida_08      	= '';      
$w_voo_localizador_ida_08 	= '';      
$w_voo_etkt_ida_08        	= '';      
$w_voo_comprado_bvt_ida_08	= '';      
$w_voo_assento_ida_08				= '';      
$w_voo_conexao_ida_08				= '';      
$w_voo_logo_aereo_ida_08			= '';      
$w_voo_origem_titulo_ida_08			= '';   
$w_voo_saida_titulo_ida_08			= '';    
$w_voo_destino_tiulo_ida_08			= '';   
$w_voo_chegada_titulo_ida_08		= '';	  
$w_voo_cia_titulo_ida_08			= '';      
$w_voo_titulo_ida_08				= '';      
$w_voo_localizador_titulo_ida_08	= '';
$w_voo_etkt_titulo_ida_08			= '';     
$w_voo_com_bvt_titulo_ida_08		= '';   

$w_voo_origem_volta_01			= '';
$w_voo_saida_origem_volta_01	= '';
$w_voo_destino_volta_01			= '';
$w_voo_chega_destino_volta_01	= '';	
$w_voo_cia_volta_01				= '';
$w_voo_numvoo_volta_01			= '';
$w_voo_localizador_volta_01		= '';
$w_voo_etkt_volta_01			= '';
$w_voo_comprado_bvt_volta_01	= '';
$w_voo_assento_volta_01			= '';
$w_voo_conexao_volta            = '';
$w_voo_logo_aereo_vt_01         = '';
$w_voo_origem_titulo_volta_01       = '';
$w_voo_saida_titulo_volta_01        = '';
$w_voo_destino_tiulo_volta_01       = '';
$w_voo_chegada_titulo_volta_01      = '';
$w_voo_cia_titulo_volta_01          = '';
$w_voo_titulo_volta_01              = '';
$w_voo_localizador_titulo_volta_01  = '';
$w_voo_etkt_titulo_volta_01         = '';
$w_voo_com_bvt_titulo_volta_01      = '';

$w_voo_origem_volta_02			= '';
$w_voo_saida_origem_volta_02	= '';
$w_voo_destino_volta_02			= '';
$w_voo_chega_destino_volta_02	= '';	
$w_voo_cia_volta_02				= '';
$w_voo_numvoo_volta_02			= '';
$w_voo_localizador_volta_02		= '';
$w_voo_etkt_volta_02			= '';
$w_voo_comprado_bvt_volta_02	= '';
$w_voo_assento_volta_02				= '';
$w_voo_conexao_volta_02             = '';
$w_voo_logo_aereo_vt_02             = '';
$w_voo_origem_titulo_volta_02       = '';
$w_voo_saida_titulo_volta_02        = '';
$w_voo_destino_tiulo_volta_02       = '';
$w_voo_chegada_titulo_volta_02      = '';
$w_voo_cia_titulo_volta_02          = '';
$w_voo_titulo_volta_02              = '';
$w_voo_localizador_titulo_volta_02  = '';
$w_voo_etkt_titulo_volta_02         = '';
$w_voo_com_bvt_titulo_volta_02      = '';

$w_voo_origem_volta_03			= '';
$w_voo_saida_origem_volta_03	= '';
$w_voo_destino_volta_03			= '';
$w_voo_chega_destino_volta_03	= '';	
$w_voo_cia_volta_03				= '';
$w_voo_numvoo_volta_03			= '';
$w_voo_localizador_volta_03		= '';
$w_voo_etkt_volta_03			= '';
$w_voo_comprado_bvt_volta_03	= '';
$w_voo_assento_volta_03				= '';
$w_voo_conexao_volta_03             = '';
$w_voo_logo_aereo_vt_03             = '';
$w_voo_origem_titulo_volta_03       = '';
$w_voo_saida_titulo_volta_03        = '';
$w_voo_destino_tiulo_volta_03       = '';
$w_voo_chegada_titulo_volta_03      = '';
$w_voo_cia_titulo_volta_03          = '';
$w_voo_titulo_volta_03              = '';
$w_voo_localizador_titulo_volta_03  = '';
$w_voo_etkt_titulo_volta_03         = '';
$w_voo_com_bvt_titulo_volta_03      = '';

$w_voo_origem_volta_04			= '';
$w_voo_saida_origem_volta_04	= '';
$w_voo_destino_volta_04			= '';
$w_voo_chega_destino_volta_04	= '';	
$w_voo_cia_volta_04				= '';
$w_voo_numvoo_volta_04			= '';
$w_voo_localizador_volta_04		= '';
$w_voo_etkt_volta_04			= '';
$w_voo_comprado_bvt_volta_04	= '';
$w_voo_assento_volta_04				= '';
$w_voo_conexao_volta_04             = '';
$w_voo_logo_aereo_vt_04             = '';
$w_voo_origem_titulo_volta_04       = '';
$w_voo_saida_titulo_volta_04        = '';
$w_voo_destino_tiulo_volta_04       = '';
$w_voo_chegada_titulo_volta_04      = '';
$w_voo_cia_titulo_volta_04          = '';
$w_voo_titulo_volta_04              = '';
$w_voo_localizador_titulo_volta_04  = '';
$w_voo_etkt_titulo_volta_04         = '';
$w_voo_com_bvt_titulo_volta_04      = '';

$w_voo_origem_volta_05			= '';
$w_voo_saida_origem_volta_05	= '';
$w_voo_destino_volta_05			= '';
$w_voo_chega_destino_volta_05	= '';	
$w_voo_cia_volta_05				= '';
$w_voo_numvoo_volta_05			= '';
$w_voo_localizador_volta_05		= '';
$w_voo_etkt_volta_05			= '';
$w_voo_comprado_bvt_volta_05	= '';
$w_voo_assento_volta_05				= '';
$w_voo_conexao_volta_05             = '';
$w_voo_logo_aereo_vt_05             = '';
$w_voo_origem_titulo_volta_05       = '';
$w_voo_saida_titulo_volta_05        = '';
$w_voo_destino_tiulo_volta_05       = '';
$w_voo_chegada_titulo_volta_05      = '';
$w_voo_cia_titulo_volta_05          = '';
$w_voo_titulo_volta_05              = '';
$w_voo_localizador_titulo_volta_05  = '';
$w_voo_etkt_titulo_volta_05         = '';
$w_voo_com_bvt_titulo_volta_05      = '';

$w_voo_origem_volta_06			= '';
$w_voo_saida_origem_volta_06	= '';
$w_voo_destino_volta_06			= '';
$w_voo_chega_destino_volta_06	= '';	
$w_voo_cia_volta_06				= '';
$w_voo_numvoo_volta_06			= '';
$w_voo_localizador_volta_06		= '';
$w_voo_etkt_volta_06			= '';
$w_voo_comprado_bvt_volta_06	= '';
$w_voo_assento_volta_06				= '';
$w_voo_conexao_volta_06             = '';
$w_voo_logo_aereo_vt_06             = '';
$w_voo_origem_titulo_volta_06       = '';
$w_voo_saida_titulo_volta_06        = '';
$w_voo_destino_tiulo_volta_06       = '';
$w_voo_chegada_titulo_volta_06      = '';
$w_voo_cia_titulo_volta_06          = '';
$w_voo_titulo_volta_06              = '';
$w_voo_localizador_titulo_volta_06  = '';
$w_voo_etkt_titulo_volta_06         = '';
$w_voo_com_bvt_titulo_volta_06      = '';

$w_voo_origem_volta_07			= '';       
$w_voo_saida_origem_volta_07	= '';       
$w_voo_destino_volta_07			= '';       
$w_voo_chega_destino_volta_07	= '';	    
$w_voo_cia_volta_07				= '';       
$w_voo_numvoo_volta_07			= '';       
$w_voo_localizador_volta_07		= '';       
$w_voo_etkt_volta_07			= '';       
$w_voo_comprado_bvt_volta_07	= '';       
$w_voo_assento_volta_07				= '';   
$w_voo_conexao_volta_07             = '';
$w_voo_logo_aereo_vt_07             = '';
$w_voo_origem_titulo_volta_07       = '';
$w_voo_saida_titulo_volta_07        = '';
$w_voo_destino_tiulo_volta_07       = '';
$w_voo_chegada_titulo_volta_07      = '';
$w_voo_cia_titulo_volta_07          = '';   
$w_voo_titulo_volta_07              = '';
$w_voo_localizador_titulo_volta_07  = '';
$w_voo_etkt_titulo_volta_07         = '';
$w_voo_com_bvt_titulo_volta_07      = '';   

$w_voo_origem_volta_08			= '';     
$w_voo_saida_origem_volta_08	= '';     
$w_voo_destino_volta_08			= '';     
$w_voo_chega_destino_volta_08	= '';	  
$w_voo_cia_volta_08				= '';     
$w_voo_numvoo_volta_08			= '';     
$w_voo_localizador_volta_08		= '';     
$w_voo_etkt_volta_08			= '';     
$w_voo_comprado_bvt_volta_08	= '';     
$w_voo_assento_volta_08				= ''; 
$w_voo_conexao_volta_08             = '';
$w_voo_logo_aereo_vt_08             = '';
$w_voo_origem_titulo_volta_08       = '';
$w_voo_saida_titulo_volta_08        = '';
$w_voo_destino_tiulo_volta_08       = '';
$w_voo_chegada_titulo_volta_08      = '';
$w_voo_cia_titulo_volta_08          = ''; 
$w_voo_titulo_volta_08              = '';
$w_voo_localizador_titulo_volta_08  = '';
$w_voo_etkt_titulo_volta_08         = '';
$w_voo_com_bvt_titulo_volta_08      = ''; 

$w_voo_observacoes				= '';
$w_hosp_observacoes				= '';
$w_transfer_in_observacoes		= '';
$w_transfer_out_observacoes		= '';
$w_rodape_observacoes			= '';
$w_transfer_titulo				= '';

$w_origem_titulo				= '';
$w_saida_titulo					= '';
$w_destino_tiulo				= '';
$w_chegada_titulo				= '';
$w_cia_titulo					= '';
$w_voo_titulo					= '';
$w_localizador_titulo			= '';
$w_etkt_titulo					= '';
$w_comprada_bvt_titulo			= '';
$w_hotel_titulo					= '';
$w_acomodacao_titulo			= '';
$w_categoria_titulo				= '';
$w_checkin_tiulo				= '';
$w_checkout_titulo				= '';

$w_logo_aerogr					= '';
	
$valor_obs = 'AEREO';
$sql8="
	SELECT
		obs_tipo,
		obs_texto
	FROM
		tbl_obs_confirmacao
	WHERE
		obs_evento_id = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	AND
		obs_tipo = ".$this->Db->qstr($valor_obs)."
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
	$w_voo_observacoes_ida = $this->rs8[0][1];	
	$w_voo_observacoes_volta = '';	
}
$valor_obs = 'HOTEL';
$sql8a="
	SELECT
		obs_tipo,
		obs_texto
	FROM
		tbl_obs_confirmacao
	WHERE
		obs_evento_id = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	AND
		obs_tipo = ".$this->Db->qstr($valor_obs)."
";
 
      $nm_select = $sql8a; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs8a = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs8a[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs8a = false;
          $this->rs8a_erro = $this->Db->ErrorMsg();
      } 
	
if (isset($this->rs8a[0][0])) {
	$w_hosp_observacoes = $this->rs8a[0][1];	
}
$valor_obs = 'TRANSFER IN';
$sql8b="
	SELECT
		obs_tipo,
		obs_texto
	FROM
		tbl_obs_confirmacao
	WHERE
		obs_evento_id = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	AND
		obs_tipo = ".$this->Db->qstr($valor_obs)."
";
 
      $nm_select = $sql8b; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs8b = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs8b[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs8b = false;
          $this->rs8b_erro = $this->Db->ErrorMsg();
      } 
	
if (isset($this->rs8b[0][0])) {
	$w_transfer_in_observacoes = $this->rs8b[0][1];	
}
$valor_obs = 'TRANSFER OUT';
$sql8c="
	SELECT
		obs_tipo,
		obs_texto
	FROM
		tbl_obs_confirmacao
	WHERE
		obs_evento_id = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	AND
		obs_tipo = ".$this->Db->qstr($valor_obs)."
";
 
      $nm_select = $sql8c; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs8c = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs8c[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs8c = false;
          $this->rs8c_erro = $this->Db->ErrorMsg();
      } 
	
if (isset($this->rs8c[0][0])) {
	$w_transfer_out_observacoes = $this->rs8c[0][1];	
}
$valor_obs = 'LIVRE RODAPE';
$sql8d="
	SELECT
		obs_tipo,
		obs_texto
	FROM
		tbl_obs_confirmacao
	WHERE
		obs_evento_id = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	AND
		obs_tipo = ".$this->Db->qstr($valor_obs)."
";
 
      $nm_select = $sql8d; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs8d = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs8d[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs8d = false;
          $this->rs8d_erro = $this->Db->ErrorMsg();
      } 
	
if (isset($this->rs8d[0][0])) {
	$w_observacoes_finais_titulo = 'Importante';
	$w_rodape_observacoes = $this->rs8d[0][1];	
} else {
	$w_observacoes_finais_titulo = '';
	$w_rodape_observacoes = '';	
}	
$sql4="
	SELECT
		aereos_rsvp.id_aereo,
		aereos_rsvp.aereo_id_evento,
		aereos_rsvp.aereo_id_usuario,
		aereos_rsvp.aereo_cpf_particip,
		aereos_rsvp.aereo_tipo_pessoa,
		aereos_rsvp.aereo_status,
		aereos_rsvp.aereo_direcao,
		aereos_rsvp.aereo_cia_aerea,
		aereos_rsvp.aereo_num_voo,
		aereos_rsvp.aereo_origem,
		aereos_rsvp.aereo_destino,
		DATE_FORMAT(aereos_rsvp.aereo_dt_saida,'%d/%m/%Y') AS dt_saida,
		aereos_rsvp.aereo_hr_saida,
		aereos_rsvp.aereo_dthr_saida,
		DATE_FORMAT(aereos_rsvp.aereo_dt_chegada,'%d/%m/%Y') AS dt_chegada,
		aereos_rsvp.aereo_hr_chegada,
		aereos_rsvp.aereo_dthr_chegada,
		aereos_rsvp.aereo_localizador,
		aereos_rsvp.aereo_eticket,
		aereos_rsvp.aereo_emitida_bvt,
		aereos_rsvp.aereo_bloqueio_id,
		aereos_rsvp.aereo_trecho,
		aereos_rsvp.aereo_ativo,
		tbl_cia_aereas.cia_nome,
		concat(aeroporto.NOM_CIDADE,' - ',aeroporto.SIGLA,' - ',aeroporto.NOM_AEROPORTO),
		aereos_rsvp.aereo_assento
	FROM
		aereos_rsvp
	LEFT JOIN 
		aeroporto
	ON 
		aereos_rsvp.aereo_origem = aeroporto.COD_AEROPORTO	
	LEFT JOIN
		tbl_cia_aereas
	ON
		aereos_rsvp.aereo_cia_aerea = tbl_cia_aereas.cia_id				
	WHERE
		aereos_rsvp.aereo_status = ".$this->Db->qstr($valor_y)."
	AND
		aereos_rsvp.aereo_cpf_particip = ".$this->Db->qstr($this->sc_temp_vg_cpf)."
	AND
		aereos_rsvp.aereo_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	AND 
		aereos_rsvp.aereo_direcao = ".$this->Db->qstr($valor_ida)."	
	ORDER BY 
		aereos_rsvp.aereo_dt_saida,aereos_rsvp.aereo_hr_saida 
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
	
$tam_ai = sizeof($this->rs4 );
if ($tam_ai > 0) {				                                                                                        
	for ($i=0;$i<$tam_ai;++$i) {
		switch($i) {
			case 0:
				$w_voo_origem_ida_01 		= $this->rs4[$i][24]; 
				$w_voo_saida_origem_ida_01	= $this->rs4[$i][11].' - '.$this->rs4[$i][12];				
				$w_voo_saida_origem_ida_01	= substr($w_voo_saida_origem_ida_01,0,18);				
				$w_voo_destino_ida_01		= '';
				$w_voo_chega_destino_ida_01	= $this->rs4[$i][14].' - '.$this->rs4[$i][15];				
				$w_voo_chega_destino_ida_01	= substr($w_voo_chega_destino_ida_01,0,18);				
				$w_voo_cia_ida_01			= $this->rs4[$i][23];
				$w_voo_numvoo_ida_01      	= $this->rs4[$i][8];
				$w_voo_localizador_ida_01 	= $this->rs4[$i][17];
				$w_voo_etkt_ida_01        	= $this->rs4[$i][18];
				$w_voo_assento_ida_01		= $this->rs4[$i][25];
				$w_logo_aerogr				= $w_logo_aereoup;
			
				$w_voo_origem_titulo_ida_01			= 'Origem';
				$w_voo_saida_titulo_ida_01			= 'Saída';
				$w_voo_destino_tiulo_ida_01			= 'Destino';	
				$w_voo_chegada_titulo_ida_01		= 'Chegada';
				$w_voo_cia_titulo_ida_01			= 'Cia.';
				$w_voo_titulo_ida_01				= 'Voo';
				$w_voo_localizador_titulo_ida_01	= 'Localizador';
				$w_voo_etkt_titulo_ida_01			= 'E-ticket';
				$w_voo_com_bvt_titulo_ida_01		= 'Comprada com Belvitur';					
				
				if ( $this->rs4[$i][19] == 'Y') {
					$w_voo_comprado_bvt_ida_01	= 'SIM';
				} else {
					$w_voo_comprado_bvt_ida_01	= 'NÃO';
				}
				$w_voo_titulo = 'Voos';
				$w_voo_titulo_logo_ida_01 = 'Ida';
				break;
				
			case 1:
				$w_voo_origem_ida_02 		= $this->rs4[$i][24]; 
				$w_voo_saida_origem_ida_02	= $this->rs4[$i][11].' - '.$this->rs4[$i][12];
				$w_voo_saida_origem_ida_02	= substr($w_voo_saida_origem_ida_02,0,18);
				$w_voo_destino_ida_02		= '';
				$w_voo_chega_destino_ida_02	= $this->rs4[$i][14].' - '.$this->rs4[$i][15];
				$w_voo_chega_destino_ida_02	= substr($w_voo_chega_destino_ida_02,0,18);
				$w_voo_cia_ida_02			= $this->rs4[$i][23];
				$w_voo_numvoo_ida_02      	= $this->rs4[$i][8];
				$w_voo_localizador_ida_02 	= $this->rs4[$i][17];
				$w_voo_etkt_ida_02        	= $this->rs4[$i][18];
				$w_voo_assento_ida_02		= $this->rs4[$i][25];
				$w_voo_origem_titulo_ida_02 		= 'Origem';
				$w_voo_saida_titulo_ida_02			= 'Saída';
				$w_voo_destino_tiulo_ida_02			= 'Destino';	
				$w_voo_chegada_titulo_ida_02		= 'Chegada';
				$w_voo_cia_titulo_ida_02			= 'Cia.';
				$w_voo_titulo_ida_02				= 'Voo';
				$w_voo_localizador_titulo_ida_02	= 'Localizador';
				$w_voo_etkt_titulo_ida_02			= 'E-ticket';
				$w_voo_com_bvt_titulo_ida_02		= 'Comprada com Belvitur';						
				
				if ( $this->rs4[$i][19] == 'Y') {
					$w_voo_comprado_bvt_ida_02	= 'SIM';
				} else {
					$w_voo_comprado_bvt_ida_02	= 'NÃO';
				}
				$w_voo_titulo_logo_ida_02 = 'Ida';				
				break;
				
			case 2:
				$w_voo_origem_ida_03 		= $this->rs4[$i][24]; 
				$w_voo_saida_origem_ida_03	= $this->rs4[$i][11].' - '.$this->rs4[$i][12];
				$w_voo_saida_origem_ida_03	= substr($w_voo_saida_origem_ida_03,0,18);
				$w_voo_destino_ida_03		= '';
				$w_voo_chega_destino_ida_03	= $this->rs4[$i][14].' - '.$this->rs4[$i][15];
				$w_voo_chega_destino_ida_03	= substr($w_voo_chega_destino_ida_03,0,18);
				$w_voo_cia_ida_03			= $this->rs4[$i][23];
				$w_voo_numvoo_ida_03      	= $this->rs4[$i][8];
				$w_voo_localizador_ida_03 	= $this->rs4[$i][17];
				$w_voo_etkt_ida_03       	= $this->rs4[$i][18];
				$w_voo_assento_ida_03		= $this->rs4[$i][25];
				$w_voo_origem_titulo_ida_03 		= 'Origem';
				$w_voo_saida_titulo_ida_03			= 'Saída';
				$w_voo_destino_tiulo_ida_03			= 'Destino';	
				$w_voo_chegada_titulo_ida_03		= 'Chegada';
				$w_voo_cia_titulo_ida_03			= 'Cia.';
				$w_voo_titulo_ida_03				= 'Voo';
				$w_voo_localizador_titulo_ida_03	= 'Localizador';
				$w_voo_etkt_titulo_ida_03			= 'E-ticket';
				$w_voo_com_bvt_titulo_ida_03		= 'Comprada com Belvitur';
				
				if ( $this->rs4[$i][19] == 'Y') {
					$w_voo_comprado_bvt_ida_03	= 'SIM';
				} else {
					$w_voo_comprado_bvt_ida_03 = 'NÃO';
				}
				$w_voo_titulo_logo_ida_03 = 'Ida';
				break;
			case 3:
				$w_voo_origem_ida_04 		= $this->rs4[$i][24]; 
				$w_voo_saida_origem_ida_04	= $this->rs4[$i][11].' - '.$this->rs4[$i][12];
				$w_voo_saida_origem_ida_04	= substr($w_voo_saida_origem_ida_04,0,18);
				$w_voo_destino_ida_04		= '';
				$w_voo_chega_destino_ida_04	= $this->rs4[$i][14].' - '.$this->rs4[$i][15];
				$w_voo_chega_destino_ida_04	= substr($w_voo_chega_destino_ida_04,0,18);
				$w_voo_cia_ida_04			= $this->rs4[$i][23];
				$w_voo_numvoo_ida_04      	= $this->rs4[$i][8];
				$w_voo_localizador_ida_04 	= $this->rs4[$i][17];
				$w_voo_etkt_ida_04       	= $this->rs4[$i][18];
				$w_voo_assento_ida_04		= $this->rs4[$i][25];
				$w_voo_origem_titulo_ida_04 		= 'Origem';
				$w_voo_saida_titulo_ida_04			= 'Saída';
				$w_voo_destino_tiulo_ida_04			= 'Destino';	
				$w_voo_chegada_titulo_ida_04		= 'Chegada';
				$w_voo_cia_titulo_ida_04			= 'Cia.';
				$w_voo_titulo_ida_04				= 'Voo';
				$w_voo_localizador_titulo_ida_04	= 'Localizador';
				$w_voo_etkt_titulo_ida_04			= 'E-ticket';
				$w_voo_com_bvt_titulo_ida_04		= 'Comprada com Belvitur';
				
				if ( $this->rs4[$i][19] == 'Y') {
					$w_voo_comprado_bvt_ida_04	= 'SIM';
				} else {
					$w_voo_comprado_bvt_ida_04 = 'NÃO';
				}
				$w_voo_titulo_logo_ida_04 = 'Ida';
				break;
		}
	}
} else {
	$w_voo_observacoes_ida = '';	
	$w_voo_titulo_logo_ida_01 = '';
	$w_voo_titulo_logo_ida_02 = '';
	$w_voo_titulo_logo_ida_03 = '';
	$w_voo_titulo_logo_ida_04 = '';	
}

$sql5="
	SELECT
		aereos_rsvp.id_aereo,
		aereos_rsvp.aereo_id_evento,
		aereos_rsvp.aereo_destino,
		concat(aeroporto.NOM_CIDADE,' - ',aeroporto.SIGLA,' - ',aeroporto.NOM_AEROPORTO)
	FROM
		aereos_rsvp
	LEFT JOIN 
		aeroporto
	ON 
		aereos_rsvp.aereo_destino = aeroporto.COD_AEROPORTO	
	LEFT JOIN
		tbl_cia_aereas
	ON
		aereos_rsvp.aereo_cia_aerea = tbl_cia_aereas.cia_id				
	WHERE
		aereos_rsvp.aereo_status = ".$this->Db->qstr($valor_y)."
	AND
		aereos_rsvp.aereo_cpf_particip = ".$this->Db->qstr($this->sc_temp_vg_cpf)."
	AND
		aereos_rsvp.aereo_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	AND 
		aereos_rsvp.aereo_direcao = ".$this->Db->qstr($valor_ida)."	
	ORDER BY 
		aereos_rsvp.aereo_dt_saida,aereos_rsvp.aereo_hr_saida 
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
	
$aid = sizeof($this->rs5 );
if ($aid > 0) {	
	for ($dx=0;$dx<$aid;++$dx) {		
		switch($dx) {
			case 0:
				$w_voo_destino_ida_01 =  $this->rs5[$dx][3];			
				break;
			case 1:
				$w_voo_destino_ida_02 =  $this->rs5[$dx][3];			
				break;
			case 2:
				$w_voo_destino_ida_03 =  $this->rs5[$dx][3];			
				break;
			case 3:
				$w_voo_destino_ida_04 =  $this->rs5[$dx][3];			
				break;				
		}		
	}
}

$sql6="
	SELECT
		aereos_rsvp.id_aereo,
		aereos_rsvp.aereo_id_evento,
		aereos_rsvp.aereo_id_usuario,
		aereos_rsvp.aereo_cpf_particip,
		aereos_rsvp.aereo_tipo_pessoa,
		aereos_rsvp.aereo_status,
		aereos_rsvp.aereo_direcao,
		aereos_rsvp.aereo_cia_aerea,
		aereos_rsvp.aereo_num_voo,
		aereos_rsvp.aereo_origem,
		aereos_rsvp.aereo_destino,
		DATE_FORMAT(aereos_rsvp.aereo_dt_saida,'%d/%m/%Y') AS dt_saida,
		aereos_rsvp.aereo_hr_saida,
		aereos_rsvp.aereo_dthr_saida,
		DATE_FORMAT(aereos_rsvp.aereo_dt_chegada,'%d/%m/%Y') AS dt_chegada,
		aereos_rsvp.aereo_hr_chegada,
		aereos_rsvp.aereo_dthr_chegada,
		aereos_rsvp.aereo_localizador,
		aereos_rsvp.aereo_eticket,
		aereos_rsvp.aereo_emitida_bvt,
		aereos_rsvp.aereo_bloqueio_id,
		aereos_rsvp.aereo_trecho,
		aereos_rsvp.aereo_ativo,
		tbl_cia_aereas.cia_nome,
		concat(aeroporto.NOM_CIDADE,' - ',aeroporto.SIGLA,' - ',aeroporto.NOM_AEROPORTO),
		aereos_rsvp.aereo_assento
	FROM
		aereos_rsvp
	LEFT JOIN 
		aeroporto
	ON 
		aereos_rsvp.aereo_origem = aeroporto.COD_AEROPORTO	
	LEFT JOIN
		tbl_cia_aereas
	ON
		aereos_rsvp.aereo_cia_aerea = tbl_cia_aereas.cia_id				
	WHERE
		aereos_rsvp.aereo_status = ".$this->Db->qstr($valor_y)."
	AND
		aereos_rsvp.aereo_cpf_particip = ".$this->Db->qstr($this->sc_temp_vg_cpf)."
	AND
		aereos_rsvp.aereo_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	AND 
		aereos_rsvp.aereo_direcao = ".$this->Db->qstr($valor_volta)."	
	ORDER BY 
		aereos_rsvp.aereo_dt_saida,aereos_rsvp.aereo_hr_saida 
";
 
      $nm_select = $sql6; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs6 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs6[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs6 = false;
          $this->rs6_erro = $this->Db->ErrorMsg();
      } 
	
$tam_ai = sizeof($this->rs6 );
if ($tam_ai > 0) {				                                                                                        
	for ($i=0;$i<$tam_ai;++$i) {
		switch($i) {
			case 0:
				$w_voo_origem_volta_01 			= $this->rs6[$i][24]; 
				$w_voo_saida_origem_volta_01	= $this->rs6[$i][11].' - '.$this->rs6[$i][12];
				$w_voo_saida_origem_volta_01	= substr($w_voo_saida_origem_volta_01,0,18);	
				$w_voo_destino_volta_01			= '';
				$w_voo_chega_destino_volta_01	= $this->rs6[$i][14].' - '.$this->rs6[$i][15];
				$w_voo_chega_destino_volta_01	= substr($w_voo_chega_destino_volta_01,0,18);
				$w_voo_cia_volta_01				= $this->rs6[$i][23];
				$w_voo_numvoo_volta_01      	= $this->rs6[$i][8];
				$w_voo_localizador_volta_01 	= $this->rs6[$i][17];
				$w_voo_etkt_volta_01        	= $this->rs6[$i][18];
				$w_voo_assento_volta_01			= $this->rs6[$i][25];
				$w_logo_aerogr					= $w_logo_aereoup;
				
				$w_voo_origem_titulo_volta_01       = 'Origem';
				$w_voo_saida_titulo_volta_01        = 'Saída';
				$w_voo_destino_tiulo_volta_01       = 'Destino';
				$w_voo_chegada_titulo_volta_01      = 'Chegada';
				$w_voo_cia_titulo_volta_01          = 'Cia.';
				$w_voo_titulo_volta_01              = 'Voo';
				$w_voo_localizador_titulo_volta_01  = 'Localizador';
				$w_voo_etkt_titulo_volta_01         = 'E-ticket';
				$w_voo_com_bvt_titulo_volta_01      = 'Comprada com Belvitur';
				
				if ( $this->rs6[$i][19] == 'Y') {
					$w_voo_comprado_bvt_volta_01	= 'SIM';
				} else {
					$w_voo_comprado_bvt_volta_01	= 'NÃO';
				}
				$w_voo_titulo = 'Voos';
				$w_voo_titulo_logo_volta_01 = 'Volta';				
				break;
			case 1:
				$w_voo_origem_volta_02 			= $this->rs6[$i][24]; 
				$w_voo_saida_origem_volta_02	= $this->rs6[$i][11].' - '.$this->rs6[$i][12];
				$w_voo_saida_origem_volta_02	= substr($w_voo_saida_origem_volta_02,0,18);	
				$w_voo_destino_volta_01			= '';
				$w_voo_destino_volta_02			= '';
				$w_voo_chega_destino_volta_02	= $this->rs6[$i][14].' - '.$this->rs6[$i][15];
				$w_voo_chega_destino_volta_02	= substr($w_voo_chega_destino_volta_02,0,18);
				$w_voo_cia_volta_02				= $this->rs6[$i][23];
				$w_voo_numvoo_volta_02      	= $this->rs6[$i][8];
				$w_voo_localizador_volta_02 	= $this->rs6[$i][17];
				$w_voo_etkt_volta_02        	= $this->rs6[$i][18];
				$w_voo_assento_volta_02			= $this->rs6[$i][25];
				$w_voo_origem_titulo_volta_02       = 'Origem';
				$w_voo_saida_titulo_volta_02        = 'Saída';
				$w_voo_destino_tiulo_volta_02       = 'Destino';
				$w_voo_chegada_titulo_volta_02      = 'Chegada';
				$w_voo_cia_titulo_volta_02          = 'Cia.';
				$w_voo_titulo_volta_02              = 'Voo';
				$w_voo_localizador_titulo_volta_02  = 'Localizador';
				$w_voo_etkt_titulo_volta_02         = 'E-ticket';
				$w_voo_com_bvt_titulo_volta_02      = 'Comprada com Belvitur';
				
				if ( $this->rs6[$i][19] == 'Y') {
					$w_voo_comprado_bvt_volta_02	= 'SIM';
				} else {
					$w_voo_comprado_bvt_volta_02= 'NÃO';
				}
				$w_voo_titulo_logo_volta_02 = 'Volta';
				break;	
			case 2:
				$w_voo_origem_volta_03 			= $this->rs6[$i][24]; 
				$w_voo_saida_origem_volta_03	= $this->rs6[$i][11].' - '.$this->rs6[$i][12];
				$w_voo_saida_origem_volta_03	= substr($w_voo_saida_origem_volta_03,0,18);	
				$w_voo_destino_volta_03			= '';
				$w_voo_chega_destino_volta_03	= $this->rs6[$i][14].' - '.$this->rs6[$i][15];
				$w_voo_chega_destino_volta_03	= substr($w_voo_chega_destino_volta_03,0,18);
				$w_voo_cia_volta_03				= $this->rs6[$i][23];
				$w_voo_numvoo_volta_03      	= $this->rs6[$i][8];
				$w_voo_localizador_volta_03 	= $this->rs6[$i][17];
				$w_voo_etkt_volta_03        	= $this->rs6[$i][18];
				$w_voo_assento_volta_03			= $this->rs6[$i][25];
				$w_voo_origem_titulo_volta_03       = 'Origem';
				$w_voo_saida_titulo_volta_03        = 'Saída';
				$w_voo_destino_tiulo_volta_03       = 'Destino';
				$w_voo_chegada_titulo_volta_03      = 'Chegada';
				$w_voo_cia_titulo_volta_03          = 'Cia.';
				$w_voo_titulo_volta_03              = 'Voo';
				$w_voo_localizador_titulo_volta_03  = 'Localizador';
				$w_voo_etkt_titulo_volta_03         = 'E-ticket';
				$w_voo_com_bvt_titulo_volta_03      = 'Comprada com Belvitur';
				
				if ( $this->rs6[$i][19] == 'Y') {
					$w_voo_comprado_bvt_volta_03	= 'SIM';
				} else {
					$w_voo_comprado_bvt_volta_03	= 'NÃO';
				}
				$w_voo_titulo_logo_volta_03 = 'Volta';
				break;
			case 3:
				$w_voo_origem_volta_04 			= $this->rs6[$i][24]; 
				$w_voo_saida_origem_volta_04	= $this->rs6[$i][11].' - '.$this->rs6[$i][12];
				$w_voo_destino_volta_04			= '';
				$w_voo_chega_destino_volta_04	= $this->rs6[$i][14].' - '.$this->rs6[$i][15];
				$w_voo_cia_volta_04				= $this->rs6[$i][23];
				$w_voo_numvoo_volta_04      	= $this->rs6[$i][8];
				$w_voo_localizador_volta_04 	= $this->rs6[$i][17];
				$w_voo_etkt_volta_04        	= $this->rs6[$i][18];
				$w_voo_assento_volta_04			= $this->rs6[$i][25];
				$w_voo_origem_titulo_volta_04       = 'Origem';
				$w_voo_saida_titulo_volta_04        = 'Saída';
				$w_voo_destino_tiulo_volta_04       = 'Destino';
				$w_voo_chegada_titulo_volta_04      = 'Chegada';
				$w_voo_cia_titulo_volta_04          = 'Cia.';
				$w_voo_titulo_volta_04              = 'Voo';
				$w_voo_localizador_titulo_volta_04  = 'Localizador';
				$w_voo_etkt_titulo_volta_04         = 'E-ticket';
				$w_voo_com_bvt_titulo_volta_04      = 'Comprada com Belvitur';
				
				if ( $this->rs6[$i][19] == 'Y') {
					$w_voo_comprado_bvt_volta_04	= 'SIM';
				} else {
					$w_voo_comprado_bvt_volta_04	= 'NÃO';
				}
				$w_voo_titulo_logo_volta_04 = 'Volta';
				break;
		}
	}	
} else {
	$w_voo_observacoes_volta = '';
	$w_voo_titulo_logo_volta_01 = '';
	$w_voo_titulo_logo_volta_02 = '';
	$w_voo_titulo_logo_volta_03 = '';
	$w_voo_titulo_logo_volta_04 = '';
}

$sql7="
	SELECT
		aereos_rsvp.id_aereo,
		aereos_rsvp.aereo_id_evento,
		aereos_rsvp.aereo_destino,
		concat(aeroporto.NOM_CIDADE,' - ',aeroporto.SIGLA,' - ',aeroporto.NOM_AEROPORTO)
	FROM
		aereos_rsvp
	LEFT JOIN 
		aeroporto
	ON 
		aereos_rsvp.aereo_destino = aeroporto.COD_AEROPORTO	
	LEFT JOIN
		tbl_cia_aereas
	ON
		aereos_rsvp.aereo_cia_aerea = tbl_cia_aereas.cia_id				
	WHERE
		aereos_rsvp.aereo_status = ".$this->Db->qstr($valor_y)."
	AND
		aereos_rsvp.aereo_cpf_particip = ".$this->Db->qstr($this->sc_temp_vg_cpf)."
	AND
		aereos_rsvp.aereo_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	AND 
		aereos_rsvp.aereo_direcao = ".$this->Db->qstr($valor_volta)."	
	ORDER BY 
		aereos_rsvp.aereo_dt_saida,aereos_rsvp.aereo_hr_saida 
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
	
$aid = sizeof($this->rs7 );
if ($aid > 0) {	
	for ($dx=0;$dx<$aid;++$dx) {		
		switch($dx) {
			case 0:
				$w_voo_destino_volta_01 =  $this->rs7[$dx][3];			
				break;
			case 1:
				$w_voo_destino_volta_02 =  $this->rs7[$dx][3];			
				break;
			case 2:
				$w_voo_destino_volta_03 =  $this->rs7[$dx][3];			
				break;
			case 3:
				$w_voo_destino_volta_04 =  $this->rs7[$dx][3];			
				break;				
		}		
	}
}

$w_hosp_titulo 					= '';
$w_hosp_id_hotel_01				= '';
$w_hosp_fantasia_hotel_01		= '';
$w_hosp_logradouro_hotel_01		= '';
$w_hosp_numero_hotel_01			= '';
$w_hosp_complemento_hotel_01	= '';	
$w_hosp_municipio_hotel_01		= '';
$w_hosp_uf_hotel_01				= '';
$w_hosp_cep_hotel_01			= '';
$w_hosp_pais_hotel_01			= '';
$w_hosp_acomodacao_hotel_01		= '';
$w_hosp_categoria_hotel_01		= '';
$w_hosp_checkin_hotel_01		= '';
$w_hosp_hr_ckeckin_hotel_01		= '';
$w_hosp_checkout_hotel_01		= '';
$w_hosp_hr_ckeckout_hotel_01	= '';
$w_hosp_acomodacao_titulo_01	= '';	
$w_hosp_categoria_titulo_01		= '';
$w_hosp_checkin_tiulo_01		= '';
$w_hosp_checkout_titulo_01		= '';
$w_hosp_logo_hospedagem_01		= '';

$w_hosp_id_hotel_02				= '';
$w_hosp_fantasia_hotel_02		= '';
$w_hosp_logradouro_hotel_02		= '';
$w_hosp_numero_hotel_02			= '';
$w_hosp_complemento_hotel_02	= '';	
$w_hosp_municipio_hotel_02		= '';
$w_hosp_uf_hotel_02				= '';
$w_hosp_cep_hotel_02			= '';
$w_hosp_pais_hotel_02			= '';
$w_hosp_acomodacao_hotel_02		= '';
$w_hosp_categoria_hotel_02		= '';
$w_hosp_checkin_hotel_02		= '';
$w_hosp_hr_ckeckin_hotel_02		= '';
$w_hosp_checkout_hotel_02		= '';
$w_hosp_hr_ckeckout_hotel_02	= '';
$w_hosp_acomodacao_titulo_02	= '';	
$w_hosp_categoria_titulo_02		= '';
$w_hosp_checkin_tiulo_02		= '';
$w_hosp_checkout_titulo_02		= '';
$w_hosp_logo_hospedagem_02		= '';

$w_hosp_id_hotel_03				= '';
$w_hosp_fantasia_hotel_03		= '';
$w_hosp_logradouro_hotel_03		= '';
$w_hosp_numero_hotel_03			= '';
$w_hosp_complemento_hotel_03	= '';	
$w_hosp_municipio_hotel_03		= '';
$w_hosp_uf_hotel_03				= '';
$w_hosp_cep_hotel_03			= '';
$w_hosp_pais_hotel_03			= '';
$w_hosp_acomodacao_hotel_03		= '';
$w_hosp_categoria_hotel_03		= '';
$w_hosp_checkin_hotel_03		= '';
$w_hosp_hr_ckeckin_hotel_03		= '';
$w_hosp_checkout_hotel_03		= '';
$w_hosp_hr_ckeckout_hotel_03	= '';
$w_hosp_acomodacao_titulo_03	= '';	
$w_hosp_categoria_titulo_03		= '';
$w_hosp_checkin_tiulo_03		= '';
$w_hosp_checkout_titulo_03		= '';
$w_hosp_logo_hospedagem_03		= '';

$w_hosp_id_hotel_04				= '';
$w_hosp_fantasia_hotel_04		= '';
$w_hosp_logradouro_hotel_04		= '';
$w_hosp_numero_hotel_04			= '';
$w_hosp_complemento_hotel_04	= '';	
$w_hosp_municipio_hotel_04		= '';
$w_hosp_uf_hotel_04				= '';
$w_hosp_cep_hotel_04			= '';
$w_hosp_pais_hotel_04			= '';
$w_hosp_acomodacao_hotel_04		= '';
$w_hosp_categoria_hotel_04		= '';
$w_hosp_checkin_hotel_04		= '';
$w_hosp_hr_ckeckin_hotel_04		= '';
$w_hosp_checkout_hotel_04		= '';
$w_hosp_hr_ckeckout_hotel_04	= '';
$w_hosp_acomodacao_titulo_04	= '';	
$w_hosp_categoria_titulo_04		= '';
$w_hosp_checkin_tiulo_04		= '';
$w_hosp_checkout_titulo_04		= '';
$w_hosp_logo_hospedagem_04		= '';

$w_hosp_id_hotel_05				= '';		          
$w_hosp_fantasia_hotel_05		= '';   
$w_hosp_logradouro_hotel_05		= '';	    
$w_hosp_numero_hotel_05			= '';     
$w_hosp_complemento_hotel_05	= '';       
$w_hosp_municipio_hotel_05		= '';      
$w_hosp_uf_hotel_05				= '';       
$w_hosp_cep_hotel_05			= '';             
$w_hosp_pais_hotel_05			= '';        
$w_hosp_acomodacao_hotel_05		= '';         
$w_hosp_categoria_hotel_05		= ''; 
$w_hosp_checkin_hotel_05		= '';   
$w_hosp_hr_ckeckin_hotel_05		= '';
$w_hosp_checkout_hotel_05		= '';  
$w_hosp_hr_ckeckout_hotel_05	= '';
$w_hosp_acomodacao_titulo_05	= '';
$w_hosp_categoria_titulo_05		= ''; 
$w_hosp_checkin_tiulo_05		= '';   
$w_hosp_checkout_titulo_05		= ''; 
$w_hosp_logo_hospedagem_05		= ''; 

$w_hosp_id_hotel_06				= '';	          
$w_hosp_fantasia_hotel_06		= '';  
$w_hosp_logradouro_hotel_06		= '';    
$w_hosp_numero_hotel_06			= '';    
$w_hosp_complemento_hotel_06	= '';      
$w_hosp_municipio_hotel_06		= '';     
$w_hosp_uf_hotel_06				= '';      
$w_hosp_cep_hotel_06			= '';            
$w_hosp_pais_hotel_06			= '';       
$w_hosp_acomodacao_hotel_06		= '';        
$w_hosp_categoria_hotel_06		= '';
$w_hosp_checkin_hotel_06		= '';  
$w_hosp_hr_ckeckin_hotel_06		= '';
$w_hosp_checkout_hotel_06		= ''; 
$w_hosp_hr_ckeckout_hotel_06	= '';
$w_hosp_acomodacao_titulo_06	= '';
$w_hosp_categoria_titulo_06		= '';
$w_hosp_checkin_tiulo_06		= '';  
$w_hosp_checkout_titulo_06		= '';
$w_hosp_logo_hospedagem_06		= '';

$w_acompanhante_011				= "";
$w_acompanhante_021				= "";
$w_acompanhante_031				= "";
$w_acompanhante_041				= "";
$w_participante_acomp_011		= '';
$w_participante_acomp_021		= '';
$w_participante_acomp_031		= '';
$w_participante_acomp_041		= '';

$w_acompanhante_012				= "";
$w_acompanhante_022				= "";
$w_acompanhante_032				= "";
$w_acompanhante_042				= "";
$w_participante_acomp_012		= '';
$w_participante_acomp_022		= '';
$w_participante_acomp_032		= '';
$w_participante_acomp_042		= '';

$w_acompanhante_013				= "";
$w_acompanhante_023				= "";
$w_acompanhante_033				= "";
$w_acompanhante_043				= "";
$w_participante_acomp_013		= '';
$w_participante_acomp_023		= '';
$w_participante_acomp_033		= '';
$w_participante_acomp_043		= '';

$w_acompanhante_014				= "";
$w_acompanhante_024				= "";
$w_acompanhante_034				= "";
$w_acompanhante_044				= "";
$w_participante_acomp_014		= '';
$w_participante_acomp_024		= '';
$w_participante_acomp_034		= '';
$w_participante_acomp_044		= '';

$w_acompanhante_015				= '';
$w_acompanhante_025				= '';
$w_acompanhante_035				= '';
$w_acompanhante_045				= '';
$w_participante_acomp_015		= '';
$w_participante_acomp_025		= '';
$w_participante_acomp_035		= '';
$w_participante_acomp_045		= '';

$w_acompanhante_016				= '';
$w_acompanhante_026				= '';
$w_acompanhante_036				= '';
$w_acompanhante_046				= '';
$w_participante_acomp_016		= '';
$w_participante_acomp_026		= '';
$w_participante_acomp_036		= '';
$w_participante_acomp_046		= '';

$w_logo_hospgrv 				=  '';

$sql9="
SELECT
    hosp_id_evento,
    hosp_id_usuario,
	hosp_cpf_participante,
	hosp_acomodacao,
	hosp_status,
	hosp_ativo,
	DATE_FORMAT(hosp_dt_checkin,'%d/%m/%Y') AS dt_chin,
	DATE_FORMAT(hosp_dt_checkout,'%d/%m/%Y') AS dt_out,
	hosp_hr_checkin,
	hosp_hr_checkout,
	hosp_id_hotel,
	hosp_categoria,
	hosp_part_acomp,
	hosp_acompanhante,
	acmq_01,
	acmq_02,
	acmq_03,
	acmq_04,
	pamq_01,
	pamq_02,
	pamq_03,
	pamq_04
FROM
   hospedagem_rsvp
WHERE
	hosp_status = ".$this->Db->qstr($valor_y)."
AND 
	hosp_ativo = ".$this->Db->qstr($valor_y)."
AND
	hosp_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
AND
	hosp_cpf_participante = ".$this->Db->qstr($this->sc_temp_vg_cpf)."
ORDER BY 
 	acmq_01 DESC, acmq_02 DESC, pamq_01 DESC, pamq_02 DESC, hosp_dt_checkin ASC, hosp_hr_checkin ASC	
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
	
$tam_h = sizeof($this->rs9 );

if ($tam_h > 0) {				                                                                                        
	for ($i=0;$i<$tam_h;++$i) {
		$sql10 = "
		SELECT
			hotel_fantasia,
			hotel_logradouro,
			hotel_numero,
			hotel_complemento,
			hotel_municipio, 
			hotel_uf,
			hotel_cep,
			hotel_pais,  
			hotel_bairro			
		FROM
			tbl_hoteis
		WHERE
			hotel_id = ".$this->Db->qstr($this->rs9[$i][10])."
		ORDER BY
			hotel_id
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
			switch($i) {
				case 0:
					$w_hosp_titulo 					= 'Hospedagem';
					$w_hosp_id_hotel_01				=  $this->rs9[$i][10];	
					$w_hosp_fantasia_hotel_01		=  $this->rs10[0][0];						
					$w_hosp_logradouro_hotel_01		=  $this->rs10[0][1];						
					$w_hosp_numero_hotel_01			=  $this->rs10[0][2];						
					$w_hosp_complemento_hotel_01	=  $this->rs10[0][3];							
					$w_hosp_municipio_hotel_01		=  $this->rs10[0][4];							
					$w_hosp_uf_hotel_01				=  $this->rs10[0][5];
					$w_hosp_cep_hotel_01			=  $this->rs10[0][6];
					$w_hosp_pais_hotel_01			=  $this->rs10[0][7];						
					$w_hosp_checkin_hotel_01		=  $this->rs9[$i][6];
					$w_hosp_hr_ckeckin_hotel_01		=  $this->rs9[$i][8];	
					$w_hosp_checkout_hotel_01		=  $this->rs9[$i][7];
					$w_hosp_hr_ckeckout_hotel_01	=  $this->rs9[$i][9];	
					
					$w_hosp_acomodacao_titulo_01	= 'Acomodação';	
					$w_hosp_categoria_titulo_01		= 'Categoria';
					$w_hosp_checkin_tiulo_01		= 'CheckIn';
					$w_hosp_checkout_titulo_01		= 'CheckOut';
					
					$w_acompanhante_011				=  $this->rs9[$i][14];					
					$w_acompanhante_021				=  $this->rs9[$i][15];					
					$w_acompanhante_031				=  $this->rs9[$i][16];					
					$w_acompanhante_041				=  $this->rs9[$i][17];					
					$w_participante_acomp_011		=  $this->rs9[$i][18];					
					$w_participante_acomp_021		=  $this->rs9[$i][19];				
					$w_participante_acomp_031		=  $this->rs9[$i][20];					
					$w_participante_acomp_041		=  $this->rs9[$i][21];	
					$w_logo_hospgrv 				=  $w_logo_hospup;
					$w_hosp_hr_ckeckin_hotel_01		= substr($w_hosp_hr_ckeckin_hotel_01,0,5);
					$w_hosp_hr_ckeckout_hotel_01	= substr($w_hosp_hr_ckeckout_hotel_01,0,5);
					$sql11 ="
					SELECT
						acomodacao_id,
						acomodacao_sigla,
						acomodacao_desc
					FROM
						tbl_acomodacoes
					WHERE
						acomodacao_id = ".$this->Db->qstr($this->rs9[$i][3])."
					ORDER BY
						acomodacao_id
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
						$w_hosp_acomodacao_hotel_01 =  $this->rs11[0][2];
					}		
					$sql12 = "
					SELECT
						acomod_id,
						acomod_dsc
					FROM
						tbl_categ_acomod
					WHERE
						acomod_id = ".$this->Db->qstr($this->rs9[$i][11])."
					ORDER BY
						acomod_id
					";
					 
      $nm_select = $sql12; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs12 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs12[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs12 = false;
          $this->rs12_erro = $this->Db->ErrorMsg();
      } 

					if (isset($this->rs12[0][0])) {											
						$w_hosp_categoria_hotel_01	=  $this->rs12[0][1];
					}		
				

					if ($w_acompanhante_011 <> '' && $w_acompanhante_011 <> 'ANHANTE') {				
						$sql13 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_acompanhante_011)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql13; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs13 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs13[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs13 = false;
          $this->rs13_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs13[0][0])) {											
							$w_acompanhante_011	=  $this->rs13[0][0];
							$w_acompanhantes_titulo	= 'Acompanhantes';
						}								
					}	
					if ($w_acompanhante_021 <> '' && $w_acompanhante_021 <> 'ANHANTE') {				
						$sql14 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_acompanhante_021)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql14; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs14 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs14[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs14 = false;
          $this->rs14_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs14[0][0])) {											
							$w_acompanhante_021	=  $this->rs14[0][0];
							$w_acompanhantes_titulo	= 'Acompanhantes';
						}								
					}
					if ($w_acompanhante_031 <> '' && $w_acompanhante_031 <> 'ANHANTE') {				
						$sql15 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_acompanhante_031)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql15; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs15 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs15[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs15 = false;
          $this->rs15_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs15[0][0])) {											
							$w_acompanhante_031	=  $this->rs15[0][0];
							$w_acompanhantes_titulo	= 'Acompanhantes';
						}								
					}					
					if ($w_acompanhante_041 <> '' && $w_acompanhante_041 <> 'ANHANTE') {				
						$sql16 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_acompanhante_041)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql16; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs16 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs16[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs16 = false;
          $this->rs16_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs16[0][0])) {											
							$w_acompanhante_041	=  $this->rs16[0][0];
							$w_acompanhantes_titulo	= 'Acompanhantes';
						}								
					}

							
					
					if ($w_participante_acomp_011 <> '' && $w_participante_acomp_011 <> 'ANHANTE') {				
						$sql17 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_participante_acomp_011)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql17; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs17 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs17[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs17 = false;
          $this->rs17_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs17[0][0])) {											
							$w_participante_acomp_011 = $this->rs17[0][0];
							$w_acompanhantes_titulo	= 'Acompanhantes';
						}								
					}					
					if ($w_participante_acomp_021 <> '' && $w_participante_acomp_021 <> 'ANHANTE') {				
						$sql18 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_participante_acomp_021)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql18; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs18 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs18[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs18 = false;
          $this->rs18_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs18[0][0])) {											
							$w_participante_acomp_021 = $this->rs18[0][0];
							$w_acompanhantes_titulo	= 'Acompanhantes';
						}								
					}					
					if ($w_participante_acomp_031 <> '' && $w_participante_acomp_031 <> 'ANHANTE') {				
						$sql19 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_participante_acomp_031)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql19; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs19 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs19[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs19 = false;
          $this->rs19_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs19[0][0])) {											
							$w_participante_acomp_031 = $this->rs19[0][0];
							$w_acompanhantes_titulo	= 'Acompanhantes';
						}								
					}					
					if ($w_participante_acomp_041 <> '' && $w_participante_acomp_041 <> 'ANHANTE') {				
						$sql20 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_participante_acomp_041)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql20; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs20 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs20[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs20 = false;
          $this->rs20_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs20[0][0])) {											
							$w_participante_acomp_041 = $this->rs20[0][0];
							$w_acompanhantes_titulo	= 'Acompanhantes';
						}								
					}	
					
					break;
					
				case 1:
					$w_hosp_id_hotel_02				=  $this->rs9[$i][10];	
					$w_hosp_fantasia_hotel_02		=  $this->rs10[0][0];						
					$w_hosp_logradouro_hotel_02		=  $this->rs10[0][1];						
					$w_hosp_numero_hotel_02			=  $this->rs10[0][2];						
					$w_hosp_complemento_hotel_02	=  $this->rs10[0][3];							
					$w_hosp_municipio_hotel_02		=  $this->rs10[0][4];							
					$w_hosp_uf_hotel_02				=  $this->rs10[0][5];
					$w_hosp_cep_hotel_02			=  $this->rs10[0][6];
					$w_hosp_pais_hotel_02			=  $this->rs10[0][7];						
					$w_hosp_checkin_hotel_02		=  $this->rs9[$i][6];
					$w_hosp_hr_ckeckin_hotel_02		=  $this->rs9[$i][8];	
					$w_hosp_checkout_hotel_02		=  $this->rs9[$i][7];
					$w_hosp_hr_ckeckout_hotel_02	=  $this->rs9[$i][9];						
					
					$w_hosp_acomodacao_titulo_02	= 'Acomodação';	
					$w_hosp_categoria_titulo_02		= 'Categoria';
					$w_hosp_checkin_tiulo_02		= 'CheckIn';
					$w_hosp_checkout_titulo_02		= 'CheckOut';
					
					$w_acompanhante_012				=  $this->rs9[$i][14];					
					$w_acompanhante_022				=  $this->rs9[$i][15];					
					$w_acompanhante_032				=  $this->rs9[$i][16];					
					$w_acompanhante_042				=  $this->rs9[$i][17];					
					$w_participante_acomp_012		=  $this->rs9[$i][18];					
					$w_participante_acomp_022		=  $this->rs9[$i][19];				
					$w_participante_acomp_032		=  $this->rs9[$i][20];					
					$w_participante_acomp_042		=  $this->rs9[$i][21];			
					$w_hosp_hr_ckeckin_hotel_02		= substr($w_hosp_hr_ckeckin_hotel_02,0,5);
					$w_hosp_hr_ckeckout_hotel_02	= substr($w_hosp_hr_ckeckout_hotel_02,0,5);
					$sql11 ="
					SELECT
						acomodacao_id,
						acomodacao_sigla,
						acomodacao_desc
					FROM
						tbl_acomodacoes
					WHERE
						acomodacao_id = ".$this->Db->qstr($this->rs9[$i][3])."
					ORDER BY
						acomodacao_id
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
						$w_hosp_acomodacao_hotel_02 =  $this->rs11[0][2];
					}		
					$sql12 = "
					SELECT
						acomod_id,
						acomod_dsc
					FROM
						tbl_categ_acomod
					WHERE
						acomod_id = ".$this->Db->qstr($this->rs9[$i][11])."
					ORDER BY
						acomod_id
					";
					 
      $nm_select = $sql12; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs12 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs12[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs12 = false;
          $this->rs12_erro = $this->Db->ErrorMsg();
      } 

					if (isset($this->rs12[0][0])) {											
						$w_hosp_categoria_hotel_02	=  $this->rs12[0][1];
					}		


					if ($w_acompanhante_012 <> '' && $w_acompanhante_012 <> 'ANHANTE') {				
						$sql13 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_acompanhante_012)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql13; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs13 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs13[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs13 = false;
          $this->rs13_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs13[0][0])) {											
							$w_acompanhante_012	=  $this->rs13[0][0];
						}								
					}	
					if ($w_acompanhante_022 <> '' && $w_acompanhante_022 <> 'ANHANTE') {				
						$sql14 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_acompanhante_022)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql14; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs14 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs14[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs14 = false;
          $this->rs14_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs14[0][0])) {											
							$w_acompanhante_022	=  $this->rs14[0][0];
						}								
					}
					if ($w_acompanhante_032 <> '' && $w_acompanhante_032 <> 'ANHANTE') {				
						$sql15 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_acompanhante_032)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql15; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs15 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs15[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs15 = false;
          $this->rs15_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs15[0][0])) {											
							$w_acompanhante_032	=  $this->rs15[0][0];
						}								
					}					
					if ($w_acompanhante_042 <> '' && $w_acompanhante_042 <> 'ANHANTE') {				
						$sql16 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_acompanhante_042)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql16; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs16 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs16[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs16 = false;
          $this->rs16_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs16[0][0])) {											
							$w_acompanhante_042	=  $this->rs16[0][0];
						}								
					}

				
					if ($w_participante_acomp_012 <> '' && $w_participante_acomp_012 <> 'ANHANTE') {				
						$sql17 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_participante_acomp_012)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql17; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs17 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs17[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs17 = false;
          $this->rs17_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs17[0][0])) {											
							$w_participante_acomp_012 = $this->rs17[0][0];
						}								
					}					
					if ($w_participante_acomp_022 <> '' && $w_participante_acomp_022 <> 'ANHANTE') {				
						$sql18 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_participante_acomp_022)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql18; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs18 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs18[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs18 = false;
          $this->rs18_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs18[0][0])) {											
							$w_participante_acomp_022 = $this->rs18[0][0];
						}								
					}					
					if ($w_participante_acomp_032 <> '' && $w_participante_acomp_032 <> 'ANHANTE') {				
						$sql19 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_participante_acomp_032)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql19; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs19 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs19[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs19 = false;
          $this->rs19_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs19[0][0])) {											
							$w_participante_acomp_032 = $this->rs19[0][0];
						}								
					}					
					if ($w_participante_acomp_042 <> '' && $w_participante_acomp_042 <> 'ANHANTE') {				
						$sql20 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_participante_acomp_042)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql20; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs20 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs20[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs20 = false;
          $this->rs20_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs20[0][0])) {											
							$w_participante_acomp_042 = $this->rs20[0][0];
						}								
					}										
					break;
					
				case 2:
					$w_hosp_id_hotel_03				=  $this->rs9[$i][10];	
					$w_hosp_fantasia_hotel_03		=  $this->rs10[0][0];						
					$w_hosp_logradouro_hotel_03		=  $this->rs10[0][1];						
					$w_hosp_numero_hotel_03			=  $this->rs10[0][2];						
					$w_hosp_complemento_hotel_03	=  $this->rs10[0][3];							
					$w_hosp_municipio_hotel_03		=  $this->rs10[0][4];							
					$w_hosp_uf_hotel_03				=  $this->rs10[0][5];
					$w_hosp_cep_hotel_03			=  $this->rs10[0][6];
					$w_hosp_pais_hotel_03			=  $this->rs10[0][7];						
					$w_hosp_checkin_hotel_03		=  $this->rs9[$i][6];
					$w_hosp_hr_ckeckin_hotel_03		=  $this->rs9[$i][8];	
					$w_hosp_checkout_hotel_03		=  $this->rs9[$i][7];
					$w_hosp_hr_ckeckout_hotel_03	=  $this->rs9[$i][9];						
					
					$w_hosp_acomodacao_titulo_03	= 'Acomodação';	
					$w_hosp_categoria_titulo_03		= 'Categoria';
					$w_hosp_checkin_tiulo_03		= 'CheckIn';
					$w_hosp_checkout_titulo_03		= 'CheckOut';

					$w_acompanhante_013				=  $this->rs9[$i][14];					
					$w_acompanhante_023				=  $this->rs9[$i][15];					
					$w_acompanhante_033				=  $this->rs9[$i][16];					
					$w_acompanhante_043				=  $this->rs9[$i][17];					
					$w_participante_acomp_013		=  $this->rs9[$i][18];					
					$w_participante_acomp_023		=  $this->rs9[$i][19];				
					$w_participante_acomp_033		=  $this->rs9[$i][20];					
					$w_participante_acomp_043		=  $this->rs9[$i][21];	
					$w_hosp_hr_ckeckin_hotel_03		= substr($w_hosp_hr_ckeckin_hotel_03,0,5);
					$w_hosp_hr_ckeckout_hotel_03	= substr($w_hosp_hr_ckeckout_hotel_03,0,5);					
					$sql11 ="
					SELECT
						acomodacao_id,
						acomodacao_sigla,
						acomodacao_desc
					FROM
						tbl_acomodacoes
					WHERE
						acomodacao_id = ".$this->Db->qstr($this->rs9[$i][3])."
					ORDER BY
						acomodacao_id
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
						$w_hosp_acomodacao_hotel_03 =  $this->rs11[0][2];
					}		
					$sql12 = "
					SELECT
						acomod_id,
						acomod_dsc
					FROM
						tbl_categ_acomod
					WHERE
						acomod_id = ".$this->Db->qstr($this->rs9[$i][11])."
					ORDER BY
						acomod_id
					";
					 
      $nm_select = $sql12; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs12 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs12[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs12 = false;
          $this->rs12_erro = $this->Db->ErrorMsg();
      } 

					if (isset($this->rs12[0][0])) {											
						$w_hosp_categoria_hotel_03	=  $this->rs12[0][1];
					}		


					if ($w_acompanhante_013 <> '' && $w_acompanhante_013 <> 'ANHANTE') {				
						$sql13 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_acompanhante_013)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql13; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs13 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs13[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs13 = false;
          $this->rs13_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs13[0][0])) {											
							$w_acompanhante_013	=  $this->rs13[0][0];
						}								
					}	
					if ($w_acompanhante_023 <> '' && $w_acompanhante_023 <> 'ANHANTE') {				
						$sql14 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_acompanhante_023)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql14; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs14 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs14[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs14 = false;
          $this->rs14_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs14[0][0])) {											
							$w_acompanhante_023	=  $this->rs14[0][0];
						}								
					}
					if ($w_acompanhante_033 <> '' && $w_acompanhante_033 <> 'ANHANTE') {				
						$sql15 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_acompanhante_033)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql15; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs15 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs15[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs15 = false;
          $this->rs15_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs15[0][0])) {											
							$w_acompanhante_033	=  $this->rs15[0][0];
						}								
					}					
					if ($w_acompanhante_043 <> '' && $w_acompanhante_043 <> 'ANHANTE') {				
						$sql16 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_acompanhante_043)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql16; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs16 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs16[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs16 = false;
          $this->rs16_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs16[0][0])) {											
							$w_acompanhante_043	=  $this->rs16[0][0];
						}								
					}


					if ($w_participante_acomp_013 <> '' && $w_participante_acomp_013 <> 'ANHANTE') {				
						$sql17 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_participante_acomp_013)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql17; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs17 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs17[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs17 = false;
          $this->rs17_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs17[0][0])) {											
							$w_participante_acomp_013 = $this->rs17[0][0];
						}								
					}					
					if ($w_participante_acomp_023 <> '' && $w_participante_acomp_023 <> 'ANHANTE') {				
						$sql18 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_participante_acomp_023)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql18; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs18 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs18[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs18 = false;
          $this->rs18_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs18[0][0])) {											
							$w_participante_acomp_023 = $this->rs18[0][0];
						}								
					}					
					if ($w_participante_acomp_033 <> '' && $w_participante_acomp_033 <> 'ANHANTE') {				
						$sql19 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_participante_acomp_033)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql19; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs19 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs19[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs19 = false;
          $this->rs19_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs19[0][0])) {											
							$w_participante_acomp_033 = $this->rs19[0][0];
						}								
					}					
					if ($w_participante_acomp_043 <> '' && $w_participante_acomp_043 <> 'ANHANTE') {				
						$sql20 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_participante_acomp_043)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql20; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs20 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs20[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs20 = false;
          $this->rs20_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs20[0][0])) {											
							$w_participante_acomp_043 = $this->rs20[0][0];
						}								
					}										
					break;
					
				case 3:
					$w_hosp_id_hotel_04				=  $this->rs9[$i][10];	
					$w_hosp_fantasia_hotel_04		=  $this->rs10[0][0];						
					$w_hosp_logradouro_hotel_04		=  $this->rs10[0][1];						
					$w_hosp_numero_hotel_04			=  $this->rs10[0][2];						
					$w_hosp_complemento_hotel_04	=  $this->rs10[0][3];							
					$w_hosp_municipio_hotel_04		=  $this->rs10[0][4];							
					$w_hosp_uf_hotel_04				=  $this->rs10[0][5];
					$w_hosp_cep_hotel_04			=  $this->rs10[0][6];
					$w_hosp_pais_hotel_04			=  $this->rs10[0][7];						
					$w_hosp_checkin_hotel_04		=  $this->rs9[$i][6];
					$w_hosp_hr_ckeckin_hotel_04		=  $this->rs9[$i][8];	
					$w_hosp_checkout_hotel_04		=  $this->rs9[$i][7];
					$w_hosp_hr_ckeckout_hotel_04	=  $this->rs9[$i][9];	
					
					$w_hosp_acomodacao_titulo_04	= 'Acomodação';	
					$w_hosp_categoria_titulo_04		= 'Categoria';
					$w_hosp_checkin_tiulo_04		= 'CheckIn';
					$w_hosp_checkout_titulo_04		= 'CheckOut';

					$w_acompanhante_014				=  $this->rs9[$i][14];					
					$w_acompanhante_024				=  $this->rs9[$i][15];					
					$w_acompanhante_034				=  $this->rs9[$i][16];					
					$w_acompanhante_044				=  $this->rs9[$i][17];					
					$w_participante_acomp_014		=  $this->rs9[$i][18];					
					$w_participante_acomp_024		=  $this->rs9[$i][19];				
					$w_participante_acomp_034		=  $this->rs9[$i][20];					
					$w_participante_acomp_044		=  $this->rs9[$i][21];	
					$w_hosp_hr_ckeckin_hotel_04		= substr($w_hosp_hr_ckeckin_hotel_04,0,5);
					$w_hosp_hr_ckeckout_hotel_04	= substr($w_hosp_hr_ckeckout_hotel_04,0,5);					
					$sql11 ="
					SELECT
						acomodacao_id,
						acomodacao_sigla,
						acomodacao_desc
					FROM
						tbl_acomodacoes
					WHERE
						acomodacao_id = ".$this->Db->qstr($this->rs9[$i][3])."
					ORDER BY
						acomodacao_id
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
						$w_hosp_acomodacao_hotel_04 =  $this->rs11[0][2];
					}		
					$sql12 = "
					SELECT
						acomod_id,
						acomod_dsc
					FROM
						tbl_categ_acomod
					WHERE
						acomod_id = ".$this->Db->qstr($this->rs9[$i][11])."
					ORDER BY
						acomod_id
					";
					 
      $nm_select = $sql12; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs12 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs12[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs12 = false;
          $this->rs12_erro = $this->Db->ErrorMsg();
      } 

					if (isset($this->rs12[0][0])) {											
						$w_hosp_categoria_hotel_04	=  $this->rs12[0][1];
					}		
				

					if ($w_acompanhante_014 <> '' && $w_acompanhante_014 <> 'ANHANTE') {				
						$sql13 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_acompanhante_014)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql13; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs13 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs13[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs13 = false;
          $this->rs13_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs13[0][0])) {											
							$w_acompanhante_014	=  $this->rs13[0][0];
						}								
					}	
					if ($w_acompanhante_024 <> '' && $w_acompanhante_024 <> 'ANHANTE') {				
						$sql14 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_acompanhante_024)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql14; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs14 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs14[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs14 = false;
          $this->rs14_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs14[0][0])) {											
							$w_acompanhante_024	=  $this->rs14[0][0];
						}								
					}
					if ($w_acompanhante_034 <> '' && $w_acompanhante_034 <> 'ANHANTE') {				
						$sql15 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_acompanhante_034)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql15; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs15 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs15[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs15 = false;
          $this->rs15_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs15[0][0])) {											
							$w_acompanhante_034	=  $this->rs15[0][0];
						}								
					}					
					if ($w_acompanhante_044 <> '' && $w_acompanhante_044 <> 'ANHANTE') {				
						$sql16 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_acompanhante_044)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql16; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs16 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs16[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs16 = false;
          $this->rs16_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs16[0][0])) {											
							$w_acompanhante_044	=  $this->rs16[0][0];
						}								
					}

					
					if ($w_participante_acomp_014 <> '' && $w_participante_acomp_014 <> 'ANHANTE') {				
						$sql17 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_participante_acomp_014)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql17; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs17 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs17[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs17 = false;
          $this->rs17_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs17[0][0])) {											
							$w_participante_acomp_014 = $this->rs17[0][0];
						}								
					}					
					if ($w_participante_acomp_024 <> '' && $w_participante_acomp_024 <> 'ANHANTE') {				
						$sql18 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_participante_acomp_024)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql18; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs18 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs18[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs18 = false;
          $this->rs18_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs18[0][0])) {											
							$w_participante_acomp_024 = $this->rs18[0][0];
						}								
					}					
					if ($w_participante_acomp_034 <> '' && $w_participante_acomp_034 <> 'ANHANTE') {				
						$sql19 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_participante_acomp_034)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql19; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs19 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs19[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs19 = false;
          $this->rs19_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs19[0][0])) {											
							$w_participante_acomp_034 = $this->rs19[0][0];
						}								
					}					
					if ($w_participante_acomp_044 <> '' && $w_participante_acomp_044 <> 'ANHANTE') {				
						$sql20 = "
						SELECT
							pessoa_nome							
						FROM
							pessoas_rsvp
						WHERE
							pessoa_cpf = ".$this->Db->qstr($w_participante_acomp_044)."
						ORDER BY
							pessoa_cpf
						";
						 
      $nm_select = $sql20; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs20 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs20[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs20 = false;
          $this->rs20_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rs20[0][0])) {											
							$w_participante_acomp_044 = $this->rs20[0][0];
						}								
					}										
					break;				
			}		
		}
	}
} else {	
	$w_hosp_observacoes = '';
	$w_acompanhantes_titulo = '';
}

if($w_participante_acomp_011 == '' && $w_participante_acomp_021 == '' && $w_participante_acomp_022 == '' &&  $w_participante_acomp_012 <> '') {
	$w_participante_acomp_011 = $w_participante_acomp_012;
	$w_participante_acomp_012 = '';
}	



$w_opc_tipo_dsc_01 = '';
$w_opc_tipo_dsc_02 = '';
$w_opc_tipo_dsc_03 = '';
$w_opc_tipo_dsc_04 = '';
$w_opc_tipo_dsc_05 = '';
$w_opc_tipo_dsc_06 = '';
$sql21="
SELECT
	opc_evento_id,
	opc_status,
	opc_cpf_participante,
	opc_tipo_dsc,
	opc_tipo_id
FROM
    eventos_opcionais_rsvp
WHERE
	opc_status = ".$this->Db->qstr($valor_y)."
AND
	opc_evento_id = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
AND
	opc_cpf_participante = ".$this->Db->qstr($this->sc_temp_vg_cpf)."
ORDER BY 
	opc_evento_id,opc_cpf_participante,opc_tipo_id
";
 
      $nm_select = $sql21; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs21 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs21[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs21 = false;
          $this->rs21_erro = $this->Db->ErrorMsg();
      } 
	
$tam_o = sizeof($this->rs21 );
if ($tam_o > 0) {	
	$w_opcionais_titulo = 'Opcionais';
	for ($i=0;$i<$tam_o;++$i) {
		switch($i) {
			case 0:
				$w_opc_tipo_dsc_01 =  $this->rs21[$i][3];	
				break;
			case 1:
				$w_opc_tipo_dsc_02 =  $this->rs21[$i][3];					
				break;
			case 2:
				$w_opc_tipo_dsc_03 =  $this->rs21[$i][3];					
				break;
			case 3:
				$w_opc_tipo_dsc_04 =  $this->rs21[$i][3];	
				break;				
		}		
	}	
} else {
	$w_opcionais_titulo = '';
}

$w_logo_transgrv = '';
$sql22 = "
SELECT
	tra_id_evento,
	tra_cpf_particip
FROM
	transfer_rsvp
WHERE
	tra_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
AND
	tra_cpf_particip = ".$this->Db->qstr($this->sc_temp_vg_cpf)."
AND 
	tra_status = ".$this->Db->qstr($valor_y)."
AND
	tra_flag_ida = ".$this->Db->qstr($valor_y)."
";
 
      $nm_select = $sql22; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs22 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs22[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs22 = false;
          $this->rs22_erro = $this->Db->ErrorMsg();
      } 
	
if (isset($this->rs22[0][0])) {
	$w_transfer_titulo	= 'Transfer';	
	$w_logo_transgrv = $w_logo_transup;
} else {
	$w_transfer_in_observacoes	= '';	
}	
$sql23 = "
SELECT
	tra_id_evento,
	tra_cpf_particip
FROM
	transfer_rsvp
WHERE
	tra_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
AND
	tra_cpf_particip = ".$this->Db->qstr($this->sc_temp_vg_cpf)."
AND 
	tra_status = ".$this->Db->qstr($valor_y)."
AND
	tra_flag_volta = ".$this->Db->qstr($valor_y)."
";
 
      $nm_select = $sql23; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs23 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs23[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs23 = false;
          $this->rs23_erro = $this->Db->ErrorMsg();
      } 
	
if (isset($this->rs23[0][0])) {
	$w_transfer_titulo	= 'Transfer';	
	$w_logo_transgrv = $w_logo_transup;
} else {
	$w_transfer_out_observacoes	= '';	
}	




$sql24 = "
SELECT
	cod_participante,
	cod_evento,
	status
FROM
	confirmacao_viagem_rsvp
WHERE
	cod_participante = ".$this->Db->qstr($this->sc_temp_vg_cpf)."
AND
	cod_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
ORDER BY
	cod_participante, cod_evento
";
 
      $nm_select = $sql24; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs24 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rs24[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs24 = false;
          $this->rs24_erro = $this->Db->ErrorMsg();
      } 
	
if (isset($this->rs24[0][0])) {
	$w_reg_insert = true;
	$w_status_valor = $this->rs24[0][2];	
	
} else {
	$w_reg_insert = false;
	$w_status_valor = 'PENDENTE';
}	


if ($w_reg_insert == false) {
		$sqli = "					
		INSERT INTO
		confirmacao_viagem_rsvp                                                  
		(criado_em,                                                          
		cod_evento,                                                           
		nome_evento,                                       
		cod_usuario,                                                    
		nome_usuario,                                             
		cod_participante,                                       
		nome_participante ,                                
		tipo_participante,                                      
		email_remetente,                                         
		email_smtp,                                                  
		email_usuario,		                                             
		email_senha,		                                             
		email_destinatario,	                                     
		email_mensagem,		                                          
		email_assunto,		                                     
		email_comcopia,		                                      
		participante_obs,
		voo_titulo,
		voo_origem_ida_01,
		voo_saida_origem_ida_01,
		voo_destino_ida_01,	
		voo_chega_destino_ida_01,
		voo_cia_ida_01,		
		voo_numvoo_ida_01,	
		voo_localizador_ida_01,		
		voo_etkt_ida_01,				             
		voo_comprado_bvt_ida_01, 				
		voo_assento_ida_01,  
		voo_conexao_ida_01,
		voo_origem_titulo_ida_01,
		voo_saida_titulo_ida_01,
		voo_destino_tiulo_ida_01, 
		voo_chegada_titulo_ida_01,
		voo_cia_titulo_ida_01,    
		voo_titulo_ida_01,        		
		voo_localizador_titulo_ida_01,   
		voo_etkt_titulo_ida_01,          
		voo_com_bvt_titulo_ida_01,       		
		voo_titulo_logo_ida_01,	 				
		voo_origem_ida_02,		
		voo_saida_origem_ida_02, 
		voo_destino_ida_02,                  
		voo_chega_destino_ida_02,        		
		voo_cia_ida_02,   
		voo_numvoo_ida_02,
		voo_localizador_ida_02, 
		voo_etkt_ida_02,        
		voo_comprado_bvt_ida_02,
		voo_assento_ida_02,     
		voo_conexao_ida_02,     	
		voo_origem_titulo_ida_02,        
		voo_saida_titulo_ida_02,        
		voo_destino_tiulo_ida_02,        
		voo_chegada_titulo_ida_02,       
		voo_cia_titulo_ida_02,           
		voo_titulo_ida_02,               
		voo_localizador_titulo_ida_02,   
		voo_etkt_titulo_ida_02,          
		voo_com_bvt_titulo_ida_02,       		
		voo_titulo_logo_ida_02,
		voo_origem_ida_03,       
		voo_saida_origem_ida_03, 
		voo_destino_ida_03,      
		voo_chega_destino_ida_03,		
		voo_cia_ida_03,          
		voo_numvoo_ida_03,       
		voo_localizador_ida_03,  
		voo_etkt_ida_03,         
		voo_comprado_bvt_ida_03, 
		voo_assento_ida_03,      
		voo_conexao_ida_03, 
		voo_origem_titulo_ida_03,        
		voo_saida_titulo_ida_03,         
		voo_destino_tiulo_ida_03,        
		voo_chegada_titulo_ida_03,       
		voo_cia_titulo_ida_03,           
		voo_titulo_ida_03,               
		voo_localizador_titulo_ida_03,   
		voo_etkt_titulo_ida_03,          
		voo_com_bvt_titulo_ida_03,       
		voo_titulo_logo_ida_03,	
		voo_origem_ida_04,        
		voo_saida_origem_ida_04,  
		voo_destino_ida_04,       
		voo_chega_destino_ida_04, 
		voo_cia_ida_04,           
		voo_numvoo_ida_04,        
		voo_localizador_ida_04,   
		voo_etkt_ida_04,          
		voo_comprado_bvt_ida_04,  
		voo_assento_ida_04,       
		voo_conexao_ida_04,     		
		voo_origem_titulo_ida_04,     
		voo_saida_titulo_ida_04,      
		voo_destino_tiulo_ida_04,     
		voo_chegada_titulo_ida_04,    
		voo_cia_titulo_ida_04,        
		voo_titulo_ida_04,            
		voo_localizador_titulo_ida_04,
		voo_etkt_titulo_ida_04,       
		voo_com_bvt_titulo_ida_04,    
		voo_titulo_logo_ida_04,	
		voo_origem_volta_01,       
		voo_saida_origem_volta_01, 
		voo_destino_volta_01,      
		voo_chega_destino_volta_01,
		voo_cia_volta_01,          
		voo_numvoo_volta_01,       
		voo_localizador_volta_01,  
		voo_etkt_volta_01,         
		voo_comprado_bvt_volta_01, 
		voo_assento_volta_01,      
		voo_conexao_volta_01, 	
		voo_origem_titulo_volta_01,    
		voo_saida_titulo_volta_01,     
		voo_destino_tiulo_volta_01,    
		voo_chegada_titulo_volta_01,   
		voo_cia_titulo_volta_01,       
		voo_titulo_volta_01,           
		voo_localizador_titulo_volta_01,
		voo_etkt_titulo_volta_01,      
		voo_com_bvt_titulo_volta_01,   
		voo_titulo_logo_volta_01,   		
		voo_origem_volta_02,            	
		voo_saida_origem_volta_02,      	
		voo_destino_volta_02,           	
		voo_chega_destino_volta_02,     	
		voo_cia_volta_02,               	
		voo_numvoo_volta_02,            	
		voo_localizador_volta_02,       	
		voo_etkt_volta_02,              	
		voo_comprado_bvt_volta_02,      	
		voo_assento_volta_02,           	
		voo_conexao_volta_02,           	
		voo_origem_titulo_volta_02,     	
		voo_saida_titulo_volta_02,      	
		voo_destino_tiulo_volta_02,     	
		voo_chegada_titulo_volta_02,    	
		voo_cia_titulo_volta_02,        	
		voo_titulo_volta_02,            	
		voo_localizador_titulo_volta_02,	
		voo_etkt_titulo_volta_02,       	
		voo_com_bvt_titulo_volta_02,    	
		voo_titulo_logo_volta_02,				
		voo_origem_volta_03,            	
		voo_saida_origem_volta_03,      	
		voo_destino_volta_03,           	
		voo_chega_destino_volta_03,     	
		voo_cia_volta_03,               	
		voo_numvoo_volta_03,            	
		voo_localizador_volta_03,       	
		voo_etkt_volta_03,              	
		voo_comprado_bvt_volta_03,      	
		voo_assento_volta_03,           	
		voo_conexao_volta_03,           	
		voo_origem_titulo_volta_03,     	
		voo_saida_titulo_volta_03,      	
		voo_destino_tiulo_volta_03,    	
		voo_chegada_titulo_volta_03,    	
		voo_cia_titulo_volta_03,        	
		voo_titulo_volta_03,            	
		voo_localizador_titulo_volta_03,	
		voo_etkt_titulo_volta_03,       	
		voo_com_bvt_titulo_volta_03,    	
		voo_titulo_logo_volta_03,					
		voo_origem_volta_04,            	
		voo_saida_origem_volta_04,      	
		voo_destino_volta_04,           	
		voo_chega_destino_volta_04,     	
		voo_cia_volta_04,               	
		voo_numvoo_volta_04,            	
		voo_localizador_volta_04,       	
		voo_etkt_volta_04,              	
		voo_comprado_bvt_volta_04,      	
		voo_assento_volta_04,           	
		voo_conexao_volta_04,           	
		voo_origem_titulo_volta_04,     	
		voo_saida_titulo_volta_04,      	
		voo_destino_tiulo_volta_04,    	
		voo_chegada_titulo_volta_04,    	
		voo_cia_titulo_volta_04,        	
		voo_titulo_volta_04,            	
		voo_localizador_titulo_volta_04,	
		voo_etkt_titulo_volta_04,       	
		voo_com_bvt_titulo_volta_04,    	
		voo_titulo_logo_volta_04,	
		voo_observacoes_ida,
		voo_observacoes_volta,		
		hosp_titulo,		
		hosp_fantasia_hotel_01,		
		hosp_logradouro_hotel_01,		
		hosp_numero_hotel_01,			
		hosp_complemento_hotel_01,	
		hosp_municipio_hotel_01,		
		hosp_uf_hotel_01,				
		hosp_cep_hotel_01,			
		hosp_pais_hotel_01,		
		hosp_acomodacao_hotel_01,			
		hosp_categoria_hotel_01,			
		hosp_checkin_hotel_01,			
		hosp_hr_ckeckin_hotel_01,	
		hosp_checkout_hotel_01,	
		hosp_hr_ckeckout_hotel_01,
		hosp_acomodacao_titulo_01,
		hosp_categoria_titulo_01,	
		hosp_checkin_tiulo_01,	
		hosp_checkout_titulo_01,						
		hosp_fantasia_hotel_02,		
		hosp_logradouro_hotel_02,			
		hosp_numero_hotel_02,			
		hosp_complemento_hotel_02,		
		hosp_municipio_hotel_02,		
		hosp_uf_hotel_02,				
		hosp_cep_hotel_02,			
		hosp_pais_hotel_02,		
		hosp_acomodacao_hotel_02,			
		hosp_categoria_hotel_02,			
		hosp_checkin_hotel_02,		
		hosp_hr_ckeckin_hotel_02,			
		hosp_checkout_hotel_02,	
		hosp_hr_ckeckout_hotel_02,			
		hosp_acomodacao_titulo_02,
		hosp_categoria_titulo_02,	
		hosp_checkin_tiulo_02,
		hosp_checkout_titulo_02,	
		hosp_fantasia_hotel_03,		
		hosp_logradouro_hotel_03,			
		hosp_numero_hotel_03,			
		hosp_complemento_hotel_03,		
		hosp_municipio_hotel_03,		
		hosp_uf_hotel_03,				
		hosp_cep_hotel_03,			
		hosp_pais_hotel_03,		
		hosp_acomodacao_hotel_03,	
		hosp_categoria_hotel_03,	
		hosp_checkin_hotel_03,		
		hosp_hr_ckeckin_hotel_03,	
		hosp_checkout_hotel_03,	
		hosp_hr_ckeckout_hotel_03,		
		hosp_acomodacao_titulo_03,
		hosp_categoria_titulo_03,	
		hosp_checkin_tiulo_03,
		hosp_checkout_titulo_03,		
		hosp_fantasia_hotel_04,		
		hosp_logradouro_hotel_04,			
		hosp_numero_hotel_04,			
		hosp_complemento_hotel_04,		
		hosp_municipio_hotel_04,		
		hosp_uf_hotel_04,				
		hosp_cep_hotel_04,			
		hosp_pais_hotel_04,		
		hosp_acomodacao_hotel_04,	
		hosp_categoria_hotel_04,		
		hosp_checkin_hotel_04,		
		hosp_hr_ckeckin_hotel_04,	
		hosp_checkout_hotel_04,	
		hosp_hr_ckeckout_hotel_04,		
		hosp_acomodacao_titulo_04,
		hosp_categoria_titulo_04,	
		hosp_checkin_tiulo_04,
		hosp_checkout_titulo_04,
		transfer_titulo,		
		transfer_in_observacoes,		
		transfer_out_observacoes,
		observacoes_finais_titulo,
		acompanhantes_titulo,
		acompanhante_011,
		acompanhante_021,
		participante_acomp_011,
		participante_acomp_021,
		participante_acomp_012,
		opcionais_titulo,	
		opcional_01,
		opcional_02,
		opcional_03,
		opcional_04,
		simples_mensagem,
		hosp_observacoes,
		status,
		observacao_final,
		acompanhante_031,
		acompanhante_041,
		participante_acomp_031,
		participante_acomp_041,
		acompanhante_012,
		acompanhante_022,
		acompanhante_032,
		acompanhante_042,
		participante_acomp_022,
		participante_acomp_032,
		participante_acomp_042,
		acompanhante_013,						
		acompanhante_023,						
		acompanhante_033,						
		acompanhante_043,						
		participante_acomp_013,						
		participante_acomp_023,						
		participante_acomp_033,						
		participante_acomp_043,						
		acompanhante_044,
		acompanhante_014,
		acompanhante_024,
		acompanhante_034,
		participante_acomp_014,
		participante_acomp_024,
		participante_acomp_034,	
		participante_acomp_044)
	VALUES
		(".$this->Db->qstr($w_criado_em).", 				 
		".$this->Db->qstr($w_cod_evento).",               
		".$this->Db->qstr($w_nome_evento).",         
		".$this->Db->qstr($w_cod_usuario).",                       
		".$this->Db->qstr($w_nome_usuario).",               
		".$this->Db->qstr($w_cod_participante).",         
		".$this->Db->qstr($w_nome_participante).",             
		".$this->Db->qstr($w_tipo_pessoa_dsc).",                   
		".$this->Db->qstr($w_email_remetente).",               
		".$this->Db->qstr($w_email_smtp).",               
		".$this->Db->qstr($w_email_usuario).",              
		".$this->Db->qstr($w_email_senha).",              
		".$this->Db->qstr($w_email_destinatario).",            
		".$this->Db->qstr($w_email_mensagem).",           
		".$this->Db->qstr($w_email_assunto).",           
		".$this->Db->qstr($w_email_comcopia).",  
		".$this->Db->qstr($w_participante_obs).", 
		".$this->Db->qstr($w_voo_titulo).", 
		".$this->Db->qstr($w_voo_origem_ida_01).",                  
		".$this->Db->qstr($w_voo_saida_origem_ida_01).", 
		".$this->Db->qstr($w_voo_destino_ida_01).", 						
		".$this->Db->qstr($w_voo_chega_destino_ida_01).", 
		".$this->Db->qstr($w_voo_cia_ida_01).",		
		".$this->Db->qstr($w_voo_numvoo_ida_01).", 
		".$this->Db->qstr($w_voo_localizador_ida_01).", 		
		".$this->Db->qstr($w_voo_etkt_ida_01).", 
		".$this->Db->qstr($w_voo_comprado_bvt_ida_01).", 		
		".$this->Db->qstr($w_voo_assento_ida_01).",		
		".$this->Db->qstr($w_voo_conexao_ida_01).",
		".$this->Db->qstr($w_voo_origem_titulo_ida_01).", 
		".$this->Db->qstr($w_voo_saida_titulo_ida_01).",		
		".$this->Db->qstr($w_voo_destino_tiulo_ida_01).",	 
		".$this->Db->qstr($w_voo_chegada_titulo_ida_01).", 
		".$this->Db->qstr($w_voo_cia_titulo_ida_01).",	
		".$this->Db->qstr($w_voo_titulo_ida_01).", 				
		".$this->Db->qstr($w_voo_localizador_titulo_ida_01).",	 
		".$this->Db->qstr($w_voo_etkt_titulo_ida_01).", 
		".$this->Db->qstr($w_voo_com_bvt_titulo_ida_01).",	
		".$this->Db->qstr($w_voo_titulo_logo_ida_01).", 				
		".$this->Db->qstr($w_voo_origem_ida_02).",			
		".$this->Db->qstr($w_voo_saida_origem_ida_02).",	
		".$this->Db->qstr($w_voo_destino_ida_02).",		
		".$this->Db->qstr($w_voo_chega_destino_ida_02).",	
		".$this->Db->qstr($w_voo_cia_ida_02).",		
		".$this->Db->qstr($w_voo_numvoo_ida_02).",			
		".$this->Db->qstr($w_voo_localizador_ida_02).",		 
		".$this->Db->qstr($w_voo_etkt_ida_02).",		
		".$this->Db->qstr($w_voo_comprado_bvt_ida_02).",		
		".$this->Db->qstr($w_voo_assento_ida_02).",		
		".$this->Db->qstr($w_voo_conexao_ida_02).",
		".$this->Db->qstr($w_voo_origem_titulo_ida_02).",		
		".$this->Db->qstr($w_voo_saida_titulo_ida_02).",	
		".$this->Db->qstr($w_voo_destino_tiulo_ida_02).",		 
		".$this->Db->qstr($w_voo_chegada_titulo_ida_02).",		
		".$this->Db->qstr($w_voo_cia_titulo_ida_02).",		
		".$this->Db->qstr($w_voo_titulo_ida_02).",		
		".$this->Db->qstr($w_voo_localizador_titulo_ida_02).",		
		".$this->Db->qstr($w_voo_etkt_titulo_ida_02).",	
		".$this->Db->qstr($w_voo_com_bvt_titulo_ida_02).",
		".$this->Db->qstr($w_voo_titulo_logo_ida_02).",		
		".$this->Db->qstr($w_voo_origem_ida_03).",
		".$this->Db->qstr($w_voo_saida_origem_ida_03).",		
		".$this->Db->qstr($w_voo_destino_ida_03).",	
		".$this->Db->qstr($w_voo_chega_destino_ida_03).",		 
		".$this->Db->qstr($w_voo_cia_ida_03).",		
		".$this->Db->qstr($w_voo_numvoo_ida_03).",		
		".$this->Db->qstr($w_voo_localizador_ida_03).",		
		".$this->Db->qstr($w_voo_etkt_ida_03).",		
		".$this->Db->qstr($w_voo_comprado_bvt_ida_03).",	
		".$this->Db->qstr($w_voo_assento_ida_03).",	
		".$this->Db->qstr($w_voo_conexao_ida_03).",
		".$this->Db->qstr($w_voo_origem_titulo_ida_03).",	
		".$this->Db->qstr($w_voo_saida_titulo_ida_03).",		 
		".$this->Db->qstr($w_voo_destino_tiulo_ida_03).",		
		".$this->Db->qstr($w_voo_chegada_titulo_ida_03).",		
		".$this->Db->qstr($w_voo_cia_titulo_ida_03).",		
		".$this->Db->qstr($w_voo_titulo_ida_03).",		
		".$this->Db->qstr($w_voo_localizador_titulo_ida_03).",	
		".$this->Db->qstr($w_voo_etkt_titulo_ida_03).",	
		".$this->Db->qstr($w_voo_com_bvt_titulo_ida_03).",		          
		".$this->Db->qstr($w_voo_titulo_logo_ida_03).",
		".$this->Db->qstr($w_voo_origem_ida_04).",	
		".$this->Db->qstr($w_voo_saida_origem_ida_04).",		 
		".$this->Db->qstr($w_voo_destino_ida_04).",		
		".$this->Db->qstr($w_voo_chega_destino_ida_04).",		
		".$this->Db->qstr($w_voo_cia_ida_04).",		
		".$this->Db->qstr($w_voo_numvoo_ida_04).",		
		".$this->Db->qstr($w_voo_localizador_ida_04).",	
		".$this->Db->qstr($w_voo_etkt_ida_04).",	
		".$this->Db->qstr($w_voo_comprado_bvt_ida_04).",		          
		".$this->Db->qstr($w_voo_assento_ida_04).",		          
		".$this->Db->qstr($w_voo_conexao_ida_04).",		          		
		".$this->Db->qstr($w_voo_origem_titulo_ida_04).",		 
		".$this->Db->qstr($w_voo_saida_titulo_ida_04).",		
		".$this->Db->qstr($w_voo_destino_tiulo_ida_04).",		
		".$this->Db->qstr($w_voo_chegada_titulo_ida_04).",		
		".$this->Db->qstr($w_voo_cia_titulo_ida_04).",		
		".$this->Db->qstr($w_voo_titulo_ida_04).",	
		".$this->Db->qstr($w_voo_localizador_titulo_ida_04).",	
		".$this->Db->qstr($w_voo_etkt_titulo_ida_04).",		          
		".$this->Db->qstr($w_voo_com_bvt_titulo_ida_04).",		          
		".$this->Db->qstr($w_voo_titulo_logo_ida_04).",		          				
		".$this->Db->qstr($w_voo_origem_volta_01).",	
		".$this->Db->qstr($w_voo_saida_origem_volta_01).",		 
		".$this->Db->qstr($w_voo_destino_volta_01).",		
		".$this->Db->qstr($w_voo_chega_destino_volta_01).",		
		".$this->Db->qstr($w_voo_cia_volta_01).",		
		".$this->Db->qstr($w_voo_numvoo_volta_01).",		
		".$this->Db->qstr($w_voo_localizador_volta_01).",	
		".$this->Db->qstr($w_voo_etkt_volta_01).",	
		".$this->Db->qstr($w_voo_comprado_bvt_volta_01).",		          
		".$this->Db->qstr($w_voo_assento_volta_01).",		          
		".$this->Db->qstr($w_voo_conexao_volta_01).",		
		".$this->Db->qstr($w_voo_origem_titulo_volta_01).",		 
		".$this->Db->qstr($w_voo_saida_titulo_volta_01).",		
		".$this->Db->qstr($w_voo_destino_tiulo_volta_01).",		
		".$this->Db->qstr($w_voo_chegada_titulo_volta_01).",		
		".$this->Db->qstr($w_voo_cia_titulo_volta_01).",		
		".$this->Db->qstr($w_voo_titulo_volta_01).",	
		".$this->Db->qstr($w_voo_localizador_titulo_volta_01).",	
		".$this->Db->qstr($w_voo_etkt_titulo_volta_01).",		          
		".$this->Db->qstr($w_voo_com_bvt_titulo_volta_01).",		          
		".$this->Db->qstr($w_voo_titulo_logo_volta_01).",			
		".$this->Db->qstr($w_voo_origem_volta_02).",		          
		".$this->Db->qstr($w_voo_saida_origem_volta_02).",		          				
		".$this->Db->qstr($w_voo_destino_volta_02).",	
		".$this->Db->qstr($w_voo_chega_destino_volta_02).",		 
		".$this->Db->qstr($w_voo_cia_volta_02).",		
		".$this->Db->qstr($w_voo_numvoo_volta_02).",		
		".$this->Db->qstr($w_voo_localizador_volta_02).",		
		".$this->Db->qstr($w_voo_etkt_volta_02).",		
		".$this->Db->qstr($w_voo_comprado_bvt_volta_02).",	
		".$this->Db->qstr($w_voo_assento_volta_02).",	
		".$this->Db->qstr($w_voo_conexao_volta_02).",		          
		".$this->Db->qstr($w_voo_origem_titulo_volta_02).",		          
		".$this->Db->qstr($w_voo_saida_titulo_volta_02).",			
		".$this->Db->qstr($w_voo_destino_tiulo_volta_02).",		 
		".$this->Db->qstr($w_voo_chegada_titulo_volta_02).",		
		".$this->Db->qstr($w_voo_cia_titulo_volta_02).",		
		".$this->Db->qstr($w_voo_titulo_volta_02).",		
		".$this->Db->qstr($w_voo_localizador_titulo_volta_02).",		
		".$this->Db->qstr($w_voo_etkt_titulo_volta_02).",	
		".$this->Db->qstr($w_voo_com_bvt_titulo_volta_02).",	
		".$this->Db->qstr($w_voo_titulo_logo_volta_02).",		          		
		".$this->Db->qstr($w_voo_origem_volta_03).",		          
		".$this->Db->qstr($w_voo_saida_origem_volta_03).",		          				
		".$this->Db->qstr($w_voo_destino_volta_03).",	
		".$this->Db->qstr($w_voo_chega_destino_volta_03).",		 
		".$this->Db->qstr($w_voo_cia_volta_03).",		
		".$this->Db->qstr($w_voo_numvoo_volta_03).",		
		".$this->Db->qstr($w_voo_localizador_volta_03).",		
		".$this->Db->qstr($w_voo_etkt_volta_03).",		
		".$this->Db->qstr($w_voo_comprado_bvt_volta_03).",	
		".$this->Db->qstr($w_voo_assento_volta_03).",	
		".$this->Db->qstr($w_voo_conexao_volta_03).",		          
		".$this->Db->qstr($w_voo_origem_titulo_volta_03).",		          
		".$this->Db->qstr($w_voo_saida_titulo_volta_03).",			
		".$this->Db->qstr($w_voo_destino_tiulo_volta_03).",		 
		".$this->Db->qstr($w_voo_chegada_titulo_volta_03).",		
		".$this->Db->qstr($w_voo_cia_titulo_volta_03).",		
		".$this->Db->qstr($w_voo_titulo_volta_03).",		
		".$this->Db->qstr($w_voo_localizador_titulo_volta_03).",		
		".$this->Db->qstr($w_voo_etkt_titulo_volta_03).",	
		".$this->Db->qstr($w_voo_com_bvt_titulo_volta_03).",	
		".$this->Db->qstr($w_voo_titulo_logo_volta_03).",		          		
		".$this->Db->qstr($w_voo_origem_volta_04).",		          
		".$this->Db->qstr($w_voo_saida_origem_volta_04).",		          				
		".$this->Db->qstr($w_voo_destino_volta_04).",	
		".$this->Db->qstr($w_voo_chega_destino_volta_04).",		 
		".$this->Db->qstr($w_voo_cia_volta_04).",		
		".$this->Db->qstr($w_voo_numvoo_volta_04).",		
		".$this->Db->qstr($w_voo_localizador_volta_04).",		
		".$this->Db->qstr($w_voo_etkt_volta_04).",		
		".$this->Db->qstr($w_voo_comprado_bvt_volta_04).",	
		".$this->Db->qstr($w_voo_assento_volta_04).",	
		".$this->Db->qstr($w_voo_conexao_volta_04).",		          
		".$this->Db->qstr($w_voo_origem_titulo_volta_04).",		          
		".$this->Db->qstr($w_voo_saida_titulo_volta_04).",			
		".$this->Db->qstr($w_voo_destino_tiulo_volta_04).",		 
		".$this->Db->qstr($w_voo_chegada_titulo_volta_04).",		
		".$this->Db->qstr($w_voo_cia_titulo_volta_04).",		
		".$this->Db->qstr($w_voo_titulo_volta_04).",		
		".$this->Db->qstr($w_voo_localizador_titulo_volta_04).",		
		".$this->Db->qstr($w_voo_etkt_titulo_volta_04).",	
		".$this->Db->qstr($w_voo_com_bvt_titulo_volta_04).",	
		".$this->Db->qstr($w_voo_titulo_logo_volta_04).",		          		
		".$this->Db->qstr($w_voo_observacoes_ida ).",	
		".$this->Db->qstr($w_voo_observacoes_volta ).",		          
		".$this->Db->qstr($w_hosp_titulo).",		          		
		".$this->Db->qstr($w_hosp_fantasia_hotel_01).",		          					
		".$this->Db->qstr($w_hosp_logradouro_hotel_01).",		          				
		".$this->Db->qstr($w_hosp_numero_hotel_01).",		          				
		".$this->Db->qstr($w_hosp_complemento_hotel_01).",		          						
		".$this->Db->qstr($w_hosp_municipio_hotel_01).",		          				
		".$this->Db->qstr($w_hosp_uf_hotel_01).",		          				
		".$this->Db->qstr($w_hosp_cep_hotel_01).",		          				
		".$this->Db->qstr($w_hosp_pais_hotel_01).",		          				
		".$this->Db->qstr($w_hosp_acomodacao_hotel_01).",		          			
		".$this->Db->qstr($w_hosp_categoria_hotel_01).",		          					
		".$this->Db->qstr($w_hosp_checkin_hotel_01).",		          		
		".$this->Db->qstr($w_hosp_hr_ckeckin_hotel_01).",		          						
		".$this->Db->qstr($w_hosp_checkout_hotel_01).",		          						
		".$this->Db->qstr($w_hosp_hr_ckeckout_hotel_01).",		          				
		".$this->Db->qstr($w_hosp_acomodacao_titulo_01).",		          				
		".$this->Db->qstr($w_hosp_categoria_titulo_01).",		          				
		".$this->Db->qstr($w_hosp_checkin_tiulo_01).",		          				
		".$this->Db->qstr($w_hosp_checkout_titulo_01).",		          				
		".$this->Db->qstr($w_hosp_fantasia_hotel_02).",		          					
		".$this->Db->qstr($w_hosp_logradouro_hotel_02).",
		".$this->Db->qstr($w_hosp_numero_hotel_02).",
		".$this->Db->qstr($w_hosp_complemento_hotel_02).",		          							
		".$this->Db->qstr($w_hosp_municipio_hotel_02).",		          					
		".$this->Db->qstr($w_hosp_uf_hotel_02).",
		".$this->Db->qstr($w_hosp_cep_hotel_02).",		          				
		".$this->Db->qstr($w_hosp_pais_hotel_02).",		          				
		".$this->Db->qstr($w_hosp_acomodacao_hotel_02).",		          						
		".$this->Db->qstr($w_hosp_categoria_hotel_02).",		          						
		".$this->Db->qstr($w_hosp_checkin_hotel_02).",		          			
		".$this->Db->qstr($w_hosp_hr_ckeckin_hotel_02).",		          				
		".$this->Db->qstr($w_hosp_checkout_hotel_02).",		          						
		".$this->Db->qstr($w_hosp_hr_ckeckout_hotel_02).",				
		".$this->Db->qstr($w_hosp_acomodacao_titulo_02).",		          				
		".$this->Db->qstr($w_hosp_categoria_titulo_02).",		          					
		".$this->Db->qstr($w_hosp_checkin_tiulo_02).",		          					
		".$this->Db->qstr($w_hosp_checkout_titulo_02).",	
		".$this->Db->qstr($w_hosp_fantasia_hotel_03).",		          					
		".$this->Db->qstr($w_hosp_logradouro_hotel_03).",
		".$this->Db->qstr($w_hosp_numero_hotel_03).",
		".$this->Db->qstr($w_hosp_complemento_hotel_03).",		          							
		".$this->Db->qstr($w_hosp_municipio_hotel_03).",		          					
		".$this->Db->qstr($w_hosp_uf_hotel_03).",
		".$this->Db->qstr($w_hosp_cep_hotel_03).",		          				
		".$this->Db->qstr($w_hosp_pais_hotel_03).",		          				
		".$this->Db->qstr($w_hosp_acomodacao_hotel_03).",		          				
		".$this->Db->qstr($w_hosp_categoria_hotel_03).",		   					
		".$this->Db->qstr($w_hosp_checkin_hotel_03).",	       			
		".$this->Db->qstr($w_hosp_hr_ckeckin_hotel_03).",
		".$this->Db->qstr($w_hosp_checkout_hotel_03).",		          						
		".$this->Db->qstr($w_hosp_hr_ckeckout_hotel_03).",		
		".$this->Db->qstr($w_hosp_acomodacao_titulo_03).",		          				
		".$this->Db->qstr($w_hosp_categoria_titulo_03).",		          					
		".$this->Db->qstr($w_hosp_checkin_tiulo_03).",		          					
		".$this->Db->qstr($w_hosp_checkout_titulo_03).",		
		".$this->Db->qstr($w_hosp_fantasia_hotel_04).",		          					
		".$this->Db->qstr($w_hosp_logradouro_hotel_04).",
		".$this->Db->qstr($w_hosp_numero_hotel_04).",
		".$this->Db->qstr($w_hosp_complemento_hotel_04).",		          							
		".$this->Db->qstr($w_hosp_municipio_hotel_04).",		          					
		".$this->Db->qstr($w_hosp_uf_hotel_04).",
		".$this->Db->qstr($w_hosp_cep_hotel_04).",		          				
		".$this->Db->qstr($w_hosp_pais_hotel_04).",		          				
		".$this->Db->qstr($w_hosp_acomodacao_hotel_04).",		          				
		".$this->Db->qstr($w_hosp_categoria_hotel_04).",		          					
		".$this->Db->qstr($w_hosp_checkin_hotel_04).",	
		".$this->Db->qstr($w_hosp_hr_ckeckin_hotel_04).",
		".$this->Db->qstr($w_hosp_checkout_hotel_04).",		          						
		".$this->Db->qstr($w_hosp_hr_ckeckout_hotel_04).",		
		".$this->Db->qstr($w_hosp_acomodacao_titulo_04).",		          				
		".$this->Db->qstr($w_hosp_categoria_titulo_04).",		          					
		".$this->Db->qstr($w_hosp_checkin_tiulo_04).",		          						
		".$this->Db->qstr($w_hosp_checkout_titulo_04).",		
		".$this->Db->qstr($w_transfer_titulo).",		
		".$this->Db->qstr($w_transfer_in_observacoes).",		
		".$this->Db->qstr($w_transfer_out_observacoes).",		
		".$this->Db->qstr($w_observacoes_finais_titulo).",		
		".$this->Db->qstr($w_acompanhantes_titulo).",			
		".$this->Db->qstr($w_acompanhante_011).",			
		".$this->Db->qstr($w_acompanhante_021).",		
		".$this->Db->qstr($w_participante_acomp_011).",
		".$this->Db->qstr($w_participante_acomp_021).",	
		".$this->Db->qstr($w_participante_acomp_012).",			
		".$this->Db->qstr($w_opcionais_titulo).",	
		".$this->Db->qstr($w_opc_tipo_dsc_01).",	
		".$this->Db->qstr($w_opc_tipo_dsc_02).",	
		".$this->Db->qstr($w_opc_tipo_dsc_03).",
		".$this->Db->qstr($w_opc_tipo_dsc_04).",		
		".$this->Db->qstr($w_simples_mensagem).",
		".$this->Db->qstr($w_hosp_observacoes).",	
		".$this->Db->qstr($w_status_valor).",
		".$this->Db->qstr($w_rodape_observacoes).",						
		".$this->Db->qstr($w_acompanhante_031).",						
		".$this->Db->qstr($w_acompanhante_041).",						
		".$this->Db->qstr($w_participante_acomp_031).",						
		".$this->Db->qstr($w_participante_acomp_041).",						
		".$this->Db->qstr($w_acompanhante_012).",						
		".$this->Db->qstr($w_acompanhante_022).",						
		".$this->Db->qstr($w_acompanhante_032).",				
		".$this->Db->qstr($w_acompanhante_042).",				
		".$this->Db->qstr($w_participante_acomp_022).",						
		".$this->Db->qstr($w_participante_acomp_032).",						
		".$this->Db->qstr($w_participante_acomp_042).",						
		".$this->Db->qstr($w_acompanhante_013).",						
		".$this->Db->qstr($w_acompanhante_023).",						
		".$this->Db->qstr($w_acompanhante_033).",						
		".$this->Db->qstr($w_acompanhante_043).",						
		".$this->Db->qstr($w_participante_acomp_013).",						
		".$this->Db->qstr($w_participante_acomp_023).",						
		".$this->Db->qstr($w_participante_acomp_033).",						
		".$this->Db->qstr($w_participante_acomp_043).",						
		".$this->Db->qstr($w_acompanhante_044).",						
		".$this->Db->qstr($w_acompanhante_014).",						
		".$this->Db->qstr($w_acompanhante_024).",								
		".$this->Db->qstr($w_acompanhante_034).",								
		".$this->Db->qstr($w_participante_acomp_014).",
		".$this->Db->qstr($w_participante_acomp_024).",
		".$this->Db->qstr($w_participante_acomp_034).",				
		".$this->Db->qstr($w_participante_acomp_044).")								
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
                control_cv_new_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      
	if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
	
	
	$sqlupd2="
	UPDATE 
		confirmacao_viagem_rsvp 
	SET 
		logo_cliente =  '".$w_logo_clienteup."'	
	WHERE 
		cod_evento = '".$w_cod_evento."'
	AND
		cod_participante = '".$w_cod_participante."'				
	";		
	
     $nm_select = $sqlupd2; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                control_cv_new_pack_ajax_response();
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
	if($w_status_valor <> 'ENVIADO') {
		$sqlupd1="
			UPDATE 
				confirmacao_viagem_rsvp 
			SET 
				email_remetente					= ".$this->Db->qstr($w_email_remetente).",                    			                          
				email_smtp                   	= ".$this->Db->qstr($w_email_smtp).",                         
				email_usuario		         	= ".$this->Db->qstr($w_email_usuario).",                      
				email_senha		             	= ".$this->Db->qstr($w_email_senha).",                        
				email_destinatario	         	= ".$this->Db->qstr($w_email_destinatario).",                 
				email_mensagem		         	= ".$this->Db->qstr($w_email_mensagem).",                     
				email_assunto		         	= ".$this->Db->qstr($w_email_assunto).",                      
				email_comcopia		         	= ".$this->Db->qstr($w_email_comcopia).",                     
				participante_obs             	= ".$this->Db->qstr($w_participante_obs).",                   
				voo_titulo                   	= ".$this->Db->qstr($w_voo_titulo).",                         
				voo_origem_ida_01            	= ".$this->Db->qstr($w_voo_origem_ida_01).",                  
				voo_saida_origem_ida_01      	= ".$this->Db->qstr($w_voo_saida_origem_ida_01).",            
				voo_destino_ida_01	         	= ".$this->Db->qstr($w_voo_destino_ida_01).", 					           
				voo_chega_destino_ida_01     	= ".$this->Db->qstr($w_voo_chega_destino_ida_01).",            
				voo_cia_ida_01		         	= ".$this->Db->qstr($w_voo_cia_ida_01).",		                   
				voo_numvoo_ida_01	         	= ".$this->Db->qstr($w_voo_numvoo_ida_01).",                  
				voo_localizador_ida_01		 	= ".$this->Db->qstr($w_voo_localizador_ida_01).", 		          
				voo_etkt_ida_01				 	= ".$this->Db->qstr($w_voo_etkt_ida_01).",                    
				voo_comprado_bvt_ida_01 		= ".$this->Db->qstr($w_voo_comprado_bvt_ida_01).", 		         
				voo_assento_ida_01           	= ".$this->Db->qstr($w_voo_assento_ida_01).",		               
				voo_conexao_ida_01           	= ".$this->Db->qstr($w_voo_conexao_ida_01).",                 
				voo_origem_titulo_ida_01     	= ".$this->Db->qstr($w_voo_origem_titulo_ida_01).",           
				voo_saida_titulo_ida_01      	= ".$this->Db->qstr($w_voo_saida_titulo_ida_01).",		          
				voo_destino_tiulo_ida_01     	= ".$this->Db->qstr($w_voo_destino_tiulo_ida_01).",	          
				voo_chegada_titulo_ida_01    	= ".$this->Db->qstr($w_voo_chegada_titulo_ida_01).",          
				voo_cia_titulo_ida_01        	= ".$this->Db->qstr($w_voo_cia_titulo_ida_01).",	             
				voo_titulo_ida_01        	 	= ".$this->Db->qstr($w_voo_titulo_ida_01).", 				             
				voo_localizador_titulo_ida_01	= ".$this->Db->qstr($w_voo_localizador_titulo_ida_01).",	     
				voo_etkt_titulo_ida_01          = ".$this->Db->qstr($w_voo_etkt_titulo_ida_01).",             
				voo_com_bvt_titulo_ida_01       = ".$this->Db->qstr($w_voo_com_bvt_titulo_ida_01).",	         
				voo_titulo_logo_ida_01	 		= ".$this->Db->qstr($w_voo_titulo_logo_ida_01).", 				        
				voo_origem_ida_02		        = ".$this->Db->qstr($w_voo_origem_ida_02).",			               
				voo_saida_origem_ida_02         = ".$this->Db->qstr($w_voo_saida_origem_ida_02).",	           
				voo_destino_ida_02              = ".$this->Db->qstr($w_voo_destino_ida_02).",		               
				voo_chega_destino_ida_02        = ".$this->Db->qstr($w_voo_chega_destino_ida_02).",	          
				voo_cia_ida_02                  = ".$this->Db->qstr($w_voo_cia_ida_02).",		                   
				voo_numvoo_ida_02               = ".$this->Db->qstr($w_voo_numvoo_ida_02).",			               
				voo_localizador_ida_02          = ".$this->Db->qstr($w_voo_localizador_ida_02).",		           
				voo_etkt_ida_02                 = ".$this->Db->qstr($w_voo_etkt_ida_02).",		                  
				voo_comprado_bvt_ida_02         = ".$this->Db->qstr($w_voo_comprado_bvt_ida_02).",		          
				voo_assento_ida_02              = ".$this->Db->qstr($w_voo_assento_ida_02).",		               
				voo_conexao_ida_02     	        = ".$this->Db->qstr($w_voo_conexao_ida_02).",                 
				voo_origem_titulo_ida_02        = ".$this->Db->qstr($w_voo_origem_titulo_ida_02).",		         
				voo_saida_titulo_ida_02         = ".$this->Db->qstr($w_voo_saida_titulo_ida_02).",	           
				voo_destino_tiulo_ida_02        = ".$this->Db->qstr($w_voo_destino_tiulo_ida_02).",		         
				voo_chegada_titulo_ida_02       = ".$this->Db->qstr($w_voo_chegada_titulo_ida_02).",		        
				voo_cia_titulo_ida_02           = ".$this->Db->qstr($w_voo_cia_titulo_ida_02).",		            
				voo_titulo_ida_02               = ".$this->Db->qstr($w_voo_titulo_ida_02).",		                
				voo_localizador_titulo_ida_02   = ".$this->Db->qstr($w_voo_localizador_titulo_ida_02).",		    
				voo_etkt_titulo_ida_02          = ".$this->Db->qstr($w_voo_etkt_titulo_ida_02).",	            
				voo_com_bvt_titulo_ida_02       = ".$this->Db->qstr($w_voo_com_bvt_titulo_ida_02).",          
				voo_titulo_logo_ida_02          = ".$this->Db->qstr($w_voo_titulo_logo_ida_02).",		           
				voo_origem_ida_03               = ".$this->Db->qstr($w_voo_origem_ida_03).",                  
				voo_saida_origem_ida_03         = ".$this->Db->qstr($w_voo_saida_origem_ida_03).",		          
				voo_destino_ida_03              = ".$this->Db->qstr($w_voo_destino_ida_03).",	                
				voo_chega_destino_ida_03		= ".$this->Db->qstr($w_voo_chega_destino_ida_03).",		         
				voo_cia_ida_03                  = ".$this->Db->qstr($w_voo_cia_ida_03).",		                   
				voo_numvoo_ida_03               = ".$this->Db->qstr($w_voo_numvoo_ida_03).",		                
				voo_localizador_ida_03          = ".$this->Db->qstr($w_voo_localizador_ida_03).",		           
				voo_etkt_ida_03                 = ".$this->Db->qstr($w_voo_etkt_ida_03).",		                  
				voo_comprado_bvt_ida_03         = ".$this->Db->qstr($w_voo_comprado_bvt_ida_03).",	           
				voo_assento_ida_03              = ".$this->Db->qstr($w_voo_assento_ida_03).",	                
				voo_conexao_ida_03              = ".$this->Db->qstr($w_voo_conexao_ida_03).",                 
				voo_origem_titulo_ida_03        = ".$this->Db->qstr($w_voo_origem_titulo_ida_03).",	          
				voo_saida_titulo_ida_03         = ".$this->Db->qstr($w_voo_saida_titulo_ida_03).",		          
				voo_destino_tiulo_ida_03        = ".$this->Db->qstr($w_voo_destino_tiulo_ida_03).",		         
				voo_chegada_titulo_ida_03       = ".$this->Db->qstr($w_voo_chegada_titulo_ida_03).",		        
				voo_cia_titulo_ida_03           = ".$this->Db->qstr($w_voo_cia_titulo_ida_03).",		            
				voo_titulo_ida_03               = ".$this->Db->qstr($w_voo_titulo_ida_03).",		                
				voo_localizador_titulo_ida_03   = ".$this->Db->qstr($w_voo_localizador_titulo_ida_03).",	     
				voo_etkt_titulo_ida_03          = ".$this->Db->qstr($w_voo_etkt_titulo_ida_03).",	            
				voo_com_bvt_titulo_ida_03       = ".$this->Db->qstr($w_voo_com_bvt_titulo_ida_03).",		        
				voo_titulo_logo_ida_03	        = ".$this->Db->qstr($w_voo_titulo_logo_ida_03).",             
				voo_origem_ida_04               = ".$this->Db->qstr($w_voo_origem_ida_04).",	                 
				voo_saida_origem_ida_04         = ".$this->Db->qstr($w_voo_saida_origem_ida_04).",		          
				voo_destino_ida_04              = ".$this->Db->qstr($w_voo_destino_ida_04).",		               
				voo_chega_destino_ida_04        = ".$this->Db->qstr($w_voo_chega_destino_ida_04).",		         
				voo_cia_ida_04                  = ".$this->Db->qstr($w_voo_cia_ida_04).",		                   
				voo_numvoo_ida_04               = ".$this->Db->qstr($w_voo_numvoo_ida_04).",		                
				voo_localizador_ida_04          = ".$this->Db->qstr($w_voo_localizador_ida_04).",	            
				voo_etkt_ida_04                 = ".$this->Db->qstr($w_voo_etkt_ida_04).",	                   
				voo_comprado_bvt_ida_04         = ".$this->Db->qstr($w_voo_comprado_bvt_ida_04).",		          
				voo_assento_ida_04              = ".$this->Db->qstr($w_voo_assento_ida_04).",		               
				voo_conexao_ida_04     		    = ".$this->Db->qstr($w_voo_conexao_ida_04).",		          	    
				voo_origem_titulo_ida_04        = ".$this->Db->qstr($w_voo_origem_titulo_ida_04).",		         
				voo_saida_titulo_ida_04         = ".$this->Db->qstr($w_voo_saida_titulo_ida_04).",		          
				voo_destino_tiulo_ida_04        = ".$this->Db->qstr($w_voo_destino_tiulo_ida_04).",		         
				voo_chegada_titulo_ida_04       = ".$this->Db->qstr($w_voo_chegada_titulo_ida_04).",		        
				voo_cia_titulo_ida_04           = ".$this->Db->qstr($w_voo_cia_titulo_ida_04).",		            
				voo_titulo_ida_04               = ".$this->Db->qstr($w_voo_titulo_ida_04).",	                 
				voo_localizador_titulo_ida_04	= ".$this->Db->qstr($w_voo_localizador_titulo_ida_04).",	     
				voo_etkt_titulo_ida_04          = ".$this->Db->qstr($w_voo_etkt_titulo_ida_04).",		           
				voo_com_bvt_titulo_ida_04       = ".$this->Db->qstr($w_voo_com_bvt_titulo_ida_04).",		        
				voo_titulo_logo_ida_04	        = ".$this->Db->qstr($w_voo_titulo_logo_ida_04).",		           
				voo_origem_volta_01             = ".$this->Db->qstr($w_voo_origem_volta_01).",	               
				voo_saida_origem_volta_01       = ".$this->Db->qstr($w_voo_saida_origem_volta_01).",		        
				voo_destino_volta_01            = ".$this->Db->qstr($w_voo_destino_volta_01).",		             
				voo_chega_destino_volta_01      = ".$this->Db->qstr($w_voo_chega_destino_volta_01).",		       
				voo_cia_volta_01                = ".$this->Db->qstr($w_voo_cia_volta_01).",		                 
				voo_numvoo_volta_01             = ".$this->Db->qstr($w_voo_numvoo_volta_01).",		              
				voo_localizador_volta_01        = ".$this->Db->qstr($w_voo_localizador_volta_01).",	          
				voo_etkt_volta_01               = ".$this->Db->qstr($w_voo_etkt_volta_01).",	                 
				voo_comprado_bvt_volta_01       = ".$this->Db->qstr($w_voo_comprado_bvt_volta_01).",		        
				voo_assento_volta_01            = ".$this->Db->qstr($w_voo_assento_volta_01).",		             
				voo_conexao_volta_01 	        = ".$this->Db->qstr($w_voo_conexao_volta_01).",		             
				voo_origem_titulo_volta_01      = ".$this->Db->qstr($w_voo_origem_titulo_volta_01).",		       
				voo_saida_titulo_volta_01       = ".$this->Db->qstr($w_voo_saida_titulo_volta_01).",		        
				voo_destino_tiulo_volta_01      = ".$this->Db->qstr($w_voo_destino_tiulo_volta_01).",		       
				voo_chegada_titulo_volta_01     = ".$this->Db->qstr($w_voo_chegada_titulo_volta_01).",		      
				voo_cia_titulo_volta_01         = ".$this->Db->qstr($w_voo_cia_titulo_volta_01).",		          
				voo_titulo_volta_01             = ".$this->Db->qstr($w_voo_titulo_volta_01).",	               
				voo_localizador_titulo_volta_01	= ".$this->Db->qstr($w_voo_localizador_titulo_volta_01).",	   
				voo_etkt_titulo_volta_01        = ".$this->Db->qstr($w_voo_etkt_titulo_volta_01).",		         
				voo_com_bvt_titulo_volta_01     = ".$this->Db->qstr($w_voo_com_bvt_titulo_volta_01).",		      
				voo_titulo_logo_volta_01   		= ".$this->Db->qstr($w_voo_titulo_logo_volta_01).",			        
				voo_origem_volta_02            	= ".$this->Db->qstr($w_voo_origem_volta_02).",		              
				voo_saida_origem_volta_02      	= ".$this->Db->qstr($w_voo_saida_origem_volta_02).",		        
				voo_destino_volta_02           	= ".$this->Db->qstr($w_voo_destino_volta_02).",	              
				voo_chega_destino_volta_02     	= ".$this->Db->qstr($w_voo_chega_destino_volta_02).",		       
				voo_cia_volta_02               	= ".$this->Db->qstr($w_voo_cia_volta_02).",		                 
				voo_numvoo_volta_02            	= ".$this->Db->qstr($w_voo_numvoo_volta_02).",		              
				voo_localizador_volta_02       	= ".$this->Db->qstr($w_voo_localizador_volta_02).",		         
				voo_etkt_volta_02              	= ".$this->Db->qstr($w_voo_etkt_volta_02).",		                
				voo_comprado_bvt_volta_02      	= ".$this->Db->qstr($w_voo_comprado_bvt_volta_02).",	         
				voo_assento_volta_02           	= ".$this->Db->qstr($w_voo_assento_volta_02).",	              
				voo_conexao_volta_02           	= ".$this->Db->qstr($w_voo_conexao_volta_02).",		             
				voo_origem_titulo_volta_02     	= ".$this->Db->qstr($w_voo_origem_titulo_volta_02).",		       
				voo_saida_titulo_volta_02      	= ".$this->Db->qstr($w_voo_saida_titulo_volta_02).",			       
				voo_destino_tiulo_volta_02     	= ".$this->Db->qstr($w_voo_destino_tiulo_volta_02).",		       
				voo_chegada_titulo_volta_02    	= ".$this->Db->qstr($w_voo_chegada_titulo_volta_02).",		      
				voo_cia_titulo_volta_02        	= ".$this->Db->qstr($w_voo_cia_titulo_volta_02).",		          
				voo_titulo_volta_02            	= ".$this->Db->qstr($w_voo_titulo_volta_02).",		              
				voo_localizador_titulo_volta_02	= ".$this->Db->qstr($w_voo_localizador_titulo_volta_02).",		  
				voo_etkt_titulo_volta_02       	= ".$this->Db->qstr($w_voo_etkt_titulo_volta_02).",	          
				voo_com_bvt_titulo_volta_02    	= ".$this->Db->qstr($w_voo_com_bvt_titulo_volta_02).",	       
				voo_titulo_logo_volta_02		= ".$this->Db->qstr($w_voo_titulo_logo_volta_02).",		         
				voo_origem_volta_03            	= ".$this->Db->qstr($w_voo_origem_volta_03).",		              
				voo_saida_origem_volta_03      	= ".$this->Db->qstr($w_voo_saida_origem_volta_03).",		        
				voo_destino_volta_03           	= ".$this->Db->qstr($w_voo_destino_volta_03).",	              
				voo_chega_destino_volta_03     	= ".$this->Db->qstr($w_voo_chega_destino_volta_03).",		       
				voo_cia_volta_03               	= ".$this->Db->qstr($w_voo_cia_volta_03).",		                 
				voo_numvoo_volta_03            	= ".$this->Db->qstr($w_voo_numvoo_volta_03).",		              
				voo_localizador_volta_03       	= ".$this->Db->qstr($w_voo_localizador_volta_03).",		         
				voo_etkt_volta_03              	= ".$this->Db->qstr($w_voo_etkt_volta_03).",		                
				voo_comprado_bvt_volta_03      	= ".$this->Db->qstr($w_voo_comprado_bvt_volta_03).",	         
				voo_assento_volta_03           	= ".$this->Db->qstr($w_voo_assento_volta_03).",	              
				voo_conexao_volta_03           	= ".$this->Db->qstr($w_voo_conexao_volta_03).",		             
				voo_origem_titulo_volta_03     	= ".$this->Db->qstr($w_voo_origem_titulo_volta_03).",		       
				voo_saida_titulo_volta_03      	= ".$this->Db->qstr($w_voo_saida_titulo_volta_03).",			       
				voo_destino_tiulo_volta_03    	= ".$this->Db->qstr($w_voo_destino_tiulo_volta_03).",		       
				voo_chegada_titulo_volta_03    	= ".$this->Db->qstr($w_voo_chegada_titulo_volta_03).",		      
				voo_cia_titulo_volta_03        	= ".$this->Db->qstr($w_voo_cia_titulo_volta_03).",		          
				voo_titulo_volta_03            	= ".$this->Db->qstr($w_voo_titulo_volta_03).",		              
				voo_localizador_titulo_volta_03	= ".$this->Db->qstr($w_voo_localizador_titulo_volta_03).",		  
				voo_etkt_titulo_volta_03       	= ".$this->Db->qstr($w_voo_etkt_titulo_volta_03).",	          
				voo_com_bvt_titulo_volta_03    	= ".$this->Db->qstr($w_voo_com_bvt_titulo_volta_03).",	       
				voo_titulo_logo_volta_03		= ".$this->Db->qstr($w_voo_titulo_logo_volta_03).",		         
				voo_origem_volta_04            	= ".$this->Db->qstr($w_voo_origem_volta_04).",		              
				voo_saida_origem_volta_04      	= ".$this->Db->qstr($w_voo_saida_origem_volta_04).",		        
				voo_destino_volta_04           	= ".$this->Db->qstr($w_voo_destino_volta_04).",	              
				voo_chega_destino_volta_04     	= ".$this->Db->qstr($w_voo_chega_destino_volta_04).",		       
				voo_cia_volta_04               	= ".$this->Db->qstr($w_voo_cia_volta_04).",		                 
				voo_numvoo_volta_04            	= ".$this->Db->qstr($w_voo_numvoo_volta_04).",		              
				voo_localizador_volta_04       	= ".$this->Db->qstr($w_voo_localizador_volta_04).",		         
				voo_etkt_volta_04              	= ".$this->Db->qstr($w_voo_etkt_volta_04).",		                
				voo_comprado_bvt_volta_04      	= ".$this->Db->qstr($w_voo_comprado_bvt_volta_04).",	         
				voo_assento_volta_04           	= ".$this->Db->qstr($w_voo_assento_volta_04).",	              
				voo_conexao_volta_04           	= ".$this->Db->qstr($w_voo_conexao_volta_04).",		             
				voo_origem_titulo_volta_04     	= ".$this->Db->qstr($w_voo_origem_titulo_volta_04).",		       
				voo_saida_titulo_volta_04      	= ".$this->Db->qstr($w_voo_saida_titulo_volta_04).",			       
				voo_destino_tiulo_volta_04    	= ".$this->Db->qstr($w_voo_destino_tiulo_volta_04).",		       
				voo_chegada_titulo_volta_04    	= ".$this->Db->qstr($w_voo_chegada_titulo_volta_04).",		      
				voo_cia_titulo_volta_04        	= ".$this->Db->qstr($w_voo_cia_titulo_volta_04).",		          
				voo_titulo_volta_04            	= ".$this->Db->qstr($w_voo_titulo_volta_04).",		              
				voo_localizador_titulo_volta_04	= ".$this->Db->qstr($w_voo_localizador_titulo_volta_04).",		  
				voo_etkt_titulo_volta_04       	= ".$this->Db->qstr($w_voo_etkt_titulo_volta_04).",	          
				voo_com_bvt_titulo_volta_04    	= ".$this->Db->qstr($w_voo_com_bvt_titulo_volta_04).",	       
				voo_titulo_logo_volta_04	    = ".$this->Db->qstr($w_voo_titulo_logo_volta_04).",		         
				voo_observacoes_ida             = ".$this->Db->qstr($w_voo_observacoes_ida ).",	              
				voo_observacoes_volta		    = ".$this->Db->qstr($w_voo_observacoes_volta ).",		           
				hosp_titulo		                = ".$this->Db->qstr($w_hosp_titulo).",		          		          
				hosp_fantasia_hotel_01		    = ".$this->Db->qstr($w_hosp_fantasia_hotel_01).",		           
				hosp_logradouro_hotel_01		= ".$this->Db->qstr($w_hosp_logradouro_hotel_01).",		         
				hosp_numero_hotel_01			= ".$this->Db->qstr($w_hosp_numero_hotel_01).",		             
				hosp_complemento_hotel_01	    = ".$this->Db->qstr($w_hosp_complemento_hotel_01).",		        
				hosp_municipio_hotel_01		    = ".$this->Db->qstr($w_hosp_municipio_hotel_01).",		          
				hosp_uf_hotel_01				= ".$this->Db->qstr($w_hosp_uf_hotel_01).",		          	      
				hosp_cep_hotel_01			    = ".$this->Db->qstr($w_hosp_cep_hotel_01).",		          	     
				hosp_pais_hotel_01		        = ".$this->Db->qstr($w_hosp_pais_hotel_01).",		          	    
				hosp_acomodacao_hotel_01	    = ".$this->Db->qstr($w_hosp_acomodacao_hotel_01).",		         
				hosp_categoria_hotel_01	        = ".$this->Db->qstr($w_hosp_categoria_hotel_01).",		          
				hosp_checkin_hotel_01	        = ".$this->Db->qstr($w_hosp_checkin_hotel_01).",		            
				hosp_hr_ckeckin_hotel_01	    = ".$this->Db->qstr($w_hosp_hr_ckeckin_hotel_01).",		         
				hosp_checkout_hotel_01	        = ".$this->Db->qstr($w_hosp_checkout_hotel_01).",		           
				hosp_hr_ckeckout_hotel_01       = ".$this->Db->qstr($w_hosp_hr_ckeckout_hotel_01).",		        
				hosp_acomodacao_titulo_01       = ".$this->Db->qstr($w_hosp_acomodacao_titulo_01).",		        
				hosp_categoria_titulo_01	    = ".$this->Db->qstr($w_hosp_categoria_titulo_01).",		         
				hosp_checkin_tiulo_01	        = ".$this->Db->qstr($w_hosp_checkin_tiulo_01).",		            
				hosp_checkout_titulo_01			= ".$this->Db->qstr($w_hosp_checkout_titulo_01).",		          
				hosp_fantasia_hotel_02		    = ".$this->Db->qstr($w_hosp_fantasia_hotel_02).",		           
				hosp_logradouro_hotel_02		= ".$this->Db->qstr($w_hosp_logradouro_hotel_02).",           
				hosp_numero_hotel_02			= ".$this->Db->qstr($w_hosp_numero_hotel_02).",               
				hosp_complemento_hotel_02		= ".$this->Db->qstr($w_hosp_complemento_hotel_02).",		        
				hosp_municipio_hotel_02		    = ".$this->Db->qstr($w_hosp_municipio_hotel_02).",		          
				hosp_uf_hotel_02				= ".$this->Db->qstr($w_hosp_uf_hotel_02).",                   
				hosp_cep_hotel_02			    = ".$this->Db->qstr($w_hosp_cep_hotel_02).",		          	     
				hosp_pais_hotel_02		        = ".$this->Db->qstr($w_hosp_pais_hotel_02).",		          	    
				hosp_acomodacao_hotel_02	    = ".$this->Db->qstr($w_hosp_acomodacao_hotel_02).",		         
				hosp_categoria_hotel_02	        = ".$this->Db->qstr($w_hosp_categoria_hotel_02).",					
				hosp_checkin_tiulo_02	        = ".$this->Db->qstr($w_hosp_checkin_tiulo_02).",		            
				hosp_hr_ckeckin_hotel_02	    = ".$this->Db->qstr($w_hosp_hr_ckeckin_hotel_02).",	            
				hosp_checkout_hotel_02	        = ".$this->Db->qstr($w_hosp_checkout_hotel_02).",		           
				hosp_hr_ckeckout_hotel_02       = ".$this->Db->qstr($w_hosp_hr_ckeckout_hotel_02).",		        
				hosp_acomodacao_titulo_02       = ".$this->Db->qstr($w_hosp_acomodacao_titulo_02).",		        
				hosp_categoria_titulo_02	    = ".$this->Db->qstr($w_hosp_categoria_titulo_02).",		         
				hosp_checkin_tiulo_02           = ".$this->Db->qstr($w_hosp_checkin_tiulo_02).",		            
				hosp_checkout_titulo_02	        = ".$this->Db->qstr($w_hosp_checkout_titulo_02).",	           
				hosp_fantasia_hotel_03		    = ".$this->Db->qstr($w_hosp_fantasia_hotel_03).",		           
				hosp_logradouro_hotel_03		= ".$this->Db->qstr($w_hosp_logradouro_hotel_03).",           
				hosp_numero_hotel_03			= ".$this->Db->qstr($w_hosp_numero_hotel_03).",               
				hosp_complemento_hotel_03		= ".$this->Db->qstr($w_hosp_complemento_hotel_03).",		        
				hosp_municipio_hotel_03		    = ".$this->Db->qstr($w_hosp_municipio_hotel_03).",		          
				hosp_uf_hotel_03				= ".$this->Db->qstr($w_hosp_uf_hotel_03).",                   
				hosp_cep_hotel_03			    = ".$this->Db->qstr($w_hosp_cep_hotel_03).",		          	     
				hosp_pais_hotel_03		        = ".$this->Db->qstr($w_hosp_pais_hotel_03).",		          	    
				hosp_acomodacao_hotel_03	    = ".$this->Db->qstr($w_hosp_acomodacao_hotel_03).",		         
				hosp_categoria_hotel_03	        = ".$this->Db->qstr($w_hosp_categoria_hotel_03).",		          
				hosp_hr_ckeckin_hotel_03	    = ".$this->Db->qstr($w_hosp_checkin_hotel_03).",		            
				hosp_checkout_hotel_03	        = ".$this->Db->qstr($w_hosp_checkout_hotel_03).",		           
				hosp_hr_ckeckout_hotel_03       = ".$this->Db->qstr($w_hosp_hr_ckeckout_hotel_03).",		        
				hosp_acomodacao_titulo_03       = ".$this->Db->qstr($w_hosp_acomodacao_titulo_03).",		        
				hosp_categoria_titulo_03	    = ".$this->Db->qstr($w_hosp_categoria_titulo_03).",		         
				hosp_checkin_tiulo_03           = ".$this->Db->qstr($w_hosp_checkin_tiulo_03).",		            
				hosp_checkout_titulo_03		    = ".$this->Db->qstr($w_hosp_checkout_titulo_03).",		          
				hosp_fantasia_hotel_04		    = ".$this->Db->qstr($w_hosp_fantasia_hotel_04).",		           
				hosp_logradouro_hotel_04		= ".$this->Db->qstr($w_hosp_logradouro_hotel_04).",           
				hosp_numero_hotel_04			= ".$this->Db->qstr($w_hosp_numero_hotel_04).",               
				hosp_complemento_hotel_04		= ".$this->Db->qstr($w_hosp_complemento_hotel_04).",		        
				hosp_municipio_hotel_04		    = ".$this->Db->qstr($w_hosp_municipio_hotel_04).",		          
				hosp_uf_hotel_04				= ".$this->Db->qstr($w_hosp_uf_hotel_04).",                   
				hosp_cep_hotel_04			    = ".$this->Db->qstr($w_hosp_cep_hotel_04).",		          	     
				hosp_pais_hotel_04		        = ".$this->Db->qstr($w_hosp_pais_hotel_04).",		          	    
				hosp_acomodacao_hotel_04	    = ".$this->Db->qstr($w_hosp_acomodacao_hotel_04).",		         
				hosp_categoria_hotel_04	        = ".$this->Db->qstr($w_hosp_categoria_hotel_04).",		          
				hosp_hr_ckeckin_hotel_04	    = ".$this->Db->qstr($w_hosp_checkin_hotel_04).",		            
				hosp_checkout_hotel_04	        = ".$this->Db->qstr($w_hosp_checkout_hotel_04).",		           
				hosp_hr_ckeckout_hotel_04       = ".$this->Db->qstr($w_hosp_hr_ckeckout_hotel_04).",		        
				hosp_acomodacao_titulo_04       = ".$this->Db->qstr($w_hosp_acomodacao_titulo_04).",		        
				hosp_categoria_titulo_04	    = ".$this->Db->qstr($w_hosp_categoria_titulo_04).",		         
				hosp_checkin_tiulo_04           = ".$this->Db->qstr($w_hosp_checkin_tiulo_04).",		            
				hosp_checkout_titulo_04         = ".$this->Db->qstr($w_hosp_checkout_titulo_04).",		          
				transfer_titulo		            = ".$this->Db->qstr($w_transfer_titulo).",		                  
				transfer_in_observacoes		    = ".$this->Db->qstr($w_transfer_in_observacoes).",		          
				transfer_out_observacoes        = ".$this->Db->qstr($w_transfer_out_observacoes).",		         
				observacoes_finais_titulo       = ".$this->Db->qstr($w_observacoes_finais_titulo).",		        
				acompanhantes_titulo            = ".$this->Db->qstr($w_acompanhantes_titulo).",			            
				acompanhante_011                = ".$this->Db->qstr($w_acompanhante_011).",			                
				acompanhante_021                = ".$this->Db->qstr($w_acompanhante_021).",		                 			
				acompanhante_031                = ".$this->Db->qstr($w_acompanhante_031).",						
				acompanhante_041                = ".$this->Db->qstr($w_acompanhante_041).",						
				participante_acomp_011          = ".$this->Db->qstr($w_participante_acomp_011).",             
				participante_acomp_021          = ".$this->Db->qstr($w_participante_acomp_021).",	   
				participante_acomp_031          = ".$this->Db->qstr($w_participante_acomp_031).",	   
				participante_acomp_041          = ".$this->Db->qstr($w_participante_acomp_041).",	   
				participante_acomp_012          = ".$this->Db->qstr($w_participante_acomp_012).",	   			
				acompanhante_012 				= ".$this->Db->qstr($w_acompanhante_012).",						
				acompanhante_022 				= ".$this->Db->qstr($w_acompanhante_022).",						
				acompanhante_032 				= ".$this->Db->qstr($w_acompanhante_032).",
				acompanhante_042 				= ".$this->Db->qstr($w_acompanhante_042).",				
				participante_acomp_012 			= ".$this->Db->qstr($w_participante_acomp_012).",
				participante_acomp_022 			= ".$this->Db->qstr($w_participante_acomp_022).",
				participante_acomp_032 			= ".$this->Db->qstr($w_participante_acomp_032).",
				participante_acomp_042 			= ".$this->Db->qstr($w_participante_acomp_042).",
				acompanhante_013 				= ".$this->Db->qstr($w_acompanhante_013).",
				acompanhante_023 				= ".$this->Db->qstr($w_acompanhante_023).",
				acompanhante_033 				= ".$this->Db->qstr($w_acompanhante_033).",
				acompanhante_043 				= ".$this->Db->qstr($w_acompanhante_043).",
				acompanhante_044				= ".$this->Db->qstr($w_acompanhante_044).",						
				acompanhante_014				= ".$this->Db->qstr($w_acompanhante_014).",						
				acompanhante_024				= ".$this->Db->qstr($w_acompanhante_024).",								
				acompanhante_034				= ".$this->Db->qstr($w_acompanhante_034).",								
				participante_acomp_013 			= ".$this->Db->qstr($w_participante_acomp_013).",	
				participante_acomp_023 			= ".$this->Db->qstr($w_participante_acomp_023).",
				participante_acomp_033 			= ".$this->Db->qstr($w_participante_acomp_033).",						
				participante_acomp_043 			= ".$this->Db->qstr($w_participante_acomp_043).",					
				participante_acomp_014 			= ".$this->Db->qstr($w_participante_acomp_014).",
				participante_acomp_024 			= ".$this->Db->qstr($w_participante_acomp_024).",
				participante_acomp_034 			= ".$this->Db->qstr($w_participante_acomp_034).",								
				participante_acomp_044 			= ".$this->Db->qstr($w_participante_acomp_044).",				
				opcionais_titulo	            = ".$this->Db->qstr($w_opcionais_titulo).",	                  
				opcional_01                     = ".$this->Db->qstr($w_opc_tipo_dsc_01).",	                   
				opcional_02                     = ".$this->Db->qstr($w_opc_tipo_dsc_02).",	                   
				opcional_03                     = ".$this->Db->qstr($w_opc_tipo_dsc_03).",                    
				opcional_04                     = ".$this->Db->qstr($w_opc_tipo_dsc_04).",		                  
				simples_mensagem                = ".$this->Db->qstr($w_simples_mensagem).",                   
				hosp_observacoes                = ".$this->Db->qstr($w_hosp_observacoes).",	                  
				status                          = ".$this->Db->qstr($w_status_valor).", 
				observacao_final		        = ".$this->Db->qstr($w_rodape_observacoes)."				              
			WHERE 
				cod_participante = ".$this->Db->qstr($w_cod_participante)."
			AND 
				cod_evento = ".$this->Db->qstr($w_cod_evento)."
		";		
		
     $nm_select = $sqlupd1; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                control_cv_new_pack_ajax_response();
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
}
if (isset($this->sc_temp_vg_tipo_pessoa)) { $_SESSION['vg_tipo_pessoa'] = $this->sc_temp_vg_tipo_pessoa;}
if (isset($this->sc_temp_vg_evento_id)) { $_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_cpf)) { $_SESSION['vg_cpf'] = $this->sc_temp_vg_cpf;}
if (isset($this->sc_temp_vg_usuario_id)) { $_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_vg_confirm_viagem)) { $_SESSION['vg_confirm_viagem'] = $this->sc_temp_vg_confirm_viagem;}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (isset($Ctrl_Proc_Onload) && $Ctrl_Proc_Onload) {
        $Ctrl_Format = true;
        $this->nm_guardar_campos();
        if ($bFormat) $this->nm_formatar_campos();
    }
    if (($original_e_mail_cc != $this->e_mail_cc || (isset($bFlagRead_e_mail_cc) && $bFlagRead_e_mail_cc)))
    {
        $this->ajax_return_values_e_mail_cc(true);
    }
    if (($original_email_part != $this->email_part || (isset($bFlagRead_email_part) && $bFlagRead_email_part)))
    {
        $this->ajax_return_values_email_part(true);
    }
    if (($original_envia_email != $this->envia_email || (isset($bFlagRead_envia_email) && $bFlagRead_envia_email)))
    {
        $this->ajax_return_values_envia_email(true);
    }
}
$_SESSION['scriptcase']['control_cv_new']['contr_erro'] = 'off'; 
    }
    if (!empty($this->Campos_Mens_erro)) 
    {
        $this->Erro->mensagem(__FILE__, __LINE__, "critica", $this->Campos_Mens_erro); 
    }
    $this->nm_guardar_campos();
    $this->nm_formatar_campos();
        $this->initFormPages();
    include_once("control_cv_new_form0.php");
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['table_refresh'])
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['csrf_token'];
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

   function Form_lookup_envia_email()
   {
       $nmgp_def_dados  = "";
       $nmgp_def_dados .= "Enviar?#?Y?#??@?";
       $todo = explode("?@?", $nmgp_def_dados);
       return $todo;

   }
   function Form_lookup_e_mail_cc()
   {
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['Lookup_e_mail_cc']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['Lookup_e_mail_cc'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['Lookup_e_mail_cc']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['Lookup_e_mail_cc'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['Lookup_e_mail_cc']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['Lookup_e_mail_cc'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['Lookup_e_mail_cc']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['Lookup_e_mail_cc'] = array(); 
    }
   $envia_email_val_str = "''";
   if (!empty($this->envia_email))
   {
       if (is_array($this->envia_email))
       {
           $Tmp_array = $this->envia_email;
       }
       else
       {
           $Tmp_array = explode(";", $this->envia_email);
       }
       $envia_email_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $envia_email_val_str)
          {
             $envia_email_val_str .= ", ";
          }
          $envia_email_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $nm_comando = "SELECT usuario_email  FROM usuarios_rsvp  ORDER BY usuario_email";
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['Lookup_e_mail_cc'][] = $rs->fields[0];
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
       $nmgp_saida_form = "control_cv_new_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['nm_run_menu'] = 2;
       $nmgp_saida_form = "control_cv_new_fim.php";
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
       control_cv_new_pack_ajax_response();
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['masterValue']);
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
               $tmp_parms .= $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new'][substr($val, 1, -1)];
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
       $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['opcao'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['opc_ant'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['retorno_edit'] = "";
   }
   $nm_target_form = (empty($nm_target)) ? "_self" : $nm_target;
   if (strtolower(substr($nm_apl_dest, -4)) != ".php" && (strtolower(substr($nm_apl_dest, 0, 7)) == "http://" || strtolower(substr($nm_apl_dest, 0, 8)) == "https://" || strtolower(substr($nm_apl_dest, 0, 3)) == "../"))
   {
       if ($this->NM_ajax_flag)
       {
           $this->NM_ajax_info['redir']['metodo'] = 'location';
           $this->NM_ajax_info['redir']['action'] = $nm_apl_dest;
           $this->NM_ajax_info['redir']['target'] = $nm_target_form;
           control_cv_new_pack_ajax_response();
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
       control_cv_new_pack_ajax_response();
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
            case "cfview":
                return array("sc_cfview_bot");
                break;
            case "help":
                return array("sc_b_hlp_b");
                break;
            case "exit":
                return array("Bsair_b.sc-unique-btn-1", "Bsair_b.sc-unique-btn-2");
                break;
        }

        return array($buttonName);
    } // getButtonIds

    function displayAppHeader()
    {
        if ($this->Embutida_call) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['link_info']['compact_mode']) {
            return;
        }
?>
    <tr><td class="sc-app-header">
<style>
    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}
</style>
<div class="scFormHeader" style="height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;">
    <div class="scFormHeaderFont" style="float: left; text-transform: uppercase;"><?php if ($this->nmgp_opcao == "novo") { echo ""; } else { echo "BRSVP - Confirmação de Viagem"; } ?></div>
    <div class="scFormHeaderFont" style="float: right;"></div>
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['control_cv_new']['ordem_ord'] == " desc") {
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
