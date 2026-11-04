<?php
//
class control_mailling_apl
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
   var $arquivo;
   var $arquivo_scfile_name;
   var $arquivo_ul_name;
   var $arquivo_ul_type;
   var $arquivo_limpa;
   var $arquivo_salva;
   var $usuario_id;
   var $evento_id;
   var $nomesist;
   var $retorno;
   var $cpfsist;
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
   var $Upload_refresh_fields = array();
//
//----- 
   function ini_controle()
   {
        global $nm_url_saida, $teste_validade, $script_case_init, 
            $glo_senha_protect, $bok, $nm_apl_dependente, $nm_form_submit, $nm_opc_form_php, $nm_call_php, $nm_opc_lookup, $nmgp_redir;


      if ($this->NM_ajax_flag)
      {
          if (isset($this->NM_ajax_info['param']['arquivo']))
          {
              $this->arquivo = $this->NM_ajax_info['param']['arquivo'];
          }
          if (isset($this->NM_ajax_info['param']['arquivo_limpa']))
          {
              $this->arquivo_limpa = $this->NM_ajax_info['param']['arquivo_limpa'];
          }
          if (isset($this->NM_ajax_info['param']['arquivo_salva']))
          {
              $this->arquivo_salva = $this->NM_ajax_info['param']['arquivo_salva'];
          }
          if (isset($this->NM_ajax_info['param']['arquivo_ul_name']))
          {
              $this->arquivo_ul_name = $this->NM_ajax_info['param']['arquivo_ul_name'];
          }
          if (isset($this->NM_ajax_info['param']['arquivo_ul_type']))
          {
              $this->arquivo_ul_type = $this->NM_ajax_info['param']['arquivo_ul_type'];
          }
          if (isset($this->NM_ajax_info['param']['cpfsist']))
          {
              $this->cpfsist = $this->NM_ajax_info['param']['cpfsist'];
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
          $_SESSION['sc_session'][$script_case_init]['control_mailling']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['control_mailling']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['control_mailling']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['control_mailling']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['control_mailling']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['control_mailling']['embutida_parms']);
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
                 nm_limpa_str_control_mailling($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
             }
             $ix++;
          }
          if (isset($this->inside_nested_grid) && 'Y' == $this->inside_nested_grid) {
              $_SESSION['sc_session'][$script_case_init]['control_mailling']['inside_nested_iframe'] = true;
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
          if (isset($this->NM_where_filter_form))
          {
              $_SESSION['sc_session'][$script_case_init]['control_mailling']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['control_mailling']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['control_mailling']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['control_mailling']['sc_redir_insert'] = $this->sc_redir_insert;
              unset($_SESSION['sc_session'][$script_case_init]['control_mailling']['opc_ant']);
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
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['control_mailling']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['control_mailling']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['control_mailling']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['control_mailling']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['control_mailling']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['control_mailling']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['control_mailling']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['control_mailling']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['control_mailling']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['control_mailling']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new control_mailling_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("pt_br");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['initialize'];
          $this->Db = $this->Ini->Db; 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['initialize']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['initialize'])
          {
              $_SESSION['scriptcase']['control_mailling']['contr_erro'] = 'on';
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
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Acesso Negado!(01)";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_control_mailling';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_control_mailling';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Acesso Negado!(01)";
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
        $this->NM_ajax_info['redirExit']['action'] = "control_mailling_fim.php?script_case_init=" . $this->form_encode_input($this->Ini->sc_page);
        $this->NM_ajax_info['redirExit']['metodo'] = 'location';
        $this->NM_ajax_info['redirExit']['target'] = "_self";
        $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $this->Ini->path_link . "" . SC_dir_app_name('WWW-Authenticate: <type> realm=<realm>') . "/";
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['sc_outra_jan'])
        {
            $_SESSION['scriptcase']['sc_outra_jan'] = "control_mailling";
            $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['sc_outra_jan'] = false;
        }
        $_SESSION['scriptcase']['control_mailling']['contr_erro'] = 'off';
        control_mailling_pack_ajax_response();
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
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "control_mailling";
     $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['sc_outra_jan'] = false;
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
        action="control_mailling_fim.php"
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
if (isset($this->sc_temp_rsvp_global)) { $_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
$_SESSION['scriptcase']['control_mailling']['contr_erro'] = 'off';
          }
          $this->Ini->init2();
      } 
      else 
      { 
         $this->nm_data = new nm_data("pt_br");
      } 
      $_SESSION['sc_session'][$script_case_init]['control_mailling']['upload_field_info'] = array();

      $_SESSION['sc_session'][$script_case_init]['control_mailling']['upload_field_info']['arquivo'] = array(
          'app_dir'            => $this->Ini->path_aplicacao,
          'app_name'           => 'control_mailling',
          'upload_dir'         => $this->Ini->root . $this->Ini->path_imag_temp . '/',
          'upload_url'         => $this->Ini->path_imag_temp . '/',
          'upload_type'        => 'single',
          'upload_allowed_type'  => '/\.(xlsx)$/i',
          'upload_max_size'  => null,
          'upload_ext_size_rules' => json_decode('{"xlsx":"1gb"}', true),
          'upload_file_height' => '',
          'upload_file_width'  => '',
          'upload_file_aspect' => '',
          'upload_file_type'   => 'N0',
      );

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['control_mailling']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['control_mailling'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['control_mailling']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['control_mailling']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('control_mailling') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['control_mailling']['label'] = "BRSVP - Subir Mailing";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "control_mailling")
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


      $this->arr_buttons['listagem']['hint']             = "Verificar  Participantes Incluídos";
      $this->arr_buttons['listagem']['type']             = "button";
      $this->arr_buttons['listagem']['value']            = "Listagem";
      $this->arr_buttons['listagem']['display']          = "text_fontawesomeicon";
      $this->arr_buttons['listagem']['display_position'] = "text_right";
      $this->arr_buttons['listagem']['style']            = "default";
      $this->arr_buttons['listagem']['image']            = "";
      $this->arr_buttons['listagem']['has_fa']            = "true";
      $this->arr_buttons['listagem']['fontawesomeicon']            = "";


      $_SESSION['scriptcase']['error_icon']['control_mailling']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['control_mailling'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->Ini->cor_grid_par = $this->Ini->cor_grid_impar;
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      if (isset($this->NM_ajax_info['param']['arquivo_ul_name']) && '' != $this->NM_ajax_info['param']['arquivo_ul_name'])
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['upload_field_ul_name'][$this->arquivo_ul_name]))
          {
              $this->NM_ajax_info['param']['arquivo_ul_name'] = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['upload_field_ul_name'][$this->arquivo_ul_name];
          }
          $this->arquivo = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->NM_ajax_info['param']['arquivo_ul_name'];
          $this->arquivo_scfile_name = substr($this->NM_ajax_info['param']['arquivo_ul_name'], 12);
          $this->arquivo_scfile_type = $this->NM_ajax_info['param']['arquivo_ul_type'];
          $this->arquivo_ul_name = $this->NM_ajax_info['param']['arquivo_ul_name'];
          $this->arquivo_ul_type = $this->NM_ajax_info['param']['arquivo_ul_type'];
      }
      elseif (isset($this->arquivo_ul_name) && '' != $this->arquivo_ul_name)
      {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['upload_field_ul_name'][$this->arquivo_ul_name]))
          {
              $this->arquivo_ul_name = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['upload_field_ul_name'][$this->arquivo_ul_name];
          }
          $this->arquivo = $this->Ini->root . $this->Ini->path_imag_temp . '/' . $this->arquivo_ul_name;
          $this->arquivo_scfile_name = substr($this->arquivo_ul_name, 12);
          $this->arquivo_scfile_type = $this->arquivo_ul_type;
      }

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['goto']      = 'on';
          }
      }

      $this->nmgp_botoes['cancel'] = "on";
      $this->nmgp_botoes['exit'] = "on";
      $this->nmgp_botoes['ok'] = "on";
      $this->nmgp_botoes['facebook'] = "off";
      $this->nmgp_botoes['google'] = "off";
      $this->nmgp_botoes['twitter'] = "off";
      $this->nmgp_botoes['paypal'] = "off";
      $this->nmgp_botoes['Listagem'] = "on";
      if (isset($this->NM_btn_cancel) && 'N' == $this->NM_btn_cancel)
      {
          $this->nmgp_botoes['cancel'] = "off";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['where_orig'] = "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['where_pesq'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['control_mailling']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['control_mailling'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['control_mailling'];

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

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['dados_form']))
      {
          $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['dados_form'];
          if (!isset($this->usuario_id)){$this->usuario_id = $this->nmgp_dados_form['usuario_id'];} 
          if (!isset($this->evento_id)){$this->evento_id = $this->nmgp_dados_form['evento_id'];} 
          if (!isset($this->nomesist)){$this->nomesist = $this->nmgp_dados_form['nomesist'];} 
          if (!isset($this->retorno)){$this->retorno = $this->nmgp_dados_form['retorno'];} 
      }
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      $this->aba_iframe = false;
      if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
      {
          foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
          {
              if (in_array("control_mailling", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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

      if (is_file($this->Ini->path_aplicacao . 'control_mailling_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'control_mailling_help.txt');
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
          require_once($this->Ini->path_embutida . 'control_mailling/control_mailling_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "control_mailling_erro.class.php"); 
      }
      $this->Erro      = new control_mailling_erro();
      $this->Erro->Ini = $this->Ini;
      $this->proc_fast_search = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['control_mailling']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "novo")  
      {
          $this->nmgp_botoes['Listagem'] = "off";
      }
      elseif ($this->nmgp_opcao == "incluir")  
      {
          $this->nmgp_botoes['Listagem'] = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['botoes']['Listagem'];
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['final'];
      }
      else
      {
      }
      $this->nm_flag_iframe = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['dados_form'])) 
      {
         $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['dados_form'];
      }
      if ($this->nmgp_opcao == "edit_novo")  
      {
          $this->nmgp_opcao = "novo";
          $this->nm_flag_saida_novo = "S";
      }
//
      $this->NM_case_insensitive = false;
      $this->sc_evento = $this->nmgp_opcao;
      include_once $this->Ini->path_third . '/phpexcel/PHPExcel.php';
      include_once $this->Ini->path_third . '/phpexcel/PHPExcel/IOFactory.php';
      if (!isset($this->NM_ajax_flag) || ('validate_' != substr($this->NM_ajax_opcao, 0, 9) && 'add_new_line' != $this->NM_ajax_opcao && 'autocomp_' != substr($this->NM_ajax_opcao, 0, 9)))
      {
      $_SESSION['scriptcase']['control_mailling']['contr_erro'] = 'on';
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
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Acesso Negado! (02)";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_control_mailling';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_control_mailling';
  } else {
   $sErrorIndex = substr(substr($this->NM_ajax_opcao, 0, strrpos($this->NM_ajax_opcao, '_')), 6);
  }
  $this->NM_ajax_info['errList'][$sErrorIndex][] = "Acesso Negado! (02)";
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
        $this->NM_ajax_info['redirExit']['action'] = "control_mailling_fim.php?script_case_init=" . $this->form_encode_input($this->Ini->sc_page);
        $this->NM_ajax_info['redirExit']['metodo'] = 'location';
        $this->NM_ajax_info['redirExit']['target'] = "_self";
        $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $this->Ini->path_link . "" . SC_dir_app_name('WWW-Authenticate: <type> realm=<realm>') . "/";
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['sc_outra_jan'])
        {
            $_SESSION['scriptcase']['sc_outra_jan'] = "control_mailling";
            $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['sc_outra_jan'] = false;
        }
        $_SESSION['scriptcase']['control_mailling']['contr_erro'] = 'off';
        control_mailling_pack_ajax_response();
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
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "control_mailling";
     $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['sc_outra_jan'] = false;
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
        action="control_mailling_fim.php"
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



set_time_limit ( 7200 );
ini_set('max_execution_time', 10800); 


;
$pathProd  = $_SESSION['scriptcase']['control_mailling']['glo_nm_path_prod'];
$pathExcel = '/third/phpexcel/PHPExcel.php';
$path	   = $pathProd.$pathExcel;
	
$this->usuario_id  	= $this->sc_temp_vg_usuario_id;
$this->sc_temp_vg_evento_id 	= $this->sc_temp_parm1;
$this->evento_id 		= $this->sc_temp_vg_evento_id;
if (isset($this->sc_temp_vg_usuario_id)) { $_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_vg_menu_item)) { $_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
if (isset($this->sc_temp_parm1)) { $_SESSION['parm1'] = $this->sc_temp_parm1;}
if (isset($this->sc_temp_vg_evento_id)) { $_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_cpfseg)) { $_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
if (isset($this->sc_temp_rsvp_global)) { $_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
$_SESSION['scriptcase']['control_mailling']['contr_erro'] = 'off'; 
      }
            if ('ajax_check_file' == $this->nmgp_opcao ){
                 ob_start(); 
                 global $bol_api_prod; 
                 $bol_api_prod = true; 
                 if (isset($_SESSION['scriptcase']['control_mailling']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['control_mailling']['glo_nm_conexao'])) 
                 { 
                     $bol_api_prod = false;
                 } 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['control_mailling']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['control_mailling']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
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
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['opc_edit'] = true;  
     if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['dados_select'])) 
     {
        $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['dados_select'];
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
          if ('validate_arquivo' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'arquivo');
          }
          if ('validate_cpfsist' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'cpfsist');
          }
          control_mailling_pack_ajax_response();
          exit;
      }
      if (isset($this->sc_inline_call) && 'Y' == $this->sc_inline_call)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['inline_form_seq'] = $this->sc_seq_row;
          $this->nm_tira_formatacao();
      }
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "recarga_mobile" || $this->nmgp_opcao == "muda_form") 
      {
          $this->upload_img_doc($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          $this->nm_tira_formatacao();
          $nm_sc_sv_opcao = $this->nmgp_opcao; 
          $this->nmgp_opcao = "nada"; 
          if ($this->NM_ajax_flag)
          {
              $this->ajax_return_values();
              control_mailling_pack_ajax_response();
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
          $_SESSION['scriptcase']['control_mailling']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . ' ' . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  control_mailling_pack_ajax_response();
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
          $_SESSION['scriptcase']['control_mailling']['contr_erro'] = 'off';
          if ($Campos_Crit != "") 
          {
              $Campos_Crit = $this->Ini->Nm_lang['lang_errm_flds'] . $Campos_Crit ; 
          }
          if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
          {
              if ($this->NM_ajax_flag)
              {
                  control_mailling_pack_ajax_response();
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
          $this->arquivo = "" ;  
          $this->usuario_id = "" ;  
          $this->evento_id = "" ;  
          $this->nomesist = "" ;  
          $this->retorno = "" ;  
          $this->cpfsist = "" ;  
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['dados_form']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['dados_form']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['dados_form'] as $NM_campo => $NM_valor)
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['recarga'] = $this->nmgp_opcao;
      }
      if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "" || $campos_erro != "" || !isset($this->bok) || $this->bok != "OK" || $this->nmgp_opcao == "recarga")
      {
          if ($Campos_Crit == "" && empty($Campos_Falta) && $this->Campos_Mens_erro == "" && !isset($this->bok) && $this->nmgp_opcao != "recarga")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['campos']))
              { 
                  $arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['campos'][0]; 
                  $cpfsist = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['campos'][1]; 
              } 
          }
          $this->nm_gera_html();
          $this->NM_close_db(); 
      }
      elseif (isset($this->bok) && $this->bok == "OK")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['campos'] = array(); 
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['campos'][0] = $this->arquivo; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['campos'][1] = $this->cpfsist; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['redir'] == "redir")
          {
              $this->nmgp_redireciona(); 
          }
          else
          {
              $contr_menu = "";
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['iframe_menu'])
              {
                  $contr_menu = "glo_menu";
              }
              if (isset($_SESSION['scriptcase']['sc_ult_apl_menu']) && in_array("control_mailling", $_SESSION['scriptcase']['sc_ult_apl_menu']))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona_form("control_mailling_fim.php", $this->nm_location, $contr_menu); 
              }
              else
              {
                  $this->nm_gera_html();
                  if (!$_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['embutida_proc'])
                  { 
                      $this->NM_close_db(); 
                  } 
              }
          }
          $this->NM_close_db(); 
          if ($this->NM_ajax_flag)
          {
              control_mailling_pack_ajax_response();
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
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "control_mailling.zip";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("BRSVP - Subir Mailing") ?></TITLE>
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
<form name="Fdown" method="get" action="control_mailling_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="control_mailling"> 
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
           case 'arquivo':
               return "Arquivo";
               break;
           case 'cpfsist':
               return "CPFsist";
               break;
           case 'usuario_id':
               return "usuario_id";
               break;
           case 'evento_id':
               return "evento_id";
               break;
           case 'nomesist':
               return "nomeSist";
               break;
           case 'retorno':
               return "retorno";
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

     if (!is_array($filtro) && '' == $filtro && isset($this->nm_form_submit) && '1' == $this->nm_form_submit && isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['csrf_token']) && $this->scCsrfGetToken() != $this->csrf_token)
     {
          $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
          $this->Campos_Mens_erro .= "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          if ($this->NM_ajax_flag)
          {
              if (!isset($this->NM_ajax_info['errList']['geral_control_mailling']) || !is_array($this->NM_ajax_info['errList']['geral_control_mailling']))
              {
                  $this->NM_ajax_info['errList']['geral_control_mailling'] = array();
              }
              $this->NM_ajax_info['errList']['geral_control_mailling'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ((!is_array($filtro) && ('' == $filtro || 'arquivo' == $filtro)) || (is_array($filtro) && in_array('arquivo', $filtro)))
        $this->ValidateField_arquivo($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'cpfsist' == $filtro)) || (is_array($filtro) && in_array('cpfsist', $filtro)))
        $this->ValidateField_cpfsist($Campos_Crit, $Campos_Falta, $Campos_Erros);
      $this->upload_img_doc($Campos_Crit, $Campos_Falta, $Campos_Erros);

      if (empty($Campos_Crit) && empty($Campos_Falta))
      {
      if (!isset($this->NM_ajax_flag) || 'validate_' != substr($this->NM_ajax_opcao, 0, 9))
      {
      $_SESSION['scriptcase']['control_mailling']['contr_erro'] = 'on';
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    $original_arquivo = $this->arquivo;
}
  date_default_timezone_set('America/Sao_Paulo');

?>
<style>
	.loader {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;
		background: url('https://media3.giphy.com/media/v1.Y2lkPTc5MGI3NjExMWxybHh2dmt0djBsdjV6a3RzZ3B1MjZuZjRndDh2anF3c3g0aXR0cyZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/kUTME7ABmhYg5J3psM/giphy.gif') 50% 50% no-repeat white;
	}
</style>
<div id="loader" class="loader"></div>
<script>
	window.onload = function(){
		$(".loader").fadeOut("slow");
	};
</script>
<?php


$valor_y = 'Y';
$valor_nul = '';
$valor_dt = '0000-00-00';

$this->m_php_carga_Excel();

$dir_sc = $this->Ini->path_doc;
$_arquivo = $dir_sc."/".$this->arquivo ;

if (file_exists($_arquivo)){
	unlink($_arquivo);
}




$v_evento = $this->evento_id ;
$v_usuario = $this->usuario_id ;
$v_dsc_empresa = '';


$valor_vazio = '';
$sql="
SELECT
	idEvento
 	idUsuario
FROM
	inconsistmailling
WHERE   
	idEvento =  ".$this->Db->qstr($v_evento)."   
AND 
   	idUsuario = ".$this->Db->qstr($v_usuario)."  
ORDER BY 
	idEvento,idUsuario
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
	
$reg_inc = sizeof($this->rs);
if ($reg_inc > 0) {
	 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('grid_inconsistmailling') . "/", $this->nm_location, "", "_self", "ret_self", 440, 630);
 };		
} else {		
	$sqlmail = "
		SELECT
			cpf,
			nome,
			atualizar,
			tipo_doc
		FROM
			mailling_rsvp
		WHERE	
			atualizar = ".$this->Db->qstr($valor_y)." 
		AND
			id_evento = ".$this->Db->qstr($v_evento)." 
	";
	 
      $nm_select = $sqlmail; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsmail = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rsmail[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsmail = false;
          $this->rsmail_erro = $this->Db->ErrorMsg();
      } 
	
	$reg_mail = sizeof($this->rsmail );		
	if ($reg_mail > 0) {
		for ($i=0;$i<$reg_mail;++$i) {
			$v_cpf	= $this->rsmail[$i][0]; 
			$v_nome = $this->rsmail[$i][1]; 
			$v_tipo_doc = $this->rsmail[$i][3]; 
			$sqlcpf = "				
			SELECT
				pessoa_cpf,
				pessoa_nome
			FROM
				pessoas_rsvp
			WHERE
				pessoa_cpf = ".$this->Db->qstr($v_cpf)." 
			";
			 
      $nm_select = $sqlcpf; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rscpf = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rscpf[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rscpf = false;
          $this->rscpf_erro = $this->Db->ErrorMsg();
      } 
	
			$reg_cpf = sizeof($this->rscpf );
			if ($reg_cpf == 0) {
				$insert_sqlp = "				
				INSERT INTO 
					pessoas_rsvp 
					(pessoa_cpf,
					pessoa_nome,
					tipo_documento)
				VALUES 
					(".$this->Db->qstr($v_cpf).",	
					".$this->Db->qstr($v_nome).",
					".$this->Db->qstr($v_tipo_doc).")         
				";
				
     $nm_select = $insert_sqlp; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                control_mailling_pack_ajax_response();
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
		$sqlmail2 = "
		SELECT
			cpf,
			nome,
			atualizar
		FROM
			mailling_rsvp
		WHERE	
			atualizar = ".$this->Db->qstr($v_valor_y)." 
		AND
			id_evento = ".$this->Db->qstr($v_evento)." 
		";
		 
      $nm_select = $sqlmail2; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsmail2 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rsmail2[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsmail2 = false;
          $this->rsmail2_erro = $this->Db->ErrorMsg();
      } 
	
		$reg_mail2 = sizeof($this->rsmail2 );		
		if ($reg_mail2 > 0) {
			for ($i=0;$i<$reg_mail2;++$i) {
				$v_cpf	= $this->rsmail2[$i][0]; 
				$sqlcpf2 = "				
				SELECT
					pessoa_cpf,
					pessoa_nome
				FROM
					pessoas_rsvp
				WHERE
					pessoa_cpf = ".$this->Db->qstr($v_cpf)." 
				";
				 
      $nm_select = $sqlcpf2; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rscpf2 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rscpf2[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rscpf2 = false;
          $this->rscpf2_erro = $this->Db->ErrorMsg();
      } 
	
				$reg_cpf2 = sizeof($this->rscpf2 );
				if ($reg_cpf > 0) {
					$p_cpf	= $this->rscpf2[0][0]; 
					$p_nome = $this->rscpf2[0][1];						
					$update_sqlmail = "
					UPDATE 
               			mailling_rsvp
					SET
						nome = ".$this->Db->qstr($p_nome)."  
					WHERE
	        	       cpf =  ".$this->Db->qstr($p_cpf)."    
					";
					
     $nm_select = $update_sqlmail; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                control_mailling_pack_ajax_response();
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
		}
		
		$sqlmail3 = "
		SELECT
			id_evento,
			id_usuario,
			modificado_em,
			rg,
			cpf,
			data_nascimento,				
			nome,
			email,
			tipo,
			id_publico,
			id_regional,
			ddd_celular,
			celular,
			ddd_fixo,
			fone_fixo,
			empresa,
			grupo,
			clube,
			sexo,
			atualizar,
			tipo_doc,
			cod_empresa_evento,
			codigo_telefone_pais,
			papel,
			uid_pulseira_nfc,
			passaporte,
			emissao_passaporte,
			validade_passaporte,
			numero_visto,
			validade_visto,
			vacina_febre_amarela,
			estrangeiro,
			idioma_preferido,
			part_restricao_alimentar,
			restricao_mobilidade,
			part_cep,
			part_logradouro,
			part_numero,
			part_complemento,
			part_bairro,
			part_cidade,
			part_uf,
			pais,
			nacionalidade
		FROM
			mailling_rsvp
		WHERE	
			atualizar = ".$this->Db->qstr($valor_y)."   
		AND
			id_evento = ".$this->Db->qstr($v_evento)."  
		";
		 
      $nm_select = $sqlmail3; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsx = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rsx[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsx = false;
          $this->rsx_erro = $this->Db->ErrorMsg();
      } 
	
		$reg_mx = sizeof($this->rsx );
		if ($reg_mx > 0) {				
			for ($i=0;$i<$reg_mx;++$i) {				
				$v_id_evento			= $this->rsx[$i][0];
				$v_id_usuario			= $this->rsx[$i][1];
				$v_modificado_em 		= $this->rsx[$i][2];
				$v_rg					= $this->rsx[$i][3];
				$v_cpf					= $this->rsx[$i][4];
				$v_data_nascimento		= $this->rsx[$i][5];
				$v_nome					= $this->rsx[$i][6];
				$v_email				= $this->rsx[$i][7];
				$v_tipo					= $this->rsx[$i][8];
				$v_id_publico			= $this->rsx[$i][9];		
				$v_id_regional			= $this->rsx[$i][10];
				$v_ddd_celular 			= $this->rsx[$i][11];
				$v_celular 				= $this->rsx[$i][12];
				$v_ddd_fixo				= $this->rsx[$i][13];
				$v_fone_fixo			= $this->rsx[$i][14];
				$v_empresa				= $this->rsx[$i][15];
				$v_grupo 				= $this->rsx[$i][16];					
				$v_clube 				= $this->rsx[$i][17];
				$v_sexo					= $this->rsx[$i][18];
				$v_tipo_doc				= $this->rsx[$i][20];
				$v_cod_emp_evento		= $this->rsx[$i][21];				
				$v_cod_tel_pais 		= $this->rsx[$i][22];	
				$v_papel_status 		= $this->rsx[$i][23];
				$v_uid_pulseira_nfc 	= $this->rsx[$i][24];
				$v_passaporte			= $this->rsx[$i][25];
				$v_emissao_passaporte	= $this->rsx[$i][26];
				$v_validade_passaporte	= $this->rsx[$i][27];
				$v_numero_visto			= $this->rsx[$i][28];
				$v_validade_visto		= $this->rsx[$i][29];
				$v_vacina_febre_amarela = $this->rsx[$i][30];
				$v_estrangeiro			= $this->rsx[$i][31];
				$v_idioma_pref			= $this->rsx[$i][32];
				$v_rest_alimentar		= $this->rsx[$i][33];
				$v_rest_mobilidade		= $this->rsx[$i][34];
				$v_cep					= $this->rsx[$i][35];
				$v_logradouro			= $this->rsx[$i][36];
				$v_numero				= $this->rsx[$i][37];
				$v_complemento			= $this->rsx[$i][38];
				$v_bairro				= $this->rsx[$i][39];
				$v_cidade				= $this->rsx[$i][40];
				$v_estado				= $this->rsx[$i][41];
				$v_pais					= $this->rsx[$i][42];
				$v_nacionalidade		= $this->rsx[$i][43];
				
				if ($v_id_publico == '') {
					$v_id_publico = '0';	
				}
				if ($v_id_regional == '') {
					$v_id_regional = '0';
				}
				$sqlgeral = "
					SELECT
						part_cpf,			
						part_dt_nasc
					FROM	
						participantes_rsvp
					WHERE
						part_cpf = ".$this->Db->qstr($v_cpf)."   
					AND
						part_dt_nasc <> ".$this->Db->qstr($valor_dt)."  
					AND
						part_dt_nasc IS NOT NULL
					ORDER BY
						part_cpf
					LIMIT 1	
				";
					
				 
      $nm_select = $sqlgeral; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsgeral = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rsgeral[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsgeral = false;
          $this->rsgeral_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($this->rsgeral[0][0])) {									
					$v_data_nascimento = $this->rsgeral[0][1];				
				} else {
				}	
				
				
				
				if($v_ddd_celular == '') {
					$sqlgeral2 = "
						SELECT
							part_cpf,			
							part_ddd_celular_01
						FROM	
							participantes_rsvp
						WHERE
							part_cpf = ".$this->Db->qstr($v_cpf)."     
						AND
							part_ddd_celular_01 <> ".$this->Db->qstr($valor_nul)."  
						ORDER BY
							part_cpf
						LIMIT 1		
					";
					 
      $nm_select = $sqlgeral2; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsgeral2 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rsgeral2[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsgeral2 = false;
          $this->rsgeral2_erro = $this->Db->ErrorMsg();
      } 
				
					if (isset($this->rsgeral2[0][0])) {									
						$v_ddd_celular = $this->rsgeral2[0][1];				
					} else {
					}	
				}
				
				if($v_celular == '') {
					$sqlgeral3 = "
						SELECT
							part_cpf,			
							part_celeular_01
						FROM	
							participantes_rsvp
						WHERE
							part_cpf = ".$this->Db->qstr($v_cpf)."    
						AND
							part_celeular_01 <> ".$this->Db->qstr($valor_nul)."  
						ORDER BY
							part_cpf
						LIMIT 1		
					";
					 
      $nm_select = $sqlgeral3; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsgeral3 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rsgeral3[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsgeral3 = false;
          $this->rsgeral3_erro = $this->Db->ErrorMsg();
      } 
				
					if (isset($this->rsgeral3[0][0])) {									
						$v_celular = $this->rsgeral3[0][1];				
					} else {
					}
				}
				
				$sqlgeral4 = "
					SELECT
						part_cpf,			
						part_rg
					FROM	
						participantes_rsvp
					WHERE
						part_cpf = ".$this->Db->qstr($v_cpf)."    
					AND
						part_rg <> ".$this->Db->qstr($valor_nul)."  
					ORDER BY
						part_cpf
					LIMIT 1		
				";
				 
      $nm_select = $sqlgeral4; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsgeral4 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rsgeral4[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsgeral4 = false;
          $this->rsgeral4_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($this->rsgeral4[0][0])) {									
					$v_rg = $this->rsgeral4[0][1];				
				} else {
				}					
				
				if($v_passaporte == '') {
					$sqlgeral5 = "
						SELECT
							part_cpf,			
							part_passaporte
						FROM	
							participantes_rsvp
						WHERE
							part_cpf = ".$this->Db->qstr($v_cpf)."    
						AND
							part_passaporte <> ".$this->Db->qstr($valor_nul)."  
						ORDER BY
							part_cpf
						LIMIT 1		
					";
					 
      $nm_select = $sqlgeral5; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsgeral5 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rsgeral5[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsgeral5 = false;
          $this->rsgeral5_erro = $this->Db->ErrorMsg();
      } 
				
					if (isset($this->rsgeral5[0][0])) {									
						$v_passaporte = $this->rsgeral5[0][1];				
					} else {
					}							
				}
								
				if ($v_cod_emp_evento <> '') {
					$sqlemp = "
						SELECT
							empresa_id,
							empresa_fantasia
						FROM
							empresas_rsvp
						WHERE
							empresa_id = ".$this->Db->qstr($v_cod_emp_evento)."
					";
					 
      $nm_select = $sqlemp; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsemp = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rsemp[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsemp = false;
          $this->rsemp_erro = $this->Db->ErrorMsg();
      } 
				
					if (isset($this->rsemp[0][0])) {									
						$v_dsc_empresa = $this->rsemp[0][1];				
					} else {
						$v_dsc_empresa = '';
					}	
				} 
				$reg_part = 0;
				$sqlpart = "
				SELECT
					part_id_evento,
					part_cpf						
				FROM
					participantes_rsvp
				WHERE	
					part_id_evento = ".$this->Db->qstr($v_id_evento)." 		
				AND
					part_cpf = ".$this->Db->qstr($v_cpf)." 
				";
				 
      $nm_select = $sqlpart; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspart = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rspart[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspart = false;
          $this->rspart_erro = $this->Db->ErrorMsg();
      } 
	
				$reg_part = sizeof($this->rspart );
				
				if ($reg_part == 0) {						
					$sqlipart = "					
					INSERT INTO
						participantes_rsvp  
						(part_id_evento,
						part_cod_usuario,
						part_dt_cadastro,
						part_rg,
						part_cpf,
						part_dt_nasc,
						nome_pessoa,
						part_email,
						part_tipo,
						part_id_evento_publico,
						part_id_evento_regional,
						part_ddd_celular_01,
						part_celeular_01,
						part_ddd_01,
						part_fone_01,
						part_empresa,
						part_grupo,
						part_cpf_substituto,
						part_sexo,
						part_clube,
						part_passaporte,
						cod_empresa_rsvp,
						dsc_empresa_rsvp,
						codigo_telefone_internacional,						
						roles_app,
						uid_pulseira_nfc,
						emissao_passaporte,
						part_validade_pass,
						numero_visto,
						validade_visto,
						part_vacina_fa,
						estrangeiro,
						idioma_preferido,
						part_restricao_alimentar,
						restricao_mobilidade,
						part_cep,
						part_logradouro,
						part_numero,
						part_complemento,
						part_bairro,
						part_cidade,
						part_uf,
						pais,
						part_nacionalidade)						
					VALUES						
						(".$this->Db->qstr($v_id_evento).",
						".$this->Db->qstr($v_id_usuario).",
						".$this->Db->qstr($v_modificado_em).",
						".$this->Db->qstr($v_rg).",
						".$this->Db->qstr($v_cpf).",
						".$this->Db->qstr($v_data_nascimento).",
						".$this->Db->qstr($v_nome).",
						".$this->Db->qstr($v_email).",
						".$this->Db->qstr($v_tipo).",
						".$this->Db->qstr($v_id_publico).",
						".$this->Db->qstr($v_id_regional).",
						".$this->Db->qstr($v_ddd_celular).",
						".$this->Db->qstr($v_celular).",
						".$this->Db->qstr($v_ddd_fixo).",
						".$this->Db->qstr($v_fone_fixo).",
						".$this->Db->qstr($v_empresa).",
						".$this->Db->qstr($v_grupo).",
						".$this->Db->qstr($v_cpf).",
						".$this->Db->qstr($v_sexo).",
						".$this->Db->qstr($v_clube).",
						".$this->Db->qstr($v_passaporte).",
						".$this->Db->qstr($v_cod_emp_evento).",
						".$this->Db->qstr($v_dsc_empresa).",						
						".$this->Db->qstr($v_cod_tel_pais).",
						".$this->Db->qstr($v_papel_status).",
						".$this->Db->qstr($v_uid_pulseira_nfc).",						
						".$this->Db->qstr($v_emissao_passaporte).",
						".$this->Db->qstr($v_validade_passaporte).",							
						".$this->Db->qstr($v_numero_visto).",
						".$this->Db->qstr($v_validade_visto).",
						".$this->Db->qstr($v_vacina_febre_amarela).",
						".$this->Db->qstr($v_estrangeiro).",
						".$this->Db->qstr($v_idioma_pref).",
						".$this->Db->qstr($v_rest_alimentar).",						
						".$this->Db->qstr($v_rest_mobilidade).",
						".$this->Db->qstr($v_cep).",						
						".$this->Db->qstr($v_logradouro).",
						".$this->Db->qstr($v_numero).",
						".$this->Db->qstr($v_complemento).",
						".$this->Db->qstr($v_bairro).",
						".$this->Db->qstr($v_cidade).",
						".$this->Db->qstr($v_estado).",
						".$this->Db->qstr($v_pais).",
						".$this->Db->qstr($v_nacionalidade).")							
						";
					
     $nm_select = $sqlipart; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                control_mailling_pack_ajax_response();
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
			 if (!isset($this->Campos_Mens_erro) || empty($this->Campos_Mens_erro))
 {
$this->nmgp_redireciona_form($this->Ini->path_link . "" . SC_dir_app_name('grid_mailling_rsvp') . "/", $this->nm_location, "", "_self", "ret_self", 440, 630);
 };
		}			
	} else {
		$this->nm_mens_alert[] = "RSVP - a importação do Mailling falhou!"; $this->nm_params_alert[] = array(); if ($this->NM_ajax_flag) { $this->sc_ajax_alert("RSVP - a importação do Mailling falhou!"); }}	
}
if (isset($this->NM_ajax_flag) && $this->NM_ajax_flag)
{
    if (isset($Ctrl_Proc_Onload) && $Ctrl_Proc_Onload) {
        $Ctrl_Format = true;
        $this->nm_guardar_campos();
        if ($bFormat) $this->nm_formatar_campos();
    }
    if (($original_arquivo != $this->arquivo || (isset($bFlagRead_arquivo) && $bFlagRead_arquivo)))
    {
        $this->ajax_return_values_arquivo(true);
    }
}
$_SESSION['scriptcase']['control_mailling']['contr_erro'] = 'off'; 
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

    function ValidateField_arquivo(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['arquivo'])) {
          return;
      }
        if ($this->nmgp_opcao != "excluir")
        {
            $sTestFile = $this->arquivo;
            if (!function_exists('sc_upload_unprotect_chars'))
            {
                include_once 'control_mailling_doc_name.php';
            }
            $this->arquivo = sc_upload_unprotect_chars($this->arquivo, true);
            $this->arquivo_scfile_name = sc_upload_unprotect_chars($this->arquivo_scfile_name, true);
            if (strpos($this->arquivo, "*") != false) {
                $hasError = true;
                $Campos_Crit .= "Arquivo: " . $this->Ini->Nm_lang['lang_errm_ivch']; 
                if (!isset($Campos_Erros['arquivo']))
                {
                    $Campos_Erros['arquivo'] = array();
                }
                $Campos_Erros['arquivo'][] = $this->Ini->Nm_lang['lang_errm_ivch'];
                if (!isset($this->NM_ajax_info['errList']['arquivo']) || !is_array($this->NM_ajax_info['errList']['arquivo']))
                {
                    $this->NM_ajax_info['errList']['arquivo'] = array();
                }
                $this->NM_ajax_info['errList']['arquivo'][] = $this->Ini->Nm_lang['lang_errm_ivch'];
            }
            if ("" != $this->arquivo && "S" != $this->arquivo_limpa && !$teste_validade->ArqExtensao($this->arquivo, array('xlsx')))
            {
                $hasError = true;
                $Campos_Crit .= "Arquivo: " . $this->Ini->Nm_lang['lang_errm_file_invl']; 
                if (!isset($Campos_Erros['arquivo']))
                {
                    $Campos_Erros['arquivo'] = array();
                }
                $Campos_Erros['arquivo'][] = $this->Ini->Nm_lang['lang_errm_file_invl'];
                if (!isset($this->NM_ajax_info['errList']['arquivo']) || !is_array($this->NM_ajax_info['errList']['arquivo']))
                {
                    $this->NM_ajax_info['errList']['arquivo'] = array();
                }
                $this->NM_ajax_info['errList']['arquivo'][] = $this->Ini->Nm_lang['lang_errm_file_invl'];
            }
            if (!$hasError && "" != $this->arquivo && "S" != $this->arquivo_limpa) {
                if (!function_exists('sc_upload_unprotect_chars')) {
                    include_once 'control_mailling_doc_name.php';
                }
                $pathParts = pathinfo(sc_upload_unprotect_chars($sTestFile));
                $fileSize = filesize(sc_upload_unprotect_chars($sTestFile));
                $sizeErrorSuffix = '';
                if ('xlsx' == strtolower($pathParts['extension']) && 1073741824 < $fileSize) {
                    $sizeErrorSuffix = ' (XLSX < 1 GB)';
                    $hasError = true;
                }
                if ($hasError) {
                    $Campos_Crit .= "Arquivo: " . $this->Ini->Nm_lang['lang_errm_file_size'] . $sizeErrorSuffix;
                    if (!isset($Campos_Erros['arquivo']))
                    {
                        $Campos_Erros['arquivo'] = array();
                    }
                    $Campos_Erros['arquivo'][] = $this->Ini->Nm_lang['lang_errm_file_size'] . $sizeErrorSuffix;
                    if (!isset($this->NM_ajax_info['errList']['arquivo']) || !is_array($this->NM_ajax_info['errList']['arquivo']))
                    {
                        $this->NM_ajax_info['errList']['arquivo'] = array();
                    }
                    $this->NM_ajax_info['errList']['arquivo'][] = $this->Ini->Nm_lang['lang_errm_file_size'] . $sizeErrorSuffix;
                }
            }
        }
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'arquivo';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_arquivo

    function ValidateField_cpfsist(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['cpfsist'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (trim($this->cpfsist) != "")  
          { 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'cpfsist';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_cpfsist
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
          if ($this->arquivo == "none") 
          { 
              $this->arquivo = ""; 
          } 
          if ($this->arquivo != "") 
          { 
              if (!is_file($this->arquivo) && isset($_SESSION['scriptcase']['charset']) && $_SESSION['scriptcase']['charset'] != 'UTF-8') {
                  $mbConvertFileName = mb_convert_encoding($this->arquivo, $_SESSION['scriptcase']['charset'], 'UTF-8');
                  if (is_file($mbConvertFileName)) {
                      $this->arquivo = $mbConvertFileName;
                  }
              }
              if (is_file($this->arquivo))  
              { 
                  if ($this->nmgp_opcao == "incluir")
                  { 
                      $this->SC_DOC_arquivo = $this->arquivo;
                  } 
                  else 
                  { 
                      $arq_arquivo = fopen($this->arquivo, "r") ; 
                      $reg_arquivo = fread($arq_arquivo, filesize($this->arquivo)) ; 
                      fclose($arq_arquivo) ;  
                  } 
                  $this->NM_size_docs[$this->arquivo_scfile_name] = $this->sc_file_size($this->arquivo);
                  $this->arquivo =  trim($this->arquivo_scfile_name) ;  
                  $dir_doc = $this->Ini->path_doc . "" . "/"; 
                 if ($this->nmgp_opcao != "incluir")
                 { 
                  if (nm_mkdir($dir_doc))  
                  { 
                      $_test_file = $this->fetchUniqueUploadName($this->arquivo_scfile_name, $dir_doc, "arquivo");
                      if (trim($this->arquivo_scfile_name) != $_test_file)
                      {
                          $this->arquivo_scfile_name = $_test_file;
                          $this->arquivo = $_test_file;
                          $this->Upload_refresh_fields[] = "arquivo";
                      }
                      $arq_arquivo = fopen($dir_doc . trim($this->arquivo_scfile_name), "w") ; 
                      fwrite($arq_arquivo, $reg_arquivo) ;  
                      fclose($arq_arquivo) ;  
                  } 
                  else 
                  { 
                      $Campos_Crit .= "Arquivo: " . $this->Ini->Nm_lang['lang_errm_ivdr']; 
                      if (!isset($Campos_Erros['arquivo']))
                      {
                          $Campos_Erros['arquivo'] = array();
                      }
                      $Campos_Erros['arquivo'][] = $this->Ini->Nm_lang['lang_errm_ivdr'];
                      if (!isset($this->NM_ajax_info['errList']['arquivo']) || !is_array($this->NM_ajax_info['errList']['arquivo']))
                      {
                          $this->NM_ajax_info['errList']['arquivo'] = array();
                      }
                      $this->NM_ajax_info['errList']['arquivo'][] = $this->Ini->Nm_lang['lang_errm_ivdr'];
                  } 
                 } 
              } 
              else 
              { 
                  $Campos_Crit .= "Arquivo " . $this->Ini->Nm_lang['lang_errm_upld']; 
                  $this->arquivo = "";
                  if (!isset($Campos_Erros['arquivo']))
                  {
                      $Campos_Erros['arquivo'] = array();
                  }
                  $Campos_Erros['arquivo'][] = $this->Ini->Nm_lang['lang_errm_upld'];
                  if (!isset($this->NM_ajax_info['errList']['arquivo']) || !is_array($this->NM_ajax_info['errList']['arquivo']))
                  {
                      $this->NM_ajax_info['errList']['arquivo'] = array();
                  }
                  $this->NM_ajax_info['errList']['arquivo'][] = $this->Ini->Nm_lang['lang_errm_upld'];
              } 
          } 
          elseif (!empty($this->arquivo_salva) && $this->arquivo_limpa != "S")
          {
              $this->arquivo = $this->arquivo_salva;
          }
      } 
      elseif (!empty($this->arquivo_salva) && $this->arquivo_limpa != "S")
      {
          $this->arquivo = $this->arquivo_salva;
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
    if (empty($this->arquivo))
    {
        $this->arquivo = $this->nmgp_dados_form['arquivo'];
    }
    $this->nmgp_dados_form['arquivo'] = $this->arquivo;
    $this->nmgp_dados_form['arquivo_limpa'] = $this->arquivo_limpa;
    $this->nmgp_dados_form['cpfsist'] = $this->cpfsist;
    $this->nmgp_dados_form['usuario_id'] = $this->usuario_id;
    $this->nmgp_dados_form['evento_id'] = $this->evento_id;
    $this->nmgp_dados_form['nomesist'] = $this->nomesist;
    $this->nmgp_dados_form['retorno'] = $this->retorno;
    $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['dados_form'] = $this->nmgp_dados_form;
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
          $this->ajax_return_values_arquivo();
          $this->ajax_return_values_cpfsist();
          if ('navigate_form' == $this->NM_ajax_opcao)
          {
              $this->NM_ajax_info['clearUpload']      = 'S';
              $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
              $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
          }
   } // ajax_return_values

          //----- arquivo
   function ajax_return_values_arquivo($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("arquivo", $this->nmgp_refresh_fields)) || $bForce || in_array("arquivo", $this->Upload_refresh_fields))
          {
              $sTmpValue = NM_charset_to_utf8($this->arquivo);
              $aLookup = array();
              $sTmpExtension = pathinfo($this->arquivo, PATHINFO_EXTENSION);
              $sTmpExtension = null == $sTmpExtension ? '' : '.' . $sTmpExtension;
              $sTmpFile      = 'sc_arquivo_' . md5(mt_rand(1, 1000) . microtime() . session_id()) . $sTmpExtension;
              if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['download_filenames']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['download_filenames'] = array();
              }
              $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['download_filenames'][$sTmpFile] = $this->arquivo;
              $tmp_file_arquivo = trim(NM_charset_to_utf8($this->arquivo));
              $tmp_icon_arquivo = '';
              if ('' != $tmp_file_arquivo)
              {
                  $tmp_icon_arquivo = $this->gera_icone($tmp_file_arquivo);
              }
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['arquivo'] = array(
                       'row'    => '',
               'type'    => 'documento',
               'valList' => array($sTmpValue),
               'docLink' => "<a href=\"javascript:nm_mostra_doc('0', '" . $sTmpFile . "', 'control_mailling')\">" . $tmp_file_arquivo . "</a>",
               'docIcon' => $tmp_icon_arquivo,
               'docReadonly' => "S",
              );
              if ('navigate_form' == $this->NM_ajax_opcao)
              {
                  $this->NM_ajax_info['fldList']['arquivo_salva'] = array(
                      'row'     => '',
                      'type'    => 'text',
                      'valList' => array(''),
                  );
              }
          }
   }

          //----- cpfsist
   function ajax_return_values_cpfsist($bForce = false)
   {
          if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("cpfsist", $this->nmgp_refresh_fields)) || $bForce)
          {
              $sTmpValue = NM_charset_to_utf8($this->cpfsist);
              $aLookup = array();
          $aLookupOrig = $aLookup;
          $this->NM_ajax_info['fldList']['cpfsist'] = array(
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['upload_dir'][$fieldName][] = $newName;
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
 function gera_icone($doc) 
 {
    $cam_icone = "";
    $path =  $this->Ini->root . $this->Ini->path_icones . "/";
    if (is_dir($path))
    {
        $nm_icones = nm_list_icon($path); 
        $nm_tipo = strtolower(substr($doc, strrpos($doc, ".") + 1));
        $nm_tipo = str_replace(array('docx', 'xlsx'), array('doc', 'xls'), $nm_tipo);
        if (isset($nm_icones[$nm_tipo]) && !empty($nm_icones[$nm_tipo]))
        {
            $cam_icone = $this->Ini->path_icones . "/" . $nm_icones[$nm_tipo];
        }
        else
        {
            $cam_icone = $this->Ini->path_icones . "/" . $nm_icones["default"];
        }
    }
    return $cam_icone;
 } 
//

function validaCPF($cpf,$tipodoc) {
$_SESSION['scriptcase']['control_mailling']['contr_erro'] = 'on';
  

	if ($tipodoc == 'C' || $tipodoc == 'T') {
		$cpf = preg_replace( '/[^0-9]/is', '', $cpf );

		if (strlen($cpf) != 11) {
			return false;
		}

		if (preg_match('/(\d)\1{10}/', $cpf)) {
			return false;
		}
		
		for ($t = 9; $t < 11; $t++) {
			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf[$c] * (($t + 1) - $c);
			}
			$d = ((10 * $d) % 11) % 10;
			if ($cpf[$c] != $d) {
				if ($tipodoc == 'C') {
					return false;
				} else {
					if ($tipodoc == 'T') {
						if (strlen($cpf) == 11) {
							return true;
						} else {
							return false;
						}	
					} else {
						return false; 
					}
				}	
			}
		}
	}
    return true;

$_SESSION['scriptcase']['control_mailling']['contr_erro'] = 'off';
}


function validaCPFpessoa($f_cpf,$f_nome) {
$_SESSION['scriptcase']['control_mailling']['contr_erro'] = 'on';
  
	
	$sql = "
	SELECT
		pessoa_cpf,
		pessoa_nome
	FROM
		pessoas_rsvp
	WHERE
		pessoa_cpf = ".$this->Db->qstr($f_cpf)." 
	ORDER BY
		pessoa_cpf
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
		$cpfEncontrado = $this->rs[0][0];
		$nomeEncontrado = $this->rs[0][1];			
		if ($nomeEncontrado <> $f_nome || $cpfEncontrado == $f_cpf) {
			$this->nomesist  = $nomeEncontrado;			
			similar_text($this->nomesist , $f_nome, $percent); 
			if ($percent <= 80) {
				return false;
			} else {
				return true;
			}
		}
	} else {		
		return true;
	}
$_SESSION['scriptcase']['control_mailling']['contr_erro'] = 'off';
}


function validaNomCPF($f_cpf, $f_nome) {
$_SESSION['scriptcase']['control_mailling']['contr_erro'] = 'on';
  
	$f_nome = mb_strtoupper( $f_nome,'UTF-8');
	$sqln = "
	SELECT
		pessoa_cpf,
		pessoa_nome
	FROM
		pessoas_rsvp
	WHERE			
		pessoa_nome = ".$this->Db->qstr($f_nome)." 
	ORDER BY
		pessoa_nome
	";		
	 
      $nm_select = $sqln; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsn = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rsn[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsn = false;
          $this->rsn_erro = $this->Db->ErrorMsg();
      } 

	if (isset($this->rsn[0][0])) {
		$cpfEncontrado = $this->rsn[0][0];
		$nomeEncontrado = $this->rsn[0][1];	
		if($cpfEncontrado <> $f_cpf) {
			$sqln2 = "
			SELECT
				pessoa_cpf,
				pessoa_nome
			FROM
				pessoas_rsvp
			WHERE			
				pessoa_cpf = ".$this->Db->qstr($f_cpf)." 
			AND
				pessoa_nome = ".$this->Db->qstr($f_nome)." 
			ORDER BY
				pessoa_cpf,pessoa_nome
			";		
			 
      $nm_select = $sqln2; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsn2 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rsn2[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsn2 = false;
          $this->rsn2_erro = $this->Db->ErrorMsg();
      } 

			if (isset($this->rsn2[0][0])) {
				return TRUE;
			} else {
				$this->nomesist  = mb_strtoupper($nomeEncontrado,'UTF-8');
				$this->cpfsist  = $cpfEncontrado;
				return FALSE;				
			}					
		} else {
			return TRUE;
		}	
	} else {
		return TRUE;		
	}
$_SESSION['scriptcase']['control_mailling']['contr_erro'] = 'off';
}


function m_php_carga_Excel()
{
$_SESSION['scriptcase']['control_mailling']['contr_erro'] = 'on';
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
  


;
date_default_timezone_set('America/Sao_Paulo');
$dir_sc = $this->Ini->path_doc;
$_arquivo = $dir_sc."/".$this->arquivo ;

$objPHPExcel=PHPExcel_IOFactory::load($_arquivo);

$v_tipo = 'P';
$v_evento = $this->evento_id ;
$v_usuario = $this->usuario_id ;

$delete_table = "
DELETE FROM 
	mailling_rsvp 
WHERE   
	id_evento = ".$this->Db->qstr($v_evento)."      
";	

     $nm_select = $delete_table; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                control_mailling_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      

$delete_incons = "
DELETE FROM 
	inconsistmailling
WHERE
	idEvento = ".$this->Db->qstr($v_evento)."        
";	

     $nm_select = $delete_incons; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                control_mailling_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      

$delete_fix = "
DELETE FROM 
	fixmailling_rsvp
WHERE
	id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."        
";	

     $nm_select = $delete_fix; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                control_mailling_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      

foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) { 
	
	$v_atualizar = 'Y';
    $this->nomesist  = '';
	$_cpf_bloqueado = '';
	$v_cod_emp_evento = '';
	
	$worksheetTitle     = $worksheet->getTitle();
	$highestRow         =  $worksheet->getHighestRow(); #1200; #$worksheet->getHighestRow();
	$highestColumn      = $worksheet->getHighestColumn();
	
	for ($row=2;$row<= $highestRow; ++ $row) {
		
		$_cpf_bloqueado = '';
		$v_atualizar = 'Y';
		
		$cell = $worksheet -> getCellByColumnAndRow (0, $row);
		$v_id_evento = $cell ->getValue();
		
		$cell = $worksheet -> getCellByColumnAndRow (1, $row);
		$v_rg = $cell ->getValue(); 		
		
		$cell = $worksheet -> getCellByColumnAndRow (2, $row);
		$v_cpf = $cell ->getValue(); 
		
		$cell = $worksheet -> getCellByColumnAndRow (3, $row);
		$v_tipodoc = $cell ->getValue(); 
	
		$cell = $worksheet -> getCellByColumnAndRow (4, $row);
		if(empty($cell)){
			$v_dtnasc = "";
		} else {
			$v_dtnasc = PHPExcel_Style_NumberFormat::toFormattedString($cell ->getValue(),'yyyy-mm-dd');			
		}
		
		$cell = $worksheet -> getCellByColumnAndRow (5, $row);
		$v_nome = $cell ->getValue();
				
		$cell = $worksheet -> getCellByColumnAndRow (6, $row);
		$v_email = $cell ->getValue();
		
		$cell = $worksheet -> getCellByColumnAndRow (7, $row);
		$v_id_publico = $cell ->getValue();
		
		$cell = $worksheet -> getCellByColumnAndRow (8, $row);
		$v_id_regional = $cell ->getValue();				
		
		$cell = $worksheet -> getCellByColumnAndRow (9, $row);
		$v_ddd_celular = $cell ->getValue();
		
		$cell = $worksheet -> getCellByColumnAndRow (10, $row);
		$v_celular = $cell ->getValue();
		
		$cell = $worksheet -> getCellByColumnAndRow (11, $row);
		$v_ddd_fixo = $cell ->getValue();
				
		$cell = $worksheet -> getCellByColumnAndRow (12, $row);
		$v_fone_fixo = $cell ->getValue();
		
		$cell = $worksheet -> getCellByColumnAndRow (13, $row);
		$v_empresa = $cell ->getValue();
		
		$cell = $worksheet -> getCellByColumnAndRow (14, $row);
		$v_gupo = $cell ->getValue();
		
		$cell = $worksheet -> getCellByColumnAndRow (15, $row);		
		$v_clube = $cell ->getValue();
			
		$cell = $worksheet -> getCellByColumnAndRow (16, $row);	
		$v_sexo = $cell ->getValue();
		
		$cell = $worksheet -> getCellByColumnAndRow (17, $row);	
		$v_cod_emp_evento = $cell ->getValue();	
		
		$cell = $worksheet -> getCellByColumnAndRow (18, $row);	
		$v_cod_tel_pais = $cell ->getValue();	
		
		$cell = $worksheet -> getCellByColumnAndRow (19, $row);	
		$v_papel_status = $cell ->getValue();	

		$cell = $worksheet -> getCellByColumnAndRow (20, $row);	
		$v_uid_pulseira_nfc = $cell ->getValue();	
		
		$cell = $worksheet -> getCellByColumnAndRow (21, $row);	
		$v_passaporte = $cell ->getValue();
		
		$cell = $worksheet -> getCellByColumnAndRow (22, $row);	
		$v_emissao_passaporte = PHPExcel_Style_NumberFormat::toFormattedString($cell ->getValue(),'yyyy-mm-dd');
		
		$cell = $worksheet -> getCellByColumnAndRow (23, $row);	
		$v_validade_passaporte = PHPExcel_Style_NumberFormat::toFormattedString($cell ->getValue(),'yyyy-mm-dd');
		
		$cell = $worksheet -> getCellByColumnAndRow (24, $row);	
		$v_numero_visto = $cell ->getValue();
		
		$cell = $worksheet -> getCellByColumnAndRow (25, $row);	
		$v_validade_visto = PHPExcel_Style_NumberFormat::toFormattedString($cell ->getValue(),'yyyy-mm-dd');
		
		$cell = $worksheet -> getCellByColumnAndRow (26, $row);	
		$v_vacina_febre_amarela = PHPExcel_Style_NumberFormat::toFormattedString($cell ->getValue(),'yyyy-mm-dd');
		
		$cell = $worksheet -> getCellByColumnAndRow (27, $row);			
		$v_estrangeiro = $cell ->getValue();
		
		$cell = $worksheet -> getCellByColumnAndRow (28, $row);			
		$v_idioma_pref = $cell ->getValue();
		
		$cell = $worksheet -> getCellByColumnAndRow (29, $row);			
		$v_rest_alimentar = $cell ->getValue();		
		
		$cell = $worksheet -> getCellByColumnAndRow (30, $row);			
		$v_rest_mobilidade = $cell ->getValue();	
		
		$cell = $worksheet -> getCellByColumnAndRow (31, $row);			
		$v_cep = $cell ->getValue();	
		
		$cell = $worksheet -> getCellByColumnAndRow (32, $row);			
		$v_logradouro = $cell ->getValue();	
		
		$cell = $worksheet -> getCellByColumnAndRow (33, $row);			
		$v_numero = $cell ->getValue();	
		
		$cell = $worksheet -> getCellByColumnAndRow (34, $row);			
		$v_complemento = $cell ->getValue();	
		
		$cell = $worksheet -> getCellByColumnAndRow (35, $row);			
		$v_bairro = $cell ->getValue();	
		
		$cell = $worksheet -> getCellByColumnAndRow (36, $row);			
		$v_cidade = $cell ->getValue();	
		
		$cell = $worksheet -> getCellByColumnAndRow (37, $row);			
		$v_estado = $cell ->getValue();	
		
		$cell = $worksheet -> getCellByColumnAndRow (38, $row);				
		$v_pais = $cell ->getValue();	
			
		$cell = $worksheet -> getCellByColumnAndRow (39, $row);				
		$v_nacionalidade = $cell ->getValue();
		
		$v_nomep = trim($v_nome);
		$v_tipodoc = trim($v_tipodoc);
		$v_nomep = $this->limpa_string($v_nomep);
		$v_nomep = mb_strtoupper($v_nomep,'UTF-8');
		$v_tipodoc = mb_strtoupper($v_tipodoc,'UTF-8');
		$v_cpfsist = '';
		
		$v_cpf = $this->limpa_string($v_cpf);
		if (empty($v_id_evento)) {
			$mensagem = "O campo CODIGO EVENTO este vazio na celula A";
			$this->inconsisMailling($row,$mensagem,$v_evento,$v_usuario,$v_cpf,'SN',$v_nomep,$v_cpfsist);	
			$_cpf_bloqueado = $v_cpf;
		}
		$v_ddd_fixo = $this->limpa_string($v_ddd_fixo);
		$v_fone_fixo = $this->limpa_string($v_fone_fixo);
		$v_celular = $this->limpa_string($v_celular);	
		$v_ddd_celular = $this->limpa_string($v_ddd_celular);		
		$v_sexo = strtoupper($v_sexo);
		$v_empresa = $this->limpa_string($v_empresa);
		$v_nome = $this->limpa_string($v_nome);
		$v_empresa = trim($v_empresa);		
		$v_nome = trim($v_nome);
		$v_cod_emp_evento = trim($v_cod_emp_evento);
		
		if($v_uid_pulseira_nfc <> '') {
			$regex = '/^([0-9a-fA-F]{2}:)+[0-9a-fA-F]{2}$/';  
			if (preg_match($regex, $v_uid_pulseira_nfc)) {
				$valida_pulseira = true;
			} else {				
				$valida_pulseira = false;
			}
		} else {
			$valida_pulseira = true;
		}
				
		$v_cod_tel_pais = preg_replace('/[^0-9]/', '', $v_cod_tel_pais);
		$v_cod_tel_pais = substr($v_cod_tel_pais,0,3);
		$v_cod_tel_pais = trim($v_cod_tel_pais);	
		$v_papel_status = strtolower($v_papel_status);
		if($v_papel_status == 'guest' || $v_papel_status == 'speaker' || $v_papel_status == 'buyer' || $v_papel_status == 'organizer' || $v_papel_status == 'admin') {
			$v_papel_status = strtolower($v_papel_status);
		} else {
			$v_papel_status == 'guest';
		}		
		$v_estrangeiro = strtoupper($v_estrangeiro);
		if($v_estrangeiro <> 'Y' || $v_estrangeiro <> 'N') {			
			$v_estrangeiro = 'N';
		}
		$v_idioma_pref = strtolower($v_idioma_pref);
		if($v_idioma_pref <> 'pt' || $v_idioma_pref <> 'en') {
			$v_idioma_pref = 'pt';
		}
		$v_cep = preg_replace('/\D/', '', $v_cep);
		$v_logradouro = mb_strtoupper($v_logradouro,'UTF-8');
		$v_bairro = mb_strtoupper($v_bairro,'UTF-8');
		$v_cidade = mb_strtoupper($v_cidade,'UTF-8');			
		$v_estado = strtoupper($v_estado);	
		$v_pais = mb_strtoupper($v_pais,'UTF-8');			
		
		if ($v_evento <> $v_id_evento) {
			$v_atualizar = 'N';
			$mensagem = "O código do EVENTO na planilha é diferente do cód. do Evento selecionado, na célula A";
			$this->inconsisMailling($row,$mensagem,$v_evento,$v_usuario,$v_cpf,'SN',$v_nomep,$v_cpfsist);	
			$_cpf_bloqueado = $v_cpf;
		}
		
		if ($v_evento == $v_id_evento) {
			if (empty($v_cpf)) {
				$v_atualizar = 'N';
				$mensagem = "O campo do CPF/Fone/RG esta vazio na celula C (01)";
				$this->inconsisMailling($row,$mensagem,$v_evento,$v_usuario,$v_cpf,'SN',$v_nomep,$v_cpfsist);	
				$_cpf_bloqueado = $v_cpf;
			} else {		
				$_ret = $this->validaCPF($v_cpf,$v_tipodoc);
				if ($_ret == false) {					
					if ($v_tipodoc == 'C') {				
						$v_atualizar = 'N';
						$mensagem = "O campo do CPF/Fone/RG não é válido na celula C (02)";
						$this->inconsisMailling($row,$mensagem,$v_evento,$v_usuario,$v_cpf,'SN',$v_nomep,$v_cpfsist);	
						$_cpf_bloqueado = $v_cpf;
					}	
				} else {
					$_ret2 = $this->validaCPFpessoa($v_cpf, mb_strtoupper($v_nome,'UTF-8')); 
					if ($_ret2 == false) {	
						if ($this->nomesist  <> '') {
							$v_atualizar = 'N';
							$mensagem = "CPF(s)/Fone(s) iguais: ".$v_cpf." para nomes diferentes entre o Mailling: ".$v_nome." e o Sistema: ".$this->nomesist ." , na célua C/F";	
							$this->inconsisMailling($row,$mensagem,$v_evento,$v_usuario,$v_cpf,'CN',$v_nomep,$v_cpfsist);
							$_cpf_bloqueado = $v_cpf;
						}	
					}	
				}
			}			
			
			if (empty($v_dtnasc || $v_dtnasc == '')) {
				$mensagem = "O campo data de Nascimento esta vazio na celula E";
			}
			
			if (empty($v_nome)) {
				$v_atualizar = 'N';
				$mensagem = "O campo Nome esta vazio na celula F";
				$this->inconsisMailling($row,$mensagem,$v_evento,$v_usuario,$v_cpf,'SN',$v_nomep,$v_cpfsist);	
			}

			if (strlen($v_ddd_celular) > 2) {
				$mensagem = "O campo DDD Celular com tamanho incorreto na celula J";
				$this->inconsisMailling($row,$mensagem,$v_evento,$v_usuario,$v_cpf,'SN',$v_nomep,$v_cpfsist);
				$_cpf_bloqueado = $v_cpf;
			} else {
				
			}

			if (strlen($v_celular) > 9) {
				$mensagem = "O campo Celular com tamanho incorreto na celula K";
				$this->inconsisMailling($row,$mensagem,$v_evento,$v_usuario,$v_cpf,'SN',$v_nomep,$v_cpfsist);	
				$_cpf_bloqueado = $v_cpf;
			} else {
				
			}

			if (strlen($v_ddd_fixo) > 2) {
				$mensagem = "O campo DDD Fixo com tamanho incorreto na celula L";
				$this->inconsisMailling($row,$mensagem,$v_evento,$v_usuario,$v_cpf,'SN',$v_nomep,$v_cpfsist);	
				$_cpf_bloqueado = $v_cpf;
			}

			if (strlen($v_fone_fixo) > 8) {
				$mensagem = "O campo Fone Fixo com tamanho incorreto na celula M";
				$this->inconsisMailling($row,$mensagem,$v_evento,$v_usuario,$v_cpf,'SN',$v_nomep,$v_cpfsist);	
				$_cpf_bloqueado = $v_cpf;
			}

			if ($v_sexo <> 'F') {
				if ($v_sexo <> 'M') {
					$mensagem = "O campo Sexo está incorreto na celula Q";
					$this->inconsisMailling($row,$mensagem,$v_evento,$v_usuario,$v_cpf,'SN',$v_nomep,$v_cpfsist);
					$_cpf_bloqueado = $v_cpf;
				}	
			}
			
			if (empty($v_tipodoc)) {
				$mensagem = "O campo tipo documento está em branco na celula D";
				$this->inconsisMailling($row,$mensagem,$v_evento,$v_usuario,$v_cpf,'SN',$v_nomep,$v_cpfsist);
				$_cpf_bloqueado = $v_cpf;				
			} else {
				if ($v_tipodoc <> 'C') {
					if ($v_tipodoc <> 'T') {
						if ($v_tipodoc <> 'R') {
							if ($v_tipodoc <> 'C') {
								if ($v_tipodoc <> 'O') {							
									$mensagem = "O campo tipo documento está invalido na celula D. Use somente (C, F, R ou O)";
									$this->inconsisMailling($row,$mensagem,$v_evento,$v_usuario,$v_cpf,'SN',$v_nomep,$v_cpfsist);
									$_cpf_bloqueado = $v_cpf;												
								}	
							}
						}	
					}
				}					
			}	
			if (strlen($v_tipodoc) > 1) {
				$mensagem = "O tamanho do campo tipo documento nao pode exceder a uma posição na celula D";
				$this->inconsisMailling($row,$mensagem,$v_evento,$v_usuario,$v_cpf,'SN',$v_nomep,$v_cpfsist);
				$_cpf_bloqueado = $v_cpf;				
			}	
						
			$_retf = $this->validaCPFpessoa($v_tipodoc, mb_strtoupper($v_nome,'UTF-8')); 
			if ($_retf == false) {	
				if ($this->nomesist  <> '') {
					$v_atualizar = 'N';
					$mensagem = "CPF(s)/Fone(s)/RG(s) iguais: ".$v_cpf." para nomes diferentes entre o Mailling: ".$v_nome." e o Sistema: ".$this->nomesist ." , na célua C/F";	
					$this->inconsisMailling($row,$mensagem,$v_evento,$v_usuario,$v_cpf,'CN',$v_nomep,$v_cpfsist);
					$_cpf_bloqueado = $v_cpf;
				}	
			} 
			
			if ($v_tipodoc == 'T') {				
				if (strlen($v_cpf) == 11) {	
					$dddf = substr($v_cpf,0,3);
					$ddde = substr($v_cpf,0,2);
					$tele = substr($v_cpf,2,9);
					if ($dddf >= '119' && $dddf <= '999') {
						if ($v_ddd_celular == '') {
							$v_ddd_celular = $dde;
						}		
					} else {
						$v_atualizar = 'N';
						$mensagem = "Fone(s) inválido(s) - DDD: ".$ddde." - ".$tele." , na célua C/F";	
						$this->inconsisMailling($row,$mensagem,$v_evento,$v_usuario,$v_cpf,'CN',$v_nomep,$v_cpfsist);
						$_cpf_bloqueado = $v_cpf;			
					}				
				} else {			
					if (strlen($v_cpf) == 9) {	
						$v_cpf = $v_ddd_celular.$v_cpf;
					}	
					if (strlen($v_cpf) <> 11 ) {		
						$v_atualizar = 'N';
						$mensagem = "Fone(s) inválido(s) - ".$v_cpf." , na célua C/F (01)";	
						$this->inconsisMailling($row,$mensagem,$v_evento,$v_usuario,$v_cpf,'CN',$v_nomep,$v_cpfsist);
						$_cpf_bloqueado = $v_cpf;									
					}					
				}	
			}	
						
			if ($v_tipodoc == 'R') {
				$v_atualizar = 'N';
				$mensagem = "CPF(s)/Fone(s) inválido(s) - DDD: ".$ddde." - ".$tele." , na célua C/F";	
				$this->inconsisMailling($row,$mensagem,$v_evento,$v_usuario,$v_cpf,'CN',$v_nomep);
				$_cpf_bloqueado = $v_cpf;							
			}			
			
			$_retn = $this->validaNomCPF($v_cpf, mb_strtoupper($v_nome,'UTF-8'));
			if ($_retn == false) {	
				if ($this->nomesist  <> '') {
					$v_nome = mb_strtoupper($v_nome,'UTF-8');
					$v_atualizar = 'N';					
					$mensagem = "CPF(s)/Fone(s)/RG(s) diferentes, Informado: ".$v_cpf." - Encontrado: ".$this->cpfsist .", para nomes semelhantes entre o Mailling: ".$v_nome." e o Sistema: ".$this->nomesist ." , na célua C/F";	
					$this->inconsisMailling($row,$mensagem,$v_evento,$v_usuario,$v_cpf,'CN',$v_nomep,$this->cpfsist );					
					$_cpf_bloqueado = $v_cpf;
				}	
			} 
			
			if($v_cod_emp_evento <> "") {
				$sqlemp = "
					SELECT
						empresa_id,
						evento_id
					FROM
						eventos_empresas_rsvp
					WHERE
						empresa_id = ".$this->Db->qstr($v_cod_emp_evento)."  
					AND
						evento_id =  ".$this->Db->qstr($v_id_evento)." 
				";
				 
      $nm_select = $sqlemp; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsemp = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rsemp[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsemp = false;
          $this->rsemp_erro = $this->Db->ErrorMsg();
      } 

				if (!isset($this->rsemp[0][0])) {	
					$v_atualizar = 'N';
					$mensagem = "Empresa: ".$v_cod_emp_evento." Não Cadastrada no Evento: ".$v_id_evento." , na célula R (01)";	
					$this->inconsisMailling($row,$mensagem,$v_evento,$v_usuario,$v_cpf,'CN',$v_nomep,$v_cpfsist);
				}				
			} else {
				$v_atualizar = 'N';
				$mensagem = "Código da Empresa não informada no Evento: ".$v_id_evento." , na célula R (01)";	
				$this->inconsisMailling($row,$mensagem,$v_evento,$v_usuario,$v_cpf,'CN',$v_nomep,$v_cpfsist);
			}
			
			$v_email = strtolower($v_email);		
			if($v_email <> '') {					
				$sql = "
					SELECT
						part_cpf,
						part_email
					FROM
						participantes_rsvp
					WHERE
						part_cpf <> ".$this->Db->qstr($v_cpf)."
					AND
						part_email = ".$this->Db->qstr($v_email)."
					AND
						part_id_evento = ".$this->Db->qstr($v_evento)."
					ORDER BY
						part_cpf
					LIMIT 1
				";
				
				 
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsp = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rsp[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsp = false;
          $this->rsp_erro = $this->Db->ErrorMsg();
      } 
	
				if (isset($this->rsp[0][0])) {
					$continuaFlux = false;
					$v_atualizar = 'N';
					$mensagem = "Este endereço de email ".$v_mail." já está em uso! Escolha outro, na célula G (07)";
					$this->inconsisMailling($row,$mensagem,$v_evento,$v_usuario,$v_email,'CN',$v_nomep,$v_cpfsist);
				} else {
					$continuaFlux = true;
				}

				if($continuaFlux == true) {
					$sqla = "
						SELECT
							part_cpf,
							part_email
						FROM
							acompanhantes_rsvp
						WHERE
							part_cpf <> ".$this->Db->qstr($v_cpf)."
						AND
							part_email = ".$this->Db->qstr($v_email)."
						AND
							part_id_evento = ".$this->Db->qstr($v_evento)."
						ORDER BY
							part_cpf
						LIMIT 1
					";
					 
      $nm_select = $sqla; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsa = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rsa[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsa = false;
          $this->rsa_erro = $this->Db->ErrorMsg();
      } 
	
					if (isset($this->rsa[0][0])) {
						$v_atualizar = 'N';
						$mensagem = "Este endereço de email ".$v_mail." já está em uso! Escolha outro, na célula G (07)";
						$this->inconsisMailling($row,$mensagem,$v_evento,$v_usuario,$v_email,'CN',$v_nomep,$v_cpfsist);
					}	
				}
			} else {
				
			}
			
			if($valida_pulseira == false) {
				$v_atualizar = 'N';
				$mensagem = "Informe o valor da Pulseira no formato 04:A1:B2:C3:D4, na célula U (21)";	
				$this->inconsisMailling($row,$mensagem,$v_evento,$v_usuario,$v_uid_pulseira_nfc,'CN',$v_nomep,$v_cpfsist);
			} else {
				if($v_uid_pulseira_nfc <> '') {
					$sql = "
						SELECT
							part_cpf,
							part_id_evento,
							uid_pulseira_nfc
						FROM
							participantes_rsvp
						WHERE
							part_cpf <> ".$this->Db->qstr($v_cpf)."
						AND
							uid_pulseira_nfc = ".$this->Db->qstr($v_uid_pulseira_nfc)."
						AND
							part_id_evento = ".$this->Db->qstr($v_id_evento)."
						ORDER BY
							part_cpf
						LIMIT 1
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
						$v_atualizar = 'N';
						$mensagem = "Este valor da pulseira: ".$v_uid_pulseira_nfc." já está em uso! Escolha outro, na célula U (21)";
						$this->inconsisMailling($row,$mensagem,$v_evento,$v_usuario,$v_uid_pulseira_nfc,'CN',$v_nomep,$v_cpfsist);
					}
					
					$sqla = "
						SELECT
							part_cpf,
							part_id_evento,
							uid_pulseira_nfc
						FROM
							acompanhantes_rsvp
						WHERE
							part_cpf <> ".$this->Db->qstr($v_cpf)."
						AND
							uid_pulseira_nfc = ".$this->Db->qstr($v_uid_pulseira_nfc)."
						AND
							part_id_evento = ".$this->Db->qstr($v_id_evento)."
						ORDER BY
							part_cpf
						LIMIT 1
					";
					 
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsa = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                      $this->rsa[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsa = false;
          $this->rsa_erro = $this->Db->ErrorMsg();
      } 
	
					if (isset($this->rsa[0][0])) {
						$v_atualizar = 'N';
						$mensagem = "Este valor da pulseira: ".$v_uid_pulseira_nfc." já está em uso! Escolha outro, na célula U (21)";
						$this->inconsisMailling($row,$mensagem,$v_evento,$v_usuario,$v_uid_pulseira_nfc,'CN',$v_nomep,$v_cpfsist);
					}					
				}
			}
			
			
			$v_nome = mb_strtoupper($v_nome,'UTF-8');
			$v_empresa = mb_strtoupper($v_empresa,'UTF-8');   
			$v_gupo = mb_strtoupper($v_gupo,'UTF-8');         
			$v_clube = mb_strtoupper($v_clube,'UTF-8');				
					
			if ($v_cpf <> $_cpf_bloqueado) {		
				$insert_sql = "
				INSERT INTO 
					mailling_rsvp 
					(id_evento,
					id_usuario,
					rg,
					cpf,
					data_nascimento,
					nome,
					email,
					tipo,
					id_publico,
					id_regional,
					ddd_celular,
					celular,
					ddd_fixo,
					fone_fixo,
					empresa,
					grupo,
					clube,
					sexo,
					atualizar,
					cod_empresa_evento,
					codigo_telefone_pais,
					papel,
					uid_pulseira_nfc,
					passaporte,
					emissao_passaporte,
					validade_passaporte,
					numero_visto,
					validade_visto,
					vacina_febre_amarela,
					estrangeiro,
					idioma_preferido,
					part_restricao_alimentar,
					restricao_mobilidade,
					part_cep,
					part_logradouro,
					part_numero,
					part_complemento,
					part_bairro,
					part_cidade,
					part_uf,
					pais,
					nacionalidade,
					tipo_doc)
				VALUES 
					(".$this->Db->qstr($v_id_evento).",	
					".$this->Db->qstr($v_usuario).",    
					".$this->Db->qstr($v_rg).",    
					".$this->Db->qstr($v_cpf).",           
					".$this->Db->qstr($v_dtnasc).",        
					".$this->Db->qstr($v_nome).",          
					".$this->Db->qstr($v_email).",         
					".$this->Db->qstr($v_tipo).",          
					".$this->Db->qstr($v_id_publico).",    
					".$this->Db->qstr($v_id_regional).",   
					".$this->Db->qstr($v_ddd_celular).",   
					".$this->Db->qstr($v_celular).",       
					".$this->Db->qstr($v_ddd_fixo).",      
					".$this->Db->qstr($v_fone_fixo).",     
					".$this->Db->qstr($v_empresa).",       
					".$this->Db->qstr($v_gupo).",          
					".$this->Db->qstr($v_clube).",
					".$this->Db->qstr($v_sexo).",
					".$this->Db->qstr($v_atualizar).",					
					".$this->Db->qstr($v_cod_emp_evento).",					
					".$this->Db->qstr($v_cod_tel_pais).",
					".$this->Db->qstr($v_papel_status).",					
					".$this->Db->qstr($v_uid_pulseira_nfc).",
					".$this->Db->qstr($v_passaporte).",
					".$this->Db->qstr($v_emissao_passaporte).",					
					".$this->Db->qstr($v_validade_passaporte).",					
					".$this->Db->qstr($v_numero_visto).",					
					".$this->Db->qstr($v_validade_visto).",					
					".$this->Db->qstr($v_vacina_febre_amarela).",
					".$this->Db->qstr($v_estrangeiro).",
					".$this->Db->qstr($v_idioma_pref ).",
					".$this->Db->qstr($v_rest_alimentar).",
					".$this->Db->qstr($v_rest_mobilidade).",					
					".$this->Db->qstr($v_cep).",
					".$this->Db->qstr($v_logradouro).",					
					".$this->Db->qstr($v_numero).",
					".$this->Db->qstr($v_complemento).",					
					".$this->Db->qstr($v_bairro).",
					".$this->Db->qstr($v_cidade).",
					".$this->Db->qstr($v_estado).",
					".$this->Db->qstr($v_pais).",
					".$this->Db->qstr($v_nacionalidade).",
					".$this->Db->qstr($v_tipodoc).")         
					";			
				
     $nm_select = $insert_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                control_mailling_pack_ajax_response();
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
				$insert_sql = "
				INSERT INTO 
					fixmailling_rsvp 
					(id_evento,
					rg,
					cpf,
					data_nascimento,
					nome,
					email,
					id_publico,
					id_regional,
					ddd_celular,
					celular,
					ddd_fixo,
					fone_fixo,
					empresa,
					grupo,
					clube,
					sexo,
					cod_empresa_evento,
					codigo_telefone_pais,
					papel,
					uid_pulseira_nfc,
					passaporte,
					emissao_passaporte,
					validade_passaporte,
					numero_visto,
					validade_visto,
					vacina_febre_amarela,
					idioma_preferido,
					part_restricao_alimentar,
					restricao_mobilidade,
					part_cep,
					part_logradouro,
					part_numero,
					part_complemento,
					part_bairro,
					part_cidade,
					part_uf,
					pais,
					nacionalidade,
					tipo_doc)
				VALUES 
					(".$this->Db->qstr($v_id_evento).",	
					".$this->Db->qstr($v_rg).",    
					".$this->Db->qstr($v_cpf).",           
					".$this->Db->qstr($v_dtnasc).",        
					".$this->Db->qstr($v_nome).",          
					".$this->Db->qstr($v_email).",         
					".$this->Db->qstr($v_id_publico).",    
					".$this->Db->qstr($v_id_regional).",   
					".$this->Db->qstr($v_ddd_celular).",   
					".$this->Db->qstr($v_celular).",       
					".$this->Db->qstr($v_ddd_fixo).",      
					".$this->Db->qstr($v_fone_fixo).",     
					".$this->Db->qstr($v_empresa).",       
					".$this->Db->qstr($v_gupo).",          
					".$this->Db->qstr($v_clube).",
					".$this->Db->qstr($v_sexo).",
					".$this->Db->qstr($v_cod_emp_evento).",					
					".$this->Db->qstr($v_cod_tel_pais).",
					".$this->Db->qstr($v_papel_status).",
					".$this->Db->qstr($v_uid_pulseira_nfc).",
					".$this->Db->qstr($v_passaporte).",
					".$this->Db->qstr($v_emissao_passaporte).",
					".$this->Db->qstr($v_validade_passaporte).",	
					".$this->Db->qstr($v_numero_visto).",
					".$this->Db->qstr($v_validade_visto).",					
					".$this->Db->qstr($v_vacina_febre_amarela).",
					".$this->Db->qstr($v_idioma_pref ).",
					".$this->Db->qstr($v_rest_alimentar ).",
					".$this->Db->qstr($v_rest_mobilidade).",
					".$this->Db->qstr($v_cep).",
					".$this->Db->qstr($v_logradouro).",
					".$this->Db->qstr($v_numero).",
					".$this->Db->qstr($v_complemento).",
					".$this->Db->qstr($v_bairro).",
					".$this->Db->qstr($v_cidade).",
					".$this->Db->qstr($v_estado).",
					".$this->Db->qstr($v_pais).",
					".$this->Db->qstr($v_nacionalidade).",
					".$this->Db->qstr($v_tipodoc).")     
					";			
				
     $nm_select = $insert_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                control_mailling_pack_ajax_response();
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
	}
}
if (isset($this->sc_temp_vg_evento_id)) { $_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
$_SESSION['scriptcase']['control_mailling']['contr_erro'] = 'off';
}


function GetUsuarioNivel($idu,$tipo) {
$_SESSION['scriptcase']['control_mailling']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['control_mailling']['contr_erro'] = 'off';
}


function inconsisMailling($linha,$msg,$p_evento,$p_usuario,$p_cpf,$p_tipo,$p_nomep,$p_cpfsist) {
$_SESSION['scriptcase']['control_mailling']['contr_erro'] = 'on';
  
		date_default_timezone_set('America/Sao_Paulo');
		if ($p_tipo == 'SN') {
			$p_nomep = '';
		}
		
		$insert_sqli = "
		INSERT INTO 
			inconsistmailling
			(numeroLinha,
			descricaoErro,
			idEvento,
			idUsuario,
			cpf,
			nomeplan,
			cpf_correcao_planilha)			
			VALUES 
			(".$this->Db->qstr($linha).",
			".$this->Db->qstr($msg).",
			".$this->Db->qstr($p_evento).",
			".$this->Db->qstr($p_usuario).",
			".$this->Db->qstr($p_cpf).",
			".$this->Db->qstr($p_nomep).",
			".$this->Db->qstr($p_cpfsist).")			
		";			
		
     $nm_select = $insert_sqli; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             $this->NM_rollback_db(); 
             if ($this->NM_ajax_flag)
             {
                control_mailling_pack_ajax_response();
             }
             exit;
         }
         $rf->Close();
      		
		return true;
$_SESSION['scriptcase']['control_mailling']['contr_erro'] = 'off';
}


function limpa_string($valor) {
$_SESSION['scriptcase']['control_mailling']['contr_erro'] = 'on';
  
		date_default_timezone_set('America/Sao_Paulo');
		$valor = trim($valor);
		$valor = str_replace(array(".","-","/","(",")","'"),"", $valor);
	return $valor;

$_SESSION['scriptcase']['control_mailling']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['control_mailling']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['control_mailling']['contr_erro'] = 'off';
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
     $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              control_mailling_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['retorno_edit'] . "';";
    }
?>
         </script>
         </body></html>
<?php
         exit;
     }
     $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['sub_dir'][0]  = "";
//-- 
   $__sc_doc_pending_api = false;
   if ($this->arquivo != "" && $this->arquivo != "none")   
   { 
       $sTmpExtension = pathinfo($this->arquivo, PATHINFO_EXTENSION);
       $sTmpExtension = null == $sTmpExtension ? '' : '.' . $sTmpExtension;
       $sTmpFile_arquivo = 'sc_arquivo_' . md5(mt_rand(1, 1000) . microtime() . session_id()) . $sTmpExtension;
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['download_filenames']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['download_filenames'] = array();
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['download_filenames'][$sTmpFile_arquivo] = $this->arquivo;
   } 
      if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1) 
      { 
          $nm_saida_global = $_SESSION['scriptcase']['nm_sc_retorno']; 
      } 
    $this->nm_formatar_campos();
        $this->initFormPages();
    include_once("control_mailling_form0.php");
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['table_refresh'])
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['csrf_token'];
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
       $nmgp_saida_form = "control_mailling_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['nm_run_menu'] = 2;
       $nmgp_saida_form = "control_mailling_fim.php";
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
       control_mailling_pack_ajax_response();
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['masterValue']);
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
               $tmp_parms .= $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling'][substr($val, 1, -1)];
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
       $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['opcao'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['opc_ant'] = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['retorno_edit'] = "";
   }
   $nm_target_form = (empty($nm_target)) ? "_self" : $nm_target;
   if (strtolower(substr($nm_apl_dest, -4)) != ".php" && (strtolower(substr($nm_apl_dest, 0, 7)) == "http://" || strtolower(substr($nm_apl_dest, 0, 8)) == "https://" || strtolower(substr($nm_apl_dest, 0, 3)) == "../"))
   {
       if ($this->NM_ajax_flag)
       {
           $this->NM_ajax_info['redir']['metodo'] = 'location';
           $this->NM_ajax_info['redir']['action'] = $nm_apl_dest;
           $this->NM_ajax_info['redir']['target'] = $nm_target_form;
           control_mailling_pack_ajax_response();
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
       control_mailling_pack_ajax_response();
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
    function getButtonIds($buttonName) {
        switch ($buttonName) {
            case "ok":
                return array("sub_form_b.sc-unique-btn-1");
                break;
            case "help":
                return array("sc_b_hlp_b");
                break;
            case "exit":
                return array("Bsair_b.sc-unique-btn-2", "Bsair_b.sc-unique-btn-3");
                break;
            case "listagem":
                return array("sc_Listagem_bot");
                break;
        }

        return array($buttonName);
    } // getButtonIds

    function displayAppHeader()
    {
        if ($this->Embutida_call) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['link_info']['compact_mode']) {
            return;
        }
?>
    <tr id="sc_form_head"><td class="sc-app-header">
<style>
    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}
</style>
<div class="scFormHeader" style="height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;">
    <div class="scFormHeaderFont" style="float: left; text-transform: uppercase;"><?php if ($this->nmgp_opcao == "novo") { echo "BRSVP - Subir Mailing"; } else { echo "BRSVP - Subir Mailing"; } ?></div>
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['control_mailling']['ordem_ord'] == " desc") {
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
