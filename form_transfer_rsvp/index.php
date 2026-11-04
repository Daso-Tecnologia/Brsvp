<?php
//
   if (!session_id())
   {
   include_once('form_transfer_rsvp_session.php');
           include_once("../_lib/lib/php/fix.php");
   @ini_set('session.cookie_httponly', 1);
   @ini_set('session.use_only_cookies', 1);
   @ini_set('session.cookie_secure', 1);
   @ini_set('session.cookie_samesite', 'None');
   @session_start() ;
       if (!function_exists("sc_check_mobile"))
       {
           include_once("../_lib/lib/php/nm_check_mobile.php");
       }
       $_SESSION['scriptcase']['device_mobile'] = sc_check_mobile();
       $_SESSION['scriptcase']['proc_mobile']   = $_SESSION['scriptcase']['device_mobile'];
       if (!isset($_SESSION['scriptcase']['display_mobile']))
       {
           $_SESSION['scriptcase']['display_mobile'] = true;
       }
       if ($_SESSION['scriptcase']['device_mobile'])
       {
           if ($_SESSION['scriptcase']['display_mobile'] && isset($_POST['_sc_force_mobile']) && 'out' == $_POST['_sc_force_mobile'])
           {
               $_SESSION['scriptcase']['display_mobile'] = false;
           }
           elseif (!$_SESSION['scriptcase']['display_mobile'] && isset($_POST['_sc_force_mobile']) && 'in' == $_POST['_sc_force_mobile'])
           {
               $_SESSION['scriptcase']['display_mobile'] = true;
           }
       }
        if (isset($_GET['_sc_force_mobile'])) {
            $_SESSION['scriptcase']['force_mobile'] = 'Y' == $_GET['_sc_force_mobile'];
        }
        if (isset($_SESSION['scriptcase']['force_mobile'])) {
            if ($_SESSION['scriptcase']['force_mobile']) {
                $_SESSION['scriptcase']['device_mobile'] = true;
            }
            $_SESSION['scriptcase']['display_mobile'] = $_SESSION['scriptcase']['force_mobile'];
        }
       if ($_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
       {
          include_once('form_transfer_rsvp_mob.php');
          exit;
       }
   }

   $_SESSION['scriptcase']['form_transfer_rsvp']['error_buffer'] = '';

   $_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_perfil']          = "conn_mysql";
   $_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_path_prod']       = "";
   $_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_path_imagens']    = "";
   $_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_path_imag_temp']  = "";
   $_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_path_cache']  = "";
   $_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_path_doc']        = "";
   $NM_dir_atual = getcwd();
   if (empty($NM_dir_atual))
   {
       $str_path_sys  = (isset($_SERVER['SCRIPT_FILENAME'])) ? $_SERVER['SCRIPT_FILENAME'] : $_SERVER['ORIG_PATH_TRANSLATED'];
       $str_path_sys  = str_replace("\\", '/', $str_path_sys);
   }
   else
   {
       $sc_nm_arquivo = explode("/", $_SERVER['PHP_SELF']);
       $str_path_sys  = str_replace("\\", "/", getcwd()) . "/" . $sc_nm_arquivo[count($sc_nm_arquivo)-1];
   }
   //check publication with the prod
   $str_path_apl_url = $_SERVER['PHP_SELF'];
   $str_path_apl_url = str_replace("\\", '/', $str_path_apl_url);
   $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/"));
   $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/")+1);
   $str_path_apl_dir = substr($str_path_sys, 0, strrpos($str_path_sys, "/"));
   $str_path_apl_dir = substr($str_path_apl_dir, 0, strrpos($str_path_apl_dir, "/")+1);
   //check prod
   if(empty($_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_path_prod']))
   {
           /*check prod*/$_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_path_prod'] = $str_path_apl_url . "_lib/prod";
   }
   //check img
   if(empty($_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_path_imagens']))
   {
           /*check img*/$_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_path_imagens'] = $str_path_apl_url . "_lib/file/img";
   }
   //check tmp
   if(empty($_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_path_imag_temp']))
   {
           /*check tmp*/$_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_path_imag_temp'] = $str_path_apl_url . "_lib/tmp";
   }
   //check cache
   if(empty($_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_path_cache']))
   {
           /*check cache*/$_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_path_cache'] = $str_path_apl_dir . "_lib/file/cache";
   }
   //check doc
   if(empty($_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_path_doc']))
   {
           /*check doc*/$_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_path_doc'] = $str_path_apl_dir . "_lib/file/doc";
   }
   //end check publication with the prod
//
class form_transfer_rsvp_ini
{
   var $nm_cod_apl;
   var $nm_nome_apl;
   var $nm_seguranca;
   var $nm_grupo;
   var $nm_grupo_versao;
   var $nm_autor;
   var $nm_versao_sc;
   var $nm_tp_lic_sc;
   var $nm_dt_criacao;
   var $nm_hr_criacao;
   var $nm_autor_alt;
   var $nm_dt_ult_alt;
   var $nm_hr_ult_alt;
   var $nm_timestamp;
   var $cor_bg_table;
   var $border_grid;
   var $cor_bg_grid;
   var $cor_cab_grid;
   var $cor_borda;
   var $cor_txt_cab_grid;
   var $cab_fonte_tipo;
   var $cab_fonte_tamanho;
   var $rod_fonte_tipo;
   var $rod_fonte_tamanho;
   var $cor_rod_grid;
   var $cor_txt_rod_grid;
   var $cor_barra_nav;
   var $cor_titulo;
   var $cor_txt_titulo;
   var $titulo_fonte_tipo;
   var $titulo_fonte_tamanho;
   var $cor_grid_impar;
   var $cor_grid_par;
   var $cor_txt_grid;
   var $texto_fonte_tipo;
   var $texto_fonte_tamanho;
   var $cor_lin_grupo;
   var $cor_txt_grupo;
   var $grupo_fonte_tipo;
   var $grupo_fonte_tamanho;
   var $cor_lin_sub_tot;
   var $cor_txt_sub_tot;
   var $sub_tot_fonte_tipo;
   var $sub_tot_fonte_tamanho;
   var $cor_lin_tot;
   var $cor_txt_tot;
   var $tot_fonte_tipo;
   var $tot_fonte_tamanho;
   var $cor_link_cab;
   var $cor_link_dados;
   var $img_fun_pag;
   var $img_fun_cab;
   var $img_fun_rod;
   var $img_fun_tit;
   var $img_fun_gru;
   var $img_fun_tot;
   var $img_fun_sub;
   var $img_fun_imp;
   var $img_fun_par;
   var $root;
   var $server;
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
   var $str_schema_all;
   var $str_google_fonts;
   var $str_conf_reg;
   var $path_cep;
   var $path_secure;
   var $path_js;
   var $path_adodb;
   var $path_grafico;
   var $path_atual;
   var $Gd_missing;
   var $sc_site_ssl;
   var $link_form_transfer_rsvp_inline;
   var $nm_cont_lin;
   var $nm_limite_lin;
   var $nm_limite_lin_prt;
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
   var $nm_col_dinamica   = array();
   var $nm_order_dinamico = array();
   var $nm_hidden_pages   = array();
   var $nm_page_names     = array();
   var $nm_page_blocks    = array();
   var $nm_block_page     = array();
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
   var $sc_lig_iframe = array();
   var $force_db_utf8 = true;
//
   function init()
   {
       global
             $nm_url_saida, $nm_apl_dependente, $script_case_init;

      @ini_set('magic_quotes_runtime', 0);
      $this->sc_page = $script_case_init;
      $_SESSION['scriptcase']['sc_num_page'] = $script_case_init;
      $_SESSION['scriptcase']['sc_ctl_ajax'] = 'part';
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
      $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['decimal_db'] = "."; 

      $this->nm_cod_apl      = "form_transfer_rsvp"; 
      $this->nm_nome_apl     = "Formulário de Transfer"; 
      $this->nm_seguranca    = ""; 
      $this->nm_grupo        = "NRSVP115_10_AWS_APP"; 
      $this->nm_grupo_versao = "1"; 
      $this->nm_autor        = "admin"; 
      $this->nm_script_by    = "netmake"; 
      $this->nm_script_type  = "PHP"; 
      $this->nm_versao_sc    = "v10"; 
      $this->nm_tp_lic_sc    = "sb_bronze"; 
      $this->nm_dt_criacao   = "20230413"; 
      $this->nm_hr_criacao   = "143804"; 
      $this->nm_autor_alt    = "admin"; 
      $this->nm_dt_ult_alt   = "20260902"; 
      $this->nm_hr_ult_alt   = "145731"; 
      list($NM_usec, $NM_sec) = explode(" ", microtime()); 
      $this->nm_timestamp    = (float) $NM_sec; 
      $this->nm_app_version  = "1.0.0"; 
// 
      $this->border_grid           = ""; 
      $this->cor_bg_grid           = ""; 
      $this->cor_bg_table          = ""; 
      $this->cor_borda             = ""; 
      $this->cor_cab_grid          = ""; 
      $this->cor_txt_pag           = ""; 
      $this->cor_link_pag          = ""; 
      $this->pag_fonte_tipo        = ""; 
      $this->pag_fonte_tamanho     = ""; 
      $this->cor_txt_cab_grid      = ""; 
      $this->cab_fonte_tipo        = ""; 
      $this->cab_fonte_tamanho     = ""; 
      $this->rod_fonte_tipo        = ""; 
      $this->rod_fonte_tamanho     = ""; 
      $this->cor_rod_grid          = ""; 
      $this->cor_txt_rod_grid      = ""; 
      $this->cor_barra_nav         = ""; 
      $this->cor_titulo            = ""; 
      $this->cor_txt_titulo        = ""; 
      $this->titulo_fonte_tipo     = ""; 
      $this->titulo_fonte_tamanho  = ""; 
      $this->cor_grid_impar        = ""; 
      $this->cor_grid_par          = ""; 
      $this->cor_txt_grid          = ""; 
      $this->texto_fonte_tipo      = ""; 
      $this->texto_fonte_tamanho   = ""; 
      $this->cor_lin_grupo         = ""; 
      $this->cor_txt_grupo         = ""; 
      $this->grupo_fonte_tipo      = ""; 
      $this->grupo_fonte_tamanho   = ""; 
      $this->cor_lin_sub_tot       = ""; 
      $this->cor_txt_sub_tot       = ""; 
      $this->sub_tot_fonte_tipo    = ""; 
      $this->sub_tot_fonte_tamanho = ""; 
      $this->cor_lin_tot           = ""; 
      $this->cor_txt_tot           = ""; 
      $this->tot_fonte_tipo        = ""; 
      $this->tot_fonte_tamanho     = ""; 
      $this->cor_link_cab          = ""; 
      $this->cor_link_dados        = ""; 
      $this->img_fun_pag           = ""; 
      $this->img_fun_cab           = ""; 
      $this->img_fun_rod           = ""; 
      $this->img_fun_tit           = ""; 
      $this->img_fun_gru           = ""; 
      $this->img_fun_tot           = ""; 
      $this->img_fun_sub           = ""; 
      $this->img_fun_imp           = ""; 
      $this->img_fun_par           = ""; 
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
      //check publication with the prod
      $str_path_apl_url = $_SERVER['PHP_SELF'];
      $str_path_apl_url = str_replace("\\", '/', $str_path_apl_url);
      $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/"));
      $str_path_apl_url = substr($str_path_apl_url, 0, strrpos($str_path_apl_url, "/")+1);
      $str_path_apl_dir = substr($str_path_sys, 0, strrpos($str_path_sys, "/"));
      $str_path_apl_dir = substr($str_path_apl_dir, 0, strrpos($str_path_apl_dir, "/")+1);
// 
      $this->sc_site_ssl     = (isset($_SERVER['HTTP_REFERER']) && strtolower(substr($_SERVER['HTTP_REFERER'], 0, 5)) == 'https') ? true : false;
      $this->sc_protocolo    = ($this->sc_site_ssl) ? 'https://' : 'http://';
      $this->path_prod       = $_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_path_prod'];
      $this->path_imagens    = $_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_path_imagens'];
      $this->path_imag_temp  = $_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_path_imag_temp'];
      $this->path_cache      = $_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_path_cache'];
      $this->path_doc        = $_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_path_doc'];
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
      $this->str_schema_all  = (isset($_SESSION['scriptcase']['str_schema_all']) && !empty($_SESSION['scriptcase']['str_schema_all'])) ? $_SESSION['scriptcase']['str_schema_all'] : "Sc9_Rhino/Sc9_Rhino";
      $this->str_google_fonts  = isset($str_google_fonts)?$str_google_fonts:'';
      $this->server          = (isset($_SERVER['SERVER_NAME'])) ? $_SERVER['SERVER_NAME'] : $_SERVER['HTTP_HOST'];
      if (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != 80 && !$this->sc_site_ssl )
      {
          $this->server         .= ":" . $_SERVER['SERVER_PORT'];
      }
      $this->server_pdf      = $this->sc_protocolo . $this->server;
      $this->server          = "";
      $this->sc_protocolo    = "";
      $str_path_web          = $_SERVER['PHP_SELF'];
      $str_path_web          = str_replace("\\", '/', $str_path_web);
      $str_path_web          = str_replace('//', '/', $str_path_web);
      $this->root            = substr($str_path_sys, 0, -1 * strlen($str_path_web));
      $this->path_aplicacao  = substr($str_path_sys, 0, strrpos($str_path_sys, '/'));
      $this->path_aplicacao  = substr($this->path_aplicacao, 0, strrpos($this->path_aplicacao, '/')) . '/form_transfer_rsvp';
      $this->path_embutida   = substr($this->path_aplicacao, 0, strrpos($this->path_aplicacao, '/') + 1);
      $this->path_aplicacao .= '/';
      $this->path_link       = substr($str_path_web, 0, strrpos($str_path_web, '/'));
      $this->path_link       = substr($this->path_link, 0, strrpos($this->path_link, '/')) . '/';
      $this->path_help       = $this->path_link . "_lib/webhelp/";
      $this->path_lang       = "../_lib/lang/";
      $this->path_lang_js    = "../_lib/js/";
      $this->path_botoes     = $this->path_link . "_lib/img";
      $this->path_img_global = $this->path_link . "_lib/img";
      $this->path_img_modelo = $this->path_link . "_lib/img";
      $this->path_icones     = $this->path_link . "_lib/img";
      $this->path_imag_cab   = $this->path_link . "_lib/img";
      $this->path_btn        = $this->root . $this->path_link . "_lib/buttons/";
      $this->path_css        = $this->root . $this->path_link . "_lib/css/";
      $this->path_lib_php    = $this->root . $this->path_link . "_lib/lib/php/";
      $this->url_lib_js      = $this->path_link . "_lib/lib/js/";
      $this->url_lib         = $this->path_link . '/_lib/';
      $this->url_third       = $this->path_prod . '/third/';
      $this->path_cep        = $this->path_prod . "/cep";
      $this->path_cor        = $this->path_prod . "/cor";
      $this->path_js         = $this->path_prod . "/lib/js";
      $this->path_libs       = $this->root . $this->path_prod . "/lib/php";
      $this->path_third      = $this->root . $this->path_prod . "/third";
      $this->path_adodb      = $this->root . $this->path_prod . "/third/adodb";

      include("../_lib/css/" . $this->str_schema_all . "_form.php");
      $temp_Str_btn_form    = trim($str_button);
      include($this->path_btn . $temp_Str_btn_form . '/' . $temp_Str_btn_form . $_SESSION['scriptcase']['reg_conf']['css_dir'] . '.php');
      $this->css_help_tooltip_faicon = !isset($css_help_tooltip_faicon) || "" == trim($css_help_tooltip_faicon) ? "fas fa-question-circle" : trim($css_help_tooltip_faicon);
      $this->css_schema_info_tooltiptheme = !isset($css_schema_info_tooltiptheme) || "" == trim($css_schema_info_tooltiptheme) ? "" : trim($css_schema_info_tooltiptheme);
      $this->tippy_themes = [];
      $this->tippy_theme_default = '';
      if ('' != $this->css_schema_info_tooltiptheme) {
          $this->scGetTippyCssTheme($this->tippy_themes, $this->css_schema_info_tooltiptheme);
          $this->tippy_theme_default = $this->css_schema_info_tooltiptheme;
      }

      $_SESSION['scriptcase']['dir_temp'] = $this->root . $this->path_imag_temp;
      if (isset($_SESSION['scriptcase']['form_transfer_rsvp']['session_timeout']['lang'])) {
          $this->str_lang = $_SESSION['scriptcase']['form_transfer_rsvp']['session_timeout']['lang'];
      }
      elseif (!isset($_SESSION['scriptcase']['form_transfer_rsvp']['actual_lang']) || $_SESSION['scriptcase']['form_transfer_rsvp']['actual_lang'] != $this->str_lang) {
          $_SESSION['scriptcase']['form_transfer_rsvp']['actual_lang'] = $this->str_lang;
          setcookie('sc_actual_lang_NRSVP115_10_AWS_APP',$this->str_lang,'0','/', '', ini_get('session.cookie_secure'), ini_get('session.cookie_httponly'));
      }
      global $inicial_form_transfer_rsvp;
      if (isset($_SESSION['scriptcase']['user_logout']))
      {
          foreach ($_SESSION['scriptcase']['user_logout'] as $ind => $parms)
          {
              if (isset($_SESSION[$parms['V']]) && $_SESSION[$parms['V']] == $parms['U'])
              {
                  $nm_apl_dest = $parms['R'];
                  $dir = explode("/", $nm_apl_dest);
                  if (count($dir) == 1)
                  {
                      $nm_apl_dest = str_replace(".php", "", $nm_apl_dest);
                      $nm_apl_dest = $this->path_link . SC_dir_app_name($nm_apl_dest) . "/";
                  }
                  unset($_SESSION['scriptcase']['user_logout'][$ind]);
                  if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag) && $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag)
                  {
                      $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['redir']['action']  = $nm_apl_dest;
                      $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['redir']['target']  = $parms['T'];
                      $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['redir']['metodo']  = "post";
                      $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['redir']['script_case_init']  = $this->sc_page;
                      form_transfer_rsvp_pack_ajax_response();
                      exit;
                  }
?>
                  <!DOCTYPE html>
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
      $str_path = substr($this->path_prod, 0, strrpos($this->path_prod, '/') + 1); 
      if (!is_file($this->root . $str_path . 'devel/class/xmlparser/nmXmlparserIniSys.class.php'))
      {
          unset($_SESSION['scriptcase']['nm_sc_retorno']);
          unset($_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_conexao']);
      }
      include($this->path_lang . $this->str_lang . ".lang.php");
      include($this->path_lang . "config_region.php");
      include($this->path_lang . "lang_config_region.php");
      $_SESSION['scriptcase']['charset'] = "UTF-8";
      ini_set('default_charset', $_SESSION['scriptcase']['charset']);
      $_SESSION['scriptcase']['charset_html']  = (isset($this->sc_charset[$_SESSION['scriptcase']['charset']])) ? $this->sc_charset[$_SESSION['scriptcase']['charset']] : $_SESSION['scriptcase']['charset'];

      asort($this->Nm_lang_conf_region);
      foreach ($this->Nm_lang_conf_region as $ind => $dados)
      {
         if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
         {
             $this->Nm_lang_conf_region[$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
         }
      }
      if (isset($this->Nm_lang['lang_errm_dbcn_conn']))
      {
          $_SESSION['scriptcase']['db_conn_error'] = $this->Nm_lang['lang_errm_dbcn_conn'];
      }
      if (!function_exists("mb_convert_encoding"))
      {
          echo "<div><font size=6>" . $this->Nm_lang['lang_othr_prod_xtmb'] . "</font></div>";exit;
      } 
      elseif (!function_exists("sc_convert_encoding"))
      {
          echo "<div><font size=6>" . $this->Nm_lang['lang_othr_prod_xtsc'] . "</font></div>";exit;
      } 
      foreach ($this->Nm_conf_reg[$this->str_conf_reg] as $ind => $dados)
      {
          if ($_SESSION['scriptcase']['charset'] != "UTF-8" && NM_is_utf8($dados))
          {
              $this->Nm_conf_reg[$this->str_conf_reg][$ind] = sc_convert_encoding($dados, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
      }
      $this->Nm_lang['lang_errm_ajax_rqrd'] = $this->Nm_lang['lang_errm_ajax_rqrd'];
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
      if (isset($_SESSION['scriptcase']['form_transfer_rsvp']['session_timeout']['redir'])) {
          $SS_cod_html  = '<!DOCTYPE html>

';
          $SS_cod_html .= "<HTML>\r\n";
          $SS_cod_html .= " <HEAD>\r\n";
          $SS_cod_html .= "  <TITLE></TITLE>\r\n";
          $SS_cod_html .= "   <META http-equiv=\"Content-Type\" content=\"text/html; charset=" . $_SESSION['scriptcase']['charset_html'] . "\"/>\r\n";
          if ($_SESSION['scriptcase']['proc_mobile']) {
              $SS_cod_html .= "   <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0\"/>\r\n";
          }
          $SS_cod_html .= "   <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n";
          $SS_cod_html .= "    <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n";
          if ($_SESSION['scriptcase']['form_transfer_rsvp']['session_timeout']['redir_tp'] == "R") {
              $SS_cod_html .= "  </HEAD>\r\n";
              $SS_cod_html .= "   <body>\r\n";
          }
          else {
              $SS_cod_html .= "    <link rel=\"shortcut icon\" href=\"../_lib/img/scriptcase__NM__ico__NM__favicon.ico\">\r\n";
              $SS_cod_html .= "    <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->str_schema_all . "_form.css\"/>\r\n";
              $SS_cod_html .= "    <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->str_schema_all . "_form" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\"/>\r\n";
              $SS_cod_html .= "  </HEAD>\r\n";
              $SS_cod_html .= "   <body class=\"scFormPage\">\r\n";
              $SS_cod_html .= "    <table align=\"center\"><tr><td style=\"padding: 0\"><div class=\"scFormBorder\">\r\n";
              $SS_cod_html .= "    <table width='100%' cellspacing=0 cellpadding=0><tr><td class=\"scFormDataOdd\" style=\"padding: 15px 30px; text-align: center\">\r\n";
              $SS_cod_html .= $this->Nm_lang['lang_errm_expired_session'] . "\r\n";
              $SS_cod_html .= "     <form name=\"Fsession_redir\" method=\"post\"\r\n";
              $SS_cod_html .= "           target=\"_self\">\r\n";
              $SS_cod_html .= "           <input type=\"button\" name=\"sc_sai_seg\" value=\"OK\" onclick=\"sc_session_redir('" . $_SESSION['scriptcase']['form_transfer_rsvp']['session_timeout']['redir'] . "');\">\r\n";
              $SS_cod_html .= "     </form>\r\n";
              $SS_cod_html .= "    </td></tr></table>\r\n";
              $SS_cod_html .= "    </div></td></tr></table>\r\n";
          }
          $SS_cod_html .= "    <script type=\"text/javascript\">\r\n";
          if ($_SESSION['scriptcase']['form_transfer_rsvp']['session_timeout']['redir_tp'] == "R") {
              $SS_cod_html .= "      sc_session_redir('" . $_SESSION['scriptcase']['form_transfer_rsvp']['session_timeout']['redir'] . "');\r\n";
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
          unset($_SESSION['scriptcase']['form_transfer_rsvp']['session_timeout']);
          unset($_SESSION['sc_session']);
      }
      if (isset($SS_cod_html) && isset($_GET['nmgp_opcao']) && (substr($_GET['nmgp_opcao'], 0, 14) == "ajax_aut_comp_" || substr($_GET['nmgp_opcao'], 0, 13) == "ajax_autocomp"))
      {
          unset($_SESSION['sc_session']);
          $oJson = new Services_JSON();
          echo $oJson->encode("ss_time_out");
          exit;
      }
      elseif (isset($SS_cod_html) && isset($_POST['nmgp_opcao']) && ($_POST['nmgp_opcao'] == "ajax_dyn_refresh_field" || $_POST['nmgp_opcao'] == "ajax_add_dyn_search" || $_POST['nmgp_opcao'] == "ajax_ch_bi_dyn_search"))
      {
          unset($_SESSION['sc_session']);
          $this->Arr_result = array();
          $this->Arr_result['ss_time_out'] = true;
          $oJson = new Services_JSON();
          echo $oJson->encode($this->Arr_result);
          exit;
      }
      elseif (isset($SS_cod_html) && isset($_POST['rs']) && !is_array($_POST['rs']) && 'ajax_' == substr($_POST['rs'], 0, 5) && isset($_POST['rsargs']) && !empty($_POST['rsargs']))
      {
          $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['redir']['action']  = "./";
          $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['redir']['target']  = "_self";
          $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['redir']['metodo']  = "post";
          $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['redir']['script_case_init']  = $this->sc_page;
          form_transfer_rsvp_pack_ajax_response();
          exit;
      }
      elseif (isset($SS_cod_html))
      {
          echo $SS_cod_html;
          exit;
      }
      if (isset($_SESSION['sc_session']['SC_parm_violation']) && !isset($_SESSION['scriptcase']['form_transfer_rsvp']['session_timeout']['redir']))
      {
          unset($_SESSION['sc_session']['SC_parm_violation']);
          echo "<!DOCTYPE html>";
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
      $PHP_ver = str_replace(".", "", phpversion()); 
      if (substr($PHP_ver, 0, 3) < 434)
      {
          echo "<div><font size=6>" . $this->Nm_lang['lang_othr_prod_phpv'] . "</font></div>";exit;
      }
      if (-1 != version_compare(phpversion(), '5.0.0'))
      {
         $this->path_grafico    = $this->root . $this->path_prod . "/third/jpgraph5/src";
      }
      else
      {
          $this->path_grafico    = $this->root . $this->path_prod . "/third/jpgraph4/src";
      }
      $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['path_doc'] = $this->path_doc; 
      $_SESSION['scriptcase']['nm_path_prod'] = $this->root . $this->path_prod . "/"; 
      $_SESSION['scriptcase']['nm_root_cep']  = $this->root; 
      $_SESSION['scriptcase']['nm_path_cep']  = $this->path_cep; 
      if (empty($this->path_imag_cab))
      {
          $this->path_imag_cab = $this->path_img_global;
      }
      if (!isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['iframe_menu'])) {
          $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['iframe_menu'] = "";
      }
      if (!isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['run_iframe'])) {
          $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['run_iframe'] = "";
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
          $str_message = str_replace('{v_str_btn_inside}', '', $str_message);
          echo $str_message;
          if (!$_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['sc_outra_jan']) || $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['sc_outra_jan'] != 'form_transfer_rsvp')) 
          { 
              if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno'])) 
              { 
?>
                  <input type="button" id="sai" onClick="window.location='<?php echo $_SESSION['scriptcase']['nm_sc_retorno'] ?>'; return false" class="scButton_default" value="<?php echo $this->Nm_lang['lang_btns_back'] ?>" title="<?php echo $this->Nm_lang['lang_btns_back_hint'] ?>" style="<?php echo $sCondStyle; ?>vertical-align: middle;display: ''">

<?php
              } 
              else 
              { 
?>
                  <input type="button" id="sai" onClick="window.location='<?php echo $nm_url_saida ?>'; return false" class="scButton_default" value="<?php echo $this->Nm_lang['lang_btns_exit'] ?>" title="__NM_HINT__ (Alt + Q)" style="<?php echo $sCondStyle; ?>vertical-align: middle;display: ''">

<?php
              } 
          } 
          echo $str_message_end;
          exit ;
      }

      $this->path_atual  = getcwd();
      $opsys = strtolower(php_uname());

      global $under_dashboard, $dashboard_app, $own_widget, $parent_widget, $compact_mode, $width_100, $remove_margin, $remove_border, $remove_background;
      if (!isset($_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['under_dashboard']))
      {
          $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['under_dashboard'] = false;
          $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['dashboard_app']   = '';
          $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['own_widget']      = '';
          $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['parent_widget']   = '';
          $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['compact_mode']    = false;
          $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['width_100']   = false;
          $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['remove_margin']   = false;
          $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['remove_border']   = false;
          $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['remove_background'] = false;
      }
      if (isset($_GET['under_dashboard']) && 1 == $_GET['under_dashboard'])
      {
          if (isset($_GET['own_widget']) && 'dbifrm_widget' == substr($_GET['own_widget'], 0, 13)) {
              $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['own_widget'] = $_GET['own_widget'];
              $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['under_dashboard'] = true;
              if (isset($_GET['dashboard_app'])) {
                  $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['dashboard_app'] = $_GET['dashboard_app'];
              }
              if (isset($_GET['parent_widget'])) {
                  $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['parent_widget'] = $_GET['parent_widget'];
              }
              if (isset($_GET['compact_mode'])) {
                  $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['compact_mode'] = 1 == $_GET['compact_mode'];
              }
              if (isset($_GET['width_100'])) {
                  $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['width_100'] = 1 == $_GET['width_100'];
              }
              if (isset($_GET['remove_margin'])) {
                  $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['remove_margin'] = 1 == $_GET['remove_margin'];
              }
              if (isset($_GET['remove_border'])) {
                  $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['remove_border'] = 1 == $_GET['remove_border'];
              }
              if (isset($_GET['remove_background'])) {
                  $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['remove_background'] = 1 == $_GET['remove_background'];
              }
          }
      }
      elseif (isset($under_dashboard) && 1 == $under_dashboard)
      {
          if (isset($own_widget) && 'dbifrm_widget' == substr($own_widget, 0, 13)) {
              $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['own_widget'] = $own_widget;
              $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['under_dashboard'] = true;
              if (isset($dashboard_app)) {
                  $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['dashboard_app'] = $dashboard_app;
              }
              if (isset($parent_widget)) {
                  $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['parent_widget'] = $parent_widget;
              }
              if (isset($compact_mode)) {
                  $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['compact_mode'] = 1 == $compact_mode;
              }
              if (isset($width_100)) {
                  $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['width_100'] = 1 == $width_100;
              }
              if (isset($remove_margin)) {
                  $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['remove_margin'] = 1 == $remove_margin;
              }
              if (isset($remove_border)) {
                  $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['remove_border'] = 1 == $remove_border;
              }
              if (isset($remove_background)) {
                  $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['remove_background'] = 1 == $remove_background;
              }
          }
      }
      if (!isset($_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['maximized']))
      {
          $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['maximized'] = false;
      }
      if (isset($_GET['maximized']))
      {
          $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['maximized'] = 1 == $_GET['maximized'];
      }
      $this->link_form_transfer_rsvp_inline = $this->sc_protocolo . $this->server . $this->path_link . "" . SC_dir_app_name('form_transfer_rsvp') . "/form_transfer_rsvp_inline.php";
      if ($_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['under_dashboard'])
      {
          $sTmpDashboardApp = $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['dashboard_info']['dashboard_app'];
          if ('' != $sTmpDashboardApp && isset($_SESSION['scriptcase']['dashboard_targets'][$sTmpDashboardApp]["form_transfer_rsvp"]))
          {
              foreach ($_SESSION['scriptcase']['dashboard_targets'][$sTmpDashboardApp]["form_transfer_rsvp"] as $sTmpTargetLink => $sTmpTargetWidget)
              {
                  if (isset($this->sc_lig_target[$sTmpTargetLink]))
                  {
                      if (isset($this->sc_lig_iframe[$this->sc_lig_target[$sTmpTargetLink]]))
                      {
                          $this->sc_lig_iframe[$this->sc_lig_target[$sTmpTargetLink]] = $sTmpTargetWidget;
                      }
                      $this->sc_lig_target[$sTmpTargetLink] = $sTmpTargetWidget;
                  }
              }
          }
      }
        global $link_compact_mode, $link_width_100, $link_remove_margin, $link_remove_border, $link_remove_background, $link_margin_top;
        if (isset($link_compact_mode) && 'ok' == $link_compact_mode) {
            if (!isset($_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['link_info'])) {
                $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['link_info'] = array();
            }
            $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['link_info']['compact_mode'] = true;
        }
        if (isset($link_width_100) && 'ok' == $link_width_100) {
            if (!isset($_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['link_info'])) {
                $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['link_info'] = array();
            }
            $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['link_info']['width_100'] = true;
        }
        if (isset($link_remove_margin) && 'ok' == $link_remove_margin) {
            if (!isset($_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['link_info'])) {
                $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['link_info'] = array();
            }
            $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['link_info']['remove_margin'] = true;
        }
        if (isset($link_remove_border) && 'ok' == $link_remove_border) {
            if (!isset($_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['link_info'])) {
                $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['link_info'] = array();
            }
            $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['link_info']['remove_border'] = true;
        }
        if (isset($link_remove_background) && 'ok' == $link_remove_background) {
            if (!isset($_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['link_info'])) {
                $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['link_info'] = array();
            }
            $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['link_info']['remove_background'] = true;
        }
        if (isset($link_margin_top) && '' != $link_margin_top) {
            if (!isset($_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['link_info'])) {
                $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['link_info'] = array();
            }
            $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['link_info']['margin_top'] = $link_margin_top;
        }

      $this->nm_cont_lin       = 0;
      $this->nm_limite_lin     = 0;
      $this->nm_limite_lin_prt = 0;
// 
      include_once($this->path_adodb . "/adodb.inc.php");
      $this->sc_Include($this->path_libs . "/nm_sec_prod.php", "F", "nm_reg_prod");
      $this->sc_Include($this->path_libs . "/nm_ini_perfil.php", "F", "perfil_lib");
      if(function_exists('set_php_timezone'))  set_php_timezone('form_transfer_rsvp'); 
      $this->sc_Include($this->path_lib_php . "/nm_data.class.php", "C", "nm_data") ; 
      $this->sc_Include($this->path_lib_php . "/nm_edit.php", "F", "nmgp_Form_Num_Val") ; 
      $this->sc_Include($this->path_lib_php . "/nm_conv_dados.php", "F", "nm_conv_limpa_dado") ; 
      $this->sc_Include($this->path_lib_php . "/nm_functions.php", "", "") ; 
      global $bol_api_prod; 
      $bol_api_prod = true; 
      if (isset($_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_conexao'])) 
      { 
          $bol_api_prod = false;
      } 
      $this->sc_Include($this->path_lib_php . "/nm_api.php", "", "") ; 
      $this->sc_Include($this->path_lib_php . "/fix.php", "", "") ; 
      $this->nm_data = new nm_data("pt_br");
      global $inicial_form_transfer_rsvp, $NM_run_iframe;
      if ((isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag) && $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag) || (isset($_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['embutida_call']) && $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['embutida_call']) || $NM_run_iframe == 1)
      {
           $_SESSION['scriptcase']['sc_ctl_ajax'] = 'part';
      }
      perfil_lib($this->path_libs);
      if (!isset($_SESSION['sc_session'][$this->sc_page]['SC_Check_Perfil']))
      {
          if(function_exists("nm_check_perfil_exists")) nm_check_perfil_exists($this->path_libs, $this->path_prod);
          $_SESSION['sc_session'][$this->sc_page]['SC_Check_Perfil'] = true;
      }
      if (function_exists("nm_check_pdf_server")) $this->server_pdf = nm_check_pdf_server($this->path_libs, $this->server_pdf);
      if (!isset($_SESSION['scriptcase']['sc_num_img']) || empty($_SESSION['scriptcase']['sc_num_img']))
      { 
          $_SESSION['scriptcase']['sc_num_img'] = 1; 
      } 
      $this->Export_img_zip = false;;
      $this->Img_export_zip  = array();
      $this->regionalDefault();
      $this->sc_tem_trans_banco = false;
      $this->nm_bases_access     = array("access", "ado_access", "ace_access");
      $this->nm_bases_db2        = array("db2", "db2_odbc", "odbc_db2", "odbc_db2v6", "pdo_db2_odbc", "pdo_ibm");
      $this->nm_bases_ibase      = array("ibase", "firebird", "pdo_firebird", "borland_ibase");
      $this->nm_bases_informix   = array("informix", "informix72", "pdo_informix");
      $this->nm_bases_mssql      = array("mssql", "ado_mssql", "adooledb_mssql", "odbc_mssql", "mssqlnative", "pdo_sqlsrv", "pdo_dblib", "azure_mssql", "azure_ado_mssql", "azure_adooledb_mssql", "azure_odbc_mssql", "azure_mssqlnative", "azure_pdo_sqlsrv", "azure_pdo_dblib", "googlecloud_mssql", "googlecloud_ado_mssql", "googlecloud_adooledb_mssql", "googlecloud_odbc_mssql", "googlecloud_mssqlnative", "googlecloud_pdo_sqlsrv", "googlecloud_pdo_dblib", "amazonrds_mssql", "amazonrds_ado_mssql", "amazonrds_adooledb_mssql", "amazonrds_odbc_mssql", "amazonrds_mssqlnative", "amazonrds_pdo_sqlsrv", "amazonrds_pdo_dblib");
      $this->nm_bases_mysql      = array("mysql", "mysqlt", "mysqli", "maxsql", "pdo_mysql", "pdo_mariadb", "azure_mysql", "azure_mysqlt", "azure_mysqli", "azure_maxsql", "azure_pdo_mysql", "azure_pdo_mariadb", "googlecloud_mysql", "googlecloud_mysqlt", "googlecloud_mysqli", "googlecloud_maxsql", "googlecloud_pdo_mysql", "googlecloud_pdo_mariadb", "amazonrds_mysql", "amazonrds_mysqlt", "amazonrds_mysqli", "amazonrds_maxsql", "amazonrds_pdo_mysql", "amazonrds_pdo_mariadb");
      $this->nm_bases_postgres   = array("postgres", "postgres64", "postgres7", "pdo_pgsql", "azure_postgres", "azure_postgres64", "azure_postgres7", "azure_pdo_pgsql", "googlecloud_postgres", "googlecloud_postgres64", "googlecloud_postgres7", "googlecloud_pdo_pgsql", "amazonrds_postgres", "amazonrds_postgres64", "amazonrds_postgres7", "amazonrds_pdo_pgsql");
      $this->nm_bases_oracle     = array("oci8", "oci805", "oci8po", "odbc_oracle", "oracle", "pdo_oracle", "oraclecloud_oci8", "oraclecloud_oci805", "oraclecloud_oci8po", "oraclecloud_odbc_oracle", "oraclecloud_oracle", "oraclecloud_pdo_oracle", "amazonrds_oci8", "amazonrds_oci805", "amazonrds_oci8po", "amazonrds_odbc_oracle", "amazonrds_oracle", "amazonrds_pdo_oracle");
      $this->nm_bases_sqlite     = array("sqlite", "sqlite3", "pdosqlite");
      $this->nm_bases_sybase     = array("sybase", "pdo_sybase_odbc", "pdo_sybase_dblib");
      $this->nm_bases_vfp        = array("vfp");
      $this->nm_bases_odbc       = array("odbc");
      $this->nm_bases_progress   = array("progress", "pdo_progress_odbc");
      $this->nm_bases_all        = array_merge($this->nm_bases_access, $this->nm_bases_db2, $this->nm_bases_ibase, $this->nm_bases_informix, $this->nm_bases_mssql, $this->nm_bases_mysql, $this->nm_bases_postgres, $this->nm_bases_oracle, $this->nm_bases_sqlite, $this->nm_bases_sybase, $this->nm_bases_vfp, $this->nm_bases_odbc, $this->nm_bases_progress);
      $_SESSION['scriptcase']['nm_bases_security']  = "enc_nm_enc_v1HQNmH9X7D1veD5JeHuBOVcFCDWF/DoX7HQJmZSB/HIBeHuBOHgBeHArCH5X/DoJeHQXODQX7Z1rwD5JwHuzGV9FeDWXCDoJsDcBwH9B/Z1rYHQJwHgveHArCV5B7ZuJsDcXGDQFaHArYHQrqDMNOZSNiH5B7DoXGDcNmZ1X7HIveHuXGHgvsVkJ3H5X/VoFGDcXGZ9F7HANOV5FaDMvsVcFeDurGDoXGHQXGZ1FGZ1NOHuFUHgBOHEJqHEB7DoF7D9XsDQJsDSBYV5FGHgNKDkBsDurGVEBiDcFYZSBOHArYHQF7DMveHEJqDuXKVoFGHQBiZSFUD1BeV5FaDMBODkBsDuB7DoXGDcNmZ1BOHArYHuB/HgrKZSJ3DWrGVoFGHQXODuFaD1BOV5BODMrYZSNiH5B7VoBqD9BsZ1F7DSrYD5rqDMrYZSJ3HEB7ZuJsHQNwH9FUHAN7HuBqHgrwVcBUDuFGDoXGHQXOVIJsHIveHQBiHgBeZSJqH5X/VoFGHQXODQBqDSzGVWXGHgvOVcFeV5BmDoXGDcFYZ1X7DSrYHQBqHgBOHEJqH5BmDoF7D9XsDQJsDSBYV5FGHgNKDkFCH5FqVoBqDcNwH9FaHArKD5NUDEvsHEFiDuJeDoFUHQJKZ9F7DSvCV5JwDMBOVcrsDWJeVoraDcJUH9FaHAN7D5NUDEBOHAFKDWF/HINUD9JKDQX7HIBeD5JwHuzGZSJ3V5X7HIX7DcJUZ1FaD1rKHuBODMBYHEXeHEFaVoB/HQXGZSFGHAvCV5XGDMvOVcFiV5X7VEF7D9BiH9FaHIBeD5XGDEBOZSXeV5FaZuFaHQXGZSFGD1BeV5FGHuzGVIBOHEFYVorqD9BiZ1F7D1rwD5NUDErKZSXeH5FGDoB/DcJUZSX7HIBeD5BqHgvsZSJ3H5FqVoFGDcBqH9BOZ1BeV5XGDEBOZSJGH5FYZuFaDcXOZSBiHANOHuJeDMvmVIBsDur/VoBiHQJmZ1BOHAN7HuFaHgvsDkXKH5BmZuBqHQBiDuBqHAvmVWJwDMrYVIBsDWXCDoJsDcBwH9B/Z1rYHQJwHgBYHEBUDWF/VoXGHQBiDQJsDSN7HQB/HgrwVcXKDur/VoBiHQJmZ1F7Z1vmD5rqDEBOHArCDWBmDoB/DcBwH9X7Z1rwV5BOHuNOVcB/V5X7VENUD9XOZSB/HABYV5FUDErKZSXeDWXCVoB/D9NwH9FUZ1rwV5BOHuzGDkFCDWF/VorqHQFYZSFaHArKV5XGDErKHErCDWF/VoBiDcJUZSX7Z1BYHuFaDMvmVcFKV5BmVoBqD9BsZkFGHArKV5XGDENOVkJ3DWr/HIrqHQXsDQFaD1veV5BqDMBYVcB/H5XCHMBiD9BsVIraD1rwV5X7HgBeHEBUH5FYDorqDcXOZSX7HANOV5BOHuNODkBOV5F/VEBiDcJUZkFGHArKV5FUDMrYZSXeV5FqHIJsHQBiZ9XGHANKV5BODMrYZSNiDWXKVorqHQNmVINUDSrYHQJwDEBODkFeH5FYVoFGHQJKDQJsHANOV5FaDMvODkBsV5BmVEX7D9BsVIJsHIBeHuBOHgNOHErsH5F/DoBOHQJKDQJsZ1vCV5FGHuNOV9FeDWXCHMJeDcJUZ1B/HIrwZMBqDEBeHEJGH5F/ZuB/D9NwZ9JeHAveHuJeHuvmVcBODWFaDoF7DcJUZ1B/Z1NOD5JeDMrYHErCDuFYZuFaDcBwDQJsHAvOD5NUDMvmVcFKV5BmVoBqD9BsZkFGHAvsZMJeHgvCDkXKDWBmZura";
      $this->prep_conect();
      if (isset($_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['initialize']) && $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['initialize'])  
      { 
          $this->conectDB();
      }
   }

   function init2()
   {
      if (isset($_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['initialize']) && $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['initialize'])  
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp']['initialize'] = false;
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
          if (!$_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['iframe_menu'] && (!isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['sc_outra_jan']) || $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['sc_outra_jan'] != 'form_transfer_rsvp')) 
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
      $con_devel             =  (isset($_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_conexao'])) ? $_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_conexao'] : ""; 
      $perfil_trab           = ""; 
      $this->nm_falta_var    = ""; 
      $this->nm_falta_var_db = ""; 
      $nm_crit_perfil        = false;
      if (isset($_SESSION['scriptcase']['sc_connection']) && !empty($_SESSION['scriptcase']['sc_connection']))
      {
          foreach ($_SESSION['scriptcase']['sc_connection'] as $NM_con_orig => $NM_con_dest)
          {
              if (isset($_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_conexao']) && $_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_conexao'] == $NM_con_orig)
              {
/*NM*/            $_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_conexao'] = $NM_con_dest;
              }
              if (isset($_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_perfil']) && $_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_perfil'] == $NM_con_orig)
              {
/*NM*/            $_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_perfil'] = $NM_con_dest;
              }
              if (isset($_SESSION['scriptcase']['form_transfer_rsvp']['glo_con_' . $NM_con_orig]))
              {
                  $_SESSION['scriptcase']['form_transfer_rsvp']['glo_con_' . $NM_con_orig] = $NM_con_dest;
              }
          }
      }
      if (isset($_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_conexao']))
      {
          db_conect_devel($_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_conexao'], $this->root . $this->path_prod, 'NRSVP115_10_AWS_APP', 2, $this->force_db_utf8); 
          if (empty($_SESSION['scriptcase']['glo_tpbanco']) && empty($_SESSION['scriptcase']['glo_banco']))
          {
              $nm_crit_perfil = true;
          }
      }
      if (isset($_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_perfil']) && !empty($_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_perfil']))
      {
          $perfil_trab = $_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_perfil'];
      }
      elseif (isset($_SESSION['scriptcase']['glo_perfil']) && !empty($_SESSION['scriptcase']['glo_perfil']))
      {
          $perfil_trab = $_SESSION['scriptcase']['glo_perfil'];
      }
      if (!empty($perfil_trab))
      {
          $_SESSION['scriptcase']['glo_senha_protect'] = "";
          carrega_perfil($perfil_trab, $this->path_libs, "S");
          if (empty($_SESSION['scriptcase']['glo_senha_protect']))
          {
              $nm_crit_perfil = true;
          }
      }
      else
      {
          $perfil_trab = $con_devel;
      }
      if (!$_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['embutida_form'] || !$_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['embutida_proc']) 
      {
          if (!isset($_SESSION['vg_cpf'])) 
          {
              $this->nm_falta_var .= "vg_cpf; ";
          }
          if (!isset($_SESSION['vg_evento_id'])) 
          {
              $this->nm_falta_var .= "vg_evento_id; ";
          }
          if (!isset($_SESSION['rsvp_global'])) 
          {
              $this->nm_falta_var .= "rsvp_global; ";
          }
          if (!isset($_SESSION['vg_usuario_id'])) 
          {
              $this->nm_falta_var .= "vg_usuario_id; ";
          }
          if (!isset($_SESSION['vg_cpfseg'])) 
          {
              $this->nm_falta_var .= "vg_cpfseg; ";
          }
          if (!isset($_SESSION['vg_menu_item'])) 
          {
              $this->nm_falta_var .= "vg_menu_item; ";
          }
          if (!isset($_SESSION['parm1'])) 
          {
              $this->nm_falta_var .= "parm1; ";
          }
          if (!isset($_SESSION['vg_tipo_pessoa'])) 
          {
              $this->nm_falta_var .= "vg_tipo_pessoa; ";
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
      if (isset($_SESSION['scriptcase']['glo_db2_autocommit']))
      {
          $this->nm_con_db2['db2_autocommit'] = $_SESSION['scriptcase']['glo_db2_autocommit']; 
      }
      if (isset($_SESSION['scriptcase']['glo_database_encoding']))
      {
          $this->nm_database_encoding = $_SESSION['scriptcase']['glo_database_encoding']; 
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
      if (isset($_SESSION['scriptcase']['glo_use_persistent']))
      {
          $this->nm_con_persistente = $_SESSION['scriptcase']['glo_use_persistent']; 
      }
      if (isset($_SESSION['scriptcase']['glo_use_schema']))
      {
          $this->nm_con_use_schema = $_SESSION['scriptcase']['glo_use_schema']; 
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
      $this->date_delim  = "'";
      $this->date_delim1 = "'";
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_access))
      {
          $this->date_delim  = "#";
          $this->date_delim1 = "#";
      }
      if (isset($_SESSION['scriptcase']['glo_decimal_db']) && !empty($_SESSION['scriptcase']['glo_decimal_db']))
      {
         $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['decimal_db'] = $_SESSION['scriptcase']['glo_decimal_db']; 
      }
      if (isset($_SESSION['scriptcase']['glo_date_separator']) && !empty($_SESSION['scriptcase']['glo_date_separator']))
      {
          $SC_temp = trim($_SESSION['scriptcase']['glo_date_separator']);
          if (strlen($SC_temp) == 2)
          {
              $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['SC_sep_date']  = substr($SC_temp, 0, 1); 
              $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['SC_sep_date1'] = substr($SC_temp, 1, 1); 
          }
          else
          {
              $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['SC_sep_date']  = $SC_temp; 
              $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['SC_sep_date1'] = $SC_temp; 
          }
          $this->date_delim  = $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['SC_sep_date'];
          $this->date_delim1 = $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['SC_sep_date1'];
      }
      if (empty($this->nm_tabela))
      {
          $this->nm_tabela = "transfer_rsvp"; 
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
              }
              if ($nm_crit_perfil)
              {
                  $str_message = str_replace('{var_str_message}', $this->Nm_lang['lang_errm_dbcn_nfnd'] . ' ' . $perfil_trab, $str_message);
                  $str_message = str_replace('{v_str_btn_inside}', "<button class='ui button primary' style='font-size: 16px!important;'><a href='" . $this->path_prod . "' style='color: white;text-decoration:none'><i class='icon database' style='float: left;padding-right: .5rem;'></i>". $this->Nm_lang['lang_errm_dbcn_create'] ."</a></button>", $str_message);
              }
          }
          else
          {
              $str_message = str_replace('{var_str_message}', $this->Nm_lang['lang_errm_dbcn_data'], $str_message);
          }
          $str_message = str_replace('{v_str_btn_inside}', '', $str_message);
          echo $str_message;
          if (!$_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['iframe_menu'] && (!isset($_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['sc_outra_jan']) || $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['sc_outra_jan'] != 'form_transfer_rsvp')) 
          { 
              if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno'])) 
              { 
?>
                  <input type="button" id="sai" onClick="window.location='<?php echo $_SESSION['scriptcase']['nm_sc_retorno'] ?>'; return false" class="scButton_default" value="<?php echo $this->Nm_lang['lang_btns_back'] ?>" title="<?php echo $this->Nm_lang['lang_btns_back_hint'] ?>" style="<?php echo $sCondStyle; ?>vertical-align: middle;display: ''">

<?php
              } 
              elseif(!empty($nm_url_saida)) 
              { 
?>
                  <input type="button" id="sai" onClick="window.location='<?php echo $nm_url_saida ?>'; return false" class="scButton_default" value="<?php echo $this->Nm_lang['lang_btns_exit'] ?>" title="__NM_HINT__ (Alt + Q)" style="<?php echo $sCondStyle; ?>vertical-align: middle;display: ''">

<?php
              } 
          } 
          echo $str_message_end;
          exit ;
      }

      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_db2) && $this->force_db_utf8) {
          putenv('DB2CODEPAGE=1208');
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
// 
  function conectDB()
  {
      $glo_senha_protect = (isset($_SESSION['scriptcase']['glo_senha_protect'])) ? $_SESSION['scriptcase']['glo_senha_protect'] : "S";
      if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && isset($_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_conexao']))
      { 
          $this->Db = db_conect_devel($_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_conexao'], $this->root . $this->path_prod, 'NRSVP115_10_AWS_APP', 1, $this->force_db_utf8); 
      } 
      else 
      { 
         if (!isset($this->nm_con_persistente))
         {
            $this->nm_con_persistente = 'N';
         }
         if (!isset($this->nm_con_db2))
         {
            $this->nm_con_db2 = '';
         }
         if (!isset($this->nm_database_encoding))
         {
            $this->nm_database_encoding = '';
         }
         if ($this->force_db_utf8)
         {
            $this->nm_database_encoding = 'utf8';
         }
         if (!isset($this->nm_arr_db_extra_args))
         {
            $this->nm_arr_db_extra_args = array();
         }
         $this->Db = db_conect($this->nm_tpbanco, $this->nm_servidor, $this->nm_usuario, $this->nm_senha, $this->nm_banco, $glo_senha_protect, "S", $this->nm_con_persistente, $this->nm_con_db2, $this->nm_database_encoding, $this->nm_arr_db_extra_args); 
      } 
      if (in_array(strtolower($this->nm_tpbanco), $this->nm_bases_ibase))
      {
          if (function_exists('ibase_timefmt'))
          {
              ibase_timefmt('%Y-%m-%d %H:%M:%S');
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
          $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['decimal_db'] = "."; 
      } 
  }

  function setConnectionHash() {
    if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && isset($_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_conexao']) && !empty($_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_conexao'])) {
      list($connectionDbms, $connectionHost, $connectionUser, $connectionPassword, $connectionDatabase) = db_conect_devel($_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_conexao'], $this->root . $this->path_prod, 'NRSVP115_10_AWS_APP', 1, $this->force_db_utf8);
    }
    else {
      $connectionDbms     = $this->nm_tpbanco;
      $connectionHost     = $this->nm_servidor;
      $connectionUser     = $this->nm_usuario;
      $connectionPassword = $this->nm_senha;
      $connectionDatabase = $this->nm_banco;
    }

    $this->connectionHash = "{$connectionDbms}_SC_" . md5("{$connectionHost}_SC_{$connectionUser}_SC_{$connectionPassword}_SC_{$connectionDatabase}");
  } // setConnectionHash
// 

   function regionalDefault($sConfReg = '')
   {
      if ('' == $sConfReg)
      {
         $sConfReg = $this->str_conf_reg;
      }

      $_SESSION['scriptcase']['reg_conf']['date_format']           = (isset($this->Nm_conf_reg[$sConfReg]['data_format']))              ?  $this->Nm_conf_reg[$sConfReg]['data_format']                  : "ddmmyyyy";
      $_SESSION['scriptcase']['reg_conf']['date_sep']              = (isset($this->Nm_conf_reg[$sConfReg]['data_sep']))                 ?  $this->Nm_conf_reg[$sConfReg]['data_sep']                     : "/";
      $_SESSION['scriptcase']['reg_conf']['date_week_ini']         = (isset($this->Nm_conf_reg[$sConfReg]['prim_dia_sema']))            ?  $this->Nm_conf_reg[$sConfReg]['prim_dia_sema']                : "SU";
      $_SESSION['scriptcase']['reg_conf']['time_format']           = (isset($this->Nm_conf_reg[$sConfReg]['hora_format']))              ?  $this->Nm_conf_reg[$sConfReg]['hora_format']                  : "hhiiss";
      $_SESSION['scriptcase']['reg_conf']['time_sep']              = (isset($this->Nm_conf_reg[$sConfReg]['hora_sep']))                 ?  $this->Nm_conf_reg[$sConfReg]['hora_sep']                     : ":";
      $_SESSION['scriptcase']['reg_conf']['time_pos_ampm']         = (isset($this->Nm_conf_reg[$sConfReg]['hora_pos_ampm']))            ?  $this->Nm_conf_reg[$sConfReg]['hora_pos_ampm']                : "right_without_space";
      $_SESSION['scriptcase']['reg_conf']['time_simb_am']          = (isset($this->Nm_conf_reg[$sConfReg]['hora_simbolo_am']))          ?  $this->Nm_conf_reg[$sConfReg]['hora_simbolo_am']              : "am";
      $_SESSION['scriptcase']['reg_conf']['time_simb_pm']          = (isset($this->Nm_conf_reg[$sConfReg]['hora_simbolo_pm']))          ?  $this->Nm_conf_reg[$sConfReg]['hora_simbolo_pm']              : "pm";
      $_SESSION['scriptcase']['reg_conf']['simb_neg']              = (isset($this->Nm_conf_reg[$sConfReg]['num_sinal_neg']))            ?  $this->Nm_conf_reg[$sConfReg]['num_sinal_neg']                : "-";
      $_SESSION['scriptcase']['reg_conf']['grup_num']              = (isset($this->Nm_conf_reg[$sConfReg]['num_sep_agr']))              ?  $this->Nm_conf_reg[$sConfReg]['num_sep_agr']                  : ".";
      $_SESSION['scriptcase']['reg_conf']['dec_num']               = (isset($this->Nm_conf_reg[$sConfReg]['num_sep_dec']))              ?  $this->Nm_conf_reg[$sConfReg]['num_sep_dec']                  : ",";
      $_SESSION['scriptcase']['reg_conf']['neg_num']               = (isset($this->Nm_conf_reg[$sConfReg]['num_format_num_neg']))       ?  $this->Nm_conf_reg[$sConfReg]['num_format_num_neg']           : 2;
      $_SESSION['scriptcase']['reg_conf']['monet_simb']            = (isset($this->Nm_conf_reg[$sConfReg]['unid_mont_simbolo']))        ?  $this->Nm_conf_reg[$sConfReg]['unid_mont_simbolo']            : "R$";
      $_SESSION['scriptcase']['reg_conf']['monet_f_pos']           = (isset($this->Nm_conf_reg[$sConfReg]['unid_mont_format_num_pos'])) ?  $this->Nm_conf_reg[$sConfReg]['unid_mont_format_num_pos']     : 3;
      $_SESSION['scriptcase']['reg_conf']['monet_f_neg']           = (isset($this->Nm_conf_reg[$sConfReg]['unid_mont_format_num_neg'])) ?  $this->Nm_conf_reg[$sConfReg]['unid_mont_format_num_neg']     : 13;
      $_SESSION['scriptcase']['reg_conf']['grup_val']              = (isset($this->Nm_conf_reg[$sConfReg]['unid_mont_sep_agr']))        ?  $this->Nm_conf_reg[$sConfReg]['unid_mont_sep_agr']            : ".";
      $_SESSION['scriptcase']['reg_conf']['dec_val']               = (isset($this->Nm_conf_reg[$sConfReg]['unid_mont_sep_dec']))        ?  $this->Nm_conf_reg[$sConfReg]['unid_mont_sep_dec']            : ",";
      $_SESSION['scriptcase']['reg_conf']['num_group_digit']       = (isset($this->Nm_conf_reg[$sConfReg]['num_group_digit']))          ?  $this->Nm_conf_reg[$sConfReg]['num_group_digit']              : "1";
      $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'] = (isset($this->Nm_conf_reg[$sConfReg]['unid_mont_group_digit']))    ?  $this->Nm_conf_reg[$sConfReg]['unid_mont_group_digit']        : "1";
      $_SESSION['scriptcase']['reg_conf']['html_dir']              = (isset($this->Nm_conf_reg[$sConfReg]['ger_ltr_rtl']))              ?  " DIR='" . $this->Nm_conf_reg[$sConfReg]['ger_ltr_rtl'] . "'" : "";
      $_SESSION['scriptcase']['reg_conf']['css_dir']               = (isset($this->Nm_conf_reg[$sConfReg]['ger_ltr_rtl']))              ?  $this->Nm_conf_reg[$sConfReg]['ger_ltr_rtl'] : "LTR";
      if ('' == $_SESSION['scriptcase']['reg_conf']['num_group_digit'])
      {
          $_SESSION['scriptcase']['reg_conf']['num_group_digit'] = '1';
      }
      if ('' == $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'])
      {
          $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit'] = '1';
      }
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
           if (isset($_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['SC_sep_date']) && !empty($_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['SC_sep_date']))
           {
               $delim  = $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['SC_sep_date'];
               $delim1 = $_SESSION['sc_session'][$this->sc_page]['form_transfer_rsvp']['SC_sep_date1'];
           }
           return $delim . $var . $delim1;
       }
       else
       {
           return $var;
       }
   } // sc_Sql_Protect
}
//===============================================================================
class form_transfer_rsvp_edit
{
    var $contr_form_transfer_rsvp;
    function inicializa()
    {
        global $nm_opc_lookup, $nm_opc_php, $script_case_init;
        require_once("form_transfer_rsvp_apl.php");
        $this->contr_form_transfer_rsvp = new form_transfer_rsvp_apl();
    }
}
if (!function_exists("NM_is_utf8"))
{
    include_once("../_lib/lib/php/nm_utf8.php");
}
ob_start();
//
//----------------  
//
    $_SESSION['scriptcase']['form_transfer_rsvp']['contr_erro'] = 'off';
    if (!function_exists("NM_is_utf8"))
    {
        include_once("../_lib/lib/php/nm_utf8.php");
    }
    if (!function_exists("SC_dir_app_ini"))
    {
        include_once("../_lib/lib/php/nm_ctrl_app_name.php");
    }
    SC_dir_app_ini('NRSVP115_10_AWS_APP');
    $sc_conv_var = array();
    if (!empty($_FILES))
    {
        foreach ($_FILES as $nmgp_campo => $nmgp_valores)
        {
             if (isset($sc_conv_var[$nmgp_campo]))
             {
                 $nmgp_campo = $sc_conv_var[$nmgp_campo];
             }
             elseif (isset($sc_conv_var[strtolower($nmgp_campo)]))
             {
                 $nmgp_campo = $sc_conv_var[strtolower($nmgp_campo)];
             }
             $tmp_scfile_name     = $nmgp_campo . "_scfile_name";
             $tmp_scfile_type     = $nmgp_campo . "_scfile_type";
             $$nmgp_campo = is_array($nmgp_valores['tmp_name']) ? $nmgp_valores['tmp_name'][0] : $nmgp_valores['tmp_name'];
             $$tmp_scfile_type   = is_array($nmgp_valores['type'])     ? $nmgp_valores['type'][0]     : $nmgp_valores['type'];
             $$tmp_scfile_name   = is_array($nmgp_valores['name'])     ? $nmgp_valores['name'][0]     : $nmgp_valores['name'];
        }
    }
    $Sc_lig_md5 = false;
    $Sem_Session = (!isset($_SESSION['sc_session'])) ? true : false;
    $_SESSION['scriptcase']['sem_session'] = false;
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
             if (isset($sc_conv_var[$nmgp_var]))
             {
                 $nmgp_var = $sc_conv_var[$nmgp_var];
             }
             elseif (isset($sc_conv_var[strtolower($nmgp_var)]))
             {
                 $nmgp_var = $sc_conv_var[strtolower($nmgp_var)];
             }
             nm_limpa_str_form_transfer_rsvp($nmgp_val);
             $nmgp_val = NM_decode_input($nmgp_val);
             $$nmgp_var = $nmgp_val;
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
             if (isset($sc_conv_var[$nmgp_var]))
             {
                 $nmgp_var = $sc_conv_var[$nmgp_var];
             }
             elseif (isset($sc_conv_var[strtolower($nmgp_var)]))
             {
                 $nmgp_var = $sc_conv_var[strtolower($nmgp_var)];
             }
             nm_limpa_str_form_transfer_rsvp($nmgp_val);
             $nmgp_val = NM_decode_input($nmgp_val);
             $$nmgp_var = $nmgp_val;
        }
    }
    if (!isset($_SERVER['HTTP_REFERER']) || (!isset($nmgp_parms) && !isset($script_case_init) && !isset($_POST['rs']) && !isset($nmgp_start) ))
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
        elseif (is_file($root . $_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_path_imag_temp'] . "/sc_apl_default_NRSVP115_10_AWS_APP.txt")) {
            $apl_def = explode(",", file_get_contents($root . $_SESSION['scriptcase']['form_transfer_rsvp']['glo_nm_path_imag_temp'] . "/sc_apl_default_NRSVP115_10_AWS_APP.txt"));
        }
        if (isset($apl_def)) {
            if ($apl_def[0] != "form_transfer_rsvp") {
                $_SESSION['scriptcase']['sem_session'] = true;
                if (strtolower(substr($apl_def[0], 0 , 7)) == "http://" || strtolower(substr($apl_def[0], 0 , 8)) == "https://" || substr($apl_def[0], 0 , 2) == "..") {
                    $_SESSION['scriptcase']['form_transfer_rsvp']['session_timeout']['redir'] = $apl_def[0];
                }
                else {
                    $_SESSION['scriptcase']['form_transfer_rsvp']['session_timeout']['redir'] = $path_aplicacao . "/" . SC_dir_app_name($apl_def[0]) . "/index.php";
                }
                $Redir_tp = (isset($apl_def[1])) ? trim(strtoupper($apl_def[1])) : "";
                $_SESSION['scriptcase']['form_transfer_rsvp']['session_timeout']['redir_tp'] = $Redir_tp;
            }
            if (isset($_COOKIE['sc_actual_lang_NRSVP115_10_AWS_APP'])) {
                $_SESSION['scriptcase']['form_transfer_rsvp']['session_timeout']['lang'] = $_COOKIE['sc_actual_lang_NRSVP115_10_AWS_APP'];
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
    if (isset($SC_where_pdf) && !empty($SC_where_pdf))
    {
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['where_filter'] = $SC_where_pdf;
    }

    if (isset($_POST['rs']) && !is_array($_POST['rs']) && 'ajax_' == substr($_POST['rs'], 0, 5) && isset($_POST['rsargs']) && !empty($_POST['rsargs']) && !isset($_SESSION['scriptcase']['form_transfer_rsvp']['session_timeout']['redir']))
    {
        if ('ajax_form_transfer_rsvp_validate_tra_id_evento' == $_POST['rs'])
        {
            $tra_id_evento = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_evento_dsc' == $_POST['rs'])
        {
            $evento_dsc = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_cpf_particip' == $_POST['rs'])
        {
            $tra_cpf_particip = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tipo_dsc' == $_POST['rs'])
        {
            $tipo_dsc = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_id_usuario' == $_POST['rs'])
        {
            $tra_id_usuario = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_atendente_dsc' == $_POST['rs'])
        {
            $atendente_dsc = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_tipo' == $_POST['rs'])
        {
            $tra_tipo = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_id_hotel' == $_POST['rs'])
        {
            $tra_id_hotel = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_hotel_dsc' == $_POST['rs'])
        {
            $hotel_dsc = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_id_hotel_out' == $_POST['rs'])
        {
            $tra_id_hotel_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_hotel_dsc_out' == $_POST['rs'])
        {
            $hotel_dsc_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_enviar_app' == $_POST['rs'])
        {
            $enviar_app = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_status' == $_POST['rs'])
        {
            $tra_status = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_ult_trecho' == $_POST['rs'])
        {
            $ult_trecho = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_cia_ida' == $_POST['rs'])
        {
            $tra_cia_ida = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_cia_ida_dsc' == $_POST['rs'])
        {
            $cia_ida_dsc = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_numvoo_ida' == $_POST['rs'])
        {
            $tra_numvoo_ida = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_origem_ida' == $_POST['rs'])
        {
            $tra_origem_ida = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_origem_ida_dsc' == $_POST['rs'])
        {
            $origem_ida_dsc = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_destino_ida' == $_POST['rs'])
        {
            $tra_destino_ida = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_destino_ida_dsc' == $_POST['rs'])
        {
            $destino_ida_dsc = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_dt_saida_ida' == $_POST['rs'])
        {
            $tra_dt_saida_ida = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_hr_saida_ida' == $_POST['rs'])
        {
            $tra_hr_saida_ida = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_dt_chegada_ida' == $_POST['rs'])
        {
            $tra_dt_chegada_ida = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_hr_chegada_ida' == $_POST['rs'])
        {
            $tra_hr_chegada_ida = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_localizador_ida' == $_POST['rs'])
        {
            $tra_localizador_ida = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_eticket_ida' == $_POST['rs'])
        {
            $tra_eticket_ida = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_flag_ida' == $_POST['rs'])
        {
            $tra_flag_ida = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_cia_volta' == $_POST['rs'])
        {
            $tra_cia_volta = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_cia_volta_dsc' == $_POST['rs'])
        {
            $cia_volta_dsc = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_numvoo_volta' == $_POST['rs'])
        {
            $tra_numvoo_volta = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_origem_volta' == $_POST['rs'])
        {
            $tra_origem_volta = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_origem_volta_dsc' == $_POST['rs'])
        {
            $origem_volta_dsc = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_destino_volta' == $_POST['rs'])
        {
            $tra_destino_volta = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_destino_volta_dsc' == $_POST['rs'])
        {
            $destino_volta_dsc = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_dt_saida_volta' == $_POST['rs'])
        {
            $tra_dt_saida_volta = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_hr_saida_volta' == $_POST['rs'])
        {
            $tra_hr_saida_volta = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_dt_chegada_volta' == $_POST['rs'])
        {
            $tra_dt_chegada_volta = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_hr_chegada_volta' == $_POST['rs'])
        {
            $tra_hr_chegada_volta = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_localizador_volta' == $_POST['rs'])
        {
            $tra_localizador_volta = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_eticket_volta' == $_POST['rs'])
        {
            $tra_eticket_volta = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_intervalo' == $_POST['rs'])
        {
            $tra_intervalo = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_hrtransout' == $_POST['rs'])
        {
            $tra_hrtransout = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_flag_volta' == $_POST['rs'])
        {
            $tra_flag_volta = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_dt_chegada_proprio' == $_POST['rs'])
        {
            $tra_dt_chegada_proprio = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_hr_chegada_proprio' == $_POST['rs'])
        {
            $tra_hr_chegada_proprio = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_flag_proprio' == $_POST['rs'])
        {
            $tra_flag_proprio = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_dt_ida_local' == $_POST['rs'])
        {
            $tra_dt_ida_local = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_hr_ida_local' == $_POST['rs'])
        {
            $tra_hr_ida_local = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_origem_ida_local' == $_POST['rs'])
        {
            $tra_origem_ida_local = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_destino_ida_local' == $_POST['rs'])
        {
            $tra_destino_ida_local = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_flag_ida_local' == $_POST['rs'])
        {
            $tra_flag_ida_local = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_dt_volta_local' == $_POST['rs'])
        {
            $tra_dt_volta_local = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_hr_volta_local' == $_POST['rs'])
        {
            $tra_hr_volta_local = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_origem_volta_local' == $_POST['rs'])
        {
            $tra_origem_volta_local = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_destino_volta_local' == $_POST['rs'])
        {
            $tra_destino_volta_local = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_flag_volta_local' == $_POST['rs'])
        {
            $tra_flag_volta_local = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_observacao' == $_POST['rs'])
        {
            $tra_observacao = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_ativo' == $_POST['rs'])
        {
            $tra_ativo = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tra_dt_alteracao' == $_POST['rs'])
        {
            $tra_dt_alteracao = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_cpf_del' == $_POST['rs'])
        {
            $cpf_del = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_sql_log' == $_POST['rs'])
        {
            $sql_log = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_titulo_api' == $_POST['rs'])
        {
            $titulo_api = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_descricao_api' == $_POST['rs'])
        {
            $descricao_api = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_codigo_api' == $_POST['rs'])
        {
            $codigo_api = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tipo_api' == $_POST['rs'])
        {
            $tipo_api = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_status_api' == $_POST['rs'])
        {
            $status_api = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_valido_de_api' == $_POST['rs'])
        {
            $valido_de_api = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_valido_ate_api' == $_POST['rs'])
        {
            $valido_ate_api = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_local_de_origem_api' == $_POST['rs'])
        {
            $local_de_origem_api = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_latitude_origem_api' == $_POST['rs'])
        {
            $latitude_origem_api = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_longitude_origem_api' == $_POST['rs'])
        {
            $longitude_origem_api = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_hr_saida_origem_api' == $_POST['rs'])
        {
            $hr_saida_origem_api = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_local_destino_api' == $_POST['rs'])
        {
            $local_destino_api = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_latitude_destino_api' == $_POST['rs'])
        {
            $latitude_destino_api = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_longitude_destino_api' == $_POST['rs'])
        {
            $longitude_destino_api = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_veiculo_api' == $_POST['rs'])
        {
            $veiculo_api = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_companhia_api' == $_POST['rs'])
        {
            $companhia_api = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_nome_motorista_api' == $_POST['rs'])
        {
            $nome_motorista_api = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_contato_motorista_api' == $_POST['rs'])
        {
            $contato_motorista_api = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_matricula_api' == $_POST['rs'])
        {
            $matricula_api = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_duracao_percurso_api' == $_POST['rs'])
        {
            $duracao_percurso_api = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_comodidades_api' == $_POST['rs'])
        {
            $comodidades_api = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_observacao_api' == $_POST['rs'])
        {
            $observacao_api = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_placa_veiculo_api' == $_POST['rs'])
        {
            $placa_veiculo_api = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_id_evento_app' == $_POST['rs'])
        {
            $id_evento_app = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_id_participante_app' == $_POST['rs'])
        {
            $id_participante_app = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_id_voucher_app' == $_POST['rs'])
        {
            $id_voucher_app = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_titulo_api_out' == $_POST['rs'])
        {
            $titulo_api_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_descricao_api_out' == $_POST['rs'])
        {
            $descricao_api_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_codigo_api_out' == $_POST['rs'])
        {
            $codigo_api_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_tipo_api_out' == $_POST['rs'])
        {
            $tipo_api_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_status_api_out' == $_POST['rs'])
        {
            $status_api_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_valido_de_api_out' == $_POST['rs'])
        {
            $valido_de_api_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_valido_ate_api_out' == $_POST['rs'])
        {
            $valido_ate_api_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_local_de_origem_api_out' == $_POST['rs'])
        {
            $local_de_origem_api_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_latitude_origem_api_out' == $_POST['rs'])
        {
            $latitude_origem_api_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_longitude_origem_api_out' == $_POST['rs'])
        {
            $longitude_origem_api_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_hr_saida_origem_api_out' == $_POST['rs'])
        {
            $hr_saida_origem_api_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_local_de_destino_api_out' == $_POST['rs'])
        {
            $local_de_destino_api_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_latitude_destino_api_out' == $_POST['rs'])
        {
            $latitude_destino_api_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_longitude_destino_api_out' == $_POST['rs'])
        {
            $longitude_destino_api_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_veiculo_api_out' == $_POST['rs'])
        {
            $veiculo_api_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_companhia_api_out' == $_POST['rs'])
        {
            $companhia_api_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_nome_motorista_api_out' == $_POST['rs'])
        {
            $nome_motorista_api_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_contato_motorista_api_out' == $_POST['rs'])
        {
            $contato_motorista_api_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_matricula_api_out' == $_POST['rs'])
        {
            $matricula_api_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_duracao_percurso_api_out' == $_POST['rs'])
        {
            $duracao_percurso_api_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_comodidades_api_out' == $_POST['rs'])
        {
            $comodidades_api_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_observacao_api_out' == $_POST['rs'])
        {
            $observacao_api_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_placa_veiculo_api_out' == $_POST['rs'])
        {
            $placa_veiculo_api_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_id_evento_app_out' == $_POST['rs'])
        {
            $id_evento_app_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_id_participante_app_out' == $_POST['rs'])
        {
            $id_participante_app_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_validate_id_voucher_app_out' == $_POST['rs'])
        {
            $id_voucher_app_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_event_enviar_app_onclick' == $_POST['rs'])
        {
            $enviar_app = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_event_local_de_destino_api_out_onclick' == $_POST['rs'])
        {
            $local_de_destino_api_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $latitude_destino_api_out = NM_utf8_urldecode($_POST['rsargs'][1]);
            $longitude_destino_api_out = NM_utf8_urldecode($_POST['rsargs'][2]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][3]);
        }
        if ('ajax_form_transfer_rsvp_event_local_de_origem_api_onchange' == $_POST['rs'])
        {
            $local_de_origem_api = NM_utf8_urldecode($_POST['rsargs'][0]);
            $latitude_origem_api = NM_utf8_urldecode($_POST['rsargs'][1]);
            $longitude_origem_api = NM_utf8_urldecode($_POST['rsargs'][2]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][3]);
        }
        if ('ajax_form_transfer_rsvp_event_local_de_origem_api_out_onchange' == $_POST['rs'])
        {
            $local_de_origem_api_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $latitude_origem_api_out = NM_utf8_urldecode($_POST['rsargs'][1]);
            $longitude_origem_api_out = NM_utf8_urldecode($_POST['rsargs'][2]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][3]);
        }
        if ('ajax_form_transfer_rsvp_event_local_destino_api_onchange' == $_POST['rs'])
        {
            $local_destino_api = NM_utf8_urldecode($_POST['rsargs'][0]);
            $latitude_destino_api = NM_utf8_urldecode($_POST['rsargs'][1]);
            $longitude_destino_api = NM_utf8_urldecode($_POST['rsargs'][2]);
            $longitude_origem_api = NM_utf8_urldecode($_POST['rsargs'][3]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][4]);
        }
        if ('ajax_form_transfer_rsvp_event_tra_flag_ida_local_onchange' == $_POST['rs'])
        {
            $tra_flag_ida_local = NM_utf8_urldecode($_POST['rsargs'][0]);
            $tra_flag_volta = NM_utf8_urldecode($_POST['rsargs'][1]);
            $tra_flag_ida = NM_utf8_urldecode($_POST['rsargs'][2]);
            $tra_flag_proprio = NM_utf8_urldecode($_POST['rsargs'][3]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][4]);
        }
        if ('ajax_form_transfer_rsvp_event_tra_flag_ida_onchange' == $_POST['rs'])
        {
            $tra_flag_ida = NM_utf8_urldecode($_POST['rsargs'][0]);
            $tra_flag_volta = NM_utf8_urldecode($_POST['rsargs'][1]);
            $tra_flag_proprio = NM_utf8_urldecode($_POST['rsargs'][2]);
            $tra_flag_ida_local = NM_utf8_urldecode($_POST['rsargs'][3]);
            $tra_flag_volta_local = NM_utf8_urldecode($_POST['rsargs'][4]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][5]);
        }
        if ('ajax_form_transfer_rsvp_event_tra_flag_proprio_onchange' == $_POST['rs'])
        {
            $tra_flag_proprio = NM_utf8_urldecode($_POST['rsargs'][0]);
            $tra_flag_volta = NM_utf8_urldecode($_POST['rsargs'][1]);
            $tra_flag_ida = NM_utf8_urldecode($_POST['rsargs'][2]);
            $tra_flag_ida_local = NM_utf8_urldecode($_POST['rsargs'][3]);
            $tra_flag_volta_local = NM_utf8_urldecode($_POST['rsargs'][4]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][5]);
        }
        if ('ajax_form_transfer_rsvp_event_tra_flag_volta_local_onchange' == $_POST['rs'])
        {
            $tra_flag_volta = NM_utf8_urldecode($_POST['rsargs'][0]);
            $tra_flag_ida = NM_utf8_urldecode($_POST['rsargs'][1]);
            $tra_flag_proprio = NM_utf8_urldecode($_POST['rsargs'][2]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][3]);
        }
        if ('ajax_form_transfer_rsvp_event_tra_flag_volta_onchange' == $_POST['rs'])
        {
            $tra_flag_volta = NM_utf8_urldecode($_POST['rsargs'][0]);
            $tra_flag_ida = NM_utf8_urldecode($_POST['rsargs'][1]);
            $tra_flag_proprio = NM_utf8_urldecode($_POST['rsargs'][2]);
            $tra_flag_ida_local = NM_utf8_urldecode($_POST['rsargs'][3]);
            $tra_flag_volta_local = NM_utf8_urldecode($_POST['rsargs'][4]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][5]);
        }
        if ('ajax_form_transfer_rsvp_event_tra_id_hotel_onchange' == $_POST['rs'])
        {
            $tra_id_hotel = NM_utf8_urldecode($_POST['rsargs'][0]);
            $hotel_dsc = NM_utf8_urldecode($_POST['rsargs'][1]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][2]);
        }
        if ('ajax_form_transfer_rsvp_event_tra_id_hotel_out_onchange' == $_POST['rs'])
        {
            $tra_id_hotel_out = NM_utf8_urldecode($_POST['rsargs'][0]);
            $hotel_dsc_out = NM_utf8_urldecode($_POST['rsargs'][1]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][2]);
        }
        if ('ajax_form_transfer_rsvp_event_tra_intervalo_onchange' == $_POST['rs'])
        {
            $tra_hr_saida_volta = NM_utf8_urldecode($_POST['rsargs'][0]);
            $tra_intervalo = NM_utf8_urldecode($_POST['rsargs'][1]);
            $tra_hrtransout = NM_utf8_urldecode($_POST['rsargs'][2]);
            $hr_saida_origem_api_out = NM_utf8_urldecode($_POST['rsargs'][3]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][4]);
        }
        if ('ajax_form_transfer_rsvp_event_tra_status_onfocus' == $_POST['rs'])
        {
            $tra_tipo = NM_utf8_urldecode($_POST['rsargs'][0]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][1]);
        }
        if ('ajax_form_transfer_rsvp_event_tra_tipo_onchange' == $_POST['rs'])
        {
            $tra_tipo = NM_utf8_urldecode($_POST['rsargs'][0]);
            $tra_dt_chegada_proprio = NM_utf8_urldecode($_POST['rsargs'][1]);
            $tra_hr_chegada_proprio = NM_utf8_urldecode($_POST['rsargs'][2]);
            $tra_dt_ida_local = NM_utf8_urldecode($_POST['rsargs'][3]);
            $tra_hr_ida_local = NM_utf8_urldecode($_POST['rsargs'][4]);
            $tra_dt_volta_local = NM_utf8_urldecode($_POST['rsargs'][5]);
            $tra_hr_volta_local = NM_utf8_urldecode($_POST['rsargs'][6]);
            $tra_origem_ida_local = NM_utf8_urldecode($_POST['rsargs'][7]);
            $tra_destino_ida_local = NM_utf8_urldecode($_POST['rsargs'][8]);
            $tra_origem_volta_local = NM_utf8_urldecode($_POST['rsargs'][9]);
            $tra_destino_volta_local = NM_utf8_urldecode($_POST['rsargs'][10]);
            $tra_flag_proprio = NM_utf8_urldecode($_POST['rsargs'][11]);
            $tra_flag_volta_local = NM_utf8_urldecode($_POST['rsargs'][12]);
            $enviar_app = NM_utf8_urldecode($_POST['rsargs'][13]);
            $titulo_api = NM_utf8_urldecode($_POST['rsargs'][14]);
            $descricao_api = NM_utf8_urldecode($_POST['rsargs'][15]);
            $codigo_api = NM_utf8_urldecode($_POST['rsargs'][16]);
            $tipo_api = NM_utf8_urldecode($_POST['rsargs'][17]);
            $status_api = NM_utf8_urldecode($_POST['rsargs'][18]);
            $valido_de_api = NM_utf8_urldecode($_POST['rsargs'][19]);
            $valido_ate_api = NM_utf8_urldecode($_POST['rsargs'][20]);
            $local_de_origem_api = NM_utf8_urldecode($_POST['rsargs'][21]);
            $latitude_origem_api = NM_utf8_urldecode($_POST['rsargs'][22]);
            $longitude_origem_api = NM_utf8_urldecode($_POST['rsargs'][23]);
            $hr_saida_origem_api = NM_utf8_urldecode($_POST['rsargs'][24]);
            $veiculo_api = NM_utf8_urldecode($_POST['rsargs'][25]);
            $companhia_api = NM_utf8_urldecode($_POST['rsargs'][26]);
            $nome_motorista_api = NM_utf8_urldecode($_POST['rsargs'][27]);
            $matricula_api = NM_utf8_urldecode($_POST['rsargs'][28]);
            $duracao_percurso_api = NM_utf8_urldecode($_POST['rsargs'][29]);
            $comodidades_api = NM_utf8_urldecode($_POST['rsargs'][30]);
            $observacao_api = NM_utf8_urldecode($_POST['rsargs'][31]);
            $placa_veiculo_api = NM_utf8_urldecode($_POST['rsargs'][32]);
            $titulo_api_out = NM_utf8_urldecode($_POST['rsargs'][33]);
            $descricao_api_out = NM_utf8_urldecode($_POST['rsargs'][34]);
            $codigo_api_out = NM_utf8_urldecode($_POST['rsargs'][35]);
            $tipo_api_out = NM_utf8_urldecode($_POST['rsargs'][36]);
            $status_api_out = NM_utf8_urldecode($_POST['rsargs'][37]);
            $valido_de_api_out = NM_utf8_urldecode($_POST['rsargs'][38]);
            $valido_ate_api_out = NM_utf8_urldecode($_POST['rsargs'][39]);
            $local_de_origem_api_out = NM_utf8_urldecode($_POST['rsargs'][40]);
            $latitude_origem_api_out = NM_utf8_urldecode($_POST['rsargs'][41]);
            $longitude_origem_api_out = NM_utf8_urldecode($_POST['rsargs'][42]);
            $hr_saida_origem_api_out = NM_utf8_urldecode($_POST['rsargs'][43]);
            $veiculo_api_out = NM_utf8_urldecode($_POST['rsargs'][44]);
            $companhia_api_out = NM_utf8_urldecode($_POST['rsargs'][45]);
            $nome_motorista_api_out = NM_utf8_urldecode($_POST['rsargs'][46]);
            $matricula_api_out = NM_utf8_urldecode($_POST['rsargs'][47]);
            $duracao_percurso_api_out = NM_utf8_urldecode($_POST['rsargs'][48]);
            $comodidades_api_out = NM_utf8_urldecode($_POST['rsargs'][49]);
            $observacao_api_out = NM_utf8_urldecode($_POST['rsargs'][50]);
            $placa_veiculo_api_out = NM_utf8_urldecode($_POST['rsargs'][51]);
            $tra_cia_ida = NM_utf8_urldecode($_POST['rsargs'][52]);
            $tra_numvoo_ida = NM_utf8_urldecode($_POST['rsargs'][53]);
            $tra_origem_ida = NM_utf8_urldecode($_POST['rsargs'][54]);
            $tra_destino_ida = NM_utf8_urldecode($_POST['rsargs'][55]);
            $tra_dt_saida_ida = NM_utf8_urldecode($_POST['rsargs'][56]);
            $tra_hr_saida_ida = NM_utf8_urldecode($_POST['rsargs'][57]);
            $tra_dt_chegada_ida = NM_utf8_urldecode($_POST['rsargs'][58]);
            $tra_hr_chegada_ida = NM_utf8_urldecode($_POST['rsargs'][59]);
            $tra_localizador_ida = NM_utf8_urldecode($_POST['rsargs'][60]);
            $cia_ida_dsc = NM_utf8_urldecode($_POST['rsargs'][61]);
            $destino_ida_dsc = NM_utf8_urldecode($_POST['rsargs'][62]);
            $origem_ida_dsc = NM_utf8_urldecode($_POST['rsargs'][63]);
            $tra_flag_ida = NM_utf8_urldecode($_POST['rsargs'][64]);
            $tra_eticket_ida = NM_utf8_urldecode($_POST['rsargs'][65]);
            $tra_cia_volta = NM_utf8_urldecode($_POST['rsargs'][66]);
            $tra_numvoo_volta = NM_utf8_urldecode($_POST['rsargs'][67]);
            $tra_origem_volta = NM_utf8_urldecode($_POST['rsargs'][68]);
            $tra_destino_volta = NM_utf8_urldecode($_POST['rsargs'][69]);
            $tra_dt_saida_volta = NM_utf8_urldecode($_POST['rsargs'][70]);
            $tra_hr_saida_volta = NM_utf8_urldecode($_POST['rsargs'][71]);
            $tra_dt_chegada_volta = NM_utf8_urldecode($_POST['rsargs'][72]);
            $tra_hr_chegada_volta = NM_utf8_urldecode($_POST['rsargs'][73]);
            $tra_localizador_volta = NM_utf8_urldecode($_POST['rsargs'][74]);
            $tra_eticket_volta = NM_utf8_urldecode($_POST['rsargs'][75]);
            $cia_volta_dsc = NM_utf8_urldecode($_POST['rsargs'][76]);
            $destino_volta_dsc = NM_utf8_urldecode($_POST['rsargs'][77]);
            $origem_volta_dsc = NM_utf8_urldecode($_POST['rsargs'][78]);
            $tra_flag_volta = NM_utf8_urldecode($_POST['rsargs'][79]);
            $tra_id_hotel = NM_utf8_urldecode($_POST['rsargs'][80]);
            $hotel_dsc = NM_utf8_urldecode($_POST['rsargs'][81]);
            $tra_id_hotel_out = NM_utf8_urldecode($_POST['rsargs'][82]);
            $hotel_dsc_out = NM_utf8_urldecode($_POST['rsargs'][83]);
            $local_destino_api = NM_utf8_urldecode($_POST['rsargs'][84]);
            $latitude_destino_api = NM_utf8_urldecode($_POST['rsargs'][85]);
            $longitude_destino_api = NM_utf8_urldecode($_POST['rsargs'][86]);
            $tra_hrtransout = NM_utf8_urldecode($_POST['rsargs'][87]);
            $local_de_destino_api_out = NM_utf8_urldecode($_POST['rsargs'][88]);
            $latitude_destino_api_out = NM_utf8_urldecode($_POST['rsargs'][89]);
            $longitude_destino_api_out = NM_utf8_urldecode($_POST['rsargs'][90]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][91]);
        }
        if ('ajax_form_transfer_rsvp_event_tra_ult_trecho_volta_onchange' == $_POST['rs'])
        {
            $tra_tipo = NM_utf8_urldecode($_POST['rsargs'][0]);
            $tra_cia_ida = NM_utf8_urldecode($_POST['rsargs'][1]);
            $tra_numvoo_ida = NM_utf8_urldecode($_POST['rsargs'][2]);
            $tra_origem_ida = NM_utf8_urldecode($_POST['rsargs'][3]);
            $tra_destino_ida = NM_utf8_urldecode($_POST['rsargs'][4]);
            $tra_dt_saida_ida = NM_utf8_urldecode($_POST['rsargs'][5]);
            $tra_hr_saida_ida = NM_utf8_urldecode($_POST['rsargs'][6]);
            $tra_dt_chegada_ida = NM_utf8_urldecode($_POST['rsargs'][7]);
            $tra_hr_chegada_ida = NM_utf8_urldecode($_POST['rsargs'][8]);
            $tra_localizador_ida = NM_utf8_urldecode($_POST['rsargs'][9]);
            $tra_eticket_ida = NM_utf8_urldecode($_POST['rsargs'][10]);
            $cia_ida_dsc = NM_utf8_urldecode($_POST['rsargs'][11]);
            $origem_ida_dsc = NM_utf8_urldecode($_POST['rsargs'][12]);
            $destino_ida_dsc = NM_utf8_urldecode($_POST['rsargs'][13]);
            $tra_cia_volta = NM_utf8_urldecode($_POST['rsargs'][14]);
            $tra_numvoo_volta = NM_utf8_urldecode($_POST['rsargs'][15]);
            $tra_origem_volta = NM_utf8_urldecode($_POST['rsargs'][16]);
            $tra_destino_volta = NM_utf8_urldecode($_POST['rsargs'][17]);
            $tra_dt_saida_volta = NM_utf8_urldecode($_POST['rsargs'][18]);
            $tra_hr_saida_volta = NM_utf8_urldecode($_POST['rsargs'][19]);
            $tra_dt_chegada_volta = NM_utf8_urldecode($_POST['rsargs'][20]);
            $tra_hr_chegada_volta = NM_utf8_urldecode($_POST['rsargs'][21]);
            $tra_localizador_volta = NM_utf8_urldecode($_POST['rsargs'][22]);
            $tra_eticket_volta = NM_utf8_urldecode($_POST['rsargs'][23]);
            $cia_volta_dsc = NM_utf8_urldecode($_POST['rsargs'][24]);
            $origem_volta_dsc = NM_utf8_urldecode($_POST['rsargs'][25]);
            $destino_volta_dsc = NM_utf8_urldecode($_POST['rsargs'][26]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][27]);
        }
        if ('ajax_form_transfer_rsvp_submit_form' == $_POST['rs'])
        {
            $tra_id_evento = NM_utf8_urldecode($_POST['rsargs'][0]);
            $evento_dsc = NM_utf8_urldecode($_POST['rsargs'][1]);
            $tra_cpf_particip = NM_utf8_urldecode($_POST['rsargs'][2]);
            $tipo_dsc = NM_utf8_urldecode($_POST['rsargs'][3]);
            $tra_id_usuario = NM_utf8_urldecode($_POST['rsargs'][4]);
            $atendente_dsc = NM_utf8_urldecode($_POST['rsargs'][5]);
            $tra_tipo = NM_utf8_urldecode($_POST['rsargs'][6]);
            $tra_id_hotel = NM_utf8_urldecode($_POST['rsargs'][7]);
            $hotel_dsc = NM_utf8_urldecode($_POST['rsargs'][8]);
            $tra_id_hotel_out = NM_utf8_urldecode($_POST['rsargs'][9]);
            $hotel_dsc_out = NM_utf8_urldecode($_POST['rsargs'][10]);
            $enviar_app = NM_utf8_urldecode($_POST['rsargs'][11]);
            $tra_status = NM_utf8_urldecode($_POST['rsargs'][12]);
            $ult_trecho = NM_utf8_urldecode($_POST['rsargs'][13]);
            $tra_cia_ida = NM_utf8_urldecode($_POST['rsargs'][14]);
            $cia_ida_dsc = NM_utf8_urldecode($_POST['rsargs'][15]);
            $tra_numvoo_ida = NM_utf8_urldecode($_POST['rsargs'][16]);
            $tra_origem_ida = NM_utf8_urldecode($_POST['rsargs'][17]);
            $origem_ida_dsc = NM_utf8_urldecode($_POST['rsargs'][18]);
            $tra_destino_ida = NM_utf8_urldecode($_POST['rsargs'][19]);
            $destino_ida_dsc = NM_utf8_urldecode($_POST['rsargs'][20]);
            $tra_dt_saida_ida = NM_utf8_urldecode($_POST['rsargs'][21]);
            $tra_hr_saida_ida = NM_utf8_urldecode($_POST['rsargs'][22]);
            $tra_dt_chegada_ida = NM_utf8_urldecode($_POST['rsargs'][23]);
            $tra_hr_chegada_ida = NM_utf8_urldecode($_POST['rsargs'][24]);
            $tra_localizador_ida = NM_utf8_urldecode($_POST['rsargs'][25]);
            $tra_eticket_ida = NM_utf8_urldecode($_POST['rsargs'][26]);
            $tra_flag_ida = NM_utf8_urldecode($_POST['rsargs'][27]);
            $tra_cia_volta = NM_utf8_urldecode($_POST['rsargs'][28]);
            $cia_volta_dsc = NM_utf8_urldecode($_POST['rsargs'][29]);
            $tra_numvoo_volta = NM_utf8_urldecode($_POST['rsargs'][30]);
            $tra_origem_volta = NM_utf8_urldecode($_POST['rsargs'][31]);
            $origem_volta_dsc = NM_utf8_urldecode($_POST['rsargs'][32]);
            $tra_destino_volta = NM_utf8_urldecode($_POST['rsargs'][33]);
            $destino_volta_dsc = NM_utf8_urldecode($_POST['rsargs'][34]);
            $tra_dt_saida_volta = NM_utf8_urldecode($_POST['rsargs'][35]);
            $tra_hr_saida_volta = NM_utf8_urldecode($_POST['rsargs'][36]);
            $tra_dt_chegada_volta = NM_utf8_urldecode($_POST['rsargs'][37]);
            $tra_hr_chegada_volta = NM_utf8_urldecode($_POST['rsargs'][38]);
            $tra_localizador_volta = NM_utf8_urldecode($_POST['rsargs'][39]);
            $tra_eticket_volta = NM_utf8_urldecode($_POST['rsargs'][40]);
            $tra_intervalo = NM_utf8_urldecode($_POST['rsargs'][41]);
            $tra_hrtransout = NM_utf8_urldecode($_POST['rsargs'][42]);
            $tra_flag_volta = NM_utf8_urldecode($_POST['rsargs'][43]);
            $tra_dt_chegada_proprio = NM_utf8_urldecode($_POST['rsargs'][44]);
            $tra_hr_chegada_proprio = NM_utf8_urldecode($_POST['rsargs'][45]);
            $tra_flag_proprio = NM_utf8_urldecode($_POST['rsargs'][46]);
            $tra_dt_ida_local = NM_utf8_urldecode($_POST['rsargs'][47]);
            $tra_hr_ida_local = NM_utf8_urldecode($_POST['rsargs'][48]);
            $tra_origem_ida_local = NM_utf8_urldecode($_POST['rsargs'][49]);
            $tra_destino_ida_local = NM_utf8_urldecode($_POST['rsargs'][50]);
            $tra_flag_ida_local = NM_utf8_urldecode($_POST['rsargs'][51]);
            $tra_dt_volta_local = NM_utf8_urldecode($_POST['rsargs'][52]);
            $tra_hr_volta_local = NM_utf8_urldecode($_POST['rsargs'][53]);
            $tra_origem_volta_local = NM_utf8_urldecode($_POST['rsargs'][54]);
            $tra_destino_volta_local = NM_utf8_urldecode($_POST['rsargs'][55]);
            $tra_flag_volta_local = NM_utf8_urldecode($_POST['rsargs'][56]);
            $tra_observacao = NM_utf8_urldecode($_POST['rsargs'][57]);
            $tra_ativo = NM_utf8_urldecode($_POST['rsargs'][58]);
            $tra_dt_alteracao = NM_utf8_urldecode($_POST['rsargs'][59]);
            $cpf_del = NM_utf8_urldecode($_POST['rsargs'][60]);
            $sql_log = NM_utf8_urldecode($_POST['rsargs'][61]);
            $titulo_api = NM_utf8_urldecode($_POST['rsargs'][62]);
            $descricao_api = NM_utf8_urldecode($_POST['rsargs'][63]);
            $codigo_api = NM_utf8_urldecode($_POST['rsargs'][64]);
            $tipo_api = NM_utf8_urldecode($_POST['rsargs'][65]);
            $status_api = NM_utf8_urldecode($_POST['rsargs'][66]);
            $valido_de_api = NM_utf8_urldecode($_POST['rsargs'][67]);
            $valido_ate_api = NM_utf8_urldecode($_POST['rsargs'][68]);
            $local_de_origem_api = NM_utf8_urldecode($_POST['rsargs'][69]);
            $latitude_origem_api = NM_utf8_urldecode($_POST['rsargs'][70]);
            $longitude_origem_api = NM_utf8_urldecode($_POST['rsargs'][71]);
            $hr_saida_origem_api = NM_utf8_urldecode($_POST['rsargs'][72]);
            $local_destino_api = NM_utf8_urldecode($_POST['rsargs'][73]);
            $latitude_destino_api = NM_utf8_urldecode($_POST['rsargs'][74]);
            $longitude_destino_api = NM_utf8_urldecode($_POST['rsargs'][75]);
            $veiculo_api = NM_utf8_urldecode($_POST['rsargs'][76]);
            $companhia_api = NM_utf8_urldecode($_POST['rsargs'][77]);
            $nome_motorista_api = NM_utf8_urldecode($_POST['rsargs'][78]);
            $contato_motorista_api = NM_utf8_urldecode($_POST['rsargs'][79]);
            $matricula_api = NM_utf8_urldecode($_POST['rsargs'][80]);
            $duracao_percurso_api = NM_utf8_urldecode($_POST['rsargs'][81]);
            $comodidades_api = NM_utf8_urldecode($_POST['rsargs'][82]);
            $observacao_api = NM_utf8_urldecode($_POST['rsargs'][83]);
            $placa_veiculo_api = NM_utf8_urldecode($_POST['rsargs'][84]);
            $id_evento_app = NM_utf8_urldecode($_POST['rsargs'][85]);
            $id_participante_app = NM_utf8_urldecode($_POST['rsargs'][86]);
            $id_voucher_app = NM_utf8_urldecode($_POST['rsargs'][87]);
            $titulo_api_out = NM_utf8_urldecode($_POST['rsargs'][88]);
            $descricao_api_out = NM_utf8_urldecode($_POST['rsargs'][89]);
            $codigo_api_out = NM_utf8_urldecode($_POST['rsargs'][90]);
            $tipo_api_out = NM_utf8_urldecode($_POST['rsargs'][91]);
            $status_api_out = NM_utf8_urldecode($_POST['rsargs'][92]);
            $valido_de_api_out = NM_utf8_urldecode($_POST['rsargs'][93]);
            $valido_ate_api_out = NM_utf8_urldecode($_POST['rsargs'][94]);
            $local_de_origem_api_out = NM_utf8_urldecode($_POST['rsargs'][95]);
            $latitude_origem_api_out = NM_utf8_urldecode($_POST['rsargs'][96]);
            $longitude_origem_api_out = NM_utf8_urldecode($_POST['rsargs'][97]);
            $hr_saida_origem_api_out = NM_utf8_urldecode($_POST['rsargs'][98]);
            $local_de_destino_api_out = NM_utf8_urldecode($_POST['rsargs'][99]);
            $latitude_destino_api_out = NM_utf8_urldecode($_POST['rsargs'][100]);
            $longitude_destino_api_out = NM_utf8_urldecode($_POST['rsargs'][101]);
            $veiculo_api_out = NM_utf8_urldecode($_POST['rsargs'][102]);
            $companhia_api_out = NM_utf8_urldecode($_POST['rsargs'][103]);
            $nome_motorista_api_out = NM_utf8_urldecode($_POST['rsargs'][104]);
            $contato_motorista_api_out = NM_utf8_urldecode($_POST['rsargs'][105]);
            $matricula_api_out = NM_utf8_urldecode($_POST['rsargs'][106]);
            $duracao_percurso_api_out = NM_utf8_urldecode($_POST['rsargs'][107]);
            $comodidades_api_out = NM_utf8_urldecode($_POST['rsargs'][108]);
            $observacao_api_out = NM_utf8_urldecode($_POST['rsargs'][109]);
            $placa_veiculo_api_out = NM_utf8_urldecode($_POST['rsargs'][110]);
            $id_evento_app_out = NM_utf8_urldecode($_POST['rsargs'][111]);
            $id_participante_app_out = NM_utf8_urldecode($_POST['rsargs'][112]);
            $id_voucher_app_out = NM_utf8_urldecode($_POST['rsargs'][113]);
            $nm_form_submit = NM_utf8_urldecode($_POST['rsargs'][114]);
            $nmgp_url_saida = NM_utf8_urldecode($_POST['rsargs'][115]);
            $nmgp_opcao = NM_utf8_urldecode($_POST['rsargs'][116]);
            $nmgp_ancora = NM_utf8_urldecode($_POST['rsargs'][117]);
            $nmgp_num_form = NM_utf8_urldecode($_POST['rsargs'][118]);
            $nmgp_parms = NM_utf8_urldecode($_POST['rsargs'][119]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][120]);
            $csrf_token = NM_utf8_urldecode($_POST['rsargs'][121]);
        }
        if ('ajax_form_transfer_rsvp_navigate_form' == $_POST['rs'])
        {
            $id_transfer = NM_utf8_urldecode($_POST['rsargs'][0]);
            $nm_form_submit = NM_utf8_urldecode($_POST['rsargs'][1]);
            $nmgp_opcao = NM_utf8_urldecode($_POST['rsargs'][2]);
            $nmgp_ordem = NM_utf8_urldecode($_POST['rsargs'][3]);
            $nmgp_fast_search = NM_utf8_urldecode($_POST['rsargs'][4]);
            $nmgp_cond_fast_search = NM_utf8_urldecode($_POST['rsargs'][5]);
            $nmgp_arg_fast_search = NM_utf8_urldecode($_POST['rsargs'][6]);
            $nmgp_arg_dyn_search = NM_utf8_urldecode($_POST['rsargs'][7]);
            $script_case_init = NM_utf8_urldecode($_POST['rsargs'][8]);
        }
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
    if (isset($script_case_init) && !is_array($script_case_init) && !isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['lig_edit_lookup']))
    { 
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['lig_edit_lookup']     = false;
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['lig_edit_lookup_cb']  = '';
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['lig_edit_lookup_row'] = '';
    } 
    if (isset($script_case_init) && !is_array($script_case_init) && !isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['embutida_call']))
    { 
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['embutida_call'] = false;
    } 
    if (isset($script_case_init) && !is_array($script_case_init) && !isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['embutida_proc']))
    { 
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['embutida_proc'] = false;
    } 
    if (isset($script_case_init) && !is_array($script_case_init) && !isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['embutida_liga_form_insert']))
    { 
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['embutida_liga_form_insert'] = '';
    } 
    if (isset($script_case_init) && !is_array($script_case_init) && !isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['embutida_liga_form_update']))
    { 
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['embutida_liga_form_update'] = '';
    } 
    if (isset($script_case_init) && !is_array($script_case_init) && !isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['embutida_liga_form_delete']))
    { 
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['embutida_liga_form_delete'] = '';
    } 
    if (isset($script_case_init) && !is_array($script_case_init) && !isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['embutida_liga_form_btn_nav']))
    { 
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['embutida_liga_form_btn_nav'] = '';
    } 
    if (isset($script_case_init) && !is_array($script_case_init) && !isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['embutida_liga_grid_edit']))
    { 
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['embutida_liga_grid_edit'] = '';
    } 
    if (isset($script_case_init) && !is_array($script_case_init) && !isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['embutida_liga_grid_edit_link']))
    { 
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['embutida_liga_grid_edit_link'] = '';
    } 
    if (isset($script_case_init) && !is_array($script_case_init) && !isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['embutida_liga_qtd_reg']))
    { 
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['embutida_liga_qtd_reg'] = '';
    } 
    if (isset($script_case_init) && !is_array($script_case_init) && !isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['embutida_liga_tp_pag']))
    { 
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['embutida_liga_tp_pag'] = '';
    } 
    if (isset($script_case_init) && !is_array($script_case_init) && !isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['run_modal']))
    { 
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['run_modal'] = isset($_GET['nmgp_url_saida']) && 'modal' == $_GET['nmgp_url_saida'];
    } 
    if (isset($script_case_init) && !is_array($script_case_init) && $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['embutida_proc'])
    {
        return;
    }
    if (isset($script_case_init) && !is_array($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['embutida_parms']))
    { 
        $tmp_nmgp_parms = '';
        if (isset($nmgp_parms) && '' != $nmgp_parms)
        {
            $tmp_nmgp_parms = $nmgp_parms . '?@?';
        }
        $nmgp_parms = $tmp_nmgp_parms . $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['embutida_parms'];
        unset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['embutida_parms']);
    } 
    if (isset($nmgp_parms) && !empty($nmgp_parms) && !is_array($nmgp_parms)) 
    { 
        if (isset($_SESSION['nm_aba_bg_color'])) 
        { 
            unset($_SESSION['nm_aba_bg_color']);
        }   
        $nmgp_parms = NM_decode_input($nmgp_parms);
        $nmgp_parms = str_replace("@aspass@", "'", $nmgp_parms);
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
               nm_limpa_str_form_transfer_rsvp($cadapar[1]);
               if (isset($sc_conv_var[$cadapar[0]]))
               {
                   $cadapar[0] = $sc_conv_var[$cadapar[0]];
               }
               elseif (isset($sc_conv_var[strtolower($cadapar[0])]))
               {
                   $cadapar[0] = $sc_conv_var[strtolower($cadapar[0])];
               }
               if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
               $Tmp_par   = $cadapar[0];
               $$Tmp_par = $cadapar[1];
           }
           $ix++;
        }
        if (isset($vg_cpf)) 
        {
            $_SESSION['vg_cpf'] = $vg_cpf;
        }
        if (isset($vg_evento_id)) 
        {
            $_SESSION['vg_evento_id'] = $vg_evento_id;
        }
        if (isset($rsvp_global)) 
        {
            $_SESSION['rsvp_global'] = $rsvp_global;
        }
        if (isset($vg_usuario_id)) 
        {
            $_SESSION['vg_usuario_id'] = $vg_usuario_id;
        }
        if (isset($vg_cpfseg)) 
        {
            $_SESSION['vg_cpfseg'] = $vg_cpfseg;
        }
        if (isset($vg_menu_item)) 
        {
            $_SESSION['vg_menu_item'] = $vg_menu_item;
        }
        if (isset($parm1)) 
        {
            $_SESSION['parm1'] = $parm1;
        }
        if (isset($vg_alerta_trecho)) 
        {
            $_SESSION['vg_alerta_trecho'] = $vg_alerta_trecho;
        }
        if (isset($vg_achou_ida)) 
        {
            $_SESSION['vg_achou_ida'] = $vg_achou_ida;
        }
        if (isset($vg_achou_volta)) 
        {
            $_SESSION['vg_achou_volta'] = $vg_achou_volta;
        }
        if (isset($vg_tipo_pessoa)) 
        {
            $_SESSION['vg_tipo_pessoa'] = $vg_tipo_pessoa;
        }
    } 
    elseif (isset($script_case_init) && !empty($script_case_init) && !is_array($script_case_init) && isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['parms']))
    {
        if (!isset($nmgp_opcao) || ($nmgp_opcao != "incluir" && $nmgp_opcao != "novo" && $nmgp_opcao != "recarga" && $nmgp_opcao != "muda_form"))
        {
            $todox = str_replace("?#?@?@?", "?#?@ ?@?", $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['parms']);
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
               $Tmp_par   = $cadapar[0];
               $$Tmp_par = $cadapar[1];
               $ix++;
            }
        }
    } 
    if (isset($script_case_init) && $script_case_init != preg_replace('/[^0-9.-]/', '', $script_case_init))
    {
        unset($script_case_init);
    }
    if (!isset($script_case_init) || empty($script_case_init) || is_array($script_case_init))
    {
        $script_case_init = rand(2, 10000);
    }
    $salva_run = "N";
    $salva_iframe = false;
    if (isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['iframe_menu']))
    {
        $salva_iframe = $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['iframe_menu'];
        unset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['iframe_menu']);
    }
    if (isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['run_iframe']))
    {
        $salva_run = $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['run_iframe'];
        unset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['run_iframe']);
    }
    if (isset($nm_run_menu) && $nm_run_menu == 1)
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
        $_SESSION['scriptcase']['sc_apl_menu_atual'] = "form_transfer_rsvp";
        $achou = false;
        if (isset($_SESSION['sc_session'][$script_case_init]))
        {
            foreach ($_SESSION['sc_session'][$script_case_init] as $nome_apl => $resto)
            {
                if ($nome_apl == 'form_transfer_rsvp' || $achou)
                {
                    unset($_SESSION['sc_session'][$script_case_init][$nome_apl]);
                    if (!empty($_SESSION['sc_session'][$script_case_init][$nome_apl]))
                    {
                        $achou = true;
                    }
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
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['iframe_menu']  = true;
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['mostra_cab']   = "S";
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['run_iframe']   = "N";
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['retorno_edit'] = "";
    }
    else
    {
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['run_iframe']  = $salva_run;
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['iframe_menu'] = $salva_iframe;
    }

    if (!isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['db_changed']))
    {
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['db_changed'] = false;
    }
    if (isset($_GET['nmgp_outra_jan']) && 'true' == $_GET['nmgp_outra_jan'] && isset($_GET['nmgp_url_saida']) && 'modal' == $_GET['nmgp_url_saida'])
    {
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['db_changed'] = false;
    }

    if (isset($_SESSION['scriptcase']['sc_outra_jan']) && $_SESSION['scriptcase']['sc_outra_jan'] == 'form_transfer_rsvp')
    {
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['sc_outra_jan'] = true;
         unset($_SESSION['scriptcase']['sc_outra_jan']);
    }
    if (isset($nmgp_outra_jan) && $nmgp_outra_jan == 'true')
    {
        if (isset($nmgp_url_saida) && $nmgp_url_saida == "modal")
        {
            $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['sc_modal'] = true;
            $nm_url_saida = "form_transfer_rsvp_fim.php"; 
        }
        $nm_apl_dependente = 0;
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['sc_outra_jan'] = true;
    }
    if (!isset($nm_apl_dependente)) {
        $nm_apl_dependente = 0;
    }

    if (!isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['initialize']))
    {
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['initialize'] = true;
    }
    elseif (!isset($_SERVER['HTTP_REFERER']))
    {
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['initialize'] = false;
    }
    elseif (false === strpos($_SERVER['HTTP_REFERER'], '/form_transfer_rsvp/'))
    {
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['initialize'] = true;
    }
    else
    {
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['initialize'] = false;
    }

    if (isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['first_time']))
    {
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['first_time'] = false;
    }
    else
    {
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['first_time'] = true;
    }

    $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['menu_desenv'] = false;   
    if (!defined("SC_ERROR_HANDLER"))
    {
        define("SC_ERROR_HANDLER", 1);
    }
    include_once(dirname(__FILE__) . "/form_transfer_rsvp_erro.php");
    $nm_browser = strpos($_SERVER['HTTP_USER_AGENT'], "Konqueror") ;
    if (is_int($nm_browser))   
    {
        $nm_browser = "Konqueror"; 
    } 
    else  
    {
        $nm_browser = strpos($_SERVER['HTTP_USER_AGENT'], "Opera") ;
        if (is_int($nm_browser))   
        {
            $nm_browser = "Opera"; 
        }
    } 
    $_SESSION['scriptcase']['change_regional_old'] = '';
    $_SESSION['scriptcase']['change_regional_new'] = '';
    if (!empty($nmgp_opcao) && ($nmgp_opcao == "change_lang_t" || $nmgp_opcao == "change_lang_b" || $nmgp_opcao == "change_lang_f" || $nmgp_opcao == "force_lang"))  
    {
        $Temp_lang = $nmgp_opcao == "force_lang" ? explode(";" , $nmgp_idioma) : explode(";" , $nmgp_idioma_novo);  
        if (isset($Temp_lang[0]) && !empty($Temp_lang[0]))  
        { 
            $_SESSION['scriptcase']['str_lang'] = $Temp_lang[0];
        } 
        if (isset($Temp_lang[1]) && !empty($Temp_lang[1])) 
        { 
            $_SESSION['scriptcase']['change_regional_old'] = (isset($_SESSION['scriptcase']['str_conf_reg']) && !empty($_SESSION['scriptcase']['str_conf_reg'])) ? $_SESSION['scriptcase']['str_conf_reg'] : "pt_br";
            $_SESSION['scriptcase']['str_conf_reg']        = $Temp_lang[1];
            $_SESSION['scriptcase']['change_regional_new'] = $_SESSION['scriptcase']['str_conf_reg'];
        } 
        $nmgp_opcao = $nmgp_opcao == "force_lang" ? "inicio" : "igual";
    } 
    if (!empty($nmgp_opcao) && ($nmgp_opcao == "change_schema_t" || $nmgp_opcao == "change_schema_b" || $nmgp_opcao == "change_schema_f"))  
    {
        if ($nmgp_opcao == "change_schema_t")  
        {
            $nmgp_schema = $nmgp_schema_t . "/" . $nmgp_schema_t;  
        } 
        elseif ($nmgp_opcao == "change_schema_b")  
        {
            $nmgp_schema = $nmgp_schema_b . "/" . $nmgp_schema_b;  
        } 
        else 
        {
            $nmgp_schema = $nmgp_schema_f . "/" . $nmgp_schema_f;  
        } 
        $_SESSION['scriptcase']['str_schema_all'] = $nmgp_schema;
        $nmgp_opcao = "recarga";  
    } 
    if (!empty($nmgp_opcao) && $nmgp_opcao == "lookup")  
    {
        $nm_opc_lookup = $nmgp_opcao;
    }
    elseif (!empty($nmgp_opcao) && $nmgp_opcao == "formphp")  
    {
        $nm_opc_form_php = $nmgp_opcao;
    }
    else
    {
        if (!empty($nmgp_opcao))  
        {
            $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['opcao'] = $nmgp_opcao ; 
        }
        if (isset($_POST["vg_cpf"])) 
        {
            $_SESSION['vg_cpf'] = $_POST["vg_cpf"];
            nm_limpa_str_form_transfer_rsvp($_SESSION['vg_cpf']);
        }
        if (isset($_GET["vg_cpf"])) 
        {
            $_SESSION['vg_cpf'] = $_GET["vg_cpf"];
            nm_limpa_str_form_transfer_rsvp($_SESSION['vg_cpf']);
        }
        if (isset($_POST["vg_evento_id"])) 
        {
            $_SESSION['vg_evento_id'] = $_POST["vg_evento_id"];
            nm_limpa_str_form_transfer_rsvp($_SESSION['vg_evento_id']);
        }
        if (isset($_GET["vg_evento_id"])) 
        {
            $_SESSION['vg_evento_id'] = $_GET["vg_evento_id"];
            nm_limpa_str_form_transfer_rsvp($_SESSION['vg_evento_id']);
        }
        if (isset($_POST["rsvp_global"])) 
        {
            $_SESSION['rsvp_global'] = $_POST["rsvp_global"];
            nm_limpa_str_form_transfer_rsvp($_SESSION['rsvp_global']);
        }
        if (isset($_GET["rsvp_global"])) 
        {
            $_SESSION['rsvp_global'] = $_GET["rsvp_global"];
            nm_limpa_str_form_transfer_rsvp($_SESSION['rsvp_global']);
        }
        if (isset($_POST["vg_usuario_id"])) 
        {
            $_SESSION['vg_usuario_id'] = $_POST["vg_usuario_id"];
            nm_limpa_str_form_transfer_rsvp($_SESSION['vg_usuario_id']);
        }
        if (isset($_GET["vg_usuario_id"])) 
        {
            $_SESSION['vg_usuario_id'] = $_GET["vg_usuario_id"];
            nm_limpa_str_form_transfer_rsvp($_SESSION['vg_usuario_id']);
        }
        if (isset($_POST["vg_cpfseg"])) 
        {
            $_SESSION['vg_cpfseg'] = $_POST["vg_cpfseg"];
            nm_limpa_str_form_transfer_rsvp($_SESSION['vg_cpfseg']);
        }
        if (isset($_GET["vg_cpfseg"])) 
        {
            $_SESSION['vg_cpfseg'] = $_GET["vg_cpfseg"];
            nm_limpa_str_form_transfer_rsvp($_SESSION['vg_cpfseg']);
        }
        if (isset($_POST["vg_menu_item"])) 
        {
            $_SESSION['vg_menu_item'] = $_POST["vg_menu_item"];
            nm_limpa_str_form_transfer_rsvp($_SESSION['vg_menu_item']);
        }
        if (isset($_GET["vg_menu_item"])) 
        {
            $_SESSION['vg_menu_item'] = $_GET["vg_menu_item"];
            nm_limpa_str_form_transfer_rsvp($_SESSION['vg_menu_item']);
        }
        if (isset($_POST["parm1"])) 
        {
            $_SESSION['parm1'] = $_POST["parm1"];
            nm_limpa_str_form_transfer_rsvp($_SESSION['parm1']);
        }
        if (isset($_GET["parm1"])) 
        {
            $_SESSION['parm1'] = $_GET["parm1"];
            nm_limpa_str_form_transfer_rsvp($_SESSION['parm1']);
        }
        if (isset($_POST["vg_alerta_trecho"])) 
        {
            $_SESSION['vg_alerta_trecho'] = $_POST["vg_alerta_trecho"];
            nm_limpa_str_form_transfer_rsvp($_SESSION['vg_alerta_trecho']);
        }
        if (isset($_GET["vg_alerta_trecho"])) 
        {
            $_SESSION['vg_alerta_trecho'] = $_GET["vg_alerta_trecho"];
            nm_limpa_str_form_transfer_rsvp($_SESSION['vg_alerta_trecho']);
        }
        if (isset($_POST["vg_achou_ida"])) 
        {
            $_SESSION['vg_achou_ida'] = $_POST["vg_achou_ida"];
            nm_limpa_str_form_transfer_rsvp($_SESSION['vg_achou_ida']);
        }
        if (isset($_GET["vg_achou_ida"])) 
        {
            $_SESSION['vg_achou_ida'] = $_GET["vg_achou_ida"];
            nm_limpa_str_form_transfer_rsvp($_SESSION['vg_achou_ida']);
        }
        if (isset($_POST["vg_achou_volta"])) 
        {
            $_SESSION['vg_achou_volta'] = $_POST["vg_achou_volta"];
            nm_limpa_str_form_transfer_rsvp($_SESSION['vg_achou_volta']);
        }
        if (isset($_GET["vg_achou_volta"])) 
        {
            $_SESSION['vg_achou_volta'] = $_GET["vg_achou_volta"];
            nm_limpa_str_form_transfer_rsvp($_SESSION['vg_achou_volta']);
        }
        if (isset($_POST["vg_tipo_pessoa"])) 
        {
            $_SESSION['vg_tipo_pessoa'] = $_POST["vg_tipo_pessoa"];
            nm_limpa_str_form_transfer_rsvp($_SESSION['vg_tipo_pessoa']);
        }
        if (isset($_GET["vg_tipo_pessoa"])) 
        {
            $_SESSION['vg_tipo_pessoa'] = $_GET["vg_tipo_pessoa"];
            nm_limpa_str_form_transfer_rsvp($_SESSION['vg_tipo_pessoa']);
        }
        if (!empty($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['volta_redirect_apl']))
        {
            $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['volta_redirect_apl']; 
            $nm_apl_dependente = $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['volta_redirect_tp']; 
            $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['volta_redirect_apl'] = "";
            $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['volta_redirect_tp'] = "";
            $nm_url_saida = "form_transfer_rsvp_fim.php"; 
        }
        elseif (isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['sc_outra_jan']) && $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['sc_outra_jan'] == 'true')
        {
               $nm_url_saida = "form_transfer_rsvp_fim.php"; 
        }
        elseif ($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['run_iframe'] != "R")
        {
           $nm_url_saida = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ""; 
           $nm_url_saida = str_replace("_fim.php", ".php", $nm_url_saida); 
            $nm_saida_global = $nm_url_saida;
            if (!empty($nmgp_url_saida) && empty($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['retorno_edit'])) 
            {
                $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['retorno_edit'] = $nmgp_url_saida ; 
            } 
            if (!empty($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['retorno_edit'])) 
            {
                $nm_url_saida = $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['retorno_edit'] . "?script_case_init=" . $script_case_init;  
                $nm_apl_dependente = 1 ; 
                $nm_saida_global = $nm_url_saida;
            } 
            if ($nm_apl_dependente != 1) 
            { 
                $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['run_iframe'] = "N"; 
            } 
            if ($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['run_iframe'] != "R" && (!isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['embutida_call']) || !$_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['embutida_call']))
            { 
                $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $nm_url_saida; 
                $nm_url_saida = "form_transfer_rsvp_fim.php"; 
                $_SESSION['scriptcase']['sc_tp_saida'] = "P"; 
                if ($nm_apl_dependente == 1) 
                { 
                    $_SESSION['scriptcase']['sc_tp_saida'] = "D"; 
                } 
                if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1) 
                { 
                    $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $_SESSION['scriptcase']['nm_sc_retorno']; 
                } 
            } 
        }
        if (empty($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['volta_tp']) && $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['run_iframe'] != "R")
        {
            if (!isset($nm_saida_global)) {
                $nm_saida_global = $nm_url_saida;
            }
            $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['volta_php'] = $nm_url_saida;
            $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['volta_apl'] = $nm_saida_global;
            $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['volta_ss']  = (isset($_SESSION['scriptcase']['sc_url_saida'][$script_case_init])) ? $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] : "";
            $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['volta_dep'] = (isset($nm_apl_dependente)) ? $nm_apl_dependente : "";
            $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['volta_tp']  = (isset($_SESSION['scriptcase']['sc_tp_saida'])) ? $_SESSION['scriptcase']['sc_tp_saida'] : "";
        }
        $nm_url_saida      = (isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['volta_php'])) ? $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['volta_php'] : "";
        $nm_apl_dependente = (isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['volta_dep'])) ? $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['volta_dep'] : "";
        $nm_saida_global   = $nm_url_saida;
        if ($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['run_iframe'] != "R" && !empty($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['volta_ss'])) 
        { 
            $_SESSION['scriptcase']['sc_url_saida'][$script_case_init] = $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['volta_ss'];
            $_SESSION['scriptcase']['sc_tp_saida']  = $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['volta_tp'];
        } 
        if ($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['run_iframe'] == "F" || $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['run_iframe'] == "R") 
        { 
            if (!empty($nmgp_url_saida) && empty($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['retorno_edit'])) 
            {
                $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['retorno_edit'] = $nmgp_url_saida . "?script_case_init=" . $script_case_init; 
            } 
        } 
        if (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['run_iframe'] != "R") 
        { 
            $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['menu_desenv'] = true;   
        } 
    }
    if (isset($nmgp_redir)) 
    { 
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['redir'] = $nmgp_redir;   
    } 
    if (isset($nmgp_outra_jan) && $nmgp_outra_jan == 'true')
    {
        $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['sc_outra_jan'] = true;
         if (isset($nmgp_url_saida) && $nmgp_url_saida == "modal")
         {
             $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['sc_modal'] = true;
             $nm_url_saida = "form_transfer_rsvp_fim.php"; 
         }
    }
    if (isset($_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['sc_outra_jan']) && $_SESSION['sc_session'][$script_case_init]['form_transfer_rsvp']['sc_outra_jan'])
    {
        $nm_apl_dependente = 0;
    }
    $GLOBALS["NM_ERRO_IBASE"] = 0;  
    $inicial_form_transfer_rsvp = new form_transfer_rsvp_edit();
    $inicial_form_transfer_rsvp->inicializa();

    $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['select_html'] = array();
    $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['select_html']['tra_tipo'] = "class=\"sc-js-input scFormObjectOdd css_tra_tipo_obj{SC_100PERC_CLASS_INPUT}\" style=\"\" id=\"id_sc_field_tra_tipo\" name=\"tra_tipo\" size=\"1\" alt=\"{type: \'select\', enterTab: false}\"";
    $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['select_html']['tra_id_hotel'] = "class=\"sc-js-input scFormObjectOdd css_tra_id_hotel_obj{SC_100PERC_CLASS_INPUT}\" style=\"\" id=\"id_sc_field_tra_id_hotel\" name=\"tra_id_hotel\" size=\"1\" alt=\"{type: 'select', enterTab: false}\"";
    $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['select_html']['tra_id_hotel_out'] = "class=\"sc-js-input scFormObjectOdd css_tra_id_hotel_out_obj{SC_100PERC_CLASS_INPUT}\" style=\"\" id=\"id_sc_field_tra_id_hotel_out\" name=\"tra_id_hotel_out\" size=\"1\" alt=\"{type: 'select', enterTab: false}\"";
    $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['select_html']['enviar_app'] = " onClick=\"do_ajax_form_transfer_rsvp_event_enviar_app_onclick();\" ";
    $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['select_html']['tra_status'] = "class=\"sc-js-input scFormObjectOdd css_tra_status_obj{SC_100PERC_CLASS_INPUT}\" style=\"\" id=\"id_sc_field_tra_status\" name=\"tra_status\" size=\"1\" alt=\"{type: \'select\', enterTab: false}\"";
    $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['select_html']['tra_flag_ida'] = "class=\"sc-js-input scFormObjectOdd css_tra_flag_ida_obj{SC_100PERC_CLASS_INPUT}\" style=\"\" id=\"id_sc_field_tra_flag_ida\" name=\"tra_flag_ida\" size=\"1\" alt=\"{type: \'select\', enterTab: false}\"";
    $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['select_html']['tra_intervalo'] = "class=\"sc-js-input scFormObjectOdd css_tra_intervalo_obj{SC_100PERC_CLASS_INPUT}\" style=\"\" id=\"id_sc_field_tra_intervalo\" name=\"tra_intervalo\" size=\"1\" alt=\"{type: \'select\', enterTab: false}\"";
    $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['select_html']['tra_flag_volta'] = "class=\"sc-js-input scFormObjectOdd css_tra_flag_volta_obj{SC_100PERC_CLASS_INPUT}\" style=\"\" id=\"id_sc_field_tra_flag_volta\" name=\"tra_flag_volta\" size=\"1\" alt=\"{type: \'select\', enterTab: false}\"";
    $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['select_html']['tra_flag_proprio'] = "class=\"sc-js-input scFormObjectOdd css_tra_flag_proprio_obj{SC_100PERC_CLASS_INPUT}\" style=\"\" id=\"id_sc_field_tra_flag_proprio\" name=\"tra_flag_proprio\" size=\"1\" alt=\"{type: \'select\', enterTab: false}\"";
    $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['select_html']['tra_flag_ida_local'] = "class=\"sc-js-input scFormObjectOdd css_tra_flag_ida_local_obj{SC_100PERC_CLASS_INPUT}\" style=\"\" id=\"id_sc_field_tra_flag_ida_local\" name=\"tra_flag_ida_local\" size=\"1\" alt=\"{type: \'select\', enterTab: false}\"";
    $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['select_html']['tra_flag_volta_local'] = "class=\"sc-js-input scFormObjectOdd css_tra_flag_volta_local_obj{SC_100PERC_CLASS_INPUT}\" style=\"\" id=\"id_sc_field_tra_flag_volta_local\" name=\"tra_flag_volta_local\" size=\"1\" alt=\"{type: \'select\', enterTab: false}\"";
    $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['select_html']['tra_ativo'] = "class=\"sc-js-input scFormObjectOdd css_tra_ativo_obj{SC_100PERC_CLASS_INPUT}\" style=\"\" id=\"id_sc_field_tra_ativo\" name=\"tra_ativo\" size=\"1\" alt=\"{type: \'select\', enterTab: false}\"";

    if (!defined('SC_SAJAX_LOADED'))
    {
        include_once(dirname(__FILE__) . '/form_transfer_rsvp_sajax.php');
        define('SC_SAJAX_LOADED', 'YES');
    }
    if (!class_exists('Services_JSON'))
    {
        include_once(dirname(__FILE__) . '/form_transfer_rsvp_json.php');
    }
    $sajax_request_type = "POST";
    sajax_init();
    //$sajax_debug_mode = 1;
    sajax_export("ajax_form_transfer_rsvp_validate_tra_id_evento");
    sajax_export("ajax_form_transfer_rsvp_validate_evento_dsc");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_cpf_particip");
    sajax_export("ajax_form_transfer_rsvp_validate_tipo_dsc");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_id_usuario");
    sajax_export("ajax_form_transfer_rsvp_validate_atendente_dsc");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_tipo");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_id_hotel");
    sajax_export("ajax_form_transfer_rsvp_validate_hotel_dsc");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_id_hotel_out");
    sajax_export("ajax_form_transfer_rsvp_validate_hotel_dsc_out");
    sajax_export("ajax_form_transfer_rsvp_validate_enviar_app");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_status");
    sajax_export("ajax_form_transfer_rsvp_validate_ult_trecho");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_cia_ida");
    sajax_export("ajax_form_transfer_rsvp_validate_cia_ida_dsc");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_numvoo_ida");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_origem_ida");
    sajax_export("ajax_form_transfer_rsvp_validate_origem_ida_dsc");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_destino_ida");
    sajax_export("ajax_form_transfer_rsvp_validate_destino_ida_dsc");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_dt_saida_ida");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_hr_saida_ida");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_dt_chegada_ida");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_hr_chegada_ida");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_localizador_ida");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_eticket_ida");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_flag_ida");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_cia_volta");
    sajax_export("ajax_form_transfer_rsvp_validate_cia_volta_dsc");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_numvoo_volta");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_origem_volta");
    sajax_export("ajax_form_transfer_rsvp_validate_origem_volta_dsc");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_destino_volta");
    sajax_export("ajax_form_transfer_rsvp_validate_destino_volta_dsc");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_dt_saida_volta");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_hr_saida_volta");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_dt_chegada_volta");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_hr_chegada_volta");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_localizador_volta");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_eticket_volta");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_intervalo");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_hrtransout");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_flag_volta");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_dt_chegada_proprio");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_hr_chegada_proprio");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_flag_proprio");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_dt_ida_local");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_hr_ida_local");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_origem_ida_local");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_destino_ida_local");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_flag_ida_local");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_dt_volta_local");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_hr_volta_local");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_origem_volta_local");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_destino_volta_local");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_flag_volta_local");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_observacao");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_ativo");
    sajax_export("ajax_form_transfer_rsvp_validate_tra_dt_alteracao");
    sajax_export("ajax_form_transfer_rsvp_validate_cpf_del");
    sajax_export("ajax_form_transfer_rsvp_validate_sql_log");
    sajax_export("ajax_form_transfer_rsvp_validate_titulo_api");
    sajax_export("ajax_form_transfer_rsvp_validate_descricao_api");
    sajax_export("ajax_form_transfer_rsvp_validate_codigo_api");
    sajax_export("ajax_form_transfer_rsvp_validate_tipo_api");
    sajax_export("ajax_form_transfer_rsvp_validate_status_api");
    sajax_export("ajax_form_transfer_rsvp_validate_valido_de_api");
    sajax_export("ajax_form_transfer_rsvp_validate_valido_ate_api");
    sajax_export("ajax_form_transfer_rsvp_validate_local_de_origem_api");
    sajax_export("ajax_form_transfer_rsvp_validate_latitude_origem_api");
    sajax_export("ajax_form_transfer_rsvp_validate_longitude_origem_api");
    sajax_export("ajax_form_transfer_rsvp_validate_hr_saida_origem_api");
    sajax_export("ajax_form_transfer_rsvp_validate_local_destino_api");
    sajax_export("ajax_form_transfer_rsvp_validate_latitude_destino_api");
    sajax_export("ajax_form_transfer_rsvp_validate_longitude_destino_api");
    sajax_export("ajax_form_transfer_rsvp_validate_veiculo_api");
    sajax_export("ajax_form_transfer_rsvp_validate_companhia_api");
    sajax_export("ajax_form_transfer_rsvp_validate_nome_motorista_api");
    sajax_export("ajax_form_transfer_rsvp_validate_contato_motorista_api");
    sajax_export("ajax_form_transfer_rsvp_validate_matricula_api");
    sajax_export("ajax_form_transfer_rsvp_validate_duracao_percurso_api");
    sajax_export("ajax_form_transfer_rsvp_validate_comodidades_api");
    sajax_export("ajax_form_transfer_rsvp_validate_observacao_api");
    sajax_export("ajax_form_transfer_rsvp_validate_placa_veiculo_api");
    sajax_export("ajax_form_transfer_rsvp_validate_id_evento_app");
    sajax_export("ajax_form_transfer_rsvp_validate_id_participante_app");
    sajax_export("ajax_form_transfer_rsvp_validate_id_voucher_app");
    sajax_export("ajax_form_transfer_rsvp_validate_titulo_api_out");
    sajax_export("ajax_form_transfer_rsvp_validate_descricao_api_out");
    sajax_export("ajax_form_transfer_rsvp_validate_codigo_api_out");
    sajax_export("ajax_form_transfer_rsvp_validate_tipo_api_out");
    sajax_export("ajax_form_transfer_rsvp_validate_status_api_out");
    sajax_export("ajax_form_transfer_rsvp_validate_valido_de_api_out");
    sajax_export("ajax_form_transfer_rsvp_validate_valido_ate_api_out");
    sajax_export("ajax_form_transfer_rsvp_validate_local_de_origem_api_out");
    sajax_export("ajax_form_transfer_rsvp_validate_latitude_origem_api_out");
    sajax_export("ajax_form_transfer_rsvp_validate_longitude_origem_api_out");
    sajax_export("ajax_form_transfer_rsvp_validate_hr_saida_origem_api_out");
    sajax_export("ajax_form_transfer_rsvp_validate_local_de_destino_api_out");
    sajax_export("ajax_form_transfer_rsvp_validate_latitude_destino_api_out");
    sajax_export("ajax_form_transfer_rsvp_validate_longitude_destino_api_out");
    sajax_export("ajax_form_transfer_rsvp_validate_veiculo_api_out");
    sajax_export("ajax_form_transfer_rsvp_validate_companhia_api_out");
    sajax_export("ajax_form_transfer_rsvp_validate_nome_motorista_api_out");
    sajax_export("ajax_form_transfer_rsvp_validate_contato_motorista_api_out");
    sajax_export("ajax_form_transfer_rsvp_validate_matricula_api_out");
    sajax_export("ajax_form_transfer_rsvp_validate_duracao_percurso_api_out");
    sajax_export("ajax_form_transfer_rsvp_validate_comodidades_api_out");
    sajax_export("ajax_form_transfer_rsvp_validate_observacao_api_out");
    sajax_export("ajax_form_transfer_rsvp_validate_placa_veiculo_api_out");
    sajax_export("ajax_form_transfer_rsvp_validate_id_evento_app_out");
    sajax_export("ajax_form_transfer_rsvp_validate_id_participante_app_out");
    sajax_export("ajax_form_transfer_rsvp_validate_id_voucher_app_out");
    sajax_export("ajax_form_transfer_rsvp_event_enviar_app_onclick");
    sajax_export("ajax_form_transfer_rsvp_event_local_de_destino_api_out_onclick");
    sajax_export("ajax_form_transfer_rsvp_event_local_de_origem_api_onchange");
    sajax_export("ajax_form_transfer_rsvp_event_local_de_origem_api_out_onchange");
    sajax_export("ajax_form_transfer_rsvp_event_local_destino_api_onchange");
    sajax_export("ajax_form_transfer_rsvp_event_tra_flag_ida_local_onchange");
    sajax_export("ajax_form_transfer_rsvp_event_tra_flag_ida_onchange");
    sajax_export("ajax_form_transfer_rsvp_event_tra_flag_proprio_onchange");
    sajax_export("ajax_form_transfer_rsvp_event_tra_flag_volta_local_onchange");
    sajax_export("ajax_form_transfer_rsvp_event_tra_flag_volta_onchange");
    sajax_export("ajax_form_transfer_rsvp_event_tra_id_hotel_onchange");
    sajax_export("ajax_form_transfer_rsvp_event_tra_id_hotel_out_onchange");
    sajax_export("ajax_form_transfer_rsvp_event_tra_intervalo_onchange");
    sajax_export("ajax_form_transfer_rsvp_event_tra_status_onfocus");
    sajax_export("ajax_form_transfer_rsvp_event_tra_tipo_onchange");
    sajax_export("ajax_form_transfer_rsvp_event_tra_ult_trecho_volta_onchange");
    sajax_export("ajax_form_transfer_rsvp_submit_form");
    sajax_export("ajax_form_transfer_rsvp_navigate_form");
    sajax_handle_client_request();

    if (isset($_POST['wizard_action']) && 'change_step' == $_POST['wizard_action']) {
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'] = true;
        ob_start();
    }

    $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
//
    function nm_limpa_str_form_transfer_rsvp(&$str)
    {
    }

    function ajax_form_transfer_rsvp_validate_tra_id_evento($tra_id_evento, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_id_evento';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_id_evento' => NM_utf8_urldecode($tra_id_evento),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_id_evento

    function ajax_form_transfer_rsvp_validate_evento_dsc($evento_dsc, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_evento_dsc';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'evento_dsc' => NM_utf8_urldecode($evento_dsc),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_evento_dsc

    function ajax_form_transfer_rsvp_validate_tra_cpf_particip($tra_cpf_particip, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_cpf_particip';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_cpf_particip' => NM_utf8_urldecode($tra_cpf_particip),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_cpf_particip

    function ajax_form_transfer_rsvp_validate_tipo_dsc($tipo_dsc, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tipo_dsc';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tipo_dsc' => NM_utf8_urldecode($tipo_dsc),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tipo_dsc

    function ajax_form_transfer_rsvp_validate_tra_id_usuario($tra_id_usuario, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_id_usuario';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_id_usuario' => NM_utf8_urldecode($tra_id_usuario),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_id_usuario

    function ajax_form_transfer_rsvp_validate_atendente_dsc($atendente_dsc, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_atendente_dsc';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'atendente_dsc' => NM_utf8_urldecode($atendente_dsc),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_atendente_dsc

    function ajax_form_transfer_rsvp_validate_tra_tipo($tra_tipo, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_tipo';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_tipo' => NM_utf8_urldecode($tra_tipo),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_tipo

    function ajax_form_transfer_rsvp_validate_tra_id_hotel($tra_id_hotel, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_id_hotel';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_id_hotel' => NM_utf8_urldecode($tra_id_hotel),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_id_hotel

    function ajax_form_transfer_rsvp_validate_hotel_dsc($hotel_dsc, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_hotel_dsc';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'hotel_dsc' => NM_utf8_urldecode($hotel_dsc),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_hotel_dsc

    function ajax_form_transfer_rsvp_validate_tra_id_hotel_out($tra_id_hotel_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_id_hotel_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_id_hotel_out' => NM_utf8_urldecode($tra_id_hotel_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_id_hotel_out

    function ajax_form_transfer_rsvp_validate_hotel_dsc_out($hotel_dsc_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_hotel_dsc_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'hotel_dsc_out' => NM_utf8_urldecode($hotel_dsc_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_hotel_dsc_out

    function ajax_form_transfer_rsvp_validate_enviar_app($enviar_app, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_enviar_app';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'enviar_app' => NM_utf8_urldecode($enviar_app),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_enviar_app

    function ajax_form_transfer_rsvp_validate_tra_status($tra_status, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_status';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_status' => NM_utf8_urldecode($tra_status),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_status

    function ajax_form_transfer_rsvp_validate_ult_trecho($ult_trecho, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_ult_trecho';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'ult_trecho' => NM_utf8_urldecode($ult_trecho),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_ult_trecho

    function ajax_form_transfer_rsvp_validate_tra_cia_ida($tra_cia_ida, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_cia_ida';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_cia_ida' => NM_utf8_urldecode($tra_cia_ida),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_cia_ida

    function ajax_form_transfer_rsvp_validate_cia_ida_dsc($cia_ida_dsc, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_cia_ida_dsc';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'cia_ida_dsc' => NM_utf8_urldecode($cia_ida_dsc),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_cia_ida_dsc

    function ajax_form_transfer_rsvp_validate_tra_numvoo_ida($tra_numvoo_ida, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_numvoo_ida';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_numvoo_ida' => NM_utf8_urldecode($tra_numvoo_ida),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_numvoo_ida

    function ajax_form_transfer_rsvp_validate_tra_origem_ida($tra_origem_ida, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_origem_ida';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_origem_ida' => NM_utf8_urldecode($tra_origem_ida),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_origem_ida

    function ajax_form_transfer_rsvp_validate_origem_ida_dsc($origem_ida_dsc, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_origem_ida_dsc';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'origem_ida_dsc' => NM_utf8_urldecode($origem_ida_dsc),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_origem_ida_dsc

    function ajax_form_transfer_rsvp_validate_tra_destino_ida($tra_destino_ida, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_destino_ida';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_destino_ida' => NM_utf8_urldecode($tra_destino_ida),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_destino_ida

    function ajax_form_transfer_rsvp_validate_destino_ida_dsc($destino_ida_dsc, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_destino_ida_dsc';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'destino_ida_dsc' => NM_utf8_urldecode($destino_ida_dsc),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_destino_ida_dsc

    function ajax_form_transfer_rsvp_validate_tra_dt_saida_ida($tra_dt_saida_ida, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_dt_saida_ida';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_dt_saida_ida' => NM_utf8_urldecode($tra_dt_saida_ida),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_dt_saida_ida

    function ajax_form_transfer_rsvp_validate_tra_hr_saida_ida($tra_hr_saida_ida, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_hr_saida_ida';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_hr_saida_ida' => NM_utf8_urldecode($tra_hr_saida_ida),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_hr_saida_ida

    function ajax_form_transfer_rsvp_validate_tra_dt_chegada_ida($tra_dt_chegada_ida, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_dt_chegada_ida';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_dt_chegada_ida' => NM_utf8_urldecode($tra_dt_chegada_ida),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_dt_chegada_ida

    function ajax_form_transfer_rsvp_validate_tra_hr_chegada_ida($tra_hr_chegada_ida, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_hr_chegada_ida';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_hr_chegada_ida' => NM_utf8_urldecode($tra_hr_chegada_ida),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_hr_chegada_ida

    function ajax_form_transfer_rsvp_validate_tra_localizador_ida($tra_localizador_ida, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_localizador_ida';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_localizador_ida' => NM_utf8_urldecode($tra_localizador_ida),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_localizador_ida

    function ajax_form_transfer_rsvp_validate_tra_eticket_ida($tra_eticket_ida, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_eticket_ida';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_eticket_ida' => NM_utf8_urldecode($tra_eticket_ida),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_eticket_ida

    function ajax_form_transfer_rsvp_validate_tra_flag_ida($tra_flag_ida, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_flag_ida';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_flag_ida' => NM_utf8_urldecode($tra_flag_ida),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_flag_ida

    function ajax_form_transfer_rsvp_validate_tra_cia_volta($tra_cia_volta, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_cia_volta';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_cia_volta' => NM_utf8_urldecode($tra_cia_volta),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_cia_volta

    function ajax_form_transfer_rsvp_validate_cia_volta_dsc($cia_volta_dsc, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_cia_volta_dsc';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'cia_volta_dsc' => NM_utf8_urldecode($cia_volta_dsc),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_cia_volta_dsc

    function ajax_form_transfer_rsvp_validate_tra_numvoo_volta($tra_numvoo_volta, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_numvoo_volta';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_numvoo_volta' => NM_utf8_urldecode($tra_numvoo_volta),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_numvoo_volta

    function ajax_form_transfer_rsvp_validate_tra_origem_volta($tra_origem_volta, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_origem_volta';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_origem_volta' => NM_utf8_urldecode($tra_origem_volta),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_origem_volta

    function ajax_form_transfer_rsvp_validate_origem_volta_dsc($origem_volta_dsc, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_origem_volta_dsc';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'origem_volta_dsc' => NM_utf8_urldecode($origem_volta_dsc),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_origem_volta_dsc

    function ajax_form_transfer_rsvp_validate_tra_destino_volta($tra_destino_volta, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_destino_volta';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_destino_volta' => NM_utf8_urldecode($tra_destino_volta),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_destino_volta

    function ajax_form_transfer_rsvp_validate_destino_volta_dsc($destino_volta_dsc, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_destino_volta_dsc';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'destino_volta_dsc' => NM_utf8_urldecode($destino_volta_dsc),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_destino_volta_dsc

    function ajax_form_transfer_rsvp_validate_tra_dt_saida_volta($tra_dt_saida_volta, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_dt_saida_volta';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_dt_saida_volta' => NM_utf8_urldecode($tra_dt_saida_volta),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_dt_saida_volta

    function ajax_form_transfer_rsvp_validate_tra_hr_saida_volta($tra_hr_saida_volta, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_hr_saida_volta';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_hr_saida_volta' => NM_utf8_urldecode($tra_hr_saida_volta),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_hr_saida_volta

    function ajax_form_transfer_rsvp_validate_tra_dt_chegada_volta($tra_dt_chegada_volta, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_dt_chegada_volta';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_dt_chegada_volta' => NM_utf8_urldecode($tra_dt_chegada_volta),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_dt_chegada_volta

    function ajax_form_transfer_rsvp_validate_tra_hr_chegada_volta($tra_hr_chegada_volta, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_hr_chegada_volta';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_hr_chegada_volta' => NM_utf8_urldecode($tra_hr_chegada_volta),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_hr_chegada_volta

    function ajax_form_transfer_rsvp_validate_tra_localizador_volta($tra_localizador_volta, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_localizador_volta';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_localizador_volta' => NM_utf8_urldecode($tra_localizador_volta),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_localizador_volta

    function ajax_form_transfer_rsvp_validate_tra_eticket_volta($tra_eticket_volta, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_eticket_volta';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_eticket_volta' => NM_utf8_urldecode($tra_eticket_volta),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_eticket_volta

    function ajax_form_transfer_rsvp_validate_tra_intervalo($tra_intervalo, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_intervalo';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_intervalo' => NM_utf8_urldecode($tra_intervalo),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_intervalo

    function ajax_form_transfer_rsvp_validate_tra_hrtransout($tra_hrtransout, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_hrtransout';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_hrtransout' => NM_utf8_urldecode($tra_hrtransout),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_hrtransout

    function ajax_form_transfer_rsvp_validate_tra_flag_volta($tra_flag_volta, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_flag_volta';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_flag_volta' => NM_utf8_urldecode($tra_flag_volta),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_flag_volta

    function ajax_form_transfer_rsvp_validate_tra_dt_chegada_proprio($tra_dt_chegada_proprio, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_dt_chegada_proprio';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_dt_chegada_proprio' => NM_utf8_urldecode($tra_dt_chegada_proprio),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_dt_chegada_proprio

    function ajax_form_transfer_rsvp_validate_tra_hr_chegada_proprio($tra_hr_chegada_proprio, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_hr_chegada_proprio';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_hr_chegada_proprio' => NM_utf8_urldecode($tra_hr_chegada_proprio),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_hr_chegada_proprio

    function ajax_form_transfer_rsvp_validate_tra_flag_proprio($tra_flag_proprio, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_flag_proprio';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_flag_proprio' => NM_utf8_urldecode($tra_flag_proprio),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_flag_proprio

    function ajax_form_transfer_rsvp_validate_tra_dt_ida_local($tra_dt_ida_local, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_dt_ida_local';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_dt_ida_local' => NM_utf8_urldecode($tra_dt_ida_local),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_dt_ida_local

    function ajax_form_transfer_rsvp_validate_tra_hr_ida_local($tra_hr_ida_local, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_hr_ida_local';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_hr_ida_local' => NM_utf8_urldecode($tra_hr_ida_local),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_hr_ida_local

    function ajax_form_transfer_rsvp_validate_tra_origem_ida_local($tra_origem_ida_local, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_origem_ida_local';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_origem_ida_local' => NM_utf8_urldecode($tra_origem_ida_local),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_origem_ida_local

    function ajax_form_transfer_rsvp_validate_tra_destino_ida_local($tra_destino_ida_local, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_destino_ida_local';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_destino_ida_local' => NM_utf8_urldecode($tra_destino_ida_local),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_destino_ida_local

    function ajax_form_transfer_rsvp_validate_tra_flag_ida_local($tra_flag_ida_local, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_flag_ida_local';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_flag_ida_local' => NM_utf8_urldecode($tra_flag_ida_local),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_flag_ida_local

    function ajax_form_transfer_rsvp_validate_tra_dt_volta_local($tra_dt_volta_local, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_dt_volta_local';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_dt_volta_local' => NM_utf8_urldecode($tra_dt_volta_local),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_dt_volta_local

    function ajax_form_transfer_rsvp_validate_tra_hr_volta_local($tra_hr_volta_local, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_hr_volta_local';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_hr_volta_local' => NM_utf8_urldecode($tra_hr_volta_local),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_hr_volta_local

    function ajax_form_transfer_rsvp_validate_tra_origem_volta_local($tra_origem_volta_local, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_origem_volta_local';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_origem_volta_local' => NM_utf8_urldecode($tra_origem_volta_local),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_origem_volta_local

    function ajax_form_transfer_rsvp_validate_tra_destino_volta_local($tra_destino_volta_local, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_destino_volta_local';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_destino_volta_local' => NM_utf8_urldecode($tra_destino_volta_local),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_destino_volta_local

    function ajax_form_transfer_rsvp_validate_tra_flag_volta_local($tra_flag_volta_local, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_flag_volta_local';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_flag_volta_local' => NM_utf8_urldecode($tra_flag_volta_local),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_flag_volta_local

    function ajax_form_transfer_rsvp_validate_tra_observacao($tra_observacao, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_observacao';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_observacao' => NM_utf8_urldecode($tra_observacao),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_observacao

    function ajax_form_transfer_rsvp_validate_tra_ativo($tra_ativo, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_ativo';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_ativo' => NM_utf8_urldecode($tra_ativo),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_ativo

    function ajax_form_transfer_rsvp_validate_tra_dt_alteracao($tra_dt_alteracao, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tra_dt_alteracao';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_dt_alteracao' => NM_utf8_urldecode($tra_dt_alteracao),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tra_dt_alteracao

    function ajax_form_transfer_rsvp_validate_cpf_del($cpf_del, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_cpf_del';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'cpf_del' => NM_utf8_urldecode($cpf_del),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_cpf_del

    function ajax_form_transfer_rsvp_validate_sql_log($sql_log, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_sql_log';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'sql_log' => NM_utf8_urldecode($sql_log),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_sql_log

    function ajax_form_transfer_rsvp_validate_titulo_api($titulo_api, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_titulo_api';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'titulo_api' => NM_utf8_urldecode($titulo_api),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_titulo_api

    function ajax_form_transfer_rsvp_validate_descricao_api($descricao_api, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_descricao_api';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'descricao_api' => NM_utf8_urldecode($descricao_api),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_descricao_api

    function ajax_form_transfer_rsvp_validate_codigo_api($codigo_api, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_codigo_api';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'codigo_api' => NM_utf8_urldecode($codigo_api),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_codigo_api

    function ajax_form_transfer_rsvp_validate_tipo_api($tipo_api, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tipo_api';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tipo_api' => NM_utf8_urldecode($tipo_api),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tipo_api

    function ajax_form_transfer_rsvp_validate_status_api($status_api, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_status_api';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'status_api' => NM_utf8_urldecode($status_api),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_status_api

    function ajax_form_transfer_rsvp_validate_valido_de_api($valido_de_api, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_valido_de_api';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'valido_de_api' => NM_utf8_urldecode($valido_de_api),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_valido_de_api

    function ajax_form_transfer_rsvp_validate_valido_ate_api($valido_ate_api, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_valido_ate_api';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'valido_ate_api' => NM_utf8_urldecode($valido_ate_api),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_valido_ate_api

    function ajax_form_transfer_rsvp_validate_local_de_origem_api($local_de_origem_api, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_local_de_origem_api';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'local_de_origem_api' => NM_utf8_urldecode($local_de_origem_api),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_local_de_origem_api

    function ajax_form_transfer_rsvp_validate_latitude_origem_api($latitude_origem_api, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_latitude_origem_api';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'latitude_origem_api' => NM_utf8_urldecode($latitude_origem_api),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_latitude_origem_api

    function ajax_form_transfer_rsvp_validate_longitude_origem_api($longitude_origem_api, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_longitude_origem_api';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'longitude_origem_api' => NM_utf8_urldecode($longitude_origem_api),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_longitude_origem_api

    function ajax_form_transfer_rsvp_validate_hr_saida_origem_api($hr_saida_origem_api, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_hr_saida_origem_api';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'hr_saida_origem_api' => NM_utf8_urldecode($hr_saida_origem_api),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_hr_saida_origem_api

    function ajax_form_transfer_rsvp_validate_local_destino_api($local_destino_api, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_local_destino_api';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'local_destino_api' => NM_utf8_urldecode($local_destino_api),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_local_destino_api

    function ajax_form_transfer_rsvp_validate_latitude_destino_api($latitude_destino_api, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_latitude_destino_api';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'latitude_destino_api' => NM_utf8_urldecode($latitude_destino_api),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_latitude_destino_api

    function ajax_form_transfer_rsvp_validate_longitude_destino_api($longitude_destino_api, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_longitude_destino_api';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'longitude_destino_api' => NM_utf8_urldecode($longitude_destino_api),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_longitude_destino_api

    function ajax_form_transfer_rsvp_validate_veiculo_api($veiculo_api, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_veiculo_api';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'veiculo_api' => NM_utf8_urldecode($veiculo_api),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_veiculo_api

    function ajax_form_transfer_rsvp_validate_companhia_api($companhia_api, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_companhia_api';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'companhia_api' => NM_utf8_urldecode($companhia_api),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_companhia_api

    function ajax_form_transfer_rsvp_validate_nome_motorista_api($nome_motorista_api, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_nome_motorista_api';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'nome_motorista_api' => NM_utf8_urldecode($nome_motorista_api),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_nome_motorista_api

    function ajax_form_transfer_rsvp_validate_contato_motorista_api($contato_motorista_api, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_contato_motorista_api';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'contato_motorista_api' => NM_utf8_urldecode($contato_motorista_api),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_contato_motorista_api

    function ajax_form_transfer_rsvp_validate_matricula_api($matricula_api, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_matricula_api';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'matricula_api' => NM_utf8_urldecode($matricula_api),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_matricula_api

    function ajax_form_transfer_rsvp_validate_duracao_percurso_api($duracao_percurso_api, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_duracao_percurso_api';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'duracao_percurso_api' => NM_utf8_urldecode($duracao_percurso_api),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_duracao_percurso_api

    function ajax_form_transfer_rsvp_validate_comodidades_api($comodidades_api, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_comodidades_api';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'comodidades_api' => NM_utf8_urldecode($comodidades_api),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_comodidades_api

    function ajax_form_transfer_rsvp_validate_observacao_api($observacao_api, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_observacao_api';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'observacao_api' => NM_utf8_urldecode($observacao_api),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_observacao_api

    function ajax_form_transfer_rsvp_validate_placa_veiculo_api($placa_veiculo_api, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_placa_veiculo_api';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'placa_veiculo_api' => NM_utf8_urldecode($placa_veiculo_api),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_placa_veiculo_api

    function ajax_form_transfer_rsvp_validate_id_evento_app($id_evento_app, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_id_evento_app';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'id_evento_app' => NM_utf8_urldecode($id_evento_app),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_id_evento_app

    function ajax_form_transfer_rsvp_validate_id_participante_app($id_participante_app, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_id_participante_app';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'id_participante_app' => NM_utf8_urldecode($id_participante_app),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_id_participante_app

    function ajax_form_transfer_rsvp_validate_id_voucher_app($id_voucher_app, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_id_voucher_app';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'id_voucher_app' => NM_utf8_urldecode($id_voucher_app),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_id_voucher_app

    function ajax_form_transfer_rsvp_validate_titulo_api_out($titulo_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_titulo_api_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'titulo_api_out' => NM_utf8_urldecode($titulo_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_titulo_api_out

    function ajax_form_transfer_rsvp_validate_descricao_api_out($descricao_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_descricao_api_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'descricao_api_out' => NM_utf8_urldecode($descricao_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_descricao_api_out

    function ajax_form_transfer_rsvp_validate_codigo_api_out($codigo_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_codigo_api_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'codigo_api_out' => NM_utf8_urldecode($codigo_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_codigo_api_out

    function ajax_form_transfer_rsvp_validate_tipo_api_out($tipo_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_tipo_api_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tipo_api_out' => NM_utf8_urldecode($tipo_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_tipo_api_out

    function ajax_form_transfer_rsvp_validate_status_api_out($status_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_status_api_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'status_api_out' => NM_utf8_urldecode($status_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_status_api_out

    function ajax_form_transfer_rsvp_validate_valido_de_api_out($valido_de_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_valido_de_api_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'valido_de_api_out' => NM_utf8_urldecode($valido_de_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_valido_de_api_out

    function ajax_form_transfer_rsvp_validate_valido_ate_api_out($valido_ate_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_valido_ate_api_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'valido_ate_api_out' => NM_utf8_urldecode($valido_ate_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_valido_ate_api_out

    function ajax_form_transfer_rsvp_validate_local_de_origem_api_out($local_de_origem_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_local_de_origem_api_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'local_de_origem_api_out' => NM_utf8_urldecode($local_de_origem_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_local_de_origem_api_out

    function ajax_form_transfer_rsvp_validate_latitude_origem_api_out($latitude_origem_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_latitude_origem_api_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'latitude_origem_api_out' => NM_utf8_urldecode($latitude_origem_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_latitude_origem_api_out

    function ajax_form_transfer_rsvp_validate_longitude_origem_api_out($longitude_origem_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_longitude_origem_api_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'longitude_origem_api_out' => NM_utf8_urldecode($longitude_origem_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_longitude_origem_api_out

    function ajax_form_transfer_rsvp_validate_hr_saida_origem_api_out($hr_saida_origem_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_hr_saida_origem_api_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'hr_saida_origem_api_out' => NM_utf8_urldecode($hr_saida_origem_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_hr_saida_origem_api_out

    function ajax_form_transfer_rsvp_validate_local_de_destino_api_out($local_de_destino_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_local_de_destino_api_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'local_de_destino_api_out' => NM_utf8_urldecode($local_de_destino_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_local_de_destino_api_out

    function ajax_form_transfer_rsvp_validate_latitude_destino_api_out($latitude_destino_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_latitude_destino_api_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'latitude_destino_api_out' => NM_utf8_urldecode($latitude_destino_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_latitude_destino_api_out

    function ajax_form_transfer_rsvp_validate_longitude_destino_api_out($longitude_destino_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_longitude_destino_api_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'longitude_destino_api_out' => NM_utf8_urldecode($longitude_destino_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_longitude_destino_api_out

    function ajax_form_transfer_rsvp_validate_veiculo_api_out($veiculo_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_veiculo_api_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'veiculo_api_out' => NM_utf8_urldecode($veiculo_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_veiculo_api_out

    function ajax_form_transfer_rsvp_validate_companhia_api_out($companhia_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_companhia_api_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'companhia_api_out' => NM_utf8_urldecode($companhia_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_companhia_api_out

    function ajax_form_transfer_rsvp_validate_nome_motorista_api_out($nome_motorista_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_nome_motorista_api_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'nome_motorista_api_out' => NM_utf8_urldecode($nome_motorista_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_nome_motorista_api_out

    function ajax_form_transfer_rsvp_validate_contato_motorista_api_out($contato_motorista_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_contato_motorista_api_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'contato_motorista_api_out' => NM_utf8_urldecode($contato_motorista_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_contato_motorista_api_out

    function ajax_form_transfer_rsvp_validate_matricula_api_out($matricula_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_matricula_api_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'matricula_api_out' => NM_utf8_urldecode($matricula_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_matricula_api_out

    function ajax_form_transfer_rsvp_validate_duracao_percurso_api_out($duracao_percurso_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_duracao_percurso_api_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'duracao_percurso_api_out' => NM_utf8_urldecode($duracao_percurso_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_duracao_percurso_api_out

    function ajax_form_transfer_rsvp_validate_comodidades_api_out($comodidades_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_comodidades_api_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'comodidades_api_out' => NM_utf8_urldecode($comodidades_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_comodidades_api_out

    function ajax_form_transfer_rsvp_validate_observacao_api_out($observacao_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_observacao_api_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'observacao_api_out' => NM_utf8_urldecode($observacao_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_observacao_api_out

    function ajax_form_transfer_rsvp_validate_placa_veiculo_api_out($placa_veiculo_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_placa_veiculo_api_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'placa_veiculo_api_out' => NM_utf8_urldecode($placa_veiculo_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_placa_veiculo_api_out

    function ajax_form_transfer_rsvp_validate_id_evento_app_out($id_evento_app_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_id_evento_app_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'id_evento_app_out' => NM_utf8_urldecode($id_evento_app_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_id_evento_app_out

    function ajax_form_transfer_rsvp_validate_id_participante_app_out($id_participante_app_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_id_participante_app_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'id_participante_app_out' => NM_utf8_urldecode($id_participante_app_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_id_participante_app_out

    function ajax_form_transfer_rsvp_validate_id_voucher_app_out($id_voucher_app_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'validate_id_voucher_app_out';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'id_voucher_app_out' => NM_utf8_urldecode($id_voucher_app_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_validate_id_voucher_app_out

    function ajax_form_transfer_rsvp_event_enviar_app_onclick($enviar_app, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'event_enviar_app_onclick';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'enviar_app' => NM_utf8_urldecode($enviar_app),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_event_enviar_app_onclick

    function ajax_form_transfer_rsvp_event_local_de_destino_api_out_onclick($local_de_destino_api_out, $latitude_destino_api_out, $longitude_destino_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'event_local_de_destino_api_out_onclick';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'local_de_destino_api_out' => NM_utf8_urldecode($local_de_destino_api_out),
                  'latitude_destino_api_out' => NM_utf8_urldecode($latitude_destino_api_out),
                  'longitude_destino_api_out' => NM_utf8_urldecode($longitude_destino_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_event_local_de_destino_api_out_onclick

    function ajax_form_transfer_rsvp_event_local_de_origem_api_onchange($local_de_origem_api, $latitude_origem_api, $longitude_origem_api, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'event_local_de_origem_api_onchange';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'local_de_origem_api' => NM_utf8_urldecode($local_de_origem_api),
                  'latitude_origem_api' => NM_utf8_urldecode($latitude_origem_api),
                  'longitude_origem_api' => NM_utf8_urldecode($longitude_origem_api),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_event_local_de_origem_api_onchange

    function ajax_form_transfer_rsvp_event_local_de_origem_api_out_onchange($local_de_origem_api_out, $latitude_origem_api_out, $longitude_origem_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'event_local_de_origem_api_out_onchange';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'local_de_origem_api_out' => NM_utf8_urldecode($local_de_origem_api_out),
                  'latitude_origem_api_out' => NM_utf8_urldecode($latitude_origem_api_out),
                  'longitude_origem_api_out' => NM_utf8_urldecode($longitude_origem_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_event_local_de_origem_api_out_onchange

    function ajax_form_transfer_rsvp_event_local_destino_api_onchange($local_destino_api, $latitude_destino_api, $longitude_destino_api, $longitude_origem_api, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'event_local_destino_api_onchange';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'local_destino_api' => NM_utf8_urldecode($local_destino_api),
                  'latitude_destino_api' => NM_utf8_urldecode($latitude_destino_api),
                  'longitude_destino_api' => NM_utf8_urldecode($longitude_destino_api),
                  'longitude_origem_api' => NM_utf8_urldecode($longitude_origem_api),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_event_local_destino_api_onchange

    function ajax_form_transfer_rsvp_event_tra_flag_ida_local_onchange($tra_flag_ida_local, $tra_flag_volta, $tra_flag_ida, $tra_flag_proprio, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'event_tra_flag_ida_local_onchange';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_flag_ida_local' => NM_utf8_urldecode($tra_flag_ida_local),
                  'tra_flag_volta' => NM_utf8_urldecode($tra_flag_volta),
                  'tra_flag_ida' => NM_utf8_urldecode($tra_flag_ida),
                  'tra_flag_proprio' => NM_utf8_urldecode($tra_flag_proprio),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_event_tra_flag_ida_local_onchange

    function ajax_form_transfer_rsvp_event_tra_flag_ida_onchange($tra_flag_ida, $tra_flag_volta, $tra_flag_proprio, $tra_flag_ida_local, $tra_flag_volta_local, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'event_tra_flag_ida_onchange';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_flag_ida' => NM_utf8_urldecode($tra_flag_ida),
                  'tra_flag_volta' => NM_utf8_urldecode($tra_flag_volta),
                  'tra_flag_proprio' => NM_utf8_urldecode($tra_flag_proprio),
                  'tra_flag_ida_local' => NM_utf8_urldecode($tra_flag_ida_local),
                  'tra_flag_volta_local' => NM_utf8_urldecode($tra_flag_volta_local),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_event_tra_flag_ida_onchange

    function ajax_form_transfer_rsvp_event_tra_flag_proprio_onchange($tra_flag_proprio, $tra_flag_volta, $tra_flag_ida, $tra_flag_ida_local, $tra_flag_volta_local, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'event_tra_flag_proprio_onchange';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_flag_proprio' => NM_utf8_urldecode($tra_flag_proprio),
                  'tra_flag_volta' => NM_utf8_urldecode($tra_flag_volta),
                  'tra_flag_ida' => NM_utf8_urldecode($tra_flag_ida),
                  'tra_flag_ida_local' => NM_utf8_urldecode($tra_flag_ida_local),
                  'tra_flag_volta_local' => NM_utf8_urldecode($tra_flag_volta_local),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_event_tra_flag_proprio_onchange

    function ajax_form_transfer_rsvp_event_tra_flag_volta_local_onchange($tra_flag_volta, $tra_flag_ida, $tra_flag_proprio, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'event_tra_flag_volta_local_onchange';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_flag_volta' => NM_utf8_urldecode($tra_flag_volta),
                  'tra_flag_ida' => NM_utf8_urldecode($tra_flag_ida),
                  'tra_flag_proprio' => NM_utf8_urldecode($tra_flag_proprio),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_event_tra_flag_volta_local_onchange

    function ajax_form_transfer_rsvp_event_tra_flag_volta_onchange($tra_flag_volta, $tra_flag_ida, $tra_flag_proprio, $tra_flag_ida_local, $tra_flag_volta_local, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'event_tra_flag_volta_onchange';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_flag_volta' => NM_utf8_urldecode($tra_flag_volta),
                  'tra_flag_ida' => NM_utf8_urldecode($tra_flag_ida),
                  'tra_flag_proprio' => NM_utf8_urldecode($tra_flag_proprio),
                  'tra_flag_ida_local' => NM_utf8_urldecode($tra_flag_ida_local),
                  'tra_flag_volta_local' => NM_utf8_urldecode($tra_flag_volta_local),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_event_tra_flag_volta_onchange

    function ajax_form_transfer_rsvp_event_tra_id_hotel_onchange($tra_id_hotel, $hotel_dsc, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'event_tra_id_hotel_onchange';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_id_hotel' => NM_utf8_urldecode($tra_id_hotel),
                  'hotel_dsc' => NM_utf8_urldecode($hotel_dsc),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_event_tra_id_hotel_onchange

    function ajax_form_transfer_rsvp_event_tra_id_hotel_out_onchange($tra_id_hotel_out, $hotel_dsc_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'event_tra_id_hotel_out_onchange';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_id_hotel_out' => NM_utf8_urldecode($tra_id_hotel_out),
                  'hotel_dsc_out' => NM_utf8_urldecode($hotel_dsc_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_event_tra_id_hotel_out_onchange

    function ajax_form_transfer_rsvp_event_tra_intervalo_onchange($tra_hr_saida_volta, $tra_intervalo, $tra_hrtransout, $hr_saida_origem_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'event_tra_intervalo_onchange';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_hr_saida_volta' => NM_utf8_urldecode($tra_hr_saida_volta),
                  'tra_intervalo' => NM_utf8_urldecode($tra_intervalo),
                  'tra_hrtransout' => NM_utf8_urldecode($tra_hrtransout),
                  'hr_saida_origem_api_out' => NM_utf8_urldecode($hr_saida_origem_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_event_tra_intervalo_onchange

    function ajax_form_transfer_rsvp_event_tra_status_onfocus($tra_tipo, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'event_tra_status_onfocus';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_tipo' => NM_utf8_urldecode($tra_tipo),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_event_tra_status_onfocus

    function ajax_form_transfer_rsvp_event_tra_tipo_onchange($tra_tipo, $tra_dt_chegada_proprio, $tra_hr_chegada_proprio, $tra_dt_ida_local, $tra_hr_ida_local, $tra_dt_volta_local, $tra_hr_volta_local, $tra_origem_ida_local, $tra_destino_ida_local, $tra_origem_volta_local, $tra_destino_volta_local, $tra_flag_proprio, $tra_flag_volta_local, $enviar_app, $titulo_api, $descricao_api, $codigo_api, $tipo_api, $status_api, $valido_de_api, $valido_ate_api, $local_de_origem_api, $latitude_origem_api, $longitude_origem_api, $hr_saida_origem_api, $veiculo_api, $companhia_api, $nome_motorista_api, $matricula_api, $duracao_percurso_api, $comodidades_api, $observacao_api, $placa_veiculo_api, $titulo_api_out, $descricao_api_out, $codigo_api_out, $tipo_api_out, $status_api_out, $valido_de_api_out, $valido_ate_api_out, $local_de_origem_api_out, $latitude_origem_api_out, $longitude_origem_api_out, $hr_saida_origem_api_out, $veiculo_api_out, $companhia_api_out, $nome_motorista_api_out, $matricula_api_out, $duracao_percurso_api_out, $comodidades_api_out, $observacao_api_out, $placa_veiculo_api_out, $tra_cia_ida, $tra_numvoo_ida, $tra_origem_ida, $tra_destino_ida, $tra_dt_saida_ida, $tra_hr_saida_ida, $tra_dt_chegada_ida, $tra_hr_chegada_ida, $tra_localizador_ida, $cia_ida_dsc, $destino_ida_dsc, $origem_ida_dsc, $tra_flag_ida, $tra_eticket_ida, $tra_cia_volta, $tra_numvoo_volta, $tra_origem_volta, $tra_destino_volta, $tra_dt_saida_volta, $tra_hr_saida_volta, $tra_dt_chegada_volta, $tra_hr_chegada_volta, $tra_localizador_volta, $tra_eticket_volta, $cia_volta_dsc, $destino_volta_dsc, $origem_volta_dsc, $tra_flag_volta, $tra_id_hotel, $hotel_dsc, $tra_id_hotel_out, $hotel_dsc_out, $local_destino_api, $latitude_destino_api, $longitude_destino_api, $tra_hrtransout, $local_de_destino_api_out, $latitude_destino_api_out, $longitude_destino_api_out, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'event_tra_tipo_onchange';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_tipo' => NM_utf8_urldecode($tra_tipo),
                  'tra_dt_chegada_proprio' => NM_utf8_urldecode($tra_dt_chegada_proprio),
                  'tra_hr_chegada_proprio' => NM_utf8_urldecode($tra_hr_chegada_proprio),
                  'tra_dt_ida_local' => NM_utf8_urldecode($tra_dt_ida_local),
                  'tra_hr_ida_local' => NM_utf8_urldecode($tra_hr_ida_local),
                  'tra_dt_volta_local' => NM_utf8_urldecode($tra_dt_volta_local),
                  'tra_hr_volta_local' => NM_utf8_urldecode($tra_hr_volta_local),
                  'tra_origem_ida_local' => NM_utf8_urldecode($tra_origem_ida_local),
                  'tra_destino_ida_local' => NM_utf8_urldecode($tra_destino_ida_local),
                  'tra_origem_volta_local' => NM_utf8_urldecode($tra_origem_volta_local),
                  'tra_destino_volta_local' => NM_utf8_urldecode($tra_destino_volta_local),
                  'tra_flag_proprio' => NM_utf8_urldecode($tra_flag_proprio),
                  'tra_flag_volta_local' => NM_utf8_urldecode($tra_flag_volta_local),
                  'enviar_app' => NM_utf8_urldecode($enviar_app),
                  'titulo_api' => NM_utf8_urldecode($titulo_api),
                  'descricao_api' => NM_utf8_urldecode($descricao_api),
                  'codigo_api' => NM_utf8_urldecode($codigo_api),
                  'tipo_api' => NM_utf8_urldecode($tipo_api),
                  'status_api' => NM_utf8_urldecode($status_api),
                  'valido_de_api' => NM_utf8_urldecode($valido_de_api),
                  'valido_ate_api' => NM_utf8_urldecode($valido_ate_api),
                  'local_de_origem_api' => NM_utf8_urldecode($local_de_origem_api),
                  'latitude_origem_api' => NM_utf8_urldecode($latitude_origem_api),
                  'longitude_origem_api' => NM_utf8_urldecode($longitude_origem_api),
                  'hr_saida_origem_api' => NM_utf8_urldecode($hr_saida_origem_api),
                  'veiculo_api' => NM_utf8_urldecode($veiculo_api),
                  'companhia_api' => NM_utf8_urldecode($companhia_api),
                  'nome_motorista_api' => NM_utf8_urldecode($nome_motorista_api),
                  'matricula_api' => NM_utf8_urldecode($matricula_api),
                  'duracao_percurso_api' => NM_utf8_urldecode($duracao_percurso_api),
                  'comodidades_api' => NM_utf8_urldecode($comodidades_api),
                  'observacao_api' => NM_utf8_urldecode($observacao_api),
                  'placa_veiculo_api' => NM_utf8_urldecode($placa_veiculo_api),
                  'titulo_api_out' => NM_utf8_urldecode($titulo_api_out),
                  'descricao_api_out' => NM_utf8_urldecode($descricao_api_out),
                  'codigo_api_out' => NM_utf8_urldecode($codigo_api_out),
                  'tipo_api_out' => NM_utf8_urldecode($tipo_api_out),
                  'status_api_out' => NM_utf8_urldecode($status_api_out),
                  'valido_de_api_out' => NM_utf8_urldecode($valido_de_api_out),
                  'valido_ate_api_out' => NM_utf8_urldecode($valido_ate_api_out),
                  'local_de_origem_api_out' => NM_utf8_urldecode($local_de_origem_api_out),
                  'latitude_origem_api_out' => NM_utf8_urldecode($latitude_origem_api_out),
                  'longitude_origem_api_out' => NM_utf8_urldecode($longitude_origem_api_out),
                  'hr_saida_origem_api_out' => NM_utf8_urldecode($hr_saida_origem_api_out),
                  'veiculo_api_out' => NM_utf8_urldecode($veiculo_api_out),
                  'companhia_api_out' => NM_utf8_urldecode($companhia_api_out),
                  'nome_motorista_api_out' => NM_utf8_urldecode($nome_motorista_api_out),
                  'matricula_api_out' => NM_utf8_urldecode($matricula_api_out),
                  'duracao_percurso_api_out' => NM_utf8_urldecode($duracao_percurso_api_out),
                  'comodidades_api_out' => NM_utf8_urldecode($comodidades_api_out),
                  'observacao_api_out' => NM_utf8_urldecode($observacao_api_out),
                  'placa_veiculo_api_out' => NM_utf8_urldecode($placa_veiculo_api_out),
                  'tra_cia_ida' => NM_utf8_urldecode($tra_cia_ida),
                  'tra_numvoo_ida' => NM_utf8_urldecode($tra_numvoo_ida),
                  'tra_origem_ida' => NM_utf8_urldecode($tra_origem_ida),
                  'tra_destino_ida' => NM_utf8_urldecode($tra_destino_ida),
                  'tra_dt_saida_ida' => NM_utf8_urldecode($tra_dt_saida_ida),
                  'tra_hr_saida_ida' => NM_utf8_urldecode($tra_hr_saida_ida),
                  'tra_dt_chegada_ida' => NM_utf8_urldecode($tra_dt_chegada_ida),
                  'tra_hr_chegada_ida' => NM_utf8_urldecode($tra_hr_chegada_ida),
                  'tra_localizador_ida' => NM_utf8_urldecode($tra_localizador_ida),
                  'cia_ida_dsc' => NM_utf8_urldecode($cia_ida_dsc),
                  'destino_ida_dsc' => NM_utf8_urldecode($destino_ida_dsc),
                  'origem_ida_dsc' => NM_utf8_urldecode($origem_ida_dsc),
                  'tra_flag_ida' => NM_utf8_urldecode($tra_flag_ida),
                  'tra_eticket_ida' => NM_utf8_urldecode($tra_eticket_ida),
                  'tra_cia_volta' => NM_utf8_urldecode($tra_cia_volta),
                  'tra_numvoo_volta' => NM_utf8_urldecode($tra_numvoo_volta),
                  'tra_origem_volta' => NM_utf8_urldecode($tra_origem_volta),
                  'tra_destino_volta' => NM_utf8_urldecode($tra_destino_volta),
                  'tra_dt_saida_volta' => NM_utf8_urldecode($tra_dt_saida_volta),
                  'tra_hr_saida_volta' => NM_utf8_urldecode($tra_hr_saida_volta),
                  'tra_dt_chegada_volta' => NM_utf8_urldecode($tra_dt_chegada_volta),
                  'tra_hr_chegada_volta' => NM_utf8_urldecode($tra_hr_chegada_volta),
                  'tra_localizador_volta' => NM_utf8_urldecode($tra_localizador_volta),
                  'tra_eticket_volta' => NM_utf8_urldecode($tra_eticket_volta),
                  'cia_volta_dsc' => NM_utf8_urldecode($cia_volta_dsc),
                  'destino_volta_dsc' => NM_utf8_urldecode($destino_volta_dsc),
                  'origem_volta_dsc' => NM_utf8_urldecode($origem_volta_dsc),
                  'tra_flag_volta' => NM_utf8_urldecode($tra_flag_volta),
                  'tra_id_hotel' => NM_utf8_urldecode($tra_id_hotel),
                  'hotel_dsc' => NM_utf8_urldecode($hotel_dsc),
                  'tra_id_hotel_out' => NM_utf8_urldecode($tra_id_hotel_out),
                  'hotel_dsc_out' => NM_utf8_urldecode($hotel_dsc_out),
                  'local_destino_api' => NM_utf8_urldecode($local_destino_api),
                  'latitude_destino_api' => NM_utf8_urldecode($latitude_destino_api),
                  'longitude_destino_api' => NM_utf8_urldecode($longitude_destino_api),
                  'tra_hrtransout' => NM_utf8_urldecode($tra_hrtransout),
                  'local_de_destino_api_out' => NM_utf8_urldecode($local_de_destino_api_out),
                  'latitude_destino_api_out' => NM_utf8_urldecode($latitude_destino_api_out),
                  'longitude_destino_api_out' => NM_utf8_urldecode($longitude_destino_api_out),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_event_tra_tipo_onchange

    function ajax_form_transfer_rsvp_event_tra_ult_trecho_volta_onchange($tra_tipo, $tra_cia_ida, $tra_numvoo_ida, $tra_origem_ida, $tra_destino_ida, $tra_dt_saida_ida, $tra_hr_saida_ida, $tra_dt_chegada_ida, $tra_hr_chegada_ida, $tra_localizador_ida, $tra_eticket_ida, $cia_ida_dsc, $origem_ida_dsc, $destino_ida_dsc, $tra_cia_volta, $tra_numvoo_volta, $tra_origem_volta, $tra_destino_volta, $tra_dt_saida_volta, $tra_hr_saida_volta, $tra_dt_chegada_volta, $tra_hr_chegada_volta, $tra_localizador_volta, $tra_eticket_volta, $cia_volta_dsc, $origem_volta_dsc, $destino_volta_dsc, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'event_tra_ult_trecho_volta_onchange';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_tipo' => NM_utf8_urldecode($tra_tipo),
                  'tra_cia_ida' => NM_utf8_urldecode($tra_cia_ida),
                  'tra_numvoo_ida' => NM_utf8_urldecode($tra_numvoo_ida),
                  'tra_origem_ida' => NM_utf8_urldecode($tra_origem_ida),
                  'tra_destino_ida' => NM_utf8_urldecode($tra_destino_ida),
                  'tra_dt_saida_ida' => NM_utf8_urldecode($tra_dt_saida_ida),
                  'tra_hr_saida_ida' => NM_utf8_urldecode($tra_hr_saida_ida),
                  'tra_dt_chegada_ida' => NM_utf8_urldecode($tra_dt_chegada_ida),
                  'tra_hr_chegada_ida' => NM_utf8_urldecode($tra_hr_chegada_ida),
                  'tra_localizador_ida' => NM_utf8_urldecode($tra_localizador_ida),
                  'tra_eticket_ida' => NM_utf8_urldecode($tra_eticket_ida),
                  'cia_ida_dsc' => NM_utf8_urldecode($cia_ida_dsc),
                  'origem_ida_dsc' => NM_utf8_urldecode($origem_ida_dsc),
                  'destino_ida_dsc' => NM_utf8_urldecode($destino_ida_dsc),
                  'tra_cia_volta' => NM_utf8_urldecode($tra_cia_volta),
                  'tra_numvoo_volta' => NM_utf8_urldecode($tra_numvoo_volta),
                  'tra_origem_volta' => NM_utf8_urldecode($tra_origem_volta),
                  'tra_destino_volta' => NM_utf8_urldecode($tra_destino_volta),
                  'tra_dt_saida_volta' => NM_utf8_urldecode($tra_dt_saida_volta),
                  'tra_hr_saida_volta' => NM_utf8_urldecode($tra_hr_saida_volta),
                  'tra_dt_chegada_volta' => NM_utf8_urldecode($tra_dt_chegada_volta),
                  'tra_hr_chegada_volta' => NM_utf8_urldecode($tra_hr_chegada_volta),
                  'tra_localizador_volta' => NM_utf8_urldecode($tra_localizador_volta),
                  'tra_eticket_volta' => NM_utf8_urldecode($tra_eticket_volta),
                  'cia_volta_dsc' => NM_utf8_urldecode($cia_volta_dsc),
                  'origem_volta_dsc' => NM_utf8_urldecode($origem_volta_dsc),
                  'destino_volta_dsc' => NM_utf8_urldecode($destino_volta_dsc),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_event_tra_ult_trecho_volta_onchange

    function ajax_form_transfer_rsvp_submit_form($tra_id_evento, $evento_dsc, $tra_cpf_particip, $tipo_dsc, $tra_id_usuario, $atendente_dsc, $tra_tipo, $tra_id_hotel, $hotel_dsc, $tra_id_hotel_out, $hotel_dsc_out, $enviar_app, $tra_status, $ult_trecho, $tra_cia_ida, $cia_ida_dsc, $tra_numvoo_ida, $tra_origem_ida, $origem_ida_dsc, $tra_destino_ida, $destino_ida_dsc, $tra_dt_saida_ida, $tra_hr_saida_ida, $tra_dt_chegada_ida, $tra_hr_chegada_ida, $tra_localizador_ida, $tra_eticket_ida, $tra_flag_ida, $tra_cia_volta, $cia_volta_dsc, $tra_numvoo_volta, $tra_origem_volta, $origem_volta_dsc, $tra_destino_volta, $destino_volta_dsc, $tra_dt_saida_volta, $tra_hr_saida_volta, $tra_dt_chegada_volta, $tra_hr_chegada_volta, $tra_localizador_volta, $tra_eticket_volta, $tra_intervalo, $tra_hrtransout, $tra_flag_volta, $tra_dt_chegada_proprio, $tra_hr_chegada_proprio, $tra_flag_proprio, $tra_dt_ida_local, $tra_hr_ida_local, $tra_origem_ida_local, $tra_destino_ida_local, $tra_flag_ida_local, $tra_dt_volta_local, $tra_hr_volta_local, $tra_origem_volta_local, $tra_destino_volta_local, $tra_flag_volta_local, $tra_observacao, $tra_ativo, $tra_dt_alteracao, $cpf_del, $sql_log, $titulo_api, $descricao_api, $codigo_api, $tipo_api, $status_api, $valido_de_api, $valido_ate_api, $local_de_origem_api, $latitude_origem_api, $longitude_origem_api, $hr_saida_origem_api, $local_destino_api, $latitude_destino_api, $longitude_destino_api, $veiculo_api, $companhia_api, $nome_motorista_api, $contato_motorista_api, $matricula_api, $duracao_percurso_api, $comodidades_api, $observacao_api, $placa_veiculo_api, $id_evento_app, $id_participante_app, $id_voucher_app, $titulo_api_out, $descricao_api_out, $codigo_api_out, $tipo_api_out, $status_api_out, $valido_de_api_out, $valido_ate_api_out, $local_de_origem_api_out, $latitude_origem_api_out, $longitude_origem_api_out, $hr_saida_origem_api_out, $local_de_destino_api_out, $latitude_destino_api_out, $longitude_destino_api_out, $veiculo_api_out, $companhia_api_out, $nome_motorista_api_out, $contato_motorista_api_out, $matricula_api_out, $duracao_percurso_api_out, $comodidades_api_out, $observacao_api_out, $placa_veiculo_api_out, $id_evento_app_out, $id_participante_app_out, $id_voucher_app_out, $nm_form_submit, $nmgp_url_saida, $nmgp_opcao, $nmgp_ancora, $nmgp_num_form, $nmgp_parms, $script_case_init, $csrf_token)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'submit_form';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'tra_id_evento' => NM_utf8_urldecode($tra_id_evento),
                  'evento_dsc' => NM_utf8_urldecode($evento_dsc),
                  'tra_cpf_particip' => NM_utf8_urldecode($tra_cpf_particip),
                  'tipo_dsc' => NM_utf8_urldecode($tipo_dsc),
                  'tra_id_usuario' => NM_utf8_urldecode($tra_id_usuario),
                  'atendente_dsc' => NM_utf8_urldecode($atendente_dsc),
                  'tra_tipo' => NM_utf8_urldecode($tra_tipo),
                  'tra_id_hotel' => NM_utf8_urldecode($tra_id_hotel),
                  'hotel_dsc' => NM_utf8_urldecode($hotel_dsc),
                  'tra_id_hotel_out' => NM_utf8_urldecode($tra_id_hotel_out),
                  'hotel_dsc_out' => NM_utf8_urldecode($hotel_dsc_out),
                  'enviar_app' => NM_utf8_urldecode($enviar_app),
                  'tra_status' => NM_utf8_urldecode($tra_status),
                  'ult_trecho' => NM_utf8_urldecode($ult_trecho),
                  'tra_cia_ida' => NM_utf8_urldecode($tra_cia_ida),
                  'cia_ida_dsc' => NM_utf8_urldecode($cia_ida_dsc),
                  'tra_numvoo_ida' => NM_utf8_urldecode($tra_numvoo_ida),
                  'tra_origem_ida' => NM_utf8_urldecode($tra_origem_ida),
                  'origem_ida_dsc' => NM_utf8_urldecode($origem_ida_dsc),
                  'tra_destino_ida' => NM_utf8_urldecode($tra_destino_ida),
                  'destino_ida_dsc' => NM_utf8_urldecode($destino_ida_dsc),
                  'tra_dt_saida_ida' => NM_utf8_urldecode($tra_dt_saida_ida),
                  'tra_hr_saida_ida' => NM_utf8_urldecode($tra_hr_saida_ida),
                  'tra_dt_chegada_ida' => NM_utf8_urldecode($tra_dt_chegada_ida),
                  'tra_hr_chegada_ida' => NM_utf8_urldecode($tra_hr_chegada_ida),
                  'tra_localizador_ida' => NM_utf8_urldecode($tra_localizador_ida),
                  'tra_eticket_ida' => NM_utf8_urldecode($tra_eticket_ida),
                  'tra_flag_ida' => NM_utf8_urldecode($tra_flag_ida),
                  'tra_cia_volta' => NM_utf8_urldecode($tra_cia_volta),
                  'cia_volta_dsc' => NM_utf8_urldecode($cia_volta_dsc),
                  'tra_numvoo_volta' => NM_utf8_urldecode($tra_numvoo_volta),
                  'tra_origem_volta' => NM_utf8_urldecode($tra_origem_volta),
                  'origem_volta_dsc' => NM_utf8_urldecode($origem_volta_dsc),
                  'tra_destino_volta' => NM_utf8_urldecode($tra_destino_volta),
                  'destino_volta_dsc' => NM_utf8_urldecode($destino_volta_dsc),
                  'tra_dt_saida_volta' => NM_utf8_urldecode($tra_dt_saida_volta),
                  'tra_hr_saida_volta' => NM_utf8_urldecode($tra_hr_saida_volta),
                  'tra_dt_chegada_volta' => NM_utf8_urldecode($tra_dt_chegada_volta),
                  'tra_hr_chegada_volta' => NM_utf8_urldecode($tra_hr_chegada_volta),
                  'tra_localizador_volta' => NM_utf8_urldecode($tra_localizador_volta),
                  'tra_eticket_volta' => NM_utf8_urldecode($tra_eticket_volta),
                  'tra_intervalo' => NM_utf8_urldecode($tra_intervalo),
                  'tra_hrtransout' => NM_utf8_urldecode($tra_hrtransout),
                  'tra_flag_volta' => NM_utf8_urldecode($tra_flag_volta),
                  'tra_dt_chegada_proprio' => NM_utf8_urldecode($tra_dt_chegada_proprio),
                  'tra_hr_chegada_proprio' => NM_utf8_urldecode($tra_hr_chegada_proprio),
                  'tra_flag_proprio' => NM_utf8_urldecode($tra_flag_proprio),
                  'tra_dt_ida_local' => NM_utf8_urldecode($tra_dt_ida_local),
                  'tra_hr_ida_local' => NM_utf8_urldecode($tra_hr_ida_local),
                  'tra_origem_ida_local' => NM_utf8_urldecode($tra_origem_ida_local),
                  'tra_destino_ida_local' => NM_utf8_urldecode($tra_destino_ida_local),
                  'tra_flag_ida_local' => NM_utf8_urldecode($tra_flag_ida_local),
                  'tra_dt_volta_local' => NM_utf8_urldecode($tra_dt_volta_local),
                  'tra_hr_volta_local' => NM_utf8_urldecode($tra_hr_volta_local),
                  'tra_origem_volta_local' => NM_utf8_urldecode($tra_origem_volta_local),
                  'tra_destino_volta_local' => NM_utf8_urldecode($tra_destino_volta_local),
                  'tra_flag_volta_local' => NM_utf8_urldecode($tra_flag_volta_local),
                  'tra_observacao' => NM_utf8_urldecode($tra_observacao),
                  'tra_ativo' => NM_utf8_urldecode($tra_ativo),
                  'tra_dt_alteracao' => NM_utf8_urldecode($tra_dt_alteracao),
                  'cpf_del' => NM_utf8_urldecode($cpf_del),
                  'sql_log' => NM_utf8_urldecode($sql_log),
                  'titulo_api' => NM_utf8_urldecode($titulo_api),
                  'descricao_api' => NM_utf8_urldecode($descricao_api),
                  'codigo_api' => NM_utf8_urldecode($codigo_api),
                  'tipo_api' => NM_utf8_urldecode($tipo_api),
                  'status_api' => NM_utf8_urldecode($status_api),
                  'valido_de_api' => NM_utf8_urldecode($valido_de_api),
                  'valido_ate_api' => NM_utf8_urldecode($valido_ate_api),
                  'local_de_origem_api' => NM_utf8_urldecode($local_de_origem_api),
                  'latitude_origem_api' => NM_utf8_urldecode($latitude_origem_api),
                  'longitude_origem_api' => NM_utf8_urldecode($longitude_origem_api),
                  'hr_saida_origem_api' => NM_utf8_urldecode($hr_saida_origem_api),
                  'local_destino_api' => NM_utf8_urldecode($local_destino_api),
                  'latitude_destino_api' => NM_utf8_urldecode($latitude_destino_api),
                  'longitude_destino_api' => NM_utf8_urldecode($longitude_destino_api),
                  'veiculo_api' => NM_utf8_urldecode($veiculo_api),
                  'companhia_api' => NM_utf8_urldecode($companhia_api),
                  'nome_motorista_api' => NM_utf8_urldecode($nome_motorista_api),
                  'contato_motorista_api' => NM_utf8_urldecode($contato_motorista_api),
                  'matricula_api' => NM_utf8_urldecode($matricula_api),
                  'duracao_percurso_api' => NM_utf8_urldecode($duracao_percurso_api),
                  'comodidades_api' => NM_utf8_urldecode($comodidades_api),
                  'observacao_api' => NM_utf8_urldecode($observacao_api),
                  'placa_veiculo_api' => NM_utf8_urldecode($placa_veiculo_api),
                  'id_evento_app' => NM_utf8_urldecode($id_evento_app),
                  'id_participante_app' => NM_utf8_urldecode($id_participante_app),
                  'id_voucher_app' => NM_utf8_urldecode($id_voucher_app),
                  'titulo_api_out' => NM_utf8_urldecode($titulo_api_out),
                  'descricao_api_out' => NM_utf8_urldecode($descricao_api_out),
                  'codigo_api_out' => NM_utf8_urldecode($codigo_api_out),
                  'tipo_api_out' => NM_utf8_urldecode($tipo_api_out),
                  'status_api_out' => NM_utf8_urldecode($status_api_out),
                  'valido_de_api_out' => NM_utf8_urldecode($valido_de_api_out),
                  'valido_ate_api_out' => NM_utf8_urldecode($valido_ate_api_out),
                  'local_de_origem_api_out' => NM_utf8_urldecode($local_de_origem_api_out),
                  'latitude_origem_api_out' => NM_utf8_urldecode($latitude_origem_api_out),
                  'longitude_origem_api_out' => NM_utf8_urldecode($longitude_origem_api_out),
                  'hr_saida_origem_api_out' => NM_utf8_urldecode($hr_saida_origem_api_out),
                  'local_de_destino_api_out' => NM_utf8_urldecode($local_de_destino_api_out),
                  'latitude_destino_api_out' => NM_utf8_urldecode($latitude_destino_api_out),
                  'longitude_destino_api_out' => NM_utf8_urldecode($longitude_destino_api_out),
                  'veiculo_api_out' => NM_utf8_urldecode($veiculo_api_out),
                  'companhia_api_out' => NM_utf8_urldecode($companhia_api_out),
                  'nome_motorista_api_out' => NM_utf8_urldecode($nome_motorista_api_out),
                  'contato_motorista_api_out' => NM_utf8_urldecode($contato_motorista_api_out),
                  'matricula_api_out' => NM_utf8_urldecode($matricula_api_out),
                  'duracao_percurso_api_out' => NM_utf8_urldecode($duracao_percurso_api_out),
                  'comodidades_api_out' => NM_utf8_urldecode($comodidades_api_out),
                  'observacao_api_out' => NM_utf8_urldecode($observacao_api_out),
                  'placa_veiculo_api_out' => NM_utf8_urldecode($placa_veiculo_api_out),
                  'id_evento_app_out' => NM_utf8_urldecode($id_evento_app_out),
                  'id_participante_app_out' => NM_utf8_urldecode($id_participante_app_out),
                  'id_voucher_app_out' => NM_utf8_urldecode($id_voucher_app_out),
                  'nm_form_submit' => NM_utf8_urldecode($nm_form_submit),
                  'nmgp_url_saida' => NM_utf8_urldecode($nmgp_url_saida),
                  'nmgp_opcao' => NM_utf8_urldecode($nmgp_opcao),
                  'nmgp_ancora' => NM_utf8_urldecode($nmgp_ancora),
                  'nmgp_num_form' => NM_utf8_urldecode($nmgp_num_form),
                  'nmgp_parms' => NM_utf8_urldecode($nmgp_parms),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'csrf_token' => NM_utf8_urldecode($csrf_token),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_submit_form

    function ajax_form_transfer_rsvp_navigate_form($id_transfer, $nm_form_submit, $nmgp_opcao, $nmgp_ordem, $nmgp_fast_search, $nmgp_cond_fast_search, $nmgp_arg_fast_search, $nmgp_arg_dyn_search, $script_case_init)
    {
        global $inicial_form_transfer_rsvp;
        //register_shutdown_function("form_transfer_rsvp_pack_ajax_response");
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_flag          = true;
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao         = 'navigate_form';
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param'] = array(
                  'id_transfer' => NM_utf8_urldecode($id_transfer),
                  'nm_form_submit' => NM_utf8_urldecode($nm_form_submit),
                  'nmgp_opcao' => NM_utf8_urldecode($nmgp_opcao),
                  'nmgp_ordem' => NM_utf8_urldecode($nmgp_ordem),
                  'nmgp_fast_search' => NM_utf8_urldecode($nmgp_fast_search),
                  'nmgp_cond_fast_search' => NM_utf8_urldecode($nmgp_cond_fast_search),
                  'nmgp_arg_fast_search' => NM_utf8_urldecode($nmgp_arg_fast_search),
                  'nmgp_arg_dyn_search' => NM_utf8_urldecode($nmgp_arg_dyn_search),
                  'script_case_init' => NM_utf8_urldecode($script_case_init),
                  'buffer_output' => true,
                 );
        if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
        {
            ob_start();
        }
        $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->controle();
        exit;
    } // ajax_navigate_form


   function form_transfer_rsvp_pack_ajax_response()
   {
      global $inicial_form_transfer_rsvp;
      $aResp = array();

      if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['wizard']))
      {
          $aResp['wizard'] = $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['wizard'];
      }
      if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['empty_filter']))
      {
          $aResp['empty_filter'] = $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['empty_filter'];
      }
      if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['dyn_search']['NM_Dynamic_Search']))
      {
          $aResp['dyn_search']['NM_Dynamic_Search'] = $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['dyn_search']['NM_Dynamic_Search'];
      }
      if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['dyn_search']['id_dyn_search_cmd_str']))
      {
          $aResp['dyn_search']['id_dyn_search_cmd_str'] = $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['dyn_search']['id_dyn_search_cmd_str'];
      }
      if ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['calendarReload'])
      {
         $aResp['result'] = 'CALENDARRELOAD';
      }
      elseif ('' != $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['autoComp'])
      {
         $aResp['result'] = 'AUTOCOMP';
      }
//mestre_detalhe
      elseif (!empty($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['newline']))
      {
         $aResp['result'] = 'NEWLINE';
         ob_end_clean();
      }
      elseif (!empty($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['tableRefresh']))
      {
         $aResp['result'] = 'TABLEREFRESH';
      }
//-----
      elseif (!empty($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['errList']))
      {
         $aResp['result'] = 'ERROR';
      }
      elseif (!empty($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['fldList']))
      {
         $aResp['result'] = 'SET';
      }
      else
      {
         $aResp['result'] = 'OK';
      }
      if ('AUTOCOMP' == $aResp['result'])
      {
         $aResp = $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['autoComp'];
      }
//mestre_detalhe
      elseif ('NEWLINE' == $aResp['result'])
      {
         $aResp = $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['newline'];
      }
      else
//-----
      {
         $aResp['ajaxRequest'] = $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_opcao;
         if ('CALENDARRELOAD' == $aResp['result'])
         {
            form_transfer_rsvp_pack_calendar_reload($aResp);
         }
         elseif ('ERROR' == $aResp['result'])
         {
            form_transfer_rsvp_pack_ajax_errors($aResp);
         }
         elseif ('SET' == $aResp['result'])
         {
            form_transfer_rsvp_pack_ajax_set_fields($aResp);
         }
         elseif ('TABLEREFRESH' == $aResp['result'])
         {
            form_transfer_rsvp_pack_ajax_set_fields($aResp);
            $aResp['tableRefresh'] = form_transfer_rsvp_pack_protect_string($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['tableRefresh']);
         }
         if ('OK' == $aResp['result'] || 'SET' == $aResp['result'])
         {
            form_transfer_rsvp_pack_ajax_ok($aResp);
         }
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['focus']) && '' != $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['focus'])
         {
            $aResp['setFocus'] = $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['focus'];
         }
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['closeLine']) && '' != $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['closeLine'])
         {
            $aResp['closeLine'] = $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['closeLine'];
         }
         else
         {
            $aResp['closeLine'] = 'N';
         }
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['clearUpload']) && '' != $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['clearUpload'])
         {
            $aResp['clearUpload'] = $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['clearUpload'];
         }
         else
         {
            $aResp['clearUpload'] = 'N';
         }
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['btnDisabled']) && '' != $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['btnDisabled'])
         {
            form_transfer_rsvp_pack_btn_disabled($aResp);
         }
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['btnLabel']) && '' != $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['btnLabel'])
         {
            form_transfer_rsvp_pack_btn_label($aResp);
         }
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['varList']) && !empty($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['varList']))
         {
            form_transfer_rsvp_pack_var_list($aResp);
         }
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['masterValue']) && '' != $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['masterValue'])
         {
            form_transfer_rsvp_pack_master_value($aResp);
         }
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxAlert']) && '' != $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxAlert'])
         {
            form_transfer_rsvp_pack_ajax_alert($aResp);
         }
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']) && '' != $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage'])
         {
            form_transfer_rsvp_pack_ajax_message($aResp);
         }
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxJavascript']) && '' != $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxJavascript'])
         {
            form_transfer_rsvp_pack_ajax_javascript($aResp);
         }
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['redir']) && !empty($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['redir']))
         {
            form_transfer_rsvp_pack_ajax_redir($aResp);
         }
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['redirExit']) && !empty($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['redirExit']))
         {
            form_transfer_rsvp_pack_ajax_redir_exit($aResp);
         }
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['blockDisplay']) && !empty($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['blockDisplay']))
         {
            form_transfer_rsvp_pack_ajax_block_display($aResp);
         }
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['fieldDisplay']) && !empty($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['fieldDisplay']))
         {
            form_transfer_rsvp_pack_ajax_field_display($aResp);
         }
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['buttonDisplay']) && !empty($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['buttonDisplay']))
         {
/* mantis 0021191 */            $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['buttonDisplay'] = $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->nmgp_botoes;
            form_transfer_rsvp_pack_ajax_button_display($aResp);
         }
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['buttonDisplayVert']) && !empty($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['buttonDisplayVert']))
         {
            form_transfer_rsvp_pack_ajax_button_display_vert($aResp);
         }
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['fieldLabel']) && !empty($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['fieldLabel']))
         {
            form_transfer_rsvp_pack_ajax_field_label($aResp);
         }
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['readOnly']) && !empty($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['readOnly']))
         {
            form_transfer_rsvp_pack_ajax_readonly($aResp);
         }
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['navStatus']) && !empty($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['navStatus']))
         {
            form_transfer_rsvp_pack_ajax_nav_status($aResp);
         }
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['navSummary']) && !empty($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['navSummary']))
         {
            form_transfer_rsvp_pack_ajax_nav_Summary($aResp);
         }
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['navPage']))
         {
            form_transfer_rsvp_pack_ajax_navPage($aResp);
         }
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['btnVars']) && !empty($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['btnVars']))
         {
            form_transfer_rsvp_pack_ajax_btn_vars($aResp);
         }
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['quickSearchRes']) && $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['quickSearchRes'])
         {
            $aResp['quickSearchRes'] = 'Y';
         }
         else
         {
            $aResp['quickSearchRes'] = 'N';
         }
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['dyn_search']) && !empty($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['dyn_search']))
         {
            $aResp['dyn_search'] = array();
            foreach ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['dyn_search'] as $Tag => $Val) {
                $aResp['dyn_search'][$Tag] = $Val;
            }
         }
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['event_field']) && '' != $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['event_field'])
         {
            $aResp['eventField'] = $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['event_field'];
         }
         else
         {
            $aResp['eventField'] = '__SC_NO_FIELD';
         }
         $aResp['htmOutput'] = '';
    
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output']) && $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['buffer_output'])
         {
            $aResp['htmOutput'] = ob_get_contents();
            if (false === $aResp['htmOutput'])
            {
               $aResp['htmOutput'] = '';
            }
            else
            {
               $aResp['htmOutput'] = form_transfer_rsvp_pack_protect_string(NM_charset_to_utf8($aResp['htmOutput']));
               ob_end_clean();
            }
         }
      }
      if (is_array($aResp))
      {
          if (isset($aResp['wizard'])) {
              echo json_encode($aResp);
          }
          else {
              $oJson = new Services_JSON();
              echo "var res = " . trim(sajax_get_js_repr($oJson->encode($aResp))) . "; res;";
          }
      }
      else
      {
          echo "var res = " . trim(sajax_get_js_repr($aResp)) . "; res;";
      }
      exit;
   } // form_transfer_rsvp_pack_ajax_response

   function form_transfer_rsvp_pack_calendar_reload(&$aResp)
   {
      global $inicial_form_transfer_rsvp;
      $aResp['calendarReload'] = 'OK';
   } // form_transfer_rsvp_pack_calendar_reload

   function form_transfer_rsvp_pack_ajax_errors(&$aResp)
   {
      global $inicial_form_transfer_rsvp;
      $aResp['errList'] = array();
      foreach ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['errList'] as $sField => $aMsg)
      {
         if ('geral_form_transfer_rsvp' == $sField)
         {
             $aMsg = form_transfer_rsvp_pack_ajax_remove_erros($aMsg);
         }
         foreach ($aMsg as $sMsg)
         {
            $iNumLinha = (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['nmgp_refresh_row']) && 'geral_form_transfer_rsvp' != $sField)
                       ? $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['nmgp_refresh_row'] : "";
            $aResp['errList'][] = array('fldName'  => $sField,
                                        'msgText'  => form_transfer_rsvp_pack_protect_string(NM_charset_to_utf8($sMsg)),
                                        'numLinha' => $iNumLinha);
         }
      }
   } // form_transfer_rsvp_pack_ajax_errors

   function form_transfer_rsvp_pack_ajax_remove_erros($aErrors)
   {
       $aNewErrors = array();
       if (!empty($aErrors))
       {
           $sErrorMsgs = str_replace(array('<br />', '<br>', '<BR />'), array('<BR>', '<BR>', '<BR>'), implode('<br />', $aErrors));
           $aErrorMsgs = explode('<BR>', $sErrorMsgs);
           foreach ($aErrorMsgs as $sErrorMsg)
           {
               $sErrorMsg = trim($sErrorMsg);
               if ('' != $sErrorMsg && !in_array($sErrorMsg, $aNewErrors))
               {
                   $aNewErrors[] = $sErrorMsg;
               }
           }
       }
       return $aNewErrors;
   } // form_transfer_rsvp_pack_ajax_remove_erros

   function form_transfer_rsvp_pack_ajax_ok(&$aResp)
   {
      global $inicial_form_transfer_rsvp;
      $iNumLinha = (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['nmgp_refresh_row']))
                 ? $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['nmgp_refresh_row'] : "";
      $aResp['msgDisplay'] = array('msgText'  => form_transfer_rsvp_pack_protect_string($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['msgDisplay']),
                                   'numLinha' => $iNumLinha);
   } // form_transfer_rsvp_pack_ajax_ok

   function form_transfer_rsvp_pack_ajax_set_fields(&$aResp)
   {
      global $inicial_form_transfer_rsvp;
      $iNumLinha = (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['nmgp_refresh_row']))
                 ? $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['param']['nmgp_refresh_row'] : "";
      if ('' != $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['rsSize'])
      {
         $aResp['rsSize'] = $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['rsSize'];
      }
      $aResp['fldList'] = array();
      foreach ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['fldList'] as $sField => $aData)
      {
         $aField = array();
         if (isset($aData['colNum']))
         {
            $aField['colNum'] = $aData['colNum'];
         }
         if (isset($aData['row']))
         {
            $aField['row'] = $aData['row'];
         }
         if (isset($aData['imgFile']))
         {
            $aField['imgFile'] = form_transfer_rsvp_pack_protect_string($aData['imgFile']);
         }
         if (isset($aData['imgOrig']))
         {
            $aField['imgOrig'] = form_transfer_rsvp_pack_protect_string($aData['imgOrig']);
         }
         if (isset($aData['imgLink']))
         {
            $aField['imgLink'] = form_transfer_rsvp_pack_protect_string($aData['imgLink']);
         }
         if (isset($aData['keepImg']))
         {
            $aField['keepImg'] = $aData['keepImg'];
         }
         if (isset($aData['hideName']))
         {
            $aField['hideName'] = $aData['hideName'];
         }
         if (isset($aData['docLink']))
         {
            $aField['docLink'] = form_transfer_rsvp_pack_protect_string($aData['docLink']);
         }
         if (isset($aData['docIcon']))
         {
            $aField['docIcon'] = form_transfer_rsvp_pack_protect_string($aData['docIcon']);
         }
         if (isset($aData['docReadonly']))
         {
            $aField['docReadonly'] = form_transfer_rsvp_pack_protect_string($aData['docReadonly']);
         }
         if (isset($aData['keyVal']))
         {
            $aField['keyVal'] = $aData['keyVal'];
         }
         if (isset($aData['optComp']))
         {
            $aField['optComp'] = $aData['optComp'];
         }
         if (isset($aData['optClass']))
         {
            $aField['optClass'] = $aData['optClass'];
         }
         if (isset($aData['optMulti']))
         {
            $aField['optMulti'] = $aData['optMulti'];
         }
         if (isset($aData['switch']))
         {
            $aField['switch'] = $aData['switch'];
         }
         if (isset($aData['lookupCons']))
         {
            $aField['lookupCons'] = $aData['lookupCons'];
         }
         if (isset($aData['imgHtml']))
         {
            $aField['imgHtml'] = form_transfer_rsvp_pack_protect_string($aData['imgHtml']);
         }
         if (isset($aData['mulHtml']))
         {
            $aField['mulHtml'] = form_transfer_rsvp_pack_protect_string($aData['mulHtml']);
         }
         if (isset($aData['updInnerHtml']))
         {
            $aField['updInnerHtml'] = $aData['updInnerHtml'];
         }
         if (isset($aData['htmComp']))
         {
            $aField['htmComp'] = str_replace("'", '__AS__', str_replace('"', '__AD__', $aData['htmComp']));
         }
         $aField['fldName']  = $sField;
         $aField['fldType']  = $aData['type'];
         $aField['numLinha'] = $iNumLinha;
         $aField['valList']  = array();
         foreach ($aData['valList'] as $iIndex => $sValue)
         {
            $aValue = array();
            if (isset($aData['labList'][$iIndex]))
            {
               $aValue['label'] = form_transfer_rsvp_pack_protect_string($aData['labList'][$iIndex]);
            }
            $aValue['value']     = ('_autocomp' != substr($sField, -9)) ? form_transfer_rsvp_pack_protect_string($sValue) : $sValue;
            $aField['valList'][] = $aValue;
         }
         foreach ($aField['valList'] as $iIndex => $aFieldData)
         {
             if ("null" == $aFieldData['value'])
             {
                 $aField['valList'][$iIndex]['value'] = '';
             }
         }
         if (isset($aData['optList']) && false !== $aData['optList'])
         {
            if (is_array($aData['optList']))
            {
               $aField['optList'] = array();
               foreach ($aData['optList'] as $aOptList)
               {
                  foreach ($aOptList as $sValue => $sLabel)
                  {
                     $sOpt = ($sValue !== $sLabel) ? $sValue : $sLabel;
                     $aField['optList'][] = array('value' => form_transfer_rsvp_pack_protect_string($sOpt),
                                                  'label' => form_transfer_rsvp_pack_protect_string($sLabel));
                  }
               }
            }
            else
            {
               $aField['optList'] = $aData['optList'];
            }
         }
         $aResp['fldList'][] = $aField;
      }
   } // form_transfer_rsvp_pack_ajax_set_fields

   function form_transfer_rsvp_pack_ajax_redir(&$aResp)
   {
      global $inicial_form_transfer_rsvp;

      $aInfo              = array('metodo', 'action', 'target', 'nmgp_parms', 'nmgp_outra_jan', 'nmgp_url_saida', 'script_case_init', 'h_modal', 'w_modal');

      $aResp['redirInfo'] = array();
      foreach ($aInfo as $sTag)
      {
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['redir'][$sTag]))
         {
            $aResp['redirInfo'][$sTag] = $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['redir'][$sTag];
         }
      }
   } // form_transfer_rsvp_pack_ajax_redir

   function form_transfer_rsvp_pack_ajax_redir_exit(&$aResp)
   {
      global $inicial_form_transfer_rsvp;

      $aInfo                  = array('metodo', 'action', 'target', 'nmgp_parms', 'nmgp_outra_jan', 'nmgp_url_saida', 'script_case_init');

      $aResp['redirExitInfo'] = array();
      foreach ($aInfo as $sTag)
      {
         if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['redirExit'][$sTag]))
         {
            $aResp['redirExitInfo'][$sTag] = $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['redirExit'][$sTag];
         }
      }
   } // form_transfer_rsvp_pack_ajax_redir_exit

   function form_transfer_rsvp_pack_var_list(&$aResp)
   {
      global $inicial_form_transfer_rsvp;
      foreach ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['varList'] as $varData)
      {
         $aResp['varList'][] = array('index' => key($varData),
                                      'value' => current($varData));
      }
   } // form_transfer_rsvp_pack_var_list

   function form_transfer_rsvp_pack_master_value(&$aResp)
   {
      global $inicial_form_transfer_rsvp;
      foreach ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['masterValue'] as $sIndex => $sValue)
      {
         $aResp['masterValue'][] = array('index' => $sIndex,
                                         'value' => $sValue);
      }
   } // form_transfer_rsvp_pack_master_value

   function form_transfer_rsvp_pack_btn_disabled(&$aResp)
   {
      global $inicial_form_transfer_rsvp;
      $aResp['btnDisabled'] = array();
      foreach ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['btnDisabled'] as $btnName => $btnStatus) {
        $aResp['btnDisabled'][$btnName] = $btnStatus;
      }
   } // form_transfer_rsvp_pack_ajax_alert

   function form_transfer_rsvp_pack_btn_label(&$aResp)
   {
      global $inicial_form_transfer_rsvp;
      $aResp['btnLabel'] = array();
      foreach ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['btnLabel'] as $btnName => $btnLabel) {
        $aResp['btnLabel'][$btnName] = $btnLabel;
      }
   } // form_transfer_rsvp_pack_ajax_alert

   function form_transfer_rsvp_pack_ajax_alert(&$aResp)
   {
      global $inicial_form_transfer_rsvp;
// PHP 8.0
      if (!isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxAlert']['message'])) {
          $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxAlert']['message'] = '';
      }
      if (!isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxAlert']['params'])) {
          $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxAlert']['params'] = '';
      }
//---
      $aResp['ajaxAlert'] = array('message' => $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxAlert']['message'], 'params' =>  $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxAlert']['params']);
   } // form_transfer_rsvp_pack_ajax_alert

   function form_transfer_rsvp_pack_ajax_message(&$aResp)
   {
      global $inicial_form_transfer_rsvp;
// PHP 8.0
      if (!isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['message'])) {
          $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['message'] = '';
      }
      if (!isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['title'])) {
          $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['title'] = '';
      }
//---
      $aResp['ajaxMessage'] = array('message'      => form_transfer_rsvp_pack_protect_string($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['message']),
                                    'title'        => form_transfer_rsvp_pack_protect_string($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['title']),
                                    'modal'        => isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['modal'])        ? $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['modal']        : 'N',
                                    'timeout'      => isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['timeout'])      ? $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['timeout']      : '',
                                    'button'       => isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['button'])       ? $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['button']       : '',
                                    'button_label' => isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['button_label']) ? $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['button_label'] : 'Ok',
                                    'top'          => isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['top'])          ? $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['top']          : '',
                                    'left'         => isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['left'])         ? $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['left']         : '',
                                    'width'        => isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['width'])        ? $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['width']        : '',
                                    'height'       => isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['height'])       ? $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['height']       : '',
                                    'redir'        => isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['redir'])        ? $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['redir']        : '',
                                    'show_close'   => isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['show_close'])   ? $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['show_close']   : 'Y',
                                    'body_icon'    => isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['body_icon'])    ? $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['body_icon']    : 'Y',
                                    'toast'        => isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['toast'])        ? $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['toast']        : 'N',
                                    'toast_pos'    => isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['toast_pos'])    ? $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['toast_pos']    : '',
                                    'type'         => isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['type'])         ? $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['type']         : '',
                                    'redir_target' => isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['redir_target']) ? $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['redir_target'] : '',
                                    'redir_par'    => isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['redir_par'])    ? $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxMessage']['redir_par']    : '');
   } // form_transfer_rsvp_pack_ajax_message

   function form_transfer_rsvp_pack_ajax_javascript(&$aResp)
   {
      global $inicial_form_transfer_rsvp;
      foreach ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['ajaxJavascript'] as $aJsFunc)
      {
         $aResp['ajaxJavascript'][] = $aJsFunc;
      }
   } // form_transfer_rsvp_pack_ajax_javascript

   function form_transfer_rsvp_pack_ajax_block_display(&$aResp)
   {
      global $inicial_form_transfer_rsvp;
      $aResp['blockDisplay'] = array();
      foreach ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['blockDisplay'] as $sBlockName => $sBlockStatus)
      {
        $aResp['blockDisplay'][] = array($sBlockName, $sBlockStatus);
      }
   } // form_transfer_rsvp_pack_ajax_block_display

   function form_transfer_rsvp_pack_ajax_field_display(&$aResp)
   {
      global $inicial_form_transfer_rsvp;
      $aResp['fieldDisplay'] = array();
      foreach ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['fieldDisplay'] as $sFieldName => $sFieldStatus)
      {
        $aResp['fieldDisplay'][] = array($sFieldName, $sFieldStatus);
      }
   } // form_transfer_rsvp_pack_ajax_field_display

   function form_transfer_rsvp_pack_ajax_button_display(&$aResp)
   {
      global $inicial_form_transfer_rsvp;
      $aResp['buttonDisplay'] = array();
      foreach ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['buttonDisplay'] as $sButtonName => $sButtonStatus)
      {
        $aResp['buttonDisplay'][] = array($sButtonName, $sButtonStatus);
      }
   } // form_transfer_rsvp_pack_ajax_button_display

   function form_transfer_rsvp_pack_ajax_button_display_vert(&$aResp)
   {
      global $inicial_form_transfer_rsvp;
      $aResp['buttonDisplayVert'] = array();
      foreach ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['buttonDisplayVert'] as $aButtonData)
      {
        $aResp['buttonDisplayVert'][] = $aButtonData;
      }
   } // form_transfer_rsvp_pack_ajax_button_display

   function form_transfer_rsvp_pack_ajax_field_label(&$aResp)
   {
      global $inicial_form_transfer_rsvp;
      $aResp['fieldLabel'] = array();
      foreach ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['fieldLabel'] as $sFieldName => $sFieldLabel)
      {
        $aResp['fieldLabel'][] = array($sFieldName, form_transfer_rsvp_pack_protect_string($sFieldLabel));
      }
   } // form_transfer_rsvp_pack_ajax_field_label

   function form_transfer_rsvp_pack_ajax_readonly(&$aResp)
   {
      global $inicial_form_transfer_rsvp;
      $aResp['readOnly'] = array();
      foreach ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['readOnly'] as $sFieldName => $sFieldStatus)
      {
        $aResp['readOnly'][] = array($sFieldName, $sFieldStatus);
      }
   } // form_transfer_rsvp_pack_ajax_readonly

   function form_transfer_rsvp_pack_ajax_nav_status(&$aResp)
   {
      global $inicial_form_transfer_rsvp;
      $aResp['navStatus'] = array();
      if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['navStatus']['ret']) && '' != $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['navStatus']['ret'])
      {
         $aResp['navStatus']['ret'] = $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['navStatus']['ret'];
      }
      if (isset($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['navStatus']['ava']) && '' != $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['navStatus']['ava'])
      {
         $aResp['navStatus']['ava'] = $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['navStatus']['ava'];
      }
   } // form_transfer_rsvp_pack_ajax_nav_status

   function form_transfer_rsvp_pack_ajax_nav_Summary(&$aResp)
   {
      global $inicial_form_transfer_rsvp;
      $aResp['navSummary'] = array();
      $aResp['navSummary']['reg_ini'] = $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['navSummary']['reg_ini'];
      $aResp['navSummary']['reg_qtd'] = $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['navSummary']['reg_qtd'];
      $aResp['navSummary']['reg_tot'] = $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['navSummary']['reg_tot'];
      $aResp['navSummary']['summary_line'] = $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['summary_line'];
   } // form_transfer_rsvp_pack_ajax_nav_Summary

   function form_transfer_rsvp_pack_ajax_navPage(&$aResp)
   {
      global $inicial_form_transfer_rsvp;
      $aResp['navPage'] = $inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['navPage'];
   } // form_transfer_rsvp_pack_ajax_navPage


   function form_transfer_rsvp_pack_ajax_btn_vars(&$aResp)
   {
      global $inicial_form_transfer_rsvp;
      $aResp['btnVars'] = array();
      foreach ($inicial_form_transfer_rsvp->contr_form_transfer_rsvp->NM_ajax_info['btnVars'] as $sBtnName => $sBtnValue)
      {
        $aResp['btnVars'][] = array($sBtnName, form_transfer_rsvp_pack_protect_string($sBtnValue));
      }
   } // form_transfer_rsvp_pack_ajax_btn_vars

   function form_transfer_rsvp_pack_protect_string($sString)
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
/*             return htmlentities($sString, ENT_COMPAT, $_SESSION['scriptcase']['charset']); */
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
   } // form_transfer_rsvp_pack_protect_string
?>
