<?php
//
class form_participantes_rsvp_ar_apl
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
   var $participante_id_;
   var $part_ativo_;
   var $part_sexo_;
   var $part_cpf_;
   var $nome_pessoa_;
   var $part_cpf_substituto_;
   var $part_crnm_;
   var $part_tipo_;
   var $part_nome_cracha_;
   var $part_id_evento_;
   var $part_id_evento_publico_;
   var $part_id_evento_regional_;
   var $part_tipo_pessoa_;
   var $part_substituido_;
   var $part_substituto_;
   var $part_cod_substituto_;
   var $part_nome_substituto_;
   var $part_sexo_substituto_;
   var $part_cod_substituido_;
   var $part_nome_substituido_;
   var $part_grupo_;
   var $part_clube_;
   var $part_empresa_;
   var $part_cep_;
   var $part_departamento_;
   var $part_cargo_;
   var $part_logradouro_;
   var $part_numero_;
   var $part_complemento_;
   var $part_bairro_;
   var $part_cidade_;
   var $part_uf_;
   var $part_ddd_01_;
   var $part_fone_01_;
   var $part_ddd_02_;
   var $part_fone_02_;
   var $part_ddd_03_;
   var $part_fone_03_;
   var $part_ddd_fax_;
   var $part_fax_;
   var $part_ddd_celular_01_;
   var $part_celeular_01_;
   var $part_ddd_celular_02_;
   var $part_celular_02_;
   var $part_fone_internacional_;
   var $part_email_;
   var $part_dt_nasc_;
   var $part_rg_;
   var $part_passaporte_;
   var $part_validade_pass_;
   var $part_passaporte_estrangeiro_;
   var $part_ind_voucher_;
   var $part_num_voucher_;
   var $part_tam_camisa_;
   var $part_tam_calcado_;
   var $part_idioma_;
   var $part_filiacao_;
   var $part_pais_;
   var $part_nome_secretaria_;
   var $part_email_secretaria_;
   var $part_cod_usuario_;
   var $part_dt_cadastro_;
   var $part_dt_cadastro__hora;
   var $part_dt_alteracao_;
   var $part_dt_alteracao__hora;
   var $part_contato_rsvp_;
   var $part_dt_alt_contato_rsvp_;
   var $part_dt_alt_contato_rsvp__hora;
   var $part_presenca_;
   var $part_dt_alt_presenca_;
   var $part_dt_alt_presenca__hora;
   var $part_solicit_especial_;
   var $part_dt_solicit_especial_;
   var $part_dt_solicit_especial__hora;
   var $part_programacao_;
   var $part_dt_programacao_;
   var $part_dt_programacao__hora;
   var $part_aereo_;
   var $part_dt_aereo_;
   var $part_dt_aereo__hora;
   var $part_hospedagem_;
   var $par_dt_hospedagem_;
   var $par_dt_hospedagem__hora;
   var $part_dt_transfer_;
   var $part_dt_transfer__hora;
   var $part_opcionais_;
   var $part_dt_opcionais_;
   var $part_dt_opcionais__hora;
   var $part_notas_;
   var $part_confirm_viagem_;
   var $part_convite_;
   var $part_concluido_;
   var $part_transfer_;
   var $part_convite_enviado_;
   var $part_destaque_negrito_;
   var $part_atendimento_;
   var $part_save_the_date_;
   var $part_arq_save_;
   var $part_arq_convite_;
   var $part_fumante_;
   var $part_restricao_alimentar_;
   var $part_acompanhado_;
   var $part_acompanhado_hotel_;
   var $part_acom_completo_;
   var $part_acom_incompleto_;
   var $part_incompleto_;
   var $part_aereo_ok_;
   var $part_bloqueio_id_;
   var $part_hotel_;
   var $part_anotacoes_;
   var $guarda_cod_substituto_;
   var $part_cpf_informado_;
   var $part_cv_obs_;
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
   var $form_vert_form_participantes_rsvp_ar = array();
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
          if (isset($this->NM_ajax_info['param']['nmgp_refresh_row']))
          {
              $this->nmgp_refresh_row = $this->NM_ajax_info['param']['nmgp_refresh_row'];
          }
          if (isset($this->NM_ajax_info['param']['nmgp_url_saida']))
          {
              $this->nmgp_url_saida = $this->NM_ajax_info['param']['nmgp_url_saida'];
          }
          if (isset($this->NM_ajax_info['param']['nome_pessoa_']))
          {
              $this->nome_pessoa_ = $this->NM_ajax_info['param']['nome_pessoa_'];
          }
          if (isset($this->NM_ajax_info['param']['part_celeular_01_']))
          {
              $this->part_celeular_01_ = $this->NM_ajax_info['param']['part_celeular_01_'];
          }
          if (isset($this->NM_ajax_info['param']['part_clube_']))
          {
              $this->part_clube_ = $this->NM_ajax_info['param']['part_clube_'];
          }
          if (isset($this->NM_ajax_info['param']['part_cpf_']))
          {
              $this->part_cpf_ = $this->NM_ajax_info['param']['part_cpf_'];
          }
          if (isset($this->NM_ajax_info['param']['part_ddd_celular_01_']))
          {
              $this->part_ddd_celular_01_ = $this->NM_ajax_info['param']['part_ddd_celular_01_'];
          }
          if (isset($this->NM_ajax_info['param']['part_dt_nasc_']))
          {
              $this->part_dt_nasc_ = $this->NM_ajax_info['param']['part_dt_nasc_'];
          }
          if (isset($this->NM_ajax_info['param']['part_empresa_']))
          {
              $this->part_empresa_ = $this->NM_ajax_info['param']['part_empresa_'];
          }
          if (isset($this->NM_ajax_info['param']['part_grupo_']))
          {
              $this->part_grupo_ = $this->NM_ajax_info['param']['part_grupo_'];
          }
          if (isset($this->NM_ajax_info['param']['part_id_evento_']))
          {
              $this->part_id_evento_ = $this->NM_ajax_info['param']['part_id_evento_'];
          }
          if (isset($this->NM_ajax_info['param']['part_id_evento_publico_']))
          {
              $this->part_id_evento_publico_ = $this->NM_ajax_info['param']['part_id_evento_publico_'];
          }
          if (isset($this->NM_ajax_info['param']['part_id_evento_regional_']))
          {
              $this->part_id_evento_regional_ = $this->NM_ajax_info['param']['part_id_evento_regional_'];
          }
          if (isset($this->NM_ajax_info['param']['part_sexo_']))
          {
              $this->part_sexo_ = $this->NM_ajax_info['param']['part_sexo_'];
          }
          if (isset($this->NM_ajax_info['param']['part_tam_calcado_']))
          {
              $this->part_tam_calcado_ = $this->NM_ajax_info['param']['part_tam_calcado_'];
          }
          if (isset($this->NM_ajax_info['param']['part_tam_camisa_']))
          {
              $this->part_tam_camisa_ = $this->NM_ajax_info['param']['part_tam_camisa_'];
          }
          if (isset($this->NM_ajax_info['param']['part_uf_']))
          {
              $this->part_uf_ = $this->NM_ajax_info['param']['part_uf_'];
          }
          if (isset($this->NM_ajax_info['param']['participante_id_']))
          {
              $this->participante_id_ = $this->NM_ajax_info['param']['participante_id_'];
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
      $this->sc_conv_var['participante_id'] = "participante_id_";
      $this->sc_conv_var['part_ativo'] = "part_ativo_";
      $this->sc_conv_var['part_sexo'] = "part_sexo_";
      $this->sc_conv_var['part_cpf'] = "part_cpf_";
      $this->sc_conv_var['nome_pessoa'] = "nome_pessoa_";
      $this->sc_conv_var['part_cpf_substituto'] = "part_cpf_substituto_";
      $this->sc_conv_var['part_crnm'] = "part_crnm_";
      $this->sc_conv_var['part_tipo'] = "part_tipo_";
      $this->sc_conv_var['part_nome_cracha'] = "part_nome_cracha_";
      $this->sc_conv_var['part_id_evento'] = "part_id_evento_";
      $this->sc_conv_var['part_id_evento_publico'] = "part_id_evento_publico_";
      $this->sc_conv_var['part_id_evento_regional'] = "part_id_evento_regional_";
      $this->sc_conv_var['part_tipo_pessoa'] = "part_tipo_pessoa_";
      $this->sc_conv_var['part_substituido'] = "part_substituido_";
      $this->sc_conv_var['part_substituto'] = "part_substituto_";
      $this->sc_conv_var['part_cod_substituto'] = "part_cod_substituto_";
      $this->sc_conv_var['part_nome_substituto'] = "part_nome_substituto_";
      $this->sc_conv_var['part_sexo_substituto'] = "part_sexo_substituto_";
      $this->sc_conv_var['part_cod_substituido'] = "part_cod_substituido_";
      $this->sc_conv_var['part_nome_substituido'] = "part_nome_substituido_";
      $this->sc_conv_var['part_grupo'] = "part_grupo_";
      $this->sc_conv_var['part_clube'] = "part_clube_";
      $this->sc_conv_var['part_empresa'] = "part_empresa_";
      $this->sc_conv_var['part_cep'] = "part_cep_";
      $this->sc_conv_var['part_departamento'] = "part_departamento_";
      $this->sc_conv_var['part_cargo'] = "part_cargo_";
      $this->sc_conv_var['part_logradouro'] = "part_logradouro_";
      $this->sc_conv_var['part_numero'] = "part_numero_";
      $this->sc_conv_var['part_complemento'] = "part_complemento_";
      $this->sc_conv_var['part_bairro'] = "part_bairro_";
      $this->sc_conv_var['part_cidade'] = "part_cidade_";
      $this->sc_conv_var['part_uf'] = "part_uf_";
      $this->sc_conv_var['part_ddd_01'] = "part_ddd_01_";
      $this->sc_conv_var['part_fone_01'] = "part_fone_01_";
      $this->sc_conv_var['part_ddd_02'] = "part_ddd_02_";
      $this->sc_conv_var['part_fone_02'] = "part_fone_02_";
      $this->sc_conv_var['part_ddd_03'] = "part_ddd_03_";
      $this->sc_conv_var['part_fone_03'] = "part_fone_03_";
      $this->sc_conv_var['part_ddd_fax'] = "part_ddd_fax_";
      $this->sc_conv_var['part_fax'] = "part_fax_";
      $this->sc_conv_var['part_ddd_celular_01'] = "part_ddd_celular_01_";
      $this->sc_conv_var['part_celeular_01'] = "part_celeular_01_";
      $this->sc_conv_var['part_ddd_celular_02'] = "part_ddd_celular_02_";
      $this->sc_conv_var['part_celular_02'] = "part_celular_02_";
      $this->sc_conv_var['part_fone_internacional'] = "part_fone_internacional_";
      $this->sc_conv_var['part_email'] = "part_email_";
      $this->sc_conv_var['part_dt_nasc'] = "part_dt_nasc_";
      $this->sc_conv_var['part_rg'] = "part_rg_";
      $this->sc_conv_var['part_passaporte'] = "part_passaporte_";
      $this->sc_conv_var['part_validade_pass'] = "part_validade_pass_";
      $this->sc_conv_var['part_passaporte_estrangeiro'] = "part_passaporte_estrangeiro_";
      $this->sc_conv_var['part_ind_voucher'] = "part_ind_voucher_";
      $this->sc_conv_var['part_num_voucher'] = "part_num_voucher_";
      $this->sc_conv_var['part_tam_camisa'] = "part_tam_camisa_";
      $this->sc_conv_var['part_tam_calcado'] = "part_tam_calcado_";
      $this->sc_conv_var['part_idioma'] = "part_idioma_";
      $this->sc_conv_var['part_filiacao'] = "part_filiacao_";
      $this->sc_conv_var['part_pais'] = "part_pais_";
      $this->sc_conv_var['part_nome_secretaria'] = "part_nome_secretaria_";
      $this->sc_conv_var['part_email_secretaria'] = "part_email_secretaria_";
      $this->sc_conv_var['part_cod_usuario'] = "part_cod_usuario_";
      $this->sc_conv_var['part_dt_cadastro'] = "part_dt_cadastro_";
      $this->sc_conv_var['part_dt_alteracao'] = "part_dt_alteracao_";
      $this->sc_conv_var['part_contato_rsvp'] = "part_contato_rsvp_";
      $this->sc_conv_var['part_dt_alt_contato_rsvp'] = "part_dt_alt_contato_rsvp_";
      $this->sc_conv_var['part_presenca'] = "part_presenca_";
      $this->sc_conv_var['part_dt_alt_presenca'] = "part_dt_alt_presenca_";
      $this->sc_conv_var['part_solicit_especial'] = "part_solicit_especial_";
      $this->sc_conv_var['part_dt_solicit_especial'] = "part_dt_solicit_especial_";
      $this->sc_conv_var['part_programacao'] = "part_programacao_";
      $this->sc_conv_var['part_dt_programacao'] = "part_dt_programacao_";
      $this->sc_conv_var['part_aereo'] = "part_aereo_";
      $this->sc_conv_var['part_dt_aereo'] = "part_dt_aereo_";
      $this->sc_conv_var['part_hospedagem'] = "part_hospedagem_";
      $this->sc_conv_var['par_dt_hospedagem'] = "par_dt_hospedagem_";
      $this->sc_conv_var['part_dt_transfer'] = "part_dt_transfer_";
      $this->sc_conv_var['part_opcionais'] = "part_opcionais_";
      $this->sc_conv_var['part_dt_opcionais'] = "part_dt_opcionais_";
      $this->sc_conv_var['part_notas'] = "part_notas_";
      $this->sc_conv_var['part_confirm_viagem'] = "part_confirm_viagem_";
      $this->sc_conv_var['part_convite'] = "part_convite_";
      $this->sc_conv_var['part_concluido'] = "part_concluido_";
      $this->sc_conv_var['part_transfer'] = "part_transfer_";
      $this->sc_conv_var['part_convite_enviado'] = "part_convite_enviado_";
      $this->sc_conv_var['part_destaque_negrito'] = "part_destaque_negrito_";
      $this->sc_conv_var['part_atendimento'] = "part_atendimento_";
      $this->sc_conv_var['part_save_the_date'] = "part_save_the_date_";
      $this->sc_conv_var['part_arq_save'] = "part_arq_save_";
      $this->sc_conv_var['part_arq_convite'] = "part_arq_convite_";
      $this->sc_conv_var['part_fumante'] = "part_fumante_";
      $this->sc_conv_var['part_restricao_alimentar'] = "part_restricao_alimentar_";
      $this->sc_conv_var['part_acompanhado'] = "part_acompanhado_";
      $this->sc_conv_var['part_acompanhado_hotel'] = "part_acompanhado_hotel_";
      $this->sc_conv_var['part_acom_completo'] = "part_acom_completo_";
      $this->sc_conv_var['part_acom_incompleto'] = "part_acom_incompleto_";
      $this->sc_conv_var['part_incompleto'] = "part_incompleto_";
      $this->sc_conv_var['part_aereo_ok'] = "part_aereo_ok_";
      $this->sc_conv_var['part_bloqueio_id'] = "part_bloqueio_id_";
      $this->sc_conv_var['part_hotel'] = "part_hotel_";
      $this->sc_conv_var['part_anotacoes'] = "part_anotacoes_";
      $this->sc_conv_var['guarda_cod_substituto'] = "guarda_cod_substituto_";
      $this->sc_conv_var['part_cpf_informado'] = "part_cpf_informado_";
      $this->sc_conv_var['part_cv_obs'] = "part_cv_obs_";
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
          $_SESSION['sc_session'][$script_case_init]['form_participantes_rsvp_ar']['Refresh_aba_menu'] = $this->Refresh_aba_menu;
      }
      if (isset($this->nmgp_opcao) && $this->nmgp_opcao == "reload_novo") {
          $_POST['nmgp_opcao'] = "novo";
          $this->nmgp_opcao    = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_participantes_rsvp_ar']['opcao']   = "novo";
          $_SESSION['sc_session'][$script_case_init]['form_participantes_rsvp_ar']['opc_ant'] = "inicio";
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_participantes_rsvp_ar']['embutida_parms']))
      { 
          $this->nmgp_parms = $_SESSION['sc_session'][$script_case_init]['form_participantes_rsvp_ar']['embutida_parms'];
          unset($_SESSION['sc_session'][$script_case_init]['form_participantes_rsvp_ar']['embutida_parms']);
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
                 nm_limpa_str_form_participantes_rsvp_ar($cadapar[1]);
                 if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                 $Tmp_par = $cadapar[0];
                 $this->$Tmp_par = $cadapar[1];
                 if ($cadapar[0] == "participante_id_")
                 {
                     $this->NM_where_filter .= (empty($this->NM_where_filter)) ? "(" : " and ";
                     $this->NM_where_filter .= "participante_id = " . $this->participante_id_;
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
              $_SESSION['sc_session'][$script_case_init]['form_participantes_rsvp_ar']['inside_nested_iframe'] = true;
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
              $_SESSION['sc_session'][$script_case_init]['form_participantes_rsvp_ar']['where_filter_form'] = $this->NM_where_filter_form;
              unset($_SESSION['sc_session'][$script_case_init]['form_participantes_rsvp_ar']['total']);
          }
          if (isset($this->sc_redir_atualiz))
          {
              $_SESSION['sc_session'][$script_case_init]['form_participantes_rsvp_ar']['sc_redir_atualiz'] = $this->sc_redir_atualiz;
          }
          if (isset($this->sc_redir_insert))
          {
              $_SESSION['sc_session'][$script_case_init]['form_participantes_rsvp_ar']['sc_redir_insert'] = $this->sc_redir_insert;
              unset($_SESSION['sc_session'][$script_case_init]['form_participantes_rsvp_ar']['opc_ant']);
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
      elseif (isset($script_case_init) && !empty($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['form_participantes_rsvp_ar']['parms']))
      {
          if ((!isset($this->nmgp_opcao) || ($this->nmgp_opcao != "incluir" && $this->nmgp_opcao != "alterar" && $this->nmgp_opcao != "excluir" && $this->nmgp_opcao != "novo" && $this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")) && (!isset($this->NM_ajax_opcao) || $this->NM_ajax_opcao == ""))
          {
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['form_participantes_rsvp_ar']['parms']);
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
          $_SESSION['sc_session'][$script_case_init]['form_participantes_rsvp_ar']['nm_run_menu'] = 1;
      } 
      if (!$this->NM_ajax_flag && 'autocomp_' == substr($this->NM_ajax_opcao, 0, 9))
      {
          $this->NM_ajax_flag = true;
      }

      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      if (isset($this->nm_evt_ret_edit) && '' != $this->nm_evt_ret_edit)
      {
          $_SESSION['sc_session'][$script_case_init]['form_participantes_rsvp_ar']['lig_edit_lookup']     = true;
          $_SESSION['sc_session'][$script_case_init]['form_participantes_rsvp_ar']['lig_edit_lookup_cb']  = $this->nm_evt_ret_edit;
          $_SESSION['sc_session'][$script_case_init]['form_participantes_rsvp_ar']['lig_edit_lookup_row'] = isset($this->nm_evt_ret_row) ? $this->nm_evt_ret_row : '';
      }
      if (isset($_SESSION['sc_session'][$script_case_init]['form_participantes_rsvp_ar']['lig_edit_lookup']) && $_SESSION['sc_session'][$script_case_init]['form_participantes_rsvp_ar']['lig_edit_lookup'])
      {
          $this->lig_edit_lookup     = true;
          $this->lig_edit_lookup_cb  = $_SESSION['sc_session'][$script_case_init]['form_participantes_rsvp_ar']['lig_edit_lookup_cb'];
          $this->lig_edit_lookup_row = $_SESSION['sc_session'][$script_case_init]['form_participantes_rsvp_ar']['lig_edit_lookup_row'];
      }
      if (!$this->Ini)
      { 
          $this->Ini = new form_participantes_rsvp_ar_ini(); 
          $this->Ini->init();
          $this->nm_data = new nm_data("pt_br");
          $this->app_is_initializing = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['initialize'];
          $this->Db = $this->Ini->Db; 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['initialize']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['initialize'])
          {
              $_SESSION['scriptcase']['form_participantes_rsvp_ar']['contr_erro'] = 'on';
  date_default_timezone_set('America/Sao_Paulo');
echo '<h2>&nbsp;&nbsp;BRSVP Participantes</h2>';	

$params = array(
		'title' => 'Atenção!',
		'type' => 'warning',
		'timer' => '10000',
		'showConfirmButton' => 'false',
		'position' => 'center',
		'toast' => 'true'
		);

$this->nm_mens_alert[] = "Antes de realizar quaisquer modificações escolha o CÓDIGO DO EVENTO em: * Filtro Dinâmico! *"; $this->nm_params_alert[] = $params; if ($this->NM_ajax_flag) { $this->sc_ajax_alert("Antes de realizar quaisquer modificações escolha o CÓDIGO DO EVENTO em: * Filtro Dinâmico! *", $params); }$sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'form_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';
$_SESSION['scriptcase']['form_participantes_rsvp_ar']['contr_erro'] = 'off';
          }
          $this->Ini->init2();
      } 
      else 
      { 
         $this->nm_data = new nm_data("pt_br");
      } 
      $_SESSION['sc_session'][$script_case_init]['form_participantes_rsvp_ar']['upload_field_info'] = array();

      unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['masterValue']);
      $this->Change_Menu = false;
      $run_iframe = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] == "R")) ? true : false;
      if (!$run_iframe && isset($_SESSION['scriptcase']['menu_atual']) && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_call'] && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_outra_jan']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_participantes_rsvp_ar']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['form_participantes_rsvp_ar'];
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
          if ($this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_participantes_rsvp_ar']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_participantes_rsvp_ar']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('form_participantes_rsvp_ar') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['form_participantes_rsvp_ar']['label'] = "Ações Rápidas Participantes";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "form_participantes_rsvp_ar")
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


      $_SESSION['scriptcase']['error_icon']['form_participantes_rsvp_ar']  = "<img src=\"" . $this->Ini->path_icones . "/scriptcase__NM__btn__NM__scriptcase9_Rhino__NM__nm_scriptcase9_Rhino_error.png\" style=\"border-width: 0px\" align=\"top\">&nbsp;";
      $_SESSION['scriptcase']['error_close']['form_participantes_rsvp_ar'] = "<td>" . nmButtonOutput($this->arr_buttons, "berrm_clse", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "") . "</td>";

      $this->Embutida_proc = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_proc']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_proc'] : $this->Embutida_proc;
      $this->Embutida_form = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_form']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_form'] : $this->Embutida_form;
      $this->Embutida_call = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_call']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_call'] : $this->Embutida_call;

      $this->form_3versions_single = false;

       $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['table_refresh'] = false;

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_grid_edit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_grid_edit'])
      {
          $this->Grid_editavel = ('on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_grid_edit']) ? true : false;
      }
      if (isset($this->Grid_editavel) && $this->Grid_editavel)
      {
          $this->Embutida_form  = true;
          $this->Embutida_ronly = true;
      }
      $this->Embutida_multi = false;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_multi'])
      {
          $this->Grid_editavel  = false;
          $this->Embutida_form  = false;
          $this->Embutida_ronly = false;
          $this->Embutida_multi = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_tp_pag']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_tp_pag'])
      {
          $this->form_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_tp_pag'];
      }

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_form']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_form'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_form'] = $this->Embutida_form;
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_grid_edit'] = $this->Grid_editavel ? 'on' : 'off';
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_grid_edit']) || '' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_grid_edit'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_grid_edit'] = $this->Embutida_call;
      }

      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $this->nmgp_url_saida  = $nm_url_saida;
      $this->nmgp_form_show  = "on";
      $this->nmgp_form_empty = false;
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_valida.php", "C", "NM_Valida") ; 
      $teste_validade = new NM_Valida ;

      $this->loadFieldConfig();

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['first_time'])
      {
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['insert']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['new']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['update']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['delete']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['first']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['back']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['forward']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['last']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['qsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['dynsearch']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['summary']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['navpage']);
          unset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['goto']);
      }
      $this->NM_cancel_return_new = (isset($this->NM_cancel_return_new) && $this->NM_cancel_return_new == 1) ? "1" : "";
      $this->NM_cancel_insert_new = ((isset($this->NM_cancel_insert_new) && $this->NM_cancel_insert_new == 1) || $this->NM_cancel_return_new == 1) ? "document.F5.action='" . $nm_url_saida . "';" : "";
      if (isset($this->NM_btn_insert) && '' != $this->NM_btn_insert && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['insert']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['insert']))
      {
          if ('N' == $this->NM_btn_insert)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['insert'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['insert'] = 'on';
          }
      }
      if (isset($this->NM_btn_new) && 'N' == $this->NM_btn_new)
      {
          $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['new'] = 'off';
      }
      if (isset($this->NM_btn_update) && '' != $this->NM_btn_update && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['update']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['update']))
      {
          if ('N' == $this->NM_btn_update)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['update'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['update'] = 'on';
          }
      }
      if (isset($this->NM_btn_delete) && '' != $this->NM_btn_delete && (!isset($_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['delete']) || '' == $_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['delete']))
      {
          if ('N' == $this->NM_btn_delete)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['delete'] = 'off';
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['delete'] = 'on';
          }
      }
      if (isset($this->NM_btn_navega) && '' != $this->NM_btn_navega)
      {
          if ('N' == $this->NM_btn_navega)
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['first']     = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['back']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['forward']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['last']      = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['qsearch']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['dynsearch'] = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['summary']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['navpage']   = 'off';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['goto']      = 'off';
              $this->Nav_permite_ava = false;
              $this->Nav_permite_ret = false;
          }
          else
          {
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['first']     = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['back']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['forward']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['last']      = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['qsearch']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['dynsearch'] = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['summary']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['navpage']   = 'on';
              $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['goto']      = 'on';
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_orig'] = "";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_pesq']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_pesq'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_pesq_filtro'] = "";
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_pesq_filtro'];
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6)) {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['buttonStatus'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['iframe_filtro']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['iframe_filtro'] == "S")
      {
          $this->nmgp_botoes['exit'] = "off";
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['btn_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
          {
              $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
          }
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['insert']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['new']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['new'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['new'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['update']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['delete']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['delete'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['first']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['first'] != '')
      {
          $this->nmgp_botoes['first'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['first'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['back']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['back'] != '')
      {
          $this->nmgp_botoes['back'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['back'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['forward']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['forward'] != '')
      {
          $this->nmgp_botoes['forward'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['forward'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['last']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['last'] != '')
      {
          $this->nmgp_botoes['last'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['last'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['qsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['qsearch'] != '')
      {
          $this->nmgp_botoes['qsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['qsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['dynsearch']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['dynsearch'] != '')
      {
          $this->nmgp_botoes['dynsearch'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['dynsearch'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['summary']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['summary'] != '')
      {
          $this->nmgp_botoes['summary'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['summary'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['navpage']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['navpage'] != '')
      {
          $this->nmgp_botoes['navpage'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['navpage'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['goto']) && $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['goto'] != '')
      {
          $this->nmgp_botoes['goto'] = $_SESSION['scriptcase']['sc_apl_conf_lig']['form_participantes_rsvp_ar']['goto'];
      }

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_form_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_form_insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_form_insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_form_insert'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_form_update']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_form_update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_form_update'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_form_delete']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_form_delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_form_delete'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_form_btn_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_form_btn_nav'] != '')
      {
          $this->nmgp_botoes['first']   = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['back']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['forward'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_form_btn_nav'];
          $this->nmgp_botoes['last']    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_form_btn_nav'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['insert']) && $_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['insert'] != '')
      {
          $this->nmgp_botoes['new']    = $_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['insert'];
          $this->nmgp_botoes['insert'] = $_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['insert'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['update']) && $_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['update'] != '')
      {
          $this->nmgp_botoes['update'] = $_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['update'];
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['delete']) && $_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['delete'] != '')
      {
          $this->nmgp_botoes['delete'] = $_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['delete'];
      }

      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_hidden[$NM_cada_field . "_"] = $NM_cada_opc;
              $this->NM_ajax_info['fieldDisplay'][$NM_cada_field . "_"] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['field_readonly']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['field_readonly']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['field_readonly'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->nmgp_cmp_readonly[$NM_cada_field . "_"] = "on";
              $this->NM_ajax_info['readOnly'][$NM_cada_field . "_"] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['under_dashboard'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['maximized']) {
          $tmpDashboardApp = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['dashboard_app'];
          if (isset($_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_participantes_rsvp_ar'])) {
              $tmpDashboardButtons = $_SESSION['scriptcase']['dashboard_toolbar'][$tmpDashboardApp]['form_participantes_rsvp_ar'];

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
              if (in_array("form_participantes_rsvp_ar", $apls_aba))
              {
                  $this->aba_iframe = true;
                  break;
              }
          }
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
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
              include_once($this->Ini->path_embutida . 'form_participantes_rsvp_ar/form_participantes_rsvp_ar_calendar.php');
          }
          else
          { 
              include_once($this->Ini->path_aplicacao . 'form_participantes_rsvp_ar_calendar.php');
          }
          exit;
      }

      if (is_file($this->Ini->path_aplicacao . 'form_participantes_rsvp_ar_help.txt'))
      {
          $arr_link_webhelp = file($this->Ini->path_aplicacao . 'form_participantes_rsvp_ar_help.txt');
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
          require_once($this->Ini->path_embutida . 'form_participantes_rsvp_ar/form_participantes_rsvp_ar_erro.class.php');
      }
      else
      { 
          require_once($this->Ini->path_aplicacao . "form_participantes_rsvp_ar_erro.class.php"); 
      }
      $this->Erro      = new form_participantes_rsvp_ar_erro();
      $this->Erro->Ini = $this->Ini;
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_max_reg']) && strtolower($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_max_reg']) == "all")
      {
          $this->form_paginacao = "total";
      }
      $this->proc_fast_search = false;
      if ($this->nmgp_opcao == "fast_search")  
      {
          $this->SC_fast_search($this->nmgp_fast_search, $this->nmgp_cond_fast_search, $this->nmgp_arg_fast_search);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['opcao'] = "inicio";
          $this->nmgp_opcao = "inicio";
          $this->proc_fast_search = true;
      } 
      if ($this->nmgp_opcao == "dyn_search" || $this->nmgp_opcao == "dyn_search_clear")  
      {
          $this->proc_fast_search = true;
          if ($this->nmgp_opcao == "dyn_search_clear")  
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_and_or']);
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_cache']);
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_filter']);
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['total']);
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['cond_pesq']);
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search']);
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['cond_dyn_search']);
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_detal'])) 
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_detal'];
              }
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['empty_filter'])
              {
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['empty_filter']);
                  $this->NM_ajax_info['empty_filter'] = 'ok';
                  form_participantes_rsvp_ar_pack_ajax_response();
                  exit;
              }
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_clear'] = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_refresh'] = array();
              $this->html_dynamic_search();
          } 
          else
          {
              $this->SC_proc_dyn_search($this->nmgp_arg_dyn_search);
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['opcao'] = "inicio";
          $this->nmgp_opcao = "inicio";
      } 
      if ((!isset($nm_opc_lookup) || $nm_opc_lookup != "lookup") && (!isset($nm_opc_php) || $nm_opc_php != "formphp"))
      { 
         if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['opcao']))
         { 
             if ($this->participante_id_ != "")   
             { 
                 $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['opcao'] = "igual" ;  
             }   
         }   
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['opcao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['opcao']) && empty($this->nmgp_refresh_fields))
      {
          $this->nmgp_opcao = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['opcao'];  
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['opcao'] = "" ;  
          if ($this->nmgp_opcao == "edit_novo")  
          {
             $this->nmgp_opcao = "novo";
             $this->nm_flag_saida_novo = "S";
          }
      } 
      $this->nm_Start_new = false;
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['start'] == 'new')
      {
          $this->nmgp_opcao = "novo";
          $this->nm_Start_new = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['opcao'] = "novo";
          unset($_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['start']);
      }
      if ($this->nmgp_opcao == "igual")  
      {
          $this->nmgp_opc_ant = $this->nmgp_opcao;
      } 
      else
      {
          $this->nmgp_opc_ant = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['opc_ant'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['opc_ant'] : "";
      } 
      if ($this->nmgp_opcao == "recarga" || $this->nmgp_opcao == "muda_form")  
      {
          $this->nmgp_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['botoes'];
          $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['inicio'];
          $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['total'] != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['final'];
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
      $_SESSION['scriptcase']['form_participantes_rsvp_ar']['contr_erro'] = 'on';
  date_default_timezone_set('America/Sao_Paulo');
$this->NM_ajax_info['buttonDisplay']['new'] = $this->nmgp_botoes["new"] = 'off';;
$_SESSION['scriptcase']['form_participantes_rsvp_ar']['contr_erro'] = 'off'; 
      }
            if ('ajax_check_file' == $this->nmgp_opcao ){
                 ob_start(); 
                 global $bol_api_prod; 
                 $bol_api_prod = true; 
                 if (isset($_SESSION['scriptcase']['form_participantes_rsvp_ar']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['form_participantes_rsvp_ar']['glo_nm_conexao'])) 
                 { 
                     $bol_api_prod = false;
                 } 
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_POST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

            $out1_img_cache = $_SESSION['scriptcase']['form_participantes_rsvp_ar']['glo_nm_path_imag_temp'] . $file_name;
            $orig_img = $_SESSION['scriptcase']['form_participantes_rsvp_ar']['glo_nm_path_imag_temp']. '/sc_'.md5(date('YmdHis').basename($_POST['AjaxCheckImg'])).'.gif';
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
          if ($GLOBALS['F'] == "part_id_evento_")
          { 
              $nm_parms   = substr($GLOBALS['P0'], 1, strlen($GLOBALS['P0']) - 2);
              $array_vars = explode(",", $nm_parms);
              $this->part_id_evento_ = $array_vars[0];
              $part_id_evento_       = $this->part_id_evento_;
              nm_limpa_numero($part_id_evento_, $this->field_config['part_id_evento_']['symbol_grp']); 
              $this->part_id_evento_       = $part_id_evento_;
              $this->lookup_part_id_evento_($conteudo);
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
      //-- part_id_evento_
      $this->field_config['part_id_evento_']               = array();
      $this->field_config['part_id_evento_']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['part_id_evento_']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['part_id_evento_']['symbol_dec'] = '';
      $this->field_config['part_id_evento_']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['part_id_evento_']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- part_id_evento_publico_
      $this->field_config['part_id_evento_publico_']               = array();
      $this->field_config['part_id_evento_publico_']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['part_id_evento_publico_']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['part_id_evento_publico_']['symbol_dec'] = '';
      $this->field_config['part_id_evento_publico_']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['part_id_evento_publico_']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- part_dt_nasc_
      $this->field_config['part_dt_nasc_']                 = array();
      $this->field_config['part_dt_nasc_']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['part_dt_nasc_']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['part_dt_nasc_']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'part_dt_nasc_');
      //-- participante_id_
      $this->field_config['participante_id_']               = array();
      $this->field_config['participante_id_']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['participante_id_']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['participante_id_']['symbol_dec'] = '';
      $this->field_config['participante_id_']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['participante_id_']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- part_validade_pass_
      $this->field_config['part_validade_pass_']                 = array();
      $this->field_config['part_validade_pass_']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['part_validade_pass_']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['part_validade_pass_']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'part_validade_pass_');
      //-- part_cod_usuario_
      $this->field_config['part_cod_usuario_']               = array();
      $this->field_config['part_cod_usuario_']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['part_cod_usuario_']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['part_cod_usuario_']['symbol_dec'] = '';
      $this->field_config['part_cod_usuario_']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['part_cod_usuario_']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
      //-- part_dt_cadastro_
      $this->field_config['part_dt_cadastro_']                 = array();
      $this->field_config['part_dt_cadastro_']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['part_dt_cadastro_']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['part_dt_cadastro_']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['part_dt_cadastro_']['date_display'] = "ddmmaaaa;hhiiss";
      $this->new_date_format('DH', 'part_dt_cadastro_');
      //-- part_dt_alteracao_
      $this->field_config['part_dt_alteracao_']                 = array();
      $this->field_config['part_dt_alteracao_']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['part_dt_alteracao_']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['part_dt_alteracao_']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['part_dt_alteracao_']['date_display'] = "ddmmaaaa;hhiiss";
      $this->new_date_format('DH', 'part_dt_alteracao_');
      //-- part_dt_alt_contato_rsvp_
      $this->field_config['part_dt_alt_contato_rsvp_']                 = array();
      $this->field_config['part_dt_alt_contato_rsvp_']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['part_dt_alt_contato_rsvp_']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['part_dt_alt_contato_rsvp_']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['part_dt_alt_contato_rsvp_']['date_display'] = "ddmmaaaa;hhiiss";
      $this->new_date_format('DH', 'part_dt_alt_contato_rsvp_');
      //-- part_dt_alt_presenca_
      $this->field_config['part_dt_alt_presenca_']                 = array();
      $this->field_config['part_dt_alt_presenca_']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['part_dt_alt_presenca_']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['part_dt_alt_presenca_']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['part_dt_alt_presenca_']['date_display'] = "ddmmaaaa;hhiiss";
      $this->new_date_format('DH', 'part_dt_alt_presenca_');
      //-- part_dt_solicit_especial_
      $this->field_config['part_dt_solicit_especial_']                 = array();
      $this->field_config['part_dt_solicit_especial_']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['part_dt_solicit_especial_']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['part_dt_solicit_especial_']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['part_dt_solicit_especial_']['date_display'] = "ddmmaaaa;hhiiss";
      $this->new_date_format('DH', 'part_dt_solicit_especial_');
      //-- part_dt_programacao_
      $this->field_config['part_dt_programacao_']                 = array();
      $this->field_config['part_dt_programacao_']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['part_dt_programacao_']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['part_dt_programacao_']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['part_dt_programacao_']['date_display'] = "ddmmaaaa;hhiiss";
      $this->new_date_format('DH', 'part_dt_programacao_');
      //-- part_dt_aereo_
      $this->field_config['part_dt_aereo_']                 = array();
      $this->field_config['part_dt_aereo_']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['part_dt_aereo_']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['part_dt_aereo_']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['part_dt_aereo_']['date_display'] = "ddmmaaaa;hhiiss";
      $this->new_date_format('DH', 'part_dt_aereo_');
      //-- par_dt_hospedagem_
      $this->field_config['par_dt_hospedagem_']                 = array();
      $this->field_config['par_dt_hospedagem_']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['par_dt_hospedagem_']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['par_dt_hospedagem_']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['par_dt_hospedagem_']['date_display'] = "ddmmaaaa;hhiiss";
      $this->new_date_format('DH', 'par_dt_hospedagem_');
      //-- part_dt_transfer_
      $this->field_config['part_dt_transfer_']                 = array();
      $this->field_config['part_dt_transfer_']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['part_dt_transfer_']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['part_dt_transfer_']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['part_dt_transfer_']['date_display'] = "ddmmaaaa;hhiiss";
      $this->new_date_format('DH', 'part_dt_transfer_');
      //-- part_dt_opcionais_
      $this->field_config['part_dt_opcionais_']                 = array();
      $this->field_config['part_dt_opcionais_']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'] . ';' . $_SESSION['scriptcase']['reg_conf']['time_format'];
      $this->field_config['part_dt_opcionais_']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['part_dt_opcionais_']['time_sep']     = $_SESSION['scriptcase']['reg_conf']['time_sep'];
      $this->field_config['part_dt_opcionais_']['date_display'] = "ddmmaaaa;hhiiss";
      $this->new_date_format('DH', 'part_dt_opcionais_');
      //-- part_save_the_date_
      $this->field_config['part_save_the_date_']                 = array();
      $this->field_config['part_save_the_date_']['date_format']  = $_SESSION['scriptcase']['reg_conf']['date_format'];
      $this->field_config['part_save_the_date_']['date_sep']     = $_SESSION['scriptcase']['reg_conf']['date_sep'];
      $this->field_config['part_save_the_date_']['date_display'] = "ddmmaaaa";
      $this->new_date_format('DT', 'part_save_the_date_');
      //-- part_bloqueio_id_
      $this->field_config['part_bloqueio_id_']               = array();
      $this->field_config['part_bloqueio_id_']['symbol_grp'] = $_SESSION['scriptcase']['reg_conf']['grup_num'];
      $this->field_config['part_bloqueio_id_']['symbol_fmt'] = $_SESSION['scriptcase']['reg_conf']['num_group_digit'];
      $this->field_config['part_bloqueio_id_']['symbol_dec'] = '';
      $this->field_config['part_bloqueio_id_']['symbol_neg'] = $_SESSION['scriptcase']['reg_conf']['simb_neg'];
      $this->field_config['part_bloqueio_id_']['format_neg'] = $_SESSION['scriptcase']['reg_conf']['neg_num'];
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_max_reg'] = $this->nmgp_max_line;
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
      $this->Field_no_validate = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['Field_no_validate'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['Field_no_validate'] : array();
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['opc_edit'] = true;  
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
         form_participantes_rsvp_ar_pack_ajax_response();
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
         form_participantes_rsvp_ar_pack_ajax_response();
         exit;
      }
      if ($this->NM_ajax_flag && 'submit_form' == $this->NM_ajax_opcao)
      {
         if (isset($this->part_cpf_)) { $this->nm_limpa_alfa($this->part_cpf_); }
         if (isset($this->nome_pessoa_)) { $this->nm_limpa_alfa($this->nome_pessoa_); }
         if (isset($this->part_id_evento_)) { $this->nm_limpa_alfa($this->part_id_evento_); }
         if (isset($this->part_id_evento_publico_)) { $this->nm_limpa_alfa($this->part_id_evento_publico_); }
         if (isset($this->part_id_evento_regional_)) { $this->nm_limpa_alfa($this->part_id_evento_regional_); }
         if (isset($this->part_grupo_)) { $this->nm_limpa_alfa($this->part_grupo_); }
         if (isset($this->part_clube_)) { $this->nm_limpa_alfa($this->part_clube_); }
         if (isset($this->part_empresa_)) { $this->nm_limpa_alfa($this->part_empresa_); }
         if (isset($this->part_uf_)) { $this->nm_limpa_alfa($this->part_uf_); }
         if (isset($this->part_ddd_celular_01_)) { $this->nm_limpa_alfa($this->part_ddd_celular_01_); }
         if (isset($this->part_celeular_01_)) { $this->nm_limpa_alfa($this->part_celeular_01_); }
         if (isset($this->part_tam_camisa_)) { $this->nm_limpa_alfa($this->part_tam_camisa_); }
         if (isset($this->part_tam_calcado_)) { $this->nm_limpa_alfa($this->part_tam_calcado_); }
         if (isset($this->Sc_num_lin_alt) && $this->Sc_num_lin_alt > 0) 
         {
             $sc_seq_vert = $this->Sc_num_lin_alt;
         }
         if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_form'][$sc_seq_vert]))
         {
             $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_form'][$sc_seq_vert];
             $this->participante_id_ = $this->nmgp_dados_form['participante_id_']; 
             $this->part_ativo_ = $this->nmgp_dados_form['part_ativo_']; 
             $this->part_cpf_substituto_ = $this->nmgp_dados_form['part_cpf_substituto_']; 
             $this->part_crnm_ = $this->nmgp_dados_form['part_crnm_']; 
             $this->part_tipo_ = $this->nmgp_dados_form['part_tipo_']; 
             $this->part_nome_cracha_ = $this->nmgp_dados_form['part_nome_cracha_']; 
             $this->part_tipo_pessoa_ = $this->nmgp_dados_form['part_tipo_pessoa_']; 
             $this->part_substituido_ = $this->nmgp_dados_form['part_substituido_']; 
             $this->part_substituto_ = $this->nmgp_dados_form['part_substituto_']; 
             $this->part_cod_substituto_ = $this->nmgp_dados_form['part_cod_substituto_']; 
             $this->part_nome_substituto_ = $this->nmgp_dados_form['part_nome_substituto_']; 
             $this->part_sexo_substituto_ = $this->nmgp_dados_form['part_sexo_substituto_']; 
             $this->part_cod_substituido_ = $this->nmgp_dados_form['part_cod_substituido_']; 
             $this->part_nome_substituido_ = $this->nmgp_dados_form['part_nome_substituido_']; 
             $this->part_cep_ = $this->nmgp_dados_form['part_cep_']; 
             $this->part_departamento_ = $this->nmgp_dados_form['part_departamento_']; 
             $this->part_cargo_ = $this->nmgp_dados_form['part_cargo_']; 
             $this->part_logradouro_ = $this->nmgp_dados_form['part_logradouro_']; 
             $this->part_numero_ = $this->nmgp_dados_form['part_numero_']; 
             $this->part_complemento_ = $this->nmgp_dados_form['part_complemento_']; 
             $this->part_bairro_ = $this->nmgp_dados_form['part_bairro_']; 
             $this->part_cidade_ = $this->nmgp_dados_form['part_cidade_']; 
             $this->part_ddd_01_ = $this->nmgp_dados_form['part_ddd_01_']; 
             $this->part_fone_01_ = $this->nmgp_dados_form['part_fone_01_']; 
             $this->part_ddd_02_ = $this->nmgp_dados_form['part_ddd_02_']; 
             $this->part_fone_02_ = $this->nmgp_dados_form['part_fone_02_']; 
             $this->part_ddd_03_ = $this->nmgp_dados_form['part_ddd_03_']; 
             $this->part_fone_03_ = $this->nmgp_dados_form['part_fone_03_']; 
             $this->part_ddd_fax_ = $this->nmgp_dados_form['part_ddd_fax_']; 
             $this->part_fax_ = $this->nmgp_dados_form['part_fax_']; 
             $this->part_ddd_celular_02_ = $this->nmgp_dados_form['part_ddd_celular_02_']; 
             $this->part_celular_02_ = $this->nmgp_dados_form['part_celular_02_']; 
             $this->part_fone_internacional_ = $this->nmgp_dados_form['part_fone_internacional_']; 
             $this->part_email_ = $this->nmgp_dados_form['part_email_']; 
             $this->part_rg_ = $this->nmgp_dados_form['part_rg_']; 
             $this->part_passaporte_ = $this->nmgp_dados_form['part_passaporte_']; 
             $this->part_validade_pass_ = $this->nmgp_dados_form['part_validade_pass_']; 
             $this->part_passaporte_estrangeiro_ = $this->nmgp_dados_form['part_passaporte_estrangeiro_']; 
             $this->part_ind_voucher_ = $this->nmgp_dados_form['part_ind_voucher_']; 
             $this->part_num_voucher_ = $this->nmgp_dados_form['part_num_voucher_']; 
             $this->part_idioma_ = $this->nmgp_dados_form['part_idioma_']; 
             $this->part_filiacao_ = $this->nmgp_dados_form['part_filiacao_']; 
             $this->part_pais_ = $this->nmgp_dados_form['part_pais_']; 
             $this->part_nome_secretaria_ = $this->nmgp_dados_form['part_nome_secretaria_']; 
             $this->part_email_secretaria_ = $this->nmgp_dados_form['part_email_secretaria_']; 
             $this->part_cod_usuario_ = $this->nmgp_dados_form['part_cod_usuario_']; 
             $this->part_dt_cadastro_ = $this->nmgp_dados_form['part_dt_cadastro_']; 
             $this->part_dt_alteracao_ = $this->nmgp_dados_form['part_dt_alteracao_']; 
             $this->part_contato_rsvp_ = $this->nmgp_dados_form['part_contato_rsvp_']; 
             $this->part_dt_alt_contato_rsvp_ = $this->nmgp_dados_form['part_dt_alt_contato_rsvp_']; 
             $this->part_presenca_ = $this->nmgp_dados_form['part_presenca_']; 
             $this->part_dt_alt_presenca_ = $this->nmgp_dados_form['part_dt_alt_presenca_']; 
             $this->part_solicit_especial_ = $this->nmgp_dados_form['part_solicit_especial_']; 
             $this->part_dt_solicit_especial_ = $this->nmgp_dados_form['part_dt_solicit_especial_']; 
             $this->part_programacao_ = $this->nmgp_dados_form['part_programacao_']; 
             $this->part_dt_programacao_ = $this->nmgp_dados_form['part_dt_programacao_']; 
             $this->part_aereo_ = $this->nmgp_dados_form['part_aereo_']; 
             $this->part_dt_aereo_ = $this->nmgp_dados_form['part_dt_aereo_']; 
             $this->part_hospedagem_ = $this->nmgp_dados_form['part_hospedagem_']; 
             $this->par_dt_hospedagem_ = $this->nmgp_dados_form['par_dt_hospedagem_']; 
             $this->part_dt_transfer_ = $this->nmgp_dados_form['part_dt_transfer_']; 
             $this->part_opcionais_ = $this->nmgp_dados_form['part_opcionais_']; 
             $this->part_dt_opcionais_ = $this->nmgp_dados_form['part_dt_opcionais_']; 
             $this->part_notas_ = $this->nmgp_dados_form['part_notas_']; 
             $this->part_confirm_viagem_ = $this->nmgp_dados_form['part_confirm_viagem_']; 
             $this->part_convite_ = $this->nmgp_dados_form['part_convite_']; 
             $this->part_concluido_ = $this->nmgp_dados_form['part_concluido_']; 
             $this->part_transfer_ = $this->nmgp_dados_form['part_transfer_']; 
             $this->part_convite_enviado_ = $this->nmgp_dados_form['part_convite_enviado_']; 
             $this->part_destaque_negrito_ = $this->nmgp_dados_form['part_destaque_negrito_']; 
             $this->part_atendimento_ = $this->nmgp_dados_form['part_atendimento_']; 
             $this->part_save_the_date_ = $this->nmgp_dados_form['part_save_the_date_']; 
             $this->part_arq_save_ = $this->nmgp_dados_form['part_arq_save_']; 
             $this->part_arq_convite_ = $this->nmgp_dados_form['part_arq_convite_']; 
             $this->part_fumante_ = $this->nmgp_dados_form['part_fumante_']; 
             $this->part_restricao_alimentar_ = $this->nmgp_dados_form['part_restricao_alimentar_']; 
             $this->part_acompanhado_ = $this->nmgp_dados_form['part_acompanhado_']; 
             $this->part_acompanhado_hotel_ = $this->nmgp_dados_form['part_acompanhado_hotel_']; 
             $this->part_acom_completo_ = $this->nmgp_dados_form['part_acom_completo_']; 
             $this->part_acom_incompleto_ = $this->nmgp_dados_form['part_acom_incompleto_']; 
             $this->part_incompleto_ = $this->nmgp_dados_form['part_incompleto_']; 
             $this->part_aereo_ok_ = $this->nmgp_dados_form['part_aereo_ok_']; 
             $this->part_bloqueio_id_ = $this->nmgp_dados_form['part_bloqueio_id_']; 
             $this->part_hotel_ = $this->nmgp_dados_form['part_hotel_']; 
             $this->part_anotacoes_ = $this->nmgp_dados_form['part_anotacoes_']; 
             $this->guarda_cod_substituto_ = $this->nmgp_dados_form['guarda_cod_substituto_']; 
             $this->part_cpf_informado_ = $this->nmgp_dados_form['part_cpf_informado_']; 
             $this->part_cv_obs_ = $this->nmgp_dados_form['part_cv_obs_']; 
         }
         $this->controle_form_vert();
         if ($Campos_Crit != "" || !empty($Campos_Falta) || $this->Campos_Mens_erro != "")
         {
             $this->NM_rollback_db();
              if ($this->NM_ajax_flag)
              {
                  if (!isset($this->NM_ajax_info['errList']['geral_form_participantes_rsvp_ar']) || !is_array($this->NM_ajax_info['errList']['geral_form_participantes_rsvp_ar']))
                  {
                      $this->NM_ajax_info['errList']['geral_form_participantes_rsvp_ar'] = array();
                  }
                  if ($Campos_Crit != "")
                  {
                      $this->NM_ajax_info['errList']['geral_form_participantes_rsvp_ar'][] = $Campos_Crit;
                  }
                  if (!empty($Campos_Falta))
                  {
                      $this->NM_ajax_info['errList']['geral_form_participantes_rsvp_ar'][] = $this->Formata_Campos_Falta($Campos_Falta);
                  }
                  if ($this->Campos_Mens_erro != "")
                  {
                      $this->NM_ajax_info['errList']['geral_form_participantes_rsvp_ar'][] = $this->Campos_Mens_erro;
                  }
              }
         }
         else
         {
             $this->NM_commit_db();
         }
         if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form" && !$this->Apl_com_erro)
         {
             $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_teve_incl && empty($sc_todas_Crit))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_redir_atualiz'] == "ok")
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
         form_participantes_rsvp_ar_pack_ajax_response();
         exit;
      }
      if ($this->NM_ajax_flag && 'validate_' == substr($this->NM_ajax_opcao, 0, 9))
      {
         $Campos_Crit  = "";
         $Campos_Falta = array();
         $Campos_Erros = array();
          if ('validate_part_id_evento_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'part_id_evento_');
          }
          if ('validate_part_cpf_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'part_cpf_');
          }
          if ('validate_nome_pessoa_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'nome_pessoa_');
          }
          if ('validate_part_sexo_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'part_sexo_');
          }
          if ('validate_part_id_evento_publico_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'part_id_evento_publico_');
          }
          if ('validate_part_id_evento_regional_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'part_id_evento_regional_');
          }
          if ('validate_part_grupo_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'part_grupo_');
          }
          if ('validate_part_clube_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'part_clube_');
          }
          if ('validate_part_empresa_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'part_empresa_');
          }
          if ('validate_part_uf_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'part_uf_');
          }
          if ('validate_part_ddd_celular_01_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'part_ddd_celular_01_');
          }
          if ('validate_part_celeular_01_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'part_celeular_01_');
          }
          if ('validate_part_dt_nasc_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'part_dt_nasc_');
          }
          if ('validate_part_tam_camisa_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'part_tam_camisa_');
          }
          if ('validate_part_tam_calcado_' == $this->NM_ajax_opcao)
          {
              $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros, 'part_tam_calcado_');
          }
          form_participantes_rsvp_ar_pack_ajax_response();
          exit;
      }
      while ($sc_contr_vert > $sc_seq_vert) 
      { 
         $Campos_Crit  = "";
         $Campos_Falta = array();
         $Campos_Erros = array();
         $this->part_id_evento_ = $GLOBALS["part_id_evento_" . $sc_seq_vert]; 
         $this->part_cpf_ = $GLOBALS["part_cpf_" . $sc_seq_vert]; 
         $this->nome_pessoa_ = $GLOBALS["nome_pessoa_" . $sc_seq_vert]; 
         $this->part_sexo_ = $GLOBALS["part_sexo_" . $sc_seq_vert]; 
         $this->part_id_evento_publico_ = $GLOBALS["part_id_evento_publico_" . $sc_seq_vert]; 
         $this->part_id_evento_regional_ = $GLOBALS["part_id_evento_regional_" . $sc_seq_vert]; 
         $this->part_grupo_ = $GLOBALS["part_grupo_" . $sc_seq_vert]; 
         $this->part_clube_ = $GLOBALS["part_clube_" . $sc_seq_vert]; 
         $this->part_empresa_ = $GLOBALS["part_empresa_" . $sc_seq_vert]; 
         $this->part_uf_ = $GLOBALS["part_uf_" . $sc_seq_vert]; 
         $this->part_ddd_celular_01_ = $GLOBALS["part_ddd_celular_01_" . $sc_seq_vert]; 
         $this->part_celeular_01_ = $GLOBALS["part_celeular_01_" . $sc_seq_vert]; 
         $this->part_dt_nasc_ = $GLOBALS["part_dt_nasc_" . $sc_seq_vert]; 
         $this->part_tam_camisa_ = $GLOBALS["part_tam_camisa_" . $sc_seq_vert]; 
         $this->part_tam_calcado_ = $GLOBALS["part_tam_calcado_" . $sc_seq_vert]; 
         if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_form'][$sc_seq_vert]))
         {
             $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_form'][$sc_seq_vert];
             $this->participante_id_ = $this->nmgp_dados_form['participante_id_']; 
             $this->part_ativo_ = $this->nmgp_dados_form['part_ativo_']; 
             $this->part_cpf_substituto_ = $this->nmgp_dados_form['part_cpf_substituto_']; 
             $this->part_crnm_ = $this->nmgp_dados_form['part_crnm_']; 
             $this->part_tipo_ = $this->nmgp_dados_form['part_tipo_']; 
             $this->part_nome_cracha_ = $this->nmgp_dados_form['part_nome_cracha_']; 
             $this->part_tipo_pessoa_ = $this->nmgp_dados_form['part_tipo_pessoa_']; 
             $this->part_substituido_ = $this->nmgp_dados_form['part_substituido_']; 
             $this->part_substituto_ = $this->nmgp_dados_form['part_substituto_']; 
             $this->part_cod_substituto_ = $this->nmgp_dados_form['part_cod_substituto_']; 
             $this->part_nome_substituto_ = $this->nmgp_dados_form['part_nome_substituto_']; 
             $this->part_sexo_substituto_ = $this->nmgp_dados_form['part_sexo_substituto_']; 
             $this->part_cod_substituido_ = $this->nmgp_dados_form['part_cod_substituido_']; 
             $this->part_nome_substituido_ = $this->nmgp_dados_form['part_nome_substituido_']; 
             $this->part_cep_ = $this->nmgp_dados_form['part_cep_']; 
             $this->part_departamento_ = $this->nmgp_dados_form['part_departamento_']; 
             $this->part_cargo_ = $this->nmgp_dados_form['part_cargo_']; 
             $this->part_logradouro_ = $this->nmgp_dados_form['part_logradouro_']; 
             $this->part_numero_ = $this->nmgp_dados_form['part_numero_']; 
             $this->part_complemento_ = $this->nmgp_dados_form['part_complemento_']; 
             $this->part_bairro_ = $this->nmgp_dados_form['part_bairro_']; 
             $this->part_cidade_ = $this->nmgp_dados_form['part_cidade_']; 
             $this->part_ddd_01_ = $this->nmgp_dados_form['part_ddd_01_']; 
             $this->part_fone_01_ = $this->nmgp_dados_form['part_fone_01_']; 
             $this->part_ddd_02_ = $this->nmgp_dados_form['part_ddd_02_']; 
             $this->part_fone_02_ = $this->nmgp_dados_form['part_fone_02_']; 
             $this->part_ddd_03_ = $this->nmgp_dados_form['part_ddd_03_']; 
             $this->part_fone_03_ = $this->nmgp_dados_form['part_fone_03_']; 
             $this->part_ddd_fax_ = $this->nmgp_dados_form['part_ddd_fax_']; 
             $this->part_fax_ = $this->nmgp_dados_form['part_fax_']; 
             $this->part_ddd_celular_02_ = $this->nmgp_dados_form['part_ddd_celular_02_']; 
             $this->part_celular_02_ = $this->nmgp_dados_form['part_celular_02_']; 
             $this->part_fone_internacional_ = $this->nmgp_dados_form['part_fone_internacional_']; 
             $this->part_email_ = $this->nmgp_dados_form['part_email_']; 
             $this->part_rg_ = $this->nmgp_dados_form['part_rg_']; 
             $this->part_passaporte_ = $this->nmgp_dados_form['part_passaporte_']; 
             $this->part_validade_pass_ = $this->nmgp_dados_form['part_validade_pass_']; 
             $this->part_passaporte_estrangeiro_ = $this->nmgp_dados_form['part_passaporte_estrangeiro_']; 
             $this->part_ind_voucher_ = $this->nmgp_dados_form['part_ind_voucher_']; 
             $this->part_num_voucher_ = $this->nmgp_dados_form['part_num_voucher_']; 
             $this->part_idioma_ = $this->nmgp_dados_form['part_idioma_']; 
             $this->part_filiacao_ = $this->nmgp_dados_form['part_filiacao_']; 
             $this->part_pais_ = $this->nmgp_dados_form['part_pais_']; 
             $this->part_nome_secretaria_ = $this->nmgp_dados_form['part_nome_secretaria_']; 
             $this->part_email_secretaria_ = $this->nmgp_dados_form['part_email_secretaria_']; 
             $this->part_cod_usuario_ = $this->nmgp_dados_form['part_cod_usuario_']; 
             $this->part_dt_cadastro_ = $this->nmgp_dados_form['part_dt_cadastro_']; 
             $this->part_dt_alteracao_ = $this->nmgp_dados_form['part_dt_alteracao_']; 
             $this->part_contato_rsvp_ = $this->nmgp_dados_form['part_contato_rsvp_']; 
             $this->part_dt_alt_contato_rsvp_ = $this->nmgp_dados_form['part_dt_alt_contato_rsvp_']; 
             $this->part_presenca_ = $this->nmgp_dados_form['part_presenca_']; 
             $this->part_dt_alt_presenca_ = $this->nmgp_dados_form['part_dt_alt_presenca_']; 
             $this->part_solicit_especial_ = $this->nmgp_dados_form['part_solicit_especial_']; 
             $this->part_dt_solicit_especial_ = $this->nmgp_dados_form['part_dt_solicit_especial_']; 
             $this->part_programacao_ = $this->nmgp_dados_form['part_programacao_']; 
             $this->part_dt_programacao_ = $this->nmgp_dados_form['part_dt_programacao_']; 
             $this->part_aereo_ = $this->nmgp_dados_form['part_aereo_']; 
             $this->part_dt_aereo_ = $this->nmgp_dados_form['part_dt_aereo_']; 
             $this->part_hospedagem_ = $this->nmgp_dados_form['part_hospedagem_']; 
             $this->par_dt_hospedagem_ = $this->nmgp_dados_form['par_dt_hospedagem_']; 
             $this->part_dt_transfer_ = $this->nmgp_dados_form['part_dt_transfer_']; 
             $this->part_opcionais_ = $this->nmgp_dados_form['part_opcionais_']; 
             $this->part_dt_opcionais_ = $this->nmgp_dados_form['part_dt_opcionais_']; 
             $this->part_notas_ = $this->nmgp_dados_form['part_notas_']; 
             $this->part_confirm_viagem_ = $this->nmgp_dados_form['part_confirm_viagem_']; 
             $this->part_convite_ = $this->nmgp_dados_form['part_convite_']; 
             $this->part_concluido_ = $this->nmgp_dados_form['part_concluido_']; 
             $this->part_transfer_ = $this->nmgp_dados_form['part_transfer_']; 
             $this->part_convite_enviado_ = $this->nmgp_dados_form['part_convite_enviado_']; 
             $this->part_destaque_negrito_ = $this->nmgp_dados_form['part_destaque_negrito_']; 
             $this->part_atendimento_ = $this->nmgp_dados_form['part_atendimento_']; 
             $this->part_save_the_date_ = $this->nmgp_dados_form['part_save_the_date_']; 
             $this->part_arq_save_ = $this->nmgp_dados_form['part_arq_save_']; 
             $this->part_arq_convite_ = $this->nmgp_dados_form['part_arq_convite_']; 
             $this->part_fumante_ = $this->nmgp_dados_form['part_fumante_']; 
             $this->part_restricao_alimentar_ = $this->nmgp_dados_form['part_restricao_alimentar_']; 
             $this->part_acompanhado_ = $this->nmgp_dados_form['part_acompanhado_']; 
             $this->part_acompanhado_hotel_ = $this->nmgp_dados_form['part_acompanhado_hotel_']; 
             $this->part_acom_completo_ = $this->nmgp_dados_form['part_acom_completo_']; 
             $this->part_acom_incompleto_ = $this->nmgp_dados_form['part_acom_incompleto_']; 
             $this->part_incompleto_ = $this->nmgp_dados_form['part_incompleto_']; 
             $this->part_aereo_ok_ = $this->nmgp_dados_form['part_aereo_ok_']; 
             $this->part_bloqueio_id_ = $this->nmgp_dados_form['part_bloqueio_id_']; 
             $this->part_hotel_ = $this->nmgp_dados_form['part_hotel_']; 
             $this->part_anotacoes_ = $this->nmgp_dados_form['part_anotacoes_']; 
             $this->guarda_cod_substituto_ = $this->nmgp_dados_form['guarda_cod_substituto_']; 
             $this->part_cpf_informado_ = $this->nmgp_dados_form['part_cpf_informado_']; 
             $this->part_cv_obs_ = $this->nmgp_dados_form['part_cv_obs_']; 
         }
         if (isset($this->part_cpf_)) { $this->nm_limpa_alfa($this->part_cpf_); }
         if (isset($this->nome_pessoa_)) { $this->nm_limpa_alfa($this->nome_pessoa_); }
         if (isset($this->part_id_evento_)) { $this->nm_limpa_alfa($this->part_id_evento_); }
         if (isset($this->part_id_evento_publico_)) { $this->nm_limpa_alfa($this->part_id_evento_publico_); }
         if (isset($this->part_id_evento_regional_)) { $this->nm_limpa_alfa($this->part_id_evento_regional_); }
         if (isset($this->part_grupo_)) { $this->nm_limpa_alfa($this->part_grupo_); }
         if (isset($this->part_clube_)) { $this->nm_limpa_alfa($this->part_clube_); }
         if (isset($this->part_empresa_)) { $this->nm_limpa_alfa($this->part_empresa_); }
         if (isset($this->part_uf_)) { $this->nm_limpa_alfa($this->part_uf_); }
         if (isset($this->part_ddd_celular_01_)) { $this->nm_limpa_alfa($this->part_ddd_celular_01_); }
         if (isset($this->part_celeular_01_)) { $this->nm_limpa_alfa($this->part_celeular_01_); }
         if (isset($this->part_tam_camisa_)) { $this->nm_limpa_alfa($this->part_tam_camisa_); }
         if (isset($this->part_tam_calcado_)) { $this->nm_limpa_alfa($this->part_tam_calcado_); }
         if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_form'])) 
         {
            $this->nmgp_dados_form = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_form'][$sc_seq_vert];
         }
         if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'])) 
         {
            $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert];
         }
         if ($this->nmgp_opcao != "recarga" && (!in_array($sc_seq_vert, $sc_check_excl) && !in_array($sc_seq_vert, $sc_check_incl) ))
         { }
         else
         {
             $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_disabled'] = array();
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
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_id_evento_'] =  $this->part_id_evento_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cpf_'] =  $this->part_cpf_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['nome_pessoa_'] =  $this->nome_pessoa_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_sexo_'] =  $this->part_sexo_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_id_evento_publico_'] =  $this->part_id_evento_publico_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_id_evento_regional_'] =  $this->part_id_evento_regional_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_grupo_'] =  $this->part_grupo_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_clube_'] =  $this->part_clube_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_empresa_'] =  $this->part_empresa_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_uf_'] =  $this->part_uf_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ddd_celular_01_'] =  $this->part_ddd_celular_01_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_celeular_01_'] =  $this->part_celeular_01_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_nasc_'] =  $this->part_dt_nasc_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_tam_camisa_'] =  $this->part_tam_camisa_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_tam_calcado_'] =  $this->part_tam_calcado_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['participante_id_'] =  $this->participante_id_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ativo_'] =  $this->part_ativo_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cpf_substituto_'] =  $this->part_cpf_substituto_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_crnm_'] =  $this->part_crnm_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_tipo_'] =  $this->part_tipo_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_nome_cracha_'] =  $this->part_nome_cracha_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_tipo_pessoa_'] =  $this->part_tipo_pessoa_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_substituido_'] =  $this->part_substituido_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_substituto_'] =  $this->part_substituto_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cod_substituto_'] =  $this->part_cod_substituto_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_nome_substituto_'] =  $this->part_nome_substituto_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_sexo_substituto_'] =  $this->part_sexo_substituto_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cod_substituido_'] =  $this->part_cod_substituido_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_nome_substituido_'] =  $this->part_nome_substituido_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cep_'] =  $this->part_cep_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_departamento_'] =  $this->part_departamento_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cargo_'] =  $this->part_cargo_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_logradouro_'] =  $this->part_logradouro_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_numero_'] =  $this->part_numero_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_complemento_'] =  $this->part_complemento_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_bairro_'] =  $this->part_bairro_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cidade_'] =  $this->part_cidade_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ddd_01_'] =  $this->part_ddd_01_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_fone_01_'] =  $this->part_fone_01_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ddd_02_'] =  $this->part_ddd_02_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_fone_02_'] =  $this->part_fone_02_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ddd_03_'] =  $this->part_ddd_03_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_fone_03_'] =  $this->part_fone_03_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ddd_fax_'] =  $this->part_ddd_fax_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_fax_'] =  $this->part_fax_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ddd_celular_02_'] =  $this->part_ddd_celular_02_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_celular_02_'] =  $this->part_celular_02_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_fone_internacional_'] =  $this->part_fone_internacional_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_email_'] =  $this->part_email_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_rg_'] =  $this->part_rg_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_passaporte_'] =  $this->part_passaporte_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_validade_pass_'] =  $this->part_validade_pass_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_passaporte_estrangeiro_'] =  $this->part_passaporte_estrangeiro_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ind_voucher_'] =  $this->part_ind_voucher_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_num_voucher_'] =  $this->part_num_voucher_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_idioma_'] =  $this->part_idioma_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_filiacao_'] =  $this->part_filiacao_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_pais_'] =  $this->part_pais_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_nome_secretaria_'] =  $this->part_nome_secretaria_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_email_secretaria_'] =  $this->part_email_secretaria_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cod_usuario_'] =  $this->part_cod_usuario_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_cadastro_'] =  $this->part_dt_cadastro_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_cadastro__hora'] =  $this->part_dt_cadastro__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_alteracao_'] =  $this->part_dt_alteracao_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_alteracao__hora'] =  $this->part_dt_alteracao__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_contato_rsvp_'] =  $this->part_contato_rsvp_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_alt_contato_rsvp_'] =  $this->part_dt_alt_contato_rsvp_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_alt_contato_rsvp__hora'] =  $this->part_dt_alt_contato_rsvp__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_presenca_'] =  $this->part_presenca_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_alt_presenca_'] =  $this->part_dt_alt_presenca_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_alt_presenca__hora'] =  $this->part_dt_alt_presenca__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_solicit_especial_'] =  $this->part_solicit_especial_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_solicit_especial_'] =  $this->part_dt_solicit_especial_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_solicit_especial__hora'] =  $this->part_dt_solicit_especial__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_programacao_'] =  $this->part_programacao_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_programacao_'] =  $this->part_dt_programacao_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_programacao__hora'] =  $this->part_dt_programacao__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_aereo_'] =  $this->part_aereo_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_aereo_'] =  $this->part_dt_aereo_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_aereo__hora'] =  $this->part_dt_aereo__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_hospedagem_'] =  $this->part_hospedagem_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['par_dt_hospedagem_'] =  $this->par_dt_hospedagem_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['par_dt_hospedagem__hora'] =  $this->par_dt_hospedagem__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_transfer_'] =  $this->part_dt_transfer_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_transfer__hora'] =  $this->part_dt_transfer__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_opcionais_'] =  $this->part_opcionais_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_opcionais_'] =  $this->part_dt_opcionais_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_opcionais__hora'] =  $this->part_dt_opcionais__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_notas_'] =  $this->part_notas_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_confirm_viagem_'] =  $this->part_confirm_viagem_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_convite_'] =  $this->part_convite_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_concluido_'] =  $this->part_concluido_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_transfer_'] =  $this->part_transfer_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_convite_enviado_'] =  $this->part_convite_enviado_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_destaque_negrito_'] =  $this->part_destaque_negrito_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_atendimento_'] =  $this->part_atendimento_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_save_the_date_'] =  $this->part_save_the_date_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_arq_save_'] =  $this->part_arq_save_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_arq_convite_'] =  $this->part_arq_convite_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_fumante_'] =  $this->part_fumante_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_restricao_alimentar_'] =  $this->part_restricao_alimentar_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_acompanhado_'] =  $this->part_acompanhado_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_acompanhado_hotel_'] =  $this->part_acompanhado_hotel_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_acom_completo_'] =  $this->part_acom_completo_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_acom_incompleto_'] =  $this->part_acom_incompleto_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_incompleto_'] =  $this->part_incompleto_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_aereo_ok_'] =  $this->part_aereo_ok_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_bloqueio_id_'] =  $this->part_bloqueio_id_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_hotel_'] =  $this->part_hotel_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_anotacoes_'] =  $this->part_anotacoes_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['guarda_cod_substituto_'] =  $this->guarda_cod_substituto_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cpf_informado_'] =  $this->part_cpf_informado_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cv_obs_'] =  $this->part_cv_obs_; 
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
          $_SESSION['scriptcase']['form_participantes_rsvp_ar']['contr_erro'] = 'on';
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
	$acao = "SUBSTITUIÇÕES PARCIAIS PUB./REG.";
	$campo_id = '';
	$vl_campo_id = '';
	$campo_cpf = '';
	$vl_campo_cpf = '';
	$campo_evt = '';
	$vl_campo_evt = '';			
	$tabela = 'participantes_rsvp';
	$obs = '';
	
	$retLog = $this->GravaLog($hora_now,$ip_usuario,$id_usuario,$global_cpf,$modulo,$aplicacao,$acao,$campo_id,$vl_campo_id,$campo_cpf,$vl_campo_cpf,$campo_evt,$vl_campo_evt,$tabela,$obs,$sql_log);
	if ($retLog == false) {
		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Erro ao Gravar LOG";
 if ('submit_form' == $this->NM_ajax_opcao || 'event_' == substr($this->NM_ajax_opcao, 0, 6) || (isset($this->wizard_action) && 'change_step' == $this->wizard_action))
 {
  if (isset($this->wizard_action) && 'change_step' == $this->wizard_action) {
   $sErrorIndex = 'geral_form_participantes_rsvp_ar';
  } elseif ('submit_form' == $this->NM_ajax_opcao) {
   $sErrorIndex = 'geral_form_participantes_rsvp_ar';
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
$_SESSION['scriptcase']['form_participantes_rsvp_ar']['contr_erro'] = 'off'; 
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
          form_participantes_rsvp_ar_pack_ajax_response();
          exit;
      }
      if ($this->NM_ajax_flag && 'table_refresh' == $this->NM_ajax_opcao)
      {
          $this->nm_gera_html();
          $this->NM_ajax_info['tableRefresh'] = NM_charset_to_utf8($this->Table_refresh . $this->New_Line) . '</table>';
          $this->NM_ajax_info['navStatus']['ret'] = $this->Nav_permite_ret ? 'S' : 'N';
          $this->NM_ajax_info['navStatus']['ava'] = $this->Nav_permite_ava ? 'S' : 'N';
          $this->NM_ajax_info['rsSize'] = sizeof($this->form_vert_form_participantes_rsvp_ar);
          $this->NM_ajax_info['fldList']['participante_id_']['keyVal'] = sc_htmlentities($this->nmgp_dados_form['participante_id_']);
          $this->NM_close_db();
          form_participantes_rsvp_ar_pack_ajax_response();
          exit;
      }
      if ($this->NM_ajax_flag && 'event_' == substr($this->NM_ajax_opcao, 0, 6))
      {
          $this->nm_tira_formatacao();
          $this->nm_converte_datas();
          if ('event_part_id_evento_publico__onchange' == $this->NM_ajax_opcao)
          {
              $this->part_id_evento_publico__onChange();
          }
          if ('event_part_id_evento_regional__onchange' == $this->NM_ajax_opcao)
          {
              $this->part_id_evento_regional__onChange();
          }
          if ('event_part_sexo__onchange' == $this->NM_ajax_opcao)
          {
              $this->part_sexo__onChange();
          }
          if ('event_part_tam_camisa__onchange' == $this->NM_ajax_opcao)
          {
              $this->part_tam_camisa__onChange();
          }
          $this->NM_close_db();
          form_participantes_rsvp_ar_pack_ajax_response();
          exit;
      }
      if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form" && !$this->Apl_com_erro)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['recarga'] = $this->nmgp_opcao;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_redir_insert']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_redir_insert'] == "ok")
          {
              if ($this->sc_teve_incl && empty($sc_todas_Crit))
              {
                  $this->NM_close_db(); 
                  $this->nmgp_redireciona(2); 
              }
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_redir_atualiz'] == "ok")
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['inline_form_seq'] = $this->sc_seq_row;
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
              form_participantes_rsvp_ar_pack_ajax_response();
              exit;
          }
          $this->nm_formatar_campos();
          $this->nmgp_opcao = $nm_sc_sv_opcao; 
          return; 
      }
      if ($this->nmgp_opcao == "incluir" || $this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "excluir") 
      {
          $this->Valida_campos($Campos_Crit, $Campos_Falta, $Campos_Erros) ; 
          $_SESSION['scriptcase']['form_participantes_rsvp_ar']['contr_erro'] = 'off';
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
          $Zip_name = "sc_prt_" . date("YmdHis") . "_" . rand(0, 1000) . "form_participantes_rsvp_ar.zip";
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar'][$path_doc_md5][0] = $Arq_htm;
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar'][$path_doc_md5][1] = $Zip_name;
?><!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo strip_tags("Ações Rápidas Participantes") ?></TITLE>
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
<form name="Fdown" method="get" action="form_participantes_rsvp_ar_download.php" target="_self" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="form_participantes_rsvp_ar"> 
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
   function lookup_part_id_evento_(&$conteudo)
   {
      global  $part_id_evento_;
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
      $nm_comando = "SELECT evento_nome 
FROM eventos_rsvp 
WHERE evento_id = $this->part_id_evento_ 
ORDER BY evento_nome"; 
      if ($this->part_id_evento_ == "")
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
           case 'part_id_evento_':
               return "Cod. Evento";
               break;
           case 'part_cpf_':
               return "CPF";
               break;
           case 'nome_pessoa_':
               return "Nome";
               break;
           case 'part_sexo_':
               return "Sexo";
               break;
           case 'part_id_evento_publico_':
               return "Público";
               break;
           case 'part_id_evento_regional_':
               return "Regional";
               break;
           case 'part_grupo_':
               return "Gupo";
               break;
           case 'part_clube_':
               return "Clube";
               break;
           case 'part_empresa_':
               return "Empresa";
               break;
           case 'part_uf_':
               return "UF";
               break;
           case 'part_ddd_celular_01_':
               return "DDD Celular";
               break;
           case 'part_celeular_01_':
               return "Celular";
               break;
           case 'part_dt_nasc_':
               return "Dt. Nascimento";
               break;
           case 'part_tam_camisa_':
               return "Tam. Camisa";
               break;
           case 'part_tam_calcado_':
               return "Tam. Calçado";
               break;
           case 'participante_id_':
               return "Participante Id";
               break;
           case 'part_ativo_':
               return "Part Ativo";
               break;
           case 'part_cpf_substituto_':
               return "Part Cpf Substituto";
               break;
           case 'part_crnm_':
               return "Part Crnm";
               break;
           case 'part_tipo_':
               return "Part Tipo";
               break;
           case 'part_nome_cracha_':
               return "Part Nome Cracha";
               break;
           case 'part_tipo_pessoa_':
               return "Part Tipo Pessoa";
               break;
           case 'part_substituido_':
               return "Part Substituido";
               break;
           case 'part_substituto_':
               return "Part Substituto";
               break;
           case 'part_cod_substituto_':
               return "Part Cod Substituto";
               break;
           case 'part_nome_substituto_':
               return "Part Nome Substituto";
               break;
           case 'part_sexo_substituto_':
               return "Part Sexo Substituto";
               break;
           case 'part_cod_substituido_':
               return "Part Cod Substituido";
               break;
           case 'part_nome_substituido_':
               return "Part Nome Substituido";
               break;
           case 'part_cep_':
               return "Part Cep";
               break;
           case 'part_departamento_':
               return "Part Departamento";
               break;
           case 'part_cargo_':
               return "Part Cargo";
               break;
           case 'part_logradouro_':
               return "Part Logradouro";
               break;
           case 'part_numero_':
               return "Part Numero";
               break;
           case 'part_complemento_':
               return "Part Complemento";
               break;
           case 'part_bairro_':
               return "Part Bairro";
               break;
           case 'part_cidade_':
               return "Part Cidade";
               break;
           case 'part_ddd_01_':
               return "Part Ddd 01";
               break;
           case 'part_fone_01_':
               return "Part Fone 01";
               break;
           case 'part_ddd_02_':
               return "Part Ddd 02";
               break;
           case 'part_fone_02_':
               return "Part Fone 02";
               break;
           case 'part_ddd_03_':
               return "Part Ddd 03";
               break;
           case 'part_fone_03_':
               return "Part Fone 03";
               break;
           case 'part_ddd_fax_':
               return "Part Ddd Fax";
               break;
           case 'part_fax_':
               return "Part Fax";
               break;
           case 'part_ddd_celular_02_':
               return "Part Ddd Celular 02";
               break;
           case 'part_celular_02_':
               return "Part Celular 02";
               break;
           case 'part_fone_internacional_':
               return "Part Fone Internacional";
               break;
           case 'part_email_':
               return "Part Email";
               break;
           case 'part_rg_':
               return "Part Rg";
               break;
           case 'part_passaporte_':
               return "Part Passaporte";
               break;
           case 'part_validade_pass_':
               return "Part Validade Pass";
               break;
           case 'part_passaporte_estrangeiro_':
               return "Part Passaporte Estrangeiro";
               break;
           case 'part_ind_voucher_':
               return "Part Ind Voucher";
               break;
           case 'part_num_voucher_':
               return "Part Num Voucher";
               break;
           case 'part_idioma_':
               return "Part Idioma";
               break;
           case 'part_filiacao_':
               return "Part Filiacao";
               break;
           case 'part_pais_':
               return "Part Pais";
               break;
           case 'part_nome_secretaria_':
               return "Part Nome Secretaria";
               break;
           case 'part_email_secretaria_':
               return "Part Email Secretaria";
               break;
           case 'part_cod_usuario_':
               return "Part Cod Usuario";
               break;
           case 'part_dt_cadastro_':
               return "Part Dt Cadastro";
               break;
           case 'part_dt_alteracao_':
               return "Part Dt Alteracao";
               break;
           case 'part_contato_rsvp_':
               return "Part Contato Rsvp";
               break;
           case 'part_dt_alt_contato_rsvp_':
               return "Part Dt Alt Contato Rsvp";
               break;
           case 'part_presenca_':
               return "Part Presenca";
               break;
           case 'part_dt_alt_presenca_':
               return "Part Dt Alt Presenca";
               break;
           case 'part_solicit_especial_':
               return "Part Solicit Especial";
               break;
           case 'part_dt_solicit_especial_':
               return "Part Dt Solicit Especial";
               break;
           case 'part_programacao_':
               return "Part Programacao";
               break;
           case 'part_dt_programacao_':
               return "Part Dt Programacao";
               break;
           case 'part_aereo_':
               return "Part Aereo";
               break;
           case 'part_dt_aereo_':
               return "Part Dt Aereo";
               break;
           case 'part_hospedagem_':
               return "Part Hospedagem";
               break;
           case 'par_dt_hospedagem_':
               return "Par Dt Hospedagem";
               break;
           case 'part_dt_transfer_':
               return "Part Dt Transfer";
               break;
           case 'part_opcionais_':
               return "Part Opcionais";
               break;
           case 'part_dt_opcionais_':
               return "Part Dt Opcionais";
               break;
           case 'part_notas_':
               return "Part Notas";
               break;
           case 'part_confirm_viagem_':
               return "Part Confirm Viagem";
               break;
           case 'part_convite_':
               return "Part Convite";
               break;
           case 'part_concluido_':
               return "Part Concluido";
               break;
           case 'part_transfer_':
               return "Part Transfer";
               break;
           case 'part_convite_enviado_':
               return "Part Convite Enviado";
               break;
           case 'part_destaque_negrito_':
               return "Part Destaque Negrito";
               break;
           case 'part_atendimento_':
               return "Part Atendimento";
               break;
           case 'part_save_the_date_':
               return "Part Save The Date";
               break;
           case 'part_arq_save_':
               return "Part Arq Save";
               break;
           case 'part_arq_convite_':
               return "Part Arq Convite";
               break;
           case 'part_fumante_':
               return "Part Fumante";
               break;
           case 'part_restricao_alimentar_':
               return "Part Restricao Alimentar";
               break;
           case 'part_acompanhado_':
               return "Part Acompanhado";
               break;
           case 'part_acompanhado_hotel_':
               return "Part Acompanhado Hotel";
               break;
           case 'part_acom_completo_':
               return "Part Acom Completo";
               break;
           case 'part_acom_incompleto_':
               return "Part Acom Incompleto";
               break;
           case 'part_incompleto_':
               return "Part Incompleto";
               break;
           case 'part_aereo_ok_':
               return "Part Aereo Ok";
               break;
           case 'part_bloqueio_id_':
               return "Part Bloqueio Id";
               break;
           case 'part_hotel_':
               return "Part Hotel";
               break;
           case 'part_anotacoes_':
               return "Part Anotacoes";
               break;
           case 'guarda_cod_substituto_':
               return "Guarda Cod Substituto";
               break;
           case 'part_cpf_informado_':
               return "Part Cpf Informado";
               break;
           case 'part_cv_obs_':
               return "Part Cv Obs";
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

     if (!is_array($filtro) && '' == $filtro && isset($this->nm_form_submit) && '1' == $this->nm_form_submit && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['csrf_token']) && $this->scCsrfGetToken() != $this->csrf_token)
     {
          $this->Campos_Mens_erro .= (empty($this->Campos_Mens_erro)) ? "" : "<br />";
          $this->Campos_Mens_erro .= "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          if ($this->NM_ajax_flag)
          {
              if (!isset($this->NM_ajax_info['errList']['geral_form_participantes_rsvp_ar']) || !is_array($this->NM_ajax_info['errList']['geral_form_participantes_rsvp_ar']))
              {
                  $this->NM_ajax_info['errList']['geral_form_participantes_rsvp_ar'] = array();
              }
              $this->NM_ajax_info['errList']['geral_form_participantes_rsvp_ar'][] = "CSRF: " . $this->Ini->Nm_lang['lang_errm_ajax_csrf'];
          }
     }
      if ((!is_array($filtro) && ('' == $filtro || 'part_id_evento_' == $filtro)) || (is_array($filtro) && in_array('part_id_evento_', $filtro)))
        $this->ValidateField_part_id_evento_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'part_cpf_' == $filtro)) || (is_array($filtro) && in_array('part_cpf_', $filtro)))
        $this->ValidateField_part_cpf_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'nome_pessoa_' == $filtro)) || (is_array($filtro) && in_array('nome_pessoa_', $filtro)))
        $this->ValidateField_nome_pessoa_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'part_sexo_' == $filtro)) || (is_array($filtro) && in_array('part_sexo_', $filtro)))
        $this->ValidateField_part_sexo_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'part_id_evento_publico_' == $filtro)) || (is_array($filtro) && in_array('part_id_evento_publico_', $filtro)))
        $this->ValidateField_part_id_evento_publico_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'part_id_evento_regional_' == $filtro)) || (is_array($filtro) && in_array('part_id_evento_regional_', $filtro)))
        $this->ValidateField_part_id_evento_regional_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'part_grupo_' == $filtro)) || (is_array($filtro) && in_array('part_grupo_', $filtro)))
        $this->ValidateField_part_grupo_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'part_clube_' == $filtro)) || (is_array($filtro) && in_array('part_clube_', $filtro)))
        $this->ValidateField_part_clube_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'part_empresa_' == $filtro)) || (is_array($filtro) && in_array('part_empresa_', $filtro)))
        $this->ValidateField_part_empresa_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'part_uf_' == $filtro)) || (is_array($filtro) && in_array('part_uf_', $filtro)))
        $this->ValidateField_part_uf_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'part_ddd_celular_01_' == $filtro)) || (is_array($filtro) && in_array('part_ddd_celular_01_', $filtro)))
        $this->ValidateField_part_ddd_celular_01_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'part_celeular_01_' == $filtro)) || (is_array($filtro) && in_array('part_celeular_01_', $filtro)))
        $this->ValidateField_part_celeular_01_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'part_dt_nasc_' == $filtro)) || (is_array($filtro) && in_array('part_dt_nasc_', $filtro)))
        $this->ValidateField_part_dt_nasc_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'part_tam_camisa_' == $filtro)) || (is_array($filtro) && in_array('part_tam_camisa_', $filtro)))
        $this->ValidateField_part_tam_camisa_($Campos_Crit, $Campos_Falta, $Campos_Erros);
      if ((!is_array($filtro) && ('' == $filtro || 'part_tam_calcado_' == $filtro)) || (is_array($filtro) && in_array('part_tam_calcado_', $filtro)))
        $this->ValidateField_part_tam_calcado_($Campos_Crit, $Campos_Falta, $Campos_Erros);
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

    function ValidateField_part_id_evento_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['part_id_evento_'])) {
          nm_limpa_numero($this->part_id_evento_, $this->field_config['part_id_evento_']['symbol_grp']) ; 
          return;
      }
      if ($this->part_id_evento_ === "" || is_null($this->part_id_evento_))  
      { 
          $this->part_id_evento_ = 0;
          $this->sc_force_zero[] = 'part_id_evento_';
      } 
      nm_limpa_numero($this->part_id_evento_, $this->field_config['part_id_evento_']['symbol_grp']) ; 
      if ($this->nmgp_opcao == "incluir" || 'validate_part_id_evento_' == $this->NM_ajax_opcao)
      { 
          if ($this->part_id_evento_ != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->part_id_evento_) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Cod. Evento: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['part_id_evento_']))
                  {
                      $Campos_Erros['part_id_evento_'] = array();
                  }
                  $Campos_Erros['part_id_evento_'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['part_id_evento_']) || !is_array($this->NM_ajax_info['errList']['part_id_evento_']))
                  {
                      $this->NM_ajax_info['errList']['part_id_evento_'] = array();
                  }
                  $this->NM_ajax_info['errList']['part_id_evento_'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->part_id_evento_, 11, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Cod. Evento; " ; 
                  if (!isset($Campos_Erros['part_id_evento_']))
                  {
                      $Campos_Erros['part_id_evento_'] = array();
                  }
                  $Campos_Erros['part_id_evento_'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['part_id_evento_']) || !is_array($this->NM_ajax_info['errList']['part_id_evento_']))
                  {
                      $this->NM_ajax_info['errList']['part_id_evento_'] = array();
                  }
                  $this->NM_ajax_info['errList']['part_id_evento_'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'part_id_evento_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_part_id_evento_

    function ValidateField_part_cpf_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['part_cpf_'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->part_cpf_) > 13) 
          { 
              $hasError = true;
              $Campos_Crit .= "CPF " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 13 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['part_cpf_']))
              {
                  $Campos_Erros['part_cpf_'] = array();
              }
              $Campos_Erros['part_cpf_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 13 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['part_cpf_']) || !is_array($this->NM_ajax_info['errList']['part_cpf_']))
              {
                  $this->NM_ajax_info['errList']['part_cpf_'] = array();
              }
              $this->NM_ajax_info['errList']['part_cpf_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 13 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'part_cpf_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_part_cpf_

    function ValidateField_nome_pessoa_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['nome_pessoa_'])) {
          return;
      }
      if ($this->nmgp_opcao == "incluir")
      { 
          if (NM_utf8_strlen($this->nome_pessoa_) > 60) 
          { 
              $hasError = true;
              $Campos_Crit .= "Nome " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['nome_pessoa_']))
              {
                  $Campos_Erros['nome_pessoa_'] = array();
              }
              $Campos_Erros['nome_pessoa_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['nome_pessoa_']) || !is_array($this->NM_ajax_info['errList']['nome_pessoa_']))
              {
                  $this->NM_ajax_info['errList']['nome_pessoa_'] = array();
              }
              $this->NM_ajax_info['errList']['nome_pessoa_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 60 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'nome_pessoa_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_nome_pessoa_

    function ValidateField_part_sexo_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['part_sexo_'])) {
          return;
      }
      $this->part_sexo_ = sc_strtoupper($this->part_sexo_); 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->part_sexo_) > 1) 
          { 
              $hasError = true;
              $Campos_Crit .= "Sexo " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 1 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['part_sexo_']))
              {
                  $Campos_Erros['part_sexo_'] = array();
              }
              $Campos_Erros['part_sexo_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 1 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['part_sexo_']) || !is_array($this->NM_ajax_info['errList']['part_sexo_']))
              {
                  $this->NM_ajax_info['errList']['part_sexo_'] = array();
              }
              $this->NM_ajax_info['errList']['part_sexo_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 1 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
          if (NM_utf8_strlen($this->part_sexo_) < 1) 
          { 
              $hasError = true;
              $Campos_Crit .= "Sexo " . $this->Ini->Nm_lang['lang_errm_mnch'] . " 1 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['part_sexo_']))
              {
                  $Campos_Erros['part_sexo_'] = array();
              }
              $Campos_Erros['part_sexo_'][] = $this->Ini->Nm_lang['lang_errm_mnch'] . " 1 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['part_sexo_']) || !is_array($this->NM_ajax_info['errList']['part_sexo_']))
              {
                  $this->NM_ajax_info['errList']['part_sexo_'] = array();
              }
              $this->NM_ajax_info['errList']['part_sexo_'][] = $this->Ini->Nm_lang['lang_errm_mnch'] . " 1 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
      $Teste_trab = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      if ($_SESSION['scriptcase']['charset'] != "UTF-8")
      {
          $Teste_trab = NM_conv_charset($Teste_trab, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
;
      $Teste_trab = $Teste_trab . chr(10) . chr(13) ; 
      $Teste_compara = $this->part_sexo_ ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $Teste_critica = 0 ; 
          for ($x = 0; $x < mb_strlen($this->part_sexo_, $_SESSION['scriptcase']['charset']); $x++) 
          { 
               for ($y = 0; $y < mb_strlen($Teste_trab, $_SESSION['scriptcase']['charset']); $y++) 
               { 
                    if (sc_substr($Teste_compara, $x, 1) == sc_substr($Teste_trab, $y, 1) ) 
                    { 
                        break ; 
                    } 
               } 
               if (sc_substr($Teste_compara, $x, 1) != sc_substr($Teste_trab, $y, 1) )  
               { 
                  $Teste_critica = 1 ; 
               } 
          } 
          if ($Teste_critica == 1) 
          { 
              $hasError = true;
              $Campos_Crit .= "Sexo " . $this->Ini->Nm_lang['lang_errm_ivch']; 
              if (!isset($Campos_Erros['part_sexo_']))
              {
                  $Campos_Erros['part_sexo_'] = array();
              }
              $Campos_Erros['part_sexo_'][] = $this->Ini->Nm_lang['lang_errm_ivch'];
              if (!isset($this->NM_ajax_info['errList']['part_sexo_']) || !is_array($this->NM_ajax_info['errList']['part_sexo_']))
              {
                  $this->NM_ajax_info['errList']['part_sexo_'] = array();
              }
              $this->NM_ajax_info['errList']['part_sexo_'][] = $this->Ini->Nm_lang['lang_errm_ivch'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'part_sexo_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_part_sexo_

    function ValidateField_part_id_evento_publico_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['part_id_evento_publico_'])) {
          nm_limpa_numero($this->part_id_evento_publico_, $this->field_config['part_id_evento_publico_']['symbol_grp']) ; 
          return;
      }
      if ($this->part_id_evento_publico_ === "" || is_null($this->part_id_evento_publico_))  
      { 
          $this->part_id_evento_publico_ = 0;
          $this->sc_force_zero[] = 'part_id_evento_publico_';
      } 
      nm_limpa_numero($this->part_id_evento_publico_, $this->field_config['part_id_evento_publico_']['symbol_grp']) ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if ($this->part_id_evento_publico_ != '')  
          { 
              $iTestSize = 11;
              if (strlen($this->part_id_evento_publico_) > $iTestSize)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Público: " . $this->Ini->Nm_lang['lang_errm_size']; 
                  if (!isset($Campos_Erros['part_id_evento_publico_']))
                  {
                      $Campos_Erros['part_id_evento_publico_'] = array();
                  }
                  $Campos_Erros['part_id_evento_publico_'][] = $this->Ini->Nm_lang['lang_errm_size'];
                  if (!isset($this->NM_ajax_info['errList']['part_id_evento_publico_']) || !is_array($this->NM_ajax_info['errList']['part_id_evento_publico_']))
                  {
                      $this->NM_ajax_info['errList']['part_id_evento_publico_'] = array();
                  }
                  $this->NM_ajax_info['errList']['part_id_evento_publico_'][] = $this->Ini->Nm_lang['lang_errm_size'];
              } 
              if ($teste_validade->Valor($this->part_id_evento_publico_, 11, 0, 0, 0, "N") == false)  
              { 
                  $hasError = true;
                  $Campos_Crit .= "Público; " ; 
                  if (!isset($Campos_Erros['part_id_evento_publico_']))
                  {
                      $Campos_Erros['part_id_evento_publico_'] = array();
                  }
                  $Campos_Erros['part_id_evento_publico_'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['part_id_evento_publico_']) || !is_array($this->NM_ajax_info['errList']['part_id_evento_publico_']))
                  {
                      $this->NM_ajax_info['errList']['part_id_evento_publico_'] = array();
                  }
                  $this->NM_ajax_info['errList']['part_id_evento_publico_'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'part_id_evento_publico_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_part_id_evento_publico_

    function ValidateField_part_id_evento_regional_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['part_id_evento_regional_'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->part_id_evento_regional_) > 3) 
          { 
              $hasError = true;
              $Campos_Crit .= "Regional " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 3 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['part_id_evento_regional_']))
              {
                  $Campos_Erros['part_id_evento_regional_'] = array();
              }
              $Campos_Erros['part_id_evento_regional_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 3 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['part_id_evento_regional_']) || !is_array($this->NM_ajax_info['errList']['part_id_evento_regional_']))
              {
                  $this->NM_ajax_info['errList']['part_id_evento_regional_'] = array();
              }
              $this->NM_ajax_info['errList']['part_id_evento_regional_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 3 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
          if (NM_utf8_strlen($this->part_id_evento_regional_) < 1) 
          { 
              $hasError = true;
              $Campos_Crit .= "Regional " . $this->Ini->Nm_lang['lang_errm_mnch'] . " 1 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['part_id_evento_regional_']))
              {
                  $Campos_Erros['part_id_evento_regional_'] = array();
              }
              $Campos_Erros['part_id_evento_regional_'][] = $this->Ini->Nm_lang['lang_errm_mnch'] . " 1 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['part_id_evento_regional_']) || !is_array($this->NM_ajax_info['errList']['part_id_evento_regional_']))
              {
                  $this->NM_ajax_info['errList']['part_id_evento_regional_'] = array();
              }
              $this->NM_ajax_info['errList']['part_id_evento_regional_'][] = $this->Ini->Nm_lang['lang_errm_mnch'] . " 1 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
      $Teste_trab = "01234567890123456789";
      if ($_SESSION['scriptcase']['charset'] != "UTF-8")
      {
          $Teste_trab = NM_conv_charset($Teste_trab, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
;
      $Teste_trab = $Teste_trab . chr(10) . chr(13) ; 
      $Teste_compara = $this->part_id_evento_regional_ ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $Teste_critica = 0 ; 
          for ($x = 0; $x < mb_strlen($this->part_id_evento_regional_, $_SESSION['scriptcase']['charset']); $x++) 
          { 
               for ($y = 0; $y < mb_strlen($Teste_trab, $_SESSION['scriptcase']['charset']); $y++) 
               { 
                    if (sc_substr($Teste_compara, $x, 1) == sc_substr($Teste_trab, $y, 1) ) 
                    { 
                        break ; 
                    } 
               } 
               if (sc_substr($Teste_compara, $x, 1) != sc_substr($Teste_trab, $y, 1) )  
               { 
                  $Teste_critica = 1 ; 
               } 
          } 
          if ($Teste_critica == 1) 
          { 
              $hasError = true;
              $Campos_Crit .= "Regional " . $this->Ini->Nm_lang['lang_errm_ivch']; 
              if (!isset($Campos_Erros['part_id_evento_regional_']))
              {
                  $Campos_Erros['part_id_evento_regional_'] = array();
              }
              $Campos_Erros['part_id_evento_regional_'][] = $this->Ini->Nm_lang['lang_errm_ivch'];
              if (!isset($this->NM_ajax_info['errList']['part_id_evento_regional_']) || !is_array($this->NM_ajax_info['errList']['part_id_evento_regional_']))
              {
                  $this->NM_ajax_info['errList']['part_id_evento_regional_'] = array();
              }
              $this->NM_ajax_info['errList']['part_id_evento_regional_'][] = $this->Ini->Nm_lang['lang_errm_ivch'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'part_id_evento_regional_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_part_id_evento_regional_

    function ValidateField_part_grupo_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['part_grupo_'])) {
          return;
      }
      $this->part_grupo_ = sc_strtoupper($this->part_grupo_); 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->part_grupo_) > 100) 
          { 
              $hasError = true;
              $Campos_Crit .= "Gupo " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['part_grupo_']))
              {
                  $Campos_Erros['part_grupo_'] = array();
              }
              $Campos_Erros['part_grupo_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['part_grupo_']) || !is_array($this->NM_ajax_info['errList']['part_grupo_']))
              {
                  $this->NM_ajax_info['errList']['part_grupo_'] = array();
              }
              $this->NM_ajax_info['errList']['part_grupo_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'part_grupo_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_part_grupo_

    function ValidateField_part_clube_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['part_clube_'])) {
          return;
      }
      $this->part_clube_ = sc_strtoupper($this->part_clube_); 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->part_clube_) > 100) 
          { 
              $hasError = true;
              $Campos_Crit .= "Clube " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['part_clube_']))
              {
                  $Campos_Erros['part_clube_'] = array();
              }
              $Campos_Erros['part_clube_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['part_clube_']) || !is_array($this->NM_ajax_info['errList']['part_clube_']))
              {
                  $this->NM_ajax_info['errList']['part_clube_'] = array();
              }
              $this->NM_ajax_info['errList']['part_clube_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'part_clube_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_part_clube_

    function ValidateField_part_empresa_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['part_empresa_'])) {
          return;
      }
      $this->part_empresa_ = sc_strtoupper($this->part_empresa_); 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->part_empresa_) > 100) 
          { 
              $hasError = true;
              $Campos_Crit .= "Empresa " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['part_empresa_']))
              {
                  $Campos_Erros['part_empresa_'] = array();
              }
              $Campos_Erros['part_empresa_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['part_empresa_']) || !is_array($this->NM_ajax_info['errList']['part_empresa_']))
              {
                  $this->NM_ajax_info['errList']['part_empresa_'] = array();
              }
              $this->NM_ajax_info['errList']['part_empresa_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 100 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'part_empresa_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_part_empresa_

    function ValidateField_part_uf_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['part_uf_'])) {
          return;
      }
      $this->part_uf_ = sc_strtoupper($this->part_uf_); 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->part_uf_) > 20) 
          { 
              $hasError = true;
              $Campos_Crit .= "UF " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['part_uf_']))
              {
                  $Campos_Erros['part_uf_'] = array();
              }
              $Campos_Erros['part_uf_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['part_uf_']) || !is_array($this->NM_ajax_info['errList']['part_uf_']))
              {
                  $this->NM_ajax_info['errList']['part_uf_'] = array();
              }
              $this->NM_ajax_info['errList']['part_uf_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'part_uf_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_part_uf_

    function ValidateField_part_ddd_celular_01_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['part_ddd_celular_01_'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->part_ddd_celular_01_) > 2) 
          { 
              $hasError = true;
              $Campos_Crit .= "DDD Celular " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 2 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['part_ddd_celular_01_']))
              {
                  $Campos_Erros['part_ddd_celular_01_'] = array();
              }
              $Campos_Erros['part_ddd_celular_01_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 2 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['part_ddd_celular_01_']) || !is_array($this->NM_ajax_info['errList']['part_ddd_celular_01_']))
              {
                  $this->NM_ajax_info['errList']['part_ddd_celular_01_'] = array();
              }
              $this->NM_ajax_info['errList']['part_ddd_celular_01_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 2 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
      $Teste_trab = "01234567890123456789";
      if ($_SESSION['scriptcase']['charset'] != "UTF-8")
      {
          $Teste_trab = NM_conv_charset($Teste_trab, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
;
      $Teste_trab = $Teste_trab . chr(10) . chr(13) ; 
      $Teste_compara = $this->part_ddd_celular_01_ ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $Teste_critica = 0 ; 
          for ($x = 0; $x < mb_strlen($this->part_ddd_celular_01_, $_SESSION['scriptcase']['charset']); $x++) 
          { 
               for ($y = 0; $y < mb_strlen($Teste_trab, $_SESSION['scriptcase']['charset']); $y++) 
               { 
                    if (sc_substr($Teste_compara, $x, 1) == sc_substr($Teste_trab, $y, 1) ) 
                    { 
                        break ; 
                    } 
               } 
               if (sc_substr($Teste_compara, $x, 1) != sc_substr($Teste_trab, $y, 1) )  
               { 
                  $Teste_critica = 1 ; 
               } 
          } 
          if ($Teste_critica == 1) 
          { 
              $hasError = true;
              $Campos_Crit .= "DDD Celular " . $this->Ini->Nm_lang['lang_errm_ivch']; 
              if (!isset($Campos_Erros['part_ddd_celular_01_']))
              {
                  $Campos_Erros['part_ddd_celular_01_'] = array();
              }
              $Campos_Erros['part_ddd_celular_01_'][] = $this->Ini->Nm_lang['lang_errm_ivch'];
              if (!isset($this->NM_ajax_info['errList']['part_ddd_celular_01_']) || !is_array($this->NM_ajax_info['errList']['part_ddd_celular_01_']))
              {
                  $this->NM_ajax_info['errList']['part_ddd_celular_01_'] = array();
              }
              $this->NM_ajax_info['errList']['part_ddd_celular_01_'][] = $this->Ini->Nm_lang['lang_errm_ivch'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'part_ddd_celular_01_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_part_ddd_celular_01_

    function ValidateField_part_celeular_01_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['part_celeular_01_'])) {
          return;
      }
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->part_celeular_01_) > 10) 
          { 
              $hasError = true;
              $Campos_Crit .= "Celular " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 10 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['part_celeular_01_']))
              {
                  $Campos_Erros['part_celeular_01_'] = array();
              }
              $Campos_Erros['part_celeular_01_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 10 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['part_celeular_01_']) || !is_array($this->NM_ajax_info['errList']['part_celeular_01_']))
              {
                  $this->NM_ajax_info['errList']['part_celeular_01_'] = array();
              }
              $this->NM_ajax_info['errList']['part_celeular_01_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 10 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
      $Teste_trab = "01234567890123456789";
      if ($_SESSION['scriptcase']['charset'] != "UTF-8")
      {
          $Teste_trab = NM_conv_charset($Teste_trab, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
;
      $Teste_trab = $Teste_trab . chr(10) . chr(13) ; 
      $Teste_compara = $this->part_celeular_01_ ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $Teste_critica = 0 ; 
          for ($x = 0; $x < mb_strlen($this->part_celeular_01_, $_SESSION['scriptcase']['charset']); $x++) 
          { 
               for ($y = 0; $y < mb_strlen($Teste_trab, $_SESSION['scriptcase']['charset']); $y++) 
               { 
                    if (sc_substr($Teste_compara, $x, 1) == sc_substr($Teste_trab, $y, 1) ) 
                    { 
                        break ; 
                    } 
               } 
               if (sc_substr($Teste_compara, $x, 1) != sc_substr($Teste_trab, $y, 1) )  
               { 
                  $Teste_critica = 1 ; 
               } 
          } 
          if ($Teste_critica == 1) 
          { 
              $hasError = true;
              $Campos_Crit .= "Celular " . $this->Ini->Nm_lang['lang_errm_ivch']; 
              if (!isset($Campos_Erros['part_celeular_01_']))
              {
                  $Campos_Erros['part_celeular_01_'] = array();
              }
              $Campos_Erros['part_celeular_01_'][] = $this->Ini->Nm_lang['lang_errm_ivch'];
              if (!isset($this->NM_ajax_info['errList']['part_celeular_01_']) || !is_array($this->NM_ajax_info['errList']['part_celeular_01_']))
              {
                  $this->NM_ajax_info['errList']['part_celeular_01_'] = array();
              }
              $this->NM_ajax_info['errList']['part_celeular_01_'][] = $this->Ini->Nm_lang['lang_errm_ivch'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'part_celeular_01_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_part_celeular_01_

    function ValidateField_part_dt_nasc_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      nm_limpa_data($this->part_dt_nasc_, $this->field_config['part_dt_nasc_']['date_sep']) ; 
      if (isset($this->Field_no_validate['part_dt_nasc_'])) {
          return;
      }
      $trab_dt_min = ""; 
      $trab_dt_max = ""; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $guarda_datahora = $this->field_config['part_dt_nasc_']['date_format']; 
          if (false !== strpos($guarda_datahora, ';')) $this->field_config['part_dt_nasc_']['date_format'] = substr($guarda_datahora, 0, strpos($guarda_datahora, ';'));
          $Format_Data = $this->field_config['part_dt_nasc_']['date_format']; 
          nm_limpa_data($Format_Data, $this->field_config['part_dt_nasc_']['date_sep']) ; 
          if (trim($this->part_dt_nasc_) != "")  
          { 
              $validateTest = $teste_validade->Data($this->part_dt_nasc_, $Format_Data, $trab_dt_min, $trab_dt_max);
              if ($validateTest == false)
              { 
                  $hasError = true;
                  $Campos_Crit .= "Dt. Nascimento; " ; 
                  if (!isset($Campos_Erros['part_dt_nasc_']))
                  {
                      $Campos_Erros['part_dt_nasc_'] = array();
                  }
                  $Campos_Erros['part_dt_nasc_'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
                  if (!isset($this->NM_ajax_info['errList']['part_dt_nasc_']) || !is_array($this->NM_ajax_info['errList']['part_dt_nasc_']))
                  {
                      $this->NM_ajax_info['errList']['part_dt_nasc_'] = array();
                  }
                  $this->NM_ajax_info['errList']['part_dt_nasc_'][] = "" . $this->Ini->Nm_lang['lang_errm_ajax_data'] . "";
              } 
          } 
          $this->field_config['part_dt_nasc_']['date_format'] = $guarda_datahora; 
       } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'part_dt_nasc_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_part_dt_nasc_

    function ValidateField_part_tam_camisa_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['part_tam_camisa_'])) {
          return;
      }
      $this->part_tam_camisa_ = sc_strtoupper($this->part_tam_camisa_); 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->part_tam_camisa_) > 30) 
          { 
              $hasError = true;
              $Campos_Crit .= "Tam. Camisa " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['part_tam_camisa_']))
              {
                  $Campos_Erros['part_tam_camisa_'] = array();
              }
              $Campos_Erros['part_tam_camisa_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['part_tam_camisa_']) || !is_array($this->NM_ajax_info['errList']['part_tam_camisa_']))
              {
                  $this->NM_ajax_info['errList']['part_tam_camisa_'] = array();
              }
              $this->NM_ajax_info['errList']['part_tam_camisa_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 30 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
      $Teste_trab = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      if ($_SESSION['scriptcase']['charset'] != "UTF-8")
      {
          $Teste_trab = NM_conv_charset($Teste_trab, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
;
      $Teste_trab = $Teste_trab . chr(10) . chr(13) ; 
      $Teste_compara = $this->part_tam_camisa_ ; 
      if ($this->nmgp_opcao != "excluir") 
      { 
          $Teste_critica = 0 ; 
          for ($x = 0; $x < mb_strlen($this->part_tam_camisa_, $_SESSION['scriptcase']['charset']); $x++) 
          { 
               for ($y = 0; $y < mb_strlen($Teste_trab, $_SESSION['scriptcase']['charset']); $y++) 
               { 
                    if (sc_substr($Teste_compara, $x, 1) == sc_substr($Teste_trab, $y, 1) ) 
                    { 
                        break ; 
                    } 
               } 
               if (sc_substr($Teste_compara, $x, 1) != sc_substr($Teste_trab, $y, 1) )  
               { 
                  $Teste_critica = 1 ; 
               } 
          } 
          if ($Teste_critica == 1) 
          { 
              $hasError = true;
              $Campos_Crit .= "Tam. Camisa " . $this->Ini->Nm_lang['lang_errm_ivch']; 
              if (!isset($Campos_Erros['part_tam_camisa_']))
              {
                  $Campos_Erros['part_tam_camisa_'] = array();
              }
              $Campos_Erros['part_tam_camisa_'][] = $this->Ini->Nm_lang['lang_errm_ivch'];
              if (!isset($this->NM_ajax_info['errList']['part_tam_camisa_']) || !is_array($this->NM_ajax_info['errList']['part_tam_camisa_']))
              {
                  $this->NM_ajax_info['errList']['part_tam_camisa_'] = array();
              }
              $this->NM_ajax_info['errList']['part_tam_camisa_'][] = $this->Ini->Nm_lang['lang_errm_ivch'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'part_tam_camisa_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_part_tam_camisa_

    function ValidateField_part_tam_calcado_(&$Campos_Crit, &$Campos_Falta, &$Campos_Erros)
    {
        global $teste_validade;
        $hasError = false;
      if (isset($this->Field_no_validate['part_tam_calcado_'])) {
          return;
      }
      $this->part_tam_calcado_ = sc_strtoupper($this->part_tam_calcado_); 
      if ($this->nmgp_opcao != "excluir") 
      { 
          if (NM_utf8_strlen($this->part_tam_calcado_) > 20) 
          { 
              $hasError = true;
              $Campos_Crit .= "Tam. Calçado " . $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr']; 
              if (!isset($Campos_Erros['part_tam_calcado_']))
              {
                  $Campos_Erros['part_tam_calcado_'] = array();
              }
              $Campos_Erros['part_tam_calcado_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
              if (!isset($this->NM_ajax_info['errList']['part_tam_calcado_']) || !is_array($this->NM_ajax_info['errList']['part_tam_calcado_']))
              {
                  $this->NM_ajax_info['errList']['part_tam_calcado_'] = array();
              }
              $this->NM_ajax_info['errList']['part_tam_calcado_'][] = $this->Ini->Nm_lang['lang_errm_mxch'] . " 20 " . $this->Ini->Nm_lang['lang_errm_nchr'];
          } 
      } 
        if ($hasError) {
            global $sc_seq_vert;
            $fieldName = 'part_tam_calcado_';
            if (isset($sc_seq_vert) && '' != $sc_seq_vert) {
                $fieldName .= $sc_seq_vert;
            }
            $this->NM_ajax_info['fieldsWithErrors'][] = $fieldName;
        }
    } // ValidateField_part_tam_calcado_

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
    $this->nmgp_dados_form['part_id_evento_'] = $this->part_id_evento_;
    $this->nmgp_dados_form['part_cpf_'] = $this->part_cpf_;
    $this->nmgp_dados_form['nome_pessoa_'] = $this->nome_pessoa_;
    $this->nmgp_dados_form['part_sexo_'] = $this->part_sexo_;
    $this->nmgp_dados_form['part_id_evento_publico_'] = $this->part_id_evento_publico_;
    $this->nmgp_dados_form['part_id_evento_regional_'] = $this->part_id_evento_regional_;
    $this->nmgp_dados_form['part_grupo_'] = $this->part_grupo_;
    $this->nmgp_dados_form['part_clube_'] = $this->part_clube_;
    $this->nmgp_dados_form['part_empresa_'] = $this->part_empresa_;
    $this->nmgp_dados_form['part_uf_'] = $this->part_uf_;
    $this->nmgp_dados_form['part_ddd_celular_01_'] = $this->part_ddd_celular_01_;
    $this->nmgp_dados_form['part_celeular_01_'] = $this->part_celeular_01_;
    $this->nmgp_dados_form['part_dt_nasc_'] = (strlen(trim($this->part_dt_nasc_)) > 19) ? str_replace(".", ":", $this->part_dt_nasc_) : trim($this->part_dt_nasc_);
    $this->nmgp_dados_form['part_tam_camisa_'] = $this->part_tam_camisa_;
    $this->nmgp_dados_form['part_tam_calcado_'] = $this->part_tam_calcado_;
    $this->nmgp_dados_form['participante_id_'] = $this->participante_id_;
    $this->nmgp_dados_form['part_ativo_'] = $this->part_ativo_;
    $this->nmgp_dados_form['part_cpf_substituto_'] = $this->part_cpf_substituto_;
    $this->nmgp_dados_form['part_crnm_'] = $this->part_crnm_;
    $this->nmgp_dados_form['part_tipo_'] = $this->part_tipo_;
    $this->nmgp_dados_form['part_nome_cracha_'] = $this->part_nome_cracha_;
    $this->nmgp_dados_form['part_tipo_pessoa_'] = $this->part_tipo_pessoa_;
    $this->nmgp_dados_form['part_substituido_'] = $this->part_substituido_;
    $this->nmgp_dados_form['part_substituto_'] = $this->part_substituto_;
    $this->nmgp_dados_form['part_cod_substituto_'] = $this->part_cod_substituto_;
    $this->nmgp_dados_form['part_nome_substituto_'] = $this->part_nome_substituto_;
    $this->nmgp_dados_form['part_sexo_substituto_'] = $this->part_sexo_substituto_;
    $this->nmgp_dados_form['part_cod_substituido_'] = $this->part_cod_substituido_;
    $this->nmgp_dados_form['part_nome_substituido_'] = $this->part_nome_substituido_;
    $this->nmgp_dados_form['part_cep_'] = $this->part_cep_;
    $this->nmgp_dados_form['part_departamento_'] = $this->part_departamento_;
    $this->nmgp_dados_form['part_cargo_'] = $this->part_cargo_;
    $this->nmgp_dados_form['part_logradouro_'] = $this->part_logradouro_;
    $this->nmgp_dados_form['part_numero_'] = $this->part_numero_;
    $this->nmgp_dados_form['part_complemento_'] = $this->part_complemento_;
    $this->nmgp_dados_form['part_bairro_'] = $this->part_bairro_;
    $this->nmgp_dados_form['part_cidade_'] = $this->part_cidade_;
    $this->nmgp_dados_form['part_ddd_01_'] = $this->part_ddd_01_;
    $this->nmgp_dados_form['part_fone_01_'] = $this->part_fone_01_;
    $this->nmgp_dados_form['part_ddd_02_'] = $this->part_ddd_02_;
    $this->nmgp_dados_form['part_fone_02_'] = $this->part_fone_02_;
    $this->nmgp_dados_form['part_ddd_03_'] = $this->part_ddd_03_;
    $this->nmgp_dados_form['part_fone_03_'] = $this->part_fone_03_;
    $this->nmgp_dados_form['part_ddd_fax_'] = $this->part_ddd_fax_;
    $this->nmgp_dados_form['part_fax_'] = $this->part_fax_;
    $this->nmgp_dados_form['part_ddd_celular_02_'] = $this->part_ddd_celular_02_;
    $this->nmgp_dados_form['part_celular_02_'] = $this->part_celular_02_;
    $this->nmgp_dados_form['part_fone_internacional_'] = $this->part_fone_internacional_;
    $this->nmgp_dados_form['part_email_'] = $this->part_email_;
    $this->nmgp_dados_form['part_rg_'] = $this->part_rg_;
    $this->nmgp_dados_form['part_passaporte_'] = $this->part_passaporte_;
    $this->nmgp_dados_form['part_validade_pass_'] = $this->part_validade_pass_;
    $this->nmgp_dados_form['part_passaporte_estrangeiro_'] = $this->part_passaporte_estrangeiro_;
    $this->nmgp_dados_form['part_ind_voucher_'] = $this->part_ind_voucher_;
    $this->nmgp_dados_form['part_num_voucher_'] = $this->part_num_voucher_;
    $this->nmgp_dados_form['part_idioma_'] = $this->part_idioma_;
    $this->nmgp_dados_form['part_filiacao_'] = $this->part_filiacao_;
    $this->nmgp_dados_form['part_pais_'] = $this->part_pais_;
    $this->nmgp_dados_form['part_nome_secretaria_'] = $this->part_nome_secretaria_;
    $this->nmgp_dados_form['part_email_secretaria_'] = $this->part_email_secretaria_;
    $this->nmgp_dados_form['part_cod_usuario_'] = $this->part_cod_usuario_;
    $this->nmgp_dados_form['part_dt_cadastro_'] = $this->part_dt_cadastro_;
    $this->nmgp_dados_form['part_dt_alteracao_'] = $this->part_dt_alteracao_;
    $this->nmgp_dados_form['part_contato_rsvp_'] = $this->part_contato_rsvp_;
    $this->nmgp_dados_form['part_dt_alt_contato_rsvp_'] = $this->part_dt_alt_contato_rsvp_;
    $this->nmgp_dados_form['part_presenca_'] = $this->part_presenca_;
    $this->nmgp_dados_form['part_dt_alt_presenca_'] = $this->part_dt_alt_presenca_;
    $this->nmgp_dados_form['part_solicit_especial_'] = $this->part_solicit_especial_;
    $this->nmgp_dados_form['part_dt_solicit_especial_'] = $this->part_dt_solicit_especial_;
    $this->nmgp_dados_form['part_programacao_'] = $this->part_programacao_;
    $this->nmgp_dados_form['part_dt_programacao_'] = $this->part_dt_programacao_;
    $this->nmgp_dados_form['part_aereo_'] = $this->part_aereo_;
    $this->nmgp_dados_form['part_dt_aereo_'] = $this->part_dt_aereo_;
    $this->nmgp_dados_form['part_hospedagem_'] = $this->part_hospedagem_;
    $this->nmgp_dados_form['par_dt_hospedagem_'] = $this->par_dt_hospedagem_;
    $this->nmgp_dados_form['part_dt_transfer_'] = $this->part_dt_transfer_;
    $this->nmgp_dados_form['part_opcionais_'] = $this->part_opcionais_;
    $this->nmgp_dados_form['part_dt_opcionais_'] = $this->part_dt_opcionais_;
    $this->nmgp_dados_form['part_notas_'] = $this->part_notas_;
    $this->nmgp_dados_form['part_confirm_viagem_'] = $this->part_confirm_viagem_;
    $this->nmgp_dados_form['part_convite_'] = $this->part_convite_;
    $this->nmgp_dados_form['part_concluido_'] = $this->part_concluido_;
    $this->nmgp_dados_form['part_transfer_'] = $this->part_transfer_;
    $this->nmgp_dados_form['part_convite_enviado_'] = $this->part_convite_enviado_;
    $this->nmgp_dados_form['part_destaque_negrito_'] = $this->part_destaque_negrito_;
    $this->nmgp_dados_form['part_atendimento_'] = $this->part_atendimento_;
    $this->nmgp_dados_form['part_save_the_date_'] = $this->part_save_the_date_;
    $this->nmgp_dados_form['part_arq_save_'] = $this->part_arq_save_;
    $this->nmgp_dados_form['part_arq_convite_'] = $this->part_arq_convite_;
    $this->nmgp_dados_form['part_fumante_'] = $this->part_fumante_;
    $this->nmgp_dados_form['part_restricao_alimentar_'] = $this->part_restricao_alimentar_;
    $this->nmgp_dados_form['part_acompanhado_'] = $this->part_acompanhado_;
    $this->nmgp_dados_form['part_acompanhado_hotel_'] = $this->part_acompanhado_hotel_;
    $this->nmgp_dados_form['part_acom_completo_'] = $this->part_acom_completo_;
    $this->nmgp_dados_form['part_acom_incompleto_'] = $this->part_acom_incompleto_;
    $this->nmgp_dados_form['part_incompleto_'] = $this->part_incompleto_;
    $this->nmgp_dados_form['part_aereo_ok_'] = $this->part_aereo_ok_;
    $this->nmgp_dados_form['part_bloqueio_id_'] = $this->part_bloqueio_id_;
    $this->nmgp_dados_form['part_hotel_'] = $this->part_hotel_;
    $this->nmgp_dados_form['part_anotacoes_'] = $this->part_anotacoes_;
    $this->nmgp_dados_form['guarda_cod_substituto_'] = $this->guarda_cod_substituto_;
    $this->nmgp_dados_form['part_cpf_informado_'] = $this->part_cpf_informado_;
    $this->nmgp_dados_form['part_cv_obs_'] = $this->part_cv_obs_;
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_form'][$sc_seq_vert] = $this->nmgp_dados_form;
   }
   function nm_tira_formatacao()
   {
      global $nm_form_submit;
         $this->Before_unformat = array();
         $this->formatado = false;
      $this->Before_unformat['part_id_evento_'] = $this->part_id_evento_;
      nm_limpa_numero($this->part_id_evento_, $this->field_config['part_id_evento_']['symbol_grp']) ; 
      $this->Before_unformat['part_id_evento_publico_'] = $this->part_id_evento_publico_;
      nm_limpa_numero($this->part_id_evento_publico_, $this->field_config['part_id_evento_publico_']['symbol_grp']) ; 
      $this->Before_unformat['part_dt_nasc_'] = $this->part_dt_nasc_;
      nm_limpa_data($this->part_dt_nasc_, $this->field_config['part_dt_nasc_']['date_sep']) ; 
      $this->Before_unformat['participante_id_'] = $this->participante_id_;
      nm_limpa_numero($this->participante_id_, $this->field_config['participante_id_']['symbol_grp']) ; 
      $this->Before_unformat['part_validade_pass_'] = $this->part_validade_pass_;
      nm_limpa_data($this->part_validade_pass_, $this->field_config['part_validade_pass_']['date_sep']) ; 
      $this->Before_unformat['part_cod_usuario_'] = $this->part_cod_usuario_;
      nm_limpa_numero($this->part_cod_usuario_, $this->field_config['part_cod_usuario_']['symbol_grp']) ; 
      $this->Before_unformat['part_dt_cadastro_'] = $this->part_dt_cadastro_;
      $this->Before_unformat['part_dt_cadastro__hora'] = $this->part_dt_cadastro__hora;
      nm_limpa_data($this->part_dt_cadastro_, $this->field_config['part_dt_cadastro_']['date_sep']) ; 
      nm_limpa_hora($this->part_dt_cadastro__hora, $this->field_config['part_dt_cadastro_']['time_sep']) ; 
      $this->Before_unformat['part_dt_alteracao_'] = $this->part_dt_alteracao_;
      $this->Before_unformat['part_dt_alteracao__hora'] = $this->part_dt_alteracao__hora;
      nm_limpa_data($this->part_dt_alteracao_, $this->field_config['part_dt_alteracao_']['date_sep']) ; 
      nm_limpa_hora($this->part_dt_alteracao__hora, $this->field_config['part_dt_alteracao_']['time_sep']) ; 
      $this->Before_unformat['part_dt_alt_contato_rsvp_'] = $this->part_dt_alt_contato_rsvp_;
      $this->Before_unformat['part_dt_alt_contato_rsvp__hora'] = $this->part_dt_alt_contato_rsvp__hora;
      nm_limpa_data($this->part_dt_alt_contato_rsvp_, $this->field_config['part_dt_alt_contato_rsvp_']['date_sep']) ; 
      nm_limpa_hora($this->part_dt_alt_contato_rsvp__hora, $this->field_config['part_dt_alt_contato_rsvp_']['time_sep']) ; 
      $this->Before_unformat['part_dt_alt_presenca_'] = $this->part_dt_alt_presenca_;
      $this->Before_unformat['part_dt_alt_presenca__hora'] = $this->part_dt_alt_presenca__hora;
      nm_limpa_data($this->part_dt_alt_presenca_, $this->field_config['part_dt_alt_presenca_']['date_sep']) ; 
      nm_limpa_hora($this->part_dt_alt_presenca__hora, $this->field_config['part_dt_alt_presenca_']['time_sep']) ; 
      $this->Before_unformat['part_dt_solicit_especial_'] = $this->part_dt_solicit_especial_;
      $this->Before_unformat['part_dt_solicit_especial__hora'] = $this->part_dt_solicit_especial__hora;
      nm_limpa_data($this->part_dt_solicit_especial_, $this->field_config['part_dt_solicit_especial_']['date_sep']) ; 
      nm_limpa_hora($this->part_dt_solicit_especial__hora, $this->field_config['part_dt_solicit_especial_']['time_sep']) ; 
      $this->Before_unformat['part_dt_programacao_'] = $this->part_dt_programacao_;
      $this->Before_unformat['part_dt_programacao__hora'] = $this->part_dt_programacao__hora;
      nm_limpa_data($this->part_dt_programacao_, $this->field_config['part_dt_programacao_']['date_sep']) ; 
      nm_limpa_hora($this->part_dt_programacao__hora, $this->field_config['part_dt_programacao_']['time_sep']) ; 
      $this->Before_unformat['part_dt_aereo_'] = $this->part_dt_aereo_;
      $this->Before_unformat['part_dt_aereo__hora'] = $this->part_dt_aereo__hora;
      nm_limpa_data($this->part_dt_aereo_, $this->field_config['part_dt_aereo_']['date_sep']) ; 
      nm_limpa_hora($this->part_dt_aereo__hora, $this->field_config['part_dt_aereo_']['time_sep']) ; 
      $this->Before_unformat['par_dt_hospedagem_'] = $this->par_dt_hospedagem_;
      $this->Before_unformat['par_dt_hospedagem__hora'] = $this->par_dt_hospedagem__hora;
      nm_limpa_data($this->par_dt_hospedagem_, $this->field_config['par_dt_hospedagem_']['date_sep']) ; 
      nm_limpa_hora($this->par_dt_hospedagem__hora, $this->field_config['par_dt_hospedagem_']['time_sep']) ; 
      $this->Before_unformat['part_dt_transfer_'] = $this->part_dt_transfer_;
      $this->Before_unformat['part_dt_transfer__hora'] = $this->part_dt_transfer__hora;
      nm_limpa_data($this->part_dt_transfer_, $this->field_config['part_dt_transfer_']['date_sep']) ; 
      nm_limpa_hora($this->part_dt_transfer__hora, $this->field_config['part_dt_transfer_']['time_sep']) ; 
      $this->Before_unformat['part_dt_opcionais_'] = $this->part_dt_opcionais_;
      $this->Before_unformat['part_dt_opcionais__hora'] = $this->part_dt_opcionais__hora;
      nm_limpa_data($this->part_dt_opcionais_, $this->field_config['part_dt_opcionais_']['date_sep']) ; 
      nm_limpa_hora($this->part_dt_opcionais__hora, $this->field_config['part_dt_opcionais_']['time_sep']) ; 
      $this->Before_unformat['part_save_the_date_'] = $this->part_save_the_date_;
      nm_limpa_data($this->part_save_the_date_, $this->field_config['part_save_the_date_']['date_sep']) ; 
      $this->Before_unformat['part_bloqueio_id_'] = $this->part_bloqueio_id_;
      nm_limpa_numero($this->part_bloqueio_id_, $this->field_config['part_bloqueio_id_']['symbol_grp']) ; 
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
      if ($Nome_Campo == "part_id_evento_")
      {
          nm_limpa_numero($this->part_id_evento_, $this->field_config['part_id_evento_']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "part_id_evento_publico_")
      {
          nm_limpa_numero($this->part_id_evento_publico_, $this->field_config['part_id_evento_publico_']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "participante_id_")
      {
          nm_limpa_numero($this->participante_id_, $this->field_config['participante_id_']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "part_cod_usuario_")
      {
          nm_limpa_numero($this->part_cod_usuario_, $this->field_config['part_cod_usuario_']['symbol_grp']) ; 
      }
      if ($Nome_Campo == "part_bloqueio_id_")
      {
          nm_limpa_numero($this->part_bloqueio_id_, $this->field_config['part_bloqueio_id_']['symbol_grp']) ; 
      }
   }
   function nm_formatar_campos($format_fields = array())
   {
      global $nm_form_submit;
      if ('' !== $this->part_id_evento_ || (!empty($format_fields) && isset($format_fields['part_id_evento_'])))
      {
          nmgp_Form_Num_Val($this->part_id_evento_, $this->field_config['part_id_evento_']['symbol_grp'], $this->field_config['part_id_evento_']['symbol_dec'], "0", "S", $this->field_config['part_id_evento_']['format_neg'], "", "", "-", $this->field_config['part_id_evento_']['symbol_fmt']) ; 
      }
      if ('' !== $this->part_id_evento_publico_ || (!empty($format_fields) && isset($format_fields['part_id_evento_publico_'])))
      {
          nmgp_Form_Num_Val($this->part_id_evento_publico_, $this->field_config['part_id_evento_publico_']['symbol_grp'], $this->field_config['part_id_evento_publico_']['symbol_dec'], "0", "S", $this->field_config['part_id_evento_publico_']['format_neg'], "", "", "-", $this->field_config['part_id_evento_publico_']['symbol_fmt']) ; 
      }
      if ((!empty($this->part_dt_nasc_) && 'null' != $this->part_dt_nasc_) || (!empty($format_fields) && isset($format_fields['part_dt_nasc_'])))
      {
          nm_volta_data($this->part_dt_nasc_, $this->field_config['part_dt_nasc_']['date_format']) ; 
          nmgp_Form_Datas($this->part_dt_nasc_, $this->field_config['part_dt_nasc_']['date_format'], $this->field_config['part_dt_nasc_']['date_sep']) ;  
      }
      elseif ('null' == $this->part_dt_nasc_ || '' == $this->part_dt_nasc_)
      {
          $this->part_dt_nasc_ = '';
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
      $guarda_format_hora = $this->field_config['part_dt_nasc_']['date_format'];
      if ($this->part_dt_nasc_ != "")  
      { 
          nm_conv_data($this->part_dt_nasc_, $this->field_config['part_dt_nasc_']['date_format']) ; 
          $this->part_dt_nasc__hora = "00:00:00:000" ; 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $this->part_dt_nasc__hora = substr($this->part_dt_nasc__hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_dt_nasc__hora = substr($this->part_dt_nasc__hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $this->part_dt_nasc__hora = substr($this->part_dt_nasc__hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $this->part_dt_nasc__hora = substr($this->part_dt_nasc__hora, 0, -4);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $this->part_dt_nasc__hora = substr($this->part_dt_nasc__hora, 0, -4);
          }
      } 
      if ($this->part_dt_nasc_ == "" && $use_null)  
      { 
          $this->part_dt_nasc_ = "null" ; 
      } 
      $this->field_config['part_dt_nasc_']['date_format'] = $guarda_format_hora;
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
              $this->NM_ajax_info['fldList']['participante_id_']['keyVal'] = form_participantes_rsvp_ar_pack_protect_string($this->nmgp_dados_form['participante_id_']);
          }
   } // ajax_return_values
   function ajax_return_values_all_vert()
   {
          if (isset($this->nmgp_refresh_fields) && isset($this->nmgp_refresh_row) && '' != $this->nmgp_refresh_row)
          {
              $this->form_vert_form_participantes_rsvp_ar[$this->nmgp_refresh_row] = $this->NM_ajax_info['param'];
              if ((isset($this->Embutida_ronly) && $this->Embutida_ronly) || $this->NM_ajax_force_values)
              {
                  if (isset($this->NM_ajax_changed['part_id_evento_']) && $this->NM_ajax_changed['part_id_evento_'])
                  {
                      $this->form_vert_form_participantes_rsvp_ar[$this->nmgp_refresh_row]['part_id_evento_'] = $this->part_id_evento_;
                  }
                  if (isset($this->NM_ajax_changed['part_cpf_']) && $this->NM_ajax_changed['part_cpf_'])
                  {
                      $this->form_vert_form_participantes_rsvp_ar[$this->nmgp_refresh_row]['part_cpf_'] = $this->part_cpf_;
                  }
                  if (isset($this->NM_ajax_changed['nome_pessoa_']) && $this->NM_ajax_changed['nome_pessoa_'])
                  {
                      $this->form_vert_form_participantes_rsvp_ar[$this->nmgp_refresh_row]['nome_pessoa_'] = $this->nome_pessoa_;
                  }
                  if (isset($this->NM_ajax_changed['part_sexo_']) && $this->NM_ajax_changed['part_sexo_'])
                  {
                      $this->form_vert_form_participantes_rsvp_ar[$this->nmgp_refresh_row]['part_sexo_'] = $this->part_sexo_;
                  }
                  if (isset($this->NM_ajax_changed['part_id_evento_publico_']) && $this->NM_ajax_changed['part_id_evento_publico_'])
                  {
                      $this->form_vert_form_participantes_rsvp_ar[$this->nmgp_refresh_row]['part_id_evento_publico_'] = $this->part_id_evento_publico_;
                  }
                  if (isset($this->NM_ajax_changed['part_id_evento_regional_']) && $this->NM_ajax_changed['part_id_evento_regional_'])
                  {
                      $this->form_vert_form_participantes_rsvp_ar[$this->nmgp_refresh_row]['part_id_evento_regional_'] = $this->part_id_evento_regional_;
                  }
                  if (isset($this->NM_ajax_changed['part_grupo_']) && $this->NM_ajax_changed['part_grupo_'])
                  {
                      $this->form_vert_form_participantes_rsvp_ar[$this->nmgp_refresh_row]['part_grupo_'] = $this->part_grupo_;
                  }
                  if (isset($this->NM_ajax_changed['part_clube_']) && $this->NM_ajax_changed['part_clube_'])
                  {
                      $this->form_vert_form_participantes_rsvp_ar[$this->nmgp_refresh_row]['part_clube_'] = $this->part_clube_;
                  }
                  if (isset($this->NM_ajax_changed['part_empresa_']) && $this->NM_ajax_changed['part_empresa_'])
                  {
                      $this->form_vert_form_participantes_rsvp_ar[$this->nmgp_refresh_row]['part_empresa_'] = $this->part_empresa_;
                  }
                  if (isset($this->NM_ajax_changed['part_uf_']) && $this->NM_ajax_changed['part_uf_'])
                  {
                      $this->form_vert_form_participantes_rsvp_ar[$this->nmgp_refresh_row]['part_uf_'] = $this->part_uf_;
                  }
                  if (isset($this->NM_ajax_changed['part_ddd_celular_01_']) && $this->NM_ajax_changed['part_ddd_celular_01_'])
                  {
                      $this->form_vert_form_participantes_rsvp_ar[$this->nmgp_refresh_row]['part_ddd_celular_01_'] = $this->part_ddd_celular_01_;
                  }
                  if (isset($this->NM_ajax_changed['part_celeular_01_']) && $this->NM_ajax_changed['part_celeular_01_'])
                  {
                      $this->form_vert_form_participantes_rsvp_ar[$this->nmgp_refresh_row]['part_celeular_01_'] = $this->part_celeular_01_;
                  }
                  if (isset($this->NM_ajax_changed['part_dt_nasc_']) && $this->NM_ajax_changed['part_dt_nasc_'])
                  {
                      $this->form_vert_form_participantes_rsvp_ar[$this->nmgp_refresh_row]['part_dt_nasc_'] = $this->part_dt_nasc_;
                  }
                  if (isset($this->NM_ajax_changed['part_tam_camisa_']) && $this->NM_ajax_changed['part_tam_camisa_'])
                  {
                      $this->form_vert_form_participantes_rsvp_ar[$this->nmgp_refresh_row]['part_tam_camisa_'] = $this->part_tam_camisa_;
                  }
                  if (isset($this->NM_ajax_changed['part_tam_calcado_']) && $this->NM_ajax_changed['part_tam_calcado_'])
                  {
                      $this->form_vert_form_participantes_rsvp_ar[$this->nmgp_refresh_row]['part_tam_calcado_'] = $this->part_tam_calcado_;
                  }
              }
          }
          if (isset($this->nmgp_refresh_row) && '' != $this->nmgp_refresh_row)
          {
              $this->form_vert_form_participantes_rsvp_ar[$this->nmgp_refresh_row]['part_cpf_'] = $this->part_cpf_;
              $this->form_vert_form_participantes_rsvp_ar[$this->nmgp_refresh_row]['nome_pessoa_'] = $this->nome_pessoa_;
              $this->form_vert_form_participantes_rsvp_ar[$this->nmgp_refresh_row]['part_grupo_'] = $this->part_grupo_;
              $this->form_vert_form_participantes_rsvp_ar[$this->nmgp_refresh_row]['part_clube_'] = $this->part_clube_;
              $this->form_vert_form_participantes_rsvp_ar[$this->nmgp_refresh_row]['part_empresa_'] = $this->part_empresa_;
              $this->form_vert_form_participantes_rsvp_ar[$this->nmgp_refresh_row]['part_uf_'] = $this->part_uf_;
              $this->form_vert_form_participantes_rsvp_ar[$this->nmgp_refresh_row]['part_ddd_celular_01_'] = $this->part_ddd_celular_01_;
              $this->form_vert_form_participantes_rsvp_ar[$this->nmgp_refresh_row]['part_celeular_01_'] = $this->part_celeular_01_;
              $this->form_vert_form_participantes_rsvp_ar[$this->nmgp_refresh_row]['part_tam_camisa_'] = $this->part_tam_camisa_;
              $this->form_vert_form_participantes_rsvp_ar[$this->nmgp_refresh_row]['part_tam_calcado_'] = $this->part_tam_calcado_;
          }
          $this->NM_ajax_info['rsSize']            = sizeof($this->form_vert_form_participantes_rsvp_ar);
          $this->NM_ajax_info['buttonDisplayVert'] = array();
          foreach($this->form_vert_form_participantes_rsvp_ar as $sc_seq_vert => $aRecData)
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
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("part_id_evento_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['part_id_evento_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['part_id_evento_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'label',
                       'valList' => array($sTmpValue),
                       );
              $this->part_id_evento_ = $aRecData['part_id_evento_'];
              $orig_part_id_evento_ = $this->part_id_evento_;
              $part_id_evento_      = $this->part_id_evento_;
              nm_limpa_numero($part_id_evento_, $this->field_config['part_id_evento_']['symbol_grp']); 
              $this->part_id_evento_ = $part_id_evento_;
              $this->lookup_part_id_evento_($conteudo);
              $this->part_id_evento_ = $orig_part_id_evento_;
              $this->NM_ajax_info['fldList']['part_id_evento_' . $sc_seq_vert]['lookupCons'] = form_participantes_rsvp_ar_pack_protect_string($conteudo);
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("part_cpf_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['part_cpf_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['part_cpf_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'label',
                       'valList' => array($this->form_encode_input($sTmpValue)),
                       );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("nome_pessoa_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['nome_pessoa_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['nome_pessoa_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'label',
                       'valList' => array($this->form_encode_input($sTmpValue)),
                       );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("part_sexo_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['part_sexo_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['part_sexo_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'text',
                       'valList' => array($sTmpValue),
                       );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("part_id_evento_publico_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['part_id_evento_publico_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['part_id_evento_publico_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'text',
                       'valList' => array($sTmpValue),
                       );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("part_id_evento_regional_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['part_id_evento_regional_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['part_id_evento_regional_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'text',
                       'valList' => array($sTmpValue),
                       );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("part_grupo_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['part_grupo_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['part_grupo_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'text',
                       'valList' => array($sTmpValue),
                       );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("part_clube_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['part_clube_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['part_clube_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'text',
                       'valList' => array($sTmpValue),
                       );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("part_empresa_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['part_empresa_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['part_empresa_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'text',
                       'valList' => array($sTmpValue),
                       );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("part_uf_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['part_uf_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['part_uf_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'text',
                       'valList' => array($sTmpValue),
                       );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("part_ddd_celular_01_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['part_ddd_celular_01_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['part_ddd_celular_01_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'text',
                       'valList' => array($sTmpValue),
                       );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("part_celeular_01_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['part_celeular_01_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['part_celeular_01_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'text',
                       'valList' => array($sTmpValue),
                       );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("part_dt_nasc_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['part_dt_nasc_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['part_dt_nasc_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'text',
                       'valList' => array($sTmpValue),
                       );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("part_tam_camisa_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['part_tam_camisa_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['part_tam_camisa_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'text',
                       'valList' => array($sTmpValue),
                       );
              }
              if ('navigate_form' == $this->NM_ajax_opcao || 'backup_line' == $this->NM_ajax_opcao || (isset($this->nmgp_refresh_fields) && in_array("part_tam_calcado_", $this->nmgp_refresh_fields)))
              {
                  $sTmpValue = NM_charset_to_utf8($aRecData['part_tam_calcado_']);
                  $aLookup = array();
          $aLookupOrig = $aLookup;
                  $this->NM_ajax_info['fldList']['part_tam_calcado_' . $sc_seq_vert] = array(
                       'row'    => $sc_seq_vert,
                       'type'    => 'text',
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['upload_dir'][$fieldName] = array();
            $resDir = @opendir($uploadDir);
            if (!$resDir)
            {
                return $originalName;
            }
            while (false !== ($fileName = @readdir($resDir)))
            {
                if (@is_file($uploadDir . $fileName))
                {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['upload_dir'][$fieldName][] = $fileName;
                }
            }
            @closedir($resDir);
        }
        if (!in_array($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['upload_dir'][$fieldName]))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['upload_dir'][$fieldName][] = $originalName;
            return $originalName;
        }
        else
        {
            $newName = $this->fetchFileNextName($originalName, $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['upload_dir'][$fieldName]);
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['upload_dir'][$fieldName][] = $newName;
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
  }
  function nm_proc_onload($bFormat = true)
  {
      $Ctrl_Proc_Onload = true;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['Field_no_validate'] = array();
      if (!$this->NM_ajax_flag || !isset($this->nmgp_refresh_fields)) {
      $_SESSION['scriptcase']['form_participantes_rsvp_ar']['contr_erro'] = 'on';
  date_default_timezone_set('America/Sao_Paulo');
$this->NM_ajax_info['buttonDisplay']['new'] = $this->nmgp_botoes["new"] = 'off';;
$_SESSION['scriptcase']['form_participantes_rsvp_ar']['contr_erro'] = 'off'; 
      }
      if (empty($this->part_dt_cadastro_))
      {
          $this->part_dt_cadastro__hora = $this->part_dt_cadastro_;
      }
      if (empty($this->part_dt_alteracao_))
      {
          $this->part_dt_alteracao__hora = $this->part_dt_alteracao_;
      }
      if (empty($this->part_dt_alt_contato_rsvp_))
      {
          $this->part_dt_alt_contato_rsvp__hora = $this->part_dt_alt_contato_rsvp_;
      }
      if (empty($this->part_dt_alt_presenca_))
      {
          $this->part_dt_alt_presenca__hora = $this->part_dt_alt_presenca_;
      }
      if (empty($this->part_dt_solicit_especial_))
      {
          $this->part_dt_solicit_especial__hora = $this->part_dt_solicit_especial_;
      }
      if (empty($this->part_dt_programacao_))
      {
          $this->part_dt_programacao__hora = $this->part_dt_programacao_;
      }
      if (empty($this->part_dt_aereo_))
      {
          $this->part_dt_aereo__hora = $this->part_dt_aereo_;
      }
      if (empty($this->par_dt_hospedagem_))
      {
          $this->par_dt_hospedagem__hora = $this->par_dt_hospedagem_;
      }
      if (empty($this->part_dt_transfer_))
      {
          $this->part_dt_transfer__hora = $this->part_dt_transfer_;
      }
      if (empty($this->part_dt_opcionais_))
      {
          $this->part_dt_opcionais__hora = $this->part_dt_opcionais_;
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
      if ($this->nmgp_opcao == "alterar")
      {
          $this->nmgp_dados_select = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert];
          if ($this->nmgp_dados_select['part_id_evento_'] == $this->part_id_evento_ &&
              $this->nmgp_dados_select['part_cpf_'] == $this->part_cpf_ &&
              $this->nmgp_dados_select['nome_pessoa_'] == $this->nome_pessoa_ &&
              $this->nmgp_dados_select['part_sexo_'] == $this->part_sexo_ &&
              $this->nmgp_dados_select['part_id_evento_publico_'] == $this->part_id_evento_publico_ &&
              $this->nmgp_dados_select['part_id_evento_regional_'] == $this->part_id_evento_regional_ &&
              $this->nmgp_dados_select['part_grupo_'] == $this->part_grupo_ &&
              $this->nmgp_dados_select['part_clube_'] == $this->part_clube_ &&
              $this->nmgp_dados_select['part_empresa_'] == $this->part_empresa_ &&
              $this->nmgp_dados_select['part_uf_'] == $this->part_uf_ &&
              $this->nmgp_dados_select['part_ddd_celular_01_'] == $this->part_ddd_celular_01_ &&
              $this->nmgp_dados_select['part_celeular_01_'] == $this->part_celeular_01_ &&
              $this->nmgp_dados_select['part_dt_nasc_'] == $this->part_dt_nasc_ &&
              $this->nmgp_dados_select['part_tam_camisa_'] == $this->part_tam_camisa_ &&
              $this->nmgp_dados_select['part_tam_calcado_'] == $this->part_tam_calcado_)
          { }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_id_evento_'] = $this->part_id_evento_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_cpf_'] = $this->part_cpf_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['nome_pessoa_'] = $this->nome_pessoa_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_sexo_'] = $this->part_sexo_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_id_evento_publico_'] = $this->part_id_evento_publico_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_id_evento_regional_'] = $this->part_id_evento_regional_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_grupo_'] = $this->part_grupo_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_clube_'] = $this->part_clube_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_empresa_'] = $this->part_empresa_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_uf_'] = $this->part_uf_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_ddd_celular_01_'] = $this->part_ddd_celular_01_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_celeular_01_'] = $this->part_celeular_01_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_dt_nasc_'] = $this->part_dt_nasc_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_tam_camisa_'] = $this->part_tam_camisa_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_tam_calcado_'] = $this->part_tam_calcado_;
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
      $NM_val_form['part_id_evento_'] = $this->part_id_evento_;
      $NM_val_form['part_cpf_'] = $this->part_cpf_;
      $NM_val_form['nome_pessoa_'] = $this->nome_pessoa_;
      $NM_val_form['part_sexo_'] = $this->part_sexo_;
      $NM_val_form['part_id_evento_publico_'] = $this->part_id_evento_publico_;
      $NM_val_form['part_id_evento_regional_'] = $this->part_id_evento_regional_;
      $NM_val_form['part_grupo_'] = $this->part_grupo_;
      $NM_val_form['part_clube_'] = $this->part_clube_;
      $NM_val_form['part_empresa_'] = $this->part_empresa_;
      $NM_val_form['part_uf_'] = $this->part_uf_;
      $NM_val_form['part_ddd_celular_01_'] = $this->part_ddd_celular_01_;
      $NM_val_form['part_celeular_01_'] = $this->part_celeular_01_;
      $NM_val_form['part_dt_nasc_'] = $this->part_dt_nasc_;
      $NM_val_form['part_tam_camisa_'] = $this->part_tam_camisa_;
      $NM_val_form['part_tam_calcado_'] = $this->part_tam_calcado_;
      $NM_val_form['participante_id_'] = $this->participante_id_;
      $NM_val_form['part_ativo_'] = $this->part_ativo_;
      $NM_val_form['part_cpf_substituto_'] = $this->part_cpf_substituto_;
      $NM_val_form['part_crnm_'] = $this->part_crnm_;
      $NM_val_form['part_tipo_'] = $this->part_tipo_;
      $NM_val_form['part_nome_cracha_'] = $this->part_nome_cracha_;
      $NM_val_form['part_tipo_pessoa_'] = $this->part_tipo_pessoa_;
      $NM_val_form['part_substituido_'] = $this->part_substituido_;
      $NM_val_form['part_substituto_'] = $this->part_substituto_;
      $NM_val_form['part_cod_substituto_'] = $this->part_cod_substituto_;
      $NM_val_form['part_nome_substituto_'] = $this->part_nome_substituto_;
      $NM_val_form['part_sexo_substituto_'] = $this->part_sexo_substituto_;
      $NM_val_form['part_cod_substituido_'] = $this->part_cod_substituido_;
      $NM_val_form['part_nome_substituido_'] = $this->part_nome_substituido_;
      $NM_val_form['part_cep_'] = $this->part_cep_;
      $NM_val_form['part_departamento_'] = $this->part_departamento_;
      $NM_val_form['part_cargo_'] = $this->part_cargo_;
      $NM_val_form['part_logradouro_'] = $this->part_logradouro_;
      $NM_val_form['part_numero_'] = $this->part_numero_;
      $NM_val_form['part_complemento_'] = $this->part_complemento_;
      $NM_val_form['part_bairro_'] = $this->part_bairro_;
      $NM_val_form['part_cidade_'] = $this->part_cidade_;
      $NM_val_form['part_ddd_01_'] = $this->part_ddd_01_;
      $NM_val_form['part_fone_01_'] = $this->part_fone_01_;
      $NM_val_form['part_ddd_02_'] = $this->part_ddd_02_;
      $NM_val_form['part_fone_02_'] = $this->part_fone_02_;
      $NM_val_form['part_ddd_03_'] = $this->part_ddd_03_;
      $NM_val_form['part_fone_03_'] = $this->part_fone_03_;
      $NM_val_form['part_ddd_fax_'] = $this->part_ddd_fax_;
      $NM_val_form['part_fax_'] = $this->part_fax_;
      $NM_val_form['part_ddd_celular_02_'] = $this->part_ddd_celular_02_;
      $NM_val_form['part_celular_02_'] = $this->part_celular_02_;
      $NM_val_form['part_fone_internacional_'] = $this->part_fone_internacional_;
      $NM_val_form['part_email_'] = $this->part_email_;
      $NM_val_form['part_rg_'] = $this->part_rg_;
      $NM_val_form['part_passaporte_'] = $this->part_passaporte_;
      $NM_val_form['part_validade_pass_'] = $this->part_validade_pass_;
      $NM_val_form['part_passaporte_estrangeiro_'] = $this->part_passaporte_estrangeiro_;
      $NM_val_form['part_ind_voucher_'] = $this->part_ind_voucher_;
      $NM_val_form['part_num_voucher_'] = $this->part_num_voucher_;
      $NM_val_form['part_idioma_'] = $this->part_idioma_;
      $NM_val_form['part_filiacao_'] = $this->part_filiacao_;
      $NM_val_form['part_pais_'] = $this->part_pais_;
      $NM_val_form['part_nome_secretaria_'] = $this->part_nome_secretaria_;
      $NM_val_form['part_email_secretaria_'] = $this->part_email_secretaria_;
      $NM_val_form['part_cod_usuario_'] = $this->part_cod_usuario_;
      $NM_val_form['part_dt_cadastro_'] = $this->part_dt_cadastro_;
      $NM_val_form['part_dt_alteracao_'] = $this->part_dt_alteracao_;
      $NM_val_form['part_contato_rsvp_'] = $this->part_contato_rsvp_;
      $NM_val_form['part_dt_alt_contato_rsvp_'] = $this->part_dt_alt_contato_rsvp_;
      $NM_val_form['part_presenca_'] = $this->part_presenca_;
      $NM_val_form['part_dt_alt_presenca_'] = $this->part_dt_alt_presenca_;
      $NM_val_form['part_solicit_especial_'] = $this->part_solicit_especial_;
      $NM_val_form['part_dt_solicit_especial_'] = $this->part_dt_solicit_especial_;
      $NM_val_form['part_programacao_'] = $this->part_programacao_;
      $NM_val_form['part_dt_programacao_'] = $this->part_dt_programacao_;
      $NM_val_form['part_aereo_'] = $this->part_aereo_;
      $NM_val_form['part_dt_aereo_'] = $this->part_dt_aereo_;
      $NM_val_form['part_hospedagem_'] = $this->part_hospedagem_;
      $NM_val_form['par_dt_hospedagem_'] = $this->par_dt_hospedagem_;
      $NM_val_form['part_dt_transfer_'] = $this->part_dt_transfer_;
      $NM_val_form['part_opcionais_'] = $this->part_opcionais_;
      $NM_val_form['part_dt_opcionais_'] = $this->part_dt_opcionais_;
      $NM_val_form['part_notas_'] = $this->part_notas_;
      $NM_val_form['part_confirm_viagem_'] = $this->part_confirm_viagem_;
      $NM_val_form['part_convite_'] = $this->part_convite_;
      $NM_val_form['part_concluido_'] = $this->part_concluido_;
      $NM_val_form['part_transfer_'] = $this->part_transfer_;
      $NM_val_form['part_convite_enviado_'] = $this->part_convite_enviado_;
      $NM_val_form['part_destaque_negrito_'] = $this->part_destaque_negrito_;
      $NM_val_form['part_atendimento_'] = $this->part_atendimento_;
      $NM_val_form['part_save_the_date_'] = $this->part_save_the_date_;
      $NM_val_form['part_arq_save_'] = $this->part_arq_save_;
      $NM_val_form['part_arq_convite_'] = $this->part_arq_convite_;
      $NM_val_form['part_fumante_'] = $this->part_fumante_;
      $NM_val_form['part_restricao_alimentar_'] = $this->part_restricao_alimentar_;
      $NM_val_form['part_acompanhado_'] = $this->part_acompanhado_;
      $NM_val_form['part_acompanhado_hotel_'] = $this->part_acompanhado_hotel_;
      $NM_val_form['part_acom_completo_'] = $this->part_acom_completo_;
      $NM_val_form['part_acom_incompleto_'] = $this->part_acom_incompleto_;
      $NM_val_form['part_incompleto_'] = $this->part_incompleto_;
      $NM_val_form['part_aereo_ok_'] = $this->part_aereo_ok_;
      $NM_val_form['part_bloqueio_id_'] = $this->part_bloqueio_id_;
      $NM_val_form['part_hotel_'] = $this->part_hotel_;
      $NM_val_form['part_anotacoes_'] = $this->part_anotacoes_;
      $NM_val_form['guarda_cod_substituto_'] = $this->guarda_cod_substituto_;
      $NM_val_form['part_cpf_informado_'] = $this->part_cpf_informado_;
      $NM_val_form['part_cv_obs_'] = $this->part_cv_obs_;
      if ($this->participante_id_ === "" || is_null($this->participante_id_))  
      { 
          $this->participante_id_ = 0;
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->nmgp_opcao == "alterar")
      {
      }
      if ($this->part_id_evento_ === "" || is_null($this->part_id_evento_))  
      { 
          $this->part_id_evento_ = 0;
          $this->sc_force_zero[] = 'part_id_evento_';
      } 
      if ($this->part_id_evento_publico_ === "" || is_null($this->part_id_evento_publico_))  
      { 
          $this->part_id_evento_publico_ = 0;
          $this->sc_force_zero[] = 'part_id_evento_publico_';
      } 
      if ($this->part_id_evento_regional_ === "" || is_null($this->part_id_evento_regional_))  
      { 
          $this->part_id_evento_regional_ = 0;
          $this->sc_force_zero[] = 'part_id_evento_regional_';
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
      if ($this->part_cod_usuario_ === "" || is_null($this->part_cod_usuario_))  
      { 
          $this->part_cod_usuario_ = 0;
          $this->sc_force_zero[] = 'part_cod_usuario_';
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
      if ($this->part_bloqueio_id_ === "" || is_null($this->part_bloqueio_id_))  
      { 
          $this->part_bloqueio_id_ = 0;
          $this->sc_force_zero[] = 'part_bloqueio_id_';
      } 
      if ($this->nmgp_opcao == "alterar")
      {
      }
      $nm_bases_lob_geral = array_merge($this->Ini->nm_bases_oracle, $this->Ini->nm_bases_ibase, $this->Ini->nm_bases_informix, $this->Ini->nm_bases_mysql, $this->Ini->nm_bases_access, $this->Ini->nm_bases_sqlite, $this->Ini->nm_bases_db2, array('pdo_sqlsrv'));
      if ($this->nmgp_opcao == "alterar" || $this->nmgp_opcao == "incluir") 
      {
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_ativo_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_ativo_ = "null"; 
                  $this->NM_val_null[] = "part_ativo_";
              } 
          }
          if ($this->part_sexo_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_sexo_ = "null"; 
              $this->NM_val_null[] = "part_sexo_";
          } 
          $this->part_cpf__before_qstr = $this->part_cpf_;
          $this->part_cpf_ = substr($this->Db->qstr($this->part_cpf_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_cpf_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_cpf_);
          }
          if ($this->part_cpf_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_cpf_ = "null"; 
              $this->NM_val_null[] = "part_cpf_";
          } 
          $this->nome_pessoa__before_qstr = $this->nome_pessoa_;
          $this->nome_pessoa_ = substr($this->Db->qstr($this->nome_pessoa_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->nome_pessoa_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->nome_pessoa_);
          }
          if ($this->nome_pessoa_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->nome_pessoa_ = "null"; 
              $this->NM_val_null[] = "nome_pessoa_";
          } 
          $this->part_cpf_substituto__before_qstr = $this->part_cpf_substituto_;
          $this->part_cpf_substituto_ = substr($this->Db->qstr($this->part_cpf_substituto_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_cpf_substituto_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_cpf_substituto_);
          }
          if ($this->part_cpf_substituto_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_cpf_substituto_ = "null"; 
              $this->NM_val_null[] = "part_cpf_substituto_";
          } 
          $this->part_crnm__before_qstr = $this->part_crnm_;
          $this->part_crnm_ = substr($this->Db->qstr($this->part_crnm_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_crnm_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_crnm_);
          }
          if ($this->part_crnm_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_crnm_ = "null"; 
              $this->NM_val_null[] = "part_crnm_";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_tipo_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_tipo_ = "null"; 
                  $this->NM_val_null[] = "part_tipo_";
              } 
          }
          $this->part_nome_cracha__before_qstr = $this->part_nome_cracha_;
          $this->part_nome_cracha_ = substr($this->Db->qstr($this->part_nome_cracha_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_nome_cracha_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_nome_cracha_);
          }
          if ($this->part_nome_cracha_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_nome_cracha_ = "null"; 
              $this->NM_val_null[] = "part_nome_cracha_";
          } 
          if ($this->part_tipo_pessoa_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_tipo_pessoa_ = "null"; 
              $this->NM_val_null[] = "part_tipo_pessoa_";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_substituido_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_substituido_ = "null"; 
                  $this->NM_val_null[] = "part_substituido_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_substituto_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_substituto_ = "null"; 
                  $this->NM_val_null[] = "part_substituto_";
              } 
          }
          $this->part_cod_substituto__before_qstr = $this->part_cod_substituto_;
          $this->part_cod_substituto_ = substr($this->Db->qstr($this->part_cod_substituto_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_cod_substituto_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_cod_substituto_);
          }
          if ($this->part_cod_substituto_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_cod_substituto_ = "null"; 
              $this->NM_val_null[] = "part_cod_substituto_";
          } 
          $this->part_nome_substituto__before_qstr = $this->part_nome_substituto_;
          $this->part_nome_substituto_ = substr($this->Db->qstr($this->part_nome_substituto_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_nome_substituto_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_nome_substituto_);
          }
          if ($this->part_nome_substituto_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_nome_substituto_ = "null"; 
              $this->NM_val_null[] = "part_nome_substituto_";
          } 
          if ($this->part_sexo_substituto_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_sexo_substituto_ = "null"; 
              $this->NM_val_null[] = "part_sexo_substituto_";
          } 
          $this->part_cod_substituido__before_qstr = $this->part_cod_substituido_;
          $this->part_cod_substituido_ = substr($this->Db->qstr($this->part_cod_substituido_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_cod_substituido_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_cod_substituido_);
          }
          if ($this->part_cod_substituido_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_cod_substituido_ = "null"; 
              $this->NM_val_null[] = "part_cod_substituido_";
          } 
          $this->part_nome_substituido__before_qstr = $this->part_nome_substituido_;
          $this->part_nome_substituido_ = substr($this->Db->qstr($this->part_nome_substituido_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_nome_substituido_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_nome_substituido_);
          }
          if ($this->part_nome_substituido_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_nome_substituido_ = "null"; 
              $this->NM_val_null[] = "part_nome_substituido_";
          } 
          $this->part_grupo__before_qstr = $this->part_grupo_;
          $this->part_grupo_ = substr($this->Db->qstr($this->part_grupo_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_grupo_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_grupo_);
          }
          if ($this->part_grupo_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_grupo_ = "null"; 
              $this->NM_val_null[] = "part_grupo_";
          } 
          $this->part_clube__before_qstr = $this->part_clube_;
          $this->part_clube_ = substr($this->Db->qstr($this->part_clube_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_clube_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_clube_);
          }
          if ($this->part_clube_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_clube_ = "null"; 
              $this->NM_val_null[] = "part_clube_";
          } 
          $this->part_empresa__before_qstr = $this->part_empresa_;
          $this->part_empresa_ = substr($this->Db->qstr($this->part_empresa_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_empresa_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_empresa_);
          }
          if ($this->part_empresa_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_empresa_ = "null"; 
              $this->NM_val_null[] = "part_empresa_";
          } 
          $this->part_cep__before_qstr = $this->part_cep_;
          $this->part_cep_ = substr($this->Db->qstr($this->part_cep_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_cep_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_cep_);
          }
          if ($this->part_cep_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_cep_ = "null"; 
              $this->NM_val_null[] = "part_cep_";
          } 
          $this->part_departamento__before_qstr = $this->part_departamento_;
          $this->part_departamento_ = substr($this->Db->qstr($this->part_departamento_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_departamento_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_departamento_);
          }
          if ($this->part_departamento_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_departamento_ = "null"; 
              $this->NM_val_null[] = "part_departamento_";
          } 
          $this->part_cargo__before_qstr = $this->part_cargo_;
          $this->part_cargo_ = substr($this->Db->qstr($this->part_cargo_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_cargo_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_cargo_);
          }
          if ($this->part_cargo_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_cargo_ = "null"; 
              $this->NM_val_null[] = "part_cargo_";
          } 
          $this->part_logradouro__before_qstr = $this->part_logradouro_;
          $this->part_logradouro_ = substr($this->Db->qstr($this->part_logradouro_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_logradouro_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_logradouro_);
          }
          if ($this->part_logradouro_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_logradouro_ = "null"; 
              $this->NM_val_null[] = "part_logradouro_";
          } 
          $this->part_numero__before_qstr = $this->part_numero_;
          $this->part_numero_ = substr($this->Db->qstr($this->part_numero_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_numero_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_numero_);
          }
          if ($this->part_numero_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_numero_ = "null"; 
              $this->NM_val_null[] = "part_numero_";
          } 
          $this->part_complemento__before_qstr = $this->part_complemento_;
          $this->part_complemento_ = substr($this->Db->qstr($this->part_complemento_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_complemento_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_complemento_);
          }
          if ($this->part_complemento_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_complemento_ = "null"; 
              $this->NM_val_null[] = "part_complemento_";
          } 
          $this->part_bairro__before_qstr = $this->part_bairro_;
          $this->part_bairro_ = substr($this->Db->qstr($this->part_bairro_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_bairro_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_bairro_);
          }
          if ($this->part_bairro_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_bairro_ = "null"; 
              $this->NM_val_null[] = "part_bairro_";
          } 
          $this->part_cidade__before_qstr = $this->part_cidade_;
          $this->part_cidade_ = substr($this->Db->qstr($this->part_cidade_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_cidade_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_cidade_);
          }
          if ($this->part_cidade_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_cidade_ = "null"; 
              $this->NM_val_null[] = "part_cidade_";
          } 
          $this->part_uf__before_qstr = $this->part_uf_;
          $this->part_uf_ = substr($this->Db->qstr($this->part_uf_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_uf_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_uf_);
          }
          if ($this->part_uf_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_uf_ = "null"; 
              $this->NM_val_null[] = "part_uf_";
          } 
          $this->part_ddd_01__before_qstr = $this->part_ddd_01_;
          $this->part_ddd_01_ = substr($this->Db->qstr($this->part_ddd_01_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_ddd_01_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_ddd_01_);
          }
          if ($this->part_ddd_01_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_ddd_01_ = "null"; 
              $this->NM_val_null[] = "part_ddd_01_";
          } 
          $this->part_fone_01__before_qstr = $this->part_fone_01_;
          $this->part_fone_01_ = substr($this->Db->qstr($this->part_fone_01_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_fone_01_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_fone_01_);
          }
          if ($this->part_fone_01_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_fone_01_ = "null"; 
              $this->NM_val_null[] = "part_fone_01_";
          } 
          $this->part_ddd_02__before_qstr = $this->part_ddd_02_;
          $this->part_ddd_02_ = substr($this->Db->qstr($this->part_ddd_02_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_ddd_02_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_ddd_02_);
          }
          if ($this->part_ddd_02_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_ddd_02_ = "null"; 
              $this->NM_val_null[] = "part_ddd_02_";
          } 
          $this->part_fone_02__before_qstr = $this->part_fone_02_;
          $this->part_fone_02_ = substr($this->Db->qstr($this->part_fone_02_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_fone_02_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_fone_02_);
          }
          if ($this->part_fone_02_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_fone_02_ = "null"; 
              $this->NM_val_null[] = "part_fone_02_";
          } 
          $this->part_ddd_03__before_qstr = $this->part_ddd_03_;
          $this->part_ddd_03_ = substr($this->Db->qstr($this->part_ddd_03_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_ddd_03_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_ddd_03_);
          }
          if ($this->part_ddd_03_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_ddd_03_ = "null"; 
              $this->NM_val_null[] = "part_ddd_03_";
          } 
          $this->part_fone_03__before_qstr = $this->part_fone_03_;
          $this->part_fone_03_ = substr($this->Db->qstr($this->part_fone_03_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_fone_03_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_fone_03_);
          }
          if ($this->part_fone_03_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_fone_03_ = "null"; 
              $this->NM_val_null[] = "part_fone_03_";
          } 
          $this->part_ddd_fax__before_qstr = $this->part_ddd_fax_;
          $this->part_ddd_fax_ = substr($this->Db->qstr($this->part_ddd_fax_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_ddd_fax_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_ddd_fax_);
          }
          if ($this->part_ddd_fax_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_ddd_fax_ = "null"; 
              $this->NM_val_null[] = "part_ddd_fax_";
          } 
          $this->part_fax__before_qstr = $this->part_fax_;
          $this->part_fax_ = substr($this->Db->qstr($this->part_fax_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_fax_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_fax_);
          }
          if ($this->part_fax_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_fax_ = "null"; 
              $this->NM_val_null[] = "part_fax_";
          } 
          $this->part_ddd_celular_01__before_qstr = $this->part_ddd_celular_01_;
          $this->part_ddd_celular_01_ = substr($this->Db->qstr($this->part_ddd_celular_01_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_ddd_celular_01_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_ddd_celular_01_);
          }
          if ($this->part_ddd_celular_01_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_ddd_celular_01_ = "null"; 
              $this->NM_val_null[] = "part_ddd_celular_01_";
          } 
          $this->part_celeular_01__before_qstr = $this->part_celeular_01_;
          $this->part_celeular_01_ = substr($this->Db->qstr($this->part_celeular_01_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_celeular_01_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_celeular_01_);
          }
          if ($this->part_celeular_01_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_celeular_01_ = "null"; 
              $this->NM_val_null[] = "part_celeular_01_";
          } 
          $this->part_ddd_celular_02__before_qstr = $this->part_ddd_celular_02_;
          $this->part_ddd_celular_02_ = substr($this->Db->qstr($this->part_ddd_celular_02_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_ddd_celular_02_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_ddd_celular_02_);
          }
          if ($this->part_ddd_celular_02_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_ddd_celular_02_ = "null"; 
              $this->NM_val_null[] = "part_ddd_celular_02_";
          } 
          $this->part_celular_02__before_qstr = $this->part_celular_02_;
          $this->part_celular_02_ = substr($this->Db->qstr($this->part_celular_02_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_celular_02_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_celular_02_);
          }
          if ($this->part_celular_02_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_celular_02_ = "null"; 
              $this->NM_val_null[] = "part_celular_02_";
          } 
          $this->part_fone_internacional__before_qstr = $this->part_fone_internacional_;
          $this->part_fone_internacional_ = substr($this->Db->qstr($this->part_fone_internacional_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_fone_internacional_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_fone_internacional_);
          }
          if ($this->part_fone_internacional_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_fone_internacional_ = "null"; 
              $this->NM_val_null[] = "part_fone_internacional_";
          } 
          $this->part_email__before_qstr = $this->part_email_;
          $this->part_email_ = substr($this->Db->qstr($this->part_email_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_email_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_email_);
          }
          if ($this->part_email_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_email_ = "null"; 
              $this->NM_val_null[] = "part_email_";
          } 
          if ($this->part_dt_nasc_ == "")  
          { 
              $this->part_dt_nasc_ = "null"; 
              $this->NM_val_null[] = "part_dt_nasc_";
          } 
          $this->part_rg__before_qstr = $this->part_rg_;
          $this->part_rg_ = substr($this->Db->qstr($this->part_rg_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_rg_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_rg_);
          }
          if ($this->part_rg_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_rg_ = "null"; 
              $this->NM_val_null[] = "part_rg_";
          } 
          $this->part_passaporte__before_qstr = $this->part_passaporte_;
          $this->part_passaporte_ = substr($this->Db->qstr($this->part_passaporte_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_passaporte_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_passaporte_);
          }
          if ($this->part_passaporte_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_passaporte_ = "null"; 
              $this->NM_val_null[] = "part_passaporte_";
          } 
          if ($this->part_validade_pass_ == "")  
          { 
              $this->part_validade_pass_ = "null"; 
              $this->NM_val_null[] = "part_validade_pass_";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_passaporte_estrangeiro_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_passaporte_estrangeiro_ = "null"; 
                  $this->NM_val_null[] = "part_passaporte_estrangeiro_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_ind_voucher_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_ind_voucher_ = "null"; 
                  $this->NM_val_null[] = "part_ind_voucher_";
              } 
          }
          $this->part_num_voucher__before_qstr = $this->part_num_voucher_;
          $this->part_num_voucher_ = substr($this->Db->qstr($this->part_num_voucher_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_num_voucher_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_num_voucher_);
          }
          if ($this->part_num_voucher_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_num_voucher_ = "null"; 
              $this->NM_val_null[] = "part_num_voucher_";
          } 
          $this->part_tam_camisa__before_qstr = $this->part_tam_camisa_;
          $this->part_tam_camisa_ = substr($this->Db->qstr($this->part_tam_camisa_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_tam_camisa_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_tam_camisa_);
          }
          if ($this->part_tam_camisa_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_tam_camisa_ = "null"; 
              $this->NM_val_null[] = "part_tam_camisa_";
          } 
          $this->part_tam_calcado__before_qstr = $this->part_tam_calcado_;
          $this->part_tam_calcado_ = substr($this->Db->qstr($this->part_tam_calcado_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_tam_calcado_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_tam_calcado_);
          }
          if ($this->part_tam_calcado_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_tam_calcado_ = "null"; 
              $this->NM_val_null[] = "part_tam_calcado_";
          } 
          $this->part_idioma__before_qstr = $this->part_idioma_;
          $this->part_idioma_ = substr($this->Db->qstr($this->part_idioma_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_idioma_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_idioma_);
          }
          if ($this->part_idioma_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_idioma_ = "null"; 
              $this->NM_val_null[] = "part_idioma_";
          } 
          $this->part_filiacao__before_qstr = $this->part_filiacao_;
          $this->part_filiacao_ = substr($this->Db->qstr($this->part_filiacao_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_filiacao_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_filiacao_);
          }
          if ($this->part_filiacao_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_filiacao_ = "null"; 
              $this->NM_val_null[] = "part_filiacao_";
          } 
          $this->part_pais__before_qstr = $this->part_pais_;
          $this->part_pais_ = substr($this->Db->qstr($this->part_pais_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_pais_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_pais_);
          }
          if ($this->part_pais_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_pais_ = "null"; 
              $this->NM_val_null[] = "part_pais_";
          } 
          $this->part_nome_secretaria__before_qstr = $this->part_nome_secretaria_;
          $this->part_nome_secretaria_ = substr($this->Db->qstr($this->part_nome_secretaria_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_nome_secretaria_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_nome_secretaria_);
          }
          if ($this->part_nome_secretaria_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_nome_secretaria_ = "null"; 
              $this->NM_val_null[] = "part_nome_secretaria_";
          } 
          $this->part_email_secretaria__before_qstr = $this->part_email_secretaria_;
          $this->part_email_secretaria_ = substr($this->Db->qstr($this->part_email_secretaria_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_email_secretaria_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_email_secretaria_);
          }
          if ($this->part_email_secretaria_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_email_secretaria_ = "null"; 
              $this->NM_val_null[] = "part_email_secretaria_";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_dt_cadastro_ == "")  
              { 
                  $this->part_dt_cadastro_ = "null"; 
                  $this->NM_val_null[] = "part_dt_cadastro_";
              } 
              if ($this->part_dt_cadastro_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_dt_cadastro_ = "null"; 
                  $this->NM_val_null[] = "part_dt_cadastro_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_dt_alteracao_ == "")  
              { 
                  $this->part_dt_alteracao_ = "null"; 
                  $this->NM_val_null[] = "part_dt_alteracao_";
              } 
              if ($this->part_dt_alteracao_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_dt_alteracao_ = "null"; 
                  $this->NM_val_null[] = "part_dt_alteracao_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_contato_rsvp_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_contato_rsvp_ = "null"; 
                  $this->NM_val_null[] = "part_contato_rsvp_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_dt_alt_contato_rsvp_ == "")  
              { 
                  $this->part_dt_alt_contato_rsvp_ = "null"; 
                  $this->NM_val_null[] = "part_dt_alt_contato_rsvp_";
              } 
              if ($this->part_dt_alt_contato_rsvp_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_dt_alt_contato_rsvp_ = "null"; 
                  $this->NM_val_null[] = "part_dt_alt_contato_rsvp_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_presenca_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_presenca_ = "null"; 
                  $this->NM_val_null[] = "part_presenca_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_dt_alt_presenca_ == "")  
              { 
                  $this->part_dt_alt_presenca_ = "null"; 
                  $this->NM_val_null[] = "part_dt_alt_presenca_";
              } 
              if ($this->part_dt_alt_presenca_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_dt_alt_presenca_ = "null"; 
                  $this->NM_val_null[] = "part_dt_alt_presenca_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_solicit_especial_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_solicit_especial_ = "null"; 
                  $this->NM_val_null[] = "part_solicit_especial_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_dt_solicit_especial_ == "")  
              { 
                  $this->part_dt_solicit_especial_ = "null"; 
                  $this->NM_val_null[] = "part_dt_solicit_especial_";
              } 
              if ($this->part_dt_solicit_especial_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_dt_solicit_especial_ = "null"; 
                  $this->NM_val_null[] = "part_dt_solicit_especial_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_programacao_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_programacao_ = "null"; 
                  $this->NM_val_null[] = "part_programacao_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_dt_programacao_ == "")  
              { 
                  $this->part_dt_programacao_ = "null"; 
                  $this->NM_val_null[] = "part_dt_programacao_";
              } 
              if ($this->part_dt_programacao_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_dt_programacao_ = "null"; 
                  $this->NM_val_null[] = "part_dt_programacao_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_aereo_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_aereo_ = "null"; 
                  $this->NM_val_null[] = "part_aereo_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_dt_aereo_ == "")  
              { 
                  $this->part_dt_aereo_ = "null"; 
                  $this->NM_val_null[] = "part_dt_aereo_";
              } 
              if ($this->part_dt_aereo_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_dt_aereo_ = "null"; 
                  $this->NM_val_null[] = "part_dt_aereo_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_hospedagem_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_hospedagem_ = "null"; 
                  $this->NM_val_null[] = "part_hospedagem_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->par_dt_hospedagem_ == "")  
              { 
                  $this->par_dt_hospedagem_ = "null"; 
                  $this->NM_val_null[] = "par_dt_hospedagem_";
              } 
              if ($this->par_dt_hospedagem_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->par_dt_hospedagem_ = "null"; 
                  $this->NM_val_null[] = "par_dt_hospedagem_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_dt_transfer_ == "")  
              { 
                  $this->part_dt_transfer_ = "null"; 
                  $this->NM_val_null[] = "part_dt_transfer_";
              } 
              if ($this->part_dt_transfer_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_dt_transfer_ = "null"; 
                  $this->NM_val_null[] = "part_dt_transfer_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_opcionais_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_opcionais_ = "null"; 
                  $this->NM_val_null[] = "part_opcionais_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_dt_opcionais_ == "")  
              { 
                  $this->part_dt_opcionais_ = "null"; 
                  $this->NM_val_null[] = "part_dt_opcionais_";
              } 
              if ($this->part_dt_opcionais_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_dt_opcionais_ = "null"; 
                  $this->NM_val_null[] = "part_dt_opcionais_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_notas_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_notas_ = "null"; 
                  $this->NM_val_null[] = "part_notas_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_confirm_viagem_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_confirm_viagem_ = "null"; 
                  $this->NM_val_null[] = "part_confirm_viagem_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_convite_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_convite_ = "null"; 
                  $this->NM_val_null[] = "part_convite_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_concluido_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_concluido_ = "null"; 
                  $this->NM_val_null[] = "part_concluido_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_transfer_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_transfer_ = "null"; 
                  $this->NM_val_null[] = "part_transfer_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_convite_enviado_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_convite_enviado_ = "null"; 
                  $this->NM_val_null[] = "part_convite_enviado_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_destaque_negrito_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_destaque_negrito_ = "null"; 
                  $this->NM_val_null[] = "part_destaque_negrito_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_atendimento_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_atendimento_ = "null"; 
                  $this->NM_val_null[] = "part_atendimento_";
              } 
          }
          if ($this->part_save_the_date_ == "")  
          { 
              $this->part_save_the_date_ = "null"; 
              $this->NM_val_null[] = "part_save_the_date_";
          } 
          $this->part_arq_save__before_qstr = $this->part_arq_save_;
          $this->part_arq_save_ = substr($this->Db->qstr($this->part_arq_save_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_arq_save_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_arq_save_);
          }
          if ($this->part_arq_save_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_arq_save_ = "null"; 
              $this->NM_val_null[] = "part_arq_save_";
          } 
          $this->part_arq_convite__before_qstr = $this->part_arq_convite_;
          $this->part_arq_convite_ = substr($this->Db->qstr($this->part_arq_convite_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_arq_convite_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_arq_convite_);
          }
          if ($this->part_arq_convite_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_arq_convite_ = "null"; 
              $this->NM_val_null[] = "part_arq_convite_";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_fumante_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_fumante_ = "null"; 
                  $this->NM_val_null[] = "part_fumante_";
              } 
          }
          $this->part_restricao_alimentar__before_qstr = $this->part_restricao_alimentar_;
          $this->part_restricao_alimentar_ = substr($this->Db->qstr($this->part_restricao_alimentar_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_restricao_alimentar_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_restricao_alimentar_);
          }
          if ($this->part_restricao_alimentar_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_restricao_alimentar_ = "null"; 
              $this->NM_val_null[] = "part_restricao_alimentar_";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_acompanhado_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_acompanhado_ = "null"; 
                  $this->NM_val_null[] = "part_acompanhado_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_acompanhado_hotel_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_acompanhado_hotel_ = "null"; 
                  $this->NM_val_null[] = "part_acompanhado_hotel_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_acom_completo_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_acom_completo_ = "null"; 
                  $this->NM_val_null[] = "part_acom_completo_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_acom_incompleto_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_acom_incompleto_ = "null"; 
                  $this->NM_val_null[] = "part_acom_incompleto_";
              } 
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_incompleto_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_incompleto_ = "null"; 
                  $this->NM_val_null[] = "part_incompleto_";
              } 
          }
          $this->part_aereo_ok__before_qstr = $this->part_aereo_ok_;
          $this->part_aereo_ok_ = substr($this->Db->qstr($this->part_aereo_ok_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_aereo_ok_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_aereo_ok_);
          }
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_aereo_ok_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_aereo_ok_ = "null"; 
                  $this->NM_val_null[] = "part_aereo_ok_";
              } 
          }
          $this->part_hotel__before_qstr = $this->part_hotel_;
          $this->part_hotel_ = substr($this->Db->qstr($this->part_hotel_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_hotel_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_hotel_);
          }
          if ($this->part_hotel_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_hotel_ = "null"; 
              $this->NM_val_null[] = "part_hotel_";
          } 
          if ($this->nmgp_opcao == "alterar") 
          {
              if ($this->part_anotacoes_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
              { 
                  $this->part_anotacoes_ = "null"; 
                  $this->NM_val_null[] = "part_anotacoes_";
              } 
          }
          $this->guarda_cod_substituto__before_qstr = $this->guarda_cod_substituto_;
          $this->guarda_cod_substituto_ = substr($this->Db->qstr($this->guarda_cod_substituto_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->guarda_cod_substituto_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->guarda_cod_substituto_);
          }
          if ($this->guarda_cod_substituto_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->guarda_cod_substituto_ = "null"; 
              $this->NM_val_null[] = "guarda_cod_substituto_";
          } 
          $this->part_cpf_informado__before_qstr = $this->part_cpf_informado_;
          $this->part_cpf_informado_ = substr($this->Db->qstr($this->part_cpf_informado_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_cpf_informado_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_cpf_informado_);
          }
          if ($this->part_cpf_informado_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_cpf_informado_ = "null"; 
              $this->NM_val_null[] = "part_cpf_informado_";
          } 
          $this->part_cv_obs__before_qstr = $this->part_cv_obs_;
          $this->part_cv_obs_ = substr($this->Db->qstr($this->part_cv_obs_), 1, -1); 
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $this->part_cv_obs_ = str_replace(array("\\r\\n", "\\n", "\r\n"), array("\r\n", "\n", "\n"), $this->part_cv_obs_);
          }
          if ($this->part_cv_obs_ == "" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))  
          { 
              $this->part_cv_obs_ = "null"; 
              $this->NM_val_null[] = "part_cv_obs_";
          } 
      }
      if ($this->nmgp_opcao == "alterar") 
      {
          $SC_fields_update = array(); 
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['foreign_key'] as $sFKName => $sFKValue)
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
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_ ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_ "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_ ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_ "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_ ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_ "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_ ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_ "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_ ";
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_ "); 
          }  
          if ($rs1 === false)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dbas'], $this->Db->ErrorMsg()); 
              if ($this->NM_ajax_flag)
              {
                 form_participantes_rsvp_ar_pack_ajax_response();
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
                  $SC_fields_update[] = "part_sexo = '$this->part_sexo_', part_id_evento_publico = $this->part_id_evento_publico_, part_id_evento_regional = $this->part_id_evento_regional_, part_grupo = '$this->part_grupo_', part_clube = '$this->part_clube_', part_empresa = '$this->part_empresa_', part_uf = '$this->part_uf_', part_ddd_celular_01 = '$this->part_ddd_celular_01_', part_celeular_01 = '$this->part_celeular_01_', part_dt_nasc = #$this->part_dt_nasc_#, part_tam_camisa = '$this->part_tam_camisa_', part_tam_calcado = '$this->part_tam_calcado_'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "part_sexo = '$this->part_sexo_', part_id_evento_publico = $this->part_id_evento_publico_, part_id_evento_regional = $this->part_id_evento_regional_, part_grupo = '$this->part_grupo_', part_clube = '$this->part_clube_', part_empresa = '$this->part_empresa_', part_uf = '$this->part_uf_', part_ddd_celular_01 = '$this->part_ddd_celular_01_', part_celeular_01 = '$this->part_celeular_01_', part_dt_nasc = " . $this->Ini->date_delim . $this->part_dt_nasc_ . $this->Ini->date_delim1 . ", part_tam_camisa = '$this->part_tam_camisa_', part_tam_calcado = '$this->part_tam_calcado_'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "part_sexo = '$this->part_sexo_', part_id_evento_publico = $this->part_id_evento_publico_, part_id_evento_regional = $this->part_id_evento_regional_, part_grupo = '$this->part_grupo_', part_clube = '$this->part_clube_', part_empresa = '$this->part_empresa_', part_uf = '$this->part_uf_', part_ddd_celular_01 = '$this->part_ddd_celular_01_', part_celeular_01 = '$this->part_celeular_01_', part_dt_nasc = " . $this->Ini->date_delim . $this->part_dt_nasc_ . $this->Ini->date_delim1 . ", part_tam_camisa = '$this->part_tam_camisa_', part_tam_calcado = '$this->part_tam_calcado_'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "part_sexo = '$this->part_sexo_', part_id_evento_publico = $this->part_id_evento_publico_, part_id_evento_regional = $this->part_id_evento_regional_, part_grupo = '$this->part_grupo_', part_clube = '$this->part_clube_', part_empresa = '$this->part_empresa_', part_uf = '$this->part_uf_', part_ddd_celular_01 = '$this->part_ddd_celular_01_', part_celeular_01 = '$this->part_celeular_01_', part_dt_nasc = EXTEND('$this->part_dt_nasc_', YEAR TO DAY), part_tam_camisa = '$this->part_tam_camisa_', part_tam_calcado = '$this->part_tam_calcado_'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "part_sexo = '$this->part_sexo_', part_id_evento_publico = $this->part_id_evento_publico_, part_id_evento_regional = $this->part_id_evento_regional_, part_grupo = '$this->part_grupo_', part_clube = '$this->part_clube_', part_empresa = '$this->part_empresa_', part_uf = '$this->part_uf_', part_ddd_celular_01 = '$this->part_ddd_celular_01_', part_celeular_01 = '$this->part_celeular_01_', part_dt_nasc = " . $this->Ini->date_delim . $this->part_dt_nasc_ . $this->Ini->date_delim1 . ", part_tam_camisa = '$this->part_tam_camisa_', part_tam_calcado = '$this->part_tam_calcado_'"; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "part_sexo = '$this->part_sexo_', part_id_evento_publico = $this->part_id_evento_publico_, part_id_evento_regional = $this->part_id_evento_regional_, part_grupo = '$this->part_grupo_', part_clube = '$this->part_clube_', part_empresa = '$this->part_empresa_', part_uf = '$this->part_uf_', part_ddd_celular_01 = '$this->part_ddd_celular_01_', part_celeular_01 = '$this->part_celeular_01_', part_dt_nasc = " . $this->Ini->date_delim . $this->part_dt_nasc_ . $this->Ini->date_delim1 . ", part_tam_camisa = '$this->part_tam_camisa_', part_tam_calcado = '$this->part_tam_calcado_'"; 
              } 
              else 
              { 
                  $comando = "UPDATE " . $this->Ini->nm_tabela . " SET ";  
                  $SC_fields_update[] = "part_sexo = '$this->part_sexo_', part_id_evento_publico = $this->part_id_evento_publico_, part_id_evento_regional = $this->part_id_evento_regional_, part_grupo = '$this->part_grupo_', part_clube = '$this->part_clube_', part_empresa = '$this->part_empresa_', part_uf = '$this->part_uf_', part_ddd_celular_01 = '$this->part_ddd_celular_01_', part_celeular_01 = '$this->part_celeular_01_', part_dt_nasc = " . $this->Ini->date_delim . $this->part_dt_nasc_ . $this->Ini->date_delim1 . ", part_tam_camisa = '$this->part_tam_camisa_', part_tam_calcado = '$this->part_tam_calcado_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_ativo_']) && $NM_val_form['part_ativo_'] == "null"  && $this->nmgp_dados_select['part_ativo_'] == "") ? "null" : $this->nmgp_dados_select['part_ativo_'];
              if (isset($NM_val_form['part_ativo_']) && $NM_val_form['part_ativo_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_ativo = '$this->part_ativo_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_cpf_']) && $NM_val_form['part_cpf_'] == "null"  && $this->nmgp_dados_select['part_cpf_'] == "") ? "null" : $this->nmgp_dados_select['part_cpf_'];
              if (isset($NM_val_form['part_cpf_']) && $NM_val_form['part_cpf_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_cpf = '$this->part_cpf_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['nome_pessoa_']) && $NM_val_form['nome_pessoa_'] == "null"  && $this->nmgp_dados_select['nome_pessoa_'] == "") ? "null" : $this->nmgp_dados_select['nome_pessoa_'];
              if (isset($NM_val_form['nome_pessoa_']) && $NM_val_form['nome_pessoa_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "nome_pessoa = '$this->nome_pessoa_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_cpf_substituto_']) && $NM_val_form['part_cpf_substituto_'] == "null"  && $this->nmgp_dados_select['part_cpf_substituto_'] == "") ? "null" : $this->nmgp_dados_select['part_cpf_substituto_'];
              if (isset($NM_val_form['part_cpf_substituto_']) && $NM_val_form['part_cpf_substituto_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_cpf_substituto = '$this->part_cpf_substituto_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_crnm_']) && $NM_val_form['part_crnm_'] == "null"  && $this->nmgp_dados_select['part_crnm_'] == "") ? "null" : $this->nmgp_dados_select['part_crnm_'];
              if (isset($NM_val_form['part_crnm_']) && $NM_val_form['part_crnm_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_crnm = '$this->part_crnm_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_tipo_']) && $NM_val_form['part_tipo_'] == "null"  && $this->nmgp_dados_select['part_tipo_'] == "") ? "null" : $this->nmgp_dados_select['part_tipo_'];
              if (isset($NM_val_form['part_tipo_']) && $NM_val_form['part_tipo_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_tipo = '$this->part_tipo_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_nome_cracha_']) && $NM_val_form['part_nome_cracha_'] == "null"  && $this->nmgp_dados_select['part_nome_cracha_'] == "") ? "null" : $this->nmgp_dados_select['part_nome_cracha_'];
              if (isset($NM_val_form['part_nome_cracha_']) && $NM_val_form['part_nome_cracha_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_nome_cracha = '$this->part_nome_cracha_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_id_evento_']) && $NM_val_form['part_id_evento_'] == "null"  && $this->nmgp_dados_select['part_id_evento_'] == "") ? "null" : $this->nmgp_dados_select['part_id_evento_'];
              if (isset($NM_val_form['part_id_evento_']) && $NM_val_form['part_id_evento_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_id_evento = $this->part_id_evento_"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_tipo_pessoa_']) && $NM_val_form['part_tipo_pessoa_'] == "null"  && $this->nmgp_dados_select['part_tipo_pessoa_'] == "") ? "null" : $this->nmgp_dados_select['part_tipo_pessoa_'];
              if (isset($NM_val_form['part_tipo_pessoa_']) && $NM_val_form['part_tipo_pessoa_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_tipo_pessoa = '$this->part_tipo_pessoa_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_substituido_']) && $NM_val_form['part_substituido_'] == "null"  && $this->nmgp_dados_select['part_substituido_'] == "") ? "null" : $this->nmgp_dados_select['part_substituido_'];
              if (isset($NM_val_form['part_substituido_']) && $NM_val_form['part_substituido_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_substituido = '$this->part_substituido_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_substituto_']) && $NM_val_form['part_substituto_'] == "null"  && $this->nmgp_dados_select['part_substituto_'] == "") ? "null" : $this->nmgp_dados_select['part_substituto_'];
              if (isset($NM_val_form['part_substituto_']) && $NM_val_form['part_substituto_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_substituto = '$this->part_substituto_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_cod_substituto_']) && $NM_val_form['part_cod_substituto_'] == "null"  && $this->nmgp_dados_select['part_cod_substituto_'] == "") ? "null" : $this->nmgp_dados_select['part_cod_substituto_'];
              if (isset($NM_val_form['part_cod_substituto_']) && $NM_val_form['part_cod_substituto_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_cod_substituto = '$this->part_cod_substituto_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_nome_substituto_']) && $NM_val_form['part_nome_substituto_'] == "null"  && $this->nmgp_dados_select['part_nome_substituto_'] == "") ? "null" : $this->nmgp_dados_select['part_nome_substituto_'];
              if (isset($NM_val_form['part_nome_substituto_']) && $NM_val_form['part_nome_substituto_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_nome_substituto = '$this->part_nome_substituto_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_sexo_substituto_']) && $NM_val_form['part_sexo_substituto_'] == "null"  && $this->nmgp_dados_select['part_sexo_substituto_'] == "") ? "null" : $this->nmgp_dados_select['part_sexo_substituto_'];
              if (isset($NM_val_form['part_sexo_substituto_']) && $NM_val_form['part_sexo_substituto_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_sexo_substituto = '$this->part_sexo_substituto_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_cod_substituido_']) && $NM_val_form['part_cod_substituido_'] == "null"  && $this->nmgp_dados_select['part_cod_substituido_'] == "") ? "null" : $this->nmgp_dados_select['part_cod_substituido_'];
              if (isset($NM_val_form['part_cod_substituido_']) && $NM_val_form['part_cod_substituido_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_cod_substituido = '$this->part_cod_substituido_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_nome_substituido_']) && $NM_val_form['part_nome_substituido_'] == "null"  && $this->nmgp_dados_select['part_nome_substituido_'] == "") ? "null" : $this->nmgp_dados_select['part_nome_substituido_'];
              if (isset($NM_val_form['part_nome_substituido_']) && $NM_val_form['part_nome_substituido_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_nome_substituido = '$this->part_nome_substituido_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_cep_']) && $NM_val_form['part_cep_'] == "null"  && $this->nmgp_dados_select['part_cep_'] == "") ? "null" : $this->nmgp_dados_select['part_cep_'];
              if (isset($NM_val_form['part_cep_']) && $NM_val_form['part_cep_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_cep = '$this->part_cep_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_departamento_']) && $NM_val_form['part_departamento_'] == "null"  && $this->nmgp_dados_select['part_departamento_'] == "") ? "null" : $this->nmgp_dados_select['part_departamento_'];
              if (isset($NM_val_form['part_departamento_']) && $NM_val_form['part_departamento_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_departamento = '$this->part_departamento_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_cargo_']) && $NM_val_form['part_cargo_'] == "null"  && $this->nmgp_dados_select['part_cargo_'] == "") ? "null" : $this->nmgp_dados_select['part_cargo_'];
              if (isset($NM_val_form['part_cargo_']) && $NM_val_form['part_cargo_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_cargo = '$this->part_cargo_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_logradouro_']) && $NM_val_form['part_logradouro_'] == "null"  && $this->nmgp_dados_select['part_logradouro_'] == "") ? "null" : $this->nmgp_dados_select['part_logradouro_'];
              if (isset($NM_val_form['part_logradouro_']) && $NM_val_form['part_logradouro_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_logradouro = '$this->part_logradouro_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_numero_']) && $NM_val_form['part_numero_'] == "null"  && $this->nmgp_dados_select['part_numero_'] == "") ? "null" : $this->nmgp_dados_select['part_numero_'];
              if (isset($NM_val_form['part_numero_']) && $NM_val_form['part_numero_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_numero = '$this->part_numero_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_complemento_']) && $NM_val_form['part_complemento_'] == "null"  && $this->nmgp_dados_select['part_complemento_'] == "") ? "null" : $this->nmgp_dados_select['part_complemento_'];
              if (isset($NM_val_form['part_complemento_']) && $NM_val_form['part_complemento_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_complemento = '$this->part_complemento_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_bairro_']) && $NM_val_form['part_bairro_'] == "null"  && $this->nmgp_dados_select['part_bairro_'] == "") ? "null" : $this->nmgp_dados_select['part_bairro_'];
              if (isset($NM_val_form['part_bairro_']) && $NM_val_form['part_bairro_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_bairro = '$this->part_bairro_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_cidade_']) && $NM_val_form['part_cidade_'] == "null"  && $this->nmgp_dados_select['part_cidade_'] == "") ? "null" : $this->nmgp_dados_select['part_cidade_'];
              if (isset($NM_val_form['part_cidade_']) && $NM_val_form['part_cidade_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_cidade = '$this->part_cidade_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_ddd_01_']) && $NM_val_form['part_ddd_01_'] == "null"  && $this->nmgp_dados_select['part_ddd_01_'] == "") ? "null" : $this->nmgp_dados_select['part_ddd_01_'];
              if (isset($NM_val_form['part_ddd_01_']) && $NM_val_form['part_ddd_01_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_ddd_01 = '$this->part_ddd_01_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_fone_01_']) && $NM_val_form['part_fone_01_'] == "null"  && $this->nmgp_dados_select['part_fone_01_'] == "") ? "null" : $this->nmgp_dados_select['part_fone_01_'];
              if (isset($NM_val_form['part_fone_01_']) && $NM_val_form['part_fone_01_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_fone_01 = '$this->part_fone_01_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_ddd_02_']) && $NM_val_form['part_ddd_02_'] == "null"  && $this->nmgp_dados_select['part_ddd_02_'] == "") ? "null" : $this->nmgp_dados_select['part_ddd_02_'];
              if (isset($NM_val_form['part_ddd_02_']) && $NM_val_form['part_ddd_02_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_ddd_02 = '$this->part_ddd_02_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_fone_02_']) && $NM_val_form['part_fone_02_'] == "null"  && $this->nmgp_dados_select['part_fone_02_'] == "") ? "null" : $this->nmgp_dados_select['part_fone_02_'];
              if (isset($NM_val_form['part_fone_02_']) && $NM_val_form['part_fone_02_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_fone_02 = '$this->part_fone_02_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_ddd_03_']) && $NM_val_form['part_ddd_03_'] == "null"  && $this->nmgp_dados_select['part_ddd_03_'] == "") ? "null" : $this->nmgp_dados_select['part_ddd_03_'];
              if (isset($NM_val_form['part_ddd_03_']) && $NM_val_form['part_ddd_03_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_ddd_03 = '$this->part_ddd_03_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_fone_03_']) && $NM_val_form['part_fone_03_'] == "null"  && $this->nmgp_dados_select['part_fone_03_'] == "") ? "null" : $this->nmgp_dados_select['part_fone_03_'];
              if (isset($NM_val_form['part_fone_03_']) && $NM_val_form['part_fone_03_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_fone_03 = '$this->part_fone_03_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_ddd_fax_']) && $NM_val_form['part_ddd_fax_'] == "null"  && $this->nmgp_dados_select['part_ddd_fax_'] == "") ? "null" : $this->nmgp_dados_select['part_ddd_fax_'];
              if (isset($NM_val_form['part_ddd_fax_']) && $NM_val_form['part_ddd_fax_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_ddd_fax = '$this->part_ddd_fax_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_fax_']) && $NM_val_form['part_fax_'] == "null"  && $this->nmgp_dados_select['part_fax_'] == "") ? "null" : $this->nmgp_dados_select['part_fax_'];
              if (isset($NM_val_form['part_fax_']) && $NM_val_form['part_fax_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_fax = '$this->part_fax_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_ddd_celular_02_']) && $NM_val_form['part_ddd_celular_02_'] == "null"  && $this->nmgp_dados_select['part_ddd_celular_02_'] == "") ? "null" : $this->nmgp_dados_select['part_ddd_celular_02_'];
              if (isset($NM_val_form['part_ddd_celular_02_']) && $NM_val_form['part_ddd_celular_02_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_ddd_celular_02 = '$this->part_ddd_celular_02_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_celular_02_']) && $NM_val_form['part_celular_02_'] == "null"  && $this->nmgp_dados_select['part_celular_02_'] == "") ? "null" : $this->nmgp_dados_select['part_celular_02_'];
              if (isset($NM_val_form['part_celular_02_']) && $NM_val_form['part_celular_02_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_celular_02 = '$this->part_celular_02_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_fone_internacional_']) && $NM_val_form['part_fone_internacional_'] == "null"  && $this->nmgp_dados_select['part_fone_internacional_'] == "") ? "null" : $this->nmgp_dados_select['part_fone_internacional_'];
              if (isset($NM_val_form['part_fone_internacional_']) && $NM_val_form['part_fone_internacional_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_fone_internacional = '$this->part_fone_internacional_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_email_']) && $NM_val_form['part_email_'] == "null"  && $this->nmgp_dados_select['part_email_'] == "") ? "null" : $this->nmgp_dados_select['part_email_'];
              if (isset($NM_val_form['part_email_']) && $NM_val_form['part_email_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_email = '$this->part_email_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_rg_']) && $NM_val_form['part_rg_'] == "null"  && $this->nmgp_dados_select['part_rg_'] == "") ? "null" : $this->nmgp_dados_select['part_rg_'];
              if (isset($NM_val_form['part_rg_']) && $NM_val_form['part_rg_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_rg = '$this->part_rg_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_passaporte_']) && $NM_val_form['part_passaporte_'] == "null"  && $this->nmgp_dados_select['part_passaporte_'] == "") ? "null" : $this->nmgp_dados_select['part_passaporte_'];
              if (isset($NM_val_form['part_passaporte_']) && $NM_val_form['part_passaporte_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_passaporte = '$this->part_passaporte_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_validade_pass_']) && $NM_val_form['part_validade_pass_'] == "null"  && $this->nmgp_dados_select['part_validade_pass_'] == "") ? "null" : $this->nmgp_dados_select['part_validade_pass_'];
              if (isset($NM_val_form['part_validade_pass_']) && $NM_val_form['part_validade_pass_'] != $Prep_Tst) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "part_validade_pass = #$this->part_validade_pass_#"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  { 
                      $SC_fields_update[] = "part_validade_pass = EXTEND('" . $this->part_validade_pass_ . "', YEAR TO DAY)"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "part_validade_pass = " . $this->Ini->date_delim . $this->part_validade_pass_ . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['part_passaporte_estrangeiro_']) && $NM_val_form['part_passaporte_estrangeiro_'] == "null"  && $this->nmgp_dados_select['part_passaporte_estrangeiro_'] == "") ? "null" : $this->nmgp_dados_select['part_passaporte_estrangeiro_'];
              if (isset($NM_val_form['part_passaporte_estrangeiro_']) && $NM_val_form['part_passaporte_estrangeiro_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_passaporte_estrangeiro = '$this->part_passaporte_estrangeiro_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_ind_voucher_']) && $NM_val_form['part_ind_voucher_'] == "null"  && $this->nmgp_dados_select['part_ind_voucher_'] == "") ? "null" : $this->nmgp_dados_select['part_ind_voucher_'];
              if (isset($NM_val_form['part_ind_voucher_']) && $NM_val_form['part_ind_voucher_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_ind_voucher = '$this->part_ind_voucher_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_num_voucher_']) && $NM_val_form['part_num_voucher_'] == "null"  && $this->nmgp_dados_select['part_num_voucher_'] == "") ? "null" : $this->nmgp_dados_select['part_num_voucher_'];
              if (isset($NM_val_form['part_num_voucher_']) && $NM_val_form['part_num_voucher_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_num_voucher = '$this->part_num_voucher_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_idioma_']) && $NM_val_form['part_idioma_'] == "null"  && $this->nmgp_dados_select['part_idioma_'] == "") ? "null" : $this->nmgp_dados_select['part_idioma_'];
              if (isset($NM_val_form['part_idioma_']) && $NM_val_form['part_idioma_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_idioma = '$this->part_idioma_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_filiacao_']) && $NM_val_form['part_filiacao_'] == "null"  && $this->nmgp_dados_select['part_filiacao_'] == "") ? "null" : $this->nmgp_dados_select['part_filiacao_'];
              if (isset($NM_val_form['part_filiacao_']) && $NM_val_form['part_filiacao_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_filiacao = '$this->part_filiacao_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_pais_']) && $NM_val_form['part_pais_'] == "null"  && $this->nmgp_dados_select['part_pais_'] == "") ? "null" : $this->nmgp_dados_select['part_pais_'];
              if (isset($NM_val_form['part_pais_']) && $NM_val_form['part_pais_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_pais = '$this->part_pais_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_nome_secretaria_']) && $NM_val_form['part_nome_secretaria_'] == "null"  && $this->nmgp_dados_select['part_nome_secretaria_'] == "") ? "null" : $this->nmgp_dados_select['part_nome_secretaria_'];
              if (isset($NM_val_form['part_nome_secretaria_']) && $NM_val_form['part_nome_secretaria_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_nome_secretaria = '$this->part_nome_secretaria_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_email_secretaria_']) && $NM_val_form['part_email_secretaria_'] == "null"  && $this->nmgp_dados_select['part_email_secretaria_'] == "") ? "null" : $this->nmgp_dados_select['part_email_secretaria_'];
              if (isset($NM_val_form['part_email_secretaria_']) && $NM_val_form['part_email_secretaria_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_email_secretaria = '$this->part_email_secretaria_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_cod_usuario_']) && $NM_val_form['part_cod_usuario_'] == "null"  && $this->nmgp_dados_select['part_cod_usuario_'] == "") ? "null" : $this->nmgp_dados_select['part_cod_usuario_'];
              if (isset($NM_val_form['part_cod_usuario_']) && $NM_val_form['part_cod_usuario_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_cod_usuario = $this->part_cod_usuario_"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_dt_cadastro_']) && $NM_val_form['part_dt_cadastro_'] == "null"  && $this->nmgp_dados_select['part_dt_cadastro_'] == "") ? "null" : $this->nmgp_dados_select['part_dt_cadastro_'];
              if (isset($NM_val_form['part_dt_cadastro_']) && $NM_val_form['part_dt_cadastro_'] != $Prep_Tst) 
              { 
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                  { 
                      $SC_fields_update[] = "part_dt_cadastro = TO_DATE('$this->part_dt_cadastro_', 'yyyy-mm-dd hh24:mi:ss')"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "part_dt_cadastro = '$this->part_dt_cadastro_'"; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['part_dt_alteracao_']) && $NM_val_form['part_dt_alteracao_'] == "null"  && $this->nmgp_dados_select['part_dt_alteracao_'] == "") ? "null" : $this->nmgp_dados_select['part_dt_alteracao_'];
              if (isset($NM_val_form['part_dt_alteracao_']) && $NM_val_form['part_dt_alteracao_'] != $Prep_Tst) 
              { 
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                  { 
                      $SC_fields_update[] = "part_dt_alteracao = TO_DATE('$this->part_dt_alteracao_', 'yyyy-mm-dd hh24:mi:ss')"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "part_dt_alteracao = '$this->part_dt_alteracao_'"; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['part_contato_rsvp_']) && $NM_val_form['part_contato_rsvp_'] == "null"  && $this->nmgp_dados_select['part_contato_rsvp_'] == "") ? "null" : $this->nmgp_dados_select['part_contato_rsvp_'];
              if (isset($NM_val_form['part_contato_rsvp_']) && $NM_val_form['part_contato_rsvp_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_contato_rsvp = '$this->part_contato_rsvp_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_dt_alt_contato_rsvp_']) && $NM_val_form['part_dt_alt_contato_rsvp_'] == "null"  && $this->nmgp_dados_select['part_dt_alt_contato_rsvp_'] == "") ? "null" : $this->nmgp_dados_select['part_dt_alt_contato_rsvp_'];
              if (isset($NM_val_form['part_dt_alt_contato_rsvp_']) && $NM_val_form['part_dt_alt_contato_rsvp_'] != $Prep_Tst) 
              { 
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                  { 
                      $SC_fields_update[] = "part_dt_alt_contato_rsvp = TO_DATE('$this->part_dt_alt_contato_rsvp_', 'yyyy-mm-dd hh24:mi:ss')"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "part_dt_alt_contato_rsvp = '$this->part_dt_alt_contato_rsvp_'"; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['part_presenca_']) && $NM_val_form['part_presenca_'] == "null"  && $this->nmgp_dados_select['part_presenca_'] == "") ? "null" : $this->nmgp_dados_select['part_presenca_'];
              if (isset($NM_val_form['part_presenca_']) && $NM_val_form['part_presenca_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_presenca = '$this->part_presenca_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_dt_alt_presenca_']) && $NM_val_form['part_dt_alt_presenca_'] == "null"  && $this->nmgp_dados_select['part_dt_alt_presenca_'] == "") ? "null" : $this->nmgp_dados_select['part_dt_alt_presenca_'];
              if (isset($NM_val_form['part_dt_alt_presenca_']) && $NM_val_form['part_dt_alt_presenca_'] != $Prep_Tst) 
              { 
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                  { 
                      $SC_fields_update[] = "part_dt_alt_presenca = TO_DATE('$this->part_dt_alt_presenca_', 'yyyy-mm-dd hh24:mi:ss')"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "part_dt_alt_presenca = '$this->part_dt_alt_presenca_'"; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['part_solicit_especial_']) && $NM_val_form['part_solicit_especial_'] == "null"  && $this->nmgp_dados_select['part_solicit_especial_'] == "") ? "null" : $this->nmgp_dados_select['part_solicit_especial_'];
              if (isset($NM_val_form['part_solicit_especial_']) && $NM_val_form['part_solicit_especial_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_solicit_especial = '$this->part_solicit_especial_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_dt_solicit_especial_']) && $NM_val_form['part_dt_solicit_especial_'] == "null"  && $this->nmgp_dados_select['part_dt_solicit_especial_'] == "") ? "null" : $this->nmgp_dados_select['part_dt_solicit_especial_'];
              if (isset($NM_val_form['part_dt_solicit_especial_']) && $NM_val_form['part_dt_solicit_especial_'] != $Prep_Tst) 
              { 
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                  { 
                      $SC_fields_update[] = "part_dt_solicit_especial = TO_DATE('$this->part_dt_solicit_especial_', 'yyyy-mm-dd hh24:mi:ss')"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "part_dt_solicit_especial = '$this->part_dt_solicit_especial_'"; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['part_programacao_']) && $NM_val_form['part_programacao_'] == "null"  && $this->nmgp_dados_select['part_programacao_'] == "") ? "null" : $this->nmgp_dados_select['part_programacao_'];
              if (isset($NM_val_form['part_programacao_']) && $NM_val_form['part_programacao_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_programacao = '$this->part_programacao_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_dt_programacao_']) && $NM_val_form['part_dt_programacao_'] == "null"  && $this->nmgp_dados_select['part_dt_programacao_'] == "") ? "null" : $this->nmgp_dados_select['part_dt_programacao_'];
              if (isset($NM_val_form['part_dt_programacao_']) && $NM_val_form['part_dt_programacao_'] != $Prep_Tst) 
              { 
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                  { 
                      $SC_fields_update[] = "part_dt_programacao = TO_DATE('$this->part_dt_programacao_', 'yyyy-mm-dd hh24:mi:ss')"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "part_dt_programacao = '$this->part_dt_programacao_'"; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['part_aereo_']) && $NM_val_form['part_aereo_'] == "null"  && $this->nmgp_dados_select['part_aereo_'] == "") ? "null" : $this->nmgp_dados_select['part_aereo_'];
              if (isset($NM_val_form['part_aereo_']) && $NM_val_form['part_aereo_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_aereo = '$this->part_aereo_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_dt_aereo_']) && $NM_val_form['part_dt_aereo_'] == "null"  && $this->nmgp_dados_select['part_dt_aereo_'] == "") ? "null" : $this->nmgp_dados_select['part_dt_aereo_'];
              if (isset($NM_val_form['part_dt_aereo_']) && $NM_val_form['part_dt_aereo_'] != $Prep_Tst) 
              { 
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                  { 
                      $SC_fields_update[] = "part_dt_aereo = TO_DATE('$this->part_dt_aereo_', 'yyyy-mm-dd hh24:mi:ss')"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "part_dt_aereo = '$this->part_dt_aereo_'"; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['part_hospedagem_']) && $NM_val_form['part_hospedagem_'] == "null"  && $this->nmgp_dados_select['part_hospedagem_'] == "") ? "null" : $this->nmgp_dados_select['part_hospedagem_'];
              if (isset($NM_val_form['part_hospedagem_']) && $NM_val_form['part_hospedagem_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_hospedagem = '$this->part_hospedagem_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['par_dt_hospedagem_']) && $NM_val_form['par_dt_hospedagem_'] == "null"  && $this->nmgp_dados_select['par_dt_hospedagem_'] == "") ? "null" : $this->nmgp_dados_select['par_dt_hospedagem_'];
              if (isset($NM_val_form['par_dt_hospedagem_']) && $NM_val_form['par_dt_hospedagem_'] != $Prep_Tst) 
              { 
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                  { 
                      $SC_fields_update[] = "par_dt_hospedagem = TO_DATE('$this->par_dt_hospedagem_', 'yyyy-mm-dd hh24:mi:ss')"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "par_dt_hospedagem = '$this->par_dt_hospedagem_'"; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['part_dt_transfer_']) && $NM_val_form['part_dt_transfer_'] == "null"  && $this->nmgp_dados_select['part_dt_transfer_'] == "") ? "null" : $this->nmgp_dados_select['part_dt_transfer_'];
              if (isset($NM_val_form['part_dt_transfer_']) && $NM_val_form['part_dt_transfer_'] != $Prep_Tst) 
              { 
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                  { 
                      $SC_fields_update[] = "part_dt_transfer = TO_DATE('$this->part_dt_transfer_', 'yyyy-mm-dd hh24:mi:ss')"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "part_dt_transfer = '$this->part_dt_transfer_'"; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['part_opcionais_']) && $NM_val_form['part_opcionais_'] == "null"  && $this->nmgp_dados_select['part_opcionais_'] == "") ? "null" : $this->nmgp_dados_select['part_opcionais_'];
              if (isset($NM_val_form['part_opcionais_']) && $NM_val_form['part_opcionais_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_opcionais = '$this->part_opcionais_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_dt_opcionais_']) && $NM_val_form['part_dt_opcionais_'] == "null"  && $this->nmgp_dados_select['part_dt_opcionais_'] == "") ? "null" : $this->nmgp_dados_select['part_dt_opcionais_'];
              if (isset($NM_val_form['part_dt_opcionais_']) && $NM_val_form['part_dt_opcionais_'] != $Prep_Tst) 
              { 
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                  { 
                      $SC_fields_update[] = "part_dt_opcionais = TO_DATE('$this->part_dt_opcionais_', 'yyyy-mm-dd hh24:mi:ss')"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "part_dt_opcionais = '$this->part_dt_opcionais_'"; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['part_notas_']) && $NM_val_form['part_notas_'] == "null"  && $this->nmgp_dados_select['part_notas_'] == "") ? "null" : $this->nmgp_dados_select['part_notas_'];
              if (isset($NM_val_form['part_notas_']) && $NM_val_form['part_notas_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_notas = '$this->part_notas_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_confirm_viagem_']) && $NM_val_form['part_confirm_viagem_'] == "null"  && $this->nmgp_dados_select['part_confirm_viagem_'] == "") ? "null" : $this->nmgp_dados_select['part_confirm_viagem_'];
              if (isset($NM_val_form['part_confirm_viagem_']) && $NM_val_form['part_confirm_viagem_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_confirm_viagem = '$this->part_confirm_viagem_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_convite_']) && $NM_val_form['part_convite_'] == "null"  && $this->nmgp_dados_select['part_convite_'] == "") ? "null" : $this->nmgp_dados_select['part_convite_'];
              if (isset($NM_val_form['part_convite_']) && $NM_val_form['part_convite_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_convite = '$this->part_convite_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_concluido_']) && $NM_val_form['part_concluido_'] == "null"  && $this->nmgp_dados_select['part_concluido_'] == "") ? "null" : $this->nmgp_dados_select['part_concluido_'];
              if (isset($NM_val_form['part_concluido_']) && $NM_val_form['part_concluido_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_concluido = '$this->part_concluido_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_transfer_']) && $NM_val_form['part_transfer_'] == "null"  && $this->nmgp_dados_select['part_transfer_'] == "") ? "null" : $this->nmgp_dados_select['part_transfer_'];
              if (isset($NM_val_form['part_transfer_']) && $NM_val_form['part_transfer_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_transfer = '$this->part_transfer_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_convite_enviado_']) && $NM_val_form['part_convite_enviado_'] == "null"  && $this->nmgp_dados_select['part_convite_enviado_'] == "") ? "null" : $this->nmgp_dados_select['part_convite_enviado_'];
              if (isset($NM_val_form['part_convite_enviado_']) && $NM_val_form['part_convite_enviado_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_convite_enviado = '$this->part_convite_enviado_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_destaque_negrito_']) && $NM_val_form['part_destaque_negrito_'] == "null"  && $this->nmgp_dados_select['part_destaque_negrito_'] == "") ? "null" : $this->nmgp_dados_select['part_destaque_negrito_'];
              if (isset($NM_val_form['part_destaque_negrito_']) && $NM_val_form['part_destaque_negrito_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_destaque_negrito = '$this->part_destaque_negrito_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_atendimento_']) && $NM_val_form['part_atendimento_'] == "null"  && $this->nmgp_dados_select['part_atendimento_'] == "") ? "null" : $this->nmgp_dados_select['part_atendimento_'];
              if (isset($NM_val_form['part_atendimento_']) && $NM_val_form['part_atendimento_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_atendimento = '$this->part_atendimento_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_save_the_date_']) && $NM_val_form['part_save_the_date_'] == "null"  && $this->nmgp_dados_select['part_save_the_date_'] == "") ? "null" : $this->nmgp_dados_select['part_save_the_date_'];
              if (isset($NM_val_form['part_save_the_date_']) && $NM_val_form['part_save_the_date_'] != $Prep_Tst) 
              { 
                  if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                  { 
                      $SC_fields_update[] = "part_save_the_date = #$this->part_save_the_date_#"; 
                  } 
                  elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
                  { 
                      $SC_fields_update[] = "part_save_the_date = EXTEND('" . $this->part_save_the_date_ . "', YEAR TO DAY)"; 
                  } 
                  else
                  { 
                      $SC_fields_update[] = "part_save_the_date = " . $this->Ini->date_delim . $this->part_save_the_date_ . $this->Ini->date_delim1 . ""; 
                  } 
              } 
              $Prep_Tst = (isset($NM_val_form['part_arq_save_']) && $NM_val_form['part_arq_save_'] == "null"  && $this->nmgp_dados_select['part_arq_save_'] == "") ? "null" : $this->nmgp_dados_select['part_arq_save_'];
              if (isset($NM_val_form['part_arq_save_']) && $NM_val_form['part_arq_save_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_arq_save = '$this->part_arq_save_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_arq_convite_']) && $NM_val_form['part_arq_convite_'] == "null"  && $this->nmgp_dados_select['part_arq_convite_'] == "") ? "null" : $this->nmgp_dados_select['part_arq_convite_'];
              if (isset($NM_val_form['part_arq_convite_']) && $NM_val_form['part_arq_convite_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_arq_convite = '$this->part_arq_convite_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_fumante_']) && $NM_val_form['part_fumante_'] == "null"  && $this->nmgp_dados_select['part_fumante_'] == "") ? "null" : $this->nmgp_dados_select['part_fumante_'];
              if (isset($NM_val_form['part_fumante_']) && $NM_val_form['part_fumante_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_fumante = '$this->part_fumante_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_restricao_alimentar_']) && $NM_val_form['part_restricao_alimentar_'] == "null"  && $this->nmgp_dados_select['part_restricao_alimentar_'] == "") ? "null" : $this->nmgp_dados_select['part_restricao_alimentar_'];
              if (isset($NM_val_form['part_restricao_alimentar_']) && $NM_val_form['part_restricao_alimentar_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_restricao_alimentar = '$this->part_restricao_alimentar_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_acompanhado_']) && $NM_val_form['part_acompanhado_'] == "null"  && $this->nmgp_dados_select['part_acompanhado_'] == "") ? "null" : $this->nmgp_dados_select['part_acompanhado_'];
              if (isset($NM_val_form['part_acompanhado_']) && $NM_val_form['part_acompanhado_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_acompanhado = '$this->part_acompanhado_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_acompanhado_hotel_']) && $NM_val_form['part_acompanhado_hotel_'] == "null"  && $this->nmgp_dados_select['part_acompanhado_hotel_'] == "") ? "null" : $this->nmgp_dados_select['part_acompanhado_hotel_'];
              if (isset($NM_val_form['part_acompanhado_hotel_']) && $NM_val_form['part_acompanhado_hotel_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_acompanhado_hotel = '$this->part_acompanhado_hotel_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_acom_completo_']) && $NM_val_form['part_acom_completo_'] == "null"  && $this->nmgp_dados_select['part_acom_completo_'] == "") ? "null" : $this->nmgp_dados_select['part_acom_completo_'];
              if (isset($NM_val_form['part_acom_completo_']) && $NM_val_form['part_acom_completo_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_acom_completo = '$this->part_acom_completo_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_acom_incompleto_']) && $NM_val_form['part_acom_incompleto_'] == "null"  && $this->nmgp_dados_select['part_acom_incompleto_'] == "") ? "null" : $this->nmgp_dados_select['part_acom_incompleto_'];
              if (isset($NM_val_form['part_acom_incompleto_']) && $NM_val_form['part_acom_incompleto_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_acom_incompleto = '$this->part_acom_incompleto_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_incompleto_']) && $NM_val_form['part_incompleto_'] == "null"  && $this->nmgp_dados_select['part_incompleto_'] == "") ? "null" : $this->nmgp_dados_select['part_incompleto_'];
              if (isset($NM_val_form['part_incompleto_']) && $NM_val_form['part_incompleto_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_incompleto = '$this->part_incompleto_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_aereo_ok_']) && $NM_val_form['part_aereo_ok_'] == "null"  && $this->nmgp_dados_select['part_aereo_ok_'] == "") ? "null" : $this->nmgp_dados_select['part_aereo_ok_'];
              if (isset($NM_val_form['part_aereo_ok_']) && $NM_val_form['part_aereo_ok_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_aereo_ok = '$this->part_aereo_ok_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_bloqueio_id_']) && $NM_val_form['part_bloqueio_id_'] == "null"  && $this->nmgp_dados_select['part_bloqueio_id_'] == "") ? "null" : $this->nmgp_dados_select['part_bloqueio_id_'];
              if (isset($NM_val_form['part_bloqueio_id_']) && $NM_val_form['part_bloqueio_id_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_bloqueio_id = $this->part_bloqueio_id_"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_hotel_']) && $NM_val_form['part_hotel_'] == "null"  && $this->nmgp_dados_select['part_hotel_'] == "") ? "null" : $this->nmgp_dados_select['part_hotel_'];
              if (isset($NM_val_form['part_hotel_']) && $NM_val_form['part_hotel_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_hotel = '$this->part_hotel_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_anotacoes_']) && $NM_val_form['part_anotacoes_'] == "null"  && $this->nmgp_dados_select['part_anotacoes_'] == "") ? "null" : $this->nmgp_dados_select['part_anotacoes_'];
              if (isset($NM_val_form['part_anotacoes_']) && $NM_val_form['part_anotacoes_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_anotacoes = '$this->part_anotacoes_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['guarda_cod_substituto_']) && $NM_val_form['guarda_cod_substituto_'] == "null"  && $this->nmgp_dados_select['guarda_cod_substituto_'] == "") ? "null" : $this->nmgp_dados_select['guarda_cod_substituto_'];
              if (isset($NM_val_form['guarda_cod_substituto_']) && $NM_val_form['guarda_cod_substituto_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "guarda_cod_substituto = '$this->guarda_cod_substituto_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_cpf_informado_']) && $NM_val_form['part_cpf_informado_'] == "null"  && $this->nmgp_dados_select['part_cpf_informado_'] == "") ? "null" : $this->nmgp_dados_select['part_cpf_informado_'];
              if (isset($NM_val_form['part_cpf_informado_']) && $NM_val_form['part_cpf_informado_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_cpf_informado = '$this->part_cpf_informado_'"; 
              } 
              $Prep_Tst = (isset($NM_val_form['part_cv_obs_']) && $NM_val_form['part_cv_obs_'] == "null"  && $this->nmgp_dados_select['part_cv_obs_'] == "") ? "null" : $this->nmgp_dados_select['part_cv_obs_'];
              if (isset($NM_val_form['part_cv_obs_']) && $NM_val_form['part_cv_obs_'] != $Prep_Tst) 
              { 
                  $SC_fields_update[] = "part_cv_obs = '$this->part_cv_obs_'"; 
              } 
              $comando .= implode(",", $SC_fields_update);  
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
              {
                  $comando .= " WHERE participante_id = $this->participante_id_ ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $comando .= " WHERE participante_id = $this->participante_id_ ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $comando .= " WHERE participante_id = $this->participante_id_ ";  
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $comando .= " WHERE participante_id = $this->participante_id_ ";  
              }  
              else  
              {
                  $comando .= " WHERE participante_id = $this->participante_id_ ";  
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
                                  form_participantes_rsvp_ar_pack_ajax_response();
                              }
                              exit;  
                          }   
                      }   
                  }   
              }   
              $this->part_cpf_ = $this->part_cpf__before_qstr;
              $this->nome_pessoa_ = $this->nome_pessoa__before_qstr;
              $this->part_cpf_substituto_ = $this->part_cpf_substituto__before_qstr;
              $this->part_crnm_ = $this->part_crnm__before_qstr;
              $this->part_nome_cracha_ = $this->part_nome_cracha__before_qstr;
              $this->part_cod_substituto_ = $this->part_cod_substituto__before_qstr;
              $this->part_nome_substituto_ = $this->part_nome_substituto__before_qstr;
              $this->part_cod_substituido_ = $this->part_cod_substituido__before_qstr;
              $this->part_nome_substituido_ = $this->part_nome_substituido__before_qstr;
              $this->part_grupo_ = $this->part_grupo__before_qstr;
              $this->part_clube_ = $this->part_clube__before_qstr;
              $this->part_empresa_ = $this->part_empresa__before_qstr;
              $this->part_cep_ = $this->part_cep__before_qstr;
              $this->part_departamento_ = $this->part_departamento__before_qstr;
              $this->part_cargo_ = $this->part_cargo__before_qstr;
              $this->part_logradouro_ = $this->part_logradouro__before_qstr;
              $this->part_numero_ = $this->part_numero__before_qstr;
              $this->part_complemento_ = $this->part_complemento__before_qstr;
              $this->part_bairro_ = $this->part_bairro__before_qstr;
              $this->part_cidade_ = $this->part_cidade__before_qstr;
              $this->part_uf_ = $this->part_uf__before_qstr;
              $this->part_ddd_01_ = $this->part_ddd_01__before_qstr;
              $this->part_fone_01_ = $this->part_fone_01__before_qstr;
              $this->part_ddd_02_ = $this->part_ddd_02__before_qstr;
              $this->part_fone_02_ = $this->part_fone_02__before_qstr;
              $this->part_ddd_03_ = $this->part_ddd_03__before_qstr;
              $this->part_fone_03_ = $this->part_fone_03__before_qstr;
              $this->part_ddd_fax_ = $this->part_ddd_fax__before_qstr;
              $this->part_fax_ = $this->part_fax__before_qstr;
              $this->part_ddd_celular_01_ = $this->part_ddd_celular_01__before_qstr;
              $this->part_celeular_01_ = $this->part_celeular_01__before_qstr;
              $this->part_ddd_celular_02_ = $this->part_ddd_celular_02__before_qstr;
              $this->part_celular_02_ = $this->part_celular_02__before_qstr;
              $this->part_fone_internacional_ = $this->part_fone_internacional__before_qstr;
              $this->part_email_ = $this->part_email__before_qstr;
              $this->part_rg_ = $this->part_rg__before_qstr;
              $this->part_passaporte_ = $this->part_passaporte__before_qstr;
              $this->part_num_voucher_ = $this->part_num_voucher__before_qstr;
              $this->part_tam_camisa_ = $this->part_tam_camisa__before_qstr;
              $this->part_tam_calcado_ = $this->part_tam_calcado__before_qstr;
              $this->part_idioma_ = $this->part_idioma__before_qstr;
              $this->part_filiacao_ = $this->part_filiacao__before_qstr;
              $this->part_pais_ = $this->part_pais__before_qstr;
              $this->part_nome_secretaria_ = $this->part_nome_secretaria__before_qstr;
              $this->part_email_secretaria_ = $this->part_email_secretaria__before_qstr;
              $this->part_arq_save_ = $this->part_arq_save__before_qstr;
              $this->part_arq_convite_ = $this->part_arq_convite__before_qstr;
              $this->part_restricao_alimentar_ = $this->part_restricao_alimentar__before_qstr;
              $this->part_aereo_ok_ = $this->part_aereo_ok__before_qstr;
              $this->part_hotel_ = $this->part_hotel__before_qstr;
              $this->guarda_cod_substituto_ = $this->guarda_cod_substituto__before_qstr;
              $this->part_cpf_informado_ = $this->part_cpf_informado__before_qstr;
              $this->part_cv_obs_ = $this->part_cv_obs__before_qstr;
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

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['db_changed'] = true;
              if ($this->NM_ajax_flag) {
                  $this->NM_ajax_info['clearUpload'] = 'S';
              }

              $this->sc_teve_alt = true; 
              if     (isset($NM_val_form) && isset($NM_val_form['part_cpf_'])) { $this->part_cpf_ = $NM_val_form['part_cpf_']; }
              elseif (isset($this->part_cpf_)) { $this->nm_limpa_alfa($this->part_cpf_); }
              if     (isset($NM_val_form) && isset($NM_val_form['nome_pessoa_'])) { $this->nome_pessoa_ = $NM_val_form['nome_pessoa_']; }
              elseif (isset($this->nome_pessoa_)) { $this->nm_limpa_alfa($this->nome_pessoa_); }
              if     (isset($NM_val_form) && isset($NM_val_form['part_id_evento_'])) { $this->part_id_evento_ = $NM_val_form['part_id_evento_']; }
              elseif (isset($this->part_id_evento_)) { $this->nm_limpa_alfa($this->part_id_evento_); }
              if     (isset($NM_val_form) && isset($NM_val_form['part_id_evento_publico_'])) { $this->part_id_evento_publico_ = $NM_val_form['part_id_evento_publico_']; }
              elseif (isset($this->part_id_evento_publico_)) { $this->nm_limpa_alfa($this->part_id_evento_publico_); }
              if     (isset($NM_val_form) && isset($NM_val_form['part_id_evento_regional_'])) { $this->part_id_evento_regional_ = $NM_val_form['part_id_evento_regional_']; }
              elseif (isset($this->part_id_evento_regional_)) { $this->nm_limpa_alfa($this->part_id_evento_regional_); }
              if     (isset($NM_val_form) && isset($NM_val_form['part_grupo_'])) { $this->part_grupo_ = $NM_val_form['part_grupo_']; }
              elseif (isset($this->part_grupo_)) { $this->nm_limpa_alfa($this->part_grupo_); }
              if     (isset($NM_val_form) && isset($NM_val_form['part_clube_'])) { $this->part_clube_ = $NM_val_form['part_clube_']; }
              elseif (isset($this->part_clube_)) { $this->nm_limpa_alfa($this->part_clube_); }
              if     (isset($NM_val_form) && isset($NM_val_form['part_empresa_'])) { $this->part_empresa_ = $NM_val_form['part_empresa_']; }
              elseif (isset($this->part_empresa_)) { $this->nm_limpa_alfa($this->part_empresa_); }
              if     (isset($NM_val_form) && isset($NM_val_form['part_uf_'])) { $this->part_uf_ = $NM_val_form['part_uf_']; }
              elseif (isset($this->part_uf_)) { $this->nm_limpa_alfa($this->part_uf_); }
              if     (isset($NM_val_form) && isset($NM_val_form['part_ddd_celular_01_'])) { $this->part_ddd_celular_01_ = $NM_val_form['part_ddd_celular_01_']; }
              elseif (isset($this->part_ddd_celular_01_)) { $this->nm_limpa_alfa($this->part_ddd_celular_01_); }
              if     (isset($NM_val_form) && isset($NM_val_form['part_celeular_01_'])) { $this->part_celeular_01_ = $NM_val_form['part_celeular_01_']; }
              elseif (isset($this->part_celeular_01_)) { $this->nm_limpa_alfa($this->part_celeular_01_); }
              if     (isset($NM_val_form) && isset($NM_val_form['part_tam_camisa_'])) { $this->part_tam_camisa_ = $NM_val_form['part_tam_camisa_']; }
              elseif (isset($this->part_tam_camisa_)) { $this->nm_limpa_alfa($this->part_tam_camisa_); }
              if     (isset($NM_val_form) && isset($NM_val_form['part_tam_calcado_'])) { $this->part_tam_calcado_ = $NM_val_form['part_tam_calcado_']; }
              elseif (isset($this->part_tam_calcado_)) { $this->nm_limpa_alfa($this->part_tam_calcado_); }

              $this->nm_formatar_campos();
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
              }

              $aOldRefresh               = $this->nmgp_refresh_fields;
              $this->nmgp_refresh_fields = array_diff(array('part_id_evento_', 'part_cpf_', 'nome_pessoa_', 'part_sexo_', 'part_id_evento_publico_', 'part_id_evento_regional_', 'part_grupo_', 'part_clube_', 'part_empresa_', 'part_uf_', 'part_ddd_celular_01_', 'part_celeular_01_', 'part_dt_nasc_', 'part_tam_camisa_', 'part_tam_calcado_'), $aDoNotUpdate);
              $this->nmgp_refresh_fields = $aOldRefresh;

              if (isset($this->Embutida_ronly) && $this->Embutida_ronly)
              {

                  $this->NM_ajax_info['readOnly']['part_id_evento_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['part_cpf_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['nome_pessoa_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['part_sexo_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['part_id_evento_publico_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['part_id_evento_regional_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['part_grupo_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['part_clube_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['part_empresa_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['part_uf_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['part_ddd_celular_01_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['part_celeular_01_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['part_dt_nasc_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['part_tam_camisa_' . $this->nmgp_refresh_row] = 'on';

                  $this->NM_ajax_info['readOnly']['part_tam_calcado_' . $this->nmgp_refresh_row] = 'on';


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
          if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['foreign_key']))
          {
              foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['foreign_key'] as $sFKName => $sFKValue)
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
              $NM_cmp_auto = "participante_id, ";
          } 
          $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select max(participante_id) from " . $this->Ini->nm_tabela; 
          $comando = "select max(participante_id) from " . $this->Ini->nm_tabela; 
          $rs = $this->Db->Execute($comando); 
          if ($rs === false && !$rs->EOF)  
          { 
              $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_inst'], $this->Db->ErrorMsg()); 
              $this->NM_rollback_db(); 
              if ($this->NM_ajax_flag)
              {
                  form_participantes_rsvp_ar_pack_ajax_response();
              }
              exit; 
          }  
          $this->participante_id__before_qstr = $this->participante_id_ = $rs->fields[0] + 1;
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
                  if ($this->part_ativo_ != "")
                  { 
                       $compl_insert     .= ", part_ativo";
                       $compl_insert_val .= ", '$this->part_ativo_'";
                  } 
                  if ($this->part_tipo_ != "")
                  { 
                       $compl_insert     .= ", part_tipo";
                       $compl_insert_val .= ", '$this->part_tipo_'";
                  } 
                  if ($this->part_substituido_ != "")
                  { 
                       $compl_insert     .= ", part_substituido";
                       $compl_insert_val .= ", '$this->part_substituido_'";
                  } 
                  if ($this->part_substituto_ != "")
                  { 
                       $compl_insert     .= ", part_substituto";
                       $compl_insert_val .= ", '$this->part_substituto_'";
                  } 
                  if ($this->part_passaporte_estrangeiro_ != "")
                  { 
                       $compl_insert     .= ", part_passaporte_estrangeiro";
                       $compl_insert_val .= ", '$this->part_passaporte_estrangeiro_'";
                  } 
                  if ($this->part_ind_voucher_ != "")
                  { 
                       $compl_insert     .= ", part_ind_voucher";
                       $compl_insert_val .= ", '$this->part_ind_voucher_'";
                  } 
                  if ($this->part_dt_cadastro_ != "")
                  { 
                       $compl_insert     .= ", part_dt_cadastro";
                       $compl_insert_val .= ", '$this->part_dt_cadastro_'";
                  } 
                  if ($this->part_dt_alteracao_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alteracao";
                       $compl_insert_val .= ", '$this->part_dt_alteracao_'";
                  } 
                  if ($this->part_contato_rsvp_ != "")
                  { 
                       $compl_insert     .= ", part_contato_rsvp";
                       $compl_insert_val .= ", '$this->part_contato_rsvp_'";
                  } 
                  if ($this->part_dt_alt_contato_rsvp_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alt_contato_rsvp";
                       $compl_insert_val .= ", '$this->part_dt_alt_contato_rsvp_'";
                  } 
                  if ($this->part_presenca_ != "")
                  { 
                       $compl_insert     .= ", part_presenca";
                       $compl_insert_val .= ", '$this->part_presenca_'";
                  } 
                  if ($this->part_dt_alt_presenca_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alt_presenca";
                       $compl_insert_val .= ", '$this->part_dt_alt_presenca_'";
                  } 
                  if ($this->part_solicit_especial_ != "")
                  { 
                       $compl_insert     .= ", part_solicit_especial";
                       $compl_insert_val .= ", '$this->part_solicit_especial_'";
                  } 
                  if ($this->part_dt_solicit_especial_ != "")
                  { 
                       $compl_insert     .= ", part_dt_solicit_especial";
                       $compl_insert_val .= ", '$this->part_dt_solicit_especial_'";
                  } 
                  if ($this->part_programacao_ != "")
                  { 
                       $compl_insert     .= ", part_programacao";
                       $compl_insert_val .= ", '$this->part_programacao_'";
                  } 
                  if ($this->part_dt_programacao_ != "")
                  { 
                       $compl_insert     .= ", part_dt_programacao";
                       $compl_insert_val .= ", '$this->part_dt_programacao_'";
                  } 
                  if ($this->part_aereo_ != "")
                  { 
                       $compl_insert     .= ", part_aereo";
                       $compl_insert_val .= ", '$this->part_aereo_'";
                  } 
                  if ($this->part_dt_aereo_ != "")
                  { 
                       $compl_insert     .= ", part_dt_aereo";
                       $compl_insert_val .= ", '$this->part_dt_aereo_'";
                  } 
                  if ($this->part_hospedagem_ != "")
                  { 
                       $compl_insert     .= ", part_hospedagem";
                       $compl_insert_val .= ", '$this->part_hospedagem_'";
                  } 
                  if ($this->par_dt_hospedagem_ != "")
                  { 
                       $compl_insert     .= ", par_dt_hospedagem";
                       $compl_insert_val .= ", '$this->par_dt_hospedagem_'";
                  } 
                  if ($this->part_dt_transfer_ != "")
                  { 
                       $compl_insert     .= ", part_dt_transfer";
                       $compl_insert_val .= ", '$this->part_dt_transfer_'";
                  } 
                  if ($this->part_opcionais_ != "")
                  { 
                       $compl_insert     .= ", part_opcionais";
                       $compl_insert_val .= ", '$this->part_opcionais_'";
                  } 
                  if ($this->part_dt_opcionais_ != "")
                  { 
                       $compl_insert     .= ", part_dt_opcionais";
                       $compl_insert_val .= ", '$this->part_dt_opcionais_'";
                  } 
                  if ($this->part_notas_ != "")
                  { 
                       $compl_insert     .= ", part_notas";
                       $compl_insert_val .= ", '$this->part_notas_'";
                  } 
                  if ($this->part_confirm_viagem_ != "")
                  { 
                       $compl_insert     .= ", part_confirm_viagem";
                       $compl_insert_val .= ", '$this->part_confirm_viagem_'";
                  } 
                  if ($this->part_convite_ != "")
                  { 
                       $compl_insert     .= ", part_convite";
                       $compl_insert_val .= ", '$this->part_convite_'";
                  } 
                  if ($this->part_concluido_ != "")
                  { 
                       $compl_insert     .= ", part_concluido";
                       $compl_insert_val .= ", '$this->part_concluido_'";
                  } 
                  if ($this->part_transfer_ != "")
                  { 
                       $compl_insert     .= ", part_transfer";
                       $compl_insert_val .= ", '$this->part_transfer_'";
                  } 
                  if ($this->part_convite_enviado_ != "")
                  { 
                       $compl_insert     .= ", part_convite_enviado";
                       $compl_insert_val .= ", '$this->part_convite_enviado_'";
                  } 
                  if ($this->part_destaque_negrito_ != "")
                  { 
                       $compl_insert     .= ", part_destaque_negrito";
                       $compl_insert_val .= ", '$this->part_destaque_negrito_'";
                  } 
                  if ($this->part_atendimento_ != "")
                  { 
                       $compl_insert     .= ", part_atendimento";
                       $compl_insert_val .= ", '$this->part_atendimento_'";
                  } 
                  if ($this->part_fumante_ != "")
                  { 
                       $compl_insert     .= ", part_fumante";
                       $compl_insert_val .= ", '$this->part_fumante_'";
                  } 
                  if ($this->part_acompanhado_ != "")
                  { 
                       $compl_insert     .= ", part_acompanhado";
                       $compl_insert_val .= ", '$this->part_acompanhado_'";
                  } 
                  if ($this->part_acompanhado_hotel_ != "")
                  { 
                       $compl_insert     .= ", part_acompanhado_hotel";
                       $compl_insert_val .= ", '$this->part_acompanhado_hotel_'";
                  } 
                  if ($this->part_acom_completo_ != "")
                  { 
                       $compl_insert     .= ", part_acom_completo";
                       $compl_insert_val .= ", '$this->part_acom_completo_'";
                  } 
                  if ($this->part_acom_incompleto_ != "")
                  { 
                       $compl_insert     .= ", part_acom_incompleto";
                       $compl_insert_val .= ", '$this->part_acom_incompleto_'";
                  } 
                  if ($this->part_incompleto_ != "")
                  { 
                       $compl_insert     .= ", part_incompleto";
                       $compl_insert_val .= ", '$this->part_incompleto_'";
                  } 
                  if ($this->part_aereo_ok_ != "")
                  { 
                       $compl_insert     .= ", part_aereo_ok";
                       $compl_insert_val .= ", '$this->part_aereo_ok_'";
                  } 
                  if ($this->part_anotacoes_ != "")
                  { 
                       $compl_insert     .= ", part_anotacoes";
                       $compl_insert_val .= ", '$this->part_anotacoes_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (part_sexo, part_cpf, nome_pessoa, part_cpf_substituto, part_crnm, part_nome_cracha, part_id_evento, part_id_evento_publico, part_id_evento_regional, part_tipo_pessoa, part_cod_substituto, part_nome_substituto, part_sexo_substituto, part_cod_substituido, part_nome_substituido, part_grupo, part_clube, part_empresa, part_cep, part_departamento, part_cargo, part_logradouro, part_numero, part_complemento, part_bairro, part_cidade, part_uf, part_ddd_01, part_fone_01, part_ddd_02, part_fone_02, part_ddd_03, part_fone_03, part_ddd_fax, part_fax, part_ddd_celular_01, part_celeular_01, part_ddd_celular_02, part_celular_02, part_fone_internacional, part_email, part_dt_nasc, part_rg, part_passaporte, part_validade_pass, part_num_voucher, part_tam_camisa, part_tam_calcado, part_idioma, part_filiacao, part_pais, part_nome_secretaria, part_email_secretaria, part_cod_usuario, part_save_the_date, part_arq_save, part_arq_convite, part_restricao_alimentar, part_bloqueio_id, part_hotel, guarda_cod_substituto, part_cpf_informado, part_cv_obs $compl_insert) VALUES ('$this->part_sexo_', '$this->part_cpf_', '$this->nome_pessoa_', '$this->part_cpf_substituto_', '$this->part_crnm_', '$this->part_nome_cracha_', $this->part_id_evento_, $this->part_id_evento_publico_, $this->part_id_evento_regional_, '$this->part_tipo_pessoa_', '$this->part_cod_substituto_', '$this->part_nome_substituto_', '$this->part_sexo_substituto_', '$this->part_cod_substituido_', '$this->part_nome_substituido_', '$this->part_grupo_', '$this->part_clube_', '$this->part_empresa_', '$this->part_cep_', '$this->part_departamento_', '$this->part_cargo_', '$this->part_logradouro_', '$this->part_numero_', '$this->part_complemento_', '$this->part_bairro_', '$this->part_cidade_', '$this->part_uf_', '$this->part_ddd_01_', '$this->part_fone_01_', '$this->part_ddd_02_', '$this->part_fone_02_', '$this->part_ddd_03_', '$this->part_fone_03_', '$this->part_ddd_fax_', '$this->part_fax_', '$this->part_ddd_celular_01_', '$this->part_celeular_01_', '$this->part_ddd_celular_02_', '$this->part_celular_02_', '$this->part_fone_internacional_', '$this->part_email_', #$this->part_dt_nasc_#, '$this->part_rg_', '$this->part_passaporte_', #$this->part_validade_pass_#, '$this->part_num_voucher_', '$this->part_tam_camisa_', '$this->part_tam_calcado_', '$this->part_idioma_', '$this->part_filiacao_', '$this->part_pais_', '$this->part_nome_secretaria_', '$this->part_email_secretaria_', $this->part_cod_usuario_, #$this->part_save_the_date_#, '$this->part_arq_save_', '$this->part_arq_convite_', '$this->part_restricao_alimentar_', $this->part_bloqueio_id_, '$this->part_hotel_', '$this->guarda_cod_substituto_', '$this->part_cpf_informado_', '$this->part_cv_obs_' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->part_ativo_ != "")
                  { 
                       $compl_insert     .= ", part_ativo";
                       $compl_insert_val .= ", '$this->part_ativo_'";
                  } 
                  if ($this->part_tipo_ != "")
                  { 
                       $compl_insert     .= ", part_tipo";
                       $compl_insert_val .= ", '$this->part_tipo_'";
                  } 
                  if ($this->part_substituido_ != "")
                  { 
                       $compl_insert     .= ", part_substituido";
                       $compl_insert_val .= ", '$this->part_substituido_'";
                  } 
                  if ($this->part_substituto_ != "")
                  { 
                       $compl_insert     .= ", part_substituto";
                       $compl_insert_val .= ", '$this->part_substituto_'";
                  } 
                  if ($this->part_passaporte_estrangeiro_ != "")
                  { 
                       $compl_insert     .= ", part_passaporte_estrangeiro";
                       $compl_insert_val .= ", '$this->part_passaporte_estrangeiro_'";
                  } 
                  if ($this->part_ind_voucher_ != "")
                  { 
                       $compl_insert     .= ", part_ind_voucher";
                       $compl_insert_val .= ", '$this->part_ind_voucher_'";
                  } 
                  if ($this->part_dt_cadastro_ != "")
                  { 
                       $compl_insert     .= ", part_dt_cadastro";
                       $compl_insert_val .= ", '$this->part_dt_cadastro_'";
                  } 
                  if ($this->part_dt_alteracao_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alteracao";
                       $compl_insert_val .= ", '$this->part_dt_alteracao_'";
                  } 
                  if ($this->part_contato_rsvp_ != "")
                  { 
                       $compl_insert     .= ", part_contato_rsvp";
                       $compl_insert_val .= ", '$this->part_contato_rsvp_'";
                  } 
                  if ($this->part_dt_alt_contato_rsvp_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alt_contato_rsvp";
                       $compl_insert_val .= ", '$this->part_dt_alt_contato_rsvp_'";
                  } 
                  if ($this->part_presenca_ != "")
                  { 
                       $compl_insert     .= ", part_presenca";
                       $compl_insert_val .= ", '$this->part_presenca_'";
                  } 
                  if ($this->part_dt_alt_presenca_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alt_presenca";
                       $compl_insert_val .= ", '$this->part_dt_alt_presenca_'";
                  } 
                  if ($this->part_solicit_especial_ != "")
                  { 
                       $compl_insert     .= ", part_solicit_especial";
                       $compl_insert_val .= ", '$this->part_solicit_especial_'";
                  } 
                  if ($this->part_dt_solicit_especial_ != "")
                  { 
                       $compl_insert     .= ", part_dt_solicit_especial";
                       $compl_insert_val .= ", '$this->part_dt_solicit_especial_'";
                  } 
                  if ($this->part_programacao_ != "")
                  { 
                       $compl_insert     .= ", part_programacao";
                       $compl_insert_val .= ", '$this->part_programacao_'";
                  } 
                  if ($this->part_dt_programacao_ != "")
                  { 
                       $compl_insert     .= ", part_dt_programacao";
                       $compl_insert_val .= ", '$this->part_dt_programacao_'";
                  } 
                  if ($this->part_aereo_ != "")
                  { 
                       $compl_insert     .= ", part_aereo";
                       $compl_insert_val .= ", '$this->part_aereo_'";
                  } 
                  if ($this->part_dt_aereo_ != "")
                  { 
                       $compl_insert     .= ", part_dt_aereo";
                       $compl_insert_val .= ", '$this->part_dt_aereo_'";
                  } 
                  if ($this->part_hospedagem_ != "")
                  { 
                       $compl_insert     .= ", part_hospedagem";
                       $compl_insert_val .= ", '$this->part_hospedagem_'";
                  } 
                  if ($this->par_dt_hospedagem_ != "")
                  { 
                       $compl_insert     .= ", par_dt_hospedagem";
                       $compl_insert_val .= ", '$this->par_dt_hospedagem_'";
                  } 
                  if ($this->part_dt_transfer_ != "")
                  { 
                       $compl_insert     .= ", part_dt_transfer";
                       $compl_insert_val .= ", '$this->part_dt_transfer_'";
                  } 
                  if ($this->part_opcionais_ != "")
                  { 
                       $compl_insert     .= ", part_opcionais";
                       $compl_insert_val .= ", '$this->part_opcionais_'";
                  } 
                  if ($this->part_dt_opcionais_ != "")
                  { 
                       $compl_insert     .= ", part_dt_opcionais";
                       $compl_insert_val .= ", '$this->part_dt_opcionais_'";
                  } 
                  if ($this->part_notas_ != "")
                  { 
                       $compl_insert     .= ", part_notas";
                       $compl_insert_val .= ", '$this->part_notas_'";
                  } 
                  if ($this->part_confirm_viagem_ != "")
                  { 
                       $compl_insert     .= ", part_confirm_viagem";
                       $compl_insert_val .= ", '$this->part_confirm_viagem_'";
                  } 
                  if ($this->part_convite_ != "")
                  { 
                       $compl_insert     .= ", part_convite";
                       $compl_insert_val .= ", '$this->part_convite_'";
                  } 
                  if ($this->part_concluido_ != "")
                  { 
                       $compl_insert     .= ", part_concluido";
                       $compl_insert_val .= ", '$this->part_concluido_'";
                  } 
                  if ($this->part_transfer_ != "")
                  { 
                       $compl_insert     .= ", part_transfer";
                       $compl_insert_val .= ", '$this->part_transfer_'";
                  } 
                  if ($this->part_convite_enviado_ != "")
                  { 
                       $compl_insert     .= ", part_convite_enviado";
                       $compl_insert_val .= ", '$this->part_convite_enviado_'";
                  } 
                  if ($this->part_destaque_negrito_ != "")
                  { 
                       $compl_insert     .= ", part_destaque_negrito";
                       $compl_insert_val .= ", '$this->part_destaque_negrito_'";
                  } 
                  if ($this->part_atendimento_ != "")
                  { 
                       $compl_insert     .= ", part_atendimento";
                       $compl_insert_val .= ", '$this->part_atendimento_'";
                  } 
                  if ($this->part_fumante_ != "")
                  { 
                       $compl_insert     .= ", part_fumante";
                       $compl_insert_val .= ", '$this->part_fumante_'";
                  } 
                  if ($this->part_acompanhado_ != "")
                  { 
                       $compl_insert     .= ", part_acompanhado";
                       $compl_insert_val .= ", '$this->part_acompanhado_'";
                  } 
                  if ($this->part_acompanhado_hotel_ != "")
                  { 
                       $compl_insert     .= ", part_acompanhado_hotel";
                       $compl_insert_val .= ", '$this->part_acompanhado_hotel_'";
                  } 
                  if ($this->part_acom_completo_ != "")
                  { 
                       $compl_insert     .= ", part_acom_completo";
                       $compl_insert_val .= ", '$this->part_acom_completo_'";
                  } 
                  if ($this->part_acom_incompleto_ != "")
                  { 
                       $compl_insert     .= ", part_acom_incompleto";
                       $compl_insert_val .= ", '$this->part_acom_incompleto_'";
                  } 
                  if ($this->part_incompleto_ != "")
                  { 
                       $compl_insert     .= ", part_incompleto";
                       $compl_insert_val .= ", '$this->part_incompleto_'";
                  } 
                  if ($this->part_aereo_ok_ != "")
                  { 
                       $compl_insert     .= ", part_aereo_ok";
                       $compl_insert_val .= ", '$this->part_aereo_ok_'";
                  } 
                  if ($this->part_anotacoes_ != "")
                  { 
                       $compl_insert     .= ", part_anotacoes";
                       $compl_insert_val .= ", '$this->part_anotacoes_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "part_sexo, part_cpf, nome_pessoa, part_cpf_substituto, part_crnm, part_nome_cracha, part_id_evento, part_id_evento_publico, part_id_evento_regional, part_tipo_pessoa, part_cod_substituto, part_nome_substituto, part_sexo_substituto, part_cod_substituido, part_nome_substituido, part_grupo, part_clube, part_empresa, part_cep, part_departamento, part_cargo, part_logradouro, part_numero, part_complemento, part_bairro, part_cidade, part_uf, part_ddd_01, part_fone_01, part_ddd_02, part_fone_02, part_ddd_03, part_fone_03, part_ddd_fax, part_fax, part_ddd_celular_01, part_celeular_01, part_ddd_celular_02, part_celular_02, part_fone_internacional, part_email, part_dt_nasc, part_rg, part_passaporte, part_validade_pass, part_num_voucher, part_tam_camisa, part_tam_calcado, part_idioma, part_filiacao, part_pais, part_nome_secretaria, part_email_secretaria, part_cod_usuario, part_save_the_date, part_arq_save, part_arq_convite, part_restricao_alimentar, part_bloqueio_id, part_hotel, guarda_cod_substituto, part_cpf_informado, part_cv_obs $compl_insert) VALUES (" . $NM_seq_auto . "'$this->part_sexo_', '$this->part_cpf_', '$this->nome_pessoa_', '$this->part_cpf_substituto_', '$this->part_crnm_', '$this->part_nome_cracha_', $this->part_id_evento_, $this->part_id_evento_publico_, $this->part_id_evento_regional_, '$this->part_tipo_pessoa_', '$this->part_cod_substituto_', '$this->part_nome_substituto_', '$this->part_sexo_substituto_', '$this->part_cod_substituido_', '$this->part_nome_substituido_', '$this->part_grupo_', '$this->part_clube_', '$this->part_empresa_', '$this->part_cep_', '$this->part_departamento_', '$this->part_cargo_', '$this->part_logradouro_', '$this->part_numero_', '$this->part_complemento_', '$this->part_bairro_', '$this->part_cidade_', '$this->part_uf_', '$this->part_ddd_01_', '$this->part_fone_01_', '$this->part_ddd_02_', '$this->part_fone_02_', '$this->part_ddd_03_', '$this->part_fone_03_', '$this->part_ddd_fax_', '$this->part_fax_', '$this->part_ddd_celular_01_', '$this->part_celeular_01_', '$this->part_ddd_celular_02_', '$this->part_celular_02_', '$this->part_fone_internacional_', '$this->part_email_', " . $this->Ini->date_delim . $this->part_dt_nasc_ . $this->Ini->date_delim1 . ", '$this->part_rg_', '$this->part_passaporte_', " . $this->Ini->date_delim . $this->part_validade_pass_ . $this->Ini->date_delim1 . ", '$this->part_num_voucher_', '$this->part_tam_camisa_', '$this->part_tam_calcado_', '$this->part_idioma_', '$this->part_filiacao_', '$this->part_pais_', '$this->part_nome_secretaria_', '$this->part_email_secretaria_', $this->part_cod_usuario_, " . $this->Ini->date_delim . $this->part_save_the_date_ . $this->Ini->date_delim1 . ", '$this->part_arq_save_', '$this->part_arq_convite_', '$this->part_restricao_alimentar_', $this->part_bloqueio_id_, '$this->part_hotel_', '$this->guarda_cod_substituto_', '$this->part_cpf_informado_', '$this->part_cv_obs_' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
              { 
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->part_ativo_ != "")
                  { 
                       $compl_insert     .= ", part_ativo";
                       $compl_insert_val .= ", '$this->part_ativo_'";
                  } 
                  if ($this->part_tipo_ != "")
                  { 
                       $compl_insert     .= ", part_tipo";
                       $compl_insert_val .= ", '$this->part_tipo_'";
                  } 
                  if ($this->part_substituido_ != "")
                  { 
                       $compl_insert     .= ", part_substituido";
                       $compl_insert_val .= ", '$this->part_substituido_'";
                  } 
                  if ($this->part_substituto_ != "")
                  { 
                       $compl_insert     .= ", part_substituto";
                       $compl_insert_val .= ", '$this->part_substituto_'";
                  } 
                  if ($this->part_passaporte_estrangeiro_ != "")
                  { 
                       $compl_insert     .= ", part_passaporte_estrangeiro";
                       $compl_insert_val .= ", '$this->part_passaporte_estrangeiro_'";
                  } 
                  if ($this->part_ind_voucher_ != "")
                  { 
                       $compl_insert     .= ", part_ind_voucher";
                       $compl_insert_val .= ", '$this->part_ind_voucher_'";
                  } 
                  if ($this->part_dt_cadastro_ != "")
                  { 
                       $compl_insert     .= ", part_dt_cadastro";
                       $compl_insert_val .= ", '$this->part_dt_cadastro_'";
                  } 
                  if ($this->part_dt_alteracao_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alteracao";
                       $compl_insert_val .= ", '$this->part_dt_alteracao_'";
                  } 
                  if ($this->part_contato_rsvp_ != "")
                  { 
                       $compl_insert     .= ", part_contato_rsvp";
                       $compl_insert_val .= ", '$this->part_contato_rsvp_'";
                  } 
                  if ($this->part_dt_alt_contato_rsvp_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alt_contato_rsvp";
                       $compl_insert_val .= ", '$this->part_dt_alt_contato_rsvp_'";
                  } 
                  if ($this->part_presenca_ != "")
                  { 
                       $compl_insert     .= ", part_presenca";
                       $compl_insert_val .= ", '$this->part_presenca_'";
                  } 
                  if ($this->part_dt_alt_presenca_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alt_presenca";
                       $compl_insert_val .= ", '$this->part_dt_alt_presenca_'";
                  } 
                  if ($this->part_solicit_especial_ != "")
                  { 
                       $compl_insert     .= ", part_solicit_especial";
                       $compl_insert_val .= ", '$this->part_solicit_especial_'";
                  } 
                  if ($this->part_dt_solicit_especial_ != "")
                  { 
                       $compl_insert     .= ", part_dt_solicit_especial";
                       $compl_insert_val .= ", '$this->part_dt_solicit_especial_'";
                  } 
                  if ($this->part_programacao_ != "")
                  { 
                       $compl_insert     .= ", part_programacao";
                       $compl_insert_val .= ", '$this->part_programacao_'";
                  } 
                  if ($this->part_dt_programacao_ != "")
                  { 
                       $compl_insert     .= ", part_dt_programacao";
                       $compl_insert_val .= ", '$this->part_dt_programacao_'";
                  } 
                  if ($this->part_aereo_ != "")
                  { 
                       $compl_insert     .= ", part_aereo";
                       $compl_insert_val .= ", '$this->part_aereo_'";
                  } 
                  if ($this->part_dt_aereo_ != "")
                  { 
                       $compl_insert     .= ", part_dt_aereo";
                       $compl_insert_val .= ", '$this->part_dt_aereo_'";
                  } 
                  if ($this->part_hospedagem_ != "")
                  { 
                       $compl_insert     .= ", part_hospedagem";
                       $compl_insert_val .= ", '$this->part_hospedagem_'";
                  } 
                  if ($this->par_dt_hospedagem_ != "")
                  { 
                       $compl_insert     .= ", par_dt_hospedagem";
                       $compl_insert_val .= ", '$this->par_dt_hospedagem_'";
                  } 
                  if ($this->part_dt_transfer_ != "")
                  { 
                       $compl_insert     .= ", part_dt_transfer";
                       $compl_insert_val .= ", '$this->part_dt_transfer_'";
                  } 
                  if ($this->part_opcionais_ != "")
                  { 
                       $compl_insert     .= ", part_opcionais";
                       $compl_insert_val .= ", '$this->part_opcionais_'";
                  } 
                  if ($this->part_dt_opcionais_ != "")
                  { 
                       $compl_insert     .= ", part_dt_opcionais";
                       $compl_insert_val .= ", '$this->part_dt_opcionais_'";
                  } 
                  if ($this->part_notas_ != "")
                  { 
                       $compl_insert     .= ", part_notas";
                       $compl_insert_val .= ", '$this->part_notas_'";
                  } 
                  if ($this->part_confirm_viagem_ != "")
                  { 
                       $compl_insert     .= ", part_confirm_viagem";
                       $compl_insert_val .= ", '$this->part_confirm_viagem_'";
                  } 
                  if ($this->part_convite_ != "")
                  { 
                       $compl_insert     .= ", part_convite";
                       $compl_insert_val .= ", '$this->part_convite_'";
                  } 
                  if ($this->part_concluido_ != "")
                  { 
                       $compl_insert     .= ", part_concluido";
                       $compl_insert_val .= ", '$this->part_concluido_'";
                  } 
                  if ($this->part_transfer_ != "")
                  { 
                       $compl_insert     .= ", part_transfer";
                       $compl_insert_val .= ", '$this->part_transfer_'";
                  } 
                  if ($this->part_convite_enviado_ != "")
                  { 
                       $compl_insert     .= ", part_convite_enviado";
                       $compl_insert_val .= ", '$this->part_convite_enviado_'";
                  } 
                  if ($this->part_destaque_negrito_ != "")
                  { 
                       $compl_insert     .= ", part_destaque_negrito";
                       $compl_insert_val .= ", '$this->part_destaque_negrito_'";
                  } 
                  if ($this->part_atendimento_ != "")
                  { 
                       $compl_insert     .= ", part_atendimento";
                       $compl_insert_val .= ", '$this->part_atendimento_'";
                  } 
                  if ($this->part_fumante_ != "")
                  { 
                       $compl_insert     .= ", part_fumante";
                       $compl_insert_val .= ", '$this->part_fumante_'";
                  } 
                  if ($this->part_acompanhado_ != "")
                  { 
                       $compl_insert     .= ", part_acompanhado";
                       $compl_insert_val .= ", '$this->part_acompanhado_'";
                  } 
                  if ($this->part_acompanhado_hotel_ != "")
                  { 
                       $compl_insert     .= ", part_acompanhado_hotel";
                       $compl_insert_val .= ", '$this->part_acompanhado_hotel_'";
                  } 
                  if ($this->part_acom_completo_ != "")
                  { 
                       $compl_insert     .= ", part_acom_completo";
                       $compl_insert_val .= ", '$this->part_acom_completo_'";
                  } 
                  if ($this->part_acom_incompleto_ != "")
                  { 
                       $compl_insert     .= ", part_acom_incompleto";
                       $compl_insert_val .= ", '$this->part_acom_incompleto_'";
                  } 
                  if ($this->part_incompleto_ != "")
                  { 
                       $compl_insert     .= ", part_incompleto";
                       $compl_insert_val .= ", '$this->part_incompleto_'";
                  } 
                  if ($this->part_aereo_ok_ != "")
                  { 
                       $compl_insert     .= ", part_aereo_ok";
                       $compl_insert_val .= ", '$this->part_aereo_ok_'";
                  } 
                  if ($this->part_anotacoes_ != "")
                  { 
                       $compl_insert     .= ", part_anotacoes";
                       $compl_insert_val .= ", '$this->part_anotacoes_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "part_sexo, part_cpf, nome_pessoa, part_cpf_substituto, part_crnm, part_nome_cracha, part_id_evento, part_id_evento_publico, part_id_evento_regional, part_tipo_pessoa, part_cod_substituto, part_nome_substituto, part_sexo_substituto, part_cod_substituido, part_nome_substituido, part_grupo, part_clube, part_empresa, part_cep, part_departamento, part_cargo, part_logradouro, part_numero, part_complemento, part_bairro, part_cidade, part_uf, part_ddd_01, part_fone_01, part_ddd_02, part_fone_02, part_ddd_03, part_fone_03, part_ddd_fax, part_fax, part_ddd_celular_01, part_celeular_01, part_ddd_celular_02, part_celular_02, part_fone_internacional, part_email, part_dt_nasc, part_rg, part_passaporte, part_validade_pass, part_num_voucher, part_tam_camisa, part_tam_calcado, part_idioma, part_filiacao, part_pais, part_nome_secretaria, part_email_secretaria, part_cod_usuario, part_save_the_date, part_arq_save, part_arq_convite, part_restricao_alimentar, part_bloqueio_id, part_hotel, guarda_cod_substituto, part_cpf_informado, part_cv_obs $compl_insert) VALUES (" . $NM_seq_auto . "'$this->part_sexo_', '$this->part_cpf_', '$this->nome_pessoa_', '$this->part_cpf_substituto_', '$this->part_crnm_', '$this->part_nome_cracha_', $this->part_id_evento_, $this->part_id_evento_publico_, $this->part_id_evento_regional_, '$this->part_tipo_pessoa_', '$this->part_cod_substituto_', '$this->part_nome_substituto_', '$this->part_sexo_substituto_', '$this->part_cod_substituido_', '$this->part_nome_substituido_', '$this->part_grupo_', '$this->part_clube_', '$this->part_empresa_', '$this->part_cep_', '$this->part_departamento_', '$this->part_cargo_', '$this->part_logradouro_', '$this->part_numero_', '$this->part_complemento_', '$this->part_bairro_', '$this->part_cidade_', '$this->part_uf_', '$this->part_ddd_01_', '$this->part_fone_01_', '$this->part_ddd_02_', '$this->part_fone_02_', '$this->part_ddd_03_', '$this->part_fone_03_', '$this->part_ddd_fax_', '$this->part_fax_', '$this->part_ddd_celular_01_', '$this->part_celeular_01_', '$this->part_ddd_celular_02_', '$this->part_celular_02_', '$this->part_fone_internacional_', '$this->part_email_', " . $this->Ini->date_delim . $this->part_dt_nasc_ . $this->Ini->date_delim1 . ", '$this->part_rg_', '$this->part_passaporte_', " . $this->Ini->date_delim . $this->part_validade_pass_ . $this->Ini->date_delim1 . ", '$this->part_num_voucher_', '$this->part_tam_camisa_', '$this->part_tam_calcado_', '$this->part_idioma_', '$this->part_filiacao_', '$this->part_pais_', '$this->part_nome_secretaria_', '$this->part_email_secretaria_', $this->part_cod_usuario_, " . $this->Ini->date_delim . $this->part_save_the_date_ . $this->Ini->date_delim1 . ", '$this->part_arq_save_', '$this->part_arq_convite_', '$this->part_restricao_alimentar_', $this->part_bloqueio_id_, '$this->part_hotel_', '$this->guarda_cod_substituto_', '$this->part_cpf_informado_', '$this->part_cv_obs_' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->part_ativo_ != "")
                  { 
                       $compl_insert     .= ", part_ativo";
                       $compl_insert_val .= ", '$this->part_ativo_'";
                  } 
                  if ($this->part_tipo_ != "")
                  { 
                       $compl_insert     .= ", part_tipo";
                       $compl_insert_val .= ", '$this->part_tipo_'";
                  } 
                  if ($this->part_substituido_ != "")
                  { 
                       $compl_insert     .= ", part_substituido";
                       $compl_insert_val .= ", '$this->part_substituido_'";
                  } 
                  if ($this->part_substituto_ != "")
                  { 
                       $compl_insert     .= ", part_substituto";
                       $compl_insert_val .= ", '$this->part_substituto_'";
                  } 
                  if ($this->part_passaporte_estrangeiro_ != "")
                  { 
                       $compl_insert     .= ", part_passaporte_estrangeiro";
                       $compl_insert_val .= ", '$this->part_passaporte_estrangeiro_'";
                  } 
                  if ($this->part_ind_voucher_ != "")
                  { 
                       $compl_insert     .= ", part_ind_voucher";
                       $compl_insert_val .= ", '$this->part_ind_voucher_'";
                  } 
                  if ($this->part_dt_cadastro_ != "")
                  { 
                       $compl_insert     .= ", part_dt_cadastro";
                       $compl_insert_val .= ", TO_DATE('$this->part_dt_cadastro_', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->part_dt_alteracao_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alteracao";
                       $compl_insert_val .= ", TO_DATE('$this->part_dt_alteracao_', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->part_contato_rsvp_ != "")
                  { 
                       $compl_insert     .= ", part_contato_rsvp";
                       $compl_insert_val .= ", '$this->part_contato_rsvp_'";
                  } 
                  if ($this->part_dt_alt_contato_rsvp_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alt_contato_rsvp";
                       $compl_insert_val .= ", TO_DATE('$this->part_dt_alt_contato_rsvp_', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->part_presenca_ != "")
                  { 
                       $compl_insert     .= ", part_presenca";
                       $compl_insert_val .= ", '$this->part_presenca_'";
                  } 
                  if ($this->part_dt_alt_presenca_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alt_presenca";
                       $compl_insert_val .= ", TO_DATE('$this->part_dt_alt_presenca_', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->part_solicit_especial_ != "")
                  { 
                       $compl_insert     .= ", part_solicit_especial";
                       $compl_insert_val .= ", '$this->part_solicit_especial_'";
                  } 
                  if ($this->part_dt_solicit_especial_ != "")
                  { 
                       $compl_insert     .= ", part_dt_solicit_especial";
                       $compl_insert_val .= ", TO_DATE('$this->part_dt_solicit_especial_', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->part_programacao_ != "")
                  { 
                       $compl_insert     .= ", part_programacao";
                       $compl_insert_val .= ", '$this->part_programacao_'";
                  } 
                  if ($this->part_dt_programacao_ != "")
                  { 
                       $compl_insert     .= ", part_dt_programacao";
                       $compl_insert_val .= ", TO_DATE('$this->part_dt_programacao_', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->part_aereo_ != "")
                  { 
                       $compl_insert     .= ", part_aereo";
                       $compl_insert_val .= ", '$this->part_aereo_'";
                  } 
                  if ($this->part_dt_aereo_ != "")
                  { 
                       $compl_insert     .= ", part_dt_aereo";
                       $compl_insert_val .= ", TO_DATE('$this->part_dt_aereo_', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->part_hospedagem_ != "")
                  { 
                       $compl_insert     .= ", part_hospedagem";
                       $compl_insert_val .= ", '$this->part_hospedagem_'";
                  } 
                  if ($this->par_dt_hospedagem_ != "")
                  { 
                       $compl_insert     .= ", par_dt_hospedagem";
                       $compl_insert_val .= ", TO_DATE('$this->par_dt_hospedagem_', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->part_dt_transfer_ != "")
                  { 
                       $compl_insert     .= ", part_dt_transfer";
                       $compl_insert_val .= ", TO_DATE('$this->part_dt_transfer_', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->part_opcionais_ != "")
                  { 
                       $compl_insert     .= ", part_opcionais";
                       $compl_insert_val .= ", '$this->part_opcionais_'";
                  } 
                  if ($this->part_dt_opcionais_ != "")
                  { 
                       $compl_insert     .= ", part_dt_opcionais";
                       $compl_insert_val .= ", TO_DATE('$this->part_dt_opcionais_', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->part_notas_ != "")
                  { 
                       $compl_insert     .= ", part_notas";
                       $compl_insert_val .= ", '$this->part_notas_'";
                  } 
                  if ($this->part_confirm_viagem_ != "")
                  { 
                       $compl_insert     .= ", part_confirm_viagem";
                       $compl_insert_val .= ", '$this->part_confirm_viagem_'";
                  } 
                  if ($this->part_convite_ != "")
                  { 
                       $compl_insert     .= ", part_convite";
                       $compl_insert_val .= ", '$this->part_convite_'";
                  } 
                  if ($this->part_concluido_ != "")
                  { 
                       $compl_insert     .= ", part_concluido";
                       $compl_insert_val .= ", '$this->part_concluido_'";
                  } 
                  if ($this->part_transfer_ != "")
                  { 
                       $compl_insert     .= ", part_transfer";
                       $compl_insert_val .= ", '$this->part_transfer_'";
                  } 
                  if ($this->part_convite_enviado_ != "")
                  { 
                       $compl_insert     .= ", part_convite_enviado";
                       $compl_insert_val .= ", '$this->part_convite_enviado_'";
                  } 
                  if ($this->part_destaque_negrito_ != "")
                  { 
                       $compl_insert     .= ", part_destaque_negrito";
                       $compl_insert_val .= ", '$this->part_destaque_negrito_'";
                  } 
                  if ($this->part_atendimento_ != "")
                  { 
                       $compl_insert     .= ", part_atendimento";
                       $compl_insert_val .= ", '$this->part_atendimento_'";
                  } 
                  if ($this->part_fumante_ != "")
                  { 
                       $compl_insert     .= ", part_fumante";
                       $compl_insert_val .= ", '$this->part_fumante_'";
                  } 
                  if ($this->part_acompanhado_ != "")
                  { 
                       $compl_insert     .= ", part_acompanhado";
                       $compl_insert_val .= ", '$this->part_acompanhado_'";
                  } 
                  if ($this->part_acompanhado_hotel_ != "")
                  { 
                       $compl_insert     .= ", part_acompanhado_hotel";
                       $compl_insert_val .= ", '$this->part_acompanhado_hotel_'";
                  } 
                  if ($this->part_acom_completo_ != "")
                  { 
                       $compl_insert     .= ", part_acom_completo";
                       $compl_insert_val .= ", '$this->part_acom_completo_'";
                  } 
                  if ($this->part_acom_incompleto_ != "")
                  { 
                       $compl_insert     .= ", part_acom_incompleto";
                       $compl_insert_val .= ", '$this->part_acom_incompleto_'";
                  } 
                  if ($this->part_incompleto_ != "")
                  { 
                       $compl_insert     .= ", part_incompleto";
                       $compl_insert_val .= ", '$this->part_incompleto_'";
                  } 
                  if ($this->part_aereo_ok_ != "")
                  { 
                       $compl_insert     .= ", part_aereo_ok";
                       $compl_insert_val .= ", '$this->part_aereo_ok_'";
                  } 
                  if ($this->part_anotacoes_ != "")
                  { 
                       $compl_insert     .= ", part_anotacoes";
                       $compl_insert_val .= ", '$this->part_anotacoes_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "part_sexo, part_cpf, nome_pessoa, part_cpf_substituto, part_crnm, part_nome_cracha, part_id_evento, part_id_evento_publico, part_id_evento_regional, part_tipo_pessoa, part_cod_substituto, part_nome_substituto, part_sexo_substituto, part_cod_substituido, part_nome_substituido, part_grupo, part_clube, part_empresa, part_cep, part_departamento, part_cargo, part_logradouro, part_numero, part_complemento, part_bairro, part_cidade, part_uf, part_ddd_01, part_fone_01, part_ddd_02, part_fone_02, part_ddd_03, part_fone_03, part_ddd_fax, part_fax, part_ddd_celular_01, part_celeular_01, part_ddd_celular_02, part_celular_02, part_fone_internacional, part_email, part_dt_nasc, part_rg, part_passaporte, part_validade_pass, part_num_voucher, part_tam_camisa, part_tam_calcado, part_idioma, part_filiacao, part_pais, part_nome_secretaria, part_email_secretaria, part_cod_usuario, part_save_the_date, part_arq_save, part_arq_convite, part_restricao_alimentar, part_bloqueio_id, part_hotel, guarda_cod_substituto, part_cpf_informado, part_cv_obs $compl_insert) VALUES (" . $NM_seq_auto . "'$this->part_sexo_', '$this->part_cpf_', '$this->nome_pessoa_', '$this->part_cpf_substituto_', '$this->part_crnm_', '$this->part_nome_cracha_', $this->part_id_evento_, $this->part_id_evento_publico_, $this->part_id_evento_regional_, '$this->part_tipo_pessoa_', '$this->part_cod_substituto_', '$this->part_nome_substituto_', '$this->part_sexo_substituto_', '$this->part_cod_substituido_', '$this->part_nome_substituido_', '$this->part_grupo_', '$this->part_clube_', '$this->part_empresa_', '$this->part_cep_', '$this->part_departamento_', '$this->part_cargo_', '$this->part_logradouro_', '$this->part_numero_', '$this->part_complemento_', '$this->part_bairro_', '$this->part_cidade_', '$this->part_uf_', '$this->part_ddd_01_', '$this->part_fone_01_', '$this->part_ddd_02_', '$this->part_fone_02_', '$this->part_ddd_03_', '$this->part_fone_03_', '$this->part_ddd_fax_', '$this->part_fax_', '$this->part_ddd_celular_01_', '$this->part_celeular_01_', '$this->part_ddd_celular_02_', '$this->part_celular_02_', '$this->part_fone_internacional_', '$this->part_email_', " . $this->Ini->date_delim . $this->part_dt_nasc_ . $this->Ini->date_delim1 . ", '$this->part_rg_', '$this->part_passaporte_', " . $this->Ini->date_delim . $this->part_validade_pass_ . $this->Ini->date_delim1 . ", '$this->part_num_voucher_', '$this->part_tam_camisa_', '$this->part_tam_calcado_', '$this->part_idioma_', '$this->part_filiacao_', '$this->part_pais_', '$this->part_nome_secretaria_', '$this->part_email_secretaria_', $this->part_cod_usuario_, " . $this->Ini->date_delim . $this->part_save_the_date_ . $this->Ini->date_delim1 . ", '$this->part_arq_save_', '$this->part_arq_convite_', '$this->part_restricao_alimentar_', $this->part_bloqueio_id_, '$this->part_hotel_', '$this->guarda_cod_substituto_', '$this->part_cpf_informado_', '$this->part_cv_obs_' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->part_ativo_ != "")
                  { 
                       $compl_insert     .= ", part_ativo";
                       $compl_insert_val .= ", '$this->part_ativo_'";
                  } 
                  if ($this->part_tipo_ != "")
                  { 
                       $compl_insert     .= ", part_tipo";
                       $compl_insert_val .= ", '$this->part_tipo_'";
                  } 
                  if ($this->part_substituido_ != "")
                  { 
                       $compl_insert     .= ", part_substituido";
                       $compl_insert_val .= ", '$this->part_substituido_'";
                  } 
                  if ($this->part_substituto_ != "")
                  { 
                       $compl_insert     .= ", part_substituto";
                       $compl_insert_val .= ", '$this->part_substituto_'";
                  } 
                  if ($this->part_passaporte_estrangeiro_ != "")
                  { 
                       $compl_insert     .= ", part_passaporte_estrangeiro";
                       $compl_insert_val .= ", '$this->part_passaporte_estrangeiro_'";
                  } 
                  if ($this->part_ind_voucher_ != "")
                  { 
                       $compl_insert     .= ", part_ind_voucher";
                       $compl_insert_val .= ", '$this->part_ind_voucher_'";
                  } 
                  if ($this->part_dt_cadastro_ != "")
                  { 
                       $compl_insert     .= ", part_dt_cadastro";
                       $compl_insert_val .= ", '$this->part_dt_cadastro_'";
                  } 
                  if ($this->part_dt_alteracao_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alteracao";
                       $compl_insert_val .= ", '$this->part_dt_alteracao_'";
                  } 
                  if ($this->part_contato_rsvp_ != "")
                  { 
                       $compl_insert     .= ", part_contato_rsvp";
                       $compl_insert_val .= ", '$this->part_contato_rsvp_'";
                  } 
                  if ($this->part_dt_alt_contato_rsvp_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alt_contato_rsvp";
                       $compl_insert_val .= ", '$this->part_dt_alt_contato_rsvp_'";
                  } 
                  if ($this->part_presenca_ != "")
                  { 
                       $compl_insert     .= ", part_presenca";
                       $compl_insert_val .= ", '$this->part_presenca_'";
                  } 
                  if ($this->part_dt_alt_presenca_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alt_presenca";
                       $compl_insert_val .= ", '$this->part_dt_alt_presenca_'";
                  } 
                  if ($this->part_solicit_especial_ != "")
                  { 
                       $compl_insert     .= ", part_solicit_especial";
                       $compl_insert_val .= ", '$this->part_solicit_especial_'";
                  } 
                  if ($this->part_dt_solicit_especial_ != "")
                  { 
                       $compl_insert     .= ", part_dt_solicit_especial";
                       $compl_insert_val .= ", '$this->part_dt_solicit_especial_'";
                  } 
                  if ($this->part_programacao_ != "")
                  { 
                       $compl_insert     .= ", part_programacao";
                       $compl_insert_val .= ", '$this->part_programacao_'";
                  } 
                  if ($this->part_dt_programacao_ != "")
                  { 
                       $compl_insert     .= ", part_dt_programacao";
                       $compl_insert_val .= ", '$this->part_dt_programacao_'";
                  } 
                  if ($this->part_aereo_ != "")
                  { 
                       $compl_insert     .= ", part_aereo";
                       $compl_insert_val .= ", '$this->part_aereo_'";
                  } 
                  if ($this->part_dt_aereo_ != "")
                  { 
                       $compl_insert     .= ", part_dt_aereo";
                       $compl_insert_val .= ", '$this->part_dt_aereo_'";
                  } 
                  if ($this->part_hospedagem_ != "")
                  { 
                       $compl_insert     .= ", part_hospedagem";
                       $compl_insert_val .= ", '$this->part_hospedagem_'";
                  } 
                  if ($this->par_dt_hospedagem_ != "")
                  { 
                       $compl_insert     .= ", par_dt_hospedagem";
                       $compl_insert_val .= ", '$this->par_dt_hospedagem_'";
                  } 
                  if ($this->part_dt_transfer_ != "")
                  { 
                       $compl_insert     .= ", part_dt_transfer";
                       $compl_insert_val .= ", '$this->part_dt_transfer_'";
                  } 
                  if ($this->part_opcionais_ != "")
                  { 
                       $compl_insert     .= ", part_opcionais";
                       $compl_insert_val .= ", '$this->part_opcionais_'";
                  } 
                  if ($this->part_dt_opcionais_ != "")
                  { 
                       $compl_insert     .= ", part_dt_opcionais";
                       $compl_insert_val .= ", '$this->part_dt_opcionais_'";
                  } 
                  if ($this->part_notas_ != "")
                  { 
                       $compl_insert     .= ", part_notas";
                       $compl_insert_val .= ", '$this->part_notas_'";
                  } 
                  if ($this->part_confirm_viagem_ != "")
                  { 
                       $compl_insert     .= ", part_confirm_viagem";
                       $compl_insert_val .= ", '$this->part_confirm_viagem_'";
                  } 
                  if ($this->part_convite_ != "")
                  { 
                       $compl_insert     .= ", part_convite";
                       $compl_insert_val .= ", '$this->part_convite_'";
                  } 
                  if ($this->part_concluido_ != "")
                  { 
                       $compl_insert     .= ", part_concluido";
                       $compl_insert_val .= ", '$this->part_concluido_'";
                  } 
                  if ($this->part_transfer_ != "")
                  { 
                       $compl_insert     .= ", part_transfer";
                       $compl_insert_val .= ", '$this->part_transfer_'";
                  } 
                  if ($this->part_convite_enviado_ != "")
                  { 
                       $compl_insert     .= ", part_convite_enviado";
                       $compl_insert_val .= ", '$this->part_convite_enviado_'";
                  } 
                  if ($this->part_destaque_negrito_ != "")
                  { 
                       $compl_insert     .= ", part_destaque_negrito";
                       $compl_insert_val .= ", '$this->part_destaque_negrito_'";
                  } 
                  if ($this->part_atendimento_ != "")
                  { 
                       $compl_insert     .= ", part_atendimento";
                       $compl_insert_val .= ", '$this->part_atendimento_'";
                  } 
                  if ($this->part_fumante_ != "")
                  { 
                       $compl_insert     .= ", part_fumante";
                       $compl_insert_val .= ", '$this->part_fumante_'";
                  } 
                  if ($this->part_acompanhado_ != "")
                  { 
                       $compl_insert     .= ", part_acompanhado";
                       $compl_insert_val .= ", '$this->part_acompanhado_'";
                  } 
                  if ($this->part_acompanhado_hotel_ != "")
                  { 
                       $compl_insert     .= ", part_acompanhado_hotel";
                       $compl_insert_val .= ", '$this->part_acompanhado_hotel_'";
                  } 
                  if ($this->part_acom_completo_ != "")
                  { 
                       $compl_insert     .= ", part_acom_completo";
                       $compl_insert_val .= ", '$this->part_acom_completo_'";
                  } 
                  if ($this->part_acom_incompleto_ != "")
                  { 
                       $compl_insert     .= ", part_acom_incompleto";
                       $compl_insert_val .= ", '$this->part_acom_incompleto_'";
                  } 
                  if ($this->part_incompleto_ != "")
                  { 
                       $compl_insert     .= ", part_incompleto";
                       $compl_insert_val .= ", '$this->part_incompleto_'";
                  } 
                  if ($this->part_aereo_ok_ != "")
                  { 
                       $compl_insert     .= ", part_aereo_ok";
                       $compl_insert_val .= ", '$this->part_aereo_ok_'";
                  } 
                  if ($this->part_anotacoes_ != "")
                  { 
                       $compl_insert     .= ", part_anotacoes";
                       $compl_insert_val .= ", '$this->part_anotacoes_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "part_sexo, part_cpf, nome_pessoa, part_cpf_substituto, part_crnm, part_nome_cracha, part_id_evento, part_id_evento_publico, part_id_evento_regional, part_tipo_pessoa, part_cod_substituto, part_nome_substituto, part_sexo_substituto, part_cod_substituido, part_nome_substituido, part_grupo, part_clube, part_empresa, part_cep, part_departamento, part_cargo, part_logradouro, part_numero, part_complemento, part_bairro, part_cidade, part_uf, part_ddd_01, part_fone_01, part_ddd_02, part_fone_02, part_ddd_03, part_fone_03, part_ddd_fax, part_fax, part_ddd_celular_01, part_celeular_01, part_ddd_celular_02, part_celular_02, part_fone_internacional, part_email, part_dt_nasc, part_rg, part_passaporte, part_validade_pass, part_num_voucher, part_tam_camisa, part_tam_calcado, part_idioma, part_filiacao, part_pais, part_nome_secretaria, part_email_secretaria, part_cod_usuario, part_save_the_date, part_arq_save, part_arq_convite, part_restricao_alimentar, part_bloqueio_id, part_hotel, guarda_cod_substituto, part_cpf_informado, part_cv_obs $compl_insert) VALUES (" . $NM_seq_auto . "'$this->part_sexo_', '$this->part_cpf_', '$this->nome_pessoa_', '$this->part_cpf_substituto_', '$this->part_crnm_', '$this->part_nome_cracha_', $this->part_id_evento_, $this->part_id_evento_publico_, $this->part_id_evento_regional_, '$this->part_tipo_pessoa_', '$this->part_cod_substituto_', '$this->part_nome_substituto_', '$this->part_sexo_substituto_', '$this->part_cod_substituido_', '$this->part_nome_substituido_', '$this->part_grupo_', '$this->part_clube_', '$this->part_empresa_', '$this->part_cep_', '$this->part_departamento_', '$this->part_cargo_', '$this->part_logradouro_', '$this->part_numero_', '$this->part_complemento_', '$this->part_bairro_', '$this->part_cidade_', '$this->part_uf_', '$this->part_ddd_01_', '$this->part_fone_01_', '$this->part_ddd_02_', '$this->part_fone_02_', '$this->part_ddd_03_', '$this->part_fone_03_', '$this->part_ddd_fax_', '$this->part_fax_', '$this->part_ddd_celular_01_', '$this->part_celeular_01_', '$this->part_ddd_celular_02_', '$this->part_celular_02_', '$this->part_fone_internacional_', '$this->part_email_', EXTEND('$this->part_dt_nasc_', YEAR TO DAY), '$this->part_rg_', '$this->part_passaporte_', EXTEND('$this->part_validade_pass_', YEAR TO DAY), '$this->part_num_voucher_', '$this->part_tam_camisa_', '$this->part_tam_calcado_', '$this->part_idioma_', '$this->part_filiacao_', '$this->part_pais_', '$this->part_nome_secretaria_', '$this->part_email_secretaria_', $this->part_cod_usuario_, EXTEND('$this->part_save_the_date_', YEAR TO DAY), '$this->part_arq_save_', '$this->part_arq_convite_', '$this->part_restricao_alimentar_', $this->part_bloqueio_id_, '$this->part_hotel_', '$this->guarda_cod_substituto_', '$this->part_cpf_informado_', '$this->part_cv_obs_' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->part_ativo_ != "")
                  { 
                       $compl_insert     .= ", part_ativo";
                       $compl_insert_val .= ", '$this->part_ativo_'";
                  } 
                  if ($this->part_tipo_ != "")
                  { 
                       $compl_insert     .= ", part_tipo";
                       $compl_insert_val .= ", '$this->part_tipo_'";
                  } 
                  if ($this->part_substituido_ != "")
                  { 
                       $compl_insert     .= ", part_substituido";
                       $compl_insert_val .= ", '$this->part_substituido_'";
                  } 
                  if ($this->part_substituto_ != "")
                  { 
                       $compl_insert     .= ", part_substituto";
                       $compl_insert_val .= ", '$this->part_substituto_'";
                  } 
                  if ($this->part_passaporte_estrangeiro_ != "")
                  { 
                       $compl_insert     .= ", part_passaporte_estrangeiro";
                       $compl_insert_val .= ", '$this->part_passaporte_estrangeiro_'";
                  } 
                  if ($this->part_ind_voucher_ != "")
                  { 
                       $compl_insert     .= ", part_ind_voucher";
                       $compl_insert_val .= ", '$this->part_ind_voucher_'";
                  } 
                  if ($this->part_dt_cadastro_ != "")
                  { 
                       $compl_insert     .= ", part_dt_cadastro";
                       $compl_insert_val .= ", '$this->part_dt_cadastro_'";
                  } 
                  if ($this->part_dt_alteracao_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alteracao";
                       $compl_insert_val .= ", '$this->part_dt_alteracao_'";
                  } 
                  if ($this->part_contato_rsvp_ != "")
                  { 
                       $compl_insert     .= ", part_contato_rsvp";
                       $compl_insert_val .= ", '$this->part_contato_rsvp_'";
                  } 
                  if ($this->part_dt_alt_contato_rsvp_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alt_contato_rsvp";
                       $compl_insert_val .= ", '$this->part_dt_alt_contato_rsvp_'";
                  } 
                  if ($this->part_presenca_ != "")
                  { 
                       $compl_insert     .= ", part_presenca";
                       $compl_insert_val .= ", '$this->part_presenca_'";
                  } 
                  if ($this->part_dt_alt_presenca_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alt_presenca";
                       $compl_insert_val .= ", '$this->part_dt_alt_presenca_'";
                  } 
                  if ($this->part_solicit_especial_ != "")
                  { 
                       $compl_insert     .= ", part_solicit_especial";
                       $compl_insert_val .= ", '$this->part_solicit_especial_'";
                  } 
                  if ($this->part_dt_solicit_especial_ != "")
                  { 
                       $compl_insert     .= ", part_dt_solicit_especial";
                       $compl_insert_val .= ", '$this->part_dt_solicit_especial_'";
                  } 
                  if ($this->part_programacao_ != "")
                  { 
                       $compl_insert     .= ", part_programacao";
                       $compl_insert_val .= ", '$this->part_programacao_'";
                  } 
                  if ($this->part_dt_programacao_ != "")
                  { 
                       $compl_insert     .= ", part_dt_programacao";
                       $compl_insert_val .= ", '$this->part_dt_programacao_'";
                  } 
                  if ($this->part_aereo_ != "")
                  { 
                       $compl_insert     .= ", part_aereo";
                       $compl_insert_val .= ", '$this->part_aereo_'";
                  } 
                  if ($this->part_dt_aereo_ != "")
                  { 
                       $compl_insert     .= ", part_dt_aereo";
                       $compl_insert_val .= ", '$this->part_dt_aereo_'";
                  } 
                  if ($this->part_hospedagem_ != "")
                  { 
                       $compl_insert     .= ", part_hospedagem";
                       $compl_insert_val .= ", '$this->part_hospedagem_'";
                  } 
                  if ($this->par_dt_hospedagem_ != "")
                  { 
                       $compl_insert     .= ", par_dt_hospedagem";
                       $compl_insert_val .= ", '$this->par_dt_hospedagem_'";
                  } 
                  if ($this->part_dt_transfer_ != "")
                  { 
                       $compl_insert     .= ", part_dt_transfer";
                       $compl_insert_val .= ", '$this->part_dt_transfer_'";
                  } 
                  if ($this->part_opcionais_ != "")
                  { 
                       $compl_insert     .= ", part_opcionais";
                       $compl_insert_val .= ", '$this->part_opcionais_'";
                  } 
                  if ($this->part_dt_opcionais_ != "")
                  { 
                       $compl_insert     .= ", part_dt_opcionais";
                       $compl_insert_val .= ", '$this->part_dt_opcionais_'";
                  } 
                  if ($this->part_notas_ != "")
                  { 
                       $compl_insert     .= ", part_notas";
                       $compl_insert_val .= ", '$this->part_notas_'";
                  } 
                  if ($this->part_confirm_viagem_ != "")
                  { 
                       $compl_insert     .= ", part_confirm_viagem";
                       $compl_insert_val .= ", '$this->part_confirm_viagem_'";
                  } 
                  if ($this->part_convite_ != "")
                  { 
                       $compl_insert     .= ", part_convite";
                       $compl_insert_val .= ", '$this->part_convite_'";
                  } 
                  if ($this->part_concluido_ != "")
                  { 
                       $compl_insert     .= ", part_concluido";
                       $compl_insert_val .= ", '$this->part_concluido_'";
                  } 
                  if ($this->part_transfer_ != "")
                  { 
                       $compl_insert     .= ", part_transfer";
                       $compl_insert_val .= ", '$this->part_transfer_'";
                  } 
                  if ($this->part_convite_enviado_ != "")
                  { 
                       $compl_insert     .= ", part_convite_enviado";
                       $compl_insert_val .= ", '$this->part_convite_enviado_'";
                  } 
                  if ($this->part_destaque_negrito_ != "")
                  { 
                       $compl_insert     .= ", part_destaque_negrito";
                       $compl_insert_val .= ", '$this->part_destaque_negrito_'";
                  } 
                  if ($this->part_atendimento_ != "")
                  { 
                       $compl_insert     .= ", part_atendimento";
                       $compl_insert_val .= ", '$this->part_atendimento_'";
                  } 
                  if ($this->part_fumante_ != "")
                  { 
                       $compl_insert     .= ", part_fumante";
                       $compl_insert_val .= ", '$this->part_fumante_'";
                  } 
                  if ($this->part_acompanhado_ != "")
                  { 
                       $compl_insert     .= ", part_acompanhado";
                       $compl_insert_val .= ", '$this->part_acompanhado_'";
                  } 
                  if ($this->part_acompanhado_hotel_ != "")
                  { 
                       $compl_insert     .= ", part_acompanhado_hotel";
                       $compl_insert_val .= ", '$this->part_acompanhado_hotel_'";
                  } 
                  if ($this->part_acom_completo_ != "")
                  { 
                       $compl_insert     .= ", part_acom_completo";
                       $compl_insert_val .= ", '$this->part_acom_completo_'";
                  } 
                  if ($this->part_acom_incompleto_ != "")
                  { 
                       $compl_insert     .= ", part_acom_incompleto";
                       $compl_insert_val .= ", '$this->part_acom_incompleto_'";
                  } 
                  if ($this->part_incompleto_ != "")
                  { 
                       $compl_insert     .= ", part_incompleto";
                       $compl_insert_val .= ", '$this->part_incompleto_'";
                  } 
                  if ($this->part_aereo_ok_ != "")
                  { 
                       $compl_insert     .= ", part_aereo_ok";
                       $compl_insert_val .= ", '$this->part_aereo_ok_'";
                  } 
                  if ($this->part_anotacoes_ != "")
                  { 
                       $compl_insert     .= ", part_anotacoes";
                       $compl_insert_val .= ", '$this->part_anotacoes_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "part_sexo, part_cpf, nome_pessoa, part_cpf_substituto, part_crnm, part_nome_cracha, part_id_evento, part_id_evento_publico, part_id_evento_regional, part_tipo_pessoa, part_cod_substituto, part_nome_substituto, part_sexo_substituto, part_cod_substituido, part_nome_substituido, part_grupo, part_clube, part_empresa, part_cep, part_departamento, part_cargo, part_logradouro, part_numero, part_complemento, part_bairro, part_cidade, part_uf, part_ddd_01, part_fone_01, part_ddd_02, part_fone_02, part_ddd_03, part_fone_03, part_ddd_fax, part_fax, part_ddd_celular_01, part_celeular_01, part_ddd_celular_02, part_celular_02, part_fone_internacional, part_email, part_dt_nasc, part_rg, part_passaporte, part_validade_pass, part_num_voucher, part_tam_camisa, part_tam_calcado, part_idioma, part_filiacao, part_pais, part_nome_secretaria, part_email_secretaria, part_cod_usuario, part_save_the_date, part_arq_save, part_arq_convite, part_restricao_alimentar, part_bloqueio_id, part_hotel, guarda_cod_substituto, part_cpf_informado, part_cv_obs $compl_insert) VALUES (" . $NM_seq_auto . "'$this->part_sexo_', '$this->part_cpf_', '$this->nome_pessoa_', '$this->part_cpf_substituto_', '$this->part_crnm_', '$this->part_nome_cracha_', $this->part_id_evento_, $this->part_id_evento_publico_, $this->part_id_evento_regional_, '$this->part_tipo_pessoa_', '$this->part_cod_substituto_', '$this->part_nome_substituto_', '$this->part_sexo_substituto_', '$this->part_cod_substituido_', '$this->part_nome_substituido_', '$this->part_grupo_', '$this->part_clube_', '$this->part_empresa_', '$this->part_cep_', '$this->part_departamento_', '$this->part_cargo_', '$this->part_logradouro_', '$this->part_numero_', '$this->part_complemento_', '$this->part_bairro_', '$this->part_cidade_', '$this->part_uf_', '$this->part_ddd_01_', '$this->part_fone_01_', '$this->part_ddd_02_', '$this->part_fone_02_', '$this->part_ddd_03_', '$this->part_fone_03_', '$this->part_ddd_fax_', '$this->part_fax_', '$this->part_ddd_celular_01_', '$this->part_celeular_01_', '$this->part_ddd_celular_02_', '$this->part_celular_02_', '$this->part_fone_internacional_', '$this->part_email_', " . $this->Ini->date_delim . $this->part_dt_nasc_ . $this->Ini->date_delim1 . ", '$this->part_rg_', '$this->part_passaporte_', " . $this->Ini->date_delim . $this->part_validade_pass_ . $this->Ini->date_delim1 . ", '$this->part_num_voucher_', '$this->part_tam_camisa_', '$this->part_tam_calcado_', '$this->part_idioma_', '$this->part_filiacao_', '$this->part_pais_', '$this->part_nome_secretaria_', '$this->part_email_secretaria_', $this->part_cod_usuario_, " . $this->Ini->date_delim . $this->part_save_the_date_ . $this->Ini->date_delim1 . ", '$this->part_arq_save_', '$this->part_arq_convite_', '$this->part_restricao_alimentar_', $this->part_bloqueio_id_, '$this->part_hotel_', '$this->guarda_cod_substituto_', '$this->part_cpf_informado_', '$this->part_cv_obs_' $compl_insert_val)"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite))
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->part_ativo_ != "")
                  { 
                       $compl_insert     .= ", part_ativo";
                       $compl_insert_val .= ", '$this->part_ativo_'";
                  } 
                  if ($this->part_tipo_ != "")
                  { 
                       $compl_insert     .= ", part_tipo";
                       $compl_insert_val .= ", '$this->part_tipo_'";
                  } 
                  if ($this->part_substituido_ != "")
                  { 
                       $compl_insert     .= ", part_substituido";
                       $compl_insert_val .= ", '$this->part_substituido_'";
                  } 
                  if ($this->part_substituto_ != "")
                  { 
                       $compl_insert     .= ", part_substituto";
                       $compl_insert_val .= ", '$this->part_substituto_'";
                  } 
                  if ($this->part_passaporte_estrangeiro_ != "")
                  { 
                       $compl_insert     .= ", part_passaporte_estrangeiro";
                       $compl_insert_val .= ", '$this->part_passaporte_estrangeiro_'";
                  } 
                  if ($this->part_ind_voucher_ != "")
                  { 
                       $compl_insert     .= ", part_ind_voucher";
                       $compl_insert_val .= ", '$this->part_ind_voucher_'";
                  } 
                  if ($this->part_dt_cadastro_ != "")
                  { 
                       $compl_insert     .= ", part_dt_cadastro";
                       $compl_insert_val .= ", '$this->part_dt_cadastro_'";
                  } 
                  if ($this->part_dt_alteracao_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alteracao";
                       $compl_insert_val .= ", '$this->part_dt_alteracao_'";
                  } 
                  if ($this->part_contato_rsvp_ != "")
                  { 
                       $compl_insert     .= ", part_contato_rsvp";
                       $compl_insert_val .= ", '$this->part_contato_rsvp_'";
                  } 
                  if ($this->part_dt_alt_contato_rsvp_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alt_contato_rsvp";
                       $compl_insert_val .= ", '$this->part_dt_alt_contato_rsvp_'";
                  } 
                  if ($this->part_presenca_ != "")
                  { 
                       $compl_insert     .= ", part_presenca";
                       $compl_insert_val .= ", '$this->part_presenca_'";
                  } 
                  if ($this->part_dt_alt_presenca_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alt_presenca";
                       $compl_insert_val .= ", '$this->part_dt_alt_presenca_'";
                  } 
                  if ($this->part_solicit_especial_ != "")
                  { 
                       $compl_insert     .= ", part_solicit_especial";
                       $compl_insert_val .= ", '$this->part_solicit_especial_'";
                  } 
                  if ($this->part_dt_solicit_especial_ != "")
                  { 
                       $compl_insert     .= ", part_dt_solicit_especial";
                       $compl_insert_val .= ", '$this->part_dt_solicit_especial_'";
                  } 
                  if ($this->part_programacao_ != "")
                  { 
                       $compl_insert     .= ", part_programacao";
                       $compl_insert_val .= ", '$this->part_programacao_'";
                  } 
                  if ($this->part_dt_programacao_ != "")
                  { 
                       $compl_insert     .= ", part_dt_programacao";
                       $compl_insert_val .= ", '$this->part_dt_programacao_'";
                  } 
                  if ($this->part_aereo_ != "")
                  { 
                       $compl_insert     .= ", part_aereo";
                       $compl_insert_val .= ", '$this->part_aereo_'";
                  } 
                  if ($this->part_dt_aereo_ != "")
                  { 
                       $compl_insert     .= ", part_dt_aereo";
                       $compl_insert_val .= ", '$this->part_dt_aereo_'";
                  } 
                  if ($this->part_hospedagem_ != "")
                  { 
                       $compl_insert     .= ", part_hospedagem";
                       $compl_insert_val .= ", '$this->part_hospedagem_'";
                  } 
                  if ($this->par_dt_hospedagem_ != "")
                  { 
                       $compl_insert     .= ", par_dt_hospedagem";
                       $compl_insert_val .= ", '$this->par_dt_hospedagem_'";
                  } 
                  if ($this->part_dt_transfer_ != "")
                  { 
                       $compl_insert     .= ", part_dt_transfer";
                       $compl_insert_val .= ", '$this->part_dt_transfer_'";
                  } 
                  if ($this->part_opcionais_ != "")
                  { 
                       $compl_insert     .= ", part_opcionais";
                       $compl_insert_val .= ", '$this->part_opcionais_'";
                  } 
                  if ($this->part_dt_opcionais_ != "")
                  { 
                       $compl_insert     .= ", part_dt_opcionais";
                       $compl_insert_val .= ", '$this->part_dt_opcionais_'";
                  } 
                  if ($this->part_notas_ != "")
                  { 
                       $compl_insert     .= ", part_notas";
                       $compl_insert_val .= ", '$this->part_notas_'";
                  } 
                  if ($this->part_confirm_viagem_ != "")
                  { 
                       $compl_insert     .= ", part_confirm_viagem";
                       $compl_insert_val .= ", '$this->part_confirm_viagem_'";
                  } 
                  if ($this->part_convite_ != "")
                  { 
                       $compl_insert     .= ", part_convite";
                       $compl_insert_val .= ", '$this->part_convite_'";
                  } 
                  if ($this->part_concluido_ != "")
                  { 
                       $compl_insert     .= ", part_concluido";
                       $compl_insert_val .= ", '$this->part_concluido_'";
                  } 
                  if ($this->part_transfer_ != "")
                  { 
                       $compl_insert     .= ", part_transfer";
                       $compl_insert_val .= ", '$this->part_transfer_'";
                  } 
                  if ($this->part_convite_enviado_ != "")
                  { 
                       $compl_insert     .= ", part_convite_enviado";
                       $compl_insert_val .= ", '$this->part_convite_enviado_'";
                  } 
                  if ($this->part_destaque_negrito_ != "")
                  { 
                       $compl_insert     .= ", part_destaque_negrito";
                       $compl_insert_val .= ", '$this->part_destaque_negrito_'";
                  } 
                  if ($this->part_atendimento_ != "")
                  { 
                       $compl_insert     .= ", part_atendimento";
                       $compl_insert_val .= ", '$this->part_atendimento_'";
                  } 
                  if ($this->part_fumante_ != "")
                  { 
                       $compl_insert     .= ", part_fumante";
                       $compl_insert_val .= ", '$this->part_fumante_'";
                  } 
                  if ($this->part_acompanhado_ != "")
                  { 
                       $compl_insert     .= ", part_acompanhado";
                       $compl_insert_val .= ", '$this->part_acompanhado_'";
                  } 
                  if ($this->part_acompanhado_hotel_ != "")
                  { 
                       $compl_insert     .= ", part_acompanhado_hotel";
                       $compl_insert_val .= ", '$this->part_acompanhado_hotel_'";
                  } 
                  if ($this->part_acom_completo_ != "")
                  { 
                       $compl_insert     .= ", part_acom_completo";
                       $compl_insert_val .= ", '$this->part_acom_completo_'";
                  } 
                  if ($this->part_acom_incompleto_ != "")
                  { 
                       $compl_insert     .= ", part_acom_incompleto";
                       $compl_insert_val .= ", '$this->part_acom_incompleto_'";
                  } 
                  if ($this->part_incompleto_ != "")
                  { 
                       $compl_insert     .= ", part_incompleto";
                       $compl_insert_val .= ", '$this->part_incompleto_'";
                  } 
                  if ($this->part_aereo_ok_ != "")
                  { 
                       $compl_insert     .= ", part_aereo_ok";
                       $compl_insert_val .= ", '$this->part_aereo_ok_'";
                  } 
                  if ($this->part_anotacoes_ != "")
                  { 
                       $compl_insert     .= ", part_anotacoes";
                       $compl_insert_val .= ", '$this->part_anotacoes_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "part_sexo, part_cpf, nome_pessoa, part_cpf_substituto, part_crnm, part_nome_cracha, part_id_evento, part_id_evento_publico, part_id_evento_regional, part_tipo_pessoa, part_cod_substituto, part_nome_substituto, part_sexo_substituto, part_cod_substituido, part_nome_substituido, part_grupo, part_clube, part_empresa, part_cep, part_departamento, part_cargo, part_logradouro, part_numero, part_complemento, part_bairro, part_cidade, part_uf, part_ddd_01, part_fone_01, part_ddd_02, part_fone_02, part_ddd_03, part_fone_03, part_ddd_fax, part_fax, part_ddd_celular_01, part_celeular_01, part_ddd_celular_02, part_celular_02, part_fone_internacional, part_email, part_dt_nasc, part_rg, part_passaporte, part_validade_pass, part_num_voucher, part_tam_camisa, part_tam_calcado, part_idioma, part_filiacao, part_pais, part_nome_secretaria, part_email_secretaria, part_cod_usuario, part_save_the_date, part_arq_save, part_arq_convite, part_restricao_alimentar, part_bloqueio_id, part_hotel, guarda_cod_substituto, part_cpf_informado, part_cv_obs $compl_insert) VALUES (" . $NM_seq_auto . "'$this->part_sexo_', '$this->part_cpf_', '$this->nome_pessoa_', '$this->part_cpf_substituto_', '$this->part_crnm_', '$this->part_nome_cracha_', $this->part_id_evento_, $this->part_id_evento_publico_, $this->part_id_evento_regional_, '$this->part_tipo_pessoa_', '$this->part_cod_substituto_', '$this->part_nome_substituto_', '$this->part_sexo_substituto_', '$this->part_cod_substituido_', '$this->part_nome_substituido_', '$this->part_grupo_', '$this->part_clube_', '$this->part_empresa_', '$this->part_cep_', '$this->part_departamento_', '$this->part_cargo_', '$this->part_logradouro_', '$this->part_numero_', '$this->part_complemento_', '$this->part_bairro_', '$this->part_cidade_', '$this->part_uf_', '$this->part_ddd_01_', '$this->part_fone_01_', '$this->part_ddd_02_', '$this->part_fone_02_', '$this->part_ddd_03_', '$this->part_fone_03_', '$this->part_ddd_fax_', '$this->part_fax_', '$this->part_ddd_celular_01_', '$this->part_celeular_01_', '$this->part_ddd_celular_02_', '$this->part_celular_02_', '$this->part_fone_internacional_', '$this->part_email_', " . $this->Ini->date_delim . $this->part_dt_nasc_ . $this->Ini->date_delim1 . ", '$this->part_rg_', '$this->part_passaporte_', " . $this->Ini->date_delim . $this->part_validade_pass_ . $this->Ini->date_delim1 . ", '$this->part_num_voucher_', '$this->part_tam_camisa_', '$this->part_tam_calcado_', '$this->part_idioma_', '$this->part_filiacao_', '$this->part_pais_', '$this->part_nome_secretaria_', '$this->part_email_secretaria_', $this->part_cod_usuario_, " . $this->Ini->date_delim . $this->part_save_the_date_ . $this->Ini->date_delim1 . ", '$this->part_arq_save_', '$this->part_arq_convite_', '$this->part_restricao_alimentar_', $this->part_bloqueio_id_, '$this->part_hotel_', '$this->guarda_cod_substituto_', '$this->part_cpf_informado_', '$this->part_cv_obs_' $compl_insert_val)"; 
              }
              elseif ($this->Ini->nm_tpbanco == 'pdo_ibm')
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->part_ativo_ != "")
                  { 
                       $compl_insert     .= ", part_ativo";
                       $compl_insert_val .= ", '$this->part_ativo_'";
                  } 
                  if ($this->part_tipo_ != "")
                  { 
                       $compl_insert     .= ", part_tipo";
                       $compl_insert_val .= ", '$this->part_tipo_'";
                  } 
                  if ($this->part_substituido_ != "")
                  { 
                       $compl_insert     .= ", part_substituido";
                       $compl_insert_val .= ", '$this->part_substituido_'";
                  } 
                  if ($this->part_substituto_ != "")
                  { 
                       $compl_insert     .= ", part_substituto";
                       $compl_insert_val .= ", '$this->part_substituto_'";
                  } 
                  if ($this->part_passaporte_estrangeiro_ != "")
                  { 
                       $compl_insert     .= ", part_passaporte_estrangeiro";
                       $compl_insert_val .= ", '$this->part_passaporte_estrangeiro_'";
                  } 
                  if ($this->part_ind_voucher_ != "")
                  { 
                       $compl_insert     .= ", part_ind_voucher";
                       $compl_insert_val .= ", '$this->part_ind_voucher_'";
                  } 
                  if ($this->part_dt_cadastro_ != "")
                  { 
                       $compl_insert     .= ", part_dt_cadastro";
                       $compl_insert_val .= ", TO_DATE('$this->part_dt_cadastro_', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->part_dt_alteracao_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alteracao";
                       $compl_insert_val .= ", TO_DATE('$this->part_dt_alteracao_', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->part_contato_rsvp_ != "")
                  { 
                       $compl_insert     .= ", part_contato_rsvp";
                       $compl_insert_val .= ", '$this->part_contato_rsvp_'";
                  } 
                  if ($this->part_dt_alt_contato_rsvp_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alt_contato_rsvp";
                       $compl_insert_val .= ", TO_DATE('$this->part_dt_alt_contato_rsvp_', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->part_presenca_ != "")
                  { 
                       $compl_insert     .= ", part_presenca";
                       $compl_insert_val .= ", '$this->part_presenca_'";
                  } 
                  if ($this->part_dt_alt_presenca_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alt_presenca";
                       $compl_insert_val .= ", TO_DATE('$this->part_dt_alt_presenca_', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->part_solicit_especial_ != "")
                  { 
                       $compl_insert     .= ", part_solicit_especial";
                       $compl_insert_val .= ", '$this->part_solicit_especial_'";
                  } 
                  if ($this->part_dt_solicit_especial_ != "")
                  { 
                       $compl_insert     .= ", part_dt_solicit_especial";
                       $compl_insert_val .= ", TO_DATE('$this->part_dt_solicit_especial_', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->part_programacao_ != "")
                  { 
                       $compl_insert     .= ", part_programacao";
                       $compl_insert_val .= ", '$this->part_programacao_'";
                  } 
                  if ($this->part_dt_programacao_ != "")
                  { 
                       $compl_insert     .= ", part_dt_programacao";
                       $compl_insert_val .= ", TO_DATE('$this->part_dt_programacao_', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->part_aereo_ != "")
                  { 
                       $compl_insert     .= ", part_aereo";
                       $compl_insert_val .= ", '$this->part_aereo_'";
                  } 
                  if ($this->part_dt_aereo_ != "")
                  { 
                       $compl_insert     .= ", part_dt_aereo";
                       $compl_insert_val .= ", TO_DATE('$this->part_dt_aereo_', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->part_hospedagem_ != "")
                  { 
                       $compl_insert     .= ", part_hospedagem";
                       $compl_insert_val .= ", '$this->part_hospedagem_'";
                  } 
                  if ($this->par_dt_hospedagem_ != "")
                  { 
                       $compl_insert     .= ", par_dt_hospedagem";
                       $compl_insert_val .= ", TO_DATE('$this->par_dt_hospedagem_', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->part_dt_transfer_ != "")
                  { 
                       $compl_insert     .= ", part_dt_transfer";
                       $compl_insert_val .= ", TO_DATE('$this->part_dt_transfer_', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->part_opcionais_ != "")
                  { 
                       $compl_insert     .= ", part_opcionais";
                       $compl_insert_val .= ", '$this->part_opcionais_'";
                  } 
                  if ($this->part_dt_opcionais_ != "")
                  { 
                       $compl_insert     .= ", part_dt_opcionais";
                       $compl_insert_val .= ", TO_DATE('$this->part_dt_opcionais_', 'yyyy-mm-dd hh24:mi:ss')";
                  } 
                  if ($this->part_notas_ != "")
                  { 
                       $compl_insert     .= ", part_notas";
                       $compl_insert_val .= ", '$this->part_notas_'";
                  } 
                  if ($this->part_confirm_viagem_ != "")
                  { 
                       $compl_insert     .= ", part_confirm_viagem";
                       $compl_insert_val .= ", '$this->part_confirm_viagem_'";
                  } 
                  if ($this->part_convite_ != "")
                  { 
                       $compl_insert     .= ", part_convite";
                       $compl_insert_val .= ", '$this->part_convite_'";
                  } 
                  if ($this->part_concluido_ != "")
                  { 
                       $compl_insert     .= ", part_concluido";
                       $compl_insert_val .= ", '$this->part_concluido_'";
                  } 
                  if ($this->part_transfer_ != "")
                  { 
                       $compl_insert     .= ", part_transfer";
                       $compl_insert_val .= ", '$this->part_transfer_'";
                  } 
                  if ($this->part_convite_enviado_ != "")
                  { 
                       $compl_insert     .= ", part_convite_enviado";
                       $compl_insert_val .= ", '$this->part_convite_enviado_'";
                  } 
                  if ($this->part_destaque_negrito_ != "")
                  { 
                       $compl_insert     .= ", part_destaque_negrito";
                       $compl_insert_val .= ", '$this->part_destaque_negrito_'";
                  } 
                  if ($this->part_atendimento_ != "")
                  { 
                       $compl_insert     .= ", part_atendimento";
                       $compl_insert_val .= ", '$this->part_atendimento_'";
                  } 
                  if ($this->part_fumante_ != "")
                  { 
                       $compl_insert     .= ", part_fumante";
                       $compl_insert_val .= ", '$this->part_fumante_'";
                  } 
                  if ($this->part_acompanhado_ != "")
                  { 
                       $compl_insert     .= ", part_acompanhado";
                       $compl_insert_val .= ", '$this->part_acompanhado_'";
                  } 
                  if ($this->part_acompanhado_hotel_ != "")
                  { 
                       $compl_insert     .= ", part_acompanhado_hotel";
                       $compl_insert_val .= ", '$this->part_acompanhado_hotel_'";
                  } 
                  if ($this->part_acom_completo_ != "")
                  { 
                       $compl_insert     .= ", part_acom_completo";
                       $compl_insert_val .= ", '$this->part_acom_completo_'";
                  } 
                  if ($this->part_acom_incompleto_ != "")
                  { 
                       $compl_insert     .= ", part_acom_incompleto";
                       $compl_insert_val .= ", '$this->part_acom_incompleto_'";
                  } 
                  if ($this->part_incompleto_ != "")
                  { 
                       $compl_insert     .= ", part_incompleto";
                       $compl_insert_val .= ", '$this->part_incompleto_'";
                  } 
                  if ($this->part_aereo_ok_ != "")
                  { 
                       $compl_insert     .= ", part_aereo_ok";
                       $compl_insert_val .= ", '$this->part_aereo_ok_'";
                  } 
                  if ($this->part_anotacoes_ != "")
                  { 
                       $compl_insert     .= ", part_anotacoes";
                       $compl_insert_val .= ", '$this->part_anotacoes_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "part_sexo, part_cpf, nome_pessoa, part_cpf_substituto, part_crnm, part_nome_cracha, part_id_evento, part_id_evento_publico, part_id_evento_regional, part_tipo_pessoa, part_cod_substituto, part_nome_substituto, part_sexo_substituto, part_cod_substituido, part_nome_substituido, part_grupo, part_clube, part_empresa, part_cep, part_departamento, part_cargo, part_logradouro, part_numero, part_complemento, part_bairro, part_cidade, part_uf, part_ddd_01, part_fone_01, part_ddd_02, part_fone_02, part_ddd_03, part_fone_03, part_ddd_fax, part_fax, part_ddd_celular_01, part_celeular_01, part_ddd_celular_02, part_celular_02, part_fone_internacional, part_email, part_dt_nasc, part_rg, part_passaporte, part_validade_pass, part_num_voucher, part_tam_camisa, part_tam_calcado, part_idioma, part_filiacao, part_pais, part_nome_secretaria, part_email_secretaria, part_cod_usuario, part_save_the_date, part_arq_save, part_arq_convite, part_restricao_alimentar, part_bloqueio_id, part_hotel, guarda_cod_substituto, part_cpf_informado, part_cv_obs $compl_insert) VALUES (" . $NM_seq_auto . "'$this->part_sexo_', '$this->part_cpf_', '$this->nome_pessoa_', '$this->part_cpf_substituto_', '$this->part_crnm_', '$this->part_nome_cracha_', $this->part_id_evento_, $this->part_id_evento_publico_, $this->part_id_evento_regional_, '$this->part_tipo_pessoa_', '$this->part_cod_substituto_', '$this->part_nome_substituto_', '$this->part_sexo_substituto_', '$this->part_cod_substituido_', '$this->part_nome_substituido_', '$this->part_grupo_', '$this->part_clube_', '$this->part_empresa_', '$this->part_cep_', '$this->part_departamento_', '$this->part_cargo_', '$this->part_logradouro_', '$this->part_numero_', '$this->part_complemento_', '$this->part_bairro_', '$this->part_cidade_', '$this->part_uf_', '$this->part_ddd_01_', '$this->part_fone_01_', '$this->part_ddd_02_', '$this->part_fone_02_', '$this->part_ddd_03_', '$this->part_fone_03_', '$this->part_ddd_fax_', '$this->part_fax_', '$this->part_ddd_celular_01_', '$this->part_celeular_01_', '$this->part_ddd_celular_02_', '$this->part_celular_02_', '$this->part_fone_internacional_', '$this->part_email_', " . $this->Ini->date_delim . $this->part_dt_nasc_ . $this->Ini->date_delim1 . ", '$this->part_rg_', '$this->part_passaporte_', " . $this->Ini->date_delim . $this->part_validade_pass_ . $this->Ini->date_delim1 . ", '$this->part_num_voucher_', '$this->part_tam_camisa_', '$this->part_tam_calcado_', '$this->part_idioma_', '$this->part_filiacao_', '$this->part_pais_', '$this->part_nome_secretaria_', '$this->part_email_secretaria_', $this->part_cod_usuario_, " . $this->Ini->date_delim . $this->part_save_the_date_ . $this->Ini->date_delim1 . ", '$this->part_arq_save_', '$this->part_arq_convite_', '$this->part_restricao_alimentar_', $this->part_bloqueio_id_, '$this->part_hotel_', '$this->guarda_cod_substituto_', '$this->part_cpf_informado_', '$this->part_cv_obs_' $compl_insert_val)"; 
              }
              else
              {
                  $compl_insert     = ""; 
                  $compl_insert_val = ""; 
                  if ($this->part_ativo_ != "")
                  { 
                       $compl_insert     .= ", part_ativo";
                       $compl_insert_val .= ", '$this->part_ativo_'";
                  } 
                  if ($this->part_tipo_ != "")
                  { 
                       $compl_insert     .= ", part_tipo";
                       $compl_insert_val .= ", '$this->part_tipo_'";
                  } 
                  if ($this->part_substituido_ != "")
                  { 
                       $compl_insert     .= ", part_substituido";
                       $compl_insert_val .= ", '$this->part_substituido_'";
                  } 
                  if ($this->part_substituto_ != "")
                  { 
                       $compl_insert     .= ", part_substituto";
                       $compl_insert_val .= ", '$this->part_substituto_'";
                  } 
                  if ($this->part_passaporte_estrangeiro_ != "")
                  { 
                       $compl_insert     .= ", part_passaporte_estrangeiro";
                       $compl_insert_val .= ", '$this->part_passaporte_estrangeiro_'";
                  } 
                  if ($this->part_ind_voucher_ != "")
                  { 
                       $compl_insert     .= ", part_ind_voucher";
                       $compl_insert_val .= ", '$this->part_ind_voucher_'";
                  } 
                  if ($this->part_dt_cadastro_ != "")
                  { 
                       $compl_insert     .= ", part_dt_cadastro";
                       $compl_insert_val .= ", '$this->part_dt_cadastro_'";
                  } 
                  if ($this->part_dt_alteracao_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alteracao";
                       $compl_insert_val .= ", '$this->part_dt_alteracao_'";
                  } 
                  if ($this->part_contato_rsvp_ != "")
                  { 
                       $compl_insert     .= ", part_contato_rsvp";
                       $compl_insert_val .= ", '$this->part_contato_rsvp_'";
                  } 
                  if ($this->part_dt_alt_contato_rsvp_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alt_contato_rsvp";
                       $compl_insert_val .= ", '$this->part_dt_alt_contato_rsvp_'";
                  } 
                  if ($this->part_presenca_ != "")
                  { 
                       $compl_insert     .= ", part_presenca";
                       $compl_insert_val .= ", '$this->part_presenca_'";
                  } 
                  if ($this->part_dt_alt_presenca_ != "")
                  { 
                       $compl_insert     .= ", part_dt_alt_presenca";
                       $compl_insert_val .= ", '$this->part_dt_alt_presenca_'";
                  } 
                  if ($this->part_solicit_especial_ != "")
                  { 
                       $compl_insert     .= ", part_solicit_especial";
                       $compl_insert_val .= ", '$this->part_solicit_especial_'";
                  } 
                  if ($this->part_dt_solicit_especial_ != "")
                  { 
                       $compl_insert     .= ", part_dt_solicit_especial";
                       $compl_insert_val .= ", '$this->part_dt_solicit_especial_'";
                  } 
                  if ($this->part_programacao_ != "")
                  { 
                       $compl_insert     .= ", part_programacao";
                       $compl_insert_val .= ", '$this->part_programacao_'";
                  } 
                  if ($this->part_dt_programacao_ != "")
                  { 
                       $compl_insert     .= ", part_dt_programacao";
                       $compl_insert_val .= ", '$this->part_dt_programacao_'";
                  } 
                  if ($this->part_aereo_ != "")
                  { 
                       $compl_insert     .= ", part_aereo";
                       $compl_insert_val .= ", '$this->part_aereo_'";
                  } 
                  if ($this->part_dt_aereo_ != "")
                  { 
                       $compl_insert     .= ", part_dt_aereo";
                       $compl_insert_val .= ", '$this->part_dt_aereo_'";
                  } 
                  if ($this->part_hospedagem_ != "")
                  { 
                       $compl_insert     .= ", part_hospedagem";
                       $compl_insert_val .= ", '$this->part_hospedagem_'";
                  } 
                  if ($this->par_dt_hospedagem_ != "")
                  { 
                       $compl_insert     .= ", par_dt_hospedagem";
                       $compl_insert_val .= ", '$this->par_dt_hospedagem_'";
                  } 
                  if ($this->part_dt_transfer_ != "")
                  { 
                       $compl_insert     .= ", part_dt_transfer";
                       $compl_insert_val .= ", '$this->part_dt_transfer_'";
                  } 
                  if ($this->part_opcionais_ != "")
                  { 
                       $compl_insert     .= ", part_opcionais";
                       $compl_insert_val .= ", '$this->part_opcionais_'";
                  } 
                  if ($this->part_dt_opcionais_ != "")
                  { 
                       $compl_insert     .= ", part_dt_opcionais";
                       $compl_insert_val .= ", '$this->part_dt_opcionais_'";
                  } 
                  if ($this->part_notas_ != "")
                  { 
                       $compl_insert     .= ", part_notas";
                       $compl_insert_val .= ", '$this->part_notas_'";
                  } 
                  if ($this->part_confirm_viagem_ != "")
                  { 
                       $compl_insert     .= ", part_confirm_viagem";
                       $compl_insert_val .= ", '$this->part_confirm_viagem_'";
                  } 
                  if ($this->part_convite_ != "")
                  { 
                       $compl_insert     .= ", part_convite";
                       $compl_insert_val .= ", '$this->part_convite_'";
                  } 
                  if ($this->part_concluido_ != "")
                  { 
                       $compl_insert     .= ", part_concluido";
                       $compl_insert_val .= ", '$this->part_concluido_'";
                  } 
                  if ($this->part_transfer_ != "")
                  { 
                       $compl_insert     .= ", part_transfer";
                       $compl_insert_val .= ", '$this->part_transfer_'";
                  } 
                  if ($this->part_convite_enviado_ != "")
                  { 
                       $compl_insert     .= ", part_convite_enviado";
                       $compl_insert_val .= ", '$this->part_convite_enviado_'";
                  } 
                  if ($this->part_destaque_negrito_ != "")
                  { 
                       $compl_insert     .= ", part_destaque_negrito";
                       $compl_insert_val .= ", '$this->part_destaque_negrito_'";
                  } 
                  if ($this->part_atendimento_ != "")
                  { 
                       $compl_insert     .= ", part_atendimento";
                       $compl_insert_val .= ", '$this->part_atendimento_'";
                  } 
                  if ($this->part_fumante_ != "")
                  { 
                       $compl_insert     .= ", part_fumante";
                       $compl_insert_val .= ", '$this->part_fumante_'";
                  } 
                  if ($this->part_acompanhado_ != "")
                  { 
                       $compl_insert     .= ", part_acompanhado";
                       $compl_insert_val .= ", '$this->part_acompanhado_'";
                  } 
                  if ($this->part_acompanhado_hotel_ != "")
                  { 
                       $compl_insert     .= ", part_acompanhado_hotel";
                       $compl_insert_val .= ", '$this->part_acompanhado_hotel_'";
                  } 
                  if ($this->part_acom_completo_ != "")
                  { 
                       $compl_insert     .= ", part_acom_completo";
                       $compl_insert_val .= ", '$this->part_acom_completo_'";
                  } 
                  if ($this->part_acom_incompleto_ != "")
                  { 
                       $compl_insert     .= ", part_acom_incompleto";
                       $compl_insert_val .= ", '$this->part_acom_incompleto_'";
                  } 
                  if ($this->part_incompleto_ != "")
                  { 
                       $compl_insert     .= ", part_incompleto";
                       $compl_insert_val .= ", '$this->part_incompleto_'";
                  } 
                  if ($this->part_aereo_ok_ != "")
                  { 
                       $compl_insert     .= ", part_aereo_ok";
                       $compl_insert_val .= ", '$this->part_aereo_ok_'";
                  } 
                  if ($this->part_anotacoes_ != "")
                  { 
                       $compl_insert     .= ", part_anotacoes";
                       $compl_insert_val .= ", '$this->part_anotacoes_'";
                  } 
                  $comando = "INSERT INTO " . $this->Ini->nm_tabela . " (" . $NM_cmp_auto . "part_sexo, part_cpf, nome_pessoa, part_cpf_substituto, part_crnm, part_nome_cracha, part_id_evento, part_id_evento_publico, part_id_evento_regional, part_tipo_pessoa, part_cod_substituto, part_nome_substituto, part_sexo_substituto, part_cod_substituido, part_nome_substituido, part_grupo, part_clube, part_empresa, part_cep, part_departamento, part_cargo, part_logradouro, part_numero, part_complemento, part_bairro, part_cidade, part_uf, part_ddd_01, part_fone_01, part_ddd_02, part_fone_02, part_ddd_03, part_fone_03, part_ddd_fax, part_fax, part_ddd_celular_01, part_celeular_01, part_ddd_celular_02, part_celular_02, part_fone_internacional, part_email, part_dt_nasc, part_rg, part_passaporte, part_validade_pass, part_num_voucher, part_tam_camisa, part_tam_calcado, part_idioma, part_filiacao, part_pais, part_nome_secretaria, part_email_secretaria, part_cod_usuario, part_save_the_date, part_arq_save, part_arq_convite, part_restricao_alimentar, part_bloqueio_id, part_hotel, guarda_cod_substituto, part_cpf_informado, part_cv_obs $compl_insert) VALUES (" . $NM_seq_auto . "'$this->part_sexo_', '$this->part_cpf_', '$this->nome_pessoa_', '$this->part_cpf_substituto_', '$this->part_crnm_', '$this->part_nome_cracha_', $this->part_id_evento_, $this->part_id_evento_publico_, $this->part_id_evento_regional_, '$this->part_tipo_pessoa_', '$this->part_cod_substituto_', '$this->part_nome_substituto_', '$this->part_sexo_substituto_', '$this->part_cod_substituido_', '$this->part_nome_substituido_', '$this->part_grupo_', '$this->part_clube_', '$this->part_empresa_', '$this->part_cep_', '$this->part_departamento_', '$this->part_cargo_', '$this->part_logradouro_', '$this->part_numero_', '$this->part_complemento_', '$this->part_bairro_', '$this->part_cidade_', '$this->part_uf_', '$this->part_ddd_01_', '$this->part_fone_01_', '$this->part_ddd_02_', '$this->part_fone_02_', '$this->part_ddd_03_', '$this->part_fone_03_', '$this->part_ddd_fax_', '$this->part_fax_', '$this->part_ddd_celular_01_', '$this->part_celeular_01_', '$this->part_ddd_celular_02_', '$this->part_celular_02_', '$this->part_fone_internacional_', '$this->part_email_', " . $this->Ini->date_delim . $this->part_dt_nasc_ . $this->Ini->date_delim1 . ", '$this->part_rg_', '$this->part_passaporte_', " . $this->Ini->date_delim . $this->part_validade_pass_ . $this->Ini->date_delim1 . ", '$this->part_num_voucher_', '$this->part_tam_camisa_', '$this->part_tam_calcado_', '$this->part_idioma_', '$this->part_filiacao_', '$this->part_pais_', '$this->part_nome_secretaria_', '$this->part_email_secretaria_', $this->part_cod_usuario_, " . $this->Ini->date_delim . $this->part_save_the_date_ . $this->Ini->date_delim1 . ", '$this->part_arq_save_', '$this->part_arq_convite_', '$this->part_restricao_alimentar_', $this->part_bloqueio_id_, '$this->part_hotel_', '$this->guarda_cod_substituto_', '$this->part_cpf_informado_', '$this->part_cv_obs_' $compl_insert_val)"; 
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
                              form_participantes_rsvp_ar_pack_ajax_response();
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
                          form_participantes_rsvp_ar_pack_ajax_response();
                      }
                      exit; 
                  } 
                  $this->participante_id_ =  $rsy->fields[0];
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
                  $this->participante_id_ = $rsy->fields[0];
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
                  $this->participante_id_ = $rsy->fields[0];
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
                  $this->participante_id_ = $rsy->fields[0];
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
                  $this->participante_id_ = $rsy->fields[0];
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
                  $this->participante_id_ = $rsy->fields[0];
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
                  $this->participante_id_ = $rsy->fields[0];
                  $rsy->Close(); 
              } 
              $this->part_cpf_ = $this->part_cpf__before_qstr;
              $this->nome_pessoa_ = $this->nome_pessoa__before_qstr;
              $this->part_cpf_substituto_ = $this->part_cpf_substituto__before_qstr;
              $this->part_crnm_ = $this->part_crnm__before_qstr;
              $this->part_nome_cracha_ = $this->part_nome_cracha__before_qstr;
              $this->part_cod_substituto_ = $this->part_cod_substituto__before_qstr;
              $this->part_nome_substituto_ = $this->part_nome_substituto__before_qstr;
              $this->part_cod_substituido_ = $this->part_cod_substituido__before_qstr;
              $this->part_nome_substituido_ = $this->part_nome_substituido__before_qstr;
              $this->part_grupo_ = $this->part_grupo__before_qstr;
              $this->part_clube_ = $this->part_clube__before_qstr;
              $this->part_empresa_ = $this->part_empresa__before_qstr;
              $this->part_cep_ = $this->part_cep__before_qstr;
              $this->part_departamento_ = $this->part_departamento__before_qstr;
              $this->part_cargo_ = $this->part_cargo__before_qstr;
              $this->part_logradouro_ = $this->part_logradouro__before_qstr;
              $this->part_numero_ = $this->part_numero__before_qstr;
              $this->part_complemento_ = $this->part_complemento__before_qstr;
              $this->part_bairro_ = $this->part_bairro__before_qstr;
              $this->part_cidade_ = $this->part_cidade__before_qstr;
              $this->part_uf_ = $this->part_uf__before_qstr;
              $this->part_ddd_01_ = $this->part_ddd_01__before_qstr;
              $this->part_fone_01_ = $this->part_fone_01__before_qstr;
              $this->part_ddd_02_ = $this->part_ddd_02__before_qstr;
              $this->part_fone_02_ = $this->part_fone_02__before_qstr;
              $this->part_ddd_03_ = $this->part_ddd_03__before_qstr;
              $this->part_fone_03_ = $this->part_fone_03__before_qstr;
              $this->part_ddd_fax_ = $this->part_ddd_fax__before_qstr;
              $this->part_fax_ = $this->part_fax__before_qstr;
              $this->part_ddd_celular_01_ = $this->part_ddd_celular_01__before_qstr;
              $this->part_celeular_01_ = $this->part_celeular_01__before_qstr;
              $this->part_ddd_celular_02_ = $this->part_ddd_celular_02__before_qstr;
              $this->part_celular_02_ = $this->part_celular_02__before_qstr;
              $this->part_fone_internacional_ = $this->part_fone_internacional__before_qstr;
              $this->part_email_ = $this->part_email__before_qstr;
              $this->part_rg_ = $this->part_rg__before_qstr;
              $this->part_passaporte_ = $this->part_passaporte__before_qstr;
              $this->part_num_voucher_ = $this->part_num_voucher__before_qstr;
              $this->part_tam_camisa_ = $this->part_tam_camisa__before_qstr;
              $this->part_tam_calcado_ = $this->part_tam_calcado__before_qstr;
              $this->part_idioma_ = $this->part_idioma__before_qstr;
              $this->part_filiacao_ = $this->part_filiacao__before_qstr;
              $this->part_pais_ = $this->part_pais__before_qstr;
              $this->part_nome_secretaria_ = $this->part_nome_secretaria__before_qstr;
              $this->part_email_secretaria_ = $this->part_email_secretaria__before_qstr;
              $this->part_arq_save_ = $this->part_arq_save__before_qstr;
              $this->part_arq_convite_ = $this->part_arq_convite__before_qstr;
              $this->part_restricao_alimentar_ = $this->part_restricao_alimentar__before_qstr;
              $this->part_aereo_ok_ = $this->part_aereo_ok__before_qstr;
              $this->part_hotel_ = $this->part_hotel__before_qstr;
              $this->guarda_cod_substituto_ = $this->guarda_cod_substituto__before_qstr;
              $this->part_cpf_informado_ = $this->part_cpf_informado__before_qstr;
              $this->part_cv_obs_ = $this->part_cv_obs__before_qstr;
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['db_changed'] = true;

              $this->sc_evento = "insert"; 
              $this->part_cpf_ = $this->part_cpf__before_qstr;
              $this->nome_pessoa_ = $this->nome_pessoa__before_qstr;
              $this->part_cpf_substituto_ = $this->part_cpf_substituto__before_qstr;
              $this->part_crnm_ = $this->part_crnm__before_qstr;
              $this->part_nome_cracha_ = $this->part_nome_cracha__before_qstr;
              $this->part_cod_substituto_ = $this->part_cod_substituto__before_qstr;
              $this->part_nome_substituto_ = $this->part_nome_substituto__before_qstr;
              $this->part_cod_substituido_ = $this->part_cod_substituido__before_qstr;
              $this->part_nome_substituido_ = $this->part_nome_substituido__before_qstr;
              $this->part_grupo_ = $this->part_grupo__before_qstr;
              $this->part_clube_ = $this->part_clube__before_qstr;
              $this->part_empresa_ = $this->part_empresa__before_qstr;
              $this->part_cep_ = $this->part_cep__before_qstr;
              $this->part_departamento_ = $this->part_departamento__before_qstr;
              $this->part_cargo_ = $this->part_cargo__before_qstr;
              $this->part_logradouro_ = $this->part_logradouro__before_qstr;
              $this->part_numero_ = $this->part_numero__before_qstr;
              $this->part_complemento_ = $this->part_complemento__before_qstr;
              $this->part_bairro_ = $this->part_bairro__before_qstr;
              $this->part_cidade_ = $this->part_cidade__before_qstr;
              $this->part_uf_ = $this->part_uf__before_qstr;
              $this->part_ddd_01_ = $this->part_ddd_01__before_qstr;
              $this->part_fone_01_ = $this->part_fone_01__before_qstr;
              $this->part_ddd_02_ = $this->part_ddd_02__before_qstr;
              $this->part_fone_02_ = $this->part_fone_02__before_qstr;
              $this->part_ddd_03_ = $this->part_ddd_03__before_qstr;
              $this->part_fone_03_ = $this->part_fone_03__before_qstr;
              $this->part_ddd_fax_ = $this->part_ddd_fax__before_qstr;
              $this->part_fax_ = $this->part_fax__before_qstr;
              $this->part_ddd_celular_01_ = $this->part_ddd_celular_01__before_qstr;
              $this->part_celeular_01_ = $this->part_celeular_01__before_qstr;
              $this->part_ddd_celular_02_ = $this->part_ddd_celular_02__before_qstr;
              $this->part_celular_02_ = $this->part_celular_02__before_qstr;
              $this->part_fone_internacional_ = $this->part_fone_internacional__before_qstr;
              $this->part_email_ = $this->part_email__before_qstr;
              $this->part_rg_ = $this->part_rg__before_qstr;
              $this->part_passaporte_ = $this->part_passaporte__before_qstr;
              $this->part_num_voucher_ = $this->part_num_voucher__before_qstr;
              $this->part_tam_camisa_ = $this->part_tam_camisa__before_qstr;
              $this->part_tam_calcado_ = $this->part_tam_calcado__before_qstr;
              $this->part_idioma_ = $this->part_idioma__before_qstr;
              $this->part_filiacao_ = $this->part_filiacao__before_qstr;
              $this->part_pais_ = $this->part_pais__before_qstr;
              $this->part_nome_secretaria_ = $this->part_nome_secretaria__before_qstr;
              $this->part_email_secretaria_ = $this->part_email_secretaria__before_qstr;
              $this->part_arq_save_ = $this->part_arq_save__before_qstr;
              $this->part_arq_convite_ = $this->part_arq_convite__before_qstr;
              $this->part_restricao_alimentar_ = $this->part_restricao_alimentar__before_qstr;
              $this->part_aereo_ok_ = $this->part_aereo_ok__before_qstr;
              $this->part_hotel_ = $this->part_hotel__before_qstr;
              $this->guarda_cod_substituto_ = $this->guarda_cod_substituto__before_qstr;
              $this->part_cpf_informado_ = $this->part_cpf_informado__before_qstr;
              $this->part_cv_obs_ = $this->part_cv_obs__before_qstr;
              $this->sc_teve_incl = true; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_id_evento_'] = $this->part_id_evento_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_cpf_'] = $this->part_cpf_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['nome_pessoa_'] = $this->nome_pessoa_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_sexo_'] = $this->part_sexo_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_id_evento_publico_'] = $this->part_id_evento_publico_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_id_evento_regional_'] = $this->part_id_evento_regional_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_grupo_'] = $this->part_grupo_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_clube_'] = $this->part_clube_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_empresa_'] = $this->part_empresa_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_uf_'] = $this->part_uf_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_ddd_celular_01_'] = $this->part_ddd_celular_01_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_celeular_01_'] = $this->part_celeular_01_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_dt_nasc_'] = $this->part_dt_nasc_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_tam_camisa_'] = $this->part_tam_camisa_;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert]['part_tam_calcado_'] = $this->part_tam_calcado_;
              $this->restore_zeros_null();
              if (isset($this->part_cpf_)) { $this->nm_limpa_alfa($this->part_cpf_); }
              if (isset($this->nome_pessoa_)) { $this->nm_limpa_alfa($this->nome_pessoa_); }
              if (isset($this->part_id_evento_)) { $this->nm_limpa_alfa($this->part_id_evento_); }
              if (isset($this->part_id_evento_publico_)) { $this->nm_limpa_alfa($this->part_id_evento_publico_); }
              if (isset($this->part_id_evento_regional_)) { $this->nm_limpa_alfa($this->part_id_evento_regional_); }
              if (isset($this->part_grupo_)) { $this->nm_limpa_alfa($this->part_grupo_); }
              if (isset($this->part_clube_)) { $this->nm_limpa_alfa($this->part_clube_); }
              if (isset($this->part_empresa_)) { $this->nm_limpa_alfa($this->part_empresa_); }
              if (isset($this->part_uf_)) { $this->nm_limpa_alfa($this->part_uf_); }
              if (isset($this->part_ddd_celular_01_)) { $this->nm_limpa_alfa($this->part_ddd_celular_01_); }
              if (isset($this->part_celeular_01_)) { $this->nm_limpa_alfa($this->part_celeular_01_); }
              if (isset($this->part_tam_camisa_)) { $this->nm_limpa_alfa($this->part_tam_camisa_); }
              if (isset($this->part_tam_calcado_)) { $this->nm_limpa_alfa($this->part_tam_calcado_); }
              if (isset($this->Embutida_form) && $this->Embutida_form)
              {
                  $this->nm_guardar_campos();
                  $this->nm_formatar_campos();

                  $orig_part_id_evento_ = $this->part_id_evento_;
                  $part_id_evento_      = $this->part_id_evento_;
              nm_limpa_numero($part_id_evento_, $this->field_config['part_id_evento_']['symbol_grp']); 
                  $this->part_id_evento_ = $part_id_evento_;
                  $this->lookup_part_id_evento_($conteudo);
                  $this->part_id_evento_ = $orig_part_id_evento_;
                  $this->NM_ajax_info['fldList']['part_id_evento_' . $this->nmgp_refresh_row]['lookupCons'] = form_participantes_rsvp_ar_pack_protect_string($conteudo);
                  $this->NM_ajax_info['fldList']['part_id_evento_' . $this->nmgp_refresh_row]['type']    = 'text';
                  $this->NM_ajax_info['fldList']['part_id_evento_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->part_id_evento_)));
                  $this->NM_ajax_info['fldList']['part_id_evento_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_part_id_evento_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_id_evento_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_id_evento_' . $this->nmgp_refresh_row] = "on";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_id_evento_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_id_evento_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $this->NM_ajax_info['fldList']['part_cpf_' . $this->nmgp_refresh_row]['type']    = 'text';
                  $this->NM_ajax_info['fldList']['part_cpf_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->part_cpf_)));
                  $this->NM_ajax_info['fldList']['part_cpf_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_part_cpf_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_cpf_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_cpf_' . $this->nmgp_refresh_row] = "on";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_cpf_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_cpf_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $this->NM_ajax_info['fldList']['nome_pessoa_' . $this->nmgp_refresh_row]['type']    = 'text';
                  $this->NM_ajax_info['fldList']['nome_pessoa_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->nome_pessoa_)));
                  $this->NM_ajax_info['fldList']['nome_pessoa_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_nome_pessoa_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['nome_pessoa_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['nome_pessoa_' . $this->nmgp_refresh_row] = "on";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['nome_pessoa_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['nome_pessoa_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $this->NM_ajax_info['fldList']['part_sexo_' . $this->nmgp_refresh_row]['type']    = 'text';
                  $this->NM_ajax_info['fldList']['part_sexo_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->part_sexo_)));
                  $this->NM_ajax_info['fldList']['part_sexo_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_part_sexo_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_sexo_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_sexo_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_sexo_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_sexo_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $this->NM_ajax_info['fldList']['part_id_evento_publico_' . $this->nmgp_refresh_row]['type']    = 'text';
                  $this->NM_ajax_info['fldList']['part_id_evento_publico_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->part_id_evento_publico_)));
                  $this->NM_ajax_info['fldList']['part_id_evento_publico_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_part_id_evento_publico_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_id_evento_publico_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_id_evento_publico_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_id_evento_publico_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_id_evento_publico_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $this->NM_ajax_info['fldList']['part_id_evento_regional_' . $this->nmgp_refresh_row]['type']    = 'text';
                  $this->NM_ajax_info['fldList']['part_id_evento_regional_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->part_id_evento_regional_)));
                  $this->NM_ajax_info['fldList']['part_id_evento_regional_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_part_id_evento_regional_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_id_evento_regional_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_id_evento_regional_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_id_evento_regional_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_id_evento_regional_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $this->NM_ajax_info['fldList']['part_grupo_' . $this->nmgp_refresh_row]['type']    = 'text';
                  $this->NM_ajax_info['fldList']['part_grupo_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->part_grupo_)));
                  $this->NM_ajax_info['fldList']['part_grupo_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_part_grupo_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_grupo_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_grupo_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_grupo_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_grupo_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $this->NM_ajax_info['fldList']['part_clube_' . $this->nmgp_refresh_row]['type']    = 'text';
                  $this->NM_ajax_info['fldList']['part_clube_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->part_clube_)));
                  $this->NM_ajax_info['fldList']['part_clube_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_part_clube_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_clube_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_clube_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_clube_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_clube_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $this->NM_ajax_info['fldList']['part_empresa_' . $this->nmgp_refresh_row]['type']    = 'text';
                  $this->NM_ajax_info['fldList']['part_empresa_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->part_empresa_)));
                  $this->NM_ajax_info['fldList']['part_empresa_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_part_empresa_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_empresa_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_empresa_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_empresa_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_empresa_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $this->NM_ajax_info['fldList']['part_uf_' . $this->nmgp_refresh_row]['type']    = 'text';
                  $this->NM_ajax_info['fldList']['part_uf_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->part_uf_)));
                  $this->NM_ajax_info['fldList']['part_uf_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_part_uf_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_uf_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_uf_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_uf_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_uf_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $this->NM_ajax_info['fldList']['part_ddd_celular_01_' . $this->nmgp_refresh_row]['type']    = 'text';
                  $this->NM_ajax_info['fldList']['part_ddd_celular_01_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->part_ddd_celular_01_)));
                  $this->NM_ajax_info['fldList']['part_ddd_celular_01_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_part_ddd_celular_01_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_ddd_celular_01_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_ddd_celular_01_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_ddd_celular_01_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_ddd_celular_01_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $this->NM_ajax_info['fldList']['part_celeular_01_' . $this->nmgp_refresh_row]['type']    = 'text';
                  $this->NM_ajax_info['fldList']['part_celeular_01_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->part_celeular_01_)));
                  $this->NM_ajax_info['fldList']['part_celeular_01_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_part_celeular_01_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_celeular_01_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_celeular_01_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_celeular_01_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_celeular_01_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $this->NM_ajax_info['fldList']['part_dt_nasc_' . $this->nmgp_refresh_row]['type']    = 'text';
                  $this->NM_ajax_info['fldList']['part_dt_nasc_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->part_dt_nasc_)));
                  $this->NM_ajax_info['fldList']['part_dt_nasc_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_part_dt_nasc_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_dt_nasc_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_dt_nasc_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_dt_nasc_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_dt_nasc_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $this->NM_ajax_info['fldList']['part_tam_camisa_' . $this->nmgp_refresh_row]['type']    = 'text';
                  $this->NM_ajax_info['fldList']['part_tam_camisa_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->part_tam_camisa_)));
                  $this->NM_ajax_info['fldList']['part_tam_camisa_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_part_tam_camisa_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_tam_camisa_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_tam_camisa_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_tam_camisa_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_tam_camisa_' . $this->nmgp_refresh_row] = "on";
                      }
                  }

                  $this->NM_ajax_info['fldList']['part_tam_calcado_' . $this->nmgp_refresh_row]['type']    = 'text';
                  $this->NM_ajax_info['fldList']['part_tam_calcado_' . $this->nmgp_refresh_row]['valList'] = array($this->form_encode_input(NM_charset_to_utf8($this->part_tam_calcado_)));
                  $this->NM_ajax_info['fldList']['part_tam_calcado_' . $this->nmgp_refresh_row]['labList'] = array($this->form_encode_input(NM_charset_to_utf8($tmpLabel_part_tam_calcado_)));

                  if ((isset($this->Embutida_form) && $this->Embutida_form) && (!isset($this->Embutida_ronly) || !$this->Embutida_ronly))
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_tam_calcado_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_tam_calcado_' . $this->nmgp_refresh_row] = "off";
                      }
                  }
                  elseif (isset($this->Embutida_ronly) && $this->Embutida_ronly)
                  {
                      if (!isset($this->NM_ajax_info['readOnly']['part_tam_calcado_' . $this->nmgp_refresh_row]))
                      {
                          $this->NM_ajax_info['readOnly']['part_tam_calcado_' . $this->nmgp_refresh_row] = "on";
                      }
                  }


                  $this->nm_tira_formatacao();
                  $this->nm_converte_datas();

                  $this->NM_ajax_info['closeLine'] = $this->nmgp_refresh_row;
              }
              if ('refresh_insert' != $this->nmgp_opcao && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_redir_insert']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_redir_insert'] != "S"))
              {
              $this->nmgp_opcao = "novo"; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] == "R")
              { 
                   $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['return_edit'] = "new";
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
          $this->participante_id_ = substr($this->Db->qstr($this->participante_id_), 1, -1); 

          $bDelecaoOk = true;
          $sMsgErro   = '';

          if ($bDelecaoOk)
          {

          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_ "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_ "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_ "); 
          }  
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_ "); 
          }  
          else  
          {
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = "select count(*) AS countTest from " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_"; 
              $rs1 = $this->Db->Execute("select count(*) AS countTest from " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_ "); 
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
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_ "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_ "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_ "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_ "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_ "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_ "); 
              }  
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_ "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_ "); 
              }  
              else  
              {
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "DELETE FROM " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_ "; 
                  $rs = $this->Db->Execute("DELETE FROM " . $this->Ini->nm_tabela . " where participante_id = $this->participante_id_ "); 
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
                          form_participantes_rsvp_ar_pack_ajax_response();
                          exit; 
                      }
                  } 
              } 
              $this->sc_evento = "delete"; 
              $this->nmgp_opcao = "avanca"; 
              $this->nm_flag_iframe = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start']--; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] = 0; 
              }

              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['db_changed'] = true;

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
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['parms'] = "participante_id_?#?$this->participante_id_?@?"; 
      }
      if ($this->sc_evento != "insert" && $this->sc_evento != "update" && $this->sc_evento != "delete")
      { 
          $this->participante_id_ = null === $this->participante_id_ ? null : substr($this->Db->qstr($this->participante_id_), 1, -1); 
      } 
   }
//---------- 
   function nm_select_banco() 
   { 
      global $nm_form_submit, $sc_seq_vert, $sc_check_incl, $teste_validade, $sc_where;
 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['rows']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['rows']))
      {
          $this->sc_max_reg = $_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['rows'];
      } 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['rows_ins']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['rows_ins']))
      {
          $this->sc_max_reg_incl = $_SESSION['scriptcase']['sc_apl_conf']['form_participantes_rsvp_ar']['rows_ins'];
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_qtd_reg']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_qtd_reg'])
      {
          $this->sc_max_reg = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_qtd_reg'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_max_reg']) && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_max_reg'] > 0 || strtolower($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_max_reg']) == "all"))
      {
          $this->sc_max_reg = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_max_reg'];
      } 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $GLOBALS["NM_ERRO_IBASE"] = 0;  
      $this->form_vert_form_participantes_rsvp_ar = array();
      if ($this->nmgp_opcao != "novo") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['parms'] = ""; 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
      { 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
      } 
      if ($this->sc_teve_excl)
      {
          $this->nmgp_opcao = "avanca";
          if ($this->sc_max_reg != 'all') {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] -= $this->sc_max_reg;
          } 
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] = 0;
      }
      if (isset($this->NM_where_filter))
      {
          $this->NM_where_filter = str_replace("@percent@", "%", $this->NM_where_filter);
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_filter'] = trim($this->NM_where_filter);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['total']))
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['total']);
          }
      }
      $sc_where_filter = '';
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_filter_form'])
      {
          $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_filter_form'];
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_filter']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_filter'] && $sc_where_filter != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_filter'])
      {
          if (empty($sc_where_filter))
          {
              $sc_where_filter = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_filter'];
          }
          else
          {
              $sc_where_filter .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_filter'] . ")";
          }
      }
      $sc_where = "";
      if ('' != $sc_where_filter)
      {
          $sc_where = (isset($sc_where) && '' != $sc_where) ? $sc_where . ' and (' . $sc_where_filter . ')' : ' where ' . $sc_where_filter;
      }
      if (((isset($this->NM_ajax_opcao) && 'backup_line' == $this->NM_ajax_opcao) || (isset($this->NM_btn_navega) && 'N' == $this->NM_btn_navega)) && !$this->has_where_params && 'novo' != $this->nmgp_opcao)
      {
          $aNewWhereCond = array();
          if (null != $this->participante_id_)
          {
              $aNewWhereCond[] = "participante_id = " . $this->participante_id_;
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
          if ($this->app_is_initializing || $this->sc_teve_excl || $this->sc_teve_incl || (isset($_POST['master_nav']) && 'on' == $_POST['master_nav']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['total']))
          {
              $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where;
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
              $rt = $this->Db->Execute($nmgp_select);
              if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
              {
                  $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
                  exit;
              }
              $qt_geral_reg_form_participantes_rsvp_ar = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0;
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['total'] = $qt_geral_reg_form_participantes_rsvp_ar;
              $rt->Close();
          }
      if ((isset($_POST['master_nav']) && 'on' == $_POST['master_nav']) || $this->nmgp_opcao == "igual" || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['total']) || $this->sc_teve_excl || $this->sc_teve_incl)
      { 
          if (!$this->sc_teve_excl && !$this->sc_teve_incl) 
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] = 0; 
          } 
          if ($this->nmgp_opcao == "igual" && isset($this->NM_btn_navega) && 'S' == $this->NM_btn_navega && !empty($this->participante_id_))
          {
              $Reg_OK      = false;
              $Count_start = -1;
              $sc_order_by = "";
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              {
                  $Sel_Chave = "participante_id"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
              {
                  $Sel_Chave = "participante_id"; 
              }
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              {
                  $Sel_Chave = "participante_id"; 
              }
              else  
              {
                  $Sel_Chave = "participante_id"; 
              }
              $nmgp_select = "SELECT " . $Sel_Chave . " from " . $this->Ini->nm_tabela . $sc_where; 
              $sc_order_by = "part_id_evento, nome_pessoa";
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
                  if ($rt->fields[0] == $this->participante_id_)
                  { 
                      $Reg_OK = true;
                  }  
                  $Count_start++;
                  $rt->MoveNext();
              }  
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] = $Count_start;
              $rt->Close(); 
          }
      } 
      else 
      { 
          $qt_geral_reg_form_participantes_rsvp_ar = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['total'];
      } 
      if ($this->nmgp_opcao == "inicio" || $this->nmgp_opcao == "ordem") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] = 0; 
      } 
      if ($this->nmgp_opcao == "navpage" && ($this->nmgp_ordem - 1) <= $qt_geral_reg_form_participantes_rsvp_ar) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] = $this->nmgp_ordem - 1; 
      } 
      if ($this->nmgp_opcao == "avanca")  
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] += $this->sc_max_reg; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] > $qt_geral_reg_form_participantes_rsvp_ar)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] = $qt_geral_reg_form_participantes_rsvp_ar - $this->sc_max_reg; 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] < 0)
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] = 0; 
              }
          }
      } 
      if ($this->nmgp_opcao == "retorna") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] -= $this->sc_max_reg; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] < 0)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] = 0; 
          }
      } 
      if ($this->nmgp_opcao == "final") 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] = ($qt_geral_reg_form_participantes_rsvp_ar + 1) - $this->sc_max_reg; 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] < 0)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] = 0; 
          }
      } 
      }
      $Cmps_ord_def = array();
      $Cmps_ord_def[] = "part_id_evento";
      $Cmps_ord_def[] = "nome_pessoa";
      $Cmps_ord_def[] = "part_sexo";
      $sc_order_by  = "";
      $sc_order_by = "part_id_evento, nome_pessoa";
      $sc_order_by = str_replace("order by ", "", $sc_order_by);
      $sc_order_by = str_replace("ORDER BY ", "", trim($sc_order_by));
      if (!empty($sc_order_by))
      {
          $sc_order_by = " order by $sc_order_by "; 
      }
      if ($this->nmgp_opcao == "ordem" && in_array($this->nmgp_ordem, $Cmps_ord_def)) 
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_cmp'] != $this->nmgp_ordem)
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_cmp'] = $this->nmgp_ordem; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_ord'] = ' asc'; 
              switch ($this->nmgp_ordem) {
                  case "part_id_evento":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_ord'] = ' desc';
                      break;
                  case "part_dt_nasc":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_ord'] = ' desc';
                      break;
                  case "participante_id":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_ord'] = ' desc';
                      break;
                  case "part_validade_pass":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_ord'] = ' desc';
                      break;
                  case "part_cod_usuario":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_ord'] = ' desc';
                      break;
                  case "part_dt_cadastro":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_ord'] = ' desc';
                      break;
                  case "part_dt_alteracao":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_ord'] = ' desc';
                      break;
                  case "part_dt_alt_contato_rsvp":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_ord'] = ' desc';
                      break;
                  case "part_dt_alt_presenca":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_ord'] = ' desc';
                      break;
                  case "part_dt_solicit_especial":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_ord'] = ' desc';
                      break;
                  case "part_dt_programacao":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_ord'] = ' desc';
                      break;
                  case "part_dt_aereo":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_ord'] = ' desc';
                      break;
                  case "par_dt_hospedagem":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_ord'] = ' desc';
                      break;
                  case "part_dt_transfer":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_ord'] = ' desc';
                      break;
                  case "part_dt_opcionais":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_ord'] = ' desc';
                      break;
                  case "part_save_the_date":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_ord'] = ' desc';
                      break;
                  case "part_bloqueio_id":
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_ord'] = ' desc';
                      break;
                  default:
                      $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_ord'] = ' asc';
                      break;
              }
          }
          elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_ord'] == ' asc')
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_ord'] = ' desc'; 
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_ord'] = ' asc'; 
          }
      } 
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_cmp'])) 
      { 
          $sc_order_by = " order by " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_cmp'] . $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_ord']; 
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT participante_id, part_ativo, part_sexo, part_cpf, nome_pessoa, part_cpf_substituto, part_crnm, part_tipo, part_nome_cracha, part_id_evento, part_id_evento_publico, part_id_evento_regional, part_tipo_pessoa, part_substituido, part_substituto, part_cod_substituto, part_nome_substituto, part_sexo_substituto, part_cod_substituido, part_nome_substituido, part_grupo, part_clube, part_empresa, part_cep, part_departamento, part_cargo, part_logradouro, part_numero, part_complemento, part_bairro, part_cidade, part_uf, part_ddd_01, part_fone_01, part_ddd_02, part_fone_02, part_ddd_03, part_fone_03, part_ddd_fax, part_fax, part_ddd_celular_01, part_celeular_01, part_ddd_celular_02, part_celular_02, part_fone_internacional, part_email, str_replace (convert(char(10),part_dt_nasc,102), '.', '-') + ' ' + convert(char(8),part_dt_nasc,20), part_rg, part_passaporte, str_replace (convert(char(10),part_validade_pass,102), '.', '-') + ' ' + convert(char(8),part_validade_pass,20), part_passaporte_estrangeiro, part_ind_voucher, part_num_voucher, part_tam_camisa, part_tam_calcado, part_idioma, part_filiacao, part_pais, part_nome_secretaria, part_email_secretaria, part_cod_usuario, part_dt_cadastro, part_dt_alteracao, part_contato_rsvp, part_dt_alt_contato_rsvp, part_presenca, part_dt_alt_presenca, part_solicit_especial, part_dt_solicit_especial, part_programacao, part_dt_programacao, part_aereo, part_dt_aereo, part_hospedagem, par_dt_hospedagem, part_dt_transfer, part_opcionais, part_dt_opcionais, part_notas, part_confirm_viagem, part_convite, part_concluido, part_transfer, part_convite_enviado, part_destaque_negrito, part_atendimento, str_replace (convert(char(10),part_save_the_date,102), '.', '-') + ' ' + convert(char(8),part_save_the_date,20), part_arq_save, part_arq_convite, part_fumante, part_restricao_alimentar, part_acompanhado, part_acompanhado_hotel, part_acom_completo, part_acom_incompleto, part_incompleto, part_aereo_ok, part_bloqueio_id, part_hotel, part_anotacoes, guarda_cod_substituto, part_cpf_informado, part_cv_obs from " . $this->Ini->nm_tabela . $sc_where . $sc_order_by; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nmgp_select = "SELECT participante_id, part_ativo, part_sexo, part_cpf, nome_pessoa, part_cpf_substituto, part_crnm, part_tipo, part_nome_cracha, part_id_evento, part_id_evento_publico, part_id_evento_regional, part_tipo_pessoa, part_substituido, part_substituto, part_cod_substituto, part_nome_substituto, part_sexo_substituto, part_cod_substituido, part_nome_substituido, part_grupo, part_clube, part_empresa, part_cep, part_departamento, part_cargo, part_logradouro, part_numero, part_complemento, part_bairro, part_cidade, part_uf, part_ddd_01, part_fone_01, part_ddd_02, part_fone_02, part_ddd_03, part_fone_03, part_ddd_fax, part_fax, part_ddd_celular_01, part_celeular_01, part_ddd_celular_02, part_celular_02, part_fone_internacional, part_email, convert(char(23),part_dt_nasc,121), part_rg, part_passaporte, convert(char(23),part_validade_pass,121), part_passaporte_estrangeiro, part_ind_voucher, part_num_voucher, part_tam_camisa, part_tam_calcado, part_idioma, part_filiacao, part_pais, part_nome_secretaria, part_email_secretaria, part_cod_usuario, part_dt_cadastro, part_dt_alteracao, part_contato_rsvp, part_dt_alt_contato_rsvp, part_presenca, part_dt_alt_presenca, part_solicit_especial, part_dt_solicit_especial, part_programacao, part_dt_programacao, part_aereo, part_dt_aereo, part_hospedagem, par_dt_hospedagem, part_dt_transfer, part_opcionais, part_dt_opcionais, part_notas, part_confirm_viagem, part_convite, part_concluido, part_transfer, part_convite_enviado, part_destaque_negrito, part_atendimento, convert(char(23),part_save_the_date,121), part_arq_save, part_arq_convite, part_fumante, part_restricao_alimentar, part_acompanhado, part_acompanhado_hotel, part_acom_completo, part_acom_incompleto, part_incompleto, part_aereo_ok, part_bloqueio_id, part_hotel, part_anotacoes, guarda_cod_substituto, part_cpf_informado, part_cv_obs from " . $this->Ini->nm_tabela . $sc_where . $sc_order_by; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT participante_id, part_ativo, part_sexo, part_cpf, nome_pessoa, part_cpf_substituto, part_crnm, part_tipo, part_nome_cracha, part_id_evento, part_id_evento_publico, part_id_evento_regional, part_tipo_pessoa, part_substituido, part_substituto, part_cod_substituto, part_nome_substituto, part_sexo_substituto, part_cod_substituido, part_nome_substituido, part_grupo, part_clube, part_empresa, part_cep, part_departamento, part_cargo, part_logradouro, part_numero, part_complemento, part_bairro, part_cidade, part_uf, part_ddd_01, part_fone_01, part_ddd_02, part_fone_02, part_ddd_03, part_fone_03, part_ddd_fax, part_fax, part_ddd_celular_01, part_celeular_01, part_ddd_celular_02, part_celular_02, part_fone_internacional, part_email, part_dt_nasc, part_rg, part_passaporte, part_validade_pass, part_passaporte_estrangeiro, part_ind_voucher, part_num_voucher, part_tam_camisa, part_tam_calcado, part_idioma, part_filiacao, part_pais, part_nome_secretaria, part_email_secretaria, part_cod_usuario, TO_DATE(TO_CHAR(part_dt_cadastro, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), TO_DATE(TO_CHAR(part_dt_alteracao, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), part_contato_rsvp, TO_DATE(TO_CHAR(part_dt_alt_contato_rsvp, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), part_presenca, TO_DATE(TO_CHAR(part_dt_alt_presenca, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), part_solicit_especial, TO_DATE(TO_CHAR(part_dt_solicit_especial, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), part_programacao, TO_DATE(TO_CHAR(part_dt_programacao, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), part_aereo, TO_DATE(TO_CHAR(part_dt_aereo, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), part_hospedagem, TO_DATE(TO_CHAR(par_dt_hospedagem, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), TO_DATE(TO_CHAR(part_dt_transfer, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), part_opcionais, TO_DATE(TO_CHAR(part_dt_opcionais, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), part_notas, part_confirm_viagem, part_convite, part_concluido, part_transfer, part_convite_enviado, part_destaque_negrito, part_atendimento, part_save_the_date, part_arq_save, part_arq_convite, part_fumante, part_restricao_alimentar, part_acompanhado, part_acompanhado_hotel, part_acom_completo, part_acom_incompleto, part_incompleto, part_aereo_ok, part_bloqueio_id, part_hotel, part_anotacoes, guarda_cod_substituto, part_cpf_informado, part_cv_obs from " . $this->Ini->nm_tabela . $sc_where . $sc_order_by; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT participante_id, part_ativo, part_sexo, part_cpf, nome_pessoa, part_cpf_substituto, part_crnm, part_tipo, part_nome_cracha, part_id_evento, part_id_evento_publico, part_id_evento_regional, part_tipo_pessoa, part_substituido, part_substituto, part_cod_substituto, part_nome_substituto, part_sexo_substituto, part_cod_substituido, part_nome_substituido, part_grupo, part_clube, part_empresa, part_cep, part_departamento, part_cargo, part_logradouro, part_numero, part_complemento, part_bairro, part_cidade, part_uf, part_ddd_01, part_fone_01, part_ddd_02, part_fone_02, part_ddd_03, part_fone_03, part_ddd_fax, part_fax, part_ddd_celular_01, part_celeular_01, part_ddd_celular_02, part_celular_02, part_fone_internacional, part_email, EXTEND(part_dt_nasc, YEAR TO DAY), part_rg, part_passaporte, EXTEND(part_validade_pass, YEAR TO DAY), part_passaporte_estrangeiro, part_ind_voucher, part_num_voucher, part_tam_camisa, part_tam_calcado, part_idioma, part_filiacao, part_pais, part_nome_secretaria, part_email_secretaria, part_cod_usuario, part_dt_cadastro, part_dt_alteracao, part_contato_rsvp, part_dt_alt_contato_rsvp, part_presenca, part_dt_alt_presenca, part_solicit_especial, part_dt_solicit_especial, part_programacao, part_dt_programacao, part_aereo, part_dt_aereo, part_hospedagem, par_dt_hospedagem, part_dt_transfer, part_opcionais, part_dt_opcionais, part_notas, part_confirm_viagem, part_convite, part_concluido, part_transfer, part_convite_enviado, part_destaque_negrito, part_atendimento, EXTEND(part_save_the_date, YEAR TO DAY), part_arq_save, part_arq_convite, part_fumante, part_restricao_alimentar, part_acompanhado, part_acompanhado_hotel, part_acom_completo, part_acom_incompleto, part_incompleto, part_aereo_ok, part_bloqueio_id, part_hotel, part_anotacoes, guarda_cod_substituto, part_cpf_informado, part_cv_obs from " . $this->Ini->nm_tabela . $sc_where . $sc_order_by; 
      } 
      else 
      { 
          $nmgp_select = "SELECT participante_id, part_ativo, part_sexo, part_cpf, nome_pessoa, part_cpf_substituto, part_crnm, part_tipo, part_nome_cracha, part_id_evento, part_id_evento_publico, part_id_evento_regional, part_tipo_pessoa, part_substituido, part_substituto, part_cod_substituto, part_nome_substituto, part_sexo_substituto, part_cod_substituido, part_nome_substituido, part_grupo, part_clube, part_empresa, part_cep, part_departamento, part_cargo, part_logradouro, part_numero, part_complemento, part_bairro, part_cidade, part_uf, part_ddd_01, part_fone_01, part_ddd_02, part_fone_02, part_ddd_03, part_fone_03, part_ddd_fax, part_fax, part_ddd_celular_01, part_celeular_01, part_ddd_celular_02, part_celular_02, part_fone_internacional, part_email, part_dt_nasc, part_rg, part_passaporte, part_validade_pass, part_passaporte_estrangeiro, part_ind_voucher, part_num_voucher, part_tam_camisa, part_tam_calcado, part_idioma, part_filiacao, part_pais, part_nome_secretaria, part_email_secretaria, part_cod_usuario, part_dt_cadastro, part_dt_alteracao, part_contato_rsvp, part_dt_alt_contato_rsvp, part_presenca, part_dt_alt_presenca, part_solicit_especial, part_dt_solicit_especial, part_programacao, part_dt_programacao, part_aereo, part_dt_aereo, part_hospedagem, par_dt_hospedagem, part_dt_transfer, part_opcionais, part_dt_opcionais, part_notas, part_confirm_viagem, part_convite, part_concluido, part_transfer, part_convite_enviado, part_destaque_negrito, part_atendimento, part_save_the_date, part_arq_save, part_arq_convite, part_fumante, part_restricao_alimentar, part_acompanhado, part_acompanhado_hotel, part_acom_completo, part_acom_incompleto, part_incompleto, part_aereo_ok, part_bloqueio_id, part_hotel, part_anotacoes, guarda_cod_substituto, part_cpf_informado, part_cv_obs from " . $this->Ini->nm_tabela . $sc_where . $sc_order_by; 
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] == "R")
          { 
              $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
              $rs = $this->Db->Execute($nmgp_select) ; 
          } 
          else 
          { 
              if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, $this->sc_max_reg, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] . ")" ; 
                  $rs = $this->Db->SelectLimit($nmgp_select, $this->sc_max_reg, $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start']) ; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, $this->sc_max_reg, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] . ")" ; 
                  $rs = $this->Db->SelectLimit($nmgp_select, $this->sc_max_reg, $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start']) ; 
              } 
              elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, $this->sc_max_reg, " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] . ")" ; 
                  $rs = $this->Db->SelectLimit($nmgp_select, $this->sc_max_reg, $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start']) ; 
              } 
              else  
              { 
                  $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
                  $rs = $this->Db->Execute($nmgp_select) ; 
                  if (!$rs === false && !$rs->EOF) 
                  { 
                      $rs->Move($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start']) ;  
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
          if ($rs->EOF && !$this->proc_fast_search && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['empty_filter']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['empty_filter'])) 
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
              if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_filter']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['empty_filter'] = true;
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
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] == "R")
              { 
                  $this->sc_max_reg++;
              } 
              }
              $this->participante_id_ = $rs->fields[0] ; 
              $this->nmgp_dados_select['participante_id_'] = $this->participante_id_;
              $this->part_ativo_ = $rs->fields[1] ; 
              $this->nmgp_dados_select['part_ativo_'] = $this->part_ativo_;
              $this->part_sexo_ = $rs->fields[2] ; 
              $this->nmgp_dados_select['part_sexo_'] = $this->part_sexo_;
              $this->part_cpf_ = $rs->fields[3] ; 
              $this->nmgp_dados_select['part_cpf_'] = $this->part_cpf_;
              $this->nome_pessoa_ = $rs->fields[4] ; 
              $this->nmgp_dados_select['nome_pessoa_'] = $this->nome_pessoa_;
              $this->part_cpf_substituto_ = $rs->fields[5] ; 
              $this->nmgp_dados_select['part_cpf_substituto_'] = $this->part_cpf_substituto_;
              $this->part_crnm_ = $rs->fields[6] ; 
              $this->nmgp_dados_select['part_crnm_'] = $this->part_crnm_;
              $this->part_tipo_ = $rs->fields[7] ; 
              $this->nmgp_dados_select['part_tipo_'] = $this->part_tipo_;
              $this->part_nome_cracha_ = $rs->fields[8] ; 
              $this->nmgp_dados_select['part_nome_cracha_'] = $this->part_nome_cracha_;
              $this->part_id_evento_ = $rs->fields[9] ; 
              $this->nmgp_dados_select['part_id_evento_'] = $this->part_id_evento_;
              $this->part_id_evento_publico_ = $rs->fields[10] ; 
              $this->nmgp_dados_select['part_id_evento_publico_'] = $this->part_id_evento_publico_;
              $this->part_id_evento_regional_ = $rs->fields[11] ; 
              $this->nmgp_dados_select['part_id_evento_regional_'] = $this->part_id_evento_regional_;
              $this->part_tipo_pessoa_ = $rs->fields[12] ; 
              $this->nmgp_dados_select['part_tipo_pessoa_'] = $this->part_tipo_pessoa_;
              $this->part_substituido_ = $rs->fields[13] ; 
              $this->nmgp_dados_select['part_substituido_'] = $this->part_substituido_;
              $this->part_substituto_ = $rs->fields[14] ; 
              $this->nmgp_dados_select['part_substituto_'] = $this->part_substituto_;
              $this->part_cod_substituto_ = $rs->fields[15] ; 
              $this->nmgp_dados_select['part_cod_substituto_'] = $this->part_cod_substituto_;
              $this->part_nome_substituto_ = $rs->fields[16] ; 
              $this->nmgp_dados_select['part_nome_substituto_'] = $this->part_nome_substituto_;
              $this->part_sexo_substituto_ = $rs->fields[17] ; 
              $this->nmgp_dados_select['part_sexo_substituto_'] = $this->part_sexo_substituto_;
              $this->part_cod_substituido_ = $rs->fields[18] ; 
              $this->nmgp_dados_select['part_cod_substituido_'] = $this->part_cod_substituido_;
              $this->part_nome_substituido_ = $rs->fields[19] ; 
              $this->nmgp_dados_select['part_nome_substituido_'] = $this->part_nome_substituido_;
              $this->part_grupo_ = $rs->fields[20] ; 
              $this->nmgp_dados_select['part_grupo_'] = $this->part_grupo_;
              $this->part_clube_ = $rs->fields[21] ; 
              $this->nmgp_dados_select['part_clube_'] = $this->part_clube_;
              $this->part_empresa_ = $rs->fields[22] ; 
              $this->nmgp_dados_select['part_empresa_'] = $this->part_empresa_;
              $this->part_cep_ = $rs->fields[23] ; 
              $this->nmgp_dados_select['part_cep_'] = $this->part_cep_;
              $this->part_departamento_ = $rs->fields[24] ; 
              $this->nmgp_dados_select['part_departamento_'] = $this->part_departamento_;
              $this->part_cargo_ = $rs->fields[25] ; 
              $this->nmgp_dados_select['part_cargo_'] = $this->part_cargo_;
              $this->part_logradouro_ = $rs->fields[26] ; 
              $this->nmgp_dados_select['part_logradouro_'] = $this->part_logradouro_;
              $this->part_numero_ = $rs->fields[27] ; 
              $this->nmgp_dados_select['part_numero_'] = $this->part_numero_;
              $this->part_complemento_ = $rs->fields[28] ; 
              $this->nmgp_dados_select['part_complemento_'] = $this->part_complemento_;
              $this->part_bairro_ = $rs->fields[29] ; 
              $this->nmgp_dados_select['part_bairro_'] = $this->part_bairro_;
              $this->part_cidade_ = $rs->fields[30] ; 
              $this->nmgp_dados_select['part_cidade_'] = $this->part_cidade_;
              $this->part_uf_ = $rs->fields[31] ; 
              $this->nmgp_dados_select['part_uf_'] = $this->part_uf_;
              $this->part_ddd_01_ = $rs->fields[32] ; 
              $this->nmgp_dados_select['part_ddd_01_'] = $this->part_ddd_01_;
              $this->part_fone_01_ = $rs->fields[33] ; 
              $this->nmgp_dados_select['part_fone_01_'] = $this->part_fone_01_;
              $this->part_ddd_02_ = $rs->fields[34] ; 
              $this->nmgp_dados_select['part_ddd_02_'] = $this->part_ddd_02_;
              $this->part_fone_02_ = $rs->fields[35] ; 
              $this->nmgp_dados_select['part_fone_02_'] = $this->part_fone_02_;
              $this->part_ddd_03_ = $rs->fields[36] ; 
              $this->nmgp_dados_select['part_ddd_03_'] = $this->part_ddd_03_;
              $this->part_fone_03_ = $rs->fields[37] ; 
              $this->nmgp_dados_select['part_fone_03_'] = $this->part_fone_03_;
              $this->part_ddd_fax_ = $rs->fields[38] ; 
              $this->nmgp_dados_select['part_ddd_fax_'] = $this->part_ddd_fax_;
              $this->part_fax_ = $rs->fields[39] ; 
              $this->nmgp_dados_select['part_fax_'] = $this->part_fax_;
              $this->part_ddd_celular_01_ = $rs->fields[40] ; 
              $this->nmgp_dados_select['part_ddd_celular_01_'] = $this->part_ddd_celular_01_;
              $this->part_celeular_01_ = $rs->fields[41] ; 
              $this->nmgp_dados_select['part_celeular_01_'] = $this->part_celeular_01_;
              $this->part_ddd_celular_02_ = $rs->fields[42] ; 
              $this->nmgp_dados_select['part_ddd_celular_02_'] = $this->part_ddd_celular_02_;
              $this->part_celular_02_ = $rs->fields[43] ; 
              $this->nmgp_dados_select['part_celular_02_'] = $this->part_celular_02_;
              $this->part_fone_internacional_ = $rs->fields[44] ; 
              $this->nmgp_dados_select['part_fone_internacional_'] = $this->part_fone_internacional_;
              $this->part_email_ = $rs->fields[45] ; 
              $this->nmgp_dados_select['part_email_'] = $this->part_email_;
              $this->part_dt_nasc_ = $rs->fields[46] ; 
              $this->nmgp_dados_select['part_dt_nasc_'] = $this->part_dt_nasc_;
              $this->part_rg_ = $rs->fields[47] ; 
              $this->nmgp_dados_select['part_rg_'] = $this->part_rg_;
              $this->part_passaporte_ = $rs->fields[48] ; 
              $this->nmgp_dados_select['part_passaporte_'] = $this->part_passaporte_;
              $this->part_validade_pass_ = $rs->fields[49] ; 
              $this->nmgp_dados_select['part_validade_pass_'] = $this->part_validade_pass_;
              $this->part_passaporte_estrangeiro_ = $rs->fields[50] ; 
              $this->nmgp_dados_select['part_passaporte_estrangeiro_'] = $this->part_passaporte_estrangeiro_;
              $this->part_ind_voucher_ = $rs->fields[51] ; 
              $this->nmgp_dados_select['part_ind_voucher_'] = $this->part_ind_voucher_;
              $this->part_num_voucher_ = $rs->fields[52] ; 
              $this->nmgp_dados_select['part_num_voucher_'] = $this->part_num_voucher_;
              $this->part_tam_camisa_ = $rs->fields[53] ; 
              $this->nmgp_dados_select['part_tam_camisa_'] = $this->part_tam_camisa_;
              $this->part_tam_calcado_ = $rs->fields[54] ; 
              $this->nmgp_dados_select['part_tam_calcado_'] = $this->part_tam_calcado_;
              $this->part_idioma_ = $rs->fields[55] ; 
              $this->nmgp_dados_select['part_idioma_'] = $this->part_idioma_;
              $this->part_filiacao_ = $rs->fields[56] ; 
              $this->nmgp_dados_select['part_filiacao_'] = $this->part_filiacao_;
              $this->part_pais_ = $rs->fields[57] ; 
              $this->nmgp_dados_select['part_pais_'] = $this->part_pais_;
              $this->part_nome_secretaria_ = $rs->fields[58] ; 
              $this->nmgp_dados_select['part_nome_secretaria_'] = $this->part_nome_secretaria_;
              $this->part_email_secretaria_ = $rs->fields[59] ; 
              $this->nmgp_dados_select['part_email_secretaria_'] = $this->part_email_secretaria_;
              $this->part_cod_usuario_ = $rs->fields[60] ; 
              $this->nmgp_dados_select['part_cod_usuario_'] = $this->part_cod_usuario_;
              $this->part_dt_cadastro_ = $rs->fields[61] ; 
              if (substr($this->part_dt_cadastro_, 10, 1) == "-") 
              { 
                 $this->part_dt_cadastro_ = substr($this->part_dt_cadastro_, 0, 10) . " " . substr($this->part_dt_cadastro_, 11);
              } 
              if (substr($this->part_dt_cadastro_, 13, 1) == ".") 
              { 
                 $this->part_dt_cadastro_ = substr($this->part_dt_cadastro_, 0, 13) . ":" . substr($this->part_dt_cadastro_, 14, 2) . ":" . substr($this->part_dt_cadastro_, 17);
              } 
              $this->nmgp_dados_select['part_dt_cadastro_'] = $this->part_dt_cadastro_;
              $this->part_dt_alteracao_ = $rs->fields[62] ; 
              if (substr($this->part_dt_alteracao_, 10, 1) == "-") 
              { 
                 $this->part_dt_alteracao_ = substr($this->part_dt_alteracao_, 0, 10) . " " . substr($this->part_dt_alteracao_, 11);
              } 
              if (substr($this->part_dt_alteracao_, 13, 1) == ".") 
              { 
                 $this->part_dt_alteracao_ = substr($this->part_dt_alteracao_, 0, 13) . ":" . substr($this->part_dt_alteracao_, 14, 2) . ":" . substr($this->part_dt_alteracao_, 17);
              } 
              $this->nmgp_dados_select['part_dt_alteracao_'] = $this->part_dt_alteracao_;
              $this->part_contato_rsvp_ = $rs->fields[63] ; 
              $this->nmgp_dados_select['part_contato_rsvp_'] = $this->part_contato_rsvp_;
              $this->part_dt_alt_contato_rsvp_ = $rs->fields[64] ; 
              if (substr($this->part_dt_alt_contato_rsvp_, 10, 1) == "-") 
              { 
                 $this->part_dt_alt_contato_rsvp_ = substr($this->part_dt_alt_contato_rsvp_, 0, 10) . " " . substr($this->part_dt_alt_contato_rsvp_, 11);
              } 
              if (substr($this->part_dt_alt_contato_rsvp_, 13, 1) == ".") 
              { 
                 $this->part_dt_alt_contato_rsvp_ = substr($this->part_dt_alt_contato_rsvp_, 0, 13) . ":" . substr($this->part_dt_alt_contato_rsvp_, 14, 2) . ":" . substr($this->part_dt_alt_contato_rsvp_, 17);
              } 
              $this->nmgp_dados_select['part_dt_alt_contato_rsvp_'] = $this->part_dt_alt_contato_rsvp_;
              $this->part_presenca_ = $rs->fields[65] ; 
              $this->nmgp_dados_select['part_presenca_'] = $this->part_presenca_;
              $this->part_dt_alt_presenca_ = $rs->fields[66] ; 
              if (substr($this->part_dt_alt_presenca_, 10, 1) == "-") 
              { 
                 $this->part_dt_alt_presenca_ = substr($this->part_dt_alt_presenca_, 0, 10) . " " . substr($this->part_dt_alt_presenca_, 11);
              } 
              if (substr($this->part_dt_alt_presenca_, 13, 1) == ".") 
              { 
                 $this->part_dt_alt_presenca_ = substr($this->part_dt_alt_presenca_, 0, 13) . ":" . substr($this->part_dt_alt_presenca_, 14, 2) . ":" . substr($this->part_dt_alt_presenca_, 17);
              } 
              $this->nmgp_dados_select['part_dt_alt_presenca_'] = $this->part_dt_alt_presenca_;
              $this->part_solicit_especial_ = $rs->fields[67] ; 
              $this->nmgp_dados_select['part_solicit_especial_'] = $this->part_solicit_especial_;
              $this->part_dt_solicit_especial_ = $rs->fields[68] ; 
              if (substr($this->part_dt_solicit_especial_, 10, 1) == "-") 
              { 
                 $this->part_dt_solicit_especial_ = substr($this->part_dt_solicit_especial_, 0, 10) . " " . substr($this->part_dt_solicit_especial_, 11);
              } 
              if (substr($this->part_dt_solicit_especial_, 13, 1) == ".") 
              { 
                 $this->part_dt_solicit_especial_ = substr($this->part_dt_solicit_especial_, 0, 13) . ":" . substr($this->part_dt_solicit_especial_, 14, 2) . ":" . substr($this->part_dt_solicit_especial_, 17);
              } 
              $this->nmgp_dados_select['part_dt_solicit_especial_'] = $this->part_dt_solicit_especial_;
              $this->part_programacao_ = $rs->fields[69] ; 
              $this->nmgp_dados_select['part_programacao_'] = $this->part_programacao_;
              $this->part_dt_programacao_ = $rs->fields[70] ; 
              if (substr($this->part_dt_programacao_, 10, 1) == "-") 
              { 
                 $this->part_dt_programacao_ = substr($this->part_dt_programacao_, 0, 10) . " " . substr($this->part_dt_programacao_, 11);
              } 
              if (substr($this->part_dt_programacao_, 13, 1) == ".") 
              { 
                 $this->part_dt_programacao_ = substr($this->part_dt_programacao_, 0, 13) . ":" . substr($this->part_dt_programacao_, 14, 2) . ":" . substr($this->part_dt_programacao_, 17);
              } 
              $this->nmgp_dados_select['part_dt_programacao_'] = $this->part_dt_programacao_;
              $this->part_aereo_ = $rs->fields[71] ; 
              $this->nmgp_dados_select['part_aereo_'] = $this->part_aereo_;
              $this->part_dt_aereo_ = $rs->fields[72] ; 
              if (substr($this->part_dt_aereo_, 10, 1) == "-") 
              { 
                 $this->part_dt_aereo_ = substr($this->part_dt_aereo_, 0, 10) . " " . substr($this->part_dt_aereo_, 11);
              } 
              if (substr($this->part_dt_aereo_, 13, 1) == ".") 
              { 
                 $this->part_dt_aereo_ = substr($this->part_dt_aereo_, 0, 13) . ":" . substr($this->part_dt_aereo_, 14, 2) . ":" . substr($this->part_dt_aereo_, 17);
              } 
              $this->nmgp_dados_select['part_dt_aereo_'] = $this->part_dt_aereo_;
              $this->part_hospedagem_ = $rs->fields[73] ; 
              $this->nmgp_dados_select['part_hospedagem_'] = $this->part_hospedagem_;
              $this->par_dt_hospedagem_ = $rs->fields[74] ; 
              if (substr($this->par_dt_hospedagem_, 10, 1) == "-") 
              { 
                 $this->par_dt_hospedagem_ = substr($this->par_dt_hospedagem_, 0, 10) . " " . substr($this->par_dt_hospedagem_, 11);
              } 
              if (substr($this->par_dt_hospedagem_, 13, 1) == ".") 
              { 
                 $this->par_dt_hospedagem_ = substr($this->par_dt_hospedagem_, 0, 13) . ":" . substr($this->par_dt_hospedagem_, 14, 2) . ":" . substr($this->par_dt_hospedagem_, 17);
              } 
              $this->nmgp_dados_select['par_dt_hospedagem_'] = $this->par_dt_hospedagem_;
              $this->part_dt_transfer_ = $rs->fields[75] ; 
              if (substr($this->part_dt_transfer_, 10, 1) == "-") 
              { 
                 $this->part_dt_transfer_ = substr($this->part_dt_transfer_, 0, 10) . " " . substr($this->part_dt_transfer_, 11);
              } 
              if (substr($this->part_dt_transfer_, 13, 1) == ".") 
              { 
                 $this->part_dt_transfer_ = substr($this->part_dt_transfer_, 0, 13) . ":" . substr($this->part_dt_transfer_, 14, 2) . ":" . substr($this->part_dt_transfer_, 17);
              } 
              $this->nmgp_dados_select['part_dt_transfer_'] = $this->part_dt_transfer_;
              $this->part_opcionais_ = $rs->fields[76] ; 
              $this->nmgp_dados_select['part_opcionais_'] = $this->part_opcionais_;
              $this->part_dt_opcionais_ = $rs->fields[77] ; 
              if (substr($this->part_dt_opcionais_, 10, 1) == "-") 
              { 
                 $this->part_dt_opcionais_ = substr($this->part_dt_opcionais_, 0, 10) . " " . substr($this->part_dt_opcionais_, 11);
              } 
              if (substr($this->part_dt_opcionais_, 13, 1) == ".") 
              { 
                 $this->part_dt_opcionais_ = substr($this->part_dt_opcionais_, 0, 13) . ":" . substr($this->part_dt_opcionais_, 14, 2) . ":" . substr($this->part_dt_opcionais_, 17);
              } 
              $this->nmgp_dados_select['part_dt_opcionais_'] = $this->part_dt_opcionais_;
              $this->part_notas_ = $rs->fields[78] ; 
              $this->nmgp_dados_select['part_notas_'] = $this->part_notas_;
              $this->part_confirm_viagem_ = $rs->fields[79] ; 
              $this->nmgp_dados_select['part_confirm_viagem_'] = $this->part_confirm_viagem_;
              $this->part_convite_ = $rs->fields[80] ; 
              $this->nmgp_dados_select['part_convite_'] = $this->part_convite_;
              $this->part_concluido_ = $rs->fields[81] ; 
              $this->nmgp_dados_select['part_concluido_'] = $this->part_concluido_;
              $this->part_transfer_ = $rs->fields[82] ; 
              $this->nmgp_dados_select['part_transfer_'] = $this->part_transfer_;
              $this->part_convite_enviado_ = $rs->fields[83] ; 
              $this->nmgp_dados_select['part_convite_enviado_'] = $this->part_convite_enviado_;
              $this->part_destaque_negrito_ = $rs->fields[84] ; 
              $this->nmgp_dados_select['part_destaque_negrito_'] = $this->part_destaque_negrito_;
              $this->part_atendimento_ = $rs->fields[85] ; 
              $this->nmgp_dados_select['part_atendimento_'] = $this->part_atendimento_;
              $this->part_save_the_date_ = $rs->fields[86] ; 
              $this->nmgp_dados_select['part_save_the_date_'] = $this->part_save_the_date_;
              $this->part_arq_save_ = $rs->fields[87] ; 
              $this->nmgp_dados_select['part_arq_save_'] = $this->part_arq_save_;
              $this->part_arq_convite_ = $rs->fields[88] ; 
              $this->nmgp_dados_select['part_arq_convite_'] = $this->part_arq_convite_;
              $this->part_fumante_ = $rs->fields[89] ; 
              $this->nmgp_dados_select['part_fumante_'] = $this->part_fumante_;
              $this->part_restricao_alimentar_ = $rs->fields[90] ; 
              $this->nmgp_dados_select['part_restricao_alimentar_'] = $this->part_restricao_alimentar_;
              $this->part_acompanhado_ = $rs->fields[91] ; 
              $this->nmgp_dados_select['part_acompanhado_'] = $this->part_acompanhado_;
              $this->part_acompanhado_hotel_ = $rs->fields[92] ; 
              $this->nmgp_dados_select['part_acompanhado_hotel_'] = $this->part_acompanhado_hotel_;
              $this->part_acom_completo_ = $rs->fields[93] ; 
              $this->nmgp_dados_select['part_acom_completo_'] = $this->part_acom_completo_;
              $this->part_acom_incompleto_ = $rs->fields[94] ; 
              $this->nmgp_dados_select['part_acom_incompleto_'] = $this->part_acom_incompleto_;
              $this->part_incompleto_ = $rs->fields[95] ; 
              $this->nmgp_dados_select['part_incompleto_'] = $this->part_incompleto_;
              $this->part_aereo_ok_ = $rs->fields[96] ; 
              $this->nmgp_dados_select['part_aereo_ok_'] = $this->part_aereo_ok_;
              $this->part_bloqueio_id_ = $rs->fields[97] ; 
              $this->nmgp_dados_select['part_bloqueio_id_'] = $this->part_bloqueio_id_;
              $this->part_hotel_ = $rs->fields[98] ; 
              $this->nmgp_dados_select['part_hotel_'] = $this->part_hotel_;
              $this->part_anotacoes_ = $rs->fields[99] ; 
              $this->nmgp_dados_select['part_anotacoes_'] = $this->part_anotacoes_;
              $this->guarda_cod_substituto_ = $rs->fields[100] ; 
              $this->nmgp_dados_select['guarda_cod_substituto_'] = $this->guarda_cod_substituto_;
              $this->part_cpf_informado_ = $rs->fields[101] ; 
              $this->nmgp_dados_select['part_cpf_informado_'] = $this->part_cpf_informado_;
              $this->part_cv_obs_ = $rs->fields[102] ; 
              $this->nmgp_dados_select['part_cv_obs_'] = $this->part_cv_obs_;
              $GLOBALS["NM_ERRO_IBASE"] = 0; 
              $this->participante_id_ = (string)$this->participante_id_; 
              $this->part_id_evento_ = (string)$this->part_id_evento_; 
              $this->part_id_evento_publico_ = (string)$this->part_id_evento_publico_; 
              $this->part_id_evento_regional_ = (string)$this->part_id_evento_regional_; 
              $this->part_cod_usuario_ = (string)$this->part_cod_usuario_; 
              $this->part_bloqueio_id_ = (string)$this->part_bloqueio_id_; 
              if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['parms'])) 
              { 
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['parms'] = "participante_id_?#?$this->participante_id_?@?";
              } 
              $this->nm_proc_onload_record($sc_seq_vert);
              $this->storeRecordState($sc_seq_vert);
//
//-- 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dados_select'][$sc_seq_vert] = $this->nmgp_dados_select;
              $this->nm_guardar_campos();
              $this->nm_formatar_campos();
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_id_evento_'] =  $this->part_id_evento_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cpf_'] =  $this->part_cpf_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['nome_pessoa_'] =  $this->nome_pessoa_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_sexo_'] =  $this->part_sexo_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_id_evento_publico_'] =  $this->part_id_evento_publico_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_id_evento_regional_'] =  $this->part_id_evento_regional_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_grupo_'] =  $this->part_grupo_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_clube_'] =  $this->part_clube_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_empresa_'] =  $this->part_empresa_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_uf_'] =  $this->part_uf_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ddd_celular_01_'] =  $this->part_ddd_celular_01_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_celeular_01_'] =  $this->part_celeular_01_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_nasc_'] =  $this->part_dt_nasc_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_tam_camisa_'] =  $this->part_tam_camisa_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_tam_calcado_'] =  $this->part_tam_calcado_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['participante_id_'] =  $this->participante_id_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ativo_'] =  $this->part_ativo_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cpf_substituto_'] =  $this->part_cpf_substituto_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_crnm_'] =  $this->part_crnm_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_tipo_'] =  $this->part_tipo_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_nome_cracha_'] =  $this->part_nome_cracha_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_tipo_pessoa_'] =  $this->part_tipo_pessoa_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_substituido_'] =  $this->part_substituido_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_substituto_'] =  $this->part_substituto_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cod_substituto_'] =  $this->part_cod_substituto_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_nome_substituto_'] =  $this->part_nome_substituto_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_sexo_substituto_'] =  $this->part_sexo_substituto_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cod_substituido_'] =  $this->part_cod_substituido_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_nome_substituido_'] =  $this->part_nome_substituido_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cep_'] =  $this->part_cep_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_departamento_'] =  $this->part_departamento_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cargo_'] =  $this->part_cargo_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_logradouro_'] =  $this->part_logradouro_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_numero_'] =  $this->part_numero_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_complemento_'] =  $this->part_complemento_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_bairro_'] =  $this->part_bairro_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cidade_'] =  $this->part_cidade_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ddd_01_'] =  $this->part_ddd_01_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_fone_01_'] =  $this->part_fone_01_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ddd_02_'] =  $this->part_ddd_02_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_fone_02_'] =  $this->part_fone_02_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ddd_03_'] =  $this->part_ddd_03_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_fone_03_'] =  $this->part_fone_03_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ddd_fax_'] =  $this->part_ddd_fax_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_fax_'] =  $this->part_fax_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ddd_celular_02_'] =  $this->part_ddd_celular_02_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_celular_02_'] =  $this->part_celular_02_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_fone_internacional_'] =  $this->part_fone_internacional_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_email_'] =  $this->part_email_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_rg_'] =  $this->part_rg_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_passaporte_'] =  $this->part_passaporte_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_validade_pass_'] =  $this->part_validade_pass_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_passaporte_estrangeiro_'] =  $this->part_passaporte_estrangeiro_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ind_voucher_'] =  $this->part_ind_voucher_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_num_voucher_'] =  $this->part_num_voucher_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_idioma_'] =  $this->part_idioma_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_filiacao_'] =  $this->part_filiacao_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_pais_'] =  $this->part_pais_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_nome_secretaria_'] =  $this->part_nome_secretaria_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_email_secretaria_'] =  $this->part_email_secretaria_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cod_usuario_'] =  $this->part_cod_usuario_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_cadastro_'] =  $this->part_dt_cadastro_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_cadastro__hora'] =  $this->part_dt_cadastro__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_alteracao_'] =  $this->part_dt_alteracao_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_alteracao__hora'] =  $this->part_dt_alteracao__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_contato_rsvp_'] =  $this->part_contato_rsvp_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_alt_contato_rsvp_'] =  $this->part_dt_alt_contato_rsvp_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_alt_contato_rsvp__hora'] =  $this->part_dt_alt_contato_rsvp__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_presenca_'] =  $this->part_presenca_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_alt_presenca_'] =  $this->part_dt_alt_presenca_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_alt_presenca__hora'] =  $this->part_dt_alt_presenca__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_solicit_especial_'] =  $this->part_solicit_especial_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_solicit_especial_'] =  $this->part_dt_solicit_especial_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_solicit_especial__hora'] =  $this->part_dt_solicit_especial__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_programacao_'] =  $this->part_programacao_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_programacao_'] =  $this->part_dt_programacao_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_programacao__hora'] =  $this->part_dt_programacao__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_aereo_'] =  $this->part_aereo_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_aereo_'] =  $this->part_dt_aereo_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_aereo__hora'] =  $this->part_dt_aereo__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_hospedagem_'] =  $this->part_hospedagem_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['par_dt_hospedagem_'] =  $this->par_dt_hospedagem_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['par_dt_hospedagem__hora'] =  $this->par_dt_hospedagem__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_transfer_'] =  $this->part_dt_transfer_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_transfer__hora'] =  $this->part_dt_transfer__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_opcionais_'] =  $this->part_opcionais_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_opcionais_'] =  $this->part_dt_opcionais_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_opcionais__hora'] =  $this->part_dt_opcionais__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_notas_'] =  $this->part_notas_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_confirm_viagem_'] =  $this->part_confirm_viagem_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_convite_'] =  $this->part_convite_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_concluido_'] =  $this->part_concluido_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_transfer_'] =  $this->part_transfer_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_convite_enviado_'] =  $this->part_convite_enviado_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_destaque_negrito_'] =  $this->part_destaque_negrito_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_atendimento_'] =  $this->part_atendimento_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_save_the_date_'] =  $this->part_save_the_date_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_arq_save_'] =  $this->part_arq_save_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_arq_convite_'] =  $this->part_arq_convite_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_fumante_'] =  $this->part_fumante_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_restricao_alimentar_'] =  $this->part_restricao_alimentar_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_acompanhado_'] =  $this->part_acompanhado_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_acompanhado_hotel_'] =  $this->part_acompanhado_hotel_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_acom_completo_'] =  $this->part_acom_completo_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_acom_incompleto_'] =  $this->part_acom_incompleto_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_incompleto_'] =  $this->part_incompleto_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_aereo_ok_'] =  $this->part_aereo_ok_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_bloqueio_id_'] =  $this->part_bloqueio_id_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_hotel_'] =  $this->part_hotel_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_anotacoes_'] =  $this->part_anotacoes_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['guarda_cod_substituto_'] =  $this->guarda_cod_substituto_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cpf_informado_'] =  $this->part_cpf_informado_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cv_obs_'] =  $this->part_cv_obs_; 
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
          ksort ($this->form_vert_form_participantes_rsvp_ar); 
          $rs->Close(); 
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_qtd'] = $sc_seq_vert + $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] - 1;
          if ('total' == $this->form_paginacao)
          {
              $this->NM_ajax_info['navSummary']['reg_ini'] = 1; 
              $this->NM_ajax_info['navSummary']['reg_qtd'] = $this->sc_max_reg; 
              $this->NM_ajax_info['navSummary']['reg_tot'] = $this->sc_max_reg; 
          }
          else
          {
              $this->NM_ajax_info['navSummary']['reg_ini'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] + 1; 
              $this->NM_ajax_info['navSummary']['reg_qtd'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_qtd']; 
              $this->NM_ajax_info['navSummary']['reg_tot'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['total'] + 1; 
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
              $this->Nav_permite_ret = 0 != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'];
              $this->Nav_permite_ava = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] < (($qt_geral_reg_form_participantes_rsvp_ar + 1) - $this->sc_max_reg);
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['opcao'] = '';
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
          elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_multi']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_multi']) 
          { 
          } 
          elseif ($this->Embutida_form) 
          { 
              $this->sc_max_reg_incl = 0; 
          } 
          while ($sc_seq_vert <= $this->sc_max_reg_incl) 
          { 
              $this->part_sexo_ = "";  
              $this->part_cpf_ = "";  
              $this->nome_pessoa_ = "";  
              $this->part_id_evento_ = "";  
              $this->part_id_evento_publico_ = "";  
              $this->part_id_evento_regional_ = "";  
              $this->part_grupo_ = "";  
              $this->part_clube_ = "";  
              $this->part_empresa_ = "";  
              $this->part_uf_ = "";  
              $this->part_ddd_celular_01_ = "";  
              $this->part_celeular_01_ = "";  
              $this->part_dt_nasc_ = "";  
              $this->part_tam_camisa_ = "";  
              $this->part_tam_calcado_ = "";  
              $this->nm_proc_onload_record($sc_seq_vert);
              if (($this->Embutida_form || $this->Embutida_multi) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['foreign_key']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['foreign_key']))
              {
                  foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['foreign_key'] as $sFKName => $sFKValue)
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
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_id_evento_'] =  $this->part_id_evento_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cpf_'] =  $this->part_cpf_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['nome_pessoa_'] =  $this->nome_pessoa_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_sexo_'] =  $this->part_sexo_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_id_evento_publico_'] =  $this->part_id_evento_publico_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_id_evento_regional_'] =  $this->part_id_evento_regional_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_grupo_'] =  $this->part_grupo_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_clube_'] =  $this->part_clube_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_empresa_'] =  $this->part_empresa_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_uf_'] =  $this->part_uf_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ddd_celular_01_'] =  $this->part_ddd_celular_01_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_celeular_01_'] =  $this->part_celeular_01_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_nasc_'] =  $this->part_dt_nasc_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_tam_camisa_'] =  $this->part_tam_camisa_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_tam_calcado_'] =  $this->part_tam_calcado_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['participante_id_'] =  $this->participante_id_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ativo_'] =  $this->part_ativo_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cpf_substituto_'] =  $this->part_cpf_substituto_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_crnm_'] =  $this->part_crnm_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_tipo_'] =  $this->part_tipo_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_nome_cracha_'] =  $this->part_nome_cracha_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_tipo_pessoa_'] =  $this->part_tipo_pessoa_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_substituido_'] =  $this->part_substituido_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_substituto_'] =  $this->part_substituto_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cod_substituto_'] =  $this->part_cod_substituto_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_nome_substituto_'] =  $this->part_nome_substituto_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_sexo_substituto_'] =  $this->part_sexo_substituto_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cod_substituido_'] =  $this->part_cod_substituido_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_nome_substituido_'] =  $this->part_nome_substituido_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cep_'] =  $this->part_cep_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_departamento_'] =  $this->part_departamento_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cargo_'] =  $this->part_cargo_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_logradouro_'] =  $this->part_logradouro_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_numero_'] =  $this->part_numero_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_complemento_'] =  $this->part_complemento_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_bairro_'] =  $this->part_bairro_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cidade_'] =  $this->part_cidade_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ddd_01_'] =  $this->part_ddd_01_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_fone_01_'] =  $this->part_fone_01_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ddd_02_'] =  $this->part_ddd_02_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_fone_02_'] =  $this->part_fone_02_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ddd_03_'] =  $this->part_ddd_03_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_fone_03_'] =  $this->part_fone_03_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ddd_fax_'] =  $this->part_ddd_fax_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_fax_'] =  $this->part_fax_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ddd_celular_02_'] =  $this->part_ddd_celular_02_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_celular_02_'] =  $this->part_celular_02_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_fone_internacional_'] =  $this->part_fone_internacional_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_email_'] =  $this->part_email_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_rg_'] =  $this->part_rg_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_passaporte_'] =  $this->part_passaporte_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_validade_pass_'] =  $this->part_validade_pass_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_passaporte_estrangeiro_'] =  $this->part_passaporte_estrangeiro_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ind_voucher_'] =  $this->part_ind_voucher_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_num_voucher_'] =  $this->part_num_voucher_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_idioma_'] =  $this->part_idioma_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_filiacao_'] =  $this->part_filiacao_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_pais_'] =  $this->part_pais_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_nome_secretaria_'] =  $this->part_nome_secretaria_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_email_secretaria_'] =  $this->part_email_secretaria_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cod_usuario_'] =  $this->part_cod_usuario_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_cadastro_'] =  $this->part_dt_cadastro_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_cadastro__hora'] =  $this->part_dt_cadastro__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_alteracao_'] =  $this->part_dt_alteracao_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_alteracao__hora'] =  $this->part_dt_alteracao__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_contato_rsvp_'] =  $this->part_contato_rsvp_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_alt_contato_rsvp_'] =  $this->part_dt_alt_contato_rsvp_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_alt_contato_rsvp__hora'] =  $this->part_dt_alt_contato_rsvp__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_presenca_'] =  $this->part_presenca_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_alt_presenca_'] =  $this->part_dt_alt_presenca_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_alt_presenca__hora'] =  $this->part_dt_alt_presenca__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_solicit_especial_'] =  $this->part_solicit_especial_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_solicit_especial_'] =  $this->part_dt_solicit_especial_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_solicit_especial__hora'] =  $this->part_dt_solicit_especial__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_programacao_'] =  $this->part_programacao_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_programacao_'] =  $this->part_dt_programacao_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_programacao__hora'] =  $this->part_dt_programacao__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_aereo_'] =  $this->part_aereo_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_aereo_'] =  $this->part_dt_aereo_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_aereo__hora'] =  $this->part_dt_aereo__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_hospedagem_'] =  $this->part_hospedagem_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['par_dt_hospedagem_'] =  $this->par_dt_hospedagem_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['par_dt_hospedagem__hora'] =  $this->par_dt_hospedagem__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_transfer_'] =  $this->part_dt_transfer_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_transfer__hora'] =  $this->part_dt_transfer__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_opcionais_'] =  $this->part_opcionais_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_opcionais_'] =  $this->part_dt_opcionais_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_opcionais__hora'] =  $this->part_dt_opcionais__hora; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_notas_'] =  $this->part_notas_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_confirm_viagem_'] =  $this->part_confirm_viagem_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_convite_'] =  $this->part_convite_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_concluido_'] =  $this->part_concluido_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_transfer_'] =  $this->part_transfer_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_convite_enviado_'] =  $this->part_convite_enviado_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_destaque_negrito_'] =  $this->part_destaque_negrito_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_atendimento_'] =  $this->part_atendimento_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_save_the_date_'] =  $this->part_save_the_date_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_arq_save_'] =  $this->part_arq_save_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_arq_convite_'] =  $this->part_arq_convite_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_fumante_'] =  $this->part_fumante_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_restricao_alimentar_'] =  $this->part_restricao_alimentar_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_acompanhado_'] =  $this->part_acompanhado_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_acompanhado_hotel_'] =  $this->part_acompanhado_hotel_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_acom_completo_'] =  $this->part_acom_completo_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_acom_incompleto_'] =  $this->part_acom_incompleto_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_incompleto_'] =  $this->part_incompleto_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_aereo_ok_'] =  $this->part_aereo_ok_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_bloqueio_id_'] =  $this->part_bloqueio_id_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_hotel_'] =  $this->part_hotel_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_anotacoes_'] =  $this->part_anotacoes_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['guarda_cod_substituto_'] =  $this->guarda_cod_substituto_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cpf_informado_'] =  $this->part_cpf_informado_; 
             $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cv_obs_'] =  $this->part_cv_obs_; 
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
       $rec_tot    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['total'] + 1;
       $rec_fim    = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] + $this->sc_max_reg;
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
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['record_state'] = array();
        }

        function storeRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['record_state'])) {
                        $this->initializeRecordState();
                }
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['record_state'][$sc_seq_vert])) {
                        $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['record_state'][$sc_seq_vert] = array();
                }

                $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['record_state'][$sc_seq_vert]['buttons'] = array(
                        'delete' => $this->nmgp_botoes['delete'],
                        'update' => $this->nmgp_botoes['update']
                );
        }

        function loadRecordState($sc_seq_vert = 0) {
                if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['record_state']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['record_state'][$sc_seq_vert])) {
                        return;
                }

                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['record_state'][$sc_seq_vert]['buttons']['delete'])) {
                        $this->nmgp_botoes['delete'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['record_state'][$sc_seq_vert]['buttons']['delete'];
                }
                if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['record_state'][$sc_seq_vert]['buttons']['update'])) {
                        $this->nmgp_botoes['update'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['record_state'][$sc_seq_vert]['buttons']['update'];
                }
        }

//

function part_id_evento_publico__onChange()
{
$_SESSION['scriptcase']['form_participantes_rsvp_ar']['contr_erro'] = 'on';
  
$original_part_id_evento_ = $this->part_id_evento_;
$original_part_id_evento_publico_ = $this->part_id_evento_publico_;



$sql = "
	SELECT
		evento_id,
		publico_id
	FROM
		eventos_publicos_rsvp
	WHERE
		evento_id = ".$this->Db->qstr($this->part_id_evento_ )."
	AND
		publico_id = ".$this->Db->qstr($this->part_id_evento_publico_ )."
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
	
if (!isset($this->rs[0][0])) {	
	$this->sc_ajax_message ("Público: ".$this->part_id_evento_publico_ ." NÃO cadastrado para o evento: ".$this->part_id_evento_ ,"NRSVP" , "timeout=10");
	$this->part_id_evento_publico_  = '0';		
} else {
	$sql2 = "
		SELECT
			publico_id,
			publico_nome
		FROM
			publico_rsvp
		WHERE
			publico_id = ".$this->Db->qstr($this->part_id_evento_publico_ )."		
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
		$publico = $this->rs2[0][1];
		$this->sc_ajax_message ("Público: ".$this->part_id_evento_publico_ ." - ".$publico,"NRSVP" , "timeout=3");		
	}	
}	

$modificado_part_id_evento_ = $this->part_id_evento_;
$modificado_part_id_evento_publico_ = $this->part_id_evento_publico_;
$this->nm_formatar_campos('part_id_evento_', 'part_id_evento_publico_');
$this->nmgp_refresh_fields = array();
if ($original_part_id_evento_ !== $modificado_part_id_evento_ || isset($this->nmgp_cmp_readonly['part_id_evento_']) || (isset($bFlagRead_part_id_evento_) && $bFlagRead_part_id_evento_))
{
    $this->nmgp_refresh_fields[] = 'part_id_evento_';
    $this->NM_ajax_changed['part_id_evento_'] = true;
    $this->NM_ajax_force_values = true;
}
if ($original_part_id_evento_publico_ !== $modificado_part_id_evento_publico_ || isset($this->nmgp_cmp_readonly['part_id_evento_publico_']) || (isset($bFlagRead_part_id_evento_publico_) && $bFlagRead_part_id_evento_publico_))
{
    $this->nmgp_refresh_fields[] = 'part_id_evento_publico_';
    $this->NM_ajax_changed['part_id_evento_publico_'] = true;
    $this->NM_ajax_force_values = true;
}
if ($this->NM_ajax_force_values)
{
    $this->ajax_return_values();
}
$this->NM_ajax_info['event_field'] = 'part';
form_participantes_rsvp_ar_pack_ajax_response();
exit;
$_SESSION['scriptcase']['form_participantes_rsvp_ar']['contr_erro'] = 'off';
}


function part_id_evento_regional__onChange()
{
$_SESSION['scriptcase']['form_participantes_rsvp_ar']['contr_erro'] = 'on';
  
$original_part_id_evento_ = $this->part_id_evento_;
$original_part_id_evento_regional_ = $this->part_id_evento_regional_;


	
$sql = "
	SELECT
		evento_id,
		regional_id
	FROM
		eventos_regionais_rsvp
	WHERE
		evento_id = ".$this->Db->qstr($this->part_id_evento_ )."
	AND
		regional_id = ".$this->Db->qstr($this->part_id_evento_regional_ )."
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
	
if (!isset($this->rs[0][0])) {	
	$this->sc_ajax_message ("Regional: ".$this->part_id_evento_regional_ ." NÃO cadastrada para o evento: ".$this->part_id_evento_ ,"NRSVP" , "timeout=10");
	$this->part_id_evento_regional_  = '0';		
} else {
	$sql2 = "
		SELECT
			regional_id,
			regional_dsc
		FROM
			tbl_regionais
		WHERE
			regional_id = ".$this->Db->qstr($this->part_id_evento_regional_ )."		
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
		$regional = $this->rs2[0][1];
		$this->sc_ajax_message ("Regional: ".$this->part_id_evento_regional_ ." - ".$regional,"NRSVP" , "timeout=3");		
	}	
}	


$modificado_part_id_evento_ = $this->part_id_evento_;
$modificado_part_id_evento_regional_ = $this->part_id_evento_regional_;
$this->nm_formatar_campos('part_id_evento_', 'part_id_evento_regional_');
$this->nmgp_refresh_fields = array();
if ($original_part_id_evento_ !== $modificado_part_id_evento_ || isset($this->nmgp_cmp_readonly['part_id_evento_']) || (isset($bFlagRead_part_id_evento_) && $bFlagRead_part_id_evento_))
{
    $this->nmgp_refresh_fields[] = 'part_id_evento_';
    $this->NM_ajax_changed['part_id_evento_'] = true;
    $this->NM_ajax_force_values = true;
}
if ($original_part_id_evento_regional_ !== $modificado_part_id_evento_regional_ || isset($this->nmgp_cmp_readonly['part_id_evento_regional_']) || (isset($bFlagRead_part_id_evento_regional_) && $bFlagRead_part_id_evento_regional_))
{
    $this->nmgp_refresh_fields[] = 'part_id_evento_regional_';
    $this->NM_ajax_changed['part_id_evento_regional_'] = true;
    $this->NM_ajax_force_values = true;
}
if ($this->NM_ajax_force_values)
{
    $this->ajax_return_values();
}
$this->NM_ajax_info['event_field'] = 'part';
form_participantes_rsvp_ar_pack_ajax_response();
exit;
$_SESSION['scriptcase']['form_participantes_rsvp_ar']['contr_erro'] = 'off';
}


function part_sexo__onChange()
{
$_SESSION['scriptcase']['form_participantes_rsvp_ar']['contr_erro'] = 'on';
  
$original_part_sexo_ = $this->part_sexo_;
$original_part_cpf_ = $this->part_cpf_;

if($this->part_sexo_  <> 'M' && $this->part_sexo_  <> 'F') {
	$this->sc_ajax_message("Conteúdo do campo SEXO inválido: ".$this->part_sexo_ ,"NRSVP" , "timeout=3");		
	$sql = "
		SELECT
			part_sexo
		FROM
			participantes_rsvp
		WHERE
			part_cpf = ".$this->Db->qstr($this->part_cpf_ )."
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
		$this->part_sexo_  = $this->rs[0][0];
	} else {	
		$this->part_sexo_  = 'F';
	}	
}	

$modificado_part_sexo_ = $this->part_sexo_;
$modificado_part_cpf_ = $this->part_cpf_;
$this->nm_formatar_campos('part_sexo_', 'part_cpf_');
$this->nmgp_refresh_fields = array();
if ($original_part_sexo_ !== $modificado_part_sexo_ || isset($this->nmgp_cmp_readonly['part_sexo_']) || (isset($bFlagRead_part_sexo_) && $bFlagRead_part_sexo_))
{
    $this->nmgp_refresh_fields[] = 'part_sexo_';
    $this->NM_ajax_changed['part_sexo_'] = true;
    $this->NM_ajax_force_values = true;
}
if ($original_part_cpf_ !== $modificado_part_cpf_ || isset($this->nmgp_cmp_readonly['part_cpf_']) || (isset($bFlagRead_part_cpf_) && $bFlagRead_part_cpf_))
{
    $this->nmgp_refresh_fields[] = 'part_cpf_';
    $this->NM_ajax_changed['part_cpf_'] = true;
    $this->NM_ajax_force_values = true;
}
if ($this->NM_ajax_force_values)
{
    $this->ajax_return_values();
}
$this->NM_ajax_info['event_field'] = 'part';
form_participantes_rsvp_ar_pack_ajax_response();
exit;
$_SESSION['scriptcase']['form_participantes_rsvp_ar']['contr_erro'] = 'off';
}


function part_tam_camisa__onChange()
{
$_SESSION['scriptcase']['form_participantes_rsvp_ar']['contr_erro'] = 'on';
  
$original_part_tam_camisa_ = $this->part_tam_camisa_;



if($this->part_tam_camisa_  <> 'P' && $this->part_tam_camisa_  <> 'M' && $this->part_tam_camisa_  <> 'G' && $this->part_tam_camisa_  <> 'PP' && $this->part_tam_camisa_  <> 'GG' && $this->part_tam_camisa_  <> 'EG') {
	$this->sc_ajax_message ("Conteúdo do campo Tamanho da Camisa inválido: ".$this->part_tam_camisa_ ,"NRSVP" , "timeout=3");		
	$this->part_tam_camisa_   = '';	
}	

$modificado_part_tam_camisa_ = $this->part_tam_camisa_;
$this->nm_formatar_campos('part_tam_camisa_');
$this->nmgp_refresh_fields = array();
if ($original_part_tam_camisa_ !== $modificado_part_tam_camisa_ || isset($this->nmgp_cmp_readonly['part_tam_camisa_']) || (isset($bFlagRead_part_tam_camisa_) && $bFlagRead_part_tam_camisa_))
{
    $this->nmgp_refresh_fields[] = 'part_tam_camisa_';
    $this->NM_ajax_changed['part_tam_camisa_'] = true;
    $this->NM_ajax_force_values = true;
}
if ($this->NM_ajax_force_values)
{
    $this->ajax_return_values();
}
$this->NM_ajax_info['event_field'] = 'part';
form_participantes_rsvp_ar_pack_ajax_response();
exit;


$_SESSION['scriptcase']['form_participantes_rsvp_ar']['contr_erro'] = 'off';
}


function GravaLog($v_hora_now,$v_ip_usuario,$v_id_usuario,$v_global_cpf,$v_modulo,$v_aplicacao,$v_acao,$v_campo_id,$v_vl_campo_id,$v_campo_cpf,$v_vl_campo_cpf,$v_campo_evt,$v_vl_campo_evt,$v_tabela,$v_obs,$v_sql) {
$_SESSION['scriptcase']['form_participantes_rsvp_ar']['contr_erro'] = 'on';
  		
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
                form_participantes_rsvp_ar_pack_ajax_response();
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
$_SESSION['scriptcase']['form_participantes_rsvp_ar']['contr_erro'] = 'off';
}


function PegaIP() {
$_SESSION['scriptcase']['form_participantes_rsvp_ar']['contr_erro'] = 'on';
  
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
	
$_SESSION['scriptcase']['form_participantes_rsvp_ar']['contr_erro'] = 'off';
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
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['botoes'] = $this->nmgp_botoes;
     if ($this->nmgp_opcao != "recarga" && $this->nmgp_opcao != "muda_form")
     {
         $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['opc_ant'] = $this->nmgp_opcao;
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
     if (($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] == "R") && $this->nm_flag_iframe && empty($this->nm_todas_criticas))
     {
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe_ajax']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['retorno_edit'] = array("edit", "");
          }
          else
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['retorno_edit'] .= "&nmgp_opcao=edit";
          }
          if ($this->sc_evento == "insert" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] == "F")
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe_ajax']))
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['retorno_edit'] = array("edit", "fim");
              }
              else
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['retorno_edit'] .= "&rec=fim";
              }
          }
          $this->NM_close_db(); 
          $sJsParent = '';
          if ($this->NM_ajax_flag && isset($this->NM_ajax_info['param']['buffer_output']) && $this->NM_ajax_info['param']['buffer_output'])
          {
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe_ajax']))
              {
                  $this->NM_ajax_info['ajaxJavascript'][] = array("parent.ajax_navigate", $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['retorno_edit']);
              }
              else
              {
                  $sJsParent .= 'parent';
                  $this->NM_ajax_info['redir']['metodo'] = 'location';
                  $this->NM_ajax_info['redir']['action'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['retorno_edit'];
                  $this->NM_ajax_info['redir']['target'] = $sJsParent;
              }
              form_participantes_rsvp_ar_pack_ajax_response();
              exit;
          }
?>
<!DOCTYPE html>

         <html><body>
         <script type="text/javascript">
<?php
    
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe_ajax']))
    {
        $opc = ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] == "F" && $this->sc_evento == "insert") ? "fim" : "";
        echo "parent.ajax_navigate('edit', '" .$opc . "');";
    }
    else
    {
        echo $sJsParent . "parent.location = '" . $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['retorno_edit'] . "';";
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
        $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['table_refresh'] = true;
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
        if ('SC_all_Cmp' == $this->nmgp_fast_search && in_array($field, array("part_id_evento_", "part_cpf_", "nome_pessoa_", "part_sexo_", "part_id_evento_publico_", "part_id_evento_regional_", "part_grupo_", "part_clube_", "part_empresa_", "part_uf_", "part_ddd_celular_01_", "part_celeular_01_", "part_dt_nasc_", "part_tam_camisa_", "part_tam_calcado_"))) {
            $searchOk = true;
        }
        elseif ($field == $this->nmgp_fast_search && in_array($field, array("part_id_evento_", "part_cpf_", "nome_pessoa_", "part_sexo_", "part_id_evento_publico_", "part_id_evento_regional_", "part_grupo_", "part_clube_", "part_empresa_", "part_uf_", "part_ddd_celular_01_", "part_celeular_01_", "part_dt_nasc_", "part_tam_camisa_", "part_tam_calcado_"))) {
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['table_refresh']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['table_refresh'])
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
        if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['csrf_token']))
        {
            $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['csrf_token'] = $this->scCsrfGenerateToken();
        }

        return $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['csrf_token'];
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

   function SC_fast_search($in_fields, $arg_search, $data_search)
   {
      $fields = (strpos($in_fields, "SC_all_Cmp") !== false) ? array("SC_all_Cmp") : explode(";", $in_fields);
      $this->NM_case_insensitive = true;
      if (empty($data_search)) 
      {
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_and_or']);
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_cache']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_filter']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['fast_search']);
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_detal'])) 
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_filter'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_detal'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['empty_filter'])
          {
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['empty_filter']);
              $this->NM_ajax_info['empty_filter'] = 'ok';
              form_participantes_rsvp_ar_pack_ajax_response();
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
          if ($field == "SC_all_Cmp" || $field == "part_id_evento_") 
          {
              $this->SC_monta_condicao($comando, "part_id_evento", $arg_search, str_replace(",", ".", $data_search), "INT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "part_cpf_") 
          {
              $this->SC_monta_condicao($comando, "part_cpf", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "nome_pessoa_") 
          {
              $this->SC_monta_condicao($comando, "nome_pessoa", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "part_sexo_") 
          {
              $this->SC_monta_condicao($comando, "part_sexo", $arg_search, $data_search, "ENUM", false);
          }
          if ($field == "SC_all_Cmp" || $field == "part_id_evento_publico_") 
          {
              $this->SC_monta_condicao($comando, "part_id_evento_publico", $arg_search, str_replace(",", ".", $data_search), "INT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "part_id_evento_regional_") 
          {
              $this->SC_monta_condicao($comando, "part_id_evento_regional", $arg_search, str_replace(",", ".", $data_search), "INT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "part_grupo_") 
          {
              $this->SC_monta_condicao($comando, "part_grupo", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "part_clube_") 
          {
              $this->SC_monta_condicao($comando, "part_clube", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "part_empresa_") 
          {
              $this->SC_monta_condicao($comando, "part_empresa", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "part_uf_") 
          {
              $this->SC_monta_condicao($comando, "part_uf", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "part_ddd_celular_01_") 
          {
              $this->SC_monta_condicao($comando, "part_ddd_celular_01", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "part_celeular_01_") 
          {
              $this->SC_monta_condicao($comando, "part_celeular_01", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "part_dt_nasc_") 
          {
              $this->SC_monta_condicao($comando, "part_dt_nasc", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "part_tam_camisa_") 
          {
              $this->SC_monta_condicao($comando, "part_tam_camisa", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "part_tam_calcado_") 
          {
              $this->SC_monta_condicao($comando, "part_tam_calcado", $arg_search, $data_search, "VARCHAR", false);
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_detal']) && !empty($comando)) 
      {
          $comando = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_detal'] . " and (" .  $comando . ")";
      }
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_filter_form']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_filter_form'])
      {
          $sc_where = " where " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_filter_form'] . " and (" . $comando . ")";
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
      $qt_geral_reg_form_participantes_rsvp_ar = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['total'] = $qt_geral_reg_form_participantes_rsvp_ar;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_filter'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['fast_search'][0] = $field;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['fast_search'][2] = $sv_data;
      $rt->Close(); 
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_participantes_rsvp_ar_pack_ajax_response();
          exit;
      }
      elseif (!isset($rt->fields[0]) || $rt->fields[0] == 0)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['empty_filter'] = true;
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_participantes_rsvp_ar_pack_ajax_response();
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
      $nm_numeric[] = "participante_id";$nm_numeric[] = "part_id_evento";$nm_numeric[] = "part_id_evento_publico";$nm_numeric[] = "part_id_evento_regional";$nm_numeric[] = "part_cod_usuario";$nm_numeric[] = "part_bloqueio_id";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['decimal_db'] == ".")
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
      $Nm_datas["part_dt_nasc"] = "date";$Nm_datas["part_validade_pass"] = "date";$Nm_datas["part_dt_cadastro"] = "timestamp";$Nm_datas["part_dt_alteracao"] = "timestamp";$Nm_datas["part_dt_alt_contato_rsvp"] = "timestamp";$Nm_datas["part_dt_alt_presenca"] = "timestamp";$Nm_datas["part_dt_solicit_especial"] = "timestamp";$Nm_datas["part_dt_programacao"] = "timestamp";$Nm_datas["part_dt_aereo"] = "timestamp";$Nm_datas["par_dt_hospedagem"] = "timestamp";$Nm_datas["part_dt_transfer"] = "timestamp";$Nm_datas["part_dt_opcionais"] = "timestamp";$Nm_datas["part_save_the_date"] = "date";
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
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['SC_sep_date']))
              {
                  $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['SC_sep_date'];
                  $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['SC_sep_date1'];
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
   function html_dynamic_search()
   {
       $this->Dyn_search_seq = 0;
       $this->Dyn_search_str = "";
       $this->Dyn_search_dat = array();
       $this->NM_case_insensitive = true;
      $this->Dyn_search_str = "";
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['cond_pesq']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['cond_pesq']))
       {
           $tmp = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['cond_pesq'];
           $pos = strrpos($tmp, "##*@@");
           if ($pos !== false)
           {
               $and_or = (substr($tmp, ($pos + 5)) == "and") ? $this->Ini->Nm_lang['lang_srch_and_cond'] : $this->Ini->Nm_lang['lang_srch_orr_cond'];
               $tmp    = substr($tmp, 0, $pos);
               $this->Dyn_search_str = str_replace("##*@@", " " . $and_or . " ", $tmp);
           }
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label'] = array();
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_id_evento_'] = (isset($this->New_label['part_id_evento_'])) ? $this->New_label['part_id_evento_'] : "Cod. Evento";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_sexo_'] = (isset($this->New_label['part_sexo_'])) ? $this->New_label['part_sexo_'] : "Sexo";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_grupo_'] = (isset($this->New_label['part_grupo_'])) ? $this->New_label['part_grupo_'] : "Gupo";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_clube_'] = (isset($this->New_label['part_clube_'])) ? $this->New_label['part_clube_'] : "Clube";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_empresa_'] = (isset($this->New_label['part_empresa_'])) ? $this->New_label['part_empresa_'] : "Empresa";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_uf_'] = (isset($this->New_label['part_uf_'])) ? $this->New_label['part_uf_'] : "UF";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_ddd_celular_01_'] = (isset($this->New_label['part_ddd_celular_01_'])) ? $this->New_label['part_ddd_celular_01_'] : "DDD Celular";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_tam_camisa_'] = (isset($this->New_label['part_tam_camisa_'])) ? $this->New_label['part_tam_camisa_'] : "Tam. Camisa";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_tam_calcado_'] = (isset($this->New_label['part_tam_calcado_'])) ? $this->New_label['part_tam_calcado_'] : "Tam. Calçado";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_dt_nasc_'] = (isset($this->New_label['part_dt_nasc_'])) ? $this->New_label['part_dt_nasc_'] : "Dt. Nascimento";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_id_evento_publico_'] = (isset($this->New_label['part_id_evento_publico_'])) ? $this->New_label['part_id_evento_publico_'] : "Público";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_id_evento_regional_'] = (isset($this->New_label['part_id_evento_regional_'])) ? $this->New_label['part_id_evento_regional_'] : "Regional";
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
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search']))
       {
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search'] as $IX => $def)
           {
               $cmp = $def['cmp'];
               if ($cmp == "part_id_evento_")
               {
                   $this->Dyn_search_seq++;;
                   $this->Dyn_search_dat[$this->Dyn_search_seq] = "part_id_evento_";
                   $lin_obj = $this->dynamic_search_part_id_evento_($this->Dyn_search_seq, 'N', $def['opc'], $def['val']);
                   echo $lin_obj;
               }
               if ($cmp == "part_sexo_")
               {
                   $this->Dyn_search_seq++;;
                   $this->Dyn_search_dat[$this->Dyn_search_seq] = "part_sexo_";
                   $lin_obj = $this->dynamic_search_part_sexo_($this->Dyn_search_seq, 'N', $def['opc'], $def['val']);
                   echo $lin_obj;
               }
               if ($cmp == "part_grupo_")
               {
                   $this->Dyn_search_seq++;;
                   $this->Dyn_search_dat[$this->Dyn_search_seq] = "part_grupo_";
                   $lin_obj = $this->dynamic_search_part_grupo_($this->Dyn_search_seq, 'N', $def['opc'], $def['val']);
                   echo $lin_obj;
               }
               if ($cmp == "part_clube_")
               {
                   $this->Dyn_search_seq++;;
                   $this->Dyn_search_dat[$this->Dyn_search_seq] = "part_clube_";
                   $lin_obj = $this->dynamic_search_part_clube_($this->Dyn_search_seq, 'N', $def['opc'], $def['val']);
                   echo $lin_obj;
               }
               if ($cmp == "part_empresa_")
               {
                   $this->Dyn_search_seq++;;
                   $this->Dyn_search_dat[$this->Dyn_search_seq] = "part_empresa_";
                   $lin_obj = $this->dynamic_search_part_empresa_($this->Dyn_search_seq, 'N', $def['opc'], $def['val']);
                   echo $lin_obj;
               }
               if ($cmp == "part_uf_")
               {
                   $this->Dyn_search_seq++;;
                   $this->Dyn_search_dat[$this->Dyn_search_seq] = "part_uf_";
                   $lin_obj = $this->dynamic_search_part_uf_($this->Dyn_search_seq, 'N', $def['opc'], $def['val']);
                   echo $lin_obj;
               }
               if ($cmp == "part_ddd_celular_01_")
               {
                   $this->Dyn_search_seq++;;
                   $this->Dyn_search_dat[$this->Dyn_search_seq] = "part_ddd_celular_01_";
                   $lin_obj = $this->dynamic_search_part_ddd_celular_01_($this->Dyn_search_seq, 'N', $def['opc'], $def['val']);
                   echo $lin_obj;
               }
               if ($cmp == "part_tam_camisa_")
               {
                   $this->Dyn_search_seq++;;
                   $this->Dyn_search_dat[$this->Dyn_search_seq] = "part_tam_camisa_";
                   $lin_obj = $this->dynamic_search_part_tam_camisa_($this->Dyn_search_seq, 'N', $def['opc'], $def['val']);
                   echo $lin_obj;
               }
               if ($cmp == "part_tam_calcado_")
               {
                   $this->Dyn_search_seq++;;
                   $this->Dyn_search_dat[$this->Dyn_search_seq] = "part_tam_calcado_";
                   $lin_obj = $this->dynamic_search_part_tam_calcado_($this->Dyn_search_seq, 'N', $def['opc'], $def['val']);
                   echo $lin_obj;
               }
               if ($cmp == "part_dt_nasc_")
               {
                   $this->Dyn_search_seq++;;
                   $this->Dyn_search_dat[$this->Dyn_search_seq] = "part_dt_nasc_";
                   $lin_obj = $this->dynamic_search_part_dt_nasc_($this->Dyn_search_seq, 'N', $def['opc'], $def['val']);
                   echo $lin_obj;
               }
               if ($cmp == "part_id_evento_publico_")
               {
                   $this->Dyn_search_seq++;;
                   $this->Dyn_search_dat[$this->Dyn_search_seq] = "part_id_evento_publico_";
                   $lin_obj = $this->dynamic_search_part_id_evento_publico_($this->Dyn_search_seq, 'N', $def['opc'], $def['val']);
                   echo $lin_obj;
               }
               if ($cmp == "part_id_evento_regional_")
               {
                   $this->Dyn_search_seq++;;
                   $this->Dyn_search_dat[$this->Dyn_search_seq] = "part_id_evento_regional_";
                   $lin_obj = $this->dynamic_search_part_id_evento_regional_($this->Dyn_search_seq, 'N', $def['opc'], $def['val']);
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
                <div class='scBtnGrpText' style='cursor: pointer;' onclick="ajax_add_dyn_search('part_id_evento_', 'form')"><?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_id_evento_'] ?>
                </div>
            </td>
        </tr>
        <tr>
            <td class='scBtnGrpBackground'>
                <div class='scBtnGrpText' style='cursor: pointer;' onclick="ajax_add_dyn_search('part_sexo_', 'form')"><?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_sexo_'] ?>
                </div>
            </td>
        </tr>
        <tr>
            <td class='scBtnGrpBackground'>
                <div class='scBtnGrpText' style='cursor: pointer;' onclick="ajax_add_dyn_search('part_grupo_', 'form')"><?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_grupo_'] ?>
                </div>
            </td>
        </tr>
        <tr>
            <td class='scBtnGrpBackground'>
                <div class='scBtnGrpText' style='cursor: pointer;' onclick="ajax_add_dyn_search('part_clube_', 'form')"><?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_clube_'] ?>
                </div>
            </td>
        </tr>
        <tr>
            <td class='scBtnGrpBackground'>
                <div class='scBtnGrpText' style='cursor: pointer;' onclick="ajax_add_dyn_search('part_empresa_', 'form')"><?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_empresa_'] ?>
                </div>
            </td>
        </tr>
        <tr>
            <td class='scBtnGrpBackground'>
                <div class='scBtnGrpText' style='cursor: pointer;' onclick="ajax_add_dyn_search('part_uf_', 'form')"><?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_uf_'] ?>
                </div>
            </td>
        </tr>
        <tr>
            <td class='scBtnGrpBackground'>
                <div class='scBtnGrpText' style='cursor: pointer;' onclick="ajax_add_dyn_search('part_ddd_celular_01_', 'form')"><?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_ddd_celular_01_'] ?>
                </div>
            </td>
        </tr>
        <tr>
            <td class='scBtnGrpBackground'>
                <div class='scBtnGrpText' style='cursor: pointer;' onclick="ajax_add_dyn_search('part_tam_camisa_', 'form')"><?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_tam_camisa_'] ?>
                </div>
            </td>
        </tr>
        <tr>
            <td class='scBtnGrpBackground'>
                <div class='scBtnGrpText' style='cursor: pointer;' onclick="ajax_add_dyn_search('part_tam_calcado_', 'form')"><?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_tam_calcado_'] ?>
                </div>
            </td>
        </tr>
        <tr>
            <td class='scBtnGrpBackground'>
                <div class='scBtnGrpText' style='cursor: pointer;' onclick="ajax_add_dyn_search('part_dt_nasc_', 'form')"><?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_dt_nasc_'] ?>
                </div>
            </td>
        </tr>
        <tr>
            <td class='scBtnGrpBackground'>
                <div class='scBtnGrpText' style='cursor: pointer;' onclick="ajax_add_dyn_search('part_id_evento_publico_', 'form')"><?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_id_evento_publico_'] ?>
                </div>
            </td>
        </tr>
        <tr>
            <td class='scBtnGrpBackground'>
                <div class='scBtnGrpText' style='cursor: pointer;' onclick="ajax_add_dyn_search('part_id_evento_regional_', 'form')"><?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_id_evento_regional_'] ?>
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
           if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_clear']))
           { 
               unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_clear']);
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
   function dynamic_search_part_id_evento_($ind, $ajax, $opc="", $val=array(), $enabled = 'S')
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
       $lin_obj .= "     <div id='dyn_search_part_id_evento__" . $ind . "' class='align " . $_classAlign . " " . ($enabled=='S'?'':'disabled') . "'>";
       $lin_obj .= "      <i class='fa-solid fa-grip-lines-vertical drag_handle'></i>";
       $lin_obj .= "      <div class='fixed_width_select'>";
       $lin_obj .= "         <div class='width-constrain' style='display: '>";
       $lin_obj .= "         " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_id_evento_'] . "";
       $lin_obj .= "         </div>";
       $lin_obj .= "        </div>";
       $lin_obj .= "      <div class='fixed_width_conditions'>";
       $lin_obj .= "       <select id='dyn_search_part_id_evento__cond_" . $ind . "' name='cond_dyn_search_part_id_evento__" . $ind . "' class='scAppDivToolbarInput' style='vertical-align: middle;' onChange='buttonEnable_dyn(\"dyn_search\");dyn_search_hide_input(\"part_id_evento_\", $ind)'>";
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
       $lin_obj .= "     <input  type=\"text\" class='sc-js-input-dyn scFormObjectOdd scAppDivToolbarInput' id='dyn_search_part_id_evento__val_" . $ind . "' name='val_dyn_search_part_id_evento__" . $ind . "' onChange=\"buttonEnable_dyn('dyn_search');\" value=\"" . $this->form_encode_input($val_cmp) . "\" size=11 alt=\"{datatype: 'decimal', maxLength: 11, precision: 0, decimalSep: '" . $_SESSION['scriptcase']['reg_conf']['dec_num'] . "', thousandsSep: '" . $_SESSION['scriptcase']['reg_conf']['grup_num'] . "', allowNegative: false, onlyNegative: false, enterTab: false}\" >";
       $lin_obj .= "        </span>";
       $lin_obj .= "      </div>";
       $lin_obj .= "       <div class='fixed_width_toolbar'>";
       $lin_obj .= "       <img class='dyn_search_field_close' id='dyn_search_part_id_evento__close_" . $ind . "' src='" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "' onclick=\"del_dyn_search('dyn_search_part_id_evento__" . $ind . "', " . $ind . ", 'only');buttonEnable_dyn('dyn_search');\">";
       $enabled = 'S';
       $lin_obj .= "         <input type='hidden' class='dyn_search_enabled' name='dyn_search_enabled_part_id_evento__" . $ind . "'  id='dyn_search_enabled_part_id_evento__" . $ind . "' value='" . $enabled . "' />";
       $lin_obj .= "       </div>";
       $lin_obj .= "     </div>";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne") {
           $lin_obj .= "     <script>";
           $lin_obj .= "        $( document ).ready(function() {buttonEnable_dyn('dyn_search');});";
           $lin_obj .= "     </script>";
       }
       return $lin_obj;
   }
   function dynamic_search_part_sexo_($ind, $ajax, $opc="", $val=array(), $enabled = 'S')
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
       $lin_obj .= "     <div id='dyn_search_part_sexo__" . $ind . "' class='align " . $_classAlign . " " . ($enabled=='S'?'':'disabled') . "'>";
       $lin_obj .= "      <i class='fa-solid fa-grip-lines-vertical drag_handle'></i>";
       $lin_obj .= "      <div class='fixed_width_select'>";
       $lin_obj .= "         <div class='width-constrain' style='display: '>";
       $lin_obj .= "         " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_sexo_'] . "";
       $lin_obj .= "         </div>";
       $lin_obj .= "        </div>";
       $lin_obj .= "      <div class='fixed_width_conditions'>";
       $lin_obj .= "       <select id='dyn_search_part_sexo__cond_" . $ind . "' name='cond_dyn_search_part_sexo__" . $ind . "' class='scAppDivToolbarInput' style='vertical-align: middle;' onChange='buttonEnable_dyn(\"dyn_search\");dyn_search_hide_input(\"part_sexo_\", $ind)'>";
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
       $lin_obj .= "     <input  type=\"text\" class='sc-js-input-dyn scFormObjectOdd scAppDivToolbarInput' id='dyn_search_part_sexo__val_" . $ind . "' name='val_dyn_search_part_sexo__" . $ind . "' onChange=\"buttonEnable_dyn('dyn_search');\" value=\"" . $this->form_encode_input($val_cmp) . "\" size=1 alt=\"{datatype: 'text', maxLength: 1, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}\" >";
       $lin_obj .= "        </span>";
       $lin_obj .= "      </div>";
       $lin_obj .= "       <div class='fixed_width_toolbar'>";
       $lin_obj .= "       <img class='dyn_search_field_close' id='dyn_search_part_sexo__close_" . $ind . "' src='" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "' onclick=\"del_dyn_search('dyn_search_part_sexo__" . $ind . "', " . $ind . ", 'only');buttonEnable_dyn('dyn_search');\">";
       $enabled = 'S';
       $lin_obj .= "         <input type='hidden' class='dyn_search_enabled' name='dyn_search_enabled_part_sexo__" . $ind . "'  id='dyn_search_enabled_part_sexo__" . $ind . "' value='" . $enabled . "' />";
       $lin_obj .= "       </div>";
       $lin_obj .= "     </div>";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne") {
           $lin_obj .= "     <script>";
           $lin_obj .= "        $( document ).ready(function() {buttonEnable_dyn('dyn_search');});";
           $lin_obj .= "     </script>";
       }
       return $lin_obj;
   }
   function dynamic_search_part_grupo_($ind, $ajax, $opc="", $val=array(), $enabled = 'S')
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
       $lin_obj .= "     <div id='dyn_search_part_grupo__" . $ind . "' class='align " . $_classAlign . " " . ($enabled=='S'?'':'disabled') . "'>";
       $lin_obj .= "      <i class='fa-solid fa-grip-lines-vertical drag_handle'></i>";
       $lin_obj .= "      <div class='fixed_width_select'>";
       $lin_obj .= "         <div class='width-constrain' style='display: '>";
       $lin_obj .= "         " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_grupo_'] . "";
       $lin_obj .= "         </div>";
       $lin_obj .= "        </div>";
       $lin_obj .= "      <div class='fixed_width_conditions'>";
       $lin_obj .= "       <select id='dyn_search_part_grupo__cond_" . $ind . "' name='cond_dyn_search_part_grupo__" . $ind . "' class='scAppDivToolbarInput' style='vertical-align: middle;' onChange='buttonEnable_dyn(\"dyn_search\");dyn_search_hide_input(\"part_grupo_\", $ind)'>";
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
       $lin_obj .= "     <input  type=\"text\" class='sc-js-input-dyn scFormObjectOdd scAppDivToolbarInput' id='dyn_search_part_grupo__val_" . $ind . "' name='val_dyn_search_part_grupo__" . $ind . "' onChange=\"buttonEnable_dyn('dyn_search');\" value=\"" . $this->form_encode_input($val_cmp) . "\" size=50 alt=\"{datatype: 'text', maxLength: 100, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}\" >";
       $lin_obj .= "        </span>";
       $lin_obj .= "      </div>";
       $lin_obj .= "       <div class='fixed_width_toolbar'>";
       $lin_obj .= "       <img class='dyn_search_field_close' id='dyn_search_part_grupo__close_" . $ind . "' src='" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "' onclick=\"del_dyn_search('dyn_search_part_grupo__" . $ind . "', " . $ind . ", 'only');buttonEnable_dyn('dyn_search');\">";
       $enabled = 'S';
       $lin_obj .= "         <input type='hidden' class='dyn_search_enabled' name='dyn_search_enabled_part_grupo__" . $ind . "'  id='dyn_search_enabled_part_grupo__" . $ind . "' value='" . $enabled . "' />";
       $lin_obj .= "       </div>";
       $lin_obj .= "     </div>";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne") {
           $lin_obj .= "     <script>";
           $lin_obj .= "        $( document ).ready(function() {buttonEnable_dyn('dyn_search');});";
           $lin_obj .= "     </script>";
       }
       return $lin_obj;
   }
   function dynamic_search_part_clube_($ind, $ajax, $opc="", $val=array(), $enabled = 'S')
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
       $lin_obj .= "     <div id='dyn_search_part_clube__" . $ind . "' class='align " . $_classAlign . " " . ($enabled=='S'?'':'disabled') . "'>";
       $lin_obj .= "      <i class='fa-solid fa-grip-lines-vertical drag_handle'></i>";
       $lin_obj .= "      <div class='fixed_width_select'>";
       $lin_obj .= "         <div class='width-constrain' style='display: '>";
       $lin_obj .= "         " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_clube_'] . "";
       $lin_obj .= "         </div>";
       $lin_obj .= "        </div>";
       $lin_obj .= "      <div class='fixed_width_conditions'>";
       $lin_obj .= "       <select id='dyn_search_part_clube__cond_" . $ind . "' name='cond_dyn_search_part_clube__" . $ind . "' class='scAppDivToolbarInput' style='vertical-align: middle;' onChange='buttonEnable_dyn(\"dyn_search\");dyn_search_hide_input(\"part_clube_\", $ind)'>";
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
       $lin_obj .= "     <input  type=\"text\" class='sc-js-input-dyn scFormObjectOdd scAppDivToolbarInput' id='dyn_search_part_clube__val_" . $ind . "' name='val_dyn_search_part_clube__" . $ind . "' onChange=\"buttonEnable_dyn('dyn_search');\" value=\"" . $this->form_encode_input($val_cmp) . "\" size=50 alt=\"{datatype: 'text', maxLength: 100, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}\" >";
       $lin_obj .= "        </span>";
       $lin_obj .= "      </div>";
       $lin_obj .= "       <div class='fixed_width_toolbar'>";
       $lin_obj .= "       <img class='dyn_search_field_close' id='dyn_search_part_clube__close_" . $ind . "' src='" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "' onclick=\"del_dyn_search('dyn_search_part_clube__" . $ind . "', " . $ind . ", 'only');buttonEnable_dyn('dyn_search');\">";
       $enabled = 'S';
       $lin_obj .= "         <input type='hidden' class='dyn_search_enabled' name='dyn_search_enabled_part_clube__" . $ind . "'  id='dyn_search_enabled_part_clube__" . $ind . "' value='" . $enabled . "' />";
       $lin_obj .= "       </div>";
       $lin_obj .= "     </div>";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne") {
           $lin_obj .= "     <script>";
           $lin_obj .= "        $( document ).ready(function() {buttonEnable_dyn('dyn_search');});";
           $lin_obj .= "     </script>";
       }
       return $lin_obj;
   }
   function dynamic_search_part_empresa_($ind, $ajax, $opc="", $val=array(), $enabled = 'S')
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
       $lin_obj .= "     <div id='dyn_search_part_empresa__" . $ind . "' class='align " . $_classAlign . " " . ($enabled=='S'?'':'disabled') . "'>";
       $lin_obj .= "      <i class='fa-solid fa-grip-lines-vertical drag_handle'></i>";
       $lin_obj .= "      <div class='fixed_width_select'>";
       $lin_obj .= "         <div class='width-constrain' style='display: '>";
       $lin_obj .= "         " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_empresa_'] . "";
       $lin_obj .= "         </div>";
       $lin_obj .= "        </div>";
       $lin_obj .= "      <div class='fixed_width_conditions'>";
       $lin_obj .= "       <select id='dyn_search_part_empresa__cond_" . $ind . "' name='cond_dyn_search_part_empresa__" . $ind . "' class='scAppDivToolbarInput' style='vertical-align: middle;' onChange='buttonEnable_dyn(\"dyn_search\");dyn_search_hide_input(\"part_empresa_\", $ind)'>";
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
       $lin_obj .= "     <input  type=\"text\" class='sc-js-input-dyn scFormObjectOdd scAppDivToolbarInput' id='dyn_search_part_empresa__val_" . $ind . "' name='val_dyn_search_part_empresa__" . $ind . "' onChange=\"buttonEnable_dyn('dyn_search');\" value=\"" . $this->form_encode_input($val_cmp) . "\" size=50 alt=\"{datatype: 'text', maxLength: 100, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}\" >";
       $lin_obj .= "        </span>";
       $lin_obj .= "      </div>";
       $lin_obj .= "       <div class='fixed_width_toolbar'>";
       $lin_obj .= "       <img class='dyn_search_field_close' id='dyn_search_part_empresa__close_" . $ind . "' src='" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "' onclick=\"del_dyn_search('dyn_search_part_empresa__" . $ind . "', " . $ind . ", 'only');buttonEnable_dyn('dyn_search');\">";
       $enabled = 'S';
       $lin_obj .= "         <input type='hidden' class='dyn_search_enabled' name='dyn_search_enabled_part_empresa__" . $ind . "'  id='dyn_search_enabled_part_empresa__" . $ind . "' value='" . $enabled . "' />";
       $lin_obj .= "       </div>";
       $lin_obj .= "     </div>";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne") {
           $lin_obj .= "     <script>";
           $lin_obj .= "        $( document ).ready(function() {buttonEnable_dyn('dyn_search');});";
           $lin_obj .= "     </script>";
       }
       return $lin_obj;
   }
   function dynamic_search_part_uf_($ind, $ajax, $opc="", $val=array(), $enabled = 'S')
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
       $lin_obj .= "     <div id='dyn_search_part_uf__" . $ind . "' class='align " . $_classAlign . " " . ($enabled=='S'?'':'disabled') . "'>";
       $lin_obj .= "      <i class='fa-solid fa-grip-lines-vertical drag_handle'></i>";
       $lin_obj .= "      <div class='fixed_width_select'>";
       $lin_obj .= "         <div class='width-constrain' style='display: '>";
       $lin_obj .= "         " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_uf_'] . "";
       $lin_obj .= "         </div>";
       $lin_obj .= "        </div>";
       $lin_obj .= "      <div class='fixed_width_conditions'>";
       $lin_obj .= "       <select id='dyn_search_part_uf__cond_" . $ind . "' name='cond_dyn_search_part_uf__" . $ind . "' class='scAppDivToolbarInput' style='vertical-align: middle;' onChange='buttonEnable_dyn(\"dyn_search\");dyn_search_hide_input(\"part_uf_\", $ind)'>";
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
       $lin_obj .= "     <input  type=\"text\" class='sc-js-input-dyn scFormObjectOdd scAppDivToolbarInput' id='dyn_search_part_uf__val_" . $ind . "' name='val_dyn_search_part_uf__" . $ind . "' onChange=\"buttonEnable_dyn('dyn_search');\" value=\"" . $this->form_encode_input($val_cmp) . "\" size=20 alt=\"{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}\" >";
       $lin_obj .= "        </span>";
       $lin_obj .= "      </div>";
       $lin_obj .= "       <div class='fixed_width_toolbar'>";
       $lin_obj .= "       <img class='dyn_search_field_close' id='dyn_search_part_uf__close_" . $ind . "' src='" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "' onclick=\"del_dyn_search('dyn_search_part_uf__" . $ind . "', " . $ind . ", 'only');buttonEnable_dyn('dyn_search');\">";
       $enabled = 'S';
       $lin_obj .= "         <input type='hidden' class='dyn_search_enabled' name='dyn_search_enabled_part_uf__" . $ind . "'  id='dyn_search_enabled_part_uf__" . $ind . "' value='" . $enabled . "' />";
       $lin_obj .= "       </div>";
       $lin_obj .= "     </div>";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne") {
           $lin_obj .= "     <script>";
           $lin_obj .= "        $( document ).ready(function() {buttonEnable_dyn('dyn_search');});";
           $lin_obj .= "     </script>";
       }
       return $lin_obj;
   }
   function dynamic_search_part_ddd_celular_01_($ind, $ajax, $opc="", $val=array(), $enabled = 'S')
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
       $lin_obj .= "     <div id='dyn_search_part_ddd_celular_01__" . $ind . "' class='align " . $_classAlign . " " . ($enabled=='S'?'':'disabled') . "'>";
       $lin_obj .= "      <i class='fa-solid fa-grip-lines-vertical drag_handle'></i>";
       $lin_obj .= "      <div class='fixed_width_select'>";
       $lin_obj .= "         <div class='width-constrain' style='display: '>";
       $lin_obj .= "         " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_ddd_celular_01_'] . "";
       $lin_obj .= "         </div>";
       $lin_obj .= "        </div>";
       $lin_obj .= "      <div class='fixed_width_conditions'>";
       $lin_obj .= "       <select id='dyn_search_part_ddd_celular_01__cond_" . $ind . "' name='cond_dyn_search_part_ddd_celular_01__" . $ind . "' class='scAppDivToolbarInput' style='vertical-align: middle;' onChange='buttonEnable_dyn(\"dyn_search\");dyn_search_hide_input(\"part_ddd_celular_01_\", $ind)'>";
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
       $lin_obj .= "     <input  type=\"text\" class='sc-js-input-dyn scFormObjectOdd scAppDivToolbarInput' id='dyn_search_part_ddd_celular_01__val_" . $ind . "' name='val_dyn_search_part_ddd_celular_01__" . $ind . "' onChange=\"buttonEnable_dyn('dyn_search');\" value=\"" . $this->form_encode_input($val_cmp) . "\" size=3 alt=\"{datatype: 'text', maxLength: 2, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}\" >";
       $lin_obj .= "        </span>";
       $lin_obj .= "      </div>";
       $lin_obj .= "       <div class='fixed_width_toolbar'>";
       $lin_obj .= "       <img class='dyn_search_field_close' id='dyn_search_part_ddd_celular_01__close_" . $ind . "' src='" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "' onclick=\"del_dyn_search('dyn_search_part_ddd_celular_01__" . $ind . "', " . $ind . ", 'only');buttonEnable_dyn('dyn_search');\">";
       $enabled = 'S';
       $lin_obj .= "         <input type='hidden' class='dyn_search_enabled' name='dyn_search_enabled_part_ddd_celular_01__" . $ind . "'  id='dyn_search_enabled_part_ddd_celular_01__" . $ind . "' value='" . $enabled . "' />";
       $lin_obj .= "       </div>";
       $lin_obj .= "     </div>";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne") {
           $lin_obj .= "     <script>";
           $lin_obj .= "        $( document ).ready(function() {buttonEnable_dyn('dyn_search');});";
           $lin_obj .= "     </script>";
       }
       return $lin_obj;
   }
   function dynamic_search_part_tam_camisa_($ind, $ajax, $opc="", $val=array(), $enabled = 'S')
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
       $lin_obj .= "     <div id='dyn_search_part_tam_camisa__" . $ind . "' class='align " . $_classAlign . " " . ($enabled=='S'?'':'disabled') . "'>";
       $lin_obj .= "      <i class='fa-solid fa-grip-lines-vertical drag_handle'></i>";
       $lin_obj .= "      <div class='fixed_width_select'>";
       $lin_obj .= "         <div class='width-constrain' style='display: '>";
       $lin_obj .= "         " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_tam_camisa_'] . "";
       $lin_obj .= "         </div>";
       $lin_obj .= "        </div>";
       $lin_obj .= "      <div class='fixed_width_conditions'>";
       $lin_obj .= "       <select id='dyn_search_part_tam_camisa__cond_" . $ind . "' name='cond_dyn_search_part_tam_camisa__" . $ind . "' class='scAppDivToolbarInput' style='vertical-align: middle;' onChange='buttonEnable_dyn(\"dyn_search\");dyn_search_hide_input(\"part_tam_camisa_\", $ind)'>";
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
       $lin_obj .= "     <input  type=\"text\" class='sc-js-input-dyn scFormObjectOdd scAppDivToolbarInput' id='dyn_search_part_tam_camisa__val_" . $ind . "' name='val_dyn_search_part_tam_camisa__" . $ind . "' onChange=\"buttonEnable_dyn('dyn_search');\" value=\"" . $this->form_encode_input($val_cmp) . "\" size=30 alt=\"{datatype: 'text', maxLength: 30, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}\" >";
       $lin_obj .= "        </span>";
       $lin_obj .= "      </div>";
       $lin_obj .= "       <div class='fixed_width_toolbar'>";
       $lin_obj .= "       <img class='dyn_search_field_close' id='dyn_search_part_tam_camisa__close_" . $ind . "' src='" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "' onclick=\"del_dyn_search('dyn_search_part_tam_camisa__" . $ind . "', " . $ind . ", 'only');buttonEnable_dyn('dyn_search');\">";
       $enabled = 'S';
       $lin_obj .= "         <input type='hidden' class='dyn_search_enabled' name='dyn_search_enabled_part_tam_camisa__" . $ind . "'  id='dyn_search_enabled_part_tam_camisa__" . $ind . "' value='" . $enabled . "' />";
       $lin_obj .= "       </div>";
       $lin_obj .= "     </div>";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne") {
           $lin_obj .= "     <script>";
           $lin_obj .= "        $( document ).ready(function() {buttonEnable_dyn('dyn_search');});";
           $lin_obj .= "     </script>";
       }
       return $lin_obj;
   }
   function dynamic_search_part_tam_calcado_($ind, $ajax, $opc="", $val=array(), $enabled = 'S')
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
       $lin_obj .= "     <div id='dyn_search_part_tam_calcado__" . $ind . "' class='align " . $_classAlign . " " . ($enabled=='S'?'':'disabled') . "'>";
       $lin_obj .= "      <i class='fa-solid fa-grip-lines-vertical drag_handle'></i>";
       $lin_obj .= "      <div class='fixed_width_select'>";
       $lin_obj .= "         <div class='width-constrain' style='display: '>";
       $lin_obj .= "         " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_tam_calcado_'] . "";
       $lin_obj .= "         </div>";
       $lin_obj .= "        </div>";
       $lin_obj .= "      <div class='fixed_width_conditions'>";
       $lin_obj .= "       <select id='dyn_search_part_tam_calcado__cond_" . $ind . "' name='cond_dyn_search_part_tam_calcado__" . $ind . "' class='scAppDivToolbarInput' style='vertical-align: middle;' onChange='buttonEnable_dyn(\"dyn_search\");dyn_search_hide_input(\"part_tam_calcado_\", $ind)'>";
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
       $lin_obj .= "     <input  type=\"text\" class='sc-js-input-dyn scFormObjectOdd scAppDivToolbarInput' id='dyn_search_part_tam_calcado__val_" . $ind . "' name='val_dyn_search_part_tam_calcado__" . $ind . "' onChange=\"buttonEnable_dyn('dyn_search');\" value=\"" . $this->form_encode_input($val_cmp) . "\" size=20 alt=\"{datatype: 'text', maxLength: 20, allowedChars: '', lettersCase: '', autoTab: false, enterTab: false}\" >";
       $lin_obj .= "        </span>";
       $lin_obj .= "      </div>";
       $lin_obj .= "       <div class='fixed_width_toolbar'>";
       $lin_obj .= "       <img class='dyn_search_field_close' id='dyn_search_part_tam_calcado__close_" . $ind . "' src='" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "' onclick=\"del_dyn_search('dyn_search_part_tam_calcado__" . $ind . "', " . $ind . ", 'only');buttonEnable_dyn('dyn_search');\">";
       $enabled = 'S';
       $lin_obj .= "         <input type='hidden' class='dyn_search_enabled' name='dyn_search_enabled_part_tam_calcado__" . $ind . "'  id='dyn_search_enabled_part_tam_calcado__" . $ind . "' value='" . $enabled . "' />";
       $lin_obj .= "       </div>";
       $lin_obj .= "     </div>";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne") {
           $lin_obj .= "     <script>";
           $lin_obj .= "        $( document ).ready(function() {buttonEnable_dyn('dyn_search');});";
           $lin_obj .= "     </script>";
       }
       return $lin_obj;
   }
   function dynamic_search_part_dt_nasc_($ind, $ajax, $opc="", $val=array(), $enabled = 'S')
   {
       $lin_obj  = "";
       $_classAlign = '';
       if (empty($opc))
       {
           $opc = "eq";
       }
       if ($opc=='bw')
       {
           $_classAlign = 'alignTop';
       }
       $lin_obj .= "     <div id='dyn_search_part_dt_nasc__" . $ind . "' class='align " . $_classAlign . " " . ($enabled=='S'?'':'disabled') . "'>";
       $lin_obj .= "      <i class='fa-solid fa-grip-lines-vertical drag_handle'></i>";
       $lin_obj .= "      <div class='fixed_width_select'>";
       $lin_obj .= "         <div class='width-constrain' style='display: '>";
       $lin_obj .= "         " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_dt_nasc_'] . "";
       $lin_obj .= "         </div>";
       $lin_obj .= "        </div>";
       $lin_obj .= "      <div class='fixed_width_conditions'>";
       $lin_obj .= "       <select id='dyn_search_part_dt_nasc__cond_" . $ind . "' name='cond_dyn_search_part_dt_nasc__" . $ind . "' class='scAppDivToolbarInput' style='vertical-align: middle;' onChange='buttonEnable_dyn(\"dyn_search\");dyn_search_change_bw(\"part_dt_nasc_\", $ind)'>";
       $selected = ($opc == "eq") ? " selected" : "";
       $lin_obj .= "        <option value='eq'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_exac'] . "</option>";
       $selected = ($opc == "gt") ? " selected" : "";
       $lin_obj .= "        <option value='gt'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_grtr'] . "</option>";
       $selected = ($opc == "lt") ? " selected" : "";
       $lin_obj .= "        <option value='lt'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_less'] . "</option>";
       $selected = ($opc == "bw") ? " selected" : "";
       $lin_obj .= "        <option value='bw'" . $selected . ">" . $this->Ini->Nm_lang['lang_srch_betw'] . "</option>";
       $lin_obj .= "       </select>";
       $lin_obj .= "      </div>";
       $display_in_1 = "''";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne")
       {
           $display_in_1 = "none";
       }
       $lin_obj .= "      <div class='fixed_width_input  '>";
       $lin_obj .= "        <span class='fixed_width_input_content' style='display:" . $display_in_1 . "'>";
       $Form_base          = "ddmmyyyy";
       $date_format_show   = "";
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
       $Tmp_date = $Arr_D;
       $date_format_show = str_replace("dd",   $this->Ini->Nm_lang['lang_othr_date_days'], $date_format_show);
       $date_format_show = str_replace("mm",   $this->Ini->Nm_lang['lang_othr_date_mnth'], $date_format_show);
       $date_format_show = str_replace("yyyy", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
       $date_format_show = str_replace("aaaa", $this->Ini->Nm_lang['lang_othr_date_year'], $date_format_show);
       $date_format_show = str_replace("hh",   $this->Ini->Nm_lang['lang_othr_date_hour'], $date_format_show);
       $date_format_show = str_replace("ii",   $this->Ini->Nm_lang['lang_othr_date_mint'], $date_format_show);
       $date_format_show = str_replace("ss",   $this->Ini->Nm_lang['lang_othr_date_scnd'], $date_format_show);
       $Place_holder = array('dd'=>'','mm'=>'','yyyy'=>'','hh'=>'','ii'=>'','ss'=>'');
       $val_r = $this->dyn_convert_date($val[0]);
       foreach ($Tmp_date as $Ind => $Part_date)
       {
            $AutoTab = (($Ind + 1) < count($Tmp_date)) ? "autoTab: true" : "autoTab: false";
           if (substr($Part_date, 0,1) == "y")
           {
               $val_cmp = (isset($val_r['ano'])) ? $val_r['ano'] : "";
               $lin_obj .= "     <input  type=\"text\" class='sc-js-input-dyn scFormObjectOdd scAppDivToolbarInput fixed_width_year_calendar' id='dyn_search_part_dt_nasc__ano_val_" . $ind . "' name='val_dyn_search_part_dt_nasc__ano_" . $ind . "' placeholder=\"" . $Place_holder['yyyy'] . "\" value=\"" . $this->form_encode_input($val_cmp) . "\" size=4  alt=\"{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, " . $AutoTab . ", enterTab: true}\" onChange=\"buttonEnable_dyn('dyn_search');\" size=4 alt=\"{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, " . $AutoTab . ", enterTab: false}\">";
           }
           if (substr($Part_date, 0,1) == "m")
           {
               $val_cmp = (isset($val_r['mes'])) ? $val_r['mes'] : "";
               $lin_obj .= "     <input  type=\"text\" class='sc-js-input-dyn scFormObjectOdd scAppDivToolbarInput fixed_width_date_calendar' id='dyn_search_part_dt_nasc__mes_val_" . $ind . "' name='val_dyn_search_part_dt_nasc__mes_" . $ind . "' placeholder=\"" . $Place_holder['mm'] . "\" value=\"" . $this->form_encode_input($val_cmp) . "\" size=2  alt=\"{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, " . $AutoTab . ", enterTab: true}\" onChange=\"buttonEnable_dyn('dyn_search');\" size=2 alt=\"{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, " . $AutoTab . ", enterTab: false}\">";
           }
           if (substr($Part_date, 0,1) == "d")
           {
               $val_cmp = (isset($val_r['dia'])) ? $val_r['dia'] : "";
               $lin_obj .= "     <input  type=\"text\" class='sc-js-input-dyn scFormObjectOdd scAppDivToolbarInput fixed_width_date_calendar' id='dyn_search_part_dt_nasc__dia_val_" . $ind . "' name='val_dyn_search_part_dt_nasc__dia_" . $ind . "' placeholder=\"" . $Place_holder['dd'] . "\" value=\"" . $this->form_encode_input($val_cmp) . "\" size=2  alt=\"{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, " . $AutoTab . ", enterTab: true}\" onChange=\"buttonEnable_dyn('dyn_search');\" size=2 alt=\"{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, " . $AutoTab . ", enterTab: false}\">";
           }
       }
       $lin_obj .= "     <input type=\"hidden\" id=\"sc_part_dt_nasc__jq_" . $ind . "\">";
       if ($opc == "bw")
       {
           $display_in_2 = "'block'";
       }
       else
       {
           $display_in_2 = "none";
       }
       $lin_obj .= "       <span id=\"dyn_part_dt_nasc__in_2_" . $ind . "\" style=\"margin-top: .4rem; display:" . $display_in_2 . "\">";
       $date_sep_bw = $this->Ini->Nm_lang['lang_srch_between_values'];
       if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($date_sep_bw))
       {
           $date_sep_bw = sc_convert_encoding($date_sep_bw, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
       $lin_obj .= "       <span style='margin: .4rem 0px; display:block;'></span>";
       $val_r = isset($val[1]) ? $this->dyn_convert_date($val[1]) : array();
       foreach ($Tmp_date as $Ind => $Part_date)
       {
            $AutoTab = (($Ind + 1) < count($Tmp_date)) ? "autoTab: true" : "autoTab: false";
           if (substr($Part_date, 0,1) == "y")
           {
               $val_cmp = (isset($val_r['ano'])) ? $val_r['ano'] : "";
               $lin_obj .= "     <input  type=\"text\" class='sc-js-input-dyn scFormObjectOdd scAppDivToolbarInput fixed_width_year_calendar' id='dyn_search_part_dt_nasc__v2__ano_val_" . $ind . "' name='val_dyn_search_part_dt_nasc__v2__ano_" . $ind . "' placeholder=\"" . $Place_holder['yyyy'] . "\" value=\"" . $this->form_encode_input($val_cmp) . "\" size=4  alt=\"{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, " . $AutoTab . ", enterTab: true}\" onChange=\"buttonEnable_dyn('dyn_search');\" size=4 alt=\"{datatype: 'mask', maskList: '9999', alignRight: true, maxLength: 4, " . $AutoTab . ", enterTab: false}\">";
           }
           if (substr($Part_date, 0,1) == "m")
           {
               $val_cmp = (isset($val_r['mes'])) ? $val_r['mes'] : "";
               $lin_obj .= "     <input  type=\"text\" class='sc-js-input-dyn scFormObjectOdd scAppDivToolbarInput fixed_width_date_calendar' id='dyn_search_part_dt_nasc__v2__mes_val_" . $ind . "' name='val_dyn_search_part_dt_nasc__v2__mes_" . $ind . "' placeholder=\"" . $Place_holder['mm'] . "\" value=\"" . $this->form_encode_input($val_cmp) . "\" size=2  alt=\"{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, " . $AutoTab . ", enterTab: true}\" onChange=\"buttonEnable_dyn('dyn_search');\" size=2 alt=\"{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, " . $AutoTab . ", enterTab: false}\">";
           }
           if (substr($Part_date, 0,1) == "d")
           {
               $val_cmp = (isset($val_r['dia'])) ? $val_r['dia'] : "";
               $lin_obj .= "     <input  type=\"text\" class='sc-js-input-dyn scFormObjectOdd scAppDivToolbarInput fixed_width_date_calendar' id='dyn_search_part_dt_nasc__v2__dia_val_" . $ind . "' name='val_dyn_search_part_dt_nasc__v2__dia_" . $ind . "' placeholder=\"" . $Place_holder['dd'] . "\" value=\"" . $this->form_encode_input($val_cmp) . "\" size=2  alt=\"{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, " . $AutoTab . ", enterTab: true}\" onChange=\"buttonEnable_dyn('dyn_search');\" size=2 alt=\"{datatype: 'mask', maskList: '99', alignRight: true, maxLength: 2, " . $AutoTab . ", enterTab: false}\">";
           }
       }
       $lin_obj .= "     <input type=\"hidden\" id=\"sc_part_dt_nasc__v2__jq_" . $ind . "\">";
       $lin_obj .= "       </span>";
       $lin_obj .= "        </span>";
       $lin_obj .= "      </div>";
       $lin_obj .= "       <div class='fixed_width_toolbar'>";
       $lin_obj .= "       <img class='dyn_search_field_close' id='dyn_search_part_dt_nasc__close_" . $ind . "' src='" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "' onclick=\"del_dyn_search('dyn_search_part_dt_nasc__" . $ind . "', " . $ind . ", 'only');buttonEnable_dyn('dyn_search');\">";
       $enabled = 'S';
       $lin_obj .= "         <input type='hidden' class='dyn_search_enabled' name='dyn_search_enabled_part_dt_nasc__" . $ind . "'  id='dyn_search_enabled_part_dt_nasc__" . $ind . "' value='" . $enabled . "' />";
       $lin_obj .= "       </div>";
       $lin_obj .= "     </div>";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne" || substr($opc, 0, 3) == "bi_") {
           $lin_obj .= "     <script>";
           $lin_obj .= "        $( document ).ready(function() {buttonEnable_dyn('dyn_search');});";
           $lin_obj .= "     </script>";
       }
       return $lin_obj;
   }
   function dynamic_search_part_id_evento_publico_($ind, $ajax, $opc="", $val=array(), $enabled = 'S')
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
       $lin_obj .= "     <div id='dyn_search_part_id_evento_publico__" . $ind . "' class='align " . $_classAlign . " " . ($enabled=='S'?'':'disabled') . "'>";
       $lin_obj .= "      <i class='fa-solid fa-grip-lines-vertical drag_handle'></i>";
       $lin_obj .= "      <div class='fixed_width_select'>";
       $lin_obj .= "         <div class='width-constrain' style='display: '>";
       $lin_obj .= "         " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_id_evento_publico_'] . "";
       $lin_obj .= "         </div>";
       $lin_obj .= "        </div>";
       $lin_obj .= "      <div class='fixed_width_conditions'>";
       $lin_obj .= "       <select id='dyn_search_part_id_evento_publico__cond_" . $ind . "' name='cond_dyn_search_part_id_evento_publico__" . $ind . "' class='scAppDivToolbarInput' style='vertical-align: middle;' onChange='buttonEnable_dyn(\"dyn_search\");dyn_search_hide_input(\"part_id_evento_publico_\", $ind)'>";
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
       $lin_obj .= "     <input  type=\"text\" class='sc-js-input-dyn scFormObjectOdd scAppDivToolbarInput' id='dyn_search_part_id_evento_publico__val_" . $ind . "' name='val_dyn_search_part_id_evento_publico__" . $ind . "' onChange=\"buttonEnable_dyn('dyn_search');\" value=\"" . $this->form_encode_input($val_cmp) . "\" size=11 alt=\"{datatype: 'decimal', maxLength: 11, precision: 0, decimalSep: '" . $_SESSION['scriptcase']['reg_conf']['dec_num'] . "', thousandsSep: '" . $_SESSION['scriptcase']['reg_conf']['grup_num'] . "', allowNegative: false, onlyNegative: false, enterTab: false}\" >";
       $lin_obj .= "        </span>";
       $lin_obj .= "      </div>";
       $lin_obj .= "       <div class='fixed_width_toolbar'>";
       $lin_obj .= "       <img class='dyn_search_field_close' id='dyn_search_part_id_evento_publico__close_" . $ind . "' src='" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "' onclick=\"del_dyn_search('dyn_search_part_id_evento_publico__" . $ind . "', " . $ind . ", 'only');buttonEnable_dyn('dyn_search');\">";
       $enabled = 'S';
       $lin_obj .= "         <input type='hidden' class='dyn_search_enabled' name='dyn_search_enabled_part_id_evento_publico__" . $ind . "'  id='dyn_search_enabled_part_id_evento_publico__" . $ind . "' value='" . $enabled . "' />";
       $lin_obj .= "       </div>";
       $lin_obj .= "     </div>";
       if ($opc == "nu" || $opc == "nn" || $opc == "ep" || $opc == "ne") {
           $lin_obj .= "     <script>";
           $lin_obj .= "        $( document ).ready(function() {buttonEnable_dyn('dyn_search');});";
           $lin_obj .= "     </script>";
       }
       return $lin_obj;
   }
   function dynamic_search_part_id_evento_regional_($ind, $ajax, $opc="", $val=array(), $enabled = 'S')
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
       $lin_obj .= "     <div id='dyn_search_part_id_evento_regional__" . $ind . "' class='align " . $_classAlign . " " . ($enabled=='S'?'':'disabled') . "'>";
       $lin_obj .= "      <i class='fa-solid fa-grip-lines-vertical drag_handle'></i>";
       $lin_obj .= "      <div class='fixed_width_select'>";
       $lin_obj .= "         <div class='width-constrain' style='display: '>";
       $lin_obj .= "         " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_id_evento_regional_'] . "";
       $lin_obj .= "         </div>";
       $lin_obj .= "        </div>";
       $lin_obj .= "      <div class='fixed_width_conditions'>";
       $lin_obj .= "       <select id='dyn_search_part_id_evento_regional__cond_" . $ind . "' name='cond_dyn_search_part_id_evento_regional__" . $ind . "' class='scAppDivToolbarInput' style='vertical-align: middle;' onChange='buttonEnable_dyn(\"dyn_search\");dyn_search_hide_input(\"part_id_evento_regional_\", $ind)'>";
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
       $lin_obj .= "     <input  type=\"text\" class='sc-js-input-dyn scFormObjectOdd scAppDivToolbarInput' id='dyn_search_part_id_evento_regional__val_" . $ind . "' name='val_dyn_search_part_id_evento_regional__" . $ind . "' onChange=\"buttonEnable_dyn('dyn_search');\" value=\"" . $this->form_encode_input($val_cmp) . "\" size=11 alt=\"{datatype: 'decimal', maxLength: 3, precision: 0, decimalSep: '" . $_SESSION['scriptcase']['reg_conf']['dec_num'] . "', thousandsSep: '" . $_SESSION['scriptcase']['reg_conf']['grup_num'] . "', allowNegative: false, onlyNegative: false, enterTab: false}\" >";
       $lin_obj .= "        </span>";
       $lin_obj .= "      </div>";
       $lin_obj .= "       <div class='fixed_width_toolbar'>";
       $lin_obj .= "       <img class='dyn_search_field_close' id='dyn_search_part_id_evento_regional__close_" . $ind . "' src='" . $this->Ini->path_botoes . "/" . $this->Ini->Img_qs_clean . "' onclick=\"del_dyn_search('dyn_search_part_id_evento_regional__" . $ind . "', " . $ind . ", 'only');buttonEnable_dyn('dyn_search');\">";
       $enabled = 'S';
       $lin_obj .= "         <input type='hidden' class='dyn_search_enabled' name='dyn_search_enabled_part_id_evento_regional__" . $ind . "'  id='dyn_search_enabled_part_id_evento_regional__" . $ind . "' value='" . $enabled . "' />";
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
                   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_and_or']['old'] as $_tmp)
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
                   if ($def['cmp'] == "part_id_evento_")
                   {
                       $this->Dyn_search_seq++;;
                       $this->Dyn_search_dat[$this->Dyn_search_seq] = "part_id_evento_";
                       $str_filhos .= $this->dynamic_search_part_id_evento_($this->Dyn_search_seq, 'N', $def['opc'], $def['val'], $chield['enabled']);
                   }
                   if ($def['cmp'] == "part_sexo_")
                   {
                       $this->Dyn_search_seq++;;
                       $this->Dyn_search_dat[$this->Dyn_search_seq] = "part_sexo_";
                       $str_filhos .= $this->dynamic_search_part_sexo_($this->Dyn_search_seq, 'N', $def['opc'], $def['val'], $chield['enabled']);
                   }
                   if ($def['cmp'] == "part_grupo_")
                   {
                       $this->Dyn_search_seq++;;
                       $this->Dyn_search_dat[$this->Dyn_search_seq] = "part_grupo_";
                       $str_filhos .= $this->dynamic_search_part_grupo_($this->Dyn_search_seq, 'N', $def['opc'], $def['val'], $chield['enabled']);
                   }
                   if ($def['cmp'] == "part_clube_")
                   {
                       $this->Dyn_search_seq++;;
                       $this->Dyn_search_dat[$this->Dyn_search_seq] = "part_clube_";
                       $str_filhos .= $this->dynamic_search_part_clube_($this->Dyn_search_seq, 'N', $def['opc'], $def['val'], $chield['enabled']);
                   }
                   if ($def['cmp'] == "part_empresa_")
                   {
                       $this->Dyn_search_seq++;;
                       $this->Dyn_search_dat[$this->Dyn_search_seq] = "part_empresa_";
                       $str_filhos .= $this->dynamic_search_part_empresa_($this->Dyn_search_seq, 'N', $def['opc'], $def['val'], $chield['enabled']);
                   }
                   if ($def['cmp'] == "part_uf_")
                   {
                       $this->Dyn_search_seq++;;
                       $this->Dyn_search_dat[$this->Dyn_search_seq] = "part_uf_";
                       $str_filhos .= $this->dynamic_search_part_uf_($this->Dyn_search_seq, 'N', $def['opc'], $def['val'], $chield['enabled']);
                   }
                   if ($def['cmp'] == "part_ddd_celular_01_")
                   {
                       $this->Dyn_search_seq++;;
                       $this->Dyn_search_dat[$this->Dyn_search_seq] = "part_ddd_celular_01_";
                       $str_filhos .= $this->dynamic_search_part_ddd_celular_01_($this->Dyn_search_seq, 'N', $def['opc'], $def['val'], $chield['enabled']);
                   }
                   if ($def['cmp'] == "part_tam_camisa_")
                   {
                       $this->Dyn_search_seq++;;
                       $this->Dyn_search_dat[$this->Dyn_search_seq] = "part_tam_camisa_";
                       $str_filhos .= $this->dynamic_search_part_tam_camisa_($this->Dyn_search_seq, 'N', $def['opc'], $def['val'], $chield['enabled']);
                   }
                   if ($def['cmp'] == "part_tam_calcado_")
                   {
                       $this->Dyn_search_seq++;;
                       $this->Dyn_search_dat[$this->Dyn_search_seq] = "part_tam_calcado_";
                       $str_filhos .= $this->dynamic_search_part_tam_calcado_($this->Dyn_search_seq, 'N', $def['opc'], $def['val'], $chield['enabled']);
                   }
                   if ($def['cmp'] == "part_dt_nasc_")
                   {
                       $this->Dyn_search_seq++;;
                       $this->Dyn_search_dat[$this->Dyn_search_seq] = "part_dt_nasc_";
                       $str_filhos .= $this->dynamic_search_part_dt_nasc_($this->Dyn_search_seq, 'N', $def['opc'], $def['val'], $chield['enabled']);
                   }
                   if ($def['cmp'] == "part_id_evento_publico_")
                   {
                       $this->Dyn_search_seq++;;
                       $this->Dyn_search_dat[$this->Dyn_search_seq] = "part_id_evento_publico_";
                       $str_filhos .= $this->dynamic_search_part_id_evento_publico_($this->Dyn_search_seq, 'N', $def['opc'], $def['val'], $chield['enabled']);
                   }
                   if ($def['cmp'] == "part_id_evento_regional_")
                   {
                       $this->Dyn_search_seq++;;
                       $this->Dyn_search_dat[$this->Dyn_search_seq] = "part_id_evento_regional_";
                       $str_filhos .= $this->dynamic_search_part_id_evento_regional_($this->Dyn_search_seq, 'N', $def['opc'], $def['val'], $chield['enabled']);
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['bdyn_and']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['bdyn_and']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['bdyn_and']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['bdyn_and']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['bdyn_and'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bdyn_and", "", "", "bdyn_and", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "data-role=togglebutton aria-value='AND' aria-pressed=" . $conditionAnd . "");?>
 
<?php
                      $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['bdyn_or']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['bdyn_or']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['bdyn_or']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['bdyn_or']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['bdyn_or'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bdyn_or", "", "", "bdyn_or", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "data-role=togglebutton aria-value='OR' aria-pressed=" . $conditionOr . "");?>
 
<?php
              echo $Cod_Btn_grp_end;              ?>          </span>              <?php                  $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['bdyn_addfields_nested']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['bdyn_addfields_nested']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['bdyn_addfields_nested']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['bdyn_addfields_nested']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['bdyn_addfields_nested'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bdyn_addfields_nested", "nm_show_dynamicsearch_fields_2(this); return false;", "nm_show_dynamicsearch_fields_2(this); return false;", "bdyn_addfields_nested", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
                  $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['bdyn_nested_add']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['bdyn_nested_add']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['bdyn_nested_add']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['bdyn_nested_add']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['bdyn_nested_add'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bdyn_nested_add", "addGroup(this);", "addGroup(this);", "bdyn_nested_add", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
                  $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['bdyn_nested_remove']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['bdyn_nested_remove']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['bdyn_nested_remove']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['bdyn_nested_remove']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['bdyn_nested_remove'];
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
       if(!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_and_or']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_and_or']['new'] = array('condition' => 'and', 'type'=>'ul', 'fields'=>'array()');
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_and_or']['old'] = array();
       }
       $contUl = 0;
       $contFields = 0;
       echo $this->dynamicSearchStartHtmlRec($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_and_or']['new'], 'dynamicSearchStart');
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
     Tab_evt_dyn_search['part_dt_nasc__mes'] =  'sc_form_participantes_rsvp_ar_valida_mes(this)';
     Tab_evt_dyn_search['part_dt_nasc__dia'] =  'sc_form_participantes_rsvp_ar_valida_dia(this)';
     Tab_evt_dyn_search['part_dt_nasc__v2__mes'] =  'sc_form_participantes_rsvp_ar_valida_mes(this)';
     Tab_evt_dyn_search['part_dt_nasc__v2__dia'] =  'sc_form_participantes_rsvp_ar_valida_dia(this)';
<?php
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ajax_nav']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ajax_nav'])
   { 
       $this->Ini->Arr_result['setArr'][] = array('var' => 'Tab_obj_dyn_search', 'value' => '');
       $this->Ini->Arr_result['setArr'][] = array('var' => 'Tab_evt_dyn_search', 'value' => '');
       $this->Ini->Arr_result['setVar'][] = array('var' => 'Tot_obj_dyn_search', 'value' => $this->Dyn_search_seq);
       foreach ($this->Dyn_search_dat as $seq => $cmp)
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'Tab_obj_dyn_search[' . $seq . ']', 'value' => $cmp);
       }
           $this->Ini->Arr_result['setVar'][] = array('var' => "Tab_evt_dyn_search['part_dt_nasc__mes']", 'value' => 'sc_form_participantes_rsvp_ar_valida_mes(this)');
           $this->Ini->Arr_result['setVar'][] = array('var' => "Tab_evt_dyn_search['part_dt_nasc__dia']", 'value' => 'sc_form_participantes_rsvp_ar_valida_dia(this)');
           $this->Ini->Arr_result['setVar'][] = array('var' => "Tab_evt_dyn_search['part_dt_nasc__v2__mes']", 'value' => 'sc_form_participantes_rsvp_ar_valida_mes(this)');
           $this->Ini->Arr_result['setVar'][] = array('var' => "Tab_evt_dyn_search['part_dt_nasc__v2__dia']", 'value' => 'sc_form_participantes_rsvp_ar_valida_dia(this)');
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
             if(Tab_obj_dyn_search[i] == 'part_id_evento_')
             {
                 $("#dyn_search_part_id_evento__" + i + " .fixed_width_select select").select2(
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
                 $("#dyn_search_part_id_evento__" + i + " .fixed_width_conditions select").select2(
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
             if(Tab_obj_dyn_search[i] == 'part_sexo_')
             {
                 $("#dyn_search_part_sexo__" + i + " .fixed_width_select select").select2(
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
                 $("#dyn_search_part_sexo__" + i + " .fixed_width_conditions select").select2(
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
             if(Tab_obj_dyn_search[i] == 'part_grupo_')
             {
                 $("#dyn_search_part_grupo__" + i + " .fixed_width_select select").select2(
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
                 $("#dyn_search_part_grupo__" + i + " .fixed_width_conditions select").select2(
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
             if(Tab_obj_dyn_search[i] == 'part_clube_')
             {
                 $("#dyn_search_part_clube__" + i + " .fixed_width_select select").select2(
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
                 $("#dyn_search_part_clube__" + i + " .fixed_width_conditions select").select2(
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
             if(Tab_obj_dyn_search[i] == 'part_empresa_')
             {
                 $("#dyn_search_part_empresa__" + i + " .fixed_width_select select").select2(
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
                 $("#dyn_search_part_empresa__" + i + " .fixed_width_conditions select").select2(
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
             if(Tab_obj_dyn_search[i] == 'part_uf_')
             {
                 $("#dyn_search_part_uf__" + i + " .fixed_width_select select").select2(
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
                 $("#dyn_search_part_uf__" + i + " .fixed_width_conditions select").select2(
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
             if(Tab_obj_dyn_search[i] == 'part_ddd_celular_01_')
             {
                 $("#dyn_search_part_ddd_celular_01__" + i + " .fixed_width_select select").select2(
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
                 $("#dyn_search_part_ddd_celular_01__" + i + " .fixed_width_conditions select").select2(
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
             if(Tab_obj_dyn_search[i] == 'part_tam_camisa_')
             {
                 $("#dyn_search_part_tam_camisa__" + i + " .fixed_width_select select").select2(
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
                 $("#dyn_search_part_tam_camisa__" + i + " .fixed_width_conditions select").select2(
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
             if(Tab_obj_dyn_search[i] == 'part_tam_calcado_')
             {
                 $("#dyn_search_part_tam_calcado__" + i + " .fixed_width_select select").select2(
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
                 $("#dyn_search_part_tam_calcado__" + i + " .fixed_width_conditions select").select2(
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
             if(Tab_obj_dyn_search[i] == 'part_dt_nasc_')
             {
                 $("#dyn_search_part_dt_nasc__" + i + " .fixed_width_select select").select2(
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
                 $("#dyn_search_part_dt_nasc__" + i + " .fixed_width_conditions select").select2(
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
             if(Tab_obj_dyn_search[i] == 'part_id_evento_publico_')
             {
                 $("#dyn_search_part_id_evento_publico__" + i + " .fixed_width_select select").select2(
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
                 $("#dyn_search_part_id_evento_publico__" + i + " .fixed_width_conditions select").select2(
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
             if(Tab_obj_dyn_search[i] == 'part_id_evento_regional_')
             {
                 $("#dyn_search_part_id_evento_regional__" + i + " .fixed_width_select select").select2(
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
                 $("#dyn_search_part_id_evento_regional__" + i + " .fixed_width_conditions select").select2(
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
 function sc_form_participantes_rsvp_ar_valida_mes(obj)
 {
     if (obj.value != "" && (obj.value < 1 || obj.value > 12))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_mnth'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { $(document.activeElement).focus(); obj.focus(); }, 10);
         }
     }
 }
 function sc_form_participantes_rsvp_ar_valida_dia(obj)
 {
     if (obj.value != "" && (obj.value < 1 || obj.value > 31))
     {
         if (confirm (Nm_erro['lang_jscr_ivdt'] +  " " + Nm_erro['lang_jscr_iday'] +  " " + Nm_erro['lang_jscr_wfix']))
         {
            Xfocus = setTimeout(function() { $(document.activeElement).focus(); obj.focus(); }, 10);
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
                 if (tmp == 'part_dt_nasc_')
                 {
                     cps[x] = 'part_dt_nasc__dia';
                     x++;
                     cps[x] = 'part_dt_nasc__mes';
                     x++;
                     cps[x] = 'part_dt_nasc__v2__dia';
                     x++;
                     cps[x] = 'part_dt_nasc__v2__mes';
                 }
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
         for (i = 1; i <= Tot_obj_dyn_search; i++)
         {
             if (Tab_obj_dyn_search[i] != 'NMSC_Dyn_Null' && (tp_carga == 'all' || tp_carga == i))
             {
                 tmp = Tab_obj_dyn_search[i];
                 if (tmp == 'part_dt_nasc_')
                 {
                     var i_calendar = i;
                     $('#sc_part_dt_nasc__jq_' + i).datepicker({
                        beforeShow: function(input, inst) {
                          var_dt_ini  = document.getElementById('dyn_search_part_dt_nasc__dia_val_' + i_calendar).value + '/';
                          var_dt_ini += document.getElementById('dyn_search_part_dt_nasc__mes_val_' + i_calendar).value + '/';
                          var_dt_ini += document.getElementById('dyn_search_part_dt_nasc__ano_val_' + i_calendar).value;
                          document.getElementById('sc_part_dt_nasc__jq_' + i_calendar).value = var_dt_ini;
                        },
                        onClose: function(dateText, inst) {
                          aParts  = dateText.split("/");
                          document.getElementById('dyn_search_part_dt_nasc__dia_val_' + i_calendar).value = aParts[0];
                          document.getElementById('dyn_search_part_dt_nasc__mes_val_' + i_calendar).value = aParts[1];
                          document.getElementById('dyn_search_part_dt_nasc__ano_val_' + i_calendar).value = aParts[2];
                        },
                        showWeek: true,
                        numberOfMonths: 1,
                        changeMonth: true,
                        changeYear: true,
                        yearRange: 'c-5:c+5',
                        dayNames: ["<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_sund"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_mond"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_tued"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_wend"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_thud"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_frid"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_satd"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>"],
                        dayNamesMin: ["<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_sund"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_mond"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_tued"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_wend"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_thud"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_frid"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_satd"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>"],
                        monthNamesShort: ["<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_janu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_febr"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_marc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_apri"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_mayy"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_june"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_july"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_augu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_sept"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_octo"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_nove"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_dece"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>"],
                        weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_days_sem"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>",
                        firstDay: <?php echo $this->jqueryCalendarWeekInit($_SESSION['scriptcase']['reg_conf']['date_week_ini']) ?>,
                        dateFormat: "<?php echo $this->jqueryCalendarDtFormat("ddmmyyyy", "/") ?>",
                        showOtherMonths: true,
                        showOn: "button",
                        buttonImage: "<?php echo $this->Ini->path_botoes . '/' . $this->arr_buttons['bcalendario']['image'] ?>",
                        buttonImageOnly: true
                     });
                     var i_calendar = i;
                     $('#sc_part_dt_nasc__v2__jq_' + i).datepicker({
                        beforeShow: function(input, inst) {
                          var_dt_ini  = document.getElementById('dyn_search_part_dt_nasc__v2__dia_val_' + i_calendar).value + '/';
                          var_dt_ini += document.getElementById('dyn_search_part_dt_nasc__v2__mes_val_' + i_calendar).value + '/';
                          var_dt_ini += document.getElementById('dyn_search_part_dt_nasc__v2__ano_val_' + i_calendar).value;
                          document.getElementById('sc_part_dt_nasc__v2__jq_' + i_calendar).value = var_dt_ini;
                        },
                        onClose: function(dateText, inst) {
                          aParts  = dateText.split("/");
                          document.getElementById('dyn_search_part_dt_nasc__v2__dia_val_' + i_calendar).value = aParts[0];
                          document.getElementById('dyn_search_part_dt_nasc__v2__mes_val_' + i_calendar).value = aParts[1];
                          document.getElementById('dyn_search_part_dt_nasc__v2__ano_val_' + i_calendar).value = aParts[2];
                        },
                        showWeek: true,
                        numberOfMonths: 1,
                        changeMonth: true,
                        changeYear: true,
                        yearRange: 'c-5:c+5',
                        dayNames: ["<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_sund"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_mond"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_tued"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_wend"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_thud"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_frid"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_days_satd"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>"],
                        dayNamesMin: ["<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_sund"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_mond"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_tued"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_wend"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_thud"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_frid"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_substr_days_satd"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>"],
                        monthNamesShort: ["<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_janu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_febr"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_marc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_apri"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_mayy"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_june"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_july"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_augu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_sept"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_octo"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_nove"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_mnth_dece"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>"],
                        weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_shrt_days_sem"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>",
                        firstDay: <?php echo $this->jqueryCalendarWeekInit($_SESSION['scriptcase']['reg_conf']['date_week_ini']) ?>,
                        dateFormat: "<?php echo $this->jqueryCalendarDtFormat("ddmmyyyy", "/") ?>",
                        showOtherMonths: true,
                        showOn: "button",
                        buttonImage: "<?php echo $this->Ini->path_botoes . '/' . $this->arr_buttons['bcalendario']['image'] ?>",
                        buttonImageOnly: true
                     });
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
     function dyn_search_change_bw(field, ind)
     {
        var index = document.getElementById('dyn_search_' + field + '_cond_' + ind).selectedIndex;
        var parm  = document.getElementById('dyn_search_' + field + '_cond_' + ind).options[index].value;
        if(parm == 'bw') $('#dyn_search_'+ field +'_' + ind).addClass('alignTop');
        else $('#dyn_search_'+ field +'_' + ind).removeClass('alignTop');
        if (parm == "bw")
        {
            $('#dyn_' + field + '_' + ind).css('display','');
            $('#dyn_' + field + '_in_2_' + ind).css('display','');
        }
        else
        {
            $('#dyn_' + field + '_in_2_' + ind).css('display','none');
            if (parm == "nu" || parm == "nn" || parm == "ep" || parm == "ne")
            {
                $('#dyn_search_' + field + '_' + ind+' .fixed_width_input_content').hide();
            }
            else
            {
                 $('#dyn_search_' + field + '_' + ind+' .fixed_width_input_content').show();
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
        ajax_add_dyn_search_js('part_id_evento_')
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

                 if (Tab_obj_dyn_search[i] == 'part_id_evento_')
                 {
                     result  = dyn_search_get_text(obj_dyn + i, '');
                 }
                 if (Tab_obj_dyn_search[i] == 'part_sexo_')
                 {
                     result  = dyn_search_get_text(obj_dyn + i, '');
                 }
                 if (Tab_obj_dyn_search[i] == 'part_grupo_')
                 {
                     result  = dyn_search_get_text(obj_dyn + i, '');
                 }
                 if (Tab_obj_dyn_search[i] == 'part_clube_')
                 {
                     result  = dyn_search_get_text(obj_dyn + i, '');
                 }
                 if (Tab_obj_dyn_search[i] == 'part_empresa_')
                 {
                     result  = dyn_search_get_text(obj_dyn + i, '');
                 }
                 if (Tab_obj_dyn_search[i] == 'part_uf_')
                 {
                     result  = dyn_search_get_text(obj_dyn + i, '');
                 }
                 if (Tab_obj_dyn_search[i] == 'part_ddd_celular_01_')
                 {
                     result  = dyn_search_get_text(obj_dyn + i, '');
                 }
                 if (Tab_obj_dyn_search[i] == 'part_tam_camisa_')
                 {
                     result  = dyn_search_get_text(obj_dyn + i, '');
                 }
                 if (Tab_obj_dyn_search[i] == 'part_tam_calcado_')
                 {
                     result  = dyn_search_get_text(obj_dyn + i, '');
                 }
                 if (Tab_obj_dyn_search[i] == 'part_dt_nasc_')
                 {
                     obj_dyn = 'dyn_search_' + Tab_obj_dyn_search[i];
                     result  = dyn_search_get_dt_h(obj_dyn, i, 'DT');
                     if(out_cond=='bw')
                         result += "_VLS2_" + dyn_search_get_dt_h(obj_dyn + "_v2_", i, 'DT');
                 }
                 if (Tab_obj_dyn_search[i] == 'part_id_evento_publico_')
                 {
                     result  = dyn_search_get_text(obj_dyn + i, '');
                 }
                 if (Tab_obj_dyn_search[i] == 'part_id_evento_regional_')
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
      url: "form_participantes_rsvp_ar.php",
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
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search'] = array();
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_refresh'] = array();
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
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search'][] = array('cmp' => $dats[0], 'opc' => $dats[1], 'val_formated' => $val_formated, 'val' => $val_sv, 'seq' => $dats[3]);
           $ix++;
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_and_or']['old'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search'];
       $this->NM_case_insensitive = true;
       $this->Dyn_Serarch_and_or = "and";
       $this->Cmd_Dyn_Search     = "";
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['cond_dyn_search'] = "";
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
           if ($dados['field'] == "part_id_evento_" && !empty($dados['vls']))
           {
               $Label_cmp     = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_id_evento_'];
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
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['decimal_db'] == ".")
                   {
                       $dados['vls'][0] = str_replace(",", ".", $dados['vls'][0]);
                   }
                   if ($dados['cond'] == "BW")
                   {
                       $dados['vls'][1] = str_replace($_SESSION['scriptcase']['reg_conf']['grup_num'], "", $dados['vls'][1]);
                       if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['decimal_db'] == ".")
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
               $this->SC_proc_dyn_search_all($dados['cond'], $dados['vls'], "part_id_evento", 'N', 'INT', $Label_cmp, false);
           }
           if ($dados['field'] == "part_sexo_" && !empty($dados['vls']))
           {
               $Label_cmp     = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_sexo_'];
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
               $this->SC_proc_dyn_search_all($dados['cond'], $dados['vls'], "part_sexo", 'A', 'ENUM', $Label_cmp, false);
           }
           if ($dados['field'] == "part_grupo_" && !empty($dados['vls']))
           {
               $Label_cmp     = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_grupo_'];
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
               $this->SC_proc_dyn_search_all($dados['cond'], $dados['vls'], "part_grupo", 'A', 'VARCHAR', $Label_cmp, false);
           }
           if ($dados['field'] == "part_clube_" && !empty($dados['vls']))
           {
               $Label_cmp     = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_clube_'];
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
               $this->SC_proc_dyn_search_all($dados['cond'], $dados['vls'], "part_clube", 'A', 'VARCHAR', $Label_cmp, false);
           }
           if ($dados['field'] == "part_empresa_" && !empty($dados['vls']))
           {
               $Label_cmp     = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_empresa_'];
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
               $this->SC_proc_dyn_search_all($dados['cond'], $dados['vls'], "part_empresa", 'A', 'VARCHAR', $Label_cmp, false);
           }
           if ($dados['field'] == "part_uf_" && !empty($dados['vls']))
           {
               $Label_cmp     = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_uf_'];
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
               $this->SC_proc_dyn_search_all($dados['cond'], $dados['vls'], "part_uf", 'A', 'VARCHAR', $Label_cmp, false);
           }
           if ($dados['field'] == "part_ddd_celular_01_" && !empty($dados['vls']))
           {
               $Label_cmp     = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_ddd_celular_01_'];
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
               $this->SC_proc_dyn_search_all($dados['cond'], $dados['vls'], "part_ddd_celular_01", 'A', 'VARCHAR', $Label_cmp, false);
           }
           if ($dados['field'] == "part_tam_camisa_" && !empty($dados['vls']))
           {
               $Label_cmp     = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_tam_camisa_'];
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
               $this->SC_proc_dyn_search_all($dados['cond'], $dados['vls'], "part_tam_camisa", 'A', 'VARCHAR', $Label_cmp, false);
           }
           if ($dados['field'] == "part_tam_calcado_" && !empty($dados['vls']))
           {
               $Label_cmp     = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_tam_calcado_'];
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
               $this->SC_proc_dyn_search_all($dados['cond'], $dados['vls'], "part_tam_calcado", 'A', 'VARCHAR', $Label_cmp, false);
           }
           if ($dados['field'] == "part_dt_nasc_" && !empty($dados['vls']))
           {
               $Label_cmp     = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_dt_nasc_'];
               if ($dados['cond'] != "BI_TP")
               {
                   $val[0] = $this->dyn_convert_date($dados['vls'][0]);
                   if ($dados['cond'] == "BW")
                   {
                       $val[1] = $this->dyn_convert_date($dados['vls'][1]);
                   }
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
                   {
                       $this->nm_prep_date($val, "DT", "DATETIME", $dados['cond'] , "");
                   }
                   else
                   {
                       $this->nm_prep_date($val, "DT", "DATE", $dados['cond'] , "");
                   }
                   $this->Val_format_1 = $val[0];
                   $this->nm_data->SetaData($this->Val_format_1, "YYYY-MM-DD");
                   $this->Val_format_1 = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                   if ($dados['cond'] == "BW")
                   {
                       $this->Val_BW_2     = $val[1];
                       $this->Val_format_2 = $val[1];
                       $this->nm_data->SetaData($this->Val_format_2, "YYYY-MM-DD");
                       $this->Val_format_2 = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
                   }
                   $this->SC_proc_dyn_search_all($dados['cond'], $val, "part_dt_nasc", 'DT', 'DATE', $Label_cmp, false);
               }
           }
           if ($dados['field'] == "part_id_evento_publico_" && !empty($dados['vls']))
           {
               $Label_cmp     = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_id_evento_publico_'];
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
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['decimal_db'] == ".")
                   {
                       $dados['vls'][0] = str_replace(",", ".", $dados['vls'][0]);
                   }
                   if ($dados['cond'] == "BW")
                   {
                       $dados['vls'][1] = str_replace($_SESSION['scriptcase']['reg_conf']['grup_num'], "", $dados['vls'][1]);
                       if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['decimal_db'] == ".")
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
               $this->SC_proc_dyn_search_all($dados['cond'], $dados['vls'], "part_id_evento_publico", 'N', 'INT', $Label_cmp, false);
           }
           if ($dados['field'] == "part_id_evento_regional_" && !empty($dados['vls']))
           {
               $Label_cmp     = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_search_label']['part_id_evento_regional_'];
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
                   if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['decimal_db'] == ".")
                   {
                       $dados['vls'][0] = str_replace(",", ".", $dados['vls'][0]);
                   }
                   if ($dados['cond'] == "BW")
                   {
                       $dados['vls'][1] = str_replace($_SESSION['scriptcase']['reg_conf']['grup_num'], "", $dados['vls'][1]);
                       if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['decimal_db'] == ".")
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
               $this->SC_proc_dyn_search_all($dados['cond'], $dados['vls'], "part_id_evento_regional", 'N', 'INT', $Label_cmp, false);
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
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_pesq_filtro'] = "( " . $this->Cmd_Dyn_Search . " )";
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_detal']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_detal']) && !empty($this->Cmd_Dyn_Search)) 
       {
           $this->Cmd_Dyn_Search = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_detal'] . " and (" .  $this->Cmd_Dyn_Search . ")";
       }
       $sc_where = "";
       if (empty($this->Cmd_Dyn_Search)) 
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_pesq_filtro'] = "";
       }
       else
       {
           $sc_where = " where " . $this->Cmd_Dyn_Search;
       }
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_pesq'] = $sc_where;
       $nmgp_select = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela . $sc_where; 
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
       $rt = $this->Db->Execute($nmgp_select) ; 
       if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
       { 
           $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
           exit ; 
       }  
       $qt_geral_reg_form_participantes_rsvp_ar = isset($rt->fields[0]) ? $rt->fields[0] - 1 : 0; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['total'] = $qt_geral_reg_form_participantes_rsvp_ar;
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_filter'] = $this->Cmd_Dyn_Search;
       $rt->Close(); 
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['cond_pesq'] = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['cond_dyn_search'] . $this->Dyn_Serarch_and_or;
       if (NM_is_utf8($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['cond_pesq']) && $_SESSION['scriptcase']['charset'] != "UTF-8")
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['cond_pesq'] = sc_convert_encoding($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['cond_pesq'], $_SESSION['scriptcase']['charset'], "UTF-8");
       }
      if (isset($rt->fields[0]) && $rt->fields[0] > 0 &&  isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['empty_filter']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['empty_filter'])
      {
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['empty_filter']);
          $this->NM_ajax_info['empty_filter'] = 'ok';
          form_participantes_rsvp_ar_pack_ajax_response();
          exit;
      }
       $tmp = '';
       if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['cond_pesq']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['cond_pesq']))
       {
           $tmp = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['cond_pesq'];
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
               $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['cond_dyn_search'] .= $lab . " " . $Lang_descr_final . " " . $nm_cond . "##*@@";
           }
           else
           {
               $this->Cmd_Dyn_Search .= "(" . $ini_lower . $sql . $end_lower . " in (" . $nm_cmd . "))";
               $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['cond_dyn_search'] .= $lab . " " . $Lang_descr_final . " " . $nm_cond . "##*@@";
           }
       }
   }
   function SC_proc_dyn_search_all($cond, $vls, $sql, $tp, $tsql, $lab, $tp_unaccent=false)
   {
       $nm_aspas  = "'";
       $nm_aspas1 = "'";
       if ($tp == "N" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['decimal_db'] == ".")
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
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['SC_sep_date']))
          {
              $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['SC_sep_date'];
              $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['SC_sep_date1'];
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
               $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['cond_dyn_search'] .= $nm_cond;
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
       $nmgp_saida_form = "form_participantes_rsvp_ar_fim.php";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['redir']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['redir'] == 'redir')
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']);
   }
   unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['opc_ant']);
   if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['nm_run_menu']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['nm_run_menu'] == 1)
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['nm_run_menu'] = 2;
       $nmgp_saida_form = "form_participantes_rsvp_ar_fim.php";
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
       form_participantes_rsvp_ar_pack_ajax_response();
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
   if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_modal'])
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
if ($tipo == 2 && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['masterValue']);
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
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['mostra_cab']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['mostra_cab'] == "N") {
            return;
        }
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['maximized']) {
            return;
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['link_info']['compact_mode']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['link_info']['compact_mode']) {
            return;
        }
?>
    <tr id="sc_form_head"><td class="sc-app-header">
<?php if (!empty($_SESSION['scriptcase']['proc_mobile'])) { ?>
<style>
    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}
</style>
<div class="scFormHeader" style="height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;">
    <div class="scFormHeaderFont" style="float: left; text-transform: uppercase;"><?php if ($this->nmgp_opcao == "novo") { echo "Ações Rápidas Participantes"; } else { echo "Ações Rápidas Participantes"; } ?></div>
    <div class="scFormHeaderFont" style="float: right;"><?php echo date($this->dateDefaultFormat()); ?></div>
</div>
<?php } else { ?>
<style>
    .scMenuTHeaderFont img, .scGridHeaderFont img , .scFormHeaderFont img , .scTabHeaderFont img , .scContainerHeaderFont img , .scFilterHeaderFont img { height:23px;}
</style>
<div class="scFormHeader" style="height: 54px; padding: 17px 15px; box-sizing: border-box;margin: -1px 0px 0px 0px;width: 100%;">
    <div class="scFormHeaderFont" style="float: left; text-transform: uppercase;"><?php if ($this->nmgp_opcao == "novo") { echo "Ações Rápidas Participantes"; } else { echo "Ações Rápidas Participantes"; } ?></div>
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
        if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "R") {
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
                'total' == $this->form_paginacao ? 1 : $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] + 1,
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] + $this->summary_record_count,
                $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['total'] + 1,
            ],
            $summaryLine
        );

        return $summaryLine;
    } // getSummaryLine

    function scGetColumnOrderRule($fieldName, &$orderColName, &$orderColOrient, &$orderColRule)
    {
        $sortRule = 'nosort';
        if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_cmp'] == $fieldName) {
            $orderColName = $fieldName;
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['ordem_ord'] == " desc") {
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
            case "part_id_evento":
                return true;
            case "part_id_evento_publico":
                return true;
            case "participante_id":
                return true;
            case "part_cod_usuario":
                return true;
            case "part_bloqueio_id":
                return true;
            default:
                return false;
        }
        return false;
    }

    function scGetDefaultFieldOrder($fieldName)
    {
        switch ($fieldName) {
            case "part_id_evento":
                return 'desc';
            case "part_dt_nasc":
                return 'desc';
            case "participante_id":
                return 'desc';
            case "part_validade_pass":
                return 'desc';
            case "part_cod_usuario":
                return 'desc';
            case "part_dt_cadastro":
                return 'desc';
            case "part_dt_alteracao":
                return 'desc';
            case "part_dt_alt_contato_rsvp":
                return 'desc';
            case "part_dt_alt_presenca":
                return 'desc';
            case "part_dt_solicit_especial":
                return 'desc';
            case "part_dt_programacao":
                return 'desc';
            case "part_dt_aereo":
                return 'desc';
            case "par_dt_hospedagem":
                return 'desc';
            case "part_dt_transfer":
                return 'desc';
            case "part_dt_opcionais":
                return 'desc';
            case "part_save_the_date":
                return 'desc';
            case "part_bloqueio_id":
                return 'desc';
            default:
                return 'asc';
        }
        return 'asc';
    }

}
?>
