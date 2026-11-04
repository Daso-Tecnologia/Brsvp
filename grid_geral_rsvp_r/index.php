<?php
   include_once('grid_geral_rsvp_r_session.php');
   @ini_set('session.cookie_httponly', 1);
   @ini_set('session.use_only_cookies', 1);
   @ini_set('session.cookie_secure', 1);
   @ini_set('session.cookie_samesite', 'None');
   @session_start() ;
   $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_perfil']          = "conn_mysql";
   $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_prod']       = "";
   $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_conf']       = "";
   $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_imagens']    = "";
   $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_imag_temp']  = "";
   $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_cache']      = "";
   $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_doc']        = "";
    //check publication with the prod
    $NM_dir_atual = getcwd();
    if (empty($NM_dir_atual))
    {
        $str_path_sys          = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
        $str_path_sys          = str_replace("\\", '/', $str_path_sys);
    }
    else
    {
        $sc_nm_arquivo         = explode("/", $_SERVER['PHP_SELF']);
        $str_path_sys          = str_replace("\\", "/", getcwd()) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
    }
    $str_path_apl_url = $_SERVER['PHP_SELF'];
    $str_path_apl_url = str_replace("\\", '/', $str_path_apl_url);
    $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/"));
    $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/")+1);
    $str_path_apl_dir = substr($str_path_sys, 0, strrpos($str_path_sys, "/"));
    $str_path_apl_dir = substr($str_path_apl_dir, 0, strrpos($str_path_apl_dir, "/")+1);
    //check prod
    if(empty($_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_prod']))
    {
            /*check prod*/$_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_prod'] = $str_path_apl_url . "_lib/prod";
    }
    //check img
    if(empty($_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_imagens']))
    {
            /*check img*/$_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_imagens'] = $str_path_apl_url . "_lib/file/img";
    }
    //check tmp
    if(empty($_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_imag_temp']))
    {
            /*check tmp*/$_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_imag_temp'] = $str_path_apl_url . "_lib/tmp";
    }
    //check cache
    if(empty($_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_cache']))
    {
            /*check tmp*/$_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_cache'] = $str_path_apl_dir . "_lib/file/cache";
    }
    //check doc
    if(empty($_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_doc']))
    {
            /*check doc*/$_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_doc'] = $str_path_apl_dir . "_lib/file/doc";
    }
    //end check publication with the prod
//
class grid_geral_rsvp_r_ini
{
   var $nm_cod_apl;
   var $nm_nome_apl;
   var $nm_seguranca;
   var $nm_grupo;
   var $nm_autor;
   var $nm_versao_sc;
   var $nm_tp_lic_sc;
   var $nm_dt_criacao;
   var $nm_hr_criacao;
   var $nm_autor_alt;
   var $nm_dt_ult_alt;
   var $nm_hr_ult_alt;
   var $nm_timestamp;
   var $nm_app_version;
   var $cor_link_dados;
   var $root;
   var $server;
   var $java_protocol;
   var $server_pdf;
   var $Arr_result;
   var $sc_protocolo;
   var $path_prod;
   var $path_link;
   var $path_aplicacao;
   var $path_embutida;
   var $path_botoes;
   var $path_img_global;
   var $path_img_modelo;
   var $path_icones;
   var $path_imagens;
   var $path_imag_cab;
   var $path_imag_temp;
   var $path_libs;
   var $path_doc;
   var $str_lang;
   var $str_conf_reg;
   var $str_schema_all;
   var $Str_btn_grid;
   var $str_google_fonts;
   var $str_schema_filter;
   var $Str_btn_filter;
   var $path_cep;
   var $path_secure;
   var $path_js;
   var $path_help;
   var $path_adodb;
   var $path_grafico;
   var $path_atual;
   var $Gd_missing;
   var $sc_site_ssl;
   var $SC_Lig_Edit_Apl;
   var $nm_cont_lin;
   var $nm_limite_lin;
   var $nm_limite_lin_prt;
   var $nm_limite_lin_res;
   var $nm_limite_lin_res_prt;
   var $Qtd_reg_ajax_grid;
   var $nm_falta_var;
   var $nm_falta_var_db;
   var $nm_tpbanco;
   var $nm_servidor;
   var $nm_usuario;
   var $nm_senha;
   var $nm_database_encoding;
   var $nm_arr_db_extra_args = array();
   var $nm_con_db2 = array();
   var $nm_con_persistente;
   var $nm_con_use_schema;
   var $nm_tabela;
   var $nm_ger_css_emb;
   var $nm_col_dinamica   = array();
   var $nm_order_dinamico = array();
   var $nm_hidden_blocos  = array();
   var $sc_tem_trans_banco;
   var $nm_bases_all;
   var $nm_bases_access;
   var $nm_bases_db2;
   var $nm_bases_ibase;
   var $nm_bases_informix;
   var $nm_bases_mssql;
   var $nm_bases_mysql;
   var $nm_bases_postgres;
   var $nm_bases_oracle;
   var $nm_bases_sqlite;
   var $nm_bases_sybase;
   var $nm_bases_vfp;
   var $nm_bases_odbc;
   var $nm_bases_progress;
   var $sc_page;
   var $sc_lig_md5 = array();
   var $sc_lig_target = array();
   var $sc_export_ajax = false;
   var $sc_export_ajax_img = false;
   var $force_db_utf8 = true;
//
   function init($Tp_init = "")
   {
       global
             $nm_url_saida, $nm_apl_dependente, $script_case_init, $nmgp_opcao;

      if (!function_exists("sc_check_mobile"))
      {
          include_once("../_lib/lib/php/nm_check_mobile.php");
      }
          include_once("../_lib/lib/php/fix.php");
      $_SESSION['scriptcase']['proc_mobile'] = sc_check_mobile();
        if (isset($_GET['_sc_force_mobile'])) {
            $_SESSION['scriptcase']['force_mobile'] = 'Y' == $_GET['_sc_force_mobile'];
        }
        if (isset($_SESSION['scriptcase']['force_mobile'])) {
            $_SESSION['scriptcase']['proc_mobile'] = $_SESSION['scriptcase']['force_mobile'];
        }
      @ini_set('magic_quotes_runtime', 0);
      $this->sc_page = $script_case_init;
      $_SESSION['scriptcase']['sc_num_page'] = $script_case_init;
      $_SESSION['scriptcase']['sc_cnt_sql']  = 0;
      $this->sc_charset['UTF-8'] = 'utf-8';
      $this->sc_charset['ISO-2022-JP'] = 'iso-2022-jp';
      $this->sc_charset['ISO-2022-KR'] = 'iso-2022-kr';
      $this->sc_charset['ISO-8859-1'] = 'iso-8859-1';
      $this->sc_charset['ISO-8859-2'] = 'iso-8859-2';
      $this->sc_charset['ISO-8859-3'] = 'iso-8859-3';
      $this->sc_charset['ISO-8859-4'] = 'iso-8859-4';
      $this->sc_charset['ISO-8859-5'] = 'iso-8859-5';
      $this->sc_charset['ISO-8859-6'] = 'iso-8859-6';
      $this->sc_charset['ISO-8859-7'] = 'iso-8859-7';
      $this->sc_charset['ISO-8859-8'] = 'iso-8859-8';
      $this->sc_charset['ISO-8859-8-I'] = 'iso-8859-8-i';
      $this->sc_charset['ISO-8859-9'] = 'iso-8859-9';
      $this->sc_charset['ISO-8859-10'] = 'iso-8859-10';
      $this->sc_charset['ISO-8859-13'] = 'iso-8859-13';
      $this->sc_charset['ISO-8859-14'] = 'iso-8859-14';
      $this->sc_charset['ISO-8859-15'] = 'iso-8859-15';
      $this->sc_charset['WINDOWS-1250'] = 'windows-1250';
      $this->sc_charset['WINDOWS-1251'] = 'windows-1251';
      $this->sc_charset['WINDOWS-1252'] = 'windows-1252';
      $this->sc_charset['TIS-620'] = 'tis-620';
      $this->sc_charset['WINDOWS-1253'] = 'windows-1253';
      $this->sc_charset['WINDOWS-1254'] = 'windows-1254';
      $this->sc_charset['WINDOWS-1255'] = 'windows-1255';
      $this->sc_charset['WINDOWS-1256'] = 'windows-1256';
      $this->sc_charset['WINDOWS-1257'] = 'windows-1257';
      $this->sc_charset['KOI8-R'] = 'koi8-r';
      $this->sc_charset['BIG-5'] = 'big5';
      $this->sc_charset['EUC-CN'] = 'EUC-CN';
      $this->sc_charset['GB18030'] = 'GB18030';
      $this->sc_charset['GB2312'] = 'gb2312';
      $this->sc_charset['EUC-JP'] = 'euc-jp';
      $this->sc_charset['SJIS'] = 'shift-jis';
      $this->sc_charset['EUC-KR'] = 'euc-kr';
      $_SESSION['scriptcase']['charset_entities']['UTF-8'] = 'UTF-8';
      $_SESSION['scriptcase']['charset_entities']['ISO-8859-1'] = 'ISO-8859-1';
      $_SESSION['scriptcase']['charset_entities']['ISO-8859-5'] = 'ISO-8859-5';
      $_SESSION['scriptcase']['charset_entities']['ISO-8859-15'] = 'ISO-8859-15';
      $_SESSION['scriptcase']['charset_entities']['WINDOWS-1251'] = 'cp1251';
      $_SESSION['scriptcase']['charset_entities']['WINDOWS-1252'] = 'cp1252';
      $_SESSION['scriptcase']['charset_entities']['BIG-5'] = 'BIG5';
      $_SESSION['scriptcase']['charset_entities']['EUC-CN'] = 'GB2312';
      $_SESSION['scriptcase']['charset_entities']['GB2312'] = 'GB2312';
      $_SESSION['scriptcase']['charset_entities']['SJIS'] = 'Shift_JIS';
      $_SESSION['scriptcase']['charset_entities']['EUC-JP'] = 'EUC-JP';
      $_SESSION['scriptcase']['charset_entities']['KOI8-R'] = 'KOI8-R';
      $_SESSION['scriptcase']['trial_version'] = 'N';
      $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['decimal_db'] = "."; 
      $this->nm_cod_apl      = "grid_geral_rsvp_r"; 
      $this->nm_nome_apl     = ""; 
      $this->nm_seguranca    = ""; 
      $this->nm_grupo        = "NRSVP115_10_AWS_APP"; 
      $this->nm_grupo_versao = "1"; 
      $this->nm_autor        = "admin"; 
      $this->nm_script_by    = "netmake";
      $this->nm_script_type  = "PHP";
      $this->nm_versao_sc    = "v10"; 
      $this->nm_tp_lic_sc    = "sb_bronze"; 
      $this->nm_dt_criacao   = "20231207"; 
      $this->nm_hr_criacao   = "134340"; 
      $this->nm_autor_alt    = "admin"; 
      $this->nm_dt_ult_alt   = "20260831"; 
      $this->nm_hr_ult_alt   = "164048"; 
      $this->Apl_paginacao   = "PARCIAL"; 
      $temp_bug_list         = explode(" ", microtime()); 
      list($NM_usec, $NM_sec) = $temp_bug_list; 
      $this->nm_timestamp    = (float) $NM_sec; 
      $this->nm_app_version  = "1.0.0";
      $this->nm_tp_variance  = "P";
// 
// 
      $NM_dir_atual = getcwd();
      if (empty($NM_dir_atual))
      {
          $str_path_sys          = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
          $str_path_sys          = str_replace("\\", '/', $str_path_sys);
      }
      else
      {
          $sc_nm_arquivo         = explode("/", $_SERVER['PHP_SELF']);
          $str_path_sys          = str_replace("\\", "/", getcwd()) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
      }
      $this->sc_site_ssl     = $this->appIsSsl();
      $this->sc_protocolo    = $this->sc_site_ssl ? 'https://' : 'http://';
      $this->sc_protocolo    = "";
      $this->path_prod       = $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_prod'];
      $this->path_conf       = $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_conf'];
      $this->path_imagens    = $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_imagens'];
      $this->path_imag_temp  = $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_imag_temp'];
      $this->path_cache  = $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_cache'];
      $this->path_doc        = $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_doc'];
      if (!isset($_SESSION['scriptcase']['str_lang']) || empty($_SESSION['scriptcase']['str_lang']))
      {
          $_SESSION['scriptcase']['str_lang'] = "pt_br";
      }
      if (!isset($_SESSION['scriptcase']['str_conf_reg']) || empty($_SESSION['scriptcase']['str_conf_reg']))
      {
          $_SESSION['scriptcase']['str_conf_reg'] = "pt_br";
      }
      $this->str_lang        = $_SESSION['scriptcase']['str_lang'];
      $this->str_conf_reg    = $_SESSION['scriptcase']['str_conf_reg'];
      if (!isset($_SESSION['scriptcase']['grid_geral_rsvp_r']['save_session']['save_grid_state_session']))
      { 
          $_SESSION['scriptcase']['grid_geral_rsvp_r']['save_session']['save_grid_state_session'] = false;
          $_SESSION['scriptcase']['grid_geral_rsvp_r']['save_session']['data'] = '';
      } 
      $this->str_schema_all    = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_Rhino/Sc9_Rhino";
      $this->str_schema_filter = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_Rhino/Sc9_Rhino";
      if (isset($_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['sub_cons_schema_all']))
      { 
         $this->str_schema_all    = $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['sub_cons_schema_all'];
         $this->str_schema_filter = $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['sub_cons_schema_filter'];
      } 
      $_SESSION['scriptcase']['erro']['str_schema'] = $this->str_schema_all . "_error.css";
      $_SESSION['scriptcase']['erro']['str_lang']   = $this->str_lang;
      $this->server          = (!isset($_SERVER['HTTP_HOST'])) ? $_SERVER['SERVER_NAME'] : $_SERVER['HTTP_HOST'];
      if (!isset($_SERVER['HTTP_HOST']) && isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != 80 && !$this->sc_site_ssl )
      {
          $this->server         .= ":" . $_SERVER['SERVER_PORT'];
      }
      $this->java_protocol   = ($this->sc_site_ssl) ? 'https://' : 'http://';
      $this->server_pdf      = $this->java_protocol . $this->server;
      $this->server          = "";
      $str_path_web          = $_SERVER['PHP_SELF'];
      $str_path_web          = str_replace("\\", '/', $str_path_web);
      $str_path_web          = str_replace('//', '/', $str_path_web);
      $this->root            = substr($str_path_sys, 0, -1 * strlen($str_path_web));
      $this->path_aplicacao  = substr($str_path_sys, 0, strrpos($str_path_sys, '/'));
      $this->path_aplicacao  = substr($this->path_aplicacao, 0, strrpos($this->path_aplicacao, '/')) . '/grid_geral_rsvp_r';
      $this->path_embutida   = substr($this->path_aplicacao, 0, strrpos($this->path_aplicacao, '/') + 1);
      $this->path_aplicacao .= '/';
      $this->path_link       = substr($str_path_web, 0, strrpos($str_path_web, '/'));
      $this->path_link       = substr($this->path_link, 0, strrpos($this->path_link, '/')) . '/';
      $this->path_botoes     = $this->path_link . "_lib/img";
      $this->path_img_global = $this->path_link . "_lib/img";
      $this->path_img_modelo = $this->path_link . "_lib/img";
      $this->path_icones     = $this->path_link . "_lib/img";
      $this->path_imag_cab   = $this->path_link . "_lib/img";
      $this->path_help       = $this->path_link . "_lib/webhelp/";
      $this->path_font       = $this->root . $this->path_link . "_lib/font/";
      $this->path_btn        = $this->root . $this->path_link . "_lib/buttons/";
      $this->path_css        = $this->root . $this->path_link . "_lib/css/";
      $this->path_lib_php    = $this->root . $this->path_link . "_lib/lib/php";
      $this->path_lib_js     = $this->root . $this->path_link . "_lib/lib/js";
      $pos_path = strrpos($this->path_prod, "/");
      $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['path_grid_sv'] = $this->root . substr($this->path_prod, 0, $pos_path) . "/conf/grid_sv/";
      $this->path_lang       = "../_lib/lang/";
      $this->path_lang_js    = "../_lib/js/";
      $this->path_chart_theme = $this->root . $this->path_link . "_lib/chart/";
      $this->path_cep        = $this->path_prod . "/cep";
      $this->path_cor        = $this->path_prod . "/cor";
      $this->path_js         = $this->path_prod . "/lib/js";
      $this->path_libs       = $this->root . $this->path_prod . "/lib/php";
      $this->path_third      = $this->root . $this->path_prod . "/third";
      $this->path_adodb      = $this->root . $this->path_prod . "/third/adodb";
      $_SESSION['scriptcase']['dir_temp'] = $this->root . $this->path_imag_temp;
      $this->Cmp_Sql_Time     = array('hora_saida_ida','hora_chegada_ida','hora_saida_volta','hora_chegada_volta','hr_chegada_proprio');

      include("../_lib/css/" . $this->str_schema_all . "_grid.php");
      $temp_Str_btn_grid    = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
      include($this->path_btn . $temp_Str_btn_grid);
      $this->css_help_tooltip_faicon = isset($css_help_tooltip_faicon) && '' != trim($css_help_tooltip_faicon) ? trim($css_help_tooltip_faicon) : "fa fa-question-circle";
      $this->css_schema_info_tooltiptheme = isset($css_schema_info_tooltiptheme) && '' != trim($css_schema_info_tooltiptheme)  ? trim($css_schema_info_tooltiptheme) : "";
      $this->tippy_themes = [];
      $this->tippy_theme_default = '';
      if ('' != $this->css_schema_info_tooltiptheme) {
          $this->scGetTippyCssTheme($this->tippy_themes, $this->css_schema_info_tooltiptheme);
          $this->tippy_theme_default = $this->css_schema_info_tooltiptheme;
      }

      if (isset($_SESSION['scriptcase']['grid_geral_rsvp_r']['session_timeout']['lang'])) {
          $this->str_lang = $_SESSION['scriptcase']['grid_geral_rsvp_r']['session_timeout']['lang'];
      }
      elseif (!isset($_SESSION['scriptcase']['grid_geral_rsvp_r']['actual_lang']) || $_SESSION['scriptcase']['grid_geral_rsvp_r']['actual_lang'] != $this->str_lang) {
          $_SESSION['scriptcase']['grid_geral_rsvp_r']['actual_lang'] = $this->str_lang;
          setcookie('sc_actual_lang_NRSVP115_10_AWS_APP',$this->str_lang,'0','/', '', ini_get('session.cookie_secure'), ini_get('session.cookie_httponly'));
      }
      $_SESSION['scriptcase']['fusioncharts_new'] = true;
      if (!isset($_SESSION['scriptcase']['phantomjs_charts']))
      {
          $_SESSION['scriptcase']['phantomjs_charts'] = @is_dir($this->path_third . '/phantomjs');
      }
      if (isset($_SESSION['scriptcase']['phantomjs_charts']))
      {
          $aTmpOS = $this->getRunningOS();
          $_SESSION['scriptcase']['phantomjs_charts'] = @is_dir($this->path_third . '/phantomjs/' . $aTmpOS['os']);
      }
      if (!class_exists('Services_JSON'))
      {
          include_once("grid_geral_rsvp_r_json.php");
      }
      $this->SC_Link_View = (isset($_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['SC_Link_View'])) ? $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['SC_Link_View'] : false;
      if (isset($_GET['SC_Link_View']) && !empty($_GET['SC_Link_View']) && is_numeric($_GET['SC_Link_View']))
      {
          if ($_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['embutida'])
          {
              $this->SC_Link_View = true;
              $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['SC_Link_View'] = true;
          }
      }
            if (isset($_POST['nmgp_opcao']) && 'ajax_check_file' == $_POST['nmgp_opcao'] ){
                 include_once("../_lib/lib/php/nm_api.php"); 
            switch( $_REQUEST['rsargs'] ){
               default:
                   echo 0;exit;
               break;
               }

    $out1_img_cache = $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_imag_temp'] . $file_name;
    $orig_img = $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_imag_temp']. '/'.basename($_POST['AjaxCheckImg']);
    copy($__file_download, $_SERVER['DOCUMENT_ROOT'].$orig_img);
    echo $orig_img . '_@@NM@@_';
    if(file_exists($out1_img_cache)){
        echo $out1_img_cache;
        exit;
    }

         include_once("../_lib/lib/php/nm_trata_img.php");
            copy($__file_download, $_SERVER['DOCUMENT_ROOT'].$out1_img_cache);
            $sc_obj_img = new nm_trata_img($_SERVER['DOCUMENT_ROOT'].$out1_img_cache, true);

            if(!empty($img_width) && !empty($img_height)){
                $sc_obj_img->setWidth($img_width);
                $sc_obj_img->setHeight($img_height);
            }            $sc_obj_img->createImg($_SERVER['DOCUMENT_ROOT'].$out1_img_cache);
            echo $out1_img_cache;
               exit;
            }
    if (!$_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['embutida'])
    {
      if (isset($_POST['nmgp_opcao']) && $_POST['nmgp_opcao'] == "ajax_add_grid_search")
      {
          $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['grid_search_add']['cmp'] = $_POST['parm'];
          $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['grid_search_add']['seq'] = $_POST['seq'];
          $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['opcao'] = $_POST['origem'];
          $nmgp_opcao = $_POST['origem'];
      }
      if (isset($_GET['nmgp_opcao']) && $_GET['nmgp_opcao'] == "ajax_aut_comp_dyn_search")
      {
          $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dyn_search_aut_comp']['cmp'] = $_GET['field'];
          $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['opcao'] = $_GET['origem'];
          $nmgp_opcao = $_GET['origem'];
      }
    }
      if (isset($_POST['nmgp_opcao']) && $_POST['nmgp_opcao'] == "ajax_save_ancor")
      {
          $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['ancor_save'] = $_POST['ancor_save'];
          $oJson = new Services_JSON();
          if ($_SESSION['scriptcase']['sem_session']) {
              unset($_SESSION['sc_session']);
          }
          exit;
      }
      if (isset($_SESSION['scriptcase']['user_logout']))
      {
          foreach ($_SESSION['scriptcase']['user_logout'] as $ind => $parms)
          {
              if (isset($_SESSION[$parms['V']]) && $_SESSION[$parms['V']] == $parms['U'])
              {
                  unset($_SESSION['scriptcase']['user_logout'][$ind]);
                  $nm_apl_dest = $parms['R'];
                  $dir = explode("/", $nm_apl_dest);
                  if (count($dir) == 1)
                  {
                      $nm_apl_dest = str_replace(".php", "", $nm_apl_dest);
                      $nm_apl_dest = $this->path_link . SC_dir_app_name($nm_apl_dest) . "/";
                  }
                  if (isset($_POST['nmgp_opcao']) && ($_POST['nmgp_opcao'] == "ajax_event" || $_POST['nmgp_opcao'] == "ajax_navigate"))
                  {
                      $this->Arr_result = array();
                      $this->Arr_result['redirInfo']['action']              = $nm_apl_dest;
                      $this->Arr_result['redirInfo']['target']              = $parms['T'];
                      $this->Arr_result['redirInfo']['metodo']              = "post";
                      $this->Arr_result['redirInfo']['script_case_init']    = $this->sc_page;
                      $oJson = new Services_JSON();
                      echo $oJson->encode($this->Arr_result);
                      exit;
                  }
?>
                  <html>
                  <body>
                  <form name="FRedirect" method="POST" action="<?php echo $nm_apl_dest; ?>" target="<?php echo $parms['T']; ?>">
                  </form>
                  <script>
                   document.FRedirect.submit();
                  </script>
                  </body>
                  </html>
<?php
                  exit;
              }
          }
      }
      global $under_dashboard, $dashboard_app, $own_widget, $parent_widget, $compact_mode, $width_100, $remove_margin, $remove_border, $remove_background;
      if (!isset($_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['under_dashboard']))
      {
          $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['under_dashboard'] = false;
          $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['dashboard_app']   = '';
          $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['own_widget']      = '';
          $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['parent_widget']   = '';
          $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['compact_mode']    = false;
          $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['width_100']       = false;
          $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['remove_margin']   = false;
          $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['remove_border']   = false;
          $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['remove_background'] = false;
      }
      if (isset($_GET['under_dashboard']) && 1 == $_GET['under_dashboard'])
      {
          if (isset($_GET['own_widget']) && 'dbifrm_widget' == substr($_GET['own_widget'], 0, 13)) {
              $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['own_widget'] = $_GET['own_widget'];
              $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['under_dashboard'] = true;
              if (isset($_GET['dashboard_app'])) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['dashboard_app'] = $_GET['dashboard_app'];
              }
              if (isset($_GET['parent_widget'])) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['parent_widget'] = $_GET['parent_widget'];
              }
              if (isset($_GET['compact_mode'])) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['compact_mode'] = 1 == $_GET['compact_mode'];
              }
              if (isset($_GET['width_100'])) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['width_100'] = 1 == $_GET['width_100'];
              }
              if (isset($_GET['remove_margin'])) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['remove_margin'] = 1 == $_GET['remove_margin'];
              }
              if (isset($_GET['remove_border'])) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['remove_border'] = 1 == $_GET['remove_border'];
              }
              if (isset($_GET['remove_background'])) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['remove_background'] = 1 == $_GET['remove_background'];
              }
          }
      }
      elseif (isset($under_dashboard) && 1 == $under_dashboard)
      {
          if (isset($own_widget) && 'dbifrm_widget' == substr($own_widget, 0, 13)) {
              $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['own_widget'] = $own_widget;
              $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['under_dashboard'] = true;
              if (isset($dashboard_app)) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['dashboard_app'] = $dashboard_app;
              }
              if (isset($parent_widget)) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['parent_widget'] = $parent_widget;
              }
              if (isset($compact_mode)) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['compact_mode'] = 1 == $compact_mode;
              }
              if (isset($width_100)) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['width_100'] = 1 == $width_100;
              }
              if (isset($remove_margin)) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['remove_margin'] = 1 == $remove_margin;
              }
              if (isset($remove_border)) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['remove_border'] = 1 == $remove_border;
              }
              if (isset($remove_background)) {
                  $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['remove_background'] = 1 == $remove_background;
              }
          }
      }
      if (!isset($_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['maximized']))
      {
          $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['maximized'] = false;
      }
      if (isset($_GET['maximized']))
      {
          $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['maximized'] = 1 == $_GET['maximized'];
      }
      if ($_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['under_dashboard'])
      {
          $sTmpDashboardApp = $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['dashboard_app'];
          if ('' != $sTmpDashboardApp && isset($_SESSION['scriptcase']['dashboard_targets'][$sTmpDashboardApp]["grid_geral_rsvp_r"]))
          {
              foreach ($_SESSION['scriptcase']['dashboard_targets'][$sTmpDashboardApp]["grid_geral_rsvp_r"] as $sTmpTargetLink => $sTmpTargetWidget)
              {
                  if (isset($this->sc_lig_target[$sTmpTargetLink]))
                  {
                      $this->sc_lig_target[$sTmpTargetLink] = $sTmpTargetWidget;
                  }
              }
          }
      }
        global $link_compact_mode, $link_width_100, $link_remove_margin, $link_remove_border, $link_remove_background, $link_margin_top;
        if (isset($link_compact_mode) || isset($link_width_100) || isset($link_remove_margin) || isset($link_remove_border) || isset($link_remove_background) || isset($link_margin_top)) {
            $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['link_info'] = array();
        }
        if (isset($link_compact_mode) && 'ok' == $link_compact_mode) {
            $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['link_info']['compact_mode'] = true;
        }
        if (isset($link_width_100) && 'ok' == $link_width_100) {
            $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['link_info']['width_100'] = true;
        }
        if (isset($link_remove_margin) && 'ok' == $link_remove_margin) {
            $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['link_info']['remove_margin'] = true;
        }
        if (isset($link_remove_border) && 'ok' == $link_remove_border) {
            $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['link_info']['remove_border'] = true;
        }
        if (isset($link_remove_background) && 'ok' == $link_remove_background) {
            $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['link_info']['remove_background'] = true;
        }
        if (isset($link_margin_top) && '' != $link_margin_top) {
            $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['link_info']['margin_top'] = $link_margin_top;
        }
      $this->SC_Lig_Edit_Apl =  "";
      if (!isset($_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['responsive_chart']))
      {
          $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['responsive_chart'] = array(
              'enabled' => false,
              'active'  => false,
          );
      }
      if ($_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['responsive_chart']['enabled'])
      {
          $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['responsive_chart']['active'] = true;
      }
      elseif ($_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['under_dashboard'] && $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['compact_mode'] && !$_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['dashboard_info']['maximized'])
      {
          $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['responsive_chart']['active'] = true;
      }
      else
      {
          $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['responsive_chart']['active'] = false;
      }
      if ($Tp_init == "Path_sub")
      {
          return;
      }
      $str_path = substr($this->path_prod, 0, strrpos($this->path_prod, '/') + 1);
      if (!is_file($this->root . $str_path . 'devel/class/xmlparser/nmXmlparserIniSys.class.php'))
      {
          unset($_SESSION['scriptcase']['nm_sc_retorno']);
          unset($_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_conexao']);
      }
      include($this->path_lang . $this->str_lang . ".lang.php");
      include($this->path_lang . "config_region.php");
      include($this->path_lang . "lang_config_region.php");
      asort($this->Nm_lang_conf_region);
      $_SESSION['scriptcase']['charset']  = "UTF-8";
      ini_set('default_charset', $_SESSION['scriptcase']['charset']);
      $_SESSION['scriptcase']['charset_html']  = (isset($this->sc_charset[$_SESSION['scriptcase']['charset']])) ? $this->sc_charset[$_SESSION['scriptcase']['charset']] : $_SESSION['scriptcase']['charset'];
      if (!function_exists("mb_convert_encoding"))
      {
          echo "<div><font size=6>" . $this->Nm_lang['lang_othr_prod_xtmb'] . "</font></div>";exit;
      } 
      elseif (!function_exists("sc_convert_encoding"))
      {
          echo "<div><font size=6>" . $this->Nm_lang['lang_othr_prod_xtsc'] . "</font></div>";exit;
      } 
      foreach ($this->Nm_lang_conf_region as $ind => $dados)
      {
         if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
         {
             $this->Nm_lang_conf_region[$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
         }
      }
      foreach ($this->Nm_conf_reg[$this->str_conf_reg] as $ind => $dados)
      {
         if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
         {
             $this->Nm_conf_reg[$this->str_conf_reg][$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
         }
      }
      foreach ($this->Nm_lang as $ind => $dados)
      {
         if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($ind))
         {
             $ind = sc_convert_encoding($ind, $_SESSION['scriptcase']['charset'], "UTF-8");
             $this->Nm_lang[$ind] = $dados;
         }
         if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
         {
             $this->Nm_lang[$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
         }
         $this->Nm_lang[$ind] = str_replace('"', '&quot;',  $this->Nm_lang[$ind]);
      }
      $_SESSION['sc_session']['SC_download_violation'] = $this->Nm_lang['lang_errm_fnfd'];
      if (isset($_SESSION['sc_session']['SC_parm_violation']) && !isset($_SESSION['scriptcase']['grid_geral_rsvp_r']['session_timeout']['redir']))
      {
          unset($_SESSION['sc_session']['SC_parm_violation']);
          echo "<html>";
          echo "<body>";
          echo "<table align=\"center\" width=\"50%\" border=1 height=\"50px\">";
          echo "<tr>";
          echo "   <td align=\"center\">";
          echo "       <b><font size=4>" . $this->Nm_lang['lang_errm_ajax_data'] . "</font>";
          echo "   </b></td>";
          echo " </tr>";
          echo "</table>";
          echo "</body>";
          echo "</html>";
          exit;
      }
      if (isset($_POST['nm_grid_submit']) && $_POST['nm_grid_submit'] == 1 && isset($_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['csrf_token'] ) && !isset($_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['embutida']) && !isset($_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['embutida_form'])) {
          if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] != $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['csrf_token']) {
              echo "<html>";
              echo "<body>";
              echo "<table align=\"center\" width=\"50%\" border=1 height=\"50px\">";
              echo "<tr>";
              echo "   <td align=\"center\">";
              echo "       <b><font size=4>" . $this->Nm_lang['lang_errm_ajax_csrf'] . "</font>";
              echo "   </b></td>";
              echo " </tr>";
              echo "</table>";
              echo "</body>";
              echo "</html>";
              exit;
          }
      }
      if (isset($this->Nm_lang['lang_errm_dbcn_conn']))
      {
          $_SESSION['scriptcase']['db_conn_error'] = $this->Nm_lang['lang_errm_dbcn_conn'];
      }
      $PHP_ver = str_replace(".", "", phpversion()); 
      if (substr($PHP_ver, 0, 3) < 434)
      {
          echo "<div><font size=6>" . $this->Nm_lang['lang_othr_prod_phpv'] . "</font></div>";exit;
      } 
      $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['path_doc'] = $this->path_doc; 
      $_SESSION['scriptcase']['nm_path_prod'] = $this->root . $this->path_prod . "/"; 
      if (empty($this->path_imag_cab))
      {
          $this->path_imag_cab = $this->path_img_global;
      }
      if (!is_dir($this->root . $this->path_prod))
      {
         $str_message = "<html>

<head>
    <title>{var_str_title}</title>
    <style>
        body {
            margin: 0px;
            padding: 0px;
            overflow-x: hidden;
            min-width: 320px;
            background: #FFFFFF;
            font-family: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif;
            font-size: 14px;
            line-height: 1.4285em;
            color: rgba(0, 0, 0, 0.87);
            font-smoothing: antialiased;
        }

        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        user agent stylesheet body {
            display: block;
            margin: 8px;
        }

        html {
            font-size: 14px;
        }

        html {
            line-height: 1.15;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        ::selection {
            background-color: #CCE2FF;
            color: rgba(0, 0, 0, 0.87);
        }

        .ui.container {
            width: 933px;
            min-width: 992px;
            max-width: 1199px;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        .ui.container {
            display: block;
            max-width: 100% !important;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        .ui.message:last-child {
            margin-bottom: 0em;
        }

        .ui.message:first-child {
            margin-top: 0em;
        }

        .ui.message {
            font-size: 1em;
        }

        .ui.message {
            position: relative;
            min-height: 1em;
            margin: 1em 0em;
            background: #F8F8F9;
            padding: 1em 1.5em;
            line-height: 1.4285em;
            color: rgba(0, 0, 0, 0.87);
            transition: opacity 0.1s ease, color 0.1s ease, background 0.1s ease, box-shadow 0.1s ease;
            border-radius: 0.28571429rem;
            box-shadow: 0px 0px 0px 1px rgba(34, 36, 38, 0.22) inset, 0px 0px 0px 0px rgba(0, 0, 0, 0);
        }

        article,
        aside,
        footer,
        header,
        nav,
        section {
            display: block;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        .ui.message> :last-child {
            margin-bottom: 0em;
        }

        .ui.message> :first-child {
            margin-top: 0em;
        }

        .ui.message .header+p {
            margin-top: 0.25em;
        }

        .ui.message p {
            opacity: 0.85;
            margin: 0.75em 0em;
        }

        p {
            margin: 0em 0em 1em;
            line-height: 1.4285em;
        }

        .ui.message .header:not(.ui) {
            font-size: 1.14285714em;
        }

        .ui.message .header {
            display: block;
            font-family: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif;
            font-weight: bold;
            margin: -0.14285714em 0em 1.2rem 0em;
        }

        .ui.button {
            cursor: pointer;
            display: inline-block;
            min-height: 1em;
            outline: 0;
            border: none;
            vertical-align: baseline;
            background: #e0e1e2 none;
            color: rgba(0, 0, 0, .6);
            font-family: Lato, 'Helvetica Neue', Arial, Helvetica, sans-serif;
            margin: 0 .25em 0 0;
            padding: .78571429em 1.5em .78571429em;
            text-transform: none;
            text-shadow: none;
            font-weight: 700;
            line-height: 1em;
            font-style: normal;
            text-align: center;
            text-decoration: none;
            border-radius: .28571429rem;
            box-shadow: 0 0 0 1px transparent inset, 0 0 0 0 rgba(34, 36, 38, .15) inset;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            transition: opacity .1s ease, background-color .1s ease, color .1s ease, box-shadow .1s ease, background .1s ease;
            will-change: '';
            -webkit-tap-highlight-color: transparent;
        }
        
        .ui.button,
        .ui.buttons .button,
        .ui.buttons .or {
            font-size: 1rem;
            flex-flow: row nowrap;
            justify-content: center;
            align-items: center;
            column-gap: .5rem;
            display: flex;
        }
        
        .ui.primary.button,
        .ui.primary.buttons .button {
            background-color: #2185d0;
            color: #fff;
            text-shadow: none;
            background-image: none;
        }
        
        .ui.primary.button {
            box-shadow: 0 0 0 0 rgba(34, 36, 38, .15) inset;
        }

        [type=reset], [type=submit], button, html [type=button] {
            -webkit-appearance: button;
        }

        .icon{
            position: relative;
            width: 1.2rem;
            height: 1.2rem;
            display: block;
            color: inherit;
            background-repeat: no-repeat;
        }

        .icon.database{
            background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 448 512\" fill=\"%23FFFFFF\"><path d=\"M448 80v48c0 44.2-100.3 80-224 80S0 172.2 0 128V80C0 35.8 100.3 0 224 0S448 35.8 448 80zM393.2 214.7c20.8-7.4 39.9-16.9 54.8-28.6V288c0 44.2-100.3 80-224 80S0 332.2 0 288V186.1c14.9 11.8 34 21.2 54.8 28.6C99.7 230.7 159.5 240 224 240s124.3-9.3 169.2-25.3zM0 346.1c14.9 11.8 34 21.2 54.8 28.6C99.7 390.7 159.5 400 224 400s124.3-9.3 169.2-25.3c20.8-7.4 39.9-16.9 54.8-28.6V432c0 44.2-100.3 80-224 80S0 476.2 0 432V346.1z\"/></svg>');
        }
    </style>
</head>

<body>
    <div class='ui container' style='padding-top:2rem'>
        <section class='ui message'>
            <div class='content'>
                <div class='header'>
                    <h1 class='ui header'>{var_str_title}</h1>
                </div>
                <p>{var_str_message}</p>
                <p>{var_str_message_conn}</p>
                {v_str_btn_inside}
            </div>
        </section>
    </div>";
         $str_message_end = "</body>
</html>";
         $str_message = str_replace('{var_str_title}', $this->Nm_lang['lang_errm_cmlb_nfndtitle'], $str_message);
         $str_message = str_replace('{var_str_message}', $this->Nm_lang['lang_errm_cmlb_nfnd'], $str_message);
          $str_message = str_replace('{var_str_message_conn}','', $str_message);
         $str_message = str_replace('{v_str_btn_inside}', '', $str_message);
         echo $str_message;
          if (!$_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['sc_outra_jan']) || !$_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['sc_outra_jan'])) 
          { 
              if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno'])) 
              if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno'])) 
              { 
               $btn_value = "" . $this->Ini->Nm_lang['lang_btns_back'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_value))
               {
                   $btn_value = sc_convert_encoding($btn_value, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
               $btn_hint = "" . $this->Ini->Nm_lang['lang_btns_back_hint'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_hint))
               {
                   $btn_hint = sc_convert_encoding($btn_hint, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
?>
                   <input type="button" id="sai" onClick="window.location='<?php echo $_SESSION['scriptcase']['nm_sc_retorno'] ?>'; return false" class="scButton_default" value="<?php echo $btn_value ?>" title="<?php echo $btn_hint ?>" style="vertical-align: middle;">

<?php
              } 
              else 
              { 
               $btn_value = "" . $this->Ini->Nm_lang['lang_btns_exit'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_value))
               {
                   $btn_value = sc_convert_encoding($btn_value, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
               $btn_hint = "" . $this->Ini->Nm_lang['lang_btns_exit_hint'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_hint))
               {
                   $btn_hint = sc_convert_encoding($btn_hint, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
?>
                   <input type="button" id="sai" onClick="window.location='<?php echo $nm_url_saida ?>'; return false" class="scButton_default" value="<?php echo $btn_value ?>" title="<?php echo $btn_hint ?>" style="vertical-align: middle;">

<?php
              } 
          } 
          echo $str_message_end;
          exit ;
      }

      $this->nm_ger_css_emb = true;
      $this->Control_Css    = "coo";
      $this->path_atual     = getcwd();
      $opsys = strtolower(php_uname());

      $this->nm_cont_lin           = 0;
      $this->nm_limite_lin         = 0;
      $this->nm_limite_lin_prt     = 0;
      $this->nm_limite_lin_res     = 0;
      $this->nm_limite_lin_res_prt = 0;
// 
      include_once($this->path_aplicacao . "grid_geral_rsvp_r_erro.class.php"); 
      $this->Erro = new grid_geral_rsvp_r_erro();
      include_once($this->path_adodb . "/adodb.inc.php"); 
      $this->sc_Include($this->path_libs . "/nm_sec_prod.php", "F", "nm_reg_prod") ; 
      $this->sc_Include($this->path_libs . "/nm_ini_perfil.php", "F", "perfil_lib") ; 
// 
 if(function_exists('set_php_timezone')) set_php_timezone('grid_geral_rsvp_r'); 
// 
      $this->sc_Include($this->path_lib_php . "/nm_functions.php", "", "") ; 
      global $bol_api_prod; 
      $bol_api_prod = true; 
      if (isset($_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_conexao'])) 
      { 
          $bol_api_prod = false; 
      } 
      $this->sc_Include($this->path_lib_php . "/nm_api.php", "", "") ; 
      $this->sc_Include($this->path_lib_php . "/nm_edit.php", "F", "nmgp_Form_Num_Val") ; 
      $this->sc_Include($this->path_lib_php . "/nm_conv_dados.php", "F", "nm_conv_limpa_dado") ; 
      $this->sc_Include($this->path_lib_php . "/nm_data.class.php", "C", "nm_data") ; 
      $this->nm_data = new nm_data("pt_br");
      if (is_file("../_lib/css/" . $this->str_schema_all . "_grid.php")) {
          include("../_lib/css/" . $this->str_schema_all . "_grid.php");
      } else {
          $str_tree_col = "";
          $str_tree_exp = "";
          $str_button   = "";
      }
      $this->Color_bg_ajax = (!isset($str_ajax_bg)       || "" == trim($str_ajax_bg))       ? "#000" : $str_ajax_bg;
      $this->Border_c_ajax = (!isset($str_ajax_border_c) || "" == trim($str_ajax_border_c)) ? ""     : $str_ajax_border_c;
      $this->Border_s_ajax = (!isset($str_ajax_border_s) || "" == trim($str_ajax_border_s)) ? ""     : $str_ajax_border_s;
      $this->Border_w_ajax = (!isset($str_ajax_border_w) || "" == trim($str_ajax_border_w)) ? ""     : $str_ajax_border_w;
      $this->Tree_img_col    = trim($str_tree_col);
      $this->Tree_img_exp    = trim($str_tree_exp);
      $this->scGridRefinedSearchExpandFAIcon    = trim($scGridRefinedSearchExpandFAIcon);
      $this->scGridRefinedSearchCollapseFAIcon    = trim($scGridRefinedSearchCollapseFAIcon);
      $this->Tree_img_type   = "kie";
      perfil_lib($this->path_libs);
      if (!isset($_SESSION['sc_session'][$this->sc_page]['SC_Check_Perfil']))
      {
          if(function_exists("nm_check_perfil_exists")) nm_check_perfil_exists($this->path_libs, $this->path_prod);
          $_SESSION['sc_session'][$this->sc_page]['SC_Check_Perfil'] = true;
      }
      if (function_exists("nm_check_pdf_server")) $this->server_pdf = nm_check_pdf_server($this->path_libs, $this->server_pdf);
      if (!isset($_SESSION['scriptcase']['sc_num_img']))
      { 
          $_SESSION['scriptcase']['sc_num_img'] = 1;
      } 
      $this->str_google_fonts= isset($str_google_fonts)?$str_google_fonts:'';
      $this->regionalDefault();
      $this->Str_btn_grid    = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
      $this->Str_btn_css     = trim($str_button) . "/" . trim($str_button) . ".css";
      if (is_file($this->path_btn . $this->Str_btn_grid)) {
          include($this->path_btn . $this->Str_btn_grid);
      }
      $_SESSION['scriptcase']['erro']['str_schema_dir'] = $this->str_schema_all . "_error" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
      $this->sc_tem_trans_banco = false;
      if (isset($_SESSION['scriptcase']['grid_geral_rsvp_r']['session_timeout']['redir'])) {
          $SS_cod_html  = '<!DOCTYPE html>';
          $SS_cod_html .= "<HTML>\r\n";
          $SS_cod_html .= " <HEAD>\r\n";
          $SS_cod_html .= "  <TITLE></TITLE>\r\n";
          $SS_cod_html .= "   <META http-equiv=\"Content-Type\" content=\"text/html; charset=" . $_SESSION['scriptcase']['charset_html'] . "\"/>\r\n";
          if ($_SESSION['scriptcase']['proc_mobile']) {
              $SS_cod_html .= "   <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0\"/>\r\n";
          }
          $SS_cod_html .= "   <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n";
          $SS_cod_html .= "    <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n";
          if ($_SESSION['scriptcase']['grid_geral_rsvp_r']['session_timeout']['redir_tp'] == "R") {
              $SS_cod_html .= "  </HEAD>\r\n";
              $SS_cod_html .= "   <body>\r\n";
          }
          else {
              $SS_cod_html .= "    <link rel=\"shortcut icon\" href=\"../_lib/img/scriptcase__NM__ico__NM__favicon.ico\">\r\n";
              $SS_cod_html .= "    <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->str_schema_all . "_grid.css\"/>\r\n";
              $SS_cod_html .= "    <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\"/>\r\n";
              $SS_cod_html .= "  </HEAD>\r\n";
              $SS_cod_html .= "   <body class=\"scGridPage\">\r\n";
              $SS_cod_html .= "    <table align=\"center\"><tr><td style=\"padding: 0\"><div class=\"scGridBorder\">\r\n";
              $SS_cod_html .= "    <table class=\"scGridTabela\" width='100%' cellspacing=0 cellpadding=0><tr class=\"scGridFieldOdd\"><td class=\"scGridFieldOddFont\" style=\"padding: 15px 30px; text-align: center\">\r\n";
              $SS_cod_html .= $this->Nm_lang['lang_errm_expired_session'] . "\r\n";
              $SS_cod_html .= "     <form name=\"Fsession_redir\" method=\"post\"\r\n";
              $SS_cod_html .= "           target=\"_self\">\r\n";
              $SS_cod_html .= "           <input type=\"button\" name=\"sc_sai_seg\" value=\"OK\" onclick=\"sc_session_redir('" . $_SESSION['scriptcase']['grid_geral_rsvp_r']['session_timeout']['redir'] . "');\">\r\n";
              $SS_cod_html .= "     </form>\r\n";
              $SS_cod_html .= "    </td></tr></table>\r\n";
              $SS_cod_html .= "    </div></td></tr></table>\r\n";
          }
          $SS_cod_html .= "    <script type=\"text/javascript\">\r\n";
          if ($_SESSION['scriptcase']['grid_geral_rsvp_r']['session_timeout']['redir_tp'] == "R") {
              $SS_cod_html .= "      sc_session_redir('" . $_SESSION['scriptcase']['grid_geral_rsvp_r']['session_timeout']['redir'] . "');\r\n";
          }
          $SS_cod_html .= "      function sc_session_redir(url_redir)\r\n";
          $SS_cod_html .= "      {\r\n";
          $SS_cod_html .= "         if (window.parent && window.parent.document != window.document && typeof window.parent.sc_session_redir === 'function')\r\n";
          $SS_cod_html .= "         {\r\n";
          $SS_cod_html .= "            window.parent.sc_session_redir(url_redir);\r\n";
          $SS_cod_html .= "         }\r\n";
          $SS_cod_html .= "         else\r\n";
          $SS_cod_html .= "         {\r\n";
          $SS_cod_html .= "             if (window.opener && typeof window.opener.sc_session_redir === 'function')\r\n";
          $SS_cod_html .= "             {\r\n";
          $SS_cod_html .= "                 window.close();\r\n";
          $SS_cod_html .= "                 window.opener.sc_session_redir(url_redir);\r\n";
          $SS_cod_html .= "             }\r\n";
          $SS_cod_html .= "             else\r\n";
          $SS_cod_html .= "             {\r\n";
          $SS_cod_html .= "                 window.location = url_redir;\r\n";
          $SS_cod_html .= "             }\r\n";
          $SS_cod_html .= "         }\r\n";
          $SS_cod_html .= "      }\r\n";
          $SS_cod_html .= "    </script>\r\n";
          $SS_cod_html .= " </body>\r\n";
          $SS_cod_html .= "</HTML>\r\n";
          unset($_SESSION['scriptcase']['grid_geral_rsvp_r']['session_timeout']);
          unset($_SESSION['sc_session']);
      }
      if (isset($SS_cod_html) && isset($_GET['nmgp_opcao']) && (substr($_GET['nmgp_opcao'], 0, 14) == "ajax_aut_comp_" || substr($_GET['nmgp_opcao'], 0, 13) == "ajax_autocomp"))
      {
          unset($_SESSION['sc_session']);
          $oJson = new Services_JSON();
          echo $oJson->encode("ss_time_out");
          exit;
      }
      elseif (isset($SS_cod_html) && ((isset($_POST['nmgp_opcao']) && substr($_POST['nmgp_opcao'], 0, 5) == "ajax_") || (isset($_GET['nmgp_opcao']) && substr($_GET['nmgp_opcao'], 0, 5) == "ajax_")))
      {
          unset($_SESSION['sc_session']);
          $this->Arr_result = array();
          $this->Arr_result['ss_time_out'] = true;
          $oJson = new Services_JSON();
          echo $oJson->encode($this->Arr_result);
          exit;
      }
      elseif (isset($SS_cod_html))
      {
          echo $SS_cod_html;
          exit;
      }
      $this->nm_bases_access     = array("access", "ado_access", "ace_access");
      $this->nm_bases_db2        = array("db2", "db2_odbc", "odbc_db2", "odbc_db2v6", "pdo_db2_odbc", "pdo_ibm");
      $this->nm_bases_ibase      = array("ibase", "firebird", "pdo_firebird", "borland_ibase");
      $this->nm_bases_informix   = array("informix", "informix72", "pdo_informix");
      $this->nm_bases_mssql      = array("mssql", "ado_mssql", "adooledb_mssql", "odbc_mssql", "mssqlnative", "pdo_sqlsrv", "pdo_dblib", "azure_mssql", "azure_ado_mssql", "azure_adooledb_mssql", "azure_odbc_mssql", "azure_mssqlnative", "azure_pdo_sqlsrv", "azure_pdo_dblib", "googlecloud_mssql", "googlecloud_ado_mssql", "googlecloud_adooledb_mssql", "googlecloud_odbc_mssql", "googlecloud_mssqlnative", "googlecloud_pdo_sqlsrv", "googlecloud_pdo_dblib", "amazonrds_mssql", "amazonrds_ado_mssql", "amazonrds_adooledb_mssql", "amazonrds_odbc_mssql", "amazonrds_mssqlnative", "amazonrds_pdo_sqlsrv", "amazonrds_pdo_dblib");
      $this->nm_bases_mysql      = array("mysql", "mysqlt", "mysqli", "maxsql", "pdo_mysql", "pdo_mariadb", "azure_mysql", "azure_mysqlt", "azure_mysqli", "azure_maxsql", "azure_pdo_mysql", "azure_pdo_mariadb", "googlecloud_mysql", "googlecloud_mysqlt", "googlecloud_mysqli", "googlecloud_maxsql", "googlecloud_pdo_mysql", "googlecloud_pdo_mariadb", "amazonrds_mysql", "amazonrds_mysqlt", "amazonrds_mysqli", "amazonrds_maxsql", "amazonrds_pdo_mysql", "amazonrds_pdo_mariadb");
      $this->nm_bases_postgres   = array("postgres", "postgres64", "postgres7", "pdo_pgsql", "azure_postgres", "azure_postgres64", "azure_postgres7", "azure_pdo_pgsql", "googlecloud_postgres", "googlecloud_postgres64", "googlecloud_postgres7", "googlecloud_pdo_pgsql", "amazonrds_postgres", "amazonrds_postgres64", "amazonrds_postgres7", "amazonrds_pdo_pgsql");
      $this->nm_bases_oracle     = array("oci8", "oci805", "oci8po", "odbc_oracle", "oracle", "pdo_oracle", "oraclecloud_oci8", "oraclecloud_oci805", "oraclecloud_oci8po", "oraclecloud_odbc_oracle", "oraclecloud_oracle", "oraclecloud_pdo_oracle", "amazonrds_oci8", "amazonrds_oci805", "amazonrds_oci8po", "amazonrds_odbc_oracle", "amazonrds_oracle", "amazonrds_pdo_oracle");
      $this->sqlite_version      = "old";
      $this->nm_bases_sqlite     = array("sqlite", "sqlite3", "pdosqlite");
      $this->nm_bases_sybase     = array("sybase", "pdo_sybase_odbc", "pdo_sybase_dblib");
      $this->nm_bases_vfp        = array("vfp");
      $this->nm_bases_odbc       = array("odbc");
      $this->nm_bases_progress     = array("pdo_progress_odbc", "progress");
      $this->nm_bases_all        = array_merge($this->nm_bases_access, $this->nm_bases_db2, $this->nm_bases_ibase, $this->nm_bases_informix, $this->nm_bases_mssql, $this->nm_bases_mysql, $this->nm_bases_postgres, $this->nm_bases_oracle, $this->nm_bases_sqlite, $this->nm_bases_sybase, $this->nm_bases_vfp, $this->nm_bases_odbc, $this->nm_bases_progress);
      $this->nm_font_ttf = array("ar", "ja", "pl", "ru", "sk", "thai", "zh_cn", "zh_hk", "cz", "el", "ko", "mk");
      $this->nm_ttf_arab = array("ar");
      $this->nm_ttf_jap  = array("ja");
      $this->nm_ttf_rus  = array("pl", "ru", "sk", "cz", "el", "mk");
      $this->nm_ttf_thai = array("thai");
      $this->nm_ttf_chi  = array("zh_cn", "zh_hk", "ko");
      $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['seq_dir'] = 0; 
      $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['sub_dir'] = array(); 
      $_SESSION['scriptcase']['nm_bases_security']  = "enc_nm_enc_v1HQNmZSFUHIrwHuFGDMvmDkB/DWXKVErqHQNmH9FaHIveV5BODMvCZSJqDWr/ZuXGHQBiH9FUHIrKHuFaHuNOZSrCH5FqDoXGHQJmZ1BiHAN7HQJwDEBODkFeH5FYVoFGHQJKDQB/HAveV5FGHgvOVIB/DWFYVoBqHQNwH9FaDSvOZMB/DMvCHArCH5F/HMBqHQJKDQJsZ1vCV5FGHuNOV9FeDWXCVoFGDcBqZSBOZ1BeD5F7DErKVkXeV5FaVoBiD9FYH9X7HABYHuFaHuNOZSrCH5FqDoXGHQJmZ1FUZ1BeV5BODErKVkXeHEFqVoFaDcXOZSX7HIrwD5JwHuzGVIBODWFaDoJeDcNwH9FaHAN7D5JeDEvsVkJGDWF/DoFUD9NwZ9JeZ1N7V5JeHuvmVcrsDWXCHMBiD9BsVIraD1rwV5X7HgBeHErsDWXCHIXGD9XsZ9rqZ1zGVWJeHgrKV9FeDWF/HMrqHQXGZ1FUZ1rYHQNUDENOHErCDWX7DoJeHQFYZSBiHAveD5NUHgNKDkBOV5FYHMBiHQBiZkBiDSNOHuFUHgBeHEJqDWr/HINUHQBiZ9rqZ1BYHuBOHgvOVcFeV5F/HIX7HQJmVIJwZ1rYHQBOHgveVkJqHEB3ZuJeHQNwDQBOZ1BYHQFaDMBYVIB/H5XCHMJwDcNmZkFUD1rwV5FGDEBeHEXeH5X/DoF7HQNwDQBqDSN7HuJeHgrwV9FeDur/HMFGDcFYVIJwZ1vOD5JeHgNOZSJqHEXCHMFGHQNmDQBOZ1BYHuBqHgrwV9FeHEF/HIraHQJmVIraZ1vOZMFaHgBeDkB/DWrGZuBOHQBiZ9rqD1BeD5rqHuvmVcBOH5B7VoBqHQXOZkBiDSNOHuB/DMvCVkJqHEFqHMBiHQXOZ9rqZ1BYHQJwDMvsVcFeDWFYHMXGHQXGVIJwZ1vOZMB/HgBYHArsDuFaHIJeHQNmZ9JeZ1BYHQNUHgvOVcB/DWF/HMJwDcFYZ1FUD1rwV5FGDEBeHEXeH5X/DoF7D9NwZSX7D1BeV5raHuzGVcFKDWFaVENUD9JmZ1X7Z1BeHQX7HgBYDkFeV5FaHMJsD9NwH9X7Z1rwD5XGHuzGVIBODWFaDoXGDcBwZ1FGHANOV5JeDEBOHEFiDWFqDoXGHQXGZSBiZ1N7D5JwHuBYVcFeV5FYVoB/D9JmH9B/D1zGD5FaDEvsDkXKDWFGDoBOHQXGZSFGHIrwVWXGHuBYDkFCDWJeVoraD9BsH9FaD1vsD5FaDErKZSXeH5FYDoJeD9JKDQFGHAveVWJsHgvsDkBODWFaVoFGDcJUZkFUZ1BOD5rqDEBOHEFiHEFqDoF7DcJUZSFGD1BeV5FGHgrYDkBODur/VoraD9XOH9FaD1rKD5BiHgBeVkJqDWXCHIX7HQNwDQB/DSN7HuB/DMBOVIBsHEX7HIX7HQNwZ1BiHIBOD5BOHgveDkXKH5FGZuBOHQJKDQJsZ1vCV5FGHuNOV9FeDWB3VoX7HQNmZ1BiHAvCZMBqHgveHErsHEB7DoBOHQBiH9BiHAveD5NUHgNKDkBOV5FYHMBiDcBqVINUHABYHuBqDMBYHEXeV5FaHIrqDcJeZSX7HIBOV5BODMvOVcFeDWXCDoJsDcBwH9B/Z1rYHQJwHgBeVkXeDWFqVoX7D9NmH9X7DSBYVWJsHuBYVcFCDWrmVoFaDcFYZSB/DSrYD5NUDMzGZSXeDWFqVoBiD9NwZ9rqHAveHQJeHuBYVcFKH5XCVoB/HQFYZSBqHArKV5FUDMrYZSXeV5FqHIJsHQJeDuBOZ1vCV5Je";
      $this->prep_conect();
      if (isset($_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['initialize']) && $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['initialize'])  
      { 
          $this->conectDB();
          $_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'on';
if (!isset($_SESSION['rsvp_global'])) {$_SESSION['rsvp_global'] = "";}
if (!isset($this->sc_temp_rsvp_global)) {$this->sc_temp_rsvp_global = (isset($_SESSION['rsvp_global'])) ? $_SESSION['rsvp_global'] : "";}
if (!isset($_SESSION['vg_cpfseg'])) {$_SESSION['vg_cpfseg'] = "";}
if (!isset($this->sc_temp_vg_cpfseg)) {$this->sc_temp_vg_cpfseg = (isset($_SESSION['vg_cpfseg'])) ? $_SESSION['vg_cpfseg'] : "";}
if (!isset($_SESSION['vg_evento_id'])) {$_SESSION['vg_evento_id'] = "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
if (!isset($_SESSION['parm1'])) {$_SESSION['parm1'] = "";}
if (!isset($this->sc_temp_parm1)) {$this->sc_temp_parm1 = (isset($_SESSION['parm1'])) ? $_SESSION['parm1'] : "";}
if (!isset($_SESSION['vg_menu_item'])) {$_SESSION['vg_menu_item'] = "";}
if (!isset($this->sc_temp_vg_menu_item)) {$this->sc_temp_vg_menu_item = (isset($_SESSION['vg_menu_item'])) ? $_SESSION['vg_menu_item'] : "";}
if (!isset($_SESSION['vg_usuario_id'])) {$_SESSION['vg_usuario_id'] = "";}
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
	
if (!isset($this->rs[0][0])) {
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
;	
	if (isset($this->Campos_Mens_erro) && !empty($this->Campos_Mens_erro))
{
 if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
 if (isset($this->sc_temp_vg_menu_item)) {$_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
 if (isset($this->sc_temp_parm1)) {$_SESSION['parm1'] = $this->sc_temp_parm1;}
 if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
 if (isset($this->sc_temp_vg_cpfseg)) {$_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
 if (isset($this->sc_temp_rsvp_global)) {$_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
?><!DOCTYPE html>
<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<head>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
 if ($_SESSION['scriptcase']['proc_mobile'])
 {
?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
 }
?>
<link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
</head>
<body>
<?php
 $_SESSION['scriptcase']['sc_url_saida'][$this->sc_page] = $this->path_link . "" . SC_dir_app_name('WWW-Authenticate: <type> realm=<realm>') . "/";
 if (isset($_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['sc_outra_jan']) && $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "grid_geral_rsvp_r";
     $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['sc_outra_jan'] = false;
 }
?>
<TABLE border="0" cellspacing="1" cellpadding="2" bgcolor="#406080" bordercolor="#406080" align="center">
 <TR bgcolor="#FF0000">
  <TD  align="left"><FONT face="Verdana, Arial, sans-serif" size="2" color="#FFFFFF"><B>ERRO</B></FONT></TD>
 </TR>
 <TR bgcolor="#E4E8F0">
   <TD  align="center"><FONT face="Tahoma, Arial, sans-serif" size="2" color="#404040"><?php echo $this->Campos_Mens_erro ?></FONT></TD>
 </TR>
</TABLE>
<table align="center"><tr><td>
  <form name="Fexit" method=post
        action="grid_geral_rsvp_r_fim.php"
        target="_self">
    <input type=hidden name="script_case_init" value="<?php echo NM_encode_input($this->sc_page) ?>">
    <input type=submit value="OK">
  </form>
</td></tr></table>
</body>
</html>
<?php
   exit;
}
}

$sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'grid_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';
if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_vg_menu_item)) {$_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
if (isset($this->sc_temp_parm1)) {$_SESSION['parm1'] = $this->sc_temp_parm1;}
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_cpfseg)) {$_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
if (isset($this->sc_temp_rsvp_global)) {$_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'off'; 
          $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['initialize'] = false;
          $this->Db->Close(); 
      } 
      $this->conectDB();
      if (!in_array(strtolower($this->nm_tpbanco), $this->nm_bases_all))
      {
          echo "<tr>";
          echo "   <td bgcolor=\"\">";
          echo "       <b><font size=\"4\">" . $this->Nm_lang['lang_errm_dbcn_nspt'] . "</font>";
          echo "  " . $perfil_trab;
          echo "   </b></td>";
          echo " </tr>";
          echo "</table>";
          if (!$_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['sc_outra_jan']) || !$_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['sc_outra_jan'])) 
          { 
              if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno'])) 
              { 
                  echo "<a href='" . $_SESSION['scriptcase']['nm_sc_retorno'] . "' target='_self'><img border='0' src='" . $this->path_botoes . "/nm_scriptcase9_Rhino_bvoltar.gif' title='" . $this->Nm_lang['lang_btns_rtrn_scrp_hint'] . "' align=absmiddle></a> \n" ; 
              } 
              else 
              { 
                  echo "<a href='$nm_url_saida' target='_self'><img border='0' src='" . $this->path_botoes . "/nm_scriptcase9_Rhino_bsair.gif' title='" . $this->Nm_lang['lang_btns_exit_appl_hint'] . "' align=absmiddle></a> \n" ; 
              } 
          } 
          exit ;
      } 
      if (empty($this->nm_tabela))
      {
          $this->nm_tabela = "geral_rsvp_r"; 
      }
      $this->Nm_accent_access    = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_db2       = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_ibase     = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_informix  = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_mssql     = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_mysql     = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_postgres  = array('cmp_i'=>"unaccent(",'cmp_f'=>")",'cmp_apos'=>"",'arg_i'=>"' || unaccent('",'arg_f'=>"') || '",'arg_apos'=>"");
      $this->Nm_accent_oracle    = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_sqlite    = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_sybase    = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_vfp       = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_odbc      = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");
      $this->Nm_accent_progress  = array('cmp_i'=>"",'cmp_f'=>"",'cmp_apos'=>"",'arg_i'=>"",'arg_f'=>"",'arg_apos'=>"");

      $this->Nm_accent_no = array('cmp_i'=>'','cmp_f'=>'','cmp_apos'=>'','arg_i'=>'','arg_f'=>'','arg_apos'=>'');
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_access)) {
          $this->Nm_accent_yes = $this->Nm_accent_access;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_db2)) {
          $this->Nm_accent_yes = $this->Nm_accent_db2;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_ibase)) {
          $this->Nm_accent_yes = $this->Nm_accent_ibase;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_informix)) {
          $this->Nm_accent_yes = $this->Nm_accent_informix;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mssql)) {
          $this->Nm_accent_yes = $this->Nm_accent_mssql;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql)) {
          $this->Nm_accent_yes = $this->Nm_accent_mysql;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_postgres)) {
          $this->Nm_accent_yes = $this->Nm_accent_postgres;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_oracle)) {
          $this->Nm_accent_yes = $this->Nm_accent_oracle;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sqlite)) {
          $this->Nm_accent_yes = $this->Nm_accent_sqlite;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sybase)) {
          $this->Nm_accent_yes = $this->Nm_accent_sybase;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_vfp)) {
          $this->Nm_accent_yes = $this->Nm_accent_vfp;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_odbc)) {
          $this->Nm_accent_yes = $this->Nm_accent_odbc;
      }
      elseif (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_progress)) {
          $this->Nm_accent_yes = $this->Nm_accent_progress;
      }
      else {
          $this->Nm_accent_yes = $this->Nm_accent_no;
      }
   }

   function getRunningOS()
   {
       $aOSInfo = array();

       if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
       {
           $aOSInfo['os'] = 'win';
       }
       elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
       {
           $aOSInfo['os'] = 'linux-i386';
           if(strpos(strtolower(php_uname()), 'x86_64') !== FALSE) 
            {
               $aOSInfo['os'] = 'linux-amd64';
            }
       }
       elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
       {
           $aOSInfo['os'] = 'macos';
       }

       return $aOSInfo;
   }

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

   function prep_conect()
   {
      if (isset($_SESSION['scriptcase']['sc_connection']) && !empty($_SESSION['scriptcase']['sc_connection']))
      {
          foreach ($_SESSION['scriptcase']['sc_connection'] as $NM_con_orig => $NM_con_dest)
          {
              if (isset($_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_conexao']) && $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_conexao'] == $NM_con_orig)
              {
/*NM*/            $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_conexao'] = $NM_con_dest;
              }
              if (isset($_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_perfil']) && $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_perfil'] == $NM_con_orig)
              {
/*NM*/            $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_perfil'] = $NM_con_dest;
              }
              if (isset($_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_con_' . $NM_con_orig]))
              {
                  $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_con_' . $NM_con_orig] = $NM_con_dest;
              }
          }
      }
      $con_devel             = (isset($_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_conexao'])) ? $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_conexao'] : ""; 
      $perfil_trab           = ""; 
      $this->nm_falta_var    = ""; 
      $this->nm_falta_var_db = ""; 
      $nm_crit_perfil        = false;
      if (isset($_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_conexao']))
      {
          if (!isset($_GET['nmgp_opcao']) || ('pdf' != $_GET['nmgp_opcao'] && 'pdf_res' != $_GET['nmgp_opcao'])) {
              ob_start();
          } else {
              @ini_set('zlib.output_compression',0);
              $bufferSize = @ini_get('output_buffering');
              if ('' != $bufferSize) {
                  $bufferSize = min($bufferSize * 10, 65536);
                  echo str_repeat('&nbsp;', $bufferSize);
              }
              
          }
          db_conect_devel($con_devel, $this->root . $this->path_prod, 'NRSVP115_10_AWS_APP', 2, $this->force_db_utf8); 
          if (!isset($this->Ajax_result_set)) {$this->Ajax_result_set = ob_get_contents();}
          ob_end_clean();
          if (empty($_SESSION['scriptcase']['glo_tpbanco']) && empty($_SESSION['scriptcase']['glo_banco']))
          {
              $nm_crit_perfil = true;
          }
      }
      if (isset($_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_perfil']) && !empty($_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_perfil']))
      {
          $perfil_trab = $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_perfil'];
      }
      elseif (isset($_SESSION['scriptcase']['glo_perfil']) && !empty($_SESSION['scriptcase']['glo_perfil']))
      {
          $perfil_trab = $_SESSION['scriptcase']['glo_perfil'];
      }
      if (!empty($perfil_trab))
      {
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($perfil_trab, $this->path_libs, "S", $this->path_conf);
          if (empty($_SESSION['scriptcase']['glo_senha_protect']))
          {
              $nm_crit_perfil = true;
          }
      }
      else
      {
          $perfil_trab = $con_devel;
      }
      if (!isset($_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['embutida_init']) || !$_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['embutida_init']) 
      {
          if (!isset($_SESSION['vg_evento_id'])) 
          {
              $this->nm_falta_var .= "vg_evento_id; ";
          }
          if (!isset($_SESSION['vg_usuario_id'])) 
          {
              $this->nm_falta_var .= "vg_usuario_id; ";
          }
          if (!isset($_SESSION['rsvp_global'])) 
          {
              $this->nm_falta_var .= "rsvp_global; ";
          }
          if (!isset($_SESSION['vg_menu_item'])) 
          {
              $this->nm_falta_var .= "vg_menu_item; ";
          }
          if (!isset($_SESSION['parm1'])) 
          {
              $this->nm_falta_var .= "parm1; ";
          }
          if (!isset($_SESSION['parm2'])) 
          {
              $this->nm_falta_var .= "parm2; ";
          }
      }
// 
      if (!isset($_SESSION['scriptcase']['glo_tpbanco']))
      {
          if (!$nm_crit_perfil)
          {
              $this->nm_falta_var_db .= "glo_tpbanco; ";
          }
      }
      else
      {
          $this->nm_tpbanco = $_SESSION['scriptcase']['glo_tpbanco']; 
      }
      if (!isset($_SESSION['scriptcase']['glo_servidor']))
      {
          if (!$nm_crit_perfil)
          {
              $this->nm_falta_var_db .= "glo_servidor; ";
          }
      }
      else
      {
          $this->nm_servidor = $_SESSION['scriptcase']['glo_servidor']; 
      }
      if (!isset($_SESSION['scriptcase']['glo_banco']))
      {
          if (!$nm_crit_perfil)
          {
              $this->nm_falta_var_db .= "glo_banco; ";
          }
      }
      else
      {
          $this->nm_banco = $_SESSION['scriptcase']['glo_banco']; 
      }
      if (!isset($_SESSION['scriptcase']['glo_usuario']))
      {
          if (!$nm_crit_perfil)
          {
              $this->nm_falta_var_db .= "glo_usuario; ";
          }
      }
      else
      {
          $this->nm_usuario = $_SESSION['scriptcase']['glo_usuario']; 
      }
      if (!isset($_SESSION['scriptcase']['glo_senha']))
      {
          if (!$nm_crit_perfil)
          {
              $this->nm_falta_var_db .= "glo_senha; ";
          }
      }
      else
      {
          $this->nm_senha = $_SESSION['scriptcase']['glo_senha']; 
      }
      if (isset($_SESSION['scriptcase']['glo_database_encoding']))
      {
          $this->nm_database_encoding = $_SESSION['scriptcase']['glo_database_encoding']; 
      }
      $this->nm_arr_db_extra_args = array(); 
      if (isset($_SESSION['scriptcase']['glo_use_ssl']))
      {
          $this->nm_arr_db_extra_args['use_ssl'] = $_SESSION['scriptcase']['glo_use_ssl']; 
      }
      if (isset($_SESSION['scriptcase']['glo_mysql_ssl_key']))
      {
          $this->nm_arr_db_extra_args['mysql_ssl_key'] = $_SESSION['scriptcase']['glo_mysql_ssl_key']; 
      }
      if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cert']))
      {
          $this->nm_arr_db_extra_args['mysql_ssl_cert'] = $_SESSION['scriptcase']['glo_mysql_ssl_cert']; 
      }
      if (isset($_SESSION['scriptcase']['glo_mysql_ssl_capath']))
      {
          $this->nm_arr_db_extra_args['mysql_ssl_capath'] = $_SESSION['scriptcase']['glo_mysql_ssl_capath']; 
      }
      if (isset($_SESSION['scriptcase']['glo_mysql_ssl_ca']))
      {
          $this->nm_arr_db_extra_args['mysql_ssl_ca'] = $_SESSION['scriptcase']['glo_mysql_ssl_ca']; 
      }
      if (isset($_SESSION['scriptcase']['glo_mysql_ssl_cipher']))
      {
          $this->nm_arr_db_extra_args['mysql_ssl_cipher'] = $_SESSION['scriptcase']['glo_mysql_ssl_cipher']; 
      }
      if (isset($_SESSION['scriptcase']['postgres_sslmode']))
      {
          $this->nm_arr_db_extra_args['postgres_sslmode'] = $_SESSION['scriptcase']['postgres_sslmode']; 
      }
      if (isset($_SESSION['scriptcase']['postgres_sslrootcert']))
      {
          $this->nm_arr_db_extra_args['postgres_sslrootcert'] = $_SESSION['scriptcase']['postgres_sslrootcert']; 
      }
      if (isset($_SESSION['scriptcase']['postgres_sslkey']))
      {
          $this->nm_arr_db_extra_args['postgres_sslkey'] = $_SESSION['scriptcase']['postgres_sslkey']; 
      }
      if (isset($_SESSION['scriptcase']['postgres_sslcert']))
      {
          $this->nm_arr_db_extra_args['postgres_sslcert'] = $_SESSION['scriptcase']['postgres_sslcert']; 
      }
      if (isset($_SESSION['scriptcase']['mssql_encrypt']))
      {
          $this->nm_arr_db_extra_args['mssql_encrypt'] = $_SESSION['scriptcase']['mssql_encrypt']; 
      }
      if (isset($_SESSION['scriptcase']['mssql_trustservercertificate']))
      {
          $this->nm_arr_db_extra_args['mssql_trustservercertificate'] = $_SESSION['scriptcase']['mssql_trustservercertificate']; 
      }
      if (isset($_SESSION['scriptcase']['mssql_truststore']))
      {
          $this->nm_arr_db_extra_args['mssql_truststore'] = $_SESSION['scriptcase']['mssql_truststore']; 
      }
      if (isset($_SESSION['scriptcase']['mssql_truststorepassword']))
      {
          $this->nm_arr_db_extra_args['mssql_truststorepassword'] = $_SESSION['scriptcase']['mssql_truststorepassword']; 
      }
      if (isset($_SESSION['scriptcase']['mssql_hostnameincertificate']))
      {
          $this->nm_arr_db_extra_args['mssql_hostnameincertificate'] = $_SESSION['scriptcase']['mssql_hostnameincertificate']; 
      }
      if (isset($_SESSION['scriptcase']['glo_db2_autocommit']))
      {
          $this->nm_con_db2['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
      }
      if (isset($_SESSION['scriptcase']['glo_db2_i5_lib']))
      {
          $this->nm_con_db2['db2_i5_lib'] = $_SESSION['scriptcase']['glo_db2_i5_lib']; 
      }
      if (isset($_SESSION['scriptcase']['glo_db2_i5_naming']))
      {
          $this->nm_con_db2['db2_i5_naming'] = $_SESSION['scriptcase']['glo_db2_i5_naming']; 
      }
      if (isset($_SESSION['scriptcase']['glo_db2_i5_commit']))
      {
          $this->nm_con_db2['db2_i5_commit'] = $_SESSION['scriptcase']['glo_db2_i5_commit']; 
      }
      if (isset($_SESSION['scriptcase']['glo_db2_i5_query_optimize']))
      {
          $this->nm_con_db2['db2_i5_query_optimize'] = $_SESSION['scriptcase']['glo_db2_i5_query_optimize']; 
      }
      if (isset($_SESSION['scriptcase']['oracle_type']))
      {
          $this->nm_arr_db_extra_args['oracle_type'] = $_SESSION['scriptcase']['oracle_type']; 
      }
      if (isset($_SESSION['scriptcase']['ibase_charset']))
      {
          $this->nm_arr_db_extra_args['ibase_charset'] = $_SESSION['scriptcase']['ibase_charset']; 
      }
      if (isset($_SESSION['scriptcase']['ibase_rolename']))
      {
          $this->nm_arr_db_extra_args['ibase_rolename'] = $_SESSION['scriptcase']['ibase_rolename']; 
      }
      if (isset($_SESSION['scriptcase']['ibase_dialect']))
      {
          $this->nm_arr_db_extra_args['ibase_dialect'] = $_SESSION['scriptcase']['ibase_dialect']; 
      }
      if (isset($_SESSION['scriptcase']['security']))
      {
          $this->nm_arr_db_extra_args['security'] = $_SESSION['scriptcase']['security']; 
      }
      if (isset($_SESSION['scriptcase']['sslservercertificate']))
      {
          $this->nm_arr_db_extra_args['sslservercertificate'] = $_SESSION['scriptcase']['sslservercertificate']; 
      }
      if (isset($_SESSION['scriptcase']['sslclientkeystoredb']))
      {
          $this->nm_arr_db_extra_args['sslclientkeystoredb'] = $_SESSION['scriptcase']['sslclientkeystoredb']; 
      }
      if (isset($_SESSION['scriptcase']['sslclientkeystash']))
      {
          $this->nm_arr_db_extra_args['sslclientkeystash'] = $_SESSION['scriptcase']['sslclientkeystash']; 
      }
      if (isset($_SESSION['scriptcase']['authentication']))
      {
          $this->nm_arr_db_extra_args['authentication'] = $_SESSION['scriptcase']['authentication']; 
      }
      if (isset($_SESSION['scriptcase']['sslclientlabel']))
      {
          $this->nm_arr_db_extra_args['sslclientlabel'] = $_SESSION['scriptcase']['sslclientlabel']; 
      }
      if (isset($_SESSION['scriptcase']['use_ssh']))
      {
          $this->nm_arr_db_extra_args['use_ssh'] = $_SESSION['scriptcase']['use_ssh']; 
      }
      if (isset($_SESSION['scriptcase']['ssh_server']))
      {
          $this->nm_arr_db_extra_args['ssh_server'] = $_SESSION['scriptcase']['ssh_server']; 
      }
      if (isset($_SESSION['scriptcase']['ssh_user']))
      {
          $this->nm_arr_db_extra_args['ssh_user'] = $_SESSION['scriptcase']['ssh_user']; 
      }
      if (isset($_SESSION['scriptcase']['ssh_port']))
      {
          $this->nm_arr_db_extra_args['ssh_port'] = $_SESSION['scriptcase']['ssh_port']; 
      }
      if (isset($_SESSION['scriptcase']['ssh_privatecert']))
      {
          $this->nm_arr_db_extra_args['ssh_privatecert'] = $_SESSION['scriptcase']['ssh_privatecert']; 
      }
      if (isset($_SESSION['scriptcase']['ssh_localserver']))
      {
          $this->nm_arr_db_extra_args['ssh_localserver'] = $_SESSION['scriptcase']['ssh_localserver']; 
      }
      if (isset($_SESSION['scriptcase']['ssh_localport']))
      {
          $this->nm_arr_db_extra_args['ssh_localport'] = $_SESSION['scriptcase']['ssh_localport']; 
      }
      if (isset($_SESSION['scriptcase']['ssh_localportforwarding']))
      {
          $this->nm_arr_db_extra_args['ssh_localportforwarding'] = $_SESSION['scriptcase']['ssh_localportforwarding']; 
      }
      if (isset($_SESSION['scriptcase']['glo_use_persistent']))
      {
          $this->nm_con_persistente = $_SESSION['scriptcase']['glo_use_persistent']; 
      }
      if (isset($_SESSION['scriptcase']['glo_use_schema']))
      {
          $this->nm_con_use_schema = $_SESSION['scriptcase']['glo_use_schema']; 
      }
      $this->date_delim  = "'";
      $this->date_delim1 = "'";
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sybase))
      {
          $this->date_delim  = "";
          $this->date_delim1 = "";
      }
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_access))
      {
          $this->date_delim  = "#";
          $this->date_delim1 = "#";
      }
      if (isset($_SESSION['scriptcase']['glo_decimal_db']) && !empty($_SESSION['scriptcase']['glo_decimal_db']))
      {
          $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['decimal_db'] = $_SESSION['scriptcase']['glo_decimal_db']; 
      }
      if (isset($_SESSION['scriptcase']['glo_date_separator']) && !empty($_SESSION['scriptcase']['glo_date_separator']))
      {
          $SC_temp = trim($_SESSION['scriptcase']['glo_date_separator']);
          if (strlen($SC_temp) == 2)
          {
              $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['SC_sep_date']  = substr($SC_temp, 0, 1); 
              $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['SC_sep_date1'] = substr($SC_temp, 1, 1); 
          }
          else
           {
              $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['SC_sep_date']  = $SC_temp; 
              $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['SC_sep_date1'] = $SC_temp; 
          }
          $this->date_delim  = $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['SC_sep_date'];
          $this->date_delim1 = $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['SC_sep_date1'];
      }
// 
      if (!empty($this->nm_falta_var) || !empty($this->nm_falta_var_db) || $nm_crit_perfil)
      {
         $str_message = "<html>

<head>
    <title>{var_str_title}</title>
    <style>
        body {
            margin: 0px;
            padding: 0px;
            overflow-x: hidden;
            min-width: 320px;
            background: #FFFFFF;
            font-family: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif;
            font-size: 14px;
            line-height: 1.4285em;
            color: rgba(0, 0, 0, 0.87);
            font-smoothing: antialiased;
        }

        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        user agent stylesheet body {
            display: block;
            margin: 8px;
        }

        html {
            font-size: 14px;
        }

        html {
            line-height: 1.15;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        ::selection {
            background-color: #CCE2FF;
            color: rgba(0, 0, 0, 0.87);
        }

        .ui.container {
            width: 933px;
            min-width: 992px;
            max-width: 1199px;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        .ui.container {
            display: block;
            max-width: 100% !important;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        .ui.message:last-child {
            margin-bottom: 0em;
        }

        .ui.message:first-child {
            margin-top: 0em;
        }

        .ui.message {
            font-size: 1em;
        }

        .ui.message {
            position: relative;
            min-height: 1em;
            margin: 1em 0em;
            background: #F8F8F9;
            padding: 1em 1.5em;
            line-height: 1.4285em;
            color: rgba(0, 0, 0, 0.87);
            transition: opacity 0.1s ease, color 0.1s ease, background 0.1s ease, box-shadow 0.1s ease;
            border-radius: 0.28571429rem;
            box-shadow: 0px 0px 0px 1px rgba(34, 36, 38, 0.22) inset, 0px 0px 0px 0px rgba(0, 0, 0, 0);
        }

        article,
        aside,
        footer,
        header,
        nav,
        section {
            display: block;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        .ui.message> :last-child {
            margin-bottom: 0em;
        }

        .ui.message> :first-child {
            margin-top: 0em;
        }

        .ui.message .header+p {
            margin-top: 0.25em;
        }

        .ui.message p {
            opacity: 0.85;
            margin: 0.75em 0em;
        }

        p {
            margin: 0em 0em 1em;
            line-height: 1.4285em;
        }

        .ui.message .header:not(.ui) {
            font-size: 1.14285714em;
        }

        .ui.message .header {
            display: block;
            font-family: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif;
            font-weight: bold;
            margin: -0.14285714em 0em 1.2rem 0em;
        }

        .ui.button {
            cursor: pointer;
            display: inline-block;
            min-height: 1em;
            outline: 0;
            border: none;
            vertical-align: baseline;
            background: #e0e1e2 none;
            color: rgba(0, 0, 0, .6);
            font-family: Lato, 'Helvetica Neue', Arial, Helvetica, sans-serif;
            margin: 0 .25em 0 0;
            padding: .78571429em 1.5em .78571429em;
            text-transform: none;
            text-shadow: none;
            font-weight: 700;
            line-height: 1em;
            font-style: normal;
            text-align: center;
            text-decoration: none;
            border-radius: .28571429rem;
            box-shadow: 0 0 0 1px transparent inset, 0 0 0 0 rgba(34, 36, 38, .15) inset;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            transition: opacity .1s ease, background-color .1s ease, color .1s ease, box-shadow .1s ease, background .1s ease;
            will-change: '';
            -webkit-tap-highlight-color: transparent;
        }
        
        .ui.button,
        .ui.buttons .button,
        .ui.buttons .or {
            font-size: 1rem;
            flex-flow: row nowrap;
            justify-content: center;
            align-items: center;
            column-gap: .5rem;
            display: flex;
        }
        
        .ui.primary.button,
        .ui.primary.buttons .button {
            background-color: #2185d0;
            color: #fff;
            text-shadow: none;
            background-image: none;
        }
        
        .ui.primary.button {
            box-shadow: 0 0 0 0 rgba(34, 36, 38, .15) inset;
        }

        [type=reset], [type=submit], button, html [type=button] {
            -webkit-appearance: button;
        }

        .icon{
            position: relative;
            width: 1.2rem;
            height: 1.2rem;
            display: block;
            color: inherit;
            background-repeat: no-repeat;
        }

        .icon.database{
            background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 448 512\" fill=\"%23FFFFFF\"><path d=\"M448 80v48c0 44.2-100.3 80-224 80S0 172.2 0 128V80C0 35.8 100.3 0 224 0S448 35.8 448 80zM393.2 214.7c20.8-7.4 39.9-16.9 54.8-28.6V288c0 44.2-100.3 80-224 80S0 332.2 0 288V186.1c14.9 11.8 34 21.2 54.8 28.6C99.7 230.7 159.5 240 224 240s124.3-9.3 169.2-25.3zM0 346.1c14.9 11.8 34 21.2 54.8 28.6C99.7 390.7 159.5 400 224 400s124.3-9.3 169.2-25.3c20.8-7.4 39.9-16.9 54.8-28.6V432c0 44.2-100.3 80-224 80S0 476.2 0 432V346.1z\"/></svg>');
        }
    </style>
</head>

<body>
    <div class='ui container' style='padding-top:2rem'>
        <section class='ui message'>
            <div class='content'>
                <div class='header'>
                    <h1 class='ui header'>{var_str_title}</h1>
                </div>
                <p>{var_str_message}</p>
                <p>{var_str_message_conn}</p>
                {v_str_btn_inside}
            </div>
        </section>
    </div>";
         $str_message_end = "</body>
</html>";
         $str_message = str_replace('{var_str_title}', $this->Nm_lang['lang_errm_dbcn_create'], $str_message);
          if (empty($this->nm_falta_var_db))
          {
              if (!empty($this->nm_falta_var))
              {
                  $str_message = str_replace('{var_str_message}', $this->Nm_lang['lang_errm_glob'] . $this->nm_falta_var, $str_message);
                  $str_message = str_replace('{var_str_message_conn}','', $str_message);
              }
              elseif ($nm_crit_perfil)
              {
                  $str_message = str_replace('{var_str_message}', $this->Nm_lang['lang_errm_dbcn_nfnd'], $str_message);
                  $str_message = str_replace('{var_str_message_conn}', $this->Nm_lang['lang_errm_dbcn_conn_nfnd'] . ' ' . $perfil_trab, $str_message);
                  $str_message = str_replace('{v_str_btn_inside}', "<button class='ui button primary' style='font-size: 16px !important;'><a href='" . $this->path_prod . "' style='color: white;text-decoration:none'><i class='icon database' style='float: left;padding-right: .5rem;'></i>". $this->Nm_lang['lang_errm_dbcn_create'] ."</a></button>", $str_message);
              }
          }
          else
          {
                  $str_message = str_replace('{var_str_message}', $this->Nm_lang['lang_errm_dbcn_data'], $str_message);
          }
         $str_message = str_replace('{var_str_message_conn}','', $str_message);
         $str_message = str_replace('{v_str_btn_inside}', '', $str_message);
          echo $str_message;
          if (!$_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['sc_outra_jan']) || !$_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['sc_outra_jan'])) 
          { 
              if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno'])) 
              { 
               $btn_value = "" . $this->Ini->Nm_lang['lang_btns_back'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_value))
               {
                   $btn_value = sc_convert_encoding($btn_value, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
               $btn_hint = "" . $this->Ini->Nm_lang['lang_btns_back_hint'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_hint))
               {
                   $btn_hint = sc_convert_encoding($btn_hint, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
?>
                   <input type="button" id="sai" onClick="window.location='<?php echo $_SESSION['scriptcase']['nm_sc_retorno'] ?>'; return false" class="scButton_default" value="<?php echo $btn_value ?>" title="<?php echo $btn_hint ?>" style="vertical-align: middle;">

<?php
              } 
              elseif(!empty($nm_url_saida)) 
              { 
               $btn_value = "" . $this->Ini->Nm_lang['lang_btns_exit'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_value))
               {
                   $btn_value = sc_convert_encoding($btn_value, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
               $btn_hint = "" . $this->Ini->Nm_lang['lang_btns_exit_hint'] . "";
               if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($btn_hint))
               {
                   $btn_hint = sc_convert_encoding($btn_hint, $_SESSION['scriptcase']['charset'], "UTF-8");
               }
?>
                   <input type="button" id="sai" onClick="window.location='<?php echo $nm_url_saida ?>'; return false" class="scButton_default" value="<?php echo $btn_value ?>" title="<?php echo $btn_hint ?>" style="vertical-align: middle;">

<?php
              } 
          } 
          echo $str_message_end;
          exit ;
      }
      if (isset($_SESSION['scriptcase']['glo_db_master_usr']) && !empty($_SESSION['scriptcase']['glo_db_master_usr']))
      {
          $this->nm_usuario = $_SESSION['scriptcase']['glo_db_master_usr']; 
      }
      if (isset($_SESSION['scriptcase']['glo_db_master_pass']) && !empty($_SESSION['scriptcase']['glo_db_master_pass']))
      {
          $this->nm_senha = $_SESSION['scriptcase']['glo_db_master_pass']; 
      }
      if (isset($_SESSION['scriptcase']['glo_db_master_cript']) && !empty($_SESSION['scriptcase']['glo_db_master_cript']))
      {
          $_SESSION['scriptcase']['glo_senha_protect'] = $_SESSION['scriptcase']['glo_db_master_cript']; 
      }
   }
   function conectDB()
   {
      global $glo_senha_protect;
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && isset($_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_conexao']))
      { 
          $this->Db = db_conect_devel($_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_conexao'], $this->root . $this->path_prod, 'NRSVP115_10_AWS_APP', 1, $this->force_db_utf8); 
      } 
      else 
      { 
          ob_start();
          $databaseEncoding = $this->force_db_utf8 ? 'utf8' : $this->nm_database_encoding;
          $this->Db = db_conect($this->nm_tpbanco, $this->nm_servidor, $this->nm_usuario, $this->nm_senha, $this->nm_banco, $glo_senha_protect, "S", $this->nm_con_persistente, $this->nm_con_db2, $databaseEncoding, $this->nm_arr_db_extra_args); 
          if (!isset($this->Ajax_result_set)) {$this->Ajax_result_set = ob_get_contents();}
          ob_end_clean();
      } 
      if (!isset($_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['embutida']) || !$_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['embutida'])
      {
          if (substr($_POST['nmgp_opcao'], 0, 5) == "ajax_")
          {
              ob_start();
          } 
      } 
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
          } 
          $GLOBALS["NM_ERRO_IBASE"] = 1;  
          $this->Ibase_version = "old";
          if ($ibase_version = $this->Db->Execute("SELECT RDB\$GET_CONTEXT('SYSTEM','ENGINE_VERSION') AS \"Version\" FROM RDB\$DATABASE"))
          {
              if (isset($ibase_version->fields[0]) && substr($ibase_version->fields[0], 0, 1) > 2) {$this->Ibase_version = "new";}
          }
      } 
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_sybase))
      {
          $this->Db->fetchMode = ADODB_FETCH_BOTH;
          $this->Db->Execute("set dateformat ymd");
          $this->Db->Execute("set quoted_identifier ON");
      } 
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_db2))
      {
          $this->Db->fetchMode = ADODB_FETCH_NUM;
      } 
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mssql))
      {
          $this->Db->Execute("set dateformat ymd");
      } 
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_oracle))
      {
          $this->Db->Execute("alter session set nls_date_format         = 'yyyy-mm-dd hh24:mi:ss'");
          $this->Db->Execute("alter session set nls_timestamp_format    = 'yyyy-mm-dd hh24:mi:ss'");
          $this->Db->Execute("alter session set nls_timestamp_tz_format = 'yyyy-mm-dd hh24:mi:ss'");
          $this->Db->Execute("alter session set nls_time_format         = 'hh24:mi:ss'");
          $this->Db->Execute("alter session set nls_time_tz_format      = 'hh24:mi:ss'");
          $this->Db->Execute("alter session set nls_numeric_characters  = '.,'");
          $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['decimal_db'] = "."; 
      } 
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_postgres))
      {
          $this->Db->Execute("SET DATESTYLE TO ISO");
      } 
      if (!isset($_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['embutida']) || !$_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['embutida'])
      {
          if (substr($_POST['nmgp_opcao'], 0, 5) == "ajax_")
          {
              ob_end_clean();
          } 
      } 
   }
   function regionalDefault()
   {
       $_SESSION['scriptcase']['reg_conf']['date_format']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['data_format']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['data_format'] : "ddmmyyyy";
       $_SESSION['scriptcase']['reg_conf']['date_sep']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['data_sep']))                 ?  $this->Nm_conf_reg[$this->str_conf_reg]['data_sep'] : "/";
       $_SESSION['scriptcase']['reg_conf']['date_week_ini'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['prim_dia_sema']))            ?  $this->Nm_conf_reg[$this->str_conf_reg]['prim_dia_sema'] : "SU";
       $_SESSION['scriptcase']['reg_conf']['time_format']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_format']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_format'] : "hhiiss";
       $_SESSION['scriptcase']['reg_conf']['time_sep']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_sep']))                 ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_sep'] : ":";
       $_SESSION['scriptcase']['reg_conf']['time_pos_ampm'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_pos_ampm']))            ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_pos_ampm'] : "right_without_space";
       $_SESSION['scriptcase']['reg_conf']['time_simb_am']  = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_am']))          ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_am'] : "am";
       $_SESSION['scriptcase']['reg_conf']['time_simb_pm']  = (isset($this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_pm']))          ?  $this->Nm_conf_reg[$this->str_conf_reg]['hora_simbolo_pm'] : "pm";
       $_SESSION['scriptcase']['reg_conf']['simb_neg']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_sinal_neg']))            ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_sinal_neg'] : "-";
       $_SESSION['scriptcase']['reg_conf']['grup_num']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_sep_agr']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_sep_agr'] : ".";
       $_SESSION['scriptcase']['reg_conf']['dec_num']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_sep_dec']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_sep_dec'] : ",";
       $_SESSION['scriptcase']['reg_conf']['neg_num']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_format_num_neg']))       ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_format_num_neg'] : 2;
       $_SESSION['scriptcase']['reg_conf']['monet_simb']    = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_simbolo']))        ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_simbolo'] : "R$";
       $_SESSION['scriptcase']['reg_conf']['monet_f_pos']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_pos'])) ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_pos'] : 3;
       $_SESSION['scriptcase']['reg_conf']['monet_f_neg']   = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_neg'])) ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_format_num_neg'] : 13;
       $_SESSION['scriptcase']['reg_conf']['grup_val']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_agr']))        ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_agr'] : ".";
       $_SESSION['scriptcase']['reg_conf']['dec_val']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_dec']))        ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_sep_dec'] : ",";
       $_SESSION['scriptcase']['reg_conf']['html_dir']      = (isset($this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl']))              ?  " DIR='" . $this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl'] . "'" : "";
       $_SESSION['scriptcase']['reg_conf']['css_dir']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl']))              ?  $this->Nm_conf_reg[$this->str_conf_reg]['ger_ltr_rtl'] : "LTR";
       $_SESSION['scriptcase']['reg_conf']['num_group_digit']       = (isset($this->Nm_conf_reg[$this->str_conf_reg]['num_group_digit']))       ?  $this->Nm_conf_reg[$this->str_conf_reg]['num_group_digit'] : "1";
       $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'] = (isset($this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_group_digit'])) ?  $this->Nm_conf_reg[$this->str_conf_reg]['unid_mont_group_digit'] : "1";
       eval ('set'.$this->Control_Css.$this->Tree_img_type.'("'.$this->nm_script_type.'SESSID_",base64_encode("'.$this->nm_script_by.'?".substr(md5(mt_rand()),8,16)),time()+86400,\'/\', \'\', ini_get(\'session.cookie_secure\'), ini_get(\'session.cookie_httponly\'));');
   }
// 

   function scCsrfGetToken()
   {
       if (!isset($_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['csrf_token']))
       {
           $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['csrf_token'] = $this->scCsrfGenerateToken();
       }

       return $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['csrf_token'];
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

   function sc_Include($path, $tp, $name)
   {
       if ((empty($tp) && empty($name)) || ($tp == "F" && !function_exists($name)) || ($tp == "C" && !class_exists($name)))
       {
           include_once($path);
       }
   } // sc_Include
   function sc_Sql_Protect($var, $tp, $conex="")
   {
       if (empty($conex) || $conex == "conn_mysql")
       {
           $TP_banco = $_SESSION['scriptcase']['glo_tpbanco'];
       }
       else
       {
           eval ("\$TP_banco = \$this->nm_con_" . $conex . "['tpbanco'];");
       }
       if ($tp == "date")
       {
           $delim  = "'";
           $delim1 = "'";
           if (in_array(strtolower($TP_banco), $this->nm_bases_access))
           {
               $delim  = "#";
               $delim1 = "#";
           }
           if (isset($_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['SC_sep_date']))
           {
               $delim  = $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['SC_sep_date'];
               $delim1 = $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['SC_sep_date1'];
           }
           return $delim . $var . $delim1;
       }
       else
       {
           return $var;
       }
   } // sc_Sql_Protect
   function sc_Date_Protect($val_dt)
   {
       $dd = substr($val_dt, 8, 2);
       $mm = substr($val_dt, 5, 2);
       $yy = substr($val_dt, 0, 4);
       $hh = (strlen($val_dt) > 10) ? substr($val_dt, 10) : "";
       if ($mm > 12) {
           $mm = 12;
       }
       $dd_max = 31;
       if ($mm == '04' || $mm == '06' || $mm == '09' || $mm == 11) {
           $dd_max = 30;
       }
       if ($mm == '02') {
           $dd_max = ($yy % 4 == 0) ? 29 : 28;
       }
       if ($dd > $dd_max) {
           $dd = $dd_max;
       }
       return $yy . "-" . $mm . "-" . $dd . $hh;
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
        function appIsSsl() {
                if (isset($_SERVER['HTTPS'])) {
                        if ('on' == strtolower($_SERVER['HTTPS'])) {
                                return true;
                        }
                        if ('1' == $_SERVER['HTTPS']) {
                                return true;
                        }
                }

                if (isset($_SERVER['REQUEST_SCHEME'])) {
                        if ('https' == $_SERVER['REQUEST_SCHEME']) {
                                return true;
                        }
                }

                if (isset($_SERVER['SERVER_PORT'])) {
                        if ('443' == $_SERVER['SERVER_PORT']) {
                                return true;
                        }
                }

                return false;
        }
   function Get_Gb_date_format($GB, $cmp)
   {
       return (isset($_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['SC_Gb_date_format'][$GB][$cmp])) ? $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['SC_Gb_date_format'][$GB][$cmp] : "";
   }

   function Get_Gb_prefix_date_format($GB, $cmp)
   {
       return (isset($_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['SC_Gb_prefix_date_format'][$GB][$cmp])) ? $_SESSION['sc_session'][$this->sc_page]['grid_geral_rsvp_r']['SC_Gb_prefix_date_format'][$GB][$cmp] : "";
   }

   function GB_date_format($val, $format, $prefix="", $conf_region="S", $mask="")
   {
           return $val;
   }
   function Get_arg_groupby($val, $format)
   {
       return $val; 
   }
   function Get_format_dimension($ind_ini, $ind_qb, $campo, $rs, $conf_region="S", $mask="")
   {
       $retorno    = array();
       $format     = $this->Get_Gb_date_format($ind_qb, $campo);
       $Prefix_dat = $this->Get_Gb_prefix_date_format($ind_qb, $campo);
       if (empty($format) || $rs->fields[$ind_ini] == "")
       {
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $rs->fields[$ind_ini];
           return $retorno;
       }
       if ($format == 'YYYYMMDDHHIISS')
       {
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $this->GB_date_format($rs->fields[$ind_ini], $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYYMMDDHHII')
       {
           $this->Ajust_fields($ind_ini, $rs, "1,2,3,4");
           $temp            = $rs->fields[$ind_ini] . "-" . $rs->fields[$ind_ini + 1] . "-" . $rs->fields[$ind_ini + 2] . " " . $rs->fields[$ind_ini + 3] . ":" . $rs->fields[$ind_ini + 4];
           $retorno['orig'] = $temp;
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYYMMDDHH')
       {
           $this->Ajust_fields($ind_ini, $rs, "1,2,3");
           $temp            = $rs->fields[$ind_ini] . "-" . $rs->fields[$ind_ini + 1] . "-" . $rs->fields[$ind_ini + 2] . " " . $rs->fields[$ind_ini + 3];
           $retorno['orig'] = $temp;
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYYMMDD2')
       {
           $this->Ajust_fields($ind_ini, $rs, "1,2");
           $temp            = $rs->fields[$ind_ini] . "-" . $rs->fields[$ind_ini + 1] . "-" . $rs->fields[$ind_ini + 2];
           $retorno['orig'] = $temp;
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYYMM')
       {
           $this->Ajust_fields($ind_ini, $rs, "1");
           $temp            = $rs->fields[$ind_ini] . "-" . $rs->fields[$ind_ini + 1];
           $retorno['orig'] = $temp;
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'MMDD')
       {
           $this->Ajust_fields($ind_ini, $rs, "0,1");
           $temp            = "0000-" . $rs->fields[$ind_ini] . "-" . $rs->fields[$ind_ini + 1];
           $retorno['orig'] = $temp;
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYY')
       {
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $this->GB_date_format($rs->fields[$ind_ini], $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'BIMONTHLY' || $format == 'QUARTER' || $format == 'FOURMONTHS' || $format == 'SEMIANNUAL' || $format == 'WEEK')
       {
           $temp            = (substr($rs->fields[$ind_ini], 0, 1) == 0) ? substr($rs->fields[$ind_ini], 1) : $rs->fields[$ind_ini];
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $Prefix_dat . $temp;
           return $retorno;
       }
       if ($format == 'DAYNAME'|| $format == 'YYYYDAYNAME')
       {
           if ($format == 'DAYNAME')
           {
               $retorno['orig'] = $rs->fields[$ind_ini];
               $ano             = "";
               $daynum          = $rs->fields[$ind_ini];
           }
           else
           {
               $retorno['orig'] = $rs->fields[$ind_ini] . $rs->fields[$ind_ini + 1];
               $ano             = " " . $rs->fields[$ind_ini];
               $daynum          = $rs->fields[$ind_ini + 1];
           }
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_access) || in_array(strtolower($this->nm_tpbanco), $this->nm_bases_oracle) || in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mssql) || in_array(strtolower($this->nm_tpbanco), $this->nm_bases_db2) || in_array(strtolower($this->nm_tpbanco), $this->nm_bases_progress))
           {
               $daynum--;
           }
           if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_mysql))
           {
               $daynum = ($daynum == 6) ? 0 : $daynum + 1;
           }
           if ($daynum == 0) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_sund'] . $ano;
           }
           if ($daynum == 1) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_mond'] . $ano;
           }
           if ($daynum == 2) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_tued'] . $ano;
           }
           if ($daynum == 3) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_wend'] . $ano;
           }
           if ($daynum == 4) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_thud'] . $ano;
           }
           if ($daynum == 5) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_frid'] . $ano;
           }
           if ($daynum == 6) {
               $retorno['fmt'] = $Prefix_dat . $this->Nm_lang['lang_days_satd'] . $ano;
           }
           return $retorno;
       }
       if ($format == 'HH')
       {
           $this->Ajust_fields($ind_ini, $rs, "0");
           $temp            = "0000-00-00 " . $rs->fields[$ind_ini];
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'DD')
       {
           $this->Ajust_fields($ind_ini, $rs, "0");
           $temp            = "0000-00-" . $rs->fields[$ind_ini];
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'MM')
       {
           $this->Ajust_fields($ind_ini, $rs, "0");
           $temp            = "0000-" . $rs->fields[$ind_ini];
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYY')
       {
           $temp            = $rs->fields[$ind_ini];
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYYHH')
       {
           $this->Ajust_fields($ind_ini, $rs, "1");
           $temp            = $rs->fields[$ind_ini] . "-00-00 " . $rs->fields[$ind_ini + 1];
           $retorno['orig'] = $rs->fields[$ind_ini] . $rs->fields[$ind_ini + 1];
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       if ($format == 'YYYYDD')
       {
           $this->Ajust_fields($ind_ini, $rs, "1");
           $temp            = $rs->fields[$ind_ini] . "-00-" . $rs->fields[$ind_ini + 1];
           $retorno['orig'] = $rs->fields[$ind_ini] . $rs->fields[$ind_ini + 1];
           $retorno['fmt']  = $this->GB_date_format($temp, $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       elseif ($format == 'YYYYBIMONTHLY' || $format == 'YYYYQUARTER' || $format == 'YYYYFOURMONTHS' || $format == 'YYYYSEMIANNUAL')
       {
           $temp            = (substr($rs->fields[$ind_ini + 1], 0, 1) == 0) ? substr($rs->fields[$ind_ini + 1], 1) : $rs->fields[$ind_ini + 1];
           $retorno['orig'] = $rs->fields[$ind_ini] . $rs->fields[$ind_ini + 1];
           $retorno['fmt']  = $Prefix_dat . $temp . " " . $rs->fields[$ind_ini];
           return $retorno;
       }
       elseif ($format == 'YYYYWEEK')
       {
           $temp            = (substr($rs->fields[$ind_ini + 1], 0, 1) == 0) ? substr($rs->fields[$ind_ini + 1], 1) : $rs->fields[$ind_ini + 1];
           $retorno['orig'] = (strlen($rs->fields[$ind_ini + 1]) == 1) ? $rs->fields[$ind_ini] . "0" . $rs->fields[$ind_ini + 1] : $rs->fields[$ind_ini] . $rs->fields[$ind_ini + 1];
           $retorno['fmt']  = $Prefix_dat . $temp . " " . $rs->fields[$ind_ini];
           return $retorno;
       }
       if ($format == 'YYYYHH' || $format == 'YYYYDD')
       {
           $this->Ajust_fields($ind_ini, $rs, "1");
           $retorno['orig'] = $rs->fields[$ind_ini] . $rs->fields[$ind_ini + 1];
           $retorno['fmt']  = $rs->fields[$ind_ini] . $_SESSION['scriptcase']['reg_conf']['date_sep'] . $rs->fields[$ind_ini + 1];
           return $retorno;
       }
       elseif ($format == 'HHIISS')
       {
           $this->Ajust_fields($ind_ini, $rs, "0,1,2");
           $retorno['orig'] = $rs->fields[$ind_ini] . ":" . $rs->fields[$ind_ini + 1] . ":" . $rs->fields[$ind_ini + 2];
           $retorno['fmt']  = $this->GB_date_format("0000-00-00 " . $retorno['orig'], $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       elseif ($format == 'HHII')
       {
           $this->Ajust_fields($ind_ini, $rs, "0,1");
           $retorno['orig'] = $rs->fields[$ind_ini] . ":" . $rs->fields[$ind_ini + 1];
           $retorno['fmt']  = $this->GB_date_format("0000-00-00 " . $retorno['orig'], $format, $Prefix_dat, $conf_region, $mask);
           return $retorno;
       }
       else
       {
           $retorno['orig'] = $rs->fields[$ind_ini];
           $retorno['fmt']  = $rs->fields[$ind_ini];
           return $retorno;
       }
   }
   function Ajust_fields($ind_ini, &$rs, $parts)
   {
       $prep = explode(",", $parts);
       foreach ($prep as $ind)
       {
           $ind_ok = $ind_ini + $ind;
           $rs->fields[$ind_ok] = (int) $rs->fields[$ind_ok];
           if (strlen($rs->fields[$ind_ok]) == 1)
           {
               $rs->fields[$ind_ok] = "0" . $rs->fields[$ind_ok];
           }
       }
   }
   function Get_date_order_groupby($sql_def, $order, $format="", $order_old="")
   {
       $order      = " " . trim($order);
       $order_old .= (!empty($order_old)) ? ", " : "";
       return $order_old . $sql_def . $order;
   }
}
//===============================================================================
//
class grid_geral_rsvp_r_sub_css
{
   function __construct()
   {
      global $script_case_init;
      $str_schema_all = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_Rhino/Sc9_Rhino";
      if ($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['SC_herda_css'] == "N")
      {
          $_SESSION['sc_session'][$script_case_init]['SC_sub_css']['grid_geral_rsvp_r']    = $str_schema_all . "_grid.css";
          $_SESSION['sc_session'][$script_case_init]['SC_sub_css_bw']['grid_geral_rsvp_r'] = $str_schema_all . "_grid_bw.css";
      }
   }
}
//
class grid_geral_rsvp_r_apl
{
   var $Ini;
   var $Erro;
   var $Db;
   var $Lookup;
   var $nm_location;
   var $NM_ajax_flag  = false;
   var $NM_ajax_opcao = '';
   var $grid;
   var $Res;
   var $Graf;
   var $pesq;
   var $pdf;
   var $xls;
   var $xml;
   var $json;
   var $csv;
   var $rtf;
//
//----- 
   function prep_modulos($modulo)
   {
      $this->$modulo->Ini = $this->Ini;
      $this->$modulo->Db = $this->Db;
      $this->$modulo->Erro = $this->Erro;
      $this->$modulo->Lookup = $this->Lookup;
      $this->$modulo->arr_buttons = $this->arr_buttons;
   }
//

function getPaddingFromCss($cssRule)
{
    $paddingInfo = [
        'top' => '',
        'bottom' => '',
        'left' => '',
        'right' => '',
    ];

    $cssRuleParts = explode(' ', trim($cssRule));
    $partsCount = count($cssRuleParts);

    if (4 == $partsCount) {
        $paddingInfo['top'] = $cssRuleParts[0];
        $paddingInfo['right'] = $cssRuleParts[1];
        $paddingInfo['bottom'] = $cssRuleParts[2];
        $paddingInfo['left'] = $cssRuleParts[3];
    } elseif (3 == $partsCount) {
        $paddingInfo['top'] = $cssRuleParts[0];
        $paddingInfo['right'] = $cssRuleParts[1];
        $paddingInfo['bottom'] = $cssRuleParts[2];
        $paddingInfo['left'] = $cssRuleParts[1];
    } elseif (2 == $partsCount) {
        $paddingInfo['top'] = $cssRuleParts[0];
        $paddingInfo['right'] = $cssRuleParts[1];
        $paddingInfo['bottom'] = $cssRuleParts[0];
        $paddingInfo['left'] = $cssRuleParts[1];
    } else {
        $paddingInfo['top'] = $cssRuleParts[0];
        $paddingInfo['right'] = $cssRuleParts[0];
        $paddingInfo['bottom'] = $cssRuleParts[0];
        $paddingInfo['left'] = $cssRuleParts[0];
    }

    return $paddingInfo;
}

//----- 
   function controle($linhas = 0)
   {
      global $nm_saida, $nm_url_saida, $script_case_init, $nmgp_parms_pdf, $nmgp_graf_pdf, $nm_apl_dependente, $nmgp_navegator_print, $nmgp_tipo_print, $nmgp_cor_print, $nmgp_Subcons_out, $nmgp_cor_word, $Det_use_pass_pdf, $Det_pdf_zip, $NMSC_conf_apl, $NM_contr_var_session, $NM_run_iframe, $SC_module_export, $nmgp_password,
             $glo_senha_protect, $nmgp_opcao, $nm_call_php, $rec, $nmgp_quant_linhas, $nmgp_fast_search, $nmgp_cond_fast_search, $nmgp_arg_fast_search, $nmgp_ordem, $SC_sub_toolbar, $no_nested, $nested_grid, $SC_ExportPrtFrame;

      $Parms_form_pdf = false;
      if (isset($_SESSION['sc_session']['scriptcase']['embutida_form_pdf']['grid_geral_rsvp_r']))
      { 
          $GLOBALS['nmgp_parms'] = $_SESSION['sc_session']['scriptcase']['embutida_form_pdf']['grid_geral_rsvp_r'];
          $Parms_form_pdf = true;
      } 
      if ($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida'] || $Parms_form_pdf)
      { 
          if (!empty($GLOBALS['nmgp_parms'])) 
          { 
              $GLOBALS['nmgp_parms'] = str_replace("@aspass@", "'", $GLOBALS['nmgp_parms']);
              $todox = str_replace("?#?@?@?", "?#?@ ?@?", $GLOBALS["nmgp_parms"]);
              $todo  = explode("?@?", $todox);
              foreach ($todo as $param)
              {
                   $cadapar = explode("?#?", $param);
                   if (1 < sizeof($cadapar))
                   {
                       if (substr($cadapar[0], 0, 11) == "SC_glo_par_")
                       {
                           $cadapar[0] = substr($cadapar[0], 11);
                           $cadapar[1] = $_SESSION[$cadapar[1]];
                       }
                       if (isset($GLOBALS['sc_conv_var'][$cadapar[0]]))
                       {
                           $cadapar[0] = $GLOBALS['sc_conv_var'][$cadapar[0]];
                       }
                       elseif (isset($GLOBALS['sc_conv_var'][strtolower($cadapar[0])]))
                       {
                           $cadapar[0] = $GLOBALS['sc_conv_var'][strtolower($cadapar[0])];
                       }
                       nm_limpa_str_grid_geral_rsvp_r($cadapar[1]);
                       nm_protect_num_grid_geral_rsvp_r($cadapar[0], $cadapar[1]);
                       if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                       $Tmp_par   = $cadapar[0];
                       $$Tmp_par = $cadapar[1];
                       if ($Tmp_par == "nmgp_opcao")
                       {
                           $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['opcao'] = $cadapar[1];
                       }
                   }
              }
          } 
          if (isset($vg_evento_id)) 
          {
              $_SESSION['vg_evento_id'] = $vg_evento_id;
              nm_limpa_str_grid_geral_rsvp_r($_SESSION["vg_evento_id"]);
          }
          if (isset($vg_usuario_id)) 
          {
              $_SESSION['vg_usuario_id'] = $vg_usuario_id;
              nm_limpa_str_grid_geral_rsvp_r($_SESSION["vg_usuario_id"]);
          }
          if (isset($rsvp_global)) 
          {
              $_SESSION['rsvp_global'] = $rsvp_global;
              nm_limpa_str_grid_geral_rsvp_r($_SESSION["rsvp_global"]);
          }
          if (isset($vg_menu_item)) 
          {
              $_SESSION['vg_menu_item'] = $vg_menu_item;
              nm_limpa_str_grid_geral_rsvp_r($_SESSION["vg_menu_item"]);
          }
          if (isset($parm1)) 
          {
              $_SESSION['parm1'] = $parm1;
              nm_limpa_str_grid_geral_rsvp_r($_SESSION["parm1"]);
          }
          if (isset($vg_cpfseg)) 
          {
              $_SESSION['vg_cpfseg'] = $vg_cpfseg;
              nm_limpa_str_grid_geral_rsvp_r($_SESSION["vg_cpfseg"]);
          }
          if (isset($parm2)) 
          {
              $_SESSION['parm2'] = $parm2;
              nm_limpa_str_grid_geral_rsvp_r($_SESSION["parm2"]);
          }
      } 
      if ($Parms_form_pdf)
      { 
          $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida_pdf'] = true;
          $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida_form'] = true;
          $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida_form_full'] = false;
          $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida_pai'] = "";
      } 
      $_SESSION['scriptcase']['sc_ctl_ajax'] = 'part';
      if (!$this->Ini || isset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida_ibase'])) 
      { 
          $this->Ini = new grid_geral_rsvp_r_ini(); 
          $this->Ini->init();
      } 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'])
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida_ibase'] = true;
      }
      if (isset($SC_sub_toolbar) && !empty($SC_sub_toolbar)) {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_sub_toolbar'] = $SC_sub_toolbar;
      } 
      if (isset($_REQUEST['no_nested']) || (isset($nested_grid) && $nested_grid == 'N')) {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Hide_nested_grid'] = true;
      } 
      $this->Ini->Proc_print      = false;
      $this->Ini->Export_det_zip  = false;
      $this->Ini->Export_html_zip = false;
      $this->Ini->Export_zip      = false;
      $this->Ini->Export_img_zip  = false;
      $this->Ini->Img_export_zip  = array();
      $this->Ini->Embutida_iframe = (strpos($this->Ini->sc_page, "-") !== false) ? true : false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['emb_lig_aba'] = array();
      $this->Change_Menu = false;
      if (!isset($nmgp_opcao)) {
         $nmgp_opcao = "";
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'])) {
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = "";
      }
      if ($nmgp_opcao != "ajax_navigate" && $nmgp_opcao != "ajax_detalhe" && isset($_SESSION['scriptcase']['menu_atual']) && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['sc_outra_jan']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['sc_outra_jan'] || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['sc_modal']))
      {
          $this->sc_init_menu = "x";
          if (isset($_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['grid_geral_rsvp_r']))
          {
              $this->sc_init_menu = $_SESSION['scriptcase'][$_SESSION['scriptcase']['menu_atual']]['sc_init']['grid_geral_rsvp_r'];
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
          if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'] && $this->Ini->sc_page == $this->sc_init_menu && !isset($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['grid_geral_rsvp_r']))
          {
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['grid_geral_rsvp_r']['link'] = $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . "" . SC_dir_app_name('grid_geral_rsvp_r') . "/";
               $_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu]['grid_geral_rsvp_r']['label'] = "" . $this->Ini->Nm_lang['lang_othr_grid_title'] . " geral_rsvp_r";
               $this->Change_Menu = true;
          }
          elseif ($this->Ini->sc_page == $this->sc_init_menu)
          {
              $achou = false;
              foreach ($_SESSION['scriptcase']['menu_apls'][$_SESSION['scriptcase']['menu_atual']][$this->sc_init_menu] as $apl => $parms)
              {
                  if ($apl == "grid_geral_rsvp_r")
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'])
      {
          $this->Change_Menu = false;
      }
      $this->Db = $this->Ini->Db; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['nm_tpbanco'] = $this->Ini->nm_tpbanco;
      $this->nm_data = new nm_data("pt_br");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'])
      { 
          include_once($this->Ini->path_embutida . "grid_geral_rsvp_r/grid_geral_rsvp_r_erro.class.php"); 
      } 
      else 
      { 
          include_once($this->Ini->path_aplicacao . "grid_geral_rsvp_r_erro.class.php"); 
      } 
      $this->Erro      = new grid_geral_rsvp_r_erro();
      $this->Erro->Ini = $this->Ini;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'])
      { 
          require_once($this->Ini->path_embutida . "grid_geral_rsvp_r/grid_geral_rsvp_r_lookup.class.php"); 
      } 
      else 
      { 
          require_once($this->Ini->path_aplicacao . "grid_geral_rsvp_r_lookup.class.php"); 
      } 
      $this->Lookup       = new grid_geral_rsvp_r_lookup();
      $this->Lookup->Db   = $this->Db;
      $this->Lookup->Ini  = $this->Ini;
      $this->Lookup->Erro = $this->Erro;
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'])
      {
          $this->Ini->sc_Include($this->Ini->path_libs . "/nm_trata_saida.php", "C", "nm_trata_saida") ; 
          $nm_saida = new nm_trata_saida();
          $ajax_opc_print = false;
          if (isset($_POST['nmgp_opcao']) && $_POST['nmgp_opcao'] == "ajax_export")
          {
              $this->Ini->sc_export_ajax = true;
              $this->Ini->Arr_result     = array();
              $nmgp_opcao                = $_POST['export_opc'];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = $nmgp_opcao;
              if ($nmgp_opcao == "print" || $nmgp_opcao == "res_print" || $nmgp_opcao == "det_print")
              {
                  $ajax_opc_print   = true;
                  $nm_arquivo_print = "/sc_grid_geral_rsvp_r_" . session_id();
                  $nm_saida->seta_arquivo($this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_print . ".html");
                  $this->Ini->sc_export_ajax_img = true;
              }
              ob_start();
          }
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'])
      {
          $_SESSION['scriptcase']['saida_var'] = false;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['ajax_nav'] = false;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['scroll_navigate'] = false;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['scroll_navigate_reload'] = false;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['scroll_navigate_app'] = false;
          if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['scroll_navigate_header_row']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['scroll_navigate_header_row'] = 1;
          }
          if (isset($_POST['nmgp_opcao']) && ($_POST['nmgp_opcao'] == "ajax_navigate" || $_POST['nmgp_opcao'] == "ajax_detalhe"))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['ajax_nav'] = true;
              $_SESSION['scriptcase']['saida_var']  = true;
              $_SESSION['scriptcase']['saida_html'] = "";
              $this->Ini->Arr_result = array();
              $nmgp_opcao = $_POST['opc'];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = $nmgp_opcao;
              if (isset($_POST['parm']) && $_POST['parm'] == "save_grid")
              {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['save_grid'] = true;
              }
              if ($nmgp_opcao == "edit" && isset($_POST['parm']) && $_POST['parm'] == "fim")
              {
                  $rec = $_POST['parm'];
              }
              if ($nmgp_opcao == "rec" || $nmgp_opcao == "muda_rec_linhas")
              {
                  $rec = $_POST['parm'];
              }
              if ($nmgp_opcao == "muda_qt_linhas")
              {
                  $nmgp_quant_linhas  = strtolower($_POST['parm']);
              }
              if (($_POST['opc'] == "igual" || $_POST['opc'] == "resumo") && isset($_POST['parm']) && ($_POST['parm'] == "reload" || $_POST['parm'] == "breload"))
              {
                  $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['refresh_interativ'] = "S";
                  $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['contr_total_geral'] = "NAO";
                  $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['contr_array_resumo'] = "NAO";
                  unset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['tot_geral']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['arr_total']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['using_summary_cache']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['pivot_group_by']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['pivot_x_axys']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['pivot_y_axys']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['pivot_fill']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['pivot_order']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['pivot_order_col']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['pivot_order_level']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['pivot_order_sort']);
                  unset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['pivot_tabular']);
              }
              if ($nmgp_opcao == "fast_search")
              {
                  $_POST['parm'] = str_replace("__NM_PLUS__", "+", $_POST['parm']);
                  $_POST['parm'] = str_replace("__NM_AMP__", "&", $_POST['parm']);
                  $_POST['parm'] = str_replace("__NM_PRC__", "%", $_POST['parm']);
                  $temp = explode("_SCQS_", $_POST['parm']);
                  $nmgp_fast_search      = (isset($temp[0])) ? $temp[0] : "";
                  $nmgp_cond_fast_search = (isset($temp[1])) ? $temp[1] : "";
                  $nmgp_arg_fast_search  = (isset($temp[2])) ? $temp[2] : "";
              }
              if ($nmgp_opcao == "ordem")
              {
                  $nmgp_ordem = $_POST['parm'];
              }
          }
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_Gb_date_format'])) 
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_Gb_date_format'] = array();
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_All_Groupby'] = array('sc_free_total' => 'grid');
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_Groupby_hide'])) 
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_Groupby_hide'] = array();
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_Ind_Groupby'])) 
      { 
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_All_Groupby'] as $Ind => $Tp)
          {
              if (!in_array($Ind, $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_Groupby_hide'])) 
              { 
                  break;
              }
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_Ind_Groupby'] = $Ind;
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Labels_GB'] = array();
      if  ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_Ind_Groupby'] == "sc_free_total")
      {
      }
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['dados_orig_gb']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['dados_orig_gb'] = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['dados_orig_gb']['all']['SC_Ind_Groupby'] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['dados_orig_gb']['all']['SC_Gb_Free_cmp'] = array();
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_Ind_Groupby']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['dados_orig_gb']['all']['SC_Ind_Groupby'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_Ind_Groupby'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_Gb_Free_cmp']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['dados_orig_gb']['all']['SC_Gb_Free_cmp'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_Gb_Free_cmp'];
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['dados_orig_gb']['res']['summarizing_fields_display'] = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['dados_orig_gb']['res']['summarizing_fields_order']   = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['dados_orig_gb']['res']['summarizing_fields_control'] = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['dados_orig_gb']['res']['pivot_x_axys']               = array();
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['summarizing_fields_display']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['dados_orig_gb']['res']['summarizing_fields_display'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['summarizing_fields_display'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['summarizing_fields_order']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['dados_orig_gb']['res']['summarizing_fields_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['summarizing_fields_order'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['summarizing_fields_control']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['dados_orig_gb']['res']['summarizing_fields_control'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['summarizing_fields_control'];
          }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['pivot_x_axys']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['dados_orig_gb']['res']['pivot_x_axys'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['pivot_x_axys'];
          }
      }
      $this->Ini->Apl_resumo  = "grid_geral_rsvp_r_resumo_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_Ind_Groupby'] . ".class.php"; 
      $this->Ini->Apl_grafico = "grid_geral_rsvp_r_grafico_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_Ind_Groupby'] . ".class.php"; 
      $_SESSION['sc_session']['path_third'] = $this->Ini->path_prod . "/third";
      $_SESSION['sc_session']['real_path_third'] = $this->Ini->path_third;
      $_SESSION['sc_session']['path_prod']  = $this->Ini->path_prod . "/third";
      $_SESSION['sc_session']['path_img']   = $this->Ini->path_img_global;
      $_SESSION['sc_session']['path_libs']  = $this->Ini->path_libs;
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
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['xls_return']  = ($nmgp_opcao == "xls")  ? "volta_grid" : "resumo"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['csv_return']  = ($nmgp_opcao == "csv")  ? "volta_grid" : "resumo"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['xml_return']  = ($nmgp_opcao == "xml")  ? "volta_grid" : "resumo"; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['json_return'] = ($nmgp_opcao == "json") ? "volta_grid" : "resumo"; 
      $this->Ini->SC_module_export = (isset($SC_module_export) && !empty($SC_module_export)) ? $SC_module_export : "grid"; 
      if (empty($this->Ini->SC_module_export) && $nmgp_opcao == 'pdf')
      { 
          $this->Ini->SC_module_export = "grid";
      }
      elseif (empty($this->Ini->SC_module_export) && $nmgp_opcao == 'print')
      { 
          $this->Ini->SC_module_export = "grid";
      }
      elseif (empty($this->Ini->SC_module_export) && $nmgp_opcao == 'pdf_res')
      { 
          $this->Ini->SC_module_export = "grid";
      }
      elseif (empty($this->Ini->SC_module_export) && $nmgp_opcao == 'res_print')
      { 
          $this->Ini->SC_module_export = "grid";
      }
      if (empty($this->Ini->SC_module_export) && $nmgp_opcao == 'xls')
      { 
          $this->Ini->SC_module_export = "grid";
      }
      elseif (empty($this->Ini->SC_module_export) && $nmgp_opcao == 'xls_res')
      { 
          $this->Ini->SC_module_export = "grid";
      }
      if ($nmgp_opcao == 'print' || $nmgp_opcao == 'res_print') {
          $this->Ini->Proc_print = true;
          if (!empty($nmgp_password)) {
              $this->Ini->Export_html_zip = true;
          }
          $_SESSION['scriptcase']['proc_mobile'] = false;
          if ($nmgp_opcao == 'print') {
              $this->ret_print = "volta_grid";
          }
          else {
              $this->ret_print = "resumo";
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['print_return'] = $this->ret_print;
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'])
      {
          if ($this->Ini->Export_html_zip)
          {
              $this->Ini->Export_img_zip = true;
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['html_name']))
              {
                  $nm_arquivo_html = "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['html_name'];
              }
              elseif ($nmgp_opcao == 'print' && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)
              {
                  $nm_arquivo_html = "/sc_grid_geral_rsvp_r_" . session_id() . ".html";
              }
              else
              {
                  $nm_arquivo_html = "/sc_grid_geral_rsvp_r_res_" . session_id() . ".html";
              }
              $nm_saida->seta_arquivo($this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_html);
          }
      }
      if ($nmgp_opcao == "doc_word") {  
          $this->ret_word = "volta_grid";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['word_return'] = $this->ret_word;
          $_SESSION['scriptcase']['proc_mobile'] = false;
      }
      if ($nmgp_opcao == "doc_word_res") {  
          $this->ret_word = "resumo";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['word_return'] = $this->ret_word;
          $_SESSION['scriptcase']['proc_mobile'] = false;
      }
      if ($nmgp_opcao == "doc_word_res" && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)  
      { 
          $nmgp_opcao = "doc_word"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = "doc_word"; 
      }
      elseif ($nmgp_opcao == "doc_word" && strpos(" " . $this->Ini->SC_module_export, "grid") === false)  
      { 
          $nmgp_opcao = "doc_word_res"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = "doc_word_res"; 
      }
      if ($nmgp_opcao == "xls_res" && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)  
      { 
          $nmgp_opcao = "xls"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = "xls"; 
      }
      elseif ($nmgp_opcao == "xls" && strpos(" " . $this->Ini->SC_module_export, "grid") === false)  
      { 
          $nmgp_opcao = "xls_res"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = "xls_res"; 
      }
      if ($nmgp_opcao == "csv_res" && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)  
      { 
          $nmgp_opcao = "csv"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = "csv"; 
      }
      elseif ($nmgp_opcao == "csv" && strpos(" " . $this->Ini->SC_module_export, "grid") === false)  
      { 
          $nmgp_opcao = "csv_res"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = "csv_res"; 
      }
      if ($nmgp_opcao == "xml_res" && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)  
      { 
          $nmgp_opcao = "xml"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = "xml"; 
      }
      elseif ($nmgp_opcao == "xml" && strpos(" " . $this->Ini->SC_module_export, "grid") === false)  
      { 
          $nmgp_opcao = "xml_res"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = "xml_res"; 
      }
      if ($nmgp_opcao == "json_res" && strpos(" " . $this->Ini->SC_module_export, "grid") !== false)  
      { 
          $nmgp_opcao = "json"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = "json"; 
      }
      elseif ($nmgp_opcao == "json" && strpos(" " . $this->Ini->SC_module_export, "grid") === false)  
      { 
          $nmgp_opcao = "json_res"; 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = "json_res"; 
      }
      $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['skip_charts'] = (strpos(" " . $this->Ini->SC_module_export, "chart") !== false) ? false : true;
      $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['skip_summary'] = false;
      if ('chart' == $this->Ini->SC_module_export) {
          $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['skip_summary'] = true;
          $this->Ini->SC_module_export = 'resume,chart';
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['pdf_det'] = false;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['conf_chart_level'] = "S";
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida']      = false;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida_grid']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida_grid'] = false;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida_init']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida_init'] = false;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida_label']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida_label'] = false;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['cab_embutida']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['cab_embutida'] = "";
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida_pdf']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida_pdf'] = "";
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida_treeview']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida_treeview'] = false;
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida_opcao']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida_opcao'] = "";
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['proc_pdf'] = (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'] && ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "pdf" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "pdf_res")) ? true : false;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['proc_pdf']) {
          $_SESSION['scriptcase']['proc_mobile'] = false;
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['proc_pdf_vert'] = false;
      include("../_lib/css/" . $this->Ini->str_schema_all . "_grid.php");
      $this->Ini->Tree_img_col    = trim($str_tree_col);
      $this->Ini->Tree_img_exp    = trim($str_tree_exp);
      $this->Ini->scGridRefinedSearchExpandFAIcon    = trim($scGridRefinedSearchExpandFAIcon);
      $this->Ini->scGridRefinedSearchCollapseFAIcon    = trim($scGridRefinedSearchCollapseFAIcon);
      $this->Ini->str_chart_theme = (isset($str_chart_theme)?$str_chart_theme:'');
      $this->Ini->Str_btn_grid    = trim($str_button) . "/" . trim($str_button) . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".php";
      $this->Ini->Str_btn_css     = trim($str_button) . "/" . trim($str_button) . ".css";
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      $this->arr_buttons['group_group_2']= array(
          'value'            => "" . $this->Ini->Nm_lang['lang_btns_expt_email_title'] . "",
          'hint'             => "" . $this->Ini->Nm_lang['lang_btns_expt_email'] . "",
          'type'             => "button",
          'display'          => "text_fontawesomeicon",
          'display_position' => "text_right",
          'image'            => "scriptcase__NM__envelope.png",
          'fontawesomeicon'  => "fas fa-envelope",
          'has_fa'           => true,
          'content_icons'    => false,
          'style'            => "default",
      );

      $this->arr_buttons['group_group_1']= array(
          'value'            => "" . $this->Ini->Nm_lang['lang_btns_expt'] . "",
          'hint'             => "" . $this->Ini->Nm_lang['lang_btns_expt'] . "",
          'type'             => "button",
          'display'          => "text_fontawesomeicon",
          'display_position' => "text_right",
          'image'            => "scriptcase__NM__export.png",
          'fontawesomeicon'  => "fas fa-download",
          'has_fa'           => true,
          'content_icons'    => false,
          'style'            => "default",
      );

      $this->arr_buttons['group_group_4']= array(
          'value'            => "" . $this->Ini->Nm_lang['lang_btns_expt_email_title'] . "",
          'hint'             => "" . $this->Ini->Nm_lang['lang_btns_expt_email'] . "",
          'type'             => "button",
          'display'          => "text_fontawesomeicon",
          'display_position' => "text_right",
          'image'            => "scriptcase__NM__envelope.png",
          'fontawesomeicon'  => "fas fa-envelope",
          'has_fa'           => true,
          'content_icons'    => false,
          'style'            => "default",
      );

      $this->arr_buttons['group_group_3']= array(
          'value'            => "" . $this->Ini->Nm_lang['lang_btns_expt'] . "",
          'hint'             => "" . $this->Ini->Nm_lang['lang_btns_expt'] . "",
          'type'             => "button",
          'display'          => "text_fontawesomeicon",
          'display_position' => "text_right",
          'image'            => "scriptcase__NM__export.png",
          'fontawesomeicon'  => "fas fa-download",
          'has_fa'           => true,
          'content_icons'    => false,
          'style'            => "default",
      );

      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'])
      { 
      $this->Ini->Img_sep_grid             = "/" . trim($str_toolbar_separator);
      $this->Ini->grid_table_width         = (!isset($str_grid_table_width) || "" == trim($str_grid_table_width)) ? "" : $str_grid_table_width;
      $this->Ini->Label_sort_pos           = trim($str_label_sort_pos);
      $this->Ini->Label_sort               = trim($str_label_sort);
      $this->Ini->Label_sort_asc           = trim($str_label_sort_asc);
      $this->Ini->Label_sort_desc          = trim($str_label_sort_desc);
      $this->Ini->Label_summary_sort_pos   = trim($str_resume_label_sort_pos);
      $this->Ini->Label_summary_sort       = trim($str_resume_label_sort);
      $this->Ini->Label_summary_sort_asc   = trim($str_resume_label_sort_asc);
      $this->Ini->Label_summary_sort_desc  = trim($str_resume_label_sort_desc);
      $this->Ini->Sum_ico_line             = trim($sum_ico_line);
      $this->Ini->Sum_ico_column           = trim($sum_ico_column);
      $this->Ini->ajax_div_icon            = trim($ajax_div_icon);
      $this->Ini->Str_toolbarnav_separator = '/' . trim($str_toolbarnav_separator);
      $this->Ini->Img_qs_search            = '' != trim($img_qs_search)        ? trim($img_qs_search)        : 'scriptcase__NM__qs_lupa.png';
      $this->Ini->Img_qs_clean             = '' != trim($img_qs_clean)         ? trim($img_qs_clean)         : 'scriptcase__NM__qs_close.png';
      $this->Ini->Str_qs_image_padding     = '' != trim($str_qs_image_padding) ? trim($str_qs_image_padding) : '0';
      $this->Ini->App_div_tree_img_col     = trim($app_div_str_tree_col);
      $this->Ini->App_div_tree_img_exp     = trim($app_div_str_tree_exp);
      $this->Ini->Bubble_tail              = trim($str_bubble_tail);
      $this->Ini->refinedsearch_hide       = trim($refinedsearch_hide);
      $this->Ini->refinedsearch_show       = trim($refinedsearch_show);
      $this->Ini->refinedsearch_close      = trim($refinedsearch_close);
      $this->Ini->refinedsearch_values_separator          = trim($refinedsearch_values_separator);
      $this->Ini->refinedsearch_campo_close_icon          = trim($refinedsearch_campo_close_icon);
      $this->Ini->grid_moldura_padding = $this->getPaddingFromCss($grid_moldura_padding);
      $this->Ini->grid_table_margin = $this->getPaddingFromCss($grid_table_margin);
      $this->Ini->grid_link_margin_top = '';
      if ('' != $this->Ini->grid_table_margin['top']) {
          $this->Ini->grid_link_margin_top = $this->Ini->grid_table_margin['top'];
      } elseif ('' != $this->Ini->grid_moldura_padding['top']) {
          $this->Ini->grid_link_margin_top = $this->Ini->grid_moldura_padding['top'];
      }
          $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_config_btn.php", "F", "nmButtonOutput") ; 
          $_SESSION['scriptcase']['css_popup']                 = $this->Ini->str_schema_all . "_grid.css";
          $_SESSION['scriptcase']['css_popup_dir']             = $this->Ini->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
          $_SESSION['scriptcase']['css_btn_popup']             = $this->Ini->Str_btn_css;
          $_SESSION['scriptcase']['str_google_fonts']          = $this->Ini->str_google_fonts;
          $_SESSION['scriptcase']['css_popup_tab']             = $this->Ini->str_schema_all . "_tab.css";
          $_SESSION['scriptcase']['css_popup_tab_dir']         = $this->Ini->str_schema_all . "_tab" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
          $_SESSION['scriptcase']['css_popup_div']             = $this->Ini->str_schema_all . "_appdiv.css";
          $_SESSION['scriptcase']['css_popup_div_dir']         = $this->Ini->str_schema_all . "_appdiv" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
          $_SESSION['scriptcase']['bg_btn_popup']['bok']       = nmButtonOutput($this->arr_buttons, "bok_appdiv", "processa();", "processa();", "bok", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
          $_SESSION['scriptcase']['bg_btn_popup']['bsair']     = nmButtonOutput($this->arr_buttons, "bsair_appdiv", "window.close()", "window.close()", "bsair", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
          $_SESSION['scriptcase']['bg_btn_popup']['btbremove'] = nmButtonOutput($this->arr_buttons, "bsair_appdiv", "self.parent.tb_remove()", "self.parent.tb_remove()", "bsair", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
      } 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order']))
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "evento_id";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "evento_dsc";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "nome_participante";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "tipo_pessoa";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "data_nascimento";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "rg";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "nome_cracha";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "convidado_original";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "nome_substituto";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "acomp_mesmoquarto";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "partici_mesmoquarto";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "hotel_dsc";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "checkin";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "checkout";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "early_checkin";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "late_checkout";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "tamanho_camisa";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "tamanho_calcado";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "empresa";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "cargo";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "departamento";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "grupo";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "publico_dsc";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "regional_dsc";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "data_cadastro";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "logradouro";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "complemento";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "cidade";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "bairro";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "cep";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "uf";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "pais_dsc";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "ddd_tel01";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "tel01";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "ddd_celular";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "celular";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "telefone_internacional";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "passaporte";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "validade_passporte";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "cpf";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "filiacao";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "fumante";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "restricao_alimentar";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "e_mail";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "atualizacao_presenca";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "presenca";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "dt_confirm_presenca";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "presenca_motivo";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "presenca_atendente";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "presenca_obs";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "contato_antendente";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "data_contato";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "motivo_contato";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "obs_contato";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "status_contato";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "hora_saida_ida";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "trecho";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "hotel_ida_dsc";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "comprada_bvt_ida";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "data_saida_ida";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "origem_dsc_ida";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "destino_dsc_ida";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "voo_ida";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "cia_dsc_ida";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "localizador_ida";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "etkt_ida";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "data_chegada_ida";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "hora_chegada_ida";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "status_aereo_ida";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "trecho_volta";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "hotel_volta_dsc";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "hr_transfer_volta";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "comprada_bvt_volta";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "data_saida_volta";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "hora_saida_volta";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "data_chegada_volta";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "hora_chegada_volta";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "origem_dsc_volta";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "destino_dsc_volta";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "cia_dsc_volta";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "voo_volta";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "localizador_volta";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "etkt_volta";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "status_aereo_volta";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "tipo_transfer";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "dt_chegada_proprio";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "hr_chegada_proprio";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "valor_diaria";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "valor_taxa";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "obs_transfer";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "anotacoes";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "id_geral";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'][] = "cpf_mestre";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order_orig'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'];
          if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['usr_cmp_sel']))
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['usr_cmp_sel'] = array();
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['usr_cmp_sel']['id_geral'] = "off";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['usr_cmp_sel']['cpf_mestre'] = "off";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['usr_cmp_sel_orig'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['usr_cmp_sel'];
      } 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_geral_rsvp_r']['exit']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_geral_rsvp_r']['exit'] != '')
      {
          $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page]       = $_SESSION['scriptcase']['sc_apl_conf']['grid_geral_rsvp_r']['exit'];
          $_SESSION['scriptcase']['sc_force_url_saida'][$this->Ini->sc_page] = true;
      }

      $this->Ini->sc_Include($this->Ini->path_libs . "/nm_gc.php", "F", "nm_gc") ; 
      nm_gc($this->Ini->path_libs);
      if (!$_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida'])
      { 
          $_SESSION['scriptcase']['sc_page_process'] = $this->Ini->sc_page;
      } 
      $_SESSION['scriptcase']['sc_idioma_pivot']['pt_br'] = array(
          'smry_ppup_titl'      => $this->Ini->Nm_lang['lang_othr_smry_ppup_titl'],
          'smry_ppup_fild'      => $this->Ini->Nm_lang['lang_othr_smry_ppup_fild'],
          'smry_ppup_posi'      => $this->Ini->Nm_lang['lang_othr_smry_ppup_posi'],
          'smry_ppup_sort'      => $this->Ini->Nm_lang['lang_othr_smry_ppup_sort'],
          'smry_ppup_posi_labl' => $this->Ini->Nm_lang['lang_othr_smry_ppup_posi_labl'],
          'smry_ppup_posi_data' => $this->Ini->Nm_lang['lang_othr_smry_ppup_posi_data'],
          'smry_ppup_sort_labl' => $this->Ini->Nm_lang['lang_othr_smry_ppup_sort_labl'],
          'smry_ppup_sort_vlue' => $this->Ini->Nm_lang['lang_othr_smry_ppup_sort_vlue'],
          'smry_ppup_chek_tabu' => $this->Ini->Nm_lang['lang_othr_smry_ppup_chek_tabu'],
      );
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
      if (!$_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida'])
      { 
          $this->pdf_zip = (isset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['opc_pdf']['pdf_zip'])) ? $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['opc_pdf']['pdf_zip'] : "N";
          $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['use_pass_pdf'] = "";
          $_SESSION['scriptcase']['sc_tp_pdf'] = "wkhtmltopdf";
          $_SESSION['scriptcase']['sc_idioma_pdf'] = array();
          $_SESSION['scriptcase']['sc_idioma_pdf']['pt_br'] = array('titulo' => $this->Ini->Nm_lang['lang_pdff_titl'], 'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'], 'modules' => $this->Ini->Nm_lang['lang_export_modules'], 'mod_grid' => $this->Ini->Nm_lang['lang_export_mod_grid'], 'mod_resume' => $this->Ini->Nm_lang['lang_export_mod_summary'], 'mod_chart' => $this->Ini->Nm_lang['lang_export_mod_chart'], 'tp_imp' => $this->Ini->Nm_lang['lang_pdff_type'], 'color' => $this->Ini->Nm_lang['lang_pdff_colr'], 'econm' => $this->Ini->Nm_lang['lang_pdff_bndw'], 'tp_pap' => $this->Ini->Nm_lang['lang_pdff_pper'], 'carta' => $this->Ini->Nm_lang['lang_pdff_letr'], 'oficio' => $this->Ini->Nm_lang['lang_pdff_legl'], 'customiz' => $this->Ini->Nm_lang['lang_pdff_cstm'], 'alt_papel' => $this->Ini->Nm_lang['lang_pdff_pper_hgth'], 'larg_papel' => $this->Ini->Nm_lang['lang_pdff_pper_wdth'], 'orient' => $this->Ini->Nm_lang['lang_pdff_pper_orie'], 'retrato' => $this->Ini->Nm_lang['lang_pdff_prtr'], 'paisag' => $this->Ini->Nm_lang['lang_pdff_lnds'], 'book' => $this->Ini->Nm_lang['lang_pdff_bkmk'], 'grafico' => $this->Ini->Nm_lang['lang_pdff_chrt'], 'largura' => $this->Ini->Nm_lang['lang_pdff_wdth'], 'fonte' => $this->Ini->Nm_lang['lang_pdff_font'], 'create' => $this->Ini->Nm_lang['lang_pdff_create'], 'sim' => $this->Ini->Nm_lang['lang_pdff_chrt_yess'], 'nao' => $this->Ini->Nm_lang['lang_pdff_chrt_nooo'], 'chart_level' => $this->Ini->Nm_lang['lang_chart_level_groupby'], 'chart_level' => $this->Ini->Nm_lang['lang_chart_level_groupby'], 'group_general' => $this->Ini->Nm_lang['lang_pdff_group_general'], 'group_chart' => $this->Ini->Nm_lang['lang_pdff_group_chart'], 'pdf_res' => $this->Ini->Nm_lang['lang_app_xls_summry'], 'pdf_cons' => $this->Ini->Nm_lang['lang_app_xls_grid'], 'password' => $this->Ini->Nm_lang['lang_app_xls_pswd'], 'page_break' => $this->Ini->Nm_lang['lang_groupby_break_page_pdf'], 'other_options' => $this->Ini->Nm_lang['lang_app_other_options'], 'label_group' => $this->Ini->Nm_lang['lang_pdf_below_groupby'], 'page_label' => $this->Ini->Nm_lang['lang_pdf_all_pages_title'], 'page_header' => $this->Ini->Nm_lang['lang_pdf_all_pages_header'], 'format_zip' => $this->Ini->Nm_lang['lang_export_pdf_zip'], 'cancela' => $this->Ini->Nm_lang['lang_pdff_cncl']);
      } 
      $_SESSION['scriptcase']['sc_idioma_graf_flash'] = array();
      $_SESSION['scriptcase']['sc_idioma_graf_flash']['pt_br'] = array(
          'titulo' => $this->Ini->Nm_lang['lang_chrt_titl'],
          'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'],
          'tipo_g' => $this->Ini->Nm_lang['lang_chrt_type'],
          'tp_barra' => $this->Ini->Nm_lang['lang_flsh_chrt_bars'],
          'tp_pizza' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie'],
          'tp_linha' => $this->Ini->Nm_lang['lang_flsh_chrt_line'],
          'tp_area' => $this->Ini->Nm_lang['lang_flsh_chrt_area'],
          'tp_marcador' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks'],
          'tp_gauge' => $this->Ini->Nm_lang['lang_flsh_chrt_gaug'],
          'tp_radar' => $this->Ini->Nm_lang['lang_flsh_chrt_radr'],
          'tp_polar' => $this->Ini->Nm_lang['lang_flsh_chrt_polr'],
          'tp_funil' => $this->Ini->Nm_lang['lang_flsh_chrt_funl'],
          'tp_pyramid' => $this->Ini->Nm_lang['lang_flsh_chrt_pyrm'],
          'largura' => $this->Ini->Nm_lang['lang_chrt_wdth'],
          'altura' => $this->Ini->Nm_lang['lang_chrt_hgth'],
          'modo_gera' => $this->Ini->Nm_lang['lang_chrt_gtmd'],
          'sintetico' => $this->Ini->Nm_lang['lang_chrt_smzd'],
          'analitico' => $this->Ini->Nm_lang['lang_chrt_anlt'],
          'order' => $this->Ini->Nm_lang['lang_chrt_ordr'],
          'order_none' => $this->Ini->Nm_lang['lang_chrt_ordr_none'],
          'order_asc' => $this->Ini->Nm_lang['lang_chrt_ordr_asc'],
          'order_desc' => $this->Ini->Nm_lang['lang_chrt_ordr_desc'],
          'limit_chart_items' => $this->Ini->Nm_lang['lang_limit_chart_items'],
          'barra_orien' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_layo'],
          'barra_orien_horiz' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_horz'],
          'barra_orien_verti' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_vrtc'],
          'barra_forma' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_shpe'],
          'barra_forma_barra' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_bars'],
          'barra_forma_cilin' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_cyld'],
          'barra_forma_cone' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_cone'],
          'barra_forma_piram' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_pyrm'],
          'barra_dimen' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_dmns'],
          'barra_dimen_2d' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_2ddm'],
          'barra_dimen_3d' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_3ddm'],
          'barra_sobre' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_3ovr'],
          'barra_sobre_nao' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_3ont'],
          'barra_sobre_sim' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_3oys'],
          'barra_empil' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_stck'],
          'barra_empil_desat' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_stan'],
          'barra_empil_ativa' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_stay'],
          'barra_empil_perce' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_stap'],
          'barra_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_invr'],
          'barra_inver_norma' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_invn'],
          'barra_inver_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_invi'],
          'barra_agrup' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_srgr'],
          'barra_agrup_conju' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_srst'],
          'barra_agrup_serie' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_srbs'],
          'barra_funil' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_funl'],
          'barra_funil_nao' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_3ont'],
          'barra_funil_sim' => $this->Ini->Nm_lang['lang_flsh_chrt_bars_3oys'],
          'pizza_forma' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_shpe'],
          'pizza_forma_pizza' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_fpie'],
          'pizza_forma_donut' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_dnts'],
          'pizza_dimen' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_dmns'],
          'pizza_dimen_2d' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_2ddm'],
          'pizza_dimen_3d' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_3ddm'],
          'pizza_orden' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_srtn'],
          'pizza_orden_desat' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_nsrt'],
          'pizza_orden_ascen' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_asrt'],
          'pizza_orden_desce' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_dsrt'],
          'pizza_explo' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_expl'],
          'pizza_explo_desat' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_dxpl'],
          'pizza_explo_ativa' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_axpl'],
          'pizza_explo_click' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_cxpl'],
          'pizza_valor' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_fval'],
          'pizza_valor_valor' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_fvlv'],
          'pizza_valor_perce' => $this->Ini->Nm_lang['lang_flsh_chrt_fpie_fvlp'],
          'linha_forma' => $this->Ini->Nm_lang['lang_flsh_chrt_line_shpe'],
          'linha_forma_linha' => $this->Ini->Nm_lang['lang_flsh_chrt_line_line'],
          'linha_forma_splin' => $this->Ini->Nm_lang['lang_flsh_chrt_line_spln'],
          'linha_forma_degra' => $this->Ini->Nm_lang['lang_flsh_chrt_line_step'],
          'linha_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_line_invr'],
          'linha_inver_norma' => $this->Ini->Nm_lang['lang_flsh_chrt_line_invn'],
          'linha_inver_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_line_invi'],
          'linha_agrup' => $this->Ini->Nm_lang['lang_flsh_chrt_line_srgr'],
          'linha_agrup_conju' => $this->Ini->Nm_lang['lang_flsh_chrt_line_srst'],
          'linha_agrup_serie' => $this->Ini->Nm_lang['lang_flsh_chrt_line_srbs'],
          'area_forma' => $this->Ini->Nm_lang['lang_flsh_chrt_area_shpe'],
          'area_forma_area' => $this->Ini->Nm_lang['lang_flsh_chrt_area_area'],
          'area_forma_splin' => $this->Ini->Nm_lang['lang_flsh_chrt_area_spln'],
          'area_empil' => $this->Ini->Nm_lang['lang_flsh_chrt_area_stak'],
          'area_empil_desat' => $this->Ini->Nm_lang['lang_flsh_chrt_area_stan'],
          'area_empil_ativa' => $this->Ini->Nm_lang['lang_flsh_chrt_area_stay'],
          'area_empil_perce' => $this->Ini->Nm_lang['lang_flsh_chrt_area_stap'],
          'area_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_area_invr'],
          'area_inver_norma' => $this->Ini->Nm_lang['lang_flsh_chrt_area_invn'],
          'area_inver_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_area_invi'],
          'area_agrup' => $this->Ini->Nm_lang['lang_flsh_chrt_area_srgr'],
          'area_agrup_conju' => $this->Ini->Nm_lang['lang_flsh_chrt_area_srst'],
          'area_agrup_serie' => $this->Ini->Nm_lang['lang_flsh_chrt_area_srbs'],
          'marca_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks_invr'],
          'marca_inver_norma' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks_invn'],
          'marca_inver_inver' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks_invi'],
          'marca_agrup' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks_srgr'],
          'marca_agrup_conju' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks_srst'],
          'marca_agrup_serie' => $this->Ini->Nm_lang['lang_flsh_chrt_mrks_srbs'],
          'gauge_forma' => $this->Ini->Nm_lang['lang_flsh_chrt_gaug_shpe'],
          'gauge_forma_circular' => $this->Ini->Nm_lang['lang_flsh_chrt_gaug_circ'],
          'gauge_forma_semi' => $this->Ini->Nm_lang['lang_flsh_chrt_gaug_semi'],
          'pyram_slice' => $this->Ini->Nm_lang['lang_flsh_chrt_pyrm_slic'],
          'pyram_slice_s' => $this->Ini->Nm_lang['lang_flsh_chrt_pyrm_opcs'],
          'pyram_slice_n' => $this->Ini->Nm_lang['lang_flsh_chrt_pyrm_opcn'],
          'chart_enable_scroll' => $this->Ini->Nm_lang['lang_chart_enable_scroll'],
      );
      if (!$_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida'])
      { 
          $_SESSION['scriptcase']['sc_idioma_prt'] = array();
          $_SESSION['scriptcase']['sc_idioma_prt']['pt_br'] = array('titulo' => $this->Ini->Nm_lang['lang_btns_prtn_titl_hint'], 'modules' => $this->Ini->Nm_lang['lang_export_modules'], 'mod_grid' => $this->Ini->Nm_lang['lang_export_mod_grid'], 'mod_resume' => $this->Ini->Nm_lang['lang_export_mod_summary'], 'mod_chart' => $this->Ini->Nm_lang['lang_export_mod_chart'], 'group_general' => $this->Ini->Nm_lang['lang_pdff_group_general'], 'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'], 'modoimp' => $this->Ini->Nm_lang['lang_btns_mode_prnt_hint'], 'curr' => $this->Ini->Nm_lang['lang_othr_curr_page'], 'total' => $this->Ini->Nm_lang['lang_othr_full'], 'cor' => $this->Ini->Nm_lang['lang_othr_prtc'], 'pb' => $this->Ini->Nm_lang['lang_othr_bndw'], 'color' => $this->Ini->Nm_lang['lang_othr_colr'], 'pdf_res' => $this->Ini->Nm_lang['lang_app_xls_summry'], 'pdf_cons' => $this->Ini->Nm_lang['lang_app_xls_grid'], 'cancela' => $this->Ini->Nm_lang['lang_btns_cncl_prnt_hint'], 'password' => $this->Ini->Nm_lang['lang_app_xls_pswd']);
      } 
      if (!$_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida'])
      { 
          $_SESSION['scriptcase']['sc_idioma_word'] = array();
          $_SESSION['scriptcase']['sc_idioma_word']['pt_br'] = array('titulo' => $this->Ini->Nm_lang['lang_export_title'], 'modules' => $this->Ini->Nm_lang['lang_export_modules'], 'mod_grid' => $this->Ini->Nm_lang['lang_export_mod_grid'], 'mod_resume' => $this->Ini->Nm_lang['lang_export_mod_summary'], 'mod_chart' => $this->Ini->Nm_lang['lang_export_mod_chart'], 'group_general' => $this->Ini->Nm_lang['lang_pdff_group_general'], 'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'], 'cor' => $this->Ini->Nm_lang['lang_othr_prtc'], 'pb' => $this->Ini->Nm_lang['lang_othr_bndw'], 'color' => $this->Ini->Nm_lang['lang_othr_colr'], 'cancela' => $this->Ini->Nm_lang['lang_btns_cncl_prnt_hint'], 'password' => $this->Ini->Nm_lang['lang_app_xls_pswd']);
      } 
      if (!$_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida'])
      { 
          $_SESSION['scriptcase']['sc_idioma_csv'] = array();
          $_SESSION['scriptcase']['sc_idioma_csv']['pt_br'] = array('titulo' => $this->Ini->Nm_lang['lang_app_csv_title'], 'group_general' => $this->Ini->Nm_lang['lang_pdff_group_general'], 'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'], 'modules' => $this->Ini->Nm_lang['lang_export_modules'], 'mod_grid' => $this->Ini->Nm_lang['lang_export_mod_grid'], 'mod_resume' => $this->Ini->Nm_lang['lang_export_mod_summary'], 'mod_chart' => $this->Ini->Nm_lang['lang_export_mod_chart'], 'delim_line' => $this->Ini->Nm_lang['lang_app_csv_lin_separator'], 'delim_col' => $this->Ini->Nm_lang['lang_app_csv_col_separator'], 'delim_dados' => $this->Ini->Nm_lang['lang_app_csv_txt_separator'], 'label_csv' => $this->Ini->Nm_lang['lang_app_csv_grid_label'], 'password' => $this->Ini->Nm_lang['lang_app_xls_pswd']);
      } 
      if (!$_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida'])
      { 
          $_SESSION['scriptcase']['sc_idioma_xml'] = array();
          $_SESSION['scriptcase']['sc_idioma_xml']['pt_br'] = array('titulo' => $this->Ini->Nm_lang['lang_export_title'], 'group_general' => $this->Ini->Nm_lang['lang_pdff_group_general'], 'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'], 'modules' => $this->Ini->Nm_lang['lang_export_modules'], 'mod_grid' => $this->Ini->Nm_lang['lang_export_mod_grid'], 'mod_resume' => $this->Ini->Nm_lang['lang_export_mod_summary'], 'mod_chart' => $this->Ini->Nm_lang['lang_export_mod_chart'], 'xml_label' => $this->Ini->Nm_lang['lang_inherit_label'], 'xml_yes' => $this->Ini->Nm_lang['lang_pdff_chrt_yess'], 'xml_no' => $this->Ini->Nm_lang['lang_pdff_chrt_nooo'], 'xml_format' => $this->Ini->Nm_lang['lang_xml_tag_attr'], 'xml_attr' => $this->Ini->Nm_lang['lang_xml_formt_attr'], 'xml_tag' => $this->Ini->Nm_lang['lang_xml_formt_tag'], 'password' => $this->Ini->Nm_lang['lang_app_xls_pswd']);
      } 
      if (!$_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida'])
      { 
          $_SESSION['scriptcase']['sc_idioma_json'] = array();
          $_SESSION['scriptcase']['sc_idioma_json']['pt_br'] = array('titulo' => $this->Ini->Nm_lang['lang_export_title'], 'group_general' => $this->Ini->Nm_lang['lang_pdff_group_general'], 'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'], 'modules' => $this->Ini->Nm_lang['lang_export_modules'], 'mod_grid' => $this->Ini->Nm_lang['lang_export_mod_grid'], 'mod_resume' => $this->Ini->Nm_lang['lang_export_mod_summary'], 'mod_chart' => $this->Ini->Nm_lang['lang_export_mod_chart'], 'json_label' => $this->Ini->Nm_lang['lang_inherit_label'], 'json_yes' => $this->Ini->Nm_lang['lang_pdff_chrt_yess'], 'json_no' => $this->Ini->Nm_lang['lang_pdff_chrt_nooo'], 'json_format' => $this->Ini->Nm_lang['lang_format_value'], 'password' => $this->Ini->Nm_lang['lang_app_xls_pswd']);
      } 
      if (!$_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida'])
      { 
          $_SESSION['scriptcase']['sc_idioma_xls'] = array();
          $_SESSION['scriptcase']['sc_idioma_xls']['pt_br'] = array('titulo' => $this->Ini->Nm_lang['lang_app_xls_title'], 'modules' => $this->Ini->Nm_lang['lang_export_modules'], 'mod_grid' => $this->Ini->Nm_lang['lang_export_mod_grid'], 'mod_resume' => $this->Ini->Nm_lang['lang_export_mod_summary'], 'mod_chart' => $this->Ini->Nm_lang['lang_export_mod_chart'], 'group_general' => $this->Ini->Nm_lang['lang_pdff_group_general'], 'titulo_colunas' => $this->Ini->Nm_lang['lang_btns_clmn_hint'], 'tp_xls' => $this->Ini->Nm_lang['lang_app_xls_ext'], 'tot_xls' => $this->Ini->Nm_lang['lang_othr_export_excel_total'], 'xls_res' => $this->Ini->Nm_lang['lang_app_xls_summry'], 'xls_cons' => $this->Ini->Nm_lang['lang_app_xls_grid'], 'password' => $this->Ini->Nm_lang['lang_app_xls_pswd']);
      } 
      $this->Ini->Gd_missing  = true;
      if (function_exists("getProdVersion"))
      {
          $_SESSION['scriptcase']['sc_prod_Version'] = str_replace(".", "", getProdVersion($this->Ini->path_libs));
      }
      if (function_exists("gd_info"))
      {
          $this->Ini->Gd_missing = false;
      }
      $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_trata_img.php", "C", "nm_trata_img") ; 
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['ExportPrtFrame'])) {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['ExportPrtFrame'] = false;
      }
      if (isset($SC_ExportPrtFrame) && $SC_ExportPrtFrame == "S") {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['ExportPrtFrame'] = true;
          if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_orig'])) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_orig'] = " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "')";
          }
      }
      if ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao']) || !isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_orig'])))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = "inicio";//=)
      }
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_geral_rsvp_r']['start']) && $_SESSION['scriptcase']['sc_apl_conf']['grid_geral_rsvp_r']['start'] == 'filter')
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "inicio" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "grid")  
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = "busca";
          }   
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] != "detalhe" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_orig']) || !empty($nmgp_parms) || !empty($GLOBALS["nmgp_parms"])))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opc_liga'] = array();  
          if (isset($NMSC_conf_apl) && !empty($NMSC_conf_apl))
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opc_liga'] = $NMSC_conf_apl;  
          }   
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opc_liga']['inicial']))
          {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opc_liga']['inicial'];
              $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['orig_pesq'] = "grid";
          }
      }
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opc_liga']['paginacao']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opc_liga']['paginacao']))
          { 
              $this->Ini->Apl_paginacao = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opc_liga']['paginacao'];
          } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "busca")
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = "grid" ;  
      }   
      if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao_print']) || empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao_print']))  
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao_print'] = "inicio" ;  
      }   
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['print_all'] = false;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "print")  
      { 
          if (strpos(" " . $this->Ini->SC_module_export, "grid") === false)
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = "res_print";
          }
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "res_print")  
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao']     = "resumo";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['print_all'] = true;
          if (strpos(" " . $this->Ini->SC_module_export, "grid") !== false)
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = "print";
              $nmgp_tipo_print = "RC";
          }
      } 
      if (substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'], 0, 7) == "grafico")  
      { 
          $_SESSION['scriptcase']['sc_ctl_ajax'] = 'part';
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "pdf")
      { 
          $this->Ini->path_img_modelo = $this->Ini->path_img_modelo;
      } 

      if (isset($_POST['nmgp_opcao']) && 'resumo' == $_POST['nmgp_opcao']
          &&
          isset($_POST['reload_summary_data']) && 'Y' == $_POST['reload_summary_data']
      ) {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['contr_array_resumo'] = 'NAO';
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['contr_total_geral'] = 'NAO';
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['tot_geral']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['using_summary_cache']);
      }

      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "fast_search")  
      { 
          $this->SC_fast_search($GLOBALS["nmgp_fast_search"], $GLOBALS["nmgp_cond_fast_search"], $GLOBALS["nmgp_arg_fast_search"]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_ant'] == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq'])
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = 'igual';
          } 
          else 
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq'];
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['contr_array_resumo'] = "NAO";
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['contr_total_geral']  = "NAO";
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['tot_geral']);
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['using_summary_cache']);
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = 'pesq';
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['orig_pesq'] = 'grid';
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['interativ_refresh'] = true;
          } 
      } 
      $this->Ini->grid_search_change_fil = false;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "grid_search" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "grid_search_res")
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['interativ_refresh'] = true;
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "grid_search")
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['orig_pesq'] = 'grid';
          } 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "grid_search_res")
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['orig_pesq'] = 'res';
          } 
          $this->SC_proc_grid_search($_POST['parm']);
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['contr_array_resumo'] = "NAO";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['contr_total_geral']  = "NAO";
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['tot_geral']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['using_summary_cache']);
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = 'pesq';
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "grid_search_change_fil" || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "grid_search_change_fil_res")
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "grid_search_change_fil")
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['orig_pesq'] = 'grid';
          } 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "grid_search_change_fil_res")
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['orig_pesq'] = 'res';
          } 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['interativ_refresh'] = true;
          if (!$_SESSION['scriptcase']['proc_mobile']) 
          { 
              require_once($this->Ini->path_aplicacao . "grid_geral_rsvp_r_pesq.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "grid_geral_rsvp_r_mobile_pesq.class.php"); 
          } 
          $this->pesq  = new grid_geral_rsvp_r_pesq();
          $this->prep_modulos("pesq");
          $this->pesq->NM_ajax_grid_fil = $_POST['parm'];
          $this->pesq->NM_ajax_flag     = true;
          $this->pesq->NM_ajax_opcao    = "ajax_grid_search_change_fil";
          $staus_fil = $this->pesq->monta_busca();
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['contr_array_resumo'] = "NAO";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['contr_total_geral']  = "NAO";
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['tot_geral']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['using_summary_cache']);
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = 'pesq';
          $this->Ini->grid_search_change_fil = true;
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "interativ_search")
      { 
          $this->SC_proc_interativ_search($_POST['parm']);
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq'];
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['contr_array_resumo'] = "NAO";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['contr_total_geral']  = "NAO";
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['tot_geral']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['using_summary_cache']);
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = 'inicio';
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opc_int_search'] = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['interativ_refresh'] = true;
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == 'pesq' && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['orig_pesq']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['orig_pesq']))  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['orig_pesq'] == "res")  
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = 'resumo';
          } 
          elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['orig_pesq'] == "grid") 
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = 'inicio';
          } 
      } 
      if ('gantt' == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] && ('inicio' == $_GET['nmgp_opcao'] || 'inicio' == $_POST['nmgp_opcao'])) {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = 'inicio';
      }
//
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['prim_cons'] = false;  
      if (substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'], 0, 7) != "grafico" && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] != "detalhe" && (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_orig']) || !empty($nmgp_parms) || !empty($GLOBALS["nmgp_parms"])))  
      { 
         unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['use_pass_pdf']);
       if (!$GLOBALS['nm_restore_grid_save']) { 
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['prim_cons'] = true;  
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_orig'] = " where (evento_id = '" . $_SESSION['vg_evento_id'] . "' AND      id_usuario_relato = '" . $_SESSION['vg_usuario_id'] . "')";
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_orig'];  
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_orig'];  
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['cond_pesq']         = ""; 
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_filtro'] = "";
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_grid']   = "";
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_lookup'] = "";
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']      = array();
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq']         = array();
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['Grid_search']       = array();
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_fast']   = "";
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_interativ'] = "";
       }
         $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['contr_total_geral'] = "NAO";
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['sc_total']);
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['tot_geral']);
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_ant'];  
      $nm_flag_pdf   = true;
      $nm_vendo_pdf  = ("pdf" == $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao']);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['graf_pdf'] = "S";
      if (isset($nmgp_graf_pdf) && !empty($nmgp_graf_pdf))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['graf_pdf'] = $nmgp_graf_pdf;
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'])
      {
         if ($nm_flag_pdf && $nm_vendo_pdf)
         {
            $nm_arquivo_htm_temp = $this->Ini->root . $this->Ini->path_imag_temp . "/sc_grid_geral_rsvp_r_html_" . session_id() . "_2.html";
            $nm_arquivo_pdf_base = "/sc_pdf_" . md5(date("Ymd") . "_" . session_id()) . "_grid_geral_rsvp_r.pdf";
            $nm_arquivo_pdf_url  = $this->Ini->path_imag_temp . $nm_arquivo_pdf_base;
            $nm_arquivo_pdf_serv = $this->Ini->root . $nm_arquivo_pdf_url;
            $nm_arquivo_de_saida = $this->Ini->root . $this->Ini->path_imag_temp . "/sc_grid_geral_rsvp_r_html_" . session_id() . ".html";
            $nm_url_de_saida = $this->Ini->server_pdf . $this->Ini->path_imag_temp . "/sc_grid_geral_rsvp_r_html_" . session_id() . ".html";
            if (in_array(trim($this->Ini->str_lang), $this->Ini->nm_font_ttf) && strtolower($_SESSION['scriptcase']['charset']) != "utf-8")
            { 
                $nm_saida->seta_arquivo($nm_arquivo_de_saida, $_SESSION['scriptcase']['charset']);
            }
            else
            { 
                $nm_saida->seta_arquivo($nm_arquivo_de_saida);
            }
         }
      }
//----------------------------------->
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "doc_word_res")
      { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['print_navigator'] = "Microsoft Internet Explorer";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['print_all'] = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['doc_word']  = true;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao']     = "resumo";
          $_SESSION['scriptcase']['saida_word'] = true;
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['word_name']))
          {
              $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['word_name'], ".");
              if ($Pos === false) {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['word_name'] .= ".doc";
              }
              $nm_arquivo_doc_word = "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['word_name'];
          }
          else
          {
              $nm_arquivo_doc_word = "/sc_grid_geral_rsvp_r_res_" . session_id() . ".doc";
          }
          $nm_saida->seta_arquivo($this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_doc_word);
          $this->Ini->nm_limite_lin_res_prt = 0;
          $GLOBALS['nmgp_cor_print'] = $nmgp_cor_word;
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "xls")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "grid_geral_rsvp_r/grid_geral_rsvp_r_xls.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "grid_geral_rsvp_r_xls.class.php"); 
          } 
          $this->xls  = new grid_geral_rsvp_r_xls();
          $this->prep_modulos("xls");
          $this->xls->monta_xls();
      }
      else
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "xml")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "grid_geral_rsvp_r/grid_geral_rsvp_r_xml.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "grid_geral_rsvp_r_xml.class.php"); 
          } 
          $this->xml  = new grid_geral_rsvp_r_xml();
          $this->prep_modulos("xml");
          $this->xml->monta_xml();
      }
      else
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "json")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "grid_geral_rsvp_r/grid_geral_rsvp_r_json.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "grid_geral_rsvp_r_json.class.php"); 
          } 
          $this->json  = new grid_geral_rsvp_r_json();
          $this->prep_modulos("json");
          $this->json->monta_json();
      }
      else
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "csv")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "grid_geral_rsvp_r/grid_geral_rsvp_r_csv.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "grid_geral_rsvp_r_csv.class.php"); 
          } 
          $this->csv  = new grid_geral_rsvp_r_csv();
          $this->prep_modulos("csv");
          $this->csv->monta_csv();
      }
      else   
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "rtf")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "grid_geral_rsvp_r/grid_geral_rsvp_r_rtf.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "grid_geral_rsvp_r_rtf.class.php"); 
          } 
          $this->rtf  = new grid_geral_rsvp_r_rtf();
          $this->prep_modulos("rtf");
          $this->rtf->monta_rtf();
      }
      else
    if (isset($_POST['chartapp_action']) && 'Y' == $_POST['chartapp_action']) {
        if (isset($_POST['chartapp_chart_type']) && 'Y' == $_POST['chartapp_chart_type'] && isset($_POST['chart_md5']) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['chart_info'][$_POST['chart_md5']])) {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida']) {
                require_once($this->Ini->path_embutida . "grid_geral_rsvp_r" . $this->Ini->Apl_resumo);
            } else {
                require_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo);
            }
            $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['chart_app_change_type'] = true;
            $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['chart_app_md5'] = $_POST['chart_md5'];
            $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['chart_app_type'] = $_POST['chart_type'];
            $this->Res = new grid_geral_rsvp_r_resumo("out");
            $this->prep_modulos("Res");
            $this->Res->monta_resumo();
        } else {
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida']) {
                require_once($this->Ini->path_embutida . "grid_geral_rsvp_r" . $this->Ini->Apl_grafico);
            } else {
                require_once($this->Ini->path_aplicacao . $this->Ini->Apl_grafico);
            }
            $this->Graf = new grid_geral_rsvp_r_grafico();
            $this->prep_modulos("Graf");
            $this->Graf->display_chartApp_type($_POST['chart_md5'], $_POST['chart_type']);
        }
    }
    else
      if (substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'], 0, 7) == "grafico")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'])
          { 
              require_once($this->Ini->path_embutida . " . grid_geral_rsvp_r . /" . $this->Ini->Apl_grafico); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . $this->Ini->Apl_grafico); 
          } 
          $this->Graf  = new grid_geral_rsvp_r_grafico();
          $this->prep_modulos("Graf");
          if (substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'], 7, 1) == "_")  
          { 
              $this->Graf->grafico_col(substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'], 8));
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = "grid";
          }
          else
          { 
              if (isset($_POST['summary_chart_data']) && 'Y' == $_POST['summary_chart_data'] && isset($_POST['chart_md5']) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['chart_info'][$_POST['chart_md5']])) {
                  $this->Graf->display_summaryChart_data($_POST['chart_md5']);
              }
              elseif (isset($_POST['summary_chart']) && 'Y' == $_POST['summary_chart'] && isset($_POST['chart_md5']) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['chart_info'][$_POST['chart_md5']])) {
                  $this->Graf->display_summaryChart_newPage($_POST['chart_md5']);
              }
              elseif (isset($_POST['chart_inline_create']) && 'Y' == $_POST['chart_inline_create'] && isset($_POST['chart_md5'])) {
                  $this->Graf->display_summaryChart_inline_initialAjaxResponse($_POST['chart_md5']);
              }
              elseif (isset($_POST['chart_inline_update']) && 'Y' == $_POST['chart_inline_update'] && isset($_POST['chart_md5']) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['chart_info'][$_POST['chart_md5']])) {
                  $this->Graf->display_summaryChart_inline_updateAjaxResponse($_POST['chart_md5']);
              }
              elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['dashboard_refresh_after_chart'])) {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['dashboard_refresh_after_chart'];
                  unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['dashboard_refresh_after_chart']);
              }
              else {
                  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = "grid";
              }
              $this->Graf->monta_grafico();
          }
      }
      else 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "busca")  
      { 
          if (!$_SESSION['scriptcase']['proc_mobile']) 
          { 
              require_once($this->Ini->path_aplicacao . "grid_geral_rsvp_r_pesq.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "grid_geral_rsvp_r_mobile_pesq.class.php"); 
          } 
          $this->pesq  = new grid_geral_rsvp_r_pesq();
          $this->prep_modulos("pesq");
          $this->pesq->NM_ajax_flag    = $this->NM_ajax_flag;
          $this->pesq->NM_ajax_opcao   = $this->NM_ajax_opcao;
          $this->pesq->monta_busca();
      }
      else 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "resumo")  
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "grid_geral_rsvp_r/" . $this->Ini->Apl_resumo); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . $this->Ini->Apl_resumo); 
          } 
          $this->Res = new grid_geral_rsvp_r_resumo("out");
          $this->prep_modulos("Res");
          $this->Res->monta_resumo();
      }
      else 
      { 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "print" && $nmgp_tipo_print == "RC")
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['print_navigator'] = $nmgp_navegator_print;
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['print_all'] = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao']     = "pdf";
              $GLOBALS['nmgp_tipo_pdf'] = strtolower($nmgp_cor_print);
          } 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] == "doc_word")
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['print_navigator'] = "Microsoft Internet Explorer";
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['print_all'] = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['doc_word']  = true;
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao']     = "pdf";
              $_SESSION['scriptcase']['saida_word'] = true;
              if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['word_name']))
              {
                  $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['word_name'], ".");
                  if ($Pos === false) {
                      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['word_name'] .= ".doc";
                  }
                  $nm_arquivo_doc_word =  "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['word_name'];
              }
              else
              {
                  $nm_arquivo_doc_word = "/sc_grid_geral_rsvp_r_" . session_id() . ".doc";
              }
              $nm_saida->seta_arquivo($this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_doc_word);
              $this->Ini->nm_limite_lin_prt = 0;
              $GLOBALS['nmgp_tipo_pdf'] = $nmgp_cor_word;
          } 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'])
          { 
              require_once($this->Ini->path_embutida . "grid_geral_rsvp_r/grid_geral_rsvp_r_grid.class.php"); 
          } 
          else 
          { 
              require_once($this->Ini->path_aplicacao . "grid_geral_rsvp_r_grid.class.php"); 
          } 
          if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_sub_toolbar']) && is_file('../' . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_sub_toolbar'] . '/grid_geral_rsvp_r_sub_tool.php')) {
              require_once('../' . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_sub_toolbar'] . '/grid_geral_rsvp_r_sub_tool.php');
              $this->grid  = new grid_geral_rsvp_r_tool_subcons();
          } 
          else { 
              $this->grid  = new grid_geral_rsvp_r_grid();
          } 
          $this->prep_modulos("grid");
          $this->grid->monta_grid($linhas);
      }   
//--- 
      if (!$_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida'])
      {
           $this->Db->Close(); 
      }
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'])
      {
         $nm_saida->finaliza();
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['ajax_nav'])
         {
             $Temp = ob_get_clean();
             if ($Temp !== false && trim($Temp) != "")
             {
                 $this->Ini->Arr_result['htmOutput'] = $Temp;
             }
             if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] != "ajax_detalhe")  
             {
                 $this->Ini->Arr_result['setVar'][] = array('var' => 'scQtReg', 'value' => $this->Ini->Qtd_reg_ajax_grid);
             }
             $_SESSION['scriptcase']['saida_var'] = false;
             $oJson = new Services_JSON();
             echo $oJson->encode($this->Ini->Arr_result);
             exit;
         }
            if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['export_sel_columns']['field_order']))
            {
                $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['export_sel_columns']['field_order'];
                unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['export_sel_columns']['field_order']);
            }
            if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['export_sel_columns']['usr_cmp_sel']))
            {
                $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['export_sel_columns']['usr_cmp_sel'];
                unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['export_sel_columns']['usr_cmp_sel']);
            }
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['doc_word'])
         {
             $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['word_file'] = $this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_doc_word;
             $this->html_doc_word($nm_arquivo_doc_word, $nmgp_password);
         }
         if ($this->Ini->Export_html_zip)
         {
             $this->html_export_print($nm_arquivo_html, $nmgp_password);
         }
         if ($ajax_opc_print)
         {
             $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_print . ".html");
             $this->Arr_result['title_export'] = NM_charset_to_utf8($nm_arquivo_print);
             $Temp = ob_get_clean();
             if ($Temp !== false && trim($Temp) != "")
             {
                 $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
             }
             $oJson = new Services_JSON();
             echo $oJson->encode($this->Arr_result);
             exit;
        }
         if ($nm_flag_pdf && $nm_vendo_pdf)
         {
            if (isset($nmgp_parms_pdf) && !empty($nmgp_parms_pdf))
            {
                $str_pd4ml = " ";
                $Tps_pap   = array('Letter','Legal','Ledger','A0','A1','A2','A3','A4','A5','A6','B5','Tabloid','A7','A8','A9','B0','B1','B2','B3','B4','Executive','B6','B7','B8','B9','B10','C5E','Comm10E','DLE','Folio');
                $Tmp = explode ("__SC__", $nmgp_parms_pdf);
                foreach ($Tmp as $cada_p) {
                    if (substr($cada_p, 0, 1) == "p" && in_array(substr($cada_p, 1), $Tps_pap)) {
                        $str_pd4ml .= " --page-size " . substr($cada_p, 1);
                    }
                    if ($cada_p == "op") {
                        $str_pd4ml .= " --orientation Portrait";
                    }
                    if ($cada_p == "ol") {
                        $str_pd4ml .= " --orientation Landscape";
                    }
                    if ($cada_p == "bn") {
                        $str_pd4ml .= " --outline-depth 0";
                    }
                }
            }
            else
            {
                $str_pd4ml    = " --page-size A4 --orientation Portrait";
            }
            if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['pdf_res'])
            { 
                $str_pd4ml .= " --outline-depth 0";
            }
            if (!$this->Ini->sc_export_ajax && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['pdf_det'])
            {
                if (-1 < $this->grid->progress_grid && $this->grid->progress_fp)
                {
                    $lang_protect = $this->Ini->Nm_lang['lang_pdff_gnrt'];
                    if (!NM_is_utf8($lang_protect))
                    {
                        $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
                    }
                    grid_geral_rsvp_r_pdf_progress_call($this->grid->progress_tot . "_#NM#_" . $this->grid->progress_tot . "_#NM#_" . $lang_protect . "...\n", $this->Ini->Nm_lang);
                    fwrite($this->grid->progress_fp, ($this->grid->progress_tot) . "_#NM#_" . $lang_protect . "...\n");
                    fclose($this->grid->progress_fp);
                }
            }
            if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['pdf_name']))
            {
                $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['pdf_name'], ".");
                if ($Pos === false) {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['pdf_name'] .= ".pdf";
                }
                if ('/' == substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['pdf_name'], 0, 1)) {
                    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['pdf_name'] = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['pdf_name'], 1);
                }
                $nm_arquivo_pdf_serv = $this->Ini->root .  $this->Ini->path_imag_temp . "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['pdf_name'];
                $nm_arquivo_pdf_url  = $this->Ini->path_imag_temp . "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['pdf_name'];
                $nm_arquivo_pdf_base = "/" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['pdf_name'];
                unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['pdf_name']);
            }
            $arq_pdf_out  = (FALSE !== strpos($nm_arquivo_pdf_serv, ' ')) ? " \"" . $nm_arquivo_pdf_serv . "\"" :  $nm_arquivo_pdf_serv;
            $arq_pdf_in   = (FALSE !== strpos($nm_url_de_saida, ' '))     ? " \"" . $nm_url_de_saida . "\""     :  $nm_url_de_saida;
            if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
            {
                $dir_qpdf = "/qpdf/win/bin";
            }
            elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
            {
                if (FALSE !== strpos(strtolower(php_uname()), 'i686')) 
                {
                    $dir_qpdf = "/qpdf/linux-i386";
                }
                else
                {
                    $dir_qpdf = "/qpdf/linux-amd64";
                }
            }
            elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
            {
                $dir_qpdf = "/qpdf/osx";
            }
            if ($this->pdf_zip == "S")
            {
                $arq_pdf_final = str_replace(".pdf", ".zip", $arq_pdf_out);
            }
            elseif (is_dir($this->Ini->path_third . $dir_qpdf) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['use_pass_pdf']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['use_pass_pdf']))
            {
                $arq_pdf_final = $arq_pdf_out;
                $arq_pdf_out   = str_replace(".pdf", "_wk.pdf", $arq_pdf_out);
            }
            $Win_autentication = "";
            if (isset($_SESSION['sc_pdf_usr']) && !empty($_SESSION['sc_pdf_usr']))
            {
                $_SESSION['sc_iis_usr'] = $_SESSION['sc_pdf_usr'];
            }
            if (isset($_SESSION['sc_iis_usr']) && !empty($_SESSION['sc_iis_usr']))
            {
                $Win_autentication .= " --username " . $_SESSION['sc_iis_usr'];
            }
            if (isset($_SESSION['sc_pdf_pw']) && !empty($_SESSION['sc_pdf_pw']))
            {
                $_SESSION['sc_iis_pw'] = $_SESSION['sc_pdf_pw'];
            }
            if (isset($_SESSION['sc_iis_pw']) && !empty($_SESSION['sc_iis_pw']))
            {
                $Win_autentication .= " --password " . $_SESSION['sc_iis_pw'];
            }
            if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
            {
                chdir($this->Ini->path_third . "/wkhtmltopdf/win");
                $str_execcmd2 = 'wkhtmltopdf ' . $str_pd4ml . $Win_autentication . ' --header-right "[page]"';
            }
            elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
            {
                if (isset($_SERVER['NM_SC_SYS_CONFIG']) && $_SERVER['NM_SC_SYS_CONFIG'] == 1) 
                {
                    chdir($this->Ini->path_third . "/wkhtmltopdf/linux-amd64");
                    $str_execcmd2 = './wkhtmltopdf-amd64 ' . $str_pd4ml . $Win_autentication . ' --header-right "[page]"';
                }
                elseif (FALSE !== strpos(strtolower(php_uname()), 'i686')) 
                {
                    if (FALSE !== strpos(php_uname(), 'Debian 4.19')) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/buster");
                    }
                    elseif (FALSE !== strpos(php_uname(), 'Debian 4.9')) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/stretch");
                    }
                    else
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/linux-i386");
                    }
                    $str_execcmd2 = './wkhtmltopdf-i386 ' . $str_pd4ml . $Win_autentication . ' --header-right "[page]"';
                }
                else
                {
                    if (FALSE !== strpos(strtolower(php_uname()), 'debian 4.19')) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/buster");
                    }
                    elseif (FALSE !== strpos(strtolower(php_uname()), 'debian 4.9')) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/stretch");
                    }
                    elseif (FALSE !== strpos(strtolower(php_uname()), 'debian 5.10') ) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/bullseye");
                    }
                    elseif (FALSE !== strpos(strtolower(php_uname()), 'debian 6.1') ) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/bookworm");
                    }
                    elseif (FALSE !== strpos(strtolower(php_uname()), '.el8.') || preg_match('/.el8_\d+./', strtolower(php_uname())) ) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/centos8");
                    }
                    elseif (FALSE !== strpos(strtolower(php_uname()), '.el9.') || preg_match('/.el9_\d+./', strtolower(php_uname())) ) 
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/centos9");
                    }
                    else
                    {
                        chdir($this->Ini->path_third . "/wkhtmltopdf/linux-amd64");
                    }
                    $str_execcmd2 = './wkhtmltopdf-amd64 ' . $str_pd4ml . $Win_autentication . ' --header-right "[page]"';
                }
            }
            elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
            {
                chdir($this->Ini->path_third . "/wkhtmltopdf/osx/Contents/MacOS");
                $str_execcmd2 = './wkhtmltopdf ' . $str_pd4ml . $Win_autentication . ' --header-right "[page]"';
            }

            if (!isset($_SESSION['scriptcase']['phantomjs_charts']) || !$_SESSION['scriptcase']['phantomjs_charts'])
            {
                $str_execcmd2 .= ' --javascript-delay ' . 2000;
            }

            $str_execcmd2 .= ' --disable-local-file-access ' . $arq_pdf_in . ' ' . $arq_pdf_out;

            $arr_execcmd = array();
            $str_execcmd = $str_execcmd2;
            exec($str_execcmd2);
            $str_cmd_qpdf = "";
            $str_zip      = "";
            if ($this->pdf_zip == "S")
            {
                $pdf_pass = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['use_pass_pdf'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['use_pass_pdf'] : "";
                $opt_pass = (!empty($pdf_pass)) ? " -p" : "";
                if (is_file($arq_pdf_final)) {
                    unlink($arq_pdf_final);
                }
                if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
                {
                    chdir($this->Ini->path_third . "/zip/windows");
                    $str_zip = "zip.exe" . strtoupper($opt_pass) . " -j " . $pdf_pass . " " . $arq_pdf_final . " " . $arq_pdf_out;
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
                      $str_zip = "./7za" . $opt_pass . $pdf_pass . " a " . $arq_pdf_final . " " . $arq_pdf_out;
                }
                elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
                {
                    chdir($this->Ini->path_third . "/zip/mac/bin");
                    $str_zip = "./7za" . $opt_pass . $pdf_pass . " a " . $arq_pdf_final . " " . $arq_pdf_out;
                }
                if (!empty($str_zip)) {
                    exec($str_zip);
                }
                if (is_file($arq_pdf_final)) 
                {
                    unlink($arq_pdf_out);
                }
            }
            elseif (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['use_pass_pdf']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['use_pass_pdf']))
            {
                if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
                {
                    $dir_qpdf = "/qpdf/win/bin";
                    $str_cmd_qpdf = "qpdf.exe ";
                }
                elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
                {
                    if (FALSE !== strpos(strtolower(php_uname()), 'i686')) 
                    {
                        $dir_qpdf = "/qpdf/linux-i386";
                        $str_cmd_qpdf = "./qpdf-linux-x86 ";
                    }
                    else
                    {
                        $dir_qpdf = "/qpdf/linux-amd64";
                        $str_cmd_qpdf = "./qpdf-linux-amd64 ";
                    }
                }
                elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
                {
                    $dir_qpdf = "/qpdf/osx";
                    $str_cmd_qpdf = "./qpdf-darwin-x86 ";
                }
                if (is_dir($this->Ini->path_third . $dir_qpdf)) 
                {
                    chdir($this->Ini->path_third . $dir_qpdf);
                    $pdf_pass  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['use_pass_pdf'];
                    $str_cmd_qpdf .= "--encrypt " . $pdf_pass . " " . $pdf_pass . " 256 -- " . $arq_pdf_out . " " . $arq_pdf_final;
                    exec($str_cmd_qpdf);
                    if (is_file($arq_pdf_final)) 
                    {
                        unlink($arq_pdf_out);
                    }
                }
            }
            $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['contr_array_resumo'] = '';
            $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['contr_total_geral']  = '';
            // ----- PDF log
            $fp = @fopen($this->Ini->root . $this->Ini->path_imag_temp . str_replace(array(".pdf",".zip"), array("",""), $nm_arquivo_pdf_base) . '.log', 'w');
            if ($fp)
            {
                @fwrite($fp, $str_execcmd . "\r\n\r\n");
                @fwrite($fp, implode("\r\n", $arr_execcmd));
                @fwrite($fp, $str_cmd_qpdf . "\r\n\r\n");
                @fwrite($fp, $str_zip . "\r\n\r\n");
                @fclose($fp);
            }
            if ($this->Ini->sc_export_ajax)
            {
                $this->Arr_result['file_export']  = NM_charset_to_utf8($nm_arquivo_pdf_serv);
                $this->Arr_result['title_export'] = NM_charset_to_utf8(substr($nm_arquivo_pdf_base, 1));
                $Temp = ob_get_clean();
                if ($Temp !== false && trim($Temp) != "")
                {
                    $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
                }
                $oJson = new Services_JSON();
                echo $oJson->encode($this->Arr_result);
                exit;
            }
            if (in_array(trim($this->Ini->str_lang), $this->Ini->nm_font_ttf) && strtolower($_SESSION['scriptcase']['charset']) != "utf-8")
            { 
               $_SESSION['scriptcase']['charset_html'] = (isset($this->Ini->sc_charset[$_SESSION['scriptcase']['charset']])) ? $this->Ini->sc_charset[$_SESSION['scriptcase']['charset']] : $_SESSION['scriptcase']['charset'];
            }
            if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['pdf_det'])
            {
                if (-1 < $this->grid->progress_grid && $this->grid->progress_fp)
                {
                    $this->grid->progress_fp = fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp', 'a');
                    if ($this->grid->progress_fp)
                    {
                         $lang_protect = $this->Ini->Nm_lang['lang_pdff_fnsh'];
                         if (!NM_is_utf8($lang_protect))
                         {
                             $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
                          }
                        grid_geral_rsvp_r_pdf_progress_call($this->grid->progress_tot . "_#NM#_" . ($this->grid->progress_now + 1 + $this->grid->progress_pdf) . "_#NM#_" . $lang_protect . "...\n", $this->Ini->Nm_lang);
                        grid_geral_rsvp_r_pdf_progress_call("off\n", $this->Ini->Nm_lang);
                        fwrite($this->grid->progress_fp, ($this->grid->progress_now + 1 + $this->grid->progress_pdf) . "_#NM#_" . $lang_protect . "...\n");
                        fwrite($this->grid->progress_fp, "off\n");
                        fclose($this->grid->progress_fp);
                    }
                }
            }
unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['pdf_file']);
if (is_file($nm_arquivo_pdf_serv))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['pdf_file'] = $nm_arquivo_pdf_serv;
}
$NM_volta  = "volta_grid";
$NM_target = "_parent";
$downloadFileName = "grid_geral_rsvp_r.pdf";
if ($this->pdf_zip == 'S') {
    $nm_arquivo_pdf_serv = str_replace('.pdf', '.zip', $nm_arquivo_pdf_serv);
    $nm_arquivo_pdf_url = str_replace('.pdf', '.zip', $nm_arquivo_pdf_url);
    $downloadFileName = str_replace('.pdf', '.zip', $downloadFileName);
}
if (!is_file($nm_arquivo_pdf_serv))
{
?>
  <br><b><?php echo $this->Ini->Nm_lang['lang_pdff_errg']; ?></b></td></tr></table>
<script type="text/javascript">
if (window.parent && typeof window.parent.displayErrorPdf === "function") {
    window.parent.displayErrorPdf("<?php echo $this->Ini->Nm_lang['lang_pdff_errg']; ?>");
}
</script>
<?php
}
else
{
?>
<?php echo $this->Ini->Nm_lang['lang_pdff_file_loct']; ?>
<BR>
<A href="<?php echo $nm_arquivo_pdf_url; ?>" target="_blank" class="scGridPageLink"><B><?php echo $nm_arquivo_pdf_url; ?></B></A>.
<BR>
<?php echo $this->Ini->Nm_lang['lang_pdff_clck_mesg']; ?>
</td></tr></table>
<script type="text/javascript">
if (window.parent && typeof window.parent.updateGeneratedPdfFile === "function") {
    window.parent.updateGeneratedPdfFile("<?php echo $nm_arquivo_pdf_url; ?>");
}
</script>
<?php
    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r'][md5("newpdf_" . $downloadFileName)][0] = $nm_arquivo_pdf_url;
    $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r'][md5("newpdf_" . $downloadFileName)][1] = $downloadFileName;
}
   echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "sc_b_sai", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
?>
<FORM name="F0" method=post action="./" target="<?php echo $NM_target; ?>"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($NM_volta); ?>"> 
<INPUT type="hidden" name="nm_grid_submit" value="1"/> 
<INPUT type="hidden" name="csrf_token" value="<?php echo $this->Ini->scCsrfGetToken() ?>"/> 
</FORM>
</td></tr></table>
</BODY>
</HTML>
<?php
         }
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
				$nome_empresa = $this->rs[0][2];
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
      $this->rsm = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsm[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsm = false;
          $this->rsm_erro = $this->Db->ErrorMsg();
      } 
	                                                                                      
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
                                                                                    
		$reg_mestre = sizeof($this->rsm );		                                                                                    
		if ($reg_mestre > 0) {				                                                                                        
			for ($i=0;$i<$reg_mestre;++$i) {
				if ($vp_tipoPessoa == 'P') {
					$_ap_cpf					= $this->rsm[$i][0]; 		 
					$_ap_nome               	= $this->rsm[$i][1];        
					$_ap_id_evento	       		= $this->rsm[$i][2];        
					$_ap_nome_cracha 	   		= $this->rsm[$i][3];        
					$_ap_tam_camisa             = $this->rsm[$i][4];        
					$_ap_tam_calcado            = $this->rsm[$i][5];        
					$_ap_cargo                  = $this->rsm[$i][6];        
					$_ap_empresa                = $this->rsm[$i][7];        
					$_ap_departamento       	= $this->rsm[$i][8];        
					$_ap_grupo              	= $this->rsm[$i][9];        
					$_ap_id_evento_publico  	= $this->rsm[$i][10];       
					$_ap_id_evento_regional 	= $this->rsm[$i][11];       
					$_ap_dt_cadastro        	= $this->rsm[$i][12];       
					$_ap_logradouro         	= $this->rsm[$i][13];       
					$_ap_complemento        	= $this->rsm[$i][14];       
					$_ap_bairro             	= $this->rsm[$i][15];       
					$_ap_cidade             	= $this->rsm[$i][16];       
					$_ap_cep                	= $this->rsm[$i][17];       
					$_ap_uf	                	= $this->rsm[$i][18];       
					$_ap_pais               	= $this->rsm[$i][19];       
					$_ap_ddd_01             	= $this->rsm[$i][20];       
					$_ap_fone_01            	= $this->rsm[$i][21];       
					$_ap_ddd_celular_01     	= $this->rsm[$i][22];       
					$_ap_celeular_01        	= $this->rsm[$i][23];       
					$_ap_passaporte         	= $this->rsm[$i][24];       
					$_ap_validade_pass      	= $this->rsm[$i][25];       
					$_ap_rg                 	= $this->rsm[$i][26];       
					$_ap_filiacao           	= $this->rsm[$i][27];       
					$_ap_dt_nasc            	= $this->rsm[$i][28];       
					$_ap_fumante            	= $this->rsm[$i][29];       
					$_ap_restricao_alimentar	= $this->rsm[$i][30];	    
					$_ap_email              	= $this->rsm[$i][31];       
					$_ap_dt_alt_presenca    	= $this->rsm[$i][32];       
					$_ap_presenca           	= $this->rsm[$i][33];       
					$_ap_contato_rsvp       	= $this->rsm[$i][34];			
					$_ap_nome_substituto 		= $this->rsm[$i][35];			
					$_ho_cpf_participante   	= $this->rsm[$i][36];       
					$_ho_id_evento          	= $this->rsm[$i][37];       
					$_ho_acompanhante       	= $this->rsm[$i][38];       
					$_ho_part_acomp         	= $this->rsm[$i][39];       
					$_ho_dt_checkin         	= $this->rsm[$i][40];       
					$_ho_dt_checkout        	= $this->rsm[$i][41];       
					$_ho_id_hotel           	= $this->rsm[$i][42];       
					$_ho_reserva_bvt        	= $this->rsm[$i][43];       
					$_tr_id_evento          	= $this->rsm[$i][44];       
					$_tr_cpf_particip       	= $this->rsm[$i][45];       
					$_tr_dt_saida_ida       	= $this->rsm[$i][46];       
					$_tr_hr_saida_ida       	= $this->rsm[$i][47];       
					$_tr_dt_chegada_ida     	= $this->rsm[$i][48];       
					$_tr_hr_chegada_ida     	= $this->rsm[$i][49];       
					$_tr_cia_ida            	= $this->rsm[$i][50];       
					$_tr_origem_ida         	= $this->rsm[$i][51];       
					$_tr_destino_ida        	= $this->rsm[$i][52];       
					$_tr_numvoo_ida         	= $this->rsm[$i][53];       
					$_tr_localizador_ida    	= $this->rsm[$i][54];       
					$_tr_eticket_ida        	= $this->rsm[$i][55];       
					$_tr_hrtransout         	= $this->rsm[$i][56];       
					$_tr_dt_ida_local       	= $this->rsm[$i][57];       
					$_tr_hr_ida_local       	= $this->rsm[$i][58];       
					$_tr_dt_volta_local     	= $this->rsm[$i][59];       
					$_tr_hr_volta_local     	= $this->rsm[$i][60];       
					$_tr_cia_volta              = $this->rsm[$i][61];       
					$_tr_origem_volta           = $this->rsm[$i][62];       
					$_tr_destino_volta          = $this->rsm[$i][63];       
					$_tr_numvoo_volta           = $this->rsm[$i][64];       
					$_tr_localizador_volta      = $this->rsm[$i][65];       
					$_tr_eticket_volta          = $this->rsm[$i][66];       
					$_tr_observacao	            = $this->rsm[$i][67];       
					$_tr_tipo_transfer			= $this->rsm[$i][68];    					   
					$_ho_early_chkin  			= $this->rsm[$i][69];    					   
					$_ho_late_chkout			= $this->rsm[$i][70]; 
					$_tr_status       			= $this->rsm[$i][71];
					$_tr_id_hotel_out			= $this->rsm[$i][72]; 
					$_tr_dt_saida_volta			= $this->rsm[$i][73];
					$_tr_hr_saida_volta			= $this->rsm[$i][74];
					$_tr_dt_chegada_volta		= $this->rsm[$i][75];
					$_tr_hr_chegada_volta		= $this->rsm[$i][76];
					$_tr_dt_chegada_prop		= $this->rsm[$i][77];
					$_tr_hr_chegada_prop		= $this->rsm[$i][78];	
					$_ap_cod_substituto			= $this->rsm[$i][79];
					$_ho_hosp_diarias			= $this->rsm[$i][80]; 
					$_ho_hosp_taxas     		= $this->rsm[$i][81]; 
					$_an_anota_dsc				= $this->rsm[$i][82]; 
					$_ap_nome_acompanhado 		= '';		   
					$_ap_cpf_mestre				= '';
					$w_foneinter				= $this->rsm[$i][83];
				} else {
					$_ap_cpf 					= $this->rsm[$i][0];       
					$_ap_nome               	= $this->rsm[$i][1];    
					$_ap_id_evento	        	= $this->rsm[$i][2];    
					$_ap_nome_cracha 	    	= $this->rsm[$i][3];    
					$_ap_tam_camisa         	= $this->rsm[$i][4];    
					$_ap_tam_calcado        	= $this->rsm[$i][5];    
					$_ap_cargo              	= $this->rsm[$i][6];    
					$_ap_empresa            	= $this->rsm[$i][7];    
					$_ap_departamento       	= $this->rsm[$i][8];    
					$_ap_grupo              	= $this->rsm[$i][9];    
					$_ap_id_evento_publico  	= $this->rsm[$i][10];    
					$_ap_id_evento_regional 	= $this->rsm[$i][11];    
					$_ap_dt_cadastro        	= $this->rsm[$i][12];    
					$_ap_logradouro         	= $this->rsm[$i][13];    
					$_ap_complemento        	= $this->rsm[$i][14];    
					$_ap_bairro             	= $this->rsm[$i][15];    
					$_ap_cidade             	= $this->rsm[$i][16];    
					$_ap_cep                	= $this->rsm[$i][17];    
					$_ap_uf	                	= $this->rsm[$i][18];    
					$_ap_pais               	= $this->rsm[$i][19];    
					$_ap_ddd_01             	= $this->rsm[$i][20];    
					$_ap_fone_01            	= $this->rsm[$i][21];    
					$_ap_ddd_celular_01     	= $this->rsm[$i][22];    
					$_ap_celeular_01        	= $this->rsm[$i][23];    
					$_ap_passaporte         	= $this->rsm[$i][24];    
					$_ap_validade_pass      	= $this->rsm[$i][25];    
					$_ap_rg                 	= $this->rsm[$i][26];    
					$_ap_filiacao           	= $this->rsm[$i][27];    
					$_ap_dt_nasc            	= $this->rsm[$i][28];    
					$_ap_fumante            	= $this->rsm[$i][29];    
					$_ap_restricao_alimentar	= $this->rsm[$i][30];    
					$_ap_email              	= $this->rsm[$i][31];    
					$_ap_dt_alt_presenca    	= $this->rsm[$i][32];    
					$_ap_presenca           	= $this->rsm[$i][33];    
					$_ap_contato_rsvp       	= $this->rsm[$i][34];    			
					$_ap_cpf_mestre				= $this->rsm[$i][35];    
					$_ho_cpf_participante    	= $this->rsm[$i][36];    
					$_ho_id_evento           	= $this->rsm[$i][37];    
					$_ho_acompanhante        	= $this->rsm[$i][38];    
					$_ho_part_acomp          	= $this->rsm[$i][39];    
					$_ho_dt_checkin          	= $this->rsm[$i][40];    
					$_ho_dt_checkout         	= $this->rsm[$i][41];    
					$_ho_id_hotel            	= $this->rsm[$i][42];    
					$_ho_reserva_bvt         	= $this->rsm[$i][43];    
					$_tr_id_evento           	= $this->rsm[$i][44];    
					$_tr_cpf_particip        	= $this->rsm[$i][45];    
					$_tr_dt_saida_ida        	= $this->rsm[$i][46];    
					$_tr_hr_saida_ida        	= $this->rsm[$i][47];    
					$_tr_dt_chegada_ida      	= $this->rsm[$i][48];    
					$_tr_hr_chegada_ida      	= $this->rsm[$i][49];    
					$_tr_cia_ida             	= $this->rsm[$i][50];    
					$_tr_origem_ida          	= $this->rsm[$i][51];    
					$_tr_destino_ida         	= $this->rsm[$i][52];    
					$_tr_numvoo_ida          	= $this->rsm[$i][53];    
					$_tr_localizador_ida     	= $this->rsm[$i][54];    
					$_tr_eticket_ida         	= $this->rsm[$i][55];    
					$_tr_hrtransout          	= $this->rsm[$i][56];    
					$_tr_dt_ida_local        	= $this->rsm[$i][57];    
					$_tr_hr_ida_local        	= $this->rsm[$i][58];    
					$_tr_dt_volta_local      	= $this->rsm[$i][59];    
					$_tr_hr_volta_local      	= $this->rsm[$i][60];    
					$_tr_cia_volta           	= $this->rsm[$i][61];    
					$_tr_origem_volta        	= $this->rsm[$i][62];    
					$_tr_destino_volta       	= $this->rsm[$i][63];    
					$_tr_numvoo_volta        	= $this->rsm[$i][64];    
					$_tr_localizador_volta      = $this->rsm[$i][65];    
					$_tr_eticket_volta          = $this->rsm[$i][66];    
					$_tr_observacao	       		= $this->rsm[$i][67];	  
					$_tr_tipo_transfer			= $this->rsm[$i][68];       
					$_ho_early_chkin  			= $this->rsm[$i][69];    					   
					$_ho_late_chkout			= $this->rsm[$i][70];    					   
					$_tr_status       			= $this->rsm[$i][71];
					$_tr_id_hotel_out			= $this->rsm[$i][72]; 
					$_tr_dt_saida_volta			= $this->rsm[$i][73];
					$_tr_hr_saida_volta			= $this->rsm[$i][74];
					$_tr_dt_chegada_volta		= $this->rsm[$i][75];
					$_tr_hr_chegada_volta		= $this->rsm[$i][76];		   
					$_tr_dt_chegada_prop		= $this->rsm[$i][77];
					$_tr_hr_chegada_prop		= $this->rsm[$i][78];			
					$_ho_hosp_diarias			= $this->rsm[$i][79]; 
					$_ho_hosp_taxas     		= $this->rsm[$i][80]; 
					$_ap_nome_substituto		= '';
					$_ap_nome_acompanhado 		= '';			
					$_ap_cod_substituto			= '';
					$w_foneinter				= $this->rsm[$i][83];
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
      $this->rsusu = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsusu[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsusu = false;
          $this->rsusu_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rsusu[0][0])) {									                                                                            
					$w_usurelDsc = $this->rsusu[0][1];                                                                                  
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
      $this->rseve = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rseve[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rseve = false;
          $this->rseve_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rseve[0][0])) {									                                                                            
					$w_eventoDsc = $this->rseve[0][1];                                                                                  
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
      $this->rscia = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rscia[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rscia = false;
          $this->rscia_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rscia[0][0])) {									                                                                            
					$w_ciaida = $this->rscia[0][1];                                                                                  
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
      $this->rscia = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rscia[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rscia = false;
          $this->rscia_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rscia[0][0])) {									                                                                            
					$w_ciavolta = $this->rscia[0][1];                                                                                  
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
      $this->rspub = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspub[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspub = false;
          $this->rspub_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rspub[0][0])) {									                                                                            
					$w_publico = $this->rspub[0][1];                                                                                  
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
      $this->rshot = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rshot[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rshot = false;
          $this->rshot_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rshot[0][0])) {									                                                                            
					$w_hotel_dsc = $this->rshot[0][1];                                                                                  
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
      $this->rshotout = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rshotout[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rshotout = false;
          $this->rshotout_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rshotout[0][0])) {									                                                                            
					$w_hotel_dsc_out = $this->rshotout[0][1];                                                                                  
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
      $this->rsreg = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsreg[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsreg = false;
          $this->rsreg_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rsreg[0][0])) {									                                                                            
					$w_regional = $this->rsreg[0][1];                                                                                  
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
      $this->rspais = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspais[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspais = false;
          $this->rspais_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rspais[0][0])) {									                                                                            
					$w_pais = $this->rspais[0][1];                                                                                  
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
      $this->rsaerop = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsaerop[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsaerop = false;
          $this->rsaerop_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($this->rsaerop[0][0])) {									
					$w_origemIda = $this->rsaerop[0][3].' - '.$this->rsaerop[0][1].' - '.$this->rsaerop[0][2].' - '.$this->rsaerop[0][4];
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
      $this->rsaerop = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsaerop[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsaerop = false;
          $this->rsaerop_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($this->rsaerop[0][0])) {									
					$w_destinoIda = $this->rsaerop[0][3].' - '.$this->rsaerop[0][1].' - '.$this->rsaerop[0][2].' - '.$this->rsaerop[0][4];
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
      $this->rsaerop = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsaerop[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsaerop = false;
          $this->rsaerop_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($this->rsaerop[0][0])) {									
					$w_origemVolta = $this->rsaerop[0][3].' - '.$this->rsaerop[0][1].' - '.$this->rsaerop[0][2].' - '.$this->rsaerop[0][4];
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
      $this->rsaerop = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsaerop[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsaerop = false;
          $this->rsaerop_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($this->rsaerop[0][0])) {									
					$w_destinoVolta = $this->rsaerop[0][3].' - '.$this->rsaerop[0][1].' - '.$this->rsaerop[0][2].' - '.$this->rsaerop[0][4];
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
      $this->rsamestre = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsamestre[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsamestre = false;
          $this->rsamestre_erro = $this->Db->ErrorMsg();
      } 
				
					if (isset($this->rsamestre[0][0])) {									
						$_ap_nome_acompanhado = $this->rsamestre[0][1];
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
      $this->rshosp = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rshosp[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rshosp = false;
          $this->rshosp_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rshosp[0][0])) {									                                                                            					
					if ($this->rshosp[0][3] == 'Y') {
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
      $this->rstaer = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rstaer[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rstaer = false;
          $this->rstaer_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rstaer[0][0])) {							
						$_tr_dt_saida_ida       	= $this->rstaer[0][4];       
						$_tr_hr_saida_ida       	= $this->rstaer[0][5];       
						$_tr_dt_chegada_ida     	= $this->rstaer[0][6];       
						$_tr_hr_chegada_ida     	= $this->rstaer[0][7];       
						$w_ciaida      		       	= $this->rstaer[0][8];       
						$w_origemIda        	 	= $this->rstaer[0][9];       
						$w_destinoIda        		= $this->rstaer[0][10];       
						$_tr_numvoo_ida         	= $this->rstaer[0][11];       
						$_tr_localizador_ida    	= $this->rstaer[0][12];       
						$_tr_eticket_ida       		= $this->rstaer[0][13];   
						$w_aerstatus_ida			= $this->rstaer[0][3];
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
      $this->rstaer = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rstaer[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rstaer = false;
          $this->rstaer_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rstaer[0][0])) {							
						$_tr_dt_saida_volta       	= $this->rstaer[0][4];       
						$_tr_hr_saida_volta       	= $this->rstaer[0][5];       
						$_tr_dt_chegada_volta     	= $this->rstaer[0][6];       
						$_tr_hr_chegada_volta     	= $this->rstaer[0][7];       
						$w_ciavolta    		       	= $this->rstaer[0][8];       
						$w_origemVolta        	 	= $this->rstaer[0][9];       
						$w_destinoVolta        		= $this->rstaer[0][10];       
						$_tr_numvoo_volta         	= $this->rstaer[0][11];       
						$_tr_localizador_volta    	= $this->rstaer[0][12];       
						$_tr_eticket_volta     		= $this->rstaer[0][13];  						
						$w_aerstatus_volta			= $this->rstaer[0][3];
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
					$vpresenca_status       = $this->rspres[0][2];
					$vpresenca_data			= $this->rspres[0][3];  
					$vpresenca_motivo       = $this->rspres[0][4];  
					$vpresenca_obs          = $this->rspres[0][5];
					$vpresenca_usuario_id   = $this->rspres[0][6];  
					$vpresenca_tipo_part    = $this->rspres[0][7];
					$vpresenca_usuario_nome	= $this->rspres[0][8];								
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
      $this->rscont = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rscont[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rscont = false;
          $this->rscont_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rscont[0][0])) {					
					$vcontato_cpf 			= $this->rscont[0][0];			
					$vcontato_status        = $this->rscont[0][2];   
					$vcontato_data          = $this->rscont[0][3];  
					$vcontato_motivo        = $this->rscont[0][4]; 
					$vcontato_obs           = $this->rscont[0][5]; 
					$vcontato_usuario_id    = $this->rscont[0][6];   
					$vcontato_usuario_nome	= $this->rscont[0][7];						
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
      $this->rslins = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rslins[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rslins = false;
          $this->rslins_erro = $this->Db->ErrorMsg();
      } 

				if (isset($this->rslins[0][0])) {
					$qtde = $this->rslins[0][0];
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
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'off';
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
  function close_emb()
  {
      if ($this->Db)
      {
          $this->Db->Close(); 
      }
  }
   function SC_fast_search($in_fields, $arg_search, $data_search)
   {
      $fields = (strpos($in_fields, "SC_all_Cmp") !== false) ? array("SC_all_Cmp") : explode("_VLS_", $in_fields);
      $this->NM_case_insensitive = true;
      if (empty($data_search)) 
      {
          $tmp_cmd = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_fast'] = "";
          if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_orig'])) 
          {
              $tmp_cmd = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_orig']; 
          }
          if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_filtro'])) 
          {
              if (!empty($tmp_cmd)) 
              {
                  $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_filtro'] . ")"; 
              }
              else
              {
                  $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_filtro'] . ")"; 
              }
          }
          if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_interativ'])) 
          {
              if (!empty($tmp_cmd)) 
              {
                  $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_interativ'] . ")"; 
              }
              else
              {
                  $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_interativ'] . ")"; 
              }
          }
          if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_grid'])) 
          {
              if (!empty($tmp_cmd)) 
              {
                  $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_grid'] . ")"; 
              }
              else
              {
                  $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_grid'] . ")"; 
              }
          }
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq'] = $tmp_cmd;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['fast_search']);
          return;
      }
      $comando = "";
      if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($data_search))
      {
          $data_search = NM_conv_charset($data_search, $_SESSION['scriptcase']['charset'], "UTF-8");
      }
      $sv_data = $data_search;
      foreach ($fields as $field) {
          if ($field == "SC_all_Cmp" || $field == "evento_id") 
          {
              $this->SC_monta_condicao($comando, "evento_id", $arg_search, str_replace(",", ".", $data_search));
          }
          if ($field == "SC_all_Cmp" || $field == "evento_dsc") 
          {
              $this->SC_monta_condicao($comando, "evento_dsc", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "nome_participante") 
          {
              $this->SC_monta_condicao($comando, "nome_participante", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "tipo_pessoa") 
          {
              $this->SC_monta_condicao($comando, "tipo_pessoa", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "data_nascimento") 
          {
              $this->SC_monta_condicao($comando, "data_nascimento", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "rg") 
          {
              $this->SC_monta_condicao($comando, "rg", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "nome_cracha") 
          {
              $this->SC_monta_condicao($comando, "nome_cracha", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "convidado_original") 
          {
              $this->SC_monta_condicao($comando, "convidado_original", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "nome_substituto") 
          {
              $this->SC_monta_condicao($comando, "nome_substituto", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "acomp_mesmoquarto") 
          {
              $this->SC_monta_condicao($comando, "acomp_mesmoquarto", $arg_search, $data_search, "MEDIUMTEXT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "partici_mesmoquarto") 
          {
              $this->SC_monta_condicao($comando, "partici_mesmoquarto", $arg_search, $data_search, "MEDIUMTEXT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_dsc") 
          {
              $this->SC_monta_condicao($comando, "hotel_dsc", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "checkin") 
          {
              $this->SC_monta_condicao($comando, "checkin", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "checkout") 
          {
              $this->SC_monta_condicao($comando, "checkout", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "early_checkin") 
          {
              $this->SC_monta_condicao($comando, "early_checkin", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "late_checkout") 
          {
              $this->SC_monta_condicao($comando, "late_checkout", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "tamanho_camisa") 
          {
              $this->SC_monta_condicao($comando, "tamanho_camisa", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "tamanho_calcado") 
          {
              $this->SC_monta_condicao($comando, "tamanho_calcado", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "empresa") 
          {
              $this->SC_monta_condicao($comando, "empresa", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "cargo") 
          {
              $this->SC_monta_condicao($comando, "cargo", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "departamento") 
          {
              $this->SC_monta_condicao($comando, "departamento", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "grupo") 
          {
              $this->SC_monta_condicao($comando, "grupo", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "publico_dsc") 
          {
              $this->SC_monta_condicao($comando, "publico_dsc", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "regional_dsc") 
          {
              $this->SC_monta_condicao($comando, "regional_dsc", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "data_cadastro") 
          {
              $this->SC_monta_condicao($comando, "data_cadastro", $arg_search, $data_search, "TIMESTAMP", false);
          }
          if ($field == "SC_all_Cmp" || $field == "logradouro") 
          {
              $this->SC_monta_condicao($comando, "logradouro", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "complemento") 
          {
              $this->SC_monta_condicao($comando, "complemento", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "cidade") 
          {
              $this->SC_monta_condicao($comando, "cidade", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "bairro") 
          {
              $this->SC_monta_condicao($comando, "bairro", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "cep") 
          {
              $this->SC_monta_condicao($comando, "cep", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "uf") 
          {
              $this->SC_monta_condicao($comando, "uf", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "pais_dsc") 
          {
              $this->SC_monta_condicao($comando, "pais_dsc", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "ddd_tel01") 
          {
              $this->SC_monta_condicao($comando, "ddd_tel01", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "tel01") 
          {
              $this->SC_monta_condicao($comando, "tel01", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "ddd_celular") 
          {
              $this->SC_monta_condicao($comando, "ddd_celular", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "celular") 
          {
              $this->SC_monta_condicao($comando, "celular", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "telefone_internacional") 
          {
              $this->SC_monta_condicao($comando, "telefone_internacional", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "passaporte") 
          {
              $this->SC_monta_condicao($comando, "passaporte", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "validade_passporte") 
          {
              $this->SC_monta_condicao($comando, "validade_passporte", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "cpf") 
          {
              $this->SC_monta_condicao($comando, "cpf", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "filiacao") 
          {
              $this->SC_monta_condicao($comando, "filiacao", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "fumante") 
          {
              $this->SC_monta_condicao($comando, "fumante", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "restricao_alimentar") 
          {
              $this->SC_monta_condicao($comando, "restricao_alimentar", $arg_search, $data_search, "TINYTEXT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "e_mail") 
          {
              $this->SC_monta_condicao($comando, "e_mail", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "atualizacao_presenca") 
          {
              $this->SC_monta_condicao($comando, "atualizacao_presenca", $arg_search, $data_search, "TIMESTAMP", false);
          }
          if ($field == "SC_all_Cmp" || $field == "presenca") 
          {
              $this->SC_monta_condicao($comando, "presenca", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "dt_confirm_presenca") 
          {
              $this->SC_monta_condicao($comando, "dt_confirm_presenca", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "presenca_motivo") 
          {
              $this->SC_monta_condicao($comando, "presenca_motivo", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "presenca_atendente") 
          {
              $this->SC_monta_condicao($comando, "presenca_atendente", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "presenca_obs") 
          {
              $this->SC_monta_condicao($comando, "presenca_obs", $arg_search, $data_search, "MEDIUMTEXT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "contato_antendente") 
          {
              $this->SC_monta_condicao($comando, "contato_antendente", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "data_contato") 
          {
              $this->SC_monta_condicao($comando, "data_contato", $arg_search, $data_search, "TIMESTAMP", false);
          }
          if ($field == "SC_all_Cmp" || $field == "motivo_contato") 
          {
              $this->SC_monta_condicao($comando, "motivo_contato", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "obs_contato") 
          {
              $this->SC_monta_condicao($comando, "obs_contato", $arg_search, $data_search, "MEDIUMTEXT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "status_contato") 
          {
              $this->SC_monta_condicao($comando, "status_contato", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hora_saida_ida") 
          {
              $this->SC_monta_condicao($comando, "hora_saida_ida", $arg_search, $data_search, "TIME", false);
          }
          if ($field == "SC_all_Cmp" || $field == "trecho") 
          {
              $this->SC_monta_condicao($comando, "trecho", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_ida_dsc") 
          {
              $this->SC_monta_condicao($comando, "hotel_ida_dsc", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "comprada_bvt_ida") 
          {
              $this->SC_monta_condicao($comando, "comprada_bvt_ida", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "data_saida_ida") 
          {
              $this->SC_monta_condicao($comando, "data_saida_ida", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "origem_dsc_ida") 
          {
              $this->SC_monta_condicao($comando, "origem_dsc_ida", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "destino_dsc_ida") 
          {
              $this->SC_monta_condicao($comando, "destino_dsc_ida", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "voo_ida") 
          {
              $this->SC_monta_condicao($comando, "voo_ida", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "cia_dsc_ida") 
          {
              $this->SC_monta_condicao($comando, "cia_dsc_ida", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "localizador_ida") 
          {
              $this->SC_monta_condicao($comando, "localizador_ida", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "etkt_ida") 
          {
              $this->SC_monta_condicao($comando, "etkt_ida", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "data_chegada_ida") 
          {
              $this->SC_monta_condicao($comando, "data_chegada_ida", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hora_chegada_ida") 
          {
              $this->SC_monta_condicao($comando, "hora_chegada_ida", $arg_search, $data_search, "TIME", false);
          }
          if ($field == "SC_all_Cmp" || $field == "status_aereo_ida") 
          {
              $this->SC_monta_condicao($comando, "status_aereo_ida", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "trecho_volta") 
          {
              $this->SC_monta_condicao($comando, "trecho_volta", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hotel_volta_dsc") 
          {
              $this->SC_monta_condicao($comando, "hotel_volta_dsc", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hr_transfer_volta") 
          {
              $this->SC_monta_condicao($comando, "hr_transfer_volta", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "comprada_bvt_volta") 
          {
              $this->SC_monta_condicao($comando, "comprada_bvt_volta", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "data_saida_volta") 
          {
              $this->SC_monta_condicao($comando, "data_saida_volta", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hora_saida_volta") 
          {
              $this->SC_monta_condicao($comando, "hora_saida_volta", $arg_search, $data_search, "TIME", false);
          }
          if ($field == "SC_all_Cmp" || $field == "data_chegada_volta") 
          {
              $this->SC_monta_condicao($comando, "data_chegada_volta", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hora_chegada_volta") 
          {
              $this->SC_monta_condicao($comando, "hora_chegada_volta", $arg_search, $data_search, "TIME", false);
          }
          if ($field == "SC_all_Cmp" || $field == "origem_dsc_volta") 
          {
              $this->SC_monta_condicao($comando, "origem_dsc_volta", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "destino_dsc_volta") 
          {
              $this->SC_monta_condicao($comando, "destino_dsc_volta", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "cia_dsc_volta") 
          {
              $this->SC_monta_condicao($comando, "cia_dsc_volta", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "voo_volta") 
          {
              $this->SC_monta_condicao($comando, "voo_volta", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "localizador_volta") 
          {
              $this->SC_monta_condicao($comando, "localizador_volta", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "etkt_volta") 
          {
              $this->SC_monta_condicao($comando, "etkt_volta", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "status_aereo_volta") 
          {
              $this->SC_monta_condicao($comando, "status_aereo_volta", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "tipo_transfer") 
          {
              $this->SC_monta_condicao($comando, "tipo_transfer", $arg_search, $data_search, "VARCHAR", false);
          }
          if ($field == "SC_all_Cmp" || $field == "dt_chegada_proprio") 
          {
              $this->SC_monta_condicao($comando, "dt_chegada_proprio", $arg_search, $data_search, "DATE", false);
          }
          if ($field == "SC_all_Cmp" || $field == "hr_chegada_proprio") 
          {
              $this->SC_monta_condicao($comando, "hr_chegada_proprio", $arg_search, $data_search, "TIME", false);
          }
          if ($field == "SC_all_Cmp" || $field == "valor_diaria") 
          {
              $this->SC_monta_condicao($comando, "valor_diaria", $arg_search, str_replace(",", ".", $data_search));
          }
          if ($field == "SC_all_Cmp" || $field == "valor_taxa") 
          {
              $this->SC_monta_condicao($comando, "valor_taxa", $arg_search, str_replace(",", ".", $data_search));
          }
          if ($field == "SC_all_Cmp" || $field == "obs_transfer") 
          {
              $this->SC_monta_condicao($comando, "obs_transfer", $arg_search, $data_search, "TINYTEXT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "anotacoes") 
          {
              $this->SC_monta_condicao($comando, "anotacoes", $arg_search, $data_search, "MEDIUMTEXT", false);
          }
          if ($field == "SC_all_Cmp" || $field == "id_geral") 
          {
              $this->SC_monta_condicao($comando, "id_geral", $arg_search, str_replace(",", ".", $data_search));
          }
          if ($field == "SC_all_Cmp" || $field == "cpf_mestre") 
          {
              $this->SC_monta_condicao($comando, "cpf_mestre", $arg_search, $data_search, "VARCHAR", false);
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
      if (empty($comando)) 
      {
          $comando = " 1 <> 1 "; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_fast'] = $comando;
      $tmp_cmd = "";
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_orig'])) 
      {
          $tmp_cmd = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_orig']; 
      }
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_filtro'])) 
      {
          if (!empty($tmp_cmd)) 
          {
              $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_filtro'] . ")"; 
          }
          else
          {
              $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_filtro'] . ")"; 
          }
      }
      if (!empty($tmp_cmd)) 
      {
          $comando = $tmp_cmd . " and (" . $comando . ")"; 
      }
      else
      {
          $comando = " where (" . $comando . ")"; 
      }
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_interativ'])) 
      {
          $comando .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_interativ'] . ")";
      }
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_grid'])) 
      {
          $comando .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_grid'] . ")";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq'] = $comando;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['fast_search'][0] = $in_fields;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['fast_search'][1] = $arg_search;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['fast_search'][2] = $sv_data;
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
      $nm_numeric[] = "id_geral";$nm_numeric[] = "evento_id";$nm_numeric[] = "hotel";$nm_numeric[] = "publico";$nm_numeric[] = "regional";$nm_numeric[] = "pais";$nm_numeric[] = "hotel_ida";$nm_numeric[] = "cia_aerea_ida";$nm_numeric[] = "origem_ida";$nm_numeric[] = "destino_ida";$nm_numeric[] = "hotel_volta";$nm_numeric[] = "cia_aerea_volta";$nm_numeric[] = "origem_volta";$nm_numeric[] = "destino_volta";$nm_numeric[] = "id_usuario_relato";$nm_numeric[] = "valor_diaria";$nm_numeric[] = "valor_taxa";
      if (in_array($campo_join, $nm_numeric))
      {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['decimal_db'] == ".")
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
      $Nm_datas['checkin'] = 'date';$Nm_datas['checkout'] = 'date';$Nm_datas['validade_passporte'] = 'date';$Nm_datas['data_nascimento'] = 'date';$Nm_datas['data_saida_ida'] = 'date';$Nm_datas['hora_saida_ida'] = 'time';$Nm_datas['data_chegada_ida'] = 'date';$Nm_datas['hora_chegada_ida'] = 'time';$Nm_datas['data_saida_volta'] = 'date';$Nm_datas['hora_saida_volta'] = 'time';$Nm_datas['data_chegada_volta'] = 'date';$Nm_datas['hora_chegada_volta'] = 'time';$Nm_datas['data_nota_gate'] = 'date';$Nm_datas['dt_chegada_proprio'] = 'date';$Nm_datas['hr_chegada_proprio'] = 'time';$Nm_datas['dt_confirm_presenca'] = 'date';
      if (isset($Nm_datas[$nome]))
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
      if (isset($Nm_datas[$campo_join]) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      {
         $nm_aspas  = "#";
         $nm_aspas1 = "#";
      }
      if (isset($Nm_datas[$campo_join]) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_sep_date']))
      {
          $nm_aspas  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_sep_date'];
          $nm_aspas1 = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_sep_date1'];
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
          elseif ($Nm_datas[$campo_join] == "date" && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
          {
              $nome = "to_char (" . $nome . ", 'YYYY-MM-DD')";
          }
          elseif (($Nm_datas[$campo_join] == "datetime" || $Nm_datas[$campo_join] == "timestamp") && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress))
          {
              $nome = "to_char (" . $nome . ", 'YYYY-MM-DD hh24:mi:ss')";
          }
      }
         if (!empty($comando)) {
             if (strtoupper($condicao) == 'NW' || strtoupper($condicao) == 'NP') {
                 $comando .= " and ";
             }
             else {
                 $comando .= " or ";
             }
         }
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
            case "AW";     // Any of the words (arguments) 
            case "NW";     // None of the Words (arguments) 
               $prim  = true;
               $args  = explode(" ", trim($campo));
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
                   $op_all = ($cond_tst == "AW") ? " REGEXP " : " NOT REGEXP ";
                   $comando .= $nm_ini_lower . $nome . $nm_fim_lower . $op_all . $nm_ini_lower . "'" . str_replace(" ","|",$campo) . "'" . $nm_fim_lower;
               }
               elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres)) {
                   $op_all = ($cond_tst == "AW") ? " ~ " : " !~ ";
                   $comando .= $nm_ini_lower . $nome . $nm_fim_lower . $op_all . $nm_ini_lower . "'" . str_replace(" ","|",$campo) . "'" . $nm_fim_lower;
               }
               elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle) || in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2)) {
                   $op_all = ($cond_tst == "AW") ? " REGEXP_LIKE " : " NOT REGEXP_LIKE ";
                   $comando .= $op_all . "(" . $nm_ini_lower . $nome . $nm_fim_lower . ", " . $nm_ini_lower . "'" . str_replace(" ","|",$campo) . "'" . $nm_fim_lower . ")";
               }
               elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_progress)) {
                   $op_all = ($cond_tst == "AW") ? " MATCHES " : " NOT MATCHES ";
                   $comando .= $nm_ini_lower . $nome . $nm_fim_lower . $op_all . $nm_ini_lower . "'" . str_replace(" ","|",$campo) . "'" . $nm_fim_lower;
               }
               elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase)) {
                   $op_all = ($cond_tst == "AW") ? " SIMILAR TO " : " NOT SIMILAR TO ";
                   $comando .= $nm_ini_lower . $nome . $nm_fim_lower . $op_all . $nm_ini_lower . "'%(" . str_replace(" ","|",$campo) . ")%'" . $nm_fim_lower;
               }
               elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_vfp)) {
                   $op_all = ($cond_tst == "AW") ? " $ " : " !$ ";
                   $comando .= $nm_ini_lower . $nome . $nm_fim_lower . $op_all . $nm_ini_lower . "'" . str_replace(" ","|",$campo) . "'" . $nm_fim_lower;
               }
               else {
                   $op_all = ($cond_tst == "AW") ? " LIKE " : " NOT LIKE ";
                   $liga   = ($cond_tst == "AW") ? " OR " : " AND ";
                   $perc   = "%";
                   $prim   = true;
                   $args   = explode(" ", $campo);
                   foreach ($args as $cada_args) {
                       if (!$prim) {
                           $comando .= $liga;
                       }
                       $prim = false;
                       $comando .= $nm_ini_lower . $nome . $nm_fim_lower . $op_all . $nm_ini_lower . "'" . $perc . $cada_args . $perc . "'" . $nm_fim_lower;
                   }
               }
            break;
         }
   }
   function SC_proc_grid_search($Parms)
   {
       $ix     = 0;
       $fields = array();
       $busca  = array();
       $this->Ini->sc_Include($this->Ini->path_lib_php . "/nm_gp_limpa.php", "F", "nm_limpa_valor") ; 
       if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($Parms))
       {
           $Parms = NM_conv_charset($Parms, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
       $tmp    = explode("_FDYN_", $Parms);
       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['tmp_busca'] = array();
       foreach ($tmp as $cada_f)
       {
           $dats = explode("_DYN_", $cada_f);
           if ($dats[1] == "del_grid_search_all")
           {
               foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'] as $ind => $dados)
               {
                   $this->proc_del_grid_search($ind, true);
               }
               unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq']);
               continue;
           }
           if ($dats[1] == "del_grid_search")
           {
               $this->proc_del_grid_search($dats[0], false);
               continue;
           }
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
           if (!isset($busca[$dats[0]]))
           {
               $busca[$dats[0]] = $dats[1];
               if ($dats[0] == "checkin" || $dats[0] == "checkout")
               {
                   $cond = $dats[1];
                   if (substr($cond, 0, 3) == "bi_")
                   {
                       $this->Ini->process_cond_bi($cond, $BI_data1, $BI_data2);
                       $val['ano'] = substr($BI_data1, 4, 4);
                       $val['mes'] = substr($BI_data1, 2, 2);
                       $val['dia'] = substr($BI_data1, 0, 2);
                       if (strlen($BI_data1) > 8)
                       {
                           $val['hor'] = substr($BI_data1, 8, 2);
                           $val['min'] = substr($BI_data1, 10, 2);
                           $val['seg'] = substr($BI_data1, 12, 2);
                       }
                       $val1 = array();
                       if ($cond == "bw")
                       {
                           $val1['ano'] = substr($BI_data2, 4, 4);
                           $val1['mes'] = substr($BI_data2, 2, 2);
                           $val1['dia'] = substr($BI_data2, 0, 2);
                           if (strlen($BI_data2) > 8)
                           {
                               $val1['hor'] = substr($BI_data2, 8, 2);
                               $val1['min'] = substr($BI_data2, 10, 2);
                               $val1['seg'] = substr($BI_data2, 12, 2);
                           }
                       }
                   }
                   else
                   {
                       $val = $this->Ini->dyn_convert_date($fields[$ix]['vls'][0]);
                       $val1 = $this->Ini->dyn_convert_date($fields[$ix]['vls'][1]);
                   }
                   foreach ($val as $tp => $vl)
                   {
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['tmp_busca'][$dats[0] . '_' . $tp] = $vl;
                   }
                   if (!empty($val1))
                   {
                       foreach ($val1 as $tp => $vl)
                       {
                          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['tmp_busca'][$dats[0] . '_input_2_' . $tp] = $vl;
                       }
                   }
               }
               else
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['tmp_busca'][$dats[0]] = (isset($fields[$ix]['vls'][0])) ? $fields[$ix]['vls'][0][0] : "";
                   if (isset($fields[$ix]['vls'][1]))
                   {
                       $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['tmp_busca'][$dats[0] . '_input_2'] = $fields[$ix]['vls'][1][0];
                   }
               }
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['tmp_busca'][$dats[0] . '_cond'] = $dats[1];
           }
           $ix++;
      }
      if ($_SESSION['scriptcase']['charset'] != "UTF-8")
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['tmp_busca'] = NM_conv_charset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['tmp_busca'], "UTF-8", $_SESSION['scriptcase']['charset']);
      }
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['tmp_busca'] as $ind => $dados)
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'][$ind] = $dados;
      }
      if (!$_SESSION['scriptcase']['proc_mobile']) 
      { 
          require_once($this->Ini->path_aplicacao . "grid_geral_rsvp_r_pesq.class.php"); 
      } 
      else 
      { 
          require_once($this->Ini->path_aplicacao . "grid_geral_rsvp_r_mobile_pesq.class.php"); 
      } 
      $this->pesq  = new grid_geral_rsvp_r_pesq();
      $this->prep_modulos("pesq");
      $this->pesq->NM_ajax_flag  = true;
      $this->pesq->NM_ajax_opcao = "ajax_grid_search";
      $this->pesq->monta_busca();
   }
   function proc_del_grid_search($cmp_del, $del_all)
   {
      if (in_array($cmp_del, array('checkin', 'checkout')))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'][$cmp_del . "_dia"] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'][$cmp_del . "_mes"] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'][$cmp_del . "_ano"] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'][$cmp_del . "_input_2_dia"] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'][$cmp_del . "_input_2_mes"] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'][$cmp_del . "_input_2_ano"] = "";
      }
      elseif (is_array($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'][$cmp_del]))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'][$cmp_del] = array();
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'][$cmp_del . "_input_2"] = array();
      }
      else
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'][$cmp_del] = "";
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'][$cmp_del . "_input_2"] = "";
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'][$cmp_del . "_cond"] = "";
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['grid_pesq'][$cmp_del]);
   }
   function SC_proc_interativ_search($Parms)
   {
       $Parms = str_replace("__NM_PLUS__", "+", $Parms);
       $Parms = str_replace("__NM_AMP__", "&", $Parms);
       $Parms = str_replace("__NM_PRC__", "%", $Parms);
       $cmps_numeric = array();
       $cmps_numeric[] = "regional";
       $range_bw = array();
       if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($Parms))
       {
           $Parms = NM_conv_charset($Parms, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
       $tmp     = explode("__DL__", $Parms);
       $cmd_sql = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['int_search_sql'][$tmp[0]];
       $vls     = "";
       $bol_numeric = false;
       if ($tmp[3] == "clear_interativ_all") {
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['interativ_search'] = array();
       }
       else {
           unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['interativ_search'][$tmp[0]]);
           if ($tmp[3] != "clear_interativ")
           {
               $vls  = explode("_VLS_", $tmp[3]);
               if($tmp[2] == "nn" || $tmp[2] == "bw")
               {
                   $bol_numeric = true;
                   $delim  = "";
                   $delim1 = "";
               }
               else
               {
                   $delim  = "'";
                   $delim1 = "'";
               }
               if ($tmp[2] == "dt" || $tmp[2] == "dh" || $tmp[2] == "hh")
               {
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
                   {
                       $delim  = "#";
                       $delim1 = "#";
                   }
                   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_sep_date']))
                   {
                       $delim  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_sep_date'];
                       $delim1 = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_sep_date1'];
                   }
               }
           }
       }
       if (!empty($vls))
       {
           $prep = "";
           $bol_has_empty = false;
           $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['interativ_search'][$tmp[0]]['tp_obj'] = $tmp[2];
           foreach ($vls as $cada_val)
           {
               $cada_val = NM_charset_decode($cada_val);
               $descr = $cada_val;
               if (is_string($cada_val)) {
                   $tmp_pos = strpos($cada_val, "##@@");
                   if ($tmp_pos !== false) {
                       $descr    = substr($cada_val, $tmp_pos + 4);
                       $cada_val = substr($cada_val, 0, $tmp_pos);
                   }
               }
               $cada_val = substr($this->Db->qstr($cada_val), 1, -1);
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['interativ_search'][$tmp[0]]['lab'][$tmp[1]][] = $descr;
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['interativ_search'][$tmp[0]]['val_sel'][] = $cada_val;
               if ($cada_val == "")
               {
                   $bol_has_empty = true;
               }
               if (in_array($tmp[0], $cmps_numeric))
               {
                  if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['decimal_db'] == ".")
                  {
                      $cada_val  = str_replace(",", ".", $cada_val);
                  }
                  else
                  {
                      $delim  = "'";
                      $delim1 = "'";
                      $cada_val  = str_replace(".", ",", $cada_val);
                  }
                   $prep .= ($prep != "") ? "," : "";
                   $prep .= $delim . $cada_val . $delim1;
               }
               else
               {
                   $prep .= ($prep != "") ? "," : "";
                   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access) && $cada_val == "")
                   {
                       $prep .= 'null';
                   }
                   else
                   $prep .= $delim . $cada_val . $delim1;
               }
               $range_bw[] = $cada_val;
           }
               $str_add_null    = '';
               $str_add_null_or = '';
               if($bol_has_empty)
               {
                   $str_add_null    = ' ' . $cmd_sql . ' is null ';
                   $str_add_null_or = ' OR ' . $cmd_sql . ' is null ';
               }
           if ($prep == "" && $bol_numeric)
           {
               if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['interativ_search'][$tmp[0]]['val'] = $cmd_sql . " is null";
               }
               else
               {
                   $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['interativ_search'][$tmp[0]]['val'] = $cmd_sql . " = '' or " . $cmd_sql . " is null";
               }
           }
           elseif ($prep == "" && $delim != "")
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['interativ_search'][$tmp[0]]['val'] = $cmd_sql . " = '' or " . $cmd_sql . " is null";
           }
           elseif ( $tmp[2] == "bw")
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['interativ_search'][$tmp[0]]['val'] = $cmd_sql . " between " . $delim . $range_bw[0] .  $delim1 . " and " . $delim . $range_bw[1] .  $delim1 . $str_add_null_or;
           }
           else
           {
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['interativ_search'][$tmp[0]]['val'] = $cmd_sql . " IN (" . $prep . ")" . $str_add_null_or;
           }
       }
      $tmp_cmd = "";
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_orig'])) 
      {
          $tmp_cmd = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_orig']; 
      }
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_filtro'])) 
      {
          if (!empty($tmp_cmd)) 
          {
              $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_filtro'] . ")"; 
          }
          else
          {
              $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_filtro'] . ")"; 
          }
      }
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_fast'])) 
      {
          if (!empty($tmp_cmd)) 
          {
              $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_fast'] . ")";
          }
          else 
          {
              $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_fast'] . ")";
          }
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_interativ'] = "";
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_sem_interativ']  = $tmp_cmd;
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['interativ_search'])) 
      {
          $prim = true;
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['interativ_search'] as $cmp => $val) 
          {
              if (!$prim)
              {
                 $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_interativ'] .= " AND ";
              }
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_interativ'] .= "(" . $val['val'] . ")";
              $prim = false;
          }
      }
      if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_interativ'])) 
      {
          if (!empty($tmp_cmd)) 
          {
              $tmp_cmd .= " and (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_interativ'] . ")"; 
          }
          else
          {
              $tmp_cmd = " where (" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_interativ'] . ")"; 
          }
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq'] = $tmp_cmd;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['refresh_interativ'] = (isset($tmp[5])) ? $tmp[5] : "S";
      if(isset($tmp[4]) && $tmp[4] == 'N')
      {
          $this->Arr_result['interativ_search'] = array();
          $oJson = new Services_JSON();
          echo $oJson->encode( $this->Arr_result );
          exit;
      }
   }
  function html_doc_word($nm_arquivo_doc_word, $nmgp_password)
  {
      global $nm_url_saida;
      $Word_password = "";
      if ($this->Ini->Export_zip || $Word_password != "")
      { 
          $Parm_pass  = ($Word_password != "") ? " -p" : "";
          $Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['word_file'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['word_file'], ".");
          if ($Pos !== false) {
              $Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['word_file'], 0, $Pos);
          }
          $Arq_zip .= ".zip";
          $Arq_doc = $nm_arquivo_doc_word;
          $Pos = strrpos($nm_arquivo_doc_word, ".");
          if ($Pos !== false) {
              $Arq_doc = substr($nm_arquivo_doc_word, 0, $Pos);
          }
          $Arq_doc  .= ".zip";
          $Zip_f     = (FALSE !== strpos($Arq_zip, ' ')) ? " \"" . $Arq_zip . "\"" :  $Arq_zip;
          $Arq_input = (FALSE !== strpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['word_file'], ' ')) ? " \"" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['word_file'] . "\"" :  $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['word_file'];
           if (is_file($Arq_zip)) {
               unlink($Arq_zip);
           }
           $str_zip = "";
           if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
           {
               chdir($this->Ini->path_third . "/zip/windows");
               $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $Word_password . " " . $Zip_f . " " . $Arq_input;
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
               $str_zip = "./7za " . $Parm_pass . $Word_password . " a " . $Zip_f . " " . $Arq_input;
           }
           elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
           {
               chdir($this->Ini->path_third . "/zip/mac/bin");
               $str_zip = "./7za " . $Parm_pass . $Word_password . " a " . $Zip_f . " " . $Arq_input;
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
                  $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $Word_password . " " . $Zip_f . " " . $cada_img_zip;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
              {
                  $str_zip = "./7za " . $Parm_pass . $Word_password . " a " . $Zip_f . " " . $cada_img_zip;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
              {
                  $str_zip = "./7za " . $Parm_pass . $Word_password . " a " . $Zip_f . " " . $cada_img_zip;
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
               unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['word_file']);
               $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['word_file'] = $Arq_zip;
               $nm_arquivo_doc_word = $Arq_doc;
          } 
      } 
      if ($this->Ini->sc_export_ajax)
      {
          $this->Arr_result['file_export']  = NM_charset_to_utf8($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['word_file']);
          $this->Arr_result['title_export'] = NM_charset_to_utf8($nm_arquivo_doc_word);
          $Temp = ob_get_clean();
          if ($Temp !== false && trim($Temp) != "")
          {
              $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($this->Arr_result);
          exit;
      }
      if (strpos(" " . $this->Ini->SC_module_export, "grid") !== false || strpos(" " . $this->Ini->SC_module_export, "resume") !== false)
      {
          $path_doc_md5 = md5($this->Ini->path_imag_temp . $nm_arquivo_doc_word);
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r'][$path_doc_md5][0] = $this->Ini->path_imag_temp . $nm_arquivo_doc_word;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r'][$path_doc_md5][1] = substr($nm_arquivo_doc_word, 1);
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $Mens_bar = $this->Ini->Nm_lang['lang_othr_file_msge'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
              $Mens_bar = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
          }
          $this->pb->setProgressbarMessage($Mens_bar);
          $this->pb->setDownloadLink($this->Ini->path_imag_temp . $nm_arquivo_doc_word);
          $this->pb->setDownloadMd5($path_doc_md5);
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($this->ret_word);
          $this->pb->completed();
          return;
      }
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_title'] ?> geral_rsvp_r :: Doc</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Pragma" content="no-cache"/>
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
   <link rel="stylesheet" type="text/css" href="../_lib/lib/css/nm_export_mobile.css" /> 
<?php
}
$path_doc_md5 = md5($this->Ini->path_imag_temp . $nm_arquivo_doc_word);
$_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r'][$path_doc_md5][0] = $this->Ini->path_imag_temp . $nm_arquivo_doc_word;
$_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r'][$path_doc_md5][1] = substr($nm_arquivo_doc_word, 1);
?>
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/font-awesome/6/css/all.min.css" type="text/css" media="screen,print" />
 <?php
 if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts))
 {
 ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->str_google_fonts ?>" />
 <?php
 }
 ?>
  <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_css ?>" /> 
</HEAD>
<BODY class="scExportPage">
<?php echo $this->Ini->Ajax_result_set ?>
<table style="border-collapse: collapse; border-width: 0; height: 100%; width: 100%"><tr><td style="padding: 0; text-align: center; vertical-align: middle">
 <table class="scExportTable" align="center">
  <tr>
   <td class="scExportTitle" style="height: 25px">WORD</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
     <?php echo nmButtonOutput($this->arr_buttons, "bexportview", "document.Fview.submit()", "document.Fview.submit()", "idBtnView", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bdownload", "document.Fdown.submit()", "document.Fdown.submit()", "idBtnDown", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "idBtnBack", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
    </td></tr></table>
   </td>
  </tr>
 </table>
</td></tr></table>
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . $nm_arquivo_doc_word ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="grid_geral_rsvp_r_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_geral_rsvp_r"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($this->ret_word) ?>"> 
<INPUT type="hidden" name="nm_grid_submit" value="1"/> 
<INPUT type="hidden" name="csrf_token" value="<?php echo $this->Ini->scCsrfGetToken() ?>"/> 
</FORM> 
</BODY>
</HTML>
<?php
  }
  function html_export_print($nm_arquivo_html, $nmgp_password)
  {
      global $nm_url_saida;
      $Html_password = "";
          $Arq_base  = $this->Ini->root . $this->Ini->path_imag_temp . $nm_arquivo_html;
          $Parm_pass = ($Html_password != "") ? " -p" : "";
          $Arq_zip   = $Arq_base;
          $Pos = strrpos($Arq_base, ".");
          if ($Pos !== false) {
              $Arq_zip = substr($Arq_base, 0, $Pos);
          }
          $Arq_zip .= ".zip";
          $Arq_htm  = $nm_arquivo_html;
          $Pos = strrpos($nm_arquivo_html, ".");
          if ($Pos !== false) {
              $Arq_htm = substr($nm_arquivo_html, 0, $Pos);
          }
          $Arq_htm  .= ".zip";
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
           $this->Ini->Img_export_zip[] = $this->Ini->root . $this->Ini->path_imag_cab . "/" . $this->Ini->Label_sort;
           $this->Ini->Img_export_zip[] = $this->Ini->root . $this->Ini->path_imag_cab . "/" . $this->Ini->Label_sort_desc;
           $this->Ini->Img_export_zip[] = $this->Ini->root . $this->Ini->path_imag_cab . "/" . $this->Ini->Label_sort_asc;
           $this->Ini->Img_export_zip[] = $this->Ini->root . $this->Ini->path_imag_cab . "/" . $this->Ini->Label_summary_sort_desc;
           $this->Ini->Img_export_zip[] = $this->Ini->root . $this->Ini->path_imag_cab . "/" . $this->Ini->Label_summary_sort_asc;
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
               $nm_arquivo_html = $Arq_htm;
           } 
          $path_doc_md5 = md5($this->Ini->path_imag_temp . $nm_arquivo_html);
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r'][$path_doc_md5][0] = $this->Ini->path_imag_temp . $nm_arquivo_html;
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r'][$path_doc_md5][1] = substr($nm_arquivo_html, 1);
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $Mens_bar = $this->Ini->Nm_lang['lang_othr_file_msge'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
              $Mens_bar = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
          }
          $this->pb->setProgressbarMessage($Mens_bar);
          $this->pb->setDownloadLink($this->Ini->path_imag_temp . $nm_arquivo_html);
          $this->pb->setDownloadMd5($path_doc_md5);
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($this->ret_print);
          $this->pb->completed();
          return;
  }
} 
// 
//======= =========================
   if (isset($_SESSION['scriptcase']['grid_geral_rsvp_r']['sc_process_barr'])) {
       return;
   }
   if (!function_exists("NM_is_utf8"))
   {
       include_once("../_lib/lib/php/nm_utf8.php");
   }
   if (!function_exists("SC_dir_app_ini"))
   {
       include_once("../_lib/lib/php/nm_ctrl_app_name.php");
   }
   SC_dir_app_ini('NRSVP115_10_AWS_APP');
   $_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'off';
   $sc_conv_var = array();
   $Sc_lig_md5 = false;
   $Sem_Session = (!isset($_SESSION['sc_session'])) ? true : false;
   $_SESSION['scriptcase']['sem_session'] = false;
   if (!empty($_POST))
   {
       if (isset($_POST['parm']))
       {
           $_POST['parm'] = str_replace("__NM_PLUS__", "+", $_POST['parm']);
           $_POST['parm'] = str_replace("__NM_AMP__", "&", $_POST['parm']);
           $_POST['parm'] = str_replace("__NM_PRC__", "%", $_POST['parm']);
       }
       foreach ($_POST as $nmgp_var => $nmgp_val)
       {
            $nmgp_val = str_replace("__NM_PLUS__", "+", $nmgp_val);
            $nmgp_val = str_replace("__NM_AMP__", "&", $nmgp_val);
            $nmgp_val = str_replace("__NM_PRC__", "%", $nmgp_val);
            if (substr($nmgp_var, 0, 11) == "SC_glo_par_")
            {
                $nmgp_var = substr($nmgp_var, 11);
                $nmgp_val = $_SESSION[$nmgp_val];
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
             if ($nmgp_var == "nmgp_parms_where" && substr($nmgp_val, 0, 8) == "@SC_par@")
             {
                 $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
                 if (count($SC_Ind_Val) == 4 && isset($_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['LigR_Md5'][$SC_Ind_Val[3]]))
                 {
                     $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['LigR_Md5'][$SC_Ind_Val[3]];
                 }
                 else
                 {
                     $_SESSION['sc_session']['SC_parm_violation'] = true;
                 }
             }
            if (isset($sc_conv_var[$nmgp_var]))
            {
                $nmgp_var = $sc_conv_var[$nmgp_var];
            }
            elseif (isset($sc_conv_var[strtolower($nmgp_var)]))
            {
                $nmgp_var = $sc_conv_var[strtolower($nmgp_var)];
            }
            nm_limpa_str_grid_geral_rsvp_r($nmgp_val);
            $nmgp_val = NM_decode_input($nmgp_val);
            nm_protect_num_grid_geral_rsvp_r($nmgp_var, $nmgp_val);
            $$nmgp_var = $nmgp_val;
       }
   }
   if (!empty($_GET))
   {
       if (isset($_GET['parm']))
       {
           $_GET['parm'] = str_replace("__NM_PLUS__", "+", $_GET['parm']);
           $_GET['parm'] = str_replace("__NM_AMP__", "&", $_GET['parm']);
           $_GET['parm'] = str_replace("__NM_PRC__", "%", $_GET['parm']);
       }
       foreach ($_GET as $nmgp_var => $nmgp_val)
       {
            $nmgp_val = str_replace("__NM_PLUS__", "+", $nmgp_val);
            $nmgp_val = str_replace("__NM_AMP__", "&", $nmgp_val);
            $nmgp_val = str_replace("__NM_PRC__", "%", $nmgp_val);
            if (substr($nmgp_var, 0, 11) == "SC_glo_par_")
            {
                $nmgp_var = substr($nmgp_var, 11);
                $nmgp_val = $_SESSION[$nmgp_val];
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
             if ($nmgp_var == "nmgp_parms_where" && substr($nmgp_val, 0, 8) == "@SC_par@")
             {
                 $SC_Ind_Val = explode("@SC_par@", $nmgp_val);
                 if (count($SC_Ind_Val) == 4 && isset($_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['LigR_Md5'][$SC_Ind_Val[3]]))
                 {
                     $nmgp_val = $_SESSION['sc_session'][$SC_Ind_Val[1]][$SC_Ind_Val[2]]['LigR_Md5'][$SC_Ind_Val[3]];
                 }
                 else
                 {
                     $_SESSION['sc_session']['SC_parm_violation'] = true;
                 }
             }
            if (isset($sc_conv_var[$nmgp_var]))
            {
                $nmgp_var = $sc_conv_var[$nmgp_var];
            }
            elseif (isset($sc_conv_var[strtolower($nmgp_var)]))
            {
                $nmgp_var = $sc_conv_var[strtolower($nmgp_var)];
            }
            nm_limpa_str_grid_geral_rsvp_r($nmgp_val);
            $nmgp_val = NM_decode_input($nmgp_val);
            nm_protect_num_grid_geral_rsvp_r($nmgp_var, $nmgp_val);
            $$nmgp_var = $nmgp_val;
       }
   }
   if (!isset($_SERVER['HTTP_REFERER']) && !isset($nmgp_parms) && !isset($script_case_init) && !isset($nmgp_start))
   {
       $_SESSION['sc_session']['SC_parm_violation'] = true;
   }
   $NM_dir_atual = getcwd();
   if (empty($NM_dir_atual)) {
       $str_path_sys  = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
       $str_path_sys  = str_replace("\\", '/', $str_path_sys);
   }
   else {
       $sc_nm_arquivo = explode("/", $_SERVER['PHP_SELF']);
       $str_path_sys  = str_replace("\\", "/", getcwd()) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
   }
   $str_path_web    = $_SERVER['PHP_SELF'];
   $str_path_web    = str_replace("\\", '/', $str_path_web);
   $str_path_web    = str_replace('//', '/', $str_path_web);
   $path_aplicacao  = substr($str_path_web, 0, strrpos($str_path_web, '/'));
   $path_aplicacao  = substr($path_aplicacao, 0, strrpos($path_aplicacao, '/'));
   $root            = substr($str_path_sys, 0, -1 * strlen($str_path_web));
   if ($Sem_Session && (!isset($nmgp_start) || $nmgp_start != "SC")) {
       if (isset($_COOKIE['sc_apl_default_NRSVP115_10_AWS_APP'])) {
           $apl_def = explode(",", $_COOKIE['sc_apl_default_NRSVP115_10_AWS_APP']);
       }
       elseif (is_file($root . $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_imag_temp'] . "/sc_apl_default_NRSVP115_10_AWS_APP.txt")) {
           $apl_def = explode(",", file_get_contents($root . $_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_imag_temp'] . "/sc_apl_default_NRSVP115_10_AWS_APP.txt"));
       }
       if (isset($apl_def)) {
           if ($apl_def[0] != "grid_geral_rsvp_r") {
               $_SESSION['scriptcase']['sem_session'] = true;
               if (strtolower(substr($apl_def[0], 0 , 7)) == "http://" || strtolower(substr($apl_def[0], 0 , 8)) == "https://" || substr($apl_def[0], 0 , 2) == "..") {
                   $_SESSION['scriptcase']['grid_geral_rsvp_r']['session_timeout']['redir'] = $apl_def[0];
               }
               else {
                   $_SESSION['scriptcase']['grid_geral_rsvp_r']['session_timeout']['redir'] = $path_aplicacao . "/" . SC_dir_app_name($apl_def[0]) . "/index.php";
               }
               $Redir_tp = (isset($apl_def[1])) ? trim(strtoupper($apl_def[1])) : "";
               $_SESSION['scriptcase']['grid_geral_rsvp_r']['session_timeout']['redir_tp'] = $Redir_tp;
           }
           if (isset($_COOKIE['sc_actual_lang_NRSVP115_10_AWS_APP'])) {
               $_SESSION['scriptcase']['grid_geral_rsvp_r']['session_timeout']['lang'] = $_COOKIE['sc_actual_lang_NRSVP115_10_AWS_APP'];
           }
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
   if (isset($vg_evento_id)) 
   {
       $_SESSION['vg_evento_id'] = $vg_evento_id;
   }
   if (isset($vg_usuario_id)) 
   {
       $_SESSION['vg_usuario_id'] = $vg_usuario_id;
   }
   if (isset($rsvp_global)) 
   {
       $_SESSION['rsvp_global'] = $rsvp_global;
   }
   if (isset($vg_menu_item)) 
   {
       $_SESSION['vg_menu_item'] = $vg_menu_item;
   }
   if (isset($parm1)) 
   {
       $_SESSION['parm1'] = $parm1;
   }
   if (isset($vg_cpfseg)) 
   {
       $_SESSION['vg_cpfseg'] = $vg_cpfseg;
   }
   if (isset($parm2)) 
   {
       $_SESSION['parm2'] = $parm2;
   }
   if (!empty($glo_perfil))  
   { 
      $_SESSION['scriptcase']['glo_perfil'] = $glo_perfil;
   }   
   if (isset($glo_servidor)) 
   {
       $_SESSION['scriptcase']['glo_servidor'] = $glo_servidor;
   }
   if (isset($glo_banco)) 
   {
       $_SESSION['scriptcase']['glo_banco'] = $glo_banco;
   }
   if (isset($glo_tpbanco)) 
   {
       $_SESSION['scriptcase']['glo_tpbanco'] = $glo_tpbanco;
   }
   if (isset($glo_usuario)) 
   {
       $_SESSION['scriptcase']['glo_usuario'] = $glo_usuario;
   }
   if (isset($glo_senha)) 
   {
       $_SESSION['scriptcase']['glo_senha'] = $glo_senha;
   }
   if (isset($glo_senha_protect)) 
   {
       $_SESSION['scriptcase']['glo_senha_protect'] = $glo_senha_protect;
   }
   if (isset($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida_pai']))
   {
       $apl_pai = $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida_pai'];
       if (isset($_SESSION['sc_session'][$script_case_init][$apl_pai]['embutida_filho']))
       {
           foreach ($_SESSION['sc_session'][$script_case_init][$apl_pai]['embutida_filho'] as $init_filho)
           {
               if (isset($_SESSION['sc_session'][$init_filho]['grid_geral_rsvp_r']['master_pai']) && $_SESSION['sc_session'][$init_filho]['grid_geral_rsvp_r']['master_pai'] == $script_case_init)
               {
                   $script_case_init = $init_filho;
                   break;
               }
           }
       }
   }
   $nm_embutida_form = false;
   if (isset($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida_form']) && $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida_form'] && !isset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['master_pai']))
   {
       $SC_init_ant = $script_case_init;
       $script_case_init = rand(2, 10000);
       if (isset($_SESSION['sc_session'][$SC_init_ant]['grid_geral_rsvp_r']['embutida_pai']))
       {
           $_SESSION['sc_session'][$SC_init_ant][$_SESSION['sc_session'][$SC_init_ant]['grid_geral_rsvp_r']['embutida_pai']]['embutida_filho'][] = $script_case_init;
       }
       $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['master_pai'] = $SC_init_ant;
   }
   if (isset($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['master_pai']))
   {
       $SC_init_ant = $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['master_pai'];
       if (!isset($_SESSION['sc_session'][$SC_init_ant]['grid_geral_rsvp_r']['embutida_form_parms']))
       {
           $_SESSION['sc_session'][$SC_init_ant]['grid_geral_rsvp_r']['embutida_form_parms'] = "";
       }
       $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida_form_parms'] = $_SESSION['sc_session'][$SC_init_ant]['grid_geral_rsvp_r']['embutida_form_parms'];
       $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida_form'] = true;
       $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida_form_full'] = (isset($_SESSION['sc_session'][$SC_init_ant]['grid_geral_rsvp_r']['embutida_form_full'])) ? $_SESSION['sc_session'][$SC_init_ant]['grid_geral_rsvp_r']['embutida_form_full'] : false;
       $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['reg_start'] = "";
       $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['opcao'] = "inicio";
       unset($_SESSION['sc_session'][$SC_init_ant]['grid_geral_rsvp_r']['embutida_form']);
       unset($_SESSION['sc_session'][$SC_init_ant]['grid_geral_rsvp_r']['embutida_form_parms']);
       $nm_apl_dependente = 1;
       $nm_embutida_form  = true;
   }
   if (isset($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida_form_parms'])) 
   {
       if (!empty($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida_form_parms'])) 
       {
           $nmgp_parms = $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida_form_parms'];
           $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida_form_parms'] = "";
       }
   }
   elseif (isset($script_case_init))
   {
       unset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida_form']);
       unset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida_form_full']);
       unset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida_form_parms']);
   }
   if (!isset($nmgp_opcao) || !isset($script_case_init) || ((!isset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida']) || !$_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida']) && $nmgp_opcao != "formphp"))
   { 
       if (!empty($nmgp_parms)) 
       { 
           $nmgp_parms = NM_decode_input($nmgp_parms);
           $nmgp_parms = str_replace("@aspass@", "'", $nmgp_parms);
           $nmgp_parms = str_replace("*scout", "?@?", $nmgp_parms);
           $nmgp_parms = str_replace("*scin", "?#?", $nmgp_parms);
           $todox = str_replace("?#?@?@?", "?#?@ ?@?", $nmgp_parms);
           $todo  = explode("?@?", $todox);
           foreach ($todo as $param)
           {
                $cadapar = explode("?#?", $param);
                if (1 < sizeof($cadapar))
                {
                    if (substr($cadapar[0], 0, 11) == "SC_glo_par_")
                    {
                        $cadapar[0] = substr($cadapar[0], 11);
                        $cadapar[1] = $_SESSION[$cadapar[1]];
                    }
                    if (isset($sc_conv_var[$cadapar[0]]))
                    {
                        $cadapar[0] = $sc_conv_var[$cadapar[0]];
                    }
                    elseif (isset($sc_conv_var[strtolower($cadapar[0])]))
                    {
                        $cadapar[0] = $sc_conv_var[strtolower($cadapar[0])];
                    }
                    nm_limpa_str_grid_geral_rsvp_r($cadapar[1]);
                    nm_protect_num_grid_geral_rsvp_r($cadapar[0], $cadapar[1]);
                    if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                    $Tmp_par   = $cadapar[0];
                    $$Tmp_par = $cadapar[1];
                }
           }
           if (isset($vg_evento_id)) 
           {
               $_SESSION['vg_evento_id'] = $vg_evento_id;
               nm_limpa_str_grid_geral_rsvp_r($_SESSION["vg_evento_id"]);
           }
           if (isset($vg_usuario_id)) 
           {
               $_SESSION['vg_usuario_id'] = $vg_usuario_id;
               nm_limpa_str_grid_geral_rsvp_r($_SESSION["vg_usuario_id"]);
           }
           if (isset($rsvp_global)) 
           {
               $_SESSION['rsvp_global'] = $rsvp_global;
               nm_limpa_str_grid_geral_rsvp_r($_SESSION["rsvp_global"]);
           }
           if (isset($vg_menu_item)) 
           {
               $_SESSION['vg_menu_item'] = $vg_menu_item;
               nm_limpa_str_grid_geral_rsvp_r($_SESSION["vg_menu_item"]);
           }
           if (isset($parm1)) 
           {
               $_SESSION['parm1'] = $parm1;
               nm_limpa_str_grid_geral_rsvp_r($_SESSION["parm1"]);
           }
           if (isset($vg_cpfseg)) 
           {
               $_SESSION['vg_cpfseg'] = $vg_cpfseg;
               nm_limpa_str_grid_geral_rsvp_r($_SESSION["vg_cpfseg"]);
           }
           if (isset($parm2)) 
           {
               $_SESSION['parm2'] = $parm2;
               nm_limpa_str_grid_geral_rsvp_r($_SESSION["parm2"]);
           }
           $NMSC_conf_apl = array();
           if (isset($NMSC_inicial))
           {
               $NMSC_conf_apl['inicial'] = $NMSC_inicial;
           }
           if (isset($NMSC_rows))
           {
               $NMSC_conf_apl['rows'] = $NMSC_rows;
           }
           if (isset($NMSC_cols))
           {
               $NMSC_conf_apl['cols'] = $NMSC_cols;
           }
           if (isset($NMSC_paginacao))
           {
               $NMSC_conf_apl['paginacao'] = $NMSC_paginacao;
           }
           if (isset($NMSC_cab))
           {
               $NMSC_conf_apl['cab'] = $NMSC_cab;
           }
           if (isset($NMSC_nav))
           {
               $NMSC_conf_apl['nav'] = $NMSC_nav;
           }
           if (isset($NMSC_fix_bar_top))
           {
               $NMSC_conf_apl['fix_top'] = $NMSC_fix_bar_top;
           }
           if (isset($NMSC_fix_bar_bot))
           {
               $NMSC_conf_apl['fix_bot'] = $NMSC_fix_bar_bot;
           }
           if (isset($NM_run_iframe) && $NM_run_iframe == 1) 
           { 
               unset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']);
               $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['b_sair'] = false;
           }   
       } 
   } 
   if (!isset($nmgp_opcao)) {
      $nmgp_opcao = "";
   }
   $ini_embutida = "";
   if (isset($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida']) && $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida'])
   {
       $nmgp_outra_jan = "";
   }
   if (isset($nmgp_outra_jan) && $nmgp_outra_jan == 'true')
   {
       $script_case_init = "";
   }
   if (isset($GLOBALS["script_case_init"]) && !empty($GLOBALS["script_case_init"]))
   {
       $ini_embutida = $GLOBALS["script_case_init"];
        if (!isset($_SESSION['sc_session'][$ini_embutida]['grid_geral_rsvp_r']['embutida']))
        { 
           $_SESSION['sc_session'][$ini_embutida]['grid_geral_rsvp_r']['embutida'] = false;
        }
        if (!$_SESSION['sc_session'][$ini_embutida]['grid_geral_rsvp_r']['embutida'])
        { 
           $script_case_init = $ini_embutida;
        }
   }
   if (isset($_SESSION['scriptcase']['grid_geral_rsvp_r']['protect_modal']) && !empty($_SESSION['scriptcase']['grid_geral_rsvp_r']['protect_modal']))
   {
       $script_case_init = $_SESSION['scriptcase']['grid_geral_rsvp_r']['protect_modal'];
   }
   if (!isset($script_case_init) || empty($script_case_init))
   {
       $script_case_init = rand(2, 10000);
   }
   $salva_emb    = false;
   $salva_iframe = false;

   if (isset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['iframe_menu']))
   {
       $salva_iframe = $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['iframe_menu'];
       unset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['iframe_menu']);
   }
   if (isset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida']))
   {
       $salva_emb = $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida'];
       unset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida']);
   }
   if (isset($nm_run_menu) && $nm_run_menu == 1 && !$salva_emb)
   {
        if (isset($_SESSION['scriptcase']['sc_aba_iframe']) && isset($_SESSION['scriptcase']['sc_apl_menu_atual']))
        {
            foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
            {
                if ($aba == $_SESSION['scriptcase']['sc_apl_menu_atual'])
                {
                    unset($_SESSION['scriptcase']['sc_aba_iframe'][$aba]);
                    break;
                }
            }
        }
        $_SESSION['scriptcase']['sc_apl_menu_atual'] = "grid_geral_rsvp_r";
        $achou = false;
        if (isset($_SESSION['sc_session'][$script_case_init]))
        {
            foreach ($_SESSION['sc_session'][$script_case_init] as $nome_apl => $resto)
            {
                if ($nome_apl == 'grid_geral_rsvp_r' || $achou)
                {
                    unset($_SESSION['sc_session'][$script_case_init][$nome_apl]);
                }
            }
            if (!$achou && isset($nm_apl_menu))
            {
                foreach ($_SESSION['sc_session'][$script_case_init] as $nome_apl => $resto)
                {
                    if ($nome_apl == $nm_apl_menu || $achou)
                    {
                        $achou = true;
                        if ($nome_apl != $nm_apl_menu)
                        {
                            unset($_SESSION['sc_session'][$script_case_init][$nome_apl]);
                        }
                    }
                }
            }
        }
        $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['iframe_menu'] = true;
   }
   else
   {
       $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['iframe_menu'] = $salva_iframe;
   }
   $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['doc_word'] = false;
   $_SESSION['scriptcase']['saida_word'] = false;
   if (!isset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['skip_charts']))
   {
       $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['skip_charts'] = false;
   }
   if (isset($_REQUEST['sc_create_charts']))
   {
       $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['skip_charts'] = 'N' == $_REQUEST['sc_create_charts'];
   }
   $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida'] = $salva_emb;

   if (!isset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['initialize']))
   {
       $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['initialize'] = true;
   }
   elseif (!isset($_SERVER['HTTP_REFERER']))
   {
       $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['initialize'] = false;
   }
   elseif (false === strpos($_SERVER['HTTP_REFERER'], '/grid_geral_rsvp_r/'))
   {
       $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['initialize'] = true;
   }
   else
   {
       $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['initialize'] = false;
   }
   if ($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['initialize'])
   {
       unset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['tot_geral']);
       $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['contr_total_geral'] = "NAO";
   }

   $_POST['script_case_init'] = $script_case_init;
   if (!isset($nmgp_opcao) || empty($nmgp_opcao) || $nmgp_opcao == "grid" && (!isset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['b_sair'])))
   {
       $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['b_sair'] = true;
   }
   if (isset($_SESSION['scriptcase']['sc_outra_jan']) && $_SESSION['scriptcase']['sc_outra_jan'] == 'grid_geral_rsvp_r')
   {
       $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['sc_outra_jan'] = true;
        unset($_SESSION['scriptcase']['sc_outra_jan']);
   }
   $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['menu_desenv'] = false;   
   if (!defined("SC_ERROR_HANDLER"))
   {
       define("SC_ERROR_HANDLER", 1);
       include_once(dirname(__FILE__) . "/grid_geral_rsvp_r_erro.php");
   }
   $salva_tp_saida  = (isset($_SESSION['scriptcase']['sc_tp_saida']))  ? $_SESSION['scriptcase']['sc_tp_saida'] : "";
   $salva_url_saida  = (isset($_SESSION['scriptcase']['sc_url_saida'][$script_case_init])) ? $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] : "";
   if (isset($_SESSION['sc_session']['scriptcase']['embutida_form_pdf']['grid_geral_rsvp_r']))
   { 
       return;
   } 
   if (!$_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida'] && $nmgp_opcao != "formphp")
   { 
       if ($nmgp_opcao == "change_lang" || $nmgp_opcao == "change_lang_res" || $nmgp_opcao == "change_lang_fil" || $nmgp_opcao == "force_lang")  
       { 
           if ($nmgp_opcao == "change_lang_fil")  
           { 
               $nmgp_opcao  = "busca";  
           } 
           elseif ($nmgp_opcao == "change_lang_res")  
           { 
               $nmgp_opcao  = "resumo";  
           } 
           else 
           { 
               $nmgp_opcao  = "igual";  
           } 
           $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['sc_change_lang'] = true;
           unset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['tot_geral']);
           $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['contr_total_geral'] = "NAO";
           $Temp_lang = explode(";" , $nmgp_idioma);  
           if (isset($Temp_lang[0]) && !empty($Temp_lang[0]))  
           { 
               $_SESSION['scriptcase']['str_lang'] = $Temp_lang[0];
           } 
           if (isset($Temp_lang[1]) && !empty($Temp_lang[1])) 
           { 
               $_SESSION['scriptcase']['str_conf_reg'] = $Temp_lang[1];
           } 
       } 
       if ($nmgp_opcao == "change_schema" || $nmgp_opcao == "change_schema_fil" || $nmgp_opcao == "change_schema_res")  
       { 
           if ($nmgp_opcao == "change_schema_fil")  
           { 
               $nmgp_opcao  = "busca";  
           } 
           elseif ($nmgp_opcao == "change_schema_res")  
           { 
               $nmgp_opcao  = "resumo";  
           } 
           else 
           { 
               $nmgp_opcao  = "igual";  
           } 
           $nmgp_schema = $nmgp_schema . "/" . $nmgp_schema;  
           $_SESSION['scriptcase']['str_schema_all'] = $nmgp_schema;
           $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['num_css'] = rand(0, 1000);
       } 
       if ($nmgp_opcao == "volta_grid")  
       { 
           $nmgp_opcao = "igual";  
       }   
       if (!empty($nmgp_opcao))  
       { 
           $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['opcao'] = $nmgp_opcao ;  
       }   
       if (isset($_POST["vg_evento_id"])) 
       {
           $_SESSION["vg_evento_id"] = $_POST["vg_evento_id"];
           nm_limpa_str_grid_geral_rsvp_r($_SESSION["vg_evento_id"]);
       }
       if (isset($_GET["vg_evento_id"])) 
       {
           $_SESSION["vg_evento_id"] = $_GET["vg_evento_id"];
           nm_limpa_str_grid_geral_rsvp_r($_SESSION["vg_evento_id"]);
       }
       if (!isset($_SESSION["vg_evento_id"])) 
       {
           $_SESSION["vg_evento_id"] = "";
       }
       if (isset($_POST["vg_usuario_id"])) 
       {
           $_SESSION["vg_usuario_id"] = $_POST["vg_usuario_id"];
           nm_limpa_str_grid_geral_rsvp_r($_SESSION["vg_usuario_id"]);
       }
       if (isset($_GET["vg_usuario_id"])) 
       {
           $_SESSION["vg_usuario_id"] = $_GET["vg_usuario_id"];
           nm_limpa_str_grid_geral_rsvp_r($_SESSION["vg_usuario_id"]);
       }
       if (!isset($_SESSION["vg_usuario_id"])) 
       {
           $_SESSION["vg_usuario_id"] = "";
       }
       if (isset($_POST["rsvp_global"])) 
       {
           $_SESSION["rsvp_global"] = $_POST["rsvp_global"];
           nm_limpa_str_grid_geral_rsvp_r($_SESSION["rsvp_global"]);
       }
       if (isset($_GET["rsvp_global"])) 
       {
           $_SESSION["rsvp_global"] = $_GET["rsvp_global"];
           nm_limpa_str_grid_geral_rsvp_r($_SESSION["rsvp_global"]);
       }
       if (!isset($_SESSION["rsvp_global"])) 
       {
           $_SESSION["rsvp_global"] = "";
       }
       if (isset($_POST["vg_menu_item"])) 
       {
           $_SESSION["vg_menu_item"] = $_POST["vg_menu_item"];
           nm_limpa_str_grid_geral_rsvp_r($_SESSION["vg_menu_item"]);
       }
       if (isset($_GET["vg_menu_item"])) 
       {
           $_SESSION["vg_menu_item"] = $_GET["vg_menu_item"];
           nm_limpa_str_grid_geral_rsvp_r($_SESSION["vg_menu_item"]);
       }
       if (!isset($_SESSION["vg_menu_item"])) 
       {
           $_SESSION["vg_menu_item"] = "";
       }
       if (isset($_POST["parm1"])) 
       {
           $_SESSION["parm1"] = $_POST["parm1"];
           nm_limpa_str_grid_geral_rsvp_r($_SESSION["parm1"]);
       }
       if (isset($_GET["parm1"])) 
       {
           $_SESSION["parm1"] = $_GET["parm1"];
           nm_limpa_str_grid_geral_rsvp_r($_SESSION["parm1"]);
       }
       if (!isset($_SESSION["parm1"])) 
       {
           $_SESSION["parm1"] = "";
       }
       if (isset($_POST["vg_cpfseg"])) 
       {
           $_SESSION["vg_cpfseg"] = $_POST["vg_cpfseg"];
           nm_limpa_str_grid_geral_rsvp_r($_SESSION["vg_cpfseg"]);
       }
       if (isset($_GET["vg_cpfseg"])) 
       {
           $_SESSION["vg_cpfseg"] = $_GET["vg_cpfseg"];
           nm_limpa_str_grid_geral_rsvp_r($_SESSION["vg_cpfseg"]);
       }
       if (!isset($_SESSION["vg_cpfseg"])) 
       {
           $_SESSION["vg_cpfseg"] = "";
       }
       if (isset($_POST["parm2"])) 
       {
           $_SESSION["parm2"] = $_POST["parm2"];
           nm_limpa_str_grid_geral_rsvp_r($_SESSION["parm2"]);
       }
       if (isset($_GET["parm2"])) 
       {
           $_SESSION["parm2"] = $_GET["parm2"];
           nm_limpa_str_grid_geral_rsvp_r($_SESSION["parm2"]);
       }
       if (!isset($_SESSION["parm2"])) 
       {
           $_SESSION["parm2"] = "";
       }
       if (!isset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['mostra_edit'])) 
       {
           $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['mostra_edit'] = "S";
       }
       if (isset($nmgp_lig_edit_lapis)) 
       {
          $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['mostra_edit'] = $nmgp_lig_edit_lapis;
           unset($GLOBALS["nmgp_lig_edit_lapis"]) ;  
           if (isset($_SESSION['nmgp_lig_edit_lapis'])) 
           {
               unset($_SESSION['nmgp_lig_edit_lapis']);
           }
       }
       if (isset($nmgp_outra_jan) && $nmgp_outra_jan == 'true')
       {
           $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['sc_outra_jan'] = true;
       }
       $nm_saida = "";
       if (!isset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['sc_modal']))
       {
           $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['sc_modal'] = false;
       }
       if (isset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['volta_redirect_apl']) && !empty($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['volta_redirect_apl']))
       {
           $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['volta_redirect_apl']; 
           $nm_apl_dependente = $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['volta_redirect_tp']; 
           $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['volta_redirect_apl'] = "";
           $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['volta_redirect_tp'] = "";
           $nm_url_saida = "grid_geral_rsvp_r_fim.php"; 
       
       }
       elseif (substr($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['opcao'], 0, 7) != "grafico" && $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['opcao'] != "pdf" ) 
       {
           if (isset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['sc_outra_jan']) && $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['sc_outra_jan'])
           {
               if ($nmgp_url_saida == "modal")
               {
                   $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['sc_modal'] = true;
               }
               $nm_url_saida = "grid_geral_rsvp_r_fim.php"; 
           }
           elseif (!$nm_embutida_form)
           {
               $nm_url_saida = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ""; 
               $nm_url_saida = str_replace("_fim.php", ".php", $nm_url_saida);
               if (!empty($nmgp_url_saida)) 
               { 
                   $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['retorno_cons'] = $nmgp_url_saida ; 
               } 
               if (!empty($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['retorno_cons'])) 
               { 
                   $nm_url_saida = $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['retorno_cons']  . "?script_case_init=" . NM_encode_input($script_case_init);  
                   $nm_apl_dependente = 1 ; 
               } 
               if (!empty($nm_url_saida)) 
               { 
                   $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $nm_url_saida ; 
               } 
               $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $nm_url_saida; 
               $nm_url_saida = "grid_geral_rsvp_r_fim.php"; 
               $_SESSION['scriptcase']['sc_tp_saida'] = "P"; 
               if ($nm_apl_dependente == 1) 
               { 
                   $_SESSION['scriptcase']['sc_tp_saida'] = "D"; 
               } 
           } 
       }
// 
       if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && substr($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['opcao'], 0, 7) != "grafico" && $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['opcao'] != "pdf" ) 
       { 
            $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $_SESSION['scriptcase']['nm_sc_retorno']; 
            $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['menu_desenv'] = true;   
       } 
       if (isset($nmgp_parms_ret)) 
       {
           $todo = explode(",", $nmgp_parms_ret);
           if (isset($sc_conv_var[$todo[2]]))
           {
               $todo[2] = $sc_conv_var[$todo[2]];
           }
           elseif (isset($sc_conv_var[strtolower($todo[2])]))
           {
               $todo[2] = $sc_conv_var[strtolower($todo[2])];
           }
           $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['form_psq_ret']  = $todo[0];
           $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['campo_psq_ret'] = $todo[1];
           $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['dado_psq_ret']  = $todo[2];
           $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['js_apos_busca'] = $nm_evt_ret_busca;
           $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['opc_psq'] = true;   
           if (isset($nmgp_iframe_ret)) {
               $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['iframe_ret_cap'] = $nmgp_iframe_ret;
           }
           $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['psq_edit'] = 'N';   
           if (isset($nmgp_perm_edit)) {
               $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['psq_edit'] = $nmgp_perm_edit;
           }
       } 
       elseif (!isset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['opc_psq']))
       {
           $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['opc_psq']  = false;   
           $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['psq_edit'] = 'N';   
       } 
       if (isset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida_form']) && $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida_form'])
       {
           if (!isset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida_form_full']) || !$_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida_form_full'])
           {
               $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['mostra_edit'] = "N";   
           } 
           $_SESSION['scriptcase']['sc_tp_saida']  = $salva_tp_saida;
           $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $salva_url_saida;
       } 
       $GLOBALS["NM_ERRO_IBASE"] = 0;  
       if (isset($_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['sc_outra_jan']) && $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['sc_outra_jan'])
       {
           $nm_apl_dependente = 0;
       }
       $contr_grid_geral_rsvp_r = new grid_geral_rsvp_r_apl();

      if ('ajax_autocomp' == $nmgp_opcao)
      {
          $nmgp_opcao = 'busca';
          $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['opcao'] = "busca";
          $contr_grid_geral_rsvp_r->NM_ajax_flag = true;
          $contr_grid_geral_rsvp_r->NM_ajax_opcao = $NM_ajax_opcao;
      }
      if ('ajax_filter_save' == $nmgp_opcao)
      {
          $nmgp_opcao = 'busca';
          $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['opcao'] = "busca";
          $contr_grid_geral_rsvp_r->NM_ajax_flag = true;
          $contr_grid_geral_rsvp_r->NM_ajax_opcao = "ajax_filter_save";
      }
      if ('ajax_filter_delete' == $nmgp_opcao)
      {
          $nmgp_opcao = 'busca';
          $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['opcao'] = "busca";
          $contr_grid_geral_rsvp_r->NM_ajax_flag = true;
          $contr_grid_geral_rsvp_r->NM_ajax_opcao = "ajax_filter_delete";
      }
      if ('ajax_filter_select' == $nmgp_opcao)
      {
          $nmgp_opcao = 'busca';
          $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['opcao'] = "busca";
          $contr_grid_geral_rsvp_r->NM_ajax_flag = true;
          $contr_grid_geral_rsvp_r->NM_ajax_opcao = "ajax_filter_select";
      }
       $contr_grid_geral_rsvp_r->controle();
   } 
   if (!$_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['embutida'] && $nmgp_opcao == "formphp")
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 0;  
       $contr_grid_geral_rsvp_r = new grid_geral_rsvp_r_apl();
       $contr_grid_geral_rsvp_r->controle();
   } 
//
   function nm_limpa_str_grid_geral_rsvp_r(&$str)
   {
   }
   function nm_protect_num_grid_geral_rsvp_r($name, &$val)
   {
       if (empty($val))
       {
          return;
       }
       $Nm_numeric = array();
       $Nm_numeric[] = "id_geral";
       $Nm_numeric[] = "evento_id";
       $Nm_numeric[] = "hotel";
       $Nm_numeric[] = "publico";
       $Nm_numeric[] = "regional";
       $Nm_numeric[] = "pais";
       $Nm_numeric[] = "hotel_ida";
       $Nm_numeric[] = "cia_aerea_ida";
       $Nm_numeric[] = "origem_ida";
       $Nm_numeric[] = "destino_ida";
       $Nm_numeric[] = "hotel_volta";
       $Nm_numeric[] = "cia_aerea_volta";
       $Nm_numeric[] = "origem_volta";
       $Nm_numeric[] = "destino_volta";
       $Nm_numeric[] = "id_usuario_relato";
       $Nm_numeric[] = "valor_diaria";
       $Nm_numeric[] = "valor_taxa";
       $simb_grp = (isset($_SESSION['scriptcase']['reg_conf']['grup_num'])) ? $_SESSION['scriptcase']['reg_conf']['grup_num'] : ".";
       $simb_dec = (isset($_SESSION['scriptcase']['reg_conf']['dec_num']))  ? $_SESSION['scriptcase']['reg_conf']['dec_num']  : ",";
       $simb_neg = (isset($_SESSION['scriptcase']['reg_conf']['simb_neg'])) ? $_SESSION['scriptcase']['reg_conf']['simb_neg'] : "-";
       if (in_array($name, $Nm_numeric))
       {
           if (is_array($val))
           {
               foreach ($val as $cada_val)
               {
                  $tmp_pos = (is_string($cada_val)) ? strpos($cada_val, "##@@") : false;
                  if ($tmp_pos !== false)
                   {
                      $cada_val = substr($cada_val, 0, $tmp_pos);
                  }
                  for ($x = 0; $x < strlen($cada_val); $x++)
                  {
                      if (($cada_val[$x] < 0 || $cada_val[$x] > 9) && $cada_val[$x] != $simb_grp && $cada_val[$x] != $simb_dec && $cada_val[$x] != $simb_neg)
                      {
                          $val = array();
                          return;
                      }
                   }
               }
               return;
           }
           $cada_val = $val;
           $tmp_pos = (is_string($cada_val)) ? strpos($cada_val, "##@@") : false;
           if ($tmp_pos !== false)
            {
               $cada_val = substr($cada_val, 0, $tmp_pos);
           }
           for ($x = 0; $x < strlen($cada_val); $x++)
           {
               if (($cada_val[$x] < 0 || $cada_val[$x] > 9) && $cada_val[$x] != $simb_grp && $cada_val[$x] != $simb_dec && $cada_val[$x] != $simb_neg)
               {
                   $val = 0;
                   return;
               }
           }
       }
   }
   function grid_geral_rsvp_r_pack_protect_string($sString)
   {
      $sString = (string) $sString;
      if (!empty($sString))
      {
         if (function_exists('NM_is_utf8') && NM_is_utf8($sString))
         {
             return $sString;
         }
         else
         {
             return sc_htmlentities($sString);
         }
      }
      elseif ('0' === $sString || 0 === $sString)
      {
         return '0';
      }
      else
      {
         return '';
      }
   }

    function grid_geral_rsvp_r_pdf_progress_call($message, $Nm_lang, $flushBuffer = false) {
        $message = trim($message);
        if ('off' == $message)
        {
            $bol_end = TRUE;
        }
        elseif (false !== strpos($message, 'HDOC_#NM#_'))
        {
            $bol_end    = FALSE;
            $arr_partes = explode('_#NM#_', $message);
            if (4 == sizeof($arr_partes))
            {
                $int_size = $arr_partes[0];
                $str_msg  = ('F' == $arr_partes[2]) ? $Nm_lang['lang_pdff_frmt_page']  : $Nm_lang['lang_pdff_wrtg'];
                $str_msg .= $arr_partes[2];
                $int_step = ('F' == $arr_partes[2]) ? floor($int_size * 0.9) : floor($int_size * 0.95);
            }
            else
            {
                $bol_load = FALSE;
            }
        }
        else
        {
            $bol_end    = FALSE;
            $arr_partes = explode('_#NM#_', $message);
            if (3 == sizeof($arr_partes))
            {
                $int_size = $arr_partes[0];
                $int_step = $arr_partes[1];
                $str_msg  = $arr_partes[2];
            }
            else
            {
                $bol_load = FALSE;
            }
        }
        $return_message = $int_size . '!#!' . $int_step . '!#!' . ($bol_end ? '1' : '0') . '!#!' . ($bol_end ? $Nm_lang['lang_pdff_fnsh'] : $str_msg);
?>
<script type="text/javascript">
if (window.parent && typeof window.parent.updateProgressBar === "function") {
    window.parent.updateProgressBar("<?php echo trim($return_message); ?>");
}
</script>
<?php
        global $script_case_init;
        if ($flushBuffer && $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['opcao'] != 'print') {
            $bufferSize = @ini_get('output_buffering');
            if ('' != $bufferSize) {
                echo str_repeat('&nbsp;', $bufferSize * 5);
            }
        }
        flush();
    }

?>
